<style>
#moreadd .modal-body
{
	height: 300px;
	overflow: auto;
}
</style>

<div class="row">
				<div class="col-md-6">
					<div class="cus_modal profile_modal">
						<div class="cus_modal_header clearfix">
							<h5 class="title">
								<a class="toggle">
									<i class="fa fa-id-card-o"></i> Facility/Academy Details
								</a>	  
								</h5>
							</div>
					
							<div class="collapse show" id="collapseExample2">
								<div class="cus_modal_body">
									<div class="details_box">
										<div class="row">
											<div class="col-md-12">
												<div class="contain_data">
													<h4 class="display-4 heading_item">Facility/Academy Name</h4>
													<p class="detail_item"><?php if($fac_details) echo $fac_details->fac_name;?></p>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="fac-acad-image">
													<ul class="list-inline">
														<li class="list-inline-item">
															<h4 class="display-4 heading_item">Banner Image</h4>
															<img src="<?php if($fac_details) echo base_url('assets/public/images/fac/'.$fac_details->fac_banner_image);?>" class="img-fluid" alt="">
														</li>
														<!-- <li class="list-inline-item mt-3">
															<h4>Logo Image</h4>
															<img src="<?php if($fac_details) echo base_url('assets/public/images/fac/'.$fac_details->fac_logo_image);?>" class="img-fluid" alt="">
														</li> -->
													</ul>
												</div>
											</div>
											<div class="col-md-6">
												<div class="contain_data">
													<h4 class="display-4 heading_item">Description</h4>
													<p class="detail_item">
														<?php if($fac_details) echo substr($fac_details->fac_description,0,200);?></span><?php if($fac_details && strlen($fac_details->fac_description)>200){ ?><a class="pull-right" data-toggle="modal" data-target="#moreadd" href="javascript:void(0)"><span>Read More</span></a>Read More...</span></a><?php } ?>




														

													</p>

												</div>
												
											</div>
										</div>
											<?php if($fac_details) { ?>
										<a href="javascript:void(0)" class="edit_btn" data-toggle="modal" data-target="#facility-adademy-edit"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
											<?php } ?>
										</div>
										<div class="details_box1">
											<div class="row">
												<div class="col-md-12">
													<div class="add-head">
														<h4>Address</h4>
													</div>
												</div>
												<div class="col-md-4">
													<div class="contain_data">
														<h4 class="display-4 heading_item">City</h4>
														<p class="detail_item"><?php if($fac_details) echo $fac_details->fac_city;?></p>
													</div>
												</div>
												<div class="col-md-4">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Area</h4>
														<p class="detail_item"><?php if($fac_details) echo $fac_details->fac_address;?></p>
													</div>
												</div>
												<div class="col-md-4">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Pin Code</h4>
														<p class="detail_item"><?php if($fac_details) echo $fac_details->fac_pincode;?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							</div>	
						</div>	

						<div class="col-md-6">
							<div class="cus_modal profile_modal achievementlistwrapper">
								<div class="cus_modal_header clearfix">
									<h5 class="title">
										<a class="toggle">
											<i class="fa fa-building"></i> Achievements Detail
										</a>
									</h5>
								</div>
								<?php
								if (isset($reward_details) && !empty($reward_details)) {
								 foreach($reward_details as $reward_detail)
								 { 
								 	$reward_type = $this->CommonMdl->getRow('tbl_reward_achievement','reward_name',array('reward_id'=>$reward_detail->reward_id));
								 	?>
								<div class="collapse show" id="collapseExample1-1_<?=$reward_detail->reward_id?>">
									<div class="cus_modal_body">
										<div class="details_box">
											<div class="row">
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Title</h4>
								<p class="detail_item"><?=$reward_detail->reward_title;?></p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Type</h4>
														<p class="detail_item"><?=$reward_type->reward_name;?></p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Reward Image</h4>
														<img src="<?=base_url('assets/public/images/rewards/'.$reward_detail->image1);?>" class="img-fluid" alt="">
													</div>
												</div>
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Reward Image</h4>
														<img src="<?=base_url('assets/public/images/rewards/'.$reward_detail->image2);?>" class="img-fluid" alt="">
													</div>
												</div>
											</div>
											<a href="javascript:void(0)" class="edit_btn" data-toggle="modal" data-target="#achivement-edit"><span>Edit</span>
												<i class="fa fa-pencil-square-o"></i><input type="hidden" id="achivement_id" value="<?=$reward_detail->reward_achievement_id;?>"></a>
											<a href="javascript:void(0)" class="delete_btn" ><span>Delete</span>
												<i class="fa fa-trash"></i><input type="hidden" class="achivement_id_del" id="" value="<?=$reward_detail->reward_achievement_id;?>"></a>	
											</div>
										</div>
									</div>

								<?php }
								}

								else { ?>


								<div class="collapse show" id="collapseExample1-1_">
									<div class="cus_modal_body">
										<div class="details_box">
											<div class="row">
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Title</h4>
								<p class="detail_item"></p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Type</h4>
														<p class="detail_item"></p>
													</div>
												</div>
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Reward Image</h4>
														<img src="" class="img-fluid" alt="">
													</div>
												</div>
												<div class="col-md-6">
													<div class="contain_data">
														<h4 class="display-4 heading_item">Reward Image</h4>
														<img src="" class="img-fluid" alt="">
													</div>
												</div>
											</div>
											
											</div>
										</div>
									</div>


								 <?php }

								 ?>

								</div>
								<?php if($fac_count>0) { ?>
							<div class="col-sm-12 text-right"><a class="btn btn-info orange-btn add_achi" data-toggle="modal" data-target="#achievement-add">Add Achievement</a></div>									
						</div>
						<?php } ?>
							</div>

