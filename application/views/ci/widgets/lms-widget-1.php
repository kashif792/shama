<div class="col-sm-12" ng-controller="scheduleController" ng-init="getBaseUrl('<?php echo base_url(); ?>')">
  <div class="panel panel-default">
      <div class="panel-heading">
        <label>Today's Schedule</label>
      </div>
      <div class="panel-body whide" id="ttable" ng-init="timetableloaded = false" ng-class="{'loader2-background': timetableloaded == false}">
          <div class="loader2" ng-hide="timetableloaded"></div>
          <div ng-hide="!timetableloaded">
            <div id="timetable" style="min-height:280px;" ></div>
          </div>
          
      </div>
  </div>
</div>

<script>

  app.controller('scheduleController', function($scope, $window, $http, $document, $timeout,$interval){

    $scope.scheduleData = null;
    $scope.isDataAvailable = 1;
$("#ttable").show();

    $scope.getBaseUrl = function(url)
    {
      google.charts.load('current', {'packages':['corechart','timeline','table', 'controls']});
      $scope.baseUrl = url;
      //console.log($scope.baseUrl);
      $scope.getScheduleData();
    }

    $scope.getScheduleData = function()
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
