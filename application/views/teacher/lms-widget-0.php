<div class="col-lg-12 progress-widget" ng-controller="progress_ctrl" id="progress">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Progress Report</label>
        </div>
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default" ng-repeat="p in progressreportlist">
                    <div class="panel-heading">
                        <h4 class="panel-title grade">
                            <a data-toggle="collapse" class="{{p.cssclass}}" data-parent="#accordion" href="#{{p.classid}}">
                            {{p.classname}}</a>
                        </h4>
                    </div>
                    <div id="{{p.classid}}" class="panel-collapse collapse {{p.cssclass}}">
                
                        <div class="panel-body">
                            <div class="panel-group" id="sec_{{p.classid}}">
                                <div class="panel panel-default" ng-repeat="s in p.sectionlist">
                                    <div class="panel-heading">
                                        <h4 class="panel-title sectionheading">
                                            <a data-toggle="collapse" class="section {{s.cssclass}}" data-parent="#sec_{{p.classid}}" href="#sectioncollapse_{{s.sid}}">
                                                {{s.section_name}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="sectioncollapse_{{s.sid}}" class="panel-collapse collapse {{s.cssclass}}">
                                        <div class="panel-body">
                                            <div class="panel-group" id="sectioncontainer_{{s.sid}}">
                                                <div class="panel panel-default" ng-repeat="sub in s.subjectlist">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title subjectheading">
                                                            <a data-toggle="collapse" class="subject {{sub.cssclass}}" data-parent="#sectioncontainer_{{s.sid}}" href="#sub_{{sub.sbid}}{{s.sid}}">
                                                                {{sub.subject_name}}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="sub_{{sub.sbid}}{{s.sid}}" class="panel-collapse collapse {{sub.cssclass}}">
                                                        <div class="panel-body">
                                                            <div class="panel-group" id="data_attributes">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title cheading">
                                                                            <a data-toggle="collapse" class="detail-section {{sub.cssclass}}" ng-click="getSubjectProgressReport(sub.sbid,s.sid,p.semsterid,p.sessionid,p.classid)" data-parent="#data_attributes" href="#c{{sub.sbid}}{{s.sid}}">
                                                                            Course Progress</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="c{{sub.sbid}}{{s.sid}}" class="panel-collapse collapse in">
                                                                        <div class="panel-body col-sm-12" style="overflow: auto;">
                                                                            <div ng-if="c_no_data == 0" >
                                                                                <table class="table table-bordered course_progress" id="course_progress_{{sub.sbid}}{{s.sid}}">
                                                                                     <thead>
                                                                                           <tr id="table-header-date"></tr> 
                                                                                           <tr id="table-header-title"></tr> 
                                                                                           <tr id="table-header-type"></tr> 
                                                                                    </thead>
                                                                                    <tfoot >
                                                                                       <tr id="table-footer"></tr>
                                                                                    </tfoot>
                                                                                    <tbody id="reporttablebody-phase-two" class="report-body"></tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div ng-if="c_no_data == 1" class="no_data">
                                                                                No data found
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title eheading">
                                                                            <a data-toggle="collapse" class="detail-section" data-parent="#data_attributes" ng-click="getSubjectEvualtionReport(p.classid,s.sid,sub.sbid,p.semsterid,p.sessionid)" href="#evulation_{{sub.sbid}}{{s.sid}}">
                                                                            Evaluation</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="evulation_{{sub.sbid}}{{s.sid}}" class="panel-collapse collapse">
                                                                        <div class="panel-body col-sm-12" style="overflow: auto;">
                                                                            <div ng-if="e_no_data == 0" class="lesson-plan" >
                                                                                <table class="table table-bordered" id="evulationtable_{{sub.sbid}}{{s.sid}}">
                                                                                    <thead >
                                                                                        <tr id="table-header">
                                                                                        </tr>
                                                                                    </thead>
                                                                                   <!--  <tfoot >
                                                                                        <tr id="table-footer">
                                                                                        </tr>
                                                                                    </tfoot> -->
                                                                                    <tbody id="reporttablebody-phase-two" class="report-body"></tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div ng-if="e_no_data == 1" class="no_data">
                                                                                No data found
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div ng-if="progress_no_data == 1;" class="no_data">
                <p>No subject allocated yet</p>
            </div>
        </div>
    </div>

<div id="resultmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Quiz Detail Of {{screenname}}</h4>
            </div>
            <div class="modal-body" ng-init="no_data = 0;">
                <div class="quiz" ng-if="no_data == 0">
                     <table style="width:100%;">
                        <tr ng-repeat="q in sudentquizdetail">
                            <td>
                                <div>
                                    <p class="question">Q{{$index+1}}: {{q.question}}</p>
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
                                                <label id="correctString1">{{o.optionitem}}</label>
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
                   
                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Mid Term</th>
                                <th>Final Term</th>
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
<script src="http://handsontable.com/dist/jquery.handsontable.full.js"></script>
<link rel="stylesheet" media="screen" href="http://handsontable.com/dist/jquery.handsontable.full.css">
<link rel="stylesheet" media="screen" href="http://handsontable.com/demo/css/samples.css">
<script>

    app.controller('progress_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile){

        function loaddatatable(elementint)
        {
            $('#'+elementint).DataTable( {
              
                "autoWidth": true,
                "ordering": false,
     
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                        });
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        });
                    });
                }
            });
        }

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
        }

        $scope.classid = '';
        $scope.sectionid = '';
        $scope.subjectid = '';
        $scope.semesterid = '';
        $scope.sessionid = '';

        $scope.progressreportlist= []
        angular.element(function () { 
            getprogressreport()
           
        });

        function getprogressreport()
        {
            try{
                httprequest(urlist.progressreport,({})).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.progressreportlist = response
                        $scope.progress_no_data = 0;
                        getLessonPlanList(response[0].sectionlist[0].subjectlist[0].sbid,response[0].sectionlist[0].sid,response[0].semsterid,response[0].sessionid,response[0].classid)
                        
                    }
                    else{
                        $scope.progress_no_data = 1;
                    }
                });                
            }
             catch(ex){}
        }

        $scope.getSubjectProgressReport = function(subjid,sectionid,semsterid,sessionid,classid){
            var check = angular.element("#"+subjid).hasClass('in');
            if(check == false)
            {  
                $("#course_progress_"+subjid+'tbody').empty();
                getLessonPlanList(subjid,sectionid,semsterid,sessionid,classid)
            }
            
        }


        $scope.getSubjectEvualtionReport = function(classid,sectionid,subjectid,semsterid,sessionid)
        {
            var check = angular.element("#evulation_"+subjectid).hasClass('in');
            if(check == false)
            {
                GetEvulationHeader(subjectid,classid,sectionid,semsterid,sessionid)
                getQuizDetail(subjectid,classid,sectionid,semsterid,sessionid)
            }
        }
        
         $scope.getPlanList = function(subjectid)
        {
            var check = angular.element("#lessonplan_"+subjectid).hasClass('in');
            if(check == false)
            {
                getPlanDetail(subjectid)
            }
            
        }

        
        $scope.getResultReport = function(subjectid)
        {
            var check = angular.element("#result_"+subjectid).hasClass('in');
            if(check == false)
            {
                getTermHeader(subjectid)
                getSubjectResult(subjectid)
            }
        }

        $scope.planheader = []
        function getLessonPlanList(subjectid,sectionid,semsterid,sessionid,classid)
        {
             try{
                httprequest(urlist.getcourselesson,({
                                    subjectlist:subjectid,
                                    inputsection:sectionid,
                                    inputsemester:semsterid,
                                    inputsession:sessionid,
                                    inputclassid:classid,
                                })).then(function(response){
                    if(response != null)
                    {
                        $scope.planheader = response
                        $("#course_progress_"+subjectid+sectionid+" #table-header-date").html(' ');
                        $("#course_progress_"+subjectid+sectionid+" #table-header-title").html(' ');
                        $("#course_progress_"+subjectid+sectionid+" #table-header-type").html(' ');
                        $("#course_progress_"+subjectid+sectionid+" #table-footer").html(' ');
                        var cont_str = '';
                        $("#course_progress_"+subjectid+sectionid+" #table-header-date").append("<th>Students</th>");
                        $("#course_progress_"+subjectid+sectionid+" #table-header-title").append("<th></th>");
                        $("#course_progress_"+subjectid+sectionid+" #table-header-type").append("<th></th>");
                        $("#course_progress_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                        
                        for (var i = 0; i <= response.length-1; i++) {
                            $("#course_progress_"+subjectid+sectionid+" #table-header-date").append("<th>"+response[i].date+"</th>");
                        };
                        
                        for (var i = 0; i <= response.length-1; i++) {
                             $("#course_progress_"+subjectid+sectionid+" #table-header-title").append("<th>"+response[i].name+"</th>");
                             $("#course_progress_"+subjectid+sectionid+" #table-footer").append("<th>"+response[i].name+"</th>");
                        };
                        for (var i = 0; i <= response.length-1; i++) {
                            $("#course_progress_"+subjectid+sectionid+" #table-header-type").append("<th>"+response[i].type+"</th>");
                        };
                        getCourseDetail(subjectid,sectionid,semsterid,sessionid,classid)
                    }
                });
            }
             catch(ex){}
        }

        $scope.c_no_data = 0;
        function getCourseDetail(subjectid,sectionid,semsterid,sessionid,classid)
        {
             try{
       
                httprequest(urlist.getcoursedetail,({subjectlist:subjectid,inputsection:sectionid,
                                    inputsemester:semsterid,
                                    inputsession:sessionid,
                                    inputclassid:classid,
                                })).then(function(response){
                    if(response != null && response.length > 0)
                    {  
                        $scope.c_no_data = 0;
                        var cont_str = '';
                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str +='<tr>';
                            cont_str += '<td>'+response[i].screenname+'</td>';
                            for (var k = 0; k <= response[i].studentplan.length - 1; k++) {
                               cont_str += '<td class="'+response[i].studentplan[k].status+'">'+response[i].studentplan[k].status+'</td>'; 
                            }
                            cont_str += '</tr>';
                        }
                      
                        $("#course_progress_"+subjectid+sectionid+" #reporttablebody-phase-two").html(" ");
                        $("#course_progress_"+subjectid+sectionid).dataTable().fnDestroy();
                        $("#course_progress_"+subjectid+sectionid+" #reporttablebody-phase-two").html(cont_str);
                        $scope.dataloader  = 0;
                        loaddatatable("course_progress_"+subjectid+sectionid);
                    }
                    else{
                        $("#course_progress_"+subjectid+sectionid).dataTable().fnDestroy();
                        loaddatatable("course_progress_"+subjectid+sectionid);
                        $scope.c_no_data = 0;
                    }
                });
            }
             catch(ex){}
        }

        $scope.midterm = 0;
        $scope.evulationarray = [];
        function GetEvulationHeader(subjectid,classid,sectionid,semsterid,sessionid)
        {

             try{
                httprequest(urlist.getevulationheader,({
                                    subjectlist:subjectid,
                                    inputclassid:classid,
                                    inputsectionid:sectionid,
                                    inputsemester:semsterid,
                                    inputsession:sessionid})).then(function(response){

                    if(response != null && response.length > 0)
                    {
                        $scope.evulationarray = response;

                        $("#evulationtable_"+subjectid+sectionid+" #table-header").html(" ");
                        $("#evulationtable_"+subjectid+sectionid+" #table-footer").html(" ");
                        $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th></th>");
                        $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                        var bt_end = false ;
                        var headerlenght = response.length-1;
                        $scope.midterm = countTotalBeforeMidterm(response) - 1

                        for (var i = 0; i <= headerlenght; i++) {
                             if(bt_end == false && response[i].term_status == 'bt')
                            {
                                $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th>"+response[i].name+"</th>");
                                $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th>"+response[i].name+"</th>");
                            }


                            if($scope.midterm == i && response[i].term_status == 'bt' && bt_end == false){
                                bt_end = true
                                $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th><a onclick='angular.element(this).scope().addtermresult("+response[i].class+","+response[i].section+","+response[i].subject+",1,"+response[i].semesterid+","+response[i].sessionid+")'>Mid Term</a></th>");
                                $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                            }

                            
                            if(bt_end == true && response[i].term_status == 'at')
                            {
                                $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th>"+response[i].name+"</th>");
                                 $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th>"+response[i].name+"</th>");
                            }

                            
                            if(i == headerlenght)
                            {
                                $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th><a onclick='angular.element(this).scope().addtermresult("+response[i].class+","+response[i].section+","+response[i].subject+",2,"+response[i].semesterid+","+response[i].sessionid+")'>Final Term</a></th>");
                                $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                            }
                        };
                    }else{

                        $("#evulationtable_"+subjectid+sectionid+" #table-header").html(" ");
                        $("#evulationtable_"+subjectid+sectionid+" #table-footer").html(" ");
                      
                        $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th></th>");
                        $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                        $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th><a onclick='angular.element(this).scope().addtermresult("+classid+","+sectionid+","+subjectid+",1,"+semsterid+","+sessionid+")'>Mid Term</a></th>");
                        $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                        $("#evulationtable_"+subjectid+sectionid+" #table-header").append("<th><a onclick='angular.element(this).scope().addtermresult("+classid+","+sectionid+","+subjectid+",2,"+semsterid+","+sessionid+")'>Final Term</a></th>");
                        $("#evulationtable_"+subjectid+sectionid+" #table-footer").append("<th></th>");
                    }
                });
            }
             catch(ex){}
        }

        function countTotalBeforeMidterm(response)
        {
            if(response.length > 0)
            {
                var current_iter = 0;
                for (var i = 0; i < response.length; i++) {
                    if(response[i].term_status == 'bt'){
                        current_iter++;
                    }
                }
            }
            return current_iter
        }

        $scope.e_no_data = 0;
        function getQuizDetail(subjectid,classid,sectionid,semsterid,sessionid)
        {
             try{
                
                httprequest(urlist.getquizlist,({ subjectlist:subjectid,
                                    inputclassid:classid,
                                    inputsectionid:sectionid,
                                    inputsemester:semsterid,
                                    inputsession:sessionid})).then(function(response){
                    
                    if(response != null && response.length > 0)
                    {

                        $scope.e_no_data = 0;
                        var cont_str = '';
                        for (var i = 0; i <= response.length-1; i++) {
                            var bt_end = false ;
                            cont_str +='<tr>';

                            cont_str += '<td>'+response[i].screenname+'</td>';
                            if(response[i].score != null && response[i].score.length > 0)
                            {
                                for (var k = 0; k <= response[i].score.length - 1; k++) {

                                    if(response[i].score[k].term_status == 'bt' && bt_end == false)
                                    {
                                        cont_str += '<td><a href="#" id="'+response[i].studentid+'" onclick="angular.element(this).scope().viewresult('+response[i].studentid+','+response[i].score[k].quizid+')" data-student="'+response[i].screenname+'">'+response[i].score[k].correntanswer+'/'+response[i].score[k].total_question+'</a></td>';
                                    }
                                    
                                    var before_mid = countTotalBeforeMidterm(response[i].score) - 1
                                    if(response[i].score[k].term_status == 'bt' && before_mid  == k && bt_end == false){
                                        bt_end = true
                                       
                                       if(response[i].term_result[0].marks != '' && response[i].term_result[0].marks != null){
                                             cont_str += '<td>'+response[i].term_result[0].marks+'</td>';
                                        }
                                        else{
                                            cont_str += '<td></td>';
                                        }
                                    }

                                    if(response[i].score[k].term_status == 'at' && bt_end == true && k <= response[i].score.length - 1)
                                    {
                                        cont_str += '<td><a href="#" id="'+response[i].studentid+'" onclick="angular.element(this).scope().viewresult('+response[i].studentid+','+response[i].score[k].quizid+')" data-student="'+response[i].screenname+'">'+response[i].score[k].correntanswer+'/'+response[i].score[k].total_question+'</a></td>';
                                    }

                                    if(bt_end == true  && k == response[i].score.length - 1){
                                       if(response[i].term_result[1].marks != '' && response[i].term_result[1].marks != null){
                                            cont_str += '<td>'+response[i].term_result[1].marks+'</td>';
                                        }
                                        else{
                                            cont_str += '<td></td>';
                                        }
                                    }
                                }  
                            }


                            if(response[i].score.length == 0){

                                if(response[i].term_result != null && response[i].term_result.length > 0){
                                    if(response[i].term_result[0].marks != '' && response[i].term_result[0].marks != null){
                                         cont_str += '<td>'+response[i].term_result[0].marks+'</td>';
                                    }
                                    else{
                                        cont_str += '<td></td>';
                                    }

                                    if(response[i].term_result[1].marks != '' && response[i].term_result[1].marks != null){
                                        cont_str += '<td>'+response[i].term_result[1].marks+'</td>';
                                    }
                                    else{
                                       cont_str += '<td></td>';
                                    }
                                }
                                else{
                                    var bt_end = false ;
                                    var headerlenght = $scope.evulationarray.length-1;
                                    for (var i = 0; i <= headerlenght; i++) {
                                         if(bt_end == false && $scope.evulationarray[i].term_status == 'bt')
                                        {
                                            cont_str += '<td>Unread</td>';
                                        }


                                        if($scope.midterm == i && $scope.evulationarray[i].term_status == 'bt' && bt_end == false){
                                            bt_end = true
                                           cont_str += '<td></td>';
                                        
                                        }

                                        
                                        if(bt_end == true && $scope.evulationarray[i].term_status == 'at')
                                        {
                                            cont_str += '<td>Unread</td>';
                                        }

                                        
                                        if(i == headerlenght)
                                        {
                                            cont_str += '<td></td>';
                                        }
                                    };
                                    
                                }
                            }

                          
                            
                            cont_str += '</tr>';
                        }
                      
                        $("#evulationtable_"+subjectid+sectionid+" #reporttablebody-phase-two").html(" ");
                        $("#evulationtable_"+subjectid+sectionid).dataTable().fnDestroy();
                        $("#evulationtable_"+subjectid+sectionid+" #reporttablebody-phase-two").html(cont_str);
                        $compile(cont_str)($scope);
                        loaddatatable("evulationtable_"+subjectid+sectionid);
                    }
                    else{
                      
                        $("#evulationtable_"+subjectid+sectionid+" #reporttablebody-phase-two").html(" ");
                        $("#evulationtable_"+subjectid+sectionid).dataTable().fnDestroy();
                        
                        $scope.e_no_data = 0;
                        loaddatatable("evulationtable_"+subjectid+sectionid);
                       
                    }
                });
                
            }
             catch(ex){}
        }

        $scope.l_no_data = 0;
         function getPlanDetail(subjectid)
        {
             try{

                $scope.dataloader = 0;
                httprequest(urlist.getlessonplan,({subjectlist:subjectid})).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.l_no_data = 0;
                        var cont_str = '';
                        cont_str +='<tr>';
                        cont_str += '<td><a href="#">Edit</a></td>';
                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str += '<td>'+response[i].name+'</td>'; 
                        }
                        cont_str += '</tr>';
                        
                        $("#lessonplant_"+subjectid+" #table-header").html(" ");
                        $("#lessonplant_"+subjectid+" #table-footer").html(" ");
          
                         $("#lessonplant_"+subjectid+" #table-header").append("<th></th>");
                         $("#lessonplant_"+subjectid+" #table-footer").append("<th></th>");
                        for (var i = 0; i <= response.length-1; i++) {
                            $("#lessonplant_"+subjectid+" #table-header").append("<th class='"+response[i].status+"'>"+response[i].date+"</th>");
                            $("#lessonplant_"+subjectid+" #table-footer").append("<th>"+response[i].date+"</th>");
                        };

                        $("#lessonplant_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#lessonplant_"+subjectid).dataTable().fnDestroy();
                        $("#lessonplant_"+subjectid+" #reporttablebody-phase-two").html(cont_str);
                       
                        loaddatatable("lessonplant_"+subjectid);
                    }
                    else{
                        $("#lessonplant_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#lessonplant_"+subjectid).dataTable().fnDestroy();
                        loaddatatable("lessonplant_"+subjectid);
                        $scope.l_no_data = 0;
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

        $scope.viewresult = function(studentid,quizid)
        {
            try{
               
                httprequest(urlist.getstudentquizdetail,({studentid:studentid,quizid:quizid})).then(function(response){
                    if(response != null &&  response.length > 0)
                    {
                        $scope.no_data = 0;
                        $scope.screenname = $("#"+studentid).attr('data-student')
                        $scope.sudentquizdetail = response
                         
              
                        $("#resultmodel").modal('show')
                    }
                    else{
                        $scope.no_data = 1;
                    }
                });
            }
            catch(ex){}
        }

        var studentData = [];
         var container = document.getElementById('result_container');
         $scope.subjid = 0
        $scope.addtermresult = function(classid,sectionid,subjectid,termid,semesterid,sessionid)
        {
            try{
                 $scope.subjid = subjectid
                studentData = [];
                httprequest(urlist.getsubjectresult,({
                                class_id:classid,
                                section_id:sectionid,
                                subject_id:subjectid,
                                semesterid:semesterid,
                                sessionid:sessionid,
                                term_id:termid})).then(function(response){
                    if(response != null &&  response.length > 0)
                    {
                        var cont_str = '';
                        var columnname = ['m','f']
                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str += '<tr>'
                            cont_str += '<td width="60%">'+response[i].name+'</td>'
                            for (var k = 0; k < response[i].marks.length; k++) {
                                cont_str += '<td width="20%"><input type="number" min="0" max="100" name="term_result" id="term_result" data-studentsemesterid= "'+semesterid+'" data-studentsessionid= "'+sessionid+'" data-studentid = "'+response[i].studentid+'" data-marksid = "'+response[i].id+'" data-classid = "'+classid+'" data-sectionid = "'+sectionid+'" data-subjectid = "'+subjectid+'" data-termid = "'+termid+'" data-column ="'+columnname[k]+'" value="'+response[i].marks[k].studentmarks+'"/></td>'
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
                $("#termmodel").modal('show')
                //createform()
                //initresult()
            }
            catch(ex){}
        }

        $('#termmodel').on('hidden.bs.modal', function () {

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
                        if(response != null && response.message  == true)
                        {
                            $("#result_message").html('Mark saved').fadeOut(30000);
                        }else{
                            $("#result_message").html('Mark not saved').fadeOut(30000);
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
