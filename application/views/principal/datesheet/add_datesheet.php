<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>
<div id="detail_modal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to delete this record?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div>
<div class="col-sm-10"  ng-controller="timetable_controller">
    <?php
        // require_footer
        require APPPATH.'views/__layout/filterlayout.php';
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Add Datesheet </label>
        </div>
        <div class="panel-body">
                <?php $attributes = array('name' => 'schedule_timetable', 'id' => 'schedule_timetable','class'=>'form-horizontal'); echo form_open('', $attributes);?>
                    <input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="serial" id="serial" ng-model="serial">
                    <input type="hidden" value="Mid" name="type" id="type" ng-model="type">
                    <fieldset>
                        <!-- <div class="form-group">
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
                        </div> -->
                        <div class="form-group">
                            <div class="col-md-6">
                                
                                <label><span class="icon-user"></span> Grade <span class="required">*</span></label>
                                
                                    <select class="form-control" ng-options="item.name for item in classlist track by item.id"  id="select_class" name="select_class" ng-model="select_class" ng-change="changeclass()"></select>
                                
                            </div>
                            <div class="col-md-6">
                               <label><span class="icon-user"></span> Type <span class="required">*</span></label>
                                <select class="form-control"  id="exam_type" name="exam_type">
                                <option>Mid</option>
                                <option>Final</option>
                                </select>
                            
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        
                        
                           
                         <div class="form-group">
                            <div class="col-md-6">
                                
                                <label><span class="icon-clock"></span> School Time From <span class="required">*</span></label>
                                
                                    <input type="text" class="form-control" id="inputStartitme" name="inputFrom" ng-model="inputStartitme"  placeholder="Start Time"  tabindex="1" value="" required>
                                
                            </div>
                            <div class="col-md-6">
                                <label><span class="icon-clock"></span> To <span class="required">*</span></label>
                               <input type="text" class="form-control" id="InputEndTime" name="inputTo" ng-model="InputEndTime"  placeholder="End Time"  tabindex="1" value="" required>
                            
                            </div>
                            <div id="time_error" class="required row endtimeerror">End time must be greater then start time</div>
                            <div class="clearfix"></div>
                        </div> 
                            
                         <div class="form-group ">
                            <div class="col-md-6">
                                 <label><span class="icon-calendar"></span> Start Date <span class="required">*</span></label>
                                <input type="text" class="form-control" id="inputStartdate" name="inputStartdate" ng-model="inputStartdate"  placeholder="Start Date"  tabindex="1" value="" required>
                            </div>
                            <div class="col-md-6">
                                <label><span class="icon-calendar"></span> End Date <span class="required">*</span></label>
                                <input type="text" class="form-control" id="InputEnddate" name="InputEnddate" ng-model="InputEnddate"  placeholder="End Date"  tabindex="1" value="" required></div>
                            <div id="date_error" class="required row endtimeerror">End date must be greater then start date</div>
                            <div class="clearfix"></div>
                        </div> 
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label><span class="icon-mail-alt"></span> Notes</label>
                            </div>
                            <div class="col-sm-6">
                                <textarea class="form-control"  placeholder="Notes..." id="notes" name="notes" ></textarea>
                                                        
                            </div>
                         </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="button" tabindex="8" class="btn btn-primary"  id="save" ng-click="savedatesheettable()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
                                <a tabindex="9" href="<?php echo $path_url; ?>datesheetlist" tabindex="6" title="cancel">Cancel</a>
                            </div>
                        </div>
                    </fieldset>

                <?php echo form_close();?>
        <div class="detail_area" style="display: none;">
        <a href="javascript:void(0)" ng-click="getDatesheetDetail(0)" class="btn btn-primary addmore">Add Papers</a>  
        

        <table  class="table table-striped table-bordered row-border hover">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Date</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                
                <th>Options</th>
            </tr>
        </thead>
            <tr ng-repeat="d in datesheetlistinfo"  ng-init="$last && finished()" >
                <td>{{d.subject_name}}</td>
                <td>{{d.exam_date}}</td>
                <td>{{d.exam_day}}</td>
                <td>{{d.start_time}}</td>
                <td>{{d.end_time}}</td>
                
               <td><a href="javascript:void(0)" id="{{d.detail_id}}" ng-click="getDatesheetDetail(d.detail_id)" class='edit' title="Edit">

                     <i class="fa fa-edit" aria-hidden="true"></i>

                </a>

                <a href="javascript:void(0)" title="Delete" id="{{d.detail_id}}" class="del">
                <i class="fa fa-remove" aria-hidden="true"></i>

                </a></td>
                
            </tr>
            <tr ng-hide="datesheetlistinfo.length > 0">
                <td colspan="11" class="no-record">No data found</td>
            </tr>
        </table>
    </div>
            </div>

    </div>



