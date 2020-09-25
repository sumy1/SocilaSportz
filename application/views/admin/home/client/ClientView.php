<!DOCTYPE html>

<html lang="en">

<?php $this->load->view('admin/includes/head');?> 

<body class="no-skin">

	<?php $this->load->view('admin/includes/header');?> 

	<div class="main-container ace-save-state" id="main-container">

		<?php $this->load->view('admin/includes/sidebar');?>

		<div class="main-content">

			<div class="page-content">

				<div class="main-content">

					<div class="main-content-inner">

						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
							<ul class="breadcrumb">
								<li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="<?= base_url('admin/user/dashboard');?>">Dashboard</a>
								</li>
								<li class="active">Banner</li>
							</ul><!-- /.breadcrumb -->


						</div>



						<div class="page-content">
							<div class="page-header">

								<div class="table-header">
									Add / Edit Client
								</div>				

							</div>

							<div class="row">

								<?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>

									<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>					

								<?php endif;?>	

								<div class="col-md-12">
									

									<!-- PAGE CONTENT BEGINS -->                               
									<!-- Add banner -->
									<?php if($this->uri->segment(4)==''){

										echo form_open_multipart('admin/home/add_client',array('class'=>'form-horizontal')); ?>

										<?php echo form_error(''); ?> 

										<div class="col-md-6">
											<div class="form-group">

												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Client Name </label>

												<div class="col-sm-10">

													<?php echo form_input(array('name'=>'client_title','id'=>'client_title','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Client Name','required'=>'')); ?>

													<span id="errName" class="error">  </span>

												</div>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">

												<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Image Name (1903px X 595px)</label>

												<div class="col-xs-7 no-padding-left">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="client_logo"></label>

													<span id="errLogo" class="error">  </span>

												</div>

											</div>
										</div>

										<hr>

										<div class="space-4"></div>

										<div class="col-md-4 ">

											<div class="form-group pull-right status-align">

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

												<div class="col-sm-9">									
													<span class="help-inline col-xs-12 col-sm-10">
														<label class="middle">
															<?php echo form_checkbox('status','enable',TRUE,['class'=>'ace','id'=>'status']); ?>												
															<span class="lbl"> Active</span>

														</label>
														<span id="errPageStatus" class="error">  </span>
													</span>
												</div>
												<div class="com-sm-3">
												 <div class="col-md-12 text-center submit-button">		
													<div class=""style="width:130px; float:right;">		
														   <?php echo form_submit(['class'=>'btn btn-info','id'=>'submit_data','value'=>'Submit']); ?>											
													  </div>
											      </div>
												</div>
                                            </div>

										</div>
										</div>



										<?php echo form_close(); }
                             //Edit banner
										else{

											echo form_open_multipart('admin/home/edit_client',array('class'=>'form-horizontal')); ?>

											<?php echo form_error(''); ?> 
                                           <div class="col-sm-6">
											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> client Name </label>

												<div class="col-sm-9">

													<?php echo form_input(array('name'=>'client_title','id'=>'client_title','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Client Name','value'=>$edit_data[0]->client_title)); ?>

													<span id="errName" class="error">  </span>

												</div>

											</div>                            
                                          </div>
										  <div class="com-sm-6">
											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client logo (1903px X 595px)</label>

												<div class="col-xs-4">

													<label class="ace-file-input">
														<input type="file" id="id-input-file-1" name="client_logo" value="<?=$edit_data[0]->client_logo;?>">
														<span id="errLogo" class="error">  </span>
													</label>

													<input type="hidden" id="client_id" name="client_id" value="<?=$edit_data[0]->client_id;?>" />
													<input type="hidden" id="client_logo_old" name="client_logo_old" value="<?=$edit_data[0]->client_logo;?>" />
													<?php if($edit_data[0]->client_logo!=''){ ?>
													<img src="<?=base_url('assets/admin/images/home/'.$edit_data[0]->client_logo);?>" height="50px" width="50px">
													<?php } ?>


												</div>

											</div>
											</div>

											<hr>

											<div class="space-4"></div>

											<div class="col-md-4 ">

												<div class="form-group pull-right">

													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

													<div class="col-sm-9">									
														<span class="help-inline col-xs-12 col-sm-10">
															<label class="middle">

																<?php
																if($edit_data['0']->client_status=='enable'){  
																	echo form_checkbox('status','enable',TRUE,['class'=>'ace','id'=>'status']); }
																	else{
																		echo form_checkbox('status','enable',false,['class'=>'ace','id'=>'status']);

																	}



																	?>											
																	<span class="lbl"> Active</span>

																</label>
																<span id="errPageStatus" class="error">  </span>
															</span>
														</div>

													</div>

												</div>

												<div class="space-4"></div>

												<div class="">

													<div class="col-md-6">											

														<?php echo form_submit(['class'=>'btn btn-info','id'=>'edit_data','value'=>'Submit']); ?>



													</div>

												</div>



												<?php echo form_close();} ?>						

											</div><!-- /.col -->

										</div>

										<hr />

										<table id="dynamic-table" class="table table-striped table-bordered table-hover">

											<thead>

												<tr>

													<th>S.No.</th>

													<th>Client Name</th>

													<th>Logo</th>							

													<th>Status </th>

													<th>Action</th>

												</tr>

											</thead>

											<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

												<tr>

													<td><?php echo $i; ?></td>

													<td><a><?php echo $result->client_title; ?></a></td>


													<td><img src="<?php echo base_url(); ?>assets/admin/images/home/<?php echo $result->client_logo; ?>" height="50px" width="50px" /></td>

													<td><?php echo ucwords($result->client_status); ?></td>					

													<td>

														<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/home/clients/'.$result->client_id); ?>">

																<i class="ace-icon fa fa-pencil bigger-130"></i>

															</a>

															<a class="red" href="<?php echo base_url('admin/home/delete_client/'.$result->client_id); ?>" onclick="return confirm('Are you sure you want to delete clients')">

																<i class="ace-icon fa fa-trash-o bigger-130"></i>

															</a>

														</div>

													</td>

												</tr>

												<?php  $i++;	}

											} ?>

										</tbody>

									</table>

									<!-- PAGE CONTENT ENDS -->

								</div><!-- /.col -->

							</div><!-- /.row -->

						</div><!-- /.page-content -->

					</div>

				</div><!-- /.main-content -->

			</div><!-- /.page-content -->

		</div>

	</div><!-- /.main-content -->

	<?php //include('includes/footer.php');?>

	<?php $this->load->view('admin/includes/footer'); ?>

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">

		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>

	</a>

