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
<title>��ת</title>
<meta http-equiv="refresh" content="0; url=<?php echo $url;?>" />
</head>
<body>����Ϊ��ת����Ӧ����ҳ��������������û���Զ���ת������<a href="<?php echo $url;?>">����</a></body>
</html>
<?
}
exit;
?>