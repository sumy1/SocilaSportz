

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
								<a href="<?= base_url('admin/facility');?>">Acedamy / Facility Review / Rating</a>
							</li>
							<li class="active">Edit Page</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">

                    <div class="page-header">
						<div class="table-header">
											Edit Facility
										</div>
									</div>

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
			<?php 
			 // print_r();
			 // die;
			
			// print_data($facility_batch_slot_data->user_id->user_id);
			?>
			
									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open_multipart('admin/facility/facratingupdate',array('class'=>'form-horizontal')); ?>

							<div class="row">
								
                                <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">User Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_name','id'=>'user_name','class'=>'col-xs-12','Placeholder'=>'User Name','value'=>trim($rating_data->user_name),'readonly'=>'yes' )); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

							  </div>
							  
							  
							  <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">User Email</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'user_email','id'=>'user_email','class'=>'col-xs-12','Placeholder'=>'User Email','value'=>trim($rating_data->user_email),'readonly'=>'yes' )); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

							  </div>
							  
							  
							  <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Rating Type</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'rating_type','id'=>'rating_type','class'=>'col-xs-12','Placeholder'=>'Rating Type','value'=>trim($rating_data->rating_type),'readonly'=>'yes' )); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

							  </div>
							  
							  
							  
							   <div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Admin Approval</label>
												<div class="col-md-9">
													<?php echo form_input(array('name'=>'admin_approval','id'=>'admin_approval','class'=>'col-xs-12','Placeholder'=>'Admin Approval','value'=>trim($rating_data->admin_approval),'readonly'=>'yes' )); ?>
													<span id="errorfacilityname" class="error col-xs-12"> </span>
												</div>
											</div>
							  </div>
							  
							  
							<!---  <div class="col-md-12">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Review Message</label>
									
									<div class="col-sm-12">
										   <?php echo form_textarea(array('name'=>'review_message','id'=>'review_message','class'=>'col-xs-10 col-sm-10','Placeholder'=>'Page Meta', 'value'=>trim(@$rating_data->review_data->review_message),'readonly'=>'yes' )); ?>
										
										
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



CKEDITOR.replace('review_message', {
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

