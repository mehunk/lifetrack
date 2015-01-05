$(document).ready(function() {
	//记录setInterval()返回的 ID 值
	var eventtime_handle = 0;

	//字符串前补0
	function padLeft(str) {
		var length = 2;
		if (str.toString().length >= length) 
			return str;
		else
			return padLeft("0" + str, length);
	}

	//得到当前时间
	function getTime() {
		var newDate = new Date(jQuery.now());
		var time = padLeft(newDate.getHours()) + ":" + padLeft(newDate.getMinutes()) + ":" + padLeft(newDate.getSeconds());
		return time;
	}

	//得到事件持续时间
	function getEventTime() {
		var newDate = new Date(jQuery.now());
		var timeArr = starttime.split(':');
		var eventHours = newDate.getHours() - parseInt(timeArr[0]);
		var eventMinutes = newDate.getMinutes() - parseInt(timeArr[1]);
		var eventSeconds = newDate.getSeconds() - parseInt(timeArr[2]);

		if(eventSeconds < 0) {
			eventSeconds += 60; eventMinutes--;
		}
		if(eventMinutes < 0) {
			eventMinutes += 60; eventHours--;
		}
		if(eventHours < 0) {
			eventHours += 24;
		}
		
		var eventTime = padLeft(eventHours) + ":" + padLeft(eventMinutes) + ":" + padLeft(eventSeconds);
		return eventTime;
	}

	//判断事件记录的进度
	//通过在主页面被赋值的一个状态变量取得新建时间的阶段，1：初始页面；2：填写事件描述页面；3：点击结束计时页面；
	if(pageStep != 0) { //如果最后一条时间记录没有事件描述
		//将开始时间设置为数据库开始时间
		$('#starttime').text(starttime);

		//跳动持续时间，以开始时间为起点
		eventtime_handle = setInterval(function() {
			$('#eventtime').text(getEventTime());
		}, 1000);

		//改变计时按钮外观
		$('#timeBtn').removeClass('btn-default').addClass('btn-danger').text('结束计时');

		//如果未填写事件表单
		if(pageStep == 1) {
			//显示事件描述表单
			$('#event').show();
		} else {
			$('#timer p:eq(0)').text(eventdesc).show();
		}
	} else { 
		//界面载入时开始时间计时
		$('#starttime').text(getTime());
		var starttime_handle = setInterval(function() {
			$('#starttime').text(getTime());
		}, 1000);
	}

	//onClickStartButton：点击开始计时后按钮设置为不可点击使用ajax提交开始时间，并出现事件描述表单
	function onClickTimeButton() {
		if($(this).text() == '开始计时') { //开始计时
			//停止跳动开始时间
			clearInterval(starttime_handle);

			starttime = $('#starttime').text();

			//将计时按钮设置颜色为红色，文字设置为“计时中”
			$('#timeBtn').removeClass('btn-default').addClass('btn-danger').text('结束计时');

			//使用ajax提交开始时间，成功后显示静止的开始时间，持续时间跳动显示，显示时间描述表单
			$.post(saveUrl, {er_starttime: starttime}, function() {
				eventtime_handle = setInterval(function() {
					$('#eventtime').text(getEventTime());
				}, 1000);

				$('#event').show();
			});
			
		} else { //结束计时
			clearInterval(eventtime_handle); //停止跳动持续时间
			$.post(saveUrl, {er_endtime: getTime()}, function() {
				location.reload();
			});
		}
	}
	$('#timeBtn').on('click', onClickTimeButton);

	//onSubmitEventForm：提交事件描述后将提交按钮设置为不可点击，并使用ajax提交，提交成功后隐藏整个表单
	function onSubmitEventForm(event) {
		event.preventDefault();
		//将提交按钮设置为不可点击
		$('#eventBtn').attr('disabled', 'disabled').text('提交中...');
		//使用ajax提交表单内容，提交成功后隐藏整个表单区域
		if($('#sd_eventdesc').val()) {
			requestData = {sd_eventdesc: $('#sd_eventdesc').val()};
		} else {
			requestData = {er_sdid: $('select option:selected').attr('value')};
		}
		$.post(saveUrl, requestData, function() {
			$('#eventBtn').removeAttr('disabled');
			$('#event').hide();
			$('#timer p:eq(0)').text(function() {
				var eventdesc = ('sd_eventdesc' in requestData)? requestData.sd_eventdesc : $('select option:selected').text();
				return eventdesc;
			}).show();
		});
	}
	$('#eventBtn').on('click', onSubmitEventForm);
	
});