<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tell_a_friend.php 3159 2006-03-11 01:35:04Z drbyte $
 */

define('NAVBAR_TITLE', 'Dillo ad un amico');

define('MY_EMAIL_ALSO', '<font color=red>Puoi inviare </font> <strong>'.zen_href_link(FILENAME_CREATE_ACCOUNT,'ref=%s').'</strong> <font color=red>ai tuoi amici</font>');

define('HEADING_TITLE', 'Dillo ad un amico');

define('FORM_TITLE_CUSTOMER_DETAILS', 'I tuoi dati');
define('FORM_TITLE_FRIEND_DETAILS', 'Dettagli del tuo amico');
define('FORM_TITLE_FRIEND_MESSAGE', 'Il tuo messaggio:');

define('FORM_FIELD_CUSTOMER_NAME', 'Il tuo nome:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'La tua email:');
define('FORM_FIELD_FRIEND_NAME', 'Il nome dell\'amico:');
define('FORM_FIELD_FRIEND_EMAIL', 'E-mail dell\'amico:');

define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Il tuo indirizzo email su <strong>%s</strong> è stato inviato con successo per <strong>%s</strong>.');

define('EMAIL_TEXT_HEADER','Avviso importante!');

define('EMAIL_TEXT_SUBJECT', 'Il tuo amico %s ha raccomandato questo grande prodotto da %s');
define('EMAIL_TEXT_GREET', 'Hi %s!' . "\n\n");
define('EMAIL_TEXT_INTRO', 'Il tuo amico, %s, pensato che sarebbe interessato a %s da %s.');

define('EMAIL_TELL_A_FRIEND_MESSAGE','%s ha inviato una nota dicendo:');

define('EMAIL_TEXT_LINK', 'Per visualizzare il prodotto, fare clic sul link qui sotto o copia e incolla il link nel proprio browser web:' . "\n\n" . '%s');
define('EMAIL_TEXT_SIGNATURE', 'Saluti,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Errore: Il nome del tuo amico non deve essere vuoto.');
define('ERROR_TO_ADDRESS', 'Errore: indirizzo e-mail del tuo amico non sembra essere valido. Si prega di riprovare.');
define('ERROR_FROM_NAME', 'Errore: Il tuo nome non può essere vuoto.');
define('ERROR_FROM_ADDRESS', 'Errore: Il tuo indirizzo e-mail non sembra essere valido. Si prega di riprovare.');
?>
