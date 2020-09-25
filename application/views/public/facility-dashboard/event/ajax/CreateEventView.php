<div class="content-wrapper content-wrapper--with-bg">
  <!-- Tabbing Event -->
  <form action="" name="event_form" id="event_form" enctype="multipart/form-data">
    <ul class="nav nav-tabs" role="tablist" id="event-management">
     <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#create_event">Create Event</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="my_event_table" data-toggle="tab" href="#my_events">My Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="booking_list1" data-toggle="tab" href="#booking_list">Booked Events</a>
    </li>
  </ul>
  <div class="tab-content">

    <!-- Create Event Tabbing Start Here -->

    <div id="create_event" class="container tab-pane active"><br>
      <div class="row">

       <div class="col-md-6">
        <div class="form-group bmd-form-group" style="margin-top:-6px;">
         <label for="Event Name" class="bmd-label-floating">Event Name<span class="required">*</span></label>
         <input type="text" class="form-control" id="event_name" name="event_name" onkeyup="leftTrim(this)" >
         <img alt="sports icon" class="sportsimgiconeventname redicon" src="<?=base_url('assets/public/images/eventname_red.png');?>">
         <img alt="sports icon" class="sportsimgiconeventname blueicon" src="<?=base_url('assets/public/images/eventname_blue.png');?>">

         <span id="errEventName" class="error"> </span> 
       </div>
     </div>

     <div class="col-md-6">
      <div class="form-group bmd-form-group is-filled">
        <label for="Sport" class="bmd-label-floating " style="margin-left:30px"> Choose Sport<span class="required">*</span></label>
        <select class="form-control" style="margin-left:30px;" id="sport_id" name="sport_id">
          <option value="0">Select Sport</option>
          <?php 
          if(isset($fac_sports) && $fac_sports!=''){
            foreach ($fac_sports as $sports) { ?>
            <option value="<?=$sports->sport_id;?>"><?=$sports->sport_name;?></option>
            <?php } } ?>

          </select>
          <img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
          <img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">

          <!-- <i class="fa fa-facebook prefix"></i> -->
          <span id="errSport" class="error"> </span>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group bmd-form-group">
         <label for="start date" class="bmd-label-floating datepicker">Event Start Date<span class="required">*</span></label>
         <input type="text" class="form-control datepicker" data-format="d-m-Y" id="eventsdate" name="event_start_date" data-large-mode="true" data-large-default="true">
         <i class="fa fa-calendar prefix" aria-hidden="true"></i>
         <span id="erreventstartdate" class="error"> </span>
       </div>
     </div>
     <div class="col-md-3">
      <div class="form-group bmd-form-group">
       <label for="end date" class="bmd-label-floating">Event End Date<span class="required">*</span></label>
       <input type="text" data-format="d-m-Y" class="form-control datepicker" id="eventedate" name="event_end_date" data-large-mode="true" data-large-default="true">
       <i class="fa fa-calendar prefix" aria-hidden="true"></i>
       <span id="errEnddate" class="error"> </span>
     </div>
   </div>

   <div class="col-md-3">
    <div class="form-group bmd-form-group">
     <label  class="bmd-label-floating">Start Time<span class="required">*</span></label>
     <input type="text" class=" clockpicker form-control clockpicker" id="event_start_time" name="event_start_time"  onkeypress="validate(event)">
     <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
     <span id="errStartdate" class="error"> </span>
   </div>
 </div>


 <div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="End date" class="bmd-label-floating">End Time<span class="required">*</span></label>
   <input type="text" class=" form-control clockpicker" id="event_end_time" name="event_end_time"  onkeypress="validate(event)">
   <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
   <span id="errPhone" class="error"> </span>
 </div>
</div>


<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="Enrollment Date" class="bmd-label-floating">Start Enrollment Date<span class="required">*</span></label>
   <input type="text" class="form-control datepicker" data-format="d-m-Y" id="application_start_date" name="application_start_date" data-large-mode="true" data-large-default="true">
   <i class="fa fa-calendar prefix" aria-hidden="true"></i>
   <span id="errEnrollmentStart" class="error"> </span>
 </div>
</div>


<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="useremail" class="bmd-label-floating"> End Enrollment Date<span class="required">*</span></label>
   <input type="text" data-format="d-m-Y" class="form-control datepicker" id="application_end_date" name="application_end_date" data-large-mode="true" data-large-default="true">
   <i class="fa fa-calendar prefix" aria-hidden="true"></i>
   <span id="errEnrollmentEnd" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="Event Price" class="bmd-label-floating"> Event Price<span class="required">*</span></label>
   <input type="text"  class="form-control" id="event_price" name="event_price" onkeypress="validate(event)" >
   <i class="fa fa-rupee prefix"></i>
   <span id="errEventPrice" class="error"> </span>
 </div>
