<p>[表达式定义]</p>
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
$sqlCount = "SELECT COUNT(*) as total FROM system_exp_def";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);



$sql = "select * from system_exp_def LIMIT $offset, $list_row";
$def_post_canshu = 0;
//var_dump($sql);
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetchAll(PDO::FETCH_ASSOC);
}


session_start(); // Start the session

if(isset($_POST['code'])){
if($_POST['code'] == $_SESSION['code']){
    echo "表单已经提交过，请勿重复提交。<br/>";
}else{
if(empty($_POST['kw'])){
    echo "输入有误！<br/>";
}elseif (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from system_exp_def where id LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // 显示过滤后的数据
    if ($stmt){
    $gm_ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['code'] =$_POST['code']; //存储code
    }
}
}
}

$attr_html = '';
$hangshu = $offset;
for ($i=0;$i<count($gm_ret);$i++){
    //var_dump($gm_retdj);
    $def_id = $gm_ret[$i]['id'];
   // var_dump($gm_djname);
    $def_type = $gm_ret[$i]['type'];
    $def_value = $gm_ret[$i]['value'];
    $hangshu += 1;
    $def_url = $encode->encode("cmd=gm_exp_def&def_post_canshu=2&def_id=$def_id&sid=$sid");
    $attr_html .=<<<HTML
    [{$hangshu}].<a href="?cmd=$def_url">{$def_id}</a><br/>
HTML;
}
$def_post_canshu = 0;
$gm_exp_def = $encode->encode("cmd=gm_exp_def&sid=$sid");
$gm = $encode->encode("cmd=gm&sid=$sid");
$code = mt_rand(0,1000000);

if ($currentPage > 2 && $currentPage == $totalPages) {
    $main_page = $encode->encode("cmd=gm_game_expdefine&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=gm_game_expdefine&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=gm_game_expdefine&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=gm_game_expdefine&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}


$gm_html = <<<HTML
$attr_html
$page_html<br/>
<a href="?cmd=$gm_exp_def">增加表达式</a><br/>
<form method="post">
快速搜索：<br/>
<input type="hidden" name="code" value="$code">
<input name="submit" type="hidden" title="提交" value="提交" />
<input name="kw" type="text" /><br/>
<input type="submit" value="提交" ></form><br /><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $gm_html;
?>