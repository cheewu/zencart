<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

if (!function_exists("file_get_contents"))
{
	function file_get_contents($path)
	{
		if (!file_exists($path)) return false;
		$fp=@fopen($path,"r");
		$all=fread($fp,filesize($path));
		fclose($fp);
		return $all;
	}
}

if (!function_exists("file_put_contents"))
{
	function file_put_contents($path,$val)
	{
		$fp=@fopen($path,"w");
		fputs($fp,$val);
		fclose($fp);
		return true;
	}
}

function my_encode($val)
{
	return md5(strrev(base64_encode($val)));
}

function exitjs($alert,$url)
{
	die("<script language=javascript>alert(\"".AddSlashes($alert)."\");window.location=\"".AddSlashes($url)."\";</script>");
}

function mkcookie($var,$value,$time = 0)
{
	global $usecookie,$timestamp;
	$cookiepath="/";
	if($usecookie)
	{
		$time = $value == '' ? $timestamp - 31536000 : ($time > 0 ? $timestamp+$time : 0);
		!$cookiepath && $cookiepath = '/';
		$s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		setcookie($var,$value,$time,$cookiepath,$cookiedomain,$s);
		$GLOBALS[$var] = $value;
	}
	else
	{
               !$GLOBALS['sessionstart'] && $GLOBALS['sessionstart'] = session_start();
               $_SESSION[$var] = $value;
	}
}

function getcookie($var)
{
	global $usecookie;
	if($usecookie)
	{
		return $_COOKIE[$var] ? $_COOKIE[$var] : $GLOBALS[$var];
	}
	else
	{
		!$GLOBALS['sessionstart'] && $GLOBALS['sessionstart'] = session_start();
		return $_SESSION[$var];
	}
}

function uncookie($var)
{
	global $usecookie,$timestamp;
	if($usecookie)
	{
		setcookie($var,'',$timestamp-31536000);
	}
	else
	{
		!$GLOBALS['sessionstart'] && $GLOBALS['sessionstart'] = session_start();
		unset($_SESSION[$var]);
	}
}

function inlog($str)
{
	return true;
}

function dealsize($s)
{
	$danwei = array( "Byte","KB","MB","GB" );
	$d = 0;
	while ( $s >= 900 )
	{
		$s = round($s*100/1024)/100;
		$d++;
	}
	return $s." ".$danwei[$d];
}

function basename1($s)
{
	$arr=explode("/",$s);
	return $arr[count($arr)-1];
}

function deal_temp($path,$value=false)
{
	if (!file_exists($path)) return false;
	$all = @file_get_contents($path);
	if (!is_array($value)) return $all;
	$arr=array_keys($value);
	$keys=array();
	foreach($arr as $k) $keys[]='{'.$k.'}';
	return str_replace($keys,$value,$all);
}

function check_login()
{
	global $usecookie;
	$user = getcookie("user_name");
	$pass = getcookie("user_pass");
	$group = array();
	$dd = array();
	$r ="newdir|newfile|downfile|zippack|unpack|upfile|copy|move|savefromurl|delete|viewsorce|rename|savefile|select|property|admin|search|";
	$arr = explode("|",$r);
	foreach($arr as $r) $dd["{$r}"] = false;
	$users=@file("class/users.php");
	$groups=@file("class/group.php");
	for($i=1;$groups[$i];$i++)
	{
		$v = trim ($groups[$i]);
		if (!$v || !strpos($v,"|")) continue;
		$arr = explode("|",$v);
		$group["$arr[0]"] = str_replace($arr[0],'',$v);
	}

	for ($i=1;$users[$i];$i++)
	{
		$arr=explode("|",$users[$i]);
		if ($user==my_encode($arr[0]) && $pass==$arr[1])
		{
			$dd["root"] = $arr[2];
			$dd["name"] = $arr[0];
			$dd["group"] = $arr[3];
			$rights = $group["{$arr[3]}"];
			$right = explode("|",$rights);
			for($j=0;$j<count($right);$j++)
			{
				$v = $right[$j];
				if (!$v) continue;
				if (strrpos($v,"&"))
				{
					if (substr($v,0,1) == "&") $v = substr($v,1,strlen($v));
					$dd["limittype"] = str_replace("&",",",$v);
					$arr = explode('&',$v);
					$dd["limit"] = array();
					foreach($arr as $v)
					{
						if (!$v) continue;
						$dd["limit"]["{$v}"] = 1;
					}
				}
				else $dd["{$v}"] = 1;
			}
			return $dd;
		}
	}
}

function zippack($path,$sdir,$sfile)
{ 
	global $user;
	$lb=new Longbill;
	include_once("class/zip.class.php");
	$zip = new Zip;
	$files=explode("|",$sfile);
	$dirs=explode("|",$sdir);
	$file=array();
	for($i=0;$files[$i];$i++)	$file[]=$path.$files[$i];
	for($i=0;$dirs[$i];$i++) 	$file[]=$path.$dirs[$i];
	foreach($file as $v) 		addzipfiles($zip,$path,$v,$info);
	foreach($info["dir"] as $v)	$zip->add_dir(str_replace($path,"",$v));
	foreach($info["file"] as $v)	$zip->Add( Array( str_replace($path,"",$v) , @file_get_contents( $v ) ) );
	return $zip->get_file();
}

