<?php
$player = player\getplayer($sid,$dblj);
$gm = $encode->encode("cmd=gm&sid=$sid");
$map = '';
$hangshu = 0;
$cxallmap = \gm\getqy_all($dblj);
$br = 0;
$area_add = $encode->encode("cmd=area_post&gm_post_canshu=1&sid=$sid");
if($post_canshu ==0){
for ($i=0;$i<count($cxallmap);$i++){
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
  //$target_mid = $encode->encode("cmd=target_midmid&new_target_mid=$mid&sid=$sid");
  if($qy_id ==0){
      $target_mid = $encode->encode("cmd=gm_map_2&post_canshu=1&qy_id=0&qy_name=未分区&sid=$sid");
        $no_area =<<<HTML
        <a href="?cmd=$target_mid" >未分区</a><br/>
HTML;
  }elseif($qy_id !=0){
        $hangshu +=1;
        $target_mid = $encode->encode("cmd=gm_map_2&hangshu=$hangshu&post_canshu=1&qy_id=$qy_id&qy_name=$qyname&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname(a{$qy_id})</a><br/>
HTML;
    /*if ($br >= 3){
        $br = 0;
        $map.="<br/>"  ;
    }*/
  }
}
$allmap = <<<HTML
[地图设计]<br/>
目前定义了如下区域：<br/>
$map
$no_area<br/>
<a href="?cmd=$area_add" >增加区域</a><br/>
<form>
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $allmap;
}
elseif($post_canshu ==1){
    $re_area = $encode->encode("cmd=gm_map_2&gm_post_canshu=0&sid=$sid");
    $hangshu = 0;
    if(isset($marea_id)){
    $cxallmap = \gm\getmid_detail($dblj,$marea_id);
    $qy_idd = $marea_id;
    $qy_namee = $cxallmap[0]["name"];
   // var_dump('<pre>');
   // var_dump($cxallmap);
    //var_dump('</pre>');
    }else{
    $cxallmap = \gm\getmid_detail($dblj,$qy_id);
    $qy_idd = $qy_id;
    $qy_namee = $cxallmap[0]["name"];
    }
    //var_dump($cxallmap);
    $map_id = $cxallmap[0]["mapid"];
    //var_dump($map_id);
    $map_ids = explode(",", $map_id);
    //var_dump($map_ids);
    foreach ($map_ids as $map_idss) {
    $sql = "SELECT * FROM system_map WHERE mid = '$map_idss';";
    $result = $dblj->query($sql);
        // 输出数据
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["mid"];
            $name = $row["mname"];
            $marea_id = $row["marea_id"];
            $marea_name = $row["marea_name"];
            $hangshu +=1;
            $target_mid = $encode->encode("cmd=gm_post_4&target_midid=$id&target_midname=$name&qy_id=$qy_id&sid=$sid");
            $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$name(s$id)</a><br/>
HTML;
        }
}
$map_add = $encode->encode("cmd=gm_post_4&map_add_canshu=1&marea_id=$qy_id&marea_name=$qy_namee&qy_id=$qy_idd&sid=$sid");
$allmap = <<<HTML
[地图设计]<br/>
$qy_namee(a$qy_idd)区域的场景：<br/>
$map<br/>
<a href="?cmd=$map_add" >增加场景</a><br/>
<a href="?cmd=$re_area" >返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $allmap;
}
?>