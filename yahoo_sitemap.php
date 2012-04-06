<?php
require('includes/application_top.php');
require_once (DIR_WS_CLASSES . 'ch_categories_tree_generator.php');
set_time_limit(0);
$main_category_tree = new ch_category_tree;
//CHRISTOPH EOF
$row = 0;
$box_categories_array = array();

// don't build a tree when no categories
$check_categories = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_status=1 limit 1");
if ($check_categories->RecordCount() > 0) {
	$box_categories_array = $main_category_tree->zen_category_tree();
}
$content=zen_href_link(FILENAME_DEFAULT)."\n";
foreach($box_categories_array as $key=>$value)
{

	$cpath=str_replace("cPath=","",$value['path']);
	$cpath2=explode("_",$cpath);
	foreach($cpath2 as $k=>$v)
	{
			$arr[]=$v;
	}
	$content.=zen_href_link(FILENAME_DEFAULT,$value["path"])."\n";
}
if($_GET['act']=='style')
{
	$arr=array_unique($arr);
	foreach($arr as $current_category_id)
	{
		if(zen_has_category_subcategories($current_category_id))
		{
			$priceListQuery_sql = '';
			$priceListQueryArray = array();
			zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
			$priceListQuery_sql = implode(' or categories_id =',$product_in_categoriesArray);
			$priceListQuery_sql = '( categories_id = '.$priceListQuery_sql.')';
		}
		else
		{
			$priceListQuery_sql = 'categories_id = ' . (int)$current_category_id;
		}
		$styleSQL="SELECT PV.products_options_values_id,PV.products_options_values_name,PA.options_id FROM products_options_values PV LEFT JOIN products_attributes PA ON PV.products_options_values_id=PA.options_values_id AND options_id=1 AND PA.products_id IN (SELECT `products_id` FROM products_to_categories WHERE ". $priceListQuery_sql .") and options_id=1 group by PA.options_values_id";
		$styleListArray = $db->Execute($styleSQL);
		$row = 0;
		while (!$styleListArray->EOF)
		{
			$content.=zen_href_link(FILENAME_DEFAULT, "cPath=".$current_category_id."&style_name=".strip($styleListArray->fields['products_options_values_name'])."&style=".$styleListArray->fields['products_options_values_id'])."\n";
			$row++;
			$styleListArray->MoveNext();
		}
	}
}
$SQL="SELECT * FROM products_description";
$rs = $db->Execute($SQL);
while (!$rs->EOF)
{
	$content.=zen_href_link(zen_get_info_page($rs->fields['products_id']),"products_id=".$rs->fields['products_id'])."\n";
	$rs->MoveNext();
}

if(!$handle=fopen(DIR_FS_CATALOG."urllist.txt","wb"))
{
	echo "打开文件";
	exit;
}
if(fwrite($handle,$content)===false)
{
	echo "写文件失败";
	exit;
}
fclose($handle);
echo "更新成功";
function strip($string){
	$pattern="/([[:punct:]])+/";
	$anchor = preg_replace($pattern, '', $string);
	$pattern = "/([[:space:]]|[[:blank:]])+/"; 
	$anchor = preg_replace($pattern, '-', $anchor);
	return $anchor;
}
?>