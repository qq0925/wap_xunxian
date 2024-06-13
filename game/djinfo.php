<?php
$gonowmid = $encode->encode("cmd=gomid&newmid=$player->nowmid&sid=$sid");
$ydaoju = \player\getdaoju($djid,$dblj);
$daoju = \player\getdaoju($djid,$dblj);
$chushou = $encode->encode("cmd=djinfo&canshu=chushou&djid=$djid&sid=$sid");
$daoju = \player\getplayerdaoju($sid,$djid,$dblj);
$player = \player\getplayer($sid,$dblj);
$djhtml = '';
if ($daoju){
    $self = $_SERVER['PHP_SELF'];
    $djhtml =<<<HTML
    <br/>
    <form action="$self">
    <input type="hidden" name="cmd" value="djinfo">
    <input type="hidden" name="canshu" value="chushou">
    <input type="hidden" name="sid" value='$sid'>
    <input type="hidden" name="djid" value="$djid">
    出售数量：<br/>
    <input type="number" name="djcount"><br/>
    出售单价：<br/>
    <input type="number" name="pay"> 
    <input type="submit" value="出售">
    </form>
HTML;

}
if(isset($canshu))
    if ($canshu == "chushou"){
        try{
            $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
            $dblj->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
            $dblj->beginTransaction();
            $sql = "update `playerdaoju` set djsum= djsum - $djcount WHERE djid = $djid AND djsum >= $djcount AND uid = $player->uid AND sid='$sid'";
            $affected_rows=$dblj->exec($sql);
            if (!$affected_rows){
                throw new PDOException("你身上的道具不足<br/>");//那个错误抛出异常
            }
            $sql = "insert into `fangshi_dj`(djid,djcount,uid,pay,djname,djinfo) VALUES ($djid,$djcount,$player->uid,$pay,'$daoju->djname','$daoju->djinfo')";
            $affected_rows=$dblj->exec($sql);
            if (!$affected_rows){
                throw new PDOException("出售失败<br/>");//那个错误抛出异常
            }
            echo "出售成功！<br/>";
            $dblj->commit();//交易成功就提交
        }catch (PDOException $e){
            echo $e->getMessage();
            $dblj->rollBack();
        }
        $dblj->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);//关闭
        $daoju = \player\getplayerdaoju($sid,$djid,$dblj);
        \player\changerwyq1(1,$djid,1,$sid,$dblj);
    }
    
    

?>

道具名称：<?php echo $ydaoju->djname; ?><br/>
<?php
    if ($daoju) {
        echo "道具数量:$daoju->djsum<br/>";
    }
?>
道具价格：<?php echo $ydaoju->djyxb;?>灵石<br/>
道具说明：<br/>
<?php echo $ydaoju->djinfo; ?>
<br/>
<?php echo $djhtml; ?>
<br/>
<button onClick="javascript:history.back(-1);">返回上一页</button><br/>
<a href="?cmd=<?php echo $gonowmid; ?>">返回游戏</a><br/>


