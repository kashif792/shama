<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>
<div id="detail_modal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to delete this record?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div>
<div class="col-sm-10"  ng-controller="timetable_controller">
    <?php
        // require_footer
        require APPPATH.'views/__layout/filterlayout.php';
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>View Announcement </label>
        </div>
    <input type="hidden" name="serial" id="serial" ng-model="serial" >  

    <div class="col-md-12 table_record">
        <table class="table table-striped table-bordered row-border hover" id="table-body-phase-tow">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Phone Number</th>
                    <th>Date Time</th>
                    <th>User</th>
                    <th>Target Type</th>
                    <th>Status</th>
                 </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    </div>
</div>
<script type="text/javascript">

    var app = angular.module('invantage', []);

    app.directive('myRepeatDirective', function() {
        return function(scope, element, attrs) {
    
            if (scope.$last){
                checkClass()
            }
        };
    });

    app.controller('timetable_controller', function($scope, $http, $interval,$filter) {
        $scope.filterobj = {};
        $scope.fallsemester = [];
        var urlist = {
            getclasslist:'<?php echo base_url(); ?>getclasslist',
            
        }

        $scope.serial = "<?php echo $this->uri->segment('2'); ?>";
        $scope.select_target="";
        $scope.editresponse = [];
        $scope.firsttimeload = false;
        $scope.requests = [];
        //$scope.classlist = [];
        angular.element(function(){
            if($scope.serial == '')
            {
                initmodules();
            }

            if($scope.serial != '')
            {
                $scope.firsttimeload = true;

                
            }
        });

  

        $scope.getAnnouncementData = function()
        {
            try{
                    var data ={
                        serial:$scope.serial,
                    }
                    //console.log(data);

                    httppostrequest('<?php echo $path_url; ?>Principal_controller/getAnnouncementDetailList',data).then(function(response){
                        $scope.data = [];
                        if(response.length > 0 && response != null)
                        {
                            for (var i=0; i<response[0]['listarray'].length; i++) {
                                $scope.data.push(response[0]['listarray'][i]);
                            }
                            
                            $("#table-body-phase-tow").dataTable().fnDestroy();
                            $scope.loaddatatable($scope.data);
                            
                        }
                        else{
                            $scope.list = [];
                        }
                    });
                }
            catch(e){}
        }
        $scope.getAnnouncementData();
        
        $(document).ready(function(){
        $scope.loaddatatable = function(data)
        {
            var listdata= data;
            
            var table = $('#table-body-phase-tow').DataTable( {
                data: listdata,
                responsive: true,
                "order": [[ 0, "asc"  ]],
                rowId: 'id',
                columns: [
                    { data: 'id' },
                    { data: 'phone_number' },
                    { data: 'created_at' },
                    { data: 'user_id' },
                    { data: 'target_type' },
                    { data: 'status' },
                    
                ],

                "pageLength": 10,

            })
        }
    })
        
        function httprequest(url,data)
          {
            var request = $http({
              method:'GET',
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

<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>
