<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$return_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if(!$rank_canshu){
$sql = "select * from system_rank";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($ret)+1;$i++){
$rank_id = $ret[$i-1]['rank_id'];
$rank_name = $ret[$i-1]['rank_name'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$rank_detail = $encode->encode("cmd=rank_page&ucmd=$cmid&rank_canshu=$rank_id&sid=$sid");
$rank_list .=<<<HTML
<a href="?cmd=$rank_detail">{$rank_name}</a><br/>
HTML;
}
$rank_html = <<<HTML
[排行榜]<br/>
$rank_list
<br/><a href="?cmd=$return_game">返回游戏</a><br/>
HTML;
}

if($rank_canshu){
$sql = "select * from system_rank where rank_id = '$rank_canshu'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$rank_id = $ret['rank_id'];
$rank_name = $ret['rank_name'];
$rank_exp = $ret['rank_exp'];
$show_count = $ret['show_count'];
$show_obj = $ret['show_obj'];
$show_cond = $ret['show_cond'];
$sql = "select uname,sid from game1";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
$userData = array();
for($i=1;$i<@count($ret)+1;$i++){
$user_sid = $ret[$i-1]['sid'];
$user_exp = \lexical_analysis\process_string($rank_exp,$user_sid);
$user_show_cond = checkTriggerCondition($show_cond,$dblj,$user_sid);
if(is_null($user_show_cond)){
    $user_show_cond =1;//若触发条件为空则默认true
}
if($user_show_cond){
$user_name = $ret[$i-1]['uname'];
// 将数据添加到数组中
$userData[] = array(
    'user_exp' => $user_exp,
    'user_sid' => $user_sid,
    'user_name' => $user_name
);
}
}
// 根据 'user_exp' 键对数组进行降序排序
usort($userData, function ($a, $b) {
    return $b['user_exp'] - $a['user_exp'];
});

for($j = 0; $j < min($show_count, count($userData)); $j++) {
    $rank_user_html .= "[" . ($j + 1) . "]." . $userData[$j]['user_name'] . "[" . $userData[$j]['user_exp'] . "]<br/>";
    // 判断当前用户是否为访问者
    if ($userData[$j]['user_sid'] == $sid) {
        $visitorPosition = $j + 1;
    }
}
// 如果找到了与访问者相对应的数据，输出其在榜单中的位数
if ($visitorPosition !== null) {
    $rank_user_pos = "你的排名是：第{$visitorPosition}名<br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$last_page = $encode->encode("cmd=rank_page&ucmd=$cmid&sid=$sid");
$rank_html = <<<HTML
【{$rank_name}】<br/>
$rank_user_pos
$rank_user_html
<br/><a href="?cmd=$last_page">返回排行榜</a><br/>
<a href="?cmd=$return_game">返回游戏</a><br/>
HTML;
}
echo $rank_html;
?>