<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.<br />
 * Displays previous orders and options to change various Customer Account settings
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_default.php 4086 2006-08-07 02:06:18Z ajeh $
 */
?>

<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="myaccountleft" valign="top">
<?php require($template->get_template_dir('tpl_account_box.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_account_box.php');?>
	</td>
    <td class="myaccountright" valign="top">
	<h1 id="accountDefaultHeading" style="padding:0px; margin:0px;"><?php echo HEADING_TITLE; ?></h1>
<div class="centerColumn" id="xTellAFriendDefault">
<?php echo zen_draw_form('email_friend', zen_href_link(FILENAME_X_TELL_A_FRIEND, 'action=process','SSL')); ?>

<?php if ($messageStack->size('friend') > 0) echo $messageStack->output('friend'); ?>
<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clearBoth" />

<label class="inputLabel" for="from-name"><?php echo FORM_FIELD_CUSTOMER_NAME; ?></label>
<?php echo zen_draw_input_field('from_name','','id="from-name"') . '&nbsp;<span class="alert">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?>
<br class="clearBoth" />

<label class="inputLabel" for="from-email-address"><?php echo FORM_FIELD_CUSTOMER_EMAIL; ?></label>
<?php echo zen_draw_input_field('from_email_address','','id="from-email-address"') . '&nbsp;<span class="alert">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?>
<br class="clearBoth" />

<label class="inputLabel" for="to-name"><?php echo FORM_FIELD_FRIEND_NAME; ?></label>
<?php echo zen_draw_input_field('to_name', '', 'id="to-name"') . '&nbsp;<span class="alert">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?>
<br class="clearBoth" />

<label class="inputLabel" for="to-email-address"><?php echo FORM_FIELD_FRIEND_EMAIL; ?></label>
<?php echo zen_draw_input_field('to_email_address', $_GET['to_email_address'], 'id="to-email-address"') . '&nbsp;<span class="alert">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?>
<br class="clearBoth" />

<label for="email-message"><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></label>
<?php echo zen_draw_textarea_field('message', 30, 5, '', 'id="email-message"'); ?>
<br class="clearBoth" />


<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<br class="clearBoth" />

<div id="tellAFriendAdvisory" class="advisory"><?php echo sprintf(MY_EMAIL_ALSO,$_SESSION['customer_id']).'<br />'.EMAIL_ADVISORY_INCLUDED_WARNING . str_replace('-----', '', EMAIL_ADVISORY); ?></div>

</form>
</div>

</td>
  </tr>
</table>
</div>