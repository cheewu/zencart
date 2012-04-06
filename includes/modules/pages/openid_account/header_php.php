<?php
/**
 * create_account header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4035 2006-07-28 05:49:06Z drbyte $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CREATE_ACCOUNT');

if(!empty($_REQUEST['token'])){
    $post['token'] = $_REQUEST['token'];
    $post['apiKey'] = 'ec4dfc40d6b811c3fd3b562e87dfadbd91a0d20b';
    $post['format'] = 'json';
    $curl = curl_init();
    //$url = 'https://rpxnow.com/api/v2/auth_info?token_url='.urlencode('http://127.0.0.1/test/test10.php');
    $url = 'https://rpxnow.com/api/v2/auth_info?token_url='.urlencode('http://www.golouisvuitton.com/index.php?main_page=openid_account');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_URL, $url);
    $data = curl_exec($curl);

    curl_close($curl);
    
    $openid_obj = json_decode($data);

    if($openid_obj->stat == 'ok'){
        $email_address = $openid_obj->profile->email;
        $providerName = $openid_obj->profile->providerName;
        
        //----------  根据不同网站返回的 数据不同 ,做不同处理,目的 都是得到 id ------------//
        switch($providerName){
            case 'Google':
                $openid = 'Google_' . $openid_obj->profile->googleUserId;
                $firstname = $openid_obj->profile->name->givenName;
                $lastname = $openid_obj->profile->name->familyName;
                break;
            case 'Facebook':
                $re_id = substr($openid_obj->profile->identifier,strrpos($openid_obj->profile->identifier,'id=')+3);
                $openid = 'Facebook_' . $re_id;
                $firstname = $openid_obj->profile->name->givenName;
                $lastname = $openid_obj->profile->name->familyName;
                break;
            case 'Twitter':
                $re_id = substr($openid_obj->profile->identifier,strrpos($openid_obj->profile->identifier,'user_id=')+8);
                $openid = 'Twitter_' . $re_id;
                $name = $openid_obj->profile->name->formatted;
                list($firstname,$lastname) = explode(" ",$name);
                break;
            default:
                $openid = 'unknown_' . date("YmdHis");
                break;
            }
        //---------------------------------------------------------------------------------//
        
        $openid_sql = "select * from " . TABLE_CUSTOMERS . " where openid = '" . $openid . "'";
        $openid_result = $db->execute($openid_sql);

        if($openid_result->RecordCount()>0){
//---------------------------------------------如果 数据库里存在 这个openid,则直接登录
    // Check if email exists
    $check_customer_query = "SELECT customers_id, customers_firstname, customers_lastname, customers_password,
                                    customers_email_address, customers_default_address_id,
                                    customers_authorization, customers_referral
                           FROM " . TABLE_CUSTOMERS . "
                           WHERE openid = :openid";

    $check_customer_query  =$db->bindVars($check_customer_query, ':openid', $openid, 'string');
    $check_customer = $db->Execute($check_customer_query);

        if (SESSION_RECREATE == 'True') {
          zen_session_recreate();
        }

        $check_country_query = "SELECT entry_country_id, entry_zone_id
                              FROM " . TABLE_ADDRESS_BOOK . "
                              WHERE customers_id = :customersID
                              AND address_book_id = :addressBookID";

        $check_country_query = $db->bindVars($check_country_query, ':customersID', $check_customer->fields['customers_id'], 'integer');
        $check_country_query = $db->bindVars($check_country_query, ':addressBookID', $check_customer->fields['customers_default_address_id'], 'integer');
        $check_country = $db->Execute($check_country_query);

        $_SESSION['customer_id'] = $check_customer->fields['customers_id'];
        $_SESSION['customer_default_address_id'] = $check_customer->fields['customers_default_address_id'];
        $_SESSION['customers_authorization'] = $check_customer->fields['customers_authorization'];
        $_SESSION['customer_first_name'] = $check_customer->fields['customers_firstname'];
        $_SESSION['customer_last_name'] = $check_customer->fields['customers_lastname'];
        $_SESSION['customer_country_id'] = $check_country->fields['entry_country_id'];
        $_SESSION['customer_zone_id'] = $check_country->fields['entry_zone_id'];

        $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
              SET customers_info_date_of_last_logon = now(),
                  customers_info_number_of_logons = customers_info_number_of_logons+1
              WHERE customers_info_id = :customersID";

        $sql = $db->bindVars($sql, ':customersID',  $_SESSION['customer_id'], 'integer');
        $db->Execute($sql);
        $zco_notifier->notify('NOTIFY_LOGIN_SUCCESS');

        // bof: contents merge notice
        // save current cart contents count if required
        if (SHOW_SHOPPING_CART_COMBINED > 0) {
          $zc_check_basket_before = $_SESSION['cart']->count_contents();
        }
		$zco_notifier->notify('NOTIFY_START_REMENEBER_LOGIN');
		$zco_notifier->notify('NOTIFY_END_REMENEBER_LOGIN');
        // bof: not require part of contents merge notice
        // restore cart contents
        $_SESSION['cart']->restore_contents();
        // eof: not require part of contents merge notice

        // check current cart contents count if required
        if (SHOW_SHOPPING_CART_COMBINED > 0 && $zc_check_basket_before > 0) {
          $zc_check_basket_after = $_SESSION['cart']->count_contents();
          if (($zc_check_basket_before != $zc_check_basket_after) && $_SESSION['cart']->count_contents() > 0 && SHOW_SHOPPING_CART_COMBINED > 0) {
            if (SHOW_SHOPPING_CART_COMBINED == 2) {
              // warning only do not send to cart
              $messageStack->add_session('header', WARNING_SHOPPING_CART_COMBINED, 'caution');
            }
            if (SHOW_SHOPPING_CART_COMBINED == 1) {
              // show warning and send to shopping cart for review
              $messageStack->add_session('shopping_cart', WARNING_SHOPPING_CART_COMBINED, 'caution');
              zen_redirect(zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'));
            }
          }
        }
        // eof: contents merge notice

        if (sizeof($_SESSION['navigation']->snapshot) > 0) {
          //    $back = sizeof($_SESSION['navigation']->path)-2;
          //if (isset($_SESSION['navigation']->path[$back]['page'])) {
          //    if (sizeof($_SESSION['navigation']->path)-2 > 0) {
          $origin_href = zen_href_link($_SESSION['navigation']->snapshot['page'], zen_array_to_string($_SESSION['navigation']->snapshot['get'], array(zen_session_name())), $_SESSION['navigation']->snapshot['mode']);
          //            $origin_href = zen_back_link_only(true);
          $_SESSION['navigation']->clear_snapshot();
          zen_redirect($origin_href);
        } else {
          zen_redirect(zen_href_link(FILENAME_DEFAULT, '', $request_type));
        }
      
//---------------------------------------------------------------
        } else {
            //-------------------------------------如果不存在 就创建
$process = false;
$zone_name = '';
$entry_state_has_zones = '';
$error_state_input = false;
$state = '';
$zone_id = 0;
$error = false;
$email_format = 'HTML';
$newsletter = false;
/**
* Process form contents
*/

	$process = true;

	if (ACCOUNT_DOB == 'true') $dob = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_db_prepare_input($_POST['dob']));
	$email_address = zen_db_prepare_input($email_address);

	$customers_authorization = CUSTOMERS_APPROVAL_AUTHORIZATION;

    $newsletter = zen_db_prepare_input($_POST['newsletter']);

	$password = zen_db_prepare_input($_POST['password']);
	$confirmation = zen_db_prepare_input($_POST['confirmation']);

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
                                'openid'=>$openid);
		if ((CUSTOMERS_REFERRAL_STATUS == '2' and $customers_referral != '')) $sql_data_array['customers_referral'] = $customers_referral;
		if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
		if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = (empty($_POST['dob']) || $dob_entered == '0001-01-01 00:00:00' ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_date_raw($_POST['dob']));
		//print_r($sql_data_array);
		//exit;
		zen_db_perform(TABLE_CUSTOMERS, $sql_data_array);
		$_SESSION['customer_id'] = $db->Insert_ID();

		$zco_notifier->notify('NOTIFY_START_REMENEBER_LOGIN');
		$zco_notifier->notify('NOTIFY_END_REMENEBER_LOGIN');
		$zco_notifier->notify('NOTIFY_MODULE_CREATE_ACCOUNT_ADDED_CUSTOMER_RECORD', array_merge(array('customer_id' => $_SESSION['customer_id']), $sql_data_array));

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
        $lastname_crm = is_null($lastname)?'New':$lastname;
        $crm_array = array('websiteid'=>STORE_NAME . '_' . $_SESSION['customer_id'],
                           'First Name'=>$firstname,
                           'Last Name'=>$lastname_crm,
                           'Salutation'=> $crm_gender,
                           'Email'=>$email_address
                           );
        crm_curl_post('Contacts',$crm_array);
        } catch (Exception $e) {
        }
        //-------------- over ----------------------//

		$sql = "insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons,customers_info_date_account_created) values ('" . (int)$_SESSION['customer_id'] . "','0', now())";
		$db->Execute($sql);
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

/*
* Set flags for template use:
*/

$zco_notifier->notify('NOTIFY_MODULE_END_CREATE_ACCOUNT');
zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'NONSSL'));
            //---------------------------------------------------------------
        }
    } else {
    }
}
?>

<script type="text/javascript">
  var rpxJsHost = (("https:" == document.location.protocol) ? "https://" : "http://static.");
  document.write(unescape("%3Cscript src='" + rpxJsHost +
"rpxnow.com/js/lib/rpx.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  RPXNOW.overlay = true;
  RPXNOW.language_preference = 'en';
</script>


<a class="rpxnow" onclick="return false;"
   href="https://rye.rpxnow.com/openid/v2/signin?token_url=http://www.borsalouisvuitton.com/index.php?main_page=openid_account">
  Sign In
</a>