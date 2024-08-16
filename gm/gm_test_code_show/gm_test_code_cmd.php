<?php
// 这里是你的业务逻辑，设置 $text 变量
$text = $test_code_text;
// 以下是 HTML 和 JavaScript 部分
?>
    <script>
        function toggleText_2() {
            var textDiv = document.getElementById("textDiv_2");
            
            if (textDiv.style.display === "none" || textDiv.style.display === "") {
                textDiv.style.display = "block";
            } else {
                textDiv.style.display = "none";
            }
        }
    </script>
  <button onclick="toggleText_2()">cmd表</button><div id="textDiv_2" style="display: none;"><?php echo $text; ?></div><br/>
