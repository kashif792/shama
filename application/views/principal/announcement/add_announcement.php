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

                <p>Are you sure you want to send this Message?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="SendAnn" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div>
<div id="stop_modal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to stop this Message?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="StopAnn" class="btn btn-default " value="save">Yes</button>

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
            <label>Add Announcement </label>
        </div>
        <div class="panel-body">
                <?php $attributes = array('name' => 'schedule_timetable', 'id' => 'schedule_timetable','class'=>'form-horizontal'); echo form_open('', $attributes);?>
                     <input type="hidden" name="serial" id="serial" ng-model="serial">
                     <fieldset>
                        
                        <div class="form-group">
                            <div class="col-md-6">
                                
                                <label><span class="icon-user"></span> Title <span class="required">*</span></label>
                                
                                    <input type="text" class="form-control" name="title" id="title"  ng-model="title">
                                
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>

                        
                         <div class="form-group">
                            <div class="col-sm-12">
                                <label><span class="icon-mail-alt"></span>Message</label>
                            </div>
                            <div class="col-sm-6">
                                <textarea class="form-control long_desc"  placeholder="Message..." ng-model="message" id="paigam" name="paigam"  ></textarea>
                                                        
                            </div>
                         </div>
                         <div class="form-group">
                           
                            <div class="col-md-6">
                               <label><span class="icon-user"></span> Target <span class="required">*</span></label>
                                <select class="form-control"  id="target" name="target" ng-model="select_target" ng-change="changetarget()">
                                <option value="">--Select Target--</option>
                                <option>Individual</option>
                                <option>School</option>
                                <option>Staff</option>
                                <option>Student</option>
                                </select>
                            
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group recipient_no" style="display: none;">
                           
                            <div class="col-md-6">
                               <label><span class="icon-mobile"></span> Recipient Number <span class="required">*</span></label>
                                <input type="text" name="individual_no" id="individual_no" ng-model="individual_no" class="form-control">
                            
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                               <label><span class="icon-home"></span> Reference <span class="required">*</span></label>
                                <input type="text" name="reference" id="reference" ng-model="reference" class="form-control">
                            
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group staff_student" style="display: none;">
                           
                            <div class="col-md-6">
                               <label><input type="checkbox" value="all_grade" name="checkall" ng-model="checkall" ng-click="checkUncheckAll()" /> All Grade</label>
                            </div>
                            <div class="clearfix"></div>
                            <div ng-repeat="c in classlist" class="grade_label">
                                 <label><input type="checkbox" value="{{ c.id }}" name="grade_name" ng-model="c.checked" ng-change='updateCheckall()' /> {{c.name}} </label>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="button" tabindex="8" class="btn btn-primary save"  id="save" ng-click="addAnnouncement()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
                                <a tabindex="9" href="<?php echo $path_url; ?>announcementlist" tabindex="6" title="cancel">Cancel</a>
                            </div>
                        </div>
                        <div class="form-group sendbtn" style="display: none">
                            <div class="col-sm-12">
                                <button type="button" tabindex="8" class="btn btn-primary send"  id="send" ng-click="sendAnnouncement()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Sending...">Send</button>
                                <button type="button" tabindex="8" class="btn btn-primary stop"  id="stop" ng-click="stopAnnouncement()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Stoping..." style="display: none">Stop</button>
                                
                            </div>
                        </div>
                        
                    </fieldset>

                <?php echo form_close();?>
        
            </div>

    <div class="col-md-12 table_record" style="display: none;">
        <table class="table table-striped table-bordered row-border hover" id="table-body-phase-tow">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Phone Number</th>
                    <th>Date Time</th>
                    <th>User</th>
                    <th>Target Type</th>
                    <th>Status</th>
                 </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    </div>
</div>
<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>
<script src="<?php echo base_url(); ?>js/angular-datatables.min.js"></script>

<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

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
        $scope.select_target="";
        $scope.editresponse = [];
        $scope.firsttimeload = false;
        $scope.requests = [];
        //$scope.classlist = [];
        angular.element(function(){
            if($scope.serial == '')
            {
                initmodules();
            }

            if($scope.serial != '')
            {
                $scope.firsttimeload = true;

                
            }
        });
/* checkbox */
$scope.checkUncheckAll = function () {
   if ($scope.checkall) {
    $scope.checkall = true;
   } else {
    $scope.checkall = false;
   }
   angular.forEach($scope.classlist, function (c) {
    c.checked = $scope.checkall;
   });
  };

  $scope.updateCheckall = function($index,c){
           
    var userTotal = $scope.classlist.length;
    var count = 0;
    angular.forEach($scope.classlist, function (item) {
       if(item.checked){
         count++;
       }
    });

    if(userTotal == count){
       $scope.checkall = true;
    }else{
       $scope.checkall = false;
    }
  };
