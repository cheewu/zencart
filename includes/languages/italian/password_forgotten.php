<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: password_forgotten.php 3086 2006-03-01 00:40:57Z Albigin $
 */

define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Password dimenticata');

define('HEADING_TITLE', 'Hai dimenticato la Password ?');

define('TEXT_MAIN', 'Poco male: inserisci la tua e-mail qui sotto e ti invieremo<br> a quell\'indirizzo un messaggio con una nuova Password.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Errore: l\'indirizzo e-mail non risulta nel nostro Database, riprova.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nuova Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'E\' stata chiesta una nuova Password da ' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n<br /><br />" . 'La tua nuova Password per \'' . STORE_NAME . '\' ?' . "\n\n<span style='font-weight:bold'>" . '   %s' . "</span>\n\n<br /><br />Dopo aver effettuato l'accesso utilizzando la nuova password, è possibile cambiare andando in zona 'My Account'");

define('SUCCESS_PASSWORD_SENT', 'Eseguito: la nuova Password &egrave; stata inviata al tuo indirizzo e-mail.');
?>