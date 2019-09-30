<div id="widgetHolder" class="col-lg-{{cameraWindowSize}} widget-box" ng-controller="cameraWidget">

 <div class="dss-widget widget" id="widget1" ng-init="getBaseUrl('<?php echo base_url(); ?>')">

    <div class="row" ng-init="changeCamera(cameraNumber)">

      <div class="row widget-header widget0Header" id="widget-header" >

        <div class="col-lg-12  ">

          <!-- widget options -->

          <!-- widget options -->

          <div class="widget-item-list">

            <ul class="nav nav-pills">

              

             <li class="dropdown">

                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">

                  <span id="option-text">Modes</span>

                  <span class="caret"></span>

                </a>

                <ul class="dropdown-menu cameraDropdown1" ng-model="selectedopt">

                    <li >

                      <form>

                        <button id="verticalPatrolPrimary" ng-mousedown="cameraMousedown(26)" class="btn btn-default col-sm-6">V-Ptrl</button>

                        <button id="horizontalPatrolPrimary" ng-mousedown="cameraMousedown(28)" class="btn btn-default col-sm-6">H-Ptrl</button>

                      </form>

                   </li>

                   <li >

                      <form>

                        <button id="verticalFlipPrimary" ng-mousedown="cameraSettings(5,2)" class="btn btn-default col-sm-6">V-Flip</button>

                        <button id="horizontalFlipPrimary" ng-mousedown="cameraSettings(5,1)" class="btn btn-default col-sm-6">H-Flip</button>

                      </form>

                   </li>

                   <li >

                      <form>

                        <div class="col-sm-3"></div>

                        <button id="infraredPrimary" ng-mousedown="cameraSettings(14,0)" class="btn btn-default col-sm-6">IR</button>

                        <div class="col-sm-3"></div>

                      </form>

                   </li>

                   <!-- <li >

                    <a href="#" data-view="{{x.device}}" id="store_value" ng-click="changeDevice(x.device,loadGuages,1)">

                     <span class="drowdown-menu-icon">

                     <span class="icon-location top-bar-icon"></span>

                    </span>

                    <span class="drowdown-menu-text">

                     <p>{{x.device}}</p>

                    </span>

                    </a>

                   </li> -->

                </ul>

              </li>

              <li class="dropdown">

                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">

                  <span id="option-text">Settings</span>

                  <span class="caret"></span>

                </a>

                <ul class="dropdown-menu" ng-model="selectedopt">

                  <li>

                    <div class="row">

                      <form id="frequencyForm">

                        <label class="col-sm-6">Frequency</label>

                        <select ng-model="frequency" class="widget1inputs" ng-change="frequencySettings()">

                          <option value="1">60 Hz</option>

                          <option value="0">50 Hz</option>

                        </select>

                      </form>

                    </div>

                  </li>

                  <li>

                    <div class="row">

                      <form id="resolutionForm">

                        <label class="col-sm-6">Resolution</label>

                        <select ng-model="resolution" class="widget1inputs" ng-change="resolutionSettings()">

                          <option value="0">VGA</option>

                          <option value="1">QVGA</option>

                        </select>

                      </form>

                    </div>

                  </li>

                  <li>

                    <div class="row">

                      <form id="frameRateForm">

                        <label class="col-sm-6">FrameRate</label>

                        <input ng-model="frameRate" class="widget1inputs" ng-change="frameRateSettings()" type="number" min="1" max="30">

                      </form>

                    </div>

                  </li>

                  <li>

                    <div class="row">

                      <form id="Ptz-SpeedForm">

                        <label class="col-sm-6">Ptz-Speed</label>

                        <select ng-model="ptz_speed" class="widget1inputs" ng-change="ptz_speedSettings()">

                          <option value="1">Slow</option>

                          <option value="5">Med</option>

                          <option value="10">Fast</option>

                        </select>

                      </form>

                    </div>

                  </li>

                  <li>

                    <div class="row">

                      <form id="BrightnessForm">

                        <label class="col-sm-6">Brightness</label>

                        <input ng-model="brightness" class="widget1inputs" ng-change="brightnessSettings()" type="number" min="1" max="255">

                      </form>

                    </div>

                  </li>

                  <li>

                    <div class="row">

                      <form id="contrastForm">

                        <label class="col-sm-6">Contrast</label>

                        <input ng-model="contrast" class="widget1inputs" ng-change="contrastSettings()" type="number" min="1" max="255">

                      </form>

                    </div>

                  </li>

                  <li>

                    <div class="row cameraWidgetDefaultSetting">

                      <form>

                        <button id="defaultParameters" ng-click="defaultParametersSetting()" class="btn btn-default">Default Parameters</button>

                      </form>

                    </div>

                  </li>


                </ul>

              </li>

              <!-- <li class="dropdown">

                <a aria-expanded="true" data-view="all" id="tt" class="dropdown-toggle menu-option-click" data-toggle="dropdown" href="#">

                  <span id="option-text">Camera {{cameraNumber}}</span>

                  <span class="caret"></span>

                </a>

                <ul class="dropdown-menu" ng-model="selectedopt">

                  <li>

                    <a href="#" ng-click="changeCamera(1)">Camera 1</a>

                  </li>

                  <li>

                    <a href="#" ng-click="changeCamera(2)">Camera 2</a>

                  </li>

                </ul>

              </li> -->
              

              

            </ul>

           <div class="clear"></div>

          </div>

          <!-- widget title -->

          <div class="row widget-title col-lg-12">

            <span id="">

             Camera {{cameraNumber}}

             </span>

             </div>

         </div>

        </div>

        <div class="row widget-body">

         <div class="col-lg-12 custome-widget-width">

          <div class="content_holder1">

            <img class="widget1Vid" src="http://192.168.1.60:81/videostream.cgi?loginuse=admin&loginpas=Pakistan321" ng-if="plan">

            <!-- <img class="widget1Vid" src="http://182.180.173.104:81/videostream.cgi?loginuse=admin&loginpas=Pakistan321" > -->

           <img class="widget1Vid" src="<?php echo base_url(); ?>images/decoy.jpg" ng-if="!plan">

            <div id="widget1Controls" ng-if="plan">



              <div class="row customRowControl" id="widget1BottomLeft">

                <button title="Take snap shot" class="cameraControls" ng-click="snapShot()"><i class="fa fa-camera" aria-hidden="true"></i></button>

              </div>



              <div>

                <div class="row customRowControl">

                  <button ng-mousedown="cameraMousedown(90)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2196</button>

                  <button ng-mousedown="cameraMousedown(0)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2191</button>

                  <button ng-mousedown="cameraMousedown(91)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2197</button>

                </div>

                <div class="row customRowControl">

                  <button ng-mousedown="cameraMousedown(4)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2190</button>

                  <button ng-mousedown="cameraMousedown(25)" class="cameraControls">&#x2194</button>

                  <button ng-mousedown="cameraMousedown(6)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2192</button>

                </div>

                <div class="row customRowControl">

                  <button ng-mousedown="cameraMousedown(92)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2199</button>

                  <button ng-mousedown="cameraMousedown(2)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2193</button>

                  <button ng-mousedown="cameraMousedown(93)" ng-mouseup="cameraMouseUp(1)" class="cameraControls">&#x2198</button>



                </div>

                

              </div>

              <div class="row customRowControl" id="widget1BottomRight">

                

                <button title="Cinema mode" class="cameraControls" ng-click="fullDivSize()"><i class="fa fa-square-o" aria-hidden="true"></i></button>

                <button title="Full screen mode" class="cameraControls" ng-click="fullScreenWidget1()"><i class="fa fa-expand" aria-hidden="true"></i></button>

              </div>

            </div>


           </div>
           <div class="content_holder2" hidden>
             <div id="video_div">
               
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



