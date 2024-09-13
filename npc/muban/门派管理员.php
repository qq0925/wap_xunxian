<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/26 0026
 * Time: 19:06
 */
$newclub =$encode->encode("cmd=npc&nid=$nid&canshu=newclub&sid=$sid");
$player = \player\getplayer($sid,$dblj);
$gnhtml =<<<HTML
=======门派创建=======<br/>
天地不仁&nbsp;&nbsp;修道即修盗<br/>
大道不止&nbsp;&nbsp;大盗路不止<br/>
想要盗出仙路&nbsp;&nbsp;一人..太难..<br/>
<a href="?cmd=$newclub" >创建门派</a><br/>
HTML;
$clubplayer = \player\getclubplayer_once($sid,$dblj);
if (isset($canshu)){
    switch ($canshu){
        case "newclub":
            if ($clubplayer){
                $gnhtml= "<br/>你已经有门派了<br/>";
                break;
            }
            $club_post = $encode->encode("cmd=npc&sid=$sid");
            $gnhtml=<<<HTML
<form action="?cmd=$club_post" method="post">
<input type="hidden" name="nid" value="$nid">
<input type="hidden" name="sid" value="$sid">
<input type="hidden" name="canshu" value="addclub">
门派大名:<input name="clubname"><br/>
门派说明:<textarea name="clubinfo" style="height: 80px"></textarea>
<br/>
<input type="submit" value="创建">
</form>
HTML;
            break;
        case "addclub":
            if ($clubplayer){
                $gnhtml= "<br/>你已经有门派了<br/>";
                break;
            }

            $clubname = htmlspecialchars($clubname);
            $clubinfo = htmlspecialchars($clubinfo);
            if (strlen($clubname)<6 || strlen($clubname)>12){
                $gnhtml = "<br/>名称过长或过短<br/>要求：大于2个汉字小于4个字符。<br/>";
                break;
            }
            $sql = "insert into club(clubname, clubinfo, clublv, clubexp, clubno1) VALUES (?,?,?,?,?)";
            $stmt = $dblj->prepare($sql);
            $stmt->execute(array($clubname,$clubinfo,1,0,$player->uid));
            $clubid = $dblj->lastInsertId();

            $sql = "insert into clubplayer(clubid, uid, sid, uclv) VALUES (?,?,?,?)";
            $stmt = $dblj->prepare($sql);
            $stmt->execute(array($clubid,$player->uid,$sid,1));

            $clubcmd = $encode->encode("cmd=club&sid=$sid");
            $gnhtml.= "<br/>门派创建成功<br/><a href='?cmd=$clubcmd'>点击进入</a>";
            break;
    }
}

?>

