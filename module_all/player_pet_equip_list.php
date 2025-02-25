<?php


$pet_arr = \player\getpet_once($sid,$dblj,$pet_id);
$pet_name = $pet_arr['nname'];



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
$equipitem = $encode->encode("cmd=equip_op_basic&eq_type=1&pet_id=$pet_id&target_event=choose&ucmd=$cmid&sid=$sid");
$equipbhtml = "无<a href='?cmd=$equipitem'>[装备]</a>";
if ($equipbid) {
    $sql = "select * from system_item_module where iid = (select iid from system_item where item_true_id = '$equipbid')";
    $cxjg = $dblj->query($sql);
    if ($cxjg) {
        $row = $cxjg->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $equipbname = \lexical_analysis\color_string($row['iname']);
            $removeitem = $encode->encode("cmd=equip_op_basic&pet_id=$pet_id&target_event=remove&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
            $ckequipbinfo = $encode->encode("cmd=equip_html&pet_id=$pet_id&ucmd=$cmid&equip_true_id=$equipbid&sid=$sid");
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
            $removeitem = $encode->encode("cmd=equip_op_basic&pet_id=$pet_id&target_event=remove&ucmd=$cmid&equip_true_id=$equipfid&sid=$sid");
            $ckequipfinfo = $encode->encode("cmd=equip_html&pet_id=$pet_id&ucmd=$cmid&equip_true_id=$equipfid&sid=$sid");
            $equipfhtml .= "{$equiptypename}：<a href='?cmd=$ckequipfinfo'>{$equipfname}</a><a href='?cmd=$removeitem'>[卸下]</a><br/>";
        }else{
            $equipitem = $encode->encode("cmd=equip_op_basic&pet_id=$pet_id&eq_type=2&equip_typename=$equiptypename&eq_subtype=$equiptypeid&target_event=choose&ucmd=$cmid&sid=$sid");
            $equipfhtml .= "{$equiptypename}：无<a href='?cmd=$equipitem'>[装备]</a><br/>";
        }
    }
}
$ret_pet = $encode->encode("cmd=player_petinfo&pet_id=$pet_id&ucmd=$cmid&sid=$sid");
$bagequiphtml = <<<HTML
[{$pet_name}目前身上的装备]：<br/>
兵器：{$equipbhtml}<br/>
$equipfhtml
<a href="?cmd=$ret_pet">返回宠物</a><br/>
HTML;
echo $bagequiphtml;

?>