#widget1{

    /*max-height: 70vh !important;*/

    min-height: 300px !important;

    padding-bottom: 0;

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



.widget0Header{

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

    #widget1Controls{

      

      text-align: center;

      display: none;

      z-index: 100;

      position: absolute;

      bottom: 0px;

      left: 0;

      right: 0;

      background-color: rgba(224, 224, 209,0.5);

    }

    .customRowControl{

      margin-right: 0;

      margin-left: 0;

    }

    #widget1BottomLeft{

      float: left;

      position: inherit;

      z-index: 102;

      left: 0;

      bottom: 0;

    }

    .cameraControls{

      font-size: 130%;

      font-weight: bold;



        border-radius: 0px;

        min-width: 55px;

        /* background: white; */

        max-width: 63px;

        text-align: center;

        padding-top: 10px;

        padding-bottom: 10px;

        box-shadow: none;

        border-style: none;

        margin: 1px;

    }

    #widget1BottomRight{

      float: right;

      position: inherit;

      z-index: 102;

      right: 0;

      bottom: 0;

    }

    .widget1Vid{

      width: 73%;

      text-align: center;

      align-self: center;

      /*left: 0;

      right: 0;*/

    }

    .content_holder1{

      text-align: center;

      background-color: black;

    }
    .content_holder2{

      text-align: center;

      background-color: black;

    }

    .cameraDropdown1{

      padding-right: 20px;

      padding-left: 20px;

    }

    #verticalPatrolPrimary{

      border-radius: 0;

    }

    #horizontalPatrolPrimary{

      border-radius: 0;

    }

    #verticalFlipPrimary{

      border-radius: 0;

    }

    #horizontalFlipPrimary{

      border-radius: 0;

    }

    #infraredPrimary{

      border-radius: 0;

    }

    .widget1inputs{

      min-width: 90px;

      height: 20px;



    }

    .cameraWidgetDefaultSetting{

      text-align: center;

    }

    #defaultParameters{

      border-radius: 0;

    }

    

    @media only screen and (max-width: 1920px) {

      .widget1Vid{

        width: 59.7%;

      }

    }

    @media only screen and (max-width: 1600px) {

      .widget1Vid{

        width: 72%;

      }

    }

    @media only screen and (max-width: 1024px) {

      .widget1Vid{

        width: 38%;

      }

    }

  </style>

