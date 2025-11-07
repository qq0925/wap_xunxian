<?php
function trimTrailingNewlinesAndCount($input) {
    // 使用正则表达式去除所有换行符（包括 \r 和 \n）
    // rtrim 会去除末尾的所有空白字符、换行符或回车符（Windows 和 Unix 风格的换行符）
    $trimmedString = rtrim($input, "\n");
    // 计算去除的换行符数量
    $newlineCount = strlen($input) - strlen($trimmedString);

    return [$trimmedString, $newlineCount];
}

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
        case '39':
            $buy_url = buy_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $buy_url;
        case '41':
            $gift_url = gift_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $gift_url;
        case '43':
            $invite_team_url = invite_team_action($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $invite_team_url;
        case '45':
            $add_friend_url = add_friend_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $add_friend_url;
        case '46':
            $add_black_url = add_black_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $add_black_url;
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
            $outgoing_url = outgoing_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $outgoing_url;
        case '76':
            $pick_url = pick_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $pick_url;
        case '77':
            $mosaic_url = mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $mosaic_url;
        case '78':
            $equip_core_url = equip_core_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $equip_core_url;
        case '79':
            $pet_inout_url = pet_inout_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $pet_inout_url;
        case '82':
            $pet_skill_url = pet_skill_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $pet_skill_url;
        case '83':
            $pet_equip_url = pet_equip_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $pet_equip_url;
        case '87':
            $pet_item_url = pet_item_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $pet_item_url;
        case '88':
            $equip_mosaic_url = equip_mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $equip_mosaic_url;
        case '89':
            $shop_core_url = shop_core_list($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $shop_core_url;
        case '90':
            $item_mosaic_url = item_mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid);
            return $item_mosaic_url;
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

function self_photo($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $photo_url = $encode->encode("cmd=photo_html&ucmd=$cmid&sid=$sid");
    $photo_html=<<<HTML
<a href="?cmd=$photo_url">{$value}</a>
HTML;
    return $photo_html;
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

function buy_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $buy_url = $encode->encode("cmd=player_buy&oid=$mid&ucmd=$cmid&sid=$sid");
    $buy_html=<<<HTML
<a href="?cmd=$buy_url">{$value}</a>
HTML;
    return $buy_html;
}

function gift_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $gift_url = $encode->encode("cmd=player_gift&oid=$mid&ucmd=$cmid&sid=$sid");
    $gift_html=<<<HTML
<a href="?cmd=$gift_url">{$value}</a>
HTML;
    return $gift_html;
}

function add_friend_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
global $encode;
$add_para = explode('|',$value);
$sql = "select * from system_player_friend where usid = '$sid' and osid = '$mid'";
$cxjg = $dblj->query($sql);
$wtjrw = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
if($wtjrw){
    $delete_value = $add_para[1];
    $delete_url = $encode->encode("cmd=player_delete_friend&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
    $add_html .=<<<HTML
<a href ="?cmd=$delete_url">{$delete_value}</a>
HTML;
}else{
    $add_value = $add_para[0];
    $add_url = $encode->encode("cmd=player_delete_friend&ucmd=$cmid&canshu=2&oid=$mid&sid=$sid");
    $add_html .=<<<HTML
<a href ="?cmd=$add_url">{$add_value}</a>
HTML;
}
    return $add_html;
}


