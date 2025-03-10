<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");
$map_out_ret =  \gm\get_map_out($dblj,$target_midid);
$target_midid = $map_out_ret[0]['mid'];
$map_name = \lexical_analysis\color_string($map_out_ret[0]['mname']);
$map_up = $map_out_ret[0]['mup'];
$map_down = $map_out_ret[0]['mdown'];
$map_left = $map_out_ret[0]['mleft'];
$map_right = $map_out_ret[0]['mright'];

$map_right_url = $encode->encode("cmd=gm_post_4&target_midid=$map_right&sid=$sid");
$map_down_url = $encode->encode("cmd=gm_post_4&target_midid=$map_down&sid=$sid");
$map_left_url = $encode->encode("cmd=gm_post_4&target_midid=$map_left&sid=$sid");
$map_up_url = $encode->encode("cmd=gm_post_4&target_midid=$map_up&sid=$sid");

$map_right_choose = $encode->encode("cmd=map_out_choose&target_midid=$target_midid&map_out_canshu=1&sid=$sid");
$map_down_choose = $encode->encode("cmd=map_out_choose&target_midid=$target_midid&map_out_canshu=2&sid=$sid");
$map_left_choose = $encode->encode("cmd=map_out_choose&target_midid=$target_midid&map_out_canshu=3&sid=$sid");
$map_up_choose = $encode->encode("cmd=map_out_choose&target_midid=$target_midid&map_out_canshu=4&sid=$sid");

$map_right_break = $encode->encode("cmd=map_out_choose&update_canshu=2&target_midid=$target_midid&map_out_canshu=1&sid=$sid");
$map_down_break = $encode->encode("cmd=map_out_choose&update_canshu=2&target_midid=$target_midid&map_out_canshu=2&sid=$sid");
$map_left_break = $encode->encode("cmd=map_out_choose&update_canshu=2&target_midid=$target_midid&map_out_canshu=3&sid=$sid");
$map_up_break = $encode->encode("cmd=map_out_choose&update_canshu=2&target_midid=$target_midid&map_out_canshu=4&sid=$sid");

$map_right_link = $encode->encode("cmd=map_out_choose&update_canshu=3&target_midid=$target_midid&map_out_canshu=1&sid=$sid");
$map_down_link = $encode->encode("cmd=map_out_choose&update_canshu=3&target_midid=$target_midid&map_out_canshu=2&sid=$sid");
$map_left_link = $encode->encode("cmd=map_out_choose&update_canshu=3&target_midid=$target_midid&map_out_canshu=3&sid=$sid");
$map_up_link = $encode->encode("cmd=map_out_choose&update_canshu=3&target_midid=$target_midid&map_out_canshu=4&sid=$sid");

$map_right_link_copy = $encode->encode("cmd=map_out_choose&update_canshu=4&target_midid=$target_midid&map_out_canshu=1&sid=$sid");
$map_down_link_copy = $encode->encode("cmd=map_out_choose&update_canshu=4&target_midid=$target_midid&map_out_canshu=2&sid=$sid");
$map_left_link_copy = $encode->encode("cmd=map_out_choose&update_canshu=4&target_midid=$target_midid&map_out_canshu=3&sid=$sid");
$map_up_link_copy = $encode->encode("cmd=map_out_choose&update_canshu=4&target_midid=$target_midid&map_out_canshu=4&sid=$sid");


$map_out_ret =  \gm\get_map_out($dblj,$map_up);
$map_up_name = $map_out_ret[0]['mname'];
$map_out_ret =  \gm\get_map_out($dblj,$map_down);
$map_down_name = $map_out_ret[0]['mname'];
$map_out_ret =  \gm\get_map_out($dblj,$map_left);
$map_left_name = $map_out_ret[0]['mname'];
$map_out_ret =  \gm\get_map_out($dblj,$map_right);
$map_right_name = $map_out_ret[0]['mname'];

// 构建北方出口HTML
if($map_up == 0){
    $north_html = "<a href=\"?cmd=$map_up_choose\">选择</a> <a href=\"?cmd=$map_up_link\">创建</a> <a href=\"?cmd=$map_up_link_copy\">复制</a>";
} else {
    $north_html = "<a href=\"?cmd=$map_up_url\">{$map_up_name}</a> <a href=\"?cmd=$map_up_break\">断开</a>";
}

// 构建南方出口HTML
if($map_down == 0){
    $south_html = "<a href=\"?cmd=$map_down_choose\">选择</a> <a href=\"?cmd=$map_down_link\">创建</a> <a href=\"?cmd=$map_down_link_copy\">复制</a>";
} else {
    $south_html = "<a href=\"?cmd=$map_down_url\">{$map_down_name}</a> <a href=\"?cmd=$map_down_break\">断开</a>";
}

// 构建西方出口HTML
if($map_left == 0){
    $west_html = "<a href=\"?cmd=$map_left_choose\">选择</a> <a href=\"?cmd=$map_left_link\">创建</a> <a href=\"?cmd=$map_left_link_copy\">复制</a>";
} else {
    $west_html = "<a href=\"?cmd=$map_left_url\">{$map_left_name}</a> <a href=\"?cmd=$map_left_break\">断开</a>";
}

// 构建东方出口HTML
if($map_right == 0){
    $east_html = "<a href=\"?cmd=$map_right_choose\">选择</a> <a href=\"?cmd=$map_right_link\">创建</a> <a href=\"?cmd=$map_right_link_copy\">复制</a>";
} else {
    $east_html = "<a href=\"?cmd=$map_right_url\">{$map_right_name}</a> <a href=\"?cmd=$map_right_break\">断开</a>";
}

// 创建空的数组用于构建表格
$map_4_name = array_fill(0, 9, '');
$map_3_name = array_fill(0, 9, '');
$map_2_name = array_fill(0, 9, '');
$map_1_name = array_fill(0, 9, '');
$map_0_name = array_fill(0, 9, '');
$map__1_name = array_fill(0, 9, '');
$map__2_name = array_fill(0, 9, '');
$map__3_name = array_fill(0, 9, '');
$map__4_name = array_fill(0, 9, '');

// 设置中间位置
$center_pos = 4; // 假设中心位置在第5列（索引4）

// 在中间行放置东西南北方向
$map_0_name[$center_pos-1] = '←';
$map_0_name[$center_pos] = $map_name; // 当前场景
$map_0_name[$center_pos+1] = '→';
$map_0_name[$center_pos-2] = $west_html;
$map_0_name[$center_pos+2] = $east_html;

// 在上方和下方行放置南北方向
$map_1_name[$center_pos] = '↑';
$map_2_name[$center_pos] = $north_html;
$map__1_name[$center_pos] = '↓';
$map__2_name[$center_pos] = $south_html;

// 生成表格HTML
$map_check = '<table style="font-size:10px;"><tr>';
foreach ($map_4_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_3_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_2_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_1_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map_0_name as $k => $v) {
    if ($k == $center_pos) {
        $map_check .= '<td align="center" nowrap="true" style="border:1px solid red;">' . $v . '</td>';
    } else {
        $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
    }
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__1_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__2_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__3_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr>';

$map_check .= '<tr>';
foreach ($map__4_name as $k => $v) {
    $map_check .= '<td align="center" nowrap="true">' . $v . '</td>';
}
$map_check .= '</tr></table>';

$map_out_html = <<<HTML
<p>定义场景的出口</p>
$map_check
<p>
<a href="?cmd=$last_page">返回上级</a><br>
<a href="?cmd=$gm">返回设计大厅</a>
</p>
HTML;
echo $map_out_html;
?>