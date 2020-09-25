<!DOCTYPE html>
<html>

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

.contact-section :-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #000 !important;
  font-size:11px!important;
}

.careerimg{height: 443px !important; object-fit: cover;}


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
                                    <h2>Career</h2>
                                </div>
                                <div class="navigation-bread float-md-right">
                            
                                        <ol class="breadcrumb"> 
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>  
                                            <li class="breadcrumb-item active" aria-current="page">Career</li>
                                        </ol>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="row clearfix"></div>
        <div class="row">
        <div class="contact-form-column col-md-8 col-sm-12 col-xs-12">
            <div class="inner-column">
                <h2>Apply for job</h2>
                <!-- <div class="text">
                    Have a general question, find below contact details .
                </div> -->
                <div class="contact-form">
                    <form method="post"  id="career-form" novalidate="novalidate">
                        <div class="row clearfix"></div>
                        <div class="row">
                        <div class=" col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input type="text" name="name" id="name" onkeyup="leftTrim(this)" placeholder="Name*" required="">
                                <span class="error" id="errContactName"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" id="email" onkeyup="leftTrim(this)" placeholder="Email*" required="">
                                <span class="error" id="errContactEmail"></span>
                            </div>
                            
                        </div>
                        <div class=" col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input type="text" name="number" id="phone" onkeypress="validate(event)"  placeholder="Phone*" required="">
                                <span class="error" id="errContactPhone"></span>
                            </div>
                           <div class="form-group">
                                <textarea name="message" id="message" onkeyup="leftTrim(this)" style="width:100%; height:118px;" placeholder="Your Message..."></textarea>
                                <span class="error" id="errcontactMessage"></span>
                            </div>
							
                        </div>

                        <div class="col-md-6" style="margin-top:20px">
                                    <label class="control-label" for="issueId">Upload Resume</label>
                                    <input type="file" name="PostedResume" id="PostedResume" accept="application/msword,application/pdf">
                                    <span class="field-validation-valid text-danger" data-valmsg-for="issueId" data-valmsg-replace="true"></span>
									<span class="error" id="errorimage"></span>
                        </div>

                    

                        <div class="col-md-6" style="margin-top:20px">
                          <div class="row">
						<div class="col-md-3 captcha2 nopadright nopadleft captcha2" id="haze"></div>
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 captcha nopadright">

							<input class="form-control" type="hidden" name="captcha22" id="captcha22" value="<?php echo substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);?>">
							<input class="form-control captcharefresh" type="text" name="captcha" id="captcha">
                            <span id="errCaptcha" class="error"> </span>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 captcha capb " style="position: relative;">
							<img class="ref" src="<?=base_url();?>assets/public/images/refresh.jpg" id="on" title="Refresh">
                            
						</div>
						
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
                <img class="careerimg" src="<?=base_url('assets/public/images/career-pic.jpg')?>">
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
                        var name = $('#name').val();
                        var message = $('#message').val(); 
                        var email = $('#email').val();
                        var phone = $('#phone').val();
                        var validPhone= $.trim($('#phone').val()).length;
						var postedresume=$('input[name=PostedResume]').val();
						var extcatcheque_image=postedresume.split('.').pop();
						var captcha = $('#captcha').val();
				         var captcha22 = $('#captcha22').val();
			           //alert(reCaptcha);
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

                           if(message == ''){
                            $('#errcontactMessage').show();
                            $('#errcontactMessage').html('Please enter message');
                            $('html,body').animate({scrollTop: $("#errcontactMessage").offset().top - 100},'slow');
                            return false;
                        }else{
                            $('#errcontactMessage').html(''); 
                        }
						
						if(postedresume == ''){
							 $('#errorimage').show();
							 $('#errorimage').html('Please attach pdf docx doc');
							 $('html,body').animate({scrollTop: $("#errorimage").offset().top - 100},'slow');
							 return false;
						}
						else{
							$('#errorimage').html('');
						}
						if(postedresume!=''){
								var image_size=parseFloat($("#PostedResume")[0].files[0].size / 1024).toFixed(2);
								
								if(image_size>1000){
									$('#errorimage').html('Please pdf  docx doc below 1000 kb');
									return false;
								}
								else{
									$('#errorimage').html('');
								}
								if($.inArray(extcatcheque_image,['pdf','cvv']) == -1){
									$('#errorimage').html('Please attach pdf  docx doc format only');         
									return false; 
								}
								else{
									$('#errorimage').html('');
								}
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
					     
						 var form = $("#career-form")[0];
						 var myFormData = new FormData(form);
						 // showingLoader();
						 $.ajax({
									url : "<?=base_url('page/careerform');?>",
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
										title : 'Thanks',
										html : 'Your form submitted succesfully and will get back to you soon',
										type: 'success'
									  }).then((result) => {
										if (result.value) {
                                            window.location.href='<?=base_url('page/career');?>'
											/*$('#name').val('');
                                            $('#captcha').val();
											$('#email').val('');
											$('#phone').val('');
											$('#message').val(''); 
											$('input[name=PostedResume]').val('');*/
											
						                    
				        
										  
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