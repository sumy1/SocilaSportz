<div class="cus_modal profile_modal">
	<div class="cus_modal_header clearfix">
		<h5 class="title">
			<a class="toggle">
				<i class="fa fa-picture-o"></i> Sports Gallery
			</a>
		</h5>
	</div>

	<div class="collapse show" id="collapseExample8">
		<div class="cus_modal_body">
			<div class="shop_slider">
				<div class="slider slider-for">
					<?php if(isset($fac_gallery) && !empty($fac_gallery)){
						foreach ($fac_gallery as  $gallery) {
													//print_r($gallery);
							?>
							<div class="zoomProduct">

								<div class="main_container_image">
									<img src="<?=base_url('assets/public/images/gallery/'.$gallery->gallery_image);?>" class="img-fluid" alt="">
								</div>

							</div>
							<?php } }
								else{
								echo "No image available";
						
							}
							 ?>
						</div>
						<div class="slider slider-nav">


							<?php if(isset($fac_gallery) && $fac_gallery!=''){
								foreach ($fac_gallery as  $gallery) {
													//print_r($gallery);
									?>
									<div class="main_slidenav_image">
										<img src="<?=base_url('assets/public/images/gallery/'.$gallery->gallery_image);?>" class="img-fluid" alt="">
									</div>
									<?php } } ?>
								</div>
							</div>
							<?php if($fac_count>0){ ?>
							<a href="javascript:void(0)" class="edit_btn" data-toggle="modal" data-target="#shopGallery"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
							<?php } ?>
						</div>
					</div>
				</div>



				<div class="modal fade modal_default view_deal edit_profile_modal" id="shopGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">				
							<div class="modal-header">
								<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Sports Gallery</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div id="Edit_gallery_div"></div>
						</div>
					</div>
				</div>
				<script>

					$('.edit_btn').click(function() {
						var fac_id =$( "#headeracademyfacility option:selected" ).val();
						showingLoader();
   //alert(fac_id);
   $.ajax({
   	type: "POST",
            //async: true,
            url:'<?php echo base_url();?>dashboard/gallery_edit_form',  
            data: {fac_id:fac_id},
            success:function(res){
				hiddingLoader();
            	$("#Edit_gallery_div").html(res['_html']);
            }   
        });

});

	function shopSlider(container, navigation){
		$('.'+container).slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.slider-nav'
		});
		$('.'+navigation).slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.slider-for',
			dots: false,
			centerMode: true,
			focusOnSelect: true
		});
	}	
	$('#shop-gallery-tab-tab').on('shown.bs.tab', function (e) {
		setTimeout(function(){
			shopSlider('slider-for', 'slider-nav');
		}, 150);
	});
	shopSlider('slider-for', 'slider-nav');
	

</script>