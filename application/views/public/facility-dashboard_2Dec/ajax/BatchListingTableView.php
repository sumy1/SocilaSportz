<table class="table1 table-hover table_cust offers_table6" id="facilityacadelisting">
	<thead>
		<tr class="bg-grey">
			<th>S. No.</th>
			<th>Batch date</th>
			<th>Batch Timing</th>
			<th>Sport Name</th>
			<th>Max Person</th>
			<th>Price</th>
			<th>Working day's</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=0; if(isset($batchListing) && $batchListing) {
		foreach ($batchListing as $batchListings) { $i++;
		$sport_name = $this->CommonMdl->getRow('tbl_sport_list','sport_name',array('sport_id'=>$batchListings->sport_id));
		$label = $this->CommonMdl->getRow('tbl_batch_slot_type','batch_slot_type',array('batch_slot_type_id'=>$batchListings->batch_slot_type_id));
		$batch_price=$this->FacilityMdl->batch_price_package($batchListings->batch_slot_id);

			$price_package = '';
			 foreach ($batch_price as $price) {
				$price_package.=  $price->package_name.': <i class="fa fa-inr"></i>'. $price->slot_package_price.',';}
					
				
		?>

			<tr class="promoted_data text-center" >
				<td><?=$i?></td>
			<td class="text-center date_data_item">
	<p><span class="date_item1 time"><?=date('d-m-Y',strtotime($batchListings->start_date)).' </span><br><span class="date_item1 time"> '.date('d-m-Y',strtotime($batchListings->end_date));?></span></td>
			<td class="text-center date_data_item">
	<p><span class="label_date">Start Time:</span><span class="date_item1 time"><?=$batchListings->start_time.'</span><br><span class="label_date">End Time:</span><span class="date_item1 time"> '.$batchListings->end_time;?></span></td>
			<td><?=$sport_name->sport_name;?></td>

			<td><?=$batchListings->max_participanets;?></td>
			<td class="red"><?=rtrim($price_package,','); ?></td>
			<td><?php $weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$batchListings->batch_slot_id),'batch_slot_weekoff_day',$order_by='');
			$day='';
			 foreach ($weekoff as $value) { 
			 	$day .=  $value->batch_slot_weekoff_day.',';
			}
			echo rtrim($day,',');
			 ?></td>
			 <td style="text-transform:capitalize"></i> <?=$batchListings->fac_batch_slot_status;?></td>
			<td ><a href="JavaScript:Void(0)" class="editbatchform"><i data-toggle="modal" data-target="#editslot" class="fa fa-pencil-square-o"></i><input type="hidden" name="batch_slot_id" name="batch_slot_id" value="<?=$batchListings->batch_slot_id?>"></a>

				<div class="switch">
					<label>
						<input type="checkbox">
						<span class="lever"></span>
					</label>
				</div>
			</td>
			</tr>
<?php } } ?>
</tbody>
</table>

<div class="modal fade edit_profile_modal" id="editslot" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
	<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Batch</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">×</span>
	</button>
	</div>
				<div id="batch_edit_model"></div>
				<div class="modal-footer">
					
				</div>
			</div>

		</div>
	</div>



<script>
	$('.editbatchform').on('click', function(e) {
		 var slot_id = $(this).find("input").val(); 
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		var fac_name =$("#headeracademyfacility option:selected" ).text();
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/batch_edit_model',	
			data: {fac_id:fac_id,slot_id:slot_id,fac_name:fac_name},
			success:function(res){
				$("#batch_edit_model").html(res['_html']);
			}	
		});

});
	$('#facilityacadelisting').DataTable();
</script>
