<?php
/*//=================================
//
//	mysql操作类 mydb [更新时间: 2010-8-13]
//
//===================================*/

class mydb {
	//数据库相关
	private $db; //mysql数据库连接
	private $db_info = array('server'=>'',
							 'user'=>'',
							 'password'=>'',
							 'dbname'=>'',
							 'encode'=>'',
							 'tables'=>array()); //数据库的连接信息数组
	//数据表相关
	private $table; //当前的数据表名
	private $table_as; //数据表的别名
	private $table_info = array('name'=>'',
								'as'=>'', //数据表的别名
								'isbeing'=>false, //当前是否已经设置了数据表
								'fields'=>array(), //当前数据表中的字段列表	
								); //数据表连接信息数组
	//执行信息
	private $sql = array(); //执行的sql句记录
	private $n; //执行sql语句影响到的记录数	
	private $_sql = array(); //sql语句关键字段数组
		
	//初始化
	function __construct(&$objconn=NULL){
		if(isset($objconn)){ $this->setConn($objconn); }
		$this->init_sql();
	}
	//析构函数
	function __destruct()
	{	}
	
	//初始化sql条件数组
	function init_sql()
	{
		$this->_sql = array(
			'select'=>'*',
			'where'=>'',
			'order'=>'',
			'group'=>'',
			'limit'=>'',
			'join'=> array('table'=>'','where'=>'')
			);
	}
	
//数据库操作: ============================
	
	//静态方法,创建对象本身，返回一个本类的对象
	public static function make(&$objconn)
	{
		return new mydb($objconn);
	}
	
	//连接MySQL数据库服务器
	//引用: link("数据库服务器","用户名","密码");
	public function link($server,$user,$password)
	{
	  	$this->db = mysql_connect($server,$user,$password) or die('无法连接数据库：'.mysql_error());
		$this->db_info['server'] = $server;
		$this->db_info['user'] = $user;
		$this->db_info['password'] = $password;
		return $this;
	}
	
	//关闭数据库连接(在进行单数据库操作时,一般不用本方法)
	public function close()
	{
		return mysql_close($this->db);
	}
	
	//设置数据库链接
	public function setConn(&$objconn)
	{
		$this->db = $objconn;
	}
	
	//返回数据库连接对象
	public function getConn()
	{
		return $this->db;
	}
	
	//打开数据库,默认为utf8编码
	//引用: databases("数据库名","编码方式：gbk、utf8");
	public function databases($dbname,$Encode='utf8')
	{
		if(trim($dbname)===''){ $this->err("方法: databases(), 参数出错! 数据库名称不能为空。"); }
		if($dbname != $this->db_info['dbname']){
			mysql_select_db($dbname,$this->db) or die('不能打开数据库：'.mysql_error());//打开数据库		
			mysql_query("set names $Encode",$this->db);//设置编码方式：gbk、utf8
			$this->db_info['dbname'] = $dbname;
			$this->db_info['encode'] = $Encode;
			$this->db_info['tables'] = $this->getTables();
		}
		return $this;
	}
	
	//取得数据库中所有数据表名称,返回数组
	public function getTables()
	{
		$objrs = $this->run('SHOW TABLES');
		while($row = mysql_fetch_array($objrs)){
			$arr[]=$row[0];
		}
		return $arr;
	}
	
	//执行sql语句,返回记集对象
	public function run($sql)
	{
		if(trim($sql)==''){ return NULL;} //$sql语句不能为空
		
		$objrs = mysql_query($sql,$this->db) or die("方法: run('$sql') 错误：".mysql_error());
		//语句执行失败
		if($objrs===false){ $this->err("方法: run(), sql: $sql 执行出错!"); }
		
		$this->sql[] = $sql;
		if($objrs===true){
			$this->n = mysql_affected_rows(); //影响到的记录数
		}else{
			$this->n = mysql_num_rows($objrs); //查询到的记录数
		}
		$this->init_sql(); //清除sql条件
		return $objrs;
	}
	
	//sql查询
	public function query($sql)
	{
		if(trim($sql)=='') return array(); //$sql语句不能为空
		$objrs = mysql_query($sql,$this->db) or die("方法: query('$sql') 错误：".mysql_error());
		$this->sql[] = $sql; //记录执行的sql语句
		$this->init_sql(); //清除sql条件
		if($objrs===true){
			$this->n = mysql_affected_rows(); //影响到的记录数
		}else{
			$this->n = mysql_num_rows($objrs); //查询到的记录数
		}
		//处理并返回结果集
		$rs = array();
		while($row = mysql_fetch_array($objrs,MYSQL_ASSOC)){
			$rs[] = $row;
		}
		return $rs;
	}
	
	//输出执行信息,返回一个信息数组
	public function debug()
	{
		$arr = array_reverse($this->sql,true);
		$text = '';
		foreach($arr as $key=>$sql){
			$text.= "sql[$key]: $sql  影响记录数: $this->n <br />";
		}
		return $text;
	}
	
//数据表操作: ============================
	
