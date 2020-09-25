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



	.varified
{
color: green;
font-size: 18px;
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
<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css');?>">

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

							</div>
						</div>
						<div class="col-md-8 pl-md-0">
							<div class="information_details p-0">
								<div class="top_prfile_info bg_light">
									<div class="row justify-content-center">
										<div class="col-md-12 clearfix">
											<h1>Dashboard</h1>
											<div class="profile_pic">
											
												<?php if($user_info->user_profile_image!=''){
													   
													  ?>
												<div class="image" style="background: url('<?=base_url('assets/public/images/user/'.$user_info->user_profile_image);?>')"></div><?php } else{?>
												<div class="image" style="background-image: url(<?=base_url('assets/public/images/user-dummy-pic.png');?>)"></div>
												<?php } ?>
												
											</div>
											<div class="profile_info">
												<h3 class="user_name"><?=$this->session->userdata('user_name')?></h3>
												<p class="other_info email">
													<i class="fa fa-envelope mr-1" aria-hidden="true"></i>
													 <?=$this->session->userdata('user_email')?>
													 <?php if($user_info->is_email_verified=='yes'){ ?>
												 <i class="fa fa-check-circle varified"></i>
												 <?php } else{ ?>
												 <span class="red">: <a class="email_re_verification" href="javascript:void(0)">Not Verified</a></span>
												<?php  } ?>
												</p>
												<p class="other_info mobile"><i class="fa fa-phone-square mr-1" aria-hidden="true"></i> <?=$this->session->userdata('user_mobile_no')?> <i class="fa fa-check-circle varified"></i> </p>
											</div>
										</div>
										
									</div>
								</div>

								<div class="top_stat">
									<ul class="list-inline">
										<li class="list-inline-item">
											<a href="<?=base_url('dashboard/user_booking');?>">
												<div class="info_stat">
													<h3 class="num"><?=$slot_booking_count;?></h3>
													<p class="title_label">My Bookings</p>
												</div>
											</a>
										</li>
										<li class="list-inline-item">
											<a href="<?=base_url('dashboard/user_booking/event');?>">
												<div class="info_stat">
													<h3 class="num"><?=$event_booking_count?></h3>
													<p class="title_label">Event Bookings</p>
												</div>
											</a>
										</li>
										<li class="list-inline-item">
											<a href="<?=base_url('dashboard/user_query');?>">
												<div class="info_stat">
													<h3 class="num"><?=$query_count;?></h3>
													<p class="title_label">My Enquiry</p>
												</div>
											</a>
										</li>
										<li class="list-inline-item">
											<a href="<?=base_url('dashboard/user_notification');?>">
												<div class="info_stat">
													<h3 class="num"><?=$activity_count;?></h3>
													<p class="title_label">Notifications</p>
												</div>
											</a>
										</li>

										<li class="list-inline-item">
											<a href="<?=base_url('dashboard/user_rating');?>">
												<div class="info_stat">
													<h3 class="num"><?=$rating_count?></h3>
													<p class="title_label">My Review</p>
												</div>
											</a>
										</li>

									</ul>
								</div>

								<div class="profile_activities">
									<div class="row">
										<div class="col-md-12">
											<div class="title_header">
												<h2 class="title">Recent Activities</h2>
												<div class="recent_activity_container">
													<ul class="list-unstyled">

														<?php if(isset($recent_activity) && !empty($recent_activity)){
															
															
															foreach ($recent_activity as $activities) {
																 // echo "<pre>";
																 // print_r($activities);
															 ?>	
														<li>
															<a href="#">
																<div class="single_activity">

																	<div class="content_activity">
																	 <a href="<?=base_url($activities->url);?>"><?=$activities->description;?>
																	    </a>
																	
																	
																		<?php foreach ($activities->activity_name as $activity_title) { ?>
																		<h5 class="title_activity"><?=$activity_title->activity_name;?></h5>
																		
																		<?php } ?>
																		<span class="date" style="display:inline-block;float:right;clear:both;"><?=date('d-m-Y',strtotime($activities->activity_time));?> (<?  echo date("h:i:a",strtotime($activities->activity_time));?>)</span>
																	</div>
																</div>
															</a>
														</li>

														<?php }
														} ?>

													</ul>
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
	</section>

	<?php $this->load->view('public/common/footer');?>
	
	<?php $this->load->view('public/common/foot');?>
</body>
<?php if($user_sport_count==0){ ?> 
<div class="modal fade edit_profile_modal show" id="calandarselectsport" role="dialog" style="padding-right: 17px; ">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" style="top:13px;" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title pl-3" id="exampleModalLongTitle">Select interested sports</h5>
			</div>
			<div class="modal-body">
				<div class="error">
				</div>
				<div id="multiplesportspopup">
					<ul>
						<?php if (isset($sport_list)  && !empty($sport_list)) {
							foreach ($sport_list as $sports) { 
								?>
						<li>
							<i class="fa fa-check-circle varified"></i>
							<img src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon);?>">
							<input type="checkbox" class="sport_id" name="sport_id" value="<?=$sports->sport_id;?>">
							<span class="sport_name"><?=$sports->sport_name;?></span>
						</li>
					<?php } } ?>
						
					</ul>

					<div class="clearfix"></div>

					<div class="col-sm-12 text-right"><a class="btn btn-info orange-btn" id="sportsubmit">Submit</a></div>
				</div>
			</div>

			<div class="modal-footer"></div>

		</div>
	</div>
</div>

<?php } ?>


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

	$("#calandarselectsport").modal('show');
	$(document).on("click", "#multiplesportspopup li", function(){$(this).addClass("selected"); $(this).find("input").attr("checked","checked")});

	$(document).on("click", "#multiplesportspopup li.selected", function(){$(this).removeClass("selected"); $(this).find("input").removeAttr("checked")});

	$("#sportsubmit").on("click", function(){
		var ttt = $(".sport_id:checked").length;
		var sport_id=[];
		$(".sport_id:checked").each(function() {
		sport_id.push($(this).val());
		});
		//var amenity_ids = amenity_id.join(',') ;
		if(ttt == 0){
			$(".error").html("Please select at least one sports");
			return false;
		}
		else
		{
			$(".error").html('');
		}
			$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/insert_interested_sport',	
			data: {sport_ids:sport_id},
			success:function(res){
				if(res==1){
					 swal({
					        title : 'Interested sports saved',
					        html : '',
					        type: 'success'
					    }).then((result) => {
					        if (result.value) {
					        	$('#calandarselectsport').modal('hide');
					        }
					    })
				}
				else{
					swal({
					        title : 'Network Issuee!',
					        html : '',
					        type: 'warning'
					    }).then((result) => {
					        if (result.value) {
					        	$('#calandarselectsport').modal('hide');
					        }
					    })
				}
			}	
		});

	});

$(".email_re_verification").on("click", function(){
	
			$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/email_re_verification',	
			data: {},
			success:function(res){
				if(res=='success'){
					 swal({
					        title : 'Verification link sent to your email id.',
					        html : '',
					        type: 'success'
					    }).then((result) => {
					        if (result.value) {
					        	$('#calandarselectsport').modal('hide');
					        }
					    })
				}
				else{
					swal({
					        title : 'Network Issuee!',
					        html : '',
					        type: 'warning'
					    }).then((result) => {
					        if (result.value) {
					        }
					    })
				}
			}	
		});

	});

</script>
</html>