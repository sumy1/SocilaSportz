
<!DOCTYPE html>
<?php
// echo "<pre>";
 // print_r($fac_booking_listing);

?>
<html lang="en">

<?php $this->load->view('admin/includes/head'); ?>

<style>

address strong{font-size: 13px;}
.heading{font-size: 18px;}
address {line-height: 25px; font-size: 17px;}
/* table strong{font-size: 16px;} */
h3
{
margin-top: 30px;
}
hr {
margin-top: 10px;
margin-bottom: 10px;
border-top: 1px solid #eee;
}

#invoiceblock .form-group{min-height: 42px;}
.smallfont{font-size: 19px;}
.close{opacity: 1 !important}
.messageorderdetail
{
border: 1px solid #e6e6e6;
padding: 15px;
margin-bottom: 15px;
}
</style>

<body class="no-skin">
<?php //print_r($orderInfo); die; ?>
<!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content rejectpopup">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Reject customized request </h4>
</div>

<?php echo form_open_multipart('admin/order/order_reject',array('class'=>'form-horizontal')); ?>
<?php echo form_error(''); ?>

<div class="modal-body">
<div class="col-sm-8">

	<?php //print_r($userInfo);  ?>
	<input type="hidden" name="useremail" id="useremail" value="">
	<!-- <input type="hidden" name="userid" id="userid" value=""> -->
	<input type="hidden" name="orderid" id="orderid" value="">
</div>
<div class="col-sm-4">
	<button type="submit" class="btn btn-info" style="    margin-top: -9px;    margin-bottom: 20px;">Reject</button>
</div>	

</div>

<?php echo form_close(); ?>
<div class="clearfix"></div>

</div>

</div>
</div>

<?php $this->load->view('admin/includes/header'); ?>

<div class="main-container ace-save-state" id="main-container">

<script type="text/javascript">

try{ace.settings.loadState('main-container')}catch(e){}

</script>

<?php $this->load->view('admin/includes/sidebar'); ?>

<div class="main-content">

<div class="page-content">

<div class="main-content">

