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
if (!$user["admin"]) exit("没有权限");
@extract($_POST,EXTR_OVERWRITE);


if (($action == "adduser" || $action == "muser") && $user["adduser"])
{
	$username = trim($new_user);
	$password = trim($new_pass);
	$confirm  = trim($new_confirm_pass);
	$root     = trim($new_root);
	if (substr($root,-1) !="/") $root.="/";
	$group    = trim($new_group);
	if (!$username || !root || $password !=$confirm || !$group || (!$password && $action == "adduser")) exit4("内容不完整!",0);

	if (!is_writeable("class/users.php"))
	{
		exit4("文件 class/users.php 不可写,请修改其属性为可读写(0777)!");
	}
	
	if ($action == "adduser")
	{
		$password = my_encode($password);
		$s = "\n{$username}|{$password}|{$root}|{$group}|";
		$fp = @fopen("class/users.php","a+");
		@fputs($fp,$s);
		if (!is_dir($root)) @mkdir($root);
		makeup("class/users.php");
		exit4("用户 {$username} 添加成功!",@fclose($fp));
	}
	else
	{
		$users = @file("class/users.php");
		$content = "";
		foreach($users as $v)
		{
			if (!$v) continue;
			$arr  = explode("|",$v);
			if ($arr[0] == $username)
			{
				if ($arr[1] != my_encode($_POST["origpass"]) && $user["group"] != "administrators") exit4("由于您不在administrators组\\n只有输入正确的密码才能继续操作!",0);
				$password = ($password)?my_encode($password):$arr[1];
				$content .= "{$username}|{$password}|{$root}|{$group}|\n";
			}
			else $content.="{$v}\n";	
		}
		$action = "user";
		if (@file_put_contents("class/users.php",$content))
		{
			makeup("class/users.php");
			exit4("用户 {$username} 更新成功!");
		}
		else exit4("更新用户失败!");
	}
}
else if ($action == "deluser" && $user["deluser"])
{
	if (!$username) exit4("内容不完整!",0);
	$arr = file("class/users.php");
	$content='';
	
	if (!is_writeable("class/users.php"))
	{
		exit4("文件 class/users.php 不可写,请修改其属性为可读写(0777)!");
	}
	
	for($i=0;$arr[$i];$i++)
	{
		$v = $arr[$i];
		if (!$v) continue;
		$arr2 = explode("|",$v);
		if ($arr2[0] != $username)
		{
			$content.=$v;
		}
	}
	if (@file_put_contents("class/users.php",$content))
	{
		makeup("class/users.php");
		exit4("用户 {$username} 成功删除!");
	}
}

else if (($action == "addgroup" || $action == "mgroup") && $user["addgroup"])
{
	$s = trim($_POST["groupname"]);
	if (!$s) exit4("内容不完整!",0);
	$s.="|";
	$jumpkeys = "||limittype|action|groupname|adduser|addgroup|deluser|delgroup|";
	$keys = array_keys($_POST);
	foreach($keys as $k)
	{
		if (strpos($jumpkeys,$k)) continue;
		if ( $_POST["$k"] ) $s.="{$k}|";
	}
	if ($_POST["admin"])
	{
		if ($_POST["adduser"])	$s.= "adduser|";
		if ($_POST["deluser"])	$s.= "deluser|";
		if ($_POST["delgroup"])	$s.= "delgroup|";
		if ($_POST["addgroup"])	$s.= "addgroup|";
	}
	$limittype = trim(str_replace("|","&",$limittype));
	if (substr($limittype,0,1) != "&")	$limittype = "&".$limittype;
	if (substr($limittype,-1) == "&") 	$limittype = substr($limittype,0,-1);
	if ($limittype)	$s.=$limittype."|";
	
	if (!is_writeable("class/group.php"))
	{
		exit4("文件 class/group.php 不可写,请修改其属性为可读写(0777)!");
	}
	
	if ($action == "addgroup")
	{
		$fp = @fopen("class/group.php","a+");
		@fputs($fp,"\n".$s);
		if (@fclose($fp))
		{
			makeup("class/group.php");
			exit4("组 {$groupname} 添加成功!");
		}
	}
	else if ($action == "mgroup")
	{
		$action = "group";
		$groups=@file("class/group.php");
		$content = "";
		for($i=0;$groups[$i];$i++)
		{
			$v = trim ($groups[$i]);
			if (!$v) continue;
			$arr = explode("|",$v);
			if ($arr[0] == $groupname)
			{
				$content.="{$s}\n";
				$foundit = 1;
			}
			else $content.="{$v}\n";
		}
		if (!$foundit)
			exit4("组 {$groupname} 不存在!",0);
		else if (@file_put_contents("class/group.php",$content))
		{
			makeup("class/group.php");
			exit4("组 {$groupname} 更新成功!");
		}
	}
}
else if ($action == "delgroup" && $user["delgroup"])
{
	if (!$groupname) exit4("内容不完整!",0);
	$arr = file("class/group.php");
	$content='';
	
	if (!is_writeable("class/group.php"))
	{
		exit4("文件 class/group.php 不可写,请修改其属性为可读写(0777)!");
	}
	
	for($i=0;$arr[$i];$i++)
	{
		$v = $arr[$i];
		if (!$v) continue;
		$arr2 = explode("|",$v);
		if ($arr2[0] != $groupname)
		{
			$content.=$v;
		}
	}
	if (@file_put_contents("class/group.php",$content))
	{
		makeup("class/group.php");
		exit4("组 {$groupname} 成功删除!");
	}
}
else if ($action == "config")
{
	if (!$title || !$tempname) exit4("内容不完整!",0);
	$title = $_POST["title"];
	$tempname = $_POST["tempname"];
	$title = addslashes($title);
	$force_encode = $_POST['force_encode'];
	if (!$force_encode) $force_encode = "GB2312";
	$allowurlencode = $_POST['allowurlencode'];
	$allowurlencode = ($allowurlencode)?'1':'0';
	
$s = <<<END

{#}title = '$title';
{#}tempname = '$tempname';
{#}force_encode = '$force_encode';
{#}allowurlencode = $allowurlencode;

END;
	$s = str_replace('{#}','$',$s);
	$s = '<?php'.$s.'?>';	
	if (!is_writeable("info.php"))
	{
		exit4("文件 info.php 不可写,请修改其属性为可读写(0777)!");
	}
	
	if (@file_put_contents("info.php",$s))
	{
?>
<html>
<body>正在刷新，如果没有自动刷新，请点击<a href="index.php?random=423" target=_top>这里</a>
<script>
top.location.href = "index.php";
</script>
</body>
</html>
<?
		die();
	}
}
else
{
	exit4("没有权限!",0);
}

function exit4($s,$t=1)
{
	global $action;
	echo "<script>alert('$s');";
	echo (!$t)?"history.go(-1);":"window.location = 'admin.php?action={$action}';"; 
	echo "</script>";
	die;
}

function makeup($file)
{
	if (!$file) return;
	$lines = @file($file);
	$contents='';
	foreach($lines as $l)
	{
		$l = trim($l);
		if (!$l) continue;
		$contents.=$l."\n";
	}
	@file_put_contents($file,$contents);
}
?>