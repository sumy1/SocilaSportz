<?php define("SITEURL",'https://vibestest.com/wip_projects/development/socialsportz-dev/'); 
define("IMGPATH",'https://vibestest.com/wip_projects/development/socialsportz-dev/assets/public/images/mailer/'); 

?>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
	hr.seprprice {
		margin-top: 5px;
		margin-bottom: 5px;
		border: 0;
		border-top: 1px dashed rgb(12, 12, 12);
	}
	
h1,h2,h3,h4,h5,h6 {
	font-family: 'Roboto', sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }
h1 { font-weight:bold; font-size: 20px; margin-top: 10px; line-height: 30px;
	border-radius: 5px; font-weight: 300;

}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 17px; text-transform: uppercase; color:#444;}
* { 
	margin:0;
	padding:0;
}
* { 
	font-family: 'Roboto', sans-serif;
}
img { 
	max-width: 100%; 
}
table.detail
{
	margin-bottom: 20px;
	width: 100%;
}

table.detail td {
	border: 1px solid #ccc;
	padding: 10px;
	font-size: 12px;
}
body
{
	font-size: 12px;
}
</style>

<?php
ini_set("display_errors",1);  
require 'email.class.php' ;
function sendMailUser($toname,$user_email,$subject_user,$body_user)
{
	$email = new Emailclass();
	$email->mailaccount='vibescom';     
	$email->to=$user_email;     
	$email->toname=$toname;
	$email->bcc='';
	$email->from="info@vibescom.in";
	$email->fromname="SocialSportz";  
	$email->subject=$subject_user;
	$email->body=$body_user;
	$email_response = $email->sendemail(); 
	return $email_response;
}

function sendMailAdmin($toname,$admin_email,$subject_admin,$body_admin)
{
	$email = new Emailclass();
	$email->mailaccount='vibescom';     
	$email->to=$admin_email;     
	$email->toname="SocialSportz";
	$email->bcc='';
	$email->from="info@vibescom.in";
	$email->fromname="SocialSportz";  
	$email->subject=$subject_admin;
	$email->body=$body_admin;
	$email_response = $email->sendemail(); 
	return $email_response;
}

if(isset($_POST['action']) && $_POST['action']=='email_verification')
{

	$user_email=$_POST['email'];
	$user_name=$_POST['user_name'];
	$user_id=$_POST['user_id'];
	$verification_code=$_POST['verification_code'];
	$date=date('d-m-Y');
	$body_user='Hi '.$user_name.' <br><br>Thanks for creating a new account on Social Sportz, and welcome.<br>The final step to create your account is to verify your email address. You can do this by clicking the link below:<br><br><a href="'.SITEURL.'login/emailverification/'.$user_id.'/'.$verification_code.'">'.SITEURL.'login/emailverification/'.$user_id.'/'.$verification_code.'</a><br><br>(If that does not work, please try copying and pasting the link into your browser address bar.)Once that is done, you are all set.<br><br><br>Thanks, <br>Team Socialsportz';
	$subject_user="SocialSportz : Email Verification";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}
//print_r($body_user); die();
}
/*Mobile varification code*/
if(isset($_POST['action']) && $_POST['action']=='mobile_verification')
{

	$user_email=$_POST['email'];
	$user_name=$_POST['user_name'];
	$verification_code=$_POST['verification_code'];
	$date=date('d-m-Y');
	$body_user='Hi '.$user_name.' <br><br>Thanks for creating a new account on Social Sportz, and welcome.<br>The final step to create your account is to verify your mobile number. You can do this by entering the code:'.$verification_code.'<br><br><br>Thanks, <br>Team Socialsportz';
	$subject_user="SocialSportz : Mobile Verification";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}
//print_r($body_user); die();
}

