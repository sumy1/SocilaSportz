
$(document).ready(function() { $('body').bootstrapMaterialDesign();
  $('#sports').multiselect({
  	includeSelectAllOption: true,
  });	

 });
$(function () {
	if($(window).width() > 767){
		$('[data-toggle="tooltip"]').tooltip();
	}
});
function modalAnimation(modal, animation) {
	$('#'+ modal +' .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered modal-lg ' + animation + '  animated');
};


// Tabs
$(document).ready(function() {
	var navListItems = $('ul.setup-panel li a'),
	allWells = $('.setup-content');
	allWells.hide();
	navListItems.click(function(e)
	{
		e.preventDefault();
		var $target = $($(this).attr('href')),
		$item = $(this).closest('li');

		if (!$item.hasClass('disabled')) {
			navListItems.closest('li').removeClass('active');
			$item.addClass('active');
			allWells.hide();
			$target.show();
		}
	});
	$('ul.setup-panel li.active a').trigger('click');
});

$(document).ready(()=> {		

	$('.toggle').click(function(event) {
		$(this).find('.toggleclass').toggleClass('fa-minus fa-plus');
	});

});


$(document).ready(function() {
	/*$('#logOutSession').click(function(event) {
		swal({
			title: 'Are you sure you wish to logout?',
			text: "",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
		}).then((result) => {
			if (result.value) {
				window.location.href = "https://www.vibestest.com/client_project/clients_website_templates/2018/marke8hub-latest";
			}
		})
	});*/

});
ma5menu({
	position: 'left',
	closeOnBodyClick: true
});



  $(document).ready(function() {
    				$("#contactPhone").keydown(function (e) {   //#phone input field id
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
             (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
             (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
             (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
             (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        	e.preventDefault();
        }
    });



    				


    	

});

