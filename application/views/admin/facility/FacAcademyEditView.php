<?php
// echo "<pre>";
// print_r($academy_data);

?>
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
								<a href="<?= base_url('admin/facility/facilityacademylist');?>"> <?=ucfirst($academy_data->fac_type);?> List</a>
							</li>
							<li class="active"><?=ucfirst($academy_data->fac_type);?> Edit</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">

                    <div class="page-header">
						<div class="table-header">
											Edit <?=ucfirst($academy_data->fac_type);?>
										</div>
									</div>

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
			<?php 
			 // print_r();
			 // die;
			
			// print_data($_batch_slot_data->user_id->user_id);
			?>
			
									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open_multipart('admin/facility/facacademyupdate',array('class'=>'form-horizontal')); ?>

									<div class="row">
									  <input type="hidden" value="<?=trim($academy_data->user_data->user_id);  ?>" name="user_id">
									
									  <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">User Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_name','id'=>'user_name','class'=>'col-xs-12','Placeholder'=>'User Name','value'=>trim($academy_data->user_data->user_name),'readonly'=>'yes')); ?>

													<span id="errorname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										
										
										
										
										
										
										
										
										
										
										

									  <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"><?=ucfirst($academy_data->fac_type);?> Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'_name','id'=>'_name','class'=>'col-xs-12','Placeholder'=>' Name','value'=>trim($academy_data->fac_name),'readonly'=>'yes' ) ); ?>

													<span id="errorname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

                                           <div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Slug</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_slug','id'=>'faciliy_slug','class'=>'col-xs-12','Placeholder'=>' slug','value'=>@$academy_data->fac_slug,'readonly'=>'yes')); ?>


													<span id="errorlongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							        </div>
								
										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Type</label>

												<div class="col-md-9">
               <?php
			     // print_data($edit); die();
			   ?>
													<?php echo form_input(array('name'=>'_type','id'=>'_type','class'=>'col-xs-12','Placeholder'=>' Type','value'=>ucfirst($academy_data->fac_type),'readonly'=>'yes' )); ?>

													<span id="errortype" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>


                                    <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> City</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'_city','id'=>'_city','class'=>'col-xs-12','Placeholder'=>' City','value'=>$academy_data->fac_city,'readonly'=>'yes')); ?>

													<span id="errorcity" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										<!--<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> State</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'_state','id'=>'_state','class'=>'col-xs-12','Placeholder'=>' State','value'=>$academy_data->fac_state,'readonly'=>'yes')); ?>

													<span id="errorstate" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>-->
										
										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Country</label>


												<div class="col-md-9">
													<?php echo form_input(array('name'=>'_country','id'=>'_country','class'=>'col-xs-12','Placeholder'=>' Country','value'=>ucfirst($academy_data->fac_country),'readonly'=>'yes')); ?>

													<span id="errorcountry" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										
										
										
										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Address </label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'_address','id'=>'_address','class'=>'col-xs-12','Placeholder'=>' Address','value'=>$academy_data->fac_address,'readonly'=>'yes')); ?>

													<span id="erroraddress" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>




										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Google Address</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'_google_address','id'=>'_google_address','class'=>'col-xs-12','Placeholder'=>' Google Address','value'=>$academy_data->fac_google_address,'readonly'=>'yes')); ?>

													<span id="errorgoogleaddress" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>



										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Pincode</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'_pin_cod','id'=>'_pin_cod','class'=>'col-xs-12','Placeholder'=>' Pin Cod','value'=>$academy_data->fac_pincode,'readonly'=>'yes')); ?>

													<span id="errorpincod" class="error col-xs-12"> </span>


												</div>

											</div>
										</div>
										
										
										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Banner Image</label>


                                     <div class="col-md-9">
													<!---<label class="ace-file-input">
														<input type="file" id="id-input-file-1" name="page_banner"></label>-->
														<input type="hidden" id="old_page_banner" name="old_page_banner" value="<?=trim($academy_data->fac_banner_image) ;?>">
														<input type="hidden" id="fac_id" name="fac_id" value="<?=trim($academy_data->fac_id) ;?>">
													<!---<input type="hidden" id="page_id" name="page_id"value="<?=$edit->fac_id;?>">-->
												<a  class="documents_gallery" href="<?=base_url('assets/public/images/fac/'.trim($academy_data->fac_banner_image));?>">
								<div class="image_box_doc1 ">
												<?php if(trim($academy_data->fac_banner_image)!=''){ ?>

										           <img src="<?=base_url('assets/public/images/fac/'.trim($academy_data->fac_banner_image));?>"height="80px"width="120px">


										<?php } ?>
										</a>
										
													
												
											
											
											

													<span id="erroPagebanner" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>

                                       
							</div>
							
										
									<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Meta keyword</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_meta_keword','id'=>'faciliy_meta_keword','class'=>'col-xs-12','Placeholder'=>' Meta keyword','value'=>@$academy_data->fac_meta_keyward)); ?>


													<span id="errorlongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							   </div>
							   
							   	<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Meta Title</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'faciliy_meta_title','id'=>'faciliy_meta_title','class'=>'col-xs-12','Placeholder'=>' Meta Title','value'=>@$academy_data->fac_meta_title)); ?>


													<span id="errorlongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							

						
