<?php

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
$account_query = "SELECT customers_firstname, customers_lastname, customers_email_address
				FROM " . TABLE_CUSTOMERS . "
				WHERE customers_id = :customersID";

$account_query = $db->bindVars($account_query, ':customersID', $_SESSION['customer_id'], 'integer');
$account = $db->Execute($account_query);

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$breadcrumb->add(NAVBAR_TITLE);
$orders_query = "SELECT c.customers_id,c.customers_firstname,c.customers_lastname,cf.customers_info_date_account_created,o.order_total as order_total  FROM  (" . TABLE_CUSTOMERS . " c INNER JOIN ".TABLE_CUSTOMERS_INFO." cf ON c.customers_id=cf.customers_info_id ) LEFT JOIN " . TABLE_ORDERS . " o ON c.customers_id=o.customers_id WHERE o.orders_status in (2,3,4) and c.customers_id IN (SELECT cv.customers_id FROM " . TABLE_CUSTOMERS . " cv WHERE cv.customers_ref_id=:customersID)";

//$orders_query = "SELECT c.customers_firstname,c.customers_lastname,cf.customers_info_date_account_created FROM  (" . TABLE_CUSTOMERS . " c,".TABLE_CUSTOMERS_INFO." cf) LEFT JOIN " . TABLE_ORDERS . " o ON c.customers_id=o.customers_id WHERE c.customers_id=cf.customers_info_id AND o.orders_status IN (2,3,4) AND c.customers_id IN (SELECT cv.customers_id FROM " . TABLE_CUSTOMERS . " cv WHERE cv.customers_ref_id=17)";


$orders_query = $db->bindVars($orders_query, ':customersID', $_SESSION['customer_id'], 'integer');
$orders_split = new splitPageResults($orders_query, MAX_DISPLAY_ORDER_HISTORY);
//echo $orders_split->sql_query;
$orders = $db->Execute($orders_split->sql_query);
$ordersArray = array();
while (!$orders->EOF)
{
  $ordersArray[$orders->fields['customers_id']] = array('customers'=>$orders->fields['customers_firstname']." ".$orders->fields['customers_lastname'],
  'customers_created'=>$orders->fields['customers_info_date_account_created'],
  'order_total'=>$order_total+=$orders->fields['order_total']
  );

  $orders->MoveNext();
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ACCOUNT');
?>