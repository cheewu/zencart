<?php
/*//=================================
//
//	 Access数据库操作类 access [更新时间: 2010-7-7]
//
//===================================*/
/*
使用说明:
1.定义对象:
	方法1:
	$db = new access('db.mdb','','密码');
	或
	$db = new access();
	$db->open('db.mdb','','密码');
	方法2:
	$db = access::make('db.mdb','','密码');

3.表操作:
	$db->table('表名'); 打开表
	$table = $db->table('表名'); //打开表并得到一份clone对象
	$db->getTables(); //取得数据库中所有用户表
	$db->getFields(); //取得数据表中将所有字段名['Field']及其类型['Type']遍历到数组中,返回一个二维数组

3.记录操作
	参数设置：
	top(数值) 查询记录时
	fields('字段列表') 查询需要取得的字段
	where('条件') 设置条件
	order('字段名 ASC|DESC') 设置排序
	group('字段列表') 记录分组
	
	操作:
	$rs = $db->[各项参数设置...]->select(); //查询记录
	$rs = $db->getAllRs(); //取得表中所有记录
	$db->[各项参数设置...]->update(); //更新记录
	$db->[各项参数设置...]->insert(); //插入记录
	$db->[各项参数设置...]->delete(); //删除记录
	$num = $db->[各项参数设置...]->count(); //统计记录数
	$num = $db->countAll(); //统计表中所有记录数
*/

class access
{
	private $com; //数据库com对象
  	private $db; //数据库连接
	private $path; //数据库文件路径
	private $table; //当前的数据表
	private $isTable=false; //当前是否已经设置了数据表
	private $fields; //当前数据表中的字段列表
	
	//执行信息
	private $lastsql=array(); //最后执行的sql句
	//private $n; //执行sql语句影响到的记录数	
	private $sql = array(); //sql语句关键字段数组
		
	//初始化
	function __construct($path=NULL,$user='',$password=''){
		if(isset($path)){ $this->open($path,$user,$password); }
		$this->init_sql();
	}
	//析构函数
	function __destruct()
	{
		$this->close(); //关闭数据库文件
	}
	
	//初始化sql条件数组
	function init_sql()
	{
		$this->sql = array(
			'select'=>'*',
			'where'=>'',
			'order'=>'',
			'group'=>'',
			'top'=>'',
			'join'=> array('table'=>'','where'=>'')
		);
	}
	
//数据库操作: ============================
	
	//静态方法,创建对象本身，返回一个本类的对象
	public static function make($path=NULL,$user='',$password='')
	{
		return new mdb($path);
	}
	
