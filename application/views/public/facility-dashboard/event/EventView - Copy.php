  <!DOCTYPE html>
  <html>
  <head>
  	<title>Social Sportz</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
  	<meta name="MobileOptimized" content="width">
  	<meta name="HandheldFriendly" content="true">
  	<meta http-equiv="x-ua-compatible" content="IE=edge">
  	<!-- Fonts For Heading & SubHeadings -->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  	
  	<?php $this->load->view('public/common/head');?>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
  	<link rel="stylesheet" href="assets/css/styles.css">
  	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/pignose.calendar.min.css');?>">
  	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/bootstrap-clockpicker.min.css');?>">
  	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/jquery-clockpicker.min.css');?>">
  	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/timedropper.min.css');?>">
  	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css');?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css');?>">
  </head>


  <body class="dashboard sidebar-is-expanded" id="createevent">
  	<div class="clearfix"></div>
  	<?php $this->load->view('public/common/dashboard-sidebar');?>

  	<main class="l-main">
      <div class="header-data">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="top-head-nav clearfix">
                <div class="page-title float-md-left">
                  <h2>Create Event </h2>
                </div>
                <div class="navigation-bread float-md-right">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb"> 
                      <li class="breadcrumb-item"><a href="dashboard-new1.php">My Dashboard</a></li>  
                      <li class="breadcrumb-item active" aria-current="page">Create Event</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>





      <div class="content-wrapper content-wrapper--with-bg">
        <form action="">
          <ul class="nav nav-tabs" role="tablist" id="event-management">
           <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#create_event">Creat Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#my_events">My Events</a>
          </li>
        </ul>
        <div class="tab-content">
         <div id="create_event" class="container tab-pane active"><br>
          <div class="row rest_style">
           <div class="col-md-6">
            <div class="form-group">
             <label for="username1" class="bmd-label-floating">Event Name</label>
             <input type="text" class="form-control " >
             <i class="fa fa-user prefix"></i>
             <span id="errName1" class="error"> </span>	
           </div>
         </div>
         <div class="col-md-6">
          <div class="form-group">
            <label for="username1" class="bmd-label-floating "> Choose Sport</label>
            <select class="form-control" style="margin-left:30px;">
              <option value="Cricket">Cricket</option>
              <option value="Cricket">Football</option>
            </select>
            <i class="fa fa-futbol-o prefix" aria-hidden="true"></i>
            <!-- <i class="fa fa-facebook prefix"></i> -->
            <span id="errName1" class="error"> </span>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
           <label for="useremail" class="bmd-label-floating datepicker">Event Start Date</label>
           <input type="text" class="form-control" data-format="d-m-Y" id="eventsdate" data-large-mode="true" data-large-default="true">
           <i class="fa fa-calendar prefix" aria-hidden="true"></i>
           <span id="errEmail" class="error"> </span>
         </div>
       </div>
       <div class="col-md-3">
        <div class="form-group">
         <label for="useremail" class="bmd-label-floating">Event End Date</label>
         <input type="text" data-format="d-m-Y" class="form-control" id="eventedate" data-large-mode="true" data-large-default="true">
         <i class="fa fa-calendar prefix" aria-hidden="true"></i>
         <span id="errEmail" class="error"> </span>
       </div>
     </div>
     <div class="col-md-3">
      <div class="form-group">
       <label  class="bmd-label-floating">Start Timing</label>
       <input type="text" class=" clockpicker form-control clockpicker"  onkeypress="validate(event)">
       <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
       <span id="errPhone" class="error"> </span>
     </div>
   </div>
   <div class="col-md-3">
    <div class="form-group">
     <label for="userphone" class="bmd-label-floating">End Timing</label>
     <input type="text" class=" form-control clockpicker"  onkeypress="validate(event)">
     <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
     <span id="errPhone" class="error"> </span>
   </div>
 </div>
 <div class="col-md-3">
  <div class="form-group">
   <label for="useremail" class="bmd-label-floating datepicker">Start Enrollment Date</label>
   <input type="text" class="form-control" data-format="d-m-Y" id="bookingsdate" data-large-mode="true" data-large-default="true">
   <i class="fa fa-calendar prefix" aria-hidden="true"></i>
   <span id="errEmail" class="error"> </span>
 </div>
