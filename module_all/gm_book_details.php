<?php
include 'pdo.php';
$out_book = $encode->encode("cmd=item_html&canshu=书籍&ucmd=$cmid&sid=$sid");

if(!function_exists('mb_str_split')){
function mb_str_split($string, $length = 1) {
    $result = [];
    $stringLength = mb_strlen($string, 'UTF-8');

    for ($i = 0; $i < $stringLength; $i += $length) {
        $result[] = mb_substr($string, $i, $length, 'UTF-8');
    }

    return $result;
}
}
//$iid = 23;

$sql = "select iname,idetail_desc from system_item_module where iid = '$iid'";
$cxjg = $dblj->query($sql);
$ret = $cxjg->fetch(PDO::FETCH_ASSOC);

// 假设 $article 变量包含了一篇文章的内容
$title = $ret['iname'];//实际文章标题
$article = $ret['idetail_desc']; // 实际文章内容

// Determine the number of characters to split based on screen width
$splitLength = (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false) ? 30 : 80;

// Split the article into chunks
$articleChunks = mb_str_split($article, $splitLength);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
:root {
    --w: 240px; 
    --h: 240px; 
}

body {
    margin: 0;
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #F5F5DC;  /* 米黄色背景 */
}

#book {
    height: var(--h);
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 1s;
    perspective: 1600px;
    transform-style: preserve-3d;
}

.book-cover {
    text-align: left;
    background-color: #8B4513;  /* 深棕色的封面 */
    height: calc(var(--h) + 50px);
    width: calc(var(--w) + 50px);
    position: absolute;
    background-image: linear-gradient(45deg, 
        #8B4513,  /* 深棕色 */
        #A0522D,  /* 红褐色 */
        #8B4513   /* 深棕色 */
    );
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    transition: 1s;
    transform-origin: left;
    backface-visibility: visible;
    border: 2px solid #4A2410;  /* 深色边框 */
    box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);  /* 添加阴影 */
}

.book-cover .cover-text {
    text-align: center;
    font-family: '楷体', KaiTi, serif;  /* 使用更古典的字体 */
    font-size: 16px;
    color: #F5DEB3;  /* 浅褐色文字 */
    padding: 10px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);  /* 文字阴影 */
}

.book-page {
    text-align: left;
    font-family: '宋体', SimSun, serif;
    line-height: 1.6;
    background-color: #FFF8DC;  /* 米色背景 */
    height: var(--h);
    width: var(--w);
    position: absolute;
    z-index: 100;
    transition: 1s;
    transform-origin: -25px;
    background-size: cover;
    backface-visibility: visible;
    border-right: 1px solid #DEB887;  /* 页面右侧边缘 */
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);  /* 轻微阴影 */
    padding: 15px;
    box-sizing: border-box;
    color: #2F1810;  /* 深褐色文字 */
}

#control {
    margin-top: 60px;
    user-select: none;
}

#textDiv_4 {
    display: none !important;
}

#control button {
    display: inline-block;
    width: 45px;
    height: 45px;
    border: 0;
    margin: 0px 15px;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    border-radius: 50%;
    background-color: rgba(63, 63, 63, 0.8);
    outline: none;
}

/* Media query for screens smaller than 600px (adjust the value as needed) */
@media only screen and (max-width: 600px) {
    :root {
        --w: 150px;
        --h: 180px;
        --cover-padding: 25px;
    }

    .book-cover {
        height: calc(var(--h) + var(--cover-padding));
        width: calc(var(--w) + var(--cover-padding));
    }

    .book-page {
        transform-origin: -12.5px;
    }

    #book {
        transform: translateX(0);
    }
}

    </style>
</head>
<body>
    <div id="book">
        <div class="book-cover one-page">
        <div class="cover-text"><?php echo nl2br($title); ?></div>
        </div>
        <?php foreach ($articleChunks as $index => $chunk): ?>
            <div class="book-page one-page"><?php echo nl2br($chunk); ?></div>
        <?php endforeach; ?>

        <div class="book-cover one-page"></div>
    </div>
    <div id="control">
        <button>&lt;</button>
        <button>&gt;</button>
    </div>
    <div id="out">
        <?php echo "<a href='?cmd={$out_book}'>退出</a>" ?>
    </div>
    <script>
        // 总页数
        const PAGECOUNT = <?php echo count($articleChunks) + 2; ?>;
        // 当前页面编号
        let pageNo = 0

        // 内容页
        let pages = document.querySelectorAll('.book-page')
        // 封面页
        let cover = document.querySelectorAll('.book-cover')
        // 按钮
        let btn = document.querySelectorAll('#control button')
        // 
        let book = document.querySelector('#book')
        // 所有页
        let allPages = document.querySelectorAll('.one-page')

        function init() {
            // 初始化内容页
            for (let index = 0; index < pages.length; index++) {
                pages[index].style.zIndex = PAGECOUNT - index - 1
            }
            cover[0].style.zIndex = PAGECOUNT
            cover[1].style.zIndex = 1

            // 默认页面为封面，左按钮无效
            btn[0].style.backgroundColor = "rgba(110, 110, 110, 0.5)"
            btn[0].style.color = "darkgray"
            btn[0].disabled = true
            
            // 左翻页
            btn[0].onclick = function() {
                pageNo -- 
                // 如果当前是最后一页，并往前翻
                if ((PAGECOUNT - 1) == pageNo) {
                    allPages[pageNo].style.transform = 'rotateY(0deg)'
                    //( 240px + 50px ) * 0.5
                    book.style.transform = 'translateX(145px)'
                    btn[1].style.backgroundColor = "rgba(63, 63, 63, 0.8)"
                    btn[1].style.color = "white"
                    btn[1].disabled = false   
                }
                else {
                    allPages[pageNo].style.transform = 'rotateY(0deg)'
                }
                allPages[pageNo].style.zIndex = PAGECOUNT - pageNo

                if( 0 == pageNo ) {
                    btn[0].style.backgroundColor = "rgba(110, 110, 110, 0.5)"
                    btn[0].style.color = "darkgray"
                    btn[0].disabled = true
                    book.style.transform = 'translateX(0px)'
                }
            }

            // 右翻页
            btn[1].onclick = function() {
                if (0 == pageNo) {
                    allPages[pageNo].style.transform = 'rotateY(-180deg)';
                    // 移动端和PC端使用不同的位置计算
                    const middlePosition = window.innerWidth <= 600 
                        ? `${75 + 12.5}px`  // 移动端：150/2 + 25/2
                        : '145px';          // PC端：(240 + 50)/2
                    book.style.transform = `translateX(${middlePosition})`;
                    btn[0].style.backgroundColor = "rgba(63, 63, 63, 0.8)";
                    btn[0].style.color = "white";
                    btn[0].disabled = false;   
                } else {
                    allPages[pageNo].style.transform = 'rotateY(-180deg)';
                }

                allPages[pageNo].style.zIndex = 1000 + pageNo;
                pageNo++;

                if (PAGECOUNT == pageNo) {
                    btn[1].style.backgroundColor = "rgba(110, 110, 110, 0.5)";
                    btn[1].style.color = "darkgray";
                    btn[1].disabled = true;
                    // 移动端和PC端使用不同的结束位置
                    const endPosition = window.innerWidth <= 600
                        ? '175px'  // 移动端：150 + 25
                        : '300px'; // PC端
                    book.style.transform = `translateX(${endPosition})`;
                }
            }
        }
        init()
    </script>
</body>
</html>
