<?php /*a:4:{s:75:"D:\WebServer\www\project\ZH\application/admin/view\article\articleEdit.html";i:1527497674;s:69:"D:\WebServer\www\project\ZH\application/admin/view\public\layout.html";i:1526801708;s:66:"D:\WebServer\www\project\ZH\application/admin/view\public\nav.html";i:1527492894;s:67:"D:\WebServer\www\project\ZH\application/admin/view\public\left.html";i:1527470822;}*/ ?>
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
            

<div class="row">
    <div class="col-md-12" style="margin-bottom: 30px;">
        <div class="page-header">
            <h2>修改文章</h2>
        </div>
        <form method="post" id="login" action="<?php echo url('article/doSave'); ?>" enctype="multipart/form-data" onSubmit="return inputSu();">
            <input type="hidden" value="<?php echo htmlentities($articleInfo['title_img']); ?>" name="title_img">  <!--旧的-->
            <input type="hidden" name="user_id" value="<?php echo htmlentities(app('session')->get('user_id')); ?>">
            <fieldset>
                <div class="form-group">
                    <label for="title">标题:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="articleTitle" value="<?php echo htmlentities($articleInfo['title']); ?>">
                    <input type="hidden" value="<?php echo htmlentities($articleInfo['id']); ?>" name="id">
                </div>
                <div class="form-group">
                    <label for="cate_id">栏目:</label>
                    <select class="form-control" id="cate_id" name="cate_id">
                        <?php if(is_array($cateInfo) || $cateInfo instanceof \think\Collection || $cateInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $cateInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($list['id']); ?>"  <?php if($articleInfo['cate_id'] == $list['id']): ?> selected <?php endif; ?> ><?php echo htmlentities($list['title']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">内容:</label>
                    <div hidden id="contentDb"><?php echo htmlentities($articleInfo['content']); ?></div>
                    <textarea class="form-control" rows="3" id="content" name="content" placeholder="ArticleContent" style="min-height: 300px;"><?php echo htmlentities($articleInfo['content']); ?></textarea>
                    <script type="text/javascript">
                        new nicEditor({iconsPath:"/static/js/nicEditorIcons.gif"}).panelInstance('content');
                    </script>
                </div>
                <div class="form-group">
                    <label for="new_img">标题图片:</label>
                    <input type="file" id="new_img" name="new_img" class="form-control">
                    <p class="help-block">文章对应标题的图片</p>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-info btn-block" id="save">发表</button>
        </form>
        <script>
            $(function inputSu() {
                var title = "<?php echo htmlentities($articleInfo['title']); ?>";
                //var content = $('#contentDb').text();
                $('#save').on('click',function () {
                    var inputTitle = $('#title').val();
                    var inputImg = $('#new_img').val();
                    //var inputContent = $('#content').text();
                    //dialog.error(content+"#####################"+inputContent);
                    //dialog.error(content+"#####################"+inputContent);
                    // if(title == inputTitle  && inputImg == ""){
                    //     dialog.error("没有进行任何修改，无法保存！");
                    //     return false;
                    // }else{
                    //    // console.log(inputImg);
                    //    // alert(inputImg);
                    //     return true;
                    // }

                });
            });
        </script>
    </div>
    
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
