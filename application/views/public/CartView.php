<!DOCTYPE html>
<html>

<head>
    <title>Social Sportz</title>
    <link rel="shortcut icon" type="image/png" href="favicon.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view('public/common/head');?>
        <style>

 .istrialcheckbox{
    position: relative !important;
    pointer-events: inherit !important;  
 }       



#ajax_slots_list {width: 100%}


.select_plan.userslottable {
    margin: 0rem auto 0rem;
}

.userslottable.select_plan .amount{text-transform: uppercase;}

.userslottable.select_plan .btn.active .fa-check-circle {
    font-size: 14px;
    position: absolute;
    padding-left: 0px;
    margin: 5px 0 15px;
    display: block;
    left: 9px;
    top: -1px;
}

i.kitprice {
    font-size: 11px;
}

        	.select_plan .btn.active:after{display: none}
.select_plan label.booked{position: relative; width: 165px; height: 79px; padding: 5px 20px;}
.select_plan label.booked:hover:before
{
    content: '\f05e';
    font-family: FontAwesome;
    background: rgba(0,0,0,0.5);
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    transform: scale(1);
    -webkit-transform: scale(1);
    border-radius: 0 !important;
    text-align: center;
    line-height: 66px;
    font-size: 26px;
    transition: all 0s ease-in-out;
    -webkit-transition: all 0s ease-in-out;
    position: absolute;

            }
            .owl-prev{display: none}
            .plan {
                height: 70px;
            }
            
            #userslotbookwrapper .fa-calendar {
                top: 35px !important;
            }
            
            div.datedropper.primary {
                margin-top: -105px;
            }
            
            .bannerheading {
                min-height: 150px;
                position: relative;
            }
            
            #dateRange2.dateRange {
                width: 100%;
            }
            
        #dateRange2 .date_data.selected .week
        {
          color:#fff !important;
        }

        .select_plan .booked.active .amount {
    color: red !important;
}

.select_plan .btn.booked.active {
    background: #fff !important;
}
        </style>
</head>

