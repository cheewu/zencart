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
if (!$user["admin"]) exit("没有权限");
$action = $_GET["action"];
?>

<html>
<head>
 <title>控制面板--<?php echo $title;?></title>
 <meta http-equiv='Pragma' content='no-cache' />
 <meta http-equiv=Content-Type content="text/html; charset=gb2312" />
 <link rel="stylesheet" href="images/ctrl.css" type="text/css" />
</head>
<body>
<div class=tool style="margin-top:10px;">
<a href='?action=config'>基本设置</a> 
<a href='?action=adduser'>添加用户</a> 
<a href='?action=user'>管理用户</a>
<a href='?action=addgroup'>添加组</a>  
<a href='?action=group'>管理组</a> 
<a href='?action=update'>升级信息</a> 
</div>

<?
showjsfunctions();

if ($action == "adduser" && $user["adduser"])
{
?>
<div>
<form name=myform method=post action=ctrl.php onsubmit="return checkpass()">
<input type=hidden name='action' value='adduser' />
用户名:<input type=text size=20 maxlength=30 name=new_user /><br/>
密&nbsp;&nbsp;码:<input type=password size=20 maxlength=50 name=new_pass /><br/>
重&nbsp;&nbsp;复:<input type=password size=20 maxlength=50 name=new_confirm_pass onblur="checkpass(this);" /><br/>
根目录:<input type=text size=20 name=new_root /> <a href="javascript:showhelp('roothelp')">帮助</a>
<div id='roothelp' style="width:200px;float:right;display:none">
关于"根目录"的帮助信息:<br/>
   相对于程序的目录名，比如本程序在 wwwroot/down/longbill/ 下，
而你想设置根目录为 wwwroot/down/user/ 那么应该输入 ../user/ 。<br/>注: <br/>1: ../代表上级目录<br/>2:如果此目录不存在程序会自动创建
</div>
<br/>
用户组:<select name=new_group>
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
<input type=submit value="提交">&nbsp;<input type=reset value="重设">
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
	if (!$g) exit("<div>用户名错误</div>");
?>
<div>
<form name=myform method=post action=ctrl.php onsubmit="return checkpass()">
<input type=hidden name='action' value='muser' />
用户名:<input type=text size=20 maxlength=30 name=new_user value="<?php echo $name;?>" readonly />(不能修改)<br/>
原密码:<input type=password size=20 name=origpass maxlength=50 /><br/>
新密码:<input type=password size=20 maxlength=50 name=new_pass />(不需要修改密码请留空)
<br/>
重&nbsp;&nbsp;复:<input type=password size=20 maxlength=50 name=new_confirm_pass onblur="checkpass(this);" /><br/>
根目录:<input type=text size=20 name=new_root value="<?php echo $g["root"];?>" /> <a href="javascript:showhelp('roothelp')">帮助</a>
<div id='roothelp' style="width:200px;float:right;display:none">
关于"根目录"的帮助信息:<br/>
   相对于程序的目录名，比如本程序在 wwwroot/down/longbill/ 下，
而你想设置根目录为 wwwroot/down/user/ 那么应该输入 ../user/ 。<br/>注: <br/>1: ../代表上级目录<br/>2:如果此目录不存在程序会自动创建
</div>
<br/>
用户组:<select name=new_group>
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
<input type=submit value="更新">&nbsp;<input type=reset value="重设">
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
用户:<select name=username>
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
<input type=button value='删除' onclick="deluser()"> <input type=button value='编辑' onclick="muser()">
</form>
<script>
function deluser()
{
	var name = document.myform.username.value;
	if (confirm("你真的要删除用户 "+name+" 吗?")) document.myform.submit();
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
标题:<input type=text size=50 name=title value="<?php echo $title;?>"/><br/>
模板:<select name=tempname>
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
编辑器默认编码:<select name='force_encode'>
<option value='GB2312'>GB2312
<option value='UTF-8' <?php if ($force_encode == "UTF-8") echo "selected";?> >UTF-8
</select><br/>
<input type=checkbox name='allowurlencode' <?php if ($allowurlencode) echo "checked";?> />对中文文件名使用URL编码
<br/>
<br/>

<input type=submit value=更新>&nbsp;<input type=reset value=重设>
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
组:<select name=groupname>
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
<input type=button value='删除' onclick="delgroup()"> <input type=button value='编辑' onclick="mgroup()">
</form>
<script>
function delgroup()
{
	var name = document.myform.groupname.value;
	if (confirm("你真的要删除组 "+name+" 吗?")) document.myform.submit();
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
组名:<input name=groupname type=text size=20 /><br/>
默认浏览方式:<input type=checkbox name=visit />浏览 <input type=checkbox name=big />大图标<br/>
限制文件类型:<input type=text name=limittype size=30 value="php|asp|jsp|aspx|php3|cgi|cer|cdx|asa|" />
 <input type=radio name=only value="true" />只允许
 <input type=radio name=only value="0" checked />不允许
 <a href="javascript:showhelp('limithelp')">帮助</a>
<div id=limithelp style="width:200px;float:right;display:none">
关于"限制文件类型"的帮助:<br/>
<ul>
<li>"只允许"：用户只能操作前面填的文件类型，其他所有的文件类型都不能操作。
<li>"不允许"：用户不能操作前面填的文件类型，其他的文件类型都可以操作。
<li>如果选中"只允许"，请注意修改前面的文件类型。
</ul>
</div>
<br/>
新建文件:<input type=checkbox name=newfile /><br/>
新建目录:<input type=checkbox name=newdir /><br/>
下载源文件:<input type=checkbox name=downfile /><br/>
上传文件:<input type=checkbox name=upfile /><br/>
从URL下载:<input type=checkbox name=savefromurl /><br/>
删除文件:<input type=checkbox name=delete /><br/>
ZIP打包:<input type=checkbox name=zippack /><br/>
ZIP解压:<input type=checkbox name=unpack /><br/>
搜索:<input type=checkbox name=search /><br/>
全选/反选:<input type=checkbox name=select checked /><br/>
复制文件:<input type=checkbox name=copy /><br/>
移动文件:<input type=checkbox name=move /><br/>
查看源文件:<input type=checkbox name=viewsorce /><br/>
重命名:<input type=checkbox name=rename /><br/>
保存文件:<input type=checkbox name=savefile /><br/>
查看统计:<input type=checkbox name=property /><br/>
控制面板:<input type=checkbox name=admin onclick="$('admindiv').style.display = this.checked?'':'none';" /><br/>
<div style="display:none;width:300px;" id=admindiv>
<ul>
<li>添加用户:<input type=checkbox name=adduser />
<li>删除用户:<input type=checkbox name=deluser />
<li>添加组:<input type=checkbox name=addgroup  />
<li>删除组:<input type=checkbox name=delgroup  />
</ul>
</div>
<input type=submit value=新建>&nbsp;<input type=reset value=重设>
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
	if (!$g) exit("<div>组名错误</div>");
?>
<div>
<form action=ctrl.php name=myform method=post onsubmit="return checkgroupform();">
<input type=hidden name=action value=mgroup>
组名:<input name=groupname type=text size=20 value="<?php echo $name;?>" readonly />(不能修改)<br/>
默认浏览方式:<input type=checkbox name=visit <?php echocheck($g["visit"]);?> />浏览 <input type=checkbox name=big <?php echocheck($g["big"]);?> />大图标<br/>
限制文件类型:<input type=text name=limittype size=30 value="<?php echo $g["limittype"];?>" />
 <input type=radio name=only value="true" <?php echocheck($g["only"]);?> />只允许
 <input type=radio name=only value="0" <?php echocheck(!$g["only"]);?> />不允许
 <a href="javascript:showhelp('limithelp')">帮助</a>
<div id=limithelp style="width:200px;float:right;display:none">
关于"限制文件类型"的帮助:<br/>
<ul>
<li>"只允许"：用户只能操作前面填的文件类型，其他所有的文件类型都不能操作。
<li>"不允许"：用户不能操作前面填的文件类型，其他的文件类型都可以操作。
<li>如果选中"只允许"，请注意修改前面的文件类型。
</ul>
</div>


<br/>
新建文件:<input type=checkbox name=newfile <?php echocheck($g["newfile"]);?> /><br/>
新建目录:<input type=checkbox name=newdir <?php echocheck($g["newdir"]);?> /><br/>
下载源文件:<input type=checkbox name=downfile <?php echocheck($g["downfile"]);?> /><br/>
上传文件:<input type=checkbox name=upfile <?php echocheck($g["upfile"]);?> /><br/>
从URL下载:<input type=checkbox name=savefromurl <?php echocheck($g["savefromurl"]);?> /><br/>
删除文件:<input type=checkbox name=delete <?php echocheck($g["delete"]);?> /><br/>
ZIP打包:<input type=checkbox name=zippack <?php echocheck($g["zippack"]);?> /><br/>
ZIP解压:<input type=checkbox name=unpack <?php echocheck($g["unpack"]);?> /><br/>
搜索:<input type=checkbox name=search <?php echocheck($g["search"]);?> /><br/>
全选/反选:<input type=checkbox name=select <?php echocheck($g["select"]);?> /><br/>
复制文件:<input type=checkbox name=copy <?php echocheck($g["copy"]);?> /><br/>
移动文件:<input type=checkbox name=move <?php echocheck($g["move"]);?> /><br/>
查看源文件:<input type=checkbox name=viewsorce <?php echocheck($g["viewsorce"]);?> /><br/>
重命名:<input type=checkbox name=rename <?php echocheck($g["rename"]);?> /><br/>
保存文件:<input type=checkbox name=savefile <?php echocheck($g["savefile"]);?> /><br/>
查看统计:<input type=checkbox name=property <?php echocheck($g["property"]);?> /><br/>
控制面板:<input type=checkbox name=admin <?php echocheck($g["admin"]);?> onclick="$('admindiv').style.display = this.checked?'':'none';" /><br/>
<div style="display:<?echo ($g["admin"])?"":"none";?>;width:300px;" id=admindiv>
<ul>
<li>添加用户:<input type=checkbox name=adduser <?php echocheck($g["adduser"]);?> />
<li>删除用户:<input type=checkbox name=deluser <?php echocheck($g["deluser"]);?> />
<li>添加组:<input type=checkbox name=addgroup <?php echocheck($g["addgroup"]);?> />
<li>删除组:<input type=checkbox name=delgroup <?php echocheck($g["delgroup"]);?> />
</ul>
</div>
<input type=submit value=更新>&nbsp;<input type=reset value=重设>
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
	echo "<div>没有权限!</div>";
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
		alert("密码不一致!");
	}
	else if (!v)
	{
		var f=document.myform;
		if (!f.new_user.value)
		{
			alert("请输入用户名!");
			return false;
		}
		if (users.indexOf(f.new_user.value)!=-1 && f.action.value != "muser")
		{
			alert("用户 "+f.new_user.value+" 已经存在!");
			return false;
		}
		if (!f.new_pass.value && f.action.value != "muser")
		{
			alert("请输入密码!");
			return false;
		}
		if (f.new_pass.value != f.new_confirm_pass.value)
		{
			alert("密码不一致!");
			return false;
		}
		if (!f.new_root.value)
		{
			alert("请输入根目录!");
			return false;
		}
	}
}

function checkgroupform()
{
	var f=document.myform;
	if (!f.groupname.value)
	{
		alert('请输入组名');
		return false;
	}
	if (groups.indexOf(f.groupname.value)!=-1 && f.action.value !="mgroup")
	{
		alert('组 '+f.groupname.value+" 已经存在!");
		return false;
	}
	if (document.myform.only[0].checked)
	{
		var limit =document.myform.limittype.value.toLowerCase();
		var types = "php|asp|jsp|aspx|php3|cgi";
		var type = types.split("|");
		for(var i=0;i<type.length;i++)
		{
			if (limit.indexOf(type[i]) !=-1 && !confirm("你真的希望用户能够操作 "+type[i]+" 类型的文件吗?\n这是很危险的!")) return false;
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