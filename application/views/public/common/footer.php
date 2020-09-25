<?php
$whr =  array('page_title'=>'footer','page_status'=>'enable');
$footer_info =  $this->CommonMdl->getResultByCond('tbl_static_page',$whr,'*',$order_by='');
$getglobeldata=$this->CommonMdl->getRow('tbl_globel_config',$clms='*',$whr=''); 		
 ?>
<footer>
	<div class="container">
		<div class="row mobilenomarg">
			<div class="col-md-4 nopadleft">

				<div class="infocontent">
					<!-- <?=$footer_info[0]->first_section; ?> -->

					<h3><span>Social Sportz</span></h3>

					<ul class="footer-info">
						<li class="address"><i class="fa fa-map-marker"></i> <span class="addressfooter">A-703, Gardenia Square, Crossing Republic, 							Ghaziabad - 201016, Uttar Pradesh, India</span></li>
						<li><a href="mailto:info@socialsportz.com"><i class="fa fa-envelope"></i> <?=$getglobeldata->config_email;?></a></li>
						<li><i class="fa fa-phone"></i><?=$getglobeldata->config_phone;?></li>

					</ul>
				</div>
					

				</div>


				<div class="col-md-8 nopadright">
					<div class="row">
						<?=$footer_info[0]->second_section; ?>
						<div class="contactdetail col-md-6 nopadright footerright footerwhiteicon">
						<h3>
							<span>Connect With Us</span></h3>
							<div class="subscribesend">
								<input class="subscribe" id="subscribe_email" placeholder="Enter Your Email" type="text" />
								<span id="error_msg" class="error"></span>
								<div class="sendbtn">
									<a class="subsc">Subscribe</a></div>
								</div>
							</div>
					</div>
				</div>	


			</div>


		</footer>	


		<div class="copyrightinfo container">
			<div class="row">
				<?=$footer_info[0]->third_section; ?>
			</div>
		</div>
		<script>

function isEmailValid(email){
		return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
	}
$(document).on('click', '.subsc', function(){

	 var EmailId=$('#subscribe_email').val(); 
     if(EmailId=='')
    {
    	$("#subscribe_email").focus();
    	$('#error_msg').html('Please enter Email');
    	return false;
    }
    else if(!isEmailValid(EmailId) ){

		$("#subscribe_email").focus();
		$('#error_msg').html('Please enter valid Email');
		return false;	
          } 
    $.ajax({
				type: "POST",
				async: true,
				url:'<?=base_url('login/email_subscribe'); ?>',	
				data: {EmailId:EmailId},
				success:function(res){
				    if(res==1)
                    {
                    $('#error_msg').removeClass('error');
                    $('#error_msg').addClass('green');
                      $('#error_msg').html('Thank you for subscribing socialsportz.');
                    }else if(res==2){
                       $('#error_msg').html('You have already subscribe.');
                       $('#error_msg').addClass('error');
                    $('#error_msg').removeClass('green'); 
                    }
				  					
				},	
				});  
});

setInterval(function(){
$('.dropify-wrapper').attr('title', '');
}, 500);

</script>