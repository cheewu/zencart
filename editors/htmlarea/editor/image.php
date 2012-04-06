<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

$path = $_GET["path"];
$from = $_SERVER[HTTP_REFERER];
$from = dirname($from).'/';
if ($from != '/' ) $path = str_replace($from,"",$path);


$max = $_GET["max"];
include_once("func.php");
$etag = "qqqq";
if ($_SERVER['HTTP_IF_NONE_MATCH'] == $etag)
{
	header('Etag:'.$etag,true,304);
	exit;
}
else header('Etag:'.$etag);
header('Last-Modified:Tue,01 Aug 1999 10:26:24 GMT');

if (!$path || !file_exists($path))  $path="images/notfound.gif"; //图片没有找到
if (!$max) err();  //默认最宽100px
if (!$imgarr=@getimagesize($path)) err(); //的到图片原始信息
$width_orig=$imgarr[0];
$height_orig=$imgarr[1];
$mime_orig=$imgarr["mime"];
$mime=str_replace("image/","",$mime_orig);
$mime=($mime=="bmp")?"wbmp":$mime;
if (!function_exists("imagecreatefrom$mime")) err();

//处理大小
if ($width_orig < $height_orig && $height_orig>$max)
{
	$height =$max;
	$width = ($max / $height_orig) * $width_orig;
}
else if ($width_orig>$height_orig && $width_orig>$max)
{
	$width=$max;
	$height=($max/$width_orig)*$height_orig;
}
else err();

//生成图片
$image_p = @imagecreatetruecolor($width, $height) or err();
if (@eval('$image = imagecreatefrom'.$mime.'($path);')===false) err();
@imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig) or err();

//输出图片
@header('Content-type: '.$mime_orig);
@header("Content-Length: ".filesize($path));
header("Last-Modified: ".date("D, d M Y H:i:s",filectime($path))." GMT");

if (@eval('image'.$mime.'($image_p, null,75);')===false) err();

function err()
{
	global $path;
	header("Content-Length: ".@filesize($path));
	readfile($path);
	die;
}
?>