<div class="col-sm-10">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Paper</h3>
                
            </div>
            <div class="alert alert-success success_datesheet" style="display: none;">
              <strong>Successfully save!</strong>
            </div>
                <div class="modal-body">
                <?php $attributes = array('role'=>'form','name' => 'addquestionform', 'id' => 'addquestionform','class'=>'form-container-input');
                        echo form_open_multipart('', $attributes);?>
                    <input type="hidden" ng-model="detail_id"  name="detail_id" id="detail_id">
                    <input type="hidden" ng-model="inputQestionSerail" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="inputQestionSerail" id="inputQestionSerail">
                    <div class="form-group">
                            <div class="col-md-6">
                                <label><span class="icon-mail-alt"></span> Subject <span class="required">*</span></label>
                                 <select class="form-control" ng-options="item.name for item in subjectlist track by item.id" name="select_subject" id="select_subject" ng-change="checksche()" ng-model="inputSubject"></select>
                            </div>
                            <div class="col-md-6">
                               <label><span class="icon-calendar"></span> Date <span class="required">*</span></label>
                                <input class="form-control" type="text"  placeholder="" ng-model="exam_date" id="exam_date" name="exam_date"  value="">
                            </div>
                            <div class="clearfix"></div>
                         </div>
                    
                        <div class="form-group ">
                        <div class="col-sm-12">
                            <label><span class="icon-clock"></span> From <span class="required">*</span></label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="inputStartitme1" name="inputFrom1" ng-model="inputStartitme1"  placeholder="Start Time"  tabindex="1" value="" required>
                        </div>  
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="InputEndTime1" name="inputTo1" ng-model="InputEndTime1"  placeholder="End Time"  tabindex="1" value="" required>
                        </div>  
                            
                        </div>
                    <div class="clearfix"></div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                    <button type="button" tabindex="8" ng-click="savedatesheetdatail()" class="btn btn-default save-button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
                </div>
            <?php echo form_close();?>
        </div>
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
        // Add Detail Datesheet
        // $('.addmore').click(function(){
        //     $("#myModal").modal('show');
        // })
        $scope.getDatesheetDetail = function(detail_id)
        {
        
            try{
             
               var data = ({detail_id:detail_id})
               httprequest('<?php echo base_url(); ?>getdatesheetdetailedit',data).then(function(response){
                   if(response != null)
                   {
                        //console.log(response);
                        $scope.editresponse = response;
                        if(detail_id!=0)
                        {
                            $scope.editresponse.subject_id = response[0].subject_id;
                        
                        
                            $("#detail_id").val(response[0].id);
                            //initdatepickter('input[name="exam_date"]',new Date(response[0].exam_date));
                            
                            getSubjectList();
                            
                            $("#exam_date").val(response[0].exam_date);
                            //initdatepickter('input[name="exam_date"]',new Date(response[0].exam_date))
                            $scope.inputStartitme1 = response[0].start_time;
                             $scope.InputEndTime1 = response[0].end_time;
                        }
                        else
                        {
                        $("#detail_id").val("");
                        $scope.inputStartitme1 = "7:15";
                        $scope.InputEndTime1 = "8:15";
                        //initdatepickter('input[name="exam_date"]',new Date());
        
                         
                        }
                        
                        
                        $("#myModal").modal('show');
                   }
                   else{

                   }
               })
           }
           catch(ex){}
        }
        function initmodules()
        {
            loadclass()
            

            if($scope.serial == ''){
                $scope.inputStartitme = '<?php if(isset($result)){echo date('H:i',strtotime($result['start_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds); } ?>'
                $scope.InputEndTime = '<?php if(isset($result)){echo date('H:i',strtotime($result['end_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds + 900); } ?>'
                $scope.inputStartitme1 = '<?php if(isset($result)){echo date('H:i',strtotime($result['start_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds); } ?>'
                $scope.InputEndTime1 = '<?php if(isset($result)){echo date('H:i',strtotime($result['end_time']));}else{ $seconds = time(); $rounded_seconds = round($seconds / (15 * 60)) * (15 * 60); echo date('H:i', $rounded_seconds + 900); } ?>'
                
                $scope.exam_date = '<?php echo date('Y-m-d') ?>'
                $scope.start_date = '<?php echo date('Y-m-d') ?>'
                $scope.end_date = '<?php echo date('Y-m-d') ?>'
                $scope.type = '<?php echo "Mid" ?>'
            }
        }

        // Delete Detail id
$(document).on('click','.del',function(){

            $("#detail_modal").modal('show');

            dvalue =  $(this).attr('id');

         

            row_slug =   $(this).parent().parent().attr('id');

            

        });
$(document).on('click','#UserDelete',function(){

            $("#detail_modal").modal('hide');

            ajaxType = "GET";

            urlpath = "<?php echo $path_url; ?>Principal_controller/removeDetailDatesheet";

            var dataString = ({'id':dvalue});

            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);

        });

    function userDeleteFailureHandler()

        {

            $(".user-message").show();

            $(".message-text").text("Datesheet has been not deleted").fadeOut(10000);

        }



        function loadUserDeleteResponse(response)

        {

            if (response.message === true){
                getDetailDatesheetData();
                
                message('Record has been deleted','show');
            } 

        }

