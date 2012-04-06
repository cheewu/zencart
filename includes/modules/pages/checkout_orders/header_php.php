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
  $zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_PROCESS');
  define('COLUMN_LEFT_NONE', 'true');
  $this_is_confirm_page = true;
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
error_reporting(E_ALL ^ E_NOTICE);
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
foreach($selection  as $value)
{
	$payment_method[$value['id']]=$value['title'];
}
//-------------------------------------------- 验证eof -----------------------------------------------------//
if(isset($_POST['source_curr_order_id'])&& preg_match('/^[0-9]+$/',$_POST['source_curr_order_id']))
{
	$select_order_sql="select orders_id from " . TABLE_ORDERS . " where orders_id = :orders_id";
	$select_order_sql = $db->bindVars($select_order_sql, ':orders_id', $_POST['source_curr_order_id'], 'string');
	$source_curr_order_id=$db->Execute($select_order_sql);
	$order_no="";
	while(!$source_curr_order_id->EOF)
	{
		$order_no=$source_curr_order_id->fields['orders_id'];
		$source_curr_order_id->MoveNext();
	}
	if($order_no!="")
	{
		require(DIR_WS_CLASSES . 'order.php');
		$_SESSION['create_order_no']=$order_no;
		$order=new order($order_no);
		$order_payment=$order->info['payment_module_code'];
		if($_POST['act']=='ajax')
		{
			$order_payment=$_POST['payment'];
		}
		$current_payment_modules = new payment($order_payment);
		$current_payment_modules->update_status();
        $current_payment_modules->set_email_information();
		if (is_array($current_payment_modules->modules))
		{
			//$current_payment_modules->pre_confirmation_check();
		}
		if (isset($$order_payment->form_action_url))
		{
			$target="_blank";
			$form_action_url = $$order_payment->form_action_url;
		} else if ($order_payment == 'cc') {
            $form_action_url = zen_href_link('checkout_payment_process', '', 'SSL');
        }
		else
		{
			$target="_self";
			$form_action_url = zen_href_link('account', '', 'SSL');
		}
		if($_POST['act']=='ajax')
		{
			$update_order_sql="update " . TABLE_ORDERS . " set payment_method='".$payment_method[$order_payment]."',payment_module_code='".$order_payment."' where orders_id = :orders_id";
			$update_order_sql = $db->bindVars($update_order_sql, ':orders_id', $_POST['source_curr_order_id'], 'string');
			$db->Execute($update_order_sql);
			echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" target="'.$target.'"');
			if (is_array($current_payment_modules->modules) && $order_payment != 'cc')
			{
				echo $current_payment_modules->process_button();
			}
            echo zen_draw_hidden_field('payment_module', $order_payment);
            echo zen_draw_hidden_field('re_order_id', $_POST['source_curr_order_id']);
			echo "<div class='buttonRow forward'>".zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, "name='btn_submit' id='btn_submit'")."</div></form>";
			exit;
		}
	}
	else
	{	
		if($_POST['act']=='ajax')
		{
			echo 'the order on is not exists';
			exit;
		}
		$messageStack->add('checkout_order',"the order on is not exists", 'error');
	}
}
else
{
	if($_POST['act']=='ajax')
	{
		echo 'the order on is not exists';
		exit;
	}
	$messageStack->add('checkout_order',"the order on is not exists", 'error');
}






//$payment_modules = new payment($_SESSION['payment']);






/*
{
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
$payment_modules->update_status();
if (($_SESSION['payment'] == '' && !$credit_covers) || (is_array($payment_modules->modules)) && (sizeof($payment_modules->modules) > 1) && (!is_object($$_SESSION['payment'])) && (!$credit_covers)) {
  $messageStack->add_session('checkout_payment', ERROR_NO_PAYMENT_MODULE_SELECTED, 'error');
}
if (is_array($payment_modules->modules)) {
  $payment_modules->pre_confirmation_check();
}
if ($messageStack->size('checkout_payment') > 0) {
  zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
}
//------------------------------ payment eof -----------------------------------//
require(DIR_WS_MODULES . zen_get_module_directory('checkout_process.php'));
if (isset($$_SESSION['payment']->form_action_url)) {
  $form_action_url = $$_SESSION['payment']->form_action_url;
} else {
  $form_action_url = zen_href_link('checkout_success', '', 'SSL');
}
$total_pay = $_POST['_total'];
  
  } else {  // 否则直接跳转至购物车页面
    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));
  }
  */
?>