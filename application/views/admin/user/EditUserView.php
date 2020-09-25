<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head'); ?> 

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

							<li>
								<a href="<?= base_url('admin/user/userlist');?>">User List</a>
							</li>
							<li class="active">Edit Page</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">

                    <div class="page-header">
						<div class="table-header">
											Edit User
										</div>
									</div>

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
								<div class="col-md-12">
                                 
									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open_multipart('admin/user/userupdate',array('class'=>'form-horizontal')); ?>

									<div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Name</label>

                                      <?php
                                    // echo '<pre>'; print_data($user_edit); die();

                                 ?>

												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_name','id'=>'user_name','class'=>'col-xs-12','Placeholder'=>'user Name','value'=>$user_edit[0]->user_name,'readonly'=>'yes')); ?>

													<span id="error_user_name" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Email</label>

												<div class="col-md-9">
													<?php echo form_input(array('name'=>'user_email','id'=>'user_email','class'=>'col-xs-12','Placeholder'=>'User Email','value'=>$user_edit[0]->user_email,'readonly'=>'yes')); ?>

													<span id="error_user_email" class="error col-xs-12"> </span>
                                                </div>
											</div>

										</div>



										

										


										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Email Verified</label>
                                                <div class="col-md-9">
												
													 <?php echo form_input(array('name'=>'is_email_verified','id'=>'is_email_verified','class'=>'col-xs-12','Placeholder'=>'User Email','value'=>$user_edit[0]->is_email_verified,'readonly'=>'yes')); ?>

													<?php
