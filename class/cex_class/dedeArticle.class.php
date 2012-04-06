<?php
//=========================
//	 dede记录操作
//=========================

class dedeArticle
{
	private $dedecms; //dedecms操作类
	private $db; //dedecms数据库类对象
	private $mydb; //mysql操作类
	private $prefix; //数据据表名前缀
	private $channel = array(); //频道
	
	
	//初始化
	function __construct($dedecms)
	{
		$this->dedecms = $dedecms;
		$this->db = $this->dedecms->getDbInfo();
		$this->mydb = mydb::make($dedecms->getDbLink());
		$this->prefix = $dedecms->getDbprefix();
	}
	
	
	//取得频道记录
	public function getChannel($cid=0)
	{
		$cid = (int)$cid;
		if(!count($this->channel)){
			//读数据表中的记录
			$this->db->Execute('me',"Select * From `#@__channeltype`");
			$rs = array();
			while($row = $this->db->GetArray()){
				$rs[$row['id']] = $row;
			}
			//写入缓存
			$this->channel = $rs;
		}
		return @$this->channel[$cid]; //读出数据
	}
	
	
	//取得dedecms的主表记录
	public function getArchives($aid=0)
	{
		$aid = (int)$aid;
		if($aid){
			return $this->db->GetOne("select * From `#@__archives` where id=$aid");
		}else{
			return array();
		}
	}
	
	
	//取得附加表记录
	//参数: $addontable 附加表全名 , $aid 记录ID
	public function getAddon($addontable='',$aid=0)
	{
		if($addontable!='' && $aid){
			return $this->db->GetOne("select * From `$addontable` where aid=$aid");
		}else{
			return array();
		}
	}
	
	
	//读取记录
	public function getArticle($aid=0)
	{
		$article = array();
		$archives = $this->getArchives($aid); //取得主表记录
		if(count($archives)!=0){
			$channel = $this->getChannel($archives['channel']);
			$addontable = @trim($channel['addtable']);
			if($addontable!=''){
				$addon = $this->getAddon($addontable,$aid); //取得附加表记录
				if(count($addon)){
					$article = array_merge($archives,$addon);
				}
			}
		}
		return $article;
	}

	
	
	//删除记录
	public function delArticle($aid=0)
	{
		$aid = (int)$aid;
		$prefix = $this->prefix;
		if($aid){
			//取得索引表记录
			$tiny = $this->db->GetOne("select * From `#@__arctiny` where id=$aid");
			$channel = $this->getChannel($tiny['channel']);
			$addontable = @trim($channel['addtable']);
			if($addontable!=''){
				$this->mydb->run("delete from $prefix_arctiny as t1,$prefix_archives as t2,$addontable as t3 where t1.id=$aid and t2.id=$aid and t3.aid=$aid");
			}
		}
	}
	
	
	//添加记录
	public function addArticle($aid=0,$channel_id=0)
	{
		
		
		
	}	
	
	//修改记录
	public function updateArticle($aid)
	{
		
		
		
	}
	





}
?>