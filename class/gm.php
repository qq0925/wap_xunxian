<?php
namespace gm;
class gm
{
    var $game_name;
    var $game_desc;
    var $money_measure;
    var $money_name;
    var $game_status;
    var $promotion_exp;
    var $promotion_cond;
    var $mod_promotion_exp;
    var $mod_promotion_cond;
    var $clan_promotion_exp;
    var $clan_promotion_cond;
    var $default_skill;
    var $entrance_id;
    var $entrance_map;
    var $gm_post_canshu;
}
function gm_post($dblj){
   $gm_post = new gm();
   $sql = "select * from gm_game_basic where game_id = '19980925'";
   $game_cx = $dblj->query($sql);
   $game_cx->bindColumn('game_name',$gm_post->game_name);
   $game_cx->bindColumn('game_desc',$gm_post->game_desc);
   $game_cx->bindColumn('money_measure',$gm_post->money_measure);
   $game_cx->bindColumn('money_name',$gm_post->money_name);
   $game_cx->bindColumn('game_status',$gm_post->game_status);
   $game_cx->bindColumn('promotion_exp',$gm_post->promotion_exp);
   $game_cx->bindColumn('promotion_cond',$gm_post->promotion_cond);
   $game_cx->bindColumn('mod_promotion_exp',$gm_post->mod_promotion_exp);
   $game_cx->bindColumn('mod_promotion_cond',$gm_post->mod_promotion_cond);
   $game_cx->bindColumn('clan_promotion_exp',$gm_post->clan_promotion_exp);
   $game_cx->bindColumn('clan_promotion_cond',$gm_post->clan_promotion_cond);
   $game_cx->bindColumn('default_skill',$gm_post->default_skill);
   $game_cx->bindColumn('entrance_id',$gm_post->entrance_id);
   $game_cx->bindColumn('entrance_map',$gm_post->entrance_map);
   $game_cx->bindColumn('gm_post_canshu',$gm_post->gm_post_canshu);
   $game_cx->fetch(\PDO::FETCH_ASSOC);
   return $gm_post;
}
class main_page{
    var $main_id;
    var $main_type;
    var $main_value;
    var $target_event;
    var $target_func;
    var $link_value;
}
function get_main_page($dblj){
    $main_page = new main_page();
    $sql = "select * from game_main_page";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}



class exp_def_page{
    var $exp_id;
    var $exp_type;
    var $exp_value;
}
function get_exp_def($dblj){
    $main_page = new exp_def_page();
    $sql = "select * from system_exp_def";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getqy_all($dblj){
    $sql = "select * from `system_area`";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}
function getmid_detail($dblj,$qy_id){
    $sql = "select * from `system_area` where id = '$qy_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}
function getmap_detail($dblj,$qy_id){
    $sql = "select * from `system_map` where mid = '$qy_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getnowonline_player($dblj){
    $sql = "select uid,sid,uname from `game1` where sfzx =1";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

/*function gm_post_2($dblj){
   $gm_post_2 = new gm();
   $sql = "select * from gm_game_attr";
   $game_cx = $dblj->query($sql);
   $game_cx->bindColumn('game_name',$gm_post_2->game_name);
   $game_cx->bindColumn('game_desc',$gm_post->game_desc);
   $game_cx->bindColumn('money_measure',$gm_post->money_measure);
   $game_cx->bindColumn('money_name',$gm_post->money_name);
   $game_cx->bindColumn('game_status',$gm_post->game_status);
   $game_cx->bindColumn('promotion_exp',$gm_post->promotion_exp);
   $game_cx->bindColumn('promotion_cond',$gm_post->promotion_cond);
   $game_cx->bindColumn('mod_promotion_exp',$gm_post->mod_promotion_exp);
   $game_cx->bindColumn('mod_promotion_cond',$gm_post->mod_promotion_cond);
   $game_cx->bindColumn('clan_promotion_exp',$gm_post->clan_promotion_exp);
   $game_cx->bindColumn('clan_promotion_cond',$gm_post->clan_promotion_cond);
   $game_cx->bindColumn('default_skill',$gm_post->default_skill);
   $game_cx->bindColumn('entrance_id',$gm_post->entrance_id);
   $game_cx->bindColumn('entrance_map',$gm_post->entrance_map);
   $game_cx->bindColumn('gm_post_canshu',$gm_post->gm_post_canshu);
   $game_cx->fetch(\PDO::FETCH_ASSOC);
   return $gm_post;
}*/
?>