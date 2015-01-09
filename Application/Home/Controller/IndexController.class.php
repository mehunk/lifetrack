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
	 */
    public function index() {
    	//获取指定日期，默认为当天
    	$search_date = I('search_date', date('Y-m-d'), 'trim');
    	$this->assign('search_date', $search_date);

    	//日期列表
    	$date_list = M('eventrecord')->distinct(true)->order('er_date desc')->getField('er_date', true);
    	//时间记录列表
    	$er_list = D('eventrecordView')->where(array('er_date' => $search_date))->order('er_starttime')->select();

		$this->assign('date_list', $date_list)
			->assign('er_list', $er_list)
			->display();
    }

	/**
	 * 显示新建时间记录页面
	 */
	public function edit() {
		$lastItem = D('eventrecordView')->order('er_id desc')->limit(1)->find(); //最后一条时间记录

		$schedule_list = M('schedule')->where(array('sd_date' => date('Y-m-d'), 'sd_complete' => 0))->select(); //待办事项列表
		//判断时间记录进度
		if($lastItem['er_endtime'] || !$lastItem) {//如果有结束时间，则无中断事件记录
			$pageStep = 0;
		} else if($lastItem['er_sdid']) { //如果没有结束时间，有事件描述
			$pageStep = 2;
		} else { //如果没有结束时间，没有时间描述
			$pageStep = 1;
		}

		$this->assign('pageStep', $pageStep)
			->assign('lastItem', $lastItem)
			->assign('schedule_list', $schedule_list)
			->display();
	}

	/**
	 * 保存时间记录
	 * 1、开始时间 2、事件描述 3、结束时间
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
			M('eventrecord')->where('er_endtime is null')->save($eventItem);
			M('eventrecord')->execute("update __EVENTRECORD__ set er_eventtime = TIMESTAMPDIFF(SECOND, er_starttime, er_endtime) order by er_id desc limit 1");
		}

	}

  //按照时间轴来展示当日事件
  public function timeline() {
    $search_date = '2015-1-8';
    $er_list = D('eventrecordView')->where(array('er_date' => $search_date))->getField('er_id,er_date,er_starttime,er_sddesc,er_sddetail');
    foreach($er_list as $key => $item) {
      echo date('H:i', strtotime($item['er_starttime']);
    } die;
    $this->assign('er_list', $er_list)->display();
  }
}
