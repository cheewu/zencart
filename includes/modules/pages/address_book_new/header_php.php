<?php
/**
 * create_account_success header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 5244 2006-12-14 18:37:33Z drbyte $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CREATE_ACCOUNT_SUCCESS');
define('COLUMN_LEFT_NONE', 'true');

if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add('Shipping Information');
define('HEADING_NEW_CUSTOMER', 'Please Provide Your Shipping and Billing Information');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', '');
if (sizeof($_SESSION['navigation']->snapshot) > 0)
{
	$origin_href = zen_href_link($_SESSION['navigation']->snapshot['page'], zen_array_to_string($_SESSION['navigation']->snapshot['get'], array(zen_session_name())), $_SESSION['navigation']->snapshot['mode']);
	$_SESSION['navigation']->clear_snapshot();
}
else
{
	$origin_href = zen_href_link(FILENAME_DEFAULT);
}
// redirect customer to where they came from if their cart is not empty and they didn't click on create-account specifically
if ($_SESSION['cart']->count_contents() > 0)
{
	if ($origin_href != zen_href_link(FILENAME_DEFAULT))
	{
		zen_redirect($origin_href);
	}
}
$selected_country = (isset($_POST['zone_country_id']) && $_POST['zone_country_id'] != '') ? $country : SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY;
$flag_show_pulldown_states = ((($process == true || $entry_state_has_zones == true) && $zone_name == '') || ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN == 'true' || $error_state_input) ? true : false;
$state = ($flag_show_pulldown_states) ? $state : $zone_name;
$state_field_label = ($flag_show_pulldown_states) ? '' : ENTRY_STATE;
// This should be last line of the script:
//$zco_notifier->notify('NOTIFY_HEADER_END_CREATE_ACCOUNT_SUCCESS');
//----------------------------------- 2010 3 22 add by wu -------------------------------------//
//--------- 这里新增如果用户的shipping地址和billing地址是一样的,那么就跳转页面 让用户去填写相应的地址
$process_address = true;
$process_email = true;
$redirect_address = false;
$redirect_email = false;
$check_exist_address_sql = "select * from " . TABLE_ADDRESS_BOOK . " where customers_id = " . $_SESSION['customer_id'];
$check_exist_address = $db->Execute($check_exist_address_sql);
if($check_exist_address->RecordCount()>0)
{
    $process_address = false;
}

$check_exist_email_sql = "select * from " . TABLE_CUSTOMERS . " where customers_id = " . $_SESSION['customer_id'];
$check_exist_email = $db->Execute($check_exist_email_sql);

if(!$check_exist_email->fields['customers_email_address'] == ''){
    $process_email = false;
}

if(!$process_address && !$process_email){
    zen_redirect(zen_href_link('checkout_shipping', '', 'SSL'));
}
//----------------------------------- 2010 3 22 over ------------------------------------------//

//--------------------------------------- 处理email -------------------------------------------------//
if($process_email){ //需要处理邮箱的时候才处理
if(isset($_POST['email_address'])){
$email_address = zen_db_prepare_input($_POST['email_address']);
$error_e = false;
  if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
    $error_e = true;
    $messageStack->add('address_book_new', ENTRY_EMAIL_ADDRESS_ERROR);
  }

  if (!zen_validate_email($email_address)) {
    $error_e = true;
    $messageStack->add('address_book_new', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
  }

  $check_email_query = "SELECT count(*) AS total
                        FROM   " . TABLE_CUSTOMERS . "
                        WHERE  customers_email_address = :emailAddress
                        AND    customers_id != :customersID";

  $check_email_query = $db->bindVars($check_email_query, ':emailAddress', $email_address, 'string');
  $check_email_query = $db->bindVars($check_email_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $check_email = $db->Execute($check_email_query);

  if ($check_email->fields['total'] > 0) {
    $error_e = true;
    $messageStack->add('address_book_new', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);

    // check phpBB for duplicate email address
    if ($phpBB->phpbb_check_for_duplicate_email(zen_db_input($email_address)) == 'already_exists' ) {
      $error_e = true;
      $messageStack->add('address_book_new', 'phpBB-'.ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }
  }
  
  if ($error_e == false) {
    $sql_data_array[] = array('fieldName'=>'customers_email_address', 'value'=>$email_address, 'type'=>'string');
    $where_clause = "customers_id = :customersID";
    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
    $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
    
    $redirect_email = true;
  } else {
    $redirect_email = false;
  }
  }
}
//---------------------------------------------------------------------------------------------------//


//--------------------------------------- 以下是写入address_book ------------------------------------//
if($process_address){   //需要处理address的时候才处理
/**
 * Set some defaults
 */
  $process = false;
  $zone_name = '';
  $entry_state_has_zones = '';
  $error_state_input = false;
  $state = '';
  $zone_id = 0;
  $error = false;
