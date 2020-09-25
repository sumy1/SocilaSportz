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
	.search-area form i.fa-caret-down {top: 9px !important;}
	#searchForm .form-group i.fa{top:17px;}
	.nav-tabs a {font-size: 14px;}
	a.wobble-top.black{font-size: 14px}
	.sportsimgicon{left:5px !important;}
	#searchForm #usercity{background: #fff;}

	#searchForm #usercity {
    background: #fff;
    padding: 4px 20px 4px 20px;
}

.search-area span.error {font-size: 13px !important;}
#err_sport_name{margin-left: 0px}

#searchForm .form-group i.fa-map-marker{
	    left: 35px !important;
}

.pac-container {
    z-index: 9999999 !important;
    top: 28px !important;
    left: 24px !important;
}
</style>
</head>

<body>
	<?php $this->load->view('public/common/header');?>
	<!-- // Banner starts Here // -->
	<div class="clearfix"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="owl-carousel owl-theme" id="slider-banner">
				<?php if (isset($banner) && !empty($banner)) { foreach ($banner as $data) { ?>
				<div class="item">
					<img src="<?=base_url('assets/admin/images/home/'.$data->banner_image);?>" alt="<?=$data->banner_image?>">
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<?php if (isset($sports) && !empty($sports)) { foreach ($sports as $sport) { //print_r($data); ?>
			<div class="column dt-sc-one-sixth  no-space first animated wow fadeInLeft">
				<div class="dt-sc-ico-content  type9 ">
					<div class="icon-holder ">
						<img alt="overlay" alt="" src="<?=base_url('assets/admin/images/home/'.$sport->sport_image);?>">
						<div class="dt-sc-icon-overlay select_sport">
							<input class="select_sport_id" type="hidden" value="<?php echo $sport->sport_id; ?>">
							<img  alt="" src="<?=base_url('assets/admin/images/home/'.$sport->icon_image);?>">
							<h4><a href="JavaScript:Void(0)" ><?=$sport->sport_names[0]->sport_name;?> </a></h4>
						</div>
					</div>
				</div>
			</div>
			<?php } } ?>
		</div>
	</div>
	<div class="container search-area">	<span class="headingnew">Find the best sports venue near you.</span>
		<form name="searchForm" id="searchForm" method="post" action="<?php echo base_url('searchlisting'); ?>" class="form-search">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6 nopadright">
					<div class="form-group" style="margin-top: 5px;">	<i class="fa fa-map-marker" aria-hidden="true"></i>
						<input type="text" class="google_address form-control" id="usercity" name="usercity">
						<span id="err_usercity" class="error" style="color:red"></span>
						<input type="hidden" class="form-control" id="latitude" name="latitude">
						<input type="hidden" class="form-control" id="longitude" name="longitude">	
						
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 nopadright">
					<div class="form-group" style="margin-top: 5px;">
						<img alt="sports icon" class="sportsimgicon" src="<?=base_url('assets/public/images/archery.png');?>">
						<select class="form-control city_name" id="sport_name" name="sport_name" title="Sport Name">
							<option value="">Select Sports</option>
							<?php if (isset($sport_list) && !empty($sport_list)) {
								foreach ($sport_list as $sports) { ?>
								<option value="<?=$sports->sport_id;?>"><?=$sports->sport_name?></option>
								<?php 	} } ?>
							</select>	
							<i class="fa fa-caret-down"></i>
							<span id="err_sport_name" class="error" style="color:red"></span>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6 nopadright">
						<div class="form-group" style="margin-top: 5px;">	<i class="fa fa-university" aria-hidden="true"></i>
							<select class="form-control city_name" id="type" name="type">
								<option value="facility">Facilities</option>
								<option value="academy">Academy</option>
								<option value="event">Events</option>
							</select>
							<i class="fa fa-caret-down"></i>
							<span id="err_type" class="error" style="color:red"></span>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12 padding0">
						<div class="form-group">
							<div class="search-area1">	
								<button type="submit" class="btn btn-primary btn-block search_tab clr submit_btn"  onClick="return validateSearch()"  id="butner">Search</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<section id="popular-categories">
			<div class="container popular">
				<div class="border-title aligncenter">
					<h1>POPULAR CATEGORIES</h1>
				</div>
				<div class="row">
					<?php if (isset($popular_cat) && !empty($popular_cat)) { foreach ($popular_cat as $pc) { ?>
					<div class="item-service flex-wrapper align_items-center col-md-4  ">
						<div class="service-icon">	<a href="<?=base_url($pc->popular_url);?>">
							<img alt="" class="normal" src="<?=base_url('assets/admin/images/home/'.$pc->popular_icon);?>">
							<img alt="" class="hover" src="<?=base_url('assets/admin/images/home/'.$pc->popular_hover_icon);?>">
						</a>
					</div>
					<div class="service-info">
						<h3 class="title18 font-bold text-uppercase"><a  class="wobble-top black" href="<?=base_url($pc->popular_url);?>"><?=$pc->popular_title;?></a></h3>
						<p class="desc silver">
							<?=$pc->popular_text;?></p>
						</div>
					</div>
					<?php } } ?>
				</div>
			</div>
		</section>
		<section id="featured-venue">
			<h3 class="text-center">featured venues</h3>
			<div class="container">
				<div class="row">
					<p>A National venue with world class facilities, the Ageas Bowl Provide the perfect environment for athletes and ambitious individuals looking to develop. For Youngsters the opportunity to train beside social sports people ad learn from highly experienced coaches is invaluable. We at social Sportz aim to help athletes and sports persons achieve more by recognizing and celebrating their success with them. We believe that key to success is providing continuous supports and guidance and we at social sports want to be a part of every athletes journey.</p>
					<div class="bg-dark dark-home">
						<div class="row">
							<div class="col-md-6 col-lg-9 facility-wrapper nopadright">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="pill" href="#home">FACILITY</a></li>
									<li><a data-toggle="pill" href="#menu2">ACADEMY</a></li>
									<li><a data-toggle="pill" href="#menu3">EVENTS</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="home" class="tab-pane fade in active">
										<div class="owl-carousel owl-theme" id="facility-section">
											<?php if (isset($facility_data) && !empty($facility_data)) {
												foreach ($facility_data as $faclist) {  ?>



												<div class="item">
													<a href="<?=base_url('searchlisting/search_detail/'.$faclist->fac_slug);?>"><img alt="" src="<?=base_url('assets/public/images/fac/'.$faclist->fac_banner_image);?>"></a>
													<?php if($faclist->rating_count>0){?>
													<div class="venue-rating-div">
														<div>
															<div class="venue-list-rating"><i class="fa fa-star"></i> <?=$faclist->avg_rating;?></div>
														</div>
														<div class="venue-list-votes"><?=$faclist->rating_count;?> Votes</div>
													</div>
													<?php } ?>
													<div class="content-box">	<a href="<?=base_url('searchlisting/search_detail/'.$faclist->fac_slug);?>"><h2><?=$faclist->fac_name;?></h2></a>
														<div class="row">
															<div class="text-left col-sm-12 timinghomeslider">	<strong>Opening Days :</strong>  <span class="calanderpopover<?=$faclist->fac_id;?>" data-original-title="" title=""><i class="fa fa-clock-o" aria-hidden="true"></i> <?=$faclist->timing[0]->open_time.' to '.$faclist->timing[0]->close_time;?></span>
															</div>
															<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> <?=$faclist->fac_google_address;?></div>
															<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
																<?php 
																$i=0;
																$count =0;
																foreach ($faclist->sport as $sports) {

																	if($i<4){  ?>
																	<div class="sport-icon-div fac_sport">
																		<img alt="sports icon" class="sportsimgicon1" src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon);?>">
																	</div>
																	<?php $count++;} $i++; } 
																	$remain_sports =  $i-($count); ?>
																</div>
															</div>
														</div>
													</div>

													<?php }  } else{
														echo "No data available";
													} ?>

												</div>
											</div>



											<div id="menu2" class="tab-pane fade">
												<div class="owl-carousel owl-theme" id="academy-section">
													<?php if (isset($academy_data) && !empty($academy_data)) {
														foreach ($academy_data as $faclist) {  ?>



														<div class="item">
															<a href="<?=base_url('searchlisting/search_detail/'.$faclist->fac_slug);?>"><img alt="" src="<?=base_url('assets/public/images/fac/'.$faclist->fac_banner_image);?>"></a>
															<?php if($faclist->rating_count>0){?>
															<div class="venue-rating-div">
																<div>
																	<div class="venue-list-rating"><i class="fa fa-star"></i> <?=$faclist->avg_rating;?></div>
																</div>
																<div class="venue-list-votes"><?=$faclist->rating_count;?> Votes</div>
															</div>
															<?php } ?>
															<div class="content-box">	<a href="<?=base_url('searchlisting/search_detail/'.$faclist->fac_slug);?>"><h2><?=$faclist->fac_name;?></h2></a>
																<div class="row">
																	<div class="text-left col-sm-12 timinghomeslider">	<strong>Opening Days :</strong>  <span class="calanderpopover<?=$faclist->fac_id;?>" data-original-title="" title=""><i class="fa fa-clock-o" aria-hidden="true"></i> <?=$faclist->timing[0]->open_time.' to '.$faclist->timing[0]->close_time;?></span>
																	</div>
																	<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> <?=$faclist->fac_google_address;?></div>
																	<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
																		<?php 
																		$i=0;
																		$count =0;
																		foreach ($faclist->sport as $sports) {

																			if($i<4){  ?>
																			<div class="sport-icon-div fac_sport">
																				<img alt="sports icon" class="sportsimgicon1" src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon);?>">
																			</div>
																			<?php $count++;} $i++; } 
																			$remain_sports =  $i-($count); ?>

																		</div>
																	</div>
																</div>
															</div>

															<?php }  } else{
																echo "No data available";
															} ?>

														</div>
													</div>

													<div id="menu3" class="tab-pane fade">
														<div class="owl-carousel owl-theme" id="event-section">
															<?php if (isset($event_data) && !empty($event_data)) {
																foreach ($event_data as $eventlist) {  ?>
																<div class="item">
																	<a href="<?=base_url('searchlisting/event_detail/'.$eventlist->event_slug);?>"><img alt="" src="<?=base_url('assets/public/images/event/banner/'.$eventlist->event_banner);?>"></a>

																	<div class="content-box">
																		<a href="<?=base_url('searchlisting/event_detail/'.$eventlist->event_slug);?>"><h2><?=$eventlist->event_name;?></h2></a>
																		<span class="heading nomargin"><?=$eventlist->fac_name->fac_name;?></span>
																		<div class="row blacktext">
																			<div class="text-left col-sm-12">
																				<strong> <i class="fa fa-calendar" aria-hidden="true"></i> Event Date :</strong> <span><?=date('d-m-Y',strtotime($eventlist->event_start_date));?> <strong>to</strong> <?=date('d-m-Y',strtotime($eventlist->event_end_date));?></span>
																			</div>

																			<div class="text-left col-sm-12">
																				<strong> <i class="fa fa-calendar" aria-hidden="true"></i> Enroll. Date :</strong> <span> <?=date('d-m-Y',strtotime($eventlist->application_start_date));?></span> <strong>to</strong> <span> <?=date('d-m-Y',strtotime($eventlist->application_end_date));?></span>
																			</div>
																			<div class="text-left col-sm-12">
																				<strong>Timings :</strong> <span class="calanderpopover" data-original-title="" title=""><i class="fa fa-clock-o" aria-hidden="true"></i> <?=$eventlist->event_start_time.' to '.$eventlist->event_start_time ?></span>
																			</div>
																			<div class="text-left col-sm-12">
																				<?=$eventlist->event_venue.','.$eventlist->event_city; ?>

																			</div>
																		</div>
																	</div>
																</div>

																<?php } }?>

															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-lg-3 whitebg">
													<div class="youtubelinks">
														<h3>Youtube Channel</h3>
														<?php if (isset($youtube_data) && !empty($youtube_data)) { foreach ($youtube_data as $data) { //print_r($data); ?>
														<div class="item">
															<div class="row">
																<div class="col-5  nopadright">
																	<a data-toggle="modal" data-target="#myModal<?=$data->youtube_id;?>">	<i class="fa fa-play" aria-hidden="true"></i>
																		<img alt="" src="https://img.youtube.com/vi/<?=$data->youtube_link;?>/0.jpg">
																	</a>
																</div>
																<div class="col-7">
																	<h2><?=$data->youtube_title;?></h2>
																	<p>
																		<?=$data->youtube_text;?></p>
																	</div>
																</div>
															</div>
															<?php } } ?>
														</div>
														<div class="link-video"><a href="#">VIEW ALL LINKS PAGE</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<section id="logoslider-wrapper">
								<div class="container">
									<div class="border-title aligncenter">
										<h2>OUR PARTNERS</h2>
									</div>
									<div class="row">
										<div class="owl-carousel owl-theme" id="clientlogo">
											<?php if (isset($client_data) && !empty($client_data)) { foreach ($client_data as $data) { //print_data($data); ?>
											<div class="item">
												<img src="<?=base_url('assets/admin/images/home/'.$data->client_logo);?>" alt="<?=$data->client_title;?>">
											</div>
											<?php } } ?>
										</div>
									</div>
								</div>
							</section>	<a id="back2Top" title="Back to top" href="#"><i class="fa fa-angle-up"></i></a>
							<?php $this->load->view('public/common/footer');?>
							<?php $this->load->view('public/common/foot');?>
							<?php if (isset($youtube_data) && !empty($youtube_data)) { foreach ($youtube_data as $data) {  ?>
							<div class="modal fade" id="myModal<?=$data->youtube_id;?>">" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div style="border-bottom: none" class="modal-header"></div>
										<div class="modal-body">
											<iframe width="100%" height="300" src="https://www.youtube.com/embed/<?=$data->youtube_link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										</div>
									</div>
								</div>
							</div>
							<?php } }  ?>
							<?php
							foreach ($facility_data as $faclist) { ?>

							<script>
								var fac_id = '<?=$faclist->fac_id;?>';
								$('.calanderpopover'+fac_id).popover({		
									content: '<div class="table-responsive"><table class="table table-sm timimg-table"><tbody><?php foreach ($faclist->timing as $timings) { ?><tr><td><strong><?=$timings->day; ?></strong></td><td><?=$timings->open_time.' - '.$timings->close_time;?></td></tr> <?php } ?></tbody></table></div>', 
									html: true, 
									placement: "bottom",
									trigger: "hover"

								});
							</script>
							<?php }

							foreach ($academy_data as $faclist) { ?>

							<script>
								var fac_id = '<?=$faclist->fac_id;?>';
								$('.calanderpopover'+fac_id).popover({		
									content: '<div class="table-responsive"><table class="table table-sm timimg-table"><tbody><?php foreach ($faclist->timing as $timings) { ?><tr><td><strong><?=$timings->day; ?></strong></td><td><?=$timings->open_time.' - '.$timings->close_time;?></td></tr> <?php } ?></tbody></table></div>', 
									html: true, 
									placement: "bottom",
									trigger: "hover"

								});
							</script>
							<?php } ?>


							<!-- Google location -->


