<!DOCTYPE html>
	<html>

	<head>
		<title>Social Sportz</title>
		<?php $this->load->view('public/common/head');?>
		<style>

#addReviews .modal-header {
    color: #fff;
    padding: 12px 24px 7px !important;
    border-bottom: 0;
}

.review_btn{margin-top: 5px}

.failedstatus
{
	    margin-bottom: 15px;
}



#addReviews .modal-header h4 {
    font-size: 18px;
    width: 100%;
}

#addReviews textarea.form-control {
    height: 50px;
    border: 1px solid #ccc;
    /* border-bottom: none; */
    background: #fff;
    background-image: none !important;
    padding:10px;
}

#addReviews .modal-header .fa-times {
    font-size: 18px;
    position: absolute;
    right: 0;
    top: 25px;
}

		.modal-backdrop{opacity: 0.6 !important}
		header{
		background: #000;
	}

	form {margin-bottom: 0px !important}

	.userdasboard-wrapper
	{
		margin-top:120px;
	}


	.search-area:before{
		content: '';
		width:100%;
		height:109px;
		background:rgba(255,255,255,0.4);
		left:0px;
		top:0px;
		position:absolute;
	}

	.search-wrapper{
			margin-top: 230px;
	}

	.search-area {    background: url(assets/images/footer_bg.jpg);}
	.search-area {
		position:fixed !important;
		margin-bottom: 30px;
		top: 105px;
		height: 105px;
		z-index: 9999999;
	}

   .icone.loaction
   {
   	display: block;
   }

   #user-booking button
   {
   	    -webkit-appearance: none;
    background: none;
    border: none;
    color: #fff;
   }

	</style>

	</head>

	<body id="user-booking">
		<?php $this->load->view('public/common/header');?>
		<!-- // Banner starts Here // -->
		<div class="clearfix"></div>

			
	<section class="userdasboard-wrapper">
	<div class="container">
	<div class="row">

	<div class="col-sm-12">
	<div class="row">
					<div class="col-md-4">

	<div class="sidebar_profile">
		<?php $this->load->view('public/common/usersidebar');?>
	</div>					</div>
	<div class="col-sm-8">
	<h1>Booking</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 30px">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#academyfacilityuserbooking" role="tab" aria-controls="home"
      aria-selected="true">Slot/Batch Bookings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#eventuserbooking" role="tab" aria-controls="profile"
      aria-selected="false">Event Bookings</a>
  </li>

