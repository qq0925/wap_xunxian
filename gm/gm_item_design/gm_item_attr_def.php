


<?php
// 假设您已经连接到了数据库，并且设置了 $value 和 $itemDefId 的值

// 根据 $value 查询符合条件的 gm_game_attr 表中的数据

require_once 'pdo.php';

try {
    // 获取POST表单数据
    if ($_SERVER["REQUEST_METHOD"] == "POST" &&$_POST['id'] !='') {
        $id = $_POST["id"];
        $area_id = $_POST['area_id'];
        $subtype = $_POST['subtype'];
        $setClause = '';
        $updateParams = array();
        // 遍历POST表单字段，构建SET部分和参数
        foreach ($_POST as $key => $value) {
            // 构建数据表字段名
            $tableFieldName = "i" . $key; // 表单字段名加上"j"前缀
            // 构建SET部分
            $setClause .= "$tableFieldName=?, ";
            // 构建参数数组
            $updateParams[] = $value;
        }

        // 去除SET部分末尾多余的逗号和空格
        $setClause = rtrim($setClause, ', ');

        // 构建完整的UPDATE SQL语句
        $sql = "UPDATE system_equip_user SET equiped_pos_id = '$subtype' WHERE eqid = :eqid";
        // 使用预处理语句
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':eqid', $id);
        $stmt->execute();
        // 构建完整的UPDATE SQL语句
        $sql = "UPDATE system_item_module SET $setClause WHERE iid=?";
        // 使用预处理语句
        $stmt = $dblj->prepare($sql);

        // 绑定参数
        $updateParams[] = $id;
        $stmt->execute($updateParams);
        $item_id = $id;
        $sql = "UPDATE system_item_module SET iarea_name = (SELECT name FROM system_area WHERE id = :area_id) WHERE iid = :iid";
        $stmt = $dblj->prepare($sql);
        $stmt->bindParam(':area_id', $area_id);
        $stmt->bindParam(':iid', $item_id);
    
        $stmt->execute();
        echo "修改成功!<br/>";
    }
} catch (PDOException $e) {
    echo "连接失败: " . $e->getMessage();
}





$item_main = $encode->encode("cmd=game_item_list&item_id=$item_id&sid=$sid");
$gm_item_post = $encode->encode("cmd=gm_item_attr_submit&item_id=$item_id&sid=$sid");
//$_SERVER['PHP_SELF'];
// 建立连接
$conn = DB::pdo();

