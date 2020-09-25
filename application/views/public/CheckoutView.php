<!DOCTYPE html>
<html>

<head>
    <title>Social Sportz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <?php $this->load->view('public/common/head');?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <style>
		
		body {
    background: #fff !important;
}
		
		span.signUp{ color: #ec4613;}
		
		a.collapsed.loginview{
		font-size: 20px !important;
        color: #000;
        /* border-bottom: 2px solid #000; */
		font-weight: 600;
        text-transform: uppercase;		}
		
		
		
            .l-sidebar {
                display: none
            }
            
            .bell-icon {
                display: none
            }
            
            main.l-main {
                padding: 50px 0 0 0px
            }
            
            .checkoutitem .fa-trash {
                color: red
            }
            

            
            ul.topnav.topnav2 li:hover .card.userloginmenu {
                display: block !important;
                position: absolute !important;
                left: 0px !important;
                z-index: 99999999 !important;
                min-width: 215px !important;
                top: 60px
            }
            
            .panel-group input#userphone {
                width: calc(100% - 68px) !important;
                margin-left: 68px
            }
            
            label {
                left: 0;
                text-align: left
            }
        </style>
</head>

<body class="dashboard" id="checkoutsection">
    <div class="clearfix"></div>
  <?php $this->load->view('public/common/headeruser');?>
        <main class="l-main">
            <div class="content-wrapper content-wrapper--with-bg">
                <div class="header-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="top-head-nav clearfix">
                                    <div class="page-title float-md-left">
                                        <h2>Checkout</h2></div>
                                    <div class="navigation-bread float-md-right">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
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
                        <div class="col-lg-8 col-md-6 col-sm-7 col-xs-12 whitebgblock">
                            <form method="post">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div id="collapse2signup" class="panel-collapse collapse" aria-expanded="false">
                                            <h2 class="signup_title" style="margin-top: 10px;" class="panel-title text-center">User Details</h2>
                                            <div class="row">
										<div class="col-md-6">
											<div class="form-group bmd-form-group">
												<label for="username1" class="bmd-label-floating">User Name</label>
												<input type="text" class="form-control" id="username1" value="<?php if(isset($user_details)){echo $user_details->user_name; } ?>" readonly>

												<input type="hidden" class="" id="oauth_provider" value="1">
												<input type="hidden" class="" id="oauth_uid" value="">
												<i class="fa fa-user prefix"></i>
												<span id="errName1" class="error"> </span>  
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
												<label for="gender" class="bmd-label-floating">Gender</label>
												<select class="form-control" id="gender" readonly>
													<option value=""><?php if(isset($user_details)){ if($user_details->user_gender=='M'){echo 'Male'; }if($user_details->user_gender=='F'){ echo 'Female';} } ?></option>
													
												</select>
												<i class="fa fa-venus-mars prefix"></i>
												<span id="errGender" class="error"></span>  
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group bmd-form-group">
												<label for="useremail" class="bmd-label-floating">Email</label>
												<input type="text" class="form-control" id="useremail" value="<?php if(isset($user_details)){echo $user_details->user_email; } ?>" readonly>
												<i class="fa fa-envelope prefix"></i>
												<span id="errEmail" class="error"> </span>
											</div>
										</div>
            
            

									<div class="col-md-6">
										<div class="form-group bmd-form-group" style="margin-top: 5px;">
											<label for="userphone" style="z-index:99; top:11px" class="bmd-label-floating is-focused">Phone Number</label>
												<select class="form-control " readonly>
												<option><?php if(isset($user_details)){echo $user_details->user_mobile_no; } ?></option>
												</select>
											
											<i class="fa fa-phone prefix"></i>
											<span id="errPhone" class="error"> </span>
										</div>
									</div>

								   <div class="col-md-6">
										<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
											<label for="country" class="bmd-label-floating">Country</label>
											<select class="form-control" id="country" readonly>
												<option value="India"><?php if(isset($user_details)){echo $user_details->user_country; } ?></option>
											</select>
											   <img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/earth_red.png');?>">
												<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/earth_blue.png');?>">


										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group bmd-form-group" id="user_loc">
											<label for="usercity" class="bmd-label-floating">Location</label>
											<input type="text" class="form-control" id="usercity" value="<?php if(isset($user_details)){echo $user_details->user_address; } ?>" readonly>
											<input type="hidden" class="form-control" id="latitude">
											<input type="hidden" class="form-control" id="longitude">
											<i class="fa fa-map-marker prefix"></i>
											<span id="errCity" class="error"> </span>
										<div class="pac-container pac-logo" style="display: none; width: 211px; position: absolute; left: 963px; top: 416px;"></div></div>
									</div>				
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 ">
                            <div id="mobileshow">
                                <div class="checkout-right btn-pay">
                                    <div class="c-right-head mobilehide">Booking Details</div>

                                    <div class="c-right-body">
                                        <div class="row" style="margin-left: 0; margin-right: 0;  padding: 10px;">
                                          <div class="col-sm-12 headingorange">
                                          <strong><?php if(isset($fac_details)){echo $fac_details->fac_name; } ?></strong>
                                      </div>

                                      <div class="col-sm-12 headingorangenext">
                                          <strong>Sports:</strong> <?php if(isset($sport_details)){echo $sport_details->sport_name; } ?>
                                      </div>
                                      
                                  </div>
                                      
                                        <div class="checkoutitem">
                                            <table class="item-bg" cellpadding="0" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Slot</th>
                                                        <?php if($fac_details->fac_type=='academy'){?>
                                                        <th>Plan</th>
                                                        <?php } ?>
                                                        <th>Date</th>
                                                        <th>Price</th>
                                                        <th></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
												<?php 
													$total_price=0;
													foreach($cart_list_arr as $listVal){ 
													if($listVal->trial_booking !='yes'){
													$total_price = $total_price+$listVal->slot_package_price; } ?> 
                                                    <tr>
                                                        <td class="ch-prod-name">
                                                            <h3> <?php echo $listVal->start_time .' - '.$listVal->end_time; ?></h3></td>
                                                            <?php if($fac_details->fac_type=='academy'){?>
                                                            <td class="ch-prod-name">
                                                            <h3> <?php if($listVal->trial_booking =='yes'){ echo "Trail"; }else{ echo $listVal->package_name; } ?></h3></td>
                                                            <?php } ?>
                                                            <td class="ch-prod-name">
                                                            <h3> <?php echo date('d-m-Y',strtotime($listVal->book_date));?></h3></td>
                                                        <td class="ch-prod-price"><i class="fa fa-inr"></i> <?php if($listVal->trial_booking =='yes'){ echo '0'; }else{ echo $listVal->slot_package_price; } ?></td>
                                                       <?php if(count($cart_list_arr)>1){?> 
														<td class="ch-prod-quan removeItem">
															<input type="hidden" class="cart_id" value="<?php echo $listVal->cart_id; ?>">
                                                            <p><i class="fa fa-trash"></i></p>
                                                        </td>
													   <?php } ?>
                                                    </tr>
												<?php }  ?>	
                                                  
                                                </tbody>
                                            </table>

                                        </div>


                              <form method="post" action="<?=base_url('booking/booking_now');?>">
                                       <div class="row bookingrow">

                                        <div class="col-sm-6" style="padding-top: 10px">
                                        Total Amount :
                                        </div>
                                        <div class="col-sm-6 text-right" style="padding-right: 26px;padding-top: 10px">
                                         <strong><i class="fa fa-inr"></i> <span class="total_price"><?php echo $total_price; ?></span></strong>
                                        </div>
                                               
                                    

                                      <div class="col-sm-12 couponwrapper">
                                                    <input type="text" class="coupon_code" name="coupon_code" placeholder="Coupon Code">
                                                        <a href="JavaScript:Void(0)" class="btn btn-info applycouponbtn" id="applybtn">Apply</a>
                                                        <span class="couponmessage green"></span>
                                      </div>
                                      <input type="hidden" id="coupon_code_hidden" name="coupon_code_hidden" value="">
                                      </div>

                                        <table style="width:100%;" cellpadding="0" cellspacing="0">
                                            <tbody></tbody>
                                            <tfoot class="final-box">
                                                    <tr>
                                                    <td colspan="3">Coupon Discount</strong>
                                                    </td>
                                                    <td colspan="2" class="text-right">(-) <i class="fa fa-inr"></i><span class="coupon_price">0</span> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-size: 17px; color:#ec4612; padding-top:0px">Total Payable</td>
                                                    <td class="total-font text-right total1" style="padding-top:0px" colspan="3" id="total1"><i class="fa fa-inr"></i> <span class="final_amt"><?php echo $total_price; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
													
                                                       <!--  <a class="btn btn-default btn-block outline__btn orange-btn " id="paymentbooknow" href="<?php if(count($cart_list_arr)>0){ echo base_url('booking/booking_now'); } ?>"><i class="fa fa-arrow-right"></i> Book Now</a> -->
                                                         <input type="Submit" class="btn btn-default btn-block outline__btn orange-btn " id="paymentbooknow" value="Book Now"> 
                                                   
												   </td>
                                                    <td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

							
	<div class="loader">
		<div class="">
			<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
		</div>
	</div>
      <?php $this->load->view('public/common/footer');?>
	  <?php $this->load->view('public/common/foot');?>
                  
