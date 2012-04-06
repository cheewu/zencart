<?php
/*//=================================
//
//	字符串操作类 str [更新时间: 2010-7-5]
//
//===================================*/

class str
{
	// 函数说明: 回车换行符常量
	// 函数引用: $str = $enter ; 或 $str = enter();
	public static $enter = "\r\n";
	public static function enter()
	{
		return "\r\n";
	}

	//函数说明: 生成指定位数的由大小写字母和数字组成的随机字符串
	//函数引用: $str = randStr(字符位数)
	public static function randStr($num)
	{
		$revalue = '' ; //初始化返回值	
		if((int)$num>=0){
			$strtemplates = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //字符串模板
			for($i=0;$i<$num;$i++){
				$revalue = $revalue.substr($strtemplates,rand(1,62)-1,1);
			}
		}
		return $revalue ;
	}

	// 函数说明: 取得字符串的长度：
	// 函数引用: $num = len("字符串")
	public static function len($str)
	{
		return strlen($str);
	}
	
	// 函数说明: 检测字符串A中是否包含字符串B，包含返回true,否则为false
	// 函数引用: $bool=isInstr("源串","子串");
	public static function isInstr($strA,$strB)
	{
		$strA = trim($strA);
		$strB = trim($strB);
		if(stristr($strA,$strB)!==false){
			return true;
		}else{
			return false;
		}
	}
	
	//函数说明:将字符串按分割符提取子串，存入数组并返回
	//函数引用:$arr=toArray("字符串","分隔符")
	public static function toArray($str,$separator)
	{
		$str = trim($str);
		if(trim($separator)!=''){
			$arr = explode($separator,$str);
		}else{
			$arr[]=$str;
		}
		return $arr;
	}
	
	//函数说明:将源字符串中的旧子串替换成新串
	//函数引用:$str=replace('源串','旧子串','新串')
	public static function replace($str,$strold,$strnew)
	{
		return str_replace($strold,$strnew,$str);
	}
	
