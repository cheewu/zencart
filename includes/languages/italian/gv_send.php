<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_send.php 3058 2006-02-21 09:40:07Z Albigin $
 */

define('HEADING_TITLE', 'Invia ' . TEXT_GV_NAME);
define('HEADING_TITLE_CONFIRM_SEND', 'Inviata Conferma ' . TEXT_GV_NAME);
define('HEADING_TITLE_COMPLETED', TEXT_GV_NAME . ' Inviata');
define('NAVBAR_TITLE', 'Invia ' . TEXT_GV_NAME);
define('EMAIL_SUBJECT', 'Messaggio da ' . STORE_NAME);
define('HEADING_TEXT','<br />Per cortesia, inserisci qui sotto i dettagli dei ' . TEXT_GV_NAME . ' che desideri inviare. Per maggiori informazioni, consulta le nostre <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a><br />');
define('ENTRY_NAME', 'Generalit&agrave; destinatario:');
define('ENTRY_EMAIL', 'Indirizzo e-mail destinatario:');
define('ENTRY_MESSAGE', 'Messaggio per destinatario:');
define('ENTRY_AMOUNT', 'Ammontare dei ' . TEXT_GV_NAME . ':');
define('ERROR_ENTRY_TO_NAME_CHECK', 'Manca l\'indirizzo E-mail. Scrivilo qui sotto. ');
define('ERROR_ENTRY_AMOUNT_CHECK', 'Questo ' . TEXT_GV_NAME . ' ammontare non sembra essere corretto. Cortesemente correggi.');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', 'Questo indirizzo email &egrave; corretto? Cortesemente verifica!');
define('MAIN_MESSAGE', 'Stai inviando un ' . TEXT_GV_NAME . ' del valore di %s a %s,  il cui indirizzo email address &egrave; %s. Se queste informazioni non sono corrette, puoi modificare il messaggio cliccando sul pulsante <strong>modifica</strong>.<br /><br />Il messaggio che stai inviando &egrave;:<br /><br />');
define('SECONDARY_MESSAGE', 'Caro(a) %s,<br /><br />' . 'Ti &egrave; stato inviato un ' . TEXT_GV_NAME . ' del valore di %s da %s');
define('PERSONAL_MESSAGE', '%s dice');
define('TEXT_SUCCESS', 'Complimenti, il tuo ' . TEXT_GV_NAME . ' &egrave; stato inviato regolarmente');
define('TEXT_SEND_ANOTHER', 'Spedisci un altro ' . TEXT_GV_NAME . '?');
define('TEXT_AVAILABLE_BALANCE','Saldo Buoni Regalo attualmente disponibile: ');

define('EMAIL_GV_TEXT_SUBJECT', 'Un regalo da %s');
define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Complimenti, hai ricevuto un ' . TEXT_GV_NAME . ' del valore di %s');
define('EMAIL_GV_FROM', 'Questo ' . TEXT_GV_NAME . ' ti &egrave; stato inviati da %s');
define('EMAIL_GV_MESSAGE', 'con il seguente messaggio: ');
define('EMAIL_GV_SEND_TO', 'Ciao, %s');
define('EMAIL_GV_REDEEM', 'Per riscuotere questi ' . TEXT_GV_NAME . ', clicca sul link sottostante. Ti consigliamo anche di annotare il ' . TEXT_GV_REDEEM . ': %s  qualora dovessero insorgere difficoltà.');
define('EMAIL_GV_LINK', 'Per riscuotere clicca qui');
define('EMAIL_GV_VISIT', ' oppure visita ');
define('EMAIL_GV_ENTER', ' ed inserisci il ' . TEXT_GV_REDEEM . ' ');
define('EMAIL_GV_FIXED_FOOTER', 'Se dovessi incontrare difficoltà nella riscossione dei ' . TEXT_GV_NAME . ' mediante il link automatico qui sopra, ' . "\n" .
                                'puoi anche inserire il ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . ' durante la fase di acquisto.');
define('EMAIL_GV_SHOP_FOOTER', '');
?>