<div class="modal fade modal_default view_deal edit_profile_modal" id="moreadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">				
						<div class="modal-header">
							<h5 class="modal-title pl-3" id="exampleModalLongTitle">Description</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?=$fac_details->fac_description?>
						</div>	

						<div class="modal-footer">
						
						</div>
						</div>
						</div>
						</div>	


							

<div class="modal fade modal_default view_deal edit_profile_modal" id="achievement-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">				
						<div class="modal-header">
							<h5 class="modal-title pl-3" id="exampleModalLongTitle">Add your Achievement Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<form action="" name="achievement_info_insert" id="achievement_info_insert" class="sm_inputs" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group bmd-form-group bmd-form-group-sm">
												<label for="title" class="bmd-label-floating">Title<span class="required">*</span></label>
												<input type="text" class="form-control" name="title" id="title">
												<input type="hidden" name="fac_id" id="fac_ach_id">
												<i class="fa fa-trophy prefix"></i>
												<span id="errortitle" class="error"></span>
											</div>
										</div>
										<?php
										  //print_r($rewards_type);
										?>
										
										<div class="col-md-6">
											<div class="form-group selectdiv bmd-form-group is-filled" >
												<select class="form-control custom-select-sm" id="selectOfferTitle" name="selectOfferTitle"  style="margin-top:1px">
													<option disabled="disabled" selected="selected" value="0">Select Achievement Type<span class="required">*</span></option>
													<?php
													 if(isset($rewards_type) && !empty($rewards_type)){
														foreach($rewards_type as $rewards_type){ 
														
														
													?>
										<option value="<?=$rewards_type->reward_id;?>"><?=$rewards_type->reward_name; ?> </option>
													
													
													<?php
														};
													 };
													?>
													
													
												</select>
												<i class="fa fa-list-alt prefix"></i>
												<span id="acheivementerror" class="error"></span>
											</div>
										</div>
										<div class="col-md-6 mt-3">
											<input type="file" id="input-file-acheivement-1" name="image1" class="dropify" />
										     <span id="errorimage1" class="error"></span>
										</div>
										<div class="col-md-6 mt-3">
											<input type="file" id="input-file-acheivement-2" name="image2" class="dropify" />
											<span id="errorimage2" class="error"></span>
										</div>
									</div>
								</form>
								<div class="row">
									<div class="col-md-12 text-center">
										<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successAcheiveUpdatebtn"> Add Achievements</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



						<div class="modal fade modal_default view_deal edit_profile_modal" id="facility-adademy-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<!-- Google location -->


<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

<script>

function initMap() {
// Create the autocomplete object, restricting the search to geographical
// location types.
autocomplete1 = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */
(document.getElementById('facCity')),
{types: ['geocode']});

autocomplete1.addListener('place_changed', function() {
//infowindow.close();
var place = autocomplete1.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});

}

var addressInputElement = $('#facCity');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
});

