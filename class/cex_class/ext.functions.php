<?php
/*//=================================
//
//	扩展的通用函数 [更新时间: 2009-8-4]
//
//===================================*/

// 函数说明: 日期将设定格式转换成串返回,如果省略参数则取得系统当前日期时间
// 转换字符串规则(不分大小写)：y为年,m为月,d为日,h为时,f为分,s为秒,i为毫秒微秒,w为星期,数字0为时间戳
// 函数引用: $str=now(['日期格式字符串'])
function now($str='y-m-d h:f:s')
{
	 $retvalue=''; //定义返回值变量
	 $str=trim($str);
	 
	 if( isset( $str ) )//参数为有效字符串
	 {
	  $num=strlen($str); //取参数的长度
	  $date=getdate(); //获得一个当前时间变量
	  
	  $sec = $date['seconds'] ;  //易变时间单位,秒
	  $microsec  = datex::mictime(); //易变时间单位, 毫秒微秒
	  
	  for($i=0;$i<$num;$i++)
	  {
	   $strtemp=substr($str,$i,1);//每次取出单个字符
	   switch($strtemp)
	   {   
	   //年转换
		case 'y':
		 $retvalue=$retvalue.$date['year'];
		 break;
		case 'Y':
		 $retvalue=$retvalue.$date['year'];
		 break;
		//月转换 
		case 'm':
		 $retvalue=$retvalue.$date['mon'];
		 break;
		case 'M':
		 $retvalue=$retvalue.$date['mon'];
		 break;
		//日转换 
		case 'd':
		 $retvalue=$retvalue.$date['mday'];
		 break;
		case 'D':
		 $retvalue=$retvalue.$date['mday'];
		 break;
	   //时转换 
		case 'h':
		 $retvalue=$retvalue.$date['hours'];
		 break;
		case 'H':
		 $retvalue=$retvalue.$date['hours'];
		 break;
		//分转换 
		case 'f':
		 $retvalue=$retvalue.$date['minutes'];
		 break;
		case 'F':
		 $retvalue=$retvalue.$date['minutes'];
		 break;
		//秒转换 
		case 's':
		 $retvalue=$retvalue. $sec ;
		 break;
		case 'S':
		 $retvalue=$retvalue. $sec ;
		 break;
		//毫秒微秒转换 
		case 'i':
		 $retvalue=$retvalue.  $microsec ;
		 break;
		case 'I':
		 $retvalue=$retvalue.  $microsec ;
		 break;
		 
		//星期几转换
		case 'w':
		 $retvalue=$retvalue.$date['wday'];
		 break;
		case 'W':
		 $retvalue=$retvalue.$date['wday'];
		 break;
		 
		//时间戳转换
		case '0':
		 $retvalue=$retvalue.$date['0'];
		 break;
		 
		//默认为没有转换
		default:
		 $retvalue=$retvalue.$strtemp;
		 break;
	   }
	  }
	 }
	 return $retvalue;
}

?>