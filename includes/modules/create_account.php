<?php
/**
* create_account header_php.php
*
* @package modules
* @copyright Copyright 2003-2007 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: create_account.php 6772 2007-08-21 12:33:29Z drbyte $
*/
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_MODULE_START_CREATE_ACCOUNT');
if (!defined('IS_ADMIN_FLAG'))
{
	die('Illegal Access');
}
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
$email_format = (ACCOUNT_EMAIL_PREFERENCE == '1' ? 'HTML' : 'TEXT');
$newsletter = (ACCOUNT_NEWSLETTER_STATUS == '1' ? false : true);
/**
* Process form contents
*/

//推荐好友的ID
if($_GET['ref'])
{
	$account_query = "SELECT customers_id FROM " . TABLE_CUSTOMERS . " WHERE customers_id = :customersID";

	$account_query = $db->bindVars($account_query, ':customersID', $_GET['ref'], 'integer');
	$account = $db->Execute($account_query);
	if($account->RecordCount()>0)
	{
		setcookie("customers_ref_id",$account->fields['customers_id'],time()+10*24*60*60);
	}
}



if (isset($_POST['action']) && ($_POST['action'] == 'process'))
{
	$process = true;
	if (ACCOUNT_GENDER == 'true')
	{
		if (isset($_POST['gender']))
		{
			$gender = zen_db_prepare_input($_POST['gender']);
		}
		else
		{
			$gender = false;
		}
	}

	if (isset($_POST['email_format']))$email_format = zen_db_prepare_input($_POST['email_format']);
	if (ACCOUNT_COMPANY == 'true') $company = zen_db_prepare_input($_POST['company']);
	$firstname = zen_db_prepare_input($_POST['firstname']);
	$lastname = zen_db_prepare_input($_POST['lastname']);
	$nick = zen_db_prepare_input($_POST['nick']);
	if (ACCOUNT_DOB == 'true') $dob = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_db_prepare_input($_POST['dob']));
	$email_address = zen_db_prepare_input($_POST['email_address']);
	$street_address = zen_db_prepare_input($_POST['street_address']);
	if (ACCOUNT_SUBURB == 'true') $suburb = zen_db_prepare_input($_POST['suburb']);
	$postcode = zen_db_prepare_input($_POST['postcode']);
	$city = zen_db_prepare_input($_POST['city']);
	if (ACCOUNT_STATE == 'true')
	{
		$state = zen_db_prepare_input($_POST['state']);
		if (isset($_POST['zone_id']))
		{
			$zone_id = zen_db_prepare_input($_POST['zone_id']);
		}
		else
		{
			$zone_id = false;
		}
	}
	$country = zen_db_prepare_input($_POST['zone_country_id']);
	$telephone = zen_db_prepare_input($_POST['telephone']);
	$telephone_b = zen_db_prepare_input($_POST['telephone_b']);
	$fax = zen_db_prepare_input($_POST['fax']);
	$customers_authorization = CUSTOMERS_APPROVAL_AUTHORIZATION;
	$customers_referral = zen_db_prepare_input($_POST['customers_referral']);
	if (isset($_POST['newsletter']))
	{
		$newsletter = zen_db_prepare_input($_POST['newsletter']);
	}
	$password = zen_db_prepare_input($_POST['password']);
	$confirmation = zen_db_prepare_input($_POST['confirmation']);
	if(isset($_POST['account_new'])&&$_POST['account_new'] == 'true')
	{  //-----------如果是填写了送货地址的,则验证
	//-------------------------------以下是获取的账单信息-------------------------------------//
	//--------- 其中有些内容 作了调整
		if (ACCOUNT_GENDER == 'true')
		{
			if (isset($_POST['gender_b']))
			{
				$gender_b = zen_db_prepare_input($_POST['gender_b']);
			}
			else
			{
				$gender_b = false;
			}
		}
		$firstname_b = zen_db_prepare_input($_POST['firstname_b']);
		$lastname_b = zen_db_prepare_input($_POST['lastname_b']);
		$street_address_b = zen_db_prepare_input($_POST['street_address_b']);
		if (ACCOUNT_SUBURB == 'true') $suburb_b = zen_db_prepare_input($_POST['suburb_b']);
		$postcode_b = zen_db_prepare_input($_POST['postcode_b']);
		$city_b = zen_db_prepare_input($_POST['city_b']);
		if (ACCOUNT_STATE == 'true')
		{
			$state_b = zen_db_prepare_input($_POST['state_b']);
			if (isset($_POST['zone_id_b']))
			{
				$zone_id_b = zen_db_prepare_input($_POST['zone_id_b']);
			}
			else
			{
				$zone_id_b = false;
			}
		}
		$country_b = zen_db_prepare_input($_POST['zone_country_id_b']);

		//--------------------- 获取账单信息eof --------------------------------//
		if (DISPLAY_PRIVACY_CONDITIONS == 'true')
		{
			if (!isset($_POST['privacy_conditions']) || ($_POST['privacy_conditions'] != '1'))
			{
				$error = true;
				$messageStack->add('create_account', ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED, 'error');
			}
		}
		if (ACCOUNT_GENDER == 'true')
		{
			if ( ($gender != 'm') && ($gender != 'f') )
			{
				$error = true;
				$messageStack->add('create_account', ENTRY_GENDER_ERROR);
			}
			if(($gender_b != 'm') && ($gender_b != 'f'))
			{   //-------账单性别验证
				$error = true;
				$messageStack->add('create_account', ENTRY_GENDER_ERROR);
			}
		}
		if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
		}
		if (strlen($firstname_b) < ENTRY_FIRST_NAME_MIN_LENGTH)//-----账单firstname验证
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
		}
		if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
		}
		if (strlen($lastname_b) < ENTRY_LAST_NAME_MIN_LENGTH)//---------- 账单lastname验证
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
		}
		if (ACCOUNT_DOB == 'true')
		{
			if (ENTRY_DOB_MIN_LENGTH > 0 or !empty($_POST['dob']))
			{
				if (substr_count($dob,'/') > 2 || checkdate((int)substr(zen_date_raw($dob), 4, 2), (int)substr(zen_date_raw($dob), 6, 2), (int)substr(zen_date_raw($dob), 0, 4)) == false)
				{
					$error = true;
					$messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
				}
			}
		}
		if (ACCOUNT_COMPANY == 'true')
		{
			if ((int)ENTRY_COMPANY_MIN_LENGTH > 0 && strlen($company) < ENTRY_COMPANY_MIN_LENGTH)
			{
				$error = true;
				$messageStack->add('create_account', ENTRY_COMPANY_ERROR);
			}
		}
	}
	if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
	}
	elseif (zen_validate_email($email_address) == false)
	{
		$error = true;
		$messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
	}
	else
	{
		$check_email_query = "select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . zen_db_input($email_address) . "'";
		$check_email = $db->Execute($check_email_query);
		if ($check_email->fields['total'] > 0)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
		}
	}
	if ($phpBB->phpBB['installed'] == true)
	{
		if (strlen($nick) < ENTRY_NICK_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_NICK_LENGTH_ERROR);
		}
		else
		{
			// check Zen Cart for duplicate nickname
			$check_nick_query = "select * from " . TABLE_CUSTOMERS  . " where customers_nick = '" . $nick . "'";
			$check_nick = $db->Execute($check_nick_query);
			if ($check_nick->RecordCount() > 0 )
			{
				$error = true;
				$messageStack->add('create_account', ENTRY_NICK_DUPLICATE_ERROR);
			}
			// check phpBB for duplicate nickname
			if ($phpBB->phpbb_check_for_duplicate_nick($nick) == 'already_exists' )
			{
				$error = true;
				$messageStack->add('create_account', ENTRY_NICK_DUPLICATE_ERROR . ' (phpBB)');
			}
		}
	}
	if(isset($_POST['account_new'])&&$_POST['account_new'] == 'true')//-----------如果是填写了送货地址的,则验证
	{
		if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
		}
		if (strlen($street_address_b) < ENTRY_STREET_ADDRESS_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
		}
		if (strlen($city) < ENTRY_CITY_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_CITY_ERROR);
		}
		if (strlen($city_b) < ENTRY_CITY_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_CITY_ERROR);
		}
		if (ACCOUNT_STATE == 'true')
		{
			$check_query = "SELECT count(*) AS total FROM " . TABLE_ZONES . " WHERE zone_country_id = :zoneCountryID";
			$check_query = $db->bindVars($check_query, ':zoneCountryID', $country, 'integer');
			$check = $db->Execute($check_query);
			$entry_state_has_zones = ($check->fields['total'] > 0);
			if ($entry_state_has_zones == true)
			{
				$zone_query = "SELECT distinct zone_id, zone_name, zone_code FROM " . TABLE_ZONES . " WHERE zone_country_id = :zoneCountryID AND " . ((trim($state) != '' && $zone_id == 0) ? "(upper(zone_name) like ':zoneState%' OR upper(zone_code) like '%:zoneState%') OR " : "") . "zone_id = :zoneID ORDER BY zone_code ASC, zone_name";
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
				else {
					$error = true;
					$error_state_input = true;
					$messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
				}
			}
			else
			{
				if (strlen($state) < ENTRY_STATE_MIN_LENGTH)
				{
					$error = true;
					$error_state_input = true;
					$messageStack->add('create_account', ENTRY_STATE_ERROR);
				}
				if (strlen($state_b) < ENTRY_STATE_MIN_LENGTH)
				{
					$error = true;
					$error_state_input = true;
					$messageStack->add('create_account', ENTRY_STATE_ERROR);
				}
			}
		}
		if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
		}
		if(strlen($postcode_b) < ENTRY_POSTCODE_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
		}
		if((is_numeric($country) == false) || ($country < 1))
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
		}
		if((is_numeric($country_b) == false) || ($country_b < 1))
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
		}
		if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
		}
		if (strlen($telephone_b) < ENTRY_TELEPHONE_MIN_LENGTH)
		{
			$error = true;
			$messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
		}
	}
	if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH)
	{
		$error = true;
		$messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
	}
	elseif($password != $confirmation)
	{
		$error = true;
		$messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
	}
	if ($error == true)
	{
		// hook notifier class
		$zco_notifier->notify('NOTIFY_FAILURE_DURING_CREATE_ACCOUNT');
	}
	else
	{
		if(isset($_COOKIE['customers_ref_id']) ||$_COOKIE['customers_ref_id']=="")$_COOKIE['customers_ref_id']=0;
		$sql_data_array = array('customers_firstname' => $firstname,
								'customers_lastname' => $lastname,
								'customers_email_address' => $email_address,
								'customers_nick' => $nick,
								'customers_telephone' => $telephone,
								'customers_fax' => $fax,
								'customers_newsletter' => (int)$newsletter,
								'customers_email_format' => 'HTML',
								'customers_default_address_id' => 0,
								'customers_password' => zen_encrypt_password($password),
								'customers_authorization' => (int)CUSTOMERS_APPROVAL_AUTHORIZATION,
								'geoip_referer'=>(int)@$_COOKIE['geoip_data_id'],
								'customers_ref_id'=>(int)@$_COOKIE['customers_ref_id']);
		if ((CUSTOMERS_REFERRAL_STATUS == '2' and $customers_referral != '')) $sql_data_array['customers_referral'] = $customers_referral;
		if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
		if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = (empty($_POST['dob']) || $dob_entered == '0001-01-01 00:00:00' ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_date_raw($_POST['dob']));
		//print_r($sql_data_array);
		//exit;
		zen_db_perform(TABLE_CUSTOMERS, $sql_data_array);
		$_SESSION['customer_id'] = $db->Insert_ID();

		$zco_notifier->notify('NOTIFY_START_REMENEBER_LOGIN');
		setcookie("users_email_address",$email_address,time()+10*24*60*60);
		setcookie("users_email_password",$password,time()+10*24*60*60);
		$zco_notifier->notify('NOTIFY_END_REMENEBER_LOGIN');
		$zco_notifier->notify('NOTIFY_MODULE_CREATE_ACCOUNT_ADDED_CUSTOMER_RECORD', array_merge(array('customer_id' => $_SESSION['customer_id']), $sql_data_array));
		if(isset($_POST['account_new'])&&$_POST['account_new'] == 'true')//-----------如果是填写了送货地址的,则验证
		{
			$sql_data_array = array('customers_id' => $_SESSION['customer_id'],
									'entry_firstname' => $firstname,
									'entry_lastname' => $lastname,
									'entry_street_address' => $street_address,
									'entry_postcode' => $postcode,
									'entry_city' => $city,
									'entry_country_id' => $country,
									'entry_telephone' => $telephone);
			if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
			if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
			if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
			if (ACCOUNT_STATE == 'true')
			{
				if ($zone_id > 0)
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
			zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
			$address_id = $db->Insert_ID();
			$zco_notifier->notify('NOTIFY_MODULE_CREATE_ACCOUNT_ADDED_ADDRESS_BOOK_RECORD', array_merge(array('address_id' => $address_id), $sql_data_array));
			$sql = "update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
			$db->Execute($sql);

			//----------------- 将账单信息写入地址表 ---------------------------------//
			$sql_data_array_bill= array('customers_id' => $_SESSION['customer_id'],
										'entry_firstname' => $firstname_b,
										'entry_lastname' => $lastname_b,
										'entry_street_address' => $street_address_b,
										'entry_postcode' => $postcode_b,
										'entry_city' => $city_b,
										'entry_country_id' => $country_b,
										'address_type' => 1);       // 1代表是billing地址,默认为0,代表shipping地址, 2010/3/22 新增
			if (ACCOUNT_GENDER == 'true') $sql_data_array_bill['entry_gender'] = $gender_b;
			if (ACCOUNT_COMPANY == 'true') $sql_data_array_bill['entry_company'] = $company_b;
			if (ACCOUNT_SUBURB == 'true') $sql_data_array_bill['entry_suburb'] = $suburb_b;
			if (ACCOUNT_STATE == 'true')
			{
				if ($zone_id > 0)
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

		//------------------- 账单写入 eof ----------------------------------//
		}

         //-------------- add 2010 5 6 --------------//
        //这里由于Last Name是必填的,所以设置默认为邮箱
        try{
        $crm_array = array();
        $crm_gender = $gender == 'f'?iconv("GBK","UTF-8","女士"):iconv("GBK","UTF-8","先生");
        $crm_country = $db->Execute("select * from countries where countries_id='" . $country . "' or countries_id = '" . $country_b . "'");
        while(!$crm_country->EOF){
            $crm_country_array[$crm_country->fields['countries_id']] = $crm_country->fields['countries_name'];
            $crm_country->MoveNext();
        }
        $lastname_crm = is_null($lastname)?$email_address:$lastname;
        $crm_array = array('websiteid'=>STORE_NAME . '_' . $_SESSION['customer_id'],
                           'First Name'=>$firstname,
                           'Last Name'=>$lastname_crm,
                           'Salutation'=> $crm_gender,
                           'Email'=>$email_address,
                           'Phone'=>$telephone,
                           'Mobile'=>$telephone,
                           'Fax'=>$fax,
                           'Shipping Name' => $firstname . ' ' . $lastname,
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
        //crm_curl_post('Contacts',$crm_array);
        $json_array = array('action' => 'Contacts',
                            'method' => 'insert',
                            'data' => $crm_array);
        $json = json_encode($json_array);
        $sql_json_array = array('type' => 'crm',
                                'json' => $json,
                                'status' => 0);
        zen_db_perform("sendmessage",$sql_json_array);

        } catch (Exception $e) {
        }
        //-------------- over ----------------------//

		$sql = "insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons,customers_info_date_account_created) values ('" . (int)$_SESSION['customer_id'] . "','0', now())";
		$db->Execute($sql);
		// phpBB create account
		if ($phpBB->phpBB['installed'] == true)
		{
			$phpBB->phpbb_create_account($nick, $password, $email_address);
		}
		// End phppBB create account
		if (SESSION_RECREATE == 'True')
		{
			zen_session_recreate();
		}
		$_SESSION['customer_first_name'] = $firstname;
		$_SESSION['customer_default_address_id'] = $address_id;
		$_SESSION['customer_country_id'] = $country;
		$_SESSION['customer_zone_id'] = $zone_id;
		$_SESSION['customers_authorization'] = $customers_authorization;
		// restore cart contents
		$_SESSION['cart']->restore_contents();
		// hook notifier class
		$zco_notifier->notify('NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT');
		// build the message content
		$name = $firstname . ' ' . $lastname;
		if (ACCOUNT_GENDER == 'true')
		{
			if ($gender == 'm')
			{
				$email_text = sprintf(EMAIL_GREET_MR, $lastname);
			}
			else
			{
				$email_text = sprintf(EMAIL_GREET_MS, $lastname);
			}
		}
		else
		{
			$email_text = sprintf(EMAIL_GREET_NONE, $firstname);
		}
		$html_msg['EMAIL_GREETING'] = str_replace('\n','',$email_text);
		$html_msg['EMAIL_FIRST_NAME'] = $firstname;
		$html_msg['EMAIL_LAST_NAME']  = $lastname;
		// initial welcome
		$email_text .=  EMAIL_WELCOME;
		$html_msg['EMAIL_WELCOME'] = str_replace('\n','',EMAIL_WELCOME);
		if (NEW_SIGNUP_DISCOUNT_COUPON != '' and NEW_SIGNUP_DISCOUNT_COUPON != '0')
		{
			$coupon_id = NEW_SIGNUP_DISCOUNT_COUPON;
			$coupon = $db->Execute("select * from " . TABLE_COUPONS . " where coupon_id = '" . $coupon_id . "'");
			$coupon_desc = $db->Execute("select coupon_description from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . $_SESSION['languages_id'] . "'");
			$db->Execute("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");
			$text_coupon_help = sprintf(TEXT_COUPON_HELP_DATE, zen_date_short($coupon->fields['coupon_start_date']),zen_date_short($coupon->fields['coupon_expire_date']));
			// if on, add in Discount Coupon explanation
			$email_text .= EMAIL_COUPON_INCENTIVE_HEADER .
			$email_text .= "\n" . EMAIL_COUPON_INCENTIVE_HEADER .(!empty($coupon_desc->fields['coupon_description']) ? $coupon_desc->fields['coupon_description'] . "\n\n" : '') . $text_coupon_help  . "\n\n" .strip_tags(sprintf(EMAIL_COUPON_REDEEM, ' ' . $coupon->fields['coupon_code'])) . EMAIL_SEPARATOR;
			$html_msg['COUPON_TEXT_VOUCHER_IS'] = EMAIL_COUPON_INCENTIVE_HEADER ;
			$html_msg['COUPON_DESCRIPTION']     = (!empty($coupon_desc->fields['coupon_description']) ? '<strong>' . $coupon_desc->fields['coupon_description'] . '</strong>' : '');
			$html_msg['COUPON_TEXT_TO_REDEEM']  = str_replace("\n", '', sprintf(EMAIL_COUPON_REDEEM, ''));
			$html_msg['COUPON_CODE']  = $coupon->fields['coupon_code'] . $text_coupon_help;
		} //endif coupon
		if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0)
		{
			$coupon_code = zen_create_coupon_code();
			$insert_query = $db->Execute("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
			$insert_id = $db->Insert_ID();
			$db->Execute("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");
			// if on, add in GV explanation
			$email_text .= "\n\n" . sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) .sprintf(EMAIL_GV_REDEEM, $coupon_code) .EMAIL_GV_LINK . zen_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code, 'NONSSL', false) . "\n\n" .EMAIL_GV_LINK_OTHER . EMAIL_SEPARATOR;
			$html_msg['GV_WORTH'] = str_replace('\n','',sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) );
			$html_msg['GV_REDEEM'] = str_replace('\n','',str_replace('\n\n','<br />',sprintf(EMAIL_GV_REDEEM, '<strong>' . $coupon_code . '</strong>')));
			$html_msg['GV_CODE_NUM'] = $coupon_code;
			$html_msg['GV_CODE_URL'] = str_replace('\n','',EMAIL_GV_LINK . '<a href="' . zen_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code, 'NONSSL', false) . '">' . TEXT_GV_NAME . ': ' . $coupon_code . '</a>');
			$html_msg['GV_LINK_OTHER'] = EMAIL_GV_LINK_OTHER;
		} // endif voucher
		// add in regular email welcome text
		$email_text .= "\n\n" . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_GV_CLOSURE;
		$html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT);
		$html_msg['EMAIL_CONTACT_OWNER'] = str_replace('\n','',EMAIL_CONTACT);
		$html_msg['EMAIL_CLOSURE']       = nl2br(EMAIL_GV_CLOSURE);
		// include create-account-specific disclaimer
		$email_text .= "\n\n" . sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, STORE_OWNER_EMAIL_ADDRESS). "\n\n";
		$html_msg['EMAIL_DISCLAIMER'] = sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');
		// send welcome email
		zen_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, $html_msg, 'welcome');
		// send additional emails
		if (SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS == '1' and SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO !='')
		{
			if ($_SESSION['customer_id'])
			{
				$account_query = "select customers_firstname, customers_lastname, customers_email_address, customers_telephone, customers_fax from " . TABLE_CUSTOMERS . "
				where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
				$account = $db->Execute($account_query);
			}
			$extra_info=email_collect_extra_info($name,$email_address, $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'], $account->fields['customers_email_address'], $account->fields['customers_telephone'], $account->fields['customers_fax']);
			$html_msg['EXTRA_INFO'] = $extra_info['HTML'];
			zen_mail('', SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO, SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT . ' ' . EMAIL_SUBJECT,
			$email_text . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'welcome_extra');
		} //endif send extra emails
		zen_redirect(zen_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
	} //endif !error
}
/*
* Set flags for template use:
*/
if($_COOKIE['geoip_country']!="")
{
	$geoip_country_sql="select countries_id from ".TABLE_COUNTRIES." where countries_name='".$_COOKIE['geoip_country']."'";
	$geoip_country=$db->Execute($geoip_country_sql);
	if($geoip_country->RecordCount() > 1)
	{
		$geoip_country_id=$geoip_country->fields['countries_id'];
	}
}
$selected_country = (isset($_POST['zone_country_id']) && $_POST['zone_country_id'] != '') ? $country : (($geoip_country_id!="")?$geoip_country_id:SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY);
$flag_show_pulldown_states = ((($process == true || $entry_state_has_zones == true) && $zone_name == '') || ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN == 'true' || $error_state_input) ? true : false;
$state = ($flag_show_pulldown_states) ? ($state == '' ? '&nbsp;' : $state) : $zone_name;
$state_field_label = ($flag_show_pulldown_states) ? '' : ENTRY_STATE;
// This should be last line of the script:
$zco_notifier->notify('NOTIFY_MODULE_END_CREATE_ACCOUNT');
?>