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

                <p>Are you sure you want to delete this teacher?</p>

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
               <div class="panel-heading plheading prflhd" id="widget-header">
                         <h4>Teacher Profile</h4>
                 </div>

                    <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">TEACHER INFORMATION</a></li>
                           <!--  <li><a data-toggle="tab" href="#menu2">TEACHER INFORMATION</a></li> -->
            
                        </ul>
                        <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                    <div class="col-md-12"> 
                         <div class="col-md-6 border">
                          
                          <a href="#" class="thumbnail">
                         <img class="img-rounded size" width="170" src=""></a>
                      
                          
                        </div>
                       <div class="col-md-6">
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
                            <td id="email_get"></td>
                        </tr>
                        <tr>
                            <td>
                                <th>Phone</th>
                            </td>
                            <td id="teacher_phone"></td>
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
                            <td>
                                <th>Gender</th>
                            </td>
                            <td id="teacher_gender"></td>
                            
                        </tr>
                        <tr>
                            <td>
                                <th>NIC #</th>
                            </td>
                            <td id="teacher_Nic"></td>
                        </tr>
                        
                         <tr>
                            <td>
                                <th>Primary Home Address</th>
                            </td>
                            <td id="primry_home_address"></td>
                        </tr>
                         <tr>
                            <td>
                                <th>Secondary Home Address</th>
                            </td>
                            <td id="secondary_home_address"></td>
                        </tr>
                        <tr>
                            <td>
                                <th>Province</th>
                            </td>
                            <td id="teacher_province"></td>
                        </tr>
                         <tr>
                            <td>
                                <th>Zipcode</th>
                            </td>
                            <td id="teacher_zipcode"></td>
                        </tr>
                    </tbody>
                </table>

                        </div>

                        <div id="menu2" class="tab-pane fade">
                            <br>
<!--                             <table class="table table-striped table-hover">
                       <tbody>
                        <tr>
                            <td>
                                <th>City:</th>
                            </td>
                            <td id="teacher_city"></td>
                        </tr>
                        <tr>
                            <td>
                                <th>Gender</th>
                            </td>
                            <td id="teacher_gender"></td>
                            
                        </tr>
                        <tr>
                            <td>
                                <th>NIC #</th>
                            </td>
                            <td id="teacher_Nic"></td>
                        </tr>
                       
                         <tr>
                            <td>
                                <th>Phone</th>
                            </td>
                            <td id="teacher_phone"></td>
                        </tr>
                        
                         <tr>
                            <td>
                                <th>Primary Home Address</th>
                            </td>
                            <td id="primry_home_address"></td>
                        </tr>
                         <tr>
                            <td>
                                <th>Secondary Home Address</th>
                            </td>
                            <td id="secondary_home_address"></td>
                        </tr>
                        <tr>
                            <td>
                                <th>Province</th>
                            </td>
                            <td id="teacher_province"></td>
                        </tr>
                         <tr>
                            <td>
                                <th>Zipcode</th>
                            </td>
                            <td id="teacher_zipcode"></td>
                        </tr>
                    </tbody>
                </table> -->
            </div>

                        </div>

                
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
      <label>Teacher List
        &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>add_teacher" class="btn btn-primary" style="color: #fff !important;">Add Teacher</a>
      </label>
    </div>
    <div class="panel-body">
          <table class="table-body table-bordered tfltr" id="table-body-phase-tow" >
                              <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone No </th>
                                        <th>Options</th>
                                </tr>
                            </tfoot>
                              <tbody id="reporttablebody-phase-two" class="report-body">
                                <?php $i = 1 ; if(isset($teacherlist)){ ?>
                                      <?php foreach ($teacherlist as $key => $value) {?>
                                      <tr <?php if($i%2 == 0){echo "class='green-bar row-update'";} else{echo "class='yellow-bar row-update'";} ?> id="tr_<?php echo $value['teacher_id'] ;?>">
                                          <td class="row-bar-user" data-view="<?php echo $value['teacher_id'] ;?>"><?php echo ucwords($value['teacher_firstname']); ?></td>
                                          <td class="row-bar-user" data-view="<?php echo $value['teacher_id'] ;?>"><?php echo ucwords($value['teacher_lastname']); ?></td>
                                          <td class="row-bar-user" data-view="<?php echo $value['teacher_id'] ;?>"><?php echo $value['email']; ?></td>
                                          <td class="row-bar-user" data-view="<?php echo $value['teacher_id'] ;?>"><?php echo $value['teacher_phone']; ?></td>
                                          <td>
                                              <a href="<?php echo $path_url; ?>add_teacher/<?php echo $value['teacher_id'] ;?>" id="<?php echo $this->encrypt->encode($value['id']) ;?>" class='edit' title="Edit">
                                                  <i class="fa fa-edit" aria-hidden="true"></i>
                                              </a>
                                              <a href="#" title="Delete" id="<?php echo $value['teacher_id'] ;?>" class="del">
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



    	getStoreList();

	    /**

	     * ---------------------------------------------------------

	     *   Store list

	     * ---------------------------------------------------------

	     */

	    function getStoreList () {

    	 	var dataString = "";

	      	ajaxType = "GET";

	      	var dataString = ({"storenum":"all"});

	  		urlpath = "<?php echo $path_url; ?>api/getStores/format/json";

	     	ajaxfunc(urlpath,dataString,errorhandler,getStoreListReponse); 

	  	}



	  	function getStoreListReponse (response) {

	   		dataLength = response.length -1;

	   		var cont_str = '';

	   		$("#store-list").html();

	   		for (var i = 0;  i <= dataLength ; i++) {

	   			var rowclass = "odd";

	   			if(i%2 == 0){

	   				rowclass = "even";

	   			}

	   			cont_str += "<tr class='"+rowclass+"'>";

	   			cont_str += "<td>"+response[i].storenum+"</td>"

	   			cont_str += "<td>"+response[i].name+"</td>"

	   			cont_str += "<td>"+response[i].location+"</td>"

	   			cont_str += "<td>"

	   			cont_str += '<a href="<?php echo $path_url; ?>add_teacher/'+response[i].storenum+'" class="edit" title="Edit">'

            	cont_str +=	'<span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>'

            	cont_str +=	'</a>'

	   			cont_str += '</td>'

	   			cont_str += "</tr>";

            }

            $("#store-list").html(cont_str);

            loadstoretable();

	  	}

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
            var dataString = ({'id':dvalue});
      		ajaxType = "GET";
            urlpath = "<?php echo $path_url; ?>Principal_controller/GetTeacherById";
            ajaxfunc(urlpath,dataString,loadTeacherByIdReponseError,loadTeacherByIdResponse);

        });



      	function loadTeacherByIdReponseError(){}

        function loadTeacherByIdResponse(data)
        {
        	if(data.message == true)
        	{
        		$("#user_name").html(data.teacher_firstname);
        		$("#user_lastname").html(data.teacher_lastname);
                $(".img-rounded").attr('src',data.profile_link);
                 $("#email_get").text(data.email_get);
              
        		$("#teacher_gender").html((data.gender == 1 ? 'Male':'Female'));
        		$("#teacher_Nic").html(data.nic);
        		$("#teacher_phone").html(data.phone);

        			$("#primry_home_address").html(data.primary_address);
        				$("#secondary_home_address").html(data.secondary_address);
        					$("#teacher_province").html(data.province);
        					$("#teacher_zipcode").html(data.teacher_zipcode);
                  $("#teacher_city").html(data.city);
        					
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



