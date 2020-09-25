<!DOCTYPE html>
<html>

<head>
  <title>Social Sportz</title>
  
  <?php $this->load->view('public/common/head');?>
  <style>
 .awardcolumn img {
    height: 250px;
}   
 #achievement{
      max-height: 600px;
    overflow: auto; 
 }   
#searchvenueSlider{overflow: hidden; height: 300px;}

    form{margin-bottom: 0px !important}
  .swal-footer{text-align:center !important;}
  .swal-button {
    background-color: #ec4613;
  }

  #reviewtabing
  {
    max-height: 380px;
    overflow-y: auto;
  }

img.rounded-circle
{
  width: 60px;
  height: 60px;
}

 .review_list .reviews_data_list{border:none !important;  }
 textarea{padding:5px 10px !important}
 #addReviews {
  z-index: 9999 !important;
}
.nopadleft{padding-left: 0px !important}
.swal2-container{z-index: 9999999999 !important}
#enquiresubmit
{

  color: #fff !important;
  padding: 7px 50px;
  margin-bottom: 34px;

}
.header-data {
    margin: -43px 0px 11px !important;
}

</style>
</head>

<body id="searchDetail">
  <?php $this->load->view('public/common/headeruser');?>


  <section class="searchdetail-wrapper">
    <section class="bannerheading">
      <img class="bannersearch" src="<?=base_url('assets/public/images/fac/'.$facility_detail->fac_banner_image);?>">
       <?php if($rating_count!=0){ ?>
      <div class="venue-rating-div"><div><div class="venue-list-rating"><i class="fa fa-star"></i> <?= $avg_rating;?></div></div><div class="venue-list-votes"><?=$rating_count;?> Review</div>
    </div>
    <?php } ?>
	<?php
  $favourite_listing=$this->CommonMdl->getRow('tbl_favourite',$clms='*',array('user_id'=>$this->session->userdata('user_id'),'fac_id' =>$facility_detail->fac_id));
	  if(!empty($favourite_listing->favourite_id))
	  {?>
		  <div class="favourite">
            <i class="fa fa-heart zoominnew"></i>
            <i class="fa fa-heart-o"></i>
           </div>
		<?php }
	  else{?> 
	<div class="favourite">
      <i class="fa fa-heart"></i>
      <i class="fa fa-heart-o"></i>
        </div>
	
	<?php } ?>
    <div class="container floatingdiv">

      <div class="col-sm-12 btndetailwrapper">
        <form method="post" action="<?php echo base_url('booking'); ?>">
			<input type="hidden" class="book_fac_id" name="book_fac_id" value="<?php echo $facility_detail->fac_id;?>" >
			<input type="hidden" class="favourite_id" name="favourite_id" value="<?php echo @$favourite_listing->favourite_id;?>" >
			<input type="hidden" name="book_sport_id" value="<?php if(!empty($this->session->userdata('sport_id'))){ echo $this->session->userdata('sport_id');} ?>" >
			<input type="hidden" name="book_type" value="<?php echo $facility_detail->fac_type;?>" >
			<button type="submit" class="readmore-blog orange-btn detailbooknow" >Book Now</button>
		</form>
        <a class="readmore-blog orange-btn detailbooknow"  data-toggle="modal" data-target="#enquirenow">Enquire</a>
      </div>
      <h1 class="text-center fac_name"><?=$facility_detail->fac_name;?></h1>
    </div>
  </section>  

  <div class="header-data bottomgap30">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="top-head-nav clearfix">
            <div class="page-title float-md-left">
          
            </div>
            <div class="navigation-bread float-md-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb"> 
                  <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>  
                  <li class="breadcrumb-item active" aria-current="page">Search</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-sm-8">
        <div class="left-div">
          <div class="info-div detail-left-div">
            <p class="info-label"> DESCRIPTION </p>
            <p class="venue-description"><?=$facility_detail->fac_description;?></p>


          </div>
          <?php if(!empty($facility_gallery)){?>
          <div class="col-sm-12 grid">
           <div class="row">
            <div class="col-sm-6 nopadleft grid1"><img data-toggle="modal" data-target="#galleryslider" src="<?=base_url('assets/public/images/gallery/'.$facility_gallery[0]->gallery_image);?>"></div>
            <div class="col-sm-6 nopadleft galleryfiveplus">
             <div class="row">
              <?php
              $nm=0;
               foreach ($facility_gallery as $gallery) {
                   if($nm> 0){
               ?>
                <div class="col-sm-6 nopadright grid2"><img data-toggle="modal" data-target="#galleryslider" src="<?=base_url('assets/public/images/gallery/'.$gallery->gallery_image);?>"></div>
             <?php } $nm++; } ?>
              
                

            </div>
          </div>    
        </div>
      </div>

<?php } ?>

      <div class="detail-left-div info-div"><p class="info-label"> SPORTS AVAILABLE </p>
        <div class="flex sports-div-margin-top">
          <?php if (isset($facility_sport) && $facility_sport) {
            foreach ($facility_sport as $sport_list) { ?>  
            <div class="sport-icon-div">
              <img src="<?=base_url('assets/public/images/sports/'.$sport_list->sport_icon);?>" alt="<?=$sport_list->sport_name;?>">
              <p><?=$sport_list->sport_name;?></p></div>
              <?php }
            } ?>

          </div>
        </div>

        <div class="info-div detail-left-div"><p class="info-label"> AMENITIES </p>
          <?php if (isset($user_amenity) && $user_amenity) {
            foreach ($user_amenity as $amenities) {
              foreach ($amenities->amenity as $amenity) {


               ?>
               <div class="amenities-block">
                <div class="flex">
                  <img class="amenties-img" src="<?=base_url('assets/public/images/amenity/'.$amenity->amenity_icon)?>" alt="<?=$amenity->amenity_name?>">
                  <span><?=$amenity->amenity_name?></span>
                </div>
              </div>
              <?php } } }?>
            </div>

            <div class="show_datatable">


             <ul class="nav nav-tabs">
               <li><a data-toggle="tab" href="#thingsnot" class="active">Things to Note</a></li>
               <li><a data-toggle="tab" href="#achievement" >Achievement</a></li>
               <li><a data-toggle="tab" href="#reviewtabing">Review</a></li>


             </ul>

             <div class="tab-content">

              <div id="thingsnot" class="tab-pane fade  in active">
                <div class="info-div detail-left-div">
                  <ul class="notedlist">
                    <li>The booked slot timings must be followed strictly.</li>
                    <li>Proper Non-marking shoes only.</li>
                    <li>No eatables are allowed inside the courts.</li>
                    <li>The management will not be responsible for belongings of players.</li>  
                  </ul>

                </div>              
              </div>


              <div id="achievement" class="tab-pane fade">
               <div class="info-div detail-left-div">
                <div class="row">
                  <?php if (isset($fac_achievement) && $fac_achievement) {
                    foreach ($fac_achievement as $achievement) { ?>
                  
                  
                  <div class="col-sm-6 awardcolumn">
                    <div class="gallerydemo owl-carousel owl-theme">
                    <div class="item">
                   <img src="<?=base_url('assets/public/images/rewards/'.$achievement->image1)?>">
                   </div>
                   <div class="item">
                   <img src="<?=base_url('assets/public/images/rewards/'.$achievement->image2)?>">
                 </div>
                 </div>
                   <div class="pad15">
                     <h2 class="related_links_heading"><?=$achievement->reward_title;?></h2>
                     <?php foreach ($achievement->reward as $rewardname) { ?>
                     <p><?=$rewardname->reward_name;?></p>
                     <?php } ?>
                   </div>
                 </div>

                  <?php  }
                
                  }else{ ?>
                    <span>Achievement not available</span>
                  <?php } ?>
                 

               </div>
             </div>
           </div>



           <div class="info-div detail-left-div tab-pane fade" id="reviewtabing">


            <div class="tab-pane fade show active" id="overall" role="tabpanel" aria-labelledby="overall-tab">
             <div class="row">
              <div class="col-md-12">
               <ul class="list-unstyled review_list">
                <?php if (isset($rating_list) && !empty($rating_list)) {
                  foreach ($rating_list as $ratings) { ?>
                
                <li class="media reviews_data_list">
                 <div class="media-body user_info">
                  <div class="row ">
                    <div class="col-sm-2">
					
                   <?php if($ratings->user_profile_image->user_profile_image!=''){ ?>
				   <img class="  useyr_img img-fluid rounded-circle" src="<?=base_url('assets/public/images/user/'.$ratings->user_profile_image->user_profile_image);?>" alt="User Image">
					<?php } else{?>
					   <img class="  useyr_img img-fluid rounded-circle" src="<?=base_url('assets/public/images/user-dummy-pic.png');?>" alt="User Image">
					<?php }?>
                  </div>
                   <div class="col-md-9">
                    <h5 class="mt-0 mb-0 user_name clearfix"><?=$ratings->user_name;?></h5>
                    <h5 class="mt-0 mb-0 user_name clearfix"><?=$ratings->sport_name->sport_name;?></h5>
                    <div class="rating_container">
                     <ul class="list-inline">
                      <li class="list-inline-item <?php if($ratings->rating >0) echo "active"  ?>"><i class="fa fa-star"></i></li>
                      <li class="list-inline-item <?php if($ratings->rating >1) echo "active"  ?>"><i class="fa fa-star"></i></li>
                      <li class="list-inline-item <?php if($ratings->rating >2) echo "active"  ?>"><i class="fa fa-star"></i></li>
                      <li class="list-inline-item <?php if($ratings->rating >3) echo "active"  ?>"><i class="fa fa-star"></i></li>
                      <li class="list-inline-item <?php if($ratings->rating >4) echo "active"  ?>"><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <p class="user_comment"><?=$ratings->review_message;?></p>

                </div>


              </div>
            </div>
            <span class="time"><?php echo date('d-M-y', strtotime($ratings->created_on));?></span>
          </li>
          <?php  }
                }

