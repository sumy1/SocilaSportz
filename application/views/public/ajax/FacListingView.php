<style>
#popupevent1 .modal-body
{
	overflow: auto;
	height: 300px;
}
</style>

<?php if (isset($fac_details) && !empty($fac_details)) { $i=0;
	foreach ($fac_details as $fac_detail) { $i++ ;

		//Timing details
		$whr = array('fac_id'=>$fac_detail->fac_id);
		$fac_timings = $this->CommonMdl->getResultByCond('tbl_facility_timing',$whr,'day,open_time,close_time',$order_by='');
		//print_data($fac_timing);

		?>

		<div class="single-facility-listing" id="fac_div_<?=$fac_detail->fac_id?>">
			<!-- <h3>Facility</h3> -->
			<div class="col-sm-4">
				<!-- <div class="listingbannerlogo listingbannerlogo align-items-center d-flex"><img src="<?=base_url();?>assets/public/images/fac/<?=$fac_detail->fac_logo_image;?>" alt=""></div> -->
				<img src="<?=base_url();?>assets/public/images/fac/<?=$fac_detail->fac_banner_image;?>">
			</div>
			<div class="col-sm-8">
				<div class="facility-cont">
					<h4><span class="labelheading"><?php if($fac_detail->fac_type=='facility') echo 'Facility Name:'; else echo 'Academy Name:';?></span> <?=$fac_detail->fac_name;?></h4>
					<div class="mainrow row">
					<div class="col-sm-12 nopadleft nopadright">	
					<span class="labelheading">City: </span> <span class="labelheading2"><?=$fac_detail->fac_city;?></span><br>
				    </div>
                    
                    <div class="col-sm-12 nopadleft nopadright">
					<span class="labelheading">Area:</span> <span class="labelheading2"><?=$fac_detail->fac_address;?></span>
				    </div>
				    <div class="col-sm-12 nopadleft nopadright">
					<span class="labelheading">Pincode:</span> <span class="labelheading2"><?=$fac_detail->fac_pincode;?></span>
				</div>
				</div>
					<br>	
					<div class="col-md-6">
						<div class="form-group bmd-form-group bmd-form-group-sm" id="defaulttimingcontainer">
							<div class="editbox1">
								<label for="timing" class="bmd-label-floating">Open/Close Timing</label>
								<select class="form-control" id="mySelect_data">
									<?php
									if (isset($fac_timings) && $fac_timings!='') {
										foreach ($fac_timings as $fac_timing) { ?>
											<option><?=$fac_timing->day.' : '. $fac_timing->open_time.' to '.$fac_timing->close_time; ?> </option>
										<?php  } } ?>
									</select>	<i class="fa fa-clock-o prefix" aria-hidden="true"></i>

								</div>

							</div>
						</div>

						<p><span class="labelheading">About <?php if($fac_detail->fac_type=='facility') echo 'Facility'; else echo 'Academy';?></span><br><?php echo substr($fac_detail->fac_description,0,250);?><br> <a href="javascript:void(0)" class="rm" data-toggle="modal" data-target="#popupevent<?=$i?>">
							<?php if(strlen($fac_detail->fac_description)>250){echo "Read More...";} ?></a>
						</p>
					</div>
					<a class="edit editacademyfacility"  href="#facility">
						<div class="edit-btn">Edit <i class="fa fa-pencil-square-o"></i>
						</div>
						<input type="hidden" name="edit_fac_id" id="edit_fac_id" value="<?=$fac_detail->fac_id;?>">
					</a>

					<a class="edit deleteacademyfacility" >
						<input type="hidden" name="delete_fac_id" id="delete_fac_id" value="<?=$fac_detail->fac_id;?>"><input type="hidden" id="fac_name" value="<?=$fac_detail->fac_name;?>">
						<div class="edit-btn">Delete <i class="fa fa-trash "></i>
						</div>
					</a>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade modal_default view_deal edit_profile_modal " id="popupevent<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg descriptionoverflow" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title pl-3" id="exampleModalLongTitle"><?=$fac_detail->fac_name;?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">×</span>
							</button>
						</div>

						<div class="modal-body">
							<p><?php echo $fac_detail->fac_description;?></p>
						</div>
						<div class="modal-footer">

						</div>
					</div>

				</div>
			</div>

		<?php }
	}

else{ ?>
<span class="nodata">No data available</span>
<?php }

	 ?>


	<script>
		jQuery(".edit.editacademyfacility").on("click", function(){jQuery(".nav-link.academytabbing").trigger("click");
setTimeout(function(){
jQuery(".boxachievement .dropify-wrapper").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
},500);

	});


//Facility Academy Details