<!-- JWPlayer -->
<script src="<?php echo base_url(); ?>jwplayer-7.2.4/jwplayer.js"></script>
<script>jwplayer.key="0y3P+C+rb54MzVGF0+17frTvpr7BLkR6aXY9gw==";</script>
<script>
  $(document).ready(function()
  {

    // alert("rtmp://ftc.zinwebs.com:1935/live/"+src);
    var playerInstance = jwplayer("video_div");
          playerInstance.setup({
                        
            // file:"rtmp://192.168.1.2:1935/live/test.stream",
            // file:"<?php echo base_url(); ?>sample.mp4",
            file:"rtmp://192.168.1.2:1935/vod/sample.mp4",
            image: "/assets/myVideo.jpg",
            // autostart:true,
            width:'100%',
            // height: '70%'
            aspectratio: "16:9"

            
      });
  });
</script>

<script type="text/javascript">

    

  //  var app = angular.module('myApp',[]);

   



    app.controller('cameraWidget', function($scope,$window, $http, $document)

    {

        // $scope.test = function()

        // {

        //  $window.alert('New Controller');

        // }
        $scope.cameraNumber = 1;
        $scope.cameraWindowSize = 4;

        var verticalPatroling = false;

        var horizontalPatroling = false;

        var verticalFlipping = false;

        var horizontalFlipping = false;

        var infraRed = false;

        var isFullDive = false;

        $scope.baseUrl = null;

        //

        $scope.frequency;       

        $scope.resolution;

        $scope.frameRate;

        $scope.ptz_speed;

        $scope.brightness;

        $scope.contrast;
        $scope.plan = null;





        //Get base_url

        $scope.getBaseUrl = function(url)

        {

          $scope.baseUrl = url;

          $scope.result = $http.get(url+'camera_controller/getVideo').then(function(response){
            //console.log('hh'+response);
            $scope.plan = 1;
          });

          $scope.getParameters();

        }



        //Get Camera Parameters

        $scope.getParameters = function()

        {

            //$window.alert('Get Parameters of this User');

            $scope.result = $http.get($scope.baseUrl+'cameraParameters').then(function (response){

                                        //$window.alert('Contrast Changed');

                                        //console.log(response);

                                        $scope.frequency = response.data.parameters['frequency'];

                                        $scope.resolution = response.data.parameters['resolution'];

                                        $scope.frameRate = parseInt(response.data.parameters['frame_rate'],10);

                                        $scope.ptz_speed = response.data.parameters['ptz_speed'];

                                        $scope.brightness = parseInt(response.data.parameters['brightness'],10);

                                        $scope.contrast = parseInt(response.data.parameters['contrast'],10);

                                        //Frequency

                                        //cameraSettingController(3,$scope.frequency);

                                        //console.log(typeof(parseInt($scope.frequency,10)));

                                        //Resolution

                                        //cameraSettingController(0,$scope.resolution);

                                        //Frame_Rate

                                        //cameraSettingController(6,$scope.frameRate);

                                        //PTZ_Speed

                                        //cameraSettingController(100,$scope.ptz_speed);

                                        //Brightness

                                        //cameraSettingController(1,$scope.brightness);

                                        //Contrast

                                        //cameraSettingController(2,$scope.contrast);



                                    });

        }



        //Check which direction to move camera

        $scope.cameraMousedown = function(command)

        {

            

            if(command == 0) //go up

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(0);

            }

            if(command == 2)//go down

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(2);             

            }

            if(command == 4)//go left

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(4);             

            }

            if(command == 6)//go right

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(6);             

            }



            //Centre Button Allign

            if(command == 25)//Align

            {

                movementCommand = {'command': command};

               $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(25);                

            }







            if(command == 90)//Upper Left

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(90);

            }

            if(command == 91)//Upper Right

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(91);

            }

            if(command == 92)//Bottom Left

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(92);

            }

            if(command == 93)//Bottom Right

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMousedown');

                //commandController(93);

            }







            //Patrolling



            if(command == 26) //VerTical Patrol

            {

                if(verticalPatroling == true)//if camera is already patrolling

                {

                    

                    movementCommand = {'command': 27};

                    $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        verticalPatroling = false;

                        //change color of button

                        $('#verticalPatrolPrimary').css('background-color','#fff');

                    });

                    //commandController(27);

                    

                }

                else //If camera is not Patroling

                {

                    

                    movementCommand = {'command': 26};

                    $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        verticalPatroling = true;

                        //change color of button

                        $('#verticalPatrolPrimary').css('background-color','#5cb85c');

                    });

                    //commandController(26);



                }

            }



            if(command == 28) //Horizontal Patrol

            {

                if(horizontalPatroling == true)//if camera is already patrolling

                {

                    

                    movementCommand = {'command': 29};

                    $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        horizontalPatroling = false;

                        //change color of button

                        $('#horizontalPatrolPrimary').css('background-color','#fff');

                    });

                    //commandController(29);    

                }

                else //If camera is not Patroling

                {

                    

                    movementCommand = {'command': 28};

                    $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        horizontalPatroling = true;

                        //change color of button

                        $('#horizontalPatrolPrimary').css('background-color','#5cb85c');

                    });

                    //commandController(28);

                }

            }



        }

        $scope.cameraMouseUp = function(command)

        {

            if(command == 1)//Halt

            {

                movementCommand = {'command': command};

                $http.post($scope.baseUrl+'camera_controller/movement/',movementCommand).then(function(response){

                    //console.log('Camera is moving down');

                });

                // console.log('cameraMouseUp');

                //commandController(1);

            }

        }



        //Controllers like Flip, IR etc...

        $scope.cameraSettings = function(param, value)

        {

            if(param == 5 && value == 2)//Vertical Flip

            {

                if(verticalFlipping == true)//if camera is already flipped

                {

                    movementCommand = {'param': 5, 'value': 3};

                    $http.post($scope.baseUrl+'camera_controller/cameraSettings/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        verticalFlipping = false;

                        $('#verticalFlipPrimary').css('background-color','#fff');

                    });

                    //cameraSettingController(5,3);

                }

                else //If camera is not flipped

                {

                    movementCommand = {'param': 5, 'value': 2};

                    $http.post($scope.baseUrl+'camera_controller/cameraSettings/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        verticalFlipping = true;

                        $('#verticalFlipPrimary').css('background-color','#5cb85c');

                    });

                    //cameraSettingController(5,2);

                }

            }



            if(param == 5 && value == 1)//Horizontal Flip

            {

                if(horizontalFlipping == true)//if camera is already flipped

                {

                    movementCommand = {'param': 5, 'value': 3};

                    $http.post($scope.baseUrl+'camera_controller/cameraSettings/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        horizontalFlipping = false;

                        $('#horizontalFlipPrimary').css('background-color','#fff');

                    });

                    //cameraSettingController(5,3);

                }

                else //If camera is not flipped

                {

                    movementCommand = {'param': 5, 'value': 1};

                    $http.post($scope.baseUrl+'camera_controller/cameraSettings/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        horizontalFlipping = true;

                        $('#horizontalFlipPrimary').css('background-color','#5cb85c');

                    });

                    //cameraSettingController(5,1);

                }

            }



            if(param == 14 && value == 0)//InfraRed

            {

                if(infraRed == true)//if camera is already in Infrared mode

                {

                    movementCommand = {'param': 14, 'value': 1};

                    $http.post($scope.baseUrl+'camera_controller/cameraSettings/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        infraRed = false;

                        $('#infraredPrimary').css('background-color','#fff');

                    });

                    //cameraSettingController(14,1);

                }

                else //If camera is not Infrared mode

                {

                    movementCommand = {'param': 14, 'value': 0};

                    $http.post($scope.baseUrl+'camera_controller/cameraSettings/',movementCommand).then(function(response){

                        //console.log('Camera is moving down');

                        infraRed = true;

                        $('#infraredPrimary').css('background-color','#5cb85c');

                    });

                    //cameraSettingController(14,0);

                }

            }

        }





        //Settings

        $scope.frequencySettings = function()

        {

            if($scope.frequency == 1)//60 Hz

            {

                //Send Call to Controller

                //cameraSettingController(3,1);

                $scope.frequencyValue = {"value": $scope.frequency};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setFrequency',$scope.frequencyValue).then(                   function (response){

                                            //$window.alert('Response Came');

                                        });

            }

            else if($scope.frequency == 0) //50 Hz

            {

                //Send Call to Controller

                $scope.frequencyValue = {"value": $scope.frequency};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setFrequency',$scope.frequencyValue).then(                   function (response){

                                            //$window.alert('Response Came');

                                        });

                //cameraSettingController(3,0);

                //$window.alert('Zero selected');

            }

            //$window.alert('Frequency: '+$scope.frequency);

        }



        $scope.resolutionSettings = function()

        {

            if($scope.resolution == 1)//QVGA

            {

                //cameraSettingController(0,1);

                //Send Call to Controller

                $scope.resolutionValue = {"value": $scope.resolution};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setResolution',$scope.resolutionValue).then(                 function (response){

                                            //$window.alert('Response Came');

                                        });

            }

            else if($scope.resolution == 0)//VGA

            {

                //cameraSettingController(0,0);

                //Send Call to Controller

                $scope.resolutionValue = {"value": $scope.resolution};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setResolution',$scope.resolutionValue).then(                 function (response){

                                            //$window.alert('Response Came');

                                        });

            }

            //$window.alert('Frequency: '+$scope.resolution);

        }



        $scope.frameRateSettings = function()

        {

            if($scope.frameRate < 1 || $scope.frameRate > 30)//Invalid

            {

                $window.alert('Values between 1-30 only');

            }

            else

            {

                //cameraSettingController(6,$scope.frameRate);

                //Send Call to Controller

                $scope.frameRateValue = {"value": $scope.frameRate};

                $http.post($scope.baseUrl+'camera_controller/setFrameRate',$scope.frameRateValue).then(                   function (response){

                                            //$window.alert('Response Came');

                                        });

            }

            //$window.alert('Frequency: '+$scope.frameRate);

        }



        $scope.ptz_speedSettings = function()

        {

            if($scope.ptz_speed == 1)//Slow

            {

                //cameraSettingController(100,1);

                //Send Call to Controller

                $scope.ptzSpeedValue = {"value": $scope.ptz_speed};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setPTZSpeed',$scope.ptzSpeedValue).then(                 function (response){

                                            //$window.alert('Speed Changed');

                                        });

            }

            else if($scope.ptz_speed == 5)//Medium

            {

                //cameraSettingController(100,5);

                //Send Call to Controller

                $scope.ptzSpeedValue = {"value": $scope.ptz_speed};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setPTZSpeed',$scope.ptzSpeedValue).then(                 function (response){

                                            //$window.alert('Speed Changed');

                                        });

            }

            else if($scope.ptz_speed == 10)//Fast

            {

                //cameraSettingController(100,10);

                //Send Call to Controller

                $scope.ptzSpeedValue = {"value": $scope.ptz_speed};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setPTZSpeed',$scope.ptzSpeedValue).then(                 function (response){

                                            //$window.alert('Speed Changed');

                                        });

            }

            //$window.alert('Frequency: '+$scope.ptz_speed);

        }



        $scope.brightnessSettings = function()

        {

            if($scope.brightness < 1 || $scope.brightness > 255)//Invalid

            {

                $window.alert('Values between 1-255 only');

            }

            else

            {

                //cameraSettingController(1,$scope.brightness);

                //Send Call to Controller

                $scope.brightnessValue = {"value": $scope.brightness};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setBrightness',$scope.brightnessValue).                      then(function (response){

                                            //$window.alert('Brightness Changed');

                                        });

            }

            //$window.alert('Frequency: '+$scope.brightness);   

        }



        $scope.contrastSettings = function()

        {

            if($scope.contrast < 1 || $scope.contrast > 255)//Invalid

            {

                $window.alert('Values between 1-255 only');

            }

            else

            {

                //cameraSettingController(2,$scope.contrast);

                //Send Call to Controller

                $scope.contrastValue = {"value": $scope.contrast};

                $scope.result = $http.post($scope.baseUrl+'camera_controller/setContrast',$scope.contrastValue).                      then(function (response){

                                            //$window.alert('Contrast Changed');

                                        });

            }

            //$window.alert('Frequency: '+$scope.contrast); 

        }



        $scope.snapShot = function()

        {

            //$window.alert('Snap shot');



            $window.open($scope.baseUrl+"camera_controller/takeSnapShot");



            // $scope.result = $http.post('http://localhost/InsightTemplate/camera_controller/takeSnapShot').then(function (response){

            //                              //$window.alert('Contrast Changed');

            //                              console.log(response.data);

            //                              //Show respons image in new tab

            //                          });

        }



        $scope.defaultParametersSetting = function()

        {

            //cameraSettingController(7,0);



            //Send Call to Controller

            $scope.result = $http.post($scope.baseUrl+'camera_controller/setDefaultValues').then(function(response){

                                        $window.alert('Parameters set to default');

                                        $scope.frequency = "1";     

                                        $scope.resolution = "0";

                                        $scope.frameRate = 30;

                                        $scope.ptz_speed = "5";

                                        $scope.brightness = 1;

                                        $scope.contrast = 128;

                                    });

        }



        //Full Screen

        $scope.fullDivSize = function()

        {

            if(isFullDive == false)

            {

                //$window.alert('Full div size');

                $scope.cameraWindowSize = 12;

                isFullDive = true;

                $('.widget1Vid').css('width','62%');

                $('#widget1').css('max-height','70%');

                

                console.log('Going full: '+$window.innerWidth);

            }

            else

            {

                //$window.alert('Half div size');

                $scope.cameraWindowSize = 4;

                isFullDive = false;

                console.log('Going half: '+$window.innerWidth);

                if($window.innerWidth == 1920)

                {

                  $('.widget1Vid').css('width','59.7%');

                }

                else if($window.innerWidth == 1600)

                {

                  $('.widget1Vid').css('width','73%');

                }

                else if($window.innerWidth == 1024)

                {

                  $('.widget1Vid').css('width','38%');

                }

                //$('.widget1Vid').css('width','72%');

                $('#widget1').css('max-height','300px');

            }

        }



        $scope.fullScreenWidget1 = function()

        {

            // $window.alert('Full Screen');

            var elem = document.getElementById("widgetHolder");

            //var elem = angular.element(document).find('#widget1Window');



            //Check if window is in Full Screen mode

            if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen))

            {

                //Check if element is in full screen mode

                if ((elem.fullScreenElement && elem.fullScreenElement !== null) || (!elem.mozFullScreen && !elem.webkitIsFullScreen)) 

                {

                    //Call full div size method

                    //Warning variable tempering

                    isFullDive= false;

                    $scope.fullDivSize();

                    //console.log($window.innerWidth);

                    //$('#widgetHolder').css('background-color','black');



                    if(elem.requestFullScreen)

                    {

                        //$window.alert('Full Screen1');

                        elem.requestFullScreen();

                    }

                    else if(elem.mozRequestFullScreen)

                    {

                        //$window.alert('Full Screen2');

                        elem.mozRequestFullScreen();

                    }

                    else if(elem.webkitRequestFullScreen)

                    {

                        //$window.alert('Full Screen3');

                        //$('.widget1Vid').css('width','100%');

                        elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);



                    }

                }

            }

            else

            {

                //Call full div size method

                //Warning variable tempering

                isFullDive= true;

                $scope.fullDivSize();

                //$('#widgetHolder').css('background-color','white');



                if (document.cancelFullScreen) {

                    document.cancelFullScreen();

                } else if (document.mozCancelFullScreen) {

                    document.mozCancelFullScreen();

                } else if (document.webkitCancelFullScreen) {

                    //$window.alert('Full Screen');

                    document.webkitCancelFullScreen();

                }

    



                // if(elem.cancelFullScreen)

                // {

                //  $window.alert('Full Screen4');

                //     elem.cancelFullScreen();

                // }

                // else if(elem.mozCancelFullScreen)

                // {

                //  $window.alert('Full Screen5');

                //     elem.mozCancelFullScreen();

                // }

                // else if(elem.webkitCancelFullScreen)

                // {

                //  $window.alert('Full Screen6');

                //     elem.webkitCancelFullScreen();

                // }

            }

        }



        $scope.changeCamera = function(temp)
        {

          if(temp == 1)
          {
            //$window.alert('Oye mate!...'+temp);
            $('.content_holder2').css('display','none');
            $('.content_holder1').css('display','block');
            $scope.cameraNumber = 1;
          }
          else if(temp == 2)
          {
            //$window.alert('Oye mate!...'+temp);
            $('.content_holder1').css('display','none');
            $('.content_holder2').css('display','block');
            $scope.cameraNumber = 2;
          }
        }

    });

</script>

<!-- jquery  -->

<script>

    $('#menu-toggle').click(function(){

        $('.showSidebarmainmenu').toggle('hideSidebarmainmenu');

    });









    //widget1 filters fadeIn fadeOut

    $('.widgetWindow1').hover(function(){

        $('.widget1Filters').fadeIn(100);

    },function(){

        $('.widget1Filters').fadeOut(100);

    });



    //widget1 controls fadeIn fadeOut

    $('.widget-box').hover(function(){

        $('#widget1Controls').fadeIn(100);

    },function(){

        $('#widget1Controls').fadeOut(100);

    });







  

    

</script>