<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
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
    $playercmd = $encode->encode("cmd=getplayerinfo&uid=$online_uid&sid=$sid");
    $player_name.=<<<HTML
    <a href ="?cmd=$playercmd">$j.$online_name</a><br/>
HTML;
}

$nowhtml =<<<HTML
<p>当前共有${count}位玩家在线<br/>
$player_name
</p>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上级</a><br/>
<a href="?cmd=$gm" >设计大厅</a>
HTML;
echo $nowhtml;
?>