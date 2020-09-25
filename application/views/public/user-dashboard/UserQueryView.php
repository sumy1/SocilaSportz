<!DOCTYPE html>
<html>

<head>
    <title>Social Sportz</title>
    
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">  
    <?php $this->load->view('public/common/head');?>
    <style>

    table
    {
        background:#fff;
        margin-bottom: 50px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .modal-backdrop {
        opacity: 0.6 !important
    }

    header {
        background: #000;
    }

    .userdasboard-wrapper {
        margin-top: 120px;
    }

    .search-area:before {
        content: '';
        width: 100%;
        height: 109px;
        background: rgba(255, 255, 255, 0.4);
        left: 0px;
        top: 0px;
        position: absolute;
    }

    .search-wrapper {
        margin-top: 230px;
    }

    .search-area {
        background: url(assets/images/footer_bg.jpg);
    }

    .search-area {
        position: fixed !important;
        margin-bottom: 30px;
        top: 105px;
        height: 105px;
        z-index: 9999999;
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
                            <h1 class="text-center">My Query</h1>
                            <div class="container-fluid roundborder1">
                                <div class="row">
                                    <div class="container">
                                        <div class="table-responsive">
                                            <table class="table1 table-hover table_cust offers_table2" id="userenquiry">
                                                <thead>
                                                    <tr class="bg-grey">
                                                        <th>S.No</th>
                                                        <th>Facility/Event Name</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    if(isset($user_query_listing) && !empty($user_query_listing)){$sn=1;foreach($user_query_listing as $querylistingkey=>$querylistingVal){

                                                    ?>

                                                    <tr class="promoted_data">
                                                        <td class="text-center date_data_item"><span class="participants"><?=$sn;?></span></td>
                                                        <td class="text-left">
                                                            <div class="product_container user_enq_detail clearfix">
                                                                <div class="media2">
                                                                 <?php
                                                                 foreach($user_query_listing[$querylistingkey]->facility_name as $facilit_name){
                                                                 ?>
                                                                 <div class="media-body"><?=$facilit_name->fac_name;?></div>
                                                                


                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td class="text-center date_data_item"><span><?=$querylistingVal->query_title;?></span></td>
                        <td class="text-center date_data_item"><span class="participants"><?php echo substr($querylistingVal->query_message,0,10);?></span><?php if(strlen($querylistingVal->query_message)>10){ ?><a href="javascript:void(0)" data-toggle="modal" data-target="#readMoreModal" class="custmer_link1" title="Click here to view user enquiry"> <span class="view_moress"><input type="hidden" id="query_id" name="" value="<?=$querylistingVal->query_id;?>">Read More...</span></a><?php } ?></td>
                        <td class="text-center price_data_item"><span class="participants red"><?php echo  date("d-M-Y", strtotime($querylistingVal->create_on));?></span></td>
                    </tr>








                    <?php
                    $sn++;
                }}
                ?>

            </tbody>
        </table>
    </div>
</div>



</div>


 <div class="modal fade modal_default view_deal edit_profile_modal" id="readMoreModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg ajax_query" role="document">
  
</div>
</div>

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
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).on("click",'.view_moress',function(){
	var query_id= $(this).find('#query_id').val();
				$.ajax({
				type: "POST",
				//async: true,
				url:'<?php echo base_url();?>dashboard/ajax_query_model',    
				data: {query_id:query_id},
				success:function(res){
					// alert(res);
				$(".ajax_query").html(res['_html']);

					  }              
				});

	
	
	 
});
     $('#userenquiry').DataTable();
 </script>
</body>




</html>