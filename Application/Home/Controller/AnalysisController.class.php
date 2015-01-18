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
		$this->display();
	}

}
