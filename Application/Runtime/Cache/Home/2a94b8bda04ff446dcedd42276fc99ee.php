<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LifeTrack - Index</title>

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
	
  <div class="container">
    <h3><?php echo ($search_date); ?>时间记录表</h3>
    <div class="row">
      <div class="col-xs-2">
        <a href="<?php echo U('edit', '', '');?>" class="btn btn-primary">新建时间</a>
      </div>
      <div class="col-xs-6 col-xs-offset-4">
        <form class="form-inline pull-right" method="get" action="<?php echo U('index');?>" role="form">
          <div class="form-group">
            <div class="input-group">
              <select class="form-control" name="search_date">
                <?php if(is_array($date_list)): foreach($date_list as $key=>$er_date): ?><option><?php echo ($er_date); ?></option><?php endforeach; endif; ?>
              </select>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default">Go!</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <tr style="width: 100%">
              <th>#</th>
              <th>事件描述</th>
							<th class="hidden-xs">事件分类</th>
              <th>开始时间</th>
              <th>结束时间</th>
							<th>花费时间</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($er_list)): foreach($er_list as $key=>$er_info): ?><tr>
                <td><?php echo ($key+1); ?></td>
                <td><?php echo ($er_info["er_sddesc"]); ?></td>
								<td class="hidden-xs"><?php echo ($er_info["er_cgname"]); ?></td>
                <td><?php echo ($er_info["er_starttime"]); ?></td>
								<td><?php echo ($er_info["er_endtime"]); ?></td>
                <td><?php echo (secondtominute($er_info["er_eventtime"])); ?></td>
              </tr><?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>