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
if (!$user) exit3('��½��ʱ!');
header("content-type:text/html; charset=gb2312");

$path=dealpath($path);
if (!$path) exit3("û��Ȩ��!",0);
////////////�ļ��ϴ�//////////////
if ($action=="upsave" && $user["upfile"])
{
	if (substr($path,-1)!="/") $path.="/";
	$tt=0;
	$error='';
	$tsize = 0;
	if (!is_writable($path))
	{
		exit3("�ϴ�ʧ��:Ŀ¼ {$path} ����д!",0);
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
				$error.="{$myfile_name}�ϴ�ʧ��:�ļ����д���\\n";
			}
			else if ($user["limit"]["$ftype"] && !$user["only"])
			{
				$error.="{$myfile_name}�ϴ�ʧ��:�������ϴ� ".$user["limittype"]." ���͵��ļ�\\n";
			}
			else if (!$user["limit"]["$ftype"] && $user["only"])
			{
				$error.="{$myfile_name}�ϴ�ʧ��:�������ϴ��� ".$user["limittype"]." ����������ļ�\\n";
			}
			else if (file_exists($path.$myfile_name))
			{
				$error.=$myfile_name."�ϴ�ʧ��:��ͬ���ļ�����!\\n";
				continue;
			}
			else if (@move_uploaded_file($myfile,$path.$myfile_name))
			{
				$tt++;
				$tsize += filesize($path.$myfile_name);
				inlog("�ϴ��ļ�,".$path.$myfile_name."�ɹ�");
			}
			else
			{
				$error.=$myfile_name."�ϴ�ʧ��:ԭ����!\\n";
				continue;
			}
		}
	}
	$str="�ɹ��ϴ�{$tt}���ļ�!!";
	$str.="\\n�ܴ�С:".dealsize($tsize)."\\n";
	$str.=($error)?"\\n�����Ǵ�����Ϣ:\\n".$error:"";
	exit3($str);
}
else
{
	exit3("û��Ȩ��!",0);
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