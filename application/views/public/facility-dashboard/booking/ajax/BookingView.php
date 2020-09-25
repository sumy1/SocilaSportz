<style>
#booking_detail{min-height:700px;}
#UserBookingDetail{margin-bottom:60px;}
.sportsselected .date_data .fa-calendar{    color: #fff !important;}
.dateRange{overflow:hidden;}
.total_slot_hidden, .booked_slot_hidden {display:none}
#bookingresultdaily .select_plan label.btn{pointer-events:none;}
#bookingresultdaily .select_plan label.btn.active{pointer-events:inherit;}
.fa-square{padding-left:10px;}
#home{margin-top:-30px;}
#calandaruserenquiry tbody {border:1px solid #ccc !important; box-sizing: border-box;}
#calandaruserenquiry{ width:97%;}
.newcalandarwrapper{margin:0px auto; width:700px; max-width: 100%;}
</style>

<div class="container">


	<div class="show_datatable1" style="margin-top:30px">
		<ul class="nav nav-tabs" role="tablist">
			<li><a class="nav-link active" data-toggle="tab" href="#home">Sports Booking</a></li>
			<li><a class="nav-link" data-toggle="tab" href="#menu1" id="bookinglist">Booking List</a></li>
			

		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<div class="row">


					<div class="col-sm-4"></div>

					<div class="col-sm-4">									
						<div class="form-group search_mobile bmd-form-group  pull-right is-focused" style="margin-top: 5px; width:100%">
							<a   id="selectsportsinitiator"><span id="s_text">Select Sports</span> <i class="fa fa-angle-down "  aria-hidden="true"></i></a>
							<a class="errorsportclass" id="errorsportclass"> Please Select Sports</a>
						</div>

					</div>

					<!-- <div class="col-sm-4">
						<div class="form-group bmd-form-group is-focused planeddashboard" style="margin-top: -25px;">
							<label for="gender" class="bmd-label-floating">Select Plan For 
							Academy</label>
							<select class="form-control" id="academybatchtype">
								<option>Select Plan</option>
								<option>One Month</option>
								<option>Two Month</option>
								<option>Three Month</option>
								<option>Four Month</option>
								<option>Trial</option>
							</select>	<i class="fa fa-futbol-o prefix"></i>
							<span id="errGender" class="error"></span>	
						</div>
					</div> -->


				</div>

				<div class="col-md-12 newcalandarwrapper">
					<span class="total_slot_hidden"></span>
					<span class="booked_slot_hidden"></span>
					<div id="currentmonth"><i class="fa fa-angle-left " id="prevmonth"  aria-hidden="true"></i> <span id="monthname"></span> <span id="yearname"></span> <i class="fa fa-angle-right" id="nextmonth" onClick="nextmonth()" aria-hidden="true"></i></div>

					<ul id="calandardays" >

						<li>Monday</li>
						<li>Tuesday</li>
						<li>Wednesday</li>
						<li>Thursday</li>
						<li>Friday</li>
						<li>Saturday</li>
						<li>Sunday</li>
					</ul>

					<ul id="smallcalandardays">
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
												<i class="fa fa-square" style="    color: #81c784; "></i> Available <i class="fa fa-square" style="    color: #ef5350;"></i> Full  <i class="fa fa-square" style="    color: #f78a65;"></i> Partialy Available <i class="fa fa-square" style="    color: #ccc;"></i> Unavailable <br>  

						</div>
					<div id="bookingresultdaily"></div>
				</div>
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
													<span class="badge badge-primary float-right"><?=$total_booking_count?></span>
												</div>
											</li>
											<!-- <li class="list-inline-item">
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
											</li> -->
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<ul class="list-inline top_btns_action">
										<li class="list-inline-item">
									
									<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn clearbtnbooking" id="clearbtn"><i class="fa fa-refresh"></i> Clear<div class="ripple-container"></div></a>
								</li>
										<li class="list-inline-item">

											<a href="javascript:void(0)" class="btn btn-raised btn-sm filter_btn" id="toggleFilter"><i class="fa fa-filter"></i> Filter</a>
										</li>

									</ul>
								</div>
							</div>
                           
							<!-- <div class="filter_prodcuts" style="display: none;"> -->
								<div class="filter_prodcuts">
									<ul class="list-inline filter_products_list">
										
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm bmd-form-group is-filled" style="margin-top: 5px;">
												<label for="businessName" class="bmd-label-floating">Sports Name</label>
												<select class="form-control" id="sportslist">
													<option selected="" value="">Select sport</option>
													<?php foreach ($fac_sports as $sport){?>
													<option value="<?=$sport->sport_id;?>"><?=$sport->sport_name;?></option>
													<?php } ?>									
												</select>
												<img alt="sports icon" class="sportsimgicon redicon" src="<?php echo base_url('assets/public/images/archery.png') ?>">
												<img alt="sports icon" class="sportsimgicon blueicon" src="<?php echo base_url('assets/public/images/sports_blue.png') ?>">
											</div>
										</li>
										<li class="list-inline-item col-md-3">
											<div class="form-group bmd-form-group-sm bmd-form-group is-filled" style="margin-top: 5px;">
												<label for="businessName" class="bmd-label-floating">Booking Method</label>
												<select class="form-control" id="booking_method">
													<option selected="" value="">Select Booking Method</option>
													
													<option value="online">Online</option>
													<option value="offline">Offline</option>
																					
												</select>
												<img alt="sports icon" class="sportsimgicon redicon" src="<?php echo base_url('assets/public/images/red_option.png') ?>">
												<img alt="sports icon" class="sportsimgicon blueicon" src="<?php echo base_url('assets/public/images/option_blue.png') ?>">

												
											</div>
										</li>
										<li class="list-inline-item col-md-2">
											<div class="form-group bmd-form-group-sm bmd-form-group">
												<label for="businessName" class="bmd-label-floating">From Date</label>
												<input type="text" class="form-control datepicker" id="from_date" data-translate-mode="false"  data-large-default="true" data-format="d-m-Y" data-large-mode="true" data-init-set="false">
												<i class="fa fa-calendar prefix"></i>
											</div>
										</li>
										<li class="list-inline-item col-md-2">
											<div class="form-group bmd-form-group-sm bmd-form-group">
												<label for="businessName" class="bmd-label-floating">To Date</label>
												<input type="text" class="form-control datepicker" id="to_date" data-translate-mode="false" data-format="d-m-Y" data-large-default="true" data-large-mode="true" data-init-set="false">
												<i class="fa fa-calendar prefix"></i>
												<span id="errortodate" class="error"></span>
											</div>
										</li>
										<li class="list-inline-item col-md-1">
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
		</div>
	</div>
</div>




<div class="modal fade edit_profile_modal" id="calandarselectsport" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" style="top:13px;" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title pl-3" id="exampleModalLongTitle">Select Sports</h5>

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

	jQuery(".searchsportsname li").on("click", function(){jQuery('.sportsname').find("input").attr("checked", false); jQuery(this).find("input").attr("checked", "checked"); jQuery('.sportsname').find("label").removeClass("activegame"); jQuery(this).find("label").addClass("activegame")});

</script>


<script>

	
	jQuery(".select_plan label").on("click", function(){
		jQuery(this).find("input").attr("selected", true);
		jQuery(this).toggleClass('active');
	});
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
			mmm = Number(mmm);
			rrr = Number(rrr);
			
			if(mmm==rrr){$(this).addClass("fullfilled");}
			if(mmm < rrr){$(this).addClass("fewavailable");}
if(mmm==0){$(this).removeClass('fewavailable').addClass("fullavailable")};			
if(mmm==0 & rrr==0){$(this).removeClass('fullfilled fullavailable').addClass('disabledate');};
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
	var n = d.getMonth();

		var d = new Date();
		var sdf= d; var ttt = month.findIndex(nextmonth);
		var x = month[ttt + 1];

			var n = d.getMonth();
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
		
				
	        var brt = [];
			var mgh = $('.total_slot_hidden').text();
			brt = mgh.split(',');
			
			var lrt = [];
			var gyu = $('.booked_slot_hidden').text();
			lrt = gyu.split(',');
			

			if(hhh == "Dec")
			{
	            
				jQuery("#monthname").text("Jan");
				jQuery("#yearname").text(Number(abc) + 1);
var cdf = bbb.split("Jan")[0];
			} 
				else{
				jQuery("#monthname").html(x);
				jQuery("#yearname").html(abc);
					var cdf = bbb.split(month[n])[0];	
				}


			jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">'+ lrt[i-1] +'/<span class="total_slot">'+ brt[i-1] +'</span></span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
				
				

			}
			var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
			jQuery("#dateRange .item:nth-child(1)").addClass(qqq);

			$('.date_data').each(function(){
				var mgh = $(this).find('.availableseat').text();
				var mmm = mgh.split('/')[0];
				var rrr = mgh.split('/')[1];
				mmm = Number(mmm);
				rrr = Number(rrr);
			if(mmm==rrr){$(this).addClass("fullfilled");}
			if(mmm < rrr){$(this).addClass("fewavailable");}
if(mmm==0){$(this).removeClass('fewavailable').addClass("fullavailable")};	
if(mmm==0 & rrr==0){$(this).removeClass('fullfilled fullavailable').addClass('disabledate');};
			});  

	var acd = $("#sportspopup ul li.selected .sport_name").text();
	  $("#s_text").text(acd);


		}, 1500);

