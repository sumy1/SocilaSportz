<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>	

<body>

	<table style="font-family: 'Poppins', sans-serif; width: 900px; margin:auto; line-height: 25px" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" align="center" style="padding:25px 10px;font-weight: bold;font-size: 14px;">
				<span style="color: #1371a2; font-weight: bold; font-size: 24px;">Social Sportz</span><br></td>
			</tr>
			<tr>
				<td align="left">
					<img src="<?=base_url('assets/public/images/logo.png');?>" width="150px">	
				</td>

				<td>
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="320">

							</td>
							<td align="right" width="200">Receipt Date: <?php echo date('d-m-Y', strtotime($order_main_detail->booking_on));?><br>
								Receipt No.: <?=$order_main_detail->booking_order_no;?>
							</td>

						</tr>	
					</table>
				</td>	

			</tr>

			<tr>
				<td colspan="2" style="text-align: center; font-size: 22px;  color:#444343; margin-bottom: 10px; padding:15px 0 0;"><span style="position: absolute;
				width: 112px;

				background: #fff;
				left: 50%;
				transform: translateX(-50%);">RECEIPT</span>
				<hr>
			</td>	
		</tr>





		<tr>
			<td colspan="2">
				<table style="width: 100%; " cellpadding="0" cellspacing="0">

					<tr>
						<td valign="top" style="width: 270px; font-size: 14px; line-height: 19px; padding: 15px;">
							Billed To,<br>
							<?=$order_main_detail->name;?><br>
							<?=$order_main_detail->email;?><br>
							<?=$order_main_detail->mobile;?> <br> 
							<?=$order_main_detail->address;?><br> 
							
						</td>
						<td colspan="2">&nbsp;</td>
						<td valign="top" align="right" style="font-size: 14px; line-height: 19px; padding: 15px;"><?=$event_detail->event_venue;?> <br> <?=$event_detail->event_city;?><br> 
							<br> 
						</td>
					</tr>

					<tr>
						<td colspan="4" style="text-align: LEFT; font-size: 15px;  color:#000;  padding:0px 0 10px;">

							We have received total <strong><img width="14" src="<?=base_url('assets/public/images/rupee.svg');?>"><?=$order_main_detail->final_amount;?></strong> for given services.
						</td>
					</tr>


					<tr style="background:#efeeee; color:#000; font-size: 13px;">
						<td colspan="4">
							<table cellspacing="0" cellpadding="0" width="100%" style="font-size: 14px">
								<tr>

									<td align="center" class="bgback" style=" padding:10px;background:#efeeee; color:#000; font-weight: bold; width: 7% ">S. No.</td>
									<td align="center" class="bgback" style=" padding:10px;background:#efeeee; color:#000; font-weight: bold; width: 25% ">Facility Name</td>
									<td class="bgback" align="center"  style=" padding:10px;background:#efeeee; color:#000; font-weight: bold;width: 15% ">Sport</td>
									<td class="bgback" align="center"  style=" padding:10px;background:#efeeee; color:#000; font-weight: bold;width: 15% ">Event Name</td>
									<td class="bgback" align="center"  style=" padding:10px;background:#efeeee; color:#000; font-weight: bold;width: 15% ">Event Date</td>
									<td align="center" class="bgback"  style=" padding:10px;background:#efeeee; color:#000; font-weight: bold; width: 20% ">Event Timing</td>
									<td align="right" class="bgback"  style=" padding:10px;background:#efeeee; color:#000; font-weight: bold; text-align: center; width: 10% ">Amount</td>
									
								</tr>
							</table>
						</td>
					</tr>

					
					

					<tr style=" color:#000; font-size: 13px;">
						<td colspan="4">
							<table cellspacing="0" cellpadding="0" width="100%" style="font-size: 14px">
								<tr>

									<td align="center" class="bgback" style=" padding:10px; color:#000; width: 7%; border-bottom: 1px solid #ece7e7;">1</td>
									<td align="center" class="bgback" style=" padding:10px; color:#000; width: 25%; border-bottom: 1px solid #ece7e7; "><?=$fac_detail->fac_name;?></td>
									<td align="center" class="bgback"  style=" padding:10px; color:#000; width: 15%; border-bottom: 1px solid #ece7e7; "> <?=$sport_list_detail->sport_name;?></td>
									
									<td align="center" class="bgback"  style=" padding:10px; color:#000; width: 15%; border-bottom: 1px solid #ece7e7; "> <?=$order_sub_detail->event_name;?></td>
									
									<td class="bgback" align="center"  style=" padding:10px; color:#000; width: 15%; border-bottom: 1px solid #ece7e7; "><?=date('d-m-Y', strtotime($order_sub_detail->event_start_date));?> / <?=date('d-m-Y', strtotime($order_sub_detail->event_end_date));?></td>
									<td align="center" class="bgback"  style=" padding:10px;; color:#000; width: 20%; border-bottom: 1px solid #ece7e7;"><?=$order_sub_detail->event_start_time.' - '.$order_sub_detail->event_end_time;?></td>
									<td align="right" class="bgback"  style=" padding:10px; color:#000;  text-align: center; width: 10%; border-bottom: 1px solid #ece7e7; "><img width="14" src="<?=base_url('assets/public/images/rupee.svg');?>"> <?=$order_sub_detail->booking_detail_final_amount;?></td>
								
									</tr>
								</table>
							</td>
						</tr>
					

					</table>		

				</td>
			</tr>


			<tr>
				<td>
                <table cellspacing="0" cellpadding="0" width="200" align="left">
                 <tr>
				<td style=" line-height: 30px;  font-size: 14px;  color: #000;"><strong>Payment Mode:</strong> <?=$order_main_detail->payment_method;?></td>
								<td style="text-align: right; line-height: 30px; font-size: 14px; padding-right:10px; "></td>
								</tr>
								</table>	
				</td>
				<td>
					<table cellspacing="0" cellpadding="0" width="300" align="right">

						<tr>
							<td style="line-height: 30px;    font-size: 14px;
							font-weight: bold; color: #000;" >Amount</td>

							<td style="text-align: right; line-height: 30px; font-size: 14px; padding-right:10px;  "><img width="14" src="<?=base_url('assets/public/images/rupee.svg');?>"> <?=$order_main_detail->total_amount;?>

							</tr>

							<tr>
								<td style=" line-height: 30px;  font-size: 14px; font-weight: bold; color: #000;">Coupon Discount</td>
								<td style="text-align: right; line-height: 30px; font-size: 14px; padding-right:10px; ">( - )<img width="14" src="<?=base_url('assets/public/images/rupee.svg');?>"> <?php if($order_main_detail->discount_amount=='') echo "0";else echo $order_main_detail->discount_amount;?></td>
							</tr>

							

							<tr>
								<td style=" line-height: 30px;  font-size: 14px; font-weight: bold; color: #000;border-top: 1px solid #ccc;"> Total Amount(Inclusive Tax)</td>
								<td style="text-align: right; line-height: 30px; font-size: 14px; padding-right:10px;border-top: 1px solid #ccc; "><img width="14" src="<?=base_url('assets/public/images/rupee.svg');?>"> <?=$order_main_detail->final_amount;?></td>
							</tr>




						</table>
					</td>
				</tr>
                   <tr>
								
							</tr>
							
				<tr>
				 
					<td colspan="2" style="padding-top:40px; font-size: 14px">
						<strong>
						Note: </strong>All Values have been rounded off to the nearest integer.
						<br>
						

					</td>


				</tr>	

			</table>

		</body>
		</html>