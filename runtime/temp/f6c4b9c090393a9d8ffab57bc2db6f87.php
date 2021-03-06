<?php /*a:4:{s:76:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/user/userList.html";i:1527494027;s:76:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/public/layout.html";i:1526801708;s:73:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/public/nav.html";i:1527492894;s:74:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/public/left.html";i:1527470822;}*/ ?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:"静影探风")); ?></title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" />
    <script type="text/javascript" src="/static/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/echarts.min.js"></script>
    <script type="text/javascript" src="/static/js/dialog/dialog.js"></script>
    <script type="text/javascript" src="/static/js/dialog/dialog/layer.js"></script>
    <script type="text/javascript" src="/static/js/nicEdit.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
                    <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('admin/index/index'); ?>"><?php echo htmlentities((isset($siteName) && ($siteName !== '')?$siteName:"后台管理")); ?></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li> </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(app('session')->get('admin_level') == '1'): ?>
                        <li class="bg-danger"><a>管理员:&nbsp;&nbsp;<?php echo htmlentities(app('session')->get('admin_name')); ?></a></li>
                        <?php else: ?>
                        <li class="bg-success"><a>用户:&nbsp;&nbsp;<?php echo htmlentities(app('session')->get('admin_name')); ?></a></li>
                        <?php endif; ?>
                        <li><a href="/">回到前台</a></li>
                        <li><a href="<?php echo url('/admin/user/loginOut'); ?>">安全退出</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><div class="thumbnail">
    <?php if(app('session')->get('admin_level') == '1'): ?>
    <ul class="nav nav-pills nav-stacked">
        <li class="navbar-header h4">系统管理</li>
        <li><a href="<?php echo url('admin/site/index'); ?>"><span class="glyphicon glyphicon-cog"></span>&nbsp;网站管理</a></li>
    </ul>
    <?php endif; ?>
    <ul class="nav nav-pills nav-stacked">
        <li class="navbar-header h4">用户管理</li>
        <li><a href="<?php echo url('admin/user/userlist'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;用户列表</a></li>
    </ul>

    <ul class="nav nav-pills nav-stacked">
        <li class="navbar-header h4">文章管理</li>
        <?php if(app('session')->get('admin_level') == '1'): ?>
        <li><a href="<?php echo url('admin/cate/cateList'); ?>"><span class="glyphicon glyphicon-th-list"></span>&nbsp;分类管理</a></li>
        <?php endif; ?>
        <li><a href="<?php echo url('admin/article/articleList'); ?>"><span class="glyphicon glyphicon-book"></span>&nbsp;文章管理</a></li>
    </ul>
</div></div>
        <div class="col-md-10">
            
<h4 class="text-center text-success"><?php echo htmlentities($title); ?></h4>
<table class="table table-default table-hover text-center">
    <tr class="bg-info">
        <td>ID</td>
        <td>用户名</td>
        <td>邮箱</td>
        <td>手机号</td>
        <td>注册时间</td>
        <td>身份</td>
        <td>状态</td>
        <td colspan="2">操作</td>
    </tr>

    <?php if(is_array($userList) || $userList instanceof \think\Collection || $userList instanceof \think\Paginator): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$userList): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($userList['id']); ?></td>
        <td><?php echo htmlentities($userList['name']); ?></td>
        <td><a href="mailto:<?php echo htmlentities($userList['email']); ?>"><?php echo htmlentities($userList['email']); ?></a></td>
        <!--<a href="mailto:<?php echo htmlentities($userList['email']); ?>?subject=投稿：body=源地址：">立即投稿»</a>-->
        <!--mailto:邮件地址-->
        <!--subject=邮件标题-->
        <!--body=邮件内容-->
        <td><?php echo htmlentities($userList['mobile']); ?></td>
        <td><?php echo htmlentities($userList['create_time']); ?></td>
        <td>
            <?php if($userList['is_admin'] == '0'): ?><span class="text-success">普通用户</span><?php endif; if($userList['is_admin'] == '1'): ?><span class="text-danger">超级管理员</span><?php endif; ?>
        </td>
        <td>
            <?php if($userList['status'] == '1'): ?><span class="text-success">正常</span><?php endif; if($userList['status'] == '0'): ?><span class="text-danger">停用</span><?php endif; ?>
        </td>
        <td><a href="<?php echo url('admin/user/userEdit',['id'=>$userList['id']]); ?>">编辑</a></td>
        <?php if($userList['id'] == app('session')->get('admin_id')): ?>
        <td><a class="text-danger disabled" href="javascript:;">删除</a></td>
        <script>
            $(function () {
                $('.disabled').on('click',function () {
                    dialog.error('禁止删除自己');
                });
            });
        </script>
        <?php endif; if($userList['id'] != app('session')->get('admin_id')): ?>
        <td><a class="del" id="<?php echo htmlentities($userList['id']); ?>" href="javascript:;">删除</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
</table>
<script>
    $(function () {
        $('.del').on('click', function () {
            var id = $(this).attr('id');
            //console.log(id);
            dialog.confirm('是否删除该用户？', '/admin/user/del?id=' + id);
        })
    });
</script>
        </div>
    </div>
</div>
</body>
<script>
    $(function () {
        var css = document.createElement('style');
        var text = document.createTextNode('a:hover{color: #39F  !important;text-shadow:-5px 3px 18px #39F !important;-webkit-transition: all 0.3s ease-out;};a{-webkit-transition: all 0.3s ease-out;};*{text-decoration:none!important;font-weight:500!important;}*:not(i):not([class*="hermit"]):not([class*="btn"]):not([class*="button"]):not([class*="ico"]):not(i){font-family: "Microsoft Yahei", "Microsoft Yahei" !important; }*{text-shadow:0.005em 0.005em 0.025em #999999 !important;}');
        css.appendChild(text);
        document.getElementsByTagName('head') [0].appendChild(css);
    });
</script>
</html>
