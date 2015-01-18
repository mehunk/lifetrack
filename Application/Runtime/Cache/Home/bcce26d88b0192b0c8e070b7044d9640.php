<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LifeTrack - Timeline</title>

  <link href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="/github/lifetrack/Public/css/timeline.css" rel="stylesheet">
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
    <div class="row">
      <div class="col-md-12">
				<ul class="cbp_tmtimeline">
          <?php if(is_array($sd_list)): foreach($sd_list as $key=>$sd_info): ?><li>
  						<time class="cbp_tmtime"><span><?php echo ($sd_info["sd_date"]); ?></span> <span><?php echo ($sd_info["sd_starttime"]); ?></span></time>
  						<div class="cbp_tmicon">
                <i class="glyphicon glyphicon-bell"> </i>
              </div>
  						<div class="cbp_tmlabel">
  							<h2><?php echo ($sd_info["sd_eventdesc"]); ?></h2>
  							<p><?php echo ($sd_info["sd_eventdetail"]); ?></p>
  						</div>
  					</li><?php endforeach; endif; ?>
				</ul>
      </div>
    </div>
  </div>

  <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>