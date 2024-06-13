<?php

$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$zhuangbei = new \player\zhuangbei();
if ($zbnowid!=0){
    $zhuangbei = player\getzb($zbnowid,$dblj);
}

$arr = array($player->tool1,$player->tool2,$player->tool3,$player->tool4,$player->tool5,$player->tool6);
$setzbwz='';
$upgj = '';
$upfy = '';
$uphp = '';
$upbj = '';
$upxx = '';
$upts = '';
$qhssum = '';
$upls = round($zhuangbei->qianghua/2) * round($zhuangbei->qianghua/3) * 2 * (round($zhuangbei->qianghua / 4) )+ 1;

if (isset($canshu)){
    if ($canshu == "chushou" && !in_array($zhuangbei->zbnowid,$arr) && isset($pay) && $pay > 0){
        try {

            $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
            $dblj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dblj->beginTransaction();

            $sql = "insert into `fangshi_zb`(zbname, zbinfo, zbgj, zbfy, zbbj, zbxx, zbid, uid, zbnowid, sid, zbhp, qianghua, zblv, pay) VALUES ('$zhuangbei->zbname','$zhuangbei->zbinfo','$zhuangbei->zbgj','$zhuangbei->zbfy','$zhuangbei->zbbj','$zhuangbei->zbxx','$zhuangbei->zbid','$player->uid','$zbnowid','$sid','$zhuangbei->zbhp','$zhuangbei->qianghua','$zhuangbei->zblv','$pay')";
            $affected_rows = $dblj->exec($sql);
            if (!$affected_rows){
                throw new PDOException("装备挂售失败<br/>");//那个错误抛出异常
            }
            $sql="UPDATE `playerzhuangbei` SET uid=0,sid='' WHERE zbnowid = $zbnowid";
            $affected_rows=$dblj->exec($sql);
            if (!$affected_rows){
                throw new PDOException("装备传送失败<br/>");//那个错误抛出异常
            }
            echo "挂售成功！<br/>";
            $dblj->commit();//交易成功就提交
        }catch(PDOException $e){
            echo $e->getMessage();
            $dblj->rollBack();
        }
        $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);//关闭
        $zhuangbei = player\getzb($zbnowid,$dblj);
    }
}


if ($player->uid == $zhuangbei->uid){
    $uyxb = '/'.$player->uyxb;
    if ($cmd=='upzb'){
        if ($player->uyxb >=$upls){
            $ret = \player\upzbsx($zbnowid,$upsx,$sid,$dblj);
            if ($ret != -1){
                $retyxb = \player\changeyxb(2,$upls,$sid,$dblj);
                if ($ret==1){
                    $upts = "恭喜强化成功<br/>";
                }elseif ($ret==0){
                    $upts = "强化失败，请攒积人品<br/>";
                }
                $zhuangbei = \player\getzb($zbnowid,$dblj);

            }else{
                $upts = "强化失败，强化石不足<br/>";
            }
        }else{
            $upts = "强化失败，灵石不足<br/>";
        }
    }
    $upgj = $encode->encode("cmd=upzb&upsx=zbgj&zbnowid=$zhuangbei->zbnowid&sid=$sid");
    $upfy = $encode->encode("cmd=upzb&upsx=zbfy&zbnowid=$zhuangbei->zbnowid&sid=$sid");
    $uphp = $encode->encode("cmd=upzb&upsx=zbhp&zbnowid=$zhuangbei->zbnowid&sid=$sid");
//    $upbj = $encode->encode("cmd=upzb&upsx=zbbj&zbnowid=$zhuangbei->zbnowid&sid=$sid");
//    $upxx = $encode->encode("cmd=upzb&upsx=zbxx&zbnowid=$zhuangbei->zbnowid&sid=$sid");
    $daoju = player\getplayerdaoju($sid,1,$dblj);
    $qhssum = '/0';
    if ($daoju){
        $qhssum = '/'.$daoju->djsum;
    }

    $upgj =<<<HTML
    <a href="?cmd=$upgj">强化攻击</a>
HTML;
    $upfy =<<<HTML
    <a href="?cmd=$upfy">强化防御</a>
HTML;
    $uphp =<<<HTML
    <a href="?cmd=$uphp">强化气血</a>
HTML;
    $upbj =<<<HTML
    <a href="?cmd=$upbj">强化暴击</a>
HTML;
    $upxx =<<<HTML
    <a href="?cmd=$upxx">强化吸血</a>
HTML;
}else{
    $uyxb='';
}

