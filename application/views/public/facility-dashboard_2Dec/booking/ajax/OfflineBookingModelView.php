<style>
.nodata{
    font-weight: normal;
    font-size: 15px;
    color: gray;
}

 .slotbooked
	{
		max-height:350px;
		overflow-x:hidden;
	}
	.nicescroll-rails-hr{display:none !important}
	
	#slotbookingtime .text-right
	{
		padding-right:25px !important;
		    margin-top: 15px;
	}

	#slotbookingtime hr
	{

		width: 100%;
	}

	#slotbookingtime .select_plan .btn{
	    width: 150px !important;
	    margin:0px !important;	
	}
</style>
<div class="slotbooked">
<form action="<?=base_url('facility/booking/offlinecheckout');?>" method="post">
<?php if (isset($fac_type) && $fac_type=='facility') { ?>

	<div class="select_plan row fac_facility"  style="position:relative;">
	<span id="errslot" class="error"> </span>
	<div class="col-sm-8">
			<h5 class="modal-title" id="exampleModalLongTitle" style="font-size:17px; margin-bottom:10px;"><?=$fac_name;?> <span id="sport_name"></span></h5>
	</div>
	<?php 
	if(isset($fac_slots) && !empty($fac_slots)){
		for($k=0; $k<count($fac_slots); $k++){ ?>
		
		

		<div class="col-sm-9">
		<?php 
			if(!empty($fac_slots[$k])){
			foreach ($fac_slots[$k] as $slot) {
				 $cat_name=$this->CommonMdl->getRow('tbl_batch_slot_type','batch_slot_type',array('batch_slot_type_id' => $slot->batch_slot_type_id));
				 $count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $slot->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($show_date[$k]))),$cond1='');

				 ?>

				<label class="btn <?php if($count>0) echo "booked";?>" data-original-title="" title="">
					<input type="checkbox" name="<?php echo $show_date[$k];?>[]" class="optionslot batch_slot_id" autocomplete="off" value="<?=$slot->batch_slot_id;?>"> 
					<div class="plan">
						<span class="amount"><span class="time"><?=$slot->start_time.'-'.$slot->end_time;?></span><br>
							<?php if($count>0){ echo "Not Available";} else {echo "Available";}?>
							<span class="table-darkblue">(<?=$cat_name->batch_slot_type?>)</span>
						</span>
					</div>
						<div class="ripple-container"></div><div class="ripple-container"></div>
						<i class="fa fa-check-circle" aria-hidden="true"></i>
			   </label>

		<?php  }  ?>
				<input type="hidden" class="booking_date1" name="booking_date1[]" value="<?php echo $show_date[$k]; ?>">
				<input type="hidden" name="fac_type" value="facility">
				</div>
				<div class="col-sm-3 text-right" style="font-size:17px; margin-bottom:10px;"><?=date('d-M-Y', strtotime($show_date[$k]))?></div>
		<?php }else{ ?>
				<div class="col-sm-12 nodata">No data Available</div>
		<?php } echo "</br><hr>"; } ?>		
			
		</div>

<?php } } ?>



