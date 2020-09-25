<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head'); ?> 

	<style>
   #admin_submit{width:120px !important;}
	</style>	

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

							<li class="active">Global Configuration </li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="page-header">
						<div class="table-header">
											 Global Configuration 
										</div>
									</div>
						<div class="row">
							
							<div class="page-content">
                               
                    

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
								<div class="col-md-12">

									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open('admin/master/editglobelconfig',array('class'=>'form-horizontal')); ?>

									<div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Config email</label>
                                                 <input name="config_idss"  type="hidden" name="" value="<?=$globel_config_listing[0]->config_id;?>" >

 
												<div class="col-md-10">

													<?php echo form_input(array('name'=>'config_email','id'=>'config_email','class'=>'col-xs-12','Placeholder'=>'Config Email','value'=>$globel_config_listing[0]->config_email)); ?>

													<span id="config_email_error" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Config phone</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'config_phone','id'=>'config_phone','class'=>'col-xs-12','Placeholder'=>'Config Phone','value'=>$globel_config_listing[0]->config_phone)); ?>

													<span id="config_phone_error" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Config address</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'config_address','id'=>'config_address','class'=>'col-xs-12','Placeholder'=>'Config Address','value'=>$globel_config_listing[0]->config_address)); ?>
													<span id="config_address_error" class="error col-xs-12"> </span>


												</div>
											</div>

											

										</div>

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Twitter link</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'twitter_link','id'=>'twitter_link','class'=>'col-xs-12','Placeholder'=>'Twitter Link','value'=>$globel_config_listing[0]->twitter_link)); ?>

													<span id="twitter_link_error" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
											
											<div class="col-md-6">
											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> fb link</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'fb_link','id'=>'fb_link','class'=>'col-xs-12','Placeholder'=>'fb Link ','value'=>$globel_config_listing[0]->fb_link)); ?>

													<span id="fb_link_error" class="error col-xs-12"> </span>


												</div>
											</div>
											</div>

											<div class="col-md-6">
											
											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Linkedin link</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'linkedin_link','id'=>'linkedin_link','class'=>'col-xs-12','Placeholder'=>'Linkedin Link ','value'=>$globel_config_listing[0]->linkedin_link)); ?>

													<span id="linkedin_link_error" class="error col-xs-12"> </span>


												</div>
											</div>

									

										</div>

									

									</div>


                        
                            	<!-- <div class="col-md-6">
                            		<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right" for="form-field-4">profile Image (250px X 250px)</label>
                            			<div class="col-sm-9">
                            				<div class="col-xs-10">

                            					<input type="file" id="id-input-file-1" name="banner_img" />
                            					<span id="errPageBannerImg" class="error">  </span>

                           				</div>

                            			</div>
                            		</div>
                            	</div> -->

                        

                     
                            <div class="">
                            	<div class="col-md-6">											
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Admin','id'=>'admin_submit','value'=>'Submit']); ?>											

                            	</div>

                            </div>					
                            <?php echo form_close(); ?>						

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
		</div><!-- /.main-container -->
	</body>
</html>

<script>
$(document).on('click','#admin_submit',function(){
   var config_email= $('#config_email').val();
   var config_phone = $('#config_phone').val();
   var config_address= $('#config_address').val();
   var twitter_link= $('#twitter_link').val();
   var fb_link= $('#fb_link').val();
   var linkedin_link= $('#linkedin_link').val();
   
   if(config_email == ''){
	   $('#config_email_error').html("Please enter your email");
	    return false;
   }else{
	    $('#config_email_error').html("");
   }if(config_phone == ''){
	    $('#config_phone_error').html("Please enter your phone");
	    return false;
   }else{
	   $('#config_phone_error').html("");
   }if(config_address == ''){
	   $('#config_address_error').html("Please enter your address");
	    return false;
   }else{
	    $('#config_address_error').html("");
   }if(twitter_link == ''){
	    $('#twitter_link_error').html("Please enter your twitter link");
	    return false;
   }else{
	    $('#twitter_link_error').html("");
   }if(fb_link == ''){
	   $('#fb_link_error').html("Please enter your fb link");
	    return false;
   }else{
	    $('#fb_link_error').html("");
   }if(linkedin_link == ''){
	    $('#linkedin_link_error').html("Please enter your fb linkedin link");
	    return false;
   }else{
	    $('#linkedin_link_error').html("");
   }
   
});
</script>