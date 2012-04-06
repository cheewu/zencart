<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tell_a_friend.php 3159 2006-03-11 01:35:04Z Albigin $
 */

define('NAVBAR_TITLE', 'Dillo a un Amico');

define('HEADING_TITLE', 'Segnala agli amici \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Chi manda la segnalazione ...');
define('FORM_TITLE_FRIEND_DETAILS', '... a chi');
define('FORM_TITLE_FRIEND_MESSAGE', 'Il tuo messaggio');

define('FORM_FIELD_CUSTOMER_NAME', 'Il tuo nome:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Il tuo indirizzo e-mail:');
define('FORM_FIELD_FRIEND_NAME', 'Il nome dell\'amico(a):');
define('FORM_FIELD_FRIEND_EMAIL', 'Email dell\'amico(a):');

define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'La tua Email riguardante il prodotto <strong>%s</strong> &egrave; stata regolarmente inviata a <strong>%s</strong>.');

define('EMAIL_TEXT_HEADER','Avviso Importante!');

define('EMAIL_TEXT_SUBJECT', 'Da %s ti arriva la segnalazione di questo articolo della %s');
define('EMAIL_TEXT_GREET', 'Salve %s!' . "\n\n");
define('EMAIL_TEXT_INTRO', '%s ha ritenuto di farti cosa gradita nel segnalarti il seguente prodotto %s della %s.');

define('EMAIL_TELL_A_FRIEND_MESSAGE','%s ha aggiunto il seguente messaggio:');

define('EMAIL_TEXT_LINK', 'Per vedere il prodotto clicca sul link sottostante oppure copia e incolla il link stesso nel tuo browser:' . "\n\n" . '%s');
define('EMAIL_TEXT_SIGNATURE', 'Con i migliori saluti,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Errore: devi inserire il nome della persona cui &egrave; diretta la mail.');
define('ERROR_TO_ADDRESS', 'Errore: l\'indirizzo Email non risulta valido. Riprova.');
define('ERROR_FROM_NAME', 'Errore: devi inserire il tuo nome.');
define('ERROR_FROM_ADDRESS', 'Errore: il tuo indirizzo Email non risulta valido. Riprova.');
?>
