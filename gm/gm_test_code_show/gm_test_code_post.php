<?php
// 这里是你的业务逻辑，设置 $text 变量
ob_start();
$text = $test_code_text;
ob_clean();
// 以下是 HTML 和 JavaScript 部分
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        function toggleText_3() {
            var textDiv = document.getElementById("textDiv_3");
            
            if (textDiv.style.display === "none" || textDiv.style.display === "") {
                textDiv.style.display = "block";
            } else {
                textDiv.style.display = "none";
            }
        }
    </script>
</head>
<body>
  <button onclick="toggleText_3()">post表</button><div id="textDiv_3" style="display: none;"><?php echo $text; ?></div><br/>
</body>
</html>
