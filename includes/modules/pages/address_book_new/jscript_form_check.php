<?php
/**
 * jscript_form_check
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_form_check.php 4683 2006-10-07 06:11:53Z drbyte $
 */
?>
<script language="javascript" type="text/javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";
function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;
    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_radio(field_name, message) {
  var isChecked = false;
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];
    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }
    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;
    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }
  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";
<?php if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender", "' . ENTRY_GENDER_ERROR . '");' . "\n"; ?>
  check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_FIRST_NAME_ERROR; ?>");
  check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LAST_NAME_ERROR; ?>");
<?php if (ACCOUNT_DOB == 'true' && (int)ENTRY_DOB_MIN_LENGTH != 0) echo '  check_input("dob", ' . ENTRY_DOB_MIN_LENGTH . ', "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n"; ?>
<?php if (ACCOUNT_COMPANY == 'true' && (int)ENTRY_COMPANY_MIN_LENGTH != 0) echo '  check_input("company", ' . ENTRY_COMPANY_MIN_LENGTH . ', "' . ENTRY_COMPANY_ERROR . '");' . "\n"; ?>
  check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
  check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
  check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");
<?php if (ACCOUNT_STATE == 'true') echo '  if (!form.state.disabled && form.zone_id.value == "") check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . ENTRY_STATE_ERROR . '")' . "\n" . '  else if (form.state.disabled) check_select("zone_id", "", "' . ENTRY_STATE_ERROR_SELECT . '");' . "\n"; ?>
  check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");
if(document.getElementById('bill_mess').style.display == 'none'){
    copy_shipping_to_billing(this.form);
} else {
<?php //bill check
if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender_b", "bill: ' . ENTRY_GENDER_ERROR . '");' . "\n"; ?>
  check_input("firstname_b", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo 'bill: ' . ENTRY_FIRST_NAME_ERROR; ?>");
  check_input("lastname_b", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo 'bill: ' . ENTRY_LAST_NAME_ERROR; ?>");
<?php if (ACCOUNT_DOB == 'true' && (int)ENTRY_DOB_MIN_LENGTH != 0) echo '  check_input("dob_b", ' . ENTRY_DOB_MIN_LENGTH . ', "bill: ' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n"; ?>
<?php if (ACCOUNT_COMPANY == 'true' && (int)ENTRY_COMPANY_MIN_LENGTH != 0) echo '  check_input("company_b", ' . ENTRY_COMPANY_MIN_LENGTH . ', "bill: ' . ENTRY_COMPANY_ERROR . '");' . "\n"; ?>
  check_input("street_address_b", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo 'bill: ' . ENTRY_STREET_ADDRESS_ERROR; ?>");
  check_input("postcode_b", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo 'bill: ' . ENTRY_POST_CODE_ERROR; ?>");
  check_input("city_b", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo 'bill: ' . ENTRY_CITY_ERROR; ?>");
<?php if (ACCOUNT_STATE == 'true') echo '  if (!form.state.disabled && form.zone_id.value == "") check_input("state_b", ' . ENTRY_STATE_MIN_LENGTH . ', "bill: ' . ENTRY_STATE_ERROR . '")' . "\n" . '  else if (form.state.disabled) check_select("zone_id", "", "' . ENTRY_STATE_ERROR_SELECT . '");' . "\n"; ?>
  check_select("country_b", "", "<?php echo 'bill: ' . ENTRY_COUNTRY_ERROR; ?>");
}
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
