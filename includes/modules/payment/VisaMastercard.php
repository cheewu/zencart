<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: payease.php 001 2008-03-20 Jack $
//
//------------------ add 2010 5 4 ----------------------//
include_once((IS_ADMIN_FLAG === true ? DIR_FS_CATALOG_MODULES : DIR_WS_MODULES) . 'payment/paypal/paypal_functions.php');
//------------------------------------------------------//
 class VisaMastercard {
   var $code, $title, $description, $enabled;
  /**
   * order status setting for pending orders
   *
   * @var int
   */
   var $order_pending_status = 1;
  /**
   * order status setting for completed orders
   *
   * @var int
   */
   var $order_status = DEFAULT_ORDERS_STATUS_ID;

// class constructor
   function VisaMastercard() {
     global $order;
       $this->code = 'VisaMastercard';
    if ($_GET['main_page'] != '') {
       $this->title = MODULE_PAYMENT_VISAMASTERCARD_TEXT_CATALOG_TITLE; // Payment Module title in Catalog
    } else {
       $this->title = MODULE_PAYMENT_VISAMASTERCARD_TEXT_ADMIN_TITLE; // Payment Module title in Admin
    }
       $this->description = MODULE_PAYMENT_VISAMASTERCARD_TEXT_DESCRIPTION;
       $this->sort_order = MODULE_PAYMENT_VISAMASTERCARD_SORT_ORDER;
       $this->enabled = ((MODULE_PAYMENT_VISAMASTERCARD_STATUS == 'True') ? true : false);
       if ((int)MODULE_PAYMENT_VISAMASTERCARD_ORDER_STATUS_ID > 0) {
         $this->order_status = MODULE_PAYMENT_VISAMASTERCARD_ORDER_STATUS_ID;
       }
       if (is_object($order)) $this->update_status();
       $this->form_action_url = MODULE_PAYMENT_VISAMASTERCARD_HANDLER;

   }

// class methods
   function update_status() {
     global $order, $db;

     if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_VISAMASTERCARD_ZONE > 0) ) {
       $check_flag = false;
       $check_query = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_VISAMASTERCARD_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
       while (!$check_query->EOF) {
         if ($check_query->fields['zone_id'] < 1) {
           $check_flag = true;
           break;
         } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
           $check_flag = true;
           break;
         }
                 $check_query->MoveNext();
       }

       if ($check_flag == false) {
         $this->enabled = false;
       }
     }
   }

   function javascript_validation() {
     return false;
   }

   function selection() {
     return array('id' => $this->code,
                   'title'=>$this->code,
                   'module' => MODULE_PAYMENT_VISAMASTERCARD_TEXT_CATALOG_LOGO,
                   'icon' => MODULE_PAYMENT_VISAMASTERCARD_TEXT_CATALOG_LOGO
                   );
   }

   function pre_confirmation_check() {
     return false;
   }

   function confirmation() {
      return array('title' => MODULE_PAYMENT_VISAMASTERCARD_TEXT_DESCRIPTION);
   }

 function set_email_information() {
    // ------------------------------------ add 2010 5 4 ----------------------------------//
    //------------------以下是大部分是从paypal.php中摘过来的
    global $db, $order, $currencies, $currency;
    $options = array();
    $optionsCore = array();
    $optionsPhone = array();
    $optionsShip = array();
    $optionsLineItems = array();
    $optionsAggregate = array();
    $optionsTrans = array();
    $buttonArray = array();

    $this->totalsum = $order->info['total'];

    // save the session stuff permanently in case paypal loses the session

    $my_currency = select_pp_currency();
    $this->transaction_currency = $my_currency;

    $this->transaction_amount = ($this->totalsum * $currencies->get_value($my_currency));

    $telephone = preg_replace('/\D/', '', $order->customer['telephone']);
    if ($telephone != '') {
      $optionsPhone['H_PhoneNumber'] = $telephone;
      if (in_array($order->customer['country']['iso_code_2'], array('US','CA'))) {
        $optionsPhone['night_phone_a'] = substr($telephone,0,3);
        $optionsPhone['night_phone_b'] = substr($telephone,3,3);
        $optionsPhone['night_phone_c'] = substr($telephone,6,4);
        $optionsPhone['day_phone_a'] = substr($telephone,0,3);
        $optionsPhone['day_phone_b'] = substr($telephone,3,3);
        $optionsPhone['day_phone_c'] = substr($telephone,6,4);
    } else {
        $optionsPhone['night_phone_b'] = $telephone;
        $optionsPhone['day_phone_b'] = $telephone;
      }
    }

    $optionsCust = array(
                   'first_name' => replace_accents($order->customer['firstname']),
                   'last_name' => replace_accents($order->customer['lastname']),
                   'address1' => replace_accents($order->customer['street_address']),
                   'city' => replace_accents($order->customer['city']),
                   'state' => zen_get_zone_code($order->customer['country']['id'], $order->customer['zone_id'], $order->customer['zone_id']),
                   'zip' => $order->customer['postcode'],
                   'country' => $order->customer['country']['iso_code_2'],
                   'email' => $order->customer['email_address'],
                   );
    if ($order->customer['suburb'] != '') $optionsCust['address2'] = $order->customer['suburb'];

	$optionsAggregate = array(
                   'cmd' => '_ext-enter',
                   'item_name' => $_SESSION['create_order_no'],
                   'item_number' => $_SESSION['create_order_no'],
                   //'num_cart_items' => sizeof($order->products),
                   'amount' => number_format($this->transaction_amount, $currencies->get_decimal_places($my_currency)),
                   'shipping' => '0.00',
                    );


    // if line-item info is invalid, use aggregate:
    if (sizeof($optionsLineItems) > 0) $optionsAggregate = $optionsLineItems;

    // prepare submission
    $options = array_merge($optionsCore, $optionsCust, $optionsPhone, $optionsShip, $optionsTrans, $optionsAggregate);

    //---------------- 这是自定义的
    //$websrc = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=' . MODULE_PAYMENT_PAYPAL_BUSINESS_ID .
    $order_id = isset($_GET['order_id'])?$_GET['order_id']:$_SESSION['create_order_no'];
    $websrc = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=' . MODULE_PAYMENT_PAYPAL_PAYPAL_ACCOUT .
                '&amount=' . number_format($this->transaction_amount, $currencies->get_decimal_places($my_currency)) .
                '&item_name=ORDER' . $order_id .
                '&currency_code=' . $my_currency;
    $websrc_t = 'http://www.luxweddingdress.com/paypal.php?cmd=_xclick&business=' . MODULE_PAYMENT_PAYPAL_PAYPAL_ACCOUT .
                '&amount=' . number_format($this->transaction_amount, $currencies->get_decimal_places($my_currency)) .
                '&item_name=ORDER' . $order_id .
                '&currency_code=' . $my_currency;

    foreach($optionsCust as $key => $value){
        $websrc_t .= '&' . $key . '=' . $value;
    }
    foreach($optionsPhone as $key => $value){
        $websrc_t .= '&' . $key . '=' . $value;
    }

//$this->form_action_url = $websrc_t;
    $websrc_string = EMAIL_TEXT_PAYMENT_METHOD . "<br />\n";
    /*
    $websrc_string .= EMAIL_PAYMENT_WEBSRC_LINK_PRE . "<br />" .
                '<a target="_blank" href="' . $websrc . '">' . EMAIL_PAYMENT_WEBSRC_LINK_PAY_BUTTON . '</a>' . "<br />" .
                EMAIL_PAYMENT_WEBSRC_LINK_CON1 . '<a target="_blank" href="' . $websrc . '">' . EMAIL_PAYMENT_WEBSRC_LINK_PAY_NOW . '</a>' .
                EMAIL_PAYMENT_WEBSRC_LINK_CON2 . "<br />";
    */
    $websrc_string .= EMAIL_PAYMENT_WEBSRC_LINK_PRE . "<br />\n". $websrc . "\n<br /> " .
                EMAIL_PAYMENT_WEBSRC_LINK_CON2 . "\n<br />";

    define('EMAIL_PAYMENT_WEBSRC_LINK', $websrc_string);
    //-----------------------------------------------//
    }

   function process_button() {
     global $db, $order_tmp, $currencies;
     $order = $order_tmp;

     $order_id = isset($_GET['order_id'])?$_GET['order_id']:$_SESSION['create_order_no'];

     $MD5key = MODULE_PAYMENT_VISAMASTERCARD_MD5KEY;				// MD5私钥
     $v_mid = MODULE_PAYMENT_VISAMASTERCARD_SELLER;				// 商户编号
	 $v_ymd =date("Ymd");									// 订单产生日期
	 $v_oid = $v_ymd . '-' . $v_mid . '-' . $order_id;	// 订单编号
	 //$v_oid = $_SESSION['create_order_no'];
	 $v_orderstatus = '1';		// 商户配货状态，0为未配齐，1为已配齐

     if (MODULE_PAYMENT_VISAMASTERCARD_MONEYTYPE == 'CNY') {
      $v_moneytype = '0';
     } else {
      $v_moneytype = '1';
     }							// 支付币种，0为人民币，1为美元

	 if (MODULE_PAYMENT_VISAMASTERCARD_OSTYPE == 'Windows') {
      $v_ostype = 'MD5Win32';
     } else {
      $v_ostype = 'MD5Linux';
     }							// 网站的操作系统

     $v_amount = number_format(($order->info['total']) * $currencies->get_value('USD'), 2, '.', '');	//金额

     //$v_url = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL'); 			//返回地址
     $v_url ="index.php?main_page=checkout_process&refer=VISAMASTERCARD";

	 if ($_SESSION['language'] == 'english') {
     	 $Language = '2';
     } else {
         $Language = '1';
     }		//语言


    $countrylist = array(
            "13"=>"036",
            "14"=>"040",
            "17"=>"048",
            "38"=>"124",
            "55"=>"196",
            "84"=>"300", 
            "96"=>"344",
            "105"=>"380",
            "153"=>"554",
            "188"=>"702",
            "215"=>"792",
            "221"=>"784",
            "222"=>"826",
            "223"=>"840",
           
  );
  $USStates=array(
                "Alabama"=>"AL",
                "Alaska"=>"AK",
                "Alberta"=>"AB",
                "American Samoa"=>"AS",
                "Arizona"=>"AZ",
                "Arkansas"=>"AR",
                "Armed Forces Americas"=>"AA",
                "Armed Forces Europe"=>"AE",
                "Armed Forces Pacific"=>"AP",
                "British Columbia"=>"BC",
                "California"=>"CA",
                "Colorado"=>"CO",
                "Connecticut"=>"CT",
                "Delaware"=>"DE",
                "District of Columbia"=>"DC",
                "Federated States of Micronesia"=>"FM",
                "Florida"=>"FL",
                "Georgia"=>"GA",
                "Guam"=>"GU",
                "Hawaii"=>"HI",
                "Idaho"=>"ID",
                "Illinois"=>"IL",
                "Indiana"=>"IN",
                "Iowa"=>"IA",
                "Kansas"=>"KS",
                "Kentucky"=>"KY",
                "Louisiana"=>"LA",
                "Maine"=>"ME",
                "Manitoba"=>"MB",
                "Marshall Islands"=>"MH",
                "Maryland"=>"MD",
                "Massachusetts"=>"MA",
                "Michigan"=>"MI",
                "Minnesota"=>"MN",
                "Mississippi"=>"MS",
                "Missouri"=>"MO",
                "Montana"=>"MT",
                "Nebraska"=>"NE",
                "Nevada"=>"NV",
                "New Brunswick"=>"NB",
                "New Hampshire"=>"NH",
                "New Jersey"=>"NJ",
                "New Mexico"=>"NM",
                "New York"=>"NY",
                "Newfoundland"=>"NF",
                "North Carolina"=>"NC",
                "North Dakota"=>"ND",
                "Northern Mariana Islands"=>"MP",
                "Northwest Territories"=>"NT",
                "Nova Scotia"=>"NS",
                "Ohio"=>"OH",
                "Oklahoma"=>"OK",
                "Ontario"=>"ON",
                "Oregon"=>"OR",
                "Palau"=>"PW",
                "Pennsylvania"=>"PA",
				"Prince Edward Island"=>"PE",
                "Puerto Rico"=>"PR",
                "Quebec"=>"QC",
                "Rhode Island"=>"RI",
                "Saskatchewan"=>"SK",
                "South Carolina"=>"SC",
                "South Dakota"=>"SD",
                "Tennessee"=>"TN",
                "Texas"=>"TX",
                "Utah"=>"UT",
                "Vermont"=>"VT",
                "Virgin Islands"=>"VI",
                "Virginia"=>"VA",
                "Washington"=>"WA",
                "West Virginia"=>"WV",
                "Wisconsin"=>"WI",
                "Wyoming"=>"WY",
                "Yukon"=>"YT",
				"Alberta"=>"AB",
				"British Columbia"=>'BC',
				"Manitoba"=>"MB",
				"New Brunswick"=>"NB",
				"Newfoundland and Labrador"=>"NL",
				"Northwest Territories"=>"NT",
				"Nova Scotia"=>"NS",
				"Nunavut"=>"NU",
				"Ontario"=>"ONU",
				"Prince Edward Island"=>"PE",
				"Qu&eacute;bec"=>"QC",
				"Saskatchewan"=>"SK",
				"Yukon Territory"=>"YT",
        );

	$v_rcvname	 =	$v_mid;			// 收货人姓名，统一用商户编号的值代替
	$v_ordername =	$order->customer['lastname'] . $order->customer['firstname'];		// 订货人姓名
	$v_rcvaddr	 =	$order->customer['state'] . $order->customer['city'] . $order->customer['street_address'];	 // 收货人地址
	$v_rcvtel	 =	preg_replace('/\D/', '', $order->customer['telephone']);			// 收货人电话
	$v_rcvpost	 =	$order->customer['postcode'];										// 收货人邮政编码

    $v_shipstreet = $order->delivery['street_address'];
    $v_shipcity = $order->delivery['city'];
    $v_shippost = $order->delivery['postcode'];
    $v_shipcountry = $countrylist[$order->delivery['country']['id']];
    if($v_shipcountry == 840 || $v_shipcountry == 124) {
        $v_shipstate = $USStates[$order->delivery['state']];
    } else {
        $v_shipstate = $order->delivery['state'];
    }
    $v_shipphone = $order->customer['telephone'];
    $v_shipemail = $order->customer['email_address'];

    $v_billstreet = $order->billing['street_address'];
    $v_billcity = $order->billing['city'];
    $v_billpost = $order->billing['postcode'];
    $v_billcountry = $countrylist[$order->billing['country']['id']];
    if($v_billcountry == 840 || $v_billcountry == 124) {
        $v_billstate = $USStates[$order->billing['state']];
    } else {
        $v_billstate = $order->billing['state'];
    }
    $v_billphone = $order->customer['telephone'];
    $v_billemail = $order->customer['email_address'];

    //echo '<pre>';print_r($order);echo '</pre>';die();
    $md5src = $v_moneytype.$v_ymd.$v_amount.$v_rcvname.$v_oid.$v_mid.$v_url;	// 校验源字符串
    //$v_md5info = strtoupper(md5($md5src));												// MD5检验结果
	//exec("D:/golouisvuitton/includes/modules/payment/".$v_ostype." $md5src $MD5key",$v_md5info,$res);
	//exec(DIR_FS_CATALOG . DIR_WS_MODULES . "payment/".$v_ostype." $md5src $MD5key",$v_md5info,$res);
    //echo DIR_FS_CATALOG . DIR_WS_MODULES . "payment/".$v_ostype." $md5src $MD5key" . '<br>';
    //print_r($v_md5info);echo '<br>';
    //echo $res . '<br>';
    //$md5src = '120101122119.00juan xiang20101122-2819-350710422819http://www.luxonsale.com/respond.php?code=cappay';
    $v_md5info = $this->hmac_md5($MD5key,$md5src);
//echo $v_md5info;die();

    $process_button_string = zen_draw_hidden_field('v_mid', $v_mid) .
                              zen_draw_hidden_field('v_oid', $v_oid) .
                              zen_draw_hidden_field('v_rcvname', $v_rcvname) .
                              zen_draw_hidden_field('v_rcvaddr', $v_rcvaddr) .
                              zen_draw_hidden_field('v_rcvtel', $v_rcvtel) .
                              zen_draw_hidden_field('v_rcvpost', $v_rcvpost) .
                              zen_draw_hidden_field('v_amount', $v_amount) .
                              zen_draw_hidden_field('v_ymd', $v_ymd) .
							  zen_draw_hidden_field('v_orderstatus', $v_orderstatus) .
							  zen_draw_hidden_field('v_ordername', $v_ordername) .
                              zen_draw_hidden_field('v_moneytype', $v_moneytype) .
                              zen_draw_hidden_field('v_url', $v_url) .
							  zen_draw_hidden_field('v_md5info', $v_md5info) . 
                              zen_draw_hidden_field('v_shipstreet', $v_shipstreet) . 
                              zen_draw_hidden_field('v_shipcity', $v_shipcity) . 
                              zen_draw_hidden_field('v_shipstate', $v_shipstate) .
                              zen_draw_hidden_field('v_shippost', $v_shippost) .
                              zen_draw_hidden_field('v_shipcountry', $v_shipcountry) .
                              zen_draw_hidden_field('v_shipphone', $v_shipphone) . 
                              zen_draw_hidden_field('v_shipemail', $v_shipemail) .
                              zen_draw_hidden_field('v_billstreet', $v_billstreet) . 
                              zen_draw_hidden_field('v_billcity', $v_billcity) . 
                              zen_draw_hidden_field('v_billstate', $v_billstate) .
                              zen_draw_hidden_field('v_billpost', $v_billpost) .
                              zen_draw_hidden_field('v_billcountry', $v_billcountry) .
                              zen_draw_hidden_field('v_billphone', $v_billphone) . 
                              zen_draw_hidden_field('v_billemail', $v_billemail)
                            ;

     return $process_button_string;
   }

   function before_process() {return false;
      global $_POST, $order, $currencies, $messageStack;

	//定单编号
	$v_oid = $_POST["v_oid"];
	//支付方式
	$v_pstatus = $_POST["v_pstatus"];
	//支付结果：1－已提交，20－支付成功，30－支付失败
	$v_pstring = $_POST["v_pstring"];
	//支付结果信息
	$v_pmode = $_POST["v_pmode"];
	//MD5校验信息
	$v_md5info = $_POST["v_md5info"];
	//订单实际支付金额
	$v_amount = $_POST["v_amount"];
	//订单实际支付币种
	$v_moneytype = $_POST["v_moneytype"];
	//MD5校验信息
	$v_md5money = $_POST["v_md5money"];
	//商城数据签名
	$v_sign = $_POST["v_sign"];

	//MD5私钥
	$MD5key = MODULE_PAYMENT_VISAMASTERCARD_MD5KEY;
	//校验源字符串，v_md5money效验
	$md5src1 = $v_oid . $v_pstatus . $v_pstring . $v_pmode;
	//MD5检验结果，v_md5money效验
	// $md5sign1 = strtoupper(md5($md5src1));
	//exec("./".$v_ostype." $md5src1 $MD5key",$md5sign1,$res1);
    $md5sign1 = $this->hmac_md5($MD5Key,$md5src1);;

	//校验源字符串，v_md5money效验
	$md5src2 = $v_amount . $v_moneytype;
	//MD5检验结果，v_md5money效验
	// $md5sign2 = strtoupper(md5($md5src2));
	//exec("./".$v_ostype." $md5src2 $MD5key",$md5sign2,$res2);
    $md5sign2 = $this->hmac_md5($MD5Key,$md5src2);

	 if (MODULE_PAYMENT_VISAMASTERCARD_MONEYTYPE == 'CNY') {
      $o_moneytype = '0';
     } else {
      $o_moneytype = '1';
     }							// 支付币种，0为人民币，1为美元

//用于写入Zen Cart后台订单历史记录中的数据
    $this->v_oid = $v_oid;
    $this->v_amount = $v_amount;

    if ($v_md5info==$md5sign1) {
		if ($v_md5money==$md5sign2) {
			$o_amount = number_format(($order->info['total']) * $currencies->get_value('USD'), 2, '.', '');	//金额
			if (($o_amount==$v_amount)&&($o_moneytype==$v_moneytype)) {
				return true ;  //订单成功
			}else{
				$messageStack->add_session('checkout_payment', '实付金额不符', 'error');
				zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
			}
		}else{
			$messageStack->add_session('checkout_payment', '效验二失败', 'error');
			zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
		}
    }else{
		$messageStack->add_session('checkout_payment', '效验一失败', 'error');
		zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
	}

   }

   function after_process() {
	global $insert_id,$db ;

    $this->respond();

   // $db->Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (comments, orders_id, orders_status_id, date_added) values ('首信易支付 - 订单号: " . $this->v_oid . " - 实付金额: " . $this->v_amount . " ' , '". (int)$in_id . "','" . $this->order_status . "', now() )");

	$_SESSION['order_created'] = '';
	return true;
   }

   function output_error() {
     return false;
   }

   function check() {
     global $db;
     if (!isset($this->_check)) {
       $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_VISAMASTERCARD_STATUS'");
       $this->_check = $check_query->RecordCount();
     }
     return $this->_check;
   }

   function install() {
     global $db, $language, $module_type;
	 if (!defined('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_1_1')) include(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/' . $module_type . '/' . $this->code . '.php');

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_1_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_STATUS', 'True', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_1_2 . "', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_2_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_SELLER', '888', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_2_2 . "', '6', '2', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_3_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_MD5KEY', 'test', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_3_2 . "', '6', '4', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_4_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_MONEYTYPE', 'CNY', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_4_2 . "', '6', '4', 'zen_cfg_select_option(array(\'CNY\', \'USD\'), ', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_5_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_OSTYPE', 'Windows', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_5_2 . "', '6', '4', 'zen_cfg_select_option(array(\'Windows\', \'Linux\'), ', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_6_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_ZONE', '0', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_6_2 . "', '6', '6', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_7_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_ORDER_STATUS_ID', '2', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_7_2 . "', '6', '10', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_8_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_SORT_ORDER', '0', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_8_2 . "', '6', '12', now())");
     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_9_1 . "', 'MODULE_PAYMENT_VISAMASTERCARD_HANDLER', 'http://pay.beijing.com.cn/prs/user_payment.checkit', '" . MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_9_2 . "', '6', '18', '', now())");
}

   function remove() {
     global $db;
     $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE  'MODULE_PAYMENT_VISAMASTERCARD%'");
   }

   function keys() {
     return array(
         'MODULE_PAYMENT_VISAMASTERCARD_STATUS',
         'MODULE_PAYMENT_VISAMASTERCARD_SELLER',
         'MODULE_PAYMENT_VISAMASTERCARD_MD5KEY',
         'MODULE_PAYMENT_VISAMASTERCARD_ZONE',
		 'MODULE_PAYMENT_VISAMASTERCARD_MONEYTYPE',
		 'MODULE_PAYMENT_VISAMASTERCARD_OSTYPE',
         'MODULE_PAYMENT_VISAMASTERCARD_ORDER_STATUS_ID',
         'MODULE_PAYMENT_VISAMASTERCARD_SORT_ORDER',
         'MODULE_PAYMENT_VISAMASTERCARD_HANDLER'
         );
   }

   //--------------------------------------------
    function respond()
    {
        global $db;
        $MD5key = MODULE_PAYMENT_VISAMASTERCARD_MD5KEY;
        $v_tempdate = explode('-', $_REQUEST['v_oid']);

        //接受返回数据验证开始
        //v_md5info验证
        $md5info_paramet = $_REQUEST['v_oid'] . $_REQUEST['v_pstatus'] . $_REQUEST['v_pstring'].$_REQUEST['v_pmode'];
        $md5info_tem     = $this->hmac_md5($MD5key,$md5info_paramet);
       // exec(DIR_FS_CATALOG . DIR_WS_MODULES . "payment/".$v_ostype." $md5info_paramet $MD5key",$md5info_tem_a,$res);
        //$md5info_tem = $md5info_tem_a[0];
	    $pay_status=$_REQUEST['v_pstatus'];    //这是首信易返回的状态

        //v_md5money验证
        $md5money_paramet = $_REQUEST['v_amount'].$_REQUEST['v_moneytype'];
        $md5money_tem     = $this->hmac_md5($MD5key,$md5money_paramet);
        //exec(DIR_FS_CATALOG . DIR_WS_MODULES . "payment/".$v_ostype." $md5money_parame $MD5key",$md5money_tem_a,$res);
        //$md5money_tem = $md5money_tem_a[0];

        if ($md5info_tem == $_REQUEST['v_md5info'] && $md5money_tem == $_REQUEST['v_md5money'])
        {   if($pay_status==1||$pay_status==2||$pay_status==20){
		     	//改变订单状态
            //	order_paid($v_tempdate[2]);
            $db->Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (comments, orders_id, orders_status_id, date_added) values ('首信易支付 - 订单号: " . $v_tempdate[2] . " - 实付金额: " . $_REQUEST['v_amount'] . " ' , '". (int)$v_tempdate[2] . "','2', now() )");
            $GLOBALS['pay_message'] = 'paid successful';
            return true;
			}else
			{ 	 /* 取得订单信息 */
				//order_action($order_sn, OS_CONFIRMED, SS_SHIPPED, PS_UNPAYED,'PayEase:'.$_REQUEST['v_pstring'], $GLOBALS['_LANG']['buyer']);
                //$db->Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (comments, orders_id, orders_status_id, date_added) values ('首信易支付 - 失败: " . $_REQUEST['v_pstring'] . "' , '". (int)$v_tempdate[2] . "','1', now() )");
                $GLOBALS['pay_message'] = 'paid fail!' . $_REQUEST['v_pstring'];
				return 0;
			}
         }
         else
         {
            $GLOBALS['pay_message'] = 'wrong params';
            return 0;
         }

    }
    function hmac_md5($key, $data)
    {
        if (extension_loaded('mhash'))
        {
            return bin2hex(mhash(MHASH_MD5, $data, $key));
        }

        // RFC 2104 HMAC implementation for php. Hacked by Lance Rushing
        $b = 64;
        if (strlen($key) > $b)
        {
            $key = pack('H*', md5($key));
        }
        $key  = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));

        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack('H*', md5($k_ipad . $data)));
    }

    //-----------------------------------------------------
 }
?>