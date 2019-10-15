<?php
class Principal_controller extends MY_Controller

{

	/**

 	 * @var array

 	 */

	var $data = array();

	 private $userlocationid = null;

	function __construct(){

		parent::__construct();

		$this->load->model('user');

		$this->load->model('operation');

		if($this->session->userdata('id'))
		{
			//parent::redirectUrl('signin');
		}
		 	

	}



 	/*

	 * Check user login or not

	 */

	function isUserLoginOrNot()
	{

		if($this->uri->segment(1) != 'signin'){

			if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		}

		if($this->uri->segment(1) == 'login')
		{

			if(!$this->session->userdata('id')){

				parent::redirectUrl('dashboard');

			}

		}

	}



/* For adding data into system through forms*/



	public function add_class_form(){

		if(!($this->session->userdata('id')))
		{

				parent::redirectUrl('signin');

			}

		
		if($this->uri->segment(2) AND $this->uri->segment(2) != "page" )
		{

			$this->data['class_single'] = $this->operation->GetRowsByQyery("Select * from classes where id= ".$this->uri->segment(2));

		}

		$this->load->view('principal/add_class',$this->data);



	}



	// public function add_parent_form(){

	// 	$this->load->view('principal/add_parent');

	// }

	public function add_student_form(){



		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}
			$roles = $this->session->userdata('roles');

			if($this->uri->segment(2) AND $this->uri->segment(2) != "page" ){

			$this->data['student_single'] = $this->operation->GetRowsByQyery("Select * from invantageuser where id= ".$this->uri->segment(2));

			$result['sfullname'] = (parent::getUserMeta($this->uri->segment(2),'sfullname') != false ? parent::getUserMeta($this->uri->segment(2),'sfullname') : '');
			$result['slastname'] = (parent::getUserMeta($this->uri->segment(2),'slastname') != false ? parent::getUserMeta($this->uri->segment(2),'slastname') : '');

			$result['saddress'] = (parent::getUserMeta($this->uri->segment(2),'saddress') != false ? parent::getUserMeta($this->uri->segment(2),'saddress') : '');

			$result['shunit'] = (parent::getUserMeta($this->uri->segment(2),'shunit') != false ? parent::getUserMeta($this->uri->segment(2),'shunit') : '');

			$result['scity'] = (parent::getUserMeta($this->uri->segment(2),'scity') != false ? parent::getUserMeta($this->uri->segment(2),'scity') : '');

			$result['sprovice'] = (parent::getUserMeta($this->uri->segment(2),'sprovice') != false ? parent::getUserMeta($this->uri->segment(2),'sprovice') : '');

			$result['spcode'] = (parent::getUserMeta($this->uri->segment(2),'spcode') != false ? parent::getUserMeta($this->uri->segment(2),'spcode') : '');


			$result['sphone'] = (parent::getUserMeta($this->uri->segment(2),'sphone') != false ? parent::getUserMeta($this->uri->segment(2),'sphone') : '');

			$result['semail'] = (parent::getUserMeta($this->uri->segment(2),'semail') != false ? parent::getUserMeta($this->uri->segment(2),'semail') : '');
			$result['sdob'] = (parent::getUserMeta($this->uri->segment(2),'sdob') != false ? parent::getUserMeta($this->uri->segment(2),'sdob') : '');

			$result['sdateav'] = (parent::getUserMeta($this->uri->segment(2),'sdateav') != false ? parent::getUserMeta($this->uri->segment(2),'sdateav') : '');

			$result['snic'] = (parent::getUserMeta($this->uri->segment(2),'snic') != false ? parent::getUserMeta($this->uri->segment(2),'snic') : '');
			$result['smthrlng'] = (parent::getUserMeta($this->uri->segment(2),'smthrlng') != false ? parent::getUserMeta($this->uri->segment(2),'smthrlng') : '');
			$result['saddlang'] = (parent::getUserMeta($this->uri->segment(2),'saddlang') != false ? parent::getUserMeta($this->uri->segment(2),'saddlang') : '');

			$result['sgrade'] = (parent::getUserMeta($this->uri->segment(2),'sgrade') != false ? parent::getUserMeta($this->uri->segment(2),'sgrade') : '');

			$result['father_name'] = (parent::getUserMeta($this->uri->segment(2),'father_name') != false ? parent::getUserMeta($this->uri->segment(2),'father_name') : '');

			$result['father_nic'] = (parent::getUserMeta($this->uri->segment(2),'father_nic') != false ? parent::getUserMeta($this->uri->segment(2),'father_nic') : '');

			$result['father_profession'] = (parent::getUserMeta($this->uri->segment(2),'father_profession') != false ? parent::getUserMeta($this->uri->segment(2),'father_profession') : '');

			$result['father_years'] = (parent::getUserMeta($this->uri->segment(2),'father_years') != false ? parent::getUserMeta($this->uri->segment(2),'father_years') : '');

			$result['father_company'] = (parent::getUserMeta($this->uri->segment(2),'father_company') != false ? parent::getUserMeta($this->uri->segment(2),'father_company') : '');

			$result['father_comapny_years'] = (parent::getUserMeta($this->uri->segment(2),'father_comapny_years') != false ? parent::getUserMeta($this->uri->segment(2),'father_comapny_years') : '');

			$result['monthly_income'] = (parent::getUserMeta($this->uri->segment(2),'monthly_income') != false ? parent::getUserMeta($this->uri->segment(2),'monthly_income') : '');
			$result['father_work_address'] = (parent::getUserMeta($this->uri->segment(2),'father_work_address') != false ? parent::getUserMeta($this->uri->segment(2),'father_work_address') : '');

			$result['father_monthly_income_2'] = (parent::getUserMeta($this->uri->segment(2),'father_monthly_income_2') != false ? parent::getUserMeta($this->uri->segment(2),'father_monthly_income_2') : '');

			$result['financial_assistance'] = (parent::getUserMeta($this->uri->segment(2),'financial_assistance') != false ? parent::getUserMeta($this->uri->segment(2),'financial_assistance') : '');

			$result['circumstances'] = (parent::getUserMeta($this->uri->segment(2),'circumstances') != false ? parent::getUserMeta($this->uri->segment(2),'circumstances') : '');

			$result['previous_school_1'] = (parent::getUserMeta($this->uri->segment(2),'previous_school_1') != false ? parent::getUserMeta($this->uri->segment(2),'previous_school_1') : '');

			$result['school_history_address_1'] = (parent::getUserMeta($this->uri->segment(2),'school_history_address_1') != false ? parent::getUserMeta($this->uri->segment(2),'school_history_address_1') : '');

			$result['from_1'] = (parent::getUserMeta($this->uri->segment(2),'from_1') != false ? parent::getUserMeta($this->uri->segment(2),'from_1') : '');

			$result['to_1'] = (parent::getUserMeta($this->uri->segment(2),'to_1') != false ? parent::getUserMeta($this->uri->segment(2),'to_1') : '');

			$result['previous_school_2'] = (parent::getUserMeta($this->uri->segment(2),'previous_school_2') != false ? parent::getUserMeta($this->uri->segment(2),'previous_school_2') : '');

			$result['school_history_address_2'] = (parent::getUserMeta($this->uri->segment(2),'school_history_address_2') != false ? parent::getUserMeta($this->uri->segment(2),'school_history_address_2') : '');

			$result['from_2'] = (parent::getUserMeta($this->uri->segment(2),'from_2') != false ? parent::getUserMeta($this->uri->segment(2),'from_2') : '');

			$result['to_2'] = (parent::getUserMeta($this->uri->segment(2),'to_2') != false ? parent::getUserMeta($this->uri->segment(2),'to_2') : '');

			$result['previous_school_3'] = (parent::getUserMeta($this->uri->segment(2),'previous_school_3') != false ? parent::getUserMeta($this->uri->segment(2),'previous_school_3') : '');

			$result['school_history_address_3'] = (parent::getUserMeta($this->uri->segment(2),'school_history_address_3') != false ? parent::getUserMeta($this->uri->segment(2),'school_history_address_3') : '');

			$result['from_3'] = (parent::getUserMeta($this->uri->segment(2),'from_3') != false ? parent::getUserMeta($this->uri->segment(2),'from_3') : '');

			$result['to_3'] = (parent::getUserMeta($this->uri->segment(2),'to_3') != false ? parent::getUserMeta($this->uri->segment(2),'to_3') : '');

			$result['student_reference_fullname'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_fullname') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_fullname') : '');

			$result['student_reference_relationship'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_relationship') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_relationship') : '');

			$result['student_refernce_company'] = (parent::getUserMeta($this->uri->segment(2),'student_refernce_company') != false ? parent::getUserMeta($this->uri->segment(2),'student_refernce_company') : '');

			$result['student_reference_phone'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_phone') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_phone') : '');

			$result['student_reference_adress'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_adress') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_adress') : '');

			$result['student_reference_fullname2'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_fullname2') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_fullname2') : '');

			$result['student_reference_relationship2'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_relationship2') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_relationship2') : '');

			$result['student_refernce_company2'] = (parent::getUserMeta($this->uri->segment(2),'student_refernce_company2') != false ? parent::getUserMeta($this->uri->segment(2),'student_refernce_company2') : '');

			$result['student_reference_phone2'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_phone2') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_phone2') : '');

			$result['student_reference_adress2'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_adress2') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_adress2') : '');

			$result['student_reference_fullname3'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_fullname3') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_fullname3') : '');

			$result['student_reference_relationship3'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_relationship3') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_relationship3') : '');

			$result['student_refernce_company3'] = (parent::getUserMeta($this->uri->segment(2),'student_refernce_company3') != false ? parent::getUserMeta($this->uri->segment(2),'student_refernce_company3') : '');

			$result['student_reference_phone3'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_phone3') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_phone3') : '');

			$result['student_reference_adress3'] = (parent::getUserMeta($this->uri->segment(2),'student_reference_adress3') != false ? parent::getUserMeta($this->uri->segment(2),'student_reference_adress3') : '');
			$result['student_signature'] = (parent::getUserMeta($this->uri->segment(2),'student_signature') != false ? parent::getUserMeta($this->uri->segment(2),'student_signature') : '');
			$result['student_submate_date'] = (parent::getUserMeta($this->uri->segment(2),'student_submate_date') != false ? parent::getUserMeta($this->uri->segment(2),'student_submate_date') : '');

			$this->operation->table_name ="student_semesters";

			$student_class_info = $this->operation->GetByWhere(array('studentid'=>$this->uri->segment(2)));
			if(count($student_class_info))
			{
				$result['class'] = $student_class_info[0]->classid;
				$result['section'] = $student_class_info[0]->sectionid;
				$result['semester'] = $student_class_info[0]->semesterid;
			}
			$this->data['result'] = $result;

		}





		//$this->data['classeslist'] = $this->operation->GetRowsByQyery("SELECT * from  classes");

		//$this->data['sectionslist'] = $this->operation->GetRowsByQyery("SELECT * from  sections");

		// if( $this->session->userdata('type')=='p') {

		// $classlist = $this->operation->GetRowsByQyery("SELECT  * FROM classes c");

	 //    } else if ($this->session->userdata('type')=='t') {

	 //    	# code...

	 //    	$classlist = $this->operation->GetRowsByQyery("select cl.id, cl.grade FROM schedule sch INNER JOIN classes cl on sch.class_id=cl.id where sch.teacher_uid=46 ");

	 //    }

		// $this->data['classlist'] = $classlist;

		//$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  * FROM sections where class_id =".$classlist[0]->id);

		if ($roles[0]['role_id'] ==3) {

			$classlist = $this->operation->GetRowsByQyery("SELECT  * FROM classes c");
			$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.* FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid =".$classlist[0]->id);


	    } if ($roles[0]['role_id'] ==4) {



	    	$classlist = $this->operation->GetRowsByQyery("select cl.id, cl.grade FROM schedule sch INNER JOIN classes cl on sch.class_id=cl.id where sch.teacher_uid= 
	    	".$this->session->userdata('id') );

	    }

		$this->data['classlist'] = $classlist;


		$this->session->unset_userdata('laststudentimgid');

		$this->load->view('principal/add_student',$this->data);

	}

