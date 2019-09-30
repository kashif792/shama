<div class="col-md-12 col-sm-12 col-xs-12 widget" >
 <div class="dss-widget widget" id="widget1" ng-init="loadChart(2)" ng-controller="dssCtr">
    <div class="row">
      <div class="row widget-header" id="widget-header" >
        <div class="col-lg-12  ">
          <!-- widget options -->
          <!-- widget options -->
          <div class="widget-item-list">
            <ul class="nav nav-pills">
             <li class="dropdown">
                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">
                  <span id="option-text" ng-bind="filters.defaultDevice"></span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" ng-model="selectedopt">
                    <li ng-repeat="x in filters.devices">
                    <a href="#" data-view="{{x.device}}" id="store_value" ng-click="changeDevice(x.device,loadGuages,1)">
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
                   <li >
                    <a href="#" data-view="1" ng-click="(chartObject.type='Gauge') && (filters.devices[1].device) && (loadGuages())">

                      <span class="drowdown-menu-icon">
                        <span class="icon-signal top-bar-icon"></span>
                      </span>
                      <span class="drowdown-menu-text">
                        <p>Gauge Chart</p>
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
             Devices Status
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
.google-visualization-table {
    max-height: 100% !important;
    height: 195px;
}
.custome-widget-width {
    width: 100%;
    padding: 0px;
}

.widget-body {
    padding: 0px !important;
}

th.google-visualization-table-th.gradient.unsorted {
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
}
  </style>
