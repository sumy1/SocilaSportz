<!DOCTYPE html>
<html>

<head>
	<title>Social Sportz</title>
	<link rel="shortcut icon" type="image/png" href="favicon.png" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'common/head.php';?>
	<style>

.minusgap30{margin-top: -30px !important}
	.calanderpopover {
    cursor: pointer;
    border: 1px solid #a79c9c;
    padding: 3px 18px;
    border-radius: 4px;
    font-size: 12px;

}	
		.modal-backdrop{opacity: 0.6 !important}
		header{
	    background: #000;
	}

	.right25
	{
		right: 25px !important;
	}

	.addresfont
	{
		color:#000;
	}

		.popover
	{
		margin-top: -170px;
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
	</style>
	<link rel="stylesheet" href="assets/css/datedropper.min.css">
</head>

<body id="searchfacilityacademy">
	<?php include 'common/headeruser.php'; ?>
	<!-- // Banner starts Here // -->
	<div class="clearfix"></div>
	<div class=" search-area nopadleft nopadright">
		<div class="container">
			<form name="searchForm" id="searchForm" method="post" action="huddle/search-listing.php" class="form-search">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6 nopadright">
						<div class="form-group" style="margin-top: 5px;">	<i class="fa fa-map-marker" aria-hidden="true"></i>
							<select class="form-control city_name" id="city" name="city" title="Location">
								<option value="">Location</option>
								<option value="Bangaluru">Bangaluru</option>
								<option value="Bhimtal Nainital">Bhimtal Nainital</option>
								<option value="Chennai">Chennai</option>
								<option value="Faridabad">Faridabad</option>
								<option value="Ghaziabad">Ghaziabad</option>
							</select>	<i class="fa fa-caret-down"></i>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6 nopadright">
						<div class="form-group" style="margin-top: 5px;">	<i class="fa fa-futbol-o" aria-hidden="true"></i>
							<select class="form-control city_name" id="sport_name" name="sport_name" title="Sport Name">
								<option value="">Select Sports</option>
								<option value="35">Abseiling</option>
								<option value="36">Aerobatics</option>
								<option value="10">Aerobics/ Zumba</option>
								<option value="37">Aikido</option>
								<option value="38">Air Racing</option>
							</select>	<i class="fa fa-caret-down"></i>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6 nopadright">
						<div class="form-group" style="margin-top: 5px;">	<i class="fa fa-university" aria-hidden="true"></i>
							<select class="form-control city_name" id="facilities" name="facilities" title="Facilities" onchange="javascript:chgAction()">
								<option value="Facilities">Facilities</option>
								<option value="Academy">Academy</option>
								<option value="Events">Events</option>
							</select>	<i class="fa fa-caret-down"></i>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12 padding0">
						<div class="form-group">
							<div class="search-area1">	<a class="btn btn-primary btn-block search_tab clr" id="butner">Search</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="gorupedfilter">
		<div class="container">
			<div class="row">
			<div class="col-md-3">
                                    <div class="form-group bmd-form-group is-filled minusgap30" style="margin-top: -30px;">
                                        <label for="Sport" class="bmd-label-floating">Sort by Rating<span class="required">*</span></label>
                                        <select class="form-control"  name="rating">
            <option disabled value>Filter by rating:</option>
            <option value=5>5 stars</option>
            <option value=4>4 stars & above</option>
            <option value=3>3 stars & above</option>
            <option value=2>2 stars & above</option>
            <option value=1>1 star & above</option>
        </select>
<i class="fa fa-star prefix"></i>

                                            <span id="errAcademySport" class="error"></span>    
                                        </div>
                                    </div>


                <div class="col-sm-6 text-right"></div>
				<div class="col-sm-3 text-right">
					<button class="btn border-btn" id="clearbtn">Clear Filters</button>
					<button class="btn orange-btn" id="applyfilter">Apply Filters</button>
				</div>
				<div class="col-sm-1 m10">Sports</div>
				<div class="col-sm-11 m10">
					<ul class="searchsportsname">
						<li class="sportsname">
							<label class="radio-inline btn btn-default">
								<input type="radio" name="default" value="Badminton"><span class="bmd-radio"></span>
								Badminton
								<div class="ripple-container"></div>
							</label>
						</li>
						<li class="sportsname">
							<label class="radio-inline btn btn-default">
								<input type="radio" name="default" value="Cricket"><span class="bmd-radio"></span>
								Cricket
								<div class="ripple-container"></div>
							</label>
						</li>
						<li class="sportsname">
							<label class="radio-inline btn btn-default">
								<input type="radio" name="default" value="Tenis"><span class="bmd-radio"></span>
								Tenis
								<div class="ripple-container"></div>
							</label>
						</li>
						<li class="sportsname">
							<label class="radio-inline btn btn-default">
								<input type="radio" name="default" value="Football"><span class="bmd-radio"></span>
								Football
								<div class="ripple-container"></div>
							</label>
						</li>
						<li class="sportsname">
							<label class="radio-inline btn btn-default">
								<input type="radio" name="default" value="Gym"><span class="bmd-radio"></span>
								Gym
								<div class="ripple-container"></div>
							</label>
						</li>
						<li class="sportsname">
							<label class="radio-inline btn btn-default">
								<input type="radio" name="default" value="Swimming"><span class="bmd-radio"></span>
								Swimming
								<div class="ripple-container"></div>
							</label>
						</li>
					</ul>
				</div>
				<div class="col-sm-12 m10"></div>
	
				<div class="col-md-12 nopadleft nopadright">
					<hr>
					<label class="searchheading">Amenities</label>
				</div>
				<div class="ui four column doubling  grid" style="margin-top:0px;">
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/parking.png"><span>Parking</span>
						</div>
					</div>
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/first_aid.png"><span>First aid kit</span>
						</div>
					</div>
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/washroom.png"><span>Washroom</span>
						</div>
					</div>
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/earth (1).svg"><span>Power backup</span>
						</div>
					</div>
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/locker.png"><span> Lockers</span>
						</div>
					</div>
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/beverages.png"><span>Snacks and Beverages</span>
						</div>
					</div>
					<div class="column">
						<div class="ui large label amenity">
							<input class="checkbox" type="checkbox" name="amenities" id="amenities" value="1">
							<img class="ui right spaced image" src="assets/images/shower.svg"><span> Shower</span>
						</div>
					</div>
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
					<h3>9 results found</h3>
				</div>
				<div class="col-sm-4 text-right">Advanced Filters<i class="fa fa-bars togglefilter"></i>
				</div>
				<div class="col-sm-12">
					<div class="row">
							<div class="col-sm-4">
                            <div class="favourite">
                            	<i class="fa fa-heart"></i>
									<i class="fa fa-heart-o"></i>
                            </div>

							<a href="search-detail.php">
								<img src="assets/images/search1.png" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>

								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">Bharat Sports Management Group</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover"> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

							<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search2.jpg" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">DDA Sports Complex Paschim Vihar</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

							<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search3.jpg" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">Kathuria Public School</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

														<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search1.png" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">Bharat Sports Management Group</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

							<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search2.jpg" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">DDA Sports Complex Paschim Vihar</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

							<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search3.jpg" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">Kathuria Public School</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

													<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search1.png" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">Bharat Sports Management Group</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

							<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search2.jpg" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">DDA Sports Complex Paschim Vihar</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>

							<div class="col-sm-4">
							<a href="search-detail.php">
								<img src="assets/images/search3.jpg" alt="">
								<div class="venue-rating-div">
									<div>
										<div class="venue-list-rating"><i class="fa fa-star"></i> 3.2</div>
									</div>
									<div class="venue-list-votes">12 Review</div>
								</div>
							</a>
							<div class="item-wrapper">	<span class="heading">
											<a href="search-detail.php">Kathuria Public School</a>
										</span>
								<div class="row">
									<div class="text-left col-sm-12"><i class="fa fa-clock-o" aria-hidden="true"></i>	<strong>Opening Timing :</strong>  <span class="calanderpopover" data-original-title="" title=""> <strong>Mon</strong>:9:00 AM <strong>to</strong> 7:00 PM <i class="fa fa-caret-down right25"></i></span>
									</div>	</div>
								<div class="row">
									<div class="text-left col-sm-12 addresfont">	<i class="fa fa-map-marker"></i> Golf Course Extension Road, Sector 62</div>
									
									<div class="col-sm-12 kiticon"> <strong>Sports Available:</strong>
									</div>
									<div class="flex sports-div-margin-top sportshomeicon col-sm-12">
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/archery.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/volleyball1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/shooting1.png">
										</div>
										<div class="sport-icon-div">
											<img alt="sports icon" class="sportsimgicon1" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/sports/football1.png">
										</div>
										<span class="morenew">+ 5</span>

									</div>
								</div>
								<div class="row">
									<div class="text-center col-sm-12"><a class="readmore-blog orange-btn btn-block" href="user-book-slot.php">Book Now</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include 'common/footer.php';?>
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
	<?php include 'common/foot.php';?>
</body>
<script src="assets/js/datedropper.min.js"></script>
<script>
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
	$('.calanderpopover').popover({			
			content: '<div class="table-responsive"><table class="table table-sm timimg-table"><tbody><tr><td><strong>Monday</strong></td><td>9:00 AM – 7:00 PM</td></tr><tr><td><strong>Tueday</strong></td><td>9:00 AM – 7:00 PM</td></tr><tr><td><strong>Wednesday</strong></td><td>9:00 AM – 7:00 PM</td></tr><tr class="bold"><td><strong>Thursday</strong></td><td>9:00 AM – 7:00 PM</td></tr><tr><td><strong>Friday</strong></td><td>9:00 AM – 7:00 PM</td></tr><tr><td><strong>Saturday</strong></td><td>9:00 AM – 7:00 PM</td></tr><tr><td><strong>Sunday</strong></td><td class="text-danger text-center">Closed</td></tr></tbody></table></div>', 
			html: true, 
			placement: "bottom",
			trigger: "hover"
			
		});

		
jQuery("#clearbtn").on("click", function(){
	$(".searchsportsname").find("input").attr("checked", false);
	$("input").val("");
	$("input:checked").prop("checked", false);
	$(".searchsportsname").find("label").removeClass("activegame");
	$("#gorupedfilter").find("input[type='checkbox']").attr("checked", false);
	$('input[type=checkbox]').removeAttr('checked'); });

$(".favourite .fa").on("click", function(){
	$(".favourite .fa").show();

$(this).hide();
	if($('.fa-heart').is(':visible'))
	{
		console.log('df');
	}
});
</script>

</html>