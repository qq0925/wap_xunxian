<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';

// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';
include_once 'class/global_event_step_change.php';

$parents_page = $currentFilePath;

$player = \player\getplayer($sid,$dblj);
$pet = \player\getpet_fight($sid,$dblj);
$clmid = player\getmid($player->nowmid,$dblj);
$fight_arr = player\getfightpara($sid,$dblj);


$npid = "";
//此变量用于获取你所战斗的仍然活着的宠物基本属性
$fight_pet_count = @count($pet);
for($i=0;$i<$fight_pet_count;$i++){
    $fight_pid = $pet[$i]['pid'];
    $npid .=$fight_pid.",";
}
$npid = rtrim($npid,',');

$ngid = "";
//此变量用于获取你所战斗的仍然活着的怪物基本属性
$fight_arr_count = @count($fight_arr);
for($i=0;$i<$fight_arr_count;$i++){
    $fight_gid = $fight_arr[$i]['ngid'];
    $ngid .=$fight_gid.",";
}
$ngid = rtrim($ngid,',');
$scene_npc = explode(',',$clmid ->mnpc_now);
$huode = '';
$rwts = '';
$game_main = '';
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$goplayer_state = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");
$goplayer_item = $encode->encode("cmd=item_html&ucmd=$cmid&sid=$sid");
$get_main_page = \gm\get_pve_page($dblj);
$br = 0;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;

// while(@count(explode(',',$ngid)>0)){
// $alive_monster = player\getnpcguaiwu($ngid,$dblj);
// if (!empty($alive_monster->nsid)&&$alive_monster->nsid !=$sid){
//         $html = <<<HTML
//         对方已经被其他人攻击了！<br/>
//         <br/>
//         <a href="?cmd=$gonowmid">返回游戏</a>
// HTML;
//         exit($html);
// }
// }

