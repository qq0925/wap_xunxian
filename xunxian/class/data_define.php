<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=game_event_page_1&gm_post_canshu_2=$data_id&sid=$sid");
$get_mysqldata = \gm\get_mysqldata($dblj,$data_type,$data_id);
$jsonString = $get_mysqldata;
$gm_html =<<<HTML
<p><pre>$jsonString</pre><p/><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm" >返回设计大厅</a>
HTML;
echo $gm_html;

?>
