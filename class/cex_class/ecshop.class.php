<?php
/*//=================================
//
//	ecshop操作类 [更新时间: 2009-9-24]
//
//===================================*/
/*
//在使用本类前先要载入ecshop的初始化文件:
//define('IN_ECS', true);
//require_once('ecshop安装路径/includes/init.php');
*/

class ecshop
{
	private $path;
	private $issetpath; //是否设置了路径
	private $db; //mydb类对象，连接数据库
	private $dbprefix; //数据库表前缀
	private $user; //当前登录的会员信息

	//构造化函数
	function __construct($path='.')
	{
		if(isset($path)){ $this->setPath($path); }
	}
	//析构函数
	function __destruct()
	{	}

	//生成本类的对象
	public static function make($path='.')
	{
		return new ecshop($path);
	}

	//设置uchome的安装目录
	public function setPath($path='.')
	{
		global $db;
		$this->path = $path = filex::formatPath($path);
		$config_path = $path.'/data/config.php';
		if(filex::isFile($config_path)){
			//载入ecshop的配置:
			include_once($config_path);

			//取得数据库连接对象
			$this->db = mydb::make($db->link_id);
			$this->issetpath = true; //设置了路径
			$this->dbprefix = $prefix; //数据表前缀
		}else{
			exit('ecshop操作类: 没有找到ecshop的安装目录!');
		}
	}

	//取得分类下的子分类
	public function getChildren($cat_id)
	{
		if((int)$cat_id){ return get_children($cat_id); }
	}

	//根据分类中全部有效产品,如果省略$page和$size两个参数则一次返回分类下所有记录(即没有分页)
	public function getGoodsByCat_id($cat_id,$page=1,$size=9999)
	{
		if((int)$cat_id){ return; }
		//开打数据表
		$this->db->table($this->dbprefix.'goods','g');
		//计算得到分类下面的子分类
		$children = getChildren($cat_id);
		$sql = "($children OR ".get_extension_goods($children).') AND is_delete=0 AND is_on_sale=1 AND is_alone_sale=1 ';
		//取得当前页的记录
		return $this->db->where($sql)->order('goods_id DESC')->limit(($page-1)*$size.",$size")->find();
	}

	//取得所有有效产品,如果省略所有参数则一次返回所有记录(即没有分页)
	public function getAllGoods($page=1,$size=9999)
	{
		//开打数据表
		$this->db->table($this->dbprefix.'goods','g');
		$sql = 'is_delete=0 AND is_on_sale=1 AND is_alone_sale=1 ';
		return $this->db->where($sql)->order('goods_id DESC')->limit(($page-1)*$size.",$size")->find(); //取得所有记录
	}

	//统计指定分类的有效产品数量,如果没有指定分类id则返回所有有效产品
	public function countGoods($cat_id=0)
	{
		//开打数据表
		$this->db->table($this->dbprefix.'goods','g');
		//如果分类ID为0，则取得所有商品
		if($cat_id){
			$children = get_children($cat_id);
			$sql = "($children OR ".get_extension_goods($children).') AND is_delete=0 AND is_on_sale=1 AND is_alone_sale=1 ';
		}else{
			$sql = 'is_delete=0 AND is_on_sale=1 AND is_alone_sale=1';
		}
		return $this->db->where($sql)->count(); //取得总记录数量
	}

	//分页,参数: $page 当前页码, $pagelistnum 每页记录数, $total 总记录数 $style 样式
	public static function showpage($page,$pagelistnum,$total,$style=1,$url='')
	{
		global $pagelist,$showpage,$_SERVER;

		$page==''?$page=1:'';//如果page为空则为1，否则为空
		$pagelist = ($page-1)*$pagelistnum;
		($total % $pagelistnum==0)?($totalpage=$total / $pagelistnum):($totalpage = floor($total / $pagelistnum)+1);
		$page>1?$uppage = $page-1:$uppage = 1;
		$page>=$totalpage?$nextpage = $totalpage:$nextpage = $page+1;
		$tabletr="<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td height=20>";
		$tabletd="</td></tr></table>";
		$nav="   ";

		$uppage=$page-1; //上一页
		$dmpage=$page+1; //下一页

		//如果$url使用默认，即空值，则赋值为本页URL：
		if(!$url){ $url=$_SERVER["REQUEST_URI"];}
			//URL分析：
			$thispage =(stristr($url,'?page')!=false)?'?page':'&page';
			$url=str_replace($thispage."=".$page,'',$url);
			//Url里有"?"就加"&"没有就加"?"
			if(stristr($url,'?')!=false){
				$url.="&page";
			}else {
				$url.="?page";
			}
		switch($style) {
			case '1':
				//9首页 7前页 后页8 尾页:
				$nav .=" 总计<B>$total</B>条记录. 当前第<B>$page</B>页/共<strong>$totalpage</strong>页. ";
				if ($page > 1) {
					$nav .= '<a href="'.$url.'=1" class="page_linked">首页</a> ';
					$nav .= '<a href="'.$url.'='.$uppage .'" class="page_linked">上一页</a> ';
				}else {
					$nav .= '<span class="page_unlink">首页</span> ';
					$nav .= '<span class="page_unlink">上一页</span> ';
				}
				if ($page < $totalpage) {
					$nav .= '<a href="'.$url.'='.$dmpage.'" class="page_linked">下一页</a> ';
					$nav .= '<a href="'.$url.'='.$totalpage.'" class="page_linked">末页</a>';
				}else {
					$nav .= '<span class="page_unlink">下一页</span> ';
					$nav .= '<span class="page_unlink">末页</span>';
				}
				//下拉跳转列表，循环列出所有页码：
				$nav .="　转到第 <select name='topage' size='1' onchange='cexajax.update(\"cex_content\",\"$url=\"+this.value); '> ";
				for($i=1;$i<=$totalpage;$i++){
					if($i==$page) $nav.="<option value='$i' selected>$i</option> ";
					else $nav.="<option value='$i'>$i</option> ";
				}
				$nav.="</select> 页";
				break;
			case '2'://分页
				$nav .="<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
							<td height=\"35\" width=150>Total<B>$total</B>.Now<B>$page/$totalpage</b>age</td>
						<td> </td>";
				if ($page > 1) {
					$nav .= '<td width=\"20\"><a href="'.$url.'='.$uppage .'" class="page_linked">First</a></td> ';
				}else {
					$nav .= '<td width=\"20\"></td>';
				}
				$mid = ceil(($pagelistnum+1)/2);
				if($page<=$mid ) {
					$begin = 1;
				}else if($page > $totalpage-$mid) {
					$begin = $totalpage-$pagelistnum+1;
				}else {
					$begin = $page-$mid+1;
				}
				if($begin<0) $begin = 1;
				$end = ($begin+$pagelistnum>$totalpage)?$totalpage+1:$begin+$pagelistnum;
				$nav .="<td width=\"50\" align=\"left\">";
				for($i=$begin; $i<$end; $i++) {
					$nav .=($page!=$i)?" <a href='$url=$i' title='第{$i}页'>$i</a> ":" <b>$i</b>";
				}
				$nav .="</td>";
				if ($page < $totalpage) {
					$nav .= '<td width=\"50\"><a href="'.$url.'='.$dmpage.'" class=\"page_linked\">Last</a></td>';
				}else {
					$nav .= '';
				}
				$nav .='</tr></table>';
				break;
		}
		$showpage=$tabletr.$nav.$tabletd;
		return $showpage;
	}

}
?>