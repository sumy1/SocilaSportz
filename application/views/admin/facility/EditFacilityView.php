
<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head'); ?> 

	<body class="no-skin">
		<?php $this->load->view('admin/includes/header');?> 

		<div class="main-container ace-save-state" id="main-container">

			<?php $this->load->view('admin/includes/sidebar');?>

			<div class="main-content">

			<div class="page-content">

				<div class="main-content">

					<div class="main-content-inner">

						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?= base_url('admin/user/dashboard');?>">Dashboard</a>
							</li>

							<li>
								<a href="<?= base_url('admin/facility');?>">Facility / User List</a>
							</li>
							<li class="active">Edit Page</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">

                    <div class="page-header">
						<div class="table-header">
											Edit Facility User 
										</div>
									</div>

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
								<div class="col-md-12">

									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open_multipart('admin/facility/facilityupdate',array('class'=>'form-horizontal')); ?>

									<div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_name','id'=>'facility_name','class'=>'col-xs-12','Placeholder'=>'Facility Name','value'=>$editfacility[0]->fac_name,'readonly'=>'yes')); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility slug</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_slug','id'=>'faciliy_slug','class'=>'col-xs-12','Placeholder'=>'Facility slug','value'=>$editfacility[0]->fac_slug,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							        </div>
									
									 <div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility meta title</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_meta_title','id'=>'faciliy_meta_title','class'=>'col-xs-12','Placeholder'=>'Facility meta title','value'=>$editfacility[0]->fac_meta_title,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							
							<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility meta description</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_meta_description','id'=>'faciliy_meta_description','class'=>'col-xs-12','Placeholder'=>'Facility meta description','value'=>$editfacility[0]->fac_meta_description,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							
							<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility meta keyword</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_meta_keword','id'=>'faciliy_meta_keword','class'=>'col-xs-12','Placeholder'=>'Facility meta keyword','value'=>$editfacility[0]->fac_meta_keyword,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							
							




										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Type</label>

												<div class="col-md-9">
               <?php
			     // print_data($editfacility); die();
			   ?>
													<?php echo form_input(array('name'=>'facility_type','id'=>'facility_type','class'=>'col-xs-12','Placeholder'=>'Facility Type','value'=>$editfacility[0]->fac_type,'readonly'=>'yes')); ?>

													<span id="errorfacilitytype" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>



										

										<!---<div class="col-md-12">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Description</label>


												<div class="col-md-12">

													<?php echo form_textarea(array('name'=>'facility_description','id'=>'facility_description','class'=>'col-xs-10 col-sm-10','Placeholder'=>'Page Meta', 'value'=>$editfacility[0]->fac_description,'readonly'=>'yes')); ?>
													<span id="errorfacilitydescription" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
                                       ---->

										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility City</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_city','id'=>'facility_city','class'=>'col-xs-12','Placeholder'=>'Facility City','value'=>$editfacility[0]->fac_city,'readonly'=>'yes')); ?>

													<span id="errorfacilitycity" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility State</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_state','id'=>'facility_state','class'=>'col-xs-12','Placeholder'=>'Facility State','value'=>$editfacility[0]->fac_state,'readonly'=>'yes')); ?>

													<span id="errorfacilitystate" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Country</label>


												<div class="col-md-9">
													<?php echo form_input(array('name'=>'facility_country','id'=>'facility_country','class'=>'col-xs-12','Placeholder'=>'Facility Country','value'=>$editfacility[0]->fac_country,'readonly'=>'yes')); ?>

													<span id="errorfacilitycountry" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Address </label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_address','id'=>'facility_address','class'=>'col-xs-12','Placeholder'=>'Facility Address','value'=>$editfacility[0]->fac_address,'readonly'=>'yes')); ?>

													<span id="errorfacilityaddress" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Google Address</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_google_address','id'=>'facility_google_address','class'=>'col-xs-12','Placeholder'=>'Facility Google Address','value'=>$editfacility[0]->fac_google_address,'readonly'=>'yes')); ?>

													<span id="errorfacilitygoogleaddress" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>



										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility Pin Code</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_pin_cod','id'=>'facility_pin_cod','class'=>'col-xs-12','Placeholder'=>'Facility Pin Cod','value'=>$editfacility[0]->fac_pincode,'readonly'=>'yes')); ?>

													<span id="errorfacilitypincod" class="error col-xs-12"> </span>


												</div>

											</div>
										</div>




										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility  Latitude</label>
												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_latitude','id'=>'facility_latitude','class'=>'col-xs-12','Placeholder'=>'Facility Latitude','value'=>$editfacility[0]->fac_latitude ,'readonly'=>'yes')); ?>

													<span id="errorfacilitylatitude" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility  Longitude</label>
												<div class="col-md-9">

													<?php echo form_input(array('name'=>'facility_longitude','id'=>'facility_longitude','class'=>'col-xs-12','Placeholder'=>'Facility Longitude','value'=>$editfacility[0]->fac_longitude ,'readonly'=>'yes')); ?>

													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>



										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Banner Image</label>


                                     <div class="col-md-9">
													<label class="ace-file-input">
														<!---<input type="file" id="id-input-file-1" name="page_banner"></label>>--->
													<input type="hidden" id="old_page_banner" name="old_page_banner" value="<?=$editfacility[0]->fac_banner_image;?>">
													<input type="hidden" id="old_fac_id" name="old_fac_id" value="<?=$editfacility[0]->fac_id;?>">
													<a  class="documents_gallery" href="<?=base_url('assets/public/images/fac/'.$editfacility[0]->fac_banner_image);?>">
												<?php if($editfacility[0]->fac_banner_image!=''){ ?>
                   
										           <img src="<?=base_url('assets/public/images/fac/'.$editfacility[0]->fac_banner_image);?>"height="100px"width="120px">


										<?php } ?>
										    </a>

													<span id="erroPagebanner" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>



										


							
							
							
							<div class="col-md-6">
  	                             <div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Admin Status </label>
                            		<div class="col-sm-9">


                              <select name="fac_statuss" class="form-control">
														   <option value="approved" <?php if($editfacility[0]->admin_approval == "approved") echo "selected"; ?>>Approved</option>
														   <option value="disapproved" <?php if($editfacility[0]->admin_approval == "disapproved") echo "selected"; ?>>Disapproved</option>
														   <option value="void" <?php if($editfacility[0]->admin_approval == "void") echo "selected"; ?>>void</option>
													
													</select>

													
                            		
										
                            			
                                             
												

                            				
                            				<span id="errPageStatus" class="error">  </span>
                            			
                            		</div>
                            	</div>
                            </div>
							
										
										

									

									

                            <div class="space-4"></div>
                            <div class="">
                            	<div class="col-md-6">											
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Page','id'=>'page_submit','value'=>'Submit']); ?>											

                            	</div>

                            </div>					
                            <?php echo form_close(); ?>						
                        </div><!-- /.row -->
                        </div><!-- /.col -->

                    </div>
                    <!-- PAGE CONTENT ENDS -->

                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.page-content -->

    </div>

