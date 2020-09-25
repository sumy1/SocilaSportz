<style>
	#eventdetaillistusers .modal-dialog
	{
		max-width: 700px;
	}
</style>	

      <!-- Modal content-->
    <div id="booking_detail_view"> 
	<div class="modal-content">
 	<div class="modal-header">
 		<h5 class="modal-title pl-3" id="exampleModalLongTitle">Booking Detail</h5>
 		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 15px;">
 			<span aria-hidden="true">×</span>
 		</button>
 	</div>
 	<div class="modal-body">
 		<div class="row">

 			<div class="col-sm-12">
 				<div class="roundcorner">
 					<div class="row">

 						<div class="col-sm-12">
 							<div class="bookingroundcorner">
 								<div class="row">
 									<div class="col-sm-3">
 										<strong>Booking Id</strong> :
 									</div>
 									<div class="col-sm-9">
									
 										<span class="red"><?php if($old_booking_deatail) echo $old_booking_deatail[0]->booking_order_no;?></span>
 									</div>
 								</div></div>

 								<div class="row">
 									<div class="col-sm-3">
 										Transaction Date

 									</div>
 									<div class="col-sm-9">
									<span> <i class="fa fa-calendar prefix" style="position:relative; top:0px; left:0;" aria-hidden="true"></i>
									<?php if($old_booking_deatail) echo date('d-M-Y', strtotime($old_booking_deatail[0]->booking_on))?></span></div>
								
 									<div class="col-sm-3">Name</div>
 									<div class="col-sm-9"><?php if($old_booking_deatail) echo $old_booking_deatail[0]->name;?></div>
 									<div class="col-sm-3">Email</div>
 									<div class="col-sm-9"><?php if($old_booking_deatail) echo $old_booking_deatail[0]->email;?></div>
 									<div class="col-sm-3">Mobile</div>
 									<div class="col-sm-9"><?php if($old_booking_deatail) echo $old_booking_deatail[0]->mobile;?></div>
 									<div class="col-sm-3">Address</div>
 									<div class="col-sm-9"><?php if($old_booking_deatail) echo $old_booking_deatail[0]->address;?></div>
 									<div class="col-sm-2"><strong>Sports</strong></div>
									<div class="col-sm-4"><strong>Date</strong></div>
 									<div class="col-sm-3"><strong>Event time</strong></div>
 									<div class="col-sm-2"><strong>Price</strong></div>

 									
 										<div class="row sportslistbookingdetail">
 											<div class="col-sm-2"><?php echo $old_booking_deatail[0]->sport_list[0]->sport_name;?></div>
 											<div class="col-sm-4"><?php echo date('d-M-Y', strtotime($old_booking_deatail[0]->booking_event_details[0]->event_start_date));?>-<?php echo date('d-M-Y', strtotime($old_booking_deatail[0]->booking_event_details[0]->event_end_date));?></div>
 											
 											<div class="col-sm-3 time">
											<?=$old_booking_deatail[0]->booking_event_details[0]->event_start_time;?>-
											<?=$old_booking_deatail[0]->booking_event_details[0]->event_end_time;?>
											
											
											</div>
 											<div class="col-sm-2"><i class="fa fa-inr"></i>
											<?php echo $old_booking_deatail[0]->booking_event_details[0]->booking_detail_final_amount;?>
											</div>
 										</div>


 										<div class="row  seprateborder">
 											<div class="col-sm-6 text-left nopadleft">Booking Mode: <span class="green"><?php echo $old_booking_deatail[0]->booking_type; ?></span></div>
 											<div class="col-sm-6 text-right nopadright " style="padding-right: 39px !important;">Total: <span class="red"><i class="fa fa-inr"></i><?php if($old_booking_deatail) echo $old_booking_deatail[0]->total_amount;?>  </span>

 												<br>
 												  <span style="color: #292828;    font-weight: normal;"> Coupon Discount:</span> <span class="red">(-) <i class="fa fa-inr"></i> <?php if($old_booking_deatail) echo $old_booking_deatail[0]->discount_amount;?></span>
                                            <hr class="seprprice">
                                            Paid Amount: <span class="red"><i class="fa fa-inr"></i> <?php if($old_booking_deatail) echo $old_booking_deatail[0]->final_amount;?></span>

 											</div>

 										</div>
										
										
 									</div>
 								</div>
 							</div>



 						</div>

 					</div>

 				</div>
 			</div>


 		</div></div>

