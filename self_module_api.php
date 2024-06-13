<?php
$self_module_api = $encode->encode("cmd=self_module_api&sid=$sid");
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$get_main_page = \gm\get_self_page_list($dblj);
for($i=0;$i<@count($get_main_page);$i++){
$self_name = $get_main_page[$i]['name'];
$self_call_sum = $get_main_page[$i]['call_sum'];
$self_id = $get_main_page[$i]['id'];
}
$gm_html =<<<HTML
<form action="?cmd=$self_module_api" method="post">
显示页面模板:<input name="page_name" value="ct_" type="text" maxlength="20"/><br/>
<input type="submit" value="提交">
</form>
<a href="game.php?cmd=$gm_main">设计大厅</a><br/>
HTML;
echo $gm_html;


?>