/**

	 * Invantage  Teacher Form

	 *

	 * @access private

	 * @return return status

	*/



		public function add_teacher_form(){

			if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

			if($this->uri->segment(2) AND $this->uri->segment(2) != "page" )

			{

			$this->data['teacher_single'] = $this->operation->GetRowsByQyery("Select * from invantageuser where id= ".$this->uri->segment(2));

			$result['teacher_firstname'] = (parent::getUserMeta($this->uri->segment(2),'teacher_firstname') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_firstname') : '');

			$result['teacher_lastname'] = (parent::getUserMeta($this->uri->segment(2),'teacher_lastname') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_lastname') : '');

			$result['gender'] = (parent::getUserMeta($this->uri->segment(2),'teacher_gender') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_gender') : 'Male');

			$result['nic'] = (parent::getUserMeta($this->uri->segment(2),'teacher_nic') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_nic') : '');

			$result['teacher_religion'] = (parent::getUserMeta($this->uri->segment(2),'teacher_religion') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_religion') : '');

			$result['email'] = (parent::getUserMeta($this->uri->segment(2),'email') != false ? parent::getUserMeta($this->uri->segment(2),'email') : '');

			$result['teacher_phone'] = (parent::getUserMeta($this->uri->segment(2),'teacher_phone') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_phone') : '');

			$result['teacher_primary_address'] = (parent::getUserMeta($this->uri->segment(2),'teacher_primary_address') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_primary_address') : '');

            $result['secondary_address'] = (parent::getUserMeta($this->uri->segment(2),'teacher_secondry_adress') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_secondry_adress') : '');

			$result['province'] = (parent::getUserMeta($this->uri->segment(2),'teacher_province') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_province') : '');

			$result['teacher_city'] = (parent::getUserMeta($this->uri->segment(2),'teacher_city') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_city') : '');

			$result['teacher_zipcode'] = (parent::getUserMeta($this->uri->segment(2),'teacher_zipcode') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_zipcode') : '');

			//$result['location'] = (parent::getUserMeta($this->uri->segment(2),'location') != false ? parent::getUserMeta($this->uri->segment(2),'location') : '');

			$result['location'] = $value->location;



			$this->data['result'] = $result;


		}



		$this->load->view('principal/add_teacher',$this->data);

	}

	 /**

	 * Invantage save Teacher

	 *

	 * @access private

	 * @return return status

	*/







public function add_section_form(){



		$this->load->view('principal/add_section');

	}

	public function add_subject_form(){

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		if($this->uri->segment(2) AND $this->uri->segment(2) != "page" ){

			$this->data['subject_single'] = $this->operation->GetRowsByQyery("Select * from subjects where id= ".$this->uri->segment(2));

			$result['class'] = (parent::getUserMeta($this->uri->segment(2),'class') != false ? parent::getUserMeta($this->uri->segment(2),'class') : '');



		}



		$this->data['classeslist'] = $this->operation->GetRowsByQyery("SELECT  * FROM classes c");

		$this->load->view('principal/add_subject',$this->data);

	}





		public function assign_class_form(){

		$this->load->view('principal/assign_class_to_teacher');

	}





/* */

 /*



         * ---------------------------------------------------------



         *   Show All admin list after adding data through form



         * ---------------------------------------------------------



         */



	/**

	 * Load form

	 *

	 * @access private

	 */

	function show_parent_list()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		//$this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		$this->load->view('principal/show_parent_list',$this->data);

	}



	/**

	 * Load form

	 *

	 * @access private

	 */

	function show_teachers_list()

	{  if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$this->session->unset_userdata('laststudentimgid');
		$roles = $this->session->userdata('roles');
		$locations = $this->session->userdata('locations');

	    $teacherlist = array();

		$teacherlists = $this->operation->GetRowsByQyery("Select inuser.* from invantageuser inuser  INNER JOIN user_roles ur ON ur.user_id = inuser.id INNER JOIN user_locations ul ON ul.user_id = inuser.id Where ur.role_id = 4 AND user_active_status=1  AND ul.school_id =".$locations[0]['school_id']);

		if(count($teacherlists)){

			foreach ($teacherlists as $key => $value) {

				$teacherlist[] = array(

				'teacher_id'=> $value->id,

				'teacher_firstname'=> (parent::getUserMeta($value->id,'teacher_firstname') != false ? parent::getUserMeta($value->id,'teacher_firstname') : ''),

				'teacher_lastname'=> (parent::getUserMeta($value->id,'teacher_lastname') != false ? parent::getUserMeta($value->id,'teacher_lastname') : ''),
				'teacher_phone'=> (parent::getUserMeta($value->id,'teacher_phone') != false ? parent::getUserMeta($value->id,'teacher_phone') : ''),

				'email'=>$value->email,

				);

			}

		}



		$this->data['teacherlist'] = (object) $teacherlist;

	//	$this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		$this->load->view('principal/show_teacher_list',$this->data);

	}



	/**

	 * Get teacher by id

	 *

	 * @access private

	 */

	function GetTeacherById()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;



		$is_teacher_found = $this->operation->GetRowsByQyery("Select inuser.* from invantageuser inuser where inuser.type = 't' AND id = ".trim($this->input->get('id')));

		if(count($is_teacher_found)){

			$result['message'] = true;

			foreach ($is_teacher_found as $key => $value) {

				$result['teacher_id'] = $value->id;

				$result['teacher_firstname'] = (parent::getUserMeta($value->id,'teacher_firstname') != false ? parent::getUserMeta($value->id,'teacher_firstname') : '');

				$result['teacher_lastname'] = (parent::getUserMeta($value->id,'teacher_lastname') != false ? parent::getUserMeta($value->id,'teacher_lastname') : '');

				$result['email_get'] =$value->email;

				$result['profile_link'] = $value->profile_image;

				$result['teacher_religion'] = (parent::getUserMeta($value->id,'teacher_religion') != false ? parent::getUserMeta($value->id,'teacher_religion') : '');

				$result['gender'] = (parent::getUserMeta($value->id,'teacher_gender') != false ? parent::getUserMeta($value->id,'teacher_gender') : 'Male');

				$result['nic'] = (parent::getUserMeta($value->id,'teacher_nic') != false ? parent::getUserMeta($value->id,'teacher_nic') : '');

				$result['phone'] = (parent::getUserMeta($value->id,'teacher_phone') != false ? parent::getUserMeta($value->id,'teacher_phone') : '');

				$result['primary_address'] = (parent::getUserMeta($value->id,'teacher_primary_address') != false ? parent::getUserMeta($value->id,'teacher_primary_address') : '');

				$result['secondary_address'] = (parent::getUserMeta($value->id,'teacher_secondry_adress') != false ? parent::getUserMeta($value->id,'teacher_secondry_adress') : '');

				$result['city'] = (parent::getUserMeta($value->id,'teacher_city') != false ? parent::getUserMeta($value->id,'teacher_city') : '');

				$result['province'] = (parent::getUserMeta($value->id,'teacher_province') != false ? parent::getUserMeta($value->id,'teacher_province') : '');

				$result['teacher_zipcode'] = (parent::getUserMeta($value->id,'teacher_zipcode') != false ? parent::getUserMeta($value->id,'teacher_zipcode') : '');

				$result['email'] = (parent::getUserMeta($value->id,'email') != false ? parent::getUserMeta($value->id,'email') : '');



			}

		}

		echo json_encode($result);

	}



			/**

	 * Remove Teachers

	 *

	 * @access private

	 * @return array return json array message if user deleted

	 */

	function removeTeacher(){

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

	$result['message'] = false;

		$removeStudent = $this->db->query("Delete from invantageuser where id = ".$this->input->get('id'));
		$removeStudent = $this->db->query("Delete from user_meta where user_id = ".$this->input->get('id'));



		if($removeStudent == TRUE):

			$result['message'] = true;

		endif;

		echo json_encode($result);

	}



/**

	 * Load form

	 *

	 * @access private

	 */

function show_stds_list()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$studentlist = array();
		$locations = $this->session->userdata('locations');

		$roles = $this->session->userdata('roles');
        if ($roles[0]['role_id'] ==4)
		{
			 $studentslists = $this->operation->GetRowsByQyery("select inv.screenname,inv.id,cl.grade,sc.section_name from student_semesters ss INNER join classes cl on ss.classid=cl.id INNER join sections sc on ss.sectionid=sc.id INNER join invantageuser inv on  inv.id = ss.studentid INNER join schedule sch on ss.classid=sch.class_id  where ss.status = 'r' AND sch.teacher_uid=".$this->session->userdata('id')." and sc.id = sch.section_id and user_active_status = 1 GROUP by inv.id");

		}
		else
		{
			$studentslists = $this->operation->GetRowsByQyery("SELECT inv.screenname,inv.id,cl.grade,sc.section_name from invantageuser inv INNER join user_locations ul on ul.user_id = inv.id INNER join student_semesters ss on inv.id = ss.studentid INNER join classes cl on ss.classid=cl.id inner join sections sc on ss.sectionid=sc.id where ss.status = 'r' AND ul.school_id = ".$locations[0]['school_id']." and user_active_status= 1 group by inv.id");
		}

		if(count($studentslists) > 0){
			foreach ($studentslists as $key => $value) {
				if(!is_null($value->id)){
				$classlist = $this->operation->GetRowsByQyery("Select c.grade,se.section_name from student_semesters s  INNER JOIN classes c on c.id = s.classid INNER JOIN sections se on se.id = s.sectionid   where s.status = 'r' and s.studentid = ".$value->id);
				
				$classname = '';
				if(count($classlist))
				{
					$classname = $classlist[0]->grade.' ('.$classlist[0]->section_name.' )';
				}
					$studentlist[] = array(
						'student_id'=> $value->id,
						'student_name'=> (parent::getUserMeta($value->id,'sfullname') != false ? parent::getUserMeta($value->id,'sfullname') : ''),
						'slastname'=> (parent::getUserMeta($value->id,'slastname') != false ? parent::getUserMeta($value->id,'slastname') : ''),
						'roll_number'=> (parent::getUserMeta($value->id,'roll_number') != false ? parent::getUserMeta($value->id,'roll_number') : ''),
						'sdob'=> (parent::getUserMeta($value->id,'sdob') != false ? parent::getUserMeta($value->id,'sdob') : ''),
						'parent_name'=> (parent::getUserMeta($value->id,'father_name') != false ? parent::getUserMeta($value->id,'father_name') : ''),
						'sphone'=> (parent::getUserMeta($value->id,'phone') != false ? parent::getUserMeta($value->id,'sphone') : ''),
						'financial_assistance'=> (parent::getUserMeta($value->id,'financial_assistance') != '' ? parent::getUserMeta($value->id,'financial_assistance') : 'No'),
						
						'class'=> $classname
					);
				}
			}
		}

		$this->data['studentlist'] = (object) $studentlist;
		$this->load->view('principal/show_student_list',$this->data);
	}




	/**

	 * Get students by id

	 *

	 * @access private

	 */

	function GetStudentById()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;



		$is_student_found = $this->operation->GetRowsByQyery("Select inuser.*,s.classid as cid,s.sectionid as sid,sec.section_name as section_name,cl.grade as grade from invantageuser inuser INNER JOIN student_semesters s on s.studentid = inuser.id INNER JOIN classes cl on s.classid=cl.id INNER join sections sec on s.sectionid=sec.id
			where inuser.type = 's' AND inuser.id= ".trim($this->input->get('id')));

		if(count($is_student_found)){

			$result['message'] = true;

			foreach ($is_student_found as $key => $value) {

				$result['student_id'] = $value->id;

				$result['roll_number'] = $value->username;

				$result['screenname'] = $value->screenname;

				$result['profile_link'] =$value->profile_image;
				$result['slastname'] = (parent::getUserMeta($value->id,'slastname') != false ? parent::getUserMeta($value->id,'slastname') : '');

				$result['saddress'] = (parent::getUserMeta($value->id,'saddress') != false ? parent::getUserMeta($value->id,'saddress') : '');

				$result['shunit'] = (parent::getUserMeta($value->id,'shunit') != false ? parent::getUserMeta($value->id,'shunit') : '');

				$result['sprovice'] = (parent::getUserMeta($value->id,'sprovice') != false ? parent::getUserMeta($value->id,'sprovice') : '');

				$result['scity'] = (parent::getUserMeta($value->id,'scity') != false ? parent::getUserMeta($value->id,'scity') : '');


				$result['spcode'] = (parent::getUserMeta($value->id,'spcode') != false ? parent::getUserMeta($value->id,'spcode') : '');

				$result['sphone'] = (parent::getUserMeta($value->id,'sphone') != false ? parent::getUserMeta($value->id,'sphone') : '');

				$result['semail'] = (parent::getUserMeta($value->id,'semail') != false ? parent::getUserMeta($value->id,'semail') : '');
				$result['sdob'] = (parent::getUserMeta($value->id,'sdob') != false ? parent::getUserMeta($value->id,'sdob') : '');

				$result['sdateav'] = (parent::getUserMeta($value->id,'sdateav') != false ? parent::getUserMeta($value->id,'sdateav') : '');

				$result['snic'] = (parent::getUserMeta($value->id,'snic') != false ? parent::getUserMeta($value->id,'snic') : '');

				$result['smthrlng'] = (parent::getUserMeta($value->id,'smthrlng') != false ? parent::getUserMeta($value->id,'smthrlng') : '');
				$result['saddlang'] = (parent::getUserMeta($value->id,'saddlang') != false ? parent::getUserMeta($value->id,'saddlang') : '');

				$result['sgrade'] = $value->grade;

				$result['father_name'] = (parent::getUserMeta($value->id,'father_name') != false ? parent::getUserMeta($value->id,'father_name') : '');

				$result['father_nic'] = (parent::getUserMeta($value->id,'father_nic') != false ? parent::getUserMeta($value->id,'father_nic') : '');

				$result['father_profession'] = (parent::getUserMeta($value->id,'father_profession') != false ? parent::getUserMeta($value->id,'father_profession') : '');

				$result['father_years'] = (parent::getUserMeta($value->id,'father_years') != false ? parent::getUserMeta($value->id,'father_years') : '');

				$result['father_company'] = (parent::getUserMeta($value->id,'father_company') != false ? parent::getUserMeta($value->id,'father_company') : '');

				$result['father_comapny_years'] = (parent::getUserMeta($value->id,'father_comapny_years') != false ? parent::getUserMeta($value->id,'father_comapny_years') : '');

				$result['monthly_income'] = (parent::getUserMeta($value->id,'monthly_income') != false ? parent::getUserMeta($value->id,'monthly_income') : '');

				$result['father_work_address'] = (parent::getUserMeta($value->id,'father_work_address') != false ? parent::getUserMeta($value->id,'father_work_address') : '');

				$result['father_monthly_income_2'] = (parent::getUserMeta($value->id,'father_monthly_income_2') != false ? parent::getUserMeta($value->id,'father_monthly_income_2') : '');

				$result['financial_assistance'] = (parent::getUserMeta($value->id,'financial_assistance') != false ? parent::getUserMeta($value->id,'financial_assistance') : '');

				$result['circumstances'] = (parent::getUserMeta($value->id,'circumstances') != false ? parent::getUserMeta($value->id,'circumstances') : '');

				$result['previous_school_1'] = (parent::getUserMeta($value->id,'previous_school_1') != false ? parent::getUserMeta($value->id,'previous_school_1') : '');

				$result['school_history_address_1'] = (parent::getUserMeta($value->id,'school_history_address_1') != false ? parent::getUserMeta($value->id,'school_history_address_1') : '');

				$result['from_1'] = (parent::getUserMeta($value->id,'from_1') != false ? parent::getUserMeta($value->id,'from_1') : '');

				$result['to_1'] = (parent::getUserMeta($value->id,'to_1') != false ? parent::getUserMeta($value->id,'to_1') : '');

				$result['previous_school_2'] = (parent::getUserMeta($value->id,'previous_school_2') != false ? parent::getUserMeta($value->id,'previous_school_2') : '');

				$result['school_history_address_2'] = (parent::getUserMeta($value->id,'school_history_address_2') != false ? parent::getUserMeta($value->id,'school_history_address_2') : '');

				$result['from_2'] = (parent::getUserMeta($value->id,'from_2') != false ? parent::getUserMeta($value->id,'from_2') : '');

				$result['to_2'] = (parent::getUserMeta($value->id,'to_2') != false ? parent::getUserMeta($value->id,'to_2') : '');

				$result['previous_school_3'] = (parent::getUserMeta($value->id,'previous_school_3') != false ? parent::getUserMeta($value->id,'previous_school_3') : '');

				$result['school_history_address_3'] = (parent::getUserMeta($value->id,'school_history_address_3') != false ? parent::getUserMeta($value->id,'school_history_address_3') : '');

				$result['from_3'] = (parent::getUserMeta($value->id,'from_3') != false ? parent::getUserMeta($value->id,'from_3') : '');

				$result['to_3'] = (parent::getUserMeta($value->id,'to_3') != false ? parent::getUserMeta($value->id,'to_3') : '');

				$result['student_reference_fullname'] = (parent::getUserMeta($value->id,'student_reference_fullname') != false ? parent::getUserMeta($value->id,'student_reference_fullname') : '');

				$result['student_reference_relationship'] = (parent::getUserMeta($value->id,'student_reference_relationship') != false ? parent::getUserMeta($value->id,'student_reference_relationship') : '');

				$result['student_refernce_company'] = (parent::getUserMeta($value->id,'student_refernce_company') != false ? parent::getUserMeta($value->id,'student_refernce_company') : '');

				$result['student_reference_phone'] = (parent::getUserMeta($value->id,'student_reference_phone') != false ? parent::getUserMeta($value->id,'student_reference_phone') : '');

				$result['student_reference_adress'] = (parent::getUserMeta($value->id,'student_reference_adress') != false ? parent::getUserMeta($value->id,'student_reference_adress') : '');

				$result['student_reference_fullname2'] = (parent::getUserMeta($value->id,'student_reference_fullname2') != false ? parent::getUserMeta($value->id,'student_reference_fullname2') : '');

				$result['student_reference_relationship2'] = (parent::getUserMeta($value->id,'student_reference_relationship2') != false ? parent::getUserMeta($value->id,'student_reference_relationship2') : '');

				$result['student_refernce_company2'] = (parent::getUserMeta($value->id,'student_refernce_company2') != false ? parent::getUserMeta($value->id,'student_refernce_company2') : '');

				$result['student_reference_phone2'] = (parent::getUserMeta($value->id,'student_reference_phone2') != false ? parent::getUserMeta($value->id,'student_reference_phone2') : '');

				$result['student_reference_adress2'] = (parent::getUserMeta($value->id,'student_reference_adress2') != false ? parent::getUserMeta($value->id,'student_reference_adress2') : '');

				$result['student_reference_fullname3'] = (parent::getUserMeta($value->id,'student_reference_fullname3') != false ? parent::getUserMeta($value->id,'student_reference_fullname3') : '');

				$result['student_reference_relationship3'] = (parent::getUserMeta($value->id,'student_reference_relationship3') != false ? parent::getUserMeta($value->id,'student_reference_relationship3') : '');

				$result['student_refernce_company3'] = (parent::getUserMeta($value->id,'student_refernce_company3') != false ? parent::getUserMeta($value->id,'student_refernce_company3') : '');

				$result['student_reference_phone3'] = (parent::getUserMeta($value->id,'student_reference_phone3') != false ? parent::getUserMeta($value->id,'student_reference_phone3') : '');

				$result['student_reference_adress3'] = (parent::getUserMeta($value->id,'student_reference_adress3') != false ? parent::getUserMeta($value->id,'student_reference_adress3') : '');
				$result['student_reference_3'] = (parent::getUserMeta($value->id,'student_reference_adress3') != false ? parent::getUserMeta($value->id,'student_reference_adress3') : '');



			}

		}

		echo json_encode($result);

	}



		/**

	 * Remove Students

	 *

	 * @access private

	 * @return array return json array message if user deleted

	 */

	function removeStudent(){

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		//$studentprofileimageinfo = $this->operation->GetRowsByQyery("Select profile_image from invantageuser where id = ".$this->input->get('id'));
		$removeStudent = $this->db->query("Delete from invantageuser where id = ".$this->input->get('id'));

		$removeStudent = $this->db->query("Delete from user_meta where user_id = ".$this->input->get('id'));
		// $file_ext = explode('.'$studentprofileimageinfo[0]->profile_image);
		// $file_name = basename($studentprofileimageinfo[0]->profile_image);

		//echo delete_files($studentprofileimageinfo[0]->profile_image);

		if($removeStudent == TRUE):

			$result['message'] = true;

		endif;

		echo json_encode($result);

	}







	public function show_class_list(){

     // $this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}
			$locations = $this->session->userdata('locations');
				$roles = $this->session->userdata('roles');

			if( $roles[0]['role_id'] == 3){



			$this->data['clists']	 = $this->operation->GetRowsByQyery("SELECT cl.id,cl.grade,s.section_name from assignsections ass inner JOIN sections s on s.id = ass.sectionid inner JOIN classes cl on cl.id =ass.classid where cl.school_id =".$locations[0]['school_id']);

		}

		else if( $roles[0]['role_id'] == 4){

		$id=$this->session->userdata('id');

			$this->data['clists']=$this->operation->GetRowsByQyery("select cl.id, cl.grade,sc.section_name from schedule s inner join classes cl on cl.id = s.class_id inner join sections sc on sc.id = s.section_id  where s.teacher_uid = ".$this->session->userdata('id')." group by cl.id");
			//$this->data['clists']=$this->operation->GetRowsByQyery("select cl.id, cl.grade,sc.section_name from assignsections assisect inner join schedule s on s.class_id =sc.id inner join sections sc on assisect.sectionid=sc.id inner join classes cl on assisect.classid=cl.id  where cl.school_id=".$locations[0]['school_id']);

		}

			$this->load->view('principal/class_list',$this->data);

		}



			/**

	 * Remove class

	 *

	 * @access private

	 * @return array return json array message if user deleted

	 */

	function removeClas(){

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		$removeClass = $this->db->query("Delete from classes where id =".trim($_GET['id']));



		if($removeClass == TRUE):

			$result['message'] = true;


		endif;

		echo json_encode($result);

	}



	    public function show_subject_list() {

	    	if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

			$locations = $this->session->userdata('locations');

			$roles = $this->session->userdata('roles');
  
            
            $this->operation->table_name = 'sessions';
            $active_session = $this->operation->GetByWhere(array('school_id'=>$locations[0]['school_id'],'status'=>'a'));


            $this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
         
			if( $roles[0]['role_id'] == 3 && count($active_session) && count($active_semester)){

				$subjectlist	 = $this->operation->GetRowsByQyery("SELECT s.id as subid, s.* FROM subjects s INNER JOIN classes c On c.id =s.class_id where c.school_id =".$locations[0]['school_id']." AND s.session_id = ".$active_session[0]->id." AND s.semsterid = ".$active_semester[0]->semester_id." ORDER BY s.subject_name ASC");
				
				$subject_array = array();

					foreach ($subjectlist as $key => $value) {

						$class_query = $this->operation->GetRowsByQyery('SELECT  * FROM classes where id='.$value->class_id." AND school_id =".$locations[0]['school_id']);

						$class = '';

						if(count($class_query)){

							foreach ($class_query as $key => $cvalue) {

								$class .= $cvalue->grade.'('.$cvalue->section_name.')'.' ,';

							}

						}

						$class = rtrim($class,',');

						$subject_array[] = array(

							'id'=>$value->id,

							'name'=>$value->subject_name,

							'subject_image'=>$value->subject_image,
							'code'=>$value->subject_code,

							'class'=>$class_query[0]->grade
						)	;
					}
				}

			 else if( $roles[0]['role_id'] == 4 && count($active_session) && count($active_semester)){

			 	
            	$subjectlist= $this->operation->GetRowsByQyery("SELECT sb.id,cl.grade,sc.section_name,sb.subject_name,sb.subject_code FROM schedule sch INNER JOIN classes cl ON sch.class_id=cl.id INNER JOIN sections sc ON sch.section_id=sc.id INNER JOIN subjects sb ON sch.subject_id=sb.id WHERE sch.teacher_uid=".$this->session->userdata('id') . " AND sb.semsterid = " . $active_semester[0]->semester_id);

				if(Count($subjectlist))
				{
					foreach ($subjectlist as $key => $value) {

						$subject_array[] = array(

							'id'=>$value->id,

							'name'=>$value->subject_name,

							'code'=>$value->subject_code,

							'class'=>$value->grade,

						)	;

					}
				}


			}


	     $this->data['subjectlist'] = $subject_array;

	     $this->operation->table_name = "subjects";

		$is_subject_found = $this->operation->GetRows();

		if(count($is_subject_found))
		{

			foreach ($is_subject_found as $key => $value) {
				$subjects[] = array(

					'subid'=>$value->id,

					'name'=>$value->subject_name,
					'subject_image'=>$value->subject_image,

					'class'=>parent::getClass($value->class_id),

				);

			}

		}

		if( $roles[0]['role_id'] == 3){

			$classlist = $this->operation->GetRowsByQyery("SELECT  * FROM classes c where c.school_id =".$locations[0]['school_id']);
			if(Count($classlist)){
				$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid =".$classlist[0]->id);
			}
			else{
				$this->data['sectionlist'] = [];
			}
	    } else if( $roles[0]['role_id'] == 4){

	    	$classlist = $this->operation->GetRowsByQyery("select cl.id, cl.grade FROM schedule sch INNER JOIN classes cl on sch.class_id=cl.id where cl.school_id = ".$locations[0]['school_id']." AND  sch.teacher_uid= ".$this->session->userdata('id'));
			if(Count($classlist)){
					$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid =".$classlist[0]->id);
			}
			else{
				$this->data['sectionlist'] = [];
			}


    }



		$this->data['classlist'] = $classlist;


		$this->data['subjects'] = $subjects;


		$this->load->view('principal/show_sub_list',$this->data);



	     }





	 public function show_section_list() {

	 	//$this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		$this->load->view('principal/section_list',$this->data);



	 }



	 public function show_assign_class() {

	 	if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}
	 	$this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		$this->load->view('principal/assign_class_list',$this->data);



	 }



	 function GetLessonPlanById()

	 {

	 	if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

	 	$result = array();

	 	if($this->input->get('showModel'))

		{

			$lessonlist = $this->operation->GetRowsByQyery("SELECT ls.*,ls.id as lsid from lessons ls INNER JOIN lesson_read lr on lr.lesson_id=ls.id where subjectid=".$this->input->get('id'));

			if(count($lessonlist)){

				foreach ($lessonlist as $key => $value) {

					$result[] = array(

						'id'=>$value->lsid,

						'title'=>$value->title,

						'date'=>$value->date

					);

				}



			}



		}

		echo json_encode($result);

	 }



	 /**

	 * Invantage user

	 *

	 * @access private

	 * @return return status

	*/

/* saaaaaaaaaave LMS teacher START */

	function saveInvantageTeacher()

	{

		if(!($this->session->userdata('id'))){
				parent::redirectUrl('signin');
			}

		$result['message'] = false;



		$this->form_validation->set_rules('inputFirstName', 'Valid First Name Required', 'trim|required|min_length[3]');

		$this->form_validation->set_rules('inputLastName', 'Valid Last Name Required', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE){

			$result['message'] =  false;

		}

		else{

			if($this->input->post('serial')){



				$this->operation->table_name = 'invantageuser';

				$teacherId = $this->user->TeacherInfo(
					$this->input->post('serial'),
					ucwords($this->input->post('inputFirstName')),

	                $this->input->post('inputLastName'),

					$this->input->post('input_t_gender'),

					trim($this->input->post('inputTeacher_Nic')),

					trim($this->input->post('input_teacher_email')),

					trim($this->input->post('input_pr_phone')),

					trim($this->input->post('inputNewPassword')),

					trim($this->input->post('pr_home')),

					trim($this->input->post('sc_home')),

					trim($this->input->post('inputProvice')),

					trim($this->input->post('input_city')),

					trim($this->input->post('input_zipcode')),


					$this->input->post('inputMasterteacher')

				);


				$result['message'] = true;

				$result['lastid'] = $this->input->post('serial');

			}

			else {

			if(trim($this->input->post('inputNewPassword')) == trim($this->input->post('inputRetypeNewPassword'))){

				// insert

				$teacherId = $this->user->TeacherInfo(
					null,
					ucwords($this->input->post('inputFirstName')),

					$this->input->post('inputLastName'),

					$this->input->post('input_t_gender'),

					trim($this->input->post('inputTeacher_Nic')),


					trim($this->input->post('input_teacher_email')),

					trim($this->input->post('input_pr_phone')),

					trim($this->input->post('inputNewPassword')),

					trim($this->input->post('pr_home')),

					trim($this->input->post('sc_home')),

					trim($this->input->post('inputProvice')),

					trim($this->input->post('input_city')),

					trim($this->input->post('input_zipcode')),


					$this->input->post('inputMasterteacher')

				);


				$result['lastid'] = $teacherId;

				$result['message'] =  true;

			}



			}

		}

		

		echo json_encode($result);

	}
	function uploadTeacherimg(){

			$result['message'] = false;

			if(isset($_FILES) == 1){

				// Save in database

				foreach ($_FILES as $key => $value) {

					$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG","PNG","GIF","BMP","doc","DOC","PDF","pdf","DOCX","docx","xls","XLS","XLSX","xlsx");

			        if(strlen($value['name'])){

			            list($txt, $ext) = explode(".", $value['name']);

			            if(in_array(strtolower($ext),$valid_formats)){

			            	if ($value["size"] < 5000000) {

		 						$filename = time().trim(basename($value['name']));

		 						$base_url_path = base_url()."upload/profile/".$filename;

		 						$teacher =  array(

	 											'profile_image'=>$base_url_path,

									);

								$this->operation->table_name = 'invantageuser';

								$id = $this->operation->Create($teacher,$_POST['teacherId']);

					 			if($id){

									if(is_uploaded_file($value['tmp_name'])){
                                        
								// 		$path = base_url()."upload/profile/";
                                        $path = $_SERVER['DOCUMENT_ROOT']."/upload/profile/";
								 		$filename = $path.$filename;

								 		if(move_uploaded_file($value['tmp_name'],$filename)){

									 		$result['message'] = true;

									 	}

									}

								}

						 	}

			            }

			        }



				}

			}

			echo json_encode($result);

		}


		function fullname_validation($name)
		{
			if (!preg_match("/^[a-zA-Z ]{3,50}$/",$name)) {
				return false;
			}
			else{
				return true;
			}
		}




/* saveeeeeeeeeeee LMS TEACHER END */




	function saveInvantageUser()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		$this->form_validation->set_rules('inputStudentName', 'Valid First Name Required', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('inputStudentLastName', 'Valid First Name Required', 'trim|required|min_length[3]');

		$this->form_validation->set_rules('inputStudentAddress', 'Valid Last Name Required', 'trim|required|min_length[3]');

		//$this->form_validation->set_rules('inputPhone', 'Valid Phone No Required', 'trim|required|min_length[7]|max_length[15]');

		//$this->form_validation->set_rules('inputCnic', 'Valid NIC No Required', 'trim|required|min_length[7]|max_length[15]');




		if ($this->form_validation->run() == FALSE){
            
			$result['message'] =  false;
			$result['reason'] =  "Validation failed";

		}else {

			if($this->input->post('serial')){



				$this->operation->table_name = 'invantageuser';

				$userId = $this->user->StudentInfo($this->input->post('serial'),ucwords($this->input->post('inputStudentName')),

				$this->input->post('inputStudentLastName'),
				$this->input->post('inputStudentAddress'),

				$this->input->post('iputHouseUnit'),

				trim($this->input->post('inputCity')),

				trim($this->input->post('inputProvice')),

				trim($this->input->post('inputPostCode')),

				trim($this->input->post('inputPhone')),

				trim($this->input->post('student_dob')),

				trim($this->input->post('inputDateAvai')),

				trim($this->input->post('inputCnic')),
				trim($this->input->post('inputMohterLang')),

				trim($this->input->post('inputLanguage')),

				trim($this->input->post('inputSection')),

				trim($this->input->post('select_class')),

				trim($this->input->post('inputFathername')),

				trim($this->input->post('inputFatherNic')),

				trim($this->input->post('inputProfession')),

				trim($this->input->post('inputYear')),

				trim($this->input->post('inputCompany')),

				trim($this->input->post('inputCYears')),

				trim($this->input->post('inputIncome')),

				trim($this->input->post('inputWorkAddress')),

				trim($this->input->post('inputMonthlyIncome')),

				trim($this->input->post('inputAssistance')),

				trim($this->input->post('inputCircumstances')),

				trim($this->input->post('inputPrevisous1')),

				trim($this->input->post('inputAddress1')),

				trim($this->input->post('inputFrom1')),

				trim($this->input->post('inputTo1')),

				trim($this->input->post('inputPrevisous2')),

				trim($this->input->post('inputAddress2')),

				trim($this->input->post('inputFrom2')),

				trim($this->input->post('inputTo2')),

				trim($this->input->post('inputPrevisous3')),

				trim($this->input->post('inputAddress3')),

				trim($this->input->post('inputFrom3')),

				trim($this->input->post('inputTo3')),

				trim($this->input->post('inputRefFullname1')),

				trim($this->input->post('inputRelationship1')),

				trim($this->input->post('inputRefCompany1')),

				trim($this->input->post('inputPhone1')),

				trim($this->input->post('inputRefAddress1')),

				trim($this->input->post('inputRefFullname2')),

				trim($this->input->post('inputRelationship2')),

				trim($this->input->post('inputRefCompany2')),

				trim($this->input->post('inputPhone2')),

				trim($this->input->post('inputRefAddress2')),

				trim($this->input->post('inputRefFullname3')),

				trim($this->input->post('inputRelationship3')),

				trim($this->input->post('inputRefCompany3')),

				trim($this->input->post('inputPhone3')),

				$this->input->post('inputRefAddress3'),

				$this->input->post('inputSemester'),
				$this->input->post('inputSignature'),
				$this->input->post('inputSubmitDate')
				);
				$result['message'] = true;

				$result['lastid'] = $this->input->post('serial');

			}

		else{



			// insert

			$userId = $this->user->StudentInfo(
				null,
				ucwords($this->input->post('inputStudentName')),
				$this->input->post('inputStudentLastName'),

				$this->input->post('inputStudentAddress'),

				$this->input->post('iputHouseUnit'),

				trim($this->input->post('inputCity')),

				trim($this->input->post('inputProvice')),

				trim($this->input->post('inputPostCode')),

				trim($this->input->post('inputPhone')),

				trim($this->input->post('student_dob')),

				trim($this->input->post('inputDateAvai')),

				trim($this->input->post('inputCnic')),
				trim($this->input->post('inputMohterLang')),
				
				trim($this->input->post('inputLanguage')),

				trim($this->input->post('select_class')),

				trim($this->input->post('inputSection')),

				trim($this->input->post('inputFathername')),

				trim($this->input->post('inputFatherNic')),

				trim($this->input->post('inputProfession')),

				trim($this->input->post('inputYear')),

				trim($this->input->post('inputCompany')),

				trim($this->input->post('inputCYears')),

				trim($this->input->post('inputIncome')),

				trim($this->input->post('inputWorkAddress')),

				trim($this->input->post('inputMonthlyIncome')),

				trim($this->input->post('inputAssistance')),

				trim($this->input->post('inputCircumstances')),

				trim($this->input->post('inputPrevisous1')),

				trim($this->input->post('inputAddress1')),

				trim($this->input->post('inputFrom1')),

				trim($this->input->post('inputTo1')),

				trim($this->input->post('inputPrevisous2')),

				trim($this->input->post('inputAddress2')),

				trim($this->input->post('inputFrom2')),

				trim($this->input->post('inputTo2')),

				trim($this->input->post('inputPrevisous3')),

				trim($this->input->post('inputAddress3')),

				trim($this->input->post('inputFrom3')),

				trim($this->input->post('inputTo3')),

				trim($this->input->post('inputRefFullname1')),

				trim($this->input->post('inputRelationship1')),

				trim($this->input->post('inputRefCompany1')),

				trim($this->input->post('inputPhone1')),

				trim($this->input->post('inputRefAddress1')),

				trim($this->input->post('inputRefFullname2')),

				trim($this->input->post('inputRelationship2')),

				trim($this->input->post('inputRefCompany2')),

				trim($this->input->post('inputPhone2')),

				trim($this->input->post('inputRefAddress2')),

				trim($this->input->post('inputRefFullname3')),

				trim($this->input->post('inputRelationship3')),

				trim($this->input->post('inputRefCompany3')),

				trim($this->input->post('inputPhone3')),

				trim($this->input->post('inputRefAddress3')),

				$this->input->post('inputSemester'),
				$this->input->post('inputSignature'),
				$this->input->post('inputSubmitDate')

						);
			
			if($userId == true)
			{
				$result['message'] = true;
				$result['lastid'] = $userId;
			}
			
			//echo $this->db->last_query();
			

		    }

		 }

		echo json_encode($result);

	}



		function uploadStudentProfile(){

			$result['message'] = false;

			if(isset($_FILES) == 1){

				// Save in database

				foreach ($_FILES as $key => $value) {

					$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG","PNG","GIF","BMP","doc","DOC","PDF","pdf","DOCX","docx","xls","XLS","XLSX","xlsx");

			        if(strlen($value['name'])){

			            list($txt, $ext) = explode(".", $value['name']);

			            if(in_array(strtolower($ext),$valid_formats)){

			            	if ($value["size"] < 5000000) {

		 						$filename = time().trim(basename($value['name']));

		 						$base_url_path = base_url()."upload/profile/".$filename;

		 						$student =  array(

	 											'profile_image'=>$base_url_path,

									);



								$this->operation->table_name = 'invantageuser';



								$id = $this->operation->Create($student,$_POST['userId']);

					 			if($id){

									if(is_uploaded_file($value['tmp_name'])){

										$path = UPLOAD_PATH."profile/";

								 		$filename = $path.$filename;

								 		if(move_uploaded_file($value['tmp_name'],$filename)){

									 		$result['message'] = true;

									 	}

									}

								}

						 	}

			            }

			        }



				}

			}

		else

		{

			$result['message'] = true;

		}

			echo json_encode($result);

		}


function uploadContent()
{
	if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}
		$result['message'] = false;
		$result['fileexist'] = false;



			if(isset($_FILES) == 1)
			{

				foreach ($_FILES as $key => $value)
				 {

					$valid_formats = array("jpg","mp4","doc","xls","3gp","pdf", "png", "gif", "bmp","jpeg","docx","xlsx");

			        if(strlen($value['name']))

			        {

			            list($txt, $ext) = explode(".", $value['name']);

			            if(in_array(strtolower($ext),$valid_formats))
			            {

			            	if ($value["size"] < 500000000000)
			            	 {

		 						$filename =trim(basename($value['name']));
		 						$filename =str_replace(" ","_",trim($filename));
		 						$txt =str_replace(" ","_",trim($txt));

		 					 $base_url_path = IMAGE_LINK_PATH."content/".$this->input->post('classname')."/".$this->input->post('subjectname')."/".$filename;

  

    	 						$cid=$_POST['id'];
    
    	 						$ctype=$_POST['contenttype'];
    
    
    	 						$result['fileexist'] = false;
    
    	 						if($ctype == 'thumb'){
    		 						$content =  array(
    		 							'thumb'=>$base_url_path,
    		 						);
    		 					}else{
    		 						$content =  array(
    		 							'content'=>$base_url_path,
    		 						);
    		 					}
								        $this->operation->table_name = 'defaultlessonplan';
										$this->operation->Create($content,$cid);

										 $path = UPLOAD_PATH."content/";

								 		$newfilename = $path.$filename;
         
								 	if(!file_exists($newfilename)){
									if(is_uploaded_file($value['tmp_name']))
									{
										 $path = UPLOAD_PATH."content/".$this->input->post('classname')."/".$this->input->post('subjectname')."/";

								 		$newfilename = $path.$filename;
                  
								 		if(move_uploaded_file($value['tmp_name'],$newfilename))
								 		{
								 			$result['message'] = true;

									 	}

									}

								}
								else
								{
									$result['fileexist'] = true;
								}

						 	}

			            }

			        }



				}

			}

		else

		{

			$result['message'] = false;

		}

			echo json_encode($result);

		}


	public function SaveClass()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		$this->form_validation->set_rules('input_class_name', 'Title Required', 'trim|required|min_length[1]|max_length[50]');


		if ($this->form_validation->run() == FALSE){

			$result['message'] = false;

		}

		else{

			if($this->input->post('inputclassid') != null){

				$class =  array('grade'=>$this->input->post('input_class_name'),

								'last_update'=>date("Y-m-d H:i"),
						
								);

				$this->operation->table_name = 'classes';

				$id = $this->operation->Create($class,$this->input->post('inputclassid'));

				$result['message'] = true;

			}

			else {


					$locations = $this->session->userdata('locations');
					
				$class =  array('grade'=>$this->input->post('input_class_name'),
								'last_update'=>date("Y-m-d H:i"),
								'school_id'=>$locations[0]['school_id'],
								);

				$this->operation->table_name = 'classes';
				$id = $this->operation->Create($class);

				$result['message'] = true;

			}

		}

		echo json_encode($result);

	}



	public function SaveSubjects()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		$this->form_validation->set_rules('subj_name', 'Title Required', 'trim|min_length[3]|max_length[50]');

		$this->form_validation->set_rules('class_name', 'Description Required', 'trim');

			//$this->form_validation->set_rules('select_year', 'Description Required', 'trim');

		if ($this->form_validation->run() == FALSE){

			$result['message'] = false;

		}

		else{
			$subjectfile = '';
			$active_session = parent::GetUserActiveSession();
			

			if($this->input->post('serial') && $this->input->post('is_image_edit') == false) {
				$is_user_found = $this->operation->GetRowsByQyery("SELECT profile_image from subjects  where id=".$this->input->post('serial'));
				if(count($is_user_found))
				{
					$image_file = $is_user_found[0]->profile_image;
				}		
			}
			
			if(isset($_FILES) == 1){
				// Save in database
				foreach ($_FILES as $key => $value) {
					$filename = time().trim(basename($value['name']));
					$base_url_path = IMAGE_LINK_PATH."subject_image/".$filename;
					$path = UPLOAD_PATH."subject_image/";
					$filename = $path.$filename;
					if(is_uploaded_file($value['tmp_name'])){
						if(move_uploaded_file($value['tmp_name'],$filename)){
							$subjectfile = $base_url_path;
						}
					}
				}
			}

			if($this->input->post('serial')){
				$subject =  array(
								'subject_name'=>$this->input->post('subject_name'),
								'subject_code'=>$this->input->post('subject_code'),
								'class_id'=>$this->input->post('class_name'),
								'last_update'=>date("Y-m-d H:i"),
								'semsterid'=>$this->input->post('semsterid'),
								'session_id'=>$active_session[0]->id,
								// 'subj_marks'=>$this->input->post('subj_marks'),
							);

				$this->operation->table_name = 'subjects';

				$id = $this->operation->Create($subject,$this->input->post('serial'));
				if(!is_null($subjectfile)){
					$subject =  array(
									'subject_image'=>(!is_null($subjectfile) ? $subjectfile : ''),
								);

					$this->operation->table_name = 'subjects';
					$id = $this->operation->Create($subject,$this->input->post('serial'));
				}

				$result['message'] = true;
				$result['lastid'] = $this->input->post('serial');
			}
			else{

				$subject =  array(
								'subject_name'=>$this->input->post('subject_name'),
								'subject_code'=>$this->input->post('subject_code'),
								'class_id'=>$this->input->post('class_name'),
								'last_update'=>date("Y-m-d H:i"),
								'semsterid'=>$this->input->post('semsterid'),
								// 'subj_marks'=>$this->input->post('subj_marks'),
								'subject_image'=>(!is_null($subjectfile) ? $subjectfile : ''),
								'session_id'=>$active_session[0]->id,
							);

				$this->operation->table_name = 'subjects';
				$id = $this->operation->Create($subject);

				if(count($id)){
					$result['message'] = true;
					//$result['lastid'] = $id;
				}
			}
		}
		echo json_encode($result);
	}



	function SaveSubjectImage()

	{

		if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}
		$result['message'] = false;

		if(isset($_FILES) == 1){

			// Save in database

			foreach ($_FILES as $key => $value) {

				$filename = time().trim(basename($value['name']));

				$base_url_path = base_url()."upload/subject_image/".$filename;

				$path = UPLOAD_PATH."subject_image/";



		 		$filename = $path.$filename;



		 		if(is_uploaded_file($value['tmp_name'])){

					if(move_uploaded_file($value['tmp_name'],$filename)){

				 		$result['message'] = true;

				 		$subject_image =  array(

									'subject_image'=>$base_url_path,

									);

						$this->operation->table_name = 'subjects';

						$id = $this->operation->Create($subject_image,$_POST['subjectid']);



				 	}

				}

			}

		}

		echo json_encode($result);

	}



	function NewLogin()

	{
		$this->user->logout();
		if($this->session->userdata('id')){
			$userrole = $this->session->userdata('roles');
			if($userrole[0]['role_id'] == 3)
			{
				// check user need to update wizard
		
		 			parent::redirectUrl('dashboard');	
		 		
				
			}
			else{
				parent::redirectUrl('teacherdashboard');
			}
			
		}
		$this->load->view('principal/signin');

	}



	/**

	 * Authenticate user

	 *

	 * @access private

	 */

	function authenticateteacher()
	{

		$result['message'] = false;

		$this->form_validation->set_rules('email', 'Email Required', 'trim|required');

		$this->form_validation->set_rules('password', 'Password required', 'trim|required');

		if ($this->form_validation->run() == FALSE){

			$result['message'] = false;

		}

		else{

			$val = $this->user->TeacherLogin($this->input->post('email'),$this->input->post('password'));

			if($val == 1){

				$roles = $this->session->userdata('roles');


					if($roles[0]['role_id'] == 4){

						$result['rurl'] = "teacherdashboard";

					}
					else if($roles[0]['role_id'] == 1){
						$result['rurl'] = "admindashboard";
					}
					else{

						$this->userlocationid = parent::GetLogedinUserLocation();
    				$school_id = parent::GetSchoolDetail($this->userlocationid);
    		
		  		 	if(count(parent::CheckSchoolWizard($school_id->id)))
				 		{
				 			$result['rurl'] = "principal_installation_wizard";
				 		}
				 		else{
				 			$result['rurl'] = "dashboard";
				 		}
					}



				$result['message'] = true;



			}

			else if($val  == " "){

				$result['message'] = false;

			}

		}

		echo json_encode($result);

	}

		public function add_exam_timetable_form(){
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

		// foreach ($subjectslist as $key => $value) {
		// 	$subject_code=$this->operation-.GetRowsByQyery("select * from subjects where id= ".$value->id);

		// 	$value->subject_name=$value->subject_name." (".$subject_code[0]->subject_code." )";
		// }

		// print_r($subjectlist);

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



		$this->load->view('principal/exam_timetable',$this->data);

	}

	 public function saveTimtable()
	 {
    date_default_timezone_set("Asia/Karachi");
	 	if(!($this->session->userdata('id'))){
			parent::redirectUrl('signin');

		}

		$result['message'] = false;
		$locations = $this->session->userdata('locations');
         
		$active_session = parent::GetUserActiveSession();
			$this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
            

		$this->form_validation->set_rules('select_subject', 'Subject Required', 'trim|required');
		$this->form_validation->set_rules('select_teacher', 'Teacher Required', 'trim|required');

		if ($this->form_validation->run() == FALSE){
			$result['message'] = false;
		}
		else{
			if($this->input->post('serial')){
				$get_schedule_row = $this->operation->GetRowsByQyery(array('id'=>$this->input->post('serial')));
				$subject_schedual_check = true;
				// check is teacher assign to another class at that time
				// if($this->input->post('select_teacher') != null)
				// {
				// 	$is_teacher_already_alloted = $this->operation->GetRowsByQyery("select teacher_uid  FROM schedule  where teacher_uid=".$this->input->post('select_teacher').' AND start_time ='.strtotime($this->input->post('inputFrom')).' AND end_time ='.strtotime($this->input->post('inputTo')));
				// 	if($get_schedule_row[0]->teacher_uid != $is_teacher_already_alloted[0]->teacher_uid)
				// 	{
				// 		$subject_schedual_check = false;
				// 	}
				// }

			
				// // check class/section has different subject already alloted
				// if($this->input->post('select_class') != null && $this->input->post('inputSection') != null && $this->input->post('select_subject') != null)
				// {
				// 	$is_subject_already_alloted = $this->operation->GetRowsByQyery("select id FROM schedule  where class_id=".$this->input->post('select_class').' AND section_id ='.$this->input->post('inputSection').' AND subject_id ='.$this->input->post('select_subject'));

				// 	if($is_subject_already_alloted[0]->id > 0)
				// 	{
				// 		$subject_schedual_check = false;
				// 	}
				// }
				// // check class/section availability
				// if($this->input->post('select_class') != null && $this->input->post('inputSection') != null)
				// {
				// 	$is_class_available = $this->operation->GetRowsByQyery("select count(id) as rows FROM schedule  where class_id=".$this->input->post('select_class').' AND section_id ='.$this->input->post('inputSection').' AND start_time >= '.strtotime($this->input->post('inputFrom')).' AND  end_time <='.strtotime($this->input->post('inputTo')));
				// 	if($is_class_available[0]->rows > 0)
				// 	{
				// 		$subject_schedual_check = false;
				// 	}
				// }


				$schedule =  array(
									'last_update'=> date('Y-m-d'),
									'subject_id'=>$this->input->post('select_subject'),
								 	'class_id'=>$this->input->post('select_class'),
								 	'section_id'=>$this->input->post('inputSection'),
								 	'teacher_uid'=>$this->input->post('select_teacher'),
								 	'start_time'=>strtotime($this->input->post('inputFrom')),
								 	'end_time'=>strtotime($this->input->post('inputTo')),
							 	 	'semsterid'=>$active_semester[0]->semester_id,
								 	'sessionid'=>$active_session[0]->id,
								);

				$this->operation->table_name = 'schedule';
				if($subject_schedual_check == true)
				{
					$id = $this->operation->Create($schedule,$this->input->post('serial'));
					if(count($id))
					{
						$result['message'] = true;
					}
				}	
				
			}

			else{
				$subject_schedual_check = true;
				// check is teacher assign to another class at that time
				/*if($this->input->post('select_teacher') != null)
				{
					$is_teacher_already_alloted = $this->operation->GetRowsByQyery("select count(id) as rows FROM schedule  where teacher_uid=".$this->input->post('select_teacher').' AND start_time ='.strtotime($this->input->post('inputFrom')).' AND end_time ='.strtotime($this->input->post('inputTo')));
				
					if($is_teacher_already_alloted[0]->teacher_rows > 0)
					{
						$subject_schedual_check = false;
					}
				}
				// check class/section has different subject already alloted
				if($this->input->post('select_class') != null && $this->input->post('inputSection') != null && $this->input->post('select_subject') != null)
				{
					$is_subject_already_alloted = $this->operation->GetRowsByQyery("select count(id) as teacher_rows FROM schedule  where class_id=".$this->input->post('select_class').' AND section_id ='.$this->input->post('inputSection').' AND subject_id ='.$this->input->post('select_subject'));

					if($is_subject_already_alloted[0]->teacher_rows > 0)
					{
						$subject_schedual_check = false;
					}
				}
				// check class/section availability
				/*if($this->input->post('select_class') != null && $this->input->post('inputSection') != null)
				{
					$is_class_available = $this->operation->GetRowsByQyery("select count(id) as teacher_rows FROM schedule  where class_id=".$this->input->post('select_class').' AND section_id ='.$this->input->post('inputSection').' AND start_time >= '.strtotime($this->input->post('inputFrom')).' AND  end_time <='.strtotime($this->input->post('inputTo')));
					if($is_class_available[0]->rows > 0)
					{
						$subject_schedual_check = false;
					}
				}

    */
				$schedule =  array(
									'last_update'=> date('Y-m-d'),
									'subject_id'=>$this->input->post('select_subject'),
								 	'class_id'=>$this->input->post('select_class'),
								 	'section_id'=>$this->input->post('inputSection'),
								 	'teacher_uid'=>$this->input->post('select_teacher'),
								 	'start_time'=>strtotime($this->input->post('inputFrom')),
								 	'end_time'=>strtotime($this->input->post('inputTo')),
							'semsterid'=>$active_semester[0]->semester_id,
								 	'sessionid'=>$active_session[0]->id,
								);
               
				$this->operation->table_name = 'schedule';
				//if($subject_schedual_check == true)
				//{
					$id = $this->operation->Create($schedule);
				//}
				
				if(count($id))
				{
					

					$result['message'] = true;
				}
			}
		}



		echo json_encode($result);

	}



	 public function show_exam_timetable() {
    date_default_timezone_set("Asia/Karachi");
	 	if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

			$locations = $this->session->userdata('locations');

			$roles = $this->session->userdata('roles');
		$active_session = parent::GetUserActiveSession();
			$active_semester = parent::GetCurrentSemesterData($active_session[0]->id);

	 	if( $roles[0]['role_id'] == 3 && count($active_session) && count($active_semester)){



	 	$datameta=$this->data['timetable_list'] = $this->operation->GetRowsByQyery("SELECT sc.id,sub.id as subid,subject_name,grade,section_name,username,start_time,end_time FROM schedule sc INNER JOIN classes cl ON  sc.class_id=cl.id INNER JOIN invantageuser inv ON sc.teacher_uid=inv.id INNER JOIN subjects sub ON sc.subject_id=sub.id INNER JOIN sections  sct ON sc.section_id=sct.id WHERE cl.school_id =".$locations[0]['school_id']." AND sub.session_id = ".$active_session[0]->id." AND sub.semsterid = ".$active_semester[0]->semester_id." ORDER by sc.id desc");

	 	if(count($datameta))
	 	foreach ($datameta as $key => $value) {

	 		$subcod=$this->operation->GetRowsByQyery("select subject_code from subjects where id= ".$value->subid);
	 		$value->subject_name=$value->subject_name."(".$subcod[0]->subject_code.")";

	 	 $value->subject_name;

	 	}



	   }

	   else if( $roles[0]['role_id'] == 4 && count($active_session) && count($active_semester)){





	   $this->data['timetable_list'] = $this->operation->GetRowsByQyery("SELECT sc.id, subject_name,grade,section_name,username,start_time,end_time FROM schedule sc  INNER JOIN classes cl ON  sc.class_id=cl.id INNER JOIN invantageuser inv ON sc.teacher_uid=inv.id INNER JOIN subjects sub ON sc.subject_id=sub.id INNER JOIN sections  sct ON sc.section_id=sct.id where sc.teacher_uid=".$this->session->userdata('id')." AND cl.school_id =".$locations[0]['school_id']." AND sub.session_id = ".$active_session[0]->id." AND sub.semsterid = ".$active_semester[0]->semester_id);



	   }



		$this->load->view('principal/exam_timetble_list',$this->data);



	 }



	 public function take_pic()

	{

		$img_path['laststudentimgid'] = '';

		$this->session->set_userdata($img_path);

		$this->load->view('principal/take_pic');

	}



	public function saveImage()

	{

		$filename =  time() . '.jpg';

		$filepath = UPLOAD_PATH.'profile/';



		//read the raw POST data and save the file with file_put_contents()

		$result = file_put_contents( $filepath.$filename, file_get_contents('php://input') );

		$img_path['laststudentimgid'] = '';

		$img_path['laststudentimgid'] = $filename;

		$this->session->set_userdata($img_path);



	}



	function getImgId()

	{

		$result['lastid'] = false;

		if($this->session->userdata('laststudentimgid')){

			$result['lastid'] = $this->session->userdata('laststudentimgid');

		}

		echo json_encode($result);

	}





	function sessions(){

   $this->session->set_userdata('laststudentimgid');

}



	public function GetClassProgressReport()

	{

if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}

			$progressreport = array();





		if(!empty($this->input->get('inputclass')) && !empty($this->input->get('inputsection')) ){

			$query = $this->operation->GetRowsByQyery('SELECT s.subject_name, (((SELECT count(le.id) FROM lessons le  INNER JOIN lesson_read l_r ON l_r.lesson_id = le.id WHERE l_r.classid = '.$this->input->get("inputclass").' AND l_r.sectionid = '.$this->input->get("inputsection").' AND l_r.subjectid = s.id AND l_r.status = "r") * 100) /(SELECT count(le.id) FROM lessons le  INNER JOIN lesson_read l_r ON l_r.lesson_id = le.id WHERE l_r.classid = '.$this->input->get("inputclass").' AND l_r.sectionid = '.$this->input->get("inputsection").' AND l_r.subjectid = s.id ))  as percentclass from lessons l  INNER JOIN lesson_read lr ON lr.lesson_id = l.id INNER JOIN subjects s ON s.id = lr.subjectid INNER JOIN sections se ON se.id = lr.sectionid WHERE lr.classid = '.$this->input->get("inputclass").' and lr.sectionid = '.$this->input->get("inputsection").' GROUP by lr.classid,lr.sectionid, lr.subjectid');

			if(count($query)){

				foreach ($query as $key => $value) {

					$progressreport[] = array(

						'name'=>$value->subject_name,

						'progress'=>(int) round($value->percentclass,2),

					);

				}

			}

		}

		echo json_encode($progressreport);

	}



	function GetSubcatList()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$subcatlist = array();

		if(!empty($this->input->get('classid')))

		{

			$this->operation->table_name = 'sections';

			$query = $this->operation->GetByWhere(array('class_id'=>trim($_GET['classid'])));

			if(count($query))

			{

				foreach ($query as $key => $value) {

					$subcatlist[] = array(

						'id'=>$value->id,

						'name'=>$value->section_name,

					);

				}

			}

		}

		echo json_encode($subcatlist);

	}





	 // public function fetch_exam_timetable() {

	 // 	$this->data['fetch_timetable_list'] = $this->operation->GetRowsByQyery("SELECT * FROM `schedule`");



		// $this->load->view('principal/exam_timetble_list',$this->data);



	 // }



	function removeSubject(){

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}



		$result['message'] = false;

		$removeSubject = $this->db->query("Delete from subjects where id =".trim($_GET['id']));



		if($removeSubject == TRUE):

			$result['message'] = true;

		endif;

		echo json_encode($result);

	}



	/**

	 * Get students by id

	 *

	 * @access private

	 */

	function GetClassById()

	{

		$result['message'] = false;



		$is_class_found = $this->operation->GetRowsByQyery("Select c.*,s.* from classes c INNER JOIN sections s ON s.class_id = c.id");

		if(count($is_class_found)){

			$result['message'] = true;

			foreach ($is_class_found as $key => $value) {

				$result['cls_id'] = $value->id;

				$result['class_name'] = $value->grade;

				$result['section_name'] = $value->section_name;

			}

		}

		echo json_encode($result);

	}



		function GetSubjectById()

	{

		$result['message'] = false;



		$is_student_found = $this->operation->GetRowsByQyery("Select inuser.* from invantageuser inuser where inuser.type = 's' AND id = ".trim($this->input->get('id')));

		if(count($is_student_found)){

			$result['message'] = true;

			foreach ($is_student_found as $key => $value) {

				$result['student_id'] = $value->id;

				$result['roll_number'] = (parent::getUserMeta($value->id,'roll_number') != false ? parent::getUserMeta($value->id,'roll_number') : '');

				$result['teacher_lastname'] = (parent::getUserMeta($value->id,'teacher_lastname') != false ? parent::getUserMeta($value->id,'teacher_lastname') : '');

				$result['gender'] = (parent::getUserMeta($value->id,'teacher_gender') != false ? parent::getUserMeta($value->id,'teacher_gender') : 'Male');

				$result['nic'] = (parent::getUserMeta($value->id,'teacher_nic') != false ? parent::getUserMeta($value->id,'teacher_nic') : '');

				$result['phone'] = (parent::getUserMeta($value->id,'teacher_phone') != false ? parent::getUserMeta($value->id,'teacher_phone') : '');

				$result['primary_address'] = (parent::getUserMeta($value->id,'teacher_primary_address') != false ? parent::getUserMeta($value->id,'teacher_primary_address') : '');

				$result['secondary_address'] = (parent::getUserMeta($value->id,'teacher_secondry_adress') != false ? parent::getUserMeta($value->id,'teacher_secondry_adress') : '');

				$result['city'] = (parent::getUserMeta($value->id,'teacher_city') != false ? parent::getUserMeta($value->id,'teacher_city') : '');

				$result['province'] = (parent::getUserMeta($value->id,'teacher_province') != false ? parent::getUserMeta($value->id,'teacher_province') : '');

				$result['zipcode'] = (parent::getUserMeta($value->id,'teacher_zipcode') != false ? parent::getUserMeta($value->id,'teacher_zipcode') : '');

			}

		}

		echo json_encode($result);

	}



			function GetScheduleById()

	{

		$result['message'] = false;



		$is_student_found = $this->operation->GetRowsByQyery("Select inuser.* from invantageuser inuser where inuser.type = 's' AND id = ".trim($this->input->get('id')));

		if(count($is_student_found)){

			$result['message'] = true;

			foreach ($is_student_found as $key => $value) {

				$result['student_id'] = $value->id;

				$result['roll_number'] = (parent::getUserMeta($value->id,'roll_number') != false ? parent::getUserMeta($value->id,'roll_number') : '');

				$result['teacher_lastname'] = (parent::getUserMeta($value->id,'teacher_lastname') != false ? parent::getUserMeta($value->id,'teacher_lastname') : '');

				$result['gender'] = (parent::getUserMeta($value->id,'teacher_gender') != false ? parent::getUserMeta($value->id,'teacher_gender') : 'Male');

				$result['nic'] = (parent::getUserMeta($value->id,'teacher_nic') != false ? parent::getUserMeta($value->id,'teacher_nic') : '');

				$result['phone'] = (parent::getUserMeta($value->id,'teacher_phone') != false ? parent::getUserMeta($value->id,'teacher_phone') : '');

				$result['primary_address'] = (parent::getUserMeta($value->id,'teacher_primary_address') != false ? parent::getUserMeta($value->id,'teacher_primary_address') : '');

				$result['secondary_address'] = (parent::getUserMeta($value->id,'teacher_secondry_adress') != false ? parent::getUserMeta($value->id,'teacher_secondry_adress') : '');

				$result['city'] = (parent::getUserMeta($value->id,'teacher_city') != false ? parent::getUserMeta($value->id,'teacher_city') : '');

				$result['province'] = (parent::getUserMeta($value->id,'teacher_province') != false ? parent::getUserMeta($value->id,'teacher_province') : '');

				$result['zipcode'] = (parent::getUserMeta($value->id,'teacher_zipcode') != false ? parent::getUserMeta($value->id,'teacher_zipcode') : '');

			}

		}

		echo json_encode($result);

	}



	 public function show_quizz_list() {

	 	if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

			$locations = $this->session->userdata('locations');

			$roles = $this->session->userdata('roles');

	 	if( $roles[0]['role_id'] == 3){



	 		$this->data['quiz_list'] = $this->operation->GetRowsByQyery("SELECT q.id,grade,section_name,subject_name,qname,isdone,q.quiz_date from quize q INNER JOIN classes c on q.classid=c.id INNER JOIN sections sc on q.sectionid=sc.id INNER JOIN subjects sb on q.subjectid=sb.id INNER JOIN user_locations ul ON ul.user_id = c.school_id Where  ul.school_id =".$locations[0]['school_id']);

		}

		else if( $roles[0]['role_id'] == 4)

		 {

			$this->data['quiz_list'] = $this->operation->GetRowsByQyery("SELECT q.id,grade,section_name,subject_name,qname,isdone,q.quiz_date from quize q INNER JOIN classes c on q.classid=c.id INNER JOIN sections sc on q.sectionid=sc.id INNER JOIN subjects sb on q.subjectid=sb.id  Where    q.tacher_uid=".$this->session->userdata('id')." group by q.id");



		}

		$this->load->view('teacher/show_quizz_list',$this->data);



	 }

	 	function removeQuiz(){



		$result['message'] = false;

		$removeSubject = $this->db->query("Delete from quize where id =".trim($_GET['id']));



		if($removeSubject == TRUE):

			$result['message'] = true;

		endif;

		echo json_encode($result);

	}



	 public function edit_quiz_view_form()

	{

		if(!($this->session->userdata('id')))
		{

				parent::redirectUrl('signin');

			}

		if($this->uri->segment(2) AND $this->uri->segment(2) != "page" )
		{

			$schedule_single = $this->operation->GetRowsByQyery("Select * from quize where id= ".$this->uri->segment(2));

			$this->data['schedule_single'] = $schedule_single;



		}

		$this->operation->table_name = "subjects";

		$subjectslist = $this->operation->GetRows();

		$subjects = array();

		if(count($subjectslist))

		{

			foreach ($subjectslist as $key => $value) {

				$subjects[] = array(

					'subid'=>$value->id,

					'name'=>$value->subject_name,

					'class'=>parent::getClass($value->class_id),

				);

			}

		}


		$roles = $this->session->userdata('roles');
		$locations = $this->session->userdata('locations');

	 	if( $roles[0]['role_id'] == 3)
	 	{



		$classlist = $this->operation->GetRowsByQyery("SELECT  * FROM classes c where school_id =".$locations[0]['school_id']);

	    }
	     else if ($roles[0]['role_id'] == 4 OR $this->session->userdata('is_master_teacher') == '1') {

	    	$classlist = $this->operation->GetRowsByQyery("SELECT c.id as classid,c.grade FROM schedule sch INNER JOIN classes c on c.id = sch.class_id  WHERE sch.teacher_uid = ".$this->session->userdata('id')." GROUP by c.id ORDER by c.id asc");
	    }

	   $this->data['classlist'] = $classlist;

		$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid =".$classlist[0]->classid);
		$this->data['subjects'] = $subjects;
		$this->load->view('teacher/addquizz', $this->data);

	}