var sport_id =$("input[name='sport_id']:checked").val();
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		var fac_name =$("#headeracademyfacility option:selected" ).text();
		var sport_id =$("input[name='sport_id']:checked").val();
		var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
		var sport_name = $(this).find('.sport_name').text();
		//var month =$("#monthname").text();
		var month =x;
		var year =$("#yearname").text();
			if(month==undefined){
				var month = 'Jan';
				 year =Number(year) + 1;
			}
			//alert(year);
		
		
		
		showingLoader();
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/availability_count_of_month',	
			data: {fac_id:fac_id,fac_name:fac_name,fac_type:fac_type,sport_id:sport_id,month:month,year:year},
			success:function(res){

				var result = JSON.parse(res);
				
				$('.booked_slot_hidden').text(result.sport_slot_booking_count);
				$('.total_slot_hidden').text(result.sport_slot_count);
				$('#s_text').text(sport_name);

				myFunction();
				hiddingLoader();


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
		var n = d.getMonth();
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
				
					if(hhh == "Jan")
			{
	            
				jQuery("#monthname").text("Dec");
				jQuery("#yearname").text(Number(abc) - 1);
				var cdf = bbb.split("Dec")[0];

			} 
				else{
				jQuery("#monthname").html(x);
				jQuery("#yearname").html(abc);
				var cdf = bbb.split(month[n])[0];
				}		
				
				
				
	var brt = [];
			var mgh = $('.total_slot_hidden').text();
			brt = mgh.split(',');
			
			var lrt = [];
			var gyu = $('.booked_slot_hidden').text();
			lrt = gyu.split(',');



			jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">'+ lrt[i-1] +'/<span class="total_slot">'+ brt[i-1] +'</span></span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
				

				
		

			}
			var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
			jQuery("#dateRange .item:nth-child(1)").addClass(qqq);

			$('.date_data').each(function(){
				var mgh = $(this).find('.availableseat').text();
				var mmm = mgh.split('/')[0];
				var rrr = mgh.split('/')[1];
				mmm = Number(mmm);
				rrr = Number(rrr);
			if(mmm==rrr){$(this).addClass("fullfilled");}
			if(mmm < rrr){$(this).addClass("fewavailable");}
if(mmm==0){$(this).removeClass('fewavailable').addClass("fullavailable")};	
if(mmm==0 & rrr==0){$(this).removeClass('fullfilled fullavailable').addClass('disabledate');};
			});  


	var acd = $("#sportspopup ul li.selected .sport_name").text(); 
	  $("#s_text").text(acd);

		}, 1500);
