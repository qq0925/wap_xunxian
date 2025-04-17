<?php

if($_POST){
    echo "修改成功！<br/>";
    $sql = "update  gm_game_basic set item_head = '$head_css' where game_id = 19980925";
    $dblj->exec($sql);
}

$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");
$item_head = \player\getgameconfig($dblj)->item_head;
$goitem = $encode->encode("cmd=item_html&canshu=全部&sid=$sid");
$pre_value = create_head($item_head, $sid, $cmid, $dblj, '全部');

$head_html = <<<HTML
预览效果：<br/>
{$pre_value}<br/>
物品栏头部自定义<a href="?cmd=$goitem">GO</a><br/>
<form method="post">
样式代码:<textarea name="head_css" maxlength="1024" rows="4" cols="40" style="width: 480px; height: 250px";>{$item_head}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改"></form>
{{item_type_*}}：生成一个指向该类别的链接，且点击后会用文本替换原有链接位置。<br/>*可以是：全部，药品，装备，兵器，防具，书籍，镶物，兵镶，防镶，任务，其它。<br/>
注：必须有一个全部的链接。<br/>
<br/><a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $head_html;

function create_head($head_value, $sid, $cmid, $dblj, $canshu) {
    global $encode;
    $ret_url = $head_value;
    
    // 处理物品类型模式
    $ret_url = preg_replace_callback('/\{\{item_type_([^}]+)\}\}/', function($matches) use ($encode, $sid, &$cmid, $canshu) {
        $type = $matches[1];
        
        $cmid++;
        return $type;
    }, $ret_url);
    
    // 处理物品子类型模式
    $ret_url = preg_replace_callback('/\{\{item_subtype_([^}]+)\}\}/', function($matches) use ($encode, $sid, &$cmid, $canshu, $dblj) {
        $subtype = $matches[1];
        
        $cmid++;
        
        // 检查子类型是数字（装备子类型）还是字符串（一般子类型）
        if (is_numeric($subtype)) {
            // 处理装备子类型（数字）
            return "$subtype";
        } else {
            // 处理一般子类型（字符串）
            // 查询以查找具有此子类型的所有物品
            $sql = "SELECT DISTINCT itype,isubtype FROM system_item_module WHERE isubtype = :subtype";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':subtype', $subtype, PDO::PARAM_STR);
            $stmt->execute();
            
            // 如果子类型存在
            if ($stmt->rowCount() > 0) {
                return $subtype;
            } else {
                return $matches[0]; // 如果找不到子类型，则返回原始内容
            }
        }
    }, $ret_url);
    $ret_url = \lexical_analysis\process_string($ret_url,$sid,$oid,$mid);
    $ret_url = \lexical_analysis\process_photoshow($ret_url);
    $ret_url =\lexical_analysis\color_string($ret_url);
    return $ret_url;
} 


?>
<script>
function confirmAction(del_url) {
    // 在确认框中显示具体的操作名称
    if (confirm("你确定要重置为默认模板吗？")) {
        // 使用传入的具体删除链接
        window.location.href = del_url;
    }
    return false;
}
</script>