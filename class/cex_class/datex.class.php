<?php
/*//=================================
//
//	日期操作类 datex [更新时间: 2010-4-11]
//
//===================================*/
/*
静态方法:
//返回当前微秒级的6位时间数值
datex::mictime()

//返一个对象本身
datex::make($date=NULL)

方法:
//检测一个字符串是否能日期
datex::isDate($date)

//取得日期的年份数
datex::getYear($date)

//取得日期的月份数
datex::getMonth($date)

//取得日期里的日数
datex::day($date)

//对一个日期进行(年,月,日数)的加减操作,返回新的日期的字符串 , 如果失败则返回NULL 
//参数说明：$date 日期, $o 操作类型(+加,-减), $p 日期的单位('y'年, 'm'月, 'd'日), $num 操作的数
datex::oDate($date,$o,$p,$num)

//将给出的时间日期,转换成只包含日期[年-月-日]的值
datex::make($date=NULL)->todate($datetime)

//取得日期对应的星座(用于计算生日时的星座)
//参数: $type 设置返回十二个星座的数据类型('num' [省缺]返回序列的数值,'cn' 返回中文,'en' 返回英文) 1.白羊座 2.金牛座 3.双子座 4.巨蟹座 5.狮子座 6.处女座 7.天秤座 8.天蝎座 9.射手座 10.山羊座 11.水瓶座 12.双鱼座
datex::make($date=NULL)->constellation($date,$type)

//取得日期对应的生肖属相(用于计算生日时的生肖属相)
//参数: $type 设置返回十二个生肖属相的数据类型('num' [省缺]返回序列的数值,'cn' 返回中文,'en' 返回英文) 1.鼠 2.牛 3.虎 4.兔 5.龙 6.蛇 7.马 8.羊 9.猴 10.鸡 11.狗 12.猪
datex::make($date=NULL)->animalrepresentation($date,$type)

//取得日期对应的星期
//参数：$type 设置返回星期的数据类型('num' [省缺]返回序列的数值,'cn' 返回中文,'en' 返回英文)0.星期日 1.星期一 2.星期二 3.星期三 4.星期四 5.星期五 6.星期六
datex::make($date=NULL)->week($date,$type)
*/

class datex
{
	//private $date = ''; //源字符串
	//构造化函数
	function __construct()
	{	}
	//析构函数
	function __destruct()
	{	}

	// 函数说明: 返回当前微秒级的6位时间数值	
	public static function mictime()
	{
		$time = gettimeofday();
		return substr('00000'.$time['usec'],-6,6);
	}

	// 函数说明: 检测一个字符串是否能日期
	// 函数引用:	$bool = isdate($strdate)
	public static function isDate($strdate)
	{
		if(strtotime($strdate)!==false){
			return true;
		}else{
			return false;
		}
	}

	// 函数说明: 取得日期的年份数
	// 函数引用: $num = year($date)
	public static function getYear($date)
	{
		$arr = getdate(strtotime($date));
		return $arr['year'];
	}

	// 函数说明: 取得日期的月份数
	// 函数引用: $num = month($date)
	public static function getMonth($data)
	{
		$arr = getdate(strtotime($date));
		return $arr['mon'];
	}
	
	// 函数说明: 取得日期里的日数
	// 函数引用: $num = day($date)
	public static static function getDay($data)
	{
		$arr = getdate(strtotime($date));
		return $arr['mday'];
	}
	
	// 函数说明: 对一个日期进行(年,月,日数)的加减操作,返回新的日期的字符串 , 如果失败则返回NULL
	// 参数说明：$date 日期, $o 操作类型(+加,-减), $p 日期的单位('y'年, 'm'月, 'd'日), $num 操作的数值
	// 函数引用: $str = oDate($date,$o,$p,$num)
	public static function oDate($data,$o,$p,$num)
	{
		switch($p){
			case 'y':
				$p = 'years';
				break;
			case 'm':
				$p = 'months';
				break;
			case 'd':
				$p = 'days';
				break;
			default:
				return NULL;
				break;
		}
		$arr = getdate( strtotime("$o$num $p",strtotime($date)) );
		return $arr['year'].'-'.$arr['mon'].'-'.$arr['mday'];
	}
	
	// 函数说明: 将给出的时间日期,转换成只包含日期[年-月-日]的值
	// 函数引用: $str = todate($datetime)
	public static function toDate($datetime)
	{
		return self::getYear().'-'.self::getMonth().'-'.self::getDay();
	}
	
