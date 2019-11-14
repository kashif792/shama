<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'libraries/REST_Controller.php';

/**
 * Insight API
 *
 * This class responsible for connecting,sending and receiving data to outside web client
 */
class LMSApi extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('operation');
        date_default_timezone_set("Asia/Karachi");
     }

    // ----------------------------------------------------------------------

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
     * Get data from maxfocus api
     *
     * @access private
     * @param string endpoint url
     * @return array
     */
    function GetStudentList_post()
    {

        try{
            $classid = $this->input->post('classid');
            $sectionid= $this->input->post('sectionid');
            $locations = $this->session->userdata('locations');
            $school_id = $locations[0]['school_id'];
    
            if($this->post('school_id'))
            {
                $school_id = $this->post('school_id');
            }

            
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$school_id,'status'=>'a'));


            $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));

            $query=$this->operation->GetRowsByQyery("SELECT inv.* FROM invantageuser inv inner join student_semesters ss on inv.id=ss.studentid where ss.classid=".$classid." and ss.sectionid= ".$sectionid." and ss.semesterid = ".$active_semester[0]->semester_id." AND ss.sessionid = ".$active_session[0]->id." AND  ss.status='r' and inv.type='s'");
            
            $result =array();

            if(count($query))
            {
                foreach ($query as $key => $value) {
                    $classInfo = $this->getUserMeta($value->id,'sgrade');

                    $this->operation->primary_key = 'id';
                    $this->operation->table_name = 'sections';
                    $sectioninfo = $this->operation->GetByWhere(array('id'=>$classInfo));


                    $classinfodetail = $this->operation->GetRowsByQyery('SELECT ss.classid,c.grade,ss.sectionid,ss.semesterid,s.section_name FROM student_semesters ss INNER JOIN classes c on c.id = ss.classid INNER JOIN sections s on s.id = ss.sectionid  where ss.status = "r" and ss.semesterid = '.$active_semester[0]->semester_id.' AND ss.sessionid = '.$active_session[0]->id.' AND ss.studentid = '.$value->id);
                  
                    if(count($classinfodetail))
                    {

                        $result[] = array(

                            'id'=>$value->id,
                            'roll_no'=>$value->username,
                            'student_name'=>$this->getUserMeta($value->id,'sfullname')." ".$this->getUserMeta($value->id,'slastname'),
                            'password'=>$value->password,
                            'class'=> $classinfodetail[0]->grade,
                            'class_id'=>$classinfodetail[0]->classid,
                            'section_id'=>$classinfodetail[0]->sectionid,
                            'section'=> section_name,
                            'campus' => null,
                            'profile_link'=> $value->profile_image,

                        );
                    }
                }
            }
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'No student found'
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
       
        
    }

  function GetStudenByRollNo($roll_no)
    {

        $query = $this->operation->GetRowsByQyery("Select * from invantageuser where username= ".$roll_no);
        $result= array();
        if(count($query))
        {
                $classInfo = $this->getUserMeta($value->id,'sgrade');

                $this->operation->primary_key = 'id';
                $this->operation->table_name = 'sections';
                $sectioninfo = $this->operation->GetByWhere(array('id'=>$classInfo));
                $classinfodetail = $this->operation->GetRowsByQyery('SELECT ss.classid,c.grade,ss.sectionid,s.section_name FROM student_semesters ss INNER JOIN classes c on c.id = ss.classid INNER JOIN sections s on s.id = ss.sectionid  where ss.studentid = '.$value->id);

                $result= array(
                    'id'=>$value->id,
                    'roll_no'=>$value->username,
                    'student_name'=>$this->getUserMeta($value->id,'sfullname'),
                    'password'=>$value->password,
                    'class'=> $classinfodetail[0]->grade,
                    'class_id'=>$classinfodetail[0]->classid,
                    'section_id'=>$classinfodetail[0]->sectionid,
                    'section'=> $classinfodetail[0]->section_name,
                    'campus' => $value->location,
                    'profile_link'=> $value->profile_image,

                );

        }
        echo json_encode($result);
    }


   function getClassInfo($sectioid)
    {
        $is_class_found = $this->operation->GetRowsByQyery("Select s.* from sections s INNER JOIN classes c ON c.id =s.id where s.id = ".$sectioid);
        if(count($is_class_found)){

            return $this->getClass($is_class_found[0]->class_id)." (".$is_class_found[0]->section_name.")";
        }
        else{
            return false;
        }
    }

    function getClass($classid)
    {
        $is_class_found = $this->operation->GetRowsByQyery("Select c.* from classes c where c.id = ".$classid);
        if(count($is_class_found)){
            return $is_class_found[0]->grade;
        }
        else{
            return false;
        }
    }


    function GetTeacherSchoolInfo($schoolid)
    {
        $result = array();
        if(!empty($schoolid) && !is_null($schoolid))
        {
            $is_location_found=$this->operation->GetRowsByQyery('
                SELECT s.id as schoolid,s.name,l.id as cityid, l.location 
                FROM schools s 
                INNER JOIN location l ON l.id = s.cityid 
                WHERE l.id= '.$schoolid
            );
            if(count($is_location_found))
            {
                foreach ($is_location_found as $key => $value) {
                    $result[] = array(
                        'cityid' => $value->cityid,
                        'city'=>$value->location,
                        'schoolid'=>$value->schoolid,
                        'school'=>$value->name,
                    );
                }
            }
        }
        return $result;
    }

    function GetTeacherList_post()
    {
        try{
            if($this->post('schoolid'))
                {
                    $is_teacher_found = $this->operation->GetRowsByQyery('
                        SELECT inv.id,inv.username,inv.password,inv.screenname,inv.email,inv.profile_image,ul.school_id 
                        FROM invantageuser inv 
                        INNER JOIN user_locations ul ON ul.user_id = inv.id 
                        WHERE inv.type = "t" AND ul.school_id = '.$this->post('schoolid')
                    );
                }
                else{
                    $is_teacher_found = $this->operation->GetRowsByQyery('
                        SELECT inv.id,inv.username,inv.password,inv.screenname,inv.email,inv.profile_image,ul.school_id   
                        FROM invantageuser inv 
                        INNER JOIN user_locations ul ON ul.user_id = inv.id 
                        WHERE inv.type = "t"'
                    );
                }

                
                $result = array();
                if(count($is_teacher_found))
                {
                    foreach ($is_teacher_found as $key => $value) {
                        $result[] = array(
                            'id'=>$value->id,
                            'username'=>$value->username,
                            'password'=>$value->password,
                            'screenname'=>$value->screenname,
                            'email' =>$value->email,
                            'campus' => "",
                            'profile_link'=> $value->profile_image,
                            'schoolinfo'=>$this->GetTeacherSchoolInfo($value->school_id)
                        );
                    }
                }
                 $this->response($result, REST_Controller::HTTP_OK);
        }
        catch(Exception $e)
        {
              $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); 
        }
        
       
    }

        function GetLessonByID($lesson_id){
            $is_lesson_found = $this->operation->GetRowsByQyery("Select l.* from lessons l where l.id = '".$lesson_id."'");
        if(count($is_lesson_found)){
            return $is_lesson_found;
        }
        else{
            return false;
        }
        }

        function GetLessonList_get()
    {
        $subject_id = 7;
        //isset($_POST['subject_id']) && !empty($_POST['subject_id'])
        if(true)
         {
            $subject_id = 7;//$_POST['subject_id'];
            $this->operation->table_name = "lesson_read";
            $query = $this->operation->GetByWhere(array('subjectid'=>$subject_id));
            //echo $this->db->last_query();
            $result = array();
            if(count($query))
            {
                foreach ($query as $key => $value) {

                    $lessons = $this->GetLessonByID($value->lesson_id);
                    $result[] = array(
                    'last_update'=>$lessons[0]->last_update,
                    'title'=>$lessons[0]->title,
                    'upload_url'=>$lessons[0]->upload_url,
                    'lesson_type'=>$lessons[0]->lesson_type
                    );
                }
            }
         }


        if($subject_id == "")
        {
            $this->operation->table_name = "lessons";
            $query = $this->operation->GetRows();
            $result = array();

            if(count($query))
            {
                foreach ($query as $key => $value) {
                    $result[] = array(
                        'last_update'=>$value->last_update,
                        'title'=>$value->title,
                        'upload_url'=>$value->upload_url,
                        'lesson_type'=>$value->lesson_type
                    );
                }
            }
        }
        echo json_encode($result);
    }

    function getClassInfoByName($className)
    {
        $is_class_found = $this->operation->GetRowsByQyery("Select c.* from classes c where c.grade = '".$className."'");
        if(count($is_class_found)){
            return $is_class_found[0]->id;
        }
        else{
            return false;
        }
    }

    function GetSubjectSchedule($subject_id,$class_id,$section_id)
    {
        // Making compatible to day based schedule
        $currentday = strtolower(date('D'));
        $s_time =  $currentday.'_start_time';
        $e_time =  $currentday.'_end_time';
        $is_schedule_found = $this->operation->GetRowsByQyery("Select s.* from schedule s where s.subject_id = ".$subject_id." AND s.class_id = ".$class_id." AND s.section_id = ".$section_id);
        if(count($is_schedule_found)){
            return array(
                    'start_time'=>$is_schedule_found[0]->$s_time,
                    'end_time'=>$is_schedule_found[0]->$e_time,
                    'last_update'=>$is_schedule_found[0]->last_update
            );
        }
        else{
            return false;
        }
    }

    function GetSubjectList_post()
    {
        try{

            // Overrid location when given
            if($this->post('school_id')){
                $this->operation->table_name = 'sessions';
                $active_session = $this->operation->GetByWhere(array('school_id'=>$this->post('school_id'),'status'=>'a'));

            }else{

            $locations = $this->session->userdata('locations');
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$locations[0]['school_id'],'status'=>'a'));
            }
             //   echo $this->db->last_query();exit();
            //var_dump($active_session);exit();

            $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            
            
        
            if($this->post('class_id'))
            {
                $class_id = $this->post('class_id');
              
                if(is_null($this->post('section_id')))
                {
                    $this->operation->table_name = "assignsections";
                    $query = $this->operation->GetByWhere(array('classid'=>$class_id,'status'=>'a'));
                    
                    $section_id = $query[0]->sectionid;
                    $this->operation->table_name = "subjects";
                $query = $this->operation->GetByWhere(array('class_id'=>$class_id));
                        
                }
                else{
                    $section_id = $this->post('section_id');
                    $this->operation->table_name = "subjects";
                    $query = $this->operation->GetByWhere(array('class_id'=>$class_id,'semsterid'=>$active_semester[0]->semester_id,'session_id'=>$active_session[0]->id));
                }
         
                $result = array();
                if(count($query))
                {
                    foreach ($query as $key => $value) {

                        $schedule = $this->GetSubjectSchedule($value->id,$class_id,$section_id);
                        $result[] = array(
                            'subject_id'=>$value->id,
                            'subject_code'=>$value->subject_code,
                            'subject_name'=>trim($value->subject_name),
                            'subject_image'=>$value->subject_image,
                             'start_time'=>($schedule != false ? $schedule['start_time'] : date('Y-m-d') ),
                             'end_time'=>($schedule != false ? $schedule['end_time'] : date('Y-m-d') ),
                            'last_update'=>$value->last_update,
                            'schedule_last_update'=>$schedule['last_update']
                        );
                    }
                    $this->response([
                        'status'=>true,
                        'message'=>$result
                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }else{
                     $this->set_response([
                'status' => FALSE,
                'message' => 'no subject found'
            ], REST_Controller::HTTP_OK); 
                }
            }

        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                'message' => 'no subject found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    
    function GetSubjectListUpdated_post()
    {
        try{
          
            if($this->post('school_id'))
            {
                $locations = $this->session->userdata('locations');
                $this->operation->table_name = 'sessions';
                $active_session = $this->operation->GetByWhere(array('school_id'=>$this->post('school_id'),'status'=>'a'));
                $this->operation->table_name = 'semester_dates';
                $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
                
                if($this->post('class_id'))
                {
                    $class_id = $this->post('class_id');
                    if($this->post('section_id'))
                    {
                        $section_id = $this->post('section_id');    
                    }
                    else{
                        $this->operation->table_name = "assignsections";
                        $query = $this->operation->GetByWhere(array('classid'=>$class_id));
                        $section_id = $query[0]->sectionid;
                    }
                    $this->operation->table_name = "subjects";
                    $query = $this->operation->GetByWhere(array('class_id'=>$class_id,'semsterid'=>$active_semester[0]->semester_id,'session_id'=>$active_session[0]->id));
                 
                    $result = array();
                    if(count($query))
                    {
                        foreach ($query as $key => $value) {
    
                            $schedule = $this->GetSubjectSchedule($value->id,$class_id,$section_id);
                            $result[] = array(
                                'subject_id'=>$value->id,
                                'subject_code'=>$value->subject_code,
                                'subject_name'=>trim($value->subject_name),
                                'subject_image'=>$value->subject_image,
                                 'start_time'=>($schedule != false ? date('Y-m-d H:i',$schedule['start_time']) : date('Y-m-d') ),
                                 'end_time'=>($schedule != false ? date('Y-m-d H:i',$schedule['end_time']) : date('Y-m-d') ),
                                'last_update'=>$value->last_update,
                                'schedule_last_update'=>$schedule['last_update']
                            );
                        }
                        $this->response([
                            'status'=>true,
                            'message'=>$result
                            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                    }else{
                         $this->set_response([
                    'status' => FALSE,
                    'message' => 'no subject found'
                ], REST_Controller::HTTP_OK); 
                    }
                }

            }
            
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                'message' => 'no subject found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function GetSubjectList_get()
    {

        $this->operation->table_name = "subjects";
        $query = $this->operation->GetRows();
        $result = array();

        if(count($query))
        {
            foreach ($query as $key => $value) {
                $schedule = $this->getSchedule($value->id,$class_id,$section_id);
                $result[] = array(

                    'subject_id'=>$value->id,
                        'subject_code'=>$value->subject_code,
                        'subject_name'=>trim($value->subject_name),
                        'subject_image'=>$value->subject_image,
                        'start_time'=>$schedule['start_time'],
                        'end_time'=>$schedule['end_time'],
                        'last_update'=>$value->last_update,
                        'schedule_last_update'=>$schedule['last_update']
                );
            }
        }

        echo json_encode($result);
    }

    function getSchedule($subject_id,$class_id,$section_id)
    {
        $currentday = strtolower(date('D'));
        $s_time =  $currentday.'_start_time';
        $e_time =  $currentday.'_end_time';
        $is_schedule_found = $this->operation->GetRowsByQyery("Select s.* from schedule s where s.subject_id = ".$subject_id." AND s.class_id = ".$class_id." AND s.section_id = ".$section_id);
        if(count($is_schedule_found)){
            return array('start_time'=>$is_schedule_found[0]->$s_time,
                'end_time'=>$is_schedule_found[0]->$e_time,
            'last_update'=>$is_schedule_found[0]->last_update);
        }
        else{
            return false;
        }
    }
    
    function GetClassList_get()
    {
        $this->operation->table_name = "classes";
        $query = $this->operation->GetRows();
        $result = array();

        if(count($query))
        {
            foreach ($query as $key => $value) {
                $result[] = array(
                    'id'=>$value->id,
                    'last_update'=>$value->last_update,
                    'grade'=>$value->grade
                  );
            }
        }
        echo json_encode($result);
    }

    function GetClassSectionList_post()
    {
        try{
            if($this->post('schoolid')){
                $this->operation->table_name = "classes";
                $query = $this->operation->GetByWhere(array('school_id' => $this->post('schoolid')));
                $result = array();

                if(count($query))
                {
                    foreach ($query as $key => $value) {
                        $is_section_found = $this->operation->GetRowsByQyery("SELECT asi.id as asisecid,s.* FROM assignsections asi INNER JOIN sections s ON s.id = asi.sectionid WHERE asi.classid =".$value->id);
                        $sectionarray = array();
                        if(count($is_section_found))
                        {
                            foreach ($is_section_found as $key => $svalue) {
                                $sectionarray[] = array(
                                    'id'=> $svalue->id,
                                    'section_name'=> $svalue->section_name,
                                    'last_update'=> $svalue->last_update,
                                );
                            }
                        }
                        $result[] = array(
                            'id'=>$value->id,
                            'last_update'=>$value->last_update,
                            'grade'=>$value->grade,
                            'section'=>$sectionarray
                          );
                    }
                }
                  $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code 
                }
            }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    //  function GetSchedule_get()
    // {
    //     $this->operation->table_name = "schedule";
    //     $query = $this->operation->GetRows();
    //     $result = array();

    //     if(count($query))
    //     {
    //         foreach ($query as $key => $value) {
    //             $result[] = array(
    //                 'last_update'=>$value->last_update,
    //                 'class_id'=>$value->class_id,
    //                 'section_id'=>$value->section_id,
    //                 'subject_id'=>$value->subject_id,
    //                 'teacher_uid'=>$value->teacher_uid,
    //                  'start_time'=>$value->start_time,
    //                   'end_time'=>$value->end_time
    //               );
    //         }
    //     }
    //     echo json_encode($result);
    // }

    function GetQuiz_post()
    {

        if($this->input->post('class_id') && $this->input->post('section_id')  && $this->input->post('subject_id')):
            $this->operation->table_name = "quize";
            $query = $this->operation->GetByWhere(array('classid'=>$this->input->post('class_id'),'sectionid'=>$this->input->post('section_id'),'subjectid'=>$this->input->post('subject_id')));
            $result = array();

            if(count($query))
            {
                $questionarray = array();
                foreach ($query as $key => $value) {
                    $this->operation->table_name = "quizequestions";
                    $questionquery = $this->operation->GetByWhere(array('quizeid'=>$value->id));
                    foreach ($questionquery as $key => $qvalue) {
                        $optionsarray = array();
                        $this->operation->table_name = "quizeoptions";
                        $optionlist = $this->operation->GetRowsByQyery("SELECT o.*,qo.last_update as last_update  FROM qoptions o INNER JOIN quizeoptions qo ON o.id = qo.qoption_id where qo.questionid =".$qvalue->id." order by id asc");
                        if(count($optionlist))
                        {
                            foreach ($optionlist as $key => $ovalue) {
                                if($qvalue->type == 't')
                                {

                                    $option = $ovalue->option_value;
                                }
                                else{
                                    $thumbname = explode('.', $ovalue->option_value);
                                    $option = base_url().'upload/option_images/'.$thumbname[0].'_thumb.'.$thumbname[1];
                                }

                                $optionsarray[] = array(
                                    'id'=>$ovalue->id,
                                    'option'=>$option,
                                    'last_update'=>$ovalue->last_update,
                                );
                            }
                        }

                        $this->operation->table_name = "correct_option";
                        $thumbname = '';
                        if(!is_null($qvalue->img_src)){
                            $thumbname = explode('.', $qvalue->img_src);
                        }

                        $correct_option = $this->operation->GetByWhere(array('question_id'=>$qvalue->id));

                        $questionarray[] = array(
                            'id'=>$qvalue->id,
                            'question'=>$qvalue->question,
                            'options'=>$optionsarray,
                            'type'=>$qvalue->type,
                            'last_update'=>$qvalue->last_update,
                            'correct'=>$correct_option[0]->correct_id,
                            'thumbnail'=>(count($thumbname) == 2 ? base_url().'upload/quiz_images/'.$thumbname[0].'_thumb.'.$thumbname[1] : ''),
                        );
                    }

                    $student_attempts = array();
                    $QuizProgress = $this->operation->GetRowsByQyery("Select * from quiz_evaluation where quizid=".$value->id);
                    if(count($QuizProgress))
                    {
                        foreach ($QuizProgress as $key => $qvalue) {
                            $is_student_found = $this->operation->GetRowsByQyery("Select * from user_meta where meta_key = 'roll_number' AND user_id = ".$qvalue->studentid);
                            if(count($is_student_found))
                            {
                                $student_attempts[] = array(
                                    'student_roll_no'=>$is_student_found[0]->meta_value,
                                    'qestionid'=>$qvalue->questionid,
                                    'optionid'=>$qvalue->optionid,
                                );
                            }
                        }
                    }

                    $result[] = array(
                        'id'=>$value->id,
                        'last_update'=>$value->last_update,
                        'classid'=>$value->classid,
                        'qname'=>$value->qname,
                        'subjectid'=>$value->subjectid,
                        'quiz_date'=>$value->quiz_date,
                        'sectionid'=>$value->sectionid,
                        'questions'=>$questionarray,
                        'student_attempts'=>$student_attempts

                    );
                }
            }
        endif;
         if(count($result)):
            $this->response($result, 201);
        else:
            $this->response(array('message' => false), 400);
        endif;
    }

    function GetQuestion_get()
    {
        $this->operation->table_name = "quizequestions";
        $query = $this->operation->GetRows();
        $result = array();

        if(count($query))
        {
            foreach ($query as $key => $value) {
                $result[] = array(
                    'id'=>$value->id,
                    'last_update'=>$value->last_update,
                    'quizeid'=>$value->quizeid,
                    'question'=>$value->question
                  );
            }
        }
        echo json_encode($result);
    }

    function GetQuesOption_get()
    {
        $this->operation->table_name = "quizeoptions";
        $query = $this->operation->GetRows();
        $result = array();

        if(count($query))
        {
            foreach ($query as $key => $value) {
                $result[] = array(
                    'id'=>$value->id,
                    'last_update'=>$value->last_update,
                    'questionid'=>$value->questionid,
                    'options'=>$value->options,
                    'iscorrect'=>$value->iscorrect
                );
            }
        }
        echo json_encode($result);
    }

    function GetLessonPlan_post()
    {
        try{
            $result = array();  
             $locations = $this->session->userdata('locations');
            $school_id = $locations[0]['school_id'];
            if($this->post('school_id'))
            {
                $school_id = $this->post('school_id');
            }
            
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$school_id,'status'=>'a'));


                $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            
             if(!empty($this->post('class_id')) && is_numeric($this->post('class_id')) &&  !empty($this->post('section_id') && is_numeric($this->post('section_id')) && !is_null($this->post('subject_id')) && is_numeric($this->post('subject_id'))))
            {
                $this->operation->table_name = "semester_lesson_plan";
                $query = $this->operation->GetByWhere(array(
                                                        'subjectid'=>$this->post('subject_id'),
                                                        'classid'=>$this->post('class_id'),
                                                        'sectionid'=>$this->post('section_id'),
                                                        'semsterid'=>$active_semester[0]->semester_id,
                                                        'sessionid'=>$active_session[0]->id
                                                        
                                                    ));
               
                if(count($query))
                {
                    foreach ($query as $key => $value) {
                         if($value->type && date('Y-m-d',strtotime($value->read_date) &&  date('Y-m-d',strtotime($value->read_date)) > date('Y-m-d',strtotime('1970-01-01'))))
                            {
                             $result[] = array(
                            'id' => $value->id,
                            'name'=>$value->concept,
                            'content'=>$value->content,
                            'notes'=>$value->topic,
                            'read_date' => $value->read_date,
                            'type'=>$value->type,
                            'last_update'=>$value->last_update,
                            'preference'=>$value->preference
                        );
                            }
                       
                    }
                    $this->response($result, REST_Controller::HTTP_OK);
                }
                else{
                    $this->set_response([
                    'status' => FALSE,
                        'message' => 'no lesson found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    
       function GetPreSchedularData_post()
    {
        try{
            
            $result = array();  
            if(!is_null($this->post('class_id')) && is_numeric($this->post('class_id')) && !is_null($this->post('section_id')) && is_numeric($this->post('section_id')) && !is_null($this->post('studentid')) && is_string($this->post('studentid')))
            {
                
                $locations = $this->session->userdata('locations');
                $school_id = $locations[0]['school_id'];
                if($this->post('school_id'))
                {
                    $school_id = $this->post('school_id');
                }
            
                $this->operation->table_name = 'sessions';
                $active_session = $this->operation->GetByWhere(array('school_id'=>$school_id,'status'=>'a'));


                $this->operation->table_name = 'semester_dates';
                $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            
         
                $query = $this->operation->GetRowsByQyery("SELECT 
                    s.id as lessonid,s.read_date, lp.count as totalnumber, 
                    lp.status as read_status,lp.last_updated as readed_dated, s.subjectid as subjectid
                    FROM semester_lesson_plan s 
                    INNER JOIN lessonprogress lp On lp.lessonid = s.id
                    INNER JOIN invantageuser iu On iu.id = lp.studentid
                    where
                    s.classid = ".$this->post('class_id')." AND
                    s.sectionid = " . $this->post('section_id')." AND
                    s.semsterid =".$active_semester[0]->semester_id." AND
                    s.sessionid = ".$active_session[0]->id." AND
                    iu.username = '".$this->post('studentid')."'");
  
                if(count($query))
                {
                    foreach ($query as $key => $value) {
                     
                        $result[] = array(
                            'subjectid'=>$value->subjectid,
                            'lesson_id' => $value->lessonid,
                            'lesson_date'=>$value->read_date,
                            'lesson_record_date'=>$value->readed_dated,
                            'lesson_modified_date'=>$value->readed_dated,
                            'roll_no' => $this->post('studentid'),
                            'read_count'=>$value->totalnumber,
                            'is_read'=>($value->totalnumber > 0 ? true : false),
                        );
                        
                    }
                    $this->response([
                    'status' => true,
                        'message' => $result
                    ], REST_Controller::HTTP_OK);
                }
                else{
                    $this->set_response([
                    'status' => FALSE,
                        'message' => 'no lesson found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    
    

    function GetLessonPlanByApp_post()
    {
        try{
            $result = array(); 
            $locations = $this->session->userdata('locations');
            $school_id = $locations[0]['school_id'];
            if($this->post('school_id'))
            {
                $school_id = $this->post('school_id');
            }
            
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$school_id,'status'=>'a'));


                $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            
             if(!is_null($this->post('class_id')) && is_numeric($this->post('class_id')) &&  !is_null($this->post('subject_id')) && is_numeric($this->post('subject_id')))
            {
                $this->operation->table_name = "semester_lesson_plan";
                if($this->post('section_id'))
                {
                    $query = $this->operation->GetByWhere(array(
                                                        'subjectid'=>$this->post('subject_id'),
                                                        'classid'=>$this->post('class_id'),
                                                        'sectionid'=>$this->post('section_id'),
                                                    ));
                }
                else{
                     $this->operation->table_name = "assignsections";
                    $query = $this->operation->GetByWhere(array(
                                                        'classid'=>$this->post('class_id'),
                                                        'status'=>'a'
                                                    ));
                    if(count( $query))
                    {

                     $this->operation->table_name = "semester_lesson_plan";
                     $query = $this->operation->GetByWhere(array(
                                                        'subjectid'=>$this->post('subject_id'),
                                                        'classid'=>$this->post('class_id'), 
                                                        'sectionid'=>$query[0]->sectionid,
                                                    ));
  
                    }
                    
                }

                $locations = $this->session->userdata('locations');
                

         
                
                if($this->post('section_id') && $this->post('mode'))
                {
                    $query = $this->operation->GetRowsByQyery("Select * from semester_lesson_plan where subjectid=".$this->post('subject_id')." AND classid = ".$this->post('class_id')." AND sectionid =".$this->post('section_id')." AND semsterid = ".$active_semester[0]->semester_id." AND sessionid = ".$active_session[0]->id." AND read_date <> ''  Order By read_date");
                }
               
                if(count($query))
                {
                    if($this->post('mode') == 3 || $this->post('mode') == 2)
                    {
                        $data = $this->post('studentlist');
                        if(count($data) == 1)
                        {
                            $last_id = $this->GetProgressByStudent($this->post('class_id'),$this->post('section_id'),$this->post('subject_id'),$data[0]['id']);
                            $enabled_lesson_id = $last_id[0]['id'];
                        }
                        else{
                            $last_id = $this->GetProgressBySubject($this->post('class_id'),$this->post('section_id'),$this->post('subject_id'));
                            $enabled_lesson_id = $last_id[0]['id'];  
                        }      
                    }

                    foreach ($query as $key => $value) {
                        $is_readed = false;
                        $is_diabled = true;
                        $is_blinking = false;
                        if($this->post('studentlist'))
                        {
                           $data = $this->post('studentlist');
                            if(count($data) == 1)
                            {
                                $studentid = $data[0]['id'];
                                
                                if(count($this->CheckisReadedLesson($value->id,$studentid)))
                                {
                                    $is_readed = true;
                                }
                            }else{
                                $is_lesson_found = $this->SearchClassGroupReocrd($this->post('class_id'),$this->post('section_id'),$value->id);

                                if(count($is_lesson_found) > 0)
                                {
                                    $is_readed = true;

                                }
                            } 
                        }

                        if($this->post('role') == 'g' || $this->post('mode') == 2)
                        {
                            $is_readed = false;
                            $is_diabled = false;
                        }else{
                            $is_blinking = ($value->id == $enabled_lesson_id ? true : false );
                            $is_diabled = (($value->id == $enabled_lesson_id || $is_readed) ? false : true );
                        }

                        if($value->type &&  date('Y-m-d',strtotime($value->read_date)) >
                            date('Y-m-d',strtotime('1970-01-01')))
                        {
                            if($this->TypeChecking($value->type,$value->content) == true)
                            {
                                $result[] = array(
                                    'id' => $value->id,
                                    'name'=>ucfirst($value->concept),
                                    'content'=>$value->content,
                                    'notes'=>$value->topic,
                                    'read_date' => $value->read_date,
                                    'type'=>$value->type,
                                    'last_update'=>$value->last_update,
                                    'preference'=>$value->preference,
                                    'lesson_readed'=>$is_readed,
                                    'bliking'=> $is_blinking ,
                                    'disabled'=>$is_diabled 
                                );
                            }
                            
                        }
                        
                    }
                    $this->response([
                    'status' => true,
                        'message' => $result
                    ], REST_Controller::HTTP_OK);
                }
                else{
                    $this->set_response([
                    'status' => FALSE,
                        'message' => 'no lesson found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function TypeChecking($type,$content)
    {
        $image_array = array("jpg", "png", "gif", "bmp","jpeg");
        $video_array = array("mp4","flv","avi");
        $document_array = array('doc','pdf','xls','xlsx','docx',"ppt","pptx");
        $app_array = array('doc','pdf','xls','xlsx','docx');
        $type_matched = false;
        switch ($type) {
            case 'Image':
                    if(in_array(strtolower(pathinfo($content,PATHINFO_EXTENSION )),$image_array))
                    {
                        $type_matched = true;
                    }
                break;
                
            case 'Video':
                    if(in_array(strtolower(pathinfo($content,PATHINFO_EXTENSION )),$video_array))
                    {
                        $type_matched = true;
                    }
                break;

            case 'Document':
                    if(in_array(strtolower(pathinfo($content,PATHINFO_EXTENSION )),$document_array))
                    {
                        $type_matched = true;
                    }
                break;

            case 'Application':
                    if(in_array(strtolower(pathinfo($content,PATHINFO_EXTENSION )),$app_array))
                    {
                        $type_matched = true;
                    }
                break;
        }

        return $type_matched ;
    }

    /**
     * Get lesson read statud
     * @param [type] $lessonid  [description]
     * @param [type] $studentid [description]
     */
    function CheckisReadedLesson($lessonid,$studentid)
    {
        $this->operation->table_name = "lessonprogress";
        return $this->operation->GetByWhere(array('studentid'=>$studentid,'lessonid'=>$lessonid,'status'=>'read'));
    }

    function GetStudentLastReadId($studentid)
    {
       return  $this->operation->GetRowsByQyery("Select * from lessonprogress where studentid=".$studentid." Order by last_updated desc limit 1");
    }

    function GetAllLessonBySubject($classid,$sessionid,$subjectid)
    {
        $is_lesson_found = $this->operation->GetRowsByQyery("Select * from lessonprogress where subjectid=".$subjectid." AND classid = ".$classid." AND sectionid =".$sessionid." Order By preference"); 
    }

    function GetProgressBySubject($classid,$sectionid,$subjectid)
    {
        $not_readed_lessons = array();
        try{
            
            $is_lesson_found = $this->operation->GetRowsByQyery("Select * from semester_lesson_plan where subjectid=".$subjectid." AND classid = ".$classid." AND sectionid =".$sectionid." AND read_date <> '' And content <> '' AND read_date <= '".date('Y-m-d')."'  Order By read_date");
            if(count($is_lesson_found)){
                $progress_list = $this->operation->GetRowsByQyery("Select * from class_group where  class_id = ".$classid." AND section_id =".$sectionid." AND status = 'r'");
              
                if(count($progress_list))
                {
                    foreach ($is_lesson_found as $key => $value) {
                       
                        if($this->in_multiarray($value->id, $progress_list) == false)
                        {   
                            $not_readed_lessons[] = array(
                                'id'=>$value->id
                            );
                        }
                       
                    }
                }
                else{
                    $not_readed_lessons[] = array(
                        'id'=>$is_lesson_found[0]->id
                    );
                }
            }
            
            return $not_readed_lessons; 
        }
        catch(Exception $e){
            
        }
        
    }

    function GetProgressByStudent($classid,$sectionid,$subjectid,$studentid)
    {
        try{
        $not_readed_lessons = array();
        $is_lesson_found = $this->operation->GetRowsByQyery("Select * from semester_lesson_plan where subjectid=".$subjectid." AND classid = ".$classid." AND sectionid =".$sectionid." AND read_date <> '' And content <> '' AND read_date <= '".date('Y-m-d')."'  Order By read_date");
        if(count($is_lesson_found)){
            $progress_list = $this->operation->GetRowsByQyery("Select * from lessonprogress where  studentid = ".$studentid." AND status = 'read'");
            
            if(count($progress_list))
            {
               foreach ($is_lesson_found as $key => $value) {
               
                    if($this->in_multiarray($value->id, $progress_list) == false)
                    {
                        $not_readed_lessons[] = array(
                            'id'=>$value->id
                        );
                    }
                } 
            }
            else{
                $not_readed_lessons[] = array(
                    'id'=>$is_lesson_found[0]->id
                );
            }
            
        }
        return $not_readed_lessons; 
        }
        catch(Exception $e){}
    }

    function in_multiarray($elem, $array)
    {
        try{
            foreach ($array as $key => $value) {
                if($value->lessonid == $elem)
                {
                    return true;
                }
            }
            return false;
        }
        catch(Exception $e){
            return true;
        }
    }

    function GetDefaultLessonPlan_get()
    {
     $this->operation->table_name = "defaultlessonplan";
            $query = $this->operation->GetRows();
        //echo $this->db->last_query();
        $result = array();
        if(count($query))
        {
            foreach ($query as $key => $value) {
                $result[] = array(
                    'id' => $value->id,
                    'name'=>$value->concept,
                    'uploaded_url'=>$value->content,
                    'notes'=>$value->topic,
                    'date' => $value->date,
                    'type'=>$value->type,
                    'last_update'=>$value->last_update
                );
            }
        }
        echo json_encode($result);
    }


    function SetLessonProgress_post()
    {
        $result['message'] = false;
        try{
            if($this->post('type') == 'a')
            {
                $postdata = file_get_contents("php://input");
                $request = json_decode($postdata);
                $progress_array = $request->lesson_progress;
            }
            else
            {
                $progress_array = json_decode($this->post('lesson_progress'));
            }
                

            if(count($progress_array) && $this->post('type'))
            {
                foreach ($progress_array as $key => $value) {
                    $is_student_found = $this->operation->GetRowsByQyery("Select * from invantageuser where username= '".$value->student_roll_no."'");
                    if(count($is_student_found)){
                        $this->operation->table_name = 'lessonprogress';
                        $is_lesson_read = $this->operation->GetRowsByQyery("Select * from lessonprogress where lessonid = ".$value->lesson." AND studentid =".$is_student_found[0]->id);
                        $is_lesson_found = $this->operation->GetRowsByQyery("Select * from semester_lesson_plan where id = ".$value->lesson);
                        if(count($is_lesson_read) == 0 && count($is_lesson_found))
                        {
                           $lesson_progress = array(
                                'studentid'=>$is_student_found[0]->id,
                                'lessonid'=>$value->lesson,
                                'status'=>($value->lesson_read == 1 ? 'read' : 'unread'),
                                'count'=>($value->lesson_count ? $value->lesson_count :1),
                                'last_updated'=>date('Y-m-d h:i:s'),
                            );

                            $this->operation->table_name = 'lessonprogress';
                            $is_value_saved = $this->operation->Create($lesson_progress);
                        }
                        else{
                             $groupinfo = $this->operation->GetByWhere(array(
                                'lessonid'=>$value->lesson
                            ));
                            $defaultcount = 1;
                            if(count($groupinfo))
                            {
                                $defaultcount = $groupinfo[0]->count + 1;
                            }
                            

                           $student_progress = array(
                                'status'=>( $value->lesson_read == 1 ? 'read' : 'pending'),
                                'count'=>$defaultcount,
                                'last_updated'=>date('Y-m-d h:i:s'),
                            );

                            $is_value_saved = $this->operation->Create($student_progress,$is_lesson_read[0]->id);
                        }

                        if(count($is_value_saved))
                        {
                            $result['message'] = true;
                        }
                    }
                }
            }
            else{
                $this->set_response([
                'status' => FALSE,
                    'message' => 'input parms not completed'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        catch(Exception $e){
            $result['message'] =  $e->getMessage();
        }

        if($result['message'] == true)
        {
            $this->response($result, 201);
        }
        else
        {
            $this->response(array('message' => 'false'), 400);
        }
    }

    function SetQuizProgress_post()
    {
        try{
            $result['message'] = false;
            $progress_array = json_decode($this->input->post('quiz_progress'));

            if(count($progress_array))
            {
                foreach ($progress_array as $key => $value) {
                    $is_student_found = $this->operation->GetRowsByQyery("Select * from invantageuser where username = '".$value->student_roll_no."'");
                    if(count($is_student_found)){
                        $this->operation->table_name = 'quiz_evaluation';
                        foreach ($value->result_evaluation as $key => $rvalue) {

                            $query = $this->operation->GetByWhere(array(
                                        'studentid'=>$is_student_found[0]->id,
                                        'quizid'=>$value->quiz_id,
                                        'questionid'=>$rvalue->question_id,
                                    ));
                            $is_quiz_found = $this->operation->GetRowsByQyery("Select * from quize where id = ".$value->quiz_id);

                            if(count($query) == false && count($is_quiz_found))
                            {
                                  $student_progress = array(
                                    'studentid'=>$is_student_found[0]->id,
                                    'quizid'=>$value->quiz_id,
                                    'questionid'=>$rvalue->question_id,
                                    'optionid'=>$rvalue->selected_option_id,
                                );
                                $is_value_saved = $this->operation->Create($student_progress);
                                if(count($is_value_saved))
                                {
                                    $result['message'] = true;
                                }
                            }
                            else{
                                $result['message'] = true;
                            }
                        }
                    }
                }
            }
             if($result['message'] == true)
            {
                 $this->response($result, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response($result, REST_Controller::HTTP_NOT_FOUND);
            }
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                'message' => 'Invalid input'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function GetVersion_get()
    {
        $this->operation->table_name = "versions";
        $query = $this->operation->GetByWhere(array(
                                            'status'=>'a',
                                        ));
        $result = array();
        if(count($query))
        {
            foreach ($query as $key => $value) {
                $result[] = array(
                    'id' => $value->id,
                    'version'=>$value->version,
                    'app_url'=>$value->app_url,
                );
            }
        }
        echo json_encode($result);
    }

    function GetLMSMode_post()
    {
        $data=$this->operation->GetRowsByQyery('select * from releaseshedulle');
        $LMSMode=$array();
        if(!count($data))
        {
            foreach ($data as $key => $value)
             {
                $LMSMode=array(
                        'lmsmode'=>$value->t_status,

                    );
            }

        }
        echo json_encode($LMSMode);
    }

    function GetLocations_get()
    {
        if(!empty($this->get('location')) && !is_null($this->get('location')))
        {
            $is_location_found=$this->operation->GetRowsByQyery('SELECT s.id as schoolid,s.name,l.id as cityid, l.location FROM schools s INNER JOIN location l ON l.id = s.cityid WHERE l.id= '.$this->get("location"));
        }
        else{
            $is_location_found=$this->operation->GetRowsByQyery('SELECT s.id as schoolid,s.name,l.id as cityid, l.location FROM schools s INNER JOIN location l ON l.id = s.cityid ORDER BY l.location');
        }
                                        
        $result = array();
        if(count($is_location_found))
        {
            foreach ($is_location_found as $key => $value) {
                $result[] = array(
                    'cityid' => $value->cityid,
                    'city'=>$value->location,
                    'schoolid'=>$value->schoolid,
                    'school'=>$value->name,
                );
            }
        }
        echo json_encode($result);
    }

    /**
     * Get class info by school teacher
     *
     * @param int schoolid 
     *
     * @return json array
     */
    function GetSchoolClassInfo_get()
    {
        if($this->session->userdata('id') || $this->session->userdata('uroles') == 'g')
        {
            if($this->session->userdata('uroles') == 'g')
            {
                $this->operation->table_name = "location";
                $first_location = $this->operation->GetByWhere(array('location' => "Lahore"));

                $this->operation->table_name = "classes";
                $query = $this->operation->GetByWhere(array('school_id' => 1));
            }   
            else
            {
                $this->operation->table_name = "classes";
                $location = $this->session->userdata('locations');
                $query = $this->operation->GetByWhere(array('school_id' => $location[0]['school_id']));
            }
                  
            $result = array();
            if(count($query))
            {
                foreach ($query as $key => $value) {
                    $is_section_found = $this->operation->GetRowsByQyery("SELECT asi.id as asisecid,s.* FROM assignsections asi INNER JOIN sections s ON s.id = asi.sectionid WHERE asi.classid =".$value->id);
                    $sectionarray = array();
                    if(count($is_section_found))
                    {
                        foreach ($is_section_found as $key => $svalue) {
                            $sectionarray[] = array(
                                'id'=> $svalue->id,
                                'section_name'=> $svalue->section_name,
                                'last_update'=> $svalue->last_update,
                            );
                        }
                    }
                    $result[] = array(
                        'id'=>$value->id,
                        'last_update'=>$value->last_update,
                        'grade'=>$value->grade,
                        'section'=>$sectionarray
                      );
                }
            
            }

            if(count($result))
            {
                 $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
             }
             else
             {
                 $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    /**
      * Get student list
      *
      * @param int classid 
      * @param int sectionid
      * 
      * @return json array
      */
    public function GetStudentListByRestAPI_post()
    {
        try{
            
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $classid =$this->security->xss_clean(html_escape($request->classid));
            $sectionid =$this->security->xss_clean(html_escape($request->sectionid));
            $locations = $this->session->userdata('locations');
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$locations[0]['school_id'],'status'=>'a'));

            $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            $query=$this->operation->GetRowsByQyery("SELECT inv.* FROM invantageuser inv inner join student_semesters ss on inv.id=ss.studentid where ss.classid=".$classid." and ss.sectionid= ".$sectionid." AND ss.semesterid = ".$active_semester[0]->semester_id." AND ss.sessionid = ".$active_session[0]->id." and ss.status='r'  and user_active_status=1  and inv.type='s'");
            $result =array();

            if(count($query))
            {
                foreach ($query as $key => $value) {
                    $classInfo = $this->getUserMeta($value->id,'sgrade');

                    $this->operation->primary_key = 'id';
                    $this->operation->table_name = 'sections';
                    $sectioninfo = $this->operation->GetByWhere(array('id'=>$classInfo));

                    $classinfodetail = $this->operation->GetRowsByQyery('SELECT ss.classid,c.grade,ss.sectionid,ss.semesterid,s.section_name FROM student_semesters ss INNER JOIN classes c on c.id = ss.classid INNER JOIN sections s on s.id = ss.sectionid  where ss.status = "r" AND ss.studentid = '.$value->id);
                  
                    if(count($classinfodetail))
                    {
                        $result[] = array(
                            'id'=>$value->id,
                            'roll_no'=>$value->username,
                            'student_name'=>$this->getUserMeta($value->id,'sfullname')." ".$this->getUserMeta($value->id,'slastname'),
                            'password'=>$value->password,
                            'class'=> $classinfodetail[0]->grade,
                            'class_id'=>$classinfodetail[0]->classid,
                            'section_id'=>$classinfodetail[0]->sectionid,
                            'section'=> section_name,
                            'campus' => null,
                            'profile_link'=> $value->profile_image,
                        );
                    }
                }
            }
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function SearchStudentReocrd($studentid,$lessonid)
    {
        return  $this->operation->GetRowsByQyery("Select * from lessonprogress where studentid=".$studentid." AND lessonid = ".$lessonid." AND status = 'read'");
    }

    function SearchClassGroupReocrd($classid,$sectionid,$lessonid)
    {

        return  $this->operation->GetRowsByQyery("Select * from class_group where  class_id = ".$classid." AND section_id =".$sectionid." AND lessonid = ".$lessonid);
    }

     function GetLessonSubject($subjectid)
    {
        return $this->operation->GetRowsByQyery("Select * from subjects  where id = ".$subjectid);
    }

    /**
      * Get today lesson list
      *
      * @param int classid 
      * @param int sectionid
      * 
      * @return json array
      */
    public function GetTodayLessons_post()
    {
        try{
            
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $classid =$this->security->xss_clean(html_escape($request->classid));
            $sectionid =$this->security->xss_clean(html_escape($request->sectionid));
            $status =$this->security->xss_clean(html_escape($request->status));
            $subject =$this->security->xss_clean(html_escape($request->subject));
            $result =array();

            // find current period
            if($this->post('subject')){
                
                // Students check
                $studentlist = $this->post('studentlist');
                
                if(count($studentlist) == 1)
                {
                    $last_id = $this->GetProgressByStudent($classid,$sectionid,$subject,$studentlist[0]['id']);
                    
                    
                    if(count($last_id))
                    {

                        $is_student_lessons_not_readed = $this->operation->GetRowsByQyery("Select * from semester_lesson_plan where subjectid=".$subject." AND classid = ".$classid." AND sectionid =".$sectionid." AND id >= ".$last_id[0]['id']." AND read_date <='".date('Y-m-d')."' And content <> '' order by read_date,preference Asc");
                    }
                    
                    if(count($is_student_lessons_not_readed))
                    {
                        
                        $enabled_lesson_id = $last_id[0]['id'];
                        foreach ($is_student_lessons_not_readed as $key => $lvalue) {
                            if($lvalue->type &&  date('Y-m-d',strtotime($lvalue->read_date)) > date('Y-m-d',strtotime('1970-01-01')))
                            {
                                if($this->TypeChecking($lvalue->type,$lvalue->content) == true)
                                {
                                    $is_lesson_found = $this->SearchStudentReocrd($studentlist[0]['id'],$lvalue->id);

                                    $subject = $this->GetLessonSubject($lvalue->subjectid);
                                    
                                  
                                    $is_readed = false;
                                    $is_diabled = true;
                                    $is_blinking = false;

                                    if(count($is_lesson_found))
                                    {
                                        $is_readed = true;
                                        $is_blinking = false;
                                        $is_diabled = false;
                                    }
                                    
                                    $is_diabled = (($lvalue->id == $enabled_lesson_id || $is_readed) ? false : true );
                                    $subject = $this->GetLessonSubject($lvalue->subjectid);

                                     $result[] = array(
                                        'id'=>$lvalue->id,
                                        'content'=>$lvalue->content,
                                        'name'=>$lvalue->concept,
                                        'type'=>$lvalue->type,
                                        'read_date'=>$lvalue->read_date,
                                        'subject'=>trim($subject[0]->subject_name),
                                        'lesson_readed'=>$is_readed,
                                        'bliking'=> $is_blinking ,
                                        'disabled'=>$is_diabled 
                                    );
                                }
                            }
                        } 
                        $this->response([
                            'status' => true,
                            'message' => 'lessons found',
                            'result'=>$result
                        ], REST_Controller::HTTP_OK);
                    }else{
                        $this->set_response([
                            'status' => FALSE,
                            'message' => 'lessons not found',
                        ], REST_Controller::HTTP_OK);
                    }
                }
                else{
                    
                    $last_id = $this->GetProgressBySubject($this->post('classid'),$this->post('sectionid'),$this->post('subject'));
                    if(count($last_id))
                    {
                        $is_student_lessons_not_readed = $this->operation->GetRowsByQyery("Select * from semester_lesson_plan where subjectid=".$subject." AND classid = ".$classid." AND sectionid =".$sectionid." AND id >= ".$last_id[0]['id']." AND read_date <= '".date('Y-m-d')."' And content <> '' order by read_date,preference Asc");
                        $enabled_lesson_id = $last_id[0]['id'];    
                    }
                     
                    if(count($is_student_lessons_not_readed))
                    {
                        foreach ($is_student_lessons_not_readed as $key => $lvalue) {
                            if($lvalue->type &&  date('Y-m-d',strtotime($lvalue->read_date)) > date('Y-m-d',strtotime('1970-01-01')))
                            {
                                if($this->TypeChecking($lvalue->type,$lvalue->content) == true)
                                {
                                    $is_lesson_found = $this->SearchClassGroupReocrd($classid,$sectionid,$lvalue->id);
                                    $is_readed = false;
                                    $is_diabled = true;
                                    $is_blinking = false;

                                    if(count($is_lesson_found))
                                    {
                                        $is_readed = true;
                                        $is_blinking = false;
                                        $is_diabled = false;
                                    }
                                    
                                    $is_diabled = (($lvalue->id == $enabled_lesson_id || $is_readed) ? false : true );
                                    $subject = $this->GetLessonSubject($lvalue->subjectid);

                                     $result[] = array(
                                        'id'=>$lvalue->id,
                                        'content'=>$lvalue->content,
                                        'name'=>$lvalue->concept,
                                        'type'=>$lvalue->type,
                                        'read_date'=>$lvalue->read_date,
                                        'subject'=>trim($subject[0]->subject_name),
                                        'lesson_readed'=>$is_readed,
                                        'bliking'=> $is_blinking ,
                                        'disabled'=>$is_diabled 
                                    );
                                }
                            }
                        } 
                        $this->response([
                            'status' => true,
                            'message' => 'lessons found',
                            'result'=>$result,
                        ], REST_Controller::HTTP_OK);
                    }
                    else{
                        $this->set_response([
                            'status' => FALSE,
                            'message' => 'lessons not found',
                        ], REST_Controller::HTTP_OK);
                    }
                }
            }else{
                 $this->set_response([
                    'status' => FALSE,
                    'message' => 'break',
                    'nextperiod' => 'break'
                ], REST_Controller::HTTP_OK);
            }

            // $school_off=$this->operation->GetRowsByQyery("
            //         SELECT s.end_time FROM schedule s  
            //        where s.class_id=".$classid." and s.section_id= ".$sectionid);
            // asort($school_off);
            // $hours = array();
            // foreach ($school_off as $key => $value) {
            //     $hours[] = array(
            //         'hour'=>date('H:i',$value->end_time),
            //         'start_time'=>date('H:i',$value->start_time)
            //     );
            // }
            // rsort($hours);
           
            // // if no result found means school is off
            // if(date('H:i') > date('H:i',strtotime($hours[0]['hour'])) || date('D') == 'Sat' || date('D') == 'Sun')
            // {
            //     $this->set_response([
            //         'status' => FALSE,
            //         'message' => 'timefree'
            //     ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

            // }
            // else if(date('H:i') < date('H:i',strtotime($hours[count($hours) - 1]['start_time'])))
            // {
            //     $this->set_response([
            //         'status' => FALSE,
            //         'message' => 'daynotstarted'
            //     ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            // }
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function GetSubjectName($subjectid)
    {
        return $this->operation->GetRowsByQyery("Select * from subjects where id = ".$subjectid);
    }

    /**
     * Get grade schedule list
     *
     * @return json array
     */
    function GetPeriodSchedule_post()
    {
        try{
            $currentday = strtolower(date('D'));
            $s_time =  $currentday.'_start_time';
            $e_time =  $currentday.'_end_time';
            date_default_timezone_set("Asia/Karachi");
            if($this->post('classid') && $this->post('sectionid'))
            {
                $school_off=$this->operation->GetRowsByQyery("
                        SELECT s.* FROM schedule s  
                        where s.class_id=".$this->post('classid')." and s.section_id= ".$this->post('sectionid')." order by s.$s_time");
             
                if(count($school_off))
                {
                    $result = array();
                    $have_any_period_found = false;
                    foreach ($school_off as $key => $value) {
                        $currentperiod = false;
                        $subjectname = trim($this->GetSubjectName($value->subject_id));
                        //$start_time = date('Y-m-d H:i',$value->start_time);
                        //$end_time = date('Y-m-d H:i',$value->end_time);
                        $currentday = strtolower(date('D'));
                        $s_time =  $currentday.'_start_time';
                        $e_time =  $currentday.'_end_time';
                        $start_time = date('Y-m-d H:i',$value->$s_time);
                        $end_time = date('Y-m-d H:i',$value->$e_time);
                        if( date('H:i') >= date('H:i',strtotime($start_time))  && date('H:i') <= date('H:i',strtotime($end_time))){
                            $currentperiod = true;
                            $have_any_period_found = true;
                        }

                        $subjectname = $this->GetSubjectName($value->subject_id);
                        $result[] = array(
                            'id'=>$value->id,
                            'subject_id'=>$value->subject_id,
                            'start_time'=>date('Y-m-d H:i',$value->$s_time),
                            'end_time'=>date('Y-m-d H:i',$value->$e_time),
                            'currentperiod'=>$currentperiod,
                            'subject'=>trim(ucfirst($subjectname[0]->subject_name))
                        );
                    }

                    if($have_any_period_found == true)
                    {
                        $this->response([
                            'status' => true,
                            'message' => 'lessons found',
                            'result'=>$result
                        ], REST_Controller::HTTP_OK);  
                    }
                    else
                    {
                        asort($school_off);
                        $hours = array();

                        foreach ($school_off as $key => $value) {
                            $subjectname = $this->GetSubjectName($value->subject_id);
                            $currentday = strtolower(date('D'));
                            $s_time =  $currentday.'_start_time';
                            $e_time =  $currentday.'_end_time';

                            $hours[] = array(
                                'hour'=>date('H:i',strtotime($value->$e_time)),
                                'start_time'=>date('H:i',strtotime($value->$s_time)),
                                'subject_id'=>$value->subject_id,
                                'subject'=>trim(ucfirst($subjectname[0]->subject_name))
                            );
                        }
                        rsort($hours);
                       
                        if(date('H:i') >= $hours[0]['hour'])
                        {
                             $this->response([
                                'status' => false,
                                'message' => 'dasyisoff',
                            ], REST_Controller::HTTP_OK);
                        }
                        else
                        {
                            asort($school_off);
                            $hours = array();
                            foreach ($school_off as $key => $value) {
                                $subjectname = $this->GetSubjectName($value->subject_id);
                                $currentday = strtolower(date('D'));
                                $s_time =  $currentday.'_start_time';
                                $e_time =  $currentday.'_end_time';
                                $hours[] = array(
                                    'hour'=>date('H:i',strtotime($value->$e_time)),
                                    'start_time'=>date('H:i',strtotime($value->$s_time)),
                                    'subject_id'=>$value->subject_id,
                                    'subject'=>trim(ucfirst($subjectname[0]->subject_name))
                                );
                            }
                            asort($hours);
                        
                            $result = array();
                            $have_any_period_found = false;

                            foreach ($hours as $key => $value) {
                                if( $value['start_time']  > date('H:i') && $have_any_period_found == false){
                                    $have_any_period_found = true;
                                    $subjectname = $this->GetSubjectName($value['subject_id']);
                                    $currentday = strtolower(date('D'));
                                    $s_time =  $currentday.'_start_time';
                                    $e_time =  $currentday.'_end_time';
                                    $result[] = array(
                                        'subject_id'=>$value['subject_id'],
                                        'start_time'=>date('Y-m-d H:i',strtotime($value['start_time'])),
                                        'end_time'=>date('Y-m-d H:i',strtotime($value['hour'])),
                                        'subject'=>trim(ucfirst($subjectname[0]->subject_name))
                                    );
                                }
                            }

                            $this->response([
                                'status' => false,
                                'message' => 'break',
                                'result'=>$result
                            ], REST_Controller::HTTP_OK);  
                        }
                    }
                }
                else{
                    
                                $this->set_response([
                'status' => FALSE,
                    'message' => 'no timetable'
                ], REST_Controller::HTTP_OK);
                }
            }
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no timetable'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function GetCurrentServerTime_get()
    {
         $this->response([
                    'status' => true,
                    'result'=>date('Y-m-d H:i')
                ], REST_Controller::HTTP_OK);  
    }
    /**
     * Save lesson read status of class group
     */
    public function SetClassLessonReadStatus_post()
    {
        try{
            
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $classid =$this->security->xss_clean(html_escape($request->classid));
            $sectionid =$this->security->xss_clean(html_escape($request->sectionid));
            $lessonid =$this->security->xss_clean(html_escape($request->lessonid));
    
            $result =array();

            if($classid && $sectionid && $lessonid)
            {
                $this->operation->table_name = 'class_group';
                $groupinfo = $this->operation->GetByWhere(array(
                    'class_id'=>$classid,
                    'section_id'=>$sectionid,
                    'lessonid'=>$lessonid
                ));
                $defaultcount = 1;
                if(count($groupinfo))
                {
                    $defaultcount = $groupinfo[0]->count + 1;
                     $lesson_progress = array(
                        'count'=>$defaultcount,
                        'readed'=>date('Y-m-d h:i:s'),
                        'readed_device'=>'w'
                    );
                    
                    $is_value_saved = $this->operation->Create($lesson_progress,$groupinfo[0]->id);
                }
                else{
                     $lesson_progress = array(
                        'class_id'=>$classid,
                        'section_id'=>$sectionid,
                        'lessonid'=>$lessonid,
                        'count'=>$defaultcount,
                        'status'=>'r',
                        'readed'=>date('Y-m-d h:i:s'),
                        'readed_device'=>'w'
                    );
                    
                    $is_value_saved = $this->operation->Create($lesson_progress);
                }
               
                if(count($is_value_saved))
                {
                    if($this->post('studentlist'))
                    {
                        $data = $this->post('studentlist');
                        foreach ($data as $key => $value) {
                            $is_lesson_found = $this->operation->GetRowsByQyery("Select * from lessonprogress  where studentid = ".$value['id']." AND lessonid =".$lessonid);
                            if(count($is_lesson_found) == 0)
                            {

                                $student_progress = array(
                                    'studentid'=>$value['id'],
                                    'lessonid'=>$lessonid,
                                    'status'=>'read',
                                    'count'=>1,
                                    'last_updated'=>date('Y-m-d h:i:s'),
                                );

                                $this->operation->table_name = 'lessonprogress';
                                $is_value_saved = $this->operation->Create($student_progress);
                            }
                            else{
                                $defaultcount = $is_lesson_found[0]->count + 1;

                                   $student_progress = array(
                                    'status'=>'read',
                                    'count'=>$defaultcount,
                                    'last_updated'=>date('Y-m-d h:i:s'),
                                );
                                   $this->operation->table_name = 'lessonprogress';
                                $is_value_saved = $this->operation->Create($student_progress,$is_lesson_found[0]->id);
                            }
                        }    
                    }

                    $this->response([
                            'status' => true,
                            'message' => 'lessons read',
                        ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                    'status' => FALSE,
                        'message' => 'no class found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }       
        }
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    
    
     function GenerateRandomActivity($classid)
    {
        return $this->operation->GetRowsByQyery("
            SELECT a.* FROM activities a 
            LEFT JOIN (SELECT activity_id from activity_class WHERE class_id = ".$classid.") d  ON d.activity_id = a.id 
            WHERE a.status = 'a'");
    }

     function CheckIsValidActivity($studentid,$activity_id)
    {
        return  $this->operation->GetRowsByQyery("
            SELECT DISTINCT hour(ap.viewed_datetime) as allowedhours FROM activity_progress ap
            WHERE ap.student_id = ".$studentid." AND ap.activity_id =".$activity_id);
    }

     function CheckAllViewed($studentid)
    {
        return  $this->operation->GetRowsByQyery("
        SELECT DISTINCT ap.activity_id FROM activity_progress ap
        WHERE ap.student_id = ".$studentid);
    }

     function GetLastActivity($studentid)
    {
        return  $this->operation->GetRowsByQyery("
        SELECT * FROM activity_progress ap
        WHERE ap.student_id = ".$studentid." AND date(ap.viewed_datetime) = date(NOW())");
    }

    function GetRandom_Pick($activity_list)
    {
        return array_rand($activity_list, 1);
    }

    function IsActivityPlayed($studentid,$activity_list,$key,$classid)
    {

        if(count($activity_list))
        {
            $is_valid_activity = $this->operation->GetRowsByQyery("
                SELECT * FROM activity_progress ap
                WHERE ap.student_id = ".$studentid." AND activity_id = ".$activity_list[$key]->id);

            if(count($is_valid_activity) == false)
            {

                return $activity_list[$key];
            }
            else if(count($is_valid_activity) == true)
            {

                $viewed_counting = $this->CheckIsValidActivity($studentid,$activity_list[$key]->id);

                if($activity_list[$key]->repeat == 0 || $activity_list[$key]->repeat == '' && count($viewed_counting) == false)
                {
                    return $activity_list[$key];
                }
                else if($viewed_counting[$key]->allowedhours  < $activity_list[$key]->repeat &&  count($viewed_counting) == true)
                {
                    return $activity_list[$key];
                }
                else if($viewd_counting[$key]->allowedhours  == $activity_list[$key]->repeat &&  count($viewed_counting) == true)
                {
                    unset($activity_list[$key]);
                    $key = $this->GetRandom_Pick($activity_list);
                    return $this->IsActivityPlayed($studentid,$activity_list,$key);
                }
            }
        }
        else{
            $activity_list = $this->GenerateRandomActivity($classid);
            $key = $this->GetRandom_Pick($activity_list);
            return $this->IsActivityPlayed($studentid,$activity_list,$key);
        }
    }
        function CheckColumnHasCurrentDate($activity_list)
    {
        if(count($activity_list))
        {
            foreach ($activity_list as $key => $value) {
                if($value->view_date == date('Y-m-d'))
                {
                    return $key;
                }
            }
            return false;
        }
    }

    /**
     * Get activity list
     */
   public function GetActivityList_post()
    {
        try{
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);

            $classid =$this->security->xss_clean(html_escape($request->class_id));
            $sectionid =$this->security->xss_clean(html_escape($request->section_id));
            $studentid =$this->security->xss_clean(html_escape($request->studentid));
            $lastactivity =$this->security->xss_clean(html_escape($request->lastactivity));

            $result = array();
            $temp_array = array();
            $is_activity_played_today = $this->GetLastActivity($studentid);
            if(count($is_activity_played_today))
            {   
                $this->operation->table_name = "activities";
                $temp_array = $this->operation->GetByWhere(array('id'=>$is_activity_played_today[0]->activity_id));
                $temp_array = $temp_array[0];
            }
            else{
                $activity_list = $this->GenerateRandomActivity($classid);
                $key = $this->GetRandom_Pick($activity_list);
                if($this->CheckColumnHasCurrentDate($activity_list) != false)
                {
                    $new_key = $this->CheckColumnHasCurrentDate($activity_list);
                    $temp_array = $activity_list[$new_key];
                }
                else{
                    $temp_array = $this->IsActivityPlayed($studentid,$activity_list,$key,$classid);  
                }
            }

            if(count($temp_array))
            {
                $viewed_counting = $this->CheckIsValidActivity($studentid,$temp_array->id);
                $this->operation->table_name = "activity_files";
                $links = $this->operation->GetByWhere(array('activity_id'=>$temp_array->id));
                $result[] = array(
                    'id'=>$temp_array->id,
                    'title'=>$temp_array->title,
                    'links'=>$links,
                    'count'=>(count($viewed_counting) ? count($viewed_counting) /$temp_array->repeat : 1 ),
                );
            }
            
            if(count($result)){
                $this->response([
                    'status' => true,
                    'message' => $result,
                ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                'status' => FALSE,
                'message' => 'no cartoon found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }       
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
               'message' => 'no cartoon found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    /**
     * GetCurrentLoggedinuserdetail
     */
    public function GetStudentDetail_post()
    {
        try{
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $result =array();
            if($this->post('studentid'))
            {
                $this->operation->table_name="invantageuser";
                $student = $this->operation->GetByWhere(array('id'=>$this->post('studentid')));
                if(count($student))
                {
                    $studentclass = $this->operation->GetRowsByQyery("Select * from student_semesters   where studentid =".$student[0]->id." AND status = 'r'");

                    $user_locations = $this->operation->GetRowsByQyery("Select ur.school_id,s.* from user_locations ur INNER JOIN schools s ON s.id = ur.school_id where ur.user_id =".$student[0]->id);
                
                    $this->operation->table_name ="classes";
                    $class = $this->operation->GetByWhere(array('id'=>$studentclass[0]->classid));

                    $this->operation->table_name ="sections";
                    $section = $this->operation->GetByWhere(array('id'=>$studentclass[0]->sectionid));

                
                    $result[] = array(
                        'id'=>$student[0]->id,
                        'name'=>$student[0]->screenname,
                        'roll_no'=>$student[0]->username,
                        'image'=>$student[0]->profile_image,
                        'classserail'=>$studentclass[0]->classid,
                        'sectionserail'=>$studentclass[0]->sectionid,
                        'semesterserail'=>$studentclass[0]->semesterid,
                        'session'=>$studentclass[0]->sessionid,
                        'class'=>$class[0]->grade,
                        'section'=>$section[0]->section_name,
                    );
                }
              
                if(count($result)){
                    $this->response([
                            'status' => true,
                            'message' => $result,
                        ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                    'status' => FALSE,
                        'message' => 'no class found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } 
        }      
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * GetStudentSubjectLesson
     */
    public function GetStudentSubjectLesson_post()
    {
        try{
            $result =array();
            $lessondetail = null;
            $total_lessons = 0;
            $current_lesson = 1;
            $is_subject_counted = false;
            if($this->post('studentid') && $this->post('class_id') && $this->post('section_id'))
            {
                $this->operation->table_name = 'subjects';
                $subject_list = $this->operation->GetByWhere(array('class_id'=>$this->post('class_id'),'semsterid'=>$this->post('semester'),'session_id'=>$this->post('session')));
                if(count($subject_list)){
                    foreach ($subject_list as $key => $value) {

                        $semester_lesson_plan = $this->GetAllLessonBySubject($this->post('class_id'),$this->post('section_id'),$value->id,$this->post('session'),$this->post('semester'));
                        
                        if(count($semester_lesson_plan) > 0)
                        {
                            $total_lessons = count($semester_lesson_plan);
                            foreach ($semester_lesson_plan as $key => $svalue) {

                                if(count($this->CheckisReadedLesson($svalue->id,$this->post('studentid'))) == false && $is_subject_counted == false)
                                {
                                    $lessondetail = $semester_lesson_plan[$key];
                                    $is_subject_counted = true;
                                    $current_lesson = $key +1;
                                }
                                else if(count($this->CheckisReadedLesson($svalue->id,$this->post('studentid'))) == true){
                                    $current_lesson +=  1;
                                }
                            }
                        }

                        $is_subject_counted = false; 
                        if(count($semester_lesson_plan) > 0 && count($lessondetail))
                        {
                            $result[] = array(
                                'subject_id'=>$value->id,
                                'subject'=>$value->subject_name,
                                'id'=>$lessondetail->id,
                                'name'=>$lessondetail->topic,
                                'content'=>$lessondetail->content,
                                'notes'=>$lessondetail->concept,
                                'current_lesson'=>$current_lesson,
                                'total_lessons'=>$total_lessons,
                                'read_date'=>date('M d, Y'),
                                'type'=>$lessondetail->type,
                                'last_update'=>date('M d, Y'),
                                'preference'=>0,
                                'lesson_readed'=>false,
                                'bliking'=>false,
                                'disabled'=>false,
                            );
                        } 
                    }
                }

                if(count($result)){
                    $this->response([
                            'status' => true,
                            'message' => $result,
                        ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                    'status' => FALSE,
                        'message' => 'no class found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } 
        }      
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * Get subjects list by classes
     */
    public function GetSubjectsListByClasses_get()
    {
        try{
            $result =array();
            $locations = $this->session->userdata('locations');
            $school_id = $locations[0]['school_id'];
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$school_id,'status'=>'a'));
            $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));

            $subject_list = $this->operation->GetRowsByQyery(
                "SELECT * FROM subjects 
                WHERE session_id = ".$active_session[0]->id." AND semsterid = ".$active_semester[0]->semester_id."
                ");
            if(count($subject_list)){
                foreach ($subject_list as $key => $value) {
                    $this->operation->table_name = 'classes';
                    $class_name = $this->operation->GetByWhere(array('id'=>$value->class_id));
                    $result[] = array(
                        'classid'=>$value->class_id,
                        'classname'=>$class_name[0]->grade,
                        'subjectid'=>$value->id,
                        'subject'=>$value->subject_name,
                        'code'=>$value->subject_code,
                    );
                }
            }

            if(count($result)){
                $this->response([
                        'status' => true,
                        'message' => $result,
                    ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }      
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    /**
     * Get tags
     */
    public function GetTags_get()
    {
        try{
            $result =array();
            $this->operation->table_name = 'remarks_tags';
            $tags = $this->operation->GetRows();
            if(count($tags)){
                foreach ($tags as $key => $value) {
                    $result[] = array(
                        'text'=>$value->tag,
                    );
                }
            }

            if(count($result)){
                $this->response([
                    'status' => true,
                    'message' => $result,
                ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                'status' => FALSE,
                'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }      
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function SaveActivityProgress_post()
    {
        try{
            if($this->post('studentid') && $this->post('activityid'))
            {
                $this->operation->table_name = 'activity_progress';
                $classes = array(
                    'student_id'=>$this->post('studentid'),
                    'activity_id'=>$this->post('activityid'),
                    'viewed_datetime'=>date('Y-m-d h:i:s'),
                    'activity_iteration'=>$this->post('activity_iteration'),
                );
                $is_row_saved = $this->operation->Create($classes);
           
                if(count($is_row_saved)){
                    $this->response([
                        'status' => true,
                        'message' => true,
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                    'status' => FALSE,
                    'message' => 'no class found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }      
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

   function GetStudentsList_post()
    {
        try{
            $students_list = array();
            if($this->post('classid') && $this->post('sectionid') && $this->post('semesterid'))
            {
                $is_student_found = $this->GetStudentByClass(
                    $this->post('classid'),
                    $this->post('sectionid'),
                    $this->post('semesterid'),
                    $this->post('studentid')
                );

                if(count($is_student_found))
                {
                    foreach ($is_student_found as $key => $value) {
                        $fname= $this->getUserMeta($value->studentid,'sfullname');
                        $lname= $this->getUserMeta($value->studentid,'slastname');
                        $student = $this->GetStudentDetail($value->studentid);
                        $profile_image = $student[0]->profile_image;
                        $students_list[] = array(
                            'name'=> $fname." ".$lname,
                            'fname'=> $fname,
                            'image'=>$profile_image,
                            'id'=>$value->studentid
                        );
                    }
                }
            }
            if(count($students_list)){
                $this->response([
                    'status' => true,
                    'message' => $students_list,
                ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                'status' => FALSE,
                'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }      
        catch(Exception $e){
            $this->set_response([
                'status' => FALSE,
                    'message' => 'no class found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    function GetStudentByClass($classid,$sectionid,$semesterid,$studentid)
    {
        $this->operation->table_name = 'student_semesters';
        return $this->operation->GetRowsByQyery(
            "SELECT * FROM student_semesters WHERE semesterid = ".$semesterid." AND classid =".$classid.
            " AND sectionid = ".$sectionid."  AND status = 'r' AND studentid <>".$studentid
           );
    }

    function GetStudentDetail($studentid)
    {
        $this->operation->table_name = 'invantageuser';
        return $this->operation->GetByWhere(array(
            'id'=>$studentid,
        ));
    }
}
