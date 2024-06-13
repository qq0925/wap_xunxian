<?php
$player = \player\getplayer($sid,$dblj);
$_SERVER['PHP_SELF'];

$game_config = \player\getgameconfig($dblj);
$list_row = $game_config->list_row;

// 当前页码
if ($list_page) {
    $currentPage = intval($list_page);
} else {
    $currentPage = 1;
}
// 计算偏移量
$offset = ($currentPage - 1) * $list_row;

if ($ltlx == "all"){
    
if($delete_msid){
    echo "删除成功！<br/>";
    $dblj->exec("delete from system_chat_data where id = '$delete_msid'");
    unset($delete_msid);
}
// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where chat_type =0";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data where chat_type = 0 ORDER BY id DESC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';

    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        if($list_page){
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&list_page=$list_page&ltlx=all&sid=$sid");
        }else{
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $all_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "【聊天频道：公共】<a href='?cmd=$goliaotian'>刷新</a> <br/>
        【公共|<a href='?cmd=$imliaotian'>私聊</a>|<a href='?cmd=$cityliaotian'>城聊</a>|<a href='?cmd=$arealiaotian'>区聊</a>|<a href='?cmd=$teamliaotian'>队聊</a>】<br/>
        <span style='font-weight : bold ; color: red'>请勿发表有关辱骂、政治、色情、赌博等相关言论！请确保您的言论符合游戏规则和道德准则。违反规则将导致相应的惩罚措施，包括禁言、封号等。</span><br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $send_time = $ret[$i]['send_time'];
            $send_type = $ret[$i]['send_type'];
            $msg_id = $ret[$i]['id'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                if($send_type==0){
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
                }elseif($send_type==1){
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
                }
                $lthtml .="[<span style='color: orangered;'>公共</span>]<a href='?cmd=$u_cmd'>$uname</a>:$umsg<span class='txt-fade'>[{$send_time}]</span>";
                if($player->uis_designer ==1){
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&delete_msid=$msg_id&sid=$player->sid");
                $lthtml .="<a href='?cmd=$delete_msg'>删除</a>";
                }
                $lthtml .="<br/>";
            }else{
                $lthtml .="<div class='hpys' style='display: inline; color: orangered'>[$uname]</div>$umsg<span class='txt-fade'>[{$send_time}]</span>";
                if($player->uis_designer ==1){
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&delete_msid=$msg_id&sid=$player->sid");
                $lthtml .="<a href='?cmd=$delete_msg'>删除</a>";
                }
                $lthtml .="<br/>";
            }

        }
        
if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}        
$lthtml .=<<<HTML
$page_html<br/>
HTML;
        $lthtml.=<<<HTML
===
<form action="?cmd=$all_post" method="post">
<input type="hidden" name="ltlx" value="all">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
if ($ltlx == 'im'){
// 计算总行数

if($delete_canshu ==1){
    echo "已清空私聊信息!<br/>";
    $dblj->exec("delete from system_chat_data where (imuid = {$player->uid}) and chat_type =1");
}

//(uid= {$player->uid} or imuid = {$player->uid})

$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where (imuid = {$player->uid}) and chat_type =1";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];

// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data WHERE (imuid = {$player->uid}) and chat_type = 1 ORDER BY id DESC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';
    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        if($list_page){
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&list_page=$list_page&ltlx=im&sid=$sid");
        }else{
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $im_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "【聊天频道：私聊】<a href='?cmd=$imliaotian'>刷新</a> <br/>【<a href='?cmd=$goliaotian'>公共</a>|私聊|<a href='?cmd=$cityliaotian'>城聊</a>|<a href='?cmd=$arealiaotian'>区聊</a>|<a href='?cmd=$teamliaotian'>队聊</a>】<br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $imuid = $ret[$i]['imuid'];
            $send_time = $ret[$i]['send_time'];
            $send_type = $ret[$i]['send_type'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            $uplayer = \player\getplayer1($imuid,$dblj);
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
            if($send_type==0){
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
            }elseif($send_type==1){
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
            }
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $imucmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$imuid&sid=$player->sid");
                $lthtml .="[<span style='color: orangered;'>私聊</span>]<a href='?cmd=$u_cmd'>$uname</a>对<a href='?cmd=$imucmd'>你</a>说:$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
            }
            else{
            $lthtml .="<div class='hpys' style='display: inline; color: orangered'>[$uname]</div>$umsg<span class='txt-fade'>[{$send_time}]</span>";
            $lthtml .="<br/>";
            }
        }
        $delete_all_immsg = $encode->encode("cmd=liaotian&delete_canshu=1&ucmd=$cmid&ltlx=im&sid=$sid");

if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}        
$lthtml .=<<<HTML
$page_html<br/>
HTML;
if(count($ret)!=0){
$lthtml .="<br/><a href='?cmd=$delete_all_immsg'>清空消息</a><br/>";
}
        $lthtml.=<<<HTML
