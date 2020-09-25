<!DOCTYPE html>
<html lang="en">

<head>
<title>Social Sportz</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true">
<meta http-equiv="x-ua-compatible" content="IE=edge">
<!-- Fonts For Heading & SubHeadings -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/timedropper.min.css">
<?php $this->load->view('public/common/head');?>
<style>
.progress
{
	height: 12px;
    border-radius: 16px;
}

.amenity img {
    cursor: default;
}

	.progress-bar{
    background: url(<?=base_url('assets/public/images/loadingbarred.png');?>);
        background-repeat: repeat-x;
    background-size: contain;
    border-radius: 16px;
   transition:all 2.5s ease-in-out;
   -webkit-transition:all 2.5s ease-in-out;		
	}

	.progress-bar.yellownew{
    background: url(<?=base_url('assets/public/images/loadingbaryellow.jpg');?>);

	}


		.progress-bar.rednew{
    background: url(<?=base_url('assets/public/images/loadingbarred.png');?>);
	}


			.progress-bar.greennew{
    background: url(<?=base_url('assets/public/images/loadingbaryellow.jpg');?>);
	}


#mySelect_hidden{display: none}
.modal .close{
margin-top: -7px; 
}
#step_6_form .list-inline-item{
		position: relative;
	}



</style>
</head>

