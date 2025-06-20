<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$other_set = $encode->encode("cmd=gm_game_othersetting&canshu=other&sid=$sid");

// 获取当前脚本所在的目录
$current_dir = dirname(__FILE__);

// 构建上级目录的同级 css 文件夹路径
$css_file_path = $current_dir . '/../../css/gamecss.css';
if (file_exists($css_file_path)) {
    // 读取文件内容并赋值给变量
    $gm_css_text = htmlspecialchars(file_get_contents($css_file_path));
}

// 构建上级目录的同级 js 文件夹路径
$js_file_path = $current_dir . '/../../js/global_js.js';
if (file_exists($js_file_path)) {
    // 读取文件内容并赋值给变量
    $gm_js_text = htmlspecialchars(file_get_contents($js_file_path));
}


if(!empty($_POST)){
foreach ($_POST as $key => $value) {
    switch ($key) {
        case 'offline_time':
            $sql = "update  gm_game_basic set player_offline_time = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'can_verify':
            $sql = "update  gm_game_basic set can_verify = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'flush_limit':
            $sql = "update  gm_game_basic set flush_limit = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'int_long':
            $sql = "update  gm_game_basic set int_long = '$value' where game_id = 19980925";
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
        case 'fight_mod':
            $sql = "update  gm_game_basic set fight_mod = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'equip_mosaic_link':
            $sql = "update  gm_game_basic set equip_mosaic_link = '$value' where game_id = 19980925";
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
        case 'npc_list_br':
            $sql = "update  gm_game_basic set npc_list_br = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'npc_seg':
            $sql = "update  gm_game_basic set npc_seg = '$value' where game_id = 19980925";
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
        case 'scene_message_count':
            $sql = "update  gm_game_basic set scene_message_count = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'scene_chat_time':
            $sql = "update  gm_game_basic set scene_chat_time = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'long_exist_message':
            $sql = "update  gm_game_basic set long_exist_message = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'can_input':
            $sql = "update  gm_game_basic set can_input = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'default_storage':
            $sql = "update  gm_game_basic set default_storage = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'drop_protect_time':
            $sql = "update  gm_game_basic set drop_protect_time = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'drop_disappear_time':
            $sql = "update  gm_game_basic set drop_disappear_time = '$value' where game_id = 19980925";
            $dblj->exec($sql);
            break;
        case 'gm_css_text':
            // 获取提交的CSS内容
            $gm_css_text = $_POST['gm_css_text'] ?? '';
            // 写入文件
            if (file_put_contents($css_file_path, $gm_css_text) !== false) {
                $message = "CSS文件已成功更新。";
            } else {
                $message = "更新CSS文件时出错。";
            }
            
            if (file_exists($css_file_path)) {
                // 读取文件内容并赋值给变量
                $gm_css_text = file_get_contents($css_file_path);
            }
            break;
        case 'gm_js_text':
            // 获取提交的js内容
            $gm_js_text = $_POST['gm_js_text'] ?? '';
            // 写入文件
            if (file_put_contents($js_file_path, $gm_js_text) !== false) {
                $message = "js文件已成功更新。";
            } else {
                $message = "更新js文件时出错。";
            }
            
            if (file_exists($js_file_path)) {
                // 读取文件内容并赋值给变量
                $gm_js_text = file_get_contents($js_file_path);
            }
            break;
    }
    }
}