/* 													echo form_input(array('name'=>'is_email_verified','id'=>'is_email_verified','class'=>'col-xs-12','Placeholder'=>'Is Email Verified','value'=>$user_edit[0]->is_email_verified));
 */

													?>

													<span id="error_is_email_verified" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
                                       

										<!--<div class="col-md-6">
											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Password</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_password','id'=>'user_password','class'=>'col-xs-12','Placeholder'=>'User Password','value'=>$user_edit[0]->user_password,'readonly'=>'yes')); ?>

													<span id="error_user_password" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>-->
										


										<div class="col-md-6">
											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Gender</label>


												<div class="col-md-9">
												
												
													<select name="user_gender" class="form-control"disabled> 
															    <option value="<?php if($user_edit[0]->user_gender=="M")echo "selected";?>">Male</option>
															    <option value="<?php if($user_edit[0]->user_gender=="F") echo "selected"?>">Female</option>
  
                                                     </select>
													<span id="error_user_radio" class="error col-xs-12"> </span>
												</div>

											</div>
										</div>
                                    



										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Mobile Number</label>


												<div class="col-md-9">
													<?php echo form_input(array('name'=>'user_mobile_number','id'=>'user_mobile_number','class'=>'col-xs-12','Placeholder'=>'User Mobile Number','value'=>$user_edit[0]->user_mobile_no,'readonly'=>'yes')); ?>

													<span id="error_user_mobile_number" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Mobile Verified</label>
                                                 <div class="col-md-9">
                                                        <select name="mobile_verification" class="form-control"disabled> 
															    <option value="<?php if($user_edit[0]->is_mobile_verified=="no")echo "selected";?>">No</option>
															    <option value="<?php if($user_edit[0]->is_mobile_verified=="yes") echo "selected"?>">Female</option>
  
                                                     </select>
													 </div>
											
													

													<span id="error_is_mobile_verified" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> City</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_city','id'=>'user_city','class'=>'col-xs-12','Placeholder'=>'User City','value'=>$user_edit[0]->user_city,'readonly'=>'yes')); ?>

													<span id="error_user_city" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>



										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Address</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_address','id'=>'user_address','class'=>'col-xs-12','Placeholder'=>'User Address','value'=>$user_edit[0]->user_address,'readonly'=>'yes')); ?>
													<input type="hidden" name="user_id" value=<?=$user_edit[0]->user_id;  ?>>

													<span id="error_user_address" class="error col-xs-12"> </span>


												</div>

											</div>
										</div>


                         <!--
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Pin Code</label>
												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_pin_cod','id'=>'user_pin_cod','class'=>'col-xs-12','Placeholder'=>'User Pin Code','value'=>$user_edit[0]->user_pincode,'readonly'=>'yes')); ?>

													<span id="error_user_pin_cod" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>
										
										-->



										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Country</label>
												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_country','id'=>'user_country','class'=>'col-xs-12','Placeholder'=>'User Country','value'=>$user_edit[0]->user_country,'readonly'=>'yes')); ?>

													<span id="error_user_country" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>



										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Google Address</label>
												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_google_address','id'=>'user_google_address','class'=>'col-xs-12','Placeholder'=>'User Google Address','value'=>$user_edit[0]->user_google_address,'readonly'=>'yes')); ?>

													<span id="error_user_google_address" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Latitude</label>
												<div class="col-md-9">
													<?php echo form_input(array('name'=>'user_latitude','id'=>'user_latitude','class'=>'col-xs-12','Placeholder'=>'User Latitude','value'=>$user_edit[0]->user_latitude,'readonly'=>'yes')); ?>

													<span id="error_user_latitude" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Longitude</label>
												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_longitude','id'=>'user_longitude','class'=>'col-xs-12','Placeholder'=>'User Longitude','value'=>$user_edit[0]->user_longitude,'readonly'=>'yes')); ?>

													<span id="error_user_longitude" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> User Swap</label>
												<div class="col-md-9">
												
												
												<select name="user_rol" class="form-control">
													 <option value="1">End User</option>
													 <option value="2">Academy / Facility</option>
													 
												</select>
												<p  style="color:red;">Note : While swapping, user data will not be accessible</p>
											<span id="error_rol" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Login  Type</label>
												<div class="col-md-9">
												
												
												<select name="user_login_type" class="form-control"disabled>
													 <option value="<?php if($user_edit[0]->user_login_type=="Website")echo "selected";?>">Website</option>
													 <option value="<?php if($user_edit[0]->user_role=="FB")echo "selected";?>">FB</option>
													 <option value="<?php if($user_edit[0]->user_role=="Google")echo "selected"; echo"disabled";?>">Google</option>
												</select>
												<span id="error_user_longitude" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>
										
									





										
												</div>
											</div>

										</div>



						<div class="col-md-6">

									<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			
                            				
									  <select name="user_status" class="form-control"> 
														<option value="enable" <?php if($user_edit[0]->user_status=="enable")echo "selected";?>>Active</option>
														<option value="disable" <?php if($user_edit[0]->user_status=="disable") echo "selected"?>>Incative</option>

									  </select>
															
											
                            				<span id="errPageStatus" class="error">  </span>
                            			</span>
                            		</div>
                            	</div>

										</div>

									

									

                            <div class="space-4"></div>
                            <div class="">
                            	<div class="col-md-12">											
                            		<div style="width:130px; float:right">										
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Page','id'=>'page_submit','value'=>'Submit']); ?>											
                                   </div>
                            	</div>

                            </div>					
                            <?php echo form_close(); ?>			
                        </div><!-- /.row -->
                        </div><!-- /.col -->

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

		<!-- inline scripts related to this page -->
<script>

$('#page_name').blur(function(){
 var page_name = $('#page_name').val();
 var page_id = $('#page_id').val();
 if (page_name != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/cms/check_page_name');?>',
    data:{page_name:page_name,page_id:page_id},
    success: function(data){
      if (data == 1) {
        $('#errPagetitle').html("Page Title Alredy Exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errPagetitle').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
    }
  })
 }

 });


$('#page_slug').blur(function(){
 var page_slug = $('#page_slug').val();
 var page_id = $('#page_id').val();
 if (page_slug != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/cms/check_page_name');?>',
    data:{page_slug:page_slug,page_id:page_id},
    success: function(data){
      if (data == 1) {
        $('#errPageSlug').html("Page Slug Alredy Exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errPageSlug').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
    }
  })
 }

 });



CKEDITOR.replace('facility_description', {
    	filebrowserBrowseUrl: base_url+"assets/kcfinder/browse.php?type=files"
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

<!-- inline scripts related to this page -->
	</body>
</html>
