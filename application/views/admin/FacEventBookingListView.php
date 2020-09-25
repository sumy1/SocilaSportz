<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head'); ?> 


	<body class="no-skin">
		<?php $this->load->view('admin/includes/header');?>
	

		<div class="main-container ace-save-state" id="main-container">
			

			<?php $this->load->view('admin/includes/sidebar');?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?= base_url('admin/user/dashboard');?>">Dashboard</a>
							</li>

							<li class="active">Event Booking List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>
					
					
					

					<div class="page-content">
						   <div class="row">
						 
									<?php echo form_open_multipart('admin/facility/faceventlisting',array('class'=>'form-horizontal')); ?>

									

									<div class="col-md-3">

											<div class="form-group">

											<label class="col-md-3 control-label no-padding-right" style="margin-left:22px;" for="form-field-1" >Start Date </label>

											<input class="date-picker-from" id="start_date" name="start_date" value="<?php if(isset($start_date)){echo $start_date;}?>" type="text" readonly data-date-format="dd-mm-yyyy"  />
											<input type="hidden" value="fac_filter" name="action">

											<span class="">

											<i class="fa fa-calendar bigger-110 calin" style="margin-left:22px;"></i>

											</span>

											<span id="errCouponFDate" class="error"> </span>

											</div>
											

									</div>

									<div class="col-md-3">

									<div class="form-group">

									<label class="col-md-3 control-label no-padding-right" for="form-field-1">End Date </label>

									<input class="date-picker-to" id="end_date" name="end_date" value="<?php if(isset($end_date)){echo $end_date;}?>" type="text" readonly data-date-format="dd-mm-yyyy" />

									<span class="">

									<i class="fa fa-calendar bigger-110 calin"></i>

									</span>

									<span id="errCouponTDate" class="error"> </span>

									</div>

									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="col-md-12 control-label no-padding-right" for="form-field-1">
											Payment Status </label>
											<select name="select_stat" id="select_stat" class="form_input">
												 <option value="">Payment Status</option>
												<option value="pending"<?php if(@$status == "pending") echo "selected"; ?>>Pending</option>
												<option value="success"<?php if(@$status == "success") echo "selected"; ?>>Success</option>
												<option value="fail"<?php if(@$status == "fail") echo "selected"; ?>>Fail</option>
											</select>
											<span id="errCouponStat" class="error"> </span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="col-md-12 control-label no-padding-right" for="form-field-1">
											Booking Type </label>
											<select name="booking_type" id="booking_type" class="form_input">
												 <option value="">Booking Type</option>
												<option value="online"<?php if(@$booking_type == "online") echo "selected"; ?>>Online</option>
												<option value="offline"<?php if(@$booking_type == "offline") echo "selected"; ?>>Offline</option>
											</select>
											<span id="errCouponStat" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2">

									<?php echo form_submit(['class'=>'btn btn-info ordersmall','name'=>'Submit','id'=>'event_submit','value'=>'Submit']); ?>
									<a href="<?=base_url('admin/facility/facbatchbookinglist');?>" class="btn btn-info clearbtn" id="clearbtn">
									    <i class="fa fa-refresh" style="margin-top: -5px;"></i>
									</a>                                                         

									</div>

									</div>

									<?php echo form_close(); ?>
									
									</div>
						
							
					
						
						   
						
						
						
						
						  
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								<div class="row">
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
									<div class="col-xs-12">
										
										<div class="table-header">
											  Booking  List
											 <ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="facilty_slotydata">
												   <a href="#"><img src="<?=base_url('assets/admin/images/Excel-icon.png')?>"
												    style="width:32px; margin-right:8px;"
												   ></a>
											  </ul>
											<form method="post" action="<?=base_url('admin/facility/exporteventbooking');?>" id="excel_export">
											   <input type="hidden" name="start_date" id="start_dates" value="">
											  <input type="hidden" name="end_dates" id="end_dates" value="">
											  <input type="hidden" name="select_stat" id="select_statuss" value="">
											  <input type="hidden" name="booking_type" id="booking_types" value="">
											  
											 </form>
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>S.N</th>
														<th>Name</th>
														<th>Email</th>
														<!--<th>Mobile</th>-->
														<th>Facility Name</th>
														<th>Type</th>
														<th>Event Name</th>
														
														<!--<th>City</th>-->
														<th>Payment Status</th>
														<th>Payment method</th>
														<th>Booking Status</th>
														<th>Event Start Date</th>
														<th>Event End Date</th>
														<!--<th>Start date</th>-->										
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													if(isset($facility_booking_listing) && !empty($facility_booking_listing)){ $i=0 ;foreach($facility_booking_listing as $faclinkbookingKey=>$faclinkbookingVal){ $i++; 
													?>
													<tr>
													<td class="center"><?= $i ?></td>
													
													 <td><?php if(isset($faclinkbookingVal->name)){echo $faclinkbookingVal->name;}?></td>
													 <td><?php if(isset($faclinkbookingVal->email)){echo $faclinkbookingVal->email;} ?></td>
													 <!--<td><?php if(isset($faclinkbookingVal->mobile)){echo $faclinkbookingVal->mobile;} ?></td>-->
													 <td><?php if(isset($faclinkbookingVal->fac_name)){echo $faclinkbookingVal->fac_name;} ?></td>
													 <td><?php if(isset($faclinkbookingVal->fac_type)){echo ucfirst($faclinkbookingVal->fac_type);} ?></td>
												
													 <td><?php if(isset($faclinkbookingVal->event_name)){echo $faclinkbookingVal->event_name;} ?></td>
													  
													 <!--<td><?php if(isset($faclinkbookingVal->city)){echo $faclinkbookingVal->city;} ?></td>-->
													  <td><?php if(isset($faclinkbookingVal->payment_status)){echo ucfirst($faclinkbookingVal->payment_status);} ?></td>
													  <td><?php if(isset($faclinkbookingVal->booking_type)){echo ucfirst($faclinkbookingVal->payment_method);} ?></td>
													  
													 <td><?php if(isset($faclinkbookingVal->booking_status)){echo ucfirst($faclinkbookingVal->booking_status);} ?></td>
													 <td><?php if(isset($faclinkbookingVal->event_start_date)){echo date('d-m-Y',strtotime($faclinkbookingVal->event_start_date));} ?></td>
													   <td><?php if(isset($faclinkbookingVal->event_end_date)){echo date('d-m-Y',strtotime($faclinkbookingVal->event_end_date));} ?></td>
														   
														   
														
														
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													
																<a class="green" href="<?= base_url('admin/facility/faceventbookingorder/'.$faclinkbookingVal->booking_order_id);?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

															</div>
														</td>
														
													</tr>
													<?php }
													} ?>
													