/*Forgot password link genration email*/
if(isset($_POST['action']) && $_POST['action']=='forgot_password')
{

	$user_email=$_POST['email'];
	$user_name=$_POST['user_name'];
	$user_id=$_POST['user_id'];
	$forgot_password_code=$_POST['forgot_password_code'];
	$date=date('d-m-Y');
	$body_user='Hi '.$user_name.' <br><br>You can create new password by clicking the link below:<br><br><a href="'.SITEURL.'new-password/'.$user_id.'/'.$forgot_password_code.'">'.SITEURL.'new-password/'.$user_id.'/'.$forgot_password_code.'</a><br><br>(If that does not work, please try copying and pasting the link into your browser address bar.)Once that is done, you are all set.<br><br><br>Thanks, <br>Team Socialsportz';
	$subject_user="SocialSportz : Forgot password";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}
//print_r($body_user); die();
}


if(isset($_POST['action']) && $_POST['action']=='offline_registration')
{

	$user_email=$_POST['email'];
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	$date=date('d-m-Y');
	$body_user='Hi '.$user_name.' <br><br>We have created a new account on Social Sportz,<br>User Email:'.$user_email.' <br><br>Password:'.$password.'.<br><br>Thanks, <br>Team Socialsportz';
	$subject_user="SocialSportz : New User Creation";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}
//print_r($body_user); die();
}


## send mail for offline booking here
if(isset($_POST['action']) && $_POST['action']=='offline_booking')
{

	$order_no=$_POST['order_no'];
	$user_email=$_POST['register_email'];
	$user_name=$_POST['username'];
	$mobile=$_POST['mobile'];
	$city=$_POST['city'];
	$address=$_POST['address'];
	$total_amount=$_POST['total_amount'];
	$final_amount=$_POST['final_amount'];
	$fac_name=$_POST['fac_name'];
	$sport_name=$_POST['sport_name'];
	$booking_type=$_POST['booking_type'];
	$booking_detail_arr =  unserialize($_POST['booking_detail_arr']);
	
	$date=date('d-m-Y');
	$loop='';
	foreach($booking_detail_arr as $val){ 
		$booking_date=date('d-m-Y',strtotime($val['booking_date']));
		$loop = $loop.'<tr>
					     <td>'.$booking_date.'</td>
					     <td>'.$sport_name.'</td>
						<td>'.$val['slot_time'].'</td>
						<td>'.$val['price'].'</td>
						
				</tr>';
	} 
	$body_user='<body bgcolor="#FFFFFF" style="-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 620px; margin: 0 auto; height: 100%;">
	<table class="head-wrap"  style="width: 100%;background: #ffffff; border: 2px solid #ccc;">
		<tr style="background: #f5f2f2;">
			<td colspan="3" style="padding: 10px 10px;">
				<table width="100%">
					<tr>
						<td>
							<h2>Hi Bipin,</h2>
							<p style="font-size: 13px;">Your order has been successfully placed.</p><br><br>	
						</td>
						<td align="right">
							<img width="200" src="'.SITEURL.'assets/public/images/logo.png">	
						</td>
					</tr>
				</table>


				<table style="width: 100%;border: 2px dashed #c3c3c3;padding: 8px;margin-bottom: 1rem;">
					<tr>
						<td style="font-size: 14px;">
							<p style="font-weight: bold;">User Details<p>
								<p>Name:- '.$user_name.'<br>
									Mobile:- '.$mobile.'<br>
									Email:- '.$user_email.'<br></p>

							</td>    
							<td style="font-size: 12px;text-align: right;display: initial;">
								<p>Order placed on: <b>'.$date.'</b></p>
								<p>Order No.: <b>'.$order_no.'</b></p>
								<p></p>
								<p></p>
							</td>
							<td style="font-size: 12px;text-align: right;display: initial;">
								<p>'.$fac_name.'</b></p>
								
							</td>

						</tr> 

					</table>
					<h4 style="font-size: 16px;color: #38404b;font-weight: 600;">Order Details:</h4>
					<table style="width: 100%;border: 2px dashed #c3c3c3;padding: 8px;margin-bottom: 1rem;">
						<tr>
							<td colspan="3">
								<table width="100%" style="text-align: center; background: #fff;border: 1px solid #ccc;">
									<thead>
										<tr>
											<th>Date</th>
											<th>Sport</th>
											<th>Slot time</th>
											<th>Price</th>
										</tr>		
									</thead>
									<tbody> '.$loop.' </tbody>	
								</table>	
							</td>
						</tr>                                                                                                              
						<tr>
							<td colspan="2" valign="top" style="width: 350px;"><b>Booking Mode: '.$booking_type.'</b></td>           
							<td style="text-align: right;padding-top: 10px;">
								<p>Total Amount: <span>₹ '.$total_amount.'</span><br>
									Coupon Discount: <span>(-) ₹  0</span>
									<hr class="seprprice">
									<b>Paid Amount:</b> <span><b>₹'.$total_amount.' </b></span>
								</p>
							</td>    
						</tr> 
					</table>
					<strong>Thanks,</strong><br>
					SocialSportz
				</p>
			</td>
		</tr>
	</table>
</body>';
	
	$subject_user="SocialSportz : Offline Booking";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}

}


