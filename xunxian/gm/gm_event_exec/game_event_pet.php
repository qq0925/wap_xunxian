<?php

if($delete_cmd ==1){
    echo "你删除了收养宠物！<br/>";
    $query = "UPDATE system_event_evs SET a_adopt = '' WHERE `id` = :id and `belong` = :belong_id";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':id', $step_id);
    $stmt->bindParam(':belong_id', $step_belong_id);
    $stmt->execute();
}

if($pet_choose ==3){
    echo "你设置收养对方为宠物！<br/>";
    $query = "UPDATE system_event_evs SET a_adopt = 'oppo' WHERE `id` = :id and `belong` = :belong_id";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':id', $step_id);
    $stmt->bindParam(':belong_id', $step_belong_id);
    $stmt->execute();
}

if($npc_id){
    $adopt_name = \player\getnpc($npc_id,$dblj)->nname;
    echo "你将{$adopt_name}设置为收养对象！<br/>";
    $query = "UPDATE system_event_evs SET `a_adopt` = :adopt WHERE `id` = :id and `belong` = :belong_id";
    $stmt = $dblj->prepare($query);
    $stmt->bindParam(':adopt', $npc_id);
    $stmt->bindParam(':id', $step_id);
    $stmt->bindParam(':belong_id', $step_belong_id);
    $stmt->execute();
}

if($_POST['adopt']){
    $try_id = $_POST['adopt'];
    $try_result = \player\getnpc($try_id,$dblj)->nid??null;
    if($try_result){
        $try_name = \player\getnpc($try_id,$dblj)->nname;
        echo "你将{$try_name}设置为收养对象！<br/>";
        $query = "UPDATE system_event_evs SET `a_adopt` = :adopt WHERE `id` = :id and `belong` = :belong_id";
        $stmt = $dblj->prepare($query);
        $stmt->bindParam(':adopt', $try_result);
        $stmt->bindParam(':id', $step_id);
        $stmt->bindParam(':belong_id', $step_belong_id);
        $stmt->execute();
    }else{
        echo "输入有误！不存在！<br/>";
    }
    unset($pet_choose);
}

$query = "SELECT a_adopt FROM system_event_evs WHERE `id` = :id and `belong` = :belong_id";
$stmt = $dblj->prepare($query);
$stmt->bindParam(':id', $step_id);
$stmt->bindParam(':belong_id', $step_belong_id);
$stmt->execute();

// 获取结果
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$step_a_adopt = $row['a_adopt'];
if($step_a_adopt =="oppo"){
$adopt_text = "收养对方";
}else{
$adopt_text = \player\getnpc($step_a_adopt,$dblj)->nname??"无";
}

