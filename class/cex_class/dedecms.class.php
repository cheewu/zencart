<?php
/*//=================================
//
//	dedecms5.6操作类 [更新时间: 2010-8-31]
//
//===================================*/

/*
//定义对象:
$dede = new dedecms();

//方法:
//取得dedecms的数据库连接对象
$dede->getdb()

//取得dedecms的数据表前缀
$dede->getDbprefix()

//取得当前登录的会员ID
$dede->getUid()
	
//取得指定的会员信息
$dede->getUser($uid)

//添加文章记录,参数: $arr 各字段的值, $addtable 附加表名(不带表前缀)
$dede->addArticle($arr_r,$addtable='addonarticle')
	
//编辑文章, $aid 文章id , $arr 记录值数组 , $table 附加表(不包含表前缀)
$dede->editArticle($aid,$arr,$table='addonarticle')

//删除文章,  $aid 文章id , $addtable 附加表。
$dede->delArticle($aid=0,$addtable='addonarticle')

//读取文章记录, $addtable 附加表。
$dede->getArticle($aid=0,$addtable='addonarticle')

//取得联动类别数组
$dede->getEnums($name)

//根据值取得联动类别名
$dede->getEnum($name,$value)

//dedecms的信息显示框，带跳转。参数： message 为信息， url 为跳转url
$dede->msgbox($message,$url)

*/

class dedecms
{
	private $path; //dedecms所在路径
	
	private $dblink; //数据库连接
	private $db; //dedecms数据库类对象
	
	private $user; //当前登录的会员信息
	private $type = array(); //所有栏目信息
	
	private $article; //dedeArticle类,记录操作类
	
	
	//构造化函数
	function __construct()
	{
		if(trim($GLOBALS['cfg_soft_enname'])=='' || trim($GLOBALS['cfg_version'])==''){
			$this->err('dedecms操作类: 请先引入文件: require_once "Dedecms的所在路径/include/common.inc.php";');
		}else{
			if(isset($GLOBALS['dsql'])){
				$this->db = $GLOBALS['dsql'];
				$this->dblink = $this->db->linkID;
			}
			$this->path = DEDEROOT; //dedecms所在路径
		}
	}

	//析构函数
	function __destruct()
	{	}

//=========================
//	数据库
//=========================

	//取得dedecms的数据库信息
	public function getDbInfo()
	{
		return $this->db;
	}
	
	//取得dedecms的数据库连接对象
	public function getDbLink()
	{
		return $this->dblink;
	}
	
	//取得dedecms的数据表前缀
	public function getDbprefix()
	{
		return $GLOBALS['cfg_dbprefix'];
	}
	
	
//=========================
//	会  员
//=========================
	
	//是否载入了dedecms的会员操作类文件
	private function isbeing_user()
	{
		if(!class_exists('MemberLogin')){
			$this->err('dedecms操作类: 请先引入文件: require_once "Dedecms的所在路径/include/memberlogin.class.php";');
		}else{
			if(!isset($this->user)){
				$this->user = new MemberLogin(); //取得dedemcms的当前会员类
			}
		}
	}
	
	//取得当前登录的会员ID
	public function getUserId()
	{
		$this->isbeing_user(); //检测是否已经载入了会员操作类文件
		return $this->user->M_ID;
	}
	
	//取得指定会员的记录信息，如果没有指定会员ID则返回当前登录的会员信息
	public function getUser($uid=0)
	{
		$this->isbeing_user(); //检测是否已经载入了会员操作类文件
		$uid = (int)$uid;
		if( !$uid || $uid == $this->getUserId() ){
		//当前登录的会员信息
			return $this->user->fields;
		}else{
		//指定ID的会员信息
			return 	$this->db->GetOne("Select * From `#@__member` where mid = '$uid'");
		}
	}
	
//=========================
//	 栏目操作
//=========================

	//取得指定栏目的信息
	public function getType($tid=0)
	{
		if(!(int)$tid){ return array(); }
		return $this->db->GetOne("Select * From `#@__arctype` where id = $tid");
	}
	
	//取得所有栏目信息
	public function getAllType()
	{
		if(count($this->type)){ return $this->type; }
		$this->db->Execute('me',"Select * From `#@__arctype` order by sortrank,id");
		while($arr = $this->db->GetArray()){
			$rs[] = $arr;
		}
		$this->type = $rs;
		return $rs;
	}
	
	
	//取得所有顶级分类信息
	public function getTopType()
	{
		$this->db->Execute('me',"Select id,REPLACE(typedir,'{cmspath}','$GLOBALS[cfg_cmsurl]') as typedir,typename,ispart,sortrank,ishidden From `#@__arctype` where reid=0 and ishidden=0 order by sortrank,id");
		while($row = $this->db->GetArray()){
			$rs[] = $row;
		}
		return $rs;
	}
	
