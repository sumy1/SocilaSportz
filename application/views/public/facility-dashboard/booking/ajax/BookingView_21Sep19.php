<div class="container">


	<div class="show_datatable1" style="margin-top:60px">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a data-toggle="tab" href="#home">Sportswise Booking</a></li>
			<li><a data-toggle="tab" href="#menu1" id="bookinglist">Booking List</a></li>

		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group search_mobile bmd-form-group  pull-right" style="margin-top: 5px; width:250px">
							<label for="mobileNumber" class="bmd-label-floating">Select Sports</label>
							<select class="form-control" id="sportdetail" style=" width: 100%">
								<option value="Cricket">Cricket</option>
								<option value="Cricket">Football</option>
							</select>
							<i class="fa fa-mobile-alt prefix"></i>
						</div>

					</div>

					<div class="col-md-12">
						<div id="currentmonth"><i class="fa fa-angle-left " id="prevmonth" onClick="prevmonth()" aria-hidden="true"></i> <span id="monthname"></span> <span id="yearname"></span> <i class="fa fa-angle-right" id="nextmonth" onClick="nextmonth()" aria-hidden="true"></i></div> 
						<div class="owl-carousel owl-theme dateRange checkbox_divs" id="dateRange">
							
						</div>

						<div id="bookingresultdaily">
							<div class="select_plan " data-toggle="buttons">
								<label class="btn">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								<label class="btn  booked" >
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">10:00 am - 12 am</span></h1>
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								<label class="btn">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								<label class="btn">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								
								<label class="btn">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								
								<label class="btn booked">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								<label class="btn booked">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								
								<label class="btn booked">
									
									<input type="checkbox" name="options" class="optionslot" autocomplete="off"> 
									<div class="plan">
										
										<h1 class="display-4"> <span class="amount">8:00 am - 10 am</span></h1>
										
										
									</div>
									<div class="ripple-container"></div><div class="ripple-container"></div>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								</label>
								
								
							</div>
						</div>


					</div></div>
				</div>
				<div id="menu1" class="tab-pane fade">
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
														<span class="badge badge-primary float-right">100</span>
													</div>
												</li>
												<li class="list-inline-item">
													<div class="stat-contain clearfix">
														<div class="icon float-left">Approved</div>
														<span class="badge badge-success float-right">75</span>
													</div>
												</li>
												<li class="list-inline-item">
													<div class="stat-contain clearfix">
														<div class="icon float-left">Pending</div>
														<span class="badge badge-warning float-right">25</span>
													</div>
												</li>
												<li class="list-inline-item">
													<div class="stat-contain clearfix">
														<div class="icon float-left">Rejected</div>
														<span class="badge badge-secondary float-right">02</span>
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
														<option selected="" value="">Please select sport</option>
														<?php foreach ($fac_sports as $sport){?>
														<option value="<?=$sport->sport_id;?>"><?=$sport->sport_name;?></option>
														<?php } ?>									
													</select>
													<i class="fas fa-percentage prefix"></i>
												</div>
											</li>
											<li class="list-inline-item col-md-3">
												<div class="form-group bmd-form-group-sm">
													<label for="businessName" class="bmd-label-floating">From Date</label>
													<input type="text" class="form-control datepicker" id="from_date" data-translate-mode="false"  data-large-default="true" data-format="d-m-Y" data-large-mode="true" data-init-set="false">
													<i class="fa fa-calendar prefix"></i>
												</div>
											</li>
											<li class="list-inline-item col-md-3">
												<div class="form-group bmd-form-group-sm">
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

									<div id="booking_list_tabel"></div>

								</div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
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
			var x = month[d.getMonth() + 1];
			var n = d.getMonth();

			

			function myFunction() {
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
					jQuery("#dateRange").append('<div class="item"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'  '  + month[n] +'</span><i class="fa fa-calendar"></i><i class="fa fa-check-circle"></i></div></a></div>');
					jQuery("#monthname").html(month[n]);
					jQuery("#yearname").html(abc);
					
				}
				triggerowl();

			}





			myFunction();


			jQuery("#nextmonth").on("click", function(){ 
				jQuery("#dateRange").remove();
				$('<div class="owl-carousel owl-theme dateRange checkbox_divs" id="dateRange"></div>').insertAfter("#currentmonth");

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
						jQuery("#dateRange").append('<div class="item"><div class="date_data"><input type="radio" name="rGroup" value="1" id="r1"/><span class="week">'+ cdf +'</span><span class="day">'+ i +'  '  + month[n] +'</span><i class="fa fa-calendar"></i><i class="fa fa-check-circle"></i></div></div>');
						jQuery("#yearname").html(abc);
						
					}

					if(hhh == "Dec")
					{
						
						jQuery("#dateRange").remove();
						$('<div class="owl-carousel owl-theme dateRange checkbox_divs" id="dateRange"></div>').insertAfter("#currentmonth");
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
							jQuery("#dateRange").append('<div class="item"><div class="date_data"><input type="radio" name="rGroup" value="1" id="r1"/><span class="week">'+ cdf +'</span><span class="day">'+ i +'  '  + 'Jan' +'</span><i class="fa fa-calendar"></i></div></div>');
							jQuery("#yearname").html(mmm);
							
						}	
						


					} 

					$('#dateRange').owlCarousel({
						items:7,
						margin: 5,
						autoplay : false,
						autoplayTimeout : 3500,
						autoplayHoverPause:true,
						smartSpeed:450,
						loop:false,	
						nav:true,
						dots : false,
						mouseDrag : true,
						touchDrag : true,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
						responsive:{
							320:{
								items:3
							},
							575:{
								items:4
							},
							768:{
								items:5
							},

							1200:{
								items:7
							}				
						}			
					});
					
					
					


				}, 500);


			}); 
			
			
			jQuery("#prevmonth").on("click", function(){ 
				jQuery("#dateRange").remove();
				$('<div class="owl-carousel owl-theme dateRange checkbox_divs" id="dateRange"></div>').insertAfter("#currentmonth");

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
						jQuery("#dateRange").append('<div class="item"><div class="date_data"><input type="radio" name="rGroup" value="1" id="r1"/><span class="week">'+ cdf +'</span><span class="day">'+ i +'  '  + month[n] +'</span><i class="fa fa-calendar"></i></div></div>');
						jQuery("#yearname").html(abc);
						
					}

					if(hhh == "Jan")
					{
						
						jQuery("#dateRange").remove();
						$('<div class="owl-carousel owl-theme dateRange checkbox_divs" id="dateRange"></div>').insertAfter("#currentmonth");
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
							jQuery("#dateRange").append('<div class="item"><div class="date_data"><input type="radio" name="rGroup" value="1" id="r1"/><span class="week">'+ cdf +'</span><span class="day">'+ i +'  '  + 'Dec' +'</span><i class="fa fa-calendar"></i></div></div>');
							jQuery("#yearname").html(mmm);
							
						}	
						


					} 
					$('#dateRange').owlCarousel({
						items:7,
						margin: 5,
						autoplay : false,
						autoplayTimeout : 3500,
						autoplayHoverPause:true,
						smartSpeed:450,
						loop:false,	
						nav:true,
						dots : false,
						mouseDrag : true,
						touchDrag : true,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
						responsive:{
							320:{
								items:3
							},
							575:{
								items:4
							},
							768:{
								items:5
							},

							1200:{
								items:7
							}				
						}			
					});
					
					
					


				}, 500);


			}); 
			
			
			
			function triggerowl()
			{
				
				jQuery( document).on("click", '.date_data', function(){jQuery('.date_data').removeClass("selected");jQuery(this).addClass("selected"); jQuery(this).find("input").attr("selected", true)});
				$('#dateRange').owlCarousel({
					items:7,
					margin: 5,
					autoplay : false,
					autoplayTimeout : 3500,
					autoplayHoverPause:true,
					smartSpeed:450,
					loop:false,	
					nav:true,
					dots : false,
					mouseDrag : true,
					touchDrag : true,
					navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					responsive:{
						320:{
							items:3
						},
						575:{
							items:4
						},
						768:{
							items:5
						},

						1200:{
							items:7
						}				
					}			
				});
				
			}

		</script>

		<script>
			
			
			$('#bookinglist').on('click', function(e) {
				var fac_id =$("#headeracademyfacility option:selected" ).val();
				var fac_name =$("#headeracademyfacility option:selected" ).text();
				$.ajax({
					type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/booking_list_tabel',	
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
			url:'<?php echo base_url();?>facility/booking/booking_list_tabel',	
			data: {fac_id:fac_id,sport_id:sport_id,from_date:from_date,to_date:to_date,action:action},
			success:function(res){
				$("#booking_list_tabel").html(res['_html']);
			}	
		});

});
</script>

