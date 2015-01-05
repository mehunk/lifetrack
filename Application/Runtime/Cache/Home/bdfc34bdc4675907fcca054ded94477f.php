<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TimeLogger</title>

  <link href="/lifetrack/Public/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
  body, button, input, h3{
    font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif;
      font-weight: normal;
  }
  </style>
  <link href="/lifetrack/Public/css/addtion.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row">
      <!--计时区-->
      <div id="timer" class="col-md-12 jumbotron">
        <p id="eventdesc" class="text-center"></p>
        <p class="text-center">开始时间： <span id="starttime">00:00:00</span></p>
        <p class="text-center">持续时间： <span id="eventtime">00:00:00</span></p>
        <button id="timeBtn" class="btn btn-default btn-lg btn-block">开始计时</button>
      </div>
      <!--计时区结束-->
    </div>
    <div class="row">
      <div class="col-md-12">
        <!--事件填写表单-->
        <form id="event" class="form-inline" role="form">
          <div class="form-group">
            <label class="control-label" for="eventdesc">临时 </label>
            <input type="text" class="form-control" id="sd_eventdesc" placeholder="临时事件描述">
          </div>
          <div class="form-group">
            <label class="control-label" for="eventdesc">计划 </label>
            <select class="form-control">
              <?php if(is_array($schedule_list)): foreach($schedule_list as $key=>$schedule_info): ?><option value="<?php echo ($schedule_info["sd_id"]); ?>"><?php echo ($schedule_info["sd_eventdesc"]); ?></option><?php endforeach; endif; ?>
            </select>
          </div>

          <button id="eventBtn" class="btn btn-default">提交</button>
        </form>
        <!--事件填写表单结束-->
      </div>
    </div>
  </div>
  <script src="/lifetrack/Public/js/jquery-1.11.1.js"></script>
  <script src="/lifetrack/Public/js/bootstrap.min.js"></script>
  <script src="/lifetrack/Public/js/indexEditAddtion.js"></script>
  <script>
    var saveUrl = '<?php echo U('save', '', '');?>';
    var pageStep = <?php echo ($pageStep); ?>;
    var starttime = (pageStep != 0? '<?php echo ($lastItem["er_starttime"]); ?>' : 0);
    var eventdesc = (pageStep == 2? '<?php echo ($lastItem["er_sddesc"]); ?>' : 0);
  </script>
</body>
</html>