<?php
class Principal_Extension_controller extends MY_Controller
{

    /**
     * @var array
     */
    var $data = array();
    private $userlocation = null;
    private $semester_date_id  = null;
    function __construct(){
        parent::__construct();
        $this->load->model('User');
        $this->load->model('Operation');
        $this->userlocation = parent::GetLogedinUserLocation();
        $this->semester_date_id = parent::GetCurrentActiveSemesterByUserLocation();
    }


	public function Add_Holiday()
	{
		$this->load->view("principal/Principal_Extension_View/Add_Holiday");
	}

    /**
     * Get holiday type module
     *
     * @access private
     */
    function GetHolidayType(){
        $this->operation->table_name = 'holiday_type';
        $holidaytypelist = $this->operation->GetByWhere(array('school_id'=>$this->userlocation));
        
        $result = array();
        if(count($holidaytypelist))
        {
            foreach ($holidaytypelist as $key => $value) {
                $result[] = array(
                    'id'=>$value->id,
                    'title'=>$value->title,
                );
            }
        }
        echo json_encode($result);
    }


    /**
     * Save holiday type module
     *
     * @access private
     */
    function SaveHolidayType(){
        $request = json_decode( file_get_contents('php://input'));
        $serail = $this->security->xss_clean(trim($request->id));
        $title = $this->security->xss_clean(trim($request->title));
      
        $error_array = array();
        if (strlen($title) < 3) {
            array_push($error_array,"Type must be 3 character");
        }
             
        if(count($error_array))
        {
            echo json_encode($error_array);
            exit();
        }
        $this->operation->table_name = 'holiday_type';
        $locations = $this->session->userdata('locations');
        if(count($error_array) == false)
        {
            if($serail)
            {
                $holidaytype = array(
                    'title'=>ucfirst($title),
                   
                    'slug'=>parent::HolidaySlugGenerator($title),
                    'user_id'=>$this->session->userdata('id'),
                    'last_edited'=>date('Y-m-d'),
                );
                $id = $this->operation->Create($holidaytype,$serail);
                if(count($id))
                {
                    $result['message'] = true;
                }
            }
            else{
                $holidaytype = array(
                    'title'=>ucfirst($title),
                    'slug'=>parent::HolidaySlugGenerator($title),
                    'user_id'=>$this->session->userdata('id'),
                    'school_id'=>$locations[0]['school_id'],
                    'date'=>date('Y-m-d'),
                    'last_edited'=>date('Y-m-d'),
                );
                $id = $this->operation->Create($holidaytype);
                if(count($id))
                {
                    $result['message'] = true;
                }
            }
        }
        echo json_encode($result);
    }

    /**
     * Remove holiday type
     *
     * @access private
     */
    function RemoveHolidayType()
    {
        $sresult['message'] = false;
        if($this->input->get('id'))
        {
            $this->operation->table_name = 'holiday_type';
            $this->operation->Remove($this->input->get('id'));
            $sresult['message'] = true;
        }
        echo json_encode($sresult);
    }

