 <!-- Modal content-->

 <style>
hr.seprprice {
    margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px dashed rgb(12, 12, 12);
}
 </style>	
    <div id="booking_detail_view"> <div class="modal-content">
 	<div class="modal-header">
 		<h5 class="modal-title pl-3" id="exampleModalLongTitle">Booking Detail</h5>
 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
 										<span class="red"><?php if($order_main_detail) echo $order_main_detail->booking_order_no;?></span>
 									</div>
 								</div></div>

 								<div class="row">
 									<div class="col-sm-3">
 										Transaction Date

 									</div>
 									<div class="col-sm-9">		<span><i class="fa fa-calendar prefix" style="position:relative; top:0px; left:0;" aria-hidden="true"></i> <?php if($order_main_detail) echo date('d-M-Y', strtotime($order_main_detail->booking_on))?></span></div>
 								
 									<div class="col-sm-2"><strong>Sports</strong></div>
 									<div class="col-sm-3"><strong>Date</strong></div>
									<?php if($order_main_detail->order_sub_detail[0]->package_id!='' && $order_main_detail->order_sub_detail[0]->package_id!='0'){?>
 									<div class="col-sm-2"><strong>Package</strong></div>
									<?php
									  }
									?>
 									<div class="col-sm-3"><strong>Slot time</strong></div>
 									<div class="col-sm-2"><strong>Price</strong></div>

 									<?php
									  foreach($order_main_detail->order_sub_detail as $keyslotdetail=>$valslotdetail)
									  // echo "<pre>";
									  // print_r($valslotdetail);
									  {
										 
									?>
 										<div class="row sportslistbookingdetail">
 											<div class="col-sm-2"><?=$order_main_detail->order_sub_detail[$keyslotdetail]->sport_name[0]->sport_name;?></div>
 											<div class="col-sm-3"><?php echo date('d-M-Y', strtotime($valslotdetail->start_date));?></div>
											
											<?php
									  if($order_main_detail->order_sub_detail[$keyslotdetail]->package_id!='' && $order_main_detail->order_sub_detail[$keyslotdetail]->package_id!='0'){
									?>
 											<div class="col-sm-2"><?=$valslotdetail->package_name;?></div>
											
											<?php
									  }
											?>
 											<div class="col-sm-3 time"><?=$valslotdetail->batch_slot_start_time;?>-<?=$valslotdetail->batch_slot_end_time;?></div>
 											<div class="col-sm-2"><i class="fa fa-inr"></i> <?=$valslotdetail->booking_detail_final_amount;?></div>
 										</div>
 										<?php
										 
									  }
										?>



 										<div class="row  seprateborder">
 											<div class="col-sm-8 text-left nopadleft">Booking Mode: <span class="green"><?php
											 echo $order_main_detail->booking_type;
											?></span></div>
 											<div class="col-sm-4 text-right nopadright "><span style="color: #292828;    font-weight: normal;">Total Amount:</span> <span class="red"><i class="fa fa-inr"></i> <?php if($order_main_detail) echo $order_main_detail->total_amount;?></span>
                                           
                                           <span style="color: #292828;    font-weight: normal;"> Coupon Discount:</span> <span class="red">(-) <i class="fa fa-inr"></i> <?php if($order_main_detail) echo $order_main_detail->discount_amount;?></span>
                                            <hr class="seprprice">
                                            Paid Amount: <span class="red"><i class="fa fa-inr"></i> <?php if($order_main_detail) echo $order_main_detail->final_amount;?></span>
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

