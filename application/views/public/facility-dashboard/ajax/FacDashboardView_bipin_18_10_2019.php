<style>
#slotbookingtime label.booked{pointer-events:none;}
.dashboardcalandarwrapper .date_data .day {
	font-size: 12px !important;
}

.dashboardcalandarwrapper .date_data.selected {
	border: 1px solid rgba(65,99,225,0.72) !important;
	background-color: rgba(65,99,225,0.72) !important;
}

.dashboardcalandarwrapper .date_data.selected .availableseat {
	color: #fff !important;
	font-size: 11px;
}

.dashboardcalandarwrapper .fa.fa-calendar{
	position: absolute;
	top: 10px;
	font-size: 11px;
	right: 3px;
}

.dashboardcalandarwrapper .date_data.selected:after {
	content: "\f058";
	font-family: "Font Awesome 5 Free";
	font-weight: 900;
	display: inline-block;
	position: absolute;
	left: 2px;
	color: #69f169;
	top: 0;
	font-size: 12px;
}

.dashboardcalandarwrapper .disablecalandar{
	width:100%;	
}

.dashboardcalandarwrapper .disablecalandar {
	position: absolute;
	height: 405px;
	transform: translateX(-50%);
	left: 50%;
	z-index: 99;
	bottom: 0 !important;
	top:inherit !important;
}

#currentmonth{
	margin-top:20px;
}

.total_slot_hidden, .booked_slot_hidden {display:none}
</style>

<!-- Main Services link Start Here -->
<div class="row">
	<div class="col-md-12">
		<div class="owl-carousel owl-theme" id="topItemsSlider">
			<div class="item">
				<a href="<?=base_url('facility/booking');?>">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/booking.png')?>" class="img-fluid" alt="">
						</div>
						<div class="stat-count1">
							<h2><?=$todays_booking_count;?></h2>
							<p class="stat-title">Today's Booking</p>
						</div>
						<div class="clearfix"></div>								
					</div>	
				</a>
			</div>


			<div class="item">
				<a href="<?=base_url('facility/booking');?>" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/trail.png')?>" class="img-fluid" alt="">
						</div>
						<div class="stat-count1">
							<h2><?=$todays_trial_booking_count;?></h2>	
							<p class="stat-title">Trial Booking</p>								
						</div>
						<div class="clearfix"></div>

					</div>	
				</a>
			</div>

			<div class="item">
				<a href="<?=base_url('facility/booking');?>" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/confirmed.png')?>" class="img-fluid" alt="">
						</div>
						<div class="stat-count1">
							<h2><?=$total_confirmed_booking_count;?></h2>	
							<p class="stat-title">Total Confirmed Booking</p>								
						</div>
						<div class="clearfix"></div>

					</div>	
				</a>
			</div>

			<div class="item">
				<a href="<?=base_url('facility/booking');?>" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/total_booking.png')?>" class="img-fluid" alt="">
						</div>
						<div class="stat-count1">
							<h2><?=$total_booking_count;?></h2>	
							<p class="stat-title">Total Booking</p>								
						</div>
						<div class="clearfix"></div>

					</div>	
				</a>
			</div>


			<div class="item">
				<a href="<?=base_url('facility/booking');?>" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/pending.png')?>" class="img-fluid" alt="">
						</div>
						<div class="stat-count1">
							<h2><?=$total_pending_booking_count;?></h2>	
							<p class="stat-title">Pending Booking</p>								
						</div>
						<div class="clearfix"></div>

					</div>	
				</a>
			</div>

		</div>
	</div>
</div>

<!-- Main Services link End Here -->


