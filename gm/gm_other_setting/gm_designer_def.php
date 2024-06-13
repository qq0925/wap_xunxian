<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_othersetting&sid=$sid");

if($delete_id !=0){
    $sql = "update game1 set uis_designer = 0 where uid ='$delete_id'";
    $dblj->exec($sql);
    $dblj->exec("delete from system_designer_assist where sid = '$delete_sid'");
}

if(isset($_POST['add_id'])){
    $sql = "select uid,sid from game1 where uid = '$add_id'";
    $cxjg = $dblj->query($sql);
    $cxjg->bindColumn('uid',$true_id);
    $cxjg->bindColumn('sid',$true_sid);
    $ret = $cxjg->fetch(PDO::FETCH_ASSOC);
    if($ret){
    $sql = "update game1 set uis_designer = 1 where uid ='$true_id'";
    $dblj->exec($sql);
    $dblj->exec("insert into system_designer_assist(sid)value('$true_sid')");
    }else{
        echo "输入有误！<br/>";
    }
}


$add_html = <<<HTML
<form method = "post">
ID：<input type="text" name="add_id" size="10" placeholder="请输入ID">
<input name="submit" type="submit" title="添加属性" value="添加"/><br/>
</form>
HTML;
$sql = "select uname,uid,sid from game1 where uis_designer = 1";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetchAll(PDO::FETCH_ASSOC);
for($i=0;$i<@count($ret);$i++){
    $hangshu = $i +1;
    $uname = $ret[$i]['uname'];
    $uid = $ret[$i]['uid'];
    $usid = $ret[$i]['sid'];
    $delete = $encode->encode("cmd=gm_game_othersetting&canshu=2&delete_sid=$usid&delete_id=$uid&sid=$sid");
    if($uid !=1){
    $designer_detail .=<<<HTML
    <p>{$hangshu}.[{$uname}](ID:{$uid})<a href="?cmd=$delete">删除</a></p>
HTML;
}else{
    $designer_detail .=<<<HTML
    <p>{$hangshu}.[{$uname}](ID:{$uid})</p>
HTML;
}
}
$designer_html = <<<HTML
[设计者管理]<br/>
$designer_detail
$add_html<br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $designer_html;
?>