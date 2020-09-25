<?php if(isset($review_list) && !empty($review_list)){  ?>	
			<?php foreach($review_list as $reviewVal){

			 ?>
					<li class="media reviews_data_list">
						<!-- <img class="mr-3 user_img img-fluid rounded-circle" src="https://placeimg.com/200/200/people" alt="User Image"> -->
						<div class="media-body user_info">
							<div class="row align-items-center">
								<div class="col-md-9">
									<h5 class="mt-0 mb-0 user_name clearfix"><?php echo $reviewVal->user_name; ?></h5>
									<h5 class="mt-0 mb-0 user_name clearfix"><?php echo $reviewVal->user_email; ?></h5>
									<div class="rating_container">
										<ul class="list-inline">
										<?php if($reviewVal->rating == 1){ ?>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
										<?php } if($reviewVal->rating == 2){ ?>	
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
										<?php } if($reviewVal->rating == 3){ ?>	
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
										<?php } if($reviewVal->rating == 4){ ?>	
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
										<?php } if($reviewVal->rating == 5){ ?>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
											<li class="list-inline-item active"><i class="fa fa-star"></i></li>
										<?php }?>
											
										</ul>
									</div>
									<p class="user_comment"><?php echo $reviewVal->review_message; ?></p>
								</div>
								<div class="col-md-3 report_div_<?php echo $reviewVal->rating_id; ?>">
									<?php if($reviewVal->report_abuse==0){?>
									<button class="btn btn-raised btn-sm save_btn change_password_btn abusemarker abuse_re_<?php echo $reviewVal->rating_id; ?>" ><input type="hidden" class="review_id" value="<?php echo $reviewVal->rating_id; ?>">Report Abuse</button> <?php } else { ?>
									 <span class="reported">Reported</span>
									  <?php } ?>
									<i class="fa fa-check hidedefault" aria-hidden="true"></i>
								</div>
							</div>
						</div>
						<span class="time"><?php echo date('d-m-Y', strtotime($reviewVal->created_on)); ?></span>
					</li>
			<?php } ?>		
<?php }else{ ?> 
<span class="nodata">No Review Yet</span>
<?php  } ?>	

<script>
	var disable_button = $(".nodata").length;if(disable_button > 0){$(".view_more").hide()};

	$(document).on("click", '.abusemarker', function(){
		var rating_id =$(this).find("input").val();
		$.ajax({
			url: '<?=base_url();?>facility/review/update_rating',
			type: 'POST',
			data: {rating_id:rating_id},
			success: function (res) {               			
				if(res!="fail"){
					 hiddingLoader();
					swal("Abuse reported","","success");
					$(".abuse_re_"+rating_id).remove();
					$(".report_div_"+rating_id).html("<span class='reported'>Reported</span>");

				}else{
					swal("Done!","Sorry some problem occurred","success");
				}
			}
		});
	});
</script>