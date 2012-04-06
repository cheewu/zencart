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
//

if($woz_install){
	$p_id = htmlspecialchars($_GET['p'],ENT_QUOTES);
	if ( !empty($p_id) ) {
			$zen_heading_title = BREAD_CRUMBS_SEPARATOR . $wpdb->get_var("SELECT post_title FROM $wpdb->posts  WHERE ID = $p_id");
	}

	$cat_id = htmlspecialchars($_GET['cat'],ENT_QUOTES);
	if ( !empty($cat_id) ) {
			// category exclusion
			if ( !stristr($cat,'-') )
				$zen_heading_title .= BREAD_CRUMBS_SEPARATOR . get_the_category_by_ID($cat_id);
	}

	$p_id = htmlspecialchars($_GET['p'],ENT_QUOTES);
	if ( !empty($p_id) ) {
			$zen_heading_title .= BREAD_CRUMBS_SEPARATOR . $wpdb->get_var("SELECT post_title FROM $wpdb->posts  WHERE ID = $p_id");
	}

	$i=strlen(DIR_WS_CATALOG);
	$j=strlen($_SERVER['REQUEST_URI']);
	$req=substr($_SERVER['REQUEST_URI'],$i,9);

	if ($req=='news/shop') {
			$zen_heading_title = ucwords(substr(str_replace("-", " ", urldecode($_SERVER['REQUEST_URI'])),$i+10,$j-$i-11));
	} elseif ($req=='news/chea') {
			// $zen_heading_title = ucwords(substr(str_replace("-", " ", urldecode($_SERVER['REQUEST_URI'])),$i+11,$j-$i-12));
	} else {
			$zen_heading_title = ucwords(substr(str_replace("-", " ", urldecode($_SERVER['REQUEST_URI'])),$i+13,$j-$i-14));
	}

	$zen_heading_title = str_replace('/','',$zen_heading_title);
	define('NAVBAR_TITLE', $zen_heading_title . ' : ' .get_bloginfo('name'));
	define('WOZ_HOME_ADDRESS', '/news/?');
}else{ // file not found ABSPATH.'wp-config.php';
	define('NAVBAR_TITLE', 'Not Found');
	define('WOZ_HOME_ADDRESS', '/news/?');

}
?>