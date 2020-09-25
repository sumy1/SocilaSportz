<!DOCTYPE html>
<html>
<head>


 <?php $this->load->view('public/common/head');?>


 <style>
 .awardcolumn img {
    height: 250px;
}   
 #achievement{
      max-height: 600px;
    overflow: auto; 
 }

 .header-data {
  margin: -43px 0px 11px !important;
}
.swal-footer{text-align:center !important;}
.swal-button {
  background-color: #ec4613;
}

.swal-overlay.swal-overlay--show-modal{
 z-index: 9999999999; 
}

.review_list .reviews_data_list{border:none !important;  }
textarea{padding:5px 10px !important}
#addReviews {
  z-index: 9999 !important;
}
.nopadleft{padding-left: 0px !important}
.swal2-container{z-index: 99999 !important;}
#enquiresubmit
{

  color: #fff !important;
  padding: 7px 50px;
  margin-bottom: 34px;

}


</style>
</head>

<body id="searchDetail">
  <?php $this->load->view('public/common/headeruser');?>


  <section class="searchdetail-wrapper">



    <section class="bannerheading">
      <img class="bannersearch" src="<?php if($event_detail) echo base_url('assets/public/images/event/banner/'.$event_detail->event_banner); ?>">

      <div class="container floatingdiv">

        <div class="col-sm-12 btndetailwrapper">

          <!-- <a class="readmore-blog orange-btn detailbooknow" href="event-checkout.php">Book Now</a> -->
          <form method="post" action="<?php echo base_url('booking/event_checkout'); ?>">
                      <input type="hidden" name="book_event_id" value="<?php echo $event_detail->event_id; ?>" >
                      <?php if($booked_event_count < $event_detail->event_max_capicity_per_day && $event_detail->application_end_date >= date('Y-m-d') && $event_detail->application_start_date <= date('Y-m-d')){ ?>
                      <button type="submit" class="readmore-blog orange-btn detailbooknow" >Book Now</button>
                      <?php } ?>

                    </form>
          <a class="readmore-blog orange-btn detailbooknow"  data-toggle="modal" data-target="#enquirenow">Enquire</a>
        </div>
        <h1 class="text-center"><?php if($event_detail) echo $event_detail->event_name; ?></h1>
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
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>  
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
              <p class="venue-description">
                <?php if($event_detail) echo $event_detail->event_description; ?>
              </p>


            </div>

            <?php if(!empty($event_gallery)){?>
          <div class="col-sm-12 grid">
           <div class="row">
            <div class="col-sm-6 nopadleft grid1"><img data-toggle="modal" data-target="#galleryslider" src="<?=base_url('assets/public/images/event/gallery/'.$event_gallery[0]->image);?>"></div>
            <div class="col-sm-6 nopadleft">
             <div class="row">
              <?php
              $nm=0;
               foreach ($event_gallery as $gallery) {
                   if($nm> 0){
               ?>
                <div class="col-sm-6 nopadright grid2"><img data-toggle="modal" data-target="#galleryslider" src="<?=base_url('assets/public/images/event/gallery/'.$gallery->image);?>"></div>
             <?php } $nm++; } ?>
              
                

            </div>
          </div>    
        </div>
      </div>
<?php } ?>

             <div class="info-div detail-left-div"><p class="info-label"> AMENITIES </p>
          <?php if (isset($event_amenity) && $event_amenity) {
            foreach ($event_amenity as $amenities) {
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
                       <li><a data-toggle="tab" href="#ruletab" >Event Rules</a></li>
                        <li><a data-toggle="tab" href="#desctab" >Event Description</a></li>


                     </ul>

                     <div class="tab-content">

                      <div id="thingsnot" class="tab-pane fade  in active">
                        <div class="info-div detail-left-div">
                          <ul class="notedlist">
                             <li>The booked event timings must be followed strictly.</li>
                              <li>Proper Non-marking shoes only.</li>
                              <li>No eatables are allowed inside the courts.</li>
                              <li>The management will not be responsible for belongings of players.</li>
                          </ul>

                        </div>              
                      </div>


                      <div id="ruletab" class="tab-pane fade">
                       <div class="info-div detail-left-div">   
                       <?php if($event_detail->event_eligibility!='') echo $event_detail->event_eligibility ; ?>
                      </div>
                    </div>

                      <div id="desctab" class="tab-pane fade">
                       <div class="info-div detail-left-div">   
                       <?php if($event_detail->event_eligibility!='') echo $event_detail->event_description ; ?>
                      </div>
                    </div>




                  </div>
                  <form method="post" action="<?php echo base_url('booking/event_checkout'); ?>">
                      <input type="hidden" name="book_event_id" value="<?php echo $event_detail->event_id; ?>" >
                       <?php if($booked_event_count < $event_detail->event_max_capicity_per_day && $event_detail->application_end_date >= date('Y-m-d')){ ?>
                      <button type="submit" class="readmore-blog orange-btn detailbooknow"" >Book Now</button>
                      <?php } ?>
                    </form>
                  <!-- <a class="readmore-blog orange-btn detailbooknow" href="event-checkout.php">Book Now</a> -->
                </div>

              </div></div>
              <div class="col-sm-4">

                <div class="right-div">
                  <div class="info-div detail-left-div">
                    <p class="info-label"> EVENT DETAIL</p>
                    <div class="row blacktext">
                      <div class="text-left col-sm-12">
                        <strong> <i class="fa fa-calendar" aria-hidden="true"></i> Event Date :</strong> <span><?php if($event_detail) echo date('d-m-Y',strtotime($event_detail->event_start_date)) ; ?> <strong>to</strong> <?php if($event_detail) echo date('d-m-Y',strtotime($event_detail->event_end_date)) ; ?> </span>
                      </div>

                      <div class="text-left col-sm-12">
                        <strong> <i class="fa fa-calendar" aria-hidden="true"></i> Enroll. Date :</strong> <span><?php if($event_detail) echo date('d-m-Y',strtotime($event_detail->application_start_date)) ; ?> </span> <strong>to</strong> <span><?php if($event_detail) echo date('d-m-Y',strtotime($event_detail->application_end_date)) ?> </span>
                      </div>
                      <div class="text-left col-sm-12">
                        <i class="fa fa-clock-o" aria-hidden="true"></i> <strong>Timings :</strong> <span data-original-title="" title=""><?php if($event_detail) echo $event_detail->event_start_time ; ?><strong>to</strong> <?php if($event_detail) echo $event_detail->event_end_time ; ?></span>
                      </div>

                      <div class="text-left col-sm-12">
                        <strong>Available/Total Booking : <span class="countevent"><?=$booked_event_count;?>/<?php if($event_detail) echo $event_detail->event_max_capicity_per_day ; ?></span></strong>
                      </div>


                    </div>
                  </div>
                  <div class="detail-right-div info-div">
                    <p class="info-label"> LOCATION </p>
                    <p class="locationTextData"><?php if($event_detail) echo $event_detail->event_venue ; ?><br><?php if($event_detail) echo $event_detail->event_city; ?> </p>
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
          if(isset($event_gallery) && !empty($event_gallery)){
           foreach ($event_gallery as $gallery) { ?>
                  <div class="item">

                    <img src="<?=base_url('assets/public/images/event/gallery/'.$gallery->image);?>">
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
        <h4 class="request-head mb-0">Enquire</h4><button style="top:0px" type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
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

          <div class="col-md-6">
            <div class="form-group bmd-form-group">
              <label for="usercity" class="bmd-label-floating">Subject</label>
              <input type="text" class="form-control" id="usersubject" onkeyup="leftTrim(this)">
              <input type="hidden" class="" id="event_id" value="<?=$event_detail->event_id;?>">
               <input type="hidden" class="" id="fac_id" value="<?=$event_detail->fac_id;?>">
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





      </body>


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

      <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

      <script>
         var lat = '<?= $event_detail->event_latitude ; ?>';
         var lng = '<?=$event_detail->event_longitude;?>';
       
  $('#addr').append('<iframe   width="100%"   height="450"    frameborder="0"   scrolling="no"   marginheight="0"   marginwidth="0"   src="https://maps.google.com/maps?q='+lat+','+lng+'&hl=en&z=14&amp;output=embed" > </iframe>');


        jQuery("#addReviews .fa-star").on("click", function(){jQuery("#addReviews .fa-star").removeClass("staractive"); jQuery(this).addClass("staractive"); jQuery(this).prevAll().addClass("staractive");});

        var maxLength = 500;
        $('textarea').keyup(function() {
          var textlen = maxLength - $(this).val().length;
          $('#rchars').text(textlen);
        });

        $("#enquiresubmit").on("click", function(){
          var enquirename = $("#username1").val();
          if(enquirename =="")
          {
            $("#errName1").html("Please Enter Name");
            return false;
          }
          else
          {
            swal({
              title: "Thank You!",
              text: "",
              icon: "success",
            });
          }
        });


        $('#reviewaction').on("click", function(){
          swal({
            title: "Thank You!",
            text: "",
            icon: "success",
          }); 

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

  $("#enquiresubmit").on("click", function(){
    var user_role = '<?=$this->session->userdata('user_role')=='1'?>';
    var fac_id = $("#fac_id").val();
    var event_id = $("#event_id").val();

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
    data: {username:enquirename,useremail:useremail,userphone:userphone,usersubject:usersubject,messagefield:messagefield,fac_id:fac_id,event_id:event_id},
    success:function(res){
      if(res!='failed'){
        swal({
          title : 'Enquire added successfully',
          html : '',
          type: 'success'
        }).then((result) => {
          if (result.value) {
                  // $('#rating_message').val('');
                  $('#username1').val(''); 
                  $('#useremail').val('');
                  $('#usersubject').val('');
                  $('#messagefield').val('');
                  // $('#captcha').val('');
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
      </script>
      </html>