</div>
<div class="col-md-3">
  <div class="form-group">
   <label for="useremail" class="bmd-label-floating"> End Enrollment Date</label>
   <input type="text" data-format="d-m-Y" class="form-control" id="bookingedate" data-large-mode="true" data-large-default="true">
   <i class="fa fa-calendar prefix" aria-hidden="true"></i>
   <span id="errEmail" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group">
   <label for="useremail" class="bmd-label-floating"> Event Price</label>
   <input type="text"  class="form-control" id="eventprice" >
   <i class="fa fa-rupee prefix"></i>
   <span id="errEmail" class="error"> </span>
 </div>
</div>
<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Max Participants</label>
   <input type="text" class="form-control">
   <i class="fa fa-users prefix" aria-hidden="true"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Venue</label>
   <input type="text" class="form-control">
   <i class="fa fa-map-marker prefix"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">City</label>
    <input type="text" class="form-control">
    <i class="fa fa-map-marker prefix " aria-hidden="true"></i>
    <span id="errCity" class="error"> </span>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Contact Person Name</label>
   <input type="text" class="form-control">
   <i class="fa fa-user prefix" aria-hidden="true"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Contact Number</label>
   <input type="text" class="form-control">
   <i class="fa fa-phone prefix"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-4">
  <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">Contact Email</label>
    <input type="text" class="form-control">
    <i class="fa fa-envelope prefix" aria-hidden="true"></i>
    <span id="errCity" class="error"> </span>
  </div>
</div>



<hr>




<div class="col-md-4">
  <div class="form-group bmd-form-group is-filled">
   <label for="country" class="bmd-label-floating">Description</label>
   <textarea id="textacademy"></textarea>
   <span id="rchars">200</span> Character(s) Remaining
   <!--   <select class="form-control" id="country"> -->
    <!--  <option value="india">India</option> -->
    <!-- </select> -->
    <i class="fa fa-file prefix" aria-hidden="true"></i>
  </div>
</div>
<div class="col-md-4">
 <div class="form-group bmd-form-group is-filled">
  <label for="country" class="bmd-label-floating">Event Rule</label>
  <textarea id="textacademy"></textarea>
  <!--   <select class="form-control" id="country"> --> 
   <!--  <option value="india">India</option> -->
   <!-- </select> -->
   <i class="fa fa-check-square-o prefix" aria-hidden="true"></i>
 </div>
</div>

<div class="col-md-4">
  <div class="form-group bmd-form-group is-filled">
    <input type="file" id="eventbanner" class="dropify">
    <!-- <p class="dropify-infos-message">Upload Banner</p> -->
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
     <div class="column">
      <div class="ui large label amenity">
       <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
       <img class="ui right spaced image" src="assets/images/parking.svg"><span>Parking</span>
     </div>
   </div>
   <div class="column">
    <div class="ui large label amenity">
     <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
     <img class="ui right spaced image" src="assets/images/dressingroom.svg"><span> Dressing room</span>
   </div>
 </div>
 <div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/firstaidkit.svg"><span>First aid kit</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/restrooms.svg"><span>Restrooms</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/earth (1).svg"><span>Power backup</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/lockers.svg"><span> Lockers</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/beverages.svg"><span>Beverages</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/shower.svg"><span> Shower</span>
 </div>
</div>
</div>
</div>

</div>
</div>

</div>
<div class="col-12" >

  <button type="submit" id="register_submit" class="btn btn-default btn-block outline__btn orange-btn gapbtn" name="signup" value="Sign Up">
    Save
    <div class="ripple-container"></div>
  </button>
</div>
</div>
</div>
</div>



<div id="my_events" class="container tab-pane fade"><br>
  <div class="row">
   <div class="col-md-12">
    <div class="main_container_dashboard">
     <div class="row">
      <div class="col-md-6">
       <div class="stats">
        <ul class="list-inline">
         <li class="list-inline-item">
          <div class="stat-contain no-border clearfix">
           <div class="icon float-left">Total</div>
           <span class="badge badge-primary float-right">100</span>
         </div>
       </li>
       <li class="list-inline-item">
        <div class="stat-contain clearfix">
         <div class="icon float-left">Approved</div>
         <span class="badge badge-success float-right">75</span>
       </div>
     </li>
     <li class="list-inline-item">
      <div class="stat-contain clearfix">
       <div class="icon float-left">Pending</div>
       <span class="badge badge-warning float-right">25</span>
     </div>
   </li>
   <li class="list-inline-item">
    <div class="stat-contain clearfix">
     <div class="icon float-left">Rejected</div>
     <span class="badge badge-secondary float-right">02</span>
   </div>
 </li>
