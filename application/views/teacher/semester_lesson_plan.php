<?php

// require_header

require APPPATH.'views/__layout/header.php';

require APPPATH.'views/__layout/plan.php';

// require_top_navigation

require APPPATH.'views/__layout/topbar.php';



// require_left_navigation

require APPPATH.'views/__layout/leftnavigation.php';

?>


<a id="exportAnchorElem" style="display:none"></a>

<div id="myUserModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to delete this parent?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div>
<div class="col-sm-10 semester-lesson-plan-widget plan-widget modified-header"  ng-controller="lesson_plan_controler">

<?php

  require APPPATH.'views/__layout/filterlayout.php';

?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <label>Semester lesson plans</label>
    </div>
    <div class="panel-body">
        <div class="row">
                <div class="col-lg-12">
                    <div class="form-container">
                        <?php $attributes = array('name' => 'schedule_timetable', 'id' => 'schedule_timetable','class'=>'form-inline'); echo form_open('', $attributes);?>
                            <input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="serial" id="serial">
                            <fieldset>
                             <div class="form-group">
          <label for="select_class">Grade<span class="required"></span></label>
         <select   ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class" class="form-control" ng-model="select_class"></select>
  </div>

                          <div class="form-group">
    <label for="inputSection">Section<span class="required"></span></label>
     <select   ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection" class="form-control"  ng-model="inputSection" >
                                            </select>
  </div>

                       <div class="form-group">
    <label for="select_subject">Subject<span class="required"></span></label>
     <select ng-options="item.name for item in subjectlist track by item.id" name="select_subject" id="select_subject"  class="form-control"ng-model="inputSubject"></select>
  </div>

                   <div class="form-group">
    <label for="inputSemester">Semester<span class="required"></span></label>
     <select   ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  class="form-control" ng-model="inputSemester">
                                            </select>
  </div>


                            </fieldset>
                        <?php echo form_close();?>
                    </div>
                </div>
                </div>

                <div class="imageloader"></div>
                    <div id="example1"></div>
                    <div class="pagination"></div>
                    <div class="error-message">
                        <p>Semester data not found</p>
                    </div>
                   <div class="row" id="button_row">
                        <div class="col-sm-12">
                            <p>
                                <button  type="button" id="export-file"  class="export_button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Exporting...">Export</button>
                                <button name="save"  id="saveupdate2" ng-click="savesemesterplan()" class="intext-btn sve" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving...">Save</button>
                                <button name="Update"  id="UpdateLesson" class="intext-btn sve" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating...">Update</button>
                                <!-- <button name="Delete"  id="DeleteLesson" class="intext-btn sve" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading...">Reset</button> -->
                            </p>
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
<style>
.hot-container {
    width: 500px;
    height: 500px;
    overflow: hidden;
}

#container{
  padding-left: 0 !important;
}
    .pagination {
      padding: 10px 0;
    }
    .pagination a {
      border: 1px solid grey;
      padding: 2px 5px;
    }
    .plan-widget #container{
      padding-left: 0 !important;
    }
          </style>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

  var dvalue ;

  $(document).ready(function(){

    $(".table-choice").show();


    loaddatatable();

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

              initComplete: function () {

                  this.api().columns().every( function () {

                      var column = this;

                      var select = $('<select><option value=""></option></select>')

                          .appendTo( $(column.footer()).empty() )

                          .on( 'change', function () {

                              var val = $.fn.dataTable.util.escapeRegex(

                                  $(this).val()

                              );



                              column

                                  .search( val ? '^'+val+'$' : '', true, false )

                                  .draw();

                          });

                      column.data().unique().sort().each( function ( d, j ) {

                          select.append( '<option value="'+d+'">'+d+'</option>' )

                      });

                  });

              }

          });

      }

  });

