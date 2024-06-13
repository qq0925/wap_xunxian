<?php
// 这里是你的业务逻辑，设置 $text 变量
$text = $test_code_text;
// 以下是 HTML 和 JavaScript 部分
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        function toggleText() {
            var textDiv = document.getElementById("textDiv");
            
            if (textDiv.style.display === "none" || textDiv.style.display === "") {
                textDiv.style.display = "block";
            } else {
                textDiv.style.display = "none";
            }
        }
    </script>
</head>
<body>
  <button onclick="toggleText()">user表</button><div id="textDiv" style="display: none;"><?php print_r($text); ?></div><br/>
</body>
</html>