$game_config = \player\getgameconfig($dblj);
$selectedOption = ($game_config->scene_op_br == "1") ? 'selected' : '';
$selectedOption_2 = ($game_config->npc_op_br == "1") ? 'selected' : '';
$selectedOption_3 = ($game_config->item_op_br == "1") ? 'selected' : '';
$selectedOption_4 = ($game_config->npc_list_br == "1") ? 'selected' : '';
$selectedOption_5 = ($game_config->equip_mosaic_link == "1") ? 'selected' : '';
$selectedOption_6 = ($game_config->long_exist_message == "1") ? 'selected' : '';
$selectedOption_7 = ($game_config->can_verify == "1") ? 'selected' : '';
$selectedOption_8 = ($game_config->can_input == "1") ? 'selected' : '';
$selectedOption_9 = ($game_config->scene_chat_time == "1") ? 'selected' : '';
$selectedOption_10 = ($game_config->fight_mod == "1") ? 'selected' : '';
$selectedOption_11 = ($game_config->fight_mod == "2") ? 'selected' : '';
$selectedOption_12 = ($game_config->int_long == "1") ? 'selected' : '';
$selectedOption_13 = ($game_config->int_long == "2") ? 'selected' : '';
$other_html = <<<HTML
[杂项设置]<br/><br/>
<form action="?cmd=$other_set" method="POST">
玩家离线时间(0为永久)：<input type="tel" name="offline_time" size="5" value="{$game_config->offline_time}">分钟
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
是否开启防挂验证：<select name="can_verify"><option value =0>否</option><option value =1 {$selectedOption_7}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
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
整数型默认长度：<select name="int_long"><option value =0>11位数</option><option value =1 {$selectedOption_12}>20位数</option><option value =2 {$selectedOption_13}>65位数</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
刷新频率(0为不限制)：<input type="tel" name="flush_limit" size="5" value="{$game_config->flush_limit}">ms
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
战斗模式：<select name="fight_mod">
<option value =0>统一出招回合制</option><option value =1 {$selectedOption_10}>分配出招回合制</option><option value =2 {$selectedOption_11}>自动动画回合制</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
---<br/>
<form action="?cmd=$other_set" method="POST">
场景显示信息条数：<input type="tel" name="scene_message_count" size="5" value="{$game_config->scene_message_count}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
场景信息持久显示：<select name="long_exist_message"><option value =0>否</option><option value =1 {$selectedOption_6}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
场景信息发言时间显示：<select name="scene_chat_time"><option value =0>否</option><option value =1 {$selectedOption_9}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
是否显示输入框：<select name="can_input"><option value =0>否</option><option value =1 {$selectedOption_8}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
最大信息字符数：<input type="tel" name="game_max_char" size="5" value="{$game_config->game_max_char}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
附近玩家显示：<input type="tel" name="near_player_show" size="5" value="{$game_config->near_player_show}">人
<input type="submit" value="保存"/>
</form>
---<br/>
<form action="?cmd=$other_set" method="POST">
城市默认仓库容量：<input type="tel" name="default_storage" size="5" value="{$game_config->default_storage}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
掉落物品保护时长：<input type="tel" name="drop_protect_time" size="5" value="{$game_config->drop_protect_time}">秒
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
掉落物品消失时长：<input type="tel" name="drop_disappear_time" size="5" value="{$game_config->drop_disappear_time}">秒
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
卸装是否同步卸下镶嵌物：<select name="equip_mosaic_link"><option value =0>否</option><option value =1 {$selectedOption_5}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
---<br/>
<form action="?cmd=$other_set" method="POST">
场景操作列表是否换行：<select name="scene_op_br"><option value =0>否</option><option value =1 {$selectedOption}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
查看电脑人物操作列表是否换行：<select name="npc_op_br"><option value =0>否</option><option value =1 {$selectedOption_2}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
场景电脑人物列表是否换行：<select name="npc_list_br"><option value =0>否</option><option value =1 {$selectedOption_4}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
<form action="?cmd=$other_set" method="POST">
场景电脑人物分隔符：<input type="text" name="npc_seg" size="5" value="{$game_config->npc_seg}">
<input type="submit" value="保存"/>
</form>
<form action="?cmd=$other_set" method="POST">
查看物品操作列表是否换行：<select name="item_op_br"><option value =0>否</option><option value =1 {$selectedOption_3}>是</option></select> <input name="submit" type="submit" title="保存" value="保存" />
</form>
---<br/>
全局css样式编写:<br/>
<form action="?cmd=$other_set" method="POST">
<textarea name="gm_css_text" maxlength="-1" rows="8" cols="40" >{$gm_css_text}</textarea>
<input name="submit" type="submit" title="保存" value="保存" >
</form>
全局js样式编写:<br/>
<form action="?cmd=$other_set" method="POST">
<textarea name="gm_js_text" maxlength="-1" rows="8" cols="40" >{$gm_js_text}</textarea>
<input name="submit" type="submit" title="保存" value="保存" >
</form>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;

//背景颜色:<select name="text_color"><option value =0>黑</option><option value =1 {$selectedOption}>白</option><option value =2 {$selectedOption}>灰</option><option value =3 {$selectedOption}>青</option></select><br/>
// 文字颜色:<select name="text_color"><option value =0>黑</option><option value =1 {$selectedOption}>白</option></select><br/>
// 命令颜色:<select name="text_color"><option value =0>浅绿</option><option value =1 {$selectedOption}>浅蓝</option><option value =2 {$selectedOption}>深黄</option><option value =3 {$selectedOption}>深粉</option><option value =3 {$selectedOption}>深橘</option></select><br/>

echo $other_html;
?>