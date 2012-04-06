<?php
/**
 * @package shippingMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zones.php 6347 2007-05-20 19:46:59Z ajeh $
 */
/*

  USAGE
  By default, the module comes with support for 3 zones.  This can be
  easily changed by editing the line below in the zones constructor
  that defines $this->num_zones.

  Next, you will want to activate the module by going to the Admin screen,
  clicking on Modules, then clicking on Shipping.  A list of all shipping
  modules should appear.  Click on the green dot next to the one labeled
  zones.php.  A list of settings will appear to the right.  Click on the
  Edit button.

  PLEASE NOTE THAT YOU WILL LOSE YOUR CURRENT SHIPPING RATES AND OTHER
  SETTINGS IF YOU TURN OFF THIS SHIPPING METHOD.  Make sure you keep a
  backup of your shipping settings somewhere at all times.

  If you want an additional handling charge applied to orders that use this
  method, set the Handling Fee field.

  Next, you will need to define which countries are in each zone.  Determining
  this might take some time and effort.  You should group a set of countries
  that has similar shipping charges for the same weight.  For instance, when
  shipping from the US, the countries of Japan, Australia, New Zealand, and
  Singapore have similar shipping rates.  As an example, one of my customers
  is using this set of zones:
    1: USA
    2: Canada
    3: Austria, Belgium, Great Britain, France, Germany, Greenland, Iceland,
       Ireland, Italy, Norway, Holland/Netherlands, Denmark, Poland, Spain,
       Sweden, Switzerland, Finland, Portugal, Israel, Greece
    4: Japan, Australia, New Zealand, Singapore
    5: Taiwan, China, Hong Kong

  When you enter these country lists, enter them into the Zone X Countries
  fields, where "X" is the number of the zone.  They should be entered as
  two character ISO country codes in all capital letters.  They should be
  separated by commas with no spaces or other punctuation. For example:
    1: US
    2: CA
    3: AT,BE,GB,FR,DE,GL,IS,IE,IT,NO,NL,DK,PL,ES,SE,CH,FI,PT,IL,GR
    4: JP,AU,NZ,SG
    5: TW,CN,HK

  Now you need to set up the shipping rate tables for each zone.  Again,
  some time and effort will go into setting the appropriate rates.  You
  will define a set of weight ranges and the shipping price for each
  range.  For instance, you might want an order than weighs more than 0
  and less than or equal to 3 to cost 5.50 to ship to a certain zone.
  This would be defined by this:  3:5.5

  You should combine a bunch of these rates together in a comma delimited
  list and enter them into the "Zone X Shipping Table" fields where "X"
  is the zone number.  For example, this might be used for Zone 1:
    1:3.5,2:3.95,3:5.2,4:6.45,5:7.7,6:10.4,7:11.85, 8:13.3,9:14.75,10:16.2,11:17.65,
    12:19.1,13:20.55,14:22,15:23.45

  The above example includes weights over 0 and up to 15.  Note that
  units are not specified in this explanation since they should be
  specific to your locale.

  CAVEATS
  At this time, it does not deal with weights that are above the highest amount
  defined.  This will probably be the next area to be improved with the
  module.  For now, you could have one last very high range with a very
  high shipping rate to discourage orders of that magnitude.  For
  instance:  999:1000

  If you want to be able to ship to any country in the world, you will
  need to enter every country code into the Country fields. For most
  shops, you will not want to enter every country.  This is often
  because of too much fraud from certain places. If a country is not
  listed, then the module will add a $0.00 shipping charge and will
  indicate that shipping is not available to that destination.
  PLEASE NOTE THAT THE ORDER CAN STILL BE COMPLETED AND PROCESSED!

  It appears that the osC shipping system automatically rounds the
  shipping weight up to the nearest whole unit.  This makes it more
  difficult to design precise shipping tables.  If you want to, you
  can hack the shipping.php file to get rid of the rounding.

  Lastly, there is a limit of 255 characters on each of the Zone
  Shipping Tables and Zone Countries.

*/

  class zones {
    var $code, $title, $description, $enabled, $num_zones;

// class constructor
    function zones() {
      $this->code = 'zones';
      $this->title = MODULE_SHIPPING_ZONES_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_ZONES_SORT_ORDER;
      $this->icon = '';
      $this->tax_class = MODULE_SHIPPING_ZONES_TAX_CLASS;
      $this->tax_basis = MODULE_SHIPPING_ZONES_TAX_BASIS;

      // disable only when entire cart is free shipping
      if (zen_get_shipping_enabled($this->code)) {
        $this->enabled = ((MODULE_SHIPPING_ZONES_STATUS == 'True') ? true : false);
      }

      // CUSTOMIZE THIS SETTING FOR THE NUMBER OF ZONES NEEDED
      $this->num_zones = 3;
    }

// class methods
    function quote($method = '') {
      global $order, $shipping_weight, $shipping_num_boxes, $total_count;
      $dest_country = $order->delivery['country']['iso_code_2'];
      $dest_zone = 0;
      $error = false;

    $order_total_amount = $_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices() ;

      for ($i=1; $i<=$this->num_zones; $i++) {
        $countries_table = constant('MODULE_SHIPPING_ZONES_COUNTRIES_' . $i);
        $countries_table = strtoupper(str_replace(' ', '', $countries_table));
        $country_zones = split("[,]", $countries_table);
        if (in_array($dest_country, $country_zones)) {
          $dest_zone = $i;
          break;
        }
        if (in_array('00', $country_zones)) {
          $dest_zone = $i;
          break;
        }
      }

      if ($dest_zone == 0) {
        $error = true;
      } else {
        $shipping = -1;
        $zones_cost = constant('MODULE_SHIPPING_ZONES_COST_' . $dest_zone);

        $zones_table = split("[:,]" , $zones_cost);
        $size = sizeof($zones_table);
        $done = false;
        for ($i=0; $i<$size; $i+=2) {
          switch (MODULE_SHIPPING_ZONES_METHOD) {
        	  case (MODULE_SHIPPING_ZONES_METHOD == 'Weight'):
              if (round($shipping_weight,9) <= $zones_table[$i]) {
                $shipping = $zones_table[$i+1];

                switch (SHIPPING_BOX_WEIGHT_DISPLAY) {
                case (0):
                  $show_box_weight = '';
                  break;
                case (1):
                  $show_box_weight = ' (' . $shipping_num_boxes . ' ' . TEXT_SHIPPING_BOXES . ')';
                  break;
                case (2):
                  $show_box_weight = ' (' . number_format($shipping_weight * $shipping_num_boxes,2) . MODULE_SHIPPING_ZONES_TEXT_UNITS . ')';
                  break;
                default:
                  $show_box_weight = ' (' . $shipping_num_boxes . ' x ' . number_format($shipping_weight,2) . MODULE_SHIPPING_ZONES_TEXT_UNITS . ')';
                  break;
                }

//                $shipping_method = MODULE_SHIPPING_ZONES_TEXT_WAY . ' ' . $dest_country . (SHIPPING_BOX_WEIGHT_DISPLAY >= 2 ? ' : ' . $shipping_weight . ' ' . MODULE_SHIPPING_ZONES_TEXT_UNITS : '');
                $shipping_method = MODULE_SHIPPING_ZONES_TEXT_WAY . ' ' . $dest_country . $show_box_weight;
                $done = true;
        if (strstr($zones_table[$i+1], '%')) {
          $shipping = ($zones_table[$i+1]/100) * $order_total_amount;
        } else {
          $shipping = $zones_table[$i+1];
        }
                break;
        	    }
      	    break;
        	  case (MODULE_SHIPPING_ZONES_METHOD == 'Price'):
// shipping adjustment
              if (($_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices()) <= $zones_table[$i]) {
                $shipping = $zones_table[$i+1];
                $shipping_method = MODULE_SHIPPING_ZONES_TEXT_WAY . ' ' . $dest_country;
        if (strstr($zones_table[$i+1], '%')) {
          $shipping = ($zones_table[$i+1]/100) * $order_total_amount;
        } else {
          $shipping = $zones_table[$i+1];
        }
                $done = true;
                break;
	            }
	          break;
        	  case (MODULE_SHIPPING_ZONES_METHOD == 'Item'):
// shipping adjustment
              if (($total_count - $_SESSION['cart']->free_shipping_items()) <= $zones_table[$i]) {
                $shipping = $zones_table[$i+1];
                $shipping_method = MODULE_SHIPPING_ZONES_TEXT_WAY . ' ' . $dest_country;
                $done = true;
        if (strstr($zones_table[$i+1], '%')) {
          $shipping = ($zones_table[$i+1]/100) * $order_total_amount;
        } else {
          $shipping = $zones_table[$i+1];
        }
                break;
  	          }
	          break;
          }
          if ($done == true) {
            break;
          }
        }

        if ($shipping == -1) {
          $shipping_cost = 0;
          $shipping_method = MODULE_SHIPPING_ZONES_UNDEFINED_RATE;
        } else {
          switch (MODULE_SHIPPING_ZONES_METHOD) {
        	  case (MODULE_SHIPPING_ZONES_METHOD == 'Weight'):
              // charge per box when done by Price
              $shipping_cost = ($shipping * $shipping_num_boxes) + constant('MODULE_SHIPPING_ZONES_HANDLING_' . $dest_zone);
              break;
        	  case (MODULE_SHIPPING_ZONES_METHOD == 'Price'):
              // don't charge per box when done by Price
              $shipping_cost = ($shipping) + constant('MODULE_SHIPPING_ZONES_HANDLING_' . $dest_zone);
            break;
        	  case (MODULE_SHIPPING_ZONES_METHOD == 'Item'):
              // don't charge per box when done by Item
              $shipping_cost = ($shipping) + constant('MODULE_SHIPPING_ZONES_HANDLING_' . $dest_zone);
            break;
          }
        }
      }
      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_ZONES_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => $shipping_method,
                                                     'cost' => $shipping_cost)));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = zen_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (zen_not_null($this->icon)) $this->quotes['icon'] = zen_image($this->icon, $this->title);

      if (strstr(MODULE_SHIPPING_ZONES_SKIPPED, $dest_country)) {
        // don't show anything for this country
        $this->quotes = array();
      } else {
        if ($error == true) $this->quotes['error'] = MODULE_SHIPPING_ZONES_INVALID_ZONE;
      }

      return $this->quotes;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_ZONES_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('打开地区运费方式', 'MODULE_SHIPPING_ZONES_STATUS', 'True', '您要采用地区运费的方式吗?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('计算方法', 'MODULE_SHIPPING_ZONES_METHOD', 'Weight', '运费计算是基于重量、价格还是数量?', '6', '0', 'zen_cfg_select_option(array(\'Weight\', \'Price\', \'Item\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税率种类', 'MODULE_SHIPPING_ZONES_TAX_CLASS', '0', '计算运费使用的税率种类。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('税率基准', 'MODULE_SHIPPING_ZONES_TAX_BASIS', 'Shipping', '计算运费税的基准。选项为<br />Shipping - 基于客户的交货人地址<br />Billing - 基于客户的帐单地址<br />Store - 如果帐单地址/送货地区和商店地区相同，则基于商店地址', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('排序顺序', 'MODULE_SHIPPING_ZONES_SORT_ORDER', '0', '显示的顺序。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('设置不能发货的国家或地区，请输入用逗号分隔的两位ISO国家或地区代码', 'MODULE_SHIPPING_ZONES_SKIPPED', '', '不适用以下国家或地区:', '6', '0', 'zen_cfg_textarea(', now())");

      for ($i = 1; $i <= $this->num_zones; $i++) {
        $default_countries = '';
        if ($i == 1) {
          $default_countries = 'US,CA';
        }
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('地区" . $i ." 的国家或地区代码', 'MODULE_SHIPPING_ZONES_COUNTRIES_" . $i ."', '" . $default_countries . "', '用逗号分开的两位ISO标准的国家或地区代码：地区" . $i . "。<br />设置为00代表所有未指定的两位ISO国家或地区代码。', '6', '0', 'zen_cfg_textarea(', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('地区" . $i ." 的标准运费', 'MODULE_SHIPPING_ZONES_COST_" . $i ."', '3:8.50,7:10.50,99:20.00', '地区" . $i . "的运费基于分组的订单重量/价格。例如: 3:8.50,7:10.50,... 重量/价格低于或等于 3 的，运费为 8.50，送货地区" . $i . "。<br />最后金额设置为 10000:7% 收取订单总额的 7% ', '6', '0', 'zen_cfg_textarea(', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('地区" . $i ." 的手续费', 'MODULE_SHIPPING_ZONES_HANDLING_" . $i."', '0', '该配送地区的手续费', '6', '0', now())");
      }
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_SHIPPING_ZONES_STATUS', 'MODULE_SHIPPING_ZONES_METHOD', 'MODULE_SHIPPING_ZONES_TAX_CLASS', 'MODULE_SHIPPING_ZONES_TAX_BASIS', 'MODULE_SHIPPING_ZONES_SORT_ORDER', 'MODULE_SHIPPING_ZONES_SKIPPED');

      for ($i=1; $i<=$this->num_zones; $i++) {
        $keys[] = 'MODULE_SHIPPING_ZONES_COUNTRIES_' . $i;
        $keys[] = 'MODULE_SHIPPING_ZONES_COST_' . $i;
        $keys[] = 'MODULE_SHIPPING_ZONES_HANDLING_' . $i;
      }

      return $keys;
    }
  }
?>