function addzipfiles($zip,$path,$dir,&$info)
{
	global $user;
	if (!is_array($info["dir"])) $info["dir"] = array();
	if (!is_array($info["file"])) $info["file"] = array();
	if (!$dir)  return;
	if (is_dir($dir))
	{
		$i=0;
		$handle=@opendir($dir);
		while ($v = @readdir($handle))
		{
			if (!$v || $v=="." || $v=="..") continue;
			$i++;
			addzipfiles($zip,$path,$dir."/".$v,$info);
		}
		if (!$i) $info["dir"][] = $dir;   //添加空目录
	}
	else if (is_file($dir))
	{
		$ftype = getext($dir);
		if ($user["limit"]["$ftype"] && !$user["only"]) return;
		else if (!$user["limit"]["$ftype"] && $user["only"]) return;
		else
			$info["file"][] = $dir;
	}
}

function unpackzip( $filename, $key, $indexes = -1,$cover = 0, &$info)
{
	global $user;
	if (!file_exists($filename)) return false;
	$all=true;
	if ($indexes !=-1) $indexes="|||".$indexes."|||";
	if ($info !=-1) $info=array("cover"=>array(),"dir"=>0,"folders"=>array(),"file"=>0,"size"=>0,"orig_size"=>0,"error"=>array());
	include_once("class/zip.class.php");
	$zip = new Zip;
	$all = ($l = $zip -> get_list($filename));
	
	foreach($l as $file)
	{
		if ($indexes !=-1 && !strpos($indexes,"|".$file["index"]."|")) continue;
		$ftype = getext($file["filename"]);
		if ($user["limit"]["$ftype"] && !$user["only"]) continue;
		else if (!$user["limit"]["$ftype"] && $user["only"]) continue;
		$path = $key."/".$file["filename"];
		if ($file["folder"])
		{
			if (!is_dir($path))
				@mkdir($path,0777);
			else if ($info!=-1)
				$info["folders"][] = $path;
			if ($info!=-1) $info["dir"]++;
		}
		else
		{
			if (file_exists($path)) // 处理已经存在的文件
			{
				if ($info!=-1) $info["cover"][] = array("filename"=>$path,"index"=>$file["index"]);
				if (!$cover) continue;
			}
			
			if ($zip->Extract($filename,$key,$file["index"]))
			{
				if ($info!=-1)
				{
					$info["orig_size"]+=$file["compressed_size"];
					$info["size"]+=$file["size"];
					$info["file"]++;
				}
			}
			else
			{
				if ($info!=-1) $info["error"][]=$path;
				if ($all) $all=false;
			}
		}
	}
	return $all;
}

function dealpath($path)
{
	global $root,$user;
	if (!$root) $root = $user["root"];
	if (!$root) return false;
	$path = trim($path);
	$arr = explode($root,$path);
	if ($arr[0]) return false;
	$path = str_replace($root,"",$path);
	$path = str_replace("../","",$path);
	return $root.$path;
}

function getext($filename)
{
	$filename = trim(strtolower($filename));
	$filename = basename1($filename);
	$arr = explode('.',$filename);
	$type = $arr[count($arr)-1];
	return $type;
}

function get_micro()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

function urldecode1($s)
{
	$s=str_replace("+","%2B",$s);
	return urldecode($s);
}

function urlencode1($s)
{
	$url = urlencode($s);
	return str_replace(array('%2F','+'),array('/','%20'),$url);
}

function array2json($arr)
{
	$keys = array_keys($arr);
	$isarr = true;
	$json = "";
	for($i=0;$i<count($keys);$i++)
	{
		if ($keys[$i] !== $i)
		{
			$isarr = false;
			break;
		}
	}
	$json = $space;
	$json.= ($isarr)?"[":"{";
	for($i=0;$i<count($keys);$i++)
	{
		if ($i!=0) $json.= ",";
		$item = $arr[$keys[$i]];
		$json.=($isarr)?"":$keys[$i].':';
		if (is_array($item))
			$json.=array2json($item);
		else if (is_string($item))
			$json.='"'.str_replace(array("\r","\n"),array('\r','\n'),$item).'"';
		else $json.=$item;
	}
	$json.= ($isarr)?"]":"}";
	return $json;
}

function get_encode($path)
{
	$utf_8 = chr(239).chr(187);
	$unicode = chr(255).chr(254);
	$fp = @fopen($path,"rb");
	$a = @fread($fp,2);
	@fclose($fp);
	if ($a == $utf_8) return "UTF-8";
	else if ($a == $unicode) return "Unicode";
	else return "GB2312";
	
}

?>