<?php 

// require_header 

require APPPATH.'views/__layout/header.php';



// require_top_navigation 

require APPPATH.'views/__layout/topbar.php';



// require_left_navigation 

require APPPATH.'views/__layout/leftnavigation.php';

?>



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

                <p>Are you sure you want to delete this grade?</p>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>

            </div>

        </div>

    </div>

</div>

<div id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                <h3 style="padding-left: 40px;">Grade list</h3>

                <table class="table table-striped table-hover">

                    <tbody>

                        <tr>

                            <td>

                                <th>Name</th>

                            </td>

                            <td id="class_name"></td>

                        </tr>

                        <tr>

                            <td>

                                <th>Section</th>

                            </td>

                            <td id="section_name"></td>

                        </tr>

                        <tr>

                            <td>

                                <th>Modified</th>

                            </td>

                            <td id="user_role"></td>

                        </tr>

                    </tbody>

                </table>

             </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>

<div class="modal fade new_form" id="student_form_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Students List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   <!--    	<h4>Lesson</h4>
      	<div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="inputDate" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
       
    </div> -->
      	<!-- <button>End Date</button>
      	<button>Generate Lesson Plan</button>
      	<button>Reset Lesson Plan</button> -->
      	<table class="table-body" id="student_table" >
			                        <thead>
				                        <tr>
				                            <th>Name</th>
				                            <th>Roll No</th>
				                            
				                        </tr>
				                    </thead>
				                    <tfoot>
				                     <tr>
				                            <th>Name</th>
				                            <th>Roll No</th>
				                           
				                     
				                             
				                        </tr>
				                    </tfoot>
 									<tbody id="student_form" class="report-body">

					                </tbody>

			                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!---subject view starrrrrrrrrrrrrrrrrrrrrrrt -->


<div class="modal fade new_form" id="subject_form_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subject List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   <!--    	<h4>Lesson</h4>
      	<div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="inputDate" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
       
    </div> -->
      	<!-- <button>End Date</button>
      	<button>Generate Lesson Plan</button>
      	<button>Reset Lesson Plan</button> -->
      	<table class="table-body" id="subject_table" >
			                        <thead>
				                        <tr>
				                            <th>Subject Name</th>
				                            <th>Subject Code</th>
				                            
				                        </tr>
				                    </thead>
				                    <tfoot>
				                     <tr>
				                         <th>Subject Name</th>
				                            <th>Subject Code</th>
				                           
				                     
				                             
				                        </tr>
				                    </tfoot>
 									<tbody id="subject_form" class="report-body">

					                </tbody>

			                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!---subject view endddddddddddddddddddddddddd -->


<div class="col-sm-10">

<?php

	// require_footer 

	require APPPATH.'views/__layout/filterlayout.php';

?>
<?php 
	$roles = $this->session->userdata('roles');

			
?>
	<div class="col-lg-12 widget">
		<div class="panel-heading plheading" id="widget-header">
			<!-- widget title -->
  				<!-- <div class="widget-title"> -->
	  				<h4>Grade list</h4>
  				<!-- </div> -->
			</div>
			<div class="widget-body">
				<div class="setting-container">
					<div id="setting">          
				  		<ul class="resp-tabs-list vert">
			      			<?php if(count($roles_right) > 0){ ?>
					      	<li class="">Grade</li>
					      	<?php } ?>
					  	</ul> 
			  			<div class="resp-tabs-container vert">                                                        
			      		
			      			<div id="user-managment-tab">
			      				<div class="action-element">
			      					 <?php if( $roles[0]['role_id'] == 3){ ?>
		  							<a href="<?php echo $path_url; ?>newclass" id="add-action">Add Grade</a>
			  						<?php }?>
			  						</div>
			  						<?php if( $roles[0]['role_id'] == 3){?>
			  							<table class="table-body" id="table-body-phase-tow" >
			  						<?php }?>

			  						<?php if( $roles[0]['role_id'] == 4){ ?>
			  							<table class="class_list" id="table-body-phase-tow" >
			  						<?php }?>

			      				
			                        <thead>
				                        <tr>
				                          
		                                    <th>Grade</th>
		                                    <th>Section</th>
		                                    <?php if( $roles[0]['role_id'] == 3){?>
		                                    <th>Options</th>
		                                    <?php }?>
				                        </tr>
				                    </thead>
				                    <tfoot>
				                        <tr>
		                                    <th>Class Name</th>
		                                    <th>Section Name</th>
		                                   <?php if( $roles[0]['role_id'] == 3){?>
		                                    <th>Options</th>
		                                    <?php }?>
				                        </tr>
				                    </tfoot>
			                        <tbody id="student_form" class="report-body">
			                        	<?php $i = 1 ; if(isset($clists)){ ?>
			                                <?php foreach ($clists as $key => $value) {?>
			                                <tr <?php if($i%2 == 0){echo "class='green-bar row-update'";} else{echo "class='yellow-bar row-update'";} ?> id="tr_<?php echo $value->row_slug ;?>" data-view="<?php echo $this->encrypt->encode($value->row_slug) ;?>">
			                                    <td class="row-bar-user" id="<?php echo $value->id ;?>" data-view="<?php echo $value->id ;?>"><?php echo ucwords($value->grade); ?></td>
			                                    <td  class="" data-view="<?php echo $value->id ;?>"><?php echo ucwords($value->section_name); ?></td>
			                                    <?php if ($this->session->userdata('type')=='p')        { ?>
			                                    <td > 
			                                        <a href="<?php echo $path_url; ?>newclass/<?php echo $value->id ;?>" id="<?php echo $value->id ;?>" class='edit' title="Edit">
			                                            <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
			                                        </a>
			                                        <a href="#" title="Delete" id="<?php echo $value->id ;?>" class="del">
			                                            <span aria-hidden="true" class="glyphicon glyphicon-remove"></span>
			                                        </a>
			                                    </td>
			                                     <?php }?>
			                                </tr>
			                                <?php $i++;} ?>
			                                <?php } else{ echo "<p id='novaluefound'>No class found.</p>";} ?>

					                </tbody>

			                    </table>

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


