<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_post_4&target_midid=$target_midid&sid=$sid");
$map_out_ret =  \gm\get_map_out($dblj,$target_midid);
$target_midid = $map_out_ret[0]['mid'];
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

if($map_right ==''){
    $map_out .=<<<HTML
东：<a href = "?cmd=$map_right_choose">选择</a><a href="?cmd=$map_right_link">创建</a><a href="?cmd=$map_right_link_copy">复制</a><br/>
HTML;
}else{
        $map_out .=<<<HTML
东：<a href = "?cmd=$map_right_url">{$map_right_name}</a><a href="?cmd=$map_right_break">断开</a><br/>
HTML;
}

if($map_down ==''){
    $map_out .=<<<HTML
南：<a href = "?cmd=$map_down_choose">选择</a><a href="?cmd=$map_down_link">创建</a><a href="?cmd=$map_down_link_copy">复制</a><br/>
HTML;
}else{
        $map_out .=<<<HTML
南：<a href = "?cmd=$map_down_url">{$map_down_name}</a><a href="?cmd=$map_down_break">断开</a><br/>
HTML;
}

if($map_left ==''){
    $map_out .=<<<HTML
西：<a href = "?cmd=$map_left_choose">选择</a><a href="?cmd=$map_left_link">创建</a><a href="?cmd=$map_left_link_copy">复制</a><br/>
HTML;
}else{
        $map_out .=<<<HTML
西：<a href = "?cmd=$map_left_url">{$map_left_name}</a><a href="?cmd=$map_left_break">断开</a><br/>
HTML;
}

if($map_up ==''){
    $map_out .=<<<HTML
北：<a href = "?cmd=$map_up_choose">选择</a><a href="?cmd=$map_up_link">创建</a><a href="?cmd=$map_up_link_copy">复制</a><br/>
HTML;
}else{
        $map_out .=<<<HTML
北：<a href = "?cmd=$map_up_url">{$map_up_name}</a><a href="?cmd=$map_up_break">断开</a><br/>
HTML;
}

$map_out_html = <<<HTML
<p>定义场景的出口<br/>
$map_out
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
</p>
HTML;
echo $map_out_html;

?>