    /**
     * Save holiday  module
     *
     * @access private
     */
    function SaveHoliday(){
        date_default_timezone_set("Asia/Karachi");
        $request = json_decode( file_get_contents('php://input'));
        $serail = $this->security->xss_clean(trim($request->serial));
        $title = $this->security->xss_clean(trim($request->title));
        $apply = $this->security->xss_clean(trim($request->apply));
        $description = $this->security->xss_clean(trim($request->description));
        $start_date = $this->security->xss_clean(trim($request->date->startDate));
        $end_date = $this->security->xss_clean(trim($request->date->endDate));
        $start_time = $this->security->xss_clean(trim($request->date->startDate));
        $end_time = $this->security->xss_clean(trim($request->date->endDate));
        $is_all_day = $this->security->xss_clean(trim($request->is_all_day));
        $type = $this->security->xss_clean(trim($request->type->id));
     
        $error_array = array();
        if (strlen($title) < 3) {
            array_push($error_array,"Type must be 3 character");
        }
             
        if(count($error_array))
        {
            echo json_encode($error_array);
            exit();
        }

        $this->operation->table_name = 'holiday';
        $locations = $this->session->userdata('locations');
        if(count($error_array) == false)
        {
            if($serail)
            {
                $holiday = array(
                    'start_date'=>date('c',strtotime($start_date)),
                    'end_date'=>date('c',strtotime($end_date)),
                    'title'=>ucfirst($title),
                    'apply'=>$apply,
                    'description'=>ucfirst($description),
                    'slug'=>parent::slugGenerator($description),
                    'event_id'=>($is_all_day == false ? $type : ''),
                    'last_edited'=>date('Y-m-d'),
                    'all_day'=>($is_all_day ? 'y':'n'),
                    'start_time'=>($is_all_day == false ? date('H:i',strtotime($start_time)) : ''),
                    'end_time'=>($is_all_day == false ? date('H:i',strtotime($end_time)): ''),
                );
                $id = $this->operation->Create($holiday,$serail);
                if(count($id))
                {
                    $result['message'] = true;
                }
            }
            else{

                $holiday = array(
                    'start_date'=>date('c',strtotime($start_date)),
                    'end_date'=>date('c',strtotime($end_date)),
                    'title'=>ucfirst($title),
                    'apply'=>$apply,
                    'description'=>ucfirst($description),
                    'slug'=>parent::slugGenerator($description),
                    'user_id'=>$this->session->userdata('id'),
                    'school_id'=>$locations[0]['school_id'],
                    'event_id'=>($is_all_day == false ? $type : ''),
                    'created'=>date('Y-m-d'),
                    'last_edited'=>date('Y-m-d'),
                    'all_day'=>($is_all_day ? 'y':'n'),
                    'start_time'=>($is_all_day == false ? date('H:i',strtotime($start_time)) : ''),
                    'end_time'=>($is_all_day == false ? date('H:i',strtotime($end_time)): ''),
              
                );
                
                
                $id = $this->operation->Create($holiday);
                
                if(count($id))
                {
                    $result['message'] = true;
                }
            }
        }
        echo json_encode($result);
    }
    
