<div class="modal-body">
    <form class="edit_slot_form" id="edit_slot_form" name="edit_slot_form">
        <div id="slotfacility" class="tab-pane fade in active">

            <div class="row">
                <div class="col-sm-12 titleheading">
                    <div class="pull-left"><strong>Edit Slot</strong></div>

                </div>

                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                        <label for="Facility" class="bmd-label-floating">Facility Name</label>
                        <select class="form-control" id="fac_id1">
                            <option value="<?=$fac_id;?>"><?=$fac_name;?></option>
                        </select>   
                        <i class="fa fa-university prefix"></i>
                        <span id="errFacility" class="error"></span>  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                        <label for="Sports" class="bmd-label-floating">Select Sports</label>
                        <select class="form-control" id="sport_id1">
                            <?php foreach ($fac_sports as $fac_sport) { ?>
                               <option <?php if($slot_details->sport_id==$fac_sport->sport_id) echo "selected";?> value="<?=$fac_sport->sport_id;?>"><?=$fac_sport->sport_name;?></option>
                          <?php   } ?>
                           
                          
                        </select>   <i class="fa fa-futbol-o prefix"></i>
                        <span id="errGender" class="error"></span>  
                    </div>
                </div>
            </div>


            <div class="slotreplica">


                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="StartDate" class="bmd-label-floating datepicker">Start Date</label>
                            <input type="text"  data-format="d-m-Y"  class="form-control datepicker" id="slotstartdate1" data-large-mode="true" data-large-default="true" value="<?php if($slot_details) echo $slot_details->start_date;?>">
                            <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="EndDate" class="bmd-label-floating datepicker">End Date</label>
                            <input type="text" data-format="d-m-Y" class="form-control datepicker" id="slotenddate1" data-large-mode="true" data-large-default="true"  value="<?php if($slot_details) echo $slot_details->end_date;?>">
                            <i class="fa fa-calendar prefix" aria-hidden="true"></i>
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="startTime" class="bmd-label-floating datepicker">Start Time</label>
                            <input type="text" class="timeclock form-control" id="slotstarttime1" value="<?php if($slot_details) echo $slot_details->start_time;?>">
                            <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
                            <span id="errSlotstarttime" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="EndTime" class="bmd-label-floating">End Time</label>
                            <input type="text" class="form-control timeclock" id="slotendtime1" value="<?php if($slot_details) echo $slot_details->end_time;?>">
                            <i class="fa fa-clock-o prefix" aria-hidden="true"></i>
                            <span id="errSlotendtime" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-4 bmd-form-group is-filled" style="margin-top: 5px;">
                        <label for="categories" class="bmd-label-floating">Categories</label>

                        <select class="form-control datelist" style="margin-left:7px;" id="label_name1">
                           <?php foreach ($batch_slot_type as $value) { ?>
                               <option <?php if($slot_details->batch_slot_type_id==$value->batch_slot_type_id) echo "selected";?> value="<?=$value->batch_slot_type_id;?>"><?=$value->batch_slot_type;?></option>
                          <?php  } ?>
                           
                            

                        </select>   <i class="fa fa-list-alt prefix"></i>
                        <span id="errLabel" class="error"></span>  
                    </div>


                    <div class="col-md-5">
                        <label for="days" class="bmd-label-floating" style="color:#000; margin-top: 20px;">Working Days</label>
                        <ul class="weekoff">
                             <?php
                             $idArr=array();
            foreach ($slot_week_days as $valIdes) {
             $idArr[]=  $valIdes->batch_slot_weekoff_day;
            }

                              foreach ($week_days as $week_day) { ?>
                            <li class="days">
                                <label class="radio-inline  btn btn-default <?php if(in_array($week_day->day, $idArr)){echo "active";} ?> " id="normalradio">
                                    <input type="checkbox" <?php if(in_array($week_day->day, $idArr)){echo "checked";} ?> class="week_days" name="day[]" value="<?=$week_day->day;?>"><span class="bmd-radio"></span>
                                <?=$week_day->day;?></label>
                            </li>
                            <?php  } ?>
                        </ul>

                    </div>


                    <div class="col-md-2">
                        <div class="form-group bmd-form-group">
                            <label for="slotprice" class="bmd-label-floating">Price</label>
                            <input type="text" class="form-control" id="slotprice1" value="100">  <i class="fa fa-rupee prefix"></i>

                            <span id="errsSlotprice" class="error"> </span>
                        </div>
                    </div>
                    <div class="col-md-2 nopadleft nopadright">
                        <div class="form-group bmd-form-group">
                            <label for="facilityname1" class="bmd-label-floating">Max. Participants</label>
                            <input type="text" class="form-control" id="max_participanets1" value="<?php if($slot_details) echo $slot_details->max_participanets;?>"> <i class="fa fa-sort-numeric-asc prefix"></i>

                            <span id="errFacilityname1" class="error"> </span>
                        </div>
                    </div>
                </div>
            </div>
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


                $('#fac_batch_update').on("click",function(event) {
                    var fac_id =$("#fac_id1 option:selected" ).val();
                    var sport_id =$("#sport_id1 option:selected" ).val();
                    var batch_slot_type_id =$("#label_name1 option:selected" ).val();
                    var start_date= $("#slotstartdate1").val();
                    var end_date= $("#slotenddate1").val();
                    var start_time= $("#slotstarttime1").val();
                    var end_time= $("#slotendtime1").val();
                    var slotprice= $("#slotprice1").val();
                    var max_participanets= $("#max_participanets1").val();
                    var batch_slot_id = '<?php echo $slot_details->batch_slot_id;?>';

             

               var week_day=[];
    $(".week_days:checked").each(function() {
        week_day.push($(this).val());
    });
    var week_days = week_day.join(',') ;
//alert(week_days);

                    action = 'fac_slot_update';
                $.ajax({
                url:'<?php echo base_url();?>facility/slot/update_batch',
                type: 'POST',
                data: {action:action,fac_id,fac_id,sport_id:sport_id,batch_slot_type_id:batch_slot_type_id,start_date:start_date,end_date:end_date,start_time:start_time,end_time:end_time,slotprice:slotprice,max_participanets:max_participanets,week_days:week_days,batch_slot_id:batch_slot_id},
               
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
      jQuery('.timeclock').off().timeDropper();
        </script>

