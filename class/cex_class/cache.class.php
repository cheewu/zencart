<?php
/*//=================================
//
//	cache操作类 [更新时间: 2010-6-23]
//
//===================================*/

/*缓存的使用:

//定义对象
	1. file方式:
		$config = array('path'=>'缓存目录路径');
		$c = new cache($config,'file');
	2. memcache方式:
		$config = array('server'=>'localhost','port'=>11211);
		$c = new cache($config,'memcache');
	3.使用MySql的Memory存储引擎：
		$config = array('link'=>数据库连接);
		$c = new cache($config,'mysql');

//判断指定的[缓存名称]是否已经存在
	$bool = $c->isbeing($name);

//写入缓存: 参数 name 定义缓存的名称, $value 存入缓存的值
	$c->put('name',$value); 

//取出缓存的数据: 参数 name 定义缓存的名称
	$value = $c->get('name');

//清除所有缓存
	$c->clearAll();
*/

class cache
{
	private $type; //缓存方式	
	//file方式: 
	private $cache_dir; //文件缓存目录
	//memcache方式:
	private $memcache; //memcache缓存对象
	private $mem_config=array(); //memcache缓存的配置项
	//mysql方式:
	private $mysql_link; //mysql连接对象
	private $mysql_table_isbeing=false; //缓存表是否存在
	private $mysql_table='_cexclass_cache'; //缓存数据的mysql表名
	
	//构造化函数
	function __construct($config,$type='file')
	{
		if(isset($config)){ $this->set($config,$type); }
	}
	
	//析构函数
	function __destruct()
	{
		if($this->type=='memcache'){ $this->memcache->close(); }
	}
	
	//设置参数
	public function set($config,$type='file')
	{
		if($type=='memcache'){
			$this->mem_config = $config;
			$this->memcache = new Memcache;
			$this->memcache->connect($config['server'], $config['port']) or die ("Memcache could not connect");;
			$this->type = trim($type);
		}elseif($type=='file'){
			$cache_dir = $config['path'];
			//格式化路径, 去掉路径后面的符号/或\	
			$str = substr($cache_dir, -1, 1);
			if($str == '/' || $str == '\\'){ $cache_dir = substr($cache_dir,0,strlen($cache_dir)-1); }
			//设置缓存目录
			if(is_dir($cache_dir)){
				$this->cache_dir = $cache_dir;
				$this->type = trim($type);
			}else{
				exit('cache: 缓存文件目录'.$cache_dir.'不存在!');
			}
		}elseif($type=='mysql'){
			$this->mysql_link = $config['link'];
			$this->createTable();
			$this->type = trim($type);
		}
		return $this;
	}
	
	//是否存在
	public function isbeing($name)
	{
		if($this->type=='memcache'){
			if($this->memcache->add($name,'')){
				$this->memcache->delete($name);
				return false;
			}else{
				return true;
			}
		}elseif($this->type=='file'){
			return is_file($this->getCacheFileName($name));
		}elseif($this->type=='mysql'){
			$sql = 'SELECT COUNT(name) AS num FROM '.$this->mysql_table." WHERE name = '$name'";
			$rs = $this->queryMysql($sql);
			return $rs[0]['num'];
		}
	}
	
	//读取缓存, 返回缓存的值
	public function get($name)
	{
		if($this->isbeing($name)){
			if($this->type=='memcache'){
				return unserialize($this->memcache->get($name));
			}elseif($this->type=='file'){
				return $content = unserialize(file_get_contents($this->getCacheFileName($name)));
			}elseif($this->type=='mysql'){
				$sql = 'SELECT value FROM '.$this->mysql_table." WHERE name = '$name'";
				$rs = $this->queryMysql($sql);
				return unserialize($rs[0]['value']);
			}
		}
	}
	
	//写入缓存
	public function put($name,$value,$time=0)
	{
		//将数据序列化后存入
		if($this->type=='memcache'){
			return $this->memcache->set($name,serialize($value));
		}elseif($this->type=='file'){
			return file_put_contents($this->getCacheFileName($name),serialize($value));
		}elseif($this->type=='mysql'){
			$mdate = 0;
			$value = serialize($value);
			$this->del($name);
			$sql = 'INSERT INTO '.$this->mysql_table. "(name,value,mdate) value('$name','$value','$mdate')";
			$rs = $this->queryMysql($sql);
			return true;
		}
	}
	
	//删除指定的缓存
	public function del($name)
	{
		if($this->type=='memcache'){
			return $this->memcache->delete($name);
		}elseif($this->type=='file'){
			if($this->isbeing($name))
				return unlink($this->getCacheFileName($name));
		}elseif($this->type=='mysql'){
			$sql = 'DELETE FROM '.$this->mysql_table." WHERE name = '$name' LIMIT 1";
			$this->queryMysql($sql);
			return mysql_affected_rows();
		}
	}
	
	//清空全部缓存
	public function clearAll()
	{
		if($this->type=='memcache'){
			return $this->memcache->flush();
		}elseif($this->type=='file'){
			$dir = opendir($this->cache_dir);
			while(false !== ($file = readdir($dir))){
				if(is_file($this->cache_dir."/$file")){ unlink($this->cache_dir."/$file"); } //删除目录下面的文件
			}
			closedir($dir);
			return true;
		}elseif($this->type=='mysql'){
			$sql = 'TRUNCATE TABLE '.$this->mysql_table;
			$this->queryMysql($sql);
			return true;
		}
	}
	
//file方式:
	//得到缓存文件的路径及名称
	private function getCacheFileName($name)
	{
		return $this->cache_dir."/$name.cache";
	}
	
//memcache方式:
	
	
//mysql方式:
	//执行mysql查询
	private function queryMysql($sql)
	{
		$sql = trim($sql);
		if($this->mysql_table_isbeing){
			if($sql!=''){
				$objrs = mysql_query($sql,$this->mysql_link) or die("方法: queryMysql('$sql') 错误：".mysql_error());
				//语句执行失败
				if($objrs===false){ $this->err("方法: queryMysql(), sql: $sql 执行出错!"); }
				$rs = array();
				while($row = @mysql_fetch_row($objrs)) {
					$rs[] = $row;
				}
				return $rs;
			}
		}
	}
	
	//建立缓存数据表
	private function createTable()
	{
		$sql = "CREATE TABLE IF NOT EXISTS `".$this->mysql_table."` (`name` char(20) NOT NULL COMMENT '名称',`value` varchar(16384) default NULL COMMENT '值',`overtime` int(11) NOT NULL COMMENT '过期时间戳',  PRIMARY KEY  (`name`)) ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='cexclass缓存';";
		$objrs = mysql_query($sql,$this->mysql_link) or die("方法: createTable('$sql') 错误：".mysql_error());
		//语句执行失败
		if($objrs===false){
			$this->err("方法: createTable(), sql: $sql 执行出错!");
		}else{
			$this->mysql_table_isbeing = true;
			return true;
		}
	}
}
?>