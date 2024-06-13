<?php

$friend_choose_url_1 = $encode->encode("cmd=player_friend_html&canshu=1&ucmd=$cmid&sid=$sid");
$friend_choose_url_2 = $encode->encode("cmd=player_friend_html&canshu=2&ucmd=$cmid&sid=$sid");
$friend_choose_url_3 = $encode->encode("cmd=player_friend_html&canshu=3&ucmd=$cmid&sid=$sid");

switch($canshu){
    case '1':
        $player = new \player\player();
        $player = \player\getplayer($sid,$dblj);
        
        $sql = "select * from system_player_friend WHERE usid = '$sid'";
        $cxjg = $dblj->query($sql);
        if ($cxjg){
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        }
        $friend_count = @count($ret);
        $friendshtml = '';
        $hangshu = 0;
        if(@count($ret) ==0){
            $friendshtml .='你还没有任何好友。<br/>'; 
        }
        for ($i=0;$i<@count($ret);$i++){
            $friendsid = $ret[$i]['osid'];
            $sql = "select * from game1 WHERE sid = '$friendsid'";
            $cxjg = $dblj->query($sql);
            $retfriends = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        for ($j=1;$j<count($retfriends)+ 1;$j++){
            $friendsid = $retfriends[$j-1]['uid'];
            $friendsname = $retfriends[$j-1]['uname'];
            $friendsonline = $retfriends[$j-1]['sfzx'];
            $friendsonline_state = $friendsonline ==1?"在线":"离线";
            $friendsonline_count = (int)$friendsonline_count + (int)($friendsonline ==1 ? 1:0);
            $friendsname = \lexical_analysis\color_string($friendsname);
            $friendsname = \lexical_analysis\color_string($friendsname);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $choosefriends = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$friendsid&friend_canshu=1&sid=$sid");
            $friendshtml .="({$j}).<a href='?cmd=$choosefriends'>{$friendsname}</a>[{$friendsonline_state}]<br/>";
        }
        
        }
        if($friendsonline_count ==''){
            $friendsonline_count = 0;
            }
        $friend_choose_url = <<<HTML
好友 <a href="?cmd=$friend_choose_url_2">密友</a> <a href="?cmd=$friend_choose_url_3">黑名单</a><br/>
在线/所有（{$friendsonline_count}/{$friend_count}）<br/>
$friendshtml
HTML;
        break;
    case '2':
        $player = new \player\player();
        $player = \player\getplayer($sid,$dblj);
        
        $sql = "SELECT * FROM system_player_friend WHERE (usid, osid) IN (SELECT osid, usid FROM system_player_friend) and usid = '$sid';";
        $cxjg = $dblj->query($sql);
        if ($cxjg){
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        }
        $friend_count = @count($ret);
        $friendshtml = '';
        $hangshu = 0;
        if(@count($ret) ==0){
            $friendshtml .='你还没有任何密友。<br/>'; 
        }
        for ($i=0;$i<@count($ret);$i++){
            $friendsid = $ret[$i]['osid'];
            $sql = "select * from game1 WHERE sid = '$friendsid'";
            $cxjg = $dblj->query($sql);
            $retfriends = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        for ($j=1;$j<count($retfriends)+ 1;$j++){
            $friendsid = $retfriends[$j-1]['uid'];
            $friendsname = $retfriends[$j-1]['uname'];
            $friendsonline = $retfriends[$j-1]['sfzx'];
            $friendsonline_state = $friendsonline ==1?"在线":"离线";
            $friendsonline_count = (int)$friendsonline_count + (int)($friendsonline ==1 ? 1:0);
            $friendsname = \lexical_analysis\color_string($friendsname);
            $friendsname = \lexical_analysis\color_string($friendsname);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $choosefriends = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$friendsid&friend_canshu=1&sid=$sid");
            $friendshtml .="({$j}).<a href='?cmd=$choosefriends'>{$friendsname}</a>[{$friendsonline_state}]<br/>";
        }
        
        }
        if($friendsonline_count ==''){
            $friendsonline_count = 0;
            }
        $friend_choose_url = <<<HTML
<a href="?cmd=$friend_choose_url_1">好友</a> 密友 <a href="?cmd=$friend_choose_url_3">黑名单</a><br/>
在线/所有（{$friendsonline_count}/{$friend_count}）<br/>
$friendshtml
HTML;
        break;
    case '3':
        $player = new \player\player();
        $player = \player\getplayer($sid,$dblj);
        
        $sql = "select * from system_player_black WHERE usid = '$sid'";
        $cxjg = $dblj->query($sql);
        if ($cxjg){
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        }
        $friend_count = @count($ret);
        $friendshtml = '';
        $hangshu = 0;
        if(@count($ret) ==0){
            $friendshtml .='你还没有任何黑名单。<br/>'; 
        }
        for ($i=0;$i<@count($ret);$i++){
            $friendsid = $ret[$i]['osid'];
            $sql = "select * from game1 WHERE sid = '$friendsid'";
            $cxjg = $dblj->query($sql);
            $retfriends = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        for ($j=1;$j<count($retfriends)+ 1;$j++){
            $friendsid = $retfriends[$j-1]['uid'];
            $friendsname = $retfriends[$j-1]['uname'];
            $friendsonline = $retfriends[$j-1]['sfzx'];
            $friendsonline_state = $friendsonline ==1?"在线":"离线";
            $friendsonline_count = (int)$friendsonline_count + (int)($friendsonline ==1 ? 1:0);
            $friendsname = \lexical_analysis\color_string($friendsname);
            $friendsname = \lexical_analysis\color_string($friendsname);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $choosefriends = $encode->encode("cmd=getoplayerinfo&ucmd=$cmid&uid=$friendsid&friend_canshu=1&sid=$sid");
            $friendshtml .="({$j}).<a href='?cmd=$choosefriends'>{$friendsname}</a>[{$friendsonline_state}]<br/>";
        }
        
        }
        if($friendsonline_count ==''){
            $friendsonline_count = 0;
            }
        $friend_choose_url = <<<HTML
<a href="?cmd=$friend_choose_url_1">好友</a> <a href="?cmd=$friend_choose_url_2">密友</a> 黑名单<br/>
在线/所有（{$friendsonline_count}/{$friend_count}）<br/>
$friendshtml
HTML;
        break;
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$friend_choose = <<<HTML
$friend_choose_url
<a href="?cmd=$ret_game">返回游戏</a><br/>
</p>

HTML;
echo $friend_choose;

?>