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

							
							<li class="active">News Letter List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>
					
					<div class="page-content">
						<div class="row">
						
						
									<?php echo form_open_multipart('admin/master/newsletterlist',array('class'=>'form-horizontal')); ?>

									

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

									<?php echo form_submit(['class'=>'btn btn-info ordersmall','name'=>'Submit','id'=>'order_submits','value'=>'Submit']); ?>
									<a href="<?=base_url('admin/facility');?>" class="btn btn-info clearbtn" id="clearbtn">
									    <i class="fa fa-refresh" style="margin-top: -5px;"></i>
									</a>                                                          

									</div>

									</div>

									<?php echo form_close(); ?>
								
							
						
						</div>

					<div class="page-content">
						<div class="page-header">
						<div class="table-header">
											News Letter List
											
											<!--<ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="newsletterlist">
												   <a href="#"><img src="<?=base_url('assets/admin/images/Excel-icon.png')?>"
												    style="width:32px; margin-right:8px;"
												   ></a>
											  </ul>-->
											<form method="post" action="<?=base_url('admin/master/exportdatabynewletter');?>" id="excel_export">
											   <input type="hidden" name="start_date" id="start_dates" value="">
											  <input type="hidden" name="end_date" id="end_dates" value="">
											 </form> 
										</div>
									</div>
						<div class="row">
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								<div class="row">
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
									<div class="col-xs-12">
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">S.N</th>
				                                          <th>Email</th>
														<th>Creatd On</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													 
													if(isset($letterlist) && !empty($letterlist)){ $i=0 ;foreach($letterlist as $result){ $i++;
														
														
														?>
													<tr>
														<td class="center"><?= $i ?></td>
														<td class="center"><?=$result->email; ?></td>
														<td class="center"><?= date('d-m-Y',strtotime($result->create_on)); ?></td>
														
													<?php }
													} ?>
													</tr>
													

												</tbody>
											</table>
										</div>
									</div>
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

$(document).on('click','#newsletterlist',function(){
	 var start_date = $('#start_date').val();
	 var end_date = $('#end_date').val();
	 $('#start_dates').val(start_date);
	 $('#end_dates').val(end_date);
	  $('#excel_export').submit();
});
$(document).ready(function(){		
	$(document).on('click','#order_submits',function(){
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


</script>
	</body>
</html>


