<?php

if($delete_name){
    try {
        // 正确的SQL查询语句
        $sql = "DELETE FROM system_addition_attr WHERE sid = :d_sid AND oid = :d_oid AND mid = :d_mid AND name = :d_name";
        
        // 准备并执行语句
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':d_sid', $del_sid, PDO::PARAM_INT);
        $stmt->bindParam(':d_oid', $del_oid, PDO::PARAM_INT);
        $stmt->bindParam(':d_mid', $del_mid, PDO::PARAM_INT);
        $stmt->bindParam(':d_name', $delete_name, PDO::PARAM_STR);
        
        if($stmt->execute()) {
            $affected_rows = $stmt->rowCount();
            if($affected_rows > 0) {
                echo "已成功删除 {$delete_name} 属性数据！<br/>";
            } else {
                echo "未找到要删除的属性数据！<br/>";
            }
        } else {
            echo "删除操作失败，请检查数据库连接！<br/>";
        }
    } catch (PDOException $e) {
        echo "删除操作出错: " . $e->getMessage() . "<br/>";
    }
}

if($refresh_name){
    try {
        // 正确的SQL查询语句
        $sql = "update system_addition_attr set value = '' WHERE sid = :d_sid AND oid = :d_oid AND mid = :d_mid AND name = :d_name";
        
        // 准备并执行语句
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':d_sid', $del_sid, PDO::PARAM_INT);
        $stmt->bindParam(':d_oid', $del_oid, PDO::PARAM_INT);
        $stmt->bindParam(':d_mid', $del_mid, PDO::PARAM_INT);
        $stmt->bindParam(':d_name', $refresh_name, PDO::PARAM_STR);
        
        if($stmt->execute()) {
            $affected_rows = $stmt->rowCount();
            if($affected_rows > 0) {
                echo "已成功清空 {$delete_name} 的属性数据！<br/>";
            } else {
                echo "未找到要清空的属性数据！<br/>";
            }
        } else {
            echo "清空操作失败，请检查数据库连接！<br/>";
        }
    } catch (PDOException $e) {
        echo "清空操作出错: " . $e->getMessage() . "<br/>";
    }
}

if($modify_name){
    if(isset($_POST['new_value'])) {
        // 处理提交的新值
        try {
            $new_value = $_POST['new_value'];
            $sql = "UPDATE system_addition_attr SET value = :new_value 
                   WHERE sid = :m_sid AND oid = :m_oid AND mid = :m_mid AND name = :m_name";
            
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':new_value', $new_value, PDO::PARAM_STR);
            $stmt->bindParam(':m_sid', $del_sid, PDO::PARAM_INT);
            $stmt->bindParam(':m_oid', $del_oid, PDO::PARAM_INT);
            $stmt->bindParam(':m_mid', $del_mid, PDO::PARAM_INT);
            $stmt->bindParam(':m_name', $modify_name, PDO::PARAM_STR);
            
            if($stmt->execute()) {
                echo "已成功修改 {$modify_name} 属性值为 {$new_value}！<br/>";
            } else {
                echo "修改操作失败，请检查数据库连接！<br/>";
            }
        } catch (PDOException $e) {
            echo "修改操作出错: " . $e->getMessage() . "<br/>";
        }
    } else {
        echo "准备修改 {$modify_name} 属性，请在下方输入新值。<br/>";
    }
}

$sql = "select * from system_addition_attr";
$cxjg = $dblj ->query($sql);
$attrData = $cxjg ->fetchAll(PDO::FETCH_ASSOC);
$index = 0;
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");

