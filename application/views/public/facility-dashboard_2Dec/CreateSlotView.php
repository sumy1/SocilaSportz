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
	
	<?php $this->load->view('public/common/head');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css')?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">	
	<style>
	#slotfacility .checkboxenable{    display: inline-block !important;
		opacity: 1 !important;}
	</style>
</head>

<style>

</style>
<body class="dashboard sidebar-is-expanded">
	<div class="clearfix"></div>
	
	<?php $this->load->view('public/common/dashboard-sidebar');?>
	
	<main class="l-main" id="create-slotwrapper">
		<div class="header-data">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="top-head-nav clearfix">
							<div class="page-title float-md-left">
								<h1>Create Slot / Batches</h1>
							</div>
							<div class="navigation-bread float-md-right">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">	
										<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">My Dashboard</a></li>	
										<li class="breadcrumb-item active" aria-current="page">Create Slot </li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-wrapper content-wrapper--with-bg">
			<div id="fac_slot_div"></div>
		</div>
	</main>
<div class="loader">
	<div class="">
		<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
	</div>
</div>


	

	<!-- Footer Include Here -->
	<?php $this->load->view('public/common/footer');?>

	<p style="display: none" id = "status"></p>
	<a id = "map-link" target="_blank"></a>
</div>

<?php $this->load->view('public/common/foot');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
<script src="<?=base_url('assets/public/js/datedropper.min.js'); ?>"></script>




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
	$(document).on('click', '.weekoff label', function () {
		if($(this).find("input").is(':checked'))
		{
			$(this).find("input").prop('checked', false);
			$(this).removeClass('active');
		}

		else
		{
			$(this).find("input").prop('checked', true);
			$(this).addClass('active');
			$(this).parent("li").addClass("checked1");
		}


	});

	$(document).on('change','.checkboxenable', function() {
		if($(this).is(":checked")) {
			jQuery(this).parents(".slotreplica").find(".priceforavaialable").show();
		}

		else{jQuery(this).parents(".slotreplica").find(".priceforavaialable").hide();}

	});

	

	jQuery("#planadd").on("click", function(e){
		jQuery("#academyplanwrapper .titleheading").show();
		var cdf = jQuery("#createacademyplan").find("#academybatchtype option:selected").val(); var abc = jQuery("#academybatchprice").val(); jQuery('<div class="rowparent"><div class="row"><div class="col-sm-4 planname" style="padding-top:25px">'+cdf+'</div><div class="col-sm-4 planprice"><div class="form-group bmd-form-group is-filled is-focused"><label for="slotprice" class="bmd-label-floating">Price</label><input type="text" value="'+abc+'" class="planpriceeditable form-control"></div></div><div class="deletesection1"><a href="javascript:void(0)" class="btn btn-raised btn_add_sm"><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div><hr class="fullwidth"></div></div>').insertAfter("#createacademyplan");
		jQuery("#academybatchtype option:first-child").prop('selected', true); jQuery("#academybatchprice").val('');
		
	});
	
	jQuery(document).on("click", '.deletesection1', function(){jQuery(this).parents(".rowparent").remove()});



	$(document).ready(function(){
		setTimeout(function(){
	//$('#tab2-tab').on('click', function(e) {
		var fac_id =$("#headeracademyfacility option:selected" ).val();
	//var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
	action='fac_slot_div';
	showingLoader();
	
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/slot_form',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				hiddingLoader();
				$("#fac_slot_div").html(res['_html']);
				$('#facilityacadelisting').DataTable();
				jQuery('.slotreplica .timeclock').off().timeDropper({
										setCurrentTime: false
									});

				jQuery("#slotstartdate, #slotenddate").off().dateDropper();
			}	
		});
},700);
	});


	

</script>


<script>

</script>

</body>
</html>	