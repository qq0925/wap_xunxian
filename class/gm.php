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
    var $default_storage;
    var $entrance_id;
    var $entrance_map;
    var $gm_post_canshu;
}

class guaiwu
{
    var $gname;//昵称
    var $gdesc;
    var $gsex;
    var $gid;
    var $sid;
    var $ghp;//生命
    var $gmaxhp;
    var $gattack;//攻击
    var $grecovery;//防御
    var $gyuanid;
}

function calculateDistance($point1, $point2) {
    // 星球的平均半径（单位：海里）
    $R = 3440.0;

    $coordinates1 = explode(',', $point1);
    $coordinates2 = explode(',', $point2);

    $x1 = floatval($coordinates1[0]);
    $y1 = floatval($coordinates1[1]);
    $z1 = floatval($coordinates1[2]);

    $x2 = floatval($coordinates2[0]);
    $y2 = floatval($coordinates2[1]);
    $z2 = floatval($coordinates2[2]);

    // 将经度和纬度从度数转换为弧度
    $x1 = deg2rad($x1);
    $y1 = deg2rad($y1);
    $x2 = deg2rad($x2);
    $y2 = deg2rad($y2);

    // 使用大圆距离公式计算距离
    $dlon = $y2 - $y1;
    $dlat = $x2 - $x1;
    $a = pow(sin($dlat/2), 2) + cos($x1) * cos($x2) * pow(sin($dlon/2), 2);
    // $a = sin($dlat/2) ** 2 + cos($x1) * cos($x2) * sin($dlon/2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $R * $c;
    // 考虑高度差
    $distance = sqrt($distance ** 2 + ($z2 - $z1) ** 2);
    return ceil($distance);
}

