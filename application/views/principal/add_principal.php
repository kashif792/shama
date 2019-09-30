<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>

<div class="col-sm-10" ng-controller="principal_ctrl">
	<?php
		// require_footer
		require APPPATH.'views/__layout/filterlayout.php';
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<label>Principal</label>
		</div>
		<div class="panel-body">
			<div class="form-container">
          		<?php $attributes = array('name' => 'teacherForm', 'id' => 'teacherForm','class'=>'form-horizontal'); echo form_open_multipart('', $attributes);?>
	               	<input type="hidden" value="" name="serial" id="serial" ng-model="serial">
					<div class="form-group">
						<div class="col-sm-6">
							<label>First name: <span class="required">*</span></label>
							<input type="text" id="inputFirstName" class="form-control" name="inputFirstName" ng-model="inputFirstName" placeholder="First Name"  tabindex="1" value="">						
							<span class="errorhide" id="fname_error"> Please enter first name</span>
						</div>
						<div class="col-sm-6">
							<label>Last name: <span class="required">*</span></label>
							<input type="text" id="inputLastName" class="form-control" name="inputLastName"  ng-model="inputLastName" placeholder="Last Name"  tabindex="1" value="">						
							<span class="errorhide" id="lname_error">Please enter last name</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Gender:</label>
							<select tabindex="2"  ng-options="item.title for item in genderlist track by item.id" class="form-control"  name="input_t_gender" id="input_t_gender"  ng-model="input_t_gender" ></select>
						</div>
						<div class="col-sm-6">
							<label>CNIC: <span class="required">*</span></label>
							<input type="text" class="form-control" tabindex="3" id="inputTeacher_Nic" ng-model="inputTeacher_Nic" name="inputTeacher_Nic" ng-blur="checkDublication()" placeholder="xxxxx-xxxxxxx-x" value="">
							<span class="errorhide" id="teacher_nic">Please enter CNIC #</span>
						</div>
					</div>
					<div class="form-group">
