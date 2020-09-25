<?php


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
								<a href="<?= base_url('admin/facility/faceventlist');?>"> Event List</a>
							</li>
							<li class="active">Event Edit</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

						<div class="page-content">

                    <div class="page-header">
						<div class="table-header">
											Event  Edit
										</div>
									</div>

							<div class="row">
								 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>	
			
									
									<!-- PAGE CONTENT BEGINS -->

									<?php echo form_open_multipart('admin/facility/faceventupdate',array('class'=>'form-horizontal')); ?>

							<div class="row">
							
							
							  <div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Sport Name</label>


												<div class="col-md-9">
                                                   <input type="hidden" name="sport_id" value="<?=$event_data->sport_list->sport_id;?>">
													<?php echo form_input(array('name'=>'sport_name','id'=>'sport_name','class'=>'col-xs-12','Placeholder'=>'Sport Name','value'=>$event_data->sport_list->sport_name,'readonly'=>'yes')); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										
										
								<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Name</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'event_name','id'=>'user_name','class'=>'col-xs-12','Placeholder'=>'Event Name','value'=>trim($event_data->event_name),'readonly'=>'yes')); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event slug</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'event_slug','id'=>'event_slug','class'=>'col-xs-12','Placeholder'=>'Event slug','value'=>$event_data->event_slug,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							        </div>
									
									 <div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event meta title</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'event_meta_title','id'=>'event meta title','class'=>'col-xs-12','Placeholder'=>'Event meta title','value'=>$event_data->event_meta_title,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							
							
							
							
							
							
							
							
							 <div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Facility meta keyword</label>
												<div class="col-md-9">

													   <?php echo form_input(array('name'=>'event_meta_keword','id'=>'event_meta_keword','class'=>'col-xs-12','Placeholder'=>'Event meta keyword','value'=>$event_data->event_meta_keyword,'readonly'=>'yes')); ?>


													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							           </div>
									   
							
							
							
										
										
										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Price</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'event_price','id'=>'event_price','class'=>'col-xs-12','Placeholder'=>'Event Price','value'=>trim($event_data->event_price),'readonly'=>'yes')); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Start date</label>


												<div class="col-md-9">
												
												
											<!--<input type="hidden" value="fac_filter" name="action">-->
                                    <?php echo form_input(array('name'=>'start_date','id'=>'start_date','class'=>'col-xs-12','Placeholder'=>'Event Start date','value'=>date('d-m-y',strtotime($event_data->event_start_date)),'readonly'=>'yes')); ?>
									
									
									<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										
										
										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Start date</label>


												<div class="col-md-9">
												
												
											<!--<input type="hidden" value="fac_filter" name="action">-->
                                    <?php echo form_input(array('name'=>'end_date','id'=>'end_date','class'=>'col-xs-12','Placeholder'=>'Event end date','value'=>date('d-m-y',strtotime($event_data->event_end_date)),'readonly'=>'yes')); ?>
									
									
									<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										
										
										
									
										

									<!---<div class="col-md-12">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Description</label>
									
									<div class="col-sm-12">
										   <?php echo form_textarea(array('name'=>'event_description','id'=>'event_description','class'=>'col-xs-10 col-sm-10','Placeholder'=>'Page Meta', 'value'=>trim($event_data->event_description) )); ?>
										
										
										</div>
										</div>
									</div>--->
										
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Venue</label>
                                         <div class="col-md-9">
													<?php echo form_input(array('name'=>'event_venue','id'=>'event_venue','class'=>'col-xs-12','Placeholder'=>'Event Venue','value'=> trim($event_data->event_venue),'readonly'=>'yes')); ?>

													<span id="errorfacilityname" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Approval</label>
                                         <div class="col-md-9">
													<?php echo form_input(array('name'=>'event_approval','id'=>'event_approval','class'=>'col-xs-12','Placeholder'=>'Event Approval','value'=> trim($event_data->event_approval),'readonly'=>'yes')); ?>
													<span id="errorfacilityname" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event eligibility</label>
                                         <div class="col-md-9">
													<?php echo form_input(array('name'=>'event_eligibility','id'=>'event_eligibility','class'=>'col-xs-12','Placeholder'=>'Event Eligibility','value'=> trim($event_data->event_eligibility),'readonly'=>'yes')); ?>
													<span id="errorfacilityname" class="error col-xs-12"> </span>
												</div>
											</div>
										</div>
										
										
										
										
										
										<div class="col-md-6">

											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1">Event Banner</label>


                                     <div class="col-md-9">
													<input type="hidden" id="event_id" name="event_id" value=<?=trim($event_data->event_id) ?>>
														<input type="hidden" id="old_page_banner" name="old_event_banner" value=<?=trim($event_data->event_banner) ?>>
														
											<a data-fancybox="gallery" class="documents_gallery" href="<?=base_url('assets/public/images/event/banner/'.$event_data->event_banner);?>">
			
										<?php if($event_data->event_banner!=''){ ?>
											<img src="<?=base_url('assets/public/images/event/banner/'.$event_data->event_banner);?>" height="50px" width="50px">
										<?php } ?>
										</a>
										
													<span id="erroPagebanner" class="error col-xs-12"> </span>

												</div>
											</div>

										</div>
										
										
										
										<div class="col-lg-12">
											<div class="form-group">
												<label class="col-md-1 control-label no-padding-right" for="form-field-1">Event meta description</label>
												<div class="col-md-11">
                                                  <?php echo form_textarea(array('name'=>'event_meta_description','id'=>'first_sectionss','class'=>'col-xs-12','Placeholder'=>'Event meta description', 'value'=>@$event_data->event_meta_description)); ?>
												  
												  
													<span id="errorfacilitylongitude" class="error col-xs-12"> </span>
												</div>
											</div>
							</div>
							
							
										
									   
									   
										 
								
										
										
										

							<div class="col-md-6">
								<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">			
                                   <select name="event_approval" class="form-control">
								               <option value="approved" <?php if($event_data->event_approval ==   "approved") echo "selected"; ?>>Approved</option>
												<option value="rejected" <?php if($event_data->event_approval == "rejected") echo "selected"; ?>>Rejected</option>
												<option value="pending" <?php if($event_data->event_approval == "pending") echo "selected"; ?>>Pending</option>
														   
										</select>									
                            				 

                            	  </div>
                            	</div>
							</div>
							
								<div class="col-md-6">
  	                             <div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Is home </label>
                            		<div class="col-sm-9">
													
													<select name="is_home" class="form-control">
														   <option value="yes" <?php if($event_data->is_home == "yes") echo "selected"; ?>>Yes</option>
														   <option value="no" <?php if($event_data->is_home == "no") echo "selected"; ?>>No</option>
														   
													
													</select>
													
													

                            				<span id="errPageStatus" class="error">  </span>
                            			
                            		</div>
                            	</div>
                            </div>
												
												
												
										
                            <div class="space-4"></div>
										
										
										
										
										
										
										
									
									  
                            <div class="">
                            	<div class="col-md-12">											
                            		<div style="width:130px; float:right">									
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



CKEDITOR.replace('event_description', {
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




