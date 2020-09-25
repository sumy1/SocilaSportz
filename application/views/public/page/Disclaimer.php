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

.careerimg{height: 443px !important}


.contact-section ::placeholder {
  color: #000 !important;
  font-size:11px!important;
}

h4{font-size:15px !important; font-weight:bold;}

#disclaimer p{font-size:14px; line-height: 22px; text-align:justify;}
    </style>
</head>

<body id="disclaimer">
    <?php $this->load->view('public/common/header');?>
<section class="contact-section">

    <div class="auto-container">
    <div class="row">
                        <div class="col-md-12">
                            <div class="top-head-nav clearfix">
                                <div class="page-title float-md-left">
                                    <h2>Disclaimer</h2>
                                </div>
                                <div class="navigation-bread float-md-right">
                            
                                        <ol class="breadcrumb"> 
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>  
                                            <li class="breadcrumb-item active" aria-current="page">Disclaimer</li>
                                        </ol>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="row clearfix"></div>
        <div class="section_first row">
        <?php
		  if(!empty($get_disclaimer->first_section)){
			  echo $get_disclaimer->first_section;
		  }
		
		?>

              
    </div>
    </div>
</section>
    <?php $this->load->view('public/common/footer');?>
    <?php $this->load->view('public/common/foot');?>
</body>


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
    $('#submitcontact').click(function() {
                        var name = $('#name').val();
                        var subject = $('#subject').val(); 
                        var email = $('#email').val();
                        var phone = $('#phone').val();
                        var validPhone= $.trim($('#phone').val()).length;
                        var message = $('#message').val();                 
              

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
                            $('#errcontactMessage').html('Please enter subject');
                            $('html,body').animate({scrollTop: $("#errcontactMessage").offset().top - 200},'slow');
                            return false;
                        }else{
                            $('#errcontactMessage').html(''); 
                        }

                    });

</script>  

</html>