</div>


<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Max Participants<span class="required">*</span></label>
   <input type="text" class="form-control" name="event_max_capicity_per_day" id="event_max_capicity_per_day" onkeypress="validate(event)">
   <i class="fa fa-users prefix" aria-hidden="true"></i>
   <span id="errCapicity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Venue<span class="required">*</span></label>
   <input type="text" class="form-control" name="event_venue" onkeyup="leftTrim(this)" id="event_venue">
   <i class="fa fa-map-marker prefix"></i>
   <span id="errEventVenue" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">City<span class="required">*</span></label>
    <input type="text" class="google_address charvals form-control" onkeyup="leftTrim(this)" name="event_city" id="event_city">
    <input type="hidden" class="form-control" id="latitude" name="latitude">
    <input type="hidden" class="form-control" id="longitude" name="longitude">
    <i class="fa fa-map-marker prefix " aria-hidden="true"></i>
    <span id="errCity" class="error"> </span>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Contact Person Name<span class="required">*</span></label>
   <input type="text" class="charvals form-control" name="Event_contact_person" onkeyup="leftTrim(this)" id="Event_contact_person">
   <i class="fa fa-user prefix" aria-hidden="true"></i>
   <span id="error_contact_person_name" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Contact Number<span class="required">*</span></label>
   <input type="text" class="form-control" id="event_contact_person_no" name="event_contact_person_no" onkeypress="validate(event)">
   <i class="fa fa-phone prefix"></i>
   <span id="error_contact_person_no" class="error"> </span>
 </div>
</div>

<div class="col-md-6">
  <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">Contact Email<span class="required">*</span></label>
    <input type="text" class="form-control" id="Event_contact_person_email" onkeyup="leftTrim(this)" name="Event_contact_person_email">
    <i class="fa fa-envelope prefix" aria-hidden="true"></i>
    <span id="error_contact_person_email" class="error"> </span>
  </div>
</div>

<hr>

<div class="col-md-4">
  <div class="form-group bmd-form-group is-filled">
   <label for="country" class="bmd-label-floating">Description<span class="required">*</span></label>
   <textarea id="event_description" onkeyup="leftTrim(this)" name="event_description"></textarea>
   <span id="rchars">200</span> Character(s) Remaining

   <i class="fa fa-file prefix" aria-hidden="true"></i>
   <span id="errordescription" class="error"></span>
 </div>
</div>


<div class="col-md-4">
 <div class="form-group bmd-form-group is-filled">
  <label for="event rule" class="bmd-label-floating">Event Rule<span class="required">*</span></label>
  <textarea id="event_eligibility" name="event_eligibility" onkeyup="leftTrim(this)"></textarea>

  <i class="fa fa-check-square-o prefix" aria-hidden="true"></i>
  <span id="errorevent" class="error"></span>
</div>
</div>

<div class="col-md-4">
  <div class="form-group bmd-form-group is-filled">
    <input type="file" id="eventbanner" class="dropify" name="eventbanner">
      <span id="erroreventbanner" class="error"></span>
  </div>
  <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1 orange-btn gapbtn"  data-toggle="modal" data-target="#shopGallery" id="successGalleryUpdatebtn" style="float: right;font-weight: 900;">Upload Event Gallery<div class="ripple-container"></div></a>
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
     if(isset($amenity_list) && $amenity_list!=''){
      foreach ($amenity_list as $amenity) { ?>
      <div class="column">
        <div class="ui large label amenity">
         <input class="checkbox" type="checkbox" name="amenity[]" id="amenity_id" value="<?=$amenity->amenity_id;?>">
         <img class="ui right spaced image" src="<?=base_url('assets/public/images/amenity/'.$amenity->amenity_icon);?>"><span> <?=$amenity->amenity_name;?></span>
       </div>
     </div>
     <?php } } ?>
     <span id="error_amenity" class="error"> </span>
   </div>
 </div>

