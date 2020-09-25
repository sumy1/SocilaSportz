<div class="calandaruserdetail" id="" data-toggle="buttons">
<h5 style="font-size:16px; margin-bottom:10px;">User Details</h5>
<div class="table-responsive">

	<table class="table1 table-hover table_cust offers_table2" id="calandaruserenquiry">
		<thead>
			<tr class="bg-grey">

				
				<th>Booking ID</th>						
				<th>Name</th>
				<th>Mobile No.</th>
				<!-- <th>Amount</th> -->
				<th>Booking Status</th>

			</tr>
		</thead>
		<tbody >
			<?php if (isset($order_user_detail) && !empty($order_user_detail)){
				foreach ($order_user_detail as $order_user_details) { ?>
				
				
			<tr class="promoted_data">
				



				<td class="text-center date_data_item red">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#bookingdetaillist" class="view_single_booking"><span class="participants custmer_link1"><?=$order_user_details->booking_order_no;?></span><input type="hidden" id="order_id" value="<?=$order_user_details->booking_order_id;?>"></a>
				</td>
				
				<td class="text-center date_data_item"><?=$order_user_details->name;?></td>


				<td class="text-center price_data_item">
					<span class="participants red"><?=$order_user_details->mobile;?></span>	
				</td>

				<!-- <td class="text-center price_data_item">
					<span class="participants red"><?=$order_user_detail[0]->final_amount;?></span>	
				</td> -->

				<td class="text-center price_data_item">
					<span class="participants red"><?=$order_user_details->booking_status;?></span>	
				</td>

				<td></td>	
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
</div>
</div>
<script>
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