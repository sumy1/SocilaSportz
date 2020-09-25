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
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css');?>">
	<style>
    label.btn{
    	cursor: default !important;
    }

	.date_data .fa-calendar{
	    color: black;
    position: absolute;
    top: 8px;
    right: 7px;
	}
	
		.date_data .fa-check-circle{
	    color: black;
    position: absolute;
    top: 8px;
    left: 7px;
	display:none;
	color:#69f169;
	}
	.date_data.selected:after {display:none;}
	
	.date_data.selected .fa-check-circle{display:block; font-size:20px;}
		.booked{
		pointer-events:inherit !important;
	}
	</style>
	</head>



	<body class="dashboard sidebar-is-expanded userslotbooked">
		<div class="clearfix"></div>

		<?php $this->load->view('public/common/dashboard-sidebar');?>




		<main class="l-main">
			<div class="content-wrapper content-wrapper--with-bg">
				<div class="header-data">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="top-head-nav clearfix">
									<div class="page-title float-md-left">
										<h2>Offline Booking List</h2>
									</div>
									<div class="navigation-bread float-md-right">
										<nav aria-label="breadcrumb">
											<ol class="breadcrumb">	
												<li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">My Dashboard</a></li>	
												<li class="breadcrumb-item active" aria-current="page">Offline Booking Details</li>
											</ol>
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
		<div id="booking_detail"></div>


					</div>
				</main>
				<!-- Footer Include Here -->
				<?php $this->load->view('public/common/footer');?>

				<p style="display: none" id = "status"></p>
				<a id = "map-link" target="_blank"></a>
			</div>

			<?php $this->load->view('public/common/foot');?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
			<script src="<?=base_url('assets/public/js/dropify.min.js'); ?>"></script>
		
			<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

			<script>
				jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
				$(document).ready(function () {
					$("#selectAll").click(function () {
						$(".selectcheck").attr('checked', this.checked);
					});
				});
				$('.filter_prodcuts').hide();
				$('#toggleFilter').click(function(event) {
					$('.filter_prodcuts').slideToggle();
				});
				jQuery(document).on("click", '.hamburger-toggle', function(){
					jQuery("#rnr-logo .logo__txt img").show();
				});

				"use strict";

				var Dashboard = function () {
					var global = {
						tooltipOptions: {
							placement: "right"
						},
						menuClass: ".c-menu"
					};

					var menuChangeActive = function menuChangeActive(el) {
						var hasSubmenu = $(el).hasClass("has-submenu");
						$(global.menuClass + " .is-active").removeClass("is-active");
						$(el).addClass("is-active");

		// if (hasSubmenu) {
		// 	$(el).find("ul").slideDown();
		// }
	};

	var sidebarChangeWidth = function sidebarChangeWidth() {
		var $menuItemsTitle = $("li .menu-item__title");

		$("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
		$(".hamburger-toggle").toggleClass("is-opened");

		if ($("body").hasClass("sidebar-is-expanded")) {
			$('[data-toggle="tooltip"]').tooltip("destroy");
		} else {
			$('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
		}
	};

	return {
		init: function init() {
			$(".js-hamburger").on("click", sidebarChangeWidth);

			$(".js-menu li").on("click", function (e) {
				menuChangeActive(e.currentTarget);
			});

			$('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
		}
	};
}();

Dashboard.init();
//# sourceURL=pen.js
</script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(document).ready(function() {
		$('.browseFiles-container').dropify({
			messages: {
				'default': 'Click here to upload file',
				'replace': 'Click here to replace file',
			}
		});
				// Deals
				$('.datepicker').dateDropper();



				$('.view_customers_list').click(function(event) {
					$('.list_customer').slideToggle();
				});
				// $('#toggleFilter').click(function(event) {
				// 	$('.filter_prodcuts').slideToggle();
				// });
				$('.sendSMSbtn').click(function() {
					$('#sendSMS').modal('show');
					$('#pendingDealDecs, #dealDesc, #dealDesc').modal('hide');
				});
				
			
				
				
				var windowWidth = $(window).width();
				if(windowWidth > 767){
					$('.zoomProduct').zoom();
				}
			});
	
	$('#listCustomerTable').DataTable();
</script>

  <script src="<?=base_url('assets/public/js/datedropper.min.js');?>"></script>
  

<script>





$(document).ready(function(){
	setTimeout(function(){
    var fac_id =$("#headeracademyfacility option:selected" ).val();
	action='fac_booking_div';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/offline_booking_detail',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				$("#booking_detail").html(res['_html']);
			}	
			});
		},700);
		});

</script>
</body>
</html>	