$('.deleteacademyfacility').on("click",function() {
	var fac_id  = $(this).find('#delete_fac_id').val();
	var fac_name  = $(this).find('#fac_name').val();
	showingLoader();
	swal({
title: 'Are you sure you want to delete?',
text: "You won't be able to delete this!",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',
confirmButtonText: 'Delete'
}).then((result) => {
	if (result.value) {

	$.ajax({
			url: '<?=base_url();?>login/deletefac',
			type: 'POST',
			data: {fac_id:fac_id},
			success: function (res) {               			
				if(res!="fail"){
					 hiddingLoader();
					swal(fac_name+ " deleted successfully","","success");
					$("#fac_div_"+fac_id).hide();
					jQuery("#facList").trigger("click");

				}else{
					swal("Done!","Sorry some problem occurred","success");
				}
			}
		});


		}
})
hiddingLoader();
	});



$('.editacademyfacility').on("click",function() {
	var fac_id  = $(this).find('#edit_fac_id').val();
	var imgUrl = '<?=base_url('assets/public/images/fac/');?>';
	//alert(fac_id); return false;
	showingLoader();
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>login/getSingleFac',	
			data: {fac_id:fac_id},
			success:function(res){
				hiddingLoader();
				//alert(res);
				var result = JSON.parse(res);
				// Facility / Acedmy
				if(result['single_fac_data'].fac_type=='facility'){
					$("#facilityselect1").prop("checked", true);
				}
				$('#facilityname1').val(result['single_fac_data'].fac_name);	
				$('#textacademy').val(result['single_fac_data'].fac_description);		
				$('#facilitycity').val(result['single_fac_data'].fac_city);					
				$('#fac_latitude').val(result['single_fac_data'].fac_latitude);					
				$('#fac_longitude').val(result['single_fac_data'].fac_longitude);					
				$('#facilityarea').val(result['single_fac_data'].fac_address);				
				$('#facilitypincode').val(result['single_fac_data'].fac_pincode);
				$('#fac_id').val(result['single_fac_data'].fac_id);
				$('#old_fac_banner').val(result['single_fac_data'].fac_banner_image);
				$('#old_fac_logo').val(result['single_fac_data'].fac_logo_image);


				$('#input-file-banner').attr('data-default-file', imgUrl+result['single_fac_data'].fac_banner_image);
				//$('#input-file-logo').attr('data-default-file', imgUrl+result.fac_logo_image);
					//var abc = imgUrl+result.fac_banner_image;
					$('#input-file-banner,#input-file-logo').parents(".dropify-wrapper").find(".dropify-preview").show();
					$('#input-file-banner,#input-file-logo').parents(".dropify-wrapper").find(".dropify-filename-inner").text(result['single_fac_data'].fac_banner_image)
					$('#input-file-banner,#input-file-logo').parents(".dropify-wrapper").find('.dropify-render').empty().append("<img class='abc'>");
					$('#input-file-banner').parents(".dropify-wrapper").find('img.abc').attr('src', imgUrl+result['single_fac_data'].fac_banner_image);
					$('#input-file-logo').parents(".dropify-wrapper").find('img.abc').attr('src', imgUrl+result['single_fac_data'].fac_logo_image);
						//shareInfoLen = Object.keys(obj.shareInfo[0]).length;

						//Timing
						if(result['single_fac_timing'].length>0){
							jQuery(".editbox").show();
							jQuery("#mySelect").empty();
							jQuery(".timinginitator").hide();

							for(var j=0; j<result['single_fac_timing'].length; j++){
								$("#mySelect,#mySelect_hidden").append('<option class="'+ result['single_fac_timing'][j].day +'" type-value-open="'+ result['single_fac_timing'][j].open_time +'" type-value-close="'+ result['single_fac_timing'][j].close_time +'" selected value="'+ result['single_fac_timing'][j].day +'-'+ result['single_fac_timing'][j].open_time +'-'+ result['single_fac_timing'][j].close_time +'"><span style="width:120px">'+ result['single_fac_timing'][j].day +'</span> : '+ result['single_fac_timing'][j].open_time +'  to '+ result['single_fac_timing'][j].close_time +'</span></option><i class="fa fa-clock-o prefix" aria-hidden="true"></i> <i class="fa fa-edit prefix edittimepopup" data-toggle="modal" data-target="#shopTiming" aria-hidden="true"></i>');


							}


						}
					
				} 
				
			});

});


jQuery('.edittimepopup').on('click', function(){
setTimeout(function(){
jQuery("#mySelect option").each(function(){var abc = jQuery(this).attr('class'); var cdf = jQuery(this).attr('type-value-close'); var sdf = jQuery(this).attr('type-value-close'); jQuery('.list_edit_times li').each(function(){var ndf = jQuery(this).find('.day').text(); if(ndf==abc){jQuery(this).addClass('checked'); $( this ).find('input[type="checkbox"]').prop( "checked", true ); jQuery(this).find('input.time').val(cdf); }});});},900);
});
/*var disable_button = $(".nodata").length;
if(disable_button > 0){ $("#activate-step-3").hide()}else{$("#activate-step-3").show()};*/

jQuery(".dropify-wrapper").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
</script>

