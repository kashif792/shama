<?php



class Shama_Installation_Wizard extends MY_Controller

{



    /**

     * @var array

     */

    var $data = array();

    private $userlocationid = null;

    private $usercity = null;

    private $school_info = null; 

    private $campus = null;

    private $semester_date_id  = null;



    function __construct(){

        parent::__construct();

        $this->load->model('User');

        $this->load->model('Operation');

        if(!($this->session->userdata('id'))){

                parent::redirectUrl('signin');

            }

        $this->userlocationid = parent::GetLogedinUserLocation();

        $school_id = parent::GetSchoolDetail($this->userlocationid);

        $this->school_info = $school_id;

        $city_array = parent::GetLocationDetail($school_id->cityid);

        $this->usercity = $city_array->location;

        $this->campus = $school_id->name;

        $this->semester_date_id = parent::GetCurrentActiveSemesterByUserLocation();

    }



    /**

     * Class report

     */

    public function Principal_Wizard()

    {



        $this->userlocationid = parent::GetLogedinUserLocation();

        $school_id = parent::GetSchoolDetail($this->userlocationid);

        

        $this->load->view("wizard/principal_installation_wizard",$this->data);

    }



    function DefaultGrades()

    {

        echo json_encode(parent::GetDefaultClassList());

    }



    function DefaultSections()

    {

        $sections = array(

            array('id'=>1,'title'=>'Blue'),

            array('id'=>2,'title'=>'Green'),

            array('id'=>3,'title'=>'Yellow'),

        );



        echo json_encode($sections);

    }



    function DefaultKindergardenSubject()

    {

        echo json_encode(parent::GetDefaultKinderGratenSubject());

    }



    function DefaultSuject()

    {

        echo json_encode(parent::GetDefaultSubject());

    }