</script>
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">				
	<div class="modal-header">
	<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit your Facility/Academy Details</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	</div>
	<div class="modal-body">
	<div class="container-fluid">
	<form action="" class="sm_inputs" id="fac_info_edit" name="fac_info_edit" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group bmd-form-group bmd-form-group-sm">
				<label for="faName" class="bmd-label-floating">Facility/Academy Name<span class="required">*</span></label>
				<input type="text" class="form-control" id="FacAcadName" name="facilityname" onkeyup="leftTrim(this)" value="<?php if($fac_details) echo $fac_details->fac_name;?>">
				<span id="FacAcadNameerror" class="error"></span>
				<input type="hidden"  id="fac_id" name="fac_id" value="<?php if($fac_details) echo $fac_details->fac_id;?>">
				<i class="fa fa-user prefix"></i>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group bmd-form-group bmd-form-group-sm is-filled">
				<label for="description" class="bmd-label-floating">About Facility/Academy<span class="required">*</span></label>
				<textarea id="textacademy" name="fac_text" onkeyup="leftTrim(this)"><?php if($fac_details) echo $fac_details->fac_description;?></textarea>	<i class="fa fa-file-text prefix" aria-hidden="true"></i>
				<span id="errFacilitydescription" class="error"> </span>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group bmd-form-group bmd-form-group-sm">
				<label for="city" class="bmd-label-floating">City<span class="required">*</span></label>
				<input type="text" class="form-control charval" id="facCity" onkeyup="leftTrim(this)" name="fac_city" value="<?php if($fac_details) echo $fac_details->fac_city;?>">
				<input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php if($fac_details) echo $fac_details->fac_latitude;?>">
						<input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php if($fac_details) echo $fac_details->fac_longitude;?>">
				 <span id="facCityerror" class="error"></span>
				<i class="fa fa-map-marker prefix"></i>
			</div>
		</div>											
		<div class="col-md-4">
			<div class="form-group bmd-form-group bmd-form-group-sm">
				<label for="Area" class="bmd-label-floating">Area<span class="required">*</span></label>
				<input type="text" class="form-control" id="facArea" onkeyup="leftTrim(this)" name="fac_address" value="<?php if($fac_details) echo $fac_details->fac_address;?>">
				 <span id="facAreaerror" class="error"></span>
				<i class="fa fa-map-marker prefix"></i>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group bmd-form-group bmd-form-group-sm">
				<label for="confirmPassword" class="bmd-label-floating">Pin Code<span class="required">*</span></label>
				<input type="text" class="form-control" id="facPin" name="fac_pincode" onkeypress="validate(event)" value="<?php if($fac_details) echo $fac_details->fac_pincode;?>">
				<span id="facPinerror" class="error"></span>
				<i class="fa fa-map-marker prefix"></i>
			</div>
		</div>
		<div class="col-md-6 mt-3 fac_banner1">
			<input type="file" id="input-file-fac-aca-banner" name="fac_banner" class="dropify" data-default-file="<?=base_url().'assets/public/images/fac/'.$fac_details->fac_banner_image;?>" />
			<span id="errbannerImg" class="error"></span>
			<input type="hidden" name="old_fac_banner" class="old_image" id="old_fac_banner" value="<?php if($fac_details) echo $fac_details->fac_banner_image;?>">
		</div>
		<!-- <div class="col-md-6 mt-3">
			<input type="file" id="input-file-fac-aca-logo" name="fac_logo" class="dropify" data-default-file="<?=base_url().'assets/public/images/fac/'.$fac_details->fac_logo_image;?>" />
			<input type="hidden" name="old_fac_logo" id="old_fac_logo" value="<?php if($fac_details) echo $fac_details->fac_logo_image;?>">
			<span id="faclogoimgerror" class="error"></span>
		</div> -->
	</div>
	</form>
	<div class="row">
	<div class="col-md-12 text-center">
		<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successFaUpdatebtn"> Update</a>
	</div>
	</div>

	</div>
	</div>
	</div>
	</div>
	</div>

<div class="modal fade modal_default view_deal edit_profile_modal" id="achivement-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">				
	<div class="modal-header">
	<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit your Acheivement Details</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	</div>

		

<div id="achivement_div"></div>



	</div>
	</div>
	</div>
	<script>
