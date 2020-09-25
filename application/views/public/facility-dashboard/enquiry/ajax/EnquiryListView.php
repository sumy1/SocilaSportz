<style>
.custmer_link1{display:block;}
</style>
<table class="table1 table-hover table_cust offers_table2" id="userenquiry">
	<thead>
		<tr class="bg-grey">
			<th>S.No</th>
			<th>User Name</th>
			<th>Email ID</th>
			<!-- <th>Contact No</th> -->
			<th>Message</th>
			<th>Date</th>
			
		</tr>
	</thead>
	<tbody>
	
<?php $i=0; if (isset($enquiry_list) && $enquiry_list!='') {
	foreach ($enquiry_list as $list) { $i++ ?>
		<tr>
			<td class="text-center date_data_item">
				<span class="participants"><?=$i?></span>
			</td>
			<td class="text-left">
				<div class="product_container user_enq_detail clearfix">
					<div class="media2">
						<div class="media-body">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#readMoreModal<?=$i?>"><h5 class="mt-0 product_title table-darkblue"><?=$list->user_name;?></h5></a>
						</div>
					</div>
				</div>
			</td>
			<td class="text-center date_data_item">
				<span class="participants"><?=$list->user_email;?></span>
			</td>
			<!-- <td class="text-center date_data_item">
				<span class="participants"><?=$list->user_mobile;?></span>
			</td> -->
			<td class="text-center date_data_item">
				<span class="participants"><?php echo substr(strip_tags($list->query_message),0,50); ?></span>
				<a href="javascript:void(0)" data-toggle="modal" data-target="#readMoreModal<?=$i?>" class="custmer_link1" title="Click here to view user enquiry"><span><?php if(strlen($list->query_message)>50){echo "Read More...";} ?></span><input type="hidden" value="<?=$list->query_id;?>"></a>

			</td>
			<td class="text-center price_data_item">
				<span class="participants red"><?php echo date('d-m-Y',strtotime($list->create_on));?></span>		
			</td>
		</tr>

		<div class="modal fade modal_default view_deal edit_profile_modal" id="readMoreModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title pl-3" id="exampleModalLongTitle">User Enquiry Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							
							<div class="col-md-12">
								<div class="product_description">
									<div class="user-enq-detail-info">
										

									</div>
									<p class="discription"><?=$list->query_message?></p>

								</div>								
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer text-center">

				</div>
			</div>
		</div>
	</div>
	<?php }
} ?>

		
	</tbody>
</table>
<script>
$('#userenquiry').DataTable();
	</script>