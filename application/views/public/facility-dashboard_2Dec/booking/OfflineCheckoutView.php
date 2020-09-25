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

	.c-header-icon a
	{
	display: block;
    width: 100%;
    height: 100%;
	}

	#navbarDropdown{display:none;}
</style>
</head>


<body class="dashboard">
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
                    
		<!-- <option data-countryCode="GB" value="44" >+44</option>
		<option data-countryCode="US" value="1">+1</option>
		<option data-countryCode="DZ" value="213">+213</option>
		<option data-countryCode="AD" value="376">+376</option>
		<option data-countryCode="AO" value="244">+244</option>
		<option data-countryCode="AI" value="1264">+1264</option>
		<option data-countryCode="AG" value="1268">+1268</option>
		<option data-countryCode="AR" value="54">+54</option>
		<option data-countryCode="AM" value="374">+374</option>
		<option data-countryCode="AW" value="297">+297</option>
		<option data-countryCode="AU" value="61">+61</option>
		<option data-countryCode="AT" value="43">+43</option>
		<option data-countryCode="AZ" value="994">+994</option>
		<option data-countryCode="BS" value="1242">+1242</option>
		<option data-countryCode="BH" value="973">+973)</option>
		<option data-countryCode="BD" value="880">+880)</option>
		<option data-countryCode="BB" value="1246">+1246)</option>
		<option data-countryCode="BY" value="375">+375)</option>
		<option data-countryCode="BE" value="32">+32)</option>
		<option data-countryCode="BZ" value="501">+501)</option>
		<option data-countryCode="BJ" value="229">+229)</option>
		<option data-countryCode="BM" value="1441">+1441)</option>
		<option data-countryCode="BT" value="975">+975)</option>
		<option data-countryCode="BO" value="591">+591)</option>
		<option data-countryCode="BA" value="387">+387)</option>
		<option data-countryCode="BW" value="267">+267)</option>
		<option data-countryCode="BR" value="55">+55)</option>
		<option data-countryCode="BN" value="673">+673)</option>
		<option data-countryCode="BG" value="359">+359)</option>
		<option data-countryCode="BF" value="226">+226)</option>
		<option data-countryCode="BI" value="257">+257)</option>
		<option data-countryCode="KH" value="855">+855)</option>
		<option data-countryCode="CM" value="237">+237)</option>
		<option data-countryCode="CA" value="1">+1)</option>
		<option data-countryCode="CV" value="238">+238)</option>
		<option data-countryCode="KY" value="1345">+1345)</option>
		<option data-countryCode="CF" value="236">+236)</option>
		<option data-countryCode="CL" value="56">+56)</option>
		<option data-countryCode="CN" value="86">+86)</option>
		<option data-countryCode="CO" value="57">+57)</option>
		<option data-countryCode="KM" value="269">+269)</option>
		<option data-countryCode="CG" value="242">+242)</option>
		<option data-countryCode="CK" value="682">+682)</option>
		<option data-countryCode="CR" value="506">+506)</option>
		<option data-countryCode="HR" value="385">+385)</option>
		<option data-countryCode="CU" value="53">+53)</option>
		<option data-countryCode="CY" value="90392">+90392)</option>
		<option data-countryCode="CY" value="357">+357)</option>
		<option data-countryCode="CZ" value="42">+42)</option>
		<option data-countryCode="DK" value="45">+45)</option>
		<option data-countryCode="DJ" value="253">+253)</option>
		<option data-countryCode="DM" value="1809">+1809)</option>
		<option data-countryCode="DO" value="1809">+1809)</option>
		<option data-countryCode="EC" value="593">+593)</option>
		<option data-countryCode="EG" value="20">+20)</option>
		<option data-countryCode="SV" value="503">+503</option>
		<option data-countryCode="GQ" value="240">+240</option>
		<option data-countryCode="ER" value="291">+291</option>
		<option data-countryCode="EE" value="372">+372</option>
		<option data-countryCode="ET" value="251">+251</option>
		<option data-countryCode="FK" value="500">+500</option>
		<option data-countryCode="FO" value="298">+298</option>
		<option data-countryCode="FJ" value="679">+679</option>
		<option data-countryCode="FI" value="358">+358</option>
		<option data-countryCode="FR" value="33">+33</option>
		<option data-countryCode="GF" value="594">+594</option>
		<option data-countryCode="PF" value="689">+689</option>
		<option data-countryCode="GA" value="241">+241</option>
		<option data-countryCode="GM" value="220">+220</option>
		<option data-countryCode="GE" value="7880">+7880</option>
		<option data-countryCode="DE" value="49">+49</option>
		<option data-countryCode="GH" value="233">+233</option>
		<option data-countryCode="GI" value="350">+350</option>
		<option data-countryCode="GR" value="30">+30</option>
		<option data-countryCode="GL" value="299">+299</option>
		<option data-countryCode="GD" value="1473">+1473</option>
		<option data-countryCode="GP" value="590">+590</option>
		<option data-countryCode="GU" value="671">+671</option>
		<option data-countryCode="GT" value="502">+502</option>
		<option data-countryCode="GN" value="224">+224</option>
		<option data-countryCode="GW" value="245">+245</option>
		<option data-countryCode="GY" value="592">+592</option>
		<option data-countryCode="HT" value="509">+509</option>
		<option data-countryCode="HN" value="504">+504</option>
		<option data-countryCode="HK" value="852">+852</option>
		<option data-countryCode="HU" value="36">+36</option>
		<option data-countryCode="IS" value="354">+354</option> -->
		<option data-countryCode="IN" value="91" Selected>+91</option>
		<!-- <option data-countryCode="ID" value="62">+62</option>
		<option data-countryCode="IR" value="98">+98</option>
		<option data-countryCode="IQ" value="964">+964</option>
		<option data-countryCode="IE" value="353">+353</option>
		<option data-countryCode="IL" value="972">+972</option>
		<option data-countryCode="IT" value="39">+39</option>
		<option data-countryCode="JM" value="1876">+1876</option>
		<option data-countryCode="JP" value="81">+81</option>
		<option data-countryCode="JO" value="962">+962</option>
		<option data-countryCode="KZ" value="7">+7</option>
		<option data-countryCode="KE" value="254">+254</option>
		<option data-countryCode="KI" value="686">+686</option>
		<option data-countryCode="KP" value="850">+850</option>
		<option data-countryCode="KR" value="82">+82</option>
		<option data-countryCode="KW" value="965">+965</option>
		<option data-countryCode="KG" value="996">+996</option>
		<option data-countryCode="LA" value="856">+856</option>
		<option data-countryCode="LV" value="371">+371</option>
		<option data-countryCode="LB" value="961">+961</option>
		<option data-countryCode="LS" value="266">+266</option>
		<option data-countryCode="LR" value="231">+231</option>
		<option data-countryCode="LY" value="218">+218</option>
		<option data-countryCode="LI" value="417">+417</option>
		<option data-countryCode="LT" value="370">+370</option>
		<option data-countryCode="LU" value="352">+352</option>
		<option data-countryCode="MO" value="853">+853</option>
		<option data-countryCode="MK" value="389">+389</option>
		<option data-countryCode="MG" value="261">+261</option>
		<option data-countryCode="MW" value="265">+265</option>
		<option data-countryCode="MY" value="60">+60</option>
		<option data-countryCode="MV" value="960">+960</option>
		<option data-countryCode="ML" value="223">+223</option>
		<option data-countryCode="MT" value="356">+356</option>
		<option data-countryCode="MH" value="692">+692</option>
		<option data-countryCode="MQ" value="596">+596</option>
		<option data-countryCode="MR" value="222">+222</option>
		<option data-countryCode="YT" value="269">+269</option>
		<option data-countryCode="MX" value="52">+52</option>
		<option data-countryCode="FM" value="691">+691</option>
		<option data-countryCode="MD" value="373">+373</option>
		<option data-countryCode="MC" value="377">+377</option>
		<option data-countryCode="MN" value="976">+976</option>
		<option data-countryCode="MS" value="1664">+1664</option>
		<option data-countryCode="MA" value="212">+212</option>
		<option data-countryCode="MZ" value="258">+258</option>
		<option data-countryCode="MN" value="95">+95</option>
		<option data-countryCode="NA" value="264">+264</option>
		<option data-countryCode="NR" value="674">+674</option>
		<option data-countryCode="NP" value="977">+977</option> -->
 
	
