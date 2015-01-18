$(document).ready(function() {
	$.getJSON(chartDataUrl, function(data) {
		$('#container').highcharts({
					credits: {
						enabled: false
					}, 
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: 1,//null,
				plotShadow: false
			},
			title: {
				text: '时间记录比例'
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
			series: [{
				type: 'pie',
				name: 'Browser share',
				data: data
			}]
		});
	});
});