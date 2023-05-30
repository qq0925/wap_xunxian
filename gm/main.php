<?php
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$gm_game_basicinfo = $encode->encode("cmd=gm_game_basicinfo&canshu=posted&sid=$sid");
$gm_game_attrdefine = $encode->encode("cmd=gm_game_attrdefine&gm_post_canshu=0&gm_post_canshu_2=0&sid=$sid");
$gm_game_expdefine = $encode->encode("cmd=gm_game_expdefine&sid=$sid");
$gm_game_equiptypedefine = $encode->encode("cmd=gm_game_equiptypedefine&sid=$sid");
$gm_game_globaleventdefine = $encode->encode("cmd=gm_game_globaleventdefine&sid=$sid");
$gm_game_pagemoduledefine = $encode->encode("cmd=gm_game_pagemoduledefine&sid=$sid");
$gm_game_photomanage = $encode->encode("cmd=gm_game_photomanage&sid=$sid");
$gm_game_skilldefine = $encode->encode("cmd=gm_game_skilldefine&sid=$sid");
$gm_game_mapdesign = $encode->encode("cmd=gm_map_2&sid=$sid");
$gm_game_itemdesign = $encode->encode("cmd=gm_game_itemdesign&sid=$sid");
$gm_game_npcdesign = $encode->encode("cmd=gm_game_npcdesign&sid=$sid");
$gm_game_othersetting = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$gm_game_logdownload = $encode->encode("cmd=gm_game_logdownload&sid=$sid");
$gm_game_savealldata = $encode->encode("cmd=gm_game_savealldata&sid=$sid");
$gothefirstpage = $encode->encode("cmd=gm_game_firstpage&sid=$sid");

$gm_post_canshu = 0;
$post_tishi = '';
$gm_html = <<<HTML
<p>[游戏设计大厅]<br/>
<a href="?cmd=$gm_game_basicinfo">基本信息</a><br/>
<a href="?cmd=$gm_game_attrdefine">定义属性</a><br/>
<a href="?cmd=$gm_game_expdefine">定义表达式</a><br/>
<a href="?cmd=$gm_game_equiptypedefine">定义装备类别</a><br/>
<a href="?cmd=$gm_game_globaleventdefine">定义公共事件</a><br/>
<a href="?cmd=$gm_game_pagemoduledefine">定义页面模板</a><br/>
<a href="?cmd=$gm_game_photomanage">管理图片</a><br/>
<a href="?cmd=$gm_game_skilldefine">定义技能</a><br/>
<a href="?cmd=$gm_game_mapdesign">设计地图</a><br/>
<a href="?cmd=$gm_game_itemdesign">设计物品</a><br/>
<a href="?cmd=$gm_game_npcdesign">设计电脑人物</a><br/><br/>
<p>下面的先不弄</p>
<a href="?cmd=$gm_game_othersetting">其他设置</a><br/>
<a href="?cmd=$gm_game_logdownload">日志下载</a><br/>
<a href="?cmd=$gm_game_savealldata">保存所有数据</a><br/>
<br/>
<a href="?cmd=$gothefirstpage">返回游戏首页</a><br/>
<a href="?cmd=$gonowmid">返回游戏场景</a>
HTML;
echo $gm_html;
?>