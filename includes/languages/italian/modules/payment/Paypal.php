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
  define('MODULE_PAYMENT_PAYPAL_TEXT_ICO', '<img src="/images/paypal.jpg" />pagamento con paypal');
  define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<b><blink><font color="#FF0000">IMPORTANTE</font></blink><br>Si prega di confermare cliccare per completare l\'ordine. Una volta che l\'ordine viene ricevuto, vi invieremo una richiesta di pagamento al tuo account di posta elettronica per il totale.');
  define('MODULE_PAYMENT_PAYPAL_TEXT_EMAIL_FOOTER', 'Noi invieremo una richiesta di pagamento per il totale dell\'ordine a breve.');

  //---------------------//
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_NOW',"Paga in PayPal immediatamente");
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_BUTTON','<img alt="Paga Adesso" src="http://www.paypalobjects.com/it_IT/i/btn/btn_paynow_LG.gif" border="0" />');
define('EMAIL_PAYMENT_WEBSRC_LINK_PRE',"Hai scelto PayPal per effettuare il pagamento, clicca sul link:");
define('EMAIL_PAYMENT_WEBSRC_LINK_CON1','O semplicemente fare clic sul link');
define('EMAIL_PAYMENT_WEBSRC_LINK_CON2',"Noi vi renderà ordine pagato e invia la tua ourder fuori in 24 ore dopo il pagamento è confermato. ");
?>
