<?php
$gm_main = $encode->encode("cmd=gm&sid=$sid");
$doc_edit_post = $encode->encode("cmd=gm_design_guide&edit_canshu=1&sid=$sid");

// 获取当前脚本所在的目录
$current_dir = dirname(__FILE__);
$edit_file_path = $current_dir . '/design_help.txt';

if ($_POST['gm_doc_text']) {
    $gm_doc_text_post = $_POST['gm_doc_text'] ?? '';
    // 写入文件
    if (file_put_contents($edit_file_path, $gm_doc_text_post) !== false) {
        echo "doc文件已成功更新。<br/>";
    } else {
        echo "更新doc文件时出错。<br/>";
    }
}

if ($update_canshu == '1') {
    $down_url = "https://xunxian.txsj.ink/gm/design_help.txt";
    $down_doc = file_get_contents($down_url);
    if (file_put_contents($edit_file_path, $down_doc) !== false) {
        echo "doc文件已成功更新。<br/>";
    } else {
        echo "更新doc文件时出错。<br/>";
    }
}

if (file_exists($edit_file_path)) {
    // 读取文件内容并赋值给变量
    $gm_edit_text_root = file_get_contents($edit_file_path);
    // 使用正则表达式分割字符串，按 <h1></h1> 标签为分割点
    preg_match_all('/<h1>(.*?)<\/h1>(.*?)(?=<h1>|$)/s', $gm_edit_text_root, $matches);
    // 获取标题和内容
    $titles = $matches[1]; // 存储所有 <h1> 标题
    $contents = $matches[2]; // 存储标题对应的内容

    // 输出分页结果
    $pageCount = count($titles);
    
    if ($pageCount > 0) {
    $edit_content .= '<div id="pagination">';
    for ($i = 1; $i <= $pageCount; $i++) {
        $edit_content .= <<<HTML
<button id="page-button-{$i}" onclick="showPage({$i})" class="pagination-button">{$i}</button>
HTML;
    }
    $edit_content .= '</div>';
}

    $edit_content .= '<div id="content-container">';

for ($index = 1; $index < $pageCount +1; $index++) {
    $edit_content .= <<<HTML
<div class="page" id="page-{$index}" style="display: none;">
    <h1>{$titles[$index-1]}</h1>
    <p>{$contents[$index-1]}</p>
</div>
HTML;
}
    $edit_content .= '</div>';

    $gm_edit_text = $edit_content;
}

$gm_edit_text_ord = file_get_contents($edit_file_path);

// 编辑和返回页面的功能
    if ($edit_canshu == '1') {
    $ret_doc = $encode->encode("cmd=gm_design_guide&sid=$sid");
    $html =<<<HTML
<a href="?cmd=$ret_doc">返回文档</a><br/>
<form action="?cmd=$doc_edit_post" method="POST">
<textarea name="gm_doc_text" maxlength="-1" rows="20" cols="80" >{$gm_edit_text_ord}</textarea><br/>
<input name="submit" type="submit" title="修改" value="修改" >
</form>
<a href="?cmd=$gm_main">返回设计大厅</a>
HTML;
} else {
    $doc_edit = $encode->encode("cmd=gm_design_guide&edit_canshu=1&sid=$sid");
    $doc_update = $encode->encode("cmd=gm_design_guide&update_canshu=1&sid=$sid");
    $html =<<<HTML
<div class="search-container">
    <input type="text" id="searchInput" placeholder="请输入搜索关键词...">
    <button onclick="searchText()">搜索</button>
</div>
<a href="?cmd=$doc_edit">编辑文档(不明情况者勿点！)</a>
<a href="?cmd=$doc_update">获取最新文档</a><br/>
HTML;
    $html .= $gm_edit_text;
    $html .=<<<HTML
<br/><a href="?cmd=$gm_main">返回设计大厅</a>
HTML;
    $html = nl2br(html_entity_decode($html));
}

echo $html;
?>

<script>
let currentPage = 1;
const totalPages = <?php echo $pageCount; ?>;
const show_true = <?php echo $edit_canshu?:0; ?>;

function searchText() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    if (!searchTerm) {
        alert('请输入搜索关键词');
        return;
    }

    // 获取当前显示的页面
    const currentPageElement = document.getElementById('page-' + currentPage);
    if (!currentPageElement) return;

    // 获取页面的文本内容
    const content = currentPageElement.textContent.toLowerCase();
    
    if (content.includes(searchTerm)) {
        // 移除之前的高亮
        currentPageElement.innerHTML = currentPageElement.innerHTML.replace(/<mark class="highlight">(.*?)<\/mark>/g, '$1');
        
        // 高亮搜索词（保持原有格式）
        const textNodes = [];
        const walk = document.createTreeWalker(
            currentPageElement,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );

        let node;
        while (node = walk.nextNode()) {
            textNodes.push(node);
        }

        textNodes.forEach(textNode => {
            const text = textNode.textContent;
            const regex = new RegExp(searchTerm, 'gi');
            if (regex.test(text)) {
                const span = document.createElement('span');
                span.innerHTML = text.replace(regex, match => `<mark class="highlight">${match}</mark>`);
                textNode.parentNode.replaceChild(span, textNode);
            }
        });

        // 滚动到第一个高亮处
        const firstHighlight = currentPageElement.querySelector('.highlight');
        if (firstHighlight) {
            firstHighlight.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    } else {
        alert('当前页面未找到匹配内容');
    }
}

// 添加回车键搜索功能
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchText();
    }
});

function showPage(page) {
    // 清除所有高亮
    document.querySelectorAll('.highlight').forEach(el => {
        const parent = el.parentNode;
        parent.replaceChild(document.createTextNode(el.textContent), el);
    });
    
    // 隐藏所有页面
    for (let i = 1; i <= totalPages; i++) {
        document.getElementById('page-' + i).style.display = 'none';
    }

    // 显示当前页面
    document.getElementById('page-' + page).style.display = 'block';

    // 更新当前页面
    currentPage = page;

    // 高亮当前分页按钮
    const buttons = document.querySelectorAll('.pagination-button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });
    document.getElementById('page-button-' + page).classList.add('active');
}

// 默认显示第一页
if(show_true==0){
    showPage(1);
}
</script>

<style>
.pagination-button {
    margin: 0 5px;
    padding: 5px 10px;
    cursor: pointer;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.pagination-button.active {
    background-color: #007BFF;
    color: white;
}

.search-container {
    margin: 10px 0;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.search-container input {
    padding: 5px 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 200px;
}

.search-container button {
    padding: 5px 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: #0056b3;
}

.highlight {
    background-color: yellow;
    padding: 2px;
    border-radius: 2px;
}
</style>
