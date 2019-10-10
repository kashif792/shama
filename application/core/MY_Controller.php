<?php

/**
 * Core controller
 *
 */

class MY_Controller extends CI_Controller {
    function  __construct(){
        parent::__construct();
        $this->load->model('user');
        $this->load->model('operation');
    }

    /**
     * Redirect url
     *
     */
    public function redirectUrl($path){
        redirect(base_url().$path);
    }

  
    /**
     * Uploading function
     */
    public function uploadFiles($path,$file){
        // Check if user has not already folder created
       $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG","PNG","GIF","BMP","doc","DOC","PDF","pdf","DOCX","docx","xls","XLS","XLSX","xlsx");
        if(strlen($file)){
            list($txt, $ext) = explode(".", $file);
            if(in_array(strtolower($ext),$valid_formats)){
                $filename = $path. $file;
                move_uploaded_file($_FILES["inputFile"]["tmp_name"],$filename);
                chmod($filename, 0777);
                return true;
            }
            return false;
        }
        else{
            return true;
        }
    }

    function string_limit_words($string, $word_limit) {

        $words = explode(' ', $string);
        return implode(' ', array_slice($words, 0, $word_limit));
    }

    function slugGenerator($title)
    {
        $time = time();
        $newtitle = $this->string_limit_words(strtolower($title), 6); // First 6 words
        $urltitle= preg_replace('/[^a-z0-9]/i',' ', $newtitle);
        $newurltitle = str_replace(" ","-",$newtitle);
        $url= $time.$newurltitle; // Final URL
        return $url;
    }

    function HolidaySlugGenerator($title)
    {
        $newtitle = strtolower($title); // First 6 words
        $urltitle= preg_replace('/[^a-z0-9]/i',' ', $newtitle);
        $newurltitle = str_replace(" ","-",$newtitle);
        $url= $newurltitle; // Final URL
        return $url;
    }

   
     /**
     * Get all classes
     */
    function GetAllClasses(){
        return $this->operation->GetRowsByQyery("Select * from classes");
    }

    /**
     * Get all meta
     */
    function getUserMeta($userid,$metakey)
    {
        $is_meta_found = $this->operation->GetRowsByQyery("Select * from user_meta where user_id = ".$userid." AND meta_key LIKE '%".$metakey."%'");

        if(count($is_meta_found)){

            return $is_meta_found[0]->meta_value;

        }
        else{
            return false;
        }
    }

    /**
     * Get all meta
     */
    function GetLessonMeta($lessonid,$metakey)
    {
        $is_lessonmeta_found = $this->operation->GetRowsByQyery("Select * from lesson_meta where lessonid = ".$lessonid." AND meta_key LIKE '%".$metakey."%'");
        if(count($is_lessonmeta_found)){
            return $is_lessonmeta_found[0]->meta_value;
        }
        else{
            return false;
        }
    }

    /**
     * Get all metaclass
     */
    function GetLessonClassMeta($lessonid)
    {
        $is_lessonmeta_found = $this->operation->GetRowsByQyery("Select * from lesson_meta where lessonid = ".$lessonid." AND meta_key = 'section'");
        if(count($is_lessonmeta_found)){
            return $is_lessonmeta_found;
        }
        else{
            return false;
        }
    }

    function update_lesson_meta($lessonid,$meta_key,$meta_value)
    {
        $this->user->table_name = "lesson_meta";
        $this->db->query("Update ".$this->user->table_name." SET meta_value = '".$meta_value."' WHERE lessonid = ".$lessonid." AND meta_key = '".$meta_key."'");
    }

    function getClassInfo($sectioid)
    {
        $is_class_found = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.sectionid =".$sectioid);

       if(count($is_class_found)){
            return $this->getClass($is_class_found[0]->class_id)." (".$is_class_found[0]->section_name.")";
        }
        else{
            return false;
        }
    }

    function getClass($classid)
    {
        $is_class_found = $this->operation->GetRowsByQyery("Select c.* from classes c where c.id =".$classid);
        //var_dump($classid);
        if(count($is_class_found)){
            return $is_class_found[0]->grade;
        }
        else{
            return false;
        }
    }