<div class="row">
	<!-- Left Section Start Here -->
	<div class="col-md-4 pd-left-default">

		<div class="profile_complete_indicatior">
			<h5 class="title">Your profile is <span class="completedprofile"><?=$profile_percent;?></span>% completed</h5>
			<div class="progress" style="height: 10px">
				<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$profile_percent;?>%;"></div>
			</div>
			<div class="btn-conatiner text-center">
				<a href="<?=base_url('dashboard/accountinfo');?>" class="btn btn-sm btn-raised btn_proceed"><?php if($profile_percent==100){ echo "View Profile";} else{ echo "Complete Profile";} ?></a>
			</div>
		</div>
		
								<div class="cus_modal_header clearfix">
						<a class="toggle" ></a><h5 class="title"><a class="toggle"> Latest Events </a></h5>
					</div>
					<div class="owl-carousel owl-theme" id="eventSlider">
						<?php if (isset($upcomming_events) && $upcomming_events) {
							foreach ($upcomming_events as $events) { ?>
							<div class="item">
								<div class="single-event">
									<div class="event-img">
										<img src="<?=base_url('assets/public/images/event/banner/'.$events->event_banner)?>">
										<div class="event-cont">
											<h3><?=$events->event_name;?></h3>
											<span>Start Date: <?=date('d-M-Y',strtotime($events->event_start_date))?></span><br>
											<span>End Date: <?=date('d-M-Y',strtotime($events->event_end_date))?></span>
										</div>
									</div>
									<div class="payment">
										<div class="event-payment1">
											<p>Total slot</p>
											<span class="booking-number"><?=$events->event_max_capicity_per_day;?></span>
										</div>
										<div class="event-payment2">
											<p>Booked slot</p>
											<span class="booking-number">0</span>
										</div>
										<div class="event-payment3">
											<p>Available slot</p>
											<span class="booking-number"><?=$events->event_max_capicity_per_day;?></span>
										</div>
									</div>
								</div>
							</div>
							<?php }
						} ?>


					</div>
					
					<div class="latest__notification collapseed-area">
			<div class="cus_modal">
				<div class="cus_modal_header clearfix">
					<a class="toggle" ><h5 class="title"><i class="fa fa-question-circle"></i> Latest Queries <span class="badge notify badge-success"><?=count($latest_queries);?> New</span> </a></h5>
				</div>

				<div class="collapse show" id="collapseExample">
					<div class="cus_modal_body p-0">
						<div class="notification_list">
							<ul class="list-unstyled">
								<?php if (isset($latest_queries) && $latest_queries) {
									foreach ($latest_queries as $queries) { ?>

									<li class="media active">
										<a href="JavaScript:Void(0)" class="w-100">
											<div class="media-body">
												<small class="float-right"><?=date('d-M-Y',strtotime($queries->create_on));?></small>
												<h5 class="title mt-0 mb-1"><?=$queries->user_email;?></xh5>
													<p class="decs"><?= substr(strip_tags($queries->query_message),0,40); if(strlen($queries->query_message)>40){echo "...";} ?></p>
												</div>
												<div class="ripple-container"></div></a>
											</li>

											<?php }
										} ?>





									</div>
									<div class="btn-conatiner text-center">
										<a href="<?=base_url('facility/enquiry');?>" class="btn btn-sm btn-raised btn_proceed mb-3">View all</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Left Section End Here -->	



				<!-- Middle Section End Here -->	

				<div class="col-md-5 no-pad dashboardcalandarwrapper">
					<span class="total_slot_hidden"></span>
					<span class="booked_slot_hidden"></span>
					<div class="row text-center" style="position:relative">

						<div class="form-group search_mobile bmd-form-group  pull-right is-focused" style="margin-top: 5px; width:100%">
							<a id="selectsportsinitiator">Select Sports <i class="fa fa-angle-down " aria-hidden="true"></i></a>
							<a class="errorsportclass" id="errorsportclass" > Please Select Sports</a>
						</div>
						<div id="currentmonth" style="width:100%"><i class="fa fa-angle-left " id="prevmonth" onclick="prevmonth()" aria-hidden="true"></i> <span id="monthname">Oct</span> <span id="yearname">2019</span> <i class="fa fa-angle-right" id="nextmonth" onclick="nextmonth()" aria-hidden="true"></i></div> 
						<ul id="calandardays">

							<li>Mon</li>
							<li>Tue</li>
							<li>Wed</li>
							<li>Thu</li>
							<li>Fri</li>
							<li>Sat</li>
							<li>Sun</li>
						</ul>

						<div class="disablecalandar"></div>
						<div class="dateRange checkbox_divs" id="dateRange">
						</div>
						<div class="text-center col-sm-12" style="font-size: 12px;">
												<i class="fa fa-square" style="    color: #81c784; "></i> Available <i class="fa fa-square" style="    color: #ef5350;"></i> Unavailable  <i class="fa fa-square" style="    color: #f78a65;"></i> Few Available <br>  

						</div>
						<div class="text-center col-sm-12" >
                          <a href="https://vibestest.com/wip_projects/development/socialsportz/facility/booking" class="btn btn-sm btn-raised btn_proceed mb-3">Go to Bookings</a>

					</div>
					</div>
				
		






				</div>


				<!-- Middle Section End Here -->


				<!-- Right Section Start Here -->	

				<div class="col-md-3 pd-right-default">
					<!-- Right Side bar -->
					<div class="customerSearch__m8place">
						<div class="cus_modal">
							<div class="cus_modal_header clearfix">
								<a class="toggle" ><h5 class="title"><i class="fa fa-search"></i> Slot/Batch Availability </a></h5>
							</div>

							<div class="collapse show" id="customerSearch">
								<form>
									<div class="cus_modal_body">
										<div class="search__container clearfix">													
											<div class="row">
												<div class="col-md-12">
													<div class="form-group bmd-form-group search_mobile is-filled">
														<label for="mobileNumber" class="bmd-label-floating">Select Sports</label>
														<select class="form-control" id="fac_sport" >
															<?php if(isset($fac_sports) && !empty($fac_sports)) {
																foreach ($fac_sports as $fac_sport) {?>
																<option value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
																<?php }}?>

															</select>
