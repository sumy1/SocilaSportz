<div class="cus_modal profile_modal">
	<div class="cus_modal_header clearfix">
		<h5 class="title">
			<a class="toggle">
				<i class="fa fa-clock-o"></i> Timings 
			</a>
		</h5>
	</div>

	<div class="collapse show" id="collapseExample7">
		<div class="cus_modal_body">
			<div class="table_timing">
				<div class="table-responsive">
					<table class="table table-sm details_info">
						<thead>
							<tr>
								<th>Day</th>
								<th>Opening</th>
								<th>Closing</th>
							</tr>
						</thead>
						<tbody>

							<?php if (isset($fac_timing) && $fac_timing!='') {

								foreach ($fac_timing as $fac_timings) { ?>
									<tr>
										<td class="editdayname1"><?=$fac_timings->day;?></td>
										<td class="editopentime1"><?=$fac_timings->open_time;?></td>
										<td class="editclosetime1"><?=$fac_timings->close_time;?></td>
									</tr>
								<?php }
							} ?>


						</tbody>
					</table>
				</div>
			</div>
			<?php if($fac_id!=''){?>
			<a href="javascript:void(0)" class="edit_btn" data-toggle="modal" data-target="#shopTiming"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
			<?php } ?>
		</div>
	</div>




	<div class="modal fade modal_default view_deal edit_profile_modal" id="shopTiming" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">				
				<div class="modal-header">
					<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Opening & Closing Time</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="detials_comp">
									<form action="" class="sm_inputs" id="fac_timing_edit" name="fac_timing_edit">
									<div class="selectall"><input type="checkbox"> Select All</div>
									<span class="error" style="    width: 100%; top: -6px; text-align: center; height:10px" id="oneselect"></span>
										<ul class="list-inline list_edit_times">
											<li class="list-inline-item">
												<div class="row">
													<span class="bmd-form-group is-filled">
														<div class="checkbox small_checkbox time_check">
															<label>
																<input type="checkbox" class="selectcheck-close">
																<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
															</label>
														</div></span>
														<div class="col-md-3"><p class="day">Mon</p></div>
														<div class="col-md-4 col-sm-12">
															<div class="form-group bmd-form-group-sm">
																<label for="mondayOp" class="bmd-label-floating time_label ">Opening </label>
																<input type="text" class="form-control time openk1"   id="mondayOp" >
																<i class="far fa-clock prefix"></i>
															</div>
														</div>
														<div class="col-md-4 col-sm-12">
															<div class="form-group bmd-form-group-sm">
																<label for="mondayCl" class="bmd-label-floating time_label ">Closing</label>
																<input type="text" class="form-control time closeing" id="mondayCl">
																<i class="far fa-clock prefix"></i>
															</div>
														</div>
													</div>
												</li>
												<li class="list-inline-item">
													<div class="row">
														<span class="bmd-form-group is-filled">
															<div class="checkbox small_checkbox time_check">
																<label>
																	<input type="checkbox" class="selectcheck-close">
																	<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
																</label>
															</div></span>
															<div class="col-md-3"><p class="day">Tue</p></div>
															<div class="col-md-4">
																<div class="form-group bmd-form-group-sm">
																	<label for="tueOp" class="bmd-label-floating time_label ">Opening </label>
																	<input type="text" class="form-control time openk1" value="1:30 pm" id="tueOp">
																	<i class="far fa-clock prefix"></i>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group bmd-form-group-sm">
																	<label for="tueCl" class="bmd-label-floating time_label ">Closing</label>
																	<input type="text" class="form-control time closeing"  id="tueCl">
																	<i class="far fa-clock prefix"></i>
																</div>
															</div>
														</div>
													</li>
													<li class="list-inline-item">
														<div class="row">
															<span class="bmd-form-group is-filled">
																<div class="checkbox small_checkbox time_check">
																	<label>
																		<input type="checkbox" class="selectcheck-close">
																		<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
																	</label>
																</div></span>
																<div class="col-md-3"><p class="day">Wed</p></div>
																<div class="col-md-4">
																	<div class="form-group bmd-form-group-sm">
																		<label for="wedOp" class="bmd-label-floating time_label ">Opening </label>
																		<input type="text" class="form-control time openk1"  id="wedOp">
																		<i class="far fa-clock prefix"></i>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group bmd-form-group-sm">
																		<label for="wedCl" class="bmd-label-floating time_label ">Closing</label>
																		<input type="text" class="form-control time closeing"  id="wedCl">
																		<i class="far fa-clock prefix"></i>
																	</div>
																</div>
															</div>
														</li>
														<li class="list-inline-item">
															<div class="row">
																<span class="bmd-form-group is-filled">
																	<div class="checkbox small_checkbox time_check">
																		<label>
																			<input type="checkbox" class="selectcheck-close">
																			<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
																		</label>
																	</div></span>
																	<div class="col-md-3"><p class="day">Thu</p></div>
																	<div class="col-md-4">
																		<div class="form-group bmd-form-group-sm">
																			<label for="ThurOp" class="bmd-label-floating  time_label">Opening </label>
																			<input type="text" class="form-control time openk1"  id="ThurOp">
																			<i class="far fa-clock prefix"></i>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<div class="form-group bmd-form-group-sm">
																			<label for="ThurCL" class="bmd-label-floating  time_label">Closing</label>
																			<input type="text" class="form-control time closeing"  id="ThurCL">
																			<i class="far fa-clock prefix"></i>
																		</div>
																	</div>
																</div>
															</li>
															<li class="list-inline-item">
																<div class="row">
																	<span class="bmd-form-group is-filled">
																		<div class="checkbox small_checkbox time_check">
																			<label>
																				<input type="checkbox" class="selectcheck-close">
																				<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
																			</label>
																		</div></span>
																		<div class="col-md-3"><p class="day">Fri</p></div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="friOp" class="bmd-label-floating time_label ">Opening </label>
																				<input type="text" class="form-control time openk1"  id="friOp">
																				<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group bmd-form-group-sm">
																				<label for="mobileNum" class="bmd-label-floating time_label ">Closing</label>
																				<input type="text" class="form-control time closeing"  id="mobileNum">
																				<i class="far fa-clock prefix"></i>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="list-inline-item">
																	<div class="row">
																		<span class="bmd-form-group is-filled">
																			<div class="checkbox small_checkbox time_check">
																				<label>
																					<input type="checkbox" class="selectcheck-close">
																					<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
																				</label>
																			</div></span>
																			<div class="col-md-3"><p class="day">Sat</p></div>
																			<div class="col-md-4">
																				<div class="form-group bmd-form-group-sm">
																					<label for="satOp" class="bmd-label-floating time_label ">Opening </label>
																					<input type="text" class="form-control time openk1"  id="satOp">
																					<i class="far fa-clock prefix"></i>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group bmd-form-group-sm">
																					<label for="satCl" class="bmd-label-floating time_label ">Closing</label>
																					<input type="text" class="form-control time closeing"  id="satCl">
																					<i class="far fa-clock prefix"></i>
																				</div>
																			</div>
																		</div>
																	</li>
																	<li class="list-inline-item">
																		<div class="row">
																			<span class="bmd-form-group is-filled">
																				<div class="checkbox small_checkbox time_check">
																					<label>
																						<input type="checkbox" class="selectcheck-close">
																						<span class="checkbox-decorator"><span class="check"></span><div class="ripple-container"></div></span>
																					</label>
																				</div></span>
																				<div class="col-md-3"><p class="day">Sun</p></div>
																				<div class="col-md-4">
																					<div class="form-group bmd-form-group-sm">
																						<label for="sunOp" class="bmd-label-floating time_label">Opening </label>
																						<input type="text" class="form-control time openk1"  id="sunOp">
																						<i class="far fa-clock prefix"></i>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group bmd-form-group-sm">
																						<label for="sunCl" class="bmd-label-floating time_label">Closing</label>
																						<input type="text" class="form-control time closeing"  id="sunCl">
																						<i class="far fa-clock prefix"></i>
																					</div>
																				</div>
																			</div>
																		</li>
																	</ul>
																	
														<select id="mySelect1" class="mySelect1" name="fac_timing[]"  multiple="multiple" style="display:none;"></select>
												</form>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12 text-center">
															<a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="shopTimingBtn"> Update</a>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							
									

							
								<script>
								
								jQuery("#shopTiming .list-inline-item").each(function(){
									jQuery(this).find(".day").parent(".col-md-3").next().find("input").val("7:00 AM"); 
									jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val("9:00 PM");
								});
									$(".time").timeDropper({
										setCurrentTime: false
									});