</div><!-- /.main-content -->
		<?php $this->load->view('admin/includes/footer');?> 

			
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/includes/foot');?> 

		<!-- inline scripts related to this page -->
<script>
	/*
$(document).ready(function(){
     $('#page_submit').click(function(event){
     	 event.preventDefault();

     	 var facility_name=$('#facility_name').val();
     	 var facility_type=$('#facility_type').val();
     	 var facility_description =  CKEDITOR.instances['facility_description'].getData();
     	 var facility_city=$('#facility_city').val();
     	 var facility_country=$('#facility_country').val();
     	 var facility_address=$('#facility_address').val();
     	 var facility_google_address=$('#facility_google_address').val();
     	 var facility_pin_cod=$('#facility_pin_cod').val();
     	 var facility_latitude=$('#facility_latitude').val();
     	 var page_banner = $("input[name=page_banner]").val();
         var page_logo_image = $("input[name=logo_banner]").val();
     	 var facility_state=$('#facility_admin_approval').val();
     	 var facility_admin_approval_comment=$('#facility_admin_approval_comment').val();
     	 



     	 if(facility_name==''){
     	 	       $('#facility_name').show();
                   $('#errorfacilityname').html('Please Enter Your Name');
                   $('html,body').animate({scrollTop: $("#errorfacilityname").offset().top - 200},'slow');
     	             return false;
     	 }
     	 else
     	 {
               $('#errorfacilityname').html('');                     
     	 }


     	 if(facility_type==''){
     	 	  $('#facility_type').show();
     	 	  $('#errorfacilitytype').html('Please Enter Your Type');
     	 	   $('html,body').animate({scrollTop: $("#errorfacilitytype").offset().top - 200},'slow');

     	 	  return false;
     	 }
     	 else
     	 {
             $('errorfacilitytype').html('');
     	 }
     	 if(facility_description == ''){
     	 	    $('#facility_description').show();
     	 	    $('#errorfacilitydescription').html('Please Enter Your Type');
     	 	    $('html,body').animate({scrollTop: $("#facility_description").offset().top - 200},'slow');
     	 	  return false;
     	 }
     	 else
     	 {
             $('#errorfacilitydescription').html('');

     	 }

           

     });
  });
/*
/*
$('#page_submit').click(function(e) {
	var page_name = $('#page_name').val();
    var page_slug = $('#page_slug').val();
    var first_section = CKEDITOR.instances['first_section'].getData();
    var second_section =  CKEDITOR.instances['second_section'].getData();
    var third_section = CKEDITOR.instances['third_section'].getData();
    var page_meta = CKEDITOR.instances['page_meta'].getData();
 	var page_banner = $("input[name=page_banner]").val();
	var extpage_banner = page_banner.split('.').pop();  
    
	if(page_name == ''){
        $('#page_name').show();
        $('#errPagetitle').html('Please Enter  Page Title');
        $('html,body').animate({scrollTop: $("#errPagetitle").offset().top - 200},'slow');
		return false;
    }
    else{
        $('#errPagetitle').html('');
    }
	  if(page_slug == ''){
        $('#page_slug').show();
        $('#errPageSlug').html('Please Enter Page Slug');
        $('html,body').animate({scrollTop: $("#errPageSlug").offset().top - 200},'slow');
		return false;
    }
 
    else{
        $('#errPageSlug').html('');
    }
    if(first_section == ''){
        $('#first_section').show();
        $('#errFirstSection').html('Please Enter  First Section');
        $('html,body').animate({scrollTop: $("#errFirstSection").offset().top - 200},'slow');
		return false;
    }
    else{
        $('#errFirstSection').html('');
    }

    if(page_banner!=''){
		var page_banner_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
		if(page_banner_size>500)
		{
			$('#errPagebanner').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errPagebanner').html('');
		}

		if($.inArray(extpage_banner, ['png','jpg','jpeg','webp']) == -1) {
			$('#errPagebanner').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errPagebanner').html('');
		}
	}

	 else{

		$('#errPagebanner').html('');

	}
	
	
	
});


*/
/*Ajax check if page name and slug already exist*/


