<div class="col-sm-2 sidenav hidden-xs" id="sidenav">
	<div class="client-log-container" title="Learning InVantage"></div>
  	<ul class="nav nav-pills nav-stacked">
  		<?php 
  		 $roles = $this->session->userdata('roles');
  		 if ($roles[0]['role_id'] ==1){ ?>
  		 	<li class="<?php 
					if($this->uri->segment(1) == 'admindashboard' ){
						echo 'active';
					}
				?> ">
			<a  href="<?php echo base_url(); ?>admindashboard">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span class="link_text"> Home</span>
			</a>
		</li>

			<li class="<?php 
					if($this->uri->segment(1) == 'show_prinicpal_list' || $this->uri->segment(1) == 'add_Prinicpal' ){
						echo 'active';
					}
				?> ">
			<a  href="<?php echo base_url(); ?>show_prinicpal_list">
				<i class="fa fa-user" aria-hidden="true"></i>
				<span class="link_text"> Principals</span>
			</a>
		</li>
			<li class="<?php 
					if($this->uri->segment(1) == 'setting' ){
						echo 'active';
					}
				?> ">
			<a  href="<?php echo base_url(); ?>setting">
				<i class="fa fa-cog" aria-hidden="true"></i>
				<span class="link_text"> Settings</span>
			</a>
		</li>

  		 <?php }?>
  		 <?php
            if ($roles[0]['role_id'] ==4){
            	?>
            
    	<?php //if(count($dashboard) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'teacherdashboard' ){
						echo 'active';
					}
				?> ">
			<a  href="<?php echo base_url(); ?>teacherdashboard">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span class="link_text"> Home</span>
			</a>
		</li>
		<?php //} ?>
		
		
		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_std_list' || $this->uri->segment(1) == 'savestudent'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_std_list">
				<i class="fa fa-user" aria-hidden="true"></i>
				<span class="link_text"> Students</span>
			</a>
		</li>
		<?php //} ?>
		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_class_list' || $this->uri->segment(1) == 'saveannoucement'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_class_list">
				<i class="fa fa-mortar-board" aria-hidden="true"></i>
				<span class="link_text"> Grades</span>
			</a>
		</li>
		<?php //} ?>

			<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_subject_list' || $this->uri->segment(1) == 'saveannoucement'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_subject_list">
				<i class="fa fa-book" aria-hidden="true"></i>
				<span class="link_text"> Subjects</span>
			</a>
		</li>
		<?php //} ?>
					<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_quiz_list' || $this->uri->segment(1) == 'addquizz'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_quiz_list">
				<i class="fa fa-question-circle" aria-hidden="true"></i>
				<span class="link_text"> Quizes</span>
			</a>
		</li>
		<?php //} ?>
<!-- 							<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'announcement' || $this->uri->segment(1) == 'saveannoucement'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>result">
				<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
				<span class="link_text"> Results</span>
			</a>
		</li>
		<?php //} ?> -->
		<?php if($this->session->userdata('is_master_teacher')=='1' || $this->session->userdata('type')=='p'){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'lesson_plan_form' || $this->uri->segment(1) == 'lesson_plan_form'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>lesson_plan_form">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span class="link_text">Default lesson plans</span>
			</a>
		</li>
		<?php } ?>
				<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'semester_lesson_plan_form' || $this->uri->segment(1) == 'semester_lesson_plan_form'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>semester_lesson_plan_form">
				<i class="fa fa-file-excel-o" aria-hidden="true"></i>
				<span class="link_text">Semester lesson plans</span>
			</a>
		</li>
		<?php //} ?>

		<?php //if(count($payroll) > 0){ ?>
	
		<?php }

		else if ($roles[0]['role_id'] ==3){  ?>
	
	<li class="<?php 
					if($this->uri->segment(1) == 'dashboard' ){
						echo 'active';
					}
				?> ">
			<a  href="<?php echo base_url(); ?>dashboard">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span class="link_text"> Home</span>
			</a>
		</li>
	
		<?php //} ?>
<!-- 		<?php //if(count($reports) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'reports'  || $this->uri->segment(1) == 'reportdetail' ){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>reports">
				<span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
				<span class="link_text"> Reports</span>
			</a>
		</li>
		<?php //} ?> -->
		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_std_list' || $this->uri->segment(1) == 'savestudent'){
						echo 'pactive';
					}
				?>">
			<a  href="javascript:void(0)" id="student">
				<i class="fa fa-user" aria-hidden="true"></i>
				<span class="link_text"> Students</span>
				<i class="fa fa-chevron-down lsubmenu-icon"></i>
			</a>
			<ul class="nav nav-pills nav-stacked" id="lsubmenu">
				<li><a  href="<?php echo base_url(); ?>show_std_list">
				<i class="fa fa-list" aria-hidden="true"></i>
				<span class="link_text"> Students List</span>
			</a></li>
			<li>	<a  href="<?php echo base_url(); ?>promotestudents">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<span class="link_text"> Promote Student</span>
			</a></li>
			</ul>
		</li>
		<?php //} ?>
		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_teacher_list' || $this->uri->segment(1) == 'add_teacher'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_teacher_list">
				<i class="fa fa-user-o" aria-hidden="true"></i>
				<span class="link_text"> Teachers</span>
			</a>
		</li>
		<?php //} ?>