	//或取指定栏目的下级子栏目,返回数组
	public function getChildrenType($id)
	{
		$id = (int)$id;
		if(!$id){ return array(); }
		$this->db->Execute('me',"Select id,REPLACE(typedir,'{cmspath}','$GLOBALS[cfg_cmsurl]') as typedir,typename,ispart,sortrank,ishidden From `#@__arctype` where reid=$id and ishidden=0 order by sortrank,id");
		while($row = $this->db->GetArray()){
			$rs[] = $row;
		}
		return $rs;
	}
	
	//取得父分类信息
	public function getParentType($id)
	{
		$id = (int)$id;
		if(!$id){ return array(); }
		//取得当前记录
		$r = array();
		$r = $this->db->GetOne("select reid From `#@__arctype` where id=$id");
		$pid = @(int)$r['reid'];
		if(!$pid){ return array(); }
		//取得父目录记录
		$r = array();
		$r = $this->db->GetOne("select id,REPLACE(typedir,'{cmspath}','$GLOBALS[cfg_cmsurl]') as typedir,typename,ispart,sortrank,ishidden From `#@__arctype` where id=$pid and ishidden=0");
		return $r;
	}


//=========================
//	文章记录操作
//=========================		
	//添加文章记录
	//参数: $arr 各字段的值, $addtable 附加表名(不带表前缀)
	/*
	 //必选项:
	 title = ''; //标题
	 body = ''; //内容正文
	 typeid = 0; //主栏目ID
	 channel = 0; //所属模型ID
	 mid = 0; //发布会员id
	 
	 //可选项:
	 senddate = time(); //发布时间
	 ismake = -1; //是否审核(动态浏览)
	 writer = ''; //作者
	 source = ''; //文章来源
	 litpic = ''; //缩略图
	 pubdate = time(); //发布时间
	 description = ''; //摘要
	 userip = vcount::getIp(); //发布者的IP地址
	*/
	public function addArticle($arr_r,$addtable='addonarticle')
	{
		if(!$this->issetpath || $addtable==''){ return NULL; }
		//取得下一条记录的id
		$aid = $this->db->table($GLOBALS['cfg_dbprefix'].'arctiny')->getAutoid();
		if($aid){
			//处理字段值
			$arr_r['typeid'] = isset($arr_r['typeid'])?$arr_r['typeid']:0;
			$arr_r['channel'] = isset($arr_r['channel'])?$arr_r['channel']:1;
			$arr_r['mid'] = isset($arr_r['mid'])?$arr_r['mid']:1;
			$arr_r['senddate'] = isset($arr_r['senddate'])?$arr_r['senddate']:time();
			$arr_r['ismake'] = isset($arr_r['ismake'])?$arr_r['ismake']:-1;
			$arr_r['title'] = isset($arr_r['title'])?$arr_r['title']:'';
			$arr_r['writer'] = isset($arr_r['writer'])?$arr_r['writer']:'';
			$arr_r['source'] = isset($arr_r['source'])?$arr_r['source']:'';
			$arr_r['litpic'] = isset($arr_r['litpic'])?$arr_r['litpic']:'';
			$arr_r['pubdate'] = isset($arr_r['pubdate'])?$arr_r['pubdate']:time();
			$arr_r['description'] = isset($arr_r['description'])?$arr_r['description']:'';
			$arr_r['body'] = isset($arr_r['body'])?$arr_r['body']:'';
			$arr[0] = $arr_r;
			$arr[0]['id'] = $aid;
			$arr[0]['aid'] = $aid;
			$arr[0]['userip'] = vcount::getIp();
			//php::pend($arr);
			$this->db->start_transaction(); //开启一个事务
			//添加索引表
			if($this->db->table($GLOBALS['cfg_dbprefix'].'arctiny')->add($arr)){
				//添加主表
				if($this->db->table($GLOBALS['cfg_dbprefix'].'archives')->add($arr)){
					//添加附加表
					if($this->db->table($GLOBALS['cfg_dbprefix'].$addtable)->add($arr)){
						$this->db->commit(); //提交一个事务
						return $aid;
					}
				}
			}
			$this->db->rollback(); //回滚一个事务
		}
	}
	
	//编辑文章, $aid 文章id , $arr 记录值数组 , $table 附加表(不包含表前缀)
	public function editArticle($aid,$arr,$table='addonarticle')
	{
		if((int)$aid==0 || !isset($arr)){ return NULL; }
		//更新主表
		$this->db->table($GLOBALS['cfg_dbprefix'].'archives')->where("id = $aid")->update($arr);
		//更新附加表
		$this->db->table($GLOBALS['cfg_dbprefix'].$table)->where("aid = $aid")->update($arr);
	}
	
