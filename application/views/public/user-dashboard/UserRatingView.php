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

<body>
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
								<h1>Review & Ratings</h1>

								<ul class="list-unstyled review_list">
								
								
								
								<?php
								 if(isset($get_rating_data) && !empty($get_rating_data)){
								 	foreach($get_rating_data as $ratingkey=>$ratingval){ 
								
								?>
									<li class="media reviews_data_list">
										<div class="media-body user_info">
											<div class="row align-items-center">
											
												<div class="col-md-12">
													<div class="row">
												  <?php if(!empty($get_rating_data[$ratingkey]->user_profile->user_profile_image)){?>
												  
													 
													 <!--<a href="<?=base_url('searchlisting/search_detail/'.$get_rating_data[$ratingkey]->facility_name[0]->fac_slug);?>">-->
													 <img class="col-sm-2  useyr_img img-fluid rounded-circle" src="<?=base_url('assets/public/images/user/'.$get_rating_data[$ratingkey]->user_profile->user_profile_image);?>" alt="User Image"> 
													 </a>
													<?php } else{?>
													   <img class="col-sm-2  useyr_img img-fluid rounded-circle" src="<?=base_url('assets/public/images/user-dummy-pic.png');?>" alt="User Image">
												   <?php }?>	
														<div class="col-sm-6">
															<a href="<?=base_url('searchlisting/search_detail/'.$get_rating_data[$ratingkey]->facility_name[0]->fac_slug);?>">
															<h2 style="    font-size: 16px;
															color: #ec4610;" class="mt-0 mb-0 user_name clearfix">
															<?php echo $get_rating_data[$ratingkey]->facility_name[0]->fac_name; ?></h2>
															</a>	
															<!-- <h5 class="mt-0 mb-0 user_name clearfix"><?=$ratingval->user_name; ?><br>
																</span>
															</h5> -->																											<div class="rating_container">
														<ul class="list-inline">
															
																
																 <li class="list-inline-item <?php if($ratingval->rating >0) echo "active"  ?>"><i class="fa fa-star"></i></li>
										                      <li class="list-inline-item <?php if($ratingval->rating >1) echo "active"  ?>"><i class="fa fa-star"></i></li>
										                      <li class="list-inline-item <?php if($ratingval->rating >2) echo "active"  ?>"><i class="fa fa-star"></i></li>
										                      <li class="list-inline-item <?php if($ratingval->rating >3) echo "active"  ?>"><i class="fa fa-star"></i></li>
										                      <li class="list-inline-item <?php if($ratingval->rating >4) echo "active"  ?>"><i class="fa fa-star"></i></li>
														</ul>
														<p class="user_comment"><?php echo @$get_rating_data[$ratingkey]->review_message[0]->review_message; ?></p>
													</div>
														</div>
														
														<div class="col-sm-3 text-right">
															<?php echo date('d-M-Y',strtotime($ratingval->created_on));?>
															<a class="btn btn-info orange-btn review_btns" style="text-transform: inherit; margin-top: 15px;" data-toggle="modal" data-target="#addReviews"><input type="hidden" name="rating_user_id"  class="rating_user_id" value="<?=$ratingval->rating_id;?>"><input type="hidden" name="fac_name" class="fac_names" value="<?=$get_rating_data[$ratingkey]->facility_name[0]->fac_name;?>">Edit Review</a>
														</div>
													</div>
													
													
													

													
												</div>
												
											</div>
										</div>
										
									</li>
									<?php } } else { ?>
								 <span>No review yet</span>
								 <?php } ?>
								   	</ul>
                                    <input type="hidden"  id="" class="Count_ratings" value="<?=$count_rating;?>">
									<div class="row"> 
									 <?php if($count_rating>5){ ?>
												<div class="col-md-12 text-center">
													<a href="javascript:void(0);" class="btn orange-btn btn-raised btn-sm save_btn view_mores" id="rating_view_hidden"><input type="hidden" class="user_id" value="<?=$this->session->userdata['user_id'];?>">View More</a>
												</div>
											</div>	
									 <?php } ?>											
 								


							</div>
						</div>
					</section>
<div class="modal fade requestModal edit_profile_modal" id="addReviews">
	<form>
	
    <div class="modal-dialog modal-dialog-centered modal-md">
     <div id="user_rating_view">
	 
	 
	 </div>
  </div>
</form>
</div>

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
<script>
  $(document).on('click','.review_btns',function(){
	 var rating_user_id= $(this).find('.rating_user_id').val();
	 var fac_names= $(this).find('.fac_names').val();
	 $.ajax({
		  type: "POST",
		  url : "<?=base_url('dashboard/user_rating_edit')?>",
		  data : {rating_user_id:rating_user_id,fac_names:fac_names},
		   success: function(res) {
             $("#user_rating_view").html(res['_html']);
    }
		  
	 });
	  
  });
var count_ratingss =$('.Count_ratings').val();
var total_review_show = 5;
$(document).on("click",'.view_mores',function(){
	var user_id= $(this).find('.user_id').val();
	total_review_show = total_review_show+5;
	if(user_id!='' && total_review_show!=''){
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>dashboard/user_rating',    
				data: {user_id:user_id,total_review_show:total_review_show},
				success:function(res){
					   if(total_review_show>=count_ratingss){
						 document.getElementById('rating_view_hidden').style.visibility = 'hidden';
					  }
					$(".review_list").html(res['_html']);

					  }              
				});
			}
	
	
	 
});
</script>


</html>