<div class="main-content-inner">

	<div class="page-content">

		<div class="row">
			<?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>

				<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>					

			<?php endif;?>
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">

						<!-- Normal Purchase -->
						
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4 text-left">
											<h3 class="pull-left smallfont"><strong>Booking Order No:</strong> 
											 &nbsp;<?=trim($fac_booking_listing->booking_order_no);?>
											</h3>

										</div>

										<div class="col-md-4 text-center">
											<img src="">
										</div>

										<div class="col-md-4">

											<h3 style="width: 100%;    text-align: right;" class="pull-left smallfont"><strong>Booking Order Type:</strong>&nbsp;Normal</h3>

										</div>
									</div>

									<hr class="blok-h">

									<div class="row">

										<div class="col-md-4">

											<address>

												<strong class="heading">Customer Detail:</strong><br>
											
												<span style="font-size:15px">
													<strong>Name:</strong>&nbsp;&nbsp;<?=trim($fac_booking_listing->name);?><br>
													<strong>Email:</strong>&nbsp;&nbsp;<?=trim($fac_booking_listing->email)?><br>
													<strong>Phone:</strong>&nbsp;&nbsp;<?=trim($fac_booking_listing->mobile);?> <br>
													<strong>Address:</strong>&nbsp;&nbsp;<?=trim($fac_booking_listing->address);?><br>
													<strong>City:</strong>&nbsp;&nbsp;<?=trim($fac_booking_listing->city);?>
													<br>
												</span>                 						</address>

											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="col-md-6 control-label no-padding-right" for="form-field-1"><strong>Order Status : </strong></label>
													  <select onchange="changebookingstatus('<?php echo $fac_booking_listing->booking_order_id; ?>')" name="" id="sel1" class="form_input statusCode">
														   <option value="pending" <?php if($fac_booking_listing->booking_status == "pending") echo "selected"; ?>>Pending</option>
														   <option value="confirm" <?php if($fac_booking_listing->booking_status == "confirm") echo "selected"; ?>>Confirm</option>
														   <option value="cancle" <?php if($fac_booking_listing->booking_status == "cancle") echo "selected"; ?>>Cancel</option>
														 </select>
													
													<span class="updtMsg"></span>
													<span id="errCouponStat" class="error"> </span>
												</div>
											</div>

											<div class="col-md-4">
												<div class="pull-right">
													<address>
														<strong class="heading">Order Detail:</strong><br>
														<strong>Order Date: </strong>&nbsp;&nbsp;
														<?= date('d-m-y',strtotime($fac_booking_listing->booking_on));?><br/>
														<strong>Payment Method:</strong>
														&nbsp;&nbsp;<?=trim(ucfirst($fac_booking_listing->payment_method));?>
														<br/>
													
															<strong>Payment Status:</strong>
															&nbsp;&nbsp;<?=trim(ucfirst($fac_booking_listing->payment_status));?>
														<br/>
													
														
												

													</address>
														
												
													
												</div>
											</div>

										</div>

									</div>

									<div class="clearfix"></div>
									<div class="row">
										<div class="col-sm-12">	
										</div>
									</div>		
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h3 class="panel-title"><strong>Order summary</strong></h3>
												</div>
												<div class="panel-body">
													<div class="table-responsive">
														<table class="table table-condensed">
															<thead>
																<tr>
																	<td><strong>S.N</strong></td>
																	<td><strong>Facility Name</strong></td>
																	<td><strong>Facility Type</strong></td>
																	<td><strong>Sport Name</strong></td>
																	<td><strong>Event Start Time</strong></td>
																	<td><strong>Event End Time</strong></td>
																	<td><strong>Event Start Date </strong></td>
																	<td><strong>Event End Date </strong></td>
																	<td><strong> Amount</strong></td>
																	<td><strong>Final Amount</strong></td>
																</tr>
															</thead>

															<tbody>
								<?php
								if(isset($fac_booking_listing->booking_detail) && !empty($fac_booking_listing->booking_detail)){
								$sn=1;
								foreach($fac_booking_listing->booking_detail as $key=>$val){   
								 // print_data($val);
								?>
												<tr>
												<td><?=$sn;?></td>
								   <?php
									if(isset($fac_booking_listing->booking_detail[$key]->facility_name) && !empty($fac_booking_listing->booking_detail[$key]->facility_name))
									{$i=0 ;foreach($fac_booking_listing->booking_detail[$key]->facility_name as $keys=>$valus){ 
									?>
																
																<td><?=trim(ucfirst($valus->fac_name));?></td>
																<td><?=trim(ucfirst($valus->fac_type));?></td>
																							
								   <?php
									  if(isset($fac_booking_listing->booking_detail[$key]->facility_name[$keys]->sport_name) && !empty($fac_booking_listing->booking_detail[$key]->facility_name[$keys]->sport_name)){ $i=0 ;foreach($fac_booking_listing->booking_detail[$key]->facility_name[$keys]->sport_name as $sport_key=>$sport_val){
										  // print_data($fac_booking_listing->booking_detail[$key]->facility_name[$keys]->sport_name);
									?>
														   <td><?=trim($sport_val->sport_name);?></td>
													<?php
														}};
													 ?>					 
								  <?php
									  }}
								  ?>
											<td><?=trim($val->event_start_time);?></td>
											<td><?=trim($val->event_end_time);?></td>
											<td><?=date('d-m-y',strtotime($val->event_start_date));?></td>
											<td><?=date('d-m-y',strtotime($val->event_end_date));?></td>
											<td><?=trim($val->booking_detail_total_amount);?></td>
											<td><?=trim($val->booking_detail_final_amount);?></td>
									</tr>
									
									
																								
																								
								<?php
									$sn++;
									
									}}
								?>
								         <tr>
									      <td colspan="8"></td>
									      <td><strong>Total Amount</strong></td>
									     <td>₹ <?=$fac_booking_listing->total_amount;?></td>
									     </tr>
										 
								         <tr>
									      <td colspan="8"></td>
									      <td><strong>Coupon Code</strong></td>
									     <td><span> <?=$fac_booking_listing->coupon_code;?></span></td>
									     </tr>
										 <tr>
										 	<td colspan="8"></td>
										 <td><strong>Discount Amount</strong></td>
										 <td><span>₹ <?=$fac_booking_listing->discount_amount	;?></span></td>
										 </tr>
										 <tr>
										 	<td colspan="8"></td>
										 <td><strong>Final Amount</strong></td>
									     <td><span>₹ <?=$fac_booking_listing->final_amount;?></span></td>
									
									</tr>


					


                                   </tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</div>	


<!-- End Normal Purchase -->


<!-- End Custom Purchase -->
<!-- <?php  ?> -->


</div>	

			

</div>


</div>



</div>

</div>

<!-- PAGE CONTENT ENDS -->

</div><!-- /.col -->

</div><!-- /.row -->

</div><!-- /.page-content -->

</div>

</div><!-- /.main-content -->

</div><!-- /.page-content -->

</div>

</div><!-- /.main-content -->

<?php $this->load->view('admin/includes/footer'); ?>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">

<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>

</a>

</div><!-- /.main-container -->


</div>

</div>

</div>
</div>






<?php $this->load->view('admin/includes/foot'); ?>

<!-- inline scripts related to this page -->

<script>

function changebookingstatus(id){
	var status = $(".statusCode").val();
	 $.ajax({
				type:'post',
				url: '<?php echo base_url('admin/facility/changeStatus'); ?>',
				data: {id:id,status:status},
				success: function(res){
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
			});
	
};

</script>


</body>

</html>