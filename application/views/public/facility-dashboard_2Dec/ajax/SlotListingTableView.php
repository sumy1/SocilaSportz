<table class="table1 table-hover table_cust offers_table6" id="facilityacadelisting">
<thead>
	<tr class="bg-grey">
		<th>S. No.</th>
		<th>Slot Date</th>
		<th>Slot Timing</th>
		<th>Sport Name</th>
		<th>Categories Added</th>
		<th>Max Person</th>
		<th>Price</th>
		<th>Working day's</th>
		<th>Status</th>
		<th>Action</th>
		
	</tr>
</thead>
<tbody>

<?php $i=0; if(isset($slotListing) && $slotListing) {
	foreach ($slotListing as $slotListings) { $i++;

		$sport_name = $this->CommonMdl->getRow('tbl_sport_list','sport_name',array('sport_id'=>$slotListings->sport_id));
		$label = $this->CommonMdl->getRow('tbl_batch_slot_type','batch_slot_type',array('batch_slot_type_id'=>$slotListings->batch_slot_type_id));
		 $slot_price=$this->CommonMdl->getRow('tbl_slot_package_price','slot_package_price',array('batch_slot_id'=>$slotListings->batch_slot_id));
		?>
		
		
<tr class="promoted_data text-center" >
	<td><?=$i?></td>
<td class="text-center date_data_item">
        <p><span class="date_item1">
        	<?=date('d-m-Y',strtotime($slotListings->start_date));?></span></p>

        <p><span class="date_item1">
        	<?=date('d-m-Y',strtotime($slotListings->end_date));?></span></p>
        </td>

<td class="text-center date_data_item">
	<p><span class="label_date">Start Time:</span><span class="date_item1 time">
 <?=$slotListings->start_time.'</span> <br> <span class="label_date">End Time:</span> <span class="time date_item1"> '.$slotListings->end_time;?></span></td>
<td><?=$sport_name->sport_name;?></td>

<td class="table-darkblue"><?=$label->batch_slot_type;?></td>
<td><?=$slotListings->max_participanets;?></td>
<td class="red"><i class="fa fa-rupee"></i> <?=$slot_price->slot_package_price;?></td>
<td><?php $weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$slotListings->batch_slot_id),'batch_slot_weekoff_day',$order_by='');
$day='';
 foreach ($weekoff as $value) { 
 	$day .=  $value->batch_slot_weekoff_day.',';
}
echo rtrim($day,',');
 ?></td>
 <td style="text-transform:capitalize">
</i> <?=$slotListings->fac_batch_slot_status;?></td>
<td><a href="javascript:void(0)" class="editslotform"><i data-toggle="modal" data-target="#editslot" class="fa fa-pencil-square-o"></i><input type="hidden" name="batch_slot_id" id="batch_slot_id" value="<?=$slotListings->batch_slot_id;?>"></a>

	<div class="switch">
		<label>
			<input type="checkbox">
			<span class="lever"></span>
		</label>
	</div>
</td>
</tr>
<?php }
} ?>
</tbody>
</table>

<div class="modal fade edit_profile_modal" id="editslot" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg">
          
			<!-- Modal content-->
			<div class="modal-content">
				  <div class="modal-header">
	<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Slot</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">×</span>
	</button>
	</div>
				
				<div id="slot_edit_model"></div>
				<div class="modal-footer">
					
				</div>
			</div>

		</div>
	</div>

<script>
	$('.editslotform').on('click', function(e) {
		 var slot_id = $(this).find("input").val(); 
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		var fac_name =$("#headeracademyfacility option:selected" ).text();
		showingLoader();
		
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/slot_edit_model',	
			data: {fac_id:fac_id,slot_id:slot_id,fac_name:fac_name},
			success:function(res){
				hiddingLoader();
				$("#slot_edit_model").html(res['_html']);
			}	
		});

});
	$('#facilityacadelisting').DataTable();
</script>

