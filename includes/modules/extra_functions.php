<?php
/**
 * Load in any user functions
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: extra_functions.php 3012 2006-02-11 16:34:02Z wilt $
 */
// must be called appropriately
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// set directories to check for function files
$extra_functions_directory = DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/';
$ws_extra_functions_directory = DIR_WS_FUNCTIONS . 'extra_functions/';

// Check for new functions in extra_functions directory
$directory_array = array();

if ($dir = @dir($extra_functions_directory)) {
  while ($file = $dir->read()) {
    if (!is_dir($extra_functions_directory . $file)) {
      if (preg_match('/\.php$/', $file) > 0) {
        $directory_array[] = $file;
      }
    }
  }
  if (sizeof($directory_array)) {
    sort($directory_array);
  }
  $dir->close();
}

$file_cnt=0;
for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
  $file_cnt++;
  $file = $directory_array[$i];

  //      echo 'LOADING: ' . $ws_extra_functions_directory . $file . ' ' . $file_cnt . '<br />';
  if (file_exists($ws_extra_functions_directory . $file)) {
    include($ws_extra_functions_directory . $file);
  }
}
?>