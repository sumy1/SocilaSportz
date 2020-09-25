 <form action="" class="form_register" id="gallery_info_edit1" name="gallery_info_edit1" enctype="multipart/form-data">

<div class="modal-body">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="detials_comp upload__docs shopGallery">
                   
                  <ul class="list-inline list_upload_img editUploadImageList1 text-center">
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        <!-- <div class="main-title-upload-image1">
                          <h4>Image 1</h4>
                          <p>JPEG, PNG format only (Max Size : 2MB)</p>
                        </div>  --> 

                        <input type="file" id="input-file-sports-gallery-1" name="gallery1" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[0]->image;?>" />  

                        <input type="hidden" name="old_gallery1" value="<?=@$event_gallery[0]->image?>">                       
                        <input type="hidden" name="event_id" value="<?=$event_id?>">                       

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                       <!--  <div class="main-title-upload-image1">
                          <h4>Image 2</h4>
                          <p>JPEG, PNG format only (Max Size : 2MB)</p>
                        </div> -->
                        <input type="file" id="input-file-sports-gallery-2" name="gallery2" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[1]->image;?>" />
                        <input type="hidden" name="old_gallery2" value="<?=@$event_gallery[1]->image?>"> 

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                       <!--  <div class="main-title-upload-image1">
                          <h4>Image 3</h4>
                          <p>JPEG, PNG format only (Max Size : 2MB)</p>
                        </div> -->
                        <input type="file" id="input-file-sports-gallery-3" name="gallery3" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[2]->image;?>" />
                         <input type="hidden" name="old_gallery3" value="<?=@$event_gallery[2]->image?>"> 



                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                        <!-- <div class="main-title-upload-image1">
                          <h4>Image 4</h4>
                          <p>JPEG, PNG format only (Max Size : 2MB)</p>
                        </div> -->
                        <input type="file" id="input-file-sports-gallery-4" name="gallery4" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[3]->image;?>" />
                        <input type="hidden" name="old_gallery4" value="<?=@$event_gallery[3]->image?>"> 
                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                       
                        <input type="file" id="input-file-sports-gallery-5" name="gallery5" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[4]->image;?>" />
                         <input type="hidden" name="old_gallery5" value="<?=@$event_gallery[4]->image?>"> 
                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                       
                        <input type="file" id="input-file-sports-gallery-6" name="gallery6" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[5]->image;?>"  />
                        <input type="hidden" name="old_gallery6" value="<?=@$event_gallery[5]->image?>"> 

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                      
                        <input type="file" id="input-file-sports-gallery-7" name="gallery7" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[6]->image;?>" />
                        <input type="hidden" name="old_gallery7" value="<?=@$event_gallery[6]->image?>"> 

                      </div>
                    </li>
                    <li class="list-inline-item">
                      <div class="main-img-container">
                       
                        <input type="file" id="input-file-sports-gallery-8" name="gallery8" class="dropify" data-default-file="<?=base_url().'assets/public/images/event/gallery/'.@$event_gallery[7]->image;?>" />
                         <input type="hidden" name="old_gallery8" value="<?=@$event_gallery[7]->image?>"> 

                      </div>
                    </li>
                  </ul>
                
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1 successGalleryUpdatebtn" id="successGalleryUpdatebtn"> Save</a>
              </div>
            </div>
         <span>*JPEG, PNG format only (Max Size : 2MB)</span>
        </div>
      </div>
      </form>
    <script>
      $('.dropify').dropify();

     
        $('.successGalleryUpdatebtn').on('click', function(e) {
      
                var form = $('#gallery_info_edit1')[0];
                var myFormData = new FormData(form);
                myFormData.append('action', 'gallery_info_update');
				showingLoader();
             
               

        $.ajax({
                url:'<?php echo base_url();?>/facility/event/update_event_gallery',
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
                title : 'Gallery Information updated successfully!',
                html : '',
                type: 'success'
                }).then((result) => {
                if (result.value) {
               $('#shopGallery1').modal('hide');
               // $('#shop-gallery-tab-tab').trigger('click'); 
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
	
		setTimeout(function(){
	jQuery("#shopGallery1 .list-inline-item").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
	},300);
    </script>