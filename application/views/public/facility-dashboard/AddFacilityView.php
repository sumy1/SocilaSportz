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
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="assets/css/pignose.calendar.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-clockpicker.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery-clockpicker.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/timedropper.min.css">
	<link rel="stylesheet" href="assets/css/datedropper.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<style>

	#navbarDropdown{display: none;}

	#mySelect_hidden{display: none}



</style>
</head>


<body class="dashboard sidebar-is-expanded" id="dashboardaddacademy" >
	<div class="clearfix"></div>
	<?php $this->load->view('public/common/dashboard-sidebar');?>

	<main class="l-main">
		<div class="header-data">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="top-head-nav clearfix">
							<div class="page-title float-md-left">
								<h1>Add Facility/Academy</h1>
							</div>
							<div class="navigation-bread float-md-right">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">	
										<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">My Dashboard</a></li>	
										<li class="breadcrumb-item active" aria-current="page">Add Academy/Facility </li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-wrapper content-wrapper--with-bg">

			<div id="create_events">

				<div class="tab-content">
					<div id="facility" class="container tab-pane active fade nopadright">
						<form action="" class="" id="step_2_form" name="step_2_form" enctype="multipart/form-data">
							<div class="text-center">
								<label class="radio-inline btn" id="facilityselect1">
									<input type="radio" name="fac_type" checked="checked" value="Facility"><span class="bmd-radio"></span><span class="bmd-radio"></span>
								Facility</label>
								<label class="radio-inline btn" id="academyselect1">
									<input type="radio" name="fac_type" value="Academy" ><span class="bmd-radio"></span><span class="bmd-radio"></span>
								Academy</label>

							</div>
							<div id="academyfacilitywrapper">
								<div class="panel-heading12">Basic Details</div>
								<div class="row">
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group bmd-form-group">
													<label for="facilityname1" class="bmd-label-floating">Facility Name<span class="required">*</span></label>
													<input type="text" class="form-control" name="facilityname" id="facilityname1" onkeyup="leftTrim(this)">	<i class="fa fa-university prefix"></i>
													<span id="errFacilityname1" class="error"> </span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-group" id="defaulttimingcontainer">
													<div class="editbox">
														<label for="timing" class="bmd-label-floating">Open/Close Timing</label>

														<select class="form-control" id="mySelect"></select>

														<select class="form-control" id="mySelect_hidden" name="fac_timing[]" multiple="multiple"></select>

														<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
														<i class="fa fa-edit prefix edittimepopup" data-toggle="modal" data-target="#shopTiming" aria-hidden="true"></i>
													</div>
													<div class="timinginitator" >
														<label for="timing" class="bmd-label-floating">Open/Close Timing</label>
														<input type="text" class="form-control" id="timing">	<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
														<span id="errTiming" class="error"> </span>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group bmd-form-group">
													<label for="description" class="bmd-label-floating">About Facility</label>
													<textarea id="textacademy" name="fac_text" onkeyup="leftTrim(this)"></textarea>	<i class="fa fa-file-text prefix" aria-hidden="true"></i>
													<span id="errFacilitydescription" class="error"> </span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">

										<input type="file" id="input-file-banner"  name="fac_banner" class="dropify " />
										<span id="banner_erro" class="error"> </span>

									</div>
									<div class="imagetoupload col-sm-12">
										<hr>
										<div class="nopadleft nopadright">
											<div class="panel-heading12 facilityacademyaddress">Facility Address</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group bmd-form-group">
														<label for="facilitycity" class="bmd-label-floating">City</label>
														<input type="text" class="google_address form-control charval" name="fac_city" id="facilitycity" onkeyup="leftTrim(this)">
														<input type="hidden" class="form-control" id="latitude" name="latitude">
														<input type="hidden" class="form-control" id="longitude" name="longitude">
														<i class="fa fa-map-marker prefix"></i>
														<span id="errFacilitycity" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group">
														<label for="facilityarea" class="bmd-label-floating">Area</label>
														<input type="text" class="form-control" name="fac_area" id="facilityarea" onkeyup="leftTrim(this)">	<i class="fa fa-map-marker prefix"></i>
														<span id="errFacilityrea" class="error"> </span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group">
														<label for="facilitypincode" class="bmd-label-floating">Pincode</label>
														<input type="text" class="form-control" id="facilitypincode" name="fac_pincode" onkeypress="validate(event)">	<i class="fa fa-map-marker prefix"></i>
														<span id="errFacilitypincode" class="error"> </span>
													</div>
												</div>
											</div>
										</div>
		<!-- <hr>
		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading12">
					<input type="checkbox" id="achievementcheckbox"> Achievement(If any)</div>
					<div class="col-sm-12 nopadleft nopadright" id="achievementtable" style="padding-left:0px;">
						<div class="boxachievement">
							<div class="row">

								<div class="col-md-3" id="selectBoxTitle1">
									<div class="form-group selectdiv bmd-form-group is-filled">
										
										<label for="titleValue" class="bmd-label-floating">Select Achievement</label>
										<select class="form-control custom-select-sm" id="selectOfferTitle" name="reward_type[]">
											<option disabled="disabled" selected="selected">Select Achievement Type</option>
											<?php if (isset($rewards_type) && $rewards_type!='') {
												foreach ($rewards_type as $rewards) { ?>
												<option value="<?=$rewards->reward_id;?>"><?=$rewards->reward_name;?></option>
												<?php	}
											} ?>



										</select>
										<i class="fa fa-list-alt prefix"></i>
                                        <span id="errFacilityachivement" class="error">
									</div>					
								</div>


								<div class="col-md-4">
									<div class="form-group bmd-form-group">
										<label for="facilityname" class="bmd-label-floating">Title</label>
										<input type="text" class="form-control" id="facilityname" name="reward_title[]">	<i class="fa fa-trophy prefix"></i>
										<span id="errFacilityname" class="error"> </span>
									</div>
								</div>


								<div class="col-md-2">
									<input type="file" id="input-file-image1" class="dropify" name="achievement_img1[]" />
								</div>
								<div class="col-md-2">
									<input type="file" id="input-file-image2" class="dropify" name="achievement_img2[]"/>
								</div>
								<div class="col-sm-1">	<a href="javascript:void(0)" class="btn btn-raised btn-success btn_add_sm" id="add_grneral"><i class="fa fa-plus"></i><div class="ripple-container"></div></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="col-md-12 text-right">

			<ul class="list-inline business_detail_buttons">
				<li class="list-inline-item">
					<a id="fac_detail" href="javascript:void(0)" class="btn btn-raised btn_proceed facilitynext">Save</a>
				</li>
			</ul>
		</div>
	</div>
