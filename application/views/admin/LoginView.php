<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>SocialSportz | Login</title>

	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?=base_url();?>assets/admin/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=base_url();?>assets/admin/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="<?=base_url();?>assets/admin/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?=base_url();?>assets/admin/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?=base_url();?>assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?=base_url();?>assets/admin/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?=base_url();?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?=base_url();?>assets/js/html5shiv.min.js"></script>
		<script src="<?=base_url();?>assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="login-layout" style="margin-top: 50px">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">


						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header blue lighter bigger">
											<img style="width: 100%;max-height: 100px;" src="<?=base_url();?>/assets/admin/images/logo.png">
										</h4>

										<div class="space-6"></div>

										<form>
											
											<fieldset>

												<label class="block clearfix">

													<span class="block input-icon input-icon-right">

														<input type="text" class="form-control" placeholder="Username" id="admin_username" />
														<i class="ace-icon fa fa-user"></i>
														<span id="errusername" class="error"></span>
													</span>
													
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" id="admin_password" class="form-control" placeholder="Password" />
														<i class="ace-icon fa fa-lock"></i><span id="error_msg" style="bottom:-23px!important;" class="error"></span>
														
														<i class="ace-icon fa fa-lock"></i><span id="error_msg2" style="bottom:-42px!important;" class="error"></span>
													</span>
													
												</label>

												<div class="space"></div>

												<div class="clearfix">
													<label class="inline">

													</label>

													<button type="button" id ="admin_login" class="width-35 pull-right btn btn-sm ">
														<i style="color:#fff !important" class="ace-icon fa fa-key"></i>
														<span class="bigger-110" id="usr_loggin">Login</span>
													</button>
												</div>

												<div class="space-4"></div>
											</fieldset>
										</form>

									</div><!-- /.widget-main -->


								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->

						</div><!-- /.position-relative -->


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->
	<!-- basic scripts -->

	<!--[if !IE]> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<script>

		

		$("#admin_login").on("click",function(e){

			e.preventDefault();
			var username = $("#admin_username").val();
			var password = $("#admin_password").val();

			if(username=="")
			{
				$("#admin_username").focus();
				$("#errusername").html('Please enter Username');     
				return false;
			}
			else{
				$('#errusername').html(''); 
			}

			if(password=="")

			{
				$("#admin_password").focus();
				$('#errpassword').html('Please enter Password');
				return false;

			}
			else{
				$('#admin_password').html(''); 
			}


			if(username!='' && password!=''){
				$.ajax({
					type: "POST",
					async: true,
					url:'<?php echo base_url();?>admin/user/admin_login',	

					data: {username:username,password:password},

					success:function(res){
				//alert(res);return false;
				if(res==1){				    

					window.location.href = '<?php echo base_url('admin/user/dashboard') ?>';

				}

				 if(res==0){

					$('.alert-warning').addClass('show');

					$('#error_msg').text("You are entering Wrong User Id or Password"); 

				}else{
					$('#error_msg').text("");
				}
			    if(res==2){

					$('.alert-warning').addClass('show');

					$('#error_msg2').text("You are account has been suspended. Please contact to admin"); 

				}else{
					$('#error_msg2').text("");
				}		    						

			}	

		});



			} 

		});



	</script>

	
</body>
</html>
