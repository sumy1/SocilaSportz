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
	
	/*.search-wrapper{
		height: 700px;
		overflow-x: auto;
		overflow-x: hidden;
	}*/
	
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
                    <!-- <button class="btn border-btn" id="clearbtn">Clear Filters</button> -->
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
                            <label class="radio-inline btn btn-default  <?php if($sports->sport_id==@$sport_id){ echo 'activegame';} ?>">
					<input type="radio" name="f_sport" value="<?=$sports->sport_id;?>" <?php if($sports->sport_id==@$sport_id){ echo 'checked';} ?>>
								<span class="bmd-radio"></span>
									<?php echo ucwords($sports->sport_name); ?>
                                <div class="ripple-container"></div>
                            </label>
                        </li>
				<?php } } ?>
                    </ul>
                </div>
				
							<div class="col-md-1 bmd-form-group is-filled samegap1" style="margin-top: -8px; margin-left: 15px;">
								<label class="bmd-label-floating"><strong>Location</strong></label>
							</div>
								<div class="col-md-3 ">
									<div class="bmd-form-group" style="margin-top: -30px;">
										<input type="text" class="fog" id="usercity" name="usercity" value="<?php if(!empty($this->session->userdata('usercity'))){ echo $this->session->userdata('usercity'); } ?>">
										<span id="errAddress2" class="error"> </span>
										<input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php if(!empty($this->session->userdata('fac_latitude'))){ echo $this->session->userdata('fac_latitude'); } ?>">
										<input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php if(!empty($this->session->userdata('fac_longitude'))){ echo $this->session->userdata('fac_longitude'); } ?>">
										<input type="hidden" class="form-control" id="type" name="type" value="<?php if(!empty($this->session->userdata('type'))){ echo $this->session->userdata('type'); } ?>">
									</div>
								</div>

									<div class="col-md-2 bmd-form-group is-filled text-right samegap2" style="margin-top: -8px; margin-left: 15px;">
										<label for="gender" class="bmd-label-floating"><strong>Filter by rating</strong></label>
										</div>

									<div class="col-md-3">
	                                    <div class="form-group bmd-form-group is-filled minusgap30" style="margin-top:-7px; padding-top:0px !important">
	                                    <i style="right:15px" class="fa fa-caret-down"></i>   
	                                        <select name="rating" id="rating" style="border: 1px solid #c1c1c1 !important;">
												<option value="">--Select Rating--</option>
												<option value="5">5 stars</option>
												<option value="4">4 stars &amp; above</option>
												<option value="3">3 stars &amp; above</option>
												<option value="2">2 stars &amp; above</option>
												<option value="1">1 star &amp; above</option>
											</select>
	                                            <span id="errAcademySport" class="error"></span>    
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
                                <h2><?php if(isset($page_title)) echo $page_title; else echo "Search"; ?></h2>
                            </div>
                            <div class="navigation-bread float-md-right">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php if(isset($page_title)) echo $page_title; else echo "Search"; ?></li>
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
                    <h3><span id="total_count"> <?php if(!empty($fac_data)) { echo count($fac_data); } ?></span> results found</h3>
                </div>
                <div class="col-sm-4 text-right">Filters<i class="fa fa-bars togglefilter"></i>
                </div>
			</div>
			<div class="searchfilterwrapper">
				<div class="row">
				  <div class="col-sm-6">
				  <?php
					
					if(!empty($this->session->userdata('sport_id'))){
						$sport_id=$this->session->userdata('sport_id');
					} ?>
					  <strong> <?php if(isset($type))echo ucwords($type); ?></strong> <?php if(isset($sport_name)){?>(<strong>Sport:</strong> <span id="sport_name"><?php if(isset($sport_name))echo ucwords($sport_name); ?></span>)<?php } ?>
				  </div>                           
				 <div class="col-sm-6 text-right"><?php if(!empty($this->session->userdata('usercity'))){ ?>
					<i class="fa fa-map-marker"></i><span id="usercityspan"><?php echo $this->session->userdata('usercity');?></span> <?php } ?>
				 </div>               
				</div>
			</div>
                 
			<div class="row">
                <div class="col-sm-12">
                    <div class="row" id="ajax_facilities_list">
					<?php 
					if(!empty($fac_data)) { 
						foreach($fac_data as $facVal){ ?>
                        <div class="col-sm-4">
							
                            <a href="<?=base_url('searchlisting/search_detail/'.$facVal->fac_slug);?>">
                            	<?php if ($facVal->fac_banner_image!='' && file_exists(FCPATH .'assets/public/images/fac/'.$facVal->fac_banner_image)) { ?>
                                <img src="<?=base_url('assets/public/images/fac/'.$facVal->fac_banner_image);?>" alt="">
                                	 <?php } else{ ?>
                                	  <img src="<?=base_url('assets/public/images/Dummy_image.jpg');?>" alt="">
                                	 <?php } ?>
                                <?php if($facVal->avg_rating!=0){ ?>
                                <div class="venue-rating-div">
                                    <div>
                                        <div class="venue-list-rating"><i class="fa fa-star"></i> <?php echo $facVal->avg_rating; ?></div>
                                    </div>
                                    <div class="venue-list-votes"><?php echo $facVal->rating_count; ?> Review</div>
                                </div>
                                <?php } ?>
                            </a>
                            <div class="item-wrapper">
                              <span class="heading">
                                <a href="<?=base_url('searchlisting/search_detail/'.$facVal->fac_slug);?>"><?php echo $facVal->fac_name; ?></a>
                            </span>
                            <div class="row">
                                <div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>   <strong>Opening Timing :</strong>  <span class="calanderpopover calanderpopover<?=$facVal->fac_id;?>"> <?php echo @$facVal->timing[0]->open_time .' to '.@$facVal->timing[0]->close_time;?></span>
                                </div>  </div>
                                <div class="row">
                                    <div class="text-left col-sm-12 addresfont">    <i class="fa fa-map-marker"></i> <?php echo $facVal->fac_city; ?></div>
                                    
                                    <div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
                                    </div>
                                    <div class="flex sports-div-margin-top sportshomeicon col-sm-12">
									<?php 
									$i=0;
									$count =0;
									foreach ($facVal->sport as $sports) {
									if($i<4){  ?>
                                        <div class="sport-icon-div">
                                            <img alt="sports icon" class="sportsimgicon1" src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon);?>">
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
										<form method="post" action="<?php echo base_url('booking'); ?>">
											<input type="hidden" name="book_fac_id" value="<?php echo $facVal->fac_id; ?>" >
											<input type="hidden" name="book_sport_id" value="<?php if(isset($sport_id)){echo $sport_id;} ?>" >
											<input type="hidden" name="book_type" value="<?php if(isset($type)){echo $type;} ?>" >
											<?php if(!empty($this->session->userdata('sport_id'))){
												$slot_count =  $this->CommonMdl->fetchNumRows('tbl_facility_batch_slot',array('sport_id'=>$this->session->userdata('sport_id'),'fac_id'=>$facVal->fac_id,'end_date>='=>date('Y-m-d')),'');
											//echo $this->db->last_query();
											if($slot_count>0) { ?>
											<button type="submit" class="readmore-blog orange-btn btn-block" >Book Now</button>
											<?php }  } 
											 else { ?>
											<button type="submit" class="readmore-blog orange-btn btn-block" >Book Now</button>
											<?php } ?>
										</form>
									</div>
                                </div>
                            </div>
                        </div>
					<?php } }

					else{ ?>
<div class="nodata notavailable col-sm-12 text-center">No data available</div>
<?php }

	 ?>
					
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

	<?php ## for showing opning timing on mouse hover------
		foreach ($fac_data as $faclist) { ?>
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
	
	
	/* ******** search sport venue here ************ */
	/*function validateSearch(){
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
	*/
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
			 var usercity = $('#usercity').val();
			 var fac_type = $('#type').val();
			 var rating = $('#rating').val();
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
					url: '<?=base_url();?>searchlisting/apply_filter',
					data:{latitude:latitude,longitude:longitude,usercity:usercity,f_sport:f_sport,fac_type:fac_type,amenities_ids:amenities_ids,rating:rating},
					success:function(res){ 
						hiddingLoader();
						$("#ajax_facilities_list").html(res['_html']);
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

    </script>

    </html>