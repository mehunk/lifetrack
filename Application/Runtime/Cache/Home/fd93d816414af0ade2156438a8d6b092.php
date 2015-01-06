<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LifeTrack - Category</title>

  <link href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
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
          <h4 class="modal-title" id="myModalLabel">新增事项分类</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">分类名称</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="cg_name" placeholder="分类名称">
              </div>
            </div>
            <div class="form-group">
              <label for="time" class="col-sm-2 control-label">花费时间</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="time" name="cg_time" placeholder="花费时间">
              </div>
            </div>
            <input type="hidden" id="id" name="cg_id" value="0">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="saveCategory">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> 
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <h3>事项分类表</h3>
    <div class="row">
      <div class="col-xs-2">
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">新建事项分类</button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th class="col-md-1">#</th>
              <th class="col-md-5">分类名称</th>
              <th>时间（分钟）</th>
              <th>显示</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($cg_list)): foreach($cg_list as $key=>$cg_info): ?><tr id="tr-<?php echo ($cg_info["cg_id"]); ?>">
                <td><?php echo ($key+1); ?></td>
                <td><?php echo ($cg_info["cg_name"]); ?></td>
                <td><?php echo ($cg_info["cg_time"]); ?></td>
                <td>
                  <?php if($cg_info['cg_display']): ?><a href="display-<?php echo ($cg_info["cg_id"]); ?>" class="btn btn-default btn-sm">禁用</a>
                  <?php else: ?>
                    <a href="display-<?php echo ($cg_info["cg_id"]); ?>" class="btn btn-primary btn-sm">显示</a><?php endif; ?>
                <td>
                  <a href="edit-<?php echo ($cg_info["cg_id"]); ?>" class="btn btn-primary btn-sm">修改</a> <a href="delete-<?php echo ($cg_info["cg_id"]); ?>" class="btn btn-danger btn-sm">删除</a>
                  
                </td>
              </tr><?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="/github/lifetrack/Public/js/categoryIndexAddtion.js"></script>
  <script>
    var postUrl = "<?php echo U('save', '', '');?>";
    var deleteUrl = "<?php echo U('delete', '', '');?>";
    var displayUrl = "<?php echo U('changeDisplay', '', '');?>";
  </script>
</body>
</html>