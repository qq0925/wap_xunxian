<?php
$selfym = $_SERVER['PHP_SELF'];
$html = <<<HTML
<img src="https://s1.ax1x.com/2023/04/22/p9ZYp0U.jpg" width="177" height="70" /><br/>
<form action=$selfym method = "GET">
<table style="border:1px solid black;width:100%;padding:10px 10px 10px;">
<th>【玩家注册】<th/>
<input type="hidden" name="cmd" value='cjplayer'>
<input type="hidden" name="token" value='$token'>
<tr><td>名字:<input style="height:20px" name = "username" type = "text" maxlength = "7" placeholder="输入角色名"/></tr></td>
<tr><td>性别:<input type="radio" name = 'sex' value="1" checked> 男
<input type="radio" name = 'sex' value="2"> 女</tr></td>
<tr><td><input style="height:30px" class="button_zc" name = "submit"  type="submit"  title = "确定注册" value="创建" /></tr></td>
</table>
</form>
HTML;
echo $html;


    /*<form action=$selfym method="get">
        角色名称：
        <input type="hidden" name="cmd" value="cjplayer">
        <input type="hidden" name="token" value='$token'>
        <p><input type="text" name="username" maxlength="7"></p>
        <p><label>男：<input type="radio" name="sex" value="1" checked></label>
            <label>女：<input type="radio" name="sex" value="2"></label>
        </p>
        <input type="submit" value="创建">
    </form>*/


?>




