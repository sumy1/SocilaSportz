
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
													 <img class="col-sm-2  useyr_img img-fluid rounded-circle" src="<?=base_url('assets/public/images/user/'.$get_rating_data[$ratingkey]->user_profile->user_profile_image);?>" alt="User Image"> 
													<?php } else{?>
													   <img class="col-sm-2  useyr_img img-fluid rounded-circle" src="https://placeimg.com/200/200/people" alt="User Image">
												   <?php }?>	
														<div class="col-sm-6">
															<h2 style="    font-size: 16px;
															color: #ec4610;" class="mt-0 mb-0 user_name clearfix">
															
															<?php
															
															 echo $get_rating_data[$ratingkey]->facility_name[0]->fac_name;  ?></h2>
																																										<div class="rating_container">
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
								
									