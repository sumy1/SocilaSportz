<!-- Main Services link Start Here -->
<div class="row">
	<div class="col-md-12">
		<div class="owl-carousel owl-theme" id="topItemsSlider">
			<div class="item">
				<a href="javascript:void(0)">
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
				<a href="javascript:void(0)" title="">
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
				<a href="javascript:void(0)" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/confirmed-booking.png')?>" class="img-fluid" alt="">
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
				<a href="javascript:void(0)" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/confirmed-booking.png')?>" class="img-fluid" alt="">
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
				<a href="javascript:void(0)" title="">
					<div class="stat-container1 clearfix">
						<div class="img-icon">
							<img src="<?=base_url('assets/public/images/dashboard/confirmed-booking.png')?>" class="img-fluid" alt="">
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
			<h5 class="title">Your profile is 30% completed</h5>
			<div class="progress" style="height: 10px">
				<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
			</div>
			<div class="btn-conatiner text-center">
				<a href="account-info.php" class="btn btn-sm btn-raised btn_proceed">Complete profile</a>
			</div>
		</div>
		<div class="latest__notification collapseed-area">
			<div class="cus_modal">
				<div class="cus_modal_header clearfix">
					<a class="toggle" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><h5 class="title"><i class="fa fa-question-circle"></i> Latest Queries <span class="badge notify badge-success"><?=count($latest_queries);?> New</span> </a></h5>
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

						<div class="col-md-5 no-pad">
							<div class="cus_modal_header clearfix">
								<a class="toggle" data-toggle="collapse" href="#customerSearch" role="button" aria-expanded="false" aria-controls="collapseExample"></a><h5 class="title"><a class="toggle" data-toggle="collapse" href="#customerSearch" role="button" aria-expanded="false" aria-controls="collapseExample"> Upcoming Events </a></h5>
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


							<div class="collapse show" id="reportsCollapse">
								<div class="cus_modal_body">	
									<div class="row">

										<div class="col-md-6">
											<div class="form-group selectdiv">
												<label for="exampleSelect1" class="bmd-label-floating">Monthly</label>
												<select class="form-control" id="exampleSelect1">
													<option>Select Month</option>											
												</select>
												<i class="fas fa-calendar-alt prefix"></i>
											</div>
										</div>
									</div>										
									<div id="chartdiv"></div>
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
										<a class="toggle" data-toggle="collapse" href="#customerSearch" role="button" aria-expanded="false" aria-controls="collapseExample"><h5 class="title"><i class="fa fa-search"></i> Slot/Batch Availability </a></h5>
									</div>

									<div class="collapse show" id="customerSearch">
										<form>
											<div class="cus_modal_body">
												<div class="search__container clearfix">													
													<div class="row">
														<div class="col-md-12">
															<div class="form-group search_mobile">
																<label for="mobileNumber" class="bmd-label-floating">Select Sports</label>
																<select class="form-control" style="margin-left:0px; width: 100%">
																	<option value="Cricket">Cricket</option>
																	<option value="Cricket">Football</option>
																</select>
																<i class="fa fa-mobile-alt prefix"></i>
															</div>
															<div class="form-group search_mobile">
																<label for="mobileNumber" class="bmd-label-floating">Dates</label>
																<input type="text"  class="form-control" data-format="d-m-Y"  id="Dates" data-large-mode="true" data-large-default="true">
																<i class="fa fa-mobile-alt prefix"></i>
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
										<a class="toggle" data-toggle="collapse" href="#reviewCollapse" role="button" aria-expanded="false" aria-controls="collapseExample"><h5 class="title"><i class="fa fa-star"></i> Review Summary </a></h5>
									</div>

									<div class="collapse show" id="reviewCollapse">
										<div class="review_container_rating clearfix">
											<div class="rating_range_container">
												<ul class="list-unstyled mb-0">
													<li>
														<div class="star_count">5 <i class="fa fa-star"></i></div>
														<div class="rating_bar">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="count_num">20</div>
													</li>
													<li>
														<div class="star_count">4 <i class="fa fa-star"></i></div>
														<div class="rating_bar">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="count_num">15</div>
													</li>
													<li>
														<div class="star_count">3 <i class="fa fa-star"></i></div>
														<div class="rating_bar">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="count_num">20</div>
													</li>
													<li>
														<div class="star_count">2 <i class="fa fa-star"></i></div>
														<div class="rating_bar">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="count_num">10</div>
													</li>
													<li>
														<div class="star_count">1 <i class="fa fa-star"></i></div>
														<div class="rating_bar">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 5%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="count_num">05</div>
													</li>
												</ul>
											</div>
											<div class="overall_rating_data text-center">
												<h1 class="rate__count">3.3</h1>
												<div class="rating">
													<ul class="list-inline">
														<li class="list-inline-item active"><i class="fa fa-star"></i></li>
														<li class="list-inline-item active"><i class="fa fa-star"></i></li>
														<li class="list-inline-item active"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
													</ul>
												</div>
												<p><a href="reviews-ratings.php" class="link">37 Reviews</a></p>
											</div>
										</div>
									</div>
								</div>								
							</div>



						</div>

						<!-- Right Section End Here -->	
					</div>




					<!-- Modal Popup Start Here -->
					<div class="modal fade edit_profile_modal" id="slotbookingtime" role="dialog" style=" padding-right: 17px;">
						<form>
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" style="top:13px;" class="close" data-dismiss="modal">×</button>
										<h5 class="modal-title pl-3" id="exampleModalLongTitle">Slot/Batch Availability for <span class="sportname">Cricket</span></h5>


									</div>
									<div class="modal-body">


										<div class="slotbooked">
											<div class="row">
												<div class="col-sm-8">
													<h5 class="modal-title" id="exampleModalLongTitle">Bhaichung Bhutia Football Academy </h5>
												</div>
												<div class="col-sm-4 text-right"><strong>29-08-2019</strong></div>
											</div>
											<div class="select_plan " data-toggle="buttons">
												<label class="btn">

													<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
													<div class="plan">

														<span class="amount">8:00 am - 10:00 am<br>
															Available
														</span>


													</div>
													<div class="ripple-container"></div><div class="ripple-container"></div>
													<i class="fa fa-check-circle" aria-hidden="true"></i>
													<div class="ripple-container"></div><div class="ripple-container"></div></label>

													<label class="btn  booked" data-original-title="" title="">
														<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
														<div class="plan">

															<span class="amount">8:00 am - 10:00 am<br>
																Not Available

															</span></div>
															<div class="ripple-container"></div><div class="ripple-container"></div>
															<i class="fa fa-check-circle" aria-hidden="true"></i>
														</label>

														<label class="btn">

															<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
															<div class="plan">

																<span class="amount">8:00 am - 10:00 am<br>
																	Available <span class="table-darkblue">(Premium)</span>
																</span>


															</div>
															<div class="ripple-container"></div><div class="ripple-container"></div>
															<i class="fa fa-check-circle" aria-hidden="true"></i>
														</label>

														<label class="btn">

															<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
															<div class="plan">

																<span class="amount">8:00 am - 10:00 am<br>
																	Available <span class="table-darkblue">(Discounted)</span>
																</span>


															</div>
															<div class="ripple-container"></div><div class="ripple-container"></div>
															<i class="fa fa-check-circle" aria-hidden="true"></i>
														</label>

														<label class="btn">

															<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
															<div class="plan">

																<span class="amount">8:00 am - 10:00 am<br>
																	Available
																</span>


															</div>
															<div class="ripple-container"></div><div class="ripple-container"></div>
															<i class="fa fa-check-circle" aria-hidden="true"></i>
															<div class="ripple-container"></div></label>

															<label class="btn  booked" data-original-title="" title="">
																<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
																<div class="plan">

																	<span class="amount">8:00 am - 10:00 am<br>
																		Not Available

																	</span></div>
																	<div class="ripple-container"></div><div class="ripple-container"></div>
																	<i class="fa fa-check-circle" aria-hidden="true"></i>
																</label>

																<label class="btn">

																	<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
																	<div class="plan">

																		<span class="amount">8:00 am - 10:00 am<br>
																			Available <span class="table-darkblue">(Premium)</span>
																		</span>


																	</div>
																	<div class="ripple-container"></div><div class="ripple-container"></div>
																	<i class="fa fa-check-circle" aria-hidden="true"></i>
																</label>


															</div>


															<div class="row">
																<div class="col-sm-6">
																	<h5 class="modal-title" id="exampleModalLongTitle">Bhaichung Bhutia Football Academy </h5>
																</div>
																<div class="col-md-3">
																	<div class="form-group bmd-form-group is-filled planeddashboard" style="margin-top: -25px;">
																		<label for="gender" class="bmd-label-floating">Select Plan</label>
																		<select class="form-control" id="academybatchtype">
																			<option>Select Plan</option>
																			<option>One Month</option>
																			<option>Two Month</option>
																			<option>Three Month</option>
																			<option>Four Month</option>
																		</select>	<i class="fa fa-futbol-o prefix"></i>
																		<span id="errGender" class="error"></span>	
																	</div>
																</div>
																<div class="col-sm-3 text-right"><strong>29-08-2019</strong></div>
															</div>
															<div class="select_plan academylabel" data-toggle="buttons">

																<label class="btn green">

																	<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
																	<div class="plan">

																		<span class="amount">8:00 am - 10:00 am<br>
																			Available <span class="table-darkblue">(10/20)</span>
																		</span>


																	</div>
																	<div class="ripple-container"></div><div class="ripple-container"></div>
																	<i class="fa fa-check-circle" aria-hidden="true"></i>
																	<div class="ripple-container"></div><div class="ripple-container"></div></label>

																	<label class="btn green" data-original-title="" title="">
																		<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
																		<div class="plan">

																			<span class="amount">8:00 am - 10:00 am<br>
																				Available <span class="table-darkblue">(14/20)</span>

																			</span></div>
																			<div class="ripple-container"></div><div class="ripple-container"></div>
																			<i class="fa fa-check-circle" aria-hidden="true"></i>
																		</label>

																		<label class="btn booked">

																			<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
																			<div class="plan">

																				<span class="amount">8:00 am - 10:00 am<br>
																					Not Available <span class="table-darkblue">(20/20)</span>
																				</span>


																			</div>
																			<div class="ripple-container"></div><div class="ripple-container"></div>
																			<i class="fa fa-check-circle" aria-hidden="true"></i>
																		</label>




																	</div>

																	<div class="row">
																		<div class="col-sm-12 text-right">
																			<a class="bookedslot" href="book-now.php">Book Now</a>
																		</div>
																	</div>
																</div>

															</div>
															<div class="modal-footer">

															</div>
														</div>

													</div>
												</form>
											</div>
											<!-- Modal Popup End Here -->

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
	var chart = AmCharts.makeChart( "chartdiv", {
		"type": "serial",
		"theme": "light",
		"dataProvider": [ {
			"country": "Jan",
			"visits": 2025,
		}, {
			"country": "Feb",
			"visits": 1882
		}, {
			"country": "Mar",
			"visits": 1809
		}, {
			"country": "April",
			"visits": 1322
		}, {
			"country": "May",
			"visits": 1122
		}, {
			"country": "June",
			"visits": 1114
		} ],
		"valueAxes": [ {
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0
		} ],
		"colorField":"#CCCCCC",
		"gridAboveGraphs": true,
		"startDuration": 1,
		"graphs": [ {
			"balloonText": "[[category]]: <b>[[value]]</b>",
			"fillAlphas": 0.8,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "visits"
		} ],
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
			"zoomable": false
		},
		"categoryField": "country",
		"categoryAxis": {
			"gridPosition": "start",
			"gridAlpha": 0,
			"tickPosition": "start",
			"tickLength": 20
		},
		"export": {
			"enabled": false
		}

	} );
</script>