</div>
</div>
</form>
</div>





</div></div>
</main>

<!-- Footer Include Here -->
<?php $this->load->view('public/common/footer');?>

<p style="display: none" id = "status"></p>
<a id = "map-link" target="_blank"></a>
</div>

<?php $this->load->view('public/common/foot');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="assets/js/dropify.min.js"></script>


<script type="text/javascript" src="assets/js/timedropper.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="js/dropify.min.js"></script>
<!-- Modals -->


<div class="timeedit"></div>

<?php //include 'include/modal.php'; ?>
<div class="modal fade modal_default view_deal edit_profile_modal" id="shopTiming" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title pl-3" id="exampleModalLongTitle">Add Opening & Closing Time</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="detials_comp">
								<form action="" class="sm_inputs">
									<div class="selectall"><input type="checkbox" > Select All</div>
									<span class="error" style="    width: 100%; top: -6px; text-align: center; height:10px" id="oneselect"></span>
									<ul class="list-inline list_edit_times">
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Mon</p>
												</div>
												<div class="col-md-4 col-sm-12">
													<div class="form-group bmd-form-group-sm">
														<label for="mondayOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="1:24 pm" id="mondayOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 col-sm-12 ">
													<div class="form-group bmd-form-group-sm">
														<label for="mondayCl" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="closing form-control time" value="1:28 pm" id="mondayCl">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Tue</p>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group-sm">
														<label for="tueOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="1:30 pm" id="tueOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group bmd-form-group-sm">
														<label for="tueCl" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="closing form-control time closeing" value="1:40 pm" id="tueCl">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Wed</p>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group-sm">
														<label for="wedOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="9:24 am" id="wedOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group bmd-form-group-sm">
														<label for="wedCl" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="form-control closing time" value="10:24 pm" id="wedCl">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Thu</p>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group-sm">
														<label for="ThurOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="10:50 pm" id="ThurOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group bmd-form-group-sm">
														<label for="ThurCL" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="closing form-control time" value="10:50 pm" id="ThurCL">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Fri</p>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group-sm">
														<label for="friOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="5:25 am" id="friOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group bmd-form-group-sm">
														<label for="mobileNum" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="closing form-control time" value="5:25 am" id="mobileNum">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Sat</p>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group-sm">
														<label for="satOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="10:30 am" id="satOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group bmd-form-group-sm">
														<label for="satCl" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="closing form-control time" value="10:30 am" id="satCl">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="row">
												<div class="checkbox small_checkbox time_check">
													<label>
														<input type="checkbox" class="selectcheck-close">
													</label>
												</div>
												<div class="col-md-3">
													<p class="day">Sun</p>
												</div>
												<div class="col-md-4">
													<div class="form-group bmd-form-group-sm">
														<label for="sunOp" class="bmd-label-floating time_label">Opening</label>
														<input type="text" class="form-control time" value="5:36 pm" id="sunOp">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
												<div class="col-md-4 ">
													<div class="form-group bmd-form-group-sm">
														<label for="sunCl" class="bmd-label-floating time_label">Closing</label>
														<input type="text" class="closing form-control time" value="5:36 pm" id="sunCl">	<i class="far fa-clock prefix"></i>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">	<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="shopTimingBtn">Submit</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<script>

	$(document).ready(function() { $('body').bootstrapMaterialDesign(); });