## send mail for online_booking booking here
if(isset($_POST['action']) && $_POST['action']=='online_booking')
{
	//echo "<pre>";
	//print_r($_POST); die;

	$order_no=$_POST['order_no'];
	$user_email=$_POST['register_email'];
	$user_name=$_POST['username'];
	$mobile=$_POST['mobile'];
	$city=$_POST['city'];
	$address=$_POST['address'];
	$total_amount=$_POST['total_amount'];
	$fac_name=$_POST['fac_name'];
	$sport_name=$_POST['sport_name'];
	$coupon_amount=$_POST['coupon_amount'];
	$booking_detail_arr =  unserialize($_POST['booking_detail_arr']);
	$paid_amount = $total_amount-$coupon_amount;
	 $booking_type=$_POST['booking_type'];
	   
	$date=date('d-m-Y');
	$loop='';
	foreach($booking_detail_arr as $val){ 
	$booking_date=date('d-m-Y',strtotime($val['booking_date']));
		$loop = $loop.'<tr>
						<td>'.$booking_date.' </td>
						<td>'.$sport_name.' </td>
						<td>'.$val['slot_time'].'</td>
						<td>'.$val['price'].'</td>
						</tr>';
	} 
	$body_user='<body bgcolor="#FFFFFF" style="-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 620px; margin: 0 auto; height: 100%;">
	<table class="head-wrap"  style="width: 100%;background: #ffffff; border: 2px solid #ccc;">
		<tr style="background: #f5f2f2;">
			<td colspan="3" style="padding: 10px 10px;">
				<table width="100%">
					<tr>
						<td>
							<h2>'.$user_name.',</h2>
							<p style="font-size: 13px;">Your order has been successfully placed.</p><br><br>	
						</td>
						<td align="right">
							<img width="200" src="'.SITEURL.'assets/public/images/logo.png">	
						</td>
					</tr>
				</table>


				<table style="width: 100%;border: 2px dashed #c3c3c3;padding: 8px;margin-bottom: 1rem;">
					<tr>
						<td style="font-size: 14px;">
							<p style="font-weight: bold;">User Details<p>
								<p>Name:- '.$user_name.'<br>
								Email:- '.$user_email.'<br>
							    Mobile:- '.$mobile.' <br>
								Address:-'.$address.' </p>

							</td>    
							<td style="font-size: 12px;text-align: right;display: initial;">
								<p>Order placed on: <b>'.$date.'</b></p>
								<p>Order No.: <b>'.$order_no.'</b></p>
								<p></p>
								<p></p>
							</td>
							<td style="font-size: 12px;text-align: right;display: initial;">
								<p> <b>'.$fac_name.'</b></p>
								<p></p>
								<p></p>
							</td>
						</tr> 

					</table>
					<h4 style="font-size: 16px;color: #38404b;font-weight: 600;">Order Details:</h4>
					<table style="width: 100%;border: 2px dashed #c3c3c3;padding: 8px;margin-bottom: 1rem;">
						<tr>
							<td colspan="3">
								<table width="100%" style="text-align: center; background: #fff;border: 1px solid #ccc;">
									<thead>
										<tr>
											<th>Date</th>
											<th>Sport</th>
											<th>Slot time</th>
											<th>Price</th>
										</tr>		
									</thead>
									<tbody> '.$loop.' </tbody>	
								</table>	
							</td>
						</tr>                                                                                                      
						
						<tr>
							<td colspan="2" valign="top" style="width: 350px;"><b>Booking Mode:'.$booking_type.'</b></td>           
							<td style="text-align: right;padding-top: 10px;">
								<p>Total Amount: <span>₹ '.$total_amount.'</span><br>
									Coupon Discount: <span>(-) ₹  '.$coupon_amount.'</span>
									<hr class="seprprice">
									<b>Paid Amount:</b> <span><b>₹ '.$paid_amount.'</b></span>
								</p>
							</td>    
						</tr> 
					</table>
					<strong>Thanks,</strong><br>
					SocialSportz
				</p>
			</td>
		</tr>
	</table>
</body>';
	
	$subject_user="SocialSportz : Online Booking";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}

}


