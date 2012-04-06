<?php
/**
 *  product_free_shipping_info main_template_vars.php
 *
 * @package productTypes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_template_vars.php 5369 2006-12-23 10:55:52Z drbyte $
 */
/*
 * Extracts and constructs the data to be used in the product-type template tpl_TYPEHANDLER_info_display.php
 */

  // This should be first line of the script:
  $zco_notifier->notify('NOTIFY_MAIN_TEMPLATE_VARS_START_PRODUCT_FREE_SHIPPING_INFO');

  $module_show_categories = PRODUCT_INFO_CATEGORIES;

  $sql = "select count(*) as total
          from " . TABLE_PRODUCTS . " p, " .
                   TABLE_PRODUCTS_DESCRIPTION . " pd
          where    p.products_status = '1'
          and      p.products_id = '" . (int)$_GET['products_id'] . "'
          and      pd.products_id = p.products_id
          and      pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";


  $res = $db->Execute($sql);

  if ( $res->fields['total'] < 1 ) {

    $tpl_page_body = '/tpl_product_info_noproduct.php';

  } else {

    $tpl_page_body = '/tpl_product_free_shipping_info_display.php';

    $sql = "update " . TABLE_PRODUCTS_DESCRIPTION . "
            set        products_viewed = products_viewed+1
            where      products_id = '" . (int)$_GET['products_id'] . "'
            and        language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $res = $db->Execute($sql);

    $sql = "select p.products_id, pd.products_name,
                  pd.products_description, p.products_model,
                  p.products_quantity, p.products_image,
                  pd.products_url, p.products_price,
                  p.products_tax_class_id, p.products_date_added,
                  p.products_date_available, p.manufacturers_id, p.products_quantity,
                  p.products_weight, p.products_priced_by_attribute, p.product_is_free,
                  p.products_qty_box_status,
                  p.products_quantity_order_max,
                  p.products_discount_type, p.products_discount_type_from, p.products_sort_order, p.products_price_sorter
           from   " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
           where  p.products_status = '1'
           and    p.products_id = '" . (int)$_GET['products_id'] . "'
           and    pd.products_id = p.products_id
           and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $product_info = $db->Execute($sql);

    $products_price_sorter = $product_info->fields['products_price_sorter'];

    $products_price = $currencies->display_price($product_info->fields['products_price'],
                      zen_get_tax_rate($product_info->fields['products_tax_class_id']));

    $manufacturers_name= zen_get_products_manufacturers_name((int)$_GET['products_id']);

    if ($new_price = zen_get_products_special_price($product_info->fields['products_id'])) {

      $specials_price = $currencies->display_price($new_price,
                        zen_get_tax_rate($product_info->fields['products_tax_class_id']));

    }

// set flag for attributes module usage:
    $flag_show_weight_attrib_for_this_prod_type = SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES;
// get attributes
     require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_ATTRIBUTES));

// if review must be approved or disabled do not show review
    $review_status = " and r.status = '1'";

    $reviews_query = "select count(*) as count from " . TABLE_REVIEWS . " r, "
                                                       . TABLE_REVIEWS_DESCRIPTION . " rd
                       where r.products_id = '" . (int)$_GET['products_id'] . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                       $review_status;

    $reviews = $db->Execute($reviews_query);

  }

  require(DIR_WS_MODULES . zen_get_module_directory('product_prev_next.php'));

  $products_name = $product_info->fields['products_name'];
  $products_model = $product_info->fields['products_model'];
  $products_description = $product_info->fields['products_description'];

  if ($product_info->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
    $products_image = PRODUCTS_IMAGE_NO_IMAGE;
  } else {
    $products_image = $product_info->fields['products_image'];
  }

  $products_url = $product_info->fields['products_url'];
  $products_date_available = $product_info->fields['products_date_available'];
  $products_date_added = $product_info->fields['products_date_added'];
  $products_manufacturer = $product_info->fields['manufacturers_name'];
  $products_weight = $product_info->fields['products_weight'];
  $products_quantity = $product_info->fields['products_quantity'];

  $products_qty_box_status = $product_info->fields['products_qty_box_status'];
  $products_quantity_order_max = $product_info->fields['products_quantity_order_max'];

  $products_base_price = $currencies->display_price(zen_get_products_base_price((int)$_GET['products_id']),
                      zen_get_tax_rate($product_info->fields['products_tax_class_id']));

  $product_is_free = $product_info->fields['product_is_free'];

  $products_tax_class_id = $product_info->fields['products_tax_class_id'];

  $module_show_categories = PRODUCT_INFO_CATEGORIES;
  $module_next_previous = PRODUCT_INFO_PREVIOUS_NEXT;

  $products_id_current = (int)$_GET['products_id'];
  $products_discount_type = $product_info->fields['products_discount_type'];
  $products_discount_type_from = $product_info->fields['products_discount_type_from'];

