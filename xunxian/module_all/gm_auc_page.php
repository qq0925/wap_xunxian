<?php
$player = \player\getplayer($sid,$dblj);
$area_id = \player\getmid($player->nowmid,$dblj)->marea_id;
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid = $cmid + 1;
$cdid[] = $cmid;
$clj[] = $cmd;
$gohelp = $encode->encode("cmd=auc_page&help=1&ucmd=$cmid&sid=$sid");

$payhtml='';
if (!isset($yeshu)){
    $yeshu = 0;
}
if (!isset($auc)){

$goequipb = $encode->encode("cmd=auc_page&auc=equipb&ucmd=$cmid&sid=$sid");
$goequipf = $encode->encode("cmd=auc_page&auc=equipf&ucmd=$cmid&sid=$sid");
$godimond = $encode->encode("cmd=auc_page&auc=dimond&ucmd=$cmid&sid=$sid");
$gobook = $encode->encode("cmd=auc_page&auc=book&ucmd=$cmid&sid=$sid");
$gocons = $encode->encode("cmd=auc_page&auc=cons&ucmd=$cmid&sid=$sid");
$gomater = $encode->encode("cmd=auc_page&auc=mater&ucmd=$cmid&sid=$sid");
$goother = $encode->encode("cmd=auc_page&auc=other&ucmd=$cmid&sid=$sid");
$payhtml = <<<HTML
[信用币拍卖]<a href="?cmd=$gohelp">(?)</a><br/>
<a href="?cmd=$goequipb">武器类</a>|<a href="?cmd=$goequipf">防具类</a><br/>
<a href="?cmd=$godimond">宝石类</a>|<a href="?cmd=$gobook">书籍类</a><br/>
<a href="?cmd=$gocons">药品类</a>|<a href="?cmd=$gomater">材料类</a><br/>
<a href="?cmd=$goother">其它物品</a><br/>
---------<br/>
<a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
}
switch ($auc){
    case "cons":
        if (isset($canshu)){
            if ($canshu == "buy"){
                $fsdj = \player\getauc_once("cons",$payid,$dblj);
                try{
                    if (!$fsdj){
                        throw new PDOException("道具已经卖光了<br/>");//那个错误抛出异常
                    }
                    $playerdj = \player\getplayerdaoju($sid,$fsdj->djid,$dblj);
                    if ($playerdj){
                        $pdjcount = $playerdj->djsum;
                    }
                    $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
                    $dblj->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
                    $dblj->beginTransaction();
                    $price = $buycount * $fsdj->pay;
                    $sql = "update `game1` set uyxb = uyxb - $price WHERE uyxb >= $price AND sid='$sid'";
                    $affected_rows=$dblj->exec($sql);
                    if(!$affected_rows && $price>0)
                        throw new PDOException("灵石不足<br/>");//那个错误抛出异常

                    $sql = "update `auc_dj` set djcount = djcount - $buycount WHERE djcount >= $buycount and payid = $payid";
                    $affected_rows=$dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("坊市中该道具数来不足<br/>");//那个错误抛出异常

                    $sql = "update `game1` set uyxb = uyxb + {$price} WHERE uid = {$fsdj->uid}";
                    $affected_rows=$dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("挂出该道具的修士未收到灵石<br/>");//那个错误抛出异常
                    $djsum = $pdjcount + $buycount;
                    $sql = "replace into `playerdaoju`(djname,djsum,uid,sid,djid,djinfo) VALUES('$fsdj->djname','$djsum','$player->uid','$sid',$fsdj->djid,'$fsdj->djinfo')";
                    $affected_rows=$dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("传送阵在传送道具的时候传送失败<br/>");//那个错误抛出异常
                    echo "交易成功！<br/>";
                    $dblj->commit();//交易成功就提交

                }catch (PDOException $e){
                    echo $e->getMessage();
                    $dblj->rollBack();
                }
                $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);//关闭
                $sql="delete from `auc_dj` where djcount = 0";
                $dblj->exec($sql);
                \player\changerwyq1(1,$fsdj->djid,1,$sid,$dblj);
            }
            elseif ($canshu == "look") {
$auc_dj = \player\getauc_once("cons",$auc_id,$dblj);
$auc_name = $auc_dj['auc_item_name'];
$auc_item_id = $auc_dj['auc_item_id'];
$auc_desc = \player\getitem($auc_item_id,$dblj)->idesc;
$retlast = $encode->encode("cmd=auc_page&auc=$auc&sid=$sid");
$payhtml = <<<HTML
<a href="?cmd=$retlast">返回上级</a><br/>
[{$auc_name}]<br/>
[拍卖物品图片]<br/>
{$auc_desc}<br/>
拍卖物品起拍价<br/>
拍卖物品当前最高价<br/>
拍卖物品人：<a href="?cmd=$auc_sale_id">{}</a><br/>
出售剩余时间（秒）<br/>
<a href="?cmd=$offer">出价</a><br/>
<a href="?cmd=$retlast">返回上级</a>
HTML;

            }
        }
        else{
        $fsdjall = \player\getauc_city($dblj,$area_id);
        foreach ($fsdjall as $fsdj){
            $auc_id = $fsdj['auc_id'];
            $djid = $fsdj['auc_item_id'];
            $djname = $fsdj['auc_item_name'];
            $djcount = $fsdj['auc_count'];
            $djsale_id = $fsdj['auc_sale_id'];
            $djpay = $fsdj['auc_now_value'];
            $djpaycmd = $encode->encode("cmd=auc_page&canshu=look&auc=$auc&auc_id=$auc_id&djid=$djid&sid=$sid");
            $payhtml .= "<a href='?cmd=$djpaycmd'>{$djname}x$djcount</a>单价:{$djpay}<br/>";
        }
if($payhtml ==''){
$payhtml = "此类物品已经全部出售！<br/>";
}
$retpaimai = $encode->encode("cmd=auc_page&ucmd=$cmid&sid=$sid");
$payhtml=<<<HTML
【药品】<br/>
$payhtml
<a href='?cmd=$retpaimai'>返回拍卖界面</a><br/>
<a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
}
        break;
    case "equipb":
        if (isset($canshu)){
            if ($canshu == "buy"){
                try{
                    $fszb = \player\getauc_once("equipb",$payid,$dblj);

                    if (!$fszb){
                        echo "装备已经被卖出了<br/>";//那个错误抛出异常
                    }
                    $pay = $fszb->pay;
                    $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
                    $dblj->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
                    $dblj->beginTransaction();
                    $sql = "update `game1` set uyxb = uyxb - $pay WHERE uyxb >= $pay AND sid='$sid'";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows && $pay>0)
                        throw new PDOException("灵石不足<br/>");//那个错误抛出异常

//                    -------------------------------------------------------------------------------
                    $sql = "delete from `auc_zb` WHERE payid=$payid";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("装备出货失败<br/>");//那个错误抛出异常

//                    -------------------------------------------------------------------------------
                    $sql = "update `game1` set uyxb = uyxb+ $pay WHERE uid=$fszb->uid";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows && $pay>0)
                        throw new PDOException("挂出该装备的修士未收到灵石<br/>");//那个错误抛出异常

//                    -------------------------------------------------------------------------------
                    $sql = "update `playerzhuangbei` set sid = '$sid',uid=$player->uid WHERE zbnowid=$fszb->zbnowid";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("装备传送失败<br/>");//那个错误抛出异常
                    echo "交易成功！<br/>";
                    $dblj->commit();//交易成功就提交
                }catch (PDOException $e){
                    echo $e->getMessage();
                    $dblj->rollBack();
                }
                $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);

            }
        }
        $fsdjall = \player\getauc_city($dblj,$area_id);
        foreach ($fsdjall as $fsdj){
            $auc_id = $fsdj['auc_id'];
            $djid = $fsdj['auc_item_id'];
            $djname = $fsdj['auc_item_name'];
            $djcount = $fsdj['auc_count'];
            $djsale_id = $fsdj['auc_sale_id'];
            $djpay = $fsdj['auc_now_value'];
            $djpaycmd = $encode->encode("cmd=auc_page&auc_id=$auc_id&djid=$djid&sid=$sid");
            $payhtml .= "<a href='?cmd=$djpaycmd'>{$djname}x$djcount</a>单价:{$djpay}<br/>";
        }
