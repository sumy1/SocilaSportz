<style>
#listbookingdetail1{width:1650px;}
</style>
<table class="table1 table-hover table_cust offers_table6" id="listbookingdetail1">
<thead>
<tr class="bg-grey">
	
		<th>S.No</th>
		<th>Booking Id</th>
		<th>Eamil ID</th>
		<th>Contact</th>
		<th>Sports Name</th>
		<th>Slot time</th>
		<th>Amount</th>
		<th>Booking Method</th>
		<th>Booking Status</th>
		<th>Booking start from</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
	<?php $i=0; if(isset($booking_list) && $booking_list!=''){
		foreach ($booking_list as $list) { $i++; ?>
	<tr>
				<td class="text-left">
					<div class="product_container user_enq_detail clearfix">
						<div class="media2">
							<div class="media-body">
								<span class="participants"><?=$i;?></span>
							</div>
						</div>	
					</div>
				</td>
				
				<td class="text-center price_data_item">
					<span class="participants red"><?=$list->booking_order_no;?></span>		
				</td>
		
				
				<td class="text-center date_data_item">
				
					<span class="participants table-darkblue"><?=$list->email;?></span>
				</td>
				<td class="text-center date_data_item">
					
					<span class="participants"><?=$list->mobile;?></span>

				</td>
				
				<td class="text-center price_data_item">
				
					<span class="participants table-darkblue"><?=$list->sport_name;?></span>	
				</td>
				<td class="text-center date_data_item">
        <p><span class="label_date">Start Time:</span><span class="date_item1">
					<span class="time"><?=$list->batch_slot_start_time;?></span>
						</span><br>
           <span class="label_date">End Time:</span><span class="date_item1">
					<span class="time"><?=$list->batch_slot_end_time;?></span>	</span>
				</p>	
				</td>
				
				<td class="text-center price_data_item">
					<span class="participants red"><i class="fa fa-inr"></i> <?=$list->booking_detail_final_amount;?></span>		
				</td>
				<td class="text-center price_data_item">
					<span class="participants"><?=$list->booking_type;?></span>		
				</td>
				<td class="text-center price_data_item">
					<span class="participants"><?=$list->booking_detail_status;?></span>		
				</td>
				<td class="text-center date_data_item"><p>
					<span class="date_item1"><?=date('d-m-Y',strtotime($list->start_date));?></span>
					</p>		
				</td>
				<td class="text-center price_data_item">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#bookingdetaillist" class="view_single_booking"><span class="participants custmer_link1">View</span><input type="hidden" id="order_id" value="<?=$list->booking_order_id;?>"></a>		
				</td>
			</tr>
		<?php }
	} ?>
			
		</tbody>
	</table>

	<div class="modal fade edit_profile_modal" id="bookingdetaillist" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <div id="booking_detail_view"></div>

</div>
</div>
	<script>
		$(".datepicker").dateDropper();
		$('#listbookingdetail1').DataTable();
		
		$(document).on('click','.view_single_booking', function(e) {
		var order_id = $(this).find("input").val();
		showingLoader();
		//var order_id = $(this).find("#order_id").val();
		//alert(order_id);
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/booking_view_model',	
			data: {order_id:order_id},
			success:function(res){
				hiddingLoader();
				$("#booking_detail_view").html(res['_html']);
			}	
		});

});

	</script>