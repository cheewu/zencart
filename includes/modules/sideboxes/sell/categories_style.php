<?php
//error_reporting(E_ALL ^ E_NOTICE);

$styleListArray = array();
$styleList = array();
if (isset($_GET["cPath"]) && zen_not_null($_GET["cPath"]))
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
	$styleSQL="SELECT PV.products_options_values_id,PV.products_options_values_name,PA.options_id FROM products_options_values PV LEFT JOIN products_attributes PA ON PV.products_options_values_id=PA.options_values_id AND options_id=1 AND PA.products_id IN (SELECT `products_id` FROM products_to_categories WHERE ". $priceListQuery_sql .") group by PA.options_values_id ";
	//echo $styleSQL;
	//exit;
	
	$styleListArray = $db->Execute($styleSQL);
	$row = 0;
	while (!$styleListArray->EOF)
	{
		$styleList[$styleListArray->fields['options_id']][$styleListArray->fields['products_options_values_id']] = $styleListArray->fields['products_options_values_name'];
		$row++;
		$styleListArray->MoveNext();
	}
	//print_r($styleList);
	//print_r($priceList);
	//exit;
	/*
	$priceListOutString = '';
	$totalNum = sizeof($priceList);
	$MaxPrice = max($priceList);
	$MinPrice = min($priceList);
	$ThePrice = $MaxPrice-$MinPrice;
	$MiddlePrice = $ThePrice/5;
	if($MaxPrice>$MinPrice)
	{
		for($num=$MinPrice;$num<$MaxPrice;$num=$num+$MiddlePrice)
		{
			$priceListOutString .= '<li>';
			$priceListOutString .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id.'&min_price='.floor($num)).'&max_price='.ceil($num+$MiddlePrice).'">';
			$priceListOutString .= $currencies->display_price($num,zen_get_tax_rate($_GET['products_tax_class_id'])).' - '.$currencies->display_price($num+$MiddlePrice,zen_get_tax_rate($_GET['products_tax_class_id']));   	
			$priceListOutString .= '</a>';
			$priceListOutString .= '</li>';
		}
	}
	unset($priceListQuery,$priceListQuery_sql);
	*/
require($template->get_template_dir('tpl_categories_style.php', DIR_WS_TEMPLATE, $current_page_base,'sideboxes') . '/tpl_categories_style.php');
}
?>