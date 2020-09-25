<style>
#batchlisting{display: none;}
.redtrial label
{
	font-size: 12px;
}
</style>

<div class="container slotwrapper">

				<div class="clearfix"></div>
				<div class="row">

					<ul class="nav nav-tabs">
						<?php if($fac_details->fac_type=='facility'){ ?>
						<li><a class="nav-link active" data-toggle="tab" href="#create_slot_form">Facility</a></li>
						<li><a class="nav-link" data-toggle="tab" id="slotlistingdata" href="#slotlisting">Slot Listing</a></li>


						<?php }
						else if($fac_details->fac_type=='academy'){?>
						<li><a class="nav-link academytabbing" data-toggle="tab" href="#batchacademy">Academy</a></li>
						<li><a class="nav-link batchlistingtabbing" id="batchlistingdata" data-toggle="tab" href="#batchlisting">Batch Listing</a></li>
						<?php } ?>
						
						
					</ul>

					<?php if($fac_details->fac_type=='facility'){ ?>
					<div class="tab-content">
					<form id="create_slot_form" name="create_slot_form" class="tab-pane fade in active">
						<div id="slotfacility" >
							
							<div class="row">
								<div class="col-sm-12 titleheading">
									<div class="pull-left"><strong>Create New Slot</strong></div>

								</div>

								<div class="col-md-6">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="gender" class="bmd-label-floating">Facility Name</label>
										<select class="form-control" id="fac_name" name="fac_name">
											<option value="<?=$fac_details->fac_id;?>"><?php if($fac_details->fac_name!='') echo $fac_details->fac_name;?></option>
										</select>	<i class="fa fa-university prefix"></i>
										<span id="errSport" class="error"></span>	
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group is-focused" style="margin-top: 5px;">
										
										<select class="form-control" id="fac_sport" name="sportslist">
											<option selected value="">Please select sport</option>
											<?php
											if (isset($fac_sports) && $fac_sports!='') {
												
											 foreach ($fac_sports as $fac_sport) { ?>
											<option value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
											<?php } } ?>
										</select>	<i class="fa fa-futbol-o prefix"></i>
										<span id="errfac_sport" class="error"></span>	
									</div>
								</div>
							</div>
								

							<div class="slotreplica">
								<div class="row">

									
									<div id="plusright">
										<a href="javascript:void(0)" class="btn btn-raised btn-success btn_add_sm" ><i class="fa fa-plus"></i><div class="ripple-container"></div></a>


									</div>
								</div>

								<div class="clearfix"></div>

								<div class="row">

									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="useremail" class="bmd-label-floating datepicker">Start Date</label>
											<input type="text"  data-format="d-m-Y"  class="form-control" id="slotstartdate" name="slotstartdate[]" data-large-mode="true" data-large-default="true">
											<i class="fa fa-calendar prefix" aria-hidden="true"></i>
											<span id="errslotstartdate" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="useremail" class="bmd-label-floating datepicker">End Date</label>
											<input type="text" data-format="d-m-Y" class="form-control" id="slotenddate" name="slotenddate[]" data-large-mode="true" data-large-default="true">
											<i class="fa fa-calendar prefix" aria-hidden="true"></i>
											<span id="errslotenddate" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="useremail" class="bmd-label-floating datepicker">Start Time</label>
											<input type="text" class="timeclock form-control" id="slotstarttime" name="slotstarttime[]">
											<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
											<span id="errSlotstarttime" class="error"> </span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="useremail" class="bmd-label-floating">End Time</label>
											<input type="text" class="form-control timeclock " id="slotendtime" name="slotendtime[]">
											<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
											<span id="errslotendtime" class="error"> </span>
										</div>
									</div>
									
									<div class="col-md-4 bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="gender" class="bmd-label-floating">Categories</label>

										<select class="form-control datelist" id="label_name" name="label_name[]" style="margin-left:7px;" >
											<option value="0">Select Categories</option>
											<?php
											if (isset($batch_slot_type) && $batch_slot_type!='') {
												
											 foreach ($batch_slot_type as $batch_slot_types) { ?>
											<option value="<?=$batch_slot_types->batch_slot_type_id;?>"><?=$batch_slot_types->batch_slot_type;?></option>
											 	<?php 

											 }
											}


											  ?>
											
											

										</select>	<i class="fa fa-list-alt prefix"></i>
										<span id="errlabel_name" class="error"></span>	
									</div>

									
									<div class="col-md-5">
										<label for="slotprice" class="bmd-label-floating " style="color:#000;">Working Days</label>
										<ul class="weekoff">
											 <?php foreach ($week_days as $week_day) {?>
											<li class="monday">
												<label class="radio-inline  btn btn-default active" id="normalradio">
													<input type="checkbox" checked name="day0[]" value="<?=$week_day->day;?>"><span class="bmd-radio"></span>
												<?=$week_day->day;?></label>
											</li>
											<?php } ?>
											
										</ul>

									</div>

									<div class="col-md-3">
										<div class="panel-heading12">
											<input type="checkbox" name="kit_aval[]" class="checkboxenable"> Is kit Available ?

											<span id="errPhone" class="error"> </span>
										</div>
									</div>

									<div class="col-md-4 priceforavaialable" >
										<div class="form-group bmd-form-group" style="margin-top:-24px">
											<label for="usercity" class="bmd-label-floating">Price/Day</label>
											<i class="fa fa-rupee prefix"></i>
											<input type="text" class="form-control " id="kitprice" name="kitprice[]" onkeypress="validate(event)">
										</div>
									</div>
								</div>	


								<div class="row">
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="slotprice" class="bmd-label-floating">Price</label>
											<input type="text" class="form-control" id="slotprice" name="slotprice[]" onkeypress="validate(event)">	<i class="fa fa-rupee prefix"></i>

											<span id="errslotprice" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2 nopadleft nopadright">
										<div class="form-group bmd-form-group">
											<label for="facilityname1" class="bmd-label-floating">Max. Participants</label>
											<input type="text" class="form-control" id="max_participanets" name="max_participanets[]" onkeypress="validate(event)">	<i class="fa fa-sort-numeric-asc prefix"></i>

											<span id="errmax_participanets" class="error"> </span>
										</div>
									</div>

									

									

									<div class="col-md-3 bmd-form-group is-filled" style="margin-top: 5px; margin-left: 15px;">
										<label for="court_type" class="bmd-label-floating">Court Type</label>

										<select class="form-control datelist" name="court_type[]" id="court_type" style="margin-left:7px;">
											<option value="0">Court Type</option>
											<option value="Indoor">Indoor</option>
											<option value="Outdoor">Outdoor</option>

										</select>	<i class="fa fa-list-alt prefix"></i>
										<span id="errcourt_type" class="error"></span>	
									</div>

									<div class="col-md-5 nopadleft nopadright" style="    margin-left: -15px;">
										<div class="form-group bmd-form-group" style="margin-right: 25px;">
											<label for="court_desc" class="bmd-label-floating">Court Description</label>
											<input type="text" class="form-control" id="court_desc" name="court_desc[]">	<i class="fa fa-list-alt prefix"></i>

											<span id="errFacilityname1" class="error"> </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 text-right addslotwrapper">

								<ul class="list-inline business_detail_buttons">
									<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed listproceed1" id="fac_slot_save">Save<div class="ripple-container"></div></a>
									</li>
								</ul>
							</div>
						</div>
					</form>

						


						<div id="slotlisting" class="tab-pane fade table-responsive">
							<div class="row">
								<div class="col-md-6">
									<div class="stats">
										<ul class="list-inline">
											<li class="list-inline-item">
												<div class="stat-contain no-border clearfix">
													<div class="icon float-left">Total</div>
													<span class="badge badge-primary float-right"><?=$total_slot_count;?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Active</div>
													<span class="badge badge-success float-right"><?=$total_active_count;?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Daactive</div>
													<span class="badge badge-warning float-right"><?=$total_deactive_count;?></span>
												</div>
											</li>
											
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<ul class="list-inline top_btns_action">
										<li class="list-inline-item">
											<!-- <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter" data-toggle="tooltip" data-placement="top" title="Click here to filter"><i class="fa fa-filter"></i> Filter</a> -->
											<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter<div class="ripple-container"></div></a>
										</li>

									</ul>
								</div>
							</div>

							<div class="filter_prodcuts" style="">
								<ul class="list-inline filter_products_list">
									<li class="list-inline-item"><h5 class="title"><i class="fa fa-filter"></i> Filter By</h5></li>
									<li class="list-inline-item col-md-3">
										<div class="form-group is-focused bmd-form-group-sm bmd-form-group">
											
											<select class="form-control" id="sportslist">
												<option selected value="">Please select sport</option>
												<?php
											if (isset($fac_sports) && $fac_sports!='') {
												
											 foreach ($fac_sports as $fac_sport) { ?>
											<option value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
											<?php } } ?>
											</select>
											<i class="fas fa-percentage prefix"></i>
										</div>
									</li>
									<li class="list-inline-item col-md-3">
										<div class="form-group bmd-form-group-sm bmd-form-group">
											<label for="businessName" class="bmd-label-floating">From Date</label>
											<input type="text" class="form-control datepicker" id="from_date" data-translate-mode="false"  data-large-default="true" data-large-mode="true" data-init-set="false" data-format="d-m-Y">
											<i class="fa fa-calendar prefix"></i>
										</div>
									</li>
									<li class="list-inline-item col-md-3">
										<div class="form-group bmd-form-group-sm bmd-form-group">
											<label for="businessName" class="bmd-label-floating">To Date</label>
											<input type="text" class="form-control datepicker" id="to_date" data-translate-mode="false" data-large-default="true" data-large-mode="true" data-init-set="false" data-format="d-m-Y">
											<i class="fa fa-calendar prefix"></i>
										</div>
									</li>
									<li class="list-inline-item">
										<div class="btn-container">
											<a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn" id="slot_search"><i class="fa fa-search"></i> Search</a>
										</div>
									</li>
								</ul>
							</div>
							<hr>
							<div id="slot_listing_data"></div>
							
						</div>

					</div>	

					<?php }

