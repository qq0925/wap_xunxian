<?php
$gm_npc_skills_last = $encode->encode("cmd=gm_type_npc&gm_post_canshu=5&add=1&npc_id=$npc_id&sid=$sid");
$skills_post = $encode->encode("cmd=gm_type_npc&gm_post_canshu=5&skill_add_id=$skill_add_id&npc_id=$npc_id&sid=$sid");
$skills_count = 1;
$skills_count = htmlspecialchars($skills_count, ENT_QUOTES, 'UTF-8');

$gm_html =<<<HTML
<p>设置[{$skill_name}]技能等级<br/>
</p>
<form action="?cmd=$skills_post" method="post">
等级表达式:<textarea name="skill_lvl" maxlength="4096" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"/><input name="submit" type="hidden" title="确定" value="确定"/></form><br/>
<a href="?cmd=$gm_npc_skills_last">返回上级</a><br/>
HTML;
echo $gm_html;
?>