<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
										<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">

														</div>
														<div class="form-group bmd-form-group search_mobile is-filled">
															<label for="mobileNumber" class="bmd-label-floating">Dates</label>
															<input style="padding-left: 30px;" type="text"  class="form-control" data-format="d-m-Y"  id="Dates" data-large-mode="true" data-large-default="true">
															<i class="fa fa-calendar prefix"></i>
														</div>

														<div class="btn-conatiner text-center">
															<a data-toggle="modal" href="JavaScript:Void(0)" data-target="#slotbookingtime" class="btn btn-sm btn-raised btn_proceed" id="dasboardbookdet">Search</a>
														</div>

													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>								
						</div>
						<div class="rating__m8place">
							<div class="cus_modal">
								<div class="cus_modal_header clearfix">
									<a class="toggle" ><h5 class="title"><i class="fa fa-star"></i> Review Summary </a></h5>
								</div>
								<?php
								/*Rating Progress Shahbaz Khan 28-09-2019*/
								$totRat = $total_5_review + $total_4_review + $total_3_review + $total_2_review + $total_1_review;
								if($totRat != ''){
									$Rat5Perc = round(($total_5_review / $totRat) * 100);
									$Rat4Perc = round(($total_4_review / $totRat) * 100);
									$Rat3Perc = round(($total_3_review / $totRat) * 100);
									$Rat2Perc = round(($total_2_review / $totRat) * 100);
									$Rat1Perc = round(($total_1_review / $totRat) * 100);
								}
								if(!empty($Rat5Perc)){
									$Rat5Val = $Rat5Perc;
								}
								else{
									$Rat5Val = 0;
								}
								if(!empty($Rat4Perc)){
									$Rat4Val = $Rat4Perc;
								}else{
									$Rat4Val = 0;
								}
								if(!empty($Rat3Perc)){
									$Rat3Val = $Rat3Perc;
								}else{
									$Rat3Val = 0;
								}
								if(!empty($Rat2Perc)){
									$Rat2Val = $Rat2Perc;
								}else{
									$Rat2Val = 0;
								}
								if(!empty($Rat1Perc)){
									$Rat1Val = $Rat1Perc;
								}else{
									$Rat1Val = 0;
								}

								?>

								<div class="collapse show" id="reviewCollapse">
									<div class="review_container_rating clearfix">
										<div class="rating_range_container">
											<ul class="list-unstyled mb-0">
												<li>
													<div class="star_count">5 <i class="fa fa-star"></i></div>
													<div class="rating_bar">
														<div class="progress">
															<div class="progress-bar" role="progressbar" style="width: <?php echo $Rat5Val; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="count_num"><?=$total_5_review;?></div>
												</li>
												<li>
													<div class="star_count">4 <i class="fa fa-star"></i></div>
													<div class="rating_bar">
														<div class="progress">
															<div class="progress-bar" role="progressbar" style="width: <?php echo $Rat4Val; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="count_num"><?=$total_4_review;?></div>
												</li>
												<li>
													<div class="star_count">3 <i class="fa fa-star"></i></div>
													<div class="rating_bar">
														<div class="progress">
															<div class="progress-bar" role="progressbar" style="width: <?php echo $Rat3Val; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="count_num"><?=$total_3_review;?></div>
												</li>
												<li>
													<div class="star_count">2 <i class="fa fa-star"></i></div>
													<div class="rating_bar">
														<div class="progress">
															<div class="progress-bar" role="progressbar" style="width: <?php echo $Rat2Val; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="count_num"><?=$total_2_review;?></div>
												</li>
												<li>
													<div class="star_count">1 <i class="fa fa-star"></i></div>
													<div class="rating_bar">
														<div class="progress">
															<div class="progress-bar" role="progressbar" style="width: <?php echo $Rat1Val; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
													<div class="count_num"><?=$total_1_review;?></div>
												</li>
											</ul>
										</div>
										<?php $total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
										$avg_rating=0;
										?>
										<div class="overall_rating_data text-center">
											<h1 class="rate__count"><?php if($total_review>0) echo $avg_rating= round($total_rating/$total_review,1);?></h1>
											<div class="rating">
												<ul class="list-inline">

													<li class="list-inline-item <?php if($avg_rating>0) echo "active" ?>"><i class="fa fa-star"></i></li>
													<li class="list-inline-item <?php if($avg_rating>1.5) echo "active" ?>"><i class="fa fa-star"></i></li>
													<li class="list-inline-item <?php if($avg_rating>2.5) echo "active" ?>"><i class="fa fa-star"></i></li>
													<li class="list-inline-item <?php if($avg_rating>3.5) echo "active" ?>"><i class="fa fa-star"></i></li>
													<li class="list-inline-item <?php if($avg_rating>4.5) echo "active" ?>"><i class="fa fa-star"></i></li>
												</ul>
											</div>
											<p><?=$total_review;?> Rating</p>
										</div>
									</div>
								</div>
								<div class="text-center" style="padding-bottom:20px;">
								<a href="https://vibestest.com/wip_projects/development/socialsportz/facility/review" class="btn btn-sm btn-raised btn_proceed">View Review</a>
								</div>
							</div>								
						</div>



					</div>

					<!-- Right Section End Here -->	
				</div>



				<!-- Modal Popup Start Here -->
				<div class="modal fade edit_profile_modal" id="slotbookingtime" role="dialog" style=" padding-right: 17px;">

					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" style="top:13px;" class="close" data-dismiss="modal">×</button>
								<h5 class="modal-title pl-3" id="exampleModalLongTitle">Slot/Batch Availability<span class="sportname"></span></h5>


							</div>
							<div class="modal-body" id="model_ajax_div"></div>
							<div class="modal-footer"></div>
						</div>

					</div>

				</div>
				<!-- Modal Popup End Here -->
				
				
				<div class="modal fade edit_profile_modal" id="calandarselectsport" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" style="top:13px;" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title pl-3" id="exampleModalLongTitle">Select Sport</h5>

							</button>
						</div>
						<div class="modal-body">

							<div id="sportspopup">
								<ul>


					<?php if (isset($fac_sports) && $fac_sports!='') {
						foreach ($fac_sports as $sports) { ?>

						<li>
							<img src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon)?>">
							<input type="radio" class="sport_id" name="sport_id" value="<?=$sports->sport_id;?>">
							<span class="sport_name"><?=$sports->sport_name;?></span>
						</li>
						<?php } } ?>

					</ul>
							</div>
						</div>

						<div class="modal-footer"></div>

					</div>
				</div>
			</div>






		</div>
		






		<script>
			$("#Dates").dateDropper()
			$('#topItemsSlider').owlCarousel({
				nav : false,
				items:5,
				autoplay : false,
				autoplayTimeout : 3500,
				autoplayHoverPause:true,
				smartSpeed:450,
				loop:true,
				margin:5,
				nav:true,
				dots : false,
				mouseDrag : true,
				touchDrag : true,
				navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
				responsive:{
					320:{
						items:2
					},
					480:{
						items:3
					},

					991:{
						items:4
					},
					1024:{
						items:4
					},
					1200:{
						items:5
					}
				}		
			});
			$('#eventSlider').owlCarousel({
				nav : true,
				items:1,
				autoplay : false,
				autoplayTimeout : 3500,
				autoplayHoverPause:true,
				smartSpeed:450,
				loop:true,
				margin:30,
				dots : false,
				mouseDrag : true,
				touchDrag : true,
		// navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
		navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			320:{
				items:1
			},
			480:{
				items:1
			},

			991:{
				items:1
			},
			1024:{
				items:1
			},
			1200:{
				items:1
			}
		}		
	});