// 初始化数组
// 获取system_item中的数据
$stmt = $conn->prepare("SELECT * FROM system_item_module WHERE iid = :item_id");
$stmt->execute(['item_id' => $item_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$use_attr = $row['iuse_attr'];
$use_value = $row['iuse_value'];
$area_name = $row['iarea_name'];
$detail_desc = $row['idetail_desc'];

// 获取gm_game_attr中的数据
$stmt2 = $conn->prepare("SELECT * FROM gm_game_attr WHERE value_type = 4");
$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// 将gm_game_attr中的数据保存到一个数组中
$attr_array = array();
foreach ($result2 as $row2) {
    $attr_array[$row2['id']] = $row2;
}
// 根据需要的数据生成HTML代码
$item_page = "";
foreach ($attr_array as $id => $attr) {
    // 生成标识和值
    $id = $attr['id'];
    $name = $attr['name'];
    $if_basic = $attr['if_basic'];
    $attr_type = $attr['attr_type'];
    $value = isset($row['i' . $id]) ? $row['i' . $id] : '';
    switch ($id) {
        case 'id':
        $item_mid_page .= <<<HTML
    $name:i{$value}<br/>
HTML;
            break;
        case 'area_id':
            // 查询 system_area 表中的所有数据
            global $old_area_id;
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
                $item_mid_page .= <<<HTML
                $select
HTML;
            break;
            case 'name':
                global $item_name;
                $item_name = $value;
            $item_mid_page .= <<<HTML
            名称:<input name="$id" type="text" value="$value" size="30" maxlength="200">
<input id="color-picker" type="color"><br/>
HTML;
            $scene_name = $value;
                break;
            case 'image':
            $item_mid_page .= <<<HTML
            $name:<input name="$id" type="text" value="$value" maxlength="200"><br/>
HTML;
                break;
            case 'desc':
            $item_mid_page .= <<<HTML
            $name:<textarea name="$id" maxlength="200" rows="4" cols="40">$value</textarea><br/>
HTML;
                break;
            case 'type':
            global $item_type;
            $item_type = $value;
            global $old_type;
            $old_type = $value;
            ${"select_type_$value"} = "selected";
            $item_mid_page .= <<<HTML
类别:<select name="type">
<option value="消耗品" $select_type_消耗品>消耗品</option>
<option value="兵器" $select_type_兵器>兵器</option>
<option value="防具" $select_type_防具>防具</option>
<option value="书籍" $select_type_书籍>书籍</option>
<option value="兵器镶嵌物" $select_type_兵器镶嵌物>兵器镶嵌物</option>
<option value="防具镶嵌物" $select_type_防具镶嵌物>防具镶嵌物</option>
<option value="任务物品" $select_type_任务物品>任务物品</option>
<option value="其它" $select_type_其它>其它</option>
</select><br/>
HTML;
            break;
            case 'subtype':
        if($item_type =="兵器"||$item_type =="防具"){
            if($item_type =="兵器"){
                $temp_id = 1;
            }else{
                $temp_id = 2;
            }
            // 查询 system_equip_def 表中的所有数据
            $stmt = $dblj->prepare("SELECT * FROM system_equip_def where type = '$temp_id'");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // 构建 select 元素的 HTML 代码
            $select = '子类别:<select name="subtype">';
            foreach ($data as $area_row) {
                $selected = ($area_row['id'] == $value) ? ' selected' : '';
                $select .= '<option value="' . htmlspecialchars($area_row['id']) . '"' . $selected . '>' . htmlspecialchars($area_row['name']) . '</option>';
                
            }
            $select .= '</select><br/>';
                $item_mid_page .= <<<HTML
                $select
HTML;
}
        else{
                $item_mid_page .= <<<HTML
子类别:<input name="subtype" type="text" value="$value" size="10" maxlength="10"><br/>
HTML;
}
                break;
            case 'no_give':
$selectedOption = ($value == "0") ? 'selected' : '';
$item_mid_page .= <<<HTML
是否不可赠送:<select name="no_give">
<option value="1" >是</option>
<option value="0" $selectedOption>否</option>
</select><br/>
HTML;

                break;
            case 'no_out':
$selectedOption = ($value == "0") ? 'selected' : '';
$item_mid_page .= <<<HTML
是否不可丢弃:<select name="no_out">
<option value="1" >是</option>
<option value="0" $selectedOption>否</option>
</select><br/>
HTML;

                break;
            case 'attack_value':
                $item_mid_page .= <<<HTML
攻击力(attack_value):<input name="attack_value" type="text" value="$value" size="10" maxlength="10"/><br/>
HTML;
                break;
            case 'equip_cond':
                $item_mid_page .= <<<HTML
装备条件表达式:<textarea name="use_cond" maxlength="1024" rows="4" cols="40"></textarea><br/>
HTML;
                break;
        default:
        switch($attr_type){
            case '0':
        $item_mid_page .= <<<HTML
        $name:<input name="$id" type="number" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
            case '1':
        $item_mid_page .= <<<HTML
        $name:<input name="$id" type="text" value="$value" size="10" maxlength="10"/><br/>
HTML;
            break;
            case '2':
$selectedOption = ($value == "1") ? 'selected' : '';
$item_mid_page .= <<<HTML
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
if($item_type =="消耗品"){
$stmt = $dblj->prepare('SELECT * FROM gm_game_attr where value_type =1 and if_basic !=1 or if_item_use_attr =1');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 构建 select 元素的 HTML 代码
$select = '使用目标(use_attr):<select name="use_attr">';
foreach ($data as $item_row) {
    $selected = ($item_row['id'] == $use_attr) ? ' selected' : '';
    $select .= '<option value="' . htmlspecialchars($item_row['id']) . '"' . $selected . '>' . htmlspecialchars($item_row['name']) . '</option>';
                }
    $select .= '</select><br/>';
$item_mid_page .= <<<HTML
$select
HTML;
$item_mid_page .=<<<HTML
使用效果值(use_value):<input name="use_value" type="text" value="{$use_value}" size="10" maxlength="10"/><br/>
HTML;
}

if($item_type =="书籍"){
    $item_mid_page .= <<<HTML
    书籍详细内容(会自动根据字数识别为翻页):<textarea name="detail_desc" maxlength="1024" rows="10" cols="40" >{$detail_desc}</textarea><br/>
HTML;
}

if($item_type =="兵器" || $item_type =="兵器镶嵌物" ||$item_type =="防具"||$item_type =="防具镶嵌物"){
$sql = "SELECT * FROM system_item_module where iid = '$item_id';";
$stmt = $dblj->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$attack_value = $data[0]['iattack_value'];
$recovery_value = $data[0]['irecovery_value'];
$embed_count = $data[0]['iembed_count'];
$equip_cond = $data[0]['equip_cond'];
if($item_type =="兵器" || $item_type =="兵器镶嵌物"){
     $item_mid_page .= <<<HTML
攻击力(attack_value):<input name="attack_value" type="text" value="{$attack_value}" size="10" maxlength="10"/><br/>
HTML;
if($item_type =="兵器"){
    $item_mid_page .= <<<HTML
    可镶宝数(embed_count):<input name="embed_count" type="text" value="{$embed_count}" size="10" maxlength="10"/><br/>
HTML;
}
}

if($item_type =="防具" || $item_type =="防具镶嵌物"){
     $item_mid_page .= <<<HTML
防御力(recovery_value):<input name="recovery_value" type="text" value="{$recovery_value}" size="10" maxlength="10"/><br/>
HTML;
if($item_type =="防具"){
    $item_mid_page .= <<<HTML
    可镶宝数(embed_count):<input name="embed_count" type="text" value="{$embed_count}" size="10" maxlength="10"/><br/>
HTML;
}
}
$item_mid_page .= <<<HTML
装备条件表达式:<textarea name="equip_cond" maxlength="1024" rows="4" cols="40">{$equip_cond}</textarea><br/>
HTML;
}

$item_page = <<<HTML
<p>定义物品“{$item_name}”的属性<br/>
</p>
<form method="post">
<input type="hidden" name="id" value="$item_id">
$item_mid_page
<input type="submit" value="提交">
</form>
<a href="game.php?cmd=$item_main">返回上级</a><br/>
HTML;
echo $item_page;
?>


<style>
  /* 设置 input 标签的样式 */
  #color-input {
    width: 30px; /* 宽度 */
    height: 30px; /* 高度 */
    border: none; /* 无边框 */
    outline: none; /* 无轮廓 */
    cursor: pointer; /* 鼠标指针 */
  }
</style>

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




