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
@error_reporting(1);
$user=check_login();
$root=$user["root"];
if (!$user)
{
	if ($action != "savefile" )
		exitme("notice(lang.overtime);window.location='index.php';","eval");
	else
		exitme1('Please log in first!');
}

$path = dealpath($path);
$action1 = $_COOKIE["action1"];
if (!is_dir($root)) @mkdir($root);

if (!$path)
{
	exitme("alert(lang.not_permitted);opendir('$root');","eval");
}

include_once("class/longbill.class.php");

$lb=new longbill;
$lb->ftp_host=$ftp_host;
$lb->ftp_user=$ftp_user;
$lb->ftp_pass=$ftp_pass;
$lb->searchfiles=$searchfiles;

if (!$path && $_COOKIE["cpass"]) $path=$_COOKIE["cpass"];

if (!is_file($path) && !is_dir($path)) exitme("alert(lang.not_found+' $path');opendir('$root');","eval");

if (is_dir($path) && substr($path,-1)!="/") $path.="/";

/////////////output data////////////
if ($action=="list")
{
	if ($up=="yes")
	{
		$path=substr(0,strlen($path)-1,$path);
		$path=dirname($path)."/";
	}
	$lb->dir($path,$sdir,$sfile,$size);
	$s="";
	foreach($sdir as $v)
	{
		$s.="||{$v}";
	}
	for($i=0;$i<count($sfile);$i++)
	{
		$s.="||".$sfile[$i]."|".dealsize($size[$i]);
	}
	$s.="||";
	if (!is_readable($path)) $s = $s = "||".$lang["cannotRead"]."|0||";
	exitme($s,1,$host_charset);
}


///////////////delete files////////////////
else if ($action=="delete" && $user["delete"])
{
	$sfile = urldecode1($_POST["sfile"]);
	$sdir = urldecode1($_POST["sdir"]);
	$dn = 0; 
	$fn = 0; 
	$err = "";
	$logstr = "Delete Files in $path : \n";
	$arr = explode("|",$sfile);

	if (!is_writeable($path)) exitme("notice(lang.cannot_write)","eval");

	foreach($arr as $v)
	{
		if ($v=="") continue;
		$filename=$path.$v;
		$ftype = getext($v);
		if ($user["limit"]["$ftype"] && !$user["only"])
			$err.="'$v'+lang.cannot_del+':'+lang.cannot_types+lang.br+";
		else if (!$user["limit"]["$ftype"] && $user["only"])
			$err.="'$v'+lang.cannot_del+':'+lang.only_types+lang.br+";
		else if (is_file($filename) && @unlink($filename))
		{
			$fn++;
			$logstr.="    $v \n";
		}
		else
			$err.="'$v'+lang.cannot_del+lang.br+";
	}

	$arr=explode("|",$sdir);

	foreach($arr as $v)
	{
		if ($v=="") continue;
		$filename=$path.$v;
		if ($lb->del_dir($filename,$info,$err))
			$logstr.="    $v (folder)\n";
		else
			$err.="'$v'+lang.cannot_del+lang.br+";
		$dn+=$info["dir"];
		$fn+=$info["file"];
	}
	inlog($logstr);
	if ($err) $err.='""';
	$str =($fn+$dn == 0)?"lang.nothing_del":"lang.deleted";
	$str.=($dn)?"+lang.br+'$dn '+lang.folder":"";
	$str.=($fn)?"+lang.br+'$fn '+lang.file":"";	
	$str.=($err)?"+lang.br+lang.br+lang.error+lang.br+$err":"";
	exitme("notice({$str});reloaddata();","eval");
}
///////////////////////////////////////////////for searched file
else if ($action=="deletefile" && $user["delete"])
{
	if (!file_exists($path)) exitme("alert(lang.not_found)","eval");
	$logstr = "Delete File $path  \n";

	$filename=$path;
	$ftype = getext($filename);
	if ($user["limit"]["$ftype"] && !$user["only"])
		exitme("alert(lang.cannot_del+lang.br+lang.cannot_types);","eval");
	else if (!$user["limit"]["$ftype"] && $user["only"])
		exitme("alert(lang.cannot_del+lang.br+lang.only_types);","eval");
	else if (is_file($filename) && @unlink($filename))
	{
		exitme("alert('$filename'+lang.del+lang.success);search_del_file('$filename');reloaddata('".dirname($filename)."/')","eval");
	}
	else
	{
		exitme("alert('$filename'+lang.del+lang.success);","eval");
	}

	$arr=explode("|",$sdir);

	foreach($arr as $v)
	{
		if ($v=="") continue;
		$filename=$path.$v;
		if ($lb->del_dir($filename,$info,$err))
			$logstr.="    $v (folder)\n";
		else
			$err.="'$v'+lang.cannot_del+lang.br+";
		$dn+=$info["dir"];
		$fn+=$info["file"];
	}
	inlog($logstr);
	if ($err) $err.='""';
	$str =($fn+$dn == 0)?"lang.nothing_del":"lang.deleted";
	$str.=($dn)?"+lang.br+'$dn '+lang.folder":"";
	$str.=($fn)?"+lang.br+'$fn '+lang.file":"";	
	$str.=($err)?"+lang.br+lang.br+lang.error+lang.br+$err":"";
	exitme("notice({$str});reloaddata();","eval");
}
//////////////new folder////////////////
else if ($action=="newdir" && $user["newdir"])
{
	$name1 = checkfilename($name);
	if ($name1 != $name) exitme("notice(lang.name_error);","eval");
	$filename=dealpath($path.$name);
	if (!is_writeable($path)) exitme("notice(lang.cannot_write);","eval");
	if (is_file($filename) || is_dir($filename)) exitme("notice(lang.alreadyExist+':$name')","eval");
	if (mkdir($filename,0777))
	{
		inlog("Make Dir: $filename");
		exitme("notice(lang.folder+' $name '+lang.make+lang.success);reloaddata();","eval");
	}
	else
	{
		exitme("notice(lang.folder+' $name '+lang.make+lang.fail)","eval");
	}
}

