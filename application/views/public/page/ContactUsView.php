<!DOCTYPE html>
<html>
<?php
$getglobeldata=$this->CommonMdl->getRow('tbl_globel_config',$clms='*',$whr=''); 
?>
<head>
	<title>Social Sportz</title>
	<link rel="shortcut icon" type="image/png" href="favicon.png" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<?php $this->load->view('public/common/head');?>
	<style>
		.modal-backdrop{opacity: 0.6 !important}
		#searchForm .form-group select {    margin-left: 0px !important;}
		.search-area form i.fa-caret-down {top: 49% !important;}
		#searchForm .form-group i.fa{top:64%;}
		.nav-tabs a {font-size: 14px;}
		a.wobble-top.black{font-size: 14px}
		.sportsimgicon{left:5px !important;}
    .contact-section ::-webkit-input-placeholder { /* Edge */
    color: #000 !important;
    font-size:11px!important;
}
.capt{margin-top:22px;
}

.contact-section :-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #000 !important;
  font-size:11px!important;
}

.contact-section ::placeholder {
  color: #000 !important;
  font-size:11px!important;
}
	</style>
</head>

<body>
	<?php $this->load->view('public/common/header');?>
<section class="contact-section">

    <div class="auto-container">
    <div class="row">
                        <div class="col-md-12">
                            <div class="top-head-nav clearfix">
                                <div class="page-title float-md-left">
                                    <h2>Contact Us</h2>
                                </div>
                                <div class="navigation-bread float-md-right">
                            
                                        <ol class="breadcrumb"> 
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>  
                                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                        </ol>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="row clearfix"></div>
        <div class="row">
        <div class="contact-form-column col-md-8 col-sm-12 col-xs-12">
            <div class="inner-column">
                <h2>Drop Your Message Here</h2>
				 <span id="error_msg" class="error"></span>
                <!-- <div class="text">
                    Have a general question, find below contact details .
                </div> -->
                <div class="contact-form">
                    <form method="post"  id="contact-form" name="contact-form" novalidate="novalidate">
                        <div class="row clearfix"></div>
                        <div class="row">
                            
                        <div class=" col-md-6 col-sm-6 col-xs-12">
                            <?php if($this->session->userdata('user_role')!=1){?>
                            <div class="form-group">
                                <input type="text" name="name" id="name" onkeyup="leftTrim(this)" placeholder="Name*" required="">
                                <span class="error" id="errContactName"></span>
                            </div>

                            <div class="form-group">
                                <input type="text" name="email" id="email" onkeyup="leftTrim(this)" placeholder="Email*" required="">
                                <span class="error" id="errContactEmail"></span>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <input type="text" name="subject" id="subject" onkeyup="leftTrim(this)" placeholder="Subject*" required="">
                                <span class="error" id="errContactSubject"></span>
                            </div>
                        </div>
                        <div class=" col-md-6 col-sm-6 col-xs-12">
                             <?php if($this->session->userdata('user_role')!=1){?>
                            <div class="form-group">
                                <input type="text" name="number" id="phone" onkeypress="validate(event)"  placeholder="Number*" required="">
                                <span class="error" id="errContactPhone"></span>
                            </div>
                             <?php } ?>
                            <div class="form-group">
                                <textarea name="message" id="message" onkeyup="leftTrim(this)" style="width:100%; height:118px;" placeholder="Your Message..."></textarea>
                                <span class="error" id="errcontactMessage"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="row">
						  <div class="col-md-6 capt">
						  <div class="row">
						  <div class="col-md-4 captcha2 nopadright nopadleft" id="haze">
						  
						  </div>
						  <div class="col-md-4">
						  <input class="form-control" type="hidden" name="captcha22" id="captcha22" value="<?php echo substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);?>">
							<input class="form-control captcharefresh" type="text" name="captcha" id="captcha" style="width:100px!important"></div>
						  <div class="col-md-4">
						  <img class="ref" src="<?=base_url();?>assets/public/images/refresh.jpg" id="on" title="Refresh"></div>
						  </div>
						  </div>
						
						
						<span id="errCaptcha" class="error"> </span>
					</div>
                        </div>


                        <div class=" btn-column col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group text-center">
                                <button class="theme-btn btn-style-one" id="submitcontact"  name="submit-form">Submit Now</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
                <div class="contact-info-column col-md-4 col-sm-12 col-xs-12">
            <!-- <div class="inner-column">
                <div class="upper-box">
                  
                    <div class="emailed"><span>Mail at:</span> info@socialsportz.com</div>
                </div>
            </div> -->
            <div class="lower-box">
                <ul class="info-list">
                    <li>
                        <span class="icon">
                            <img src="<?=base_url('assets/public/images/address-icon.png')?>" alt="">
                        </span> <strong>Address:</strong> <?=$getglobeldata->config_address;?>
                    </li>
                    <li>
                        <span class="icon">
                            <img src="<?=base_url('assets/public/images/phone-icon.png')?>" alt="">
                        </span> <strong>Call Us:</strong><br> <?=$getglobeldata->config_phone;?>
                    </li>
                    <li>
                        <span class="icon">
                            <img src="<?=base_url('assets/public/images/mail-icon.png')?>" alt="">
                        </span> <strong>Mail Us:</strong> <a href="mailto:info@socialsportz.com"><?=$getglobeldata->config_email;?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="map-section">
    <div class="auto-container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.1144863776585!2d77.43684089999996!3d28.626330650000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cee39f6be52c9%3A0xc80f0980abfa2017!2sGardenia+Square!5e0!3m2!1sen!2sin!4v1402036623634" width="100%" height="247" frameborder="0" style="border:0"></iframe>
            </div>
        </div>
    </div>
</section>
	<?php $this->load->view('public/common/footer');?>
	<?php $this->load->view('public/common/foot');?>
</body>
<script type="text/javascript">
	$(function(){
		var dim = $('#captcha22').val();
		$.ajax({
			url:'<?=base_url();?>captcha_code_file_reg.php?rand='+dim,
			success:function(aaa){
	   //var arr = aaa.split('+');
	   $('#haze').html('<iframe src="<?=base_url();?>captcha_code_file_reg.php?rand='+dim+'" border="0" scrolling="no" allowtransparency="yes"  style="width:100%;margin-top: -32px;" frameBorder="0"></iframe>');   
	}	 
});
		$('#on').click(function(){
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for (var i = 0; i < 5; i++)
				text += possible.charAt(Math.floor(Math.random() * possible.length));


			$('#captcha22').removeAttr('value');
			$('#captcha22').attr('value',''+text+'');
			var dim = $('#captcha22').val();
			$.ajax({
				url:'<?=base_url();?>captcha_code_file_reg.php?rand='+dim,
				success:function(aaa){
	   //var arr = aaa.split('+');
	   $('#haze').html('<iframe src="<?=base_url();?>captcha_code_file_reg.php?rand='+dim+'" border="0" scrolling="no"  style="width:100%;margin-top: -40px;" frameBorder="0"></iframe>');   
	}	 
}); 
		});
	});



</script>

<script>

                        /*Submit Form Using Ajax*/
                    function isNumberValid(number){
                        var checkNumber = /^\d{10}$/;
                        return checkNumber.test(number);                        
                    }
                    function isNameValid(name){
                        return /[A-Z]+/i.test(name) && /[a-z]+/.test(name) && /\S{7,15}/.test(name);            
                    }
                    function isEmailValid(email){
                        return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
                    }
    $('#submitcontact').click(function(e) {
		e.preventDefault();
                        var role_id = '<?php echo $this->session->userdata('user_role') ?>';
                        var name = $('#name').val();
                        var email = $('#email').val();
                        var phone = $('#phone').val();
                        var subject = $('#subject').val(); 
                        var validPhone= $.trim($('#phone').val()).length;
                        var message = $('#message').val();
                        var captcha = $('#captcha').val();
				        var captcha22 = $('#captcha22').val();						
              

                        //alert(reCaptcha);
                        if(role_id!=1){
                        
                        if(name == ''){
                            $('#errContactName').show();
                            $('#errContactName').html('Please enter name');
                            $('html,body').animate({scrollTop: $("#errContactName").offset().top - 200},'slow');
                            return false;
                        }else{
                            $('#errContactName').html(''); 
                        }
                        
						if(phone == ''){
                            $('#errContactPhone').show();
                            $('#errContactPhone').html('Please enter mobile no.');
                            $('html,body').animate({scrollTop: $("#errContactPhone").offset().top - 200},'slow');
                            return false;
                        }else{
                            $('#errContactPhone').html(''); 
                        }
                        if( validPhone < 8 || validPhone > 16){
                            $('#errContactPhone').show();
                            $('#errContactPhone').html('Please enter mobile no. between 8 and 15 characters');
                            $('html,body').animate({scrollTop: $("#errContactPhone").offset().top - 200},'slow');
                            return false;
                        }else{
                            $('#errContactPhone').html(''); 
                        }
						
						
                        if(email == ''){
                            $('#errContactEmail').show();
                            $('#errContactEmail').html('Please enter email');
                            $('html,body').animate({scrollTop: $("#errContactEmail").offset().top - 200},'slow');
                            return false;
                        }
                        else if (!isEmailValid(email)) {
                            $('#errContactEmail').show();
                            $('#errContactEmail').html('Please enter valid email');
                            $('html,body').animate({scrollTop: $("#errContactEmail").offset().top - 200},'slow');
                            return false;
                        }
                        else{
                            $('#errContactEmail').html('');
                        }
                        }
						if(subject == ''){
                            $('#errContactSubject').show();
                            $('#errContactSubject').html('Please enter subject');
                            $('html,body').animate({scrollTop: $("#errContactSubject").offset().top - 100},'slow');
                            return false;
                        }else{
                            $('#errContactSubject').html(''); 
                        }
						if(message == ''){
                            $('#errcontactMessage').show();
                            $('#errcontactMessage').html('Please enter Message');
                            $('html,body').animate({scrollTop: $("#errcontactMessage").offset().top - 200},'slow');
                            return false;
                        }else{
                            $('#errcontactMessage').html(''); 
                        }

                           
						if(captcha == ''){
							$('#errCaptcha').html('Please enter Captcha');
							$('html,body').animate({scrollTop: $("#errCaptcha").offset().top - 190},'slow');
							return false;
						}
						else{
							$('#errCaptcha').html('');
						}

						if(captcha!= '' && captcha!=captcha22 ){
							$('#errCaptcha').html('Please enter valid Captcha');
							$('html,body').animate({scrollTop: $("#errCaptcha").offset().top - 190},'slow');
							return false;
						}
						else{
							$('#errCaptcha').html('');
						 // showingLoader();
						}

                        
                         var form = $("#contact-form")[0];
						 var myFormData = new FormData(form);
						 // showingLoader();
						 $.ajax({
									url : "<?=base_url('page/contactform');?>",
									type: 'POST',
									data: myFormData,
									cache: false,
									processData: false,
									contentType: false,
									async: false,
                                     success:function(res){
                                        if(res!='failed'){
									   hiddingLoader()
									   swal({
										title : 'Thank you for contacting us.',
										html : 'We will respond to your request shortly.',
										type: 'success'
									  }).then((result) => {
										if (result.value) {
											$('#name').val('');
											$('#subject').val(''); 
											$('#email').val('');
											$('#phone').val('');
                                            $('#message').val('');
											$('#captcha').val('');
										  
											 }
										   })

									}
										else{
											$('#error_msg').show(); 
	                                        $('#error_msg').text("Network issue");
										}
								    }									  
						  		 
							 
						      });
					       
                  
                    });

</script>  

</html>