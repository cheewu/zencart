<?php
/**
 * products class
 *
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: products.php 4265 2006-08-25 08:09:36Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * products class
 * Class used for managing various product information
 *
 * @package classes
 */
class products extends base {
  var $modules, $selected_module;

  // class constructor
  function products($module = '') {
  }

  function get_products_in_category($zf_category_id, $zf_recurse=true, $zf_product_ids_only=false) {
    global $db;
    $za_products_array = array();
    // get top level products
    $zp_products_query = "select ptc.*, pd.products_name
                            from " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc
                            left join " . TABLE_PRODUCTS_DESCRIPTION . " pd
                            on ptc.products_id = pd.products_id
                            and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                            where ptc.categories_id='" . (int)$zf_category_id . "'
                            order by pd.products_name";

    $zp_products = $db->Execute($zp_products_query);
    while (!$zp_products->EOF) {
      if ($zf_product_ids_only) {
        $za_products_array[] = $zp_products->fields['products_id'];
      } else {
        $za_products_array[] = array('id' => $zp_products->fields['products_id'],
                                     'text' => $zp_products->fields['products_name']);
      }
      $zp_products->MoveNext();
    }
    if ($zf_recurse) {
      $zp_categories_query = "select categories_id from " . TABLE_CATEGORIES . "
                                where parent_id = '" . (int)$zf_category_id . "'";
      $zp_categories = $db->Execute($zp_categories_query);
      while (!$zp_categories->EOF) {
        $za_sub_products_array = $this->get_products_in_category($zp_categories->fields['categories_id'], true, $zf_product_ids_only);
        $za_products_array = array_merge($za_products_array, $za_sub_products_array);
        $zp_categories->MoveNext();
      }
    }
    return $za_products_array;
  }

  function products_name($zf_product_id) {
    global $db;
    $zp_product_name_query = "select products_name from " . TABLE_PRODUCTS_DESCRIPTION . "
                                where language_id = '" . $_SESSION['languages_id'] . "'
                                and products_id = '" . (int)$zf_product_id . "'";
    $zp_product_name = $db->Execute($zp_product_name_query);
    $zp_product_name = $zp_product_name->fields['products_name'];
    return $zp_product_name;
  }

  function get_admin_handler($type) {
    return $this->get_handler($type) . '.php';
  }

  function get_handler($type) {
    global $db;

    $sql = "select type_handler from " . TABLE_PRODUCT_TYPES . " where type_id = '" . (int)$type . "'";
    $handler = $db->Execute($sql);
    return $handler->fields['type_handler'];
  }

  function get_allow_add_to_cart($zf_product_id) {
    global $db;

    $sql = "select products_type from " . TABLE_PRODUCTS . " where products_id='" . (int)$zf_product_id . "'";
    $type_lookup = $db->Execute($sql);

    $sql = "select allow_add_to_cart from " . TABLE_PRODUCT_TYPES . " where type_id = '" . (int)$type_lookup->fields['products_type'] . "'";
    $allow_add_to_cart = $db->Execute($sql);

    return $allow_add_to_cart->fields['allow_add_to_cart'];
  }

}
?>