jQuery("#tab5 .edit_btn").on("click", function(){
	jQuery("#collapseExample7 tr").each(function(){ 
		cdf = jQuery(this).find(".editdayname1").text(); 
		var opentime1 = jQuery(this).find(".editopentime1").text(); 
		var closetime1 = jQuery(this).find(".editclosetime1").text();   
		var abc; 
		jQuery("#shopTiming .list-inline-item").each(function(){
			var abc = jQuery(this).find(".day").text(); 
			if(cdf.indexOf(abc) > -1)
			{
				jQuery(this).addClass("checked"); 
			jQuery(this).find("input").attr("checked", "checked"); 
			jQuery(this).find(".openk1").val(opentime1);  
			jQuery(this).find(".closeing").val( closetime1); 
		} 
	});
	});
});


jQuery(document).on("click", ".checkbox-decorator", function(){
		jQuery(this).parents(".list-inline-item").toggleClass("checked")
	});


jQuery(document).on("click", "#shopTimingBtn", function(e){
					var mno = jQuery(".sm_inputs").find(".list-inline-item.checked").length;
	if(mno==0){$("#oneselect").show(); $("#oneselect").html("Please Select atleast one date"); return false;}
	$('#shopTiming').modal('hide');

	jQuery(".list-inline-item.checked").each(function(){ 
			
		var bookdate = jQuery(this).find(".day").text(); 
		var bookopentime = jQuery(this).find("input[type='text']").val();
		var bookclosetime = jQuery(this).find("input.closeing").val();
		//console.log(bookclosetime);


		
			console.log(bookdate);
			jQuery(".editbox").show();
			jQuery(".timinginitator").hide();
			/*    $('#mySelect').append('<option value="' + key + '">' + selectValues[key] + '</option>');*/
		

				jQuery("#mySelect1").append('<option selected value="'+ bookdate +'-'+ bookopentime +'-'+ bookclosetime +'"><span style="width:120px">'+ bookdate +'</span> : '+ bookopentime +'  to '+ bookclosetime +'</span></option><i class="fa fa-clock-o prefix" aria-hidden="true"></i> <i class="fa fa-edit prefix edittimepopup" data-toggle="modal" data-target="#shopTiming" aria-hidden="true"></i>');	
				jQuery("#exampleModalLongTitle").text("Edit Opening & Closing Time");
				jQuery("#shopTimingBtn").text("Update");

		/*jQuery("#sdd").append('<span style="width:120px">'+ bookdate +'</span> : '+ bookopentime +'  to '+ bookclosetime +'</span>')*/
               


		});
				 var a = new Array();
        $("#mySelect1").children("option").each(function(x){
            test = false;
            b = a[x] = $(this).val();
            for (i=0;i<a.length-1;i++){
                if (b ==a[i]) test =true;
            }
            if (test) $(this).remove();
        })
				var fac_id=$( "#headeracademyfacility option:selected" ).val();
					//alert(fac_id);
				var form = $('#fac_timing_edit')[0];
				var myFormData = [];
	    		 myFormData = new FormData(form);
				
				myFormData.append('action', 'fac_timing_edit');
				// showingLoader();
				myFormData.append('fac_id', fac_id);
				
			$.ajax({
				type: "POST",
				url:'<?php echo base_url();?>dashboard/update_fac_info/fac_timing_edit',	
				data:myFormData,
				cache: false,
				processData: false,
				contentType: false,
				async: false,
				success:function(res){
				//alert(res); return false;
				if(res!='failed'){
					 hiddingLoader();
					swal({
					title : 'Timing updated successfully',
					html : '',
					type: 'success'
					}).then((result) => {
					if (result.value) {
					$('#shopTiming').modal('hide');
                    $('#tab5-tab').trigger('click'); 
                    jQuery("#mySelect1").empty();
                    jQuery(document).on("click", ".checkbox-decorator", function(){
		jQuery(this).parents(".list-inline-item").toggleClass("checked");
	});
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

$(document).on("click", '.selectall input', function() {
if($(".list-inline-item.checked").length > 0){
var rrr =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().next().find("input").val();
var iii =  $("#shopTiming .list-inline-item.checked").find(".day").parent(".col-md-3").next().find("input").val();

$("#shopTiming .list-inline-item.checked").find('.checkbox-decorator').trigger("click");  $("#shopTiming .list-inline-item").each(function(){
jQuery(this).find(".day").parent(".col-md-3").next().find("input").val(iii);
jQuery(this).find(".day").parent(".col-md-3").next().next().find("input.closing").val(rrr);

$(this).find('.checkbox-decorator').trigger("click");	
});	
	
}

else{
 $("#shopTiming .list-inline-item").each(function(){
jQuery(this).find(".day").parent(".col-md-3").next().find("input").val('7:00 AM');
jQuery(this).find(".day").parent(".col-md-3").next().next().find("input.closing").val('9:00 PM');

$(this).find('.checkbox-decorator').trigger("click");	
});}	


 });
 
 $("#shopTiming .list-inline-item input").on("click", function(){if($(".list-inline-item.checked").length < 7){$(".selectall input").prop("checked", false)}});


﻿
﻿
$('.td-overlay, .td-clock, .td-select')
            .on('click', evt => {
          jQuery(".list-inline-item").each(function(){
			  var abc = jQuery(this).find(".day").parent(".col-md-3").next().find("input").val();
			  var cdf = jQuery('.list-inline-item.checked').find(".day").parent(".col-md-3").next().find("input").val();
			  var mmm = jQuery(this).find(".day").parent(".col-md-3").next().next().find("input").val();
			  var rrr = jQuery('.list-inline-item.checked').find(".day").parent(".col-md-3").next().next().find("input").val();

			  if(abc != cdf || mmm != rrr){$(".selectall input").prop("checked", false);}
			  
})
            });



								</script>