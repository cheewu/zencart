<?php
/**
 * ot_group_pricing order-total module
 *
 * @package orderTotal
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_group_pricing.php 6773 2007-08-21 12:34:05Z drbyte $
 */

class ot_group_pricing {
  var $title, $output;

  function ot_group_pricing() {
    $this->code = 'ot_group_pricing';
    $this->title = MODULE_ORDER_TOTAL_GROUP_PRICING_TITLE;
    $this->description = MODULE_ORDER_TOTAL_GROUP_PRICING_DESCRIPTION;
    $this->sort_order = MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER;
    $this->include_shipping = MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING;
    $this->include_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX;
    $this->calculate_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX;
    $this->tax_class = MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS;
    $this->credit_class = true;
    $this->output = array();
  }

  function process() {
    global $order, $currencies, $db;
    $order_total = $this->get_order_total();
    $od_amount = $this->calculate_deductions($order_total['total']);
    $this->deduction = $od_amount['total'];
    if ($od_amount['total'] > 0) {
      reset($order->info['tax_groups']);
      $tax = 0;
      while (list($key, $value) = each($order->info['tax_groups'])) {
        if ($od_amount['tax_groups'][$key]) {
          $order->info['tax_groups'][$key] -= $od_amount['tax_groups'][$key];
          $tax += $od_amount['tax_groups'][$key];
        }
      }
      if ($od_amount['type'] == 'S') $order->info['shipping_cost'] = 0;
      $order->info['total'] = $order->info['total'] - $od_amount['total'];
      if (DISPLAY_PRICE_WITH_TAX == 'true') {
        $od_amount['total'] += $tax;
      }
      if ($this->calculate_tax == "Standard") $order->info['total'] -= $tax;
      if ($order->info['total'] < 0) $order->info['total'] = 0;
      $order->info['tax'] = $order->info['tax'] - $tax;
      $this->output[] = array('title' => $this->title . ':',
      'text' => '-' . $currencies->format($od_amount['total'], true, $order->info['currency'], $order->info['currency_value']),
      'value' => $od_amount['total']);

    }
  }
  function get_order_total() {
    global  $order;
    $order_total_tax = $order->info['tax'];
    $order_total = $order->info['total'];
    if ($this->include_shipping != 'true') $order_total -= $order->info['shipping_cost'];
    if ($this->include_tax != 'true') $order_total -= $order->info['tax'];
    $orderTotalFull = $order_total;
    $order_total = array('totalFull'=>$orderTotalFull, 'total'=>$order_total, 'tax'=>$order_total_tax);

    return $order_total;
  }
  function calculate_deductions($order_total) {
    global $db, $order;
    $od_amount = array();
    $orderTotal = $this->get_order_total();
    $orderTotalTax = $orderTotal['tax'];
    $group_query = $db->Execute("select customers_group_pricing from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
    if ($group_query->fields['customers_group_pricing'] != '0') {
      $group_discount = $db->Execute("select group_name, group_percentage from " . TABLE_GROUP_PRICING . "
                                      where group_id = '" . (int)$group_query->fields['customers_group_pricing'] . "'");
      $gift_vouchers = $_SESSION['cart']->gv_only();
      $discount = ($order_total - $gift_vouchers) * $group_discount->fields['group_percentage'] / 100;
      $od_amount['total'] = round($discount, 2);
      $ratio = $od_amount['total']/$order_total;
      /**
       * when calculating the ratio add some insignificant values to stop divide by zero errors
       */
      switch ($this->calculate_tax) {
        case 'None':
          if ($this->include_tax) {
            reset($order->info['tax_groups']);
            foreach ($order->info['tax_groups'] as $key=>$value) {
              $od_amount['tax_groups'][$key] = $order->info['tax_groups'][$key] * $ratio;
            }
          }
        break;
        case 'Standard':
          if ($od_amount['total'] >= $order_total) {
            $ratio = 1;
          }
          $adjustedTax = $orderTotalTax * $ratio;
          if ($order->info['tax'] == 0) return $od_amount;
          $ratioTax = $adjustedTax/$order->info['tax'];
          reset($order->info['tax_groups']);
          $tax_deduct = 0;
          foreach ($order->info['tax_groups'] as $key=>$value) {
            $od_amount['tax_groups'][$key] = $order->info['tax_groups'][$key] * $ratioTax;
            $tax_deduct += $od_amount['tax_groups'][$key];
          }
          $od_amount['tax'] = $tax_deduct;
        break;
        case 'Credit Note':
          $tax_rate = zen_get_tax_rate($this->tax_class);
          $od_amount['tax'] = zen_calculate_tax($od_amount['total'], $tax_rate);
          $tax_description = zen_get_tax_description($this->tax_class);
          $od_amount['tax_groups'][$tax_description] = $od_amount['tax'];
        break;
      }
    }
    return $od_amount;
  }
  function pre_confirmation_check($order_total) {
    global $order;
    $od_amount = $this->calculate_deductions($order_total);
    return $od_amount['total'] + $od_amount['tax'];
  }

  function credit_selection() {
    return $selection;
  }

  function collect_posts() {
  }

  function update_credit_account($i) {
  }

  function apply_credit() {
  }
  /**
   * Enter description here...
   *
   */
  function clear_posts() {
  }
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS'");
      $this->_check = $check_query->RecordCount();
    }

    return $this->_check;
  }

  function keys() {
    return array('MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS');
  }

  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('该模块已安装', 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('排序顺序', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', '290', '显示的排序顺序。', '6', '2', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('含运费', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'false', '先算运费再算优惠', '6', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('含税', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'true', '先加税再算优惠', '6', '6','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('重新计算税', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'Standard', '重新计算税', '6', '7','zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税率种类', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', '0', '接受团体优惠时，使用以下的税率种类。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
  }

  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
  }
}
?>