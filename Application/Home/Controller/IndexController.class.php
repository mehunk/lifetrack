<?php
namespace Home\Controller;
use Think\Controller;
/**
 *时间记录控制器
 *显示、新建、保存、删除时间记录
 */
class IndexController extends Controller {
	/**
	 * 显示指定日期的时间记录，默认显示当天
	 * @return null
	 */
	public function index() {
		//获取指定日期，默认为当天
		$search_date = I('search_date', date('Y-m-d'), 'trim');
		$this->assign('search_date', $search_date);

		//时间记录列表
		$er_list = D('eventrecordView')->where(array('er_date' => $search_date))->order('er_starttime')->select();

		$this->assign('date_list', $date_list)->assign('er_list', $er_list)->display();
	}

	/**
	 * 显示新建时间记录页面
	 * @return null
	 */
	public function edit() {
		$lastItem = D('eventrecordView')->order('er_id desc')->limit(1)->find(); //最后一条时间记录

		$schedule_list = M('schedule')->where(array('sd_date' => date('Y-m-d'), 'sd_complete' => 0))->select(); //待办事项列表
		//判断时间记录进度
		if($lastItem['er_endtime'] || !$lastItem) {//如果有结束时间或者数据表为空，则无中断事件记录
			$pageStep = 0;
		} else if($lastItem['er_sdid']) { //如果没有结束时间，有事件描述
			$pageStep = 2;
		} else { //如果没有结束时间，没有时间描述
			$pageStep = 1;
		}

		$this->assign('pageStep', $pageStep)->assign('lastItem', $lastItem)->assign('schedule_list', $schedule_list)->display();
	}

	/**
	 * 保存时间记录
	 * 1、开始时间 2、事件描述 3、结束时间
	 * @return null
	 */
	public function save() {
		$eventItem = I('post.');

		//判断要保存的是哪种数据？开始时间、时间描述、结束时间
		if(isset($eventItem['er_starttime'])) { //日期、开始时间
			$eventItem['er_date'] = date('Y-m-d');
			M('eventrecord')->add($eventItem);
		}
		else if(isset($eventItem['er_sdid'])) { //计划事件
			M('eventrecord')->where('er_endtime is null')->save($eventItem);
		}
		else if(isset($eventItem['sd_eventdesc'])) { //临时事件
			$eventItem['sd_date'] = date('Y-m-d');
			$eventItem['sd_plan'] = 0;
			$eventItem['sd_cgid'] = 0;
			$er_sdid = M('schedule')->add($eventItem);
			M('eventrecord')->where('er_endtime is null')->setField('er_sdid', $er_sdid);
		}
		else if(isset($eventItem['er_endtime'])) { //结束时间
			$last = M('eventrecord')->where('er_endtime is null')->find();
			if($last['er_starttime'] < $eventItem['er_endtime']) //如果开始、结束日期为同一天
				M('eventrecord')->where('er_endtime is null')->save($eventItem);
			else { //如果结束日期为第二天
				//将该事件分成两个，前一日的结束时间设置为23:59:59
				M('eventrecord')->where('er_endtime is null')->save(array('er_endtime' => '23:59:59'));
				//当日的开始时间设置为0:0:0，结束时间设置为当前结束时间，日期设置为当前日期
				$new = array('er_starttime' => '00:00:00',
					'er_endtime' => $eventItem['er_endtime'],
					'er_date' => date('Y-m-d')
					'er_sdid' => $last['er_sdid']);
				M('eventrecord')->add($new);
			}
		}

	}

	/**
	 * 按照时间轴来展示当日事件
	 * @return null
	 */
	public function timeline() {
		$search_date = I('search_date', date('Y-m-d'), 'trim');
		$er_list = D('eventrecordView')->where(array('er_date' => $search_date))->getField('er_id,er_date,er_starttime,er_sddesc,er_sddetail');
		$this->assign('er_list', $er_list)->display();
	}
}
