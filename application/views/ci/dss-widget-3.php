<div class="col-lg-12 widget-box" >
 <div  class="dss-widget widget" id="widget3" ng-init="loadChart(3)" ng-controller="dssCtr">
  <div class="row">
      <div class="row widget-header" id="widget-header" >
        <div class="col-lg-12  ">
          <!-- widget options -->
          <!-- widget options -->
          <div class="widget-item-list">
            <ul class="nav nav-pills">
             <li class="hide">  
              <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <span id="option-text">
                    <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
                  </span>
                
                </a>
               
              </li>
         <li class="dropdown">
                <a aria-expanded="true" id="alarm_event_date_widget" class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <span class="event-widget-start-date-text" id="event-widget-start-date-text"></span>
                      <span class="event-widget-end-date-text" id="event-widget-end-date-text"></span>
                    <span class="caret"></span>
                  </a>
                  <div class="widget-date-picker-container">
                  <?php $attributes = array('name' => 'alarms_events_form', 'id' => 'alarms_events_form','class'=>'form-horizontal'); echo form_open('', $attributes);?>
                    <fieldset>
                      <div id="date-filter">
                                  <div class="form-group">
                                      <div class="col-lg-8 widget-date-box-container">
                                          <input type="text" ng-model="inputdate" ng-init="inputdate" class="form-control widgetAlarmInputFromDate" id="widgetAlarmInputFromDate" value="" name="widgetAlarmInputFromDate" placeholder="Date">
                                      </div>
                                      <div class="col-lg-4 widget-date-button-container">
                                          
                                          <button type="button" ng-click="datefilter()" class="btn btn-default alarm_event_date_submit">Apply</button>
                                        <a href="#" id="alarm_event_date_cancel">Cancel</a>
                                      </div>
                                  </div>
                                </div>
                            </fieldset>    
                  <?php echo form_close();?>
                </div>
                </li>
             <li class="dropdown">
              
                <ul class="dropdown-menu" ng-model="selectedopt">
                    <li ng-repeat="x in filters.devices">
                    <a href="#" data-view="{{x.device}}" id="store_value" ng-click="changeDevice(x.device,loadGuages,2)">
                     <span class="drowdown-menu-icon">
                     <span class="icon-location top-bar-icon"></span>
                    </span>
                    <span class="drowdown-menu-text">
                     <p>{{x.device}}</p>
                    </span>
                    </a>
                   </li>
                </ul>
              </li>
              <li class="dropdown">
                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">
                  <span id="option-text" ng-bind="filters.varType"></span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" ng-model="selectedopt">
                    <li ng-repeat="x in DataVariable">
                    <a href="#" data-view="{{x.variable}}" id="store_value" ng-click="ChangeView(x.cols); changeVariable(x.variable)">
                     <span class="drowdown-menu-icon">
                     <span class="icon-location top-bar-icon"></span>
                    </span>
                    <span class="drowdown-menu-text">
                     <p>{{x.variable}}</p>
                    </span>
                    </a>
                   </li>
                </ul>
              </li>
              <li class="dropdown view-options">
                <a aria-expanded="true" class="dropdown-toggle menu-option-click" data-view="pc" id="tr" data-toggle="dropdown" href="#">
                  <span id="option-text">{{chartObject.type}}</span> 
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li ng-repeat="x in ChartOptions">
                    <a href="#" data-view="1" ng-click="chartObject.type=x.opt">

                      <span class="drowdown-menu-icon">
                        <span class="icon-signal top-bar-icon"></span>
                      </span>
                      <span class="drowdown-menu-text">
                        <p>{{x.Title}}</p>
                      </span>
                    </a>
                 </li>
                </ul>
              </li>
            </ul>
           <div class="clear"></div>
          </div>
          <!-- widget title -->
          <div class="row widget-title col-lg-12">
            <span id="">
               Historcal Status
             </span>
             </div>
         </div>
        </div>
        <div class="row widget-body">
         <div class="col-lg-12 custome-widget-width">
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

  <script>
$(function() {
    $('input[name="daterange"]').daterangepicker();
});
  </script>
  <style type="text/css">
    th.google-visualization-table-th.gradient {
    background: whitesmoke !Important;
    width: 100%;
      }

  td.google-visualization-table-td {
    width: 100%;
    padding: 12px;
  }
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
    span#option-text input {
    font-size: 12px;
    border: 0px;
    background: transparent;
}
  </style>
