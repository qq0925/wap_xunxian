<p>[任务定义]<br/>
<?php
try {
    // 获取POST表单数据
    if ($_SERVER["REQUEST_METHOD"] == "POST" &&$_POST['id'] !='') {
        $id = $_POST["id"];
        $setClause = '';
        $updateParams = array();

        // 遍历POST表单字段，构建SET部分和参数
        foreach ($_POST as $key => $value) {
            // 构建数据表字段名
            $tableFieldName = "t" . $key; // 表单字段名加上"j"前缀
            // 构建SET部分
            $setClause .= "$tableFieldName=?, ";
            // 构建参数数组
            $updateParams[] = $value;
        }

        // 去除SET部分末尾多余的逗号和空格
        $setClause = rtrim($setClause, ', ');

        // 构建完整的UPDATE SQL语句
        $sql = "UPDATE system_task SET $setClause WHERE tid=?";
        // 使用预处理语句
        $stmt = $dblj->prepare($sql);

        // 绑定参数
        $updateParams[] = $id;
        $stmt->execute($updateParams);

        echo "修改成功!<br/>";
    }
} catch (PDOException $e) {
    echo "连接失败: " . $e->getMessage();
}

$gm = $encode->encode("cmd=gm&sid=$sid");
$last_page = $encode->encode("cmd=gm_game_taskdesign&gm_post_canshu=$task_type&sid=$sid");
$sql = "select * from system_task where tid = '$task_id'";
$task_post_canshu = 0;
$gm_cxjg = $dblj->query($sql);
if ($gm_cxjg){
    $gm_ret = $gm_cxjg->fetch(PDO::FETCH_ASSOC);
    $task_id = $gm_ret['tid'];
    $task_belong = $gm_ret['tbelong'];
    $task_name = $gm_ret['tname'];
    $task_cond = $gm_ret['tcond'];
    $task_accept_cond = $gm_ret['taccept_cond'];
    $task_cmmt1 = $gm_ret['tcmmt1'];
    $task_cmmt2 = $gm_ret['tcmmt2'];
}
$task_html = <<<HTML
</p>
<form method="post">
任务标识:t{$task_id}<br/>
<input name="id" type="hidden" value="{$task_id}">
任务所属:<input name="belong" type="text" value="{$task_belong}" maxlength="50"/><br/>
任务名称:<input name="name" type="text" value="{$task_name}" maxlength="50"/><br/>
触发条件:<textarea name="cond" maxlength="1024" rows="4" cols="40">{$task_cond}</textarea><br/>
接受条件:<textarea name="accept_cond" maxlength="1024" rows="4" cols="40">{$task_accept_cond}</textarea><br/>
不能接受提示语:<textarea name="cmmt1" maxlength="1024" rows="4" cols="40">{$task_cmmt1}</textarea><br/>
未完成提示语:<textarea name="cmmt2" maxlength="1024" rows="4" cols="40">{$task_cmmt2}</textarea><br/>
<input type="submit" title="确定" value="确定"/><br/><br/>
<a href="?cmd=$last_page">返回上级</a><br/>
<a href="?cmd=$gm">返回设计大厅</a><br/>
HTML;
echo $task_html;
?>