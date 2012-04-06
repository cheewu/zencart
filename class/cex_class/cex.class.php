<?php
ob_start(); //开启输出缓冲

//if (!isset($_SESSION)) { session_start(); } //开启session

//设置页面的编码: gb2312 或 utf-8
header("Content-type: text/html; charset=utf-8");
ini_set('date.timezone','Asia/Shanghai'); //设置时区

//程序开始的执行时间
$startime = gettimeofday();

//加载常用函数库
include_once dirname(__FILE__).'/ext.functions.php';

//自动加载类库
function cex_autoload($class_name)
{
	if(!class_exists($class_name)){
		$path = dirname(__FILE__).'/'.$class_name.'.class.php';
		if(is_file($path)){
			return include $path;
		}
	}
}
//已经存在__autoload函数的时候
if(function_exists('__autoload')){ spl_autoload_register('__autoload'); }
spl_autoload_register('cex_autoload');
?>