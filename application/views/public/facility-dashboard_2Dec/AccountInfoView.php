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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.css"> -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
		<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css')?>">
		<style>
		.modal.fade.in
		{
			display: block !important;
		}
.show_password{top:52px !important;}
	</style>
</head>
<body class="dashboard sidebar-is-expanded">
	<div class="clearfix"></div>
	<?php $this->load->view('public/common/dashboard-sidebar');?>
	<main class="l-main">
		<div class="header-data">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="top-head-nav clearfix">
							<div class="page-title float-md-left">
								<h1>My Profile</h1>
							</div>
							<div class="navigation-bread float-md-right">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">	
										<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">My Dashboard</a></li>	
										<li class="breadcrumb-item active" aria-current="page">My Profile</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-wrapper content-wrapper--with-bg">
			<div class="container-fluid">
				<div class="main_m8place__container pt-0">
					<div class="data_profile_header1" style="background-image: url('<?=base_url('assets/public/images/dashboard/profile_bg.jpg')?>">
						<div class="container-fluid">
							<div class="row align-items-center">
								
								<div class="col-md-8 col-sm-8 col-8">
									<div class="profile_info">
										<h2 class="display-4 name"><?=$this->session->userdata('user_name');?></h2>
										<ul class="list-unstyled list_info_profile">
											<li class="varified_status"><a href="javascript:void(0)"><i class="fa fa-envelope-o"></i><?=$this->session->userdata('user_email');?></a><?php if($fac_personal_data && $fac_personal_data->is_email_verified=='no'){?> <a href="javascript:void(0)" class="error varifiy_email">Email not verified </a> <?php } else{?><a href="javascript:void(0)" class="error">Email verified </a> <?php } ?></li>
											<li><a href="javascript:void(0)"><i class="fa fa-mobile"></i><?=$this->session->userdata('user_mobile_no');?></a></li>
											<li>									
												<a href="#" class="btn btn-raised btn-sm save_btn change_password_btn" data-toggle="modal" data-target="#changePassword">Change Password</a>
											</li>
										</ul>
									</div>

								</div>	
								<div class="col-md-4">
									<div class="profile_complete_indicatior progress-bar-top d-inline-block float-right profile_edit_progress">
										<h5 class="title text-center">Your profile is <span class="completedprofile"><?=$profile_percent;?></span>% completed</h5>
										<div class="progress" style="height: 10px;">
											<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?=$profile_percent;?>%"></div>
										</div>	

									</div>

									<div class="col-sm-12 nopadright" style="margin-top: 80px;text-align: right;">
										<a href="<?=base_url('dashboard/add_facility_academy');?>" class="" style="display: inline-block;padding: 15px;">
											<div class="c-menu__item__inner">
												<div class="c-menu-item__title orange-btn" style="padding: 5px 15px; margin-right: -15px;
												"><i class="fa fa-university"></i><span>Add Facility/Academy</span></div>
											</div>
										</a>
									</div>
								</div>					
							</div>
						</div>
					</div>
					<div class="main_profile_conatiner" id="account-information">
						<div class="container">
							<div class="data_profile_data">
								<nav class="profile_tab" id="account-tabs">
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true"><i class="fa fa-user-circle-o"></i>Profile Summary</a>
										<a class="nav-item nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><i class="fa fa-building"></i>Facility/Academy Details</a>
										<a class="nav-item nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><i class="fa fa-futbol-o"></i>Sports/Amenities Details</a>
										<a class="nav-item nav-link" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false"><i class="fa fa-clock-o"></i>Opening & Closing Time</a>
										<a class="nav-item nav-link" id="shop-gallery-tab-tab" data-toggle="tab" href="#shop-gallery-tab" role="tab" aria-controls="shop-gallery-tab" aria-selected="false"><i class="fa fa-picture-o"></i>Gallery</a>
										<a class="nav-item nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><i class="fa fa-university"></i>Bank Details</a>
									</div>
								</nav>
								<div class="tab-content profile_tab_content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-12">
														<div class="cus_modal profile_modal">
															<div class="cus_modal_header clearfix">
																<h5 class="title">
																	<a class="toggle">
																		<i class="fa fa-user-circle-o"></i> Personal Information 
																	</a>
																</h5>
															</div>
															<div class="collapse show" id="collapseExample">
																<div class="cus_modal_body">
																	<div class="details_box">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Name</h4>
																					<p class="detail_item" id="name_text"><?php if($fac_personal_data) echo $fac_personal_data->user_name;?></p>
																				</div>
																			</div>	
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Gender</h4>
		<p class="detail_item" id="gender_text"><?php if($fac_personal_data && $fac_personal_data->user_gender=='M') echo "Male"; else if($fac_personal_data && $fac_personal_data->user_gender=='F') echo "Female"; else if($fac_personal_data && $fac_personal_data->user_gender=='T') echo "Other";?></p>
																				</div>
																			</div>					
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Email ID </h4>
																					<span class="detail_item emailp" style="text-transform: lowercase"><?php if($fac_personal_data) echo $fac_personal_data->user_email;?></span>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Mobile Number</h4>
																					<p class="detail_item"><?php if($fac_personal_data) echo $fac_personal_data->user_mobile_no;?></p>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">City</h4>
																					<p class="detail_item" id="city_text">	<?php if($fac_personal_data) echo $fac_personal_data->user_city;?></p>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Sub Area</h4>
																					<p class="detail_item" id="sub_area_text" >	<?php if($fac_personal_data) echo $fac_personal_data->user_address2;?></p>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Address</h4>
																					<p class="detail_item" id="address_text"><?php if($fac_personal_data) echo $fac_personal_data->user_address;?></p>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="contain_data">
																					<h4 class="display-4 heading_item">Pin Code</h4>
																					<p class="detail_item" id="pincode_text"><?php if($fac_personal_data) echo $fac_personal_data->user_pincode;?></p>
																				</div>
																			</div>
																		</div>
																		<a href="javascript:void(0)" class="edit_btn" data-toggle="modal" data-target="#profile-edit"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
																	</div>
																</div>
															</div>
														</div>
													</div>											
												</div>
											</div>

											<div class="col-md-6">
												<div class="row">
													<div class="col-md-12">
														<div class="cus_modal profile_modal">
															<div class="cus_modal_header clearfix">
																<h5 class="title">
																	<a class="toggle">
																		<i class="fa fa-id-card-o"></i> Profile Status 
																	</a>
																</h5>
															</div>
															<div class="collapse show" id="collapseExample1">
																<div class="cus_modal_body">
																	<div class="details_box mt-1">
																		<div class="row">
																			<div class="col-md-4">
																				<div class="profile_status_rib1 clearfix">
																					<?php if($profile_percent==100) {?>
																					<p class="status1 completed"><i class="fa fa-check"></i> Completed</p>
																					<?php } else{?>
																					<p class="status1 pending"><i class="fa fa-clock-o"></i> Pending</p>
																					<?php }?>
																					<h5>Profile</h5>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="profile_status_rib1 clearfix">
																					<p class="status1 pending"><i class="fa fa-clock-o"></i> Pending</p>
																					<h5>Facility/Academy Details</h5>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<a href="javascript:void(0)">
																					<div class="profile_status_rib1 clearfix" id="rejected_popup">
																						<!-- <p class="status1 rejected">
																							<i class="fa fa-times"></i> Rejected
																						</p> -->
																						<p class="status1 pending"><i class="fa fa-clock-o"></i> Pending</p>
																						<h5>Bank Details</h5>
																					</div>
																				</a>
																			</div>
																			<div class="col-md-4">
																				<div class="profile_status_rib1 clearfix">
																					<!-- <p class="status1 inreview"><i class="fa fa-spinner"></i> In-review</p> -->
																					<p class="status1 pending"><i class="fa fa-clock-o"></i> Pending</p>
																					<h5>Upload Documents</h5>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="profile_status_rib1 clearfix">
																					<p class="status1 pending"><i class="fa fa-clock-o"></i> Pending</p>
																					<h5>Opening/Closing Timings</h5>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="profile_status_rib1 clearfix">
																					<!-- <p class="status1 completed"><i class="fa fa-check"></i> Completed</p> -->
																					<p class="status1 pending"><i class="fa fa-clock-o"></i> Pending</p>
																					<h5>My Sports Gallery</h5>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>								
										</div>
									</div>
									<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
										<div class="row">
											<div class="col-md-12">
												<div id="facDetailAjax"></div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
										<div class="row">
											<div class="col-md-12">
												<div id="facBankAjax"></div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
										<div class="row">
											<div class="col-md-12">
												<div id="sport_aminityAjax"></div>
											</div>
										</div>
									</div>


									<div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
										<div class="row">
											<div class="col-md-12">
												<div id="sport_TimingAjax"></div>
											</div>										
										</div>									
									</div>

									<div class="tab-pane fade" id="shop-gallery-tab" role="tabpanel" aria-labelledby="shop-gallery-tab-tab">
										<div class="row">
											<div class="col-md-12">
												<div id="fac_galleryAjax"></div>
											</div>									
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		 <div class="loader">
										<div class="">
											<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
										</div>
								</div>
		<!-- Footer Include Here -->
		<?php $this->load->view('public/common/footer');?>
		<script src="<?=base_url('assets/public/js/slick.min.js')?>"></script>
		<script src="<?=base_url('assets/public/js/jquery.zoom.min.js')?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
		<script src="<?=base_url('assets/public/js/timedropper.js')?>"></script>

		<p style="display: none" id = "status"></p>
		<a id = "map-link" target="_blank"></a>
	</div>

	<?php $this->load->view('public/common/foot');?>
	<script src="<?=base_url('assets/public/js/ropify.min.js')?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	

	<div class="modal fade modal_default view_deal edit_profile_modal transact_pin_creation" id="newTransactPin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			<div class="modal-content">				
				<div class="modal-header">
					<h5 class="modal-title pl-3" id="header-change">New Transact Pin</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="newPin">
						<div class="container-fluid">
							<form action="" class="sm_inputs">
								<div class="row">
									<div class="col-md-12 mt-4">
										<label for="translab" class="translabel enterpin">Enter Transact Pin</label>
										<div class="input-pin-container">
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
										</div>
									</div>
									<div class="col-md-12 mt-4">
										<label for="translab" class="translabel enterpin">Re-Type Transact Pin</label>
										<div class="input-pin-container">
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_pin">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
										</div>
									</div>		
									<div class="col-md-12 text-right">
										<a href="javascript:void(0);" class="forgotPin" id="forgotPinOld">Forgot Pin?</a>
									</div>						
								</div>
							</form>
							<div class="row">
								<div class="col-md-12 text-center">
									<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="newTransactPinBtn"> Save</a>
								</div>
							</div>
						</div>
					</div>
					<div id="forgotpinContainer" style="display: none;">
						<div class="container-fluid">
							<form action="" class="sm_inputs">
								<div class="row">									
									<div class="col-md-12">
										<p class="title_pin">Please Enter Your Registered Mobile Number</p>
										<div class="form-group bmd-form-group">

											<input type="text" class="form-control" id="regnum">
											<i class="fas fa-mobile-alt prefix"></i>	
											<p class="msg_pin">We will send an OTP to change your password</p>	
										</div>
									</div>				
								</div>
							</form>
							<div class="row">
								<div class="col-md-12 text-center">
									<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="sendPin"> Send</a>
								</div>									
							</div>
						</div>
					</div>
					<div id="verifyOTPContainer" style="display: none;">
						<div class="container-fluid">
							<form action="" class="sm_inputs">
								<div class="row">									
									<div class="col-md-12">
										<p class="title_pin">Please enter the OTP sent to your Mobile Number</p>
										<div class="input-pin-container text-center mt-2">
											<div class="form-group bmd-form-group-sm input_otp">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_otp">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_otp">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_otp">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_otp">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<div class="form-group bmd-form-group-sm input_otp">
												<input type="text" class="form-control" maxlength="1" id="entransactpin">
											</div>
											<p class="oTPExpire">OTP will expire in <span>00:30</span></p>
										</div>
									</div>				
								</div>
							</form>
							<div class="row">
								<div class="col-md-12 text-center">
									<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="otpVerified"> Submit</a>
								</div>
								<div class="col-md-12 text-center">
									<a href="javascript:void(0)" class="resend_otp">Resend OTP</a>
								</div>	
							</div>
						</div>
					</div>
					<div id="newOTPContainer" style="display: none;">
						<div class="container-fluid">
							<form action="" class="sm_inputs">
								<div class="row">									
									<div class="col-md-12">
										<p class="title_pin">Please enter new transact pin</p>
										<div class="col-md-12 mt-4">
											<label for="translab" class="translabel enterpin">Enter New Transact Pin</label>
											<div class="input-pin-container">
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
											</div>
										</div>
										<div class="col-md-12 mt-4">
											<label for="translab" class="translabel enterpin">Confirm New Transact Pin</label>
											<div class="input-pin-container">
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
												<div class="form-group bmd-form-group-sm input_pin">
													<input type="text" class="form-control" maxlength="1" id="entransactpin">
												</div>
											</div>
										</div>		
									</div>				
								</div>
							</form>
							<div class="row">
								<div class="col-md-12 text-center mt-2">
									<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="newPinSuccess"> Submit</a>
								</div>									
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade modal_default view_deal edit_profile_modal" id="myProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			<div class="modal-content">				
				<div class="modal-header">
					<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Profile Image</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="sm_inputs">
							<div class="row align-items-center">
								<div class="col-md-12">
									<div class="main-img-container profile_pic editpicProfile">
										<div class="main-title-upload-image">
											<h4>Profile Image</h4>
											<p>JPEG, PNG format only (Max Size : 2MB)</p>
										</div>
										<div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span> <p>Click here to upload</p><p class="dropify-error">Click here to upload</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" id="input-file-banner" class="dropify"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="progress" id="submitProfileProgress" style="height: 12px;">
										<div class="progress-bar progress-bar-success bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="loadProfile" style="width:0%">
											0%
										</div>
									</div>
								</div>
								<div class="col-md-12 text-center mt-3">
									<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-4" id="profileUpdated">Update</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal_default view_deal edit_profile_modal" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			<div class="modal-content">				
				<div class="modal-header">
					<h5 class="modal-title pl-3" id="exampleModalLongTitle">Change Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="sm_inputs">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="oldPassword" class="bmd-label-floating">Old Password<span class="required">*</span></label>
										<input type="password" class="form-control" id="oldPassword">
										
										<i class="fa fa-key prefix"></i>
										<a href="javascript:void(0)" class="show_password" id="oldPasswordEye">
										<i class="fa fa-eye eyeopenpassword eyepassword" style="display: none;"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword" style=""></i>
										</a>
										<span id="errOldPsw" class="error"> </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="newPassword" class="bmd-label-floating">New Password<span class="required">*</span></label>
										<input type="password" class="form-control" id="newPassword">
										<i class="fa fa-key prefix"></i>
										<a href="javascript:void(0)" class="show_password" id="newPasswordEye">
										<i class="fa fa-eye eyeopenpassword eyepassword" style="display: none;"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword" style=""></i>
										</a>
										<span id="errNewPsw" class="error"> </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="confirmPassword" class="bmd-label-floating">Confirm Password<span class="required">*</span></label>
										<input type="password" class="form-control" id="confirmPassword">
										<i class="fa fa-key prefix"></i>
										<a href="javascript:void(0)" class="show_password" id="confirmPasswordEye">
										<i class="fa fa-eye eyeopenpassword eyepassword" style="display: none;"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword" style=""></i>
										</a>
										<span id="errConfirmPsw" class="error"> </span>
									</div>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-12 text-center">
								<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="changePasswordBtn"> Update</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	

	

	

	


	

	


	<div class="modal fade modal_default view_deal edit_profile_modal" id="profile-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">				
				<div class="modal-header">
					<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit your Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form action="" class="sm_inputs">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="userName" class="bmd-label-floating">Name<span class="required">*</span></label>
										<input type="text" class="form-control" id="userName" onkeyup="leftTrim(this)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_name;?>">
										<span id="errName" class="error"></span>
										<i class="fa fa-user prefix"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="gender" class="bmd-label-floating">Gender</label>
										<select class="form-control" id="gender"> 
											<option class="abc" <?php if($fac_personal_data->user_gender=='M'){echo "selected";} ?> value="M">Male</option>
											<option class="abc" <?php if($fac_personal_data->user_gender=='F') echo "selected"; ?> value="F">Female</option>
											<option class="abc" <?php if($fac_personal_data->user_gender=='T') echo "selected"; ?> value="T">Other</option>
										</select>

										<i class="fa fa-venus-mars prefix"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group-sm">
										<label for="email" class="bmd-label-floating">Email</label>
										<input type="text" class="form-control businessDetailsNonEdit" id="userEmail" value="<?php if($fac_personal_data) echo $fac_personal_data->user_email;?>">

										<i class="fa fa-envelope prefix"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="number" class="bmd-label-floating">Mobile Number</label>
										<input type="text" class="form-control businessDetailsNonEdit" id="userMobile" value="<?php if($fac_personal_data) echo $fac_personal_data->user_mobile_no;?>">

										<i class="fa fa-mobile prefix"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="city" class="bmd-label-floating">City<span class="required">*</span></label>
										<input type="text" class="form-control charval" id="userCity" onkeyup="leftTrim(this)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_city;?>">
										<span id="errCity" class="error"></span>
										<i class="fa fa-location-arrow prefix"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="subArea" class="bmd-label-floating">Sub Area<span class="required">*</span></label>
										<input type="text" class="form-control" id="userArea" onkeyup="leftTrim(this)"  value="<?php if($fac_personal_data) echo $fac_personal_data->user_address2;?>">
										<span id="errAddress2" class="error"></span>
										<i class="fa fa-map-marker prefix"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="newPassword" class="bmd-label-floating">Address<span class="required">*</span></label>
										<input type="text" class="form-control" onkeyup="leftTrim(this)"  id="userAddress" value="<?php if($fac_personal_data) echo $fac_personal_data->user_address;?>">
										<i class="fa fa-map-marker prefix"></i>
										<span id="errAddress1" class="error"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="confirmPassword" class="bmd-label-floating">Pin Code<span class="required">*</span></label>
										<input type="text" class="form-control" id="userPin" onkeypress="validate(event)" value="<?php if($fac_personal_data) echo $fac_personal_data->user_pincode;?>">
										<span id="errPincode" class="error"></span>
										<i class="fa fa-thumb-tack prefix"></i>
									</div>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-12 text-center">
								<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successProfileUpdatebtn"> Update</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	
		$("#timing").on("click", function() {
			$('#shopTiming').modal('show');
			$('#facility-adademy-edit').modal('hide')
		});
		jQuery(".dropify").dropify();

		jQuery(document).on("click", '.deleteparent', function(){jQuery(this).parents(".boxachievement").remove()});
		$(".time").timeDropper({
			setCurrentTime: false
		});
	</script>
	<script>

		$(document).ready(function() {
			$('.businessDetailsNonEdit, #blockBusinessAddress').click(function(event) {
				$(this).addClass("showthis");
				swal({
					title : "Sorry, you can't modify this !",
					html : '<p class="query_msg">For any update/changes, Please contact</p><p class="contact_admin"><a href="javascript:void(0)"><i class="fas fa fa-mobile"></i> +91 9643503703</a><a href="javascript:void(0)"><i class="fa fa-envelope"></i> info@socialsportz.com</a></p>',
					type: 'warning'	

				})
                

			});
			$('#rejected_popup').click(function(event) {
				swal({
					title : "Sorry, your bank details are not valid !",
					html : '<p class="query_msg">Please enter your valid bank details</p>',
					type: 'warning'				
				})
			});





			function shopSlider(container, navigation){
				$('.'+container).slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					asNavFor: '.slider-nav'
				});
				$('.'+navigation).slick({
					slidesToShow: 3,
					slidesToScroll: 1,
					asNavFor: '.slider-for',
					dots: false,
					centerMode: true,
					focusOnSelect: true
				});
			}	
			$('#shop-gallery-tab-tab').on('shown.bs.tab', function (e) {
				setTimeout(function(){
					shopSlider('slider-for', 'slider-nav');
				}, 150);
			});
		});




		$('#newPinSuccess').click(function(event) {
			swal({
				title : 'New transact pin generated successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					$('#newTransactPin').modal('hide');
				}
			})
		});
		$('#generateTransact').click(function(event) {
			swal({
				title : 'Work in Progress',
				html : ''					
			})
		});
		$('#newTransactPinBtn').click(function(event) {
			swal({
				title : 'Transact pin generated successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					$('#newTransactPin').modal('hide');
				}
			})

		});
		$('#changePasswordBtn').click(function(event) {
			var oldPassword = $('#oldPassword').val();
			var newPassword = $('#newPassword').val();
			var confirmPassword = $('#confirmPassword').val();
			var validPass= $.trim($('#newPassword').val()).length;
			if(oldPassword == ''){
			$('#oldPassword').show();
			$('#errOldPsw').html('Please enter old password');
			return false;
			}
			else{
				$('#errOldPsw').html(''); 
			}
			if(newPassword == ''){
			$('#newPassword').show();
			$('#errNewPsw').html('Please enter new password password');
			return false;
			}
			else{
				$('#errNewPsw').html(''); 
			}
		if(validPass < 6 || validPass > 16){
			$('#newPassword').show();
			$('#errNewPsw').html('Please Enter Password between 6 and 16 characters');
			return false;
		}
		else{
			$('#errNewPsw').html('');
		}

			if(confirmPassword == ''){
			$('#confirmPassword').show();
			$('#errConfirmPsw').html('Please enter confirm password');
			return false;
			}
			else{
				$('#errConfirmPsw').html(''); 
			}

			if(newPassword!=confirmPassword){
			$('#confirmPassword').show();
			$('#errConfirmPsw').html('new password and confirm password not matched');
			return false;
			}
			else{
				$('#errConfirmPsw').html(''); 
			}

			$.ajax({
	type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/change_password',	
			data: {oldPassword:oldPassword,newPassword:newPassword},
			success:function(res){
				//alert(res);
				if(res==1){
					swal({
						title : 'Password changed successfully',
						html : '',
						type: 'success'
							}).then((result) => {
						if (result.value) {
							$('#changePassword').modal('hide');
							 	$('#oldPassword').val('');
								$('#newPassword').val('');
							 	$('#confirmPassword').val('');
							 	window.location.href = '<?php echo base_url('login/logout') ?>';
										}
						})
				}
				else if(res==2){
					swal({
						title : 'Old password not matched',
						html : '',
						type: 'warning'
							}).then((result) => {
						if (result.value) {
							//$('#changePassword').modal('hide');
							 	$('#oldPassword').val('');
								$('#newPassword').val('');
							 	$('#confirmPassword').val('');
							 	setTimeout(function(){
					$("#changePassword").modal("show");	
					},550);	
										}
						})


				}
				else{
					swal({
						title : 'Netork issue occured',
						html : '',
						type: 'warning'
							}).then((result) => {
						if (result.value) {
							$('#changePassword').modal('hide');
							 	$('#oldPassword').val('');
								$('#newPassword').val('');
							 	$('#confirmPassword').val('');
										}
						})
				}			    

			}	
		});

			

		});




		$('#businessDetailsBtn').click(function(event) {
			swal({
				title : 'Business details updated successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					$('#basicDetails').modal('hide');
				}
			})

		});
		$('#businessAddressBtn').click(function(event) {
			swal({
				title : 'Business address updated successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					$('#businessAddress').modal('hide');
				}
			})

		});
		$('#contactDetailBtn').click(function(event) {
			swal({
				title : 'Contact Details updated successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					$('#contactDetails').modal('hide');
				}
			})

		});
		
	$(document).on("click", '.selectall input', function() {
if($(".list-inline-item.checked").length > 0){

var rrr =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().next().find("input").val();
var iii =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().find("input").val();


 $("#shopTiming .list-inline-item.checked").find('.checkbox-decorator').trigger("click"); 
 $("#shopTiming .list-inline-item").each(function(){
jQuery(this).find(".day").parent(".col-md-3").next().find("input").val(iii);
jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val(rrr);

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
</script>

<script>	
	jQuery(document).on("click", '.hamburger-toggle', function(){
		jQuery("#rnr-logo .logo__txt img").show();
	});


	$('#submitDocProgress').hide();
	$('#uploadDocBtn').click(function() {
		var timerId, percent;
		percent = 0;
		$('#loadDoc').css('width', '0px');
		$('#submitDocProgress').show();
		$('#loadDoc').addClass('progress-bar-striped');
		timerId = setInterval(function() {
			percent += 5;
			$('#loadDoc').css('width', percent + '%');
			$('#loadDoc').html(percent + '%');
			if (percent >= 100) {
				clearInterval(timerId);
				$('#loadDoc').html('upload complete');
				swal({
					title : 'Documents updated successfully',
					html : '',
					type: 'success'
				}).then((result) => {
					if (result.value) {
						$('#uploadDocuments').modal('hide');
					}
				})
			}
		}, 200);
	});
	$('#submitGalleryProgress').hide();
	$('#shopGalleryBtn').click(function() {
		var timerId, percent;
		percent = 0;
		$('#loadGallery').css('width', '0px');
		$('#submitGalleryProgress').show();
		$('#loadGallery').addClass('progress-bar-striped');
		timerId = setInterval(function() {
			percent += 5;
			$('#loadGallery').css('width', percent + '%');
			$('#loadGallery').html(percent + '%');
			if (percent >= 100) {
				clearInterval(timerId);
				$('#loadGallery').html('upload complete');
				swal({
					title : 'Gallery updated successfully',
					html : '',
					type: 'success'
				}).then((result) => {
					if (result.value) {
						$('#shopGallery').modal('hide');
					}
				})
			}
		}, 200);
	});
	$('#submitVideoProgress').hide();
	$('#videoBtn').click(function() {
		var timerId, percent;
		percent = 0;
		$('#loadVideo').css('width', '0px');
		$('#submitVideoProgress').show();
		$('#loadVideo').addClass('progress-bar-striped');
		timerId = setInterval(function() {
			percent += 5;
			$('#loadVideo').css('width', percent + '%');
			$('#loadVideo').html(percent + '%');
			if (percent >= 100) {
				clearInterval(timerId);
				$('#loadVideo').html('upload complete');
				swal({
					title : 'Video updated successfully',
					html : '',
					type: 'success'
				}).then((result) => {
					if (result.value) {
						$('#videoGallery').modal('hide');
					}
				})
			}
		}, 200);
	});
	$('#submitProfileProgress').hide();
	$('#profileUpdated').click(function() {
		var timerId, percent;
		percent = 0;
		$('#loadProfile').css('width', '0px');
		$('#submitProfileProgress').show();
		$('#loadProfile').addClass('progress-bar-striped');
		timerId = setInterval(function() {
			percent += 5;
			$('#loadProfile').css('width', percent + '%');
			$('#loadProfile').html(percent + '%');
			if (percent >= 100) {
				clearInterval(timerId);
				$('#loadProfile').html('upload complete');
				swal({
					title : 'Profile Image updated successfully',
					html : '',
					type: 'success'
				}).then((result) => {
					if (result.value) {
						$('#myProfile').modal('hide');
					}
				})
			}
		}, 200);
	});
	$(document).ready(function() {
		$('.documents_gallery').fancybox({

		});
		$('.shop_gallery_images').fancybox({

		});
		$('.profile_pic_image_conatiner').dropify({
			messages: {
				'default': 'Click here to upload',
				'replace': 'Click here to replace',
			}
		});

		$('.doc_upload_container').dropify({
			messages: {
				'default': 'Click here to upload',
				'replace': 'Click here to replace',
			}
		});
		$('.shop_upload_container').dropify({
			messages: {
				'default': 'Click here to upload',
				'replace': 'Click here to replace',
			}
		});
		$('.video_upload_container').dropify({
			messages: {
				'default': 'Click here to upload video',
				'replace': 'Click here to replace video',
			}
		});
		$('#dob').dateDropper();
	// $(".time").timeDropper({
	// 	setCurrentTime: false
	// });
	function onClickChangeView (buttonid, from, to, text) {
		$('#'+buttonid).click(function() {
			$('#header-change').text(text);
			$('#'+from).slideUp(400);
			$('#'+to).slideDown(600);
		});
	}
	onClickChangeView('forgotPinOld','newPin','forgotpinContainer','Forgot Pin');
	onClickChangeView('sendPin','forgotpinContainer','verifyOTPContainer','Verify OTP');
	onClickChangeView('otpVerified','verifyOTPContainer','newOTPContainer','Change Pin');

	// $('#businessDetailsNonEdit, #blockBusinessAddress').click(function(event) {
	// 	swal({
	// 		title : "Sorry, you can't modify this !",
	// 		html : '<p class="query_msg">For any update/changes, Please contact</p><p class="contact_admin"><a href="javascript:void(0)"><i class="fas fa-phone-square"></i> +91 9876543210</a><a href="javascript:void(0)"><i class="far fa-envelope"></i> dummy@gmail.com</a></p>',
	// 		type: 'warning'				
	// 	})
	// });
	$('#newPinSuccess').click(function(event) {
		swal({
			title : 'New transact pin generated successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#newTransactPin').modal('hide');
			}
		})
	});
	$('#generateTransact').click(function(event) {
		swal({
			title : 'Work in Progress',
			html : ''					
		})
	});
	$('#newTransactPinBtn').click(function(event) {
		swal({
			title : 'Transact pin generated successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#newTransactPin').modal('hide');
			}
		})

	});
	$('#changePasswordBtn').click(function(event) {
		swal({
			title : 'Password changed successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#changePassword').modal('hide');
			}
		})
	});
	$('#businessDetailsBtn').click(function(event) {
		swal({
			title : 'Business details updated successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#basicDetails').modal('hide');
			}
		})

	});
	$('#businessAddressBtn').click(function(event) {
		swal({
			title : 'Business address updated successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#businessAddress').modal('hide');
			}
		})

	});
	$('#contactDetailBtn').click(function(event) {
		swal({
			title : 'Contact Details updated successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#contactDetails').modal('hide');
			}
		})

	});
	$('#bankDetailBtn').click(function(event) {
		swal({
			title : 'Bank Details updated successfully',
			html : '',
			type: 'success'
		}).then((result) => {
			if (result.value) {
				$('#bankDetails').modal('hide');
			}
		})

	});
	

	$(".selectcheck-close" ).on("change", function(){

		if($(this).is(':checked')){	
		}
		else{
		}
	});
	function showPassword(btnClickID, inputID){
		$('#'+ btnClickID).click(function(event) {	
			$(this).find('i').toggleClass('fa-eye fa-eye-slash');			
			var password = $('#'+ inputID);
			var passwordAttr =  password.attr('type');
			if(passwordAttr == 'password'){
				password.attr('type','text');					
			}
			else {
				password.attr('type','password');					
			}
		});
	}
	showPassword('oldPasswordEye','oldPassword');
	showPassword('newPasswordEye','newPassword');	
	showPassword('confirmPasswordEye','confirmPassword');


	function shopSlider(container, navigation){
		$('.'+container).slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.slider-nav'
		});
		$('.'+navigation).slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.slider-for',
			dots: false,
			centerMode: true,
			focusOnSelect: true
		});
	}	
	$('#shop-gallery-tab-tab').on('shown.bs.tab', function (e) {
		setTimeout(function(){
			shopSlider('slider-for', 'slider-nav');
		}, 150);
	});
	shopSlider('slider-for', 'slider-nav');

	$('#dontKnowIFSC').click(function () {
		if ($(this).prop('checked')) {   	
			$('#letMeEnterDetails').slideUp();
		}
		else {                
			$('#letMeEnterDetails').slideDown();
		}
	});
});

