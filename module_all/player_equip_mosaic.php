<?php

//由于装备镶嵌和铁匠npc高度绑定，所以应该传入一个npc_id，并有一个返回上级用于返回npc界面，一个返回游戏用于返回场景模板
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
if($mosaic_canshu !=1){

if($mosaic_canshu2!=1){


if($sure_new_mosaic_canshu){
    $event_data = global_event_data_get(42,$dblj);
    $event_cond = $event_data['system_event']['cond'];
    $event_cmmt = $event_data['system_event']['cmmt'];
    $register_triggle = checkTriggerCondition($event_cond,$dblj,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
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
    ////未有镶嵌物
    $sure_insert_para = \player\get_player_equip_mosaic_once($insert_true_canshu,$sid,$dblj);
    if($sure_insert_para['equip_mosaic']){
        $add = $sure_insert_para['equip_mosaic'] . "|" .$insert_mosaic;
    }else{
        $add = $insert_mosaic;
    }
    $dblj->exec("insert into player_equip_mosaic (equip_id,equip_root,belong_sid,equip_mosaic)values('$insert_true_canshu','$insert_canshu','$sid','$add') ");
    echo "镶嵌成功！<br/>";
    if(!empty($event_data['system_event']['link_evs'])){
        $system_event_evs = $event_data["system_event_evs"];
        foreach ($system_event_evs as $index => $event) {
        $step_cond = $event['cond'];
        $step_cmmt = $event['cmmt'];
        $step_cmmt2 = $event['cmmt2'];
        $step_s_attrs = $event['s_attrs'];
        $step_m_attrs = $event['m_attrs'];
        $step_triggle = checkTriggerCondition($step_cond,$dblj,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
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
            $ret = attrsetting($step_s_attrs,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
            $ret = attrchanging($step_m_attrs,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
            }
        }

    }
    
    \player\changeplayeritem($insert_true_mosaic,-1,$sid,$dblj);
    $iweight = \player\getitem($insert_mosaic,$dblj)->iweight;
    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
    }
}

if($sure_old_mosaic_canshu){
    //已有镶嵌物
    $event_data = global_event_data_get(42,$dblj);
    $event_cond = $event_data['system_event']['cond'];
    $event_cmmt = $event_data['system_event']['cmmt'];
    $register_triggle = checkTriggerCondition($event_cond,$dblj,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
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
    $sure_insert_para = \player\get_player_equip_mosaic_once($insert_true_canshu,$sid,$dblj);
    if($sure_insert_para['equip_mosaic']){
        $add = $sure_insert_para['equip_mosaic'] . "|" .$insert_mosaic;
    }else{
        $add = $insert_mosaic;
    }
    
    if(!empty($event_data['system_event']['link_evs'])){
        $system_event_evs = $event_data["system_event_evs"];
        foreach ($system_event_evs as $index => $event) {
        $step_cond = $event['cond'];
        $step_cmmt = $event['cmmt'];
        $step_cmmt2 = $event['cmmt2'];
        $step_s_attrs = $event['s_attrs'];
        $step_m_attrs = $event['m_attrs'];
        $step_triggle = checkTriggerCondition($step_cond,$dblj,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
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
            $ret = attrsetting($step_s_attrs,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
            $ret = attrchanging($step_m_attrs,$insert_mosaic,'mosaic_equip',$insert_true_canshu);
            }
        }

    }
    
    
    $dblj->exec("update player_equip_mosaic set equip_mosaic = '$add' where equip_id = '$insert_true_canshu' and equip_root = '$insert_canshu'");
    echo "镶嵌成功！<br/>";
    
    \player\changeplayeritem($insert_true_mosaic,-1,$sid,$dblj);
    $iweight = \player\getitem($insert_mosaic,$dblj)->iweight;
    \player\addplayersx('uburthen',-$iweight,$sid,$dblj);
}
}

if($diss_this_canshu){

$weight = \player\getitem($diss_this_mosaic_id,$dblj)->iweight;
$player_last_burthen = $player->umax_burthen - $player->uburthen;
if($player_last_burthen >=$weight && $player_last_burthen>0){

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

    $event_data = global_event_data_get(43,$dblj);
    $event_cond = $event_data['system_event']['cond'];
    $event_cmmt = $event_data['system_event']['cmmt'];
    $register_triggle = checkTriggerCondition($event_cond,$dblj,$diss_this_mosaic_id,'mosaic_equip',$diss_this_canshu);
    $register_triggle2 = checkTriggerCondition(\player\getitem($diss_this_mosaic_id,$dblj)->iequip_cond,$dblj,$sid,'item_module',$diss_this_mosaic_id);
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
        $step_triggle = checkTriggerCondition($step_cond,$dblj,$diss_this_mosaic_id,'mosaic_equip',$diss_this_canshu);
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
            $ret = attrsetting($step_s_attrs,$diss_this_mosaic_id,'mosaic_equip',$diss_this_canshu);
            $ret = attrchanging($step_m_attrs,$diss_this_mosaic_id,'mosaic_equip',$diss_this_canshu);
            }
        }

    }
    \player\additem($sid,$diss_this_mosaic_id,1,$dblj);
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


if ($diss_all) {
    try {
        // 查询装备嵌套信息
        $sql = "SELECT equip_mosaic,equip_id FROM player_equip_mosaic WHERE belong_sid = :sid";
        $stmt = $dblj->prepare($sql);
        $stmt->execute([':sid' => $sid]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($row) {
            $diss_count = count($row);
            $player_last_burthen = $player->umax_burthen - $player->uburthen;
            $weight = 0;
            for($i=0;$i<$diss_count;$i++){
            $diss_equip_one = $row[$i]['equip_id'];
            $diss_para = explode('|',$row[$i]['equip_mosaic']);
            
            // 计算总负重
            foreach ($diss_para as $diss_para_id) {
                $weight += \player\getitem($diss_para_id, $dblj)->iweight ?? 0;
            }
            
            if ($player_last_burthen >= $weight && $player_last_burthen > 0) {
                // 将装备拆卸到背包

                $event_data = global_event_data_get(43,$dblj);
                $event_cond = $event_data['system_event']['cond'];
                $event_cmmt = $event_data['system_event']['cmmt'];

                foreach ($diss_para as $diss_para_id) {
                    
                $register_triggle = checkTriggerCondition($event_cond,$dblj,$diss_para_id,'mosaic_equip',$diss_equip_one);
                if(is_null($register_triggle)){
                    $register_triggle =1;
                }
            
                if(!$register_triggle){
                echo "拆卸失败！<br/>";
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
                    $step_triggle = checkTriggerCondition($step_cond,$dblj,$diss_para_id,'mosaic_equip',$diss_equip_one);
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
                        $ret = attrsetting($step_s_attrs,$diss_para_id,'mosaic_equip',$diss_equip_one);
                        $ret = attrchanging($step_m_attrs,$diss_para_id,'mosaic_equip',$diss_equip_one);
                        }
                    }
            
                }
                }
                \player\additem($sid, $diss_para_id, 1, $dblj);
                }

                // 删除嵌套信息
                $delete_sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = :sid";
                $delete_stmt = $dblj->prepare($delete_sql);
                $delete_stmt->execute([':sid' => $sid]);
                echo "全部拆卸成功!<br/>";
            } else {
                echo "请检测背包负重后再进行操作！<br/>";
            }
            
            }
        } else {
            echo "没有找到嵌套装备记录！<br/>";
        }
    } catch (Exception $e) {
        echo "操作失败: " . $e->getMessage();
    }
}

if ($diss_canshu) {
    try {
        // 查询装备嵌套信息
        $sql = "SELECT equip_mosaic FROM player_equip_mosaic WHERE belong_sid = :sid AND equip_id = :equip_id";
        $stmt = $dblj->prepare($sql);
        $stmt->execute([':sid' => $sid, ':equip_id' => $diss_canshu]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $diss_count = count($row);
            $player_last_burthen = $player->umax_burthen - $player->uburthen;
            $weight = 0;
            
            $diss_para = explode('|',$row['equip_mosaic']);
            
            // 计算总负重
            foreach ($diss_para as $diss_para_id) {
                $weight += \player\getitem($diss_para_id, $dblj)->iweight ?? 0;
            }
            
            if ($player_last_burthen >= $weight && $player_last_burthen > 0) {
                // 将装备拆卸到背包

                $event_data = global_event_data_get(43,$dblj);
                $event_cond = $event_data['system_event']['cond'];
                $event_cmmt = $event_data['system_event']['cmmt'];

                foreach ($diss_para as $diss_para_id) {
                    
                $register_triggle = checkTriggerCondition($event_cond,$dblj,$diss_para_id,'mosaic_equip',$diss_canshu);
                if(is_null($register_triggle)){
                    $register_triggle =1;
                }
            
                if(!$register_triggle){
                echo "拆卸失败！<br/>";
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
                    $step_triggle = checkTriggerCondition($step_cond,$dblj,$diss_para_id,'mosaic_equip',$diss_canshu);
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
                        $ret = attrsetting($step_s_attrs,$diss_para_id,'mosaic_equip',$diss_canshu);
                        $ret = attrchanging($step_m_attrs,$diss_para_id,'mosaic_equip',$diss_canshu);
                        }
                    }
            
                }
                }
                \player\additem($sid, $diss_para_id, 1, $dblj);
                }

                // 删除嵌套信息
                $delete_sql = "DELETE FROM player_equip_mosaic WHERE belong_sid = :sid and equip_id = :equip_id";
                $delete_stmt = $dblj->prepare($delete_sql);
                $delete_stmt->execute([':sid' => $sid, ':equip_id' => $diss_canshu]);

                echo "一键拆卸成功!<br/>";
            } else {
                echo "请检测背包负重后再进行操作！<br/>";
            }
            
            
        } else {
            echo "没有找到嵌套装备记录！<br/>";
        }
    } catch (Exception $e) {
        echo "操作失败: " . $e->getMessage();
    }
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$gojustnow = $encode->encode("cmd=npc_html&ucmd=$cmid&mid=$mid&sid=$sid");
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
        $equip_mosaic_list_para = explode("|",$equip_mosaic_list);
        $equip_mosaic_list_count = count($equip_mosaic_list_para);
    }
        for($j=0;$j<$equip_mosaic_list_count;$j++){
            $equip_mosaic_detail_id = $equip_mosaic_list_para[$j];
            $equip_mosaic_detail = \player\getitem($equip_mosaic_detail_id,$dblj);
            $equip_mosaic_detail_name = \lexical_analysis\color_string($equip_mosaic_detail->iname);
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
    //$player_equip_html .=" <a href='?cmd=$gotomosaic'>去镶嵌</a><br/>";
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
    //$player_equip_html .=" <br/>";
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
    $diss_html = "<a href='?cmd=$diss_all'>全部拆卸</a><br/>";
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
<input name="ucmd" type="hidden" value="{$cmid}">
 <button type="submit">搜索</button><br/>
 </form>
 <a href="?cmd=$gonowmid">返回游戏</a><br/>
HTML;
}else{
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gojustnow = $encode->encode("cmd=npc_html&ucmd=$cmid&mid=$mid&sid=$sid");
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
<input name="ucmd" type="hidden" value="{$cmid}">
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
$mosaic_id = $mosaic_list[$i-1]['iid'];
$mosaic_true_id = $mosaic_list[$i-1]['item_true_id'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotomosaic = $encode->encode("cmd=mosaic_html&sure_new_mosaic_canshu=1&ucmd=$cmid&insert_canshu=$insert_canshu&insert_true_canshu=$insert_true_canshu&insert_mosaic=$mosaic_id&insert_true_mosaic=$mosaic_true_id&mid=$mid&sid=$sid");
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
$old_equip_arr_para = explode("|",$old_equip_para);
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
$mosaic_id = $mosaic_list[$i-1]['iid'];
$mosaic_true_id = $mosaic_list[$i-1]['item_true_id'];
$cmid = $cmid + 1;
$cdid[] = $cmid;
$gotomosaic = $encode->encode("cmd=mosaic_html&sure_old_mosaic_canshu=1&ucmd=$cmid&insert_canshu=$insert_canshu&insert_true_canshu=$insert_true_canshu&insert_mosaic=$mosaic_id&insert_true_mosaic=$mosaic_true_id&mid=$mid&sid=$sid");
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