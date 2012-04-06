<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

include_once("config.php");
include_once("func.php");
$user = check_login();
$language = "language/".$language;
if (!file_exists($language)) $language = "gb2312.lang.php";
@include_once($language);

$time_start = get_micro();
error_reporting(1);
@set_time_limit($max_time_limit);

if (!get_magic_quotes_gpc()) //魔法括号
{
	$evalstr = <<<END
		if (is_array(#_xxxxx))
		{
			while (list(#k, #v) = each(#_xxxxx))
			{
				if (is_array(#_xxxxx[#k]))
				{
					while (list(#k2, #v2) = each(#_xxxxx[#k])) #_xxxxx[#k][#k2] = addslashes(#v2);
					@reset(#_xxxxx[#k]);
				}
				else #_xxxxx[#k] = addslashes(#v);
			}
			@reset(#_xxxxx);
		}
END;
	@eval(str_replace(array("xxxxxx",'#'),array('GET','$'),$evalstr));
	@eval(str_replace(array("xxxxxx",'#'),array('POST','$'),$evalstr));
	@eval(str_replace(array("xxxxxx",'#'),array('COOKIE','$'),$evalstr));
}

if(!ini_get('register_globals'))  //抽取变量
{
	extract($_POST);
	extract($_GET);
}


?>