	<!DOCTYPE html>
	<html>

	<head>
		<title>Social Sportz</title>
		<link rel="shortcut icon" type="image/png" href="favicon.png" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
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

   .icone.loaction
   {
   	display: block;
   }

	</style>
		<link rel="stylesheet" href="assets/css/datedropper.min.css">

	</head>

	<body id="user-booking">
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
	<h1>My Favourite</h1>

	<div class="profile_tab_container">
										<ul class="list-unstyled list_items_dashboard">
										<?php if(!empty($favourate_listing)){?>
										<ul class="list-unstyled list_items_dashboard">
										<div class="col-md-12 text-right">
													<a href="javascript:void(0);" class="btn orange-btn btn-raised btn-sm save_btn remove_favourite_all" id=""><input type="hidden" class="favourite_id" value="">Remove All</a>
												</div>
									<?php }else{ ?><?php }?>
												
										
										<?php
									 if(isset($favourate_listing) && !empty($favourate_listing)){foreach($favourate_listing as $favourateKey=>$favourateVal){
									?>
											<li>
												<div class="booking_data clearfix">
													<div class="img_item">
														<a href="<?=base_url('searchlisting/search_detail/'.$favourate_listing[$favourateKey]->facility_name->fac_slug);?>">
														<img src="<?=base_url('assets/public/images/fac/'.$favourate_listing[$favourateKey]->facility_name->fac_banner_image)  ?>" class="img-fluid" alt=""></a>
													</div>
													<div class="item_data">
														<div class="col-sm-12 nopadleft">
														<a href="<?=base_url('searchlisting/search_detail/'.$favourate_listing[$favourateKey]->facility_name->fac_slug);?>"><?php echo $favourate_listing[$favourateKey]->facility_name->fac_name; ?></a>
													    </div>
														<span class="icone loaction"><i class="fa fa-map-marker"></i> <?php echo $favourate_listing[$favourateKey]->facility_name->fac_city; ?></span>
														<div class="row">
												<div class="col-md-12 text-right">
													<a href="javascript:void(0);" class="btn orange-btn btn-raised btn-sm save_btn remove_favourite" id=""><input type="hidden" class="favourite_id favourite_ids" value="<?=$favourateVal->favourite_id;?>">Remove</a>
												</div>
											</div> 
														
													</div>
												</div>
												
											</li>
											
                                 <?php } } else{ ?>
								 <span>No Favourite yet</span>
								 <?php } ?>
                                       
		

										</ul>
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
		<script src="assets/js/datedropper.min.js"></script>

		<script>
		$(document).on("click",'.remove_favourite_all',function(){
			         var favourite_ids=[];
					  $(".favourite_ids").each(function() {
					  favourite_ids.push($(this).val());
					  // alert(favourite_ids);
					 });
					 swal({
						title: 'Are you sure you want to delete?',
						text: "You won't be able to revert this!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#d33',
						cancelButtonColor: '#3085d6',
						confirmButtonText: 'Delete'
						}).then((result) => {
							if (result.value) {
								  $.ajax({
										type: "POST",
										url:'<?php echo base_url();?>dashboard/favouritedelete',          
										data: {favourite_ids:favourite_ids},
										success:function(res){
											 if(res!="fail"){
												swal({
													title : 'All favourite  deleted successfully',
													html : '',
													type: 'success'
													}).then((result) => {
													if (result.value) {
                                                        window.location.href = '<?php echo base_url('dashboard/user_favourite') ?>';
													  
													  }
													   })
				   
				   
                                              }else{
												swal("Done!","Sorry some problem occurred","success");
												}
										}
								  })
					  		}
                       })
		});
		
		
		$(document).on('click','.remove_favourite',function(){
			let favourite_id=$(this).find('.favourite_id').val();
			        swal({
						title: 'Are you sure you want to delete?',
						text: "You won't be able to revert this!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#d33',
						cancelButtonColor: '#3085d6',
						confirmButtonText: 'Delete'
						}).then((result) => {
							if (result.value) {
								$.ajax({
									 type: "POST",
									 url : "<?=base_url();?>dashboard/user_favourite",
									 data: {favourite_id:favourite_id},
									 success: function(res){
										 if(res!= 1){
												swal({
													title : 'All favourite  deleted successfully',
													html : '',
													type: 'success'
													}).then((result) => {
														if (result.value) {
															window.location.href = '<?php echo base_url('dashboard/user_favourite') ?>';
														  }
													   })			   
				                                  }else{
												swal("Done!","Sorry some problem occurred","success");
												}
									}
								  })
					  		 }
						  })
			
		});
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

	jQuery(".togglefilter").on("click", function(){jQuery("#gorupedfilter").slideToggle(); jQuery(".darkoverlay").toggle(); });
	jQuery(".darkoverlay, #applyfilter").on("click", function(){jQuery("#gorupedfilter").slideUp(); jQuery(".darkoverlay").hide(); });
	jQuery(".searchsportsname li").on("click", function(){jQuery('.sportsname').find("input").attr("checked", false); jQuery(this).find("input").attr("checked", "checked"); jQuery('.sportsname').find("label").removeClass("activegame"); jQuery(this).find("label").addClass("activegame")});
		$('#Datesearch').dateDropper();

	</script>

	<script>
		$('.calanderpopover').popover({			
				content: '<div class="table-responsive"><table class="table table-sm timimg-table"><tbody><tr><td>Monday</td><td>11am – 11pm</td></tr><tr><td>Tueday</td><td>11am – 11pm</td></tr><tr><td>Wednesday</td><td>11am – 11pm</td></tr><tr class="bold"><td>Thursday</td><td>11am – 11pm</td></tr><tr><td>Friday</td><td>11am – 11pm</td></tr><tr><td>Saturday</td><td>11am – 11pm</td></tr><tr><td>Sunday</td><td class="text-danger text-center">Closed</td></tr></tbody></table></div>', 
				html: true, 
				placement: "bottom",
				trigger: "hover"
			});
	</script>

	</html>