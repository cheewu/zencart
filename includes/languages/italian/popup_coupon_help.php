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
// $Id: popup_coupon_help.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('HEADING_COUPON_HELP', 'Aiuto Buono sconto');
define('TEXT_CLOSE_WINDOW', 'Chiudi finestra');
define('TEXT_COUPON_HELP_HEADER', 'Complimenti, hai riscosso un Buono sconto.');
define('TEXT_COUPON_HELP_NAME', '<br /><br />Nome Buono : %s');
define('TEXT_COUPON_HELP_FIXED', '<br /><br />Il Buono ti assicura uno sconto del %s sull\'importo del tuo ordine');
define('TEXT_COUPON_HELP_MINORDER', '<br /><br />Devi spendere almeno %s per poter usare questo Buono');
define('TEXT_COUPON_HELP_FREESHIP', '<br /><br />Questo buono ti assicura la spedizione gratuita di quanto ordinerai');
define('TEXT_COUPON_HELP_DESC', '<br /><br />Caratteristiche del Buono : %s');
define('TEXT_COUPON_HELP_DATE', '<br /><br />Questo Buono &egrave; valido fra il %s e il %s');
define('TEXT_COUPON_HELP_RESTRICT', '<br /><br />Limitazioni Prodotto/Categoria');
define('TEXT_COUPON_HELP_CATEGORIES', 'Categoria');
define('TEXT_COUPON_HELP_PRODUCTS', 'Prodotto');
define('TEXT_ALLOW', 'Consenti');
define('TEXT_DENY', 'Nega');

define('TEXT_ALLOWED', ' (Consentito)');
define('TEXT_DENIED', ' (Negato)');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','I Buoni sconto non possono essere utilizzati per l\'acquisto di ' . TEXT_GV_NAMES . '.');

define('TEXT_COUPON_GV_RESTRICTION_ZONES', 'Si applicano le limitazioni all\'indirizzo di fatturazione.');

?>