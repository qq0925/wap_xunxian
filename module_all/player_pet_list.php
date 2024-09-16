<?php


if($pet_out_id==0){

if($pet_sure_out_id){
    $pchuck = \player\getnpc($pet_nid,$dblj)->nchuck;
    if($pchuck==1){
        echo "你赶走了{$pet_out_name}！<br/>";
        $dblj->exec("delete from system_pet_scene where npid = '$pet_sure_out_id'");
        $dblj->exec("delete from system_skill_user where jpid = '$pet_sure_out_id'");
    }else{
        echo "不可赶走！<br/>";
    }
    
}

if($pet_fight_id){
    echo "你放出了{$pet_name}。<br/>";
    $nowmid = \player\getplayer($sid,$dblj)->nowmid;
    //$dblj->exec("update system_pet_player set pstate = 0 where psid = '$sid'");
    $dblj->exec("update system_pet_scene set nstate = 1,nmid = '$nowmid' where nsid = '$sid' and npid = '$pet_fight_id'");
}
if($pet_rest_id){
    echo "你收回了{$pet_name}。<br/>";
    $dblj->exec("update system_pet_scene set nstate = 0 where nsid = '$sid' and npid = '$pet_rest_id'");
}

$pet_para = \gm\get_pet_list($dblj,$sid);
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$player_now_pet_count=count($pet_para);
$player_callout_max_pet_count= \player\getgameconfig($dblj)->pet_max_count;
$player_max_pet_count = 8;//默认最大收养8个



for($i=1;$i<count($pet_para) + 1;$i++){
    $pet_nid = $pet_para[$i-1]['nid'];
    $pet_npid = $pet_para[$i-1]['npid'];
    $pet_name = $pet_para[$i-1]['nname'];
    $pet_lvl = $pet_para[$i-1]['nlvl'];
    $pet_state = $pet_para[$i-1]['nstate'];
    $pet_detail = $encode->encode("cmd=player_petinfo&pet_id=$pet_npid&ucmd=$cmid&sid=$sid");
    if($pet_state ==1){
    $pet_change = $encode->encode("cmd=player_pet&pet_rest_id=$pet_npid&pet_name=$pet_name&ucmd=$cmid&sid=$sid");
    $pet_state_text = "战";
    $pet_url = "<a href='?cmd=$pet_change'>休息</a>";
    }else{
    $pet_change = $encode->encode("cmd=player_pet&pet_fight_id=$pet_npid&pet_name=$pet_name&ucmd=$cmid&sid=$sid");
    $pet_out = $encode->encode("cmd=player_pet&pet_out_id=$pet_npid&pet_nid=$pet_nid&pet_out_name=$pet_name&ucmd=$cmid&sid=$sid");
    $pet_state_text = "休";
    $pet_url ="<a href='?cmd=$pet_change'>出战</a>|<a href='?cmd=$pet_out'>赶走</a>";
    }
    $pet_detail_html .= <<<HTML
<a href="?cmd=$pet_detail">{$i}.{$pet_name}({$pet_lvl})</a>({$pet_state_text}){$pet_url}<br/>
HTML;
}
if(!$pet_detail_html){
    $pet_detail_html = "你没有收养宠物。<br/>";
}
$pet_html = <<<HTML
【我的宠物】<br/>
================<br/>
$pet_detail_html
----------<br/>
兽栏：{$player_now_pet_count}/{$player_max_pet_count}<br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
}else{
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$sure_url = $encode->encode("cmd=player_pet&pet_out_name=$pet_out_name&pet_nid=$pet_nid&pet_sure_out_id=$pet_out_id&ucmd=$cmid&sid=$sid");
$cancel_url = $encode->encode("cmd=player_pet&ucmd=$cmid&sid=$sid");
$pet_html = <<<HTML
【我的宠物】<br/>
================<br/>
是否赶走{$pet_out_name}?<br/>
<a href="?cmd=$sure_url">确定</a>|<a href="?cmd=$cancel_url">取消</a><br/>
----------<br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
HTML;
}

echo $pet_html;
?>