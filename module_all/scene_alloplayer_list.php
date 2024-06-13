<?php

$cxallplayer_count = 0;
$sql = "SELECT nowmid,uid FROM game1 WHERE sid = :sid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nowmid = $row['nowmid'];
$uid = $row['uid'];
$clmid = player\getmid($nowmid,$dblj);
$scene_name = $clmid->mname;
$sql = "select * from game1 where nowmid='$nowmid' AND sfzx = 1 AND sid !='$sid'";//获取当前地图玩家
$cxjg = $dblj->query($sql);
$playerhtml = '';
if ($cxjg){
    $cxallplayer = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    $cxallplayer_count = @count($cxallplayer);
    $nowdate = date('Y-m-d H:i:s');
    for ($i = 1;$i<$cxallplayer_count +1;$i++){
        if ($cxallplayer[$i-1]['uname']!=""){
            $cxtime = $cxallplayer[$i-1]['endtime'];
            $cxdesigner = $cxallplayer[$i-1]['uis_designer'];
            $cxuid = $cxallplayer[$i-1]['uid'];
            $cxsid = $cxallplayer[$i-1]['sid'];
            $cxuname = $cxallplayer[$i-1]['uname'];
            $minute=floor((strtotime($nowdate)-strtotime($cxtime))/60);//获取刷新分钟间隔
            if ($minute>=$system_offline_time &&$cxdesigner==0 &&$system_offline_time !=0){
                $sql = "update game1 set sfzx=0 WHERE sid='$cxsid'";
                $dblj->exec($sql);
            }else{
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $playercmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&oid=$cxuid&sid=$sid");
                $playerhtml .= "[$i].<a href='?cmd=$playercmd'>{$club->clubname}{$cxuname}</a><br/>";
            }

        }
    }

    if($cxallplayer_count){
    $playerhtml = $playerhtml."<br/>";
    }
}



$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$alloplayerhtml =<<<HTML
你附近的玩家({$cxallplayer_count}人)有:<br/>
$playerhtml
$page_html
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $alloplayerhtml;
?>