if ($player->uid == $zhuangbei->uid && !in_array($zhuangbei->zbnowid,$arr)){

    $player = \player\getplayer($sid,$dblj);
    $delezb = $encode->encode("cmd=delezb&zbnowid=$zhuangbei->zbnowid&sid=$sid");
    $self = $_SERVER['PHP_SELF'];
    $setzbwz = $encode->encode("cmd=setzbwz&zbwz={$zhuangbei->tool}&zbnowid=$zhuangbei->zbnowid&sid=$sid");
    $setzbwz = "<a href='?cmd=$setzbwz'>穿戴装备</a><br/>";

    if ($zhuangbei->tool == 0){
        $setzbwz1 = $encode->encode("cmd=setzbwz&zbwz=1&zbnowid=$zhuangbei->zbnowid&sid=$sid");
        $setzbwz2 = $encode->encode("cmd=setzbwz&zbwz=2&zbnowid=$zhuangbei->zbnowid&sid=$sid");
        $setzbwz3 = $encode->encode("cmd=setzbwz&zbwz=3&zbnowid=$zhuangbei->zbnowid&sid=$sid");
        $setzbwz4 = $encode->encode("cmd=setzbwz&zbwz=4&zbnowid=$zhuangbei->zbnowid&sid=$sid");
        $setzbwz5 = $encode->encode("cmd=setzbwz&zbwz=5&zbnowid=$zhuangbei->zbnowid&sid=$sid");
        $setzbwz6 = $encode->encode("cmd=setzbwz&zbwz=6&zbnowid=$zhuangbei->zbnowid&sid=$sid");

        $setzbwz = "
    <a href='?cmd=$setzbwz1'>装备在【武器】位置</a>
    <a href='?cmd=$setzbwz2'>装备在【头饰】位置</a><br/>
    <a href='?cmd=$setzbwz3'>装备在【衣服】位置</a>
    <a href='?cmd=$setzbwz4'>装备在【腰带】位置</a><br/>
    <a href='?cmd=$setzbwz5'>装备在【首饰】位置</a>
    <a href='?cmd=$setzbwz6'>装备在【鞋子】位置</a><br/>";
    }

    $setzbwz .=<<<HTML
    <br/>
    <a href="?cmd=$delezb">分解该装备</a>
    <br/>
    <form action="$self">
    <input type="hidden" name="cmd" value="chakanzb">
    <input type="hidden" name="canshu" value="chushou">
    <input type="hidden" name="sid" value='$sid'>
    <input type="hidden" name="zbnowid" value="$zhuangbei->zbnowid">
    挂售单价：<br/>
    <input type="number" name="pay"> 
    <input type="submit" value="挂售">
    </form>
HTML;
}
$updjsl = $zhuangbei->qianghua * 3 + 1;
$upls = round($zhuangbei->qianghua/2) * round($zhuangbei->qianghua/3) * 2 * (round($zhuangbei->qianghua / 4) )+ 1;
$fjls = $zhuangbei->qianghua * 20 + 20;
$qianghua = '';
if ($zhuangbei->qianghua>0){
    $qianghua="+".$zhuangbei->qianghua;
}

$qhcgl = round((30-$zhuangbei->qianghua)/30,2) * 100;
$qhcgl .='%';
$tools = array("不限定","武器","头饰","衣服","腰带","首饰","鞋子");
$tool = $tools[$zhuangbei->tool];


$html = <<<HTML
装备名称:$zhuangbei->zbname$qianghua<br/>
装备位置:$tool<br/>
装备等级:$zhuangbei->zblv<br/>
装备攻击:$zhuangbei->zbgj$upgj<br/>
装备防御:$zhuangbei->zbfy$upfy<br/>
增加气血:$zhuangbei->zbhp$uphp<br/>
装备暴击:$zhuangbei->zbbj%<br/>
装备吸血:$zhuangbei->zbxx%<br/>
装备信息:$zhuangbei->zbinfo<br/><br/>
强化成功率：$qhcgl<br/>
强化需要强化石：$updjsl$qhssum<br/>
强化需要灵石：$upls$uyxb<br/>
分解需要灵石：$fjls$uyxb<br/>
$upts
$setzbwz
<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;
echo $html;
?>