else{ ?>
 <span>No review yet</span>
<?php }  ?>
         

  </ul>
<!--   <a class="btn btn-info orange-btn" style="text-transform: inherit;" data-toggle="modal" data-target="#addReviews">Write a Review</a>   -->                                


</div>

</div>
</div>

</div>





</div>
<form method="post" action="<?php echo base_url('booking'); ?>">
	<input type="hidden" name="book_fac_id" value="<?php echo $facility_detail->fac_id;?>" >
	<input type="hidden" name="book_sport_id" value="<?php if(!empty($this->session->userdata('sport_id'))){ echo $this->session->userdata('sport_id');} ?>" >
	<input type="hidden" name="book_type" value="<?php echo $facility_detail->fac_type;?>" >
	<button type="submit" class="readmore-blog orange-btn detailbooknow" >Book Now</button>
</form>
</div>

</div></div>
<div class="col-sm-4">

  <div class="right-div">
    <div class="info-div detail-left-div">
      <p class="info-label"> OPENING DAYS</p>
      <ul class="openingdaysdetail">
        <?php if (isset($facility_timing) && !empty($facility_timing)) {
          foreach ($facility_timing as $fac_timing) { ?>
          <li><strong><?=$fac_timing->day;?></strong> - <?=$fac_timing->open_time.'-'.$fac_timing->close_time?></li>
          <?php }
        } ?>


      </ul>
    </div>
    <div class="detail-right-div info-div">
      <p class="info-label"> LOCATION </p>
      <p class="locationTextData"><?=$facility_detail->fac_city;?></p>
      <div id="addr"></div>

    </div>




  </div>
