<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_tlds.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// set the session name and save path
  $http_domain = zen_get_top_level_domain(HTTP_SERVER);
  $https_domain = zen_get_top_level_domain(HTTPS_SERVER);
  $current_domain = (($request_type == 'NONSSL') ? $http_domain : $https_domain);
?>