<body class="userslotbooked" id="userslotbooked">
<?php $this->load->view('public/common/headeruser');?>
        <section class="searchdetail-wrapper1">
            <div class="header-data bottomgap30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="top-head-nav clearfix">
                                <div class="page-title float-md-left">
                                    <h2>Book a <?php if($fac_details->fac_type=='facility') echo "slot";else echo "batch";?></h2> </div>
                                <div class="navigation-bread float-md-right">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Book a <?php if($fac_details->fac_type=='facility') echo "slot";else echo "batch";?></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" id="userslotbookwrapper">
                <div class="row">
                <div class="col-sm-12 nopadleft" style="margin-top:20px">
                    
                    <div class="row">
                    <h1 class="col-sm-8"><?php if(isset($fac_details)) echo ucwords($fac_details->fac_name); ?></h1>
                          
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group is-filled minusgap">
                                        <form id="sport_form" action="<?=base_url('booking');?>" method="post">
                                        <label for="Sport" class="bmd-label-floating">Sports<span class="required">*</span></label>
                                        <select class="form-control slot_port_id" id="batch_sport_id" name="book_sport_id">
                                            <option value="">Please select sport</option>
                                            <?php 
											if (isset($sport_list) && !empty($sport_list)) {
                                               foreach ($sport_list as $sportlists) { ?>
                                            <option value="<?=$sportlists->sport_id;?>" <?php if($sportlists->sport_id==@$sport_details->sport_id) echo "selected"; ?>><?=$sportlists->sport_name;?></option>
                                                
                                                   <?php  }
                                                    } ?>
                                            </select>
                                            </form>
                                            <span id="errAcademySport" class="error"></span>    
                                        </div>
                                    </div>
                  <!--  <h5 class="col-sm-4 text-right">Sports: <span class="orange"><?php if(isset($sport_details)) echo ucwords($sport_details->sport_id); ?></span></h5>  -->
                </div>
					<input type="hidden" id="book_fac_id" value="<?php if(isset($book_fac_id)) echo $book_fac_id; ?>">
					<input type="hidden" id="book_sport_id" value="<?php if(isset($book_sport_id)) echo $book_sport_id; ?>">
					<input type="hidden" id="book_type" value="<?php if(isset($book_type)) echo $book_type; ?>">
                   <h5 class="fullwidth col-sm-12 nopadleft" style="padding-left: 0;">Select Date</h5> 
                    <div class="owl-carousel owl-theme dateRange checkbox_divs" id="dateRange2"></div>
                </div>
				
                <div class="col-sm-8">
                    <div class="select_plan userslottable" >
						<div class="row">
                            <div class="col-sm-8">
							 <h5 class="fullwidth col-sm-12">Select <?php if($fac_details->fac_type=='facility') echo "slot";else echo "batch";?></h5><br>
                             <?php if($fac_details->fac_type=='academy'){ ?>
                            
							<span class="trialcheckbox">
								<input type="checkbox" id="trial_checkbox" name="trial_checkbox" class="istrialcheckbox"> <span><strong>Need Trial?</strong></span>
                            </span> 
							
                            <?php } ?>
                            </div>
                             <?php if($fac_details->fac_type=='academy'){ ?>
                             <div class="col-md-4">
                            <div class="form-group bmd-form-group is-filled planbatch" style="margin-top: 5px;">
                                <select class="form-control" id="package_type">
                                    <option value="0">Select Plan</option>
                                    <?php if ($pacakge_list && !empty($pacakge_list) ) {
                                        foreach ($pacakge_list as $pacakge) { ?>
                                        <option value="<?=$pacakge->package_id;?>"><?=$pacakge->package_name;?></option>
                                    <?php   } 
                                    } ?>
                                    </select>
                                    <i class="fa fa-futbol-o prefix"></i>
                                <span id="errPackage" class="error"></span>   
                            </div>
                        </div>
                        <?php } ?>

							 <div id="ajax_slots_list">
							 <input type="hidden" id="book_date" value="<?php echo $show_date; ?>">
					       <?php if(!empty($fac_slots)){
							foreach ($fac_slots as $slot) {  
								$cat_name=$this->CommonMdl->getRow('tbl_batch_slot_type','batch_slot_type',array('batch_slot_type_id' => $slot->batch_slot_type_id));
								$count=$this->CommonMdl->fetchNumRows('tbl_booking_slot_detail',array('batch_slot_id' => $slot->batch_slot_id,'start_date'=>date('Y-m-d',strtotime($show_date))),$cond1='');
								$slotCount = $this->CommonMdl->checkSlotIntoCart($show_date,$slot->batch_slot_id,$this->session->userdata('session_id'));
							?>
                            <?php if($fac_details->fac_type=='academy'){ ?>
                            <label class="btn <?php if($slotCount>0){ echo "active"; } if($count==$slot->max_participanets) echo "booked";?> <?php if($slot->is_trial != 'yes'){ echo 'trial_no';}?>">
                            <?php } ?>
							<?php if($fac_details->fac_type=='facility'){ ?>
                            <label class="btn <?php if($slotCount>0){ echo "active"; } if($count>0) echo "booked";?>">
								<span class="ribbon_red">(<?=$cat_name->batch_slot_type?>)</span>

								<span class="slotprice">Price: <i class="fa fa-inr"></i> <?php echo $this->CommonMdl->getPriceByBSId($slot->batch_slot_id); ?></span><?php } ?><br>
								<input type="checkbox" name="slot_batch_options" value="<?php echo $slot->batch_slot_id; ?>" class="slot_batch_options" autocomplete="off" <?php if($slotCount>0){ echo "checked"; } ?>>
								<div class="plan"><i class="fa fa-check-circle floatingcheck" aria-hidden="true"></i> <span class="amount time"><?=$slot->start_time.'-'.$slot->end_time;?><br>
                                <?php if($slot->is_kit_available == 'yes') { ?>
								<span class="kitplanprice">kit Available<span class="red">*</span> <i class="fa fa-check-circle varified"></i> ( <i class="fa fa-inr kitprice"></i> <?php echo $slot->kit_price;?>)</span>
								<?php } ?>
								<?php if($slot->is_trial == 'yes') { ?>
									 <span class="slotinfo">Trail Available: Yes</span>
								<?php } ?>
							 <span class="slotinfo">Available(max person <?php echo $slot->max_participanets;?>)</span>
								  </span>
					 	
								</div>

								
							</label>


					<?php } ?>

                    <div class="col-sm-12 text-left"><a class="bookedslot addToCart" href="JavaScript:Void(0);">Add to Cart</a></div> 

                   <?php   }
                   else{ ?>
                    <div class="col-sm-12 text-center notavailable">Not Available</div>
                     <?php } ?>		
							
                    


							</div>
				<?php if($fac_details->fac_type=='facility'){ ?>
                    <div class="col-sm-12 noted">
                            <span class="red">*</span> Kit price is not included in slot price.
                        </div>
                        <?php } ?>
						</div>
					</div>
                </div>
				
                 <div class="col-sm-4 cartright" id="ajax_side_view">
				<?php if(!empty($cart_list_arr)){ ?>
						<h5>MY CART (<span class="cartcount"><?php echo count($cart_list_arr); ?></span>)</h5>
						<hr>
				<?php 
					$total_price=0; $trial_count=0;
					foreach($cart_list_arr as $listVal){ 
					if($listVal->trial_booking =='yes'){ $trial_count = $trial_count+1;}
					else{ $total_price = $total_price+$listVal->slot_package_price; } ?>    
						<div class="row checkoutcolumn">
						   <div class="col-sm-12"></div>
						   <div class="col-sm-5"><i class="fa fa-calendar"></i> <?php echo date('d, M Y',strtotime($listVal->book_date));?></div>
						   <div class="col-sm-7 text-right time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $listVal->start_time .' to '.$listVal->end_time; ?></div>
						   <div class="col-sm-6"> <?php  if($listVal->trial_booking=='yes'){?> <span style="color:green"><b> Trial</b></span><?php }else{ ?><i class="fa fa-inr" aria-hidden="true"></i> <span class="itemprice"> <?php echo $listVal->slot_package_price; ?><?php if($listVal->package_name!='') echo  '('.$listVal->package_name.')'; ?></span><?php } ?></div>
						   <div class="col-sm-6 text-right"><span class="cartitem removeItem"><input type="hidden" class="cart_id" value="<?php echo $listVal->cart_id; ?>"><input type="hidden" class="cart_book_date" value="<?php echo $listVal->book_date; ?>"> <i class="fa fa-trash" aria-hidden="true"></i></span></div>
					   </div>
				<?php } ?>	
						<input type="hidden" id="trial_count" value="<?php echo $trial_count; ?>">
						<div class="row cartchekoutwrapper">
						   <div class="col-sm-6 boldprice">
							<i class="fa fa-inr"></i> <span class="itemtotalprice"><?php echo $total_price; ?></span>
						   </div>

							<div class="col-sm-6 text-left errCheckBtn" style="display:none">
								<span style="color:red">At a single time you can only book a single trail or book batch.</span>
							</div> 
							<div class="col-sm-6 text-left succCheckBtn">
								<a class="bookedslot" href="<?php echo base_url('booking/checkout');?>">Checkout</a>
							</div> 
						
					   </div>
				<?php }else{ ?>
					 <div class="empty-cart" ><img src="<?php echo base_url();?>assets/public/images/empty-cart.svg"><span>Your cart is empty</span></div>
				<?php } ?>
                 </div>
				 
              </div>
            </div>
            </div>
            </div>
        </section>
  <?php $this->load->view('public/common/footer');?>

  <?php $this->load->view('public/common/foot');?>
