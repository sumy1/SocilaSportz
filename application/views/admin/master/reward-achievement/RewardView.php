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
							<li class="active">Reward Achievement</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">

                    <div class="page-header">

							<div class="table-header">
											Add / Edit Reward Achievement
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
                     
                                echo form_open_multipart('admin/master/add_reward_achievement',array('class'=>'form-horizontal')); ?>

                              <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Title</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'reward_title','id'=>'reward_title','class'=>'col-xs-12','Placeholder'=>'Title')); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


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
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'Save Sport','id'=>'reward_submit','value'=>'Submit']); ?></div>											

                            	</div>
									

									</div>


                           
                            

                       

														

                             <?php echo form_close(); }
                             //Edit sports
                             	else{
                             
								echo form_open_multipart('admin/master/edit_reward_achievement',array('class'=>'form-horizontal')); ?>

								  <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Title</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'reward_title','id'=>'reward_title','class'=>'col-xs-12','Placeholder'=>'Title','value'=>$edit_reward[0]->reward_name)); ?>

													<span id="errTitle" class="error col-xs-12"> </span>

														<input type="hidden" name="reward_id" value="<?=$edit_reward[0]->reward_id;?>">
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
                            				 if($edit_reward['0']->reward_status=='enable'){  
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
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'edit sport','id'=>'reward_submit','value'=>'Submit']); ?>											

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
														<th>Status </th>
														<th>Action</th>

													</tr>

												</thead>

												<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

													<tr>

														<td><?php echo $i; ?></td>

														<td><a><?php echo $result->reward_name; ?></a></td>


														<td><?php echo ucwords($result->reward_status); ?></td>					

														<td>

															<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/master/reward_achievement/'.$result->reward_id); ?>">

																	<i class="ace-icon fa fa-pencil bigger-130"></i>

																</a>

																<!--<a class="red" href="<?php echo base_url('admin/master/delete_reward_achievement/'.$result->reward_id); ?>" onclick="return confirm('Are you sure you want to delete banner?')">

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

 $('#reward_submit').click(function(e) {
    var reward_title = $('#reward_title').val();
 if(reward_title == ''){
        $('#reward_title').show();
        $('#errTitle').html('Please Enter Title');
		return false;
    }
    else{
        $('#errTitle').html('');
    }

    return true;

  }); 


  /*Edit form validation*/


</script>