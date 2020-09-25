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

							<li class="active">Enquire List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="row">
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
							   <div class="row">
							     <form action="<?=base_url('admin/page/enquirelisting');?>" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                      <div class="col-md-3">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" style="margin-left:22px;" for="form-field-1">Start Date </label>
												<input class="date-picker-from" id="start_date" name="start_date" value="<?php if(isset($start_date)){echo $start_date;}?>" type="text" readonly="" data-date-format="dd-mm-yyyy">
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
											<input class="date-picker-to" id="end_date" name="end_date" value="<?php if(isset($end_date)){echo $end_date;}?>" type="text" readonly="" data-date-format="dd-mm-yyyy">
											<span class="">
											<i class="fa fa-calendar bigger-110 calin icon_bhi"></i>
											</span>
											<span class="errenquireDate" class="error"style="color:red;"> </span>
										</div>
									</div>
									<!--<div class="col-md-3">
										<div class="form-group">
										<label class="col-md-3 control-label no-padding-right" for="form-field-1">status </label>
										<select name="select_stat" id="select_stat" class="form_input">
											 <option value=""> Admin Approval</option>
											<option value="approved">Approved</option>
											<option value="disapproved">Disapproved</option>
											<option value="void">Void</option>
										</select>

										<span id="errCouponStat" class="error"> </span>

										</div>

									</div>-->

									<div class="col-md-3">

									<input type="submit" name="Submit" value="Submit" class="btn btn-info ordersmall" id="order_submit">
                                                        
                                        <a href="<?=base_url('admin/page/enquirelisting');?>" class="btn btn-info clearbtn" id="clearbtn">
									    <i class="fa fa-refresh" style="margin-top: -5px;"></i>
									</a>   
									
									</div>
                                 </form>
							   
							   
							
									<div class="col-xs-12">
										
										<div class="table-header">
											Enquire List
											 <ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="contactdata">
												   <a href="#"><img src="<?=base_url('assets/admin/images/Excel-icon.png')?>"
												    style="width:32px; margin-right:8px;"
												   ></a>
											  </ul>
											<form method="post" action="<?=base_url('admin/page/exportdataenquire');?>" id="excel_export">
											<input type="hidden" value="contact_filter" name="action">
											   <input type="hidden" name="start_date" id="start_dates" value="">
											  <input type="hidden" name="end_date" id="end_dates" value="">
											  <!--<input type="hidden" name="select_stat" id="select_statuss" value="">
											  -->
											 </form>
											 
											 
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
												
													<tr>
														<th class="center">S.N</th>
														<th>User Name</th>
														<th>Facility Name</th>
														<th>User Email</th>
														<th>User Contact</th>
														<th>Subject</th>
														<th>Message</th>
														<!--<th>Query Status</th>-->
														<!--<th>approve status </th>-->
														<th>Created On</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													if(isset($enquiredata) && !empty($enquiredata)){ $i=0 ;foreach($enquiredata as $result){ $i++; ?>
													<tr>
														
														<td class="center"><?= $i ?></td>
														<td><?= $result->user_name; ?></td>
														<td><?= $result->fac_name; ?></td>
														<td><?= $result->user_email; ?></td>
														<td><?= $result->user_mobile; ?></td>
														<td><?= $result->query_title; ?></td>
														<td><?php echo substr($result->query_message,0,30); ?></td>
														<!--<td><?= $result->query_status; ?></td>
														<td>
														   <select onchange="changeuserstatus('<?php echo $result->	query_id; ?>')" name="" id="sel1" class="form_input statusCode">
															   <option value="approved" <?php if($result->approve_status == "approved") echo "selected"; ?>>Approved</option>
															   <option value="disapproved" <?php if($result->approve_status == "disapproved") echo "selected"; ?>>Disapproved</option>
															   <option value="void" <?php if($result->approve_status == "void") echo "selected"; ?>>Void</option>
														 </select>
														</td>-->
														<td><?= date('d-m-Y',strtotime($result->create_on)); ?></td>
													

														<!--<td>
															<div class="hidden-sm hidden-xs action-buttons">
													
																<a class="green" href="<?= base_url('admin/user/useredit/'.$result->user_id);?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

															<a class="red" href="<?= base_url('admin/user/delete_user/'.$result->user_id);?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>
														</td>-->
														
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
<script>
$(document).ready(function(){		
	$(document).on('click','#order_submit',function(){
		 var form_date=$('#start_date').val();
		 var to_date= $('#end_date').val();
				var startateArr = [];
				var endateArr = [];
				startateArr = form_date.split('-');
				endateArr = to_date.split('-');
				// alert(startateArr+endateArr);
				if(form_date!=''  && to_date!=''){
					if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) && (parseInt(endateArr[1]) >= parseInt(startateArr[1])) && (parseInt(endateArr[2]) >= parseInt(startateArr[2]))){
						$('.errenquireDate').html('');
					}else{
						 $('.errenquireDate').html('End date should be greater than start date');
						  return false;
					}
				}
				
	});		
});


		var contactdata=document.querySelector('#contactdata');
		contactdata.addEventListener('click',function(){
				   var start_date= document.getElementById('start_date').value; 
				   var end_date= document.getElementById('end_date').value; 
					// var select_stat= document.getElementById('select_stat').value; 
				
					  // alert(start_date+'/'+end_date+'/'+select_stat);
					 document.getElementById('start_dates').value=start_date; 
					  document.getElementById('end_dates').value=end_date; 
					 // document.getElementById('select_statuss').value=select_stat; 
					  $('#excel_export').submit();
		});
	
		  function changeuserstatus(query_id){
		     var user_status=$('.statusCode').val(); 
		
	  $.ajax({
		  type:'post',
		  url:'<?=base_url('admin/page/enquirechangestatus') ?>',
		  data: {query_id:query_id,user_status:user_status},
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
	</body>
</html>
