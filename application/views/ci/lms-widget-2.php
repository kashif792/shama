<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/fullcalendar.css" />

<script type="text/javascript" src="<?php echo  base_url(); ?>js/calendar.js"></script>
<script type="text/javascript" src="<?php echo  base_url(); ?>js/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo  base_url(); ?>js/gcal.js"></script>
<div class="col-sm-12" ng-controller="CalendarCtrl">
  <div class="panel panel-default">
      <div class="panel-heading">
        <label>Calendar</label>
      </div>
      <div class="panel-body" >
  
<div class="calendar" ng-model="eventSources"  ui-calendar="uiConfig.calendar"></div> 
  </div>
</div>
</div>
<style type="text/css">
  
  .calender-header{
    background-color: #fafafa;
    border-bottom: 1px solid #e1e1e1;
    margin-left: 0;
    margin-right: 0;
    border: none;
    overflow: hidden;
    min-height: unset;
    text-overflow: ellipsis;
        color: black;
  }

</style>



<script type="text/javascript">
/**
 * calendarDemoApp - 0.9.0
 */

app.controller('CalendarCtrl', ['$scope','$compile','$http', function ($scope,$compile,$http) {
    var date = new Date();

    var d = date.getDate();

    var m = date.getMonth();
    var y = date.getFullYear();
    
   
 
    $scope.events = [];
    /* config object */
    $scope.uiConfig = {
      calendar:{
        height: 450,
        editable: true,
        header:{
          left: 'title',
          center: '',
          right: 'today prev,next'
        },
         eventClick: $scope.alertOnEventClick,
        eventResize: $scope.alertOnResize,
        eventRender: $scope.eventRender
      }
    };
/* event source that calls a function on every view switch */
    $scope.eventsF = function (start, end, timezone, callback) {
      var events = $scope.events;
      callback(events);
    };

  /* Change View */
    $scope.changeView = function(view,calendar) {
      uiCalendarConfig.calendars[calendar].fullCalendar('changeView',view);
    };
    /* Change View */
    $scope.renderCalender = function(calendar) {
      if(uiCalendarConfig.calendars[calendar]){
        uiCalendarConfig.calendars[calendar].fullCalendar('render');
      }
    };

      $scope.alertOnEventClick = function( date, jsEvent, view){
        alert()
    };
     /* Render Tooltip */
    $scope.eventRender = function( event, element, view ) { 
        element.attr({'tooltip': event.title,
                     'tooltip-append-to-body': true});
        $compile(element)($scope);
    };

 $scope.eventSources = [];
 $scope.events = [];

  $scope.eventSource = {
            url: "http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic",
            className: 'gcal-event',           // an option!
            currentTimezone: 'America/Chicago' // an option!
    };
     getHolidays();
        function getHolidays()
        {
            httprequest('getholidays',{}).then(function(response){
                if(response != null && response.length > 0)
                {
                   
                    angular.forEach(response , function(value,key){
                      var event_color = '#5e96f5';
                      if(value.event[0].type == 'nl')
                      {
                        event_color = '#f4b400';
                      }

                      var temp = {
                        title:value.description,
                        start: new Date(value.sy, value.sm - 1, value.sd),
                        end: new Date(value.ey, value.em - 1, value.ed),
                        allDay: value.fullday,
                        color:event_color,
                      };
                      $scope.events.push(temp);
                    });
                }else{
                  $scope.events = [];
                }
            });
        }
         $scope.eventSources = [$scope.events, $scope.eventSource,$scope.eventsF];

  


   
    /* Change View */
    $scope.changeView = function(view,calendar) {
    
      uiCalendarConfig.calendars[calendar].fullCalendar('changeView',view);
    };
 
 


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

   

        function responseSuccess(response){
            return (response.data);
        }

        function responseFail(response){
            return (response.data);
        }
   
}])

/* EOF */
</script>






