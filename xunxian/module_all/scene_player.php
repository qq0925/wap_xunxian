<?php

function get_player_list($sid,$dblj){
require_once 'pdo.php';
require_once 'class/encode.php';
$encode = new \encode\encode();

$sql = "SELECT nowmid FROM game1 WHERE sid = :sid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nowmid = $row['nowmid'];


$sql = "select * from game1 where nowmid='$nowmid' AND sfzx = 1";//获取当前地图玩家
$cxjg = $dblj->query($sql);
$playerhtml = '';
if ($cxjg){
    $cxallplayer = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    $nowdate = date('Y-m-d H:i:s');
    for ($i = 0;$i<count($cxallplayer);$i++){
        if ($cxallplayer[$i]['uname']!=""){
            $cxtime = $cxallplayer[$i]['endtime'];
            $cxuid = $cxallplayer[$i]['uid'];
            $cxsid = $cxallplayer[$i]['sid'];
            $cxuname = $cxallplayer[$i]['uname'];
            $cxuname = $cxallplayer[$i]['uname'];
            $second=floor((strtotime($nowdate)-strtotime($cxtime))%86400);//获取刷新间隔
            if ($second > 600){
                $sql = "update game1 set sfzx=0 WHERE sid='$cxsid'";
                $dblj->exec($sql);
            }else{
                $clubp = \player\getclubplayer_once($cxsid,$dblj);
                if ($clubp){
                    $club = \player\getclub($clubp->clubid,$dblj);
                    $club->clubname ="[$club->clubname]";
                }else{
                    $club = new \player\club();
                    $club->clubname ="";
                }
                $playercmd = $encode->encode("cmd=getplayerinfo&uid=$cxuid&sid=$sid");
                $playerhtml .="<a href='?cmd=$playercmd'>{$club->clubname}$cxuname</a>";
            }

        }
    }
}

echo $playerhtml;
}
?>