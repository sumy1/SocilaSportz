	  <!DOCTYPE html>
	  <html>
	  <head>
		<title>Social Sportz</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
		<meta name="MobileOptimized" content="width">
		<meta name="HandheldFriendly" content="true">
		<meta http-equiv="x-ua-compatible" content="IE=edge">
		<!-- Fonts For Heading & SubHeadings -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
		
		<?php $this->load->view('public/common/head');?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/pignose.calendar.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/bootstrap-clockpicker.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/jquery-clockpicker.min.css');?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/public/css/timedropper.min.css');?>">
		<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css');?>">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
         <style>
		main.l-main{min-height: 900px;}
		#errortodates{bottom:-22px;}
		/*#bookinglist_wrapper{margin-top: 25px}*/
	</style>
	  </head>


	  <body class="dashboard sidebar-is-expanded" id="createevent">
		<div class="clearfix"></div>
		<?php $this->load->view('public/common/dashboard-sidebar');?>

		<main class="l-main">
		  <!-- bradcrumb start -->
		  <div class="header-data">
			<div class="container">
			  <div class="row">
				<div class="col-md-12">
				  <div class="top-head-nav clearfix">
					<div class="page-title float-md-left">
					  <h1>My Event </h1>
					</div>
					<div class="navigation-bread float-md-right">
					  <nav aria-label="breadcrumb">
						<ol class="breadcrumb"> 
						  <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">My Dashboard</a></li>  
						  <li class="breadcrumb-item active" aria-current="page">My Event</li>
						</ol>
					  </nav>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
	<!-- bradcrumb end -->

<div id="event_page"></div>


		  
	</main>
<div class="modal fade edit_profile_modal" id="eventdetaillistusers" role="dialog">
<div class="modal-dialog">
		<div id="booking_event_views">
		</div>
</div>
</div>



	<div class="loader">
	<div class="">
		<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
	</div>
