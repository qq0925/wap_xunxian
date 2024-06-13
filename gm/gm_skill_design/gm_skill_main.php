<p>[技能定义]<br/>
修改技能<br/>
<?php
try {
    // 获取POST表单数据
    if ($_SERVER["REQUEST_METHOD"] == "POST" &&$_POST['id'] !='') {
        $id = $_POST["id"];
        $setClause = '';
        $updateParams = array();

        // 遍历POST表单字段，构建SET部分和参数
        foreach ($_POST as $key => $value) {
            // 构建数据表字段名
            $tableFieldName = "j" . $key; // 表单字段名加上"j"前缀
            // 构建SET部分
            $setClause .= "$tableFieldName=?, ";
            // 构建参数数组
            $updateParams[] = $value;
        }

        // 去除SET部分末尾多余的逗号和空格
        $setClause = rtrim($setClause, ', ');

        // 构建完整的UPDATE SQL语句
        $sql = "UPDATE system_skill SET $setClause WHERE jid=?";
        // 使用预处理语句
        $stmt = $dblj->prepare($sql);

        // 绑定参数
        $updateParams[] = $id;
        $stmt->execute($updateParams);

        echo "修改成功!<br/>";
    }
} catch (PDOException $e) {
    echo "连接失败: " . $e->getMessage();
}

try {
    // 获取POST表单数据
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['id'] =='') {
        $insertColumns = '';
        $insertValues = '';
        $insertParams = array();

        // 遍历POST表单字段，构建插入列名和参数
        foreach ($_POST as $key => $value) {
            // 构建数据表字段名
            $tableFieldName = "j" . $key; // 表单字段名加上"j"前缀
            // 构建插入列名
            $insertColumns .= "$tableFieldName, ";
            // 构建参数占位符
            $insertValues .= "?, ";
            // 构建参数数组
            $insertParams[] = $value;
        }
        // 去除末尾多余的逗号和空格
        $insertColumns = rtrim($insertColumns, ', ');
        $insertValues = rtrim($insertValues, ', ');

        // 构建完整的INSERT INTO SQL语句
        $sql = "INSERT INTO system_skill ($insertColumns) VALUES ($insertValues)";
        // 使用预处理语句
        $stmt = $dblj->prepare($sql);

        // 执行插入操作
        $stmt->execute($insertParams);

        // 获取插入数据的自增ID值
        $insertedId = $dblj->lastInsertId();
        $skill_id = $insertedId;
        echo "新增技能成功！<br/>";
    }
} catch (PDOException $e) {
    echo "连接失败: " . $e->getMessage();
}

if($add_equip_id){
    $dblj->exec("UPDATE system_skill set jequip_appoint = '$add_equip_id' where jid = '$skill_id'");
    $add_equip_id = 0;
}

if($delete_equip_id){
    $dblj->exec("UPDATE system_skill set jequip_appoint = '' where jid = '$skill_id'");
    $delete_equip_id = 0;
}

