<?php
try{
    eval('call_tongfu_net();');
}
catch (ParseError $e){
    print("语法错误: ". $e->getMessage());
}
catch (Error $e){
    print("执行错误: ". $e->getMessage());
}
?>

//代码存放
if (isset($cmd)){
    if ($cmd == 'djinfo'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'zbinfo'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'npc'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'duihuan'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    if ($cmd == 'sendliaotian'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    
    if ($cmd == 'gm'){
        $Dcmd = $encode->encode($Dcmd);
        header("refresh:1;url=?cmd=$Dcmd");
        exit();
    }
    
    $Dcmd = $encode->decode($cmd);
    
    
    
    
    
        /*<form action=$selfym method="get">
        角色名称：
        <input type="hidden" name="cmd" value="cjplayer">
        <input type="hidden" name="token" value='$token'>
        <p><input type="text" name="username" maxlength="7"></p>
        <p><label>男：<input type="radio" name="sex" value="1" checked></label>
            <label>女：<input type="radio" name="sex" value="2"></label>
        </p>
        <input type="submit" value="创建">
    </form>*/
    
<?php
$steps = [1,2, 3, 4 ,5 , 7,8, 10];
// 删除步骤值为 5, 6
$deleteSteps = [];
foreach ($deleteSteps as $deleteStep) {
    $key = array_search($deleteStep, $steps);
    if ($key !== false) {
        unset($steps[$key]);
    }
}

// 找到空缺位置并插入新步骤
$newStep = null;
for ($i = 1; $i <= count($steps) + 1; $i++) {
    if (!in_array($i, $steps)) {
        $newStep = $i;
        break;
    }
}

if ($newStep !== null) {
    $steps[] = $newStep;
    //sort($steps);
}

// 输出步骤数组
foreach ($steps as $step) {
    echo "步骤" . $step . "<br>";
}
?>
    
$htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{$gm_post->game_name}</title>
    <link rel="stylesheet" href="css/gamecss.css">
    <link rel="shortcut icon" href="/images/favicons.ico"/>
</head>
<body>
HTML;

$player = \player\getplayer($sid, $dblj);
if ($player->uis_designer == 1) {
    $htmlContent_2 = <<<HTML
真正的cmd(用于事件返回游戏链接): {$cmd}<br/>
parse_str 解析后的变量：<br>
{$is_designer_parse_str}
HTML;
$test_code_text = $htmlContent_2;
include_once 'gm/gm_test_code_show/gm_test_code_cmd.php';
    if (!empty($is_designer_post_str)) {
        $htmlContent_3 = <<<HTML
_POST解析后的变量：<br>
{$is_designer_post_str}
HTML;
$test_code_text = $htmlContent_3;
include_once 'gm/gm_test_code_show/gm_test_code_post.php';
    }
}

$getgameconfig = \player\getgameconfig($dblj);
if ($getgameconfig->game_temp_notice_time != 0) {
    $temp_notice = $getgameconfig->game_temp_notice;
    $htmlContent .= <<<HTML
    <font color='red'>[临时公告]：{$temp_notice}</font><br/>
HTML;
}

if (!$ym == '') {
    $htmlContent .= <<<HTML
    {$tpts}
HTML;
    if ($ym != "game/pvp.php") {
        $htmlContent .= <<<HTML
        {$pvpts}
HTML;
    }
    ob_start();
    include_once "$ym";
    $includedContent = ob_get_clean();
    $htmlContent .= $includedContent;
    
}

$htmlContent .= <<<HTML
<footer>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
HTML;
$htmlContent .= <<<HTML
</footer>
</body>
</html>
HTML;

$no_refresh_content = <<<HTML
禁止刷新页面！<br/>
HTML;

// 保存HTML代码到临时的PHP文件
$tempFileName = 'temporary_page.html';
file_put_contents($tempFileName, $htmlContent);
$tempFileName_2 = 'temporary_last_page.html';
file_put_contents($tempFileName_2, $htmlContent);
$no_refresh = 'no_refresh.php';
file_put_contents($no_refresh, $no_refresh_content);
// 设置正确的 MIME 类型和内容类型
// header('Content-Type: text/html');

// 包含临时的 PHP 文件
include $tempFileName;





$hurt = false;
$ghurt = 0;
$phurt = 0 ;
$phurt = round($npc->nattack - ($player->ufy * 0.75),0);
(({u.lvl}*10+{m.lvl}*8+({m.hurt_mod}*({m.lvl}+18)/6)+{u.gj}*8)-{o.lvl}*8-{r.o.lvl}*4-{o.recovery}*3)

    if (isset($gphurt) && $gphurt>0){
        $ghurt='-'.$gphurt;
    }else{
        $ghurt=0;
    }
    if (isset($phurt) && $phurt>0){
        $phurt='-'.$phurt;
    }else{
        $phurt=0;
    }

    if ($pvexx>0){
        $pvexx="(+".$pvexx.')';
    }else{
        $pvexx = 0;
    }    


if ($phurt<$npc->nattack*0.15){
    $phurt = round($npc->nattack*0.15);
}


$ran_2 = mt_rand(1,10);
$gphurt = round($player->ugj - ($npc->nrecovery * 0.75),0) + $ran_2;
if ($gphurt < $player->ugj*0.15){
    $gphurt = round( $player->ugj * 0.15);
}
$pvexx = ceil($gphurt * ($player->uxx/100) );


if ($phurt <= 0){
    $hurt = true;
}


if ($phurt < $pvexx){
    $pvexx = $phurt - 7;


    if ($pvexx<0){
        $pvexx = 0;
    }
}



    $pzssh = $phurt - $pvexx;
    $sql = "update game1 set uhp = uhp - $pzssh  WHERE sid = '$sid'";
    $dblj->exec($sql);
    $player =  player\getplayer($sid,$dblj);
    if ($player->uhp <= 0){
        $zdjg = 0;
    }




