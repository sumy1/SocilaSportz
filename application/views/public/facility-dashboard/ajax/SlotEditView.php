<div class="modal-body">
    <form class="edit_slot_form" id="edit_slot_form" name="edit_slot_form">
        <div id="slotfacility" class="tab-pane fade in active">

            <div class="row">
               

                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                        <label for="Facility" class="bmd-label-floating">Facility Name<span class="required">*</span></label>
                        <select class="form-control" id="fac_id1">
                            <option value="<?=$fac_id;?>"><?=$fac_name;?></option>
                        </select>   
                        <i class="fa fa-university prefix"></i>
                        <span id="errFacility" class="error"></span>  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                        <label for="Sports" class="bmd-label-floating">Select Sports<span class="required">*</span></label>
                        <select class="form-control" id="sport_id1">
                            <?php foreach ($fac_sports as $fac_sport) { ?>
                               <option <?php if($slot_details->sport_id==$fac_sport->sport_id) echo "selected";?> value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
                          <?php   } ?>
                           
                          
                        </select> 	
<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
										<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">
						
                        <span id="errGender" class="error"></span>  
                    </div>
                </div>
            </div>


            <div class="slotreplica">


                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="StartDate" class="bmd-label-floating datepicker">Start Date<span class="required">*</span></label>
                            <input type="text"  data-format="d-m-Y"  class="form-control" id="slotstartdate1" data-large-mode="true" data-large-default="true" value="<?php if($slot_details) echo date('d-m-Y',strtotime($slot_details->start_date));?>" readonly>
                            <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                            <span id="errslotstartdates" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="EndDate" class="bmd-label-floating datepicker">End Date<span class="required">*</span></label>
                            <input type="text" data-format="d-m-Y" class="form-control" id="slotenddate1" data-large-mode="true" data-large-default="true"  value="<?php if($slot_details) echo date('d-m-Y',strtotime($slot_details->end_date));?>" readonly>
                            <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                            <span id="errSlotenddate" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="startTime" class="bmd-label-floating datepicker">Start Time<span class="required">*</span></label>
                            <input type="text" class="form-control" id="slotstarttime1" value="<?php if($slot_details) echo $slot_details->start_time;?>" readonly>
                            <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="EndTime" class="bmd-label-floating">End Time<span class="required">*</span></label>
                            <input type="text" class="form-control " id="slotendtime1" value="<?php if($slot_details) echo $slot_details->end_time;?>" readonly>
                            <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
                            <span id="errSlotendtime" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-3 bmd-form-group is-filled" style="margin-top: 5px; margin-left:12px;">
                        <label for="categories" class="bmd-label-floating">Categories<span class="required">*</span></label>

                        <select class="form-control datelist" style="margin-left:7px;" id="label_name1">
                           <?php foreach ($batch_slot_type as $value) { ?>
                               <option <?php if($slot_details->batch_slot_type_id==$value->batch_slot_type_id) echo "selected";?> value="<?=$value->batch_slot_type_id;?>"><?=$value->batch_slot_type;?></option>
                          <?php  } ?>
                           
                            

                        </select>   <i class="fa fa-list-alt prefix"></i>
                        <span id="errLabel" class="error"></span>  
                    </div>


                    <div class="col-md-6">
                        <label for="days" class="bmd-label-floating" style="color:#000; margin-top: 20px;">Working Days</label>
                        <ul class="weekoff">
                             <?php
            foreach ($slot_week_days as $valIdes) { ?>
                            <li class="days">
                            <label class="radio-inline  btn btn-default active" id="normalradio">
                                   <span class="bmd-radio"></span>
                                <?=$valIdes->batch_slot_weekoff_day;?></label>
                            </li>
                       <?php  } ?>
                            <span id="errfac_day1" class="error"> </span>
                        </ul>

                    </div>

                    <div class="col-md-3">
                                    <div class="panel-heading12">
                                        <input type="checkbox" id="sl_kit1" name="kit_aval" class="checkboxenable sl_kit" <?php if($slot_details->is_kit_available=='yes') echo "checked";?>> Is kit Available ?

                                    
                                    </div>
                                </div>
                                   <div class="col-md-9" style="margin-top:20px;" >
                                <div class="col-md-4 priceforavaialable" >
                                    <div class="form-group bmd-form-group" style="margin-top:-24px">
                                        <label for="kit" class="bmd-label-floating">Price/Day</label>
                                        <i class="fa fa-rupee prefix"></i>
                                        <input type="text" class="form-control sl_kitprice" id="kitprice1" name="" onkeypress="validate(event)" value="<?php if($slot_details) echo $slot_details->kit_price;?>">
                                        <span id="errkit_price1" class="error"> </span>
                                    </div>
                                </div></div>


                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="slotprice" class="bmd-label-floating">Slot/Batch Price<span class="required">*</span></label>
                            <input type="text" class="form-control" id="slotprice1" value="<?php if($slot_price) echo $slot_price->slot_package_price;?>" onkeypress="validate(event)">  <i class="fa fa-rupee prefix"></i>

                            <span id="errsSlotprice" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-2 nopadleft nopadright">
                        <div class="form-group bmd-form-group">
                            <label for="facilityname1" class="bmd-label-floating">Max. Participants<span class="required">*</span></label>
                            <input type="text" class="form-control" id="max_participanets1" value="<?php if($slot_details) echo $slot_details->max_participanets;?>" onkeypress="validate(event)"> <i class="fa fa-sort-numeric-asc prefix"></i>

                            <span id="errmax_participanets1" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-3 bmd-form-group is-filled" style="margin-top: 5px; margin-left: 15px;">
                                    <label for="court_type" class="bmd-label-floating">Court Type</label>

                                    <select class="form-control datelist" name="" id="court_type1" style="margin-left:7px;">start_time
                                        <option value="indoor" <?php if($slot_details->court_type=='indoor') echo "selected";?>>Indoor</option>
                                        <option value="outdoor" <?php if($slot_details->court_type=='outdoor') echo "selected";?>>Outdoor</option>

                                    </select>   <i class="fa fa-list-alt prefix"></i> 
                                </div>
								
								  <div class="col-md-3 bmd-form-group nopadleft nopadright is-filled" style="    margin-left: -15px;">
                                    <label  class="bmd-label-floating">Status</label>
                                    <select id="fac_batch_slot_status" class="form-control" style="margin-left:7px;">
                                        <option value="active" <?php if($slot_details->fac_batch_slot_status=='active') echo "selected";?>>Active</option>
                                        <option value="inactive" <?php if($slot_details->fac_batch_slot_status=='inactive') echo "selected";?>>Inactive</option>
                                    </select> <i class="fa fa-list-alt prefix"></i> 
                                </div>

                                <div class="col-md-12 nopadleft nopadright">
                                    <div class="form-group bmd-form-group" style="margin-right: 25px;">
                                        <label for="court_desc" class="bmd-label-floating">Court Description<span class="required">*</span></label>
                                        <input type="text" class="form-control sl_desc" id="court_desc1" value="<?php if($slot_details) echo $slot_details->court_description;?>">    <i class="fa fa-list-alt prefix"></i>
                                        <span id="errFacilityname1" class="error"> </span>
                                    </div>
                                </div>

                              
                </div>
            </div>
            <div class="col-md-12 text-right addslotwrapper">

                <ul class="list-inline business_detail_buttons">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed listproceed1" id="fac_slot_update">Save<div class="ripple-container"></div></a>
                    </li>
                </ul>
            </div>
        </div>
        </form>
        </div>

        <script>
                jQuery(".datepicker").dateDropper();
                $('#sport_id1').attr("disabled", true);


                $('#fac_slot_update').on("click",function(event) {
                    var fac_id =$("#fac_id1 option:selected" ).val();
                    var sport_id =$("#sport_id1 option:selected" ).val();
                    var batch_slot_type_id =$("#label_name1 option:selected" ).val();
                    var start_date= $("#slotstartdate1").val();
                    var end_date= $("#slotenddate1").val();
                    var start_time= $("#slotstarttime1").val();
                    var end_time= $("#slotendtime1").val();
                    var court_type= $("#court_type1").val();
                    var court_desc= $("#court_desc1").val();
                    var slotprice= $("#slotprice1").val();
                    var kit_price= $("#kitprice1").val();
                    var sl_kit_checked = $("#sl_kit1").prop("checked");
                    var max_participanets= $("#max_participanets1").val();
                    var fac_batch_slot_status= $("#fac_batch_slot_status").val();
                    var batch_slot_id = '<?php echo $slot_details->batch_slot_id;?>';
                    var checkedlength = $('input[name="day[]"]:checked').length;
            


/*     jQuery(".weekoff .days").each(function(){var cdf = jQuery(this).find("label.active").parent(".days").addClass("checked1"); jQuery(".days.checked1").each(function(){
 week_day.push( jQuery(this).find("input").val(););
    var week_days = week_day.join(',') ;
alert(week_days);
          });*/

          /*if(checkedlength == 0){
           
        $('#errfac_day1').show();
        $('#errfac_day1').html('Please select atleast one Working day');
        return false;
    }
    else{
        $('#errfac_day1').html('');
    }*/
	 if(sl_kit_checked == true && kit_price == ''){
            
        $('#kitprice1').focus();
        $('#errkit_price1').html('Please enter kit price');
        return false;
    }
    else{
        $('#errkit_price1').html('');
    }
	
	
	var endateArr = [];
	var startateArr = [];
	endateArr = end_date.split('-');
	startateArr = start_date.split('-');
	

	
	
	   
	   if(parseInt(endateArr[2]) >= parseInt(startateArr[2])){
		$('#errSlotenddate').html("");
		if((parseInt(endateArr[1]) >= parseInt(startateArr[1])) ||(parseInt(endateArr[2]) > parseInt(startateArr[2]))){
			$('#errSlotenddate').html("");
			if((parseInt(endateArr[0]) >= parseInt(startateArr[0])) || (parseInt(endateArr[1]) > parseInt(startateArr[1])) || (parseInt(endateArr[2]) > parseInt(startateArr[2]))){
				$('#errSlotenddate').html("");
			}else{
				$('#errSlotenddate').show();
				$('#errSlotenddate').html("End date should be greater than start date");
				$('html,body').animate({scrollTop: $("#errSlotenddate").offset().top - 120},'slow');
				return false;
			}	
			
		}else{
			$('#errSlotenddate').show();
			$('#errSlotenddate').html("End date should be greater than start date");
			$('html,body').animate({scrollTop: $("#errSlotenddate").offset().top - 120},'slow');
			return false;
		}	
	}else{
		$('#errSlotenddate').show();
		$('#errSlotenddate').html("End date should be greater than start date");
		$('html,body').animate({scrollTop: $("#errSlotenddate").offset().top - 120},'slow');
		return false;
	}
	
	
	
	
	
	

        if(slotprice == ''){
        $('#slotprice1').show();
        $('#errsSlotprice').html('Please enter price');
        return false;
    }
    else{
        $('#errsSlotprice').html('');
    }

    if(max_participanets == ''){
        $('#max_participanets1').show();
        $('#errmax_participanets1').html('Please enter participants no.');
        return false;
    }
    else{
        $('#errmax_participanets1').html('');
    }

     if(max_participanets == 0){
        $('#max_participanets1').show();
        $('#errmax_participanets1').html('Please enter valid participants no.');
        return false;
    }
    else{
        $('#errmax_participanets1').html('');
    }

             

               var week_day=[];
    $(".week_days:checked").each(function() {
        week_day.push($(this).val());
    });
    var week_days = week_day.join(',') ;
//alert(week_days);

                    action = 'fac_slot_update';
					showingLoader();
                $.ajax({
                url:'<?php echo base_url();?>facility/slot/update_slot',
                type: 'POST',
                data: {action:action,fac_id,fac_id,sport_id:sport_id,batch_slot_type_id:batch_slot_type_id,start_date:start_date,end_date:end_date,start_time:start_time,end_time:end_time,slotprice:slotprice,max_participanets:max_participanets,batch_slot_id:batch_slot_id,court_type:court_type,court_desc:court_desc,kit_price:kit_price,fac_batch_slot_status:fac_batch_slot_status,sl_kit_checked:sl_kit_checked},
               
                success:function(res){
                //alert(res); return false;
                if(res!='failed'){
					hiddingLoader();
                swal({
                title : 'Slot updated successfully',
                html : '',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                $('#editslot').modal('hide');
                $('#slotlistingdata').trigger('click'); 
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

         jQuery(".datepicker").off().dateDropper();
      jQuery('.timeclock').off().timeDropper({
										setCurrentTime: false
									});

      jQuery("#slotfacility input.datepicker").each(function(){var cdf = jQuery(this).attr("value"); jQuery(this).val(cdf)});
jQuery("#slotfacility input.timeclock").each(function(){var cdf = jQuery(this).attr("value"); jQuery(this).val(cdf)});

if(jQuery("#kitprice1").val()!=''){
jQuery(".priceforavaialable").show();
}

        </script>

