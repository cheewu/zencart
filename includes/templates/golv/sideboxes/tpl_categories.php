<?php

/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
 /*
  $content = "";
  
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent"><ul>' . "\n";
  for ($i=0;$i<sizeof($box_categories_array);$i++) {
      case ($box_categories_array[$i]['top'] == 'true'):
        $new_style = 'category-top';
        break;
      case ($box_categories_array[$i]['has_sub_cat']):
        $new_style = 'category-subs';
        break;
      default:
        $new_style = 'category-products';
      }
     if (zen_get_product_types_to_category($box_categories_array[$i]['path']) == 3 or ($box_categories_array[$i]['top'] != 'true' and SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS != 1)) {
        // skip if this is for the document box (==3)
      } else {
      $content .= '<li><a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';

      if ($box_categories_array[$i]['current']) {
        if ($box_categories_array[$i]['has_sub_cat']) {
          $content .= '<span class="category-subs-parent">' . $box_categories_array[$i]['name'] . '</span>';
        } else {
          $content .= '<span class="category-subs-selected">' . $box_categories_array[$i]['name'] . '</span>';
        }
      } else {
        $content .= $box_categories_array[$i]['name'];
      }

      if ($box_categories_array[$i]['has_sub_cat']) {
        $content .= CATEGORIES_SEPARATOR;
      }
      $content .= '</a>';

      if (SHOW_COUNTS == 'true') {
        if ((CATEGORIES_COUNT_ZERO == '1' and $box_categories_array[$i]['count'] == 0) or $box_categories_array[$i]['count'] >= 1) {
          $content .= CATEGORIES_COUNT_PREFIX . $box_categories_array[$i]['count'] . CATEGORIES_COUNT_SUFFIX;
        }
      }

      $content .= '</li>' . "\n";
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
        $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_SPECIALS) . '">' . CATEGORIES_BOX_HEADING_SPECIALS . '</a>' . '</li>' . "\n";
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
        $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . CATEGORIES_BOX_HEADING_WHATS_NEW . '</a>' . '</li>' . "\n";
      }
    }
    if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true') {
      $show_this = $db->Execute("select products_id from " . TABLE_FEATURED . " where status= 1 limit 1");
      if ($show_this->RecordCount() > 0) {
        $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a>' . '</li>' . "\n";
      }
    }
    if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
      $content .= '<li><a class="category-links" href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">' . CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a>' . '</li>' ."\n";
    }
  }
  $content .= '</ul></div>';
  */
?>

<div class="leftBoxContainer" id="categories" style="width: 210px;">
<h3 class="leftBoxHeading" id="categoriesHeading">Categories</h3>
<div id="categoriesContent" class="sideBoxContent">
<div>WOMEN</div>
<ul><a class="category-top" href="/Louis-Vuitton-Handbag-c1">Handbag</a>
		<li><a href="/Louis-Vuitton-Handbag-Shoulder-Bags-and-Totes-c1_14">Shoulder Bags and Totes</a></li>
		<li><a href="/Louis-Vuitton-Handbag-Top-Handles-c1_15">Top Handles</a></li>
		<li><a href="/Louis-Vuitton-Handbag-Clutches-and-Evening-c1_16">Clutches and Evening</a></li>
</ul>
<ul><a class="category-top" href="/Louis-Vuitton-Travel-c2">Travel</a>
		<li><a href="/Louis-Vuitton-Travel-Luggage-c2_17">Luggage</a></li>
		<li><a href="/Louis-Vuitton-Travel-Travel-Accessories-c2_18">Travel Accessories</a></li>
</ul>
<ul><a class="category-top" href="/Louis-Vuitton-Belts-and-Accessories-c3">Belts and Accessories</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Purse-c4">Purse</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Key-Holder-c5">Key Holder</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Scarves-c6">Scarves</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Key-Rings-c7">Key Rings</a></ul>
<div>MEN</div>
<ul><a class="category-top" href="/Louis-Vuitton-Bags-c8">Bags</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Luggage-c9">Luggage</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Wallets-c10">Wallets</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Shoes-c11">Shoes</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Agendas-c12">Agendas</a></ul>
<ul><a class="category-top" href="/Louis-Vuitton-Belts-c13">Belts</a></ul>
<div><a class="category-top" href="/Louis-Vuitton-Sunglasses-c39">Sunglasses</a></div>
</div>
</div>


