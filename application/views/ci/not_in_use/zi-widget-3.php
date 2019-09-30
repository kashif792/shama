<div class="col-lg-12 widget-box" id="widgetHolder3" ng-controller="attendanceTableController">

 <div class="dss-widget widget tableWidget" ng-init="getBaseUrl('<?php echo base_url(); ?>')" >

    <div class="row" ng-init="readyAttendanceRecords('all')">

      <div class="row widget-header" id="widget-header" >

        <div class="col-lg-12  ">

          <!-- widget options -->

          <!-- widget options -->

          <div class="widget-item-list">

            <ul class="nav nav-pills">

             <li class="dropdown">

                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">

                  <span id="option-text">{{attendanceSelector}}</span>

                  <span class="caret"></span>

                </a>

                <ul class="dropdown-menu" ng-model="selectedopt">

                    <li>

                      <a id="widget3ChartOptions" ng-click="readyAttendanceRecords('all')" href="#">All</a>

                    </li>

                    <li>

                      <a id="widget3ChartOptions" ng-click="readyAttendanceRecords('present')" href="#">Present</a>

                    </li>

                    <li>

                      <a id="widget3ChartOptions" ng-click="readyAttendanceRecords('absent')" href="#">Absent</a>

                    </li>

                </ul>

              </li>

              

            </ul>

           <div class="clear"></div>

          </div>

          <!-- widget title -->

          <div class="row widget-title col-lg-12">

            <span id="">

             Daily Attendance Report

             </span>

             </div>

         </div>

        </div>

        <div class="row widget-body">

         <div class="col-lg-12 custome-widget-width">

          <div id="table_window" ></div>
          <div id="noDataMessage">No data to display.....</div>

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

    /

  .widget-box {margin-bottom: 1px;padding: 3px;margin-top: 1px;}



div.widget {

    max-height: 300px;

    min-height: 300px;

    padding-left: 0px;

    padding-right: 0px;

    padding-top: 15px;

}



.widget-title {
    clear: both;
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

.tableWidget{

  overflow: auto;

  overflow-x: hidden;

}








#noDataMessage{
  color: red;
  padding-left: 10px;
}


#widgetHolder3{

  overflow: auto;

}

</style>





