<div class="select_plan " data-toggle="buttons">

	<?php

	if(isset($fac_slots) && $fac_slots){
		foreach ($fac_slots as $value) {

			$count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $value->batch_slot_id,'start_date'=>$datetime),$cond1='');
			?>
			<label class="btn <?php if($count==1) echo "booked"; ?> " data-original-title="" title="">
				<input type="radio" name="options" class="optionslot" autocomplete="off"> 
				<div class="plan">

					<span class="amount"><span class="time"><?=$value->start_time.' - '.$value->end_time;?></span><br>
						<?php if($count==1) echo "Booked"; else{ echo "Available";} ?>

					</span></div>
					<div class="ripple-container"></div><div class="ripple-container"></div>
					<i class="fa fa-check-circle" aria-hidden="true"></i>
					<input type="hidden" class="batch_slot_id" value="<?=$value->batch_slot_id;?>">
				<input type="hidden" class="datetime" value="<?=$datetime;?>">
				</label>
				
				<?php }
			} ?>
			


		</div>

<div id ="UserBookingDetail"></div>
				




<script>
	
	jQuery(document).on("click", ".select_plan label", function(){
	jQuery(this).find("input").attr("selected", true);
	jQuery(this).addClass('active');	
		/*var year =$("#yearname").text();*/
		var batch_slot_id = $(this).find('.batch_slot_id').val();
		var datetime = $(this).find('.datetime').val();

		$.ajax({
			type: "POST",
			url:'<?php echo base_url();?>facility/booking/UserBookingDetail',	
			data: {batch_slot_id:batch_slot_id,datetime:datetime},
			success:function(res){
				$("#UserBookingDetail").html(res['_html']);

			}	
		});



	});
</script>