$retpaimai = $encode->encode("cmd=auc_page&ucmd=$cmid&sid=$sid");
if($payhtml ==''){
$payhtml = "此类物品已经全部出售！<br/>";
}
$payhtml=<<<HTML
【武器】<br/>
$payhtml
<a href='?cmd=$retpaimai'>返回拍卖界面</a><br/>
<a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
        break;
    case "equipf":
        if (isset($canshu)){
            if ($canshu == "buy"){
                try{
                    $fszb = \player\getauc_once("equipb",$payid,$dblj);

                    if (!$fszb){
                        echo "装备已经被卖出了<br/>";//那个错误抛出异常
                    }
                    $pay = $fszb->pay;
                    $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
                    $dblj->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
                    $dblj->beginTransaction();
                    $sql = "update `game1` set uyxb = uyxb - $pay WHERE uyxb >= $pay AND sid='$sid'";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows && $pay>0)
                        throw new PDOException("灵石不足<br/>");//那个错误抛出异常

//                    -------------------------------------------------------------------------------
                    $sql = "delete from `auc_zb` WHERE payid=$payid";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("装备出货失败<br/>");//那个错误抛出异常

//                    -------------------------------------------------------------------------------
                    $sql = "update `game1` set uyxb = uyxb+ $pay WHERE uid=$fszb->uid";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows && $pay>0)
                        throw new PDOException("挂出该装备的修士未收到灵石<br/>");//那个错误抛出异常

//                    -------------------------------------------------------------------------------
                    $sql = "update `playerzhuangbei` set sid = '$sid',uid=$player->uid WHERE zbnowid=$fszb->zbnowid";
                    $affected_rows = $dblj->exec($sql);
                    if(!$affected_rows)
                        throw new PDOException("装备传送失败<br/>");//那个错误抛出异常
                    echo "交易成功！<br/>";
                    $dblj->commit();//交易成功就提交
                }catch (PDOException $e){
                    echo $e->getMessage();
                    $dblj->rollBack();
                }
                $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);

            }
        }
        $fsdjall = \player\getauc_city($dblj,$area_id);
        foreach ($fsdjall as $fsdj){
            $auc_id = $fsdj['auc_id'];
            $djid = $fsdj['auc_item_id'];
            $djname = $fsdj['auc_item_name'];
            $djcount = $fsdj['auc_count'];
            $djsale_id = $fsdj['auc_sale_id'];
            $djpay = $fsdj['auc_now_value'];
            $djpaycmd = $encode->encode("cmd=auc_page&auc_id=$auc_id&djid=$djid&sid=$sid");
            $payhtml .= "<a href='?cmd=$djpaycmd'>{$djname}x$djcount</a>单价:{$djpay}<br/>";
        }
$retpaimai = $encode->encode("cmd=auc_page&ucmd=$cmid&sid=$sid");
$payhtml=<<<HTML
【防具】<br/>
$payhtml
<a href='?cmd=$retpaimai'>返回拍卖界面</a><br/>
<a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
        break;
}

if($help ==1){
$retpaimai = $encode->encode("cmd=auc_page&ucmd=$cmid&sid=$sid");
$payhtml = <<<HTML
[拍卖系统帮助]<br/>
1.每人最多同时拍卖10件物品。<br/>
2.拍卖天数最少1天最多10天，拍卖手续费计算规则:拍卖天数x拍卖物品价格的2%，请谨慎设定拍卖价格和天数。<br/>
3.拍卖期间你的物品会被封存，若拍卖时间已过无人购买，则会将你的物品存至寄存处，请及时领取未成功拍卖的物品。<br/>
4.如果有人购买你的物品，你会在交易完成的时候（物品完成转移后）收到费用，在拍卖行寄存处领取。<br/>
5.拍卖行最多保存一个月未拍卖物品以及所得货币，未及时领取后果自负。<br/>
<a href='?cmd=$retpaimai'>返回拍卖界面</a><br/>
<a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
}

echo $payhtml;
?>