/*Ajax start*/
		var sport_id =$("input[name='sport_id']:checked").val();
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		var fac_name =$("#headeracademyfacility option:selected" ).text();
		var sport_id =$("input[name='sport_id']:checked").val();
		var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
		var sport_name = $(this).find('.sport_name').text();
		var month =x;
		var year =$("#yearname").text();
			if(month==undefined){
				var month = 'Dec';
				 year =Number(year) - 1;
			}
			
		showingLoader();
		$.ajax({
			type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/availability_count_of_month',	
			data: {fac_id:fac_id,fac_name:fac_name,fac_type:fac_type,sport_id:sport_id,month:month,year:year},
			success:function(res){

				var result = JSON.parse(res);
				
				$('.booked_slot_hidden').text(result.sport_slot_booking_count);
				$('.total_slot_hidden').text(result.sport_slot_count);
				$('#s_text').text(sport_name);
					 hiddingLoader();
				myFunction();


			}	
		});

		/*Ajax End*/


	}); 


/*		function calandardate(){
		jQuery(".date_data.selected").parents('.owl-item').each(function(){var yyy = jQuery("#monthname").text(); var ddd = jQuery("#yearname").text(); var mgh = jQuery(this).find(".day").text(); var cdf = mgh.split(" "); var kkk = cdf[0]; var eee = ddd + "-" + yyy + "-" + kkk; jQuery(this).append('<div style="display:none" id="ymd">'+eee+'</div>') });

		jQuery(".date_data.selected").parents(".owl-item").each(function(){var mgh = jQuery(this).find("#ymd").text(); var mghweek = jQuery(this).find(".week").text(); });
	}

	calandardate();*/


