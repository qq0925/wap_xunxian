<?php
// 查询表结构信息
$stmt = $dblj->query("DESCRIBE game1");
// 获取字段名称
$fieldNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
// 输出字段名称
foreach ($fieldNames as $fieldName) {
    $gm_attr_text .=<<<HTML
    {$fieldName}
HTML;
}
    
// 查询表结构信息
$stmt = $dblj->query("select DISTINCT name from system_addition_attr where sid !='' and oid =''");
// 获取字段名称
$fieldNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
// 输出字段名称
foreach ($fieldNames as $fieldName) {
    $gm_addition_attr_text .=<<<HTML
    {$fieldName}
HTML;
}






$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gm_scene_new&sid=$sid");
$gm_cheat = $encode->encode("cmd=gm_cheat&sid=$sid");
$gm_html =<<<HTML
    <h1>GM修改器</h1>
    <form action="?cmd=$gm_cheat" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id">（这里填写玩家id比如1，2）<br><br>
        
        <label for="attr_name">属性名称:</label>
        <input type="text" id="attr_name" name="attr_name">（前面的u不要填！比如uhp只填hp就好！）<br><br>
        
        <label for="attr_value">属性值:</label>
        <input type="text" id="attr_value" name="attr_value">（留空是将属性值置空）<br><br>
        
        <input type="submit" value="提交">
    </form>
    目前game1表属性名：$gm_attr_text<br/>
    目前system_addition_attr表属性名：$gm_addition_attr_text<br/>
    <a href="?cmd=$gonowmid">返回游戏场景</a>
HTML;
echo $gm_html;
?>
