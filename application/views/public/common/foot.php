<script src="<?=base_url('assets/public/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/public/js/popper.js');?>"></script>
<script src="<?=base_url('assets/public/js/bootstrap-material-design.js');?>"></script>
<script src="<?=base_url('assets/public/js/owl.carousel.min.js');?>"></script>
<script src="<?=base_url('assets/public/js/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('assets/public/js/custom.js');?>"></script>
<script src="<?=base_url('assets/public/js/slick.min.js');?>"></script>
<script src="<?=base_url('assets/public/js/dropify.min.js');?>"></script>
<script src="<?=base_url('assets/public/js/scripts.js');?>"></script>
<script src="<?=base_url('assets/public/js/wow.min.js');?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> 
<script>

function leftTrim(element)
{

if(element)
element.value=element.value.replace(/^\s+/,"");
}




new WOW().init();
jQuery(window).on("scroll", function() {
setTimeout(function(){
	jQuery(".info-block").removeClass("animated").addClass('scaleup');
},7000); 
});

</script>
<script>
setTimeout(function(){
var wh = jQuery(window).height(); jQuery("#slider-banner.owl-carousel .owl-item img").height(wh);
},200);
</script>

<script>
	$("#timing").on("click", function() {
		$('#shopTiming').modal('show')
	})

	$('.dropify').dropify({});
jQuery(document).on("click", "#toggleFilter", function(event){jQuery(".filter_prodcuts").unbind().stop(true,true).slideToggle()});

setTimeout(function(){
jQuery(document).on("click", ".pick-lg-b", function(){jQuery('.l-sidebar').trigger('click')});

 $(document).on("click", ".edit_btn, .event_edit",  function() {jQuery("textarea").each(function(){if(!$(this).text() == ''){jQuery(this).parent().addClass("is-focused")} });  });
},500);	

jQuery("textarea").each(function(){if(!$(this).text() == ''){jQuery(this).parent().addClass("is-focused")} });

jQuery(".sportslistbookingdetailcart, .checkoutitem, #edit_eventpopup").niceScroll();	

function validate(evt) {
			var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	  	key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode(key);
	}
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}


</script>


<!---loder script -->

<script>
$(window).on('load',function() {
	$(".loader").fadeOut('slow');
	});

	function showingLoader(){
	$(".loader").fadeIn(200);
	}
	function hiddingLoader(){
	
	$(".loader").fadeOut(1000);
	}
var wh = $(document).height();	
function sidebarheight(){
	setInterval(function(){
	var wh = $("main").outerHeight();
 $('.l-sidebar').height(wh);
},200);
}
sidebarheight();

$(document).on("click", "body.dashboard .nav-item, body.dashboard .nav-link, body.dashboard .nav-tabs ",  function(){
	setInterval(function(){
	var wh = $("main").outerHeight();
 $('.l-sidebar').height(wh);
},200);
});

</script>

<script>
$( document ).ready(function() {
    $(".charval").keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });
});

jQuery(" .checkoutitem, .l-header .dropdown-menu.profile_ui.dropdown-menu-right").niceScroll({autohidemode: false,});

if($("main").find("footer").length > 0){$("footer").appendTo("body")}
if($("main").find(".copyrightinfo").length > 0){$(".copyrightinfo").appendTo("body")}

$( document ).ready(function() {
 if ((window.navigator.userAgent.indexOf('IE') == -1) && !(/*@cc_on!@*/false || !!document.documentMode)) {
    //alert('This is not IE or Edge');
} 
else {
     alert('Your browser is not allowed to access this page. Supported browser: Chrome, Firefox, Safari');
}
});

function withoutspecialnumeric(e) {
                var t = e.which ? e.which : event.keyCode;
                return 64 < t && t < 91 || 96 < t && t < 123 || 32 == t || 8 == t || 46 == t
}

function onlynumeric(e) {
                var t = e.which ? e.which : event.keyCode;
                return t >= 48 && t <= 57 || 8 == t || 46 == t
}

setTimeout(function(){
	
if(window.location.href == "https://vibestest.com/wip_projects/development/socialsportz-dev/"){$('.topnav.topnav2 li:eq(0)').addClass('activenav')}	
},500);

/* $("#usercity").focusout(function(){
if($(".pac-item").length < 1)
{
	$("#usercity").val('');
}

else
{
	$('.pac-item').each(function(){var mgh = $("#usercity").val(); var rrr = $(this).text(); if(mgh !== rrr ){$("#usercity").val('');} })
}

}); */


/*$(".google_address").focusout(function(){
var hhh = $(".google_address.notchange").val();

if($(".pac-item").length < 1)
{
	$(".google_address").val('');
	$(".google_address.notchange").val(hhh);
}

else
{
	$('.pac-item').each(function(){var mgh = $(".google_address").val(); var rrr = $(this).text(); if(mgh !== rrr ){$(".google_address").val(''); $(".google_address").addClass('notchange');

} });

}

});*/


$(".google_address").focusout(function(){
   var hhh = $(".google_address").val();
	if(hhh.indexOf(',') < 0){
		$(".google_address").val('');
	 }
});


</script>


