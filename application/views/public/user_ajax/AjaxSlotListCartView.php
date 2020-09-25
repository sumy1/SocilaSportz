<input type="hidden" id="book_date" value="<?php if(isset($show_date)) echo $show_date; ?>">
<?php if(!empty($fac_slots)){
		foreach ($fac_slots as $slot) {
		 $price =  $this->CommonMdl->getPriceByBSId($slot->batch_slot_id,$package_id);
		 if($facility_type=='facility'){
			$cat_name=$this->CommonMdl->getRow('tbl_batch_slot_type','batch_slot_type',array('batch_slot_type_id' => $slot->batch_slot_type_id));
			$count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $slot->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($show_date))),$cond1='');
			$slotCount = $this->CommonMdl->checkSlotIntoCart($show_date,$slot->batch_slot_id,$this->session->userdata('session_id'));
		?>
		<label class="btn <?php if($slotCount>0){ echo "active"; } if($count>0) echo "booked";?>">
			<span class="ribbon_red">(<?=$cat_name->batch_slot_type?>)</span>
			<span class="slotprice">Price: <i class="fa fa-inr"></i> <?php echo $price; ?></span> 
			
			<br>
			<input type="checkbox" name="slot_batch_options" value="<?php echo $slot->batch_slot_id; ?>" class="slot_batch_options" autocomplete="off" <?php if($slotCount>0){ echo "checked"; } ?>>
			<div class="plan"><i class="fa fa-check-circle" aria-hidden="true"></i> <span class="amount"><?=$slot->start_time.'-'.$slot->end_time;?><br>
				<?php if($slot->is_kit_available == 'yes') { ?>
				<span class="kitplanprice">kit Available<span class="red">*</span> <i class="fa fa-check-circle varified"></i> ( <i class="fa fa-inr kitprice"></i> <?php echo $slot->kit_price;?>)</span>
				<?php } ?>
				<span class="slotinfo">Available(max person <?php echo $slot->max_participanets;?>)</span>
				<br>  </span>
			</div>
		</label>
<?php }

elseif($facility_type=='academy' && $price!='' && $package_id!='0'){
	
	$count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $slot->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($show_date))),$cond1='');
	$slotCount = $this->CommonMdl->checkSlotIntoCart($show_date,$slot->batch_slot_id,$this->session->userdata('session_id')); ?>


		<label class="btn <?php if($slotCount>0){ echo "active"; } if($count==$slot->max_participanets) echo "booked";?> <?php if($slot->is_trial != 'yes'){ echo 'trial_no';}?>">
			<span class="slotprice">Price: <i class="fa fa-inr"></i> <?php echo $price; ?></span> 
			
			<br>
			<input type="checkbox" name="slot_batch_options" value="<?php echo $slot->batch_slot_id; ?>" class="slot_batch_options" autocomplete="off" <?php if($slotCount>0){ echo "checked"; } ?>>
			<div class="plan"><i class="fa fa-check-circle" aria-hidden="true"></i> <span class="amount"><?=$slot->start_time.'-'.$slot->end_time;?><br>
				<?php if($slot->is_kit_available == 'yes') { ?>
				<span class="kitplanprice">kit Available<span class="red">*</span> <i class="fa fa-check-circle varified"></i> ( <i class="fa fa-inr kitprice"></i> <?php echo $slot->kit_price;?>)</span>
				<?php } ?>
				<?php if($slot->is_trial == 'yes') { ?>
					 <span class="slotinfo">Trail Available: Yes</span>
				<?php } ?>
				<span class="slotinfo">Available(max person <?php echo $slot->max_participanets;?>)</span>
				<br>  </span>
			</div>
		</label>



<?php }
elseif($facility_type=='academy' && $price=='' && $package_id=='0'){ 

$count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $slot->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($show_date))),$cond1='');
	$slotCount = $this->CommonMdl->checkSlotIntoCart($show_date,$slot->batch_slot_id,$this->session->userdata('session_id')); ?>


		<label class="btn <?php if($slotCount>0){ echo "active"; } if($count==$slot->max_participanets) echo "booked";?> <?php if($slot->is_trial != 'yes'){ echo 'trial_no';}?>">
			<!-- <span class="slotprice">Price: <i class="fa fa-inr"></i> <?php echo $price; ?></span>  -->
			
			<br>
			<input type="checkbox" name="slot_batch_options" value="<?php echo $slot->batch_slot_id; ?>" class="slot_batch_options" autocomplete="off" <?php if($slotCount>0){ echo "checked"; } ?>>
			<div class="plan"><i class="fa fa-check-circle" aria-hidden="true"></i> <span class="amount"><?=$slot->start_time.'-'.$slot->end_time;?><br>
				<?php if($slot->is_kit_available == 'yes') { ?>
				<span class="kitplanprice">kit Available<span class="red">*</span> <i class="fa fa-check-circle varified"></i> ( <i class="fa fa-inr kitprice"></i> <?php echo $slot->kit_price;?>)</span>
				<?php } ?>
				<span class="slotinfo">Available(max person <?php echo $slot->max_participanets;?>)</span>
				<br>  </span>
			</div>
		</label>

<?php } } ?>


<div class="col-sm-12 text-left"><a class="bookedslot addToCart" href="JavaScript:Void(0);">Add to Cart</a></div> 

<?php }
else{ ?>
<div class="col-sm-12 text-center notavailable">Not Available</div> <?php } ?>

<script>
/* this jquery used for hide/showing is trial available or not  */
	var checked = $('#trial_checkbox').is(":checked");
		if (checked) {
           $('.trial_no').hide();
		}else{
		    $('.trial_no').show();
		}
	$(document).on("click", "#trial_checkbox", function(e) {
		var checked = $('#trial_checkbox').is(":checked");
		if (checked) {
			$('.trial_no').hide();
		} else {
		    $('.trial_no').show();
		}
    });
   var cartcount = parseInt($('.cartcount').text());
   
   console.log('Count='+cartcount);

</script>

