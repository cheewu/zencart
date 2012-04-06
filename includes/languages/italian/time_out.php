<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: time_out.php 3027 2006-02-13 17:15:51Z Albigin $
 */

define('NAVBAR_TITLE', 'Login Time Out');
define('HEADING_TITLE', 'Whoops! La tua Sessione &egrave; scaduta.');
define('HEADING_TITLE_LOGGED_IN', 'Whoops! Spiacenti, ma non ti &egrave; consentito eseguire l\'azione richiesta. ');
define('TEXT_INFORMATION', '<p>Se avevi inserito un ordine, per favore effettua nuovamente il login ed il tuo Carrello sar&agrave; ripristinato. Potrai tornare alla cassa e completare i tuoi acquisti.</p><p>Se hai completato un ordine e desideri revisionarlo' . (DOWNLOAD_ENABLED == 'true' ? ', o hai un download e desideri recuperarlo' : '') . ', per favore vai alla pagina <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Il Mio Account</a> per visualizzare il tuo ordine.</p>');

define('TEXT_INFORMATION_LOGGED_IN', 'Sei ancora abilitato con il tuo account e puoi continuare gli acquisti. Per favore scegli una destinazione da un men&ugrave;.');

define('HEADING_RETURNING_CUSTOMER', 'Login');
define('TEXT_PASSWORD_FORGOTTEN', 'Password dimenticata?')
?>