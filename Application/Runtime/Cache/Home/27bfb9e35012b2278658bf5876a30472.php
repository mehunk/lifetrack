<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LifeTrack - Analysis</title>

  <link href="http://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://cdn.bootcss.com/bootstrap-datepicker/1.3.1/css/datepicker3.min.css" rel="stylesheet">
  <style type="text/css">
  body, button, input, h3{
    font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif;
      font-weight: normal;
  }
  body {
    padding-top: 50px;
    padding-bottom: 40px;
  }
  .bs-docs-sidebar.affix {
    position: static;
  }
  @media (min-width: 768px) {
  .bs-docs-sidebar {
      padding-left: 20px;
  }
  }
  .bs-docs-sidenav {
      margin-bottom: 20px;
      margin-top: 20px;
  }
  .bs-docs-sidebar .nav > li > a {
      color: #999;
      display: block;
      font-size: 13px;
      font-weight: 500;
      padding: 4px 20px;
  }
  .bs-docs-sidebar .nav > li > a:hover, .bs-docs-sidebar .nav > li > a:focus {
      background-color: transparent;
      border-left: 1px solid #563d7c;
      color: #563d7c;
      padding-left: 19px;
      text-decoration: none;
  }
  .bs-docs-sidebar .nav > .active > a, .bs-docs-sidebar .nav > .active:hover > a, .bs-docs-sidebar .nav > .active:focus > a {
      background-color: transparent;
      border-left: 2px solid #563d7c;
      color: #563d7c;
      font-weight: 700;
      padding-left: 18px;
  }
  .bs-docs-sidebar .nav .nav {
      display: none;
      padding-bottom: 10px;
  }
  .bs-docs-sidebar .nav .nav > li > a {
      font-size: 12px;
      font-weight: 400;
      padding-bottom: 1px;
      padding-left: 30px;
      padding-top: 1px;
  }
  .bs-docs-sidebar .nav .nav > li > a:hover, .bs-docs-sidebar .nav .nav > li > a:focus {
      padding-left: 29px;
  }
  .bs-docs-sidebar .nav .nav > .active > a, .bs-docs-sidebar .nav .nav > .active:hover > a, .bs-docs-sidebar .nav .nav > .active:focus > a {
      font-weight: 500;
      padding-left: 28px;
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
      <div role="complementary" class="col-md-3">
        <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
          <ul class="nav bs-docs-sidenav">
            <li class=""><a href="#container">时间记录比例</a></li>
          </ul>
          <div class="input-group" id="search_date">
            <input type="text" class="form-control">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default">查询</button>
            </span>
          </div>
        </nav>
      </div>
      <div class="col-md-9">
        <div id="container" style="min-width:800px;height:400px"></div>
      </div>
    </div>
  </div>

  <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.zh-CN.min.js" charset="UTF-8"></script>
  <script src="http://cdn.bootcss.com/highcharts/4.0.4/highcharts.js"></script>
  <script src="/github/lifetrack/Public/js/generateChart.js"></script>
  <script src="/github/lifetrack/Public/js/analysisIndexAddition.js"></script>
  <script>
    var indexUrl = "<?php echo U('index', '', '');?>";
    var chartDataUrl = "<?php echo U('getChartData', '', '');?>";
    var search_date = "<?php echo ($search_date); ?>";
  </script>
</body>
</html>