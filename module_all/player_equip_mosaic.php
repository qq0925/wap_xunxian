<?php

//由于装备镶嵌和铁匠npc高度绑定，所以应该传入一个npc_id，并有一个返回上级用于返回npc界面，一个返回游戏用于返回场景模板
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
if($mosaic_canshu !=1){

if($mosaic_canshu2!=1){


if($sure_new_mosaic_canshu){
    ////未有镶嵌物
    $sure_insert_para = \player\get_player_equip_mosaic_once($insert_true_canshu,$sid,$dblj);
    if($sure_insert_para['equip_mosaic']){
        $add = $sure_insert_para['equip_mosaic'] . "|" .$insert_true_mosaic;
    }else{
        $add = $insert_true_mosaic;
    }
    $dblj->exec("insert into player_equip_mosaic (equip_id,equip_root,belong_sid,equip_mosaic)values('$insert_true_canshu','$insert_canshu','$sid','$add') ");
    echo "镶嵌成功！<br/>";
    $out = changeplayeritem($insert_true_canshu,-1,$sid,$dblj);
    $iweight = \player\getitem_true($insert_true_canshu,$dblj)->iweight;
    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
}

if($sure_old_mosaic_canshu){
    //已有镶嵌物
    $sure_insert_para = \player\get_player_equip_mosaic_once($insert_true_canshu,$sid,$dblj);
    if($sure_insert_para['equip_mosaic']){
        $add = $sure_insert_para['equip_mosaic'] . "|" .$insert_true_mosaic;
    }else{
        $add = $insert_true_mosaic;
    }
    $dblj->exec("update player_equip_mosaic set equip_mosaic = '$add' where equip_id = '$insert_true_canshu' and equip_root = '$insert_canshu'");
    echo "镶嵌成功！<br/>";
    $out = \player\changeplayeritem($insert_true_mosaic,-1,$sid,$dblj);
    $iweight = \player\getitem_true($insert_true_mosaic,$dblj)->iweight;
    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
}

if($diss_this_canshu){

// 查找符合条件的记录
$sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
$stmt = $dblj->prepare($sql);
$stmt->execute([':sid' => $sid, ':equip_id' => $diss_this_canshu]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $equip_mosaic = $row['equip_mosaic'];

    if (!empty($equip_mosaic)) {
        // 拆卸宝石
        $gems = explode('|', $equip_mosaic);
        $key = array_search($diss_this_mosaic_id, $gems);
        
        if ($key !== false) {
            unset($gems[$key]);
            $new_equip_mosaic = implode('|', $gems);

            // 更新字段
            $update_sql = "UPDATE player_equip_mosaic SET equip_mosaic = :new_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
            $update_stmt = $dblj->prepare($update_sql);
            $update_stmt->execute([':new_equip_mosaic' => $new_equip_mosaic, ':sid' => $sid, ':equip_id' => $diss_this_canshu]);
        if(!$new_equip_mosaic){
        // 字段为空，删除记录
        $delete_sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
        $delete_stmt = $dblj->prepare($delete_sql);
        $delete_stmt->execute([':sid' => $sid, ':equip_id' => $diss_this_canshu]);
}
echo "拆卸成功!<br/>";
    $out = \player\changeplayeritem($equip_mosaic,-1,$sid,$dblj);
    $iweight = \player\getitem_true($equip_mosaic,$dblj)->iweight;
    \player\addplayersx('uburthen',$iweight,$sid,$dblj);
        }
    }
} else {
    echo "发生了一个错误，请联系管理员！<br/>";
}
}


if($diss_all){
    // 查找符合条件的记录
    $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid";
    $stmt = $dblj->prepare($sql);
    $stmt->execute([':sid' => $sid]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $mosaic_iid = \player\getitem_true($equip_mosaic,$dblj)->iid;
    \player\additem($sid,$mosaic_iid,1,$dblj);
    
    echo "全部拆卸成功!<br/>";
    $dblj->exec("delete from player_equip_mosaic where belong_sid = '$sid'");
}
if($diss_canshu){
    
    // 查找符合条件的记录
    $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
    $stmt = $dblj->prepare($sql);
    $stmt->execute([':sid' => $sid, ':equip_id' => $diss_canshu]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
        $diss_para = explode('|',$row['equip_mosaic']);
        for($i=0;$i<count($diss_para);$i++){
            $diss_para_id = $diss_para[$i];
            $mosaic_iid = \player\getitem_true($diss_para_id,$dblj)->iid;
            \player\additem($sid,$mosaic_iid,1,$dblj);
        }
    }
    echo "一键拆卸成功!<br/>";
    $dblj->exec("delete from player_equip_mosaic where equip_id = '$diss_canshu'");
}

    
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gojustnow = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$mid&sid=$sid");
$player_equip_mosaic = \player\get_player_equip_mosaic_all($sid,$dblj);

if($_POST['kw']){
$player_equip_mosaic = \player\get_player_equip_mosaic_all($sid,$dblj,$_POST['kw']);
}

for($i=1;$i<count($player_equip_mosaic) +1;$i++){
    $equip_para = $player_equip_mosaic[$i-1];
    $equip_mosaic_list = $equip_para['equip_mosaic'];
    $equip_mosaic_root = $equip_para['equip_root'];
    $equip_mosaic_id = $equip_para['equip_id'];
    $equip_mosaic_html ='';
    $equip_mosaic_list_count = 0;
    $player_equip_name = \lexical_analysis\color_string(\player\getitem($equip_mosaic_root,$dblj)->iname);
    $player_equip_embed_count = \player\getitem($equip_mosaic_root,$dblj)->iembed_count;
    if($player_equip_embed_count ==''){
        $player_equip_embed_count = 0;
    }
    $player_equip_html .= "{$i}.{$player_equip_name}";
    if($equip_mosaic_list){
        $equip_mosaic_list_para = explode('|',$equip_mosaic_list);
        $equip_mosaic_list_count = count($equip_mosaic_list_para);
    }
        for($j=0;$j<$equip_mosaic_list_count;$j++){
            $equip_mosaic_detail_id = $equip_mosaic_list_para[$j];
            $equip_mosaic_detail = \player\get_player_equip_detail($equip_mosaic_detail_id,$sid,$dblj);
            $equip_mosaic_detail_name = \lexical_analysis\color_string($equip_mosaic_detail['iname']);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $diss_this = $encode->encode("cmd=mosaic_html&diss_this_canshu=$equip_mosaic_id&diss_this_mosaic_id=$equip_mosaic_detail_id&ucmd=$cmid&mid=$mid&sid=$sid");
            $equip_mosaic_html .= $equip_mosaic_detail_name."<a href='?cmd=$diss_this'>卸下</a><br/>";
        }
        $player_equip_html .="($equip_mosaic_list_count/{$player_equip_embed_count})";
        
    if($equip_mosaic_list_count<$player_equip_embed_count && $equip_mosaic_list_count>0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $gotomosaic = $encode->encode("cmd=mosaic_html&old_canshu=1&mosaic_canshu=1&insert_true_canshu=$equip_mosaic_id&insert_canshu=$equip_mosaic_root&ucmd=$cmid&mid=$mid&sid=$sid");
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $diss_this_all = $encode->encode("cmd=mosaic_html&diss_canshu=$equip_mosaic_id&ucmd=$cmid&mid=$mid&sid=$sid");
    $player_equip_html .=" <a href='?cmd=$gotomosaic'>去镶嵌</a>|<a href='?cmd=$diss_this_all'>一键卸下</a><br/>";
    $player_equip_html .="$equip_mosaic_html";
}elseif($equip_mosaic_list_count==$player_equip_embed_count && $equip_mosaic_list_count>0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $gotomosaic = $encode->encode("cmd=mosaic_html&old_canshu=1&mosaic_canshu=1&insert_true_canshu=$equip_mosaic_id&insert_canshu=$equip_mosaic_root&ucmd=$cmid&mid=$mid&sid=$sid");
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $diss_this_all = $encode->encode("cmd=mosaic_html&diss_canshu=$equip_mosaic_id&ucmd=$cmid&mid=$mid&sid=$sid");
    $player_equip_html .=" <a href='?cmd=$diss_this_all'>一键卸下</a><br/>";
    $player_equip_html .="$equip_mosaic_html";
}elseif($equip_mosaic_list_count ==0 && $equip_mosaic_list_count<$player_equip_embed_count){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $gotomosaic = $encode->encode("cmd=mosaic_html&old_canshu=1&mosaic_canshu=1&insert_true_canshu=$equip_mosaic_id&insert_canshu=$equip_mosaic_root&ucmd=$cmid&mid=$mid&sid=$sid");
    $player_equip_html .="<a href='?cmd=$gotomosaic'>去镶嵌</a><br/>";
}else{
    $player_equip_html .="<br/>";
}
    
}

if($player_equip_mosaic){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $diss_all = $encode->encode("cmd=mosaic_html&diss_all=1&ucmd=$cmid&mid=$mid&sid=$sid");
    //$diss_html = "<a href='?cmd=$diss_all'>全部拆卸</a><br/>";
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonomosaic = $encode->encode("cmd=mosaic_html&mosaic_canshu2=1&ucmd=$cmid&mid=$mid&sid=$sid");
$mosaic_html_1 = <<<HTML
 <a href="?cmd=$gojustnow">返回上级</a><br/>
【镶嵌装备】<br/>
已镶嵌 | <a href="?cmd=$gonomosaic">未镶嵌</a><br/>
$player_equip_html
$diss_html
<form method = "POST">
<input type="text" name="kw" placeholder="请输入装备名">
 <button type="submit">搜索</button><br/>
 </form>
 <a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}else{
    
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gojustnow = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$mid&sid=$sid");
$player_equip_mosaic = \player\get_player_all_equip_enable($sid,$dblj);

if($_POST['kw']){
$player_equip_mosaic = \player\get_player_all_equip_enable($sid,$dblj,$_POST['kw']);
}


for($i=1;$i<count($player_equip_mosaic) +1;$i++){
    $equip_para = $player_equip_mosaic[$i-1];
    $equip_name = \lexical_analysis\color_string($equip_para['iname']);
    $equip_id = $equip_para['iid'];
    $equip_root = $equip_para['item_true_id'];
    $equip_desc = \lexical_analysis\color_string($equip_para['idesc']);
    $equip_mosaic_count = $equip_para['iembed_count'];
    if($equip_mosaic_count ==''){
        $equip_mosaic_count = 0;
    }
    $player_equip_html .= "{$i}.{$equip_name}";
    $player_equip_html .="(0/{$equip_mosaic_count})";
    if($equip_mosaic_count>0){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $gotomosaic = $encode->encode("cmd=mosaic_html&mosaic_canshu=1&insert_canshu=$equip_id&insert_true_canshu=$equip_root&ucmd=$cmid&mid=$mid&sid=$sid");
    $player_equip_html .="<a href='?cmd=$gotomosaic'>去镶嵌</a><br/>";
}
    
}

    
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomosaic = $encode->encode("cmd=mosaic_html&ucmd=$cmid&mid=$mid&sid=$sid");
$mosaic_html_1 = <<<HTML
 <a href="?cmd=$gojustnow">返回上级</a><br/>
【镶嵌装备】<br/>
<a href="?cmd=$gomosaic">已镶嵌</a> | 未镶嵌<br/>
$player_equip_html
<form method = "POST">
<input type="text" name="kw" placeholder="请输入装备名">
 <button type="submit">搜索</button><br/>
 </form>
 <a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}


}else{
    
if(!$old_canshu){
$insert_para = \player\get_player_equip_detail($insert_true_canshu,$sid,$dblj);
$equip_name = \lexical_analysis\color_string($insert_para['iname']);
$equip_desc = \lexical_analysis\color_string($insert_para['idesc']);
$equip_embed_count = $insert_para['iembed_count'];
$equip_type= $insert_para['itype'];

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotogame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomosaic = $encode->encode("cmd=mosaic_html&ucmd=$cmid&mid=$mid&sid=$sid");

$mosaic_list = \player\get_player_all_mosaic($equip_type,$sid,$dblj);
for($i=1;$i<count($mosaic_list)+1;$i++){
$mosaic_name = $mosaic_list[$i-1]['iname'];
$mosaic_count = $mosaic_list[$i-1]['icount'];
$mosaic_true_id = $mosaic_list[$i-1]['item_true_id'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotomosaic = $encode->encode("cmd=mosaic_html&sure_new_mosaic_canshu=1&ucmd=$cmid&insert_canshu=$insert_canshu&insert_true_canshu=$insert_true_canshu&insert_true_mosaic=$mosaic_true_id&mid=$mid&sid=$sid");
$mosaic_list_html .=<<<HTML
{$i} .  {$mosaic_name} * {$mosaic_count}<a href="?cmd=$gotomosaic">去镶嵌</a><br/>
HTML;
}
$mosaic_html_2 = <<<HTML
 <a href="?cmd=$gotogame">返回游戏</a>  <a href="?cmd=$gomosaic">返回镶嵌</a><br/>
【镶嵌宝石到装备】<br/>
装备名：{$equip_name}<br/>
装备描述：{$equip_desc}<br/>
孔位：（0/{$equip_embed_count}）<br/>
有未镶嵌的宝石孔位时可以镶嵌以下宝石：<br/>
{$mosaic_list_html}
HTML;
}elseif($old_canshu==1){
$insert_para = \player\get_player_equip_detail($insert_true_canshu,$sid,$dblj);
$equip_name = \lexical_analysis\color_string($insert_para['iname']);
$equip_desc = \lexical_analysis\color_string($insert_para['idesc']);
$equip_embed_count = $insert_para['iembed_count'];
$equip_type= $insert_para['itype'];

$old_equip_para = \player\get_player_equip_mosaic_once($insert_true_canshu,$sid,$dblj)['equip_mosaic'];
$old_equip_arr_para = explode('|',$old_equip_para);
$mosaic_count_total = count($old_equip_arr_para);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotogame = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gomosaic = $encode->encode("cmd=mosaic_html&ucmd=$cmid&mid=$mid&sid=$sid");
$mosaic_list = \player\get_player_all_mosaic($equip_type,$sid,$dblj);
for($i=1;$i<count($mosaic_list)+1;$i++){
$mosaic_name = $mosaic_list[$i-1]['iname'];
$mosaic_count = $mosaic_list[$i-1]['icount'];
$mosaic_true_id = $mosaic_list[$i-1]['item_true_id'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotomosaic = $encode->encode("cmd=mosaic_html&sure_old_mosaic_canshu=1&ucmd=$cmid&insert_canshu=$insert_canshu&insert_true_canshu=$insert_true_canshu&insert_true_mosaic=$mosaic_true_id&mid=$mid&sid=$sid");
$mosaic_list_html .=<<<HTML
{$i} .  {$mosaic_name} * {$mosaic_count}<a href="?cmd=$gotomosaic">去镶嵌</a> <br/>
HTML;
}
$mosaic_html_2 = <<<HTML
 <a href="?cmd=$gotogame">返回游戏</a>  <a href="?cmd=$gomosaic">返回镶嵌</a><br/>
【镶嵌宝石到装备】<br/>
装备名：{$equip_name}<br/>
装备描述：{$equip_desc}<br/>
孔位：（{$mosaic_count_total}/{$equip_embed_count}）<br/>
有未镶嵌的宝石孔位时可以镶嵌以下宝石：<br/>
{$mosaic_list_html}
HTML;
}
//镶嵌执行完成返回页面1并给出镶嵌信息
//首页/上一页/下一页/末页<br/>
//. <a href="?cmd=$gotomosaic_this_all">一键镶嵌</a>

}
$mosaic_html = <<<HTML
$mosaic_html_1
$mosaic_html_2
HTML;

echo $mosaic_html;
?>