function getdesigner($sid,$dblj){
    $sql = "select * from system_designer_assist where sid = '$sid'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret;
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
   $game_cx->bindColumn('default_storage',$gm_post->default_storage);
   $game_cx->bindColumn('promotion_exp',$gm_post->promotion_exp);
   $game_cx->bindColumn('promotion_cond',$gm_post->promotion_cond);
   $game_cx->bindColumn('mod_promotion_exp',$gm_post->mod_promotion_exp);
   $game_cx->bindColumn('mod_promotion_cond',$gm_post->mod_promotion_cond);
   $game_cx->bindColumn('clan_promotion_exp',$gm_post->clan_promotion_exp);
   $game_cx->bindColumn('clan_promotion_cond',$gm_post->clan_promotion_cond);
   $game_cx->bindColumn('entrance_id',$gm_post->entrance_id);
   $game_cx->bindColumn('gm_post_canshu',$gm_post->gm_post_canshu);
   $game_cx->bindColumn('game_forum_gm_id',$gm_post->game_forum_gm_id);
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
    var $main_position;
}
function get_main_page($dblj){
    //$main_page = new main_page();
    $sql = "SELECT * FROM game_main_page ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_self_page_list($dblj,$module_id=null){
    if($module_id !=null){
    $sql = "SELECT * FROM system_self_define_module where id = '$module_id' ORDER BY pos ASC;";
    }else{
    $sql = "SELECT * FROM system_self_define_module ORDER BY pos ASC;";
    }
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_self_page($dblj,$module_id){
    $module_id = "game_self_page_".$module_id;
    $sql = "SELECT * FROM `$module_id` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_func_page($dblj, $gm_post_canshu) {
    $sql = "SELECT * FROM system_function WHERE FIND_IN_SET(:gm_post_canshu, belong) ORDER BY id ASC";
    $stmt = $dblj->prepare($sql);
    $stmt->bindParam(':gm_post_canshu', $gm_post_canshu, \PDO::PARAM_STR);
    $stmt->execute();
    $ret = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_self_event($dblj,$belong,$module_id,$para=null){
    $sql = "SELECT id from system_event_self where belong = '$belong' and module_id = '$module_id'";
    $stmt = $dblj->query($sql);
    $ret = $stmt->fetch(\PDO::FETCH_ASSOC);
    $event_id = $ret['id'];
    return $event_id;
}


function get_scene_page($dblj){
    //$main_page = new main_page();
    $sql = "SELECT * FROM game_scene_page ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_npc_page($dblj){
    //$main_page = new main_page();
    $sql = "SELECT * FROM game_npc_page ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_pve_page($dblj){
    //$main_page = new main_page();
    $sql = "SELECT * FROM game_pve_page ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_item_page($dblj){
    //$main_page = new main_page();
    $sql = "SELECT * FROM game_item_page ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_player_page($dblj){
    $sql = "select * from `game_player_page` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_oplayer_page($dblj){
    $sql = "select * from `game_oplayer_page` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_function_page($dblj){
    $sql = "select * from `game_function_page` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_pet_page($dblj){
    $sql = "select * from `game_pet_page` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_equip_page($dblj){
    $sql = "select * from `game_equip_page` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_skill_page($dblj){
    $sql = "select * from `game_skill_page` ORDER BY position ASC;";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

class exp_def_page{
    var $exp_id;
    var $exp_type;
    var $exp_value;
}

function get_task_list($dblj,$gm_post_canshu){
    $sql = "select * from system_task where ttype ='$gm_post_canshu'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_item_list($dblj,$gm_post_canshu,$offset=null,$list_row=null,$sub_canshu=null){
    if($list_row){
        if($sub_canshu&&$sub_canshu!="all"){
    $sql = "select * from system_item_module where itype ='$gm_post_canshu' and isubtype = '$sub_canshu' LIMIT $offset, $list_row";
    }else{
    $sql = "select * from system_item_module where itype ='$gm_post_canshu' LIMIT $offset, $list_row";
        }
    }else{
    $sql = "select * from system_item_module where itype ='$gm_post_canshu'";
    if($sub_canshu&&$sub_canshu!="all"){
        $sql .=" AND isubtype = '$sub_canshu'";;
    }
    }
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_item_detail($dblj,$item_id){
    $sql = "select * from system_item_module where iid ='$item_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_npc_list($dblj,$gm_post_canshu,$offset=null,$list_row=null){
    if($list_row){
    $sql = "select * from system_npc where narea_id ='$gm_post_canshu' LIMIT $offset, $list_row";
    }else{
    $sql = "select * from system_npc where narea_id ='$gm_post_canshu'";
    }
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function get_npc_detail($dblj,$npc_id){
    $sql = "select * from system_npc where nid ='$npc_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);    
    return $ret;
}

function get_pet_list($dblj,$sid){
    $sql = "select * from system_pet_player where psid = '$sid' ORDER BY pstate DESC";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}


function get_map_out($dblj,$map_id){
    $sql = "select * from system_map where mid ='$map_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);    
    return $ret;
}

function get_exp_def($dblj){
    $main_page = new exp_def_page();
    $sql = "select * from system_exp_def ORDER BY pos ASC";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getqy_all($dblj){
    $sql = "select * from `system_area` ORDER BY pos ASC";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getqy($dblj,$qy_id){
    $sql = "select * from `system_area` where id = '$qy_id'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $ret;
}

function getmid_detail($dblj,$qy_id,$offset=null,$list_row=null){
    if($list_row){
    $sql = "select * from `system_map` where marea_id = '$qy_id' LIMIT $offset,$list_row";
    }else{
    $sql = "select * from `system_map` where marea_id = '$qy_id'";
    }
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

function getphoto_type($dblj){
    $sql = "select * from `system_photo_type`";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getphoto_detail($dblj,$photo_type){
    $sql = "select * from `system_photo` where type = '$photo_type'";
    $cxjg = $dblj->query($sql);
    $ret = $cxjg->fetchAll(\PDO::FETCH_ASSOC);
    return $ret;
}

function getguaiwu($nid,$dblj){//获取怪物
    $guaiwu = new guaiwu();

    $sql = "select * from system_npc_midguaiwu where gid = '$nid'";
    $cxjg = $dblj->query($sql);

    $cxjg->bindColumn('gname',$guaiwu->gname);
    $cxjg->bindColumn('id',$guaiwu->gid);
    $cxjg->bindColumn('gsid',$guaiwu->sid);
    $cxjg->bindColumn('ghp',$guaiwu->ghp);
    $cxjg->bindColumn('gmaxhp',$guaiwu->gmaxhp);
    $cxjg->bindColumn('gattack',$guaiwu->gattack);
    $cxjg->bindColumn('grecovery',$guaiwu->grecovery);
    $cxjg->bindColumn('gid',$guaiwu->gyuanid);
    $cxjg->fetch(\PDO::FETCH_ASSOC);
    return $guaiwu;
}

function getyuanguaiwu($gyuanid,$dblj){//获取怪物库怪物
    $guaiwu = new guaiwu();
    $sql = "select * from system_npc where nid='$gyuanid' and nkill = '1'";
    $cxjg = $dblj->query($sql);
    if ($cxjg){
        $cxjg->bindColumn('nname',$guaiwu->gname);
        $cxjg->bindColumn('ndesc',$guaiwu->gdesc);
        $cxjg->bindColumn('nsex',$guaiwu->gsex);
        $cxjg->bindColumn('nhp',$guaiwu->ghp);
        $cxjg->bindColumn('nmaxhp',$guaiwu->gmaxhp);
        $cxjg->bindColumn('nattack',$guaiwu->gattack);
        $cxjg->bindColumn('nrecovery',$guaiwu->grecovery);
        $cxjg->fetch(\PDO::FETCH_ASSOC);
    }
    return $guaiwu;
}


function get_mysqldata($dblj, $data_type, $data_id){
    switch ($data_type) {
        case 'events':
            // 处理一切事件
            $query = "SELECT id, cond, cmmt, link_evs FROM system_event WHERE id = '$data_id' LIMIT 1";
            $stmt = $dblj->query($query);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (empty($row['link_evs'])) {
                // link_evs 为空，生成不包含 evs 字段的数据
                $data = [
                    '#data_events_Mapping#' => [
                        'id' => $row['id'],
                        'cond' => $row['cond'],
                        'cmmt' => $row['cmmt']
                    ]
                ];
            } else {
                // link_evs 不为空，处理 evs 字段的数据
                $evsIds = explode(',', $row['link_evs']);
                $evs = [];
                foreach ($evsIds as $evsId) {
        // 查询 system_event_evs 表获取数据
        $evsQuery = "SELECT * FROM system_event_evs WHERE id = '$evsId' LIMIT 1";
        $evsStmt = $dblj->query($evsQuery);
        $evsRow = $evsStmt->fetch(\PDO::FETCH_ASSOC);
        
        while ($evsRow) {
            // 处理 s_attrs 字段
            $s_attrs = $evsRow['s_attrs'];
            $m_attrs = $evsRow['m_attrs'];
            $a_skills = $evsRow['a_skills'];
            $r_skills = $evsRow['r_skills'];
            $items = $evsRow['items'];
            $not_return_link = $evsRow['not_return_link'];
            $just_return = $evsRow['just_return'];
            $not_return_link = ($not_return_link == 0) ? "F" : "T";
            $just_return = ($just_return == 1) ? "F" : "T";
            if(!empty($s_attrs)){
            $pairs = explode(',', $s_attrs);
            $s_attrs_2 = [];
        
            foreach ($pairs as $pair) {
                // 分割键和值
                $equal_pos = strpos($pair, '=');
                if ($equal_pos !== false) {
                    // 提取键和值
                    $key = trim(substr($pair, 0, $equal_pos));
                    $value = trim(substr($pair, $equal_pos + 1));
                    // 添加到新的关联数组中
                    $s_attrs_2[$key] = $value;
    }
            }
            }
            // 构建每个 evs 数组元素
            if(!empty($m_attrs)){
            $pairs = explode(',', $m_attrs);
            $m_attrs_2 = [];
        
            foreach ($pairs as $pair) {
                // 分割键和值
                $equal_pos = strpos($pair, '=');
                if ($equal_pos !== false) {
                    // 提取键和值
                    $key = trim(substr($pair, 0, $equal_pos));
                    $value = trim(substr($pair, $equal_pos + 1));
                    // 添加到新的关联数组中
                    $m_attrs_2[$key] = $value;
    }
            }
            }
            
            if(!empty($a_skills)){
                $pairs = explode(',', $a_skills);
                $a_skills_2 = [];
            
                foreach ($pairs as $pair) {
                    $key = trim($pair);
                    $a_skills_2[] = "j".$key;
                }
            }
            
            if(!empty($r_skills)){
                $pairs = explode(',', $r_skills);
                $r_skills_2 = [];
            
                foreach ($pairs as $pair) {
                    $key = trim($pair);
                    $r_skills_2[] = "j".$key;
                }
            }
            
            if(!empty($items)){
            $pairs = explode(',', $items);
            $items_2 = [];
        
            foreach ($pairs as $pair) {
                // 分割键和值
                $equal_pos = strpos($pair, '|');
                if ($equal_pos !== false) {
                    // 提取键和值
                    $key = trim(substr($pair, 0, $equal_pos));
                    $value = trim(substr($pair, $equal_pos + 1));
                    // 添加到新的关联数组中
                    $items_2["i".$key] = $value;
    }
            }
            }
            
            // 检查 s_attrs 字段是否为 null，如果不为 null 则添加到最终的数据数组中
            if(empty($s_attrs_2) && empty($m_attrs_2) && empty($a_skills_2) && empty($r_skills_2)){
            $evs[] = [
                '#data_events_Mapping#' => [
                    'id' => $evsRow['id'],
                    'cond' => $evsRow['cond'],
                    'cmmt' => $evsRow['cmmt'],
                    'cmmt2' => $evsRow['cmmt2'],
                    'not_return_link' => $not_return_link,
                    'just_return_link' => $just_return,
                    'exec_cond' => $evsRow['exec_cond'],
                    "view_user_exp" => $evsRow['view_user_exp'],
                    "page_name" => $evsRow['page_name']
                ]
            ];
            }else{
            $evs[] = [
            '#data_events_Mapping#' => [
            'id' => $evsRow['id'],
            's_attrs' => $s_attrs_2,
            'm_attrs' => $m_attrs_2,
            'a_skills' => $a_skills_2,
            'r_skills' => $r_skills_2,
            'items' => $items_2,
            'cond' => $evsRow['cond'],
            'cmmt' => $evsRow['cmmt'],
            'cmmt2' => $evsRow['cmmt2'],
            'not_return_link' => $not_return_link,
            'just_return_link' => $just_return,
            'exec_cond' => $evsRow['exec_cond'],
            "view_user_exp" => $evsRow['view_user_exp'],
            "page_name" => $evsRow['page_name']
                ]
            ];                
            }
            unset($s_attrs_2);
            unset($m_attrs_2);
            unset($a_skills_2);
            unset($r_skills_2);
            unset($not_return_link);
        
        
        
        
        
            $evsRow = $evsStmt->fetch(\PDO::FETCH_ASSOC);
        }
    }

// 构建 Mapping 数组
$data = [
    '#data_events_Mapping#' => [
        'id' => $row['id'],
        'evs' => $evs,
        'cond' => $row['cond'],
        'cmmt' => $row['cmmt']
    ]
];


            }

            // 将 Mapping 数组转换为 JSON 字符串
            $ret = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $ret = stripslashes($ret);
            break;

        case 'modules':
            // 处理模板数据
            // ...
            break;
        case 'skills':
            // 处理技能数据
            // ...
            break;
        case 'scene':
            // 处理场景数据
            // ...
            break;
        case 'items':
            // 处理物品数据
            // ...
            break;
        case 'npcs':
            // 处理 NPC 数据
            // ...
            break;
    }

    return $ret;
}
function get_mysqldata_2($dblj, $data_type, $data_id){
    switch ($data_type) {
        case 'events':
            // 处理专属事件
            $query = "SELECT id, cond, cmmt, link_evs FROM system_event_self WHERE id = '$data_id' LIMIT 1";
            $stmt = $dblj->query($query);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (empty($row['link_evs'])) {
                // link_evs 为空，生成不包含 evs 字段的数据
                $data = [
                    '#data_events_Mapping#' => [
                        'id' => $row['id'],
                        'cond' => $row['cond'],
                        'cmmt' => $row['cmmt']
                    ]
                ];
            } else {
                // link_evs 不为空，处理 evs 字段的数据
                $evsIds = explode(',', $row['link_evs']);
                $evs = [];
                foreach ($evsIds as $evsId) {
        // 查询 system_event_evs 表获取数据
        $evsQuery = "SELECT * FROM system_event_evs_self WHERE id = '$evsId' LIMIT 1";
        $evsStmt = $dblj->query($evsQuery);
        $evsRow = $evsStmt->fetch(\PDO::FETCH_ASSOC);
        
        while ($evsRow) {
            // 处理 s_attrs 字段
            $s_attrs = $evsRow['s_attrs'];
            $m_attrs = $evsRow['m_attrs'];
            $a_skills = $evsRow['a_skills'];
            $r_skills = $evsRow['r_skills'];
            $not_return_link = $evsRow['not_return_link'];
            $just_return = $evsRow['just_return'];
            $not_return_link = ($not_return_link == 0) ? "F" : "T";
            $just_return = ($just_return == 1) ? "F" : "T";
            if(!empty($s_attrs)){
            $pairs = explode(',', $s_attrs);
            $s_attrs_2 = [];
        
            foreach ($pairs as $pair) {
                // 分割键和值
                $equal_pos = strpos($pair, '=');
                if ($equal_pos !== false) {
                    // 提取键和值
                    $key = trim(substr($pair, 0, $equal_pos));
                    $value = trim(substr($pair, $equal_pos + 1));
                    // 添加到新的关联数组中
                    $s_attrs_2[$key] = $value;
    }
            }
            }
            // 构建每个 evs 数组元素
            if(!empty($m_attrs)){
            $pairs = explode(',', $m_attrs);
            $m_attrs_2 = [];
        
            foreach ($pairs as $pair) {
                // 分割键和值
                $equal_pos = strpos($pair, '=');
                if ($equal_pos !== false) {
                    // 提取键和值
                    $key = trim(substr($pair, 0, $equal_pos));
                    $value = trim(substr($pair, $equal_pos + 1));
                    // 添加到新的关联数组中
                    $m_attrs_2[$key] = $value;
    }
            }
            }
            
            
            
            // 检查 s_attrs 字段是否为 null，如果不为 null 则添加到最终的数据数组中
            if(empty($s_attrs_2) && empty($m_attrs_2)){
            $evs[] = [
                '#data_events_Mapping#' => [
                    'id' => $evsRow['id'],
                    'a_skills' => $evsRow['a_skills'],
                    'r_skills' => $evsRow['r_skills'],
                    'cond' => $evsRow['cond'],
                    'cmmt' => $evsRow['cmmt'],
                    'cmmt2' => $evsRow['cmmt2'],
                    'not_return_link' => $not_return_link,
                    'just_return_link' => $just_return,
                    'exec_cond' => $evsRow['exec_cond'],
                    "view_user_exp" => $evsRow['view_user_exp'],
                    "page_name" => $evsRow['page_name']
                ]
            ];
            }else{
            $evs[] = [
            '#data_events_Mapping#' => [
            'id' => $evsRow['id'],
            's_attrs' => $s_attrs_2,
            'm_attrs' => $m_attrs_2,
            'a_skills' => $evsRow['a_skills'],
            'r_skills' => $evsRow['r_skills'],
            'cond' => $evsRow['cond'],
            'cmmt' => $evsRow['cmmt'],
            'cmmt2' => $evsRow['cmmt2'],
            'not_return_link' => $not_return_link,
            'just_return_link' => $just_return,
            'exec_cond' => $evsRow['exec_cond'],
            "view_user_exp" => $evsRow['view_user_exp'],
            "page_name" => $evsRow['page_name']
                ]
            ];                
            }
            unset($s_attrs_2);
            unset($m_attrs_2);
            unset($not_return_link);
        
        
        
        
        
            $evsRow = $evsStmt->fetch(\PDO::FETCH_ASSOC);
        }
    }

// 构建 Mapping 数组
$data = [
    '#data_events_Mapping#' => [
        'id' => $row['id'],
        'evs' => $evs,
        'cond' => $row['cond'],
        'cmmt' => $row['cmmt']
    ]
];


            }

            // 将 Mapping 数组转换为 JSON 字符串
            $ret = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $ret = stripslashes($ret);
            break;

        case 'modules':
            // 处理模板数据
            // ...
            break;
        case 'skills':
            // 处理技能数据
            // ...
            break;
        case 'scene':
            // 处理场景数据
            // ...
            break;
        case 'items':
            // 处理物品数据
            // ...
            break;
        case 'npcs':
            // 处理 NPC 数据
            // ...
            break;
    }

    return $ret;
}
?>