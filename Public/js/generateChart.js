$(document).ready(function() {
	var options = {
		chart: {
			renderTo: 'container',
			plotBorderWidth: 1,
			type: 'pie'
		},
		title: {
			text: null
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		credits: {
			enabled: false
		}, 
		series: [{}],
	};
	
	$.getJSON(chartDataUrl, {search_date: search_date}, function(data) {
		options.series[0].data = data;
		var chart = new Highcharts.Chart(options);
	});
});