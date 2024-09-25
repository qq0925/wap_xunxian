<?php
// 构造查询语句
    $query = "SELECT COUNT(*) FROM game1 WHERE sfzx = 1";

    // 执行查询语句并获取结果
    $result = $dblj->query($query);

    // 获取行数
    $rowCount = $result->fetchColumn();



if(empty($_POST['kw'])){
$online_detail = \gm\getnowonline_player($dblj);
}elseif (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select uid,sid,uname from `game1` where sfzx =1 AND uname LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // 显示过滤后的数据
    $online_detail = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    $count = count($online_detail);
for ($i=0;$i<$count;$i++){
    $j = $i + 1;
    $online_name = $online_detail[$i]['uname'];
    $online_uid = $online_detail[$i]['uid'];
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $playercmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$online_uid&sid=$sid");
    $player_name.=<<<HTML
    [{$j}].<a href ="?cmd=$playercmd">$online_name</a><br/>
HTML;
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if($design_canshu ==1){
    $gm_main = $encode->encode("cmd=gm&ucmd=$cmid&sid=$sid");
    $design_url = "<a href='?cmd=$gm_main'>返回设计大厅</a><br/>";
}


$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$nowhtml =<<<HTML
<p>当前共有{$rowCount}位玩家在线<br/>
$player_name
</p>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="ucmd" type="hidden" value="{$cmid}"/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
$design_url
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
echo $nowhtml;
?>