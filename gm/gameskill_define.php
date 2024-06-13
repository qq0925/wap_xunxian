<p>[设计技能]</p>
<?php
$game_config = \player\getgameconfig($dblj);
$list_row = $game_config->list_row;

// 当前页码
if ($list_page) {
    $currentPage = intval($list_page);
} else {
    $currentPage = 1;
}
// 计算偏移量
$offset = ($currentPage - 1) * $list_row;


// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_skill";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);

$sql = "select * from system_skill LIMIT $offset, $list_row";
$skill_post_canshu = 0;
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}

if(empty($_POST['kw'])){
}elseif (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from system_skill where jname LIKE :keyword LIMIT $offset, $list_row";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // 显示过滤后的数据
    if ($stmt){
    $gm_ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


$attr_html = '';
$hangshu = $offset;
for ($i=0;$i<count($gm_ret);$i++){
    //var_dump($gm_retdj);
    $skill_id = $gm_ret[$i]['jid'];
   // var_dump($gm_djname);
    $skill_name = $gm_ret[$i]['jname'];
    $hangshu += 1;
    $skill_url = $encode->encode("cmd=gm_skill_def&skill_post_canshu=2&skill_id=$skill_id&sid=$sid");
    $attr_html .=<<<HTML
    [{$hangshu}].<a href="?cmd=$skill_url">{$skill_name}(j{$skill_id})</a><br/>
HTML;
}
$skill_post_canshu = 0;
$gm_skill_add= $encode->encode("cmd=gm_skill_def&skill_post_canshu=4&sid=$sid");
$gm_skill_default = $encode->encode("cmd=gm_skill_def&skill_post_canshu=5&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");

if ($currentPage > 2 && $currentPage == $totalPages) {
    $main_page = $encode->encode("cmd=gm_game_skilldefine&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=gm_game_skilldefine&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=gm_game_skilldefine&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}


$gm_html = <<<HTML
$attr_html
$page_html<br/>
<a href="?cmd=$gm_skill_add">增加技能</a><br/>
<a href="?cmd=$gm_skill_default">定义技能参数</a><br/>
<form method="post">
快速搜索：<br/>
<input name="submit" type="hidden" title="提交" value="提交" />
<input name="kw" type="text" /><br/>
<input type="submit" value="提交" /></form><br /><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>