<body class="facilityprofile">
<div class="markethub__container">
<!-- Header Include Here -->
<?php $this->load->view('public/common/header');?>
<?php //include 'include/dashboard-menu.php'; ?>
<div class="main_m8place__container business-profile__container timenotselected" id="facility-profile">
<div class="header-data">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="top-head-nav clearfix">
					<div class="page-title float-md-left">
						<h1>Welcome to Social Sportz</h1>
						<p>Complete your profile</p>
					</div>
					<div class="profile_complete_indicatior progress-bar-top d-inline-block float-right ">
						
						<h5 class="title">Your profile is <span class="pro_percent pro_pr">15</span>% completed</h5>	
					<div class="progress" style="height: 12px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 15%"></div>
					</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="data-container-all pt-1">
	<div class="container">
		<div class="row form-group">
			<div class="col-md-12">
				<ul class="nav nav-pills nav-justified thumbnail setup-panel step_menu">
					<li class="active">
						<a href="#step-1">
							<h4 class="list-group-item-heading"><span>Profile</span></h4>
							<p class="list-group-item-text">(Step 1)</p>
						</a>
					</li>
					<li class="disabled">
						<a href="#step-2">
							<h4 class="list-group-item-heading"><span>Facility/Academy</span></h4>
							<p class="list-group-item-text">(Step 2)</p>
						</a>
					</li>
					<li class="disabled disable-click">
						<a href="#step-3" id="fac_sport_click">
							<h4 class="list-group-item-heading"><span>Sports</span></h4>
							<p class="list-group-item-text">(Step 3)</p>
						</a>
					</li>
					<li class="disabled">
						<a href="#step-4">
							<h4 class="list-group-item-heading"><span>Amenities</span></h4>
							<p class="list-group-item-text">(Step 4)</p>
						</a>
					</li>

					<li class="disabled">
						<a href="#step-5">
							<h4 class="list-group-item-heading"><span>Bank Info</span></h4>
							<p class="list-group-item-text">(Step 5)</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<section class="content_step setup-content" id="step-1">
			<div class="info_container">
				<button data-toggle="modal" data-target="#infoGraphicBusinessDetails" class="info_button pulse_effect"><i class="fa fa-question"></i></button></div>
				<form action="">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="username" class="bmd-label-floating">Name<span class="required">*</span></label>
								<input type="text" class="form-control" id="username" onkeyup="leftTrim(this)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_name;?>" >	<i class="fa fa-user prefix"></i>
								<span id="errName" class="error"> </span>	
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="gender" class="bmd-label-floating">Gender<span class="required">*</span></label>
								<select class="form-control" id="gender">
									<option class="abc" value="M" <?php if($fac_personal_data && $fac_personal_data->user_gender=='M') echo "selected" ?> >Male</option>
									<option class="abc" value="F" <?php if($fac_personal_data && $fac_personal_data->user_gender=='F') echo "selected" ?>>Female</option>
									<option class="abc" value="T" <?php if($fac_personal_data && $fac_personal_data->user_gender=='T') echo "selected" ?>>Other</option>
								</select>	<i class="fa fa-venus-mars prefix"></i>
								<span id="errGender" class="error"></span>	
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="useremail" class="bmd-label-floating" readonly>Email</label>
								<input readonly="true" type="text" class="form-control" id="useremail" value="<?php if($fac_personal_data) echo $fac_personal_data->user_email;?>">	<i class="fa fa-envelope prefix"></i>
								<span id="errEmail" class="error"> </span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="userphone" class="bmd-label-floating">Mobile Number<span class="required">*</span></label>
								
								<input style="width:100%;margin-left:25px;" type="text" class="form-control" onkeypress="validate(event)" id="userphone" value="<?php if($fac_personal_data) echo $fac_personal_data->user_mobile_no;?>" readonly>	<i class="fa fa-phone prefix"></i>
								<span id="errPhone" class="error"> </span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group bmd-form-group">
								<label for="usercity" class="bmd-label-floating">City<span class="required">*</span></label>
								<input type="text" class="form-control charval" id="usercity" onkeyup="leftTrim(this)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_city;?>">	<i class="fa fa-map-marker prefix"></i>
								<span id="errCity" class="error"> </span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group bmd-form-group">
								<label for="useraddress" class="bmd-label-floating">Sub Area<span class="required">*</span></label>

								<input type="text" class="form-control" id="useraddress" onkeyup="leftTrim(this)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_address2;?>">	<i class="fa fa-map-marker prefix"></i>
								<span id="errAddress1" class="error"> </span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group bmd-form-group">
								<label for="useraddress2" class="bmd-label-floating">Address</label>
								<input type="text" class="google_address form-control" id="useraddress2" onkeyup="leftTrim(this)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_address;?>" >
								<input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php if($fac_personal_data) echo $fac_personal_data->user_latitude;?>">
									<input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php if($fac_personal_data) echo $fac_personal_data->user_longitude;?>">
									<i class="fa fa-map-marker prefix"></i>
									
								<span id="errAddress2" class="error"> </span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group bmd-form-group">
								<label for="userpincode" class="bmd-label-floating">Pincode<span class="required">*</span></label>
								<input type="text" class="form-control" id="userpincode" onkeypress="validate(event)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_pincode;?>">	<i class="fa fa-map-marker prefix"></i>
								<span id="errPincode" class="error"> </span>
							</div>
						</div>
					<!-- <div class="col-md-12">
						<div class="form-group let_me_do_later text-right">
							<a href="javascript:void(0)" class="btn-link" id="do-later-activate-step-3">Let me do this later</a>
						</div>
					</div> -->
					<div class="col-md-12 ">
						<ul class="text-right">
							<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed" id="activate-step-2">Proceed</a>
							</li>
						</ul>
					</div>
				</div>
			</form>
		</section>
		<section class="content_step setup-content" id="step-2" style="display: block important">
			
			<div class="container">
				<div class="info_container">
					<button data-toggle="modal" data-target="#infoGraphicfacility" class="info_button pulse_effect" title="Product Info"><i class="fa fa-question"></i>
					</button>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">	<a class="nav-link active academytabbing" data-toggle="tab" href="#facility">Facility/Academy</a>
					</li>
					<li class="nav-item">	<a class="nav-link listingtab" id="facList" data-toggle="tab" href="#academy">Listing</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
					</li> -->
				</ul>
				<!-- Tab panes -->
				
				<div class="tab-content">
					<div id="facility" class="container tab-pane active fade">
						<form action="" class="" id="step_2_form" name="step_2_form" enctype="multipart/form-data">
							
							<div class="text-center" id="radiolabel">
								<label class="radio-inline btn" >
									<input type="radio" name="fac_type" id="facilityselect1" value="Facility" checked="checked"><span class="bmd-radio"></span>
								Facility</label>
								
								<label class="radio-inline btn" >
									<input type="radio" name="fac_type" id="academyselect1" value="Academy"><span class="bmd-radio"></span>
								Academy</label>
								
							</div>
							<div id="academyfacilitywrapper">
								<div class="panel-heading12">Basic Details</div>
								<div class="row">
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group bmd-form-group">
													<label for="facilityname1" class="bmd-label-floating">Facility Name<span class="required">*</span></label>
													<input type="hidden" id="fac_id" name="fac_id">
													<input type="text" class="form-control" id="facilityname1" name="facilityname" onkeyup="leftTrim(this)">	<i class="fa fa-university prefix"></i>
													<span id="errFacilityname1" class="error"> </span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-group" id="defaulttimingcontainer">
													<div class="editbox">
														<label for="timing" class="bmd-label-floating">Open/Close Timing<span class="required">*</span></label>
														<select class="form-control" id="mySelect"></select>

														<select class="form-control" id="mySelect_hidden" name="fac_timing[]" multiple="multiple"></select>

														<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
														<i class="fa fa-edit prefix edittimepopup" data-toggle="modal" data-target="#shopTiming" aria-hidden="true"></i>
													</div>
													<div class="timinginitator">
														<label for="timing" class="bmd-label-floating">Open/Close Timing<span class="required">*</span></label>
														<input type="text" class="form-control" id="timing" readonly>	<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
														<span id="errTiming" class="error"> </span>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group bmd-form-group is-filled">
													<label for="description" class="bmd-label-floating" style="position: absolute; top:18px">About Facility<span class="required">*</span></label>
													<textarea id="textacademy" name="fac_text" onkeyup="leftTrim(this)"></textarea>	<i class="fa fa-file-text prefix" aria-hidden="true"></i>
													<span id="errFacilitydescription" class="error"> </span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4 bannerlogonew1">
										<input type="file" id="input-file-banner" name="fac_banner" class="dropify" />
										<input type="hidden" id="old_fac_banner" name="old_fac_banner">
										<span id="banner_erro" class="error"> </span>
										
									</div>
									<div class="imagetoupload col-sm-12">
										<hr>
										<div class="nopadleft nopadright">
											<div class="panel-heading12">Address</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group bmd-form-group">
														<label for="facilitycity" class="bmd-label-floating charval">City<span class="required">*</span></label>
														<input type="text" class="google_address form-control charval" onkeyup="leftTrim(this)" id="facilitycity" name="fac_city">

														<input type="hidden" class="form-control" id="fac_latitude" name="fac_latitude" value="">

														<input type="hidden" class="form-control" id="fac_longitude" name="fac_longitude" value="">

														<i class="fa fa-map-marker prefix"></i>
														<span id="errFacilitycity" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group">
														<label for="facilityarea" class="bmd-label-floating">Area<span class="required">*</span></label>
														<input type="text" class="form-control" id="facilityarea" name="fac_area" onkeyup="leftTrim(this)">	<i class="fa fa-map-marker prefix"></i>
														<span id="errFacilityrea" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group">
														<label for="facilitypincode" class="bmd-label-floating">Pincode<span class="required">*</span></label>
														<input type="text" class="form-control" id="facilitypincode" name="fac_pincode" onkeypress="validate(event)">	<i class="fa fa-map-marker prefix"></i>
														<span id="errFacilitypincode" class="error"> </span>
													</div>
												</div>
											</div>
										</div>
									
									<!-- 	<div class="">
											<div class="panel panel-default">
												<div class="panel-heading12">
													<input type="checkbox" id="achievementcheckbox"> Achievement(If any)</div>
													<div class="col-sm-12 nopadleft nopadright" id="achievementtable" style="padding-left:0px;">
														<div class="boxachievement">
															<div class="row">
																<div class="col-md-3" id="titleEdit" style="display: none">
																	<div class="form-group bmd-form-group-sm bmd-form-group">
																		<label for="titleValue" class="bmd-label-floating">Type</label>
																		<input type="text" class="form-control" id="titleValue">
																		<i class="fa fa-list-alt prefix"></i>
																	</div>
																</div>
																<div class="col-md-3" id="selectBoxTitle">
																	<div class="form-group selectdiv bmd-form-group is-filled">
																		<label for="titleValue" class="bmd-label-floating">Select Achievement</label>
																		<select class="form-control custom-select-sm" id="selectOfferTitle" name="reward_type[]">
																			<option disabled="disabled" selected="selected" value="0">Select Achievement Type</option>
																			<?php if (isset($rewards_type) && $rewards_type!='') {
																				foreach ($rewards_type as $rewards) { ?>
																				<option value="<?=$rewards->reward_id;?>"><?=$rewards->reward_name;?></option>
																				<?php	}
																			} ?>
																			
																			
																			
																		</select>
																		<i class="fa fa-list-alt prefix"></i>
																		<span id="errFacilityachivement" class="error">
																	</div>					
																</div>
																

																<div class="col-md-4">
																	<div class="form-group bmd-form-group">
																		<label for="facilityname" class="bmd-label-floating">Title<span class="required">*</span></label>
																		<input type="text" class="form-control" id="facilityname" name="reward_title[]">	<i class="fa fa-trophy prefix"></i>
																		<span id="errAchivementtitle" class="error"> </span>
																	</div>
																</div>
																
																
																<div class="col-md-2">
																	<input type="file" id="input-file-image1" class="dropify" name="achievement_img1[]" accept="image/png, image/jpeg, image/jpg" />
																</div>
																<div class="col-md-2">
																	<input type="file" id="input-file-image2" class="dropify" name="achievement_img2[]" accept="image/png, image/jpeg, image/jpg" />
																</div>
																<div class="col-sm-1">	<a href="javascript:void(0)" class="btn btn-raised btn-success btn_add_sm" id="add_grneral"><i class="fa fa-plus"></i><div class="ripple-container"></div></a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> -->
										
										<hr class="fullwidth">
										<div class="col-md-12 text-right buttonwrapper">
											
											<ul class="list-inline business_detail_buttons">
												<li class="list-inline-item"><a href="javascript:void(0)" id="fac_detail" class="btn btn-raised btn_proceed listproceed1">Save and continue</a>
												</li>
												<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed skipsection">Let me do this later</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					



					<div id="academy" class="container tab-pane fade">
						<br>
						<div id="fac_details_listing">
							

						</div>
						
						<div class="col-md-12 ">
							<ul class="text-right">
								<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed activate" id="activate-step-3">Proceed<div class="ripple-container"></div></a>
								</li>
							</ul>
						</div>
						<hr class="listing-hr">
					</div>
				</div>
			</div>

		</section>
		<section class="content_step setup-content" id="step-3" style="">
			<div class="container">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active sportstab" data-toggle="tab" href="#addsports">Add Sports</a>
					</li>

					<li class="nav-item">
						<a class="nav-link sportslisting" id="facsportslisting" data-toggle="tab" href="#sportslist">Sports List</a>
					</li>


				</ul>

				<div class="tab-content">
					<div id="addsports" class="tab-pane fade in active">
						<form action="">
							<div class="row">

								<div class="col-md-4">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="facname" class="bmd-label-floating">Select Facility/Academy<span class="required">*</span></label>
										<input type="hidden" name="sport_court_id" id="sport_court_id">
										<select class="form-control" id="facname" name="facname">
											<option value="0">Facility/Academy</option>


										</select>	<i class="fa fa-university prefix"></i>
										<span id="errFacname" class="error"></span>	
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="sportsname" class="bmd-label-floating selectsportslabel" style="top:18px !important">Select Sports<span class="required">*</span></label>
										<select class="form-control" id="sportsname" name="sportsname">
											<option value="0">Select Sports</option>
											<?php if (isset($sport_list) && $sport_list!='') {
												foreach ($sport_list as $sports) { ?>
												<option value="<?=$sports->sport_id;?>"><?=$sports->sport_name;?></option>

												<?php }
											} ?>

										</select>
										<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
										<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">
								<span id="errGame" class="error"></span>	
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="courtnumber" class="bmd-label-floating">No. of Courts<span class="required">*</span></label>
										<input type="text" name="" class="form-control" id="courtnumber" onkeypress="validate(event)">
											<i class="fa fa-sort-numeric-asc prefix"></i>
										<span id="errnucourts" class="error"></span>	
									</div>
								</div>

								<div class="col-md-6 gap15 indoorsection">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="kitquantity2" class="bmd-label-floating">No. of Indoor<span class="required">*</span></label>
										<input type="text" name="" class="form-control" id="kitquantity2" name="kitquantity2" onkeypress="validate(event)">
										<i class="fa fa-sort-numeric-asc prefix"></i>
										<span id="errIndorcourts" class="error"></span>	
									</div>
									</div>

									<div class="col-md-6 gap15">
										<div class="outdoorsection">
											<div class="form-group bmd-form-group is-filled  " style="margin-top: 5px;">
												<label for="kitquantityoutdoor" class="bmd-label-floating">No. of Outdoor<span class="required">*</span></label>
												<input type="text" name="" class="form-control" id="kitquantityoutdoor" onkeypress="validate(event)">
												<i class="fa fa-sort-numeric-asc prefix"></i>
												<span id="errOutdorcourts" class="error"></span>	
											</div>
										</div></div>

					
					<hr class="fullwidth">
					<div class="col-md-12 text-right buttonwrapper">
						
						<ul class="list-inline business_detail_buttons">

							<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed listingamenties" data-toggle="tab" id="add_fac_sport" >Save and continue</a></li>
							<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed skipsection">Let me do this later<div class="ripple-container"></div></a></li>

						</ul>									
					</div>
				</div>
			</form>
		</div>
		<div id="sportslist" class="tab-pane fade">
			
			
		</div>




	</div>

