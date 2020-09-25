 <?php
											   if(isset($get_booking_orders) && !empty($get_booking_orders)){foreach($get_booking_orders as $bookingorderkey=>$bookingorderval){?>
											 <li>
												<div class="booking_data clearfix">
													<form action="<?=base_url('dashboard/download_event_booking_receipt');?>" method="post">
														<input type="hidden" name="order_id" value="<?php  echo $bookingorderval->booking_order_id;?>">
													<span class="latest_notification"> 
														<button type="submit">Download Receipt</button> </span> </form>
													
												
													<div class="img_item">
														<img src="<?=base_url('assets/public/images/event/banner/'.@$bookingorderval->event_listing[0]->event_banner);?>" class="img-fluid" alt="">
													</div>
													
												
													<div class="item_data">
														<div class="col-sm-12 nopadleft">
														    <a data-toggle="modal" data-target="#eventdetaillistusers" class="booking_event">Booking ID : <?php  echo $bookingorderval->booking_order_no;?> <input type="hidden" id="booking_order_id" value="<?=$bookingorderval->booking_order_id;?>"></a>
													    </div>
														<span class="icone loaction"><?php echo $bookingorderval->facility_listing[0]->fac_name;?> </span>

														<span class="icone loaction"><?php echo $bookingorderval->booking_event_details[0]->event_name;?> 
														(<?php echo $bookingorderval->sport_listing[0]->sport_name;?>)
														</span>
														
														<span class="icone loaction"><i class="fa fa-map-marker">
														</i>&nbsp;<?php echo $bookingorderval->event_listing[0]->event_venue;?>,&nbsp;<?php echo $bookingorderval->event_listing[0]->event_google_address;?> 
                                                      </span>
														<span class="icone date d-inline-block">
                                                        <i class="fa fa-calendar"></i>
													      <?php echo  date("d-M-Y", strtotime($bookingorderval->booking_event_details[0]->event_start_date));?>
													     &nbsp;&nbsp;<?php echo  date("d-M-Y", strtotime($bookingorderval->booking_event_details[0]->event_end_date));?>
													  </span><br>
														<span class="icone  d-inline-block ml-2 time">
														  <i class="fa fa-clock-o" aria-hidden="true"></i>
														<?=trim($bookingorderval->booking_event_details[0]->event_start_time);?> to <?=trim($bookingorderval->booking_event_details[0]->event_end_time);?>
                                                     </span><br>

														
														
														
														
													</div>
												</div>
											</li>
											<?php
											   } }
											else{ ?>

									 <span>No booking yet</span>

									<?php  } ?>