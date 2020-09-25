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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	
	<?php $this->load->view('public/common/head');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
	<style>
	.hide{
		display: none;
	}
	.show{
		display: block;
	}
	#errOtp.error
	{
		bottom: -6px !important;
	}
	#haze {
    font-weight: bold;
    overflow: hidden;
    height: 34px;
}

#haze iframe
{
	    width: 100%;
    margin-top: -34px !important;
    height: 69px;
}
p.resend-otp{min-height: 30px;}
</style>
</head>

<body>

	<?php $this->load->view('public/common/header');?>


	<!-- // Banner starts Here // -->
	<div class="clearfix"></div>
	<div class="login-wrapper">
		<div class="container">

			<div class="row">
				

				<div class="col-sm-6 rightborder order-sm-12">

					<div class="login_form_des" id="loginwrapper">

						<!--<form method="post" class="box1">-->
							<form  class="box1" enctype="multipart/form-data" method="post" accept-charset="utf-8">
								<h1 class="headline text-center notop">Login</h1>
								<p class="text-center">Welcome Back, Please login to your account</p>
								<div class="alert alert-warning alert-dismissible fade hide" id="error_msg" role="alert">
								</div>
								
								<div class="form-group bmd-form-group">
									<label for="username" class="bmd-label-floating"> Email<span class="required">*</span></label>
									<input type="text" class="form-control" id="username" name="username">
									<i class="fa fa-user prefix"></i>
									<span id="errusername" class="error"> </span>	
								</div>
								<div class="form-group bmd-form-group">
									<label for="passwrd" class="bmd-label-floating"> Password<span class="required">*</span></label>
									<input type="password" class="form-control" id="password" name="password">
									<i class="fa fa-key prefix"></i>
									<span id="errpassword" class="error"> </span>	
								</div>
								<div class="form-row" style="margin-top: 20px">
									<div class="col-6 nopadleft" >
										<label class="">
											<input class="remember" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Remember me</span>
										</label>
									</div>
									<div class="col-6 nopadright forgotpass">
										<div class="lost_password text-right">
											<a href="#">Forgot password?</a>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-12 text-center" style="margin-top: 5px">
										<button type="submit" id="usr_loggin" class="btn btn-default btn-block outline__btn orange-btn" name="login" value="Login"><i class="fa fa-lock"></i><div class="ripple-container"></div>Login</button>
									</div>

									<div class="col-sm-12 text-center otherlogin">
										New User ? <a  id="usr_signup">Signup</a>
									</div>

									<div class="col-sm-12 text-center otherlogin" style="margin-top: 0px" >or login with <a href="<?php echo $fbLoginUrl;?>" target="_blank"><i class="fa fa-facebook"></i></a> <a href="<?php echo $gPlusLoginUrl;?>" target=""><i class="fa fa-google"></i></a></div>
								</div>
							</form>            
						</div>

						<!-- Signup section -->


						<div id="forgotpasswrapper">
							<form method="post" class="">
								<h5 class="headline text-center">Forgot password</h5>
								<p class="text-center">Lost your password? Please enter your  email address. You will receive a link to create a new password via email.</p>

								<div class="form-group bmd-form-group">
									<label for="passwrd" class="bmd-label-floating">Email<span class="required">*</span></label>
									<input type="text" class="form-control" id="forgotpasswrd">
									<i class="fa fa-envelope prefix"></i>
									<span id="errforgotpassword" class="error"> </span>	
								</div>

								<div class="clear"></div>


								<div class="col-12" style="margin-top: 5px">
									<button type="submit" id="forgot-password" class="btn btn-default btn-block outline__btn orange-btn gapbtn" name="resetpassword" value="Forgot Password">Reset Password</button>
								</div>


							</form>
						</div>

						<div id="signupwrapper">
							<div class="modal fade" id="myModalotp" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											
											
										</div>
										<div class="modal-body">

											<div id="OTP" class="clearfix" style="">

												<div class="left_item">
													<form action="" class="form-big center_item_form">
														<div class="row justify-content-center">

															<div class="like-img text-center">
																<img src="<?=base_url();?>assets/public/images/message.png" alt="">
															</div>
															<div class="col-md-12">
																<h1 class="display-4 text-center text-verfiy">Thanks for signing up!</h1>

																<p class="info-text-label text-center">Please Enter the OTP sent to your mobile number / email id.</p>

																<p class="text-center sub_title_verify">A verification link has been sent to your email account.</p>
																
															</div>
															<div class="col-md-8 col-md-offset-2">

																<div class="form-group bmd-form-group">										
																	<label for="enterOTP" class="bmd-label-floating">Enter OTP</label>
																	<input type="text" class="form-control" name="enterOTP" id="enterOTP" onkeypress="validate(event)">
																	<i class="fas fa-mobile-alt prefix"></i>
																	<span id="errOtp" class="error"></span>
																	<p class="text-right  otp-expire">OTP will expire in <span class="red"><span id="timer"></span></span></p>

																	
																</div>
										<!-- <div class="form-group">
											<input type="text" class="form-control" placeholder="Enter OTP" maxlength="6">
											<i class="fas fa-mobile-alt"></i>	
											
										</div> -->
									</div>
									<div class="col-md-12">
										<div class="form-group text-center">
											<a href="javascript:void(0)" class="btn btn-raised orange-btn hvr-sweep-to-top" id="otpVerified" style="margin-top: 10px;"><i class="fas fa-mobile-alt"></i> Verify OTP</a>
											<p class="text-center resend-otp"><a href="javascript:void(0)" id="resend-otp"><input type="hidden" value="" id="last_user_insert_id">Resend OTP</a></p>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="right_item d-none d-sm-none d-md-block d-lg-block d-xl-block">
							
						</div>
						
					</div>

					<div id="congratulations" class="clearfix" style="">
						<div class="left_item">
							<div class="row justify-content-center">

								<div class="col-md-12">
									<div class="text-center">
										<div class="like-img">
											<img src="<?=base_url();?>assets/public/images/smartphone.png" alt="">
										</div>
										<h1 class="display-4 text-center text-verfiy">Congratulations!</h1>
										<p class="text-center sub_title_verify">Your mobile has been verified successfully.</p>
										<p class="text-center sub_title_verify facilitycheckedshow">Click continue to complete your Business profile.</p>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group text-center">
										<a href="<?=base_url('login/user_after_otp');?>" class="btn btn-raised  hvr-sweep-to-top usercontinue" style="color:#fff"> Continue</a>
										<a href="<?=base_url('login/facilityprofiling');?>" class="btn btn-raised hvr-sweep-to-top facility-continue" style="color:#fff"> Continue</a>
									</div>
								</div>
							</div>
						</div>
						<div class="right_item d-none d-sm-none d-md-block d-lg-block d-xl-block">
							
						</div>
						
					</div>





				</div>
			</div>

		</div>
	</div>


	<form method="post" enctype="multipart/form-data">
		<div class="text-center usertype">
			<span class="backbtn">
			<i class="fa fa-angle-left"></i>
		    </span>
           <span class="full-width1 startedorange">GET STARTED</span>
            <span class="full-width1">
			<label class="radio-inline btn btn-default orange-btn  nobg" id="userradio">
			
				<input type="radio" name="user_type" value="1" checked="checked">
			<img class="iconimg1" style="max-width: 20px" src="<?=base_url();?>assets/public/images/usericon1.png"> Sign Up as User <i class="fa fa-question-circle question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="People who are interested in sports. They can search, book a slot and play the sport of their choice."></i></label></span>	

			<span class="full-width1">
			<label class="radio-inline  btn btn-default orange-btn nobg" id="facilityradio">
				<input type="radio" name="user_type" value="2" >
			<img class="iconimg1" src="<?=base_url();?>assets/public/images/facilityicon1.png"> Sign Up as Facility/Academy <i class="fa fa-question-circle question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facility/ Academy provides a venue to the people where they can play, learn and practice sports of their choice."></i></label>
		    </span>
		</div>
		<div class="row initialhide radiowrappernew">

			<div class="col-md-6">
				<div class="form-group">
					<label for="username1" class="bmd-label-floating">User Name<span class="required">*</span></label>
					<input type="text" class="form-control" id="username1" value="<?php if(isset($first_name)) echo $first_name;?> <?php if(isset($last_name)) echo $last_name;?>">

					<input type="hidden" class="" id="oauth_provider" value="<?php if(isset($oauth_provider)) echo $oauth_provider; else echo "1";?>">
					<input type="hidden" class="" id="oauth_uid" value="<?php if(isset($oauth_uid)) echo $oauth_uid;?>">
					<i class="fa fa-user prefix"></i>
					<span id="errName1" class="error"> </span>	
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="gender" class="bmd-label-floating">Gender<span class="required">*</span></label>
					<select class="form-control" id="gender">
						<option value="">Select Gender</option>
						<option class="abc" value="M" >Male</option>
						<option class="abc" value="F" >Female</option>
						<option class="abc" value="T" >Other</option>

					</select>
					<i class="fa fa-venus-mars prefix"></i>
					<span id="errGender" class="error"></span>	
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="useremail" class="bmd-label-floating">Email<span class="required">*</span></label>
					<input type="text" class="form-control" id="useremail" value="<?php if(isset($email)) echo $email;?>" <?php if(isset($email)) echo "readonly";?>>
					<i class="fa fa-envelope prefix"></i>
					<span id="errEmail" class="error"> </span>
				</div>
			</div>
			
			

			<div class="col-md-6">
				<div class="form-group">
					<label for="userphone" style="z-index:99; top:19px" class="bmd-label-floating is-focused">Phone Number<span class="required">*</span></label>
	<select class="form-control countrycode" value="">
                    
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
	<!-- 	<option data-countryCode="NL" value="31">Netherlands (+31)</option>
		<option data-countryCode="NC" value="687">New Caledonia (+687)</option>
		<option data-countryCode="NZ" value="64">New Zealand (+64)</option>
		<option data-countryCode="NI" value="505">Nicaragua (+505)</option>
		<option data-countryCode="NE" value="227">Niger (+227)</option>
		<option data-countryCode="NG" value="234">Nigeria (+234)</option>
		<option data-countryCode="NU" value="683">Niue (+683)</option>
		<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
		<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
		<option data-countryCode="NO" value="47">Norway (+47)</option>
		<option data-countryCode="OM" value="968">Oman (+968)</option>
		<option data-countryCode="PW" value="680">Palau (+680)</option>
		<option data-countryCode="PA" value="507">Panama (+507)</option>
		<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
		<option data-countryCode="PY" value="595">Paraguay (+595)</option>
		<option data-countryCode="PE" value="51">Peru (+51)</option>
		<option data-countryCode="PH" value="63">Philippines (+63)</option>
		<option data-countryCode="PL" value="48">Poland (+48)</option>
		<option data-countryCode="PT" value="351">Portugal (+351)</option>
		<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
		<option data-countryCode="QA" value="974">Qatar (+974)</option>
		<option data-countryCode="RE" value="262">Reunion (+262)</option>
		<option data-countryCode="RO" value="40">Romania (+40)</option>
		<option data-countryCode="RU" value="7">Russia (+7)</option>
		<option data-countryCode="RW" value="250">Rwanda (+250)</option>
		<option data-countryCode="SM" value="378">San Marino (+378)</option>
		<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
		<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
		<option data-countryCode="SN" value="221">Senegal (+221)</option>
		<option data-countryCode="CS" value="381">Serbia (+381)</option>
		<option data-countryCode="SC" value="248">Seychelles (+248)</option>
		<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
		<option data-countryCode="SG" value="65">Singapore (+65)</option>
		<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
		<option data-countryCode="SI" value="386">Slovenia (+386)</option>
		<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
		<option data-countryCode="SO" value="252">Somalia (+252)</option>
		<option data-countryCode="ZA" value="27">South Africa (+27)</option>
		<option data-countryCode="ES" value="34">Spain (+34)</option>
		<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
		<option data-countryCode="SH" value="290">St. Helena (+290)</option>
		<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
		<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
		<option data-countryCode="SD" value="249">Sudan (+249)</option>
		<option data-countryCode="SR" value="597">Suriname (+597)</option>
		<option data-countryCode="SZ" value="268">Swaziland (+268)</option>
		<option data-countryCode="SE" value="46">Sweden (+46)</option>
		<option data-countryCode="CH" value="41">Switzerland (+41)</option>
		<option data-countryCode="SI" value="963">Syria (+963)</option>
		<option data-countryCode="TW" value="886">Taiwan (+886)</option>
		<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
		<option data-countryCode="TH" value="66">Thailand (+66)</option>
		<option data-countryCode="TG" value="228">Togo (+228)</option>
		<option data-countryCode="TO" value="676">Tonga (+676)</option>
		<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
		<option data-countryCode="TN" value="216">Tunisia (+216)</option>
		<option data-countryCode="TR" value="90">Turkey (+90)</option>
		<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
		<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
		<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
		<option data-countryCode="TV" value="688">Tuvalu (+688)</option>
		<option data-countryCode="UG" value="256">Uganda (+256)</option>
		<!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
		<!-- <option data-countryCode="UA" value="380">Ukraine (+380)</option>
		<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
		<option data-countryCode="UY" value="598">Uruguay (+598)</option>
		<!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
		<!-- <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
		<option data-countryCode="VU" value="678">Vanuatu (+678)</option>
		<option data-countryCode="VA" value="379">Vatican City (+379)</option>
		<option data-countryCode="VE" value="58">Venezuela (+58)</option>
		<option data-countryCode="VN" value="84">Vietnam (+84)</option>
		<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
		<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
		<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
		<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
		<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
		<option data-countryCode="ZM" value="260">Zambia (+260)</option>
		<option data-countryCode="ZW" value="263">Zimbabwe (+263)</option> --> 
	
