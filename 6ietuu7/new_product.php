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
//  $Id: featured.php 6346 2007-05-20 14:20:46Z ajeh $
//

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    switch ($action) {
      case 'setflag':
        zen_set_featured_status($_GET['id'], $_GET['flag']);

        zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'fID=' . $_GET['id'], 'NONSSL'));
        break;
      case 'insert':
        if ($_POST['products_id'] < 1) {
          $messageStack->add_session(ERROR_NOTHING_SELECTED, 'caution');
        } else {
        $products_id = zen_db_prepare_input($_POST['products_id']);

        $new_products_date_available = ((zen_db_prepare_input($_POST['start']) == '') ? '0001-01-01' : zen_date_raw($_POST['start']));
        $expires_date = ((zen_db_prepare_input($_POST['end']) == '') ? '0001-01-01' : zen_date_raw($_POST['end']));

        $db->Execute("insert into " . TABLE_NEW_PRODUCT . "
                    (products_id, new_products_date_added, expires_date, status, new_products_date_available)
                    values ('" . (int)$products_id . "',
                            now(),
                            '" . zen_db_input($expires_date) . "', '1', '" . zen_db_input($new_products_date_available) . "')");

        $new_featured = $db->Execute("select new_products_id from " . TABLE_NEW_PRODUCT . " where products_id='" . (int)$products_id . "'");
        } // nothing selected to add
        if ($_GET['go_back'] == 'ON'){
          zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_id));
        } else {
          zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $new_featured->fields['new_products_id']));
        }
        break;
      case 'update':
        $new_products_id = zen_db_prepare_input($_POST['new_products_id']);

        $new_products_date_available = ((zen_db_prepare_input($_POST['start']) == '') ? '0001-01-01' : zen_date_raw($_POST['start']));
        $expires_date = ((zen_db_prepare_input($_POST['end']) == '') ? '0001-01-01' : zen_date_raw($_POST['end']));

        $db->Execute("update " . TABLE_NEW_PRODUCT . "
                      set new_products_last_modified = now(),
                          expires_date = '" . zen_db_input($expires_date) . "',
                          new_products_date_available = '" . zen_db_input($new_products_date_available) . "'
                      where new_products_id = '" . (int)$new_products_id . "'");

        zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $new_products_id));
        break;
      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page']));
        }
        $new_products_id = zen_db_prepare_input($_GET['fID']);

        $db->Execute("delete from " . TABLE_NEW_PRODUCT . "
                      where new_products_id = '" . (int)$new_products_id . "'");

        zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page']));
        break;
      case 'pre_add_confirmation':
      // check for blank or existing featured
        $skip_featured = false;
        if (empty($_POST['pre_add_products_id'])) {
          $skip_featured = true;
          $messageStack->add_session(WARNING_FEATURED_PRE_ADD_EMPTY, 'caution');
        }

        if ($skip_featured == false) {
          $sql = "select products_id from " . TABLE_PRODUCTS . " where products_id='" . (int)$_POST['pre_add_products_id'] . "'";
          $check_featured = $db->Execute($sql);
          if ($check_featured->RecordCount() < 1) {
            $skip_featured = true;
            $messageStack->add_session(WARNING_FEATURED_PRE_ADD_BAD_PRODUCTS_ID, 'caution');
          }
        }

        if ($skip_featured == false) {
          $sql = "select new_products_id from " . TABLE_NEW_PRODUCT . " where products_id='" . (int)$_POST['pre_add_products_id'] . "'";
          $check_featured = $db->Execute($sql);
          if ($check_featured->RecordCount() > 0) {
            $skip_featured = true;
            $messageStack->add_session(WARNING_FEATURED_PRE_ADD_DUPLICATE, 'caution');
          }
        }

        if ($skip_featured == true) {
          zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, ((isset($_GET['page']) && $_GET['page'] > 0) ? 'page=' . $_GET['page'] : '')));
        }
      // add empty featured

        $new_products_date_available = ((zen_db_prepare_input($_POST['start']) == '') ? '0001-01-01' : zen_date_raw($_POST['start']));
        $expires_date = ((zen_db_prepare_input($_POST['end']) == '') ? '0001-01-01' : zen_date_raw($_POST['end']));

        $products_id = zen_db_prepare_input($_POST['pre_add_products_id']);
        $db->Execute("insert into " . TABLE_NEW_PRODUCT . "
                    (products_id, new_products_date_added, expires_date, status, new_products_date_available)
                    values ('" . (int)$products_id . "',
                            now(),
                            '" . zen_db_input($expires_date) . "', '0', '" . zen_db_input($new_products_date_available) . "')");

        $new_featured = $db->Execute("select new_products_id from " . TABLE_NEW_PRODUCT . " where products_id='" . (int)$products_id . "'");

        $messageStack->add_session(SUCCESS_FEATURED_PRE_ADD, 'success');
        zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'action=edit' . '&fID=' . $new_featured->fields['new_products_id']));
        break;
