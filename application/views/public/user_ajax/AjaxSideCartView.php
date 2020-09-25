	<?php if(!empty($cart_list_arr)){ ?>
			<h5>MY CART (<span class="cartcount"><?php echo count($cart_list_arr); ?></span>)</h5>
			<hr>
	<?php 
		$total_price=0; $trial_count=0;
		foreach($cart_list_arr as $listVal){ 
			if($listVal->trial_booking =='yes'){ $trial_count = $trial_count+1;}
				else{$total_price = $total_price+$listVal->slot_package_price; } ?>    
			<div class="row checkoutcolumn">
			   <div class="col-sm-12"></div>
			   <div class="col-sm-5"><i class="fa fa-calendar"></i> <?php echo date('d, M Y',strtotime($listVal->book_date));?></div>
			   <div class="col-sm-7 text-right time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $listVal->start_time .' to '.$listVal->end_time; ?></div>
			   <div class="col-sm-6"><?php  if($listVal->trial_booking=='yes'){?> <span style="color:green"><b> Trial</b></span><?php }else{ ?><i class="fa fa-inr" aria-hidden="true"></i> <span class="itemprice"> <?php echo $listVal->slot_package_price; ?><?php if($listVal->package_name!='') echo  '('.$listVal->package_name.')'; ?></span> <?php } ?></div>
			  <div class="col-sm-6 text-right"><span class="cartitem removeItem"><input type="hidden" class="cart_id" value="<?php echo $listVal->cart_id; ?>"><input type="hidden" class="cart_book_date" value="<?php echo $listVal->book_date; ?>"> <i class="fa fa-trash" aria-hidden="true"></i></span></div>
		   </div>
	<?php } ?>	
			<input type="hidden" id="trial_count" value="<?php echo $trial_count; ?>">
			<div class="row cartchekoutwrapper">
			   <div class="col-sm-6 boldprice">
				<i class="fa fa-inr"></i> <span class="itemtotalprice"><?php echo $total_price; ?></span>
			   </div>
			   
			   
			    <div class="col-sm-6 text-left errCheckBtn" style="display:none">
					<span style="color:red">At a single time you can only book a single trail or book batch.</span>
				</div> 
			    <div class="col-sm-6 text-left succCheckBtn">
					<a class="bookedslot" href="<?php echo base_url('booking/checkout');?>">Checkout</a>
			    </div> 
				
		   </div>
	<?php }else{ ?>
		 <div class="empty-cart"><img src="<?php echo base_url();?>assets/public/images/empty-cart.svg"><span>Your shopping cart is currently empty</span></div>
	<?php } ?>
	
