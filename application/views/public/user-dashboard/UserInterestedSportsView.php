	<!DOCTYPE html>
	<html>

	<head>
		<title>Social Sportz</title>
		
		
		<?php $this->load->view('public/common/head');?>
		<style>
			#sportsubmit {
    padding: 10px 25px;
}
		.modal-backdrop{opacity: 0.6 !important}
		header{
			background: #000;
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


	</style>
	

</head>

<body>
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
							</div>					</div>
							<div class="col-sm-8">
								<h1>Interested Sports</h1>
								<div id="multiplesportspopup" >
									<ul style="height: inherit">
						<?php
						if (isset($user_sport_list)  && !empty($user_sport_list)) {		
					        foreach ($user_sport_list as $sports) {
					        //	echo "<pre>";
					       // print_r($sports); 

								?>
										
										<li class="selected">
											<i class="fa fa-check-circle varified"></i>
											<?php foreach ($sports->master_sport as $sportdata) { ?>
											<img src="<?=base_url('assets/public/images/sports/'.$sportdata->sport_icon);?>">
											
											
												<span class="sport_name"><?=$sportdata->sport_name?></span>
											<?php } ?>
											
										</li>
										<?php } } ?>
										
										
									</ul>

									<div class="clearfix"></div>

									<div class="col-sm-12 text-right"><a class="btn-info orange-btn editsportsbtn" data-toggle="modal" data-target="#calandarselectsport">Edit Sports List</a></div>
								</div>							


							</div>
						</div>
					</section>

					<div class="modal fade edit_profile_modal show" id="calandarselectsport" role="dialog" style="padding-right: 17px; ">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" style="top:13px;" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title pl-3" id="exampleModalLongTitle">Select interested sport</h5>
			</div>
			<div class="modal-body">
				<div class="error">
				</div>
				<div id="multiplesportspopup">


					<ul>
						<?php
						if (isset($sport_list)  && !empty($sport_list)) {
						$idArr=array();
                        foreach ($user_sport_list as $valIdes) {
                        $idArr[]=  $valIdes->sport_id;
                      }
					foreach ($sport_list as $sports) { 
								?>
						<li class="<?php if(in_array($sports->sport_id, $idArr)){echo "selected";} ?>">
							<i class="fa fa-check-circle varified"></i>
							<img src="<?=base_url('assets/public/images/sports/'.$sports->sport_icon);?>">
							<input type="checkbox" class="sport_id" name="sport_id" value="<?=$sports->sport_id;?>" <?php if(in_array($sports->sport_id, $idArr)){echo "checked";} ?>>
							<span class="sport_name"><?=$sports->sport_name;?></span>
						</li>
					<?php } } ?>
						
					</ul>

					<div class="clearfix"></div>

					<div class="col-sm-12 text-right"><a class="btn-info orange-btn" id="sportsubmit">Update</a></div>
				</div>
			</div>

			<div class="modal-footer"></div>

		</div>
	</div>
</div>


<div class="loader">
				<div class="">
					<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
				</div>
			</div>
					<?php $this->load->view('public/common/footer');?>
					
					<?php $this->load->view('public/common/foot');?>
				</body>

				<script>
					jQuery('header').removeClass("blackbg");
					$(window).scroll(function() {
		if ($(this).scrollTop() > 100) { // this refers to window
			jQuery('header').addClass("blackbg");
		}

		else
		{
			jQuery('header').removeClass("blackbg");
		}
	});

					$(document).on("click", "#calandarselectsport #multiplesportspopup li", function(){$(this).addClass("selected"); $(this).find("input").attr("checked","checked")});

					$(document).on("click", "#calandarselectsport #multiplesportspopup li.selected", function(){$(this).removeClass("selected"); $(this).find("input").removeAttr("checked")});


					$("#sportsubmit").on("click", function(){
		var ttt = $(".sport_id:checked").length;
		var sport_id=[];
		$(".sport_id:checked").each(function() {
		sport_id.push($(this).val());
		});
		//var amenity_ids = amenity_id.join(',') ;
		if(ttt == 0){
			$(".error").html("Please select at least one sports");
			return false;
		}
		else
		{
			$(".error").html('');
		}
			$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>dashboard/insert_interested_sport',	
			data: {sport_ids:sport_id},
			success:function(res){
				if(res==1){
					 swal({
					        title : 'Interested sports updated',
					        html : '',
					        type: 'success'
					    }).then((result) => {
					        if (result.value) {
					        	$('#calandarselectsport').modal('hide');
					        	window.location.href = '<?php echo base_url('dashboard/user_interested_sport') ?>';
					        }
					    })
				}
				else{
					swal({
					        title : 'Network Issuee!',
					        html : '',
					        type: 'warning'
					    }).then((result) => {
					        if (result.value) {
					        	$('#calandarselectsport').modal('hide');
					        }
					    })
				}
			}	
		});

	});

				</script>



				</html>