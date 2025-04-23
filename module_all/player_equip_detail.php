<?php

require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';

$parents_page = $currentFilePath;
// $encode = new \encode\encode();
// $player = new \player\player();
$player = \player\getplayer($sid,$dblj);
$game_main = '';
$get_main_page = \gm\get_equip_detail_page($dblj);
$cj_para = \gm\get_global_page_cj($dblj,14);
$css_text = $cj_para['css'];
$js_text = $cj_para['js'];
if($css_text){
    $css_add = <<<HTML
<style>
$css_text
</style>
HTML;
}

if($js_text){
    $js_add = <<<HTML
<script>
$js_text
</script>
HTML;
}
$br = 0;
if($mid){
    $equip_true_id = $mid;
}

if($canshu =='into_choose'){
$equip_id = \player\getitem_true($equip_true_id,$dblj)->iid;
$equip_name = \lexical_analysis\color_string(\player\getitem_true($equip_true_id,$dblj)->iname);
$equip_type = \player\getitem_true($equip_true_id,$dblj)->itype;

$result = $db->query("SELECT value from system_addition_attr where oid = 'item' and mid = '$equip_true_id' and name = 'iembed_count'");
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$equip_iembed_count =  $row['value'];
}else{
$equip_iembed_count = \player\getitem_true($equip_true_id,$dblj)->iembed_count;
}

$equip_iembed_now_count = count(explode('|',\player\get_player_equip_mosaic_once($equip_true_id,$sid,$dblj)['equip_mosaic']));

$mosaic_list = \player\get_player_all_mosaic($equip_type,$sid,$dblj);

