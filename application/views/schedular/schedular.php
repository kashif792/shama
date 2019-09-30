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
    <div id="delete_location" class="modal fade">
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
                    <button type="button" id="remove_location" class="btn btn-default " value="save">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_school" class="modal fade">
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
                    <button type="button" id="remove_school" class="btn btn-default " value="save">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        // require_footer 
        require APPPATH.'views/__layout/filterlayout.php';
    ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/bs-iconpicker/css/bootstrap-iconpicker.min.css">
       <style type="text/css">
            ol.example li.placeholder:before {
                position: absolute;
            }
            .list-group-item > div {margin-bottom: 5px;}
        </style>

   
    <div class="panel panel-default">
        <div class="panel-heading">
            <label>Schedular</label>    
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3">
                    <select ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="select_class" ng-change="changeclass()"> </select>
                </div>
                <div class="col-sm-3">
                    <select ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="inputSemester" ng-change="changesemester()"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h5 class="pull-left">Lessons</h5>
                             <div class="pull-right">
                                <button id="btnReload" type="button" class="btn btn-primary" ng-click="saveschedular()">
                                     Save
                                </button>
                            </div>
                        </div>
                        <div class="panel-body" id="cont">
                            <ul id="myList" class="sortableLists list-group">
                            </ul>
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

<script src="<?php echo base_url(); ?>js/jquery-menu-editor.js"></script>

<script src='<?php echo base_url(); ?>js/bs-iconpicker/js/bootstrap-iconpicker.min.js'></script>

<script src="<?php echo base_url(); ?>js/schedular/app.js"></script>