</body>
<script src="<?=base_url('assets/admin/js/datedropper.min.js');?>"></script>

<script>
	
	function checkTrialCheckout(){
		var cartcount = parseInt($('.cartcount').text());
		var trial_count = parseInt($('#trial_count').val());
		console.log(cartcount+'trial_count='+trial_count);
		if (trial_count>1){
			$('.errCheckBtn').show();
			$('.succCheckBtn').hide();
		}else if(trial_count ==1 && cartcount>1){
			$('.errCheckBtn').show();
			$('.succCheckBtn').hide();
		}else{
			$('.errCheckBtn').hide();
			$('.succCheckBtn').show();
		}
	}
	checkTrialCheckout();
</script>

<script>
    var month = new Array();
    month[0] = "Jan";
    month[1] = "Feb";
    month[2] = "Mar";
    month[3] = "Apr";
    month[4] = "May";
    month[5] = "Jun";
    month[6] = "Jul";
    month[7] = "Aug";
    month[8] = "Sep";
    month[9] = "Oct";
    month[10] = "Nov";
    month[11] = "Dec";
    var abc = new Date().getFullYear();
    var d = new Date();
    var x = month[d.getMonth() + 1];
    var mm = month[d.getMonth()];
    var n = d.getMonth();
    var today = d.toString().split(month[n])[1];


    var rrrx = today.split(" ")[0];
    today = today.split(" ")[1];
  
    function myFunction() {
        jQuery("#dateRange2").empty();
        var lastday = function(y, m) {
            return new Date(y, m + 1, 0).getDate();
        }
        var count1 = lastday(abc, n);
        var i = today;
  
        var mgh = 59;

              var lastday = Number(i) + mgh;
       
        for (i; i <= lastday; i++) {
            var getDaysInweek = function(year, month, i) {
                return new Date(year, month, i).getDate();
            };
            var ndf = new Date(abc, n, i);
            var bbb = ndf.toString();
            var cdf = bbb.split(" ")[2];
            cdf = cdf.replace(/^0+/, '');
            var week  = bbb.split(" ")[0];
            var monthnew  = bbb.split(" ")[1];
            var yearnew  = bbb.split(" ")[3];
			var fulldate = cdf+'-'+monthnew+'-'+yearnew;
            jQuery("#dateRange2").append('<div class="item"><div class="date_data"><input type="radio" name="rGroup" class="slected_date" value="'+fulldate+'"/><span class="week">' + week + '</span><span class="day">' + cdf + ' ' + monthnew + '</span><i class="fa fa-calendar"></i><i class="fa fa-check-circle"></i></div></div>');

            $(".item:eq(0) .week").text("Today");
            $(".item:eq(1) .week").text("Tomorrow");
            }

        $(".item:first-child .date_data").addClass("selected");
  
        triggerowl();
    
    }
    myFunction();


        jQuery(document).on("click", '.date_data', function() {
            jQuery('.date_data').removeClass("selected");
            jQuery(this).addClass("selected");
            $(".select_plan, .bgbookingdetail").show();
            jQuery(this).find("input").attr("selected", true)
        });

    function triggerowl() {
        $('#dateRange2').owlCarousel({
            items: 7,
            margin: 5,
            autoplay: false,
            autoplayTimeout: 3500,
            autoplayHoverPause: true,
            smartSpeed: 450,
            loop: false,
            nav: true,
            dots: false,
            mouseDrag: true,
            touchDrag: true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            responsive: {
                320: {
                    items: 3,
                    autoplay: false,
                },
                575: {
                    items: 4,
                    autoplay: false,
                },
                768: {
                    items: 5,
                    autoplay: false,
                },
                1200: {
                    items: 7,
                    autoplay: false,
                }
            }
        });
    }

	// $(document).on("click", ".cartitem", function(){
		// var mgh = $(".itemtotalprice").html();
		// var abc = $(this).parents(".checkoutcolumn").find(".itemprice").html();
		// var rrr = mgh - abc;

			// $(this).parents(".checkoutcolumn").remove();
			// $(".itemtotalprice").html(rrr);
		// var abc = $(".checkoutcolumn").length;
		// $(".cartcount").text(abc);
		// if(abc==0)
		// {
			// $(".empty-cart").show();
			// $(".cartchekoutwrapper").hide();
		// }

	// });

	$(".owl-next").on("click", function(){
		if($('.owl-item:last-child').hasClass("active"))
		{
			$(".owl-next").hide();
		}
		else{
			$(".owl-next").show();   
		}   
		if($('.owl-item:first-child').hasClass("active"))
		{
			$(".owl-prev").hide();
		}
		else
		{
			$(".owl-prev").show();   
		}
	});

	$(".owl-prev").on("click", function(){
		if($('.owl-item:first-child').hasClass("active"))
		{
			$(".owl-prev").hide();
		}
		else
		{
			$(".owl-prev").show();   
		}

		if($('.owl-item:last-child').hasClass("active"))
		{
			$(".owl-next").hide();
		}
		else
		{
			$(".owl-next").show();   
		}
	});

	$(document).on("click", '.select_plan.userslottable label:not(.booked)', function(){
		$(this).find("input").attr("checked","checked");
		$(this).addClass("active"); return false; 
	});

    $(document).on("click", '.select_plan.userslottable label.booked', function(){
        $('label.booked').find("input").removeAttr("checked");
       return false; 
    }); 

	$(document).on("click", '.select_plan.userslottable label.active', function(){
		$(this).find("input").removeAttr("checked");
		$(this).removeClass("active"); return false; 
     });
	 
	 
