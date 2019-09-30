<div class="col-lg-12  widget custom-body hide" ng-controller="attendanceChartController" ng-init="getBaseUrl('<?php echo base_url(); ?>')">
    <div class="widget-header" id="widget-header" ng-init="getAttendanceCount()">
        <!-- widget title -->
        <div class="widget-title">
            <span id="">
                Teacher
             </span>
        </div>
    </div>
    <div class="widget-body custom-body">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 widget-layout">
                    <div class="tile-stats tile-green">
                        <a href="">
                            <div class="icon">
                                 <img src="<?php echo $path_url; ?>images/student.png">
                            </div>
                            <hr>
<h3><a href="<?php echo $path_url; ?>show_std_list" id="action">Students</a></h3> </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 widget-layout">
                    <div class="tile-stats tile-aqua">
                        <a href="">
                            <div class="icon">
                                <img src="<?php echo $path_url; ?>images/classes.png">
                            </div>
                            <hr>
                            <h3><a href="<?php echo $path_url; ?>show_class_list" id="actiond">Classes</a></h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 widget-layout">
                    <div class="tile-stats tile-blue">
                        <a href="">
                            <div class="icon">
                                <img src="<?php echo $path_url; ?>images/library.png">
                            </div>
                            <hr>
                            <h3><a href="<?php echo $path_url; ?>show_subject_list" id="action">Courses</a></h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>

  app.controller('attendanceChartController', function($scope, $window, $http, $document, $timeout)

  {

    $scope.presentStaff = 0;

    $scope.absentStaff = 0;

    $scope.leaveStaff = 999;

    $scope.chartType = "Bar chart";

    $scope.chartPeriod = "Daily";

    $scope.weeklyPresent = 0;

    $scope.weeklyAbsent = 0;

    $scope.weeklyLeave = 0;

    $scope.isDataAvailable = 1;



    $scope.mondayPresent = 0; $scope.mondayAbsent = 0;

    $scope.tuesdayPresent = 0; $scope.tuesdayAbsent = 0;

    $scope.wednesdayPresent = 0; $scope.wednesdayAbsent = 0;

    $scope.thursdayPresent = 0; $scope.thursdayAbsent = 0;

    $scope.fridayPresent = 0; $scope.fridayAbsent = 0;

    $scope.saturdayPresent = 0; $scope.saturdayAbsent = 0;

    $scope.sundayPresent = 0; $scope.sundayAbsent = 0;





    $scope.getBaseUrl = function(url)
    {

      $scope.baseUrl = url;
      //console.log($scope.baseUrl);
    }

    $scope.getAttendanceCount = function()
    {

      //console.log("Pie Chart Loaded");

      if($scope.presentStaff == 0 && $scope.absentStaff == 0 && $scope.leaveStaff == 999)

      {

        $scope.result = $http.post($scope.baseUrl+'attendance_controller/presentStaffToday').then(function(response){

        

          $scope.presentStaff = response.data;

          //console.log("ChartPresent: "+$scope.presentStaff);

        });

        //get absent employees

        $scope.result = $http.post($scope.baseUrl+'attendance_controller/absentStaffToday').then(function(response){

          $scope.absentStaff = response.data;

          //console.log("ChartAbsent: "+$scope.absentStaff);

        });

        //get leave employees

        $scope.result = $http.post($scope.baseUrl+'attendance_controller/leaveStaffToday').then(function(response){

          $scope.leaveStaff = response.data;

          //console.log("ChartLeave: "+$scope.leaveStaff);



          

          if($scope.chartType == "Pie chart")

          {

            // Load the Visualization API and the corechart package.

            // google.charts.load('current', {'packages':['corechart','table', 'controls']});

            // Set a callback to run when the Google Visualization API is loaded.

            google.charts.setOnLoadCallback($scope.drawPieChart);

          }

          else

          {

            // Load the Visualization API and the corechart package.

            //google.charts.load('current', {'packages':['bar']});

            // google.charts.load('current', {'packages':['corechart','table', 'controls']});

            // Set a callback to run when the Google Visualization API is loaded.

            google.charts.setOnLoadCallback($scope.drawBarChart);

          }

        });

      }

      else

      {

        if($scope.chartType == "Pie chart")

        {

          // Load the Visualization API and the corechart package.

          // google.charts.load('current', {'packages':['corechart','table']});

          // Set a callback to run when the Google Visualization API is loaded.

          google.charts.setOnLoadCallback($scope.drawPieChart);

        }

        else

        {

          // Load the Visualization API and the corechart package.

          //google.charts.load('current', {'packages':['bar']});

          // google.charts.load('current', {'packages':['corechart','table']});

          // Set a callback to run when the Google Visualization API is loaded.

          google.charts.setOnLoadCallback($scope.drawBarChart);

        }

      }

      //$window.alert('ABCDEF');
    }   

    $scope.drawPieChart = function()
    {

      //$window.alert('In draw chart');

      // Create the data table.

      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Status');

      data.addColumn('number', 'Count');

      data.addRows([

        ['Present', parseInt($scope.presentStaff,10)],

        ['Absent', parseInt($scope.absentStaff,10)],

        ['Leave', parseInt($scope.leaveStaff,10)]

      ]);



      // Set chart options

      var options = {

              //'title':'Attendance Summary',

                     // 'is3D':true,

                     // 'backgroundColor':'#757575',

                     'height':'100%',

                     'width':'100%'

              };


      $('#chart_window').css('display','block');
      $('#noDataMessage').css('display','none');

      // Instantiate and draw our chart, passing in some options.

      var chart = new google.visualization.PieChart(document.getElementById('chart_window'));

      chart.draw(data, options);

      if($scope.presentStaff == 0 && $scope.absentStaff == 0 && $scope.leaveStaff == 0)
      {
        $('#chart_window').css('display','none');
        $('#noDataMessage').css('display','block');
      }
    }

    $scope.drawPieChart2 = function()
    {

      //$window.alert('In draw chart');

      // Create the data table.

      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Status');

      data.addColumn('number', 'Count');

      data.addRows([

        ['Present', parseInt($scope.weeklyPresent,10)],

        ['Absent', parseInt($scope.weeklyAbsent,10)],

        ['Leave', parseInt($scope.weeklyLeave,10)]

      ]);



      // Set chart options

      var options = {

              //'title':'Attendance Summary',

                     'is3D':true,

                     // 'backgroundColor':'#757575',

                     'height':'100%',

                     'width':'99%'

              };


      $('#chart_window').css('display','block');
      $('#noDataMessage').css('display','none');

      // Instantiate and draw our chart, passing in some options.

      var chart = new google.visualization.PieChart(document.getElementById('chart_window'));

      chart.draw(data, options);

      if($scope.weeklyPresent == 0 && $scope.weeklyAbsent == 0 && $scope.weeklyLeave == 0)
      {
        $('#chart_window').css('display','none');
        $('#noDataMessage').css('display','block');
      }
    }

    $scope.drawBarChart = function()
    {

      //$window.alert('In draw chart');

      // Create the data table.

      var data = google.visualization.arrayToDataTable([

        ["Day", "Present", "Absent", "Leave"],

        ["Today", parseInt($scope.presentStaff,10), parseInt($scope.absentStaff,10), parseInt($scope.leaveStaff,10)]

        

        ]);

      var view = new google.visualization.DataView(data);

      // view.setColumns([0, 1,

      //                { calc: "stringify",

      //                  sourceColumn: 1,

      //                  type: "string",

      //                  role: "annotation" },

      //                2]);



      // Set chart options

      var options = {

              //'title':'Attendance Summary',

                     'is3D':true,

                     // 'backgroundColor':'#757575'

              };


      $('#chart_window').css('display','block');
      $('#noDataMessage').css('display','none');

      // Instantiate and draw our chart, passing in some options.

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_window'));

      chart.draw(view, options);
      if($scope.presentStaff == 0 && $scope.absentStaff == 0 && $scope.leaveStaff == 0)
      {
        $('#chart_window').css('display','none');
        $('#noDataMessage').css('display','block');
      }
    }

    $scope.drawBarChart2 = function()
    {

      // console.log('MondayPresent: '+ $scope.mondayPresent);

      // console.log('TuesdayPresent: '+ $scope.tuesdayPresent);

      // console.log('wednesdayPresent: '+ $scope.wednesdayPresent);

      // console.log('thursdayPresent: '+ $scope.thursdayPresent);

      // console.log('fridayPresent: '+ $scope.fridayPresent);

      // console.log('saturdayPresent: '+ $scope.saturdayPresent);

      // console.log('sundayPresent: '+ $scope.sundayPresent);

      //$window.alert('In draw chart');

      // Create the data table.

      var data = google.visualization.arrayToDataTable([

        ["Day", "Present", "Absent", "Leave"],

        ["Sunday", parseInt($scope.sundayPresent,10), parseInt($scope.sundayAbsent,10), 0],

        ["Monday", parseInt($scope.mondayPresent,10), parseInt($scope.mondayAbsent,10), 0],

        ["Tuesday", parseInt($scope.tuesdayPresent,10), parseInt($scope.tuesdayAbsent,10), 0],

        ["Wednesday", parseInt($scope.wednesdayPresent,10), parseInt($scope.wednesdayAbsent,10), 0],

        ["Thursday", parseInt($scope.thursdayPresent,10), parseInt($scope.thursdayAbsent,10), 0],

        ["Friday", parseInt($scope.fridayPresent,10), parseInt($scope.fridayAbsent,10), 0],

        ["Saturday", parseInt($scope.saturdayPresent,10), parseInt($scope.saturdayAbsent,10), 0]

        ]);

      var view = new google.visualization.DataView(data);

      // view.setColumns([0, 1,

      //                { calc: "stringify",

      //                  sourceColumn: 1,

      //                  type: "string",

      //                  role: "annotation" },

      //                2]);



      // Set chart options

      var options = {

              //'title':'Attendance Summary',

                     'is3D':true,

                     // 'backgroundColor':'#757575'

              };


      $('#chart_window').css('display','block');
      $('#noDataMessage').css('display','none');

      // Instantiate and draw our chart, passing in some options.

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_window'));

      chart.draw(view, options);

      if($scope.mondayPresent == 0 && $scope.mondayAbsent == 0 && $scope.tuesdayPresent == 0 && $scope.tuesdayAbsent == 0 && $scope.wednesdayPresent == 0 && $scope.wednesdayAbsent == 0 && $scope.thursdayPresent == 0 && $scope.thursdayAbsent == 0)
      {
        $('#chart_window').css('display','none');
        $('#noDataMessage').css('display','block');
      }
    }

    $scope.chartTypeSelector = function(temp)
    {

      if(temp==0)

      {

        $scope.chartType = "Pie chart";

      }

      else if(temp == 1)

      {

        $scope.chartType = "Bar chart";

      }

      if($scope.chartPeriod == 'Daily')

      {

        $scope.getAttendanceCount();

      }

      else

      {

        $scope.chartPeriodSelector('Weekly');

      }
    }

    $scope.chartPeriodSelector = function(temp)
    {

      if(temp == 'Daily')

      {

        $scope.chartPeriod = 'Daily';

        //$window.alert("Daily: ");

        if($scope.chartType == 'Pie chart')

        {

          $scope.chartTypeSelector(0);

        }

        else

        {

          $scope.chartTypeSelector(1);

        }

      }

      if(temp == 'Weekly' && $scope.chartType == 'Bar chart')

      {

        //$window.alert("Weekly: ");

        //Get Present ones

        if($scope.mondayPresent == 0 && $scope.mondayAbsent == 0 && $scope.tuesdayPresent == 0 && $scope.tuesdayAbsent == 0 && $scope.wednesdayPresent == 0 && $scope.wednesdayAbsent == 0)

        {

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentMondayPresentAttendance').then(function(response){

            $scope.mondayPresent = response.data;

            //console.log('MondayPresent: '+ $scope.mondayPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentTuesdayPresentAttendance').then(function(response){

            $scope.tuesdayPresent = response.data;

            //console.log('TuesdayPresent: '+ $scope.tuesdayPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentWednesdayPresentAttendance').then(function(response){

            $scope.wednesdayPresent = response.data;

            //console.log('wednesdayPresent: '+ $scope.wednesdayPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentThursdayPresentAttendance').then(function(response){

            $scope.thursdayPresent = response.data;

            //console.log('thursdayPresent: '+ $scope.thursdayPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentFridayPresentAttendance').then(function(response){

            $scope.fridayPresent = response.data;

            //console.log('fridayPresent: '+ $scope.fridayPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentSaturdayPresentAttendance').then(function(response){

            $scope.saturdayPresent = response.data;

            //console.log('saturdayPresent: '+ $scope.saturdayPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentSundayPresentAttendance').then(function(response){

            $scope.sundayPresent = response.data;

            //console.log('sundayPresent: '+ $scope.sundayPresent);

          });







          //Get Absent ones

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentMondayAbsentAttendance').then(function(response){

            $scope.mondayAbsent = response.data;

            //console.log('MondayAbsent: '+ $scope.mondayAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentTuesdayAbsentAttendance').then(function(response){

            $scope.tuesdayAbsent = response.data;

            //console.log('TuesdayAbsent: '+ $scope.tuesdayAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentWednesdayAbsentAttendance').then(function(response){

            $scope.wednesdayAbsent = response.data;

            //console.log('wednesdayAbsent: '+ $scope.wednesdayAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentThursdayAbsentAttendance').then(function(response){

            $scope.thursdayAbsent = response.data;

            //console.log('thursdayAbsent: '+ $scope.thursdayAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentFridayAbsentAttendance').then(function(response){

            $scope.fridayAbsent = response.data;

            //console.log('fridayAbsent: '+ $scope.fridayAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentSaturdayAbsentAttendance').then(function(response){

            $scope.saturdayAbsent = response.data;

            //console.log('saturdayAbsent: '+ $scope.saturdayAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentSundayAbsentAttendance').then(function(response){

            $scope.sundayAbsent = response.data;

            //console.log('sundayAbsent: '+ $scope.sundayAbsent);

            

          });

          //draw chart

          $timeout($scope.drawBarChart2,5000);

        }

        else

        {

          //draw chart

          $scope.drawBarChart2();

        }

        

        

        

            

        $scope.chartPeriod = 'Weekly';

      }

      if(temp == 'Weekly' && $scope.chartType == 'Pie chart')

      {

        if($scope.weeklyPresent == 0 && $scope.weeklyAbsent == 0 && $scope.weeklyLeave == 0)

        {

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentWeekPresentAttendance').then(function(response){

            $scope.weeklyPresent = response.data;

            //console.log('WeeklyPresent: '+ $scope.weeklyPresent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentWeekAbsentAttendance').then(function(response){

            $scope.weeklyAbsent = response.data;

            //console.log('WeeklyAbsent: '+ $scope.weeklyAbsent);

          });

          $scope.result = $http.post($scope.baseUrl+'attendance_controller/currentWeekLeaveAttendance').then(function(response){

            $scope.weeklyLeave = response.data;

            //console.log('WeeklyLeave: '+ $scope.weeklyLeave);

          });

          //draw chart

          $timeout($scope.drawPieChart2,5000);

        }

        else

        {

          //draw chart

          $scope.drawPieChart2();

        }



        $scope.chartPeriod = 'Weekly';



        //$scope.weeklyPresent = 37;

        

      }
    }

  });

</script>