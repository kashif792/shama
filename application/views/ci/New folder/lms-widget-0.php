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
        <div class="panel-body" ng-class="{'loader2-background': processfinished == false}">
            <div class="loader2" ng-hide="processfinished" ></div>
            <div class="row" ng-hide="!processfinished">
                <div class="col-sm-12">
                    <form class="form-inline" >
                      <!-- <div class="form-group">
                          <label for="email">Email address:</label>
                          <input type="email" class="form-control" id="email">
                      </div> -->
                        <div class="form-group">
                            <label for="inputRSession">Session:</label>
                            <select  class="form-control" ng-options="item.name for item in rsessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="filterobj.session" ng-change="chnagefilter()" ></select>
                        </div>
                        <div class="form-group">
                            <label for="select_class">Grade:</label>
                            <select class="form-control" ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="filterobj.class" ng-change="chnagefilter()"></select>
                        </div>
                        <div class="form-group">
                            <label for="inputSection">Section:</label>
                            <select class="form-control"  ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="filterobj.section" ng-change="chnagefilter()"></select>
                        </div>
                        <div class="form-group">
                            <label for="inputSemester">Semester:</label>
                            <select class="form-control" ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester" ng-change="chnagefilter()"></select>
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
                                    <a data-toggle="collapse" data-parent="#accordion" href="#{{s.sbid}}">
                                        {{s.subject_name}}
                                    </a>
                                </h4>
                            </div>
                            <div id="{{s.sbid}}" class="panel-collapse collapse {{s.first_subject}}">
                                <div class="panel-body" style="overflow: auto;">
                                        <div class="panel-group" id="subject_accordion">
                                            <div class="panel panel-default" ng-class="{'loader2-background': cprocessfinished == false}">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#subject_accordion" href="#p_{{s.sbid}}" ng-click="open_course_progress(s)">
                                                             Course Progress
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="p_{{s.sbid}}" class="panel-collapse collapse {{s.first_subject}}" >
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
                                                                            {{p.name}}
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th ng-repeat="p in planheader">
                                                                            {{p.type}}
                                                                        </th>
                                                                    </tr>    
                                                                </thead>
                                                                <tbody id="reporttablebody-phase-two" class="report-body" >
                                                                    <tr ng-repeat="p in progresslist"  ng-init="$last && finished()">
                                                                        <td>{{p.screenname}}</td>
                                                                        <td ng-repeat="s in p.studentplan" ng-class="s.status">
                                                                            <span ng-hide="s.status != 'unread'"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                            <span ng-hide="s.status != 'read'"></span>
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
                                                        <a data-toggle="collapse" data-parent="#subject_accordion" href="#e_{{s.sbid}}" ng-click="open_evalution(s)">
                                                            Evaluation
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="e_{{s.sbid}}" class="panel-collapse collapse" >
                                                    <div class="loader2" ng-hide="eprocessfinished"></div>
                                                    <div class="panel-body" ng-hide="!eprocessfinished">
                                                        <div  ng-hide="evulationarray.length <= 0" style="overflow: auto;">
                                                            <table datatable="ng" ng-hide="evulationarray.length <= 0" class="table table-striped table-bordered row-border hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th ng-repeat="e in evulationarray" ng-if="e.term_status == 'bt'">
                                                                            {{e.name}}
                                                                        </th>
                                                                        <th>Mid Term</th>
                                                                        <th ng-repeat="e in evulationarray" ng-if="e.term_status == 'at'">
                                                                            {{e.name}}
                                                                        </th>
                                                                        <th>Final Term</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="reporttablebody-phase-two" class="report-body">
                                                                    <tr ng-repeat="e in evulationlist" ng-init="$last && finished()">
                                                                        <td>{{e.screenname}}</td>
                                                                        <td ng-repeat="s in e.score" ng-if="s.term_status == 'bt'">
                                                                            <a href="javascript:void(0);" ng-click="viewresult(e,s.quizid)">{{s.correntanswer}}/{{s.total_question}}</a>
                                                                        </td>
                                                                        <td>{{evulationlist[$index].term_result[0].marks}}</td>
                                                                         <td ng-repeat="s in e.score" ng-if="s.term_status == 'at'">
                                                                            <a href="javascript:void(0);" ng-click="viewresult(e,s.quizid)">{{s.correntanswer}}/{{s.total_question}}</a>
                                                                        </td>
                                                                        <td>{{evulationlist[$index].term_result[1].marks}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row" ng-hide="evulationarray.length > 0">
                                                            <div class="col-sm-12">
                                                                <p class="no-record">No data found</p>
                                                            </div>
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

         $scope.finished = function()
         {
            $scope.processfinished = true;
            $scope.cprocessfinished = true;
            $scope.eprocessfinished = true;
         }

        var rinterval
        function reloadcontent()
        {
            $scope.cprocessfinished = false;
            rinterval = $interval(function(){
               getCourseDetail();
            },200000000);
        }

        var sinterval
        function reloadresult()
        {
             $scope.eprocessfinished = false;
            sinterval = $interval(function(){
                getQuizDetail();
            },200000000);
        }

        function getSessionList()
        {
            httprequest('getsessiondetail',({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.rsessionlist = response
                    $scope.filterobj.session = response[0]
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
                        var find_active_semester = $filter('filter')(response,{status:'a'},true);
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

                httppostrequest('getsubjectlistprogressreport',data).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.subjectlist = response;
                        $scope.selected_subject = response[0];
                        getLessonPlanList();
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
                        $.alert({
                            title: 'Alert!',
                            content: 'Lesson plan not found of this subject.Please add lesson plan first.',
                        });
                    }
                });
            }
             catch(ex){}
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
                        $scope.progresslist = response;
                        reloadcontent();
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
                    if(response != null && response.length > 0)
                    {
                        $scope.evulationarray = response;
                        getQuizDetail();
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
                        reloadresult();
                    }
                    else{
                        $scope.evulationlist = [];
                    }
                });

            }
            catch(ex){

            }
        }

         $scope.viewresult = function(student,quizid)
        {
            try{

                httprequest('getstudentquizdetail',({studentid:student.studentid,quizid:quizid})).then(function(response){
                    if(response != null &&  response.length > 0)
                    {
                        $scope.screenname = student.screenname;
                        $scope.sudentquizdetail = response;
                        $("#resultmodel").modal('show');
                    }
                    else{
                        $scope.sudentquizdetail = [];
                    }
                });
            }
            catch(ex){}
        }

        $scope.open_course_progress = function(subject)
        {
            $scope.cprocessfinished = false; 
            $scope.selected_subject = subject;
            getLessonPlanList();
        }

        $scope.open_evalution = function(subject)
        {
            $scope.eprocessfinished = false;
            $scope.selected_subject = subject;
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
