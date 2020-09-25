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

							<li class="active"> Review List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="row">
						 
									<?php echo form_open_multipart('admin/facility/facreviewlist',array('class'=>'form-horizontal')); ?>

									

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
            <!----------------
									<div class="col-md-3">

									<div class="form-group">

									<label class="col-md-3 control-label no-padding-right" for="form-field-1">status </label>

									<select name="select_stat" id="select_stat" class="form_input">
                                         <option selected>Please Select</option>
									<option value="enable">Enable</option>
									<option value="disable">Disable</option>
									</select>

									<span id="errCouponStat" class="error"> </span>

									</div>

									</div>
                       ------------->

									<div class="col-md-3">

									<?php echo form_submit(['class'=>'btn btn-info ordersmall','name'=>'Submit','id'=>'review_submit','value'=>'Submit']); ?>    

                                        <a href="<?=base_url('admin/facility/facreviewlist');?>" class="btn btn-info clearbtn" id="clearbtn">
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
											 Review List
											
											<ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="contactdata">
												   <a href="<?=base_url('admin/facility/excelfacreview');?>"><img src="<?=base_url();?>assets/admin/images/Excel-icon.png" style="width:32px; margin-right:8px;"></a>
											  </ul>
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>S.N</th>
														  <th>User Name</th>
														  <th>User Email</th>
														  <th>Facility Name</th>
														  <th>Rating Type</th>
														  <th>Admin Approval</th>
														  <th>Review Message</th>
														  <th>Created On</th>
													</tr>
												</thead>

												<tbody>
												
													<?php 
													
													if(isset($rating_data) && !empty($rating_data)){ $i=0 ;foreach($rating_data as $rating_data){ $i++;
														 // echo "<pre>";
														  // print_r($rating_data);
														//die;
														// echo 
														// die;

														//die;
														?>
													<tr>
														
														<td class="center"><?= $i ?></td>
														<td><?= $rating_data->user_name; ?></td>
														<td><?= $rating_data->user_email; ?></td>
														<td><?= @$rating_data->facility_name->fac_name; ?></td>
														<td><?= $rating_data->rating_type; ?></td>
													<td>
														<select onchange="changeratingstatus('<?php echo $rating_data->rating_id; ?>')" name="" id="sel1" class="reviewstatusCode<?php echo $rating_data->rating_id; ?>">
														   <option value="Approved" <?php if($rating_data->admin_approval == "Approved") echo "selected"; ?>>Approved</option>
														   <option value="Disapproved" <?php if($rating_data->admin_approval == "Disapproved") echo "selected"; ?>>Disapproved</option>
														   <option value="void" <?php if($rating_data->admin_approval == "void") echo "selected"; ?>>void</option>
													    </select>
													</td>
														<td><?= @$rating_data->review_data[0]->review_message; ?></td>
														<td><?= date('d-m-Y',strtotime($rating_data->created_on)); ?></td>
														 
														
														
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
$(document).ready(function(){		
	$(document).on('click','#review_submit',function(){
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

		  $('.date-picker-from , .date-picker-to').datepicker({

autoclose: true,

todayHighlight: true

})
		
		</script>
		
		<script>
	    function changeratingstatus(rating_id){
			   var rating_status = $('.reviewstatusCode'+rating_id).val();
			   // alert(rating_status);
			   $.ajax({
				   type:'post',
				   url:'<?=base_url('admin/facility/changeratingstatus');?>',
				   data:{rating_id:rating_id,rating_status:rating_status},
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
			   })
		}
	    </script>
		</div><!-- /.main-container -->
	</body>
</html>