$( document ).ready(function() {
    $(".charval").keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });
});	
	$(document).on("click",".delete_btn",function(){
	//$('.delete_btn').click(function(){

		var achivement_id=$(this).find('.achivement_id_del').val();
		//alert(achivement_id); return false;
		 showingLoader();
		 swal({
title: 'Are you sure you want to delete?',
text: "You won't be able to delete this!",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',
confirmButtonText: 'Delete'
}).then((result) => {
	if (result.value) {
		$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>dashboard/delete_fac_info',
				data: ({achivement_id:achivement_id}),
				success: function(data) {
				if(data!='failed'){
					 hiddingLoader();
					swal({
				title : 'Acheivement deleted successfully',
				html : '',
				type: 'success'
				}).then((result) => {
				if (result.value) {
				$('#achivement-edit').modal('hide');
				$('#tab2-tab').trigger('click');
				}
				})
				}
				else{
					$('#error_msg').show(); 
					$('#error_msg').text("Network issue"); 
				}
				
				
			   }
           });
		}
});
hiddingLoader();
	});
		jQuery(".dropify").dropify();
		jQuery("#input-file-fac-aca-banner").siblings(".dropify-message").find("p").text("Upload Primary Banner(500px*500px)");
		jQuery("#input-file-fac-aca-logo").siblings(".dropify-message").find("p").text("Upload Logo(200px*200px)");

		jQuery("#input-file-acheivement-1").siblings(".dropify-message").find("p").text("Upload Image(200px*200px)");
	jQuery("#input-file-acheivement-2").siblings(".dropify-message").find("p").text("Upload Image(200px*200px)");


