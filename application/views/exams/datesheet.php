<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>
<div class="col-sm-10 col-md-10 col-lg-10 class-page "  ng-controller="class_report_ctrl" ng-init="processfinished=false">
    <?php
        // require_footer
        require APPPATH.'views/__layout/filterlayout.php';
    ?>
   
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <!-- widget title -->
                   <div class="panel-heading">
                    <label>Datesheet List
                           &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>add_mid_datesheet" class="btn btn-primary" style="color: #fff !important;">Mid Term Datesheet</a>
                           &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>add_final_datesheet" class="btn btn-primary" style="color: #fff !important;">Final Term Datesheet</a>
                 
                    </label>
                    <label class="right-controllers">
                            <a href="javascript:void(0)" class="link-student" ng-click="printreport()" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </label>
                        <label class="right-controllers">
                            <a href="javascript:void(0)" class="link-student" ng-click="download()" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </label>
                </div>
                    <div class="panel-body whide" id="class_report" >
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-inline" >
                                   
                                    <div class="form-group">
                                        <label for="inputRSession">Session:</label>
                                        <select  class="form-control" ng-options="item.name for item in rsessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="filterobj.session" ng-change="changeclass()" ></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="select_class">Grade:</label>
                                        <select class="form-control" ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="filterobj.class" ng-change="changeclass()"></select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputSemester">Semester:</label>
                                        <select class="form-control"    ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester" ng-change="changeclass()"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="select_class">Type:</label>
                                        <select class="form-control" name="inputType" id="inputType" ng-model="filterobj.type" ng-change="changeclass()">
                                            <option>Mid</option>
                                            <option>Final</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row padding-top canvas_div_pdf">

                            <div class="col-sm-12">
                                <div>
                                           <div>
                                            <table  class="table table-striped table-bordered row-border hover">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Grade</th>
                                            <th>Semester</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Duration (min)</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                        <tbody class="report-body">
                                           <tr ng-repeat="d in datesheetlist"  ng-init="$last && finished()" >
                                                <td>{{d.type}}</td>
                                                <td>{{d.grade}}</td>
                                                <td>{{d.semester_name}}</td>
                                                <td>{{d.subject_name}}</td>
                                                <td>{{d.exam_date}}</td>
                                                <td>{{d.exam_day}}</td>
                                                <td>{{d.start_time}}</td>
                                                <td>{{d.end_time}}</td>
                                                <td>{{d.duration}}</td>
                                                <td><a href="<?php echo $path_url; ?>edit_datesheet/{{d.id}}" id="{{d.id}}" class='edit' title="Edit">

                                                     <i class="fa fa-edit" aria-hidden="true"></i>

                                                </a>

                                                <a href="#" title="Delete" id="{{d.id}}" class="del">
                                                <i class="fa fa-remove" aria-hidden="true"></i>

                                                </a></td>
                                                
                                            </tr>
                                            
                                             <tr ng-hide="datesheetlist.length > 0">
                                                <td colspan="11" class="no-record">No data found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                               
                                            </div>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>

<script src="<?php echo base_url(); ?>js/angular-datatables.min.js"></script>
<script src="<?php echo base_url(); ?>js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>js/vfs_fonts.js"></script>
<script src="<?php echo  base_url(); ?>js/ui-bootstrap-tpls-2.5.0.js"></script>

<script type="text/javascript">
    var app = angular.module('invantage', ['daterangepicker','ui.bootstrap']);

    app.filter('periodtime', function myDateFormat($filter){
        return function(text){
            var  tempdate= new Date(text);
            return $filter('date')(tempdate, "medium");
        }
    });

    app.controller('class_report_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile,$filter){
        $scope.filterobj = {};
        defaultdate();

       $scope.active = 1;
        $scope.fallsemester = [];
        $scope.type = [];

        $("#class_report").show();
         // Initialize default date
        function defaultdate()
        {
            try{
                
                $scope.filterobj.date = {
                    startDate:moment().format('MMM D, YY'),
                    endDate: moment().format('MMM D, YY'),
                };

                $scope.options = {
                    
                    eventHandlers:{
                        'apply.daterangepicker': function(ev, picker){
                            var sdate = $scope.filterobj.date.startDate.format('MMM D, YY');
                            var edate = $scope.filterobj.date.endDate.format('MMM D, YY');
                            $scope.filterobj.start_date =sdate;
                            $scope.filterobj.end_date =edate;
                            //$scope.GetEvulationHeader();
                        }
                    }
                };
            }
            catch(ex)
            {
                console.log(ex)
            }
        }

        function getSessionList()
        {

            httprequest('getsessiondetail',({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.rsessionlist = response
                    
                     var find_active_session = $filter('filter')(response,{status:'a'},true);
                    if(find_active_session.length > 0)
                    {
                        
                        $scope.filterobj.session = find_active_session[0]
                        $scope.getDatesheetData();
                    }
                }
                else{
                    $scope.finished();
                }
            });
        }
        
        getSessionList();

        function getClassList()
        {
            httprequest('getclasslist',({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.classlist = response
                    $scope.filterobj.class = response[0]
                    
                    $scope.getDatesheetData();
                }
            });
        }

        getClassList();

        function getTypeList()
        {
            httprequest('gettypelist',({})).then(function(response){
                //console.log(response.length);
                if(response != null && response.length > 0)
                {
                    console.log(response[0]['Mid']);
                    $scope.type = response
                    $scope.filterobj.type = response[0]['Mid'];
                    
                    $scope.getDatesheetData();
                }
            });
        }
        getTypeList();
      
        $scope.toogleform = function()
        {
            $scope.is_form_toggle = !$scope.is_form_toggle;
        }
        
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
                            $scope.getDatesheetData();
                        }

                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }
        getSemesterData();
        $scope.getDatesheetData = function()
        {
            try{
                if($scope.filterobj.class && $scope.filterobj.session.id && $scope.filterobj.semester)
                {
                     var data ={
                        inputclassid:$scope.filterobj.class.id,
                        inputsessionid:$scope.filterobj.session.id,
                        inputsemesterid:$scope.filterobj.semester.id,
                        inputtype:$scope.filterobj.type,
                    }
                    console.log(data);
                    httppostrequest('getdateseet',data).then(function(response){
                        console.log(response)
                        if(response.length > 0 && response != null)
                        {
                            $scope.datesheetlist = response;
                             
                           // $scope.filterobj.subjectid = response[0];
                           // $scope.GetEvulationHeader();
                           
                        }
                        else{
                            $scope.datesheetlist = [];
                         
                        }
                    });
                }
            }
            catch(e){}
        }
        

        $scope.changeclass = function()
        {
            $scope.getDatesheetData();
            
            $scope.active = 1;
            

        }



        
        $scope.finished = function()
        {
            $scope.processfinished = true;
            $scope.eprocessfinished = true;
        }
        // Generate PDF
        


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
            return (request.then(responseSuccess,responseFail))
        }

        function responseSuccess(response){
            return (response.data);
        }

        function responseFail(response){
            return (response.data);
        }
        

        $scope.changestudent = function()
        {
           $scope.getGradedata();
           
        }

         $scope.loading = false;
        
  });

    
</script>