/////////////new file///////////
else if ($action=="newfile" && $user["newfile"])
{
	$name1 = checkfilename($name);
	if ($name1 != $name) exitme("notice(lang.name_error);","eval");
	checktype($name);
	$filename = dealpath($path.$name);
	if (!is_writeable($path)) exitme("notice(lang.cannot_write)","eval");
	if (is_file($filename) || is_dir($filename)) exitme("notice(lang.alreadyExist+':$filename')","eval");
	if (@fclose(@fopen($filename,"a")))
	{
		inlog("Make File,$filename");
		exitme("notice('$name '+lang.make+lang.success);reloaddata();","eval");
	}
	else
		exitme("notice('$name '+lang.make+lang.fail)","eval");
}


//////////////rename//////////////
else if ($action=="rename" && $user["rename"] && !$newfile && !$newdir)
{
	$file1 = checkfilename($file1);
	$file2 = checkfilename($file2);
	$filename2 = dealpath($path.$file2);
	$filename1 = dealpath($path.$file1);
	if ($filename1 != $path.$file1 || $filename2 != $path.$file2) exitme("notice(lang.name_error)","eval");
	checktype($filename1);
	checktype($filename2);
	if (!is_writeable($path)) exitme("notice(lang.cannot_write)","eval");
	if (is_file($filename2) || is_dir($filename2)) exitme("notice(lang.alreadyExist+':$filename2')","eval");
	if (!@rename($filename1,$filename2))
		exitme("notice(lang.rename+lang.fail);","eval");
	else
	{
		inlog("Rename,$filename1 >> $filename2 \n");
		exitme("notice(lang.rename+lang.success);reloaddata();","eval");
	}
}
//////////////save file/////////////////////
else if ($action == "savefile")
{
	if (!$user["savefile"]) exitme1($lang["js"]["deny"]);
	if ($filename != checkfilename($filename)) exitme1($lang["js"]["name_error"]);
	
	$filename = StripSlashes(dirname($path)."/".$filename);
	if ($_POST['encode'] == "UTF-8")
	{
		$i = @iconv("UTF-8","GB2312",$filename);
		if ($i) $filename = $i;
	}
	$ftype = getext($filename);
	
	if ($user["limit"]["$ftype"] && !$user["only"])
		exitme1($lang["js"]["cannot_types"]);
	else if (!$user["limit"]["$ftype"] && $user["only"])
		exitme1($lang["js"]["only_types"]);
	
	$content = StripSlashes($content);
	$err = "";
	if ($_POST['encode'] != $_POST['encodeto'])
	{
		$i = @iconv($_POST['encode'],$_POST['encodeto'],$content);
		if ($i)
		{
			$content = $i;
		}
		else
		{
			$err = $lang["cannot_change_charset"];
		}
	}
	$fp = @fopen($filename,"w") or exitme1($lang["js"]["cannot_write"]);
	@fputs($fp,$content) or exitme1($lang["js"]["save"].$lang["js"]["fail"]);
	@fclose($fp) or exitme1($lang["js"]["save"].$lang["js"]["fail"]);
	$out = basename1($filename).'\n';
	if ($_POST['encode'] != $_POST['encodeto']) $out.= $_POST['encode'].'->'.$_POST['encodeto'].'\n';
	$out.= $lang["js"]["save"].$lang["js"]["success"]."\\n".$err;
	exitme1($out);
}
///////////download url file////////////////////
else if ($action == "savefromurl" && $user["savefromurl"])
{
	if (!$path || !$url) exitme("notice(lang.var_error)","eval");
	if (!$filename)   $filename = basename1($url);
	if ($filename != checkfilename($filename)) exitme("notice(lang.download+lang.fail)","eval");
	checktype($filename);
	if (!is_writeable($path)) exitme("notice(lang.cannot_write)","eval");
	if (file_exists($path.$filename)) exitme("notice(lang.alreadyExist+':$filename')","eval");
	$filename = dealpath($path.$filename);
	if (@copy($url,$filename))
		exitme("notice(lang.download+lang.success+': $filename ');reloaddata();","eval");
	else
		exitme("notice(lang.download+lang.fail);","eval");
}
///////////////paste/////////////////////////
else if ($action=="paste")
{
	if ($action1 != "cut" && $action1 != "copy") exitme("notice(lang.clipboard_empty)","eval");
	$sfile = urldecode1($_COOKIE["sfile"]);
	$sdir = urldecode1($_COOKIE["sdir"]);
	$sfile = explode("|",$sfile);
	$sdir = explode("|",$sdir);
	$frompath = $_COOKIE["from"];
	$cut = ($action1=="cut");
	$action2 = ($action1 == "cut")?$lang["js"]["cut"]:$lang["js"]["copy"];
	$from = array();
	$to = array();
	$ii = 0;
	$path = $_POST["path"];
	if (!is_writeable($path)) exitme("notice(lang.cannot_write)","eval");
	$coverfile = $_POST["coverfile"];
	$logstr = $action2.",".$_COOKIE["from"]." >> ".$path."\n";
	
	if ($frompath == $path)
	{
		foreach($sfile as $f) if ($f) $sdir[]=$f;
		for($i=0;$i<count($sdir);$i++)
		{
			if (!$sdir[$i]) continue;
			$k=1;
			$filename=$path."¸´¼þ ".$sdir[$i];
			while (file_exists($filename))
			{
				$filename=$path."¸´¼þ(".$k.") ".$sdir[$i];
				$k++;
			}			
			$from[$ii] = $frompath.$sdir[$i];
			$to[$ii] = $filename;
			$logstr.="dir:".$filename."|";
			$ii++;
		}
	}
	else if (!$cover)
	{
		for($i=0;$i<count($sdir);$i++)
		{
			if (!$sdir[$i]) continue;
			$from[$ii] = $frompath.$sdir[$i];
			$to[$ii] = $path.$sdir[$i];
			$logstr.="dir:".$sdir[$i]."|";
			$ii++;
		}
		for($i=0;$i<count($sfile);$i++)
		{
			if (!$sfile[$i]) continue;
			$from[$ii] = $frompath.$sfile[$i];
			$to[$ii] = $path.$sfile[$i];
			$logstr.="file:".$sfile[$i]."|";
			$ii++;
		}
	}
	else if ($coverfile)
	{
		$arr=explode("|",$coverfile);
		for($i=0;$i<count($arr);$i++)
		{
			if (!$arr[$i]) continue;
			$from[$ii] = $frompath.$arr[$i];
			$to[$ii] = $path.$arr[$i];
			$logstr.="cover:".$arr[$i]."|";
			$ii++;
		}
	}
	else die;

	$lb->copy($from,$to,$cover,$cut,$coverfiles) or exitme("notice(lang.{$action1}+lang.error)","eval");
	
	if (!$cover && is_array($coverfiles))
	{
		$coverfile = "";
		foreach ($coverfiles as $i) $coverfile.= str_replace($path,"",$i)."|";
		exitme("if (confirm(lang.follow_exist+lang.br+lang.br+'".str_replace("|","\\n",$coverfile)."'+lang.br+lang.do_cover+'?')) {sendcomm('paste',['path','cover','coverfile'],[path,'true','".$coverfile."']);}else{reloaddata('$path');reloaddata('$frompath');}","eval");
	}
	
	$eval="notice(lang.{$action1}+lang.file+lang.success);reloaddata('$path');";
	$eval.=($action1 == "cut")?"reloaddata('$frompath');setcookie('from','');setcookie('action1','');setcookie('sdir','');setcookie('sfile','');":"";
	exitme($eval,"eval");
}
else if ($action == "readtext")
{
	if (!file_exists($path)) exit($lang["js"]["not_found"]);
	$content = @htmlspecialchars(@file_get_contents($path));
	$encode = get_encode($path);
	
	header("content-type:text/html;Charset=".$encode);
print <<<END
<html>
<body style='margin:0px;'>
<textarea readonly=true style='width:100%;height:100%;margin:0px;padding:3px;word-wrap:break;word-break: break-all;border:0px;'>{$content}</textarea>
</body>
</html>
END;
}

