jQuery(document).ready(function(){
	jQuery(".toggle-icon").on("click", function(){jQuery(".mobile-menu").stop(true,true).toggleClass("open");});
	jQuery(".toggle-icon2").on("click", function(){jQuery(".listingnav ul").stop(true,true).slideToggle()});

});

jQuery("select").parent(".form-group").css("margin-top","5px")

$(document).ready(function() {

$('#shopTimingBtn').on("click", function(){
	jQuery("#facility-profile").removeClass("timenotselected");
	jQuery("#facility-profile").addClass("timealreadyselected");
});




function deletemassage()
{
	swal({
   title: 'Are you sure?',
   text: "You won't, be able to revert this",
   type: 'warning',
   showCancelButton: true,
   confirmButtonText: 'Yes, Delete it',
   cancelButtonText: 'Cancel'
});
}

jQuery('.btn-danger, .deletesports, .deleteacademyfacility, .fa-trash').on("click", function(){
deletemassage()
});

jQuery(".checkbox-inline").on("click", function(){
	jQuery("#aboutstadium").modal('show');
});



	setTimeout(function(){
		$( "#shopTiming .form-control.time" ).timeDropper();
		var url = window.location.href; jQuery("header .topnav li").each(function(){var cdf = jQuery(this).find("a").attr("href"); if(url.indexOf(cdf) > -1){jQuery("header .topnav li").removeClass("activenav"); jQuery(this).addClass("activenav")}});
	},200);

	setTimeout(function () {

		var $Input = $('input:-webkit-autofill');
		$Input.parent(".bmd-form-group").addClass('is-focused');
	}, 200);


	jQuery(".gridicon").on("click", function(){jQuery(".grid-view").show(); jQuery(".list-view").hide()});
	jQuery(".listicon").on("click", function(){jQuery(".list-view").show(); jQuery(".grid-view").hide();});


	$('.presslisting').slick({
		dots: false,
		nav:false,
		vertical: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		verticalSwiping: true,
		autoplay:true,
	});







	$('#facility-section,#academy-section,#event-section').owlCarousel({
		items:3,
		autoplay : true,
		autoplayTimeout : 3000,
		autoplayHoverPause:false,
		smartSpeed:450,
		margin:10,
		loop:true,
		nav:true,
		dots : true,
		mouseDrag : false,
		touchDrag : true,
		navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],	
				// animateIn : 'fadeIn',
				// animateOut : 'fadeOut',
				responsive:{
					// autoplayTimeout : 2000,
					// smartSpeed:400,
					320:{
						items:1,
						nav:false,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
					400:{
						items:1,
						nav:false,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
					600:{
						items:1,
						nav:false,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
					1000:{
						items:2,
						nav:false,
						loop:true,
						dots : true,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},

					1300:{
						items:3,
						nav:false,
						loop:true,
						dots : true,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
				}
			});

	$(window).scroll(function() {
		var height = $(window).scrollTop();
		if (height > 100) {
			$('#back2Top').fadeIn();
		} else {
			$('#back2Top').fadeOut();
		}
	});
	$(document).ready(function() {
		$("#back2Top").click(function(event) {
			event.preventDefault();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});

	});

	$('#slider-banner').owlCarousel({
		items:1,
		autoplay : false,
		autoplayTimeout : 3000,
		autoplayHoverPause:false,
		smartSpeed:450,
		loop:true,
		nav:true,
		dots : true,
		mouseDrag : false,
		touchDrag : true,
		nav:true,
		navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],	

	});


	$('#clientlogo').owlCarousel({
		items:3,
		autoplay : true,
		autoplayTimeout : 3000,
		autoplayHoverPause:false,
		smartSpeed:450,
		loop:true,
		nav:true,
		dots : true,
		mouseDrag : false,
		touchDrag : true,
		navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],	
				// animateIn : 'fadeIn',
				// animateOut : 'fadeOut',
				responsive:{
					// autoplayTimeout : 2000,
					// smartSpeed:400,
					320:{
						items:1,
						nav:false,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
					400:{
						items:2,
						nav:false,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
					600:{
						items:2,
						nav:false,
						navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
					},
					1000:{
						items:4,
						nav:false,
						loop:true,
						dots : false,
						
					},
				}
			});







});




function geoFindMe() {

	const status = document.querySelector('#status');
	const mapLink = document.querySelector('#map-link');

	mapLink.href = '';
	mapLink.textContent = '';

	function success(position) {
		const latitude  = position.coords.latitude;
		const longitude = position.coords.longitude;

		status.textContent = '';
		mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
		mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
	}

	function error() {
		status.textContent = 'Unable to retrieve your location';
	}

	if (!navigator.geolocation) {
		status.textContent = 'Geolocation is not supported by your browser';
	} else {
		status.textContent = 'Locating…';
		navigator.geolocation.getCurrentPosition(success, error);
	}

}



$('input[type=radio]').change(function() {
	if (this.value == 'Facility/Academy') {
	jQuery("#login-wrapper").addClass("facility-section");
	}
	else if (this.value == 'User') {
		jQuery("#login-wrapper").removeClass("facility-section");
	}

});

setInterval(function(){
$('input[type="text"],input[type="password"],input[type="email"] ').each(function()
{
 if( $(this).val() ) {
          $(this).parent(".form-group").addClass("is-focused");
    }
});
},200);

	jQuery(window).resize(function(){
		mobileNavVisible();	
	});