</ul>
</div>
</div>
<div class="col-md-6">
 <ul class="list-inline top_btns_action">
  <li class="list-inline-item">
   <!-- <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter" data-toggle="tooltip" data-placement="top" title="Click here to filter"><i class="fa fa-filter"></i> Filter</a> -->
   <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter</a>
 </li>
  									
  									</ul>
  								</div>
  							</div>

  							<!-- <div class="filter_prodcuts" style="display: none;"> -->
  								<div class="filter_prodcuts">
  									<ul class="list-inline filter_products_list">
  										<li class="list-inline-item"><h5 class="title"><i class="fa fa-filter"></i> Filter By</h5></li>
  										<li class="list-inline-item col-md-3">
  											<div class="form-group bmd-form-group-sm">
  												<label for="businessName" class="bmd-label-floating">Event Name</label>
  												<input type="text" class="form-control" id="businessName">
  												<i class="fas fa-percentage prefix"></i>
  											</div>
  										</li>
  										<li class="list-inline-item col-md-3">
  											<div class="form-group bmd-form-group-sm">
  												<label for="businessName" class="bmd-label-floating">From Date</label>
  												<input type="text" class="form-control datepicker" id="date-start" data-translate-mode="false" data-modal="true" data-large-default="true" data-large-mode="true" data-init-set="false">
  												<i class="fa fa-calendar prefix"></i>
  											</div>
  										</li>
  										<li class="list-inline-item col-md-3">
  											<div class="form-group bmd-form-group-sm">
  												<label for="businessName" class="bmd-label-floating">To Date</label>
  												<input type="text" class="form-control datepicker" id="date-start" data-translate-mode="false" data-modal="true" data-large-default="true" data-large-mode="true" data-init-set="false">
  												<i class="fa fa-calendar prefix"></i>
  											</div>
  										</li>
  										<li class="list-inline-item">
  											<div class="btn-container">
  												<a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn"><i class="fa fa-search"></i> Search</a>
  											</div>
  										</li>
  									</ul>
  								</div>		
  								<hr>						
  								<div class="show_datatable1">
  					
  								<div class="tab-content1" id="nav-tabContent">
  									<div class="tab-pane fade show active" id="activeTab" role="tabpanel" aria-labelledby="activeTab-tab">
  										<div class="table-responsive">




                        

  											<table class="table1 table-hover table_cust offers_table1" id="createeventlist">
  												<thead>
  													<tr class="bg-grey">
  														
  														<th>S.No</th>
  														<th>Event Name</th>
                              <th style="width: 15%">Booking Date</th>
                              <th  style="width: 15%">Event Date</th>
                              <th>Event Timing</th>
                              <th>Max Participant</th>
                              <th>Venue</th>
                              <th>Fees</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           <tr class="promoted_data">
                            <td class="text-center price_data_item">	
                             <span class="participants">1</span>	
                           </td>
  														<!-- <td>
  															<div class="checkbox1 small_checkbox">
  																<label>
  																	<input type="checkbox" class="selectcheck">
  																</label>
  															</div>
  														</td> -->
  														<td class="text-left">
  															<div class="product_container clearfix">
  																<div class="media1">
  																	<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><img class="align-self-start mr-3" src="https://placeimg.com/64/64/tech" alt=""></a>
  																	<div class="media-body">
  																		<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><h5 class="mt-0 product_title">Delhi Marathon</h5></a>
  																		
  																	</div>
  																</div>	
  															</div>
  														</td>

  														<td class="text-center date_data_item">
  															<p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/05/2019</span></p>
  															<p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/06/2019</span></p>
  														</td>
                              <td class="text-center date_data_item">
                                <p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 06/05/2019</span></p>
                                <p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 11/06/2019</span></p>
                              </td>


                              <td class="text-center date_data_item">
                               <p><span class="label_date">Start Time:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 2:00 PM</span></p>
                               <p><span class="label_date">End Time:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 3:00 PM</span></p>	

                             </td>
                             <td class="text-center price_data_item">
                               <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#dealAvailedModal" class="custmer_link" title="Click here to view customer list"><span>12</span></a> -->	
                               <span class="participants">12</span>	
                             </td>
                             <td class="text-center price_data_item">
                               <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#dealAvailedModal" class="custmer_link" title="Click here to view customer list"><span>Noida Stadium</span></a> -->
                               <span class="participants">Noida Stadium</span>
                             </td>
                             <td class="text-center price_data_item">
                               <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#dealAvailedModal" class="custmer_link" title="Click here to view customer list"><span>500</span></a> -->
                               <span class="participants">500</span>
                             </td>
                             <td class="text-center price_data_item">
                               <a href="javascript:void(0)" data-toggle="modal" data-target="#editevent" class="custmer_link1" title="Click here to view customer list"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
                             </td>
                           </tr>
                           <tr class="promoted_data">
                            <td class="text-center price_data_item">	
                             <span class="participants">2</span>	
                           </td>
  														<!-- <td>
  															<div class="checkbox1 small_checkbox">
  																<label>
  																	<input type="checkbox" class="selectcheck">
  																</label>
  															</div>
  														</td> -->
  														<td class="text-left">
  															<div class="product_container clearfix">
  																<div class="media1">
  																	<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><img class="align-self-start mr-3" src="https://placeimg.com/64/64/arch" alt=""></a>
  																	<div class="media-body">
  																		<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><h5 class="mt-0 product_title">Delhi Bycycle Marathon</h5></a>
  																		
  																	</div>
  																</div>
  															</div>
  														</td>
  														<td class="text-center date_data_item">
  															<p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/05/2019</span></p>
  															<p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/06/2019</span></p>
  														</td>
                              <td class="text-center date_data_item">
                                <p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 06/05/2019</span></p>
                                <p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 11/06/2019</span></p>
                              </td>
                              <td class="text-center date_data_item">
                               <p><span class="label_date">Start Time</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 2:00 PM</span></p>
                               <p><span class="label_date">End Time</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 3:00 PM</span></p>	
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">14</span>		
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">Noida Stadium</span>
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">500</span>
                             </td>
                             <td class="text-center price_data_item">
                               <a href="javascript:void(0)" data-toggle="modal" data-target="#editevent" class="custmer_link1" title="Click here to view customer list"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
                             </td>
                           </tr>
                           <tr class="promoted_data">
                            <td class="text-center price_data_item">	
                             <span class="participants">3</span>	
                           </td>
  														<!-- <td>
  															<div class="checkbox1 small_checkbox">
  																<label>
  																	<input type="checkbox" class="selectcheck">
  																</label>
  															</div>
  														</td> -->
  														<td class="text-left">
  															<div class="product_container clearfix">
  																<div class="media1">
  																	<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><img class="align-self-start mr-3" src="https://placeimg.com/64/64/nature" alt=""></a>
  																	<div class="media-body">
  																		<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><h5 class="mt-0 product_title">Basket Ball</h5></a>
  																		
  																	</div>
  																</div>
  															</div>
  														</td>
  														<td class="text-center date_data_item">
  															<p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/05/2019</span></p>
  															<p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/06/2019</span></p>
  														</td>
                              <td class="text-center date_data_item">
                                <p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 06/05/2019</span></p>
                                <p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 11/06/2019</span></p>
                              </td>
                              <td class="text-center date_data_item">
                               <p><span class="label_date">Start Time</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 2:00 PM</span></p>
                               <p><span class="label_date">End Time</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 3:00 PM</span></p>
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">13</span>
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">Noida Stadium</span>
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">500</span>
                             </td>
                             <td class="text-center price_data_item">
                               <a href="javascript:void(0)" data-toggle="modal" data-target="#editevent" class="custmer_link1" title="Click here to view customer list"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
                             </td>
                           </tr>

                           <tr>
                            <td class="text-center price_data_item">	
                             <span class="participants">4</span>	
                           </td>
  													<!-- 	<td>
  															<div class="checkbox1 small_checkbox">
  																<label>
  																	<input type="checkbox" class="selectcheck">
  																</label>
  															</div>
  														</td> -->
  														<td class="text-left">
  															<div class="product_container clearfix">
  																<div class="media1">
  																	<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><img class="align-self-start mr-3" src="https://placeimg.com/64/64/animals" alt=""></a>
  																	<div class="media-body">
  																		<a href="javascript:void(0)" data-toggle="modal" data-target="#editevent"><h5 class="mt-0 product_title">Cricket Tournament</h5></a>
  																		
  																	</div>
  																</div>
  															</div>
  														</td>
  														<td class="text-center date_data_item">
  															<p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/05/2019</span></p>
  															<p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 12/06/2019</span></p>
  														</td>
                              <td class="text-center date_data_item">
                                <p><span class="label_date">From:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 06/05/2019</span></p>
                                <p><span class="label_date">To:</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 11/06/2019</span></p>
                              </td>
                              <td class="text-center date_data_item">
                               <p><span class="label_date">Start Time</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 2:00 PM</span></p>
                               <p><span class="label_date">End Time</span>  <span class="date_item1"><i class="far fa-calendar-alt"></i> 3:00 PM</span></p>	

                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">20</span>		
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">Noida Stadium</span>
                             </td>
                             <td class="text-center price_data_item">
                               <span class="participants">500</span>
                             </td>
                             <td class="text-center price_data_item">
                               <a href="javascript:void(0)" data-toggle="modal" data-target="#editevent" class="custmer_link1" title="Click here to view customer list"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
                             </td>
                           </tr>
                         </tbody>
                       </table>


                     </div> 

                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </form>
