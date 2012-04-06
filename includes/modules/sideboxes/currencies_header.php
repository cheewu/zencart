<?php
/** Academe Template - currencies_header.php
 *
 * @copyright Copyright 2007 iChoze Internet Solutions http://ichoze.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: currencies.php 2834 2006-01-11 22:16:37Z birdbrain $
 */

$cur_header_status = $db->Execute("select layout_box_name from " . TABLE_LAYOUT_BOXES . " where (layout_box_status=1 or layout_box_status_single=1) and layout_template ='" . $template_dir . "' and layout_box_name='currencies_header.php'");

  if ($cur_header_status->RecordCount() != 0) {
    $show_currencies_header= true;
  }

  if ($show_currencies_header == true) {
    if (isset($currencies) && is_object($currencies)) {

      reset($currencies->currencies);
      $currencies_array = array();
      while (list($key, $value) = each($currencies->currencies)) {
        $currencies_array[] = array('id' => $key, 'text' => $value['title']);
      }

      $hidden_get_variables = '';
      reset($_GET);
      while (list($key, $value) = each($_GET)) {
        if ( ($key != 'currency') && ($key != zen_session_name()) && ($key != 'x') && ($key != 'y') ) {
          $hidden_get_variables .= zen_draw_hidden_field($key, $value);
        }
      }

      require($template->get_template_dir('tpl_currencies_header.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_currencies_header.php');
      $title =  BOX_HEADING_CURRENCIES;
      $title_link = false;
	  $text = BOX_HEADING_CURRENCIES;
      require($template->get_template_dir('tpl_box_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_box_header.php');
    }
  }
?>