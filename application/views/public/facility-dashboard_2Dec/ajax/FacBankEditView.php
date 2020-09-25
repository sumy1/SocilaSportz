<div class="modal-body">
    <div class="container-fluid">
    <form action="" class="sm_inputs" id="bank_info_edit" name="bank_info_edit" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="oldPassword" class="bmd-label-floating">IFSC Code<span class="required">*</span></label>
                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="<?php if($fac_bank) echo $fac_bank->ifsc_code;?>">
                <i class="fa fa-list-alt prefix"></i>
                 <span id="errAcountifsc" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="newPassword" class="bmd-label-floating">Bank Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php if($fac_bank) echo $fac_bank->bank_name;?>">
                <i class="fa fa-university prefix"></i>
                 <span id="errAcountbankname" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="confirmPassword" class="bmd-label-floating">Branch Address<span class="required">*</span></label>
                <input type="text" class="form-control" id="branch_address" name="branch_address"  value="<?php if($fac_bank) echo $fac_bank->branch_address;?>">
                <i class="fa fa-university prefix"></i>
                 <span id="errAcountaddress" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="confirmPassword" class="bmd-label-floating">Account Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="account_name" name="account_name" value="<?php if($fac_bank) echo $fac_bank->account_name;?>">
                <i class="fa fa-user-circle prefix"></i>
                 <span id="errAcountname" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="confirmPassword" class="bmd-label-floating">Account Number<span class="required">*</span></label>
                <input type="text" class="form-control" id="account_number" name="account_number" value="<?php if($fac_bank) echo $fac_bank->account_number;?>" onkeypress="validate(event)">
                <i class="fa fa-university prefix"></i>
                 <span id="errAcountno" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group selectdiv bmd-form-group is-filled" style="margin-top: 5px;">
                <label for="exampleSelect1" class="bmd-label-floating">Type of Account<span class="required">*</span></label>
                <select class="form-control" id="exampleSelect1" name="account_type">
                    <option value="Current" <?php if(@$fac_bank->account_type=='Current')echo "selected";?>>Current</option>
                    <option value="Saving" <?php if(@$fac_bank->account_type=='Saving')echo "selected";?>>Saving</option>
                </select>   <i class="fa fa-list-alt prefix"></i>
                <span id="errAcounttype" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="gstNumber" class="bmd-label-floating">GST Number<span class="required">*</span></label>
                <input type="text" class="form-control" id="gst_no" name="gst_no" value="<?php if($fac_bank) echo $fac_bank->gst_no;?>">
                <i class="fa fa-list-alt prefix"></i>
                <span id="errAcountgst" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="panNumber" class="bmd-label-floating">PAN Number<span class="required">*</span></label>
                <input type="text" class="form-control" id="pan_no" name="pan_no" value="<?php if($fac_bank) echo $fac_bank->pan_no;?>">
                <i class="fa fa-list-alt prefix"></i>
                <span id="errAcountpan" class="error"> </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="regisNumber" class="bmd-label-floating">CIN Number<span class="required">*</span></label>
                <input type="text" class="form-control" id="business_registration_no" name="business_registration_no" value="<?php if($fac_bank) echo $fac_bank->cin_no;?>">
                <i class="fa fa-list-alt prefix"></i>
                <span id="errAcountcin" class="error"> </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 mt-3">
            <div class="panel-heading12" style="padding:5px 15px; margin-top:0;">Upload Documents</div>
        </div>
        <div class="col-sm-12">
            <ul class="list-inline list_upload_img">
                <li class="list-inline-item">
                    <input type="file" id="input-file-bank-gst" class="dropify" name="gst_image" data-default-file="<?php if($fac_bank) echo base_url('assets/public/images/bankinfo/'.$fac_bank->gst_image)?>" />
                    <input type="hidden" name="old_gst_image" id="old_gst_image" class="old_image" value="<?php if($fac_bank) echo $fac_bank->gst_image;?>">
					<span id="gst_image_error" class="error"></span>
                </li>
                <li class="list-inline-item">
                    <input type="file" id="input-file-bank-pan" class="dropify" name="pan_image" data-default-file="<?php if($fac_bank) echo base_url('assets/public/images/bankinfo/'.$fac_bank->pan_image)?>" />
                    <input type="hidden" name="old_pan_image" id="old_pan_image" class="old_image" value="<?php if($fac_bank) echo $fac_bank->pan_image;?>">
                    <span id="pan_image_error" class="error"></span>
                </li>
                <li class="list-inline-item">
                    <input type="file" id="input-file-bank-registration" class="dropify" name="firm_image" data-default-file="<?php if($fac_bank) echo base_url('assets/public/images/bankinfo/'.$fac_bank->firm_image)?>" />
                    <input type="hidden" name="old_firm_image" id="old_firm_image" class="old_image" value="<?php if($fac_bank) echo $fac_bank->firm_image;?>">
                    <span id="firm_image_error" class="error"></span>
                </li>
                <li class="list-inline-item">
                    <input type="file" id="input-file-bank-addprf" class="dropify" name="address_proof_image" data-default-file="<?php if($fac_bank) echo base_url('assets/public/images/bankinfo/'.$fac_bank->address_proof_image)?>" />
                    <input type="hidden" name="old_address_proof_image" id="old_address_proof_image" class="old_image" value="<?php if($fac_bank) echo $fac_bank->address_proof_image;?>">
                    <span id="address_image_error" class="error"></span>
                </li>
                <li class="list-inline-item">
                    
                    <input type="file" id="input-file-bank-cancheque" class="dropify" name="cheque_image" data-default-file="<?php if($fac_bank) echo base_url('assets/public/images/bankinfo/'.$fac_bank->cheque_image)?>" />
                    <input type="hidden" name="old_cheque_image" id="old_cheque_image" class="old_image" value="<?php if($fac_bank) echo $fac_bank->cheque_image;?>">
                    <span id="cheque_image_error" class="error"></span>

                </li>
            </ul>
        </div>
    </div>
    </form>
    <div class="row">
    <div class="col-md-12 text-center">
      
        <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="bankUpdateBtn"> Update</a>
    
    </div>
    </div>

    </div>
    </div>

    <script>
        
        jQuery(".dropify").dropify();

        setTimeout(function(){
    jQuery("#input-file-bank-gst").siblings(".dropify-message").find("p").text("Upload GST Doc");
    jQuery("#input-file-bank-pan").siblings(".dropify-message").find("p").text("Upload PAN Card");
    jQuery("#input-file-bank-registration").siblings(".dropify-message").find("p").text("Upload Registration Doc");
    jQuery("#input-file-bank-addprf").siblings(".dropify-message").find("p").text("Upload Address Proof");
    jQuery("#input-file-bank-cancheque").siblings(".dropify-message").find("p").text("Upload Cancelled Cheque");
    
    // jQuery("#defaulttimingcontainer").removeClass('is-filled');
    },200)


        $('#bankUpdateBtn').click(function(event) {

                var ifsc_code = $('#ifsc_code').val();
                var bank_name = $('#bank_name').val();
                var branch_address = $('#branch_address').val();
                var account_name = $('#account_name').val();
                var account_number = $('#account_number').val();
                var account_type = $('#exampleSelect1').val();
                var gst_no = $('#gst_no').val();
                var pan_no = $('#pan_no').val();
                var cin_no = $('#business_registration_no').val();
			  
              var old_gst_image = $('#old_gst_image').val();
              var gst_image =  $('input[name=gst_image]').val();
			  var extcatgst_image = gst_image.split('.').pop();
			  
			  var old_pan_image = $('#old_pan_image').val();
              var pan_image =  $('input[name=pan_image]').val();
			  var extcatpan_image = pan_image.split('.').pop();
			  
			  var old_firm_image = $('#old_firm_image').val();
              var firm_image =  $('input[name=firm_image]').val();
			  var extcatfirm_image = firm_image.split('.').pop();
			  
              var old_address_proof_image = $('#old_address_proof_image').val();
			  var address_proof_image =  $('input[name=address_proof_image]').val();
			  var extcataddress_proof_image = address_proof_image.split('.').pop();
			  
              var old_cheque_image = $('#old_cheque_image').val();
			  var cheque_image =  $('input[name=cheque_image]').val();
			 var extcatcheque_image = cheque_image.split('.').pop();
			// alert(extcataddress_proof_image); return false;

             if(ifsc_code == ''){
                $('#ifsc_code').show();
                $('#errAcountifsc').html('Please enter IFSC Code');
                return false;
            }
            else{
                $('#errAcountifsc').html('');
            }
            if(bank_name == ''){
                $('#bank_name').show();
                $('#errAcountbankname').html('Please enter bank name');
                return false;
            }
            else{
                $('#errAcountbankname').html('');
            }
            if(branch_address == ''){
                $('#branch_address').show();
                $('#errAcountaddress').html('Please enter branch address');
                return false;
            }
            else{
                $('#errAcountaddress').html('');
            }

            if(account_name == ''){
                $('#account_name').show();
                $('#errAcountname').html('Please Enter account name');
                return false;
            }
            else{
                $('#errAcountname').html('');
            }

            if(account_number == ''){
                $('#account_number').show();
                $('#errAcountno').html('Please Enter account no.');
                return false;
            }
            else{
                $('#errAcountno').html('');
            }

            if(gst_no == ''){
                $('#gst_no').show();
                $('#errAcountgst').html('Please Enter gst no.');
                return false;
            }
            else{
                $('#errAcountgst').html('');
            }

            if(pan_no == ''){
                $('#pan_no').show();
                $('#errAcountpan').html('Please Enter pan no.');
                return false;
            }
            else{
                $('#errAcountpan').html('');
            }
             if(cin_no == ''){
                $('#business_registration_no').show();
                $('#errAcountcin').html('Please Enter cin no.');
                return false;
            }
            else{
                $('#errAcountcin').html('');
            }

            if(gst_image == '' && old_gst_image==''){
                $('#input-file-bank-gst').show();
                $('#gst_image_error').html('Please Enter gst image');
                return false;
            }
            else{
                $('#gst_image_error').html('');
            }
			 
			 if(gst_image!=''){
				 var image_size=parseFloat($("#input-file-bank-gst")[0].files[0].size / 1024).toFixed(2);
			 
			    if(image_size>500){
					   $('#gst_image_error').html('Please attach image below 500 kb');
				       return false;
				}
				else{
					 $('#gst_image_error').html('');
				}
				if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
					$('#gst_image_error').html('Please attach image in png , jpg or jpeg format only');			
    		    return false; 
				}
				 else{
				    $('#gst_image_error').html('');
			    }
			 }

             if(pan_image == '' && old_pan_image==''){
                $('#input-file-bank-pan').show();
                $('#pan_image_error').html('Please Enter pancard image');
                return false;
            }
            else{
                $('#pan_image_error').html('');
            }
             
             if(pan_image!=''){
                 var image_size=parseFloat($("#input-file-bank-pan")[0].files[0].size / 1024).toFixed(2);
             
                if(image_size>500){
                       $('#pan_image_error').html('Please attach image below 500 kb');
                       return false;
                }
                else{
                     $('#pan_image_error').html('');
                }
                if($.inArray(extcatpan_image,['png','jpg','jpeg']) == -1){
                    $('#pan_image_error').html('Please attach image in png , jpg or jpeg format only');         
                return false; 
                }
                 else{
                    $('#pan_image_error').html('');
                }
             }



             if(firm_image == '' && old_firm_image==''){
                $('#input-file-bank-registration').show();
                $('#firm_image_error').html('Please Enter business registration no. image');
                return false;
            }
            else{
                $('#firm_image_error').html('');
            }
             
             if(firm_image!=''){
                 var image_size=parseFloat($("#input-file-bank-registration")[0].files[0].size / 1024).toFixed(2);
             
                if(image_size>500){
                       $('#firm_image_error').html('Please attach image below 500 kb');
                       return false;
                }
                else{
                     $('#firm_image_error').html('');
                }
                if($.inArray(extcatfirm_image,['png','jpg','jpeg']) == -1){
                    $('#firm_image_error').html('Please attach image in png , jpg or jpeg format only');         
                return false; 
                }
                 else{
                    $('#firm_image_error').html('');
                }
             }


             if(address_proof_image == '' && old_address_proof_image==''){
                $('#input-file-bank-addprf').show();
                $('#address_image_error').html('Please Enter address proof image');
                return false;
            }
            else{
                $('#address_image_error').html('');
            }
             
             if(address_proof_image!=''){
                 var image_size=parseFloat($("#input-file-bank-addprf")[0].files[0].size / 1024).toFixed(2);
             
                if(image_size>500){
                       $('#address_image_error').html('Please attach image below 500 kb');
                       return false;
                }
                else{
                     $('#address_image_error').html('');
                }
                if($.inArray(extcataddress_proof_image,['png','jpg','jpeg']) == -1){
                    $('#address_image_error').html('Please attach image in png , jpg or jpeg format only');         
                return false; 
                }
                 else{
                    $('#address_image_error').html('');
                }
             }


             if(cheque_image == '' && old_cheque_image==''){
                $('#input-file-bank-cancheque').show();
                $('#cheque_image_error').html('Please enter cheque image');
                return false;
            }
            else{
                $('#cheque_image_error').html('');
            }
             
             if(cheque_image!=''){
                 var image_size=parseFloat($("#input-file-bank-cancheque")[0].files[0].size / 1024).toFixed(2);
             
                if(image_size>500){
                       $('#cheque_image_error').html('Please attach image below 500 kb');
                       return false;
                }
                else{
                     $('#cheque_image_error').html('');
                }
                if($.inArray(extcatcheque_image,['png','jpg','jpeg']) == -1){
                    $('#cheque_image_error').html('Please attach image in png , jpg or jpeg format only');         
                return false; 
                }
                 else{
                    $('#cheque_image_error').html('');
                }
             }





			
			
            var form = $('#bank_info_edit')[0];
                var myFormData = new FormData(form);
                myFormData.append('action', 'bank_info_update');
				showingLoader();
               

        $.ajax({
                url:'<?php echo base_url();?>dashboard/update_fac_info',
                type: 'POST',
                data: myFormData,
                cache: false,
                processData: false,
                contentType: false,
                async: false,
                success:function(res){
                //alert(res); return false;
                if(res!='failed'){
					 hiddingLoader();
                    swal({
                title : 'Bank Information updated successfully',
                html : '',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                $('#bankDetails').modal('hide');
                $('#tab3-tab').trigger('click'); 
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

     $('.dropify-clear').click(function() {
   $(this).parents("li").find('input.old_image').val('')
});
  jQuery(".dropify-wrapper").each(function(){var abc = $(this).find(".dropify").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});
    </script>


