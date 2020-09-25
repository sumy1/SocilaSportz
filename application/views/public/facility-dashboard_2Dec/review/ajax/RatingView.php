<?php
                                    /*Rating Progress Shahbaz Khan 28-09-2019*/
                                    $totRat = $total_5_review + $total_4_review + $total_3_review + $total_2_review + $total_1_review;
                                    if($totRat != ''){
                                        $Rat5Perc = round(($total_5_review / $totRat) * 100);
                                        $Rat4Perc = round(($total_4_review / $totRat) * 100);
                                        $Rat3Perc = round(($total_3_review / $totRat) * 100);
                                        $Rat2Perc = round(($total_2_review / $totRat) * 100);
                                        $Rat1Perc = round(($total_1_review / $totRat) * 100);
                                    }
                                    if(!empty($Rat5Perc)){
                                        $Rat5Val = $Rat5Perc;
                                    }
                                    else{
                                        $Rat5Val = 0;
                                    }
                                    if(!empty($Rat4Perc)){
                                        $Rat4Val = $Rat4Perc;
                                    }else{
                                        $Rat4Val = 0;
                                    }
                                    if(!empty($Rat3Perc)){
                                        $Rat3Val = $Rat3Perc;
                                    }else{
                                        $Rat3Val = 0;
                                    }
                                    if(!empty($Rat2Perc)){
                                        $Rat2Val = $Rat2Perc;
                                    }else{
                                        $Rat2Val = 0;
                                    }
                                    if(!empty($Rat1Perc)){
                                        $Rat1Val = $Rat1Perc;
                                    }else{
                                        $Rat1Val = 0;
                                    }

                                    ?>
<div class="review_container_rating clearfix">
	<div class="rating_range_container">
		<ul class="list-unstyled mb-0">
			<li>
				<div class="star_count">5 <i class="fa fa-star"></i></div>
				<div class="rating_bar">
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?=$Rat5Val;?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="count_num"><?=$total_5_review;?></div>
			</li>
			<li>
				<div class="star_count">4 <i class="fa fa-star"></i></div>
				<div class="rating_bar">
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?=$Rat4Val;?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="count_num"><?=$total_4_review;?></div>
			</li>
			<li>
				<div class="star_count">3 <i class="fa fa-star"></i></div>
				<div class="rating_bar">
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?=$Rat3Val;?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="count_num"><?=$total_3_review;?></div>
			</li>
			<li>
				<div class="star_count">2 <i class="fa fa-star"></i></div>
				<div class="rating_bar">
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?=$Rat2Val;?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="count_num"><?=$total_2_review;?></div>
			</li>
			<li>
				<div class="star_count">1 <i class="fa fa-star"></i></div>
				<div class="rating_bar">
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?=$Rat1Val;?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="count_num"> <?=$total_1_review;?></div>
			</li>
		</ul>
	</div>
	<?php $total_rating =($total_5_review*5) + ($total_4_review*4) + ($total_3_review*3) + ($total_2_review*2) + ($total_1_review*1);
	$avg_rating=0;
	 ?>
	<div class="overall_rating_data text-center">
		<h1 class="rate__count"><?php if($total_review>0) echo $avg_rating= round($total_rating/$total_review,1);?></h1>
		<div class="rating">
			<ul class="list-inline">

				<li class="list-inline-item <?php if($avg_rating>0) echo "active" ?>"><i class="fa fa-star"></i></li>
				<li class="list-inline-item <?php if($avg_rating>1.5) echo "active" ?>"><i class="fa fa-star"></i></li>
				<li class="list-inline-item <?php if($avg_rating>2.5) echo "active" ?>"><i class="fa fa-star"></i></li>
				<li class="list-inline-item <?php if($avg_rating>3.5) echo "active" ?>"><i class="fa fa-star"></i></li>
				<li class="list-inline-item <?php if($avg_rating>4.5) echo "active" ?>"><i class="fa fa-star"></i></li>
			</ul>
		</div>
		<p><?=$total_review;?> Rating</p>
	</div>
</div>