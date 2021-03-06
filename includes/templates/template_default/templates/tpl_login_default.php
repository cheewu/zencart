<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_login_default.php 5926 2007-02-28 18:15:39Z drbyte $
 */
?>
<div class="centerColumn" id="loginDefault">
<h1 id="loginDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>

<!--BOF normal login-->
<?php
  if ($_SESSION['cart']->count_contents() > 0) {
?>
<div class="advisory"><?php echo TEXT_VISITORS_CART; ?></div>
<?php
  }
?>
<div style="float:right; padding-left:38px !important; padding-left:0px; width:420px;">
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
<fieldset>
<legend><?php echo HEADING_RETURNING_CUSTOMER; ?></legend>
<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address"'); ?>
<br class="clearBoth" />
<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
<!-- modified by zen-cart.cn //-->
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '40') . ' id="login-password"'); ?>
<br class="clearBoth" />
<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
<div class="buttonRow" style="width:100%;"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?>
<?php echo '<a style="margin-left:10px;" href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
</div></fieldset>
</form>
<!--<iframe src="http://rye.rpxnow.com/openid/embed?token_url=<?echo zen_href_link('openid_account');?>"  scrolling="no"  frameBorder="no"  allowtransparency="true"  style="width:400px;height:240px"></iframe> 
-->

</div>

<!--<br class="clearBoth" />-->
<div style="float:left;  width:500px;">
<?php echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
<?php if ($messageStack->size('create_account') > 0) echo $messageStack->output('create_account'); ?>
<?php
if (DISPLAY_PRIVACY_CONDITIONS == 'true')
{
?>
	<fieldset>
	<legend><?php echo TABLE_HEADING_PRIVACY_CONDITIONS; ?></legend>
	<div class="information"><?php echo TEXT_PRIVACY_CONDITIONS_DESCRIPTION;?></div>
	<?php echo zen_draw_checkbox_field('privacy_conditions', '1', false, 'id="privacy"');?>
	<label class="checkboxLabel" for="privacy"><?php echo TEXT_PRIVACY_CONDITIONS_CONFIRM;?></label>
	</fieldset>
<?php
}
?>

<fieldset>
<legend><?php echo TABLE_NEW_LOGIN_PROFILE;?></legend>
<div class="alert"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<div class="notice_name"><?php echo TABLE_LOGIN_PROFILE;?></div>
<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address"') . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<label class="inputLabel" for="password-new"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-new"') . (zen_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="alert">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<label class="inputLabel" for="password-confirm"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
<?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-confirm"') . (zen_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="alert">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?>
<div class="buttonRow forward"><?php echo zen_image_submit('button_create_account.gif', BUTTON_SUBMIT_ALT); ?></div>
<br class="clearBoth" />

</fieldset>
<fieldset style="display: none;">
<legend><?php echo ENTRY_EMAIL_PREFERENCE; ?></legend>
<?php
if (ACCOUNT_NEWSLETTER_STATUS != 0) {
?>
<?php echo zen_draw_checkbox_field('newsletter', '1', $newsletter, 'id="newsletter-checkbox"') . '<label class="checkboxLabel" for="newsletter-checkbox">' . ENTRY_NEWSLETTER . '</label>' . (zen_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="alert">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php } ?>
<?php echo zen_draw_radio_field('email_format', 'HTML', ($email_format == 'HTML' ? true : false),'id="email-format-html"') . '<label class="radioButtonLabel" for="email-format-html">' . ENTRY_EMAIL_HTML_DISPLAY . '</label>' .  zen_draw_radio_field('email_format', 'TEXT', ($email_format == 'TEXT' ? true : false), 'id="email-format-text"') . '<label class="radioButtonLabel" for="email-format-text">' . ENTRY_EMAIL_TEXT_DISPLAY . '</label>'; ?>
<br class="clearBoth" />
</fieldset>
<?php
if (CUSTOMERS_REFERRAL_STATUS == 2) {
?>
<fieldset>
<legend><?php echo TABLE_HEADING_REFERRAL_DETAILS; ?></legend>
<label class="inputLabel" for="customers_referral"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
<?php echo zen_draw_input_field('customers_referral', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_referral', '15') . ' id="customers_referral"'); ?>
<br class="clearBoth" />
</fieldset>
<?php } ?>

</form>
</div>
<br  class="clear"/>

<!--EOF normal login-->
</div>
</div>