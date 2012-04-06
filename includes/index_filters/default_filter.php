<?php
/**
 * default_filter.php  for index filters
 *
 * index filter for the default product type
 * show the products of a specified manufacturer
 *
 * @package productTypes
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @todo Need to add/fine-tune ability to override or insert entry-points on a per-product-type basis
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: default_filter.php 6912 2007-09-02 02:23:45Z drbyte $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  if(isset($_GET['productsort']) && (int)$_GET['productsort'] > 0){
		switch ($_GET['productsort']){
			case 2:
				$product_sort = " order by pd.products_name ";
				break;
			case 3:
				$product_sort = " order by p.products_price";
				break;
			case 4:
				$product_sort = " order by p.products_price DESC";
				break;
			case 5:
				$product_sort = " order by p.products_date_added DESC";
				break;
			default:
				$product_sort = " order by p.products_id DESC";//order by p.products_ordered DESC
		}
  }
  else
  {
		$product_sort = " order by p.products_id DESC";
  }
  if(isset($_GET['display'])){
  //addBy showq@qq.com
   $displayTypes = substr($_GET['display'],0,strlen($_GET['display']) - (is_numeric(substr($_GET['display'],-1,1)) ? 2 : 0));
   switch ($displayTypes){
    case 'Wholesale-Only':
      $displayOrder = ' and p.`product_is_wholesale` = 1';
      break;
    case 'Free-Shipping':
      $displayOrder = ' and p.`product_is_always_free_shipping` = 1';
      break;
    default:
      $displayOrder = '';
   }
  }

  if (isset($_GET['min_price']) && isset($_GET['max_price']) && $_GET['min_price'] != '' && $_GET['max_price'] != ''){

  	$priceOrder = ' and '.$_GET['min_price'].' <=  p.`products_price` and p.`products_price` <= '.$_GET['max_price'];

  }
  if(isset($_GET['style']) && $_GET['style']!="")
  {
	$styleOrder=" and p.products_id in (select products_id from ".TABLE_PRODUCTS_ATTRIBUTES." where options_values_id=".(int)$_GET['style'].")";
  }
  if(isset($_GET['color']) && $_GET['color']!="")
  {
	$styleOrder=" and p.products_id in (select products_id from ".TABLE_PRODUCTS_ATTRIBUTES." where options_values_id=".(int)$_GET['color'].")";
  }

  if (!isset($select_column_list)) $select_column_list = "";
   // show the products of a specified manufacturer
  if (isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] != '' ) {
    if (isset($_GET['filter_id']) && zen_not_null($_GET['filter_id'])) {
// We are asked to show only a specific category
      $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type,p.products_status,p.products_price,p.products_quantity,p.products_image, p.products_quantity_order_min, p.master_categories_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, pd.products_description, if(s.status = 1, s.specials_new_products_price, NULL) AS specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status
       from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id , " .
       TABLE_PRODUCTS_DESCRIPTION . " pd, " .
       TABLE_MANUFACTURERS . " m, " .
       TABLE_PRODUCTS_TO_CATEGORIES . " p2c
       where p.products_status = 1
         and p.manufacturers_id = m.manufacturers_id
         and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'
         and p.products_id = p2c.products_id
         and pd.products_id = p2c.products_id
         and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
         and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
    } else {
// We show them all
      $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type,p.products_status,p.products_price,p.products_quantity,p.products_image,, p.products_quantity_order_min, p.master_categories_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status
      from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " .
      TABLE_PRODUCTS_DESCRIPTION . " pd, " .
      TABLE_MANUFACTURERS . " m
      where p.products_status = 1
        and pd.products_id = p.products_id
        and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
        and p.manufacturers_id = m.manufacturers_id
        and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
    }
  } else {
// show the products in a given category

//addBy showq@qq.com
		if(zen_has_category_subcategories($current_category_id)){
	  	$product_in_categories_sql = '';
	  	$product_in_categoriesArray = array();
	  	zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
	  	$product_in_categories_sql = implode(' or p2c.categories_id =',$product_in_categoriesArray);
	  	$product_in_categories_sql = '( p2c.categories_id ='.$product_in_categories_sql.')';
		}else{
			$product_in_categories_sql = 'p2c.categories_id = ' . (int)$current_category_id;
		}

    if (isset($_GET['filter_id']) && zen_not_null($_GET['filter_id'])) {
// We are asked to show only specific category
      $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type,p.products_status,p.products_price,p.products_quantity, p.products_image,p.products_quantity_order_min, p.master_categories_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status
      from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " .
      TABLE_PRODUCTS_DESCRIPTION . " pd, " .
      TABLE_MANUFACTURERS . " m, " .
      TABLE_PRODUCTS_TO_CATEGORIES . " p2c
      where p.products_status = 1
        and p.manufacturers_id = m.manufacturers_id
        and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "'
        and p.products_id = p2c.products_id
        and pd.products_id = p2c.products_id
        and pd.language_id = '" . (int)$_SESSION['languages_id']."'". $displayOrder. $priceOrder.$styleOrder."
        and " . $product_in_categories_sql;
    } else {
// We show them all
      $listing_sql = "select " . $select_column_list . " p.products_id,pd.products_name, p.products_type,p.products_status,p.products_price,p.products_quantity, p.products_image,p.products_quantity_order_min, p.master_categories_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status =1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status
       from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " .
       TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id, " .
       TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS . " s on p2c.products_id = s.products_id
       where p.products_status = 1
         and p.products_id = p2c.products_id
         and pd.products_id = p2c.products_id
         and pd.language_id = '" . (int)$_SESSION['languages_id']."'". $displayOrder. $priceOrder.$styleOrder."
         and " . $product_in_categories_sql;
    }
  }

// set the default sort order setting from the Admin when not defined by customer
  if (!isset($_GET['sort']) and PRODUCT_LISTING_DEFAULT_SORT_ORDER != '') {
    $_GET['sort'] = PRODUCT_LISTING_DEFAULT_SORT_ORDER;
  }
  //if (isset($column_list)) {
      $listing_sql .= $product_sort;
  //}
// optional Product List Filter
  if (PRODUCT_LIST_FILTER > 0) {
    if (isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] != '') {
      $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name
      from " . TABLE_PRODUCTS . " p, " .
      TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " .
      TABLE_CATEGORIES . " c, " .
      TABLE_CATEGORIES_DESCRIPTION . " cd
      where p.products_status = 1
        and p.products_id = p2c.products_id
        and p2c.categories_id = c.categories_id
        and p2c.categories_id = cd.categories_id
        and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
        and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'
      order by cd.categories_name";
    } else {
      $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name
      from " . TABLE_PRODUCTS . " p, " .
      TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " .
      TABLE_MANUFACTURERS . " m
      where p.products_status = 1
        and p.manufacturers_id = m.manufacturers_id
        and p.products_id = p2c.products_id
        and p2c.categories_id = '" . (int)$current_category_id . "'
      order by m.manufacturers_name";
    }
    $do_filter_list = false;
    $filterlist = $db->Execute($filterlist_sql);
    if ($filterlist->RecordCount() > 1) {
        $do_filter_list = true;
      if (isset($_GET['manufacturers_id'])) {
        $getoption_set =  true;
        $get_option_variable = 'manufacturers_id';
        $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
      } else {
        $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
      }
      while (!$filterlist->EOF) {
        $options[] = array('id' => $filterlist->fields['id'], 'text' => $filterlist->fields['name']);
        $filterlist->MoveNext();
      }
    }
  }

// Get the right image for the top-right
  $image = DIR_WS_TEMPLATE_IMAGES . 'table_background_list.gif';
  if (isset($_GET['manufacturers_id'])) {
    $sql = "select manufacturers_image
              from   " . TABLE_MANUFACTURERS . "
              where      manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";

    $image_name = $db->Execute($sql);
    $image = $image_name->fields['manufacturers_image'];

  } elseif ($current_category_id) {

    $sql = "select categories_image from " . TABLE_CATEGORIES . "
            where  categories_id = '" . (int)$current_category_id . "'";

    $image_name = $db->Execute($sql);
    $image = $image_name->fields['categories_image'];
  }
?>