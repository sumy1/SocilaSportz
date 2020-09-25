<!DOCTYPE html>
<html>
<head>
	<title>Social Sportz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<!-- Fonts For Heading & SubHeadings -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php $this->load->view('public/common/head');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css')?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">	
<style>
#chartdiv{width:100%; height:400px;}
#piechart{width:300px; height:400px;}

#chartdiv a{display:none !important;}
</style>
</head>

<body class="dashboard sidebar-is-expanded">
	<div class="clearfix"></div>
	
	<?php $this->load->view('public/common/dashboard-sidebar');?>
	
	<main class="l-main" id="create-slotwrapper">
		
	<div class="collapse show" id="reportsCollapse">
								<div class="cus_modal_body">
<div class="form-group selectdiv is-filled">
												<label for="exampleSelect1" class="bmd-label-floating">Select Sports</label>
												<select class="form-control" id="exampleSelect1" style="max-width:300px;">
													<option>Cricket</option>
                                                    <option>Football</option>											
												</select>
												<i class="fas fa-calendar-alt prefix"></i>
											</div>								
									<div class="row">
                                      
										<div class="col-md-7">
											
											<div id="chartdiv"></div>
										</div>
										
										<div class="col-md-5">
										<div id="piechart"></div>
										</div>
										
										
									</div>										
									
									
								</div>
							</div>
	</main>


<div class="loader">
	<div class="">
		<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
	</div>
</div>	
	

	<!-- Footer Include Here -->
	<?php $this->load->view('public/common/footer');?>

	


<?php $this->load->view('public/common/foot');?>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>

	$(window).on('load',function() {
	$(".loader").fadeOut('slow');
	});

	function showingLoader(){
	$(".loader").fadeIn(200);
	//$(".loader").fadeOut(1000);
	}
	function hiddingLoader(){
	//$(".loader").fadeIn(200);
	$(".loader").fadeOut(1000);
	}
	

		
		
	var chart = AmCharts.makeChart( "chartdiv", {
		"type": "serial",
		"theme": "light",
		"dataProvider": [ {
			"country": "Jan",
			"visits": 2025,
		}, {
			"country": "Feb",
			"visits": 1882
		}, {
			"country": "Mar",
			"visits": 1809
		}, {
			"country": "April",
			"visits": 1322
		}, {
			"country": "May",
			"visits": 1122
		}, {
			"country": "June",
			"visits": 1114
		}, {
			"country": "July",
			"visits": 1882
		}, {
			"country": "Aug",
			"visits": 1809
		}, {
			"country": "Sept",
			"visits": 1322
		}, {
			"country": "Oct",
			"visits": 1122
		}, {
			"country": "Nov",
			"visits": 1114
		}, {
			"country": "Dec",
			"visits": 1114
		}],
		"valueAxes": [ {
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0
		} ],
		"colorField":"#CCCCCC",
		"gridAboveGraphs": true,
		"startDuration": 1,
		"graphs": [ {
			"balloonText": "[[category]]: <b>[[value]]</b>",
			"fillAlphas": 0.8,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "visits"
		} ],
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
			"zoomable": false
		},
		"categoryField": "country",
		"categoryAxis": {
			"gridPosition": "start",
			"gridAlpha": 0,
			"tickPosition": "start",
			"tickLength": 20
		},
		"export": {
			"enabled": false
		}

	} );
</script>


<script>
var chart = am4core.create("piechart", am4charts.PieChart);

// Add data
chart.data = [{
  "heading": "Offline Booking",
  "litres": 501.9
}, {
  "heading": "Online Booking",
  "litres": 301.9
}, {
  "heading": "Remaining Booking",
  "litres": 201.1
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "heading";

pieSeries.ticks.template.disabled = true;
pieSeries.alignLabels = false;
pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
pieSeries.labels.template.radius = am4core.percent(-40);
pieSeries.labels.template.fill = am4core.color("white");

chart.legend = new am4charts.Legend();

setTimeout(function(){
$("g[aria-labelledby='id-61-title'], textpath, #chartdiv a ").hide();
},900);


</script>

<!-- HTML -->


</body>
</html>	