</select>
					<input type="text" class="form-control" id="userphone" onkeypress="validate(event)">
					<i class="fa fa-phone prefix"></i>
					<span id="errPhone" class="error"> </span>
				</div>
			</div>

           <div class="col-md-6">
				<div class="form-group bmd-form-group">
					<label for="country" class="bmd-label-floating">Country</label>
					<select class="form-control" id="country">
						<option value="India">India</option>
					</select>
						<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/earth_red.png');?>">
									<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/earth_blue.png');?>">


				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group bmd-form-group" id="user_loc">
					<label for="usercity" class="bmd-label-floating">Location<span class="required">*</span></label>
					<input type="text" class="google_address form-control" id="usercity">
					<input type="hidden" class="form-control" id="latitude">
					<input type="hidden" class="form-control" id="longitude">
					<i class="fa fa-map-marker prefix"></i>
					<span id="errCity" class="error"> </span>
				</div>
			</div>

			

			<div class="col-md-6">
				<div class="form-group bmd-form-group">
					<label for="password1" class="bmd-label-floating">Password<span class="required">*</span></label>
					<input type="password" class="form-control" id="password1">
					<i class="fa fa-eye eyeopenpassword eyepassword"></i>
					<i class="fa fa-eye-slash eyeslashpassword eyepassword"></i>

					<i class="fa fa-key prefix"></i>
					<span id="errPassword1" class="error"> </span>
				</div>
			</div>


			<div class="col-md-6">
				<div class="form-group  mar-btm">
					<div class="row">
						<div class="col-sm-5 captcha2 nopadright nopadleft captcha2" id="haze"></div>
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 captcha nopadright">

							<input class="form-control" type="hidden" name="captcha22" id="captcha22" value="<?php echo substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);?>">
							<input class="form-control captcharefresh" type="text" name="captcha" id="captcha">
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 captcha capb ">
							<img class="ref" src="<?=base_url();?>assets/public/images/refresh.jpg" id="on" title="Refresh">
						</div>
						<span id="errCaptcha" class="error"> </span>
					</div>
				</div>
			</div>

			<div class="col-12" >
				<div class="checkbox form-group bmd-form-group" style="padding-top: 15px;">
		
						By registering, I agree to the <a href="https://www.socialsportz.com/terms.html" target="_blank" style="color:#c00000;">Terms &amp; Conditions.</a>
			
				</div>


				<button type="button" id="register_submit" class="btn btn-default btn-block outline__btn orange-btn gapbtn" name="signup" value="Sign Up"><i class="fa fa-arrow-right"></i> Proceed<div class="ripple-container"></div></button>
			</div>



		</form>
	</div></div>




