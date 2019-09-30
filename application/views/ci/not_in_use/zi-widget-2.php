<div class="col-lg-4 widget-box" ng-controller="attendanceController">
 <div class="dss-widget widget" ng-init="getBaseUrl('<?php echo base_url(); ?>')" >
    <div class="row">
      <div class="row widget-header widget2Header" id="widget-header" >
        <div class="col-lg-12  ">
          <!-- widget options -->
          <!-- widget options -->
          <div class="widget-item-list">
           
           <div class="clear"></div>
          </div>
          <!-- widget title -->
          <div class="row widget-title col-lg-12">
            <span id="">
             Daily Attendance Summary
             </span>
             </div>
         </div>
        </div>
        <div class="row widget-body">
         <div class="col-lg-12 custome-widget-width">
            <div class="col-sm-6 attendanceSummary presentDiv">
                <h3 class="headings givePadding">Present</h3>
                <div class="row">
                  <h4 class="col-sm-9 headings">{{presentStaff}}</h4>
                  <p class="col-sm-3 widget2Icons headings" ><i id="attendanceIcons" class="fa fa-check-square-o" aria-hidden="true"></i></p>
                </div>
                
                <div class="attendanceIconDivPresent">
                  <a id="widget2Reports" href="<?php echo base_url(); ?>attendance_detail/Present">Full report&nbsp&nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-sm-6 attendanceSummary absentDiv">
                <h3 class="headings givePadding">Absent</h3>
                <div class="row">
                  <h4 class="col-sm-9 headings">{{absentStaff}}</h4>
                  <p class="col-sm-3 widget2Icons headings" ><i id="attendanceIcons" class="fa fa-minus-square-o" aria-hidden="true"></i></p>
                </div>
                <div class="attendanceIconDivAbsent">
                  <a id="widget2Reports" href="<?php echo base_url(); ?>attendance_detail/Absent">Full report&nbsp&nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-sm-6 attendanceSummary totalDiv">
                <h3 class="headings givePadding">Total</h3>
                <div class="row">
                  <h4 class="col-sm-9 headings">{{totalStaff}}</h4>
                  <p class="col-sm-3 widget2Icons headings" ><i id="attendanceIcons" class="fa fa-users" aria-hidden="true"></i></p>
                </div>
                <div class="attendanceIconDivTotal">
                  <a id="widget2Reports" href="<?php echo base_url(); ?>attendance_detail/Total">Full report&nbsp&nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-sm-6 attendanceSummary locationDiv">
                <h3 class="headings givePadding">Locations</h3>
                <div class="row">
                  <h4 class="col-sm-9 headings">{{officeLocations}}</h4>
                  <p class="col-sm-3 widget2Icons headings" ><i id="attendanceIcons" class="fa fa-map-marker" aria-hidden="true"></i></p>
                </div>
                <div class="attendanceIconDivLocation">
                  <a id="widget2Reports" href="<?php echo base_url(); ?>officelocation">Full report&nbsp&nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            </div>
          <div class="loader-container">
            
          <div>
           
           </div>
             <div class="dashboard-no-report-data hide" id="ttypes-no-data-container">
              <span>No payroll data found.</span>
             </div>
             <!-- <div class="table-choice choice" id="opt1" >
              
                <table class="table vtble" id="consum-table">
                  <thead>
                    <th> ID </th>
                    <th> Building </th>
                    <th> Energy </th>
                    <th> Gas </th>
                    <th> Water </th>
                    
                  </thead>
                  <tbody>
                  <tr ng-repeat="x in c_History">
                     <td> {{x.building}} </td>
                    <td> {{x.name}} </td>
                    <td> {{x.Energy}} </td>
                    <td> {{x.Gas}}</td>
                    <td> {{x.Water}}</td>
                  </tr>
                  </tbody>
                  </table>
               
              </div> -->
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
    /*th.google-visualization-table-th.gradient {
    background: whitesmoke !Important;
    width: 100%;
      }

  td.google-visualization-table-td {
    width: 100%;
    padding: 12px;
    }*/
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
/*.google-visualization-table {
    max-height: 100% !important;
    height: 195px;
}*/
.custome-widget-width {
    width: 100%;
    padding: 0px;
}

.widget-body {
    padding: 0px !important;
}
.widget2Header{
  margin-bottom: 0 !important;
}