</div>



</div>
</section>

<section class=" setup-content complete-profile" id="step-4">
<div class="container">
<div class="col-md-12">
	<h2 class="text-center" style="font-size: 24px;padding:30px 0">Amenities Available</h2>
	<!-- <div style="width:300px; margin: auto;">
		<div class="form-group bmd-form-group" style="margin-top: 5px;">
											<label for="facname" class="bmd-label-floating">Select facility / Academy</label>
											<select class="form-control" id="facname" name="facname">
												<option value="0">Amenities Available</option>
												<option value="0">Amenities Available</option>
											</select>
										</div>
									</div> -->
									<div class="ui four column doubling  grid">

										<?php if (isset($amenity_list) && $amenity_list!='') {
											foreach ($amenity_list as $amenity) { ?>
											<div class="column">
												<div class="ui large label amenity">
													<input class="checkbox myCheck" type="checkbox" name="amenities" id="amenities" value="<?=$amenity->amenity_id;?>">
													<img class="ui right spaced image" src="<?=base_url();?>assets/public/images/amenity/<?=$amenity->amenity_icon;?>"><span><?=$amenity->amenity_name;?></span>
												</div>
											</div>
											<span id="erramenity" class="error"></span>	

											<?php }
										} ?>

									</div>
								</div>
								<hr class="fullwidth">
								<div class="col-md-12 text-right buttonwrapper">
									<ul class="list-inline business_detail_buttons">

										<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed" id="activate-step-5">Proceed<div class="ripple-container"></div></a>
										</li>
										<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed skipsection">Let me do this later<div class="ripple-container"></div></a></li>
									</ul>
								</div>
							</div>

						</section>



						<section class=" setup-content" id="step-5">
							<div class="container content_step">
								<div class="info_container">
									<button data-toggle="modal" data-target="#infoGraphicBankDetails" class="info_button pulse_effect" title="Product Info"><i class="fa fa-question"></i>
									</button>
								</div>
								<form action="" class="" id="step_6_form" name="step_6_form" enctype="multipart/form-data">
									<div class="row" style="margin:0px !important">


										<div id="letMeEnterDetails">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="ifsccode" class="bmd-label-floating">IFSC Code<span class="required">*</span></label>
														<input type="text" onkeyup="leftTrim(this)" class="form-control" id="ifsccode" name="ifsccode">	<i class="fa fa-university prefix"></i>
														<span id="errAcountifsc" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="bankname" class="bmd-label-floating">Bank Name<span class="required">*</span></label>
														<input type="text" onkeyup="leftTrim(this)" class="form-control" id="bankname" name="bankname">	<i class="fa fa-university prefix"></i>
														<span id="errAcountbankname" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="branchname" class="bmd-label-floating">Branch Address<span class="required">*</span></label>
														<input type="text" onkeyup="leftTrim(this)" class="form-control" id="branchname" name="branchname">	<i class="fa fa-university prefix"></i>
														<span id="errAcountaddress" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="account_name" class="bmd-label-floating">Account Name<span class="required">*</span></label>
														<input type="text" onkeypress="return withoutspecialnumeric(event)" onkeyup="leftTrim(this)" class="form-control" id="account_name" name="account_name">	<i class="fa fa-user-circle prefix"></i>
														<span id="errAcountname" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="accountnumber" class="bmd-label-floating">Account Number<span class="required">*</span></label>
														<input type="text" onkeyup="leftTrim(this)" class="form-control" id="accountnumber" name="accountnumber" onkeypress="validate(event)">	<i class="fa fa-university prefix"></i>
														<span id="errAcountno" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group selectdiv">
														<label for="exampleSelect1" class="bmd-label-floating">Type of Account<span class="required">*</span></label>
														<select class="form-control" id="exampleSelect1" name="account_type">
															
															<option selected="selected" value="Current">Current</option>
															<option value="Saving">Saving</option>
														</select>	<i class="fa fa-list-alt prefix"></i>
														<span id="errAcounttype" class="error"> </span>
													</div>
												</div>
											</div>
										</div></div>
										<div class="row">
											<div class="col-md-12">
												<div class="detials_comp upload__docs">
													<form action="" class="form_register">
														<ul class="list-inline list_upload_img">
															<li class="list-inline-item">
																<div class="main-img-container">
																	

																	<input type="file" id="gst" name="gst_image" class="dropify" />
																	
																</div>
																<span id="gst_image_error" class="error"></span>
															</li>
															<li class="list-inline-item">
																<div class="main-img-container">
																	

																	<input type="file" id="pan" name="pan_image" class="dropify" />

																</div>
																<span id="pan_image_error" class="error"></span>
															</li>
															<li class="list-inline-item">
																<div class="main-img-container">
																	

																	<input type="file" id="regd" name="firm_img" class="dropify" />

																</div>
																<span id="firm_image_error" class="error"></span>
															</li>
															<li class="list-inline-item">
																<div class="main-img-container">
																	

																	<input type="file" id="addressproof" name="address_image" class="dropify" />

																</div>
																<span id="address_image_error" class="error"></span>
															</li>
															<li class="list-inline-item">
																<div class="main-img-container">
																	<input type="file" id="cancelledcheque" name="Cancelled_check_image" class="dropify" />

																</div>
																<span id="cheque_image_error" class="error"></span>
															</li>
														</ul>

														<div class="row">
															<div class="col-md-12">
																<div class="checkbox span_element">
																	<label>
																		By registering, you agree to the <a href="<?=base_url('page/terms_conditions');?>" target="_blank" style="color:#c00000;">Terms &amp; Conditions.</a>
																	</label>
																</div>

															</div>
															
															<hr class="fullwidth">
															<div class="col-md-12 text-right business_detail_buttons">

																<span class="smalltext">*JPEG, PNG & PDF format only</span>
																<ul class="list-inline buttonwrapper">

																	<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed" id="activate-step-6">Proceed</a>
																	</li>
																	<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed skipsection" data-toggle="modal" data-target="#thankyouprofile">Let me do this later<div class="ripple-container"></div></a>
																	</li>
																</ul>
															</div>
														</div>
													</form>
												</div>
											</section>

										</div>
									</div>
								</div>
								<div class="loader">
									<div class="">
										<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
									</div>
								</div>

							</div>
							<!-- Footer Include Here -->
							<?php $this->load->view('public/common/footer');?>
						</div>
						<?php $this->load->view('public/common/foot');?>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
						<!-- Modals -->
						<div class="modal fade modal_default view_deal template_modal" id="infoGraphicBusinessDetails" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body px-0">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 d-none d-lg-block">
													<img src="<?=base_url();?>assets/public/images/facilitypopup2.jpg" class="img-fluid" alt="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade modal_default view_deal template_modal" id="infoGraphicfacility" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body px-0">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 d-none d-lg-block">
													<img src="<?=base_url();?>assets/public/images/facilityinfographic.jpg" class="img-fluid" alt="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="modal fade modal_default view_deal template_modal" id="infoGraphicBankDetails" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body px-0">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 d-none d-lg-block">
													<img src="<?=base_url();?>assets/public/images/bank-details.jpg" class="img-fluid" alt="">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade modal_default view_deal edit_profile_modal" id="shopTiming" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title pl-3" id="exampleModalLongTitle">Add Opening & Closing Time</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													<div class="detials_comp">
														<form action="" class="sm_inputs">
														<div class="selectall"><input type="checkbox"> Select All</div>
														<span class="error" style="    width: 100%; top: -6px; text-align: center; height:10px" id="oneselect"></span>
															<ul class="list-inline list_edit_times">
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Mon</p>
																		</div>
																		<div class="col-md-4 col-sm-12">
																			<div class="form-group bmd-form-group-sm">
																				<label for="mondayOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="mondayOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 col-sm-12 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="mondayCl" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="closing form-control time" value="" id="mondayCl">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Tue</p>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="tueOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="tueOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="tueCl" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="closing form-control time closeing" value="" id="tueCl">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Wed</p>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="wedOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="wedOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="wedCl" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="form-control closing time" value="" id="wedCl">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Thu</p>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="ThurOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="ThurOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="ThurCL" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="closing form-control time" value="" id="ThurCL">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Fri</p>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="friOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="friOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="mobileNum" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="closing form-control time" value="" id="mobileNum">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Sat</p>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="satOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="satOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="satCl" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="closing form-control time" value="" id="satCl">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																			</label>
																		</div>
																		<div class="col-md-3">
																			<p class="day">Sun</p>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="sunOp" class="bmd-label-floating time_label">Opening</label>
																				<input type="text" class="form-control time" value="" id="sunOp">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4 ">
																			<div class="form-group bmd-form-group-sm">
																				<label for="sunCl" class="bmd-label-floating time_label">Closing</label>
																				<input type="text" class="closing form-control time" value="" id="sunCl">	<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
															</ul>
														</form>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">	<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="shopTimingBtn">Submit</a>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="timeedit"></div>

						<div class="modal fade modal_default view_deal show" id="thankyouprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="padding-right: 17px;">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">

									<div class="modal-body">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
										</button>
										<div class="detials_comp review__profile text-center">
											<div class="img-thanks text-center">
												<img src="<?=base_url();?>assets/public/images/thanks.png" alt="">
											</div>
											<h1 class="display-4 text-center text-verfiy" style="font-size:25px">Thank you for showing interest in Social Sportz!</h1>
											<p>Your details are under the review process.</p>
											<p>Your account will be activated shortly.</p>
											<a href="javascript:void(0)" id="go_to_dashboard" class="btn btn-raised btn_proceed">Continue to Dashboard</a>
										</div>
									</div>

								</div>

							</div>
						</div>

						<?php //include 'include/modal.php'; ?>
						<script type="text/javascript" src="<?=base_url('assets/public/js/timedropper.min.js');?>"></script>

						<script>
							$( ".time" ).timeDropper({
										setCurrentTime: false
									});
							$(window).on('load',function() {
								$(".loader").fadeOut('slow');
							});

							function showingLoader(){
								$(".loader").fadeIn(200);
//$(".loader").fadeOut(1000);
}
function hiddingLoader(){
//$(".loader").fadeIn(200);
$(".loader").fadeOut(1000);
}