</div>


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
                              <div class="main-title-upload-image1">
                                <h4>Image 1</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>  

                              <input type="file" id="input-file-sports-gallery-1" class="dropify" />                          

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 2</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-2" class="dropify" />

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 3</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-3" class="dropify" />

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 4</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-4" class="dropify" />

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 5</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-5" class="dropify" />

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 6</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-6" class="dropify" />

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 7</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-7" class="dropify" />

                            </div>
                          </li>
                          <li class="list-inline-item">
                            <div class="main-img-container">
                              <div class="main-title-upload-image1">
                                <h4>Image 8</h4>
                                <p>JPEG, PNG format only (Max Size : 2MB)</p>
                              </div>
                              <input type="file" id="input-file-sports-gallery-8" class="dropify" />

                            </div>
                          </li>
                        </ul>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successGalleryUpdatebtn"> Save</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



  
  </div>
</div> 
</main>

<!-- Footer Include Here -->
<?php $this->load->view('public/common/footer');?>

<p style="display: none" id = "status"></p>
<a id = "map-link" target="_blank"></a>
</div>

<?php $this->load->view('public/common/foot');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/dropify.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/public/js/pignose.calendar.min.js');?>"></script>
  <!-- <script type="text/javascript" src="assets/js/jquery-clockpicker.min.js"></script>
  	<script type="text/javascript" src="assets/js/bootstrap-clockpicker.min.js"></script> -->

  	<script type="text/javascript" src="<?=base_url('assets/public/js/timedropper.min.js');?>"></script>




    <!-- Modal -->
    <div class="modal fade" id="editevent" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          <div class="modal-body">
            <h5 style="
            text-align: center;
            ">Edit Event</h5>
            <button type="button" class="close" data-dismiss="modal" style="margin-top: -36px;">&times;</button>
            <div id="edit_eventpopup" class="container tab-pane active"><br>

              <div class="row rest_style">
               <div class="col-md-6">
                <div class="form-group bmd-form-group">
                 <label for="username1" class="bmd-label-floating">Event Name</label>
                 <input type="text" class="form-control ">
                 <i class="fa fa-user prefix"></i>
                 <span id="errName1" class="error"> </span> 
               </div>
             </div>
             <div class="col-md-6">
              <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                <label for="username1" class="bmd-label-floating "> Choose Sport</label>
                <select class="form-control" style="margin-left:30px;">
                  <option value="Cricket">Cricket</option>
                  <option value="Cricket">Football</option>
                </select>
                <i class="fa fa-futbol-o prefix" aria-hidden="true"></i>
                <!-- <i class="fa fa-facebook prefix"></i> -->
                <span id="errName1" class="error"> </span>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group is-focused bmd-form-group is-filled">
               <label for="useremail" class="bmd-label-floating datepicker">Event Start Date</label>
               <input type="text" class="form-control picker-input" data-format="d-m-Y" id="eventsdate" data-large-mode="true" data-large-default="true" data-id="datedropper-0" readonly="">
               <i class="fa fa-calendar prefix" aria-hidden="true"></i>
               <span id="errEmail" class="error"> </span>
             </div>
           </div>
           <div class="col-md-3">
            <div class="form-group is-focused bmd-form-group is-filled">
             <label for="useremail" class="bmd-label-floating">Event End Date</label>
             <input type="text" data-format="d-m-Y" class="form-control picker-input" id="eventedate" data-large-mode="true" data-large-default="true" data-id="datedropper-1" readonly="">
             <i class="fa fa-calendar prefix" aria-hidden="true"></i>
             <span id="errEmail" class="error"> </span>
           </div>
         </div>
         <div class="col-md-3">
          <div class="form-group is-focused bmd-form-group is-filled">
           <label class="bmd-label-floating">Start Timing</label>
           <input type="text" class="clockpicker form-control clockpicker td-input" onkeypress="validate(event)" readonly="">
           <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
           <span id="errPhone" class="error"> </span>
         </div>
       </div>
       <div class="col-md-3">
        <div class="form-group is-focused bmd-form-group is-filled">
         <label for="userphone" class="bmd-label-floating">End Timing</label>
         <input type="text" class="form-control clockpicker td-input" onkeypress="validate(event)" readonly="">
         <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
         <span id="errPhone" class="error"> </span>
       </div>
     </div>
     <div class="col-md-3">
      <div class="form-group is-focused bmd-form-group is-filled">
       <label for="useremail" class="bmd-label-floating datepicker">Start Enrollment Date</label>
       <input type="text" class="form-control picker-input" data-format="d-m-Y" id="bookingsdate" data-large-mode="true" data-large-default="true" data-id="datedropper-2" readonly="">
       <i class="fa fa-calendar prefix" aria-hidden="true"></i>
       <span id="errEmail" class="error"> </span>
     </div>
   </div>
   <div class="col-md-3">
    <div class="form-group is-focused bmd-form-group is-filled">
     <label for="useremail" class="bmd-label-floating"> End Enrollment Date</label>
     <input type="text" data-format="d-m-Y" class="form-control picker-input" id="bookingedate" data-large-mode="true" data-large-default="true" data-id="datedropper-3" readonly="">
     <i class="fa fa-calendar prefix" aria-hidden="true"></i>
     <span id="errEmail" class="error"> </span>
   </div>
 </div>

 <div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="useremail" class="bmd-label-floating"> Event Price</label>
   <input type="text" class="form-control" id="eventprice">
   <i class="fa fa-rupee prefix"></i>
   <span id="errEmail" class="error"> </span>
 </div>
