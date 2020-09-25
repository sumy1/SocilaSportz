<style>
#user_rating_view
{
	width: 100%;
}


#addReviews .modal-header {
    color: #fff;
    padding: 12px 24px 7px !important;
    border-bottom: 0;
}

#addReviews .modal-header h4 {
    font-size: 18px;
    width: 100%;
}

#addReviews textarea.form-control {
    height: 50px;
    border: 1px solid #ccc;
    /* border-bottom: none; */
    background: #fff;
    background-image: none !important;
    padding:10px;
}
</style>	



  <div class="modal-content">
        <div class="modal-header">

          <h4 class="request-head mb-0"><?=$fac_name;?></h4><button style="top:6px; right: 5px" type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
          <form action="">
		 
            <div class="form-group row align-items-center mb-2">
              <label for="rating" class="col-sm-3 col-form-label text-black">Rating : </label>
              <div class="col-sm-9">
			
			  <input type="hidden" name="rating_id" value="<?=$user_rating_edit->rating_id;?>" id="rating_id">
			  
                <div class="rate rating-2">
				
					  <li class="list-inline-item"><i class="fa fa-star <?php if($user_rating_edit->rating >0) echo "staractive"  ?>"></i></li>
                      <li class="list-inline-item"><i class="fa fa-star <?php if($user_rating_edit->rating >1) echo "staractive"  ?>"></i></li>
                      <li class="list-inline-item "><i class="fa fa-star <?php if($user_rating_edit->rating >2) echo "staractive"  ?>"></i></li>
                      <li class="list-inline-item"><i class="fa fa-star <?php if($user_rating_edit->rating >3) echo "staractive"  ?>"></i></li>
                      <li class="list-inline-item "><i class="fa fa-star <?php if($user_rating_edit->rating >4) echo "staractive"  ?>"></i></li>
					  
				
                </div>
              </div>
			  
			  <input type="hidden" name="order_fac_id" id="order_fac_id">
			   <span class="error" id="errorrating"></span>
            </div>
            <div class="form-group row align-items-center">
              <label for="rating" class="col-sm-12 col-form-label text-black labelreview" >Write a Review : </label>
              <div class="col-sm-12">
                <textarea name="" maxlength='800' onkeyup="leftTrim(this)" rows="2" id="rating_messages" class="form-control grey_input"><?=@$user_rating_edit->review_messages->review_message  ?></textarea>
                <span class="char-limit float-right text-danger"><span id="rchars" class="text-danger">800</span> charecters left</span>
              </div>
            </div>
			<div class="modal-footer">
         <div class="col-sm-12 text-right">
          <button style="background: #f44337;" type="button" class="btn btn-sm orange-btn" id="reviewactionss" >Update</button>
        </div>
      </div>
			
          </form>
        </div>
        
    </div>
	<script>
	jQuery("#addReviews .fa-star").on("click", function(){jQuery("#addReviews .fa-star").removeClass("staractive"); jQuery(this).addClass("staractive"); jQuery(this).parent().prevAll().find(".fa-star").addClass("staractive");});
	
	$(document).ready(function(){
	
	
	 $('#reviewactionss').on("click", function(){
	   var rating=$('.rating-2').find('.staractive').length;
	   var rating_message= $('#rating_messages').val();
	   var rating_id= $('#rating_id').val();
	   var fac_id= $('#fac_id').val();
	   console.log(rating);
	   if(rating == 0){
		   $("#errorrating").html('Please select  rating');
		    return false;
	   }else{
		   $("#errorrating").html('');
	   }
	   
	    $.ajax({
			type : "POST",
			url : '<?=base_url('dashboard/ratingeditinsert');?>',
			data : {rating_id:rating_id,rating:rating,rating_message:rating_message},
			success:function(res){
			if(res!='failed'){
				swal({
					title : 'Review updated successfully',
					html : '',
					type: 'success'
				  }).then((result) => {
					if (result.value) {
						$('#rating_message').val('');
						$('#addReviews').modal('hide');
						window.location.href = '<?php echo base_url('dashboard/user_rating') ?>';
						
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
  
  
	});
	


			  var maxLength = 800;
$('textarea').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rchars').text(textlen);
});


	</script>
	
	
	
	