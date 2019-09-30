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



                <p>Are you sure you want to delete this student?</p>



             </div>



            <div class="modal-footer">



                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>



                <button type="button" id="UserDelete" class="btn btn-default " value="save">Yes</button>



            </div>



        </div>



    </div>



</div>

<!-- <h3 style="padding-left: 40px;">Student Information</h3> -->



<div id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">

                       <div class="panel-heading plheading prflhd" id="widget-header">

                         <h4>Student Information</h4>

                         </div>

                        <!-- <h3 style="padding-left: 40px;">Student Information</h3> -->

                        <ul class="nav nav-tabs">

                            <li class="active"><a data-toggle="tab" href="#home">STUDENT INFORMATION</a></li>

                            <!-- <li><a data-toggle="tab" href="#menu1">STUDENT INFORMATION</a></li> -->
                            <li><a data-toggle="tab" href="#menu2">GUARDIAN INFORMATION</a></li>

                            <li><a data-toggle="tab" href="#menu3">EDUCATION</a></li>

                            <li><a data-toggle="tab" href="#menu4">REFERENCES</a></li>

                        </ul>



                      <div class="tab-content">

                        <div id="home" class="tab-pane fade in active">

                        <div class="row">

                         <div class="col-sm-6 "><a href="#" class="thumbnail">
                            <img class="img-rounded size" src="<?php echo base_url(); ?>images/userdefault.jpg" width="170"></a>

                        </div>
                        <div class="col-sm-6">
                            <table class="table">
                                <tbody>
                      <tr>
                          <td>

                                <th>First Name</th>

                            </td>
                            <td id="screenname"> </td>
                        </tr>
                           <tr>
                          <td>

                                <th>Last Name</th>

                            </td>
                            <td id="slastname"> </td>
                        </tr>
                            <tr>
                            <td>

                                <th>Roll No</th>

                            </td>
                            

                            <td id="info_roll_number"> </td>
                        </tr>
 
                        <tr>
                            <td>

                                <th>DOB</th>

                            </td>

                            <td id="sdob"></td>
                        </tr>
                      <tr>

                            <td>

                                <th>Grade</th>

                            </td>

                            <td id="sgrade"></td>
                        </tr>
                            <tr>
                            <td>

                                <th>Phone</th>

                            </td>

                            <td id="sphone"></td>

                        </tr>
                                </tbody>
                            </table>
                        </div>
                  <table class="table table-striped table-hover">

                    <tbody>
               

                        <tr>
                             <td>

                                <th>Enrollment Date</th>

                            </td>

                            <td id="sdateav"></td>


                             <td>

                                <th>NIC #</th>

                            </td>

                            <td id="snic"></td>
                        </tr>

                        <tr>

                            <td>

                                <th>Student Address</th>

                            </td>

                            <td id="student_address"></td>

                             <td>

                                <th>House/Unit #</th>

                            </td>

                            <td id="shunit"></td>

                        </tr>

                        

                        <tr>

                            <td>

                                <th>Province</th>

                            </td>

                            <td id="info_sprovice"></td>

                            <td>

                                <th>City</th>

                            </td>

                            <td id="info_scity"></td>

                               

                           

                        </tr>

                        

                        <tr>
                                     <td>

                                <th>Financial Assistance</th>

                            </td>

                            <td id="financial_assistance"></td>
                            
                            <td>


                            <th>Post Code</th>

                            </td>

                            <td id="info_spcode"></td>


                            

                        </tr>



                        <tr>
                             <td>

                                <th>Mother Language</th>

                            </td>

                            <td id="smthrlng"></td>

                             <td>

                                <th>Additional Language</th>

                            </td>

                            <td id="saddlang"></td>

                        </tr>

         

                          <tr>



                             <td>

                                <th>Special Circumstances:</th>

                            </td>

                            <td id="circumstances"></td>
                          <!--<td>-->

                          <!--      <th>Email</th>-->

                          <!--  </td>-->

                          <!--  <td id="semail"></td>-->

                        </tr>

                    </tbody>

                </table>

                    

                         </div> 

        

                        </div> 

                        <div id="menu1" class="tab-pane fade">

                            <br>

                          <table class="table table-striped table-hover">


                </table>

                        </div>
                  <div id="menu2" class="tab-pane fade">

                            <br>

                          <table class="table table-striped table-hover">

                    <tbody>

                        <tr>

                              <td>

                                <th>Father Name</th>

                            </td>

                            <td id="father_name"></td>
                             <td>

                                <th>Father NIC#</th>

                            </td>

                            <td id="father_nic"></td>

                        </tr>

                        <tr>
                             <td>

                                <th>Profession</th>

                            </td>

                            <td id="father_profession"></td>

                            <td>

                                <th>Profession Year</th>

                            </td>
                                 <td id="father_years"></td>

                        </tr>

                    

                        <tr>

                             <td>

                                <th>Company</th>

                            </td>

                            <td id="father_company"></td>

                             <td>

                                <th>Monthly Income</th>

                            </td>

                            <td id="monthly_income"></td>



                           

                        </tr>

                        <tr>

                            <td>

                                <th>Work Address</th>

                            </td>

                            <td id="father_work_address"></td>


                              <td>

                                <th>Monthly Income</th>

                            </td>

                            <td id="father_monthly_income_2"></td>



                        </tr>

                    </tbody>

                </table>

                        </div>

                        <div id="menu3" class="tab-pane fade">

                            <br>

                            <table class="table table-striped table-hover">

                    <tbody id="previous_school_info">


                        <tr>

                            <td>

                                <th>Previous School</th>

                            </td>

                            <td id="previous_school_1"></td>

                             <td>

                                <th>Address</th>

                            </td>

                            <td id="school_history_address_1"></td>

                        </tr>                

                         <tr>

                            <td>

                                <th>From</th>

                            </td>

                            <td id="from_1"></td>

                              <td>

                                <th>To</th>

                            </td>

                            <td id="to_1"></td>

                        </tr>

                        <tr>

                            <td>

                                <th>Previous School 2</th>


                            </td>

                            <td id="previous_school_2"></td>

                              <td>

                                <th>Address 2</th>

                            </td>

                            <td id="school_history_address_2"></td>

                        </tr>

                        <tr>

                            <td>

                                <th>From 2</th>

                            </td>

                            <td id="from_2"></td>

                               <td>

                                <th>To 2</th>

                            </td>

                            <td id="to_2"></td>

                        </tr>

                                    

                        <tr>

                            <td>

                                <th>Previous School 3</th>

                            </td>

                            <td id="previous_school_3"></td>

                              <td>

                                <th>Address 3</th>

                            </td>

                            <td id="school_history_address_3"></td>

                        </tr>

                                            

                         <tr>

                            <td>

                                <th>From 3</th>

                            </td>

                            <td id="from_3"></td>

                              <td>

                                <th>To 3</th>

                            </td>

                            <td id="to_3"></td>

                        </tr>

                           </tbody>

                </table>

            

                        </div>

                        <div id="menu4" class="tab-pane fade">

                            <br>

                         <table class="table table-striped table-hover">

                    <tbody id="student_refenecne_info">

                         <tr>

                            <td>

                                <th>Reference Fullname</th>

                            </td>

                            <td id="student_reference_fullname"></td>

                             <td>

                                <th>Relationship</th>

                            </td>

                            <td id="student_reference_relationship"></td>

                        </tr>

                    

                        <tr>

                            <td>

                                <th>Company</th>

                            </td>

                            <td id="student_refernce_company"></td>

                               <td>

                                <th>Phone </th>

                            </td>

                            <td id="student_reference_phone"></td>

                        </tr>

                    

                          <tr>

                            <td>

                                <th>Address</th>

                            </td>

                            <td id="student_reference_adress"></td>

                        </tr>

                        <tr>

                            <td>

                                <th>Reference Fullname2</th>

                            </td>

                            <td id="student_reference_fullname2"></td>

                             <td>

                                <th>Relationship</th>

                            </td>

                            <td id="student_reference_relationship2"></td>

                        </tr>

                         

                        <tr>

                            <td>

                                <th>Company</th>

                            </td>

                            <td id="student_refernce_company2"></td>

                                <td>

                                <th>Phone </th>

                            </td>

                            <td id="student_reference_phone2"></td>

                        </tr>

                    

                          <tr>

                            <td>

                                <th>Address</th>

                            </td>

                            <td id="student_reference_adress2"></td>

                        </tr>

                        <tr>

                            <td>

                                <th>Reference Fullname3</th>

                            </td>

                            <td id="student_reference_fullname3"></td>

                            <td>

                                <th>Relationship</th>

                            </td>

                            <td id="student_reference_relationship3"></td>

                        </tr>

                          

                        <tr>

                            <td>

                                <th>Company</th>

                            </td>

                            <td id="student_refernce_company3"></td>

                               <td>

                                <th>Phone </th>

                            </td>

                            <td id="student_reference_phone3"></td>

                        </tr>

                        

                          <tr>

                            <td>

                                <th>Address</th>

                            </td>

                            <td id="student_reference_adress3"></td>

                        </tr>





                    </tbody>

                </table>

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
<?php 
 $roles = $this->session->userdata('roles');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <label>Student List
        <?php 
           
            if ($roles[0]['role_id'] ==3)        { ?>
               &nbsp;&nbsp;&nbsp;<a href="<?php echo $path_url; ?>savestudent" class="btn btn-primary" style="color: #fff !important;">Add Student</a>
        <?php }?>
        </label>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <table class="table-body table table-bordered table-responsive sfiltr" id="table-body-phase-tow" >
                                    <thead>

                                        <tr>

                                             <th>Roll No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>	
                                            <th>Grade</th>
                                            <th>DOB</th>
                                            <th>Father Name</th>
                                            <th>Father Phone No</th>
      <th>Financial Assistance</th>
                                           <?php if ($roles[0]['role_id'] ==3)  
                                           { ?>

                                            <th>Options</th>

                                            <?php
                                             }?>

                                        </tr>

                                    </thead>

                                    <tfoot>

                                        <tr>
                                             <th>Roll No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>	
                                            <th>Grade</th>
                                            <th>DOB</th>
                                            <th>Father Name</th>
                                            <th>Father Phone No</th>
                                            <th>Financial Assistance</th>

                                           <?php if ($roles[0]['role_id'] ==3)       { ?>

                                            <th>Options</th>

                                            <?php }?>

                                        </tr>

                                    </tfoot>

                                    <tbody id="reporttablebody-phase-two" class="report-body sfiltr ">

                                        <?php $i = 1 ; if(isset($studentlist)){ ?>

                                            <?php foreach ($studentlist as $key => $value) {?>

                                            <tr <?php if($i%2 == 0){echo "class='green-bar row-update'";} else{echo "class='yellow-bar row-update'";} ?> id="tr_<?php echo $value['student_id'] ;?>" data-view="<?php echo $this->encrypt->encode($value->row_slug) ;?>">

                                                 <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo strtoupper($value['roll_number']); ?></td> 

                                                <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo ucwords($value['student_name']); ?></td>

                                                 <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo ucwords($value['slastname']); ?></td>
                                                <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo $value['class']; ?></td>
                                                <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo $value['sdob'] != '' ? $value['sdob']: ''; ?></td> 
                                                 <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo $value['parent_name']; ?></td>
                                                 <td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo $value['sphone']; ?></td> 
<td class="row-bar-user" data-view="<?php echo $value['student_id'] ;?>"><?php echo $value['financial_assistance']; ?></td>
                                                

                                                <?php if ($roles[0]['role_id'] ==3)       { ?>

                                                <td>

                                                    <a href="<?php echo $path_url; ?>savestudent/<?php echo $value['student_id'] ;?>" id="<?php echo $this->encrypt->encode($value['id']) ;?>" class='edit' title="Edit">
                                                          <i class="fa fa-edit" aria-hidden="true"></i>
                                                  
                                                    </a>

                                                    <a href="#" title="Delete" id="<?php echo $value['student_id'] ;?>" class="del">
                                                          <i class="fa fa-remove" aria-hidden="true"></i>

                                                    </a>

                                                </td>

                                                 <?php }?>

                                            </tr>

                                            <?php $i++;} ?>

                                            <?php } else{ echo "<tr><td colspan='8'>No student found</td></tr>";} ?>



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

    var data=null;

	$(document).ready(function(){



		$('#setting').easyResponsiveTabs({ tabidentify: 'vert' });


        $(document).on('click','.row-bar-user',function(){
              $("#myModal").modal('show');
            dvalue =  $(this).attr('data-view');
            
            var dataString = ({'id':dvalue});

            ajaxType = "GET";

            urlpath = "<?php echo $path_url; ?>Principal_controller/GetStudentById";

            ajaxfunc(urlpath,dataString,loadStudentByIdReponseError,loadStudentByIdResponse);



        });







        function loadStudentByIdReponseError(){}



        function loadStudentByIdResponse(data)

        {

            if(data.message == true)

            {   
                  $("#myModal").modal('show');

                $("#roll_number").html(data.roll_number);
                $("#info_roll_number").html(data.roll_number);

                $("#screenname").html(data.screenname);
                $("#info_screen_name").html(data.screenname);
                if(data.profile_link != '')
                {
                    $(".img-rounded").attr('src',data.profile_link);
                }
                
                else{
                     $(".img-rounded").attr('src','<?php echo base_url();?>images/userdefault.jpg');
                }
                 $("#slastname").html(data.slastname);

                $("#student_address").html(data.saddress);

                $("#shunit").html(data.shunit);

                $("#scity").html(data.scity);
                $("#info_scity").html(data.scity);

                $("#sprovice").html(data.sprovice);
                $("#info_sprovice").html(data.sprovice);

                $("#spcode").html(data.spcode);
                $("#info_spcode").html(data.spcode);

                $("#sphone").html(data.sphone);

                // $("#semail").html(data.semail);
                $("#sdob").html(data.sdob);

                $("#sdateav").html(data.sdateav);

                $("#snic").html(data.snic);
                
                $("#smthrlng").html(data.smthrlng);

                $("#saddlang").html(data.saddlang);

                $("#sgrade").html(data.sgrade);

                $("#father_name").html(data.father_name);

                $("#father_nic").html(data.father_nic);

                $("#father_profession").html(data.father_profession);

                $("#father_years").html(data.father_years);

                $("#father_company").html(data.father_company);

                $("#father_comapny_years").html(data.father_comapny_years);

                $("#monthly_income").html(data.monthly_income);

                $("#father_work_address").html(data.father_work_address);

                $("#father_monthly_income_2").html(data.father_monthly_income_2);

                $("#financial_assistance").html(data.financial_assistance);

                $("#circumstances").html(data.circumstances);

                var row = '';
              
                if(data.previous_school_1  && data.school_history_address_1 && data.from_1 && data.to_1)
                {
                      
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Previous School<td>';
                        row += '<td>'+data.previous_school_1+'<td>';
                        row += '<td>Address<td>';
                        row += '<td>'+data.school_history_address_1+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>From<td>';
                        row += '<td>'+data.from_1+'<td>';
                        row += '<td>To<td>';
                        row += '<td>'+data.to_1+'<td>';
                        row += "<tr>";
                }else{
                    row += '<tr><td colspan="4" class="text-center">No data found</td></tr>';
                }

                 if(data.previous_school_2  && data.school_history_address_2 && data.from_2 && data.to_2)
                {
                      
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Previous School<td>';
                        row += '<td>'+data.previous_school_2+'<td>';
                        row += '<td>Address<td>';
                        row += '<td>'+data.school_history_address_2+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>From<td>';
                        row += '<td>'+data.from_2+'<td>';
                        row += '<td>To<td>';
                        row += '<td>'+data.to_2+'<td>';
                        row += "<tr>";
                }else{
                    row += '<tr><td colspan="4" class="text-center">No data found</td></tr>';
                }
                 if(data.previous_school_3  && data.school_history_address_3 && data.from_3 && data.to_3)
                {
                      
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Previous School<td>';
                        row += '<td>'+data.previous_school_3+'<td>';
                        row += '<td>Address<td>';
                        row += '<td>'+data.school_history_address_3+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>From<td>';
                        row += '<td>'+data.from_3+'<td>';
                        row += '<td>To<td>';
                        row += '<td>'+data.to_3+'<td>';
                        row += "<tr>";
                }else{
                    row += '<tr><td colspan="4" class="text-center">No data found</td></tr>';
                }

                $("#previous_school_info").html(row);
              
                var row = '';
               if(data.student_reference_fullname && data.student_reference_relationship && data.student_refernce_company && data.student_reference_phone && data.student_reference_adress)
                {
                      
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Full Name<td>';
                        row += '<td>'+data.student_reference_fullname+'<td>';
                        row += '<td>Relationship<td>';
                        row += '<td>'+data.student_reference_relationship+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Company<td>';
                        row += '<td>'+data.student_refernce_company+'<td>';
                        row += '<td>Phone<td>';
                        row += '<td>'+data.student_reference_phone+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Address<td>';
                        row += '<td>'+data.student_reference_adress+'<td>';
                        row += "<tr>";

                }else{
                    row += '<tr><td colspan="4" class="text-center">No data found</td></tr>';
                }

                 if(data.student_reference_fullname2 && data.student_reference_relationship2 && data.student_refernce_company2 && data.student_reference_phone2 && data.student_reference_adress2)
                {
                      
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Full Name<td>';
                        row += '<td>'+data.student_reference_fullname2+'<td>';
                        row += '<td>Relationship<td>';
                        row += '<td>'+data.student_reference_relationship2+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Company<td>';
                        row += '<td>'+data.student_refernce_company2+'<td>';
                        row += '<td>Phone<td>';
                        row += '<td>'+data.student_reference_phone2+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Address<td>';
                        row += '<td>'+data.student_reference_adress2+'<td>';
                        row += "<tr>";

                }else{
                    row += '<tr><td colspan="4" class="text-center">No data found</td></tr>';
                }
                if(data.student_reference_fullname3 && data.student_reference_relationship3 && data.student_refernce_company3 && data.student_reference_phone3 && data.student_reference_adress3)
                {
                      
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Full Name<td>';
                        row += '<td>'+data.student_reference_fullname3+'<td>';
                        row += '<td>Relationship<td>';
                        row += '<td>'+data.student_reference_relationship3+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Company<td>';
                        row += '<td>'+data.student_refernce_company3+'<td>';
                        row += '<td>Phone<td>';
                        row += '<td>'+data.student_reference_phone3+'<td>';
                        row += "<tr>";
                        row += "<tr>";
                        row += '<td><td>';
                        row += '<td>Address<td>';
                        row += '<td>'+data.student_reference_adress3+'<td>';
                        row += "<tr>";

                }else{
                    row += '<tr><td colspan="4" class="text-center">No data found</td></tr>';
                }
            
                
                $("#student_refenecne_info").html(row);
                //  $("#previous_school_1").html(data.previous_school_1);

                // $("#school_history_address_1").html(data.school_history_address_1);

                // $("#from_1").html(data.from_1);

                // $("#to_1").html(data.to_1);

                // $("#previous_school_2").html(data.previous_school_2);

                // $("#school_history_address_2").html(data.school_history_address_2);

                // $("#from_2").html(data.from_2);

                // $("#to_2").html(data.to_2);

                // $("#previous_school_3").html(data.previous_school_3);

                // $("#school_history_address_3").html(data.school_history_address_3);

                // $("#from_3").html(data.from_3);

                // $("#to_3").html(data.to_3);

                // $("#student_reference_fullname").html(data.student_reference_fullname);

                // $("#student_reference_relationship").html(data.student_reference_relationship);

                // $("#student_refernce_company").html(data.student_refernce_company);

                // $("#student_reference_phone").html(data.student_reference_phone);

                // $("#student_reference_adress").html(data.student_reference_adress);

                // $("#student_reference_fullname2").html(data.student_reference_fullname2);

                // $("#student_reference_relationship2").html(data.student_reference_relationship);

                // $("#student_refernce_company2").html(data.student_refernce_company2);

                // $("#student_reference_phone2").html(data.student_reference_phone2);

                // $("#student_reference_adress2").html(data.student_reference_adress2);

                // $("#student_reference_fullname3").html(data.student_reference_fullname3);

                // $("#student_reference_relationship3").html(data.student_reference_relationship3);

                // $("#student_refernce_company3").html(data.student_refernce_company3);

                // $("#student_reference_phone3").html(data.student_reference_phone3);

                // $("#student_reference_adress3").html(data.student_reference_adress3);

                

                            

                

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



            urlpath = "<?php echo $path_url; ?>Principal_controller/removeStudent";



            var dataString = ({'id':dvalue});



            ajaxfunc(urlpath,dataString,userDeleteFailureHandler,loadUserDeleteResponse);



    	});







        function userDeleteFailureHandler()



        {



 		 	$(".user-message").show();



	    	$(".message-text").text("User has been not deleted").fadeOut(10000);



        }







        function loadUserDeleteResponse(response)



        {



        	if (response.message === true){



                $("#tr_"+dvalue).remove();



     		 	$(".user-message").show();



		    	$(".message-text").text("Student has been deleted").fadeOut(10000);



         	} 



        }



        



	});



</script>



<script type="text/javascript">



	var app = angular.module('invantage', []);



</script>







