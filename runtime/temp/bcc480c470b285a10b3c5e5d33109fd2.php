<?php /*a:4:{s:73:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/site/index.html";i:1526792390;s:76:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/public/layout.html";i:1526801708;s:73:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/public/nav.html";i:1527492894;s:74:"/home/dengsuchuan/Documents/Web/ZH/application/admin/view/public/left.html";i:1527470822;}*/ ?>
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
            
<h4 class="text-success text-center">站点管理</h4>
<form class="form-horizontal" action="<?php echo url('site/save'); ?>" method="post" onSubmit="return inputSu();">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">站点名称:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo htmlentities($siteInfo['name']); ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="keywords" class="col-sm-2 control-label">关键词:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords"  value="<?php echo htmlentities($siteInfo['keywords']); ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="desc" class="col-sm-2 control-label">站点描述:</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="desc" name="desc" placeholder="Desc" style="min-height: 200px;"><?php echo htmlentities($siteInfo['desc']); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">网站是否开启:</label>
        <div class="col-sm-10" id="open">
            <label class="radio-inline">
                <input type="radio" name="is_open" value="1" <?php if($siteInfo['is_open'] == '1'): ?> checked <?php endif; ?>> 开启
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_open" value="0" <?php if($siteInfo['is_open'] == '0'): ?> checked <?php endif; ?>> 关闭
            </label>
        </div>
    </div>
    <input type="hidden" value="<?php echo htmlentities($siteInfo['id']); ?>" name="id">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success" id="submit" >提交修改</button>
        </div>
    </div>
</form>
<script>
    $(function inputSu() {
        var name = "<?php echo htmlentities($siteInfo['name']); ?>";
        var keywords = "<?php echo htmlentities($siteInfo['keywords']); ?>";
        var desc = "<?php echo htmlentities($siteInfo['desc']); ?>";
        var open = "<?php echo htmlentities($siteInfo['is_open']); ?>";
        $('#submit').on('click',function () {
            var nameInput = $('#name').val();
            var keywordsInput = $('#keywords').val();
            var descInput = $('#desc').val();
            var radio = $("input[type='radio']:checked").val();

            if(nameInput == name && keywordsInput == keywords && radio == open && descInput == desc){
                dialog.error('没有进行任何修改，无法保存');
                return false;
            }else{
                return true;
            }


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
