		<div class="select_plan academylabel" data-toggle="buttons">
						<h5>Batch Available for Academy</h5>
		<?php

		 if(isset($fac_slots) && $fac_slots){
			foreach ($fac_slots as $value) {
	    	 //$count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $value->batch_slot_id,'start_date'=>$datetime),array('start_date<='=>$datetime,'start_date>='=>$datetime));
	    	 $count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $value->batch_slot_id,'start_date <='=>$datetime));
			?>
			 					
								<label class="btn booked <?php if($count==$value->max_participanets) echo "booked" ?>">

									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">

										<span class="amount"><?=$value->start_time.'-'.$value->end_time;?><br>
											<?php if($count==$value->max_participanets) echo "Not Available"; else echo "Available"; ?>
											<span class="table-darkblue">(<?=$count.'/'.$value->max_participanets;?>)</span>
											<input type="hidden" class="batch_slot_id" value="<?=$value->batch_slot_id;?>">
											<input type="hidden" class="datetime" value="<?=$datetime;?>">
										</span>


									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
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
				url:'<?php echo base_url();?>facility/booking/UserBatchBookingDetail',	
				data: {batch_slot_id:batch_slot_id,datetime:datetime},
				success:function(res){
					$("#UserBookingDetail").html(res['_html']);

				}	
			});
		});
	</script>			