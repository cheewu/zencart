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
$root = $user["root"];
if (!$user) header("location:login.php");

if (!$action)
{
	header("Content-type:TEXT/HTML;Charset=GB2312");
	echo deal_temp("js/loading.htm",array("title"=>$title,"tempname"=>$tempname));
	echo deal_temp("temp/$tempname/footer.htm");
}

else if ($action=="menu")
{
	header("Content-type:TEXT/HTML;Charset=GB2312");
	echo deal_temp( "temp/{$tempname}/header.htm", array(
		"title" => $title,
		"charset" => $charset,
		"keywords" => $keywords,
		"description" => $description
		) );

print <<<END
<script language=javascript>
window.onerror = function ()
{
	//alert(event.toString());
	alert("程序加载时发生了未知错误!\\n原因可能是您的浏览器版本太低，建议您升级您的浏览器。\\n本程序支持IE6+,IE7,Firefox,Opera等主流浏览器。");
}
</script>
<script language=javascript src='js/functions.js'></script>
<script language=javascript src='js/sack.js'></script>
<script language=javascript src='js/gb2312.js'></script>
<script language=javascript src='javascript.php'></script>
<script language=javascript src='js/blueshow.js'></script>
<script language=javascript src='js/hash.js'></script>
END;
	
	if (file_exists("temp/{$tempname}/javascript.js")) echo "<script language=javascript src='temp/{$tempname}/javascript.js'></script>";
	
	reset($user);
	$dd=array();
	while (list($key, $val) = each($user))
	{
		$dd["{$key}"] = ($val)?"":"none";
	}
	$dd["wait"]  = $wait;
	$dd["paste"] = ($user["copy"] || $user["move"])?"":"none";
	$dd["version"] = $version;
	$main = deal_temp("temp/$tempname/table.htm",$dd);

	echo deal_temp( "temp/$tempname/main.htm", array(
		"sitewidth" => $sitewidth,
		"title" => $title,
		"logout" => "<a href='login.php?action=logout' target=_top>退出</a>",
		"main" => $main,
		"currentpath" => "<font id='currentpath'>当前路径 .</font>",
		"username" => $user["name"],
		"footer" => deal_temp("temp/$tempname/footer.htm")
		) );
	echo "</body></html>";
	exit;
}

//文件编辑界面
else if ($action=="editfile")
{
	$path=dealpath($_GET["path"]);
	if ( !$path || !$user["viewsorce"]) die("<script>alert('没有权限!');window.close();</script>");
	$ftype = getext($path);
	if ($force_encode == "auto" || $force_encode == "")
	{
		$encode = get_encode($path);
	}
	else
	{
		$encode = $force_encode;
	}
	if ($_GET['charset'])
	{
		$encode = strtoupper($_GET['charset']);
	}
	$selected_gb2312 = ($encode == "GB2312")?"selected":"";
	$selected_utf8 = ($encode == "UTF-8")?"selected":"";
	
	//if ($encode != "GB2312") die("<script>alert('文本编辑器暂时还不支持 {$encode} 编码的文件!');window.close();</script>");
	if ($user["limit"]["$ftype"] && !$user["only"])
			die("<script>alert('不能编辑 ".$user["limittype"]." 类型的文件!');window.close();</script>");
		else if (!$user["limit"]["$ftype"] && $user["only"])
			die("<script>alert('只能编辑 ".$user["limittype"]." 类型的文件!');window.close();</script>");
	header("Content-type:TEXT/HTML;Charset=".$encode);
	$out_str = deal_temp("temp/{$tempname}/header.htm",array(
		"title" => basename1($path)."  ".$title,
		"charset" => $charset,
		"keywords" => $keywords,
		"description" => $description
		));
	if ( strpos($editfiles,"|$ftype|") === false) die("<script>alert('文本编辑器不可编辑此类型文件：$ftype!');window.close();</script>");
	$out_str.= "<script language=javascript src='js/edit.js'></script>\n";
	$out_str.= "<script language=javascript src='js/hash.js'></script>\n";
	$out_str.= "<body style='backgroud-color:#ffffff;'>\n";
	$line = @file($path);
	$content = ""; $lines = "";
	$n = count($line);
	for ( $i=0; $i<$n; $i++) $content.=htmlspecialchars($line[$i]);
	$n+= 1000;
	for ( $i = 0; $i < $n; $i++ ) $lines.=($i+1)."\n";
	$main = deal_temp("js/editor.htm",array(
		"path" => $path,
		"titleback" => $icon["titleback"],
		"width" => $sitewidth-60,
		"filename" => basename1($path),
		"size" => dealsize(filesize($path)),
		"selected_gb2312" => $selected_gb2312,
		"selected_utf8" => $selected_utf8,
		"encode" => $encode
		));
	$main = deal_temp("temp/$tempname/main.htm",array(
		"sitewidth" => $sitewidth,
		"title" => "编辑文件 ".basename1($path),
		"logout" => "<a href='login.php?action=logout' target=_top>退出</a>",
		"main" => $main,
		"currentpath" => " ",
		"username" => $user["name"],
		"footer" => ""
		));
	$encode2 = get_encode("temp/$tempname/main.htm");
	if ($encode != $encode2)
	{
		$s1 = @iconv($encode2,$encode,$out_str);
		$out_str = $s1 ? $s1:$out_str;
		$s1 = @iconv($encode2,$encode,$main);
		$main = $s1 ? $s1:$main;
	}
	echo $out_str;
	echo str_replace(array("{lines}","{content}"),array($lines,$content),$main);
	echo "<script>RoundCorner('titlediv');RoundCorner('maindiv');</script>";
	exit;
}
?>