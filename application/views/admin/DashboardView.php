<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head');?> 

	<style>
		.card {
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
    box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
}

.text-white {
    color: #fff!important;
}

.bg-primary {
    background-color: #0089cd!important;
}




.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid #dee2e6;
    border-radius: .25rem;
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}


.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

.mini-stat .mini-stat-img {
    width: 58px;
    height: 58px;
    line-height: 58px;
    background: rgba(255,255,255,.15);
    border-radius: 4px;
    text-align: center;
}

.float-left {
    float: left!important;
}

.font-size-16 {
    font-size: 16px!important;
}

.text-white-50 {
    color: rgba(255,255,255,.5)!important;
}

.text-uppercase {
    text-transform: uppercase!important;
}

.font-weight-medium {
    font-weight: 500;
}
.font-size-24 {
    font-size: 24px!important;
}

.mini-stat .mini-stat-label {
    position: absolute;
    right: 0;
    top: 18px;
    padding: 2px 10px 2px 32px;

}

p.mb-0
{

	font-size: 15px;
}

.mini-stat .mini-stat-img img {
    max-width: 32px;
}

.mr-4, .mx-4 {
    margin-right: 1.5rem!important;
}

	</style>	

	<body class="no-skin">
		<?php $this->load->view('admin/includes/header');?> 

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<?php $this->load->view('admin/includes/sidebar');?> 
			

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
					

						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									
								</small>
							</h1>
						</div><!-- /.page-header -->

<div class="row">
                            <div class="col-sm-3">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="https://vibestest.com/wip_projects/development/socialsportz-dev/assets/admin/images/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Booking</h5>
                                            <h4 class="font-weight-medium font-size-24"><?=$totalBookingCount; ?> <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label ">
                                                <p class="mb-0">
                                                Slot - <?=$CountBookingSlot; ?><br>
                                                Batch - <?=$CountBookingBatch; ?><br>
                                                Event - <?=$CountBookingEvent; ?>
                                            </p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Overall Booking</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="https://vibestest.com/wip_projects/development/socialsportz-dev/assets/admin/images/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Revenue</h5>
                                            <h4 class="font-weight-medium font-size-24"><?=$RevinewAmount[0]->total_amount;?><i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
                                            <div class="mini-stat-label ">
                                               <p class="mb-0">
                                                Slot - <?=$RevinewFacilitySlot[0]->slot_amount;?><br>
                                                Batch - <?=$RevinewAcademyBatch[0]->Batch_amount;?><br>
                                                Event - <?=$RevinewEvent[0]->event_amount;?>
                                            </p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Overall Revenue</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="menu-icon fa fa-user" style="font-size: 27px; margin-top: 15px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">User</h5>
                                            <h4 class="font-weight-medium font-size-24"><?=$CountUser;?><i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label ">
                                               <p class="mb-0">
                                                End User -  <?=$CountEndUser;?><br>
                                                Facility - <?=$CountFacilityUser;?> <br>
                                               
                                            </p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Overall User</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                            	<i class="menu-icon fa fa-university" style="font-size: 23px; margin-top: 15px;"></i>
                                                
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total</h5>
                                            <h4 class="font-weight-medium font-size-24"><?=$totalFacilityCount+$CountEvent;?><i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label ">
                                               <p class="mb-0">
                                                Facility - <?=$CountFacilitySlot;?><br>
                                                Academy - <?=$CountAcademyBatch;?> <br>
                                                Events - <?=$CountEvent;?> <br>
                                               
                                            </p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Faility/academy/event</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-3">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="fa fa-envelope" style="font-size: 23px; margin-top: 15px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Queries</h5>
                                            <h4 class="font-weight-medium font-size-24"><?=$CountUserQuery;?> <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label ">
                                               <p class="mb-0">
                                                <!--Latest - <?=count($CountUserQueryLimit);?>-->
												Latest <?=$CountUserQuery;?>
												<br>
                                             
                                               
                                            </p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Contact Queries</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							 <div class="col-sm-3">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="fa fa-envelope" style="font-size: 23px; margin-top: 15px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Career</h5>
                                            <h4 class="font-weight-medium font-size-24"><?=$CountCareer;?> <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label ">
                                               <p class="mb-0">
                                               
                                                Latest - <?=count($CountCareer);?><br>
                                            </p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Career Queries</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
						<!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			<?php $this->load->view('admin/includes/footer');?> 
			
			
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/includes/foot');?> 
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>
	</body>
</html>