</script>

<script>
	$('#tab2-tab').on('click', function(e) {
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		action='fac_details';
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/getfacDetails',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				$("#facDetailAjax").html(res['_html']);
			}	
		});

	});
	$('#tab4-tab').on('click', function(e) {
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		action='sport_aminity';
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/getfacDetails',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				$("#sport_aminityAjax").html(res['_html']);
			}	
		});

	});

	$('#tab5-tab').on('click', function(e) {
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		action='sport_opening_closing';
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/getfacDetails',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				//return false;
				$("#sport_TimingAjax").html(res['_html']);
			}	
		});

	});


	$('#shop-gallery-tab-tab').on('click', function(e) {
		//shopSlider('slider-for', 'slider-nav');
		var fac_id =$("#headeracademyfacility option:selected" ).val();

		action='fac_gallery';
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/getfacDetails',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				//return false;
				$("#fac_galleryAjax").html(res['_html']);
				
				//alert();
			}	
		});

	});

	$('#tab3-tab').on('click', function(e) {
		var fac_id =$("#headeracademyfacility option:selected" ).val();

		action='fac_bank';
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/getfacDetails',	
			data: {action:action},
			success:function(res){
				//return false;
				$("#facBankAjax").html(res['_html']);
			}	
		});

	});


	/*Update Personal info*/



	$('#successProfileUpdatebtn').click(function(event) {
		$(".businessDetailsNonEdit").removeClass("showthis");
		var name = $('#userName').val();
		var gender_val=$( "#gender option:selected" ).val();
		var gender = $("#gender option.abc:selected").length; 
		var email = $('#userEmail').val();
		var phone = $('#userMobile').val();
		var validPhone= $.trim($('#userMobile').val()).length;
		var address1 = $('#userAddress').val();
		var address2 = $('#userArea').val();
		var city = $('#userCity').val();
		var pincode = $('#userPin').val();
		var validpincode = $.trim($('#userPin').val()).length;
		if(gender_val=='M'){
			var gender_text_data = 'Male'
		}
		if(gender_val=='F'){
			var gender_text_data = 'Female'
		}
		if(gender_val=='T'){
			var gender_text_data = 'Other'
		}
		//alert(gender_val);
		
		if(name == ''){
			$('#errName').show();
			$('#errName').html('Please enter name');
			return false;
		}
		else{
			$('#errName').html('');
		}
		
		if(city == ''){
			$('#errCity').show();
			$('#errCity').html('Please enter city');
			return false;
		}
		else{
			$('#errCity').html(''); 
		}

		
		if(address2 == ''){
			$('#errAddress2').show();
			$('#errAddress2').html('Please enter Address Line 2');
			return false;
		}
		else{
			$('#errAddress2').html(''); 
		}
		if(address1 == ''){
			$('#errAddress1').show();
			$('#errAddress1').html('Please enter Address Line 1');
		}
		else{
			$('#errAddress1').html('');
		}
		if(pincode == ''){
			
			$('#errPincode').focus();
			$('#errPincode').html('Please enter pincode');
			return false;
		}
		else{
			
			$('#errPincode').html('');
		}

		if(validpincode!=6){
			
			$('#errPincode').focus();
			$('#errPincode').html('Please enter correct pincode');
			return false;
		}else{
			
			$('#errPincode').html('');
			
		}

		if(name!='' && email!='' && phone!='' && gender_val!='' && address1!='' && address2!='' && city!='' && pincode!=''){
		action='persoanl_info';
		$.ajax({
			type: "POST",
			url:'<?php echo base_url();?>dashboard/update_fac_info',	
			data: {name:name,gender:gender_val,email:email,phone:phone,address1:address1,address2:address2,city:city,pincode:pincode,action:action},
			success:function(res){
				//alert(res); return false;
				if(res!='failed'){
					swal({
						title : 'Information updated successfully',
						html : '',
						type: 'success'
					}).then((result) => {
						if (result.value) {
							$('#profile-edit').modal('hide');
							$('#name_text').text(name);
							$('#gender_text').text(gender_text_data);
							$('#city_text').text(city);
							$('#sub_area_text').text(address2);
							$('#address_text').text(address1);
							$('#pincode_text').text(pincode);
						}
					})
				}
				else{
					$('#error_msg').show(); 
					$('#error_msg').text("Network issue"); 
				}		    

			}	
		});
	}



	});

