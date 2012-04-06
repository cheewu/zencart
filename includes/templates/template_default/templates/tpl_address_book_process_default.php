<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=address_book_process.<br />
 * Allows customer to add a new address book entry
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_address_book_process_default.php 2949 2006-02-03 01:09:07Z birdbrain $
 */
?>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="myaccountleft" valign="top">
 <?php require($template->get_template_dir('tpl_account_box.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_account_box.php');?>
</td>
    <td class="myaccountright" valign="top">
	<?php if (!isset($_GET['delete'])) echo zen_draw_form('addressbook', zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'onsubmit="return check_form(addressbook);"'); ?>


<h1 id="addressBookProcessDefaultHeading"><?php if (isset($_GET['edit'])) { echo HEADING_TITLE_MODIFY_ENTRY; } elseif (isset($_GET['delete'])) { echo HEADING_TITLE_DELETE_ENTRY; } else { echo HEADING_TITLE_ADD_ENTRY; } ?></h1>

<?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?>

<?php
  if (isset($_GET['delete'])) {
?>
<div class="alert"><?php echo DELETE_ADDRESS_DESCRIPTION; ?></div>

<address><?php echo zen_address_label($_SESSION['customer_id'], $_GET['delete'], true, ' ', '<br />'); ?></address>
<br class="clearBoth" />


<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . '&action=deleteconfirm', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_DELETE, BUTTON_DELETE_ALT) . '</a>'; ?></div>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
  } else {
?>
<?php
/**
 * Used to display address book entry form
 */
?>
<?php   require($template->get_template_dir('tpl_modules_address_book_details.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_address_book_details.php'); ?>

<br class="clearBoth" />
<?php
    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
?>
<div class="buttonRow forward"><?php echo zen_draw_hidden_field('action', 'update') . zen_draw_hidden_field('edit', $_GET['edit']) . zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
    } else {
?>
<div class="buttonRow forward"><?php echo zen_draw_hidden_field('action', 'process') . zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
    }
  }
?>
<?php if (!isset($_GET['delete'])) echo '</form>'; ?>
	</td>
  </tr>
</table>

</div>