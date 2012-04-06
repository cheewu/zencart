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
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
//  $Id: payease.php 002 2008-03-19 Jack $
//

  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_ADMIN_TITLE', 'PAYEASE Payment Gateway');
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CATALOG_TITLE', 'PAYEASE Payment Gateway');
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_DESCRIPTION', 'PAYEASE Payment Gateway');

  define('MODULE_PAYMENT_VISAMASTERCARD_MARK_BUTTON_IMG', DIR_WS_MODULES . '/payment/payease/payease.gif');
  define('MODULE_PAYMENT_VISAMASTERCARD_MARK_BUTTON_ALT', 'PayEase Payment Service');
  define('MODULE_PAYMENT_VISAMASTERCARD_ACCEPTANCE_MARK_TEXT', 'PayEase Payment Service');

  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CATALOG_LOGO', '<img src="' . MODULE_PAYMENT_VISAMASTERCARD_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_VISAMASTERCARD_MARK_BUTTON_ALT . '" title="' . MODULE_PAYMENT_VISAMASTERCARD_MARK_BUTTON_ALT . '" /> &nbsp;' .  '<span class="smallText">' . MODULE_PAYMENT_VISAMASTERCARD_ACCEPTANCE_MARK_TEXT . '</span>');

  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_1_1', 'Enable PAYEASE Module');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_1_2', 'Do you want to accept PAYEASE payments?');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_2_1', 'PAYEASE ID');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_2_2', 'PAYEASE ID');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_3_1', 'PAYEASE MD5 key');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_3_2', 'PAYEASE MD5 key');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_4_1', 'Currency');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_4_2', 'Currency type'); 
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_5_1', 'Operating System');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_5_2', 'Web server OS');
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_6_1', 'Payment Zone');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_6_2', 'If a zone is selected, only enable this payment method for that zone.');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_7_1', 'Set Pending Notification Status');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_7_2', 'Set the status of orders made with this payment module to this value<br />(Processing recommended)');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_8_1', 'Sort order of display');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_8_2', 'Sort order of display. Lowest is displayed first.');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_9_1', 'PAYEASE transaction URL<br />Default: <code>http://pay.beijing.com.cn/prs/user_payment.checkit</code><br />');  
  define('MODULE_PAYMENT_VISAMASTERCARD_TEXT_CONFIG_9_2', 'PAYEASE transaction URL');  

  //---------------------//
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_NOW',"Paga in PayPal immediatamente");
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_BUTTON','<img alt="Pay Now" src="http://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" />');
define('EMAIL_PAYMENT_WEBSRC_LINK_PRE',"Hai scelto PayPal per effettuare il pagamento, clicca sul link:");
define('EMAIL_PAYMENT_WEBSRC_LINK_CON1','Or just click the link');
define('EMAIL_PAYMENT_WEBSRC_LINK_CON2',"Faremo insieme un ordine come pagato e invia la tua ourder fuori in 24 ore dopo il pagamento è confermato. ");

?>