</ul>
	<div class="profile_tab_container">

		<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="academyfacilityuserbooking" role="tabpanel">
										<ul class="list-unstyled list_items_dashboard booking_listing">
										
										
										
									<?php
									 if(isset($get_booking_order) && !empty($get_booking_order)){foreach($get_booking_order as $bookingorderkey=>$bookingorderval){
									?>
									       <li>
												<div class="booking_data clearfix">
													<form action="<?=base_url('dashboard/download_booking_receipt');?>" method="post">
														<input type="hidden" name="order_id" value="<?php  echo $bookingorderval->booking_order_id;?>">
													<span class="latest_notification"> 
														<button type="submit">Download Receipt</button> </span> </form>
													<?php
											$data['get_facility']=$this->CommonMdl->getResultByCond('tbl_facility',array('fac_id'=>$get_booking_order[$bookingorderkey]->get_slot_detail[0]->fac_id),'fac_city,fac_name,fac_slug,fac_id,fac_banner_image',$order_by='');
											   foreach($data['get_facility'] as $facility){
													?>
													<div class="img_item">
														<a href="<?=base_url('searchlisting/search_detail/'.$facility->fac_slug);?>"><img src="<?=base_url('assets/public/images/fac/'.$facility->fac_banner_image);?>" class="img-fluid" alt=""></a>
													</div>
													
												
													<div class="item_data">
														<div class="col-sm-12 nopadleft">
														    <a data-toggle="modal" data-target="#bookingdetaillistuser" class="title_dash">Booking ID : <?php  echo $bookingorderval->booking_order_no;?> <input type="hidden" id="booking_order_id" value="<?=$bookingorderval->booking_order_id;?>"></a>
													    </div>
													    <span class="icone loaction"> <?php
                                                       echo $facility->fac_name;?></span>
														
														<span class="icone loaction"><i class="fa fa-map-marker"></i> <?php
                                                       echo $facility->fac_city;?></span>
													  <?php
											      }
													?>
														
												   <?php
												   
												     foreach($get_booking_order[$bookingorderkey]->get_slot_detail as $booking_slotkey=>$booking_slotval){
													?>												
														<span class="icone date d-inline-block">
                                                        <i class="fa fa-calendar"></i>
													     <?php echo  date("d-M-Y", strtotime($booking_slotval->start_date));?>
													  </span>
														<span class="icone  d-inline-block ml-2 time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?=$booking_slotval->batch_slot_start_time;?>  to <?=$booking_slotval->batch_slot_end_time;?> </span><br>
														<?php
													 }
														?>
														
													</div>
													

													<div class="row col-sm-12">
															
															
														<div class="col-sm-6">
															<?php $rating_count=$this->CommonMdl->fetchNumRows('tbl_rating',array('user_id'=>$this->session->userdata['user_id'],'booking_order_id'=>$bookingorderval->booking_order_id),'');
															if($rating_count==0){
															 ?>
														<a class="btn btn-info orange-btn review_btn" style="text-transform: inherit;" data-toggle="modal" data-target="#addReviews"><input type="hidden" class="order_fac_id" value="<?=$facility->fac_id;?>"><input type="hidden" class="order_fac_name" value="<?=$facility->fac_name;?>"><input type="hidden" class="order_id" value="<?=$bookingorderval->booking_order_id;?>">Write a Review</a>
													
													<?php } else{

													} ?>
                                                    </div>

													<div class="col-sm-6 text-right nopadright failedstatus " >
													Payment Status:<span class="<?php if($bookingorderval->payment_status=='success') echo "green"; else echo "red";?>"> <?php  echo ucwords($bookingorderval->payment_status);?></span>
													</div>	
													</div> 
												</div>
												
												
												
											</li>
									 <?php } } else{ ?>

									 <span>No booking yet</span>

									<?php  } ?>
									   </ul>
									   <div class="row">
									    <input type="hidden" id="Count_booking" value="<?=$count_booking;?>">
									    <?php if($count_booking>5){?>
												<div class="col-md-12 text-center" id="viewMore">
													<a href="javascript:void(0);" class="btn orange-btn btn-raised btn-sm save_btn view_moress" id=""><input type="hidden" class="user_id" value="<?=$this->session->userdata['user_id'];?>">View More</a>
												</div>
										<?php } ?>
											</div>
									</div>

									  <div class="tab-pane fade show" id="eventuserbooking" role="tabpanel">
									     <ul class="list-unstyled list_items_dashboard user_booking_event">
										     
											 <?php
											   if(isset($get_booking_orders) && !empty($get_booking_orders)){foreach($get_booking_orders as $bookingorderkey=>$bookingorderval){?>
											 <li>
												<div class="booking_data clearfix">
													<form action="<?=base_url('dashboard/download_event_booking_receipt');?>" method="post">
														<input type="hidden" name="order_id" value="<?php  echo $bookingorderval->booking_order_id;?>">
													<span class="latest_notification"> 
														<button type="submit">Download Receipt</button> </span> </form>
													
												
													<div class="img_item">
														<img src="<?=base_url('assets/public/images/event/banner/'.$bookingorderval->event_listing[0]->event_banner);?>" class="img-fluid" alt="">
													</div>
													
												
													<div class="item_data">
														<div class="col-sm-12 nopadleft">
														    <a data-toggle="modal" data-target="#eventdetaillistusers" class="booking_event">Booking ID : <?php  echo $bookingorderval->booking_order_no;?> <input type="hidden" id="booking_order_id" value="<?=$bookingorderval->booking_order_id;?>"></a>
													    </div>
														<span class="icone loaction"><?php echo $bookingorderval->facility_listing[0]->fac_name;?> </span>

														<span class="icone loaction"><?php echo $bookingorderval->booking_event_details[0]->event_name;?> 
														(<?php echo $bookingorderval->sport_listing[0]->sport_name;?>)
														</span>
														
														<span class="icone loaction"><i class="fa fa-map-marker">
														</i>&nbsp;<?php echo $bookingorderval->event_listing[0]->event_venue;?>,&nbsp;<?php echo $bookingorderval->event_listing[0]->event_google_address;?> 
                                                      </span>
														<span class="icone date d-inline-block">
                                                        <i class="fa fa-calendar"></i>
													      <?php echo  date("d-M-Y", strtotime($bookingorderval->booking_event_details[0]->event_start_date));?>
													     &nbsp;&nbsp;<?php echo  date("d-M-Y", strtotime($bookingorderval->booking_event_details[0]->event_end_date));?>
													  </span><br>
														<span class="icone  d-inline-block ml-2 time">
														  <i class="fa fa-clock-o" aria-hidden="true"></i>
														<?=trim($bookingorderval->booking_event_details[0]->event_start_time);?> to <?=trim($bookingorderval->booking_event_details[0]->event_end_time);?>
                                                     </span><br>

														
														
														
														
													</div>
												</div>
											</li>
											<?php
											   } }
											else{ ?>

									 <span>No booking yet</span>

									<?php  } ?>
										 
										 
										 </ul>
										 <div class="row">
									      <input type="hidden" id="Count_booking_event" value="<?=$count_booking_event;?>">
											<?php if($count_booking_event>5){?>
													<div class="col-md-12 text-center" id="viewMoreevent">
														<a href="javascript:void(0);" class="btn orange-btn btn-raised btn-sm save_btn view_moressevent" id=""><input type="hidden" class="user_id" value="<?=$this->session->userdata['user_id'];?>">View More</a>
													</div>
											<?php } ?>
										</div>
									</div>
	
                                  </div>
                                  </div>


	</div>
	</div>
	</section>
	
	
	
	<div class="modal fade requestModal edit_profile_modal" id="addReviews">
	<form>
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="request-head mb-0 order_fac_name"></h4><button style="top:0px" type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
          <form action="">
		 
            <div class="form-group row align-items-center mb-2">
              <p for="rating" class="col-sm-3 col-form-label text-black">Rating : </p>
              <div class="col-sm-9">
                <div class="rate rating-2">
                  <i class="fa fa-star" ></i>
				  <i class="fa fa-star" ></i>
				  <i class="fa fa-star" ></i>
				  <i class="fa fa-star" ></i>
				  <i class="fa fa-star"></i>  
                </div>
              </div>
			  <input type="hidden" name="order_fac_id" id="order_fac_id">
			  <input type="hidden" name="order_id_for_rating" id="order_id_for_rating">
			   <span class="error" id="errorrating"></span>
            </div>
            <div class="form-group row align-items-center">
              <p class="col-sm-12 col-form-label text-black labelreview">Write a Review : 
            </p>
              <div class="col-sm-12">
                <textarea name="" onkeyup="leftTrim(this)" rows="2" id="rating_message" class="form-control grey_input"></textarea>
                <span class="char-limit float-right text-danger"><span id="rchars" class="text-danger">800</span> charecters left</span>
              </div>
            </div>
			<div class="modal-footer">
         <div class="col-sm-12 text-right">
          <button style="background: #f44337;" type="button" class="btn btn-sm orange-btn" id="reviewactions" >Submit</button>
        </div>
      </div>
			
          </form>
        </div>
        
    </div>
  </div>
