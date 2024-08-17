<?php
// 假设您已经连接到了数据库，并且设置了 $value 和 $mapDefId 的值

// 根据 $value 查询符合条件的 gm_game_attr 表中的数据

require_once 'pdo.php';


if($gm_map_canshu == "1"){
$post_tishi = '修改成功';
}
$map_id = $target_midid;//这里接受其他地方传来的map_id

$area_main = $encode->encode("cmd=gm_post_4&target_midid=$map_id&sid=$sid");
$gm_map_post = $encode->encode("cmd=gm_map_submit&gm_map_canshu=1&sid=$sid");
//$_SERVER['PHP_SELF'];
// 建立连接
$conn = DB::pdo();


// 初始化数组
// 获取system_map中的数据
$stmt = $conn->prepare("SELECT * FROM system_map WHERE mid = ?");
$stmt->execute([$map_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// 获取gm_game_attr中的数据
$stmt2 = $conn->prepare("SELECT * FROM gm_game_attr WHERE value_type = 5");
$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// 将gm_game_attr中的数据保存到一个数组中
$attr_array = array();
foreach ($result2 as $row2) {
    $attr_array[$row2['id']] = $row2;
}

// 根据需要的数据生成HTML代码
$map_page = "";
foreach ($attr_array as $id => $attr) {
    // 生成标识和值
    $id = $attr['id'];
    $name = $attr['name'];
    $if_basic = $attr['if_basic'];
    $attr_type = $attr['attr_type'];
    $value = isset($row['m' . $id]) ? $row['m' . $id] : '';
    switch ($id) {
        case 'id':
        $map_mid_page .= <<<HTML
    $name:s{$value}<br/>
HTML;
            break;
        case 'area_name':
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
            名称:<input name="$id" type="text" value="$value" maxlength="200"/>
<input id="color-picker" type="color"><br/>
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
            case 'shop':
$selectedOption = ($value == "1") ? 'selected' : '';
$map_mid_page .= <<<HTML
是否商店:<select name="shop">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;
               break;
            case 'hockshop':
$selectedOption = ($value == "1") ? 'selected' : '';
$map_mid_page .= <<<HTML
是否当铺:<select name="hockshop">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;
               break;
            case 'storage':
$selectedOption = ($value == "1") ? 'selected' : '';
$map_mid_page .= <<<HTML
是否仓库:<select name="storage">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;
               break;
            case 'kill':
$selectedOption = ($value == "1") ? 'selected' : '';
$map_mid_page .= <<<HTML
是否允许pk:<select name="kill">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;
                break;
            case 'is_rp':
$selectedOption = ($value == "1") ? 'selected' : '';
$map_mid_page .= <<<HTML
是否资源点:<select name="is_rp">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;
                break;
            case 'rp_id':
            // 查询 system_rp 表中的所有数据
            $stmt = $dblj->prepare('SELECT * FROM system_rp');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // 构建 select 元素的 HTML 代码
            $select = '资源名称:<select name="rp_id">';
            foreach ($data as $area_row) {
                $selected = ($area_row['rp_id'] == $value) ? ' selected' : '';
                $select .= '<option value="' . htmlspecialchars($area_row['rp_id']) . '"' . $selected . '>' . htmlspecialchars($area_row['rp_name']).'|'.($area_row['rp_rarity'].'级') . '</option>';
                
            }
            $select .= '</select><br/>';
                $map_mid_page .= <<<HTML
                $select
HTML;
                break;
            case 'tp_type':
$selectedOption1 = ($value == "1") ? 'selected' : '';
$selectedOption2 = ($value == "2") ? 'selected' : '';
$selectedOption3 = ($value == "3") ? 'selected' : '';

$map_mid_page .= <<<HTML
中转点类型:<select name="tp_type">
<option value="0" >无</option>
<option value="1" $selectedOption1>码头渡口</option>
<option value="2" $selectedOption2>陆行车站</option>
<option value="3" $selectedOption3>飞行营地</option>
</select><br/>
HTML;
                break;
        default:
        switch($attr_type){
            case '0':
        $map_mid_page .= <<<HTML
        $name:<input name="$id" type="number" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
            case '1':
        $map_mid_page .= <<<HTML
        $name:<input name="$id" type="text" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
            case '2':
$selectedOption = ($value == "1") ? 'selected' : '';
$map_mid_page .= <<<HTML
{$name}:<select name="{$id}">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;
            break;
        }
        break;
    }
}
$map_page = <<<HTML
<p>定义场景“{$scene_name}”的属性<br/>
</p>
$post_tishi
    <form action="?cmd=$gm_map_post" method="post">
    <input type="hidden" name="id" value="$map_id">
    $map_mid_page
    <input type="submit" value="提交">
    </form>
    <a href="game.php?cmd=$area_main">返回上级</a><br/>
HTML;
echo $map_page;
?>
<script>
  // 获取元素的引用
  let colorPicker = document.getElementById("color-picker");
  // 获取 input 元素的引用
  let input = document.querySelector("input[name='name']");
 // 获取 input 元素的值
let value = input.value;

// 页面加载时检查 input 元素的值是否有颜色代码
window.addEventListener("load", function() {
  // 检查 input 元素的值是否已经有 @@@end@ 的格式
  let regex = /@([0-9a-fA-F]{6})@(.*)@end@/;

  // 如果有，就把颜色代码赋给 color-picker 元素的值和背景颜色
  if (regex.test(value)) {
    let color = value.match(regex)[1];
    colorPicker.value = "#" + color;
  }
});

  // 颜色选择器的值改变时更新 input 标签的值和背景颜色
  colorPicker.addEventListener("input", function() {
  // 去掉颜色值的 # 号
  let color = colorPicker.value.slice(1);

  // 检查 input 元素的值是否已经有 @@@end@ 的格式
  let regex = /@([0-9a-fA-F]{6})@(.*)@end@/;

  // 如果有，就直接替换颜色代码
  if (regex.test(value)) {
    let result = value.replace(regex, "@" + color + "@$2@end@");
    input.value = result;
  } else {
    // 如果没有，就拼接新的字符串
    let result = "@" + color + "@" + value + "@end@";
    input.value = result;
  }
  });
  

</script>