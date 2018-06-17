<?php /*a:1:{s:62:"D:\WebServer\www\tp5.1\application/index/view\demo7\test3.html";i:1525108055;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'默认标题')); ?></title>
    <link rel="stylesheet" href="/tp5.1/public/static/css/bootstrap.min.css">
    <script src="/tp5.1/public/static/js/bootstrap.min.js"></script>
    <script src="/tp5.1/public/static/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2 class="text-center">学生信息表</h2>
            <table class="table table-default table-bordered table-hover text-center">
                <tr class="bg-danger">
                    <td>ID</td>
                    <td>姓名</td>
                    <td>密码</td>
                    <td>年龄</td>
                </tr>
                
                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo htmlentities($row['id']); ?></td>
                    <td><?php echo htmlentities($row['username']); ?></td>
                    <td><?php echo htmlentities($row['password']); ?></td>
                    <td><?php echo htmlentities($row['age']); ?></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</body>
</html>