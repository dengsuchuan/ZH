<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//根据用户的主键，查询用户名称
use think\Db;


if(!function_exists('getUserName')){
    function getUserName($id){
        return Db::table("zh_user")->where('id',$id)->value('name');
    }
}

if(!function_exists('getCate')){
    function getCate($id){
        return Db::table('zh_article_category')->where('id',$id)->value('title');
    }
}

//显示原生的html标签
function getHtmlContent($id){
    $htmlContent = Db::table('zh_article')->where('id',$id)->value('content');
//    $str = htmlspecialchars_decode($htmlContent);
//    dump($htmlContent);
    echo $htmlContent;
}




//过滤文章内容
function getArtContent($content){
    $str = mb_substr(strip_tags(str_replace(['&nbsp;','nbsp;','&amp;','nbsp;'],'',$content)),0,180).'......';
    $str = htmlspecialchars($str);
    return $str;

}

//过滤评论内容
function getComm($content){
    return strip_tags(str_replace(['&nbsp;','nbsp;','&amp;','nbsp;'],'',$content));
}

//获取文章点赞量
function getLink($artId){
    $res = Db::query("SELECT * FROM `zh_user_like` WHERE `art_id` = $artId");
    return count($res);
}

//查看用户是否收藏该文章
function getFav($artId,$userId){
    $res = Db::query("SELECT * FROM `zh_user_fav` WHERE `art_id` = $artId and `user_id` = $userId");
    return count($res);
}
//查看该文章被多少用户收藏
function getFavCount($artId){
    $res = Db::query("SELECT * FROM `zh_user_fav` WHERE `art_id` = $artId");
    return count($res);
}

function getUserName($userId){
    $res = Db::query("SELECT `name` FROM `zh_user` WHERE `id` = $userId");
    if(count($res) == 0){
        return count($res);
    }else{
        return $res[0]['name'];
    }


}

//截取右边的展示内容
function msubstr($content) {
    return substr(strip_tags(str_replace(['&nbsp;','nbsp;','&amp;','nbsp;'],'',$content)),0,15).'...';
}



