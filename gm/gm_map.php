<?php
$player = player\getplayer($sid,$dblj);
$map = '';
$hangshu = 0;
$cxallmap = \player\getqy_all($dblj);

$br = 0;
if($hanghsu == 0 && $post_canshu ==0){
for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
    $cxall_map = \player\getmid_detail($dblj,$qy_id);
    $map_count = count($cxall_map);
  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
        $target_mid = $encode->encode("cmd=gm_map&hangshu=$hangshu&post_canshu=1&qy_id=$qy_id&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.{$qyname}($map_count)</a><br/>
HTML;
    /*if ($br >= 3){
        $br = 0;
        $map.="<br/>"  ;
    }*/
}
$allmap = <<<HTML
[基本信息设置]<br/>
请选择入口场景的区域：<br/>
$map<br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上一页</a><br/>
HTML;
echo $allmap;
}elseif($post_canshu==1){
    $hangshu = 0;
    $cxallmap = \player\getmid_detail($dblj,$qy_id);
    for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $midname = $cxallmap[$i]['mname'];
    $mid = $cxallmap[$i]['mid'];
    $br++;
        //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
    $target_mid = $encode->encode("cmd=gm_game_basicinfo&post_canshu=map&target_mid=$mid&sid=$sid");
    $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$midname(s$mid)</a><br/>
HTML;
}
$allmap = <<<HTML
[基本信息设置]<br/>
请选择入口场景<br/>
$map<br/>
<a href="#" onClick="javascript:window.history.back();return false;">返回上一页</a><br/>
HTML;
echo $allmap;
}
?>