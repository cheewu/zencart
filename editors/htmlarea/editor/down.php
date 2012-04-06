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
	die("<script language=javascript>alert('��½��ʱ!');parent.window.location='login.php';</script>");
}
$root = $user["root"];
$path = dealpath($path);
if (!$path || !$user["downfile"]) exit("<script>alert('û��Ȩ��!');</script>");
if ($action == "downfile")
{
	$path = str_replace("|","",$path);
	$ftype = getext($path);
	if ($user["limit"]["$ftype"] && !$user["only"])
		exit("<script>alert('����������{$user["limittype"]}���͵�Դ�ļ�!');</script>");
	else if(!$user["limit"]["$ftype"] && $user["only"])
		exit("<script>alert('���������س�{$user["limittype"]}���������Դ�ļ�!');</script>");
	$path=str_replace("|","",$path);
	if (!file_exists($path)) exit("<script>alert('�ļ�������!!');</script>");
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
	if (!$content = zippack($path,$sdir,$sfile)) die("<script>alert('����ʱ����!');</script>");
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