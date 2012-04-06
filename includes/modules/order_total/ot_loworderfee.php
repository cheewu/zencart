<?php
/**
 * ot_total order-total module
 *
 * @package orderTotal
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_loworderfee.php 6101 2007-04-01 10:30:22Z wilt $
 */
  class ot_loworderfee {
    var $title, $output;

    function ot_loworderfee() {
      $this->code = 'ot_loworderfee';
      $this->title = MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_LOWORDERFEE_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;

      if (MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE == 'true') {
        switch (MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION) {
          case 'national':
            if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
          case 'international':
            if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
          case 'both':
            $pass = true; break;
          default:
            $pass = false; break;
        }

//        if ( ($pass == true) && ( ($order->info['total'] - $order->info['shipping_cost']) < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) {
        if ( ($pass == true) && ( $order->info['subtotal'] < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) {
          $charge_it = 'true';
          $cart_content_type = $_SESSION['cart']->get_content_type();
          $gv_content_only = $_SESSION['cart']->gv_only();
          if ($cart_content_type == 'physical' or $cart_content_type == 'mixed') {
            $charge_it = 'true';
          } else {
            // check to see if everything is virtual, if so - skip the low order fee.
            if ((($cart_content_type == 'virtual') and MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL == 'true')) {
              $charge_it = 'false';
              if ((($gv_content_only > 0) and MODULE_ORDER_TOTAL_LOWORDERFEE_GV == 'false')) {
                $charge_it = 'true';
              }
            }

            if ((($gv_content_only > 0) and MODULE_ORDER_TOTAL_LOWORDERFEE_GV == 'true')) {
            // check to see if everything is gift voucher, if so - skip the low order fee.
              $charge_it = 'false';
              if ((($cart_content_type == 'virtual') and MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL == 'false')) {
                $charge_it = 'true';
              }
            }
          }

          if ($charge_it == 'true') {
            $tax_address = zen_get_tax_locations();
            $tax = zen_get_tax_rate(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $tax_address['country_id'], $tax_address['zone_id']);
            $tax_description = zen_get_tax_description(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $tax_address['country_id'], $tax_address['zone_id']);

// calculate from flat fee or percentage
            if (substr(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, -1) == '%') {
              $low_order_fee = ($order->info['subtotal'] * (MODULE_ORDER_TOTAL_LOWORDERFEE_FEE/100));
            } else {
              $low_order_fee = MODULE_ORDER_TOTAL_LOWORDERFEE_FEE;
            }


            $order->info['tax'] += zen_calculate_tax($low_order_fee, $tax);
            $order->info['tax_groups']["$tax_description"] += zen_calculate_tax($low_order_fee, $tax);
            $order->info['total'] += $low_order_fee + zen_calculate_tax($low_order_fee, $tax);
            if (DISPLAY_PRICE_WITH_TAX == 'true') {
              $low_order_fee += zen_calculate_tax($low_order_fee, $tax);
            }

            $this->output[] = array('title' => $this->title . ':',
                                    'text' => $currencies->format($low_order_fee, true, $order->info['currency'], $order->info['currency_value']),
                                    'value' => $low_order_fee);
          }
        }
      }
    }

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = "select configuration_value
                        from " . TABLE_CONFIGURATION . "
                        where configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS'";

        $check_query = $db->Execute($check_query);
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('该模块已安装', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('排序顺序', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '400', '显示的排序顺序。', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('收取低额订单费', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', '您要收取低额订单费用吗?', '6', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('收取低额订单费的订单金额', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', '总金额低于该值的订单收取低额订单费', '6', '4', 'currencies->format', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('低额订单费', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', '按百分比收取 - 包含符号 % 例如: 10%<br />收取固定金额 - 例如: 输入 5 表示 5元', '6', '5', '', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('低额订单费适用的送货地区', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', '该送货地区收取低额订单费。', '6', '6', 'zen_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税率种类', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', '低额订单费使用下面的税率种类。', '6', '7', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('虚拟商品无低额订单费', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 'false', '购物车中只有虚拟商品时，不收取低额订单费', '6', '8', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('礼券无低额订单费', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 'false', '购物车中只有礼券时，不收取低额订单费', '6', '9', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    }

    function remove() {
	  global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>