<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_order_history.php 4224 2006-08-24 01:41:50Z drbyte $
 */
  $content = "";
  $content .= '<ul id="recentlyorder" style="overflow: hidden;">' . "\n";
  for ($i=1; $i<=sizeof($customer_orders); $i++) {

        $content .= '<li>'.zen_image($template->get_template_dir('icon_car_gray.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/icon_car_gray.gif', '','','',' class="fl"').'<div class="roll_order"><a href="' . zen_href_link(zen_get_info_page($customer_orders[$i]['id']), 'products_id=' . $customer_orders[$i]['id']) . '">' . $customer_orders[$i]['name'] . '</a><br/>
ship to '.$customer_orders[$i]['customers_state'].','.$customer_orders[$i]['customers_country'].'</div></li>' . "\n" ;
  }
  $content .= '</ul>';

?>
