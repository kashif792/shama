<?php 

// require_header 

require APPPATH.'views/__layout/header.php';



// require_top_navigation 

require APPPATH.'views/__layout/topbar.php';



// require_left_navigation 

require APPPATH.'views/__layout/leftnavigation.php';

?>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<link href="<?php echo $path_url; ?>css/easy-responsive-tabs.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo $path_url; ?>css/intlTelInput.css">

<div id="myUserModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to delete this subject?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div>

<div class="col-sm-10" ng-controller="subject">

<?php

  // require_footer 

  require APPPATH.'views/__layout/filterlayout.php';

?>
    
<div class="modal fade new_form" id="lesson_plan_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lesson Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Lesson</h4>
        <div id="example1"></div>
                 <div class="col-lg-12">
                    <div class="form-container">
                        <?php $attributes = array('name' => 'schedule_timetable', 'id' => 'schedule_timetable','class'=>'form-container'); echo form_open('', $attributes);?>
                            <input type="hidden" value="<?php if($this->uri->segment(2)){ echo $this->uri->segment(2);} ?>" name="serial" id="serial">


                            <fieldset>
                                 <div class="field-container ">

                                </div>

                                <div class="field-container ">
                                    <div class="field-row">

                                <div class="row"> 
                                        <div class="col-lg-4">
                                            <div class="upper-row">
                                                <label><span class="icon-address"></span> Class<span class="required"></span></label>
                                            </div>
                                                <select name="select_class" id="select_class"    >
                                                <?php 

                                                    if(count($classlist))
                                                    {  
                                                        foreach ($classlist as $key => $value) {
                                                            if(isset($value->id) && !empty($value->grade)){
                                                            ?>
                                                                 <option  value="<?php echo $value->id; ?>" <?php if($value->id==$classlist[0]->id) echo "selected";?>><?php echo $value->grade; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                ?>

                                                
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="upper-row">
                                                <label><span class="icon-home-1"></span> Section <span class="required"></span></label>
                                            </div>
                                         <select   ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="inputSection" >
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="upper-row">
                                                <label><span class="icon-code"></span> Subjects <span class="required"></span></label>
                                            </div>
                                            <select ng-options="item.name for item in subjectlist track by item.id" name="select_subject" id="select_subject" ng-model="inputSubject"></select>
                                        </div>
                                     </div>
                                    </div>
                                </div>

                            </fieldset>

                        <?php echo form_close();?>
                    </div>
                </div>
                 <div id="example1"></div>
                      <div id="form-container">
                          <div class="columnLayout">

                            <div class="rowLayout">
                          <div class="descLayout">
                            <div class="pad" data-jsfiddle="example1">
                              <div id="exampleConsole" class="console"></div>

                           

                              <p>
                                
                                <button  type="button" id="export-file"  class="export_button">
                                    Export as a file
                          </button>
                          <button name="save" onclick="save()" id="save" class="intext-btn sve">Save</button>

                              </p>
                            </div>
                          </div>
                        </div>
                          </div>

                  
                </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<?php 
 $roles = $this->session->userdata('roles');
?>
<div class="panel panel-default">
  <div class="panel-heading">
     <label>Subject List
     <?php if( $roles[0]['role_id'] == 3){       ?>
       &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>newsubject" class="btn btn-primary" style="color: #fff !important;">Add Subject</a>
       <?php }?>
            </label>
  </div>
  <div class="panel-body">
     <table class="table-body table-bordered sbfltr" id="table-body-phase-tow" >
                              <thead>
                                <tr>
                                   <!--  <th>Image</th> -->
                                    <th>Grade Name</th>
                                    <th>Subject Name</th>
                                    <!-- <th>Subject Code</th> -->
                                   
                                    <?php if( $roles[0]['role_id'] == 3){       ?>
                                     <th>Options</th>
                                     <?php }?>
                                </tr>
                            </thead>
                            <tfoot>
                             <tr>
                                    <!-- <th>Thumbail</th> -->
                                    <th>Grade Name</th>
                                    <th>Subject Name</th>
                                    <!-- <th>Subject Code</th> -->
                                    
                                     <?php if( $roles[0]['role_id'] == 3){       ?>
                                     <th>Options</th>
                                     <?php }?>
                                </tr>
                            </tfoot>
                              <tbody id="lesson_plan" class="report-body">
                                <?php $i = 1 ; if(isset($subjectlist)){ ?>
                                      <?php foreach ($subjectlist as $key => $value) {?>

                                      <tr <?php if($i%2 == 0){echo "class='green-bar row-update'";} else{echo "class='row-update'";} ?> id="<?php echo $value['id'] ;?>" >
                                         <!-- <td  data-view="" id="<?php echo 
                                                $value['id'] ;?>"><?php echo ($value['subject_image'] != '' ? '<img src="'.$value['subject_image'].'" class="quiz-image img-rounded" width="50"/>':''); ?> </td> -->
                                          <td class="" data-view=""><?php echo $value['class']; ?></td>
                                          <td  data-view="" id="<?php echo 
                                                $value['id'] ;?>"><?php echo ucwords($value['name']); ?> </td>
                                       <!--    <td class="" data-view=""><?php echo $value['code']; ?></td> -->
                                          
                                           <?php if( $roles[0]['role_id'] == 3){       ?>
                                          <td>
                                              <a href="<?php echo $path_url; ?>newsubject/<?php echo $value['id'] ;?>" id="" class='edit'  title="Edit">
                                                  <i class="fa fa-edit" aria-hidden="true"></i>
                                              </a>
                                                <a href="#" title="Delete" id="<?php echo 
                                                $value['id'] ;?>" class="del">
                                                   <i class="fa fa-remove" aria-hidden="true"></i>
                                                </a>
                                          </td>
                                              <?php }?>
                                      </tr>
                                      <?php $i++;} ?>
                                      <?php }  ?>

                          </tbody>

                          </table>
  </div>
</div>

</div>

<?php

// require_footer 

require APPPATH.'views/__layout/footer.php';

?>

<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>



<script src="<?php echo $path_url; ?>js/jquery.easyResponsiveTabs.js"></script>



<script type="text/javascript">

  $(document).ready(function(){
    var dvalue ;

    $(".table-choice").show();

    $('input[name="inputDate"]').daterangepicker({
            autoApply: true,
          showDropdowns: true,
         
          locale: {
              format: 'MM/DD/YYYY'
          }

      });
    $('input[name="inputDate"]').on('apply.daterangepicker', function(ev, picker) {
 alert()
});
    loaddatatable("table-body-phase-tow");
    loaddatatable("table-body-phase-tow_new");

      /**

       * ---------------------------------------------------------

       *   load table

       * ---------------------------------------------------------

       */

        function loaddatatable(elementint)
        {
            $('#'+elementint).DataTable( {
                responsive: true,
                "order": [[ 0, "asc"  ]],
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                         var select = $('<select><option value=""> All</option></select>')
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
        
    $('#setting').easyResponsiveTabs({ tabidentify: 'vert' });


    
  



        



      
    $('.row-plan').click(function(e){
      e.preventDefault();
       alert() 
        })  ;
    //  var data = ({id:$(this).attr('id'),'showModel':true})
    //    ajaxType = "GET";
     
      // urlpath = "<?php //echo base_url(); ?>getlessonplanbyid";
      
    //    ajaxfunc(urlpath,data,listResponseFailure,loadlistResponse); 

         

    // function listResponseFailure(){}
    // function loadlistResponse(response){
    //  if(response.length > 0 &&  response != null)
    //  {
    //    var str = '';
    //    for (var i = response.length - 1; i >= 0; i--) {
    //      str += '<tr>'
    //      str += '<td class="" id="'+response[i].id+'">'+response[i].title+'</td>'
    //      str += '<td>'+response[i].date+'</td>'  
    //      str += '<td id="'+response[i].id+'" class="Repeat">'+'<span><input type="button" id="'+response[i].id+'" class="btn btn-primary" value="Repeat" name="Repeat"/></span>'+'</td>'
         
                            
    //      str += '</tr>'
    //    }

    //      $("#plan_table").dataTable().fnDestroy();
    //    $("#lesson_plan").html(str)

    //    loaddatatable('plan_table');
    //  }
    
    //   $("#lesson_plan_show").modal('show');
    //  }
    



    // $(document).on('click','.Repeat',function()
  //       {
  //        value =  $(this).attr('id');
  //        var data = ({id:$(this).attr('id')})
  //        ajaxType = "GET";

  //        urlpath = "<?php //echo base_url(); ?>Repeat";
          

  //        ajaxfunc(urlpath,data,lessonResponseFailure,loadlessonResponse); 
     
          
  //       });

  //       function lessonResponseFailure()
  //       {
  //        alert("Erorr");
  //       }

    // function loadlessonResponse(response){
    //  if(response != null)
    //  {
    //    var str = '';
    //    str += '<tr>'
    //    str += '<td class="" id="'+response.id+'">'+response.title+'</td>'
    //    str += '<td>'+response.date+'</td>' 
    //    str += '<td id="'+response.id+'" class="Repeat">'+'<span><input type="button" id="'+response.id+'" class="btn btn-primary" value="Repeat" name="Repeat"/></span>'+'</td>'
    //    str += '</tr>'
    //    $("#plan_table").dataTable().fnDestroy();
    //    $("#lesson_plan").append(str)
    //    loaddatatable('plan_table');
    //  }

    //}



    $("#quizform").submit(function(){
      
            var url = '<?php echo base_url(); ?>show_subject_list';
            var data = ({
              'inputquizname':inputquizname,
              
              'serial':parseInt($("#serial").val()),
           
              
            })

   
            httppostrequest(url,data).then(function(response){
              if(response.message == true)
              {
                $scope.lastid =response.lastid;

                alert("Quiz saved successfully");

                $('#myModal').modal('show');
                $("#savequiz").attr('disabled', true);
              }
            });

            return false;
    })  ;
    // console.log($scope.serail)
    

  
        function loadClassByIdReponseError(){}

        function loadClassByIdResponse(data)
        {
            if(data.message == true)
            {
                $("#class_name").html(data.grade);
                $("#section_name").html(data.section_name);
                
                            
                $("#myModal").modal('show');
            }

        }

         /*

         * ---------------------------------------------------------

         *   Delete User

         * ---------------------------------------------------------

         */

        $(document).on('click','.del',function(){

            $("#myUserModal").modal('show');

            dvalue =  $(this).attr('id');

         

            row_slug =   $(this).parent().parent().attr('id');

            

        });

        
        

        /*

         * ---------------------------------------------------------

         *   User notification on deleting user 

         * ---------------------------------------------------------

         */

        $(document).on('click','#UserDelete',function(){

            $("#myUserModal").modal('hide');

        ajaxType = "GET";

            urlpath = "<?php echo $path_url; ?>Principal_controller/removeSubject";

            var dataString = ({'id':dvalue});

            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);

      });



        function userDeleteFailureHandler()

        {

      $(".user-message").show();

        $(".message-text").text("Subject has been not deleted").fadeOut(10000);

        }



        function loadUserDeleteResponse(response)

        {

          if (response.message === true){

                $("#"+row_slug).remove();

          $(".user-message").show();

          $(".message-text").text("Subject has been deleted").fadeOut(10000);

          } 

        }

        

  });

</script>

<script type="text/javascript">

  var app = angular.module('invantage', []);
  app.controller('subject',function($scope,$http,$interval){

    function loaddatatable(elementint)

      {

          $('#'+elementint).DataTable( {

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

      
       
              

          

       

           
            

  



        
  
  })
</script>



