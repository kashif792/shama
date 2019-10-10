<?php 
require APPPATH.'views/__layout/header.php';
require APPPATH.'views/__layout/topbar.php';
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



                <p>Are you sure you want to delete this schedule?</p>



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



                <h3 style="padding-left: 40px;">Schedule Information</h3>



                <table class="table table-striped table-hover">



                    <tbody>



                        <tr>



                            <td>



                                <th>Subject Name</th>



                            </td>



                            <td id="user_name"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Grade Name</th>



                            </td>



                            <td id="user_email"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Section Name</th>



                            </td>



                            <td id="user_acct_date"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Teacher Name</th>



                            </td>



                            <td id="user_acct_status"></td>



                        </tr>



                        <tr>



                            <td>



                                <th>Start Time</th>



                            </td>



                            <td id="user_role"></td>



                        </tr>

                          <tr>



                            <td>



                                <th>End Time</th>



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



<div class="col-sm-10">



<?php



	// require_footer 



	require APPPATH.'views/__layout/filterlayout.php';



?>
<div class="panel panel-default">
	<div class="panel-heading">
		<label>Datesheet List
			   &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>add_mid_datesheet" class="btn btn-primary" style="color: #fff !important;">Mid Term Datesheet</a>
			   &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>add_timtble" class="btn btn-primary" style="color: #fff !important;">Final Term Datesheet</a>
     
		</label>
	</div>
	<div class="panel-body">
		<table class="table-body timtbleflter" id="table-body-phase-tow" >

			                        <thead>
				                        <tr>
				                            <th>Session</th>
				                            <th>Type</th>
				                            <th>Grade</th>
				                            <th>Semester</th>
		                                    <th>Subject</th>
		                                    <th>Start Time</th>
		                                    <th>End Time</th>
		                                    <th>Options</th>
				                        </tr>
				                    </thead>
				                    <tfoot>
				                    	<tr>
				                            <th>Session</th>
				                            <th>Type</th>
				                            <th>Grade</th>
				                            <th>Semester</th>
		                                    <th>Subject</th>
		                                    <th>Start Time</th>
		                                    <th>End Time</th>
		                                    <th>Options</th>
				                        </tr>

				                    </tfoot>

			                        <tbody id="reporttablebody-phase-two" class="report-body">

			                        	

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



	});



</script>



<script src="<?php echo $path_url; ?>js/jquery.easyResponsiveTabs.js"></script>







<script type="text/javascript">



	$(document).ready(function(){



		$('#setting').easyResponsiveTabs({ tabidentify: 'vert' });





        







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



            urlpath = "<?php echo $path_url; ?>Teacher/removeSchedule";



            var dataString = ({'id':dvalue});



            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);



    	});







        function userDeleteFailureHandler()



        {



 		 	$(".user-message").show();



	    	$(".message-text").text("Schedule has been not deleted").fadeOut(10000);



        }







        function loadUserDeleteResponse(response)



        {



        	if (response.message === true){



                $("#"+row_slug).remove();



     		 	$(".user-message").show();



		    	$(".message-text").text("schedule has been deleted").fadeOut(10000);



         	} 



        }



        



	});



</script>



<script type="text/javascript">



	var app = angular.module('invantage', []);



</script>







