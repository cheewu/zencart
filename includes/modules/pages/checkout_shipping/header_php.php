<?php

/**

 * Checkout Shipping Page

 *

 * @package page

 * @copyright Copyright 2003-2006 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: header_php.php 6669 2007-08-16 10:05:49Z drbyte $

 */

// This should be first line of the script:

  $zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_SHIPPING');
define('COLUMN_LEFT_NONE', 'true');


  require_once(DIR_WS_CLASSES . 'http_client.php');



// if there is nothing in the customers cart, redirect them to the shopping cart page

  if ($_SESSION['cart']->count_contents() <= 0) {

    zen_redirect(zen_href_link(FILENAME_TIME_OUT));

  }



// if the customer is not logged on, redirect them to the login page

  if (!isset($_SESSION['customer_id']) || !$_SESSION['customer_id']) {

    $_SESSION['navigation']->set_snapshot();

    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));

  } else {

    // validate customer

    if (zen_get_customer_validate_session($_SESSION['customer_id']) == false) {

      $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_SHIPPING));

      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));

    }

  }


// Validate Cart for checkout

  $_SESSION['valid_to_checkout'] = true;

  $_SESSION['cart']->get_products(true);

  if ($_SESSION['valid_to_checkout'] == false) {

    $messageStack->add('header', ERROR_CART_UPDATE, 'error');

    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));

  }



// Stock Check

  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {

    $products = $_SESSION['cart']->get_products();

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {

      if (zen_check_stock($products[$i]['id'], $products[$i]['quantity'])) {

        zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));

        break;

      }

    }

  }

// if no shipping destination address was selected, use the customers own address as default

  if (!$_SESSION['sendto']) {

    $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];

  } else {

// verify the selected shipping address

    $check_address_query = "SELECT count(*) AS total

                            FROM   " . TABLE_ADDRESS_BOOK . "

                            WHERE  customers_id = :customersID

                            AND    address_book_id = :addressBookID";



    $check_address_query = $db->bindVars($check_address_query, ':customersID', $_SESSION['customer_id'], 'integer');

    $check_address_query = $db->bindVars($check_address_query, ':addressBookID', $_SESSION['sendto'], 'integer');

    $check_address = $db->Execute($check_address_query);



    if ($check_address->fields['total'] != '1') {

      $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];

      $_SESSION['shipping'] = '';

    }

  }



  require(DIR_WS_CLASSES . 'order.php');

  $order = new order;



// register a random ID in the session to check throughout the checkout procedure

// against alterations in the shopping cart contents

  $_SESSION['cartID'] = $_SESSION['cart']->cartID;



// if the order contains only virtual products, forward the customer to the billing page as

// a shipping address is not needed

  if ($order->content_type == 'virtual') {

    $_SESSION['shipping'] = 'free_free';

    $_SESSION['shipping']['title'] = 'free_free';

    $_SESSION['sendto'] = false;

    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

  }



  $total_weight = $_SESSION['cart']->show_weight();

  $total_count = $_SESSION['cart']->count_contents();



// load all enabled shipping modules

  require(DIR_WS_CLASSES . 'shipping.php');

  $shipping_modules = new shipping;



  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {

    $pass = false;



    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {

      case 'national':

        if ($order->delivery['country_id'] == STORE_COUNTRY) {

          $pass = true;

        }

        break;

      case 'international':

        if ($order->delivery['country_id'] != STORE_COUNTRY) {

          $pass = true;

        }

        break;

      case 'both':

        $pass = true;

        break;

    }



    $free_shipping = false;

    if ( ($pass == true) && ($_SESSION['cart']->show_total() >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {

      $free_shipping = true;

    }

  } else {

    $free_shipping = false;

  }



  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));



  if (isset($_SESSION['comments'])) {

    $comments = $_SESSION['comments'];

  }





// process the selected shipping method

  if ( isset($_POST['action']) && ($_POST['action'] == 'process') ) {

    if (zen_not_null($_POST['comments'])) {

      $_SESSION['comments'] = zen_db_prepare_input($_POST['comments']);

    }

    $comments = $_SESSION['comments'];



    if ( (zen_count_shipping_modules() > 0) || ($free_shipping == true) ) {

      if ( (isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_')) ) {

        $_SESSION['shipping'] = $_POST['shipping'];



        list($module, $method) = explode('_', $_SESSION['shipping']);

        if ( is_object($$module) || ($_SESSION['shipping'] == 'free_free') ) {

          if ($_SESSION['shipping'] == 'free_free') {

            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;

            $quote[0]['methods'][0]['cost'] = '0';

          } else {

            $quote = $shipping_modules->quote($method, $module);

          }

          if (isset($quote['error'])) {

            $_SESSION['shipping'] = '';

          } else {

            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {

              $_SESSION['shipping'] = array('id' => $_SESSION['shipping'],

                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),

                                'cost' => $quote[0]['methods'][0]['cost']);



              zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

            }

          }

        } else {

          $_SESSION['shipping'] = false;

        }

      }

    } else {

      $_SESSION['shipping'] = false;



      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

    }

  }
