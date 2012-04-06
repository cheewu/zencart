<?php
/**
 * ipn_test_return.php used in IPN testing to simulate return from paypal website
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: nochex_apc_test_return.php 6359 2007-05-22 22:06:30Z wilt $
 */
/**
 * require application_top.php
 */
require('includes/application_top.php');
//Data cleaning
switch(MODULE_PAYMENT_NOCHEX_ACCOUNT_TYPE){
  case 'Seller':
    $cancelUrl = $_POST['cancelurl'];
  break;
  case 'Merchant':
    $cancelUrl = $_POST['cancel_url'];
  break;
}
//Deal with cancel button
if (isset($_POST['cancel']) && $_POST['cancel'] == 'cancel') {
  zen_redirect($cancelUrl);
  exit();
}

// Standard Payment
if ($paypal_type == 'standard') {
  $payment_status = 'Completed';
  $payment_type = 'instant';
  $mc_currency = 'USD';
  $txn_id = md5($_POST['custom'] . $_POST['amount'] . time());
  $txn_id = substr($txn_id, 0, 17);
  $payer_id = md5($_POST['business']);
  $payer_id = substr($payer_id, 0, 32);
  $business = $_POST['business'];
  $receiver_email = MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS;
  $receiver_id = md5($receiver_email);
  $receiver_id = substr($receiver_id, 0, 32);
  $mc_gross = $_POST['amount'];
  $paypal_testing = array('txn_type'=>'',
                        'reason_code'=>'',
                        'payment_type'=>$payment_type,
                        'payment_status'=>$payment_status,
                        'pending_reason'=>'',
                        'invoice'=>'',
                        'mc_currency'=>$mc_currency,
                        'first_name'=>$_POST['first_name'],
                        'last_name'=>$_POST['last_name'],
                        'payer_business_name'=>'',
                        'address_name'=>'',
                        'address_street'=>$_POST['address1'],
                        'address_city'=>$_POST['city'],
                        'address_state'=>$_POST['state'],
                        'address_zip'=>$_POST['zip'],
                        'address_country'=>$_POST['country'],
                        'address_status'=>'',
                        'payer_email'=>$_POST['email'],
                        'payer_id'=>$payer_id,
                        'payer_status'=>'Confirmed',
                        'payment_date'=>'now()',
                        'business'=>$business,
                        'receiver_email'=>$receiver_email,
                        'receiver_id'=>$receiver_id,
                        'txn_id'=>$txn_id,
                        'parent_txn_id'=>'',
                        'num_cart_items'=>'',
                        'mc_gross'=>$mc_gross,
                        'mc_fee'=>'',
                        'payment_gross'=>'',
                        'payment_fee'=>'',
                        'settle_amount'=>'',
                        'settle_currency'=>'',
                        'exchange_rate'=>'',
                        'notify_version'=>'1.3.0',
                        'verify_sign'=>'',
                        'last_modified'=>'',
                        'date_added'=>'now()',
                        'custom'=>$_POST['custom'],
                        'memo'=>'');
                        
  zen_db_perform(TABLE_PAYPAL_TESTING, $paypal_testing);
}

// Test Refund if selected
$count = 1;
if ($paypal_type == 'refund') {
  $count=2;
  $payment_status = 'Refunded';
  $payment_type = 'instant';
  $mc_currency = 'USD';
  $parent_txn_id = $txn_id;
  $txn_id = md5($_POST['custom'] . $_POST['amount'] . time());
  $txn_id = substr($txn_id, 0, 17);
  $payer_id = md5($_POST['business']);
  $payer_id = substr($payer_id, 0, 32);
  $business = $_POST['business'];
  $receiver_email = MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS;
  $receiver_id = md5($receiver_email);
  $receiver_id = substr($receiver_id, 0, 32);
  $mc_gross = $_POST['amount'];
  $paypal_testing = array('txn_type'=>'',
                        'reason_code'=>'refund',
                        'payment_type'=>$payment_type,
                        'payment_status'=>$payment_status,
                        'pending_reason'=>'refund',
                        'invoice'=>'',
                        'mc_currency'=>$mc_currency,
                        'first_name'=>$_POST['first_name'],
                        'last_name'=>$_POST['last_name'],
                        'payer_business_name'=>'',
                        'address_name'=>'',
                        'address_street'=>$_POST['address1'],
                        'address_city'=>$_POST['city'],
                        'address_state'=>$_POST['state'],
                        'address_zip'=>$_POST['zip'],
                        'address_country'=>$_POST['country'],
                        'address_status'=>'',
                        'payer_email'=>$_POST['email'],
                        'payer_id'=>$payer_id,
                        'payer_status'=>'Confirmed',
                        'payment_date'=>'now()',
                        'business'=>$business,
                        'receiver_email'=>$receiver_email,
                        'receiver_id'=>$receiver_id,
                        'txn_id'=>$txn_id,
                        'parent_txn_id'=>$parent_txn_id,
                        'num_cart_items'=>'',
                        'mc_gross'=>$mc_gross,
                        'mc_fee'=>'',
                        'payment_gross'=>'',
                        'payment_fee'=>'',
                        'settle_amount'=>'',
                        'settle_currency'=>'',
                        'exchange_rate'=>'',
                        'notify_version'=>'1.3.0',
                        'verify_sign'=>'',
                        'last_modified'=>'',
                        'date_added'=>'now()',
                        'custom'=>$_POST['custom'],
                        'memo'=>'');


  zen_db_perform(TABLE_PAYPAL_TESTING, $paypal_testing);
}
$returnURL = $_POST['return'];
$returnURL .= '&count=' . $count;
zen_redirect($returnURL);
?>