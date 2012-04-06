<?php
/*//=================================
//
//	验证码 操作类 checkcode [更新时间: 2010-7-14]
//
//===================================*/
/*
使用说明:
	checkcode::pic(); //输出验证码的图片到浏览器端
	checkcode::code(); //取得验证码的值
	checkcode::check('用户输入的验证码串'); //判断是否是正确的验证码.
*/
if (!isset($_SESSION)) { @session_start(); } //开启session
class checkcode
{	
	//输出一个验证码的图片到浏览器中
	public static function pic()
	{
		//随机生成一个4位数的验证码
		$num=rand(1000,9999);
		
		//将生成的验证码写入session
		$_SESSION['checkcode']=$num;
		
		//创建图片定义颜色值
		header("content-type:image/gif"); //设置生成图片的格式这里为png
		$im=imagecreate(60,20);
		$black=imagecolorallocate($im,0,0,0); //图片色彩
		$gray=imagecolorallocate($im,200,200,200);
		imagefill($im,0,0,$gray);
		
		//在画布上随机生成大量黑点起干扰作用
		for($i=0;$i<80;$i++){
			imagesetpixel($im,rand(0,60),rand(0,20),$black);
		}
		
		//将数字显示在画布上,数字之间的水平与垂直距离都在一定范围内随机生成
		$strx=rand(3,8);
		for($i=0;$i<4;$i++){
			$strpos=rand(1,6);
			imagestring($im,5,$strx,$strpos,substr($num,$i,1),$black);
			$strx+=rand(8,12);
		}
		imagegif($im);
		imagedestroy($im);
	}

	//当输出了图片验证码后，使用此方法取得验证码的字符串
	public static function code()
	{
		return isset($_SESSION['checkcode'])?$_SESSION['checkcode']:NULL;
	}
	
	//判断是否是正确的验证码.
	public static function check($code='')
	{
		return (self::code==$code && trim($code)!='')?true:false;
	}
}
?>