<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

include_once("info.php");
$welcome="欢迎使用 PHPCMS文件管理器 v4.03";			//登陆成功后的提示信息
$preload = 0;			//客户端是否启用预下载（启用后，客户端速度加快，但服务器负担加重）
$jumpfiles="";			//需要服务端跳转的文件（暂时还不支持）
$max_time_limit=60; 			//页面执行最长时间(秒)
$charset="GB2312";			//默认编码
$imgmax=70;			//图片最大宽或高
$cookieexp = 60;			//客户端剪贴板过期时间
$v=403;				//内部版本号
$version = "4.03";			//版本
$sitewidth = 760;			//网站整体宽度
$editfiles="|php|php3|asp|txt|jsp|inc|ini|pas|cpp|bas|in|out|htm|html|js|htc|css|c|sql|bat|vbs|cgi|dhtml|shtml|xml|xsl|aspx|tpl|";
				//可用编辑器编辑的文件类型
$searchfiles = $editfiles;		//可用搜索内容的文件类型

$language = "simple_chinese.lang.php"; 	//语言文件
$host_charset = "GB2312";		//服务器文件名编码
?>