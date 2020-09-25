<!DOCTYPE html>

<html lang="en">

<?php $this->load->view('admin/includes/head');?> 

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
								<li class="active">Banner</li>
							</ul><!-- /.breadcrumb -->


						</div>



						<div class="page-content">
							<div class="page-header">

								<div class="table-header">
									Add / Edit Banner
								</div>				

							</div>

							<div class="row">

								<?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>

									<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>					

								<?php endif;?>	

								<div class="col-md-12">
									

									<!-- PAGE CONTENT BEGINS -->                               
									<!-- Add banner -->
									<?php if($this->uri->segment(4)==''){

										echo form_open_multipart('admin/home/add_banner',array('class'=>'form-horizontal')); ?>

										<?php echo form_error(''); ?> 
										<div class="col-md-6">
											<div class="form-group">

												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Alt Name </label>

												<div class="col-sm-10">

													<?php echo form_input(array('name'=>'alt_name','id'=>'alt_name','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Alt Name','required'=>'')); ?>

													<span id="errbanneralt" class="error">  </span>

												</div>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">

												<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Image Name (1903px X 595px)</label>

												<div class="col-xs-7">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="banner_img"></label>

													<span id="errbannerImg" class="error">  </span>

												</div>

											</div>
										</div>

										<div class="form-group">

											<label class="col-sm-1 control-label no-padding-right" for="form-field-1"> Banner text </label>

											<div class="col-sm-11">

												<?php echo form_textarea(array('name'=>'banner_text','id'=>'banner_text','class'=>'col-xs-10 col-sm-10','maxlength'=> '1000','Placeholder'=>'Banner text')); ?>

												<span id="errbannertext" class="error">  </span>

											</div>

										</div>                               

										<!-- <div class="form-group">

											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Image Name (1903px X 595px)</label>

											<div class="col-xs-4">

												<label class="ace-file-input"><input type="file" id="id-input-file-1" name="banner_img"></label>

												<span id="errbannerImg" class="error">  </span>

											</div>

										</div> -->

										<hr>

										<div class="space-4"></div>

										<div class="col-md-6">

											<div class="form-group pull-right status-align">

												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status </label>

												<div class="col-sm-10">									
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
                                                <div class="col-md-12">		
													<div class=""style="width:130px; float:right; margin-bottom:20px;">
												         <?php echo form_submit(['class'=>'btn btn-info','id'=>'banner_submit','value'=>'Submit']); ?>
												 </div>										

											</div>

										</div>



										<?php echo form_close(); }
                             //Edit banner
										else{

											echo form_open_multipart('admin/home/edit_banner',array('class'=>'form-horizontal')); ?>

											<?php echo form_error(''); ?> 

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alt Name </label>

												<div class="col-sm-9">

													<?php echo form_input(array('name'=>'alt_name','id'=>'alt_name','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Alt Name','value'=>$edit_banner[0]->banner_alt)); ?>

													<span id="errbanneralt" class="error">  </span>

												</div>

											</div> 

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Banner text </label>

												<div class="col-sm-9">

													<?php echo form_textarea(array('name'=>'banner_text','id'=>'banner_text','class'=>'col-xs-10 col-sm-10','maxlength'=> '1000','Placeholder'=>'Banner text','value'=>$edit_banner[0]->banner_text)); ?>

													<span id="errbannertext" class="error">  </span>

												</div>

											</div>                             

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Image Name (1903px X 595px)</label>

												<div class="col-xs-4">

													<label class="ace-file-input">
														<input type="file" id="id-input-file-1" name="banner_img" value="<?=$edit_banner[0]->banner_image;?>">
														<span id="errbannerImg" class="error">  </span>
													</label>

													<input type="hidden" id="banner_img" name="banner_id" value="<?=$edit_banner[0]->banner_id;?>" />
													<input type="hidden" id="banner_id1" name="banner_img1" value="<?=$edit_banner[0]->banner_image;?>" />
													<?php if($edit_banner[0]->banner_image!=''){ ?>
													<img src="<?=base_url('assets/admin/images/home/'.$edit_banner[0]->banner_image);?>" height="50px" width="50px">
													<?php } ?>


												</div>

											</div>

											<hr>

											<div class="space-4"></div>

											<div class="col-md-4 ">

												<div class="form-group pull-right">

													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

													<div class="col-sm-9">									
														<span class="help-inline col-xs-12 col-sm-10">
															<label class="middle">

																<?php
																if($edit_banner['0']->banner_status=='enable'){  
																	echo form_checkbox('status','enable',TRUE,['class'=>'ace','id'=>'status']); }
																	else{
																		echo form_checkbox('status','enable',false,['class'=>'ace','id'=>'status']);

																	}



																	?>											
																	<span class="lbl"> Active</span>

																</label>
																<span id="errPageStatus" class="error">  </span>
															</span>
														</div>

													</div>

												</div>

												<div class="space-4"></div>

												<div class="">

													<div class="col-md-12">		
													<div class=""style="width:130px; float:right;  margin-bottom:20px;">			
														<?php echo form_submit(['class'=>'btn btn-info','id'=>'banner_edit','value'=>'Submit']); ?> 
                                                      </div>


													</div>

												</div>



												<?php echo form_close();} ?>						

											</div><!-- /.col -->

										</div>

										<hr />

										<table id="dynamic-table" class="table table-striped table-bordered table-hover">

											<thead>

												<tr>

													<th>S.No.</th>

													<th>Alt Name</th>
													<th>Banner Text</th>

													<th>Image</th>							

													<th>Status </th>

													<th>Action</th>

												</tr>

											</thead>

											<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

												<tr>

													<td><?php echo $i; ?></td>

													<td><a><?php echo $result->banner_alt; ?></a></td>
													<td><a><?php echo $result->banner_text; ?></a></td>

													<td><img src="<?php echo base_url(); ?>assets/admin/images/home/<?php echo $result->banner_image; ?>" height="50px" width="50px" /></td>

													<td><?php echo ucwords($result->banner_status); ?></td>					

													<td>

														<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/home/banner/'.$result->banner_id); ?>">

																<i class="ace-icon fa fa-pencil bigger-130"></i>

															</a>

															<a class="red" href="<?php echo base_url('admin/home/delete_banner/'.$result->banner_id); ?>" onclick="return confirm('Are you sure you want to delete banner?')">

																<i class="ace-icon fa fa-trash-o bigger-130"></i>

															</a>

														</div>

													</td>

												</tr>

												<?php  $i++;	}

											} ?>

										</tbody>

									</table>

									<!-- PAGE CONTENT ENDS -->

								</div><!-- /.col -->

							</div><!-- /.row -->

						</div><!-- /.page-content -->

					</div>

				</div><!-- /.main-content -->

			</div><!-- /.page-content -->

		</div>

	</div><!-- /.main-content -->

	<?php //include('includes/footer.php');?>

	<?php $this->load->view('admin/includes/footer'); ?>

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">

		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>

	</a>

