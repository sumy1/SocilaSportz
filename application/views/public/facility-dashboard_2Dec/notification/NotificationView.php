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
	

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css')?>">
	<style>
	th{padding:7px 15px; font-size:12px;}
	.dataTables_info{padding:0 15px;}
	ul.pagination
	{
		padding:0 15px;
	}
</style>
</head>


<body class="dashboard sidebar-is-expanded">
	<div class="clearfix"></div>
	<?php $this->load->view('public/common/dashboard-sidebar.php');?>

	<main class="l-main">
		<div class="content-wrapper content-wrapper--with-bg">
			<!-- Breadcrumb start here -->
			<div class="header-data">
				<div class="container whitebg">
					<div class="row">
						<div class="col-md-12">
							<div class="top-head-nav clearfix">
								<div class="page-title float-md-left">
									<h2>Notifications</h2>
								</div>
								<div class="navigation-bread float-md-right">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">	
											<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">My Dashboard</a></li>	
											<li class="breadcrumb-item active" aria-current="page">Notifications</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Breadcrumb end here -->
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<div class="main_container_dashboard">
							<div class="row">
								<div class="col-md-6">
									<div class="stats">
										<ul class="list-inline">
									
											<li class="list-inline-item">
												<div class="stat-contain no-border clearfix">
													<div class="icon float-left">Total</div>
													<span class="badge badge-primary float-right" id="notification_count"></span>
												
												</div>
											</li>

										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<ul class="list-inline top_btns_action" >
										<li class="list-inline-item">
									
									<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="clearbtn"><i class="fa fa-refresh"></i> Clear<div class="ripple-container"></div></a>
								</li>
										<li class="list-inline-item">
											<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter</a>
										</li>

									</ul>

									</div>
								</div>

								<div class="filter_prodcuts">
									<ul class="list-inline filter_products_list">
										<li class="list-inline-item"><h5 class="title"><i class="fa fa-filter"></i> Filter By</h5></li>
										<!-- <li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm bmd-form-group is-filled" style="margin-top: 5px;">
												<label for="businessName" class="bmd-label-floating">Notifications Type</label>
												<select class="form-control" id="sportslist">
													<option selected="" value="">All</option>
													<option value="3">Read</option>
													<option value="4">Unread</option>

												</select>
												<i class="fas fa-percentage prefix"></i>
											</div>
										</li> -->
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm">
												<label for="businessName" class="bmd-label-floating">From Date</label>
												<input type="text" class="form-control datepicker" id="from_date" data-format="d-m-Y" data-translate-mode="false"  data-large-default="true" data-large-mode="true" data-init-set="false">
												<i class="fa fa-calendar prefix"></i>
											</div>
										</li>
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm">
												<label for="businessName" class="bmd-label-floating">To Date</label>
												<input type="text" class="form-control datepicker" id="to_date" data-format="d-m-Y" data-translate-mode="false"  data-large-default="true" data-large-mode="true" data-init-set="false">
												<i class="fa fa-calendar prefix"></i>
												<span id="errortodate" class="error"></span>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="btn-container">
												<a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn"><i class="fa fa-search"></i> Search</a>
											</div>
										</li>
									</ul>
								</div>		
								<hr>						
								<div class="show_datatable1 whitebg">

									<div class="tab-content1" id="nav-tabContent">
										<div class="tab-pane fade show active" id="activeTab" role="tabpanel" aria-labelledby="activeTab-tab">
											<div class="table-responsive notification_list" id="notification_list">
												<!--Datatable Start Here -->
												
												<!-- Datatable End here -->
											</div> 

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		
<div class="loader">
	<div class="">
		<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
	</div>
</div>



		<!-- Footer Include Here -->
		<?php $this->load->view('public/common/footer');?>


	</div>

	<?php $this->load->view('public/common/foot');?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<script src="<?=base_url('assets/public/js/datedropper.min.js');?>"></script>
	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>


	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script>
	$( ".time" ).timeDropper({
			setCurrentTime: false
		});
	$(window).on('load',function() {
	$(".loader").fadeOut('slow');
	});

	function showingLoader(){
	$(".loader").fadeIn(200);
	//$(".loader").fadeOut(1000);
	}
	function hiddingLoader(){
	//$(".loader").fadeIn(200);
	$(".loader").fadeOut(1000);
	}
		$('.datepicker').dateDropper();
		
		
		
		

		$(document).ready(function(){
			setTimeout(function(){
				var fac_id =$("#headeracademyfacility option:selected" ).val();
				action='notification_list';
				$.ajax({
					type: "POST",
                    //async: true,
                    url:'<?php echo base_url();?>facility/notification/notification_list',    
                    data: {fac_id:fac_id,action:action},
                    success:function(res){
                    	$("#notification_list").html(res['_html']);
                                   //$('#facilityacadelisting').DataTable();
                                   //jQuery('.slotreplica .timeclock').off().timeDropper();
                                    //jQuery("#slotstartdate, #slotenddate").off().dateDropper();
                                }              
                            });

				$.ajax({
					type: "POST",
                    //async: true,
                    url:'<?php echo base_url();?>facility/notification/notification_count',    
                    data: {fac_id:fac_id},
                    success:function(res){
                    	$("#notification_count").html(res['_html']);
                                
                                }              
                            });

			},700);
		});


		$('.search_btn').on('click', function(e) {
			var fac_id =$("#headeracademyfacility option:selected" ).val();
			var from_date =$("#from_date" ).val();
			var to_date =$("#to_date").val();
			
			if(from_date == '' && to_date == ''){
				$('#errortodate').html("Please select atleast one filter option");
			     return false;
			}
			else{
				$('#errortodate').html("");
			}
			
			
            if(from_date!='' && to_date!=''){			
				var endateArr = [];
				var startateArr = [];
				endateArr = to_date.split('-');
				startateArr = from_date.split('-');	
					
				if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
				$('#errortodate').html("");
				if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
					$('#errortodate').html("");
					if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
						$('#errortodate').html("");
					}else{
						$('#errortodate').show();
						$('#errortodate').html("To date should be greater than from date");
						return false;
					}	
					
					
				}else{
					$('#errortodate').show();
					$('#errortodate').html("To date should be greater than from date");
					return false;
				}	
				}else{
				  $('#errortodate').show();
				  $('#errortodate').html("To date should be greater than from date");
				return false;
				}
	
	        }
	
	//alert(from_date);
	
		action='notification_filter';
		$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/notification/notification_list',	
			data: {fac_id:fac_id,from_date:from_date,to_date:to_date,action:action},
			success:function(res){
				$("#notification_list").html(res['_html']);
			}	
		});

});
	</script>



</body>
</html>	