/////////////////////////zip extract////////////////
else if ($action=="unpack" && $user["unpack"])
{
	if (!file_exists($path.$file)) exitme("notice(lang.not_found)","eval");
	if (!$key) exitme("notice(lang.var_error)","eval");
	unpackzip($path.$file,$path.$key,$indexes,$cover,$info);

	$errors = "";
	foreach($info["error"] as $v) $errors.= $v."\\n";

	$s= "lang.extracted+' ".$info['dir']." '+lang.folder+' '+lang.and+' ".$info['file']." '+lang.file+lang.br";
	$s.= "+lang.orig_file+lang.size+' ".dealsize(filesize($path.$file))." '+lang.extract+lang.file+lang.size+'".dealsize($info["size"]."'");
	$s.=($errors)?'+lang.br+lang.error+":"+lang.br+"'.$errors.'"':"";
	exitme("notice($s)","eval");
}

else if ($action=="unpackall" && $user["unpack"])
{
	if (!file_exists($path.$file)) exitme("notice(lang.not_found)","eval");
	if (!$key) exitme("notice(lang.var_error)","eval");
	if (!$indexes) $indexes = -1;
	unpackzip($path.$file,$path.$key,$indexes,$cover,$info);

	if (is_dir($path.$key)) $info["folders"][] = $path.$key;
	$info["folders"][] = $path;	

	$eval='';
	for($i=0;$i<count($info["folders"]);$i++)
	{
		$eval.="setTimeout(\"reloaddata('";
		$eval.=$info["folders"][$i];
		$eval.="')\",";
		$eval.=$i*100;
		$eval.=");";
	}
	
	$errors = "";
	foreach($info["error"] as $v) $errors.= $v."\\n";
	
	$s= "lang.extracted+' ".$info["dir"]." '+lang.folder+' '+lang.and+' ".$info["file"]." '+lang.file+lang.br";
	$s.= "+lang.orig_file+lang.size+' ".dealsize($info["orig_size"])." '+lang.extract+lang.file+lang.size+' ".dealsize($info["size"])."'";
	$s.=($errors)?"+lang.br+lang.error+':'+lang.br+'$errors'":"";
	exitme($eval."notice($s)","eval");
}
////////////////ZIP pack file///////////////////////
else if ($action=="zippack" && $user["zippack"])
{
	$sfile= urldecode1($_POST["sfile"]);
	$sdir = urldecode1($_POST["sdir"]);
	if (!is_writeable($path)) exitme("notice(lang.cannot_write)","eval");
	if (strtolower(substr($key,-4)) != ".zip") $key.=".zip";
	if (@file_put_contents($path.$key,zippack($path,$sdir,$sfile)))
		exitme("notice('$key '+lang.compress+lang.success);reloaddata();","eval");
	else
		exitme("notice('$key '+lang.compress+lang.fail)","eval");
}
////////////////////////////////
else if ($action == "property" )
{
	if (!is_dir($path)) exitme("notice(lang.not_found)","eval");
	$info = $lb->get_property($path);
	$s = "lang.here+':	$path<br/>'+lang.br";
	$s.= "+lang.folder+':	".$info["dir"]."<br/>'+lang.br";
	$s.= "+lang.file+':	".$info["file"]."<br/>'+lang.br";
	$s.= "+lang.total+':	".dealsize($info["size"])."<br/>'+lang.br+lang.property+':	'";
	$s.= ($info["writable"])?"+lang.writeable":"+lang.not_writeable";
	$s.= "+lang.br+lang.br+'<br/><br/><a href=\"javascript:search_close();\">¹Ø±Õ</a>'";
	exitme("window.movenotice = 0; notice($s,5,mouse_x,mouse_y,1)","eval");
}
else if ($action == "search" && $user['search'])
{
	if (!is_dir($path)) exitme("notice(lang.not_found)","eval");
	if (!$s) exitme("notice(lang.var_error)","eval");
	if ($charset == "utf-8")
	{
		$i = @iconv("GB2312","UTF-8",$s);
		if ($i) $s = $i;
	}
	if ($filename && $content)
	{
		$type = 0;
	}
	else if ($filename)
	{
		$type = 1;
	}
	else if ($content)
	{
		$type = 2;
	}
	$case = ($case);
	$items = $lb->search_file($path,$s,$type,$case);
	if (count($items) == 0) exitme("notice(lang.search_no_result);","eval");
	$s = "";

	foreach($items as $f)
	{
		$s.="||$f|".dealsize(filesize($f));
	}
	exitme("search_parse('$s')","eval");
}
////////// ////////
else
{
	exitme("notice(lang.deny)","eval");
}

