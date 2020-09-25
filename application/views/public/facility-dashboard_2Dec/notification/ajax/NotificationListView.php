<style>
th:before, th:after{display:none !important; opacity:0; pointer-events:none}
thead{pointer-events:none}
</style>
<table id="notificationlist">
<thead>
	<th class="text-left"></th>
	<th class="text-right"></th>
</thead>
<?php if (isset($notification_list) && $notification_list!='') {
	foreach ($notification_list as $value) { ?>

	<tr>
	<td class="media">

		<h5 class="title mt-0 mb-1 col-sm-12"><?=$value->notification_title;?> - <?=$value->booking_id;?><br>
		<span class="mailid"><?=$value->booking_email;?></span><br>
			<span class="desc"><?=$value->notification_message;?></span>
		</h5>
		
		
		
	</td>
	<td style="border-bottom: 1px solid #efeeee;" ><small class="float-right"><?=date('d-m-Y',strtotime($value->created_on));?></small></td>
</tr>
		
	<?php }
} ?>


<tbody>
	
</tbody>
</table>
<script>
	$('#notificationlist').DataTable();
</script>