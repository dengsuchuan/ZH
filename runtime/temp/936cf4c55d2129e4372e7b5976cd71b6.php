<?php /*a:1:{s:66:"D:\WebServer\www\project\ZH\application/admin/view\user\login.html";i:1525958804;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'管理员登录')); ?></title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" />
    <script type="text/javascript" src="/static/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/nicEdit.js"></script>
    <script type="text/javascript" src="/static/js/echarts.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 thumbnail">
            <div class="page-header text-center">
                <h2>管理员登录</h2>
            </div>
            <form method="post" id="login" class="form-signin" role="form" action="<?php echo url('user/checkLogin'); ?>">
                <fieldset>
                    <div class="form-group">
                        <label for="email">邮箱:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">密码:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="PassWord" required>
                    </div>

                </fieldset>
                <button type="submit" class="btn btn-info btn-block" id="submit">登录</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>