//---------------------------- 批量操作产品
      case 'quantity_add_products':
      $quantity_info = '';
        if ($_POST['quantity_products_ids'] == '') {
          $messageStack->add_session(ERROR_NOTHING_SELECTED, 'caution');
        } else {
        $quantity_products_ids = zen_db_prepare_input($_POST['quantity_products_ids']);
        $quantity_products_ids = str_replace("，",",",$quantity_products_ids);
        $quantity_products_id = explode(",", $quantity_products_ids);
        
        foreach($quantity_products_id as $key => $value) {
            $products_exists = $db->Execute("select * from " . TABLE_NEW_PRODUCT . " where products_id = " . (int)$value);
            if($products_exists->RecordCount() < 1) {
                $db->Execute("insert into " . TABLE_NEW_PRODUCT . " (products_id) values ('" . (int)$value . "')");
                $quantity_info .= $value . ' is successful!<br />';
            } else {
                $quantity_info .= $value . ' is failture!Is already exist!<br />';
            }
        }

        } // nothing selected to add
        
        zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&action=quantity_new'));
        break;
      case 'quantity_delete_products':
      $quantity_info = '';
        if ($_POST['quantity_products_ids'] == '') {
          $messageStack->add_session(ERROR_NOTHING_SELECTED, 'caution');
        } else {
        $quantity_products_ids = zen_db_prepare_input($_POST['quantity_products_ids']);
        $quantity_products_ids = str_replace("，",",",$quantity_products_ids);
        
        $db->Execute("delete from " . TABLE_NEW_PRODUCT . " where products_id in (" . $quantity_products_ids . ")");

        } // nothing selected to add
        
        zen_redirect(zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&action=quantity_delete'));
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<?php
  }
?>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr><?php echo zen_draw_form('search', FILENAME_NEW_PRODUCT, '', 'get'); ?>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right">
<?php
// show reset search
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
  }
  echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search') . zen_hide_session_id();
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
  }
?>
            </td>
          </form></tr>
          <tr>
            <td colspan="3" class="main"><?php echo TEXT_STATUS_WARNING; ?></td>
          </tr>
        </table></td>
      </tr>

<?php
  if (empty($action)) {
?>
                    <td align="center"><?php echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, ((isset($_GET['page']) && $_GET['page'] > 0) ? 'page=' . $_GET['page'] . '&' : '') . 'action=new') . '">' . zen_image_button('button_new_product.gif', IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
<?php
  }