</div><!-- /.main-container -->



<?php $this->load->view('admin/includes/foot'); ?>

<!-- inline scripts related to this page -->

</body>

</html>

<script>

	$('#banner_submit').click(function(e) {
/*jQuery(".nav.nav-list li").removeClass("active");
jQuery(".nav.nav-list li.banner").addClass("active");*/
var BannerName = $('#alt_name').val();

var validbannerName = $.trim($('#alt_name').val()).length;

var BannerImg = $("input[name=banner_img]").val();

var extcatBannerImg = BannerImg.split('.').pop();        

if(validbannerName == 0 && BannerName == ''){

	$('#errbanneralt').show();

	$('#errbanneralt').html('Please Enter Alt Name');

        // $('html,body').animate({scrollTop: $("#errbanneralt").offset().top - 120},'slow');

        return false;

    }

    else{

    	$('#errbanneralt').html('');

    }

    if(BannerImg==''){

    	$('#errbannerImg').html('Please Attach Banner Image');

    	return false;

    }		

    if(BannerImg!=''){
    	var BannerImg_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
    	if(BannerImg_size>500)
    	{
    		$('#errbannerImg').html('Please Attach Image below 500 kb');
    		return false;
    	}
    	else
    	{
    		$('#errbannerImg').html('');
    	}

    	if($.inArray(extcatBannerImg, ['png','jpg','jpeg','webp']) == -1) {
    		$('#errbannerImg').html('Please Attach Image in png , jpg or jpeg format only');			
    		return false;
    	} 
    	else{
    		$('#errbannerImg').html('');
    	}
    }

    else{

    	$('#errbannerImg').html('');

    }

    return true;

}); 


	/*Edit form validation*/

	$('#banner_edit').click(function(e) {
		var BannerName = $('#alt_name').val();
		var validbannerName = $.trim($('#alt_name').val()).length;
		var BannerImg = $("input[name=banner_img]").val();
		var extcatBannerImg = BannerImg.split('.').pop();        

		if(validbannerName == 0 && BannerName == ''){

			$('#errbanneralt').show();

			$('#errbanneralt').html('Please Enter Alt Name');

        // $('html,body').animate({scrollTop: $("#errbanneralt").offset().top - 120},'slow');

        return false;

    }

    else{

    	$('#errbanneralt').html('');

    }


    if(BannerImg!=''){
    	var BannerImg_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
    	if(BannerImg_size>500)
    	{
    		$('#errbannerImg').html('Please Attach Image below 500 kb');
    		return false;
    	}
    	else
    	{
    		$('#errbannerImg').html('');
    	}

    	if($.inArray(extcatBannerImg, ['png','jpg','jpeg','webp']) == -1) {
    		$('#errbannerImg').html('Please Attach Image in png , jpg or jpeg format only');			
    		return false;
    	} 
    	else{
    		$('#errbannerImg').html('');
    	}
    }

    else{

    	$('#errbannerImg').html('');

    }

    return true;

});
	CKEDITOR.replace('banner_text', {
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