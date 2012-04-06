<?php
/**
 * Header code file for the Account History Information/Details page (which displays details for a single specific order)
 *
 * @package page
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 2943 2006-02-02 15:56:09Z wilt $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ACCOUNT_HISTORY_INFO');
define('COLUMN_LEFT_NONE', 'true');
if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
  zen_redirect(zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

$customer_info_query = "SELECT customers_id
                        FROM   " . TABLE_ORDERS . "
                        WHERE  orders_id = :ordersID";

//$customer_info_query = $db->bindVars($customer_info_query, ':ordersID', $_GET['order_id'], 'integer');
$customer_info_query = $db->bindVars($customer_info_query, ':ordersID', $_GET['order_id'], 'string');
$customer_info = $db->Execute($customer_info_query);

if ($customer_info->fields['customers_id'] != $_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

$statuses_query = "SELECT os.orders_status_name, osh.date_added, osh.comments, os.orders_status_id
                   FROM   " . TABLE_ORDERS_STATUS . " os, " . TABLE_ORDERS_STATUS_HISTORY . " osh
                   WHERE      osh.orders_id = :ordersID
                   AND        osh.orders_status_id = os.orders_status_id
                   AND        os.language_id = :languagesID
                   ORDER BY   osh.date_added";
//$statuses_query = $db->bindVars($statuses_query, ':ordersID', $_GET['order_id'], 'integer');
$statuses_query = $db->bindVars($statuses_query, ':ordersID', $_GET['order_id'], 'string');
$statuses_query = $db->bindVars($statuses_query, ':languagesID', $_SESSION['languages_id'], 'integer');
$statuses = $db->Execute($statuses_query);

while (!$statuses->EOF) {

  $statusArray[] = array('date_added'=>$statuses->fields['date_added'],
  'orders_status_name'=>$statuses->fields['orders_status_name'],
  'comments'=>$statuses->fields['comments'],
  'orders_status_id' => $statuses->fields['orders_status_id']);

  $statuses->MoveNext();
}


require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(sprintf(NAVBAR_TITLE_3, $_GET['order_id']));

require(DIR_WS_CLASSES . 'order.php');
$order = new order($_GET['order_id']);


//-----------------------------加载各种支付方式--------------------------------------//
require_once(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment();
$payment_modules -> paymentr();
//print_r($payment_modules);
$selection = $payment_modules->selection();
//print_r($selection);
if (!$payment_modules->in_special_checkout())
{
	$selection = $payment_modules->selection();
	//print_r($selection);
}
foreach($selection as $value)
{
	$payment_method[$value['id']]=$value['title'];
}

//-----------------------------------------------------------------------------------//

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ACCOUNT_HISTORY_INFO');
?>