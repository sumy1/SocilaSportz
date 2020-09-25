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
								<a href="<?= base_url('admin/cms');?>">page List</a>
							</li>
							<li class="active">Add Page</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">

                    <div class="page-header">
						<div class="table-header">
											Add page
										</div>
									</div>

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
								<div class="col-md-12">

									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open_multipart('admin/cms/add_page',array('class'=>'form-horizontal')); ?>

									<div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Page Title</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'page_name','id'=>'page_name','class'=>'col-xs-12','Placeholder'=>'page title')); ?>

													<span id="errPagetitle" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Page Slug</label>

												<div class="col-md-9">

													<?php echo form_input(array('name'=>'page_slug','id'=>'page_slug','class'=>'col-xs-12','Placeholder'=>'Page Slug')); ?>

													<span id="errPageSlug" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>

										<div class="col-md-6">
											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">First Section</label>

												<div class="col-md-9">

													<?php echo form_textarea(array('name'=>'first_section','id'=>'first_section','class'=>'col-xs-10 col-sm-10','Placeholder'=>'First Section')); ?>
													<span id="errFirstSection" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>


										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Second Section</label>

												<div class="col-md-9">

													<?php echo form_textarea(array('name'=>'second_section','id'=>'second_section','class'=>'col-xs-10 col-sm-10','Placeholder'=>'Second Section')); ?>
													<span id="errSecondSection" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">

											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Third Section</label>

												<div class="col-md-9">

													<?php echo form_textarea(array('name'=>'third_section','id'=>'third_section','class'=>'col-xs-10 col-sm-10','Placeholder'=>'Third Section')); ?>
													<span id="errThirdSection" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>



										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Meta</label>


												<div class="col-md-9">

													<?php echo form_textarea(array('name'=>'page_meta','id'=>'page_meta','class'=>'col-xs-10 col-sm-10','Placeholder'=>'Page Meta')); ?>
													<span id="errPageMeta" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Banner Image</label>


												<div class="col-md-9">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="page_banner"></label>
													<span id="errPagebanner" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>



											<div class="col-md-6">


										

									<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			<label class="middle">
                            					<?php echo form_checkbox('status','enable',TRUE,['class'=>'ace','id'=>'status']); ?>												
                            					<span class="lbl"> Active</span>

                            				</label>
                            				<span id="errPageStatus" class="error">  </span>
                            			</span>
                            		</div>
                            	</div>

										</div>

									

									

                            <div class="space-4"></div>
                            <div class="">
                            	<div class="col-md-6">	
                                     <div class=""style="width:130px; float:right;">									
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Page','id'=>'page_submit','value'=>'Submit']); ?>											
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



/*Ajax check if page name and slug already exist*/


$('#page_name').blur(function(){
 var page_name = $('#page_name').val();
 if (page_name != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/cms/check_page_name');?>',
    data:{page_name:page_name},
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
 if (page_slug != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/cms/check_page_name');?>',
    data:{page_slug:page_slug},
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




CKEDITOR.replace('first_section', {
    	filebrowserBrowseUrl: base_url+"assets/admin/kcfinder/browse.php?type=files"
	});
CKEDITOR.replace('second_section', {
    	filebrowserBrowseUrl: base_url+"assets/admin/kcfinder/browse.php?type=files"
	});
CKEDITOR.replace('third_section', {
    	filebrowserBrowseUrl: base_url+"assets/admin/kcfinder/browse.php?type=files"
	});
CKEDITOR.replace('page_meta', {
    	filebrowserBrowseUrl: base_url+"assets/admin/kcfinder/browse.php?type=files"
	});
$('#id-input-file-1').ace_file_input({
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
