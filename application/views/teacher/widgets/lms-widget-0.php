<div class="col-lg-12" ng-controller="principal_report_controller" ng-init="processfinished=false">
    <div id="resultmodel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Quiz detail of {{screenname}}</h4>
                </div>
                <div class="modal-body" ng-init="no_data = 0;">
                    <div class="quiz" ng-if="no_data == 0">
                         <table style="width:100%;">
                            <tr ng-repeat="q in sudentquizdetail">
                                <td>
                                    <div>
                                        <p class="question" ng-if="q.thumbnail_src == ''">Q{{$index+1}}: {{q.question}}</p>
                                        <p class="question" ng-if="q.thumbnail_src != ''">Q{{$index+1}}: {{q.question}} <img  width="75"></p>
                                        <ul>
                                            <span ng-repeat="o in q.options">

                                                <span>
                                                    <!-- <span ng-if="o.iscorrect == 1"> -->
                                                    <span ng-if="o.iscorrect == 1">
                                                        <span ng-if="q.selectedoption == o.optionid">
                                                            <span class="userchecked"></span>
                                                            <input class="answer hide" id="selectedchecked_{{o.optionid}}" type="radio"  name="inputselected" value="{{o.optionid}}" checked="checked">
                                                        </span>
                                                        <span ng-if="q.selectedoption != o.optionid">
                                                        <span class="usernotchecked"></span>
                                                            <input class="answer hide" type="radio" name="inputselected" value="">
                                                        </span>
                                                    </span>
                                                    <span ng-if="o.iscorrect == 0">
                                                        <span ng-if="q.selectedoption == o.optionid">
                                                         <span class="userchecked"></span>
                                                            <input class="answer hide" id="selectedchecked_{{o.optionid}}" type="radio" name="inputselected" value="{{o.optionid}}" checked="checked">
                                                        </span>
                                                        <span ng-if="q.selectedoption != o.optionid">
                                                            <span class="usernotchecked"></span>
                                                            <input class="answer hide" type="radio" name="inputselected" value="">
                                                        </span>
                                                    </span>

                                                    <label id="correctString1" ng-if="q.qtype == 't'">{{o.optionitem}}</label>
                                                    <label id="correctString1" ng-if="q.qtype == 'i'"><img  alt="Option Image" width="75"></label>
                                                        <span ng-if="o.iscorrect == 1">
                                                    </span>
                                                    <span ng-if="o.iscorrect == 0">
                                                        <span ng-if="q.selectedoption == o.optionid">
                                                            <img src="<?php echo base_url(); ?>images/bullet_cross.png">
                                                        </span>
                                                    </span>
                                                    <span ng-if="o.iscorrect == 1">
                                                       <img src="<?php echo base_url(); ?>images/tick.png">
                                                    </span>
                                                </span>
                                                <br>
                                            </span>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div ng-if="no_data == 1;">
                        No result found
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Student Progress Report</label>
        </div>
        <!--  -->
        <div class="panel-body whide" id="progress_report" ng-class="{'loader2-background': processfinished == false}">
            <div class="loader2" ng-hide="processfinished" ></div>
            <div class="row" ng-hide="!processfinished">
                <div class="col-sm-12">
                    <form class="form-inline" >
                      <!-- <div class="form-group">
                          <label for="email">Email address:</label>
                          <input type="email" class="form-control" id="email">
                      </div> -->
                        
                        <div class="form-group">
                            <label for="select_class">Grade:</label>
                            <select class="form-control" ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="filterobj.class" ng-change="chnagefilter()"></select>
                        </div>
                        <div class="form-group">
                            <label for="inputSection">Section:</label>
                            <select class="form-control"  ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="filterobj.section" ng-change="chnagefilter()"></select>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="row padding-top" ng-hide="!processfinished">
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" ng-repeat="s in subjectlist">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#{{s.sbid}}" ng-click="closecollapse(s)">
                                        {{s.subject_name}}
                                    </a>

                                </h4>
                            </div>
                            <div id="{{s.sbid}}" class="panel-collapse collapse {{s.first_subject}}">
                                <div class="panel-body" style="overflow: auto;">
                                        <div class="panel-group" id="subject_accordion{{s.sbid}}">
                                            <div class="panel panel-default" ng-class="{'loader2-background': cprocessfinished == false}">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#subject_accordion{{s.sbid}}" href="#p_{{s.sbid}}" ng-click="open_course_progress(s)">
                                                             Course Progress
                                                        </a>
                                                         <button type="button" ng-hide="cedit || !cprocessfinished" ng-click="editProgressReport();" data-parent="#data_attributes">
                                                            Edit</button>

                                                            <button  type="button"  ng-hide="!cedit" ng-click='doneProgressReport("form_",sub.sbid,s.sid,p.semsterid,p.sessionid,p.classid)' data-parent="#data_attributes">
                                                            Save</button>
                                                    </h4>
                                                </div>
                                                <div id="p_{{s.sbid}}" class="panel-collapse collapse {{s.first_subject}}">
                                                    <div class="loader2" ng-hide="cprocessfinished"></div>
                                                    <div class="panel-body" ng-hide="!cprocessfinished">
                                                        <div ng-hide="progresslist.length <= 0 " style="overflow: auto;">
                                                            <table datatable="ng"  class="table table-striped table-bordered row-border hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Students</th>
                                                                        <th ng-repeat="p in planheader">
                                                                            {{p.date}}
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th ng-repeat="p in planheader">
                                                                            {{p.topic}} ({{p.type}})
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                 <tbody id="reporttablebody-phase-two" class="report-body" >
                                                                    <tr ng-repeat="p in progresslist"  ng-init="$last && finished()">
                                                                        <td>{{p.screenname}}</td>
                                                                        <td ng-repeat="t in p.studentplan" class="{{t.status}}" 
                                                                        id="ptd_{{s.sbid}}_{{t.lessonid}}_{{p.studentid}}" ng-click="progressChanged(s.sbid,t.lessonid, p.studentid)">
                                                                            <span >
                                                                                <input type="hidden" id="p_{{s.sbid}}_{{t.lessonid}}_{{p.studentid}}" value="{{t.status == 'read'?1:0}}"/> 
                                                                                <i id="pi_{{s.sbid}}_{{t.lessonid}}_{{p.studentid}}"  class="fa {{t.status == 'read'?'fa-check':(t.show?'fa-times':'')}}" aria-hidden="true"></i>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row" ng-hide="progresslist.length > 0">
                                                            <div class="col-sm-12">
                                                                <p class="no-record">No data found</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default" ng-class="{'loader2-background': eprocessfinished == false}">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#subject_accordion{{s.sbid}}" href="#e_{{s.sbid}}" ng-click="open_evalution(s)">
                                                            Evaluation
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="e_{{s.sbid}}" class="panel-collapse collapse custom-collapse">
                                                    <div class="loader2" ng-hide="eprocessfinished"></div>
                                                    <div class="row" style="margin: 10px 0px;">
                                                        <div class="col-sm-4 text-center">
                                                            <a href="javascript:void(0)" ng-click="addmidtermresult(p.classid,s.sid,s.sbid,p.semsterid,p.sessionid,'bt')" data-type="bt" class="btn btn-primary beforemid" style="color: #fff !important">Before Mid term Quiz Marks</a>
                                                        </div>
                                                        
                                                        <div class="col-sm-4 text-center">
                                                            <a href="javascript:void(0)" class="btn btn-primary" ng-click="addmidtermresult(p.classid,s.sid,s.sbid,p.semsterid,p.sessionid,'at')" data-type="at"  style="color: #fff !important">After Mid Term Quiz Marks</a>
                                                        </div>
                                                        <div class="col-sm-4 text-center">
                                                            <a href="javascript:void(0)"class="btn btn-primary" ng-click="addtermresult(p.classid,s.sid,s.sbid,1,p.semsterid,p.sessionid)" style="color: #fff !important">Mid and Final Marks</a>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body" ng-hide="!eprocessfinished">
                                                        <div  style="overflow: auto;">
                                                            <table datatable="ng"  class="table table-striped table-bordered row-border hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Student Name</th>
                                                                        <th ng-repeat="e in evulationarray" ng-if="e.term_status == 'bt'">
                                                                            {{e.name}}
                                                                        </th>
                                                                        <th class="exam-link" >Mid Term</th>
                                                                        <th ng-repeat="e in evulationarray" ng-if="e.term_status == 'at'">
                                                                            {{e.name}}
                                                                        </th>
                                                                        <th class="exam-link" >Final Exam</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="reporttablebody-phase-two" class="report-body">
                                                                    <tr ng-repeat="e in evulationlist" ng-init="$last && finished()">
                                                                        <td>{{e.screenname}}</td>
                                                                        <!-- <td ng-repeat="s in e.score" ng-if="s.term_status == 'bt'">
                                                                            <a href="javascript:void(0);" ng-click="viewresult(e,s.quizid)">{{s.totalpercent}}</a>
                                                                        </td> -->
                                                                        <td ng-repeat="s in e.score" ng-if="s.term_status == 'bt'">
                                                                            <a href="javascript:void(0);" >{{s.totalpercent}}</a>
                                                                        </td>
                                                                        <td>{{evulationlist[$index].term_result[0].marks}}</td>
                                                                         <td ng-repeat="s in e.score" ng-if="s.term_status == 'at'">
                                                                            <a href="javascript:void(0);" ng-click="viewresult(e,s.quizid)">{{s.totalpercent}}</a>
                                                                        </td>
                                                                        <td>{{evulationlist[$index].term_result[1].marks}}</td>
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
                         <div class="row" ng-hide="subjectlist.length > 0">
                            <div class="col-sm-12">
                                <p class="no-record">No data found</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="midtermmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <form name="quiz_submit">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Quizzes Marks Before Mid Term</h4>
                <div class="row" ng-show="evulationarray.length > 0" id="result_mid_message">Marks will be saved automatically</div>
            </div>
            
            <div class="modal-body" ng-init="no_data = 0;" style="min-height: 400px;max-height: 400px;overflow: auto;">
                <div class="panel-body" ng-hide="!eprocessfinished">
                    <div id="midbefore_container" class="marks_container"  style="overflow: auto;">
                        <table style="width: 100%;">
                        <thead>
                            <tr ng-show="evulationarray.length > 0">
                                <th>Student</th>
                                <th ng-repeat="e in evulationarray" ng-if="e.term_status == 'bt'">
                                        {{e.name}} 
                                    </th>
                                
                            </tr>
                        </thead>
                        <tbody id="resultmidbody"></tbody>
                    </table>
                    </div>
                   
                </div>
                
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
    </div>