if($cmd=='pve_fight'){
    if ($player->uhp <=0){
        $zdjg = -1;
    }
}elseif ($cmd == 'pve_fighting'){
    //技能攻击
    if($qtype ==1){
    $parents_cmd = 'gm_scene_new';
    $cmid = $cmid + 1;
    $cdid[] = $cmid;
    $clj[] = $cmd;
    //global_events_steps_change(5,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new',null,null,$para);
    
    $busy = \player\get_temp_attr($sid,'busy',1,$dblj);
    if($busy >0){
    $dblj->exec("update game2 set hurt_hp = '' where sid = '$sid'");
    \player\update_temp_attr($sid,'busy',1,$dblj,2,-1);
    echo "你不能动弹！预计还要{$busy}回合！<br/>";
    }else{
    \lexical_analysis\hurt_calc($qtype_id,$sid,$ngid,1,$dblj);//你对怪的伤害
    
    //这种加技能熟练度的方式是和出招次数挂钩而不是怪物数量。
    $sql = "select jadd_point_exp from system_skill where jid = '$qtype_id'";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $add_point = $ret['jadd_point_exp'];
    }else{
    $add_point = 1;
    }
    $sql = "select jpromotion,jname,jpromotion_cond from system_skill where jid = '$qtype_id'";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $jpromotion = $ret['jpromotion'];
    $jname = $ret['jname'];
    $jpromotion_cond = $ret['jpromotion_cond'];
    $jpromotion = ceil(\lexical_analysis\process_string($jpromotion,$sid,'skill',$qtype_id,$qtype_id));
    $jpromotion_cond = \lexical_analysis\process_string($jpromotion_cond,$sid,'skill',$qtype_id,$qtype_id);
    $jpromotion_cond = @eval("return $jpromotion_cond;");
    }else{
    $jpromotion = 1;
    }
    if($jpromotion_cond){
    $sql = "update system_skill_user set jpoint = jpoint + '$add_point' where jsid = '$sid' and jid = '$qtype_id'";
    $dblj->exec($sql);
    $sql = "select jpoint,jlvl from system_skill_user where jid = '$qtype_id' and jsid = '$sid'";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $jnowpoint = $ret['jpoint'];
    $jnowlvl = $ret['jlvl'];
    if($jnowpoint >=$jpromotion){
        $jnowlvl +=1;
        echo "你的技能[{$jname}]升级啦！当前为{$jnowlvl}级<br/>";
        $diff = $jnowpoint - $jpromotion;
        $sql = "update system_skill_user set jpoint = jpoint - '$diff',jlvl = jlvl + 1 where jsid = '$sid' and jid = '$qtype_id'";
        $cxjg = $dblj->exec($sql);
    }
    }
    }
}

    //宠物伤害逻辑
    
    if($npid){
    \lexical_analysis\hurt_calc(null,$sid,$ngid,3,$dblj,$npid);//宠对怪的伤害
    }

    \lexical_analysis\hurt_calc(null,$sid,$ngid,2,$dblj);//怪对你的伤害
    }elseif($qtype ==2){
    $busy = \player\get_temp_attr($sid,'busy',1,$dblj);
    if($busy >0){
    $dblj->exec("update game2 set hurt_hp = '' where sid = '$sid'");
    $busy = \player\update_temp_attr($sid,'busy',1,$dblj,2,-1);
    echo "你不能动弹！预计还要{$busy}回合！<br/>";
    }else{
    $sql = "select iuse_value,iuse_attr,iname,iweight from system_item_module where iid = '$qtype_id'";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    $use_item_name = $ret['iname'];
    $use_item_iweight = $ret['iweight'];
    $use_item_name = \lexical_analysis\color_string($use_item_name);
    echo "使用了{$use_item_name}<br/>";
    $use_cmmt = \player\useitem($sid,$qtype_id,1,$dblj);
    $player = \player\getplayer($sid,$dblj);
    //这里要更新game3中的伤害值
    $use_cmmt = \lexical_analysis\color_string($use_cmmt);
    echo $use_cmmt;
    $item_true_id = \player\getplayeritem_attr('item_true_id',$sid,$qtype_id,$dblj)['item_true_id'];
    \player\changeplayeritem($item_true_id,-1,$sid,$dblj);
    \player\addplayersx('uburthen',-$use_item_iweight,$sid,$dblj);
    $sql = "SELECT * from system_item where iid = :qtype_id and sid = :sid";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':qtype_id', $qtype_id,PDO::PARAM_STR);
    $stmt->bindParam(':sid', $sid,PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $quick_count = $row['icount'];
    if($quick_count <=0||!$quick_count){
    echo "你的{$use_item_name}已耗尽！<br/>";
    }
    }
    }
    
    //宠物伤害逻辑
    if($npid){
    \lexical_analysis\hurt_calc(null,$sid,$ngid,3,$dblj,$npid);//宠对怪的伤害
    }
    \lexical_analysis\hurt_calc(null,$sid,$ngid,2,$dblj);//怪对你的伤害
    }
    
    //以下获取的怪物id均是活着的怪物id
    $monster_ids = explode(',',$ngid);
    $monster_count = count($monster_ids);
    
    //此处任务逻辑可能导致程序卡死
    for($i=0;$i<$monster_count;$i++){
    $monster_id = $monster_ids[$i];
    $alive_monster = player\getnpcguaiwu_attr($monster_id,$dblj);
    
    if ($alive_monster->nhp<=0){//怪物死亡
        $alive_id = $alive_monster->nid;
        $defeat_id = $alive_monster->ndefeat_event_id;
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $ret = global_event_data_get(7,$dblj);
        if($ret){
        global_events_steps_change(7,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_id,$para);
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $ret = global_event_data_get(31,$dblj);
        if($ret){
        global_events_steps_change(31,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_id,$para);
        }
        if($defeat_id!=0){
        include_once 'class/events_steps_change.php';
        events_steps_change($defeat_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_id,$para);
        }
        // $sql = "delete from system_npc_midguaiwu where ngid = '{$monster_id}' AND nsid='$sid'";
        // $dblj->exec($sql);
        // $sql = "delete from game2 where gid = '{$monster_id}' AND sid='$sid'";
        //$dblj->exec($sql);
        
        $drop_exp = $alive_monster->ndrop_exp;//掉落相关
        $drop_money = $alive_monster->ndrop_money;
        $drop_items = $alive_monster->ndrop_item;
        if($drop_exp){
        $drop_exp = \lexical_analysis\process_string($drop_exp,$sid);
        }
        if($drop_money){
        $drop_money = \lexical_analysis\process_string($drop_money,$sid);
        }
        if($drop_items){
        
        $drop_item = explode(',',$drop_items);
        $drop_item_count = count($drop_item);
        for($j=0;$j<$drop_item_count;$j++){
            $drop_para = explode('|',$drop_item[$j]);
            $drop_id = $drop_para[0];
            $drop_item_name = \player\getitem($drop_id,$dblj)->iname;
            $drop_item_name = \lexical_analysis\color_string($drop_item_name);
            $drop_count = $drop_para[1];
            $drop_count = \lexical_analysis\process_string($drop_count,$sid);
            $drop_count = @eval("return $drop_count;");
            $drop_weight = \player\getitem($drop_id,$dblj)->iweight;
            $drop_total_weight = $drop_count * $drop_weight;
            $player = \player\getplayer($sid,$dblj);
            $player_last_burthen = $player->umax_burthen - $player->uburthen;
            if($drop_count >0 && $player_last_burthen >=$drop_total_weight && $player_last_burthen>0){
                $get_ret = \player\additem($sid,$drop_id,$drop_count,$dblj);
                if($get_ret!=-2){
                    \player\changeitem_belong($get_ret,1, $alive_monster->nid,$dblj);//更新物品掉落来源
                }
                $huode .= "得到：{$drop_item_name}x{$drop_count} <br/>";
                
                $rwts_item = \player\update_task($sid,$dblj,$drop_id,null,null);
                $rwts .= $rwts_item;
            }elseif($drop_count <0){
                $item_true_id = \player\getplayeritem_attr('item_true_id',$sid,$drop_id,$dblj)['item_true_id'];
                \player\changeplayeritem($item_true_id,$drop_count,$sid,$dblj);
                \player\addplayersx('uburthen',-$drop_total_weight,$sid,$dblj);
                $drop_count = abs($drop_count);
                $huode .= "失去：{$drop_item_name}x{$drop_count} <br/>";
            }
        }
        }
        if($drop_exp!=""){
            $drop_exp = @eval("return $drop_exp;");
            \player\addplayersx('uexp',$drop_exp,$sid,$dblj);
            $drop_exp = $drop_exp>=0?"+".$drop_exp:$drop_exp;
            $huode .= "经验{$drop_exp} <br/>";
        }
        if($drop_money!=""){
            $drop_money = @eval("return $drop_money;");
            \player\addplayersx('umoney',$drop_money,$sid,$dblj);
            $drop_money = $drop_money>=0?"+".$drop_money:$drop_money;
            $huode .= "信用币{$drop_money}枚 <br/>";
        }

        $rwts_kill = \player\update_task($sid,$dblj,null,$alive_monster->nid,$alive_monster->nname);
        $rwts .= $rwts_kill;

    }
}
}

