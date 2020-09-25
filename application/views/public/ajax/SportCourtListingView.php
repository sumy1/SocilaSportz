<style type="text/css">
	#td-clock-0{
		display: none;;
	}

</style>
<div class="tab-content1" id="nav-tabContent">
							<div class="tab-pane fade show active" id="activeTab" role="tabpanel" aria-labelledby="activeTab-tab">
								<div class="table-responsive">

									<table class="table1 table-hover table_cust offers_table1" id="listCustomerTable">
										<thead>
											<tr class="bg-grey">
												<th>
												S. No.</th>
												<th>Facility / Academy</th>
												<th>Sports Name</th>
												<th>No. of Courts</th>
												<th>Indoor/Outdoor</th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody>
											<?php if (isset($sport_details) && !empty($sport_details)) { $i=0;
							foreach ($sport_details as $sport_detail) { $i++ ?>
											<tr class="promoted_data" id="tr_div_<?= $sport_detail->fac_sport_id;?>">
												<td class="text-center"><?= $i;?></td>

												<td class="text-left">
													<div class="product_container clearfix">
														<div class=" text-center">
															<span class="table-green"><?php echo $sport_detail->fac_name;?></span>
														</div>	
													</div>
												</td>

												<td class="text-left">
													<div class="product_container clearfix">
														<div class=" text-center">
															<span class="table-green"><?php echo $sport_detail->sport_name;?></span>
														</div>	
													</div>
												</td>

												<td class="text-center date_data_item ">
													<span class="table-darkblue"><?php echo $sport_detail->sport_court;?></span>
												</td>
												<td class="text-center date_data_item">
													<span ><?php echo $sport_detail->sport_indor;?>/<?php echo $sport_detail->sport_outdor;?></span>	

												</td>
												<!-- <td class="text-center price_data_item">
													<span class="table-blue"><i class="<?php if($sport_detail->indor_kit_price!='') echo 'fa fa-rupee';?>"></i> <?php if($sport_detail->indor_kit_price =='') {echo 'N/A';} else{echo $sport_detail->indor_kit_price;}?></span>	
												</td> -->
												<!-- <td class="text-center price_data_item">
													
													<span class="table-blue"><i class="<?php if($sport_detail->outdor_kit_price!='') echo 'fa fa-rupee';?>"></i> <?php if($sport_detail->outdor_kit_price =='') {echo 'N/A';} else{echo $sport_detail->outdor_kit_price;}?> </span>	
												</td> -->

												<td>
													<a href="javascript:void(0)"  class="editsports" title="Click here to view customer list"> <i class="fa fa-pencil-square-o table-red "></i><input type="hidden" name="" id="fac_sport_id_edit" value="<?php echo $sport_detail->fac_sport_id;?>"></a>
													

													<a href="javascript:void(0)"  class="deletesports" > <i class="fa fa-trash table-red"></i><input type="hidden" name="" id="fac_sport_id_del" value="<?php echo $sport_detail->fac_sport_id;?>"></a>
												

											</td>
										</tr>
										<?php } } 
										else{ ?>
											<span class="nodata pro_sport_list">Data Not Available</span>
									<?php 	} ?>

									
									</tbody>
								</table>
							</div> 

						</div>
						<div class="col-md-12 text-right">
							
							<ul class="list-inline business_detail_buttons">
								<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-raised btn_proceed listproceed1"  id="activate-step-4">Proceed<div class="ripple-container"><div class="ripple-decorator ripple-on ripple-out" style="left: 109.109px; top: 25px; background-color: rgb(255, 255, 255); transform: scale(21.5761);"></div></div></a>
								</li>
							</ul>
						</div>

<script type="text/javascript">
	$('#activate-step-4').on('click', function(e) {
	$('ul.setup-panel li:eq(3)').removeClass('disabled');
	$('ul.setup-panel li a[href="#step-4"]').trigger('click'); 
	$('html, body').animate({ scrollTop: 0 }, 'slow', function () {

	});  
});
	
</script>

<script>
		jQuery(".editsports").on("click", function(){jQuery('.sportstab').trigger('click')});
		setTimeout(function()
		{
			jQuery("#mondayOp").trigger("click");
		},200);

//Facility Academy Details

$('.editsports').on("click",function() {
	var fac_sport_id_edit  = $(this).find('#fac_sport_id_edit').val();
	showingLoader();
	//alert(fac_sport_id_edit); 
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>login/getfac_sport',	
			data: {fac_sport_id_edit:fac_sport_id_edit},
			success:function(res){
				//alert(res);
				hiddingLoader();
				var result = JSON.parse(res);
				// Facility / Acedmy
				if(result['fac_sport'].indor_kit_available=='yes'){
					$("#indorkitcheckbox").prop("checked", true);
					jQuery(".priceforavaialable").show();
				}
				if(result['fac_sport'].outdor_kit_available=='yes'){
					$("#outdorkitcheckbox").prop("checked", true);
					jQuery(".priceforavaialable").show();
				}

			$('#indoorkitprice').val(result['fac_sport'].indor_kit_price);
			$('#outdoorkitprice').val(result['fac_sport'].outdor_kit_price);	
			$('#sport_court_id').val(result['fac_sport'].fac_sport_id);	
			$('#facname  option[value="'+result['fac_sport'].fac_id+'"]').prop("selected", true);	
			$('#sportsname  option[value="'+result['fac_sport'].sport_id+'"]').prop("selected", true);

			$('#courtnumber').val(result['fac_sport'].sport_court);	
			$('#kitquantity2').val(result['fac_sport'].sport_indor);	
			$('#kitquantityoutdoor').val(result['fac_sport'].sport_outdor);	

			//$('#courtnumber  option[value="'+result['fac_sport'].sport_court+'"]').prop("selected", true);	
		/*	$('#kitquantity2  option[value="'+result['fac_sport'].sport_indor+'"]').prop("selected", true);	
			$('#kitquantityoutdoor  option[value="'+result['fac_sport'].sport_outdor+'"]').prop("selected", true);	*/




					//$('#temp_id').val(temp_id);
					//CKEDITOR.instances['editor1'].setData(temp_body);
				} 
				
			});

});

$('.deletesports').on("click",function() {
	var fac_sport_id  = $(this).find('#fac_sport_id_del').val();
	showingLoader();
	//alert(fac_sport_id);
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
			url: '<?=base_url();?>login/deletefacsport',
			type: 'POST',
			data: {fac_sport_id:fac_sport_id},
			success: function (res) {               			
				if(res!="fail"){
					hiddingLoader();
					swal(" deleted successfully","","success");
					$("#tr_div_"+fac_sport_id).hide();
					jQuery("#facsportslisting").trigger("click");

				}else{
					swal("Done!","Sorry some problem occurred","success");
				}
			}
		});


		}
})
hiddingLoader();
	});
var disable_button = $(".nodata").length;
if(disable_button > 0){$("#activate-step-4").hide()};
</script>						

