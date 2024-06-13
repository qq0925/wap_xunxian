<?php
$cj = $encode->encode("cmd=cjplayer");
$selfym = $_SERVER['PHP_SELF'];
$html = <<<HTML
<form action="?cmd=$cj" method = "post">
<table style="border:1px solid black;width:100%;padding:10px 10px 10px;">
<th>【玩家注册】<th/>
<input type="hidden" name="cmd" value='cjplayer'>
<input type="hidden" name="token" value='$token'>
<tr><td>名字:<input style="height:20px" name = "username" type = "text" maxlength = "7" placeholder="输入角色名"/></tr></td>
<tr><td>性别:<input type="radio" name = 'sex' value="男" checked> 男
<input type="radio" name = 'sex' value="女"> 女</tr></td>
<tr><td><input style="height:30px" class="button_zc" name = "submit"  type="submit"  title = "确定注册" value="创建" /></tr></td>
</table>
</form>
HTML;
echo $html;
?>




