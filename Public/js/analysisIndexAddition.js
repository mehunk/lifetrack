$(document).ready(function() {
	//初始化datepicker插件
	$('#search_date>input').datepicker({
		format: "yyyy-mm-dd",
		weekStart: 1,
		language: "zh-CN",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true
	});

	$('#search_date button').click(function(event) {
		event.preventDefault();
		var url = indexUrl + '/search_date/' + $('#search_date>input').val();
		location.href = url;
	})
})