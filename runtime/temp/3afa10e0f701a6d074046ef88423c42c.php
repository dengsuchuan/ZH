<?php /*a:6:{s:73:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/user/login.html";i:1527469740;s:74:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public/base.html";i:1525254418;s:77:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//header.html";i:1536569955;s:74:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//nav.html";i:1536568508;s:76:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//right.html";i:1536570204;s:77:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//footer.html";i:1536559456;}*/ ?>
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
    <script type="text/javascript" src="/static/js/nicEdit.js"></script>
    <script type="text/javascript" src="/static/js/echarts.min.js"></script>
    <script type="text/javascript" src="/static/js/dialog/dialog.js"></script>
    <script type="text/javascript" src="/static/js/dialog/dialog/layer.js"></script>
    <style>
        #modal-body img{
            max-width: 100%;
            width: 100%;
        }
        nav img{
            max-width: 100%;
            width: 100%;
        }
        .card{
            box-shadow: 10px 10px 5px #888888;
            background: #C6FFDD;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #f7797d, #FBD786, #C6FFDD);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #f7797d, #FBD786, #C6FFDD); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }


    </style>
</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><?php echo htmlentities((isset($siteName) && ($siteName !== '')?$siteName:"静影探风")); ?></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li
                        <?php if(empty(app('request')->param('cate_id')) || ((app('request')->param('cate_id') instanceof \think\Collection || app('request')->param('cate_id') instanceof \think\Paginator ) && app('request')->param('cate_id')->isEmpty())): ?>
                            class="active"
                        <?php endif; ?>
                        ><a href="/">首页</a></li>
                        <?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                        <li
                        
                        <?php if($list['id'] == app('request')->param('cate_id')): ?>
                            class="active"
                        <?php endif; ?>
                        ><a href="<?php echo url('index/index/index',['cate_id'=>$list['id']]); ?>"><?php echo htmlentities($list['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <form class="navbar-form navbar-left" action="keyword" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" id="keyword" placeholder="请输入关键字...">
                        </div>
                        <button type="button" class="btn btn-default" id="butkey">搜索</button>
                    </form>
                    <script>
                        $(function () {
                            $('#butkey').on('click',function () {
                                var keyword = $('#keyword').val();
                                var url = "<?php echo url('index/index/index',['keyword'=>'keywords']); ?>";
                                url = url.replace('keywords',keyword);
                                window.location.href = url;
                            });
                        });
                    </script>

                    <ul class="nav navbar-nav navbar-right">
                        <?php if(app('session')->get('user_id')): ?>
                        <li><a href="#" id="username"><?php echo htmlentities(app('session')->get('user_name')); ?></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">操作<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo url('index/index/insert'); ?>">发布文章</a></li>
                                <li class="bg-info"><a href="<?php echo url('admin/user/userlist'); ?>">管理中心</a></li>
                                <li><a href="<?php echo url('user/loginOut'); ?>">退出登录</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li><a href="<?php echo url('index/user/login'); ?>">登录</a></li>
                        <li><a href="<?php echo url('index/user/register'); ?>">注册</a></li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

        
<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h2>用户登录</h2>
        </div>
        <form method="post" id="login" >
            <fieldset>
                <div class="form-group">
                    <label for="email">邮箱:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    <p class="help-block">用于找回密码或者登录平台</p>
                </div>
                <div class="form-group">
                    <label for="password">密码:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="PassWord">
                    <p class="help-block">密码由字母或数字组成;必须大于5,小于20位</p>
                </div>
            </fieldset>
            <button type="button" class="btn btn-info btn-block" id="submit">登录</button>
        </form>
    </div>
    <script>
        $(function () {
            $('#submit').on('click',function () {
                //alert($('#login').serialize());
                $.ajax({
                    type:'post',
                    url:"<?php echo url('index/user/loginCheck'); ?>",
                    data:$('#login').serialize(),
                    dataType:'json',
                    success:function (data) {
                        switch (data.status){
                            case -1:
                            case 0:
                                dialog.error(data.message);
                                break;
                            case 1:
                                //alert(data.message);
                                window.location.href="/";
                                break;
                        }
                    }
                });
            });
        })
    </script>


        <div class="col-md-4">
    <div class="page-header">
        <h3>热门排行</h3>
    </div>
    <ul class="list-group">
        <?php if(is_array($pv) || $pv instanceof \think\Collection || $pv instanceof \think\Paginator): $i = 0; $__LIST__ = $pv;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$pvList): $mod = ($i % 2 );++$i;?>
        <li class="list-group-item" title="<?php echo htmlentities($pvList['title']); ?>">
            <marquee direction="left" behavior="alternate" scrollamount="1" scrolldelay="100">
                <span href="<?php echo url('index/index/index',['keyword'=>$pvList['title']]); ?>"><?php echo htmlentities($pvList['title']); ?> 【阅读量: <?php echo htmlentities($pvList['pv']); ?>】</span>
            </marquee>
        <?php endforeach; endif; else: echo "$empty" ;endif; ?>
    </ul>

    <div class="page-header">
        <h3>最新评论</h3>
    </div>
    <ul class="list-group">
        <?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$commentsList): $mod = ($i % 2 );++$i;?>
            <li class="list-group-item">
                <marquee direction="left"  scrollamount="5">
                <?php echo htmlentities($commentsList['content']); ?>
                </marquee>
            </li>
        <?php endforeach; endif; else: echo "$empty" ;endif; ?>
    </ul>

    <div class="page-header">
        <h3>站点统计</h3>
    </div>
    <div class="col-md-12">
        <div class="thumbnail">
            <div id="main" style="height:400px;"></div>
            <div id="articleCountList">
                <?php if(is_array($articleCount) || $articleCount instanceof \think\Collection || $articleCount instanceof \think\Paginator): $i = 0; $__LIST__ = $articleCount;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$articleCountList): $mod = ($i % 2 );++$i;?>
                <input type="hidden" value='{"value":"<?php echo htmlentities($articleCountList['count']); ?>","name":"<?php echo htmlentities($articleCountList['title']); ?>"}'>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            //获取文章统计信息
            var array = [];
            var txt = $("#articleCountList").find(':hidden');
            var json = ' ';
            for (var i = 0; i < txt.length; i++) {
                json = json + txt.eq(i).val()+","; // 将文本框的值添加到数组中
            }
            json = json.substring(0,json.length-1)
            var array = JSON.parse("["+json+"]");
            //console.log(array);

            var myChart = echarts.init(document.getElementById("main"));
            option = {
                backgroundColor: '#2c343c',

                title: {
                    text: '站点文章统计',
                    left: 'center',
                    top: 20,
                    textStyle: {
                        color: '#ccc'
                    }
                },

                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },

                visualMap: {
                    show: false,
                    min: 0,
                    max: 5,
                    inRange: {
                        colorLightness: [0, 1]
                    }
                },
                series : [
                    {
                        name:'数量',
                        type:'pie',
                        radius : '55%',
                        center: ['50%', '50%'],
                        data:array.sort(function (a, b) { return a.value - b.value; }),
                        roseType: 'radius',
                        label: {
                            normal: {
                                textStyle: {
                                    color: 'rgba(255, 255, 255, 0.3)'
                                }
                            }
                        },
                        labelLine: {
                            normal: {
                                lineStyle: {
                                    color: 'rgba(255, 255, 255, 0.3)'
                                },
                                smooth: 0.2,
                                length: 10,
                                length2: 20
                            }
                        },
                        itemStyle: {
                            normal: {
                                color: '#c23531',
                                shadowBlur: 200,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        },

                        animationType: 'scale',
                        animationEasing: 'elasticOut',
                        animationDelay: function (idx) {
                            return Math.random() * 200;
                        }
                    }
                ]
            };
            myChart.setOption(option);
        });
    </script>
</div>
<!--底部开始-->
</div>
    </div>
</body>
<!--这是背景后面的线条-->
<!--<script type="text/javascript" src="/static/js/canvas-nest.min.js"></script>-->

<!--这个是前端字体样式  根据猴油插件修改而来-->
<script>
    $(function () {
        var css = document.createElement('style');
        var text = document.createTextNode('a:hover{color: #39F  !important;text-shadow:-5px 3px 18px #39F !important;-webkit-transition: all 0.3s ease-out;};a{-webkit-transition: all 0.3s ease-out;};*{text-decoration:none!important;font-weight:500!important;}*:not(i):not([class*="hermit"]):not([class*="btn"]):not([class*="button"]):not([class*="ico"]):not(i){font-family: "Microsoft Yahei", "Microsoft Yahei" !important; }*{text-shadow:0.005em 0.005em 0.025em #999999 !important;}');
        css.appendChild(text);
        document.getElementsByTagName('head') [0].appendChild(css);
    });
</script>
</html>
<!--底部结束-->