</select>
					<input type="text" class="form-control" id="userphone" onkeypress="validate(event)">
					<i class="fa fa-phone prefix"></i>
					<span id="errPhone" class="error"> </span>
				</div>
			</div>
								

                           
								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="useremail" class="bmd-label-floating">Email</label>
										<input type="text" class="form-control" id="useremail" onkeyup="leftTrim(this)">
										<input type="hidden" class="form-control" id="user_id">
										<i class="fa fa-envelope prefix"></i>
										<span id="errEmail" class="error"> </span>
									</div>
								</div>


								<div class="col-md-6">
									<div class="form-group bmd-form-group">
										<label for="username1" class="bmd-label-floating">Name</label>
										<input type="text" class="form-control" id="username1" onkeyup="leftTrim(this) " onkeypress="return withoutspecialnumeric(event)">
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

														<th>Batch</th>
														<th>Price</th>
														<th>Action</th>
														<th></th>
													</tr>
												</thead> 
												<tbody>



													<?php
													$total_price = 0;
													if (isset($slot_batch) && !empty($slot_batch)) {
														foreach ($slot_batch as $value) {
															
															if($this->session->userdata['package_id']!=''){

															$slot_price= $this->CommonMdl->getRow(' tbl_slot_package_price','slot_package_price,package_id',array('batch_slot_id'=>$value->batch_slot_id,'package_id'=>$this->session->userdata['package_id']));
															}
															else{
																$slot_price= $this->CommonMdl->getRow(' tbl_slot_package_price','slot_package_price',array('batch_slot_id'=>$value->batch_slot_id));
															}
															//echo $this->db->last_query(); die();
													

															?>

															<tr>
																<td class="ch-prod-name text-left">
																	<h3><span Class="time"><?=$value->start_time.' - '.$value->end_time;?></span></h3>

																</td>
																<td class="ch-prod-price"><i class="fa fa-inr"></i> <?=$slot_price->slot_package_price;
																$total_price += $slot_price->slot_package_price;
																?>

															</td>

																<td class="ch-prod-quan">
																	<p><i class="fa fa-trash"><input type="hidden" class="slot_price" value="<?=$slot_price->slot_package_price;?>"></i></p>

																</td>
																<input type="hidden" class="sport_id" value="<?=$value->sport_id;?>">

													<input type="hidden" class="start_time" value="<?=$value->start_time;?>">
													<input type="hidden" class="end_time" value="<?=$value->end_time;?>">
														<input type="hidden" class="slot_package_price" value="<?=$slot_price->slot_package_price;?>">
														<input type="hidden" class="batch_slot_id" value="<?=$value->batch_slot_id;?>">
														<input type="hidden" class="package_id" value="<?=@$slot_price->package_id;?>">
														<input type="hidden" class="batch_slot_type_id" value="<?=$value->batch_slot_type_id;?>">

															</tr>
													
															<?php } } ?>



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
															<td colspan="3">Booking Date</strong></td>
															<td colspan="2" class="text-right booking_date" id="booking_date"><span class="time"><?=$this->session->userdata['booking_date'];?></span></td>                                                   
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
	var booking_date = $('#booking_date').text();
	var total_amount = $('#total1').text();
	var username = $('#username1').val();
	var gender = $("#gender").val();
	var gender_val=$( "#gender option:selected" ).val();
	var register_email = $('#useremail').val();
	var phone = $('#userphone').val();
	var countrycode=$( ".countrycode option:selected" ).text();
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
			data: {username:username,gender:gender,register_email:register_email,phone:phone,city:city,address:address,pincode:pincode,start_times:start_times,end_times:end_times,batch_slot_ids:batch_slot_ids,slot_pkg_price:slot_pkg_price,batch_slot_type_id:batch_slot_type_id,package_id:package_id,total_amount:total_amount,sport_id:sport_id,booking_date:booking_date,user_id:user_id,payment_type:payment_type,countrycode:countrycode},
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