<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>

<div class="col-sm-10" ng-controller="subject">
	<?php
		// require_footer
		require APPPATH.'views/__layout/filterlayout.php';
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<label>Add New Subject</label>
		</div>
		<div class="panel-body">
			<?php $attributes = array('name' => 'add_new_subject', 'id' => 'add_new_subject','class'=>'form-page'); echo form_open('', $attributes);?>
	               	<input type="hidden" value="" name="serial" id="serial" ng-model="serial">
	               	<div class="form-group">
	               		<div class="col-sm-6">
	               			<label>Subject: <span class="required">*</span></label>
	               			<input type="text" class="form-control" id="subj_name" name="subj_name"  ng-model="subj_name"  placeholder="Enter the subject name" value="">
            				<span class="errorhide" id="subject_name">Please enter your subject name</span>
	               		</div>
	               		<div class="col-sm-6">
	               			<label>Code: <span class="required">*</span></label>
	               			<input type="text" class="form-control" id="inputsubjectcode" name="inputsubjectcode" ng-model="inputsubjectcode" placeholder="Enter the subject code" value="">
            				<span class="errorhide" id="subject_code">Please enter your subject code</span>
	               		</div>

	               	</div>	
	               	<div class="form-group">
	               		<div class="col-sm-6">
	               			<label>Grade:</label>
	               			<select class="form-control" ng-options="item.name for item in classlist track by item.id"  id="class_name" name="class_name" ng-model="class_name" ></select>
	               		</div>
	               		<div class="col-sm-6">
	               			<label>Semester: <span class="required">*</span></label>
	               			<select class="form-control"   ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="inputSemester" ></select>
	               		</div>
	               <!--		<div class="col-sm-6">-->
	               <!--			<label>Total Marks: <span class="required">*</span></label>-->
	               <!--			<input type="text" class="form-control" id="subj_marks" name="subj_marks"  ng-model="subj_marks"  placeholder="Enter the total marks" value="">-->
            				<!--<span class="errorhide" id="subj_marks">Please enter total marks</span>-->
	               <!--		</div>-->
	               	</div>
	               	
	               	<div class="form-group">
                		<div class="col-sm-12">
                			<div class="file-upload">
						  		<div class="image-upload-wrap">
							    	<input tabindex="8" class="file-upload-input" type='file' onchange="angular.element(this).scope().readURL(event);" id="upload_img" name="upload_img" accept="image/*" />
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
        		 			<button type="button" ng-click="savesubject()" tabindex="8" class="btn btn-primary btn-subject" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
                			<a tabindex="9" href="<?php echo $path_url; ?>show_subject_list" tabindex="6" title="cancel">Cancel</a>
        		 		</div>
        		 	</div>
				</div>
			</div>
