<?php
/**
 * index header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4371 2006-09-03 19:36:11Z ajeh $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_INDEX');

// the following cPath references come from application_top/initSystem
$category_depth = 'top';
if (isset($cPath) && zen_not_null($cPath)) {
  $categories_products_query = "SELECT count(*) AS total
                                FROM   " . TABLE_PRODUCTS_TO_CATEGORIES . "
                                WHERE   categories_id = :categoriesID";

  $categories_products_query = $db->bindVars($categories_products_query, ':categoriesID', $current_category_id, 'integer');
  $categories_products = $db->Execute($categories_products_query);

  if ($categories_products->fields['total'] > 0) {
    $category_depth = 'products'; // display products
  } else {
    $category_parent_query = "SELECT count(*) AS total
                              FROM   " . TABLE_CATEGORIES . "
                              WHERE  parent_id = :categoriesID";

    $category_parent_query = $db->bindVars($category_parent_query, ':categoriesID', $current_category_id, 'integer');
    $category_parent = $db->Execute($category_parent_query);

    if ($category_parent->fields['total'] > 0) {
      $category_depth = 'nested'; // navigate through the categories
    } else {
      $category_depth = 'products'; // category has no products, but display the 'no products' message
    }
  }
}
// include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_MAIN_PAGE, 'false');
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// set the product filters according to selected product type
$typefilter = 'default';
if (isset($_GET['typefilter'])) $typefilter = $_GET['typefilter'];
require(DIR_WS_INCLUDES . zen_get_index_filters_directory($typefilter . '_filter.php'));
// query the database based on the selected filters
$listing = $db->Execute($listing_sql);

// if only one product in this category, go directly to the product page, instead of displaying a link to just one item:
// if filter_id exists the 1 product redirect is ignored
if (SKIP_SINGLE_PRODUCT_CATEGORIES=='True' and (!isset($_GET['filter_id']) and !isset($_GET['alpha_filter']))) {
  if ($listing->RecordCount() == 1) {
    zen_redirect(zen_href_link(zen_get_info_page($listing->fields['products_id']), ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing->fields['products_id']));
  }
}

//首页新商品 原: \includes\modules/new_products.php
//=======================================================================
$categories_products_id_list = '';
$list_of_products = '';
$new_products_query = '';

$display_limit = zen_get_new_date_range();

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $new_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_NEW_PRODUCT . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1 and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma

    $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                  p.products_date_added, p.products_price, p.products_type, p.master_categories_id
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and p.products_id in (" . $list_of_products . ")";
  }
}
if ($new_products_query != '') $new_products = $db->ExecuteRandomMulti($new_products_query, MAX_DISPLAY_NEW_PRODUCTS);

$_i = 0;
$_new_products = array();
foreach($new_products->result as $np){
	if($_i<4){
		$_new_products[0][] = $np;
	}else{
		$_new_products[1][] = $np;
	}
	$_i++;
	if($_i>=8){ break; }
}
$new_products = $_new_products;
//php::end($new_products);


//首页推荐商品
//=============================================================
$categories_products_id_list = '';
$list_of_products = '';
$featured_products_query = '';
$display_limit = '';
if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1 and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
    $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                                from (" . TABLE_PRODUCTS . " p
                                left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                                left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id)
                                where p.products_id = f.products_id
                                and p.products_id = pd.products_id
                                and p.products_status = 1 and f.status = 1
                                and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and p.products_id in (" . $list_of_products . ")";
  }
}
if ($featured_products_query != '') $featured_products = $db->ExecuteRandomMulti($featured_products_query, MAX_DISPLAY_SEARCH_RESULTS_FEATURED);

$_i = 0;
$_featured_products = array();
foreach($featured_products->result as $np){
	//if($_i<4){
	//	$_featured_products[0][] = $np;
	//}else{
	//	$_featured_products[1][] = $np;
	//}
	$_featured_products[$_i%4][] = $np;
	$_i++;
	if($_i>=16){ break; }
}
$featured_products = $_featured_products;
//php::end($featured_products);


// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_INDEX');
?>