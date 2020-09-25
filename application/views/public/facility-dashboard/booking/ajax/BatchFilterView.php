<div class="select_plan academylabel" data-toggle="buttons">
					

			<?php if(isset($fac_batch) && !empty($fac_batch)){
				foreach ($fac_batch as $batch) {
				 

					 $count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $batch->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($date))),$cond1='');

					 	 $batch_price=$this->CommonMdl->getRow('tbl_slot_package_price','slot_package_price',array('batch_slot_id' => $batch->batch_slot_id,'package_id' => $package_id));

					 ?>

			 	
			 	
							<label class="btn <?php if($count==$batch->max_participanets){ echo "booked";} else {echo "green";}?>" data-original-title="" title="">
								<input type="checkbox" name="options[]" class="optionslot batch_slot_id" autocomplete="off" value="<?=$batch->batch_slot_id;?>"> 
								<div class="plan">

									<span class="amount"><?=$batch->start_time.'-'.$batch->end_time;?><br> <?php if($count==$batch->max_participanets){ echo "Not Available";} else {echo "Available";}?>
										<span class="amount" >  <span class="time"><i class="fa fa-inr"></i> <?=$batch_price->slot_package_price;?></span><br>

										 <span class="table-darkblue">(<?=$count.'/'.$batch->max_participanets;?>)</span>

									</span></div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>

								<?php }
			}
			else{
				echo "No data Available";
			} ?>

							</div>
							<script>

$(document).on('click', '.select_plan label', function(){
    //console.log('okkkkkkk'); 
        $(this).find("input").attr("selected", true);
        $(this).toggleClass('active');
  });

							</script>