$(document).ready(function() { $('body').bootstrapMaterialDesign(); });
</script>

<script>
/*Submit Form Using Ajax*/
function isNumberValid(number){
var checkNumber = /^\d{10}$/;
return checkNumber.test(number);						
}
function isNameValid(name){
return /[A-Z]+/i.test(name) && /[a-z]+/.test(name) && /\S{7,15}/.test(name);			
}
function isEmailValid(email){
return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}



function validate(evt) {
var theEvent = evt || window.event;

// Handle paste
if (theEvent.type === 'paste') {
key = event.clipboardData.getData('text/plain');
} else {
// Handle key press
var key = theEvent.keyCode || theEvent.which;
key = String.fromCharCode(key);
}
var regex = /[0-9]|\./;
if( !regex.test(key) ) {
theEvent.returnValue = false;
if(theEvent.preventDefault) theEvent.preventDefault();
}
}

$('#submit_progress').hide();
$('#uploadFiles').click(function() {
var timerId, percent;
percent = 0;
$('#uploadFiles').attr('disabled', true);
$('#load').css('width', '0px');
$('#submit_progress').show();
$('#load').addClass('progress-bar-striped');
timerId = setInterval(function() {
percent += 5;
$('#load').css('width', percent + '%');
$('#load').html(percent + '%');
if (percent >= 100) {
clearInterval(timerId);
$('#uploadFiles').attr('disabled', false);
$('#load').html('upload complete');
}
}, 200);
});
$(document).ready(function () {

$('#activate-step-2').on('click', function(e) {

var name = $('#username').val();
jQuery("#gender").on("change", function(){jQuery("#errGender").remove()});
var gender_val=$( "#gender option:selected" ).val();
var gender = $("#gender option.abc:selected").length;
var subject = $('#contactSubject').val(); 
var email = $('#useremail').val();
var phone = $('#userphone').val();
var validPhone= $.trim($('#userphone').val()).length;
var address1 = $('#useraddress').val();
var address2 = $('#useraddress2').val();
var city = $('#usercity').val();
var latitude = $('#latitude').val();
var longitude = $('#longitude').val();
	//alert(country);
	var pincode = $('#userpincode').val();
	var validPincode = $.trim($('#userpincode').val()).length;	
	

				//alert(reCaptcha);
				if(name == ''){
					$('#errName').show();
					$('#errName').html('Please enter name');
					$('html,body').animate({scrollTop: $("#errName").offset().top - 200},'slow');
					return false;
				}else{
					$('#errName').html(''); 
				}

				if(gender == 0)
				{
					$('#errGender').html('Please Select Gender');
					return false;
				}

				else if(gender == 1)
				{
					$('#errGender').html('');	
				}

				/*if(email == ''){
					error=1;
					$('#useremail').focus();
					$('#errEmail').html('Please enter email');
					$('html,body').animate({scrollTop: $("#errEmail").offset().top - 240},'slow');
					return false;
				}
				else if (!isEmailValid(email)) {
					error=1;
					$('#useremail').focus();
					$('#errEmail').html('Please enter valid email');
					$('html,body').animate({scrollTop: $("#errEmail").offset().top - 240},'slow');
					return false;
				}
				else{
					error=0;
					$('#errEmail').html('');
				}*/


				/*if(phone == ''){
					error=1;
					$('#userphone').focus();
					$('#errPhone').html('Please enter mobile number');
					$('html,body').animate({scrollTop: $("#errPhone").offset().top - 240},'slow');
					return false;
				}else{
					error=0;
					$('#errPhone').html(''); 
				}

				if( validPhone < 8 || validPhone > 16){
					error=1;
					$('#userphone').focus();
					$('#errPhone').html('Please enter Mobile no. between 8 and 15 characters');
					$('html,body').animate({scrollTop: $("#errPhone").offset().top - 240},'slow');
					return false;
				}else{
					error=0;
					$('#errPhone').html(''); 
				}*/


				if(city == ''){
					$('#errCity').show();
					$('#errCity').html('Please enter City');
					$('html,body').animate({scrollTop: $("#errCity").offset().top - 200},'slow');
					return false;
				}else{
					$('#errCity').html(''); 
				}

				if(address1 == ''){
					$('#errAddress1').show();
					$('#errAddress1').html('Please enter Address Line 1');
					$('html,body').animate({scrollTop: $("#errAddress1").offset().top - 200},'slow');
					return false;
				}else{
					$('#errAddress1').html(''); 
				}

				if(address2 == ''){
					$('#errAddress2').show();
					$('#errAddress2').html('Please enter Address Line 2');
					$('html,body').animate({scrollTop: $("#errAddress2").offset().top - 200},'slow');
					return false;
				}else{
					$('#errAddress2').html(''); 
				}


				if(pincode == ''){
					error=1;
					$('#userpincode').focus();
					$('#errPincode').html('Please enter pincode');
					$('html,body').animate({scrollTop: $("#errPincode").offset().top - 240},'slow');
					return false;
				}
				else{
					error=0;
					$('#errPincode').html('');
				}

				if( validPincode!=6){
					error=1;
					$('#userpincode').focus();
					$('#errPincode').html('Please enter correct pincode');
					$('html,body').animate({scrollTop: $("#errPincode").offset().top - 240},'slow');
					return false;
				}else{
					error=0;
					$('#errPincode').html('');
					showingLoader();
				}

				action='fac_step_1';

				$.ajax({
					type: "POST",
					url:'<?php echo base_url();?>login/complete_profiling',	
					data: {name:name,gender:gender_val,email:email,phone:phone,address1:address1,address2:address2,city:city,pincode:pincode,latitude:latitude,longitude:longitude,action:action},
					success:function(res){
					//alert(res); return false;
					if(res!='failed'){
						$('ul.setup-panel li:eq(1)').removeClass('disabled');
						$('ul.setup-panel li a[href="#step-2"]').trigger('click');

									$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>login/fac_percent',	
			data: {},
			success:function(res){
				$(".pro_percent").html(res['_html']);
			}	
			});

					}
					else{
						$('#error_msg').show(); 
						$('#error_msg').text("Network issue"); 
					}

					hiddingLoader();			    

				}	
			});



				

			});


// $('#dateofBirth').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

/*Step 2 ajax start here*/

