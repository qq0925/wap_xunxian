<?php
require_once 'class/encode.php';
$encode = new \encode\encode();

function basic_func_choose($cmd,$page_id,$sid,$dblj,$value,$mid=null,$func_type,&$cmid=null){
$sql = "SELECT name from system_function where id = '$page_id'";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$func_name = $result['name'];
$value = $value?$value:$func_name;
    switch ($page_id) {
        case '1':
            $refresh_url = refreshing($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $refresh_url;
        case '2':
            $near_url = near_player($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $near_url;
        case '3':
            $near_url = near_npc($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $near_url;
        case '4':
            $near_item = near_item($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $near_item;
        case '5':
            $chat_list = chat_list($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $chat_list;
        case '6':
            $op_list = op_list($cmd,$page_id,$sid,$dblj,$value,$mid,$func_type,$cmid);
            return $op_list;
        case '7':
            $exit_e_url = near_exit($cmd,$page_id,$sid,$dblj,$value,1,$cmid);
            return $exit_e_url;
        case '8':
            $exit_s_url = near_exit($cmd,$page_id,$sid,$dblj,$value,2,$cmid);
            return $exit_s_url;
        case '9':
            $exit_w_url = near_exit($cmd,$page_id,$sid,$dblj,$value,3,$cmid);
            return $exit_w_url;
        case '10':
            $exit_n_url = near_exit($cmd,$page_id,$sid,$dblj,$value,4,$cmid);
            return $exit_n_url;
        case '11':
            $map_list = map_list($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $map_list;
        case '12':
            $game_main = game_main($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $game_main;
        case '13':
            $time_url = time_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $time_url;
        case '14':
            $player_state = player_state($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $player_state;
        case '15':
            $skill_url = skill_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $skill_url;
        case '16':
            $equip_url = equip_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $equip_url;
        case '17':
            $item_url = item_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $item_url;
        case '18':
            $myclan_url = myclan_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $myclan_url;
        case '19':
            $teammate_url = teammate_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $teammate_url;
        case '20':
            $pet_url = pet_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $pet_url;
        case '21':
            $task_url = task($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $task_url;
        case '22':
            $friend_url = friend($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $friend_url;
        case '23':
            $black_url = black($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $black_url;
        case '24':
            $chat_url = chat($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $chat_url;
        case '25':
            $namesex_url = self_namesex($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $namesex_url;
        case '26':
            $desc_url = self_desc($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $photo_url;
        case '27':
            $photo_url = self_photo($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $photo_url;
        case '28':
            $function_url = function_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $function_url;
        case '29':
            $quick_url = quick_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $quick_url;
        case '30':
            $show_url = show_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $show_url;
        case '31':
            $clan_url = clan_list($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $clan_url;
        case '32':
            $auc_url = auc_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $auc_url;
        case '33':
            $rank_url = rank_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $rank_url;
        case '34':
            $online_url = online_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $online_url;
        case '43':
            $invite_team_url = invite_team_action($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $invite_team_url;
        case '50':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,1,$cmid);
            return $quick_link;
        case '51':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,2,$cmid);
            return $quick_link;
        case '52':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,3,$cmid);
            return $quick_link;
        case '53':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,4,$cmid);
            return $quick_link;
        case '54':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,5,$cmid);
            return $quick_link;
        case '55':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,6,$cmid);
            return $quick_link;
        case '56':
            $quick_link = quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,7,$cmid);
            return $quick_link;
        case '59':
            $self_url = self_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $self_url;
        case '60':
            $enemy_url = enemy_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $enemy_url;
        case '61':
            $player_attack_url = player_attack_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $player_attack_url;
        case '62':
            $enemy_attack_url = enemy_attack_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $enemy_attack_url;
        case '63':
            $escape_url = escape($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $escape_url;
        case '64':
            $designer_url = designer($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $designer_url;
        case '65':
            $entrance_url = gogame($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $entrance_url;
        case '66':
            $forum_url = goforum($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $forum_url;
        case '69':
            $phone_url = phone_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $phone_url;
        case '70':
            $reward_url = reward_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $reward_url;
        case '71':
            $open_auto_url = auto_url($cmd,$page_id,$sid,$dblj,$value,1,$cmid);
            return $open_auto_url;
        case '72':
            $close_auto_url = auto_url($cmd,$page_id,$sid,$dblj,$value,2,$cmid);
            return $close_auto_url;
        case '73':
            $look_o_url = look_o_url($cmd,$page_id,$sid,$dblj,$value,$cmid);
            return $look_o_url;
        case '74':
            $sail_url = sail_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $sail_url;
        case '76':
            $pick_url = pick_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $pick_url;
        case '77':
            $mosaic_url = mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $mosaic_url;
        case '78':
            $equip_core_url = equip_core_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $equip_core_url;
        default:
            // code...
            break;
    }
}

function refreshing($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;
    $refresh_url = $encode->encode("cmd=$cmd&ucmd=$cmid&sid=$sid");
    $refresh_html=<<<HTML
<a href="?cmd=$refresh_url">{$value}</a>
HTML;
    return $refresh_html;
    
}

function near_player($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $player_list = get_player_list($sid,$dblj,$value,$cmid);
    return $player_list;
}

function near_npc($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $npc_list = get_npc_list($sid,$dblj,$cmid);
    return $npc_list;
}

function near_item($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    global $encode;
    $item_list = get_item_list($sid,$dblj,$mid,$cmid);
    return $item_list;
}

function friend($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    $friend_url = $encode->encode("cmd=player_friend_html&canshu=1&ucmd=$cmid&sid=$sid");
    $friend_html=<<<HTML
<a href="?cmd=$friend_url">{$value}</a>
HTML;
    return $friend_html;
}

function teammate_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $uteam_id = \player\getplayer($sid,$dblj)->uteam_id;
    if($uteam_id!=0){
    $team_url = $encode->encode("cmd=player_team_html&canshu=1&team_id=$uteam_id&ucmd=$cmid&sid=$sid");
    }else{
    $team_url = $encode->encode("cmd=player_team_html&ucmd=$cmid&sid=$sid");
    }
    $team_html=<<<HTML
<a href="?cmd=$team_url">{$value}</a>
HTML;
    return $team_html;
}


function invite_team_action($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    global $encode;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $team_url = $encode->encode("cmd=player_team_invite&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
    $team_html=<<<HTML
<a href="?cmd=$team_url">{$value}</a>
HTML;
    return $team_html;
}

function black($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    $black_url = $encode->encode("cmd=player_friend_html&canshu=3&ucmd=$cmid&sid=$sid");
    $black_html=<<<HTML
<a href="?cmd=$black_url">{$value}</a>
HTML;
    return $black_html;
}


function chat_list($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $chat_list = get_chat_list($sid,$dblj,$cmid);
    return $chat_list;
}

function function_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $function_url = $encode->encode("cmd=function_html&ucmd=$cmid&sid=$sid");
    $function_html=<<<HTML
<a href="?cmd=$function_url">{$value}</a>
HTML;
    return $function_html;
}

function quick_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $quick_url = $encode->encode("cmd=function_quick_html&ucmd=$cmid&sid=$sid");
    $quick_html=<<<HTML
<a href="?cmd=$quick_url">{$value}</a>
HTML;
    return $quick_html;
}

function show_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $show_url = $encode->encode("cmd=function_show_html&ucmd=$cmid&sid=$sid");
    $show_html=<<<HTML
<a href="?cmd=$show_url">{$value}</a>
HTML;
    return $show_html;
}

function auc_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $auc_url = $encode->encode("cmd=auc_page&ucmd=$cmid&sid=$sid");
    $auc_html=<<<HTML
<a href="?cmd=$auc_url">{$value}</a>
HTML;
    return $auc_html;
}

function rank_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $rank_url = $encode->encode("cmd=rank_page&ucmd=$cmid&sid=$sid");
    $rank_html=<<<HTML
<a href="?cmd=$rank_url">{$value}</a>
HTML;
    return $rank_html;
}

function online_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $online_url = $encode->encode("cmd=nowonline&ucmd=$cmid&sid=$sid");
    $online_html=<<<HTML
<a href="?cmd=$online_url">{$value}</a>
HTML;
    return $online_html;
}


function item_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $item_url = $encode->encode("cmd=item_html&canshu=全部&ucmd=$cmid&sid=$sid");
    $item_html=<<<HTML
<a href="?cmd=$item_url">{$value}</a>
HTML;
    return $item_html;
}

function escape($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $escape_url = $encode->encode("cmd=fight_escape&ucmd=$cmid&sid=$sid");
    $escape_html=<<<HTML
<a href="?cmd=$escape_url">{$value}</a>
HTML;
    return $escape_html;
}

function phone_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $phone_url = $encode->encode("cmd=function_phone_html&ucmd=$cmid&sid=$sid");
    $phone_html=<<<HTML
<a href="?cmd=$phone_url">{$value}</a>
HTML;
    return $phone_html;
}

function op_list($cmd,$page_id,$sid,$dblj,$value,$mid,$func_type,&$cmid){
    global $encode;
    switch($func_type){
        case '1':
$sql = "SELECT mshop,mhockshop,mstorage FROM system_map WHERE mid = :mid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$mshop = $result['mshop'];
$mhockshop = $result['mhockshop'];
$mstorage = $result['mstorage'];
if($mshop ==1){
$scene_buy = $encode->encode("cmd=gm_shop&mid=$mid&ucmd=$cmid&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$scene_buy">买东西</a><br/>
HTML;
}
if($mhockshop ==1){
$scene_hock = $encode->encode("cmd=gm_hockshop&mid=$mid&ucmd=$cmid&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$scene_hock">卖东西</a><br/>
HTML;
}
if($mstorage ==1){
$scene_storage = $encode->encode("cmd=gm_storage&mid=$mid&ucmd=$cmid&sid=$sid");

$getcitystorage = \player\getcitystorage($mid,$sid,$dblj);
$getstorelock = $getcitystorage->now_store_lock?:0;
if($getstorelock ==0){
$op_html .=<<<HTML
<a href="?cmd=$scene_storage">打开仓库</a><br/>
HTML;
}else{
$op_html .=<<<HTML
<a href="?cmd=$scene_storage">打开仓库(已上锁)</a><br/>
HTML;
}
}



$sql = "SELECT * FROM system_map_op WHERE belong = :mid order by id asc";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT scene_op_br FROM gm_game_basic";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$result_2 = $stmt->fetch(PDO::FETCH_ASSOC);
$op_br = $result_2['scene_op_br'];
for ($i=0;$i<count($result);$i++){
$op_id = $result[$i]['id'];
$op_name = $result[$i]['name'];
$op_belong = $result[$i]['belong'];
$op_show_cond = $result[$i]['show_cond'];
$op_link_event = $result[$i]['link_event'];
$op_link_task = $result[$i]['link_task'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$register_triggle = checkTriggerCondition($op_show_cond,$dblj,$sid,$oid);//显示条件
if(is_null($register_triggle)){
    $register_triggle =1;//若触发条件为空则默认true
}
if($register_triggle){
$oid = 'scene';
$parents_page = 'module_all/main_page.php';
$op_next = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&parents_page=$parents_page&parents_cmd=$cmd&ucmd=$cmid&mid=$op_belong&target_event=$op_link_event&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$op_next">{$op_name}</a>
HTML;
if($op_br ==1){
    $op_html .="<br/>";
}
}if($op_br !=1){
$op_html .="<br/>";
}
}
        break;
        case '2':
$sql = "SELECT nshop FROM system_npc WHERE nid = :nid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':nid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nshop = $result['nshop'];
if($nshop ==1){
$npc_buy = $encode->encode("cmd=gm_shop_npc&nid=$mid&ucmd=$cmid&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$npc_buy">买东西</a><br/>
HTML;
}
$sql = "SELECT * FROM system_npc_op WHERE belong = :mid order by id asc";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT npc_op_br FROM gm_game_basic";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$result_2 = $stmt->fetch(PDO::FETCH_ASSOC);
$op_br = $result_2['npc_op_br'];
for ($i=0;$i<count($result);$i++){
$op_id = $result[$i]['id'];
$op_name = $result[$i]['name'];
$op_belong = $result[$i]['belong'];
$op_show_cond = $result[$i]['show_cond'];
$op_link_event = $result[$i]['link_event'];
$op_link_task = $result[$i]['link_task'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$oid = 'npc';
$register_triggle = checkTriggerCondition($op_show_cond,$dblj,$sid,$oid);//显示条件
if(is_null($register_triggle)){
    $register_triggle =1;//若触发条件为空则默认true
}
if($register_triggle){
$op_next = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&parents_cmd=$cmd&ucmd=$cmid&nid=$op_belong&target_event=$op_link_event&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$op_next">{$op_name}</a>
HTML;
if($op_br ==1){
    $op_html .="<br/>";
}
}if($op_br !=1){
$op_html .="<br/>";
}
}

$sql = "SELECT nkill,nname FROM system_npc WHERE nid = :mid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nkill = $result['nkill'];
$nname = $result['nname'];
if($nkill ==1){
$data_id = explode("|",$mid);
$attack_id = $data_id[0];
$attack_gid = $data_id[1];

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$attack_attack = $encode->encode("cmd=pve_fight&nid=$attack_id&ucmd=$cmid&ngid=$attack_gid&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$attack_attack">攻击{$nname}</a><br/>
HTML;
}
break;
        case '3':
        // $sql = "SELECT sim.itype,si.item_true_id, sim.iid
        // FROM system_item si
        // JOIN system_item_module sim ON si.iid = sim.iid
        // WHERE si.iid =(SELECT iid from si where item_true_id = :item_true_id);
        // ";
        // $stmt = $dblj->prepare($sql);
        // $stmt->bindParam(':item_true_id', $mid,PDO::PARAM_STR);
        // $stmt->execute();
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // $itype = $result['itype'];
        // $iid = $result['iid'];
        // $item_true_id = $result['item_true_id'];
        $item_true_id = $mid;
        $sale_state = \player\getitem_sale_state($item_true_id,$sid,$dblj);
        $equip_state = \player\getitem_equip_state($item_true_id,$sid,$dblj);
        $stmt =$dblj->query("SELECT iid from system_item where item_true_id = '$item_true_id'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $iid = $result['iid'];
        if($sale_state ==0 &&$equip_state==0){
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $use_next = $encode->encode("cmd=item_op_basic&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=use&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$use_next">使用</a>
HTML;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$out_next = $encode->encode("cmd=item_op_basic&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=out&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$out_next">丢弃</a>
HTML;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$outall_next = $encode->encode("cmd=item_op_basic&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=outall&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$outall_next">丢弃全部</a><br/>
HTML;
}
if($sale_state ==0 &&$equip_state==0){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$shop_next = $encode->encode("cmd=item_op_basic&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=sale&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$shop_next">挂出销售</a><br/>
HTML;
}elseif($sale_state ==1){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$shop_next = $encode->encode("cmd=item_op_basic&sale_cancel=1&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=sale&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$shop_next">撤销销售</a><br/>
HTML;
}
$sql = "SELECT * FROM system_item_op WHERE belong = :iid order by id asc";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':iid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT item_op_br FROM gm_game_basic";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$result_2 = $stmt->fetch(PDO::FETCH_ASSOC);
$op_br = $result_2['item_op_br'];
for ($i=0;$i<count($result);$i++){
$op_id = $result[$i]['id'];
$op_name = $result[$i]['name'];
$op_belong = $result[$i]['belong'];
$op_show_cond = $result[$i]['show_cond'];
$op_link_event = $result[$i]['link_event'];
$op_link_task = $result[$i]['link_task'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;

$register_triggle = checkTriggerCondition($op_show_cond,$dblj,$sid,$oid);//显示条件
if(is_null($register_triggle)){
    $register_triggle =1;//若触发条件为空则默认true
}
if($register_triggle){
$oid = 'item';
$op_next = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&parents_cmd=$cmd&ucmd=$cmid&iid=$op_belong&target_event=$op_link_event&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$op_next">{$op_name}</a>
HTML;
if($op_br ==1){
    $op_html .="<br/>";
}
}if($op_br !=1){
$op_html .="<br/>";
}
}
        break;
case '5':

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $player_gift = $encode->encode("cmd=player_gift&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_gift">赠送</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $player_action = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_action">动作</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;    
$quest_tran = $encode->encode("cmd=player_quest_tran&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
$op_html .=<<<HTML
<a href ="?cmd=$quest_tran">交易</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $player_buy = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_buy">摊位</a><br/>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $player_battle = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_battle">挑战</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $player_attack = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_attack">偷袭</a>
HTML;

$sql = "select uteam_id from game1 where sid = '$sid'";
$cxjg = $dblj->query($sql);
$uteam_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$uteam_id = $uteam_ret['uteam_id'];

$sql = "select uid,uteam_id from game1 where sid = '$mid'";
$cxjg = $dblj->query($sql);
$team_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$team_id = $team_ret['uteam_id'];
$oid = $team_ret['uid'];
if($team_id!=0&&$uteam_id==0){
    $team_join = $encode->encode("cmd=player_team_html&oid=$oid&team_id=$team_id&canshu=join&ucmd=$cmid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$team_join">加队</a>
HTML;
}


$sql = "select * from system_player_friend where usid = '$sid' and osid = '$mid'";
$cxjg = $dblj->query($sql);
$wtjrw = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
if($wtjrw){
    $delete_url = $encode->encode("cmd=player_delete_friend&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$delete_url">删友</a>
HTML;
}else{
    $add_url = $encode->encode("cmd=player_delete_friend&ucmd=$cmid&canshu=2&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$add_url">加友</a>
HTML;
}

$sql = "select * from system_player_black where usid = '$sid' and osid = '$mid'";
$cxjg = $dblj->query($sql);
$wtjrw = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
if($wtjrw){
    $delete_url = $encode->encode("cmd=player_delete_black&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$delete_url">删黑</a><br/>
HTML;
}else{
    $add_url = $encode->encode("cmd=player_delete_black&ucmd=$cmid&canshu=2&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$add_url">拉黑</a><br/>
HTML;
}
    break;
    }
    return $op_html;
}

function task($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $sql = "select * from system_task_user WHERE sid='$sid' AND tstate !=2";
    $cxjg = $dblj->query($sql);
    $wtjrw = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    $taskcount = count($wtjrw);
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $task_url = "cmd=mytask_2&ucmd=$cmid&sid=$sid";
    $main_target_func = $encode->encode("$task_url");
    $task_url = "<a href='?cmd=$main_target_func' >{$value}({$taskcount})</a>";
    return $task_url;
}

function chat($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $chat_main = $encode->encode("cmd=liaotian&ltlx=all&ucmd=$cmid&sid=$sid");
    $chat_main_html=<<<HTML
<a href="?cmd=$chat_main">{$value}</a>
HTML;
    return $chat_main_html;
}

function reward_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $reward_url = $encode->encode("cmd=system_reward&ucmd=$cmid&sid=$sid");
    $reward_html=<<<HTML
<a href="?cmd=$reward_url">{$value}</a>
HTML;
    return $reward_html;
}

function near_exit($cmd,$page_id,$sid,$dblj,$value,$para,&$cmid){
    global $encode;
    $exit_list = get_exit_list($sid,$dblj,$para,$cmid);
    return $exit_list;
}

function map_list($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    //查看地图功能实现
    global $encode;
    $map_url = $encode->encode("cmd=map_detail&mid=$mid&ucmd=$cmid&sid=$sid");
    $map_html=<<<HTML
<a href="?cmd=$map_url">{$value}</a>
HTML;
    return $map_html;
    
}

function game_main($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    //游戏首页功能实现
    global $encode;
    $game_main = $encode->encode("cmd=gm_game_firstpage&ucmd=$cmid&sid=$sid");
    $game_main_html=<<<HTML
<a href="?cmd=$game_main">{$value}</a>
HTML;
    return $game_main_html;
    
}

function time_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $time_url = $encode->encode("cmd=get_time_page&ucmd=$cmid&sid=$sid");
    $time_html=<<<HTML
<a href="?cmd=$time_url">{$value}</a>
HTML;
    return $time_html;
    
}

function player_state($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    global $encode;
    $player_state = $encode->encode("cmd=player_state&mid=$mid&ucmd=$cmid&sid=$sid");
    $map_html=<<<HTML
<a href="?cmd=$player_state">{$value}</a>
HTML;
    return $map_html;
}

function equip_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $equip_url = $encode->encode("cmd=player_equip&ucmd=$cmid&sid=$sid");
    $equip_html=<<<HTML
<a href="?cmd=$equip_url">{$value}</a>
HTML;
    return $equip_html;
}

function skill_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    $skill_url = $encode->encode("cmd=player_skill&ucmd=$cmid&sid=$sid");
    $skill_html=<<<HTML
<a href="?cmd=$skill_url">{$value}</a>
HTML;
    return $skill_html;
}

function get_npc_list($sid,$dblj,&$cmid){
global $encode;
$sql = "SELECT nowmid FROM game1 WHERE sid = :sid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nowmid = $row['nowmid'];
$clmid = player\getmid($nowmid,$dblj);
$npc_list = '';
if ($clmid->mnpc_now !=""){
    $npc_list = explode(',',$clmid->mnpc_now);
    foreach ($npc_list as $npc_detail){
    $npc_para = explode('|',$npc_detail);
    $npc_show_cond = urldecode($npc_para[2]);
    $show_result = checkTriggerCondition($npc_show_cond,$dblj,$sid);
    if(is_null($show_result)){
    $show_result = true;
    }
    if($show_result){
    $npc_id = $npc_para[0];
    $npc_count = $npc_para[1];
    $sql = "select * from system_npc where nid = '$npc_id' and nkill = 0";//获取npc
    $cxjg = $dblj->query($sql);
    $cxnpcall = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0;$i < count($cxnpcall);$i++){
        $nname = $cxnpcall[$i]['nname'];
        $nid = $cxnpcall[$i]['nid'];
        $nkill = $cxnpcall[$i]['nkill'];
        $ntaskid = $cxnpcall[$i]['ntask_target'];
        $ntaskarr = explode(',',$ntaskid);
        if ($ntaskid!='' && $nkill ==0){
            for ($l=0;$l<@count($ntaskarr);$l++){
                $nowrw = \player\gettask($ntaskarr[$l],$dblj);
                $rwret = \player\getplayertaskonce($sid,$ntaskarr[$l],$dblj);
                $rwnowcount = $rwret[0]['tnowcount'];
                $rwstate = $rwret[0]['tstate'];
                $rw_cond = $nowrw->tcond;
                $rw_type = $nowrw->ttype;
                $rw_trigger_cond = checkTriggerCondition($rw_cond,$dblj,$sid);
                if(is_null($rw_trigger_cond)){
                $rw_trigger_cond = true;
                }
                if($rw_trigger_cond){
                $rw_paras = explode(',',$nowrw->ttarget_obj);
                $rw_player_paras = explode(',',$rwnowcount);
                $rw_check_count = @count($rw_paras);
                $rw_check_done = 0;
                
                for($i=0;$i<$rw_check_count;$i++){
                $rw_para = explode('|',$rw_paras[$i]);
                $rwtarget_id = $rw_para[0];
                $rwcount = $rw_para[1];
                
                if($rw_type ==2&&$rwstate ==1){
                $rwnowcount = \player\getitem_count($rwtarget_id,$sid,$dblj)['icount'];
                }
                if($rw_type ==1&&$rwstate ==1){
                $rw_player_para = explode('|',$rw_player_paras[$i]);
                $rwnowcount = $rw_player_para[1];
                }
                if($rwnowcount >=$rwcount){
                $rw_check_done ++;
                }
                }
                if ($nowrw->ttype){
                    if ($rwstate !=2 && (!$rwret ||($rw_check_done &&$rw_check_done==$rw_check_count))){
                        if($nowrw->tnpc_id == $nid){
                            $npchtml .='<img src="images/tan.gif" />';
                        }
                    }elseif ($rwstate==1 ||($rw_check_done &&$rw_check_done<$rw_check_count)){
                        if($nowrw->tnpc_id == $nid){
                            $npchtml .='<img src="images/wen.gif" />';
                        }
                    }
                }
                }
            }
        }
        
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $npccmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$nid&sid=$sid");
        for ($j=0;$j < $npc_count;$j++){
        $npchtml.=<<<HTML
<a href="?cmd=$npccmd">$nname</a>
HTML;
}
$npchtml .="<br/>";
}
}
    }
}

$sql = "select * from system_npc_midguaiwu where nmid='$nowmid' AND nsid = ''";//获取当前地图怪物
$cxjg = $dblj->query($sql);
$cxallguaiwu = $cxjg->fetchAll(PDO::FETCH_ASSOC);
$gwhtml = '';
for ($i = 0;$i<count($cxallguaiwu);$i++){
    $guaiwu_creat_event = $cxallguaiwu[$i]['ncreat_event_id'];
    $guaiwu_ngid = $cxallguaiwu[$i]['ngid'];
    $guaiwu_nid = $cxallguaiwu[$i]['nid'];
    $guaiwu_para = $guaiwu_nid ."|"."$guaiwu_ngid";

    if($guaiwu_creat_event!=0){
    include_once 'class/events_steps_change.php';
    events_steps_change($guaiwu_creat_event,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$guaiwu_para,$para);
    }
    $br = "<br/>";
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $gwcmd = $encode->encode("cmd=npc_html&ucmd=$cmid&ngid=".$guaiwu_ngid."&nid=".$guaiwu_nid."&sid=$sid&nowmid=$nowmid");
$npchtml .="<a href='?cmd=$gwcmd'>".$cxallguaiwu[$i]['nname']."</a>";
}
$npchtml .=$br;
return $npchtml;
}

function get_player_list($sid,$dblj,$value,&$cmid){
$gameconfig = \player\getgameconfig($dblj);
$system_offline_time = $gameconfig->offline_time;
$near_player_show_count = $gameconfig->near_player_show;
$playerLinkCount = 0; // 初始化玩家链接计数器
global $encode;
$sql = "SELECT nowmid,uid FROM game1 WHERE sid = :sid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nowmid = $row['nowmid'];
$uid = $row['uid'];
$clmid = player\getmid($nowmid,$dblj);
$scene_name = $clmid->mname;
$sql = "select * from game1 where nowmid='$nowmid' AND sfzx = 1 AND sid !='$sid' and uis_sailing =0";//获取当前地图玩家
$cxjg = $dblj->query($sql);
$playerhtml = '';
if ($cxjg){
    $cxallplayer = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    $cxallplayer_count = @count($cxallplayer);
    for ($i = 1;$i<$cxallplayer_count +1;$i++){
        if ($cxallplayer[$i-1]['uname']!=""){
            $cxuid = $cxallplayer[$i-1]['uid'];
            $cxsid = $cxallplayer[$i-1]['sid'];
            $cxuname = $cxallplayer[$i-1]['uname'];
            if ($playerLinkCount < $near_player_show_count) {
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $playercmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&oid=$cxuid&sid=$sid");
                $playerhtml .= "<a href='?cmd=$playercmd'>{$club->clubname}{$cxuname}</a>";
                $playerLinkCount++; // 增加链接计数
            }
            // 如果查询到的玩家数量超过规定数量，生成 "..." 链接
            if ($cxallplayer_count > $near_player_show_count) {
                $allplayerspage = $encode->encode("cmd=getalloplayerinfo&ucmd=$cmid&sid=$sid");
                $playerhtml .= " <a href='?cmd=$allplayerspage'>...</a>";
                $playerhtml = $playerhtml."<br/>";
                return $playerhtml;
            }

        }
    }

    if($cxallplayer_count){
    $playerhtml = $playerhtml."<br/>";
    }
    return $playerhtml;
}

}

function get_item_list($sid,$dblj,$mid,&$cmid){
    global $encode;
    $clmid = player\getmid($mid,$dblj);
    $mid_item_list = explode(",",$clmid->mitem_now);
    if (!empty($mid_item_list[0])){
    foreach ($mid_item_list as $item_detail){
    $item_list = explode('|',$item_detail);
    $item_id = $item_list[0];
    $item_count = $item_list[1];
    // $item_count = \lexical_analysis\process_string($item_count,$sid);
    // $item_count = \lexical_analysis\process_string($item_count,$sid);
    // @$item_count = eval("return $item_count;");
    if($item_count >0){
    $item_para = player\getitem($item_id,$dblj);
    $item_name = $item_para ->iname;
    $item_name =\lexical_analysis\color_string($item_name);
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $itemcmd = $encode->encode("cmd=get_item_ret&mid=$mid&iid=$item_id&ucmd=$cmid&icount=$item_count&iname=$item_name&sid=$sid");
    $itemhtml.=<<<HTML
<a href="?cmd=$itemcmd">{$item_name}({$item_count})</a>
HTML;
}
}
$itemhtml.=<<<HTML
</br/>
HTML;
    }

    return $itemhtml;
}

function get_chat_list($sid,$dblj,&$cmid){
global $encode;
$player = player\getplayer($sid,$dblj);
$gameconfig = player\getgameconfig($dblj);
$sql = 'SELECT * FROM system_chat_data ORDER BY id DESC LIMIT 2';//聊天列表获取
$ltcxjg = $dblj->query($sql);
$lthtml='';
if ($ltcxjg){
    $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0;$i < count($ret);$i++){
        $chat_id = $ret[count($ret) - $i-1]['id'];
        $uname = $ret[count($ret) - $i-1]['name'];
        $umsg = $ret[count($ret) - $i-1]['msg'];
        $uid = $ret[count($ret) - $i-1]['uid'];
        $imuid = $ret[count($ret) - $i-1]['imuid'];
        $chat_type = $ret[count($ret) - $i-1]['chat_type'];
        $send_type = $ret[count($ret) - $i-1]['send_type'];
        $send_time = $ret[count($ret) - $i-1]['send_time'];
        $viewed = $ret[count($ret) - $i-1]['viewed'];
        $maxChars = $gameconfig->game_max_char; // 最大字符数量
        $nowdate = date('Y-m-d H:i:s');
        $minute=floor((strtotime($nowdate)-strtotime($send_time))/60);
        if (mb_strlen($umsg, 'utf-8') > $maxChars) {
            $umsg = mb_substr($umsg, 0, $maxChars, 'utf-8') . "...";
        }
        $umsg = lexical_analysis\color_string($umsg);
        $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
        $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
        if ($uid &&  $chat_type ==0 && $minute <10){
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        
        if($send_type==0){
            $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$sid");
        }elseif($send_type==1){
            $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$sid");
        }
        
        $lthtml .="[<span style='color: orangered;'>公共</span>]<a href='?cmd=$u_cmd''>$uname</a>:$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
        
        }elseif($imuid == $player->uid && $chat_type == 1 && $viewed == 0){
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $o_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$sid");
        if($uid){
            $lthtml .="[私聊]<a href='?cmd=$o_cmd''>{$uname}</a>对你说:$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
            $dblj->exec("update system_chat_data set viewed = 1 where id = '$chat_id'");
        }
        }elseif(!$uid && $chat_type == 0&&$minute <10){
            $lthtml .="[<span style='color: orangered;'>公共</span>]<div class='hpys' style='display: inline'>$uname:</div>$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
        }
    }
}
return $lthtml;
}


function get_exit_list($sid,$dblj,$para,&$cmid){
global $encode;
$player = player\getplayer($sid,$dblj);
$sql = "SELECT nowmid FROM game1 WHERE sid = :sid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nowmid = $row['nowmid'];

$clmid = player\getmid($nowmid,$dblj);

$upmidlj = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$clmid->mup&sid=$sid");//上地图
$downmidlj = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$clmid->mdown&sid=$sid");
$leftmidlj = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$clmid->mleft&sid=$sid");
$rightmidlj = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$clmid->mright&sid=$sid");
$upmid = player\getmid($clmid->mup,$dblj);
$downmid = player\getmid($clmid->mdown,$dblj);
$leftmid = player\getmid($clmid->mleft,$dblj);
$rightmid = player\getmid($clmid->mright,$dblj);

if ($upmid->mname!='' && $para ==4){
    $upmid_mname =\lexical_analysis\color_string($upmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    $lukouhtml .= <<<HTML
    北:<a href="?cmd=$upmidlj">$upmid_mname ↑</a><br/>
HTML;
}

if ($leftmid->mname!='' && $para ==3){
    $leftmid_mname =\lexical_analysis\color_string($leftmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;    
    $lukouhtml .= <<<HTML
    西:<a href="?cmd=$leftmidlj">$leftmid_mname ←</a><br/>
HTML;
}

if ($rightmid->mname!='' && $para ==1){
    $rightmid_mname =\lexical_analysis\color_string($rightmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;    
    $lukouhtml .= <<<HTML
    东:<a href="?cmd=$rightmidlj">$rightmid_mname →</a><br/>
HTML;
}

if ($downmid->mname!='' && $para ==2){
    $downmid_mname =\lexical_analysis\color_string($downmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;    
    $lukouhtml .= <<<HTML
    南:<a href="?cmd=$downmidlj">$downmid_mname ↓</a><br/>
HTML;
}
return $lukouhtml;
}

function quick_link($cmd,$page_id,$sid,$dblj,$value,$mid,$quick_pos,&$cmid){
    global $encode;
    // $monster_id_root = $monster_ids[0];
    // $monster_id = $monster_ids[1];
    // $monster_nowmid = $monster_ids[2];
    $sql = "SELECT * from system_fight_quick where sid = :sid and quick_pos = '$quick_pos'";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $quick_value_root = $value;
    $quick_values = $row['quick_value'];
    $quick_value = explode("|",$quick_values);
    $quick_type = $quick_value[0];
    $quick_id = $quick_value[1];
    switch($quick_type){
        case '1':
            $sql = "SELECT * from system_skill_user where jid = :quick_id";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':quick_id', $quick_id,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_lvl = $row['jlvl'];
            $sql = "SELECT * from system_skill where jid = :quick_id";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':quick_id', $quick_id,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_name = $row['jname'];
            if(substr($value,-1) == "\n"){
            $value = $quick_name."<br/>";
            }else{
            $value = $quick_name;
            }
            break;
        case '2':
            $sql = "SELECT * from system_item where iid = :quick_id and sid = :sid";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':quick_id', $quick_id,PDO::PARAM_STR);
            $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_count = $row['icount'];
            $sql = "SELECT * from system_item_module where iid = :quick_id";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':quick_id', $quick_id,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_name = $row['iname'];
            if(substr($value,-1) == "\n"){
            $value = $quick_name."({$quick_count})"."<br/>";
            }else{
            $value = $quick_name."({$quick_count})";
            }
            break;
        case '3':
            $sql = "SELECT * from system_item where iid = :quick_id and sid = :sid";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':quick_id', $quick_id,PDO::PARAM_STR);
            $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_count = $row['icount'];
            $sql = "SELECT * from system_item_module where iid = :quick_id";
            $stmt = $dblj->prepare($sql);
            $stmt->bindParam(':quick_id', $quick_id,PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quick_name = $row['iname'];
            if(substr($value,-1) == "\n"){
            $value = $quick_name."({$quick_count})"."<br/>";
            }else{
            $value = $quick_name."({$quick_count})";
            }
            break;
    }
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $value = \lexical_analysis\color_string($value);
    if($quick_type){
        if($quick_type !=1 &&$quick_count <=0){
    $quick_set = $encode->encode("cmd=function_quick_html&pos=$quick_pos&canshu=1&ucmd=$cmid&qpos=$quick_pos&sid=$sid");
    $quick_url=<<<HTML
<a href="?cmd=$quick_set">{$quick_value_root}</a>
HTML;
        }else{
    $quick_to = $encode->encode("cmd=pve_fighting&ucmd=$cmid&qtype=$quick_type&qtype_id=$quick_id&sid=$sid");
    $quick_url=<<<HTML
<a href="?cmd=$quick_to">{$value}</a>
HTML;
}
}else{
    $quick_set = $encode->encode("cmd=function_quick_html&pos=$quick_pos&canshu=1&ucmd=$cmid&qpos=$quick_pos&sid=$sid");
    $quick_url=<<<HTML
<a href="?cmd=$quick_set">{$value}</a>
HTML;
}
    return $quick_url;
}

function self_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid){
    $sql = "SELECT * from game1 where sid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $player_list = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $player_id_root = $player_list['uid'];
    $player_nowmid = $player_list['nowmid'];
    $player_name = $player_list['uname'];
    $player_hp = $player_list['uhp'];
    $player_maxhp = $player_list['umaxhp'];
    $player_text =<<<HTML
[{$player_name}]:({$player_hp}/{$player_maxhp})<br/>
HTML;
    if($cmd =="pve_fighting"){
    $sql = "SELECT SUM(cut_hp) AS total_cut_hp FROM game2 WHERE sid = :sid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $cut_hp = $row['total_cut_hp'];

    if($cut_hp!=''){
    $cut_hp = $cut_hp >=0?"-".$cut_hp:"+".$cut_hp;
    $player_text =<<<HTML
[{$player_name}]:({$player_hp}/{$player_maxhp}){$cut_hp}<br/>
HTML;
    }
    }
    $sql = "SELECT * from system_pet_player where psid = :sid and pstate = 1";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
    $pet_name = $row['pname'];
    $pet_hp = $row['php'];
    $pet_maxhp = $row['pmaxhp'];
    if($pet_hp <=0){
    $player_text .=<<<HTML
[{$pet_name}]已经战死！<br/>
HTML;
    }else{
    $player_text .=<<<HTML
[{$pet_name}]:({$pet_hp}/{$pet_maxhp}){$pcut_hp}<br/>
HTML;
}
}
    return $player_text;
    
}

function enemy_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid){
    $sql = "SELECT * from system_npc_midguaiwu where nsid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $monster_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<@count($monster_list);$i++){
    $monster_id_root = $monster_list[$i]['nid'];
    $monster_id = $monster_list[$i]['ngid'];
    $monster_nowmid = $monster_list[$i]['nmid'];

    if($cmd =="pve_fighting"){
    $sql = "SELECT * from game2 where sid = :sid and gid = :gid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $hurt_hp = $row['hurt_hp'];
    if($hurt_hp!=''){
    $hurt_hp = $hurt_hp >=0?"-".$hurt_hp:"$hurt_hp";
    }
    }
    $sql = "SELECT * from system_npc_midguaiwu where nsid = :sid and ngid = :ngid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':ngid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $monster_name = $row['nname'];
    $monster_hp = $row['nhp'];
    $monster_maxhp = $row['nmaxhp'];
    if($monster_hp <=0){
    $enemy_text .=<<<HTML
[{$monster_name}]已经战死！<br/>
HTML;
    }else{
    $enemy_text .=<<<HTML
[{$monster_name}]:({$monster_hp}/{$monster_maxhp}){$hurt_hp}<br/>
HTML;
}
}
    return $enemy_text;
    
}

function enemy_attack_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid){
    $sql = "SELECT * from system_npc_midguaiwu where nsid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $monster_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<@count($monster_list);$i++){
    $monster_id_root = $monster_list[$i]['nid'];
    $monster_id = $monster_list[$i]['ngid'];
    $monster_nowmid = $monster_list[$i]['nmid'];

    if($cmd =="pve_fighting"){
    $sql = "SELECT * from game2 where sid = :sid and gid = :gid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['fight_omsg']){
    $fight_omsg .= $row['fight_omsg']."<br/>";
    }
    }
}
    return $fight_omsg;
    
}

function player_attack_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid){
    $sql = "SELECT * from system_npc_midguaiwu where nsid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $monster_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<@count($monster_list);$i++){
    $monster_id_root = $monster_list[$i]['nid'];
    $monster_id = $monster_list[$i]['ngid'];
    $monster_nowmid = $monster_list[$i]['nmid'];

    if($cmd =="pve_fighting"){
    $sql = "SELECT * from game2 where sid = :sid and gid = :gid AND pid = 0";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['fight_umsg']){
    $fight_umsg .= $row['fight_umsg']."<br/>";
    }
    
    $sql = "SELECT * from game2 where sid = :sid and gid = :gid AND pid != 0";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['fight_umsg']){
    $fight_umsg .= $row['fight_umsg']."<br/>";
    }
    
    }
}
    return $fight_umsg;
    
}

function designer($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;    
    global $encode;
    $designer_url = $encode->encode("cmd=gm&ucmd=$cmid&sid=$sid");
    $designer_url=<<<HTML
        <a href="?cmd=$designer_url">{$value}</a>
HTML;
    return $designer_url;
}

function gogame($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $entrance_url = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
    $entrance_url=<<<HTML
        <a href="?cmd=$entrance_url">{$value}</a>
HTML;
    return $entrance_url;
}

function goforum($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;
    global $encode;
    $forum_url = $encode->encode("cmd=game_forum&canshu=1&ucmd=$cmid&sid=$sid");
    $forum_url=<<<HTML
<a href="?cmd=$forum_url">{$value}</a>
HTML;
    return $forum_url;
}

function auto_url($cmd,$page_id,$sid,$dblj,$value,$type,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    if($type ==1){
    $open_auto_url = $encode->encode("cmd=pve_fight&auto_canshu=1&ucmd=$cmid&sid=$sid");
    $auto_url=<<<HTML
        <a href="?cmd=$open_auto_url">{$value}</a>
HTML;
}elseif($type ==2){
    //置零当前所受伤害表game2
    $close_auto_url = $encode->encode("cmd=pve_fight&auto_canshu=2&ucmd=$cmid&sid=$sid");
    $auto_url=<<<HTML
        <a href="?cmd=$close_auto_url">{$value}</a>
HTML;
}
    return $auto_url;
}

function look_o_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $look_url = $encode->encode("cmd=pve_fight&look_canshu=1&ucmd=$cmid&sid=$sid");
    $look_url=<<<HTML
        <a href="?cmd=$look_url">{$value}</a>
HTML;
    return $look_url;
}

function pet_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $pet_url = $encode->encode("cmd=player_pet&ucmd=$cmid&sid=$sid");
    $pet_url=<<<HTML
        <a href="?cmd=$pet_url">{$value}</a>
HTML;
    return $pet_url;
}


function sail_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $sail_url = $encode->encode("cmd=sail_html&mid=$mid&ucmd=$cmid&sid=$sid");
    $sail_url=<<<HTML
        <a href="?cmd=$sail_url">{$value}</a>
HTML;
    return $sail_url;
}

function pick_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $rp_id = \player\getmid($mid,$dblj)->mrp_id;
    $rp_action_name = \player\getrp_detail($rp_id,$dblj)->rp_action_name;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $pick_url = $encode->encode("cmd=pick_html&rp_id=$rp_id&mid=$mid&ucmd=$cmid&sid=$sid");
    $pick_url=<<<HTML
        <a href="?cmd=$pick_url">{$rp_action_name}<br/></a>
HTML;
    return $pick_url;
}

function mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $mosaic_url = $encode->encode("cmd=mosaic_html&mid=$mid&ucmd=$cmid&sid=$sid");
    $mosaic_url=<<<HTML
        <a href="?cmd=$mosaic_url">{$value}</a>
HTML;
    return $mosaic_url;
}

function equip_core_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
global $encode;
$sql = "select * from system_equip_def where type = '1'";
$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetchAll(PDO::FETCH_ASSOC) : [];

$equipbid = null;
foreach ($ret as $row) {
    $equiptypeid = $row['id'];
    $equiptypename = $row['name'];
    $sql = "select * from system_equip_user where eq_type = 1 and equiped_pos_id = '$equiptypeid' and eqsid = '$sid'";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipbid = $row['eq_true_id'];
            break;
        }
    }
}
$equipitem = $encode->encode("cmd=equip_op_basic&eq_type=1&target_event=choose&ucmd=$cmid&sid=$sid");
$equipbhtml = "无<a href='?cmd=$equipitem'>[装备]</a>";
if ($equipbid) {
    $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equipbid')";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipbname = \lexical_analysis\color_string($row['iname']);
            $removeitem = $encode->encode("cmd=equip_op_basic&target_event=remove&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
            $ckequipbinfo = $encode->encode("cmd=equip_html&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
            $equipbhtml = "<a href='?cmd=$ckequipbinfo'>{$equipbname}</a><a href='?cmd=$removeitem'>[卸下]</a>";
        }
    }
}

$sql = "select * from system_equip_def WHERE type = 2";
$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetchAll(PDO::FETCH_ASSOC) : [];

$equipfhtml = '';
foreach ($ret as $row) {
    $equiptypeid = $row['id'];
    $equiptypename = $row['name'];
    $sql = "select * from system_equip_user where eq_type = 2 and equiped_pos_id = '$equiptypeid' and eqsid = '$sid'";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipfid = $row['eq_true_id'];
            if ($equipfid) {
                $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equipfid')";
                $cxjg = $dblj->query($sql);
                if ($cxjg) {
                    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        $equipfname = \lexical_analysis\color_string($row['iname']);
                    }
                }
            }
            $removeitem = $encode->encode("cmd=equip_op_basic&target_event=remove&ucmd=$cmid&equip_true_id=$equipfid&sid=$sid");
            $ckequipfinfo = $encode->encode("cmd=equip_html&ucmd=$cmid&equip_true_id=$equipfid&sid=$sid");
            $equipfhtml .= "{$equiptypename}：<a href='?cmd=$ckequipfinfo'>{$equipfname}</a><a href='?cmd=$removeitem'>[卸下]</a><br/>";
        }else{
            $equipitem = $encode->encode("cmd=equip_op_basic&eq_type=2&equip_typename=$equiptypename&eq_subtype=$equiptypeid&target_event=choose&ucmd=$cmid&sid=$sid");
            $equipfhtml .= "{$equiptypename}：无<a href='?cmd=$equipitem'>[装备]</a><br/>";
        }
    }
}

$bagequiphtml = <<<HTML
【我的装备】<br/>
兵器：{$equipbhtml}<br/>
$equipfhtml
<br/>
HTML;
return $bagequiphtml;
}



?>