<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

<script>

	/* search sport venue here */
	function validateSearch(){
		var latitude = $('#latitude').val();	
		var longitude = $('#longitude').val();	
		var usercity = $('#usercity').val();		
		var sport_name = $('#sport_name :selected').val();				
		var type = $('#type :selected').val();				
		if(usercity == ''){
			$('#err_usercity').html('Please enter your location');
			return false;
		}else{
			$('#err_usercity').html(''); 
		}
		if(sport_name == ''){
			$('#err_sport_name').html('Please select any sports');
			return false;
		}else{
			$('#err_sport_name').html(''); 
		}
	}
	
	// set sport id into search form and after submit event fire
	$('.select_sport').click(function() {
		var select_sport_id = $(this).find('.select_sport_id').val();
		$('#sport_name').val(select_sport_id);
		//alert(select_sport_id); //return false;
		document.getElementById('searchForm').submit();				
	})
	
	

function initMap() {
// Create the autocomplete object, restricting the search to geographical
// location types.
autocomplete1 = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */
(document.getElementById('usercity')),
{types: ['geocode']});

autocomplete1.addListener('place_changed', function() {
//infowindow.close();
var place = autocomplete1.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});

}


	var addressInputElement = $('#usercity');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
})


var x = $('#usercity').val();

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    var latlng = new google.maps.LatLng(lat, lng);
    var geocoder = geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
             
                $('#usercity').val(results[1].formatted_address);
            }
        }
    });
}

getLocation();
$(".item-service").each(function(){var mgh = $(this).find("a").attr("href"); if(mgh == "https://vibestest.com/wip_projects/development/socialsportz-dev/"){$(this).find("a").css("cursor","default"); $(this).find("a").attr("href","JavaScript:Void(0);")}});

</script>
</body>

</html>