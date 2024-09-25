<?php
// require_once 'class/lexical_analysis.php';
$player = new \player\player();
$player = \player\getplayer($sid, $dblj);

$sql = "select * from system_equip_def where type = '1'";
$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetchAll(PDO::FETCH_ASSOC) : [];

$equipbid = null;
foreach ($ret as $row) {
    $equiptypeid = $row['id'];
    $equiptypename = $row['name'];
    $sql = "select * from system_equip_user where eq_type = 1 and equiped_pos_id = '$equiptypeid' and eqsid = '$sid'";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipbid = $row['eq_true_id'];
            break;
        }
    }
}
$equipitem = $encode->encode("cmd=equip_op_basic&eq_type=1&target_event=choose&ucmd=$cmid&sid=$sid");
$equipbhtml = "无<a href='?cmd=$equipitem'>[装备]</a>";
if ($equipbid) {
    $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equipbid')";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipbname = \lexical_analysis\color_string($row['iname']);
            $removeitem = $encode->encode("cmd=equip_op_basic&target_event=remove&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
            $ckequipbinfo = $encode->encode("cmd=equip_html&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
            $equipbhtml = "<a href='?cmd=$ckequipbinfo'>{$equipbname}</a><a href='?cmd=$removeitem'>[卸下]</a>";
        }
    }
}

$sql = "select * from system_equip_def WHERE type = 2";
$cxjg = $dblj->query($sql);
$ret = $cxjg ? $cxjg->fetchAll(PDO::FETCH_ASSOC) : [];

$equipfhtml = '';
foreach ($ret as $row) {
    $equiptypeid = $row['id'];
    $equiptypename = $row['name'];
    $sql = "select * from system_equip_user where eq_type = 2 and equiped_pos_id = '$equiptypeid' and eqsid = '$sid'";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipfid = $row['eq_true_id'];
            if ($equipfid) {
                $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equipfid')";
                $cxjg = $dblj->query($sql);
                if ($cxjg) {
                    $row = $cxjg->fetch(PDO::FETCH_ASSOC);
                    if ($row) {
                        $equipfname = \lexical_analysis\color_string($row['iname']);
                    }
                }
            }
            $removeitem = $encode->encode("cmd=equip_op_basic&target_event=remove&ucmd=$cmid&equip_true_id=$equipfid&sid=$sid");
            $ckequipfinfo = $encode->encode("cmd=equip_html&ucmd=$cmid&equip_true_id=$equipfid&sid=$sid");
            $equipfhtml .= "{$equiptypename}：<a href='?cmd=$ckequipfinfo'>{$equipfname}</a><a href='?cmd=$removeitem'>[卸下]</a><br/>";
        }else{
            $equipitem = $encode->encode("cmd=equip_op_basic&eq_type=2&equip_typename=$equiptypename&eq_subtype=$equiptypeid&target_event=choose&ucmd=$cmid&sid=$sid");
            $equipfhtml .= "{$equiptypename}：无<a href='?cmd=$equipitem'>[装备]</a><br/>";
        }
    }
}

$cmid++;
$cdid[] = $cmid;
$gonowmid = $encode->encode("cmd=gm_scene_new&ucmd=$cmid&sid=$sid");
$cmid++;
$cdid[] = $cmid;
$player_state = $encode->encode("cmd=player_state&ucmd=$cmid&sid=$sid");
$cmid++;
$cdid[] = $cmid;
$item_url = $encode->encode("cmd=item_html&canshu=全部&ucmd=$cmid&sid=$sid");

$bagequiphtml = <<<HTML
【我的装备】<br/>
兵器：{$equipbhtml}<br/>
$equipfhtml
<br/>
<a href="?cmd=$player_state">我的状态</a><br/>
<a href="?cmd=$item_url">我的物品</a><br/>
<a href="?cmd=$gonowmid">返回游戏</a>
HTML;

echo $bagequiphtml;

?>