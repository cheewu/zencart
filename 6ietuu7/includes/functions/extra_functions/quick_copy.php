<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: copy_to_confirm.php 3381 2006-04-06 20:09:45Z numinix $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// QUICK_COPY_PRODUCTS_ID_FROM_DEFAULT
// QUICK_COPY_CATEGORIES_ID_TO_DEFAULT
function quick_copy_product($products_id, $categories_id = ''){
  global $db;
  if (!(isset($products_id) && isset($categories_id))) return FALSE; // ??
  
  $products_id = (int)$products_id; // copy from this product (to a new product)
  //$categories_id = zen_db_prepare_input($categories_id); // copy to this catagory
  //if(!($products_id > 0)) return false;
  if(!(zen_products_id_valid($products_id))) exit('Fatal error: attempt to copy invalid product by quick_copy (products_id = ' . $products_id . ')');

// Copy attributes to duplicate product
  $products_id_from=$products_id;

// bof duplicate
  $old_products_id = (int)$products_id;
  $product = $db->Execute("select products_type, products_quantity, products_model products_upc, products_isbn, products_image,
                                  products_price, products_virtual, products_date_available, products_weight,
                                  products_tax_class_id, manufacturers_id,
                                  products_quantity_order_min, products_quantity_order_units, products_priced_by_attribute,
                                  product_is_free, product_is_call, products_quantity_mixed,
                                  product_is_always_free_shipping, products_qty_box_status, products_quantity_order_max, products_sort_order,
                                  products_price_sorter, master_categories_id
                           from " . TABLE_PRODUCTS . "
                           where products_id = '" . (int)$products_id . "'");
  
  // bof replace product data by nimport product data (+ add purchase price)
  
  
  
  
  // eof replace product data by nimport product data
  
  $tmp_value = zen_db_input($product->fields['products_quantity']);
  $products_quantity = (!zen_not_null($tmp_value) || $tmp_value=='' || $tmp_value == 0) ? 0 : $tmp_value;
  
  $tmp_value = zen_db_input($product->fields['products_price']);
  $products_price = (!zen_not_null($tmp_value) || $tmp_value=='' || $tmp_value == 0) ? 0 : $tmp_value;
  
  $tmp_value = zen_db_input($product->fields['products_weight']);
  $products_weight = (!zen_not_null($tmp_value) || $tmp_value=='' || $tmp_value == 0) ? 0 : $tmp_value;
  // check if categorie has products!?
  if(!($categories_id)>=0) $categories_id = $product->fields['master_categories_id'];
  
  $db->Execute("insert into " . TABLE_PRODUCTS . "
                                      (products_type, products_quantity, products_model, products_upc, products_isbn, products_image,
                                       products_price, products_virtual, products_date_added, products_date_available,
                                       products_weight, products_status, products_tax_class_id,
                                       manufacturers_id,
                                       products_quantity_order_min, products_quantity_order_units, products_priced_by_attribute,
                                       product_is_free, product_is_call, products_quantity_mixed,
                                       product_is_always_free_shipping, products_qty_box_status, products_quantity_order_max, products_sort_order,
                                       products_price_sorter, master_categories_id
                                       )
                          values ('" . zen_db_input($product->fields['products_type']) . "',
                                  '" . $products_quantity . "',
                                  '" . zen_db_input($product->fields['products_model']) . "',
                                  '" . zen_db_input($product->fields['products_upc']) . "',
                                  '" . zen_db_input($product->fields['products_isbn']) . "',
                                  '" . zen_db_input($product->fields['products_image']) . "',
                                  '" . $products_price . "',
                                  '" . zen_db_input($product->fields['products_virtual']) . "',
                                  now(),
                                  '" . zen_db_input($product->fields['products_date_available']) . "',
                                  '" . $products_weight . "', '0',
                                  '" . (int)$product->fields['products_tax_class_id'] . "',
                                  '" . (int)$product->fields['manufacturers_id'] . "',
                                  '" . zen_db_input($product->fields['products_quantity_order_min']) . "',
                                  '" . zen_db_input($product->fields['products_quantity_order_units']) . "',
                                  '" . zen_db_input($product->fields['products_priced_by_attribute']) . "',
                                  '" . (int)$product->fields['product_is_free'] . "',
                                  '" . (int)$product->fields['product_is_call'] . "',
                                  '" . (int)$product->fields['products_quantity_mixed'] . "',
                                  '" . zen_db_input($product->fields['product_is_always_free_shipping']) . "',
                                  '" . zen_db_input($product->fields['products_qty_box_status']) . "',
                                  '" . zen_db_input($product->fields['products_quantity_order_max']) . "',
                                  '" . zen_db_input($product->fields['products_sort_order']) . "',
                                  '" . zen_db_input($product->fields['products_price_sorter']) . "',
                                  '" . (int)$categories_id .                                  
                                  "')");
                                  
                               

    $dup_products_id = $db->Insert_ID();
  
  $description = $db->Execute("select language_id, products_name, products_description, products_url
                               from " . TABLE_PRODUCTS_DESCRIPTION . "
                               where products_id = '" . (int)$products_id . "'");
     while (!$description->EOF) {
       $db->Execute("insert into " . TABLE_PRODUCTS_DESCRIPTION . "
                     (products_id, language_id, products_name, products_description, products_url, products_viewed)
                     values ('" . (int)$dup_products_id . "',
                             '" . (int)$description->fields['language_id'] . "',
                             '" . zen_db_input($description->fields['products_name']) . "',
                             '" . zen_db_input($description->fields['products_description']) . "',
                             '" . zen_db_input($description->fields['products_url']) . "', '0')");
      $description->MoveNext();
    }

  $db->Execute("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . "
              (products_id, categories_id)
               values ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");
  $products_id = $dup_products_id;
  $description->MoveNext();
// FIX HERE
/////////////////////////////////////////////////////////////////////////////////////////////
// Copy attributes to duplicate product

  $products_id_to= $dup_products_id;
  $products_id = $dup_products_id;
/*
if ( $_POST['copy_attributes']=='copy_attributes_yes' and $_POST['copy_as'] == 'duplicate' ) {
  // $products_id_to= $copy_to_products_id;
//            $copy_attributes_delete_first='1';
//            $copy_attributes_duplicates_skipped='1';
//            $copy_attributes_duplicates_overwrite='0';

            if (DOWNLOAD_ENABLED == 'true') {
              $copy_attributes_include_downloads='1';
              $copy_attributes_include_filename='1';
            } else {
              $copy_attributes_include_downloads='0';
              $copy_attributes_include_filename='0';
            }

            zen_copy_products_attributes($products_id_from, $products_id_to);
}
*/
// EOF: Attributes Copy on non-linked
/////////////////////////////////////////////////////////////////////

            // copy product discounts to duplicate
            zen_copy_discounts_to_product($old_products_id, (int)$dup_products_id);
 // eof duplicate

          // reset products_price_sorter for searches etc.
          zen_update_products_price_sorter($products_id);

//zen_redirect(zen_href_link(FILENAME_QUICK_COPY, 'cPath=' . $categories_id . '&pID=' . $products_id . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')));
  // succes
  $copy['products_id'] = (int)$dup_products_id;
  $copy['master_categories_id'] = (int)$categories_id;
  return $copy;        
        
} // eof function quick_copy
?>