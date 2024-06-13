<?php
// 查询表结构信息
$stmt = $dblj->query("DESCRIBE game1");
// 获取字段名称
$fieldNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
// 输出字段名称
foreach ($fieldNames as $fieldName) {
    $gm_attr_text .=<<<HTML
    {$fieldName}&nbsp; 
HTML;
}
    
// 查询表结构信息
$stmt = $dblj->query("select DISTINCT name from system_addition_attr");
// 获取字段名称
$fieldNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
// 输出字段名称
foreach ($fieldNames as $fieldName) {
    $gm_addition_attr_text .=<<<HTML
    {$fieldName}&nbsp; 
HTML;
}






$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gm_scene_new&newmid=$player->nowmid&sid=$sid");
$gm_cheat = $encode->encode("cmd=gm_cheat&sid=$sid");
$gm_html =<<<HTML
    <h1>GM修改器</h1>
    <form action="?cmd=$gm_cheat" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id"><br><br>
        
        <label for="attr_name">属性名称:</label>
        <input type="text" id="attr_name" name="attr_name"><br><br>
        
        <label for="attr_value">属性值:</label>
        <input type="text" id="attr_value" name="attr_value"><br><br>
        
        <input type="submit" value="提交">
    </form>
    目前game1表属性名：$gm_attr_text<br/>
    目前system_addition_attr表属性名：$gm_addition_attr_text<br/>
    <a href="?cmd=$gonowmid">返回游戏场景</a>
HTML;
echo $gm_html;
?>
