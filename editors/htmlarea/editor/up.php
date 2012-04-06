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
$user = check_login();
$root = $user["root"];
if (!$user) exit3('登陆超时!');
header("content-type:text/html; charset=gb2312");

$path=dealpath($path);
if (!$path) exit3("没有权限!",0);
////////////文件上传//////////////
if ($action=="upsave" && $user["upfile"])
{
	if (substr($path,-1)!="/") $path.="/";
	$tt=0;
	$error='';
	$tsize = 0;
	if (!is_writable($path))
	{
		exit3("上传失败:目录 {$path} 不可写!",0);
	}
	foreach($_FILES as $file)
	{
		if ($file['tmp_name'])
		{
			$myfile=$file["tmp_name"];
			$myfile_name=checkfilename($file["name"]);
			$ftype = getext($myfile_name);
			if ($myfile_name!= $file["name"] || !$myfile_name)
			{
				$error.="{$myfile_name}上传失败:文件名有错误\\n";
			}
			else if ($user["limit"]["$ftype"] && !$user["only"])
			{
				$error.="{$myfile_name}上传失败:不能能上传 ".$user["limittype"]." 类型的文件\\n";
			}
			else if (!$user["limit"]["$ftype"] && $user["only"])
			{
				$error.="{$myfile_name}上传失败:不能能上传除 ".$user["limittype"]." 类型以外的文件\\n";
			}
			else if (file_exists($path.$myfile_name))
			{
				$error.=$myfile_name."上传失败:有同名文件存在!\\n";
				continue;
			}
			else if (@move_uploaded_file($myfile,$path.$myfile_name))
			{
				$tt++;
				$tsize += filesize($path.$myfile_name);
				inlog("上传文件,".$path.$myfile_name."成功");
			}
			else
			{
				$error.=$myfile_name."上传失败:原因不明!\\n";
				continue;
			}
		}
	}
	$str="成功上传{$tt}个文件!!";
	$str.="\\n总大小:".dealsize($tsize)."\\n";
	$str.=($error)?"\\n以下是错误信息:\\n".$error:"";
	exit3($str);
}
else
{
	exit3("没有权限!",0);
}

function exit3($s,$r=1)
{
	$ss = "<script language=javascript>alert('$s');";
	$ss.=($r)?"parent.reloaddata();":"";
	$ss.="</script>";
	exit($ss);
}

function checkfilename($file)
{
	if (!$file) return false;
	$file = trim($file);
	$a = substr($file,-1);
	while ($a =="." || $a =="/" || $a == "\\" || $a == " " || $a == "'" || $a == "+" || $a == "&" || $a == "\"" || $a == ".")
	{
		$file=substr($file,0,-1);
		$a = substr($file,-1);
	}
	$arr = array("../","./","..\\",".\\");
	$file = str_replace($arr,"",$file);
	return $file;
}
?>