<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

	var dvalue ;

	$(document).ready(function(){

		$(".table-choice").show();

	

		

	});

</script>

<script src="<?php echo $path_url; ?>js/jquery.easyResponsiveTabs.js"></script>



<script type="text/javascript">

	$(document).ready(function(){

		$('#setting').easyResponsiveTabs({ tabidentify: 'vert' });


		loaddatatable('table-body-phase-tow');

	  	/**

     	 * ---------------------------------------------------------

	     *   load table

	     * ---------------------------------------------------------

	     */

	    function loaddatatable(tableinit)

	    {

	        $('#'+tableinit).DataTable( {

	            responsive: true,

	             "order": [[ 0, "asc"  ]],

	            initComplete: function () {

	                this.api().columns().every( function () {

	                    var column = this;

	                    var select = $('<select><option value="">All</option></select>')

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
    

	 


	  	

	  

      	

   

       $(document).on('click','.row-bar-user',function(){

         
       
    	var data = ({sid:$(this).attr('id'),'showModel':true})
      	ajaxType = "GET";
     
  		urlpath = "<?php echo base_url(); ?>Principal_controller/show_all_stds_onclick";
  		
     	ajaxfunc(urlpath,data,loadStudentByIdReponseError,loadStudentByIdResponse); 

          });

		function loadStudentByIdReponseError()
		{
			alert();
		}
		function loadStudentByIdResponse(response){
			
			if(response.length > 0 &&  response != null)
			{
				var str = '';
				for (var i = response.length - 1; i >= 0; i--) {
				str += '<tr>'
				str += '<td class="std" id="'+response[i].id+'">'+response[i].screenname+'</td>'
				str += '<td >'+response[i].username+'</td>'	
				str += '</tr>'
				}

				$("#student_table").dataTable().fnDestroy();
				$("#student_form").html(str)

				loaddatatable('student_table');
		
			}
			else{
				var str = '';
				str += '<tr>'
				str += '<td style="text-align:center;">No record found</td>'
				str += '<td></td>'
				str += '</tr>'
				
				$("#student_table").dataTable().fnDestroy();
				$("#student_form").html(str)

				loaddatatable('student_table');
			}
			 $("#student_form_show").modal('show');
			}
		
//___________________________________________


		$(document).on('click','.std',function(){

         
       
    	var data = ({sid:$(this).attr('id'),'showModel':true})
      	ajaxType = "GET";
     
  		urlpath = "<?php echo base_url(); ?>Principal_controller/show_all_subject_onclick";
  		
     	ajaxfunc(urlpath,data,loadsubjectByIdReponseError,loadsubjectByIdReponse); 

          });

		function loadsubjectByIdReponseError()
		{
			
		}
		function loadsubjectByIdReponse(response){
			
			if(response.length > 0 &&  response != null)
			{
				var str = '';
				for (var i = response.length - 1; i >= 0; i--) {
				str += '<tr>'
				str += '<td>'+response[i].subject_name+'</td>'
				str += '<td >'+response[i].subject_code+'</td>'	
				str += '</tr>'
				}

				$("#subject_table").dataTable().fnDestroy();
				$("#student_form").html(str)

				loaddatatable('subject_table');
		
			}
			else{
				var str = '';
				str += '<tr>'
				str += '<td style="text-align:center;">No record found</td>'
				str += '<td></td>'
				str += '</tr>'
				
				$("#subject_table").dataTable().fnDestroy();
				$("#subject_form").html(str)

				loaddatatable('subject_table');
			}
			// $("#subject_form_show").modal('show');
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

            urlpath = "<?php echo $path_url; ?>Principal_controller/removeClas";

            var dataString = ({'id':dvalue});

            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);

    	});



        function userDeleteFailureHandler()

        {

 		 	$(".user-message").show();

	    	$(".message-text").text("Class has been not deleted").fadeOut(10000);

        }



        function loadUserDeleteResponse(response)

        {

        	if (response.message === true){

                $("#"+row_slug).remove();

     		 	$(".user-message").show();

		    	$(".message-text").text("Class has been deleted").fadeOut(10000);

         	} 

        }

        

	});

</script>

<script type="text/javascript">

	var app = angular.module('invantage', []);

</script>