</div>
<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Max Participants</label>
   <input type="text" class="form-control">
   <i class="fa fa-users prefix" aria-hidden="true"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Venue</label>
   <input type="text" class="form-control">
   <i class="fa fa-map-marker prefix"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">City</label>
    <input type="text" class="form-control">
    <i class="fa fa-map-marker prefix " aria-hidden="true"></i>
    <span id="errCity" class="error"> </span>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Contact Person Name</label>
   <input type="text" class="form-control">
   <i class="fa fa-user prefix" aria-hidden="true"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group bmd-form-group">
   <label for="usercity" class="bmd-label-floating">Contact Number</label>
   <input type="text" class="form-control">
   <i class="fa fa-phone prefix"></i>
   <span id="errCity" class="error"> </span>
 </div>
</div>

<div class="col-md-4">
  <div class="form-group bmd-form-group">
    <label for="usercity" class="bmd-label-floating">Contact Email</label>
    <input type="text" class="form-control">
    <i class="fa fa-envelope prefix" aria-hidden="true"></i>
    <span id="errCity" class="error"> </span>
  </div>
</div>



<hr>




<div class="col-md-4">
  <div class="form-group bmd-form-group">
   <label for="country" class="bmd-label-floating">Description</label>
   <textarea id="textacademy"></textarea>
   <!--   <select class="form-control" id="country"> -->
    <!--  <option value="india">India</option> -->
    <!-- </select> -->
    <i class="fa fa-file prefix" aria-hidden="true"></i>
  </div>
