<style>
.fancybox-controls{display:none;}
</style>
<div class="cus_modal profile_modal">
	<div class="cus_modal_header clearfix">
		<h5 class="title">
			<a class="toggle">
				<i class="fa fa-university"></i> Bank Details 
			</h5>
		</div>

		<div class="collapse show" id="collapseExample5">
			<div class="cus_modal_body">
				<div class="details_box">
					<div class="row">
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">IFSC Code</h4>
								<p class="detail_item">	<?php if($fac_bank) echo $fac_bank->ifsc_code;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">Bank Name</h4>
								<p class="detail_item">	<?php if($fac_bank) echo $fac_bank->bank_name;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">Branch Address</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->branch_address;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">Account Name</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->account_name;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">Account Number</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->account_number;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">Type of Account</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->account_type;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">GST Number</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->gst_no;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">PAN Number</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->pan_no;?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="contain_data">
								<h4 class="display-4 heading_item">CIN Number</h4>
								<p class="detail_item"><?php if($fac_bank) echo $fac_bank->cin_no;?></p>
							</div>
						</div>
					</div>
					<div class="row upload_doc text-center">
						<div class="col full-width-image contain_data">
							<h4 class="heading_item">GST Doc</h4>
							<a <?php if ($fac_bank && $fac_bank->gst_image!=''){ ?> data-fancybox="gallery" <?php } else { ?> href="javascript:void(0);" <?php } ?> class="documents_gallery" href="<?php if ($fac_bank && $fac_bank->gst_image!='') echo base_url('assets/public/images/bankinfo/'.$fac_bank->gst_image)?>">
								<div class="image_box_doc1 img-thumbnail">
									<?php if($fac_bank){ $chequeext=explode('.',$fac_bank->gst_image); }  ?>
									<img src="<?php if ($fac_bank && $fac_bank->gst_image!='' && $chequeext[1]!='pdf') echo base_url('assets/public/images/bankinfo/'.$fac_bank->gst_image); else if ($fac_bank && $fac_bank->gst_image!='' && $chequeext[1]=='pdf') echo base_url('assets/public/images/pdf.png');?>" class="img-fluid" >
								</div>
							</a>
						</div>
						<div class="col full-width-image contain_data">
							<h4 class="heading_item">PAN Card</h4>
							<a <?php if ($fac_bank && $fac_bank->pan_image!=''){ ?> data-fancybox="gallery" <?php } else { ?> href="javascript:void(0);" <?php } ?> class="documents_gallery" href="<?php if ($fac_bank && $fac_bank->pan_image!='') echo base_url('assets/public/images/bankinfo/'.$fac_bank->pan_image)?>">
								<div class="image_box_doc1 img-thumbnail">
									<?php if($fac_bank){ $panext=explode('.',$fac_bank->pan_image); }  ?>
									<img src="<?php if ($fac_bank && $fac_bank->pan_image!='' && $panext[1]!='pdf') echo base_url('assets/public/images/bankinfo/'.$fac_bank->pan_image);else if ($fac_bank && $fac_bank->pan_image!='' && $panext[1]=='pdf') echo base_url('assets/public/images/pdf.png');?>" class="img-fluid" >
								</div>
							</a>
						</div>
						<div class="col full-width-image contain_data">
							<h4 class="heading_item">CIN Doc</h4>
							<a <?php if ($fac_bank && $fac_bank->firm_image!=''){ ?> data-fancybox="gallery" <?php } else { ?> href="javascript:void(0);" <?php } ?> class="documents_gallery" href="<?php if ($fac_bank && $fac_bank->firm_image!='') echo base_url('assets/public/images/bankinfo/'.$fac_bank->firm_image)?>">
								<div class="image_box_doc1 img-thumbnail">
									 <?php if($fac_bank){ $firmext=explode('.',$fac_bank->firm_image); }  ?>
									<img src="<?php if ($fac_bank && $fac_bank->firm_image!='' && $firmext[1]!='pdf') echo base_url('assets/public/images/bankinfo/'.$fac_bank->firm_image); else if ($fac_bank && $fac_bank->firm_image!='' && $firmext[1]=='pdf') echo base_url('assets/public/images/pdf.png');?>" class="img-fluid" >
								</div>
							</a>
						</div>
						<div class="col full-width-image contain_data">
							<h4 class="heading_item">Business Address Proof</h4>
							<a <?php if ($fac_bank && $fac_bank->address_proof_image!=''){ ?> data-fancybox="gallery" <?php } else { ?> href="javascript:void(0);" <?php } ?> class="documents_gallery" href="<?php if ($fac_bank && $fac_bank->address_proof_image!='') echo base_url('assets/public/images/bankinfo/'.$fac_bank->address_proof_image)?>">
								<div class="image_box_doc1 img-thumbnail">
									<?php if($fac_bank){ $addressext=explode('.',$fac_bank->address_proof_image); }  ?>
									<img src="<?php if ($fac_bank && $fac_bank->address_proof_image!='' && $addressext[1]!='pdf') echo base_url('assets/public/images/bankinfo/'.$fac_bank->address_proof_image); else if ($fac_bank && $fac_bank->address_proof_image!='' && $addressext[1]=='pdf') echo base_url('assets/public/images/pdf.png');?>" class="img-fluid" >
								</div>
							</a>
						</div>
						<div class="col full-width-image contain_data">
							<h4 class="heading_item">Cancelled Cheque</h4>
							<a <?php if ($fac_bank && $fac_bank->cheque_image!=''){ ?> data-fancybox="gallery" <?php } else { ?> href="javascript:void(0);" <?php } ?> class="documents_gallery" href="<?php if ($fac_bank && $fac_bank->cheque_image!='') echo base_url('assets/public/images/bankinfo/'.$fac_bank->cheque_image)?>">
								<div class="image_box_doc1
								img-thumbnail">
								<?php if($fac_bank){ $chequeext=explode('.',$fac_bank->cheque_image); }  ?>
								<img src="<?php if ($fac_bank && $fac_bank->cheque_image!='' && $chequeext[1]!='pdf') echo base_url('assets/public/images/bankinfo/'.$fac_bank->cheque_image); else if ($fac_bank && $fac_bank->cheque_image!='' && $chequeext[1]=='pdf') echo base_url('assets/public/images/pdf.png');  ?>" class="img-fluid" >
							</div>
						</a>
					</div>
				</div>
			
				<a href="javascript:void(0)" class="edit_btn" data-toggle="modal" data-target="#bankDetails"><span>Edit</span> <i class="fa fa-pencil-square-o"></i></a>
			
			</div>
		</div>
	</div>
</div>









<div class="modal fade modal_default view_deal edit_profile_modal" id="bankDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">				
			<div class="modal-header">
				<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit your Bank Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="bank_info_div"></div>

		</div>
	</div>
</div>


<script>

	$('.edit_btn').click(function() {
		showingLoader();
   //alert(fac_id);
   $.ajax({
   	type: "POST",
            //async: true,
            url:'<?php echo base_url();?>dashboard/bank_edit_form',  
            data: {},
            success:function(res){
				hiddingLoader();
            	$("#bank_info_div").html(res['_html']);
            }   
        });

});
	setInterval(function(){
var abc = $(".fancybox-container").length; if(abc > 1){$(".fancybox-container:eq(0)").hide()}
	},200)
</script>