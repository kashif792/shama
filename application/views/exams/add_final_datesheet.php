<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>

<div class="col-sm-10"  ng-controller="timetable_controller">
	<?php
		// require_footer
		require APPPATH.'views/__layout/filterlayout.php';
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<label>Add Mid Term Datesheet </label>
		</div>
		<div class="panel-body">
          		<?php $attributes = array('name' => 'schedule_timetable', 'id' => 'schedule_timetable','class'=>'form-horizontal'); echo form_open('', $attributes);?>
	               	<input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="serial" id="serial" ng-model="serial">
                	<input type="hidden" value="Final" name="type" id="type" ng-model="type">
                	<fieldset>
                		<div class="form-group">
                			<div class="col-sm-12">
                            <label for="inputRSession">Session <span class="required">*</span></label>
                        	</div>
                            <div class="col-sm-6">

                            <select  class="form-control" ng-options="item.name for item in rsessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="filterobj.session"  ></select>
                        	</div>
                        </div>
                        <div class="form-group">
                			<div class="col-sm-12">
                            <label for="inputRSession">Semeter <span class="required">*</span></label>
                        	</div>
                            <div class="col-sm-6">

                             <select class="form-control" ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester"></select>
                        	</div>
                        </div>
	                	<div class="form-group">
	                		<div class="col-sm-12">
	                			<label><span class="icon-user"></span> Grade <span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
								<select class="form-control" ng-options="item.name for item in classlist track by item.id"  id="select_class" name="select_class" ng-model="select_class" ng-change="changeclass()"></select>
	                		</div>
	                	</div>
	                	
	                    <div class="form-group">
	                		<div class="col-sm-12">
	                			<label><span class="icon-phone"></span> Subject<span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
                				<select class="form-control" ng-options="item.name for item in subjectlist track by item.id" name="select_subject" id="select_subject" ng-change="checksche()" ng-model="inputSubject"></select>
	                		</div>
	                     </div>
	                     <div class="form-group">
	                		<div class="col-sm-12">
	                			<label><span class="icon-mail-alt"></span> Date<span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
                				<input class="form-control" type="text"  placeholder="" ng-model="exam_date" id="exam_date" name="exam_date"  value="">
			                							
	                		</div>
	                     </div>
	                     	
	                		<div class="form-group ">
	                		<div class="col-sm-12">
	                			<label><span class="icon-clock"></span> From <span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
								<input type="text" class="form-control" id="inputStartitme" name="inputFrom" ng-model="inputStartitme"  placeholder="Start Time"  tabindex="1" value="" required>
							</div>	
	                		<div class="col-sm-6">
	                			<input type="text" class="form-control" id="InputEndTime" name="inputTo" ng-model="InputEndTime"  placeholder="End Time"  tabindex="1" value="" required>
	                		</div>	
		                		<div id="time_error" class="required row endtimeerror">End time must be greater then start time</div>
	                		</div>
	                	
	                	<div class="form-group">
	                		<div class="col-sm-12">
	                			<button type="button" tabindex="8" class="btn btn-primary"  id="save" ng-click="savetimetable()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
	                			<a tabindex="9" href="<?php echo $path_url; ?>show_timtbl_list" tabindex="6" title="cancel">Cancel</a>
	                		</div>
	                	</div>
	                </fieldset>
	            <?php echo form_close();?>
			</div>
	</div>
</div>



	<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.timepicker.js?v=0.3.3"></script>


