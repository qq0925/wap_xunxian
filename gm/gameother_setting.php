<?php

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$area_def = $encode->encode("cmd=gm_game_othersetting&canshu=1&sid=$sid");
$designer_def = $encode->encode("cmd=gm_game_othersetting&canshu=2&sid=$sid");
$other_def = $encode->encode("cmd=gm_game_othersetting&canshu=3&sid=$sid");
$player_def = $encode->encode("cmd=gm_game_othersetting&canshu=4&sid=$sid");
$reward_def = $encode->encode("cmd=gm_game_othersetting&canshu=5&sid=$sid");
$money_def = $encode->encode("cmd=gm_game_othersetting&canshu=6&sid=$sid");
$rank_def = $encode->encode("cmd=gm_game_othersetting&canshu=7&sid=$sid");
$battle_def = $encode->encode("cmd=gm_game_othersetting&canshu=8&sid=$sid");
$auc_def = $encode->encode("cmd=gm_game_othersetting&auc_canshu=0&canshu=9&sid=$sid");
$reboot_all = $encode->encode("cmd=gm_game_othersetting&canshu=10&sid=$sid");
$shop_def = $encode->encode("cmd=gm_game_othersetting&canshu=11&sid=$sid");
$addition_def = $encode->encode("cmd=gm_game_othersetting&canshu=12&sid=$sid");
$item_head_def = $encode->encode("cmd=gm_game_othersetting&canshu=13&sid=$sid");
$chat_head_def = $encode->encode("cmd=gm_game_othersetting&canshu=14&sid=$sid");
$fight_head_def = $encode->encode("cmd=gm_game_othersetting&canshu=15&sid=$sid");
$setting_html = <<<HTML
[功能列表]<br/><br/>
<a href="?cmd=$area_def">分区管理</a>(✔)<br/>
<a href="?cmd=$money_def">货币管理</a>(✔)<br/>
<a href="?cmd=$reward_def">抽奖系统</a>(✔)<br/>
<a href="?cmd=$auc_def">拍卖行管理</a>(✔)<br/>
<a href="?cmd=$rank_def">排行榜管理</a>(✔)<br/>
<a href="?cmd=$battle_def">竟技场管理</a><br/>
---<br/>
<a href="?cmd=$player_def">玩家数据管理</a>(✔)<br/>
<a href="?cmd=$addition_def">addition表管理</a>(✔)<br/>
<a href="?cmd=$designer_def">设计者管理</a>(✔)<br/>
<a href="?cmd=$other_def">杂项管理</a>(✔)<br/>
<a href="?cmd=$shop_def">商城管理</a>(✔)<br/>
---<br/>
<a href="?cmd=$item_head_def">物品栏头部设计</a>(✔)<br/>
<a href="?cmd=$chat_head_def">聊天栏头部设计</a>(✔)<br/>
<a href="?cmd=$fight_head_def">战斗结算页面设计</a><br/>
---<br/>
<a href="?cmd=$reboot_all">清空游戏数据</a><br/>
<br/><a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $setting_html;
?>