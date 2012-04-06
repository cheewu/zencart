<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: meta_tags.php 2555 2007-01-21 05:37:01Z SandroCarniel $
 */

// Titolo pagina
define('TITLE', 'Zen Cart!');

// Tagline o slogan del sito 
define('SITE_TAGLINE', 'L\'arte dell\'e-commerce');

// Keywords imposte 
define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping, zencart-italia.it, zencart, zen-cart');

// Review Page can have a lead in:
define('META_TAGS_REVIEW', 'Recensioni: ');

// separatore tra le definizioni dei meta tag
// Define Primary Section Output
  define('PRIMARY_SECTION', ' : ');

// Definire Secondary Section Output
  define('SECONDARY_SECTION', ' - ');

// Definire Tertiary Section Output
  define('TERTIARY_SECTION', ', ');

// Definire la divisione tra parole ... usualmente una spazio o virgola e spazio
  define('METATAGS_DIVIDER', ', ');

// Definire quali pagine non devono essere indicizzate da robots/spiders
// This is generally used for account-management pages or typical SSL pages, and usually doesn't need to be touched.
  define('ROBOTS_PAGES_TO_SKIP','login,logoff,create_account,account,account_edit,account_history,account_history_info,account_newsletters,account_notifications,account_password,address_book,advanced_search,advanced_search_result,checkout_success,checkout_process,checkout_shipping,checkout_payment,checkout_confirmation,cookie_usage,create_account_success,contact_us,download,download_timeout,customers_authorization,down_for_maintenance,password_forgotten,time_out,unsubscribe');

// favicon settaggio - da decommentare se in uso
// There is usually NO need to enable this unless you wish to specify a path and/or a different filename
//  define('FAVICON','favicon.ico');

?>