</div>
</div>
</div>
<!-- Model -->
<div class="modal fade modal_default view_deal edit_profile_modal" id="shopGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">       
      <div class="modal-header">
        <h5 class="modal-title pl-3" id="exampleModalLongTitle">Event Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form action="" class="sm_inputs">
            <div class="row">
              <div class="col-md-12">
                <div class="detials_comp upload__docs shopGallery">

                  <ul class="list-inline list_upload_img editUploadImageList1 text-center">
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        <!-- <div class="main-title-upload-image1">
                          <h4>Image 1</h4>
                          <p>JPEG, PNG format only (Max Size : 2MB)</p>
                        </div>  --> 

                        <input type="file" id="input-file-sports-gallery-1" name="gallery[]" class="dropify" />                          

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                      
                        <input type="file" id="input-file-sports-gallery-2" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                      
                        <input type="file" id="input-file-sports-gallery-3" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                      
                        <input type="file" id="input-file-sports-gallery-4" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        
                        <input type="file" id="input-file-sports-gallery-5" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        
                        <input type="file" id="input-file-sports-gallery-6" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        
                        <input type="file" id="input-file-sports-gallery-7" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        
                        <input type="file" id="input-file-sports-gallery-8" name="gallery[]" class="dropify" />

                      </div>
                    </li>
                  </ul>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="add_gallery_img"> Save</a>
              </div>
            </div>
            <span>*JPEG, PNG format only (Max Size : 2MB)</span>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Model End -->





<div class="col-12" >

  <button type="button" id="save_event_data" class="btn btn-default btn-block outline__btn orange-btn gapbtn" name="savevent" value="save event">
    Save
    <div class="ripple-container"></div>
  </button>
</div>

</div>

</form> 
</div>
</div>

<!-- Create Event Tabbing End Her -->

<!-- My Event Tabbing start Her -->

<div id="my_events" class="container tab-pane fade">
  <div class="row">
   <div class="col-md-121">
    <div class="main_container_dashboard">
     <div class="row">
      <div class="col-md-6">
       <div class="stats">
        <ul class="list-inline">
         <li class="list-inline-item">
          <div class="stat-contain no-border clearfix">
           <div class="icon float-left">Total</div>
           <span class="badge badge-primary float-right total_event"></span>
         </div>
       </li>
       <li class="list-inline-item">
        <div class="stat-contain clearfix">
         <div class="icon float-left">Approved</div>
         <span class="badge badge-success float-right total_approved"></span>
       </div>
     </li>
     <li class="list-inline-item">
      <div class="stat-contain clearfix">
       <div class="icon float-left">Pending</div>
       <span class="badge badge-warning float-right total_pending"></span>
     </div>
   </li>
   <li class="list-inline-item">
    <div class="stat-contain clearfix">
     <div class="icon float-left">Rejected</div>
     <span class="badge badge-secondary float-right total_rejected"></span>
   </div>
 </li>
</ul>
</div>
</div>
<div class="col-md-6">
 <ul class="list-inline top_btns_action">
  <li class="list-inline-item">
                  
                  <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn clearbtneventlist" id="clearbtn"><i class="fa fa-refresh"></i> Clear<div class="ripple-container"></div><div class="ripple-container"></div></a>
                </li>
  <li class="list-inline-item">
   <!-- <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter" data-toggle="tooltip" data-placement="top" title="Click here to filter"><i class="fa fa-filter"></i> Filter</a> -->
   <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter</a>
 </li>

</ul>
</div>
</div>

<!-- My Event filter start Her -->

<div class="filter_prodcuts">
 <ul class="list-inline filter_products_list">
  <li class="list-inline-item"><h5 class="title"><i class="fa fa-filter"></i> Filter By</h5></li>
  <li class="list-inline-item col-md-3">
    <div class="form-group bmd-form-group-sm bmd-form-group is-filled" style="margin-top: 5px;">
      <label for="businessName" class="bmd-label-floating">Sports Name</label>
      <select class="form-control" id="sportslist">
        <option selected="" value="">Select sports</option>
        <?php 
        if(isset($fac_sports) && $fac_sports!=''){
          foreach ($fac_sports as $sports) { ?>
          <option value="<?=$sports->sport_id;?>"><?=$sports->sport_name;?></option>
          <?php } } ?>

        </select>
        <img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
        <img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">

      </div>
    </li>
    <li class="list-inline-item col-md-3">
     <div class="form-group bmd-form-group bmd-form-group-sm">
      <label for="businessName" class="bmd-label-floating">From Date<span class="required">*</span></label>
      <input type="text" class="form-control datepicker" id="from_date" data-format="d-m-Y" data-translate-mode="false"  data-large-default="true" data-large-mode="true" data-init-set="false">
      <i class="fa fa-calendar prefix"></i>
    </div>
  </li>
  <li class="list-inline-item col-md-3">
   <div class="form-group bmd-form-group bmd-form-group-sm">
    <label for="businessName" class="bmd-label-floating">To Date<span class="required">*</span></label>
    <input type="text" class="form-control datepicker" id="to_date" data-format="d-m-Y" data-translate-mode="false"  data-large-default="true" data-large-mode="true" data-init-set="false">
    <i class="fa fa-calendar prefix"></i>
	<span id="errortodate" class="error"></span>
  </div>
