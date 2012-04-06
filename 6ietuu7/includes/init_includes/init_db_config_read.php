<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_db_config_read.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// Determine the DATABASE patch level
  $project_db_info= $db->Execute("select * from " . TABLE_PROJECT_VERSION . " WHERE project_version_key = 'Zen-Cart Database' ");
  define('PROJECT_DB_VERSION_MAJOR',$project_db_info->fields['project_version_major']);
  define('PROJECT_DB_VERSION_MINOR',$project_db_info->fields['project_version_minor']);
  define('PROJECT_DB_VERSION_PATCH1',$project_db_info->fields['project_version_patch1']);
  define('PROJECT_DB_VERSION_PATCH2',$project_db_info->fields['project_version_patch2']);
  define('PROJECT_DB_VERSION_PATCH1_SOURCE',$project_db_info->fields['project_version_patch1_source']);
  define('PROJECT_DB_VERSION_PATCH2_SOURCE',$project_db_info->fields['project_version_patch2_source']);

// set application wide parameters
  $configuration = $db->Execute('select configuration_key as cfgKey, configuration_value as cfgValue
                                 from ' . TABLE_CONFIGURATION);
  while (!$configuration->EOF) {
    define($configuration->fields['cfgKey'], $configuration->fields['cfgValue']);
    $configuration->MoveNext();
  }

// set product type layout paramaters
  $configuration = $db->Execute('select configuration_key as cfgKey, configuration_value as cfgValue
                          from ' . TABLE_PRODUCT_TYPE_LAYOUT);

  while (!$configuration->EOF) {
    define($configuration->fields['cfgKey'], $configuration->fields['cfgValue']);
    $configuration->movenext();
  }
?>