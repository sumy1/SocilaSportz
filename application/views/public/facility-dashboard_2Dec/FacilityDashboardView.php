<!DOCTYPE html>
<html>
<head>
	<title>Social Sportz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<!-- Fonts For Heading & SubHeadings -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	
	<?php $this->load->view('public/common/head');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css')?>">
	<style>
	.single-event .event-img{
		position: relative;
	}
	.single-event .event-img::after{
		content: "";
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		display: inline-block;
		background: linear-gradient(to bottom,rgba(221,221,221,0) 0,rgba(0, 0, 0, 0.54) 100%);
		z-index: 1;
	}
	.event-cont{
		z-index: 2;
	}
	#chartdiv
	{
		width:100%;
		height:300px;
	}
	
	#slotbookingtime.modal.fade .modal-dialog {
		transition: transform .3s ease-out !important;
		transform: translateY(0%) !important;
		-webkit-transform: translateY(0%) !important;
		top: 0% !important;
	}

	#dashboard_ajax_view a.toggle{cursor:default;}
</style>
</head>


<body class="dashboard sidebar-is-expanded">
	<div class="clearfix"></div>
	<?php $this->load->view('public/common/dashboard-sidebar');?>



	<main class="l-main">
		<div class="content-wrapper content-wrapper--with-bg" style="margin-top:-30px;">
			
			<!-- Breadcrumb Start Here -->
			<div class="header-data">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="top-head-nav clearfix">
								<div class="page-title float-left">
									<h1 style="font-size: 18px;">Welcome to Social Sportz</h1>
								</div>
								<div class="navigation-bread float-right">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">	
											<li class="breadcrumb-item active" aria-current="page" style="color: #000">My Dashboard</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="loader">
									<div class="">
										<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
									</div>
								</div>
			<div class="container">
			
			<!--  Breadcrumb End Here -->	
			
			<div class="container">

				<div id="dashboard_ajax_view"></div>
			</div>
		</main>
		



		<!-- Footer Include Here -->
		<?php $this->load->view('public/common/footer');?>

		<?php $this->load->view('public/common/foot');?>



		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>
		<script src="<?=base_url('assets/public/js/datedropper.min.js')?>"></script>
		<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>


								
<script>


	$('[data-toggle="tooltip"]').tooltip(); 
</script>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script>
	
	
	$( ".time" ).timeDropper({
			setCurrentTime: false
		});
	$(window).on('load',function() {
	$(".loader").fadeOut('slow');
	});

	function showingLoader(){
	$(".loader").fadeIn(200);
	//$(".loader").fadeOut(1000);
	}
	function hiddingLoader(){
	//$(".loader").fadeIn(200);
	$(".loader").fadeOut(1000);
	}




$(document).ready(function(){
setTimeout(function(){
var fac_id =$("#headeracademyfacility option:selected" ).val();
action='dashboard_ajax_view';
$.ajax({
type: "POST",
    //async: true,
    url:'<?php echo base_url();?>dashboard/dashboard_ajax_view',    
    data: {fac_id:fac_id,action:action},
    success:function(res){
       $("#dashboard_ajax_view").html(res['_html']);
    }              
    });
    },700);
    });





</script>
</body>
</html>	