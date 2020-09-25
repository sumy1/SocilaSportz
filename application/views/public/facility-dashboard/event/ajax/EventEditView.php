  <form action="" name="event_update_form" id="event_update_form" enctype="multipart/form-data">
 <div class="modal-content">
<div class="modal-header">
								<button type="button" style="top:13px;" class="close" data-dismiss="modal">×</button>
								<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Event</h5>
							
								
							</div>
        <div class="modal-body">
        

        <div id="edit_eventpopup" class="container tab-pane active"><br>
          
          <div class="row rest_style">
           <div class="col-md-6">
          <div class="form-group bmd-form-group">
           <label for="Event Name" class="bmd-label-floating">Event Name<span class="required">*</span></label>
           <input type="text" class="form-control" id="event_name1" name="event_name" value="<?php if($event_detail){echo $event_detail->event_name;} ?>">
           <input type="hidden" name="event_id" value="<?php if($event_detail){echo $event_detail->event_id;} ?>">
  <img alt="sports icon" class="sportsimgiconeventname redicon" src="<?=base_url('assets/public/images/eventname_red.png');?>">
          <img alt="sports icon" class="sportsimgiconeventname blueicon" src="<?=base_url('assets/public/images/eventname_blue.png');?>">
           <span id="errName1" class="error"> </span> 
           </div>
         </div>
         <div class="col-md-6">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
          <label for="username1" class="bmd-label-floating "> Choose Sports<span class="required">*</span></label>
          <select class="form-control" style="margin-left:25px;" id="sport_id" name="sport_id">
             <?php 
          if(isset($fac_sports) && $fac_sports!=''){
            foreach ($fac_sports as $sports) { ?>
            <option <?php if($sports->sport_id==$event_detail->sport_id){echo "selected";} ?> value="<?=$sports->sport_id;?>"><?=$sports->sport_name;?></option>
            <?php } } ?>
          </select>
