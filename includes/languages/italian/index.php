<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 3027 2006-03-31 17:15:51Z Albigin $
 */

define('TEXT_MAIN','');
define('INDEX_FLOAT_WRITTING', LOCAL_INDEX_FLOAT_WRITTING);

// Showcase oppure Negozio
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST', 'Benvenuto <span class="greetUser">Ospite</span>, buona navigazione fra le nostre pagine !<br /><br />Vuoi accedere con la <a href="%s">tua identit&agrave;</a> ?');
} else {
  define('TEXT_GREETING_GUEST', 'Ciao, naviga pure liberamente tra le nostre pagine .');
}

define('TEXT_GREETING_PERSONAL', 'Piacere di rivederti, <span class="greetUser">%s</span>!<br />Vuoi dare un\'occhiata agli <a href="%s">ultimi arrivi</a> ?');

define('TEXT_INFORMATION', 'Definisci qui la pagina indice principale');

//moved to italian
//define('TABLE_HEADING_FEATURED_PRODUCTS','Articoli in vetrina');
//define('TABLE_HEADING_NEW_PRODUCTS', 'Le novit&agrave; di %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Articoli in arrivo');
//define('TABLE_HEADING_DATE_EXPECTED', 'Data  prevista');

if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
  // This section deals with product-listing page contents
  define('HEADING_TITLE', 'Disponibilit&agrave;');
  define('TABLE_HEADING_IMAGE', 'Articolo');
  define('TABLE_HEADING_MODEL', 'Modello');
  define('TABLE_HEADING_PRODUCTS', 'Nome');
  define('TABLE_HEADING_MANUFACTURER', 'Produttore');
  define('TABLE_HEADING_QUANTITY', 'Quantit&agrave;');
  define('TABLE_HEADING_PRICE', 'Prezzo');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Compra');
  define('TEXT_NO_PRODUCTS', 'Al momento non vi sono prodotti in questo reparto.');
  define('TEXT_NO_PRODUCTS2', 'Al momento non abbiamo articoli di questo produttore.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Numero dei prodotti: ');
  define('TEXT_SHOW', '<strong>Elenca per:  </strong> ');
  define('TEXT_BUY', 'Compra 1 \'');
  define('TEXT_NOW', '\' adesso');
  define('TEXT_ALL_CATEGORIES', 'Tutte le categorie');
  define('TEXT_ALL_MANUFACTURERS', 'Tutti i produttori');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', '');
} elseif ($category_depth == 'nested') {
  // This section deals with displaying a subcategory
  define('HEADING_TITLE', '');
}
?>
