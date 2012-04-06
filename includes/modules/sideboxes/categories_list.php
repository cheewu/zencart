<?php
/**
 * categories sidebox - prepares content for the main categories sidebox
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: categories.php 2718 2005-12-28 06:42:39Z drbyte $
 */
		
    $row = 0;
    $priceListArray = array();
    $priceList = array();
if (isset($_GET["cPath"]) && zen_not_null($_GET["cPath"])){
// don't build a tree when no categories
    require($template->get_template_dir('tpl_categories_list.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_categories_list.php');

    $title = "Narrow By";
	$subtitle = "Category";
    $title_link = false;
    
/*
 * priceList  four part
 */
	    if(zen_has_category_subcategories($current_category_id)){
		    $priceListQuery_sql = '';
			  $priceListQueryArray = array();
			  zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
			  $priceListQuery_sql = implode(' or p2c.categories_id =',$product_in_categoriesArray);
			  $priceListQuery_sql = '( p2c.categories_id = '.$priceListQuery_sql.')';
	    }else{
	    	$priceListQuery_sql = 'p2c.categories_id = ' . (int)$current_category_id;
	    }
	    $priceListQuery = "SELECT p.`products_price`,p2c.`categories_id` FROM products p,products_to_categories p2c WHERE p2c.products_id=p.products_id AND ". $priceListQuery_sql ." order by products_price";    
	    $priceListArray = $db->Execute($priceListQuery);
	    $priceList=array();
	    while (!$priceListArray->EOF){
	    	$priceList[] = $priceListArray->fields['products_price'];
	    	$priceListArray->MoveNext();
	    }
	    $priceListOutString = '';
		if($priceList)
		{
			$totalNum = sizeof($priceList);
			$MaxPrice = max($priceList);
			$MinPrice = min($priceList);
			$ThePrice = $MaxPrice-$MinPrice;
			$MiddlePrice = $ThePrice/5;

		if($MaxPrice>$MinPrice)
		{
			for($num=$MinPrice;$num<=$MaxPrice;$num=$num+$MiddlePrice)
			{
				for($num=$MinPrice;$num<$MaxPrice;$num=$num+$MiddlePrice)
				{
					$priceListOutString .= '<li>';
					$priceListOutString .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id.'&min_price='.floor($num)).'&max_price='.ceil($num+$MiddlePrice).'"     rel="nofollow">';
					$priceListOutString .= $currencies->display_price($num,zen_get_tax_rate($_GET['products_tax_class_id'])).' - '.$currencies->display_price($num+$MiddlePrice,zen_get_tax_rate($_GET['products_tax_class_id']));   	
					$priceListOutString .= '</a>';
					$priceListOutString .= '</li>';
				}
			}
		}
		unset($priceListQuery,$priceListQuery_sql);
		require($template->get_template_dir('tpl_box_categories_list.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_box_categories_list.php');
}
}
?>