</div>
<div class="loader">
									<div class="">
										<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
									</div>
								</div>

<div class="col-sm-6  order-sm-1 align-items-center d-flex"><img class="loginside" src="<?=base_url('assets/public/images/loginsideimg.png');?>"></div>
</div></div></div>

<!-- Footer Include Here -->
<?php $this->load->view('public/common/footer');?>
<?php if(isset($_COOKIE['username']) and isset($_COOKIE['password'])){
	$username=$_COOKIE['username'];
	$password = $_COOKIE['password'];
	echo '<script>
	document.getElementById("username").value="'.$username.'";
	document.getElementById("password").value="'.$password.'";

	</script>';
} ?>

<p style="display: none" id = "status"></p>
<a id = "map-link" target="_blank"></a>
</div>

<?php $this->load->view('public/common/foot');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="<?=base_url('assets/public/js/dropify.min.js');?>"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
<script>
	$(window).on('load',function() {
								$(".loader").fadeOut('slow');
							});

							function showingLoader(){
								$(".loader").fadeIn(200);
//$(".loader").fadeOut(1000);
}
function hiddingLoader(){
//$(".loader").fadeIn(200);
$(".loader").fadeOut(1000);
}
	setTimeout(function(){
		var wh = jQuery(window).height(); jQuery("#slider-banner.owl-carousel .owl-item img").height(wh);
	},200);




	function isNumberValid(number){
		var checkNumber = /^\d{10}$/;
		return checkNumber.test(number);						
	}
	function isNameValid(name){
		return /[A-Z]+/i.test(name) && /[a-z]+/.test(name) && /\S{7,15}/.test(name);			
	}
	function isEmailValid(email){
		return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
	}

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

