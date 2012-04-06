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
// $Id: email_extras.php 5454 2006-12-29 20:10:17Z drbyte $
//

// office use only
  define('OFFICE_FROM','Da:');
  define('OFFICE_EMAIL','E-mail:');

  define('OFFICE_SENT_TO','Inviato a:');
  define('OFFICE_EMAIL_TO','E-mail:');
  define('OFFICE_USE','Solo per uso ufficio:');
  define('OFFICE_LOGIN_NAME','Login Nome:');
  define('OFFICE_LOGIN_EMAIL','Login e-mail:');
  define('OFFICE_LOGIN_PHONE','<strong>Telefono:</strong>');
  define('OFFICE_IP_ADDRESS','Indirizzo IP:');
  define('OFFICE_HOST_ADDRESS','Host Address:');
  define('OFFICE_DATE_TIME','Data e ora:');

// email disclaimer
  define('EMAIL_DISCLAIMER', 'Questo indirizzo e-mail ci è stato fornito da voi o da uno dei nostri clienti. Se ritieni che avete ricevuto questo messaggio per errore, vi preghiamo di inviare una mail a %s');
  define('EMAIL_SPAM_DISCLAIMER','Questa e-mail viene inviata in conformità con la CAN-SPAM statunitensi legge in vigore 2004/01/01. richieste di rimozione possono essere inviate a questo indirizzo e sarà onorato e rispettato.');
  define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' <a href="' . HTTP_SERVER . '" target="_blank">' . STORE_NAME . '</a>. Powered by <a href="' . HTTP_SERVER . '" target="_blank">' . STORE_NAME . '</a>');
  define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[GV ADMIN SENT]');
  define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[DISCOUNT COUPONS]');
  define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[ORDERS STATUS]');
  define('TEXT_UNSUBSCRIBE', "\n\nPer cancellarsi dalla newsletter futuro e invii pubblicitari, è sufficiente fare clic sul seguente link: \n");

// for whos_online when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', 'Disabile');
?>