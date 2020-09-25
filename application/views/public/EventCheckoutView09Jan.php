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
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
											<label for="userphone" style="z-index:99; top:19px" class="bmd-label-floating is-focused">Phone Number</label>
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
											   <img alt="sports icon" class="sportsimgicon redicon" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/earth_red.png">
												<img alt="sports icon" class="sportsimgicon blueicon" src="https://vibestest.com/wip_projects/development/socialsportz/assets/public/images/earth_blue.png">


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
                                    <div class="c-right-head mobilehide">Event Booking Details</div>

                                    <div class="c-right-body">
                                        <div class="row" style="margin-left: 0; margin-right: 0;  padding: 10px;">
                                          <div class="col-sm-12 headingorange">
                                          <strong><?php if(isset($fac_name)){echo $fac_name; } ?></strong>
                                      </div>

                                      <div class="col-sm-12 headingorangenext">
                                          <strong>Event:</strong> <?php if(isset($event_details)){echo $event_details->event_name; } ?>
                                      </div>
                                      
                                  </div>
                                      
                                        <div class="checkoutitem">
                                            <table class="item-bg" cellpadding="0" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<tr>
													<td class="ch-prod-name">
														<h3> <?php echo date('d-m-Y',strtotime($event_details->event_start_date));?></h3></td>
													<td class="ch-prod-name">
														<h3> <?php echo date('d-m-Y',strtotime($event_details->event_end_date));?></h3></td>
													<td class="ch-prod-name">
														<h3> <?php echo $event_details->event_start_time;?></h3></td>
													<td class="ch-prod-name">
														<h3> <?php echo $event_details->event_end_time;?></h3></td>
													<td class="ch-prod-price"><i class="fa fa-inr"></i> <?php echo $event_details->event_price; ?></td>
												</tr>
												</tbody>
                                            </table>
                                        </div>


                                       <div class="row bookingrow">
                                    

                                      <div class="col-sm-12 couponwrapper">
                                                    <input type="text" class="coupon_code" placeholder="Coupon Code">
                                                        <button class="btn btn-info" id="applybtn">Apply</button>
                                                        <span class="couponmessage green">Your Coupon has applied</span>
                                      </div>
                                      </div>

                                        <table style="width:100%;" cellpadding="0" cellspacing="0">
                                            <tbody></tbody>
                                            <tfoot class="final-box">
                                                    <tr>
                                                    <td colspan="3">Discounted Price</strong>
                                                    </td>
                                                    <td colspan="2" class="text-right">- <i class="fa fa-inr"></i> 50</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-size: 17px; color:#ec4612; padding-top:0px">Total Payable</td>
                                                    <td class="total-font text-right total1" style="padding-top:0px" colspan="3" id="total1"><i class="fa fa-inr"></i> <?php echo $event_details->event_price; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
													
                                                        <a class="btn btn-default btn-block outline__btn orange-btn " id="paymentbooknow" href="<?php echo base_url('booking/event_booking_now'); ?>"><i class="fa fa-arrow-right"></i> Book Now</a>
                                                   
												   </td>
                                                    <td>
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
	
 </script>
</body>

</html>