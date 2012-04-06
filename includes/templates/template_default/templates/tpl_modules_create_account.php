<?php
/**
* Page Template
*
* Loaded automatically by index.php?main_page=create_account.<br />
* Displays Create Account form.
*
* @package templateSystem
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_modules_create_account.php 4822 2006-10-23 11:11:36Z drbyte $
*/
?>
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
<?php
if (ACCOUNT_COMPANY == 'true')
{
?>
	<fieldset>
	<legend><?php echo CATEGORY_COMPANY; ?></legend>
	<label class="inputLabel" for="company"><?php echo ENTRY_COMPANY; ?></label>
	<?php echo zen_draw_input_field('company', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company"') . (zen_not_null(ENTRY_COMPANY_TEXT) ? '<span class="alert">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?>
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
<?php
if ($phpBB->phpBB['installed'] == true)
{
?>
	<label class="inputLabel" for="nickname"><?php echo ENTRY_NICK; ?></label>
	<?php echo zen_draw_input_field('nick','','id="nickname"') . (zen_not_null(ENTRY_NICK_TEXT) ? '<span class="alert">' . ENTRY_NICK_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
<?php
}
?>
<label class="inputLabel" for="password-new"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-new"') . (zen_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="alert">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<label class="inputLabel" for="password-confirm"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
<?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-confirm"') . (zen_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="alert">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php if(CREATE_PAGE != 'true') //------------ȥĵ¼
{
	if (ACCOUNT_GENDER == 'true')
	{
	?>
		<div class="notice_name"><?php echo defined('TEXT_SHIPPING_TEXT')?TEXT_SHIPPING_TEXT:'shipping address';?></div>
		<?php echo zen_draw_radio_field('gender', 'm', '', 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label>' . zen_draw_radio_field('gender', 'f', '', 'id="gender-female"') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>' . (zen_not_null(ENTRY_GENDER_TEXT) ? '<span class="alert">' . ENTRY_GENDER_TEXT . '</span>': ''); ?>
		<br class="clearBoth" />
	<?php
	}
	?>
	<label class="inputLabel" for="firstname"><?php echo ENTRY_FIRST_NAME; ?></label>
	<?php echo zen_draw_input_field('firstname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname"') . (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="lastname"><?php echo ENTRY_LAST_NAME; ?></label>
	<?php echo zen_draw_input_field('lastname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname"') . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="street-address"><?php echo ENTRY_STREET_ADDRESS; ?></label>
	<?php echo zen_draw_input_field('street_address', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address"') . (zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	if (ACCOUNT_SUBURB == 'true')
	{
	?>
		<label class="inputLabel" for="suburb"><?php echo ENTRY_SUBURB; ?></label>
		<?php echo zen_draw_input_field('suburb', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . ' id="suburb"') . (zen_not_null(ENTRY_SUBURB_TEXT) ? '<span class="alert">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?>
		<br class="clearBoth" />
	<?php
	}
	?>
	<label class="inputLabel" for="city"><?php echo ENTRY_CITY; ?></label>
	<?php echo zen_draw_input_field('city', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city"') . (zen_not_null(ENTRY_CITY_TEXT) ? '<span class="alert">' . ENTRY_CITY_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	if (ACCOUNT_STATE == 'true')
	{
		if ($flag_show_pulldown_states == true)
		{
			?>
			<label class="inputLabel" for="stateZone" id="zoneLabel"><?php echo ENTRY_STATE; ?></label>
			<?php
			echo zen_draw_pull_down_menu('zone_id', zen_prepare_country_zones_pull_down($selected_country), $zone_id, 'id="stateZone"');
			if (zen_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="alert">' . ENTRY_STATE_TEXT . '</span>';
		}
		?>
		<br class="clearBoth" />
		<?php if ($flag_show_pulldown_states == true){?>
			<br class="clearBoth" id="stBreak" />
		<?php } ?>
		<label class="inputLabel" for="state" id="stateLabel"><?php echo $state_field_label; ?></label>
		<?php
		echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state"');
		if (zen_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="alert" id="stText">' . ENTRY_STATE_TEXT . '</span>';
		if ($flag_show_pulldown_states == false) {
		echo zen_draw_hidden_field('zone_id', $zone_name, ' ');
		}
		?>
		<br class="clearBoth" />
	<?php
	}
	?>
	<label class="inputLabel" for="postcode"><?php echo ENTRY_POST_CODE; ?></label>
	<?php echo zen_draw_input_field('postcode', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode"') . (zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="alert">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="country"><?php echo ENTRY_COUNTRY; ?></label>
	<?php echo zen_get_country_list('zone_country_id', $selected_country, 'id="country" ' . ($flag_show_pulldown_states == true ? 'onchange="update_zone(this.form);"' : '')) . (zen_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="alert">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
	<?php echo zen_draw_input_field('telephone', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40') . ' id="telephone"') . (zen_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="alert">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	if (ACCOUNT_DOB == 'true') {
	?>
	<label class="inputLabel" for="dob"><?php echo ENTRY_DATE_OF_BIRTH; ?></label>
	<?php echo zen_draw_input_field('dob','', 'id="dob"') . (zen_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="alert">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	}
	?>
	<div class="flow">
	<div class="notice_name"><?php echo TEXT_BILLING_SHIPPING;?></div>
	<div class="select_bill_mess">
	<input type="radio" name='bill_mess_radio' value='1' onclick="hide_bill_mess()" checked="true" /><?php echo TEXT_YES;?>
	<input type="radio" name='bill_mess_radio' value='0' onclick="show_bill_mess()"/><?php echo TEXT_NO;?>
	</div>
	</div>
	<script type="text/javascript">
	function show_bill_mess(){
	document.getElementById('bill_mess').style.display = '';
	}
	function hide_bill_mess(){
	document.getElementById('bill_mess').style.display = 'none';
	}</script>
	<div id="bill_mess" style="display:none;">
	<div class="notice_name"><?php echo NEW_ADDRESS_TITLE; ?></div>
	<?php
	if (ACCOUNT_GENDER == 'true') {
	?>
	<?php echo zen_draw_radio_field('gender_b', 'm', '', 'id="gender-male_b"') . '<label class="radioButtonLabel" for="gender-male_b">' . MALE . '</label>' . zen_draw_radio_field('gender_b', 'f', '', 'id="gender-female_b"') . '<label class="radioButtonLabel" for="gender-female_b">' . FEMALE . '</label>' . (zen_not_null(ENTRY_GENDER_TEXT) ? '<span class="alert">' . ENTRY_GENDER_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	}
	?>
	<label class="inputLabel" for="firstname_b"><?php echo ENTRY_FIRST_NAME; ?></label>
	<?php echo zen_draw_input_field('firstname_b', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname_b"') . (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="lastname_b"><?php echo ENTRY_LAST_NAME; ?></label>
	<?php echo zen_draw_input_field('lastname_b', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname_b"') . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="street-address_b"><?php echo ENTRY_STREET_ADDRESS; ?></label>
	<?php echo zen_draw_input_field('street_address_b', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address_b"') . (zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	if (ACCOUNT_SUBURB == 'true') {
	?>
	<label class="inputLabel" for="suburb_b"><?php echo ENTRY_SUBURB; ?></label>
	<?php echo zen_draw_input_field('suburb_b', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . ' id="suburb_b"') . (zen_not_null(ENTRY_SUBURB_TEXT) ? '<span class="alert">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	}
	?>
	<label class="inputLabel" for="city_b"><?php echo ENTRY_CITY; ?></label>
	<?php echo zen_draw_input_field('city_b', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city_b"') . (zen_not_null(ENTRY_CITY_TEXT) ? '<span class="alert">' . ENTRY_CITY_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<?php
	if (ACCOUNT_STATE == 'true') {
	if ($flag_show_pulldown_states == true) {
	?>
	<label class="inputLabel" for="stateZone_b" id="zoneLabel_b"><?php echo ENTRY_STATE; ?></label>
	<?php
	echo zen_draw_pull_down_menu('zone_id_b', zen_prepare_country_zones_pull_down($selected_country), $zone_id_b, 'id="stateZone_b"');
	if (zen_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="alert">' . ENTRY_STATE_TEXT . '</span>';
	}
	?>
	<?php if ($flag_show_pulldown_states == true) { ?>
	<br class="clearBoth" id="stBreak_b" />
	<?php } ?>
	<label class="inputLabel" for="state_b" id="stateLabel_b"><?php echo $state_field_label; ?></label>
	<?php
	echo zen_draw_input_field('state_b', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state_b"');
	if (zen_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="alert" id="stText_b">' . ENTRY_STATE_TEXT . '</span>';
	if ($flag_show_pulldown_states == false) {
	echo zen_draw_hidden_field('zone_id_b', $zone_name, ' ');
	}
	?>
	<br class="clearBoth" />
	<?php
	}
	?>
	<label class="inputLabel" for="postcode_b"><?php echo ENTRY_POST_CODE; ?></label>
	<?php echo zen_draw_input_field('postcode_b', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode_b"') . (zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="alert">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="country_b"><?php echo ENTRY_COUNTRY; ?></label>
	<?php echo zen_get_country_list('zone_country_id_b', $selected_country, 'id="country_b" ' . ($flag_show_pulldown_states == true ? 'onchange="update_billing_zone(this.form);"' : '')) . (zen_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="alert">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	<label class="inputLabel" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
	<?php echo zen_draw_input_field('telephone_b', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40') . ' id="telephone_b"') . (zen_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="alert">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?>
	<br class="clearBoth" />
	</div>
	<?php echo zen_draw_hidden_field('account_new','true');   //---- עͨдshippingbillingַ
}
?>
<!-- bill eof -->
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
