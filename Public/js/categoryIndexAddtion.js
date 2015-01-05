$(document).ready(function() {
	$('#myModal').on('hidden.bs.modal', function (e) {
		$('#id').val(0);
		$('#name').val('');
		$('#time').val('');
	});

	//保存事项分类
	$('#saveCategory').click(function() {
		$.post(postUrl, {
			cg_id: $('#id').val(),
			cg_name: $('#name').val(),
			cg_time: $('#time').val()
		}, function(data) {
			if($('#id').val() == 0) {
				$doBtn = $('<td><a href="edit-' + data + '" class="btn btn-primary btn-sm">修改</a> <a href="delete-' + data + '" class="btn btn-danger btn-sm">删除</a></td>');
				$displayBtn = $('<td><a href="display-' + data + '" class="btn btn-default btn-sm">禁用</a></td>');					
				//$displayBtn = $('<td></td>').append($('<a></a>').attr({'href': "display-" + data, 'class': 'btn btn-default btn-sm'}).text('禁用'));
				var $category_info = $('<tr></tr>')
										.addClass('success')
										.append('<td>new</td>')
										.append('<td>' + $('#name').val() + '</td>')
										.append('<td>' + $('#time').val() + '</td>')
										.append($displayBtn)
										.append($doBtn);
				$category_info.appendTo($('tbody'));
				$('#myModal').modal('hide');
			} else {
				$('#tr-' + $('#id').val()).find('td:eq(1)').text($('#name').val());
				$('#tr-' + $('#id').val()).find('td:eq(2)').text($('#time').val());
				$('#tr-' + $('#id').val()).addClass('success');
				$('#myModal').modal('hide');
			}	
		});
	});

	//点击操作中的按钮后执行不同操作
	$('tbody').click(function(event) {
		var $clickTarget = $(event.target);
		if($clickTarget.is('a')) {
			event.preventDefault();
			var aHrefArray = ($clickTarget.attr('href')).split('-');
			if(aHrefArray[0] == 'delete') {
				$.get(deleteUrl, {
					cg_id: aHrefArray[1]
				}, function() {
					$clickTarget.parents('tr').remove();
				});
			} else if(aHrefArray[0] == 'display') {
				$.get(displayUrl, {
					cg_id: aHrefArray[1]
				}, function() {
					var status = $clickTarget.text();
					if(status == '显示') {
						$clickTarget.removeClass().addClass('btn btn-default btn-sm').text('禁用');
					} else {
						$clickTarget.removeClass().addClass('btn btn-primary btn-sm').text('显示');
					}
				});
			} else {
				$('#id').val(aHrefArray[1]);
				$('#name').val($clickTarget.parents('tr').find('td:eq(1)').text());
				$('#time').val($clickTarget.parents('tr').find('td:eq(2)').text());
				$('#myModal').modal('show');
			}
		}
	});
})