if($fac_details->fac_type=='academy'){
					 ?>
<div id="batchacademy" class="tab-pane fade">

	<form id="create_batch_form" name="create_batch_form">

							<div class="row">
								<div class="col-sm-12 titleheading">
									<div class="pull-left"><strong>Create New Batch</strong></div>

								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="Academy" class="bmd-label-floating">Academy Name</label>
										<select class="form-control" id="academy_name" name="academy_name">
											<option value="<?=$fac_details->fac_id;?>"><?php if($fac_details->fac_name!='') echo $fac_details->fac_name;?></option>
										</select>
											<i class="fa fa-university prefix"></i>
										<span id="errAcademy" class="error"></span>	
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group bmd-form-group is-focused" style="margin-top: 5px;">
										<label for="Sport" class="bmd-label-floating">Sports</label>
										<select class="form-control" id="sport_id" name="sport_id">
											<option selected value="">Please select sport</option>
											<?php
											if (isset($fac_sports) && $fac_sports!='') {
												
											 foreach ($fac_sports as $fac_sport) { ?>
											<option value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
											<?php } } ?>
										</select>	<i class="fa fa-futbol-o prefix"></i>
										<span id="errAcademySport" class="error"></span>	
									</div>
								</div>
							</div>

							<div class="slotreplica">
								<div class="row">


									<div id="plusrightacademy">
										<a href="javascript:void(0)" class="btn btn-raised btn-success btn_add_sm" ><i class="fa fa-plus"></i><div class="ripple-container"></div></a>
									</div>


								</div>

								<div class="clearfix"></div>

								<div class="row" style="margin-left: 0px">


									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="facStartDate" class="bmd-label-floating datepicker">Start Date</label>
											<input type="text" data-format="d-m-Y" class="form-control datepicker" id="academystartdate" name="academystartdate[]" data-large-mode="true" data-large-default="true">
											<i class="fa fa-calendar prefix" aria-hidden="true"></i>
											<span id="errFacstarttime" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="facEndDate" class="bmd-label-floating datepicker">End Date</label>
											<input type="text" data-format="d-m-Y" class="form-control datepicker" id="academyenddate" name="academyenddate[]" data-large-mode="true" data-large-default="true">
											<i class="fa fa-calendar prefix" aria-hidden="true"></i>
											<span id="erracademystarttime" class="error"> </span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="academyStartTime" class="bmd-label-floating datepicker">Start Time</label>
											<input type="text" class="timeclock form-control" id="academystarttime" name="academystarttime[]">
											<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
											<span id="erracademystarttime" class="error"> </span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="academyEndtime" class="bmd-label-floating">End Time</label>
											<input type="text" class="form-control timeclock" id="academyendtime" name="academyendtime[]">
											<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
											<span id="errSlotendtime" class="error"> </span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="Student" class="bmd-label-floating">Max. Student</label>
											<input type="text" class="form-control" id="student" name="student[]" onkeypress="validate(event)" >	<i class="fa fa-sort-numeric-asc prefix"></i>

											<span id="errStudent" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group bmd-form-group redtrial">
											<label><input type="checkbox" id="is_trial" name="is_trial[]" class="trial"> Is trial available ?</label>


											<span id="errsTrial" class="error"> </span>
										</div>
									</div>


									<div class="col-md-4">
										<label for="slotprice" class="bmd-label-floating" style="color:#000;  margin-top:20px;">Working Days</label>
										<ul class="weekoff">
											<?php foreach ($week_days as $week_day) { ?>
											<li class="monday">
												<label class="radio-inline  btn btn-default active" id="normalradio">
													<input type="checkbox" checked name="academyday0[]" value="<?=$week_day->day;?>"><span class="bmd-radio"></span>
												<?=$week_day->day;?></label>
											</li>
											<?php } ?>
											</li>
										</ul>

									</div>



								</div>
								<hr>

								<div class="row" id="createacademyplan">


									<div class="col-md-3">
										<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
											<label for="plan" class="bmd-label-floating">Select Plan</label>
											<select class="form-control" id="academybatchtype" id="academyplan[]">
												<?php foreach ($batch_package as $package) { ?>
													<option value="<?=$package->package_id;?>"><?=$package->package_name;?></option>
												<?php } ?>
												
											</select>	<i class="fa fa-futbol-o prefix"></i>
											<span id="errPlan" class="error"></span>	
										</div>
									</div>

									
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<label for="slotprice" class="bmd-label-floating">Price</label>
											<input type="text" class="form-control" id="academybatchprice">	<i class="fa fa-rupee prefix"></i>

											<span id="errsSlotprice" class="error"> </span>
										</div>
									</div>

									<div class="col-md-2">
										<a  class="btn btn-sm orange-btn planadd" id="planadd">Add<div class="ripple-container"></div></a>
									</div>
									<hr>
							<div id="academyplanwrapper" class="col-sm-12">
								<div class="row">
									<div class="col-sm-12 titleheading">
									<div class="pull-left"><strong>Package Created</strong></div>

								</div>
								</div>
							</div>
								</div>
							</div>
							
							<div class="col-md-12 text-right addslotwrapper">

								<ul class="list-inline business_detail_buttons">
									<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed listproceed1 save2" id="sav_batch">Save<div class="ripple-container"></div></a>
									</li>
								</ul>
							</div>
						</div>
					</form>


						<div id="batchlisting" class="tab-pane fade table-responsive">
							<div class="row">
								<div class="col-md-6">
									<div class="stats">
										<ul class="list-inline">
											<li class="list-inline-item">
												<div class="stat-contain no-border clearfix">
													<div class="icon float-left">Total</div>
													<span class="badge badge-primary float-right"><?=$total_slot_count;?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Active</div>
													<span class="badge badge-success float-right"><?=$total_active_count;?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Deactive</div>
													<span class="badge badge-warning float-right"><?=$total_deactive_count;?></span>
												</div>
											</li>
										
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<ul class="list-inline top_btns_action">
										<li class="list-inline-item">
											<!-- <a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter" data-toggle="tooltip" data-placement="top" title="Click here to filter"><i class="fa fa-filter"></i> Filter</a> -->
											<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter<div class="ripple-container"></div></a>
										</li>

									</ul>
								</div>
							</div>

							<div class="filter_prodcuts" style="">
								<ul class="list-inline filter_products_list">
									<li class="list-inline-item"><h5 class="title"><i class="fa fa-filter"></i> Filter By</h5></li>
									<li class="list-inline-item col-md-3">
										<div class="form-group is-focused bmd-form-group-sm bmd-form-group">
											<label for="businessName" class="bmd-label-floating">Sports Name</label>
											<select class="form-control" id="sportslist">
												<option selected value="">Please select sport</option>
												<?php
											if(isset($fac_sports) && $fac_sports!='') {
												
											 foreach ($fac_sports as $fac_sport) { ?>
											<option value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
											<?php } } ?>
												
											</select>
											<i class="fas fa-percentage prefix"></i>
										</div>
									</li>
									<li class="list-inline-item col-md-3">
										<div class="form-group bmd-form-group-sm bmd-form-group">
											<label for="businessName" class="bmd-label-floating">From Date</label>
											<input type="text" class="form-control datepicker" id="from_date" data-translate-mode="false" data-large-default="true" data-large-mode="true" data-init-set="false" data-format="d-m-Y">
											<i class="fa fa-calendar prefix"></i>
										</div>
									</li>
									<li class="list-inline-item col-md-3">
										<div class="form-group bmd-form-group-sm bmd-form-group">
											<label for="businessName" class="bmd-label-floating">To Date</label>
											<input type="text" class="form-control datepicker" id="to_date" data-translate-mode="false" data-large-default="true" data-large-mode="true" data-init-set="false" data-format="d-m-Y">
											<i class="fa fa-calendar prefix"></i>
										</div>
									</li>
									<li class="list-inline-item">
										<div class="btn-container">
											<a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn" id="batch_search"><i class="fa fa-search"></i> Search</a>
										</div>
									</li>
								</ul>
							</div>
							<hr>
							<div id="batch_listing_data"></div>
						</div>

<?php }?>



				</div>



			</div>



			

			<script>
				var j = 0;

				jQuery("#plusright,#editplusright").on("click", function(){
					j++;

jQuery(this).parents(".slotreplica").after('<div class="slotreplica addmoreslot"><div class="row"><div id="plusright"> <a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm"> <i class="fa fa-trash"></i><div class="ripple-container"></div><div class="ripple-container"></div> </a></div></div><div class="clearfix"></div><div class="row"><div class="col-md-2"><div class="form-group bmd-form-group is-filled is-focused"> <label for="useremail" class="bmd-label-floating datepicker">Start Date</label> <input type="text" data-format="d-m-Y" class="form-control picker-input slot_start_date_'+j+'" name="slotstartdate[]" data-large-mode="true" data-large-default="true" data-id="datedropper-0" readonly=""> <i class="fa fa-calendar prefix" aria-hidden="true"></i> <span id="errSlotstartdate'+j+'" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group is-focused is-filled"> <label for="useremail" class="bmd-label-floating datepicker">End Date</label> <input type="text" data-format="d-m-Y" class="form-control picker-input slot_end_date" id="" name="slotenddate[]" data-large-mode="true" data-large-default="true" data-id="datedropper-1" readonly=""> <i class="fa fa-calendar prefix" aria-hidden="true"></i> <span id="errSlotstarttime" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group is-focused is-filled"> <label for="useremail" class="bmd-label-floating datepicker">Start Time</label> <input type="text" class="timeclock form-control td-input slot_start_time" id="" name="slotstarttime[]" readonly=""> <i class="fa fa-clock-o prefix" aria-hidden="true"></i> <span id="errSlotstarttime" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group is-focused is-filled"> <label for="useremail" class="bmd-label-floating">End Time</label> <input type="text" class="form-control timeclock td-input slot_end_time" id="" name="slotendtime[]" readonly=""> <i class="fa fa-clock-o prefix" aria-hidden="true"></i> <span id="errSlotendtime" class="error"> </span></div></div><div class="col-md-4 bmd-form-group is-filled" style="margin-top: 5px;"> <label for="gender" class="bmd-label-floating">Categories</label> <select class="form-control datelist label_name" id="" name="label_name[]" style="margin-left:7px;"><option>Select Categories</option> <?php if (isset($batch_slot_type) && $batch_slot_type!='') {foreach ($batch_slot_type as $batch_slot_types) { ?><option value="<?=$batch_slot_types->batch_slot_type_id;?>"><?=$batch_slot_types->batch_slot_type;?></option> <?php }} ?> </select> <i class="fa fa-list-alt prefix"></i> <span id="errGender" class="error"></span></div><div class="col-md-5"> <label for="slotprice" class="bmd-label-floating " style="color:#000;">Working Days</label><ul class="weekoff"><ul class="weekoff"> <?php foreach ($week_days as $week_day) { ?><li class="monday"><label class="radio-inline btn btn-default active" id="normalradio"><input type="checkbox" checked name="day'+j+'[]" value="<?=$week_day->day;?>"><span class="bmd-radio"></span><?=$week_day->day;?></label></li> <?php } ?></ul></ul></div><div class="col-md-3"><div class="panel-heading12"> <input type="checkbox" class="checkboxenable" name="kit_aval[]"> Is kit Available ?<span id="errPhone" class="error"> </span></div></div><div class="col-md-4 priceforavaialable"><div class="form-group bmd-form-group" style="margin-top:-24px"> <label for="slot_price" class="bmd-label-floating">Price/Day</label> <i class="fa fa-rupee prefix"></i> <input type="text" class="form-control slot_price" id="" name="kitprice[]" onkeypress="validate(event)"></div></div></div><div class="row"><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="slotprice" class="bmd-label-floating">Price</label> <input type="text" class="form-control" id="slotprice" name="slotprice[]" onkeypress="validate(event)"> <i class="fa fa-rupee prefix"></i><span id="" class="error"> </span></div></div><div class="col-md-2 nopadleft nopadright"><div class="form-group bmd-form-group"> <label for="max_participanets" class="bmd-label-floating">Max. Participants</label> <input type="text" class="form-control max_participanets" id="" name="max_participanets[] onkeypress="validate(event)"> <i class="fa fa-sort-numeric-asc prefix"></i><span id="errFacilityname1" class="error"> </span></div></div><div class="col-md-3 bmd-form-group is-filled" style="margin-top: 5px; margin-left: 15px;"> <label for="court_type" class="bmd-label-floating">Court Type</label> <select class="form-control datelist court_type" name="court_type[]" style="margin-left:7px;"><option>Court Type</option><option value="Indoor">Indoor</option><option value="Outdoor">Outdoor</option> </select> <i class="fa fa-list-alt prefix"></i> <span id="errGender" class="error"></span></div><div class="col-md-5 nopadleft nopadright" style=" margin-left: -15px;"><div class="form-group bmd-form-group" style="margin-right: 25px;"> <label for="Description" class="bmd-label-floating">Court Description</label> <input type="text" class="form-control" id="court_desc" name="court_desc[]"> <i class="fa fa-list-alt prefix"></i><span id="errFacilityname1" class="error"> </span></div></div></div></div>'); jQuery('.slotreplica .timeclock').off().timeDropper(); jQuery(".picker-input").off().dateDropper(); });





