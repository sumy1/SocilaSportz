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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	
	<?php $this->load->view('public/common/head');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
	<style>
		.thanks_image{
			    text-align: center;
			    margin-top: 40px;
			}
	.btn-femilift_btn-re {
    background-color: #ec4613;
    border: 1px solid #ec4613;
    border-radius: 3px;
    letter-spacing: 1px;
    color: #fff;
    text-align: center !important;
    font-size: 15px;
    font-weight: 600;
    padding: 4px 21px;
}
.button_style{
	text-align: center;
}
   

		
	</style>
</head>

<body>

	<?php $this->load->view('public/common/header');?>
	<div class="clearfix"></div>
	<div class="container" style="position: relative;
    overflow: hidden;
    clear: both;
    margin-top: 90px;" >

		<div class="row" style="height:500px; ">
			
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="thanks_image">
							<img class="img-responsive" src="<?=base_url('assets/public/images/Thank-you-sports.png');?>" style="width: 390px;margin-top: 56px;"  height=" " alt="thanks page image">
						</div>
						   
   
    
						<p class="thank_text" style="text-align: center; margin-bottom: 32px;margin-top: 10px;"> <?php if($msg=$this->session->flashdata('msg'));?>
						<?=$msg;?></p>
						
						<?php if(isset($booking_no)){ ?>
							<p class="thank_text" style="text-align: center; margin-bottom: 32px;margin-top: 10px;"> <?php echo "Your booking has been confirm. Booking no.:-".$booking_no; ?></p>
						<?php } ?>
						<div class="button_style">
							<a href="<?=base_url();?>">
						<button type="button" class="btn-femilift_btn-re">Go To Home</button></a>
						<a href="<?=base_url('login');?>">

						<button type="button" class="btn-femilift_btn-re"style="margin-left: 33px;">Go To Login</button></a>
					</div>
					</div>
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


</body>




</html>	