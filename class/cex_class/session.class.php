<?php
/*//=================================
//
//	session操作类 [更新时间: 2009-11-14]
//
//===================================*/

if (!isset($_SESSION)) { @session_start(); } //开启session
class session
{
	//设置指定session的值
	public static function set($name,$value)
	{
		$_SESSION[$name] = $value;
	}
	
	//取得指定session的值
	public static function get($name)
	{
		return isset($_SESSION[$name])?$_SESSION[$name]:NULL;
	}
}

?>