<!DOCTYPE html>
<html>

<head>
    <title>Social Sportz</title>
    <?php $this->load->view('public/common/head');?>
    <style>
    .modal-backdrop{opacity: 0.6 !important}
    header{
        background: #000;
    }

    .addresfont
    {
        color:#000;
    }

    .calanderpopover {
    cursor: pointer;
    border: 1px solid #a79c9c;
    padding: 3px 18px;
    border-radius: 4px;
    font-size: 12px;
}

    .popover
    {
        margin-top: -80px;
    }
    
    body{
        background:#fff !important;
    }
    
    .search-area:before{
        content: '';
        width:100%;
        height:109px;
        background:rgba(255,255,255,0.4);
        left:0px;
        top:0px;
        position:absolute;
    }
    
    .search-wrapper{
        margin-top: 230px;
    }

    .search-area {
        position: fixed !important;
        margin-bottom: 30px;
        top: 105px;
        height: 105px;
        z-index: 9999999;
        box-shadow: 3px 3px 4px #b8b8b8;
        background:#fff !important;
        
    }
	
	.search-wrapper{
		/* height: 700px; */
		overflow-x: auto;
		overflow-x: hidden;
	}
	
</style>

</head>

<body id="searchfacilityacademy">
    <?php $this->load->view('public/common/headeruser');?>
    <!-- // Banner starts Here // -->
    <div class="clearfix"></div>
    <div id="gorupedfilter">
        <div class="container">
		<center><span id="err_filter" style="color:red;"></span></center>
            <div class="row">
                <div class="col-sm-12 text-right">
                   <!--  <a href="<?=base_url('searchlisting');?>"><button class="btn border-btn" id="clearbtn">Clear Filters</button></a> -->
                    <button class="btn orange-btn" id="applyfilter">Apply Filters</button>
                </div>
				
                <div class="col-sm-1 m10 nopadleft">
                    <label class="searchheading">Sports</label>
                </div>
                <div class="col-sm-11 m10">
                    <ul class="searchsportsname">
				<?php if(isset($sport_list) && !empty($sport_list)) {
					foreach ($sport_list as $sports) { ?>
                        <li class="sportsname">
                            <label class="radio-inline btn btn-default <?php if($sports->sport_id==@$sport_id){ echo 'activegame';} ?>">
					<input type="radio" name="f_sport" value="<?=$sports->sport_id;?>" <?php if($sports->sport_id==@$sport_id){ echo 'checked';} ?>>
								<span class="bmd-radio"></span>
									<?php echo ucwords($sports->sport_name); ?>
                                <div class="ripple-container"></div>
                            </label>
                        </li>
				<?php } } ?>
                    </ul>
                </div>
				
							<div class="col-md-1 bmd-form-group is-filled" style="margin-top: -8px; margin-left: 15px;">
								<label class="bmd-label-floating"><strong>Location</strong></label>
							</div>
								<div class="col-md-3">
									<div class="bmd-form-group" style="margin-top: -30px;">
										<input type="text" class="fog" id="usercity" name="usercity" value="<?php if(!empty($this->session->userdata('usercity'))){ echo $this->session->userdata('usercity'); } ?>">
										<span id="errAddress2" class="error"> </span>
										<input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php if(!empty($this->session->userdata('fac_latitude'))){ echo $this->session->userdata('fac_latitude'); } ?>">
										<input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php if(!empty($this->session->userdata('fac_longitude'))){ echo $this->session->userdata('fac_longitude'); } ?>">
										<input type="hidden" class="form-control" id="type" name="type" value="<?php if(!empty($this->session->userdata('type'))){ echo $this->session->userdata('type'); } ?>">
									</div>
								</div>
				
                <div class="col-sm-12 m10"></div>
				
                <div class="col-md-12 nopadleft nopadright">
                    <hr>
                    <label class="searchheading">Amenities</label>
                </div>
                <div class="ui four column doubling  grid" style="margin-top:0px;">
			<?php if(!empty($amenity_list)) {
					foreach ($amenity_list as $amenity) { ?>
                    <div class="column">
                        <div class="ui large label amenity">
                            <input class="checkbox amenities" type="checkbox" name="amenities"  value="<?=$amenity->amenity_id;?>">
                            <img class="ui right spaced image" src="<?=base_url();?>assets/public/images/amenity/<?=$amenity->amenity_icon;?>"><span><?=$amenity->amenity_name;?></span>
                        </div>
                    </div>
			<?php } } ?>		
			
                </div>
            </div>
        </div>
    </div>
    <div class="darkoverlay"></div>
    <section class="search-wrapper">
        <div class="header-data bottomgap30">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-head-nav clearfix">
                            <div class="page-title float-md-left">
                                <h2>Search</h2>
                            </div>
                            <div class="navigation-bread float-md-right">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3><span id="total_count"> <?php if(isset($event_data_count)) { echo $event_data_count; } ?></span> best Event found near you</h3>
                </div>
                <div class="col-sm-4 text-right">Filters<i class="fa fa-bars togglefilter"></i>
                </div>
			</div>
			<div class="searchfilterwrapper">
				<div class="row">
				  <div class="col-sm-6">
				  <?php
					$sport_id='';
					if(!empty($this->session->userdata('sport_id'))){
						$sport_id=$this->session->userdata('sport_id');
					} ?>
					  <strong> <?php if(isset($type))echo ucwords($type); ?></strong> (<strong>Sport:</strong> <span id="sport_name"><?php if(isset($sport_name))echo ucwords($sport_name); ?></span>)
				  </div>                           
				 <div class="col-sm-6 text-right">
					<i class="fa fa-map-marker"></i> <?php if(!empty($this->session->userdata('usercity'))){ echo $this->session->userdata('usercity'); } ?>
				 </div>               
				</div>
			</div>
                 
			<div class="row">
                <div class="col-sm-12">
                    <div class="row" id="ajax_event_list">
					<?php 
					if(!empty($event_data)) { 
						foreach($event_data as $eventVal){ ?>
                        <div class="col-sm-4">
							
                            <a href="<?=base_url('searchlisting/event_detail/'.$eventVal->event_slug);?>">
                                <img src="<?=base_url('assets/public/images/event/banner/'.$eventVal->event_banner);?>" alt="">
                            </a>
                            <div class="item-wrapper">
                              <span class="heading">
                                <a href="<?=base_url('searchlisting/event_detail/'.$eventVal->event_slug);?>"><?php echo $eventVal->event_name; ?></a>
                            </span>
							<span class="heading nomargin"><?php echo $eventVal->fac_name; ?></span>
                            <div class="row">
                                <div class="text-left col-sm-12">
									<strong> <i class="fa fa-calendar" aria-hidden="true"></i> Event Date :</strong> <span><?php echo $eventVal->event_start_date; ?> <strong>to</strong> <?php echo $eventVal->event_end_date; ?></span>
								</div> 
								<div class="text-left col-sm-12">
									<i class="fa fa-clock-o" aria-hidden="true"></i> <strong>Timings :</strong> <span  data-original-title="" title=""> <?php echo $eventVal->event_start_time; ?> <strong>to</strong> <?php echo $eventVal->event_end_time; ?></span>
								</div>
							</div>
                                <div class="row">
                                    <div class="text-left col-sm-12 addresfont">    <i class="fa fa-map-marker"></i> <?php echo $eventVal->event_city; ?></div>
                                    
                                    <div class="col-sm-12 kiticon"> <strong> Amenities:</strong>
                                    </div>
                                    <div class="flex sports-div-margin-top sportshomeicon col-sm-12">
									<?php 
									$i=0;
									$count =0;
									foreach ($eventVal->amenities as $amenities) {
									if($i<4){  ?>
                                        <div class="sport-icon-div">
                                            <img alt="sports icon" class="sportsimgicon1" title="<?=$amenities->amenity_name;?>" src="<?=base_url();?>assets/public/images/amenity/<?=$amenities->amenity_icon;?>">
                                        </div>
								<?php $count++;} $i++; } 
										$remain_sports =  $i-($count);
										if($remain_sports>0){ ?>
										<span class="morenew">+ <?php echo $remain_sports; ?></span>
									<?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center col-sm-12">
										<form method="post" action="<?php echo base_url('booking/event_checkout'); ?>">
											<input type="hidden" name="book_event_id" value="<?php echo $eventVal->event_id; ?>" >
											<button type="submit" class="readmore-blog orange-btn btn-block" >Book Now</button>
										</form>
									</div>
                                </div>
                            </div>
                        </div>
					<?php } }else{ echo "<center><b>No data available</b></center>"; } ?>	
					
                    </div>
                </div>
            </div>
        </div>
    </section>
	<div class="loader">
		<div class="">
			<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
		</div>
	</div>
    <?php $this->load->view('public/common/footer');?>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <iframe width="100%" height="300" src="https://www.youtube.com/embed/qR97wZCcNGM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('public/common/foot');?>
</body>
<script src="<?=base_url('assets/admin/js/datedropper.min.js');?>"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>
<script>

// this function use for auto fill location here Start*********************
	function initMap() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		autocomplete1 = new google.maps.places.Autocomplete(
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
//**************** End *********************
	
	
	/* ******** apply filters here ************ */
	//  showingLoader();
	//  hiddingLoader();
	$(document).ready(function() {
		$('#applyfilter').click(function() {
			 event.preventDefault();
			 var error=0;
			 var f_sport = ''; var amenities_ids = ''; var amenities = [];
			 var latitude = $('#latitude').val();
			 var longitude = $('#longitude').val();
			 var fac_type = $('#type').val();
			 f_sport = $("input[name='f_sport']:checked").val();
				$.each($("input[name='amenities']:checked"), function(){
					amenities.push($(this).val());
				});
			 amenities_ids = amenities.toString();
			//alert(rating); return false;
			if(error==0){
				jQuery(".darkoverlay, #applyfilter").on("click", function(){jQuery("#gorupedfilter").slideUp(); jQuery(".darkoverlay").hide(); });			
				showingLoader();	
				$.ajax({
					type: 'POST',
					url: '<?=base_url();?>searchlisting/apply_event_filter',
					data:{latitude:latitude,longitude:longitude,f_sport:f_sport,fac_type:fac_type,amenities_ids:amenities_ids},
					success:function(res){ 
						hiddingLoader();
						$("#ajax_event_list").html(res['_html']);
					}
				});
			}
		});
	});
	
	// for pagination here ----
	/*
	var page = 0;
	last_page = false;
	$('.search-wrapper').scroll(function() {
		if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
			page++;
			var total_count = parseInt($('#total_count').text());
			alert(total_count+'page_scroll'+page);
			var scrollRows= page*20;
			if(total_count>scrollRows){
				//loadMoreData(page);
			}
		}
	}); 
	*/
	
    jQuery('header').removeClass("blackbg");
		$(window).scroll(function() {
		if ($(this).scrollTop() > 100) { // this refers to window
			jQuery('header').addClass("blackbg");
		}
		else
		{
			jQuery('header').removeClass("blackbg");
		}
	});

    jQuery(".togglefilter").on("click", function(){jQuery("#gorupedfilter").slideToggle(); jQuery(".darkoverlay").toggle(); });
    jQuery(".darkoverlay, #applyfilter").on("click", function(){jQuery("#gorupedfilter").slideUp(); jQuery(".darkoverlay").hide(); });
    jQuery(".searchsportsname li").on("click", function(){jQuery('.sportsname').find("input").attr("checked", false); jQuery(this).find("input").attr("checked", "checked"); jQuery('.sportsname').find("label").removeClass("activegame"); jQuery(this).find("label").addClass("activegame")});
    $('#Datesearch').dateDropper();
</script>
<script>

    jQuery("#clearbtn").on("click", function(){
        $(".searchsportsname").find("input").attr("checked", false);
        $("input").val("");
        $("input:checked").prop("checked", false);
        $(".searchsportsname").find("label").removeClass("activegame");
        $("#gorupedfilter").find("input[type='checkbox']").attr("checked", false);
        $('input[type=checkbox]').removeAttr('checked'); 
	});
	
	$(document).on("click", ".favourite .fa", function(){ 
		$(".favourite .fa").show(); 
		$(this).hide(); 
		if($('.fa-heart').is(':visible')) { 
			//console.log('df'); 
		} 
	});

	

	/******* Used for pagination after scroll the event list page ********************* */	
		var total_record = parseInt($('#total_count').text());
		var page_count=1;
		$(window).on('scroll', function() { 
            if ($(window).scrollTop() + $(window).height() == $(document).height()) { 
				var total_page = Math.ceil(total_record/12);
				if(total_page > page_count){
					var start_limit = page_count*12;
					page_count = page_count+1;
					var f_sport = ''; var amenities_ids = ''; var amenities = [];
					var latitude = $('#latitude').val();
					var longitude = $('#longitude').val();
					var fac_type = $('#type').val();
					f_sport = $("input[name='f_sport']:checked").val();
						$.each($("input[name='amenities']:checked"), function(){
							amenities.push($(this).val());
						});
					amenities_ids = amenities.toString();
					showingLoader();	
					$.ajax({
						type: 'POST',
						url: '<?=base_url();?>searchlisting/apply_event_filter',
						data:{latitude:latitude,longitude:longitude,f_sport:f_sport,fac_type:fac_type,amenities_ids:amenities_ids,start_limit:start_limit},
						success:function(res){ 
							hiddingLoader();
							$("#ajax_event_list").append(res['_html']);
						}
					});
				}
            } 
        });

    </script>

    </html>