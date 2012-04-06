<?php
/**
 * Header code file for the Advanced Search Input page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4673 2006-10-03 01:37:07Z drbyte $
 */
  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $breadcrumb->add(NAVBAR_TITLE_1);
$tags_sql="select * from products_tags as pt left join manufacturers as m on pt.manufacturers_id=m.manufacturers_id where pt.language_id = :languagesID and pt.tags!=''";
$tags_sql = $db->bindVars($tags_sql, ':languagesID', $_SESSION['languages_id'], 'integer');
$tags_split = new splitPageResults($tags_sql, MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS);
$tags=$db->Execute($tags_split->sql_query);
$seo = new SEO_URL($_SESSION['languages_id']);
?>