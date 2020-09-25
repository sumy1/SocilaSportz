<?php if (isset($fac_details) && $fac_details!='') { $i=0;
	foreach ($fac_details as $fac_detail) { $i++ ;

		//Timing details
		$whr = array('fac_id'=>$fac_detail->fac_id);
		$fac_timings = $this->CommonMdl->getResultByCond('tbl_facility_timing',$whr,'day,open_time,close_time',$order_by='');
		//print_data($fac_timing);

		?>
	
<div class="single-facility-listing">
	<!-- <h3>Facility</h3> -->
	<div class="col-sm-4">
		<div class="listingbannerlogo listingbannerlogo align-items-center d-flex"><img src="<?=base_url();?>assets/public/images/fac/<?=$fac_detail->fac_logo_image;?>" alt=""></div>
		<img src="<?=base_url();?>assets/public/images/fac/<?=$fac_detail->fac_banner_image;?>">
	</div>
	<div class="col-sm-8">
		<div class="facility-cont">
			<h4><?=$fac_detail->fac_name;?></h4>
			<span><?=$fac_detail->fac_address;?></span>
			<br>	
			<div class="col-md-6">
				<div class="form-group bmd-form-group" id="defaulttimingcontainer">
					<div class="editbox1">
						<select class="form-control" id="mySelect">
							<?php
							if (isset($fac_timings) && $fac_timings!='') {
							foreach ($fac_timings as $fac_timing) { ?>
							<option><?=$fac_timing->day.' : '. $fac_timing->open_time.' to '.$fac_timing->close_time; ?> </option>
							<?php  } } ?>
							  </select>	<i class="fa fa-clock-o prefix" aria-hidden="true"></i>
						
					</div>

				</div>
			</div>
		
			<p><?php echo substr($fac_detail->fac_description,0,250);?><br> <a href="javascript:void(0)" class="rm" data-toggle="modal" data-target="#popupevent<?=$i?>">
				<?php if(strlen($fac_detail->fac_description)>250){echo "Read More...";} ?></a>
			</p>
		</div>
		<a class="edit editacademyfacility"  href="#facility">
			<div class="edit-btn">Edit <i class="fa fa-pencil-square-o"></i>
			</div>
			<input type="hidden" name="edit_fac_id" id="edit_fac_id" value="<?=$fac_detail->fac_id;?>">
		</a>

		<a class="edit deleteacademyfacility " >
			<input type="hidden" name="delete_fac_id" id="delete_fac_id" value="<?=$fac_detail->fac_id;?>">
			<div class="edit-btn ">Delete <i class="fa fa-trash "></i>
			</div>
		</a>
	</div>
</div>
<!-- Modal -->
<div class="modal fade modal_default view_deal edit_profile_modal" id="popupevent<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
} ?>


<script>
	jQuery(".edit.editacademyfacility").on("click", function(){jQuery(".nav-link.academytabbing").trigger("click")});


//Facility Academy Details

	$('.editacademyfacility').on("click",function() {
	var fac_id  = $(this).find('#edit_fac_id').val();
	var imgUrl = '<?=base_url('assets/public/images/fac/');?>';
	//alert(fac_id); return false;
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>login/getSingleFac',	
			data: {fac_id:fac_id},
			success:function(res){
				//alert(res);
				var result = JSON.parse(res);
				// Facility / Acedmy
				if(result['single_fac_data'].fac_type=='facility'){
					$("#facilityselect1").prop("checked", true);
				}
					$('#facilityname1').val(result['single_fac_data'].fac_name);	
					$('#textacademy').val(result['single_fac_data'].fac_description);		
					$('#facilitycity').val(result['single_fac_data'].fac_city);					
					$('#facilityarea').val(result['single_fac_data'].fac_address);				
					$('#facilitypincode').val(result['single_fac_data'].fac_pincode);
					
						
					$('#input-file-banner').attr('data-default-file', imgUrl+result.fac_banner_image);
					$('#input-file-logo').attr('data-default-file', imgUrl+result.fac_logo_image);
					//var abc = imgUrl+result.fac_banner_image;
					$('#input-file-banner,#input-file-logo').parents(".dropify-wrapper").find(".dropify-preview").show();
					$('#input-file-banner,#input-file-logo').parents(".dropify-wrapper").find(".dropify-filename-inner").text(result['single_fac_data'].fac_banner_image)
						$('#input-file-banner,#input-file-logo').parents(".dropify-wrapper").find('.dropify-render').append("<img class='abc'>");
						$('#input-file-banner').parents(".dropify-wrapper").find('img.abc').attr('src', imgUrl+result['single_fac_data'].fac_banner_image);
						$('#input-file-logo').parents(".dropify-wrapper").find('img.abc').attr('src', imgUrl+result['single_fac_data'].fac_logo_image);
						//shareInfoLen = Object.keys(obj.shareInfo[0]).length;
								if(result['fac_reward_data'].length>0){
									
									for(var i=0; i<result['fac_reward_data'].length; i++){
										//alert(result['fac_reward_data'][i].reward_title);
										$("#achievementtable").append('<div class="boxachievement"><div class="row"><div class="col-md-3" id="titleEdit" style="display: none"><div class="form-group bmd-form-group-sm bmd-form-group"> <label for="titleValue" class="bmd-label-floating">Type</label> <input type="text" class="form-control" id="titleValue"> <i class="fa fa-list-alt prefix"></i></div></div><div class="col-md-3" id="selectBoxTitle"><div class="form-group selectdiv bmd-form-group is-filled"> <select class="form-control custom-select-sm" id="selectOfferTitle" name="reward_type[]"><option value="">'+result['rewards_type'].reward_name+'</option></select> <i class="fa fa-list-alt prefix"></i></div></div><div class="col-md-4"><div class="form-group bmd-form-group"> <label for="facilityname" class="bmd-label-floating">Title</label> <input type="text" class="form-control" id="facilityname" name="reward_title[]" value='+result['fac_reward_data'][i].reward_title+'><i class="fa fa-trophy prefix"></i> <span id="errFacilityname" class="error"> </span></div></div><div class="col-md-2"> <input type="file" id="input-file-image1" name="achievement_img1[]" class="dropify" /></div><div class="col-md-2"> <input type="file" id="input-file-image2" name="achievement_img2[]" class="dropify" /></div><div class="col-sm-1">	<a href="javascript:void(0)" class="btn btn-raised btn-danger btn_add_sm deleteparent" ><i class="fa fa-trash"></i><div class="ripple-container"></div></a></div></div></div>');
									}


								$("#achievementcheckbox").prop("checked", true);
							jQuery("#achievementtable").show();
						}



					
					//$('#temp_id').val(temp_id);
					//CKEDITOR.instances['editor1'].setData(temp_body);
				} 
				
		});

});

</script>