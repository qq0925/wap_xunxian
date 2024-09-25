<?php
$player = player\getplayer($sid,$dblj);
$map = '';
$hangshu = 0;
$cxallmap = \gm\getqy_all($dblj);
$br = 0;
if($hanghsu == 0 && $post_canshu ==0){
for ($i=0;$i<count($cxallmap);$i++){
    $hangshu +=1;
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
        $target_mid = $encode->encode("cmd=map_out_choose&hangshu=$hangshu&post_canshu=1&qy_id=$qy_id&center_id=$target_midid&map_out_canshu=$map_out_canshu&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname</a><br/>
HTML;
    /*if ($br >= 3){
        $br = 0;
        $map.="<br/>"  ;
    }*/
}
$last_page = $encode->encode("cmd=gm_type_map&gm_post_canshu=5&target_midid=$target_midid&sid=$sid");
$allmap = <<<HTML
[基本信息设置]<br/>
请选择出口场景的区域：<br/>
$map<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
echo $allmap;
}elseif($post_canshu==1){
    $hangshu = 0;
    $cxallmap = \gm\getmid_detail($dblj,$qy_id);
    for($i=0;$i<@count($cxallmap);$i++){
        $mid = $cxallmap[$i]["mid"];
        if($mid !=$center_id){
        $name = $cxallmap[$i]["mname"];
        $hangshu +=1;
        $target_mid = $encode->encode("cmd=map_out_choose&update_canshu=1&map_out_canshu=$map_out_canshu&target_mid=$mid&center_id=$center_id&sid=$sid");
        $map .=<<<HTML
    <a href="?cmd=$target_mid" >$hangshu.$name(s$mid)</a><br/>
HTML;
}
    }
$last_page = $encode->encode("cmd=map_out_choose&map_out_canshu=$map_out_canshu&target_midid=$center_id&sid=$sid");
$allmap = <<<HTML
[基本信息设置]<br/>
请选择入口场景<br/>
$map<br/>
<a href="?cmd=$last_page">返回上一页</a><br/>
HTML;
echo $allmap;
}
?>