</div>
<div class="col-md-4">
 <div class="form-group bmd-form-group">
  <label for="country" class="bmd-label-floating">Event Rule</label>
  <textarea id="textacademy"></textarea>
  <!--   <select class="form-control" id="country"> --> 
   <!--  <option value="india">India</option> -->
   <!-- </select> -->
   <i class="fa fa-check-square-o prefix" aria-hidden="true"></i>
 </div>
</div>

<div class="col-md-4">
  <div class="form-group bmd-form-group is-filled">
    <div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span> <p>Upload Event Banner</p><p class="dropify-error">Upload Event Banner</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" id="eventbanner" class="dropify"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
    <!-- <p class="dropify-infos-message">Upload Banner</p> -->
  </div>
  <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1 orange-btn gapbtn" data-toggle="modal" data-target="#shopGallery" id="successGalleryUpdatebtn" style="float: right;font-weight: 900;">Upload Event Gallery<div class="ripple-container"></div></a>
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
     <div class="column">
      <div class="ui large label amenity">
       <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
       <img class="ui right spaced image" src="assets/images/parking.svg"><span>Parking</span>
     </div>
   </div>
   <div class="column">
    <div class="ui large label amenity">
     <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
     <img class="ui right spaced image" src="assets/images/dressingroom.svg"><span> Dressing room</span>
   </div>
 </div>
 <div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/firstaidkit.svg"><span>First aid kit</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/restrooms.svg"><span>Restrooms</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/earth (1).svg"><span>Power backup</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/lockers.svg"><span> Lockers</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/beverages.svg"><span>Beverages</span>
 </div>
</div>
<div class="column">
  <div class="ui large label amenity">
   <input class="checkbox" type="checkbox" name="termcondition" id="agree" value="1">
   <img class="ui right spaced image" src="assets/images/shower.svg"><span> Shower</span>
 </div>
