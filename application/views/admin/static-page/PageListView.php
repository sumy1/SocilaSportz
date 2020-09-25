<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head'); ?> 

	<body class="no-skin">
		<?php $this->load->view('admin/includes/header');?>
	

		<div class="main-container ace-save-state" id="main-container">
			

			<?php $this->load->view('admin/includes/sidebar');?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?= base_url('admin/user/dashboard');?>">Dashboard</a>
							</li>

							<li>
								<a href="<?= base_url('admin/cms/add_page_form');?>">Add Page</a>
							</li>
							<li class="active">Page List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="page-header">
						<div class="table-header">
											 Page List
											 <ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="contactdata">
												   <a href="<?=base_url('admin/cms/excelstaticpage');?>"><img src="<?=base_url();?>assets/admin/images/Excel-icon.png" style="width:32px; margin-right:8px;"></a>
											  </ul>
										</div>
									</div>
						<div class="row">
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								<div class="row">
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
									<div class="col-xs-12">
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">S.n</th>
														<th>Name</th>
														<th>Slug</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													if(isset($alldata) && !empty($alldata)){ $i=0 ;foreach($alldata as $result){ $i++;?>
													<tr>
														<td class="center"><?= $i ?></td>
														<td><?= $result->page_title; ?></td>
														<td><?= $result->page_slug; ?></td>
														<td><?= ucfirst($result->page_status); ?></td>

														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													
																<a class="green" href="<?= base_url('admin/cms/page_edit_form/'.$result->page_id);?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="<?= base_url('admin/cms/delete_page/'.$result->page_id);?>" onclick="return confirm('Are you sure you want to delete page?')">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>
														</td>
														
													</tr>
													<?php }
													} ?>
													

												</tbody>
											</table>
										</div>
									</div>
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
		</div><!-- /.main-container -->
	</body>
</html>
