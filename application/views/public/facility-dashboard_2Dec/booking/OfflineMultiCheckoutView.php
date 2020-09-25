<!DOCTYPE html>
<html>
<head>
	<title>Social Sportz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<!-- Fonts For Heading & SubHeadings -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<?php $this->load->view('public/common/head');?>
	<style>
	.panel-default>.panel-heading {    background-color: #ffeee9;}
	.l-sidebar{display:none}
	.bell-icon{display:none;}
	main.l-main {    padding: 95px 0 0 0px;}
	.checkoutitem .fa-trash{color:red;}
	th:first-child, td:first-child{padding-left:20px !important;}
	select.countrycode{
		width: 44px !important;
    position: absolute;
    padding: 0 4px !important;
    overflow: hidden;
    height: 38px !important;
	}

	#navbarDropdown{display:none;}
	
 .slotbooked
	{
		max-height:350px;
	}


	.c-header-icon a
	{
	display: block;
    width: 100%;
    height: 100%;
	}
	
</style>
</head>


<body class="dashboard sdsss">
	<div class="clearfix"></div>
	<?php $this->load->view('public/common/dashboard-sidebar');?>



	<main class="l-main">
		<div class="content-wrapper content-wrapper--with-bg">
			<div class="header-data">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="top-head-nav clearfix">
								<div class="page-title float-md-left">
									<h2>Checkout</h2>
								</div>
								<div class="navigation-bread float-md-right">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">	
											<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">My Dashboard</a></li>	
											<li class="breadcrumb-item active" aria-current="page">Checkout</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">

				<div class="row">
					<div class="col-lg-8 col-md-6 col-sm-7 col-xs-12 ">
						<form action="">

							<div class="row">
								<div class="col-md-6">
				<div class="form-group">
					<label for="userphone" style="z-index:99; top:1rem" class="bmd-label-floating is-focused">Phone Number</label>
	<select class="form-control countrycode" value="" style="min-height:38px;">
                    
		<option data-countryCode="IN" value="91" Selected>+91</option>
		
</select>
					<input type="text" class="form-control" id="userphone" onkeypress="validate(event)">
					<i class="fa fa-phone prefix"></i>
					<span id="errPhone" class="error"> </span>
				</div>
			</div>
								

                           
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="useremail" class="bmd-label-floating">Email</label>
										<input type="text" class="form-control" id="useremail" onkeyup="leftTrim(this)" >
										<input type="hidden" class="form-control" id="user_id">
										<i class="fa fa-envelope prefix"></i>
										<span id="errEmail" class="error"> </span>
									</div>
								</div>


								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="username1" class="bmd-label-floating">Name</label>
										<input type="text" class="form-control" id="username1" onkeyup="leftTrim(this)" onkeypress="return withoutspecialnumeric(event)">
										<i class="fa fa-user prefix"></i>
										<span id="errName1" class="error"> </span>	
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="gender" class="bmd-label-floating">Gender</label>
										<select class="form-control" id="gender">
											<option value="0"> Select Gender </option>
											<option class="abc" value="M"> Male </option>
											<option class="abc" value="F"> Female </option>
											<option class="abc" value="T"> Other </option>

										</select>
										<i class="fa fa-venus-mars prefix"></i>
										<span id="errGender" class="error"></span>	
									</div>
								</div>

								
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="usercity" class="bmd-label-floating">Address</label>
										<input type="text" class="form-control" id="useraddress" onkeyup="leftTrim(this)">
										<i class="fa fa-map-marker prefix"></i>
										<span id="errAddress" class="error"> </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="usercity" class="bmd-label-floating">City</label>
										<input type="text" class="form-control charval" id="usercity" onkeyup="leftTrim(this)">
										<input type="hidden" class="form-control" id="latitude">
										<input type="hidden" class="form-control" id="longitude">
										<i class="fa fa-map-marker prefix"></i>
										<span id="errCity" class="error"> </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="pincode" class="bmd-label-floating">Zip Code</label>
										<input type="text" class="form-control" id="pincode" onkeypress="validate(event)">
										<i class="fa fa-map-marker prefix"></i>
										<span id="errPincode" class="error"> </span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
										<label for="payment_type" class="bmd-label-floating">Payment Type</label>
										<select class="form-control" id="payment_type">
											<option value="0"> Select Payment Type </option>
											<option class="abc" value="cash"> Cash </option>
											<option class="abc" value="paytm"> Paytm </option>
											<option class="abc" value="google pay"> Google Pay </option>
											

										</select>
										<i class="fa fa-credit-card prefix" aria-hidden="true"></i>
										<span id="errPayment" class="error"></span>	
									</div>
								</div>







							</div></form>

						</div>
						<div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 ">
							<div id="mobileshow">  



								<div class="checkout-right btn-pay">


									<div class="c-right-head mobilehide">Booking Details</div>
									<div class="c-right-body">
										<div class="checkoutitem">
											<table class="item-bg">
												<thead>
													<tr>

														<th>Date</th>
														<th>Slot</th>
														<th>Price</th>
														<th>Action</th>
														<th></th>
													</tr>
												</thead> 
												<tbody>



													<?php
													$total_price = 0;
													if (isset($slot_batch) && !empty($slot_batch)) {  //echo "<pre>"; print_r($slot_batch); die;
													foreach ($slot_batch as $key => $valueTop){ //echo "<pre>"; echo $key; print_r($valueTop); die; 
														//$j=0;
														foreach ($valueTop as $value) { //echo "<pre>";  print_r($value); die;
															for($j=0; $j<count($value); $j++){
															if($this->session->userdata['package_id']!=''){

															$slot_price= $this->CommonMdl->getRow(' tbl_slot_package_price','slot_package_price,package_id',array('batch_slot_id'=>$value[$j]->batch_slot_id,'package_id'=>$this->session->userdata['package_id']));
															}
															else{
																$slot_price= $this->CommonMdl->getRow(' tbl_slot_package_price','slot_package_price',array('batch_slot_id'=>$value[$j]->batch_slot_id));
															}
															//echo $this->db->last_query(); die();
													

															?>

															<tr>
																<td class="ch-prod-name text-left">
																<?php echo date('d-m-Y', strtotime($key)); ?>
																</td>
																<td class="ch-prod-name text-left">
																	<h3><span Class="time"><?=$value[$j]->start_time.' - '.$value[$j]->end_time;?></span></h3>

																</td>
																<td class="ch-prod-price"><i class="fa fa-inr"></i> <?=$slot_price->slot_package_price;
																$total_price += $slot_price->slot_package_price;
																?>

															</td>

																<td class="ch-prod-quan">
																	<p><i class="fa fa-trash"><input type="hidden" class="slot_price" value="<?=$slot_price->slot_package_price;?>"></i></p>

																</td>
															<input type="hidden" class="sport_id" value="<?=$value[$j]->sport_id;?>">
															<input type="hidden" class="start_time" value="<?=$value[$j]->start_time;?>">
															<input type="hidden" class="end_time" value="<?=$value[$j]->end_time;?>">
															<input type="hidden" class="slot_package_price" value="<?=$slot_price->slot_package_price;?>">
															<input type="hidden" class="batch_slot_id" value="<?=$value[$j]->batch_slot_id;?>">
															<input type="hidden" class="batch_slot_date" value="<?=$key;?>">
															<input type="hidden" class="package_id" value="<?=@$slot_price->package_id;?>">
															<input type="hidden" class="batch_slot_type_id" value="<?=$value[$j]->batch_slot_type_id;?>">

															</tr>
													
															<?php //$j++;
															} } } } ?>



														</tbody>
													</table>
												</div>
												<table style="width:100%;">
													<tbody>
													</tbody><tfoot class="final-box">
														<tr>
															<td colspan="4"><strong><?=$this->session->userdata['fac_name'];?></strong></td>

														</tr>
														

														<tr>
															<td colspan="3">Payment Method</td>
															<td class="text-right cod" colspan="2" id="cod">Offline Payment</td>
														</tr>

														<tr>    
															<td colspan="2" style="font-size: 17px; color:#ec4612;">Total Payable</td>
															<td class="total-font text-right total1" colspan="3" id="total1"><i class="fa fa-inr"></i> <?=$total_price;?></td>
														</tr>




														<tr >    
															<td colspan="5" >
																<button   class="btn btn-default btn-block outline__btn orange-btn gapbtn" id= "paymentbooknow" href="JavaScript:Void(0)" ><i class="fa fa-arrow-right"></i> Book Now<div class="ripple-container"></div><div class="ripple-container"></div></button>
															</td><td>

															</tr>


														</tfoot>
													</table>
												</div>
											</div> 

										</div>
									</div>
								</div>
							</div>
						</div>	




						<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });
						
						jQuery(".c-header-icon").html('<a href="<?=base_url('dashboard');?>"><i class="fa fa-chevron-left"></i></a>');
						jQuery('.fa-trash').on("click", function(){
							jQuery(this).parents('tr').remove();
							var slot_price = $(this).find('.slot_price').val();
							var total = $('#total1').text();
							
							$('#total1').text(total-slot_price);
						});


