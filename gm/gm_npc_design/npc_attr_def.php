<?php
// 假设您已经连接到了数据库，并且设置了 $value 和 $npcDefId 的值

// 根据 $value 查询符合条件的 gm_game_attr 表中的数据

require_once 'pdo.php';

if($gm_npc_canshu == "1"){
$post_tishi = '修改成功';
}
$area_main = $encode->encode("cmd=gm_npc_second&npc_id=$npc_id&sid=$sid");

$gm_npc_post = $encode->encode("cmd=gm_npc_submit&npc_id=$npc_id&gm_npc_canshu=1&sid=$sid");
//$_SERVER['PHP_SELF'];
// 建立连接
$conn = DB::pdo();

// 初始化数组
// 获取system_npc中的数据
$stmt = $conn->prepare("SELECT * FROM system_npc WHERE nid = ?");
$stmt->execute([$npc_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$area_name = $row['narea_name'];
$sex = $row['nsex'];
$shop_cond = $row['nshop_cond'];

// 获取gm_game_attr中的数据
$stmt2 = $conn->prepare("SELECT * FROM gm_game_attr WHERE value_type = 3");
$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// 将gm_game_attr中的数据保存到一个数组中
$attr_array = array();
foreach ($result2 as $row2) {
    $attr_array[$row2['id']] = $row2;
}
// 根据需要的数据生成HTML代码
$npc_page = "";
foreach ($attr_array as $id => $attr) {
    // 生成标识和值
    $id = $attr['id'];
    $name = $attr['name'];
    $if_basic = $attr['if_basic'];
    $attr_type = $attr['attr_type'];
    $value = isset($row['n' . $id]) ? $row['n' . $id] : '';
    switch ($id) {
        case 'id':
        $npc_mid_page .= <<<HTML
    $name:n{$value}<br/>
HTML;
            break;
        case 'area_id':
            // 查询 system_area 表中的所有数据
            $old_area_id = $value;
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
                $npc_mid_page .= <<<HTML
                $select
HTML;
            break;
            case 'name':
            $npc_mid_page .= <<<HTML
            名称:<input name="$id" type="text" value="$value" maxlength="200"/>
            <input id="color-picker" type="color"><br/>
            性别:<input name="sex" type="text" value="$sex" maxlength="200"/><br/>
HTML;
            $npc_name = $value;
                break;
            case 'sex':
            $npc_mid_page .= <<<HTML
            性别:<input name="$id" type="text" value="$value" maxlength="200"/><br/>
HTML;
                break;
            case 'photo':
            $npc_mid_page .= <<<HTML
            $name:<input name="$id" type="text" value="$value" maxlength="200"/><br/>
HTML;
                break;
            case 'refresh_time':
            $npc_mid_page .= <<<HTML
            $name:<input name="$id" type="text" value="$value" maxlength="200"/><br/>
HTML;
                break;
            case 'desc':
            $npc_mid_page .= <<<HTML
            $name:<textarea name="$id" maxlength="200" rows="4" cols="40">$value</textarea><br/>
HTML;
                break;
            case 'kill':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
是否可杀:<select name="kill">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;

                break;
            case 'not_dead':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
是否杀不死:<select name="not_dead">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;

                break;
            case 'chuck':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
是否可赶走:<select name="chuck">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;

                break;
            case 'shop':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
是否贩货:<select name="shop">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;

                break;
            case 'hock_shop':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
是否收购:<select name="hock_shop">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;

                break;
            case 'accept_give':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
是否接受物品:<select name="accept_give">
<option value="0" >否</option>
<option value="1" $selectedOption>是</option>
</select><br/>
HTML;

                break;
        default:
        switch($attr_type){
            case '0':
        $npc_mid_page .= <<<HTML
        $name:<input name="$id" type="number" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
            case '1':
        $npc_mid_page .= <<<HTML
        $name:<input name="$id" type="text" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
            case '2':
$selectedOption = ($value == "1") ? 'selected' : '';
$npc_mid_page .= <<<HTML
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

$npc_mid_page .= <<<HTML
交易条件:<textarea name="shop_cond" maxlength="200" rows="4" cols="40">{$shop_cond}</textarea><br/>
HTML;
$npc_page = <<<HTML
<p>定义npc“{$npc_name}”的属性<br/>
</p>
$post_tishi
<form action="?cmd=$gm_npc_post" method="post">
<input type="hidden" name="id" value="$npc_id">
$npc_mid_page
<input type="submit" value="提交">
</form>
<a href="game.php?cmd=$area_main">返回上级</a><br/>
HTML;
echo $npc_page;
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