$("input#username").focus();
$("input#username").parent().addClass("is-focused");

//User login Script


$('#usr_loggin').click(function(e) {
	e.preventDefault();
	var username = $('#username').val();
	var password = $('#password').val();
	var validPass= $.trim($('#password').val()).length;
	//var remember1 = $('input[name="remember"]:checked');
	var chkArray = [];
	$(".remember:checked").each(function() {
		chkArray.push($(this).val());
	});
	var rem = chkArray.join(',') ;
//alert(rem);
if(username == ''){
	$('#errusername').show();
	$('#errusername').html('Please Enter Email');
	return false;
}
else if (!isEmailValid(username)) {
	$('#errusername').show();
	$('#errusername').html('Please Enter Valid Email');
	return false;
}
else{
	$('#errusername').html('');
}
if(password == ''){
	$('#errpassword').show();
	$('#errpassword').html('Please Enter Password');
	return false;
}
else{
	$('#errpassword').html('');
}
/*if(validPass < 6 || validPass > 16){
	$('#errpassword').show();
	$('#errpassword').html('Please Enter Password between 6 and 16 characters');
	return false;
}
else{
	$('#errpassword').html('');
}*/

var page_visit = '<?php if(!empty($this->session->userdata('page_visit'))){ echo $this->session->userdata('page_visit'); }else{ echo ''; }?>';
$.ajax({
	type: "POST",
			//async: true,
			url:'<?php echo base_url();?>login/user_login',	
			data: {username:username,password:password,remember:rem},
			success:function(res){
				//alert(res);
				if(res==1){
					if(page_visit =='checkout'){
						window.location.href = '<?php echo base_url('booking') ?>';
					}else if(page_visit =='event_checkout'){
						window.location.href = '<?php echo base_url('booking/event_checkout') ?>';
					}
					else if(page_visit =='search_detail'){
						history.back();
					}
					else{
						window.location.href = '<?php echo base_url('dashboard') ?>';
					}
				}
				else if(res==2){
					$('.alert-warning').removeClass('hide');
					$('.alert-warning').addClass('show');
					$('#error_msg').show(); 
					$('#error_msg').text("You are account has been suspended. Please contact to admin"); 
				}
				else if(res==0){
					$('.alert-warning').removeClass('hide');
					$('.alert-warning').addClass('show');
					$('#error_msg').show(); 
					$('#error_msg').text("You are entering Wrong User Id or Password"); 
				}				    

			}	
		});

});

