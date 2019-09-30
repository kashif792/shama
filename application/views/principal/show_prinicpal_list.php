<?php

// require_header

require APPPATH.'views/__layout/header.php';



// require_top_navigation

require APPPATH.'views/__layout/topbar.php';



// require_left_navigation

require APPPATH.'views/__layout/leftnavigation.php';

?>


<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<div id="myUserModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirmation</h4>

            </div>

            <div class="modal-body">

                <p>Are you sure you want to delete this principal?</p>

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
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <label class="modal-title">Principal</label>
      </div>
            <div class="modal-body">
              
                <div class="row">
                    <div class="col-sm-12"> 
                        <div class="col-sm-5">
                            <img class="img-rounded size" id="profile_image" width="225" src="">
                        </div>
                         <div class="col-sm-7">
                                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <td>
                                <th>First Name:</th>
                            </td>
                            <td id="user_name"></td>
                            
                        </tr>
                            <tr>
                            <td>
                                <th>Last Name:</th>
                            </td>
                            <td id="user_lastname"></td>
                            
                        </tr>
                        <tr>
                            <td>
                                <th>Email:</th>
                            </td>
                            <td id="email"></td>
                        </tr>
                        <tr>
                            <td>
                                <th>City:</th>
                            </td>
                            <td id="teacher_city"></td>
                        </tr>
                        
                       
                    </tbody>
                </table>
                        
                         </div>
                    </div>   
                    
                         </div> 


                <table class="table table-striped table-hover">
                    <tbody>
                       <tr>
                            
                                <th>Gender</th>
                          
                            <td id="teacher_gender"></td>
                           
                                <th>NIC #</th>
                         
                            <td id="teacher_Nic"></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                          
                                <th>Phone</th>
                           
                            <td id="phone"></td>
                         <th>Schools</th>
                      
                            <td id="schools" colspan="3"></td>
                        </tr>
                         <tr>
                            
                                
                        </tr>

                         <tr>
                       
                                <th>Primary Address</th>
                    
                            <td id="primry_home_address"></td>
                          
                                <th>Secondary Address</th>
                            
                            <td id="secondary_home_address"></td>
                        </tr>
 						<tr>
                            
                                <th>Province</th>
                         
                            <td id="teacher_province"></td>
                              <th>Zipcode</th>
                         
                            <td id="teacher_zipcode"></td>
                                
                        </tr>
                       <!--  <tr>
                           
                              
                    
                                <th>Schools</th>
                      
                            <td id="schools" colspan="3"></td>
                        </tr> -->
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
    <div class="panel">
        <div class="panel-heading">
            <label>Principal List
                <a href="<?php echo $path_url; ?>add_Prinicpal" class="btn btn-primary" style="color: #fff !important;">Add a Principal</a>
            </label>
        </div>
        <div class="panel-body">
            <table class="table-body" id="table-body-phase-tow" >
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>School</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>School</th>
                                            <th>Options</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="reporttablebody-phase-two" class="report-body">
                                        <?php $i = 1 ; if(isset($teacherlist)){ ?>
                                            <?php foreach ($teacherlist as $key => $value) {?>
                                            <tr <?php if($i%2 == 0){echo "class='green-bar row-update'";} else{echo "class='yellow-bar row-update'";} ?> id="tr_<?php echo $value['principal_id']  ;?>" data-view="<?php echo $this->encrypt->encode($value->row_slug) ;?>">
                                                <td class="row-bar-user" data-view="<?php echo $value['principal_id'] ;?>"><?php echo ucwords(html_entity_decode(stripcslashes($value['principal_firstname']))); ?></td>
                                                <td class="row-bar-user" data-view="<?php echo $value['principal_id'] ;?>"><?php echo ucwords(html_entity_decode(stripcslashes($value['principal_lastname']))); ?></td>
                                                <td class="row-bar-user" data-view="<?php echo $value['principal_id'] ;?>"><?php echo $value['email']; ?></td>
                                                <td class="row-bar-user" data-view="<?php echo $value['principal_id'] ;?>"><?php echo $value['school']; ?></td>
                                            
                                                <td>
                                                    <a href="<?php echo $path_url; ?>add_Prinicpal/<?php echo $value['principal_id'] ;?>" id="" class='edit' title="Edit">
                                                         <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" title="Delete" id="<?php echo $value['principal_id'] ;?>" class="del">
                                                         <i class="fa fa-remove" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $i++;} ?>
                                            <?php } else{ echo "<p id='novaluefound'>No teacher found.</p>";} ?>

                                    </tbody>

                                </table>
        </div>
    </div>

</div>

<?php

// require_footer

require APPPATH.'views/__layout/footer.php';

?>



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

<script src="<?php echo $path_url; ?>js/jquery.easyResponsiveTabs.js"></script>



<script type="text/javascript">

	$(document).ready(function(){

		$('#setting').easyResponsiveTabs({ tabidentify: 'vert' });



    	

	  	 function loadstoretable()

	    {

	        $('#store-table').DataTable( {

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

      	$(document).on('click','.row-bar-user',function(){
            dvalue =  $(this).attr('data-view');
            var dataString = ({'principal':dvalue});
      		ajaxType = "GET";
            urlpath = "<?php echo base_url(); ?>getprincipal";
            ajaxfunc(urlpath,dataString,loadTeacherByIdReponseError,loadTeacherByIdResponse);

        });



      	function loadTeacherByIdReponseError(){}

        function loadTeacherByIdResponse(data)
        {
        	if(data != null)
        	{
                $("#user_name").html(data.firstname);
                $("#user_lastname").html(data.lastname);
                $("#teacher_gender").html((data.gender == 1 ? "Male":"Female"));
                $("#teacher_Nic").html(data.nic);
                $("#user_role").html(data.religion);
                $("#email").html(data.email);
                $("#phone").html(data.phone);
                $("#primry_home_address").html(data.primary_home_address);
                $("#secondary_home_address").html(data.primary_secondary_address);
                $("#teacher_province").html(data.state);
                $("#teacher_city").html(data.city);
                $("#teacher_zipcode").html(data.zipcode);
                var str = '';
                for (var i = data.school.length - 1; i >= 0; i--) {
                    str += data.school[i].school+" ("+data.school[i].location+")<br>"
                }

                $("#schools").html(str);
                $("#teacher_zipcode").html(data.zipcode);
                $("#profile_image").prop('width',150);
                $("#profile_image").prop('src','<?php echo base_url(); ?>images/avatar.jpg');
                if(data.image != '')
                {
                    $("#profile_image").prop('width',225);
                    $("#profile_image").prop('src',data.image);
                }
        		
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

            urlpath = "<?php echo $path_url; ?>Principal_controller/removeTeacher";

            var dataString = ({'id':dvalue});

            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);

    	});



        function userDeleteFailureHandler()

        {

 		 	$(".user-message").show();

	    	$(".message-text").text("Teacher has been not deleted").fadeOut(10000);

        }



        function loadUserDeleteResponse(response)

        {

        	if (response.message === true){

                $("#tr_"+dvalue).remove();

     		 	$(".user-message").show();

		    	$(".message-text").text("Teacher has been deleted").fadeOut(10000);

         	}

        }



	});

</script>

<script type="text/javascript">

	var app = angular.module('invantage', []);

</script>