</li>
<li class="list-inline-item">
 <div class="btn-container">
  <a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn"><i class="fa fa-search"></i> Search</a>
</div>
</li>
</ul>
</div>

<!-- My Event Tabbing End Her -->


<hr>            
<div class="show_datatable1">

  <div class="tab-content1" id="nav-tabContent">
   <div class="tab-pane fade show active" id="activeTab" role="tabpanel" aria-labelledby="activeTab-tab">
    <div class="table-responsive">

     <div id="event_table"></div>


   </div> 

 </div>
</div>
</div>
</div>
</div>
</div>
</div>


<div id="booking_list" class="container tab-pane">
   <div class="row">
    <div class="col-md-12 nopadright" style="padding-left:0">
<div class="main_container_dashboard">
       
 <div class="row">
  <div class="col-md-6">
   <div class="stats">
    <ul class="list-inline">
     <li class="list-inline-item">
      <div class="stat-contain no-border clearfix">
       <div class="icon float-left">Total</div>
       <span class="badge badge-primary float-right"><?=$total_event_count;  ?></span>
     </div>
   </li>
 </ul>
</div>
</div>
<div class="col-md-6 nopadright">
 <ul class="list-inline top_btns_action">
  <li class="list-inline-item">
                  
                  <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn clearbtneventbooking" id="clearbtn"><i class="fa fa-refresh"></i> Clear<div class="ripple-container"></div><div class="ripple-container"></div></a>
                </li>
  <li class="list-inline-item">
   <!-- <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter" data-toggle="tooltip" data-placement="top" title="Click here to filter"><i class="fa fa-filter"></i> Filter</a> -->
   <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter</a>
 </li>

</ul>
</div>
</div>
<div class="row">
<hr>
  <div class="filter_prodcuts">
   <ul class="list-inline filter_products_list">

    <li class="list-inline-item col-md-3">
     <div class="form-group bmd-form-group-sm bmd-form-group is-filled" style="margin-top: 5px;">
      <label for="businessName" class="bmd-label-floating">Sports Name</label>
      <select class="form-control" id="sportslist1">
       <option selected="" value="">Select Sport</option>
       <?php 
        if(isset($fac_sports) && $fac_sports!=''){
          foreach ($fac_sports as $sports) { ?>
          <option value="<?=$sports->sport_id;?>"><?=$sports->sport_name;?></option>
          <?php } } ?>

     </select>
     <img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
     <img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">

   </div>
 </li>

<li class="list-inline-item col-md-2">
 <div class="form-group bmd-form-group-sm bmd-form-group">
  <label for="businessName" class="bmd-label-floating">From Date<span class="required">*</span></label>
  <input type="text" class="form-control datepicker picker-input" id="from_dates" data-translate-mode="false" data-large-default="true" data-format="d-m-Y" data-large-mode="true" data-init-set="false" data-id="datedropper-0" readonly="">
  <i class="fa fa-calendar prefix"></i>
</div>
</li>
<li class="list-inline-item col-md-2">
 <div class="form-group bmd-form-group-sm bmd-form-group">
  <label for="businessName" class="bmd-label-floating">To Date<span class="required">*</span></label>
  <input type="text" class="form-control datepicker picker-input" id="to_dates" data-translate-mode="false" data-format="d-m-Y" data-large-default="true" data-large-mode="true" data-init-set="false" data-id="datedropper-1" readonly="">
  <i class="fa fa-calendar prefix"></i>
  <span id="errortodates" class="error"></span>
</div>
</li>
<li class="list-inline-item col-md-1">
 <div class="btn-container">
  <a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn" id="event_booking_filter"><i class="fa fa-search"></i> Search</a>
</div>
</li>
</ul>
</div>
<div class="table-responsive">
  <div id="event_booking_list"></div>  
</div>
</div>
</div>

<!-- My Events end here -->   


</div>

</div>