</div>


</div>
</div>
</section>

<?php $this->load->view('public/common/footer');?>

<?php $this->load->view('public/common/foot');?>





<div class="modal fade requestModal edit_profile_modal" id="galleryslider">
  
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="request-head mb-0">Gallery</h4><button style="top:0px" type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <div class="owl-carousel owl-theme" id="searchvenueSlider">
       
          <?php
          if(isset($facility_gallery) && !empty($facility_gallery)){
           foreach ($facility_gallery as $gallery) { ?>
          
         <div class="item">

           <img src="<?=base_url('assets/public/images/gallery/'.$gallery->gallery_image);?>">
         </div>
         <?php } }?>
       </div>
     </div>

   </div>
 </div>

</div>

<div class="modal fade requestModal edit_profile_modal" id="enquirenow">

  <div class="modal-dialog  modal-md">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="request-head mb-0">Enquire</h4><button style="top:7px;" type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <form type="post" id="enquire-form" action="">
          <div class="row">
           <?php if(!$this->session->userdata('user_id') && !$this->session->userdata('user_role')=='1') { ?>
            <div class="col-md-6">
              <div class="form-group">
                <label for="username1" class="bmd-label-floating"> Name</label>
                <input type="text" class="form-control" id="username1" onkeyup="leftTrim(this)">
                <i class="fa fa-user prefix"></i>
                <span id="errName1" class="error"> </span>  
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label for="useremail" class="bmd-label-floating">Email</label>
                <input type="text" class="form-control" id="useremail" onkeyup="leftTrim(this)">
                <i class="fa fa-envelope prefix"></i>
                <span id="errEmail" class="error"> </span>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="userphone" class="bmd-label-floating">Phone Number</label>
                <input type="text" class="form-control" id="phone" onkeypress="validate(event)">
                <i class="fa fa-phone prefix"></i>
                <span id="errPhone" class="error"> </span>
              </div>
            </div>
            <?php } ?>

            <div class="col-md-12">
              <div class="form-group bmd-form-group">
                <label for="usercity" class="bmd-label-floating">Subject</label>
                <input type="text" class="form-control" id="usersubject" onkeyup="leftTrim(this)">
                <input type="hidden" class="" id="fac_id" value="<?=$facility_detail->fac_id;?>">
                <i class="fa fa-file-text-o prefix"></i>
                <span id="errsubject" class="error"> </span>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group bmd-form-group is-filled">
                <label for="usercity" class="bmd-label-floating">Message</label>
                <textarea id="messagefield" onkeyup="leftTrim(this)"></textarea>
                <i class="fa fa-file-text-o prefix"></i>
                <span id="errmessage" class="error"> </span>
              </div>
            </div>
      
              <div class="form-group bmd-form-group is-filled">
      <div class="col-md-12" style="margin-top:20px">
           <div class="row">
            <div class="col-md-2 captcha2 nopadright nopadleft captcha2" id="haze"></div>
            <div class="col-md-3 captcha ">

              <input class="form-control" type="hidden" name="captcha22" id="captcha22" value="<?php echo substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);?>">
              <input class="form-control captcharefresh" type="text" name="captcha" id="captcha">
            </div>
            <div class="col-md-3 captcha capb" style="padding:0px 0px!important;">
              <img class="ref" src="<?=base_url();?>assets/public/images/refresh.jpg" id="on" title="Refresh">
            </div>
            <span id="errCaptcha" class="error"> </span>
          </div>
         </div>
        </div>
            
            
            
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="col-sm-12 text-right">
          <button style="background: #f44337;" type="button" class="btn btn-sm orange-btn" id="enquiresubmit">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>

