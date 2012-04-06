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
// $Id: popup_cvv_help.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('HEADING_CVV', 'Cosa &egrave; il CVV?');
define('TEXT_CVV_HELP1', 'Visa, Mastercard, Discover codice di verifica carta a 3 Digit<br /><br />
                    Per la tua sicurezza, ti chiediamo di inserire il codice di verifica della tua carta.<br /><br />
                    Il codice di verifica &egrave; composto da 3 cifre stampate sul retro della tua carta.
                    Sono indicati sulla destra dopo il tuo numero di carta.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));

define('TEXT_CVV_HELP2', 'American Express codice di verifica carta a 4 Digit<br /><br />
                    Per la tua sicurezza, ti chiediamo di inserire il codice di verifica della tua carta.<br /><br />
                    Il codice di verifica American Express &egrave; un numero di 4 cifre stampato sul fronte della tua carta.
                    E\' indicato sulla destra, dopo il numero della tua carta.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));

define('TEXT_CLOSE_CVV_WINDOW', 'Chiudi');
?>