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
                        <label>Final Result Card</label>
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
                                        <label for="inputSection">Section:</label>
                                        <select class="form-control"  ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="filterobj.section" ng-change="changeclass()"></select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="inputSemester">Semester:</label>
                                        <select class="form-control"    ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester" ng-change="changeclass()"></select>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="inputDate">Student:</label>
                                            <select  class="form-control" ng-options="item.name for item in studentlist track by item.id"  name="InputStudent" id="InputStudent"  ng-model="filterobj.studentid" ng-change="changestudent()" >
                                                <option style="display:none" value="">Select Student</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row padding-top">
                            <div class="col-sm-12">
                                <div>
                                           <div>
                                            <table  class="table table-striped table-bordered row-border hover">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Mid Term Marks</th>
                                                <th>Final Term Marks</th>
                                                <th>Sessional Marks</th>
                                                <th>Obtained Marks</th>
                                                <th>Total Marks</th>
                                                <th>Grade</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="report-body">
                                            
                                            <tr ng-show="subjectlist.length > 0">
                                                <td class="blue_back">Total Marks</td>
                                                <td class="blue_back">{{total_mid_marks}}</td>
                                                <td class="blue_back">{{total_final_marks}}</td>
                                                <td class="blue_back">{{total_sessional_marks}}</td>
                                                <td class="blue_back"></td>
                                                <td class="blue_back"></td>
                                                <td class="blue_back"></td>
                                                
                                            </tr>
                                            <tr ng-repeat="s in subjectlist"  ng-init="$last && finished()" >
                                                <td>{{s.subject}}</td>
                                                <td>{{s.evalution[0].mid}}</td>
                                                <td>{{s.evalution[0].final}}</td>
                                                <td>{{s.evalution[0].sessional_marks}}</td>
                                                <td>{{s.evalution[0].student_obtain_subject_marks}}</td>
                                                <td>{{s.evalution[0].final_subject_total_marks}}</td>
                                                <td>{{s.evalution[0].grade}}</td>
                                                
                                            </tr>
                                            <tr ng-show="subjectlist.length > 0">
                                                <td class="blue_back">Total Obtained Marks</td>
                                                <td class="blue_back">{{obtain_marks}}</td>
                                                <td class="blue_back">{{final_total_marks}}</td>
                                                <td class="blue_back">{{session_total_marks}}</td>
                                                <td class="blue_back">{{student_total_obtain_subject_marks}}</td>
                                                <td class="blue_back">{{final_count_subject_total_marks}}</td>
                                                <td class="blue_back">{{grade}}</td>
                                                
                                            </tr>
                                             <tr ng-hide="subjectlist.length > 0">
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
                    loadSections();
                }
            });
        }

        getClassList();

        function loadSections()
        {
            try{
                var data = ({inputclassid:$scope.filterobj.class.id})
                httprequest('getsectionbyclass',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.sectionslist = response;
                        $scope.filterobj.section = response[0];
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
                $scope.semesterlist = []
                httprequest('<?php echo $path_url; ?>getsemesterdata',({})).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.semesterlist = response;
                        var find_active_semester = $filter('filter')(response,{active_semster:'a'},true);
                        
                        if(find_active_semester.length > 0)
                        {
                            
                            $scope.filterobj.semester = find_active_semester[0]  ;
                            $scope.getSubjectList();
                            $scope.loadStudentByClass();
                        }

                        // var temp = {
                        //     id:'b',
                        //     name:'Both',
                        //     status:'i'
                        // }

                        // $scope.semesterlist.push(temp);
                        
                    
                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }

        $scope.toogleform = function()
        {
            $scope.is_form_toggle = !$scope.is_form_toggle;
        }

        $scope.getSubjectList = function()
        {
            try{
                if($scope.filterobj.class && $scope.filterobj.semester)
                {
                     var data ={
                        inputclassid:$scope.filterobj.class.id,
                        inputsemesterid:$scope.filterobj.semester.id,
                        inputsessionid:$scope.filterobj.session.id,
                    }
                    
                    httppostrequest('classreportsubjects',data).then(function(response){
                        if(response.length > 0 && response != null)
                        {
                            //$scope.subjectlist = response;
                             
                            $scope.filterobj.subjectid = response[0];
                           // $scope.GetEvulationHeader();
                           
                        }
                        else{
                            $scope.subjectlist = [];
                         
                        }
                    });
                }
            }
            catch(e){}
        }
        

        $scope.selectedSubject = function(subject,index)
        {
            $scope.filterobj.subjectid = subject;
            $scope.eprocessfinished = false;
            getQuizDetail();
        }

        $scope.changeclass = function()
        {
            //$scope.getSubjectList();
            $scope.loadStudentByClass();
            $scope.active = 1;
        }



        
        $scope.finished = function()
        {
            $scope.processfinished = true;
            $scope.eprocessfinished = true;
        }


        $scope.renderprintdata = function()
        {
            try{

                var docDefinition = {
                    pageOrientation: 'landscape',
                    content: [
                        {text:'Class Report',style:'report_header'},
                        {
                            margin: [0, 10, 0, 5],
                            columns: [
                               {
                                    width: '*',
                                    text: 'Grade: '+$scope.filterobj.class.name+"-"+$scope.filterobj.section.name+'-'+$scope.filterobj.semester.name,
                                    alignment: 'left',
                                },
                                 {
                                    width: '*',
                                    text: 'Session: '+$scope.filterobj.session.name,
                                    alignment: 'right',
                                },
                            ]
                        },
                        {
                            margin: [0, 5, 0, 5],
                            columns: [
                               {
                                    width: '*',
                                    text: 'Campus: <?php echo $schoolname."-".$campuscity; ?>',
                                    alignment: 'left',
                                },
                               {
                                    width: '*',
                                    text: 'Subject: '+$scope.filterobj.subjectid.name,
                                    alignment: 'right',
                                },
                            ]
                        },
                        table($scope.evulationlist,$scope.evalution_header,["screenname","score","term_result"]),
                   ],

                    styles: {
                        report_header: {
                            fontSize: 24,
                            bold: true,
                            alignment: 'center'
                        }
                    }
                };
                return docDefinition;
            }
            catch(e){}
        }

        $scope.printreport = function()
        {
            var reportobj = $scope.renderprintdata();
         
            pdfMake.createPdf(reportobj).print();
        }

      $scope.download = function()
        {
            var reportobj = $scope.renderprintdata();
            if($scope.filterobj.semester.id == 'b')
            {
                var filename = decodeURIComponent($scope.filterobj.class.name)+"-"+decodeURIComponent($scope.filterobj.section.name)+"-final";
            }
            else{
                var filename = decodeURIComponent($scope.filterobj.class.name)+"-"+decodeURIComponent($scope.filterobj.section.name)+"-"+decodeURIComponent($scope.filterobj.semester.name);
            }
            
             pdfMake.createPdf(reportobj).download(filename);
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
        $scope.loadStudentByClass = function()
        {
            
            try{
                var data = ({   
                    inputclassid:$scope.filterobj.class.id,
                    inputsectionid:$scope.filterobj.section.id,
                    inputsemesterid:$scope.filterobj.semester.id,
                    inputsessionid:$scope.filterobj.session.id,
                    
                });
             
                httprequest('<?php echo base_url(); ?>getstudentbyclass',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.studentlist = response;

                        var is_student_found = $filter('filter')(response,{id:studentid},true);
                        
                        if(is_student_found.length > 0)
                        {
                            studentid = false;
                            $scope.InputStudent = is_student_found[0];
                        }else{
                            $scope.InputStudent = response[0];

                        }
                        
                        $scope.loading = false;
                        $scope.getGradedata();
                    }
                    else{
                        $scope.studentlist = [];
                        $scope.fallsemester = [];
                        $scope.springsemester = [];
                        message('','hide')
                    }
                })
            }
            catch(ex){
                console.log(ex)
            }
        }

        $scope.getGradedata = function()
        {
            try{
            

            var data ={
                inputclassid:$scope.filterobj.studentid.id,
                inputclassid:$scope.filterobj.class.id,
                inputsectionid:$scope.filterobj.section.id,
                //inputsemesterid:$scope.filterobj.semester.id,
                inputsessionid:$scope.filterobj.session.id,
                inputstudentid:$scope.filterobj.studentid.id,
                
            }

            httppostrequest('<?php echo base_url(); ?>finalstudentreportdata',data).then(function(response){
                console.log(response);
                if(response.length > 0)
                {
                    //$scope.subjectlist = response;
                    $scope.subjectlist = response[0].result;
                    
                     $scope.grade = response[0].grade;
                     $scope.obtain_marks = response[0].obtain_marks;
                     $scope.final_total_marks = response[0].final_total_marks;
                     $scope.session_total_marks = response[0].session_total_marks;
                     $scope.final_count_subject_total_marks = response[0].final_count_subject_total_marks;
                     $scope.student_total_obtain_subject_marks = response[0].student_total_obtain_subject_marks;
                     $scope.percent = response[0].percent;
                     $scope.grade = response[0].grade;
                     $scope.total_mid_marks = response[0].total_mid_marks;
                     $scope.total_final_marks = response[0].total_final_marks;
                     $scope.total_sessional_marks = response[0].total_sessional_marks;
                }
                else{
                    $scope.resultlist = [];
                    $scope.fallsemester = [];
                    $scope.springsemester = [];
                }
            });
           }
            catch(ex){
                console.log(ex)
            }
           
        }
  });
</script>

<style type="text/css">
    form.tab-form-demo .tab-pane {
        margin: 20px 20px;
    }
</style>
