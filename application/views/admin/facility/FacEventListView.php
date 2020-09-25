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

							<li class="active"> Event List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						    <div class="row">
									<?php echo form_open_multipart('admin/facility/faceventlist',array('class'=>'form-horizontal')); ?>

									

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
                                     <option value="">Admin Approval</option>
									<option value="approved"<?php if(@$select_stat == "approved") echo "selected"; ?>>Approved</option>
									<option value="rejected"<?php if(@$select_stat == "rejected") echo "selected"; ?>>Rejected</option>
									<option value="pending"<?php if(@$select_stat == "pending") echo "selected"; ?>>Pending</option>

								

									</select>

									<span id="errCouponStat" class="error"> </span>

									</div>

									</div>

									<div class="col-md-3">

									<?php echo form_submit(['class'=>'btn btn-info ordersmall','name'=>'Submit','id'=>'event_submit','value'=>'Submit']); ?>

                                   <a href="<?=base_url('admin/facility/faceventlist');?>" class="btn btn-info clearbtn" id="clearbtn">
									    <i class="fa fa-refresh" style="margin-top: -5px;"></i>
									</a>                                                         

									</div>									

									</div>

									

									<?php echo form_close(); ?>
								
						
							 
							 </div>
						</div>
						
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								<div class="row">
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
									<div class="col-xs-12">
										
										<div class="table-header">
											Event  List
										<ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="facilty_slotydata">
												   <a href="#"><img src="<?=base_url('assets/admin/images/Excel-icon.png')?>"
												    style="width:32px; margin-right:8px;"
												   ></a>
											  </ul>
											<form method="post" action="<?=base_url('admin/facility/exporteventlisting');?>" id="excel_export">
											   <input type="hidden" name="start_date" id="start_dates" value="">
											  <input type="hidden" name="end_dates" id="end_dates" value="">
											  <input type="hidden" name="select_stat" id="select_statuss" value="">
											  
											 </form>
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>S.N</th>
														  <th>Event Name</th>
														  <th>Sport Name</th>
														  <th>Max Participant</th>
														  <th>Venue</th>
														  <th>Fee</th>
														  <th>Is Home</th>
														  <th>Event Approval</th>
														  <th>Event Start Date</th>
														  <th>Event End Date</th>
														  <th>Created On</th>
														  <th>Action</th>
													</tr>
												</thead>

												<tbody>
												
													<?php 
													if(isset($fac_event_listing) && !empty($fac_event_listing)){ $i=0 ;foreach($fac_event_listing as $fac_event_listing){ $i++;
													
													//print_data($fac_event_listing);
													
														// print_r($academy_data->user_name[0]->user_name);
														//die;
														?>
													<tr>
														
														<td class="center"><?= $i ?></td>
														<td><?=$fac_event_listing->event_name;?></td>
														<td><?=$fac_event_listing->sport_name;?></td>
														<td><?= $fac_event_listing->event_max_capicity_per_day; ?></td>
														<td><?= $fac_event_listing->event_venue; ?></td>
														<td><?= $fac_event_listing->event_price; ?></td>
														<td><?= ucfirst($fac_event_listing->is_home); ?></td>
														<td>
														
														
														<select onchange="changeeventstatus('<?php echo $fac_event_listing->event_id; ?>')" class="eventstatusCodes<?php echo $fac_event_listing->event_id; ?>">
														   <option value="approved" <?php if($fac_event_listing->event_approval == "approved") echo "selected"; ?>>Approved</option>
														   <option value="rejected" <?php if($fac_event_listing->event_approval == "rejected") echo "selected"; ?>>Rejected</option>
														   
														   <option value="pending" <?php if($fac_event_listing->event_approval == "pending") echo "selected"; ?>>Pending</option>
														  <input type="hidden" name="user_id" id="user_id" value="<?=$fac_event_listing->user_id?>">
														  <input type="hidden" name="event_name" id="event_name" value="<?=$fac_event_listing->event_name?>">
														 </select>
														
														
														
														
														</td>
														<td><?php if(isset($fac_event_listing->event_start_date)){echo date('d-m-Y',strtotime($fac_event_listing->event_start_date));} ?></td>
														<td><?php if(isset($fac_event_listing->event_end_date)){echo date('d-m-Y',strtotime($fac_event_listing->event_end_date));} ?></td>
														<td><?= date('d-m-Y',strtotime($fac_event_listing->created_on)); ?></td>
														
														 
														
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													
																<a class="green" href="<?= base_url('admin/facility/faceventedit/'.$fac_event_listing->event_id);?>">
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
function changeeventstatus(event_id){
	  var event_status=$(".eventstatusCodes"+event_id).val(); 
	  var user_id = $('#user_id').val();
	  var event_name = $('#event_name').val();
	  $.ajax({
		  type:'post',
		  url:'<?=base_url('admin/facility/changeeventstatus') ?>',
		  data: {event_id:event_id,event_status:event_status,user_id:user_id,event_name:event_name},
		  success(res){
			   if(res == 1){
				     swal({
						  title: "Status updates",
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
	  }) 
}

$(document).ready(function(){		
	$(document).on('click','#event_submit',function(){
		 var form_date=$('#start_date').val();
		 var to_date= $('#end_date').val();
				var startateArr = [];
				var endateArr = [];
				startateArr = form_date.split('-');
				endateArr = to_date.split('-');
				if(form_date!=''  && to_date!=''){
					if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) && (parseInt(endateArr[1]) >= parseInt(startateArr[1])) && (parseInt(endateArr[2]) >= parseInt(startateArr[2]))){
						$('#errCouponTDate').html('');
					}else{
						 $('#errCouponTDate').html('End date should be greater than start date');
						  return false;
					}
				}
				
	});		
});
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

		</div><!-- /.main-container -->
	</body>
</html>