    function getClassInfoName($classid)
    {
        $is_class_found = $this->operation->GetRowsByQyery("Select c.* from classes c where c.id =".$classid);
        if(count($is_class_found)){
            return $is_class_found;
        }
        else{
            return false;
        }
    }

    function getSectionList($sectioid = null ,$section_name = null)
    {
        if(!is_null($sectioid))
        {
            return $this->operation->GetRowsByQyery("Select s.* from sections s where s.id = ".$sectioid);
        }
        else{
            return $this->operation->GetRowsByQyery("Select s.* from sections s where s.section_name = '".$section_name."' AND school_id = ".$this->GetLogedinUserLocation());
        }
    }
    
    
    function GetSubject($subjectid = null)
    {
        if(is_null($subjectid))
        {
            $is_subject_found = $this->operation->GetRowsByQyery("Select * from subjects");
            if(count($is_subject_found)){
                return $is_subject_found;
            }
            else{
                return false;
            }
        }
        else{
            $is_subject_found = $this->operation->GetRowsByQyery("Select * from subjects  where id = ".$subjectid);
            if(count($is_subject_found)){
                return $is_subject_found;
            }
            else{
                return false;
            }
        }

    }

    function GetClassList()
    {
        $is_class_found = $this->operation->GetRowsByQyery("Select c.*,s.* from classes c INNER JOIN sections s ON s.class_id = c.id");
        if(count($is_class_found)){
            return $is_class_found;
        }
        else{
            return false;
        }
    }