/* ********get available_slots after click on date ************ */

    $('#package_type').on('change', function(e) {
        var slected_date = $('.date_data.selected').find('.slected_date').val()
        //alert(slected_date); return false;
        var book_fac_id = $('#book_fac_id').val();
        var book_sport_id = $('#book_sport_id').val();
        var book_type = $('#book_type').val();
        var package = $('#package_type option:selected').val();
        //alert("click"+slected_date);
        if(slected_date!=''){
            $.ajax({
                type: 'POST',
                url: '<?=base_url();?>booking/slots_available_list',
                data:{slected_date:slected_date,book_fac_id:book_fac_id,book_sport_id:book_sport_id,book_type:book_type,package:package},
                success:function(res){  
                    $("#ajax_slots_list").html(res['_html']);
                }
            })
        }   
});

	$(document).on("click",".date_data",function() {
		var slected_date = $(this).find('.slected_date').val();	
		var book_fac_id = $('#book_fac_id').val();
		var book_sport_id = $('#book_sport_id').val();
		var book_type = $('#book_type').val();
        var package = $('#package_type option:selected').val();
		//alert("click"+slected_date);
		if(slected_date!=''){
			$.ajax({
				type: 'POST',
				url: '<?=base_url();?>booking/slots_available_list',
				data:{slected_date:slected_date,book_fac_id:book_fac_id,book_sport_id:book_sport_id,book_type:book_type,package:package},
				success:function(res){  
					$("#ajax_slots_list").html(res['_html']);
				}
			})
		}	
	});
		
