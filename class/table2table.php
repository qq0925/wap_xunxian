<?php
// 假设您已经连接到了数据库，并且设置了 $value 和 $mapDefId 的值

// 根据 $value 查询符合条件的 gm_game_attr 表中的数据
require_once 'pdo.php';


if($gm_map_canshu == "1"){
$post_tishi = '修改成功';
}
$map_id = $target_midid;//这里接受其他地方传来的map_id

$area_main = $encode->encode("cmd=gm_post_4&target_midid=$map_id&sid=$sid");

//$_SERVER['PHP_SELF'];
// 建立连接
$conn = DB::conn();

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}



// 查询 system_map 表中的 mid 和 mname 字段
// 获取所有value_type为5的数据
$sql = "SELECT * FROM gm_game_attr WHERE value_type = 5";
$result = $conn->query($sql);

// 初始化数组
// 获取system_map中的数据
$sql = "SELECT * FROM system_map WHERE mid = '$map_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// 获取gm_game_attr中的数据
$sql2 = "SELECT * FROM gm_game_attr";
$result2 = $conn->query($sql2);

// 将gm_game_attr中的数据保存到一个数组中
$attr_array = array();
while ($row2 = $result2->fetch_assoc()) {
    $attr_array[$row2['id']] = $row2;
}

// 根据需要的数据生成HTML代码
$map_page = "";
foreach ($attr_array as $id => $attr) {
    // 生成标识和值
    $id = $attr['id'];
    $name = $attr['name'];
    //var_dump('<pre>');
    //var_dump($attr);
    //var_dump('</pre>');
    $value = isset($row['m' . $id]) ? $row['m' . $id] : '';

    // 将标识和值添加到HTML代码中
    var_dump($id);
    switch ($id) {
        case 'id':
        $map_mid_page .= <<<HTML
    $name:s{$value}<br/>
HTML;
            break;
        case 'area_name':
            global $area_name;
            $area_name = $value;
            break;
        case 'area_id':
            // 查询 system_area 表中的所有数据
            $stmt = $dblj->prepare('SELECT * FROM system_area');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // 构建 select 元素的 HTML 代码
            $select = '区域:<select name="area_id">';
            foreach ($data as $area_row) {
                $selected = ($area_row['id'] == $value) ? ' selected' : '';
                $select .= '<option value="' . htmlspecialchars($area_row['id']) . '"' . $selected . '>' . htmlspecialchars($area_row['name']) . '</option>';
                
            }
            $select .= '</select><br/>';
                $map_mid_page .= <<<HTML
                $select
HTML;
            break;
            case 'name':
            $map_mid_page .= <<<HTML
            名称:<input name="$id" type="text" value="$value" maxlength="200"/><br/>
HTML;
            $scene_name = $value;
                break;
            case 'photo':
            $map_mid_page .= <<<HTML
            $name:<input name="$id" type="text" value="$value" maxlength="200"/><br/>
HTML;
                break;
            case 'refresh_time':
            $map_mid_page .= <<<HTML
            $name:<input name="$id" type="text" value="$value" maxlength="200"/><br/>
HTML;
                break;
            case 'desc':
            $map_mid_page .= <<<HTML
            $name:<textarea name="$id" maxlength="200" rows="4" cols="40">$value</textarea><br/>
HTML;
                break;
        default:
            $map_mid_page .= <<<HTML
            $name:<input name="$id" type="text" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
    }
}
$map_page = <<<HTML
<p>定义场景“{$scene_name}”的属性<br/>
</p>
$post_tishi
    <form>
    <input type="hidden" name="cmd" value="gm_map_submit">
    <input type="hidden" name="area_name" value="$area_name">
    <input type="hidden" name="gm_map_canshu" value="1">
    <input type="hidden" name="mid" value="$map_id">
    <input type="hidden" name="sid" value="$sid">
    $map_mid_page
    <input type="submit" value="提交">
    </form>
    <a href="game.php?cmd=$area_main">返回上级</a><br/>
HTML;
echo $map_page;
?>