<script>

  app.controller('attendanceTableController',function($scope, $window, $http, $document, $timeout ,$filter)

  {

    $scope.presentStaff = null;

    $scope.absentStaff = null;

    $scope.totalStaff = null;

    $scope.attendanceSelector = 'All';

    $scope.isDataAvailable = 1;



    $scope.getBaseUrl = function(url)

    {

      $scope.baseUrl = url;

      // $scope.getAttendanceSummary();

    }



    $scope.readyAttendanceRecords = function(status)

    {

      //$window.alert('Getting ready');

      //console.log("Table Loaded");

      if(status == 'all')

      {

        $scope.attendanceSelector = 'All';

      }

      if(status == 'present')

      {

        $scope.attendanceSelector = 'Present';

      }

      if(status == 'absent')

      {

        $scope.attendanceSelector = 'Absent';

      }

      //google.charts.load('current', {'packages':['table']});

      $scope.getAttendanceReport();

    }



    $scope.getAttendanceReport = function()

    {

      
      $scope.isDataAvailable = null;
      if($scope.presentStaff == null && $scope.absentStaff == null && $scope.totalStaff == null)

      {

        $scope.parameters = {'parameter': 'Present'};

        $scope.result = $http.post($scope.baseUrl+'attendance_controller/getAttendanceData',$scope.parameters).then(function(response){

          $scope.presentStaff = response.data.attendanceData;

          //console.log('HH: '+$scope.presentStaff);

        });

        $scope.parameters = {'parameter': 'Absent'};

        $scope.result = $http.post($scope.baseUrl+'attendance_controller/getAttendanceData',$scope.parameters).then(function(response){

          $scope.absentStaff = response.data.attendanceData;

          //console.log('HH: '+$scope.absentStaff);

        });

        $scope.parameters = {'parameter': 'Total'};

        $scope.result = $http.post($scope.baseUrl+'attendance_controller/getAttendanceData',$scope.parameters).then(function(response){

          $scope.totalStaff = response.data.attendanceData;

          //console.log('HH: '+$scope.totalStaff);

          

          google.charts.setOnLoadCallback($scope.drawTable);

          //$scope.drawTable();

        });

      }

      else

      {

        google.charts.setOnLoadCallback($scope.drawTable);

      }



      // $timeout($scope.dummy,5000);

      // while($scope.presentStaff == null && $scope.absentStaff == null && $scope.totalStaff == null)

      // {

      //  //Do nothing

      // }



      //call draw function

      // google.charts.load('current', {'packages':['table']});

        //google.charts.setOnLoadCallback($scope.drawTable);

    }

    



    $scope.drawTable = function()

    {
      $scope.isDataAvailable = null;

      var data = new google.visualization.DataTable();

      data.addColumn('string', 'Employee Name');

      data.addColumn('string', 'Employee Id');

      data.addColumn('string', 'Date');

      data.addColumn('string', 'Check in');

      data.addColumn('string', 'Check out');

      data.addColumn('string', 'Status');

      if($scope.attendanceSelector == 'All')

      {

        angular.forEach($scope.totalStaff,function(value, key)

        {
          $scope.isDataAvailable = 1;
          var tempDate = $filter('date')(new Date(value.date), "y-MM-dd");
          
          if(value.checkin == null)
          {
            var tempCheckin = null;
          }
          else
          {
            var tempCheckin = $filter('date')(new Date(value.checkin), "H:mm:ss");
          }
          
          if(value.checkout == null)
          {
            var tempCheckout = null;
          }
          else
          {
            var tempCheckout = $filter('date')(new Date(value.checkout), "H:mm:ss");
          }

          // console.log('New Date: '+ $filter('date')(value.date, "y-MM-dd"));
          // console.log('New checkin: '+ $filter('date')(value.checkin, 'mediumTime'));
          // console.log('New checkout: '+ $filter('date')(value.checkout, 'mediumTime'));

          data.addRows([

            [ value.Name, value.Employee_ID, tempDate, tempCheckin, tempCheckout, value.status]

        ]);

        });

        $scope.attendanceSelector = 'All';

      }

      if($scope.attendanceSelector == 'Present')

      {

        angular.forEach($scope.presentStaff,function(value, key)

        {

          $scope.isDataAvailable = 1;
          var tempDate = $filter('date')(new Date(value.date), "y-MM-dd");
          
          if(value.checkin == null)
          {
            var tempCheckin = null;
          }
          else
          {
            var tempCheckin = $filter('date')(new Date(value.checkin), "H:mm:ss");
          }
          
          if(value.checkout == null)
          {
            var tempCheckout = null;
          }
          else
          {
            var tempCheckout = $filter('date')(new Date(value.checkout), "H:mm:ss");
          }

          // console.log('New Date: '+ $filter('date')(value.date, "y-MM-dd"));
          // console.log('New checkin: '+ $filter('date')(value.checkin, 'mediumTime'));
          // console.log('New checkout: '+ $filter('date')(value.checkout, 'mediumTime'));

          data.addRows([

            [ value.Name, value.Employee_ID, tempDate, tempCheckin, tempCheckout, value.status]

          ]);

        });

        $scope.attendanceSelector = 'Present';

      }

      if($scope.attendanceSelector == 'Absent')

      {

        angular.forEach($scope.absentStaff,function(value, key)

        {
          $scope.isDataAvailable = 1;

          var tempDate = $filter('date')(new Date(value.date), "y-MM-dd");
          
          if(value.checkin == null)
          {
            var tempCheckin = null;
          }
          else
          {
            var tempCheckin = $filter('date')(new Date(value.checkin), "H:mm:ss");
          }
          
          if(value.checkout == null)
          {
            var tempCheckout = null;
          }
          else
          {
            var tempCheckout = $filter('date')(new Date(value.checkout), "H:mm:ss");
          }

          // console.log('New Date: '+ $filter('date')(value.date, "y-MM-dd"));
          // console.log('New checkin: '+ $filter('date')(value.checkin, 'mediumTime'));
          // console.log('New checkout: '+ $filter('date')(value.checkout, 'mediumTime'));

          data.addRows([

            [ value.Name, value.Employee_ID, tempDate, tempCheckin, tempCheckout, value.status]

        ]);

        });

        $scope.attendanceSelector = 'Absent';

      }




      $('#table_window').css('display','block');
      $('#noDataMessage').css('display','none');
      var table = new google.visualization.Table(document.getElementById('table_window'));

      table.draw(data, {width: '100%'});//, height: '300px'

      if($scope.isDataAvailable == null)
      {
        $('#table_window').css('display','none');
        $('#noDataMessage').css('display','block');
      }

    }

  });

</script>