$('.add_achi').click(function(){
	var fac_id = $('#headeracademyfacility option:selected').val();
	$('#fac_ach_id').val(fac_id)
	});

      $('#successAcheiveUpdatebtn').click(function(){
		       var title=$('#title').val();
		       var selectOfferTitle = $('#selectOfferTitle').val();
			   // alert(selectOfferTitle);
			   
			   var image1 =  $('input[name=image1]').val();
			  var extcatgst_image = image1.split('.').pop();
			  
			   var image2 =  $('input[name=image2]').val();
			  var extcatgst_image2 = image2.split('.').pop();
			  
			  if(title == ''){
				  $('#errortitle').html('Please enter title');
			       return false;
			  }
			  else{
				   $('#errortitle').html('');
			  }
			  if(selectOfferTitle == null){
				  $('#acheivementerror').html('Please select achievement type');
			       return false;
			  }
			  else{
				   $('#acheivementerror').html('');
			  }
			  
			  if(image1==''){
				  $('#errorimage1').html('Please attach one image');
				  return false;
			  }else{
				  $('#errorimage1').html('');
			  }
			  
			  if(image1!=''){
				 var image_size=parseFloat($("#input-file-acheivement-1")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorimage1').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorimage1').html('');
				}
				if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
					$('#errorimage1').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorimage1').html('');
			    }
			 }
			 
			 
			 if(image2!=''){
				 var image_size=parseFloat($("#input-file-acheivement-2")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorimage2').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorimage2').html('');
				}
				if($.inArray(extcatgst_image2,['png','jpg','jpeg']) == -1){
					$('#errorimage2').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorimage2').html('');
			    }
			 }
			   
			    var form = $('#achievement_info_insert')[0];
	    		var myFormData = new FormData(form);
				$.ajax({
				url:'<?php echo base_url();?>dashboard/insert_fac_info',
				type: 'POST',
				data: myFormData,
				cache: false,
				processData: false,
				contentType: false,
				async: false,
				success:function(res){
					if(res!='failed'){
					 hiddingLoader();
					swal({
				title : 'Achievement added successfully',
				html : '',
				type: 'success'
				}).then((result) => {
				if (result.value) {
				$('#achievement-add').modal('hide');
				$('#tab2-tab').trigger('click');
				}
				})
				}
				else{
					$('#error_msg').show(); 
					$('#error_msg').text("Network issue"); 
				}
				}
				});
				
			 
			   
		  
	  });


		$('#successFaUpdatebtn').click(function(event) {
		var fac_name = $('#userFacAcadName').val();
		var FacAcadName= $('#FacAcadName').val();
		var about_fac = $('#textacademy').val();
		var address1 = $('#facAddress').val();
		var address2 = $('#facArea').val();
		var city = $('#facCity').val();
		var pincode = $('#facPin').val(); 
		var validpincode = $.trim($('#facPin').val()).length;
		var old_fac_banner = $('#old_fac_banner').val();    
		var FacBannerImg = $("input[name=fac_banner]").val();
		var extcatBannerImg = FacBannerImg.split('.').pop();
		/*var FacLogoImg= $("input[name=fac_logo]").val();
		var old_fac_logo= $("#old_fac_logo").val();
		var extcatFacLogoImg= FacLogoImg.split('.').pop();*/
		 
		 //alert(extcatFacLogoImg) ;
		
		
		
		
	
		       if(FacAcadName == ''){
					
					$('#FacAcadNameerror').focus();
					$('#FacAcadNameerror').html('please enter facility academy name');
				     return false;
				}
				else{
					$('#FacAcadNameerror').html(''); 
				}
				if(about_fac == ''){
			        $('#errFacilitydescription').html('Please enter About facility academy');
				     return false;
				}
				 else{
					   $('#errFacilitydescription').html('');
				 }
				 
				 if(city == ''){
					$('#facCityerror').focus();
			        $('#facCityerror').html('Please enter City');
				     return false;
					 
				}
				 else{
					   $('#facCityerror').html('');
				 }
				 if(address2 == ''){
					 $('#facAreaerror').focus();
	    			 $('#facAreaerror').html('Please enter Address Line 2');
					 return false;
				 }
				 else{
					 $('#facAreaerror').html('');
				 }
				 
				 if(pincode == ''){
						$('#facPinerror').focus();
						$('#facPinerror').html('Please enter pincode');
						return false;
				 }
				 else{
					
						
						$('#facPinerror').html('');
				 }

				if(validpincode!=6){
			
			$('#facPinerror').focus();
			$('#facPinerror').html('Please enter correct pincode');
			return false;
		}else{
			
			$('#errPincode').html('');
			
		}


				 if(FacBannerImg == '' && old_fac_banner == ''){
					  // alert(errbannerImg);
					  // return false;
					 $('#errbannerImg').html('Please attach banner image');
					 return false;
				 }
				 else{
					 $('#errbannerImg').html('');
				 }
				 if(FacBannerImg!=''){
					var FacBannerImg_size = parseFloat($("#input-file-fac-aca-banner")[0].files[0].size / 1024).toFixed(2);
					if(FacBannerImg_size>500)
					{
						$('#errbannerImg').html('Please attach image below 500 kb');
						return false;
					}
					else
					{
						$('#errbannerImg').html('');
					}
					if($.inArray(extcatBannerImg,['png','jpg','jpeg','webp']) == -1){
						$('#errbannerImg').html('Please Attach Image in png , jpg or jpeg format only');
						return false;
					}
					else{
						$('#errbannerImg').html('');
					}
				 
				 }
				/* if(FacLogoImg == '' && old_fac_logo == ''){
					 $('#faclogoimgerror').html('Please attach logo image');
					 return false;
				 }
				 else{
					   $('#faclogoimgerror').html('');
				 }*/
                /*  if(FacLogoImg!=''){
					var FacBannerImg_size = parseFloat($("#input-file-fac-aca-logo")[0].files[0].size / 1024).toFixed(2);
					if(FacBannerImg_size>500)
					{
						$('#faclogoimgerror').html('Please attach image below 500 kb');
						return false;
					}
					else
					{
						$('#faclogoimgerror').html('');
					}
					if($.inArray(extcatFacLogoImg,['png','jpg','jpeg','webp']) == -1){
						$('#faclogoimgerror').html('Please attach Image in png , jpg or jpeg format only');
						return false;
					}
					else{
						$('#faclogoimgerror').html('');
					}
				 
				 }*/
				 
			   
			   
			   
	    var form = $('#fac_info_edit')[0];
		var myFormData = new FormData(form);
		myFormData.append('action', 'fac_info_edit');
        showingLoader();		
       		

		$.ajax({
				url:'<?php echo base_url();?>dashboard/update_fac_info',
				type: 'POST',
				data: myFormData,
				cache: false,
				processData: false,
				contentType: false,
				async: false,
				success:function(res){
					
				//alert(res); return false;
				if(res!='failed'){
					hiddingLoader();
					swal({
				title : 'Information updated successfully',
				html : '',
				type: 'success'
				}).then((result) => {
				if (result.value) {
					hiddingLoader();
				$('#facility-adademy-edit').modal('hide');
				  $('#tab2-tab').trigger('click'); 
				}
				})
				}
				else{
					$('#error_msg').show(); 
					$('#error_msg').text("Network issue"); 
				}		    

			}	
		});

	

	});

		$('.edit_btn').click(function() {
	var achivement_id  = $(this).find('#achivement_id').val();
	
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/achievement_edit_form',	
			data: {achivement_id:achivement_id},
			success:function(res){
				$("#achivement_div").html(res['_html']);
			}	
		});

});
		   $('.dropify-clear').click(function() {
   $(this).parents(".fac_banner1").find('input.old_image').val('')
});

	jQuery("#facility-adademy-edit").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
	
	setTimeout(function(){
	$(".form-group").removeClass("is-focused");	
},2000);

/*$(".achievementlistwrapper").niceScroll({autohidemode: false});*/
	</script>