## send mail for Event booking here
if(isset($_POST['action']) && $_POST['action']=='event_booking')
{
	$order_no=$_POST['order_no'];
	$user_email=$_POST['register_email'];
	$user_name=$_POST['username'];
	$mobile=$_POST['mobile'];
	$city=$_POST['city'];
	$address=$_POST['address'];
	$total_amount=$_POST['total_amount'];
	$final_amount=$_POST['final_amount'];
	$event_name=$_POST['event_name'];
	$event_city=$_POST['event_city'];
	$event_venue=$_POST['event_venue'];
	$event_start_date=$_POST['event_start_date'];
	$event_end_date=$_POST['event_end_date'];
	$event_start_time=$_POST['event_start_time'];
	$event_end_time=$_POST['event_end_time'];
	$coupon_amount=$_POST['coupon_amount'];
	$fac_name=$_POST['fac_name'];
	$booking_type=$_POST['booking_type'];
$paid_amount = $total_amount-$coupon_amount;
	$date=date('d-m-Y'); 
	$body_user='<body bgcolor="#FFFFFF" style="-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 620px; margin: 0 auto; height: 100%;">
	<table class="head-wrap"  style="width: 100%;background: #ffffff; border: 2px solid #ccc;">
		<tr style="background: #f5f2f2;">
			<td colspan="3" style="padding: 10px 10px;">
				<table width="100%">
					<tr>
						<td>
							<h2>Hi '.$user_name.',</h2>
							<p style="font-size: 13px;">Your order has been successfully placed.</p><br><br>	
						</td>
						<td align="right">
							<img width="200" src="'.SITEURL.'assets/public/images/logo.png">	
						</td>
					</tr>
				</table>


				<table style="width: 100%;border: 2px dashed #c3c3c3;padding: 8px;margin-bottom: 1rem;">
					<tr>
						<td style="font-size: 14px;">
							<p style="font-weight: bold;">User Details<p>
								<p>Name:- '.$user_name.'<br>
									Mobile:- '.$mobile.' <br>
									Email:- '.$user_email.'<br>
								</p>

							</td>    
							<td style="font-size: 12px;text-align: right;display: initial;">
								<p>Order placed on: <b>'.$date.'</b></p>
								<p>Order No.: <b>'.$order_no.'</b></p>
								<p></p>
								<p></p>
							</td>
							<td style="font-size: 12px;text-align: right;display: initial;">
								<p><b>'.$fac_name.'</b></p>
								<p></p>
								<p></p>
							</td>
						</tr> 

					</table>
					<h4 style="font-size: 16px;color: #38404b;font-weight: 600;">Order Details:</h4>
					<table style="width: 100%;border: 2px dashed #c3c3c3;padding: 8px;margin-bottom: 1rem;">
						<tr>
							<td colspan="3">
								<table width="100%" style="text-align: center; background: #fff;border: 1px solid #ccc;">
									<thead>
										<tr>
											<th>Event Name</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Start Time</th>
											<th>End Time</th>
											<th>Venue</th>
											<th>Address</th>
										</tr>		
									</thead>
									<tbody>
										<tr>
											<td>'.$event_name.'</td>
											<td>'.date('d-m-Y',strtotime($event_start_date)).'</td>
											<td>'.date('d-m-Y',strtotime($event_end_date)).'</td>
											<td>'.$event_start_time.'</td>
											<td>'.$event_end_time.'</td>
											<td>'.$event_venue.'</td>
											<td>'.$event_city.'</td>
										</tr>
											
									</tbody>	
								</table>	
							</td>
						</tr>                                                                                                              
						<tr>
							<td colspan="2" valign="top" style="width: 350px;"><b>Booking Mode: '.$booking_type.'</b></td>           
							<td style="text-align: right;padding-top: 10px;">
								<p>Total Amount: <span>₹ '.$total_amount.'</span><br>
									Coupon Discount: <span>(-) ₹  '.$coupon_amount.'</span>
									<hr class="seprprice">
									<b>Paid Amount:</b> <span><b>₹ '.$paid_amount.'</b></span>
								</p>
							</td>    
						</tr> 
					</table>
					<strong>Thanks,</strong><br>
					SocialSportz
				</p>
			</td>
		</tr>
	</table>
</body>';
	
	$subject_user="SocialSportz : Online Booking";
	$mailsend = sendMailUser($user_name, $user_email,$subject_user,$body_user);
	if($mailsend){

	}

}

