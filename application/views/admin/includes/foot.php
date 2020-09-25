<!-- <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script> -->
<script type="text/javascript" src="<?=base_url();?>assets/admin/ckeditor/ckeditor.js"></script>

<script src="<?php echo base_url('assets/admin/js/jquery-2.1.4.min.js');?>"></script>

<script src="<?php echo base_url('assets/admin/js/bootstrap.min.js');?>"></script>

<script src="<?php echo base_url('assets/admin/js/ace-elements.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/chosen.jquery.min.js');?>"></script>

<script src="<?php echo base_url('assets/admin/js/ace.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/jquery.dataTables.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/admin/js/jquery.dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/dataTables.select.min.js'); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>


<!-- <script type="text/javascript">

	if('ontouchstart' in document.documentElement) document.write("<script src='<?php //echo base_url('assets/admin/js/jquery.mobile.custom.min.js');?>>"+"<"+"/script>");

</script> -->



<!-- <script src="<?php //echo base_url('assets/admin/js/jquery-ui.custom.min.js');?>"></script>

<script src="<?php //echo base_url('assets/admin/js/jquery.ui.touch-punch.min.js');?>"></script>

<script src="<?php //echo base_url('assets/admin/js/jquery.easypiechart.min.js');?>"></script>

<script src="<?php //echo base_url('assets/admin/js/jquery.sparkline.index.min.js');?>"></script>

<script src="<?php //echo base_url('assets/admin/js/jquery.flot.min.js');?>"></script>

<script src="<?php //echo base_url('assets/admin/js/jquery.flot.pie.min.js');?>"></script>

<script src="<?php //echo base_url('assets/admin/js/jquery.flot.resize.min.js');?>"></script> -->



<!-- ace scripts -->





<!--Table cript-->



<!-- page specific plugin scripts -->


<!-- 
<script src="<?php //echo base_url('assets/admin/js/buttons.flash.min.js'); ?>"></script>

<script src="<?php //echo base_url('assets/admin/js/buttons.html5.min.js'); ?>"></script>

<script src="<?php //echo base_url('assets/admin/js/buttons.print.min.js'); ?>"></script>

<script src="<?php //echo base_url('assets/admin/js/buttons.colVis.min.js'); ?>"></script> -->


<script type="text/javascript">
	var base_url = '<?php echo base_url() ?>'; //For ck editor()img upload
	//alert(base_url);
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table').DataTable( {
					bAutoWidth: false,
					"aaSorting": [],
			
					select: {
						style: 'multi'
					}
			    } );
						/*
			$('#dynamic-table').DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
			
					select: {
						style: 'multi'
					}
			    } );				*/
			
				
				
			
			})

$(".slugVal").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
 
});

		</script>
		
		
				<script>
			$('.date-picker-from , .date-picker-to').datepicker({

			autoclose: true,
            todayHighlight: true

			})
			
/* fancybox */
$(document).ready(function() {

	
		 /*  $(document).on("click", ".clearbtn", function(){
          location.reload();
		  }); */

$(".submenu li a").each(function(){ var abc = window.location.href; var mgh = $(this).attr('href'); if(abc==mgh){$(this).parents('li').addClass("open");  } });	


$('.documents_gallery').fancybox({

});
});


CKEDITOR.replace('first_sectionss', {
    	filebrowserBrowseUrl: base_url+"assets/kcfinder/browse.php?type=files"
	});




		</script>
		

<style>
	.nav-list>li.open>a
	{
background-color: #86150a !important;
	}

.nav-list>li.open>a .fa-angle-down
{
	transform: rotate(180deg);
	-webkit-transform:rotate(180deg);
}



	.bigger-110 {
    margin-left: 5px !important;
    position: absolute !important;
    top: 7px !important;
    left: 3px !important;
}

form.form-horizontal label
{
	margin-left: 0px !important;
}

.submenu li.open a
{
	    background-color: #dee1e4 !important;
    color: #000 !important;
}
</style>	