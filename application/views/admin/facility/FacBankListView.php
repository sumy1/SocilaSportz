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

							<li class="active">User (Owner) Bank  List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>
					
					
					<div class="page-content">
						<div class="row">
						 
									<?php echo form_open_multipart('admin/facility/facbanklist',array('class'=>'form-horizontal')); ?>

									

									<div class="col-md-3">

											<div class="form-group">

											<label class="col-md-3 control-label no-padding-right" style="margin-left:22px;" for="form-field-1">Start Date </label>

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

									<i class="fa fa-calendar bigger-110 calin icon_bhi"></i>

									</span>

									<span id="errCouponTDate" class="error"> </span>

									</div>

									</div>

									<div class="col-md-3">

									<div class="form-group">

									<label class="col-md-3 control-label no-padding-right" for="form-field-1">Status </label>

									<select name="select_stat" id="select_stat" class="form_input">
                                     <option value=""> Admin Approval</option>
									<option value="approved"<?php if(@$status == "approved") echo "selected"; ?>>Approved</option>
									<option value="disapproved"<?php if(@$status == "disapproved") echo "selected"; ?>>Disapproved</option>
									<option value="void"<?php if(@$status == "void") echo "selected"; ?>>Void</option>

								

									</select>

									<span id="errCouponStat" class="error"> </span>

									</div>

									</div>

									<div class="col-md-3">

									<?php echo form_submit(['class'=>'btn btn-info ordersmall','name'=>'Submit','id'=>'bank_submit','value'=>'Submit']); ?> 
									<a class="btn btn-info clearbtn" id="clearbtn">
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
											User (Owner) Bank List
											  <ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="Bankdata">
												   <a href="#"><img src="<?=base_url('assets/admin/images/Excel-icon.png')?>"
												    style="width:32px; margin-right:8px;"
												   ></a>
											  </ul>
											<form method="post" action="<?=base_url('admin/facility/exportdatabank');?>" id="excel_export">
											<input type="hidden" value="contact_filter" name="action">
											   <input type="hidden" name="start_date" id="start_dates" value="">
											  <input type="hidden" name="end_date" id="end_dates" value="">
											  <input type="hidden" name="select_stat" id="select_statuss" value="">
											  <input type="hidden" value="bank_filter" name="action">
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
														<th>Number</th>
														<th>Account Name</th>
														<th>Account Type</th>
														 <th>Bank Name</th>
														<th>Branch Address</th>
														<th>Admin Approval</th>
														<th>Created On</th>
														 <th>Action</th>
													</tr>
												</thead>

												<tbody>
												
													<?php 
													 // print_data($user_bank_details_data);
													if(isset($user_bank_details_data) && !empty($user_bank_details_data)){ $i=0 ;foreach($user_bank_details_data as $key=>$val){ $i++;
													 // echo "<pre>";
												// print_r($val);
													?>
													<tr>
														
														 <td class="center"><?= $i ?></td>
														 <td class="center"><?=$user_bank_details_data[$key]->user_names->user_name ; ?></td>
														  <td class="center"><?=$user_bank_details_data[$key]->user_names->user_mobile_no ; ?></td>
														 <td><?= $val->account_name; ?></td>
													     <td><?= $val->account_type; ?></td>
													     <td><?= $val->bank_name; ?></td>
													     <td><?= $val->branch_address; ?></td>
														 <td>
															  <select onchange="changefacilitybankstatus('<?php echo $val->bank_info_id;?>')" name="" id="sel1" class="statusCode<?php echo $val->bank_info_id;?>">
																	   <option value="approved" <?php if($val->admin_approval == "approved") echo "selected"; ?>>Approved</option>
																	   <option value="disapproved" <?php if($val->admin_approval == "disapproved") echo "selected"; ?>>Disapproved</option>
																	   <option value="void" <?php if($val->admin_approval == "void") echo "selected"; ?>>void</option>
																</select>
													       </td>
													    <td><?= date('d-m-Y',strtotime($val->created_on)); ?></td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													                <a class="green" href="<?= base_url('admin/facility/facbankedit/'.$val->bank_info_id);?>">
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
		</div><!-- /.main-container -->
	</body>
</html>


<script>
$(document).ready(function(){		
	$(document).on('click','#bank_submit',function(){
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

var Bankdata=document.querySelector('#Bankdata');
		Bankdata.addEventListener('click',function(){
				   var start_date= document.getElementById('start_date').value; 
				   var end_date= document.getElementById('end_date').value; 
					var select_stat= document.getElementById('select_stat').value; 
				
					  // alert(start_date+'/'+end_date+'/'+select_stat);
					 document.getElementById('start_dates').value=start_date; 
					  document.getElementById('end_dates').value=end_date; 
					 document.getElementById('select_statuss').value=select_stat; 
					  $('#excel_export').submit();
		});
		
	function changefacilitybankstatus(bank_info_id){
		 var status = $('.statusCode'+bank_info_id+' option:selected').val(); 
         $.ajax({
				type:'post',
				url: '<?php echo base_url('admin/facility/changefacilitybankstatus'); ?>',
				data: {bank_info_id:bank_info_id,status:status},
				success: function(res){
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
			});  
		 		 
		
	}


</script>