</script>

<script>
	$(document).ready(function () {	
		$('.dropify').dropify({});
		$('.selectpicker').selectpicker({});
	});

	jQuery(".timinginitator").on("click", function()
		{jQuery("#shopTiming .list-inline-item").each(function(){jQuery(this).find(".day").parent(".col-md-3").next().find("input").val("7:00 AM"); jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val("9:00 PM");});})





	$('#facility input[type=radio]').change(function() {
		if (this.value == 'Academy') {
			jQuery("#facilityname1").siblings('label').text("Academy Name");
			jQuery("#textacademy").siblings('label').text("About Academy");
			jQuery(".facilityacademyaddress").text("Academy Address");
		}
		else if (this.value == 'Facility') {
			jQuery("#facilityname1").siblings('label').text("Facility Name");
			jQuery("#textacademy").siblings('label').text("About Facility");
			jQuery(".facilityacademyaddress").text("Facility Address");
		}
	});




	jQuery(document).on("click", "#shopTimingBtn", function(){
		var mno = jQuery(".sm_inputs").find(".list-inline-item.checked").length;
		if(mno==0){$("#oneselect").show(); $("#oneselect").html("Please Select at least one date"); return false;}
		jQuery("#shopTiming .close").trigger("click");
		jQuery("#mySelect,#mySelect_hidden").empty();

		jQuery(".list-inline-item.checked").each(function(){ 
			var bookdate = jQuery(this).find(".day").text(); 
			var bookopentime = jQuery(this).find("input[type='text']").val();
			var bookclosetime = jQuery(this).find("input.closing").val();
			console.log(bookclosetime);


			var abc = jQuery(".sm_inputs").find(".list-inline-item.checked").length;

			if(abc > 0)
			{
				$("#oneselect").text("");
				jQuery("#shopTiming .close").trigger("click");
				jQuery(".editbox").show();
				jQuery("#defaulttimingcontainer").addClass('is-filled');

				jQuery("#mySelect,#mySelect_hidden").empty();
				jQuery(".timinginitator").hide();
				/*    $('#mySelect').append('<option value="' + key + '">' + selectValues[key] + '</option>');*/
				setTimeout(function(){

					jQuery("#mySelect,#mySelect_hidden").append('<option selected value="'+ bookdate +'-'+ bookopentime +'-'+ bookclosetime +'"><span style="width:120px">'+ bookdate +'</span> : '+ bookopentime +'  to '+ bookclosetime +'</span></option><i class="fa fa-clock-o prefix" aria-hidden="true"></i> <i class="fa fa-edit prefix edittimepopup" data-toggle="modal" data-target="#shopTiming" aria-hidden="true"></i>');

					jQuery("#exampleModalLongTitle").text("Edit Opening & Closing Time");
					jQuery("#shopTimingBtn").text("Update");

				},200);
			}

		})





	});


	jQuery("#listingtabbtn").on("click", function(){
		jQuery("#academyfacilitywrapper").hide();
		jQuery("#listingwrapper").show();
	});

	jQuery("#academytabbtn").on("click", function(){
		jQuery("#academyfacilitywrapper").show();
		jQuery("#listingwrapper").hide();
	});

	/*$('#shopTiming').modal('show'); */



	$('#achievementcheckbox').change(function() {
		if($(this).is(":checked")) {
			jQuery("#achievementtable").show();
		}

		else{jQuery("#achievementtable").hide();}

	});

	$('.checkboxenable').change(function() {
		if($(this).is(":checked")) {
			jQuery(this).parents(".gap15").find(".priceforavaialable").show();
		}

		else{jQuery(this).parents(".gap15").find(".priceforavaialable").hide();}

	});






	jQuery("#add_grneral,.editparent").on("click", function(){
		$("#achievementtable").append('<div class="boxachievement"><div class="row"><div class="col-md-3" id="selectBoxTitle"><div class="form-group selectdiv bmd-form-group is-filled"><label for="titleValue" class="bmd-label-floating">Select Achievement</label><select class="form-control custom-select-sm" id="selectOfferTitle" name="reward_type[]"><option disabled="disabled" selected="selected">Select Achievement Type</option><?php foreach($rewards_type as $rewards) { ?><option value="<?=$rewards->reward_id;?>"><?=$rewards->reward_name;?></option><?php } ?></select> <i class="fa fa-list-alt prefix"></i></div></div><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="facilityname" class="bmd-label-floating">Title</label> <input type="text" class="form-control" id="facilityname" name="reward_title[]"><i class="fa fa-trophy prefix"></i> <span id="errFacilityname" class="error"> </span></div></div><div class="col-md-2"> <input type="file" id="input-file-image1" name="achievement_img1[]" class="dropify" /></div><div class="col-md-2"> <input type="file" id="input-file-image2" name="achievement_img2[]" class="dropify" /></div><div class="col-sm-1">	<a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm deleteparent" ><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div></div></div>');

		$('.dropify').dropify({});

	});





	jQuery(document).on("click", '.deleteparent', function(){jQuery(this).parents(".boxachievement").remove()});