$fight_arr = player\getfightpara($sid,$dblj);
if(empty($fight_arr)){
$zdjg = 1;
}

$player =  player\getplayer($sid,$dblj);
if ($player->uhp <= 0){
    $zdjg = 0;
}




if (isset($zdjg) &&empty($fight_arr) ||$player->uhp<=0){
    $dblj->exec("DELETE from player_temp_attr where obj_id = '$sid' and attr_name = 'busy'");
    switch ($zdjg){
        case 1:
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            $sql = "delete from system_npc_midguaiwu where nsid='$sid'";
            $dblj->exec($sql);
            $parents_cmd = 'gm_scene_new';
            $player = \player\getplayer($sid,$dblj);
            if($player->uhp<=0){
            \player\changeplayersx('uhp',1,$sid,$dblj);
            $player = \player\getplayer($sid,$dblj);
            }
            \player\changeplayersx('ucmd','',$sid,$dblj);
            $fight_html = <<<HTML
            战斗胜利！<br/>
            你打死了{$alive_monster->nname}<br/>
            你生命：({$player->uhp}/{$player->umaxhp})<br/>
            $pets
            $huode
            $rwts
            =========<br/>
            <a href="?cmd=$goplayer_state">状态</a> <a href="?cmd=$goplayer_item">物品</a><br/>
            <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            break;
        case 0:
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            $sql = "delete from system_npc_midguaiwu where nsid='$sid'";
            $dblj->exec($sql);
            \player\changeplayersx('uhp',0,$sid,$dblj);
            $player = \player\getplayer($sid,$dblj);
            $parents_cmd = 'gm_scene_new';
            $ret = global_event_data_get(8,$dblj);
            if($ret){
            global_events_steps_change(8,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_monster->nid,$para);
            }
            \player\changeplayersx('ucmd','',$sid,$dblj);
            $ret = global_event_data_get(30,$dblj);
            if($ret){
            global_events_steps_change(30,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_monster->nid,$para);
            }
            if($alive_monster->nwin_event_id!=0){
            include_once 'class/events_steps_change.php';
            events_steps_change($alive_monster->nwin_event_id,$sid,$dblj,$just_page,$steps_page,$cmid,'module/gm_scene_new','npc',$alive_monster->nid,$para);
            }
            
            //战败事件
            $fight_html = <<<HTML
            战斗失败！<br/>
            你被{$alive_monster->nname} 狠狠地教训了一顿!<br/>
            你生命：({$player->uhp}/{$player->umaxhp})<br/>
            =========<br/>
            <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            \player\changeplayersx('uhp',1,$sid,$dblj);
            $player = \player\getplayer($sid,$dblj);
            break;
        case -1:
            \player\changeplayersx('uis_pve',0,$sid,$dblj);
            \player\changeplayersx('ucmd','',$sid,$dblj);
            $fight_html = <<<HTML
            你已经重伤，无法再次进行战斗！<br/>
            你生命：({$player->uhp}/{$player->umaxhp})<br/>
            请恢复之后重来<br/>
            =========<br/>
            <a href="?cmd=$gonowmid">返回游戏</a>
HTML;
            break;
    }
}

