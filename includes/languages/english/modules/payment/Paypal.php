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
// $Id: offsitepayment.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('MODULE_PAYMENT_PAYPAL_TEXT_TITLE', 'Paypal');
  define('MODULE_PAYMENT_PAYPAL_TEXT_ICO', '<img src="/images/paypal.jpg" />pay by paypal');
  define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<b><blink><font color="#FF0000">IMPORTANT</font></blink><br>Please click CONFIRM to complete the order. Once the order is received, we will send a Payment Request to your email account for the total.');
  define('MODULE_PAYMENT_PAYPAL_TEXT_EMAIL_FOOTER', 'We will send you a Payment Request for the order total shortly.');

  //---------------------//
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_NOW',"Pay in PayPal immediately");
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_BUTTON','<img alt="Pay Now" src="http://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" />');
define('EMAIL_PAYMENT_WEBSRC_LINK_PRE',"You have chosen PayPal to make payment,Click the link:");
define('EMAIL_PAYMENT_WEBSRC_LINK_CON1','Or just click the link');
define('EMAIL_PAYMENT_WEBSRC_LINK_CON2',"We'll set you order as paid and send your ourder out in 24 hours after your payment is confirmed. ");
?>
