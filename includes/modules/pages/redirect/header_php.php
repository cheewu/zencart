<?php
/**
 * redirect handler 
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 7285 2007-10-25 21:53:56Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
switch ($_GET['action']) {
  case 'banner':
  $banner_query = "SELECT banners_url
                   FROM " . TABLE_BANNERS . " 
                   WHERE banners_id = :bannersID";

  $banner_query = $db->bindVars($banner_query, ':bannersID', $_GET['goto'], 'integer');
  $banner = $db->Execute($banner_query);
  if ($banner->RecordCount() > 0) {
    zen_update_banner_click_count($_GET['goto']);
    zen_redirect($banner->fields['banners_url']);
  }
  break;
  case 'url':
  if (isset($_GET['goto']) && zen_not_null($_GET['goto'])) {
    zen_redirect('http://' . $_GET['goto']);
  }
  break;

  case 'manufacturer':
  if (isset($_GET['manufacturers_id']) && zen_not_null($_GET['manufacturers_id'])) {
    $sql = "SELECT manufacturers_url
            FROM " . TABLE_MANUFACTURERS_INFO . " 
            WHERE manufacturers_id = :manufacturersID 
            AND languages_id = :languagesID";

    $sql = $db->bindVars($sql, ':manufacturersID', $_GET['manufacturers_id'], 'integer');
    $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
    $manufacturer = $db->Execute($sql);

    if ($manufacturer->RecordCount()) {
      // url exists in selected language

      if (zen_not_null($manufacturer->fields['manufacturers_url'])) {
        $sql = "UPDATE " . TABLE_MANUFACTURERS_INFO . "
                SET url_clicked = url_clicked+1, date_last_click = now() 
                WHERE manufacturers_id = :manufacturersID 
                AND languages_id = :languagesID";
        
        $sql = $db->bindVars($sql, ':manufacturersID', $_GET['manufacturers_id'], 'integer');
        $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
        $db->Execute($sql);
        zen_redirect($manufacturer->fields['manufacturers_url']);
      }
    } else {
      // no url exists for the selected language, lets use the default language then
      $sql = "SELECT mi.languages_id, mi.manufacturers_url
              FROM " . TABLE_MANUFACTURERS_INFO . " mi, " . TABLE_LANGUAGES . " l 
              WHERE mi.manufacturers_id = :manufacturersID 
              AND mi.languages_id = l.languages_id 
              AND l.code = '" . DEFAULT_LANGUAGE . "'";
      
      $sql = $db->bindVars($sql, ':manufacturersID', $_GET['manufacturers_id'], 'integer');
      $manufacturer = $db->Execute(sql);

      if ($manufacturer->RecordCount() > 0) {

        if (zen_not_null($manufacturer->fields['manufacturers_url'])) {
          $sql = "UPDATE " . TABLE_MANUFACTURERS_INFO . "
                  SET url_clicked = url_clicked+1, date_last_click = now() 
                  WHERE manufacturers_id = :manufacturersID 
                  AND languages_id = :languagesID";
          
          $sql = $db->bindVars($sql, ':manufacturersID', $_GET['manufacturers_id'], 'integer');
          $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
          $db->Execute($sql);


          zen_redirect($manufacturer->fields['manufacturers_url']);
        }
      }
    }
  }
  break;
}

zen_redirect(zen_href_link(FILENAME_DEFAULT));
?>