</div>  


<div class="modal fade requestModal edit_profile_modal" id="addReviews">
  <form>
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="request-head mb-0">Bhaichung Bhutia Football Academy</h4><button style="top:0px" type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
          <form action="">
      
      <?php if($this->session->userdata('user_role')=='1'){?>
      

            <div class="form-group row align-items-center mb-2">
              <label for="rating" class="col-sm-3 col-form-label text-black">Rating : </label>
              <div class="col-sm-9">
                <div class="rate rating-2">
                  <i class="fa fa-star" ></i>
          <i class="fa fa-star" ></i>
          <i class="fa fa-star" ></i>
          <i class="fa fa-star" ></i>
          <i class="fa fa-star"></i>  
                </div>
              </div>
         <span class="error" id="errorrating"></span>
            </div>
            <div class="form-group row align-items-center">
              <label for="rating" class="col-sm-12 col-form-label text-black labelreview" >Write a Review : </label>
              <div class="col-sm-12">
                <textarea name="" onkeyup="leftTrim(this)" rows="2" id="rating_message" class="form-control grey_input"></textarea>
                <span class="char-limit float-right text-danger"><span id="rchars" class="text-danger">500</span> charecters left</span>
              </div>
            </div>
      <div class="modal-footer">
         <div class="col-sm-12 text-right">
          <button style="background: #f44337;" type="button" class="btn btn-sm orange-btn" id="reviewaction">SUBMIT</button>
        </div>
      </div>
      <?php }else{ ?>
      <div class="form-group row align-items-center mb-2">

              <div class="col-sm-9">
                <div class="rate rating-2">
                    <h4 style="text-align:center;"> Click <a href="<?=base_url('login');?>">here</a> to Login first</h4> 
                </div>
              </div>
            </div>
           <?php } ?>
          </form>
        </div>
        
    </div>
  </div>
</form>
</div>    





