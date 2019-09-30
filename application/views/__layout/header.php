<?php
	if($this->uri->segment(3)){
		$path_url =  '../../../';
  		$uri = '../../../';
	}
	else if($this->uri->segment(2)){
		$path_url =  '../';
  		$uri = '../';
	}
	else{
  		$path_url =  '';
  		$uri = '';
  	}	
?>
<!DOCTYPE html>
<html ng-app="invantage">
<head>
	<title>SHAMA Central</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.ui.timepicker.css?v=0.3.3">
	<link rel="stylesheet" href="<?php echo base_url(); ?>js/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css" type="text/css" />
	<!-- Jquery Date picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-confirm.min.css">
  
	<script src="<?php echo base_url(); ?>js/31dc09d75d.js"></script>
	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/fontello.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>css/bootstrap.css" /> -->
	<!-- Optional theme -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,700,500italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/angular-datatables.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/nbootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/daterangepicker.css" />
	
	<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
	
	<script src="<?php echo base_url(); ?>js/angular.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/insight.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/cjquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/left_side.css">

	<script type="text/javascript" src="<?php echo base_url(); ?>js/moment.js"></script>

<!---Lessssssssssssson plaaaaaaaaan table start-->
<!-- <script data-jsfiddle="common" src="js/excel/demo/js/jquery.min.js"></script>

  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="js/excel/dist/handsontable.css">
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="js/excel/dist/pikaday/pikaday.css">
  <script data-jsfiddle="common" src="js/excel/dist/pikaday/pikaday.js"></script>
  <script data-jsfiddle="common" src="js/excel/dist/moment/moment.js"></script>
  <script data-jsfiddle="common" src="js/excel/dist/zeroclipboard/ZeroClipboard.js"></script>
  <script data-jsfiddle="common" src="js/excel/dist/numbro/numbro.js"></script>
  <script data-jsfiddle="common" src="js/excel/dist/numbro/languages.js"></script>
  <script data-jsfiddle="common" src="js/excel/dist/handsontable.js"></script>

 
  
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="js/excel/demo/css/samples.css?20140331">
 
  <link rel="stylesheet" media="screen" href="js/excel/demo/js/highlight/styles/github.css">
  <link rel="stylesheet" href="js/excel/demo/css/font-awesome/css/font-awesome.min.css">
<!---Lessssssssssssson plaaaaaaaaan table end--> 

	<script type="text/javascript">
		function getUrlVars(){
	    	var vars = [], hash;
		    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		    for(var i = 0; i < hashes.length; i++)
		    {
		        hash = hashes[i].split('=');
		        vars.push(hash[0]);
		        vars[hash[0]] = hash[1];
		    }
		   	return vars;		
		}
		$(window).load(function() {
			// Animate loader off screen
			$(".se-pre-con").fadeOut("slow");;
			$(".loader-container").fadeOut();

		});
		
	</script>
<style>

/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
  background-image: url(./images/spin.png) no-repeat;

}
</style>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      /*background-color: #f1f1f1;*/
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
  <style>
  /*
	.semester-lesson-plan-widget table.htCore tr td:nth-child(9), .semester-lesson-plan-widget table.htCore tr th:nth-child(9) {
    	display:none;
	 }


.dplan-widget table.htCore tr td:nth-child(9), .dplan-widget table.htCore tr th:nth-child(9) {
    	display:none;
	 }
*/



	 .semester-lesson-plan-widget table thead th {
  white-space: pre-line;
  max-width: /* enter here your max header width */
}

/*	#result_container table.htCore tr td:nth-child(2), #result_container table.htCore tr th:nth-child(2) {
    	display:none;
	}

	#result_container table.htCore tr td:nth-child(3), #result_container table.htCore tr th:nth-child(3) {
    	display:none;
	}*/

</style>
<?php if ($this->session->userdata('type')=='p')        { ?>
<style type="text/css">
.dataTable tfoot tr th:last-child select {
    display: none;
}
</style>

<!-- First Turn Plugin start -->

        <!-- CSS -->
       <!--  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css"> -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
<!--         <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-57-precomposed.png"> -->




<?php }?>
</head>
<body>
<div class="se-pre-con"></div>
<!-- wrapper -->
<div class="container-fluid">
	<!-- main-content -->
	<div class="row content">
