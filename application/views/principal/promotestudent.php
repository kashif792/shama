<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>

<div class="col-sm-10" ng-controller="promote_ctrl">
<div id="delete_dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" id="save" class="btn btn-default " value="save">Yes</button>
            </div>
        </div>
    </div>
</div>
	<?php
		// require_footer
		require APPPATH.'views/__layout/filterlayout.php';
	?>
	<div class="panel panel-default">
	  	<div class="panel-heading">Promote Student</div>
	  	<div class="panel-body">
           <!-- <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Add Session</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="email">Add New Session Date:</label>
                                    <input type="text" name="sessiondate" id="sessiondate" ng-model="inputsession">
                                </div>
                                <div class="form-group">
                                    <button type="button" ng-click="savenewsession()" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            <div class="row" style="margin-top: 5px;">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-hover table-condensed" id="table-body-phase-tow" >
                                        <thead>
                                            <tr>
                                                <th>Session</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reporttablebody-phase-two" class="report-body">
                                            <tr ng-repeat="s in sessionlist">
                                                <td>{{s.from}} - {{s.to}}</td>
                                                <td>
                                                    <a href="javascript:void(0)" ng-click="editsession(s.id)" title="Edit" class="edit" session-data="{{s.id}}">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" ng-click="removesession(s.id)" title="Delete"  class="del" session-data="{{s.id}}">
                                                        <i class="fa fa-remove" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Promote Student</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label for="email">Grade:</label>
                                            <select   ng-options="item.name for item in classlist track by item.id"  name="inputClass" id="inputClass"  ng-model="inputClass" ng-change="loadSections()">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Section:</label>
                                            <select   ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="inputSection" ng-change="loadStudentByClass()" >
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Semester:</label>
                                            <select   ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="inputSemester" ng-change="loadStudentByClass()" >
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Session:</label>
                                            <select   ng-options="item.name for item in rsessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="inputRSession" ng-change="loadStudentByClass()" >
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-7">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label for="email">Grade:</label>
                                            <select   ng-options="item.name for item in pclasslist track by item.id"  name="inputPromotedClass" id="inputPromotedClass"  ng-model="inputPromotedClass" ng-change="loadPSections()">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Section:</label>
                                            <select   ng-options="item.name for item in psectionslist track by item.id"  name="inputPromotedSection" id="inputPromotedSection"  ng-model="inputPromotedSection">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Semester:</label>
                                            <select   ng-options="item.name for item in semesterlist track by item.id"  name="inputPSemester" id="inputPSemester"  ng-model="inputPSemester" >
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Session:</label>
                                            <select   ng-options="item.name for item in psessionlist track by item.id"  name="inputPSession" id="inputPSession"  ng-model="inputPSession" >
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" ng-click="promotestudent()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Promote</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <select   ng-options="item.name for item in studentlist track by item.id" multiple="multiple" class="form-control" size="8"  name="from" id="multiselect"  ng-model="inputStudent" >
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" id="multiselect_rightSelected" class="btn btn-block">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i></button>

                                    <button type="button" id="multiselect_rightAll" class="btn btn-block">
                                   <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                    <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                                    <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button>
                                </div>
                                <div class="col-xs-5">
                                    <select name="to" id="multiselect_to" class="form-control" size="8" multiple="multiple">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	  	</div>
	</div>
</div>

<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>
<script src="<?php echo base_url(); ?>js/multiselect.js"></script>