</div>
<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>
<script type="text/javascript">
	var app = angular.module('invantage', []);
	app.controller('subject', function($scope, $http, $interval,$compile,$filter) {
		var urlist = {
            getclasslist:'<?php echo base_url(); ?>getclasslist',
            getsectionbyclass:'<?php echo base_url(); ?>getsectionbyclass',
            getsemesterdata:'<?php echo base_url(); ?>getsemesterdata',
        }
        $scope.subj_name="";
        $scope.inputsubjectcode="";
        // $scope.subj_marks="";
        $scope.is_edit = "<?php echo $this->uri->segment('2'); ?>";
		$scope.inputclass = $scope.ini;
		$scope.editsubjectarray =[];
		$scope.is_image_edit = false;
		$scope.serial = '';
		angular.element(function () {
	       	
       		if($scope.is_edit == '')
			{
				loadclass()
       			getSemesterData();
			}

	       	if($scope.is_edit != '')
			{
				
				$scope.serial = $scope.is_edit;
				getSubjectinfo();
			}
	       	
	 	});

		function loadclass()
        {

            httprequest(urlist.getclasslist,({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.classlist = response
                    $scope.class_name = response[0]
                    
                    var found = $filter('filter')($scope.classlist,{id:$scope.editsubjectarray.class},true);
					
					if(found.length)
					{
						$scope.class_name = found[0];
					}
                }
            });
        }

       	function getSemesterData()
        {
            try{
                httprequest(urlist.getsemesterdata,({})).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.semesterlist = response;
                        $scope.inputSemester = response[0];

                        if($scope.is_edit != null && $scope.is_edit != '')
					{
						var found = $filter('filter')($scope.semesterlist,{id:$scope.editsubjectarray.semester},true);
						if(found.length)
						{
							$scope.inputSemester = found[0];
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


        function getSubjectinfo() {
			try{

			   var data = ({subjectid:$scope.is_edit})
			   httprequest('<?php echo base_url(); ?>getsubjectbyid',data).then(function(response){
				   if(response != null)
				   {
				   		$scope.editsubjectarray =response;
				   		$scope.subj_name = response.name;
				   	// 	$scope.subj_marks = response.name.subj_marks;

			   		 	if(response.image != '')
					   	{
						   	$(".img-rounded").prop('src',response.image);
						   	$("#imagesize").show()
					   	   	
							
				  	 	}
				  	 	loadclass()
       						getSemesterData();
				  	 	$scope.inputsubjectcode = response.subjectcode;
				  	 //	$scope.subj_marks = response.subj_marks;
					} 
			   });
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
         *   Save new subject
         * ---------------------------------------------------------
         */
        $scope.savesubject = function()
        {
        	var regmarks = new RegExp(/^[0-9-_ ]{3,100}$/);

            var reg = new RegExp(/^[A-Za-z0-9-_ ]{3,50}$/);
            //var sub_nam=$scope.subj_name;
           
         	if(!reg.test($scope.subj_name)){
         	
                jQuery("#subj_name").addClass('errorshow');
                $("#subject_name").show();
                return false;
            }
            else{
                jQuery("#subj_name").removeClass('errorshow');
                $("#subject_name").hide();
            }

         	if(reg.test($scope.inputsubjectcode) == false){
                jQuery("#inputsubjectcode").addClass('errorshow');
                $("#subject_code").show();
                return false;
            }
            else{
                jQuery("#inputsubjectcode").removeClass('errorshow');
                $("#subject_code").hide();
            }
            // if(regmarks.test($scope.subj_marks) == false){
            //     jQuery("#subj_marks").addClass('errorshow');
            //     $("#subj_marks").show();
            //     return false;
            // }
            // else{
            //     jQuery("#subj_marks").removeClass('errorshow');
            //     $("#subj_marks").hide();
            // }


			var formdata = new FormData();
			formdata.append('subject_name',$scope.subj_name);
			formdata.append('subject_code',$scope.inputsubjectcode);
			formdata.append('class_name',$scope.class_name.id);
			formdata.append('semsterid',$scope.inputSemester.id);
			formdata.append('semsterid',$scope.inputSemester.id);
// 			formdata.append('subj_marks',$scope.subj_marks);
			formdata.append('serial',$scope.serial);
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

			var $this = $(".btn-subject");
            $this.button('loading');

			var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>saveSubject",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    var $this = $(".btn-subject");
                    $this.button('reset');
                    if(response.message == true){
           				window.location.href = "<?php echo $path_url;?>show_subject_list";
           	    	}

           	    	if(response.message == false){
						$scope.input_class_name = '';
           				message('Subject not added','show')
           	    	}
                })
                .error(function(){
                    var $this = $(".btn-subject");
                    $this.button('reset');
					$scope.input_class_name = '';
                    message('Subject not saved','show')
                });
        }


		$scope.readURL = function(event,uploadelemntid) {
			var files = event.target.files;
			var file = files[0];
			var reader = new FileReader();
			reader.onload = $scope.imageIsLoaded
			reader.readAsDataURL(file);
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
			$('.file-upload-input').replaceWith($('.file-upload-input').clone());
		  	$('.file-upload-content').hide();
		  	$('.image-upload-wrap').show();
		  	$scope.is_image_edit = true;
			$('.file-upload-image').attr('src', '');
		}

		$('.image-upload-wrap').bind('dragover', function () {
			$scope.is_image_edit = true;
			$('.file-upload-input').trigger( 'click' );
			$('.image-upload-wrap').addClass('image-dropping');
		});

		$('.image-upload-wrap').bind('dragleave', function () {
			$scope.is_image_edit = true;
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

      	function responseSuccess(response){
        	return (response.data);
      	}

      	function responseFail(response){
        	return (response.data);
      	}
	});
</script>
