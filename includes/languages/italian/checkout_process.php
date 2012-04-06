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
// $Id: checkout_process.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('EMAIL_TEXT_SUBJECT', 'Conferma ordine');
define('EMAIL_TEXT_HEADER', 'Conferma ordine');
define('EMAIL_TEXT_FROM',' da ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','Grazie per aver scelto i nostri prodotti !');
define('EMAIL_DETAILS_FOLLOW','Ecco i particolari del tuo ordine.');
define('EMAIL_TEXT_ORDER_NUMBER', 'Ordine Numero:');
define('EMAIL_TEXT_INVOICE_URL', 'Dettaglio Ordine:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Clicca qui per vedere il Dettaglio Ordine');
define('EMAIL_TEXT_DATE_ORDERED', 'Data richiesta:');
define('EMAIL_TEXT_PRODUCTS', 'Prodotti');
define('EMAIL_TEXT_SUBTOTAL', 'Totale parziale:');
define('EMAIL_TEXT_TAX', 'IVA:        ');
define('EMAIL_TEXT_SHIPPING', 'Spedizione: ');
define('EMAIL_TEXT_TOTAL', 'Totale:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Indirizzo spedizione');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Indirizzo fatturazione');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Modalità pagamento');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' Nr.: ');
define('HEADING_ADDRESS_INFORMATION','Info indirizzo');
define('HEADING_SHIPPING_METHOD','Modalit&agrave; spedizione');
?>