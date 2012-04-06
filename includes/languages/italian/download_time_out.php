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
// $Id: download_time_out.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('NAVBAR_TITLE', 'Il tuo download ...');
define('HEADING_TITLE', 'Il tuo downolad ...');

define('TEXT_INFORMATION', 'Spiacenti, ma il tuo download &egrave; scaduto.<br /><br />
  Se avevi altri download e vuoi recuperarli,
  recati alla pagina del <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Tuo account</a> per rivedere il tuo ordine.<br /><br />
  Oppure, se ritieni che qualcosa sia andato storto in fase di ordinazione <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">Contattaci</a> <br /><br />
  Grazie!
  ');
?>