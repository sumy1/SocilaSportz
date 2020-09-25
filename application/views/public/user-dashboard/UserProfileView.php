<!DOCTYPE html>
<html>

<head>
	<title>Social Sportz</title>
	<?php $this->load->view('public/common/head');?>
	<style>

		label{font-size:12px !important;}
		.modal-backdrop{opacity: 0.6 !important}
		header{
			background: #000;
		}

		.user-profile .bmd-form-group .bmd-label-static
		{
			top:0.5rem !important;
		}

		.dropify-wrapper {
    height: 190px !important;
    top: 18px;
}

		.userdasboard-wrapper
		{
			margin-top:120px;
		}

		

		.search-area:before{
			content: '';
			width:100%;
			height:109px;
			background:rgba(255,255,255,0.4);
			left:0px;
			top:0px;
			position:absolute;
		}

		.search-wrapper{
			margin-top: 230px;
		}

		.search-area {    background: url(assets/images/footer_bg.jpg);}
		.search-area {
			position:fixed !important;
			margin-bottom: 30px;
			top: 105px;
			height: 105px;
			z-index: 9999999;
		}

	#editprofilewrapper	.form-group
{
	position: 	relative;
}
#editprofilewrapper .form-group:before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0px;
    width: 100%;
    background: #ffffff2e;
    height: 33px;
    z-index: 99;
}


#editprofilewrapper.activesame .form-group:before
{
display:none;
}

input#userphone {
    width: calc(100% - 22px) !important;
    margin-left: 22px;
}

	</style>


</head>

<body class="user-profile">
	<?php $this->load->view('public/common/header');?>
	<!-- // Banner starts Here // -->
	<div class="clearfix"></div>


	<section class="userdasboard-wrapper">
		<div class="container">
			<div class="row">

				<div class="col-sm-12">
					<div class="row">
						<div class="col-md-4">

							<div class="sidebar_profile">
								<?php $this->load->view('public/common/usersidebar');?>
							</div>
						</div>
						<div class="col-md-8 pl-md-0 " id="editprofilewrapper">
							<h1>Edit your Profile</h1>
							<i class="fa fa-edit" id="editprofile"></i>
							<form action="" class="form_profile" id="profile_form" name="profile_form" enctype="multipart/form-data">
							<div class="row">
								
								<div class="col-md-3">
									<input type="file" class="photo" name="profile_pic" id="profile_pic" data-default-file="<?php if(isset($user_info)) echo base_url('assets/public/images/user/'.$user_info->user_profile_image);?>">
									<input type="hidden" name="old_profile_pic" class="old_profile_pic" value="<?php if(isset($user_info)) echo $user_info->user_profile_image ?>">
									<span id="errPic" class="error"></span>
								</div>
								<div class="col-md-9">
									
										<div class="row justify-content-center">
											<div class="col-md-6">

												<div class="form-group bmd-form-group">
													<i class="fa fa-user prefix"></i>
													<label for="user-name" class="bmd-label-floating">Name<span class="required">*</span></label>
													<input type="text" class="form-control" id="user-name" name="user_name" placeholder="" value="<?php if(isset($user_info)) echo $user_info->user_name ?>" onkeyup="leftTrim(this) " onkeypress="return withoutspecialnumeric(event)" readonly >
													<span id="errName" class="error"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
													<label for="gender" class="bmd-label-floating">Gender<span class="required">*</span></label>
													<select class="form-control" id="gender" name="gender">
														<option class="abc" value="M" <?php if($user_info->user_gender=='M') echo 'selected' ?>>Male</option>
														<option class="abc" value="F" <?php if($user_info->user_gender=='F') echo 'selected' ?>>Female</option>
														<option class="abc" value="T" <?php if($user_info->user_gender=='T') echo 'selected' ?>>Other</option>

													</select>
													<i class="fa fa-venus-mars prefix"></i>
													<span id="errGender" class="error"></span>	
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-group bmd-form-group-sm">
													<i class="fa fa-envelope prefix"></i>
													<label for="user-email" class="bmd-label-floating">Email<span class="required">*</span></label>
													<input type="text" class="form-control" id="user-email" name="user-email" placeholder="" value="<?php if(isset($user_info)) echo $user_info->user_email; ?>" readonly>
												</div>
											</div>
											<div class="col-md-6">

												<div class="form-group bmd-form-group">
													<label for="userphone" style="z-index:99; top:19px" class=" bmd-label-floating">Phone Number<span class="required">*</span></label>
													
													<input type="text" class="form-control" id="userphone" name="userphone" onkeypress="validate(event)" value="<?php if(isset($user_info)) echo $user_info->user_mobile_no ?>" readonly>
													<i class="fa fa-phone prefix"></i>
													<span id="errPhone" class="error"> </span>
												</div>
											</div>

											<div class="col-md-6">

												<div class="form-group bmd-form-group bmd-form-group-sm">
													<i class="fa fa-map-marker prefix"></i>

													<label for="user-name" class="bmd-label-floating">Location<span class="required">*</span></label>
													<input type="text" class="google_address form-control" id="usercity" name="user_city" placeholder="" value="<?php if(isset($user_info)) echo $user_info->user_google_address; ?>"  readonly>
													<input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php if(isset($user_info)) echo $user_info->user_latitude ?>">
													<input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php if(isset($user_info)) echo $user_info->user_longitude ?>">
													<span id="errLocation" class="error"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group bmd-form-group bmd-form-group-sm is-filled">
													<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url();?>assets/public/images/earth_red.png">
													<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url();?>assets/public/images/earth_blue.png">
													<label for="user-name" class="bmd-label-floating">Country<span class="required">*</span></label>
													<select class="form-control" id="country" name="country">
														<option selected>India</option>
													</select>	
												</div>
											</div>

											<div class="col-md-12">
											
										<div class="editprofileactive">
										<a class="redtext" style="float: left;" href="<?=base_url('dashboard/user_change_password');?>">
										Change Password
												
										</a>

                                                <div class="text-right">
													<a href="javascript:void(0)" class="btn-success btn-sm btn-save-profile orange-btn" id="savechanges">Save Changes</a>

													<a href="javascript:void(0)" class="btn-success btn-sm btn-save-profile orange-btn" id="cancelbtn">Cancel</a>

                                                </div>
		
	
												</div>
											</div>
										</div>
									
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

			<div class="loader">
				<div class="">
					<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
				</div>
			</div>

