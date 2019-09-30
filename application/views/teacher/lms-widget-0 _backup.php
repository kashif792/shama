<div class="col-lg-12 progress-widget" ng-controller="progress_ctrl">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Show Progress Report</label>
        </div>
        <div class="panel-body" ng-init="progress_no_data = 0 ;">
            <div class="panel-group" id="accordion" ng-if="progress_no_data == 0;">
                <div class="panel panel-default" ng-repeat="p in progressreportlist">
                    <div class="panel-heading">
                        <h4 class="panel-title grade" >
                            <a data-toggle="collapse"  data-parent="#accordion" href="#{{p.classid}}">
                            {{p.classname}}</a>
                        </h4>
                    </div>
                    <div id="{{p.classid}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="panel-group" id="sec_{{p.classid}}">
                                <div class="panel panel-default" ng-repeat="s in p.sectionlist">
                                    <div class="panel-heading">
                                        <h4 class="panel-title sectionheading">
                                            <a data-toggle="collapse" class="section" data-parent="#sec_{{p.classid}}" href="#sectioncollapse_{{s.sid}}">
                                                {{s.section_name}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="sectioncollapse_{{s.sid}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel-group" id="sectioncontainer_{{s.sid}}">
                                                <div class="panel panel-default" ng-repeat="sub in s.subjectlist" >
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title subjectheading">
                                                            <a data-toggle="collapse" class="subject" data-parent="#sectioncontainer_{{s.sid}}" href="#sub_{{sub.sbid}}">
                                                                {{sub.subject_name}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="sub_{{sub.sbid}}" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="panel-group" id="data_attributes">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title cheading">
                                                                            <a data-toggle="collapse" class="detail-section" ng-click="getSubjectProgressReport(sub.sbid,s.sid)" data-parent="#data_attributes" href="#{{sub.sbid}}">
                                                                            Course Progress</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="{{sub.sbid}}" class="panel-collapse collapse">
                                                                        <div class="panel-body col-sm-12" style="overflow: auto;">
                                                                            <div ng-if="c_no_data == 0" >
                                                                                <table class="table table-bordered course_progress" id="course_progress_{{sub.sbid}}">
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
                                                                            <a data-toggle="collapse" class="detail-section" data-parent="#data_attributes" ng-click="getSubjectEvualtionReport(sub.sbid)" href="#evulation_{{sub.sbid}}">
                                                                            Evaluation</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="evulation_{{sub.sbid}}" class="panel-collapse collapse">
                                                                        <div class="panel-body col-sm-12" style="overflow: auto;">
                                                                            <div ng-if="e_no_data == 0" class="lesson-plan" >
                                                                                <table class="table table-bordered" id="evulationtable_{{sub.sbid}}">
                                                                                    <thead >
                                                                                        <tr id="table-header">
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tfoot >
                                                                                        <tr id="table-footer">
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                    <tbody id="reporttablebody-phase-two" class="report-body"></tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div ng-if="e_no_data == 1" class="no_data">
                                                                                No data found
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title rheading">
                                                                            <a data-toggle="collapse" class="detail-section" data-parent="#data_attributes" ng-click="getResultReport(sub.sbid)" href="#result_{{sub.sbid}}">
                                                                                Result
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="result_{{sub.sbid}}" class="panel-collapse collapse">
                                                                        <div class="panel-body col-sm-12" style="overflow: auto;">
                                                                            <div ng-if="r_no_data == 0" >
                                                                                <table class="table table-bordered" id="subject_result_{{sub.sbid}}">
                                                                                    <thead >
                                                                                        <tr id="table-header">
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tfoot >
                                                                                        <tr id="table-footer">
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                    <tbody id="reporttablebody-phase-two" class="report-body"></tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div ng-if="r_no_data == 1" class="no_data">
                                                                                No data found
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title pheading">
                                                                            <a data-toggle="collapse" class="detail-section" ng-click="getPlanList(sub.sbid)" data-parent="#data_attributes" href="#lessonplan_{{sub.sbid}}">
                                                                                Lesson Plan
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="lessonplan_{{sub.sbid}}" class="panel-collapse collapse">
                                                                        <div class="panel-body col-sm-12" style="overflow: auto;">
                                                                            <div ng-if="l_no_data == 0" class="lesson-plan" >
                                                                               <table class="table table-bordered" id="lessonplant_{{sub.sbid}}">
                                                                                     <thead >
                                                                                    <tr id="table-header">
                                                                                    </tr>
                                                                                </thead>
                                                                                <tfoot >
                                                                                    <tr id="table-footer">
                                                                                    </tr>
                                                                                </tfoot>
                                                                                 <tbody id="reporttablebody-phase-two" class="report-body"></tbody>
                                    
                                                                                </table> 
                                                                            </div>
                                                                            <div ng-if="l_no_data == 1" class="no_data">
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
                <h4 class="modal-title">Detail</h4>
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
                                                            <input class="answer" type="radio" name="{{o.optionid}}" value="" checked="checked">
                                                        </span>
                                                        <span ng-if="q.selectedoption != o.optionid">
                                                            <input class="answer" type="radio" name="{{o.optionid}}" value="">
                                                        </span>
                                                    </span>
                                                    <span ng-if="o.iscorrect == 0">
                                                        <span ng-if="q.selectedoption == o.optionid">
                                                            <input class="answer" type="radio" name="{{o.optionid}}" value="" checked="checked">
                                                        </span>
                                                        <span ng-if="q.selectedoption != o.optionid">
                                                            <input class="answer" type="radio" name="{{o.optionid}}" value="">
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
                                                  
                                                <!-- </span> -->
                                                <!-- <span ng-if="o.iscorrect  == 0"> -->
                                                    
                                                    
                                                <!-- </span> -->
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
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Result</h4>
            </div>
            <div class="modal-body">
                <div id="example"></div>
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
                "order": [[ 0, "asc"  ]],
     
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

        }
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
                    }
                    else{
                        $scope.progress_no_data = 1;
                    }
                });                
            }
             catch(ex){}
        }

        $scope.getSubjectProgressReport = function(subjid,sectionid){
            var check = angular.element("#"+subjid).hasClass('in');
            if(check == false)
            {  
                $("#course_progress_"+subjid+'tbody').empty();
                getLessonPlanList(subjid)
            }
            
        }


        $scope.getSubjectEvualtionReport = function(subjectid)
        {
            var check = angular.element("#evulation_"+subjectid).hasClass('in');
            if(check == false)
            {
                GetEvulationHeader(subjectid)
                getQuizDetail(subjectid)
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
        function getLessonPlanList(subjectid)
        {
             try{
                httprequest(urlist.getcourselesson,({subjectlist:subjectid})).then(function(response){
                    if(response != null)
                    {
                        $scope.planheader = response
                        $("#course_progress_"+subjectid+" #table-header-date").html(' ');
                        $("#course_progress_"+subjectid+" #table-header-title").html(' ');
                        $("#course_progress_"+subjectid+" #table-header-type").html(' ');
                        $("#course_progress_"+subjectid+" #table-footer").html(' ');
                        var cont_str = '';
                        $("#course_progress_"+subjectid+" #table-header-date").append("<th>Students</th>");
                        $("#course_progress_"+subjectid+" #table-header-title").append("<th></th>");
                        $("#course_progress_"+subjectid+" #table-header-type").append("<th></th>");
                        $("#course_progress_"+subjectid+" #table-footer").append("<th></th>");
                        
                        for (var i = 0; i <= response.length-1; i++) {
                            $("#course_progress_"+subjectid+" #table-header-date").append("<th>"+response[i].date+"</th>");
                        };
                        
                         for (var i = 0; i <= response.length-1; i++) {
                             $("#course_progress_"+subjectid+" #table-header-title").append("<th>"+response[i].name+"</th>");
                             $("#course_progress_"+subjectid+" #table-footer").append("<th>"+response[i].name+"</th>");
                         };
                        for (var i = 0; i <= response.length-1; i++) {
                            $("#course_progress_"+subjectid+" #table-header-type").append("<th>"+response[i].type+"</th>");
                        };
                        getCourseDetail(subjectid)
                    }
                });
            }
             catch(ex){}
        }
        $scope.c_no_data = 0;
        function getCourseDetail(subjectid)
        {
             try{
       
                httprequest(urlist.getcoursedetail,({subjectlist:subjectid})).then(function(response){
                    if(response != null && response.length > 0)
                    {  
                        $scope.c_no_data = 0;
                        var cont_str = '';
                     
                        // cont_str +='<tr>';
                        // cont_str += '<td></td>';
                        // for (var i = 0; i <= $scope.planheader.length-1; i++) {
                        //     cont_str += '<td>'+$scope.planheader[i].name+'</td>'; 
                        // };
                        // cont_str += '</tr>';

                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str +='<tr>';
                            cont_str += '<td>'+response[i].screenname+'</td>';
                            for (var k = 0; k <= response[i].studentplan.length - 1; k++) {
                               cont_str += '<td class="'+response[i].studentplan[k].status+'">'+response[i].studentplan[k].status+'</td>'; 
                            }
                            cont_str += '</tr>';
                        }
                      
                        $("#course_progress_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#course_progress_"+subjectid).dataTable().fnDestroy();
                        $("#course_progress_"+subjectid+" #reporttablebody-phase-two").html(cont_str);
                        $scope.dataloader  = 0;
                        loaddatatable("course_progress_"+subjectid);
                    }
                    else{
                        $("#course_progress_"+subjectid).dataTable().fnDestroy();
                        loaddatatable("course_progress_"+subjectid);
                        $scope.c_no_data = 0;
                    }
                });
            }
             catch(ex){}
        }

        function GetEvulationHeader(subjectid)
        {
             try{
                httprequest(urlist.getevulationheader,({subjectlist:subjectid})).then(function(response){
                    if(response != null)
                    {
                        $("#evulationtable_"+subjectid+" #table-header").html(" ");
                        $("#evulationtable_"+subjectid+" #table-footer").html(" ");
                        var cont_str = '';
                        $("#evulationtable_"+subjectid+" #table-header").append("<th></th>");
                        $("#evulationtable_"+subjectid+" #table-footer").append("<th></th>");
                        var bt_end = false ;
                        var headerlenght = response.length-1;
                        for (var i = 0; i <= headerlenght; i++) {
                           
                            
                            if(response[i].term_status == 'at'){
                                bt_end = true
                                $("#evulationtable_"+subjectid+" #table-header").append("<th><a onclick='angular.element(this).scope().addtermresult()'>Mid Term</a></th>");
                                $("#evulationtable_"+subjectid+" #table-footer").append("<th></th>");
                            }

                             if(bt_end == false)
                            {
                                $("#evulationtable_"+subjectid+" #table-header").append("<th>"+response[i].name+"</th>");
                                $("#evulationtable_"+subjectid+" #table-footer").append("<th>"+response[i].name+"</th>");
                            }

                            if(bt_end == true)
                            {
                                $("#evulationtable_"+subjectid+" #table-header").append("<th>"+response[i].name+"</th>");
                                 $("#evulationtable_"+subjectid+" #table-footer").append("<th>"+response[i].name+"</th>");
                            }
                            
                            if(i == headerlenght)
                            {
                                $("#evulationtable_"+subjectid+" #table-header").append("<th><a onclick='angular.element(this).scope().addtermresult()'>Final Term</a></th>");
                                $("#evulationtable_"+subjectid+" #table-footer").append("<th></th>");
                            }
                           
                        };
                        
                    }
                    
                });
            }
             catch(ex){}
        }
        $scope.e_no_data = 0;
        function getQuizDetail(subjectid)
        {
             try{
  
                httprequest(urlist.getquizlist,({subjectlist:subjectid})).then(function(response){
                    
                    if(response != null && response.length > 0)
                    {

                        $scope.e_no_data = 0;
                        var cont_str = '';
                        var bt_end = false ;

                        for (var i = 0; i <= response.length-1; i++) {
                            cont_str +='<tr>';
                            cont_str += '<td>'+response[i].screenname+'</td>';
                            for (var k = 0; k <= response[i].score.length - 1; k++) {
                                 if(response[i].score[k].term_status == 'at'){
                                    bt_end = true
                                    cont_str += '<td>'+response[i].score[k].student_result+'</td>';
                                }

                                if(bt_end == false)
                                {
                                    cont_str += '<td><a href="#" onclick="angular.element(this).scope().viewresult('+response[i].studentid+','+response[i].score[k].quizid+')">'+response[i].score[k].correntanswer+'/'+response[i].score[k].total_question+'</a></td>';
                                }

                                if(bt_end == true)
                                {
                                    cont_str += '<td><a href="#" onclick="angular.element(this).scope().viewresult('+response[i].studentid+','+response[i].score[k].quizid+')">'+response[i].score[k].correntanswer+'/'+response[i].score[k].total_question+'</a></td>';
                                }

                                if(k == response[i].score.length - 1){
                                    cont_str += '<td>'+response[i].score[k].student_result+'</td>';
                                }
                                
                            }
                            cont_str += '</tr>';
                        }
                      
                        $("#evulationtable_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#evulationtable_"+subjectid).dataTable().fnDestroy();
                        $("#evulationtable_"+subjectid+" #reporttablebody-phase-two").html(cont_str);
                        $compile(cont_str)($scope);
                        loaddatatable("evulationtable_"+subjectid);
                    }
                    else{
                        $("#evulationtable_"+subjectid+" #reporttablebody-phase-two").html(" ");
                        $("#evulationtable_"+subjectid).dataTable().fnDestroy();
                         $scope.e_no_data = 0;
                        loaddatatable("evulationtable_"+subjectid);
                       
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

        $scope.addtermresult = function()
        {
             $("#termmodel").modal('show')
        }

        var financeData = [
          ["239.65","24/02/2015","0.000128","-0.2379","47.044"],
          ["238.99","24/02/2015","0.0106","-0.2435","5.11"],
          ["231.26","24/02/2015","0.0066","-0.2521","7.571"],
          ["239.12","24/02/2015","0.0082","-0.2454","16.429"],
          ["255.07","24/02/2015","0.0091","-0.2017","252"],
          ["238.91","24/02/2015","0.0077","-0.2437","995"],
          ["211.51","24/02/2015","0.0089","-0.1880","4.28"],
          ["210.65","24/02/2015","0.0078","-0.1930","2.521"],
          ["205.06","24/02/2015","0.0107","-0.2251","96"],
          ["212.41","24/02/2015","0.0085","-0.1949","456"],
          ["227.94","24/02/2015","0.0158","-0.1363","49"],
          ["211.28","24/02/2015","0.0078","-0.1765","19"],
          ["1486.97","24/02/2015","0.0112","-0.2310","168"],
          ["1310.00","24/02/2015","-0.01812","-0.3310","0"],
          ["1497.50","24/02/2015","0.0051","-0.2309","160"]
        ];

        var container = document.getElementById('example');

var hot = new Handsontable(container, {
  data: financeData,
  colHeaders: ["Price", "Date", "1D Chg", "YTD Chg", "Vol BTC"],
  rowHeaders: true,
  stretchH: 'all',
  sortIndicator: true,
  columnSorting: true,
  contextMenu: true,
  columns: [
    {type: 'numeric', format: '$0,0.00'},
    {type: 'date', dateFormat: 'DD/MM/YYYY', correctFormat: true},
    {type: 'numeric', format: '0.00%'},
    {type: 'numeric', format: '0.00%'},
    {type: 'numeric', format: '0.00'}
  ]
});

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
