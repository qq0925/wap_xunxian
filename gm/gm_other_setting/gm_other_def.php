<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$other_set = $encode->encode("cmd=gm_game_othersetting&canshu=other&sid=$sid");

if(!empty($_POST)){
foreach ($_POST as $key => $value) {
    switch ($key) {
        case 'offline_time':
            $sql = "update  gm_game_basic set player_offline_time = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'player_send_global_msg_interval':
            $sql = "update  gm_game_basic set player_send_global_msg_interval = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'near_player_show':
            $sql = "update  gm_game_basic set near_player_show = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'scene_op_br':
            $sql = "update  gm_game_basic set scene_op_br = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'npc_op_br':
            $sql = "update  gm_game_basic set npc_op_br = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'item_op_br':
            $sql = "update  gm_game_basic set item_op_br = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'list_row':
            $sql = "update  gm_game_basic set list_row = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'game_max_char':
            $sql = "update  gm_game_basic set game_max_char = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'default_storage':
            $sql = "update  gm_game_basic set default_storage = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
    }
    }
}

$game_config = \player\getgameconfig($dblj);
$selectedOption = ($game_config->scene_op_br == "1") ? 'selected' : '';
$selectedOption_2 = ($game_config->npc_op_br == "1") ? 'selected' : '';
$selectedOption_3 = ($game_config->item_op_br == "1") ? 'selected' : '';
$other_html = <<<HTML
[杂项设置]<br/><br/>
<form action="?cmd=$other_set" method="POST">
玩家离线时间(0为永久)：<input type="tel" name="offline_time" size="5" value="{$game_config->offline_time}">分钟
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
发送公共信息间隔(秒)：<input type="tel" name="player_send_global_msg_interval" size="5" value="{$game_config->player_send_global_msg_interval}">秒
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
列表行数：<input type="tel" name="list_row" size="5" value="{$game_config->list_row}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
最大信息字符数：<input type="tel" name="game_max_char" size="5" value="{$game_config->game_max_char}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
附近玩家显示：<input type="tel" name="near_player_show" size="5" value="{$game_config->near_player_show}">人
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
城市默认仓库容量：<input type="tel" name="default_storage" size="5" value="{$game_config->default_storage}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
场景操作列表是否换行：<select name="scene_op_br"><option value =0>否</option><option value =1 {$selectedOption}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
查看电脑人物操作列表是否换行：<select name="npc_op_br"><option value =0>否</option><option value =1 {$selectedOption_2}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
查看物品操作列表是否换行：<select name="item_op_br"><option value =0>否</option><option value =1 {$selectedOption_3}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $other_html;
?>