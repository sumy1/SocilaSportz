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
        h4{font-size:15px !important; font-weight:bold;}
        #termcondition p{font-size:14px; line-height: 22px; text-align:justify;}
	</style>
</head>

<body id="termcondition">
	<?php $this->load->view('public/common/header');?>
                <div class="header-data" style="margin-top:120px">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="top-head-nav clearfix">
                                <div class="page-title float-md-left">
                                    <h2>Terms & Conditions</h2>
                                </div>
                                <div class="navigation-bread float-md-right">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb"> 
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>   
                                            <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div class="container">
                <div>
            <div class="first_section row page_content">
              <?php
			    if(!empty($get_conditions->first_section)){
					echo $get_conditions->first_section;
				}
			  ?>
                
        </div>
    </div>
</div>
	<?php $this->load->view('public/common/footer');?>
	<?php $this->load->view('public/common/foot');?>
</body>

</html>