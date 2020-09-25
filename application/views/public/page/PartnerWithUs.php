
<!DOCTYPE html>
<html>

<head>
	<title>Social Sportz</title>
	<link rel="shortcut icon" type="image/png" href="favicon.png" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css">
	<?php $this->load->view('public/common/head');?>
	<style>
		body{background: #fff !important}
		.modal-backdrop{opacity: 0.6 !important}
		#searchForm .form-group select {    margin-left: 0px !important;}
		.search-area form i.fa-caret-down {top: 49% !important;}
		#searchForm .form-group i.fa{top:64%;}
		.nav-tabs a {font-size: 14px;}
		a.wobble-top.black{font-size: 14px}
		.sportsimgicon{left:5px !important;}

		h4{font-size: 15px;
    font-weight: bold;}

    .about_data_content {
    padding: 30px;
    background-color: #fff;
    min-height: 250px;
}

.about_data_content.clip_right {
    -webkit-clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);
    clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);
}

.about_data_content.clip_left {
    -webkit-clip-path: polygon(25% 0%, 100% 1%, 100% 100%, 25% 100%, 0% 50%);
    clip-path: polygon(25% 0%, 100% 1%, 100% 100%, 25% 100%, 0% 50%);
}

.header-data{margin: 25px 0;}

#partnerwithus .aos-animate img{width:250px}
	</style>



</head>

<body id="partnerwithus">
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
	<?php $this->load->view('public/common/header');?>

		<div class="clearfix"></div>
	<div class="container-fluid">
		<div class="row">

		</div>
	</div>

		<div class="content-wrapper content-wrapper--with-bg">

			<div class="header-data">
				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<div class="top-head-nav clearfix">
								<div class="page-title float-md-left">
									<h2>Partner with us</h2>
								</div>
								<div class="navigation-bread float-md-right">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">	
											<li class="breadcrumb-item"><a href="index.php">Home</a></li>	
											<li class="breadcrumb-item active" aria-current="page">Partner with us</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container text-center">
        <div class="row page_content">

              <div class="first_section row">
				  <?php
				    if(!empty($get_partnerdata->first_section)){
					   echo $get_partnerdata->first_section;
					   
				   };
				  
				  ?>
	          </div>




         <div class="second_section row"> 
              <?php
			       if(!empty($get_partnerdata->second_section)){
					   echo $get_partnerdata->second_section;
					   
				   };
				?>
				


      </div>

                <div class="clearfix"></div>
                        
				
	 
            </div>
	</div>	</div>

<a id="back2Top" title="Back to top" href="#"><i class="fa fa-angle-up"></i></a>
	<?php $this->load->view('public/common/footer');?>
	<?php $this->load->view('public/common/foot');?>
	<script>
		AOS.init({
				easing: 'ease-out-back',
				duration: 1000,
				disable: 'mobile'
			});	

		$("body").on("scroll", function(){
AOS.init({
				easing: 'ease-out-back',
				duration: 1000,
				disable: 'mobile'
			});	
		});
	</script>
</body>

</html>