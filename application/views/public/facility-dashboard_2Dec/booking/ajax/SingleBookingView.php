 <div class="modal-content">
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
 										<span class="red"><?php if($order_main_detail) echo $order_main_detail->booking_order_no;?></span></h5>
 									</div>
 								</div></div>

 								<div class="row">
 									<div class="col-sm-3">
 										Transaction Date

 									</div>
 									<div class="col-sm-9">		<span><i  class="fa fa-calendar prefix" style="position:relative; top:0px; left:0;" aria-hidden="true"></i> <?php if($order_main_detail) echo date('d-M-Y', strtotime($order_main_detail->booking_on))?></span></div>
 									<div class="col-sm-3">Name</div>
 									<div class="col-sm-9"><?php if($order_main_detail) echo $order_main_detail->name;?></div>
 									<div class="col-sm-3">Email</div>
 									<div class="col-sm-9"><?php if($order_main_detail) echo $order_main_detail->email;?></div>
 									<div class="col-sm-3">Mobile</div>
 									<div class="col-sm-9"><?php if($order_main_detail) echo $order_main_detail->mobile;?></div>
 									<div class="col-sm-12"><strong>Sports</strong></div>

 									<?php foreach ($order_sub_detail as $order_sub_details) {
 										$sport_name = $this->FacilityMdl->get_order_sport_name($order_sub_details->batch_slot_id);

 										?>

 										<div class="row sportslistbookingdetail">
 											<div class="col-sm-2"><?=$sport_name[0]->sport_name;?></div>
 											<div class="col-sm-3"><?php echo date('d-M-Y', strtotime($order_sub_details->start_date));?></div>
 											<div class="col-sm-2"><?=$order_sub_details->package_name;?></div>
 											<div class="col-sm-3"><?=$order_sub_details->batch_slot_start_time;?>-<?=$order_sub_details->batch_slot_end_time;?></div>
 											<div class="col-sm-2"><i class="fa fa-inr"></i> <?=$order_sub_details->booking_detail_final_amount;?></div>
 										</div>
 										<?php } ?>




 										<div class="row  seprateborder">
 											<div class="col-sm-6 text-left nopadleft">Booking Mode: <span class="green"><?php if($order_main_detail) echo ucwords($order_main_detail->booking_type);?></span></div>
 											<div class="col-sm-6 text-right nopadright ">Total: <span class="red"><i class="fa fa-inr"></i> <?php if($order_main_detail) echo $order_main_detail->final_amount;?></span></div>

 										</div>
 									</div>
 								</div>
 							</div>



 						</div>

 					</div>

 				</div>
 			</div>


 		</div>