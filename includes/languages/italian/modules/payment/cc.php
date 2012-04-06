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
// $Id: cc.php 4027 2006-07-26 05:27:41Z drbyte $
//

  define('MODULE_PAYMENT_CC_TEXT_TITLE', 'Carta di credito');
  define('MODULE_PAYMENT_CC_TEXT_ADMIN_TITLE', 'Carta di credito');
  define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION', 'Test Info Carta di Credito:<br /><br />CC#: 4111111111111111<br />Scadenza: Qualsiasi');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE', 'Tipo della carta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER', 'Titolare della carta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER', 'Numero carta:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV', 'CVV Number (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'Altre info' . '</a>)');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES', 'Data scadenza:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER', '* Il Nome Proprietario della Carta di Credito deve essere almeno ' . CC_OWNER_MIN_LENGTH . ' cifre.\n');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER', '* Il numero della Carta di Credito deve essere almeno ' . CC_NUMBER_MIN_LENGTH . ' cifre.\n');
  define('MODULE_PAYMENT_CC_TEXT_ERROR', 'Errore Carta di Credito:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_CVV', '* Il numero CVV deve essere almeno ' . CC_CVV_MIN_LENGTH . ' cifre.\n');
  define('MODULE_PAYMENT_CC_TEXT_EMAIL_ERROR','ATTENZIONE - Errore nella Configurazione: ');
  define('MODULE_PAYMENT_CC_TEXT_EMAIL_WARNING','ATTENZIONE: Hai abilitato il modulo di pagamento tramite Carta di Credito ma non lo hai ancora configurato per inviare le informazioni della Carta di Credito a te tramite email. Come conseguenza, non sarai in grado di processare i numeri di Carta di Credito per gli ordini piazzati usando questo metodo.  Vai in Admin->Moduli->Pagamento->Credit Card->Modifica e imposta l\'indirizzo email per l\'invio delle informazioni Carta di Credito.' . "\n\n\n\n");
  define('MODULE_PAYMENT_CC_TEXT_MIDDLE_DIGITS_MESSAGE', '
Pregasi inviare questa mail all\'ufficio contabilit&agrave; in modo da poterla archiviare con l\'ordine relativo a: ' . "\n\n" . 'Ordine: %s' . "\n\n" . 'Cifre centrali: %s' . "\n\n");

define('MODULE_PAYMENT_CC_TEXT_PMETHOD','Seleziona Card:');
define('MODULE_PAYMENT_CC_TEXT_CATALOG_LOGO','<img src="' . DIR_WS_MODULES . '/payment/payease/payease.gif" alt="' . MODULE_PAYMENT_CC_TEXT_CATALOG_TITLE . '" title="' . MODULE_PAYMENT_CC_TEXT_CATALOG_TITLE . '" /> &nbsp;');
?>