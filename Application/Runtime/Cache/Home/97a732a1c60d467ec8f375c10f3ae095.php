<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LifeTrack - Schedule</title>

  <link href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://cdn.bootcss.com/bootstrap-datepicker/1.3.1/css/datepicker3.min.css" rel="stylesheet">
  <link href="http://cdn.bootcss.com/bootstrap-switch/3.3.0/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
	<link href="/github/lifetrack/Public/css/bootstrap-clockpicker.min.css" rel="stylesheet">
  <style type="text/css">
  body, button, input, h3{
    font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif;
      font-weight: normal;
  }
  body {
    padding-top: 50px;
    padding-bottom: 40px;
  }
  </style>
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">LifeTrack</a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?php echo U('Index/index');?>">时间记录</a>
          </li>
          <li>
            <a href="<?php echo U('Schedule/index');?>">待办事项</a>
          </li>
					<li>
            <a href="<?php echo U('Category/index');?>">事项分类</a>
          </li>
          <li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">新增待办事项</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label for="category" class="col-sm-2 control-label">类别</label>
              <div class="col-sm-10">
                <select class="form-control" id="category" name="sd_cgid">
                  <?php if(is_array($category_list)): foreach($category_list as $key=>$category_info): ?><option value="<?php echo ($category_info["cg_id"]); ?>"><?php echo ($category_info["cg_name"]); ?></option><?php endforeach; endif; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="eventdesc" class="col-sm-2 control-label">事件描述</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="eventdesc" name="sd_eventdesc" placeholder="事件描述">
              </div>
            </div>
            <div class="form-group">
              <label for="date" class="col-sm-2 control-label">日期</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <input type="text" readonly="" class="form-control" id="date" name="sd_date"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
              </div>
            </div>
						<div class="form-group">
              <label for="plantime" class="col-sm-2 control-label">计划用时</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="plantime" name="sd_plantime" placeholder="计划用时">
              </div>
            </div>
						<div class="form-group">
              <label for="starttime" class="col-sm-2 control-label">开始时间</label>
              <div class="col-sm-10">
								<div class="input-group clockpicker">
									<input type="text" class="form-control" id="starttime" name="sd_starttime">
									<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
              </div>
            </div>
            <div class="form-group">
              <label for="importance" class="col-sm-2 control-label">重要程度</label>
              <div class="col-sm-10">
                <input type="checkbox" name="sd_importance" id="importance" data-on-text="是" data-off-text="否">
              </div>
            </div>
            <div class="form-group">
              <label for="urgency" class="col-sm-2 control-label">紧急程度</label>
              <div class="col-sm-10">
                <input type="checkbox" name="sd_urgency" id="urgency" data-on-text="是" data-off-text="否">
              </div>
            </div>
            <div class="form-group">
              <label for="detail" class="col-sm-2 control-label">事件详情</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="sd_eventdetail" id="detail" rows="3"></textarea>
              </div>
            </div>
						<input type="hidden" id="id" name="sd_id" value="">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="saveSchedule">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> 
        </div>
      </div>
    </div>
  </div>
	
	  <!--  Modal content for the above example -->
  <div id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">事件详情</h4>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
				<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> 
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="container">
    <h3><?php echo ($search_date); ?>事件待办表</h3>
    <div class="row">
      <div class="col-xs-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">新建待办</button>
      </div>
      <div class="col-md-3 col-md-offset-7 col-xs-8 col-xs-offset-2">
        <div class="form-group">
          <div class="input-group">
            <select class="form-control" id="search_date" name="search_date">
              <?php if(is_array($date_list)): foreach($date_list as $key=>$sd_date): ?><option><?php echo ($sd_date); ?></option><?php endforeach; endif; ?>
            </select>
            <div class="input-group-btn" id="search">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">查询 <span class="caret"></span></button>
              <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li><a href="<?php echo U('index');?>">列表视图</a></li>
                <li><a href="<?php echo U('timeline');?>">时间轴视图</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th class="col-md-3">描述</th>
							<th>开始时间</th>
							<th>计划用时</th>
              <th>标签</th>
              <th class="hidden-xs">类别</th>
              <th class="hidden-xs">计划/临时</th>
              <th class="hidden-xs">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($sd_list)): foreach($sd_list as $key=>$sd_info): ?><tr id="tr-<?php echo ($sd_info["sd_id"]); ?>">
                <td><?php echo ($key+1); ?></td>
                <td>
                  <?php if($sd_info['sd_complete']): ?><del><?php echo ($sd_info["sd_eventdesc"]); ?></del>
                  <?php else: ?>
                    <?php echo ($sd_info["sd_eventdesc"]); endif; ?>
                </td>
								<td><?php echo ($sd_info["sd_starttime"]); ?></td>
								<td><?php echo ($sd_info["sd_plantime"]); ?></td>
                <td>
                  <?php if($sd_info['sd_importance']): ?><span class="label label-success">重要</span><?php endif; ?>
                  <?php if($sd_info['sd_urgency']): ?><span class="label label-danger">紧急</span><?php endif; ?>
                </td>
                <td class="hidden-xs"><?php echo ($sd_info["sd_cgname"]); ?></td>
                <td class="hidden-xs">
                  <?php if($sd_info['sd_plan']): ?>计划<?php else: ?>临时<?php endif; ?>
                </td>
                <td class="hidden-xs">
									<a href="edit-<?php echo ($sd_info["sd_id"]); ?>" class="btn btn-primary btn-sm">编辑</a>
                  <a href="delete-<?php echo ($sd_info["sd_id"]); ?>" class="btn btn-danger btn-sm">删除</a>
                  <a href="complete-<?php echo ($sd_info["sd_id"]); ?>" class="btn btn-success btn-sm">完成</a>
                </td>
              </tr><?php endforeach; endif; ?>
          </tbody>
        </table>
			</div>
    </div>
  </div>

  <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.zh-CN.min.js" charset="UTF-8"></script>
  <script src="http://cdn.bootcss.com/bootstrap-switch/3.3.0/js/bootstrap-switch.min.js"></script>
	<script src="/github/lifetrack/Public/js/bootstrap-clockpicker.min.js"></script>
  <script src="/github/lifetrack/Public/js/scheduleIndexAddtion.js"></script>
  <script>
    var postUrl = "<?php echo U('save', '', '');?>";
    var deleteUrl = "<?php echo U('delete', '', '');?>";
    var completeUrl = "<?php echo U('complete', '', '');?>";
		var getSdInfoUrl = "<?php echo U('getSdInfo', '', '');?>";
		var getDetailUrl = "<?php echo U('getDetail', '', '');?>";
  </script>
</body>
</html>