/*th.google-visualization-table-th.gradient.unsorted {
    background: white !important;
    padding-left: 4px;
    border-top: 0px;
}

tr.google-visualization-table-tr-head {}

.google-visualization-table-tr-head {
    background: white;
    border: 0px;
}

.google-visualization-table-table {
    border: 0px !important;
    background: white !important;
}

.google-visualization-table {
    border: 0px;
}
.google-visualization-atl .border {
    border: 0px !important;
}*/


/*New Code*/
    .presentDiv{
      background-color: #35ab53;
    }
    .absentDiv{
      background-color: #fc4236;
    }
    .totalDiv{
      background-color: #09aac7;
    }
    .locationDiv{
      background-color: #ff851b;
    }
    .attendanceIconDivPresent{
      /*position: absolute;*/
      min-height: 30px;
      bottom: 0;
      right: 0;
      left: 0;
      
     
      background-color: rgba(10, 123, 38, 0.89);
      
    }
    .attendanceIconDivAbsent{
      /*position: absolute;*/
      min-height: 30px;
      bottom: 0;
      right: 0;
      left: 0;
      
     
      background-color: rgba(200, 45, 14, 0.86);
     
    }
    .attendanceIconDivTotal{
      /*position: absolute;*/
      min-height: 30px;
      bottom: 0;
      right: 0;
      left: 0;
      
      
      background-color: rgba(15, 128, 149, 0.88);
      
    }
    .attendanceIconDivLocation{
      /*position: absolute;*/
      min-height: 30px;
      bottom: 0;
      right: 0;
      left: 0;
      
      
      background-color: rgba(201, 112, 3, 0.86);
      
    }
    .widget2Icons{
      float: right;
      font-size: 35px;
    }
    #attendanceIcons{
      opacity: 0.5;
    }
    #widget2Reports{
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 10px;
      display: block;
      color: white !important;
      text-decoration: none;
    }
    #widget2Reports:visited {
      text-decoration: none;
    }
    #widget2Reports:active {
      text-decoration: none;
      
    }
    .attendanceSummary{
      padding: 0;
      padding-top: 7.8px;
      /*min-height: 21.75vh;
      width: 49.9%;*/
      /*max-width: 40%;*/
      color: white !important;
      /*border-radius: 8px;*/
    }
    .headings{
      margin-top: 5px;
      margin-bottom: 0;
    }
    .givePadding{
      padding-left: 10px;
    }
</style>


<script>
  app.controller('attendanceController', function($scope, $window, $http, $document)
  {
    $scope.presentStaff = 999;
    $scope.absentStaff = 9999;
    $scope.totalStaff = 99999;
    $scope.officeLocations = 99;


    $scope.getBaseUrl = function(url)
    {
      $scope.baseUrl = url;
      $scope.getAttendanceSummary();
    }

    $scope.getAttendanceSummary = function()
    {
      //$window.alert('Getting attendance summary');
      //get present employees
      $scope.result = $http.post($scope.baseUrl+'attendance_controller/presentAttendance').then(function(response){
        
        $scope.presentStaff = response.data;
        //console.log("Present: "+$scope.presentStaff);
      });
      //get absent employees
      $scope.result = $http.post($scope.baseUrl+'attendance_controller/absentAttendance').then(function(response){
        $scope.absentStaff = response.data;
        //console.log("Absent: "+$scope.absentStaff);
      });

      //get total employees
      $scope.result = $http.post($scope.baseUrl+'attendance_controller/totalEmployees').then(function(response){
        $scope.totalStaff = response.data;
        //console.log("Total: "+$scope.totalStaff);
      });

      //get total offices
      $scope.result = $http.post($scope.baseUrl+'attendance_controller/totalOffices').then(function(response){
        $scope.officeLocations = response.data;
        //console.log("Offices: "+$scope.officeLocations);
      }); 
    }

    $scope.getFullData = function(attendanceParameter)
    {
      //$window.alert('Full report of: '+attendanceParameter);
      //$scope.parameters = {'parameter': attendanceParameter};
      $scope.result = $http.get($scope.baseUrl+'attendance_controller/getAttendanceDataFullReport/'+attendanceParameter).then(function(response){
        
        //console.log(response.data.attendanceData);
      });
    }


  });  
</script>