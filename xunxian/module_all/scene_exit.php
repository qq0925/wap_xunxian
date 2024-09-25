<?php




function get_exit_list($sid,$dblj){
include_once 'pdo.php';
$player = player\getplayer($sid,$dblj);
$sql = "SELECT nowmid FROM game1 WHERE sid = :sid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nowmid = $row['nowmid'];

$clmid = player\getmid($nowmid,$dblj);

$upmidlj = $encode->encode("cmd=gomid&newmid=$clmid->upmid&sid=$sid");//上地图
$downmidlj = $encode->encode("cmd=gomid&newmid=$clmid->downmid&sid=$sid");
$leftmidlj = $encode->encode("cmd=gomid&newmid=$clmid->leftmid&sid=$sid");
$rightmidlj = $encode->encode("cmd=gomid&newmid=$clmid->rightmid&sid=$sid");
$upmid = player\getmid($clmid->upmid,$dblj);
$downmid = player\getmid($clmid->downmid,$dblj);
$leftmid = player\getmid($clmid->leftmid,$dblj);
$rightmid = player\getmid($clmid->rightmid,$dblj);

if ($upmid->mname!=''){
    $lukouhtml .= <<<HTML
    北:<a href="?cmd=$upmidlj">$upmid->mname ↑</a><br/>
HTML;
}

if ($leftmid->mname!=''){
    $lukouhtml .= <<<HTML
    西:<a href="?cmd=$leftmidlj">$leftmid->mname ←</a><br/>
HTML;
}

if ($rightmid->mname!=''){
    $lukouhtml .= <<<HTML
    东:<a href="?cmd=$rightmidlj">$rightmid->mname →</a><br/>
HTML;
}

if ($downmid->mname!=''){
    $lukouhtml .= <<<HTML
    南:<a href="?cmd=$downmidlj">$downmid->mname ↓</a><br/>
HTML;
}
return $lukouhtml;
}
?>