<?php $this->load->view('public/common/footer');?>
	
<?php $this->load->view('public/common/foot');?>
</body>
<script>


	$("#editprofile").on("click", function(){
		$("#editprofilewrapper input#user-name, #editprofilewrapper input#usercity").removeAttr("readonly");
		$("#editprofilewrapper").addClass("activesame");
		$(".editprofileactive").show(); $("#editprofile").hide();});


	$("#cancelbtn").on("click", function(){
		$("#editprofilewrapper").removeClass("activesame");
		$("#editprofilewrapper input#user-name, #editprofilewrapper input#usercity").attr("readonly", "readonly");
		$(".editprofileactive").hide(); $("#editprofile").show();});

	$(".photo").dropify();
	$(".dropify-message p").html('Please Upload Profile Photo');

	$(".dropify-clear").on("click", function(){
	
		$(".old_profile_pic" ).val('');
	});	
	$("#savechanges").on("click", function(){
		var name = $('#user-name').val();
		var gender_val=$( "#gender option:selected" ).val();
		var city=$('#usercity').val();
		var profile_pic = $('input[name=profile_pic]').val();
		var extcatgst_image = profile_pic.split('.').pop();
	 	var old_profile_pic = $("#old_profile_pic").val();
	

	 if(profile_pic!=''){
		 var image_size=parseFloat($("#profile_pic")[0].files[0].size / 1024).toFixed(2);
		 
	    if(image_size>500){
			   $('#errPic').html('Please attach image below 500 kb');
		       return false;
		}
		else{
			 $('#errPic').html('');
		}
		if($.inArray(extcatgst_image,['png','jpg','jpeg']) == -1){
			$('#errPic').html('Please attach image in png , jpg or jpeg format only');			
	    return false; 
		}
		 else{
		    $('#errPic').html('');
	    }
	 }

		if(name == ''){
		$('#user-name').show();
		$('#errName').html('Please enter name');
		$('html,body').animate({scrollTop: $("#errName1").offset().top - 190},'slow');
		return false;
	}else{
		$('#errName').html(''); 
	}
	if(city == ''){
		$('#usercity').show();
		$('#errLocation').html('Please enter location');
		$('html,body').animate({scrollTop: $("#errLocation").offset().top - 190},'slow');
		return false;
	}else{
		$('#errLocation').html('');
		showingLoader();
	}

	
	var form = $('#profile_form')[0];
	var myFormData = new FormData(form);

				myFormData.append('action', 'update_profile');
                 
				$.ajax({
					url:'<?php echo base_url();?>dashboard/update_profiling',
					type: 'POST',
					data: myFormData,
					cache: false,
					processData: false,
					contentType: false,
					async: false,
					success:function(res){
						
						if(res==1){
							 swal({
					        title : 'Profile updated successfully',
					        html : '',
					        type: 'success'
					    }).then((result) => {
					        if (result.value) {
								$('.username_dashboard').text(name);
							}
					    })						
				}
				else{
					 swal({
					        title : 'Network Issuee!',
					        html : '',
					        type: 'warning'
					    }).then((result) => {
					        if (result.value) {}
					    })
				

				}				    
				hiddingLoader();
			}	
		});



	});	


		
</script>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0wtja4w6vh9O7W6I0_rdy9lZwBboq4r4&libraries=places&callback=initMap" async defer></script>

<script>

function initMap() {
// Create the autocomplete object, restricting the search to geographical
// location types.
autocomplete1 = new google.maps.places.Autocomplete(
/** @type {!HTMLInputElement} */
(document.getElementById('usercity')),
{types: ['geocode']});

autocomplete1.addListener('place_changed', function() {
//infowindow.close();
var place = autocomplete1.getPlace();
$('#latitude').val(place.geometry.location.lat());
$('#longitude').val(place.geometry.location.lng());
});

}


	var addressInputElement = $('#usercity');
addressInputElement.on('focus', function () {
  var pacContainer = $('.pac-container');
  $(addressInputElement.parent()).append(pacContainer);
})


  jQuery(".dropify-wrapper").each(function(){var abc = $(this).find(".photo").attr("data-default-file"); if(!abc.toLowerCase().match(/\.(jpg|jpeg|png|gif)/g)){$(this).find('.dropify-clear').trigger('click')}});

$(document).on("click", "#cancelbtn", function(){location.reload(true);});
</script>

</html>