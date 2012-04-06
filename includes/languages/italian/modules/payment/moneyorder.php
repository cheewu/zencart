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
// $Id: moneyorder.php 1969 2005-09-13 06:57:21Z deepmax $
//

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Vaglia - Bonifico');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Intestare a favore di:<br />' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br /><br />Inviare copia della ricevuta a:<br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'La richiesta verr&agrave; evasa una volta ricevuta conferma dell\'avvenuto pagamento.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Intestare a favore di:" . "\n\n" . MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\nInviare copia della ricevuta a:\n" . STORE_NAME_ADDRESS . "\n\n" . 'La richiesta viene evasa una volta ricevuta conferma del pagamento.');
?>
