<?php


// 提取/abc/后面的内容
if (preg_match('#/abc/(.+)$#', $request_uri, $matches)) {
    $id = $matches[1];
} else {
    $id = '';
}

// 目标域名
$target_domain = 'https://B域名.com'; // 请替换为实际域名

// 构建目标URL
if (!empty($id)) {
    $target_url = $target_domain . '/' . $id;
} else {
    $target_url = $target_domain;
}

// 执行跳转
header('Location: ' . $target_url, true, 302);
exit;
?>
