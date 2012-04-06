<?php
/**
 * Header code file for the customer's Account page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4824 2006-10-23 21:01:28Z drbyte $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ACCOUNT');
define('COLUMN_LEFT_NONE', 'true');
$customer_has_gv_balance = false;
$customer_gv_balance = false;

if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}
$gv_query = "SELECT amount
             FROM " . TABLE_COUPON_GV_CUSTOMER . "
             WHERE customer_id = :customersID";

$gv_query = $db->bindVars($gv_query, ':customersID', $_SESSION['customer_id'], 'integer');
$gv_result = $db->Execute($gv_query);

if ($gv_result->RecordCount() && $gv_result->fields['amount'] > 0 ) {
  $customer_has_gv_balance = true;
  $customer_gv_balance = $currencies->format($gv_result->fields['amount']);
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$breadcrumb->add(NAVBAR_TITLE);
$orders_query = "SELECT o.orders_id, o.date_purchased, o.delivery_name,
                        o.delivery_country, o.billing_name, o.billing_country,
                        ot.text as order_total, s.orders_status_name, s.orders_status_id
                 FROM   " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . "  ot, " . TABLE_ORDERS_STATUS . " s
                 WHERE  o.customers_id = :customersID
                 AND    o.orders_id = ot.orders_id
                 AND    ot.class = 'ot_total'
                 AND    o.orders_status = s.orders_status_id
                 AND   s.language_id = :languagesID
                 ORDER BY   orders_id DESC";    //从这里开始,显示所有订单记录

$orders_query = $db->bindVars($orders_query, ':customersID', $_SESSION['customer_id'], 'integer');
$orders_query = $db->bindVars($orders_query, ':languagesID', $_SESSION['languages_id'], 'integer');
$orders_split = new splitPageResults($orders_query, MAX_DISPLAY_ORDER_HISTORY);
$orders = $db->Execute($orders_split->sql_query);

$ordersArray = array();
while (!$orders->EOF) {
  if (zen_not_null($orders->fields['delivery_name'])) {
    $order_name = $orders->fields['delivery_name'];
    $order_country = $orders->fields['delivery_country'];
  } else {
    $order_name = $orders->fields['billing_name'];
    $order_country = $orders->fields['billing_country'];
  }

  $ordersArray[] = array('orders_id'=>$orders->fields['orders_id'],
  'date_purchased'=>$orders->fields['date_purchased'],
  'order_name'=>$order_name,
  'order_country'=>$order_country,
  'orders_status_name'=>$orders->fields['orders_status_name'],
  'order_total'=>$orders->fields['order_total'],
  'orders_status_id'=>$orders->fields['orders_status_id']
  );

  $orders->MoveNext();
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ACCOUNT');
?>