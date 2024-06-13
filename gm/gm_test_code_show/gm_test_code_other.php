<?php
// 这里是你的业务逻辑，设置 $text 变量
$text = $test_code_text;
// 以下是 HTML 和 JavaScript 部分

?>
    <script>
        function toggleText_4() {
            var textDiv = document.getElementById("textDiv_4");
            
            if (textDiv.style.display === "none" || textDiv.style.display === "") {
                textDiv.style.display = "block";
            } else {
                textDiv.style.display = "none";
            }
        }
    </script>
  <button onclick="toggleText_4()">尾部信息</button><div id="textDiv_4" style="display: block;"><?php echo($text); ?></div><br/>