<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
										<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">
						          <!-- <i class="fa fa-facebook prefix"></i> -->
          <span id="erreSport" class="error"> </span>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group  bmd-form-group is-filled">
           <label for="useremail" class="bmd-label-floating">Event Start Date<span class="required">*</span></label>
           <input type="text" class="form-control picker-input datepicker" data-format="d-m-Y" id="event_start_date" name="event_start_date" data-large-mode="true" data-large-default="true" data-id="datedropper-0" readonly="" value="<?php if($event_detail) echo date('d-m-Y', strtotime($event_detail->event_start_date));?>">
           <i class="fa fa-calendar prefix" aria-hidden="true"></i>
           <span id="errEmail" class="error"> </span>
         </div>
         </div>
         <div class="col-md-3">
        <div class="form-group  bmd-form-group is-filled">
         <label for="useremail" class="bmd-label-floating">Event End Date<span class="required">*</span></label>
         <input type="text" data-format="d-m-Y" class="form-control picker-input datepicker" id="event_end_date" name="event_end_date" data-large-mode="true" data-large-default="true" data-id="datedropper-1" readonly="" value="<?php if($event_detail) echo date('d-m-Y', strtotime($event_detail->event_end_date));?>">
         <i class="fa fa-calendar prefix" aria-hidden="true"></i>
         <span id="erreventdate" class="error"> </span>
         </div>
       </div>
       <div class="col-md-3">
        <div class="form-group  bmd-form-group is-filled">
         <label class="bmd-label-floating">Start Timing<span class="required">*</span></label>
         <input type="text" class="clockpicker form-control clockpicker td-input" id="event_start_time" name="event_start_time" onkeypress="validate(event)" readonly="" value="<?php if($event_detail) echo $event_detail->event_start_time;?>">
         <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
         <span id="errEventStartTime" class="error"> </span>
       </div>
       </div>
       <div class="col-md-3">
      <div class="form-group  bmd-form-group is-filled">
       <label for="userphone" class="bmd-label-floating">End Timing<span class="required">*</span></label>
       <input type="text" class="form-control clockpicker td-input" id="event_end_time" name="event_end_time" onkeypress="validate(event)" readonly="" value="<?php if($event_detail) echo$event_detail->event_end_time;?>">
       <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
       <span id="errEventEndTime" class="error"> </span>
       </div>
     </div>
     <div class="col-md-3">
      <div class="form-group  bmd-form-group is-filled">
       <label for="useremail" class="bmd-label-floating datepicker">Start Enrollment Date<span class="required">*</span></label>
       <input type="text" class="form-control picker-input datepicker" data-format="d-m-Y" id="application_start_dates" name="application_start_date" data-large-mode="true" data-large-default="true" data-id="datedropper-2" readonly="" value="<?php if($event_detail) echo date('d-m-Y', strtotime($event_detail->application_start_date));?>">
       <i class="fa fa-calendar prefix" aria-hidden="true"></i>
       <span id="errApplicationStart" class="error"> </span>
     </div>
     </div>
     <div class="col-md-3">
    <div class="form-group  bmd-form-group is-filled">
     <label for="useremail" class="bmd-label-floating"> End Enrollment Date<span class="required">*</span></label>
     <input type="text" data-format="d-m-Y" class="form-control picker-input datepicker" id="application_end_dates" name="application_end_date" data-large-mode="true" data-large-default="true" data-id="datedropper-3" readonly="" value="<?php if($event_detail) echo date('d-m-Y', strtotime($event_detail->application_end_date));?>">
     <i class="fa fa-calendar prefix" aria-hidden="true"></i>
     <span id="errEnrollmentEnds" class="error"> </span>
     </div>
   </div>

   <div class="col-md-3">
    <div class="form-group bmd-form-group">
     <label for="useremail" class="bmd-label-floating"> Event Price<span class="required">*</span></label>
     <input type="text" class="form-control" id="event_price1" name="event_price" value="<?php if($event_detail) echo $event_detail->event_price;?>" onkeypress="validate(event)">
     <i class="fa fa-rupee prefix"></i>
     <span id="errEventPrice1" class="error"> </span>
   </div>
  </div>
  <div class="col-md-3">
    <div class="form-group bmd-form-group">
     <label for="usercity" class="bmd-label-floating">Max Participants<span class="required">*</span></label>
     <input type="text" class="form-control" id="event_max_capicity_per_day1" name="event_max_capicity_per_day" value="<?php if($event_detail) echo $event_detail->event_max_capicity_per_day;?>" onkeypress="validate(event)">
     <i class="fa fa-users prefix" aria-hidden="true"></i>
     <span id="errCapacity1" class="error"> </span>
   </div>
  </div>

  <div class="col-md-3">
    <div class="form-group bmd-form-group">
     <label for="usercity" class="bmd-label-floating">Venue<span class="required">*</span></label>
     <input type="text" class="form-control" name="event_venue" id="event_venue1" value="<?php if($event_detail) echo $event_detail->event_venue;?>">
     <i class="fa fa-map-marker prefix"></i>
     <span id="errVenue1" class="error"> </span>
   </div>
  </div>

  <div class="col-md-3">
    <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">City<span class="required">*</span></label>
    <input type="text" class="google_address form-control" id="event_city1" name="event_city" value="<?php if($event_detail) echo $event_detail->event_city;?>">
    <input type="hidden" class="form-control" id="latitude1" name="latitude" value="<?php if($event_detail) echo $event_detail->event_latitude;?>">
    <input type="hidden" class="form-control" id="longitude1" name="longitude" value="<?php if($event_detail) echo $event_detail->event_longitude;?>">
    <i class="fa fa-map-marker prefix " aria-hidden="true"></i>
    <span id="errCity1" class="error"> </span>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group bmd-form-group">
     <label for="usercity" class="bmd-label-floating">Contact Person Name<span class="required">*</span></label>
     <input type="text" class="form-control" id="event_contact_person1" name="event_contact_person" value="<?php if($event_detail) echo $event_detail->event_contact_person;?>">
     <i class="fa fa-user prefix" aria-hidden="true"></i>
     <span id="errContactPerson1" class="error"> </span>
   </div>
  </div>

  <div class="col-md-3">
    <div class="form-group bmd-form-group">
     <label for="usercity" class="bmd-label-floating">Contact Number<span class="required">*</span></label>
     <input type="text" class="form-control" id="event_contact_person_no1" name="event_contact_person_no" value="<?php if($event_detail) echo $event_detail->event_contact_person_no;?>">
     <i class="fa fa-phone prefix"></i>
     <span id="errContactNumber1" class="error"> </span>
   </div>
  </div>

  <div class="col-md-4">
    <div class="form-group bmd-form-group ">
    <label for="usercity" class="bmd-label-floating">Contact Email<span class="required">*</span></label>
    <input type="text" class="form-control" id="event_contact_person_email1" name="event_contact_person_email" value="<?php if($event_detail) echo $event_detail->event_contact_person_email;?>">
    <i class="fa fa-envelope prefix" aria-hidden="true"></i>
    <span id="errContactEmail1" class="error"> </span>
    </div>
  </div>

   <div class="col-md-4">
    <div class="form-group bmd-form-group is-filled">
    <label  class="bmd-label-floating">Status</label>
   <select id="event_status" name="event_status" class="form-control" style="margin-left:25px;">
          <option value="enable" <?php if($event_detail->event_status=='enable') echo "selected";?>>Enable</option>
          <option value="disable" <?php if($event_detail->event_status=='disable') echo "selected";?>>Disable</option>
      </select> <i class="fa fa-list-alt prefix"></i> 
    </div>
  </div>


  <hr>

  <div class="col-md-4">
    <div class="form-group bmd-form-group is-filled">
     <label for="country" class="bmd-label-floating">Description<span class="required">*</span></label>
     <textarea id="event_description" name="event_description"><?php if($event_detail) echo $event_detail->event_description;?></textarea>
     <!--   <select class="form-control" id="country"> -->
    <!--  <option value="india">India</option> -->
    <!-- </select> -->
    <i class="fa fa-file prefix" aria-hidden="true"></i>
    </div>
  </div>
  <div class="col-md-4">
   <div class="form-group bmd-form-group is-filled">
    <label for="Rule" class="bmd-label-floating">Event Rule<span class="required">*</span></label>
    <textarea id="event_eligibility" name="event_eligibility"> <?php if($event_detail) echo $event_detail->event_eligibility;?></textarea>
    <!--   <select class="form-control" id="country"> --> 
     <!--  <option value="india">India</option> -->
     <!-- </select> -->
     <i class="fa fa-check-square-o prefix" aria-hidden="true"></i>
   </div>
  </div>

  <div class="col-md-4">
    <div class="form-group bmd-form-group is-filled">
   <input type="file" id="input-file-acheivement-1" class="dropify" name="eventbanner" data-default-file="<?=base_url().'assets/public/images/event/banner/'.$event_detail->event_banner;?>"  />
   <input type="hidden" name="old_event_banner" value="<?=$event_detail->event_banner;?>">
    <!-- <p class="dropify-infos-message">Upload Banner</p> -->
    </div>
  
  </div>

  <div class=" container">
    <div class="events-rest">
     <div class="row">
    <div class="col-md-12">
     <p class="para_style">Amenities</p>
     </div>
   </div>
  </div>
  <div class="facility">
   <div class="container">
    <div class="row">
     <div class="col-md-12">
    <div class="ui four column doubling  grid">
     
   
   <?php
    $idArr=array();
            foreach ($event_amenity as $valIdes) { $idArr[]=  $valIdes->amenity_id;
            }
     if(isset($amenity_list) && $amenity_list!=''){
      foreach ($amenity_list as $amenity) { ?>
      <div class="column">
        <div class="ui large label amenity">
         <input class="checkbox amenity_check" type="checkbox" name="amenity[]" id=""  value="<?=$amenity->amenity_id;?>"  <?php if(in_array($amenity->amenity_id, $idArr)){echo "checked";} ?>>
         <img class="ui right spaced image" src="<?=base_url('assets/public/images/amenity/'.$amenity->amenity_icon);?>"><span> <?=$amenity->amenity_name;?></span>
       </div>
     </div>
     <?php } } ?>
     <span id="error_amenity1" class="error"> </span>

  </div>
  </div>

  </div>
  </div>

  </div>

  
  <div class="col-12">

    <button type="button" class="btn btn-default btn-block outline__btn orange-btn gapbtn update_event_data" name="signup" value="Sign Up">
    Save
    <div class="ripple-container"></div>
    </button>
  </div>
  </div>
  </div>





  </div>