</script>

<script>
	jQuery(document).on("click", ".checkbox-decorator", function(){
		jQuery(this).parents(".list-inline-item").toggleClass("checked")
	});






</script>





<script>

	jQuery("#input-file-banner").siblings(".dropify-message").find("p").text("Upload Primary Banner (500px*500px)");

	jQuery("#input-file-image1").siblings(".dropify-message").find("p").text("Image 1 (200px*200px)");
	jQuery("#input-file-image2").siblings(".dropify-message").find("p").text("Image 2  (200px*200px)");

	setTimeout(function(){
		var url = window.location.href; jQuery("header .topnav li").each(function(){var cdf = jQuery(this).find("a").attr("href"); if(url.indexOf(cdf) > -1){jQuery("header .topnav li").removeClass("activenav"); jQuery(this).addClass("activenav")}});

		$( "#shopTiming .form-control.time" ).timeDropper({
			setCurrentTime: false
		});
	},200);




	achievementeditable();

	$('#fac_detail').on('click', function(e) {

		var fac_name = $('#facilityname1').val();
		var fac_id = $('#fac_id').val();
		var fac_about = $('#textacademy').val();
		var fac_banner =  $('input[name=fac_banner]').val();
		var extcatgst_image = fac_banner.split('.').pop();				
		var fac_city = $('#facilitycity').val();	


		var fac_area = $('#facilityarea').val();			
		var fac_pincode = $('#facilitypincode').val();
		var validPincode = $.trim($('#facilitypincode').val()).length;	
		var fac_time =$("#mySelect option:selected" ).val();
		var selectOfferTitle =$("#selectOfferTitle").val();
		var facilityname =$("#facilityname").val();

//alert(fac_time);	

if(fac_name == ''){
	$('#facilityname1').show();
	$('#errFacilityname1').html('Please enter name');
	$('html,body').animate({scrollTop: $("#errFacilityname1").offset().top - 200},'slow');
	return false;
}else{
	$('#errFacilityname1').html(''); 
}
if(fac_time==undefined){
	$('#timing').show();
	$('#errTiming').html('Please enter Time');
	$('html,body').animate({scrollTop: $("#errTiming").offset().top - 200},'slow');
	return false;
}else{
	$('#errTiming').html(''); 
}

if(fac_about == ''){
	$('#textacademy').show();
	$('#errFacilitydescription').html('Please enter name');
	$('html,body').animate({scrollTop: $("#errFacilitydescription").offset().top - 200},'slow');
	return false;
}else{
	$('#errFacilitydescription').html(''); 
}



if(fac_banner == ''){
	$('#banner_erro').show();
	$('#banner_erro').html('Please attach banner image');
	$('html,body').animate({scrollTop: $("#banner_erro").offset().top - 200},'slow');
	return false;
}
else{
	$('#banner_erro').html('');
}

if(fac_banner!=''){
	var image_size=parseFloat($("#input-file-banner")[0].files[0].size / 1024).toFixed(2);

	if(image_size>500){
		$('#banner_erro').html('Please attach image below 500 kb');
		return false;
	}
	else{
		$('#banner_erro').html('');
	}
	if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
		$('#banner_erro').html('Please attach image in png , jpg or jpeg format only');			
		return false; 
	}
	else{
		$('#banner_erro').html('');
	}
}




if(fac_city == ''){
	$('#facilitycity').show();
	$('#errFacilitycity').html('Please enter city');
	$('html,body').animate({scrollTop: $("#errFacilitycity").offset().top - 200},'slow');
	return false;
}else{
	$('#errFacilitycity').html(''); 
}

if(fac_area == ''){
	$('#facilityarea').show();
	$('#errFacilityrea').html('Please enter area');
	$('html,body').animate({scrollTop: $("#errFacilityrea").offset().top - 200},'slow');
	return false;
}else{
	$('#errFacilityrea').html(''); 
}


if(fac_pincode == ''){
	$('#facilitypincode').focus();
	$('#errFacilitypincode').html('Please enter pincode');
	$('html,body').animate({scrollTop: $("#errFacilitypincode").offset().top - 240},'slow');
	return false;
}
else{
	$('#errFacilitypincode').html('');
}

if(validPincode!=6){
	$('#facilitypincode').focus();
	$('#errFacilitypincode').html('Please enter correct pincode');
	$('html,body').animate({scrollTop: $("#errFacilitypincode").offset().top - 240},'slow');
	return false;
}else{
	$('#errFacilitypincode').html('');
//showingLoader();
}

if($("#achievementcheckbox").prop("checked") == true){

	if(selectOfferTitle == null){
		$('#selectOfferTitle').focus();
		$('#errFacilityachivement').html('Please select achievement type');
		$('html,body').animate({scrollTop: $("#errFacilityachivement").offset().top - 240},'slow');
		return false;
	}
	else{
		$('#errFacilityachivement').html('');
	}
	if(facilityname == ''){
		$('#facilityname').focus();
		$('#errFacilityname').html('Please enter achievement title');
		$('html,body').animate({scrollTop: $("#errFacilityname").offset().top - 240},'slow');
		return false;
	}
	else{
		$('#errFacilityname').html('');
	}









}
/* else{
showingLoader();
} */


var form = $('#step_2_form')[0];
var myFormData = new FormData(form);
//myFormData.append('admin_profile', $('#input-file-now')[0].files[0]);
//myFormData.append('tax_file', $('input[type=file]')[0].files[0]); 
//myFormData.append('action', 'fac_step_2');
$.ajax({
	url:'<?php echo base_url();?>dashboard/add_facility',
	type: 'POST',
	data: myFormData,
	cache: false,
	processData: false,
	contentType: false,
	async: false,
	success:function(res){

		if(res!='failed'){
			swal({
				title : fac_name+ ' added successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					window.location.href = '<?php echo base_url('dashboard') ?>';
				}
			})

		}
		else{
			$('#error_msg').show(); 
			$('#error_msg').text("Network issue"); 
		}				    
//	hiddingLoader();
}	
});  

});


