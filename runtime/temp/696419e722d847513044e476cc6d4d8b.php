<?php /*a:6:{s:74:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/index/index.html";i:1536719798;s:74:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public/base.html";i:1525254418;s:77:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//header.html";i:1536719865;s:74:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//nav.html";i:1536568508;s:76:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//right.html";i:1536570204;s:77:"/home/dengsuchuan/Documents/Web/ZH/application/index/view/public//footer.html";i:1536719984;}*/ ?>
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
            x-background: #C6FFDD;  /* fallback for old browsers */
            x-background: -webkit-linear-gradient(to bottom, #f7797d, #FBD786, #C6FFDD);  /* Chrome 10-25, Safari 5.1-6 */
            x-background: linear-gradient(to bottom, #f7797d, #FBD786, #C6FFDD); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
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
                <h2><?php echo htmlentities((isset($cateName) && ($cateName !== '')?$cateName:'首页')); ?>·全部文章</h2>
            </div>
            <?php if(is_array($artList) || $artList instanceof \think\Collection || $artList instanceof \think\Paginator): $i = 0; $__LIST__ = $artList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <div class=" thumbnail card">
                <legend>
                    <!-- 触发模态框 -->
                    <div class="artName">
                        <span class="glyphicon glyphicon-file"></span>
                        <a data-toggle="modal" data-target="#myModal<?php echo htmlentities($list['id']); ?>" style="cursor:pointer " class="artName" ><?php echo htmlentities($list['title']); ?></a>
                        <input type="hidden" value="<?php echo htmlentities($list['id']); ?>" name="art_id">
                    </div>
                    <!-- 模态框（Modal） -->
                    <div class="modal fade" id="myModal<?php echo htmlentities($list['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo htmlentities($list['title']); ?></h4>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <!--模态框里面的全部内容-->
                                    <?php echo htmlentities(getHtmlContent($list['id'])); ?>
                                    <hr>
                                    <!--下面是用户评论区域-->
                                    <div class="text-center">【发表评论】</div>
                                    <input type="hidden" value="<?php echo htmlentities(($user_id = app('session')->get('user_id') ?: 0)); ?>">
                                    <?php if(app('session')->get('user_id')): ?>
                                    <input type="hidden" value="<?php echo htmlentities(app('session')->get('user_id')); ?>" id="userId">
                                    <!--<p>用户:<?php echo htmlentities(app('session')->get('user_name')); ?></p>-->
                                    <div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" id="textarea<?php echo htmlentities($list['id']); ?>"  style="resize:none" ></textarea>
                                        </div>
                                        <button class="btn btn-success btnText">
                                            <span class="glyphicon glyphicon-send"></span> 提交
                                            <input type="hidden" value="<?php echo htmlentities($list['id']); ?>" class="artId">
                                            <input type="hidden" value="<?php echo htmlentities(app('session')->get('user_id')); ?>" class="userId">
                                        </button>
                                        <br><br>
                                        <div id="buttonLog"></div>
                                    </div>
                                    <script>
                                        $(function () {
                                            $('.btnText').on('click',function () {
                                                var artId = $(this).find('.artId').val();
                                                var userId = $(this).find('.userId').val();
                                                var content = $('#textarea'+artId).val();

                                                var userName = $('#username').text();
                                                if(content.length <= 5){
                                                    dialog.error('评论内容不得小于6个字符');
                                                    window.location.blink();
                                                }
                                                //下面是保存评论并异步加载到评论展示框
                                                $.ajax({
                                                    type:'get',
                                                    url:"<?php echo url('saveCom'); ?>",
                                                    data:{'art_id':artId,'user_id':userId,'content':content},
                                                    dataType:'json',
                                                    success:function (data) {
                                                        if(!data){
                                                            $("#buttonLog").html("<div class='alert alert-danger alert-dismissable'>\n" +
                                                                "\t<button type='button' class='close' data-dismiss='alert'\n" +
                                                                "\t\t\taria-hidden='true'>\n" +
                                                                "\t\t&times;\n" +
                                                                "\t</button>\n" +
                                                                "\t错误！请进行一些更改。\n" +
                                                                "</div>");
                                                        }else{
                                                            //alert('评论成功')
                                                            var myDate = new Date();
                                                            var time = myDate.toLocaleString( );
                                                            var html = $(".modal-comments").html();
                                                            var ajaxHtml = "<div class='well col-md-12'><a href='#' style='font-size:15px;padding-top:2px;'> <span class='glyphicon glyphicon-user'></span> 用户:"+userName+"</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='#' style='font-size:15px;padding-top:2px;'> <span class='glyphicon glyphicon-time'></span> 时间:"+time+" </a><div class='col-md-12'><p style='font-size:20px;'>"+content+"</p></div></div>";
                                                            $(".modal-comments").html(ajaxHtml+html);

                                                            $("#buttonLog").html("<div class='alert alert-success alert-dismissable' style='font-size: 15px'>\n" +
                                                                "\t<button type='button' class='close' data-dismiss='alert'\n" +
                                                                "\t\t\taria-hidden='true'>\n" +
                                                                "\t\t&times;\n" +
                                                                "\t</button>\n" +
                                                                "\t评论成功\n" +
                                                                "</div>");

                                                        }
                                                    }
                                                });
                                                $('#textarea'+artId).val(" ");
                                                window.location.blink();
                                            });
                                        });
                                    </script>
                                    <!--接下来发表评论-->

                                    <?php else: ?>
                                    <span>还没有登录哦，请先登录<a href="<?php echo url('index/user/login'); ?>">【点击登录】</a></span>
                                    <?php endif; ?>
                                    <hr style="background-color: green;height:2px;">
                                    <div class="row pre-scrollable">
                                        <div class="modal-comments"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-success fav"><input type="hidden" value="<?php echo htmlentities($list['id']); ?>" class='favInputArtId'> <input type="hidden" value="<?php echo htmlentities(getFav($list['id'],$user_id)); ?>" id="fav<?php echo htmlentities($list['id']); ?>"> <span class="glyphicon glyphicon-bookmark"></span>
                                        <span id="favInfo<?php echo htmlentities($list['id']); ?>"></span>
                                    </button>
                                    <button type="button" class="btn btn-primary like"><input type="hidden" value="<?php echo htmlentities($list['id']); ?>"> <span class="glyphicon glyphicon-heart"></span> 点赞 +<span id="likeCount<?php echo htmlentities($list['id']); ?>"><?php echo htmlentities(getLink($list['id'])); ?></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 模态框结束 -->
                </legend>
                <marquee direction="left" behavior="alternate" scrollamount="5">
                <ol class="breadcrumb text-center" style="width:550px;opacity: 0.8">
                    <li ><a>作者: <?php echo htmlentities(getUserName($list['user_id'])); ?></a></li>
                    <li><a href="<?php echo url('index/index/index',['cate_id'=>$list['cate_id']]); ?>">分类: <?php echo htmlentities(getCate($list['cate_id'])); ?></a></li>
                    <li><a>发表日期: <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($list['create_time'])? strtotime($list['create_time']) : $list['create_time'])); ?></a></li>
                    <li><a>阅读量: <?php echo htmlentities($list['pv']); ?></a></li>
                </ol>
                </marquee>
                <div class="comments">
                    <div>
                        <img width="100" height="100" class="img-rounded" style="float:left;margin-right: 4px" src="/uploads/<?php echo htmlentities($list['title_img']); ?>">
                        <p style="font-size: 15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities(getArtContent($list['content'])); ?></p>
                    </div>
                </div>
                <p style="clear: both"></p>
            </div>
            <br>
            <?php endforeach; endif; else: echo "$empty" ;endif; ?>
            <div class="text-center">
                <?php echo $artList; ?>
            </div>
        </div>
        <script>
            $(function () {
                //下面是用户点击标题时从服务器获取该标题文章的评论内容还有阅读量+1 外加检查收藏状态
               $(".artName").on('click',function () {
                   $(".modal-comments").html("  ");
                   $("#buttonLog").html("  ");
                   var artId = $(this).find('input').val();

                   //显示收藏信息
                   var favInfo = $('#fav'+artId).val();
                   favInfo = parseInt(favInfo);
                   if(favInfo){
                       $('#favInfo'+artId).html('已收藏');
                   }else{
                       $('#favInfo'+artId).html('未收藏');
                   }
                    //下面是获取所有评论并阅读量+1
                   $.ajax({
                       type:'get',
                       url:"<?php echo url('getModalComments'); ?>",
                       data:{'artId':artId},
                       dataType:'json',
                       success:function (data) {
                           //console.log(data);
                           var html = null;
                           for(var count = 0;count < data.length;count++){
                               //var str = "<h2>内容:"+data[count].content+" 用户ID:"+data[count].id+"</h2><br>";
                               var str = "<div class='well col-md-12'>" +
                               "<a href='#' style='font-size:15px;padding-top:2px;'> <span class='glyphicon glyphicon-user'></span> 用户:"+data[count].name+"</a>&nbsp;&nbsp;|&nbsp;&nbsp;" +
                               "<a href='#' style='font-size:15px;padding-top:2px;'> <span class='glyphicon glyphicon-time'></span> 时间:"+new Date(data[count].create_time * 1000).toLocaleString().replace(/:\d{1,2}$/,' ')+"</a>" +
                               "<div class='col-md-12'>" +
                               "<p style='font-size:20px;'>"+data[count].content.replace(/<[^>]+>/g,"")+"</p>" +
                               "</div>" +
                               "</div>"
                               html += str;
                           }
                           html = html.replace('null', ' ');
                           $(".modal-comments").html(html);


                       }
                   });
               })

                //下面是收藏功能
                $(".fav").on('click',function () {
                    if($('#userId').val() == null){
                        dialog.error('登陆后才可以收藏哦');
                        return false;
                    }
                    var artId = $(this).find('.favInputArtId').val();
                    var userId = $("#userId").val();

                    var favInfo = $('#fav'+artId).val();
                    favInfo = parseInt(favInfo);
                    if(favInfo){
                        dialog.error('已经收藏了哦');
                    }else{
                        $.ajax({
                            type:'get',
                            url:"<?php echo url('fav'); ?>",
                            data:{'art_id':artId,'user_id':userId},
                            dataType:'json',
                            success:function (data) {
                                if(data){
                                    $('#favInfo'+artId).html('收藏成功');
                                    $('#fav'+artId).val(1);
                                }
                            }
                        });
                    }
                });

               //下面是点赞功能
                $(".like").on('click',function () {
                    if($('#userId').val() == null){
                        dialog.error('登陆后才可以点赞哦');
                        return false;
                    }
                    var artId = $(this).find('input').val();
                    var userId = $("#userId").val();
                    var count = $('#likeCount'+artId).html();
                    $.ajax({
                        type:'get',
                        url:"<?php echo url('like'); ?>",
                        data:{'art_id':artId,'user_id':userId},
                        dataType:'json',
                        success:function (data) {
                            //alert(data);
                            //console.log(data);
                            if(data){
                                //$('.likeCount').html(parseInt(count)+1);
                                //alert(data);
                                $('#likeCount'+artId).html(parseInt(count)+1);
                                //alert('谢谢支持！');
                            }else{
                                dialog.error('感谢支持，你已经点过赞了哦，不能重复点赞！');
                            }
                        }
                    });

                });



            });
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
<hr>
<center>
    蜀ICP备17041642号-1
</center>
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
