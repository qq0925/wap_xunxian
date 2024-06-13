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
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $all_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "聊天频道<a href='?cmd=$goliaotian'>刷新</a> <br/>【公共|<a href='?cmd=$imliaotian'>私聊</a>】<br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $send_time = $ret[$i]['send_time'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
                $lthtml .="<span class='txt-fade'>[{$send_time}]</span>[公共]<a href='?cmd=$u_cmd'>$uname</a>:$umsg<br/>";
            }else{
                $lthtml .="<span class='txt-fade'>[{$send_time}]</span>[公共]<div class='hpys' style='display: inline'>$uname:</div>$umsg<br/>";
            }

        }
        
if ($currentPage > 2 && $currentPage == $totalPages) {
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
<input type="hidden" name="sid" value="$sid">
<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
<input type="submit" value="发送">
</form>
HTML;
    }
}
if ($ltlx == 'im'){
    
    
// 计算总行数
$sqlCount = "SELECT COUNT(*) as total FROM system_chat_data where chat_type =1";
$countResult = $dblj->query($sqlCount);
$countRow = $countResult->fetch(PDO::FETCH_ASSOC);
$totalRows = $countRow['total'];


// 计算总页数
$totalPages = ceil($totalRows / $list_row);
    
    $sql = "SELECT * FROM system_chat_data WHERE uid= {$player->uid} or imuid = {$player->uid} and chat_type = 1 ORDER BY id ASC LIMIT $offset,$list_row";//聊天列表获取
    $ltcxjg = $dblj->query($sql);
    $lthtml='';

    if ($ltcxjg){
        $ret = $ltcxjg->fetchAll(PDO::FETCH_ASSOC);
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $goliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=all&sid=$sid");
        $cmid = $cmid + 1;
        $cdid[] = $cmid;
        $clj[] = $cmd;
        $imliaotian = $encode->encode("cmd=liaotian&ucmd=$cmid&ltlx=im&sid=$sid");
        $im_post = $encode->encode("cmd=sendliaotian&ucmd=$cmid&sid=$sid");
        $lthtml = "聊天频道<a href='?cmd=$imliaotian'>刷新</a> <br/>【<a href='?cmd=$goliaotian'>公共</a>|私聊】<br/>";
        for ($i=0;$i < count($ret);$i++){
            $uname = $ret[$i]['name'];
            $umsg = $ret[$i]['msg'];
            $umsg = \lexical_analysis\color_string($umsg);
            $uid = $ret[$i]['uid'];
            $imuid = $ret[$i]['imuid'];
            $send_time = $ret[$i]['send_time'];
            $timestamp = strtotime($send_time); // 将日期时间字符串转换为时间戳
            $send_time = date("m-d H:i", $timestamp); // 使用date函数提取出时间部分
            $uplayer = \player\getplayer1($imuid,$dblj);
            if ($uid){
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $u_cmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$uid&sid=$player->sid");
                $cmid = $cmid + 1;
                $cdid[] = $cmid;
                $clj[] = $cmd;
                $imucmd = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$imuid&sid=$player->sid");
                $lthtml .="<span class='txt-fade'>[{$send_time}]</span>[私聊]<a href='?cmd=$u_cmd'>$uname</a>-->><a href='?cmd=$imucmd'>$uplayer->uname</a>:$umsg<br/>";
            }
        }
        
        
if ($currentPage > 2 && $currentPage == $totalPages) {
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
<form action="?cmd=$im_post" method="post">
<input type="hidden" name="ltlx" value="im">
<input type="hidden" name="sid" value="$sid">
对方id：<input type="text" name="imuid"><br/>
消息：<textarea name="ltmsg" maxlength="200" rows="4" cols="20"></textarea>
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