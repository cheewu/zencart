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
// $Id: login.php 5458 2007-01-16 11:00:08Z spike00 $
//

define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Benvenuto, accedi con la tua identit&agrave;');

define('HEADING_NEW_CUSTOMER', 'Prima visita? Se vuoi fare acquisti iscriviti:');
define('HEADING_NEW_CUSTOMER_SPLIT', 'Nuovi clienti');

define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'L\'iscrizione al sito ' . STORE_NAME . ' ti consente fra l\'altro di seguire l\'avanzamento degli ordini e di tenere un registro degli acquisti.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT', 'Hai un conto PayPal? Vuoi pagare direttamente con la carta di credito? Usa il bottone PayPal qu" sotto per usare l\'opzione Express Checkout.');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER', '<span class="larger">O</span><br />');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', 'Crea un profilo Cliente con <strong>' . STORE_NAME . '</strong>, ti permette di acquistare velocemente, di controllare i tuoi ordini correnti, rivedere i precedenti ordini e approfittare dei benefici per i membri.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

define('HEADING_RETURNING_CUSTOMER', 'Torno a visitarvi, ecco i miei dati:');
define('HEADING_RETURNING_CUSTOMER_SPLIT', 'Clienti ritornati');

define('TEXT_RETURNING_CUSTOMER_SPLIT', 'Per continuare, effettua il login al tuo account in <strong>' . STORE_NAME . '</strong>.');

define('TEXT_PASSWORD_FORGOTTEN', 'Password dimenticata?');

define('TEXT_LOGIN_ERROR', 'Errore: spiacenti ma la e-mail indicata non corrisponde alla password nel nostro Database o viceversa. Riprova !');
define('TEXT_VISITORS_CART', '<strong>Nota:</strong> Il contenuto del &quot;Carrello Ospite&quot; verr&agrave; travasato nel &quot;Carrello Cliente&quot; dopo che avrai effettuato il login. <a href="javascript:session_win();">[Altre Info]</a>');

define('TABLE_HEADING_PRIVACY_CONDITIONS', '<span class="privacyconditions">Informativa sulla Privacy</span>');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '<span class="privacydescription">L\'iscrizione al sito implica l\'accettazione delle regole poste a tutela della tua Privacy. Esprimi il tuo consenso selezionando la casella sottostante. Leggi l\'informativa cliccando</span> <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>qui</u></a>.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">Ho letto l\'informativa sulla Privacy e l\'approvo.</span>');

define('TEXT_LOAGIN_OPENID','Ora, usando il login OpenID');
?>