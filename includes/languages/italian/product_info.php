<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_info.php 3159 2006-03-11 01:35:04Z Albigin $
 */

define('TEXT_PRODUCT_NOT_FOUND', 'Spiacenti, non abbiamo trovato il prodotto.');
define('TEXT_CURRENT_REVIEWS', 'Recensioni attuali:');
define('TEXT_MORE_INFORMATION', 'Per ulteriori informazioni puoi visitare la seguente <a href="%s" target="_blank">pagina web</a>.');
define('TEXT_DATE_ADDED', 'Prodotto inserito in catalogo il %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Questo prodotto sar&agrave; disponibile il %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Clienti che hanno acquistato questo prodotto hanno comprato anche ...');
define('TEXT_PRODUCT_OPTIONS', '<strong>Fai la scelta:</strong>');
define('TEXT_PRODUCT_MANUFACTURER', 'Prodotto da: ');
define('TEXT_PRODUCT_WEIGHT', 'Peso spedizione: ');
define('TEXT_PRODUCT_WEIGHT_UNIT', ' Kg.');
define('TEXT_PRODUCT_QUANTITY', ' disponibilit&agrave; in magazzino');
define('TEXT_PRODUCT_MODEL', 'codice: ');
define('TEXT_PRODUCT_DESCRIPTION', 'descrizione del prodotto:');

// previous next product
define('PREV_NEXT_PRODUCT', 'Prodotto ');
define('PREV_NEXT_FROM', ' da ');
define('IMAGE_BUTTON_PREVIOUS','Prodotto prec.');
define('IMAGE_BUTTON_NEXT','Prodotto succ.');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST','Torna all\'elenco prodotti');

// missing products
//define('TABLE_HEADING_NEW_PRODUCTS', 'Nuovi prodotti per il mese di %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prodotti in arrivo');
//define('TABLE_HEADING_DATE_EXPECTED', 'Data prevista');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [costava: ');
define('TEXT_ATTRIBUTE_IS_FREE',' adesso &egrave;: Gratis]');
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' Applicabili costi una tantum');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','Sconti per quantitativi');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');
?>