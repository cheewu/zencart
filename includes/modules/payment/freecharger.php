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
// $Id: freecharger.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  class freecharger {
    var $code, $title, $description, $enabled, $payment;

// class constructor
    function freecharger() {
      global $order;
      $this->code = 'freecharger';
      $this->title = MODULE_PAYMENT_FREECHARGER_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_FREECHARGER_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_FREECHARGER_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_FREECHARGER_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID;
        $payment='freecharger';
      } else {
        if ($payment=='freecharger') {
          $payment='';
        }
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_FREECHARGER_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $db;
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_FREECHARGER_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_FREECHARGER_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_FREECHARGER_TEXT_DESCRIPTION);
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
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_FREECHARGER_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('打开免费支付模块', 'MODULE_PAYMENT_FREECHARGER_STATUS', 'True', '您要使用免费支付模块吗?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('显示顺序', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', '0', '显示顺序：小的显示在前。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('付款地区', 'MODULE_PAYMENT_FREECHARGER_ZONE', '0', '如果选择了付款地区，仅该地区可以使用该支付模块。', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('设置订单状态', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', '0', '设置通过该支付方式付款的订单状态', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_FREECHARGER_STATUS', 'MODULE_PAYMENT_FREECHARGER_ZONE', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER');
    }
  }
?>