for ($i=0;$i<count($get_main_page);$i++){
    $oid = 'npc';
    $main_id = $get_main_page[$i]['id'];
    $main_type = $get_main_page[$i]['type'];
    $main_value = $get_main_page[$i]['value'];
    $main_show_cond = $get_main_page[$i]['show_cond'];
    if($main_show_cond!=''){
    $show_ret = \lexical_analysis\process_string($main_show_cond,$sid);
    }else{
    $show_ret = 1;
    }
    $show_ret = strip_tags($show_ret);
    @$ret = eval("return $show_ret;");
    if($ngid){
    $mid = $ngid;
    }
    $ret_bool = $ret ? '0' : '1';
    if(is_null($ret)){
        $ret_bool = 0;
    }
    if($ret_bool ==0){
    $main_value = nl2br($main_value);
    $main_target_event = $get_main_page[$i]['target_event'];
    $main_target_func = $get_main_page[$i]['target_func'];
    $main_link_value = $get_main_page[$i]['link_value'];
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_string($main_value,$sid,$oid,$mid);
    $main_value = \lexical_analysis\process_photoshow($main_value);
    $main_value =\lexical_analysis\color_string($main_value);
    }
    if($main_target_event !=0){
        $main_target_event = $encode->encode("cmd=main_target_event&ucmd=$cmid&target_event=$main_target_event&parents_cmd=$cmd&parents_page=$parents_page&last_page_id=$main_id&sid=$sid");
    }elseif ($main_target_event ==0) {
        $main_target_event = $encode->encode("cmd=event_no_define&ucmd=$cmid&parents_cmd=$cmd&parents_page=$parents_page&sid=$sid");
    }
    if($main_target_func !=0){
        $main_target_func = basic_func_choose($cmd,$main_target_func,$sid,$dblj,$main_value,$mid,10,$cmid);
        if(!filter_var($main_target_func, FILTER_VALIDATE_URL,FILTER_FLAG_QUERY_REQUIRED)){
        $main_target_func = \lexical_analysis\color_string($main_target_func);
        }
    }elseif ($main_target_func ==0) {
        $main_target_func = $encode->encode("cmd=func_no_define&ucmd=$cmid&parents_page=$parents_cmd=$cmd&parents_page&sid=$sid");
    }
    try{
        $matches = array();
                $pattern = '/\[([^\[\]]*)\]/';
                $main_value = preg_replace_callback($pattern, function($matches) {
                    $content = $matches[1]; // 获取方括号中的内容
                    // 进行处理，例如将内容转换为大写
                    $processedContent = @eval("return $content;");
                    return '[' . $processedContent . ']'; // 将处理后的内容放回原字符串中
                    }, $main_value);
            }
            catch (ParseError $e){
                print("语法错误: ". $e->getMessage());
                
            }
            catch (Error $e){
                print("执行错误: ". $e->getMessage());
}
    switch ($main_type) {
        case '1':
            if($ret_bool ==0){
                $game_main .=<<<HTML
$main_value
HTML;
}
            break;
        case '2':
            if($ret_bool ==0){
                $game_main .=<<<HTML
<a href="?cmd=$main_target_event" >$main_value</a>
HTML;
}
            break;
        case '3':
            if($ret_bool ==0){
                $game_main .=<<<HTML
$main_target_func
HTML;
}
            break;
        case '4':
            if($ret_bool ==0){
                $game_main .=<<<HTML
<a href="$main_link_value" >$main_value</a>
HTML;
}
            break;
    }
}