<!-- 						<div class="col-sm-6">
							<label>Religion: </label>
							<select  ng-options="item.title for item in religionlist track by item.id" class="form-control"  name="inputReligion" id="inputReligion"  ng-model="inputReligion" ></select>
						</div> -->
						<div class="col-sm-12">
							<label>Email: <span class="required">*</span></label>
							<input class="form-control" tabindex="5" type="text" ng-blur="checkEmailDupilcation()" id="input_teacher_email" ng-model="input_teacher_email" name="input_teacher_email" placeholder="Please enter Email" value="">
							<span class="errorhide" id="teacher_email">Please enter your email address in this format admin@domain.com </span>
						</div>
					</div>
					<?php if(!$this->uri->segment(2)){ ?>
                	<div class="form-group">
                		<div class="col-sm-6">
							<label>Password: <span class="required">*</span></label>
							<input class="form-control" type="password" id="inputNewPassword" name="inputNewPassword" ng-model="inputNewPassword" placeholder="New Password"  tabindex="6" >
							<span class="errorhide" id="teacher_passowrd">Please enter your password </span>
						</div>
						<div class="col-sm-6">
							<label>Retype Password: <span class="required">*</span></label>
							<input class="form-control" type="password" id="inputRetypeNewPassword" ng-model="inputRetypeNewPassword" name="inputRetypeNewPassword" placeholder="Retype New Password"  tabindex="7" >
							<span class="errorhide" id="teacher_re_passowrd">Please re-type the same password </span>
						</div>
                		<span class="form-inner-message" id="confimr_passowrd">Please enter the same password</span>
                	</div>
                	<?php } ?>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Phone:<span class="required">*</span> </label>
							<input tabindex="8" class="form-control" type="tel" id="input_pr_phone" ng-model="input_pr_phone" name="input_pr_phone" placeholder="xxxx-xxxxxxx" value="">
							 <span class="errorhide" id="teacher_phone">Format xxxx-xxxxxxx</span>
						</div>
						<div class="col-sm-6">
							<label>School: <span class="required">*</span></label>
							<select class="form-control" tabindex="9"  ng-options="item.sname for item in selectlistcity track by item.sid"  name="inputLocation" id="inputLocation"  ng-model="inputLocation" ></select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Home Address(Primary): <span class="required">*</span></label>
							<input class="form-control" type="text" tabindex="10" id="pr_home" name="pr_home" ng-model="pr_home" placeholder="Primary Home Address" value="">
							<span class="errorhide" id="address_error">Please enter your home address</span>
						</div>
						<div class="col-sm-6">
							<label>Home Address(Secondary): </label>
							<input class="form-control" type="text" tabindex="11" id="sc_home" name="sc_home" ng-model="sc_home" placeholder="Secondary Home Address" value="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label>Province: </label>
							<select  ng-options="item.title for item in provincelist track by item.id" tabindex="12"  name="inputProvice" id="inputProvice"  ng-model="inputProvice" class="form-control" ></select>
						</div>
						<div class="col-sm-4">
							<label>City: <span class="required">*</span></label>
							<input class="form-control" type="text" tabindex="13" id="input_city" ng-model="input_city" name="input_city" placeholder="Secondary Home Address" value="">
							<span class="errorhide" id="city_error">Please enter your city</span>
						</div>
						<div class="col-sm-2">
							<label>Zip code: <span class="required">*</span></label>
							<input class="form-control" tabindex="14" id="input_zipcode" ng-model="input_zipcode" name="input_zipcode" type="text" placeholder="Zip code" value="">
							<span class="errorhide" id="zipcode_error">Please enter your  zip code</span>
						</div>
					</div>
                	<div class="form-group">
                		<div class="col-sm-12">
                			<div class="file-upload">
						  		<div class="image-upload-wrap">
							    	<input tabindex="15" class="file-upload-input" type='file' onchange="angular.element(this).scope().readURL(event);" id="upload_img" name="upload_img" accept="image/*" />
							    	<div class="drag-text">
								      	<h3>Drag and drop an image or select add Image</h3>
							         </div>
						  		</div>
							  	<div class="file-upload-content">
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
        		 				<div class="col-sm-6" id="imagesize">
        		 					<img class="img-rounded" src='' width="250">
        		 					<a href="#" id="remove" data-image="" ng-click="showRemoveDialoag()">Remove</a>
        		 				</div>
        		 			</div>
            		 		
                		</div>
        		 	</div>
                	<div class="form-group">
                		<div class="col-sm-12">
                			<button type="button" id="save_principal" tabindex="8" class="btn btn-primary save-button" ng-click="savePricpal()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
                			<a  href="<?php echo $path_url; ?>show_prinicpal_list"  title="cancel">Cancel</a>
                		</div>
                	</div>
	            <?php echo form_close();?>
			</div>
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
	app.controller('principal_ctrl',function($scope,$http,$compile,$filter)
	{

		$scope.genderlist = [
			{
				id:1,
				title:'Male',
			},
			{
				id:2,
				title:'Female',
			}
		];
		$scope.input_t_gender = $scope.genderlist[0];

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
		];
		$scope.inputProvice = $scope.provincelist[0];
		$scope.serial = '';
		$scope.is_edit = "<?php echo $this->uri->segment('2'); ?>";
		angular.element(function () {
			getSchoolList();
			if($scope.is_edit != null && $scope.is_edit != '')
			{
				$scope.serial = $scope.is_edit;
				getUserInfo();
			}
	 	});

	 	$scope.editarray = [];
		$scope.is_image_edit = false;
		function getUserInfo() {
			try{
			   var data = ({principal:$scope.is_edit})
			   httprequest('<?php echo base_url(); ?>getprincipal',data).then(function(response){
				   if(response != null)
				   {
				   	
				   		$scope.editarray = response;	
					   $scope.inputFirstName = response.firstname;
					   $scope.inputLastName = response.lastname;

					  
					   $scope.inputTeacher_Nic = response.nic;

					   $scope.input_teacher_email = response.email;
					   $scope.input_pr_phone = response.phone;
					   $scope.pr_home = response.primary_home_address;
					   $scope.sc_home = response.primary_secondary_address;
					   $scope.input_city = response.city;
					   $scope.input_zipcode = response.zipcode;
					   if(response.image != '')
					   {
					   	$(".img-rounded").prop('src',response.image);
					   	$("#imagesize").show()
					   }
					   
             
					   var found = $filter('filter')($scope.genderlist,{id:parseInt(response.gender)},true);
					   
					   if(found.length)
					   {
					   		$scope.input_t_gender = found[0]
					   }

				      var found = $filter('filter')($scope.religionlist,{id:response.religion},true);
					   
					   // if(found.length)
					   // {
					   // 		$scope.inputReligion = found[0]
					   // }

				    	var found = $filter('filter')($scope.provincelist,{id:response.state},true);
					  
					   if(found.length)
					   {
					   		$scope.inputProvice = found[0]
					   }

              var found = $filter('filter')($scope.provincelist,{id:response.state},true);
            
             if(found.length)
             {
                $scope.inputProvice = found[0]
             }
                
				   		
				   }
				   else{

				   }
			   })
		   }
		   catch(ex){}
		}

	 	function removeImageConfirmation()
        {
            $.confirm({
                theme: 'material',
                title: 'Confirm!',
                content: 'Are you sure you want to delete this message?',
                buttons: {
                    confirm: function () {
                        removeImage()
                    },
                    cancel: function () {
                    },
                }
            });
        }

        $scope.showRemoveDialoag = function()
        {
            removeImageConfirmation()
        }

        function removeImage()
        {
            if($scope.is_edit != null && $scope.is_edit != '')
            {
            	$scope.is_image_edit = true;
                $('.img-rounded').prop('src',"#");
                $("#imagesize").hide()
            }
           
        }


		/*
         * ---------------------------------------------------------
         *   Save Teacher
         * ---------------------------------------------------------
         */
        
		$scope.savePricpal = function()
		{
			
		  	var reg = new RegExp(/^[A-Za-z0-9\s]{3,50}$/);
            myRegExp = new RegExp(/\d{5}-\d{7}-\d{1}$/);
           	var eregix=new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/);

           	if(reg.test(jQuery("#inputFirstName").val())==false){

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

	        if(reg.test(jQuery("#inputLastName").val())==false){

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


           	var nic=new RegExp(/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/);
         	if(nic.test(jQuery("#inputTeacher_Nic").val())==false){

            	jQuery("#inputTeacher_Nic").addClass('errorshow');
            	$("#teacher_nic").html('Please enter your NIC# in this format xxxxx-xxxxxxx-x').show();
            	isValid = false;
            	return false;
        	}
	        else{
	            isValid = true;
	            $("#teacher_nic").html('').hide();
	            jQuery("#inputTeacher_Nic").removeClass('errorshow')
	        
	           }

	        if(eregix.test(jQuery("#input_teacher_email").val())==false){

            	jQuery("#input_teacher_email").addClass('errorshow');
            	$("#teacher_email").html('Please enter your email in this format admin@domain.com').show()
            	isValid = false;
            	return false;
        	}
	        else{
	            isValid = true;
	             $("#teacher_email").html('').hide()
	            jQuery("#input_teacher_email").removeClass('errorshow')
	        }

            var reg = new RegExp(/^[A-Za-z0-9]{3,50}$/);

            if(reg.test(jQuery("#inputNewPassword").val()) == false){

                jQuery("#inputNewPassword").addClass('errorshow');
                $("#teacher_passowrd").show()
                return false;
            }
            else{
                jQuery("#inputNewPassword").removeClass('errorshow');
                $("#teacher_passowrd").hide()
            }

            if(reg.test(jQuery("#inputRetypeNewPassword").val()) == false){
                jQuery("#inputRetypeNewPassword").addClass('errorshow');
                $("#teacher_re_passowrd").show()
                return false;
            }
            else{
                jQuery("#inputRetypeNewPassword").removeClass('errorshow');
                 $("#teacher_re_passowrd").hide()
            }


            if(jQuery("#inputRetypeNewPassword").val() != jQuery("#inputNewPassword").val() ){
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

            var preg = new RegExp(/^((\(\d{3,4}\)|\d{3,4}-)\d{4,9}(-\d{1,5}|\d{0}))|(\d{4,12})$/);
            var mobile=new RegExp(/^[0-9]{4}-[0-9]{7}$/);
            if(mobile.test(jQuery("#input_pr_phone").val())==false){

            	jQuery("#input_pr_phone").addClass('errorshow');
            	$("#teacher_phone").html('Please enter your phone number in this format xxxx-xxxxxxx').show()
            	isValid = false;
            	return false;
        	}
	        else{
	            isValid = true;
	             $("#teacher_phone").html('').hide()
	            jQuery("#input_pr_phone").removeClass('errorshow')
	        }


           
            if(jQuery("#pr_home").val() == ''){
                jQuery("#pr_home").addClass('errorshow');
        		$("#address_error").show()
                return false;
            }
            else{
                 jQuery("#pr_home").removeClass('errorshow')
        		$("#address_error").hide()                                
            }

            var reg = new RegExp(/^[A-Za-z ]{3,20}$/);
            if(reg.test(jQuery("#input_city").val()) == false){
                jQuery("#input_city").addClass('errorshow');
        		$("#city_error").show()
                return false;
            }
            else{
                 jQuery("#input_city").removeClass('errorshow')
        		$("#city_error").hide()                                
            }
                    
      
            var reg = new RegExp(/^[0-9]{5}(?:-[0-9]{4})?$/);
            if(reg.test(jQuery("#input_zipcode").val()) == false){
                 jQuery("#input_zipcode").addClass('errorshow');
        		$("#zipcode_error").show()
                return false;
            }
            else{
                jQuery("#zipcode_error").removeClass('errorshow')
                $("#zipcode_error").hide()                                 
            }
            

			var $this = $(".save-button");
            $this.button('loading');

           
         	var formdata = new FormData();
			formdata.append('serial',$scope.serial);
			formdata.append('inputFirstName',$scope.inputFirstName);
			formdata.append('inputLastName',$scope.inputLastName);
			formdata.append('input_t_gender',$scope.input_t_gender.id);
			formdata.append('inputTeacher_Nic',$scope.inputTeacher_Nic);
			//formdata.append('inputReligion',$scope.inputReligion.id);
			formdata.append('input_teacher_email',$scope.input_teacher_email);
			formdata.append('input_pr_phone',jQuery("#input_pr_phone").val());
			formdata.append('inputNewPassword',$scope.inputNewPassword);
			formdata.append('inputRetypeNewPassword',$scope.inputRetypeNewPassword);
			formdata.append('pr_home',$scope.pr_home);
			formdata.append('sc_home',$scope.sc_home);
			formdata.append('inputProvice',$scope.inputProvice.id);
			formdata.append('input_city',$scope.input_city);
			formdata.append('input_zipcode',$scope.input_zipcode);
			formdata.append('inputLocation',$scope.inputLocation.sid);
			formdata.append('is_image_edit',$scope.is_image_edit);

			var file = $('input[type="file"][id="upload_img"]')[0].files[0];
			if(file != null && file != '')
			{
				var size, ext ;
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
				formdata.append('image',$('input[type="file"][id="upload_img"]')[0].files[0]);
        
			}

			var request = {
                method: 'POST',
                url: "<?php echo base_url(); ?>savePricpal",
                data: formdata,
                headers: {'Content-Type': undefined}
            };
            	
            $http(request)
            .success(function (response) {
                var $this = $(".save-button");
                $this.button('reset');
                if(response.message == true){
       				message('Principal has been successfully saved','show');
					window.location.href = "<?php echo base_url();?>show_prinicpal_list";
       	    	}

       	    	if(response.message == false){
					initmodules();
       				message('Principal data did not save','show')
       	    	}
            })
            .error(function(){
                var $this = $(".save-button");
                $this.button('reset');
				initmodules();
                message('Principal data not saved','show')
            });
		}

		function initmodules()
		{
			$scope.inputFirstName = '';
			$scope.inputLastName = '';
			$scope.inputTeacher_Nic = '';
			$scope.input_teacher_email = '';
			$scope.input_pr_phone = '';
			$scope.pr_home = '';
			$scope.sc_home = '';
			$scope.input_city = '';
			$scope.input_zipcode = '';
			//$scope.inputReligion = $scope.religionlist[0]
			$scope.inputProvice = $scope.provincelist[0];
			$scope.input_t_gender = $scope.genderlist[0]
			
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

            document.getElementById('save_principal').disabled = true;

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

            document.getElementById('save_principal').disabled = false;

          }

        });

      }

    }

  }
  
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

          document.getElementById('save_principal').disabled = true;

          $("#teacher_email").re();

        }

        else{

          $scope.is_nonvalid_teacher = false;

          $("#teacher_email").hide();

          jQuery("#input_teacher_email").removeClass('errorshow');

        }





        if(response.message == false)

        {

          document.getElementById('save_principal').disabled = false;

        }

      });

    }

  }

		function teacherResponseFailure()
		{
			var $this = $(".save-button");
            $this.button('reset');

			$(".user-message").show();
	    	$(".message-text").text("Principal data not saved").fadeOut(10000);
		}

        function loadTeacherResponse(response)
        {
        	var is_img_uploaded = $("#upload_img").val();
			var $this = $(".save-button");
            $this.button('reset');
        	if(response.message == true && is_img_uploaded != ''){

				// window.location.href = "<?php echo $path_url;?>show_teacher_list";
				saveprofileUpload(response.lastid)
			}
			else{
				window.location.href = "<?php echo $path_url;?>show_prinicpal_list";

			}
        }

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
                		window.location.href = "<?php echo $path_url;?>show_prinicpal_list";
                	}
                }
            });
            return false;
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

	 		$("#video").hide()
	 		$("#print").hide()
	 		$("#take_pic_btn").show()


	 		$('.image-upload-wrap').hide();
	 		$("#edit_thumbnail").hide()
	 		$('.file-upload-content').show();
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
			   $('.file-upload-image').attr('src', e.target.result);
		
			   $('.file-upload-content').show();
			});
		}

	 	$scope.removeUpload = function() {
		 	 
		  	$('.file-upload-content').hide();
		  	document.getElementById("upload_img").value = "";
		  	$('.image-upload-wrap').show();
		}

		$('.image-upload-wrap').bind('dragover', function () {
			$scope.is_image_edit = true;
			 $('.file-upload-input').trigger( 'click' );
			$('.image-upload-wrap').addClass('image-dropping');
		});

		$('.image-upload-wrap').bind('dragleave', function () {
			 $scope.is_image_edit = true;
			 $('.file-upload-input').trigger( 'click' );
			$('.image-upload-wrap').removeClass('image-dropping');
		});

       	function getSchoolList()
        {
         	try{
                var data = ({tschool:'tschool'})
                httprequest('<?php echo base_url(); ?>getschoollist',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.selectlistcity = response;
                        $scope.inputLocation = response[1];

                        if($scope.is_edit != '' && $scope.editarray != null)
                        {
                         
                        	var found = $filter('filter')($scope.selectlistcity,{sid:$scope.editarray.schoolid},true);
					   
						   if(found.length)
						   {
						   		$scope.inputLocation = found[0]
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

     	function httprequest(url,data)
        {
            var request = $http({
                method:'get',
                url:url,
                params:data,
                headers : {'Accept' : 'application/json'}
            });
            return (request.then(responseSuccess,responseFail))
        }

        function httppostrequest(url,data)
        {
            var request = $http({
                method:'POST',
                url:url,
                data:data,
                headers : {'Accept' : 'application/json'}
            });
            return (request.then(responseSuccess,responseFail));
        }

    	function responseSuccess(response)
        {
            return (response.data);
        }

        function responseFail(response){
            return (response.data);
        }

	});
</script>