</div>
</div>
</div>

</div>
</div>

</div>
<div class="col-12">

  <button type="submit" id="register_submit" class="btn btn-default btn-block outline__btn orange-btn gapbtn" name="signup" value="Sign Up">
    Save
    <div class="ripple-container"></div>
  </button>
</div>
</div>
</div>

</div>

</div></div>

</div>
</div>







<script type="text/javascript" src="<?=base_url('assets/public/js/pignose.calendar.full.min.js');?>"></script>

<script src="<?=base_url('assets/public/js/datedropper.min.js');?>"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script>

  jQuery('.slottimedash').timeDropper();
  $('#Dates').dateDropper();
  jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
  jQuery(document).on("click", '.hamburger-toggle', function(){
    jQuery("#rnr-logo .logo__txt img").show();
  });
  "use strict";

  var Dashboard = function () {
    var global = {
      tooltipOptions: {
        placement: "right"
      },
      menuClass: ".c-menu"
    };

    var menuChangeActive = function menuChangeActive(el) {
      var hasSubmenu = $(el).hasClass("has-submenu");
      $(global.menuClass + " .is-active").removeClass("is-active");
      $(el).addClass("is-active");

      // if (hasSubmenu) {
      //  $(el).find("ul").slideDown();
      // }
    };

    var sidebarChangeWidth = function sidebarChangeWidth() {
      var $menuItemsTitle = $("li .menu-item__title");

      $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
      $(".hamburger-toggle").toggleClass("is-opened");

      if ($("body").hasClass("sidebar-is-expanded")) {
        $('[]').tooltip("destroy");
      } else {
        $('[]').tooltip(global.tooltipOptions);
      }
    };

    return {
      init: function init() {
        $(".js-hamburger").on("click", sidebarChangeWidth);

        $(".js-menu li").on("click", function (e) {
          menuChangeActive(e.currentTarget);
        });

        $('[]').tooltip(global.tooltipOptions);
      }
    };
  }();

  Dashboard.init();
  //# sourceURL=pen.js
</script>

<script>

  jQuery('.slottimedash').timeDropper();
  $('#eventsdate,#eventedate,#bookingsdate, #bookingedate').dateDropper();
  jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
  jQuery(document).on("click", '.hamburger-toggle', function(){
    jQuery("#rnr-logo .logo__txt img").show();
  });
  "use strict";

  var Dashboard = function () {
    var global = {
      tooltipOptions: {
        placement: "right"
      },
      menuClass: ".c-menu"
    };

    var menuChangeActive = function menuChangeActive(el) {
      var hasSubmenu = $(el).hasClass("has-submenu");
      $(global.menuClass + " .is-active").removeClass("is-active");
      $(el).addClass("is-active");

      // if (hasSubmenu) {
      //  $(el).find("ul").slideDown();
      // }
    };

    var sidebarChangeWidth = function sidebarChangeWidth() {
      var $menuItemsTitle = $("li .menu-item__title");

      $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
      $(".hamburger-toggle").toggleClass("is-opened");

      if ($("body").hasClass("sidebar-is-expanded")) {
        $('[]').tooltip("destroy");
      } else {
        $('[]').tooltip(global.tooltipOptions);
      }
    };

    return {
      init: function init() {
        $(".js-hamburger").on("click", sidebarChangeWidth);

        $(".js-menu li").on("click", function (e) {
          menuChangeActive(e.currentTarget);
        });

        $('[]').tooltip(global.tooltipOptions);
      }
    };
  }();

  Dashboard.init();
  //# sourceURL=pen.js
</script>