</form>
</div>	



			<?php $this->load->view('public/common/footer');?>

<div class="modal fade edit_profile_modal" id="bookingdetaillistuser" role="dialog">
    <div class="modal-dialog">
<div id="booking_detail_view">
</div>
</div>
</div>


<div class="modal fade edit_profile_modal" id="eventdetaillistusers" role="dialog">
    <div class="modal-dialog">
<div id="booking_event_view">
</div>
</div>
</div>



			<?php $this->load->view('public/common/foot');?>
		</body>
		

<script>
var counddt = $('#Count_booking').val();
var total_booking_show = 5;
$(document).on("click",'.view_moress',function(){
	var user_id= $(this).find('.user_id').val();
	total_booking_show = total_booking_show+5;
	if(user_id!='' && total_booking_show!=''){
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>dashboard/user_booking',    
				data: {user_id:user_id,total_booking_show:total_booking_show},
				success:function(res){
					if(total_booking_show>=counddt){
						document.getElementById('viewMore').style.visibility = 'hidden';
					}
					$(".booking_listing").html(res['_html']);
                   }              
				});
			}
			
});

var total_booking_shows = 5;
$(document).on("click",".view_moressevent",function(){
	var eventcount =$('#Count_booking_event').val();	 
    var user_id= $(this).find('.user_id').val();
	total_booking_shows = total_booking_shows+5;
	if(user_id!='' && total_booking_shows!=''){
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>dashboard/user_booking',    
				data: {user_id:user_id,total_booking_shows:total_booking_shows},
				success:function(res){
					if(total_booking_shows>=eventcount){
						document.getElementById('viewMoreevent').style.visibility = 'hidden';			
					}
					$(".user_booking_event").html(res['_html']);
                   }              
				});
			}
	
});
 jQuery("#addReviews .fa-star").on("click", function(){jQuery("#addReviews .fa-star").removeClass("staractive"); jQuery(this).addClass("staractive"); jQuery(this).prevAll().addClass("staractive");});
 
  $(document).on("click", ".review_btn", function(){
             var order_fac_id=$(this).find('.order_fac_id').val();
             var order_fac_name=$(this).find('.order_fac_name').val();
             var order_id=$(this).find('.order_id').val();
			     
			$('#order_fac_id').val(order_fac_id);
			$('.order_fac_name').text(order_fac_name);
			$('#order_id_for_rating').val(order_id);
       });
	$(document).ready(function(){
		  $('#reviewactions').click(function(){
			  var rating=$('.rating-2').find('.staractive').length;
	   var rating_message= $('#rating_message').val();
	   var fac_id= $('#order_fac_id').val();
	   var order_id_for_rating= $('#order_id_for_rating').val();
	   
	   if(rating == 0){
		   $("#errorrating").html('Please select  rating');
		    return false;
	   }else{
		   $("#errorrating").html('');
	   }
	   
	    $.ajax({
			type : "POST",
			url : '<?=base_url('searchlisting/ratinginsert');?>',
			data : {rating:rating,rating_message:rating_message,fac_id:fac_id,order_id_for_rating:order_id_for_rating},
			success:function(res){
			if(res!='failed'){
				swal({
					title : 'You are awesome!',
                     html : 'Thanks for spending your valuable time',
					type: 'success'
				  }).then((result) => {
					if (result.value) {
						$('#rating_message').val('');
						$('#addReviews').modal('hide');
						window.location.href = '<?php echo base_url('dashboard/user_rating') ?>';
						
						}
					   })
		  }
			else{
				$('#error_msg').show(); 
				$('#error_msg').text("Network issue");
			}
			}
		});
		
		  });
	  });
	  
	  
	  
	  
	  
   	
		$(document).ready(function(){
			$('.title_dash').click(function(){
				 let booking_order_id=$(this).find("input").val();
				  showingLoader();
				 $.ajax({
					 type : 'POST',
					 url :  '<?=base_url('dashboard/user_booking_view_model');?>',
					 data : {booking_order_id:booking_order_id},
					 success:function(res){
				     hiddingLoader();
				$("#booking_detail_view").html(res['_html']);
			}	
					 
				 });
			});
		});
		
		
		$(document).ready(function(){
			$('.booking_event').click(function(){
				 let booking_order_id=$(this).find("input").val();
				  showingLoader();
				 $.ajax({
					 type : 'POST',
					 url :  '<?=base_url('dashboard/bookingeventviewmodel');?>',
					 data : {booking_order_id:booking_order_id},
					 success:function(res){
				     hiddingLoader();
				$("#booking_event_view").html(res['_html']);
			}	
					 
				 });
			});
		});
		
		
		
			jQuery('header').removeClass("blackbg");
			$(window).scroll(function() {
		if ($(this).scrollTop() > 100) { // this refers to window
			jQuery('header').addClass("blackbg");
		}

		else
		{
			jQuery('header').removeClass("blackbg");
		}
	});

	jQuery(".togglefilter").on("click", function(){jQuery("#gorupedfilter").slideToggle(); jQuery(".darkoverlay").toggle(); });
	jQuery(".darkoverlay, #applyfilter").on("click", function(){jQuery("#gorupedfilter").slideUp(); jQuery(".darkoverlay").hide(); });
	jQuery(".searchsportsname li").on("click", function(){jQuery('.sportsname').find("input").attr("checked", false); jQuery(this).find("input").attr("checked", "checked"); jQuery('.sportsname').find("label").removeClass("activegame"); jQuery(this).find("label").addClass("activegame")});
		$('#Datesearch').dateDropper();

	</script>

	<script>
		$('.calanderpopover').popover({			
				content: '<div class="table-responsive"><table class="table table-sm timimg-table"><tbody><tr><td>Monday</td><td>11am – 11pm</td></tr><tr><td>Tueday</td><td>11am – 11pm</td></tr><tr><td>Wednesday</td><td>11am – 11pm</td></tr><tr class="bold"><td>Thursday</td><td>11am – 11pm</td></tr><tr><td>Friday</td><td>11am – 11pm</td></tr><tr><td>Saturday</td><td>11am – 11pm</td></tr><tr><td>Sunday</td><td class="text-danger text-center">Closed</td></tr></tbody></table></div>', 
				html: true, 
				placement: "bottom",
				trigger: "hover"
			});


		$(document).on('click', '.download_receipt', function(){
    //console.log('okkkkkkk'); 
       var order_id = $(this).find("input").val();
       $.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/download_receipt',	
			data: {order_id:order_id},
			success:function(res){
			}	
		});

  });

		  var maxLength = 800;
$('textarea').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rchars').text(textlen);
});


	</script>

	</html>
	
	
	