<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
<script type="text/javascript">
  $(function(){
    var dim = $('#captcha22').val();
    $.ajax({
      url:'<?=base_url();?>captcha_code_file_reg.php?rand='+dim,
      success:function(aaa){
     //var arr = aaa.split('+');
     $('#haze').html('<iframe src="<?=base_url();?>captcha_code_file_reg.php?rand='+dim+'" border="0" scrolling="no" allowtransparency="yes"  style="width:100%;margin-top: -32px;" frameBorder="0"></iframe>');   
  }  
});
    $('#on').click(function(){
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));


      $('#captcha22').removeAttr('value');
      $('#captcha22').attr('value',''+text+'');
      var dim = $('#captcha22').val();
      $.ajax({
        url:'<?=base_url();?>captcha_code_file_reg.php?rand='+dim,
        success:function(aaa){
     //var arr = aaa.split('+');
     $('#haze').html('<iframe src="<?=base_url();?>captcha_code_file_reg.php?rand='+dim+'" border="0" scrolling="no"  style="width:100%;margin-top: -40px;" frameBorder="0"></iframe>');   
  }  
}); 
    });
  });



</script>
<script>
  var lat = '<?=$facility_detail->fac_latitude;?>';
  var lng = '<?=$facility_detail->fac_longitude;?>';
  $('#addr').append('<iframe   width="100%"   height="450"    frameborder="0"   scrolling="no"   marginheight="0"   marginwidth="0"   src="https://maps.google.com/maps?q='+lat+','+lng+'&hl=en&z=14&amp;output=embed" > </iframe>');
  
  jQuery("#addReviews .fa-star").on("click", function(){jQuery("#addReviews .fa-star").removeClass("staractive"); jQuery(this).addClass("staractive"); jQuery(this).prevAll().addClass("staractive");});


  function isEmailValid(email){
                        return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
                    }
          
          
  var maxLength = 500;
  $('textarea').keyup(function() {
    var textlen = maxLength - $(this).val().length;
    $('#rchars').text(textlen);
  });


    jQuery('.gallerydemo').owlCarousel({
      nav : true,
      items:1,
      autoplay : true,
      autoplayTimeout : 3500,
      autoplayHoverPause:true,
      smartSpeed:450,
      loop:true,
      margin:30,
      dots : false,
      mouseDrag : true,
      touchDrag : true,
    // navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
      320:{
        items:1
      },
      480:{
        items:1
      },

      991:{
        items:1
      },
      1024:{
        items:1
      },
      1200:{
        items:1
      }
    }   
  });

 

  $(".grid img").on("click", function(){
    jQuery('#searchvenueSlider').owlCarousel({
      nav : true,
      items:1,
      autoplay : true,
      autoplayTimeout : 3500,
      autoplayHoverPause:true,
      smartSpeed:450,
      loop:true,
      margin:30,
      dots : false,
      mouseDrag : true,
      touchDrag : true,
    // navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
      320:{
        items:1
      },
      480:{
        items:1
      },

      991:{
        items:1
      },
      1024:{
        items:1
      },
      1200:{
        items:1
      }
    }   
  });
  });

  setTimeout(function(){
    $(".labelreview").removeClass('bmd-label-static');
    var mgh = $(".galleryfiveplus img").length; if(mgh > 4){$(".galleryfiveplus").css("height","250px")}

  },300);
  $(document).on("click", ".modal-backdrop", function(){$(".modal .close").trigger("click")});