$('#fac_detail').on('click', function(e) {

	
	var fac_name = $('#facilityname1').val();
	var fac_about = $('#textacademy').val();			
	var fac_city = $('#facilitycity').val();			
	var fac_area = $('#facilityarea').val();			
	var fac_pincode = $('#facilitypincode').val();
	var achievement_type = $('#selectOfferTitle').val();
	var facilityname = $('#facilityname').val();
	var validPincode = $.trim($('#facilitypincode').val()).length;	
	var fac_time =$("#mySelect option:selected" ).val();
	
     var fac_banner =  $('input[name=fac_banner]').val();
	 var extcatgst_image = fac_banner.split('.').pop();
	 var old_banner = $("#old_fac_banner").val();
	 

	

	if(fac_name == ''){
		$('#facilityname1').show();
		$('#errFacilityname1').html('Please enter name');
		$('html,body').animate({scrollTop: $("#errFacilityname1").offset().top - 200},'slow');
		return false;
	}else{
		$('#errFacilityname1').html(''); 
	}
	if(fac_time==undefined){
		$('#timing').show();
		$('#errTiming').html('Please enter Time');
		$('html,body').animate({scrollTop: $("#errTiming").offset().top - 200},'slow');
		return false;
	}else{
		$('#errTiming').html(''); 
	}
   



if(old_banner == ''){
if(fac_banner == ''){
            $('#banner_erro').show();
            $('#banner_erro').html('Please attach banner image');
            $('html,body').animate({scrollTop: $("#banner_erro").offset().top - 200},'slow');
            return false;
}

				else{
					$('#banner_erro').html('');
				}
				
				if(fac_banner!=''){
				 var image_size=parseFloat($("#input-file-banner")[0].files[0].size / 1024).toFixed(2);
				 
			    if(image_size>500){
					   $('#banner_erro').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#banner_erro').html('');
				}
				if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
					$('#banner_erro').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#banner_erro').html('');
			    }
			 }
			 }
			 




	if(fac_about == ''){
		$('#textacademy').show();
		$('#errFacilitydescription').html('Please enter about message');
		$('html,body').animate({scrollTop: $("#errFacilitydescription").offset().top - 200},'slow');
		return false;
	}else{
		$('#errFacilitydescription').html(''); 
	}

	if(fac_city == ''){
		$('#facilitycity').show();
		$('#errFacilitycity').html('Please enter city');
		$('html,body').animate({scrollTop: $("#errFacilitycity").offset().top - 200},'slow');
		return false;
	}else{
		$('#errFacilitycity').html(''); 
	}

	if(fac_area == ''){
		$('#facilityarea').show();
		$('#errFacilityrea').html('Please enter area');
		$('html,body').animate({scrollTop: $("#errFacilityrea").offset().top - 200},'slow');
		return false;
	}else{
		$('#errFacilityrea').html(''); 
	}


	if(fac_pincode == ''){
		$('#facilitypincode').focus();
		$('#errFacilitypincode').html('Please enter pincode');
		$('html,body').animate({scrollTop: $("#errFacilitypincode").offset().top - 240},'slow');
		return false;
	}
	else{
		$('#errFacilitypincode').html('');
	}

	if(validPincode!=6){
		$('#facilitypincode').focus();
		$('#errFacilitypincode').html('Please enter correct pincode');
		$('html,body').animate({scrollTop: $("#errFacilitypincode").offset().top - 240},'slow');
		return false;
	}else{
		$('#errFacilitypincode').html('');
	showingLoader();
	}

	var form = $('#step_2_form')[0];
  
 
	var myFormData = new FormData(form);

				//myFormData.append('admin_profile', $('#input-file-now')[0].files[0]);
				//myFormData.append('tax_file', $('input[type=file]')[0].files[0]); 
				myFormData.append('action', 'fac_step_2');
                 
				$.ajax({
					url:'<?php echo base_url();?>login/complete_profiling',
					type: 'POST',
					data: myFormData,
					cache: false,
					processData: false,
					contentType: false,
					async: false,
					success:function(res){
						
						if(res!='failed'){
							
							jQuery(".nav-link.listingtab").trigger("click");
							$('html, body').animate({ scrollTop: 0 }, 'slow', function () {

							});
							$('#facilityname1').val('');
							$('#fac_id').val('');
							$('#textacademy').val('');
							$('#facilitycity').val('');
							$('#facilityarea').val('');
							$('#facilitypincode').val('');
							$('#facilityname').val('');
							$(".timinginitator").show();
							$(".editbox").hide();
							$("#mySelect").empty();
							$("#mySelect_hidden").empty();
							$(".dropify-clear").trigger("click");

					//$(".dropify").trigger("click");
					$('option:selected').prop('selected', false);
					//$('#achievementcheckbox').prop('checked', false);

									$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>login/fac_percent',	
				data: {},
				success:function(res){
					$(".pro_percent").html(res['_html']);
				}	
				});
				}
				else{
					$('#error_msg').show(); 
					$('#error_msg').text("Network issue"); 
				}				    
				hiddingLoader();
			}	
		});  

			});

/*############################*/	


//Facility Academy Details

$('#facList').click(function() {
//var user_id  = $(this).find('#last_user_insert_id').val();
//alert('test');
action='fac_details';
$.ajax({
type: "POST",
//async: true,
url:'<?php echo base_url();?>login/getfacDetails',	
data: {},
success:function(res){
	$("#fac_details_listing").html(res['_html']);
}	
});

});

//##########################

/*add facility Sports*/


$('#add_fac_sport').on('click', function(e) {
var sports_id =$("#sportsname option:selected" ).val();
var fac_id =$("#facname option:selected" ).val();
var courtnumber =$("#courtnumber").val();
var indor_qty =$("#kitquantity2" ).val();
indor_qty=(indor_qty==''?0:indor_qty);
var outdor_qty =$("#kitquantityoutdoor" ).val();
outdor_qty=(outdor_qty==''?0:outdor_qty);
var sport_court_id = $('#sport_court_id').val();
var result = parseInt(indor_qty) + parseInt(outdor_qty);


if(fac_id == 0)
{
$('#errFacname').html('Please Select Facility / Academy');
return false;
}

else
{
$('#errFacname').html('');	
}

if(sports_id == 0)
{
$('#errGame').html('Please Select Sports');
return false;
}

else
{
$('#errGame').html('');	
}

if(courtnumber == 0)
{
$('#errnucourts').html('Please enter court no.');
return false;
}

else
{
$('#errnucourts').html('');	
}

if(courtnumber!= result)
{
$('#errOutdorcourts').html('Sum of indor and outdor court must be equal to the total no of courts');
return false;
}

else
{
$('#errOutdorcourts').html('');	
}


action='fac_step_3';
showingLoader();
$.ajax({
type: "POST",
url:'<?php echo base_url();?>login/complete_profiling',	
data: {sports_id:sports_id,fac_id:fac_id,courtnumber:courtnumber,indor_qty:indor_qty,outdor_qty:outdor_qty,sport_court_id,sport_court_id,action:action},
success:function(res){

if(res!='failed'){
	 hiddingLoader();
	jQuery(".nav-link.sportslisting").trigger("click");

	$("#sportsname option:selected").prop('selected' , false);
	$("#facname option:selected").prop('selected' , false);
	$('#courtnumber').val(''); 
	$('#kitquantity2').val('');
	$('#kitquantityoutdoor').val('');
	$('#sport_court_id').val('');

	$.ajax({
type: "POST",
//async: true,
url:'<?php echo base_url();?>login/fac_percent',	
data: {},
success:function(res){
	$(".pro_percent").html(res['_html']);
}	
});

}
else{
	$('#error_msg').show(); 
	$('#error_msg').text("Network issue"); 
}				    

}	
});

});

//###############################


//Sport court Listing

$('#facsportslisting').click(function() {
//var user_id  = $(this).find('#last_user_insert_id').val();
//alert('test');
$.ajax({
type: "POST",
//async: true,
url:'<?php echo base_url();?>login/getSportCourtDetails',	
data: {},
success:function(res){
	$("#sportslist").html(res['_html']);
}	
});

});



//Get Acedamy / Facility Listing

$('#activate-step-3,#fac_sport_click').click(function() {
	$.ajax({
		type: "POST",
//async: true,
url:'<?php echo base_url();?>login/getfacListing',	
data: {},
success:function(res){
	$("#facname").html(res['_html']);

}	
});

});



//Amenity add



$('#activate-step-5').on('click', function(e) {

var amenity_id=[];
$(".myCheck:checked").each(function() {
amenity_id.push($(this).val());
});
var amenity_ids = amenity_id.join(',') ;
if(amenity_ids == '')
{
$('#erramenity').html('Please Select atleast one Amenity');
return false;
}

else
{
$('#erramenity').html('');	
}

action='fac_step_4';
showingLoader();

$.ajax({
type: "POST",
url:'<?php echo base_url();?>login/complete_profiling',	
data: {amenity_ids:amenity_ids,action:action},
success:function(res){
	

if(res!='failed'){
	hiddingLoader();
	
	//$('.myCheck').prop('checked', false);
	$('ul.setup-panel li:eq(4)').removeClass('disabled');
	$('ul.setup-panel li a[href="#step-5"]').trigger('click');

	$.ajax({
type: "POST",
//async: true,
url:'<?php echo base_url();?>login/fac_percent',	
data: {},
success:function(res){
	$(".pro_percent").html(res['_html']);
}	
});

}
else{ 
	$('#erramenity').text("Network issue"); 
}				    

}	
});

});



/*Step5 ajax start here*/

