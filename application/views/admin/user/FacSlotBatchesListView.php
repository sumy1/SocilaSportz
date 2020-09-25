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

							<li class="active">Slot / Batch List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						   <div class="row">
						 
									<?php echo form_open_multipart('admin/facility/facilityslotbatchesList',array('class'=>'form-horizontal')); ?>

									

									<div class="col-md-3">

											<div class="form-group">

											<label class="col-md-3 control-label no-padding-right" style="margin-left:22px;" for="form-field-1">Start Date </label>

											<input class="date-picker-from" id="start_date" name="start_date" value="<?php if(isset($start_date)){echo $start_date;}?>" type="text" readonly data-date-format="dd-mm-yyyy" />
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

									<i class="fa fa-calendar bigger-110 calin icon_bhi"></i>

									</span>

									<span id="errCouponTDate" class="error"> </span>

									</div>

									</div>

									<div class="col-md-3">

									<div class="form-group">

									<label class="col-md-3 control-label no-padding-right" for="form-field-1">Status </label>

									<select name="select_stat" id="select_stat" class="form_input">

									<option value="">Admin approval</option>
									<option value="active"<?php if(@$status == "active") echo "selected"; ?>>Active</option>
									<option value="inactive"<?php if(@$status == "inactive") echo "selected"; ?>>Inactive</option>

								

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
										 Slot / Batch List
											 <ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="facilty_slotydata">
												   <a href="#"><img src="<?=base_url('assets/admin/images/Excel-icon.png')?>"
												    style="width:32px; margin-right:8px;"
												   ></a>
											  </ul>
											<form method="post" action="<?=base_url('admin/facility/exportdatabyslot');?>" id="excel_export">
											   <input type="hidden" name="start_date" id="start_dates" value="">
											  <input type="hidden" name="end_date" id="end_dates" value="">
											  <input type="hidden" name="select_stat" id="select_statuss" value="">
											  
											 </form>
											 
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">S.N</th>
														<th>Owner Name</th>
														<th>Facility / Academy</th>
														<th>Facility Type</th>
														 <th>Start Date/ End Date</th>
														 <th>Start Time / End Time</th>
														 <th>Max Participanets</th>
														<th>Status</th>
														<th>Created On</th>
														 <th>Action</th>
													</tr>
												</thead>

												<tbody>
												
													<?php 
													if(isset($facility_batch_data) && !empty($facility_batch_data)){ $i=0 ;foreach($facility_batch_data as $facility_batch_data){ $i++;
														 // echo "<pre>";
												          // print_r($facility_batch_data);
													   // die;
														 // print_r($facility_batch_data->fac_name[0]->fac_name);
														 // print_r();
														//die;
														?>
													<tr>
														
														<td class="center"><?= $i ?></td>
														<td><?=$facility_batch_data->user_name[0]->user_name;?></td>
														<td><?=$facility_batch_data->fac_name[0]->fac_name;?></td>
														<td><?=ucfirst($facility_batch_data->fac_name[0]->fac_type);?></td>
														 <td><?=date('d-m-Y',strtotime($facility_batch_data->start_date)).'&nbsp;/&nbsp;'.date('d-m-Y',strtotime($facility_batch_data->end_date));  ?></td>
														 
														 <td><?=$facility_batch_data->start_time.'/'.$facility_batch_data->start_time;  ?></td>
														 <td><?=$facility_batch_data->max_participanets;?></td>
														<td>
														
														<select onchange="changebatchstatus('<?php echo $facility_batch_data->batch_slot_id; ?>')" name="" id="sel1" class="form_input statusCode">
														   <option value="active" <?php if($facility_batch_data->fac_batch_slot_status == "active") echo "selected"; ?>>Active</option>
														   <option value="inactive" <?php if($facility_batch_data->fac_batch_slot_status == "inactive") echo "selected"; ?>>Inactive</option>
														   
													
													   </select>
													
														</td>
														<td><?= date('d-m-Y',strtotime($facility_batch_data->create_on)); ?></td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													
																<a class="green" href="<?= base_url('admin/facility/facslotbatchedit/'.$facility_batch_data->batch_slot_id);?>">
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
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

				<?php $this->load->view('admin/includes/footer');?> 

			
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/includes/foot');?> 
		<script>
		var facilty_slot_data=document.querySelector('#facilty_slotydata');
		 facilty_slot_data.addEventListener('click',function(){
			 var start_date= document.getElementById('start_date').value; 
			 var end_date= document.getElementById('end_date').value; 
			 var select_stat= document.getElementById('select_stat').value; 
		  document.getElementById('start_dates').value=start_date; 
		  document.getElementById('end_dates').value=end_date; 
		  document.getElementById('select_statuss').value=select_stat; 
		  $('#excel_export').submit();		
		 });
		  $('.date-picker-from , .date-picker-to').datepicker({

autoclose: true,

todayHighlight: true

})
		
		</script>
		 
		
		<script> 
		  function changebatchstatus(batch_slot_id){
			  var batch_slot_status =  $('.no-footer').find('.statusCode').val();
			   $.ajax({
				   type: 'post',
				   url: '<?=base_url('admin/facility/changebatchstatus') ?>',
				   data: {batch_slot_id:batch_slot_id,batch_slot_status:batch_slot_status},
				   success(res){
					   if(res == 1){
						 swal({
							  title: "Status update",
							  text: "",
							  icon: "success",
							  button: "Ok",
							});
			           }
					   else{
						   swal({
								  title: "network issue",
								  text: "",
								  icon: "issue",
								  button: "Ok",
								});
					   }
				   }
				   
			   });
		  }
		  

		</script>
		</div><!-- /.main-container -->
	</body>
</html>
