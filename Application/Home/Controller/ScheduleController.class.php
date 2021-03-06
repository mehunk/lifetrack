<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 待办事项控制器
 * 显示、增加、删除待办事项
 */
class ScheduleController extends Controller {
	/**
	 * 显示指定日期的待办事项，默认为当天
	 * @return null
	 */
	public function index() {
		$search_date = I('search_date', date('Y-m-d'), 'trim');
		$this->assign('search_date', $search_date);

		//日期列表
		$date_list = M('schedule')->distinct(true)->order('sd_date desc')->getField('sd_date', true);
		//类别列表
		$category_list = M('category')->where(array('cg_display' => '1'))->select();
		//待办事项列表
		$sd_list = D('scheduleView')->where(array('sd_date' => $search_date))->order('sd_starttime')->select();

		$this->assign('date_list', $date_list)
			->assign('category_list', $category_list)
			->assign('sd_list', $sd_list)
			->display();
	}

	/**
	 * 保存待办事项
	 * @return null
	 */
	public function save() {
		$schedule_info = I('post.');
		if(!$schedule_info['sd_id'])
			$sd_id = M('schedule')->add($schedule_info);
		else
			$sd_id = M('schedule')->data($schedule_info)->save();
		$this->ajaxReturn($sd_id);
	}

	/**
	 * 删除待办事项
	 * @return null
	 */
	public function delete() {
		$condition = I('get.');
		if(M('schedule')->where($condition)->delete())
			$this->success();
	}

	/**
	 * 完成待办事项
	 * @return null
	 */
	public function complete() {
		$condition = I('get.');
		if(M('schedule')->where($condition)->setField('sd_complete', 1))
			$this->success();
	}
	
	/**
	 * 获取事项信息
	 * @return null
	 */
	public function getSdInfo() {
		$sd_id = I('sd_id');
		$sdInfo = M('schedule')->find($sd_id);
		$this->ajaxReturn($sdInfo);
	}
	
	/**
	 * 获取事项详细信息
	 * @return null
	 */
	public function getDetail() {
		$sd_id = I('sd_id');
		$detail = M('schedule')->where(array('sd_id' => $sd_id))->getField('sd_eventdetail');
		$this->ajaxReturn($detail);
	}

	/**
	 * 按照时间轴来展示当日事件
	 * @return null
	 */
	public function timeline() {
		$search_date = I('search_date', date('Y-m-d'), 'trim');
		$sd_list = M('schedule')->where(array('sd_date' => $search_date))->order('sd_starttime')->getField('sd_id,sd_starttime,sd_plantime,sd_eventdesc,sd_eventdetail');
		$this->assign('sd_list', $sd_list)->display();
	}
}
?>