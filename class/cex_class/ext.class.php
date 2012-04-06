<?php
/*//=================================
//
//	第三方扩展操作类 ext [更新时间: 2009-9-21]
//
//===================================*/

/*

//连接SQLserver数据库,如果"数据库服务器"参数为空则默认为本地
$objconn=mssqlconn(数据库服务器IP,数据库名,用户名,密码)

//连接MSAccess数据库,"用户名","密码"参数为空则表示无密码
$objconn=msaccessconn("数据库文件路径","密码")

//获取Discuz5的COOKIE的用户ID，前提是该域需要能访问Discuz设置的COOKIE
getDZuser($cookiepre='',$authkey='')

*/

class ext
{
	// 函数说明: 连接SQLserver数据库,如果"数据库服务器"参数为空则默认为本地
	// 函数引用: $objconn=mssqlconn(数据库服务器IP,数据库名,用户名,密码)
	public static function mssqlconn($MSSQLhost,$dbName,$UID,$PWD)
	{
		$myServer = $MSSQLhost; 
		$myUser = $UID; 
		$myPass = $PWD; 
		$myDB = $dbName;
		$objconn = @mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer"); 
		@mssql_select_db($myDB, $objconn) or die("Couldn't open database $myDB");	
		return $objconn;
	}
	
	// 函数说明: 连接MSAccess数据库,"用户名","密码"参数为空则表示无密码
	// 函数引用: $objconn=msaccessconn("数据库文件路径","密码");
	public static function msaccessconn($filename,$username='',$password='')
	{
		$mdb = realpath($filename); //mdb数据库文件所在的绝对路径
		if(!file_exists($mdb)){
			echo "找不到 access 数据库文件 '$access_mdb'，请检查 access 数据库文件路径设置是否正确；<br>当前程序路径：".dirname(__FILE__);
			exit();
		}
		return odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$mdb,$username,$password,SQL_CUR_USE_ODBC);
	}
		

	
	/*********************************************************************
	用途: 获取Discuz5的COOKIE的用户ID，前提是该域需要能访问Discuz设置的COOKIE
	参数:
	$cookiepre: cookie前缀，可查./config.inc.php文件的$cookiepre参数获得
	$authkey:论坛标识，在安装论坛时产生的15位随机码，可以在./forumdata/cache/cache_settings.php
	文件查询authkey获得
	返回:当前登陆用户uid（用户唯一编号）,如果没有登陆则返回NULL
	BY:phproot
	**********************************************************************/
	public static function getDZuser($cookiepre='',$authkey='')
	{
			$Tmp='';
			$key=md5(md5($authkey.$_SERVER['HTTP_USER_AGENT']));
			$key_length = strlen($key);
			$string=base64_decode($_COOKIE[$cookiepre.'auth']);
			$string_length = strlen($string);
			$rndkey = $box = array();
			$result = '';
	
			for($i = 0; $i <= 255; $i++) {
					$rndkey[$i] = ord($key[$i % $key_length]);
					$box[$i] = $i;
			}
	
			for($j = $i = 0; $i < 256; $i++) {
					$j = ($j + $box[$i] + $rndkey[$i]) % 256;
					$tmp = $box[$i];
					$box[$i] = $box[$j];
					$box[$j] = $tmp;
			}
	
			for($a = $j = $i = 0; $i < $string_length; $i++) {
					$a = ($a + 1) % 256;
					$j = ($j + $box[$a]) % 256;
					$tmp = $box[$a];
					$box[$a] = $box[$j];
					$box[$j] = $tmp;
					$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
			}
	
			if(substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
					$Tmp=substr($result, 8);
					list($discuz_pw, $discuz_secques, $discuz_uid) =explode("\t",$Tmp);
				
				//return addslashes($discuz_secques);    //返回浏览器类型
				$arr['uid'] = intval($discuz_uid);              //返回用户uid
				$arr['upw'] = addslashes($discuz_pw);         //返回MD5加密过的密码
				
			} else{
				//没有登录
				$arr = NULL; 
			}
			return $arr;
	}






}
?>