</script>

<script>
	

	

	setTimeout(function(){cdf = jQuery(".completedprofile").text();
		if( cdf == 100 ){jQuery(".progress-bar").addClass('completedprofilebar')}
	},200);


///////////////////////////
$('#dasboardbookdet').on('click', function(e) {
	var fac_id =$("#headeracademyfacility option:selected" ).val();
	var fac_name =$("#headeracademyfacility option:selected" ).text();
	var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
	var fac_sport =$("#fac_sport option:selected" ).val();
	var date =$("#Dates").val();
		//alert(fac_name);
		//alert(date);

		action='available_slots';

		$.ajax({
			type: "POST",
			url:'<?php echo base_url();?>facility/booking/available_slots',	
			data: {fac_id:fac_id,fac_sport:fac_sport,date:date,fac_type:fac_type,fac_name:fac_name,action:action},
			success:function(res){

				if(res!='failed'){
					$("#model_ajax_div").html(res['_html']);
				}
				else{
					$('#error_msg').show(); 
					$('#error_msg').text("Network issue"); 
				}				    

			}	
		});
		
		$( ".select_plan label").unbind( "click" );


	});	

		jQuery(document).stop(true,true).on("click",".academylabel label", function(e){
			jQuery('label').find("input").attr("selected", false);
	jQuery('label.active').find("input").attr("selected", true);
	jQuery(this).toggleClass('active');
		$( ".select_plan label").unbind( "click" );
	});
	
			jQuery(document).stop(true,true).on("click",".fac_facility label", function(e){
			jQuery('label').find("input").attr("selected", false);
	jQuery('label.active').find("input").attr("selected", true);
	jQuery(this).addClass('active');
		$( ".select_plan label").unbind( "click" );
	});
