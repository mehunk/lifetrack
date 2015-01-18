<?php
namespace Home\Controller;
use Think\Controller;
/**
 *时间分析控制器
 *从不同维度分析计划、时间的各项数据
 */
class AnalysisController extends Controller {
	/**
	 * 显示指定日期的记录和不记录
	 * @return null
	 */
	public function index() {
		$search_date = I('search_date', date('Y-m-d'), 'trim');
		$this->assign('search_date', $search_date)->display();
	}

	/**
	 * 获取图表数据
	 * @return json
	 */
	public function getChartData() {
		$day_sec = 24 * 60 * 60;
		$search_date = I('search_date', date('Y-m-d'), 'trim');
		$rec_sec = M('eventrecord')->where(array('er_date' => $search_date))->sum('er_eventtime');
		$ajax_data = array(
			array('记录时间', (int)($rec_sec / $day_sec * 100)),
			array('未记录时间', (int)((1 - $rec_sec / $day_sec) * 100))
			);

		$this->ajaxReturn($ajax_data, 'json');
	}
}