</div>
	<!-- Footer Include Here -->
	<?php $this->load->view('public/common/footer');?>


	</div>

	<?php $this->load->view('public/common/foot');?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=base_url('assets/public/js/dropify.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/public/js/pignose.calendar.min.js');?>"></script>
	 <script type="text/javascript" src="<?=base_url('assets/public/js/timedropper.min.js');?>"></script>

	<script type="text/javascript" src="<?=base_url('assets/public/js/pignose.calendar.full.min.js');?>"></script>

	<script src="<?=base_url('assets/public/js/datedropper.min.js');?>"></script>
	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	<script>
	$(document).on("click", ".booking_event_ajax", function(){
	 let booking_order_id=$(this).find("input").val();
	 showingLoader();
	  $.ajax({
			 type : 'POST',
			 url :  '<?=base_url('facility/event/event_view_model_ajax');?>',
			 data : {booking_order_id:booking_order_id},
			 success:function(res){
				 hiddingLoader();
			  $("#booking_event_views").html(res['_html']);
			}	
		});
});

		$( ".time" ).timeDropper({
			setCurrentTime: false
		});
	$(window).on('load',function() {
	$(".loader").fadeOut('slow');
	});

	function showingLoader(){
	$(".loader").fadeIn(200);
	//$(".loader").fadeOut(1000);
	}
	function hiddingLoader(){
	//$(".loader").fadeIn(200);
	$(".loader").fadeOut(1000);
	}
	

	  jQuery('.slottimedash').timeDropper();
	  $('#Dates').dateDropper();
	  jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
	  jQuery(document).on("click", '.hamburger-toggle', function(){
		jQuery("#rnr-logo .logo__txt img").show();
	  });
	  "use strict";

	  var Dashboard = function () {
		var global = {
		  tooltipOptions: {
			placement: "right"
		  },
		  menuClass: ".c-menu"
		};

		var menuChangeActive = function menuChangeActive(el) {
		  var hasSubmenu = $(el).hasClass("has-submenu");
		  $(global.menuClass + " .is-active").removeClass("is-active");
		  $(el).addClass("is-active");

		  // if (hasSubmenu) {
		  //  $(el).find("ul").slideDown();
		  // }
		};

		var sidebarChangeWidth = function sidebarChangeWidth() {
		  var $menuItemsTitle = $("li .menu-item__title");

		  $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
		  $(".hamburger-toggle").toggleClass("is-opened");

		  if ($("body").hasClass("sidebar-is-expanded")) {
			$('[]').tooltip("destroy");
		  } else {
			$('[]').tooltip(global.tooltipOptions);
		  }
		};

		return {
		  init: function init() {
			$(".js-hamburger").on("click", sidebarChangeWidth);

			$(".js-menu li").on("click", function (e) {
			  menuChangeActive(e.currentTarget);
			});

			$('[]').tooltip(global.tooltipOptions);
		  }
		};
	  }();

	  Dashboard.init();
	  //# sourceURL=pen.js
	</script>

	<script>

	  jQuery('.slottimedash').timeDropper();
	  $('#eventsdate,#eventedate,#bookingsdate, #bookingedate').dateDropper();
	  jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
	  jQuery(document).on("click", '.hamburger-toggle', function(){
		jQuery("#rnr-logo .logo__txt img").show();
	  });
	  "use strict";

	  var Dashboard = function () {
		var global = {
		  tooltipOptions: {
			placement: "right"
		  },
		  menuClass: ".c-menu"
		};

		var menuChangeActive = function menuChangeActive(el) {
		  var hasSubmenu = $(el).hasClass("has-submenu");
		  $(global.menuClass + " .is-active").removeClass("is-active");
		  $(el).addClass("is-active");

		  // if (hasSubmenu) {
		  //  $(el).find("ul").slideDown();
		  // }
		};

		var sidebarChangeWidth = function sidebarChangeWidth() {
		  var $menuItemsTitle = $("li .menu-item__title");

		  $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
		  $(".hamburger-toggle").toggleClass("is-opened");

		  if ($("body").hasClass("sidebar-is-expanded")) {
			$('[]').tooltip("destroy");
		  } else {
			$('[]').tooltip(global.tooltipOptions);
		  }
		};

		return {
		  init: function init() {
			$(".js-hamburger").on("click", sidebarChangeWidth);

			$(".js-menu li").on("click", function (e) {
			  menuChangeActive(e.currentTarget);
			});

			$('[]').tooltip(global.tooltipOptions);
		  }
		};
	  }();

	  Dashboard.init();
	  //# sourceURL=pen.js
	</script>

	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	<script>
	  jQuery(".hamburger-toggle").on("click", function(){jQuery("body").toggleClass("sidebar-is-expanded"); jQuery(this).toggleClass('is-opened');});
	  $(document).ready(function () {
	   $("#selectAll").click(function () {
		$(".selectcheck").attr('checked', this.checked);
	  });
	 });
	  $('.filter_prodcuts').hide();
	  $('#toggleFilter').click(function(event) {
	   $('.filter_prodcuts').slideToggle();
	 });
	  jQuery(document).on("click", '.hamburger-toggle', function(){
	   jQuery("#rnr-logo .logo__txt img").show();
	 });


	  "use strict";

	  var Dashboard = function () {
	   var global = {
		tooltipOptions: {
		 placement: "right"
	   },
	   menuClass: ".c-menu"
	 };

	 var menuChangeActive = function menuChangeActive(el) {
	  var hasSubmenu = $(el).hasClass("has-submenu");
	  $(global.menuClass + " .is-active").removeClass("is-active");
	  $(el).addClass("is-active");

			// if (hasSubmenu) {
			// 	$(el).find("ul").slideDown();
			// }
		};
		var sidebarChangeWidth = function sidebarChangeWidth() {
			var $menuItemsTitle = $("li .menu-item__title");

			$("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
			$(".hamburger-toggle").toggleClass("is-opened");

			if ($("body").hasClass("sidebar-is-expanded")) {
				$('[data-toggle="tooltip"]').tooltip("destroy");
			} else {
				$('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
			}
		};


		return {
			init: function init() {
				$(".js-hamburger").on("click", sidebarChangeWidth);

				$(".js-menu li").on("click", function (e) {
					menuChangeActive(e.currentTarget);
				});

				$('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
			}
		};
	  }();

	  Dashboard.init();
	  //# sourceURL=pen.js

	  // datepicker
	  $(function() {
		$('input.calendar').pignoseCalendar({
			format: 'DD-MM-YYYY' // date format string. (2017-02-02)
		});
	  });

	 /* jQuery("#addcreateevent,#editcreateevent").on("click", function(){
		jQuery(this).parents(".packagecreat").after('<div class="packagecreat row"><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="usercity" class="bmd-label-floating">Price</label> <input type="text" class="form-control"> <i class="fa fa-inr prefix"></i> <span id="errCity" class="error"> </span></div></div><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="usercity" class="bmd-label-floating">Price Detail</label> <input type="text" class="form-control"> <i class="fa fa-inr prefix " aria-hidden="true"></i> <span id="errCity" class="error"> </span></div></div><div class="col-md-3"><div class="form-group bmd-form-group is-filled" style="margin-top: 5px;"> <label for="usercity" class="bmd-label-floating">Total Slot/Day</label> <select class="form-control" id="kitquantityoutdoor"><option value="">Select Number</option><option class="abc" value="1">1</option><option class="abc" value="2">2</option><option class="abc" value="3">3</option> </select> <i class="fa fa-sort-numeric-asc prefix"></i> <span id="errnucourts" class="error"></span></div></div><div class="col-sm-1"> <a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm deletepackagecreat" ><i class="fa fa-trash "></i><div class="ripple-container"></div><div class="ripple-container"></div></a></div></div>')

		setInterval(function(){
		  jQuery('.deletepackagecreat').on("click", function(){
			jQuery(this).parents(".packagecreat.row").remove()
		  });
		},200);

	  });*/
	  // time
	  $('.timeshow').clockpicker();





	</script>



	  <!-- <script type="text/javascript">
	  $('.clockpicker').clockpicker();
	</script> -->
	<script type="text/javascript">
	 $( ".clockpicker" ).timeDropper({

		// custom time format
		format: 'h:mm a',

		// auto changes hour-minute or minute-hour on mouseup/touchend.
		autoswitch: false,

		// sets time in 12-hour clock in which the 24 hours of the day are divided into two periods. 
		meridians: false,

		// enable mouse wheel
		mousewheel: false,

		// auto set current time
		setCurrentTime: true,

		// fadeIn(default), dropDown
		init_animation: "fadein",

		// custom CSS styles
		primaryColor: "#1977CC",
		borderColor: "#1977CC",
		backgroundColor: "#FFF",
		textColor: '#555'
		
	  });
	</script>
	<script type="text/javascript">
	 $( "#userphone1" ).timeDropper({

		// custom time format
		format: 'h:mm a',

		// auto changes hour-minute or minute-hour on mouseup/touchend.
		autoswitch: false,

		// sets time in 12-hour clock in which the 24 hours of the day are divided into two periods. 
		meridians: false,

		// enable mouse wheel
		mousewheel: false,

		// auto set current time
		setCurrentTime: true,

		// fadeIn(default), dropDown
		init_animation: "fadein",

		// custom CSS styles
		primaryColor: "#1977CC",
		borderColor: "#1977CC",
		backgroundColor: "#FFF",
		textColor: '#555'
		
	  });
	</script>
	<script type="text/javascript">
	 $('.dropify').dropify();
	 jQuery("#eventbanner").siblings(".dropify-message").find("p").text("Upload Event Banner");

	</script>


	<script>

	  $(document).on('click', '.weekoff label', function () {
		if($(this).find("input").is(':checked'))
		{
		  $(this).find("input").attr('checked', false);
		  $(this).removeClass('active');
		}

		else
		{
		  $(this).find("input").attr('checked', true);
		  $(this).addClass('active');
		}


	  });

	  

	  var maxLength = 200;
	  $('textarea').keyup(function() {
		var textlen = maxLength - $(this).val().length;
		$('#rchars').text(textlen);
	  });



	  $(document).ready(function(){
	setTimeout(function(){
    var fac_id =$("#headeracademyfacility option:selected" ).val();
	action='fac_booking_div';
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/event/create_event',	
			data: {fac_id:fac_id,action:action},
			success:function(res){
				$("#event_page").html(res['_html']);
 				//$('#facilityacadelisting').DataTable();
 				//jQuery('.slotreplica .timeclock').off().timeDropper();
				//jQuery("#slotstartdate, #slotenddate").off().dateDropper();
			}	
			});
		},700);
		});
	</script>


	</body>
	</html>	