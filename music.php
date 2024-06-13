<?php
// 替换为你的音乐链接
$musicURL = 'https://xunxian.txsj.ink/周杰伦-晴天.flac';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Music on Interaction</title>
</head>

<body>

<audio id="myAudio" controls>
    <source src="<?php echo $musicURL; ?>" type="audio/mp3">
    Your browser does not support the audio tag.
</audio>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var audio = document.getElementById("myAudio");

    // 添加用户交互事件监听器，例如点击文档时播放音频
    document.addEventListener("click", function() {
        audio.play().then(function() {
            // 音频已成功开始播放
            console.log("音频已开始播放");
        }).catch(function(error) {
            // 播放被浏览器阻止，可能是自动播放策略
            console.error("播放失败:", error);
        });
    });
});
</script>

</body>
</html>
