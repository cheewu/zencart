<?php
/** Academe Template - languages_header.php
 *
 * @copyright Copyright 2007 iChoze Internet Solutions http://ichoze.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: languages.php 2718 2005-12-28 06:42:39Z drbyte $
 */
  $lang_header_status = $db->Execute("select layout_box_name from " . TABLE_LAYOUT_BOXES . " where (layout_box_status=1 or layout_box_status_single=1) and layout_template ='" . $template_dir . "' and layout_box_name='languages_header.php'");

  if ($lang_header_status->RecordCount() != 0) {
    $lang_search_header= true;
  }
   
  if ($lang_search_header == true) {
	 if (!isset($lng) || (isset($lng) && !is_object($lng))) {
      $lng = new language;
    }

    reset($lng->catalog_languages);
    require($template->get_template_dir('tpl_languages_header.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_languages_header.php');

    $title = BOX_HEADING_LANGUAGES;
    $title_link = false;
    require($template->get_template_dir('tpl_box_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_box_header.php');
  }



?>