===
<form action="?cmd=$im_post" method="post">
<input type="hidden" name="ltlx" value="im">
对方id：<input type="text" name="imuid"><br/>
消息：<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
if($ltlx == "city"){
$clmid = \player\getmid($player->nowmid,$dblj);
$city_id = $clmid->marea_id;
if($delete_msid){
    echo "删除成功！<br/>";
    $dblj->exec("delete from system_chat_data where id = '$delete_msid'");
    unset($delete_msid);
}
// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where chat_type =2 and imuid = '$city_id'";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data where chat_type = 2 and imuid = '$city_id' ORDER BY id DESC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';

    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        if($list_page){
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&list_page=$list_page&ltlx=city&sid=$sid");
        }else{
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&sid=$sid");
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $city_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "【聊天频道：「{$clmid->marea_name}」】<a href='?cmd=$cityliaotian'>刷新</a> <br/>
        【<a href='?cmd=$goliaotian'>公共</a>|<a href='?cmd=$imliaotian'>私聊</a>|城聊|<a href='?cmd=$arealiaotian'>区聊</a>|<a href='?cmd=$teamliaotian'>队聊</a>】<br/>
        <span style='font-weight : bold ; color: red'>请勿发表有关辱骂、政治、色情、赌博等相关言论！请确保您的言论符合游戏规则和道德准则。违反规则将导致相应的惩罚措施，包括禁言、封号等。</span><br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $imuid = $ret[$i]['imuid'];
            $send_time = $ret[$i]['send_time'];
            $send_type = $ret[$i]['send_type'];
            $msg_id = $ret[$i]['id'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
            if($send_type==0){
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
            }elseif($send_type==1){
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
            }
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&delete_msid=$msg_id&sid=$player->sid");
                $lthtml .="[<span style='color: orangered;'>{$clmid->marea_name}</span>]<a href='?cmd=$u_cmd'>$uname</a>:$umsg<span class='txt-fade'>[{$send_time}]</span>";
                if($player->uis_designer ==1){
                $lthtml .="<a href='?cmd=$delete_msg'>删除</a>";
                }
                $lthtml .="<br/>";
            }else{
                $lthtml .="<div class='hpys' style='display: inline; color: orangered'>[$uname]</div>$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
            }

        }
        
if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}        
$lthtml .=<<<HTML
$page_html<br/>
HTML;
        $lthtml.=<<<HTML
