<?php
/**
 * categories sidebox - prepares content for the main categories sidebox - Replacement. 
 * | Copyright (c) 2005 Christoph Handel  ||  http://www.held-im-ruhestand.de/ 
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: categories.php 2718 2005-12-28 06:42:39Z drbyte $
 */

// require generator

//CHRISTOPH BOF
require_once (DIR_WS_CLASSES . 'ch_categories_tree_generator.php');

$main_category_tree = new ch_category_tree;
//CHRISTOPH EOF
$row = 0;
$box_categories_array = array();

// don't build a tree when no categories
$check_categories = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_status=1 limit 1");
if ($check_categories->RecordCount() > 0) {
	$box_categories_array = $main_category_tree->zen_category_tree();
}

require($template->get_template_dir('tpl_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_categories.php');

$title = BOX_HEADING_CATEGORIES;
$title_link = false;

require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>
