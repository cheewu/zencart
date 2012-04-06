<?php
/**
 * page for Customer to change Payment Address(bill to)
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4793 2006-10-20 05:25:20Z ajeh $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_PAYMENT_ADDRESS');
define('COLUMN_LEFT_NONE', 'true');
// if there is nothing in the customers cart, redirect them to the shopping cart page
if ($_SESSION['cart']->count_contents() <= 0) {
  zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
}

// if the customer is not logged on, redirect them to the login page
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  } else {
    // validate customer
    if (zen_get_customer_validate_session($_SESSION['customer_id']) == false) {
      $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_SHIPPING));
      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
  }

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$addressType = "billto";
require(DIR_WS_MODULES . zen_get_module_directory('checkout_new_address'));
// if no billing destination address was selected, use their own address as default
if (!$_SESSION['billto']) {
  $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
}

$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);

$addresses_count = zen_count_customer_address_book_entries();

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_PAYMENT_ADDRESS');
?>