<script>
	var app = angular.module('invantage',[]);
	app.controller('promote_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile){
      	$('#multiselect').multiselect();
        $scope.inputsession = "<?php echo date('m/d/Y'); ?>" + ' - ' + "<?php echo date('m/d/Y'); ?>"
        $('#sessiondate').daterangepicker({
            "autoApply": true,
            "startDate": "<?php echo date('m/d/Y'); ?>",
            "endDate": "<?php echo date('m/d/Y'); ?>"
        }, function(start, end, label) {});



        /**
         * ---------------------------------------------------------
         *   load table
         * ---------------------------------------------------------
         */
        function loaddatatable()
        {
            $('#table-body-phase-tow').DataTable( {
                responsive: true,
                "order": [[ 0, "asc"  ]],
            });
        }

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

        $scope.startdate = '<?php echo date('Y/m/d'); ?>';
        $scope.enddate = '<?php echo date('Y/m/d'); ?>';
        $scope.sid = '';

        $('#sessiondate').on('apply.daterangepicker', function(ev, picker) {
            $scope.startdate = picker.startDate.format('YYYY-MM-DD');
            $scope.enddate = picker.endDate.format('YYYY-MM-DD');
        })

         angular.element(function () {
            loadSession()
         	getClassList()
         	getSessionList()
            getPClassList();
         	getSemesterData()

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

        function getSessionList()
        {
            httprequest(urlist.getsessiondetail,({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.rsessionlist = response
                    $scope.inputRSession = response[0]
                    $scope.psessionlist = response
                    $scope.inputPSession = response[0]
                }
            });
        }

        $scope.savenewsession = function()
        {
            if($scope.inputsession.length > 0)
            {
                var data = ({
                    inputstartdate:$scope.startdate,
                    inputenddate:$scope.enddate,
                    inputsessionid:$scope.sid

                })

                httppostrequest(urlist.savesession,data).then(function(response){
                    if(response != null && response.message == true)
                    {
                        message('Session added','show')
                        loadSession()
                    }
                });
            }
        }

        $scope.editsession = function(sessionid)
        {
            if($scope.inputsession.length > 0)
            {
                $scope.sid = sessionid
                var data = ({
                    inputsessionid:$scope.sid

                })

               httprequest(urlist.getsessionlist,data).then(function(response){
                    if(response != null)
                    {
                        $scope.startdate = response.from;
                        $scope.enddate = response.to;
                       $scope.inputsession = response.from+ ' - ' + response.to


                    }
                });
            }
        }

        $scope.removesession = function(sessionid)
        {
            $("#delete_dialog").modal('show');
            $scope.sid = sessionid
        }

        $(document).on('click','#save',function(){
            $("#delete_dialog").modal('hide');
            var data = ({
                inputsessionid:$scope.sid
            })

           httprequest(urlist.removesession,data).then(function(response){
                if(response != null)
                {
                   message('Session removed','show')
                   loadSession()
                   $scope.sid = ''
                }
            });
        });

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
                $("#multiselect_to option").each(function() {
                    $(this).remove();
                });
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
                        $("#multiselect_to option").each(function() {
                            $(this).remove();
                        });
                        $scope.inputStudent = response[0];
                        $scope.studentlist = response;
                    }
                    else{
                        $scope.studentlist = [];
                        message('','hide')
                    }
                })
            }
            catch(ex){
                console.log(ex)
            }
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

		$scope.promotestudent = function()
		{

			var promoteddata = []
			var x = document.getElementById("multiselect_to");
			var promotedstudentlength =  x.options.length;
            var $this = $(".btn-primary");
            $this.button('loading');

            if(promotedstudentlength == null)
            {
                message('No student selected','show')
                $this.button('reset');
                return false;
            }

            if(promotedstudentlength > 0 && $scope.inputClass.id == $scope.inputPromotedClass.id &&
                $scope.inputSection.id == $scope.inputPromotedSection.id && $scope.inputSemester.id ==
                $scope.inputPSemester.id && $scope.inputRSession.id == $scope.inputPSession.id
            )
            {
                message('Cannot promote student in same class','show')
                $this.button('reset');
                return false;
            }

            if(promotedstudentlength > 0 && $scope.inputClass.id == $scope.inputPromotedClass.id &&
                $scope.inputSection.id == $scope.inputPromotedSection.id && $scope.inputSemester.id ==
                $scope.inputPSemester.id && $scope.inputRSession.id != $scope.inputPSession.id
            )
            {
                message('Cannot promote student','show')
                $this.button('reset');
                return false;
            }

            // if($scope.inputClass.id == $scope.inputPromotedClass.id &&
            //     $scope.inputSection.id == $scope.inputPromotedSection.id && $scope.inputSemester.id ==
            //     $scope.inputPSemester.id )
            // {
            //     message('Cannot promote student in same class semster','show')
            //     $this.button('reset');
            //     return false;
            // }

            var currentsessions = new Date($scope.inputRSession.from)
            var currentsessione = new Date($scope.inputRSession.to)

            var promotesessions = new Date($scope.inputPSession.from)
            var promotesessione = new Date($scope.inputPSession.to)

            if(promotedstudentlength > 0 && $scope.inputClass.id != $scope.inputPromotedClass.id &&
                $scope.inputSection.id == $scope.inputPromotedSection.id && $scope.inputSemester.id ==
                $scope.inputPSemester.id &&
                (currentsessions.getFullYear() >= promotesessions.getFullYear())
            )
            {
                message('Cannot promote student to previous or current session','show')
                $this.button('reset');
                return false;
            }
            // console.log($scope.inputClass.id);
            // console.log($scope.inputPromotedClass.id);
            // console.log($scope.inputSection.id);
            // console.log($scope.inputPromotedSection.id);
            // console.log($scope.inputSemester.id);
            // console.log($scope.inputPSemester.id);
            if(promotedstudentlength > 0 && $scope.inputClass.id != $scope.inputPromotedClass.id &&
                $scope.inputSection.id == $scope.inputPromotedSection.id && $scope.inputSemester.id ==
                $scope.inputPSemester.id &&
                ((parseInt(currentsessions.getFullYear()) - parseInt(promotesessions.getFullYear())) != 1)
            )
            {
                message('Cannot promote student','show')
                $this.button('reset');
                return false;
            }

            //&& $scope.inputClass.id != $scope.inputPromotedClass.id &&
            //$scope.inputSection.id != $scope.inputPromotedSection.id && $scope.inputSemester.id !=
            //$scope.inputPSemester.id && $scope.inputRSession.id != $scope.inputPSession.id

            if(promotedstudentlength > 0 )
			{
				for (var i = 0; i < promotedstudentlength; i++) {
	              	var temp = {}
	              	temp.id = x.options[i].value;
	              	promoteddata.push(temp)
		      	}

		      	httppostrequest(urlist.savepromotedstudents,({
      								data:promoteddata,
      								oldclass:$scope.inputClass.id,
      								oldsection:$scope.inputSection.id,
                                    oldsemester:$scope.inputSemester.id,
      								oldsession:$scope.inputRSession.id,
      								newclass:$scope.inputPromotedClass.id,
      								newsection:$scope.inputPromotedSection.id,
                                    newsemester:$scope.inputPSemester.id,
      								newsessionid:$scope.inputPSession.id,
      							})).then(function(response){
		      		if(response != null && response.message == true)
		      		{
		      			message('Student promoted successfully','show')
		      			$("#multiselect_to option").each(function() {
						    $(this).remove();
						});
                        $this.button('reset');
		      		}
		      		else{
                        $this.button('reset');
		      			message('Student not promoted','show')
		      		}
		      	});
			}else{
                $this.button('reset');
                message('Cannot promote student to same class stander','show')
            }
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