$('#activate-step-6').on('click', function(e) {

var ifsccode = $('#ifsccode').val();
var bankname = $('#bankname').val(); 
var branchname = $('#branchname').val();
var accountname = $('#account_name').val();
var accountnumber = $('#accountnumber').val();

var gst_image =  $('input[name=gst_image]').val();
var extcatgst_image = gst_image.split('.').pop();


var pan_image =  $('input[name=pan_image]').val();
var extcatpan_image = pan_image.split('.').pop();


var firm_image =  $('input[name=firm_img]').val();
var extcatfirm_image = firm_image.split('.').pop();


var address_proof_image =  $('input[name=address_image]').val();
var extcataddress_proof_image = address_proof_image.split('.').pop();


var cheque_image =  $('input[name=Cancelled_check_image]').val();
var extcatcheque_image = cheque_image.split('.').pop();

	 //alert(gst_image);

	 if(ifsccode == ''){
	 	$('#ifsccode').show();
	 	$('#errAcountifsc').html('Please enter IFSC Code');
	 	$('html,body').animate({scrollTop: $("#errAcountifsc").offset().top - 200},'slow');
	 	return false;
	 }else{
	 	$('#errAcountifsc').html(''); 
	 }

	 if(bankname == ''){
	 	$('#bankname').show();
	 	$('#errAcountbankname').html('Please enter Bank Name');
	 	$('html,body').animate({scrollTop: $("#errAcountbankname").offset().top - 200},'slow');
	 	return false;
	 }else{
	 	$('#errAcountbankname').html(''); 
	 }


	 if(branchname == ''){
	 	$('#errAcountaddress').show();
	 	$('#errAcountaddress').html('Please enter branch address');
	 	$('html,body').animate({scrollTop: $("#errAcountaddress").offset().top - 200},'slow');
	 	return false;
	 }else{
	 	$('#errAcountaddress').html(''); 
	 }

	 if(accountname == ''){
	 	$('#errAcountname').show();
	 	$('#errAcountname').html('Please enter account name');
	 	$('html,body').animate({scrollTop: $("#errAcountname").offset().top - 200},'slow');
	 	return false;
	 }else{
	 	$('#errAcountname').html(''); 
	 }


	 if(accountnumber == ''){
	 	$('#errAcountno').show();
	 	$('#errAcountno').html('Please enter account number');
	 	$('html,body').animate({scrollTop: $("#errAcountno").offset().top - 200},'slow');
	 	return false;
	 }else{
	 	$('#errAcountno').html(''); 
	 }


	 if(gst_image == ''){
	 	$('#gst').show();
	 	$('#gst_image_error').html('Please Enter gst image');
	 	return false;
	 }
	 else{
	 	$('#gst_image_error').html('');
	 }
	 
	 if(gst_image!=''){
	 	var image_size=parseFloat($("#gst")[0].files[0].size / 1024).toFixed(2);
	 	
	 	if(image_size>500){
	 		$('#gst_image_error').html('Please attach image below 500 kb');
	 		return false;
	 	}
	 	else{
	 		$('#gst_image_error').html('');
	 	}
	 	if($.inArray(extcatgst_image,['png','jpg','jpeg','pdf']) == -1){
	 		$('#gst_image_error').html('Please attach image in png, jpg, jpeg or pdf format only');			
	 		return false; 
	 	}
	 	else{
	 		$('#gst_image_error').html('');
	 	}
	 }

	 if(pan_image == ''){
	 	$('#pan').show();
	 	$('#pan_image_error').html('Please Enter pancard image');
	 	return false;
	 }
	 else{
	 	$('#pan_image_error').html('');
	 }
	 
	 if(pan_image!=''){
	 	var image_size=parseFloat($("#pan")[0].files[0].size / 1024).toFixed(2);
	 	
	 	if(image_size>500){
	 		$('#pan_image_error').html('Please attach image below 500 kb');
	 		return false;
	 	}
	 	else{
	 		$('#pan_image_error').html('');
	 	}
	 	if($.inArray(extcatpan_image,['png','jpg','jpeg','pdf']) == -1){
	 		$('#pan_image_error').html('Please attach image in png, jpg, jpeg or pdf format only');         
	 		return false; 
	 	}
	 	else{
	 		$('#pan_image_error').html('');
	 	}
	 }

	 if(firm_image == ''){
	 	$('#regd').show();
	 	$('#firm_image_error').html('Please Enter business registration no. image');
	 	return false;
	 }
	 else{
	 	$('#firm_image_error').html('');
	 }
	 
	 if(firm_image!=''){
	 	var image_size=parseFloat($("#regd")[0].files[0].size / 1024).toFixed(2);
	 	
	 	if(image_size>500){
	 		$('#firm_image_error').html('Please attach image below 500 kb');
	 		return false;
	 	}
	 	else{
	 		$('#firm_image_error').html('');
	 	}
	 	if($.inArray(extcatfirm_image,['png','jpg','jpeg','pdf']) == -1){
	 		$('#firm_image_error').html('Please attach image in png, jpg, jpeg or pdf format only');         
	 		return false; 
	 	}
	 	else{
	 		$('#firm_image_error').html('');
	 	}
	 }

	 if(address_proof_image == ''){
	 	$('#addressproof').show();
	 	$('#address_image_error').html('Please Enter address proof image');
	 	return false;
	 }
	 else{
	 	$('#address_image_error').html('');
	 }
	 
	 if(address_proof_image!=''){
	 	var image_size=parseFloat($("#addressproof")[0].files[0].size / 1024).toFixed(2);
	 	
	 	if(image_size>500){
	 		$('#address_image_error').html('Please attach image below 500 kb');
	 		return false;
	 	}
	 	else{
	 		$('#address_image_error').html('');
	 	}
	 	if($.inArray(extcataddress_proof_image,['png','jpg','jpeg','pdf']) == -1){
	 		$('#address_image_error').html('Please attach image in png, jpg, jpeg or pdf format only');         
	 		return false; 
	 	}
	 	else{
	 		$('#address_image_error').html('');
	 	}
	 }

	 if(cheque_image == ''){
	 	$('#cancelledcheque').show();
	 	$('#cheque_image_error').html('Please enter cheque image');
	 	return false;
	 }
	 else{
	 	$('#cheque_image_error').html('');
	 }
	 
	 if(cheque_image!=''){
	 	var image_size=parseFloat($("#cancelledcheque")[0].files[0].size / 1024).toFixed(2);
	 	
	 	if(image_size>500){
	 		$('#cheque_image_error').html('Please attach image below 500 kb');
	 		return false;
	 	}
	 	else{
	 		$('#cheque_image_error').html('');
	 	}
	 	if($.inArray(extcatcheque_image,['png','jpg','jpeg','pdf']) == -1){
	 		$('#cheque_image_error').html('Please attach image in png, jpg, jpeg or pdf format only');         
	 		return false; 
	 	}
	 	else{
	 		$('#cheque_image_error').html('');
	 	}
	 }

$('ul.setup-panel li:eq(5)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-6"]').trigger('click'); 


var form = $('#step_6_form')[0];
var myFormData = new FormData(form);
showingLoader();

myFormData.append('action', 'fac_step_5');
$.ajax({
url:'<?php echo base_url();?>login/complete_profiling',
type: 'POST',
data: myFormData,
cache: false,
processData: false,
contentType: false,
async: false,
success:function(res){

if(res!='failed'){
	hiddingLoader();
$('#thankyouprofile').modal('show');

}
else{
	$('#error_msg').show(); 
	$('#error_msg').text("Network issue"); 
}				    

}	
});  

});



$('#go_to_dashboard').on('click', function(e) {

action='go_to_dashboard';

$.ajax({
type: "POST",
url:'<?php echo base_url();?>login/complete_profiling',	
data: {action:action},
success:function(res){
				//alert(res);
				if(res!='failed'){
					
					window.location.href = '<?php echo base_url('dashboard') ?>';

				}
				else{ 
					$('#erramenity').text("Network issue"); 
				}				    

			}	
		});  

});

/*############################*/	