jQuery("#usr_signup").on("click", function(){
	jQuery("#signupwrapper").show();
	jQuery("#loginwrapper").hide();
	jQuery("#forgotpasswrapper").hide();
	geoFindMe();
	
});

jQuery(".lost_password ").on("click", function(){
	jQuery("#signupwrapper").hide();
	jQuery("#loginwrapper").hide();
	jQuery("#forgotpasswrapper").show();
});
</script>
<?php if( isset($_GET['code']) && $_GET['code']!=''){ ?>
<script>
	$(document).ready(function() {
$('#usr_signup').trigger('click');
	 });
</script>
<?php } ?>

<script>
	$(document).ready(function() {


		$("#forgot-password"). on("click", function(e){
			e.preventDefault();
			var register_email = $('#forgotpasswrd').val();

			if(register_email == ''){
				$('#errforgotpassword').show();
				$('#errforgotpassword').html('Please enter email');
				/*$('html,body').animate({scrollTop: $("#errforgotpassword").offset().top - 190},'slow');*/
				return false;
			}
			else if (!isEmailValid(register_email)) {
				$('#errforgotpassword').show();
				$('#errforgotpassword').html('Please enter valid email');
				/*$('html,body').animate({scrollTop: $("#errforgotpassword").offset().top - 190},'slow');*/
				return false;
			}
			else{
				$('#errforgotpassword').html('');
			}

			$.ajax({
				type: "POST",
				url:'<?php echo base_url();?>login/forgotpassword',	
				data: {register_email:register_email},
				success:function(res){
							//alert(res);
							if(res!=2 && res!=3 && res!=4){				    
								swal({
								title : 'Reset password link has been sent on your email. Please check your inbox!!',
								html : '',
								type: 'success'
							}).then((result) => {
								if (result.value) {
									$('#forgotpasswrd').val('');
									window.location.href = '<?php echo base_url() ?>';

								}
							})

							}
							else if(res==2) {
								$('#errforgotpassword').text("Account is disabled. Please contact to admin"); 
							}
							else if(res==3) {
								$('#errforgotpassword').text("this Email is not Found"); 
							}

							else if(res==4) {
								$('#errforgotpassword').text("Mobile no. is not varified"); 
							}

						}	

					});	


		});

			//User Registration

			$('#register_submit').click(function(e){

				var user_type = $("input[name='user_type']:checked").val();
				var name = $('#username1').val();
				jQuery("#gender").on("change", function(){jQuery("#errGender").remove()});
				var gender = $("#gender option.abc:selected").length;
				var gender_val=$( "#gender option:selected" ).val();
				var register_email = $('#useremail').val();
				var phone = $('#userphone').val();
				var countrycode = $( ".countrycode option:selected" ).text();
				var validPhone= $.trim($('#userphone').val()).length;
				var address = $('#usercity').val();
				var country=$( "#country option:selected" ).val();
				var term = $('input[name="termcondition"]:checked').length;
				var register_password = $('#password1').val();
				var validPass= $.trim($('#password1').val()).length;
				var validcPass= $.trim($('#cpassword').val()).length;
				var captcha = $('#captcha').val();
				var captcha22 = $('#captcha22').val();
				var latitude = $('#latitude').val();
				var longitude = $('#longitude').val();
				var login_type = $('#oauth_provider').val();
				var oauth_uid = $('#oauth_uid').val();
				//alert(countrycode); return false;

				//var login_type= '1';

				if(name == ''){
					$('#errName1').show();
					$('#errName1').html('Please enter  name');
					$('html,body').animate({scrollTop: $("#errName1").offset().top - 190},'slow');
					return false;
				}else{
					$('#errName1').html(''); 
				}

				if(gender == 0)
				{
					$('#errGender').html('Please Select Gender');
					return false;
				}

				else if(gender == 1)
				{
					$('#errGender').html('');	
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



				if(phone == ''){
					$('#errPhone').show();
					$('#errPhone').html('Please enter mobile no.');
					$('html,body').animate({scrollTop: $("#errPhone").offset().top - 190},'slow');
					return false;
				}else{
					$('#errPhone').html(''); 
				}
				if( validPhone < 8 || validPhone > 15){
					$('#errPhone').show();
					$('#errPhone').html('Please enter mobile no. between 8 and 15 characters');
					$('html,body').animate({scrollTop: $("#errPhone").offset().top - 190},'slow');
					return false;
				}else{
					$('#errPhone').html(''); 
				}


				if(address == ''){
					$('#errCity').show();
					$('#errCity').html('Please enter  location');
					$('html,body').animate({scrollTop: $("#errCity").offset().top - 190},'slow');
					return false;
				}else{
					$('#errCity').html(''); 
				}



				if(register_password == ''){
					$('#errPassword1').show();
					$('#errPassword1').html('Please enter password');
					$('html,body').animate({scrollTop: $("#errPassword1").offset().top - 190},'slow');
					return false;
				}
				else{
					$('#errPassword1').html('');
				}
				if(validPass < 6 || validPass > 16){
					$('#errPassword1').show();
					$('#errPassword1').html('Please enter password between 6 and 16 characters');
					$('html,body').animate({scrollTop: $("#errPassword1").offset().top - 190},'slow');
					return false;
				}
				else{
					$('#errPassword1').html('');
				}

				if(captcha == ''){
					$('#errCaptcha').show();
					$('#errCaptcha').html('Please enter Captcha');
					$('html,body').animate({scrollTop: $("#errCaptcha").offset().top - 190},'slow');
					return false;
				}
				else{
					$('#errCaptcha').html('');
				}

				if(captcha!= '' && captcha!=captcha22 ){
					$('#errCaptcha').show();
					$('#errCaptcha').html('Please enter valid Captcha');
					$('html,body').animate({scrollTop: $("#errCaptcha").offset().top - 190},'slow');
					return false;
				}
				else{
					$('#errCaptcha').html('');
					showingLoader();
				}

				$.ajax({
					type: "POST",
					url:'<?php echo base_url();?>login/user_registration',	
					data: {name:name,gender:gender_val,email:register_email,phone:phone,address:address,country:country,password:register_password,user_type:user_type,login_type:login_type,countrycode:countrycode,oauth_uid:oauth_uid,latitude:latitude,longitude:longitude},
					success:function(res){
							//alert(res);

							if(res!='failed'){
							hiddingLoader();					    
								$('#myModalotp').modal({backdrop: 'static', keyboard: false})
								jQuery("#enterOTP").focus();
								$('#last_user_insert_id').val(res);
									/* Hide resend otp option for 2 minute*/
										//$('#resend-otp').hide();
										$('#resend-otp').hide();
										setTimeout(function(){
									//$('#resend-otp').show();
									$('#resend-otp').show();
										},120000);
										/* Mobile OTP Timer*/

									let timerOn = true;

									function timer(remaining) {
										//$('#resend-otp').hide();
									  var m = Math.floor(remaining / 60);
									  var s = remaining % 60;
									  
									  m = m < 10 ? '0' + m : m;
									  s = s < 10 ? '0' + s : s;
									  document.getElementById('timer').innerHTML = m + ':' + s;
									  remaining -= 1;
									  
									  if(remaining >= 0 && timerOn) {
									    setTimeout(function() {
									        timer(remaining);
									    }, 1000);
									    return;
									  }

									  if(!timerOn) {
									    // Do validate stuff here
									    return;
									  }
									  
									  // Do timeout stuff here
									  //alert('Timeout for otp');
									}

									timer(120);
							}
							else {}				    						
						}	

				});	


			});

//Resend otp

$('#resend-otp').click(function() {
	$('#resend-otp').hide();
	var user_id  = $(this).find('#last_user_insert_id').val();
	//alert(user_id);

	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>login/regenrate_otp',	
			data: {user_id:user_id},
			success:function(res){
				//alert(res);
				if(res==1){

				/* Mobile OTP Timer*/


										setTimeout(function(){
									$('#resend-otp').show();
										},120000);
									let timerOn = true;

									function timer(remaining) {

									  var m = Math.floor(remaining / 60);
									  var s = remaining % 60;
									  
									  m = m < 10 ? '0' + m : m;
									  s = s < 10 ? '0' + s : s;
									  document.getElementById('timer').innerHTML = m + ':' + s;
									  remaining -= 1;
									  
									  if(remaining >= 0 && timerOn) {
									    setTimeout(function() {
									        timer(remaining);
									    }, 1000);
									    return;
									  }

									  if(!timerOn) {
									    // Do validate stuff here
									    return;
									  }
									  
									  // Do timeout stuff here
									  //alert('Timeout for otp');
									}

									timer(120);
				}
				else{}				    

			}	
		});

});


//Ceck otp

$('#otpVerified').click(function(e) {
	var mob_otp = $('#enterOTP').val();
	var valid_mob_otp = $.trim($('#enterOTP').val()).length;
	if(mob_otp == ''){
		$('#errOtp').show();
		$('#errOtp').html('Please enter OTP.');
		return false;
	}else{
		$('#errOtp').html(''); 
	}
	if( valid_mob_otp!=6){
		$('#errOtp').show();
		$('#errOtp').html('Please enter correct OTP');
		return false;
	}else{
		$('#errOtp').html(''); 
	}
	$.ajax({
		type: "POST",
		url:'<?php echo base_url();?>login/user_registration',	
		data: {mob_otp:mob_otp},
		success:function(res){
							//alert(res);

							if(res==1){				    
								$("#congratulations").show();
								$("#OTP").hide();
							}
							else {
								$('#errOtp').html('OTP not matched');
							}				    						
						}	

					});

});
// Check uniqe email and mobile no -

$('#useremail').keyup(function(){
	var useremail = $('#useremail').val();
	if (useremail != '') {
		$.ajax({
			type:'post',
			url:'<?=base_url('login/check_email_mobile');?>',
			data:{useremail:useremail},
			success: function(data){
				if (data == 1) {
					$('#errEmail').html("Email Alredy Exist");
					$(':input[type="button"]').prop('disabled', true);
				}
				else{
					$('#errEmail').html("");
					$(':input[type="button"]').prop('disabled', false);

				}
			}
		})
	}

});

$('#userphone').keyup(function(){
	var userphone = $('#userphone').val();
	var countrycode = $( ".countrycode option:selected" ).text();
	if (userphone != '') {
		$.ajax({
			type:'post',
			url:'<?=base_url('login/check_email_mobile');?>',
			data:{userphone:userphone,countrycode:countrycode},
			success: function(data){
				if (data == 1) {
					$('#errPhone').html("Mobile Alredy Exist");
					$(':input[type="button"]').prop('disabled', true);
				}
				else{
					$('#errPhone').html("");
					$(':input[type="button"]').prop('disabled', false);

				}
			}
		})
	}

});






});