$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_skilldefine&sid=$sid");
$sql = "select * from system_skill where jid = '$skill_id'";
$skill_post_canshu = 0;
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetch(PDO::FETCH_ASSOC);
    $skill_id = $gm_ret['jid'];
    $skill_name = $gm_ret['jname'];
    $skill_desc = $gm_ret['jdesc'];
    $skill_occasion = $gm_ret['joccasion'];
    $skill_group_attack = $gm_ret['jgroup_attack'];
    $skill_hurt_mod = $gm_ret['jhurt_mod'];
    $skill_cooling_time = $gm_ret['jcooling_time'];
    $skill_cooling_round = $gm_ret['jcooling_round'];
    $skill_hurt_exp = $gm_ret['jhurt_exp'];
    $skill_deplete_exp = $gm_ret['jdeplete_exp'];
    $skill_add_point_exp = $gm_ret['jadd_point_exp'];
    $skill_use_cond = $gm_ret['juse_cond'];
    $skill_cant_use_cmmt = $gm_ret['jcant_use_cmmt'];
    $skill_effect_cmmt = $gm_ret['jeffect_cmmt'];
    $skill_promotion = $gm_ret['jpromotion'];
    $skill_promotion_cond = $gm_ret['jpromotion_cond'];
    $jequip_type = $gm_ret['jequip_type'];
    $jhurt_attr = $gm_ret['jhurt_attr'];
    $jdeplete_attr = $gm_ret['jdeplete_attr'];
    $skill_specific_equip = $gm_ret['jequip_appoint'];
    $jevent_use_id = $gm_ret['jevent_use_id'];
    $jevent_up_id = $gm_ret['jevent_up_id'];
    $stmt = $dblj->query("SELECT iid, iname FROM system_item_module WHERE itype = '兵器' and iid ='$skill_specific_equip'");
    $equip_appoint = $stmt->fetch(PDO::FETCH_ASSOC);
    $equip_appoint_name = $equip_appoint['iname'];
    $equip_appoint_id = $equip_appoint['iid'];
    $skill_specific_choose = $encode->encode("cmd=gm_skill_appoint_choose&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
    if(!$equip_appoint_id){
    $skill_specific_equip = <<<HTML
    <a href="?cmd=$skill_specific_choose">选择兵器</a><br/>
HTML;
    }else{
    $skill_specific_delete = $encode->encode("cmd=gm_skill_def&delete_equip_id=$equip_appoint_id&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
    $skill_specific_equip = <<<HTML
    <a href="?cmd=$skill_specific_choose">{$equip_appoint_name}</a> <a href="?cmd=$skill_specific_delete">删除</a><br/>
HTML;
    }

    // 查询 system_equip_def 表中 type=1 的数据
    $stmt = $dblj->query("SELECT id, name FROM system_equip_def WHERE type = 1");
    $equip_def_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // 构建 <select> 元素
    $skill_equip_type = <<<HTML
    <select name="equip_type">
HTML;
    // 添加带特定条件的 <option> 选项
    $special_option = '<option value="19980925" ' . ($jequip_type == "19980925" ? 'selected' : '') . '>任意</option>';
    $skill_equip_type .= $special_option;
    foreach ($equip_def_data as $row) {
        $id = $row['id'];
        $name = $row['name'];
    
        $selected = ($jequip_type == $id) ? 'selected' : '';
    
        $option = '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
        $skill_equip_type .= <<<HTML
    $option
HTML;
    }
    $skill_equip_type .= <<<HTML
    </select>
HTML;
    // 查询 gm_game_attr 表中的数据
    $stmt = $dblj->query("SELECT id, name FROM gm_game_attr WHERE value_type = 1 and if_item_use_attr = 1");
    $equip_def_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // 构建 <select> 元素
    $skill_hurt_attr = <<<HTML
    <select name="hurt_attr">
HTML;
    $skill_deplete_attr = <<<HTML
    <select name="deplete_attr">
HTML;
    foreach ($equip_def_data as $row) {
        $id = $row['id'];
        $name = $row['name'];
    
        $selected_1 = ($jhurt_attr == $id) ? 'selected' : '';
        $selected_2 = ($jdeplete_attr == $id) ? 'selected' : '';
    
        $option_1 = '<option value="' . $id . '" ' . $selected_1 . '>' . $name . '</option>';
        $option_2 = '<option value="' . $id . '" ' . $selected_2 . '>' . $name . '</option>';
        $skill_hurt_attr .= <<<HTML
    $option_1
HTML;
        $skill_deplete_attr .= <<<HTML
    $option_2
HTML;
    }
    $skill_hurt_attr .= <<<HTML
    </select>
HTML;
    $skill_deplete_attr .= <<<HTML
    </select>
HTML;
    }
    $skill_occasion_choose = $skill_occasion ==0?'':'selected';
if($jevent_use_id ==0){
$add_value = $skill_name."使用";
$skill_use_event = $encode->encode("cmd=game_main_event&add_event=1&add_value=$add_value&gm_post_canshu=skill_use&main_id=$skill_id&event_id=$jevent_use_id&sid=$sid");
}else{
$skill_use_event = $encode->encode("cmd=game_main_event&gm_post_canshu=skill_use&main_id=$skill_id&event_id=$jevent_use_id&sid=$sid");
}
if($jevent_up_id ==0){
$add_value = $skill_name."升级";
$skill_up_event = $encode->encode("cmd=game_main_event&add_event=1&add_value=$add_value&gm_post_canshu=skill_up&main_id=$skill_id&event_id=$jevent_use_id&sid=$sid");
}else{
$skill_up_event = $encode->encode("cmd=game_main_event&gm_post_canshu=skill_up&main_id=$skill_id&event_id=$jevent_use_id&sid=$sid");
}
$skill_html = <<<HTML
</p>
<form method="post">
技能标识:j{$skill_id}<br/>
<input name="id" type="hidden" value="{$skill_id}">
技能名称:<input name="name" type="text" value="{$skill_name}" maxlength="50"/><br/>
技能描述:<textarea name="desc" maxlength="200" rows="4" cols="40">{$skill_desc}</textarea><br/>
使用场合:<select name="occasion" value="{$skill_occation}">
<option value="0">战斗中</option>
<option value="1" $skill_occasion_choose>非战斗中</option>
</select><br/>
攻击范围(-1表示攻击所有):<input name="group_attack" type="text" value="{$skill_group_attack}" maxlength="6"/><br/>
伤害系数:<input name="hurt_mod" type="text" value="{$skill_hurt_mod}" maxlength="6"/><br/>
冷却时间(秒):<input name="cooling_time" type="text" value="{$skill_cooling_time}" maxlength="6"/><br/>
冷却时间(回合):<input name="cooling_round" type="text" value="{$skill_cooling_round}" maxlength="6"/><br/>
伤害目标:{$skill_hurt_attr}<br/>
消耗目标:{$skill_deplete_attr}<br/>
伤害值公式:<textarea name="hurt_exp" maxlength="1024" rows="4" cols="40">{$skill_hurt_exp}</textarea><br/>
消耗值公式:<textarea name="deplete_exp" maxlength="1024" rows="4" cols="40">{$skill_deplete_exp}</textarea><br/>
使用一次增加熟练度表达式:<textarea name="add_point_exp" maxlength="1024" rows="4" cols="40">{$skill_add_point_exp}</textarea><br/>
使用兵器类型:{$skill_equip_type}<br/>
使用特定兵器:{$skill_specific_equip}
使用事件：<a href="?cmd=$skill_use_event">定义事件</a><br/>
升级事件：<a href="?cmd=$skill_up_event">定义事件</a><br/>
使用条件:<textarea name="use_cond" maxlength="1024" rows="4" cols="40">{$skill_use_cond}</textarea><br/>
不满足使用条件时的提示语:<textarea name="cant_use_cmmt" maxlength="200" rows="4" cols="40">{$skill_cant_use_cmmt}</textarea><br/>
使用效果描述:<textarea name="effect_cmmt" maxlength="200" rows="4" cols="40">{$skill_effect_cmmt}</textarea><br/>
升级公式:<textarea name="promotion" maxlength="1024" rows="4" cols="40">{$skill_promotion}</textarea><br/>
升级条件:<textarea name="promotion_cond" maxlength="1024" rows="4" cols="40">{$skill_promotion_cond}</textarea><br/>
<input type="submit" title="确定" value="确定"/><br/><br/>
<a href="">查看定义数据</a><br/>
<a href="">导入定义数据</a><br/>
<a href="">删除该技能</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $skill_html;
?>