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
	$customers_email_address=$user_email->fields['orders_id'];
	$user_email->MoveNext();
}
//-------------------------------------------- 验证eof -----------------------------------------------------//

    
    
    if(isset($_POST['source'])&&$_POST['source'] == 'view_orders'){ //------------- 这里是将订单中的物品重新添加进购物车
        require(DIR_WS_CLASSES . 'order.php');
        $order = new order((int)$_POST['source_curr_order_id']);
        
        $products = $_SESSION['cart']->get_products();
      for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
        $qty_cart = 0;
        unset($array_cart);
        $array_cart = zens_array_rever($order->products[$i]['attributes']);
        foreach($products as $key => $values){
            if((int)$order->products[$i]['id'] == (int)$values['id'] && zens_array_equ($array_cart, $values['attributes'])){
                $qty_cart = $values['quantity'];
            }
        }
        $_SESSION['cart']->add_cart($order->products[$i]['id'], $order->products[$i]['qty']+$qty_cart, $array_cart);
        }
        zen_redirect(zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
    }

    //----------------------- 以下处理正常添加购物车，正常付款的paypal ------------------------------------// 
    
    else if(isset($_POST['source'])&&$_POST['source'] == 'pay_orders'){
//------------------------------ shipping --------------------------------------//
// register a random ID in the session to check throughout the checkout procedure
   if($_SESSION['cart']->count_contents() <= 0){
        zen_redirect(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
    }
// against alterations in the shopping cart contents
  $_SESSION['cartID'] = $_SESSION['cart']->cartID;
  $total_weight = $_SESSION['cart']->show_weight();
  $total_count = $_SESSION['cart']->count_contents();
// process the selected shipping method
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
              //zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          $_SESSION['shipping'] = false;
        }
      }
    } else {
      $_SESSION['shipping'] = false;
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
$_SESSION['sendto'] = $_POST['shipping_address_id'];
$_SESSION['billto'] = $_POST['billing_address_id'];
//------------------------------ shipping eof ----------------------------------//
//------------------------------ payment ---------------------------------------//
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

require(DIR_WS_MODULES . zen_get_module_directory('checkout_process.php'));

if (isset($$_SESSION['payment']->form_action_url))
{
	$target="_blank";
	$form_action_url = $$_SESSION['payment']->form_action_url;
}
else 
{
	$target="_self";
	$form_action_url = zen_href_link('account', '', 'SSL');
}
$total_pay = $_POST['_total'];
  
  } else if($_POST['payment_module'] == 'cc') {
    require_once(DIR_WS_CLASSES . 'payment.php');
    require_once(DIR_WS_CLASSES . 'order.php');
    $order = new order($_POST['re_order_id']);
    $payment_modules = new payment('cc');
    $payment_modules->after_order_create($_POST['re_order_id']);  //不做大改动,直接拿没用的函数 调用
    $payment_modules->after_process();
  } else {  // 否则直接跳转至购物车页面
    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
  
 }

?>