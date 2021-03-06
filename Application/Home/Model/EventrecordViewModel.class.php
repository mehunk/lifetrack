<?php
namespace Home\Model;
use Think\Model\ViewModel;
/**
 * 时间记录显示模型
 * 在时间记录页面显示已发生时间和事项的信息
 */
class EventrecordViewModel extends ViewModel {
	public $viewFields = array(
		'Eventrecord' => array('er_id', 'er_date', 'er_starttime', 'er_endtime', 'er_eventtime', 'er_sdid', '_type' => 'LEFT'),
		'Schedule' => array('sd_eventdesc' => 'er_sddesc', 'sd_eventdetail' => 'er_sddetail', '_on' => 'Eventrecord.er_sdid=Schedule.sd_id', '_type' => 'LEFT'),
		'Category' => array('cg_name' => 'er_cgname', 'cg_time' => 'er_cgtime', '_on'=>'Schedule.sd_cgid=Category.cg_id'),
	);
}


?>