</div></div>
</div>
</div>
</div>
<script>
$(".google_address").focusout(function(){
	var hhh = $(".google_address").val();
    if(hhh.indexOf(',') < 0){
	   $(".google_address").val('');
	}
});
$( document).ready(function() {
    $(".charvals").keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });
});

    $('#booking_list1').on('click', function(e) {
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var fac_name =$("#headeracademyfacility option:selected" ).text();
    //alert(fac_id);
    $.ajax({
      type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_booking_list',  
      data: {fac_id:fac_id,fac_name:fac_name},
      success:function(res){
        $("#event_booking_list").html(res['_html']);
      } 
    });

  });

  $('#my_event_table').on('click', function(e) {
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    $.ajax({
      type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_list_table',  
      data: {fac_id:fac_id},
      success:function(res){
        $("#event_table").html(res['_html']);
      } 
    });

    $.ajax({
      type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/eventListingcount', 
      data: {fac_id:fac_id},
      success:function(res){
        var result = JSON.parse(res);
        
        $('.total_event').text(result.total_event_count);
        $('.total_approved').text(result.total_confirmed_event);
        $('.total_pending').text(result.total_pending_event);
        $('.total_rejected').text(result.total_rejected_event);
      } 
    });

  });

  $(document).ready(function() { 
    $(document).on('click', '#add_gallery_img', function(e) {
     $('.modal-backdrop').remove();
     $('#shopGallery').removeClass('in show');
     $('body').removeClass('modal-open');
     $('#shopGallery').hide();
   });
  });

   $('#event_booking_filter').on('click',function(e) {
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var sportslist = $("#sportslist1 option:selected").val();
    var booking_method =$("#booking_method option:selected" ).val();
    var from_date =$("#from_dates" ).val();
    var to_date =$("#to_dates").val();
    //alert(sportslist);
		
		
		 
		if(sportslist == '' && from_date == '' && to_date == ''){
				$('#errortodates').html("Please select atleast one filter option");
				 return false;
			}
			else{
				$('#errortodates').html("");
			}


		 if(from_date!='' && to_date!=''){
		var endateArr = [];
		var startateArr = [];
		endateArr = to_date.split('-');
		startateArr = from_date.split('-');
		
		 if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
			$('#errortodates').html("");
			if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#errortodates').html("");
				if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
					$('#errortodates').html("");
				}else{
					$('#errortodates').show();
					$('#errortodates').html("To date should be greater than from date");
					return false;
				}	
				
				
			}else{
				$('#errortodates').show();
				$('#errortodates').html("To date should be greater than from date");
				return false;
			}	
		}else{
			$('#errortodates').show();
			$('#errortodates').html("To date should be greater than from date");
			return false;
		}
	
	
	}
    action = 'event_booking_filter';
  $.ajax({
    type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_booking_list',  
      data: {fac_id:fac_id,sport_id:sportslist,from_date:from_date,to_date:to_date,action:action},
      success:function(res){
     $("#event_booking_list").html(res['_html']);
      } 
    });

  });

  $('.clearbtneventbooking').on('click', function(e) {
  var fac_id =$("#headeracademyfacility option:selected" ).val();
  $.ajax({
    type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_booking_list',  
      data: {fac_id:fac_id},
      success:function(res){
        $("#event_booking_list").html(res['_html']);
      } 
    });
});
  
  $('.search_btn').on('click', function(e) {
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var sport_id =$("#sportslist option:selected" ).val();
    var from_date =$("#from_date" ).val();
    var to_date =$("#to_date").val();
       if(sport_id == '' && from_date == '' && to_date == ''){
				$('#errortodate').html("Please select atleast one filter option");
				 return false;
			}
			else{
				$('#errortodate').html("");
			}



	
	if(from_date!='' && to_date!=''){
		var endateArr = [];
		var startateArr = [];
		endateArr = to_date.split('-');
		startateArr = from_date.split('-');
		
		 if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
			$('#errortodate').html("");
			if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#errortodate').html("");
				if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
					$('#errortodate').html("");
				}else{
					$('#errortodate').show();
					$('#errortodate').html("To date should be greater than from date");
					return false;
				}	
				
				
			}else{
				$('#errortodate').show();
				$('#errortodate').html("To date should be greater than from date");
				return false;
			}	
		}else{
			$('#errortodate').show();
			$('#errortodate').html("To date should be greater than from date");
			return false;
		}
	
	
	}
	
	



  //alert(from_date);
  
  action='event_filter';
  $.ajax({
    type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_list_table',  
      data: {fac_id:fac_id,sport_id:sport_id,from_date:from_date,to_date:to_date,action:action},
      success:function(res){
        $("#event_table").html(res['_html']);
      } 
    });

});

    $('.clearbtneventlist').on('click', function(e) {
  var fac_id =$("#headeracademyfacility option:selected" ).val();
  $.ajax({
    type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_list_table',  
      data: {fac_id:fac_id},
      success:function(res){
        $("#event_table").html(res['_html']);
      } 
    });
});