$('#page_name').blur(function(){
 var page_name = $('#page_name').val();
 var page_id = $('#page_id').val();
 if (page_name != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/cms/check_page_name');?>',
    data:{page_name:page_name,page_id:page_id},
    success: function(data){
      if (data == 1) {
        $('#errPagetitle').html("Page Title Alredy Exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errPagetitle').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
    }
  })
 }

 });


$('#page_slug').blur(function(){
 var page_slug = $('#page_slug').val();
 var page_id = $('#page_id').val();
 if (page_slug != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/cms/check_page_name');?>',
    data:{page_slug:page_slug,page_id:page_id},
    success: function(data){
      if (data == 1) {
        $('#errPageSlug').html("Page Slug Alredy Exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errPageSlug').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
    }
  })
 }

 });



CKEDITOR.replace('facility_description', {
    	filebrowserBrowseUrl: base_url+"assets/kcfinder/browse.php?type=files"
	});
$('#id-input-file-1,#page_id').ace_file_input({
	no_file:'No File ...',
	btn_choose:'Choose',
	btn_change:'Change',
	droppable:false,
	onchange:null,
	thumbnail:false //| true | large				
});
</script>

<!-- inline scripts related to this page -->
<?php
 // print_data($editfacility);
 
?>

	</body>
</html>
