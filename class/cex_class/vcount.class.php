<?php
/*//=================================
//
//	访问统计类操作类 vcount [更新时间: 2010-3-22]
//
//===================================*/

class vcount
{
	// 函数说明: 获取客户端IP
	// 函数引用: $ip=getip();
	public static function getIp() 
	{ 
		if (isset($_SERVER)) 
		{ 
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			{ 
				$realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
			}elseif(isset($_SERVER['HTTP_CLIENT_IP'])){ 
				$realip = $_SERVER['HTTP_CLIENT_IP']; 
			}else{ 
				$realip = $_SERVER['REMOTE_ADDR']; 
			}
		}else{ 
			if (getenv("HTTP_X_FORWARDED_FOR")) { 
				$realip = getenv( "HTTP_X_FORWARDED_FOR"); 
			}elseif(getenv("HTTP_CLIENT_IP")){ 
				$realip = getenv("HTTP_CLIENT_IP"); 
			}else{ 
				$realip = getenv("REMOTE_ADDR"); 
			}
		} 
		return $realip;
	}
	
	
	// 函数说明: 将url转换成完整的Url地址,省略参数默认为当前页面的url地址：
	// 函数引用: $url=geturl(['url地址'])
	public static function getUrl($url='')
	{
		if(empty($url)){
			$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
	
		 //从url ? 号处划分
		 $url1=trim(substr($url,0,strpos($url,'?')));//url中?前面的网址
		 $url2=trim(substr($url,strpos($url,'?')+1,strlen($url))); //url中?后面的参数
		
		 //url2不为空
		 if(stristr($url2,'&')!==false){
		//---------------------------- 
		   //从url2中用&号划分
		   foreach(explode('&',$url2) as $value){
				if(stristr($value,'=')!==false){
					$arr1[]=$value; //保存有=号的项
				}else{
					$arr2[]=$value; //保存没有=号的项
				}
		   }
		
		   //分离url中的变量名、值
		   foreach($arr1 as $value){
				$arrname[]=substr($value,0,strpos($value,'=')); //保存变量名
				$arrnvalue[]=substr($value,strpos($value,'=')+1,strlen($value));//保存值
		   }
		   
		   //参数部分,有=号的项组成的url
		   $n=count($arrname); //数组元素个数
		   $url2=''; //重置url参数部分的值
		   $i=0;
		   for($i=0;$i<$n;$i++){
				$num=0; //计数器，用于记录url参数名出现的次数
				$str=$arrname[$i]; //暂时存储数组变量
				$numvp=$i; //值数组下标指针
				for($j=$i+1;$j<$n;$j++){
					if($str==$arrname[$j]){
						$num=$num+1;
						$numvp=$j;
					}
				}
				if($num==0){ $url2=$url2.'&'.$arrname[$i].'='.$arrnvalue[$numvp]; }		
		   }
		   //参数部分,没有=号的项组成的url
		   if(isset($arr2)){
			foreach($arr2 as $value){
				$url2=$url2.'&'.$arrnvalue[$i];
			}
		   }
		   $url=$url1.'?'.substr($url2,1,strlen($url2));
		   return $url;
		//---------------  
		 }
		 else{
		  return $url;
		 }
	}
	
	// 函数说明: 用于检页提交页面是否来自本站
	// 函数引用: $str=isselfrefer()
	public static function isSelfrefer()
	{
		if(isset($_SERVER['HTTP_REFERER'])){
			if(stristr(strtolower($_SERVER['HTTP_REFERER']),strtolower($_SERVER['SERVER_NAME']))!==false){
				return true;
			}else{
				return false;
			}
		}
		//如果不是来自链接则返回true
		return true;
	}
	
	// 函数说明: 获取当前页面的文件名
	// 函数引用: $str=selfname()
	public static function selfName()
	{
		return basename($_SERVER['PHP_SELF']);
	}
	
	// 函数说明: 获取上一来源页面的URL地址
	// 函数引用: $str=lastpageurl()
	public static function lastPageurl()
	{
		if(isset($_SERVER['HTTP_REFERER'])){
			return $_SERVER['HTTP_REFERER'];
		}
		return ''; //如果没有来源页则返回空字符
	}
	
	// 函数说明: 获得当前程序所运行的url目录
	// 函数引用: $str = urldir()
	public static function urlDir()
	{
		return 'http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'/';
	}
	
}
?>