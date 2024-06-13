<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/11
 * Time: 18:54
 */
$jineng = \player\getjineng_once($jnid,$dblj);
$duihuan = $encode->encode("cmd=jninfo&canshu=duihuan&jnid=$jnid&sid=$sid");
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$htmltishi = '';
$playerjn = \player\getplayerjineng($jnid,$sid,$dblj);

$daoju = \player\getplayerdaoju($sid,$jineng->jndj,$dblj);
$dhdaoju = \player\getdaoju($jineng->jndj,$dblj);
if (!$daoju){
    $daoju = \player\getdaoju($jineng->jndj,$dblj);
    $daoju->djsum = 0;
}

if (isset($canshu)){
    switch ($canshu){
        case 'duihuan':
            $ret = \player\deledjsum($jineng->jndj,$jineng->djcount,$sid,$dblj);
            if ($ret){
                \player\addjineng($jnid,1,$sid,$dblj);
                $htmltishi = "兑换成功<br/>";
                $playerjn = \player\getplayerjineng($jnid,$sid,$dblj);
                $daoju = \player\getplayerdaoju($sid,$jineng->jndj,$dblj);
            }else{
                $htmltishi = "道具数量不足<br/>";
            }

            break;
        case 'setjn1':
            \player\changeplayersx('jn1',$jnid,$sid,$dblj);
            $htmltishi = "设置符箓1成功<br/>";
            break;
        case 'setjn2':
            \player\changeplayersx('jn2',$jnid,$sid,$dblj);
            $htmltishi = "设置符箓2成功<br/>";
            break;
        case 'setjn3':
            \player\changeplayersx('jn3',$jnid,$sid,$dblj);
            $htmltishi = "设置符箓3成功<br/>";
            break;
    }


}

$dhhtml = "兑换需要：$dhdaoju->djname($daoju->djsum/$jineng->djcount)<a href='?cmd=$duihuan'>兑换<a/><br/><br/>";
if ($playerjn){
    $setjn1 = $encode->encode("cmd=jninfo&canshu=setjn1&jnid=$jnid&sid=$sid");
    $setjn2 = $encode->encode("cmd=jninfo&canshu=setjn2&jnid=$jnid&sid=$sid");
    $setjn3 = $encode->encode("cmd=jninfo&canshu=setjn3&jnid=$jnid&sid=$sid");
    $dhhtml .=
        '<a href="?cmd='.$setjn1.'">装备符箓1</a>'.
        '<a href="?cmd='.$setjn2.'">装备符箓2</a>'.
        '<a href="?cmd='.$setjn3.'">装备符箓3</a><br/>';
}

?>
技能名称：<?php echo $jineng->jnname; ?><br/>
攻击加成：<?php echo $jineng->jngj; ?>%<br/>
防御加成：<?php echo $jineng->jnfy; ?>%<br/>
暴击加成：<?php echo $jineng->jnbj; ?>%<br/>
吸血加成：<?php echo $jineng->jnxx; ?>%<br/>
<?php echo $htmltishi; ?>
<?php echo $dhhtml; ?>
<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=<?php echo $gonowmid; ?>">返回游戏</a><br/>