</div>
<div id="finaltermmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <form name="quiz_submit">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Quizzes Marks After Mid Term</h4>
                <div ng-show="evulationarray.length > 0" class="row" id="result_mid_message">Marks will be saved automatically</div>
            </div>
            
            <div class="modal-body" ng-init="no_data = 0;" style="min-height: 400px;max-height: 400px;overflow: auto;">
                <div class="panel-body" ng-hide="!eprocessfinished">
                    <div id="midbefore_container" class="marks_container"  style="overflow: auto;">
                        <table style="width: 100%;">
                        <thead>

                            <tr ng-show="evulationarray.length > 0">
                                <th>Student</th>
                                <th ng-repeat="e in evulationarray" ng-if="e.term_status == 'at'">
                                        {{e.name}} 
                                    </th>
                                
                            </tr>
                        </thead>
                        <tbody id="resultfinalbody"></tbody>
                    </table>
                    </div>
                   
                </div>
                
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
    </div>
</div>
<div id="resultmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form name="quiz_submit">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Quiz detail of {{screenname}}</h4>
            </div>
            <div class="alert alert-success success_msg" style="display: none;">
              <strong>Success!</strong> 
            </div>
            <div class="alert alert-danger error_msg" style="display: none;">
              <strong>Error!</strong> 
            </div>
            <input type="hidden" name="studentid" value="{{studentid}}">
            <input type="hidden" name="quizid" value="{{quizid}}">
            <div class="modal-body" ng-init="no_data = 0;">
                <div class="quiz" ng-if="no_data == 0">
                     <table style="width:100%;">
                        <tr ng-repeat="q in sudentquizdetail">
                            <td>
                                <div>
                                    <input type="hidden" name="question_id[]" value="{{q.question_id}}">
                                    <p class="question" ng-if="q.thumbnail_src == ''">Q{{$index+1}}: {{q.question}}</p>
                                    <p class="question" ng-if="q.thumbnail_src != ''">Q{{$index+1}}: {{q.question}} <img src="{{q.thumbnail_src}}" width="75"></p>
                                    <ul>
                                        <span ng-repeat="o in q.options">

                                            <span>
                                                <!-- <span ng-if="o.iscorrect == 1"> -->
                                                <span ng-if="o.iscorrect == 1">
                                                    <span ng-if="q.selectedoption == o.optionid">
                                                        <!-- <span class="userchecked"></span> -->
                                                        <input class="answer " id="selectedchecked_{{o.optionid}}" type="radio"  name="inputselected" value="{{o.optionid}}" checked="checked">
                                                    </span>
                                                    <span ng-if="q.selectedoption != o.optionid">
                                                    <!-- <span class="usernotchecked"></span> -->
                                                        <input class="answer " type="radio" name="inputselected_{{q.question_id}}" value="{{o.optionid}}">
                                                    </span>
                                                </span>
                                                
                                                <span ng-if="o.iscorrect == 0">
                                                    <span ng-if="q.selectedoption == o.optionid">
                                                     <!-- <span class="userchecked"></span> -->
                                                        <input class="answer " id="selectedchecked_{{o.optionid}}" type="radio" name="inputselected" value="{{o.optionid}}" checked="checked">
                                                    </span>
                                                    <span ng-if="q.selectedoption != o.optionid">
                                                        <!-- <span class="usernotchecked"></span> -->
                                                        <input class="answer " type="radio" name="inputselected_{{q.question_id}}" value="{{o.optionid}}">
                                                    </span>
                                                </span>

                                                <label id="correctString1" ng-if="q.qtype == 't'">{{o.optionitem}}</label>
                                                <label id="correctString1" ng-if="q.qtype == 'i'"><img src="{{o.optionitem}}" alt="Option Image" width="75"></label>
                                                    <span ng-if="o.iscorrect == 1">
                                                </span>
                                               <!--  <span ng-if="o.iscorrect == 0">
                                                    <span ng-if="q.selectedoption == o.optionid">
                                                        <img src="<?php echo base_url(); ?>images/bullet_cross.png">
                                                    </span>
                                                </span>
                                                <span ng-if="o.iscorrect == 1">
                                                   <img src="<?php echo base_url(); ?>images/tick.png">
                                                </span> -->
                                            </span>
                                            <br>
                                        </span>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div ng-if="no_data == 1;">
                    No result found
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit_insert" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
    </div>