if($attrData){
foreach ($attrData as $attr) {
$index = $index + 1;
$op_sid = $attr['sid'];
$op_oid = $attr['oid'];
$op_mid = $attr['mid'];
$op_name = $attr['name'];
$op_value = $attr['value'];
$modify_url = $encode->encode("cmd=gm_game_othersetting&canshu=12&del_sid=$op_sid&del_oid=$op_oid&del_mid=$op_mid&modify_name=$op_name&sid=$sid");
$refresh_url = $encode->encode("cmd=gm_game_othersetting&canshu=12&del_sid=$op_sid&del_oid=$op_oid&del_mid=$op_mid&refresh_name=$op_name&sid=$sid");
$delete_url = $encode->encode("cmd=gm_game_othersetting&canshu=12&del_sid=$op_sid&del_oid=$op_oid&del_mid=$op_mid&delete_name=$op_name&sid=$sid");
$attr_data_detail .= <<<HTML
<tr id="row_{$op_sid}_{$op_oid}_{$op_mid}_{$op_name}">
<td>{$op_sid}</td>
<td>{$op_oid}</td>
<td>{$op_mid}</td>
<td>{$op_name}</td>
<td><span id="value_{$op_sid}_{$op_oid}_{$op_mid}_{$op_name}">{$op_value}</span></td>
<td>
<div class="normal-mode" id="normal_buttons_{$op_sid}_{$op_oid}_{$op_mid}_{$op_name}">
    <button onclick="editMode('{$op_sid}','{$op_oid}','{$op_mid}','{$op_name}','{$op_value}')" name="{$op_name}">修改</button>
    <button onclick="myFunction(this)" drump_url="{$refresh_url}" name="{$op_name}">清空</button>
    <button onclick="myFunction1(this)" drump_url="{$delete_url}" name="{$op_name}">删除</button>
</div>
<div class="edit-mode" id="edit_buttons_{$op_sid}_{$op_oid}_{$op_mid}_{$op_name}" style="display:none;">
    <form id="edit_form_{$op_sid}_{$op_oid}_{$op_mid}_{$op_name}" method="post" action="?cmd={$modify_url}">
        <input type="text" name="new_value" id="input_{$op_sid}_{$op_oid}_{$op_mid}_{$op_name}" value="{$op_value}">
        <button type="submit">提交</button>
        <button type="button" onclick="cancelEdit('{$op_sid}','{$op_oid}','{$op_mid}','{$op_name}','{$op_value}')">取消</button>
    </form>
</div>
</td>
</tr>
HTML;
        }

$table_frame = <<<HTML
<div id="attrData">
<table border="1px solid black" style="width:100%;padding:10px 10px 10px;text-align:center;">
<tr>
<td>sid</td>
<td>oid</td>
<td>mid</td>
<td>name</td>
<td>value</td>
<td>功能设置</td>
</tr>
HTML;
$attr_data_html = <<<HTML
$table_frame
$attr_data_detail
</table><br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
</div>
HTML;
}else{
$attr_data_html = <<<HTML
当前没有任何属性！<br/>
<a href="?cmd=$last_page">返回上级</a><br/><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
}
echo $attr_data_html;
?>

<script>
function myFunction(obj){
    var r=confirm("是否清空属性:"+obj.name);
    if (r==true){
        var drumpUrl = obj.getAttribute("drump_url");
        href = "?cmd=" + drumpUrl;
        window.location.href= href;
    }
}

function myFunction1(obj){
    var r=confirm("是否删除属性:"+obj.name);
    if (r==true){
        var drumpUrl = obj.getAttribute("drump_url");
        href = "?cmd=" + drumpUrl;
        window.location.href= href;
    }
}

function editMode(sid, oid, mid, name, value) {
    // 隐藏常规按钮，显示编辑模式
    document.getElementById('normal_buttons_' + sid + '_' + oid + '_' + mid + '_' + name).style.display = 'none';
    document.getElementById('edit_buttons_' + sid + '_' + oid + '_' + mid + '_' + name).style.display = 'block';
    
    // 隐藏值，显示输入框
    document.getElementById('value_' + sid + '_' + oid + '_' + mid + '_' + name).style.display = 'none';
    document.getElementById('input_' + sid + '_' + oid + '_' + mid + '_' + name).focus();
}

function cancelEdit(sid, oid, mid, name, value) {
    // 显示常规按钮，隐藏编辑模式
    document.getElementById('normal_buttons_' + sid + '_' + oid + '_' + mid + '_' + name).style.display = 'block';
    document.getElementById('edit_buttons_' + sid + '_' + oid + '_' + mid + '_' + name).style.display = 'none';
    
    // 显示原始值，重置输入框
    document.getElementById('value_' + sid + '_' + oid + '_' + mid + '_' + name).style.display = 'inline';
    document.getElementById('input_' + sid + '_' + oid + '_' + mid + '_' + name).value = value;
}
</script>


