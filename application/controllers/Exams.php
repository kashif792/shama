<?php
/**
 * Invantage Controller
 *
 * This class responsible for inventage.
 */
class Exams extends MY_Controller
{
    /**
     * @var array
     */
    var $data = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('User');
        $this->load->model('Operation');
        date_default_timezone_set("Asia/Karachi");
       
        
    }
    
    
    function datesheet()
    {
        if(!($this->session->userdata('id')))
        {
            parent::redirectUrl('signin');
        }
        $this->data['logo'] = parent::ImageConvertorToBase64(base_url()."images/small_nrlogo.png");
        $this->data['schoolname'] = $this->campus;
        $this->data['campuscity'] = $this->usercity;
        $this->load->view("exams/datesheet",$this->data);
    }
    function AddMidDatesheet()
    {
        date_default_timezone_set("Asia/Karachi");
            if(!($this->session->userdata('id'))){

                parent::redirectUrl('signin');

            }

        $locations = $this->session->userdata('locations');

            $roles = $this->session->userdata('roles');

            $result = array();

            if($this->uri->segment(2) AND $this->uri->segment(2) != "page" ){

                $schedule_single = $this->operation->GetRowsByQyery("Select * from schedule where id= ".$this->uri->segment(2));
                if(Count($schedule_single))
                {
                    $this->data['schedule_single'] = $schedule_single;

                    $result['class_id'] = $schedule_single[0]->class_id;

                    $result['section_id'] = $schedule_single[0]->section_id;

                    $result['subject_id'] = $schedule_single[0]->subject_id;

                    $result['teacher_uid'] = $schedule_single[0]->teacher_uid;

                    $result['start_time'] = date('H:i',$schedule_single[0]->start_time);

                    $result['end_time'] = date('H:i',$schedule_single[0]->end_time);

                }

                $this->data['result'] = $result;

        }



        $this->data['teacherlist'] = $this->operation->GetRowsByQyery("SELECT i.id, i.username, i.nic FROM invantageuser i INNER JOIN user_locations ul ON ul.user_id = i.id INNER JOIN user_roles ur ON ur.user_id = i.id WHERE ur.role_id = 4 AND ul.school_id = ".$locations[0]['school_id']);

        //$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT username, nic FROM `invantageuser` WHERE type ='t'");

        $this->operation->table_name = "subjects";

        $subjectslist = $this->operation->GetRows();

        $subjects = array();

        if(count($subjectslist))

        {

            foreach ($subjectslist as $key => $value) {



                $subjects[] = array(

                    'subid'=>$value->id,

                    'name'=> $value->subject_name." (".$value->subject_code." )",

                    'class'=>parent::getClass($value->class_id),

                );

            }

        }


            if( $roles[0]['role_id'] == 3){




        $classlist = $this->operation->GetRowsByQyery("SELECT  * FROM classes c where school_id=".$locations[0]['school_id']);
        if(Count($classlist))
        {
            $this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid  =".$classlist[0]->id);
        }else{
            $this->data['sectionlist'] = [];
        }


        } else if( $roles[0]['role_id'] == 4){

            $classlist = $this->operation->GetRowsByQyery("select cl.id, cl.grade FROM schedule sch INNER JOIN classes cl on sch.class_id=cl.id where sch.teacher_uid=46 ");
            if(Count($classlist))
            {
                $this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid  =".$classlist[0]->id);
            }else{
                $this->data['sectionlist'] = [];
            }
        }

        $this->data['classlist'] = $classlist;



        $this->data['subjects'] = $subjects;

        // Session Get
        $this->operation->table_name = 'sessions';
        $sessionarray = array();
        $this->operation->order_by = 'desc';
        $locations = $this->session->userdata('locations');
        $sessionlist = $this->operation->GetByWhere(array('school_id' => $locations[0]['school_id']));
        if (count($sessionlist))
        {
            foreach ($sessionlist as $key => $value)
            {
                $sessionarray[] = array('id' => $value->id, 'name' => date('M d, Y', strtotime($value->datefrom)) . ' - ' . date('M d, Y', strtotime($value->dateto)), 'status' => $value->status);
            }
        }
        $this->data['session'] = $session;


        $this->load->view('exams/add_mid_datesheet',$this->data);
    }
}