function isEmailValid(email){
		return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
	}

$('#paymentbooknow').click(function(e) {
	var user_id = $('#user_id').val();
	var total_amount = $('#total1').text();
	var username = $('#username1').val();
	var gender = $("#gender").val();
	var gender_val=$( "#gender option:selected" ).val();
	var register_email = $('#useremail').val();
	var phone = $('#userphone').val();
	var validPhone= $.trim($('#userphone').val()).length;
	var address = $('#useraddress').val();
	var city = $('#usercity').val();
	var payment_type = $('#payment_type').val();
	var pincode = $('#pincode').val();		
	var validpincode= $.trim($('#pincode').val()).length;
	//alert(user_id);

	/*Checkout data*/
	//var batch_slot_type_id = $('.batch_slot_type_id').val();
	//var package_id = $('.package_id').val();


	var batch_slot_ids=[];
	$(".batch_slot_id").each(function() {
	batch_slot_ids.push($(this).val());
	});
	
	var batch_slot_date=[];
	$(".batch_slot_date").each(function() {
	batch_slot_date.push($(this).val());
	});
	
	//var batch_slot_id = batch_slot_ids.join(',');


	var start_times=[];
	$(".start_time").each(function() {
	start_times.push($(this).val());
	});
//var start_time = start_times.join(',');


var end_times=[];
$(".end_time").each(function() {
end_times.push($(this).val());
});
//var end_time = end_times.join(',');



var slot_pkg_price=[];
$(".slot_package_price").each(function() {
slot_pkg_price.push($(this).val());
});
//var slot_package_price = slot_pkg_price.join(',');

var package_id=[];
$(".package_id").each(function() {
package_id.push($(this).val());
});

var batch_slot_type_id=[];
$(".batch_slot_type_id").each(function() {
batch_slot_type_id.push($(this).val());
});

var sport_id=[];
$(".sport_id").each(function() {
sport_id.push($(this).val());
});
//var sport_ids = sport_id.join(',');

//alert(sport_ids);
if(phone == ''){
	$('#errPhone').show();
	$('#errPhone').html('Please enter mobile no.');
	$('html,body').animate({scrollTop: $("#errPhone").offset().top - 190},'slow');
	return false;
}else{
	$('#errPhone').html(''); 
}
if( validPhone < 8 || validPhone > 16){
	$('#errPhone').show();
	$('#errPhone').html('Please enter mobile no. between 8 and 15 characters');
	$('html,body').animate({scrollTop: $("#errPhone").offset().top - 190},'slow');
	return false;
}else{
	$('#errPhone').html(''); 
}

if(register_email == ''){
	$('#errEmail').show();
	$('#errEmail').html('Please enter email');
	$('html,body').animate({scrollTop: $("#errEmail").offset().top - 190},'slow');
	return false;
}
else if (!isEmailValid(register_email)) {
	$('#errEmail').show();
	$('#errEmail').html('Please enter valid email');
	$('html,body').animate({scrollTop: $("#errEmail").offset().top - 190},'slow');
	return false;
}
else{
	$('#errEmail').html('');
}

if(username == ''){
	$('#errusername').show();
	$('#errName1').html('Please Enter name');
	$('html,body').animate({scrollTop: $("#errEmail").offset().top - 190},'slow');
	return false;
}

else{
	$('#errName1').html('');
}
if(gender == 0)
{
	$('#errGender').html('Please Select Gender');
	return false;
}

else if(gender == 'M' || gender == 'F' || gender == 'T')
{
	$('#errGender').html('');	
}


if(address == ''){
	$('#errCity').show();
	$('#errAddress').html('Please enter address');
	$('html,body').animate({scrollTop: $("#errAddress").offset().top - 190},'slow');
	return false;
}else{
	$('#errAddress').html(''); 
}




if(city == ''){
	$('#errCity').show();
	$('#errCity').html('Please enter city');
	$('html,body').animate({scrollTop: $("#errCity").offset().top - 190},'slow');
	return false;
}else{
	$('#errCity').html(''); 
}

if(pincode == ''){
	$('#pincode').show();
	$('#errPincode').html('Please enter pincode');
	return false;
}
else{
	$('#errPincode').html('');
}

if(validpincode!=6){
	$('#pincode').show();
	$('#errPincode').html('Please enter 6 digit pincode');
	$('html,body').animate({scrollTop: $("#errPhone").offset().top - 190},'slow');
	return false;
}else{
	$('#errPincode').html(''); 
}

if(payment_type == 0)
{
	$('#payment_type').show();
	$('#errPayment').html('Please Select payment Type');
	return false;
}

else if(payment_type == 1)
{
	$('#errPayment').html('');	
}



$.ajax({
	type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/offline_booking_checkout',	
			data: {username:username,
			gender:gender,
			register_email:register_email,
			phone:phone,
			city:city,
			address:address,
			pincode:pincode,
			start_times:start_times,
			end_times:end_times,
			batch_slot_ids:batch_slot_ids,
			batch_slot_date:batch_slot_date,
			slot_pkg_price:slot_pkg_price,batch_slot_type_id:batch_slot_type_id,package_id:package_id,total_amount:total_amount,sport_id:sport_id,user_id:user_id,payment_type:payment_type},
			success:function(res){
				//alert(res);
			if(res!='failed'){
				swal({
				title : 'Booking has been done successfully',
				html : '',
				type: 'success'
			}).then((result) => {
				if (result.value) {
					window.location.href = '<?php echo base_url('facility/booking') ?>';
				}
			})

					
				}
				else{
				}				    

			}	
		});

});


