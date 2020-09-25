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
							<li class="active">Sports</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">

                    <div class="page-header">

							<div class="table-header">
											Add / Edit Sports
											
								<!--<ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="userinterestedsport_data">
									   
									   <a href="<?=base_url('admin/master/exportsport');?>">
									   <img src="http://localhost/socialsportz/assets/admin/images/Excel-icon.png" style="width:32px; margin-right:8px;">
									  </a>
								   </ul>-->
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
                     
                                echo form_open_multipart('admin/master/add_sport',array('class'=>'form-horizontal')); ?>

                              <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Title</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'sport_title','id'=>'sport_title','class'=>'col-xs-12','Placeholder'=>'Title')); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


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

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Sport image</label>


												<div class="col-md-10">

													<label class="ace-file-input"><input type="file" id="id-input-file-2" name="sport_image"></label>

													<span id="errImage" class="error col-xs-12">  </span>


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
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Sport','id'=>'sport_submit','value'=>'Submit']); ?>											 
									
									</div>

                            	</div>
									

									</div>


                           
                            

                       

														

                             <?php echo form_close(); }
                             //Edit sports
                             	else{
                             
								echo form_open_multipart('admin/master/edit_sport',array('class'=>'form-horizontal')); ?>

								  <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Title</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'sport_title','id'=>'sport_title','class'=>'col-xs-12','Placeholder'=>'Title','value'=>$edit_sport[0]->sport_name)); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Icon</label>


												<div class="col-md-9">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="icon_image"></label>

													<span id="errIcon" class="error col-xs-12">  </span>

										<input type="hidden" id="sport_id" name="sport_id" value="<?=$edit_sport[0]->sport_id;?>" />

										<input type="hidden" id="old_icon_image" name="old_icon_image" value="<?=$edit_sport[0]->sport_icon;?>" />

										<?php if($edit_sport[0]->sport_icon!=''){ ?>
										<img src="<?=base_url('assets/public/images/sports/'.$edit_sport[0]->sport_icon);?>" height="50px" width="50px">
										<?php } ?>


												</div>
											</div>

										</div>

											<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Sport image</label>


												<div class="col-md-9">

													<label class="ace-file-input"><input type="file" id="id-input-file-2" name="sport_image"></label>

													<span id="errImage" class="error col-xs-12">  </span>

													<input type="hidden" id="old_sport_image" name="old_sport_image" value="<?=$edit_sport[0]->sport_image;?>" />

													<?php if($edit_sport[0]->sport_image!=''){ ?>
												<img src="<?=base_url('assets/public/images/sports/'.$edit_sport[0]->sport_image);?>" height="50px" width="50px">
												<?php } ?>


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
                            				 if($edit_sport['0']->sport_status=='enable'){  
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
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'edit sport','id'=>'sport_edit','value'=>'Submit']); ?>											

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

														<th>S.N</th>
														<th>Title</th>
														<th>Icon Image</th>
														<th>Sport Image</th>
														<th>Status </th>
														<th>Action</th>

													</tr>

												</thead>

												<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

													<tr>

														<td><?php echo $i; ?></td>

														<td><a><?php echo $result->sport_name; ?></a></td>

													<td><img src="<?php echo base_url(); ?>assets/public/images/sports/<?php echo $result->sport_icon; ?>" height="50px" width="50px" /></td>
													<td><img src="<?php echo base_url(); ?>assets/public/images/sports/<?php echo $result->sport_image; ?>" height="50px" width="50px" /></td>

														<td><?php echo ucwords($result->sport_status); ?></td>					

														<td>

															<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/master/sports/'.$result->sport_id); ?>">

																	<i class="ace-icon fa fa-pencil bigger-130"></i>

																</a>

																<!--<a class="red" href="<?php echo base_url('admin/master/delete_sports/'.$result->sport_id); ?>" onclick="return confirm('Are you sure you want to delete sport')">

																	<i class="ace-icon fa fa-trash-o bigger-130"></i>

																</a>-->

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

 $('#sport_submit').click(function(e) {
    var sport_title = $('#sport_title').val();
     var icon_image = $("input[name=icon_image]").val();
	var ext_icon_image = icon_image.split('.').pop();
	var sport_image = $("input[name=sport_image]").val();
	var ext_sport_image = sport_image.split('.').pop();      
//alert(sport_image);
 if(sport_title == ''){
        $('#sport_title').show();
        $('#errTitle').html('Please Enter Title');
		return false;
    }
    else{
        $('#errTitle').html('');
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


	  if(sport_image==''){
	$('#errImage').html('Please Attach icon Image');
		return false;
	}

		if(sport_image!=''){
		var sport_iamge_size = parseFloat($("#id-input-file-2")[0].files[0].size / 1024).toFixed(2);
		if(sport_iamge_size>500)
		{
			$('#errImage').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errImage').html('');
		}

		if($.inArray(ext_sport_image, ['png','jpg','jpeg','webp']) == -1) {
			$('#errImage').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errImage').html('');
		}
	}



	 else{

		$('#errbannerImg').html('');

	}

    return true;

  }); 


  /*Edit form validation*/

  $('#sport_submit').click(function(e) {
    var sport_title = $('#sport_title').val();
     var icon_image = $("input[name=icon_image]").val();
	var ext_icon_image = icon_image.split('.').pop();
	var sport_image = $("input[name=sport_image]").val();
	var ext_sport_image = sport_image.split('.').pop();      
//alert(sport_image);
 if(sport_title == ''){
        $('#sport_title').show();
        $('#errTitle').html('Please Enter Title');
		return false;
    }
    else{
        $('#errTitle').html('');
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

		if(sport_image!=''){
		var sport_iamge_size = parseFloat($("#id-input-file-2")[0].files[0].size / 1024).toFixed(2);
		if(sport_iamge_size>500)
		{
			$('#errImage').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errImage').html('');
		}

		if($.inArray(ext_sport_image, ['png','jpg','jpeg','webp']) == -1) {
			$('#errImage').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errImage').html('');
		}
	}



	 else{

		$('#errbannerImg').html('');

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