</script>
<script type="text/javascript">
    var app = angular.module('invantage', []);

    app.controller('lesson_plan_controler', function($scope, $http, $interval) {

      $scope.lesson_header = ['Date', 'Concept','Topic', 'lesson','Type','Content','Preference','Id'];

        function loader()
    {
       $(".imageloader").height($(".panel-body").height() - 20);  
      $(".imageloader").width($(".panel-body").width() + 30);
    }

    angular.element(function(){
      getClassList();
      
       
    });

       $scope.is_document_changed = false;
    $(window).bind('beforeunload', function(){
        if($scope.is_document_changed == true)
        {
           return 'Are you sure you want to leave?';
        }

    });

       function getClassList()
        {
          httprequest('getclasslist',({})).then(function(response){
            if(response != null && response.length > 0)
            {
              $scope.classlist = response
              $scope.select_class = response[0]
             loadSections()

            }
          });
        }




      $scope.subjectlist = [];
       $scope.page = 1;
      function getSubjectList()
      {
        try{
            var data = ({sinputclassid:$scope.select_class.id})

            httprequest('<?php echo $path_url; ?>getsubjectlistbyclass',data).then(function(response){
                if(response.length > 0 && response != null)
                {
                    $scope.inputSubject = response[0];

                    $scope.subjectlist = response;
                    getSemesterData()

                }
                else{
                    $scope.subjectlist = [];

                }
            })


        }
        catch(ex){}
      }

        function retriveData()
        {
          loader()
          $(".imageloader").show();
          get_data($scope.select_class.id,$scope.inputSubject.id,$scope.inputSection.id,$scope.inputSemester.id);


        }


        function loadSections()
        {

            try{
                var data = ({inputclassid:$scope.select_class.id})

                httprequest('<?php echo $path_url; ?>getsectionbyclass',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.inputSection = response[0];
                        $scope.sectionslist = response;
                        getSubjectList();
                    }
                    else{
                        $scope.sectionslist = [];


                    }
                })
            }
            catch(ex){}
        }


      function getSemesterData(){
      try{
        $scope.semesterlist = []
        httprequest('<?php echo $path_url; ?>getsemesterdata',({})).then(function(response){
          if(response.length > 0 && response != null)
          {
            //$scope.semesterlist = [];
            $scope.semesterlist = response;
            for (var i = 0; i <= response.length - 1; i++) {

                if(response[i].status == 'a')
                {
                     //$scope.semesterlist[0] = response[i]; // restrict teacher to current semester only
                     $scope.inputSemester = response[i];
                      retriveData()
                }
            }
          }
          else{
            $scope.semesterlist = [];
          }
        })

           // var waitforresponse ;
           //   waitforresponse = $interval(function(){
           //     if($scope.inputSemester.id > 0){

           //    $interval.cancel(waitforresponse);

           //    }

           //  },1000);
      }
      catch(ex){}
    }

      $(document).on('change','#inputSemester',function(){
             try{
                 $scope.page = 1
              $scope.loading_data = 1;
                retriveData()
            }
            catch(ex){}
        })

        $(document).on('change','#select_class',function(){
             try{

                var data = ({inputclassid:parseInt($("#select_class").val())})
                $scope.loading_data = 1;
                httprequest('<?php echo $path_url; ?>getsectionbyclass',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.inputSection = response[0];
                        $scope.sectionslist = response;
                        loadSections();
                    }
                    else{
                        $scope.sectionslist = [];
                        $scope.loading_data = 2;
                    }

                })
            }
            catch(ex){}
        })

            $(document).on('change','#inputSection',function(){
                try{
                  $scope.loading_data = 1;
                  getSubjectList()
                }
                catch(ex){}
              })

         $(document).on('change','#select_subject',function(){
          $scope.loading_data = 1;
      retriveData()

  });


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


      function responseSuccess(response){
        return (response.data);
      }

      function responseFail(response){
        return (response.data);
      }


            var
              $container = $("#example1"),
              $parent = $container.parent(),
              autosaveNotification,
              hot;

                var change=1;
              var part = [];

              $scope.loading_data = 1;

            function get_data(classid,subjectid,sectionid,inputSemester)
            {
                try{
                    part = []
                    var userdata = []

                    $.ajax({
                        url: 'sgetdata',
                        type: 'POST',
                        dataType: 'json',
                        data: {classid:classid,sectionid:sectionid,subjectid:subjectid,recordstatus:change,semesterid:inputSemester},
                        success: function (res) {
                            if(typeof res != 'undefined' && res && res.length > 0)
                            {
                                $scope.defaultresponse = [];
                                if(res.length > 0){
                                  $(".pagination").html('')
                                    $scope.defaultresponse = res
                                    var total_pages = parseInt(res.length - 1) / 20
                                    if(total_pages >= 1){
                                        $(".pagination").html('')
                                        for (var i = 0; i <= total_pages; i++) {
                                            var curiter = i + 1
                                            $(".pagination").append('<li><a href="#'+curiter+'">'+curiter+'</a></li>')
                                        }
                                    }
                                    initobj();
                                    $scope.loading_data = 2;
                                    message('','hide');
                                    $(".error-message").hide();
                                    $("#button_row").show();
                                }
                            }else{
                                $scope.defaultresponse = [];
                                $(".pagination").html('')
                                $scope.loading_data = 2;
                                message('No data found','show')
                                $(".imageloader").hide();
                                $(".error-message").show();
                                $("#button_row").hide();
                                initobj();
                            }
                            
                        },
                        error:function(error){}
                    });
                    $scope.loading_data = 2;
                }
                catch(e)
                {
                  console.log(e)
                }
            }
                var priorityarray = [];

               function getPaginationData()
              {
                if($scope.defaultresponse.length > 0)
                {
                  var page  = $scope.page
                      limit = 20,
                      row   = (page - 1) * limit,
                      count = page * limit,
                      part  = [];

                    $(".pagination li").removeClass('active')
                    $(".pagination li:nth-child("+page+")").addClass('active')

                    for (; row < count && row< $scope.defaultresponse.length; row++) {

                      var temp = []

                       temp.push($scope.defaultresponse[row].read_date)
                       temp.push($scope.defaultresponse[row].concept)
                       temp.push($scope.defaultresponse[row].topic)
                       temp.push($scope.defaultresponse[row].lesson)
                       temp.push($scope.defaultresponse[row].type)

                     temp.push($scope.defaultresponse[row].content)
                     /*
                     var content = $scope.defaultresponse[row].content.trim();
                     if(null!=content && content.length>0){
                      content = "<a target='_blank' href='" + content + "'>" + content + "</a>";
                     }
                     temp.push(content)
                     */
                     temp.push($scope.defaultresponse[row].preference)


                       temp.push($scope.defaultresponse[row].id)
                       var num = parseInt(row);
                       priorityarray.push(num.toString())
                      part.push(temp);
                    }


                    return part;
                  }
                  else{
                      var temp = []
                      return temp;
                  }
            }

            var hot ;
            var container = document.getElementById('example1')
              Handsontable.Dom.addEvent(window, 'hashchange', function (event) {
               $scope.page = parseInt(window.location.hash.replace('#', ''), 10)
               initobj();
              });

             Handsontable.Dom.addEvent(window, 'resize', calculateSize);

             function calculateSize()
             {

             }

            function initobj()
            {
                var container = $("#example1").handsontable({
                    data: getPaginationData(),
                    colHeaders: (getPaginationData().length > 0 ? $scope.lesson_header : []),
                    rowHeaders: true,
                    contextMenu: ['remove_row','row_above', 'row_below'],
                    manualRowResize: true,
                    columnSorting: true,
                    sortIndicator: true,
                    autoWrapCol :true,
                    autoColSize: true,
                    autoWrapRow: true,
                    dropdownMenu: true,
                    rowHeaders: true,
                    manualRowMove: true,
                    width: $(".panel").width(),
                    height: ($scope.defaultresponse.length < 10 ? 200 : 500 ) ,
                    columns: [
                        {
                            type: 'date',
                            dateFormat: 'YYYY/MM/DD',
                            correctFormat: true,
                        },
                        {data: 1},
                        {readOnly: false,},
                        {data:3},
                        {
                            type: 'dropdown',
                            source: ['Document', 'Video', 'Image', 'Text','Application','Game']
                        },
                        {readOnly: true},
                        {
                            type: 'dropdown',
                            source: priorityarray
                        },
                        {readOnly: true, width: 1},
                    ],


          beforeRemoveRow:function(index,amount)
          {
           for (var i = amount - 1; i >= 0; i--) {
             console.log(index[i])
           };
             var id = $("#example1").handsontable('getDataAtRow',index,1);
                    var data = {

                        id:id,
                    }

                     $.ajax({
                     url:'sdeleteplan',
                      type: 'POST',
                      dataType: "JSON",
                      data: {data:data,candelete:true},
                      success: function(res){



                      },
                        error: function(){
                     alert("Fail")
                  }});

          },




                  afterChange: function (change, source)
                   {
                    if (source === 'loadData') {
                        return; //don't save this change
                    }

                    if(change[0][2] != change[0][3])
                    {
                       $scope.is_document_changed = true;
                    }

                },

              });

               var $container = $("#example1");
              var handsontable = $container.data('handsontable');
              $(".imageloader").hide();

          }
          
            $scope.savesemesterplan = function(){
                var classid=$("#select_class").val();
                var sectionid=$("#inputSection").val();
                var subjectid=$("#select_subject").val();
                var semesterid=$("#inputSemester").val();
                var $container = $("#example1");
                var jsonString = JSON.stringify($container.data('handsontable').getData());
              
                 var $this = $("#saveupdate2");
                 $scope.is_document_changed = false;
                $this.button('loading');
                $.ajax({
                    url:'sSavedata',
                    type: 'POST',
                     dataType: "json",
                     beforeSend: function(x) {
                        if(x && x.overrideMimeType) {
                            x.overrideMimeType("application/json;charset=UTF-8");   
                        }
                    },
                    data: {data:jsonString,candelete:true,classid:classid,sectionid:sectionid,subjectid:subjectid,sectionid:sectionid,semesterid:semesterid},
                    success: function(res){
                      console.log(res.message)
                      if(res.message == true)
                      {
                        $this.button('reset');
                        part=[];
                        retriveData()
                      }
                      else{
                        message("Data not saved","show");
                      }
                    },
                    error: function(){
                        alert("Fail")

            $this.button('reset');
                    }
                });
            }






          $(document).on('click','.nowsave',function(){
                        var files = $('input[type="file"]').get(0).files;
            // Loop through files
            var size, ext ;
            file = files[0];
            size = file.size;
            ext = file.name.toLowerCase().trim();
            ext = ext.substring(ext.lastIndexOf('.') + 1);
            ext = ext.toLowerCase();
            var validExt = ["csv"];
            if($.inArray(ext,validExt) == -1){
                message("Please must upload text file","show");
                return false;
            }
            else{
                message("","hide");
            }
               $file=$("#file").val();
                if(!$file)
                {
                  alert('Please select a file');

                }
                 var classid=$("#select_class").val();
                 var sectionid=$("#inputSection ").val();
                 var subjectid=$("#select_subject").val();
                 var semesterid=$("#inputSemester").val();
                  var formData = new FormData();

                  formData.append('classid',classid)
                  formData.append('sectionid',sectionid)
                  formData.append('subjectid',subjectid)
                  formData.append('semesterid',semesterid)

                  formData.append('Import',true);
                 $.each($("#file")[0].files,function(key,value){
                formData.append("file",value);
            });
                   $.ajax({
                    url: '<?php echo $path_url;?>Principal_controller/ImportDefaultPlan?file',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    dataType: 'json',
                    mimeType:"multipart/form-data",
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                    success: function(data) {

                      part=[];


                  retriveData();
                      }
                    });

                return false;
          }) ;


     $(document).on('click','.export_button',function(){

        var classid=$("#select_class").val();
             var sectionid=$("#inputSection ").val();
              var subjectid=$("#select_subject").val();
              var semesterid=$("#inputSemester").val();
               var $this = $(this);

                    var $this = $(this);
                    var fileName = $("#select_class option:selected").text() + "_" + $("#select_subject option:selected").text() + "_" + $("#inputSemester option:selected").text();
                    fileName = "sem_lesson_plan_" + fileName.replace(/ /g, '_') + ".xls";
                    //console.log("subject: " + fileName);

            $this.button('loading');
              $.ajax({
                     url:'sexportdata',
                      type: 'POST',
                      dataType: 'json',
                      data: {classid:classid,sectionid:sectionid,subjectid,semesterid:semesterid},
                      success: function(data){
                            var downloader = document.getElementById('exportAnchorElem');
                            downloader.setAttribute('href', data.file);
                            downloader.setAttribute('download', fileName);
                            downloader.click();
                            $this.button('reset');
                      },
                      error: function(){
                        alert("Fail")

                        $this.button('reset');
                      }
                });

              });








  $(document).on('click','#UpdateLesson',function(){

              var classid=$("#select_class").val();
              var sectionid=$("#inputSection").val();
              var subjectid=$("#select_subject").val();
              var semesterid=$("#inputSemester").val();
               var DeleteLessonPlan=false;
               var $this = $(this);
            $this.button('loading');

              // alert(classid);

                    $.ajax({
                     url:'UpdateSemesterLessonPlan',
                      type: 'POST',

                      data:$("#schedule_timetable").serializeArray(),
                      success: function(res){

                     $this.button('reset');
                       part=[];
                     retriveData();
                      },
                        error: function(){
                          $this.button('reset');
                     alert("Fail")
                  }

            });
 });






$(document).on('click','#DeleteLesson',function(){

              var classid=$("#select_class").val();
              var sectionid=$("#inputSection").val();
              var subjectid=$("#select_subject").val();
              var semesterid=$("#inputSemester").val();
              var DeleteLessonPlan=true;
               var $this = $(this);

            $this.button('loading');

              // alert(classid);

                    $.ajax({
                     url:'ResetLessonPlan',
                      type: 'POST',
                      data:$("#schedule_timetable").serializeArray(),
                      success: function(res){


                        $this.button('reset');
                       part=[];
                     retriveData();
                      },
                        error: function(){
                          $this.button('reset');
                     alert("Fail")
                  }
                });

            });


 });

</script>
