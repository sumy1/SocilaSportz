    <style>
    .popover
    {
        margin-top: -80px;
    }
   </style>
	<?php
	if(!empty($fac_data)) { 
		foreach($fac_data as $facVal){  ?>
		<div class="col-sm-4">
			
			<a href="<?=base_url('searchlisting/search_detail/'.$facVal->fac_slug);?>">
				<?php if ($facVal->fac_banner_image!='' && file_exists(FCPATH .'assets/public/images/fac/'.$facVal->fac_banner_image)) { ?>
                <img src="<?=base_url('assets/public/images/fac/'.$facVal->fac_banner_image);?>" alt="">
                 <?php } else{ ?>
                   <img src="<?=base_url('assets/public/images/Dummy_image.jpg');?>" alt="">
                  <?php } ?>
				<?php if($facVal->avg_rating!=0){ ?>
				<div class="venue-rating-div">
					<div>
						<div class="venue-list-rating"><i class="fa fa-star"></i> <?php echo $facVal->avg_rating; ?></div>
					</div>
					<div class="venue-list-votes"><?php echo $facVal->rating_count; ?> Review</div>
				</div>
				<?php } ?>
			</a>
			<div class="item-wrapper">
			  <span class="heading">
				<a href="<?=base_url('searchlisting/search_detail/'.$facVal->fac_slug);?>"><?php echo $facVal->fac_name; ?></a>
			</span>
			<div class="row">
				<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>   <strong>Opening Timing :</strong>  <span class="calanderpopover calanderpopover<?=$facVal->fac_id;?>"> <?php echo @$facVal->timing[0]->open_time .' to '.@$facVal->timing[0]->close_time;?></span>
				</div>  </div>
				<div class="row">
					<div class="text-left col-sm-12 addresfont">    <i class="fa fa-map-marker"></i> <?php echo $facVal->fac_city; ?></div>
					
					<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
					</div>
					<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
					<?php 
					$i=0;
					$count =0;
					foreach ($facVal->sport as $sports) {
					if($i<4){  ?>
						<div class="sport-icon-div">
							<img alt="sports icon" class="sportsimgicon1" src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon);?>">
						</div>
				<?php $count++;} $i++; } 
						$remain_sports =  $i-($count);
						if($remain_sports>0){ ?>
						<span class="morenew">+ <?php echo $remain_sports; ?></span>
					<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="text-center col-sm-12">
						<form method="post" action="<?php echo base_url('booking'); ?>">
							<input type="hidden" name="book_fac_id" value="<?php echo $facVal->fac_id; ?>" >
							<input type="hidden" name="book_sport_id" value="<?php if(isset($sport_id)){echo $sport_id;} ?>" >
							<input type="hidden" name="book_type" value="<?php if(isset($type)){echo $type;} ?>" >

							<?php if(!empty($this->session->userdata('sport_id'))){
												$slot_count =  $this->CommonMdl->fetchNumRows('tbl_facility_batch_slot',array('sport_id'=>$this->session->userdata('sport_id'),'fac_id'=>$facVal->fac_id,'end_date>='=>date('Y-m-d')),'');
											//echo $this->db->last_query();
											if($slot_count>0) { ?>
											<button type="submit" class="readmore-blog orange-btn btn-block" >Book Now</button>
											<?php }  }  ?>
											

						</form>
					</div>
				</div>
			</div>
		</div>
	<?php } }

else{ ?>
<div class="nodata notavailable col-sm-12 text-center">No data available</div>
<?php }

	 ?>
	
		

	<?php ## for showing opning timing on mouse hover------
		foreach ($fac_data as $faclist) { ?>
		<script>
			var fac_id = '<?=$faclist->fac_id;?>';
			$('.calanderpopover'+fac_id).popover({		
				content: '<div class="table-responsive"><table class="table table-sm timimg-table"><tbody><?php foreach ($faclist->timing as $timings) { ?><tr><td><strong><?=$timings->day; ?></strong></td><td><?=$timings->open_time.' - '.$timings->close_time;?></td></tr> <?php } ?></tbody></table></div>', 
				html: true, 
				placement: "bottom",
				trigger: "hover"

			});
		</script>
	<?php } ?>	
	<script>
	// Set total record after filter---
		var total_count = "<?php echo $fac_data_count;?>";
		$('#total_count').text(total_count);
		var sport_name = "<?php if(isset($sport_name)) echo $sport_name;?>";
		$('#sport_name').text(sport_name);
		var usercity = "<?php if(isset($usercity)) echo $usercity;?>";
		$('#usercityspan').text(usercity);
	</script>