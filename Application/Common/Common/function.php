<?php
//将时间持续时间秒单位转换为小时:分钟:秒格式
function secondToTime($totalSecond) {
	$hours = intval($totalSecond/3600);
	$minutes = intval($totalSecond%3600/60);
	$seconds = $totalSecond%60;

	return str_pad($hours, 2, '0', STR_PAD_LEFT) . ":" . str_pad($minutes, 2, '0', STR_PAD_LEFT) . ":" . str_pad($seconds, 2, '0', STR_PAD_LEFT);

}

function secondToMinute($totalSecond) {
	$minutes = intval($totalSecond/60);
	
	return $minutes;
}
?>