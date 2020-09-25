jQuery(document).ready(function(){
	jQuery(".toggle-icon").on("click", function(){jQuery(".mobile-menu").stop(true,true).toggleClass("open");});
	jQuery(".toggle-icon2").on("click", function(){jQuery(".listingnav ul").stop(true,true).slideToggle()});

});
setTimeout(function(){
$('textarea').each(function(){
   if($(this).val()!=""){$(this).parent(".bmd-form-group").addClass('is-filled');}});
},1000);
jQuery(".toggleicon").on("click", function(){jQuery(".topnav").slideToggle()});
jQuery(".toggleicondashboard").on("click", function(){jQuery(".l-sidebar").toggleClass('open');});
jQuery(".abusemarker").on("click", function(){jQuery(this).text("Review has reported").addClass("noclick"); });

$(".boxachievement").find('#selectHeading').on('change', function(event) {
             
			var titleValue = $(this).val();
			$(this).parents('#selectHeadingBox').hide();
			$(this).parents('.boxachievement').find('#hedingTitieEdited').show();
			$(this).parents('.boxachievement').find('#HeadingOneTitle').val(titleValue).focus().trigger('change');
		});



function achievementeditable(){

$(".boxachievement").each(function(){

		$(this).find('#selectOfferTitle').on('change', function(event) {

			var titleValue = $(this).val();
			$(this).parents('#selectBoxTitle').hide();
			$(this).parents('.boxachievement').find('#titleEdit').show();
			$(this).parents('.boxachievement').find('#titleValue').val(titleValue).focus().trigger('change');
		});
	
		$('#titleValue').on('keyup', function() {
			var key = event.keyCode || event.charCode;
			if( key == 8 || key == 46 ){
				var titleValue = $(this).val();
				if(titleValue.length == ''){
					$(this).parents('.boxachievement').find('#titleEdit').hide();
					$(this).parents('.boxachievement').find('#selectBoxTitle').show();
					$(this).parents('.boxachievement').find('#selectOfferTitle option').eq(0).prop('selected', true);
				}
			}
			if(titleValue.length == ''){
				$('#titleEdit').hide();
				$('#selectBoxTitle').show();
				$('#selectOfferTitle option').eq(0).prop('selected', true);
			}
		});
       });
}

jQuery("select").parent(".form-group").css("margin-top","5px")

$(document).ready(function() {

	$('#shopTimingBtn').on("click", function(){
		jQuery("#facility-profile").removeClass("timenotselected");
		jQuery("#facility-profile").addClass("timealreadyselected");
	});


	function saveamenities()
	{
		swal({
			title: 'Your info has been saved',
			text: "",
			type: 'success',
			showCancelButton: false,
			confirmButtonText: 'ok'

		});
	}



		jQuery("#accademyadded").on("click", function(){

		swal({
			title: 'Academy/Facility has been added',
			text: "",
			type: 'success',
			showCancelButton: false,
			confirmButtonText: 'ok'

		});
	
});


jQuery(document).on("click", '#deletepackagecreat', function(){
  jQuery(this).parent(".packagecreat.row").remove()
});


jQuery(document).on("click", ".slotreplica #minusright", function(){jQuery(this).parents('.slotreplica').remove()});



	jQuery(document).on("click", ".slotreplica .btn-danger", function(){ 
jQuery(this).parents(".slotreplica").remove()
});

$(document).on("click", ".deletesection1", function(){if($(".rowparent").length == 0){$("#academyplanwrapper .titleheading").hide()}});	



	jQuery('#step-4 .tab-content .saveamenities').on("click", function(){

		saveamenities();
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
				var url = window.location.href; jQuery("header .topnav li").each(function(){var cdf = jQuery(this).find("a").attr("href"); if(url.indexOf(cdf) > -1){jQuery("header .topnav li").removeClass("activenav"); jQuery(this).addClass("activenav")}});
	
	},200);

	setTimeout(function () {

		var $Input = $('input:-webkit-autofill');
		$Input.parent(".bmd-form-group").addClass('is-filled');
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
		autoplay : false,
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

		$('#slider-banner2').owlCarousel({
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
			$(this).parent(".form-group").addClass("is-filled");
		}
	});
},200);





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

setInterval(function(){
jQuery(".weekoff li").each(function(){jQuery(this).on("click", function(){jQuery(this).toggleClass("select")})});
},200);

jQuery("#dasboardbookdet").on("click", function(){jQuery(".onsearchbook").show()});
var abc = window.location.href; jQuery(".u-list a").each(function(){var cdf = jQuery(this).attr('href'); if (abc.indexOf(cdf) > 0){jQuery(".u-list a").find("li").removeClass("is-active");jQuery(this).find("li").addClass("is-active")}});
var wH = jQuery('main').height(); var cd = jQuery("footer").height(); var ab = jQuery("header").height(); var copy = jQuery(".copyrightinfo").height(); jQuery(".l-sidebar,.l-sidebar::after").height((wH+ab+copy))

jQuery(".card .nav-link").each(function(){
	jQuery(this).on("click", function(){
	var abc = jQuery(this).text(); abc = abc.trim();
	jQuery(".selectedacademy").text(abc)
});
});

jQuery(".timinginitator").on("click", function()
{
	jQuery("#shopTiming .opening input.time").val("7:00 AM");
	jQuery("#shopTiming .closing input.time").val("9:00 PM");
});

 jQuery("textarea").each(function(){if(!$(this).text() == ''){jQuery(this).parent().addClass("is-filled")}});


setTimeout(function(){
jQuery(document).on("click", '.swal2-actions', function(){
jQuery('.modal-backdrop').remove();
	jQuery(".modal.in .close").trigger('click');
  jQuery("body").removeClass('modal-open');
});
},500);

$(document).on("focus", '.form-group select', function(){var mgh = $(this).parent('.form-group').find('.sportsimgicon,.paymentmethodicon').length;  if(mgh > 0){$(this).parent('.form-group').find('.redicon').show(); $(this).parent('.form-group').find('.blueicon').hide();}});
$(document).on("focusout", '.form-group select', function(){var mgh = $(this).parent('.form-group').find('.sportsimgicon, .paymentmethodicon').length; if(mgh > 0){$(this).parent('.form-group').find('.blueicon').show(); $(this).parent('.form-group').find('.redicon').hide();}});


$(document).on("focus", '.form-group input', function(){var mgh = $(this).parent('.form-group').find('.sportsimgiconeventname').length;  if(mgh > 0){$(this).parent('.form-group').find('.redicon').show(); $(this).parent('.form-group').find('.blueicon').hide();}});
$(document).on("focusout", '.form-group input', function(){var mgh = $(this).parent('.form-group').find('.sportsimgiconeventname').length;  if(mgh > 0){$(this).parent('.form-group').find('.blueicon').show(); $(this).parent('.form-group').find('.redicon').hide();}});
// $(document).on("click",'#clearbtn', function(){
// 	window.location.reload();
// });
$(document).on("click",'#clearbtn', function(){$(".filter_prodcuts select").prop("selectedIndex", 0); $(".filter_prodcuts input").val(""); });

$(document).on("focus", '.form-group input, .form-group textarea', function(){ $(this).parent('.form-group').addClass('is-focused')});

$(document).on("focusout", '.form-group input, .form-group textarea', function(){ $(this).parent('.form-group').removeClass('is-focused')});


$(document).on("focus", '.form-group select', function(){ $(this).parent('.form-group').addClass('is-focused')});

$(document).on("focusout", '.form-group select', function(){ $(this).parent('.form-group').removeClass('is-focused')});