	// 函数说明: 取得日期对应的星座(用于计算生日时的星座),参数: $type 设置返回十二个星座的数据类型('num' [省缺]返回序列的数值,'cn' 返回中文,'en' 返回英文) 1.白羊座 2.金牛座 3.双子座 4.巨蟹座 5.狮子座 6.处女座 7.天秤座 8.天蝎座 9.射手座 10.山羊座 11.水瓶座 12.双鱼座
	// 函数引用: $value = constellation($date,$type)
	public static function constellation($data,$type='num')
	{
		//$date = $date;
		$revalue = 0; //初始化返回值变量
		$type = trim($type);
		$month = self::getMonth(); //取月份数
		$day = self::getDay(); //取得日数
		
		//1.白羊座 
		//日期：3月21日-4月20日
		if(($month==3 && $day>=21) || ($month==4 && $day<=20)){
			$revalue = 1;
		}
		//2.金牛座 
		//日期：4月21日-5月21日
		if($revalue == 0){
			if( ($month==4 && $day>=21) || ($month==5 && $day<=21) ){
				$revalue = 3;
			}		
		}
		//3.双子座 
		//日期：5月22日-6月21日
		if($revalue == 0){
			if( ($month==5 && $day>=22) || ($month==6 && $day<=21) ){
				$revalue = 3;
			}		
		}
		//4.巨蟹座 
		//日期：6月22日-7月22日
		if($revalue == 0){
			if( ($month==6 && $day>=22) || ($month==7 && $day<=22) ){
				$revalue = 4;
			}		
		}
		//5.狮子座 
		//日期：7月23日-8月22日
		if($revalue == 0){
			if( ($month==7 && $day>=23) || ($month==8 && $day<=22) ){
				$revalue = 5;
			}		
		}
		//6.处女座 
		//日期：8月23日-9月23日
		if($revalue == 0){
			if( ($month==8 && $day>=23) || ($month==9 && $day<=23) ){
				$revalue = 6;
			}		
		}	
		//7.天秤座 
		//日期：9月24日-10月23日
		if($revalue == 0){
			if( ($month==9 && $day>=24) || ($month==10 && $day<=23) ){
				$revalue = 7;
			}		
		}	
		//8.天蝎座 
		//日期：10月24日-11月22日
		if($revalue == 0){
			if( ($month==10 && $day>=24) || ($month==11 && $day<=22) ){
				$revalue = 8;
			}		
		}
		//9.射手座 
		//日期：11月23日-12月21日
		if($revalue == 0){
			if( ($month==11 && $day>=23) || ($month==12 && $day<=21) ){
				$revalue = 9;
			}		
		}	
		//10.山羊座 
		//日期：12月22日-1月20日
		if($revalue == 0){
			if( ($month==12 && $day>=22) || ($month==1 && $day<=20) ){
				$revalue = 10;
			}		
		}
		//11.水瓶座 
		//日期：1月21日-2月19日
		if($revalue == 0){
			if( ($month==1 && $day>=21) || ($month==1 && $day<=19) ){
				$revalue = 11;
			}		
		}
		//12.双鱼座 
		//日期：2月20日-3月20日
		if($revalue == 0){
			if( ($month==2 && $day>=20) || ($month==3 && $day<=20) ){
				$revalue = 12;
			}		
		}
		
		//转换中文或英文
		if($revalue>0){
			if($type=='cn'){
				switch($revalue){   
					//1.白羊座
					case 1:
						$revalue='白羊座';
						break;
					//2.金牛座
					case 2:
						$revalue='金牛座';
						break;
					//3.双子座
					case 3:
						$revalue='双子座';
						break;	
					// 4.巨蟹座
					case 4:
						$revalue='巨蟹座';
						break;
					//5.狮子座
					case 5:
						$revalue='狮子座';
						break;
					//6.处女座
					case 6:
						$revalue='处女座';
						break;
					// 7.天秤座
					case 7:
						$revalue='天秤座';
						break;
					// 8.天蝎座
					case 8:
						$revalue='天蝎座';
						break;
					// 9.射手座
					case 9:
						$revalue='射手座';
						break;	
					// 10.山羊座
					case 10:
						$revalue='山羊座';
						break;
					// 11.水瓶座
					case 11:
						$revalue='水瓶座';
						break;
					// 12.双鱼座
					case 12:
						$revalue='双鱼座';
						break;
				}			
			}else{
				if($type=='en'){
					switch($revalue){   
						//1.白羊座 
						case 1:
							$revalue='Aries';
							break;
						//2.金牛座
						case 2:
							$revalue='Taurus';
							break;
						//3.双子座
						case 3:
							$revalue='Gemini';
							break;	
						// 4.巨蟹座
						case 4:
							$revalue='Cancer';
							break;
						//5.狮子座
						case 5:
							$revalue='Leo';
							break;
						//6.处女座
						case 6:
							$revalue='Virgo';
							break;
						// 7.天秤座
						case 7:
							$revalue='Libra';
							break;
						// 8.天蝎座
						case 8:
							$revalue='Scorpio';
							break;
						// 9.射手座
						case 9:
							$revalue='Sagittarius';
							break;	
						// 10.山羊座
						case 10:
							$revalue='Capricorn';
							break;
						// 11.水瓶座
						case 11:
							$revalue='Aquarius';
							break;
						// 12.双鱼座
						case 12:
							$revalue='Pisces';
							break;
					}
				}
			}
		}return $revalue;
	}
	
