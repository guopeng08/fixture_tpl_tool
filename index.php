<?php

// php -f index.php > output.log

// 装修工具

// 装修按钮 序列化 解析
$show_html .= '<a href="./clear_edit_btn.php">清空装修按钮数据</a>';
$show_html .= "<br />";
$show_html .= '<a href="./create_edit_btn.php">创建/编辑装修按钮数据</a>';

echo $show_html;exit;