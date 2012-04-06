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
// $Id: advanced_search_result.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('NAVBAR_TITLE_1', 'Ricerca avanzata');
define('NAVBAR_TITLE_2', 'Risultati ricerca');

//define('HEADING_TITLE_1', 'Ricerca avanzata');
define('HEADING_TITLE', 'Ricerca avanzata');

define('HEADING_SEARCH_CRITERIA', 'Parametri di ricerca');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Cerca nelle descrizioni prodotti');
define('ENTRY_CATEGORIES', 'Categorie:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Includi sottocategorie');
define('ENTRY_MANUFACTURERS', 'Produttori:');
define('ENTRY_PRICE_FROM', 'Prezzo da:');
define('ENTRY_PRICE_TO', 'Prezzo fino a:');
define('ENTRY_DATE_FROM', 'Data da:');
define('ENTRY_DATE_TO', 'Data fino a:');

define('TEXT_SEARCH_HELP_LINK', 'Help Ricerca [?]');

define('TEXT_ALL_CATEGORIES', 'Tutte le categorie');
define('TEXT_ALL_MANUFACTURERS', 'Tutti i produttori');

define('HEADING_SEARCH_HELP', 'Help ricerca');
define('TEXT_SEARCH_HELP', 'Le parole chiave possono essere separate dagli operatori AND e/o OR per affinare la ricerca.<br /><br />Per esempio, Alpina AND tagliasiepi daranno risultati contenenti entrambi i termini. Invece usando tagliasiepi OR rasaerba, si otterranno risultati comprendenti entrambe le parole oppure l\'una o l\'altra.<br /><br />Si possono ottenere corrispondenze esatte inserendo la parola chiave fra doppi apici.<br /><br />Ad esempio, "saldatrici inverter" produrr&agrave; risultati esattamente corrispondenti ai termini inseriti.<br /><br />Le parentesi aiutano ulteriormente ad affinare la ricerca.<br /><br />Ad esempio, McCulloch AND (rasaerba OR tagliasiepi OR "a motore").');
define('TEXT_CLOSE_WINDOW', 'Chiudi finestra [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Modello');
define('TABLE_HEADING_PRODUCTS', 'Nome prodotto');
define('TABLE_HEADING_MANUFACTURER', 'Produttore');
define('TABLE_HEADING_QUANTITY', 'Quantit&agrave;');
define('TABLE_HEADING_PRICE', 'Prezzo');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_BUY_NOW', 'Acquista');

define('TEXT_NO_PRODUCTS', 'Non vi sono prodotti corrispondenti ai parametri di ricerca.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Occorre compilare almeno uno dei campi del modulo di ricerca.');
define('ERROR_INVALID_FROM_DATE', 'Data da non valida.');
define('ERROR_INVALID_TO_DATE', 'Data fino a non valida.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'La data fino a deve essere uguale o maggiore della data da.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Prezzo da deve essere una cifra.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Prezzo fino a deve essere una cifra.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Prezzo fino a deve essere uguale o maggiore di prezzo da.');
define('ERROR_INVALID_KEYWORDS', 'Parole chiave non valide.');
?>
