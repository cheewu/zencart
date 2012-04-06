<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: create_account.php 3027 2006-02-13 17:15:51Z Albigin $
 */

define('NAVBAR_TITLE', 'Crea un account');

define('HEADING_TITLE', 'Info sul tuo account');

define('TEXT_ORIGIN_LOGIN', '<strong class="note">NOTA:</strong> Se hai gi&agrave; un account presso di noi accedi dalla <a href="%s">pagina di login</a>.');

// greeting salutation
define('EMAIL_SUBJECT', 'Conferma avvenuta iscrizione a ' . STORE_NAME);
define('EMAIL_GREET_MR', '<p><strong>Gentile Cliente:</strong></p>,' . "\n\n");
define('EMAIL_GREET_MS', '<p><strong>Gentile Cliente:</strong></p>,' . "\n\n");
define('EMAIL_GREET_NONE', '<p><strong>Gentile Cliente:</strong></p>' . "\n\n");

// First line of the greeting
define('EMAIL_WELCOME', 'Vogliamo darvi il benvenuto a <a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . LOCAL_SITE . '</a> e l\'account appena configurato permette di memorizzare in modo sicuro tutte le vostre informazioni di ordinazione, in modo che il vostro acquisto su <a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . LOCAL_SITE . '</a> ии semplice e sicuro oltre che molto piacere.' . "\n\n");
define('EMAIL_SEPARATOR', '--------------------');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Complimenti! Per fare in modo che la tua prossima visita al nostro negozio online sia ancora pi?utile, abbiamo emesso un Buono Sconto a tuo favore di cui ora ti illustriamo i particolari!' . "\n\n");
// your Discount Coupon Description will be inserted before this next define
define('EMAIL_COUPON_REDEEM', 'Se vuoi utilizzare il Buono Sconto inserisci il ' . TEXT_GV_REDEEM . ' codice durante le fasi di acquisto:  <strong>%s</strong>' . "\n\n");

define('EMAIL_GV_INCENTIVE_HEADER', 'Per ringraziarti della visita ti abbiamo inviato un ' . TEXT_GV_NAME . ' di %s!' . "\n");
define('EMAIL_GV_REDEEM', 'Il ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM  . TEXT_GV_REDEEM . ' durante le fasi di acquisto, dopo aver scelto articoli del negozio. ');
define('EMAIL_GV_LINK', ' Oppure, lo puoi riscattare fin da subito seguendo questo link: ' . "\n");
// GV link will automatically be included before this line

define('EMAIL_GV_LINK_OTHER','Una volta aggiunto il ' . TEXT_GV_NAME . ' al tuo account, potrai usare il ' . TEXT_GV_NAME . ' per te stesso, oppure potrai inviarlo ad uno dei tuoi amici!' . "\n\n");

define('EMAIL_TEXT', 'Ora che disponi del tuo account puoi avvalerti dei <strong>vari servizi</strong> studiati per i nostri clienti. Segnaliamo in particolare:' . "\n\n" . '<li><b>Carrello permanente</b> - Gli articoli che inserirai nel tuo carrello virtuale vi rimarranno fin a quando deciderai di eliminarli o di acquistarli.' . "\n\n" . '<li><b>Rubrica indirizzi</b> - Grazie a questo servizio, possiamo spedire gli articoli da te acquistati a indirizzi diversi dal tuo! Un modo ideale per fare regali alle persone care senza muoverti da casa.' . "\n\n" . '<li><b>Cronologia richieste</b> - Un registro chiaro e ordinato degli acquisti effettuati presso di noi.' . "\n\n" . '<li><b>Commenti</b> - Scambia le tue impressioni sui vari prodotti con gli altri nostri Clienti.' . "\n\n");
define('EMAIL_CONTACT', 'Per qualsiasi informazione riguardante i nostri servizi online, invia con fiducia una e-mail al nostro responsabile: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a>\n\n");
define('EMAIL_GV_CLOSURE','Con i migliori saluti,' . "\n\n" . STORE_OWNER . "\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER ."</a>\n\n");

// email disclaimer - this disclaimer is seperate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Questo indirizzo e-mail ci ?stato fornito da uno dei nostri Clienti. Se per?non intendi creare un account, o se questa e-mail ti ?giunta per sbaglio, ti preghiamo di inviare una e-mail a %s ');

//moved definitions to english.php
//define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Informativa sulla Privacy');
//define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '<span class="privacydescription">L\'iscrizione al sito implica l\'accettazione delle regole poste a tutela della tua Privacy. Esprimi il tuo consenso selezionando la casella sottostante. Leggi l\'informativa cliccando</span> <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>qui</u></a>.');
//define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'Ho letto l\'informativa sulla Privacy e l\'approvo.');
//define('TABLE_HEADING_ADDRESS_DETAILS', 'Dettagli Indirizzo');
//define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Dettagli Contatto');
//define('TABLE_HEADING_DATE_OF_BIRTH', 'Verifica Et&agrave;');
//define('TABLE_HEADING_LOGIN_DETAILS', 'Dettagli Login');
//define('TABLE_HEADING_REFERRAL_DETAILS', 'Were You Referred to Us?');
?>
