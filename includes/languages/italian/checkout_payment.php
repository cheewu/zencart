<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_payment.php 3206 2006-03-19 04:04:09Z Albigin $
 */

define('NAVBAR_TITLE_1', 'Conferma Ordine');
define('NAVBAR_TITLE_2', 'Modalit&agrave; pagamento');

define('HEADING_TITLE', 'Fase 2 di 3 - Dati pagamento');

define('TABLE_HEADING_BILLING_ADDRESS', 'Indirizzo fatturazione');
define('TEXT_SELECTED_BILLING_DESTINATION', 'A sinistra vedi l\'indirizzo di fatturazione. Se necessario, lo puoi modificare cliccando sul bottone <em>Cambia indirizzo</em>.');
define('TITLE_BILLING_ADDRESS', 'Indirizzo fatturazione:');


define('TABLE_HEADING_PAYMENT_METHOD', 'Modalit&agrave; pagamento');
define('TEXT_SELECT_PAYMENT_METHOD', 'Devi scegliere una modalit&agrave; di pagamento.');
define('TITLE_PLEASE_SELECT', 'Seleziona');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Al momento questa &egrave; l\'unica modalit&agrave; di pagamento disponibile per questa richiesta.');

define('TEXT_ENTER_PAYMENT_INFORMATION', '');
define('TABLE_HEADING_COMMENTS', 'Spazio per richieste particolari o commenti');

define('TITLE_NO_PAYMENT_OPTIONS_AVAILABLE', 'Attualmente non disponibile');
define('TEXT_NO_PAYMENT_OPTIONS_AVAILABLE','<span class="alert">Spiacenti, ma attualmente non accettiamo pagamenti da questa localit&agrave;.</span><br />Se interessato puoi contattarci per eventuali opzioni alternative.');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Vai alla Fase 3</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- per confermare la richiesta.');

define('TABLE_HEADING_CONDITIONS', '<span class="termsconditions">Condizioni di vendita</span>');
define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">Seleziona la casella seguente per accettare le Condizioni di vendita. Se vuoi (ri)leggerle, clicca <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><u>QUI</u></a>.');
define('TEXT_CONDITIONS_CONFIRM', '<span class="termsiagree">Ho letto le Condizioni di vendita e le accetto.</span>');

define('TEXT_CHECKOUT_AMOUNT_DUE', 'Totale dovuto: ');
define('TEXT_YOUR_TOTAL','Il Tuo Totale');
?>