    public function GetLessonRead($subjectid = null,$columnname = null)
    {
        if(is_null($subjectid) && is_null($columnname))
        {
            $is_subject_found = $this->operation->GetRowsByQyery("Select * from lesson_read");
            if(count($is_subject_found)){
                return $is_subject_found;
            }
            else{
                return false;
            }
        }
        else{
            $is_subject_found = $this->operation->GetRowsByQyery("Select * from lesson_read  where ".$columnname." = ".$subjectid);
            if(count($is_subject_found)){
                return $is_subject_found;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Get user image
     */
    function GetUserById($userid)
    {
        $is_meta_found = $this->operation->GetRowsByQyery("Select * from invantageuser where id = ".$userid);

        if(count($is_meta_found)){
            return $is_meta_found;
        }
        else{
            return false;
        }
    }

    /**
     * Check email in invantage user table
     */
    public function CheckInvantageUserEmail($email){
        $this->user->table_name ="invantageuser";
        $user = $this->user->get_by_query("Select email from ".$this->user->table_name." where email = '".$email."'");
        $check = FALSE;
        if(count($user) == true):
            $check = TRUE;
        endif;
        return $check;
    }

    function GetLocationDetail($location)
    {
        $is_location_found = $this->operation->GetRowsByQyery("Select * from location where id=".$location);
        if(count($is_location_found)){
            return $is_location_found[0];
        }
        else{
            return false;
        }
    }

     function GetSchoolDetail($schoolid)
    {
        $is_school_found = $this->operation->GetRowsByQyery("Select s.*,l.location from schools s INNER JOIN location l ON l.id = s.cityid where s.id=".$schoolid);

        if(count($is_school_found)){
            return $is_school_found[0];
        }
        else{
            return false;
        }
    }

    public function GetUserSchool($userid)
    {
        $is_school_found = $this->operation->GetRowsByQyery("Select l.*,l.id as locationid,s.* FROM user_locations ul INNER JOIN schools s ON s.id = ul.school_id INNER JOIN location l ON l.id = s.cityid where ul.user_id=".$userid);

        if(count($is_school_found)){
            return $is_school_found;
        }
        else{
            return false;
        }
    }

    function GetSessionDetail($id)
    {
        $this->operation->table_name = 'sessions';
        return $this->operation->GetByWhere(array('id'=>$id));
    }

    function GetSemeterDetail($id)
    {
        $this->operation->table_name = 'semester';
        return $this->operation->GetByWhere(array('id'=>$id));
    }

    function DefaultEvaluationsList()
    {
        return array(
            array(
                'slug'=> 'ass',
                'value'=> 0,
                'title'=> 'Assignment'
            ),
            array(
                'slug'=> 'qui',
                'value'=> 0,
                'title'=> 'Quiz'
            ),
            array(
                'slug'=> 'mid',
                'value'=> 30,
                'title'=> 'Mid term'
            ),
            array(
                'slug'=> 'fin',
                'value'=> 50,
                'title'=> 'Final exam'
            ),
            array(
                'slug'=> 'pra',
                'value'=> 0,
                'title'=> 'Practical'
            ),
            array(
                'slug'=> 'att',
                'value'=> 0,
                'title'=> 'Attendance'
            ),
            array(
                'slug'=> 'orl',
                'value'=> 0,
                'title'=> 'Oral'
            ),
            array(
                'slug'=> 'beh',
                'value'=> 0,
                'title'=> 'Behaviour'
            )
        );
    }

    function DefaultGradesList()
    {
        return array(
            array(
                'id'=>1,
                'title'=> 'A',
                'lower_limit'=> 90,
                'upper_limit'=> 100
            ),
            array(
                'id'=>2,
                'title'=> 'B',
                'lower_limit'=> 80,
                'upper_limit'=> 90
            ),
            array(
                'id'=>3,
                'title'=> 'C',
                'lower_limit'=> 70,
                'upper_limit'=> 79
            ),
            array(
                'id'=>4,
               'title'=> 'D',
                'lower_limit'=> 60,
                'upper_limit'=> 69
            ),
            array(
                'id'=>5,
               'title'=> 'F',
                'lower_limit'=> 0,
                'upper_limit'=> 59
            ),
        );
    }

    function GetLogedinUserLocation()
    {
        $locations = $this->session->userdata('locations');
        return (int) $locations[0]['school_id'];
    }



    function GetCurrentActiveSemesterByUserLocation($sessionid = null)
    {
        if(is_null($sessionid))
        {
            $location_id = $this->GetLogedinUserLocation();
            $this->operation->table_name = 'semester_dates';
            $is_semester_dates_found = $this->operation->GetByWhere(array('school_id'=>$location_id));
        }
        else{

            $this->operation->table_name = 'semester_dates';
            $this->operation->primary_key ='session_id';
            $is_semester_dates_found = $this->operation->GetByWhere(array('session_id'=>$sessionid,'status'=>'a'));
            
        }
      
        return (int) $is_semester_dates_found[0]->id;
    }

    function GetSemesterByUserLocation($sessionid = null)
    {
        if(is_null($sessionid))
        {
            $location_id = $this->GetLogedinUserLocation();
            $this->operation->table_name = 'semester_dates';
            $is_semester_dates_found = $this->operation->GetByWhere(array('school_id'=>$location_id));
        }
        else{

            $this->operation->table_name = 'semester_dates';
            $this->operation->primary_key ='session_id';
            //$is_semester_dates_found = $this->operation->GetByWhere(array('session_id'=>$sessionid,'status'=>'a'));
            $is_semester_dates_found = $this->operation->GetByWhere(array('session_id'=>$sessionid));
        }
      
        return (int) $is_semester_dates_found[0]->id;
    }
    
     function GetCurrentSemesterData($sessionid = null)
    {
        $this->operation->table_name = 'semester_dates';
        $is_semester_dates_found = $this->operation->GetByWhere(array('session_id'=>$sessionid,'status'=>'a'));
      
        return  $is_semester_dates_found;
    }
    
    function GetSubjectsByClass($classid,$semesterid,$sessionid)
    {
        $active_session = $this->GetUserActiveSession();
        
        if(!empty($semesterid))
        {
            $this->operation->table_name = 'subjects';
            return $this->operation->GetByWhere(array('class_id'=>$classid,'semsterid'=>$semesterid,"session_id"=>$sessionid));
        }
        else{
            $this->operation->table_name = 'subjects';
            return $this->operation->GetByWhere(array('class_id'=>$classid,'semsterid'=>$semesterid,"session_id"=>$sessionid));
        }

    }

    function GetSemesterByName($name)
    {
        if(!is_null($name))
        {
            $this->operation->table_name = 'semester';
            return $this->operation->GetByWhere(array('semester_name'=>$name));
        }
        return false;
    }

    function GetGrade($number,$session_date = null)
    {   
        $obtain_grade = 'F';
        
        if(is_null($session_date))
        {
            $current_semester_date = $this->GetCurrentActiveSemesterByUserLocation();
           
        }
        else{
           $current_semester_date = $this->GetCurrentActiveSemesterByUserLocation($session_date);
        }

        $this->operation->table_name = 'grades';
        $grades = $this->operation->GetByWhere(array('semester_date_id'=>$current_semester_date));

        if(count($grades) && $number > 0)
        {
            $grades = unserialize($grades[0]->option_value);
        
            foreach ($grades as $key => $value) {
         
                if($number >= (double) $value['lower_limit']   && $number <= (double) $value['upper_limit'])
               {
                    $obtain_grade = $value['title'];
               }
            }
        }
        return $obtain_grade;
    }
    // Get Grade by semester date
    function GetGradeBySessionalDates($number,$session_date = null)
    {   
        $obtain_grade = 'F';
        
        if(is_null($session_date))
        {
            $current_semester_date = $this->GetSemesterByUserLocation();
           
        }
        else{
           $current_semester_date = $this->GetSemesterByUserLocation($session_date);
        }

        $this->operation->table_name = 'grades';
        $grades = $this->operation->GetByWhere(array('semester_date_id'=>$current_semester_date));

        if(count($grades) && $number > 0)
        {
            $grades = unserialize($grades[0]->option_value);
        
            foreach ($grades as $key => $value) {
         
                if($number >= (double) $value['lower_limit']   && $number <= (double) $value['upper_limit'])
               {
                    $obtain_grade = $value['title'];
               }
            }
        }
        return $obtain_grade;
    }
    

    function GetEvaluationByType($type,$session_date = null)
    {
        $evaluation_point = 0;
        if(is_null($session_date))
        {
            $current_semester_date = $this->GetCurrentActiveSemesterByUserLocation();
        }
        else{
           $current_semester_date = $this->GetCurrentActiveSemesterByUserLocation($session_date);
        }

        $this->operation->table_name = 'evaluation';
        $is_eva_found = $this->operation->GetByWhere(array('semester_date_id'=>$current_semester_date));

     
        if(count($is_eva_found))
        {
            $eva_list = unserialize($is_eva_found[0]->option_value);
           if($type == 'ass')
           {
                $evaluation_point = (int) $eva_list[0]['value'];
           }

           else if($type == 'qui')
           {
                $evaluation_point = (int) $eva_list[1]['value'];
           }

           else if($type == 'mid')
           {
                $evaluation_point = (int) $eva_list[2]['value'];

           }

           else if($type == 'fin')
           {
                $evaluation_point = (int) $eva_list[3]['value'];
           }

           else if($type == 'pra')
           {
                $evaluation_point = (int) $eva_list[4]['value'];
           }

           else if($type == 'att')
           {
                $evaluation_point = (int) $eva_list[5]['value'];
           }

           else if($type == 'orl')
           {
                $evaluation_point = (int) $eva_list[6]['value'];
           }

           else if($type == 'beh')
           {
                $evaluation_point = (int) $eva_list[7]['value'];
           }
        }
    
        return $evaluation_point;
    }

    function ImageConvertorToBase64($file)
    {
        
        $type = pathinfo($file, PATHINFO_EXTENSION);
        $data = file_get_contents($file);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    function CheckSchoolWizard($school_id)
    {
        $this->operation->table_name = 'wizard';

        return $this->operation->GetByWhere(array(
            'school_id'=>$school_id,
            'status'=>'y'
        ));
    }

    function CreateExcelObject($file_name)
    {
        try{
            require (APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
            $inputfiletype = PHPExcel_IOFactory::identify($file_name);
            $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
            $objPHPExcel = $objReader->load($file_name);
            return $objPHPExcel;
        }
        catch(Exception $e){}
    }

    function GetDefaultClassList()
    {
        return array(
            array('id'=>1,'title'=>'Kindergarten','slug'=>'kindergarten'),
            array('id'=>2,'title'=>'Grade 1','slug'=>'grade1'),
            array('id'=>3,'title'=>'Grade 2','slug'=>'grade2'),
            array('id'=>4,'title'=>'Grade 3','slug'=>'grade3'),
            array('id'=>5,'title'=>'Grade 4','slug'=>'grade4'),
            array('id'=>6,'title'=>'Grade 5','slug'=>'grade5'),
        );
    }

    function FindDefaultClass($class_name)
    {
        $class_slug = '';
        if($class_name != '')
        {
            $class_list = $this->GetDefaultClassList();
            foreach ($class_list as $key => $value) {
                if($value['title'] == $class_name)
                {
                    $class_slug = $value['slug'];
                }
            }
        }
        return $class_slug;
    }

    function GetDefaultKinderGratenSubject()
    {
        return array(
            array('id'=>1,'title'=>'English'),
            array('id'=>2,'title'=>'Urdu'),
            array('id'=>3,'title'=>'Math'),
            array('id'=>4,'title'=>'Science'),
            array('id'=>5,'title'=>'Islamiat'),
        );
    }

    function GetDefaultSubject()
    {
        return array(
             array('id'=>1,'title'=>'English'),
            array('id'=>2,'title'=>'Urdu'),
            array('id'=>3,'title'=>'Math'),
            array('id'=>4,'title'=>'Science'),
            array('id'=>5,'title'=>'Islamiat'),
            array('id'=>6,'title'=>'Social Studies'),
            array('id'=>7,'title'=>'Computer'),
            array('id'=>8,'title'=>'Our values'),
        );
    }

    function CreateDirectory($path)
    {
        try{
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
                return true;
            }
            return false;
        }
        catch(Exception $e){}
    }

     public function GetUserActiveSession()
    {
        try{
            $location_id = $this->GetLogedinUserLocation();
            if(is_int($location_id))
            {
                return $this->operation->GetRowsByQyery("SELECT  * FROM sessions where status = 'a' AND school_id =".$location_id);        
            }
        }
        catch(Exception $e){}
    }

  

    function GetSemsterDates($semester)
    {
        if(!is_null($semester))
        {
            
            $this->operation->table_name = 'semester';
            $is_semester_dates_found = $this->operation->GetByWhere(array('id'=>$semester));
            if(count($is_semester_dates_found))
            {
                $location_id = $this->GetLogedinUserLocation();
                $this->operation->table_name = 'semester_dates';
                $is_semester_dates_found = $this->operation->GetByWhere(array('semester_id'=>$is_semester_dates_found[0]->id,'school_id'=>$location_id));
            }
        }
        return (int) $is_semester_dates_found[0]->id;
    }

    function GetSemesterBySession($sessionid,$semester)
    {
        $result = array();
        if(!is_null($sessionid) && !is_null($semester))
        {
            
            $this->operation->table_name = 'semester';
            $is_semester_dates_found = $this->operation->GetByWhere(array('id'=>$semester));
            if(count($is_semester_dates_found))
            {
                $location_id = $this->GetLogedinUserLocation();
                $this->operation->table_name = 'semester_dates';
                $result =  $this->operation->GetByWhere(array(
                    'session_id'=>$sessionid,
                    'semester_id'=>$is_semester_dates_found[0]->id,
                    'school_id'=>$location_id
                ));
            }
        }
        return $result;
    }

     function GetHolidaysByUserLoginLocation($start_date)
    {
        try{
            $this->operation->table_name = 'holiday';
            $location_id = $this->GetLogedinUserLocation();
            $holidays = $this->operation->GetRowsByQyery("Select * from holiday where school_id={$location_id} AND date(start_date) >='".$start_date."' order by start_date asc");
            
            $semester_holidays = array();
            $i = 0;
            $single = true;
            if(count($holidays))
            {
                foreach ($holidays as $key => $value) {
                    //$holidaystatus = $this->HolidayStatus($value->event_id);
                    if($value->all_day == 'y' && $value->apply == 'y')
                    {
                        // check single holiday
                        if(date('Y-m-d',strtotime($value->start_date)) == date('Y-m-d',strtotime($value->end_date)))
                        {
                            $semester_holidays[$i] = date('Y-m-d',strtotime($value->start_date));
                            $i++;
                        }
                        else if($value->apply == 'y'){
                            // multi dats
                            $date = date('Y-m-d',strtotime($value->start_date));
                            // End date
                            $end_date = date('Y-m-d',strtotime($value->end_date));

                            while (strtotime($date) <= strtotime($end_date)) {
                                $semester_holidays[$i] = $date;
                                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                                $i++;
                            }
                        }
                    }
                }
            }
            return $semester_holidays;
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    function GetTimeTableByLocation($sessionid,$semesterid)
    {
        try{
            $this->operation->table_name = 'schedule';
            return $this->operation->GetByWhere(array('semsterid'=>$sessionid,'sessionid'=>$semesterid));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    function CheckCurrentDayStatus($holidays,$date)
    {
        try{
            if(!empty($date)){

                $check_weekend = $this->CheckCurrentWeekend($date);
                if($check_weekend) {
                    if($this->FindNextMondayDate($date))
                    {
                        $current_day_status = $this->CheckIsHolidayToday($holidays,$this->FindNextMondayDate($date));
                        
                        if($current_day_status)
                        {
                            // current monday is holiday 
                            $date = date ("Y-m-d", strtotime("+1 day", strtotime($this->FindNextMondayDate($date))));
                            if($date)
                            {
                                while ($this->CheckIsHolidayToday($holidays,$date)) {
                                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                                }
                                return $date;
                            }
                        }
                        else{
                            // current day is not holiday
                            return $this->FindNextMondayDate($date);
                        }
                    }
                }else{
                    $current_day_status = $this->CheckIsHolidayToday($holidays,$date);
                    if($current_day_status)
                    {
                        // move to next day
                        $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                        $check_weekend = $this->CheckCurrentWeekend($date);
                        if($check_weekend || $this->CheckIsHolidayToday($holidays,$date))
                        {
                            // weekend
                            if($check_weekend){
                                $date = $this->FindNextMondayDate($date);
                            }
                            // holiday
                            while ($this->CheckIsHolidayToday($holidays,$date)) {
                                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                            }
                            return $date;
                        }
                        else{
                            return $date;
                        }
                    }
                    else{
                        return $date;
                    }
                }
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    function CheckCurrentWeekend($date)
    {
        if(date('D',strtotime($date)) == 'Sat' || date('D',strtotime($date)) == 'Sun') {
            return true;
        }
        return false;
    }

    function FindNextMondayDate($date)
    {
        $date = date('Y-m-d', strtotime("next monday", strtotime($date)));
        $date = new DateTime($date);
        $date = $date->format('Y-m-d');
        return $date;
    }

    function CheckIsHolidayToday($holidays,$date)
    {
        if(in_array($date,$holidays))
        {
            return true;
        }
        return false;
    }

    function CheckCurrentDayFoundRecord($date)
    {
        date_default_timezone_set("Asia/Karachi");
        return $this->operation->GetRowsByQyery("select * from holiday where apply = 'y' AND all_day = 'n' AND '".$date."' between date(start_date) and date(end_date)");
    }

    function IsPeriodHoursMatched($subject_star_time,$subject_end_time,$holiday_start_time,$holiday_end_time)
    {
        date_default_timezone_set("Asia/Karachi");
    
        // check current period hours
        // &&  date('H:i',strtotime($holiday_end_time)) <= date('H:i',$subject_end_time)
        if( date('H:i',strtotime($holiday_start_time)) >= date('H:i',$subject_star_time) && date('H:i',$subject_end_time)<= date('H:i',strtotime($holiday_end_time)))
        {
            return false;
        }
        return true;
    }
}