$('.usertype input[type=radio]').on("click", function() {
	if (this.value == '2') {
		jQuery(".row.initialhide").removeClass('initialhide');
		$(".usertype").addClass("btnselected");
		$(".startedorange").hide();
		$(".backbtn").show();
		$("#userradio").hide();
		jQuery(".login-wrapper").addClass("facility-section");
			jQuery("#username1").siblings('label').html("Contact Person Name<span class='required'>*</span>");
			jQuery("#useremail").siblings('label').html("Contact Person Email<span class='required'>*</span>");
			jQuery("#userphone").siblings('label').html("Contact Person Phone Number<span class='required'>*</span>");
	}
	else if (this.value == '1') {
		jQuery(".row.initialhide").removeClass('initialhide');
		$(".startedorange").hide();
		$("#facilityradio").hide();
		$(".backbtn").show();
		$(".usertype").addClass("btnselected");
		jQuery(".login-wrapper").removeClass("facility-section");
		jQuery("#username1").siblings('label').html("User Name<span class='required'>*</span>");
			jQuery("#useremail").siblings('label').html(" Email<span class='required'>*</span>");
			jQuery("#userphone").siblings('label').html("Phone Number<span class='required'>*</span>");
	}
});

$(".backbtn").on("click", function() {
jQuery(".row.radiowrappernew").addClass('initialhide');
$("#facilityradio").show();
$("label.radio-inline").removeClass("selected");
$(".usertype").removeClass("btnselected");
$("#userradio").show();
$(".startedorange").show();
$(this).hide();
});