</script>

<script>

	jQuery(".searchsportsname li").on("click", function(){jQuery('.sportsname').find("input").attr("checked", false); jQuery(this).find("input").attr("checked", "checked"); jQuery('.sportsname').find("label").removeClass("activegame"); jQuery(this).find("label").addClass("activegame")});

</script>









<script>

	var month = new Array();
	month[0] = "Jan";
	month[1] = "Feb";
	month[2] = "Mar";
	month[3] = "Apr";
	month[4] = "May";
	month[5] = "Jun";
	month[6] = "Jul";
	month[7] = "Aug";
	month[8] = "Sep";
	month[9] = "Oct";
	month[10] = "Nov";
	month[11] = "Dec";

	
	var abc = new Date().getFullYear();
	var d = new Date();
	var sdf= d;
	var kkk = month[d.getMonth()];
	var x = month[d.getMonth() + 1];
	var n = d.getMonth();
	
	function myFunctiononload() {
		var today1 = new Date();
		var llll = today1.getDate();	

		jQuery("#dateRange").empty();
		var lastday = function(y,m){
			return  new Date(y, m +1, 0).getDate();
		}
		var count1 = lastday(abc, n);	

		i = 1;
		for(i; i <= count1; i++)
		{
			var getDaysInweek = function(year, month, i) {
				return new Date(year, month, i).getDate();
			};

			var ndf = new Date(abc,n,i);
			var bbb = ndf.toString();

			var cdf = bbb.split(month[n])[0];



			var brt = [];
			var mgh = $('.total_slot_hidden').text();
			brt = mgh.split(',');
			
			var lrt = [];
			var gyu = $('.booked_slot_hidden').text();
			lrt = gyu.split(',');



			jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat"></span><i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
			jQuery("#monthname").html(month[n]);
			jQuery("#yearname").html(abc);

		}
		var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
		jQuery("#dateRange .item:nth-child(1)").addClass(qqq);




	}
	
	myFunctiononload();

	function myFunction() {
		var today1 = new Date();
		var llll = today1.getDate();	

		jQuery("#dateRange").empty();
		var lastday = function(y,m){
			return  new Date(y, m +1, 0).getDate();
		}
		var count1 = lastday(abc, n);	

		i = 1;
		for(i; i <= count1; i++)
		{
			var getDaysInweek = function(year, month, i) {
				return new Date(year, month, i).getDate();
			};

			var ndf = new Date(abc,n,i);
			var bbb = ndf.toString();

			var cdf = bbb.split(month[n])[0];



			var brt = [];
			var mgh = $('.total_slot_hidden').text();
			brt = mgh.split(',');
			
			var lrt = [];
			var gyu = $('.booked_slot_hidden').text();
			lrt = gyu.split(',');



			jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">'+ lrt[i-1] +'/<span class="total_slot">'+ brt[i-1] +'</span></span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
			jQuery("#monthname").html(month[n]);
			jQuery("#yearname").html(abc);

		}
		var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
		jQuery("#dateRange .item:nth-child(1)").addClass(qqq);

		$('.date_data').each(function(){
			$(this).removeClass("fullfilled,fullavailable,fewavailable");
			var mgh = $(this).find('.availableseat').text();
			var mmm = mgh.split('/')[0];
			var rrr = mgh.split('/')[1];
			
			if(mmm==rrr){$(this).addClass("fullfilled");}
			if(mmm < rrr){$(this).addClass("fewavailable");}
if(mmm==0){$(this).removeClass('fewavailable').addClass("fullavailable")};			

		});  


	}


	jQuery("#nextmonth").on("click", function(){ 
		var month = new Array(); 
		month[0] = "Jan";
		month[1] = "Feb";
		month[2] = "Mar";
		month[3] = "Apr";
		month[4] = "May";
		month[5] = "Jun";
		month[6] = "Jul";
		month[7] = "Aug";
		month[8] = "Sep";
		month[9] = "Oct";
		month[10] = "Nov";
		month[11] = "Dec";


		var abc = jQuery("#yearname").text(); var hhh = jQuery("#monthname").text(); function nextmonth(month) {
			return month == hhh;
		} 



		var d = new Date();
		var sdf= d; var ttt = month.findIndex(nextmonth);
		var x = month[ttt + 1];
		setTimeout(function(){ 

			jQuery("#monthname").html(x);
			var n = ttt + 1; 

			jQuery("#dateRange").empty();




			var lastday = function(y,m){
				return  new Date(y, m +1, 0).getDate();
			}



			var count1 = lastday(abc, n);	


			i = 1;
			for(i; i <= count1; i++)
			{

				var getDaysInweek = function(year, month, i) {
					return new Date(year, month, i).getDate();
				};

				var ndf = new Date(abc,n,i);
				var bbb = ndf.toString();
				var cdf = bbb.split(month[n])[0];
				jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">0/7</span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
				jQuery("#monthname").html(month[n]);
				jQuery("#yearname").html(abc);

			}
			var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
			jQuery("#dateRange .item:nth-child(1)").addClass(qqq);

			$('.date_data').each(function(){
				var mgh = $(this).find('.availableseat').text();
				var mmm = mgh.split('/')[0];
				var rrr = mgh.split('/')[1];
				if(mmm==0){$('.date_data').addClass("fullavailable")};
				if(mmm==rrr){$(this).addClass("fullfilled");}
				if(mmm < rrr){$(this).addClass("fewavailable");} 

			});  

			if(hhh == "Dec")
			{

				jQuery("#monthname").text("Jan");
				jQuery("#yearname").text(abc + 1);
				var mmm =   Number(abc) + 1;

				var ndf = new Date(mmm,n,i);
				var bbb = ndf.toString();
				console.log(bbb);
				var cdf = bbb.split("Jan")[0];
				console.log(cdf);
				jQuery("#monthname").text("Jan");
				jQuery("#yearname").text(abc + 1);

				i = 1;
				for(i; i <= count1; i++)
				{
					var getDaysInweek = function(year, month, i) {
						return new Date(year, month, i).getDate();
					};

					var ndf = new Date(abc,n,i);
					var bbb = ndf.toString();
					var cdf = bbb.split("Jan")[0];
					jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">0/7</span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
					jQuery("#yearname").html(mmm);

				}	

			} 

		}, 500);


	}); 


	$("#sportspopup li").on("click", function(){

		$('#calandarselectsport').trigger('click');
		$("#sportspopup li").removeClass('selected'); 
		jQuery(this).addClass("selected");
		jQuery(this).find("input:radio").prop("checked", true)
		$('.dateRange').addClass('sportsselected');

		$('.disablecalandar').remove();
		$('#errorsportclass').hide();

		var sport_id =$("input[name='sport_id']:checked").val();
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		var fac_name =$("#headeracademyfacility option:selected" ).text();
		var sport_id =$("input[name='sport_id']:checked").val();
		var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
		var month =$("#monthname").text();
		var year =$("#yearname").text();
		var sport_name = $(this).find('.sport_name').text();
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/availability_count_of_month',	
			data: {fac_id:fac_id,fac_name:fac_name,fac_type:fac_type,sport_id:sport_id,month:month,year:year},
			success:function(res){

				var result = JSON.parse(res);
				
				$('.booked_slot_hidden').text(result.sport_slot_booking_count);
				$('.total_slot_hidden').text(result.sport_slot_count);
				$('#selectsportsinitiator').text(sport_name);

				myFunction();


			}	
		});



	});


	$(document).on("click", '.item', function(e) {

		var month = new Array(); 
		month[0] = "Jan";
		month[1] = "Feb";
		month[2] = "Mar";
		month[3] = "Apr";
		month[4] = "May";
		month[5] = "Jun";
		month[6] = "Jul";
		month[7] = "Aug";
		month[8] = "Sep";
		month[9] = "Oct";
		month[10] = "Nov";
		month[11] = "Dec";
		

		var yyy = jQuery("#monthname").text();

		function nextmonth(month) {
			return month == yyy;
		} 



		var ttt = month.findIndex(nextmonth);	



		var ddd = jQuery("#yearname").text(); var mgh = jQuery(this).find(".day").text(); var cdf = mgh.split(" ");  var kkk = cdf[0];  var datetime = ddd + "-" + (ttt + 1) + "-" + kkk; 
       // alert(eee);
       var fac_id =$("#headeracademyfacility option:selected" ).val();
       var sport_id =$("input[name='sport_id']:checked").val();
       var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
			//var datetime = $(this).find('#ymd').text();
			var day = $(this).find('.week').text();
			//alert(sport_id);
			$.ajax({
				type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/slot_batch_detail',	
			data: {fac_id:fac_id,sport_id:sport_id,fac_type:fac_type,datetime:datetime,day:day,action:action},
			success:function(res){
				$("#bookingresultdaily").html(res['_html']);
			}	
		});


		});







	jQuery("#prevmonth").on("click", function(){ 


		var month = new Array(); 
		month[0] = "Jan";
		month[1] = "Feb";
		month[2] = "Mar";
		month[3] = "Apr";
		month[4] = "May";
		month[5] = "Jun";
		month[6] = "Jul";
		month[7] = "Aug";
		month[8] = "Sep";
		month[9] = "Oct";
		month[10] = "Nov";
		month[11] = "Dec";


		var abc = jQuery("#yearname").text(); var hhh = jQuery("#monthname").text(); function nextmonth(month) {
			return month == hhh;
		} 



		var d = new Date();
		var sdf= d; var ttt = month.findIndex(nextmonth);
		var x = month[ttt - 1];
		setTimeout(function(){ 

			jQuery("#monthname").html(x);
			var n = ttt - 1; 

			jQuery("#dateRange").empty();




			var lastday = function(y,m){
				return  new Date(y, m +1, 0).getDate();
			}



			var count1 = lastday(abc, n);	

			i = 1;
			for(i; i <= count1; i++)
			{
				var getDaysInweek = function(year, month, i) {
					return new Date(year, month, i).getDate();
				};

				var ndf = new Date(abc,n,i);
				var bbb = ndf.toString();
				var cdf = bbb.split(month[n])[0];
				jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">30/30</span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
				jQuery("#monthname").html(month[n]);
				jQuery("#yearname").html(abc);

			}
			var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
			jQuery("#dateRange .item:nth-child(1)").addClass(qqq);

			$('.date_data').each(function(){
				var mgh = $(this).find('.availableseat').text();
				var mmm = mgh.split('/')[0];
				var rrr = mgh.split('/')[1];
				if(mmm==0){$('.date_data').addClass("fullavailable")};
				if(mmm==rrr){$(this).addClass("fullfilled");}
				if(mmm < rrr){$(this).addClass("fewavailable");} 

			});  

			if(hhh == "Jan")
			{

				jQuery("#dateRange").remove();
				$('<div class=" dateRange checkbox_divs" id="dateRange"></div>').insertAfter("#currentmonth");
				jQuery("#monthname").text("Dec");
				jQuery("#yearname").text(abc - 1);
				var mmm = abc - 1;



				var ndf = new Date(mmm,n,i);
				var bbb = ndf.toString();
				console.log(bbb);
				var cdf = bbb.split("Dec")[0];
				console.log(cdf);
				jQuery("#monthname").text("Dec");
				jQuery("#yearname").text(abc - 1);

				i = 1;
				for(i; i <= count1; i++)
				{
					var getDaysInweek = function(year, month, i) {
						return new Date(year, month, i).getDate();
					};

					var ndf = new Date(abc,n,i);
					var bbb = ndf.toString();
					var cdf = bbb.split("Dec")[0];
					jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">7/7</span>          <i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
					jQuery("#yearname").html(mmm);

				}	

			} 

		}, 500);


	}); 




</script>
</body>






<script>




	$("#sportspopup li").on("click", function(){

		$('#calandarselectsport').trigger('click');
		$("#sportspopup li").removeClass('selected'); 
		jQuery(this).addClass("selected");
		jQuery(this).find("input:radio").prop("checked", true)
		$('.dateRange').addClass('sportsselected');
		$('#errorsportclass').hide();
		$('.disablecalandar').remove();
	});
	
	$('#selectsportsinitiator').on("click", function(){
		$('#calandarselectsport').modal("show");
	});

	$('.disablecalandar').on("click", function()
	{
		$('.errorsportclass').show();
		$('html,body').animate({scrollTop: $("#errorsportclass").offset().top - 190},'slow');
	});	

	$(document).on("click", "#dateRange .item", function(){

		$('#dateRange .item').find('.date_data').removeClass('selected')
		$(this).find('.date_data').addClass('selected');

		$('.select_plan').removeClass('slothidden');
		$('html,body').animate({scrollTop: $("#slotscroll").offset().top - 190},'slow');

	});
	



</script>
