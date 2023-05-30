<form action="" method="post">
<?php foreach ($attr_array as $id => $value): ?>
  <?php if ($id === 'id'): ?>
    <?php echo "{$row['id']}：s{$value}"; ?><br>
  <?php elseif ($id === 'name'): ?>
    名称: <input type="$" name="<?php echo $id; ?>" value="<?php echo $value; ?>"><br>
  <?php else: ?>
    <?php // 生成其他类型的输入框 ?>
  <?php endif; ?>
<?php endforeach; ?>
<input type="submit" value="提交">
</form>