/* ******** add items into cart here ************ */
	$(document).on("click",".addToCart",function() {
		var book_fac_id = $('#book_fac_id').val();
		var book_sport_id = $('#book_sport_id').val();
		var book_type = $('#book_type').val();
        var book_date = $('#book_date').val();
		var fac_type = '<?=$fac_details->fac_type ?>';
        var package_id = $('#package_type option:selected').val();
        var package_name = $('#package_type option:selected').text();
		var is_trial = $('#trial_checkbox').is(":checked");
		if (is_trial) {
			is_trial = 'yes';
		}else {
		    is_trial = 'no';
		}
        if (fac_type=='academy' && package_id=='0') {
            swal('Select plan first');
            return false;
        }
		var slots_batch_ids = [];
			$.each($("input[name='slot_batch_options']:checked"), function(){
				slots_batch_ids.push($(this).val());
			});
		if(slots_batch_ids.length >0){
			$.ajax({
				type: 'POST',
				url: '<?=base_url();?>booking/add_to_cart',
				data:{slots_batch_ids:slots_batch_ids,book_fac_id:book_fac_id,book_sport_id:book_sport_id,book_type:book_type,book_date:book_date,package_id:package_id,package_name:package_name,is_trial:is_trial},
				success:function(res){ 
					//alert(res);
					$("#ajax_side_view").html(res['_html']);
					checkTrialCheckout();
				}
			})
		}else{
			swal('Please select any slot'); 
		}		
	});
	
/* ******** remove items into cart here ************ */
	$(document).on("click",".removeItem",function() {
        var cart_id = $(this).find('.cart_id').val();   
        var cart_book_date = $(this).find('.cart_book_date').val(); 
        var book_date = $('#book_date').val();
        
        swal({
          text: 'Are you sure want to remove?',                  
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Remove'
        }).then((result)=> {
            if(result.value){
            $.ajax({
                type: 'POST',
                url: '<?=base_url();?>booking/remove_item_to_cart',
                data:{cart_id:cart_id},
                success:function(res){ 
                    $("#ajax_side_view").html(res['_html']);
					checkTrialCheckout();
                    if(book_date==cart_book_date){
                        //location.reload();
                        var slected_date = book_date;   
                        var book_fac_id = $('#book_fac_id').val();
                        var book_sport_id = $('#book_sport_id').val();
                        var book_type = $('#book_type').val();
                        //alert("click"+slected_date);
                        if(slected_date!=''){
                            $.ajax({
                                type: 'POST',
                                url: '<?=base_url();?>booking/slots_available_list',
                                data:{slected_date:slected_date,book_fac_id:book_fac_id,book_sport_id:book_sport_id,book_type:book_type},
                                success:function(res){  
                                    $("#ajax_slots_list").html(res['_html']);
									
                                }
                            })
                        }
                    }
                }
            })
        }
        })  
    });



    $( ".slot_port_id" ).change(function() {
    $( "#sport_form" ).submit();
});
</script>

</html>