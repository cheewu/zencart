<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

header("content-type:text/html; charset=gb2312");

include_once("common.php");
$user = check_login();
if (!$user) exit("<script>window.location='login.php';</script>");
if (!$user["admin"]) exit("û��Ȩ��");
$action = $_GET["action"];
?>

<html>
<head>
 <title>�������--<?php echo $title;?></title>
 <meta http-equiv='Pragma' content='no-cache' />
 <meta http-equiv=Content-Type content="text/html; charset=gb2312" />
 <link rel="stylesheet" href="images/ctrl.css" type="text/css" />
</head>
<body>
<div class=tool style="margin-top:10px;">
<a href='?action=config'>��������</a> 
<a href='?action=adduser'>����û�</a> 
<a href='?action=user'>�����û�</a>
<a href='?action=addgroup'>�����</a>  
<a href='?action=group'>������</a> 
<a href='?action=update'>������Ϣ</a> 
</div>

<?
showjsfunctions();

if ($action == "adduser" && $user["adduser"])
{
?>
<div>
<form name=myform method=post action=ctrl.php onsubmit="return checkpass()">
<input type=hidden name='action' value='adduser' />
�û���:<input type=text size=20 maxlength=30 name=new_user /><br/>
��&nbsp;&nbsp;��:<input type=password size=20 maxlength=50 name=new_pass /><br/>
��&nbsp;&nbsp;��:<input type=password size=20 maxlength=50 name=new_confirm_pass onblur="checkpass(this);" /><br/>
��Ŀ¼:<input type=text size=20 name=new_root /> <a href="javascript:showhelp('roothelp')">����</a>
<div id='roothelp' style="width:200px;float:right;display:none">
����"��Ŀ¼"�İ�����Ϣ:<br/>
   ����ڳ����Ŀ¼�������籾������ wwwroot/down/longbill/ �£�
���������ø�Ŀ¼Ϊ wwwroot/down/user/ ��ôӦ������ ../user/ ��<br/>ע: <br/>1: ../�����ϼ�Ŀ¼<br/>2:�����Ŀ¼�����ڳ�����Զ�����
</div>
<br/>
�û���:<select name=new_group>
<?
$arr = file("class/group.php");
for($i=1;$arr[$i];$i++)
{
	$v = trim ($arr[$i]);
	if (!$v || !strpos($v,"|")) continue;
	$arr2 = explode("|",$v);
	echo "<option value='{$arr2[0]}'>{$arr2[0]}</option>\n";
}
?>
</select>
<br/>
<input type=submit value="�ύ">&nbsp;<input type=reset value="����">
</form>
</div>
<?
}

