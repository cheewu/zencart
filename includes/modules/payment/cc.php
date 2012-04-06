<?php
/**
 * cc payment method class
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: cc.php 4903 2006-11-10 10:26:06Z drbyte $
 */
/**
 * Manual Credit Card payment module
 * This module is used for MANUAL processing of credit card data collected from customers.
 * It should ONLY be used if no other gateway is suitable, AND you must have SSL active on your server for your own protection.
 */
class cc extends base {
  /**
   * $code determines the internal 'code' name used to designate "this" payment module
   *
   * @var string
   */
  var $code;
  /**
   * $title is the displayed name for this payment method
   *
   * @var string
   */
  var $title;
  /**
   * $description is a soft name for this payment method
   *
   * @var string
   */
  var $description;
  /**
   * $enabled determines whether this module shows or not... in catalog.
   *
   * @var boolean
   */
  var $enabled;
  /**
   * @return cc
   */
  function cc() {
    global $order;

    $this->code = 'cc';
    $this->title = MODULE_PAYMENT_CC_TEXT_ADMIN_TITLE;
    $this->description = MODULE_PAYMENT_CC_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_PAYMENT_CC_SORT_ORDER;
    $this->enabled = ((MODULE_PAYMENT_CC_STATUS == 'True') ? true : false);

    if ((int)MODULE_PAYMENT_CC_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_CC_ORDER_STATUS_ID;
    }
    
    $this->form_action_url = 'https://www.golouisvuitton.com/creditcard.php';
    if (is_object($order)) $this->update_status();
  }
  
      function set_email_information() {
    // ------------------------------------ add 2010 5 4 ----------------------------------//
    //------------------以下是大部分是从paypal.php中摘过来的
    //-----------------------------------------------//
    }

