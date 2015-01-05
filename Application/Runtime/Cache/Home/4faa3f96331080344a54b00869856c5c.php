<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TimeLogger</title>

  <link href="/timelogger/Public/css/bootstrap.min.css" rel="stylesheet">
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

  <div class="container">
    <div class="row">
      <form method="post" action="<?php echo U('save', '', '');?>" role="form">
        <table class="table table-striped">
          <thead>
            <tr>
              <td>#</td>
              <td>事件描述</td>
              <td>分类</td>
              <td>操作</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><input type="text" class="form-control" name="sd_eventdesc" placeholder="事件描述"></td>
              <td>
                <select class="form-control" name="sd_category">
                  <option>1</option>
                  <option>2</option>
                </select>
              </td>
              <td><a href="#" class="btn btn-danger">删除</a></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="text" class="form-control" name="sd_eventdesc" placeholder="事件描述"></td>
              <td>
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                </select>
              </td>
              <td><a href="#" class="btn btn-danger">删除</a></td>
            </tr>
          </tbody>
        </table>
        <a href="#" class="btn btn-info">+ 增加</a>
        <button type="submit" class="btn btn-primary">提交</button>
        <a href="<?php echo U('index', '', '');?>" class="btn btn-default">返回</a>
      </form>

    </div>
  </div>

  <script type="text/javascript" src="/timelogger/Public/js/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="/timelogger/Public/js/bootstrap.min.js"></script>
</body>
</html>