else if ($action == "muser" && $user["adduser"])
{
	$g = $_GET["name"];
	if (!$g) $g = $_POST["name"];
	$name = $g;
	$g = getuser($g);
	if (!$g) exit("<div>�û�������</div>");
?>
<div>
<form name=myform method=post action=ctrl.php onsubmit="return checkpass()">
<input type=hidden name='action' value='muser' />
�û���:<input type=text size=20 maxlength=30 name=new_user value="<?php echo $name;?>" readonly />(�����޸�)<br/>
ԭ����:<input type=password size=20 name=origpass maxlength=50 /><br/>
������:<input type=password size=20 maxlength=50 name=new_pass />(����Ҫ�޸�����������)
<br/>
��&nbsp;&nbsp;��:<input type=password size=20 maxlength=50 name=new_confirm_pass onblur="checkpass(this);" /><br/>
��Ŀ¼:<input type=text size=20 name=new_root value="<?php echo $g["root"];?>" /> <a href="javascript:showhelp('roothelp')">����</a>
<div id='roothelp' style="width:200px;float:right;display:none">
����"��Ŀ¼"�İ�����Ϣ:<br/>
   ����ڳ����Ŀ¼�������籾������ wwwroot/down/longbill/ �£�
���������ø�Ŀ¼Ϊ wwwroot/down/user/ ��ôӦ������ ../user/ ��<br/>ע: <br/>1: ../�����ϼ�Ŀ¼<br/>2:�����Ŀ¼�����ڳ�����Զ�����
</div>
<br/>
�û���:<select name=new_group>
<?
$arr = file("class/group.php");
for($i=1;$arr[$i];$i++)
{
	$v = trim ($arr[$i]);
	if (!$v || !strpos($v,"|")) continue;
	$arr2 = explode("|",$v);
	echo "<option value='{$arr2[0]}' ";
	if ($arr2[0] == $g["group"]) echo "selected";
	echo ">{$arr2[0]}</option>\n";
}
?>
</select>
<br/>
<input type=submit value="����">&nbsp;<input type=reset value="����">
</form>
</div>
<?
}
else if ($action == "user" || $action == "deluser")
{
?>
<div>
<form action=ctrl.php method=post name=myform>
<input type=hidden name=action value=deluser>
�û�:<select name=username>
<?
$arr = file("class/users.php");
for($i=1;$arr[$i];$i++)
{
	$v = trim ($arr[$i]);
	if (!$v || !strpos($v,"|")) continue;
	$arr2 = explode("|",$v);
	echo "<option value='{$arr2[0]}'>{$arr2[0]}</option>\n";
}
?>
</select>
&nbsp;&nbsp;
<input type=button value='ɾ��' onclick="deluser()"> <input type=button value='�༭' onclick="muser()">
</form>
<script>
function deluser()
{
	var name = document.myform.username.value;
	if (confirm("�����Ҫɾ���û� "+name+" ��?")) document.myform.submit();
}
function muser()
{
	var name = document.myform.username.value;
	window.location = "?action=muser&name="+name;
}
</script>
</div>
<?
}
else if ($action == "config" || !$action)
{
?>
<div>
<form action=ctrl.php method=post>
<input type=hidden name=action value=config>
����:<input type=text size=50 name=title value="<?php echo $title;?>"/><br/>
ģ��:<select name=tempname>
<?
$handle = @opendir("temp/");
while($v = readdir($handle))
{
	if (is_file("temp/".$v) || $v=="." || $v =="..") continue;
	echo "<option value='{$v}'";
	if (trim($v) == $tempname) echo " selected";
	echo ">{$v}</option>\n";
}
?>
</select><br/>
�༭��Ĭ�ϱ���:<select name='force_encode'>
<option value='GB2312'>GB2312
<option value='UTF-8' <?php if ($force_encode == "UTF-8") echo "selected";?> >UTF-8
</select><br/>
<input type=checkbox name='allowurlencode' <?php if ($allowurlencode) echo "checked";?> />�������ļ���ʹ��URL����
<br/>
<br/>

<input type=submit value=����>&nbsp;<input type=reset value=����>
</form>
</div>
<?
}
else if ($action == "group" || $action == "delgroup")
{
?>
<div>
<form action=ctrl.php method=post name=myform>
<input type=hidden name=action value=delgroup>
��:<select name=groupname>
<?
$arr = file("class/group.php");
for($i=1;$arr[$i];$i++)
{
	$v = trim ($arr[$i]);
	if (!$v || !strpos($v,"|")) continue;
	$arr2 = explode("|",$v);
	echo "<option value='{$arr2[0]}'>{$arr2[0]}</option>\n";
}
?>
</select>
&nbsp;&nbsp;
<input type=button value='ɾ��' onclick="delgroup()"> <input type=button value='�༭' onclick="mgroup()">
</form>
<script>
function delgroup()
{
	var name = document.myform.groupname.value;
	if (confirm("�����Ҫɾ���� "+name+" ��?")) document.myform.submit();
}
function mgroup()
{
	var name = document.myform.groupname.value;
	window.location = "?action=mgroup&name="+name;
}
</script>
</div>
<?
}
else if ($action == "addgroup" && $user["addgroup"])
{
?>
<div>
<form action=ctrl.php name=myform method=post onsubmit="return checkgroupform();">
<input type=hidden name=action value=addgroup>
����:<input name=groupname type=text size=20 /><br/>
Ĭ�������ʽ:<input type=checkbox name=visit />��� <input type=checkbox name=big />��ͼ��<br/>
�����ļ�����:<input type=text name=limittype size=30 value="php|asp|jsp|aspx|php3|cgi|cer|cdx|asa|" />
 <input type=radio name=only value="true" />ֻ����
 <input type=radio name=only value="0" checked />������
 <a href="javascript:showhelp('limithelp')">����</a>
<div id=limithelp style="width:200px;float:right;display:none">
����"�����ļ�����"�İ���:<br/>
<ul>
<li>"ֻ����"���û�ֻ�ܲ���ǰ������ļ����ͣ��������е��ļ����Ͷ����ܲ�����
<li>"������"���û����ܲ���ǰ������ļ����ͣ��������ļ����Ͷ����Բ�����
<li>���ѡ��"ֻ����"����ע���޸�ǰ����ļ����͡�
</ul>
</div>
<br/>
�½��ļ�:<input type=checkbox name=newfile /><br/>
�½�Ŀ¼:<input type=checkbox name=newdir /><br/>
����Դ�ļ�:<input type=checkbox name=downfile /><br/>
�ϴ��ļ�:<input type=checkbox name=upfile /><br/>
��URL����:<input type=checkbox name=savefromurl /><br/>
ɾ���ļ�:<input type=checkbox name=delete /><br/>
ZIP���:<input type=checkbox name=zippack /><br/>
ZIP��ѹ:<input type=checkbox name=unpack /><br/>
����:<input type=checkbox name=search /><br/>
ȫѡ/��ѡ:<input type=checkbox name=select checked /><br/>
�����ļ�:<input type=checkbox name=copy /><br/>
�ƶ��ļ�:<input type=checkbox name=move /><br/>
�鿴Դ�ļ�:<input type=checkbox name=viewsorce /><br/>
������:<input type=checkbox name=rename /><br/>
�����ļ�:<input type=checkbox name=savefile /><br/>
�鿴ͳ��:<input type=checkbox name=property /><br/>
�������:<input type=checkbox name=admin onclick="$('admindiv').style.display = this.checked?'':'none';" /><br/>
<div style="display:none;width:300px;" id=admindiv>
<ul>
<li>����û�:<input type=checkbox name=adduser />
<li>ɾ���û�:<input type=checkbox name=deluser />
<li>�����:<input type=checkbox name=addgroup  />
<li>ɾ����:<input type=checkbox name=delgroup  />
</ul>
</div>
<input type=submit value=�½�>&nbsp;<input type=reset value=����>
</form>
</div>
<?
}
else if ($action == "mgroup" && $user["addgroup"])
{
	$g = $_GET["name"];
	if (!$g) $g = $_POST["name"];
	$name = $g;
	$g = getgroup($g);
	if (!$g) exit("<div>��������</div>");
?>
<div>
<form action=ctrl.php name=myform method=post onsubmit="return checkgroupform();">
<input type=hidden name=action value=mgroup>
����:<input name=groupname type=text size=20 value="<?php echo $name;?>" readonly />(�����޸�)<br/>
Ĭ�������ʽ:<input type=checkbox name=visit <?php echocheck($g["visit"]);?> />��� <input type=checkbox name=big <?php echocheck($g["big"]);?> />��ͼ��<br/>
�����ļ�����:<input type=text name=limittype size=30 value="<?php echo $g["limittype"];?>" />
 <input type=radio name=only value="true" <?php echocheck($g["only"]);?> />ֻ����
 <input type=radio name=only value="0" <?php echocheck(!$g["only"]);?> />������
 <a href="javascript:showhelp('limithelp')">����</a>
<div id=limithelp style="width:200px;float:right;display:none">
����"�����ļ�����"�İ���:<br/>
<ul>
<li>"ֻ����"���û�ֻ�ܲ���ǰ������ļ����ͣ��������е��ļ����Ͷ����ܲ�����
<li>"������"���û����ܲ���ǰ������ļ����ͣ��������ļ����Ͷ����Բ�����
<li>���ѡ��"ֻ����"����ע���޸�ǰ����ļ����͡�
</ul>
</div>


<br/>
�½��ļ�:<input type=checkbox name=newfile <?php echocheck($g["newfile"]);?> /><br/>
�½�Ŀ¼:<input type=checkbox name=newdir <?php echocheck($g["newdir"]);?> /><br/>
����Դ�ļ�:<input type=checkbox name=downfile <?php echocheck($g["downfile"]);?> /><br/>
�ϴ��ļ�:<input type=checkbox name=upfile <?php echocheck($g["upfile"]);?> /><br/>
��URL����:<input type=checkbox name=savefromurl <?php echocheck($g["savefromurl"]);?> /><br/>
ɾ���ļ�:<input type=checkbox name=delete <?php echocheck($g["delete"]);?> /><br/>
ZIP���:<input type=checkbox name=zippack <?php echocheck($g["zippack"]);?> /><br/>
ZIP��ѹ:<input type=checkbox name=unpack <?php echocheck($g["unpack"]);?> /><br/>
����:<input type=checkbox name=search <?php echocheck($g["search"]);?> /><br/>
ȫѡ/��ѡ:<input type=checkbox name=select <?php echocheck($g["select"]);?> /><br/>
�����ļ�:<input type=checkbox name=copy <?php echocheck($g["copy"]);?> /><br/>
�ƶ��ļ�:<input type=checkbox name=move <?php echocheck($g["move"]);?> /><br/>
�鿴Դ�ļ�:<input type=checkbox name=viewsorce <?php echocheck($g["viewsorce"]);?> /><br/>
������:<input type=checkbox name=rename <?php echocheck($g["rename"]);?> /><br/>
�����ļ�:<input type=checkbox name=savefile <?php echocheck($g["savefile"]);?> /><br/>
�鿴ͳ��:<input type=checkbox name=property <?php echocheck($g["property"]);?> /><br/>
�������:<input type=checkbox name=admin <?php echocheck($g["admin"]);?> onclick="$('admindiv').style.display = this.checked?'':'none';" /><br/>
<div style="display:<?echo ($g["admin"])?"":"none";?>;width:300px;" id=admindiv>
<ul>
<li>����û�:<input type=checkbox name=adduser <?php echocheck($g["adduser"]);?> />
<li>ɾ���û�:<input type=checkbox name=deluser <?php echocheck($g["deluser"]);?> />
<li>�����:<input type=checkbox name=addgroup <?php echocheck($g["addgroup"]);?> />
<li>ɾ����:<input type=checkbox name=delgroup <?php echocheck($g["delgroup"]);?> />
</ul>
</div>
<input type=submit value=����>&nbsp;<input type=reset value=����>
</form>
</div>
<?
}