$('.listproceed').on('click', function(e) {
var facilityname = $('#facilityname').val();
var timing = $('#timing').val(); 
var facilitydescription = $('#textacademy').val();
var facilitycity = $('#facilitycity').val();
var facilityarea = $('#facilityarea').val();
var facilitypincode = $('#facilitypincode').val();

if(facilityname == ''){
$('#errFacilityname1').show();
$('#errFacilityname1').html('Please enter Facility Name');
$('#errFacilityname1 i').html('');
$('html,body').animate({scrollTop: $("#errFacilityname1").offset().top - 200},'slow');
return false;
}else{
$('#errFacilityname1').html('');
}

if(timing == ''){
$('#errTiming').show();
$('#errTiming').html('Please enter Timing');
$('html,body').animate({scrollTop: $("#errTiming").offset().top - 200},'slow');
return false;
}else{
$('#errTiming').html(''); 
}






if(facilitycity == ''){
$('#errFacilitycity').show();
$('#errFacilitycity').html('Please enter City');
$('html,body').animate({scrollTop: $("#errFacilitycity").offset().top - 200},'slow');
return false;
}else{
$('#errFacilitycity').html(''); 
}


if(facilityarea == ''){
$('#errFacilityrea').show();
$('#errFacilityrea').html('Please enter Area');
$('html,body').animate({scrollTop: $("#errFacilityrea").offset().top - 200},'slow');
return false;
}else{
$('#errFacilityrea').html(''); 
}


if(facilitypincode == ''){
$('#errFacilitypincode').show();
$('#errFacilitypincode').html('Please enter Pincode');
$('html,body').animate({scrollTop: $("#errFacilitypincode").offset().top - 200},'slow');
return false;
}else{
$('#errFacilitypincode').html(''); 
$(this).addClass('list')

}


if(achievement == ''){
$('#errAchievement').show();
$('#errAchievement').html('Please enter Achievement');
$('html,body').animate({scrollTop: $("#errAchievement").offset().top - 200},'slow');
return false;
}else{
$('#errAchievement').html(''); 
}



$('ul.setup-panel li:eq(2)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-3"]').trigger('click');    	
});





$('#activate-step-6').on('click', function(e) {
$('ul.setup-panel li:eq(5)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-6"]').trigger('click');
});


$('#activate-step-3').on('click', function(e) {
jQuery("#step-3").show();
jQuery("#step-2").hide();
$('ul.setup-panel li:eq(2)').removeClass('disabled disable-click');
$('ul.setup-panel li a[href="#step-3"]').trigger('click');
$('html,body').animate({scrollTop: 0 },'slow');
});




$('#activate-step-7').on('click', function(e) {
$('ul.setup-panel li:eq(5)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-7"]').trigger('click');    	
});
// Let Me Do Later
$('#do-later-activate-step-2').on('click', function(e) {
$('ul.setup-panel li:eq(1)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-2"]').trigger('click');    	
});
$('#do-later-activate-step-3').on('click', function(e) {
$('ul.setup-panel li:eq(2)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-3"]').trigger('click');    	
});
$('#do-later-activate-step-4').on('click', function(e) {
$('ul.setup-panel li:eq(3)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-4"]').trigger('click'); 
$('#infoGraphicBankDetails').modal('show');    	
});
$('#do-later-activate-step-5').on('click', function(e) {
$('ul.setup-panel li:eq(4)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-5"]').trigger('click');
});
$('#do-later-activate-step-6').on('click', function(e) {
$('ul.setup-panel li:eq(5)').removeClass('disabled');
$('ul.setup-panel li a[href="#step-6"]').trigger('click');    	
});
// Previous
$('#previous-activate-step-1').on('click', function(e) {    	
$('ul.setup-panel li a[href="#step-1"]').trigger('click');    	
});
$('#previous-activate-step-2').on('click', function(e) {
$('ul.setup-panel li a[href="#step-2"]').trigger('click');    	
});
$('#previous-activate-step-3').on('click', function(e) {    
$('ul.setup-panel li a[href="#step-3"]').trigger('click');    	
});
$('#previous-activate-step-4').on('click', function(e) {    	
$('ul.setup-panel li a[href="#step-4"]').trigger('click');    	
});

$('#dontKnowIFSC').click(function () {
if ($(this).prop('checked')) {   	
	$('#letMeEnterDetails').slideUp();
}
else {                
	$('#letMeEnterDetails').slideDown();
}
});
});

jQuery(".skipsection").on("click", function(){ jQuery(this).parents("section").hide();
$('ul.setup-panel li:eq(1)').removeClass('disabled');
$('ul.setup-panel li').removeClass('active');
$('ul.setup-panel li:eq(4)').removeClass('disabled');
$('ul.setup-panel li:eq(4)').addClass('active');

jQuery("#step-5").show();

$('html,body').animate({scrollTop: 0 },'slow');

});



$('#facility input[type=radio]').change(function() {
if (this.value == 'Academy') {
jQuery("#facilityname1").siblings('label').text("Academy Name");
jQuery("#textacademy").siblings('label').text("About Academy");
}
else if (this.value == 'Facility') {
jQuery("#facilityname1").siblings('label').text("Facility Name");
jQuery("#textacademy").siblings('label').text("About Facility");
}
});




jQuery(document).on("click", "#shopTimingBtn", function(){
	var mno = jQuery(".sm_inputs").find(".list-inline-item.checked").length;
	if(mno==0){$("#oneselect").show(); $("#oneselect").html("Please Select at least one day"); return false;}

jQuery("#mySelect option").each(function(){var cdf = jQuery(this).text(); if(cdf.indexOf("undefined") > -1){jQuery(this).remove()}});
jQuery("#shopTiming .close").trigger("click");
jQuery("#mySelect,#mySelect_hidden").empty();

jQuery(".list-inline-item.checked").each(function(){ 
var bookdate = jQuery(this).find(".day").text(); 
var bookopentime = jQuery(this).find("input[type='text']").val();
var bookclosetime = jQuery(this).find("input.closing").val();
console.log(bookclosetime);


var abc = jQuery(".sm_inputs").find(".list-inline-item.checked").length;

if(abc > 0)
{
	$("#oneselect").html("");
jQuery("#shopTiming .close").trigger("click");
jQuery(".editbox").show();
jQuery("#defaulttimingcontainer").addClass('is-filled');
jQuery("#mySelect,#mySelect_hidden").empty();
jQuery(".timinginitator").hide();
/*    $('#mySelect').append('<option value="' + key + '">' + selectValues[key] + '</option>');*/
setTimeout(function(){

	jQuery("#mySelect,#mySelect_hidden").append('<option selected value="'+ bookdate +'-'+ bookopentime +'-'+ bookclosetime +'"><span style="width:120px">'+ bookdate +'</span> : '+ bookopentime +'  to '+ bookclosetime +'</span></option><i class="fa fa-clock-o prefix" aria-hidden="true"></i> <i class="fa fa-edit prefix edittimepopup" data-toggle="modal" data-target="#shopTiming" aria-hidden="true"></i>');

	jQuery("#exampleModalLongTitle").text("Edit Opening & Closing Time");
	jQuery("#shopTimingBtn").text("Update");

},200);
}

})





});


jQuery("#listingtabbtn").on("click", function(){
jQuery("#academyfacilitywrapper").hide();
jQuery("#listingwrapper").show();
});

jQuery("#academytabbtn").on("click", function(){
jQuery("#academyfacilitywrapper").show();
jQuery("#listingwrapper").hide();
});

/*$('#shopTiming').modal('show'); */



$('#achievementcheckbox').change(function() {
if($(this).is(":checked")) {
jQuery("#achievementtable").show();
}

else{jQuery("#achievementtable").hide();}

});

$('.checkboxenable').change(function() {
if($(this).is(":checked")) {
jQuery(this).parents(".gap15").find(".priceforavaialable").show();
}

else{jQuery(this).parents(".gap15").find(".priceforavaialable").hide();}

});



$(document).on("click",".imagesachieve .dropify-clear", function(){$(this).parents(".imagesachieve").find("input").val("")});




jQuery(document).on("click", "#add_grneral,.editparent", function(){
$("#achievementtable").append('<div class="boxachievement"><div class="row"><div class="col-md-3" id="titleEdit" style="display: none"><div class="form-group bmd-form-group-sm bmd-form-group"> <label for="titleValue" class="bmd-label-floating">Type</label> <input type="text" class="form-control" id="titleValue"> <i class="fa fa-list-alt prefix"></i></div></div><div class="col-md-3" id="selectBoxTitle"><div class="form-group selectdiv bmd-form-group is-filled"> <select class="form-control custom-select-sm" id="selectOfferTitle" name="reward_type[]"><option disabled="disabled" selected="selected">Select Achievement Type</option><?php foreach($rewards_type as $rewards) { ?><option value="<?=$rewards->reward_id;?>"><?=$rewards->reward_name;?></option><?php } ?></select> <i class="fa fa-list-alt prefix"></i></div></div><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="facilityname" class="bmd-label-floating">Title</label> <input type="text" class="form-control" id="facilityname" name="reward_title[]"><i class="fa fa-trophy prefix"></i> <span id="errFacilityname" class="error"> </span></div></div><div class="col-md-2"> <input type="file" id="input-file-image1" name="achievement_img1[]" class="dropify input-file-image1" accept="image/png, image/jpeg, image/jpg" /></div><div class="col-md-2"> <input type="file" id="input-file-image2" name="achievement_img2[]" class="dropify input-file-image2" accept="image/png, image/jpeg, image/jpg" /></div><div class="col-sm-1">	<a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm deleteparent" ><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div></div></div>');

$('.dropify').dropify({});


});



