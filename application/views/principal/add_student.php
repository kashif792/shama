<?php

// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>

<div class="col-sm-10" ng-controller="student">
	<?php
		// require_footer
		require APPPATH.'views/__layout/filterlayout.php';
	?>

	<div class="panel panel-default">

		<div class="panel-heading">

			<label>Student</label>

		</div>

		<div class="panel-body">

			<div class="stepwizard">

					    <div class="stepwizard-row setup-panel">

					        <div class="stepwizard-step">

					            <a href="#step-1" type="button" class="btn btn-primary btn-circle">

					            	<img src="<?php echo $path_url;?>images/student_thumb.png">

					            </a>

					            <p>STUDENT INFORMATION</p>

					        </div>

					        <div class="stepwizard-step">

					            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">

					            	<img src="<?php echo $path_url;?>images/learning.png">

					            </a>

					            <p>EDUCATION</p>

					        </div>

					        <div class="stepwizard-step">

					            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">

					            	<img src="<?php echo $path_url;?>images/video-player.png">

					            </a>

					            <p>REFERENCES</p>

					        </div>

					        <div class="stepwizard-step">

					            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">

					            	<img src="<?php echo $path_url;?>images/record.png">

					            </a>

					            <p>DISCLAIMER AND SIGNATURE</p>

					        </div>

					    </div>

					</div>

					<?php $attributes = array('role'=>'form','name' => 'studentForm', 'id' => 'studentForm','class'=>'form-horizontal'); echo form_open_multipart('', $attributes);?>
					    <div class="row setup-content" id="step-1">
					        <div class="col-xs-12">
					            <div class="col-md-12">
					         		<input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>"  name="serial" id="serial">
									<div class="form-group">
										<div class="col-sm-6">
											<label><span class="icon-user"></span> First Name: <span class="required">*</span></label>
											<input type="text" id="inputStudentName" name="inputStudentName" class="form-control" placeholder="Student First Name"   value="<?php if(isset($result)){echo $result['sfullname'];} ?>" required="required">
											<span class="errorhide" id="fullnameerror">Please enter student first name</span>
										</div>	
										<div class="col-sm-6">
											<label><span class="icon-user"></span>  Last Name: <span class="required">*</span></label>
											<input type="text" id="inputStudentLastName" name="inputStudentLastName" class="form-control" placeholder="Student Last Name"   value="<?php if(isset($result)){echo $result['slastname'];} ?>" required="required">
											<span class="errorhide" id="lastnameerror">Please enter student last name</span>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-sm-5">
											<label><span class="icon-address"></span> Street Address: <span class="required">*</span></label>
											<input type="text" id="inputStudentAddress" name="inputStudentAddress" class="form-control" placeholder="Student Address"   value="<?php if(isset($result)){echo $result['saddress'];} ?>" required="required">
											<span class="errorhide" id="studentaddress">Please enter your street address</span>
										</div>
										<div class="col-sm-4">
											<label><span class="icon-address"></span> House/Unit#: <span class="required">*</span></label>
											<input type="text" id="iputHouseUnit" name="iputHouseUnit" placeholder="House/Unit#" class="form-control"   value="<?php if(isset($result)){echo $result['shunit'];} ?>" required>
											<span class="errorhide" id="student_house_no">Please enter your house #</span>
										</div>
										<div class="col-sm-3">
											<label><span class="icon-address"></span> City: <span class="required">*</span></label>
											<input type="text" placeholder="City" id="inputCity"  class="form-control" name="inputCity" value="<?php if(isset($result)){echo $result['scity'];} ?>">
											<span class="errorhide" id="student_city">Please enter your city</span>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-sm-4">
											<label><span class="icon-home-1"></span> Province <span class="required"></span></label>
											<select name="inputProvice" class="form-control" value="<?php if(isset($result)){echo $result['sprovice'];} ?>">
			                					<option value="Azad Kashmir" <?php if($result['sprovice'] == "Azad Kashmir") echo "selected";?> >Azad Kashmir</option>
			                					<option value="Balochistan" <?php if($result['sprovice'] == "Balochistan") echo "selected";?>>Balochistan</option>
			                					<option <?php if($result['sprovice'] == "Federally Administered Tribal Areas") echo "selected";?> value="Federally Administered Tribal Areas">Federally Administered Tribal Areas</option>
			                					<option <?php if($result['sprovice'] == "Islamabad Capital Territory") echo "selected";?> value="Islamabad Capital Territory">Islamabad Capital Territory</option>
			                					<option <?php if($result['sprovice'] == "Khyber Pakhtunkhwa") echo "selected";?> value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
			                					<option <?php if($result['sprovice'] == "Northern Areas") echo "selected";?> value="Northern Areas">Northern Areas</option>
			                					<option <?php if($result['sprovice'] == "Punjab") echo "selected";?> value="Punjab">Punjab</option>
			                					<option <?php if($result['sprovice'] == "Sindh") echo "selected";?> value="Sindh">Sindh</option>
			                				</select>
										</div>
										<div class="col-sm-4">
											<label><span class="icon-code"></span> Post Code <span class="required"></span></label>
											<input type="text" class="form-control" placeholder="Zip code" id="inputPostCode" name="inputPostCode" value="<?php if(isset($result)){echo $result['spcode'];} ?>">
										</div>
										<div class="col-sm-4">
											<label><span class="icon-phone"></span> Phone: <span class="required"></span></label>
			                				<input type="text" id="inputPhone" name="inputPhone" class="form-control" value="<?php if(isset($result)){echo $result['sphone'];} ?>">
			                				<span id="valid-msg" class="hide">✓ Valid</span>
											<span id="error-msg" class="hide">Invalid number</span>
										</div>
									</div>
										<div class="form-group hide">
											<div class="col-sm-4 hide">
											<label><span class="icon-mail-alt"></span> Email:</label>
											<input  type="email" class="form-control"  placeholder="Example@gmail.com" id="inputEmail" name="inputEmail" ng-blur="checkemailduplication()" value="<?php if(isset($result)){echo $result['semail'];} ?>">
											<span class="errorhide" id="student_email">Please enter your valid email address</span>
											</div>
											<div class="col-sm-4">

											<label class="" for="inputNewPassword">Password <span class="required">*</span></label>

					  						<input type="password" id="inputNewPassword" name="inputNewPassword" placeholder="New Password"  tabindex="7" class="form-control"> 

					  						<span class="errorhide" id="student_passowrd">Please enter your password </span>

											</div>

											<div class="col-sm-4">

											<label class="" for="inputRetypeNewPassword">Retype Password: <span class="required">*</span></label>

					  						<input type="password" id="inputRetypeNewPassword" name="inputRetypeNewPassword" placeholder="Retype New Password"  tabindex="7" class="form-control"> 

					  						<span class="errorhide" id="student_re_passowrd">Please re-type the same password </span>

											</div>
									</div>
									<div class="form-group">
												<div class="col-sm-4">
											 <label><span class="icon-mail-alt"></span> Date  of Birth: <span class="required">*</span></label>
												<input class="form-control" type="text"  placeholder="Enter your date of birth" id="student_dob" name="student_dob"  value="<?php if(isset($result)){echo $result['sdob'];} ?>"
			                							>
											<span class="errorhide" id="student_dob">Please enter your valid date of birth</span>
			               				</div>	
								
										<div class="col-sm-4">
											<label><span class="icon-calendar"></span> Enrollment Date:</label>
											<input type="text" id="inputDateAvai" class="form-control" name="inputDateAvai" placeholder="Date Available:" value="<?php if(isset($result)){echo $result['sdateav'];} ?>">
										</div>
										<div class="col-sm-4">
											<label> NIC#: </label>
											<input type="text" id="inputCnic" class="form-control" name="inputCnic" placeholder="xxxxx-xxxxxxx-x"  value="<?php if(isset($result)){echo $result['snic'];} ?>">
											<span class="errorhide" id="student_nic">Please enter your NIC# in this format xxxxx-xxxxxxx-x </span>
										</div>	
									</div>
											<div class="form-group">
							
										<div class="col-sm-6">
											<label><span class="icon-address"></span> Mother Language <span class="required"></span></label>
		                					<input class="form-control" type="text" placeholder="Mother Language" id="inputMohterLang" name="inputMohterLang" value="<?php if(isset($result)){echo $result['smthrlng'];} ?>">
										</div>
										<div class="col-sm-6">
											<label><span class="icon-star-1"></span> Additional Languages : <span class="required"></span></label>
											<select class="form-control" name="inputLanguage" id="inputLanguage" value="<?php if(isset($result)){echo $result['saddlang'];} ?>">
			                					<option  value="Punjabi" <?php if($result['saddlang'] == "Punjabi") echo "selected";?>>Punjabi</option>
			                					<option value="Sindhi" <?php if($result['saddlang'] == "Sindhi") echo "selected";?>>Sindhi</option>
			                					<option value="Balochi" <?php if($result['saddlang'] == "Balochi") echo "selected";?>>Balochi</option>
			                					<option value="Hindhi" <?php if($result['saddlang'] == "Hindhi") echo "selected";?>>Hindhi</option>
			                					<option value="Other" <?php if($result['saddlang'] == "Other") echo "selected";?>>Other</option>
			                				</select>
										</div>	
									</div>

									<div class="form-group">
										<div class="col-sm-5" ng-init="editedclass ='<?php if(isset($result)){echo $result['class'];} ?>'">
											<label><span class="icon-table"></span> Grade: <span class="required">*</span></label>
											<select class="form-control"  ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="select_class" ng-change="loadSections()"></select>
                    						<span class="errorhide" id="class_error">Class required</span>
										</div>
										<div class="col-sm-4" ng-init="editedsection ='<?php if(isset($result)){echo $result['section'];} ?>'">
											<label><span class="icon-calendar"></span> Sections:</label>
		                					<select class="form-control"  ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="inputSection" >
			                				</select>
			                				<span class="errorhide" id="section_error">Section required</span>
										</div>
										<div class="col-sm-3" ng-init="editedsemester ='<?php if(isset($result)){echo $result['semester'];} ?>'">
											<label><span class="icon-user"></span> Semester#: </label>
											<select class="form-control"   ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="inputSemester" ></select>
               				 				<span class="errorhide" id="semester_error">Semester required</span>
										</div>	
									</div>

					                <div class="form-group">
					                	<div class="col-lg-12">
				                			<label><span class="icon-user"></span> Father Name: <span class="required"></span></label>
					                		<input class="form-control" type="text" placeholder="Father Name" id="inputFathername" name="inputFathername" value="<?php if(isset($result)){echo $result['father_name'];} ?>">
					                	</div>
					                </div>
					                <div class="form-group">
					                	<div class="col-lg-12">
			                				<label><span class="icon-user"></span> Father NIC#: <span class="required"></span></label>
					                		<input class="form-control" type="text" placeholder="Father NIC#" id="inputFatherNic" name="inputFatherNic" value="<?php if(isset($result)){echo $result['father_nic'];} ?>">
					                	</div>
					                </div>
					                <div class="form-group">
					                	<div class="col-lg-6">
				                			<label><span class="icon-user-md"></span> Profession: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Profession" id="inputProfession" name="inputProfession" value="<?php if(isset($result)){echo $result['father_profession'];} ?>">

					                	</div>
					                	<div class="col-lg-6">
				                			<label><span class="icon-calendar"></span> Years: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Years" id="inputYear" name="inputYear" value="<?php if(isset($result)){echo $result['father_years'];} ?>">
					                	</div>
					                </div>
					                <div class="form-group">
					                	<div class="col-lg-4">
				                			<label><span class="icon-building-filled"></span> Company: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Company" id="inputCompany" name="inputCompany" value="<?php if(isset($result)){echo $result['father_company'];} ?>">

					                	</div>
					                	<div class="col-lg-4">
				                			<label><span class="icon-calendar"></span> Years: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Year" id="inputCYears" name="inputCYears" value="<?php if(isset($result)){echo $result['father_comapny_years'];} ?>">
					                	</div>
					                	<div class="col-lg-4">
				                			<label><span class="icon-dollar-1"></span> Monthly Income: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Monthly Income" id="inputIncome" name="inputIncome" value="<?php if(isset($result)){echo $result['monthly_income'];} ?>">
					                	</div>
					                </div>
					                <div class="form-group">
					                	<div class="col-lg-12">
				                			<label><span class="icon-home-1"></span> Work Address: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Work Address" id="inputWorkAddress" name="inputWorkAddress" value="<?php if(isset($result)){echo $result['father_work_address'];} ?>">
					                	</div>
					                </div>
					                <div class="form-group">
					                	<div class="col-lg-12">
				                			<label><span class="icon-dollar-1"></span> Monthly Income: <span class="required"></span></label>
				                			<input class="form-control" type="text" placeholder="Monthly Income" id="inputMonthlyIncome" name="inputMonthlyIncome" value="<?php if(isset($result)){echo $result['father_monthly_income_2'];} ?>">
					                	</div>
					                </div>

					                <div class="form-group">

					                	<div class="col-lg-12">

				                			<p>Are you requesting financial assistance:(If yes, please fill out Application for Financial Assistance)</p>

					                		<input type="radio" name="inputAssistance" value="yes" checked>Yes

					                		<input  type="radio" name="inputAssistance" value="no" value="<?php if(isset($result)){echo $result['financial_assistance'];} ?>">No

					                	</div>

				                	</div>

					                <div class="form-group">

					                	<div class="col-lg-12">


					                			<label><span class="icon-tasks"></span> Special Circumstances: <span class="required"></span></label>

					                			<input class="form-control" type="text" id="inputCircumstances" name="inputCircumstances" placeholder="Any Special Circumstances" value="<?php if(isset($result)){echo $result['circumstances'];} ?>">

				                		</div>

				                	</div>

					                <div class="form-group">
					                	<div class="col-lg-12">
	            							<label><span class="icon-tasks"></span> Upload Image:</label>
			                				<div class="file-upload">
		 						 				<button class="btn btn-primary file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
			 							 		<div class="image-upload-wrap">
			   							 			<input  class="file-upload-input" type='file' onchange="angular.element(this).scope().readURL(event);"  id="upload_img" name="upload_img" accept="image/*" />
				    								<div class="drag-text">
				      									<h3>Drag and drop an image or select add Image</h3>
				   								 	</div>
			  									</div>
						  						<div class="file-upload-content">
					   							 	<img class="file-upload-image" src="#" alt="your image" />
						   					 		<div class="image-title-wrap">
						      							<button type="button" ng-click="removeUpload()" class="remove-image">Remove</button>
						   							 </div>
						  						</div>
											</div>
										</div>
									</div>	
									<div class="row file-upload" style="padding-top: 0;padding-bottom: 0;">
										<div class="col-sm-12">
												<video id="video" width="640" height="480" style="display:none;"></video>
												<canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button type="button" id="take_pic_btn" class="file-upload-btn btn btn-primary" name="button" ng-click="openwebcam()">Take Picture</button>
											<input id="print" class="file-upload-btn btn btn-primary" style="display:none;" type="button" name="print" value="Capture Screenshot" onclick="popup()"/>
										</div>
									</div>
	        		 				<div class="form-group">
	        		 				  	<div class="caption">
					 						<p class="lead">Profile Image</p>
										</div>
	        		 					<div class="col-sm-4" id="imagesize">
	            		 					<img class="img-rounded" src='<?php if(isset($student_single)){ echo $student_single[0]->profile_image;} ?>' width="250" height="">
	        		 					</div>
	                		 		</div>
	        		 				<?php if(isset($student_single)){ ?>
	                		 			<div class="form-group">
	                		 				<div class="col-sm-4" id="edit_thumbnail">
	                		 					<img class="img-rounded " src='<?php if(isset($student_single)){ echo $student_single[0]->profile_image;} ?>' width="250px" height="">
	            		 					</div>
	                		 			</div>
		 							<?php } ?>
				                	<div class="form-group">
				                		<div class="col-lg-12">
				                			<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="bio_next">Next</button>
				                		</div>
				                	</div>
					        	</div>
					    	</div>
						</div>
					    <div class="row setup-content" id="step-2">

					        <div class="col-xs-12">

					            <div class="col-md-12">

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Previous School: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputPrevisous1" name="inputPrevisous1" placeholder="Previous School"   value="<?php if(isset($result)){echo $result['previous_school_1'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Address: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputAddress1" name="inputAddress1" placeholder="Address"   value="<?php if(isset($result)){echo $result['school_history_address_1'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> From: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputFrom1" name="inputFrom1" placeholder="From"   value="<?php if(isset($result)){echo $result['from_1'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> To: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputTo1" name="inputTo1" placeholder="To"   value="<?php if(isset($result)){echo $result['to_1'];} ?>">

					                	</div>

					                </div>

					                  <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Previous School: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputPrevisous2" name="inputPrevisous2" placeholder="Previous School"   value="<?php if(isset($result)){echo $result['previous_school_2'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Address: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputAddress2" name="inputAddress2" placeholder="Address"   value="<?php if(isset($result)){echo $result['school_history_address_2'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> From: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputFrom2" name="inputFrom2" placeholder="From"   value="<?php if(isset($result)){echo $result['from_2'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> To: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputTo2" name="inputTo2" placeholder="To"   value="<?php if(isset($result)){echo $result['to_2'];} ?>">

					                	</div>

					                </div>

					                  <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Previous School: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputPrevisous3" name="inputPrevisous3" placeholder="Previous School"   value="<?php if(isset($result)){echo $result['previous_school_3'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Address: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputAddress3" name="inputAddress3" placeholder="Address"  value="<?php if(isset($result)){echo $result['school_history_address_3'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> From: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputFrom3" name="inputFrom3" placeholder="From"   value="<?php if(isset($result)){echo $result['from_3'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> To: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputTo3" name="inputTo3" placeholder="To"   value="<?php if(isset($result)){echo $result['to_3'];} ?>">

					                	</div>

					                </div>

					                <button class="btn btn-primary nextBtn btn-lg pull-right fnsh" type="button" >Next</button>

					            </div>

					        </div>

					    </div>

					    <div class="row setup-content" id="step-3">

					        <div class="col-xs-12">

					            <div class="col-md-12">

				                  	<div class="form-group">

					                	<div class="col-lg-12">

					                		<p>Please list three personal references.</p>

					                	</div>

				                	</div>

				                	<div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Full Name: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefFullname1" name="inputRefFullname1" placeholder="Full Name"   value="<?php if(isset($result)){echo $result['student_reference_fullname'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Relationship: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRelationship1" name="inputRelationship1" placeholder="Relationship"   value="<?php if(isset($result)){echo $result['student_reference_relationship'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Company: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefCompany1" name="inputRefCompany1" placeholder="Company"   value="<?php if(isset($result)){echo $result['student_refernce_company'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-phone"></span> Phone: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputPhone1" name="inputPhone1" placeholder="Phone"   value="<?php if(isset($result)){echo $result['student_reference_phone'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-12">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Address: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefAddress1" name="inputRefAddress1" placeholder="Address"   value="<?php if(isset($result)){echo $result['student_reference_adress'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Full Name: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefFullname2" name="inputRefFullname2" placeholder="Full Name"   value="<?php if(isset($result)){echo $result['student_reference_fullname2'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Relationship: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRelationship2" name="inputRelationship2" placeholder="Relationship"   value="<?php if(isset($result)){echo $result['student_reference_relationship2'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Company: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefCompany2" name="inputRefCompany2" placeholder="Company"   value="<?php if(isset($result)){echo $result['student_refernce_company2'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-phone"></span> Phone: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputPhone2" name="inputPhone2" placeholder="Phone"   value="<?php if(isset($result)){echo $result['student_reference_phone2'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-12">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Address: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefAddress2" name="inputRefAddress2" placeholder="Company"   value="<?php if(isset($result)){echo $result['student_reference_adress2'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Full Name: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefFullname3" name="inputRefFullname3" placeholder="Full Name"   value="<?php if(isset($result)){echo $result['student_reference_fullname3'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-user"></span> Relationship: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRelationship3" name="inputRelationship3" placeholder="Relationship"   value="<?php if(isset($result)){echo $result['student_reference_relationship3'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Company: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefCompany3" name="inputRefCompany3" placeholder="Company"   value="<?php if(isset($result)){echo $result['student_refernce_company3'];} ?>">

					                	</div>

					                	<div class="col-lg-6">

					                		<div class="upper-row">

					                			<label><span class="icon-phone"></span> Phone: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputPhone3" name="inputPhone3" placeholder="Phone"   value="<?php if(isset($result)){echo $result['student_reference_phone3'];} ?>">

					                	</div>

					                </div>

					                <div class="form-group">

					                	<div class="col-lg-12">

					                		<div class="upper-row">

					                			<label><span class="icon-address"></span> Address: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputRefAddress3" name="inputRefAddress3" placeholder="Company"   value="<?php if(isset($result)){echo $result['student_reference_adress3'];} ?>">

					                	</div>

					                </div>

					               <button class="btn btn-primary nextBtn btn-lg pull-right fnsh" type="button" >Next</button>

					            </div>

					        </div>

					    </div>

				     	<div class="row setup-content" id="step-4">

				     		 <div class="col-xs-12">

					            <div class="col-md-12">

				                  	<div class="form-group">

					                	<div class="col-lg-12">

					                		<p>I certify that my answers are true and complete to the best of my knowledge.</p>

					                		<p>If this application leads to enrollment, I understand that false or misleading information in my application or interview may result in my termination.</p>

					                	</div>

				                	</div>

				                	<div class="form-group">

				                		<div class="col-lg-6">

				                			<div class="upper-row">

					                			<label><span class="icon-user"></span> Signature: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputSignature" name="inputSignature" placeholder="Student Signature"   value="<?php if(isset($result)){echo $result['student_signature'];} ?>">

				                		</div>

				                		<div class="col-lg-6">

				                			<div class="upper-row">

					                			<label><span class="icon-back-in-time"></span> Date: <span class="required"></span></label>

					                		</div>

				                			<input class="form-control" type="text" id="inputSubmitDate" name="inputSubmitDate" placeholder="Previous School"   value="<?php if(isset($result)){echo $result['student_submate_date'];} ?>">

				                		</div>

				                	</div>

				                	<button class="btn btn-success btn-lg pull-right fnsh" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Finish!</button>

			                	</div>

			                </div>

				     	</div>

					<?php echo form_close();?>

				</div>

		</div>

	</div>





<?php

// require_footer

require APPPATH.'views/__layout/footer.php';

?>

<script type="text/javascript" src="<?php echo $path_url; ?>js/wizard.js"></script>

<script type="text/javascript">

	/**
     * charCode [48,57]     Numbers 0 to 9
     * keyCode 46           "delete"
     * keyCode 9            "tab"
     * keyCode 13           "enter"
     * keyCode 116          "F5"
     * keyCode 8            "backscape"
     * keyCode 37,38,39,40  Arrows
     * keyCode 10           (LF)
     */
    function validate_int(myEvento) {
  		if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
        	dato = true;
      	} else {
        	dato = false;
      	}
      	return dato;
    }

    document.getElementById("inputPhone").onkeypress = validate_int;
    document.getElementById("inputPhone").onkeyup = phone_number_mask;

    document.getElementById("inputCnic").onkeypress = validate_int;
    document.getElementById("inputCnic").onkeyup = nic_number_mask;
    function phone_number_mask() {

  		var myMask = "____-_______";
      	var myCaja = document.getElementById("inputPhone");
      	var myText = "";
      	var myNumbers = [];
      	var myOutPut = ""
      	var theLastPos = 1;
      	myText = myCaja.value;
      	//get numbers
      	for (var i = 0; i < myText.length; i++) {
        	if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
          		myNumbers.push(myText.charAt(i));
        	}
      	}

      	//write over mask
      	for (var j = 0; j < myMask.length; j++) {
        	if (myMask.charAt(j) == "_") { //replace "_" by a number 
          		if (myNumbers.length == 0)
            		myOutPut = myOutPut + myMask.charAt(j);
          		else {
            		myOutPut = myOutPut + myNumbers.shift();
            		theLastPos = j + 1; //set caret position
          		}
        	} else {
         	 	myOutPut = myOutPut + myMask.charAt(j);
        	}
      	}
      	document.getElementById("inputPhone").value = myOutPut;
      	document.getElementById("inputPhone").setSelectionRange(theLastPos, theLastPos);
    }

    function nic_number_mask() {
    	try{
       		var myMask = "_____-_______-_";
      		var myCaja = document.getElementById("inputCnic");
	      	var myText = "";
	      	var myNumbers = [];
	      	var myOutPut = ""
	      	var theLastPos = 1;
	      	myText = myCaja.value;

      		//get numbers
      		for (var i = 0; i < myText.length; i++) {
        		if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
          			myNumbers.push(myText.charAt(i));
        		}
      		}

      		//write over mask
      		for (var j = 0; j < myMask.length; j++) {
    			if (myMask.charAt(j) == "_") { //replace "_" by a number 
          			if (myNumbers.length == 0)
            			myOutPut = myOutPut + myMask.charAt(j);
          			else {
            			myOutPut = myOutPut + myNumbers.shift();
            			theLastPos = j + 1; //set caret position
          			}
        		} else {
          			myOutPut = myOutPut + myMask.charAt(j);
        		}
      		}
      		document.getElementById("inputCnic").value = myOutPut;
      		document.getElementById("inputCnic").setSelectionRange(theLastPos, theLastPos);
  		}
  		catch( e)
  		{
  			console.log(e)
  		}
   	}

	$(document).ready(function(){
		initdatepickter('input[name="student_dob"]',new Date('<?php if(isset($result)){echo $result['sdob'];}else{ echo date('Y-m-d');} ?>'))
		initdatepickter('input[name="inputDateAvai"]',new Date('<?php if(isset($result)){echo $result['sdateav'];}else{ echo date('Y-m-d');} ?>'))
		

		initdatepickter('input[name="inputFrom1"]',new Date('<?php if(isset($result)){echo $result['from_1'];}else{ echo date('Y-m-d');} ?>'))

		initdatepickter('input[name="inputFrom2"]',new Date('<?php if(isset($result)){echo $result['from_2'];}else{ echo date('Y-m-d');} ?>'))

		initdatepickter('input[name="inputFrom3"]',new Date('<?php if(isset($result)){echo $result['from_3'];}else{ echo date('Y-m-d');} ?>'))

		initdatepickter('input[name="inputTo1"]',new Date('<?php if(isset($result)){echo $result['to_1'];}else{ echo date('Y-m-d');} ?>'))

		initdatepickter('input[name="inputTo2"]',new Date('<?php if(isset($result)){echo $result['to_2'];}else{ echo date('Y-m-d');} ?>'))

		initdatepickter('input[name="inputTo3"]',new Date('<?php if(isset($result)){echo $result['to_3'];}else{ echo date('Y-m-d');} ?>'))

		initdatepickter('input[name="inputSubmitDate"]',new Date('<?php if(isset($result)){echo $result['student_submate_date'];}else{ echo date('Y-m-d');} ?>'))

	 	function initdatepickter(dateinput,inputdate)

	 	{
	 		
	 		$(dateinput).daterangepicker({

	         	singleDatePicker: true,

		        showDropdowns: true,

		        startDate:inputdate,

		        locale: {

		            format: 'D MMMM, YYYY'

		        }

	    	});

	 	}

	});

	var is_take_image_mode_set = false;
	var is_take_image_set = false ;

	// Trigger photo take
		var context = canvas.getContext('2d');

		function popup(){
			is_take_image_set == false
			is_take_image_mode_set = true;
		  //  takeimagefromwebcam()
		  	context.drawImage(video, 0, 0, 640, 480);
		  	var image = new Image();
		  	image.src = canvas.toDataURL("image/png");
		  	$('.file-upload-image').attr('src', image.src);

		  	$("#video").hide()
		  	$("#print").hide()
		  	$("#take_pic_btn").show()
			$('.file-upload-input').attr('value', image.src);

			$('.image-upload-wrap').hide();
			$("#edit_thumbnail").hide()
			$('.file-upload-content').show();

		    //window.open("<?php //echo $path_url; ?>take_pic", "_blank", "toolbar=no, scrollbars=no, resizable=no, top=80, left=400, width=600, height=500px");
		}
	//
	// setInterval(function(){
    // 	if(is_take_image_mode_set == true && is_take_image_set == false)
    //     {
    // 		takeimagefromwebcam()
    //     }
    // },3000)

</script>





<script type="text/javascript">









</script>

<script type="text/javascript">

		/*$(document).on('keyup','#inputCnic',function(){
			var niclenght = $('#inputCnic');
		
			if(niclenght.val().length == 5)
			{
				 niclenght.append('-');
			}
			if(niclenght.val().length == 13)
			{
				 niclenght.append('-');
			}
			if(niclenght.val().length == 14)
			{
				 niclenght.append('-');
			}
		});*/

	var app = angular.module('invantage', []);

	

	app.controller('student', function($scope, $http, $interval,$compile) {

		$scope.openwebcam = function()
		{
			// Grab elements, create settings, etc.
			var video = document.getElementById('video');
			// Get access to the camera!
			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
			    // Not adding `{ audio: true }` since we only want video now
			    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
			        video.src = window.URL.createObjectURL(stream);
			        video.play();
			    });
			}

			$("#video").show()
			$("#print").show()
			$("#take_pic_btn").hide()
		}

        /*
         * ---------------------------------------------------------
         *   Save Studfent
         * ---------------------------------------------------------
         */

		 var navListItems = $('div.setup-panel div a'),

            allWells = $('.setup-content'),

            allNextBtn = $('.nextBtn');



    		allWells.hide();



	    navListItems.click(function (e) {

	        e.preventDefault();

	        var $target = $($(this).attr('href')),

	                $item = $(this);



	        if (!$item.hasClass('disabled')) {

	            navListItems.removeClass('btn-primary').addClass('btn-default');

	            $item.addClass('btn-primary');

	            allWells.hide();

	            $target.show();

	            $target.find('input:eq(0)').focus();

	        }

	    });

	    // $scope.checkemailduplication = function()
	    // {
	    // 	checkUseremail();
	    // }

	    function checkUseremail()
	    {
	    	var inputEmail=$("#inputEmail").val()
	 		var inputTeacher_Nic=$("#inputCnic").val();
			var data = ({inputEmail:inputEmail,inputTeacher_Nic:inputTeacher_Nic,inputserial:$("#serial").val()})
			httprequest('<?php echo $path_url; ?>CheckUserEmail',data).then(function(response)
			{
				if(response.message==true)
				{
					document.getElementById('student_email').innerHTML="Email already exist";
					jQuery("#inputEmail").addClass('errorshow');
            		$("#student_email").show()
            		isValid = false;
            		document.getElementById('bio_next').disabled = true;
            		return false

				}else{
					document.getElementById('student_email').innerHTML="";
					jQuery("#inputEmail").removeClass('errorshow');
            		$("#student_email").hide()
            		
					document.getElementById('bio_next').disabled = false;
				}
				// else if(response.nic==true)
				// {
				// 	document.getElementById('student_nic').innerHTML="NIC already exist";

				// 	//jQuery("#student_nic").addClass('errorshow');
    //         		$("#student_nic").show()
    //         		isValid = false;
    //         		return false;
				// }
			});
	    }

    $(document).on('click','.nextBtn',function(){

	  	var curStep = $(this).closest(".setup-content"),

        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text']"),
        isValid = true;
       
       


        if(curStepBtn == 'step-1')
        {
        	 isValid = false;
        	  var studentfirstname = $("#inputStudentName").val();
        	  var inputStudentLastName = $("#inputStudentLastName").val();
        	  var inputCity= $ ("inputCity").val();
        var inputSection = $("#inputSection").val();

        var studentaddress = $("#inputStudentAddress").val();

        var iputHouseUnit=$("#iputHouseUnit").val();

        var inputPhone=$("#inputPhone").val();

        //var inputEmail=$("#inputEmail").val();
       // var inputNewPassword=$("#inputNewPassword").val();
       // var inputRetypeNewPassword=$("#inputRetypeNewPassword").val();

         var inputCnic=$("#inputCnic").val();



     	var reg = new RegExp(/^[A-Za-z0-9 ]{3,50}$/);

		var regHouse = new RegExp(/^[A-Za-z0-9 ]{1,50}$/);

        if(reg.test(studentfirstname) == false){

            jQuery("#inputStudentName").addClass('errorshow');
            $("#fullnameerror").show()
            isValid = false;

            return false;

        }

        else{

            isValid = true;

            jQuery("#inputStudentName").removeClass('errorshow');
            $("#fullnameerror").hide()
        }

        if(reg.test(inputStudentLastName) == false){

            jQuery("#inputStudentLastName").addClass('errorshow');
            $("#lastnameerror").show()
            isValid = false;
            return false;

        }

        else{

            isValid = true;

            jQuery("#inputStudentLastName").removeClass('errorshow');
            $("#lastnameerror").hide()
        }



        if(reg.test(studentaddress) == false){

            jQuery("#inputStudentAddress").addClass('errorshow');
            $("#studentaddress").show()

            isValid = false;

            return false;

        }

        else{

            isValid = true;

            jQuery("#inputStudentAddress").removeClass('errorshow');
            $("#studentaddress").hide()

        }



        if(regHouse.test(iputHouseUnit) == false){

            jQuery("#iputHouseUnit").addClass('errorshow')
            $("#student_house_no").show()
            isValid = false;

            return false;

        }

        else{

            isValid = true;

            jQuery("#iputHouseUnit").removeClass('errorshow');
            $("#student_house_no").hide()
        }
                if(reg.test(studentfirstname) == false){

            jQuery("#inputStudentName").addClass('errorshow');
            $("#fullnameerror").show()
            isValid = false;

            return false;

        }

        else{

            isValid = true;

            jQuery("#inputStudentName").removeClass('errorshow');
            $("#fullnameerror").hide()
        }

        if(reg.test(inputCity) == false){

            jQuery("#inputCity").addClass('errorshow');
            $("#student_city").show()
            isValid = false;
            return false;

        }

        else{

            isValid = true;

            jQuery("#inputCity").removeClass('errorshow');
            $("#student_city").hide()
        }



			
		var eregix=new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/);


		// if(inputEmail)
		// {
		// 	if(eregix.test(inputEmail)==false){
  //        	document.getElementById('student_email').innerHTML="Please enter a valid email";
  //           jQuery("#inputEmail").addClass('errorshow');
  //           $("#student_email").show()
  //           isValid = false;

  //           return false;

  //       }

  //       else{

  //           isValid = true;
  //            $("#student_email").hide()
  //            document.getElementById('student_email').innerHTML="";
  //           jQuery("#inputEmail").removeClass('errorshow')
  //       }
  //       	checkUseremail();
		// }


			 // var reg = new RegExp(/^[A-Za-z0-9]{3,50}$/);
    //         if(reg.test(inputNewPassword) == false){
    //             jQuery("#inputNewPassword").addClass('errorshow');
    //             $("#student_passowrd").show()
    //             return false;
    //         }

    //         else{

    //             jQuery("#inputNewPassword").removeClass('errorshow');

    //             $("#student_passowrd").hide()

    //         }

    //         if(reg.test(inputRetypeNewPassword) == false){

    //             jQuery("#inputRetypeNewPassword").addClass('errorshow');

    //             $("#student_re_passowrd").show()

    //             return false;

    //         }

    //         else{

    //             jQuery("#inputRetypeNewPassword").removeClass('errorshow');

    //              $("#student_re_passowrd").hide()

    //         }

    //         if(inputRetypeNewPassword != inputNewPassword ){

    //             jQuery("#inputRetypeNewPassword").addClass('errorshow');

    //             jQuery("#inputNewPassword").addClass('errorshow');

    //             $("#confimr_passowrd").show()

    //             return false;

    //         }

    //         else{

    //             jQuery("#inputRetypeNewPassword").removeClass('errorshow');

    //             jQuery("#inputNewPassword").removeClass('errorshow');

    //               $("#confimr_passowrd").hide()

    //         }



         
        	  var creg = new RegExp(/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/);



		if(creg.test(inputCnic)==false){

            jQuery("#inputCnic").addClass('errorshow')
              $("#student_nic").show()
            isValid = false;

            return false;

        }

        else{

			document.getElementById('student_nic').innerHTML='';
            isValid = true;
              $("#student_nic").hide()
            jQuery("#inputCnic").removeClass('errorshow')

        }
        }

        if($scope.select_class == null || $scope.select_class == '')
        {
    		 jQuery("#select_class").addClass('errorshow')
              $("#class_error").show()
            	isValid = false;

            return false;
        }else{
        	jQuery("#select_class").removeClass('errorshow')
              $("#class_error").hide()
            	isValid = true;

            
        }

        if($scope.inputSection == null || $scope.inputSection == '')
        {
    		 jQuery("#inputSection").addClass('errorshow')
              $("#section_error").show()
            	isValid = false;

            return false;
        }else{
        	jQuery("#inputSection").removeClass('errorshow')
              $("#section_error").hide()
            	isValid = true;

            
        }

        if($scope.inputSemester == null || $scope.inputSemester == '')
        {
    		 jQuery("#inputSemester").addClass('errorshow')
              $("#semester_error").show()
            	isValid = false;

            return false;
        }else{
        	jQuery("#inputSemester").removeClass('errorshow')
              $("#semester_error").hide()
            	isValid = true;

            
        }

        if (isValid){
        	nextStepWizard.removeAttr('disabled').trigger('click');
        }

	});
	


    $("#studentForm").submit(function(){

        var dataString = $('#studentForm').serializeArray();
       
     	var $this = $(".btn-success");
     	$this.button('loading');


         $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo $path_url; ?>Principal_controller/saveInvantageUser",

            data:dataString,

            beforeSend: function(x)
            {

                if(x && x.overrideMimeType)
                {

                    x.overrideMimeType("application/json;charset=UTF-8");

                }

            },

            cache: false,

            async:   false,

            timeout: 30000,

            // Tell YQL what we want and that we want JSON

            // Work with the response

            error: studentResponseFailure,

            success: loadStudentResponse

        });




         return false;


    });





    $('div.setup-panel div a.btn-primary').trigger('click');

		function studentResponseFailure()

		{

			$(".user-message").show();
				var $this = $(".btn-success");
     	$this.button('reset');
	    	$(".message-text").text("Student data not saved").fadeOut(10000);

		}



        function loadStudentResponse(response)

        {
        	
        	if(response.message == true && $("#upload_img").val() != ''){
        		saveprofileUpload(response.lastid)
			}
			else if(response.message == true){
			    var $this = $(".btn-success");
     			$this.button('reset');
				window.location.href = "<?php echo $path_url;?>show_std_list";
			}
			else{
				var $this = $(".btn-success");
     			$this.button('reset');
	    	    $(".message-text").text("Failed to save student").fadeOut(10000);
			}

        }


                 /*

	     * ---------------------------------------------------------

	     *   Save profile image

	     * ---------------------------------------------------------

	     */

	     function saveprofileUpload(userId)

	     {



	     	var files = $('input[type="file"]').get(0).files;

     	 	var size, ext ;

            file = files[0];

            size = file.size;

            ext = file.name.toLowerCase().trim();

            ext = ext.substring(ext.lastIndexOf('.') + 1);

            ext = ext.toLowerCase();

            var validExt = ["png","jpg","bmp","gif","jpeg"];

           	if($.inArray(ext,validExt) == -1){

                message("Please must upload text file","show");

                return false;

            }

            else{

                message("","hide");

            }



            if(size > 5000000 ){

            	alert("File must be less than 5MB")

                return false;

            }

            var data = new FormData();

            data.append('<?php echo $this->security->get_csrf_token_name(); ?>','<?php echo $this->security->get_csrf_hash(); ?>');

            var i =0;

            $.each($("#upload_img")[0].files,function(key,value){

                data.append("export",value);

            });

            data.append('userId',userId)

            $.ajax({

                url: '<?php echo $path_url;?>Principal_controller/uploadStudentProfile?files',

                type: 'POST',

                data: data,

                cache: false,

                dataType: 'json',

                mimeType:"multipart/form-data",

                processData: false, // Don't process the files

                contentType: false, // Set content type to false as jQuery will tell the server its a query string request

                success: function(data) {

                	if(data.message == true)

                	{
            			var $this = $(".btn-success");
     					$this.button('reset');
                		window.location.href = "<?php echo $path_url;?>show_std_list";

                	}

                },
                error:function(error)
                {
            		var $this = $(".btn-success");
     				$this.button('reset');
                }

            });

            return false;

	     }




	 function takeimagefromwebcam()
	{
       	$.ajax({
            url: '<?php echo $path_url;?>getImgId',
            type: 'GET',
            data: ({}),
            cache: false,
            dataType: 'json',
            success: function(data) {
            	if(data.lastid != false)
            	{
            		is_take_image_set == true
			 	 	$path = "<?php echo base_url(); ?>upload/profile/"+data.lastid;
			 	 	$("#imagesize img").attr('src',$path)
			 	 	$("#imagesize").show()
			 	 	$("#edit_thumbnail").hide()
            	}
            }
        });
	}


$scope.readURL = function(event) {
	var files = event.target.files;
	var file = files[0];
  	if (file) {
    	var reader = new FileReader();
		reader.onload = $scope.imageIsLoaded
    	reader.readAsDataURL(file);
  	} else {
    	$scope.removeUpload();
  	}
}

$scope.imageIsLoaded = function(e){
	$scope.$apply(function() {

	   $('.image-upload-wrap').hide();
	   $("#edit_thumbnail").hide()
	   $('.file-upload-image').prop('src', e.target.result);
	   $('.file-upload-content').show();

	});
}

 $scope.removeUpload = function() {

//  $('.file-upload-input').replaceWith($('.file-upload-input').clone());

  $('.file-upload-content').hide();
  document.getElementById("upload_img").value = "";
  $('.image-upload-wrap').show();

}

$('.image-upload-wrap').bind('dragover', function () {

		$('.image-upload-wrap').addClass('image-dropping');

	});

	$('.image-upload-wrap').bind('dragleave', function () {

		$('.image-upload-wrap').removeClass('image-dropping');

});

	setTimerForWidget('section',1)

	$scope.select_class = $scope.ini;

	function setTimerForWidget(crname,ctime)

    {



       $scope.ptime = 0;

      reporttimer = $interval(function(){

        if($scope.ptime < parseInt(ctime))

        {

          $scope.ptime++

        }

        else{

          if(crname == 'section')
          {



          }

          $interval.cancel(reporttimer)

      }

    },300)

      }



       angular.element(function () {

         	getClassList()

         });



        function getClassList()

        {

        	httprequest('<?php echo $path_url;?>getclasslist',({})).then(function(response){

        		if(response != null && response.length > 0)

        		{

        			$scope.classlist = response

        			$scope.select_class = response[0]
        			if($scope.editedclass != '')
        			{
        				for (var i = 0; i < response.length; i++) {
        					if(response[i].id == $scope.editedclass){
        						$scope.select_class = response[i]
        					}
        				}
        			}

        			$scope.loadSections()

        		}

        	});

        }

        function CheckEmail()
		{

	}

		$scope.loadSections= function()

		{

			try{

				var data = ({inputclassid:$scope.select_class.id})

				httprequest('<?php echo $path_url; ?>getsectionbyclass',data).then(function(response){

					if(response.length > 0 && response != null)

					{

						$scope.inputSection = response[0];

						$scope.sectionslist = response;
						if($scope.editedsection != '')
						{
							for (var i = 0; i < response.length; i++) {
								if(response[i].id == $scope.editedsection)
								{
									$scope.inputSection = response[i];
								}
							}
						}
						getSemesterData()

					}

					else{

						$scope.sectionslist = [];

					}

				})

			}

			catch(ex){}

		}



		function getSemesterData(){

			try{



				httprequest('<?php echo $path_url; ?>getsemesterdata',({})).then(function(response){

					if(response.length > 0 && response != null)

					{



						$scope.semesterlist = response;

						$scope.inputSemester = response[0];

						if($scope.editedsemester != '')
						{
							for (var i = 0; i < response.length; i++) {
								if(response[i].id == $scope.editedsemester)
								{
									$scope.inputSemester = response[i];
								}
							}
						}


					}

					else{

						$scope.semesterlist = [];

					}

				})

			}

			catch(ex){}

		}

			$scope.fieldValues = {
		dateOfBirth: ""
	};

	/*Date Of Birth*/
	
	$scope.days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
	$scope.months = [{id: 1, name:"January"},
					 {id: 2, name:"February"},
					 {id: 3, name:"March"},
					 {id: 4, name:"April"},
					 {id: 5, name:"May"},
					 {id: 6, name:"June"},
					 {id: 7, name:"July"},
					 {id: 8, name:"August"},
					 {id: 9, name:"September"},
					 {id: 10, name:"October"},
					 {id: 11, name:"November"},
					 {id: 12, name:"December"}
					];
	$scope.years = [];
	var d = new Date();
	for (var i = (d.getFullYear() - 18); i > (d.getFullYear() - 100); i--) {
		$scope.years.push(i);
	}
	
	$scope.year = "";
	$scope.month = "";
	$scope.day = "";
	
	$scope.updateDate = function (input){	
		if (input == "year"){
			$scope.month = "";
			$scope.day = "";
		}
		else if (input == "month"){
			$scope.day = "";
		}
		if ($scope.year && $scope.month && $scope.day){
			$scope.fieldValues.dateOfBirth = new Date($scope.year, $scope.month.id - 1, $scope.day);
		}
	};
		

		function httprequest(url,data)

      {

        var request = $http({

          method:'GET',

          url:url,

          params:data,

          headers : {'Accept' : 'application/json'}

        });

        return (request.then(responseSuccess,responseFail))

      }





      function responseSuccess(response){

        return (response.data);

      }



      function responseFail(response){

        return (response.data);

      }

	});



</script>