$('#fac_slot_save').click(function(event) {

var fac_sport = $("#fac_sport").val();
	var label_id = $("#label_name").val();
	var max_participanets = $("#max_participanets").val();
	var slotprice = $("#slotprice").val();
	var court_type = $("#court_type").val();
	var slotstartdate  = $("#slotstartdate").val();
	var slotenddate = $("#slotenddate").val();
	
		if(fac_sport == ''){
			$('#fac_sport').show();
			$('#errfac_sport').html('Please select sport');
			return false;
		}
		else{
			$('#errfac_sport').html('');
		}
		if(label_id == 0){
			$('#label_id').show();
			$('#errlabel_name').html('Please select Category');
			return false;
		}
		else{
			$('#errlabel_name').html('');
		}

		if(slotprice == ''){
			$('#slotprice').show();
			$('#errslotprice').html('Please enter slot price');
			return false;
		}
		else{
			$('#errslotprice').html('');
		}

		if(max_participanets == ''){
			$('#max_participanets').show();
			$('#errmax_participanets').html('Please enter participents');
			return false;
		}
		else{
			$('#errmax_participanets').html('');
		}

		if(court_type == 0){
			$('#court_type').show();
			$('#errcourt_type').html('Please select court');
			return false;
		}
		else{
			$('#errcourt_type').html('');
		}


		// for add more section

		    var slot_start_date = []; 
		    var n=0;
            $(".addmoreslot").each(function(){ 
            	n++;
            if($('.slot_start_date_'+n).val() == ''){ 
            	//alert(cls);

              slot_start_date.push('errSlotstartdate'+n);
            }          
        });

        if(slot_start_date.length>0 ){  
        $('#'+slot_start_date[0]).show();
         $('#'+slot_start_date[0]).html('please select start date');;
        //$('#errcourt_type').html('select start date');
        //$('html,body').animate({scrollTop: $("#err_pro_detail").offset().top - 120},'slow');
        return false;
        }
        else{
              $('#errcourt_type').html('');
        }




		//return false;



            var form = $('#create_slot_form')[0];
              var myFormData = new FormData(form);
              //myFormData.append('action', 'create_slot_form');
               

        $.ajax({
                url:'<?php echo base_url();?>facility/slot/create_slot',
                type: 'POST',
                data: myFormData,
                cache: false,
                processData: false,
                contentType: false,
                async: false,
                success:function(res){
                //alert(res); return false;
                if(res!='failed'){
                    swal({
                title : 'Slot Created successfully!',
                html : '',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                //$('#bankDetails').modal('hide');
                //$('#tab3-tab').trigger('click'); 
                }
                })
                }
                else{
                    $('#error_msg').show(); 
                    $('#error_msg').text("Network issue"); 
                }           

            }   

    });
    });


	var k = 0;

	jQuery("#plusrightacademy").on("click", function(){
		k++;
jQuery(this).parents(".slotreplica").after('<div class="slotreplica"><div class="row"><div id="plusrightacademy"> <a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm"><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div></div><div class="clearfix"></div><div class="row" style="margin-left: 0px"><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="facStartDate" class="bmd-label-floating datepicker">Start Date</label> <input type="text" data-format="d-m-Y" class="form-control" id="academystartdate" name="academystartdate[]" data-large-mode="true" data-large-default="true"> <i class="fa fa-calendar prefix" aria-hidden="true"></i> <span id="errFacstarttime" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="facEndDate" class="bmd-label-floating datepicker">End Date</label> <input type="text" data-format="d-m-Y" class="form-control" id="academyenddate" name="academyenddate[]" data-large-mode="true" data-large-default="true"> <i class="fa fa-calendar prefix" aria-hidden="true"></i> <span id="erracademystarttime" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="academyStartTime" class="bmd-label-floating datepicker">Start Time</label> <input type="text" class="timeclock form-control" id="academystarttime" name="academystarttime[]"> <i class="fa fa-clock-o prefix" aria-hidden="true"></i> <span id="erracademystarttime" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="academyEndtime" class="bmd-label-floating">End Time</label> <input type="text" class="form-control timeclock" id="academyendtime" name="academyendtime[]"> <i class="fa fa-clock-o prefix" aria-hidden="true"></i> <span id="errSlotendtime" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="Student" class="bmd-label-floating">Max. Student</label> <input type="text" class="form-control" id="student" name="student[]">	<i class="fa fa-sort-numeric-asc prefix"></i><span id="errStudent" class="error"> </span></div></div><div class="col-md-2"><div class="form-group bmd-form-group redtrial"> <label><input type="checkbox" id="is_trial" name="is_trial[]" class="trial"> Is trial available ?</label><span id="errsTrial" class="error"> </span></div></div><div class="col-md-4"> <label for="slotprice" class="bmd-label-floating" style="color:#000; margin-top:20px;">Working Days</label><ul class="weekoff"> <?php foreach ($week_days as $week_day) { ?><li class="monday"> <label class="radio-inline btn btn-default active" id="normalradio"> <input type="checkbox" checked name="academyday'+k+'[]" value="<?=$week_day->day;?>"><span class="bmd-radio"></span> <?=$week_day->day;?></label></li> <?php } ?></li></ul></div></div><hr><div class="row" id="createacademyplan"><div class="col-md-3"><div class="form-group bmd-form-group is-filled" style="margin-top: 5px;"> <label for="plan" class="bmd-label-floating">Select Plan</label> <select class="form-control" id="academybatchtype" id="academyplan[]"><?php foreach ($batch_package as $package) { ?><option value="<?=$package->package_id;?>"><?=$package->package_name;?></option><?php } ?></select>	<i class="fa fa-futbol-o prefix"></i> <span id="errPlan" class="error"></span></div></div><div class="col-md-2"><div class="form-group bmd-form-group"> <label for="slotprice" class="bmd-label-floating">Price</label> <input type="text" class="form-control" id="academybatchprice">	<i class="fa fa-rupee prefix"></i><span id="errsSlotprice" class="error"> </span></div></div><div class="col-md-2"> <a href="#" class="btn btn-sm orange-btn planadd" id="planadd">Add<div class="ripple-container"></div></a></div><hr><div id="academyplanwrapper" class="col-sm-12"><div class="row"><div class="col-sm-12 titleheading"><div class="pull-left"><strong>Package Created</strong></div></div></div></div></div></div>');
	jQuery('.slotreplica .timeclock').timeDropper();
	jQuery("#slotstartdate, #slotenddate, #academystartdate, #academyenddate").dateDropper();
	});
