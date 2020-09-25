

<?php $i=0;
if(isset($event_booking_list) && !empty($event_booking_list)){
  foreach ($event_booking_list as $booking_list) { $i++ ?>
  
<tr class="promoted_data">
    <td class="text-center date_data_item">
     <span class="participants"><?=$i;?></span>
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
  <td class="text-center price_data_item">
    <span class="participants red"><?= date('d-m-Y',strtotime($booking_list->booking_on));?></span>	
  </td>
</tr>
<?php }

}

else{ ?>
  <span class="">No data available</span>
<?php }
 ?>


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
</script>