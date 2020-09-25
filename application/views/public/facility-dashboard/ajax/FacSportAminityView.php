<div class="row">
    <div class="col-md-6">
        <div class="cus_modal profile_modal">
            <div class="cus_modal_header clearfix">
                <h5 class="title"> <a class="toggle"> <i class="fa fa-futbol-o"></i> Sports Details</h5></div>
                    <div class="collapse show" id="collapseExample7">
                       <?php if (isset($sport_list) && !empty($sport_list)){
                          foreach ($sport_list as $sport_lists) { ?>
                          <div class="cus_modal_body">          			

                            <div class="details_box">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="contain_data sports-details row">
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">Sports Name</h4>
                                                <p class="detail_item"><?=$sport_lists->sport_name;?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">No. of Court/Ground</h4>
                                                <p class="detail_item"><?=$sport_lists->sport_court;?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">No. of Indoor</h4>
                                                <p class="detail_item"><?=$sport_lists->sport_indor;?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">No. of Outdoor</h4>
                                                <p class="detail_item"><?=$sport_lists->sport_outdor;?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <a href="javascript:void(0)" class="edit_btn sport_edit_btn" id="sport_edit_btn" data-toggle="modal" data-target="#sports_edit"><span>Edit</span> <i class="fa fa-pencil-square-o"></i><input type="hidden" id="fac_sport_id" value="<?=$sport_lists->fac_sport_id;?>"></a></div>

                            <?php }
                        }else{ ?>


                            <div class="cus_modal_body">                    

                            <div class="details_box">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="contain_data sports-details row">
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">Sports Name</h4>
                                                <p class="detail_item"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">No. of Court/Ground</h4>
                                                <p class="detail_item"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">No. of Indoor</h4>
                                                <p class="detail_item"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="display-4 heading_item">No. of Outdoor</h4>
                                                <p class="detail_item"></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> </div>
                       <?php }

                         ?>


                    </div>
                </div>

 <div class="col-sm-12 text-right"><?php if($fac_count>0){ ?><a class="btn btn-info orange-btn" data-toggle="modal" data-target="#sports_add">Add Sports</a><?php } ?></div>
            </div>
                <div class="col-md-6">
                    <div class="cus_modal profile_modal">
                        <div class="cus_modal_header clearfix">
                            <h5 class="title"> <a class="toggle"> <i class="fa fa-file-text"></i> Amenities Detail </a></h5></div>
                            <div class="collapse show" id="collapseExample1-1">
                                <div class="cus_modal_body">
                                    <div class="details_box">
                                        <div class="row">

                                           <?php if (isset($aminity_list) && $aminity_list!=''){
                                              foreach ($aminity_list as $aminity_lists) { ?>
                                              <div class="col-md-6">
                                                <div class="contain_data single-amineties"> <img class="ui right spaced image" src="<?=base_url('assets/public/images/amenity/'.$aminity_lists->amenity_icon)?>">
                                                    <p class="detail_item"><?=$aminity_lists->amenity_name;?></p>
                                                </div>
                                            </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div> <a href="javascript:void(0)" class="edit_btn aminity_edit_btn" data-toggle="modal" data-target="#amenities_edit"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a></div>
                            </div>
                        </div>
                       
                    </div>
                </div>





                <div class="modal fade modal_default view_deal edit_profile_modal" id="sports_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">             
                            <div class="modal-header">
                                <h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit your Sports Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="Fac_Sport_div"></div>
                        </div>
                    </div>
                </div>


                <div class="modal fade modal_default view_deal edit_profile_modal" id="sports_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">             
                            <div class="modal-header">
                                <h5 class="modal-title pl-3" id="exampleModalLongTitle">Add your Sports Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="" class="sm_inputs">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group bmd-form-group bmd-form-grounp-sm is-filled" style="margin-top: 5px;">
                                                    <label for="sportsname" class="bmd-label-floating">Select Sports</label>
                                                    <select class="form-control" id="sportsname" name="sportsname" >
                                                        <option value="">Select Sports</option>
                                                        <?php if (isset($sport_master) && $sport_master!=''){
                                                            foreach ($sport_master as $sports_master) { ?>
                                                            <option class="abc" value="<?=$sports_master->sport_id;?>"><?=$sports_master->sport_name;?></option>
                                                            <?php } } ?>

                                                        </select>  <img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
										<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">
														<span id="errGame" class="error"></span>    
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group bmd-form-grounp-sm">
                                                        <label for="city" class="bmd-label-floating">No. of Court/Ground</label>
                                                        <input type="text" class="form-control" id="courtnumber"><i class="fa fa-sort-numeric-asc prefix"></i>
                                                        <span id="errnucourts" class="error"></span>
                                                    </div>
                                                </div>                                          
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group bmd-form-grounp-sm">
                                                        <label for="Area" class="bmd-label-floating">No. of Indoor</label>
                                                        <input type="text" class="form-control" id="kitquantity2" name="kitquantity2">
                                                            
                                                        <i class="fa fa-sort-numeric-asc prefix"></i>
                                                        <span id="errIndorcourts" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group bmd-form-grounp-sm">
                                                        <label for="confirmPassword" class="bmd-label-floating">No. of Outdoor</label>
                                                        <input type="text" class="form-control" id="kitquantityoutdoor">
                                                            
                                                        <i class="fa fa-sort-numeric-asc prefix"></i>
                                                        <span id="errOutdorcourts" class="error"></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="add_fac_sport"> Add Sport</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade modal_default view_deal edit_profile_modal" id="amenities_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">             
                                <div class="modal-header">
                                    <h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Amenities</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="amenity_edit_div"></div>
                            </div>
                        </div>
                    </div>

                    <script>

                        $('.sport_edit_btn').click(function() {
                            var fac_sport_id  = $(this).find('#fac_sport_id').val();
							showingLoader();
                            $.ajax({
                                type: "POST",
            //async: true,
            url:'<?php echo base_url();?>dashboard/sport_edit_form',  
            data: {fac_sport_id:fac_sport_id},
            success:function(res){
				hiddingLoader();
                $("#Fac_Sport_div").html(res['_html']);
            }   
        });

                        });

                        $('.aminity_edit_btn').click(function() {
                            $.ajax({
                                type: "POST",
            //async: true,
            url:'<?php echo base_url();?>dashboard/aminity_edit_form',  
            data: {},
            success:function(res){
                $("#amenity_edit_div").html(res['_html']);
            }   
        });

                        });


    $('#add_fac_sport').on('click', function(e) {
    var sports_id =$("#sportsname option:selected" ).val();
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var courtnumber =$("#courtnumber" ).val();
    var indor_qty =$("#kitquantity2" ).val();
    indor_qty=(indor_qty==''?0:indor_qty);
    var outdor_qty =$("#kitquantityoutdoor" ).val();
    outdor_qty=(outdor_qty==''?0:outdor_qty);
   // var sport_court_id = $('#sport_court_id').val();
    var result = parseInt(indor_qty) + parseInt(outdor_qty);
   // alert(outdor_qty); return false;
    
    if(fac_id == 0)
    {
        $('#errFacname').html('Please Select Facility / Academy');
        return false;
    }

    else
    {
        $('#errFacname').html('');  
    }

    if(sports_id == 0)
    {
        $('#errGame').html('Please Select sports');
        return false;
    }

    else
    {
        $('#errGame').html(''); 
    }

    if(courtnumber == 0)
    {
        $('#errnucourts').html('Please Select court');
        return false;
    }

    else
    {
        $('#errnucourts').html(''); 
    }

    if(courtnumber!= result)
    {
        $('#errIndorcourts').html('Sum of indor and outdor court must be equal to the total no of courts');
        return false;
    }

    else
    {
        $('#errIndorcourts').html('');  
    }


    $.ajax({
        type: "POST",
        url:'<?php echo base_url();?>dashboard/add_fac_sport', 
        data: {sports_id:sports_id,fac_id:fac_id,courtnumber:courtnumber,indor_qty:indor_qty,outdor_qty:outdor_qty},
        success:function(res){
            
            if(res!='failed'){

                    swal({
              title : 'Sport added successfully!',
              html : '',
              type: 'success'
            }).then((result) => {
              if (result.value) {
                  jQuery("#tab4-tab").trigger("click");
                $("#sportsname option:selected").prop('selected' , false);
                $("#courtnumber").prop('selected' , false);
                $("#kitquantity2").prop('selected' , false);
                $("#kitquantityoutdoor").prop('selected' , false);
                /*$('#indoorkitprice').val(''); 
                $('#outdoorkitprice').val('');
                $('#indorkitcheckbox').prop('checked', false);
                $('#outdorkitcheckbox').prop('checked', false);*/
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



    /* $("select").on("change", function(){$(this).find("option:selected").prop("disabled", true)});*/               
					</script>

                    <script>
$('#sportsname').on('change', function() {
var fac_id = $("#headeracademyfacility option:selected").val();   
var sport_id = $("#sportsname option:selected").val(); 
if(fac_id!=''){ 
  $.ajax({
type:'post',
url:'<?=base_url('dashboard/check_sport_name');?>',
data:{fac_id:fac_id,sport_id:sport_id},
success: function(data){
 if(data == 1){
 $('#errGame').html("Sport name alredy exist");
 $("#add_fac_sport").css("pointer-events","none");
}
else{
 $('#errGame').html("");
 $("#add_fac_sport").css("pointer-events","auto");
}
}
 });
    }
});



</script>
