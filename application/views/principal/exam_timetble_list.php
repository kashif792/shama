<?php 



// require_header 



require APPPATH.'views/__layout/header.php';







// require_top_navigation 



require APPPATH.'views/__layout/topbar.php';







// require_left_navigation 



require APPPATH.'views/__layout/leftnavigation.php';



?>



<link href="<?php echo $path_url; ?>css/easy-responsive-tabs.css" rel="stylesheet">



<link rel="stylesheet" href="<?php echo $path_url; ?>css/intlTelInput.css">

<div class="col-sm-10 col-md-10 col-lg-10 class-page "  ng-controller="class_report_ctrl" ng-init="getBaseUrl('<?php echo base_url(); ?>')">

<div id="myUserModal" class="modal fade">



    <div class="modal-dialog">



        <div class="modal-content">



            <div class="modal-header">



                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>



                <h4 class="modal-title">Confirmation</h4>



            </div>



            <div class="modal-body">



                <p>Are you sure you want to delete this schedule?</p>



             </div>



            <div class="modal-footer">



                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>



                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>



            </div>



        </div>



    </div>



</div>



<div id="myModal" class="modal fade">



    <div class="modal-dialog">



        <div class="modal-content">



            <div class="modal-body">



                <h3 style="padding-left: 40px;">Schedule Information</h3>



                <table class="table table-striped table-hover">



                    <tbody>



                        <tr>



                            <td>



                                <th>Subject Name</th>



                            </td>



                            <td id="user_name"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Grade Name</th>



                            </td>



                            <td id="user_email"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Section Name</th>



                            </td>



                            <td id="user_acct_date"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Teacher Name</th>



                            </td>



                            <td id="user_acct_status"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Start Time</th>



                            </td>



                            <td id="user_role"></td>



                        </tr>

                          <tr>



                            <td>



                                <th>End Time</th>



                            </td>



                            <td id="user_role"></td>



                        </tr>

                    </tbody>



                </table>



             </div>



            <div class="modal-footer">



                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>



            </div>



        </div>



    </div>



</div>



<div class="">



<?php



	// require_footer 



	require APPPATH.'views/__layout/filterlayout.php';



?>
<div class="panel panel-default">
	<div class="panel-heading">
		<label>Schedule List
			   &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>add_timtble" class="btn btn-primary" style="color: #fff !important;">Add Schedule</a>
     
		</label>
        <label class="right-controllers">
            <a href="javascript:void(0)" class="link-student" ng-click="download()" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
            
        </label>
	</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                
                       <form class="form-inline" >
                        <label for="select_class">Select Days:</label>
                        
                        <select class="form-control" name="inputDay" id="inputDay" ng-model="filterobj.day" ng-change="changeclass()" >
                            <option value="" style="display: none;">loading...</option>
                            <option value="mon">Monday</option>
                            <option value="tue">Tuesday</option>
                            <option value="wed">Wednesday</option>
                            <option value="thu">Thursday</option>
                            <option value="fri">Friday</option>
                            <option value="sat">Saturday</option>
                            <option value="sun">Sunday</option>
                        </select>
                    </form>
                </div>
                
            </div>
        
		<table class="table table-striped table-bordered row-border hover" id="table-body-phase-tow" >

			                        <thead>

				                        <tr>

				                          

				                            <th>Subjects</th>

				                            <th>Grade</th>

				                            <th>Teachers</th>

		                                    <th>Start Time</th>

		                                    <th>End Time</th>

		                                    <th>Options</th>

				                        </tr>

				                    </thead>

				                    <tfoot>

				                        <tr>

			                          

				                            <th>Subjets</th>

				                            <th>Grade</th>

				                            <th>Teachers</th>

		                                    <th>Start Time</th>

		                                    <th>End Time</th>

		                                    <th>Options</th>

				                        </tr>

				                    </tfoot>

			                        <tbody >

                                    </tbody>



			                    </table>
		
	</div>
    <div id="timetable" style="min-height:280px;" ></div>
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