jQuery(document).on("click", ".planadd", function(e){
	
jQuery("#academyplanwrapper .titleheading").show();
	var cdf = jQuery(this).parents(".slotreplica").find("#academybatchtype option:selected").text();
	var plan_id = jQuery(this).parents(".slotreplica").find("#academybatchtype option:selected").val(); 
	var abc = jQuery(this).parents(".slotreplica").find("#academybatchprice").text(); jQuery('<div class="rowparent"><div class="row"><div class="col-sm-3 planname" style="padding-top:25px">'+cdf+'</div><div class="col-sm-2 planprice"><div class="form-group bmd-form-group is-filled is-focused"><label for="slotprice" class="bmd-label-floating">Price</label><input type="hidden" value="'+plan_id+'" name="plan_id'+k+'[]"><input type="text" value="'+abc+'" class="planpriceeditable form-control" name="academybatchprice'+k+'[]"></div></div><div class="deletesection1"><a href="javascript:void(0)" class="btn btn-raised btn_add_sm"><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div><hr class="fullwidth"></div></div>').insertAfter(jQuery(this).parents(".slotreplica").find('#createacademyplan'));
jQuery("#academybatchtype option:first-child").prop('selected', true); jQuery("#academybatchprice").val('');

 });


setTimeout(function(){
jQuery(".academytabbing").addClass('active');	
jQuery(".batchlistingtabbing").on("click", function(){jQuery("#batchlisting").show(); jQuery("#batchacademy").hide(); });

jQuery(".academytabbing").on("click", function(){jQuery("#batchlisting").hide(); jQuery("#batchacademy").show(); });

},500);

