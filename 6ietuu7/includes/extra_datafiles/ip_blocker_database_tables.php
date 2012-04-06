<?php
/** 
 * IP Blocker - Database Name Defines
 *
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ip_blocker_database_tables.php, v1.0.0.0 2009/09/09 $d <noblesenior@gmail.com> $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('TABLE_IP_BLOCKER', DB_PREFIX . 'ip_blocker');

?>