public function save_quize_info()

{

	if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}



 	$postdata = file_get_contents("php://input");

	$request = json_decode($postdata);

	$inputquizname =$this->security->xss_clean(html_escape($request->inputquizname));

	$inputclass =$this->security->xss_clean(html_escape($request->inputclass));

	$inputsection =$this->security->xss_clean(html_escape($request->inputsection));

	$inputsubject =$this->security->xss_clean(html_escape($request->inputsubject));

	$serialinput =$this->security->xss_clean(html_escape($request->serial));

	$input_term_type =$this->security->xss_clean(html_escape($request->input_term_type));

	$inputquizdate =$this->security->xss_clean(html_escape($request->inputquizdate));

	$result['message'] = $serialinput;
	$locations = $this->session->userdata('locations');
         
		$active_session = parent::GetUserActiveSession();
			$this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));

	    if(!is_null($serialinput) && !empty($serialinput))

				{

					$quize_array = array(

					'qname'=>$inputquizname,

					'classid'=>$inputclass,

					'sectionid'=>$inputsection,

					'subjectid'=>$inputsubject,

					'quiz_term'=>$input_term_type,

					'quiz_date'=>date('Y-m-d',strtotime($inputquizdate)),

					'isdone'=>0,

					'last_update'=>date("Y-m-d H:i"),

					'datetime'=>date("Y-m-d H:i"),

					'tacher_uid'=>$this->session->userdata('id'),
					'semsterid'=>$active_semester[0]->semester_id,
					'school_id'=>$locations[0]['school_id'],
					'uniquecode'=>''

				);

				$this->operation->table_name = 'quize';

				$id = $this->operation->Create($quize_array,$serialinput);

				if(count($id)){

						$result['lastid'] = $id;

						$result['message'] = true;

					}



				}



		else if((is_null($serialinput) == true ||  empty($serialinput)) &&!empty($inputquizname) && !empty($inputclass) && !empty($inputsection) && !empty($inputsubject) && !empty($input_term_type) && !empty($inputquizdate))

					{





					$quize_array = array(

						'qname'=>$inputquizname,

						'classid'=>$inputclass,

						'sectionid'=>$inputsection,

						'subjectid'=>$inputsubject,

						'quiz_term'=>$input_term_type,

						'quiz_date'=>date('Y-m-d',strtotime($inputquizdate)),

						'isdone'=>0,

						'last_update'=>date("Y-m-d H:i"),

						'datetime'=>date("Y-m-d H:i"),

						'tacher_uid'=>$this->session->userdata('id'),
						'semsterid'=>$active_semester[0]->semester_id,
						'sessionid'=>$active_session[0]->id,
						'school_id'=>$locations[0]['school_id'],
						'uniquecode'=>''

					);



					$this->operation->table_name = 'quize';

					$id = $this->operation->Create($quize_array);

					if(count($id)){

						$result['lastid'] = $id;

						$result['message'] = true;

					}

				}







	echo json_encode($result);

}
		public function add_Principal_form(){

			if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

			if($this->uri->segment(2) AND $this->uri->segment(2) != "page" ){

			$this->data['teacher_single'] = $this->operation->GetRowsByQyery("Select * from invantageuser where id= ".$this->uri->segment(2));

			$result['teacher_firstname'] = (parent::getUserMeta($this->uri->segment(2),'principal_firstname') != false ? parent::getUserMeta($this->uri->segment(2),'principal_firstname') : '');

			$result['teacher_lastname'] = (parent::getUserMeta($this->uri->segment(2),'principal_lastname') != false ? parent::getUserMeta($this->uri->segment(2),'principal_lastname') : '');

			$result['gender'] = (parent::getUserMeta($this->uri->segment(2),'principal_gender') != false ? parent::getUserMeta($this->uri->segment(2),'principal_gender') : 'Male');

			$result['nic'] = (parent::getUserMeta($this->uri->segment(2),'principal_nic') != false ? parent::getUserMeta($this->uri->segment(2),'principal_nic') : '');

			$result['teacher_religion'] = (parent::getUserMeta($this->uri->segment(2),'principal_religion') != false ? parent::getUserMeta($this->uri->segment(2),'principal_religion') : '');

			$result['email'] = (parent::getUserMeta($this->uri->segment(2),'email') != false ? parent::getUserMeta($this->uri->segment(2),'email') : '');

			$result['teacher_phone'] = (parent::getUserMeta($this->uri->segment(2),'principal_phone') != false ? parent::getUserMeta($this->uri->segment(2),'principal_phone') : '');

			$result['teacher_primary_address'] = (parent::getUserMeta($this->uri->segment(2),'principal_primary_address') != false ? parent::getUserMeta($this->uri->segment(2),'principal_primary_address') : '');

      $result['secondary_address'] = (parent::getUserMeta($this->uri->segment(2),'principal_secondry_adress') != false ? parent::getUserMeta($this->uri->segment(2),'principal_secondry_adress') : '');

			$result['province'] = (parent::getUserMeta($this->uri->segment(2),'principal_province') != false ? parent::getUserMeta($this->uri->segment(2),'principal_province') : '');

			$result['teacher_city'] = (parent::getUserMeta($this->uri->segment(2),'principal_city') != false ? parent::getUserMeta($this->uri->segment(2),'principal_city') : '');

			$result['teacher_zipcode'] = (parent::getUserMeta($this->uri->segment(2),'principal_zipcode') != false ? parent::getUserMeta($this->uri->segment(2),'principal_zipcode') : '');

			$result['location'] = (parent::getUserMeta($this->uri->segment(2),'location') != false ? parent::getUserMeta($this->uri->segment(2),'location') : '');



			$this->data['result'] = $result;

		}

				//$this->data['schools'] = $this->operation->GetRowsByQyery("SELECT * FROM `schools`");



		$this->load->view('principal/add_principal',$this->data);

	}



	 /**

	 * Invantage user

	 *

	 * @access private

	 * @return return status

	*/