<script type="text/javascript">
	var app = angular.module('invantage', []);

 	app.directive('myRepeatDirective', function() {
  		return function(scope, element, attrs) {
    
	    	if (scope.$last){
		     	checkClass()
	    	}
	  	};
	});

	app.controller('timetable_controller', function($scope, $http, $interval,$filter) {
		$scope.filterobj = {};
		$scope.fallsemester = [];
		var urlist = {
            getclasslist:'<?php echo base_url(); ?>getclasslist',
            
        }

        $scope.serial = "<?php echo $this->uri->segment('2'); ?>";
        $scope.select_class="";
        $scope.inputSection="";
        $scope.inputSubject="";
        $scope.select_teacher="";
        $scope.editresponse = [];
        $scope.firsttimeload = false;
		angular.element(function(){
			if($scope.serial == '')
			{
				initmodules();
			}

			if($scope.serial != '')
			{
				$scope.firsttimeload = true;

				getScheduleDetail();
				
				
				
				//document.getElementById("save").disabled = false;
			}
		});
		function getSessionList()
        {
            httprequest('getsessiondetail',({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.rsessionlist = response
                    
                     var find_active_session = $filter('filter')(response,{status:'a'},true);
                    if(find_active_session.length > 0)
                    {
                    	
                        $scope.filterobj.session = find_active_session[0];
                    }
                }
                else{
                    $scope.finished();
                }
            });
        }
        
        getSessionList();
        getSemesterData();
        function getSemesterData(){
            try{
                $scope.semesterlist = []
                httprequest('<?php echo $path_url; ?>getsemesterdata',({})).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.semesterlist = response;
                        var find_active_semester = $filter('filter')(response,{active_semster:'a'},true);
                        
                        if(find_active_semester.length > 0)
                        {
                            
                            $scope.filterobj.semester = find_active_semester[0]  ;
                            
                        }

                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }
		function initmodules()
		{
			loadclass()
			loadteacherlist();
			if($scope.serial == ''){
				$scope.inputStartitme = '<?php if(isset($result)){echo date('H:i',strtotime($result['start_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds); } ?>'
				$scope.InputEndTime = '<?php if(isset($result)){echo date('H:i',strtotime($result['end_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds + 900); } ?>'
				$scope.exam_date = '<?php echo date('Y-m-d') ?>'
				$scope.type = '<?php echo "Final" ?>'
			}
		}

		
		function loadclass()
        {
        	if($scope.classlist != null && $scope.classlist.length > 0 && $scope.firsttimeload == false)
        	{
        		 $scope.select_class = $scope.classlist[0];

        		 loadSections();
        	}

        	if($scope.classlist == null)
        	{
        		httprequest(urlist.getclasslist,({})).then(function(response){
	                if(response != null && response.length > 0)
	                {
	                    $scope.classlist = response
	                    $scope.select_class = response[0]
	                    if($scope.firsttimeload == true)
	                    {
			   		 		var found = $filter('filter')($scope.classlist, {id: $scope.editresponse.class}, true);
	                    	if(found.length)
	                    	{
	                    		$scope.select_class = found[0];
	                    	}
	                    	
	                    }
	                    loadSections();
	                }
	            });
        	}

        		httprequest(urlist.rsessionlist,({})).then(function(response){
	                if(response != null && response.length > 0)
	                {
	                    $scope.rsessionlist = response;
	                }
	            });
        	
        }

        $scope.changeclass = function()
        {
        	loadSections();
        }


        $scope.savetimetable = function()
        {
        	var session_id = $("#inputRSession").val();
        	var semester_id = $("#inputSemester").val();
    	 	var subj_name = $("#select_subject").val();
           

            var starttime = $("#inputStartitme").val();
            var endtime = $("#InputEndTime").val();
            var exam_date = $("#exam_date").val();
            var type = "Mid";
            message("",'hide')
            $("#time_error").hide()


 			if(!$scope.select_class){
                jQuery("#select_class").css("border", "1px solid red");
                message("Please select grade",'show')
                return false;
            }
            else{
                jQuery("#inputSection").css("border", "1px solid #C9C9C9");
            }

             
             if(!$scope.inputSubject){
                jQuery("#select_subject").css("border", "1px solid red");
                message("Please select subject",'show')
                return false;
            }
            else{
                jQuery("#select_subject").css("border", "1px solid #C9C9C9");
            }

 				
            var reg = /(\d|2[0-3]):([0-5]\d)/;

            if(reg.test(starttime) == false){
                jQuery("#inputStartitme").css("border", "1px solid red");
                return false;
            }
            else{
                jQuery("#inputStartitme").css("border", "1px solid #C9C9C9");
            }

            if(reg.test(endtime) == false){
                jQuery("#InputEndTime").css("border", "1px solid red");
                return false;
            }
            else{
                jQuery("#InputEndTime").css("border", "1px solid #C9C9C9");
            }

           	var t = new Date();
			d = t.getDate();
			m = t.getMonth() + 1;
			y = t.getFullYear();

			var d1 = new Date(m + "/" + d + "/" + y + " " + starttime);
			var d2 = new Date(m + "/" + d + "/" + y + " " + endtime);
			var t1 = d1.getTime();
			var t2 = d2.getTime();

			if(t2 <= t1)
			{
				$("#time_error").show()
				return false;
			}

			 var $this = $(".btn-primary");
             $this.button('loading');

         	var formdata = new FormData();
			formdata.append('select_subject',$scope.inputSubject.id);
			formdata.append('select_class',$scope.select_class.id);
			formdata.append('semester_id',$scope.filterobj.semester.id);
			formdata.append('session_id',$scope.filterobj.session.id);
			formdata.append('inputFrom',$scope.inputStartitme);
			formdata.append('inputTo',$scope.InputEndTime);
			formdata.append('serial',$scope.serial);
			formdata.append('exam_date',$scope.exam_date);
			formdata.append('type',$scope.type);
			var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/saveDatesheet",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                	
                    var $this = $(".btn-primary");
                    $this.button('reset');
                    if(response.message == true){
           				message('Mid Datesheet added','show');
						window.location.href = "<?php echo $path_url;?>exams";
           	    	}

           	    	if(response.message == false){
						initmodules();
           				message('Mid Datesheet not saved','show')
           	    	}
                })
                .error(function(){
                    var $this = $(".btn-primary");
                    $this.button('reset');
					initmodules();
                    message('Mid Datesheet not saved','show')
                });
        }

