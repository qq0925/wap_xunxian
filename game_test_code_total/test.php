<!-- HTML 表单 -->
<?php
include_once 'pdo.php';



session_start(); 
if(isset($_POST['code'])){
if($_POST['code'] == $_SESSION['code']){
    echo "表单已经提交过，请勿重复提交。<br/>";
}else{
if(empty($_POST['test1'])){
    echo "输入有误！<br/>";
}elseif (isset($_POST['test1'])) {
    $text = $_POST['test1'];
    $sql = "update game1 set umoney = '$text' + umoney where uid = 2";
    $cxjg = $dblj->exec($sql);
    echo "提交成功！你输入的内容为：$text";
    $_SESSION['code'] =$_POST['code']; //存储code
}
}
}
$code = mt_rand(0,1000000);

var_dump($_POST['code']);
var_dump($_SESSION['code']);
var_dump($code);

$test_post = <<<HTML
<form action ="test.php" method="post">
    <!-- 表单元素... -->
    <input type="hidden" name="code" value="$code">
    <input type="text" name="test1">
    <input type="text" name="test2">
    <input type="submit" value="提交">
</form>
HTML;
echo $test_post;
?>
