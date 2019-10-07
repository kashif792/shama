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
                        <label>Grade Report</label>
                        <label class="right-controllers">
                            <a href="javascript:void(0)" class="link-student" ng-click="printreport()" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </label>
                        <label class="right-controllers">
                            <a href="javascript:void(0)" class="link-student" ng-click="download()" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </label>
                    </div>
                    <div class="panel-body whide" id="class_report" ng-class="{'loader2-background': processfinished == false}">
                        <div class="loader2" ng-hide="processfinished" ></div>
                        <div class="row" ng-hide="!processfinished">
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
                                    <div class="form-group">
                                        <label for="inputSemester">Semester:</label>
                                        <select class="form-control"    ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester" ng-change="changeclass()"></select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="inputDate">Date:</label>
                                            <input date-range-picker id="inputDate" name="inputDate" class="form-control date-picker" 
                                            ng-model="filterobj.date" clearable="true" type="text" options="options" required/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row padding-top" ng-hide="!processfinished">
                            <div class="col-sm-12">
                                <div>
                                    <uib-tabset active="active">
                                        <uib-tab  ng-repeat="s in subjectlist track by $index" index="$index + 1" heading="{{s.name}}" ng-click="selectedSubject(s,$index)" >
                                            <div>
                                                <table datatable="ng"  class="table table-striped table-bordered row-border hover">
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
                                                            <th>Final Exam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="reporttablebody-phase-two" class="report-body">
                                                        <tr ng-repeat="e in evulationlist" ng-init="$last && finished()">
                                                            <td><a href="<?php echo base_url(); ?>studentreport/{{filterobj.session.id}}/{{filterobj.class.id}}/{{filterobj.section.id}}/{{filterobj.semester.id}}/{{e.studentid}}" class="link-student">{{e.screenname}}</a></td>
                                                            <td ng-repeat="s in e.score" ng-if="s.term_status == 'bt'">
                                                                {{s.totalpercent}}
                                                            </td>
                                                            <td>{{evulationlist[$index].term_result[0].marks}}</td>
                                                             <td ng-repeat="s in e.score" ng-if="s.term_status == 'at'">
                                                               {{s.totalpercent}}
                                                            </td>
                                                            <td>{{evulationlist[$index].term_result[1].marks}}</td>
                                                        </tr>
                                                        <tr ng-hide="evulationlist.length > 0">
                                                            <td class="text-center" colspan="3"><label>No record found</label></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </uib-tab>
                                    </uib-tabset>
                                    <p ng-hide="subjectlist.length >0" class="text-center" style="padding-top: 25px;"><label>No subject found</label></p>
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
        $scope.evulationlist = [];

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
                    locale: {
                        applyClass: 'btn-green',
                        applyLabel: "Apply",
                        fromLabel: "From",
                         format: "MMM D, YY", //will give you 6-January-17
                        toLabel: "To",
                        cancelLabel: 'Cancel',
                        customRangeLabel: 'Custom range'
                    },
                    ranges: {
                        "Today": [moment().format('MMM D, YY'), moment().format('MMM D, YY')],
                        "Yesterday": [moment().subtract(1, 'days').format('MMM D, YY'), moment().format('MMM D, YY')],
                        "Last 7 Days": [moment().subtract(6, 'days').format('MMM D, YY'), moment().format('MMM D, YY')],
                        "Last 30 Days": [moment().subtract(29, 'days').format('MMM D, YY'), moment().format('MMM D, YY')],
                        "This Month": [moment().startOf('month').format('MMM D, YY'), moment().format('MMM D, YY')],
                        "Last Month": [moment(moment().subtract(1, 'month')).startOf('month').format('MMM D, YY'), moment(moment().subtract(1, 'month')).endOf('month').format('MMM D, YY')]
                    },
                    eventHandlers:{
                        'apply.daterangepicker': function(ev, picker){
                            var sdate = $scope.filterobj.date.startDate.format('MMM D, YY');
                            var edate = $scope.filterobj.date.endDate.format('MMM D, YY');
                            $scope.filterobj.start_date =sdate;
                            $scope.filterobj.end_date =edate;
                            $scope.GetEvulationHeader();
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
                            $scope.subjectlist = response;
                             
                            $scope.filterobj.subjectid = response[0];
                            $scope.GetEvulationHeader();
                           
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
            $scope.getSubjectList();
            $scope.active = 1;
        }

        $scope.evulationarray = [];
        $scope.evalution_header = [];
        $scope.GetEvulationHeader = function()
        {
             try{

                httprequest('getevulationheader',{
                            subjectlist:$scope.filterobj.subjectid.id,
                            inputclassid:$scope.filterobj.class.id,
                            inputsectionid:$scope.filterobj.section.id,
                            inputsemester:$scope.filterobj.semester.id,
                            inputsession:$scope.filterobj.session.id,
                            inputstartdate:$scope.filterobj.start_date,
                            inputenddate:$scope.filterobj.end_date,
                            }
                        ).then(function(response){
                    if(response.length > 0)
                    {
                        $scope.evulationarray = response;
                        $scope.evalution_header = [];
                        $scope.evalution_header.push("Subject");
                        angular.forEach(response,function(value,key){
                            $scope.evalution_header.push(value.name);
                        });
                        $scope.evalution_header.push("Mid Term");
                        $scope.evalution_header.push("Final Exam");
                        
                    }else{
                        $scope.evulationarray = [];
                         $scope.evalution_header = [];
                        $scope.evalution_header.push("Subject");
                   
                        $scope.evalution_header.push("Mid Term");
                        $scope.evalution_header.push("Final Exam");
                        
                    }

                    getQuizDetail();
                });
            }
             catch(ex){}
        }


        function getQuizDetail()
        {
             try{
                httprequest('getquizlist',({   
                                    subjectlist:$scope.filterobj.subjectid.id,
                                    inputclassid:$scope.filterobj.class.id,
                                    inputsectionid:$scope.filterobj.section.id,
                                    inputsemester:$scope.filterobj.semester.id,
                                    inputsession:$scope.filterobj.session.id})).then(function(response){

                    if(response != null && response.length > 0)
                    {
                        $scope.evulationlist = response;
                        
                    }
                    else{
                        $scope.evulationlist = [];
                    }
                });
            }
            catch(ex){

            }
        }
    
        $scope.finished = function()
        {
            $scope.processfinished = true;
            $scope.eprocessfinished = true;
        }

        function buildTableBody(data, columnsheader, columns) {
            try{
                var body = [];

                if(columnsheader.length > 0)
                {
                    body.push(columnsheader);
                }else{
                    var temp = [];

                    temp.push("Name");
                    temp.push("Mid Term");
                    temp.push("Final Term");
                    body.push(temp)
                }

                data.forEach(function(row) {
                    var dataRow = [];

                    columns.forEach(function(column) {
                        var columnvalue = null;
                        //console.log(column);
                        if(column == 'screenname')
                        {
                            console.log(row[column]);
                            columnvalue = row[column].toString();
                            dataRow.push(columnvalue);
                        }
                        
                        
                        if(column == 'score')
                        {
                            if(row[column])
                            {
                                 for (var i = 0; i < row[column].length; i++) {
                                   columnvalue = (!isNaN(parseFloat(parseFloat(row[column][i].correntanswer)/parseFloat(row[column][i].total_question)*100)) ? parseFloat(parseFloat(row[column][i].correntanswer)/parseFloat(row[column][i].total_question)*100) : 0).toString(); 
                                     dataRow.push(columnvalue);
                                }
                            }
                        }

                        if(column == 'term_result')
                        {
                            columnvalue = row[column][0].marks.toString();
                            
                            dataRow.push(columnvalue);
                            columnvalue = row[column][1].marks.toString();
                            dataRow.push(columnvalue);
                        }

                    });

                    if(dataRow.length > 0)
                    {
                        body.push(dataRow);
                    }
                    
                });

                //return body;
            }
            catch(e){
                console.log(e)
            }
        }

        function table(data, columnsheader , columns) {
            try{
                return {
                    table: {
                        headerRows: 1,
                        body: buildTableBody(data,columnsheader,columns)
                    }
                };
            }
            catch(e){
                console.log(e)
            }
            
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

  });
</script>

<style type="text/css">
    form.tab-form-demo .tab-pane {
        margin: 20px 20px;
    }
</style>
