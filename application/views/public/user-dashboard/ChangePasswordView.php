<!DOCTYPE html>
<html>

<head>
	<title>Social Sportz</title>
	
	
	<?php $this->load->view('public/common/head');?>
	<style>
	
	label{font-size:12px !important;}
	.modal-backdrop{opacity: 0.6 !important}
	header{
	background: #000;
}

.user-profile .bmd-form-group .bmd-label-static
{
	top:0.5rem !important;
}

.userdasboard-wrapper
{
	margin-top:120px;
}



.search-area:before{
	content: '';
	width:100%;
	height:109px;
	background:rgba(255,255,255,0.4);
	left:0px;
	top:0px;
	position:absolute;
}

.search-wrapper{
		margin-top: 230px;
}

.search-area {    background: url(assets/images/footer_bg.jpg);}
.search-area {
	position:fixed !important;
	margin-bottom: 30px;
	top: 105px;
	height: 105px;
	z-index: 9999999;
}

.roundborder1 {
    border: 1px solid #f5f0f0;
    border-radius: 10px;
    padding: 20px 50px;
    max-width: 100%;
    background: #fff;
    width: 500px;
}
</style>
	<link rel="stylesheet" href="assets/css/datedropper.min.css">

</head>

<body class="user-profile">
	<?php $this->load->view('public/common/header');?>
	<!-- // Banner starts Here // -->
	<div class="clearfix"></div>

		
<section class="userdasboard-wrapper">
<div class="container">
<div class="row">

<div class="col-sm-12">
<div class="row">
				<div class="col-md-4">

<div class="sidebar_profile">
<?php $this->load->view('public/common/usersidebar');?>
</div>
</div>
				<div class="col-md-8 pl-md-0 " id="editprofilewrapper">
				<h1 class="text-center">Change Password</h1>
     <div class="container-fluid roundborder1">
						<form action="" class="sm_inputs">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="oldPassword" class="bmd-label-floating">Old Password</label>
										<input type="password" class="form-control" id="oldPassword">
										
										<i class="fa fa-key prefix"></i>
										<a href="javascript:void(0)" class="show_password" id="oldPasswordEye">
										<i class="fa fa-eye eyeopenpassword eyepassword" style="display: none;"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword" style=""></i>
										</a>
										<span id="errOldPsw" class="error"> </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="newPassword" class="bmd-label-floating">New Password</label>
										<input type="password" class="form-control" id="newPassword">
										<i class="fa fa-key prefix"></i>
										<a href="javascript:void(0)" class="show_password" id="newPasswordEye">
										<i class="fa fa-eye eyeopenpassword eyepassword" style="display: none;"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword" style=""></i>
										</a>
										<span id="errNewPsw" class="error"> </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group bmd-form-group bmd-form-group-sm">
										<label for="confirmPassword" class="bmd-label-floating">Confirm Password</label>
										<input type="password" class="form-control" id="confirmPassword">
										<i class="fa fa-key prefix"></i>
										<a href="javascript:void(0)" class="show_password" id="confirmPasswordEye">
										<i class="fa fa-eye eyeopenpassword eyepassword" style="display: none;"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword" style=""></i>
										</a>
										<span id="errConfirmPsw" class="error"> </span>
									</div>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-12 text-center">
								<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1 orange-btn" id="changePasswordBtn"> Update</a>
							</div>
						</div>

					</div>
			</div>
		</div>
</div>

</div>
</div>
</section>

		<?php $this->load->view('public/common/footer');?>
	
		<?php $this->load->view('public/common/foot');?>
	</body>



<script>

	jQuery(".eyeslashpassword").on("click", function(){jQuery(this).parents(".form-group").find("input[type='password']").attr("type","text"); jQuery('.eyepassword').show(); jQuery(this).hide();});

jQuery(".eyeopenpassword").on("click", function(){jQuery(this).parents(".form-group").find("input[type='text']").attr("type","password"); jQuery('.eyepassword').show(); jQuery(this).hide();});



	$('#changePasswordBtn').click(function(event) {
			var oldPassword = $('#oldPassword').val();
			var newPassword = $('#newPassword').val();
			var confirmPassword = $('#confirmPassword').val();
			var validPass= $.trim($('#newPassword').val()).length;
			if(oldPassword == ''){
			$('#oldPassword').show();
			$('#errOldPsw').html('Please enter old password');
			return false;
			}
			else{
				$('#errOldPsw').html(''); 
			}
			if(newPassword == ''){
			$('#newPassword').show();
			$('#errNewPsw').html('Please enter new password password');
			return false;
			}
			else{
				$('#errNewPsw').html(''); 
			}
		if(validPass < 6 || validPass > 16){
			$('#newPassword').show();
			$('#errNewPsw').html('Please Enter Password between 6 and 16 characters');
			return false;
		}
		else{
			$('#errNewPsw').html('');
		}

			if(confirmPassword == ''){
			$('#confirmPassword').show();
			$('#errConfirmPsw').html('Please enter confirm password');
			return false;
			}
			else{
				$('#errConfirmPsw').html(''); 
			}

			if(newPassword!=confirmPassword){
			$('#confirmPassword').show();
			$('#errConfirmPsw').html('New and confirm password not matched');
			return false;
			}
			else{
				$('#errConfirmPsw').html(''); 
			}

			$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/change_password',	
			data: {oldPassword:oldPassword,newPassword:newPassword},
			success:function(res){
				//alert(res);
				if(res==1){
					swal({
						title : 'Password changed successfully',
						html : '',
						type: 'success'
							}).then((result) => {
						if (result.value) {
							$('#changePassword').modal('hide');
							 	$('#oldPassword').val('');
								$('#newPassword').val('');
							 	$('#confirmPassword').val('');
							 	window.location.href = '<?php echo base_url('login/logout') ?>';
										}
						})
				}
				else if(res==2){
					swal({
						title : 'Old password not matched',
						html : '',
						type: 'warning'
							}).then((result) => {
						if (result.value) {
							 	$('#oldPassword').val('');
								$('#newPassword').val('');
							 	$('#confirmPassword').val('');
							
										}
						})

				}
				else{
					swal({
						title : 'Netork issue occured',
						html : '',
						type: 'warning'
							}).then((result) => {
						if (result.value) {
							$('#changePassword').modal('hide');
							 	$('#oldPassword').val('');
								$('#newPassword').val('');
							 	$('#confirmPassword').val('');
										}
						})
				}			    

			}	
		});

			

		});

</script>

</html>