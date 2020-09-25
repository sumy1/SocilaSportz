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
#subscriptionbody .orange-btn {
    padding: 10px 25px;
    margin-top: 10px;
    display: inline-block;
}

</style>


</head>

<body id="subscriptionbody">
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
						<div class="col-md-6 pl-md-0 " id="subscriptionwrapper">
							
							<form action="" method="post">
								<h1>Subscription</h1>
								
                               
                               

								


								<div class="msg_subscribe" style="display: none;" id="count">You are subscribe with us successfully!</div>
							  <input type="hidden" id="countss" value="<?=$count;?>">
								  <?php
								 
								    if($count == 1){ ?>
											<span class="msg">You have subscribed to news and update from Social Sportz. </span><br>
											<a   class="orange-btn btn-default outline__btn login_s"  id="usr_loggin_subsc" value="inactive">Unsubscribe me</a><br>
										<?php }
										else{ ?>
										    <span class="msg">You are not getting any update, news alerts from Social Sportz.</span><br>
											<a   class="orange-btn btn-default outline__btn login_s" name="save"  id="usr_loggin_subsc" value="active" >Subscribe me</a>
										<?php }?>
								
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	
	<div class="loader">
				<div class="">
					<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
				</div>
			</div>

	<?php $this->load->view('public/common/footer');?>
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<iframe width="100%" height="300" src="https://www.youtube.com/embed/qR97wZCcNGM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('public/common/foot');?>
	
</body>

   




<script>
$(document).ready(function(){
$('#usr_loggin_subsc').click(function(){
	 var active=$(this).attr('value');
	 var count=$('#countss').val();
	 showingLoader();
	  $.ajax({
			 type: 'POST',
			 url : "<?php echo base_url('dashboard/subscriptioninsert')?>",
			 data : {active,active,count:count},
			 success: function(res){
	
				if(res ==1){
				
							 swal({
					        title : 'Newsletter unsubscribed successfully',
					        html : 'Sorry, you will not get any updates',
					        type: 'success'
					    }).then((result) => {
					        if (result.value) {
								window.location.reload('<?=base_url('dashboard/subscription');?>');
							}
					    })						
				}
				else if(res==2){
							 swal({
					        title : 'Newsletter subscribed successfully',
					        html : 'Now you wiil get all latest updates',
					        type: 'success'
					    }).then((result) => {
					        if (result.value) {
								window.location.reload('<?=base_url('dashboard/subscription');?>');
							}
					    })						
				}
				else{
					 swal({
					        title : 'Network Issuee!',
					        html : '',
					        type: 'warning'
					    }).then((result) => {
					        if (result.value) {}
					    })
				

				}
				hiddingLoader();
			 }
			
		});
		
	});
	
});
    

	$("#usr_loggin_subsc").click(function(){
		// $(".msg_subscribe").show().delay(1000).fadeOut();
	});
</script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</html>