<?php
$gm = $encode->encode("cmd=gm&sid=$sid");
$get_mysqldata = \gm\get_mysqldata_2($dblj,$data_type,$data_id);
$jsonString = $get_mysqldata;
$gm_html =<<<HTML
<p><pre>$jsonString</pre><p/><br/>
<a href="#" onClick="javascript:history.back(-1);">返回上级</a><br/>
<a href="?cmd=$gm" >返回设计大厅</a>
HTML;
echo $gm_html;

?>
