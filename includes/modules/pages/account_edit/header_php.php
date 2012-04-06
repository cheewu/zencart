<?php
/**
 * Header code file for the customer's Account-Edit page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4825 2006-10-23 22:25:11Z drbyte $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ACCOUNT_EDIT');
define('COLUMN_LEFT_NONE', 'true');
if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
  if (ACCOUNT_GENDER == 'true') $gender = zen_db_prepare_input($_POST['gender']);
  $firstname = zen_db_prepare_input($_POST['firstname']);
  $lastname = zen_db_prepare_input($_POST['lastname']);
  if (ACCOUNT_DOB == 'true') $dob = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_db_prepare_input($_POST['dob']));
  //$email_address = zen_db_prepare_input($_POST['email_address']);
  $telephone = zen_db_prepare_input($_POST['telephone']);
  $fax = zen_db_prepare_input($_POST['fax']);
  //$email_format = zen_db_prepare_input($_POST['email_format']);
  $email_format = 'HTML';

  if (CUSTOMERS_REFERRAL_STATUS == '2' and $_POST['customers_referral'] != '') $customers_referral = zen_db_prepare_input($_POST['customers_referral']);

  $error = false;

  if (ACCOUNT_GENDER == 'true') {
    if ( ($gender != 'm') && ($gender != 'f') ) {
      $error = true;
      $messageStack->add('account_edit', ENTRY_GENDER_ERROR);
    }
  }

  if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
    $error = true;
    $messageStack->add('account_edit', ENTRY_FIRST_NAME_ERROR);
  }

  if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
    $error = true;
    $messageStack->add('account_edit', ENTRY_LAST_NAME_ERROR);
  }

  if (ACCOUNT_DOB == 'true') {
    if (ENTRY_DOB_MIN_LENGTH > 0 or !empty($_POST['dob'])) {
      if (substr_count($dob,'/') > 2 || checkdate((int)substr(zen_date_raw($dob), 4, 2), (int)substr(zen_date_raw($dob), 6, 2), (int)substr(zen_date_raw($dob), 0, 4)) == false) {
        $error = true;
        $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }
  }
/*
  if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
    $error = true;
    $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR);
  }

  if (!zen_validate_email($email_address)) {
    $error = true;
    $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
  }
*//*
  $check_email_query = "SELECT count(*) AS total
                        FROM   " . TABLE_CUSTOMERS . "
                        WHERE  customers_email_address = :emailAddress
                        AND    customers_id != :customersID";
*/
  $check_email_query = "SELECT count(*) AS total
                        FROM   " . TABLE_CUSTOMERS . "
                        WHERE  customers_id != :customersID";
                        
  //$check_email_query = $db->bindVars($check_email_query, ':emailAddress', $email_address, 'string');
  $check_email_query = $db->bindVars($check_email_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $check_email = $db->Execute($check_email_query);

  if ($check_email->fields['total'] > 0) {
    //$error = true;
    //$messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);

    // check phpBB for duplicate email address
    if ($phpBB->phpbb_check_for_duplicate_email(zen_db_input($email_address)) == 'already_exists' ) {
      $error = true;
      $messageStack->add('account_edit', 'phpBB-'.ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }
  }


  if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
    $error = true;

    $messageStack->add('account_edit', ENTRY_TELEPHONE_NUMBER_ERROR);
  }

  if ($error == false) {
    //update phpBB with new email address
    $old_addr_check=$db->Execute("select customers_email_address from ".TABLE_CUSTOMERS." where customers_id='".(int)$_SESSION['customer_id']."'");
    $phpBB->phpbb_change_email(zen_db_input($old_addr_check->fields['customers_email_address']),zen_db_input($email_address));

    $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                            array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'),
                            //array('fieldName'=>'customers_email_address', 'value'=>$email_address, 'type'=>'string'),
                            array('fieldName'=>'customers_telephone', 'value'=>$telephone, 'type'=>'string'),
                            array('fieldName'=>'customers_fax', 'value'=>$fax, 'type'=>'string'),
                            array('fieldName'=>'customers_email_format', 'value'=>$email_format, 'type'=>'string')
    );

    if ((CUSTOMERS_REFERRAL_STATUS == '2' and $customers_referral != '')) {
      $sql_data_array[] = array('fieldName'=>'customers_referral', 'value'=>$customers_referral, 'type'=>'string');
    }
    if (ACCOUNT_GENDER == 'true') {
      $sql_data_array[] = array('fieldName'=>'customers_gender', 'value'=>$gender, 'type'=>'string');
    }
    if (ACCOUNT_DOB == 'true') {
      if ($dob == '0001-01-01 00:00:00' or $_POST['dob'] == '') {
        $sql_data_array[] = array('fieldName'=>'customers_dob', 'value'=>'0001-01-01 00:00:00', 'type'=>'date');
      } else {
        $sql_data_array[] = array('fieldName'=>'customers_dob', 'value'=>zen_date_raw($_POST['dob']), 'type'=>'date');
      }
    }

    $where_clause = "customers_id = :customersID";
    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
    $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
    //-------------------add 2010 5 5 -----------------------//
    try{
    //更新crm
    //这里由于Last Name是必填的,所以设置默认为邮箱
        $crm_array = array();
       // $crm_id = crm_curl_getid('Contacts',STORE_NAME . '_' . $_SESSION['customer_id']);
        $crm_id = '';
        $crm_gender = $gender == 'f'?"女士":"先生";
        $lastname_crm = is_null($lastname)?'New':$lastname;
        $crm_array = array('websiteid'=>STORE_NAME . '_' . $_SESSION['customer_id'],
                           'First Name'=>$firstname,
                           'Last Name'=>$lastname_crm,
                           'Salutation'=> $crm_gender,
                           'Email'=>$email_address,
                           'Phone'=>$telephone,
                           'Mobile'=>$telephone,
                           'Fax'=>$fax);
        //crm_curl_post('Contacts',$crm_array,'update',$crm_id);
        $json_array = array('action' => 'Contacts',
                            'method' => 'update',
                            'id' => $_SESSION['customer_id'],
                            'data' => $crm_array);
        $json = json_encode($json_array);
        $sql_json_array = array('type' => 'crm',
                                'json' => $json,
                                'status' => 0);
        zen_db_perform("sendmessage",$sql_json_array);

        } catch (Exception $e) {
        }
    //------------------------ over -------------------------//

    $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
            SET    customers_info_date_account_last_modified = now()
            WHERE  customers_info_id = :customersID";

    $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');

    $db->Execute($sql);

    $where_clause = "customers_id = :customersID AND address_book_id = :customerDefaultAddressID";
    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
    $where_clause = $db->bindVars($where_clause, ':customerDefaultAddressID', $_SESSION['customer_default_address_id'], 'integer');
    $sql_data_array = array(array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
    array('fieldName'=>'entry_lastname', 'value'=>$lastname, 'type'=>'string'));

    $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', $where_clause);

    $zco_notifier->notify('NOTIFY_HEADER_ACCOUNT_EDIT_UPDATES_COMPLETE');

    // reset the session variables
    $_SESSION['customer_first_name'] = $firstname;

    $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

    zen_redirect(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }
}

