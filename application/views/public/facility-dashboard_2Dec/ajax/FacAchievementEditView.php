<style>
.modal.fade.in
{
	display: block !important;
}
</style>

<div class="modal-body">
	<div class="container-fluid">
<form action="" class="sm_inputs" name="achievement_info_edit" id="achievement_info_edit" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group bmd-form-group bmd-form-group-sm">
				<label for="title" class="bmd-label-floating">Title</label>
				<input type="text" class="form-control" id="title1" class="titles" onkeyup="leftTrim(this)" name="title" value="<?php if($fac_achievement) echo $fac_achievement->reward_title;?>">
				<input type="hidden"  name="reward_achievement_id" value="<?php if($fac_achievement) echo $fac_achievement->reward_achievement_id;?>">
				<i class="fa fa-trophy prefix"></i>
				<span id="errFacilityname" class="error"></span>
			</div>
		</div>
		<div class="col-md-6" >
			<div class="form-group selectdiv bmd-form-group is-filled" >
				<label for="title" class="bmd-label-floating">Select Achievement</label>
				<select class="form-control custom-select-sm" id="selectOfferTitle" name="reward_type">
					<?php foreach ($reward_type as $rewards) { ?>
						<option value="<?=$rewards->reward_id;?>" <?php if($rewards->reward_id==$fac_achievement->reward_id) echo "selected";?>><?=$rewards->reward_name;?></option>
					<?php } ?>
					
				</select>
				<i class="fa fa-list-alt prefix"></i>
			</div>
		</div>
		<div class="col-md-6 mt-3 reward_1">
			<input type="file" id="input-file-acheivement-1" class="dropify" name="image1" data-default-file="<?=base_url().'assets/public/images/rewards/'.$fac_achievement->image1;?>"  />
			<input type="hidden" class="old_image" name="old_image1" value="<?=$fac_achievement->image1;?>">
			<span id="errorimage_1" class="error"></span>
		</div>
		<div class="col-md-6 mt-3 reward_2">
			<input type="file" id="input-file-acheivement-2" class="dropify" name="image2" data-default-file="<?=base_url().'assets/public/images/rewards/'.$fac_achievement->image2;?>" />
			<input type="hidden" class="old_image" name="old_image2" value="<?=$fac_achievement->image2;?>">
			<span id="errorimage_2" class="error"></span>
		</div>
	</div>
	</form>

		<div class="row">
	<div class="col-md-12 text-center">
		<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successAcheiveUpdatebtn"> Update</a>
	</div>
	</div>
	</div>
	</div>
	<script>
		jQuery(".dropify").dropify();
		jQuery("#input-file-acheivement-1").siblings(".dropify-message").find("p").text("Upload Image(200px*200px)");
	jQuery("#input-file-acheivement-2").siblings(".dropify-message").find("p").text("Upload Image(200px*200px)");


	$(document).on("click","#successAcheiveUpdatebtn" , function(event) {
		  var title1 = $('#title1').val();
		  var image1 =  $('.reward_1').find('.dropify').val();
	      var extcatgst_image = image1.split('.').pop();
		  
		  var image2 =  $('.reward_2').find('.dropify').val();
	      var extcatgst_image2 = image2.split('.').pop();
		  
		 
		  
		  
		
		if(title1 == ''){
			$('#errFacilityname').html('Please enter title');
			return false;
		}
		else{
			$('#errFacilityname').html('');
		}
		
		if(image1!=''){
				 var image_sizess=parseFloat($('.reward_1').find("#input-file-acheivement-1")[0].files[0].size / 1024).toFixed(2);
				 
			    if(image_sizess>500){
					 
					   $('#errorimage_1').html('Please attach image below 500 kb');
				        $('html,body').animate({scrollTop: $("#errorimage_1").offset().top - 200},'slow');
					   return false;
				 }
				 else{
					 $('#errorimage_1').html('');
				}
				 if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
					$('#errorimage_1').html('Please attach image in png , jpg or jpeg format only');
					 $('html,body').animate({scrollTop: $("#errorimage_1").offset().top - 200},'slow');
    		     return false; 
				}
				  else{
				    $('#errorimage_1').html('');
				 }
		}	

        if(image2!=''){
				 var image_sizess=parseFloat($('.reward_2').find("#input-file-acheivement-2")[0].files[0].size / 1024).toFixed(2);
				 
			    if(image_sizess>500){
					 
					   $('#errorimage_2').html('Please attach image below 500 kb');
				        $('html,body').animate({scrollTop: $("#errorimage_2").offset().top - 200},'slow');
					   return false;
				 }
				 else{
					 $('#errorimage_2').html('');
				}
				 if($.inArray(extcatgst_image2,['png','jpg','jpeg']) == -1){
					$('#errorimage_2').html('Please attach image in png , jpg or jpeg format only');
					 $('html,body').animate({scrollTop: $("#errorimage_2").offset().top - 200},'slow');
    		     return false; 
				}
				  else{
				    $('#errorimage_2').html('');
				 }
		}	  

		
		
		   
	var form = $('#achievement_info_edit')[0];
	    		var myFormData = new FormData(form);
				myFormData.append('action', 'achievement_info_update');
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
	});

	   $('.dropify-clear').click(function() {
   $(this).parents(".reward_1").find('input.old_image').val('')
});
	  $('.dropify-clear').click(function() {
   $(this).parents(".reward_2").find('input.old_image').val('')
});
	  jQuery("#achievement_info_edit .dropify-wrapper").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
</script>