function exitme($ss,$t=1,$charset=0)
{
	global $action,$lang;
	if (!$charset)
	{
		$charset = $lang['config']['charset'];
	}
	if ($action != "list") $ss = " ".$ss;
	$ss = str_replace("\n"," \n ",$ss);
	$s = '+';
	if ($t === 1) $s.="OK";
	else if ($t === "eval") $s.="Eval";
	else $s.="Error";
	$s = $s."==?".$ss."?==";
	$r = (function_exists("iconv"))?@iconv($charset,'UTF-8',$s):"";
	if (trim($r) == "")
	{
		header("Content-type:TEXT/HTML;Charset=".$charset);
		exit($s);
	}
	else
	{
		header("Content-type:TEXT/HTML;Charset=UTF-8");
		exit($r);
	}
}

function checkfilename($file)
{
	if (!$file) return "";
	$file = trim($file);
	$a = substr($file,-1);
	$file = eregi_replace("^[.\\\/]*","",$file);
	$file = eregi_replace("[.\\\/]*$","",$file);
	$arr = array("../","./","/","\\","..\\",".\\");
	$file = str_replace($arr,"",$file);
	return $file;
}

function exitme1($s)
{
	global $lang;
	header("Content-type:TEXT/HTML;Charset=".$lang["config"]["charset"]);
	exit("<script language=javascript>alert('$s');window.close();</script>");
}

function checktype($filename)
{
	global $user;
	$ftype = getext($filename);
	if ($user["limit"]["$ftype"] && !$user["only"])
		exitme("notice(lang.cannot_types)","eval");
	else if (!$user["limit"]["$ftype"] && $user["only"])
		exitme("notice(lang.only_types);","eval");
}
?>