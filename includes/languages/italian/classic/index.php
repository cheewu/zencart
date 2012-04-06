<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 3027 2006-03-31 17:15:51Z Albigin $
 */

define('TEXT_MAIN','');
define('TEXT_INFORMATION', '');


// Testo diverso se Negozio o Showcase
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST', 'Benvenuto e buona navigazione tra i nostri articoli!<br />
Vuoi <a href="%s">registrarti</a> o accedere con la <a href="%s">tua identit&agrave;</a>?');
} else {
  define('TEXT_GREETING_GUEST', 'Benvenuto, curiosa liberamente tra i nostri articoli.');
}

define('TEXT_GREETING_PERSONAL', 'Piacere di rivederti <span class="greetUser">%s</span>!<br />
Vuoi dare un\'occhiata agli <a href="%s">ultimi arrivi</a> ?');

if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
  // Questa parte viene utilizzata per il contenuto nella scheda prodotto
  define('HEADING_TITLE', 'Disponibilit&agrave;');
  define('TABLE_HEADING_IMAGE', 'Articolo');
  define('TABLE_HEADING_MODEL', 'Modello');
  define('TABLE_HEADING_PRODUCTS', 'Nome');
  define('TABLE_HEADING_MANUFACTURER', 'Produttore');
  define('TABLE_HEADING_QUANTITY', 'Quantit&agrave;');
  define('TABLE_HEADING_PRICE', 'Prezzo');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Compra');
  define('TEXT_NO_PRODUCTS', 'Al momento non vi sono prodotti in questa categoria.');
  define('TEXT_NO_PRODUCTS2', 'Al momento non abbiamo articoli di questo produttore.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Numero dei prodotti: ');
  define('TEXT_SHOW', '<strong>Elenca per:  </strong> ');
  define('TEXT_BUY', 'Compra 1 \'');
  define('TEXT_NOW', '\' adesso');
  define('TEXT_ALL_CATEGORIES', 'Tutte le categorie');
  define('TEXT_ALL_MANUFACTURERS', 'Tutti i produttori');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Zen Cart, E-commerce su misura<br />per tutte le esigenze e tutti i budget!'); 
} elseif ($category_depth == 'nested') {
  // Questa parte viene utilizzata per aprire con una sotto categoria
  define('HEADING_TITLE', 'Zen Cart per tutte le esigenze!'); 
}
?>
