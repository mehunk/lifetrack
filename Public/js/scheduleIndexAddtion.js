$(document).ready(function() {
	$('.clockpicker').clockpicker({autoclose: true});

	$('#myModal').on('hidden.bs.modal', function (e) {
		$('#myModal input[type!="checkbox"],#detail').val('');
		$('#myModal select').val(1);
		$('#myModal input[type="checkbox"]').bootstrapSwitch('state', false);
	});

	//初始化datepicker插件
	$('.input-group.date').datepicker({
		format: "yyyy-mm-dd",
		weekStart: 1,
		language: "zh-CN",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true
	});
	
	//初始化bootstrapSwitch插件
	$('input[type="checkbox"]').bootstrapSwitch();

	$('#search li').click(function(event) {
		event.preventDefault();
		var url = $(this).find('a').attr('href') + '/search_date/' + $('#search_date').val();
		location.href = url;
	})
	
	//保存待办事项
	$('#saveSchedule').click(function() {
		$.post(postUrl, {
			sd_id: $('#id').val(),
			sd_eventdesc: $('#eventdesc').val(),
			sd_cgid: $('#category').val(),
			sd_date: $('#date').val(),
			sd_plantime: $('#plantime').val(),
			sd_starttime: $('#starttime').val(),
			sd_importance: function() {
				return $('#importance').prop('checked')? 1 : 0;
			},
			sd_urgency: function() {
				return $("#urgency").prop('checked')? 1 : 0;
			},
			sd_eventdetail: $('#detail').val()
		}, function(data) {
			var $label = $('<td></td>');
			var $importanceLabel = $('<span class="label label-success">重要</span>');
			var $urgencyLabel = $('<span class="label label-danger">紧急</span>');
				
			if(!$('#id').val()) {
				$doBtn = $('<td><a class="btn btn-primary btn-sm" href="edit-' + data + '">编辑</a> '
					+ '<a class="btn btn-danger btn-sm" href="delete-' + data + '">删除</a> '
					+ ' <a class="btn btn-success btn-sm" href="complete-' + data + '">完成</a></td>');
				
				if($('#importance').prop('checked'))
					$label.append($importanceLabel).append(' ');
				if($('#urgency').prop('checked'))
					$label.append($urgencyLabel);
				var $schedule_info = $('<tr></tr>')
										.addClass('success')
										.append('<td>new</td>')
										.append('<td>' + $('#eventdesc').val() + '</td>')
										.append('<td>' + $('#starttime').val() + '</td>')
										.append('<td>' + $('#plantime').val() + '</td>')
										.append($label)
										.append('<td>' + $('select#category option:selected').text() + '</td>')
										.append('<td>计划</td>')
										.append($doBtn);
				$schedule_info.appendTo($('tbody'));
			} else {
				var $tr = $('#tr-' + $('#id').val());
				if($('#importance').prop('checked'))
					$label.append($importanceLabel);
				if($('#urgency').prop('checked'))
					$label.append($urgencyLabel);
				$tr.find('td:eq(1)').text($('#eventdesc').val());
				$tr.find('td:eq(2)').text($('#plantime').val());
				$tr.find('td:eq(3)').text($('#plantime').val());
				
				$tr.find('td:eq(4)').html('');
				if($('#importance').prop('checked'))
					$tr.find('td:eq(4)').append($importanceLabel).append(' ');
				if($('#urgency').prop('checked'))
					$tr.find('td:eq(4)').append($urgencyLabel);

				$tr.find('td:eq(5)').text($('#category').find('option[value="' + $('#category').val() + '"]').text());
				$tr.addClass('success');
			}
			$('#myModal').modal('hide');			
		});
	});

	//点击删除按钮后删除待办事项
	$('tbody').click(function(event) {
		var $clickTarget = $(event.target);
		if($clickTarget.is('a')) {
			event.preventDefault();
			var aHrefArray = ($clickTarget.attr('href')).split('-');
			if(aHrefArray[0] == 'delete') {
				
				$.get(deleteUrl, {
					sd_id: aHrefArray[1]
				}, function() {
					$clickTarget.parents('tr').remove();
				});
			} else if(aHrefArray[0] == 'complete') {
				$.get(completeUrl, {
					sd_id: aHrefArray[1]
				}, function() {
					$clickTarget.parents('tr').find('td:eq(1)').html(function(index, oldContent) {
						return '<del>' + oldContent + '</del>';
					});
				});
			} else {
				$.get(getSdInfoUrl, {
					sd_id: aHrefArray[1]
				}, function(data) {
					$('#id').val(data.sd_id);
					$('#category').val(data.sd_cgid);
					$('#eventdesc').val(data.sd_eventdesc);
					$('#date').val(data.sd_date);
					$('#plantime').val(data.sd_plantime);
					$('#detail').val(data.sd_eventdetail);
					$('#myModal').modal('show');
					if(data.sd_importance == 1) $('#importance').bootstrapSwitch('state', true);
					if(data.sd_urgency == 1) $('#urgency').bootstrapSwitch('state', true);
				});
			}
		} else if($clickTarget.is('td:nth-child(2)>*') || $clickTarget.is('td:nth-child(2)')) {
			var aHrefArray = ($clickTarget.parents('tr').attr('id')).split('-');
			$.get(getDetailUrl, {
				sd_id: aHrefArray[1]
			}, function(data) {
				$('#detailModal p').text(data);
				$('#detailModal').modal('show');
			});
		}
	});
})