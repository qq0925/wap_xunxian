<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/24 0024
 * Time: 12:59
 */
$player = \player\getplayer($sid,$dblj);
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$payhtml='';
$pdjcount = 0;
if (!isset($yeshu)){
    $yeshu = 0;
}
if (!isset($fangshi)){
    exit("<a href='?cmd=$gonowmid'>返回游戏</a>");
}
switch ($fangshi){
    case "daoju":
        
        if (isset($canshu)){
            if ($canshu == "buy"){
                $fsdj = \player\getfangshi_once("daoju",$payid,$dblj);
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

                    $sql = "update `fangshi_dj` set djcount = djcount - $buycount WHERE djcount >= $buycount and payid = $payid";
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
                $sql="delete from `fangshi_dj` where djcount = 0";
                $dblj->exec($sql);
                \player\changerwyq1(1,$fsdj->djid,1,$sid,$dblj);
            }
        }
        $fsdjall = \player\getfangshi_all($fangshi,$dblj);
        foreach ($fsdjall as $fsdj){
            $djid = $fsdj['djid'];
            $djname = $fsdj['djname'];
            $djpay = $fsdj['pay'];
            $djcount = $fsdj['djcount'];
            $payid = $fsdj['payid'];
            $goumaidj1 = $encode->encode("cmd=fangshi&fangshi=daoju&canshu=buy&payid=$payid&buycount=1&sid=$sid");
            $goumaidj5 = $encode->encode("cmd=fangshi&fangshi=daoju&canshu=buy&payid=$payid&buycount=5&sid=$sid");
            $goumaidj10 = $encode->encode("cmd=fangshi&fangshi=daoju&canshu=buy&payid=$payid&buycount=10&sid=$sid");
            $djpaycmd = $encode->encode("cmd=djinfo&djid=$djid&sid=$sid");
            $payhtml .= "<a href='?cmd=$djpaycmd'>{$djname}x$djcount</a>单价:$djpay<a href='?cmd=$goumaidj1'>购买1</a><a href='?cmd=$goumaidj5'>购买5</a> <a href='?cmd=$goumaidj10'>购买10</a><br/>";
        }
        $zhuangbei = $encode->encode("cmd=fangshi&fangshi=zhuangbei&sid=$sid");
        $payhtml=<<<HTML
            【道具|<a href="?cmd=$zhuangbei">装备</a>】<br/>
            $payhtml
            <br/><a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
        break;
    
    
    case "zhuangbei":
        if (isset($canshu)){
            if ($canshu == "buy"){
                try{
                    $fszb = \player\getfangshi_once("zhuangbei",$payid,$dblj);

                    if (!$fszb){
                        echo "装备已经被卖出了<br/>";//那个错误抛出异常
                        goto fszblist;
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
                    $sql = "delete from `fangshi_zb` WHERE payid=$payid";
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
        fszblist:
        $fsdjall = \player\getfangshi_all($fangshi,$dblj);
        foreach ($fsdjall as $fsdj){
            $zbnowid = $fsdj['zbnowid'];
            $zbname = $fsdj['zbname'];
            $zbqh = $fsdj['qianghua'];
            $zbpay = $fsdj['pay'];
            $payid = $fsdj['payid'];
            if ($zbqh){
                $zbqh = '+'.$zbqh;
            }else{
                $zbqh='';
            }
            $goumaizb = $encode->encode("cmd=fangshi&fangshi=zhuangbei&canshu=buy&payid=$payid&sid=$sid");
            $zbpaycmd = $encode->encode("cmd=zbinfo&zbnowid=$zbnowid&sid=$sid");
            $payhtml .= "<a href='?cmd=$zbpaycmd'>{$zbname}{$zbqh}</a>价格:$zbpay<a href='?cmd=$goumaizb'>购买</a><br/>";
        }
        $fangshi = $encode->encode("cmd=fangshi&fangshi=daoju&sid=$sid");
        $payhtml=<<<HTML
            【<a href="?cmd=$fangshi">道具</a>|装备】<br/>
            $payhtml
            <br/>
            <a href='?cmd=$gonowmid'>返回游戏</a><br/>
HTML;
        break;
}


echo $payhtml;