// End here
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


        $scope.savedatesheettable = function()
        {
            var session_id = $("#inputRSession").val();
            var semester_id = $("#inputSemester").val();
            var notes = $("#notes").val();
            var exam_type = $("#exam_type").val();

            var starttime = $("#inputStartitme").val();
            var endtime = $("#InputEndTime").val();
            var startdate = $("#inputStartdate").val();
            var enddate = $("#InputEnddate").val();
            message("",'hide')
            $("#time_error").hide()
            $("#date_error").hide()

            if(!$scope.select_class){
                jQuery("#select_class").css("border", "1px solid red");
                message("Please select grade",'show')
                return false;
            }
            else{
                jQuery("#select_class").css("border", "1px solid #C9C9C9");
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
            // Date Validation
            var startDate = new Date($('#inputStartdate').val());
            var endDate = new Date($('#InputEnddate').val());

            if (startDate >= endDate){
                $("#date_error").show();
                return false;
            }
            // End here
             var $this = $(".btn-primary");
             $this.button('loading');

            var formdata = new FormData();
            formdata.append('notes',notes);
            formdata.append('exam_type',exam_type);
            formdata.append('select_class',$scope.select_class.id);
            formdata.append('semester_id',$scope.filterobj.semester.id);
            formdata.append('session_id',$scope.filterobj.session.id);
            formdata.append('inputFrom',$scope.inputStartitme);
            formdata.append('inputTo',$scope.InputEndTime);
            formdata.append('inputFromdate',startdate);
            formdata.append('inputTodate',enddate);
            formdata.append('serial',$scope.serial);
            
            var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/saveMainDatesheet",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    
                    var $this = $(".btn-primary");
                    $this.button('reset');
                    if(response.message == true){
                        message('Datesheet added','show');
                        $scope.lastid =response.lastid;
                        //$('#myModal').modal('show');
                        //$('.detail_area').show();
                        
                        window.location.href = "<?php echo base_url();?>/update_datesheet/"+response.lastid;
                    }

                    if(response.message == false){
                        initmodules();
                        message('Record already exists','show')
                    }
                })
                .error(function(){
                    var $this = $(".btn-primary");
                    $this.button('reset');
                    initmodules();
                    message('Record already exists','show')
                });
        }
// Get listing after insertion 
        function getDetailDatesheetData(){
            try{
                //$scope.semesterlist = []
                var data = ({datesheetinfo:$scope.lastid})
                httprequest('<?php echo base_url(); ?>getdetaildatesheet',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {

                        $scope.datesheetlistinfo = response[0]['details'];
                        

                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }
        
        // End here
// Save Datesheet Details
$scope.savedatesheetdatail = function()
        {
            
            var subj_name = $("#select_subject").val();
            var exam_date = $("#exam_date").val();
            var starttime = $("#inputStartitme1").val();
            var endtime = $("#InputEndTime1").val();
            var detail_id = $("#detail_id").val();
            message("",'hide')
            $("#time_error").hide()


            var reg = /(\d|2[0-3]):([0-5]\d)/;

            if(reg.test(starttime) == false){
                jQuery("#inputStartitme1").css("border", "1px solid red");
                return false;
            }
            else{
                jQuery("#inputStartitme1").css("border", "1px solid #C9C9C9");
            }

            if(reg.test(endtime) == false){
                jQuery("#InputEndTime1").css("border", "1px solid red");
                return false;
            }
            else{
                jQuery("#InputEndTime1").css("border", "1px solid #C9C9C9");
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
            formdata.append('exam_date',$scope.exam_date);
            formdata.append('inputFrom',$scope.inputStartitme1);
            formdata.append('inputTo',$scope.InputEndTime1);
            formdata.append('datesheet_id',$scope.lastid);
            formdata.append('detail_id',detail_id);
            var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/saveDatesheetDetail",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    
                    var $this = $(".btn-primary");
                    $this.button('reset');
                    if(response.message == true){
                        $('.success_datesheet').show();
                        $(".success_datesheet").fadeTo(2000, 500).slideUp(500, function(){
                            $(".success_datesheet").slideUp(500);
                        });
                        getDetailDatesheetData();
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
        initdatepickter('input[name="inputStartdate"]',new Date('<?php echo date('Y-m-d') ?>'))
        initdatepickter('input[name="InputEnddate"]',new Date('<?php echo date('Y-m-d',strtotime('+1 day')) ?>'))
        
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

            $(document).ready(function() {
           $('#inputStartitme1').timepicker({
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
           $('#InputEndTime1').timepicker({
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
                    
                   

                        //console.log($scope.editresponse.subject_id);
                        //console.log("Calling");
                        var found = $filter('filter')($scope.subjectlist, {id: $scope.editresponse.subject_id}, true);
                        if(found.length)
                        {
                            $scope.inputSubject = found[0];
                        }
                        $scope.firsttimeload = false;
                    
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
