<!DOCTYPE html>
<html>
<head>
	<title>Social Sportz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<!-- Fonts For Heading & SubHeadings -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	
	<?php $this->load->view('public/common/head');?>
	
</head>

<body>

	<?php $this->load->view('public/common/header');?>
	<div class="clearfix"></div>
	<div class="container" style="position: relative;
    overflow: hidden;
    clear: both;
    margin-top: 90px;" >

		<div class="row" style="min-height:500px; ">

			<div class="col-sm-6  order-sm-1 align-items-center d-flex"><img class="loginside" src="<?=base_url('assets/public/images/loginsideimg.png');?>"></div>



			<div class="col-sm-6  order-sm-1 align-items-center d-flex">
				<div class="col-sm-12">
					<form method="post" class="" action="<?=base_url('login/update_password');?>">
						<h5 class="headline text-center" style="margin-top: 0px">Change password</h5>
							<input type="hidden" class="form-control" name="user_id" value="<?=$user_data[0]->user_id;?>">

						<div class="form-group bmd-form-group">
							<label for="passwrd" class="bmd-label-floating">New Password<span class="required">*</span></label>
							<input type="password" class="form-control" id="passwrdreset"  name="passwrdreset">
							<i class="fa fa-key prefix"></i>
							<span id="errpasswrdreset" class="error"> </span>	
						</div>

						<div class="form-group bmd-form-group">
							<label for="passwrd" class="bmd-label-floating">Confirm Password<span class="required">*</span></label>
							<input type="password" class="form-control" id="cpasswrdreset" name="cpasswrdreset">
							<i class="fa fa-key prefix"></i>
							<span id="errcpasswrdreset" class="error"> </span>	
						</div>

						<div class="clear"></div>


						<div class="col-12" style="margin-top: 50px">
							<button type="submit" id="forgot-password" class="btn btn-default btn-block outline__btn orange-btn gapbtn" name="resetpassword" value="Forgot Password">Change Password</button>
						</div>


					</form>
				</div>
			</div></div></div>
			<!-- Footer Include Here -->
			<?php $this->load->view('public/common/footer');?>

			<p style="display: none" id = "status"></p>
			<a id = "map-link" target="_blank"></a>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php $this->load->view('public/common/foot');?>
	
	<script>
		

$("input#username").focus();
$("input#username").parent().addClass("is-focused");

$('#forgot-password').click(function(e) {

	var passwrd = $('#passwrdreset').val();
	var cpasswrd = $('#cpasswrdreset').val();
	var validPass= $.trim($('#passwrdreset').val()).length;

	if(passwrd == ''){
		$('#errpasswrdreset').show();
		$('#errpasswrdreset').html('Please Enter Password');
		return false;
	}
	else{
		$('#errpasswrdreset').html('');
	}
	if(validPass < 6 || validPass > 16){
		$('#errpasswrdreset').show();
		$('#errpasswrdreset').html('Please Enter Password between 6 and 16 characters');
		return false;
	}
	else{
		$('#errpasswrdreset').html('');
	}

	if(cpasswrd == ''){
		$('#errcpasswrdreset').show();
		$('#errcpasswrdreset').html('Please enter confirm password');
		return false;
	}
	else{
		$('#errcpasswrdreset').html('');
	}

	if(passwrd != cpasswrd){
		$('#errcpasswrdreset').show();
		$('#errcpasswrdreset').html('Passwords do not Match');
		$('html,body').animate({scrollTop: $("#errcpasswrdreset").offset().top - 190},'slow');
		return false;
	}
	else{
		$('#errcpasswrdreset').html('');
	}


	return true;
});


</script>


</body>




</html>	