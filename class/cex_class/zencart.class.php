<?php
/*//=================================
//
//	zen_cart1.39操作类 [更新时间: 2010-11-9]
//
//===================================*/

class zencart
{
	private $path; //zencart所在路径
	
	private $dblink; //数据库连接
	private $db; //zencart数据库类对象
	private $mydb; //mydb操作类
	private $db_prefix;  //表前缀
	
	private $language; //语言id
	private $template_url; //模板目录的URL路径
	private $template_dir; //模板目录的绝对路径
	
	//构造化函数
	function __construct()
	{
		if(!defined('DIR_WS_INCLUDES')){
			$this->err('zencart操作类: 请先引入文件: <br />
			前台: require_once "zencart的所在路径/include/application_top.php"; <br />
			后台管理： require_once "zencart的所在路径/后台管理目录/include/application_top.php";');
		}else{
			global $db;
			if(isset($db) && isset($db->database)){
				$this->db = $db; //zencart的数据库操作类
				$this->dblink = $db->link; //数据库连接
				$this->db_prefix = DB_PREFIX; //表前缀
				$this->language = @(int)$_SESSION['languages_id']; //语言id
				
				//配置mydb操作类
				$this->mydb = new mydb($db->link);
				$this->mydb->databases($db->database);
				
				$this->template_url =  DIR_WS_CATALOG.DIR_WS_TEMPLATE ; //模板目录的URL路径
				$this->template_dir =  DIR_FS_CATALOG.DIR_WS_TEMPLATE ; //模板目录的绝对路径
			}
		}
	}

	//析构函数
	function __destruct()
	{	}
	
// ==============
//    用户管理
//===============
	//取得当前登录的会员ID
	public function getUserId()
	{
		return isset($_SESSION['customer_id'])?(int)$_SESSION['customer_id']:0;
	}
	
	//取得指定会员的记录信息，如果没有指定会员ID则返回当前登录的会员信息
	public function getUser($uid=0)
	{
		$uid = (int)$uid;
		$user = array();
		if(0==$uid || (int)@$_SESSION['customer_id'] == $uid){
			$user['customers_ip_address'] = @$_SESSION['customers_ip_address'];
			$user['customer_id'] = (int)@$_SESSION['customer_id'];
			$user['customer_default_address_id'] = @$_SESSION['customer_default_address_id'];
			$user['customers_authorization'] = @$_SESSION['customers_authorization'];
			$user['customer_first_name'] = @$_SESSION['customer_first_name'];
			$user['customer_last_name'] = @$_SESSION['customer_last_name'];
			$user['customer_country_id'] = @$_SESSION['customer_country_id'];
			$user['customer_zone_id'] = @$_SESSION['customer_zone_id'];
		}else{
			$user = $this->mydb->table($this->db_prefix.'customers')->where("customers_id=$uid")->select();
			if(count($user)){
				$user = $user[0];
			}
		}
		return $user;
	}

//===============
//  商品分类管理
//===============
	private $categories = array(); //缓存商品分类
	
	//取得全部商品分类,  参数: $refurbish 是否刷新缓存
	public function getCategories($refurbish=false)
	{
		if($refurbish || count($this->categories)==0){
			$categories = $this->mydb->query('SELECT * FROM '.$this->db_prefix.'categories AS c1, '.$this->db_prefix.'categories_description AS c2 WHERE c2.language_id = '.$this->language.' AND c1.categories_id = c2.categories_id ORDER BY c1.parent_id, c1.categories_id');
			foreach($categories as $cat){
				$this->categories[$cat['categories_id']] = $cat;
			}
		}
		return $this->categories;
	}
	
	//取得指定的分类信息
	public function getCat($id=0)
	{
		$categories = $this->getCategories();
		$cat = array();
		if( isset($categories[$id]) ){
			$cat = $categories[$id];
		}
		return $cat;
	}
	
	//根据指定的父分类ID,取得它的下级子分类信息
	public function getCatsByParent($pid=0)
	{
		$pid = (int)$pid;
		$categories = $this->getCategories();
		$cats = array();
		foreach($categories as $cat){
			if($cat['parent_id']==$pid){
				$cats[] = $cat;
			}
		}
		return $cats;
	}
	
	//遍历出指定分类的所有终极子分类
	public function getChildrenCats($cid=0)
	{
		$cid = (int)$cid;
		$children = self::getCatsByParent($cid);
		foreach($children as $c){
			$_children = self::getChildrenCats($c['categories_id']);
			foreach($_children as $_c){
				$children[] = $_c;
			}
		}
		return $children;
	}
	
//===============
//    商品管理
//===============
	
	//取得一指定分类下的所有商品的ID与分类ID对应关系数组
	public function getProductsByCat($cid=0)
	{
		$cid = (int)$cid;
		$categories = $this->getChildrenCats($cid);
		if(count($categories)==0){ return array(); }
		$childrenlist = "$cid";
		foreach($categories as $cat){
			$childrenlist = str::odblist($childrenlist,',',$cat['categories_id'],'add');
		}
		$sql = 'select * from '.$this->db_prefix."products_to_categories where categories_id in ($childrenlist) order by products_id desc";
		return $this->mydb->query($sql);
	}
	
	
	//取得单个或一组商品的信息
	//参数: 取得单个商品信息: 商品的ID值, 取得多个商品信息: 商品ID数组
	public function getProductInfo($ids=0)
	{
		if(is_array($ids) && count($ids)){
			$idlist = '';
			foreach($ids as $id){
				$idlist = str::odblist($idlist,',',$id,'add');
			}
		}elseif( $ids = (int)$ids ){
			$idlist = $ids;
		}else{
			return array();
		}
		$sql = "select * from ".$this->db_prefix."products as p1,".$this->db_prefix."products_description as p2 where p1.products_id in ($idlist) and p2.language_id = ".$this->language." and p1.products_id = p2.products_id order by p1.products_id desc";
		return $this->mydb->query($sql);
	}
	
	
//===============
// 购物车&订单管理
//===============	
	
	
	
	
	
//===============
//    地区管理
//===============
	private $country = array(); //缓存国家
	private $zone = array(); //缓存地区
	
	//取得所有国家, 参数: $refurbish 是否刷新缓存
	public function getCountries($refurbish=false)
	{
		if($refurbish || count($this->country)==0){
			$country = $this->mydb->query('SELECT * FROM countries');
			foreach($country as $c){
				$this->country[$c['countries_id']] = $c;
			}
		}
		return $this->country;
	}
	
	//取得指定的国家信息
	public function getCountry($id=0)
	{
		$id = (int)$id;
		$countries = $this->getCountries();
		$country = array();
		if( isset($countries[$id]) ){
			$country = $countries[$id];
		}
		return $country;
	}
	
	//取得所有地区,  参数: $refurbish 是否刷新缓存
	public function getZones($refurbish=false)
	{
		if($refurbish || count($this->zone)==0){
			$zones = $this->mydb->query('SELECT * FROM zones');
			foreach($zones as $z){
				$this->zone[$z['zone_id']] = $z;
			}
		}
		return $this->zone;
	}

	//取得指定的地区
	public function getZone($id=0)
	{
		$id = (int)$id;
		$zones = $this->getZones();
		$zone = array();
		if( isset($zones[$id]) ){
			$zone = $zones[$id];
		}
		return $zone;
	}
	
	//根据指定国家id报得所属城市记录集
	public function getZonesByCountry($cid=0)
	{
		$cid = (int)$cid;
		$zones = $this->getZones();
		$zs = array();
		foreach($zones as $zone){
			if($zone['zone_country_id']==$cid){
				$zs[] = $zone;
			}
		}
		return $zs;
	}

//===============
//     模板
//===============
	
	
	//载入模板包中的js文件
	//参数: js文件名数组
	public function loadTplJs($filename_array)
	{
		global $template;
		$html = '';
		if(is_array($filename_array) && count($filename_array)){
			foreach($filename_array as $fname){
				$html.='<script language="javascript" src="'.$this->template_url.'jscript/'.$fname.'"></script>';
			}
		}
		echo $html;
	}
	
	//载入模板包中的css文件
	//参数: css文件名数组
	public function loadTplCss($filename_array)
	{
		$html = '';
		if(is_array($filename_array) && count($filename_array)){
			foreach($filename_array as $fname){
				$html.='<link rel="stylesheet" type="text/css" href="'.$this->template_url.'css/'.$fname.'"/>';
			}
		}
		echo $html;
	}
	
	//模板包中的图片路径
	public function urlTplImg($filename)
	{
		return $this->template_url.'images/'.$filename;
	}
	
	//生成链接的url
	//参数: $main_page 模块名, $parameters url中的参数
	public function urlLink($main_page='index',$parameters='?',$connection = 'NONSSL')
	{
		return zen_href_link($main_page, $parameters, $connection);
	}
	
//===============
//     其它
//===============
	
	//取得常用的系统变量
	public function getSysval()
	{
		global $current_page_base,$cPath_array,$current_category_id;
		
		//取得url中 $_GET['main_page'] 的值		
		$sysval['main_page'] = $current_page_base;
		//当前商品ID
		$sysval['products_id'] = $_GET['products_id'];
		//当前商品分类的ID树数组
		$sysval['category_tree'] = isset($cPath_array)?$cPath_array:array();
		//当前的商品分类ID
		$sysval['category_id'] = (isset($cPath_array) && count($cPath_array))?$cPath_array[count($cPath_array)-1]:0;
		
		$sysval['text'] = '说明: <br />
		main_page //取得url中main_page的值 <br />
		products_id //当前商品ID <br />
		category_tree  //当前商品分类的ID树数组<br />
		category_id  //当前的商品分类ID
		
		';
		return $sysval;
	}
	
	//输出错误提示，并停止执行程序
	private function err($message, $is_stop=true)
	{
		print_r($message); exit;
	}
	
}


?>