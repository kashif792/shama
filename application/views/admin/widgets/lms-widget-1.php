<div class="col-lg-12" ng-controller="scheduleController" ng-init="getBaseUrl('<?php echo base_url(); ?>')">
  <div class="panel panel-default">
      <div class="panel-heading">
        <label>Learning InVantage guidelines</label>
      </div>
      <div class="panel-body" >
          <p class="guidelines-heading">To use Shama you need to do following steps in sequence.</p>
          <ul class="guidelines">
         
            <li>
              <p>If you are using Shama for first time please add a new city. If you already have added city to shama then you can use this link to <a href="<?php echo $path_url; ?>setting" title="View locations" alt="View locations">view</a> them.</p>
            </li>
            <li>
              <p>If you are going to a new school for first time then you have to add relevant city before adding a new school. If you already have added school to shama then you can use this link to <a href="<?php echo $path_url; ?>setting" title="View schools" alt="View schools">view</a> them.</p>
            </li>
            <li>
              <p>If you are going to a principal for first time then you have to add relevant city and school before adding a principal. If you already have added principal to Shama then you can use this link to <a href="<?php echo $path_url; ?>show_prinicpal_list" title="View principal" alt="View principal">view</a> them or add them using this link <a href="<?php echo $path_url; ?>add_Prinicpal" title="Add principal" alt="Add principal">Add</a>.</p>
            </li>
          </ul>
      </div>
  </div>
</div>

<script>
  app.controller('scheduleController', function($scope, $window, $http, $document, $timeout,$interval){

    $scope.scheduleData = null;
    $scope.isDataAvailable = 1;


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

            $scope.scheduleData = response.data;
            google.charts.setOnLoadCallback($scope.drawTable);
          } 
          else{
            $("#timetable").html('No data found')
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