//提交表单操作
if (isset($_POST['action']) && ($_POST['action'] == 'process'))
{
	$process = true;
	if(ACCOUNT_GENDER == 'true'){
		$gender = isset($_POST['gender'])?zen_db_prepare_input($_POST['gender']):'';
	}
	$firstname = zen_db_prepare_input($_POST['firstname']);
	$lastname = zen_db_prepare_input($_POST['lastname']);
	$nick = zen_db_prepare_input($_POST['nick']);
	if (ACCOUNT_DOB == 'true') $dob = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_db_prepare_input($_POST['dob']));
	$street_address = zen_db_prepare_input($_POST['street_address']);
	if (ACCOUNT_SUBURB == 'true') $suburb = zen_db_prepare_input($_POST['suburb']);
	$postcode = zen_db_prepare_input($_POST['postcode']);
	$city = zen_db_prepare_input($_POST['city']);
	if (ACCOUNT_STATE == 'true')
	{
		$state = zen_db_prepare_input($_POST['state']);
		$zone_id = isset($_POST['zone_id'])?zen_db_prepare_input($_POST['zone_id']):$zone_id = false;
	}
	$country = zen_db_prepare_input($_POST['zone_country_id']);
	$telephone = zen_db_prepare_input($_POST['telephone']);
	//-------------------------------以下是获取的账单信息-------------------------------------//
	//--------- 其中有些内容 作了调整
	if (ACCOUNT_GENDER == 'true')
	{
		$gender_b = isset($_POST['gender_b'])?zen_db_prepare_input($_POST['gender_b']):'';
	}
	$firstname_b = zen_db_prepare_input($_POST['firstname_b']);
	$lastname_b = zen_db_prepare_input($_POST['lastname_b']);
	$street_address_b = zen_db_prepare_input($_POST['street_address_b']);
	if(ACCOUNT_SUBURB == 'true')$suburb_b = zen_db_prepare_input($_POST['suburb_b']);
	$postcode_b = zen_db_prepare_input($_POST['postcode_b']);
	$city_b = zen_db_prepare_input($_POST['city_b']);
	if(ACCOUNT_STATE == 'true')
	{
		$state_b = zen_db_prepare_input($_POST['state_b']);
		if(isset($_POST['zone_id_b']))
		{
			$zone_id_b = zen_db_prepare_input($_POST['zone_id_b']);
		}
		else
		{
			$zone_id_b = false;
		}
	}
	$country_b = zen_db_prepare_input($_POST['zone_country_id_b']);
	$telephone_b = zen_db_prepare_input($_POST['telephone_b']);
	//--------------------- 获取账单信息eof --------------------------------//
	if (ACCOUNT_GENDER == 'true')
	{
		if(($gender != 'm') && ($gender != 'f'))
		{
			$error = true;
			$messageStack->add('address_book_new', ENTRY_GENDER_ERROR);
		}
		if(($gender_b != 'm') && ($gender_b != 'f'))//-------账单性别验证
		{
			$error = true;
			$messageStack->add('address_book_new', ENTRY_GENDER_ERROR);
		}
	}
	if(strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_FIRST_NAME_ERROR);
	}
	if(strlen($firstname_b) < ENTRY_FIRST_NAME_MIN_LENGTH)//-----账单firstname验证
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_FIRST_NAME_ERROR);
	}
	if(strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_LAST_NAME_ERROR);
	}
	if(strlen($lastname_b) < ENTRY_LAST_NAME_MIN_LENGTH)//---------- 账单lastname验证
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_LAST_NAME_ERROR);
	}
	if (ACCOUNT_DOB == 'true')
	{
		if (ENTRY_DOB_MIN_LENGTH > 0 or !empty($_POST['dob']))
		{
			if (substr_count($dob,'/') > 2 || checkdate((int)substr(zen_date_raw($dob), 4, 2), (int)substr(zen_date_raw($dob), 6, 2), (int)substr(zen_date_raw($dob), 0, 4)) == false)
			{
				$error = true;
				$messageStack->add('address_book_new', ENTRY_DATE_OF_BIRTH_ERROR);
			}
		}
	}
	if (ACCOUNT_COMPANY == 'true')
	{
		if ((int)ENTRY_COMPANY_MIN_LENGTH > 0 && strlen($company) < ENTRY_COMPANY_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('address_book_new', ENTRY_COMPANY_ERROR);
		}
	}
	if ($phpBB->phpBB['installed'] == true)
	{
		if (strlen($nick) < ENTRY_NICK_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('address_book_new', ENTRY_NICK_LENGTH_ERROR);
		}
		else
		{
			// check Zen Cart for duplicate nickname
			$check_nick_query = "select * from " . TABLE_CUSTOMERS  . " where customers_nick = '" . $nick . "'";
			$check_nick = $db->Execute($check_nick_query);
			if ($check_nick->RecordCount() > 0 )
			{
				$error = true;
				$messageStack->add('address_book_new', ENTRY_NICK_DUPLICATE_ERROR);
			}
			// check phpBB for duplicate nickname
			if ($phpBB->phpbb_check_for_duplicate_nick($nick) == 'already_exists' )
			{
				$error = true;
				$messageStack->add('address_book_new', ENTRY_NICK_DUPLICATE_ERROR . ' (phpBB)');
			}
		}
	}
	
	if(strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_STREET_ADDRESS_ERROR);
	}
	if(strlen($street_address_b) < ENTRY_STREET_ADDRESS_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_STREET_ADDRESS_ERROR);
	}
	if(strlen($city) < ENTRY_CITY_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_CITY_ERROR);
	}
	if(strlen($city_b) < ENTRY_CITY_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_CITY_ERROR);
	}
	if(ACCOUNT_STATE == 'true')
	{
		$check_query = "SELECT count(*) AS total FROM " . TABLE_ZONES . " WHERE zone_country_id = :zoneCountryID";
		$check_query = $db->bindVars($check_query, ':zoneCountryID', $country, 'integer');
		$check = $db->Execute($check_query);
		$entry_state_has_zones = ($check->fields['total'] > 0);
		if ($entry_state_has_zones == true)
		{
			$zone_query = "SELECT distinct zone_id, zone_name, zone_code FROM " . TABLE_ZONES . " WHERE zone_country_id = :zoneCountryID AND " .((trim($state) != '' && $zone_id == 0) ? "(upper(zone_name) like ':zoneState%' OR upper(zone_code) like '%:zoneState%') OR " : "") ."zone_id = :zoneID ORDER BY zone_code ASC, zone_name";
			$zone_query = $db->bindVars($zone_query, ':zoneCountryID', $country, 'integer');
			// modified by zen-cart.cn
			$zone_query = $db->bindVars($zone_query, ':zoneState', GBcase($state,"upper"), 'noquotestring');
			$zone_query = $db->bindVars($zone_query, ':zoneID', $zone_id, 'integer');
			$zone = $db->Execute($zone_query);
			//look for an exact match on zone ISO code
			$found_exact_iso_match = ($zone->RecordCount() == 1);
			if ($zone->RecordCount() > 1)
			{
				while (!$zone->EOF && !$found_exact_iso_match)
				{
					if (strtoupper($zone->fields['zone_code']) == strtoupper($state) )
					{
						$found_exact_iso_match = true;
						continue;
					}
					$zone->MoveNext();
				}
			}
			if ($found_exact_iso_match)
			{
				$zone_id = $zone->fields['zone_id'];
				$zone_name = $zone->fields['zone_name'];
			}
			else
			{
				$error = true;
				$error_state_input = true;
				$messageStack->add('address_book_new', ENTRY_STATE_ERROR_SELECT);
			}
		}
		else
		{
			if (strlen($state) < ENTRY_STATE_MIN_LENGTH)
			{
				$error = true;
				$error_state_input = true;
				$messageStack->add('address_book_new', ENTRY_STATE_ERROR);
			}
			if (strlen($state_b) < ENTRY_STATE_MIN_LENGTH)
			{
				$error = true;
				$error_state_input = true;
				$messageStack->add('address_book_new', ENTRY_STATE_ERROR);
			}
		}
	}
	if(strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_POST_CODE_ERROR);
	}
	if(strlen($postcode_b) < ENTRY_POSTCODE_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_POST_CODE_ERROR);
	}
	if((is_numeric($country) == false) || ($country < 1))
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_COUNTRY_ERROR);
	}
	if((is_numeric($country_b) == false) || ($country_b < 1))
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_COUNTRY_ERROR);
	}
	if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_TELEPHONE_NUMBER_ERROR);
	}
	if (strlen($telephone_b) < ENTRY_TELEPHONE_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('address_book_new', ENTRY_TELEPHONE_NUMBER_ERROR);
	}
	if ($error == true)
	{
		// hook notifier class
		$zco_notifier->notify('');
        $redirect_address = false;
	}
	else
	{
		$sql_data_array = array('customers_id' => $_SESSION['customer_id'],
								'entry_firstname' => $firstname,
								'entry_lastname' => $lastname,
								'entry_street_address' => $street_address,
								'entry_postcode' => $postcode,
								'entry_city' => $city,
								'entry_country_id' => $country
								);
		if(ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
		if(ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
		if(ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
		if(ACCOUNT_STATE == 'true')
		{
			if($zone_id > 0)
			{
				$sql_data_array['entry_zone_id'] = $zone_id;
				$sql_data_array['entry_state'] = '';
			}
			else
			{
				$sql_data_array['entry_zone_id'] = '0';
				$sql_data_array['entry_state'] = $state;
			}
		}
		$sql_data_array['entry_telephone'] = $telephone;
		zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
		$address_id = $db->Insert_ID();
		$_SESSION['sendto'] = $address_id;
		$zco_notifier->notify('NOTIFY_MODULE_CREATE_ACCOUNT_ADDED_ADDRESS_BOOK_RECORD', array_merge(array('address_id' => $address_id), $sql_data_array));
		//检查主账户中信息是否完整
		$customers_sql="select customers_firstname,customers_lastname from ".TABLE_CUSTOMERS." where customers_id='".(int)$_SESSION['customer_id']."'";
		$customers_rs=$db->Execute($customers_sql);
		while(!$customers_rs->EOF)
		{
			if($customers_rs->fields['customers_firstname']=="" || $customers_rs->fields['customers_lastname']=="")
			$sql = "update " . TABLE_CUSTOMERS . " set customers_firstname = '" .$firstname . "',customers_lastname = '" .$lastname . "',customers_gender = '" .$gender . "',customers_telephone='".$telephone."' where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
			$db->Execute($sql);
			$customers_rs->MoveNext();
		}
		$sql = "update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
		$db->Execute($sql);
		//----------------- 将账单信息写入地址表 ---------------------------------//
		$sql_data_array_bill = array('customers_id' => $_SESSION['customer_id'],
									'entry_firstname' => $firstname_b,
									'entry_lastname' => $lastname_b,
									'entry_street_address' => $street_address_b,
									'entry_postcode' => $postcode_b,
									'entry_city' => $city_b,
									'entry_country_id' => $country_b,
									'address_type' => 1
									);       // 1代表是billing地址,默认为0,代表shipping地址, 2010/3/22 新增
		if(ACCOUNT_GENDER == 'true') $sql_data_array_bill['entry_gender'] = $gender_b;
		if(ACCOUNT_COMPANY == 'true') $sql_data_array_bill['entry_company'] = $company_b;
		if(ACCOUNT_SUBURB == 'true') $sql_data_array_bill['entry_suburb'] = $suburb_b;
		if(ACCOUNT_STATE == 'true')
		{
			if($zone_id > 0)
			{
				$sql_data_array_bill['entry_zone_id'] = $zone_id_b;
				$sql_data_array_bill['entry_state'] = '';
			}
			else
			{
				$sql_data_array_bill['entry_zone_id'] = '0';
				$sql_data_array_bill['entry_state'] = $state_b;
			}
		}
		$sql_data_array_bill['entry_telephone'] = $telephone_b;
		zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array_bill);
		//-------------------CRM 账单写入 eof ----------------------------------//
		//-------------- add 2010 5 6 --------------//
        try{
		//这里由于Last Name是必填的,所以设置默认为邮箱
		$crm_array = array();
		$crm_gender = $gender == 'f'?"女士":"先生";
		//$crm_id = crm_curl_getid('Contacts',STORE_NAME . '_' . $_SESSION['customer_id']);
        $crm_id = '';
		$crm_country = $db->Execute("select * from countries where countries_id='" . $country . "' or countries_id = '" . $country_b . "'");
		while(!$crm_country->EOF)
		{
			$crm_country_array[$crm_country->fields['countries_id']] = $crm_country->fields['countries_name'];
			$crm_country->MoveNext();
		}
		$lastname_crm = is_null($lastname)?'New':$lastname;
		$crm_array = array('Shipping Name' => $firstname . ' ' . $lastname,
							'Shipping Street' => $street_address,
							'Shipping City' => $city,
							'Shipping Zip' => $postcode,
							'Shipping State' => $state,
							'Shipping Country' => $crm_country_array[$country],
							'Billing Name' => $firstname_b . ' ' . $lastname_b,
							'Billing Street' => $street_address_b,
							'Billing City' => $city_b,
							'Billing Zip' => $postcode_b,
							'Billing State' => $state_b,
							'Billing Country' => $crm_country_array[$country_b]
							);
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
		//--------------CRM over ----------------------//
		if (SESSION_RECREATE == 'True')
		{
			zen_session_recreate();
		}
		// hook notifier class
		//$zco_notifier->notify('NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT');
        $redirect_address = true;
	} //endif !error
}
}
//--------------------------------------- 写入 eof --------------------------------------------------//
if(($process_address && !$redirect_address) || ($process_email && !$redirect_email)){
} else {
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
}

?>