if($adopt_text!="无"){
    $delete_adopt = $encode->encode("cmd=game_event_pet&delete_cmd=1&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
    $adopt_text .= "<a href='?cmd=$delete_adopt'>删除</a>";
}

if(!$pet_choose||$pet_choose ==3){
$pet_choose_1 = $encode->encode("cmd=game_event_pet&pet_choose=1&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
$pet_choose_2 = $encode->encode("cmd=game_event_pet&pet_choose=2&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
$pet_choose_3 = $encode->encode("cmd=game_event_pet&pet_choose=3&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_globaleventdefine_steps&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
$pet_html = <<<HTML
定义事件步骤的收养宠物对象<br/>
收养宠物对象：{$adopt_text}<br/>
<a href="?cmd=$pet_choose_1">选择电脑人物</a><br/>
<a href="?cmd=$pet_choose_2">设置人物id表达式</a><br/>
<a href="?cmd=$pet_choose_3">收养对方</a><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
}elseif ($pet_choose ==1) {

$map = '';
$hangshu = 0;

$cxallmap = \gm\getqy_all($dblj);
$br = 0;

if($post_canshu ==0){
$last_page = $encode->encode("cmd=game_event_pet&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
for ($i=0;$i<count($cxallmap);$i++){
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
if (isset($_POST['kw'])) {
    $keyword = $_POST['kw'];
    // 构建查询语句，使用过滤条件
    $sql = "select * from `system_area` where name LIKE :keyword";
    $stmt = $dblj->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    // 显示过滤后的数据
    $cxallmap = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $qyname = $cxallmap[$i]['name'];
    $qy_id = $cxallmap[$i]['id'];
}
  if($qy_id ==0){
      $target_mid = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&post_canshu=1&qy_id=0&pet_choose=1&sid=$sid");
        $no_area =<<<HTML
        <a href="?cmd=$target_mid" >未分区</a><br/>
HTML;
  }elseif($qy_id !=0){
        $hangshu +=1;
        $target_mid = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&post_canshu=1&qy_id=$qy_id&pet_choose=1&sid=$sid");
        $map .=<<<HTML
        <a href="?cmd=$target_mid" >$hangshu.$qyname(a{$qy_id})</a><br/>
HTML;
  }}
$pet_area = <<<HTML
[事件收养电脑人物设计]<br/>
请选择所属区域：<br/>
$map
$no_area<br/>
<form method="post">
快速搜索：<br/>
<input name="kw" type="text"/><br/>
<input name="submit" type="submit" title="提交" value="提交"/><input name="submit" type="hidden" title="提交" value="提交"/></form><br/>
<a href="?cmd=$last_page" >返回上级</a><br/>
HTML;
}
elseif($post_canshu ==1){
    $game_config = \player\getgameconfig($dblj);
    $list_row = $game_config->list_row;
    // 当前页码
    if ($list_page) {
        $currentPage = intval($list_page);
    } else {
        $currentPage = 1;
    }
    // 计算偏移量
    $offset = ($currentPage - 1) * $list_row;
    
    
    // 计算总行数
    $sqlCount = "SELECT COUNT(*) as total FROM system_npc where narea_id ='$qy_id'";
    $countResult = $dblj->query($sqlCount);
    $countRow = $countResult->fetch(PDO::FETCH_ASSOC);
    $totalRows = $countRow['total'];
    
    // 计算总页数
    $totalPages = ceil($totalRows / $list_row);
    
    $re_area = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&pet_choose=1&sid=$sid");
    $hangshu = $offset;
    if(isset($qy_id)){
    $cxthe_qy = \gm\getqy($dblj,$qy_id);
    $qy_name = $cxthe_qy['name'];
    $qy_id = $cxthe_qy['id'];
    $cxallnpc = \gm\get_npc_list($dblj,$qy_id,$offset,$list_row);
    for ($i=0;$i<count($cxallnpc);$i++){
        $hangshu +=1;
        $npc_nname = $cxallnpc[$i]['nname'];
        $npc_nid = $cxallnpc[$i]['nid'];
        $qy_name = $cxallnpc[$i]['narea_name'];
        $target_mid = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&qy_id=$qy_id&npc_id=$npc_nid&sid=$sid");
        $npc_html .=<<<HTML
        <a href="?cmd=$target_mid">$hangshu.{$npc_nname}(n{$npc_nid})</a><br/>
HTML;
    }
}

if ($currentPage > 2 && $currentPage == $totalPages) {
    $main_page = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=1&pet_choose=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">首页</a>
HTML;
}
if ($currentPage > 1) {
    $list_page = $currentPage -  1;
    $main_page = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=$list_page&pet_choose=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">上页</a>
HTML;
}

if ($currentPage < $totalPages) {
    $list_page = $currentPage +  1;
    $main_page = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=$list_page&pet_choose=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">下页</a>
HTML;
}

if ($totalPages > 2 && $currentPage < $totalPages-1) {
    $list_page = $totalPages;
    $main_page = $encode->encode("cmd=game_event_pet&step_belong_id=$step_belong_id&step_id=$step_id&qy_id=$qy_id&post_canshu=1&list_page=$list_page&pet_choose=1&sid=$sid");
    $page_html .=<<<HTML
<a href="?cmd=$main_page">末页</a>
HTML;
}


$pet_area = <<<HTML
[事件收养电脑人物设计]<br/>
{$qy_name}(a$qy_id)区域下的npc：<br/>
{$npc_html}<br/>
$page_html<br/>
<a href="?cmd=$re_area" >返回上级</a><br/>
HTML;
}

$pet_html = <<<HTML
定义事件步骤的收养宠物对象<br/>
$pet_area
HTML;
    //直接选择法的分支
}elseif ($pet_choose ==2) {
$last_page = $encode->encode("cmd=game_event_pet&step_id=$step_id&step_belong_id=$step_belong_id&sid=$sid");
$pet_html = <<<HTML
<p>请输入目标电脑人物id表达式<br/>
</p>
<form method="post">
人物id表达式:<textarea name="adopt" maxlength="4096" rows="4" cols="40"></textarea><br/>
<input name="submit" type="submit" title="确定" value="确定"></form><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
HTML;
    //id选择法的分支
}
echo $pet_html;
?>