$account_query = "SELECT customers_gender, customers_firstname, customers_lastname,
                         customers_dob, customers_email_address, customers_telephone,
                         customers_fax, customers_email_format, customers_referral
                  FROM   " . TABLE_CUSTOMERS . "
                  WHERE  customers_id = :customersID";

$account_query = $db->bindVars($account_query, ':customersID', $_SESSION['customer_id'], 'integer');
$account = $db->Execute($account_query);
if (ACCOUNT_GENDER == 'true') {
  if (isset($gender)) {
    $male = ($gender == 'm') ? true : false;
  } else {
    $male = ($account->fields['customers_gender'] == 'm') ? true : false;
  }
  $female = !$male;
}

// if DOB field has database default setting, show blank:
$dob = ($dob == '0001-01-01 00:00:00') ? '' : $dob;

$customers_referral = $account->fields['customers_referral'];

if (isset($customers_email_format)) {
  $email_pref_html = (($customers_email_format == 'HTML') ? true : false);
  $email_pref_none = (($customers_email_format == 'NONE') ? true : false);
  $email_pref_optout = (($customers_email_format == 'OUT')  ? true : false);
  $email_pref_text = (($email_pref_html || $email_pref_none || $email_pref_out) ? false : true);  // if not in any of the others, assume TEXT
} else {
  $email_pref_html = (($account->fields['customers_email_format'] == 'HTML') ? true : false);
  $email_pref_none = (($account->fields['customers_email_format'] == 'NONE') ? true : false);
  $email_pref_optout = (($account->fields['customers_email_format'] == 'OUT')  ? true : false);
  $email_pref_text = (($email_pref_html || $email_pref_none || $email_pref_out) ? false : true);  // if not in any of the others, assume TEXT
}

$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ACCOUNT_EDIT');
?>