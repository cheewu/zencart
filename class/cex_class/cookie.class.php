<?php
/*//=================================
//
//	cookie操作类 [更新时间: 2010-4-11]
//
//===================================

//设置指定cookie的值
cookie::set($cookiename,$value=NULL,$days=1)

//取得指定cookie的值
cookie::get($cookiename)

//删除一个cookie名称，返回是否删除成功
cookie::del($cookiename)

//清除所有的cookie
cookie::clear()

*/

class cookie
{
	//设置指定cookie的值
	public static function set($cookiename,$value=NULL,$days=1)
	{
		setcookie( $cookiename , $value , time()+60*60*24*$days ) ; //设置cookie的值	
	}
	
	//取得指定cookie的值
	public static function get($cookiename)
	{
		if( isset($_COOKIE[$cookiename]) ){
			return $_COOKIE[$cookiename]; //返回cookie的值
		}else{
			return NULL;
		}
	}
	
	//函数说明： 删除一个cookie名称，返回是否删除成功。
	//函数引用： delcookie('cookie名称'
	public static function del($cookiename)
	{
		return setcookie( $cookiename );
	}
	
	//清除所有的cookie
	public static function clear()
	{	
		foreach ($_COOKIE as $key => $val) {
			setcookie($key,'');
		}
	}
}




?>