$('#sav_batch').click(function(event) {
	
            var form = $('#create_batch_form')[0];
              var myFormData = new FormData(form);
              //myFormData.append('action', 'create_slot_form');
               

        $.ajax({
                url:'<?php echo base_url();?>facility/slot/create_batch',
                type: 'POST',
                data: myFormData,
                cache: false,
                processData: false,
                contentType: false,
                async: false,
                success:function(res){
                //alert(res); return false;
                if(res!='failed'){
                    swal({
                title : 'batch Created successfully!',
                html : '',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                //$('#bankDetails').modal('hide');
                //$('#tab3-tab').trigger('click'); 
                }
                })
                }
                else{
                    $('#error_msg').show(); 
                    $('#error_msg').text("Network issue"); 
                }           

            }   

    });
    });


$('#slotlistingdata').on('click', function(e) {
	var fac_id =$("#headeracademyfacility option:selected" ).val();
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/slotListing',	
			data: {fac_id:fac_id},
			success:function(res){
				$("#slot_listing_data").html(res['_html']);
			}	
		});

});

$('#batchlistingdata').on('click', function(e) {
	var fac_id =$("#headeracademyfacility option:selected" ).val();
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/batchListing',	
			data: {fac_id:fac_id},
			success:function(res){
				$("#batch_listing_data").html(res['_html']);
			}	
		});

});

$('#slot_search').on('click', function(e) {
	var fac_id =$("#headeracademyfacility option:selected" ).val();
	var sport_id =$("#sportslist option:selected" ).val();
	var from_date =$("#from_date" ).val();
	var to_date =$("#to_date").val();
	
	action='slot_filter';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/slotListing',	
			data: {fac_id:fac_id,sport_id:sport_id,from_date:from_date,to_date:to_date,action:action},
			success:function(res){
				$("#slot_listing_data").html(res['_html']);
			}	
		});

});
$('#batch_search').on('click', function(e) {
	var fac_id =$("#headeracademyfacility option:selected" ).val();
	var sport_id =$("#sportslist option:selected" ).val();
	var from_date =$("#from_date" ).val();
	var to_date =$("#to_date").val();
	//alert(sport_id);
	
	action='batch_filter';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/batchListing',	
			data: {fac_id:fac_id,sport_id:sport_id,from_date:from_date,to_date:to_date,action:action},
			success:function(res){
				$("#batch_listing_data").html(res['_html']);
			}	
		});

});
	
jQuery(".datepicker").dateDropper();
		</script>