?>
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
    $form_action = 'insert';
    if ( ($action == 'edit') && isset($_GET['fID']) ) {
      $form_action = 'update';

      $product = $db->Execute("select p.products_id, pd.products_name, p.products_price, p.products_priced_by_attribute,
                                      f.expires_date, f.new_products_date_available
                               from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " .
                                        TABLE_NEW_PRODUCT . " f
                               where p.products_id = pd.products_id
                               and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                               and p.products_id = f.products_id
                               and f.new_products_id = '" . (int)$_GET['fID'] . "'");

      $fInfo = new objectInfo($product->fields);

      if ($fInfo->products_priced_by_attribute == '1') {
        $fInfo->products_price = zen_get_products_base_price($product->fields['products_id']);
      }

    } else {
      $fInfo = new objectInfo(array());

// create an array of featured products, which will be excluded from the pull down menu of products
// (when creating a new featured product)
      $featured_array = array();
      $featured = $db->Execute("select p.products_id, p.products_model
                                from " . TABLE_PRODUCTS . " p, " . TABLE_NEW_PRODUCT . " f
                                where f.products_id = p.products_id");

      while (!$featured->EOF) {
        $featured_array[] = $featured->fields['products_id'];
        $featured->MoveNext();
      }

// do not include things that cannot go in the cart
      $not_for_cart = $db->Execute("select p.products_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCT_TYPES . " pt on p.products_type= pt.type_id where pt.allow_add_to_cart = 'N'");

      while (!$not_for_cart->EOF) {
        $featured_array[] = $not_for_cart->fields['products_id'];
        $not_for_cart->MoveNext();
      }
    }
?>
<script language="javascript">
var StartDate = new ctlSpiffyCalendarBox("StartDate", "new_featured", "start", "btnDate1","<?php echo (($fInfo->new_products_date_available == '0001-01-01') ? '' : zen_date_short($fInfo->new_products_date_available)); ?>",scBTNMODE_CUSTOMBLUE);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "new_featured", "end", "btnDate2","<?php echo (($fInfo->expires_date == '0001-01-01') ? '' : zen_date_short($fInfo->expires_date)); ?>",scBTNMODE_CUSTOMBLUE);
</script>

      <tr><form name="new_featured" <?php echo 'action="' . zen_href_link(FILENAME_NEW_PRODUCT, zen_get_all_get_params(array('action', 'info', 'fID')) . 'action=' . $form_action . '&go_back=' . $_GET['go_back'], 'NONSSL') . '"'; ?> method="post"><?php if ($form_action == 'update') echo zen_draw_hidden_field('new_products_id', $_GET['fID']); ?>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_FEATURED_PRODUCT; ?>&nbsp;</td>
            <td class="main"><?php echo (isset($fInfo->products_name)) ? $fInfo->products_name . ' <small>(' . $currencies->format($fInfo->products_price) . ')</small>' : zen_draw_products_pull_down('products_id', 'size="5" style="font-size:10px"', $featured_array, true, $_GET['add_products_id'], true); echo zen_draw_hidden_field('products_price', (isset($fInfo->products_price) ? $fInfo->products_price : '')); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_FEATURED_AVAILABLE_DATE; ?>&nbsp;</td>
            <td class="main"><script language="javascript">StartDate.writeControl(); StartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_FEATURED_EXPIRES_DATE; ?>&nbsp;</td>
            <td class="main"><script language="javascript">EndDate.writeControl(); EndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2" class="main" align="right" valign="top"><br><?php echo (($form_action == 'insert') ? zen_image_submit('button_insert.gif', IMAGE_INSERT) : zen_image_submit('button_update.gif', IMAGE_UPDATE)). '&nbsp;&nbsp;&nbsp;<a href="' . ($_GET['go_back'] == 'ON' ? zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $_GET['add_products_id']) : zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . (isset($_GET['fID']) ? '&fID=' . $_GET['fID'] : ''))) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form></tr>
<?php
  } else if($action == 'quantity_new' || $action == 'quantity_delete') {
    $form_action = $action == 'quantity_new'? 'quantity_add_products':'quantity_delete_products';
?>
     <tr><form name="new_featured" <?php echo 'action="' . zen_href_link(FILENAME_NEW_PRODUCT, zen_get_all_get_params(array('action', 'info', 'fID')) . 'action=' . $form_action . '&go_back=' . $_GET['go_back'], 'NONSSL') . '"'; ?> method="post">
        <td><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo '商品编号(以","分割)'; ?>&nbsp;</td>
            <td class="main"><?php echo zen_draw_input_field('quantity_products_ids', '', 'size="100"');?></td>
          </tr>
          <tr>
            <td colspan="2" class="main" align="right" valign="top"><?php echo $quantity_info;?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2" class="main" align="right" valign="top"><br /><?php echo (($form_action == 'quantity_add_products') ? zen_image_submit('button_insert.gif', IMAGE_INSERT) : zen_image_submit('button_delete.gif', IMAGE_DELETE)). '&nbsp;&nbsp;&nbsp;<a href="' . ($_GET['go_back'] == 'ON' ? zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $_GET['add_products_id']) : zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . (isset($_GET['fID']) ? '&fID=' . $_GET['fID'] : ''))) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form></tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="right"><?php echo 'ID#'; ?>&nbsp;</td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_AVAILABLE_DATE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_EXPIRES_DATE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
// create search filter
  $search = '';
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    $search = " and (pd.products_name like '%" . $keywords . "%' or pd.products_description like '%" . $keywords . "%' or p.products_model like '%" . $keywords . "%')";
  }

// order of display
  $order_by = " order by pd.products_name ";

// create split page control
    $featured_query_raw = "select p.products_id, pd.products_name, p.products_model, p.products_price, p.products_priced_by_attribute, f.new_products_id, f.new_products_date_added, f.new_products_last_modified, f.expires_date, f.date_status_change, f.status, f.new_products_date_available from " . TABLE_PRODUCTS . " p, " . TABLE_NEW_PRODUCT . " f, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = f.products_id"  . $search . $order_by;
    $featured_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN, $featured_query_raw, $featured_query_numrows);
    $featured = $db->Execute($featured_query_raw);
    while (!$featured->EOF) {
      if ((!isset($_GET['fID']) || (isset($_GET['fID']) && ($_GET['fID'] == $featured->fields['new_products_id']))) && !isset($fInfo)) {
        $products = $db->Execute("select products_image
                                  from " . TABLE_PRODUCTS . "
                                  where products_id = '" . (int)$featured->fields['products_id'] . "'");

        $fInfo_array = array_merge($featured->fields, $products->fields);
        $fInfo = new objectInfo($fInfo_array);
      }

      if (isset($fInfo) && is_object($fInfo) && ($featured->fields['new_products_id'] == $fInfo->new_products_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $fInfo->new_products_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $featured->fields['new_products_id'] . '&action=edit') . '\'">' . "\n";
      }

?>
                <td  class="dataTableContent" align="right"><?php echo $featured->fields['products_id']; ?>&nbsp;</td>
                <td  class="dataTableContent"><?php echo $featured->fields['products_name']; ?></td>
                <td  class="dataTableContent" align="left"><?php echo $featured->fields['products_model']; ?>&nbsp;</td>
                <td  class="dataTableContent" align="center"><?php echo (($featured->fields['new_products_date_available'] != '0001-01-01' and $featured->fields['new_products_date_available'] !='') ? zen_date_short($featured->fields['new_products_date_available']) : TEXT_NONE); ?></td>
                <td  class="dataTableContent" align="center"><?php echo (($featured->fields['expires_date'] != '0001-01-01' and $featured->fields['expires_date'] !='') ? zen_date_short($featured->fields['expires_date']) : TEXT_NONE); ?></td>
                <td  class="dataTableContent" align="center">
<?php
      if ($featured->fields['status'] == '1') {
        echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'action=setflag&flag=0&id=' . $featured->fields['new_products_id'] . '&page=' . $_GET['page'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
      } else {
        echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'action=setflag&flag=1&id=' . $featured->fields['new_products_id'] . '&page=' . $_GET['page'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
      }
?>
                </td>
                <td class="dataTableContent" align="right">
                  <?php echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $featured->fields['new_products_id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>'; ?>
				          <?php echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $featured->fields['new_products_id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>'; ?>
                  <?php if (isset($fInfo) && is_object($fInfo) && ($featured->fields['new_products_id'] == $fInfo->new_products_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, zen_get_all_get_params(array('fID')) . 'fID=' . $featured->fields['new_products_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>
				        </td>
      </tr>
<?php
      $featured->MoveNext();
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $featured_split->display_count($featured_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_FEATURED); ?></td>
                    <td class="smallText" align="right"><?php echo $featured_split->display_links($featured_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&action=new') . '">' . zen_image_button('button_new_product.gif', IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&action=quantity_new') . '"><input type="button" value="批量更新" /></a>'; ?></td>
                    <td align="left"><?php echo '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&action=quantity_delete') . '"><input type="button" value="批量删除" /></a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_FEATURED . '</b>');

      $contents = array('form' => zen_draw_form('featured', FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $fInfo->new_products_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $fInfo->products_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $fInfo->new_products_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'pre_add':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_PRE_ADD_FEATURED . '</b>');
      $contents = array('form' => zen_draw_form('featured', FILENAME_NEW_PRODUCT, 'action=pre_add_confirmation'));
      $contents[] = array('text' => TEXT_INFO_PRE_ADD_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_PRE_ADD_PRODUCTS_ID . '<br>' . zen_draw_input_field('pre_add_products_id', '', zen_set_field_length(TABLE_NEW_PRODUCT, 'products_id')));
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_confirm.gif', IMAGE_CONFIRM) . '&nbsp;<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $fInfo->new_products_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($fInfo)) {
        $heading[] = array('text' => '<b>' . $fInfo->products_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $fInfo->new_products_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'page=' . $_GET['page'] . '&fID=' . $fInfo->new_products_id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit&products_filter=' . $fInfo->products_id) . '">' . zen_image_button('button_products_price_manager.gif', IMAGE_PRODUCTS_PRICE_MANAGER) . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . zen_date_short($fInfo->new_products_date_added));
        $contents[] = array('text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' . zen_date_short($fInfo->new_products_last_modified));
        $contents[] = array('align' => 'center', 'text' => '<br />' . zen_info_image($fInfo->products_image, $fInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT));

        $contents[] = array('text' => '<br />' . TEXT_INFO_AVAILABLE_DATE . ' <b>' . (($fInfo->new_products_date_available != '0001-01-01' and $fInfo->new_products_date_available !='') ? zen_date_short($fInfo->new_products_date_available) : TEXT_NONE) . '</b>');
        $contents[] = array('text' => TEXT_INFO_EXPIRES_DATE . ' <b>' . (($fInfo->expires_date != '0001-01-01' and $fInfo->expires_date !='') ? zen_date_short($fInfo->expires_date) : TEXT_NONE) . '</b>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_STATUS_CHANGE . ' ' . zen_date_short($fInfo->date_status_change));
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_CATEGORIES, '&action=new_product' . '&cPath=' . zen_get_product_path($fInfo->products_id, 'override') . '&pID=' . $fInfo->products_id . '&product_type=' . zen_get_products_type($fInfo->products_id)) . '">' . zen_image_button('button_edit_product.gif', IMAGE_EDIT_PRODUCT) . '<br />' . '</a>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_NEW_PRODUCT, 'action=pre_add') . '">' . zen_image_button('button_select.gif', IMAGE_SELECT) . '<br />' . TEXT_INFO_MANUAL . '</a><br /><br />');
      }
      break;
  }
  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
}
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>