</div>


<div id="termmodel" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Result</h4>
                 <div class="row" id="result_message"></div>
            </div>
            <div class="modal-body" id="model_body" style="min-height: 500px;max-height: 500px;overflow: auto;">
                <div id="result_container">

                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Mid Term <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></th>
                                <th>Final Term <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></th>
                            </tr>
                        </thead>
                        <tbody id="resultbody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/angular-datatables.css">
<script src="<?php echo base_url(); ?>js/angular-datatables.min.js"></script>

<script>

    app.controller('principal_report_controller', function($scope, $http, $filter,$interval){
         $scope.filterobj = {};
         $scope.subjectlist = {};
         $scope.selected_subject = {};
         $scope.progresslist = [];
         $scope.evulationlist = [];
         $("#progress_report").show();
        var urlist = {
            progressreport:'getprogressreport',
            getcourselesson:'getcourselesson',
            getcoursedetail:'getcoursedetail',
            getevulationheader:'getevulationheader',
            getquizlist:'getquizlist',
            getlessonplan:'getlessonplan',
            getresultlist:'getresultlist',
            gettermheader:'gettermheader',
            getstudentquizdetail:'getstudentquizdetail',
            getsubjectresult:'getsubjectresult',
            savestudentmarks:'savestudentmarks',
            
            getmidtermsubjectresult:'getmidtermsubjectresult',
            getfinaltermsubjectresult:'getfinaltermsubjectresult',
            savestudentmidquizmarks:'savestudentmidquizmarks',
            
        }
        $scope.classid = '';
        $scope.sectionid = '';
        $scope.subjectid = '';
        $scope.semesterid = '';
        $scope.sessionid = '';
         $scope.finished = function()
         {
            $scope.processfinished = true;
            $scope.cprocessfinished = true;
            $scope.eprocessfinished = true;
        }

        $scope.evaulationcollapse = false;
        var rinterval
        $scope.isCourseTabActive = true;
        $scope.isExamTabActive = false;
    
        $scope.reloadcontent = function()
        {
            $scope.cprocessfinished = false;
            rinterval = $interval(function(){
                if($scope.isCourseTabActive)
                {
                    getCourseDetail($scope.subjectid,$scope.sectionid,$scope.semesterid,$scope.sessionid,$scope.classid)
                }
            },60000);
        }

        var sinterval
        $scope.reloadresult = function()
        {
            $scope.eprocessfinished = false;
            sinterval = $interval(function(){
                if($scope.isExamTabActive)
                {
                    //GetEvulationHeader($scope.subjectid,$scope.classid,$scope.sectionid,$scope.semesterid,$scope.sessionid)
                }
            },60000); 
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
                }else{
                    $scope.finished();
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

        $scope.closecollapse = function(subject)
        {
             try{
                $scope.cprocessfinished = false; 
                var myEl = angular.element( document.querySelector( '#e_'+$scope.selected_subject.sbid ) );
                myEl.collapse('hide');
                $scope.selected_subject = subject;
                $scope.evaulationcollapse = false;
                var myEl = angular.element( document.querySelector( '#p_'+$scope.selected_subject.sbid ) );
                myEl.collapse('toggle');
                getLessonPlanList();
                // Revert Edit button and array empty
                lessionarray = [];
                $scope.cedit = false;
                // end here
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
                            $scope.filterobj.semester = find_active_semester[0]  
                        }
                        getprogressreport();
                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }

        $scope.chnagefilter = function()
        {
            $scope.processfinished = false;
            getprogressreport();
        }

        $scope.opensubjectview = function(subject)
        {
            $scope.selected_subject = subject;
            console.log('opensubjectview');
            getLessonPlanList();
        }

        function getprogressreport()
        {
            try{
                var data ={
                    inputclassid:$scope.filterobj.class.id,
                    inputsectionid:$scope.filterobj.section.id,
                    inputsemesterid:$scope.filterobj.semester.id,
                    inputsessionid:$scope.filterobj.session.id,
                }

                httppostrequest('principal_subject_list',data).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.subjectlist = response;
                        $scope.selected_subject = response[0];

                        getLessonPlanList();
                        $scope.reloadcontent();
                        $scope.reloadresult();
                    }
                    else{
                        $scope.subjectlist = [];
                        $scope.processfinished = true;
                    }
                });
            }
             catch(ex){}
        }

        $scope.planheader = [];
        function getLessonPlanList()
        {
            try{
                httprequest('getcourselesson',({
                                    subjectlist:$scope.selected_subject.sbid,
                                    inputsection:$scope.filterobj.section.id,
                                    inputsemester:$scope.filterobj.semester.id,
                                    inputsession:$scope.filterobj.session.id,
                                    inputclassid:$scope.filterobj.class.id,
                                })).then(function(response){

                    if(response != null && response.length > 0)
                    {
                        $scope.planheader = response;
                        getCourseDetail();
                        
                    }
                    else{
                        $scope.finished();
                        $scope.planheader = [];
                        $scope.progresslist = [];
                        $.alert({
                            title: 'Alert!',
                            content: 'Lesson plan not found of this subject.Please add lesson plan first.',
                        });
                    }
                });
            }
             catch(ex){}
        }
