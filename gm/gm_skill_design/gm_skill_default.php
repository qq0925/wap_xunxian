<p>[技能定义]<br/>
修改技能默认值<br/>
<?php
try {
    // 获取POST表单数据
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $sql = "UPDATE system_skill_module SET $setClause where jid = '2'";
        // 使用预处理语句
        $stmt = $dblj->prepare($sql);
        // 绑定参数
        $stmt->execute($updateParams);
        echo "修改成功!<br/>";
    }
} catch (PDOException $e) {
    echo "连接失败: " . $e->getMessage();
}

if($cover ==1 && !$_POST){

// 获取 jid 为 1 的数据
$selectSql = "SELECT * FROM system_skill_module WHERE jid = 1";
$stmt = $dblj->prepare($selectSql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// 更新 jid 为 2 的数据
$updateSql = "UPDATE system_skill_module SET
    jhurt_attr = :jhurt_attr,
    jdeplete_attr = :jdeplete_attr,
    jhurt_exp = :jhurt_exp,
    jdeplete_exp = :jdeplete_exp,
    jadd_point_exp = :jadd_point_exp,
    jpromotion = :jpromotion,
    jpromotion_cond = :jpromotion_cond,
    jeffect_cmmt = :jeffect_cmmt,
    jevent_use_id = :jevent_use_id,
    jevent_up_id = :jevent_up_id
    WHERE jid = 2";

$updateStmt = $dblj->prepare($updateSql);
$updateStmt->execute(array(
    ':jhurt_attr' => $row['jhurt_attr'],
    ':jdeplete_attr' => $row['jdeplete_attr'],
    ':jhurt_exp' => $row['jhurt_exp'],
    ':jdeplete_exp' => $row['jdeplete_exp'],
    ':jadd_point_exp' => $row['jadd_point_exp'],
    ':jpromotion' => $row['jpromotion'],
    ':jpromotion_cond' => $row['jpromotion_cond'],
    ':jeffect_cmmt' => $row['jeffect_cmmt'],
    ':jevent_use_id' => $row['jevent_use_id'],
    ':jevent_up_id' => $row['jevent_up_id']
));

echo "重置完成!<br/>";
}
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_skilldefine&sid=$sid");
$skill_default = $encode->encode("cmd=gm_skill_def&skill_post_canshu=5&cover=1&sid=$sid");
$sql = "select * from system_skill_module where jid ='2'";
$skill_post_canshu = 0;
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetch(PDO::FETCH_ASSOC);
    $skill_hurt_exp = $gm_ret['jhurt_exp'];
    $skill_deplete_exp = $gm_ret['jdeplete_exp'];
    $skill_add_point_exp = $gm_ret['jadd_point_exp'];
    $skill_effect_cmmt = $gm_ret['jeffect_cmmt'];
    $skill_promotion = $gm_ret['jpromotion'];
    $skill_promotion_cond = $gm_ret['jpromotion_cond'];
    $jhurt_attr = $gm_ret['jhurt_attr'];
    $jdeplete_attr = $gm_ret['jdeplete_attr'];
    $jevent_use_id = $gm_ret['jevent_use_id'];
    $jevent_up_id = $gm_ret['jevent_up_id'];
    
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
$skill_use_event = $encode->encode("cmd=game_main_event&add_event=1&add_value=技能默认使用&gm_post_canshu=skill_default_use&main_id=2&event_id=$jevent_use_id&sid=$sid");
}else{
$skill_use_event = $encode->encode("cmd=game_main_event&gm_post_canshu=skill_default_use&main_id=2&event_id=$jevent_use_id&sid=$sid");
}
$skill_html = <<<HTML
</p>
<form method="post">
伤害目标:{$skill_hurt_attr}<br/>
消耗目标:{$skill_deplete_attr}<br/>
伤害值公式:<textarea name="hurt_exp" maxlength="1024" rows="4" cols="40">{$skill_hurt_exp}</textarea><br/>
消耗值公式:<textarea name="deplete_exp" maxlength="1024" rows="4" cols="40">{$skill_deplete_exp}</textarea><br/>
使用一次增加熟练度表达式:<textarea name="add_point_exp" maxlength="1024" rows="4" cols="40">{$skill_add_point_exp}</textarea><br/>
使用效果描述:<textarea name="effect_cmmt" maxlength="200" rows="4" cols="40">{$skill_effect_cmmt}</textarea><br/>
升级公式:<textarea name="promotion" maxlength="1024" rows="4" cols="40">{$skill_promotion}</textarea><br/>
升级条件:<textarea name="promotion_cond" maxlength="1024" rows="4" cols="40">{$skill_promotion_cond}</textarea><br/>
使用事件：<a href="?cmd=$skill_use_event">定义事件</a><br/>
升级事件：<a href="?cmd=$skill_up_event">定义事件</a><br/>
<input type="submit" title="确定" value="确定"/><br/><br/>
<a href="?cmd=$skill_default">还原为默认值</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $skill_html;
?>