	// 函数说明: 取得日期对应的生肖属相(用于计算生日时的生肖属相),参数: $type 设置返回十二个生肖属相的数据类型('num' [省缺]返回序列的数值,'cn' 返回中文,'en' 返回英文) 1.鼠 2.牛 3.虎 4.兔 5.龙 6.蛇 7.马 8.羊 9.猴 10.鸡 11.狗 12.猪
	// 函数引用: $value = animalrepresentation($date,$type)
	public static function animalrepresentation($data,$type='num')
	{
		//$date = $date;
		$revalue = 0; //初始化返回值变量
		$type = trim($type);
		$numyear = self::getYear();	//取得年份
		
		//以 1983年 [猪] 为参照
		$numyear = $numyear - 1983; //取得差
		if( $numyear == 0 ){
			$revalue = 12; // [猪] 的序列数值
		}else{
			if( $numyear > 0){
				//1983年之后
				$revalue = $numyear % 12 ;
				if($revalue == 0){
					$revalue = 12;
				}
			}else{
				//1983年之前
				$revalue = 12 - (abs($numyear) % 12);
			}
		}
		
		//转换中文或英文
		if($revalue>0){
			if($type=='cn'){
				switch($revalue){ 
					//1.鼠  
					case 1:
						$revalue='鼠';
						break;
					//2.牛 
					case 2:
						$revalue='牛';
						break;
					//3.虎 
					case 3:
						$revalue='虎';
						break;
					//4.兔 
					case 4:
						$revalue='兔';
						break;
					//5.龙 
					case 5:
						$revalue='龙';
						break;
					//6.蛇 
					case 6:
						$revalue='蛇';
						break;
					//7.马 
					case 7:
						$revalue='马';
						break;	
					//8.羊 
					case 8:
						$revalue='羊';
						break;	
					//9.猴 
					case 9:
						$revalue='猴';
						break;
					//10.鸡 
					case 10:
						$revalue='鸡';
						break;	
					//11.狗 
					case 11:
						$revalue='狗';
						break;
					//12.猪
					case 12:
						$revalue='猪';
						break;		
				}
			}else{
				if($type=='en'){
					switch($revalue){ 
						//1.鼠  
						case 1:
							$revalue='Rat';
							break;
						//2.牛 
						case 2:
							$revalue='Ox';
							break;
						//3.虎 
						case 3:
							$revalue='Tiger';
							break;
						//4.兔 
						case 4:
							$revalue='Hare';
							break;
						//5.龙 
						case 5:
							$revalue='Dragon';
							break;
						//6.蛇 
						case 6:
							$revalue='Snake';
							break;
						//7.马 
						case 7:
							$revalue='Horse';
							break;	
						//8.羊 
						case 8:
							$revalue='Sheep';
							break;	
						//9.猴 
						case 9:
							$revalue='Monkey';
							break;
						//10.鸡 
						case 10:
							$revalue='Cock';
							break;	
						//11.狗 
						case 11:
							$revalue='Dog';
							break;
						//12.猪
						case 12:
							$revalue='Boar';
							break;		
					}
				}
			}
		}
		return $revalue;
	}
	
	// 函数说明: 取得日期对应的星期，参数：$type 设置返回星期的数据类型('num' [省缺]返回序列的数值,'cn' 返回中文,'en' 返回英文)0.星期日 1.星期一 2.星期二 3.星期三 4.星期四 5.星期五 6.星期六
	// 函数引用: $value = week($date,$type)
	public static function week($date,$type='num')
	{
		//$date = $date;
		//日期参数默认为当前日期
		if(!isset($date)){ $date=now('y-m-d'); }
		$revalue = ''; //初始化返回值变量
		$arr = getdate(strtotime($date));
		if($type=='cn'){
			switch($arr['wday']){ 
				//0.星期日
				case 0:
					$revalue='星期日';
					break;
				//1.星期一
				case 1:
					$revalue='星期一';
					break;
				//2.星期二
				case 2:
					$revalue='星期二';
					break;
				//3.星期三
				case 3:
					$revalue='星期三';
					break;
				//4.星期四
				case 4:
					$revalue='星期四';
					break;	
				//5.星期五
				case 5:
					$revalue='星期五';
					break;	
				//6.星期六
				case 6:
					$revalue='星期六';
					break;
			}
		}else{
			if($type=='en'){
				$revalue = $arr['weekday']; //英文的星期表示
			}else{
				$revalue = $arr['wday']; //星期的数值
			}
		}
		return $revalue;
	}
	
}
?>