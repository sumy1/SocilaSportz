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
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="EndDate" class="bmd-label-floating datepicker">End Date<span class="required">*</span></label>
                            <input type="text" data-format="d-m-Y" class="form-control" id="slotenddate1" data-large-mode="true" data-large-default="true"  value="<?php if($slot_details) echo date('d-m-Y',strtotime($slot_details->end_date));?>" readonly>
                            <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="startTime" class="bmd-label-floating datepicker">Start Time<span class="required">*</span></label>
                            <input type="text" class=" form-control" id="slotstarttime1" value="<?php if($slot_details) echo $slot_details->start_time;?>" readonly>
                            <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="EndTime" class="bmd-label-floating">End Time<span class="required">*</span></label>
                            <input type="text" class="form-control" id="slotendtime1" value="<?php if($slot_details) echo $slot_details->end_time;?>" readonly>
                            <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
                            <span id="errSlotendtime" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="Student" class="bmd-label-floating">Max. Student<span class="required">*</span></label>
                            <input type="text" class="form-control" id="max_participanets1" name="student" value="<?php if($slot_details) echo $slot_details->max_participanets;?>" onkeypress="validate(event)">  <i class="fa fa-sort-numeric-asc prefix"></i>

                            <span id="errStudent1" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group redtrial">
                            <label><input type="checkbox" id="is_trial" name="is_trial" class="trial" <?php if($slot_details->is_trial=='yes') echo "checked";?>> Is trial available ?</label>


                            <span id="errsTrial" class="error"> </span>
                        </div>
                    </div>





                    <div class="col-md-6">
                        <label for="days" class="bmd-label-floating" style="color:#000; margin-top: 20px;">Working Days<span class="required">*</span></label>
                        <ul class="weekoff">
                           <?php
                          /* $idArr=array();
                           foreach ($slot_week_days as $valIdes) {
                            $idArr[]=  $valIdes->batch_slot_weekoff_day;*/
                           
            foreach ($slot_week_days as $valIdes) { ?>
                      

                        <!-- foreach ($week_days as $week_day) { ?> -->
                        <li class="days">
                            <label class="radio-inline  btn btn-default active " id="normalradio">
                               <span class="bmd-radio"></span>
                                 <?=$valIdes->batch_slot_weekoff_day;?></label>
                            </li>
                            <?php  } ?>
                            <span id="errAcademy_day1" class="error"> </span>
                        </ul>

                    </div>




                </div>
            </div>
			
			<div class="row">
			             <div class="col-md-3 bmd-form-group  is-filled" style="    margin-left: 15px;">
                                    <label  class="bmd-label-floating">Status</label>
                                    <select id="fac_batch_slot_status" class="form-control" style="margin-left:7px;">
                                        <option value="active" <?php if($slot_details->fac_batch_slot_status=='active') echo "selected";?>>Active</option>
                                        <option value="inactive" <?php if($slot_details->fac_batch_slot_status=='inactive') echo "selected";?>>Inactive</option>
                                    </select> <i class="fa fa-list-alt prefix"></i> 
                                </div>
			</div>
			
            <div class="row" id="editacademyplan">


                <div class="col-md-3">
                    <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                        <label for="plan" class="bmd-label-floating">Select Plan<span class="required">*</span></label>
                        <select class="form-control" id="academybatchtypeedit">
                            <?php foreach ($batch_package as $batch_packages) { ?>
                            <option value="<?=$batch_packages->package_id;?>"><?=$batch_packages->package_name;?></option>
                            <?php  } ?>


                        </select>  <i class="fa fa-futbol-o prefix"></i>
                        <span id="errPlan" class="error"></span>    
                    </div>
                </div>




                <div class="col-md-2">
                    <div class="form-group bmd-form-group">
                        <label for="slotprice" class="bmd-label-floating">Price<span class="required">*</span></label>
                        <input type="text" class="form-control" id="academybatchpriceedit" onkeypress="validate(event)"> <i class="fa fa-rupee prefix"></i>

                        <span id="errsSlotprice" class="error"> </span>
                    </div>
                </div>

                <div class="col-md-2">
                    <a  class="btn btn-sm orange-btn planadd">Add<div class="ripple-container"></div></a>
                </div>
                <hr>
                <div id="academyplanwrapper" class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 titleheading" style="padding-left:0px; margin-top:10px;">
                            <div class="pull-left"><strong>Package Created</strong></div>

                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($batch_price_package as $batch_price_packages) { ?>
            <div class="rowparent">
                <div class="row">
                    <div class="col-sm-4 planname" style="padding-top:25px"><?=$batch_price_packages->package_name;?></div>
                    <div class="col-sm-4 planprice"><div class="form-group bmd-form-group is-filled is-focused">
                        <label for="slotprice" class="bmd-label-floating">Price</label>
                        <input type="hidden" name="package_id" class="package_id" value="<?=$batch_price_packages->package_id;?>">
                        <input type="text" name="package_price" id="" value="<?=$batch_price_packages->slot_package_price;?>" class="planpriceeditable form-control package_price" onkeypress="validate(event)">
                    </div>
                </div><div class="deletesection1">
                    <a href="javascript:void(0)" class="btn btn-raised btn_add_sm"><i class="fa fa-trash"></i>
                        <div class="ripple-container"></div>
                    </a></div><hr class="fullwidth">
                </div>
            </div>
            <?php } ?>



            <div class="col-md-12 text-right addslotwrapper">

                <ul class="list-inline business_detail_buttons">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed listproceed1" id="fac_batch_update">Save<div class="ripple-container"></div></a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>

<script>
    jQuery(".datepicker").dateDropper();
    $('#sport_id1').attr("disabled", true);

    $('#fac_batch_update').on("click",function(event) {
        var fac_id =$("#fac_id1 option:selected" ).val();
        var sport_id =$("#sport_id1 option:selected" ).val();
        var start_date= $("#slotstartdate1").val();
        var end_date= $("#slotenddate1").val();
        var start_time= $("#slotstarttime1").val();
        var end_time= $("#slotendtime1").val();
        var slotprice= $("#slotprice1").val();
        var fac_batch_slot_status= $("#fac_batch_slot_status").val();
        var max_participanets= $("#max_participanets1").val();
        var is_trial= $("#is_trial").val();
        var batch_slot_id = '<?php echo $slot_details->batch_slot_id;?>';
        var checkedlength   =$('input[name="day[]"]:checked').length;
//alert(max_participanets);
if(max_participanets == ''){
        $('#errStudent1').show();
        $('#errStudent1').html('Please enter participants no.');

        return false;
    }
    else{
        $('#errStudent1').html('');
    }

    if(max_participanets == 0){
        $('#errStudent1').show();
        $('#errStudent1').html('Please enter valid participants no.');

        return false;
    }
    else{
        $('#errStudent1').html('');
    }

/*if(checkedlength == 0){
        $('#errAcademy_day1').show();
        $('#errAcademy_day1').html('Please select atleast one Working day');

        return false;
    }
    else{
        $('#errAcademy_day1').html('');
    }*/

/*var week_day=[];
$(".week_days:checked").each(function() {
    week_day.push($(this).val());
});
var week_days = week_day.join(',');*/

var packages_price=[];
$(".package_price").each(function() {
    packages_price.push($(this).val());
});
var package_price = packages_price.join(',');

var package_id=[];
$(".package_id").each(function() {
    package_id.push($(this).val());
});
var packages_id = package_id.join(',');
//alert(week_days);

action = 'batch_slot_update';
$.ajax({
    url:'<?php echo base_url();?>facility/slot/update_batch',
    type: 'POST',
    data: {action:action,fac_id,fac_id,sport_id:sport_id,start_date:start_date,end_date:end_date,start_time:start_time,end_time:end_time,package_price:package_price,packages_id:packages_id,max_participanets:max_participanets,batch_slot_id:batch_slot_id,is_trial:is_trial,fac_batch_slot_status:fac_batch_slot_status},

    success:function(res){
//alert(res); return false;
if(res!='failed'){
    swal({
        title : 'Slot updated successfully!',
        html : '',
        type: 'success'
    }).then((result) => {
        if (result.value) {
            $('#editslot').modal('hide');
            $('#batchlistingdata').trigger('click'); 
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
    jQuery('.timeclock').off().timeDropper();



    jQuery(".planadd").on("click", function(e){
        jQuery("#academyplanwrapper .titleheading").show();
        var cdf = jQuery("#editacademyplan").find("#academybatchtypeedit option:selected").val();
        var package_text = jQuery("#editacademyplan").find("#academybatchtypeedit option:selected").text();
        var package_id = jQuery("#editacademyplan").find("#academybatchtypeedit option:selected").val();
        var abc = jQuery("#academybatchpriceedit").val(); jQuery('<div class="rowparent"><div class="row"><div class="col-sm-4 planname" style="padding-top:25px">'+package_text+'</div><div class="col-sm-4 planprice"><div class="form-group bmd-form-group is-filled is-focused"><label for="slotprice" class="bmd-label-floating">Price</label><input type="hidden" name="package_id" class="package_id" value="'+package_id+'"><input type="text" value="'+abc+'" class="planpriceeditable form-control package_price"></div></div><div class="deletesection1"><a href="javascript:void(0)" class="btn btn-raised btn_add_sm"><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div><hr class="fullwidth"></div></div>').insertAfter("#editacademyplan");
        jQuery("#academybatchtypeedit option:first-child").prop('selected', true); jQuery("#academybatchpriceedit").val('');

    }); 

    jQuery(document).on("click", '.deletesection1', function(){jQuery(this).parents(".rowparent").remove()});  


    jQuery("#slotfacility input.datepicker").each(function(){var cdf = jQuery(this).attr("value"); jQuery(this).val(cdf)});
    jQuery("#slotfacility input.timeclock").each(function(){var cdf = jQuery(this).attr("value"); jQuery(this).val(cdf)}); 
 
</script>

