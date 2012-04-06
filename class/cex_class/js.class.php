<?php
/*//=================================
//
//	js操作类 [更新时间: 2010-7-5]
//
//===================================*/

class js
{

	//生成js开始与结尾
	private static function make($js)
	{
		echo "<script language='JavaScript'> $js </script>";
		exit;
	}
	
	// 函数说明: 在浏览器中弹出一个信息窗口
	// 函数引用: msgbox("字符信息")
	public static function msgbox($msg)
	{
		echo  "<script language='JavaScript'> alert('$msg'); </script>";
	}
	
	// 函数说明:停止php程序,并转向其它网址
	// 函数引用:gourl("转向的网址")
	public static function gourl($url)
	{
		self::make("window.location.href='$url';");
	}
	
	//函数说明：点击浏览器的后退按钮
	//函数引用：goback("提示信息")
	public static function goback($msg=NULL)
	{
		if(isset($msg)){
			self::make("alert('$msg'); "." history.back();");
		}else{
			self::make("history.back();");
		}
	}
	
	// 函数说明: 关闭当前浏览器窗口
	// 函数引用: closeie()
	public static function closeie()
	{
		self::make('window.close();');
	}
	
	// 函数说明: 返回一个值到源页的某表单项中
	// 函数引用: returnFormValue("源页上的表单名","源页上的表单项名","要返回的值")
	public static function returnFormValue($forms,$xiang,$values)
	{
		self::make("window.opener.document.$forms.$xiang.value='$values';");
	}
	
	// 函数说明: 将某一文本内容写入剪切板中
	// 函数引用: inclipboard("要写入剪切板的字符串")
	public static function inclipboard($content)
	{
		self::make("clipboardData.setData('Text','$content');");
	}
	
	// 函数说明: 防止被人frame
	// 函数引用: donotframe()
	public static function donotframe()
	{
		self::make("if(top.location != self.location)top.location=self.location;");
	}
	
	// 函数说明: 打开新窗口打开网页
	// 函数引用：openweb("网址")
	public static function openweb($strUrl)
	{
		self::make("window.open('$strUrl');");
	}
	
	// 函数说明: 在浏览器中弹出一个信息窗口,并转向其它网址
	// 函数引用:  msgskip("字符信息","转向的网址")
	public static function msgskip($msg,$url)
	{
		self::make("alert('$msg'); window.location.href='$url';");
	}
	
	//函数说明: 提示信息并页面返回
	//函数引用: msgback("提示信息")  
	public static function msgback($msg)
	{
		self::make("alert('$msg'); history.back();");
	}
	
	//使用说明：在A.asp里链接B.asp,在B.asp里调用此函数可 弹出提示信息框、刷新A.asp并关闭B.asp
	//函数引用: boxrefresh("提示信息！")
	public static function boxrefresh($msg)
	{
		self::make("window.alert('$msg'); window.opener.location.reload();window.close();");
	}
	
	//函数说明:弹出提示信息框，并关闭本页
	//函数引用: boxclose("提示信息") 
	public static function boxclose($msg)
	{
		self::make("window.alert('$msg'); window.close();");
	}

}
?>