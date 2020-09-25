<?php
									 if(isset($get_booking_order) && !empty($get_booking_order)){foreach($get_booking_order as $bookingorderkey=>$bookingorderval){
										
									?>
									       <li>
												<div class="booking_data clearfix">
													<form action="<?=base_url('dashboard/download_booking_receipt');?>" method="post">
														<input type="hidden" name="order_id" value="<?php  echo $bookingorderval->booking_order_id;?>">
													<span class="latest_notification"> 
														<button type="submit">Download Receipt</button> </span> </form>
													<?php
											$data['get_facility']=$this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$get_booking_order[$bookingorderkey]->get_slot_detail[0]->fac_id),'fac_city,fac_name,fac_id,fac_banner_image',$order_by='');
											   foreach($data['get_facility'] as $facility){
													?>
													<div class="img_item">
														<img src="<?=base_url('assets/public/images/fac/'.$facility->fac_banner_image);?>" class="img-fluid" alt="">
													</div>
													
												
													<div class="item_data">
														<div class="col-sm-12 nopadleft">
														    <a data-toggle="modal" data-target="#bookingdetaillistuser" class="title_dash">Booking ID : <?php  echo $bookingorderval->booking_order_no;?> <input type="hidden" id="booking_order_id" value="<?=$bookingorderval->booking_order_id;?>"></a>
													    </div>
													    <span class="icone loaction"> <?php
                                                       echo $facility->fac_name;?>(<?php echo $bookingorderval->sport_listing[0]->sport_name;?>)</span>
														
														<span class="icone loaction"><i class="fa fa-map-marker"></i> <?php
                                                       echo $facility->fac_city;?></span>
													  <?php
											      }
													?>
														
												   <?php
												   
												     foreach($get_booking_order[$bookingorderkey]->get_slot_detail as    $booking_slotkey=>$booking_slotval){
													?>												
														<span class="icone date d-inline-block">
                                                        <i class="fa fa-calendar"></i>
													     <?php echo  date("d-M-Y", strtotime($booking_slotval->start_date));?>
													  </span>
														<span class="icone  d-inline-block ml-2 time"><i class="fa fa-clock-o" aria-hidden="true"></i><?=$booking_slotval->batch_slot_start_time;?>  to <?=$booking_slotval->batch_slot_start_time;?> 
														<?php if($get_booking_order[$bookingorderkey]->get_slot_detail[$booking_slotkey]->package_id!='' && $get_booking_order[$bookingorderkey]->get_slot_detail[$booking_slotkey]->package_id!='0'){ ?>
														       (<?php echo $get_booking_order[$bookingorderkey]->get_slot_detail[$booking_slotkey]->package_name;?>)
														  
														  <?php  }?>
														</span><br>
														<?php
													 }
														?>
														
													</div>
													

													<div class="row col-sm-12">
														<div class="col-sm-6">
														<a class="btn btn-info orange-btn review_btn" style="text-transform: inherit;" data-toggle="modal" data-target="#addReviews"><input type="hidden" class="order_fac_id" value="<?=$facility->fac_id;?>"><input type="hidden" class="order_fac_name" value="<?=$facility->fac_name;?>">Write a Review</a>
													</div>
													<div class="col-sm-6 text-right nopadright">
													Payment Status: <span class="<?php if($bookingorderval->booking_status=='confirm') echo "green"; else echo "red";?>"><?php  echo ucwords($bookingorderval->payment_status);?>
													</span>
													 <br>
													 Status:<span class="<?php if($bookingorderval->booking_status=='confirm') echo "green"; else echo "red";?>"> <?php  echo ucwords($bookingorderval->booking_status);?></span>
													</div>

													 													
													</div> 
												</div>
												
												
												
											</li>
											
											
									 <?php } } else{ ?>

									 <span>No booking yet</span>

									<?php  } ?>
                                     