function add_black_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
global $encode;
$add_para = explode('|',$value);
$sql = "select * from system_player_black where usid = '$sid' and osid = '$mid'";
$cxjg = $dblj->query($sql);
$wtjrw = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
if($wtjrw){
    $delete_value = $add_para[1];
    $delete_url = $encode->encode("cmd=player_delete_black&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
    $add_html .=<<<HTML
<a href ="?cmd=$delete_url">{$delete_value}</a>
HTML;
}else{
    $add_value = $add_para[0];
    $add_url = $encode->encode("cmd=player_delete_black&ucmd=$cmid&canshu=2&oid=$mid&sid=$sid");
    $add_html .=<<<HTML
<a href ="?cmd=$add_url">{$add_value}</a>
HTML;
}
    return $add_html;
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
$op_count = count($result);
for ($i=0;$i<$op_count;$i++){
$op_id = $result[$i]['id'];
$op_name = $result[$i]['name'];
$op_belong = $result[$i]['belong'];
$op_show_cond = $result[$i]['show_cond'];
$op_link_event = $result[$i]['link_event'];
$op_link_task = $result[$i]['link_task'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$register_triggle = checkTriggerCondition($op_show_cond,$dblj,$sid,$oid,$mid);//显示条件
if(is_null($register_triggle)){
    $register_triggle =1;//若触发条件为空则默认true
}
if($register_triggle){
$oid = 'scene';
//$parents_page = 'module_all/main_page.php';
global $parents_page;
$op_next = $encode->encode("cmd=main_target_event&oid=$oid&mid=$mid&parents_page=$parents_page&parents_cmd=$cmd&ucmd=$cmid&mid=$op_belong&target_event=$op_link_event&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$op_next">{$op_name}</a>
HTML;
if($op_br ==1){
    $op_html .="<br/>";
}
}
}
        break;
        case '2':
$sql = "SELECT nshop,nid FROM system_npc_scene WHERE ncid = :ncid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':ncid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nshop = $result['nshop'];
$nid = $result['nid'];
if($nshop ==1){
$npc_buy = $encode->encode("cmd=gm_shop_npc&mid=$mid&ucmd=$cmid&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$npc_buy">买东西</a><br/>
HTML;
}
$sql = "SELECT * FROM system_npc_op WHERE belong = :mid order by id asc";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $nid,PDO::PARAM_STR);
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
$oid = 'npc_scene';
$register_triggle = checkTriggerCondition($op_show_cond,$dblj,$sid,$oid,$mid);//显示条件
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
}
}

$sql = "SELECT nkill,nname,nnot_dead FROM system_npc_scene WHERE ncid = :mid";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':mid', $mid,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nkill = $result['nkill'];
$nname = $result['nname'];
$nnot_dead = $result['nnot_dead'];
if($nkill ==1 && $nnot_dead ==0){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$attack_attack = $encode->encode("cmd=pve_fight&ucmd=$cmid&ncid=$mid&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$attack_attack">攻击{$nname}</a><br/>
HTML;
}elseif($nkill ==1 && $nnot_dead ==1){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$attack_attack = $encode->encode("cmd=pve_fight&ucmd=$cmid&ncid=$mid&nnot_dead=1&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$attack_attack">攻击{$nname}</a><br/>
HTML;
}
break;
        case '3':
$itemid = \player\getitem_root($mid,$sid,$dblj);
$sql = "SELECT * FROM system_item_op WHERE belong = :iid order by id asc";
$stmt = $dblj->prepare($sql);
$stmt->bindParam(':iid', $itemid,PDO::PARAM_STR);
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
$item_true_id = $mid;
$sale_state = \player\getitem_sale_state($item_true_id,$sid,$dblj);
$equip_state = \player\getitem_equip_state($item_true_id,$sid,$dblj);
$stmt = $dblj->query("SELECT sim.iid, sim.itype
              FROM system_item si
              JOIN system_item_module sim ON si.iid = sim.iid
              WHERE si.item_true_id = '$item_true_id'");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$iid = $result['iid'];
$itype = $result['itype'];
if($sale_state ==0 &&$equip_state==0){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$use_next = $encode->encode("cmd=item_op_basic&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=use&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$use_next">使用</a>
HTML;

if($itype =="书籍"){
$read_next = $encode->encode("cmd=item_op_basic&parents_cmd=$cmd&ucmd=$cmid&item_true_id=$item_true_id&iid=$iid&target_event=look_book&sid=$sid");
$op_html .=<<<HTML
<a href="?cmd=$read_next">阅读</a><br/>
HTML;
}
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
        break;
case '4':

$sql = "select pstate from system_pet_player where psid = '$sid' and pid = '$mid'";
$cxjg = $dblj->query($sql);
$wtjrw = $cxjg->fetch(PDO::FETCH_ASSOC);
$fight_state = $wtjrw['pstate'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
if($fight_state ==0){
    $fight_url = $encode->encode("cmd=player_petinfo&ucmd=$cmid&fight_canshu=1&pet_id=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$fight_url">出战</a>|
HTML;
}else{
    $back_url = $encode->encode("cmd=player_petinfo&ucmd=$cmid&fight_canshu=2&pet_id=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$back_url">收回</a>|
HTML;
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&pet_id=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">挂售</a>|
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&pet_id=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">赶走</a>|
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">技能</a><br/>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">装备</a>|
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">培养</a>|
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">清洁</a>|
HTML;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
    $pet_sale = $encode->encode("cmd=player_petinfo&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$pet_sale">喂食</a><br/>
HTML;
    break;
case '5':

$cmid = $cmid + 1;
$cdid[] = $cmid;
    $player_gift = $encode->encode("cmd=player_gift&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_gift">赠送</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
    $player_action = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_action">动作</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
$quest_tran = $encode->encode("cmd=player_quest_tran&ucmd=$cmid&canshu=1&oid=$mid&sid=$sid");
$op_html .=<<<HTML
<a href ="?cmd=$quest_tran">交易</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
    $player_buy = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_buy">摊位</a><br/>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
    $player_battle = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_battle">挑战</a>
HTML;

$cmid = $cmid + 1;
$cdid[] = $cmid;
    $player_attack = $encode->encode("cmd=player_buy&ucmd=$cmid&oid=$mid&sid=$sid");
    $op_html .=<<<HTML
<a href ="?cmd=$player_attack">偷袭</a>
HTML;

$sql = "select uteam_id from game1 where sid = '$sid'";
$cxjg = $dblj->query($sql);
$uteam_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$uteam_id = $uteam_ret['uteam_id'];

$sql = "select uid,uteam_id from game1 where sid = '$mid'";
$cxjg = $dblj->query($sql);
$team_ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$cmid = $cmid + 1;
$cdid[] = $cmid;
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
    if($op_html){
    $op_html = preg_replace('/<br\s*\/?>$/', '', $op_html); // 去掉结尾的 <br>
    }
    return $op_html;
}

function task($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    global $encode;
    // $sql = "select * from system_task_user WHERE sid='$sid' AND tstate !=2";
    // $cxjg = $dblj->query($sql);
    // $wtjrw = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    // $taskcount = count($wtjrw);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $task_url = "cmd=mytask_2&ucmd=$cmid&sid=$sid";
    $main_target_func = $encode->encode("$task_url");
    $task_url = "<a href='?cmd=$main_target_func' >{$value}</a>";
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
    $reward_para = explode('|',$value);
    $reward_name = $reward_para[0];
    $reward_change = rtrim($reward_para[1]);
    if($reward_change){
    $reward_url = $encode->encode("cmd=system_reward&reward_change=$reward_change&ucmd=$cmid&sid=$sid");
    }else{
    $reward_url = $encode->encode("cmd=system_reward&reward_change=0&ucmd=$cmid&sid=$sid");
    }
    $reward_html=<<<HTML
<a href="?cmd=$reward_url">{$reward_name}</a>
HTML;
    return $reward_html;
}

function near_exit($cmd,$page_id,$sid,$dblj,$value,$para,&$cmid){
    global $encode;
    $exit_list = get_exit_list($sid,$dblj,$para,$value,$cmid);
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
$npc_seg = \player\getgameconfig($dblj)->npc_seg;
$npc_list = '';
if ($clmid->mnpc_now !=""){
    $npc_list_br = \player\getgameconfig($dblj)->npc_list_br;
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
    $sql = "select * from system_npc_scene where nid = '$npc_id' and nmid = '$nowmid'";//获取场景npc
    $cxjg = $dblj->query($sql);
    $cxnpcall = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0;$i < count($cxnpcall);$i++){
        $nid = $cxnpcall[$i]['nid'];
        $ncid = $cxnpcall[$i]['ncid'];
        $nname = $cxnpcall[$i]['nname'];
        $nname = \lexical_analysis\process_string($nname,$sid,'npc_scene',$ncid);
        $nname = \lexical_analysis\process_photoshow($nname);
        $nname =\lexical_analysis\color_string($nname);
        $nkill = $cxnpcall[$i]['nkill'];
        $nnot_dead = $cxnpcall[$i]['nnot_dead'];
        $ntaskid = $cxnpcall[$i]['ntask_target'];
        $ntaskarr = explode(',',$ntaskid);
        if ($ntaskid!=''){
            for ($l=0;$l<@count($ntaskarr);$l++){
                $taskid = $ntaskarr[$l];
                $task_show_result = \player\scene_task_show($taskid,$nid,$sid,$dblj);
                if($task_show_result ==1){
                $npchtml .='<img src="images/tan.gif" />';
                }elseif($task_show_result ==2){
                $npchtml .='<img src="images/wen.gif" />';
                }
            }
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $npccmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$nid&mid=$ncid&sid=$sid");

        if($nkill ==0){
                $npchtml.=<<<HTML
<a href="?cmd=$npccmd">{$nname}</a>{$npc_seg}
HTML;
        }else{
                $npchtml.=<<<HTML
<a href="?cmd=$npccmd">*{$nname}</a>{$npc_seg}
HTML;
        }
}

if($npc_list_br ==1){
    if($npc_seg){
    $npchtml = rtrim($npchtml,"$npc_seg") ."<br/>";
    }else{
    $npchtml .= "<br/>";
    }
}
}
    }
}

    $sql = "select * from system_pet_scene where nmid = '$nowmid' and nstate = 1";//获取场景宠物
    $cxjg = $dblj->query($sql);
    $cxpetall = $cxjg->fetchAll(PDO::FETCH_ASSOC);
    if($cxpetall){
        for ($i=0;$i < count($cxpetall);$i++){
        $nname = $cxpetall[$i]['nname'];
        $npid = $cxpetall[$i]['npid'];
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $petcmd = $encode->encode("cmd=pet_view&ucmd=$cmid&petid=$npid&sid=$sid");
                $npchtml.=<<<HTML
<a href="?cmd=$petcmd">{$nname}(宠)</a>{$npc_seg}
HTML;
}
}
if($npchtml){
    if($npc_seg){
    $npchtml = rtrim($npchtml,"$npc_seg");
    }
$npchtml = preg_replace('/<br\s*\/?>$/', '', $npchtml); // 去掉结尾的 <br>
}
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
            //$cxuid = $cxallplayer[$i-1]['uid'];
            $cxsid = $cxallplayer[$i-1]['sid'];
            $cxuname = $cxallplayer[$i-1]['uname'];
            if ($playerLinkCount < $near_player_show_count) {
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $playercmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&mid=$cxsid&sid=$sid");
                $playerhtml .= "<a href='?cmd=$playercmd'>{$club->clubname}{$cxuname}</a>";
                $playerLinkCount++; // 增加链接计数
            }
            // 如果查询到的玩家数量超过规定数量，生成 "..." 链接
            if ($cxallplayer_count > $near_player_show_count) {
                $allplayerspage = $encode->encode("cmd=getalloplayerinfo&ucmd=$cmid&sid=$sid");
                $playerhtml .= " <a href='?cmd=$allplayerspage'>...</a>";
                //$playerhtml = $playerhtml."<br/>";
                return $playerhtml;
            }

        }
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
    }
    $drop_item_list = player\getscenedropitem($mid,$dblj);
    if($drop_item_list){
    $drop_item_all_count = count($drop_item_list);
    for($i=0;$i<$drop_item_all_count;$i++){
    $drop_item_datas = explode(',',$drop_item_list[$i]['drop_item_data']);
    $drop_id = $drop_item_list[$i]['drop_id'];
    foreach ($drop_item_datas as $drop_item_data){
    $drop_item_one = explode('|',$drop_item_data);
    $drop_item_id = $drop_item_one[0];
    $drop_item_count = $drop_item_one[1];
    if($drop_item_count >0){
    $drop_item_para = player\getitem($drop_item_id,$dblj);
    $drop_item_name = $drop_item_para ->iname;
    $drop_item_name =\lexical_analysis\color_string($drop_item_name);
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $drop_itemcmd = $encode->encode("cmd=get_drop_item_ret&drop_id=$drop_id&mid=$mid&iid=$drop_item_id&ucmd=$cmid&icount=$drop_item_count&iname=$drop_item_name&sid=$sid");
    $drop_itemhtml.=<<<HTML
<a href="?cmd=$drop_itemcmd">{$drop_item_name}({$drop_item_count})</a>
HTML;
}
}
}
    }
    if($drop_itemhtml){
    $itemhtml .=$drop_itemhtml;
    }
    return $itemhtml;
}

function get_chat_list($sid, $dblj, &$cmid) {
    global $encode;
    $player = player\getplayer($sid, $dblj);
    $gameconfig = player\getgameconfig($dblj);
    $scene_message_count = $gameconfig->scene_message_count;
    $scene_chat_time = $gameconfig->scene_chat_time;
    $long_exist_message = $gameconfig->long_exist_message;
    $can_input = $gameconfig->can_input;
    $maxChars = $gameconfig->game_max_char;
    $nowdate = date('Y-m-d H:i:s');
    
    // 使用参数化查询防止SQL注入
    $sql = "SELECT * FROM system_chat_data WHERE viewed = 0 AND 
           (chat_type != 1 OR (chat_type = 1 AND imuid = :player_uid)) 
           ORDER BY id DESC LIMIT :limit";
    
    try {
        $stmt = $dblj->prepare($sql);
        $stmt->bindValue(':player_uid', $player->uid, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $scene_message_count, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $messages_count = count($messages);
    } catch (PDOException $e) {
        error_log("Chat list query error: " . $e->getMessage());
        return "无法加载聊天信息，请刷新页面或稍后再试。";
    }
    
    $lthtml = '';
    $viewed_ids = []; // 存储需要更新为已查看的消息ID
    
    // 倒序处理消息以保持正确顺序
    for ($i = 0; $i < $messages_count; $i++) {
        $message = $messages[$messages_count - $i - 1];
        $chat_id = intval($message['id']);
        $uname = $message['name'];
        $umsg = $message['msg'];
        $uid = intval($message['uid']);
        $imuid = isset($message['imuid']) ? intval($message['imuid']) : 0;
        $chat_type = intval($message['chat_type']);
        $send_type = intval($message['send_type']);
        $send_time = $message['send_time'];
        $viewed = intval($message['viewed']);
        
        // 跳过用户自己发送的私聊消息 - 保持这个额外检查作为安全措施
        if ($chat_type == 1 && $uid == $player->uid && $imuid != $player->uid) {
            continue;
        }
        
        // 截断过长消息
        if (mb_strlen($umsg, 'utf-8') > $maxChars) {
            $umsg = mb_substr($umsg, 0, $maxChars, 'utf-8') . "...";
        }
        
        // 应用颜色处理(已内置安全处理)
        $umsg = lexical_analysis\color_string($umsg);
        
        // 时间显示处理
        $time_display = $scene_chat_time == 1 ? "<span class='txt-fade'>[" . $send_time . "]</span>" : "<span class='txt-fade'></span>";
        
        // 根据消息类型格式化输出
        $show_message = false;
        
        // 处理公共消息
        if ($uid && $chat_type == 0) {
            if ($long_exist_message == 0 && $player->allchattime >= $send_time) {
                continue; // 跳过不需要显示的旧消息
            }
            
            // 如果是新消息，更新最后聊天时间
            if ($long_exist_message == 0 && $player->allchattime < $send_time) {
                $update_stmt = $dblj->prepare("UPDATE game1 SET allchattime = :nowdate WHERE sid = :sid");
                $update_stmt->execute([':nowdate' => $nowdate, ':sid' => $sid]);
            }
            
            $cmid++;
            $u_cmd = $encode->encode("cmd=" . ($send_type == 0 ? "getoplayerinfo" : "npc_html") . "&ucmd=$cmid&" . ($send_type == 0 ? "uid" : "nid") . "=$uid&sid=$sid");
            $lthtml .= "[<span style='color: orangered;'>公共</span>]<a href='?cmd=" . $u_cmd . "'>{$uname}</a>:{$umsg}{$time_display}<br/>";
            $show_message = true;
        }
        
        // 处理私聊消息
        else if ($imuid == $player->uid && $chat_type == 1 && $viewed == 0) {
            $cmid++;
            
            if ($uid) {
                $o_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$sid");
                $lthtml .= "[私聊]<a href='?cmd=" . $o_cmd . "'>{$uname}</a>对你说:{$umsg}{$time_display}<br/>";
            } else {
                $lthtml .= "[系统]:{$umsg}{$time_display}<br/>";
            }
            
            $viewed_ids[] = $chat_id; // 标记为已查看
            $show_message = true;
        }
        
        // 处理系统消息
        else if ($chat_type == 6) {
            if ($long_exist_message == 0 && $player->allchattime >= $send_time && !$imuid) {
                continue; // 跳过不需要显示的旧系统消息
            }
            
            if ($long_exist_message == 0 && $player->allchattime < $send_time) {
                $update_stmt = $dblj->prepare("UPDATE game1 SET allchattime = :nowdate WHERE sid = :sid");
                $update_stmt->execute([':nowdate' => $nowdate, ':sid' => $sid]);
            }
            
            if (!$uid && $imuid == 0) {
                $lthtml .= "[<span style='color: orangered;'>系统</span>]:{$umsg}{$time_display}<span class='txt-fade'></span><br/>";
                $show_message = true;
            } else if ($uid) {
                $cmid++;
                $u_cmd = $encode->encode("cmd=" . ($send_type == 0 ? "getoplayerinfo" : "npc_html") . "&ucmd=$cmid&" . ($send_type == 0 ? "uid" : "nid") . "=$uid&sid=$sid");
                $lthtml .= "[<span style='color: orangered;'>系统</span>]:<a href='?cmd=" . $u_cmd . "'>{$uname}</a>:{$umsg}{$time_display}<span class='txt-fade'></span><br/>";
                $show_message = true;
            }
        }
    }
    
    // 批量更新已查看状态 - 使用预处理语句防止SQL注入
    if (!empty($viewed_ids)) {
        try {
            // 对于大量ID，使用批量处理更高效
            if (count($viewed_ids) > 20) {
                // 分批处理，每批20个ID
                $batches = array_chunk($viewed_ids, 20);
                foreach ($batches as $batch) {
                    $placeholders = implode(',', array_fill(0, count($batch), '?'));
                    $update_sql = "UPDATE system_chat_data SET viewed = 1 WHERE id IN ($placeholders)";
                    $stmt = $dblj->prepare($update_sql);
                    $stmt->execute($batch);
                }
            } else {
                $placeholders = implode(',', array_fill(0, count($viewed_ids), '?'));
                $update_sql = "UPDATE system_chat_data SET viewed = 1 WHERE id IN ($placeholders)";
                $stmt = $dblj->prepare($update_sql);
                $stmt->execute($viewed_ids);
            }
        } catch (PDOException $e) {
            error_log("Error updating viewed status: " . $e->getMessage());
        }
    }
    
    // 添加聊天输入框
    if ($can_input == 1) {
        $all_post = $encode->encode("cmd=sendliaotian&scene=1&ucmd=$cmid&sid=$sid");
        $lthtml .= <<<HTML
===<br/>
<form action="?cmd={$all_post}" method="post">
<input type="hidden" name="ltlx" value="all">
<input name="ltmsg" maxlength="200" rows="4" cols="20"></input>
<input type="submit" value="发送">
</form>
HTML;
    }
    
    // 去掉末尾的换行
    if ($lthtml) {
        $lthtml = preg_replace('/<br\s*\/?>$/', '', $lthtml);
    }
    
    return $lthtml;
}


function get_exit_list($sid,$dblj,$para,$value,&$cmid){
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


if(!$value){
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
}
else{
if ($upmid->mname!='' && $para ==4){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $lukouhtml .= <<<HTML
<a href="?cmd=$upmidlj">{$value}</a>
HTML;
}

if ($leftmid->mname!='' && $para ==3){
    $leftmid_mname =\lexical_analysis\color_string($leftmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    $lukouhtml .= <<<HTML
<a href="?cmd=$leftmidlj">{$value}</a>
HTML;
}

if ($rightmid->mname!='' && $para ==1){
    $rightmid_mname =\lexical_analysis\color_string($rightmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;    
    $lukouhtml .= <<<HTML
<a href="?cmd=$rightmidlj">{$value}</a>
HTML;
}

if ($downmid->mname!='' && $para ==2){
    $downmid_mname =\lexical_analysis\color_string($downmid->mname);
    $cmid = $cmid + 1;
    $cdid[] = $cmid;    
    $clj[] = $cmd;    
    $lukouhtml .= <<<HTML
<a href="?cmd=$downmidlj">{$value}</a>
HTML;
}
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
    $attr_hp_name = \gm\get_gm_attr_info('1','hp',$dblj)['name'];
    $attr_mp_name = \gm\get_gm_attr_info('1','mp',$dblj)['name'];
    $sql = "SELECT * from game1 where sid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $player_list = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $player_id_root = $player_list['uid'];
    $player_nowmid = $player_list['nowmid'];
    $player_name = $player_list['uname'];
    $player_hp = $player_list['uhp'];
    $player_maxhp = $player_list['umaxhp'];
    $player_mp = $player_list['ump'];
    $player_maxmp = $player_list['umaxmp'];
    $player_text =<<<HTML
[{$player_name}]:<br/>
{$attr_hp_name}：({$player_hp}/{$player_maxhp})<br/>
{$attr_mp_name}：({$player_mp}/{$player_maxmp})
HTML;
    if($cmd =="pve_fighting"){
    $round = \player\getnowround($sid,$dblj);
    $cut_arr = \player\getfighthm($sid, $gid, 0, $round,$dblj,'2','1');
    $cut_hp = $cut_arr['total_cut_hp'];
    $cut_mp = $cut_arr['total_cut_mp'];
    $cut_hp = ($cut_hp === null) ? '' : ((strcasecmp($cut_hp, '0') > 0) ? "+".$cut_hp : $cut_hp);
    $cut_mp = ($cut_mp === null) ? '' : ((strcasecmp($cut_mp, '0') > 0) ? "+".$cut_mp : $cut_mp);
    $cut_hp = (strcasecmp($cut_hp, '0') == 0) ? '' : $cut_hp;
    $cut_mp = (strcasecmp($cut_mp, '0') == 0) ? '' : $cut_mp;
    $player_text =<<<HTML
[{$player_name}]:<br/>
{$attr_hp_name}：({$player_hp}/{$player_maxhp}){$cut_hp}<br/>
{$attr_mp_name}：({$player_mp}/{$player_maxmp}){$cut_mp}
HTML;
    }
    $sql = "SELECT * from system_pet_scene where nsid = :sid and nstate = 1";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->execute();
    $pet_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($pet_row){
    $pet_count = count($pet_row);
    for($i=0;$i<$pet_count;$i++){
    $pet_id = $pet_row[$i]['npid'];
    $pet_name = $pet_row[$i]['nname'];
    $pet_hp = $pet_row[$i]['nhp'];
    $pet_maxhp = $pet_row[$i]['nmaxhp'];
    $pet_mp = $pet_row[$i]['nmp'];
    $pet_maxmp = $pet_row[$i]['nmaxmp'];
    $pcut_arr = \player\getfighthm($sid, $gid, $pet_id, $round,$dblj,'3','4');
    $pcut_hp = $pcut_arr['total_cut_hp'];
    $pcut_mp = $pcut_arr['total_cut_mp'];

    $pcut_hp = ($pcut_hp === null) ? '' : ((strcasecmp($pcut_hp, '0') > 0) ? "+".$pcut_hp : $pcut_hp);
    $pcut_mp = ($pcut_mp === null) ? '' : ((strcasecmp($pcut_mp, '0') > 0) ? "+".$pcut_mp : $pcut_mp);
    $pcut_hp = (strcasecmp($pcut_hp, '0') == 0) ? '' : $pcut_hp;
    $pcut_mp = (strcasecmp($pcut_mp, '0') == 0) ? '' : $pcut_mp;
    
    if(strcasecmp($pet_hp, '0') <= 0){
    $player_text .=<<<HTML
<br/>[{$pet_name}]已经战死！
HTML;
    }else{
    $player_text .=<<<HTML
<br/>[{$pet_name}]：<br/>
{$attr_hp_name}：({$pet_hp}/{$pet_maxhp}){$pcut_hp}<br/>
{$attr_mp_name}：({$pet_mp}/{$pet_maxmp}){$pcut_mp}
HTML;
}
    }
}
    if($player_text){
    $player_text = preg_replace('/<br\s*\/?>$/', '', $player_text); // 去掉结尾的 <br>
    }
    return $player_text;
    
}

function enemy_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid){
    $attr_hp_name = \gm\get_gm_attr_info('1','hp',$dblj)['name'];
    $attr_mp_name = \gm\get_gm_attr_info('1','mp',$dblj)['name'];
    
    $sql = "SELECT * from system_npc_midguaiwu where nsid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $monster_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $enemy_text = '';
    for($i=0;$i<@count($monster_list);$i++){
    $monster_id_root = $monster_list[$i]['nid'];
    $monster_id = $monster_list[$i]['ngid'];
    $monster_nowmid = $monster_list[$i]['nmid'];
    $cut_hp = '';
    $cut_mp = '';
    if($cmd =="pve_fighting"){
    $round = \player\getnowround($sid,$dblj);
    $preround = $round - 1;
    // 构建 SQL 查询语句
    $sql = "SELECT 
        (SELECT now_hp FROM system_fight_state 
         WHERE sid = :sid AND gid = :gid AND type = 3 AND round = :current_round) as current_hp,
        (SELECT now_hp FROM system_fight_state 
         WHERE sid = :sid AND gid = :gid AND type = 3 AND round = :previous_round) as previous_hp,
        (SELECT now_mp FROM system_fight_state 
         WHERE sid = :sid AND gid = :gid AND type = 3 AND round = :current_round) as current_mp,
        (SELECT now_mp FROM system_fight_state 
         WHERE sid = :sid AND gid = :gid AND type = 3 AND round = :previous_round) as previous_mp";
    $stmt = $dblj->prepare($sql);
    $stmt->execute([
        'sid' => $sid,
        'gid' => $monster_id,
        'current_round' => $round,  // e.g., current round
        'previous_round' => $preround  // previous round
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 安全处理大数字的差值计算
    $current_hp = $row['current_hp'] ?? '0';
    $previous_hp = $row['previous_hp'] ?? '0';
    $current_mp = $row['current_mp'] ?? '0';
    $previous_mp = $row['previous_mp'] ?? '0';
    // 使用bc数学函数处理大数值差
    if(function_exists('bcsub')) {
        $hurt_hp = bcsub($current_hp, $previous_hp, 0);
        $hurt_mp = bcsub($current_mp, $previous_mp, 0);
    } else {
        // 兼容性处理，如果没有bc函数
        $hurt_hp = strval($current_hp - $previous_hp);
        $hurt_mp = strval($current_mp - $previous_mp);
    }
    
    if($hurt_hp){
        $cut_hp = (strcasecmp($hurt_hp, '0') > 0) ? "+".$hurt_hp : $hurt_hp;
        $cut_mp = (strcasecmp($hurt_mp, '0') > 0) ? "+".$hurt_mp : $hurt_mp;
        // 如果值为0，就不显示
        $cut_hp = (strcasecmp($cut_hp, '0') == 0) ? '' : $cut_hp;
        $cut_mp = (strcasecmp($cut_mp, '0') == 0) ? '' : $cut_mp;
    }
    }
    $sql = "SELECT * from system_npc_midguaiwu where nsid = :sid and ngid = :ngid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':ngid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $monster_name = $row['nname'];
    $monster_name = \lexical_analysis\process_string($monster_name,$sid,'npc_monster',$monster_id);
    $monster_name = \lexical_analysis\process_photoshow($monster_name);
    $monster_name =\lexical_analysis\color_string($monster_name);
    $monster_hp = $row['nhp'];
    $monster_maxhp = $row['nmaxhp'];
    $monster_mp = $row['nmp'];
    $monster_maxmp = $row['nmaxmp'];
    if(strcasecmp($monster_hp, '0') <= 0){
    $enemy_text .=<<<HTML
[{$monster_name}]已经战死！<br/>
HTML;
    }else{
    $enemy_text .=<<<HTML
[{$monster_name}]:<br/>
{$attr_hp_name}：({$monster_hp}/{$monster_maxhp}){$cut_hp}<br/>
{$attr_mp_name}：({$monster_mp}/{$monster_maxmp}){$cut_mp}<br/>
HTML;
}
}
    if($enemy_text){
    $enemy_text = preg_replace('/<br\s*\/?>$/', '', $enemy_text); // 去掉结尾的 <br>
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
    $round = \player\getnowround($sid,$dblj);
    $sql = "SELECT fight_omsg from game2 where sid = :sid and gid = :gid and pid = 0 and round = :round and type = 2";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id, PDO::PARAM_STR);
    $stmt->bindParam(':round', $round, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $fight_user_omsg = $row['fight_omsg'];
    if($fight_user_omsg){
    $fight_omsg .= $fight_user_omsg."<br/>";
    }
    
    $sql = "SELECT fight_omsg from game2 where sid = :sid and gid = :gid AND pid != 0 and round = :round and type = 3";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->bindParam(':round', $round, PDO::PARAM_INT);
    $stmt->execute();
    $pet_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($j=0;$j<@count($pet_row);$j++){
    $pet_osmg = $pet_row[$j]['fight_omsg'];
    if($pet_osmg){
    $fight_omsg .= $pet_osmg."<br/>";
    }
    }
    
    }
}

    if($fight_omsg){
    $fight_omsg = preg_replace('/<br\s*\/?>$/', '', $fight_omsg); // 去掉结尾的 <br>
    }

    return nl2br($fight_omsg);
    
}

function player_attack_text($cmd,$page_id,$sid,$dblj,$value,$mid,$cmid){
    $sql = "SELECT nid,ngid,nmid from system_npc_midguaiwu where nsid = '$sid'";
    $stmt = $dblj->prepare($sql);
    $stmt->execute();
    $monster_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<@count($monster_list);$i++){
    $monster_id_root = $monster_list[$i]['nid'];
    $monster_id = $monster_list[$i]['ngid'];
    $monster_nowmid = $monster_list[$i]['nmid'];

    if($cmd =="pve_fighting"){
    $round = \player\getnowround($sid,$dblj);
    $sql = "SELECT fight_umsg from game2 where sid = :sid and gid = :gid AND pid = 0 and round = '$round' and type = 1";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['fight_umsg']){
    $fight_umsg .= $row['fight_umsg']."<br/>";
    }
    
    $sql = "SELECT fight_umsg from game2 where sid = :sid and gid = :gid AND pid != 0 and round =  '$round' and type = 4";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->bindParam(':gid', $monster_id,PDO::PARAM_STR);
    $stmt->execute();
    $pet_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($j=0;$j<@count($pet_row);$j++){
    $pet_usmg = $pet_row[$j]['fight_umsg'];
    if($pet_usmg){
    $fight_umsg .= $pet_usmg."<br/>";
    }
    }
    }
}

    if($fight_umsg){
    $fight_umsg = preg_replace('/<br\s*\/?>$/', '', $fight_umsg); // 去掉结尾的 <br>
    }

    return nl2br($fight_umsg);
    
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
    $entrance_mid = \gm\gm_post($dblj)->entrance_id;
    $entrance_last_mid = \player\getmid($entrance_mid,$dblj)->mid;
    $player_nowmid = \player\getplayer($sid,$dblj)->nowmid;
    //这里加入场景id有效判断
    if($entrance_last_mid &&!$player_nowmid){
    \player\changeplayersx('nowmid',$entrance_last_mid,$sid,$dblj);
    $entrance_url = $encode->encode("cmd=gm_scene_new&newmid=$entrance_last_mid&ucmd=$cmid&sid=$sid");
    $entrance_url=<<<HTML
        <a href="?cmd=$entrance_url">{$value}</a>
HTML;
}elseif($entrance_last_mid&&$player_nowmid){
    $entrance_url = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
    $entrance_url=<<<HTML
        <a href="?cmd=$entrance_url">{$value}</a>
HTML;
}else{
    $entrance_url = "未设置入口场景";
}
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


function outgoing_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $map_tp_type = \player\getmid($mid,$dblj)->mtp_type;
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    switch($map_tp_type){
        case '1':
    $road_url = $encode->encode("cmd=road_html&mid=$mid&ucmd=$cmid&sid=$sid");
    $final_url=<<<HTML
        <a href="?cmd=$road_url">出发</a>
HTML;
            break;
        case '2':
    $sail_url = $encode->encode("cmd=sail_html&mid=$mid&ucmd=$cmid&sid=$sid");
    $final_url=<<<HTML
        <a href="?cmd=$sail_url">出航</a>
HTML;
            break;
        case '3':
    $sky_url = $encode->encode("cmd=sky_html&mid=$mid&ucmd=$cmid&sid=$sid");
    $final_url=<<<HTML
        <a href="?cmd=$sky_url">起飞</a>
HTML;
            break;
    }
    return $final_url;
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
        <a href="?cmd=$pick_url">{$rp_action_name}</a>
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

function myclan_url($cmd,$page_id,$sid,$dblj,$value,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    global $encode;
    $myclan_url = $encode->encode("cmd=player_clan&ucmd=$cmid&sid=$sid");
    $myclan_html=<<<HTML
<a href="?cmd=$myclan_url">{$value}</a>
HTML;
    return $myclan_html;
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
$sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$equipbid' and name = 'iname'";
$stmt = $dblj->query($sql_2);
if($stmt->rowCount() >0){
$equipbname = $stmt->fetchColumn();
}else{
    $sql = "select iname from system_item_module where iid = (select iid from system_item where item_true_id = '$equipbid')";
    $cxjg = $dblj->query($sql);
    if ($cxjg ->rowCount()>0) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipbname = $row['iname'];
            }
    }
}
        $equipbname = \lexical_analysis\color_string($equipbname);
        $removeitem = $encode->encode("cmd=equip_op_basic&target_event=remove&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
        $ckequipbinfo = $encode->encode("cmd=equip_html&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
        $equipbhtml = "<a href='?cmd=$ckequipbinfo'>{$equipbname}</a><a href='?cmd=$removeitem'>[卸下]</a>";
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
            $sql_2 = "SELECT value FROM system_addition_attr WHERE oid = 'item' and mid = '$equipfid' and name = 'iname'";
            $stmt = $dblj->query($sql_2);
            if($stmt->rowCount() >0){
            $equipfname = $stmt->fetchColumn();
            }else{
                $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equipfid')";
                $cxjg = $dblj->query($sql);
                if ($cxjg) {
                    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        $equipfname = $row['iname'];
                    }
                }
            }
            }
            $equipfname = \lexical_analysis\color_string($equipfname);
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
兵器：{$equipbhtml}<br/>
$equipfhtml
HTML;
return $bagequiphtml;
}

function pet_inout_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;
    
    $sql = "select nstate,nname from system_pet_scene where nsid = '$sid' and npid = '$mid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $pet_state = $ret['nstate'];
    $pet_name = $ret['nname'];
    if($pet_state ==1){
    $pet_inout_url = $encode->encode("cmd=player_petinfo&pet_id=$mid&fight_canshu=2&ucmd=$cmid&sid=$sid");
    $pet_inout_html=<<<HTML
<a href="?cmd=$pet_inout_url">休息</a>
HTML;
    }else{
    $pet_inout_url = $encode->encode("cmd=player_petinfo&pet_id=$mid&fight_canshu=1&ucmd=$cmid&sid=$sid");
    $pet_inout_html=<<<HTML
<a href="?cmd=$pet_inout_url">出战</a>
HTML;
    }
    return $pet_inout_html;
    
}

function pet_skill_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;
    $pet_skill_url = $encode->encode("cmd=player_petskill&pet_id=$mid&ucmd=$cmid&sid=$sid");
    $pet_skill_html=<<<HTML
<a href="?cmd=$pet_skill_url">{$value}</a>
HTML;
    return $pet_skill_html;
}

function pet_equip_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;
    //$pet_equip_url = $encode->encode("cmd=player_petequip&pet_id=$mid&ucmd=$cmid&sid=$sid");
    $pet_equip_url = $encode->encode("cmd=player_petinfo&pet_id=$mid&ucmd=$cmid&sid=$sid");
    $pet_equip_html=<<<HTML
<a href="?cmd=$pet_equip_url">{$value}</a>
HTML;
    return $pet_equip_html;
}

function pet_item_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;
    //$pet_item_url = $encode->encode("cmd=player_petequip&pet_id=$mid&ucmd=$cmid&sid=$sid");
    $pet_item_url = $encode->encode("cmd=player_petinfo&pet_id=$mid&ucmd=$cmid&sid=$sid");
    $pet_item_html=<<<HTML
<a href="?cmd=$pet_item_url">{$value}</a>
HTML;
    return $pet_item_html;
}

function equip_mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;

    $sql = "SELECT value FROM system_addition_attr WHERE oid = 'item' AND mid = '$mid' AND name = 'iembed_count'";
    $stmt = $dblj->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $iembed_count = $row['value'];
    }else{
        $sql = "select iembed_count from system_item_module where iid = (select iid from system_item where sid = '$sid' and item_true_id = '$mid')";
        $cxjg = $dblj->query($sql);
        $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
        $iembed_count = $ret['iembed_count'];
    }
    $iembed_count = $iembed_count?:0;

    $sql = "select equip_mosaic from player_equip_mosaic where equip_id ='$mid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $equip_mosaics = $ret['equip_mosaic'];
if($equip_mosaics){
    $equip_html .=<<<HTML
已镶嵌物品:<br/>
HTML;
    $equip_mosaic_para = explode('|',$equip_mosaics);
    $equip_mosaic_count = count($equip_mosaic_para);
    for($i=1;$i<$equip_mosaic_count +1;$i++){
        $equip_mosaic_one = $equip_mosaic_para[$i-1];
        $equip_mosaic_name = \player\getitem($equip_mosaic_one,$dblj)->iname;
        $equip_mosaic_name = \lexical_analysis\color_string($equip_mosaic_name);
        $equip_mosaic_diss = $encode->encode("cmd=equip_html&equip_true_id=$mid&diss_mosaic_id=$equip_mosaic_one&ucmd=$cmid&sid=$sid");
    $equip_html .=<<<HTML
{$i}:{$equip_mosaic_name}|<a href="?cmd=$equip_mosaic_diss">卸下</a><br/>
HTML;
    }
    }
if($iembed_count>0 &&$iembed_count > $equip_mosaic_count){
    $equip_mosaic_into = $encode->encode("cmd=equip_html&canshu=into_choose&equip_true_id=$mid&ucmd=$cmid&sid=$sid");
    $equip_html .=<<<HTML
----------<br/>
<a href="?cmd=$equip_mosaic_into">镶嵌物品</a><br/>
HTML;
}


    $equip_html .=<<<HTML
----------<br/>
HTML;
    return $equip_html;
}

function item_mosaic_url($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
    
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //刷新功能实现
    global $encode;

    $sql = "SELECT value FROM system_addition_attr WHERE oid = 'item' AND mid = '$mid' AND name = 'iembed_count'";
    $stmt = $dblj->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $iembed_count = $row['value'];
    }else{
        $sql = "select iembed_count from system_item_module where iid = (select iid from system_item where sid = '$sid' and item_true_id = '$mid')";
        $cxjg = $dblj->query($sql);
        $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
        $iembed_count = $ret['iembed_count'];
    }
    $iembed_count = $iembed_count?:0;
    $sql = "select equip_mosaic from player_equip_mosaic where equip_id ='$mid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    $equip_mosaics = $ret['equip_mosaic'];
if($equip_mosaics){
    $equip_html .=<<<HTML
已镶嵌物品:<br/>
HTML;
    $equip_mosaic_para = explode('|',$equip_mosaics);
    $equip_mosaic_count = count($equip_mosaic_para);
    for($i=1;$i<$equip_mosaic_count +1;$i++){
        $equip_mosaic_one = $equip_mosaic_para[$i-1];
        $equip_mosaic_name = \player\getitem($equip_mosaic_one,$dblj)->iname;
        $equip_mosaic_name = \lexical_analysis\color_string($equip_mosaic_name);
        $equip_mosaic_diss = $encode->encode("cmd=equip_html&page=item&equip_true_id=$mid&diss_mosaic_id=$equip_mosaic_one&ucmd=$cmid&sid=$sid");
    $equip_html .=<<<HTML
{$i}:{$equip_mosaic_name}|<a href="?cmd=$equip_mosaic_diss">卸下</a><br/>
HTML;
    }
    }
if($iembed_count>0 &&$iembed_count > $equip_mosaic_count){
    $equip_mosaic_into = $encode->encode("cmd=equip_html&page=item&canshu=into_choose&equip_true_id=$mid&ucmd=$cmid&sid=$sid");
    $equip_html .=<<<HTML
<a href="?cmd=$equip_mosaic_into">镶嵌物品</a><br/>
HTML;
}
    return $equip_html;
}

function shop_core_list($cmd,$page_id,$sid,$dblj,$value,$mid,&$cmid){
$shop_para = explode('|',$value);
$shop_short_name = $shop_para[0];
$shop_belong_module = 'ct_'.$shop_short_name;
$shop_id = rtrim($shop_para[1]);
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
//刷新功能实现
global $encode;

$sql = "SELECT * FROM system_shop WHERE shop_id = '$shop_id'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);
$shop_buy_input_pos = $ret['buy_input_pos'];
$shop_one_page_count = $ret['one_page_count'];
$shop_one_css = $ret['one_css'];

// 获取商品列表
$sql = "SELECT * FROM system_shop_item WHERE belong = :shop_id";
$stmt = $dblj->prepare($sql);
$stmt->execute(['shop_id' => $shop_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 解析模板并渲染每个商品
$rendered_html = '';

foreach ($items as $item) {
    $item_template = $shop_one_css;
    $item_iid = $item['bind_iid'];
    $item_money_type = $item['sale_money_type'];
    $money_type_para = \player\getmoney_type_all($dblj,$item_money_type);
    $money_count = $item['sale_money'];
    $money_type_name = $money_type_para['rname'];
    $money_type_unit = $money_type_para['runit'];
    $cons_text = $money_type_unit.$money_type_name;
    $item_name = \lexical_analysis\color_string(\player\getitem($item_iid,$dblj)->iname);
    $buy_text = $item_name;
    $item_url = $encode->encode("cmd=check_shop_item&shop_id=$shop_id&item_id=$item_iid&ucmd=$cmid&page_name=$shop_belong_module&sid=$sid");
    $item_name_url ="<a href='?cmd=$item_url'>{$item_name}</a>";
    // 替换商品名称和价格
    $buy_url = $encode->encode("cmd=check_shop_item&buy_canshu=1&shop_id=$shop_id&item_id=$item_iid&ucmd=$cmid&page_name=$shop_short_name&sid=$sid");
    $item_template = str_replace('{item_name_text}', $item_name, $item_template);
    $item_template = str_replace('{item_name_url}', $item_name_url, $item_template);
    $item_template = str_replace('{item_money}', $money_count, $item_template);
    $item_template = str_replace('{item_money_name}', $money_type_name, $item_template);
    $item_template = str_replace('{item_money_unit}', $money_type_unit, $item_template);
    // 替换输入框
    if (strpos($item_template, '{input_pos}') !== false) {
        $input_html = "<form action='?cmd=$buy_url' method='post'>";
        $input_html .= "<input type='number' name='buy_count' min='1' value='1'>";
        $item_template = str_replace('{input_pos}', $input_html, $item_template);
    }
    
    // 替换提交按钮
    if (strpos($item_template, '{submit_pos}') !== false) {
        // $sure_url ='game.php?cmd='. $encode->encode("cmd=check_shop_item&buy_canshu=1&shop_id=$shop_id&item_id=$item_iid&ucmd=$cmid&page_name=$shop_short_name&sid=$sid");

//         $submit_html =<<<HTML
// <a href="#" onclick="return confirmAction('{$sure_url}')">购买</a>
// HTML;

        $submit_html = "<input type='submit' value='购买'>";
        $item_template = str_replace('{submit_pos}', $submit_html, $item_template);
        $item_template .= "</form>";
    }

    $order = array("\r\n", "\n", "\r");
    $replace = "<br/>";
    $item_template=str_replace($order, $replace, $item_template);
    
    $rendered_html .= $item_template;
}

// $rendered_html .=<<<HTML
// <script>
// function confirmAction(sure_url) {
//     if (confirm("你确定要购买吗?")) {
//         window.location.href = sure_url;
//     }
//     return false;
// }
// </script>
// HTML;
    return $rendered_html;
}

?>