<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

@error_reporting(1);
include_once("common.php");

$uc=check_login();
header("Content-type:TEXT/HTML;Charset=GB2312");

if ($uc)
{
	uncookie('user_name');
	uncookie('user_pass');
	exitjs("���Ѿ��˳�!","index.php");
}
else
{
	if ($_POST["action"]!="login")
	{
		echo deal_temp("temp/$tempname/login.htm",array("title"=>$title));
		die;
	}
	$user_orig=$_POST["user_name"];
	$pass_orig=$_POST["user_pass"];
	$user_name=my_encode($user_orig);
	$user_pass=my_encode($pass_orig);
	$users=file("class/users.php");
	for($i=1;$i<count($users);$i++)
	{
		if (!trim($users[$i])) continue;
		$arr=explode("|",$users[$i]);
		if ($user_name == my_encode($arr[0]) && $user_pass == $arr[1])
		{
			mkcookie('user_name',$user_name);
			mkcookie('user_pass',$user_pass);
			mkcookie('last_time',date("D, d M Y H:i:s")." GMT");
			inlog("��½�ɹ�,�û���:".$user_orig);
			if ($user_orig == "admin" && $pass_orig == "admin")
			{
				exit("<script language=javascript>alert(\"��ӭʹ�� PHPCMS �ļ������� \\n���ǵ�һ�ε�½������\\n�������޸�Ĭ������!\");window.location = 'admin.php?action=muser&name=admin';</script>");
				
			}
			else
			{
?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
 <meta http-equiv="refresh" content="1;url=index.php">
 <title><?=$title;?> --��½�ɹ�</title>
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" align="center" height="80%" width="50%">
 <tr><td>
  <table border="0" cellspacing="1" cellpadding="5" bgcolor="#4499ee" align="center">
   <tr><td style="font-family: Tahoma, Verdana; color: #FFFFFF; font-size: 12px; font-weight: bold; background: #8ec2f5;"><?=$title;?></td></tr>
   <tr><td bgcolor="#FFFFFF" style="font-family: Tahoma, Verdana; color: #333333; font-size: 12px;">���Ѿ��ɹ���¼ <?=$title;?>
   <br/><br/><a href="index.php" style="text-decoration: none;color:#333333;">���û���Զ���ת,��������</a></td></tr>
  </table>
 </td></tr>
</table>
<br/>
<br/>
</body>
</html>
<?
				die;
			}
		}
	}
	exitjs("��½ʧ��:�û������������!","login.php");
}

?>