jQuery(".eyeslashpassword").on("click", function(){jQuery("#password1").attr("type","text"); jQuery('.eyepassword').show(); jQuery(this).hide();});

jQuery(".eyeopenpassword").on("click", function(){jQuery("#password1").attr("type","password"); jQuery('.eyepassword').show(); jQuery(this).hide();});


/*jQuery("#otpVerified").on("click", function(){jQuery("#congratulations").show(); jQuery("#OTP").hide();});*/
</script>

<script type="text/javascript"> 
/*jQuery.ajax({
  url: "https://geoip-db.com/jsonp",
  jsonpCallback: "callback",
  dataType: "jsonp",
  success: function(location) {

    jQuery('#usercity').val(location.city);
    jQuery('#latitude').val(location.latitude);
    jQuery('#longitude').val(location.longitude);
   
  }
});*/

jQuery("#facilityradio").on("click", function(){
	jQuery(".login-wrapper").addClass("facility-section");

});

jQuery("#userradio").on("click", function(){
	jQuery(".login-wrapper").removeClass("facility-section");

});

jQuery(".usertype .radio-inline").on("click" ,function(){jQuery(".usertype input[type='radio'] ").attr("checked", false);jQuery(this).find("input[type='radio']").attr("checked", "checked"); jQuery(".usertype .radio-inline").removeClass("selected"); jQuery(this).addClass("selected")});


