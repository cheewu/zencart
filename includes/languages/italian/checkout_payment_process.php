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
// $Id: checkout_process.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('EMAIL_TEXT_SUBJECT', 'Conferma ordine');
define('EMAIL_TEXT_HEADER', 'Conferma ordine');
define('EMAIL_TEXT_FROM',' da ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','Grazie per lo shopping con noi oggi!');
define('EMAIL_DETAILS_FOLLOW','Di seguito sono riportati i dettagli del tuo ordine.');
define('EMAIL_TEXT_ORDER_NUMBER', 'Numero d\'ordine:');
define('EMAIL_TEXT_INVOICE_URL', 'Fattura dettagliata:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Clicca qui per una fattura dettagliata');
define('EMAIL_TEXT_DATE_ORDERED', 'Data dalla A alla Z:');
define('EMAIL_TEXT_PRODUCTS', 'Prodotti');
define('EMAIL_TEXT_SUBTOTAL', 'Sub-Totale:');
define('EMAIL_TEXT_TAX', 'Imposta:        ');
define('EMAIL_TEXT_SHIPPING', 'Spedizione: ');
define('EMAIL_TEXT_TOTAL', 'Totale:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Indirizzo di consegna');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Indirizzo di fatturazione');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Metodo di pagamento');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
define('HEADING_ADDRESS_INFORMATION','Informazioni Indirizzo');
define('HEADING_SHIPPING_METHOD','Metodo di spedizione');

//---------------------//
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_NOW',"Paga in PayPal immediatamente");
define('EMAIL_PAYMENT_WEBSRC_LINK_PAY_BUTTON','<img alt="Paga Adesso" border=0 src="http://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" />');
define('EMAIL_PAYMENT_WEBSRC_LINK_PRE',"Vi consigliamo vivamente di effettuare il pagamento tramite PayPal,<font color=\"red\">Puoi pagare con carta di credito direttamente anche voi non hanno un conto PayPal</font>.Paga in PayPal da fare clic sul pulsante below'T avere un conto PayPal:");
define('EMAIL_PAYMENT_WEBSRC_LINK_CON1','O semplicemente fare clic sul link');
define('EMAIL_PAYMENT_WEBSRC_LINK_CON2',"se non riesci a vedere il pulsante. ");

define('ADDRESS_NAME','Nome: ');
define('ADDRESS_STREET','Indirizzo: ');
define('ADDRESS_CITY','Città: ');
define('ADDRESS_POSTCODE','Codice postale: ');
define('ADDRESS_COUNTRY','Paese: ');

define('ORDERS_SUCCESSFUL_MESSAGE','Complimenti, il vostro ordine è stato inviato correttamente.');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW','Non chiudere questa finestra prima del pagamento finsihed, si prega diverso pulsante accodrding scegliere il vostro risultato per il pagamento:');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON1','Hanno difficoltà nel pagamento');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON2','Pagato con successo');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_EXTRA','Si prega di finishe il pagamento nella nuova pagina aperta');
?>