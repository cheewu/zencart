<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: account_history_info.php 3027 2006-02-13 17:15:51Z Albigin $
 */

define('NAVBAR_TITLE', 'D\'Ordine');
define('NAVBAR_TITLE_1', 'D\'Ordine');
define('NAVBAR_TITLE_2', 'D\'Ordine');
define('NAVBAR_TITLE_3', 'Ordine #%s');

define('HEADING_TITLE', 'Info sull\'ordine');

define('HEADING_ORDER_NUMBER', 'Ordine #%s');
define('HEADING_ORDER_DATE', 'Data ordine:');
define('HEADING_ORDER_TOTAL', 'Totale ordine:');

define('HEADING_DELIVERY_ADDRESS', 'Indirizzo di consegna');
define('HEADING_SHIPPING_METHOD', 'Modalit&agrave; spedizione');



define('HEADING_PRODUCTS', 'Prodotti');
define('HEADING_TAX', 'IVA');
define('HEADING_TOTAL', 'Totale');
define('HEADING_QUANTITY', 'Q.t&agrave;');

define('HEADING_BILLING_ADDRESS', 'Indirizzo fatturazione');
define('HEADING_PAYMENT_METHOD', 'Modalit&agrave; pagamento');

define('HEADING_ORDER_HISTORY', 'Cronologia stato &amp; Commenti');
define('TEXT_NO_COMMENTS_AVAILABLE', 'Non vi sono commenti.');
define('TABLE_HEADING_DOWNLOAD_DATE', 'Link scade:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Rimanenza:');
define('HEADING_DOWNLOAD', 'Link ai Download');
define('TABLE_HEADING_DOWNLOAD_FILENAME','Nome file:');

define('TABLE_HEADING_STATUS_DATE', 'Data');
define('TABLE_HEADING_STATUS_ORDER_STATUS', 'Stato Ordine');
define('TABLE_HEADING_STATUS_COMMENTS', 'Commenti');
define('QUANTITY_SUFFIX', '&nbsp;ea.  ');
define('ORDER_HEADING_DIVIDER', '&nbsp;-&nbsp;');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');

define('ADDRESS_NAME','Nome: ');
define('ADDRESS_STREET','Indirizzo: ');
define('ADDRESS_CITY','Città: ');
define('ADDRESS_POSTCODE','Codice postale: ');
define('ADDRESS_COUNTRY','Paese: ');

define('TEXT_PAY_WARNING','<div class="pay_warning"><strong>AVVISO: &nbsp;</strong>il stauts della presente ordinanza è ancora gratuita, si prega di effettuare il pagamento asap.We ll \'spedire il vostro ordine in 48 ore dopo il pagamento è confirmed.If avete scelto WesternUnion o PayPal per effettuare il pagamento, motivi a trovare le informazioni dettagliate di pagamento il tuo emailbox.</div>');

define('HEADING_ORDER_NUMBER_1', 'Ordine #:');
define('HEADING_ORDER_STATUS_1', 'Status :');
define('HEADING_ORDER_COMMENTS_1', 'commenti :');

define('HEADING_TITLE_1','Articoli');
define('TEXT_SELECT_PAYMENT_METHOD', 'Grazie del tuo acquisto! Il numero d\'ordine <font color=red>%s</font> è stato generato, l\'importo totale e\' <font color=red>%s</font>. Ti preghiamo di cliccare sul bottone sotto per fare il pagamento.Dopo aver verificato il pagamento, ti manderemo il pacco con <font color=red>%s</font>.');

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


define('ORDERS_SUCCESSFUL_MESSAGE','Complimenti, il vostro ordine è stato inviato correttamente.');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW','Non chiudere questa finestra prima del pagamento finsihed, si prega diverso pulsante accodrding scegliere il vostro risultato per il pagamento:');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON1','Hanno difficoltà nel pagamento');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON2','Pagato con successo');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_EXTRA','Si prega di finishe il pagamento nella nuova pagina aperta');
?>