$(document).ready(function(){
		initdatepickter('input[name="exam_date"]',new Date('<?php echo date('Y-m-d') ?>'))
		
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
			$(document).ready(function() {
		   $('#inputStartitme').timepicker({
		       showLeadingZero: false,
		       onSelect: tpStartSelect,
		       onClose:checkTeacherSchedule,
		        showNowButton: false,
		        nowButtonText: 'Now',

			    minutes: {
			        starts: 0,                // First displayed minute
			        ends: 59,                 // Last displayed minute
			        interval: 5,              // Interval of displayed minutes
			        manual: []                // Optional extra entries for minutes
			    },
				onMinuteShow: OnMinuteSShowCallback,
		         onHourShow: OnHourShowCallback,
		        defaultTime:'<?php if(isset($result)){echo date('H:i',strtotime($result['start_time']));} ?>'

		   });
		   $('#InputEndTime').timepicker({
		       showLeadingZero: false,
		       onSelect: tpEndSelect,
		       onClose:checkTeacherSchedule,
		        showNowButton: false,
		        nowButtonText: 'Now',

			    minutes: {
			        starts: 0,                // First displayed minute
			        ends: 59,                 // Last displayed minute
			        interval: 5,              // Interval of displayed minutes
			        manual: []                // Optional extra entries for minutes
			    },
				onMinuteShow: OnMinuteShowCallback,
		        onHourShow: OnHourEShowCallback,
		        defaultTime:'<?php if(isset($result)){echo date('H:i',strtotime($result['end_time']));} ?>'

		   });
		});

		// when start time change, update minimum for end timepicker
		function tpStartSelect( time, endTimePickerInst ) {

		   $('#InputEndTime').timepicker('option', {
		       minTime: {
		           hour: endTimePickerInst.hours,
		           minute: endTimePickerInst.minutes
		       }
		   });
		}

		function OnHourShowCallback(hour) {
		    if ((hour > 18) || (hour < 7)) {
		        return false; // not valid
		    }
		    return true; // valid
		}

		function OnHourEShowCallback(hour) {
			var starhour = $('#inputStartitme').timepicker('getHour');
		    if ((hour < starhour)) {
		        return false; // not valid
		    }
		    return true; // valid
		}



		function OnMinuteShowCallback(hour, minute) {
			var starttime = $('#inputStartitme').timepicker('getMinute');
			var starhour = $('#inputStartitme').timepicker('getHour');
			if( (hour >= starhour) && (minute > starttime)){ return true;}

			if( (hour == starhour) && (starttime <= minute)){ return false;}
		    return true;  // valid
		}

		function OnMinuteSShowCallback(hour, minute) {

		    return true;  // valid
		}



		// when end time change, update maximum for start timepicker
		function tpEndSelect( time, startTimePickerInst ) {
			var starttime = $('#inputStartitme').timepicker('getMinute');
			var starhour = $('#inputStartitme').timepicker('getHour');

			$('#inputStartitme').timepicker('option', {
		       maxTime: {
		           hour: startTimePickerInst.hours,
		           minute: startTimePickerInst.minutes
		       }
		   });
		}

	$scope.is_valid_class = true
	$scope.is_valid_schedule = false

	angular.element(function(){
		if($scope.serial == '')
		{
			setTimerForWidget('section',1)
		}else{
			loadSections()
		}
	})
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
          if(crname == 'section'){
            loadSections()
          }
          $interval.cancel(reporttimer)

      }
    },500)
      }


      function getSubjectList()
      {
      	try{
			var data = ({sinputclassid:$scope.select_class.id})
			$scope.subjectlist = []
			httprequest('<?php echo base_url(); ?>getsubjectlistbyclass',data).then(function(response){
				if(response.length > 0 && response != null)
				{
					$scope.inputSubject = response[0];
					$scope.subjectlist = response;
					if($scope.firsttimeload == true)
                    {
		   		 		var found = $filter('filter')($scope.subjectlist, {id: $scope.editresponse.subject}, true);
                    	if(found.length)
                    	{
                    		$scope.inputSubject = found[0];
                    	}
                    	$scope.firsttimeload = false;
                	}
					//changesubject()
				}
				else{
					$scope.subjectlist = [];
				}
			})
			
		}
		catch(ex){}
      }

		function loadSections()
		{

			try{
				var data = ({inputclassid:$scope.select_class.id})
				$scope.sectionslist = []
				httprequest('<?php echo $path_url; ?>getsectionbyclass',data).then(function(response){
					
					getSubjectList()

					if(response.length > 0 && response != null)
					{
						$scope.inputSection = response[0];
						$scope.sectionslist = response;
						if($scope.firsttimeload == true)
	                    {
			   		 		var found = $filter('filter')($scope.sectionslist, {id: $scope.editresponse.section}, true);
	                    	if(found.length)
	                    	{
	                    		$scope.inputSection = found[0];
	                    	}
	                    	
                    	}
					}
					else{
						$scope.sectionslist = [];
					}

				})

			}
			catch(ex){}
		}

		function changesection()
		{
			try{
				var data = ({inputsectionid:parseInt('<?php if(count($result)){ echo $result["section_id"];} ?>')})
				httprequest('<?php echo $path_url; ?>getschedulesection',data).then(function(response){
					if(response.length > 0 && response != null)
					{
						$scope.inputSection = response[0];

					}
				})

			}
			catch(ex){}
		}

		function changesubject()
		{
			try{
				var data = ({inputsubjectid:parseInt('<?php if(count($result)){ echo $result["subject_id"];} ?>')})
				httprequest('<?php echo $path_url; ?>getschedulesubject',data).then(function(response){
					if(response.length > 0 && response != null)
					{
						$scope.inputSubject = response[0];

					}
				})

			}
			catch(ex){}
		}


		function loadteacherlist()
		{
			try{
				if($scope.teacherlist != null && $scope.teacherlist.length > 0)
				{
					$scope.select_teacher = $scope.teacherlist[0];
				}

				if($scope.teacherlist == null)
				{
					var data = ({})

					httprequest('<?php echo base_url(); ?>teacherlist',data).then(function(response){
						if(response != null)
						{
							$scope.teacherlist = response;
							$scope.select_teacher = response[0];
							if($scope.firsttimeload == true)
		                    {
				   		 		var found = $filter('filter')($scope.teacherlist, {id: $scope.editresponse.teacher}, true);
		                    	if(found.length)
		                    	{
		                    		$scope.select_teacher = found[0];
		                    	}
		                    	
		                	}
						
						}else{
							$scope.teacherlist = [];
						}

					});
				}
			}
			catch(ex){}
		}

		function checkClass()
		{
			try{
				
				if($scope.altersection == false && $scope.serial != '')
				{
					return false;
				}

				var data = ({
							schclassid:$scope.select_class.id,
							sectionid:$scope.inputSection.id,
							subjectid:$scope.inputSubject.id
						})

				httprequest('<?php echo base_url(); ?>checkschedule',data).then(function(response){
					if(response != null && response.message == true)
					{
						$scope.is_valid_class = false
						message("Already subject allocated",'show')
					}else{
						$scope.is_valid_class = true
						message("",'hide')
						checkTeacherSchedule();
					}

					if($scope.is_valid_class == true && $scope.is_valid_schedule == true)
					{
					//	document.getElementById("save").disabled = false;
					}
					else
					{
						//document.getElementById("save").disabled = true;
					}
				})
			}
			catch(ex){}
		}

		$scope.isteacheraltered = false
		$scope.chkteachersch = function()
		{
			$scope.isteacheraltered = true
			
			checkClass();
			checkTeacherSchedule()
		}



		function checkTeacherSchedule()
		{
			try{
				//document.getElementById("save").disabled = true;

				if($scope.isteacheraltered == false && $scope.serial == '')
				{
					return false
				}

				if($("#InputEndTime").val().length > 0 && $("#inputStartitme").val().length > 0 ){
					var data = ({
						teacherid:$("#select_teacher").val(),
						starttime:$("#inputStartitme").val(),
						endtime:$("#InputEndTime").val(),
						serial:$("#serial").val(),
						subject:$("#select_subject").val(),
					})

					httprequest('<?php echo $path_url; ?>checkteacherschedule',data).then(function(response){
						if(response != null && response.message == true)
						{
							$scope.is_valid_schedule = false
							message("Schedule already allocated to this teacher",'show')
						}
						else{
							$scope.is_valid_schedule = true
							message("",'hide')
						}

						if($scope.is_valid_class == true && $scope.is_valid_schedule == true)
						{
							//document.getElementById("save").disabled = false;
						}
						else
						{
							//document.getElementById("save").disabled = true;
						}
					})
				}
			}
			catch(ex){}
		}

		$scope.altersection = false
		$scope.checksch = function()
		{
			$scope.altersection = true
			checkClass()
		}

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

<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>