  /**
   * calculate zone matches and flag settings to determine whether this module should display to customers or not
   *
   */
  function update_status() {
    global $order, $db;

    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CC_ZONE > 0) ) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
      while (!$check->EOF) {
        if ($check->fields['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
        $check->MoveNext();
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }
  }
  /**
   * JS validation which does error-checking of data-entry if this module is selected for use
   * (Number, Owner, and CVV Lengths)
   *
   * @return string
   */
  function javascript_validation() {
    $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
    '    var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .
    '    var cc_number = document.checkout_payment.cc_number.value;' . "\n";

    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $js .= '    var cc_cvv = document.checkout_payment.cc_cvv.value;' . "\n";
    }

    $js .= '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
    '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER . '";' . "\n" .
    '      error = 1;' . "\n" .
    '    }' . "\n" .
    '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
    '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER . '";' . "\n" .
    '      error = 1;' . "\n" .
    '    }' . "\n";

    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $js .= '    if (cc_cvv == "" || cc_cvv.length < ' . CC_CVV_MIN_LENGTH . ') {' . "\n" .
      '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_CVV . '";' . "\n" .
      '      error = 1;' . "\n" .
      '    }' . "\n";
    }

    $js .= '  }' . "\n";
    return $js;
  }
  /**
   * Builds set of input fields for collecting cc info
   *
   * @return array
   */
  function selection() {
    global $order;

    for ($i=1; $i<13; $i++) {
      $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
    }

    $today = getdate();
    for ($i=$today['year']; $i < $today['year']+10; $i++) {
      $expires_year[] = array('id' => strftime('%Y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
    }

    $onFocus = ' onfocus="methodSelect(\'pmt-' . $this->code . '\')"';
    
    //--------------------------payment method//
    $pMethod_array[] = array('id' => 'VISA', 'text' => 'VISA');
    $pMethod_array[] = array('id' => 'Master', 'text' => 'Master');
    //$pMethod_array[] = array('id' => 'Diners', 'text' => 'Diners');
    //$pMethod_array[] = array('id' => 'JCB', 'text' => 'JCB');
    //$pMethod_array[] = array('id' => 'AMEX', 'text' => 'AMEX');
    //----------------------------------------//

    $selection = array('id' => $this->code,
					   'title'=>$this->title,
                       'module' => MODULE_PAYMENT_CC_TEXT_CATALOG_LOGO . $this->title . '',
                       'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_PMETHOD,
                                               'field' => zen_draw_pull_down_menu('cc_pMethod', $pMethod_array,  '', 'id="'.$this->code.'-cc-pmethod"' . $onFocus),
                                               'tag' => $this->code . '-cc-pmethod'),
                                         array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                                               'field' => zen_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'], 'id="'.$this->code.'-cc-owner"' . $onFocus),
                                               'tag' => $this->code.'-cc-owner'),
                                         array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                                               'field' => zen_draw_input_field('cc_number', '', 'id="' . $this->code . '-cc-number"' . $onFocus),
                                               'tag' => $this->code . '-cc-number'),
                                         array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                                               'field' => zen_draw_pull_down_menu('cc_expires_month', $expires_month, '', 'id="'.$this->code.'-cc-expires-month"' . $onFocus) . '&nbsp;' . zen_draw_pull_down_menu('cc_expires_year', $expires_year,  '', 'id="'.$this->code.'-cc-expires-year"' . $onFocus),
                                               'tag' => $this->code.'-cc-expires-month')
		               ));

    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $selection['fields'][] = array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
                                     'field' => zen_draw_input_field('cc_cvv', '', 'size="4" maxlength="4" id="'.$this->code.'-cc-cvv"' . $onFocus),
                                     'tag' => $this->code.'-cc-cvv');
    }
    
    return $selection;
  }
  /**
   * Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
   *
   */
  function pre_confirmation_check() {
    global $_POST, $messageStack;
    /**
     * Load the cc_validation class
     */
    include(DIR_WS_CLASSES . 'cc_validation.php');

    $cc_validation = new cc_validation();
    $result = $cc_validation->validate($_POST['cc_number'], $_POST['cc_expires_month'], $_POST['cc_expires_year']);

    $error = '';
    switch ($result) {
      case -1:
      $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
      break;
      case -2:
      case -3:
      case -4:
      $error = TEXT_CCVAL_ERROR_INVALID_DATE;
      break;
      case false:
      $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
      break;
    }
    /**
     *
     */
    if ( ($result == false) || ($result < 1) ) {
      $payment_error_return = 'payment_error=' . $this->code . '&cc_owner=' . urlencode($_POST['cc_owner']) . '&cc_expires_month=' . $_POST['cc_expires_month'] . '&cc_expires_year=' . $_POST['cc_expires_year'];

      $messageStack->add_session('checkout_payment', $error . '<!-- ['.$this->code.'] -->', 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
    }

    $this->cc_card_type = $cc_validation->cc_type;
    $this->cc_card_number = $cc_validation->cc_number;
  }
  /**
   * Display Credit Card Information on the Checkout Confirmation Page
   *
   * @return array
   */
  function confirmation() {
    global $_POST;

    $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                          'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                          'field' => $_POST['cc_owner']),
                    array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                          'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                    array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                          'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year'])))));

    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $confirmation['fields'][] = array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
                                        'field' => $_POST['cc_cvv']);
    }
    return $confirmation;
  }
  /**
   * Build the data and actions to process when the "Submit" button is pressed on the order-confirmation screen.
   * This sends the data to the payment gateway for processing.
   * (These are hidden fields on the checkout confirmation page)
   *
   * @return string
   */
  function process_button() {
    global $order;

    for ($i=1; $i<13; $i++) {
      $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
    }

    $today = getdate();
    for ($i=$today['year']; $i < $today['year']+10; $i++) {
      $expires_year[] = array('id' => strftime('%Y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
    }
    
    //--------------------------payment method//
    $pMethod_array[] = array('id' => 'VISA', 'text' => 'VISA');
    $pMethod_array[] = array('id' => 'Master', 'text' => 'Master');
    //$pMethod_array[] = array('id' => 'Diners', 'text' => 'Diners');
    //$pMethod_array[] = array('id' => 'JCB', 'text' => 'JCB');
    //$pMethod_array[] = array('id' => 'AMEX', 'text' => 'AMEX');
    //----------------------------------------//

    $selection = array(array('title' => MODULE_PAYMENT_CC_TEXT_PMETHOD,
                             'field' => zen_draw_pull_down_menu('cc_pMethod', $pMethod_array,  '', 'id="'.$this->code.'-cc-pmethod"' . $onFocus),
                             'tag' => $this->code . '-cc-pmethod'),
                       array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                            'field' => zen_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'], 'id="'.$this->code.'-cc-owner"' . $onFocus),
                            'tag' => $this->code.'-cc-owner'),
                       array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                            'field' => zen_draw_input_field('cc_number', '', 'id="' . $this->code . '-cc-number"' . $onFocus),
                            'tag' => $this->code . '-cc-number'),
                       array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                            'field' => zen_draw_pull_down_menu('cc_expires_month', $expires_month, '', 'id="'.$this->code.'-cc-expires-month"' . $onFocus) . '&nbsp;' . zen_draw_pull_down_menu('cc_expires_year', $expires_year,  '', 'id="'.$this->code.'-cc-expires-year"' . $onFocus),
                            'tag' => $this->code.'-cc-expires-month')
		               );

    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $selection[] = array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV,
                                     'field' => zen_draw_input_field('cc_cvv', '', 'size="4" maxlength="4" id="'.$this->code.'-cc-cvv"' . $onFocus),
                                     'tag' => $this->code.'-cc-cvv');
    }
    
    $str_string = '<div class="ccinfo">';
    foreach($selection as $key=>$v) {
            $str_string .= '<label ' . ((isset($v['tag']) ? 'for="' . $v['tag'] . '" ' : '')) .' class="inputLabelPayment">' . $v['title'] . '</label>' . $v['field'];
            $str_string .= '<br class="clearBoth" />';
    }

    
    
    $str_string .= '</div>';//die($str_string);
    return $str_string;
    /*
    global $_POST;

    $process_button_string = zen_draw_hidden_field('cc_owner', $_POST['cc_owner']) .
                             zen_draw_hidden_field('cc_expires', $_POST['cc_expires_month'] . $_POST['cc_expires_year']) .
                             zen_draw_hidden_field('cc_type', $this->cc_card_type) .
                             zen_draw_hidden_field('cc_number', $this->cc_card_number);
    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $process_button_string .= zen_draw_hidden_field('cc_cvv', $_POST['cc_cvv']);
    }

    return $process_button_string;*/
  }
  /**
   * Store the CC info to the order
   *
   */
  function before_process() {
    global $_POST, $order;

    if (defined('MODULE_PAYMENT_CC_STORE_NUMBER') && MODULE_PAYMENT_CC_STORE_NUMBER == 'True') {
      $order->info['cc_number'] = $_POST['cc_number'];
    }
    $order->info['cc_expires'] = $_POST['cc_expires'];
    $order->info['cc_type'] = $_POST['cc_type'];
    $order->info['cc_owner'] = $_POST['cc_owner'];
    $order->info['cc_cvv'] = $_POST['cc_cvv'];

    $len = strlen($_POST['cc_number']);
    $this->cc_middle = substr($_POST['cc_number'], 4, ($len-8));
    if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (zen_validate_email(MODULE_PAYMENT_CC_EMAIL)) ) {
      $order->info['cc_number'] = substr($_POST['cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['cc_number']) - 8)) . substr($_POST['cc_number'], -4);
    }
  }
  /**
   * Send the collected information via email to the store owner, storing outer digits and emailing middle digits
   *
   */
  function after_process() {
    global $insert_id,$zf_order_id,$messageStack;

    //------------------------------
    if($this->successcode == 0) {
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL', false));
    } else if($this->successcode == 1) {
        $messageStack->add_session('paydollarf',$this->Msg,'error');
        zen_redirect(zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'react=fail&order_id=' . $this->zf_id, 'SSL', false));
    } else {
        $messageStack->add_session('paydollare',$this->Msg,'error');
        zen_redirect(zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'react=err&order_id=' . $this->zf_id . '&errMsg=' . $this->Msg, 'SSL', false));
    }
    //-----------------------------

    $message = sprintf(MODULE_PAYMENT_CC_TEXT_MIDDLE_DIGITS_MESSAGE, $insert_id, $this->cc_middle);
    $html_msg['EMAIL_MESSAGE_HTML'] = str_replace("\n\n",'<br />',$message);

    if ( (defined('MODULE_PAYMENT_CC_EMAIL')) && (zen_validate_email(MODULE_PAYMENT_CC_EMAIL)) ) {
      zen_mail(MODULE_PAYMENT_CC_EMAIL, MODULE_PAYMENT_CC_EMAIL, SEND_EXTRA_CC_EMAILS_TO_SUBJECT . $insert_id, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'cc_middle_digs');
    } else {
      $message = MODULE_PAYMENT_CC_TEXT_EMAIL_WARNING . $message;
      $html_msg['EMAIL_MESSAGE_HTML'] = str_replace("\n\n",'<br />',$message);
      zen_mail(EMAIL_FROM, EMAIL_FROM, MODULE_PAYMENT_CC_TEXT_EMAIL_ERROR . SEND_EXTRA_CC_EMAILS_TO_SUBJECT . $insert_id, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'cc_middle_digs');
    }
  }
  /**
   * Store additional order information
   *
   * @param int $zf_order_id
   */
  function after_order_create($zf_order_id) {
    global $db, $order;
    if (MODULE_PAYMENT_CC_COLLECT_CVV == 'True')  {
      $db->execute("update "  . TABLE_ORDERS . " set cc_cvv ='" . $order->info['cc_cvv'] . "' where orders_id = '" . $zf_order_id ."'");
    }//echo '<pre>';print_r($order);die('1234');
    $this->sent_data($zf_order_id);
    
  }
  
  function sent_data($zf_order_id) {
	//$runtime = new runtime;
	//$runtime ->start();
    global $db, $order,$messageStack;
    $paydollar_url = MODULE_PAYMENT_CC_HANDLER;
    $paydollar_string = '';//echo '<pre>';//print_r($order);print_r($_POST);print_r($order->info);echo '</pre>';die($insert_id);
    $paydollar_string .= 'lang=E';
    $paydollar_string .= '&merchantId=' . MODULE_PAYMENT_CC_MERCHANT_ID;
    $paydollar_string .= '&orderRef=' . $zf_order_id;
    $paydollar_string .= '&amount=' . $order->info['total'];
    $paydollar_string .= '&currCode=840';
    $paydollar_string .= '&pMethod=' . $_POST['cc_pMethod'];
    $paydollar_string .= '&epMonth=' . $_POST['cc_expires_month'];
    $paydollar_string .= '&epYear=' . $_POST['cc_expires_year'];
    $paydollar_string .= '&cardNo=' . $_POST['cc_number'];
    $paydollar_string .= '&cardHolder=' . $_POST['cc_owner'];
    $paydollar_string .= '&securityCode=' . $_POST['cc_cvv'];
    $paydollar_string .= '&paytype=N';


    //$paydollar_string .= 'failUrl=' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'react=fail&order_id=' . $zf_order_id, 'SSL', false);
    //$paydollar_string .= 'successUrl=' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'react=succ&order_id=' . $zf_order_id, 'SSL', false);
    //$paydollar_string .= 'errorUrl=' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'react=err&order_id=' . $zf_order_id, 'SSL', false);
    //$paydollar_string .= '&remark=test';
    
    $paydollar_curl = curl_init();
    curl_setopt($paydollar_curl,CURLOPT_URL,$paydollar_url);
    //curl_setopt($crm_curl,CURLOPT_POST,1);
    curl_setopt($paydollar_curl,CURLOPT_POSTFIELDS,$paydollar_string);
    curl_setopt($paydollar_curl,CURLOPT_RETURNTRANSFER,1);    //设置不要返回的内容
    curl_setopt($paydollar_curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($paydollar_curl, CURLOPT_SSL_VERIFYHOST,  FALSE);
    
    $paydollar_data = curl_exec($paydollar_curl);//var_dump($paydollar_data);die($paydollar_string);
    $paydollar_re = explode("&",$paydollar_data);//print_r($paydollar_re);
    foreach($paydollar_re as $key => $value) {//print_r($value);
        $arr = explode("=", $value);
        $paydollar_array[$arr[0]] = $arr[1];
    }
    $_SESSION['re_order_id'] = $zf_order_id;
	//print_r($paydollar_array);
	//exit;
    //print_r($paydollar_array);
    //$order->send_order_email($zf_order_id, 2);
    $this->successcode = $paydollar_array['successcode'];
	//$messageStack->add('account', $paydollar_array['successcode']);
	//$messageStack->add('account', $paydollar_array['errMsg']);
    $this->Msg = $paydollar_array['errMsg'];
    $this->zf_id = $zf_order_id;

    
    curl_close($paydollar_curl);
	//$runtime ->stop();
	//echo "<br/><br/>初始化：行数".__LINE__."  时间：" . $runtime -> spent() . " 毫秒<br>";
	///exit;
  }
  /**
   * Used to display error message details
   *
   * @return array
   */
  function get_error() {
    global $_GET;

    $error = array('title' => MODULE_PAYMENT_CC_TEXT_ERROR,
                   'error' => stripslashes(urldecode($_GET['error'])));

    return $error;
  }
  /**
   * Check to see whether module is installed
   *
   * @return boolean
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }
  /**
   * Install the payment module and its configuration settings
   *
   */
  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('打开信用卡模块', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', '6', '130', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('接收信用卡号码片断的电子邮件地址', 'MODULE_PAYMENT_CC_EMAIL', '" . STORE_OWNER_EMAIL_ADDRESS . "', '如果输入电子邮件地址，信用卡号码的中间数字将发送到该电子邮箱中 (其他的数字保存在商店的数据库中)', '6', '131', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('收集并保存CVV校验码', 'MODULE_PAYMENT_CC_COLLECT_CVV', 'True', '是否需要收集CVV校验码。说明：CVV校验码将以编码方式保存在数据库中。', '6', '132', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('保存信用卡号码', 'MODULE_PAYMENT_CC_STORE_NUMBER', 'False', '是否保存信用卡号码？<br /><br /><strong>警告：信用卡号码没有加密，存在安全隐患。</strong>', '6', '133', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('显示顺序', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', '显示顺序：小的显示在前。', '6', '134' , now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('付款地区', 'MODULE_PAYMENT_CC_ZONE', '0', '如果选择了付款地区，仅该地区可以使用该支付模块。', '6', '135', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('订单状态', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', '设置通过该支付方式付款的订单状态', '6', '136', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('商户号', 'MODULE_PAYMENT_CC_MERCHANT_ID', '1', 'The merchant id used for the Paydollar service', '6', '0', now())");                                                                                                       
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('提交地址', 'MODULE_PAYMENT_CC_HANDLER', 'https://test.paydollar.com/b2cDemo/eng/directPay/payComp.jsp', 'Type the server that will handle the transaction. The default is:  <br/><br/><i>Production Site: <br/></i><code>https://www.paydollar.com/b2c2/eng/directPay/payComp.jsp</code><br/><br/><i>Test Site: </i><br/><code>https://test.paydollar.com/b2cDemo/eng/directPay/payComp.jsp</code>', '6', '0', now())");
    
  }
  /**
   * Remove the module and all its settings
   *
   */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE_PAYMENT_CC_%'");
  }
  /**
   * Internal list of configuration keys used for configuration of the module
   *
   * @return array
   */
  function keys() {
    return array('MODULE_PAYMENT_CC_STATUS', 'MODULE_PAYMENT_CC_COLLECT_CVV', 'MODULE_PAYMENT_CC_EMAIL', 'MODULE_PAYMENT_CC_ZONE', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', 'MODULE_PAYMENT_CC_SORT_ORDER','MODULE_PAYMENT_CC_MERCHANT_ID','MODULE_PAYMENT_CC_HANDLER');
  }
}
class runtime {
	var $StartTime = 0;
	var $StopTime = 0; 
	function get_microtime()
	{
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	function start()
	{
		$this -> StartTime = $this -> get_microtime();
	}
	function stop()
	{
		$this -> StopTime = $this -> get_microtime();
	}
	function spent()
	{
		return round(($this -> StopTime - $this -> StartTime) * 1000, 1);
	}
}
?>
