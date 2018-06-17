<?php /*a:4:{s:69:"D:\WebServer\www\project\ZH\application/admin/view\cate\catelist.html";i:1526378158;s:69:"D:\WebServer\www\project\ZH\application/admin/view\public\layout.html";i:1526269691;s:66:"D:\WebServer\www\project\ZH\application/admin/view\public\nav.html";i:1526366042;s:67:"D:\WebServer\www\project\ZH\application/admin/view\public\left.html";i:1526371260;}*/ ?>
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
                        <li><a href="<?php echo url('index/index/index'); ?>">回到前台</a></li>
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
        <li><a href=""><span class="glyphicon glyphicon-cog"></span>&nbsp;网站管理</a></li>
    </ul>
    <?php endif; ?>
    <ul class="nav nav-pills nav-stacked">
        <li class="navbar-header h4">用户管理</li>
        <li><a href="<?php echo url('user/userList'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;用户列表</a></li>
    </ul>

    <ul class="nav nav-pills nav-stacked">
        <li class="navbar-header h4">文章管理</li>
        <?php if(app('session')->get('admin_level') == '1'): ?>
        <li><a href="<?php echo url('cate/cateList'); ?>"><span class="glyphicon glyphicon-th-list"></span>&nbsp;分类管理</a></li>
        <?php endif; ?>
        <li><a href=""><span class="glyphicon glyphicon-book"></span>&nbsp;文章管理</a></li>
    </ul>
</div></div>
        <div class="col-md-10">
            
<h4 class="text-center text-success"><?php echo htmlentities($title); ?></h4>
<table class="table table-default table-hover text-center">
    <tr class="bg-info">
        <td>ID</td>
        <td>栏目名称</td>
        <td>排序</td>
        <td>状态</td>
        <td>创建时间</td>
        <td colspan="2">操作</td>
    </tr>

    <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$cateList): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($cateList['id']); ?></td>
        <td><?php echo htmlentities($cateList['title']); ?></td>
        <td><?php echo htmlentities($cateList['sort']); ?></td>
        <td>
            <?php if($cateList['status'] == '1'): ?><span class="text-success">正常</span><?php endif; if($cateList['status'] == '0'): ?><span class="text-danger">隐藏</span><?php endif; ?>
        </td>
        <td><?php echo htmlentities($cateList['create_time']); ?></td>
        <td><a href="<?php echo url('cate/cateEdit',['id'=>$cateList['id']]); ?>">编辑</a></td>
        <td><a class="del" id="<?php echo htmlentities($cateList['id']); ?>">删除</a> </td>

    </tr>
    <?php endforeach; endif; else: echo "$empty" ;endif; ?>
</table>
<a href="<?php echo url('cate/cateAdd'); ?>" class="btn btn-success btn-sm">添加栏目</a>
<script>
    $(function () {
        $('.del').on('click', function () {
            var id = $(this).attr('id');
            //console.log(id);
            dialog.confirm('是否删除该用户？', 'del?id=' + id);
        })
    });
</script>
        </div>
    </div>
</div>
</body>
</html>