</script>

<script>

/*		$(document).ready(function(){
	setTimeout(function(){
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var sport_id =$("#sport_id option:checked" ).val();
    var fac_type =$("#headeracademyfacility option:selected" ).attr('fac_type');
    var datetime = $('#ymd').text();
  
	action='slot_batch_detail';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/slot_batch_detail',	
			data: {fac_id:fac_id,sport_id:sport_id,fac_type:fac_type,datetime:datetime,action:action},
			success:function(res){
				$("#bookingresultdaily").html(res['_html']);
 				//$('#facilityacadelisting').DataTable();
 				//jQuery('.slotreplica .timeclock').off().timeDropper();
				//jQuery("#slotstartdate, #slotenddate").off().dateDropper();
			}	
			});
		},700);
	});*/


	

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
		var booking_method =$("#booking_method option:selected" ).val();
		var from_date =$("#from_date" ).val();
		var to_date =$("#to_date").val();
				
		
		  if(sport_id == '' && booking_method == ''	 && from_date == '' && to_date == ''){
			$('#errortodate').html("Please select atleast one filter option");
			 return false;
		}
		else{
			$('#errortodate').html("");
		}

		if(from_date!='' && to_date!=''){
				var endateArr = [];
				var startateArr = [];
				endateArr = to_date.split('-');
				startateArr = from_date.split('-');
			
			// console.log(endateArr);
			// console.log(startateArr);
			
			if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
				$('#errortodate').html("");
				if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
					$('#errortodate').html("");
					if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
						$('#errortodate').html("");
					}else{
						$('#errortodate').show();
						$('#errortodate').html("To date should be greater than from date");
						return false;
					}	
					
					
				}else{
					$('#errortodate').show();
					$('#errortodate').html("To date should be greater than from date");
					return false;
				}	
			}else{
				$('#errortodate').show();
				$('#errortodate').html("To date should be greater than from date");
				return false;
			}
	
		}
	
		
	//alert(from_date);
	
	action='booking_filter';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/booking_list_tabel',	
			data: {fac_id:fac_id,sport_id:sport_id,from_date:from_date,to_date:to_date,booking_method:booking_method,action:action},
			success:function(res){
				$("#booking_list_tabel").html(res['_html']);
			}	
		});

});