setTimeout(function(){
jQuery("#input-file-banner").siblings(".dropify-message").find("p").text("Upload Banner");

jQuery("#input-file-image1").siblings(".dropify-message").find("p").text("Image 1");
jQuery("#input-file-image2").siblings(".dropify-message").find("p").text("Image 2");
jQuery("#defaulttimingcontainer").removeClass('is-filled');
},200)

jQuery(document).on("click", '.deleteparent', function(){jQuery(this).parents(".boxachievement").remove()});


</script>
<script>

</script>
<script>
jQuery(document).on("click", ".checkbox-decorator", function(){
jQuery(this).parents(".list-inline-item").toggleClass("checked")
});





/*jQuery(".listingamenties").on("click", function(){jQuery(".nav-link.sportslisting").trigger("click");
$('html, body').animate({ scrollTop: 0 }, 'slow', function () {

});});*/


/*jQuery(".editsports").on("click", function(){jQuery('.sportstab').trigger('click')});


setTimeout(function()
{
jQuery("#mondayOp").trigger("click");
},200);*/




</script>




<script>
setTimeout(function(){
jQuery("#input-file-banner").siblings(".dropify-message").find("p").text("Upload Primary Banner (500px*500px)");

jQuery("#input-file-image1").siblings(".dropify-message").find("p").text("Image 1 (200px*200px)");
jQuery("#input-file-image2").siblings(".dropify-message").find("p").text("Image 2  (200px*200px)");
jQuery("#step-5 input#gst").siblings(".dropify-message").find("p").text("Upload GST Doc.");
jQuery("#step-5 input#pan").siblings(".dropify-message").find("p").text("Upload PAN Card");
jQuery("#step-5 input#regd").siblings(".dropify-message").find("p").text("Upload Registration Doc.");
jQuery("#step-5 input#addressproof").siblings(".dropify-message").find("p").text("Upload Address Proof (Rent Agreement, Postpaid Bill)");
jQuery("#step-5 input#cancelledcheque").siblings(".dropify-message").find("p").text("Upload Cancelled Cheque");
jQuery("#defaulttimingcontainer").removeClass('is-filled');
},200)

jQuery(document).on("click", '.deleteparent', function(){jQuery(this).parents(".boxachievement").remove()});

jQuery("#infoGraphicBusinessDetails").modal('show');
jQuery(".deleteacademyfacility").on("click", function(){jQuery(this).parents(".single-facility-listing").remove()});
jQuery("#sportstable .deletesports").on("click", function(){jQuery(this).parents('tr').remove()});
jQuery(".timinginitator").on("click", function()
{jQuery("#shopTiming .list-inline-item").each(function(){jQuery(this).find(".day").parent(".col-md-3").next().find("input").val("7:00 AM"); jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val("9:00 PM");});})



$(document).on("click", '.selectall input', function() {
if($(".list-inline-item.checked").length > 0){
var rrr =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().next().find("input").val();
var iii =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().find("input").val();

 $("#shopTiming .list-inline-item.checked").find('.checkbox-decorator').trigger("click");  $("#shopTiming .list-inline-item").each(function(){
jQuery(this).find(".day").parent(".col-md-3").next().find("input").val(iii);
jQuery(this).find(".day").parent(".col-md-3").next().next().find("input.closing").val(rrr);

$(this).find('.checkbox-decorator').trigger("click");	
});	
	
}

else{
 $("#shopTiming .list-inline-item").each(function(){
jQuery(this).find(".day").parent(".col-md-3").next().find("input").val('7:00 AM');
jQuery(this).find(".day").parent(".col-md-3").next().next().find("input.closing").val('9:00 PM');

$(this).find('.checkbox-decorator').trigger("click");	
});}	


 });
 
 $("#shopTiming .list-inline-item input").on("click", function(){if($(".list-inline-item.checked").length < 7){$(".selectall input").prop("checked", false)}});


﻿
﻿

$('.td-overlay, .td-clock, .td-select')
            .on('click', evt => {
          jQuery(".list-inline-item").each(function(){
			  var abc = jQuery(this).find(".day").parent(".col-md-3").next().find("input").val();
			  var cdf = jQuery('.list-inline-item.checked').find(".day").parent(".col-md-3").next().find("input").val();
			  var mmm = jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val();
			  var rrr = jQuery('.list-inline-item.checked').find(".day").parent(".col-md-3").next().next().find("input").val();

			  if(abc != cdf || mmm != rrr){$(".selectall input").prop("checked", false);}
			  
})
            });



setTimeout(function(){
$(document).each('textarea', function(){
   if($(this).val()!=""){$(this).parent(".bmd-form-group").addClass('is-focused');}});
},500);

	jQuery("#shopGallery .list-inline-item").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
/*	jQuery("#step-2 dropify").each(function(){var abc = $(this).attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
*/
jQuery('.btn_proceed').on("click", function(){
$('.progress-bar').removeClass('yellownew rednew greennew');
setInterval(function(){
var sdf = $('.pro_percent').text();
var mgh = sdf + '%';
$('.progress-bar').css('width', mgh);
if(sdf < 90 & sdf >49 )
{
	$('.progress-bar').removeClass('rednew');	
$('.progress-bar').addClass('yellownew');
}

else if(sdf > 0 & sdf < 50)
{
$('.progress-bar').addClass('rednew');
}

else if(sdf > 99)
{
$('.progress-bar').removeClass('rednew');
$('.progress-bar').removeClass('yellownew');	
$('.progress-bar').addClass('greennew');
}


},300);

});

/*setInterval(function(){
jQuery(".dropify-wrapper").each(function(){var abc = $(this).find("#input-file-banner").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){ $(this).find('.dropify-clear').trigger('click')}});},300);
*/

/*$("select#sportsname").on("change", function(){$(this).find("option:selected").attr("disabled",true)});*/


</script>

<script>
$(document).ready(function(){
$('#sportsname,#facname').on('change', function() {
var fac_id = $("#facname option:selected").val();   
var sport_id = $("#sportsname option:selected").val();
 
if(fac_id!= 0){
  $.ajax({
type:'post',
url:'<?=base_url('login/check_sport_name');?>',
data:{fac_id:fac_id,sport_id:sport_id},
success: function(data){
 if(data == 1){
 $('#errGame').html("Sport name alredy exist");
 $("#add_fac_sport").css("pointer-events","none");
}
else{
 $('#errGame').html("");
 $("#add_fac_sport").css("pointer-events","auto");
}
}
 });
}

   });


$('.bannerlogonew1 .dropify-clear').click(function() {
   $(this).parents(".bannerlogonew1").find('input#old_fac_banner').val('')
});

$(".input-file-image1").parents(".dropify-wrapper").find('dropify-clear').click(function() {
	alert();
   $(this).parents(".boxachievement").find('.old_achievement_image1').val('')
});


$(".input-file-image2").parents(".dropify-wrapper").find('dropify-clear').click(function() {
   $(this).parents(".boxachievement").find('.old_achievement_image1').val('')
});

});	

$("#sportsname").attr("disabled","disabled");
$("#facname").on("change", function(){$("#sportsname").removeAttr("disabled");});


$(".timinginitator").on("click", function(){
	$(".selectall input").prop("checked", false);
	$("#shopTiming .list-inline-item.checked").each(function(){$(this).find('.checkbox-decorator').trigger("click");});});
</script>

<!-- Google location -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

<script>
	
	function initMap() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		autocomplete1 = new google.maps.places.Autocomplete(
			/** @type {!HTMLInputElement} */(document.getElementById('useraddress2')),
			{types: ['geocode']});
		

		autocomplete1.addListener('place_changed', function() {
			//infowindow.close();
			var place = autocomplete1.getPlace();
			$('#latitude').val(place.geometry.location.lat());
			$('#longitude').val(place.geometry.location.lng());
		});

		autocomplete2 = new google.maps.places.Autocomplete(
			/** @type {!HTMLInputElement} */(document.getElementById('facilitycity')),
			{types: ['geocode']});
		autocomplete2.addListener('place_changed', function() {
			//infowindow.close();
			
			var place = autocomplete2.getPlace();
			$('#fac_latitude').val(place.geometry.location.lat());
			$('#fac_longitude').val(place.geometry.location.lng());
		});
		
	}

	var addressInputElement = $('#facilitycity');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
})

var addressInputElement2 = $('#useraddress2');
addressInputElement2.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement2.parent()).append(pacContainer);
})

setInterval(function(){
jQuery("#useraddress2,#facilitycity").removeAttr("placeholder");
},100);
Cookies.remove("yourCookieName");
Cookies.remove("yourCookieselectvalue");
jQuery("#useraddress2").removeAttr("placeholder");
</script>

</body>

</html>