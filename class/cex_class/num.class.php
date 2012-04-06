<?php
/*//=================================
//
//	数值操作类 num [更新时间: 2010-4-11]
//
//===================================*/

class num
{
	//圆周率
	const PI = 3.1415926;
	
	//每次返回一个永不重复的数字编号(一般用于:自动编号)
	public static function autoNumber()
	{
		$time = gettimeofday();
		return $time['sec'].substr('00000'.$time['usec'],-6,6); //时间戳+当前毫微秒数
	}
	
	// 函数说明: 转换成整数值型,参数: $num 要转换成整型数值的表达式, $negative是否允许负整数(省缺为false,即:默认为正整型数值)
	// 函数引用: $num=toint($num,$negative)
	public static function toInt($num,$negative = false)
	{
		$revalue = 0; //初始化返回值变量
		//转成数值型
		$num = intval($num);
		//是否允许负数
		if($negative){
			$revalue = $num;
		}elseif($num > 0){
			//不允许小数
			$revalue = $num;
		}
		return $revalue;
	}
	
	// 函数说明: 整除
	// 函数引用: $num=divint(被除数,除数)
	public static function divInt($num,$n)
	{ 
		$num = (int)$num;
		$n = (int)$n;
		 //除数不能为0
		if($n==0){
			return 0;
		}else{
			return ($num-($num%$n))/$n;
		}
	}
	
	// 函数说明: 按指定的位数格式化一个数值，不够指定长度的在前面加'0'，把超出的从后面去掉，返回一个数字组成的字符串
	// 函数引用: $str = formatnum($num,$n)
	public static function formatNum($num,$n)
	{
		$n = (int)$n;
		if($n<=0){ return ''; } //若给出的参数小于或等于0,则直接返回空字符;
		
		$num = ''.(int)$num;
		$len = strlen($num);
		if($len == $n){
			return $num;
		}elseif($len>$n){
			return substr($num,0,$n);
		}else{
			$i = $n - $len;
			while($i--){ $num = "0$num"; }
			return $num;
		}
	}
	
	//函数说明: 按指定保留小数点后小数位数,格式化一个浮点数
	//函数引用: $num = formatdecimal( 源浮点数 , 小数位数 )
	public static function formatDecimal($num,$n=2)
	{
		$num_long = pow(10,$n);
		$num = ((int)($num*$num_long))/$num_long;
		return $num;
	}
	
	//函数说明: 将一个10进制数转换成指定进制的数,返回生成的数的字符串 (支持从2-16进制)
	//函数引用: $str = numConversion('十进制数','几进制')
	public static function numConversion($num,$n)
	{
		$num = (int)$num;
		$n = (int)$n;
		$revalue = $num; //要返回的变量
		
		if($num && $n > 1){
			$revalue = '';
			//if($num==$n){ return '10'; }
			while($num>=$n){
				$yu = $num % $n; //余数
				//print $yu.'<br />';
				if($yu==10){
					$yu='A';
				}elseif($yu==11){
					$yu='B';
				}elseif($yu==12){
					$yu='C';
				}elseif($yu==13){
					$yu='D';
				}elseif($yu==14){
					$yu='E';
				}elseif($yu==15){
					$yu='F';
				}
				$num = (int)($num/$n); //整除数
				$revalue = "$yu$revalue" ;
			}
			
			$yu = $num;
			if($yu==10){
				$yu='A';
			}elseif($yu==11){
				$yu='B';
			}elseif($yu==12){
				$yu='C';
			}elseif($yu==13){
				$yu='D';
			}elseif($yu==14){
				$yu='E';
			}elseif($yu==15){
				$yu='F';
			}
			return "$yu$revalue" ;
		}else{
			return $revalue;
		}
	}

}
?>