for($i=1;$i<count($mosaic_list)+1;$i++){
$mosaic_name = $mosaic_list[$i-1]['iname'];
$mosaic_name = \lexical_analysis\color_string($mosaic_name);
$mosaic_count = $mosaic_list[$i-1]['icount'];
$mosaic_id = $mosaic_list[$i-1]['iid'];
$mosaic_true_id = $mosaic_list[$i-1]['item_true_id'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotomosaic = $encode->encode("cmd=equip_html&page=$page&ucmd=$cmid&equip_id=$equip_id&equip_true_id=$equip_true_id&insert_mosaic=$mosaic_id&insert_true_mosaic=$mosaic_true_id&sid=$sid");

$mosaic_list_html .=<<<HTML
{$i}.{$mosaic_name}x{$mosaic_count}|<a href="?cmd=$gotomosaic">镶嵌</a><br/>
HTML;
}

if($page == 'item'){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$equip_html = $encode->encode("cmd=iteminfo_new&item_true_id=$equip_true_id&ucmd=$cmid&sid=$sid");
}else{
$cmid = $cmid + 1;
$cdid[] = $cmid;
$equip_html = $encode->encode("cmd=equip_html&equip_true_id=$equip_true_id&ucmd=$cmid&sid=$sid");
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
[我的装备]：{$equip_name}<br/>
请选择要镶嵌到{$equip_name}的物品:<br/>
$mosaic_list_html
<a href="?cmd=$equip_html">返回上级</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;

}else{


if($insert_mosaic){

    $event_data = global_event_data_get(42,$dblj);
    $event_cond = $event_data['system_event']['cond'];
    $event_cmmt = $event_data['system_event']['cmmt'];
    $register_triggle = checkTriggerCondition($event_cond,$dblj,$insert_mosaic,'mosaic_equip',$equip_true_id);
    $register_triggle2 = checkTriggerCondition(\player\getitem($insert_mosaic,$dblj)->iequip_cond,$dblj,$sid,'item_module',$insert_mosaic);
    if(is_null($register_triggle)){
        $register_triggle =1;
    }
    
    if(is_null($register_triggle2)){
        $register_triggle2 =1;
    }
    
    if(!$register_triggle||!$register_triggle2){
    echo "镶嵌失败！<br/>";
    if($event_cmmt){
    echo $event_cmmt.'<br/>';
    }
    }else{
    $sure_insert_para = \player\get_player_equip_mosaic_once($equip_true_id,$sid,$dblj);
    if($sure_insert_para['equip_mosaic']){
        $add = $sure_insert_para['equip_mosaic'] . "|" .$insert_mosaic;
        $dblj->exec("update player_equip_mosaic set equip_mosaic = '$add' where equip_id = '$equip_true_id' and equip_root = '$equip_id'");
    }else{
        $add = $insert_mosaic;
        $dblj->exec("insert into player_equip_mosaic (equip_id,equip_root,belong_sid,equip_mosaic)values('$equip_true_id','$equip_id','$sid','$add') ");
    }
    
    if(!empty($event_data['system_event']['link_evs'])){
        $system_event_evs = $event_data["system_event_evs"];
        foreach ($system_event_evs as $index => $event) {
        $step_cond = $event['cond'];
        $step_cmmt = $event['cmmt'];
        $step_cmmt2 = $event['cmmt2'];
        $step_s_attrs = $event['s_attrs'];
        $step_m_attrs = $event['m_attrs'];
        $step_triggle = checkTriggerCondition($step_cond,$dblj,$insert_mosaic,'mosaic_equip',$equip_true_id);
        if(is_null($step_triggle)){
        $step_triggle =1;
            }
        if(!$step_triggle){
            if($step_cmmt2){
            echo $step_cmmt2."<br/>";
            }
            }elseif($step_triggle){
            if($step_cmmt){
            echo $step_cmmt."<br/>";
            }
            $ret = attrsetting($step_s_attrs,$insert_mosaic,'mosaic_equip',$equip_true_id);
            $ret = attrchanging($step_m_attrs,$insert_mosaic,'mosaic_equip',$equip_true_id);
            }
        }

    }
    
    echo "镶嵌成功！<br/>";
    \player\changeplayeritem($insert_true_mosaic,-1,$sid,$dblj);
    $iweight = \player\getitem($insert_mosaic,$dblj)->iweight;
    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
}
}

if($diss_mosaic_id){

$weight = \player\getitem($diss_mosaic_id,$dblj)->iweight;
$player_last_burthen = $player->umax_burthen - $player->uburthen;
if($player_last_burthen >=$weight && $player_last_burthen>0){

// 查找符合条件的记录
$sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
$stmt = $dblj->prepare($sql);
$stmt->execute([':sid' => $sid, ':equip_id' => $equip_true_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $equip_mosaic = $row['equip_mosaic'];

    if (!empty($equip_mosaic)) {
        // 拆卸宝石
        $gems = explode('|', $equip_mosaic);
        $key = array_search($diss_mosaic_id, $gems);
        
        if ($key !== false) {
            unset($gems[$key]);
            $new_equip_mosaic = implode('|', $gems);

            // 更新字段
            $update_sql = "UPDATE player_equip_mosaic SET equip_mosaic = :new_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
            $update_stmt = $dblj->prepare($update_sql);
            $update_stmt->execute([':new_equip_mosaic' => $new_equip_mosaic, ':sid' => $sid, ':equip_id' => $equip_true_id]);
        if(!$new_equip_mosaic){
        // 字段为空，删除记录
        $delete_sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
        $delete_stmt = $dblj->prepare($delete_sql);
        $delete_stmt->execute([':sid' => $sid, ':equip_id' => $equip_true_id]);
}
    echo "拆卸成功!<br/>";

    $event_data = global_event_data_get(43,$dblj);
    $event_cond = $event_data['system_event']['cond'];
    $event_cmmt = $event_data['system_event']['cmmt'];
    $register_triggle = checkTriggerCondition($event_cond,$dblj,$diss_mosaic_id,'mosaic_equip',$equip_true_id);
    $register_triggle2 = checkTriggerCondition(\player\getitem($diss_mosaic_id,$dblj)->iequip_cond,$dblj,$sid,'item_module',$diss_mosaic_id);
    if(is_null($register_triggle)){
        $register_triggle =1;
    }
    
    if(is_null($register_triggle2)){
        $register_triggle2 =1;
    }
    
    if(!$register_triggle||!$register_triggle2){
    echo "镶嵌失败！<br/>";
    if($event_cmmt){
    echo $event_cmmt.'<br/>';
    }
    }
    else{
    if(!empty($event_data['system_event']['link_evs'])){
        $system_event_evs = $event_data["system_event_evs"];
        foreach ($system_event_evs as $index => $event) {
        $step_cond = $event['cond'];
        $step_cmmt = $event['cmmt'];
        $step_cmmt2 = $event['cmmt2'];
        $step_s_attrs = $event['s_attrs'];
        $step_m_attrs = $event['m_attrs'];
        $step_triggle = checkTriggerCondition($step_cond,$dblj,$diss_mosaic_id,'mosaic_equip',$equip_true_id);
        if(is_null($step_triggle)){
        $step_triggle =1;
            }
        if(!$step_triggle){
            if($step_cmmt2){
            echo $step_cmmt2."<br/>";
            }
            }elseif($step_triggle){
            if($step_cmmt){
            echo $step_cmmt."<br/>";
            }
            $ret = attrsetting($step_s_attrs,$diss_mosaic_id,'mosaic_equip',$equip_true_id);
            $ret = attrchanging($step_m_attrs,$diss_mosaic_id,'mosaic_equip',$equip_true_id);
            }
        }

    }
    \player\additem($sid,$diss_mosaic_id,1,$dblj);
    }
        }
    }
} else {
    echo "发生了一个错误，请联系管理员！<br/>";
}
}
else{
echo "请检测背包负重后再进行操作！<br/>";
}
}

for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'item';
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    $mid = $equip_true_id;
    $show_ret = $main_show_cond !== '' 
        ? \lexical_analysis\process_string($main_show_cond, $sid, $oid, $mid, null, null, "check_cond") 
        : 1;
    try{
        @$ret = eval("return $show_ret;");
    }
    catch (ParseError $e){
    $index = $i+1;
    print("第{$index}个元素的显示条件语法错误: ". $e->getMessage()."<br/>");
}
    catch (Error $e){
    $index = $i+1;
    print("第{$index}个元素的显示条件执行错误: ". $e->getMessage()."<br/>");
}
    $ret_bool = ($ret !== false && $ret !== null) ? 0 : 1;
    if($ret_bool ==0){
    if($main_type !=1){
    list($main_value,$br_count) = trimTrailingNewlinesAndCount($main_value);
    // 使用 str_repeat() 来生成多个 <br/> 标签
    $br_count_html = str_repeat("<br/>", $br_count);
    }else{
    $main_value = nl2br($main_value);
    }
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);

    if($main_target_event !=0){
        
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $i;
        $main_target_event = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0 ){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,14,$cmid);
    }
    switch ($main_type) {
        case '1':
                $game_main .=<<<HTML
{$main_value}
HTML;

            break;
        case '2':
                $game_main .=<<<HTML
<a href="?cmd=$main_target_event" >{$main_value}</a>{$br_count_html}
HTML;
            break;
        case '3':
        if($main_target_func){
                $game_main .=<<<HTML
{$main_target_func}{$br_count_html}
HTML;
}
            break;
        case '4':
                $game_main .=<<<HTML
<a href="$main_link_value" >{$main_value}</a>{$br_count_html}
HTML;
            break;
        case '5':
                $game_main .=<<<HTML
<form action="?cmd={$main_target_event}" method="POST">
{$main_value}{$br_count_html}
</form>
HTML;
            break;
    }
    }
}

$gm_module = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=14&sid=$sid");


if($page =='item'){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$equip_html = $encode->encode("cmd=iteminfo_new&item_true_id=$mid&ucmd=$cmid&sid=$sid");
$ret_text = "<a href='?cmd=$equip_html'>返回物品</a><br/>";
}else{
$cmid = $cmid + 1;
$cdid[] = $cmid;
$equip_html = $encode->encode("cmd=player_equip&ucmd=$cmid&sid=$sid");
$ret_text = "<a href='?cmd=$equip_html'>返回列表</a><br/>";
}
$cmid = $cmid + 1;
$cdid[] = $cmid;

$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

if($player->uis_designer==1){
    $gm_html = <<<HTML
<a href="?cmd=$gm_module">设计装备页面模板</a><br/>
HTML;
}

$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
$css_add
</head>
$game_main
$gm_item_design
$gm_html
$ret_text
$js_add
<a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}
echo $all;
?>