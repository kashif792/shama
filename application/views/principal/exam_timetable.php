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
			<label>Add Schedule </label>
		</div>
		<div class="panel-body">
          		<?php $attributes = array('name' => 'schedule_timetable', 'id' => 'schedule_timetable','class'=>'form-horizontal'); echo form_open('', $attributes);?>
	               	<input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="serial" id="serial" ng-model="serial">
                	<fieldset>
	                	<div class="form-group">
	                		<div class="col-sm-12">
	                			<label><span class="icon-user"></span> Grade <span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
								<select class="form-control" ng-options="item.name for item in classlist track by item.id"  id="select_class" name="select_class" ng-model="select_class" ng-change="changeclass()"></select>
	                		</div>
	                	</div>
	                	<div class="form-group ">
	                		<div class="col-sm-12">
	                			<label><span class="icon-user"></span> Section <span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
	                			
	                	            <select class="form-control"  ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection" ng-change="checksche()"  ng-model="inputSection" >
	                				</select>
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

	                
	                	<div class="form-group ">
	                		<div class="col-sm-12">
	                			<label><span class="icon-user"></span> Teacher <span class="required">*</span></label>
	                		</div>
	                		<div class="col-sm-6">
	                				<select class="form-control" ng-options="item.name for item in teacherlist track by item.id" name="select_teacher" id="select_teacher" ng-change="chkteachersche();" ng-model="select_teacher"></select>

	                		</div>
	                	</div>
	                		<!-- <div class="form-group ">
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
	                		</div> -->
	                	<div class="form-group">
	                		<div class="col-md-12">
	                			<table  class="table table-striped table-bordered row-border hover">
	                				<thead>
                                        <tr>
                                            <th>Active</th>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<tr>
                                    		<td>
                                    			<input type="checkbox" name="mon_status" id="mon_status" <?php if($result['mon_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Monday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker mon_start_time" <?php if($result['mon_status']=="Inactive") {echo 'disabled="disabled"';} ?>  autocomplete="off"  name="inputFrom" ng-model="timeobj.monstarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker mon_end_time" <?php if($result['mon_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.monendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    	<tr>
                                    		<td><input type="checkbox" name="tue_status" id="tue_status" <?php if($result['tue_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Tuesday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker tue_start_time" <?php if($result['tue_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputFrom" ng-model="timeobj.tuestarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker tue_end_time" <?php if($result['tue_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.tueendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    	<tr>
                                    		<td><input type="checkbox" name="wed_status" id="wed_status" <?php if($result['wed_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Wednesday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker wed_start_time" <?php if($result['wed_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputFrom" ng-model="timeobj.wedstarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker wed_end_time" <?php if($result['wed_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.wedendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    	<tr>
                                    		<td><input type="checkbox" name="thu_status" id="thu_status" <?php if($result['thu_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Thursday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker thu_start_time" <?php if($result['thu_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputFrom" ng-model="timeobj.thustarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker thu_end_time" <?php if($result['thu_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.thuendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    	<tr>
                                    		<td><input type="checkbox" name="fri_status" id="fri_status" <?php if($result['fri_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Friday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker fri_start_time" <?php if($result['fri_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputFrom" ng-model="timeobj.fristarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker fri_end_time" <?php if($result['fri_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.friendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    	<tr>
                                    		<td><input type="checkbox" name="sat_status" id="sat_status" <?php if($result['sat_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Saturday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker sat_start_time" <?php if($result['sat_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputFrom" ng-model="timeobj.satstarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker sat_end_time" <?php if($result['sat_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.satendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    	<tr>
                                    		<td><input type="checkbox" name="sun_status" id="sun_status" <?php if($result['sun_status']=="Active") {echo 'checked="checked"';} ?> value="Active"></td>
                                    		<td>Sunday</td>
                                    		<td><input type="text" class="form-control scheduletimepicker sun_start_time" <?php if($result['sun_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputFrom" ng-model="timeobj.sunstarttime" placeholder="Start Time" required></td>
                                    		<td><input type="text" class="form-control scheduletimepicker sun_end_time" <?php if($result['sun_status']=="Inactive") {echo 'disabled="disabled"';} ?> autocomplete="off"  name="inputTo"  ng-model="timeobj.sunendtime"  placeholder="End Time"  tabindex="1" required></td>
                                    	</tr>
                                    </tbody>
	                			</table>
	                		</div>
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

		function initmodules()
		{
			loadclass()
			loadteacherlist();
			if($scope.serial == ''){
				$scope.inputStartitme = '<?php if(isset($result)){echo date('H:i',strtotime($result['start_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds); } ?>'
				$scope.InputEndTime = '<?php if(isset($result)){echo date('H:i',strtotime($result['end_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds + 900); } ?>'
			}
		}

		function getScheduleDetail() {
			try{
			 	
			   var data = ({scheduleinfo:$scope.serial})
			   httprequest('<?php echo base_url(); ?>scheduleinfo',data).then(function(response){
				   if(response != null)
				   {
			   		 	$scope.editresponse = response;
			   		 	// var found = $filter('filter')($scope.classlist, {id: response.class}, true);
			   		 	
			   		 	// if(found.length)
			   		 	// {
			   		 	// 	$scope.select_class = found[0];
			   		 	// }


			   		 	// var found = $filter('filter')($scope.sectionslist, {id: response.section}, true);
			   		
			   		 	// if(found.length)
			   		 	// {
			   		 	// 	$scope.inputSection = found[0];
			   		 	// }


			   		 	// var found = $filter('filter')($scope.subjectlist, {id: response.subject}, true);

			   		 	// if(found.length)
			   		 	// {
			   		 	// 	$scope.inputSubject = found[0];
			   		 	// }


			   		 	// var found = $filter('filter')($scope.teacherlist, {id: response.teacher}, true);
			   		 	// if(found.length)
			   		 	// {
			   		 	// 	console.log(found[0])
			   		 	// 	$scope.select_teacher = found[0];
			   		 	// }
					  	
					  	$scope.inputStartitme = response.start_time;
					  	$scope.InputEndTime = response.end_time;
					  	loadclass()
					  	loadteacherlist();
				   }
				   else{

				   }
			   })
		   }
		   catch(ex){}
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
        }
// checked condition
$('#mon_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".mon_start_time").removeAttr("disabled");
	   	 $(".mon_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".mon_start_time").attr("disabled" , "disabled");
	   	$(".mon_end_time").attr("disabled" , "disabled");
    }
      
});
$('#tue_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".tue_start_time").removeAttr("disabled");
	   	 $(".tue_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".tue_start_time").attr("disabled" , "disabled");
	   	$(".tue_end_time").attr("disabled" , "disabled");
    }
      
});
$('#wed_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".wed_start_time").removeAttr("disabled");
	   	 $(".wed_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".wed_start_time").attr("disabled" , "disabled");
	   	$(".wed_end_time").attr("disabled" , "disabled");
    }
      
});
$('#thu_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".thu_start_time").removeAttr("disabled");
	   	 $(".thu_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".thu_start_time").attr("disabled" , "disabled");
	   	$(".thu_end_time").attr("disabled" , "disabled");
    }
      
});
$('#fri_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".fri_start_time").removeAttr("disabled");
	   	 $(".fri_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".fri_start_time").attr("disabled" , "disabled");
	   	$(".fri_end_time").attr("disabled" , "disabled");
    }
      
});
$('#sat_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".sat_start_time").removeAttr("disabled");
	   	 $(".sat_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".sat_start_time").attr("disabled" , "disabled");
	   	$(".sat_end_time").attr("disabled" , "disabled");
    }
      
});
$('#sun_status').click(function(){
    if($(this).is(":checked"))
    {
	     $(".sun_start_time").removeAttr("disabled");
	   	 $(".sun_end_time").removeAttr("disabled");
	}
    else
    {
    	$(".sun_start_time").attr("disabled" , "disabled");
	   	$(".sun_end_time").attr("disabled" , "disabled");
    }
      
});
// End here
        $scope.changeclass = function()
        {
        	loadSections();
        }

		$('.scheduletimepicker').timepicker({
               showLeadingZero: false,
               onSelect: tpStartSelect,
               
                showNowButton: false,
                nowBuscheduletimepickerttonText: 'Now',
                minutes: {
                    starts: 0,                // First displayed minute
                    ends: 59,                 // Last displayed minute
                    interval: 5,              // Interval of displayed minutes
                    manual: []                // Optional extra entries for minutes
                },
                
                

           });
		$(document).ready(function() {
			
			
			$('.mon_start_time').val('<?php if($result['mon_start_time']!="00:00:00") { echo date('H:i',strtotime($result['mon_start_time'])); } ?>');
			$('.mon_end_time').val('<?php if($result['mon_end_time']!="00:00:00") { echo date('H:i',strtotime($result['mon_end_time'])); } ?>');
			$('.tue_start_time').val('<?php if($result['tue_start_time']!="00:00:00") { echo date('H:i',strtotime($result['tue_start_time'])); } ?>');
			$('.tue_end_time').val('<?php if($result['tue_end_time']!="00:00:00") { echo date('H:i',strtotime($result['tue_end_time'])); } ?>');
			$('.wed_start_time').val('<?php if($result['wed_start_time']!="00:00:00") { echo date('H:i',strtotime($result['wed_start_time'])); } ?>');
			$('.wed_end_time').val('<?php if($result['wed_end_time']!="00:00:00") { echo date('H:i',strtotime($result['wed_end_time'])); } ?>');
			$('.thu_start_time').val('<?php if($result['thu_start_time']!="00:00:00") { echo date('H:i',strtotime($result['thu_start_time'])); } ?>');
			$('.thu_end_time').val('<?php if($result['thu_end_time']!="00:00:00") { echo date('H:i',strtotime($result['thu_end_time'])); } ?>');
			$('.fri_start_time').val('<?php if($result['fri_start_time']!="00:00:00") { echo date('H:i',strtotime($result['fri_start_time'])); } ?>');
			$('.fri_end_time').val('<?php if($result['fri_end_time']!="00:00:00") { echo date('H:i',strtotime($result['fri_end_time'])); } ?>');
			$('.sat_start_time').val('<?php if($result['sat_start_time']!="00:00:00") { echo date('H:i',strtotime($result['sat_start_time'])); } ?>');
			$('.sat_end_time').val('<?php if($result['sat_end_time']!="00:00:00") { echo date('H:i',strtotime($result['sat_end_time'])); } ?>');
			$('.sun_start_time').val('<?php if($result['sun_start_time']!="00:00:00") { echo date('H:i',strtotime($result['sun_start_time'])); } ?>');
			$('.sun_end_time').val('<?php if($result['sun_end_time']!="00:00:00") { echo date('H:i',strtotime($result['sun_end_time'])); } ?>');
		})
        $scope.savetimetable = function()
        {
    	 	var subj_name = $("#select_subject").val();
            var section = $("#inputSection").val();

            //var starttime = $("#inputStartitme").val();
            //var endtime = $("#InputEndTime").val();
            // Timing
            var mon_status = $('input[name="mon_status"]:checked').val();
            
            var mon_start_time = $(".mon_start_time").val();
            var mon_end_time = $(".mon_end_time").val();
            var tue_status = $('input[name="tue_status"]:checked').val();
            var tue_start_time = $(".tue_start_time").val();
            var tue_end_time = $(".tue_end_time").val();
            var wed_status = $('input[name="wed_status"]:checked').val();
            var wed_start_time = $(".wed_start_time").val();
            var wed_end_time = $(".wed_end_time").val();
            var thu_status = $('input[name="thu_status"]:checked').val();
            var thu_start_time = $(".thu_start_time").val();
            var thu_end_time = $(".thu_end_time").val();
            var fri_status = $('input[name="fri_status"]:checked').val();
            var fri_start_time = $(".fri_start_time").val();
            var fri_end_time = $(".fri_end_time").val();
            var sat_status = $('input[name="sat_status"]:checked').val();
            var sat_start_time = $(".sat_start_time").val();
            var sat_end_time = $(".sat_end_time").val();
            var sun_status = $('input[name="sun_status"]:checked').val();
            var sun_start_time = $(".sun_start_time").val();
            var sun_end_time = $(".sun_end_time").val();
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

             if(!$scope.inputSection){
                jQuery("#inputSection").css("border", "1px solid red");
                message("Please select section",'show');
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

 				if(!$scope.select_teacher){
                jQuery("#select_teacher").css("border", "1px solid red");
                message("Please select teacher",'show')
                return false;
            }
            else{
                jQuery("#select_subject").css("border", "1px solid #C9C9C9");
            }
   //          var reg = /(\d|2[0-3]):([0-5]\d)/;

   //          if(reg.test(starttime) == false){
   //              jQuery("#inputStartitme").css("border", "1px solid red");
   //              return false;
   //          }
   //          else{
   //              jQuery("#inputStartitme").css("border", "1px solid #C9C9C9");
   //          }

   //          if(reg.test(endtime) == false){
   //              jQuery("#InputEndTime").css("border", "1px solid red");
   //              return false;
   //          }
   //          else{
   //              jQuery("#InputEndTime").css("border", "1px solid #C9C9C9");
   //          }





   //         	var t = new Date();
			// d = t.getDate();
			// m = t.getMonth() + 1;
			// y = t.getFullYear();

			// var d1 = new Date(m + "/" + d + "/" + y + " " + starttime);
			// var d2 = new Date(m + "/" + d + "/" + y + " " + endtime);
			// var t1 = d1.getTime();
			// var t2 = d2.getTime();

			// if(t2 <= t1)
			// {
			// 	$("#time_error").show()
			// 	return false;
			// }

			 var $this = $(".btn-primary");
             $this.button('loading');

         	var formdata = new FormData();
			formdata.append('select_subject',$scope.inputSubject.id);
			formdata.append('select_class',$scope.select_class.id);
			formdata.append('inputSection',$scope.inputSection.id);
			formdata.append('select_teacher',$scope.select_teacher.id);
			// formdata.append('inputFrom',$scope.inputStartitme);
			// formdata.append('inputTo',$scope.InputEndTime);
			formdata.append('serial',$scope.serial);
			// Timing add
			formdata.append('mon_status',mon_status);
			formdata.append('mon_start_time',mon_start_time);
			formdata.append('mon_end_time',mon_end_time);
			formdata.append('tue_status',tue_status);
			formdata.append('tue_start_time',tue_start_time);
			formdata.append('tue_end_time',tue_end_time);
			formdata.append('wed_status',wed_status);
			formdata.append('wed_start_time',wed_start_time);
			formdata.append('wed_end_time',wed_end_time);
			formdata.append('thu_status',thu_status);
			formdata.append('thu_start_time',thu_start_time);
			formdata.append('thu_end_time',thu_end_time);
			formdata.append('fri_status',fri_status);
			formdata.append('fri_start_time',fri_start_time);
			formdata.append('fri_end_time',fri_end_time);
			formdata.append('sat_status',sat_status);
			formdata.append('sat_start_time',sat_start_time);
			formdata.append('sat_end_time',sat_end_time);
			formdata.append('sun_status',sun_status);
			formdata.append('sun_start_time',sun_start_time);
			formdata.append('sun_end_time',sun_end_time);
			// end here
			var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/saveTimtable",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    var $this = $(".btn-primary");
                    $this.button('reset');
                    if(response.message == true){
           				message('Schedule added','show');
						window.location.href = "<?php echo $path_url;?>show_timtbl_list";
           	    	}

           	    	if(response.message == false){
						initmodules();
           				message('Schedule data not saved','show')
           	    	}
                })
                .error(function(){
                    var $this = $(".btn-primary");
                    $this.button('reset');
					initmodules();
                    message('Schedule data not saved','show')
                });
        }

 /*       $("#schedule_timetable").submit(function(e){
         	e.preventDefault();
            var subj_name = $("#select_subject").val();
            var section = $("#inputSection").val();

            var starttime = $("#inputStartitme").val();
            var endtime = $("#InputEndTime").val();
            message("",'hide')
            $("#time_error").hide()

             if(section == ''){
                jQuery("#inputSection").css("border", "1px solid red");
                return false;
            }
            else{
                jQuery("#inputSection").css("border", "1px solid #C9C9C9");
            }

             if(subj_name == ''){
                jQuery("#select_subject").css("border", "1px solid red");
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

	      	var dataString = jQuery('#schedule_timetable').serializeArray();
	      	 	var $this = $(".class-btn");
            $this.button('loading');

	    
			var formdata = new FormData();
			formdata.append('select_subject',$scope.inputSubject.id);
			formdata.append('class_id',$scope.select_class.id);
			formdata.append('section_id',$scope.inputSection.id);
			formdata.append('teacher_uid',input_class_name);
			formdata.append('start_time',input_class_name);
			formdata.append('serial',$scope.inputLocation.sid);

			var request = {
                method: 'POST',
                url: "<?php //echo $path_url; ?>saveClass",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    var $this = $(".class-btn");
                    $this.button('reset');
                    if(response.message == true){
           				message('Class  added','show')
						$scope.input_class_name = '';
		        		loadclass()
           	    	}

           	    	if(response.message == false){
						$scope.input_class_name = '';
           				message('Class not added','show')
           	    	}
                })
                .error(function(){
                    var $this = $(".class-btn");
                    $this.button('reset');
					$scope.input_class_name = '';
                    message('Class data not saved','show')
                });

	      	ajaxType = "POST";
	  		urlpath = "<?php //echo $path_url; ?>Principal_controller/saveTimtable";
	     	ajaxfunc(urlpath,dataString,userResponseFailure,loadUserResponse);
        });

		function userResponseFailure()
		{
		 	var $this = $(".btn-primary");
        	$this.button('reset');
           		message('Timetable not saved','show')

		}

        function loadUserResponse(response)
        {
        	if(response.message == true){
         	var $this = $(".btn-primary");
          	$this.button('reset');
				window.location.href = "<?php //echo $path_url;?>show_timtbl_list";
			}else{
				var $this = $(".btn-primary");
          		$this.button('reset');

          		message('Timetable not saved','show')
			}
        }*/

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