//----------------------------------- 2010 3 22 add by wu -------------------------------------//
//--------- 这里新增如果用户的shipping地址和billing地址不存在,那么就跳转页面 让用户去填写相应的地址
//----新增 如果用户邮箱也为空,那么也跳转
$check_exist_address_sql = "select * from " . TABLE_ADDRESS_BOOK . " where customers_id = " . $_SESSION['customer_id'];
$check_exist_address = $db->Execute($check_exist_address_sql);

$check_exist_email_sql = "select * from " . TABLE_CUSTOMERS . " where customers_id = " . $_SESSION['customer_id'];
$check_exist_email = $db->Execute($check_exist_email_sql);

if($check_exist_address->RecordCount()<1 || $check_exist_email->fields['customers_email_address'] == ''){
    zen_redirect(zen_href_link('address_book_new', '', 'SSL'));
}
//----------------------------------- 2010 3 22 over ------------------------------------------//


// get all available shipping quotes

  $quotes = $shipping_modules->quote();



// if no shipping method has been selected, automatically select the cheapest method.

// if the modules status was changed when none were available, to save on implementing

// a javascript force-selection method, also automatically select the cheapest shipping

// method if more than one module is now enabled

  if ( !$_SESSION['shipping'] || ( $_SESSION['shipping'] && ($_SESSION['shipping'] == false) && (zen_count_shipping_modules() > 1) ) ) $_SESSION['shipping'] = $shipping_modules->cheapest();





  // Should address-edit button be offered?

  $displayAddressEdit = (MAX_ADDRESS_BOOK_ENTRIES >= 2);



  // if shipping-edit button should be overridden, do so

  $editShippingButtonLink = zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL');	

  if (isset($_SESSION['payment']) && method_exists($$_SESSION['payment'], 'alterShippingEditButton')) {

    $theLink = $$_SESSION['payment']->alterShippingEditButton();

    if ($theLink) {

      $editShippingButtonLink = $theLink;

      $displayAddressEdit = true;

    }

  }
//------------------------------------ 合并shipping 和payment 2010 03 24 -------------------------------------//
require_once(DIR_WS_CLASSES . 'order.php');
$order = new order;
// Load the selected shipping module(needed to calculate tax correctly)
require_once(DIR_WS_CLASSES . 'order_total.php');
$order_total_modules = new order_total;
$coupon = $order_total_modules->collect_posts();
$order_total_modules->pre_confirmation_check();

$total_weight = $_SESSION['cart']->show_weight();
$total_count = $_SESSION['cart']->count_contents();

require_once(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment;
$flagOnSubmit = sizeof($payment_modules->selection());
//print_r($payment_modules->selection());

require_once(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

if (isset($_GET['payment_error']) && is_object(${$_GET['payment_error']}) && ($error = ${$_GET['payment_error']}->get_error())) {
  $messageStack->add('checkout_payment', $error['error'], 'error');
}
//-------------------------------------------------------------------------------------------------------------//

// update customers_referral with $_SESSION['gv_id']
if ($_SESSION['cc_id']) {
  $discount_coupon_query = "SELECT coupon_code
                            FROM " . TABLE_COUPONS . "
                            WHERE coupon_id = :couponID";

  $discount_coupon_query = $db->bindVars($discount_coupon_query, ':couponID', $_SESSION['cc_id'], 'integer');
  $discount_coupon = $db->Execute($discount_coupon_query);

  $customers_referral_query = "SELECT customers_referral
                               FROM " . TABLE_CUSTOMERS . "
                               WHERE customers_id = :customersID";

  $customers_referral_query = $db->bindVars($customers_referral_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $customers_referral = $db->Execute($customers_referral_query);

  // only use discount coupon if set by coupon
  if ($customers_referral->fields['customers_referral'] == '' and CUSTOMERS_REFERRAL_STATUS == 1) {
    $sql = "UPDATE " . TABLE_CUSTOMERS . "
            SET customers_referral = :customersReferral
            WHERE customers_id = :customersID";

    $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
    $sql = $db->bindVars($sql, ':customersReferral', $discount_coupon->fields['coupon_code'], 'string');
    $db->Execute($sql);
  } else {
    // do not update referral was added before
  }
}

  $breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));

  $breadcrumb->add(NAVBAR_TITLE_2);



// This should be last line of the script:

  $zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_SHIPPING');

?>