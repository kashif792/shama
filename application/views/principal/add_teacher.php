<?php



// require_header



require APPPATH.'views/__layout/header.php';







// require_top_navigation



require APPPATH.'views/__layout/topbar.php';







// require_left_navigation



require APPPATH.'views/__layout/leftnavigation.php';



?>







<div class="col-sm-10" ng-controller="teacher">



	<?php



		// require_footer



		require APPPATH.'views/__layout/filterlayout.php';



	?>



	<div class="panel panel-default">

		<div class="panel-heading">

			<label>Teacher</label>

		</div>

		<div class="panel-body">

      		<?php $attributes = array('name' => 'teacherForm', 'id' => 'teacherForm','class'=>'form-horizontal'); echo form_open_multipart('', $attributes);?>

               	<input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="serial" id="serial">

				

				<div class="form-group">

					<div class="col-sm-6">

						<label class="control-label" for="inputFirstName">First name<span class="required">*</span></label>

  						<input type="text" id="inputFirstName" required name="inputFirstName" pattern="[a-zA-Z\s]{3,40}" title="Username should only contain lowercase or uppercase letters. e.g. john" placeholder="First Name"  tabindex="1" value="" ng-model="inputFirstName" class="form-control">

						<span class="errorhide" id="fname_error">Please enter first name</span>

					</div>

					<div class="col-sm-6">

						<label for="inputLastName">Last name<span class="required">*</span></label>

  						<input type="text" id="inputLastName" pattern="[a-zA-Z\s]{3,40}" title="Last name should only contain lowercase or uppercase letters and minimum length 3. e.g. john" placeholder="Last Name" required name="inputLastName" placeholder="Last Name"  tabindex="1" value="" ng-model="inputLastName" class="form-control">

						<span class="errorhide" id="lname_error">Please enter last name</span>

					</div>

				</div>

				<div class="form-group">

					<div class="col-sm-6">

						<label class="" for="input_t_gender">Gender</label>

  						<select  ng-options="item.title for item in genderlist track by item.id" class="form-control"  name="input_t_gender" id="input_t_gender"  ng-model="input_t_gender" ></select>

					</div>

					<div class="col-sm-6">

						<label class="" for="inputTeacher_Nic">CNIC<span class="required">*</span></label>

  						<input type="text" tabindex="3" required id="inputTeacher_Nic" title="xxxxx-xxxxxxx-x" name="inputTeacher_Nic" placeholder="xxxxx-xxxxxxx-x"   ng-blur="checkDublication()" value="" ng-model="inputTeacher_Nic" class="form-control">

						<span class="errorhide" id="teacher_nic">Please Enter correct CNIC number</span>

					</div>

				</div>

				<div class="form-group">

					<div class="col-sm-6">

						<label class="" for="input_teacher_email">Email<span class="required">*</span></label>

  						<input tabindex="5" type="email" id="input_teacher_email" name="input_teacher_email" ng-blur="checkEmailDupilcation()" placeholder="Please enter Email" value="<?php if(isset($teacher_single)){echo $teacher_single[0]->email;}?>" class="form-control">

						<span class="errorhide" id="teacher_email">Please enter correct email address </span>

					</div>

					<div class="col-sm-6">

						<label class="" for="input_pr_phone">Phone<span class="required">*</span></label>

  						<input tabindex="6" type="text"  id="input_pr_phone" name="input_pr_phone" placeholder="xxxx-xxxxxxx" value="" ng-model="input_pr_phone" class="form-control">

						<span id="valid-msg" class="hide">✓ Valid</span>

						<span id="error-msg" class="hide">Invalid number</span>

						 <span class="errorhide" id="teacher_phone">Format 0833-1234567-8888 | (0833)1234567-8888 | 12345678</span>

					</div>

				</div>	

				<div class="form-group hide">

					

					<div class="col-sm-6">

						<label class="" for="inputLocation">School<span class="required">*</span></label>

  						<select  ng-options="item.sname for item in selectlistcity track by item.sid" class="form-control"  name="inputLocation" id="inputLocation"  ng-model="inputLocation" ></select>

					</div>

				</div>	

				

				<?php if(!$this->uri->segment(2)){ ?>

				<div class="form-group">

					<div class="col-sm-6">

						<label class="" for="inputNewPassword">Password <span class="required">*</span></label>

  						<input type="password" id="inputNewPassword" name="inputNewPassword" placeholder="New Password"  tabindex="7" class="form-control"> 

  						<span class="errorhide" id="teacher_passowrd">Please enter your password </span>

					</div>

					<div class="col-sm-6">

						<label class="" for="inputRetypeNewPassword">Retype Password: <span class="required">*</span></label>

  						<input type="password" id="inputRetypeNewPassword" name="inputRetypeNewPassword" placeholder="Retype New Password"  tabindex="7" class="form-control"> 

  						<span class="errorhide" id="teacher_re_passowrd">Please re-type the same password </span>

					</div>

					<span class="form-inner-message" id="confimr_passowrd">Please enter the same password</span>

				</div>

				<?php } ?>

				<div class="form-group">

					<div class="col-sm-6">

						<label class="" for="pr_home">Home Address (Primary)</label>

  						<input type="text" tabindex="8" id="pr_home" name="pr_home" placeholder="Primary Home Address" value="" ng-model="pr_home" class="form-control">

					</div>

					<div class="col-sm-6">

						<label class="" for="sc_home">Home Address (Secondary)</label>

  						<input type="text" tabindex="8" id="sc_home" name="sc_home" placeholder="Secondary Home Address" value="" ng-model="sc_home" class="form-control">

					</div>

				</div>

				<div class="form-group">

					<div class="col-sm-6">

						<label class="" for="inputProvice">State</label>

						<select  ng-options="item.title for item in provincelist track by item.id"  name="inputProvice" id="inputProvice"  ng-model="inputProvice" class="form-control" ></select>

					</div>

					<div class="col-sm-3">

						<label class="" for="input_city">City</label>

						<input type="text" tabindex="8" id="input_city" name="input_city" placeholder="City"  value="" ng-model="input_city" class="form-control">

					</div>

					<div class="col-sm-3">

						<label class="" for="sc_home">Zip code</label>

        				<input tabindex="8" id="input_zipcode" name="input_zipcode" type="text" placeholder="Zip code" value="" ng-model="input_zipcode" class="form-control">

					</div>

				</div>

				<div class="form-group">

					<div class="col-sm-12">

						<label class="" for="inputProvice"><input type="checkbox"  ng-true-value="true" name="inputMasterteacher" id="inputMasterteacher" ng-model="inputMasterteacher">Master Teacher</label>

					</div>

				</div>

				<div class="form-group">

					<div class="col-sm-12">

						<div class="file-upload">

					  		<div class="image-upload-wrap" id="image_upoad_wrap">

					    		<input tabindex="8" class="file-upload-input" type='file' onchange="angular.element(this).scope().readURL(event);" id="upload_img" name="upload_img" accept="image/*" />

					    		<div class="drag-text">

					      			<h3>Drag and drop an image or select add Image</h3>

					         	</div>

					  		</div>

						  	<div class="file-upload-content" id="file_upoad_content">

							    <img class="file-upload-image" src="#" alt="your image" />  

							    <div class="image-title-wrap">

						      		<button  type="button" ng-click="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>

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

								<input id="print" class="file-upload-btn btn btn-primary" style="display:none;" type="button" name="print" value="Capture Screenshot" ng-click="popup();"/>

							</div>

						</div>

						<div class="row">

    		 				<div class="col-sm-4" id="imagesize">

    		 					<img class="img-rounded" src='<?php if(isset($teacher_single)){ echo $teacher_single[0]->profile_image;} ?>' width="250px" height="">

		 					</div>

    		 			</div>

    		 			<?php if(!empty($teacher_single[0]->profile_image)){ ?>

    		 			<div class="row">

    		 				<div class="col-sm-4" id="edit_thumbnail">

    		 					<img class="img-rounded thumbnail" src='<?php if(isset($teacher_single)){ echo $teacher_single[0]->profile_image;} ?>' width="250px" height="">

		 					</div>

    		 			</div>

    		 			<?php } ?>

					</div>

				</div>

				<div class="form-group">

					<div class="col-sm-12">

						<button id="save_teacher" type="button" tabindex="8" ng-click="saveTeacher()" class="btn btn-primary save-teacher" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>

            			<a  href="<?php echo $path_url; ?>show_teacher_list"  title="cancel">Cancel</a>

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



    document.getElementById("input_pr_phone").onkeypress = validate_int;

    document.getElementById("input_pr_phone").onkeyup = phone_number_mask;



    document.getElementById("inputTeacher_Nic").onkeypress = validate_int;

    document.getElementById("inputTeacher_Nic").onkeyup = nic_number_mask;

    function phone_number_mask() {



  		var myMask = "____-_______";

      	var myCaja = document.getElementById("input_pr_phone");

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

      	document.getElementById("input_pr_phone").value = myOutPut;

      	document.getElementById("input_pr_phone").setSelectionRange(theLastPos, theLastPos);

    }



    function nic_number_mask() {

    	try{

       		var myMask = "_____-_______-_";

      		var myCaja = document.getElementById("inputTeacher_Nic");

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

      		document.getElementById("inputTeacher_Nic").value = myOutPut;

      		document.getElementById("inputTeacher_Nic").setSelectionRange(theLastPos, theLastPos);

  		}

  		catch( e)

  		{

  			console.log(e)

  		}

   	}



 	var app = angular.module('invantage', []);

	

	app.controller('teacher', function($scope, $http, $interval,$compile,$filter) {



					$scope.pr_home ="";

					   $scope.sc_home ="";

					   $scope.input_city ="";

					   $scope.input_zipcode ="";



		$scope.genderlist = [

			{

				id:1,

				title:'Male',

			},

			{

				id:2,

				title:'Female',

			}

		]

		$scope.input_t_gender = $scope.genderlist[0]


$scope.ho


		$scope.provincelist = [

			{

				id:'Azad Kashmir',

				title:'Azad Kashmir',

			},

			{

				id:'Balochistan',

				title:'Balochistan',

			},

			{

				id:'Federally Administered Tribal Areas',

				title:'Federally Administered Tribal Areas',

			},

			{

				id:'Islamabad Capital Territory',

				title:'Islamabad Capital Territory',

			},

			{

				id:'Khyber Pakhtunkhwa',

				title:'Khyber Pakhtunkhwa',

			},

			{

				id:'Northern Areas',

				title:'Northern Areas',

			},

			{

				id:'Punjab',

				title:'Punjab',

			},

			{

				id:'Sindh',

				title:'Sindh',

			},

		]

		$scope.inputProvice = $scope.provincelist[0];



		$scope.serial = '';

		$scope.is_edit = "<?php echo $this->uri->segment('2'); ?>";

		$scope.editarray = [];



		angular.element(function () {

			

			if($scope.is_edit == '')

			{

				getSchoolList()

			}



			if($scope.is_edit != '')

			{

				$scope.serial = $scope.is_edit;

				getUserInfo();

			}

		 });



		 $scope.selectlistcity = [];

		function getSchoolList()

        {

         	try{

                var data = ({tschool:'tschool'})

                httprequest('<?php echo base_url(); ?>getschoollist',data).then(function(response){

                    if(response.length > 0 && response != null)

                    {

                        $scope.selectlistcity = response;

                        $scope.inputLocation = response[0];



                        if($scope.is_edit != '')

                        {

                        	var found = $filter('filter')($scope.selectlistcity,{id:$scope.editarray.location},true);

                        	if(found.length)

                        	{

                        		$scope.inputLocation = found[0];

                        	}

                        }

                    }

                    else{

                        $scope.selectlistcity = []

                    }

                })

            }

            catch(ex){}

        }



		function getUserInfo() {

			try{

			   var data = ({userinfo:$scope.is_edit})

			   httprequest('<?php echo base_url(); ?>userinfo',data).then(function(response){

				   if(response != null)

				   {

				   	   $scope.editarray = response;

				   	   getSchoolList();

					   $scope.inputFirstName = response.teacher_firstname;

					   $scope.inputLastName = response.teacher_lastname;



					   $scope.input_t_gender = $scope.genderlist[parseInt(response.gender) - 1]

					   $scope.inputTeacher_Nic = response.nic;



                    	var found = $filter('filter')($scope.provincelist,{id:response.province},true);

                    	if(found.length)

                    	{

                    		$scope.inputProvice = found[0];

                    	}



					   $scope.input_teacher_email = response.email;

					   $scope.input_pr_phone = response.teacher_phone;

					   $scope.pr_home = response.teacher_primary_address;

					   $scope.sc_home = response.secondary_address;

					   $scope.input_city = response.teacher_city;

					   $scope.input_zipcode = response.teacher_zipcode;

					   $scope.inputMasterteacher = (response.masterteaher == 1 ? true :false);

				   }

				   else{



				   }

			   })

		   }

		   catch(ex){}

		}



	$scope.is_nonvalid_teacher = false;







	// $("#input_pr_phone").intlTelInput({

	//   	initialCountry: "Pk",

	// });

    	

 //    	var telInput = $("#input_pr_phone"),

	// 	  	errorMsg = $("#error-msg"),

	// 	  	validMsg = $("#valid-msg");



	// 		// initialise plugin

	// 		telInput.intlTelInput({

	// 	  		utilsScript: "<?php echo base_url(); ?>js/utils.js"

	// 		});



	// 	var reset = function() {

	//   		telInput.removeClass("error");

	// 	  	errorMsg.addClass("hide");

 // 	 		validMsg.addClass("hide");

	// 	};



	// // on blur: validate

	// telInput.blur(function() {

 //  		reset();

	//   	if ($.trim(telInput.val())) {

	//     	if (telInput.intlTelInput("isValidNumber")) {

	//       		//validMsg.removeClass("hide");

	//       		document.getElementById('save_teacher').disabled = false;

	//     	} else {

	//       		telInput.addClass("error");

	//       		errorMsg.removeClass("hide");

	//       		document.getElementById('save_teacher').disabled = true;

	//     	}

	//   	}

	// });



	// 	// on keyup / change flag: reset

	// 	telInput.on("keyup change", reset);



	$scope.checkEmailDupilcation = function()

	{

		var eregix=new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/);

		var input_teacher_email = $("#input_teacher_email").val();

		

		if( eregix.test(input_teacher_email))

		{

			var data = ({

							inputEmail:input_teacher_email,

							inputserial:"<?php echo $this->uri->segment('2'); ?>"

						});

			httprequest('<?php echo $path_url; ?>CheckUserEmail',data).then(function(response)

			{

				if(response.message == true)

				{

					$scope.is_nonvalid_teacher = true;

					$("#teacher_email").html('Try different email').show()

					jQuery("#input_teacher_email").addClass('errorshow');

					document.getElementById('save_teacher').disabled = true;

					$("#teacher_email").re();

				}

				else{

					$scope.is_nonvalid_teacher = false;

					$("#teacher_email").hide();

					jQuery("#input_teacher_email").removeClass('errorshow');

				}





			 	if(response.message == false)

			 	{

			 		document.getElementById('save_teacher').disabled = false;

			 	}

			});

		}

	}



	$scope.checkDublication = function()

	{

		

		var inputTeacher_Nic = $("#inputTeacher_Nic").val();



		if(inputTeacher_Nic != null)

		{

			if(inputTeacher_Nic.length == 15)

			{

				var data = ({

					inputTeacher_Nic:inputTeacher_Nic,

					inputserial:"<?php echo $this->uri->segment('2'); ?>"

				})



				httprequest('<?php echo $path_url; ?>teachernicduplicationcheck',data).then(function(response)

				{



					if(response.message == true)

					{

						$("#teacher_nic").html('Duplicate CNIC entered').show()

						$scope.is_nonvalid_teacher = true;

						document.getElementById('save_teacher').disabled = true;

						jQuery("#inputTeacher_Nic").addClass('errorshow');

					}

				 	else

				 	{

					 	$scope.is_nonvalid_teacher = false;

						$("#teacher_nic").html('').hide();

						

						jQuery("#inputTeacher_Nic").removeClass('errorshow');

						

				 	}



				 	if(response.nic == false)

				 	{

				 		document.getElementById('save_teacher').disabled = false;

				 	}

				});

			}

		}

	}





	$scope.openwebcam = function()

	{

		// Grab elements, create settings, etc.

		var video = document.getElementById('video');

		$scope.is_permission_enabled = false;

		if($scope.is_permission_enabled == false)

		{

			// Get access to the camera!

			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {

				// Not adding `{ audio: true }` since we only want video now

				navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {

					video.src = window.URL.createObjectURL(stream);

					video.play();

				});

			}

		}

		else{



			video.play();

		}





		$("#video").show()

		$("#print").show()

		$("#take_pic_btn").hide()

	}





    /*

     * ---------------------------------------------------------

     *   Save Teacher

     * ---------------------------------------------------------

     */

    	$scope.saveTeacher = function()

        {



            var inputFirstName = $("#inputFirstName").val().trim();

            var inputLastName = $("#inputLastName").val().trim();

            var input_teacher_email = $("#input_teacher_email").val().trim();

            var inputTeacher_Nic=$("#inputTeacher_Nic").val();

            var input_pr_phone=$("#input_pr_phone").val();

         	var inputNewPassword = $("#inputNewPassword").val();

            var inputRetypeNewPassword = $("#inputRetypeNewPassword").val();

          



            var reg = new RegExp(/^[A-Za-z]{3,50}$/);

            myRegExp = new RegExp(/\d{5}-\d{7}-\d{1}$/);

           	var eregix=new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/);

           	var mobile=new RegExp(/^[0-9]{4}-[0-9]{7}$/);

           	var nic=new RegExp(/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/);



           	if(reg.test(inputFirstName)==false){



            	jQuery("#inputFirstName").addClass('errorshow');

            	jQuery("#fname_error").show();

            	isValid = false;

            	return false;

        	}

	        else{

	            isValid = true;

             	jQuery("#fname_error").hide();

	            jQuery("#inputFirstName").removeClass('errorshow')

	        }



	        if(reg.test(inputLastName)==false){



            	jQuery("#inputLastName").addClass('errorshow');

            	jQuery("#lname_error").show();

            	isValid = false;

            	return false;

        	}

	        else{

	            isValid = true;

             	jQuery("#lname_error").hide();

	            jQuery("#inputLastName").removeClass('errorshow')

	        }



	        var reg = new RegExp(/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/);



         	if(nic.test(inputTeacher_Nic)==false){



            	jQuery("#inputTeacher_Nic").addClass('errorshow');

            	$("#teacher_nic").html('Please enter correct CNIC number').show();

            	isValid = false;

            	return false;

        	}

	        else{

	            isValid = true;

	            $("#teacher_nic").html('').hide();

	            jQuery("#inputTeacher_Nic").removeClass('errorshow')

	        }



	      

	        if(eregix.test(input_teacher_email)==false){



            	jQuery("#input_teacher_email").addClass('errorshow');

            	$("#teacher_email").html('Please enter correct email address').show()

            	isValid = false;

            	return false;

        	}

	        else{

	            isValid = true;

	             $("#teacher_email").html('').hide()

	            jQuery("#input_teacher_email").removeClass('errorshow')

	        }



	         if(mobile.test(input_pr_phone)==false){



            	jQuery("#input_pr_phone").addClass('errorshow');

            	$("#teacher_phone").html('Please enter correct phone number').show()

            	isValid = false;

            	return false;

        	}

	        else{

	            isValid = true;

	             $("#teacher_phone").html('').hide()

	            jQuery("#input_pr_phone").removeClass('errorshow')

	        }





			var inputEmail=$("#input_teacher_email").val();

			var NIC=$("#inputTeacher_Nic").val();

			





	    

          

            

            var reg = new RegExp(/^[A-Za-z0-9]{3,50}$/);



            if(reg.test(inputNewPassword) == false){



                jQuery("#inputNewPassword").addClass('errorshow');

                $("#teacher_passowrd").show()

                return false;

            }

            else{

                jQuery("#inputNewPassword").removeClass('errorshow');

                $("#teacher_passowrd").hide()

            }



            if(reg.test(inputRetypeNewPassword) == false){

                jQuery("#inputRetypeNewPassword").addClass('errorshow');

                $("#teacher_re_passowrd").show()

                return false;

            }

            else{

                jQuery("#inputRetypeNewPassword").removeClass('errorshow');

                 $("#teacher_re_passowrd").hide()

            }





            if(inputRetypeNewPassword != inputNewPassword ){

                jQuery("#inputRetypeNewPassword").addClass('errorshow');

                jQuery("#inputNewPassword").addClass('errorshow');

                $("#confimr_passowrd").show()

                return false;

            }

            else{

                jQuery("#inputRetypeNewPassword").removeClass('errorshow');

                jQuery("#inputNewPassword").removeClass('errorshow');

                  $("#confimr_passowrd").hide()

            }



			var input_teacher_email = $("#input_teacher_email").val().trim();

			var inputTeacher_Nic = $("#inputTeacher_Nic").val().trim();



		

			if($scope.is_nonvalid_teacher == false)

			{

				var formdata = new FormData();

				formdata.append('serial',$("#serial").val());

				formdata.append('inputFirstName',inputFirstName);

				formdata.append('inputLastName',inputLastName);

				formdata.append('input_t_gender',$scope.input_t_gender.id);

				formdata.append('inputTeacher_Nic',NIC);

				

				formdata.append('input_teacher_email',input_teacher_email);

				formdata.append('input_pr_phone',input_pr_phone);

				if(inputNewPassword && inputRetypeNewPassword)

				{

					formdata.append('inputNewPassword',$("#inputNewPassword").val());

					formdata.append('inputRetypeNewPassword',$("#inputRetypeNewPassword").val());

				}

				

				formdata.append('pr_home',$scope.pr_home);

				formdata.append('sc_home',$scope.sc_home);

				formdata.append('inputProvice',$scope.inputProvice.id);

				formdata.append('input_city',$scope.input_city);

				formdata.append('input_zipcode',$scope.input_zipcode);

				formdata.append('inputLocation',$scope.inputLocation.sid);

				formdata.append('inputMasterteacher',($scope.inputMasterteacher == true ? 1 : 0));



				var $this = $(".save-teacher");

				$this.button('loading');



				var request = {

					method: 'POST',

					url: "<?php echo $path_url; ?>saveTeacher",

					data: formdata,

					headers: {'Content-Type': undefined}

				};



				$http(request)

					.success(function (response) {

						var is_img_uploaded = $("#upload_img").val();

						if(response.message == true && is_img_uploaded != ''){

							saveprofileUpload(response.lastid)

						}

						if(response.message == true && is_img_uploaded == ''){

							window.location.href = "<?php echo $path_url;?>show_teacher_list";

				   			var $this = $(".save-teacher");

				   			$this.button('reset');

						}else{

							var $this = $(".save-teacher");

							$this.button('reset');

							message('Teacher not saved','show')

						}

					})

					.error(function(){

						var $this = $(".save-teacher");

						$this.button('reset');

						message('Teacher not saved','show')

					});

				}else{

					var $this = $(".save-teacher");

					$this.button('reset');

				}

			







	  			return false;

		};





     	/*

	     * ---------------------------------------------------------

	     *   Save profile image

	     * ---------------------------------------------------------

	     */





	     function saveprofileUpload(teacherId)



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



            data.append('teacherId',teacherId)



            $.ajax({



                url: '<?php echo $path_url;?>Principal_controller/uploadTeacherimg?files',



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

						var $this = $(".save-teacher");

						$this.button('reset');

                		window.location.href = "<?php echo $path_url;?>show_teacher_list";



                	}



                }



            });



            return false;



     	}





	var is_take_image_mode_set = false;

	var is_take_image_set = false ;



	var context = canvas.getContext('2d');



	$scope.popup = function(){

		is_take_image_set == false

		is_take_image_mode_set = true;



		context.drawImage(video, 0, 0, 640, 480);

		var image = new Image();

		image.src = canvas.toDataURL("image/png");

		$('.file-upload-image').attr('src', image.src);

		//var fileinput = angular.element($('#upload_img')).triggerHandler('input');

		$("#video").hide()

		$("#print").hide()

		$("#take_pic_btn").show()

		$('#file_upoad_content').show();

		$('#image_upoad_wrap').hide();



		$("#edit_thumbnail").hide()



		//window.open("<?php //echo $path_url; ?>take_pic", "_blank", "toolbar=no, scrollbars=no, resizable=no, top=80, left=400, width=600, height=500px");

	}



 //  	setInterval(function(){

    // 	if(is_take_image_mode_set == true && is_take_image_set == false)

    //     {

    // 		takeimagefromwebcam()

    //     }

    // },3000)



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



	  	function httpostrequest(url,data)

	  		{

		  		var request = $http({

		  			method:'POST',

				  	url:url,

				  	data:data,

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

