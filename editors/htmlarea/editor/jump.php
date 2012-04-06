<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

include_once("func.php");
include_once("config.php");
header("Content-type:TEXT/HTML;Charset=GB2312");

$url = $_GET["url"];
if (!$url) die();

if ($allowurlencode)
{
	header("location:".urlencode1(urldecode1($_GET["url"])) );
	die();
}
else 
{
?>
<html><head>
<title>跳转</title>
<meta http-equiv="refresh" content="0; url=<?php echo $url;?>" />
</head>
<body>正在为您转到相应的网页，如果您的浏览器没有自动跳转，请点击<a href="<?php echo $url;?>">这里</a></body>
</html>
<?
}
exit;
?>