 <div class="modal-body">
    <div class="container-fluid">
    <form action="" class="sm_inputs">
    <div class="row" style="position:relative;">
        <div class="ui four column doubling  grid">
            <?php
            $idArr=array();
            foreach ($user_amenity as $valIdes) { $idArr[]=  $valIdes->amenity_id;
            }
          

                foreach ($amenity_list as $amenities) { ?>
                      <div class="column">
                <div class="ui large label amenity">
                    <input class="checkbox myCheck" type="checkbox"  name="amenities" id="" value="<?=$amenities->amenity_id;?>" <?php if(in_array($amenities->amenity_id, $idArr)){echo "checked";} ?>>
                    <img class="ui right spaced image" src="<?=base_url('assets/public/images/amenity/'.$amenities->amenity_icon);?>"><span><?=$amenities->amenity_name;?></span>
                </div>
            </div>
                 <?php }
             ?>
            
            
        </div>
        <span id="erramenity" class="error"></span> 
    </div>
    </form>
    <div class="row">
    <div class="col-md-12 text-center">
        <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successAmenitiesUpdatebtn"> Update</a>
    </div>
    </div>

    </div>
    </div>


    <script>
    	
$('#successAmenitiesUpdatebtn').click(function(event) {

	var amenity_id=[];
    $(".myCheck:checked").each(function() {
        amenity_id.push($(this).val());
    });
    var amenity_ids = amenity_id.join(',') ;
//alert(amenity_ids);
    if(amenity_ids == '')
    {
        $('#erramenity').html('Please Select atleast one Amenity');
        return false;
    }

    else
    {
        $('#erramenity').html('');  
    }
	action='amenity_edit';
	showingLoader();

	$.ajax({
				type: "POST",
				url:'<?php echo base_url();?>dashboard/update_fac_info',	
				data: {amenity_ids:amenity_ids,action:action},
				success:function(res){
				//alert(res); return false;
				if(res!='failed'){
					 hiddingLoader();
					swal({
					title : 'Amenities updated successfully',
					html : '',
					type: 'success'
					}).then((result) => {
					if (result.value) {
					$('#amenities_edit').modal('hide');
                    $('#tab4-tab').trigger('click'); 
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

    </script>