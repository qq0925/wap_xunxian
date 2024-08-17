<?php
$cmid = $cmid + 1;
$cdid[] = $cmid;
$quick_choose_url_1 = $encode->encode("cmd=function_quick_html&pos=$pos&canshu=1&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$quick_choose_url_2 = $encode->encode("cmd=function_quick_html&pos=$pos&canshu=2&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$quick_choose_url_3 = $encode->encode("cmd=function_quick_html&pos=$pos&canshu=3&ucmd=$cmid&sid=$sid");

switch($canshu){
    case '1':
        $player = new \player\player();
        $player = \player\getplayer($sid,$dblj);
        
        $sql = "select * from system_skill_user WHERE jsid = '$sid' and jpid = 0";
        $cxjg = $dblj->query($sql);
        if ($cxjg){
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        }
        $skillshtml = '';
        $hangshu = 0;
        if(@count($ret) ==0){
            $skillshtml .='你还没有学会任何技能。<br/>'; 
        }
        for ($i=0;$i<@count($ret);$i++){
            $skillsid = $ret[$i]['jid'];
            $skillslvl = $ret[$i]['jlvl'];
            //$skillspoint = $ret[$i]['jpoint'];
            $sql = "select * from system_skill WHERE jid = '$skillsid'";
            $cxjg = $dblj->query($sql);
            $retskills = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        for ($j=0;$j<count($retskills);$j++){
            $skillsid = $retskills[$j]['jid'];
            $skillsname = $retskills[$j]['jname'];
            $skillsname = \lexical_analysis\color_string($skillsname);
            $skillsname = \lexical_analysis\color_string($skillsname);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $chooseskills = $encode->encode("cmd=function_quick_html&ucmd=$cmid&choose_canshu=$canshu&pos=$pos&choose_id=$skillsid&sid=$sid");
            $skillshtml .="<a href='?cmd=$chooseskills'>{$skillsname}:[等级{$skillslvl}]</a><br/>";
        }
        
        }
        $quick_choose_url = <<<HTML
技能 <a href="?cmd=$quick_choose_url_2">药品</a> <a href="?cmd=$quick_choose_url_3">其它</a><br/>
请选择指定的技能作为快捷键以便在战斗中直接使用<br/>
$skillshtml
HTML;
        break;
    case '2':
        $player = new \player\player();
        $player = \player\getplayer($sid,$dblj);
        
        $sql = "select * from system_item WHERE sid = '$sid'";
        $cxjg = $dblj->query($sql);
        if ($cxjg){
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        }
        $itemshtml = '';
        $hangshu = 0;
        if(@count($ret) ==0){
            $itemshtml .='你身上没有任何药品。<br/>'; 
        }
        for ($i=0;$i<@count($ret);$i++){
            $itemsid = $ret[$i]['iid'];
            $itemcount = $ret[$i]['icount'];
            $sql = "select * from system_item_module WHERE iid = '$itemsid' and itype ='消耗品'";
            $cxjg = $dblj->query($sql); 
            $retitems = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        for ($j=0;$j<count($retitems);$j++){
            $itemsid = $retitems[$j]['iid'];
            $itemsname = $retitems[$j]['iname'];
            $itemsid = \lexical_analysis\color_string($itemsid);
            $itemsname = \lexical_analysis\color_string($itemsname);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $chooseitems = $encode->encode("cmd=function_quick_html&ucmd=$cmid&choose_canshu=$canshu&pos=$pos&choose_id=$itemsid&sid=$sid");
            $itemshtml .="<a href='?cmd=$chooseitems'>{$itemsname}:[已拥有：{$itemcount}]</a><br/>";
        }
        
        }
        $quick_choose_url = <<<HTML
<a href="?cmd=$quick_choose_url_1">技能</a> 药品 <a href="?cmd=$quick_choose_url_3">其它</a><br/>
请选择指定的药品作为快捷键以便在战斗中直接使用<br/>
$itemshtml
HTML;
        break;
    case '3':
        $player = new \player\player();
        $player = \player\getplayer($sid,$dblj);
        
        $sql = "select * from system_item WHERE sid = '$sid'";
        $cxjg = $dblj->query($sql);
        if ($cxjg){
            $ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        }
        $itemshtml = '';
        $hangshu = 0;
        if(@count($ret) ==0){
            $itemshtml .='你身上没有任何其它物品。<br/>'; 
        }
        for ($i=0;$i<@count($ret);$i++){
            $itemsid = $ret[$i]['iid'];
            $itemcount = $ret[$i]['icount'];
            $sql = "select * from system_item_module WHERE iid = '$itemsid' and itype ='其它'";
            $cxjg = $dblj->query($sql); 
            $retitems = $cxjg->fetchAll(PDO::FETCH_ASSOC);
        for ($j=0;$j<count($retitems);$j++){
            $itemsid = $retitems[$j]['iid'];
            $itemsname = $retitems[$j]['iname'];
            $itemsid = \lexical_analysis\color_string($itemsid);
            $itemsname = \lexical_analysis\color_string($itemsname);
            $cmid = $cmid + 1;
            $cdid[] = $cmid;
            $chooseitems = $encode->encode("cmd=function_quick_html&ucmd=$cmid&choose_canshu=$canshu&pos=$pos&choose_id=$itemsid&sid=$sid");
            $itemshtml .="<a href='?cmd=$chooseitems'>{$itemsname}:[已拥有：{$itemcount}]</a><br/>";
        }
        
        }
        $quick_choose_url = <<<HTML
<a href="?cmd=$quick_choose_url_1">技能</a> <a href="?cmd=$quick_choose_url_2">药品</a> 其它 <br/>
请选择指定的其它物品作为快捷键以便在战斗中直接使用<br/>
$itemshtml
HTML;
        break;
}

$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_quick = $encode->encode("cmd=function_quick_html&ucmd=$cmid&sid=$sid");

$cmid = $cmid + 1;
$cdid[] = $cmid;
$ret_game = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");

$quick_choose = <<<HTML
$quick_choose_url
<a href="?cmd=$ret_quick">返回快捷键设置</a><br/>
<a href="?cmd=$ret_game">返回游戏</a><br/>
</p>

HTML;
echo $quick_choose;

?>