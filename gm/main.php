<?php
$can_redis = $GLOBALS['can_redis'];
if($remove_canshu!=1&&$remove_canshu!=3&&$remove_canshu!=5){
    
    if($remove_canshu==2){
        echo "已清空公共聊天数据！<br/>";
        $dblj->exec("delete from system_chat_data where chat_type = '0'");
    }

    if($remove_canshu==4){
        echo "已清空缓存数据！<br/>";
        $redis->flushAll(true); // 异步清空所有数据库
    }


$dblj->exec("update system_designer_assist set op_target = '',op_canshu = '' where sid = '$sid'");
$player = \player\getplayer($sid,$dblj);
$game_data = \player\getbasicgmdata($dblj);
$lexical_test = $encode->encode("cmd=lexical_post&sid=$sid");
$self_module_api = $encode->encode("cmd=self_module_api&sid=$sid");
$gonewmid = $encode->encode("cmd=gm_scene_new&newmid=$player->nowmid&sid=$sid");
$gm_game_basicinfo = $encode->encode("cmd=gm_game_basicinfo&sid=$sid");
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&sid=$sid");
$gm_game_expdefine = $encode->encode("cmd=gm_game_expdefine&sid=$sid");
$gm_game_equiptypedefine = $encode->encode("cmd=gm_game_equiptypedefine&sid=$sid");
$gm_game_globaleventdefine = $encode->encode("cmd=gm_game_globaleventdefine&sid=$sid");
$gm_game_pagemoduledefine = $encode->encode("cmd=gm_game_pagemoduledefine&sid=$sid");
$gm_game_photomanage = $encode->encode("cmd=gm_game_photomanage&sid=$sid");
$gm_game_skilldefine = $encode->encode("cmd=gm_game_skilldefine&sid=$sid");
$gm_game_mapdesign = $encode->encode("cmd=gm_map_2&sid=$sid");
$gm_game_itemdesign = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
$gm_game_npcdesign = $encode->encode("cmd=gm_game_npcdesign&sid=$sid");
$gm_game_taskdesign = $encode->encode("cmd=gm_game_taskdesign&sid=$sid");
$gm_game_othersetting = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$gm_game_logdownload = $encode->encode("cmd=gm_game_logdownload&sid=$sid");
$gm_game_savealldata = $encode->encode("cmd=gm_game_savealldata&sid=$sid");
$gothefirstpage = $encode->encode("cmd=gm_game_firstpage&sid=$sid");
$gm_global_notice = $encode->encode("cmd=gm_global_notice&sid=$sid");
$gm_design_guide = $encode->encode("cmd=gm_design_guide&sid=$sid");
$gm_game_bossdesign = $encode->encode("cmd=gm_game_bossdesign&sid=$sid");
$gm_game_buffdesign = $encode->encode("cmd=gm_game_buffdesign&sid=$sid");
$gm_game_fbdesign = $encode->encode("cmd=gm_game_fbdesign&sid=$sid");
$gm_game_rpdesign = $encode->encode("cmd=gm_game_rpdesign&rp_canshu=0&sid=$sid");
$gm_game_lpdesign = $encode->encode("cmd=gm_game_lpdesign&lp_canshu=0&sid=$sid");
//$gm_game_mkdesign = $encode->encode("cmd=gm_game_mkdesign&mk_canshu=0&sid=$sid");
$gm_online_list = $encode->encode("cmd=nowonline&design_canshu=1&sid=$sid");
$remove_all_chat = $encode->encode("cmd=gm&remove_canshu=1&sid=$sid");
$global_value_design = $encode->encode("cmd=global_value_design&sid=$sid");
$gm_zip_update = $encode->encode("cmd=gm_game_zipfile&type=update&sid=$sid");
$gm_zip_all = $encode->encode("cmd=gm_game_zipfile&type=all&sid=$sid");
if($can_redis){
$del_all_cache = $encode->encode("cmd=gm&remove_canshu=3&sid=$sid");
$view_all_cache = $encode->encode("cmd=gm&remove_canshu=5&sid=$sid");
$cache_page =<<<HTML
<a href="?cmd=$del_all_cache">清空全部缓存</a><br/>
<a href="?cmd=$view_all_cache">查看全部缓存</a><br/>
HTML;
}else{
$cache_page =<<<HTML
<a href="#">清空全部缓存</a><br/>
<a href="#">查看全部缓存</a><br/>
HTML;
}
$gm_game_timerdesign = $encode->encode("cmd=gm_game_timerdesign&sid=$sid");
$gm_post_canshu = 0;
$post_tishi = '';
$gm_html = <<<HTML
<p>[游戏设计大厅]<br/>
<a href="?cmd=$gonewmid">前往场景</a>|<a href="?cmd=$gothefirstpage">前往首页</a><br/>
(在线人数/注册人数)：(<a href="?cmd=$gm_online_list">{$game_data->online_count}</a>/{$game_data->player_count})<br/>
公共聊天信息数量：($game_data->global_chat_count)<a href="?cmd=$remove_all_chat">清空</a><br/>
---<br/>
<a href="?cmd=$gm_game_basicinfo">基本信息</a><br/>
<a href="?cmd=$gm_game_attrdefine">定义属性</a><br/>
<a href="?cmd=$gm_game_equiptypedefine">装备类别</a><br/>
<a href="?cmd=$gm_game_globaleventdefine">公共事件</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine">定义页面模板</a><br/>
---<br/>
<a href="?cmd=$gm_game_expdefine">公共表达式({$game_data->exp_count})</a><br/>
<a href="?cmd=$gm_game_skilldefine">设计技能({$game_data->skill_count})</a><br/>
<a href="?cmd=$gm_game_mapdesign">设计地图({$game_data->map_count})</a><br/>
<a href="?cmd=$gm_game_itemdesign">设计物品({$game_data->item_count})</a><br/>
<a href="?cmd=$gm_game_npcdesign">设计电脑人物({$game_data->npc_count})</a><br/>
<a href="?cmd=$gm_game_taskdesign">设计任务({$game_data->task_count})</a><br/>
<a href="?cmd=$gm_game_buffdesign">设计BUFF({$game_data->buff_count})</a>!!!<br/>
---</br>
<a href="?cmd=$gm_game_bossdesign">设计世界BOSS({$game_data->boss_count})</a>!!!<br/>
<a href="?cmd=$gm_game_fbdesign">设计副本({$game_data->fb_count})</a>!!!<br/>
<a href="?cmd=$gm_game_lpdesign">设计生活职业({$game_data->lp_count})</a><br/>
<!--<a href="?cmd=$gm_game_mkdesign">设计制造系统({$game_data->mk_count})</a>!!!<br/>-->
<a href="?cmd=$gm_game_rpdesign">设计资源点({$game_data->rp_count})</a><br/>
---</br>
<a href="?cmd=$gm_game_photomanage">管理图片({$game_data->photo_count})</a><br/>
<a href="?cmd=$gm_game_othersetting">功能设置</a><br/>
<a href="?cmd=$gm_game_timerdesign">设计定时器</a><br/>
<a href="?cmd=$gm_global_notice">发布临时公告</a><br/>
$cache_page
---</br>
<a href="?cmd=$lexical_test">词法解析</a><br/>
<a href="?cmd=$self_module_api">自定模板模拟</a><br/>
<a href="?cmd=$global_value_design">设计公共数据</a><br/>
---</br>
<a href="?cmd=$gm_game_logdownload">日志下载</a><br/>
<a href="?cmd=$gm_design_guide">设计文档</a><br/>
<a href="?cmd=$gm_zip_update">源文件更新压缩</a><br/>
<a href="?cmd=$gm_zip_all">源文件全部压缩</a><br/>
---</br>
HTML;
}elseif($remove_canshu ==1){
    $sure_main = $encode->encode("cmd=gm&remove_canshu=2&sid=$sid");
    $cancel_main = $encode->encode("cmd=gm&sid=$sid");
    $gm_html =<<<HTML
    是否清空公聊信息<br/>
<a href="?cmd=$sure_main">确定</a> | <a href="?cmd=$cancel_main">取消</a><br/>
HTML;
}
elseif($remove_canshu ==3){
    $sure_main = $encode->encode("cmd=gm&remove_canshu=4&sid=$sid");
    $cancel_main = $encode->encode("cmd=gm&sid=$sid");
    if($redis){
    $gm_html =<<<HTML
    是否清空缓存信息<br/>
<a href="?cmd=$sure_main">确定</a> | <a href="?cmd=$cancel_main">取消</a><br/>
HTML;
}else{
    $gm_html =<<<HTML
    redis不存在！<br/>
<a href="?cmd=$cancel_main">返回设计大厅</a><br/>
HTML;
}
}
elseif($remove_canshu ==5){
if($redis){
$iterator = null; // 初始化迭代器
$pattern = '*';   // 匹配所有键

do {
    // 使用 SCAN 获取键名
    $keys = $redis->scan($iterator, $pattern);

    if ($keys !== false) {
        foreach ($keys as $key) {
            $value = $redis->get($key); // 获取每个键的值
            $all_cache .= "Key: $key, Value: $value <br/>"; // 输出键和值
        }
    }
} while ($iterator > 0); // 当迭代器为 0 时，表示已经遍历完成

    
    $ret_main = $encode->encode("cmd=gm&sid=$sid");
    $gm_html =<<<HTML
<a href="?cmd=$ret_main">返回设计大厅</a><br/>
$all_cache
HTML;
}else{
    $ret_main = $encode->encode("cmd=gm&sid=$sid");
    $gm_html =<<<HTML
    你没有开启redis服务！<br/>
<a href="?cmd=$ret_main">返回设计大厅</a><br/>
$all_cache
HTML;
}
}
echo $gm_html;
?>