<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script>
  jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
  $(document).ready(function () {
   $("#selectAll").click(function () {
    $(".selectcheck").attr('checked', this.checked);
  });
 });
  $('.filter_prodcuts').hide();
  $('#toggleFilter').click(function(event) {
   $('.filter_prodcuts').slideToggle();
 });
  jQuery(document).on("click", '.hamburger-toggle', function(){
   jQuery("#rnr-logo .logo__txt img").show();
 });


  "use strict";

  var Dashboard = function () {
   var global = {
    tooltipOptions: {
     placement: "right"
   },
   menuClass: ".c-menu"
 };

 var menuChangeActive = function menuChangeActive(el) {
  var hasSubmenu = $(el).hasClass("has-submenu");
  $(global.menuClass + " .is-active").removeClass("is-active");
  $(el).addClass("is-active");

  		// if (hasSubmenu) {
  		// 	$(el).find("ul").slideDown();
  		// }
  	};
  	var sidebarChangeWidth = function sidebarChangeWidth() {
  		var $menuItemsTitle = $("li .menu-item__title");

  		$("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
  		$(".hamburger-toggle").toggleClass("is-opened");

  		if ($("body").hasClass("sidebar-is-expanded")) {
  			$('[data-toggle="tooltip"]').tooltip("destroy");
  		} else {
  			$('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
  		}
  	};


  	return {
  		init: function init() {
  			$(".js-hamburger").on("click", sidebarChangeWidth);

  			$(".js-menu li").on("click", function (e) {
  				menuChangeActive(e.currentTarget);
  			});

  			$('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
  		}
  	};
  }();

  Dashboard.init();
  //# sourceURL=pen.js

  // datepicker
  $(function() {
  	$('input.calendar').pignoseCalendar({
  		format: 'DD-MM-YYYY' // date format string. (2017-02-02)
  	});
  });

  jQuery("#addcreateevent,#editcreateevent").on("click", function(){
    jQuery(this).parents(".packagecreat").after('<div class="packagecreat row"><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="usercity" class="bmd-label-floating">Price</label> <input type="text" class="form-control"> <i class="fa fa-inr prefix"></i> <span id="errCity" class="error"> </span></div></div><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="usercity" class="bmd-label-floating">Price Detail</label> <input type="text" class="form-control"> <i class="fa fa-inr prefix " aria-hidden="true"></i> <span id="errCity" class="error"> </span></div></div><div class="col-md-3"><div class="form-group bmd-form-group is-filled" style="margin-top: 5px;"> <label for="usercity" class="bmd-label-floating">Total Slot/Day</label> <select class="form-control" id="kitquantityoutdoor"><option value="">Select Number</option><option class="abc" value="1">1</option><option class="abc" value="2">2</option><option class="abc" value="3">3</option> </select> <i class="fa fa-sort-numeric-asc prefix"></i> <span id="errnucourts" class="error"></span></div></div><div class="col-sm-1"> <a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm deletepackagecreat" ><i class="fa fa-trash "></i><div class="ripple-container"></div><div class="ripple-container"></div></a></div></div>')

    setInterval(function(){
      jQuery('.deletepackagecreat').on("click", function(){
        jQuery(this).parents(".packagecreat.row").remove()
      });
    },200);

  });
  // time
  $('.timeshow').clockpicker();





</script>



  <!-- <script type="text/javascript">
  $('.clockpicker').clockpicker();
</script> -->
<script type="text/javascript">
 $( ".clockpicker" ).timeDropper({

    // custom time format
    format: 'h:mm a',

    // auto changes hour-minute or minute-hour on mouseup/touchend.
    autoswitch: false,

    // sets time in 12-hour clock in which the 24 hours of the day are divided into two periods. 
    meridians: false,

    // enable mouse wheel
    mousewheel: false,

    // auto set current time
    setCurrentTime: true,

    // fadeIn(default), dropDown
    init_animation: "fadein",

    // custom CSS styles
    primaryColor: "#1977CC",
    borderColor: "#1977CC",
    backgroundColor: "#FFF",
    textColor: '#555'
    
  });
</script>
<script type="text/javascript">
 $( "#userphone1" ).timeDropper({

    // custom time format
    format: 'h:mm a',

    // auto changes hour-minute or minute-hour on mouseup/touchend.
    autoswitch: false,

    // sets time in 12-hour clock in which the 24 hours of the day are divided into two periods. 
    meridians: false,

    // enable mouse wheel
    mousewheel: false,

    // auto set current time
    setCurrentTime: true,

    // fadeIn(default), dropDown
    init_animation: "fadein",

    // custom CSS styles
    primaryColor: "#1977CC",
    borderColor: "#1977CC",
    backgroundColor: "#FFF",
    textColor: '#555'
    
  });
</script>
<script type="text/javascript">
 $('.dropify').dropify();
 jQuery("#eventbanner").siblings(".dropify-message").find("p").text("Upload Event Banner");

</script>


<script>

  $(document).on('click', '.weekoff label', function () {
    if($(this).find("input").is(':checked'))
    {
      $(this).find("input").attr('checked', false);
      $(this).removeClass('active');
    }

    else
    {
      $(this).find("input").attr('checked', true);
      $(this).addClass('active');
    }


  });

  $('#createeventlist').DataTable();

  var maxLength = 200;
  $('textarea').keyup(function() {
    var textlen = maxLength - $(this).val().length;
    $('#rchars').text(textlen);
  });
</script>



</body>
</html>	