<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">



    var app = angular.module('invantage', []);
    app.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
    });
    app.controller('class_report_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile,$filter){
    $scope.currentPage = 0;
    $scope.filterobj = {};
    $scope.pageSize = 10;
    $scope.day = [];
    $scope.data = [];
    $scope.numberOfPages=function(){
        return Math.ceil($scope.data.length/$scope.pageSize);                
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
        
        $scope.changeclass = function()
        {
            
            $scope.getScheduleData();
            
            
            $scope.active = 1;
            
        }
        // Days Select box
        function getDayList()
        {
            httprequest('getdaylist',({})).then(function(response){
               
                if(response != null && response.length > 0)
                {
                    
                    $scope.daylist = response;
                    $scope.filterobj.day = response[0];
                    
                }
            });
        }
        
        $scope.getScheduleData = function()
        
        {

            try{
                    var data ={
                        
                        inputday:$scope.filterobj.day,
                        
                    }

                    httppostrequest('getschedulelist',data).then(function(response){
                       
                        $scope.data = [];
                        if(response.length > 0 && response != null)
                        {
                            for (var i=0; i<response[0]['listarray'].length; i++) {
                                $scope.data.push(response[0]['listarray'][i]);
                                
                                
                            }
                            $("#inputDay").val(response[0]['data_array']['select_day']);
                            $("#table-body-phase-tow").dataTable().fnDestroy();
                            $scope.loaddatatable($scope.data);
                            
                        }
                        else{
                            $scope.schedulelist = [];
                         
                        }
                    });
                
            }
            catch(e){}
        }
        $scope.getScheduleData();
        
        $(document).on('click','.del',function(){
            $("#myUserModal").modal('show');
            dvalue =  $(this).attr('id');
            row_slug =   $(this).parent().parent().attr('id');
            //rowdata = table.row( $(this).parents('tr') ).data();
        });

        $(document).on('click','#UserDelete',function(){
            $("#myUserModal").modal('hide');
            ajaxType = "GET";
            urlpath = "<?php echo $path_url; ?>Teacher/removeSchedule";
            var dataString = ({'id':dvalue});
            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);
        });

        function userDeleteFailureHandler()
        {
            $(".user-message").show();
            $(".message-text").text("Schedule has been not deleted").fadeOut(10000);
        }

        function loadUserDeleteResponse(response)
        {
            if (response.message === true){
               
                
                var table = $('#table-body-phase-tow').DataTable();
                    table
                        .row("#"+row_slug)
                        .remove()
                        .draw();
                
                //$scope.success=response.message;
                message('Record has been deleted','show');

            } 



        }

        $(document).ready(function(){
        $('#setting').easyResponsiveTabs({ tabidentify: 'vert' });
        function loadClassByIdReponseError(){}

        function loadClassByIdResponse(data)
        {
            if(data.message == true)
            {
                $("#class_name").html(data.grade);
                $("#section_name").html(data.section_name);
                $("#myModal").modal('show');
            }
        }
    
})

    var dvalue ;
    var rowdata;
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
                    { data: 'subject_name' },
                    { data: 'grade' },
                    { data: 'screenname' },
                    { data: 'start_time' },
                    { data: 'end_time' },
                    {
                     "className": '',
                     "orderable": false,
                     "data": null,

                     "defaultContent": "",
                     "render" : function ( data, type, full, meta ) {
                          if ( data != null && data != '') {
                             
                             return "<a href='<?php echo $path_url; ?>add_timtble/"+data['id']+"'  ><i class='fa fa-edit' aria-hidden='true'></i></a> <a href='javascript:void(0)' id="+data['id']+" class='del'><i class='fa fa-remove' aria-hidden='true'></i></a>";
                         }
                         else {
                                 return;
                         }
                      }
                    },
                ],

                "pageLength": 10,

            })
            
            table.columns(0).every( function () {
                var column = this;
                var select = $('<select><option value="">All</option></select>')
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
            table.columns(1).every( function () {
                var column = this;
                var select = $('<select><option value="">All</option></select>')
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
            table.columns(2).every( function () {
                var column = this;
                var select = $('<select><option value="">All</option></select>')
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
        // pdf
        $scope.renderprintdata = function()
        {
            try{

                var docDefinition = {
                    pageOrientation: 'portrait',
                    content: [
                        
                        {text:$scope.drawTable,style:'report_header'},
                        
                        //table($scope.drawTable),  
                        //table($scope.subjectlist,["Subject","Obtained Marks","Total Marks","Grade"],["subject","evalution",]),
                                           

                   ],

                    styles: {
                        report_header: {
                            fontSize: 14,
                            bold: false,
                            alignment: 'center',
                            margin: [0, 10, 0, 40]
                        },
                        report_logo: {
                            alignment: 'center'
                        },
                        
                    }
                };
                return docDefinition;
            }
            catch(e){}
        }
        $scope.download = function()
        {
            var reportobj = $scope.renderprintdata();
            var filename = "Schedule";
            
             pdfMake.createPdf(reportobj).download(filename);
        }

    });
// Pdf Graph
    $scope.scheduleData = null;
    $scope.isDataAvailable = 1;
    $("#ttable").show();

        $scope.getBaseUrl = function(url)
        {
          google.charts.load('current', {'packages':['corechart','timeline','table', 'controls']});
          $scope.baseUrl = url;
          $scope.getScheduleGraph();
          
        }

        $scope.getScheduleGraph = function()
        {
          $scope.result = $http.get('dashboardschedule',({})).then(function(response){

              if(response.data.length > 0){
                $scope.timetableloaded = true;
                $scope.scheduleData = response.data;
                google.charts.setOnLoadCallback($scope.drawTable);
              } 
              else{
                $scope.timetableloaded = true;
                $("#timetable").html('No  schedule found')
              }
            });
        }

        $scope.drawTable = function()
        {
          $scope.isDataAvailable = null;

          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Class Name');
          data.addColumn('string', 'Subject Name');
          data.addColumn('date', 'Start Time');
          data.addColumn('date', 'End Time');

          angular.forEach($scope.scheduleData,function(value, key)
          {
            $scope.isDataAvailable = 1;

            var sdate = value.start_time.split(":")
            var edate = value.end_time.split(":")
            data.addRows([
                [ value.grade +' '+value.section_name, value.subject_name+'( '+value.screenname+' )',  new Date(0,0,0,sdate[0],sdate[1],0) , new Date(0,0,0,edate[0],edate[1],0)]
            ]);
            
          });
          

          $('#table_window').css('display','block');
          $('#noDataMessage2').css('display','none');
          $("#timetable").html('')
          var table = new google.visualization.Timeline(document.getElementById('timetable'));
          table.draw(data, {width: '100%',height:'100%'});//, height: '300px'

          if($scope.isDataAvailable == null)
          {
            $('#table_window').css('display','none');
            $('#noDataMessage2').css('display','block');
          }
          
        }
});
</script>
<script src="<?php echo $path_url; ?>js/jquery.easyResponsiveTabs.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

