/* saaaaaaaaaave LMS teacher START */

	function saveInvantagePrincpal()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		$this->form_validation->set_rules('inputFirstName', 'Valid First Name Required', 'trim|min_length[3]');

		$this->form_validation->set_rules('inputLastName', 'Valid Last Name Required', 'trim|min_length[3]');

		if ($this->form_validation->run() == FALSE){

			$result['message'] =  false;

		}

		else{

			$image_file = '';
		
			if($this->input->post('serial') && !isset($_FILES['image'])) {
				$is_user_found = $this->operation->GetRowsByQyery("SELECT profile_image from invantageuser  where id=".$this->input->post('serial'));

				if(count($is_user_found))
				{
					$image_file = $is_user_found[0]->profile_image;
				}		
			}
			 
			if(isset($_FILES['image'])){
				// Save in database
				foreach ($_FILES as $key => $value) {
					$filename = time().trim(basename($value['name']));
					$base_url_path = IMAGE_LINK_PATH."profile/".$filename;
					$path = UPLOAD_PATH."profile/";
					$filename = $path.$filename;
					if(is_uploaded_file($value['tmp_name'])){
						if(move_uploaded_file($value['tmp_name'],$filename)){
							$image_file = $base_url_path;
						}
					}
				}
			}

			if($this->input->post('serial') != null){



				$this->operation->table_name = 'invantageuser';

				$teacherId = $this->user->PricpalInfo($this->input->post('serial'),
					ucwords(htmlentities(stripslashes($this->input->post('inputFirstName')))),

	                htmlentities(stripslashes($this->input->post('inputLastName'))),

					$this->input->post('input_t_gender'),

					trim($this->input->post('inputTeacher_Nic')),

					//trim($this->input->post('inputReligion')),

					trim($this->input->post('input_teacher_email')),

					trim($this->input->post('input_pr_phone')),

					trim($this->input->post('inputNewPassword')),

					htmlentities(stripslashes($this->input->post('pr_home'))),

					htmlentities(stripslashes($this->input->post('sc_home'))),

					trim($this->input->post('inputProvice')),

					trim($this->input->post('input_city')),

					trim($this->input->post('input_zipcode')),

					trim($this->input->post('inputLocation')),
					$image_file

				);



				$result['message'] = true;

			}

			else {

			if(trim($this->input->post('inputNewPassword')) == trim($this->input->post('inputRetypeNewPassword'))){

				// insert

				$teacherId = $this->user->PricpalInfo(null,ucwords($this->input->post('inputFirstName')),

					$this->input->post('inputLastName'),

					$this->input->post('input_t_gender'),

					trim($this->input->post('inputTeacher_Nic')),

					//trim($this->input->post('inputReligion')),

					trim($this->input->post('input_teacher_email')),

					trim($this->input->post('input_pr_phone')),

					trim($this->input->post('inputNewPassword')),

					trim($this->input->post('pr_home')),

					trim($this->input->post('sc_home')),

					trim($this->input->post('inputProvice')),

					trim($this->input->post('input_city')),

					trim($this->input->post('input_zipcode')),

					trim($this->input->post('inputLocation')),
					$image_file

				);

				$result['lastid'] = $teacherId;

				$result['message'] =  true;

			}



			}

		}

		echo json_encode($result);

	}

		function uploadPrincpalimg(){

			$result['message'] = false;

			if(isset($_FILES) == 1){

				// Save in database

				foreach ($_FILES as $key => $value) {

					$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG","PNG","GIF","BMP","doc","DOC","PDF","pdf","DOCX","docx","xls","XLS","XLSX","xlsx");

			        if(strlen($value['name'])){

			            list($txt, $ext) = explode(".", $value['name']);

			            if(in_array(strtolower($ext),$valid_formats)){

			            	if ($value["size"] < 5000000) {

		 						$filename = time().trim(basename($value['name']));

		 						$base_url_path = base_url()."upload/profile/".$filename;

		 						$teacher =  array(

	 											'profile_image'=>$base_url_path,

									);

								$this->operation->table_name = 'invantageuser';



								$id = $this->operation->Create($teacher,$_POST['teacherId']);

					 			if($id){

									if(is_uploaded_file($value['tmp_name'])){



										$path = $_SERVER['DOCUMENT_ROOT']."/profile/";

								 		$filename = $path.$filename;

								 		if(move_uploaded_file($value['tmp_name'],$filename)){

									 		$result['message'] = true;

									 	}

									}

								}

						 	}

			            }

			        }



				}

			}

			echo json_encode($result);

		}



			/**

	 * Load form

	 *

	 * @access private

	 */

	function show_prinicpal_list()

	{   
		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$this->session->unset_userdata('laststudentimgid');

	    $teacherlist = array();

		$teacherlists = $this->operation->GetRowsByQyery("Select inuser.* from invantageuser inuser  INNER JOIN user_roles ur ON ur.user_id =inuser.id where ur.role_id = 3 ");
				if(count($teacherlists)){

			foreach ($teacherlists as $key => $value) {
				$school = parent::GetUserSchool($value->id);

				$teacherlist[] = array(

				'principal_id'=> $value->id,

				'principal_firstname'=> (parent::getUserMeta($value->id,'principal_firstname') != false ? parent::getUserMeta($value->id,'principal_firstname') : ''),

				'principal_lastname'=> (parent::getUserMeta($value->id,'principal_lastname') != false ? parent::getUserMeta($value->id,'principal_lastname') : ''),

				'email'=>$value->email,
				'school'=>$school[0]->name." - ".$school[0]->location

				);

			}

		}



		$this->data['teacherlist'] = (object) $teacherlist;

		$this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		$this->load->view('principal/show_prinicpal_list',$this->data);

	}



  	function Repeat()

	{

		$result['message']=false;



		if(!empty(trim($this->input->get('id'))) && !is_null($this->input->get('id'))):

		$lesson= $this->operation->GetRowsByQyery("SELECT * from lessons  where id=".$this->input->get('id'));



		if(count($lesson)){

			foreach ($lesson as $key => $value)

			{

				$Repeatlesson = array(

							'teacher_id'=>$value->teacher_id,

							'title'=>$value->title,

							'description'=>$value->description,

							'upload_url'=>$value->upload_url,

							'created'=>date("Y-m-d H:i"),

							'uploadname'=>$value->uploadname,

							'lesson_type'=>$value->lesson_type,

							'last_update'=>date("Y-m-d H:i"),

							'appvideo_url'=>$value->appvideo_url

						);

				$this->operation->table_name = 'lessons';

				$lid = $this->operation->Create($Repeatlesson);

				$result = array('id'=>$lid,'title'=>$value->title,'date'=>date("Y-m-d H:i"));



				$lessonRead= $this->operation->GetRowsByQyery("SELECT * from lesson_read  where lesson_id=".$this->input->get('id'));

				if(count($lessonRead))

				{

					foreach ($lessonRead as $key => $value) {

						$lessonRead_data = array(

								'lesson_id'=>$lid,

								'sectionid'=>$value->sectionid,

								'status'=>$value->status,

								'created'=>date("Y-m-d H:i"),

								'subjectid'=>$value->subjectid,

								'classid'=>$value->classid,

								'date'=>date("Y-m-d H:i")

							);



						$this->operation->table_name = 'lesson_read';

						$this->operation->Create($lessonRead_data);

					}

				}

			}



		}

		endif;

		echo json_encode($result);

	}





