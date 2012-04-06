<?php
/**
* PureBlack Template designed by zen-cart-power.com
* zen-cart-power.com - Free Zen Cart templates and modules
* Power your Zen Cart!
* 
* Side Box Template
*
* @package templateSystem
* @copyright Copyright 2008-2009 Zen-Cart-Power.com
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
*/
$content = "";
$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
for ($i=0;$i<sizeof($box_categories_array);$i++)
{
	switch(true)
	{
		case ($box_categories_array[$i]['top'] == 'true'):
			$new_style = 'category-top';
			break;
		case ($box_categories_array[$i]['has_sub_cat']):
			$new_style = 'category-subs';
			break;
		default:
			$new_style = 'category-products';
	}
	if (zen_get_product_types_to_category($box_categories_array[$i]['path']) == 3 or ($box_categories_array[$i]['top'] != 'true' and SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS != 1))
	{
	}
	else
	{
		if($i == 0)
		{
			$top = 'no-dots';
		}
		else
		{
			$top = '';
		}
		/*	  $content .= '<div class="categories-top-list">';*/
		if($new_style == 'category-products' || $new_style == 'category-subs')
		{
			$open_tag = '<div class="subcategory">';
		}
		else
		{
			$open_tag = '<div class="categories-top-list ' . $top . '">';
		}
		$content .= $open_tag . '<a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';
		if ($box_categories_array[$i]['current'])
		{
			if ($box_categories_array[$i]['has_sub_cat'])
			{
				$content .= '<span class="category-subs-parent">' . $box_categories_array[$i]['name'] . '</span>';
			}
			else
			{
				$content .= '<span class="category-subs-selected">' . $box_categories_array[$i]['name'] . '</span>';
			}
		}
		else
		{
			$content .= $box_categories_array[$i]['name']/* . 'top down'*/;
		}

		if($box_categories_array[$i]['has_sub_cat'])
		{
			$content .= CATEGORIES_SEPARATOR;
		}
		$content .= '</a>';
		if (SHOW_COUNTS == 'true')
		{
			if ((CATEGORIES_COUNT_ZERO == '1' and $box_categories_array[$i]['count'] == 0) or $box_categories_array[$i]['count'] >= 1)
			{
				$content .= '<span class="sub-count">' . CATEGORIES_COUNT_PREFIX . $box_categories_array[$i]['count'] . CATEGORIES_COUNT_SUFFIX . '</span>';
			}
		}
		if ($new_style == 'category-products' || $new_style == 'category-subs') { $close_tag = '</div>'; } else { $close_tag = '</div>'; };
		$content .= $close_tag . "\n";
	}
}

if (SHOW_CATEGORIES_BOX_SPECIALS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true' or SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
// display a separator between categories and links
if (SHOW_CATEGORIES_SEPARATOR_LINK == '1') {
$content .= '<hr id="catBoxDivider" />' . "\n";
}
if (SHOW_CATEGORIES_BOX_SPECIALS == 'true') {
$show_this = $db->Execute("select s.products_id from " . TABLE_SPECIALS . " s where s.status= 1 limit 1");
if ($show_this->RecordCount() > 0) {
$content .= '<a class="category-links" href="' . zen_href_link(FILENAME_SPECIALS) . '">' . CATEGORIES_BOX_HEADING_SPECIALS . '</a>' . '<br />' . "\n";
}
}
if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true') {
// display limits
//      $display_limit = zen_get_products_new_timelimit();
$display_limit = zen_get_new_date_range();

$show_this = $db->Execute("select p.products_id
from " . TABLE_PRODUCTS . " p
where p.products_status = 1 " . $display_limit . " limit 1");
if ($show_this->RecordCount() > 0) {
$content .= '<a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . CATEGORIES_BOX_HEADING_WHATS_NEW . '</a>' . '<br />' . "\n";
}
}
if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true') {
$show_this = $db->Execute("select products_id from " . TABLE_FEATURED . " where status= 1 limit 1");
if ($show_this->RecordCount() > 0) {
$content .= '<a class="category-links" href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a>' . '<br />' . "\n";
}
}
if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
$content .= '<a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">' . CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a>' . "\n";
}
}
$content .= '</div>';
?>