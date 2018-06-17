<?php /*a:4:{s:68:"D:\WebServer\www\project\ZH\application/admin/view\cate\cateadd.html";i:1527471436;s:69:"D:\WebServer\www\project\ZH\application/admin/view\public\layout.html";i:1526801708;s:66:"D:\WebServer\www\project\ZH\application/admin/view\public\nav.html";i:1527492894;s:67:"D:\WebServer\www\project\ZH\application/admin/view\public\left.html";i:1527470822;}*/ ?>
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
            
<h4 class="text-success text-center">添加新栏目</h4>
<form class="form-horizontal">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
        </div>
    </div>
    <div class="form-group">
        <label for="sort" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="sort" name="sort" placeholder="Sort"  required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">状态</label>
        <div class="col-sm-10" id="radio">
            <label class="radio-inline">
                <input type="radio" name="status" value="1" > 显示
            </label>
            <label class="radio-inline">
                <input type="radio" name="status" value="0" checked> 隐藏
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-success" id="submit" >提交修改</button>

            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">已存在的栏目</a>
            <!-- 模态框（Modal） -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">已存在的栏目</h4>
                        </div>
                        <div class="modal-body">

                            <table class="table table-default table-hover text-center">
                                <tr class="bg-info">
                                    <td>ID</td>
                                    <td>栏目名称</td>
                                    <td>排序</td>
                                    <td>状态</td>
                                </tr>

                                <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$cateList): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo htmlentities($cateList['id']); ?></td>
                                    <td><?php echo htmlentities($cateList['title']); ?></td>
                                    <td><?php echo htmlentities($cateList['sort']); ?></td>
                                    <td>
                                        <?php if($cateList['status'] == '1'): ?><span class="text-success">正常</span><?php endif; if($cateList['status'] == '0'): ?><span class="text-danger">隐藏</span><?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "$empty" ;endif; ?>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<script>
    $(function inputSu() {
        $('#submit').on('click',function () {
            var title = $('#title').val();
            var sort = $('#sort').val();
            $.ajax({
                type:"get",
                url:"<?php echo url('cate/doSave'); ?>",
                dataType:'json',
                data:{title:title,sort:sort},
                success:function (data) {
                    switch (data.status){
                        case 0:
                        case -1:
                            dialog.error(data.message);
                            break;
                        case 1:
                            dialog.success(data.message,"<?php echo url('admin/cate/cateList'); ?>");
                            break;
                    }
                }
            });
        });
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