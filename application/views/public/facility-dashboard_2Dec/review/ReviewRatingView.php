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
	</style>
</head>
<body class="dashboard sidebar-is-expanded" id="reviewrapper">
	<!-- <div class="loader loader-curtain is-active" data-brazilian data-curtain-text="Loading..."></div> -->
	<div class="markethub__container">
		<?php $this->load->view('public/common/dashboard-sidebar');?>
		<main class="l-main">
		<div class="main_m8place__container">
			<div class="header-data">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="top-head-nav clearfix">
								<div class="page-title float-md-left">
									<h2>Review Summary</h2>
								</div>
								<div class="navigation-bread float-md-right">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">	
											<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">My Dashboard</a></li>	
											<li class="breadcrumb-item active" aria-current="page">Review Summary</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="data-container-all mt-2">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="main_container_dashboard">
								<div class="row">
									<div class="col-md-6">
										<div class="stats">
											<ul class="list-inline" id="review_count">
												
												
											</ul>
										</div>
									</div>
									<div class="col-md-6">
										<ul class="list-inline top_btns_action">
										
									</ul>
								</div>
							</div>

							<div class="filter_prodcuts" style="display: none;">
								
									</ul>
								</div>		
								<hr style="opacity: 0">
								<div class="show_datatable">
									<nav class="tab_menu" style="border: none !important;">
										<div class="nav nav-tabs" id="nav-tab" role="tablist">
											<a class="nav-item nav-link review_btn active" id="overall-tab" data-toggle="tab" href="#overall" role="tab" aria-controls="overall" aria-selected="true"><input type="hidden" class="selct_btn" value="overall">Overall</a>
											<a class="nav-item nav-link review_btn" id="thisWeek-tab" data-toggle="tab" href="#thisWeek" role="tab" aria-controls="thisWeek" aria-selected="false"><input type="hidden" class="selct_btn" value="month">This Month</a>
											<a class="nav-item nav-link review_btn" id="thisMonth-tab" data-toggle="tab" href="#thisMonth" role="tab" aria-controls="thisMonth" aria-selected="false"><input type="hidden" class="selct_btn" value="week">This Week</a>
										</div>
									</nav>
									<div class="tab-content" id="nav-tabContent">
										<div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="overall-tab">
											<div class="row">
												<div class="col-md-8">
												<ul class="list-unstyled review_list" id="revie_add_list">
												
												</ul>
										
										<div class="row">
												<div class="col-md-12 text-center">
													<a href="javascript:void(0);" class="btn btn-raised btn-sm save_btn view_more" id="">View More</a>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div id="rating_div"></div>
										</div>
									</div>
									</div>
				
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        </main>
		
<div class="loader">
		<div class="">
		  <span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
		</div>
</div>
		<!-- Footer Include Here -->
			<?php $this->load->view('public/common/footer');?>
	</div>

	<?php $this->load->view('public/common/foot');?>

</body>
</html>
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
	
		//$('.datepicker').dateDropper()
/* For Default Review list show here by */
var review_of = 'overall';
var total_review_show = 2;
		$(document).ready(function(){ 
			setTimeout(function(){
			var fac_id =$("#headeracademyfacility option:selected" ).val();
			//var review_of = $(this).find('.selct_btn').val();
			if(fac_id!='' && review_of!=''){
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>facility/review/ajax_review_list',    
				data: {fac_id:fac_id,review_of:review_of,total_review_show:total_review_show},
				success:function(res){
					$("#revie_add_list").html(res['_html']);
					  }              
				});

				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>facility/review/review_count',    
				data: {fac_id:fac_id},
				success:function(res){
					$("#review_count").html(res['_html']);
					  }              
				});


				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>facility/review/rating',    
				data: {fac_id:fac_id},
				success:function(res){
					$("#rating_div").html(res['_html']);
					  }              
				});

			}
			},700);
	});


/* After button click Review list show here by */
	$(document).ready(function(){ 
		$('.review_btn').click(function() { 
			var fac_id =$("#headeracademyfacility option:selected" ).val();
			review_of = $(this).find('.selct_btn').val();
			total_review_show = 2;
			if(fac_id!='' && review_of!=''){
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>facility/review/ajax_review_list',    
				data: {fac_id:fac_id,review_of:review_of,total_review_show:total_review_show},
				success:function(res){
					$("#revie_add_list").html(res['_html']);
					  }              
				});
			}
			
		});
	});

	/* click on View More Button here showing list */
	$(document).ready(function(){ 
		$('.view_more').click(function() { 
			fac_id =$("#headeracademyfacility option:selected" ).val();
			total_review_show = total_review_show+2;
			if(fac_id!='' && review_of!=''){
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>facility/review/ajax_review_list',    
				data: {fac_id:fac_id,review_of:review_of,total_review_show:total_review_show},
				success:function(res){
						$("#revie_add_list").html(res['_html']);
					}              
				});
			}
			
		});
	});
	
	

</script>