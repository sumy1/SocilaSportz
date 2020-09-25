<div class="modal-body">
    <div class="container-fluid">
    <form action="" class="sm_inputs">
    <div class="row">
        <div class="col-md-6">
        	
            <div class="form-group bmd-form-group is-filled" style="margin-top: 5px;">
                <label for="sportsname" class="bmd-label-floating">Select Sport<span class="required">*</span></label>
                <select class="form-control sportsname11" id="sportsname" >
                	<?php foreach ($sport_list as $sports) { ?>
                		
                		<option class="abc" value="<?=$sports->sport_id;?>" <?php if($fac_sport->sport_id==$sports->sport_id) echo "selected";?>><?=$sports->sport_name;?></option>
                	<?php } ?>
                    
                </select>
<img alt="sports icon" class="sportsimgicon redicon" src="<?=base_url('assets/public/images/archery.png');?>">
										<img alt="sports icon" class="sportsimgicon blueicon" src="<?=base_url('assets/public/images/sports_blue.png');?>">
						                <span id="errGames" class="error"></span>    
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="city" class="bmd-label-floating">No. of Court/Ground<span class="required">*</span></label>
                <input type="text" class="form-control" id="sport_court" onkeypress="validate(event)" value="<?php if($fac_sport) echo $fac_sport->sport_court;?>">
				<span id="sport_court_error" class="error"></span>
                <input type="hidden"  id="fac_sport_id" class="fac_sport_id" value="<?php if($fac_sport) echo $fac_sport->fac_sport_id;?>">
                <i class="fa fa-sort-numeric-asc prefix"></i>
            </div>
        </div>                                          
        <div class="col-md-6">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="Area" class="bmd-label-floating">No. of Indoor<span class="required">*</span></label>
                <input type="text" class="form-control" id="sport_indor" onkeypress="validate(event)" value="<?php if($fac_sport) echo $fac_sport->sport_indor;?>">
				<span id="sport_indor_error" class="error"></span>
                <i class="fa fa-sort-numeric-asc prefix"></i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group bmd-form-group bmd-form-group-sm">
                <label for="confirmPassword" class="bmd-label-floating">No. of Outdoor<span class="required">*</span></label>
                <input type="text" class="form-control" id="sport_outdor" onkeypress="validate(event)" value="<?php if($fac_sport) echo $fac_sport->sport_outdor;?>" >
				<span id="sport_outdor_error" class="error"></span>
                <i class="fa fa-sort-numeric-asc prefix"></i>
            </div>
        </div>

    </div>
    </form>
    <div class="row">
    <div class="col-md-12 text-center">
        <a href="javascript:void(0)" class="btn btn-raised btn-sm save_btn mt-1" id="successSportsUpdatebtn"> Update</a>
    </div>
    </div>

    </div>
    </div>


    <script>
	
$('.sportsname11').on('change', function() {
	var fac_id = $("#headeracademyfacility option:selected").val();   
	var sport_id = $("#sportsname option:selected").val(); 
	var fac_sport_id = $('.fac_sport_id').val();
if(fac_id!=''){ 
  $.ajax({
type:'post',
url:'<?=base_url('dashboard/exist_sport_name');?>',
data:{fac_id:fac_id,sport_id:sport_id,fac_sport_id:fac_sport_id},
success: function(data){
 if(data == 1){
	 
	 $('#errGames').html("Sport name alredy exist");
	 $("#successSportsUpdatebtn").css("pointer-events","none");
	}
	else{
		 $('#errGames').html("");
		 $("#successSportsUpdatebtn").css("pointer-events","visible");
	}
	
}
 });
    }
});


    	
$('#successSportsUpdatebtn').click(function(event) {
   // var sport_indor = 0;
   // var sport_outdor = 0;

	var sport_court = $('#sport_court').val();
	var sport_indor = $('#sport_indor').val();
    sport_indor=(sport_indor==''?0:sport_indor);
	var sport_outdor = $('#sport_outdor').val();
    sport_outdor=(sport_outdor==''?0:sport_outdor);
	var fac_sport_id = $('.fac_sport_id').val();
	var sport_id=$( "#sportsname option:selected" ).val();
    var result = parseInt(sport_indor) + parseInt(sport_outdor);
    
	if(sport_court == ''){
	    $('#sport_court_error').focus('');
        $('#sport_court_error').html('Please enter no of courts');	
         return false;		
	 }
	 else{
		  $('#sport_court_error').html('');
	 }
	 
	
     if(sport_court!= result)
    {
        $('#sport_outdor_error').html('Sum of indor and outdor court must be equal to the total no .of courts');
        return false;
    }

    else
    {
        $('#sport_outdor_error').html('');  
    }
	 

	action='sport_edit';
	showingLoader();

	$.ajax({
				type: "POST",
				url:'<?php echo base_url();?>dashboard/update_fac_info',	
				data: {sport_court:sport_court,sport_indor:sport_indor,sport_outdor:sport_outdor,sport_id:sport_id,fac_sport_id:fac_sport_id,action:action},
				success:function(res){
				//alert(res); return false;
				if(res!='failed'){
					 hiddingLoader();
					swal({
					title : 'Information updated successfully!',
					html : '',
					type: 'success'
					}).then((result) => {
					if (result.value) {
					$('#sports_edit').modal('hide');
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

	/*$("select").on("change", function(){$(this).find("option:selected").prop("disabled", true)});*/

    </script>