$(document).ready(function(){
  
  
   $('#reviewaction').on("click", function(){
     var rating=$('.rating-2').find('.staractive').length;
     var rating_message= $('#rating_message').val();
     var fac_id= $('#fac_id').val();
     if(rating == 0){
       $("#errorrating").html('Please select  rating');
        return false;
     }else{
       $("#errorrating").html('');
     }
     
      $.ajax({
      type : "POST",
      url : '<?=base_url('searchlisting/ratinginsert');?>',
      data : {rating:rating,rating_message:rating_message,fac_id:fac_id},
      success:function(res){
      if(res!='failed'){
        swal({
          title : 'You are awesome!',
          html : 'Thanks for spending your valuable time',
          type: 'success'
          }).then((result) => {
          if (result.value) {
            $('#rating_message').val('');
            $('#addReviews').modal('hide');
            
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
  
  
  
  
  $("#enquiresubmit").on("click", function(){
    var user_role = '<?=$this->session->userdata('user_role')=='1'?>';
    var fac_id = $("#fac_id").val();

    if(user_role==1){
     var enquirename = '<?=$this->session->userdata('user_name');?>';
     var useremail = '<?=$this->session->userdata('user_email');?>';
     var userphone = '<?=$this->session->userdata('user_mobile_no');?>';
    }

    if(user_role!=1){
    var enquirename = $("#username1").val();
    if(enquirename =="")
    {
      $("#errName1").html("Please enter eame");
      return false;
    }else{
    $("#errName1").html("");
  }
  var useremail = $('#useremail').val();
  if(useremail == ""){
    $("#errEmail").html("Please enter email");
    return false;
  }else{
    $("#errEmail").html("");
  }
  if(!isEmailValid(useremail)){
    $("#errEmail").html("Please enter valid email");
    return false;
  }else{
    $("#errEmail").html("");
  }
  var userphone = $('#phone').val();
  var validPhone= $.trim($('#phone').val()).length;
  if(userphone == ""){
    $("#errPhone").html("Please enter mobile");
    return false;
  }else{
    $("#errPhone").html("");
  }
  if(validPhone< 8 || validPhone > 16){
    $("#errPhone").html("Please enter mobile no. between 8 and 15 characters");
    return false;
  }else{
    $("#errPhone").html("");
  }
  }
  var usersubject = $('#usersubject').val();
  if(usersubject == ""){
    $("#errsubject").html("Please enter subject");
    return false;
  }else{
    $("#errsubject").html("");
  }
  var messagefield = $('#messagefield').val();
  if(messagefield == ""){
    $("#errmessage").html("Please enter subject");
    return false;
  }else{
    $("#errmessage").html("");
  }
  var captcha = $('#captcha').val();
  var captcha22 = $('#captcha22').val();
    if(captcha == ''){
    $('#errCaptcha').html('Please enter captcha');
    return false;
    }else{
      $('#errCaptcha').html('');
    }
  if(captcha!= '' && captcha!=captcha22 ){
    $('#errCaptcha').html('Please enter valid captcha');
    return false;
    }else{
    $('#errCaptcha').html('');
  }
      $.ajax({
          url:'<?php echo base_url();?>searchlisting/enquireinsert',
          type: 'POST',
          data: {username:enquirename,useremail:useremail,userphone:userphone,usersubject:usersubject,messagefield:messagefield,fac_id:fac_id},
          success:function(res){
            if(res!='failed'){
              swal({
                title : 'Thanks',
                html : 'Your enquiry has been submitted successfully and will get back to you soon.',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                  // $('#rating_message').val('');
                  $('#username1').val(''); 
                   $('#useremail').val('');
				   $('#phone').val('');
                   $('#usersubject').val('');
                   $('#messagefield').val('');
                   $('#captcha').val('');
                  $('#enquirenow').modal('hide');
                  
                  }
                   })
            }
            else{
              $('#error_msg').show(); 
              $('#error_msg').text("Network issue");
            }
            }
      
    })
  
  });
});


/*$(".favourite .fa").on("click", function(){
  $(".favourite .fa").show();

$(this).hide();
  if($('.fa-heart').is(':visible'))
  {
    $('.fa-heart').addClass('zoominnew');
  }
  else
  {
   $('.fa-heart').removeClass('zoominnew'); 
  }
});


$(".favourite .fa.zoominnew").on("click", function(){
  $(".favourite .fa-heart-o").show();
  $('.fa-heart').removeClass('zoominnew');
  });*/

/*jQuery("#reviewtabing").niceScroll({autohidemode: false});*/

$(document).on("click",".favourite",function(){
  var fac_id= $('.book_fac_id').val();
	var fav_id= $('.favourite_id').val();
  if(fav_id!=''){
 $('.fa-heart').removeClass('zoominnew'); 
  }
//alert(fac_id);
//alert(fav_id);
	$.ajax({
		type: "POST",
		url : "<?=base_url('searchlisting/ajax_favourite_insert');?>",
		data :{fac_id:fac_id,fav_id:fav_id},
		success: function(res) {
       if(res=='2'){
         $('.fa-heart').removeClass('zoominnew');
        swal({
                title : 'Please login',
                html : 'By login you can favourite it',
                type: 'success'
                }).then((result) => {
                if (result.value) {
                 window.location.href = '<?php echo base_url('login') ?>';
                  
                  }
                   })
      }
      else if(res=='0'){
        $('.fa-heart').removeClass('zoominnew');
        $('.favourite_id').val(''); 
      }
      else if(res=='1'){
         $('.fa-heart').removeClass('zoominnew');
        swal({
                title : 'Network issue!!!',
                html : 'Please try again',
                type: 'warning'
                }).then((result) => {
                if (result.value) { }
                   })
      }
			else{
        $('.fa-heart').addClass('zoominnew');
			$('.favourite_id').val(res);
			}
     
		}
		
	})
});

setTimeout(function(){
$("#searchvenueSlider").show();
},6000);
</script>
</body>
</html>