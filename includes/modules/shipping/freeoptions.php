<?php
/**
 * @package shippingMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: freeoptions.php 4238 2006-08-24 10:01:04Z drbyte $
 */

  class freeoptions extends base {
    var $code, $title, $description, $icon, $enabled;
    var $ck_freeoptions_total, $ck_freeoptions_weight, $ck_freeoptions_items;

// class constructor
    function freeoptions() {
      global $order, $db;

      $this->code = 'freeoptions';
      $this->title = MODULE_SHIPPING_FREEOPTIONS_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_FREEOPTIONS_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_FREEOPTIONS_SORT_ORDER;
      $this->icon = '';
      $this->tax_class = MODULE_SHIPPING_FREEOPTIONS_TAX_CLASS;
      $this->tax_basis = MODULE_SHIPPING_FREEOPTIONS_TAX_BASIS;

      // disable only when entire cart is free shipping
      if (zen_get_shipping_enabled($this->code)) {
          $this->enabled = ((MODULE_SHIPPING_FREEOPTIONS_STATUS == 'True') ? true : false);
      }

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_FREEOPTIONS_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_FREEOPTIONS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->delivery['zone_id']) {
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

// class methods
    function quote($method = '') {
      global $order;
      $order_weight = round($_SESSION['cart']->show_weight(),9);

      // check if anything is configured for total, weight or item
      if ((MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN !='' or MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX !='')) {
        $this->ck_freeoptions_total = true;
      } else {
        $this->ck_freeoptions_total = false;
      }
      if ((MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN !='' or MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX !='')) {
        $this->ck_freeoptions_weight = true;
      } else {
        $this->ck_freeoptions_weight = false;
      }
      if ((MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN !='' or MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX !='')) {
        $this->ck_freeoptions_items = true;
      } else {
        $this->ck_freeoptions_items = false;
      }
      if ($this->ck_freeoptions_total or $this->ck_freeoptions_weight or $this->ck_freeoptions_items) {
        $this->enabled = true;
      } else {
        $this->enabled = false;
      }

      // disabled if nothing validates for total, weight or item
      if ($this->enabled) {
        if ($this->ck_freeoptions_total) {
          switch (true) {
          case ((MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN !='' and MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX !='')):
// free shipping total should not need adjusting
//            if (($_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices()) >= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN and ($_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices()) <= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX) {
            if (($_SESSION['cart']->show_total()) >= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN and ($_SESSION['cart']->show_total()) <= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX) {
              $this->ck_freeoptions_total = true;
            } else {
              $this->ck_freeoptions_total = false;
            }
            break;
          case ((MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN !='')):
//            if (($_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices()) >= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN) {
            if (($_SESSION['cart']->show_total()) >= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN) {
              $this->ck_freeoptions_total = true;
            } else {
              $this->ck_freeoptions_total = false;
            }
            break;
          case ((MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX !='')):
//            if (($_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices()) <= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX) {
            if (($_SESSION['cart']->show_total()) <= MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX) {
              $this->ck_freeoptions_total = true;
            } else {
              $this->ck_freeoptions_total = false;
            }
            break;
          }
        }

        if ($this->ck_freeoptions_weight) {
          switch (true) {
          case ((MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN !='' and MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX !='')):
            if ($order_weight >= MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN and $order_weight <= MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX) {
              $this->ck_freeoptions_weight = true;
            } else {
              $this->ck_freeoptions_weight = false;
            }
            break;
          case ((MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN !='')):
            if ($order_weight >= MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN) {
              $this->ck_freeoptions_weight = true;
            } else {
              $this->ck_freeoptions_weight = false;
            }
            break;
          case ((MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX !='')):
            if ($order_weight <= MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX) {
              $this->ck_freeoptions_weight = true;
            } else {
              $this->ck_freeoptions_weight = false;
            }
            break;
          }
        }

        if ($this->ck_freeoptions_items) {
          switch (true) {
          case ((MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN !='' and MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX !='')):
// free shipping items should not need adjusting
//            if (($_SESSION['cart']->count_contents() - $_SESSION['cart']->free_shipping_items()) >= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN and ($_SESSION['cart']->count_contents() - $_SESSION['cart']->free_shipping_items()) <= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX) {
            if (($_SESSION['cart']->count_contents()) >= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN and ($_SESSION['cart']->count_contents()) <= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX) {
              $this->ck_freeoptions_items = true;
            } else {
              $this->ck_freeoptions_items = false;
            }
            break;
          case ((MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN !='')):
//            if (($_SESSION['cart']->count_contents() - $_SESSION['cart']->free_shipping_items()) >= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN) {
            if (($_SESSION['cart']->count_contents()) >= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN) {
              $this->ck_freeoptions_items = true;
            } else {
              $this->ck_freeoptions_items = false;
            }
            break;
          case ((MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX !='')):
//            if (($_SESSION['cart']->count_contents() - $_SESSION['cart']->free_shipping_items())<= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX) {
            if (($_SESSION['cart']->count_contents())<= MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX) {
              $this->ck_freeoptions_items = true;
            } else {
              $this->ck_freeoptions_items = false;
            }
            break;
          }
        }
      }

/*
echo 'I see count: ' . $_SESSION['cart']->count_contents() . ' free count: ' . $_SESSION['cart']->free_shipping_items() . '<br>' .
'I see weight: ' . $_SESSION['cart']->show_weight() . '<br>' .
'I see total: ' . $_SESSION['cart']->show_total() . ' free price: ' . $_SESSION['cart']->free_shipping_prices() . '<br>' .
'Final check ' . ($this->ck_freeoptions_total ? 'T: YES ' : 'T: NO ') . ($this->ck_freeoptions_weight ? 'W: YES ' : 'W: NO ') . ($this->ck_freeoptions_items ? 'I: YES ' : 'I: NO ') . '<br>';
*/

// final check for display of Free Options
      if ($this->ck_freeoptions_total or $this->ck_freeoptions_weight or $this->ck_freeoptions_items) {
        $this->enabled = true;
      } else {
        $this->enabled = false;
      }

      if ($this->enabled) {
        $this->quotes = array('id' => $this->code,
                              'module' => MODULE_SHIPPING_FREEOPTIONS_TEXT_TITLE,
                              'methods' => array(array('id' => $this->code,
                                                       'title' => MODULE_SHIPPING_FREEOPTIONS_TEXT_WAY,
                                                       'cost'  => MODULE_SHIPPING_FREEOPTIONS_COST + MODULE_SHIPPING_FREEOPTIONS_HANDLING)));
      }

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = zen_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (zen_not_null($this->icon)) $this->quotes['icon'] = zen_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FREEOPTIONS_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('打开免运费选择模块', 'MODULE_SHIPPING_FREEOPTIONS_STATUS', 'True', '免运费选择模块用于在显示其他配送模块时，提供免运费选项。
可以设置为: 总是打开，订单总额，订单重量 或 订单件数。
免运费模块显示时，不会再显示免运费选择模块<br /><br />
设置总额为 >= 0.00 且 <= 无 (留空) 将在除了免运费模块之外的所有配送模块中激活该模块。<br /><br />
说明: 所有总额，种类和数量的设置都为空，将关闭本模块。<br /><br />
说明: 说明: 如果免运费是基于0重量，免运费选择模块将不会显示。
见: 免运费模块<br /><br />您是否要采用免运费选择模块？', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('运费成本', 'MODULE_SHIPPING_FREEOPTIONS_COST', '0.00', '运费的成本为 $0.00', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('手续费', 'MODULE_SHIPPING_FREEOPTIONS_HANDLING', '0', '该配送方式的手续费。', '6', '0', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('总额 >=', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN', '0.00', '免运费要求订单金额 >=', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('总额 <=', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX', '', '免运费要求订单金额 <=', '6', '0', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('重量 >=', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN', '', '免运费要求重量 >=', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('重量 <=', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX', '', '免运费要求重量 <=', '6', '0', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('件数 >=', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN', '', '免运费要求件数 >=', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('件数 <=', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX', '', '免运费要求件数 <=', '6', '0', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税率种类', 'MODULE_SHIPPING_FREEOPTIONS_TAX_CLASS', '0', '计算运费使用的税率种类。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('税率基准', 'MODULE_SHIPPING_FREEOPTIONS_TAX_BASIS', 'Shipping', '计算运费税的基准。选项为<br />Shipping - 基于客户的交货人地址<br />Billing - 基于客户的帐单地址<br />Store - 如果帐单地址/送货地区和商店地区相同，则基于商店地址', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('送货地区', 'MODULE_SHIPPING_FREEOPTIONS_ZONE', '0', '如果选择了地区，仅该地区采用该配送方式。', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('排序顺序', 'MODULE_SHIPPING_FREEOPTIONS_SORT_ORDER', '0', '显示的顺序。', '6', '0', now())");
    }

   function remove() {
     global $db;
     $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE  'MODULE_SHIPPING_FREEOPTIONS_%'");
   }

    function keys() {
      return array('MODULE_SHIPPING_FREEOPTIONS_STATUS', 'MODULE_SHIPPING_FREEOPTIONS_COST', 'MODULE_SHIPPING_FREEOPTIONS_HANDLING', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX', 'MODULE_SHIPPING_FREEOPTIONS_TAX_CLASS', 'MODULE_SHIPPING_FREEOPTIONS_TAX_BASIS', 'MODULE_SHIPPING_FREEOPTIONS_ZONE', 'MODULE_SHIPPING_FREEOPTIONS_SORT_ORDER');
    }
  }
?>