$(document).on("click", '.selectall input', function() {
	if($(".list-inline-item.checked").length > 0){
		var rrr =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().next().find("input").val();
		var iii =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().find("input").val();

		$("#shopTiming .list-inline-item.checked").find('.checkbox-decorator').trigger("click");  $("#shopTiming .list-inline-item").each(function(){
			jQuery(this).find(".day").parent(".col-md-3").next().find("input").val(iii);
			jQuery(this).find(".day").parent(".col-md-3").next().next().find("input.closing").val(rrr);

			$(this).find('.checkbox-decorator').trigger("click");	
		});	

	}

	else{
		$("#shopTiming .list-inline-item").each(function(){
			jQuery(this).find(".day").parent(".col-md-3").next().find("input").val('7:00 AM');
			jQuery(this).find(".day").parent(".col-md-3").next().next().find("input.closing").val('9:00 PM');

			$(this).find('.checkbox-decorator').trigger("click");	
		});}	


	});

$("#shopTiming .list-inline-item input").on("click", function(){if($(".list-inline-item.checked").length < 7){$(".selectall input").prop("checked", false)}});

$(document)
.on('click', '.td-overlay, .td-clock, .td-select', function() {

	jQuery(".list-inline-item").each(function(){
		var abc = jQuery(this).find(".day").parent(".col-md-3").next().find("input").val();
		var cdf = jQuery('.list-inline-item.checked').find(".day").parent(".col-md-3").next().find("input").val();
		var mmm = jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val();
		var rrr = jQuery('.list-inline-item.checked').find(".day").parent(".col-md-3").next().next().find("input").val();

		if(abc != cdf || mmm != rrr){$(".selectall input").prop("checked", false);}

	})
});		



setTimeout(function(){
	$("#defaulttimingcontainer").removeClass("is-filled");
},100);			
</script>


<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

<script>

function initMap() {
// Create the autocomplete object, restricting the search to geographical
// location types.
autocomplete1 = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */
(document.getElementById('facilitycity')),
{types: ['geocode']});

autocomplete1.addListener('place_changed', function() {
//infowindow.close();
var place = autocomplete1.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});

}

var addressInputElement = $('#facilitycity');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
});

</script>	

</body>

</html>