/* ENd here */
$scope.changetarget = function()
        {
            var target_val = $("#target").val();
            if(target_val=='Individual')
            {
                $('.recipient_no').show();
                $('.staff_student').hide();
            }
            else if(target_val=='School')
            {
                $('.recipient_no').hide();
                $('.staff_student').hide();
            }
            else if(target_val=='Staff' || target_val=='Student')
            {
                $('.recipient_no').hide();
                $('.staff_student').show();
                loadclass();
                
            }
        }
        
        function loadclass()
        {
            if($scope.classlist != null && $scope.classlist.length > 0 && $scope.firsttimeload == false)
            {
                 $scope.select_class = $scope.classlist[0];

                 //loadSections();
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
        
        function initmodules()
        {

        }

       

// End here
        


        $scope.addAnnouncement = function()
        {
            
            var title = $("#title").val();
            var paigam = $("#paigam").val();
            var target = $("#target").val();

            message("",'hide')
            $("#time_error").hide()
            $("#date_error").hide()

            if(!$scope.select_target){
                jQuery("#select_target").css("border", "1px solid red");
                message("Please select target",'show')
                return false;
            }
            else{
                jQuery("#select_target").css("border", "1px solid #C9C9C9");
            }
            if(target=='Individual')
            {
                if(!$scope.individual_no)
                {
                    message("Please Enter Number",'show')
                    return false;
                }
                if(!$scope.reference)
                {
                    message("Please Enter Reference",'show')
                    return false;
                }
                
            }
            if(target=='Individual')
            {
                var individual_no = $("#individual_no").val();
                var reference = $("#reference").val();
            }
            if(target=='Staff' || target =='Student')
            {
                var checkall = $('input[name="checkall"]:checked').val();
                if(checkall!='all_grade')
                {
                    var grade = [];
                    $.each($("input[name='grade_name']:checked"), function(){
                        grade.push($(this).val());
                    });
                    if(grade.length==0)
                    {
                        message("Please Select at least one grade",'show')
                        return false;
                    }
                }
            }
            // End here
             var $this = $(".save");
             $this.button('loading');

            var formdata = new FormData();
            formdata.append('paigam',paigam);
            formdata.append('title',title);
            formdata.append('target',target);
            if(target=='Individual')
            {
                formdata.append('individual_no',individual_no);
                formdata.append('reference',reference);
            }
            if(target=='Staff' || target =='Student')
            {
                
                var checkall = $('input[name="checkall"]:checked').val();
                if(checkall!='all_grade')
                {
                    formdata.append('grade',grade);
                }
                else
                {
                    formdata.append('checkall',true);
                }
            }

            formdata.append('serial',$scope.serial);
            
            var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/saveAnnouncement",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    
                    var $this = $(".save");
                    $this.button('reset');
                    if(response.message == true){
                        message('Announcement Successfully Added ','show');
                        $scope.serial =response.lastid;
                        $('.sendbtn').show();
                    }
                    
                })
                .error(function(){
                    var $this = $(".save");
                    $this.button('reset');
                    initmodules();
                    message('Something is wrong!','show')
                });
        }
        $scope.isCourseTabActive=false;
        $scope.sendAnnouncement = function()
        {
            
            $("#detail_modal").modal('show');
            
            $(document).on('click','#SendAnn',function(){
                
            $("#detail_modal").modal('hide');
            // End here
            $('.table_record').show();
            $scope.reloadcontent();
            $scope.isCourseTabActive=true;
            //$("#save").attr("disabled", true);
            $("#save").hide();
            $(".save").addClass("disabled");
            $("#stop").show();
            
             var $this = $(".send");
             $this.button('loading');
            var title = $("#title").val();
            var paigam = $("#paigam").val();
            var target = $("#target").val();
            var formdata = new FormData();

            if(target=='Individual')
            {
                var individual_no = $("#individual_no").val();
                var reference = $("#reference").val();
            }
            if(target=='Staff' || target =='Student')
            {
                var checkall = $('input[name="checkall"]:checked').val();
                if(checkall!='all_grade')
                {
                    var grade = [];
                    $.each($("input[name='grade_name']:checked"), function(){
                        grade.push($(this).val());
                    });
                    
                }
            }
            if(target=='Individual')
            {
                formdata.append('individual_no',individual_no);
                formdata.append('reference',reference);
            }
            if(target=='Staff' || target =='Student')
            {
                
                var checkall = $('input[name="checkall"]:checked').val();
                if(checkall!='all_grade')
                {
                    formdata.append('grade',grade);
                }
                else
                {
                    formdata.append('checkall',true);
                }
            }
            formdata.append('paigam',paigam);
            formdata.append('title',title);
            formdata.append('target',target);
            formdata.append('serial',$scope.serial);
            
            var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/sendAnnouncement",
                data: formdata,
                headers: {'Content-Type': undefined}
            };

            $http(request)
                .success(function (response) {
                    
                    if(response.message == true){
                        //message('Message sent Successfully ','show');
                        // $("#send").html("Sent");
                        // $("#send").attr("disabled", true);
                        // $("#stop").hide();
                        //$scope.isCourseTabActive=false;
                        $scope.isCourseTabActive=true;
                        $("#stop").show();
                        $scope.getAnnouncementData();
                    }
                    
                })
                .error(function(){
                    var $this = $(".send");
                    $this.button('reset');
                    initmodules();
                    message('Something is wrong!','show')
                });
                });
        }

        // when start time change, update minimum for end timepicker

        var clearRequest = function(request){
            $scope.requests.splice($scope.requests.indexOf(request), 1);
        };
        $scope.stopAnnouncement = function(request)
        {

            // request.cancel("User cancelled");
            // clearRequest(request);
            $("#stop_modal").modal('show');
            
            $(document).on('click','#StopAnn',function(){
            $("#stop_modal").modal('hide');
            var formdata = new FormData();
            formdata.append('serial',$scope.serial);
            
            
            var request = {
                method: 'POST',
                url: "<?php echo $path_url; ?>Principal_controller/stopAnnouncement",
                data: formdata,
                headers: {'Content-Type': undefined}
            };
            $http(request)
                .success(function (response) {
                    
                    
                    if(response.message == true){
                        message('Stop Successfully ','show');
                        $("#send").html("Send");
                        $(".send").removeClass("disabled");
                        $(".send").removeAttr("disabled");
                        $("#stop").hide();
                        //$scope.stopAnnouncementData();
                        $scope.isCourseTabActive = true;
                        
                    }
                    
                })
                .error(function(){
                    var $this = $(".save");
                    $this.button('reset');
                    initmodules();
                    message('Something is wrong!','show')
                });
            })
        }
        // Get Annoucement Table
        $scope.getAnnouncementData = function()
        {
            try{
                    var data ={
                        serial:$scope.serial,
                    }
                    //console.log(data);
                    httppostrequest('getAnnouncementDetailList',data).then(function(response){
                        $scope.data = [];
                        if(response.length > 0 && response != null)
                        {
                            for (var i=0; i<response[0]['listarray'].length; i++) {
                                $scope.data.push(response[0]['listarray'][i]);
                            }
                            
                            $("#table-body-phase-tow").dataTable().fnDestroy();
                            $scope.loaddatatable($scope.data);
                            
                            if(response[0]['data_array']=="Stop")
                            {
                                message('Message sent Successfully ','show');
                                 $("#send").html("Sent");
                                 $("#send").hide();
                                 $("#stop").hide();
                                $scope.isCourseTabActive=false;

                            }
                            
                        }
                        else{
                            $scope.list = [];
                        }
                    });
                }
            catch(e){}
        }
        $scope.stopAnnouncementData = function()
        {
            try{
                    var data ={
                        serial:$scope.serial,
                    }
                    //console.log(data);
                    httppostrequest('stopAnnouncementDetailList',data).then(function(response){
                        $scope.data = [];
                        if(response.length > 0 && response != null)
                        {
                            for (var i=0; i<response[0]['listarray'].length; i++) {
                                $scope.data.push(response[0]['listarray'][i]);
                            }
                            
                            $("#table-body-phase-tow").dataTable().fnDestroy();
                            $scope.loaddatatable($scope.data);
                            
                        }
                        else{
                            $scope.list = [];
                        }
                    });
                }
            catch(e){}
        }
        $(document).ready(function(){
        $scope.loaddatatable = function(data)
        {
            var listdata= data;
            
            var table = $('#table-body-phase-tow').DataTable( {
                data: listdata,
                responsive: true,
                "order": [[ 0, "asc"  ]],
                rowId: 'id',
                columns: [
                    { data: 'id' },
                    { data: 'phone_number' },
                    { data: 'created_at' },
                    { data: 'user_id' },
                    { data: 'target_type' },
                    { data: 'status' },
                    
                ],

                "pageLength": 10,

            })
        }
    })
        $scope.reloadcontent = function()
        {

            rinterval = $interval(function(){
                if($scope.isCourseTabActive)
                {
                    $scope.getAnnouncementData();
                }
            },3000);
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
        function httppostrequest(url,data)
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