	//设置数据表，返回对象自身
	public function table($table,$as=NULL)
	{
		foreach($this->db_info['tables'] as $value){
			//检查数据表是否存在
			if($table == $value){
				$this->table = $this->table_info['name'] = $table; //设置当前数据表名
				if(isset($as) && trim($as)!=''){
					$this->table_as = $this->table_info['as'] = " AS $as ";
				}
				$this->table_info['isbeing'] = true; //设置表状态为开启
				$fields = $this->getFields(); //取得当前数据表字段
				$this->table_info['fields'] = $fields['Type'];
				return clone $this;
			}
		}
		$this->err("方法: table(), 数据表 $table 不存在！");
	}
	
	//优化一个指定的数据表,回收闲置的空间
	public function optimizeTable()
	{
		$this->beingTable(__FUNCTION__);
		$this->run('OPTIMIZE TABLE '.$this->table);
	}
	
	//设置数据表中的自增字段的开始值
	public function setAuto($num=1)
	{
		$this->beingTable(__FUNCTION__);
		if((int)$num){ $this->run('alter table '.$this->table.' AUTO_INCREMENT='.(int)$num); }
	}
	
	//设置存储引擎, MyISAM , MEMORY, InnoDB
	public function setEngine($type='InnoDB')
	{
		$this->beingTable(__FUNCTION__);
		
		$sql = 'ALTER TABLE '.$this->table." ENGINE = $type;";
		return $this->run($sql);
	}
	
	//取得数据表中将所有字段名['Field']及其类型['Type']遍历到数组中,返回一个二维数组
	public function getFields()
	{
		$this->beingTable(__FUNCTION__);
		
		$objrs = $this->run('SHOW COLUMNS FROM '.$this->table);
		while ($row = mysql_fetch_array($objrs)) {
			$arr2field['Field'][]=$row[0] ; // 同$row['Field']
			$arr2field['Type'][]=$row[1] ; // 同$row['Type']
		}
		return $arr2field ;
	}
	
	//取得表中的主键名称
	public function getPk()
	{
		$this->beingTable(__FUNCTION__);
		
		$revalue = '' ; //设定返回初值		
		$objrs = $this->run('SHOW COLUMNS FROM '.$this->table);
		while ($row = mysql_fetch_array($objrs)) {
			if( $row['Key'] == 'PRI' ){
				$revalue = $row['Field'] ;
				break ;
			}
		}
		return $revalue ;	//返回值
	}
	
	//取得表中下一个条记录的自增字段的值
	public function getAutoid()
	{
		$this->beingTable(__FUNCTION__);
		
		$objrs = $this->run("SHOW TABLE STATUS LIKE '$this->table'");
		while ($row = mysql_fetch_array($objrs)) {
			return (int)$row['Auto_increment'];
		}
	}

//sql语句分段方法:========================
	public function fields($str='*')
	{
		if(trim($select)==''){
			$this->_sql['select'] = '*';
		}else{
			$this->_sql['select'] = $select;
		}
		return $this;
	}
	public function where($where)
	{
		$this->_sql['where'] = $where;
		return $this;
	}
	public function order($order)
	{
		$this->_sql['order'] = $order;
		return $this;
	}
	public function limit($limit)
	{
		$this->_sql['limit'] = $limit;
		return $this;
	}
	public function group($group)
	{
		$this->_sql['group'] = $group;
		return $this;
	}
	public function join($table,$where) //联合查询
	{
		$this->_sql['join']['table'] = $table;
		$this->_sql['join']['where'] = $where;
		return $this;
	}
	
//事务处理: ==============================

	//开启一个事务
	public function start_transaction()
	{
		$this->setEngine(); //设置成InnoDB 存储类型 ，以支持事务
		mysql_query('START TRANSACTION;',$this->db);
	}
	
	//回滚一个事务
	public function rollback()
	{
		mysql_query('ROLLBACK;',$this->db);
	}
	
	//提交一个事务
	public function commit()
	{
		mysql_query('COMMIT;',$this->db);
	}


//数据记录操作: ==========================
	
	//添加记录,返回成功添加的记录条数
	public function insert($arr_rs)
	{
		$this->beingTable(__FUNCTION__);
		if(!count($arr_rs)){ return 0; } //如果是空记录数组，则直接就返回0
		
		$n = 0;
		//遍历记录
		foreach($arr_rs as $r){
			$fieldlist = ''; //字段列表
			$valuelist = ''; //值列表
			//遍历字段名与值
			foreach($r as $key => $value){
				if($this->inFields($key)){
					$fieldlist .= "$key,";
					$valuelist .= "'$value',";
				}
			}
			$fieldlist = substr($fieldlist,0,strlen($fieldlist)-1);
			$valuelist = substr($valuelist,0,strlen($valuelist)-1);
			$this->run("INSERT INTO $this->table($fieldlist) VALUES($valuelist);"); //写入记录
			$n+=$this->n;
		}
		return $n;
	}

//修改记录
	//更新一组记录字段
	public function update($arr_rs)
	{
		$this->beingTable(__FUNCTION__);
		
		$arr = $this->getSql(); //取得sql语句关键字段
		$setfield = ''; //字段列表
		//遍历字段名与值
		foreach($arr_rs as $key => $value){
			if($this->inFields($key)){
				$setfield.= "$key = '$value',";
			}
		}
		$setfield = substr($setfield,0,strlen($setfield)-1);
		$strsql = "UPDATE $this->table SET $setfield ".$arr['where'].' '.$arr['order'].' '.$arr['limit'];
		$this->run($strsql);
		return $this->n;
	}
	
