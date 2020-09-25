<!DOCTYPE html>

<html lang="en">

<?php $this->load->view('admin/includes/head');?> 
<style>
	#dynamic-table_wrapper{clear: both;}
	#banner_submit{width: 120px !important}
	
	.form-group .bigger-110.fa-calendar {
    top: -20px !important;
}
</style>	
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
								<li class="active">Coupon List</li>
							</ul><!-- /.breadcrumb -->


						</div>



						<div class="page-content">
							<div class="page-header">

								<div class="table-header">
									Add / Edit Coupon
									<ul style="display:inline-block;float:right;margin-right:12px; cursor:pointer;margin:0px 0px;" id="contactdata">
												   <a href="<?=base_url('admin/facility/excelcoupon');?>"><img src="<?=base_url();?>assets/admin/images/Excel-icon.png" style="width:32px; margin-right:8px;"></a>
											  </ul>
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

										echo form_open_multipart('admin/facility/add_coupoun',array('class'=>'form-horizontal')); ?>

										<?php echo form_error(''); ?>
                                    <div class="row">
									
									  <div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Coupon name</label>
												<div class="col-sm-10">
													<?php echo form_input(array('name'=>'coupon_name','id'=>'coupon_name','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Coupon name','required'=>'')); ?>
													<span id="errcouponname" class="error">  </span>
												</div>
											</div>
										</div>	
										
                                        
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Coupon code </label>
												<div class="col-sm-10">
													<?php echo form_input(array('name'=>'coupon_code','id'=>'coupon_code','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Coupon code','required'=>'')); ?>
													<span id="errcouponcode" class="error">  </span>
												</div>
											</div>
										</div>									
										
										
										</div>
										<div class="row">
										<div class="col-md-6">

											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> min cart amount </label>
												<div class="col-sm-10">
													<?php echo form_input(array('name'=>'coupon_amount','id'=>'coupon_amount','class'=>'col-xs-5 col-sm-5', 'onkeypress'=>'validate(event)' ,'Placeholder'=>'Min cart amount','required'=>'')); ?>
													<span id="errcouponamount" class="error">  </span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Coupon discount flat </label>
												<div class="col-sm-10">
													<?php echo form_input(array('name'=>'discount_flat','id'=>'discount_flat','class'=>'col-xs-5 col-sm-5', 'onkeypress'=>'validate(event)' ,'Placeholder'=>'Coupon discount flat','required'=>'')); ?>
													<span id="errcoupondiscountflat" class="error">  </span>
												</div>
											</div>
											</div>
										</div>
											<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="col-sm-2 control-label no-padding-right" style="margin-left:22px;" for="form-field-1" >Start Date </label>
															<div class="col-sm-10">
															<input class="date-picker-from" id="start_date" name="start_date" value="" type="text" readonly data-date-format="dd-mm-yyyy"  />
															<input type="hidden" value="fac_filter" name="action">
															<span class="">
															<i class="fa fa-calendar bigger-110 calin" style="margin-left:22px;"></i>
															</span>
															<span id="erracademystartdate" class="error"> </span>
														</div>
														</div>
													 </div>
													 
											<div class="col-md-6">
												<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1">End Date </label>
												<div class="col-sm-10">
												<input class="date-picker-to" id="end_date" name="end_date" value="" type="text" readonly data-date-format="dd-mm-yyyy" />
												<span class="">
												<i class="fa fa-calendar bigger-110 calin"></i>
												</span>
												<span id="erracademyenddate" class="error"> </span>
											</div>
												</div>
												</div>
											</div>
										
										
										
										
										
									       <div class="col-md-6">											
												<?php echo form_submit(['class'=>'btn btn-info','id'=>'banner_submit','value'=>'Submit']); ?>											
                                            </div>
                                      </div>
									  </div>

										<?php echo form_close(); }
                             //Edit banner
										else{

											echo form_open_multipart('admin/facility/edit_coupon',array('class'=>'form-horizontal')); 
											 //= print_data($editcoupondata);
											?>

											<?php echo form_error(''); ?> 
											
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Coupon name</label>
													<div class="col-sm-10">
													  
														<?php echo form_input(array('name'=>'coupon_name','id'=>'coupon_name','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Coupon name','value'=>$editcoupondata->coupon_name)); ?>
														<span id="errcouponname" class="error">  </span>
													</div>
												</div>
											</div>	
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Coupon code </label>
												<div class="col-sm-10">
												 <?php echo form_input(array('name'=>'coupon_codes','id'=>'coupon_codes','class'=>'coupon_codes col-xs-5 col-sm-5','Placeholder'=>'Coupon code','value'=>$editcoupondata->coupon_code)); ?>
												 <?php echo form_input(array('name'=>'coupon_id','id'=>'coupon_id','class'=>'col-xs-5 col-sm-5','Placeholder'=>'Coupon code','type'=>'hidden','required'=>'','value'=>$editcoupondata->coupon_id)); ?>
												  	
													<span id="errcouponcode" class="error">  </span>
												</div>
											</div>
										</div>									
										
										
										</div>
										<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Min cart amount </label>
												<div class="col-sm-10">
													<?php echo form_input(array('name'=>'coupon_amounts','id'=>'coupon_amount','class'=>'col-xs-5 col-sm-5','onkeypress'=>'validate(event)' ,'Placeholder'=>'Coupon Amount','required'=>' Min cart amount','value'=>$editcoupondata->cart_min_amount)); ?>
													<span id="errcouponamount" class="error">  </span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Coupon discount flat (amount)</label>
												<div class="col-sm-10">
													<?php echo form_input(array('name'=>'discount_flats','id'=>'discount_flat','class'=>'col-xs-5 col-sm-5','onkeypress'=>'validate(event)' ,'Placeholder'=>'Coupon discount flat (amount)','required'=>'','value'=>$editcoupondata->coupon_flat_amount)); ?>
													<span id="errcoupondiscount" class="error">  </span>
												</div>
											</div>
											</div>
											
											<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="col-md-3 control-label no-padding-right" style="margin-left:22px;" for="form-field-1" >Start Date </label>
															<input class="date-picker-from" id="start_date" name="start_date" value="<?php if(isset($editcoupondata)){echo date('d-m-Y',strtotime($editcoupondata->coupon_start_date));}  ?>" type="text" readonly data-date-format="dd-mm-yyyy"  />
															<input type="hidden" value="fac_filter" name="action">
															<span class="">
															<i class="fa fa-calendar bigger-110 calin" style="margin-left:22px;"></i>
															</span>
															<span id="erracademystartdate" class="error"> </span>
														</div>
													 </div>
													 
											<div class="col-md-3">
												<div class="form-group">
												<label class="col-md-3 control-label no-padding-right" for="form-field-1">End Date </label>
												<input class="date-picker-to" id="end_date" name="end_date" value="<?php if(isset($editcoupondata)){echo date('d-m-Y',strtotime($editcoupondata->coupon_end_date));}  ?>" type="text" readonly data-date-format="dd-mm-yyyy" />
												<span class="">
												<i class="fa fa-calendar bigger-110 calin"></i>
												</span>
												<span id="erracademyenddate" class="error"> </span>
												</div>
												</div>
											</div>

										
									       <div class="col-md-6">											
												<?php echo form_submit(['class'=>'btn btn-info','id'=>'edit_submit','value'=>'Submit']); ?>											
                                            </div>
                                      </div>
									  </div>
								<?php echo form_close();} ?>						

											</div><!-- /.col -->

										<table id="dynamic-table" class="table table-striped table-bordered table-hover">

											<thead>

												<tr>

													<th>S.N</th>
													<th>Coupon Name</th>
													<th>Coupon Code</th>
													<th>Min Cart Amount</th>							
													<th>Coupon Flat Amount</th>
													<th>Coupon Start Date</th>
													<th>Coupon End Date</th>
													<th>Action</th>
												</tr>

											</thead>

											<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

												<tr>

													<td><?php echo $i; ?></td>

													<td><?php echo $result->coupon_name; ?></td>
													<td><?php echo $result->coupon_code; ?></td>
													<td><?php echo $result->cart_min_amount; ?></td>
													<td><?php echo $result->coupon_flat_amount; ?></a></td>
													<td><?php echo date('d-m-Y',strtotime($result->coupon_start_date)); ?></td>
													<td><?php echo date('d-m-Y',strtotime($result->coupon_end_date)); ?></td>

												
													<td>

														<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/facility/couponinsert/'.$result->coupon_id); ?>">

																<i class="ace-icon fa fa-pencil bigger-130"></i>

															</a>

															<a class="red" href="<?php echo base_url('admin/facility/delete_coupon/'.$result->coupon_id); ?>" onclick="return confirm('Are you sure you want to delete coupon?')">

																<i class="ace-icon fa fa-trash-o bigger-130"></i>

															</a>

														</div>

													</td>

												</tr>

												<?php  $i++;	}

											} ?>

										</tbody>

									</table>
										</div>

										<hr />


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
$('#coupon_codes').keyup(function(){
	 var coupon_code = $('#coupon_codes').val();
	 var coupon_id = $('#coupon_id').val();
 if (coupon_code != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/facility/exist_coupon_name');?>',
    data:{coupon_code:coupon_code,coupon_id:coupon_id},
    success: function(data){
		if (data == 1) {
        $('#errcouponcode').html("Coupon code alredy exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errcouponcode').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
      
    }
  })
 }
});