jQuery(".eyeslashpassword").on("click", function(){jQuery(this).parents(".form-group").find("input[type='password']").attr("type","text"); jQuery('.eyepassword').show(); jQuery(this).hide();});

jQuery(".eyeopenpassword").on("click", function(){jQuery(this).parents(".form-group").find("input[type='text']").attr("type","password"); jQuery('.eyepassword').show(); jQuery(this).hide();});

setTimeout(function(){cdf = jQuery(".completedprofile").text();
if( cdf == 100 ){jQuery(".progress-bar").addClass('completedprofilebar')}
},200);


$('.varifiy_email').on('click', function(e) {
		//var fac_id =$("#headeracademyfacility option:selected" ).val();
		//action='fac_details';
		//alert('test');return false;
		showingLoader();
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/email_re_verification',	
			data: {},
			success:function(res){
				if(res=='success'){
					swal({
						title : 'Verification link has been sent on your Registered email',
						html : '',
						type: 'success'
							}).then((result) => {
						if (result.value) {
							hiddingLoader();
										}
						})
				}
				hiddingLoader();
			}	
		});

	});

setInterval(function(){
$(".documents_gallery").each(function(){var mgh = $(this).find("img").attr("src"); if(mgh==""){$(this).css("cursor","default")}});

if($(".showthis").length > 0){$("#profile-edit").modal('show')}
},500);



</script>
</body>
</html>	
