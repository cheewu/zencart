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
// $Id: gv_redeem.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('NAVBAR_TITLE', 'Riscuoti ' . TEXT_GV_NAME);
define('HEADING_TITLE', 'Riscuoti ' . TEXT_GV_NAME);
define('TEXT_INFORMATION', 'Per maggiori informazioni riguardanti i ' . TEXT_GV_NAME . ', si possono consultare le nostre <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a>');
define('TEXT_INVALID_GV', 'Il ' . TEXT_GV_NAME . ' numero %s pu&ograve; non essere valido oppure &egrave; gi&agrave; stato riscosso. Per consultare il responsabile del negozio utilizzare la pagina dei Contatti');
define('TEXT_VALID_GV', 'Complimenti, hai riscosso  ' . TEXT_GV_NAME . ' per un importo di %s.');
?>