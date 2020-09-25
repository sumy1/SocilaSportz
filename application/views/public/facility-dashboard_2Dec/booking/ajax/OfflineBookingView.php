
<div class="container">


	<div class="show_datatable1" >
		<ul class=" id="bookinglist"><li>Booking List</a></li>
			

		</ul>


		</div>
			<div id="menu1" >
				<div class="row">
					<div class="col-md-12">
						<div class="main_container_dashboard">
							<div class="row">
								<div class="col-md-6">
									<div class="stats">
										<ul class="list-inline">
											<li class="list-inline-item">
												<div class="stat-contain no-border clearfix">
													<div class="icon float-left">Total</div>
													<span class="badge badge-primary float-right"><?=$total_booking_count?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Approved</div>
													<span class="badge badge-success float-right"><?=$total_confirmed_booking_count?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Pending</div>
													<span class="badge badge-warning float-right"><?=$total_pending_booking_count?></span>
												</div>
											</li>
											<li class="list-inline-item">
												<div class="stat-contain clearfix">
													<div class="icon float-left">Rejected</div>
													<span class="badge badge-secondary float-right"><?=$total_rejected_booking_count?></span>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<ul class="list-inline top_btns_action">
										<li class="list-inline-item">

											<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter</a>
										</li>

									</ul>
								</div>
							</div>

							<!-- <div class="filter_prodcuts" style="display: none;"> -->
								<div class="filter_prodcuts">
									<ul class="list-inline filter_products_list">
										<li class="list-inline-item"><h5 class="title"><i class="fa fa-filter"></i> Filter By</h5></li>
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm bmd-form-group is-filled" style="margin-top: 5px;">
												<label for="businessName" class="bmd-label-floating">Sports Name</label>
												<select class="form-control" id="sportslist">
													<option selected="" value="">Please Select SportS</option>
													<?php foreach ($fac_sports as $sport){?>
													<option value="<?=$sport->sport_id;?>"><?=$sport->sport_name;?></option>
													<?php } ?>									
												</select>
												<i class="fas fa-percentage prefix"></i>
											</div>
										</li>
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm bmd-form-group">
												<label for="businessName" class="bmd-label-floating">From Date</label>
												<input type="text" class="form-control datepicker" id="from_date" data-translate-mode="false"  data-large-default="true" data-format="d-m-Y" data-large-mode="true" data-init-set="false">
												<i class="fa fa-calendar prefix"></i>
											</div>
										</li>
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm bmd-form-group">
												<label for="businessName" class="bmd-label-floating">To Date</label>
												<input type="text" class="form-control datepicker" id="to_date" data-translate-mode="false" data-format="d-m-Y" data-large-default="true" data-large-mode="true" data-init-set="false">
												<i class="fa fa-calendar prefix"></i>
											</div>
										</li>
										<li class="list-inline-item">
											<div class="btn-container">
												<a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn"><i class="fa fa-search"></i> Search</a>
											</div>
										</li>
									</ul>
								</div>		
								<hr>

								<div id="booking_list_tabel" class="table-responsive"></div>

							</div>

						</div>

					</div>
				</div>


	</div>
	

	<script>

		$(document).ready(function(){
			var fac_id =$("#headeracademyfacility option:selected" ).val();
			var fac_name =$("#headeracademyfacility option:selected" ).text();
			$.ajax({
				type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/offline_booking_list_tabel',	
			data: {fac_id:fac_id,fac_name:fac_name},
			success:function(res){
				$("#booking_list_tabel").html(res['_html']);
			}	
		});

		});




		$('.search_btn').on('click', function(e) {
			var fac_id =$("#headeracademyfacility option:selected" ).val();
			var sport_id =$("#sportslist option:selected" ).val();
			var from_date =$("#from_date" ).val();
			var to_date =$("#to_date").val();
	//alert(from_date);
	
	action='booking_filter';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/offline_booking_list_tabel',	
			data: {fac_id:fac_id,sport_id:sport_id,from_date:from_date,to_date:to_date,action:action},
			success:function(res){
				$("#booking_list_tabel").html(res['_html']);
			}	
		});

});
</script>