//contact us
if(isset($_POST['action']) && $_POST['action']=='senduser')
{
	
	$query_name=$_POST['query_name'];
	$query_email=$_POST['query_email'];
	$subject_user="SocialSportz : Contact Us";
	$body_user='Hi '.$query_name.' <br><br>Thank you for contacting us.<br> We will respond to your request shortly..<br><br><br>Thanks, <br>Team socialsportz';
    // print_r($body_user);
	$mailsend = sendMailUser($query_name,$query_email,$subject_user,$body_user);
	//die("script done");	
	
	if($mailsend){

	}
	
}

if(isset($_POST['action']) && $_POST['action']=='sendAdmin')
{
	 // print_r($_POST);
	 
	$query_name=$_POST['query_name'];
	$query_email='chauhansachin0204@gmail.com';
	$query_title=$_POST['query_title'];
	$query_contact=$_POST['query_contact'];
	$query_message=$_POST['query_message'];
	    $subject_admin="SocialSportz : Contact Us";
         $body_admin="<b>"."Dear Admin</b>, "."<br/><br/>"."You have received a query from Contact "."<br/><br/>"."<table width='50%' style='padding:0 0 10px 5px; border-collapse:collapse; background-color:#E6E6E6;' valign='top' border='1' cellsapacing='0' cellpadding='0'><tr><td width='35%' style='padding: 3px 3px 3px 3px;background-color:#ffffff;'> Name</td><td style='padding: 3px 3px 3px 3px;background-color:#ffffff;'>".$query_name."</td></tr><tr><td width='35%' style='padding: 3px 3px 3px 3px;background-color:#ffffff;'> Email</td><td style='padding: 3px 3px 3px 3px;background-color:#ffffff;'>".$query_email."</td></tr><tr><td width='35%' style='padding: 3px 3px 3px 3px;background-color:#ffffff;'> Titlle</td><td style='padding: 3px 3px 3px 3px;background-color:#ffffff;'>".$query_title."</td></tr><tr><td width='35%' style='padding: 3px 3px 3px 3px;background-color:#ffffff;'> Contact</td><td style='padding: 3px 3px 3px 3px;background-color:#ffffff;'>".$query_contact."</td></tr><tr><td width='35%' style='padding: 3px 3px 3px 3px;background-color:#ffffff;'>Message</td><td style='padding: 3px 3px 3px 3px;background-color:#ffffff;'>".$query_message."</td></tr></table><br/>Thank You!<br/>";
		 // print_r($body_admin);
		$mailsend = sendMailAdmin($query_name,$query_email,$subject_admin,$body_admin);
	    // die("script done");
		//print_r($mailsend);
		if($mailsend){

	}
	 
}


if(isset($_POST['action']) && $_POST['action']=='email_subscribe')
{

	$email=$_POST['email'];
	$subject_user="SocialSportz : Newsletter Subscribe";
	$body_user='Hi, <br><br>Thanks for Subscribing SocialSportz.<br><br><br>Thanks, <br>Team socialsportz';
	$mailsend = sendMailUser($email,$email,$subject_user,$body_user);
	//die("script done");	
	
	if($mailsend){

	}
	
}
?>