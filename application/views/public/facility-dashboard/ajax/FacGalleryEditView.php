<div class="modal-body">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="detials_comp upload__docs shopGallery">
                <form action="" class="form_register" id="gallery_info_edit1" name="gallery_info_edit1" enctype="multipart/form-data">
                    <ul class="list-inline list_upload_img editUploadImageList1 text-center">
                        <li class="list-inline-item">
                            <div class="main-img-container">
                          
                                  
                                <input type="file" id="input-file-sports-gallery-1" name="gallery_image1" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[0]->gallery_image;?>" />
                                <input type="hidden" class="old_image" name="old_gallery_image1" value="<?=@$fac_gallery[0]->gallery_image;?>">                                                  
                                   <span id="errorgallery_image1" class="error"></span>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                                
                                <input type="file" id="input-file-sports-gallery-2" name="gallery_image2" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[1]->gallery_image;?>"/>
                                 <input type="hidden" class="old_image" name="old_gallery_image2" value="<?=@$fac_gallery[1]->gallery_image;?>">
								 <span id="errorgallery_image2" class="error"></span>

                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                                
                                <input type="file" id="input-file-sports-gallery-3" name="gallery_image3" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[2]->gallery_image;?>"/>
                                 <input type="hidden" class="old_image" name="old_gallery_image3" value="<?=@$fac_gallery[2]->gallery_image;?>">
								 <span id="errorgallery_image3" class="error"></span>

                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                              
                                <input type="file" id="input-file-sports-gallery-4" name="gallery_image4" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[3]->gallery_image;?>" />
                                 <input type="hidden" class="old_image" name="old_gallery_image4" value="<?=@$fac_gallery[3]->gallery_image;?>">
								 <span id="errorgallery_image4" class="error"></span>

                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                          
                                <input type="file" id="input-file-sports-gallery-5" name="gallery_image5" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[4]->gallery_image;?>" />
                                 <input type="hidden" class="old_image" name="old_gallery_image5" value="<?=@$fac_gallery[4]->gallery_image;?>">
								 <span id="errorgallery_image5" class="error"></span>

                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                             
                                <input type="file" id="input-file-sports-gallery-6" name="gallery_image6" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[5]->gallery_image;?>" />
                                 <input type="hidden" class="old_image" name="old_gallery_image6" value="<?=@$fac_gallery[5]->gallery_image;?>">
								 <span id="errorgallery_image6" class="error"></span>

                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                             
                                <input type="file" id="input-file-sports-gallery-7" name="gallery_image7" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[6]->gallery_image;?>"/>
                                 <input type="hidden" class="old_image" name="old_gallery_image7" value="<?=@$fac_gallery[6]->gallery_image;?>">
								 <span id="errorgallery_image7" class="error"></span>

                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="main-img-container">
                             
                                <input type="file" id="input-file-sports-gallery-8" name="gallery_image8" class="dropify" data-default-file="<?=base_url().'assets/public/images/gallery/'.@$fac_gallery[7]->gallery_image;?>"/>
                                 <input type="hidden" class="old_image" name="old_gallery_image8" value="<?=@$fac_gallery[7]->gallery_image;?>">
								 <span id="errorgallery_image8" class="error"></span>

                            </div>
                        </li>
                    </ul>

                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successGalleryUpdatebtn"> Update</a><br>
            <div class="text-left">
                *JPEG, PNG format only (Max Size : 500kB)
            </div>

        </div>
    </div>
    </form>
    </div>
    </div>
    <script>
        
        jQuery(".dropify").dropify();
        jQuery("#input-file-sports-gallery-1").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-2").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-3").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-4").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-5").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-6").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-7").siblings(".dropify-message").find("p").text("Click here to Upload");
    jQuery("#input-file-sports-gallery-8").siblings(".dropify-message").find("p").text("Click here to Upload");