/* Parrrrrrrrrrrreeeeeeeeeentttttttttts Recordssssssssssss start */



		public function add_Parent_form(){

			if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

			if($this->uri->segment(2) AND $this->uri->segment(2) != "page" ){

			$this->data['teacher_single'] = $this->operation->GetRowsByQyery("Select * from invantageuser where id= ".$this->uri->segment(2));

			$result['teacher_firstname'] = (parent::getUserMeta($this->uri->segment(2),'teacher_firstname') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_firstname') : '');

			$result['teacher_lastname'] = (parent::getUserMeta($this->uri->segment(2),'teacher_lastname') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_lastname') : '');

			$result['gender'] = (parent::getUserMeta($this->uri->segment(2),'teacher_gender') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_gender') : 'Male');

			$result['nic'] = (parent::getUserMeta($this->uri->segment(2),'teacher_nic') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_nic') : '');

			$result['teacher_religion'] = (parent::getUserMeta($this->uri->segment(2),'teacher_religion') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_religion') : '');

			$result['email'] = (parent::getUserMeta($this->uri->segment(2),'email') != false ? parent::getUserMeta($this->uri->segment(2),'email') : '');

			$result['teacher_phone'] = (parent::getUserMeta($this->uri->segment(2),'teacher_phone') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_phone') : '');

			$result['teacher_primary_address'] = (parent::getUserMeta($this->uri->segment(2),'teacher_primary_address') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_primary_address') : '');

            $result['secondary_address'] = (parent::getUserMeta($this->uri->segment(2),'teacher_secondry_adress') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_secondry_adress') : '');

			$result['province'] = (parent::getUserMeta($this->uri->segment(2),'teacher_province') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_province') : '');

			$result['teacher_city'] = (parent::getUserMeta($this->uri->segment(2),'teacher_city') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_city') : '');

			$result['teacher_zipcode'] = (parent::getUserMeta($this->uri->segment(2),'teacher_zipcode') != false ? parent::getUserMeta($this->uri->segment(2),'teacher_zipcode') : '');

			$result['location'] = (parent::getUserMeta($this->uri->segment(2),'location') != false ? parent::getUserMeta($this->uri->segment(2),'location') : '');



			$this->data['result'] = $result;

		}

				//$this->data['schools'] = $this->operation->GetRowsByQyery("SELECT * FROM `schools`");



		$this->load->view('principal/add_parent',$this->data);

	}



	 /**

	 * Invantage user

	 *

	 * @access private

	 * @return return status

	*/

/* saaaaaaaaaave LMS teacher START */

	function saveInvantageParents()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$result['message'] = false;

		$this->form_validation->set_rules('inputFirstName', 'Valid First Name Required', 'trim|required|min_length[3]');

		$this->form_validation->set_rules('inputLastName', 'Valid Last Name Required', 'trim|required|min_length[3]');

		if ($this->form_validation->run() == FALSE){

			$result['message'] =  false;

		}

		else{

			if($this->input->post('serial')){



				$this->operation->table_name = 'invantageuser';

				$teacherId = $this->user->ParentsInfo($this->input->post('serial'),ucwords($this->input->post('inputFirstName')),

	                $this->input->post('inputLastName'),

					$this->input->post('input_t_gender'),

					trim($this->input->post('inputTeacher_Nic')),

					trim($this->input->post('inputReligion')),

					trim($this->input->post('input_teacher_email')),

					trim($this->input->post('input_pr_phone')),

					trim($this->input->post('inputNewPassword')),

					trim($this->input->post('pr_home')),

					trim($this->input->post('sc_home')),

					trim($this->input->post('inputProvice')),

					trim($this->input->post('input_city')),

					trim($this->input->post('input_zipcode')),

					trim($this->input->post('inputLocation'))

				);



				$result['message'] = true;

			}

			else {

			if(trim($this->input->post('inputNewPassword')) == trim($this->input->post('inputRetypeNewPassword'))){

				// insert

				$teacherId = $this->user->ParentsInfo(null,ucwords($this->input->post('inputFirstName')),

					$this->input->post('inputLastName'),

					$this->input->post('input_t_gender'),

					trim($this->input->post('inputTeacher_Nic')),

					trim($this->input->post('inputReligion')),

					trim($this->input->post('input_teacher_email')),

					trim($this->input->post('input_pr_phone')),

					trim($this->input->post('inputNewPassword')),

					trim($this->input->post('pr_home')),

					trim($this->input->post('sc_home')),

					trim($this->input->post('inputProvice')),

					trim($this->input->post('input_city')),

					trim($this->input->post('input_zipcode')),

					trim($this->input->post('inputLocation'))

				);

				$result['lastid'] = $teacherId;

				$result['message'] =  true;

			}



			}

		}

		echo json_encode($result);

	}

		function uploadParentimg(){

			$result['message'] = false;

			if(isset($_FILES) == 1){

				// Save in database

				foreach ($_FILES as $key => $value) {

					$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG","PNG","GIF","BMP","doc","DOC","PDF","pdf","DOCX","docx","xls","XLS","XLSX","xlsx");

			        if(strlen($value['name'])){

			            list($txt, $ext) = explode(".", $value['name']);

			            if(in_array(strtolower($ext),$valid_formats)){

			            	if ($value["size"] < 5000000) {

		 						$filename = time().trim(basename($value['name']));

		 						$teacher =  array(

	 											'profile_image'=>$filename,

									);

								$this->operation->table_name = 'invantageuser';



								$id = $this->operation->Create($teacher,$_POST['teacherId']);

					 			if($id){

									if(is_uploaded_file($value['tmp_name'])){

										$path = $_SERVER['DOCUMENT_ROOT']."/lmsdev/v1/upload/profile/";

								 		$filename = $path.$filename;







								 		if(move_uploaded_file($value['tmp_name'],$filename)){

									 		$result['message'] = true;





									 	}

									}

								}

						 	}

			            }

			        }



				}

			}

			echo json_encode($result);

		}



			/**

	 * Load form

	 *

	 * @access private

	 */

	function show_parents_list()

	{   if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$this->session->unset_userdata('laststudentimgid');

	    $teacherlist = array();

		$teacherlists = $this->operation->GetRowsByQyery("Select inuser.* from invantageuser inuser  where inuser.type = 'pr'");

		if(count($teacherlists)){

			foreach ($teacherlists as $key => $value) {

				$teacherlist[] = array(

				'teacher_id'=> $value->id,

				'teacher_firstname'=> (parent::getUserMeta($value->id,'teacher_firstname') != false ? parent::getUserMeta($value->id,'teacher_firstname') : ''),

				'teacher_lastname'=> (parent::getUserMeta($value->id,'teacher_lastname') != false ? parent::getUserMeta($value->id,'teacher_lastname') : ''),
				'teacher_phone'=> (parent::getUserMeta($value->id,'teacher_phone') != false ? parent::getUserMeta($value->id,'teacher_phone') : ''),

				'email'=>$value->email,

				);

			}

		}



		$this->data['teacherlist'] = (object) $teacherlist;

		//$this->data['roles_right'] = $this->operation->GetRowsByQyery("SELECT user_roles.user_id, user_roles.role_id, user_roles.id, role_rights. * FROM (`user_roles`) INNER JOIN  `role_rights` ON  `role_rights`.`role_id` =  `user_roles`.`role_id` WHERE role_rights.description LIKE  '%_Form' AND  `user_roles`.user_id =". $this->session->userdata('id'));

		$this->load->view('principal/show_parent_list',$this->data);

	}



				/**

	 * Remove Teachers

	 *

	 * @access private

	 * @return array return json array message if user deleted

	 */

	function removeParent(){

	$result['message'] = false;

		$removeParent = $this->db->query("Delete from invantageuser where id = ".$this->input->get('id'));



		if($removeParent == TRUE):

			$result['message'] = true;

		endif;

		echo json_encode($result);

	}



/* Parrrrrrrrrrrreeeeeeeeeentttttttttts Recordssssssssssss end */



			/**

	 * Load form

	 *

	 * @access private

	 */
	function lesson_plan_form()

	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$locations = $this->session->userdata('locations');

			$roles = $this->session->userdata('roles');

		$this->data['teacherlist'] = $this->operation->GetRowsByQyery("SELECT i.id, i.username, i.nic FROM invantageuser i INNER JOIN user_roles ur ON ur.user_id = i.id WHERE ur.role_id = 4 ");



		$this->operation->table_name = "subjects";

		$subjectslist = $this->operation->GetRows();

		$subjects = array();

		if(count($subjectslist))

		{

			foreach ($subjectslist as $key => $value) {

				$subjects[] = array(

					'subid'=>$value->id,

					'name'=>$value->subject_name,

					'class'=>parent::getClass($value->class_id),

				);

			}

		}



		if( $roles[0]['role_id'] == 3 ) {

			$classlist = $this->operation->GetRowsByQyery("SELECT c.id as classid,c.grade  FROM classes c  group by c.id ");
			if(count($classlist))
			{
				$section=$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid =".$classlist[0]->classid);	
			}
			

	    }

	    else if ($roles[0]['role_id'] == 4 AND $this->session->userdata('is_master_teacher') == '1')

	     {

	    	$classlist = $this->operation->GetRowsByQyery("SELECT c.id as classid,c.grade  FROM classes c  group by c.id ");
	    	if(count($classlist))
	    	{
	    		// $classlist = $this->operation->GetRowsByQyery("SELECT c.id as classid,c.grade,  FROM `classes` c INNER JOIN sections s on s.class_id = c.id ");
			$section=$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id   where ass.classid =".$classlist[0]->classid);	
	    	}
	   		



	    }
	    
		$this->data['classlist'] = $classlist;


		$this->data['subjects'] = $subjects;



		$this->load->view('teacher/lesson_plan_form',$this->data);

	}



	public  function ImportDefaultPlan()

	{
	

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$data = array();

		$classid=$_POST['classid'];



		$semesterid=$_POST['semesterid'];

		$subjectid=$_POST['subjectid'];



		if(isset($_FILES) == 1){

				$active_session = parent::GetUserActiveSession();
			$active_semester = parent::GetCurrentSemesterData($active_session[0]->id);
			// Save in database

			foreach ($_FILES as $key => $value) {

				$valid_formats = array("csv", "xls","xlsx");

		        if(strlen($value['name']))
		        {

		            list($txt, $ext) = explode(".", $value['name']);

		            if(in_array(strtolower($ext),$valid_formats)){

						if(is_uploaded_file($value['tmp_name']))

						{

							$path = UPLOAD_PATH;
							
							$file = time().trim(basename($value['name']));

							$filename = $path.$file;
							if(move_uploaded_file($value['tmp_name'],$filename)){
								if($ext == 'xls' || $ext == 'xlsx' )
								{

									$objPHPExcel = $this->OpenExcelData($filename,$classid,$subjectid,$semesterid);

									return false;
								}
								else{

				 					$file = fopen($filename, "r");

				 					$i =  0;

					 				while (($emapData = fgetcsv($file,10000, ",")) !== FALSE)

						         	{

						             	if($i>1)

						             	{

						                    $data = array(

						                        'day' => trim($emapData[0]),

						                        'concept' => trim($emapData[1]),

						                        'topic' => trim($emapData[2]),

						                        'lesson' => trim($emapData[3]),
						                        'type'=>trim($emapData[4]),
						                        'content'=>trim($emapData[5]),

						                        'classid'=>$classid,

						                        'sectionid'=>6,

						                        'subjectid'=>$subjectid,

						                        'date'=>date("Y-m-d H:i"),

						                        'last_update'=>date("Y-m-d H:i:s"),
						                        'uniquecode'=>uniqid(),
						                         'semsterid'=>$active_semester[0]->semester_id,
						                         'sessionid'=>$active_session[0]->id

					                        );

						                    
						                    $this->operation->table_name = 'defaultlessonplan';
						                    $id = $this->operation->Create($data);
						                }

					                $i++;

				 					}

				 					fclose($file);
				 				}

							}

							$lesson=$this->operation->GetRowsByQyery("select * from defaultlessonplan where classid=" .$classid." and subjectid=" .$subjectid." and semsterid=" .$active_semester[0]->semester_id." AND sessionid =".$active_session[0]->id);

						}

			 		}

	        	}

			}

		}





        echo json_encode($lesson);

	}




public function ResetLessonPlan()
	{

if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}
		$classid=$_POST['classid'];

        $subjectid=$_POST['subjectid'];

       	 $semesterid=$this->input->post('semesterid');

			$check=$this->db->query("delete from defaultlessonplan where classid=".$classid." and subjectid=".$subjectid." and semsterid =".$semesterid);
			

			$check=$this->db->query("delete from semester_lesson_plan where classid=".$classid." and subjectid=".$subjectid." and semsterid =".$semesterid);
			
		echo json_encode(true);
	}

	function OpenExcelData($file_name,$classid,$subjectid,$semesterid)
	{
		try{
			require (APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

			//return PHPExcel_IOFactory::load($file_name);
			}
				catch(Exception $ex){}
									try
										{
											
											$active_session = parent::GetUserActiveSession();
										$this->operation->table_name = 'semester_dates';
            $active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
										    $inputfiletype = PHPExcel_IOFactory::identify($file_name);
										    $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
										    $objPHPExcel = $objReader->load($file_name);
										}
										catch(Exception $e)
										{
										    die('Error loading file "'.pathinfo($file_name,PATHINFO_BASENAME).'": '.$e->getMessage());
										}

											$sheet = $objPHPExcel->getSheet(0);
											$highestRow = $sheet->getHighestRow();
											$highestColumn = $sheet->getHighestColumn();
											for ($row = 1; $row <= $highestRow; $row++)
											{
											if($row>2)
											{
											  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);


											$data = array(

						                        'day' => trim($rowData[0][0]),

						                        'concept' => trim($rowData[0][1]),

						                        'topic' => trim($rowData[0][2]),

						                        'lesson' => trim($rowData[0][3]),
						                        'type'=>trim($rowData[0][4]),
						                        'content'=>trim($rowData[0][5]),

						                        'classid'=>$classid,

						                        'sectionid'=>6,

						                        'subjectid'=>$subjectid,

						                        'date'=>date("Y-m-d H:i"),

						                        'last_update'=>date("Y-m-d H:i"),

						                        

						                        'uniquecode'=>uniqid(),

						                          'semsterid'=>$active_semester[0]->semester_id,
						                         'sessionid'=>$active_session[0]->id

					                        );



						                    $insertId = $this->user->insertCSV($data);

}
}
								$lesson=$this->operation->GetRowsByQyery("select * from defaultlessonplan where classid=" .$classid." and subjectid=" .$subjectid." and semsterid=" .$active_semester[0]->semester_id." AND sessionid =".$active_session[0]->id);
								echo json_encode($lesson);
	}

	function SaveExcelData($objPHPExcel)
	{
		$sheetrows = $objPHPExcel->getSheet($current_sheet)->getHighestRow();

  //     	$totalsheets = $objPHPExcel->getSheetCount();

		// for ($i=0; $i < ; $i++) {

		// }
	}


public function removePlan()

{
if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}
    $id=$_POST['data'];
         //$id=input->post('data');


     foreach ($id as $key => $value)

      {

        $iid=$value[7];


       
        if($iid!="")
        {
        	$this->operation->table_name = 'defaultlessonplan';

            $data = $this->operation->GetByWhere(array(
                'id'=>$iid,
               
            ));


        	$this->db->query("delete from defaultlessonplan where id=".$iid);
        	$this->db->query("delete from semester_lesson_plan where uniquecode='".$data[0]->uniquecode."'");
        	
        }
        $result=true;
    }



    echo json_encode($result);





}



			public function Savedata()

			{
				if(!$this->session->userdata('id'))
				{
					parent::redirectUrl('signin');
					return 0;
				}

				$data = json_decode(($_POST['data']));


				
				$newrec=array();

				$classid=$_POST['classid'];

				$subjectid=$_POST['subjectid'];

				$semesterid=$_POST['semesterid'];

				$active_session = parent::GetUserActiveSession();
				$this->operation->table_name = 'semester_dates';
				$active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'status'=>'a'));
				
				

				foreach ($data as $key => $value)

				{
					
					try{



						$day=trim(strtolower($value[0]), 'day ');

						$concept=$value[1];

						$topic=$value[2];

						$lesson=$value[3];

						$type=$value[4];
						$content=$value[5];

						$thumb=$value[7];


						$result['message'] = true;

						if($value[9]==null)

						{

							

							$newrec=array(



								'day' => $day,

								'concept' =>$concept,

								'topic' =>$topic,

								'lesson' => $lesson,

								'type'=>$type,

								'content'=>$content,

								'thumb'=>$thumb,

								'classid'=>$_POST['classid'],

								'sectionid'=>6,

								'subjectid'=>$_POST['subjectid'],

								'uniquecode'=>uniqid(),

								'semsterid'=>$semesterid,

								'last_update'=>date("Y-m-d H:i:s"),

							);

							$result=$newrec;

							$this->operation->table_name = 'defaultlessonplan';

							$id = $this->operation->Create($newrec);





						}

						else

						{

							$newrec=array(



								'day' => $day,

								'concept' =>$concept,

								'topic' =>$topic,

								'lesson' => $lesson,

								'type'=>$type,

								'content'=>$content,

								'thumb'=>$thumb,

								'classid'=>$_POST['classid'],

								'sectionid'=>6,

								'subjectid'=>$_POST['subjectid'],

								'semsterid'=>$semesterid,

								'last_update'=>date("Y-m-d H:i:s"),

							);

							$result=$newrec;

							$this->operation->table_name = 'defaultlessonplan';

							$id = $this->operation->Create($newrec,$did=$value[9]);

						}


					}
					catch(Exception $ex)
					{
						echo $ex;
					}
				}

				echo json_encode($result);
			}



	/**
	 * Get default lesson plan
	 *
	 * @classid int
	 * @subjectid int
	 * @semesterid int
	 *
	 * return json array
	 */
	public function loaddatafromdab()
	{

		if(!($this->session->userdata('id')))
		{
			parent::redirectUrl('signin');
		}

		$classid= $this->input->post('classid');
		$subjectid= $this->input->post('subjectid');
		$recordstatus = $this->input->post('recordstatus');
		$semesterid = $this->input->post('semesterid');
		$active_session = parent::GetUserActiveSession();
		$this->operation->table_name = 'semester_dates';
		$active_semester = $this->operation->GetByWhere(array('session_id'=>$active_session[0]->id,'semester_id'=>$semesterid));

		$lesson=$this->operation->GetRowsByQyery("select d.* from defaultlessonplan d

			where d.classid=".$classid." and d.subjectid=".$subjectid." AND d.semsterid = ".$active_semester[0]->semester_id. " and sessionid = ".$active_session[0]->id." ORDER BY day ASC");
		
		$data = array();
		if(count($lesson))
		{

			foreach ($lesson as $key => $value)
			{
				if( !is_null($value->topic) && !is_null($value->day) &&  !is_null($value->concept))
				{

					$data[] = array
					(
						'day' => $value->day,
						
						'concept' => ucfirst($value->concept),
						
						'topic' => ucfirst($value->topic),
						
						'lesson'=>$value->lesson,
						'content' =>$value->content,
						'thumb' =>$value->thumb,
						'type' => $value->type,
						'id'=>$value->id,
					);

				}
			}
			
            usort($data, function ($a, $b) {
                $day1 = $a['day'];
                $day2 = $b['day'];

                // Handle Day like 'Day 1'
                if (strstr($day1, ' ')) {
                    $day1 = explode(" ", $day1)[1];
                }

                if (strstr($day2, ' ')) {
                    $day2 = explode(" ", $day2)[1];
                }

                return $day1 > $day2;
            });
		}

		echo json_encode($data);
	}

	public function exportdata()

	{

		if(!($this->session->userdata('id')))
		{

			parent::redirectUrl('signin');

		}

		ob_end_clean();


		ob_start();
		$classid=$_POST['classid'];

		$subjectid=$_POST['subjectid'];

		$semesterid=$_POST['semesterid'];

		try
		{
			if($classid != '' && $subjectid != '' && $semesterid != '')
			{
				$single=$this->operation->GetRowsByQyery("select * from defaultlessonplan where classid=".$classid." and subjectid=".$subjectid." and semsterid=".$semesterid);
				$classname=$this->operation->GetRowsByQyery("select grade from classes Where id=".$_POST['classid']);

				$subjectname=$this->operation->GetRowsByQyery("select subject_name from subjects Where id=".$_POST['subjectid']);
			}
		}
		catch(Exception $e)
		{

		}

		require (APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');

		require (APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$objectPHPExcel=new PHPExcel();



		$objectPHPExcel->getProperties()->setCreator("");

		$objectPHPExcel->getProperties()->setLastModifiedBy("");

		$objectPHPExcel->getProperties()->setTitle("");

		$objectPHPExcel->getProperties()->setSubject("");

		$objectPHPExcel->getProperties()->setDescription("");

		$objectPHPExcel->setActiveSheetIndex(0);
		if(count($classname))
		{
			$objectPHPExcel->getActiveSheet()->SetCellValue('A1',$classname[0]->grade);
		}
		if(count($classname))
		{
			$objectPHPExcel->getActiveSheet()->SetCellValue('B1',$subjectname[0]->subject_name);
		}




		$objectPHPExcel->getActiveSheet()->SetCellValue('A2','Day');

		$objectPHPExcel->getActiveSheet()->SetCellValue('B2','Concept');

		$objectPHPExcel->getActiveSheet()->SetCellValue('C2','Topic');

		$objectPHPExcel->getActiveSheet()->SetCellValue('D2','lesson');

		$objectPHPExcel->getActiveSheet()->SetCellValue('E2','Type');
		$objectPHPExcel->getActiveSheet()->SetCellValue('F2','Content');
		$objectPHPExcel->getActiveSheet()->SetCellValue('G2','Thumbnail');
		$rows=3;


		if(count($single))
		{
			foreach ($single as $key => $value)

			{

				$objectPHPExcel->getActiveSheet()->SetCellValue('A'.$rows,$value->day);

				$objectPHPExcel->getActiveSheet()->SetCellValue('B'.$rows,$value->concept);

				$objectPHPExcel->getActiveSheet()->SetCellValue('C'.$rows,$value->topic);

				$objectPHPExcel->getActiveSheet()->SetCellValue('D'.$rows,$value->lesson);

				$objectPHPExcel->getActiveSheet()->SetCellValue('E'.$rows,$value->type);
				$objectPHPExcel->getActiveSheet()->SetCellValue('F'.$rows,$value->content);
				$objectPHPExcel->getActiveSheet()->SetCellValue('G'.$rows,$value->thumb);

				$rows++;

			}
		}

		$filename='defaultlessonplan';

		$objectPHPExcel->getActiveSheet()->setTitle("Project Overview");

		header('Content-Type: application/vnd.ms-excel');

		header('Content-Disposition: attachment;filename=defaultlessonplan_'.date('m-d-Y').".csv");
		header('Cache-Control: max-age=0');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1

        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');

        $objWriter->save('php://output');

        $xlsData = ob_get_contents();

        ob_end_clean();

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;

        header("Content-Transfer-Encoding: binary ");

        $response =  array(

        	'op' => 'ok',
        	'class'=>$classname,
        	'date'=>date('m-d-Y'),

        	'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)

        );



        die(json_encode($response));



        exit;

    }



	function PromoteStudents()

	{

		if(!($this->session->userdata('id')))
		{

				parent::redirectUrl('signin');

			}

		$this->load->view('principal/promotestudent',$this->data);

	}

	function GetQuestionById()
	{

		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$response = array();

		if(!is_null($this->input->get('qid')) && is_numeric($this->input->get('qid')))
		{

			$is_question_found = $this->operation->GetRowsByQyery("SELECT * FROM quizequestions where id =".$this->input->get('qid'));



			if(count($is_question_found))

			{

				$is_question_option_found = $this->operation->GetRowsByQyery("SELECT o.* FROM qoptions o INNER JOIN quizeoptions qo ON o.id = qo.qoption_id where qo.questionid = ".$this->input->get('qid'));

				if(count($is_question_option_found))

				{

					$options = array();
					$this->operation->table_name = "correct_option";
					$correct_index = 1;
					$correct_option = $this->operation->GetByWhere(array('question_id'=>$this->input->get('qid')));
					$i = 1 ;
					foreach ($is_question_option_found as $key => $value) {

						$option = '';
						if($is_question_found[0]->type == 't')
						{

							$option = $value->option_value;
						}
						else{
							$thumbname = explode('.', $value->option_value);
							$option = base_url().'upload/option_images/'.$thumbname[0].'_thumb.'.$thumbname[1];
						}


						$options[] = array(

							'optionid'=>$value->id,

							'option'=>$option,



						);

						if($correct_option[0]->correct_id == $value->id)
						{
							$correct_index = $i;
						}
						else{
							$i++;
						}

					}

					$thumbname = '';
					if(!is_null($is_question_found[0]->img_src)){
						$thumbname = explode('.', $is_question_found[0]->img_src);
					}


					$response[] = array(

						'question'=>$is_question_found[0]->question,
						'thumbnail_src'=>(count($thumbname) == 2 ? base_url().'upload/quiz_images/'.$thumbname[0].'_thumb.'.$thumbname[1] : ''),
						'questionid'=>$is_question_found[0]->id,
						'options'=>$options,
						'correct'=>$correct_index,
						'type'=>($is_question_found[0]->type == 't' ? 1 : 2),

					);

				}

			}

		}

		echo json_encode($response);

	}



	function GetSelectedSubject()

	{

		$selected_subject = array();

		if($this->input->get('inputrowid') != null && is_numeric($this->input->get('inputrowid')))

		{

			$is_selected_subject = $this->operation->GetRowsByQyery('SELECT s.* FROM subjects s INNER join quize q on q.subjectid = s.id  where q.id ='.$this->input->get('inputrowid'));

			if(count($is_selected_subject))

			{

				$selected_subject[] = array(

					'id'=>$is_selected_subject[0]->id,

					'name'=>$is_selected_subject[0]->subject_name,
					'name'=>$is_selected_subject[0]->subject_name,
					'class'=>$is_selected_subject[0]->class_id,
					'semester'=>$is_selected_subject[0]->semsterid,
					'iamge'=>$is_selected_subject[0]->subject_image,

				);

			}

		}

		echo json_encode($selected_subject);

	}

	function GetQuestionList()
	{
		if(!$this->session->userdata('id'))
		{
			parent::redirectUrl('signin');
		}

		
		if(!is_null($this->input->get('id')) && is_numeric($this->input->get('id')))
		{
			$questionlist = $this->operation->GetRowsByQyery("SELECT * FROM quizequestions where quizeid = ".$this->input->get('id')."  order by id desc");
			
		}
		else
		{
			exit();
			// $questionlist = $this->operation->GetRowsByQyery("SELECT * FROM quizequestions  order by id desc");
		}

		$qlist = array();
		if(count($questionlist)){
			foreach ($questionlist as $key => $value) {
				$optionlist = $this->operation->GetRowsByQyery("SELECT o.* FROM qoptions o INNER JOIN quizeoptions qo ON o.id = qo.qoption_id where qo.questionid =".$value->id);
				$temp = array();
				$this->operation->table_name = "correct_option";
				$correct_index = 1;
				$correct_option = $this->operation->GetByWhere(array('question_id'=>$value->id));
				if(count($optionlist)){
					$i = 1 ;
					foreach ($optionlist as $key => $ovalue) {
						$temp1 = array();
						if($value->type == 't')
						{

							$temp1['option'] = $ovalue->option_value;
							$temp1['image_src'] = '';
						}
						else{
							$thumbname = explode('.', $ovalue->option_value);
							$temp1['option'] = base_url().'upload/option_images/'.$thumbname[0].'_thumb.'.$thumbname[1];
							$temp1['image_src'] = base_url().'upload/option_images/'.$ovalue->option_value;
						}

						if($correct_option[0]->correct_id == $ovalue->id)
						{
							$correct_index = $i;
						}
						else{
							$i++;
						}
						array_push($temp, $temp1);
					}
				}

				$thumbname = '';
				if(!is_null($value->img_src)){
					$thumbname = explode('.', $value->img_src);
				}


				$qlist[]  = array(
					'id'=>$value->id,
					'quizeid'=>$value->quizeid,
					'thumbnail_src'=>(count($thumbname) == 2 ? base_url().'upload/quiz_images/'.$thumbname[0].'_thumb.'.$thumbname[1] : ''),
					'image_src'=>($value->img_src != '' ? base_url().'upload/quiz_images/'.$value->img_src : ''),
					'question'=>$value->question,
					'options'=>$temp,
					'quiz_type'=>$value->type,
					'correct'=>$correct_index,
				);
			}
		}


		echo json_encode($qlist);
	}
	public function ShowPrerequisite()
	{

		$classid=$_POST['classid'];
		$subjectid=	$_POST['subjectid'];
		$semesterid=	$_POST['semesterid'];


		//$data['data']=$this->operation->GetRowsByQyery("Select * from defaultlessonplan where classid= ".$classid." and subjectid= ".$subjectid." and semsterid= ".$semesterid );


		$this->load->view('principal/Prerequisite',$this->data);

	}


	public function LoadShedulleType()
	{
		$data=$this->operation->GetRowsByQyery('Select * from releaseshedulle');
		$ShedulleTypearray=array();
		$result['message']=false;
		$result['data']=null;
		if(count($data))
			{

				foreach ($data as $key => $value)
				{
					$ShedulleTypearray=array(
					't_status'=>$value->t_status,
					's_status'=>$value->s_status,
					);
				}

				$result['message']=true;
				$result['data']=$ShedulleTypearray;
			}
			echo json_encode($ShedulleTypearray);
	}

		public function ShedulleType()
		{
			$request = json_decode( file_get_contents('php://input'));
			$inputTimetable = $this->security->xss_clean(trim($request->inputTimetable));
			$inputschedullar = $this->security->xss_clean(trim($request->inputchedullar));


			$ShedulleTypearray=array();
			$result['message']=true;
			$result['Timetable']=false;

			$result['schedullar']=false;
			$is_data_found= $this->operation->GetRowsByQyery('Select * from releaseshedulle');

			if(!count($is_data_found))
			{
				$ShedulleTypearray=array(
					't_status'=>$inputTimetable,
					's_status'=>$inputschedullar,
					'uniquecode'=>uniqid(),

					);

				$this->operation->table_name = "releaseshedulle";
				$id = $this->operation->Create($ShedulleTypearray);
				$result['message']=true;

			}


		else if(count($is_data_found))
			{
				$ShedulleTypearray=array(
					't_status'=>$inputTimetable,
					's_status'=>$inputschedullar,

					);
				$this->operation->table_name = "releaseshedulle";
				$this->operation->Create($ShedulleTypearray,$is_data_found[0]->id);
				$result['message']=true;
			}

		echo json_encode($ShedulleTypearray);
	}

	function GetPrincipalById()
	{
		if(!is_null($this->input->get('principal')))
		{
			$is_data_found= $this->operation->GetRowsByQyery('Select * from invantageuser where id ='.$this->input->get('principal'));
			 $is_principal = array();
			if(count($is_data_found))
			{
				foreach ($is_data_found as $key => $value) {
					$user_locations = $this->operation->GetRowsByQyery('Select * from user_locations where user_id ='.$this->input->get('principal'));
					$locationarray = array();

					if(count($user_locations))
					{
						foreach ($user_locations as $key => $lvalue) {
							$schoolid = $lvalue->school_id;
							$school =parent::GetSchoolDetail($lvalue->school_id);
							$locationarray[] = array(
								'school'=>$school->name,
								'location'=>$school->location,
							);
						}
					}
			
				  	$is_principal = array(
                		'firstname'=>(parent::getUserMeta($this->input->get('principal'),'principal_firstname') != false ? parent::getUserMeta($this->input->get('principal'),'principal_firstname') : ''),      
                		'lastname'=>(parent::getUserMeta($this->input->get('principal'),'principal_lastname') != false ? parent::getUserMeta($this->input->get('principal'),'principal_lastname') : ''),      
                		'gender'=>(parent::getUserMeta($this->input->get('principal'),'principal_gender') != false ? parent::getUserMeta($this->input->get('principal'),'principal_gender') : ''),      
                		'gendertype'=>(parent::getUserMeta($this->input->get('principal'),'principal_gender') != (int) 1 ? 'Male': 'Female'),      
                		'nic'=>(parent::getUserMeta($this->input->get('principal'),'principal_nic') != false ? parent::getUserMeta($this->input->get('principal'),'principal_nic') : ''),      
                		'religion'=>(parent::getUserMeta($this->input->get('principal'),'principal_religion') != false ? parent::getUserMeta($this->input->get('principal'),'principal_religion') : ''),      
                		'email'=>$value->email,      
                		'phone'=>(parent::getUserMeta($this->input->get('principal'),'principal_phone') != false ? parent::getUserMeta($this->input->get('principal'),'principal_phone') : ''),      
                		'primary_home_address'=>(parent::getUserMeta($this->input->get('principal'),'principal_primary_address') != false ? parent::getUserMeta($this->input->get('principal'),'principal_primary_address') : ''),      
                		'primary_secondary_address'=>(parent::getUserMeta($this->input->get('principal'),'principal_secondry_adress') != false ? parent::getUserMeta($this->input->get('principal'),'principal_secondry_adress') : ''),      
                		'state'=>(parent::getUserMeta($this->input->get('principal'),'principal_province') != false ? parent::getUserMeta($this->input->get('principal'),'principal_province') : ''),      
                		'city'=>(parent::getUserMeta($this->input->get('principal'),'principal_city') != false ? parent::getUserMeta($this->input->get('principal'),'principal_city') : ''),      
                		'zipcode'=>(parent::getUserMeta($this->input->get('principal'),'principal_zipcode') != false ? parent::getUserMeta($this->input->get('principal'),'principal_zipcode') : ''),      
                		'school'=>$locationarray,      
                		'schoolid'=>$schoolid,
                		'schoolname'=>$school->name,
                		'image'=>$value->profile_image,      
					);
				}
			}
		}
		echo json_encode($is_principal);
	}
	function getassemblydata()
	{
		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}
		//echo $this->input->post("schoolid");
		$assemblydata = array();

			$locations = $this->session->userdata('locations');

			
			$query = $this->operation->GetRowsByQyery('Select * from assembly where school_id ='.$locations[0]['school_id']);

			if(count($query))

			{

				foreach ($query as $key => $value) {

					$assemblydata[] = array(

						'id'=>$value->id,

						'start_time'=>date("H:i",strtotime($value->start_time)),
						'end_time'=>date("H:i",strtotime($value->end_time)),

					);

				}

			}

		

		echo json_encode($assemblydata);
	}
	function saveassembly()
    {
        
        $request = json_decode( file_get_contents('php://input'));
        
        $inputstarttime = $this->security->xss_clean(trim($request->starttime));
        $inputendtime = $this->security->xss_clean(trim($request->endtime));
        $sresult['message'] = false;
        $locations = $this->session->userdata('locations');
        if (!is_null($inputstarttime) && !is_null($inputendtime))
        {
        	// Date Conditions
        	$date1 = date('H:i:s', strtotime($inputstarttime));
        	$date2 = date('H:i:s', strtotime($inputendtime));
        	if(strtotime($date1) < strtotime($date2)){
	        	$query = $this->operation->GetRowsByQyery('Select * from assembly where school_id ='.$locations[0]['school_id']);
	        	if($query)
	        	{

	        		$data = array('start_time' => date('H:i:s', strtotime($inputstarttime)), 'end_time' => date('H:i:s', strtotime($inputendtime)), 'updated_at' => date('Y-m-d H:i'));
					$this->db->where('school_id',$locations[0]['school_id']);
					$this->db->update('assembly',$data);
					$sresult['message'] = true;
	        	}
	        	else
	        	{
	        		$this->operation->table_name = 'assembly';
		            $data = array('start_time' => date('H:i:s', strtotime($inputstarttime)), 'end_time' => date('H:i:s', strtotime($inputendtime)), 'created_at' => date('Y-m-d H:i'), 'school_id' => $locations[0]['school_id']);
		            $id = $this->operation->Create($data);
		            if (count($id))
		            {
		                $sresult['message'] = true;
		            }
	        	}
        	}
        	else
        	{
        		$sresult['message'] = false;
        	}
        }
        echo json_encode($sresult);
    }
    function savebreak()
    {
        
        $request = json_decode( file_get_contents('php://input'));

        $monstarttime = $this->security->xss_clean(trim($request->monstarttime));
        $monendtime = $this->security->xss_clean(trim($request->monendtime));
        $tusstarttime = $this->security->xss_clean(trim($request->tusstarttime));
        $tusendtime = $this->security->xss_clean(trim($request->tusendtime));
        $wedstarttime = $this->security->xss_clean(trim($request->wedstarttime));
        $wedendtime = $this->security->xss_clean(trim($request->wedendtime));
        $thrstarttime = $this->security->xss_clean(trim($request->thrstarttime));
		$threndtime = $this->security->xss_clean(trim($request->threndtime));
		$fristarttime = $this->security->xss_clean(trim($request->fristarttime));
		$friendtime = $this->security->xss_clean(trim($request->friendtime));

        $sresult['message'] = false;
        $locations = $this->session->userdata('locations');
        if (!is_null($monstarttime) && !is_null($monendtime))
        {
        	// Date Conditions
        		$query = $this->operation->GetRowsByQyery('Select * from break where school_id ='.$locations[0]['school_id']);
	        	if($query)
	        	{
	        		$data = array('monday_start_time' => date('H:i:s', strtotime($monstarttime)), 'monday_end_time' => date('H:i:s', strtotime($monendtime)), 
		            			'tuesday_start_time' => date('H:i:s', strtotime($tusstarttime)), 'tuesday_end_time' => date('H:i:s', strtotime($tusendtime)),
		            			'wednesday_start_time' => date('H:i:s', strtotime($wedstarttime)), 'wednesday_end_time' => date('H:i:s', strtotime($wedendtime)),
		            			'thursday_start_time' => date('H:i:s', strtotime($thrstarttime)), 'thursday_end_time' => date('H:i:s', strtotime($threndtime)),
		            			'friday_start_time' => date('H:i:s', strtotime($fristarttime)), 'friday_end_time' => date('H:i:s', strtotime($friendtime)),
		            			'updated_at' => date('Y-m-d H:i'), 'school_id' => $locations[0]['school_id']
		            			);
					$this->db->where('school_id',$locations[0]['school_id']);
					$this->db->update('break',$data);
					$sresult['message'] = true;
	        	}
	        	else
	        	{
	        		$this->operation->table_name = 'break';
		            $data = array('monday_start_time' => date('H:i:s', strtotime($monstarttime)), 'monday_end_time' => date('H:i:s', strtotime($monendtime)), 
		            			'tuesday_start_time' => date('H:i:s', strtotime($tusstarttime)), 'tuesday_end_time' => date('H:i:s', strtotime($tusendtime)),
		            			'wednesday_start_time' => date('H:i:s', strtotime($wedstarttime)), 'wednesday_end_time' => date('H:i:s', strtotime($wedendtime)),
		            			'thursday_start_time' => date('H:i:s', strtotime($thrstarttime)), 'thursday_end_time' => date('H:i:s', strtotime($threndtime)),
		            			'friday_start_time' => date('H:i:s', strtotime($fristarttime)), 'friday_end_time' => date('H:i:s', strtotime($friendtime)),
		            			'created_at' => date('Y-m-d H:i'), 'school_id' => $locations[0]['school_id']
		            			);

		            $id = $this->operation->Create($data);
		            if (count($id))
		            {
		                $sresult['message'] = true;
		            }
	        	}
        }
        	
        
        echo json_encode($sresult);
    }
    function getbreakdata()
	{
		if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}
		//echo $this->input->post("schoolid");
		$assemblydata = array();

		
			
			$locations = $this->session->userdata('locations');
			
			$query = $this->operation->GetRowsByQyery('Select * from break where school_id ='.$locations[0]['school_id']);

			if(count($query))

			{

				foreach ($query as $key => $value) {

					$breakdata[] = array(

						'id'=>$value->id,
						'monday_start_time'=>date("H:i",strtotime($value->monday_start_time)),
						'monday_end_time'=>date("H:i",strtotime($value->monday_end_time)),
						'tuesday_start_time'=>date("H:i",strtotime($value->tuesday_start_time)),
						'tuesday_end_time'=>date("H:i",strtotime($value->tuesday_end_time)),
						'wednesday_start_time'=>date("H:i",strtotime($value->wednesday_start_time)),
						'wednesday_end_time'=>date("H:i",strtotime($value->wednesday_end_time)),
						'thursday_start_time'=>date("H:i",strtotime($value->thursday_start_time)),
						'thursday_end_time'=>date("H:i",strtotime($value->thursday_end_time)),
						'friday_start_time'=>date("H:i",strtotime($value->friday_start_time)),
						'friday_end_time'=>date("H:i",strtotime($value->friday_end_time)),
					);

				}

			}

		

		echo json_encode($breakdata);
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
        $locations = $this->session->userdata('locations');

        
        //$this->data['logo'] = parent::ImageConvertorToBase64(base_url()."images/logo_nr.png");
        $this->load->view("exams/datesheet",$this->data);
    }
    function getDatesheet()
    {
    	$listarray = array();
    	$data_array = array();
    	$locations = $this->session->userdata('locations');
		$request = json_decode(file_get_contents('php://input'));

        $inputclassid = $this->security->xss_clean(trim($request->inputclassid));
        $inputsessionid = $this->security->xss_clean(trim($request->inputsessionid));
        $inputsemesterid = $this->security->xss_clean(trim($request->inputsemesterid));
        $inputtype = $this->security->xss_clean(trim($request->inputtype));

    	if (!is_null($inputclassid)  && !is_null($inputsessionid) && !is_null($inputsemesterid))
    	{
    		$datesheelist = $this->operation->GetRowsByQyery("SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							,d.type
							,d.exam_date
						    , semester.semester_name
						    , subjects.subject_name
						    , sessions.datefrom
						    , sessions.dateto
							FROM
						   	datesheet as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    INNER JOIN subjects 
						        ON (subjects.id = d.subject_id)
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    INNER JOIN semester as sem 
						        ON (d.semester_id = sem.id)
						    WHERE
					        d.class_id  = ".$inputclassid." AND
					        d.session_id  = ".$inputsessionid." AND
					        d.semester_id  = ".$inputsemesterid." AND
					        d.type= '".$inputtype."' AND
					        d.school_id =".$locations[0]['school_id']." ORDER BY d.exam_date");
	    	if (count($datesheelist))
	    	{	

	    		foreach ($datesheelist as $key => $value)
	    		{

	    			$listarray[] =array('id' => $value->id,'start_time'=>date('H:i',strtotime($value->start_time)),'end_time'=>date('H:i',strtotime($value->end_time)),'grade'=>$value->grade,'type'=>$value->type,'semester_name'=>$value->semester_name,'subject_name'=>$value->subject_name,'subject_name'=>$value->subject_name,'exam_date'=>date("M d, Y",strtotime($value->exam_date)),'exam_day'=>date("l",strtotime($value->exam_date)),'duration'=>getDuration($value->start_time,$value->end_time),'action'=>'');
	    		}

	    	}
	    	// Get class Name
	    	$this->operation->table_name = 'classes';

            $is_class = $this->operation->GetByWhere(array('id'=>$inputclassid));
	    	
	    	
	    	// get session date
	    	$this->operation->table_name = 'sessions';

            $is_session = $this->operation->GetByWhere(array('id'=>$inputsessionid));
	    	$session_dates =date("Y",strtotime($is_session[0]->datefrom)).' - '.date("Y",strtotime($is_session[0]->dateto));
	    	
	    	// get semester dates
	    	$this->operation->table_name = 'semester_dates';

            $semester_date_q = $this->operation->GetByWhere(array('semester_id'=>$inputsemesterid,'session_id'=>$inputsessionid));
	    	
	    	$semester_dates =date("M d, Y",strtotime($semester_date_q[0]->start_date)).' - '.date("M d, Y",strtotime($semester_date_q[0]->end_date));
	    	// get semester name
	    	$this->operation->table_name = 'semester';

            $semester_name_q = $this->operation->GetByWhere(array('id'=>$inputsemesterid));
	    	//get school name
	    	$this->operation->table_name = 'schools';

            $school_name_q = $this->operation->GetByWhere(array('id'=>$locations[0]['school_id']));
	    	
	    	$data_array = array('type'=>$inputtype,'grade'=>$is_class[0]->grade,'session_dates'=>$session_dates,'semester_dates'=>$semester_dates,'semester_name' =>$semester_name_q[0]->semester_name,'school_name'=>$school_name_q[0]->name);
	    	
	    	 $result[] = array(
                        'listarray'=>$listarray,
                        
                        'data_array'=>$data_array
                    );

	    	echo json_encode($result);
    	}
    	
    }
    function getTypeList()
    {
    	$listarray = array();
    	$listarray[] = array("Mid"=>"Mid", "Final"=>"Final");
 
		echo json_encode($listarray);
    	
    	
    }
    function AddMidDatesheet()
    {
        
            if(!($this->session->userdata('id'))){

                parent::redirectUrl('signin');

            }
            
        $this->load->view('exams/add_mid_datesheet',$this->data);
    }
    function AddFinalDatesheet()
    {
        
            if(!($this->session->userdata('id'))){

                parent::redirectUrl('signin');

            }
            
        $this->load->view('exams/add_final_datesheet',$this->data);
    }
    function removeDatesheet(){
		$result['message'] = false;
		$removerecorde = $this->db->query("Delete from datesheet where id =".trim($_GET['id']));
		if($removerecorde == TRUE):
			$result['message'] = true;
		endif;
		echo json_encode($result);



	}
	function saveDatesheet()
	{
    
    
	 	if(!($this->session->userdata('id'))){
			parent::redirectUrl('signin');

		}

		$result['message'] = false;
		$locations = $this->session->userdata('locations');
        
		  
        $this->form_validation->set_rules('semester_id', 'Semester Required', 'trim|required');
        $this->form_validation->set_rules('session_id', 'Session Required', 'trim|required');
        
		$this->form_validation->set_rules('select_subject', 'Subject Required', 'trim|required');
		

		if ($this->form_validation->run() == FALSE){
			$result['message'] = false;
		}
		else{
			if($this->input->post('serial')){
				$get_schedule_row = $this->operation->GetRowsByQyery(array('id'=>$this->input->post('serial')));
				$subject_schedual_check = true;
				

				$schedule =  array(
									'last_update'=> date('Y-m-d'),
									'subject_id'=>$this->input->post('select_subject'),
								 	'class_id'=>$this->input->post('select_class'),
								 	'section_id'=>$this->input->post('inputSection'),
								 	'teacher_uid'=>$this->input->post('select_teacher'),
								 	'start_time'=>strtotime($this->input->post('inputFrom')),
								 	'end_time'=>strtotime($this->input->post('inputTo')),
							 	 	'semsterid'=>$active_semester[0]->semester_id,
								 	'sessionid'=>$active_session[0]->id,
								);

				$this->operation->table_name = 'schedule';
				if($subject_schedual_check == true)
				{
					$id = $this->operation->Create($schedule,$this->input->post('serial'));
					if(count($id))
					{
						$result['message'] = true;
					}
				}	
				
			}

			else{
				$subject_schedual_check = true;

				$data =  array(
									
									'subject_id'=>$this->input->post('select_subject'),
								 	'class_id'=>$this->input->post('select_class'),
								 	'session_id'=>$this->input->post('session_id'),
								 	'school_id'=>$locations[0]['school_id'],
								 	'type'=>$this->input->post('type'),
								 	'semester_id'=>$this->input->post('semester_id'),
								 	'start_time'=>date('H:i',strtotime($this->input->post('inputFrom'))),
								 	'end_time'=>date('H:i',strtotime($this->input->post('inputTo'))),
									'exam_date'=>date('Y-m-d',strtotime($this->input->post('exam_date'))),
								 	'created_at'=> date('Y-m-d H:i'),
								);
               
				$this->operation->table_name = 'datesheet';
				//if($subject_schedual_check == true)
				//{
					$id = $this->operation->Create($data);
				//}
				
				if(count($id))
				{
					

					$result['message'] = true;
				}
			}
		}



		echo json_encode($result);
	}
	public function edit_exam_datesheet()
	{
        
			if(!($this->session->userdata('id'))){

				parent::redirectUrl('signin');

			}

		$locations = $this->session->userdata('locations');

			$roles = $this->session->userdata('roles');

			$result = array();

			if($this->uri->segment(2) AND $this->uri->segment(2) != "page" ){

				$schedule_single = $this->operation->GetRowsByQyery("Select * from datesheet where id= ".$this->uri->segment(2));
				if(Count($schedule_single))
				{
					$this->data['schedule_single'] = $schedule_single;

					$result['class_id'] = $schedule_single[0]->class_id;

					$result['semester_id'] = $schedule_single[0]->semester_id;

					$result['subject_id'] = $schedule_single[0]->subject_id;
					$result['exam_date'] = $schedule_single[0]->exam_date;
					$result['type'] = $schedule_single[0]->type;
					$result['start_time'] = date('H:i',strtotime($schedule_single[0]->start_time));

					$result['end_time'] = date('H:i',strtotime($schedule_single[0]->end_time));

				}

				$this->data['result'] = $result;

		}



		
		//$this->data['sectionlist'] = $this->operation->GetRowsByQyery("SELECT username, nic FROM `invantageuser` WHERE type ='t'");

		$this->operation->table_name = "subjects";

		$subjectslist = $this->operation->GetRows();

		$subjects = array();

		// foreach ($subjectslist as $key => $value) {
		// 	$subject_code=$this->operation-.GetRowsByQyery("select * from subjects where id= ".$value->id);

		// 	$value->subject_name=$value->subject_name." (".$subject_code[0]->subject_code." )";
		// }

		// print_r($subjectlist);

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


		




		$classlist = $this->operation->GetRowsByQyery("SELECT  * FROM classes c where school_id=".$locations[0]['school_id']);
		
		$this->data['classlist'] = $classlist;



		$this->data['subjects'] = $subjects;



		$this->load->view('exams/edit_datesheet',$this->data);
	
	}
	function DatesheetDetail()
	{
		if (!is_null($this->input->get('datesheetinfo')))
        {
            $this->operation->table_name = 'datesheet';
            $schedulalist = $this->operation->GetByWhere(array('id' => $this->input->get('datesheetinfo'),));
            $schedulararray = array();
            if (count($schedulalist))
            {
                foreach ($schedulalist as $key => $value)
                {
                    $schedulararray = array('class' => $value->class_id,  'subject' => $value->subject_id, 'session_id' => $value->session_id, 'semester_id' => $value->semester_id, 'subject_id' => $value->subject_id, 'exam_date' => date('Y-m-d',strtotime($value->exam_date)),'start_time' => date('H:i', strtotime($value->start_time)), 'end_time' => date('H:i', strtotime($value->end_time)),);
                }
            }
        }
        echo json_encode($schedulararray);
	}
	function updateDatesheet()
	{
		if(!($this->session->userdata('id'))){
			parent::redirectUrl('signin');

		}

		$result['message'] = false;
		$locations = $this->session->userdata('locations');
        
		  
        $this->form_validation->set_rules('semester_id', 'Semester Required', 'trim|required');
        $this->form_validation->set_rules('session_id', 'Session Required', 'trim|required');
        
		$this->form_validation->set_rules('select_subject', 'Subject Required', 'trim|required');
		

		if ($this->form_validation->run() == FALSE){
			$result['message'] = false;
		}
		else{
			if($this->input->post('serial')){
				$get_schedule_row = $this->operation->GetRowsByQyery(array('id'=>$this->input->post('serial')));
				$subject_schedual_check = true;
				

				$data =  array(
									
									'subject_id'=>$this->input->post('select_subject'),
								 	'class_id'=>$this->input->post('select_class'),
								 	'session_id'=>$this->input->post('session_id'),
								 	'school_id'=>$locations[0]['school_id'],
								 	'semester_id'=>$this->input->post('semester_id'),
								 	'type'=>$this->input->post('select_type'),
								 	'start_time'=>date('H:i',strtotime($this->input->post('inputFrom'))),
								 	'end_time'=>date('H:i',strtotime($this->input->post('inputTo'))),
									'exam_date'=>date('Y-m-d',strtotime($this->input->post('exam_date'))),
								 	'updated_at'=> date('Y-m-d H:i'),
								);

				$this->operation->table_name = 'datesheet';
				
					$id = $this->operation->Create($data,$this->input->post('serial'));
					if(count($id))
					{
						$result['message'] = true;
					}
					
				
			}

			
		}



		echo json_encode($result);
	}
}	
