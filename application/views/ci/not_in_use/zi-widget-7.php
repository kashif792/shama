<div class="col-lg-12 widget-box" ng-controller="projectProgressController">
 <div class="dss-widget widget" id="widget7" ng-init="getBaseUrl('<?php echo base_url(); ?>')">
    <div class="row">
      <div class="row widget-header" id="widget-header" >
        <div class="col-lg-12  ">
          <!-- widget options -->
          <!-- widget options -->
          <div class="widget-item-list">
            <ul class="nav nav-pills">
              <li class="dropdown">
                <input name="projectMonth" id="projectMonth" class="date-picker" placeholder="Select month" />
                <!-- <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">
                  <span id="option-text">January</span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                      <a id="widget7ChartOptions" ng-click="" href="#">February</a>
                    </li>
                    <li>
                      <a id="widget7ChartOptions" ng-click="" href="#">March</a>
                    </li>
                    <li>
                      <a id="widget7ChartOptions" ng-click="" href="#">April</a>
                    </li>
                </ul> -->
              </li>
              <li class="dropdown">
                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">
                  <span id="option-text">{{periodSelector}}</span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                      <a id="widget7ChartOptions" ng-click="periodSelection('Total Hours')" href="#">Total Hours</a>
                    </li>
                    <li>
                      <a id="widget7ChartOptions" ng-click="periodSelection('Last Week')" href="#">Last Week</a>
                    </li>
                    <li>
                      <a id="widget7ChartOptions" ng-click="periodSelection('Last Month')" href="#">Last Month</a>
                    </li>
                </ul>
              </li>
              <li class="dropdown">
                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">
                  <span id="option-text">{{projectSelector}}</span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                      <a id="widget7ChartOptions" ng-click="projectSelection('All Projects')" href="#">All Projects</a>
                    </li>
                    <li ng-repeat="project in projectsRelated">
                      <a id="widget7ChartOptions" ng-click="projectSelection(project.project_name)" href="#">{{project.project_name}}</a>
                    </li>
                    
                </ul>
              </li>
            </ul>
           <div class="clear"></div>
          </div>
          <!-- widget title -->
          <div class="row widget-title col-lg-12">
            <span id="">
             Project Hours Report
             </span>
             </div>
         </div>
        </div>
        <div class="row widget-body">
         <div class="col-lg-12 custome-widget-width">
          <div class="content_holder">
            <div id="project_status_window"></div>
            <div id="noDataMessage2">No data to display.....</div>
            
          </div>
          <div>
           <div class="loader-container"></div>
             <div class="dashboard-no-report-data hide" id="ttypes-no-data-container">
              <span>No payroll data found.</span>
             </div>
             
              <div class="graph-choice slideUp" data-view="3" id="opt2">
                  <div google-chart chart="chartObject" style="width:100%"></div>
              </div>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <style type="text/css">
    .widget .choice
    {
      display: block;
    }
     .widget .slideUp
    {
      display: block !important;
      position: auto !important;
      left:0px !important;
    }
  .widget-box {margin-bottom: 1px;padding: 3px;margin-top: 1px;}

div.widget {
    max-height: 300px;
    min-height: 300px;
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 15px;
}

.widget-title {
    padding-top: 0px;
}

.widget-body {
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
}

.custome-widget-width {
    width: 100%;
    padding: 0px;
}

.widget-body {
    padding: 0px !important;
}
#widget7{
  max-height: 600px !important;
}

/*Date Picker*/
.ui-datepicker-calendar {
    display: none;
    }
    #projectMonth {
      border: 0;
      min-height: 35px;
      padding-left: 10px;
      color: #a5a5a5 !important;
    }
  #noDataMessage2 {
  color: red;
  padding-left: 10px;
  display: none;
}

  </style>


<script type="text/javascript">
// $(function() {
//     $('.date-picker').datepicker( {
//         changeMonth: true,
//         changeYear: true,
//         // showButtonPanel: true,
//         dateFormat: 'MM yy',
//         onClose: function(dateText, inst) { 
//             $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
//             angular.element(document.getElementById('projectMonth')).scope().pickMonth($(this).datepicker('getDate'));

