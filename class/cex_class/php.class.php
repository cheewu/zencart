<?php
/*//=================================
//
//	php操作类 [更新时间: 2010-5-24]
//
//===================================*/

class php
{

	//函数说明: 开启PHP的错误信息显示
	//函数引用: debug();
	public static function debug()
	{
		error_reporting(E_PARSE | E_ERROR); //E_ALL
		ini_set('display_errors',"ON");
	}
	
	// 函数说明: 停止PHP程序执行，并输出变量的内容。
	// 函数引用: end($value);
	public static function end($value=NULL)
	{
		if(isset($value)){
			if(is_array($value) || is_object($value) ){
				print_r($value); 
			}else{
				echo $value;
			}
		}
		exit;
	}
	
	// 函数说明: 返回程序执行的时间(单位微秒) , 参数: 在程序开始执行时的时间 $startime = gettimeofday();
	// 函数引用: $num = endtime($startime);
	public static function endtime($startime)
	{
		if(empty($startime)){ return NULL; }
		$endtime = gettimeofday();
		return ($endtime['sec']-$startime['sec'])*1000000 + $endtime['usec'] - $startime['usec'];
	}
	
	// 函数说明: 取得URL传来的变量的值
	// 函数引用: $str=getqsv("URL变量名")
	public static function getQv($valuename)
	{
		if(isset($_GET[$valuename])){
			return mb_convert_encoding(urldecode($_GET[$valuename]),'UTF-8','ASCII,UTF-8,GBK,ISO-8859-1'); //将来自url的值进行转码
		}else{
			return NULL;
		}
	}
	
	// 函数说明: 取得表单传来的表单项的值
	// 函数引用: $str=getfv("表单项的名称")
	public static function getFv($valuename)
	{
		if(isset($_POST[$valuename])){
			return $_POST[$valuename];
		}else{
			return NULL;
		}
	}
	
	// 函数说明: 取得表单传来的表单项的值或URL传来的变量的值
	// 函数引用: $str=getv("URL变量名 或 表单项的名称")
	public static function getV($valuename)
	{
		if(isset($_REQUEST[$valuename])){
			return $_REQUEST[$valuename];
		}else{
			return NULL;
		}
	}
	
	// 函数说明: PHP向浏览器输出一个文本类型的文件,使用户可以下载
	// 前提: 必须在本程序文件最开头加入: ob_start(); //开启输出缓冲
	// 函数引用:	outdownloadfile('文件名包含扩展名','文本内容')
	public static function downloadTextfile($filename,$text)
	{
		header("Content-Disposition:filename=$filename");
		header("Content-type:unknown/unknown");
		exit($text);
	}
	
	// 函数说明: 将对象及内容都转成数组
	// 函数引用:	$arr = php::objectToArray($obj)
	public static function objectToArray(&$object)
	{
		try{
			$object = json_decode(json_encode($object),true);
		}catch(Exception $e){
			if(is_object($object)){ $object = (array)$object; }
			foreach($object as $key=>$obj){
				if(is_object($obj) || is_array($obj)){
					$object[$key] = self::objectToArray($obj);
				}
			}
		}
		return $object;
	}
	
	// 函数说明: 取得服务器环境数组$_SERVER
	// 函数引用: $value = php::http([元素名称])
	public static function http($name=NULL)
	{
		if(isset($name) && isset($_SERVER[$name])){
			return $_SERVER[$name];
		}else{
			return $_SERVER;
		}
	}
	
	//PHP程序暂停执行指定的时间(单位:毫秒, 1秒=1000毫秒)
	//注: 这个函数不能工作在 Windows 操作系统中。
	public static function pause($ms)
	{
		if($ms%1000===0){
			sleep($ms/1000); //秒数
		}else{
			usleep($ms); //毫秒数
		}
	}
	
	//返回PHP的全局数组
	public static function globals()
	{
		return $GLOBALS;
	}
	
	//数据类型测试
	public static function type($value)
	{
		if(!isset($value)){ echo 'isset: false'; exit; }
		if(empty($value)){ echo 'empty: true'; }
		if(is_numeric($value)){ echo 'is_numeric: true'; }
		if(is_float($value)){ echo 'is_float: true'; }
		if(is_int($value)){ echo 'is_int: true'; }
		if(is_bool($value)){ echo 'is_bool: true'; }
		if(is_string($value)){ echo 'is_string: true'; }
		if(is_object($value)){ echo 'is_object: true'; }
		if(is_array($value)){ echo 'is_array: true'; }
		if(is_null($value)){ echo 'is_null: true'; }
	}
	
}
?>