<div class="col-md-6"></div>
                           
							
							<div class="col-lg-12">
											<div class="form-group">
												<label class="col-md-1 control-label no-padding-right" for="form-field-1"> Meta Description</label>
												<div class="col-md-11">
                                                  <?php echo form_textarea(array('name'=>'faciliy_meta_description','id'=>'first_sectionss','class'=>'col-xs-12','Placeholder'=>'First Section', 'value'=>@$academy_data->fac_meta_description)); ?>
												  
												  
													<span id="errorlongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							
							
							   
							   
							   


								<div class="col-md-6">
                                  <div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			
										
										  <select class="form-control" name="fac_statuss">
														   <option value="approved" <?php if($academy_data->admin_approval == "approved") echo "selected"; ?>>Approved</option>
														   <option value="disapproved" <?php if($academy_data->admin_approval == "disapproved") echo "selected"; ?>>Disapproved</option>
														   <option value="void" <?php if($academy_data->admin_approval == "void") echo "selected"; ?>>void</option>
													
													</select>
													
													
                            				
											
											

                            				
                            				<span id="errPageStatus" class="error">  </span>
                            			</span>
                            		</div>
                            	</div>

										</div>
										
										
										<div class="col-md-6">
  	                             <div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly">Home Display </label>
                            		<div class="col-sm-9">
													
													<select name="is_home" class="form-control">
														   <option value="yes" <?php if($academy_data->is_home == "yes") echo "selected"; ?>>Yes</option>
														   <option value="no" <?php if($academy_data->is_home == "no") echo "selected"; ?>>No</option>
														   
													
													</select>
													
													

                            				<span id="errPageStatus" class="error">  </span>
                            			
                            		</div>
                            	</div>
                            </div>
							

									

									

                            <div class="space-4"></div>
                            <div class="">
                            	<div class="col-md-12">											
                            		<div style="width:130px; float:right">										
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Page','id'=>'page_submit','value'=>'submit']); ?>	
                                  </div>									

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

     	 var _name=$('#_name').val();
     	 var _type=$('#_type').val();
     	 var _description =  CKEDITOR.instances['_description'].getData();
     	 var _city=$('#_city').val();
     	 var _country=$('#_country').val();
     	 var _address=$('#_address').val();
     	 var _google_address=$('#_google_address').val();
     	 var _pin_cod=$('#_pin_cod').val();
     	 var _latitude=$('#_latitude').val();
     	 var page_banner = $("input[name=page_banner]").val();
         var page_logo_image = $("input[name=logo_banner]").val();
     	 var _state=$('#_admin_approval').val();
     	 var _admin_approval_comment=$('#_admin_approval_comment').val();
     	 



     	 if(_name==''){
     	 	       $('#_name').show();
                   $('#errorname').html('Please Enter Your Name');
                   $('html,body').animate({scrollTop: $("#errorname").offset().top - 200},'slow');
     	             return false;
     	 }
     	 else
     	 {
               $('#errorname').html('');                     
     	 }


     	 if(_type==''){
     	 	  $('#_type').show();
     	 	  $('#errortype').html('Please Enter Your Type');
     	 	   $('html,body').animate({scrollTop: $("#errortype").offset().top - 200},'slow');

     	 	  return false;
     	 }
     	 else
     	 {
             $('errortype').html('');
     	 }
     	 if(_description == ''){
     	 	    $('#_description').show();
     	 	    $('#errordescription').html('Please Enter Your Type');
     	 	    $('html,body').animate({scrollTop: $("#_description").offset().top - 200},'slow');
     	 	  return false;
     	 }
     	 else
     	 {
             $('#errordescription').html('');

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



CKEDITOR.replace('_description', {
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


	</body>
</html>