</script>

<script type="text/javascript">


 $('.dropify').dropify();
 jQuery("#eventbanner").siblings(".dropify-message").find("p").text("Upload Event Banner");
 $(".datepicker").dateDropper();
 jQuery('.clockpicker').off().timeDropper();

 function isEmailValid(email){
  return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}

$('#save_event_data').on('click', function(e) {
   var fac_id =$("#headeracademyfacility option:selected" ).val();
   var sport_id =$("#sport_id option:selected" ).val();
  
   var event_start_date  = $("#eventsdate").val();
   var event_end_date = $("#eventedate").val();


   var application_start_date  = $("#application_start_date").val();
   var application_end_date = $("#application_end_date").val();
	   
   
  var event_name= $("#event_name").val();
  var event_price= $("#event_price").val();
  var event_max_capicity_per_day= $("#event_max_capicity_per_day").val();
  var event_city= $("#event_city").val();
  var event_venue= $("#event_venue").val();
  var Event_contact_person= $("#Event_contact_person").val();
  var event_contact_person_no= $("#event_contact_person_no").val();
  var Event_contact_person_email= $("#Event_contact_person_email").val();
  var event_description= $("#event_description").val();
  var event_eligibility= $("#event_eligibility").val();
  
  
  	var eventbanner =  $('input[name=eventbanner]').val();
	var extcatgst_image = eventbanner.split('.').pop();
	

  
  
  
   //var amenity= $("#amenity_id").val();
   var amenity_id=[];
   $(".checkbox:checked").each(function() {
    amenity_id.push($(this).val());
  });
   var amenity_ids = amenity_id.join(',') ;




   if(event_name == ''){
    $('#event_name').show();
    $('#errEventName').html('Please enter event name');
    $('html,body').animate({scrollTop: $("#errEventName").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errEventName').html('');
  }

    if(sport_id == '0'){
    $('#sport_id').show();
    $('#errSport').html('Please select sports');
    $('html,body').animate({scrollTop: $("#errSport").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errSport').html('');
  }
  
  
  
  
   var endateArr = [];
	var startateArr = [];
	
	var currentdateArr = [];
	let current_datetime = new Date()
	let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" +  current_datetime.getFullYear()
    currentdateArr = formatted_date.split('-');
	
	endateArr = event_end_date.split('-');
	startateArr = event_start_date.split('-');
	
	
	if(parseInt(startateArr[2]) >= parseInt(currentdateArr[2])){
		$('#erreventstartdate').html("");
		if((parseInt(startateArr[1]) >= parseInt(currentdateArr[1])) ||(parseInt(startateArr[2]) > parseInt(currentdateArr[2]))){
			$('#erreventstartdate').html("");
			if((parseInt(startateArr[0]) >= parseInt(currentdateArr[0])) || (parseInt(startateArr[1]) > parseInt(currentdateArr[1])) || (parseInt(startateArr[2]) > parseInt(currentdateArr[2]))){
				$('#erreventstartdate').html("");
			}else{
				$('#erreventstartdate').show();
				$('#erreventstartdate').html("Start date should be greater than cureent date");
				$('html,body').animate({scrollTop: $("#erreventstartdate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#erreventstartdate').show();
			$('#erreventstartdate').html("Start date should be greater than current date");
			$('html,body').animate({scrollTop: $("#erreventstartdate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#erreventstartdate').show();
		$('#erreventstartdate').html("Start date should be greater than current date");
		$('html,body').animate({scrollTop: $("#erreventstartdate").offset().top - 120},'slow');
		return false;
	}
	
	
	
	
	if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
		$('#errEnddate').html("");
		if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
			$('#errEnddate').html("");
			if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#errEnddate').html("");
			}else{
				$('#errEnddate').show();
				$('#errEnddate').html("End date should be greater than start date");
				 $('html,body').animate({scrollTop: $("#errEnddate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#errEnddate').show();
			$('#errEnddate').html("End date should be greater than start date");
			 $('html,body').animate({scrollTop: $("#errEnddate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#errEnddate').show();
		$('#errEnddate').html("End date should be greater than start date");
		 $('html,body').animate({scrollTop: $("#errEnddate").offset().top - 120},'slow');
		return false;
	}
	
	
	
	var endateArrApplication = [];
	var startateArrApplication = [];
	var currentdateArrs = [];
	
	
	let current_datetimes = new Date()
	let formatted_dates = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetimes.getFullYear()
     currentdateArrs = formatted_dates.split('-');
	endateArrApplication = application_end_date.split('-');
	startateArrApplication = application_start_date.split('-');
	
	if(parseInt(endateArrApplication[0]) <= parseInt(endateArr[0]) && parseInt(endateArrApplication[1]) <= parseInt(endateArr[1]) && parseInt(endateArrApplication[2]) <= parseInt(endateArr[2])){
		$('#errEnrollmentEnd').html("");
	}else{
		$('#errEnrollmentEnd').html("Enroll. end date should be less than event end date");
				$('html,body').animate({scrollTop: $("#errEnrollmentEnd").offset().top - 120},'slow');
		return false;
	}

	if(parseInt(startateArrApplication[2]) >= parseInt(currentdateArrs[2])){
		$('#errEnrollmentStart').html("");
		if((parseInt(startateArrApplication[1]) >= parseInt(currentdateArrs[1])) ||(parseInt(startateArrApplication[2]) > parseInt(currentdateArrs[2]))){
			$('#errEnrollmentStart').html("");
			if((parseInt(startateArrApplication[0]) >= parseInt(currentdateArrs[0])) || (parseInt(startateArrApplication[1]) > parseInt(currentdateArrs[1])) || (parseInt(startateArrApplication[2]) > parseInt(currentdateArrs[2]))){
				$('#errEnrollmentStart').html("");
			}else{
				$('#errEnrollmentStart').show();
				$('#errEnrollmentStart').html("Start date should be greater than cureent date");
				$('html,body').animate({scrollTop: $("#errEnrollmentStart").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#errEnrollmentStart').show();
			$('#errEnrollmentStart').html("Start date should be greater than current date");
			$('html,body').animate({scrollTop: $("#errEnrollmentStart").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#errEnrollmentStart').show();
		$('#errEnrollmentStart').html("Start date should be greater than current date");
		$('html,body').animate({scrollTop: $("#errEnrollmentStart").offset().top - 120},'slow');
		return false;
	}
	
	 
	if(parseInt(endateArrApplication[2]) >= parseInt(startateArrApplication[2])){
		$('#errEnrollmentEnd').html("");
		if((parseInt(endateArrApplication[1]) >= parseInt(startateArrApplication[1])) ||(parseInt(endateArrApplication[2]) > parseInt(startateArrApplication[2]))){
			$('#errEnrollmentEnd').html("");
			if((parseInt(endateArrApplication[0]) >= parseInt(startateArrApplication[0])) || (parseInt(endateArrApplication[1]) > parseInt(startateArrApplication[1])) || (parseInt(endateArrApplication[2]) > parseInt(startateArrApplication[2]))){
				$('#errEnrollmentEnd').html("");
			}else{
				$('#errEnrollmentEnd').show();
				$('#errEnrollmentEnd').html("End date should be greater than start date");
				 $('html,body').animate({scrollTop: $("#errEnrollmentEnd").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#errEnrollmentEnd').show();
			$('#errEnrollmentEnd').html("End date should be greater than start date");
			 $('html,body').animate({scrollTop: $("#errEnrollmentEnd").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#errEnrollmentEnd').show();
		$('#errEnrollmentEnd').html("End date should be greater than start date");
		 $('html,body').animate({scrollTop: $("#errEnrollmentEnd").offset().top - 120},'slow');
		return false;
	}
	

	
	
	
	
	
	
	
  
  
  

  if(event_price == ''){
    $('#errEventPrice').show();
    $('#errEventPrice').html('Please enter price');
    $('html,body').animate({scrollTop: $("#errEventPrice").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errEventPrice').html('');
  }

  if(event_max_capicity_per_day == ''){
    $('#event_max_capicity_per_day').show();
    $('#errCapicity').html('Please enter capacity');
    $('html,body').animate({scrollTop: $("#errCapicity").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errCapicity').html('');
  }
  if(event_max_capicity_per_day == 0){
    $('#event_max_capicity_per_day').show();
    $('#errCapicity').html('Please enter valid capacity');
    $('html,body').animate({scrollTop: $("#errCapicity").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errCapicity').html('');
  }

  if(event_venue == ''){
    $('#event_venue').show();
    $('#errEventVenue').html('Please enter venue');
    $('html,body').animate({scrollTop: $("#errEventVenue").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errEventVenue').html('');
  }

  if(event_city == ''){
    $('#event_city').show();
    $('#errCity').html('Please enter city');
    $('html,body').animate({scrollTop: $("#errCity").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#errCity').html('');
  }

  if(Event_contact_person == ''){
    $('#Event_contact_person').show();
    $('#error_contact_person_name').html('Please enter contact person name');
    $('html,body').animate({scrollTop: $("#error_contact_person_name").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#error_contact_person_name').html('');
  }

  if(event_contact_person_no == ''){
    $('#event_contact_person_no').show();
    $('#error_contact_person_no').html('Please enter contact person no');
    $('html,body').animate({scrollTop: $("#error_contact_person_no").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#error_contact_person_no').html('');
  }

  if(Event_contact_person_email == ''){
    $('#Event_contact_person_email').show();
    $('#error_contact_person_email').html('Please enter contact person email');
    $('html,body').animate({scrollTop: $("#error_contact_person_email").offset().top - 120},'slow');
    return false;
  }
  else{
    $('#error_contact_person_email').html('');
  }
  if (!isEmailValid(Event_contact_person_email)) {

    $('#Event_contact_person_email').focus();
    $('#error_contact_person_email').html('Please enter valid email');
    $('html,body').animate({scrollTop: $("#error_contact_person_email").offset().top - 240},'slow');
    return false;
  }
  else{
    $('#error_contact_person_email').html('');
  }
  
  if(event_description == ''){
	    $('#errordescription').focus();
	   $('#errordescription').html('Please enter description');
	   return false;
  }else{
	  $('#errordescription').html('');
  }
  if(event_eligibility == ''){
	      $('#errorevent').focus();
	      $('#errorevent').html('Please enter event rule');
	   return false;
  }else{
	  $('#errorevent').html('');
  }
  
  if(eventbanner == ''){
	   $('#erroreventbanner').html('Please attach event banner image');
	   return false;
  }
  else{
	   $('#erroreventbanner').html('');
  }

  
  if(eventbanner!=''){
		 var image_size=parseFloat($("#eventbanner")[0].files[0].size / 1024).toFixed(2);
		 
		if(image_size>500){
			   $('#erroreventbanner').html('Please attach image below 500 kb');
			   $('html,body').animate({scrollTop: $("#erroreventbanner").offset().top - 200},'slow');
			   return false;
		}
		else{
			 $('#erroreventbanner').html('');
		}
		if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
			$('#erroreventbanner').html('Please attach image in png , jpg or jpeg format only');
			$('html,body').animate({scrollTop: $("#erroreventbanner").offset().top - 200},'slow');
		return false; 
		}
		 else{
			$('#erroreventbanner').html('');
		}
	}
			 
			 
			 
			 
			 
 

  if(amenity_ids == '')
  {
    $('#error_amenity').html('Please Select atleast one Amenity');
    return false;
  }

  else
  {
    $('#error_amenity').html('');  
  }



       // alert(fac_id);
       var form = $('#event_form')[0];
       var myFormData = new FormData(form);

       myFormData.append('action', 'event_form');
       myFormData.append('fac_id', fac_id);
       showingLoader();
       $.ajax({
        url:'<?php echo base_url();?>facility/event/insert_event',
        type: 'POST',
        data: myFormData,
        cache: false,
        processData: false,
        contentType: false,
        async: false,
        success:function(res){

          if(res!='failed'){
           hiddingLoader()
           swal({
            title : 'Event added successfully!',
            html : '',
            type: 'success'
          }).then((result) => {
            if (result.value) {

              $('#event_name').val('');
              $('#event_price').val('');
              $('#event_venue').val('');
              $('#event_max_capicity_per_day').val('');
              $('#event_city').val('');
              $('#Event_contact_person').val('');
              $('#event_contact_person_no').val('');
              $('#Event_contact_person_email').val('');
              $('#event_description').val('');
              $('#event_eligibility').val('');
                //$('#event_start_date').val('');
                //$('#event_end_time').val('');
                $(".dropify-clear").trigger("click");
                $('.checkbox').prop('checked', false);
                   // $('#editslot').modal('hide');
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
(document.getElementById('event_city')),
{types: ['geocode']});

autocomplete1.addListener('place_changed', function() {
//infowindow.close();
var place = autocomplete1.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});

}


  var addressInputElement = $('#event_city');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
})

  </script>