    function generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];

        }

        return $randomString;

    }



    function validateDate($date)

    {

        try{

            $explode = explode("/",$date);

     

            if(checkdate($explode[1], $explode[0], $explode[2]))

            { 

                return true;

            }

            return false;

        }

        catch(Exception $e){

            echo $e->getMessage;

        }

        

    }



    function date_check($date)

    {

        return $this->validateDate($date);

    }



    function SavePrincipalWizardValues()

    {

        try{

            if(!($this->session->userdata('id'))){

                parent::redirectUrl('signin');

            }



            $result['message'] = false;



            $this->form_validation->set_rules('session_start', 'Validate date', 'required');

            $this->form_validation->set_rules('session_end', 'Validate date', 'required');

            $this->form_validation->set_rules('semester_start', 'Validate date', 'required');

            $this->form_validation->set_rules('semester_end', 'Validate date', 'required');



            if ($this->form_validation->run() == FALSE){

                $result['message'] =  $this->form_validation->run();

            }



            else{



                $session_start = $this->input->post('session_start');

                $session_end = $this->input->post('session_end');

                $semester_start = $this->input->post('semester_start');

                $semester_end = $this->input->post('semester_end');

                $current_semester = $this->input->post('current_semester');

                $class_list = json_decode($this->input->post('grade'));

                $section_list = json_decode($this->input->post('section_list'));

                $default_kindergarten_subject = json_decode($this->input->post('default_kindergarten_subject'));

                $default_subjects = json_decode($this->input->post('default_subjects'));

                

                $subjects = array();

                if(count($default_kindergarten_subject))

                {

                    foreach ($default_kindergarten_subject as $key => $value) {

                       $subjects[] = array(

                            'title'=>$value->title,

                            'class'=>1

                       );

                    }

                }



                if(count($default_subjects))

                {

                    foreach ($default_subjects as $key => $value) {

                       $subjects[] = array(

                            'title'=>$value->title,

                            'class'=>2

                       );

                    }

                }

                include_once (APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

                if(count($class_list) && count($section_list))

                {

                    $semesterlist = array('Fall','Spring');

                    foreach ($semesterlist as $key => $value) {

                        $this->SaveSemester($value); // save semester

                    }



                    $is_session_added = $this->SaveSession($session_start,$session_end); // save session

                    if(is_int($is_session_added))

                    {

                        $active_semeter_array = $this->FindActiveSemesterId($current_semester); // find active semester id

                        

                        if(count($active_semeter_array))

                        {

                            // save dates of current semester

                            $active_semeter = $this->SaveSemesterDate($semester_start,$semester_end,$is_session_added,$active_semeter_array[0]->id);

                            $this->SaveSection($section_list);

                            if(count($active_semeter))

                            {

                                foreach ($class_list as $key => $value) {

                                    if($value->title){



                                        $class_id = $this->SaveGrade($value->title); // save grade

                                        foreach ($value->default_sections_in_grade as $key => $secvalue) 

                                        {

                                            if($secvalue->status)

                                            {

                                                $section_id = parent::getSectionList(null,$secvalue->title);

                                                

                                                if(count($section_id))

                                                {

                                                    $is_section_assigned = $this->AssignSection($class_id,$section_id[0]->id);

                                                } // end section list

                                            } // end is section allowed

                                        } // end default section 

                                    } // 

                                } // end class list



                                if(count($subjects))

                                {

                                    $this->operation->table_name = 'semester_dates';

                                    $is_active_semester = $this->operation->GetByWhere(array(

                                        'school_id'=>$this->school_info->id,

                                        'status'=>'a',

                                    ));



                                    $this->operation->table_name = 'classes';

                                    $is_class_found = $this->operation->GetByWhere(array(

                                        'school_id'=>$this->school_info->id,

                                    ));



                                    if(count($is_class_found))

                                    {

                                        foreach ($is_class_found as $key => $value) {



                                            foreach ($subjects as $key => $svalue) 

                                            {

                                                if($svalue['class'] == 1 && $value->grade == 'Kindergarten')

                                                {   

                                                    $is_subject_created = $this->SaveDefaultSubjects($svalue['title'],$value->id,$active_semeter_array[0]->id,$value->grade,$is_session_added);

                                                   

                                                    if(is_int($is_subject_created))

                                                    {

                                                        $class_slug = $this->FindDefaultClass($value->grade);

                                                        if(count($_FILES[$class_slug."_".$svalue['title']]) && $_FILES[$class_slug."_".$svalue['title']]['name'] != null)

                                                        {

                                                            $valid_formats = array("xlsx", "xls");

                                                            if(strlen($_FILES[$class_slug."_".$svalue['title']]['name']))

                                                            {

                                                                list($txt, $ext) = explode(".", strtolower($_FILES[$class_slug."_".$svalue['title']]['name']));

                                                                if(in_array(strtolower($ext),$valid_formats)){

                                                                    if ($_FILES[$class_slug."_".$svalue['title']]['name'] < 5000000) {

                                                                        $path_name = UPLOAD_PATH.'default_lesson_plan/'.ucfirst(str_replace(" ","_",trim(strtolower($value->grade))))."/".ucfirst(str_replace(" ","_",trim(strtolower($svalue['title']))));

                                                                        $file = time().trim(basename($_FILES[$class_slug."_".$svalue['title']]['name']));

                                                                        $filename = $path_name.$file;

                                                                        if(is_uploaded_file($_FILES[$class_slug."_".$svalue['title']]['name'])){

                                                                            if(move_uploaded_file($_FILES[$class_slug."_".$svalue['title']]['tmp_name'],$filename)){

                                                                                chmod($filename, 0777);

                                                                                //$excel_obj = parent::CreateExcelObject($filename);

                                                                                $this->Readfile($filename,$value->id,6,$is_subject_created,$is_active_semester[0]->id,$is_session_added);

                                                                            }

                                                                        }

                                                                    }

                                                                }

                                                            }

                                                        } // end file upload

                                                        else{

                                                            foreach ($semesterlist as $key => $semvalue) {

                                                                $default_file = $this->GetDefaultLessonPlanFile($value->grade,$svalue['title'],$semvalue);

                                                                $new_path = UPLOAD_PATH.'default_lesson_plan/'.$semvalue."/".ucfirst(str_replace(" ","_",trim(strtolower($value->grade))))."/".ucfirst(str_replace(" ","_",trim(strtolower($svalue['title']))));

                                                                if (file_exists($default_file)) {

                                                                    // create excel object

                                                                    //$excel_obj = parent::CreateExcelObject($default_file);

                                                                   $this->Readfile($default_file,$value->id,6,$is_subject_created,$is_active_semester[0]->id,$is_session_added);

                                                                   rename($default_file, $new_path);                            

                                                                }

                                                            }

                                                          

                                                        } // end read default lesson plan

                                                    } // is subject created

                                                } // add kidergarten subjects

                                                else if($svalue['class'] == 2 &&  $value->grade != 'Kindergarten'){

                                                    $is_subject_created = $this->SaveDefaultSubjects($svalue['title'],$value->id,$active_semeter_array[0]->id,$value->grade,$is_session_added);

                                                    

                                                    if(is_int($is_subject_created))

                                                    {

                                                        $class_slug = $this->FindDefaultClass($value->grade);

                                                       if(count($_FILES[$class_slug."_".$svalue['title']]) && $_FILES[$class_slug."_".$svalue['title']]['name'] != null)

                                                        {

                                                            $valid_formats = array("xlsx", "xls");

                                                            if(strlen($_FILES[$class_slug."_".$svalue['title']]['name']))

                                                            {

                                                                list($txt, $ext) = explode(".", strtolower($_FILES[$class_slug."_".$svalue['title']]['name']));

                                                                if(in_array(strtolower($ext),$valid_formats)){

                                                                    if ($_FILES[$class_slug."_".$svalue['title']]['name'] < 5000000) {

                                                                        $path_name = UPLOAD_PATH.'default_lesson_plan/'.ucfirst(str_replace(" ","_",trim(strtolower($value->grade))))."/".ucfirst(str_replace(" ","_",trim(strtolower($svalue['title']))));

                                                                        $file = time().trim(basename($_FILES[$class_slug."_".$svalue['title']]['name']));

                                                                        $filename = $path_name.$file;

                                                                        if(is_uploaded_file($_FILES[$class_slug."_".$svalue['title']]['name'])){

                                                                            if(move_uploaded_file($_FILES[$class_slug."_".$svalue['title']]['tmp_name'],$filename)){

                                                                                chmod($filename, 0777);

                                                                                //$excel_obj = parent::CreateExcelObject($filename);

                                                                                $this->Readfile($filename,$value->id,6,$is_subject_created,$is_active_semester[0]->id,$is_session_added);

                                                                            }

                                                                        }

                                                                    }

                                                                }

                                                            }

                                                        }

                                                        else{

                                                            // read local excel file

                                                            foreach ($semesterlist as $key => $semvalue) {

                                                                $default_file = $this->GetDefaultLessonPlanFile($value->grade,$svalue['title'],$semvalue);

                                                                $new_path = UPLOAD_PATH.'default_lesson_plan/'.$semvalue."/".ucfirst(str_replace(" ","_",trim(strtolower($value->grade))))."/".ucfirst(str_replace(" ","_",trim(strtolower($svalue['title']))));

                                                                if (file_exists($default_file)) {

                                                                    // create excel object

                                                                    //$excel_obj = parent::CreateExcelObject($default_file);

                                                                   $this->Readfile($default_file,$value->id,6,$is_subject_created,$is_active_semester[0]->id,$is_session_added);

                                                                   rename($default_file, $new_path);                            

                                                                }

                                                            }

                                                            

                                                        } 

                                                    }

                                                } // end for other classes

                                            } // end subject list

                                        }



                                        $this->operation->table_name = 'wizard';

                                        $is_wizard_found = $this->operation->GetByWhere(array(

                                            'school_id'=>$this->school_info->id,

                                            'status'=>'y'

                                        ));

                                        if(count($is_wizard_found))

                                        {

                                            $update_wizard = array(

                                                'status'=>'n',

                                                'edited'=>date('Y-m-d')

                                            );



                                            $this->operation->Create($update_wizard,$is_wizard_found[0]->id);

                                             $this->operation->table_name = 'grades';

                                            

                                            $option = array(

                                                'semester_date_id'=>$is_active_semester[0]->id,

                                                'option_value'=>serialize(parent::DefaultGradesList()),

                                                'status'=>'a'

                                            );

                                            $id = $this->operation->Create($option);

                                            $this->operation->table_name = 'evaluation';

                                            $option = array(

                                                'semester_date_id'=>$is_active_semester[0]->id,

                                                'option_value'=>serialize(parent::DefaultEvaluationsList()),

                                                'status'=>'a'

                                            );

                                            $id = $this->operation->Create($option);

                                        }



                                        $result['message'] = true;

                                    }

                                    

                                } // end if subject found

                            } // end semester dates

                        } // end active semester

                    }

                } // end if empty class and section

            }

            echo json_encode($result);

        }

        catch(Exception $e){}

    }



    function FindActiveSemesterId($semester_title)

    {

        $this->operation->table_name = 'semester';

        return $this->operation->GetByWhere(array(

            'semester_name'=>$semester_title,

        ));

    }



    function GetDefaultLessonPlanFile($class_name,$subject_name,$semester)

    {

        return  UPLOAD_PATH.'temp_folder/'.$semester.'/'.ucfirst(str_replace(" ","_",trim(strtolower($class_name))))."_".ucfirst(str_replace(" ","_",trim(strtolower($subject_name)))).".xlsx";

    }



    function Readfile($file_name,$class_id,$section_id,$subject_id,$semester_id,$sessionid)

    {

        try{

            $inputfiletype = PHPExcel_IOFactory::identify($file_name);

            $objReader = PHPExcel_IOFactory::createReader($inputfiletype);

            $objReader->setReadDataOnly(true);

            $objPHPExcel = $objReader->load($file_name);



            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow();

            $highestColumn = $sheet->getHighestColumn();

            $this->operation->table_name = 'defaultlessonplan';

            for ($row = 1; $row <= $highestRow; $row++)

            {

                if($row>2)

                {

                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                    $data = array(

                        'day' => trim($rowData[0][0]),

                        'concept' => ucfirst(trim($rowData[0][1])),

                        'topic' => trim($rowData[0][2]),

                        'lesson' => trim($rowData[0][3]),

                        'type'=>trim($rowData[0][4]),

                        'content'=>trim($rowData[0][5]),

                        'classid'=>$class_id,

                        'sectionid'=>$section_id,

                        'subjectid'=>$subject_id,

                        'date'=>date("Y-m-d H:i"),

                        'last_update'=>date("Y-m-d H:i"),

                        'uniquecode'=>uniqid(),

                        'semsterid'=>$semester_id,

                        'sessionid'=>$sessionid

                    );



                    $is_section_create = $this->operation->Create($data);  

                }

            }

            unset($objPHPExcel);

            unset($objReader);

            

        }

        catch(Exception $e){}

    }



    function SaveSemester($semester_title)

    {

        try{

            if(!empty($semester_title))

            {

                $this->operation->table_name = 'semester';

                $is_semester_found = $this->operation->GetByWhere(array(

                    'semester_name'=>$semester_title,

                ));

                if(count($is_semester_found)==0)

                {

                    $semester = array(

                        'semester_name'=>$semester_title,

                        'created'=>date('Y-m-d'),

                        'modified'=>date('Y-m-d'),

                        'status'=>'i',

                        'uniquecode'=>$this->generateRandomString(),

                    );



                    $this->operation->Create($semester);

                }

            }

        }

        catch(Exception $e){} 

    }





    function SaveSession($session_start,$session_end)

    {

        try{

            if(!empty(trim($session_start)) && !empty(trim($session_end)))

            {

                $this->operation->table_name = 'sessions';

                $session_array = array(

                    'datefrom'=>date('Y-m-d',strtotime($session_start)),

                    'dateto'=>date('Y-m-d',strtotime($session_end)),

                    'datetime'=>date('Y-m-d'),

                    'status'=>'a',

                    'uniquecode'=>$this->generateRandomString(),

                    'school_id'=>$this->school_info->id,

                );



                $is_session_created = $this->operation->Create($session_array);



                if(count($is_session_created))

                {

                    return $is_session_created;

                }

            }

            return false;

        }

        catch(Exception $e){} 

    }



    function SaveSemesterDate($semester_start,$semester_end,$session_id,$semester_id)

    {

        try{

            if(!empty(trim($semester_start)) && !empty(trim($semester_end)))

            {

                $this->operation->table_name = 'semester_dates';

              

                $semester_dates = array(

                    'session_id'=>$session_id,

                    'semester_id'=>$semester_id,

                    'start_date'=>date('Y-m-d',strtotime($semester_start)),

                    'end_date'=>date('Y-m-d',strtotime($semester_end)),

                    'status'=>'a',

                    'created'=>date('Y-m-d'),

                    'last_edited'=>date('Y-m-d'),

                    'school_id'=>$this->school_info->id,

                    'slug'=>$this->generateRandomString(),

                );



                $is_semester_create = $this->operation->Create($semester_dates);



                if(count($is_semester_create))

                {

                    return $is_semester_create;

                }

            }

            return false;

        }

        catch(Exception $e){} 

    }



    function SaveGrade($grade)

    {

        try{

            if(!empty(trim($grade)))

            {

                $this->operation->table_name = 'classes';

                $is_class_found = $this->operation->GetByWhere(array(

                    'grade'=>trim($grade),

                    'school_id'=>$this->school_info->id,

                ));

                if(count($is_class_found) == 0)

                {

                    $class = array(

                        'grade'=>$grade,

                        'last_update'=>date('Y-m-d'),

                        'status'=>'a',

                        'school_id'=>$this->school_info->id,

                        'uniquecode'=>$this->generateRandomString(),

                    );



                    $is_class_create = $this->operation->Create($class);



                    if(count($is_class_create))

                    {

                        // create directory for class

                        $path_name = UPLOAD_PATH.'default_lesson_plan';

                        parent::CreateDirectory($path_name);

                        $path_name = UPLOAD_PATH.'default_lesson_plan/'.ucfirst(str_replace(" ","_",trim($grade)));

                        parent::CreateDirectory($path_name);

                        return $is_class_create;

                    }

                }else{

                    return $is_class_found[0]->id;

                }

            }

            return false;

        }

        catch(Exception $e){}

    }



    function SaveSection($section_list)

    {

        try{

            if(count($section_list))

            {

                $this->operation->table_name = 'sections';

                foreach ($section_list as $key => $value) {

                    $is_class_found = $this->operation->GetByWhere(array(

                        'section_name'=>$value->title,

                        'school_id'=>$this->school_info->id,

                    ));

                    if(count($is_class_found) == 0)

                    {

                        $section = array(

                            'section_name'=>$value->title,

                            'last_update'=>date('Y-m-d'),

                            'school_id'=>$this->school_info->id,

                            'uniquecode'=>$this->generateRandomString(),

                        );



                        $is_section_create = $this->operation->Create($section);  

                    }

                }

            }

        }

        catch(Exception $e){}

    }



    function AssignSection($classid,$sectionid)

    {

        try{



            $this->operation->table_name = 'assignsections';

            $is_class_found = $this->operation->GetByWhere(array(

                'classid'=>$classid,

                'sectionid'=>$sectionid,

            ));

            if(count($is_class_found) == 0)

            {

                 $section = array(

                    'classid'=>$classid,

                    'sectionid'=>$sectionid,

                    'status'=>'a',

                    'uniquecode'=>$this->generateRandomString(),

                );



                $is_section_create = $this->operation->Create($section); 

      

                if(count($is_section_create))

                {

                    return $is_section_create;

                }

            }

                

            return false;

        }

        catch(Exception $e){}

    }



    function SaveDefaultSubjects($name,$class_id,$semester_id,$classes_name,$sessionid)

    {

        try{

            if($name != '')

            {

                $this->operation->table_name = 'subjects';

                $subject = array(

                    'subject_name'=>trim($name),

                    'subject_code'=>'',

                    'class_id'=>$class_id,

                    'last_update'=>date('Y-m-d'),

                    'subject_image'=>'',

                    'semsterid'=>$semester_id,
                    'session_id'=>$sessionid,

                );



                $is_subject_create = $this->operation->Create($subject); 

                 if(count($is_subject_create))

                {

                    // create directory for subject

                    $path_name = UPLOAD_PATH.'default_lesson_plan/'.ucfirst(str_replace(" ","_",trim($classes_name)))."/".ucfirst(str_replace(" ","_",trim($name)));

                   

                    parent::CreateDirectory($path_name);

                    return $is_subject_create;

                }  

            }

             return false;

        }

        catch(Exception $e){} 

    }



}

