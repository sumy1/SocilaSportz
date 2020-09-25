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
								<a href="<?= base_url('admin/user/admin_list');?>">Admin List</a>
							</li>
							<li class="active">Edit Admin</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">
							<div class="page-header">
						<div class="table-header">
											 Edit Admin
										</div>
									</div>
							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
								<div class="col-md-12">
									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open('admin/user/save_admin_edit_data',array('class'=>'form-horizontal')); ?>

									<div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'admin_id','id'=>'admin_id','class'=>'col-xs-12','hidden'=>'true', 'value'=>$adminInfo['0']->admin_id)); ?>

													<?php echo form_input(array('name'=>'admin_name','id'=>'admin_name','class'=>'col-xs-12','Placeholder'=>'Name', 'value'=>$adminInfo['0']->admin_name)); ?>

													<span id="errName" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Email</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'admin_email','id'=>'admin_email','class'=>'col-xs-12','Placeholder'=>'Email','value'=>$adminInfo['0']->admin_email)); ?>

													<span id="errEmail" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> User Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_name','id'=>'user_name','class'=>'col-xs-12','Placeholder'=>'User Name','value'=>$adminInfo['0']->admin_username)); ?>
													<span id="errUsername" class="error col-xs-12"> </span>


												</div>
											</div>

											<div class="form-group">

										<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Role</label>

												<div class="col-md-9">
										<select multiple="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose Admin Access..." name="admin_access[]">
											<?php
											// $matchArr[];
											if(isset($useraccessids) && !empty($useraccessids)){
											foreach ($useraccessids as $resultVal) {
											
												$matchArr[]= trim($resultVal->role_access); 
												
												}
											}
											if(isset($accessList) && !empty($accessList)){
												foreach ($accessList as $result) {
													?>
												<option value="<?=$result->role_access_for;?>" <?php if(in_array(trim($result->role_access_for), $matchArr)) echo 'selected'; ?>><?=$result->role_access_for;?></option>
												<?php }
											} ?>

										</select>
										<span id="errenselect" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Password</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'password','id'=>'password','class'=>'col-xs-12','Placeholder'=>'Password','value'=>$adminInfo['0']->admin_password)); ?>

													<span id="errPassword" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


									</div>
                        
                            <div class="col-md-6">
                            	<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			<label class="middle">
                            				<?php
                            				//print_r($adminInfo);

                            				 if($adminInfo['0']->admin_status=='enable'){  
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
                                   <div class=""style="width:130px; float:right;"> 								
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Admin','id'=>'admin_submit','value'=>'Submit']); ?>	 </div>										

                            	</div>

                            </div>

                            <div class="hr hr-24"></div> 					
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

		<!-- inline scripts related to this page -->
<script>

	$('#id-input-file-3,#id-input-file-1').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
	thumbnail:false //| true | large				
});
	/*form validation*/
	function isEmailValid(email){
    					return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
    				}
$('#admin_submit').click(function(e) {
	
	var admin_name = $('#admin_name').val();
    var admin_email = $('#admin_email').val();
    var user_name = $('#user_name').val();
    var password = $('#password').val();
	 var passwordlength = $('#password').val().length;
	 var rol=$( ".chosen-choices .search-choice" ).text();
    
	if(admin_name == ''){
        $('#admin_name').show();
        $('#errName').html('Please Enter  Name');
		return false;
    }
    else{
        $('#errName').html('');
    }
	  if(admin_email == ''){
        $('#admin_email').show();
        $('#errEmail').html('Please Enter  Email ID');
		return false;
    }
    else if (!isEmailValid(admin_email)) {
		$('#admin_email').show();
		$('#errEmail').html('Please enter valid email');
		return false;
    	}
    else{
        $('#errEmail').html('');
    }
    if(user_name == ''){
        $('#user_name').show();
        $('#errUsername').html('Please Enter  User Name');
		return false;
    }
    else{
        $('#errUsername').html('');
    }
	
   
    if(password == ''){
        $('#password').show();
        $('#errPassword').html('Please Enter  Password');
		return false;
    }
    else{
        $('#errPassword').html('');
    }if(passwordlength < 8 || passwordlength > 16){
		$('#errPassword').html('Please Enter  Password. Between 8 and 15 Characters');
		return false;
	        }
    else{
        $('#errPassword').html('');
    }if(rol == ''){
        $('#rol').show();
        $('#errenselect').html('Please Enter  Role');
		return false;
    }
    else{
        $('#errenselect').html('');
    }
	
});

/*Ajax check if email and username already exist*/

$('#user_name').keyup(function(){
 var user_name = $('#user_name').val();
 var admin_id = $('#admin_id').val();
 if (user_name != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/user/check_admin_username');?>',
    data:{user_name:user_name,admin_id:admin_id},
    success: function(data){
      if (data == 1) {
        $('#errUsername').html("user_name Alredy Exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errUsername').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
    }
  })
 }

 });

</script>

<script type="text/javascript">
	jQuery(function($) {
		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize

					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							var $this = $(this);
							$this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand					
					
				}

			});
		</script>
	</body>
</html>
