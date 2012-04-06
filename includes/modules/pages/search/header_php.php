<?php
/**
 * Header code file for the Advanced Search Input page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4673 2006-10-03 01:37:07Z drbyte $
 */
  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $breadcrumb->add(NAVBAR_TITLE_1);

//test:
//&keyword=die+hard&categories_id=10&inc_subcat=1&manufacturers_id=4&pfrom=1&pto=50&dfrom=01%2F01%2F2003&dto=12%2F20%2F2005
//$runtime= new runtime;
//$runtime->start();
$keywords=addslashes($_GET['keyword']);

$sql1="SELECT p.products_id,p.products_image,p.products_quantity_order_units,p.products_quantity_order_min,pd.products_name,p.products_price_sorter, p.products_quantity,  p.products_type, p.master_categories_id, p.manufacturers_id,
p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) 
AS specials_new_products_price, IF(s.status =1, s.specials_new_products_price, p.products_price) AS final_price, p.products_sort_order,
p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status ,
MATCH(pd.products_name) AGAINST ('".$keywords."')*2 as wt
FROM products_description pd, products p 
LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c 
LEFT JOIN specials s ON p2c.products_id = s.products_id,categories_description cd 
WHERE MATCH(pd.products_name) AGAINST ('".$keywords."') 
AND p.products_status = 1 AND p.products_id = p2c.products_id AND pd.products_id = p2c.products_id AND pd.language_id = '1' 
AND p2c.categories_id=cd.categories_id";

$sql2="SELECT  p.products_id,p.products_image,p.products_quantity_order_units,p.products_quantity_order_min,p.products_price_sorter, pd.products_name, p.products_quantity, p.products_type, p.master_categories_id, p.manufacturers_id,
p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) 
AS specials_new_products_price, IF(s.status =1, s.specials_new_products_price, p.products_price) AS final_price, p.products_sort_order,
p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status ,
MATCH(cd.categories_name) AGAINST ('".$keywords."') as wt
FROM products_description pd, products p 
LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c 
LEFT JOIN specials s ON p2c.products_id = s.products_id,categories_description cd 
WHERE MATCH(cd.categories_name) AGAINST ('".$keywords."')
AND p.products_status = 1 AND p.products_id = p2c.products_id AND pd.products_id = p2c.products_id AND pd.language_id = '1' 
AND p2c.categories_id=cd.categories_id";

$sql3="SELECT p.products_id,p.products_image,p.products_quantity_order_units,p.products_quantity_order_min, pd.products_name,p.products_price_sorter, p.products_quantity,  p.products_type, p.master_categories_id, p.manufacturers_id,
p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) 
AS specials_new_products_price, IF(s.status =1, s.specials_new_products_price, p.products_price) AS final_price, p.products_sort_order,
p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status ,
MATCH(p.products_model) AGAINST ('".$keywords."') as wt
FROM products_description pd, products p 
LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c 
LEFT JOIN specials s ON p2c.products_id = s.products_id,categories_description cd 
WHERE MATCH(p.products_model) AGAINST ('".$keywords."') 
AND p.products_status = 1 AND p.products_id = p2c.products_id AND pd.products_id = p2c.products_id AND pd.language_id = '1' 
AND p2c.categories_id=cd.categories_id";

$sql4="SELECT p.products_id,p.products_image,p.products_quantity_order_units,p.products_quantity_order_min, pd.products_name,p.products_price_sorter, p.products_quantity,  p.products_type, p.master_categories_id, p.manufacturers_id,
p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) 
AS specials_new_products_price, IF(s.status =1, s.specials_new_products_price, p.products_price) AS final_price, p.products_sort_order,
p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status ,
MATCH(pd.products_description) AGAINST ('".$keywords."') as wt
FROM products_description pd, products p 
LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c 
LEFT JOIN specials s ON p2c.products_id = s.products_id,categories_description cd 
WHERE MATCH(pd.products_description) AGAINST ('".$keywords."') 
AND p.products_status = 1 AND p.products_id = p2c.products_id AND pd.products_id = p2c.products_id AND pd.language_id = '1' 
AND p2c.categories_id=cd.categories_id";


$arr_tmp=array();

for($i=1;$i<5;$i++)
{
	/*
	while($row=mysql_fetch_assoc($rs1))
	{
		$arr_tmp[$row['products_id']]=$row;
	}
	*/
	$rs=null;
	$sql="sql".$i;
	$rs=mysql_query($$sql);
	if(mysql_error())
	{
		echo $$sql;
	}
	while($row=mysql_fetch_assoc($rs))
	{
		if(array_key_exists($row['products_id'],$arr_tmp))
		{
			$arr_tmp[$row['products_id']]['wt']+=$row['wt'];
		}
		else
		{
			$arr_tmp[$row['products_id']]=$row;
			$arr_tmp[$row['products_id']]['products_description']=zen_trunc_string(zen_clean_html(stripslashes($row['products_description'])),100);
		}
	}
}
$pagesize=12;
if($arr_tmp)
{
	$list_box_contents = sysSortArray($arr_tmp,"wt","SORT_DESC");
}
if($list_box_contents)
{
	$total=count($list_box_contents);
	$pagecount=ceil($total/$pagesize);
	if(!$_GET['page'])
	{
		$_GET['page']=1;
	}
	if($_GET['page']<=1)
	{
		$_GET['page']=1;
	}
	if($_GET['page']>$pagecount)
	{
		$_GET['page']=$pagecount;
	}
	$page=$_GET['page'];
	if($page>1)
	{
		$prvpage=$page-1;
	}
	else
	{
		$prvpage=1;
	}
	echo $pagecount;
	if($page<$pagecount)
	{
		$nextpage=$page+1;
	}
	else
	{
		$nextpage=$pagecount;
	}
	$offset=($page-1)*$pagesize;   //偏移量
	$list_box_contents=array_slice($list_box_contents,$offset,$pagesize);
}

function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR"){
	if(!is_array($ArrayData))
	{
		return $ArrayData;
	}
	// Get args number.
	$ArgCount = func_num_args();
	// Get keys to sort by and put them to SortRule array.
	for($I = 1;$I < $ArgCount;$I ++)
	{
		$Arg = func_get_arg($I);
		if(!preg_match("/SORT/",$Arg))
		{
			$KeyNameList[] = $Arg;
			$SortRule[] = '$'.$Arg;
		}
		else
		{
			$SortRule[] = $Arg;
		}
	}
	// Get the values according to the keys and put them to array.
	foreach($ArrayData AS $Key => $Info)
	{
		foreach($KeyNameList AS $KeyName)
		{
			${$KeyName}[$Key] = $Info[$KeyName];
		}
	}
	// Create the eval string and eval it.
	$EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
	eval ($EvalString);
	return $ArrayData;
}
?>