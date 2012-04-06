<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_file_db_names.php 4240 2006-08-24 10:38:16Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * load the filename/database table names and he compatiblity functions
 *
 * @package admin
 * @copyright Copyright 2003-2005 zen-cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
**/
// set the type of request (secure or not)
  $request_type = (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1' || strstr(strtoupper($_SERVER['HTTP_X_FORWARDED_BY']),'SSL') || strstr(strtoupper($_SERVER['HTTP_X_FORWARDED_HOST']),'SSL'))  ? 'SSL' : 'NONSSL';

// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

// include the list of project filenames
  require(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'database_tables.php');

// include the list of compatibility issues
  require(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'compatibility.php');

// include the list of extra database tables and filenames
$extra_datafiles_dir = DIR_WS_INCLUDES . 'extra_datafiles/';
if ($dir = @dir($extra_datafiles_dir)) {
  while ($file = $dir->read()) {
    if (!is_dir($extra_datafiles_dir . $file)) {
      if (preg_match('/\.php$/', $file) > 0) {
        require($extra_datafiles_dir . $file);
      }
    }
  }
  $dir->close();
}
?>