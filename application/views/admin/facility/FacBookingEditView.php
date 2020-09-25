<?php
echo "<pre>";
print_r($booking_detail);
die;

?>

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

							<li class="active">Acedamy / Facility Booking List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>
					
					
					

					<div class="page-content">
						   <div class="row">
						 
									<?php echo form_open_multipart('admin/facility/facbookinglist',array('class'=>'form-horizontal')); ?>

									

									<div class="col-md-3">

											<div class="form-group">

											<label class="col-md-3 control-label no-padding-right" style="margin-left:22px;" for="form-field-1">Start Date </label>

											<input class="date-picker-from" id="start_date" name="start_date" value="" type="text" readonly data-date-format="dd-mm-yyyy"  />
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

									<input class="date-picker-to" id="end_date" name="end_date" value="" type="text" readonly data-date-format="dd-mm-yyyy" />

									<span class="">

									<i class="fa fa-calendar bigger-110 calin"></i>

									</span>

									<span id="errCouponTDate" class="error"> </span>

									</div>

									</div>

									<div class="col-md-3">

									<div class="form-group">

									<label class="col-md-3 control-label no-padding-right" for="form-field-1">status </label>

									<select name="select_stat" id="select_stat" class="form_input">
                                     <option value="">Select Status</option>
									<option value="enable">Enable</option>
									<option value="disable">Disable</option>

								

									</select>

									<span id="errCouponStat" class="error"> </span>

									</div>

									</div>

									<div class="col-md-3">

									<?php echo form_submit(['class'=>'btn btn-info','name'=>'Submit','id'=>'order_submit','value'=>'Submit']); ?>                                                        

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
											Acedamy / Facility Booking  List
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Booking Id</th>
														<th>Eamil ID</th>
														<th>Contact</th>
														<th>Sports Name</th>
														<th>Slot time</th>
														<th>Amount</th>
														<th>Booking Method</th>
														<th>Booking Status</th>
														<th>Booking start from</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													if(isset($facility_booking_listing) && !empty($facility_booking_listing)){ $i=0 ;foreach($facility_booking_listing as $facility_booking_listing){ $i++;
													    
														
													    // echo "<pre>";
														// print_r($facility_booking_listing);
													 // die;
														?>
													<tr>
														
														<td class="center"><?= $i ?></td>
														 <td><?= $facility_booking_listing->booking_order[0]->booking_order_no; ?></td>
														<td><?= $facility_booking_listing->booking_order[0]->email; ?></td>
														<td><?= $facility_booking_listing->booking_order[0]->mobile; ?></td>
														<td><?= $facility_booking_listing->sport_name[0]->sport_name; ?></td>
														<td><?= $facility_booking_listing->facility_batch_slot[0]->start_time,'-'.$facility_booking_listing->facility_batch_slot[0]->end_time; ?></td>
														<td><?= $facility_booking_listing->booking_detail_final_amount; ?></td>
														<td><?= $facility_booking_listing->booking_order[0]->booking_type ?></td>
														<td><?= $facility_booking_listing->booking_detail_status; ?></td>
														
														<td><?= date('d-m-y',strtotime($facility_booking_listing->facility_batch_slot[0]->start_date)); ?></td>
														
														
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													
																<a class="green" href="<?= base_url('admin/facility/facbookingedit/'.$facility_booking_listing->booking_order_id);?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

															</div>
														</td>
														
													</tr>
													<?php }
													} ?>
													

												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div id="modal-table" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header no-padding">
												<div class="table-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Results for "Latest Registered Domains
												</div>
											</div>

											<div class="modal-body no-padding">
												<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
													<thead>
														<tr>
															<th>Domain</th>
															<th>Price</th>
															<th>Clicks</th>

															<th>
																<i class="ace-icon fa fa-clock-o bigger-110"></i>
																Update
															</th>
														</tr>
													</thead>

													<tbody>
														<tr>
															<td>
																<a href="#">ace.com</a>
															</td>
															<td>$45</td>
															<td>3,330</td>
															<td>Feb 12</td>
														</tr>

														<tr>
															<td>
																<a href="#">base.com</a>
															</td>
															<td>$35</td>
															<td>2,595</td>
															<td>Feb 18</td>
														</tr>

														<tr>
															<td>
																<a href="#">max.com</a>
															</td>
															<td>$60</td>
															<td>4,400</td>
															<td>Mar 11</td>
														</tr>

														<tr>
															<td>
																<a href="#">best.com</a>
															</td>
															<td>$75</td>
															<td>6,500</td>
															<td>Apr 03</td>
														</tr>

														<tr>
															<td>
																<a href="#">pro.com</a>
															</td>
															<td>$55</td>
															<td>4,250</td>
															<td>Jan 21</td>
														</tr>
													</tbody>
												</table>
											</div>

											<div class="modal-footer no-margin-top">
												<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Close
												</button>

												<ul class="pagination pull-right no-margin">
													<li class="prev disabled">
														<a href="#">
															<i class="ace-icon fa fa-angle-double-left"></i>
														</a>
													</li>

													<li class="active">
														<a href="#">1</a>
													</li>

													<li>
														<a href="#">2</a>
													</li>

													<li>
														<a href="#">3</a>
													</li>

													<li class="next">
														<a href="#">
															<i class="ace-icon fa fa-angle-double-right"></i>
														</a>
													</li>
												</ul>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

				<?php $this->load->view('admin/includes/footer');?> 

			
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/includes/foot');?> 
		</div><!-- /.main-container -->
	</body>
</html>
