<p>[技能定义]<br/>
增加技能<br/>
<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_skilldefine&sid=$sid");
$skill_add_post = $encode->encode("cmd=gm_skill_def&skill_post_canshu=1&sid=$sid");
$stmt = $dblj->query("SELECT id, name FROM gm_game_attr WHERE value_type = 1 and if_item_use_attr = 1");
$equip_def_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // 构建 <select> 元素
    $skill_hurt_attr = <<<HTML
    <select name="hurt_attr">
HTML;
    $skill_hurt_attr .= $special_option;
    foreach ($equip_def_data as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $option = '<option value="' . $id . '" '  . '>' . $name . '</option>';
        $skill_hurt_attr .= <<<HTML
    $option
HTML;
    }
    $skill_hurt_attr .= <<<HTML
    </select>
HTML;

$stmt = $dblj->query("SELECT id, name FROM gm_game_attr WHERE value_type = 1 and if_item_use_attr = 1");
$equip_def_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // 构建 <select> 元素
    $skill_deplete_attr = <<<HTML
    <select name="deplete_attr">
HTML;
    $skill_deplete_attr .= $special_option;
    foreach ($equip_def_data as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $option = '<option value="' . $id . '" '  . '>' . $name . '</option>';
        $skill_deplete_attr .= <<<HTML
    $option
HTML;
    }
    $skill_deplete_attr .= <<<HTML
    </select>
HTML;

$stmt = $dblj->query("SELECT id, name FROM system_equip_def WHERE type = 1");
$equip_def_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // 构建 <select> 元素
    $skill_equip_type = <<<HTML
    <select name="equip_type">
HTML;
    // 添加带特定条件的 <option> 选项
    $special_option = '<option value="19980925" ' . '>任意</option>';
    $skill_equip_type .= $special_option;
    foreach ($equip_def_data as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $option = '<option value="' . $id . '" '  . '>' . $name . '</option>';
        $skill_equip_type .= <<<HTML
    $option
HTML;
    }
    $skill_equip_type .= <<<HTML
    </select>
HTML;
$skill_add_html = <<<HTML
</p>
<form action="?cmd=$skill_add_post" method="post">
技能标识:<br/>
<input name="id" type="hidden">
技能名称:<input name="name" type="text"  maxlength="50"/><br/>
技能描述:<textarea name="desc" maxlength="200" rows="4" cols="40"></textarea><br/>
使用场合:<select name="occasion" >
<option value="0">战斗中</option>
<option value="1">非战斗中</option>
</select><br/>
攻击范围(-1表示攻击所有):<input name="group_attack" type="text"  maxlength="6"/><br/>
伤害系数:<input name="hurt_mod" type="text"  maxlength="6"/><br/>
冷却时间(秒):<input name="cooling_time" type="text"  maxlength="6"/><br/>
冷却时间(回合):<input name="cooling_round" type="text"  maxlength="6"/><br/>
伤害目标:{$skill_hurt_attr}<br/>
消耗目标:{$skill_deplete_attr}<br/>
伤害值公式:<textarea name="hurt_exp" maxlength="1024" rows="4" cols="40"></textarea><br/>
消耗值公式:<textarea name="deplete_exp" maxlength="1024" rows="4" cols="40"></textarea><br/>
使用一次增加熟练度表达式:<textarea name="add_point_exp" maxlength="1024" rows="4" cols="40"></textarea><br/>
使用兵器类型:{$skill_equip_type}<br/>

使用条件:<textarea name="use_cond" maxlength="1024" rows="4" cols="40"></textarea><br/>
不满足使用条件时的提示语:<textarea name="cant_use_cmmt" maxlength="200" rows="4" cols="40"></textarea><br/>
使用效果描述:<textarea name="effect_cmmt" maxlength="200" rows="4" cols="40"></textarea><br/>
升级公式:<textarea name="promotion" maxlength="1024" rows="4" cols="40"></textarea><br/>
升级条件:<textarea name="promotion_cond" maxlength="1024" rows="4" cols="40"></textarea><br/>
<input type="submit" title="确定" value="确定"/><br/><br/>
<a href="">查看定义数据</a><br/>
<a href="">导入定义数据</a><br/>
<a href="">删除该技能</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $skill_add_html;
?>