<?php if (isset($fac_type) && $fac_type=='academy') { ?>

 			<div class="fac_academy">
					<div class="row select_plan">
						<div class="col-sm-6">
							<h5 class="modal-title" id="exampleModalLongTitle"><?=$fac_name;?></h5>
						</div>
						<div class="col-md-3">
							<div class="form-group bmd-form-group is-filled planeddashboard" style="margin-top: -25px;">
								<!-- <label for="gender" class="bmd-label-floating">Select Plan</label> -->
								<select class="form-control" id="academybatchtype">
									<option value="0">Select Plan</option>
									<?php if(isset($batch_package) && !empty($batch_package)){
									foreach ($batch_package as $package) { ?>
									
									<option value="<?=$package->package_id;?>"><?=$package->package_name;?></option>
									<?php }}?>
								
								</select>	<i class="fa fa-futbol-o prefix"></i>
								<span id="errPackage" class="error"></span>	
							</div>
						</div>
						<div class="col-sm-3 text-right"><strong><?=$date;?></strong></div>
					</div>
					<div class="select_plan academylabel">
					

			<?php if(isset($fac_batch) && !empty($fac_batch)){
				foreach ($fac_batch as $batch) {
				 

					 $count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $batch->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($date))),$cond1='');?>

			 	
							<label class="btn <?php if($count==$batch->max_participanets){ echo "booked";} else {echo "green";}?>" data-original-title="" title="">
								 

								<input type="checkbox" name="options[]" class="optionslot batch_slot_id" autocomplete="off" value="<?=$batch->batch_slot_id;?>"> 
								<div class="plan">

									<span class="amount"><span class="time"><?=$batch->start_time.'-'.$batch->end_time;?></span><br> <?php if($count==$batch->max_participanets){ echo "Not Available";} else {echo "Available";}?>
										 <span class="table-darkblue">(<?=$count.'/'.$batch->max_participanets;?>)</span>

									</span></div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>

								<?php }
			}
			else{ ?>
				<div class="col-sm-12 nodata">No data Available</div>
			<?php } ?>

							</div>

						
						</div>
						<?php } ?>

					
							<div class="row">
								<div class="col-sm-12 text-right" style="padding-top:20px; margin-top: -45px">
									<button type= "submit" id="submitBooking" class="bookedslot orange-btn">Book Now</button>
									 <img id="load_icon" src="<?php echo base_url('assets/');?>image/loading_icon.gif" class="menu-icon" /><br>
									<span class="smalltext" style="float:right">*Offline Booking</span>
								</div>
							</div>
							
							
							<input type="hidden" id="fac_name" name="fac_name" value="">
							<input type="hidden" id="fac_id" name="fac_id" value="">
							<input type="hidden" id="date" name="booking_date" value="<?=$date?>">
							<input type="hidden" id="sport_id" name="sport_id" value="<?=$sport_id?>">
							<input type="hidden" id="package_id" name="package_id" value="">
							</form>
					</div>


					<script>

					$("#submitBooking").show();
					$("#load_icon").hide();	
					

					
				$(document).ready(function(){
				var sport_name =$("#fac_sport option:selected" ).text();
				$('#sport_name').html(' ('+sport_name+')');
					
				var fac_name =$("#headeracademyfacility option:selected" ).text();
				var fac_id =$("#headeracademyfacility option:selected" ).val();
				$('#fac_name').val(fac_name);
				$('#fac_id').val(fac_id);

				 });



           $('.select_plan.academylabel label').on('click', function(e) {
			var batch_type=$('#academybatchtype option:selected').val();
			if(batch_type == 0){
		$('#errPackage').show();
		$('#errPackage').html('Please select plan');
		return false;
		}
		else{
			$('#errPackage').html('');
		}

	});


		$('.bookedslot').on('click', function(e) {
			var batch_type=$('#academybatchtype option:selected').val();
			if(batch_type == 0){
				$('#errPackage').show();
				$('#errPackage').html('Please select plan');
				return false;
				}
				else{
					$('#errPackage').html('');
				}
				 
				var chkArray = [];
				$(".batch_slot_id:checked").each(function() {
					chkArray.push($(this).val());
					});
				var batch_slot_id = chkArray.join(',') ;
			//alert(batch_slot_id);
				if(batch_slot_id == ''){
				$('#errslot').show();
				$('#errslot').html('Please select atleast one slot');
				return false;
				}
				else{
					$('#errslot').html('');
				}
				$("#submitBooking").hide();
				$("#load_icon").show();	

		});



		$('#academybatchtype').on('change', function(e) {
		var package_id = $(this).val();
		var fac_id = $('#fac_id').val();
		var sport_id = $('#sport_id').val();
		var date = $('#date').val();
		$('#package_id').val(package_id);
	//alert(sport_id);
		
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/filter_batch_by_package',	
			data: {package_id:package_id,fac_id:fac_id,sport_id:sport_id,date:date},
			success:function(res){
				$(".academylabel").html(res['_html']);
			}	
		});

});

		

		var abc = $(".nodata").length; if(abc > 0){$(".bookedslot.orange-btn").hide()};
		
	/*	setTimeout(function(){
			
		jQuery("#slotbookingtime .slotbooked").niceScroll({autohidemode: false,});
		},500);

/*		jQuery(document).stop(true,true).on("click",".academylabel label", function(e){
jQuery(this).toggleClass('active');
if($(this).hasClass("active")){
	jQuery(this).find("input").removeAttr("selected");
	jQuery(this).find("input").attr("checked", "checked");
}

else
{
jQuery(this).find("input").attr("checked", false);
	jQuery(this).find("input").removeAttr("selected");
}

	return false;
	});*/
					</script>	