//             //console.log("Date is: "+$(this).datepicker('getDate'));
//         }
//     });
// });
var dateHolder = null;
$( function() {
    $( ".date-picker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'MM yy',
        showButtonPanel: true,
        beforeShow: function(element, inst){
          //var dateHolder = $(this).datepicker('getDate');
          console.log('Date going in: '+dateHolder);
          if(dateHolder!=null)
          {
            $(this).datepicker('setDate', new Date(dateHolder.toDateString()));
          }
        },
        onClose: function(dateText , inst){
          $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
          dateHolder = new Date(inst.selectedYear, inst.selectedMonth, 1);
          console.log('Date selected: '+dateHolder);
          //console.log("Date is: "+new Date(inst.selectedYear, inst.selectedMonth, 1));
          angular.element(document.getElementById('projectMonth')).scope().pickMonth(new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
  } );

</script>





<script>
  app.controller('projectProgressController',function($scope, $window, $http, $document, $timeout, $filter){
    
    $scope.baseUrl = null;
    $scope.projectList = null;
    $scope.projectListWeek = null;
    $scope.projectListMonth = null;
    $scope.customProjectList = null;
    $scope.customProjectList2 = null;
    $scope.preparedList = [{}];
    $scope.preparedListWeek = [{}];
    $scope.preparedListMonth = [{}];
    $scope.periodSelector = "Total Hours";
    $scope.projectSelector = "All Projects";
    $scope.customProjectListPrepared = [{}];
    $scope.customProjectListPrepared2 = [{}];
    $scope.projectsRelated = [];
    $scope.monthValue = null;
    $scope.monthlyProjectList = null;
    $scope.monthlyPreparedList = [{}];
    $scope.isMonthSelected = null;
    $scope.monthSelector = null;

    $scope.isDataAvailable = 1;

    $scope.getBaseUrl = function(url)
    {
      $scope.baseUrl = url;
      $scope.projectStatus();
    }

    $scope.projectStatus = function()
    {
      if($scope.projectList == null)
      {
        $scope.result = $http.post($scope.baseUrl+'attendance_controller/projectStatusReport').then(function(response){

          $scope.projectList = response.data;

          //console.log('Project Data: '+response.data);
          $scope.prepareData();

        });
      }
      else
      {
        $scope.prepareData();
      }
    }

    $scope.projectStatus2 = function()
    {
      if($scope.projectListWeek == null)
      {
        $scope.result = $http.post($scope.baseUrl+'attendance_controller/lastWeekProjectStatus').then(function(response){

          $scope.projectListWeek = response.data;

          //console.log('Project Data: '+response.data);
          $scope.prepareData2();

        });
      }
      else
      {
        $scope.prepareData2();
      }
    }

    $scope.projectStatus3 = function()
    {
      if($scope.projectListMonth == null)
      {
        $scope.result = $http.post($scope.baseUrl+'attendance_controller/lastMonthProjectStatus').then(function(response){

          $scope.projectListMonth = response.data;

          //console.log('Monthly Project Data: '+response.data);
          $scope.prepareData3();

        });
      }
      else
      {
        $scope.prepareData3();
      }
    }

    $scope.prepareData = function()
    {
      $scope.preparedList = [{}];
      $scope.projectsRelated = [];
      angular.forEach($scope.projectList,function(value, key)

      {
        var temporaryPName = value.project_name;
        var temporaryEHours = parseInt(value.estimated_hours,10);
        if(value.totalcount != null)
        {
          var temporaryTHours = parseInt(value.alredy_spend_hours,10) + parseInt(value.totalcount,10);
        }
        else
        {
          var temporaryTHours = parseInt(value.alredy_spend_hours,10) + 0;
        }
        if(temporaryEHours <= 0 )
        {
          //var temporaryPercent = temporaryTHours;
          var temporaryPercent = 99.99;
        }
        else
        {
          var temporaryPercent = (temporaryTHours/temporaryEHours)*100;
        }
        if(temporaryPercent > 60)
        {
          var temporaryClass = "progress-bar-success";
        }
        else if(temporaryPercent > 40 && temporaryPercent < 60)
        {
          var temporaryClass = "progress-bar-info";
        }
        else
        {
          var temporaryClass = "progress-bar-danger";
        }


        var temp = {'project_name': temporaryPName,
                    'estimated_hours': temporaryEHours,
                    'total_hours': temporaryTHours,
                    'percentage': temporaryPercent,
                    'class': temporaryClass,
        }


        $scope.preparedList.push(temp);

        var temp21 = {'project_name': temporaryPName
        }
        $scope.projectsRelated.push(temp21);

      });

      //console.log($scope.preparedList);
      //google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback($scope.drawTable);
    }

    $scope.prepareData2 = function()
    {
      $scope.preparedListWeek = [{}];
      $scope.projectsRelated = [];
      angular.forEach($scope.projectListWeek,function(value, key)

      {
        var temporaryPName = value.project_name;
        var temporaryEHours = parseInt(value.estimated_hours,10);
        if(value.totalcount != null)
        {
          var temporaryTHours = parseInt(value.totalcount,10);
        }
        else
        {
          var temporaryTHours = 0;
        }
        if(temporaryEHours <= 0 )
        {
          //var temporaryPercent = temporaryTHours;
          var temporaryPercent = 99.99;
        }
        else
        {
          var temporaryPercent = (temporaryTHours/temporaryEHours)*100;
        }
        if(temporaryPercent > 60)
        {
          var temporaryClass = "progress-bar-success";
        }
        else if(temporaryPercent > 40 && temporaryPercent < 60)
        {
          var temporaryClass = "progress-bar-info";
        }
        else
        {
          var temporaryClass = "progress-bar-danger";
        }


        var temp = {'project_name': temporaryPName,
                    'estimated_hours': temporaryEHours,
                    'total_hours': temporaryTHours,
                    'percentage': temporaryPercent,
                    'class': temporaryClass,
        }


        $scope.preparedListWeek.push(temp);
        
        var temp21 = {'project_name': temporaryPName
        }
        $scope.projectsRelated.push(temp21);

      });

      //console.log($scope.preparedListWeek);
      //google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback($scope.drawTable2);
    }

    $scope.prepareData3 = function()
    {
      $scope.preparedListMonth[{}];
      $scope.projectsRelated = [];
      angular.forEach($scope.projectListMonth,function(value, key)

      {
        var temporaryPName = value.project_name;
        var temporaryEHours = parseInt(value.estimated_hours,10);
        if(value.totalcount != null)
        {
          var temporaryTHours = parseInt(value.totalcount,10);
        }
        else
        {
          var temporaryTHours = 0;
        }
        if(temporaryEHours <= 0 )
        {
          //var temporaryPercent = temporaryTHours;
          var temporaryPercent = 99.99;
        }
        else
        {
          var temporaryPercent = (temporaryTHours/temporaryEHours)*100;
        }
        if(temporaryPercent > 60)
        {
          var temporaryClass = "progress-bar-success";
        }
        else if(temporaryPercent > 40 && temporaryPercent < 60)
        {
          var temporaryClass = "progress-bar-info";
        }
        else
        {
          var temporaryClass = "progress-bar-danger";
        }


        var temp = {'project_name': temporaryPName,
                    'estimated_hours': temporaryEHours,
                    'total_hours': temporaryTHours,
                    'percentage': temporaryPercent,
                    'class': temporaryClass,
        }


        $scope.preparedListMonth.push(temp);
        
        var temp21 = {'project_name': temporaryPName
        }
        $scope.projectsRelated.push(temp21);

      });

      //console.log($scope.preparedList);
      //google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback($scope.drawTable3);
    }

    $scope.prepareData4 = function()
    {
      $scope.customProjectListPrepared = [{}];
      angular.forEach($scope.customProjectList,function(value, key)

      {
        var temporaryEName = value.Name;
        var temporaryEHours = parseInt(value.estimated_hours,10);
        if(value.totalcount != null)
        {
          var temporaryTHours = parseInt(value.totalcount,10);
        }
        else
        {
          var temporaryTHours = 0;
        }
        if(temporaryEHours <= 0 )
        {
          //var temporaryPercent = temporaryTHours;
          var temporaryPercent = 99.99;
        }
        else
        {
          var temporaryPercent = (temporaryTHours/temporaryEHours)*100;
        }
        if(temporaryPercent > 60)
        {
          var temporaryClass = "progress-bar-success";
        }
        else if(temporaryPercent > 40 && temporaryPercent < 60)
        {
          var temporaryClass = "progress-bar-info";
        }
        else
        {
          var temporaryClass = "progress-bar-danger";
        }


        var temp = {'employee_name': temporaryEName,
                    'estimated_hours': temporaryEHours,
                    'total_hours': temporaryTHours,
                    'percentage': temporaryPercent,
                    'class': temporaryClass,
        }


        $scope.customProjectListPrepared.push(temp);
        
        

      });

      //console.log($scope.preparedList);
      //google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback($scope.drawTable4);
    }

    $scope.prepareData5 = function()
    {
      $scope.monthlyPreparedList = [{}];
      $scope.projectsRelated = [];
      angular.forEach($scope.monthlyProjectList,function(value, key)

      {
        var temporaryPName = value.project_name;
        var temporaryEHours = parseInt(value.estimated_hours,10);
        if(value.totalcount != null)
        {
          var temporaryTHours = parseInt(value.totalcount,10);
        }
        else
        {
          var temporaryTHours = parseInt(value.alredy_spend_hours,10) + 0;
        }
        if(temporaryEHours <= 0 )
        {
          //var temporaryPercent = temporaryTHours;
          var temporaryPercent = 99.99;
        }
        else
        {
          var temporaryPercent = (temporaryTHours/temporaryEHours)*100;
        }
        if(temporaryPercent > 60)
        {
          var temporaryClass = "progress-bar-success";
        }
        else if(temporaryPercent > 40 && temporaryPercent < 60)
        {
          var temporaryClass = "progress-bar-info";
        }
        else
        {
          var temporaryClass = "progress-bar-danger";
        }


        var temp = {'project_name': temporaryPName,
                    'estimated_hours': temporaryEHours,
                    'total_hours': temporaryTHours,
                    'percentage': temporaryPercent,
                    'class': temporaryClass,
        }


        $scope.monthlyPreparedList.push(temp);

        var temp21 = {'project_name': temporaryPName
        }
        $scope.projectsRelated.push(temp21);

      });

      //console.log($scope.preparedList);
      //google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback($scope.drawTable5);
    }

    $scope.prepareData6 = function()
    {
      $scope.customProjectListPrepared2 = [{}];
      angular.forEach($scope.customProjectList2,function(value, key)

      {
        var temporaryEName = value.Name;
        var temporaryEHours = parseInt(value.estimated_hours,10);
        if(value.totalcount != null)
        {
          var temporaryTHours = parseInt(value.totalcount,10);
        }
        else
        {
          var temporaryTHours = 0;
        }
        if(temporaryEHours <= 0 )
        {
          //var temporaryPercent = temporaryTHours;
          var temporaryPercent = 99.99;
        }
        else
        {
          var temporaryPercent = (temporaryTHours/temporaryEHours)*100;
        }
        if(temporaryPercent > 60)
        {
          var temporaryClass = "progress-bar-success";
        }
        else if(temporaryPercent > 40 && temporaryPercent < 60)
        {
          var temporaryClass = "progress-bar-info";
        }
        else
        {
          var temporaryClass = "progress-bar-danger";
        }


        var temp = {'employee_name': temporaryEName,
                    'estimated_hours': temporaryEHours,
                    'total_hours': temporaryTHours,
                    'percentage': temporaryPercent,
                    'class': temporaryClass,
        }


        $scope.customProjectListPrepared2.push(temp);
        
        

      });

      //console.log($scope.preparedList);
      //google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback($scope.drawTable6);
    }

    $scope.drawTable = function()
    {
      $scope.isDataAvailable = null;
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Project name');

      data.addColumn('number', 'Hours worked');
      var count = 1;

      angular.forEach($scope.preparedList,function(value, key)

      {
        
        if(count != 1)
        {
          $scope.isDataAvailable = 1;
          data.addRows([

            [ value.project_name, value.total_hours]

          ]);
          
        }
        count = count +1;

      });

      $('#project_status_window').css('display','block');
      $('#noDataMessage2').css('display','none');

      var chart = new google.visualization.ColumnChart(document.getElementById("project_status_window"));
      chart.draw(data);

      if($scope.isDataAvailable == null)
      {
        $('#project_status_window').css('display','none');
        $('#noDataMessage2').css('display','block');
      }
    }

    $scope.drawTable2 = function()
    {
      $scope.isDataAvailable = null;
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Project name');

      data.addColumn('number', 'Hours worked');
      var count = 1;

      angular.forEach($scope.preparedListWeek,function(value, key)

      {
        
        if(count != 1)
        {
          $scope.isDataAvailable = 1;
          data.addRows([

            [ value.project_name, value.total_hours]

          ]);
          
        }
        count = count +1;

      });

      $('#project_status_window').css('display','block');
      $('#noDataMessage2').css('display','none');

      var chart = new google.visualization.ColumnChart(document.getElementById("project_status_window"));
      chart.draw(data);

      if($scope.isDataAvailable == null)
      {
        $('#project_status_window').css('display','none');
        $('#noDataMessage2').css('display','block');
      }
    }

    $scope.drawTable3 = function()
    {
      $scope.isDataAvailable = null;
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Project name');

      data.addColumn('number', 'Hours worked');
      var count = 1;

      angular.forEach($scope.preparedListMonth,function(value, key)

      {
        
        if(count != 1)
        {
          $scope.isDataAvailable = 1;
          data.addRows([

            [ value.project_name, value.total_hours]

          ]);
          
        }
        count = count +1;

      });

      $('#project_status_window').css('display','block');
      $('#noDataMessage2').css('display','none');

      var chart = new google.visualization.ColumnChart(document.getElementById("project_status_window"));
      chart.draw(data);

      if($scope.isDataAvailable == null)
      {
        $('#project_status_window').css('display','none');
        $('#noDataMessage2').css('display','block');
      }

    }

    $scope.drawTable4 = function()
    {
      $scope.isDataAvailable = null;
      //alert('In drawTable4');
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Employee name');

      data.addColumn('number', 'Hours worked');
      var count = 1;

      angular.forEach($scope.customProjectListPrepared,function(value, key)

      {
        
        if(count != 1)
        {
          $scope.isDataAvailable = 1;
        
          //alert('In drawTable4, past count check');
          //console.log(value.employee_name+" * "+value.total_hours);
          data.addRows([

            [ value.employee_name, value.total_hours]

          ]);
          
        }
        count = count +1;

      });

      $('#project_status_window').css('display','block');
      $('#noDataMessage2').css('display','none');

      var chart = new google.visualization.ColumnChart(document.getElementById("project_status_window"));
      chart.draw(data);

      if($scope.isDataAvailable == null)
      {
        $('#project_status_window').css('display','none');
        $('#noDataMessage2').css('display','block');
      }
    }

    $scope.drawTable5 = function()
    {
      $scope.isDataAvailable = null;
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Project name');

      data.addColumn('number', 'Hours worked');
      var count = 1;

      angular.forEach($scope.monthlyPreparedList,function(value, key)

      {
        
        if(count != 1)
        {
          $scope.isDataAvailable = 1;
          data.addRows([

            [ value.project_name, value.total_hours]

          ]);
          
        }
        count = count +1;

      });

      $('#project_status_window').css('display','block');
      $('#noDataMessage2').css('display','none');

      var chart = new google.visualization.ColumnChart(document.getElementById("project_status_window"));
      chart.draw(data);

      if($scope.isDataAvailable == null)
      {
        $('#project_status_window').css('display','none');
        $('#noDataMessage2').css('display','block');
      }
    }

    $scope.drawTable6 = function()
    {
      $scope.isDataAvailable = null;
      //alert('In drawTable4');
      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Employee name');

      data.addColumn('number', 'Hours worked');
      var count = 1;

      angular.forEach($scope.customProjectListPrepared2,function(value, key)

      {
        
        if(count != 1)
        {
          $scope.isDataAvailable = 1;
        
          //alert('In drawTable4, past count check');
          //console.log(value.employee_name+" * "+value.total_hours);
          data.addRows([

            [ value.employee_name, value.total_hours]

          ]);
          
        }
        count = count +1;

      });

      $('#project_status_window').css('display','block');
      $('#noDataMessage2').css('display','none');

      var chart = new google.visualization.ColumnChart(document.getElementById("project_status_window"));
      chart.draw(data);

      if($scope.isDataAvailable == null)
      {
        $('#project_status_window').css('display','none');
        $('#noDataMessage2').css('display','block');
      }
    }

    $scope.periodSelection = function(period)
    {
      if($scope.projectSelector == "All Projects")
      {
        if(period == "Total Hours")
        {
          if($scope.projectList == null)
          {
            $scope.projectStatus();
          }
          $scope.periodSelector = "Total Hours";
        }
        else if(period == "Last Week")
        {
          if($scope.projectListWeek == null)
          {
            $scope.projectStatus2();
          }
          $scope.periodSelector = "Last Week";
        }
        else if(period == "Last Month")
        {
          if($scope.projectListMonth == null)
          {
            $scope.projectStatus3();
          }
          $scope.periodSelector = "Last Month";
        }
        $scope.isMonthSelected = null;
      }
      else
      {
        $scope.periodSelector = period;
        $scope.projectSelection($scope.projectSelector);
      }
        
    }

    $scope.projectSelection = function(tempProject)
    {
      //alert('Project '+tempProject+' selected');
      if(tempProject == 'All Projects')
      {
        if($scope.isMonthSelected == null)
        {
          //Check what is selected on period selector
          if($scope.periodSelector == 'Total Hours')
          {
            $scope.projectStatus();
          }
          else if($scope.periodSelector == 'Last Week')
          {
            $scope.projectStatus2();
          }
          else if($scope.periodSelector == 'Last Month')
          {
            $scope.projectStatus3();
          }
        }
        else
        {
          //Do something
          $scope.pickMonth($scope.monthSelector);
        }
        

        $scope.projectSelector = "All Projects";
      }
      else
      {
        if($scope.isMonthSelected == null)
        {
          if($scope.periodSelector == 'Total Hours')
          {
            
            $scope.selectedProject = {'project': tempProject};
            //alert('Period: '+$scope.periodSelector+' Project: '+tempProject);
            $scope.result = $http.post($scope.baseUrl+'attendance_controller/thisProjectStatusReportFromBeggining',$scope.selectedProject).then(function(response){
                $scope.customProjectList = response.data;
                console.log("Custom List: "+$scope.customProjectList);
                $scope.prepareData4();
            });
            //$scope.drawTable4();
          }
          else if($scope.periodSelector == 'Last Week')
          {
            $scope.selectedProject = {'project': tempProject};

            $scope.result = $http.post($scope.baseUrl+'attendance_controller/thisProjectStatusReportFromLastWeek',$scope.selectedProject).then(function(response){
                $scope.customProjectList = response.data;
                console.log("Custom List2: "+$scope.customProjectList);
                $scope.prepareData4();

            });
            //$scope.drawTable4();
          }
          else if($scope.periodSelector == 'Last Month')
          {
            $scope.selectedProject = {'project': tempProject};

            $scope.result = $http.post($scope.baseUrl+'attendance_controller/thisProjectStatusReportFromLastMonth',$scope.selectedProject).then(function(response){
                $scope.customProjectList = response.data;
                console.log("Custom List3: "+$scope.customProjectList);
                $scope.prepareData4();
            });
            //$scope.drawTable4();
          }
        }
        else
        {
          $scope.selectedMonthYear = {'month': $scope.monthSelector, 'project_name': tempProject};
      
          $scope.result = $http.post($scope.baseUrl+'attendance_controller/thisProjectsStatusReportFromSelectedMonth',$scope.selectedMonthYear).then(function(response){
              //console.log('Ok');
              $scope.customProjectList2 = response.data;
              $scope.isMonthSelected = 1;
              $scope.prepareData6();
          });
        }
        

        $scope.projectSelector = tempProject;


        
      }

    }


    // Date Picker related functions
    $scope.pickMonth = function(selectedDate)
    {

      
      //console.log('Month: '+$filter('date')(new Date(selectedDate), "MMMM yyyy"));
      var temp = $filter('date')(new Date(selectedDate), "MMMM yyyy");
      $scope.monthSelector = temp;


      
      if($scope.projectSelector == "All Projects")
      {
        $scope.selectedMonthYear = {'month': temp};
      
        $scope.result = $http.post($scope.baseUrl+'attendance_controller/allProjectsStatusReportFromSelectedMonth',$scope.selectedMonthYear).then(function(response){
            //console.log('Ok');
            $scope.monthlyProjectList = response.data;
            $scope.isMonthSelected = 1;
            $scope.prepareData5();
        });
      }
      else
      {
        $scope.isMonthSelected = 1;
        $scope.projectSelection($scope.projectSelector);
      }
    }



  });
</script>
