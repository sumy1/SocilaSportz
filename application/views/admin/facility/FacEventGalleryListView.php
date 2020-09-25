<?php
  // echo "<pre>";
  // print_r($event_data_list);

?>
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

							<li class="active">Event Gallery List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					
						
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								<div class="row">
								
								
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
									<div class="col-xs-12">
										
										<div class="table-header">
											Event Gallery List
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">S.N</th>
														<th>Facility Name</th>
														<th>Event name</th>
														<th>Image</th>
														<th>Admin approval</th>
														<th>Created On</th>
														<!-- <th>Action</th>-->
													</tr>
												</thead>

												<tbody>
								<?php 
												 $sn=1;
									  //print_data($event_data_list);
									if(isset($event_data_list) && !empty($event_data_list)){
										foreach($event_data_list as $key=>$val){
											// echo $event_data_list[$key]->fac_name->fac_name;
											//print_data($event_data_list[$key]->event_gallery);
											// echo "<pre>";
											// echo count($event_data_list[$key]->event_gallery);
											// if(count($event_data_list[$key]->event_gallery)!=0)
												
														
									foreach($event_data_list[$key]->event_gallery as $keys=>$vals){
																			
								?>
												<tr>
										                 <td><?=$sn;?></td>
														  <td><?=trim($event_data_list[$key]->fac_name->fac_name);?></td>
													     <td><?=trim($val->event_name);?></td>
													     <td>
														 
														 <a data-fancybox="gallery" class="documents_gallery" href="<?=base_url('assets/public/images/event/gallery/'.$vals->image);?>">
														   <img src="<?=base_url('assets/public/images/event/gallery/'.$vals->image);?>"width="70px" height="80px">
														</a> 
														 
														 </td>
													     <td>
														
														 
														 
														   <select onchange="changeeventgallerystatus('<?php echo $vals->event_gallery_id;?>')" class="statusCode<?php echo $vals->event_gallery_id;?>">
														   <option value="enable" <?php if($vals->admin_approval == "enable") echo "selected"; ?>>Enable</option>
														   <option value="disable" <?php if($vals->admin_approval == "disable") echo "selected"; ?>>Disable</option>
														   <option value="void" <?php if($vals->admin_approval == "void") echo "selected"; ?>>void</option>
														   </select>
													

														 
														 
														 
														 </td>
													     <td><?= date('m-d-Y',strtotime($val->created_on));?></td>
													     		
											   </tr>
												
												
								<?php
								$sn++;
								       }
									    
									  }
									}
								?>
												
													

												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div id="modal-table" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header no-padding">
												<div class="table-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Results for "Latest Registered Domains
												</div>
											</div>

											<div class="modal-body no-padding">
												<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
													<thead>
														<tr>
															<th>Domain</th>
															<th>Price</th>
															<th>Clicks</th>

															<th>
																<i class="ace-icon fa fa-clock-o bigger-110"></i>
																Update
															</th>
														</tr>
													</thead>

													<tbody>
														<tr>
															<td>
																<a href="#">ace.com</a>
															</td>
															<td>$45</td>
															<td>3,330</td>
															<td>Feb 12</td>
														</tr>

														<tr>
															<td>
																<a href="#">base.com</a>
															</td>
															<td>$35</td>
															<td>2,595</td>
															<td>Feb 18</td>
														</tr>

														<tr>
															<td>
																<a href="#">max.com</a>
															</td>
															<td>$60</td>
															<td>4,400</td>
															<td>Mar 11</td>
														</tr>

														<tr>
															<td>
																<a href="#">best.com</a>
															</td>
															<td>$75</td>
															<td>6,500</td>
															<td>Apr 03</td>
														</tr>

														<tr>
															<td>
																<a href="#">pro.com</a>
															</td>
															<td>$55</td>
															<td>4,250</td>
															<td>Jan 21</td>
														</tr>
													</tbody>
												</table>
											</div>

											<div class="modal-footer no-margin-top">
												<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Close
												</button>

												<ul class="pagination pull-right no-margin">
													<li class="prev disabled">
														<a href="#">
															<i class="ace-icon fa fa-angle-double-left"></i>
														</a>
													</li>

													<li class="active">
														<a href="#">1</a>
													</li>

													<li>
														<a href="#">2</a>
													</li>

													<li>
														<a href="#">3</a>
													</li>

													<li class="next">
														<a href="#">
															<i class="ace-icon fa fa-angle-double-right"></i>
														</a>
													</li>
												</ul>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

				<?php $this->load->view('admin/includes/footer');?> 

			
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/includes/foot');?> 
		</div><!-- /.main-container -->
		
		<script>
		 function changeeventgallerystatus(gallery_id){
		     var gallery_status=$('.statusCode'+gallery_id).val(); 
			 // alert(gallery_status);
		 $.ajax({
			type:'post',
			url:'<?=base_url('admin/facility/changeeventgallerystatus') ?>',
			data: {gallery_id:gallery_id,gallery_status:gallery_status},
			success(res){
				// alert(res)
			   if(res == 1){
					 swal({
						  title: "Status updates",
						  text: "",
						  icon: "success",
						  button: "Ok",
						});
			   }
			   else{
				   swal({
						  title: "network issue",
						  text: "",
						  icon: "issue",
						  button: "Ok",
						});
			   }
			}
		})
	  
		 }
		</script>
	</body>
</html>