else if ($action == "update")
{
	echo "<div>";
	echo "<script language=javascript src='http://www.longbill.cn/update/update.php?v={$v}'></script>";
	echo "</div>";
}
else
{
	echo "<div>û��Ȩ��!</div>";
}

function echocheck($v)
{
	if ($v) echo "checked";
}

function getgroup($groupname)
{

	$group = array();
	$dd = array();
	$groups=@file("class/group.php");
	for($i=1;$groups[$i];$i++)
	{
		$v = trim ($groups[$i]);
		if (!$v || !strpos($v,"|")) continue;
		$arr = explode("|",$v);
		if ($arr[0] == $groupname )
		{
			$rights = $v;
			break;
		}
	}
	if (!$rights) return false;
	$right = explode("|",$rights);
	for($j=1;$j<count($right);$j++)
	{
		$v = $right[$j];
		if (!$v) continue;
		if (strrpos($v,"&"))
		{
			if (substr($v,0,1) == "&") $v = substr($v,1,strlen($v));
			if (substr($v,-1) != "&") $v.="&";
			$dd["limittype"] = str_replace("&","|",$v);
		}
		else $dd["{$v}"] = 1;
	}
	return $dd;
}

function getuser($username)
{
	$dd = array();
	$users=@file("class/users.php");
	for($i=1;$users[$i];$i++)
	{
		$v = trim ($users[$i]);
		if (!$v || !strpos($v,"|")) continue;
		$arr = explode("|",$v);
		if ($arr[0] == $username)
		{
			$rights = $v;
			break;
		}
	}
	if (!$rights) return false;
	$arr = explode("|",$rights);
	$dd["root"] = $arr[2];
	$dd["group"] = $arr[3];
	return $dd;
}


