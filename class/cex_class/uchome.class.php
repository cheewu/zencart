<?php
/*//=================================
//
//	uchome1.5操作类 [更新时间: 2009-8-4]
//
//===================================*/

class uchome
{
	//构造化函数
	function __construct($path=NULL)
	{
		if(isset($path)){ $this->setPath($path); }
	}
	//析构函数
	function __destruct()
	{	}

	//生成本类的对象
	public static function make($path='')
	{
		return new uchome($path);
	}

	//设置uchome的安装目录
	public function setPath($uchome_path)
	{
		$common_path = filex::formatPath($uchome_path).'/common.php';
		if(filex::isFile($common_path)){
			include_once($common_path); //载入uchome的公共文件
		}else{
			exit('uchome操作类: 没有找到uchome的安装目录!');
		}
	}

	//取得uchome的数据库连接
	public function getDb()
	{
		return $_SGLOBAL['db']; //数据库操作对象
	}

	#取得当前登录用户的信息
	public function getNowuser()
	{
		$arr['uid'] = $_SGLOBAL['supe_uid']; //该变量为当前用户的UID
		$arr['username'] = $_SGLOBAL['supe_username']; //该变量为当前用户的名字
		return $arr;
	}

	//取得指定用户信息
	//$arr['uid']; //用户UID
	//$arr['username']; //用户名
	//$arr['frienduid']; //用户的好友UID列表，以逗号分割。例如：1,5,6,7
	public function getUser($uid)
	{
		if(!(int)$uid){ return NULL; }
		return getspace(uid);
	}

	//该函数为显示跳转信息： message 为信息， url 为跳转url
	public function msgbox($message, $url)
	{
		showmessage($message, $url);
	}
}
?>