</div><!-- /.main-container -->



<?php $this->load->view('admin/includes/foot'); ?>

<!-- inline scripts related to this page -->

</body>

</html>

<script>

	$('#submit_data').click(function(e) {
		var client_title = $('#client_title').val();
		var client_logo = $("input[name=client_logo]").val();
		var extcatclientImg = client_logo.split('.').pop();
		if(client_title==''){
			$('#errName').show();
			$('#errName').html('Please Enter Client Name');
			return false;

		}

		else{

			$('#errName').html('');

		}

		if(client_logo==''){

			$('#errLogo').html('Please Attach Logo Image');

			return false;

		}		

		if(client_logo!=''){
			var logo_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
			if(logo_size>500)
			{
				$('#errLogo').html('Please Attach Image below 500 kb');
				return false;
			}
			else
			{
				$('#errLogo').html('');
			}

			if($.inArray(extcatclientImg, ['png','jpg','jpeg','webp']) == -1) {
				$('#errLogo').html('Please Attach Image in png , jpg or jpeg format only');			
				return false;
			} 
			else{
				$('#errLogo').html('');
			}
		}

		else{

			$('#errLogo').html('');

		}

		return true;

	}); 


	/*Edit form validation*/

	$('#edit_data').click(function(e) {
		var client_title = $('#client_title').val();
		var client_logo = $("input[name=client_logo]").val();
		var extcatclientImg = client_logo.split('.').pop();
		if(client_title==''){
			$('#errName').show();
			$('#errName').html('Please Enter Client Name');
			return false;

		}

		else{

			$('#errName').html('');

		}		

		if(client_logo!=''){
			var logo_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
			if(logo_size>500)
			{
				$('#errLogo').html('Please Attach Image below 500 kb');
				return false;
			}
			else
			{
				$('#errLogo').html('');
			}

			if($.inArray(extcatclientImg, ['png','jpg','jpeg','webp']) == -1) {
				$('#errLogo').html('Please Attach Image in png , jpg or jpeg format only');			
				return false;
			} 
			else{
				$('#errLogo').html('');
			}
		}

		else{

			$('#errLogo').html('');

		}

		return true;

	});

	$('#id-input-file-1').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
	thumbnail:false //| true | large				
});
</script>