	//删除文章,  $aid 文章id , $addtable 附加表。
	public function delArticle($aid=0,$addtable='addonarticle')
	{
		if((int)$aid){
			$this->db->start_transaction(); //开启一个事务
			//删除索引表记录
			if($this->db->table($GLOBALS['cfg_dbprefix'].'arctiny')->where("id = $aid")->del()){
				//删除主表记录
				if($this->db->table($GLOBALS['cfg_dbprefix'].'archives')->where("id = $aid")->del()){
					//删除附加表记录
					if($this->db->table($GLOBALS['cfg_dbprefix'].$addtable)->where("aid = $aid")->del()){
						$this->db->commit(); //提交一个事务
						return true;
					}
				}
			}
			$this->db->rollback(); //回滚一个事务
		}
		return false; //记录不存在 或 删除出错
	}
	
	//读取文章记录, $addtable 附加表。
	public function getArticle($aid=0,$addtable='addonarticle')
	{
		if((int)$aid){
			$join = $GLOBALS['cfg_dbprefix'].$addtable.','.$GLOBALS['cfg_dbprefix'].'archives';
			$join_where = $GLOBALS['cfg_dbprefix'].$addtable.".aid = $aid AND ".$GLOBALS['cfg_dbprefix']."archives.id = $aid";
			$r = $this->db->table($GLOBALS['cfg_dbprefix'].'arctiny')->where($GLOBALS['cfg_dbprefix'].'arctiny'.".id = $aid")->join($join,$join_where)->find();
		}
		return $r;
	}
	
//=========================
//	联动类别
//=========================
	
	//取得联动类别数组
	public function getEnums($name)
	{
		if(!isset($name) || trim($name)==''){ return NULL; }
		//联动类别数组所在的文件路径
		$path = $this->path.'/data/enums/$name.php';
		if(file_exists($path)){
			include($path); //载入联动类别数组文件
			$arr = 'em_'.$name.'s';
			if(isset($$arr)){
				return $$arr;
			}
		}
		return NULL;
	}
	
	//根据值取得联动类别名
	public function getEnum($name,$value)
	{
		$arr = $this->getEnums($name);
		if(isset($arr)){
			return $arr[$value];
		}
		return NULL;
	}


//=========================
//	记录[自定义属性]管理
//=========================
	private $arcatt = array(); //记录[自定义属性]缓存数组
	
	//读取属性, 参数: $refurbish 是否刷新缓存
	public function getArcatt($refurbish=false)
	{
		//刷新操作 或者 缓存数组中为空
		if($refurbish || count($this->arcatt)==0){
			$this->db->Execute('me',"Select * From `#@__arcatt` order by sortid");
			$rs = array();
			while($arr = $this->db->GetArray()){
				$rs[$arr['sortid']] = $arr;
			}
			//写入缓存
			$this->arcatt = $rs;
		}
		return $this->arcatt;
	}
	
	//添加属性, 参数数组 ['att'] 属性字母 ['attname'] 属性名称
	public function addArcatt($data=array())
	{
		$att = $this->getArcatt(); //取得属性集
		$data['sortid'] = count($att)+1; //属性id
		$sql = "insert into `#@__arcatt`(sortid,att,attname) values($data[sortid],'$data[att]','$data[attname]')";
		$this->db->ExecuteNoneQuery($sql);
		$this->updateArcattField(); //刷新缓存
	}
	
	//修改属性
	public function updateArcatt($sortid=0,$data=array())
	{
		$sortid = (int)$sortid;
		$att = $this->getArcatt(); //取得属性集
		if($sortid && isset($att[$sortid]) && count($att[$sortid])){
			$sql = "update `#@__arcatt` set att='$data[att]', attname='$data[attname]' where sortid=$sortid";
			$this->db->ExecuteNoneQuery($sql);
			$this->updateArcattField(); //刷新缓存
		}
	}
	
	//删除属性
	public function delArcatt($sortid=0)
	{
		$sortid = (int)$sortid;
		if($sortid){
			$sql = "delete from `#@__arcatt` where sortid=$sortid";
			$this->db->ExecuteNoneQuery($sql);
			$this->updateArcattField(); //刷新缓存
		}
	}
	
	//[内容方法] 更新记录中的属性字段'flag' , 并更新缓存
	private function updateArcattField()
	{
		$att = $this->getArcatt(true); //刷新缓存	
		$flag = '';
		foreach($att as $a){
			$flag .= ",'$a[att]'";
		}
		$flag = substr($flag,1,strlen($flag));
		//echo $flag;
		$this->db->ExecuteNoneQuery("alter table `#@__archives` modify `flag` set ($flag) default NULL");
	}
	
//=========================
//	其它
//=========================

	//该函数为显示跳转信息： message 为信息， url 为跳转url
	public function msgbox($message,$url)
	{
		ShowMsg($message,$url);
	}
	
	private function err($message, $is_stop=true)
	{
		print_r($message);exit;
	}
}

?>