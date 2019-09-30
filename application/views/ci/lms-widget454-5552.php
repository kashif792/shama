<div class="col-lg-12" ng-controller="report_ctrl" ng-init="getBaseUrl('<?php echo base_url(); ?>')">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Report</label>
        </div>
        <div class="panel-body" >
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="inputClass">Class:</label>
                            <select   ng-options="item.name for item in classlist track by item.id"  name="inputClass" id="inputClass"  ng-model="inputClass" ng-change="loadSections()">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSection">Section:</label>
                            <select   ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="inputSection" ng-change="loadStudentByClass()" >
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSemester">Semester:</label>
                            <select   ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="inputSemester" ng-change="loadStudentByClass()" >
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputRSession">Session:</label>
                            <select   ng-options="item.name for item in sessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="inputRSession" ng-change="loadStudentByClass()" >
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#lessonplan" data-toggle="tab">Lesson Plan</a></li>
                        <li><a href="#profile" data-toggle="tab">Profile</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="lessonplan">
                            <div class="form-group">
                                <label for="select_subject">Subject<span class="required"></span></label>
                                <select ng-options="item.name for item in subjectlist track by item.id" name="select_subject" id="select_subject" ng-model="inputSubject"></select>
                            </div>
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    app.controller('report_ctrl', function($scope, $window, $http, $document, $timeout,$interval){
        var urlist = {
            getclasslist:'getclasslist',
            getsectionbyclass:'getsectionbyclass',
            getstudentbyclass:'getstudentbyclass',
            savepromotedstudents:'savepromotedstudents',
            getsessionlist:'getsessionlist',
            savesession:'savesession',
            removesession:'removesession',
            getsessiondetail:'getsessiondetail',
        }

        angular.element(function () {
           loadSession()
           getClassList()
           getSessionList()
           getPClassList();
           getSemesterData()
           getSubjectList();
        });

        function loadSession()
        {
           httprequest(urlist.getsessionlist,({})).then(function(response){
               if(response != null && response.length > 0)
               {
                   $scope.sessionlist = response
               }
           });
        }

       $scope.subjectlist = [];

       function getSubjectList()
       {
         try{
             var data = ({sinputclassid:$scope.inputClass.id})

             httprequest('<?php echo $path_url; ?>getsubjectlistbyclass',data).then(function(response){
                 if(response.length > 0 && response != null)
                 {
                     $scope.inputSubject = response[0];

                     $scope.subjectlist = response;


                 }
                 else{
                     $scope.subjectlist = [];

                 }
             })
         }
         catch(ex){}
       }

       function getClassList()
       {
          httprequest(urlist.getclasslist,({})).then(function(response){
              if(response != null && response.length > 0)
              {
                  $scope.classlist = response
                  $scope.inputClass = response[0]
                  $scope.loadSections()
              }
          });
       }

        function getPClassList()
       {
          httprequest(urlist.getclasslist,({})).then(function(response){
              if(response != null && response.length > 0)
              {
                  $scope.pclasslist = response
                  $scope.inputPromotedClass = response[0]
                  $scope.loadPSections()
              }
          });
       }

      $scope.loadSections= function()
       {
           try{
               var data = ({inputclassid:$scope.inputClass.id})
               httprequest(urlist.getsectionbyclass,data).then(function(response){
                   if(response.length > 0 && response != null)
                   {
                       $scope.inputSection = response[0];
                       $scope.sectionslist = response;
                       $scope.loadStudentByClass()
                   }
                   else{
                       $scope.sectionslist = [];
                       message('','hide')
                   }
               })
           }
           catch(ex){}
       }

       $scope.loadPSections= function()
       {
           try{
               var data = ({inputclassid:$scope.inputPromotedClass.id})
               httprequest(urlist.getsectionbyclass,data).then(function(response){
                   if(response.length > 0 && response != null)
                   {
                       $scope.inputPromotedSection = response[0];
                       $scope.psectionslist = response;

                   }
                   else{
                       $scope.psectionslist = [];
                       message('','hide')
                   }
               })
           }
           catch(ex){}
       }


       $scope.loadStudentByClass = function()
       {
          try{
               var data = ({   inputclassid:$scope.inputClass.id,
                               inputsectionid:$scope.inputSection.id,
                               inputsemesterid:$scope.inputSemester.id,
                               inputsessionid:$scope.inputRSession.id,
                           })
               httprequest(urlist.getstudentbyclass,data).then(function(response){
                   if(response.length > 0 && response != null)
                   {
                       $scope.inputStudent = response[0];
                       $scope.studentlist = response;
                   }
                   else{
                       $scope.studentlist = [];
                       message('','hide')
                   }
               })
           }
           catch(ex){}
       }

       function getSemesterData(){
          try{

              httprequest('<?php echo $path_url; ?>getsemesterdata',({})).then(function(response){
                  if(response.length > 0 && response != null)
                  {
                      $scope.semesterlist = response;
                      for (var i = 0; i < response.length; i++) {
                           if(response[i].status == 'a')
                           {
                                $scope.inputSemester = response[i];
                           }
                       }

                      $scope.inputPSemester = response[0];

                  }
                  else{
                      $scope.semesterlist = [];
                  }
              })
          }
          catch(ex){}
      }



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

       function httppostrequest(url,data)
       {
           var request = $http({
               method:'POST',
               url:url,
               data:data,
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


  });
</script>