===
<form action="?cmd=$city_post" method="post">
<input type="hidden" name="ltlx" value="city">
<input type="hidden" name="imuid" value="$city_id">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
if($ltlx == "area"){
$city_id = \player\getmid($player->nowmid,$dblj)->marea_id;
$area_mid = \player\getqy($city_id,$dblj)->belong;
$area_names = [
    0 => '失落之地',
    1 => '日出之地',
    2 => '灼热之地',
    3 => '日落之地',
    4 => '极寒之地',
    5 => '湿热之地',
];
$area_name = $area_names[$area_mid];
if($delete_msid){
    echo "删除成功！<br/>";
    $dblj->exec("delete from system_chat_data where id = '$delete_msid'");
    unset($delete_msid);
}
// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where chat_type =3 and imuid = '$area_mid'";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data where chat_type = 3 and imuid = '$area_mid' ORDER BY id DESC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';

    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        if($list_page){
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&list_page=$list_page&ltlx=area&sid=$sid");
        }else{
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&sid=$sid");
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $area_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "【聊天频道：「{$area_name}」】<a href='?cmd=$arealiaotian'>刷新</a> <br/>
        【<a href='?cmd=$goliaotian'>公共</a>|<a href='?cmd=$imliaotian'>私聊</a>|<a href='?cmd=$cityliaotian'>城聊</a>|区聊|<a href='?cmd=$teamliaotian'>队聊</a>】<br/>
        <span style='font-weight : bold ; color: red'>请勿发表有关辱骂、政治、色情、赌博等相关言论！请确保您的言论符合游戏规则和道德准则。违反规则将导致相应的惩罚措施，包括禁言、封号等。</span><br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $imuid = $ret[$i]['imuid'];
            $send_time = $ret[$i]['send_time'];
            $send_type = $ret[$i]['send_type'];
            $msg_id = $ret[$i]['id'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                if($send_type==0){
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
                }elseif($send_type==1){
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
                }
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&delete_msid=$msg_id&sid=$player->sid");
                $lthtml .="[<span style='color: orangered;'>{$area_name}</span>]<a href='?cmd=$u_cmd'>$uname</a>:$umsg<span class='txt-fade'>[{$send_time}]</span>";
                if($player->uis_designer ==1){
                $lthtml .="<a href='?cmd=$delete_msg'>删除</a>";
                }
                $lthtml .="<br/>";
            }else{
                $lthtml .="<div class='hpys' style='display: inline; color: orangered'>[$uname]</div>$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
            }

        }
        
if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}        
$lthtml .=<<<HTML
$page_html<br/>
HTML;
        $lthtml.=<<<HTML
===
<form action="?cmd=$area_post" method="post">
<input type="hidden" name="ltlx" value="area">
<input type="hidden" name="imuid" value="$area_mid">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
if($ltlx == "team"){
$team_id = \player\getteam($player->uteam_id,$dblj)['team_id'];
$team_name = \player\getteam($player->uteam_id,$dblj)['team_name'];
if($team_id ==0){
$team_name = "你目前没有队伍!";
}
if($delete_msid){
    echo "删除成功！<br/>";
    $dblj->exec("delete from system_chat_data where id = '$delete_msid'");
    unset($delete_msid);
}
// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where chat_type =4 and imuid = '$team_id'";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data where chat_type = 4 and imuid = '$team_id' ORDER BY id DESC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';

    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        if($list_page){
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&list_page=$list_page&ltlx=team&sid=$sid");
        }else{
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&sid=$sid");
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $team_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "【聊天频道：「{$team_name}」】<a href='?cmd=$teamliaotian'>刷新</a> <br/>
        【<a href='?cmd=$goliaotian'>公共</a>|<a href='?cmd=$imliaotian'>私聊</a>|<a href='?cmd=$cityliaotian'>城聊</a>|<a href='?cmd=$arealiaotian'>区聊</a>|队聊】<br/>
        <span style='font-weight : bold ; color: red'>请勿发表有关辱骂、政治、色情、赌博等相关言论！请确保您的言论符合游戏规则和道德准则。违反规则将导致相应的惩罚措施，包括禁言、封号等。</span><br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $imuid = $ret[$i]['imuid'];
            $send_time = $ret[$i]['send_time'];
            $send_type = $ret[$i]['send_type'];
            $msg_id = $ret[$i]['id'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                if($send_type==0){
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
                }elseif($send_type==1){
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
                }
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&delete_msid=$msg_id&sid=$player->sid");
                $lthtml .="[<span style='color: orangered;'>{$area_name}</span>]<a href='?cmd=$u_cmd'>$uname</a>:$umsg<span class='txt-fade'>[{$send_time}]</span>";
                if($player->uis_designer ==1){
                $lthtml .="<a href='?cmd=$delete_msg'>删除</a>";
                }
                $lthtml .="<br/>";
            }else{
                $lthtml .="<div class='hpys' style='display: inline; color: orangered'>[$uname]</div>$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
            }

        }
        
if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}

