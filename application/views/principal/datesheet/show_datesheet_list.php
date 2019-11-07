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
<div id="delete_modal" class="modal fade">

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
<!-- <div id="copy_modal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to copy this record?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="CopyDatesheet" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div> --> 
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <!-- widget title -->
                   <div class="panel-heading">
                    <div class="" id="widget-header">
                        <h4>Datesheet list
                        <a href="<?php echo $path_url; ?>add_datesheet" class="btn btn-primary colorwhite">Add New Datesheet</a>
                        </h4>
          
                    </div>
                    
                    </div>
                    <div class="panel-body whide" id="class_report" >
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-inline" >
                                   
                                    <div class="form-group">
                                        <label for="inputRSession">Session:</label>
                                        <select  class="form-control" ng-options="item.name for item in rsessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="filterobj.session" ng-change="changeclass()" ></select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="select_class">Grade:</label>
                                        <select class="form-control" ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="filterobj.class" ng-change="changeclass()"></select>
                                    </div> -->

                                    <div class="form-group">
                                        <label for="inputSemester">Semester:</label>
                                        <select class="form-control"    ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester" ng-change="changeclass()"></select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="select_class">Type:</label>
                                        <select class="form-control" name="inputType" id="inputType" ng-model="filterobj.type" ng-change="changeclass()">
                                            <option>Mid</option>
                                            <option>Final</option>
                                        </select>
                                    </div> -->
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
                                            <th>Grade</th>
                                            <!-- <th>Semester</th> -->
                                            <th>Type</th>
                                            <th>School Start</th>
                                            <th>School End</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                        <tbody class="report-body">
                                           <tr ng-repeat="d in datesheetlist"  ng-init="$last && finished()" >
                                                <td>{{d.grade}}</td>
                                                <!-- <td>{{d.semester_name}}</td> -->
                                                <td>{{d.type}}</td>
                                                <td>{{d.start_time}}</td>
                                                <td>{{d.end_time}}</td>
                                                <td>{{d.start_date}}</td>
                                                <td>{{d.end_date}}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="link-student" ng-click="download(d.id)" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                    
                                                    <a ng-hide="d.hide==true" href="<?php echo $path_url; ?>update_datesheet/{{d.id}}" id="{{d.id}}" class='edit' title="Edit">

                                                     <i class="fa fa-edit" aria-hidden="true"></i>

                                                        </a>

                                                <a ng-hide="d.hide==true" href="javascript:void(0)" title="Delete" id="{{d.id}}" class="del">
                                                <i class="fa fa-remove" aria-hidden="true"></i>
                                                    
                                                <!-- <a href="javascript:void(0)" title="Copy" id="{{d.id}}" class="copy">
                                                <i class="fa fa-bookmark" aria-hidden="true"></i> -->

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
                    //console.log(response[0]['Mid']);
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
                        //inputclassid:$scope.filterobj.class.id,
                        inputsessionid:$scope.filterobj.session.id,
                        inputsemesterid:$scope.filterobj.semester.id,
                        //inputtype:$scope.filterobj.type,
                    }
                    //console.log(data);
                    httppostrequest('getdatesheetdata',data).then(function(response){
                        console.log(response)
                        if(response.length > 0 && response != null)
                        {
                            $scope.datesheetlist = response[0]['listarray'];
                            $scope.datesheet_type = response[0]['data_array']['type'];
                            $scope.grade = response[0]['data_array']['grade'];
                            $scope.session_dates = response[0]['data_array']['session_dates'];
                            $scope.semester_dates = response[0]['data_array']['semester_dates'];
                            $scope.semester_name = response[0]['data_array']['semester_name'];
                            $scope.school_name = response[0]['data_array']['school_name'];
                            $scope.hide_operation = response[0]['data_array']['hide_icon'];
                            //console.log($scope.datesheet_type);
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
// Copy Datesheet
// $(document).on('click','.copy',function(){

//             $("#copy_modal").modal('show');

//             dvalue =  $(this).attr('id');

         

//             //row_slug =   $(this).parent().parent().attr('id');

            

//         });
// $(document).on('click','#CopyDatesheet',function(){

//             $("#copy_modal").modal('hide');

//             ajaxType = "GET";

//             urlpath = "<?php echo $path_url; ?>Principal_controller/CopyDatesheets";

//             var dataString = ({'id':dvalue});

//             ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadDatesheetResponse);

//         });
// function loadDatesheetResponse(response)

//         {

//             if (response.message === true){
//                 $scope.getDatesheetData();
                
//                 message('Record has been saved','show');

                

//             } 

//         }
// Delete Datesheet id
$(document).on('click','.del',function(){

            $("#delete_modal").modal('show');

            dvalue =  $(this).attr('id');

         

            row_slug =   $(this).parent().parent().attr('id');

            

        });
$(document).on('click','#UserDelete',function(){

            $("#delete_modal").modal('hide');

            ajaxType = "GET";

            urlpath = "<?php echo $path_url; ?>Principal_controller/removeDatesheets";

            var dataString = ({'id':dvalue});

            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);

        });

    function userDeleteFailureHandler()

        {

            $(".user-message").show();
            message('Datesheet has been not deleted','show');
           

        }



        function loadUserDeleteResponse(response)

        {

            if (response.message === true){
                $scope.getDatesheetData();
                
                message('Record has been deleted','show');

                

            } 

        }

// End here

        
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
        // For Print
        //function getDetailDatesheetData(){
        $scope.getDetailDatesheetData = function(id)
        {
            try{
                //$scope.semesterlist = []
                var data = ({datesheetinfo:id})
                httprequest('<?php echo base_url(); ?>getdetaildatesheet',data).then(function(response){
                
                    //console.log(response);
                    if(response.length > 0 && response != null)
                    {

                        $scope.datesheetlistinfo = response[0]['details'];
                        //console.log($scope.datesheetlistinfo);
                        $scope.datesheet_type = response[0]['data_array']['type'];
                        $scope.grade = response[0]['data_array']['grade'];
                        $scope.session_dates = response[0]['data_array']['session_dates'];
                        $scope.semester_dates = response[0]['data_array']['semester_dates'];
                        $scope.semester_name = response[0]['data_array']['semester_name'];
                        $scope.notes = response[0]['data_array']['notes'];
                        $scope.notes_text = response[0]['data_array']['notes_text'];
                        
                        var reportobj = $scope.renderprintdata();
            
                        pdfMake.createPdf(reportobj).download(response[0]['data_array']['file_name']);

                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }
        //getDetailDatesheetData();
        // End here
        $scope.renderprintdata = function()
        {
            try{

                var docDefinition = {
                    pageOrientation: 'portrait',
                    content: [

                        {image:'<?php echo $logo ?>',style:'report_logo'},
                        
                        {
                            margin: [0, 25, 0, 10],
                            columns: [
                               {
                                    width: '*',
                                    text: 'Date Sheet '+$scope.datesheet_type+' Term Examination Session '+$scope.session_dates,
                                    alignment: 'center',
                                    fontSize: '16',
                                    bold: true,
                                },
                                 
                            ]
                        },
                        {
                            margin: [20, 5, 0, 30],
                            columns: [
                               {
                                    width: '*',
                                    text: 'Class '+$scope.grade,
                                    alignment: 'center',
                                    fontSize: '12',
                                    bold: true,
                                },
                                 
                            ]
                        },
                        {
                        columns: [
                            
                               table($scope.datesheetlistinfo,["exam_date","exam_day","subject_name"]),
                        ]
                        },
                        
                        
                        
                            {
                               
                                margin: [0, 40, 0, 5],

                                columns: [

                                   {

                                        width: '*',
                                        text:$scope.notes_text,
                                        alignment: 'left',
                                        fontSize:"14",
                                        bold: true,

                                    },
                                
                                     
                                ]
                              
                            },
                            {
                                margin: [0, 0, 0, 15],
                                columns: [
                                   {
                                        width: '*',
                                        text: $scope.notes,
                                        alignment: 'left',
                                        fontSize:"10",
                                        bold: false,

                                    },
                                
                                     
                                ]
                            },
                                  

                   ],

                   footer: {
                    margin: [0, 0, 30, 0],
                    columns: [

                      { text: 'Principal: _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ', alignment: 'right',fontSize:'14',bold:true }
                    ]
                  },

                    styles: {
                        // report_header: {
                        //     fontSize: 14,
                        //     bold: false,
                        //     alignment: 'center',
                        //     margin: [0, 10, 0, 30]
                        // },

                        report_logo: {
                            alignment: 'center'
                        },
                        tableExample: {
                            alignment: 'center'
                        },
                        
                    }
                };
                return docDefinition;
            }
            catch(e){}
        }
        // Generate PDF
        function buildTableBody(data, columns) {
            var body = [];
            //console.log(data);
            var temp = [];

                    temp.push({ text: 'Date', bold: true });
                    temp.push({ text: 'Day', bold: true });
                    temp.push({ text: 'Subject', bold: true });
                    
                    body.push(temp)

            data.forEach(function(row) {
                var dataRow = [];
                //console.log(row);
                columns.forEach(function(column) {
                    dataRow.push({text : row[column].toString(), alignment : 'left', color : '#000',width:'*'});
                })

                body.push(dataRow);
            });
            
            return body;
        }
        function table(data, columns ) {
            try{
                return {
                    fontSize: 14,
                    //margin :[130,0,0,0],
                    alignment: "left",
                    style: 'tableExample',
                    width: '*',
                    table: {
                        headerRows: 1,
                        widths: [ '*', '*', '*'],
                        body: buildTableBody(data,columns),

                        alignment: "center",
                    },

                    layout: {
                    fillColor: function (rowIndex, node, columnIndex) {

                            return (rowIndex % 2 === 0) ? '#f1f1f1' : null;
                        
                        
                        }
                    }
                };
            }
            catch(e){
                console.log(e)
            }
            
        } 
        $scope.printreport = function()
        {
            var reportobj = $scope.renderprintdata();
         
            pdfMake.createPdf(reportobj).print();
        }
        $scope.download = function(id)
        {
            $scope.getDetailDatesheetData(id);
            
        }

         $scope.loading = false;
        
  });

    
</script>