</div>
</form>
<script>
  $(".google_address").focusout(function(){
	var hhh = $(".google_address").val();
    if(hhh.indexOf(',') < 0){
	   $(".google_address").val('');
	}
});  
$(".datepicker").dateDropper();
jQuery('.clockpicker').off().timeDropper();
$(".dropify").dropify();

jQuery("#my_events input.datepicker").each(function(){var cdf = jQuery(this).attr("value"); jQuery(this).val(cdf)});
jQuery("#my_events .clockpicker").each(function(){var cdf = jQuery(this).attr("value"); jQuery(this).val(cdf)});

 function isEmailValid(email){
  return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}


 $('.update_event_data').on('click', function(e) {
  var fac_id =$("#headeracademyfacility option:selected" ).val();

  var event_name= $("#event_name1").val();
  
  	var event_start_date  = $("#event_start_date").val();
	var event_end_date = $("#event_end_date").val();


	var application_start_date  = $("#application_start_dates").val();
	var application_end_date = $("#application_end_dates").val();
	
	console.log(application_start_date);
	console.log(application_end_date);




  var event_price= $("#event_price1").val();
  var event_max_capicity_per_day= $("#event_max_capicity_per_day1").val();
  var event_city= $("#event_city1").val();
  var event_venue= $("#event_venue1").val();
  var Event_contact_person= $("#event_contact_person1").val();
  var event_contact_person_no= $("#event_contact_person_no1").val();
  var Event_contact_person_email= $("#Event_contact_person_email1").val();
  //alert(Event_contact_person);
   var amenity_id=[];
   $(".amenity_check:checked").each(function() {
    amenity_id.push($(this).val());
  });
   var amenity_ids = amenity_id.join(',') ;


   if(event_name == ''){
    $('#event_name1').show();
    $('#errName1').html('Please enter name');
    return false;
  }
  else{
    $('#errName1').html('');
  }
  
  
    var endateArr = [];
	var startateArr = [];
	endateArr = event_end_date.split('-');
	startateArr = event_start_date.split('-');
    if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
		$('#erreventdate').html("");
		if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
			$('#erreventdate').html("");
			if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#erreventdate').html("");
			}else{
				$('#erreventdate').show();
				$('#erreventdate').html("End date should be greater than start date");
				 $('html,body').animate({scrollTop: $("#erreventdate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#erreventdate').show();
			$('#erreventdate').html("End date should be greater than start date");
			 $('html,body').animate({scrollTop: $("#erreventdate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#erreventdate').show();
		$('#erreventdate').html("End date should be greater than start date");
		 $('html,body').animate({scrollTop: $("#erreventdate").offset().top - 120},'slow');
		return false;
	}
	
	
	var endateArrApplication = [];
	var startateArrApplication = [];
	endateArrApplication = application_end_date.split('-');
	startateArrApplication = application_start_date.split('-');
	
	if(parseInt(endateArrApplication[0]) <= parseInt(endateArr[0]) && parseInt(endateArrApplication[1]) <= parseInt(endateArr[1]) && parseInt(endateArrApplication[2]) <= parseInt(endateArr[2])){
		$('#errEnrollmentEnds').html("");
	}else{
		$('#errEnrollmentEnds').html("Enroll. end date should be less than event end date");
				$('html,body').animate({scrollTop: $("#errEnrollmentEnds").offset().top - 120},'slow');
		     return false;
	}


	
	if(parseInt(endateArrApplication[2]) >= parseInt(startateArrApplication[2])){
		$('#errEnrollmentEnds').html("");
		if((parseInt(endateArrApplication[1]) >= parseInt(startateArrApplication[1])) ||(parseInt(endateArrApplication[2]) > parseInt(startateArrApplication[2]))){
			$('#errEnrollmentEnds').html("");
			if((parseInt(endateArrApplication[0]) >= parseInt(startateArrApplication[0])) || (parseInt(endateArrApplication[1]) > parseInt(startateArrApplication[1])) || (parseInt(endateArrApplication[2]) > parseInt(startateArrApplication[2]))){
				$('#errEnrollmentEnds').html("");
			}else{
			
				$('#errEnrollmentEnds').show();
				$('#errEnrollmentEnds').html("End date should be greater than start date");
				 $('html,body').animate({scrollTop: $("#errEnrollmentEnds").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#errEnrollmentEnds').show();
			$('#errEnrollmentEnds').html("End date should be greater than start date");
			 $('html,body').animate({scrollTop: $("#errEnrollmentEnds").offset().top - 120},'slow');
			return false;
		}	
	}else{	
		$('#errEnrollmentEnds').show();
		$('#errEnrollmentEnds').html("End date should be greater than start date");
		 $('html,body').animate({scrollTop: $("#errEnrollmentEnds").offset().top - 120},'slow');
		return false;
	}
	
	
	
  
 if(event_price == ''){
    $('#event_price1').show();
    $('#errEventPrice1').html('Please enter price');
    return false;
  }
  else{
    $('#errEventPrice1').html('');
  }

  if(event_max_capicity_per_day == ''){
    $('#event_max_capicity_per_day1').show();
    $('#errCapacity1').html('Please enter capacity');
    return false;
  }
  else{
    $('#errCapacity1').html('');
  }

   if(event_max_capicity_per_day == 0){
    $('#event_max_capicity_per_day1').show();
    $('#errCapacity1').html('Please enter valid capacity');
    return false;
  }
  else{
    $('#errCapacity1').html('');
  }

  if(event_venue == ''){
    $('#event_venue1').show();
    $('#errVenue1').html('Please enter venue');
  }
  else{
    $('#errVenue1').html('');
  }

  if(event_city == ''){
    $('#event_city1').show();
    $('#errCity1').html('Please enter city');
    return false;
  }
  else{
    $('#errCity1').html('');
  }

    if(Event_contact_person == ''){
    $('#Event_contact_person1').show();
    $('#errContactPerson1').html('Please enter contact person name');
    return false;
  }
  else{
    $('#errContactPerson1').html('');
  }

  if(event_contact_person_no == ''){
    $('#event_contact_person_no1').show();
    $('#errContactNumber1').html('Please enter contact person no');
    return false;
  }
  else{
    $('#errContactNumber1').html('');
  }

  if(Event_contact_person_email == ''){
    $('#Event_contact_person_email1').show();
    $('#errContactEmail1').html('Please enter contact person email');
    return false;
  }
  else{
    $('#errContactEmail1').html('');
  }
  /*if (!isEmailValid(Event_contact_person_email)) {

    $('#Event_contact_person_email1').focus();
    $('#errContactEmail1').html('Please enter valid email');
    return false;
  }
  else{
    $('#errContactEmail1').html('');
  }*/

  if(amenity_ids == '')
  {
    $('#error_amenity1').html('Please Select atleast one Amenity');
    return false;
  }

  else
  {
    $('#error_amenity1').html('');  
  }




       var form = $('#event_update_form')[0];
       var myFormData = new FormData(form);
	   showingLoader();

       myFormData.append('action', 'event_update_info');
       $.ajax({
        url:'<?php echo base_url();?>facility/event/update_event_info',
        type: 'POST',
        data: myFormData,
        cache: false,
        processData: false,
        contentType: false,
        async: false,
        success:function(res){

          if(res!='failed'){
			   hiddingLoader();
            swal({
              title : 'Event updated successfully',
              html : '',
              type: 'success'
            }).then((result) => {
              if (result.value) {

               
                    $('#editevent').modal('hide');
                    $('#my_event_table').trigger('click'); 
                 }
               })

          }
          else{
            $('#error_msg').show(); 
            $('#error_msg').text("Network issue"); 
          }           

        } 
      });  

     });
	 
	 $("#edit_eventpopup").niceScroll();
	 jQuery("textarea").each(function(){if(!$(this).text() == ''){jQuery(this).parent().addClass("is-focused")} });
</script>

 <script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

   <script>
   
    /*Google location*/

  function initMap() {
// Create the autocomplete object, restricting the search to geographical
// location types.
autocomplete1 = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */
(document.getElementById('event_city1')),
{types: ['geocode']});

autocomplete1.addListener('place_changed', function() {
//infowindow.close();
var place = autocomplete1.getPlace();
$('#latitude1').val(place.geometry.location.lat());
$('#longitude1').val(place.geometry.location.lng());
});

}


  var addressInputElement = $('#event_city1');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
})

  </script>