$('#successGalleryUpdatebtn').click(function(event) {
        var fac_id =$( "#headeracademyfacility option:selected" ).val();
		
		var gallery_image1 =  $('input[name=gallery_image1]').val();
		var old_gallery_image1=  $('input[name=old_gallery_image1]').val();
		var extcatgst_image = gallery_image1.split('.').pop();
		
		var gallery_image2 =  $('input[name=gallery_image2]').val();
		var old_gallery_image2=  $('input[name=old_gallery_image2]').val();
	    var extcatgst_image2 = gallery_image2.split('.').pop();
		
		var gallery_image3 =  $('input[name=gallery_image3]').val();
		var old_gallery_image3=  $('input[name=old_gallery_image3]').val();
	    var extcatgst_image3 = gallery_image3.split('.').pop();
		
		var gallery_image4 =  $('input[name=gallery_image4]').val();
		var old_gallery_image4=  $('input[name=old_gallery_image4]').val();
	    var extcatgst_image4 = gallery_image4.split('.').pop();
		
		
		var gallery_image5 =  $('input[name=gallery_image5]').val();
		var old_gallery_image5=  $('input[name=old_gallery_image5]').val();
	    var extcatgst_image5 = gallery_image5.split('.').pop();
		
		
		var gallery_image6 =  $('input[name=gallery_image6]').val();
		var old_gallery_image6=  $('input[name=old_gallery_image6]').val();
	    var extcatgst_image6 = gallery_image6.split('.').pop();
		
		
		var gallery_image7 =  $('input[name=gallery_image7]').val();
		var old_gallery_image7=  $('input[name=old_gallery_image7]').val();
	    var extcatgst_image7 = gallery_image7.split('.').pop();
		
		var gallery_image8 =  $('input[name=gallery_image8]').val();
		var old_gallery_image8=  $('input[name=old_gallery_image8]').val();
	    var extcatgst_image8 = gallery_image8.split('.').pop();
		
		// console.log(old_gallery_image1,old_gallery_image2,old_gallery_image3,old_gallery_image4,old_gallery_image5,old_gallery_image6,old_gallery_image7,old_gallery_image8);
		
			
		if(gallery_image1 == '' && gallery_image2 == '' && gallery_image3 == '' && gallery_image4 == '' && gallery_image5 == '' && gallery_image6 == '' && gallery_image7 == '' && gallery_image8 == '' && old_gallery_image1 == '' && old_gallery_image2 == '' && old_gallery_image3 == '' && old_gallery_image4 == '' && old_gallery_image5 == '' && old_gallery_image6 == '' && old_gallery_image7 == '' && old_gallery_image8 == ''){	
		   $('#errorgallery_image1').html('Please select attlest one image');
		  return false;  
		}
		
		if(gallery_image1!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-1")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image1').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image1').html('');
				}
				if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image1').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image1').html('');
			    }
			 }
			 
			 
			 if(gallery_image2!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-2")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image2').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image2').html('');
				}
				if($.inArray(extcatgst_image2,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image2').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image2').html('');
			    }
			 }
			 
			 if(gallery_image2!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-2")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image2').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image2').html('');
				}
				if($.inArray(extcatgst_image2,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image2').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image2').html('');
			    }
			 }
			 
			 
			 if(gallery_image3!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-3")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image3').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image3').html('');
				}
				if($.inArray(extcatgst_image3,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image3').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image3').html('');
			    }
			 }
			 
			 
			 if(gallery_image4!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-4")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image4').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image4').html('');
				}
				if($.inArray(extcatgst_image4,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image4').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image4').html('');
			    }
			 }
			 
			 
			 if(gallery_image5!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-5")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image5').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image5').html('');
				}
				if($.inArray(extcatgst_image5,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image5').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image5').html('');
			    }
			 }
			 
			 if(gallery_image6!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-6")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image6').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image6').html('');
				}
				if($.inArray(extcatgst_image6,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image6').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image6').html('');
			    }
			 }
			 
			 if(gallery_image7!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-7")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image7').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image7').html('');
				}
				if($.inArray(extcatgst_image7,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image7').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image7').html('');
			    }
			 }
			 
			 
			 if(gallery_image8!=''){
				 var image_size=parseFloat($("#input-file-sports-gallery-8")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#errorgallery_image8').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#errorgallery_image8').html('');
				}
				if($.inArray(extcatgst_image8,['png','jpg','jpeg']) == -1){
					$('#errorgallery_image8').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#errorgallery_image8').html('');
			    }
			 }
			 
			 
			 
			 

			 
		
       // alert(fac_id);
                var form = $('#gallery_info_edit1')[0];
                var myFormData = new FormData(form);
                myFormData.append('action', 'gallery_info_update');
                myFormData.append('fac_id', fac_id);
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
                title : 'Gallery information updated successfully',
                html : '',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                $('#shopGallery').modal('hide');
                $('#shop-gallery-tab-tab').trigger('click'); 
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
   $(this).parents("li").find('input.old_image').val('')
});
	
	jQuery(".dropify-wrapper").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});

    </script>


    <style>
    .swal2-container{z-index:99999999999;}
</style>