$('#coupon_code').keyup(function(){
 var coupon_code = $('#coupon_code').val();
 if (coupon_code != '') {
  $.ajax({
    type:'post',
    url:'<?=base_url('admin/facility/check_coupon_code');?>',
    data:{coupon_code:coupon_code},
    success: function(data){
      if (data == 1) {
        $('#errcouponcode').html("Coupon code alredy exist");
        $(':input[type="submit"]').prop('disabled', true);
      }
      else{
        $('#errcouponcode').html("");
        $(':input[type="submit"]').prop('disabled', false);

      }
    }
  })
 }

 });
  $(document).on("click","#banner_submit",function(){
	   var coupon_name=$('#coupon_name').val().trim();
	   var coupon_code=$('#coupon_code').val().trim();
	   var coupon_amount=parseInt($('#coupon_amount').val());
	   var coupon_discount=parseInt($('#discount_flat').val());
	   var couponstartdate = $("input[name='start_date']").val().trim();
	   var couponenddate = $("input[name='end_date']").val().trim();
	   var endateArr = [];
	   var startateArr = [];
	   var currentdateArr = [];
	   let current_datetime = new Date()
	   let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear()
	   currentdateArr = formatted_date.split('-');
	   endateArr = couponenddate.split('-');
	   startateArr = couponstartdate.split('-');	
	
	  
  if(coupon_name == ''){
	   $('#errcouponname').html('Please enter coupon name');
	  return false;
  }else{
	  $('#errcouponname').html('');
  }if(coupon_code == ''){
	   $('#errcouponcode').html('Please enter coupon code');
	  return false;
  }else{
	  $('#errcouponcode').html('');
  }if(coupon_amount == ''){
	  $('#errcouponamount').html('Please enter coupon Amount');
	  return false;
  }else{
	   $('#errcouponamount').html('');
  }
  if(coupon_discount == ''){
	  $('#errcoupondiscountflat').html('Please enter coupon descount');
	  return false;
  }else{
	  $('#errcoupondiscountflat').html('');
  }
  if(coupon_discount > coupon_amount){
	  $('#errcoupondiscountflat').html('Coupon discount should be less then min cart amount');
	  return false;
  }else{
	  $('#errcoupondiscountflat').html('');
  }
  if(parseInt(startateArr[2]) >= parseInt(currentdateArr[2])){
		$('#erracademystartdate').html("");
		if((parseInt(startateArr[1]) >= parseInt(currentdateArr[1])) ||(parseInt(startateArr[2]) > parseInt(currentdateArr[2]))){
			$('#erracademystartdate').html("");
			if((parseInt(startateArr[0]) >= parseInt(currentdateArr[0])) || (parseInt(startateArr[1]) > parseInt(currentdateArr[1])) || (parseInt(startateArr[2]) > parseInt(currentdateArr[2]))){
				$('#erracademystartdate').html("");
			}else{
				$('#erracademystartdate').show();
				$('#erracademystartdate').html("Start date should be greater than cureent date");
				$('html,body').animate({scrollTop: $("#erracademystartdate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#erracademystartdate').show();
			$('#erracademystartdate').html("Start date should be greater than current date");
			$('html,body').animate({scrollTop: $("#erracademystartdate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#erracademystartdate').show();
		$('#erracademystartdate').html("Start date should be greater than current date");
		$('html,body').animate({scrollTop: $("#erracademystartdate").offset().top - 120},'slow');
		return false;
	}
	if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
		$('#erracademyenddate').html("");
		if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
			$('#erracademyenddate').html("");
			if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#erracademyenddate').html("");
			}else{
				$('#erracademyenddate').show();
				$('#erracademyenddate').html("End date should be greater than start date");
				$('html,body').animate({scrollTop: $("#erracademyenddate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#erracademyenddate').show();
			$('#erracademyenddate').html("End date should be greater than start date");
			$('html,body').animate({scrollTop: $("#erracademyenddate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#erracademyenddate').show();
		$('#erracademyenddate').html("End date should be greater than start date");
		$('html,body').animate({scrollTop: $("#erracademyenddate").offset().top - 120},'slow');
		return false;
	}
  return true;
  });
  $(document).on("click","#edit_submit",function(){
	   var coupon_names=$('#coupon_name').val().trim();
	   var coupon_code=$('#coupon_codes').val().trim();
	   var coupon_amount=parseInt($('#coupon_amount').val());
	   var coupon_discount=parseInt($('#discount_flat').val());
	   var couponstartdate = $("input[name='start_date']").val().trim();
	   var couponenddate = $("input[name='end_date']").val().trim();
	   var endateArr = [];
	   var startateArr = [];
	   var currentdateArr = [];
	   let current_datetime = new Date()
	   let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear()
	   currentdateArr = formatted_date.split('-');
	   endateArr = couponenddate.split('-');
	   startateArr = couponstartdate.split('-');
	   
  if(coupon_names == ''){
	   $('#errcouponname').html('Please enter coupon name');
	  return false;
  }else{
	  $('#errcouponname').html('');
  }if(coupon_code == ''){
	   $('#errcouponcode').html('Please enter coupon code');
	  return false;
  }else{
	  $('#errcouponcode').html('');
  }if(coupon_amount == ''){
	  $('#errcouponamount').html('Please enter coupon Amount');
	  return false;
  }else{
	   $('#errcouponamount').html('');
  }if(coupon_discount == ''){
	  $('#errcoupondiscount').html('Please enter coupon descount');
	  return false;
  }else{
	  $('#errcoupondiscount').html('');
  }if(coupon_discount > coupon_amount){
	  $('#errcoupondiscount').html('Coupon discount should be less then min cart amount');
	  return false;
  }else{
	  $('#errcoupondiscount').html('');
  }
   
	if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
		$('#erracademyenddate').html("");
		if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
			$('#erracademyenddate').html("");
			if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#erracademyenddate').html("");
			}else{
				$('#erracademyenddate').show();
				$('#erracademyenddate').html("End date should be greater than start date");
				$('html,body').animate({scrollTop: $("#erracademyenddate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#erracademyenddate').show();
			$('#erracademyenddate').html("End date should be greater than start date");
			$('html,body').animate({scrollTop: $("#erracademyenddate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#erracademyenddate').show();
		$('#erracademyenddate').html("End date should be greater than start date");
		$('html,body').animate({scrollTop: $("#erracademyenddate").offset().top - 120},'slow');
		return false;
	}
  return true;
  });



function validate(evt) {
			var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	  	key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode(key);
	}
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}
</script>