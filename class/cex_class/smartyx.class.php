<?php
/*//=================================
//
//	smarty操作类 smartyx [更新时间: 2010-3-3]
//
//===================================*/

//直接返回一个smarty对象:
//参数: $path, Smarty.class.php文件所在的目录
//$smarty = smartyx::make($path)
class smartyx
{
	private $path = ''; //源字符串	
	private $smarty; //smarty对象
	
	//构造化函数
	function __construct($path=NULL)
	{
		return self::make($path);
	}
	//析构函数
	function __destruct()
	{	}
	
	//生成本类的对象
	public static function make($path='')
	{
		$path = filex::formatPath($path);
		if(include_once("$path/Smarty.class.php")){
			$this->smarty = new Smarty;
			$this->smarty->template_dir = "$path/templates/";
			$this->smarty->compile_dir = "$path/templates_c/";
			$this->smarty->config_dir = "$path/configs/";
			$this->smarty->cache_dir = "$path/cache/";
			return $this->smarty;
		}else{
			return NULL;
		}
	}
}

?>
