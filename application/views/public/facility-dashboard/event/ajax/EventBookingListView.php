<table class="table1 table-hover table_cust offers_table2" id="bookinglist">
    <thead>
     <tr class="bg-grey">
      <th>S.No</th>
	   <th>Event id</th>
      <th>Event name</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact No</th>
      <th>Price</th>
	  <th>Sport name</th>
	  <th>Payment status</th>
      <th>Event Date</th>
    <th>Action</th>

    </tr>
  </thead>
<?php $i=0;
if(isset($event_booking_list) && !empty($event_booking_list)){
  foreach ($event_booking_list as $booking_list) { $i++ 
 
  ?>
   
  <tbody id="">
<tr class="promoted_data">
    <td class="text-center date_data_item">
     <span class="participants"><?=$i;?></span>
   </td>
      <td class="text-left">
     <div class="product_container user_enq_detail clearfix">
      <div class="media2">
       <div class="media-body">
	 
	   
        <h5 class="mt-0 product_title red"><a data-toggle="modal" data-target="#eventdetaillistusers" class="booking_event_ajax title_dash"><?=$booking_list->booking_order_no;?><input type="hidden" id="event_id" value="<?=$booking_list->booking_order_id;?>"></a></h5>
      </div>
    </div>	
  </div>
</td>
   

   <td class="text-left">
     <div class="product_container user_enq_detail clearfix">
      <div class="media2">
       <div class="media-body">
        <h5 class="mt-0 product_title"><?=$booking_list->event_name;?></h5>
      </div>
    </div>	
  </div>
</td>
<td class="text-center date_data_item">
  <span class="participants"><?=$booking_list->name;?></span>
</td>

<td class="text-center date_data_item">
  <span class="participants table-darkblue"><?=$booking_list->email;?></span>
</td>


<td class="text-center date_data_item">
  <span class="participants"><?=$booking_list->mobile;?></span>
</td>
<td class="text-center date_data_item">
  <span class="participants red"><i class="fa fa-inr"></i> <?=$booking_list->final_amount;?></td>
 
  <td class="text-left">
     <div class="product_container user_enq_detail clearfix">
      <div class="media2">
       <div class="media-body">
        <h5 class="mt-0 product_title"><?=$booking_list->sport_name;?></h5>
      </div>
    </div>	
  </div>
</td>

 
   <td class="text-left">
     <div class="product_container user_enq_detail clearfix">
      <div class="media2">
       <div class="media-body">
        <h5 class="mt-0 product_title"><?=$booking_list->payment_status;?></h5>
      </div>
    </div>	
  </div>
</td>
 <td class="text-center price_data_item">
    <span class="participants red"><?= date('d-m-Y',strtotime($booking_list->booking_on));?></span>	
  </td>
  <td>
    <div class="" style="text-align:center;">
	<a data-toggle="modal" data-target="#eventdetaillistusers" class="booking_event_ajax title_dash"><span class="participants custmer_link1">View</span><input type="hidden" id="event_id" value="<?=$booking_list->booking_order_id;?>"></a></div>
     </td>
</tr>

</tbody>

<?php }

}
 ?>
</table>
<script>

  if($("#event_booking_list td").length == 0){$("#event_booking_list").addClass('nodatalength')}
    else
    {
      $("#event_booking_list").removeClass('nodatalength');
    }

    $("#event_booking_filter").on("click", function(){
 if($("#event_booking_list td").length == 0){$("#event_booking_list").addClass('nodatalength')}
    else
    {
      $("#event_booking_list").removeClass('nodatalength');
    }
    });
    $('#bookinglist').DataTable();
</script>