<script>

	$('#collapse1').slideUp();
	$('#collapse2signup').slideDown();
	$(".loginheading h4").css("display","none")
	
	
	/* ******** remove items into cart here ************ */
	$(document).on("click",".removeItem",function() {
		var cart_id = $(this).find('.cart_id').val();	
		//alert(cart_id); return false;
		swal({
		  text: 'Are you sure want to remove?',					 
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Delete'
		}).then((result)=> {
			if(result.value){
				$.ajax({
					type: 'POST',
					url: '<?=base_url();?>booking/remove_item_to_cart',
					data:{cart_id:cart_id},
					success:function(res){ 
						window.location.reload();
						//$("#ajax_side_view").html(res['_html']);
					}
				})
			}
		})	
	});

    $(document).on("click",".applycouponbtn",function() {
        var coupon_code = $('.coupon_code').val();
        var total_price = $('.total_price').text();

        var after_coupon_applied = '';
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url();?>booking/apply_coupon',
                    data:{coupon_code:coupon_code,total_price:total_price},
                    success:function(res){
                        if(res!=0){
                            $('.coupon_price').text(res);
                            after_coupon_applied = total_price-res;
                            $('.final_amt').text(after_coupon_applied);
                            $('.couponmessage').text('Your Coupon has applied');
                            $('#coupon_code_hidden').val(coupon_code);

                        }
                        else if(res==0){
                            $('.couponmessage').remove('green');
                            $('.couponmessage').addClass('red');
                             $('.coupon_price').text('0');
                            $('.final_amt').text(total_price);
                            $('.couponmessage').text('Coupon is not valid');
                            $('#coupon_code_hidden').val('');  
                        }
                    }
                })
         
    });
	//alert('okkkkkkkkkkkkk');
 </script>
</body>

</html>