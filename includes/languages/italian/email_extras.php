<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: email_extras.php 3166 2006-03-11 02:45:51Z Albigin $
 */

// office use only
  define('OFFICE_FROM','<strong>Da:</strong>');
  define('OFFICE_EMAIL','<strong>E-mail:</strong>');

  define('OFFICE_SENT_TO','<strong>Inviata a:</strong>');
  define('OFFICE_EMAIL_TO','<strong>E-mail:</strong>');

  define('OFFICE_USE','<strong>Per uso interno:</strong>');
  define('OFFICE_LOGIN_NAME','<strong>Nome di Login:</strong>');
  define('OFFICE_LOGIN_EMAIL','<strong>E-mail di Login:</strong>');
  define('OFFICE_LOGIN_PHONE','<strong>Telefono:</strong>');
  define('OFFICE_IP_ADDRESS','<strong>Indirizzo IP:</strong>');
  define('OFFICE_HOST_ADDRESS','<strong>Indirizzo Host:</strong>');
  define('OFFICE_DATE_TIME','<strong>Data e ora:</strong>');
  define('OFFICE_IP_TO_HOST_ADDRESS', 'OFF');

// email disclaimer
  define('EMAIL_DISCLAIMER', 'Questo indirizzo e-mail ci ?stato fornito da un nostro cliente. Se ritieni che questo messaggio ti sia giunto per errore, ti preghiamo di inviare una segnalazione via mail a %s ');
  define('EMAIL_SPAM_DISCLAIMER','Se non desideri pi?ricevere questa email puoi richiedere la rimozione a questo indirizzo.');
//  define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '" target="_blank">' . STORE_NAME . '</a>.');
    define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . '  ' . STORE_NAME . '.');
// email advisory for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY', '-----' . "\n" . '<strong>IMPORTANTE - </strong> Per la tua tutela e per prevenire abusi, tutte le e-mail spedite a mezzo di questo sito sono registrate e il webmaster pu?visualizzarne il contenuto. Se ritieni che questo messaggio ti sia giunto per errore, ti preghiamo di inviare una segnalazione via mail a ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");

// email advisory included warning for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>Nelle mail inviate dal Sito &egrave; inserito questo messaggio:<br><br></strong>');


// Admin additional email subjects
  define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT','[CREA ACCOUNT]');
  define('SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT','[Dillo ad un Amico]');
  define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT','[GV CUSTOMER SENT]');
  define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT','[NUOVO ORDINE]');
  define('SEND_EXTRA_CC_EMAILS_TO_SUBJECT','[EXTRA CC ORDER INFO] #');

// Low Stock Emails
  define('EMAIL_TEXT_SUBJECT_LOWSTOCK','Avviso: in esaurimento');
  define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE','Rapporto livello scorte basso: ');

// for when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', 'Disabilitato');
?>