$('.clearbtnbooking').on('click', function(e) {
	var fac_id =$("#headeracademyfacility option:selected" ).val();
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/booking_list_tabel',	
			data: {fac_id:fac_id},
			success:function(res){
				$("#booking_list_tabel").html(res['_html']);
			}	
		});
});








</script>

<script>




	$("#sportspopup li").on("click", function(){

		$('#calandarselectsport').trigger('click');
		$("#sportspopup li").removeClass('selected'); 
		jQuery(this).addClass("selected");
		jQuery(this).find("input:radio").prop("checked", true);

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
	var n = d.getMonth();

		var d = new Date();
		var sdf= d; var ttt = month.findIndex(nextmonth);
		var x = month[ttt];
			var n = d.getMonth();
		setTimeout(function(){ 

			jQuery("#monthname").html(hhh);
			var n = ttt; 

			jQuery("#dateRange").empty();




			var lastday = function(y,m){
				return  new Date(y, m, 0).getDate();
			}



			var count1 = lastday(abc, (n+1));
/*			alert(n);	
			alert(count1);*/


			i = 1;
			for(i; i <= count1; i++)
			{

				var getDaysInweek = function(year, month, i) {
					return new Date(year, month, i).getDate();
				};

				var ndf = new Date(abc,n,i);
				
				var bbb = ndf.toString();
		
				
	        var brt = [];
			var mgh = $('.total_slot_hidden').text();
			brt = mgh.split(',');
			
			var lrt = [];
			var gyu = $('.booked_slot_hidden').text();
			lrt = gyu.split(',');
			

             jQuery("#monthname").html(x);
				jQuery("#yearname").html(abc);
					var cdf = bbb.split(month[n])[0];

			jQuery("#dateRange").append('<div class="item"><a href="javascript:void(0)"><div class="date_data"><input type="radio" name="rGroup" value="1" /><span class="week">'+ cdf +'</span><span class="day">'+ i +'</span> <span class="availableseat">'+ lrt[i-1] +'/<span class="total_slot">'+ brt[i-1] +'</span></span>          <i class="fa fa-calendar"></i><i class="fa fa-check-circle" aria-hidden="true"></i></div></a></div>');
				
				

			}
			var rrr = jQuery("#dateRange .item:nth-child(1)").find(".week").text(); qqq = rrr.toLowerCase();
			jQuery("#dateRange .item:nth-child(1)").addClass(qqq);

			$('.date_data').each(function(){
				var mgh = $(this).find('.availableseat').text();
				var mmm = mgh.split('/')[0];
				var rrr = mgh.split('/')[1];
			mmm = Number(mmm);
			rrr = Number(rrr);
			if(mmm==rrr){$(this).addClass("fullfilled");}
			if(mmm < rrr){$(this).addClass("fewavailable");}

			if(mmm==rrr){$(this).addClass("fullfilled");}
			if(mmm < rrr){$(this).addClass("fewavailable");}
if(mmm==0){$(this).removeClass('fewavailable').addClass("fullavailable")};	
if(mmm==0 & rrr==0){$(this).removeClass('fullfilled fullavailable').addClass('disabledate');};
			});  

	var acd = $("#sportspopup ul li.selected .sport_name").text();
	  $("#s_text").text(acd);


		}, 1500);




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
				//$('#selectsportsinitiator').text(sport_name);
				$('#s_text').text(sport_name);


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
				$('html,body').animate({scrollTop: $("#bookingresultdaily").offset().top - 190},'slow');
			}	
		});


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

	});



</script>


<script>

	
	/*jQuery(document).on("click", ".select_plan label", function(){
	jQuery(this).find("input").attr("selected", true);
	jQuery(this).addClass('active');
	$('.calandaruserdetail').show();
	});*/
</script>