	/**
	* 用来完美分词的，也就是把一段中文字只取前面一段，再加一个…
	* @para int $length 保留的长度
	* @para string $dot 最后加点什么
	* @return string
	*/
	public static function cnStr($str,$length,$dot='...')
	{
		$string = trim($str);
		$charset='utf-8';

		if(strlen($string) <= $length) {
			return $string;
		}	
		$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);	
		$strcut = '';
		if(strtolower($charset) == 'utf-8') {
	
			$n = $tn = $noc = 0;
			while($n < strlen($string)) {
	
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1; $n++; $noc++;
				}elseif(194 <= $t && $t <= 223){
					$tn = 2; $n += 2; $noc += 2;
				}elseif(224 <= $t && $t < 239){
					$tn = 3; $n += 3; $noc += 2;
				}elseif(240 <= $t && $t <= 247){
					$tn = 4; $n += 4; $noc += 2;
				}elseif(248 <= $t && $t <= 251){
					$tn = 5; $n += 5; $noc += 2;
				}elseif($t == 252 || $t == 253){
					$tn = 6; $n += 6; $noc += 2;
				}else{
					$n++;
				}
				if($noc >= $length) {
					break;
				}
			}
			if($noc > $length) {
				$n -= $tn;
			}
			$strcut = substr($string, 0, $n);	
		} else {
			for($i = 0; $i < $length; $i++) {
				$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			}
		}
		$strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);	
		return $strcut.$dot;
	}
	
	
	//函数说明:	将源字符串从左边读取指定个数的字符，返回读取的新的字符串
	//函数引用:	$str = left('源串',从左边读取几个字符)
	public static function left($str,$num)
	{
		$str = $str;
		$revalue = ''; //初始化返回值变量
		$num = (int)$num;
		if($num != 0){
			$revalue = substr($str,0,$num);
		}
		return $revalue;
	}
	
	//函数说明:	将源字符串从右边读取指定个数的字符，返回读取的新的字符串
	//函数引用:	$str = right('源串',从右边读取几个字符)
	public static function right($str,$num)
	{
		//$str = $str;
		$revalue = ''; //初始化返回值变量
		$num = (int)$num;
		if($num != 0){
			$strnum = strlen($str); //取得字符串长度
			if($num < $strnum){
				$revalue = substr($str,$strnum-$num,$num);
			}else{
				$revalue = $str;
			}
		}
		return $revalue;
	}
	
	//函数说明:将源串从右边剪去n个字符，返回新的字符
	//函数引用:$str=cutrstr('源串','从右边剪去几个字符')
	public static function cutRstr($str,$n) 
	{
		$strsource = $str;
		if(isset($strsource)){
			$num=strlen($strsource); //取得长度
			if($num>$n){
				return substr($strsource,0,$num-$n);
			}
		}
		return '';
	}
	
	//函数说明:将源串从左边剪去n个字符，返回新的字符
	//函数引用:$str=cutlstr('源串','从左边剪去几个字符')
	public static function cutLstr($str,$n) 
	{
		$strsource = $str;
		if(isset($strsource)){
			$num=strlen($strsource); //取得长度			
			if($num>$n){
				$str=substr($strsource,$n,$num);
				return $str;
			}
		}
		return '';
	}
	
	//函数说明:常用正规表达示验证
	//函数引用:$bool = isregexp('字符串','类型标名称识')
	public static function isRegexp($str,$name)
	{
		$str = trim($str);
		$revalue = false ; //初始化返回值变量
		if(trim($name)!='' && isset($str) && $name != 'safety'){
		
			$strregexp = ''; //正规表达式字符串
			switch( $name ){
			 case 'email': //email地址
				$strregexp = '^[A-Za-z0-9_.-]+@([A-Za-z0-9_.-]+.)+[A-Za-z]{2,6}$';
				break;
			 case 'ABC': //由26个英文字母的大写组成的字符串
				$strregexp = '^[A-Z]+$';
				break;
			 case 'abc': //由26个英文字母的小写组成的字符串
				$strregexp = '^[a-z]+$';
				break;
			 case 'Abc': //由26个英文字母组成的字符串
				$strregexp = '^[A-Za-z]+$';
				break;	
			 case 'Abc123': //由数字和26个英文字母组成的字符串
				$strregexp = '^[A-Za-z0-9]+$';
				break;				
			 case '123': //非负整数
				$strregexp = '^[0-9]+$';
				break;
			 case '-123': //负整数
				$strregexp = '^-[0-9]*[1-9][0-9]*$';
				break;				
			 case 'username': //用户名规则(以字母开头的由字母数字及下划线组成的至少4位的字符串)
				$strregexp = '^[A-Za-z]{1}[A-Za-z0-9_]{3}[A-Za-z0-9_]*$';
				break;				
			 case 'date': //年-月-日
				$strregexp = '^([0-9]{2}|[0-9]{4})-((0([1-9]{1}))|[1-9]|(1[1|2]))-(([0-2]([1-9]{1}))|[1-9]|(3[0|1]))$';
				break;
			case 'time': //时间
				$strregexp = '^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]';
				break;
			 case 'ip': //IP地址
				$temp = "(1[0-9]{2}|[1-9][0-9]|2[0-4][0-9]|25[0-5])";
				$strregexp =  "^$temp.$temp.$temp.$temp$";
				break;
			 case 'cn': //匹配中文字符
				$revalue = eregi('^([\x80-\xff].)+$',$str); //验证
				break;			
			 case '2bit': //匹配双字节字符(包括汉字在内)
				$strregexp = '[^\x00-\xff]';
				break;			
			 case 'phone': //匹配国内电话号码
				$strregexp = '^([0-9]{3}-|[0-9]{4}-)?([0-9]{8}|[0-9]{7})$';
				break;
			 case 'qq': //匹配腾讯QQ号
				$strregexp = '^[1-9][0-9]{4,8}$';
				break;			
			 case 'url': //url
				$strregexp = '^[Hh][Tt]{2}[Pp]://[A-Za-z0-9_.-]+.[A-Za-z0-9_.-?&/\\]+$';
				break;				
			 case 'dnum': //正浮点数
				$strregexp = '^[0-9]+.[0-9]+$';
				break;
			 case 'allphone': //所有的电话号码
				$strregexp = '([0-9]+-)?([0-9]{4}-?[0-9]{7}|[0-9]{3}-?[0-9]{8}|^[0-9]{7,8})(-[0-9]+)?';
				break;
			}
			if($strregexp!=''){
				$revalue = ereg( $strregexp , $str ); //验证
			}
		}
		
		//安全字符串模式: 不包含 \/:*?"<>|' 这些字符的所有字符串 
		if( $name == 'safety' ){
			$revalue = true ; //初始化返回值
			
			$strlist = '\,/,:,*,?,",<,>,|,\''; //不安全字符串列表（用,逗号隔开）	
			foreach( explode(',',$strlist) as $value){
				if(self::isInstr($str,$value)){
					$revalue = false; //包含不安全字符
				}
			}
		}
		//"notnull": 非空验证,必非有值
		if($name == 'notnull'){
			if(trim($str)!=''){
				$revalue = true;
			}else{
				$revalue = false;
			}
		}
		
		return $revalue ;
	}
	
	//函数说明: 检测字符串是否是正确的Email格式
	//函数引用: $bool=isemail("字符串")
	public static function isEmail($str)
	{
		return eregi('^[A-Za-z0-9_.-]+@([A-Za-z0-9_.-]+.)+[A-Za-z]{2,6}$',trim($str));
	}
	
	//函数说明: 数据列表字符串操作，对字符串里面的数据进行添加删除操作，返回一个操作后的新数据串
	//函数引用: $str = odblist('源串','分隔符','操作的项','操作类型：add|del')
	public static function odblist($str,$separator,$option,$o)
	{
		$dblist = $str;
		$o = trim($o);
		if(trim(''.$separator)==''){
			php::pend('错误：odblist()函数中，"分隔符"参数不能为空。');
		}
		if($o!='add' && $o!='del'){ echo '错误：odblist()函数中，"操作类型"只能为add或del。'; exit; }
		
		$revalue = ''; //初始化返回值变量
		$arr = self::toArray($str,$separator);
		
		//先将数组中与[操作的项]的值相同的元素删除
		foreach($arr as $value){
			if($value != $option){
				$revalue.= $separator.$value;
			}
		}
		//如果是add操作，则加入[操作的项]在最前面
		if($o=='add'){
			if($dblist==''){
				$revalue = $option;
			}else{
				$revalue = $option.$revalue;
			}
		}
		//如果是del操作
		if($o=='del'){
			if($dblist==''){
				$revalue = '';
			}else{
				$revalue = substr($revalue,1);
			}
		}
		return $revalue;
	}
	
	// 函数说明: 编码转换:(编码类型: 'GB2312','UTF-8')
	// 函数引用: 	$str = encode('文本串','原编码类型','目标编码类型')
	public static function encode($str,$scode,$dcode)
	{
		return @iconv($scode,$dcode,$str);
	}
	
	// 函数说明: 查找串中所有符合正则匹配的子串,返回一个数组
	// 函数引用: $array = findall('文本串','正则表达式')
	// 例子: str::findall($text,'/1[0-9]{10}/') 找出文本中所有的手机号
	public static function findall($text,$pattern)
	{
		$array = array();
		if(preg_match_all($pattern,$text,$array)){
			return $array;
		}else{
			return array();
		}
	}
	
}

?>