    function UpdateSemesterLessonPlanDates()
    {
        try{
            $result['message'] = false;
            date_default_timezone_set("Asia/Karachi");
            $request = json_decode( file_get_contents('php://input'));

            $start_date = $this->security->xss_clean(trim($request->date->startDate));
            $end_date = $this->security->xss_clean(trim($request->date->endDate));

            $active_session = parent::GetUserActiveSession();

            $active_semester = parent::GetCurrentSemesterData($active_session[0]->id);
            
            $start_date = date('Y-m-d',strtotime($start_date));
            $end_date = date('Y-m-d',strtotime($active_semester[0]->end_date));
            
            $holidays = parent::GetHolidaysByUserLoginLocation($start_date); // find holidays dates
            
            $current_lesson_day = array();
            $dublicate_dates = array();
             $subject_time = parent::GetTimeTableByLocation($active_semester[0]->semester_id,$active_session[0]->id);
            if(count($subject_time))
            {
                foreach ($subject_time as $key => $value) {
                    $is_next_day = false;
                    $semester_lesson_plan = $this->operation->GetRowsByQyery("select * from semester_lesson_plan where classid=".$value->class_id." AND sectionid = ".$value->section_id." and semsterid =".$active_semester[0]->semester_id." AND sessionid =".$active_session[0]->id." and subjectid=".$value->subject_id." AND date(read_date) >= '".$start_date."' ORDER BY preference ASC");
                    $this->operation->table_name = 'semester_lesson_plan';
                    if(count($semester_lesson_plan))
                    {
                        $temp_start_date = $start_date;
                        foreach ($semester_lesson_plan as $key => $svalue) {
                            $is_next_day = false;
                            
                            if(strtotime($temp_start_date) <= strtotime($end_date))
                            {
                                if(count($current_lesson_day) == false || !in_array($svalue->read_date , $current_lesson_day ))
                                {
                                    array_push($current_lesson_day, $svalue->read_date);
                                    $is_next_day = true;
                                }

                                $is_holiday = false;

                                if($is_next_day)
                                {
                                    $temp_date = parent::CheckCurrentDayStatus($holidays,$temp_start_date);
                                    if(!is_null($temp_date))
                                    {
                                        // find status of holiday
                                        if(count(parent::CheckCurrentDayFoundRecord($temp_date)))
                                        {
                                            $check_date = parent::CheckCurrentDayFoundRecord($temp_date);
                                    
                                            // if this lesson day check is current period avaible
                                            if(count($subject_time))
                                            {
                                                $is_period_time_skiped = parent::IsPeriodHoursMatched($subject_time[0]->start_time,$subject_time[0]->end_time,$check_date[0]->start_date,$check_date[0]->end_date);
                                        
                                                if($is_period_time_skiped == false)
                                                {
                                                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($temp_date)));
                                                    $temp_date = parent::CheckCurrentDayStatus($holidays,$date);
                                                }
                                            }
                                        }

                                        $dublicate_dates[$svalue->read_date] = $temp_date;
                                       
                                        $temp_start_date = date ("Y-m-d", strtotime("+1 day", strtotime($temp_date)));
                                    }
                                }
                                else{
                                    $temp_date = $dublicate_dates[$svalue->read_date];
                                }
                            }
                            $updated_date = array(
                                'read_date'=>$temp_date
                            );
                            $this->operation->table_name = 'semester_lesson_plan';
                            $id = $this->operation->Create($updated_date,$svalue->id);
                            
                            if(count($id))
                            {
                                $result['message'] = true;
                            }
                        }
                    }
                }
            }
            echo json_encode($result);
        }
        catch(Exception $e){}
        
    }

    /**
     * Remove holiday
     *
     * @access private
     */
    function RemoveHoliday(){
        $request = json_decode( file_get_contents('php://input'));
        $slug = $this->security->xss_clean(trim($request->slug));
  
        $error_array = array();
        if (strlen($slug) < 3) {
            array_push($error_array,"Type must be 3 character");
        }
             
        if(count($error_array))
        {
            echo json_encode($error_array);
            exit();
        }

        $result['message'] = false;

        $this->operation->table_name = 'holiday';
        $is_holiday_found = $this->operation->GetByWhere(array('slug'=>$slug));
        if(count($is_holiday_found))
        {
            $this->operation->Remove($is_holiday_found[0]->id);

            $result['message'] = true;
        }
        echo json_encode($result);
    }

    /**
     * Get holiday  module
     *
     * @access private
     */
    function GetHoliday(){
        date_default_timezone_set('Asia/Karachi');
        $this->operation->table_name = 'holiday';
        $holidaytypelist = $this->operation->GetByWhere(array('school_id'=>$this->userlocation));
        $result = array();
        if(count($holidaytypelist))
        {
            foreach ($holidaytypelist as $key => $value) {
                $this->operation->table_name = 'holiday_type';
                $event = $this->operation->GetByWhere(array('id'=>$value->event_id));
                $result[] = array(
                    'serial'=>$value->id,
                    'title'=>$value->title,
                    'description'=>$value->description,
                    'allDay'=>(bool)($value->all_day =='y' ? true:false),
                    'start'=>($value->all_day == 'y' ? $value->start_date : date('c',strtotime($value->start_date.$value->start_time))),
                    'end'=>($value->all_day == 'y' ? $value->end_date : date('c',strtotime($value->end_date.$value->end_time))),
                    'apply'=>$value->apply,
                    'event'=>$event,
                    'slug'=>$value->slug,
                    'color'=>($value->all_day =='y' ? '#109d57':$this->RandomColor())
                );
            }
        }
        echo json_encode($result);
    }

    function RandomColor()
    {
        $color = array('#37ef9c','#ff2190','#9239e5','#c43e2d','#13ad0d','#039b82','#061187','#0b417f','#ab46bc','#f4b400','#db4438');
        $color[rand(0, count($color) - 1)];

        return $color[rand(0, count($color) - 1)];
    }
    /**
     * Get semester dates detail
     *
     * @access private
     */
    function GetSemesterDetail(){
        $this->operation->table_name = 'semester_dates';
        $locations = $this->session->userdata('locations');
        $semester_datail_list = $this->operation->GetByWhere(array('school_id'=>$locations[0]['school_id']));
        $result = array();
        $status = "";
        $this->operation->table_name = 'sessions';
        $active_session_check = $this->operation->GetByWhere(array('status' => "a", 'school_id' => $locations[0]['school_id']));
        $active_session_enddate = date('Y-m-d',strtotime($active_session_check[0]->dateto));
        
        if(count($semester_datail_list))
        {
            foreach ($semester_datail_list as $key => $value) {
               
                $current_active_session = parent::GetSessionDetail($value->session_id);
                $current_active_semester = parent::GetSemeterDetail($value->semester_id);
                $end_date_session = date('Y-m-d',strtotime($current_active_session[0]->dateto));
                
                if($active_session_enddate==$end_date_session)
                {
                    $status ="Active";
                }
                else
                {
                    $status ="Inactive";
                }
                $result[] = array(
                    'id'=>$value->id,
                    'start_date'=>date('M d, Y',strtotime($value->start_date)),
                    'end_date'=>date('M d, Y',strtotime($value->end_date)),
                    'session_id'=>$value->session_id,
                    'semester'=>$value->semester_id,
                    'status'=>$value->status,
                    'session_value'=>date('M d, Y',strtotime($current_active_session[0]->datefrom)).' - '.date('M d, Y',strtotime($current_active_session[0]->dateto)),
                    'session_status' =>$status,
                    'semester_value'=>$current_active_semester[0]->semester_name
                );
            }
        }
        echo json_encode($result);
    }

    /**
      * Save semester deail
      *
      * @access private
      */
    function SaveSemesterDetail(){
        $request = json_decode( file_get_contents('php://input'));
        $serail = $this->security->xss_clean(trim($request->id));
        $semester = $this->security->xss_clean(trim($request->semester));
        $start_date = $this->security->xss_clean(trim($request->start_date));
        $end_date = $this->security->xss_clean(trim($request->end_date));
        $sresult['message'] = false;
        $check_valid['check_validation'] = true;
        $check_session_valid['check_session_valid'] = false;
        $error_array = array();
        if (empty($start_date) || empty($end_date)) {
            array_push($error_array,"Date is empty");
        }
        
        $post_start_date = date('Y-m-d', strtotime($start_date));
        $locations = $this->session->userdata('locations');
        $this->operation->table_name = 'sessions';
        $current_active_session = $this->operation->GetByWhere(array('school_id'=>$locations[0]['school_id'],'status'=>'a'));
        $this->operation->table_name = 'semester_dates';
        $current_activeted_semester = $this->operation->GetByWhere(array('school_id'=>$locations[0]['school_id'],'status'=>'a'));
        
        $locations = $this->session->userdata('locations');
        // Check already exists session,semester ans school
        $this->operation->table_name = 'semester_dates';
        
        $active_semester = $this->operation->GetByWhere(array('session_id' => $current_active_session[0]->id, 'school_id' => $current_active_session[0]->school_id, 'semester_id' => $semester));
        
        if($serail)
        {
            $semester_datail = array(
                'start_date'=>date('Y-m-d',strtotime($start_date)),
                'end_date'=>date('Y-m-d',strtotime($end_date)),
                'last_edited'=>date('Y-m-d'),
                'semester_id'=>$semester,
            );
            $id = $this->operation->Create($semester_datail,$serail);
            if(count($id))
            {
                $sresult['message'] = true;
            }
        }
        else
        {
            $inputstartdate = date('Y-m-d', strtotime($start_date));
            $inputenddate = date('Y-m-d', strtotime($end_date));  
            $record_check = $this->operation->GetRowsByQyery("SELECT * FROM semester_dates WHERE  school_id =  ".$locations[0]['school_id']);
            if(count($record_check))
            {
                foreach ($record_check as $key => $value)
                {
                    $start_date = date('Y-m-d', strtotime($value->start_date));
                    $end_date = date('Y-m-d', strtotime($value->end_date));
                    $record_datefrom = $this->operation->GetRowsByQyery("SELECT * FROM semester_dates WHERE '".$inputstartdate."'>='".$start_date."' AND '".$inputstartdate."'<='".$end_date."' AND id =  ".$value->id);
                    if(count($record_datefrom))
                    {
                        
                        $sresult['exists'] = 'Exists';
                        $check_valid['check_validation'] = false;
                    }
                    $record_dateto = $this->operation->GetRowsByQyery("SELECT * FROM semester_dates WHERE '".$inputenddate."'>='".$start_date."' AND '".$inputenddate."'<='".$end_date."' AND id =  ".$value->id);
                    if(count($record_dateto))
                    {
                       
                        $sresult['exists'] = 'Exists';
                        $check_valid['check_validation'] = false;
                    }
                }
                
                    
                    if($check_valid['check_validation'])
                    {
                        $record_check = $this->operation->GetRowsByQyery("SELECT * FROM sessions WHERE  school_id =  ".$locations[0]['school_id']);
                        if(count($record_check))
                        {
                            foreach ($record_check as $key => $value)
                            {
                                $start_date = date('Y-m-d', strtotime($value->datefrom));
                                $end_date = date('Y-m-d', strtotime($value->dateto));
                                $record_datefrom = $this->operation->GetRowsByQyery("SELECT * FROM sessions WHERE '".$inputstartdate."'>='".$start_date."' AND '".$inputstartdate."'<='".$end_date."' AND id =  ".$value->id);
                                if(count($record_datefrom))
                                {
                                    $sessionid = $value->id;
                                    $sessiondatefrom = $value->datefrom;
                                    $sessiondateto = $value->dateto;
                                    $check_session_valid['check_session_valid'] = true;
                                }
                                $record_dateto = $this->operation->GetRowsByQyery("SELECT * FROM sessions WHERE '".$inputenddate."'>='".$start_date."' AND '".$inputenddate."'<='".$end_date."' AND id =  ".$value->id);
                                if(count($record_dateto))
                                {
                                    $sessionid = $value->id;
                                    $sessiondatefrom = $value->datefrom;
                                    $sessiondateto = $value->dateto;
                                    $check_session_valid['check_session_valid'] = true;
                                }
                            }
                        }
                        // Check session dates
                        if($sessionid)
                        {
                            $record_datefrom_check = $this->operation->GetRowsByQyery("SELECT * FROM sessions WHERE '".$inputstartdate."'>='".$sessiondatefrom."' AND '".$inputenddate."'<='".$sessiondateto."' AND id =  ".$sessionid);
                            if(count($record_datefrom_check))
                            {
                                $semester_datail = array(
                                'session_id'=>$sessionid,
                                'semester_id'=>$semester,
                                'start_date'=>date('Y-m-d',strtotime($inputstartdate)),
                                'end_date'=>date('Y-m-d',strtotime($inputenddate)),
                                'school_id'=>$locations[0]['school_id'],
                                'created'=>date('Y-m-d'),
                                'last_edited'=>date('Y-m-d'),
                                );
                                $id = $this->operation->Create($semester_datail);
                                if(count($id))
                                {
                                    $sresult['message'] = true;
                                }
                                
                            }
                            else
                            {
                                $sresult['session_date_error'] = 'SessionDateError';
                            }
                        }
                        
                        
                    }
                
            }
            else
            {
                $sresult['session_date_error'] = 'SessionDateError';
            }
        }
        echo json_encode($sresult);
    }

    /**
      * Make semester active
      *
      * @access private
      */
    function MakeSemesterActive(){
        $request = json_decode( file_get_contents('php://input'));
        $serail = $this->security->xss_clean(trim($request->inputSemester));
       
        $error_array = array();
        if (empty($serail)) {
            array_push($error_array,"Date is empty");
        }
             
        if(count($error_array))
        {
            echo json_encode($error_array);
            exit();
        }

        $this->operation->table_name = 'semester_dates';
        $new_sem_dates = $this->operation->GetByWhere(array('id'=>$serail));
        $result['message'] = false;
        if(count($error_array) == false)
        {
            if($new_sem_dates)
            {

                $this->operation->table_name = 'semester_dates';
                $current_active_sem_dates = $this->operation->GetByWhere(array('school_id'=>$this->userlocation,'status'=>'a'));

                $this->db->query("Update semester_dates set status = 'i' where school_id = ".$this->userlocation);
                
                $semester_datail = array(
                    'status'=>'a',
                );
                $id = $this->operation->Create($semester_datail,$serail);
                //echo $current_active_sem_dates[0]->id;
                //echo "Id:" . $id . " ";
                //exit();
                if(count($id))
                {
                    $this->MakeEvaluationActive((int) $current_active_sem_dates[0]->id,$id);
                    $this->MakeGradesActive((int)$current_active_sem_dates[0]->id,$id);
                    $result['message'] = true;
                }
            }
        }
        echo json_encode($result);
    }

    /**
      * Update evaluation table
      *
      * @access private
      */
    function MakeEvaluationActive($current_semester_id,$new_semester_id)
    {

        // check current evaluation
        if(is_int($current_semester_id))
        {
            // find previous evaluation
            $this->operation->table_name = 'evaluation';
            $get_last_evaluation = $this->operation->GetByWhere(array('semester_date_id'=>$current_semester_id,'status'=>'a'));
        
            if(count($get_last_evaluation))
            {
                $this->db->query("Update evaluation set status = 'i' where semester_date_id = ".$current_semester_id);
                $this->operation->primary_key = "semester_date_id";
                $option = array(
                    'semester_date_id'=>$new_semester_id,
                    'option_value'=>serialize($get_last_evaluation[0]->option_value),
                    'status'=>'a'
                );
                $id = $this->operation->Create($option,$new_semester_id);
            }else{
                $option = array(
                    'semester_date_id'=>$new_semester_id,
                    'option_value'=>serialize(parent::DefaultEvaluationsList()),
                    'status'=>'a'
                );
                $id = $this->operation->Create($option);
            }
        }
    }
    
    /**
      * Update grades table
      *
      * @access private
      */
   function MakeGradesActive($current_semester_id,$new_semester_id)
    {
        // check current grades list
        if(is_int($current_semester_id))
        {
            // find previous evaluation
            $this->operation->table_name = 'grades';
            $get_last_grades = $this->operation->GetByWhere(array('semester_date_id'=>$current_semester_id));
            
            
            if(count($get_last_grades))
            {
                $this->db->query("Update grades set status = 'i' where semester_date_id = ".$current_semester_id);
                $this->operation->primary_key = "semester_date_id";
                $option = array(
                    'semester_date_id'=>$new_semester_id,
                    //'option_value'=>serialize($get_last_grades[0]->option_value),
                    'status'=>'a'
                );
                $id = $this->operation->Create($option,$new_semester_id);
                
            }else{
                
                $grade_str = serialize(parent::DefaultGradesList());
                $q = "INSERT INTO `grades` (`status`, `semester_date_id`, `option_value`) VALUES ('a', ". $new_semester_id .", '". $grade_str."')";
                $result = $this->db->query($q);
                $id = $this->db->insert_id();
               
            }
        }
    }
    public function Tablet_List()
    {
        $this->load->View('principal/Principal_Extension_View/Tablet_List.php');
    }

     public function Load_Tablet_Data() 
     {

                               $data=$this->operation->GetRowsByQyery("SELECT ts.*,inv.screenname, c.grade  FROM tablet_status ts
                INNER JOIN invantageuser inv on inv.username=ts.current_student_id INNER JOIN  classes c on ts.school_id=c.school_id group by ts.mac_address"); 

                               $data_array=array();
                               foreach ($data as $key => $value) {
                                
                               
                               $data_array[]=array
                               (
                                    'id'=>$value->id,
                                    'Device_Name'=>$value->device_name,
                                    'Mac_Address'=>$value->mac_address,
                                    'Last_Connected'=>$value->last_connected,
                                    'Student_Name'=>$value->screenname,
                                    'username'=>$value->last_student_id,
                                    'grade'=>$value->grade,
                                    'IsBlock'=>$value->IsBlock,
                        

                               );


                           }
                           echo json_encode($data_array);

     }


    /**
     * Get Block user  module
     *
     * @access private
     */
    function Blockuser(){
        
        $request = json_decode( file_get_contents('php://input'));
        $result['message'] = false;
        
        $data = $request->data;
        $isblock = trim($data->IsBlock);
        $id = trim($data->id);
        $blocker = array(
            'IsBlock'=>($isblock == false ? 0 : 1),
        );
         $this->operation->table_name = 'tablet_status';
        $id = $this->operation->Create($blocker,$id);
     
        if(count($id))
        {
            $result['message'] = true;
        }


        echo json_encode( $result);
    }

    public function Generic_Grading_Criteria()
    {
        $this->load->View('principal/Principal_Extension_View/grading_criteria.php');
    }
    
    /**
     * Get evaualtion formula
     *
     * @access private
     */
    function GetEvaluation()
    {
        	$active_session = parent::GetUserActiveSession();

		$this->operation->table_name = 'semester_dates';

            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            
        $this->operation->table_name = 'evaluation';

        $is_eva_found = $this->operation->GetByWhere(array('status'=>'a','semester_date_id'=>$active_semester[0]->id));
       
        $formula = array();
        if(count($is_eva_found))
        {
            $eva_list = unserialize($is_eva_found[0]->option_value);
            
        
            
            foreach ($eva_list as $key => $value) {
               
                $formula[] = array(
                    'slug'=>$value['slug'],
                    'percent'=>(int) $value['value'],
                    'title'=>$value['title'],
                ); 
            }
        }
       echo json_encode( $formula);
    }

     /**
     * Save evaualtion formula
     *
     * @access private
     */
    public function SaveEvaluation()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $formula = array();
        $evaualtionobj =$request->data;
        $result['message'] = false;
        $check_extentions = array('ass','qui','mid','fin','pra','att','orl','beh');
        if(count($evaualtionobj))
        {
            foreach ($evaualtionobj as $key => $value) {
                if(in_array($this->security->xss_clean(html_escape($value->slug)),$check_extentions))
                {
                    $formula[] = array(
                        'slug'=>$this->security->xss_clean(html_escape($value->slug)),
                        'value'=>$this->security->xss_clean(html_escape($value->percent)),
                        'title'=>$this->security->xss_clean(html_escape($value->title))
                    );
                }
            }

           
       
            $option = array(
                'option_value'=>serialize($formula),
            );
            	$active_session = parent::GetUserActiveSession();
    
    
		$this->operation->table_name = 'semester_dates';

            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            
        $this->operation->table_name = 'evaluation';

        $is_eva_found = $this->operation->GetByWhere(array('status'=>'a','semester_date_id'=>$active_semester[0]->id));
        
            $id = $this->operation->Create($option,$is_eva_found[0]->id);
      
            if(count($option))
            {
                 $result['message'] = true;
            }
        }

        echo json_encode($result);
    }

}