	//自定义更新记录字段值
	public function setField($setfield)
	{
		$this->beingTable(__FUNCTION__);
		
		if(trim($setfield)==''){ return false; }
		$arr = $this->getSql(); //取得sql语句关键字段	
		$strsql = "UPDATE $this->table SET $setfield ".$arr['where'].' '.$arr['order'].' '.$arr['limit'];
		$this->run($strsql);
		return $this->n;
	}

	//删除记录,返回删除的记录数
	public function delete()
	{
		$this->beingTable(__FUNCTION__);
		
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql = "DELETE FROM $this->table ".$arr['where'].' '.$arr['order'].' '.$arr['limit'];
		$this->run($strsql);
		return $this->n;
	}

	//查询记录
	public function select()
	{
		$this->beingTable(__FUNCTION__);
		
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql='SELECT '.$arr['select']." FROM $this->table $this->table_as".$arr['join_table'].' '.$arr['where'].$arr['join_where'].' '.$arr['group'].' '.$arr['order'].' '.$arr['limit'];
		
		$objrs = $this->run($strsql);
		$rs = array();
		while($row = mysql_fetch_array($objrs,MYSQL_ASSOC)){
			$rs[] = $row;
		}
		return $rs;
	}
	
	//查询所有记录
	public function getAllRs()
	{
		$this->beingTable(__FUNCTION__);
		
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql='SELECT '.$arr['select']." FROM $this->table $this->table_as".$arr['join_table'].' '.$arr['group'].' '.$arr['order'];
		$objrs = $this->run($strsql);
		while ($row = mysql_fetch_array($objrs,MYSQL_ASSOC)){
			$rs[] = $row;
		}
		return $rs;
	}
	
	//随机取得指定数量的记录
	public function getRandRs($n)
	{
		$this->beingTable(__FUNCTION__);
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql = 'SELECT '.$arr['select']." FROM $this->table ".$arr['where']." ORDER BY RAND() LIMIT $n;";
		return $this->query($strsql);
	}

	//统计记录数
	public function count()
	{
		$this->beingTable(__FUNCTION__);
		
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql="SELECT COUNT(*) AS num FROM $this->table $this->table_as".$arr['join_table'].' '.$arr['where'].$arr['join_where'].' '.$arr['group'].' '.$arr['limit'];
		$objrs = $this->run($strsql);
		while($row = mysql_fetch_array($objrs)){
			return (int)$row['num'];
		}
		return 0;
	}
	
	// 统计数据表中的所有记录数	
	public function countAll()
	{
		$this->beingTable(__FUNCTION__);
		
		$objrs = $this->run("SHOW TABLE STATUS LIKE '$this->table'");
		while($row = mysql_fetch_array($objrs)){
			return (int)$row['Rows'];
		}
		return 0;
	}

//内部方法: ==========================

	//当前是否设置了数据表
	private function beingTable($function)
	{
		if(!$this->table_info['isbeing']){ $this->err("方法: $function(), 当前还没有设定要操作的数据表！必须先用table()方法设定。");}
	}

	//取得sql关键字数组(可以直接应用的)
	private function getSql()
	{
		if( trim($this->_sql['select'])=='' ){
			$arr['select'] = '*';
		}else{
			$arr['select'] = $this->_sql['select'];
		}
		if( trim($this->_sql['where'])!='' ){
			$arr['where'] = 'WHERE '.$this->_sql['where'];
		}else{
			$arr['where'] = '';
		}
		if( trim($this->_sql['order'])!='' ){
			$arr['order'] = 'ORDER BY '.$this->_sql['order'];
		}else{
			$arr['order'] = '';
		}
		if( trim($this->_sql['limit'])!='' ){
			$arr['limit'] = 'LIMIT '.$this->_sql['limit'];
		}else{
			$arr['limit'] = '';
		}
		if( trim($this->_sql['group'])!='' ){
			$arr['group'] = 'GROUP BY '.$this->_sql['group'];
		}else{
			$arr['group'] = '';
		}
		if( trim($this->_sql['join']['table'])!='' ){
			$arr['join_table'] = $this->_sql['join']['table'];
			$arr['join_where'] = $this->_sql['join']['where'];
		}else{
			$arr['join_table'] = '';
			$arr['join_where'] = '';
		}
		
		return $arr;
	}
	
	//输出错误信息
	private function err($msg)
	{
		echo __CLASS__.'错误: '.$msg;
		exit;
	}
	
	//当前表中是否存在指定字段名
	private function inFields($field)
	{
		if(trim($field)==''){ return false; }
		foreach($this->table_info['fields'] as $value){
			if($field==$value){ return true; }
		}
	}
	
}
?>