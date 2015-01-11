<?php
namespace Home\Model;
use Think\Model\ViewModel;

class ScheduleViewModel extends ViewModel {
	public $viewFields = array(
		'Schedule' => array('sd_id', 'sd_eventdesc', 'sd_cgid', 'sd_date', 'sd_starttime', 'sd_plantime', 'sd_importance', 'sd_urgency', 'sd_plan', 'sd_complete'),
		'Category' => array('cg_name' => 'sd_cgname', 'cg_time' => 'sd_cgtime', '_on'=>'Schedule.sd_cgid=Category.cg_id'),
	);
}
?>