<!-- 			<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_parents_list' || $this->uri->segment(1) == 'saveannoucement'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_parents_list">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<span class="link_text"> Parents</span>
			</a>
		</li>
		<?php //} ?> -->
					<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_timtbl_list' || $this->uri->segment(1) == 'add_timtble'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_timtbl_list">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<span class="link_text"> Schedules</span>
			</a>
		</li>
		<?php //} ?>
<!-- 		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'announcement' || $this->uri->segment(1) == 'saveannoucement'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>lesson_plan_form">
				<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
				<span class="link_text">Default Lessons Plan</span>
			</a>
		</li>
		<?php //} ?> -->
	<!-- 	<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'announcement' || $this->uri->segment(1) == 'saveannoucement'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_lesson_list">
				<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
				<span class="link_text"> Lessons</span>
			</a>
		</li>
		<?php //} ?> -->
		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'newclass' || $this->uri->segment(1) == 'show_class_list'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>newclass">
				<i class="fa fa-mortar-board" aria-hidden="true"></i>
				<span class="link_text"> Grades</span>
			</a>
		</li>
		<?php //} ?>
		<?php //if(count($announcements) > 0){ ?>
		<li class="<?php 
					if($this->uri->segment(1) == 'show_subject_list' || $this->uri->segment(1) == 'newsubject'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>show_subject_list">
				<i class="fa fa-book" aria-hidden="true"></i>
				<span class="link_text"> Subjects</span>
			</a>
		</li>
		<?php //} ?>

<?php  if ($roles[0]['role_id'] == 3){?>
		<li class="<?php 
					if($this->uri->segment(1) == 'lesson_plan_form' || $this->uri->segment(1) == 'lesson_plan_form'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>lesson_plan_form">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span class="link_text">Default lesson plans</span>
			</a>
		</li>
		<?php } ?>

		<li class="<?php 
					if($this->uri->segment(1) == 'semester_lesson_plan_form' || $this->uri->segment(1) == 'semester_lesson_plan_form'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>semester_lesson_plan_form">
				<i class="fa fa-file-excel-o" aria-hidden="true"></i>
				<span class="link_text">Semester lesson plans</span>
			</a>
		</li>


					<li class="<?php 
					if($this->uri->segment(1) == 'Tablet_List' ){
						echo 'active';
					}
				?> ">
			
			<a  href="<?php echo base_url(); ?>Tablet_List">
				<i class="fa fa-tablet" aria-hidden="true"></i>
				<span class="link_text"> Devices</span>
			</a>
			
		</li>
			<li class="<?php 
					if($this->uri->segment(1) == 'setting' ){
						echo 'active';
					}
				?> ">
			<a  href="<?php echo base_url(); ?>setting">
				<i class="fa fa-cog" aria-hidden="true"></i>
				<span class="link_text"> Settings</span>
			</a>
		
		</li>
		<li class="">
			<a  href="javascript:void(0)" id="reports">
				<i class="fa fa-user" aria-hidden="true"></i>
				<span class="link_text"> Result Card</span>
				<i class="fa fa-chevron-down lsubmenu-icon"></i>
			</a>
			<ul class="nav nav-pills nav-stacked" id="midresult" style="display: none">
				<li>
					<a  href="<?php echo base_url(); ?>midreport">
					<i class="fa fa-list" aria-hidden="true"></i>
					<span class="link_text"> Mid Term Result</span>
					</a>
				</li>
				<li>
					<a  href="<?php echo base_url(); ?>finalreport">
					<i class="fa fa-plus" aria-hidden="true"></i>
					<span class="link_text"> Final Result</span>
					</a>
				</li>
			</ul>
		</li>
		<li class="<?php 
					if($this->uri->segment(1) == 'classreport' || $this->uri->segment(1) == 'studentreport'){
						echo 'active';
					}
				?>">
			<a  href="<?php echo base_url(); ?>classreport">
				<i class="fa fa-signal" aria-hidden="true"></i>
				<span class="link_text"> Reports</span>
			</a>
		</li>
		<?php } ?>
  </ul>
</div>