$('#userphone').blur(function(){
	var userphone = $('#userphone').val();
	var countrycode=$( ".countrycode option:selected" ).text();
	if (userphone != '') {
		$.ajax({
			type:'post',
			url:'<?=base_url('facility/booking/user_data');?>',
			data:{userphone:userphone,countrycode:countrycode},
			success: function(res){
				var result = JSON.parse(res);
				//alert(result['user_data'].user_id);

				
				if (result['user_data'].user_id != undefined) {
					$('#username1').val(result['user_data'].user_name);
					$('#useremail').val(result['user_data'].user_email);
					$('#userphone').val(result['user_data'].user_mobile_no);
					$('#useraddress').val(result['user_data'].user_address);
					$('#usercity').val(result['user_data'].user_city);
					$('#pincode').val(result['user_data'].user_pincode);
					$('#gender').val(result['user_data'].user_gender);
					$('#user_id').val(result['user_data'].user_id);
				}
				else{
					//$('#errEmail').html("");
					//$(':input[type="button"]').prop('disabled', false);

				}
			}
		})
	}

});

setInterval(function(){
var phone = $('#userphone').val();
	if(phone.indexOf("+91") > -1){ phone = phone.substr(3); $('#userphone').val(phone);
    }
},100);

</script>



<?php $this->load->view('public/common/footer');?>
<?php $this->load->view('public/common/foot');?>
</body>
</html>	