/**
 * Load product-type-specific main_template_vars
 */
  $prod_type_specific_vars_info = DIR_WS_MODULES . 'pages/' . $current_page_base . '/main_template_vars_product_type.php';
  if (file_exists($prod_type_specific_vars_info)) {
    include_once($prod_type_specific_vars_info);
  }
  $zco_notifier->notify('NOTIFY_MAIN_TEMPLATE_VARS_PRODUCT_TYPE_VARS_PRODUCT_FREE_SHIPPING_INFO');


/**
 * Load all *.PHP files from the /includes/templates/MYTEMPLATE/PAGENAME/extra_main_template_vars
 */
  $extras_dir = $template->get_template_dir('.php', DIR_WS_TEMPLATE, $current_page_base . 'extra_main_template_vars', $current_page_base . '/' . 'extra_main_template_vars');
  if ($dir = @dir($extras_dir)) {
    while ($file = $dir->read()) {
      if (!is_dir($extras_dir . '/' . $file)) {
        if (preg_match('/\.php$/', $file) > 0) {
          $directory_array[] = '/' . $file;
        }
      }
    }
    $dir->close();
  }
  if (sizeof($directory_array)) sort($directory_array);

  for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
    if (file_exists($extras_dir . $directory_array[$i])) include($extras_dir . $directory_array[$i]);
  }

// build show flags from product type layout settings
  $flag_show_product_info_starting_at = zen_get_show_product_switch($_GET['products_id'], 'starting_at');
  $flag_show_product_info_model = zen_get_show_product_switch($_GET['products_id'], 'model');
  $flag_show_product_info_weight = zen_get_show_product_switch($_GET['products_id'], 'weight');
  $flag_show_product_info_quantity = zen_get_show_product_switch($_GET['products_id'], 'quantity');
  $flag_show_product_info_manufacturer = zen_get_show_product_switch($_GET['products_id'], 'manufacturer');
  $flag_show_product_info_in_cart_qty = zen_get_show_product_switch($_GET['products_id'], 'in_cart_qty');
  $flag_show_product_info_tell_a_friend = zen_get_show_product_switch($_GET['products_id'], 'tell_a_friend');
  $flag_show_product_info_reviews = zen_get_show_product_switch($_GET['products_id'], 'reviews');
  $flag_show_product_info_reviews_count = zen_get_show_product_switch($_GET['products_id'], 'reviews_count');
  $flag_show_product_info_date_available = zen_get_show_product_switch($_GET['products_id'], 'date_available');
  $flag_show_product_info_date_added = zen_get_show_product_switch($_GET['products_id'], 'date_added');
  $flag_show_product_info_url = zen_get_show_product_switch($_GET['products_id'], 'url');
  $flag_show_product_info_additional_images = zen_get_show_product_switch($_GET['products_id'], 'additional_images');
  $flag_show_product_info_free_shipping = zen_get_show_product_switch($_GET['products_id'], 'always_free_shipping_image_switch');
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCTS_QUANTITY_DISCOUNTS)); 

  $zco_notifier->notify('NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_FREE_SHIPPING_INFO');


  require($template->get_template_dir($tpl_page_body,DIR_WS_TEMPLATE, $current_page_base,'templates'). $tpl_page_body);

  //require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_ALSO_PURCHASED_PRODUCTS));

  // This should be last line of the script:
  $zco_notifier->notify('NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_FREE_SHIPPING_INFO');
?>
