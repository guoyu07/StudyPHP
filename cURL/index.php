<?php
/**
 * 参考1：如何给post请求传递json数据-http://cn2.php.net/manual/en/function.curl-setopt.php
 * 参考2：使用php的curl给post请求传递json数据-http://bbs.csdn.net/topics/390273161
 */

// 创建一个cURL资源
$ch = curl_init();

// 设置URL和相应的选项
curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com/");
curl_setopt($ch, CURLOPT_HEADER, 0);

// 抓取URL并把它传递给浏览器
curl_exec($ch);

// 关闭cURL资源，并且释放系统资源
curl_close($ch);
?>