<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 事项分类控制器
 * 显示、增加、删除、激活/禁用事项分类
 */
class CategoryController extends Controller {
	/**
	 * 显示指定日期的待办事项，默认为当天
	 * @return null
	 */
	public function index() {
		//事项分类列表
		$cg_list = M('category')->select();
    	$this->assign('cg_list', $cg_list)->display();
	}

	/**
	 * 保存事项分类
	 * @return null
	 */
	public function save() {
		$cg_info = I('post.');
		if(!$cg_info['cg_id'])
			$cg_id = M('category')->add($cg_info);
		else {
			$cg_id = M('category')->where(array('cg_id' => $cg_info['cg_id']))->data(array('cg_name' => $cg_info['cg_name'], 'cg_time' => $cg_info['cg_time']))->save();
		}
		$this->ajaxReturn($cg_id);
	}

	/**
	 * 删除事项分类
	 * @return null
	 */
	public function delete() {
		$condition = I('get.');
		if(M('category')->where($condition)->delete())
			$this->success();
	}

	/**
	 * 修改事项分类显示状态
	 * @return null
	 */
	public function changeDisplay() {
		$condition = I('get.');
		$display = M('category')->where($condition)->getField('cg_display');
		if(M('category')->where($condition)->setField('cg_display', !$display))
			$this->success();
	}
}
?>