// Edit code
var lessionarray = [];
$scope.progressChanged = function(subjectid,lessonid, studentid){
            if($scope.cedit){
                var read = $('#p_'+subjectid+'_'+lessonid+'_'+studentid).val()>0;
                lessionarray.push(subjectid+'_'+lessonid+'_'+studentid);
                
                $scope.statusupdate(!read, subjectid, lessonid,studentid);
                //$scope.saveLessonProgress(!read, subjectid, lessonid,studentid);
            }

            //console.log(lessionarray);
        }

$scope.editProgressReport = function(){
    //$scope.stopcontent();
    $scope.cedit = true;
    $scope.isCourseTabActive=false;
}

$scope.cancelProgressReport = function(){
    $scope.cedit = false;
    $scope.isCourseTabActive=true;
    //$scope.reloadcontent();
}

$scope.doneProgressReport = function(){
    $scope.cedit = false;
    $scope.isCourseTabActive=true;
    //$scope.reloadcontent();
    //console.log('doneProgressReport');
    //console.log(lessionarray);
    //console.log('doneProgressReport');
    if(lessionarray.length>0)
    {
        $scope.saveProgressReport(lessionarray);
    }
    
}
    // status update with array
    var str = [];
    $scope.saveProgressReport = function(lessionarray){
            //$scope.cprocessfinished = false;
            //console.log('saveProgressReport');
            //console.log(lessionarray);

            //var $container = $("#"+formid+classid+subjectid);
            //var str = $container.serializeArray();
            //str = lessionarray;
           // console.log(str);
             dataString = lessionarray ; // array?
             var jsonString = JSON.stringify(dataString);
            $.ajax({
                url:'UpdateSemesterLessonProgress',
                type: 'POST',
                data: {data : jsonString}, 
                success: function(res){
                    if(res==1){
                        getCourseDetail(subjectid,sectionid,semesterid,sessionid,classid);
                        $scope.cedit = false;
                        $scope.isCourseTabActive=true;
                        $scope.reloadcontent();
                    }else{
                        alert("Unable to save progress at the moment.");
                    }
                    $scope.cprocessfinished = true;
                    //$this.button('reset');
                },
                error: function(){
                    alert("Fail to save progress at the moment.");
                    $scope.cprocessfinished = true;
                    //$this.button('reset');
                }
            });
        }  
    // End here
        // $scope.saveProgressReport = function(formid,subjectid,sectionid,semesterid,sessionid,classid){
        //     $scope.cprocessfinished = false;
        //         var $container = $("#"+formid+classid+subjectid);
        //          var str = $container.serializeArray();
        //         $.ajax({
        //             url:'UpdateSemesterLessonProgress',
        //             type: 'POST',
        //             data: str,
        //             success: function(res){
        //                 if(res==1){
        //                     getCourseDetail(subjectid,sectionid,semesterid,sessionid,classid);
        //                     $scope.cedit = false;
        //                     $scope.isCourseTabActive=true;
        //                     $scope.reloadcontent();
        //                 }else{
        //                     alert("Unable to save progress at the moment.");
        //                 }
        //                 $scope.cprocessfinished = true;
        //                 //$this.button('reset');
        //             },
        //             error: function(){
        //                 alert("Fail to save progress at the moment.");
        //                 $scope.cprocessfinished = true;
        //                 //$this.button('reset');
        //             }
        //         });
        // }   
        // Toggal read and unread
        $scope.statusupdate = function(isread, subjectid, lessonid,studentid){
                isread = isread?1:0;
                //console.log("saveLessonProgress lessonid "+ lessonid + " studentid "+ studentid + " status "+ isread);
                if(isread)
                {
                    $('#pi_'+subjectid+'_'+lessonid+'_'+studentid).addClass('fa-check');
                    $('#pi_'+subjectid+'_'+lessonid+'_'+studentid).removeClass('fa-times');
                
                    $('#ptd_'+subjectid+'_'+lessonid+'_'+studentid).removeClass('unread');
                    $('#ptd_'+subjectid+'_'+lessonid+'_'+studentid).addClass('read');
                }else{
                    $('#pi_'+subjectid+'_'+lessonid+'_'+studentid).removeClass('fa-check');
                    $('#pi_'+subjectid+'_'+lessonid+'_'+studentid).addClass('fa-times');

                    $('#ptd_'+subjectid+'_'+lessonid+'_'+studentid).removeClass('read');
                    $('#ptd_'+subjectid+'_'+lessonid+'_'+studentid).addClass('unread');
                }
                
                
            }

        // End here
        $scope.saveLessonProgress = function(isread, subjectid, lessonid,studentid){
                isread = isread?1:0;
                console.log("saveLessonProgress lessonid "+ lessonid + " studentid "+ studentid + " status "+ isread);
                $.ajax({
                    url:'UpdateLessonProgress',
                    type: 'POST',
                    data: {'lessonid': lessonid, 'studentid': studentid, 'isread': isread},
                    success: function(json){
                        console.log(json);
                        try{
                            var res = $.parseJSON(json);
                            if(res.message==true){
                                read = (res.status == 'read');
                                $('#p_'+subjectid+'_'+res.lessonid+'_'+res.studentid).val(read?1:0);

                                if(read){
                                    $('#pi_'+subjectid+'_'+res.lessonid+'_'+res.studentid).addClass('fa-check');
                                    $('#pi_'+subjectid+'_'+res.lessonid+'_'+res.studentid).removeClass('fa-times');
                                
                                    $('#ptd_'+subjectid+'_'+res.lessonid+'_'+res.studentid).removeClass('unread');
                                    $('#ptd_'+subjectid+'_'+res.lessonid+'_'+res.studentid).addClass('read');
                                }else{
                                    $('#pi_'+subjectid+'_'+res.lessonid+'_'+res.studentid).removeClass('fa-check');
                                    $('#pi_'+subjectid+'_'+res.lessonid+'_'+res.studentid).addClass('fa-times');

                                    $('#ptd_'+subjectid+'_'+res.lessonid+'_'+res.studentid).removeClass('read');
                                    $('#ptd_'+subjectid+'_'+res.lessonid+'_'+res.studentid).addClass('unread');
                                }
                            }else{
                                console.log("Unable to save progress at the moment.");
                            }
                        }catch(e){console.log(e);}
                    },
                    error: function(){
                        alert("Fail to save progress at the moment.");
                        //$scope.cprocessfinished = true;
                        //$this.button('reset');
                    }
                });
            }
        $scope.c_no_data = 0;
        function getCourseDetail()
        {
             try{
                httprequest('getcoursedetail',({
                                    subjectlist:$scope.selected_subject.sbid,
                                    inputsection:$scope.filterobj.section.id,
                                    inputsemester:$scope.filterobj.semester.id,
                                    inputsession:$scope.filterobj.session.id,
                                    inputclassid:$scope.filterobj.class.id,
                                })).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        
                        clearInterval(rinterval);
                        $scope.progresslist = response;
                    }
                    else{
                        $scope.progresslist = [];
                        $scope.finished();
                    }
                });
            }
             catch(ex){}
        }

         $scope.evulationarray = [];
        function GetEvulationHeader()
        {
             try{
                httprequest('getevulationheader',({
                                    subjectlist:$scope.selected_subject.sbid,
                                    inputclassid:$scope.filterobj.class.id,
                                    inputsectionid:$scope.filterobj.section.id,
                                    inputsemester:$scope.filterobj.semester.id,
                                    inputsession:$scope.filterobj.session.id})).then(function(response){
                    getQuizDetail();

                    if(response != null && response.length > 0)
                    {

                        $scope.evulationarray = response;
                        
                    }else{
                        $scope.evulationarray = [];
                        $scope.finished();
                    }
                });
            }
             catch(ex){}
        }


         function getQuizDetail()
        {
             try{
                httprequest('getquizlist',({   
                                    subjectlist:$scope.selected_subject.sbid,
                                    inputclassid:$scope.filterobj.class.id,
                                    inputsectionid:$scope.filterobj.section.id,
                                    inputsemester:$scope.filterobj.semester.id,
                                    inputsession:$scope.filterobj.session.id})).then(function(response){

                    if(response != null)
                    {
                        $scope.evulationlist = response;
                    }
                    else{
                        $scope.evulationlist = [];
                        $scope.finished();
                    }
                });

            }
            catch(ex){

            }
        }

        $scope.viewresult = function(student,quizid)
        {

            try{
               //console.log(quizid);  
               var quizid = quizid;
               $('.success_msg').hide();
               $('.error_msg').hide();
                httprequest(urlist.getstudentquizdetail,({studentid:student.studentid,quizid:quizid})).then(function(response){
                    
                    if(response != null &&  response.length > 0)
                    {
                        $scope.screenname = student.screenname;
                        $scope.studentid = student.studentid;
                        $scope.quizid = quizid;
                        $scope.sudentquizdetail = response;
                        
                        
                        $("#resultmodel").modal('show')
                    }
                    else{
                        $scope.sudentquizdetail = [];
                    }
                });
               
            }
            catch(ex){}
        }
        function getTermHeader(subjectid)
        {
            try{
                httprequest(urlist.gettermheader,({subjectlist:subjectid})).then(function(response){
                    if(response != null)
                    {
                         $("#subject_result_"+subjectid+" #table-header").html(" ");
                        $("#subject_result_"+subjectid+" #table-footer").html(" ");
                        var cont_str = '';
                         $("#subject_result_"+subjectid+" #table-header").append("<th> </th>");
                         $("#subject_result_"+subjectid+" #table-footer").append("<th> </th>");
                        for (var i = 0; i <= response.length-1; i++) {
                            $("#subject_result_"+subjectid+" #table-header").append("<th>"+response[i].name+"</th>");
                            $("#subject_result_"+subjectid+" #table-footer").append("<th>"+response[i].name+"</th>");
                        };
                    }
                });

            }
            catch(ex){}
        }

        $scope.r_no_data = 0;
        function getSubjectResult(subjectid)
        {
            try{
                httprequest(urlist.getresultlist,({subjectlist:subjectid})).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.r_no_data = 0;
                         var cont_str = '';
                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str +='<tr>';
                            cont_str += '<td>'+response[i].screenname+'</td>';
                            for (var k = 0; k <= response[i].result.length - 1; k++) {
                               cont_str += '<td>'+response[i].result[k].marks+'</td>';
                            }
                            cont_str += '</tr>';
                        }

                        $("#subject_result_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#subject_result_"+subjectid).dataTable().fnDestroy();
                        $("#subject_result_"+subjectid+" #reporttablebody-phase-two").html(cont_str);
                        $compile(cont_str)($scope);
                        loaddatatable("subject_result_"+subjectid);

                    }
                    else{
                        $("#subject_result_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#subject_result_"+subjectid).dataTable().fnDestroy();
                        $scope.r_no_data = 0;
                        loaddatatable("subject_result_"+subjectid);
                       // $scope.r_no_data = 1;
                    }

                });
            }
            catch(ex){}
        }
        
        
        
        var studentData = [];
         var container = document.getElementById('result_container');
         $scope.subjid = 0
        $scope.addmidtermresult = function(classid,sectionid,subjectid,semesterid,sessionid,type)
        {
            try{
                 $scope.subjid = subjectid;
                 var cont_str = '';
                studentData = [];
                
                httprequest(urlist.getmidtermsubjectresult,({
                                class_id:$scope.filterobj.class.id,
                                section_id:$scope.filterobj.section.id,
                                subject_id:subjectid,
                                semesterid:$scope.filterobj.semester.id,
                                sessionid:$scope.filterobj.session.id,
                                quiz_type:type,
                                })).then(function(response){
                    //getQuizDetail(subjectid,classid,sectionid,semsterid,sessionid)
                    //console.log(subjectid+"subject_name"+classid+"sectionid"+sectionid+"semesterid"+semesterid+"sessionid"+sessionid);
                    GetEvulationHeader(subjectid,classid,sectionid,semesterid,sessionid);
                    
                    if(response != null &&  response.length > 0)
                    {
                        
                        var columnname = ['m','f'];
                        var quiz_total_marks = '<?php echo QUIZ_TOTAL_MARKS ?>';
                        var quizid = 0;
                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str += '<tr>'
                            cont_str += '<td width="60%">'+response[i].name+'</td>';
                            //console.log(response);
                            for (var k = 0; k < response[i].quizid.length; k++) {
                                //console.log(response[i].quizid[k].quizid);
                                cont_str += '<td width="20%"><input type="number" min="0" max="'+quiz_total_marks+'" name="term_result" id="mid_result" data-studentsemesterid= "'+$scope.filterobj.semester.id+'" data-studentsessionid= "'+$scope.filterobj.session.id+'" data-studentid = "'+response[i].studentid+'" data-marksid = "'+response[i].id+'" data-classid = "'+$scope.filterobj.class.id+'" data-sectionid = "'+$scope.filterobj.section.id+'" data-subjectid = "'+subjectid+'"  data-column ="m"  data-quizid="'+response[i].quizid[k].quizid+'" value="'+response[i].marks[k].studentmarks+'"/></td>'
                            }
                           cont_str += '</tr>'
                        }

                        if(type=='bt')
                        {
                            $("#resultmidbody").html(cont_str)
                        }
                        else
                        {

                            $("#resultfinalbody").html(cont_str)
                        }
                    }
                    else{
                        if(type=='bt')
                        {
                            $("#resultmidbody").html("<tr><td colspan='3' class='text-center'>No Quizzes found</td></tr>")
                        }
                        else
                        {
                            $("#resultfinalbody").html("<tr><td colspan='3' class='text-center'>No Quizzes found</td></tr>")
                        }
                    }
                });

                $scope.classid = classid;
                $scope.sectionid = sectionid;
                $scope.subjectid = subjectid;
                 $scope.semesterid = semesterid;
                 $scope.sessionid = sessionid;
                $("#result_message").html('Marks will be saved automatically')
                if(type=='bt')
                {
                    $("#midtermmodal").modal('show');
                }
                else
                {
                    $("#finaltermmodal").modal('show');
                }
                $scope.isExamTabActive = false;
            }
            catch(ex){}

        }
        $(document).on('change','#mid_result',function(){
            if($(this).val().length > 0 && $(this).val() >= 0 && $(this).val() <= 100 ){
              var data = {
                    cellvalue:$(this).val(),
                    cellcolumn:$(this).attr('data-column'),
                    cellid:$(this).attr('data-marksid'),
                    classid:$(this).attr('data-classid'),
                    sectionid:$(this).attr('data-sectionid'),
                    subjectid:$(this).attr('data-subjectid'),
                    quizid:$(this).attr('data-quizid'),
                    studentid:$(this).attr('data-studentid'),
                    semesterid:$(this).attr('data-studentsemesterid'),
                    sessionid:$(this).attr('data-studentsessionid'),
                }
                $("#result_message").html('Saving mark')
                try{
                   httppostrequest(urlist.savestudentmidquizmarks,data).then(function(response){
                        //console.log(response);
                        if(response != null && response.message  == true)
                        {
                            $("#result_mid_message").html('Mark saved');
                        }else{
                            $("#result_mid_message").html('Mark not saved');
                        }
                    });
                }
                catch(ex){}
            }
        });
        var studentData = [];
         var container = document.getElementById('result_container');
         $scope.subjid = 0
        // $scope.addfinaltermresult = function(classid,sectionid,subjectid,semesterid,sessionid)
        // {
        //     try{
        //          $scope.subjid = subjectid
        //         studentData = [];
        //         var cont_str = '';
        //         httprequest(urlist.getfinaltermsubjectresult,({
        //                         class_id:classid,
        //                         section_id:sectionid,
        //                         subject_id:subjectid,
        //                         semesterid:semesterid,
        //                         sessionid:sessionid,
        //                         })).then(function(response){
        //             GetEvulationHeader(subjectid,classid,sectionid,semesterid,sessionid);
        //             if(response != null &&  response.length > 0)
        //             {
                        
        //                 var columnname = ['m','f']
        //                 for (var i = 0; i <= response.length-1; i++) {
        //                     cont_str += '<tr>'
        //                     cont_str += '<td width="60%">'+response[i].name+'</td>'
        //                     for (var k = 0; k < response[i].marks.length; k++) {
        //                         cont_str += '<td width="20%"><input type="number" min="0" max="100" name="term_result" id="mid_result" data-studentsemesterid= "'+semesterid+'" data-studentsessionid= "'+sessionid+'" data-studentid = "'+response[i].studentid+'" data-marksid = "'+response[i].id+'" data-classid = "'+classid+'" data-sectionid = "'+sectionid+'" data-subjectid = "'+subjectid+'"  data-column ="'+columnname[k]+'"  data-quizid="'+response[i].quizid[k].quizid+'" value="'+response[i].marks[k].studentmarks+'"/></td>'
        //                     }
        //                    cont_str += '</tr>'
        //                 }
        //                 $("#resultfinalbody").html(cont_str)
        //             }
        //             else{
        //                 $("#resultfinalbody").html("<tr><td colspan='3' class='text-center'>No Quizzes found</td></tr>")
        //             }
        //         });

        //         $scope.classid = classid;
        //         $scope.sectionid = sectionid;
        //         $scope.subjectid = subjectid;
        //          $scope.semesterid = semesterid;
        //          $scope.sessionid = sessionid;
        //         $("#result_message").html('Marks will be saved automatically')
        //         $("#finaltermmodal").modal('show');
        //         $scope.isExamTabActive = false;
        //     }
        //     catch(ex){}

        // }
        
        var studentData = [];
         var container = document.getElementById('result_container');
         $scope.subjid = 0
        $scope.addtermresult = function(classid,sectionid,subjectid,termid,semesterid,sessionid)
        {
            try{
                 $scope.subjid = subjectid
                studentData = [];
                httprequest(urlist.getsubjectresult,({
                                class_id:$scope.filterobj.class.id,
                                section_id:$scope.filterobj.section.id,
                                subject_id:subjectid,
                                semesterid:$scope.filterobj.semester.id,
                                sessionid:$scope.filterobj.session.id,
                                term_id:termid})).then(function(response){
                    if(response != null &&  response.length > 0)
                    {
                        var cont_str = '';
                        var columnname = ['m','f']
                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str += '<tr>'
                            cont_str += '<td width="60%">'+response[i].name+'</td>'
                            for (var k = 0; k < response[i].marks.length; k++) {
                                if(columnname[k]=='m')
                                {
                                    var term_total_marks = '<?php echo MID_TOTAL_MARKS ?>';
                                }
                                else
                                {
                                    var term_total_marks = '<?php echo FINAL_TOTAL_MARKS ?>';
                                }
                                cont_str += '<td width="20%"><input type="number" min="0" max="'+term_total_marks+'" name="term_result" id="term_result" data-studentsemesterid= "'+$scope.filterobj.semester.id+'" data-studentsessionid= "'+$scope.filterobj.session.id+'" data-studentid = "'+response[i].studentid+'" data-marksid = "'+response[i].id+'" data-classid = "'+$scope.filterobj.class.id+'" data-sectionid = "'+$scope.filterobj.section.id+'" data-subjectid = "'+subjectid+'" data-termid = "'+termid+'" data-column ="'+columnname[k]+'" value="'+response[i].marks[k].studentmarks+'"/></td>'
                            }
                           cont_str += '</tr>'
                        }
                        $("#resultbody").html(cont_str)
                    }
                    else{
                        $("#resultbody").html("<tr><td colspan='3'>No student in class</td></tr>")
                    }
                });

                $scope.classid = classid;
                $scope.sectionid = sectionid;
                $scope.subjectid = subjectid;
                 $scope.semesterid = semesterid;
                 $scope.sessionid = sessionid;
                $("#result_message").html('Marks will be saved automatically')
                $("#termmodel").modal('show');
                $scope.isExamTabActive = false;
            }
            catch(ex){}
        }

        $('#termmodel').on('hidden.bs.modal', function () {
            $scope.isExamTabActive = true;
            getQuizDetail($scope.subjid,$scope.classid,$scope.sectionid,$scope.semesterid,$scope.sessionid)

            
        })
        // before mid modal hide
        $('#midtermmodal').on('hidden.bs.modal', function () {
            $scope.isExamTabActive = true;
            getQuizDetail($scope.subjid,$scope.classid,$scope.sectionid,$scope.semesterid,$scope.sessionid)

            
        })
        // after mid modal hide
        $('#finaltermmodal').on('hidden.bs.modal', function () {
            $scope.isExamTabActive = true;
            getQuizDetail($scope.subjid,$scope.classid,$scope.sectionid,$scope.semesterid,$scope.sessionid)

            
        })
        
        $(document).on('change','#term_result',function(){
            if($(this).val().length > 0 && $(this).val() >= 0 && $(this).val() <= 100 ){
              var data = {
                    cellvalue:$(this).val(),
                    cellcolumn:$(this).attr('data-column'),
                    cellid:$(this).attr('data-marksid'),
                    classid:$(this).attr('data-classid'),
                    sectionid:$(this).attr('data-sectionid'),
                    subjectid:$(this).attr('data-subjectid'),
                    termid:$(this).attr('data-termid'),
                    studentid:$(this).attr('data-studentid'),
                    semesterid:$(this).attr('data-studentsemesterid'),
                    sessionid:$(this).attr('data-studentsessionid'),
                }
                $("#result_message").html('Saving mark')
                try{
                   httppostrequest(urlist.savestudentmarks,data).then(function(response){
                        //console.log(response);
                        if(response != null && response.message  == true)
                        {
                            $("#result_message").html('Mark saved');
                        }else{
                            $("#result_message").html('Mark not saved');
                        }
                    });
                }
                catch(ex){}
            }
        });

        function initresult()
        {
            var hot = new Handsontable(container, {
                colHeaders: ["ID","Studentid", "Student", "Mid Term", "Final Term"],
                startRows: 100,
                startCols: 4,
                rowHeaders: true,
                manualRowResize: true,
                columnSorting: true,
                sortIndicator: true,
                stretchH: 'all',
                autoColSize: true,
                manualColumnResize: true,
                contextMenu: false,
                colWidths: [120,80,80,50],
                columns: [
                    {},
                    {},
                    {readOnly: true},
                    {type: 'numeric', format: '00.00'},
                    {type: 'numeric', format: '00.00'}
                ],
                afterChange: function (change, source) {
                    if (source === 'loadData') {
                        return; //don't save this change
                    }
                    var id = hot.getDataAtCell(parseInt(change[0][0]),0)
                },
            });

            hot.loadData(studentData)
        }

        $scope.open_course_progress = function(subject)
        {
            $scope.cprocessfinished = false; 
            $scope.selected_subject = subject;
            $scope.evaulationcollapse = false;
            getLessonPlanList();
        }

        $scope.open_evalution = function(subject)
        {
            $scope.eprocessfinished = false;
            $scope.selected_subject = subject;
            $scope.evaulationcollapse = true;
  
            GetEvulationHeader();
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
    });
</script>