</script> 


<!-- Captcha script -->
<!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript">
	$(function(){
		var dim = $('#captcha22').val();
		$.ajax({
			url:'<?=base_url();?>captcha_code_file_reg.php?rand='+dim,
			success:function(aaa){
	   //var arr = aaa.split('+');
	   $('#haze').html('<iframe src="<?=base_url();?>captcha_code_file_reg.php?rand='+dim+'" border="0" scrolling="no" allowtransparency="yes"  style="width:100%;margin-top: -32px;" frameBorder="0"></iframe>');   
	}	 
});
		$('#on').click(function(){
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for (var i = 0; i < 5; i++)
				text += possible.charAt(Math.floor(Math.random() * possible.length));


			$('#captcha22').removeAttr('value');
			$('#captcha22').attr('value',''+text+'');
			var dim = $('#captcha22').val();
			$.ajax({
				url:'<?=base_url();?>captcha_code_file_reg.php?rand='+dim,
				success:function(aaa){
	   //var arr = aaa.split('+');
	   $('#haze').html('<iframe src="<?=base_url();?>captcha_code_file_reg.php?rand='+dim+'" border="0" scrolling="no"  style="width:100%;margin-top: -40px;" frameBorder="0"></iframe>');   
	}	 
}); 
		});
	});



</script>


<!-- Google location -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

<script>
	
	function initMap() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		autocomplete1 = new google.maps.places.Autocomplete(
			/** @type {!HTMLInputElement} */(document.getElementById('usercity')),
			{types: ['geocode']});

		autocomplete1.addListener('place_changed', function() {
			//infowindow.close();
			var place = autocomplete1.getPlace();
			$('#latitude').val(place.geometry.location.lat());
			$('#longitude').val(place.geometry.location.lng());
		});
		
	}

	var addressInputElement = $('#usercity');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
})

setInterval(function(){
jQuery("#usercity").removeAttr("placeholder");
},100);
Cookies.remove("yourCookieName");
Cookies.remove("yourCookieselectvalue");
jQuery("#usercity").removeAttr("placeholder");



</script>



</body>




</html>	