function showjsfunctions()
{
?>
<script language=javascript>
function $(obj)
{
	return document.getElementById(obj);
}
function showhelp(id,v,e)
{
	if (!v)
		$(id).style.display = ($(id).style.display == "none")?"":"none";
	else
		$(id).style.display = e?"":"none";
}

function checkpass(v)
{
	if (v && document.myform.new_pass.value != v.value)
	{
		alert("���벻һ��!");
	}
	else if (!v)
	{
		var f=document.myform;
		if (!f.new_user.value)
		{
			alert("�������û���!");
			return false;
		}
		if (users.indexOf(f.new_user.value)!=-1 && f.action.value != "muser")
		{
			alert("�û� "+f.new_user.value+" �Ѿ�����!");
			return false;
		}
		if (!f.new_pass.value && f.action.value != "muser")
		{
			alert("����������!");
			return false;
		}
		if (f.new_pass.value != f.new_confirm_pass.value)
		{
			alert("���벻һ��!");
			return false;
		}
		if (!f.new_root.value)
		{
			alert("�������Ŀ¼!");
			return false;
		}
	}
}

function checkgroupform()
{
	var f=document.myform;
	if (!f.groupname.value)
	{
		alert('����������');
		return false;
	}
	if (groups.indexOf(f.groupname.value)!=-1 && f.action.value !="mgroup")
	{
		alert('�� '+f.groupname.value+" �Ѿ�����!");
		return false;
	}
	if (document.myform.only[0].checked)
	{
		var limit =document.myform.limittype.value.toLowerCase();
		var types = "php|asp|jsp|aspx|php3|cgi";
		var type = types.split("|");
		for(var i=0;i<type.length;i++)
		{
			if (limit.indexOf(type[i]) !=-1 && !confirm("�����ϣ���û��ܹ����� "+type[i]+" ���͵��ļ���?\n���Ǻ�Σ�յ�!")) return false;
		}
	}
}
var groups = "||<?
$arr = file("class/group.php");
for($i=1;$arr[$i];$i++)
{
	$v = trim ($arr[$i]);
	if (!$v || !strpos($v,"|")) continue;
	$arr2 = explode("|",$v);
	echo "{$arr2[0]}|";
}
?>||";
var users = "||<?
$arr = file("class/users.php");
for($i=1;$arr[$i];$i++)
{
	$v = trim ($arr[$i]);
	if (!$v || !strpos($v,"|")) continue;
	$arr2 = explode("|",$v);
	echo "{$arr2[0]}|";
}
?>||";
</script>
<?
}


?>