if($team_id !=0){
$lthtml .=<<<HTML
$page_html<br/>
HTML;
        $lthtml.=<<<HTML
===
<form action="?cmd=$team_post" method="post">
<input type="hidden" name="ltlx" value="team">
<input type="hidden" name="imuid" value="$team_id">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
}
if($ltlx == "clan"){
$city_id = \player\getmid($player->nowmid,$dblj)->marea_id;
$area_mid = \player\getqy($city_id,$dblj)->belong;
$area_names = [
    0 => '失落之地',
    1 => '日出之地',
    2 => '灼热之地',
    3 => '日落之地',
    4 => '极寒之地',
    5 => '湿热之地',
];
$area_name = $area_names[$area_mid];
if($delete_msid){
    echo "删除成功！<br/>";
    $dblj->exec("delete from system_chat_data where id = '$delete_msid'");
    unset($delete_msid);
}
// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where chat_type =3 and imuid = '$area_mid'";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data where chat_type = 3 and imuid = '$area_mid' ORDER BY id DESC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';

    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        if($list_page){
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&list_page=$list_page&ltlx=area&sid=$sid");
        }else{
        $arealiaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=area&sid=$sid");
        }
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $cityliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=city&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $teamliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=team&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $area_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "【聊天频道：「{$area_name}」】<a href='?cmd=$arealiaotian'>刷新</a> <br/>
        【<a href='?cmd=$goliaotian'>公共</a>|<a href='?cmd=$imliaotian'>私聊</a>|<a href='?cmd=$cityliaotian'>城聊</a>|区聊|<a href='?cmd=$teamliaotian'>队聊</a>】<br/>
        <span style='font-weight : bold ; color: red'>请勿发表有关辱骂、政治、色情、赌博等相关言论！请确保您的言论符合游戏规则和道德准则。违反规则将导致相应的惩罚措施，包括禁言、封号等。</span><br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $imuid = $ret[$i]['imuid'];
            $send_time = $ret[$i]['send_time'];
            $send_type = $ret[$i]['send_type'];
            $msg_id = $ret[$i]['id'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                if($send_type==0){
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
                }elseif($send_type==1){
                $u_cmd = $encode->encode("cmd=npc_html&ucmd=$cmid&nid=$uid&sid=$player->sid");
                }
                $delete_msg = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=clan&delete_msid=$msg_id&sid=$player->sid");
                $lthtml .="[<span style='color: orangered;'>{$area_name}</span>]<a href='?cmd=$u_cmd'>$uname</a>:$umsg<span class='txt-fade'>[{$send_time}]</span>";
                if($player->uis_designer ==1){
                $lthtml .="<a href='?cmd=$delete_msg'>删除</a>";
                }
                $lthtml .="<br/>";
            }else{
                $lthtml .="<div class='hpys' style='display: inline; color: orangered'>[$uname]</div>$umsg<span class='txt-fade'>[{$send_time}]</span><br/>";
            }

        }
        
if ($currentPage > 2) {
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=$ltlx&list_page=$list_page&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}        
$lthtml .=<<<HTML
$page_html<br/>
HTML;
        $lthtml.=<<<HTML
===
<form action="?cmd=$area_post" method="post">
<input type="hidden" name="ltlx" value="area">
<input type="hidden" name="imuid" value="$area_mid">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&newmid=$player->nowmid&sid=$player->sid");
$html = <<<HTML
$lthtml
<br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $html;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/13
 * Time: 21:49
 */?>