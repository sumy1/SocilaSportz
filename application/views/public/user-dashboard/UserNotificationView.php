	<!DOCTYPE html>
	<html>

	<head>
		<title>Social Sportz</title>
		
		
		<?php $this->load->view('public/common/head');?>
		<style>
		.modal-backdrop{opacity: 0.6 !important}
		header{
			background: #000;
		}

		.userdasboard-wrapper
		{
			margin-top:120px;
		}



		.search-area:before{
			content: '';
			width:100%;
			height:109px;
			background:rgba(255,255,255,0.4);
			left:0px;
			top:0px;
			position:absolute;
		}

		.search-wrapper{
			margin-top: 230px;
		}

		.search-area {    background: url(assets/images/footer_bg.jpg);}
		.search-area {
			position:fixed !important;
			margin-bottom: 30px;
			top: 105px;
			height: 105px;
			z-index: 9999999;
		}


	</style>

</head>

<body id="user-notifications">
	<?php $this->load->view('public/common/header');?>
	<!-- // Banner starts Here // -->
	<div class="clearfix"></div>

	
	<section class="userdasboard-wrapper">
		<div class="container">
			<div class="row">

				<div class="col-sm-12">
					<div class="row">
						<div class="col-md-4">

							<div class="sidebar_profile">
								<?php $this->load->view('public/common/usersidebar');?>
							</div>					</div>
							<div class="col-sm-8">
								<h1>Notifications</h1>
								<div class="col-md-12">

									<div class="notification_list">
										<ul class="list-unstyled">
											<?php foreach($recent_activity as $activities){ ?>
												 <li class="media active">
													
														<div class="media-body">
															<small class="float-right"><?=date('d-m-Y',strtotime($activities->activity_time));?> (<?  echo date("h:i:a",strtotime($activities->activity_time));?>)</small>
															<a href="<?php echo base_url($activities->url); ?>"><h5 class="title mt-0 mb-1"><?=$activities->description;?>
																<p class="decs"></p>
															</h5></a></div>
															<div class="ripple-container"></div>
													</li>
											  <?php } ?>


														</ul></div>

													</div>								


												</div>
											</div>
										</section>
										
										
									  <div class="loader">
											<div class="">
												<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
											</div>
										</div>

										<?php $this->load->view('public/common/footer');?>

										<?php $this->load->view('public/common/foot');?>
									</body>


									<script>
										jQuery('header').removeClass("blackbg");
										$(window).scroll(function() {
		if ($(this).scrollTop() > 100) { // this refers to window
			jQuery('header').addClass("blackbg");
		}

		else
		{
			jQuery('header').removeClass("blackbg");
		}
	});



</script>



</html>