if(!isset($zdjg) &&!empty($fight_arr)){
    $guaiwu_npc = player\getguaiwu_all($sid,$dblj);
    for($i=1;$i<@count($guaiwu_npc) +1;$i++){
        $guai_hp = $guaiwu_npc[$i-1]['nhp'];
        $guai_gid = $guaiwu_npc[$i-1]['ngid'];
        if ($guai_hp){
        $sql = "update game2 set fight_umsg = '',fight_omsg = '' where gid = '{$guai_gid}' AND sid='$sid'";
        $dblj->exec($sql);
        }
    }
if($player->uauto_fight ==1 &&$look_canshu !=1){
    $sql = "select * from system_skill_user WHERE jsid = '$sid' and jdefault = 1";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
        $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    }
    $default_id = $ret['jid'];
    $default_id = $default_id ==0?1:$default_id;
    $quick_to = $encode->encode("cmd=pve_fighting&ucmd=$cmid&qtype=1&qtype_id=$default_id&sid=$sid");
    $quick_url = "?cmd=$quick_to"; // 构建完整的 URL
$refresh_html =<<<HTML
<meta http-equiv="refresh" content="2;URL=$quick_url">
HTML;
echo $refresh_html;
    //header("refresh:2;url={$quick_url}");//这里的2是默认间隔
}
$all = <<<HTML
<head>
    <meta charset="utf-8" content="width=device-width,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/gamecss.css">
</head>
$huode<br/>
==【{$clmid->mname}】==<br/>
$game_main<br/>
HTML;
}elseif(empty($fight_arr) ||$player->uhp <=0||$zdjg ==0){
    $all = $fight_html;
}

if($look_canshu==1){
$goback_fight = $encode->encode("cmd=pve_fight&ucmd=$cmid&sid=$sid");
$fight_arr = player\getfightpara($sid,$dblj);
$all = "";
for($i=1;$i<@count($fight_arr) +1;$i++){
    $guai_name = $fight_arr[$i-1]['nname'];
    $guai_lvl = $fight_arr[$i-1]['nlvl'];
    $guai_hp = $fight_arr[$i-1]['nhp'];
    $guai_desc = $fight_arr[$i-1]['ndesc'];
    $all .= <<<HTML
[$i]名称：{$guai_name}<br/>
等级：{$guai_lvl}<br/>
生命：{$guai_hp}<br/>
简介：{$guai_desc}<br/>
HTML;
}
$all .="<a href='?cmd=$goback_fight'>返回战斗</a>";
}

echo $all;
?>