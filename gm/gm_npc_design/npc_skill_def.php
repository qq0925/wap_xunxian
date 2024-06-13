<?php


if($skill_add_id){
// 检查 nskills 字段是否为空
$skill_lvl = $_POST['skill_lvl'];
if($skill_lvl <= 0 ||$skill_lvl ==''){
    $skill_lvl = 1;
}

$string_new = $skill_add_id."|".$skill_lvl;

$query = "SELECT nskills FROM system_npc where nid = '$npc_id'";
$stmt = $dblj->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result['nskills'])) {
    // nskills 字段为空，直接赋值为 $string_new
    $query = "UPDATE system_npc SET nskills = :new_value where nid = '$npc_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
} elseif(!in_array($string_new, explode(',',$result['nskills']))) {
    // nskills 字段不为空，在原有值后面加上逗号和 $string_new
    $query = "UPDATE system_npc SET nskills = CONCAT(nskills, ',', :new_value) where nid = '$npc_id'";
    $stmt = $dblj->prepare($query);
    $stmt->bindValue(':new_value', $string_new);
    $stmt->execute();
}
}

if($remove_id){
// 准备 SQL 查询语句
$query = "SELECT nskills FROM system_npc WHERE nid = '$npc_id'";

// 执行查询
$result = $dblj->query($query);

// 获取结果
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $nskills = $row['nskills'];
} else {
    echo "查询失败";
}
$string_old = $remove_id."|".$remove_lvl;
$elements = explode(",", $nskills);
$index = array_search($string_old, $elements);
if ($index !== false) {
    unset($elements[$index]);
}
$newString = implode(",", $elements);

            // 准备 SQL 更新语句，使用占位符代替变量
$query = "UPDATE system_npc SET nskills = :newstring WHERE nid = '$npc_id'";

// 准备并执行预处理语句
$stmt = $dblj->prepare($query);

// 绑定参数值
$stmt->bindParam(':newstring', $newString);

// 执行更新
if ($stmt->execute()) {
    echo "更新成功";
} else {
    echo "更新失败";
}
}


// 查询npc 表获取 nskills 字段的值
$query = "SELECT nname,nskills FROM system_npc where nid = '$npc_id'";
$stmt = $dblj->query($query);
$rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$npc_name = $rows['nname'];
$gm_npc_skill_last = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");
// 输出 HTML 锚点链接
$index_skill_add = $encode->encode("cmd=gm_type_npc&gm_post_canshu=5&add=1&npc_id=$npc_id&sid=$sid");
if($rows){
$row = explode(',',$rows['nskills']);
foreach ($row as $row_para){
$i++;
$skill_para = explode('|',$row_para);
$skill_id = $skill_para[0];
$skill_lvl = $skill_para[1];
if($skill_id!=''){
$sql = "SELECT * from system_skill where jid = '$skill_id'";
$stmt = $dblj->query($sql);
$skill_rows = $stmt->fetch(\PDO::FETCH_ASSOC);
$skill_name = $skill_rows['jname'];
$skill_remove = $encode->encode("cmd=gm_type_npc&gm_post_canshu=5&remove_id=$skill_id&remove_lvl=$skill_lvl&npc_id=$npc_id&sid=$sid");
$skill_list .=<<<HTML
{$i}.{$skill_name}({$skill_lvl})<a href="?cmd=$skill_remove">移除</a><br/>
HTML;
}
    }
}
$skill_html =<<<HTML
<p>定义【{$npc_name}】身上的技能<br/>
$skill_list
<a href="?cmd=$index_skill_add">增加技能</a><br/>
<a href="?cmd=$gm_npc_skill_last">返回上级</a><br/>
</p>
HTML;
echo $skill_html;
?>