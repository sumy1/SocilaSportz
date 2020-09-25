    <style>
    .popover
    {
        margin-top: -80px;
    }
   </style>
	<?php 
	if(!empty($event_data)) { 
		foreach($event_data as $eventVal){ ?>
		<div class="col-sm-4">
			
			<a href="<?=base_url('searchlisting/event_detail/'.$eventVal->event_slug);?>">
				<img src="<?=base_url('assets/public/images/event/banner/'.$eventVal->event_banner);?>" alt="">
			</a>
			<div class="item-wrapper">
			  <span class="heading">
				<a href="<?=base_url('searchlisting/event_detail/'.$eventVal->event_slug);?>"><?php echo $eventVal->event_name; ?></a>
			</span>
			<span class="heading nomargin"><?php echo $eventVal->fac_name; ?></span>
			<div class="row">
				<div class="text-left col-sm-12">
					<strong> <i class="fa fa-calendar" aria-hidden="true"></i> Event Date :</strong> <span><?php echo $eventVal->event_start_date; ?> <strong>to</strong> <?php echo $eventVal->event_end_date; ?></span>
				</div> 
				<div class="text-left col-sm-12">
					<i class="fa fa-clock-o" aria-hidden="true"></i> <strong>Timings :</strong> <span  data-original-title="" title=""> <?php echo $eventVal->event_start_time; ?> <strong>to</strong> <?php echo $eventVal->event_end_time; ?></span>
				</div>
			</div>
				<div class="row">
					<div class="text-left col-sm-12 addresfont">    <i class="fa fa-map-marker"></i> <?php echo $eventVal->event_city; ?></div>
					
					<div class="col-sm-12 kiticon"> <strong> Amenities:</strong>
					</div>
					<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
					<?php 
					$i=0;
					$count =0;
					foreach ($eventVal->amenities as $amenities) {
					if($i<4){  ?>
						<div class="sport-icon-div">
							<img alt="sports icon" class="sportsimgicon1" title="<?=$amenities->amenity_name;?>" src="<?=base_url();?>assets/public/images/amenity/<?=$amenities->amenity_icon;?>">
						</div>
				<?php $count++;} $i++; } 
						$remain_sports =  $i-($count);
						if($remain_sports>0){ ?>
						<span class="morenew">+ <?php echo $remain_sports; ?></span>
					<?php } ?>
					</div>
				</div>
				<?php
               $count=$this->CommonMdl->fetchNumRows('tbl_booking_event_detail',array('event_id' => $eventVal->event_id),$cond1='');

               if($count < $eventVal->event_max_capicity_per_day && $eventVal->application_end_date >= date('Y-m-d')){ ?>
				<div class="row">
					<div class="text-center col-sm-12">
						<form method="post" action="<?php echo base_url('booking/event_checkout'); ?>">
							<input type="hidden" name="book_event_id" value="<?php echo $eventVal->event_id; ?>" >
							<button type="submit" class="readmore-blog orange-btn btn-block" >Book Now</button>
						</form>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	<?php } }

	else{ ?>
<div class="nodata notavailable col-sm-12 text-center">No data available</div>
<?php }

	 ?>

	<script>
	// Set total record after filter---
		var total_count = "<?php echo $event_data_count;?>";
		$('#total_count').text(total_count);
		var sport_name = "<?php if(isset($sport_name)) echo $sport_name;?>";
		$('#sport_name').text(sport_name);
	</script>