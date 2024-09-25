<?php
$player = player\getplayer($sid,$dblj);
$skill = '';
$hangshu = 0;
$last_page = $encode->encode("cmd=gm_game_basicinfo&sid=$sid");
$cxallskill = \player\getskill_all($dblj);


if($_POST['kw']){
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from system_skill where jname LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // 显示过滤后的数据
    if ($stmt){
    $cxallskill = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



$br = 0;
if($hanghsu == 0 && $post_canshu ==0){
for ($i=0;$i<count($cxallskill);$i++){
    $hangshu +=1;
    $skill_name = $cxallskill[$i]['jname'];
    $skill_id = $cxallskill[$i]['jid'];
    $target_mid = $encode->encode("cmd=gm_game_basicinfo&post_canshu=skill&skill_id=$skill_id&sid=$sid");
    $skill .=<<<HTML
    <a href="?cmd=$target_mid" >{$hangshu}.{$skill_name}(j{$skill_id})</a><br/>
HTML;
}
$allskill = <<<HTML
[基本信息设置]<br/>
请选择默认技能:<br/><br/>
<form method="post">
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="搜索" value="搜索">
</form>
$skill<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
echo $allskill;
}
?>