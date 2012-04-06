<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

include_once("common.php");
include_once("class/longbill.class.php");

$user = check_login();
if (!$user)
{
	header("Content-type:TEXT/HTML;Charset=GB2312");
	die("<script language=javascript>alert('登陆超时!');parent.window.location='login.php';</script>");
}
$root = $user["root"];
$path = dealpath($path);
if (!$path || !$user["downfile"]) exit("<script>alert('没有权限!');</script>");
if ($action == "downfile")
{
	$path = str_replace("|","",$path);
	$ftype = getext($path);
	if ($user["limit"]["$ftype"] && !$user["only"])
		exit("<script>alert('您不能下载{$user["limittype"]}类型的源文件!');</script>");
	else if(!$user["limit"]["$ftype"] && $user["only"])
		exit("<script>alert('您不能下载除{$user["limittype"]}类型以外的源文件!');</script>");
	$path=str_replace("|","",$path);
	if (!file_exists($path)) exit("<script>alert('文件不存在!!');</script>");
	$filename = basename1($path);
	header('Content-type: application/force-download');
	header("Content-Disposition: attachment; filename={$filename}");
	header("Content-length: ".filesize($path));
	readfile($path);
	die;
}
else if ($action == "downfiles")
{
	$sfile = urldecode($_GET["files"]);
	$sdir = urldecode($_GET["dirs"]);
	if (!$content = zippack($path,$sdir,$sfile)) die("<script>alert('下载时出错!');</script>");
	$filename = substr($path,0,strlen($path)-1).".zip";
	$filename = basename1($filename);
	if ($filename == "..zip" || $filename == "...zip") $filename = "root.zip";	
	header('Content-type: application/force-download');
	header("Content-Disposition: attachment; filename={$filename}");
	header("Content-length:".strlen($content));
	echo $content;
	die;
}
?>