	//打开数据库
	public function open($path,$user='',$password='')
	{
		$path = realpath($path); //取得绝对路径
		if(trim($path)=='' || !is_file($path)){	$this->err(" 方法: ".__FUNCTION__.", 找不到数据库文件'$path'。"); }
		try{
			//$this->com = new COM('ADODB.Connection');
			//$this->com->Open("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$path,$user,$password);
			$this->db = odbc_connect("DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$path,$user,$password,SQL_CUR_USE_ODBC);
			$this->path = $path;
			return true;
		}catch(Exception $e){
			$e = mb_convert_encoding($e,'UTF-8','ASCII,UTF-8,GBK,ISO-8859-1');
			$this->err(" 方法: ".__FUNCTION__.", 数据库连接错误: $e 。");
		}
	}
	
	//关闭数据库链接
	public function close()
	{
		try{
			if($this->com){ @$this->com->close();}
			if($this->db){ @odbc_close($this->db); }
		}catch(Exception $e){
			;
		}
	}
	
	//返回数据库连接
	public function getConn()
	{
		return $this->db;
	}
	
	//返回com对象
	public function getCom()
	{
		return $this->com;
	}
	
	//取得数据库中所有用户表
	public function getTables()
	{
		$query = odbc_tables($this->db);
		$rs = array();
		while($row = odbc_fetch_array($query)){
			if(trim($row['TABLE_TYPE'])=='TABLE'){
				$rs[] = $row;
			}
		}
		return $rs;
	}
	
	//sql查询(用于查询)
	public function query($sql)
	{
		$this->lastsql[] = $sql; //记录最后一条sql
		$this->init_sql(); //清除sql条件
		try{
			$query = odbc_exec($this->db, $sql);
			$n = 0;
			$rs = array();
			while($row = odbc_fetch_array($query)){
				$rs[] = $row;
				$n++;
			}
			$this->n = $n;
			return $rs;
		}catch(Exception $e){
			$e = mb_convert_encoding($e,'UTF-8','ASCII,UTF-8,GBK,ISO-8859-1');
            $this->err("方法: query(), 执行错误: $e ");
        }
	}
	
	//内部执行sql语句(用于非查询)
	private function run($sql)
	{
		$this->lastsql[] = $sql; //记录最后一条sql
		$this->init_sql(); //清除sql条件
		try{
			$query = odbc_exec($this->db, $sql);
			return $query;
		}catch(Exception $e){
			$e = mb_convert_encoding($e,'UTF-8','ASCII,UTF-8,GBK,ISO-8859-1');
            $this->err("方法: run(), 执行错误: $e ");
        }
	}
	
	//输出执行信息,返回一个信息数组
	public function debug()
	{
		$arr = array_reverse($this->lastsql,true);
		$text = '';
		foreach($arr as $key=>$sql){
			$text.="sql[$key]: $sql <br />";
		}
		return $text;
	}

//数据表操作: ========================
	public function table($table)
	{
		$table = trim($table);
		$tables = $this->getTables();
		foreach($tables as $t){
			if(trim($t['TABLE_NAME'])==$table){
				$this->table = $table;
				$fields = $this->getFields();
				if(count($fields)){
					$this->isTable = true;
					$this->fields = $fields;
					return clone $this;
				}
			}
		}
		$this->err("方法: table(), 数据表 $table 不存在！");
	}
	
	//取得数据表中将所有字段名['Field']及其类型['Type']遍历到数组中,返回一个二维数组
	public function getFields()
	{
		$query = $this->run('SELECT TOP 1 * FROM '.$this->table);
		$num = odbc_num_fields($query);
		if($num){
			for ($j=1;$j<=$num;$j++){
				$fields['Field'][] = odbc_field_name($query,$j);
				$fields['Type'][] = odbc_field_type($query,$j);
			}
			return $fields;
		}else{
			return array();
		}
	}

//数据记录操作: =======================
	
	//添加记录,返回成功添加的记录条数
	public function insert($arr)
	{
		$this->beingTable(__FUNCTION__);
		if(!count($arr)){ return 0; } //如果是空记录数组，则直接就返回0
		
		$arr = $this->codingFieldValue($arr);
		$fieldlist = $valuelist = '';
		foreach($arr as $key=>$value){
			$fieldlist.= "$key,";
			$valuelist.= "$value,";
		}
		$fieldlist = substr($fieldlist,0,strlen($fieldlist)-1);
		$valuelist = substr($valuelist,0,strlen($valuelist)-1);
		$strsql="INSERT INTO $this->table($fieldlist) VALUES($valuelist)";
		$rs = $this->run($strsql);
		//return $rs;
	}
	
	//更新一组记录字段
	public function update($arr)
	{
		$this->beingTable(__FUNCTION__);
		if(!count($arr)){ return 0; } //如果是空记录数组，则直接就返回0
		$arr = $this->codingFieldValue($arr);
		$setfield = '';
		foreach($arr as $key=>$value){
			$setfield.= "$key = $value,";
		}
		$setfield = substr($setfield,0,strlen($setfield)-1);
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql="UPDATE $this->table SET $setfield ".$arr['where'];
		$rs = $this->run($strsql);
		return $rs;
	}
	
	//删除记录,返回删除的记录数
	public function delete()
	{
		$this->beingTable(__FUNCTION__);
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql="DELETE FROM $this->table ".$arr['where'];
		$rs = $this->run($strsql);
		return $rs;
	}
	
	//查询记录
	public function select()
	{
		$this->beingTable(__FUNCTION__);
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql='SELECT '.$arr['top'].' '.$arr['select']." FROM $this->table ".$arr['where'].' '.$arr['group'].' '.$arr['order'];
		$rs = $this->query($strsql);
		return $rs;
	}
	
	//查询所有记录
	public function getAllRs()
	{
		$this->beingTable(__FUNCTION__);
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql='SELECT '.$arr['select']." FROM $this->table ".$arr['group'].' '.$arr['order'];
		$rs = $this->query($strsql);
		return $rs;
	}
	
	//统计记录数
	public function count()
	{
		$this->beingTable(__FUNCTION__);
		$key = trim($this->fields['Field'][0])!=''?trim($this->fields['Field'][0]):'*';
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql='SELECT '.$arr['top']." count($key) AS num FROM $this->table ".$arr['where'].' '.$arr['group'];
		$rs = $this->query($strsql);
		return $rs[0]['num'];
	}
	
	// 统计数据表中的所有记录数	
	public function countAll()
	{
		$this->beingTable(__FUNCTION__);
		$key = trim($this->fields['Field'][0])!=''?trim($this->fields['Field'][0]):'*';
		$arr = $this->getSql(); //取得sql语句关键字段
		$strsql="SELECT count($key) AS num FROM $this->table";
		$rs = $this->query($strsql);
		return $rs[0]['num'];
	}

//sql语句分段方法:========================
	public function fields($str='*')
	{
		if(trim($select)==''){
			$this->sql['select'] = '*';
		}else{
			$this->sql['select'] = $select;
		}
		return $this;
	}
	public function where($where)
	{
		$this->sql['where'] = $where;
		return $this;
	}
	public function order($order)
	{
		$this->sql['order'] = $order;
		return $this;
	}
	public function top($top)
	{
		$this->sql['top'] = $top;
		return $this;
	}
	/*
	public function limit($limit)
	{
		$this->sql['limit'] = $limit;
		return $this;
	}*/
	public function group($group)
	{
		$this->sql['group'] = $group;
		return $this;
	}
	public function join($table,$where) //联合查询
	{
		$this->sql['join']['table'] = $table;
		$this->sql['join']['where'] = $where;
		return $this;
	}

//内部方法: ==========================
	
	//当前是否设置了数据表
	private function beingTable($function)
	{
		if(!$this->isTable){ $this->err("方法: $function(), 当前还没有设定要操作的数据表！必须先用table()方法设定。");}
	}
	
	//输出错误信息
	private function err($msg)
	{
		echo __CLASS__.'错误: '.$msg;
		exit;
	}
	
	//对字段的值进行编码(将 字符型,日期型的值加上''单引号), 便于对记录的字段值进行操作
	private function codingFieldValue($arr)
	{
		$fieldValue = array();
		foreach($arr as $key1=>$value){
			foreach($this->fields['Field'] as $key2=>$f){
				$type = trim($this->fields['Type'][$key2]);
				if(trim($f)==trim($key1) && trim($key1)!==''){
					if($type == 'VARCHAR' || $type == 'DATETIME' || $type == 'LONGCHAR'){
						$fieldValue[$key1] = "'$value'";
					}else{
						$fieldValue[$key1] = $value;
					}
				}
			}
		}
		return $fieldValue;
	}
	
	//取得sql关键字数组(可以直接应用的)
	private function getSql()
	{
		if( trim($this->sql['select'])=='' ){
			$arr['select'] = '*';
		}else{
			$arr['select'] = $this->sql['select'];
		}
		if( trim($this->sql['where'])!='' ){
			$arr['where'] = 'WHERE '.$this->sql['where'];
		}else{
			$arr['where'] = '';
		}
		if( trim($this->sql['order'])!='' ){
			$arr['order'] = 'ORDER BY '.$this->sql['order'];
		}else{
			$arr['order'] = '';
		}
		if(trim($this->sql['top'])!=''){
			$arr['top'] = 'TOP '.$this->sql['top'];
		}else{
			$arr['top'] = '';
		}
		/*
		if( trim($this->sql['limit'])!='' ){
			$arr['limit'] = 'LIMIT '.$this->sql['limit'];
		}else{
			$arr['limit'] = '';
		}*/
		if( trim($this->sql['group'])!='' ){
			$arr['group'] = 'GROUP BY '.$this->sql['group'];
		}else{
			$arr['group'] = '';
		}
		if( trim($this->sql['join']['table'])!='' ){
			$arr['join_table'] = $this->sql['join']['table'];
			$arr['join_where'] = $this->sql['join']['where'];
		}else{
			$arr['join_table'] = '';
			$arr['join_where'] = '';
		}
		
		return $arr;
	}
}
?> 