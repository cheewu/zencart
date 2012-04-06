<?php
/**
 * Checkout Process Page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4276 2006-08-26 03:18:28Z drbyte $
 */
// This should be first line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_PROCESS');//echo '<pre>';print_r($_POST);print_r($_SESSION);die();
  define('COLUMN_LEFT_NONE', 'true');
  $this_is_confirm_page = true;
    //----------------------- 以下处理从历史订单里提交过来的信息
    //-------这里仿照lightinthebox的处理方式,有些改动,就是凡是从历史订单来的再付款,就将订单里的产品添加至购物车,用户从购物车中再选择
    //-------以哪种方式付款
    function zens_array_rever($array1){
        $option = 0;    //这里数组需要转换下,因为添加购物车用的attributes和从订单里取出来的attributes的结构是不一样的
        foreach($array1 as $key => $value){
            //foreach($value as $ke => $val){
                $array[$value['option_id']] = $value['values_id'];
            //}
        }
        return $array;        
    }
    function zens_array_equ($array1, $array2){   //用来比较两个字符串是否相等,主要由于可能存在多个属性的产品,在这里进行比较,确保第一个为订单的属性数组
        ksort($array1);
        ksort($array2);//print_r($array1);print_r($array2); echo '<br>||<br>';
        foreach($array1 as $key => $value){
            if($array1[$key] != $array2[$key]){
                return false;
            }
        }
        return true;
    }
    
    //------------------------------ 验证登录信息 -------------------------------------------------//
    
  require_once(DIR_WS_CLASSES . 'http_client.php');
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
//get user email
$user_email=$db->Execute("select customers_email_address from customers where customers_id=".$_SESSION['customer_id']);
while(!$user_email->EOF)
{
	$customers_email_address=$user_email->fields['customers_email_address'];
	$user_email->MoveNext();
}

// load the selected payment module
require(DIR_WS_CLASSES . 'payment.php');
if ($credit_covers) {
  unset($_SESSION['payment']);
  $_SESSION['payment'] = '';
}
if (isset($_POST['payment'])) $_SESSION['payment'] = $_POST['payment'];
$_SESSION['comments'] = zen_db_prepare_input($_POST['comments']);
//@debug echo ($credit_covers == true) ? 'TRUE' : 'FALSE';
$payment_modules = new payment($_SESSION['payment']);
//print_r($payment_modules);
$payment_modules->update_status();
if (($_SESSION['payment'] == '' && !$credit_covers) || (is_array($payment_modules->modules)) && (sizeof($payment_modules->modules) > 1) && (!is_object($$_SESSION['payment'])) && (!$credit_covers)) {
  $messageStack->add_session('checkout_payment', ERROR_NO_PAYMENT_MODULE_SELECTED, 'error');
}
if (is_array($payment_modules->modules)){
  $payment_modules->pre_confirmation_check();
}
if ($messageStack->size('checkout_payment') > 0) {
  zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
}
//------------------------------ payment eof -----------------------------------//
require_once(DIR_WS_CLASSES . 'order.php');
$order = new order($_POST['order_no']);
$payment_modules->after_order_create($_POST['order_no']);
$payment_modules->after_process();
?>