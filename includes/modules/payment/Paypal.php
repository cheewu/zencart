<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: offsitepayment.php 1105 2005-04-04 22:05:35Z birdbrain $
//


//------------------ add 2010 5 4 ----------------------//
include_once((IS_ADMIN_FLAG === true ? DIR_FS_CATALOG_MODULES : DIR_WS_MODULES) . 'payment/paypal/paypal_functions.php');
//------------------------------------------------------//

  class Paypal {
    var $code, $title, $description, $enabled;

// class constructor
    function Paypal() {
      global $order;

      $this->code = 'Paypal';
      $this->title = MODULE_PAYMENT_PAYPAL_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYPAL_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PAYPAL_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_PAYPAL_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYPAL_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYPAL_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
				   'title'=>$this->title,
                   'module' => '<img src="images/PayPal-payment.jpg" />' . $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION);
    }

    function set_email_information() {
    // ------------------------------------ add 2010 5 4 ----------------------------------//
    //------------------以下是大部分是从paypal.php中摘过来的
    global $db, $order_tmp, $currencies, $currency;
    $order = $order_tmp;
    $options = array();
    $optionsCore = array();
    $optionsPhone = array();
    $optionsShip = array();
    $optionsLineItems = array();
    $optionsAggregate = array();
    $optionsTrans = array();
    $buttonArray = array();

    $this->totalsum = $order->info['total'];

    // save the session stuff permanently in case paypal loses the session

    $my_currency = select_pp_currency();
    $this->transaction_currency = $my_currency;

    $this->transaction_amount = ($this->totalsum * $currencies->get_value($my_currency));

    $telephone = preg_replace('/\D/', '', $order->customer['telephone']);
    if ($telephone != '') {
      $optionsPhone['H_PhoneNumber'] = $telephone;
      if (in_array($order->customer['country']['iso_code_2'], array('US','CA'))) {
        $optionsPhone['night_phone_a'] = substr($telephone,0,3);
        $optionsPhone['night_phone_b'] = substr($telephone,3,3);
        $optionsPhone['night_phone_c'] = substr($telephone,6,4);
        $optionsPhone['day_phone_a'] = substr($telephone,0,3);
        $optionsPhone['day_phone_b'] = substr($telephone,3,3);
        $optionsPhone['day_phone_c'] = substr($telephone,6,4);
    } else {
        $optionsPhone['night_phone_b'] = $telephone;
        $optionsPhone['day_phone_b'] = $telephone;
      }
    }
//print_r($order->customer);die();
    $optionsCust = array(
                   'first_name' => replace_accents($order->customer['firstname']),
                   'last_name' => replace_accents($order->customer['lastname']),
                   'address1' => replace_accents($order->customer['street_address']),
                   'city' => replace_accents($order->customer['city']),
                   'state' => zen_get_zone_code($order->customer['country']['id'], $order->customer['zone_id'], $order->customer['zone_id']),
                   'zip' => $order->customer['postcode'],
                   'country' => $order->customer['country']['iso_code_2'],
                   'email' => $order->customer['email_address'],
                   );
    if ($order->customer['suburb'] != '') $optionsCust['address2'] = $order->customer['suburb'];

	$optionsAggregate = array(
                   'cmd' => '_ext-enter',
                   'item_name' => $_SESSION['create_order_no'],
                   'item_number' => $_SESSION['create_order_no'],
                   //'num_cart_items' => sizeof($order->products),
                   'amount' => number_format($this->transaction_amount, $currencies->get_decimal_places($my_currency)),
                   'shipping' => '0.00',
                    );


    // if line-item info is invalid, use aggregate:
    if (sizeof($optionsLineItems) > 0) $optionsAggregate = $optionsLineItems;

    // prepare submission
    $options = array_merge($optionsCore, $optionsCust, $optionsPhone, $optionsShip, $optionsTrans, $optionsAggregate);

    //---------------- 这是自定义的
    //$websrc = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=' . MODULE_PAYMENT_PAYPAL_BUSINESS_ID .
    $order_id = isset($_GET['order_id'])?$_GET['order_id']:$_SESSION['create_order_no'];
    $websrc = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=' . MODULE_PAYMENT_PAYPAL_PAYPAL_ACCOUT .
                '&amount=' . number_format($this->transaction_amount, $currencies->get_decimal_places($my_currency)) .
                '&item_name=ORDER' . $order_id .
                '&currency_code=' . $my_currency;
    $websrc_t = 'http://' . MODULE_PAYMENT_PAYPAL_URL . '?cmd=_xclick&business=' . MODULE_PAYMENT_PAYPAL_PAYPAL_ACCOUT .
                '&amount=' . number_format($this->transaction_amount, $currencies->get_decimal_places($my_currency)) .
                '&item_name=ORDER' . $order_id .
                '&currency_code=' . $my_currency;

    foreach($optionsCust as $key => $value){
        $websrc_t .= '&' . $key . '=' . $value;
    }
    foreach($optionsPhone as $key => $value){
        $websrc_t .= '&' . $key . '=' . $value;
    }

    $websrc_string = EMAIL_TEXT_PAYMENT_METHOD . "<br />\n";
    /*$websrc_string .= EMAIL_PAYMENT_WEBSRC_LINK_PRE . "<br />" .
                '<a target="_blank" href="' . $websrc . '">' . EMAIL_PAYMENT_WEBSRC_LINK_PAY_BUTTON . '</a>' . "<br />" .
                EMAIL_PAYMENT_WEBSRC_LINK_CON1 . '<a target="_blank" href="' . $websrc . '">' . EMAIL_PAYMENT_WEBSRC_LINK_PAY_NOW . '</a>' .
                EMAIL_PAYMENT_WEBSRC_LINK_CON2 . "<br />";*/
    $websrc_string .= EMAIL_PAYMENT_WEBSRC_LINK_PRE . "<br />\n" . $websrc . "\n<br />" .
                EMAIL_PAYMENT_WEBSRC_LINK_CON2 . "\n<br />";

    define('EMAIL_PAYMENT_WEBSRC_LINK', $websrc_string);
    $this->form_action_url = $websrc_t;
    //-----------------------------------------------//
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Offsite Payment Module', 'MODULE_PAYMENT_PAYPAL_STATUS', 'True', 'Do you want to accept Offsite payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Supported Payment Methods:', 'MODULE_PAYMENT_PAYPAL_SUPPORTED', '', 'Accepted Alternative Payment methods? (i.e. Paypal, Personal Check)', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPAL_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order) values ('Set paypal account', 'MODULE_PAYMENT_PAYPAL_PAYPAL_ACCOUT', '0', 'Set the pay for account', '6', '0')");
	  $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order) values ('Paypal url', 'MODULE_PAYMENT_PAYPAL_URL', 'www.saperai.com/paypal.php', 'paypal url', '6', '0')");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_PAYPAL_STATUS', 'MODULE_PAYMENT_PAYPAL_ZONE', 'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_SUPPORTED','MODULE_PAYMENT_PAYPAL_PAYPAL_ACCOUT','MODULE_PAYMENT_PAYPAL_URL');
    }
  }
?>
