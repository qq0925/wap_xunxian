<?php
require_once 'class/player.php';
require_once 'class/encode.php';
require_once 'class/gm.php';
include_once 'pdo.php';
// require_once 'class/lexical_analysis.php';
require_once 'class/basic_function_todo.php';


$sql = "select * from system_fight_quick where sid = '$sid'";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
for($i=1;$i<@count($result) +1;$i++){
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$quick_values = $result[$i-1]['quick_value'];
$quick_para = explode('|',$quick_values);
$quick_type = $quick_para[0];
$quick_detail = $quick_para[1];
if($quick_type){
switch($quick_type){
    case '1':
        $quick_sql = "select * from system_skill where jid = '$quick_detail'";
        $stmt = $dblj->prepare($quick_sql);
        $stmt->execute();
        $quick_result = $stmt->fetch(PDO::FETCH_ASSOC);
        $quick_text = $quick_result['jname'];
        break;
    case '2':
        $quick_sql = "select * from system_item_module where iid = '$quick_detail'";
        $stmt = $dblj->prepare($quick_sql);
        $stmt->execute();
        $quick_result = $stmt->fetch(PDO::FETCH_ASSOC);
        $quick_text = $quick_result['iname'];
        break;
    case '3':
        $quick_sql = "select * from system_item_module where iid = '$quick_detail'";
        $stmt = $dblj->prepare($quick_sql);
        $stmt->execute();
        $quick_result = $stmt->fetch(PDO::FETCH_ASSOC);
        $quick_text = $quick_result['iname'];
        break;
        
        
}
}else{
    $quick_text = "选择";
}
$quick_text = \lexical_analysis\color_string($quick_text);
$quick_url = $encode->encode("cmd=function_quick_html&canshu=1&pos=$i&ucmd=$cmid&sid=$sid");
    $quick_main .=<<<HTML
快捷键{$i}:<a href="?cmd=$quick_url">{$quick_text}</a><br/>
HTML;
}

$cmid = $cmid + 1;
$cdid[] = $cmid;    
$clj[] = $cmd;
$game_ret = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$quick_html = <<<HTML
<p>[战斗场景快捷键设置]<br/>
$quick_main
快捷键8(宠物):<a href="">选择</a><br/>
快捷键9(宠物):<a href="">选择</a><br/>
<a href="?cmd=$game_ret">返回游戏</a><br/>
</p>

HTML;
echo $quick_html;
?>