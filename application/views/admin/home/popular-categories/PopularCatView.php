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
							<li class="active">Popular Categories</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">

                    <div class="page-header">

						<div class="table-header">
											Add / Edit Popular Categories
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
                     
                                echo form_open_multipart('admin/home/add_popular_data',array('class'=>'form-horizontal')); ?>

                              <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Title</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'title','id'=>'title','class'=>'col-xs-12','Placeholder'=>'Title')); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Text</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'text','id'=>'text','class'=>'col-xs-12','Placeholder'=>'Text')); ?>

													<span id="errText" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Icon</label>


												<div class="col-md-10">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="icon_image"></label>

													<span id="errIcon" class="error col-xs-12">  </span>


												</div>
											</div>

										</div>

										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Hover image</label>


												<div class="col-md-10">

													<label class="ace-file-input"><input type="file" id="id-input-file-2" name="hover_image"></label>

													<span id="errHover" class="error col-xs-12">  </span>


												</div>
											</div>

										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Url</label>
												<div class="col-md-10">
													<?php echo form_input(array('name'=>'url','id'=>'url','class'=>'col-xs-12','Placeholder'=>'Url')); ?>
													<span id="errurl" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>
										

										

									<div class="col-md-6">
											
									<div class="form-group status-align">
                            		<label class="col-sm-2 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
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
								<div class="col-md-6">
                                     <div class=""style="width:130px; float:right;">				
                            		   <?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Data','id'=>'submit_data','value'=>'Submit']); ?>				
                               </div>									

                            	</div>
									

									</div>


                           
                            

                       

														

                             <?php echo form_close(); }
                             //Edit banner
                             	else{
                             
								echo form_open_multipart('admin/home/edit_popular_cat',array('class'=>'form-horizontal')); ?>

								  <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Title</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'title','id'=>'title','class'=>'col-xs-12','Placeholder'=>'Title','value'=>$edit_data[0]->popular_title)); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>

										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Text</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'text','id'=>'text','class'=>'col-xs-12','Placeholder'=>'Text','value'=>$edit_data[0]->popular_text)); ?>

													<span id="errText" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Icon</label>


												<div class="col-md-9">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="icon_image"></label>

													<span id="errIcon" class="error col-xs-12">  </span>

										<input type="hidden" id="popular_cat_id" name="popular_cat_id" value="<?=$edit_data[0]->popular_cat_id;?>" />

										<input type="hidden" id="old_icon_image" name="old_icon_image" value="<?=$edit_data[0]->popular_icon;?>" />

										<?php if($edit_data[0]->popular_icon!=''){ ?>
										<img src="<?=base_url('assets/admin/images/home/'.$edit_data[0]->popular_icon);?>" height="50px" width="50px">
										<?php } ?>


												</div>
											</div>

										</div>


										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Hover image</label>


												<div class="col-md-9">

													<label class="ace-file-input"><input type="file" id="id-input-file-2" name="hover_image"></label>

													<input type="hidden" id="old_hover_image" name="old_hover_image" value="<?=$edit_data[0]->popular_hover_icon;?>" />

										<?php if($edit_data[0]->popular_hover_icon!=''){ ?>
										<img src="<?=base_url('assets/admin/images/home/'.$edit_data[0]->popular_hover_icon);?>" height="50px" width="50px">
										<?php } ?>

													<span id="errHover" class="error col-xs-12">  </span>


												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Url</label>
												<div class="col-md-10">
													<?php echo form_input(array('name'=>'url','id'=>'url','class'=>'col-xs-12','value'=>$edit_data[0]->popular_url)); ?>
													<span id="errurl" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>


											

									<div class="col-md-6">
											
									<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			<label class="middle">
                            					<?php
                            				 if($edit_data['0']->popular_status=='enable'){  
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
								<div class="col-md-6">	
                                    <div class=""style="width:130px; float:right;">								
                            		    <?php echo form_submit(['class'=>'btn btn-info','name'=>'edit sport','id'=>'edit_data','value'=>'Submit']); ?>											
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

														<th>Title</th>
														<th>Text</th>
														<th>Icon Image</th>
														<th>Hover Image</th>
														<th>Status </th>
														<th>Action</th>

													</tr>

												</thead>

												<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

													<tr>

														<td><?php echo $i; ?></td>

														<td><?php echo $result->popular_title; ?></td>
														<td><?php echo $result->popular_text; ?></td>

													<td><img src="<?php echo base_url(); ?>assets/admin/images/home/<?php echo $result->popular_icon; ?>" height="50px" width="50px" /></td>
													<td><img src="<?php echo base_url(); ?>assets/admin/images/home/<?php echo $result->popular_hover_icon; ?>" height="50px" width="50px" /></td>

														<td><?php echo ucwords($result->popular_status); ?></td>					

														<td>

															<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/home/popular_categoties/'.$result->popular_cat_id); ?>">

																	<i class="ace-icon fa fa-pencil bigger-130"></i>

																</a>

																<a class="red" href="<?php echo base_url('admin/home/delete_popular_cat/'.$result->popular_cat_id); ?>" onclick="return confirm('Are you sure you want to delete popular categories')">

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

 $('#submit_data').click(function(e) {
    var title = $('#title').val();
    var text = $('#text').val();
    var icon_image = $("input[name=icon_image]").val();
	var ext_icon_image = icon_image.split('.').pop(); 
	var hover_image = $("input[name=hover_image]").val();
	var ext_hover_image = hover_image.split('.').pop(); 
	var url = $('#url').val();

//alert(sport_image);
 if(title == ''){
        $('#title').show();
        $('#errTitle').html('Please Enter Title');
		return false;
    }
    else{
        $('#errTitle').html('');
    }
    if(text == ''){
        $('#text').show();
        $('#errText').html('Please Enter Title');
		return false;
    }
    else{
        $('#errText').html('');
    }

   if(icon_image==''){
	$('#errIcon').html('Please Attach icon Image');
		return false;
	}

		if(icon_image!=''){
		var icon_iamge_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
		if(icon_iamge_size>500)
		{
			$('#errIcon').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errIcon').html('');
		}

		if($.inArray(ext_icon_image, ['png','jpg','jpeg','webp']) == -1) {
			$('#errIcon').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errIcon').html('');
		}
	}



	 if(hover_image==''){
	$('#errHover').html('Please Attach icon Image');
		return false;
	}

		if(hover_image!=''){
		var hover_image_size = parseFloat($("#id-input-file-2")[0].files[0].size / 1024).toFixed(2);
		if(hover_image_size>500)
		{
			$('#errHover').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errHover').html('');
		}

		if($.inArray(ext_hover_image, ['png','jpg','jpeg','webp']) == -1) {
			$('#errHover').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errHover').html('');
		}
	}
	if(url == ''){
        $('#errurl').show();
        $('#errurl').html('Please Enter Url');
		return false;
    }
    else{
        $('#errurl').html('');
    }

	 

    return true;

  }); 


  /*Edit form validation*/

   $('#edit_data').click(function(e) {
    var title = $('#title').val();
    var text = $('#text').val();
     var icon_image = $("input[name=icon_image]").val();
	var ext_icon_image = icon_image.split('.').pop(); 
	var hover_image = $("input[name=hover_image]").val();
	var ext_hover_image = hover_image.split('.').pop();
    var url = $('#url').val();	

//alert(sport_image);
 if(title == ''){
        $('#title').show();
        $('#errTitle').html('Please Enter Title');
		return false;
    }
    else{
        $('#errTitle').html('');
    }
    if(text == ''){
        $('#text').show();
        $('#errText').html('Please Enter Title');
		return false;
    }
    else{
        $('#errText').html('');
    }

  
		if(icon_image!=''){
		var icon_iamge_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
		if(icon_iamge_size>500)
		{
			$('#errIcon').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errIcon').html('');
		}

		if($.inArray(ext_icon_image, ['png','jpg','jpeg','webp']) == -1) {
			$('#errIcon').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errIcon').html('');
		}
	}

		if(hover_image!=''){
		var hover_image_size = parseFloat($("#id-input-file-2")[0].files[0].size / 1024).toFixed(2);
		if(hover_image_size>500)
		{
			$('#errHover').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errHover').html('');
		}

		if($.inArray(ext_hover_image, ['png','jpg','jpeg','webp']) == -1) {
			$('#errHover').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errHover').html('');
		}
	}
	if(url == ''){
        $('#errurl').show();
        $('#errurl').html('Please Enter Url');
		return false;
    }
    else{
        $('#errurl').html('');
    }

	 

    return true;

  }); 

$('#id-input-file-1,#id-input-file-2').ace_file_input({
	no_file:'No File ...',
	btn_choose:'Choose',
	btn_change:'Change',
	droppable:false,
	onchange:null,
	thumbnail:false //| true | large				
});
</script>