<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$module_page = $encode->encode("cmd=gm_game_pagemoduledefine&gm_post_canshu=$gm_post_canshu&sid=$sid");
$func_type = "game_page_2";
if($gm_post_canshu ==13){
$module_page = $encode->encode("cmd=game_self_page&self_id=$self_id&sid=$sid");
$func_type = "game_self_page_2";
}
$get_main_page = \gm\get_func_page($dblj,$gm_post_canshu);
$func_old_name = $func_name;
if(!empty($func_id)){
for ($i=0;$i<count($get_main_page);$i++){
    $func_id = $get_main_page[$i]['id'];
    $func_name = $get_main_page[$i]['name'];
    $ele_target_func = $encode->encode("cmd=$func_type&self_id=$self_id&gm_post_canshu=$gm_post_canshu&main_id=$main_id&main_type=$main_type&main_position=$main_position&func_id=$func_id&func_name=$func_name&sid=$sid");
    $func_page .=<<<HTML
    <a href="?cmd=$ele_target_func" >{$i}.{$func_name}</a><br/>
HTML;
}




}
$last_page = $encode->encode("cmd=game_page_2&gm_post_canshu=$gm_post_canshu&main_position=$main_position&main_id=$main_id&main_type=$main_type&sid=$sid");
if($gm_post_canshu ==13){
$last_page = $encode->encode("cmd=game_self_page_2&main_position=$main_position&self_id=$self_id&main_id=$main_id&main_type=$main_type&sid=$sid");
}
$func_html =<<<HTML
目前的功能动作：{$func_old_name}
<p>请选择功能元素对应的动作：<br/>
$func_page
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$module_page">返回页面模板</a><br/>
<a href="game.php?cmd=$gm_main">返回设计大厅</a><br/>


HTML;
echo $func_html;
?>