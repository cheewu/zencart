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
// $Id: gv_faq.php 1969 2005-09-13 06:57:21Z Albigin $
//

define('NAVBAR_TITLE', TEXT_GV_NAME . ' FAQ');
define('HEADING_TITLE', TEXT_GV_NAME . ' FAQ - Domande Frequenti');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Come acquistare dei ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Come inviare dei ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Come spendere dei ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Come riscuotere dei ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">Se qualcosa non va ...</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','L\'acquisto dei ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','I ' . TEXT_GV_NAMES . ' si comprano come qualsiasi altro prodotto venduto nel nostro negozio online. Per 
  pagarli si possono utilizzare i sistemi di pagamento offerti dal sito.
  Dopo l\'acquisto il valore dei ' . TEXT_GV_NAME . ' verr&agrave; accreditato sul tuo Account
   ' . TEXT_GV_NAME . ' . Se disponi di fondi sul tuo Account ' . TEXT_GV_NAME . ' , noterai
  che l\'ammontare ne viene indicato nel box del Carrello, dove si trova anche un
  link ad una pagina da dove, volendo, puoi inviare ' . TEXT_GV_NAME . ' a chi credi, per e-mail.<br> Un sistema comodo e
  sicuro per fare, ad esempio, un regalo di compleanno ad una persona lontana.');
  break;
  case '2':
define('SUB_HEADING_TITLE','Inviare dei ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Per inviare i ' . TEXT_GV_NAME . ' occorre recarsi alla nostra Pagina Invio dei ' . TEXT_GV_NAME . ' . Troverai
  il link a questa pagina nel Box del Carrello situato nella colonna di destra di ogni pagina.
  Quando si inviano ' . TEXT_GV_NAME . ', occorre precisare quanto segue:<br><br>
  - il nome della persona alla quale si inviano i ' . TEXT_GV_NAME . ' .<br>
  - l\'indirizzo e-mail della persona alla quale si inviano i ' . TEXT_GV_NAME . ' .<br>
  - l\'ammontare della somma che si vuole inviare. (Nota: non &egrave; necessario inviare l\'intera somma che
  si trova sul tuo Account ' . TEXT_GV_NAME . ' ).<br>
  - un breve messaggio, che sar&agrave; inserito nella e-mail.<br><br>
  Assicurati che le informazioni inserite siano corrette, anche se avrai
  la possibilit&agrave; di modificarle a tuo piacimento prima che l\'e-mail
  venga effettivamente inviata.');
  break;
  case '3':
  define('SUB_HEADING_TITLE','Acquistare con i ' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','Se disponi di fondi sul tuo Account ' . TEXT_GV_NAME . ' , puoi utilizzare tali fondi
  per acquistare altri articoli del nostro negozio. Quando arriverai alla cassa, verr&agrave; visualizzato un box
  speciale. Inserisci l\'ammontare da prelevare dal tuo Account ' . TEXT_GV_NAME . ' .
  Sappi che dovrai scegliere una ulteriore modalit&agrave; di pagamento se non vi fossero
  fondi sufficienti nel tuo Account ' . TEXT_GV_NAME . ' per coprire il costo dei tuoi acquisti.
  Se invece alla fine delle operazioni tu avessi pi&ugrave; fondi sul tuo Account ' . TEXT_GV_NAME . ' di quanto speso 
  per gli acquisti, il rimanente rimarr&agrave; a credito sul tuo Account ' . TEXT_GV_NAME . ' per acquisti 
  futuri.');
  break;
  case '4':
  define('SUB_HEADING_TITLE','Riscuotere dei ' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','Se ricevi ' . TEXT_GV_NAME . ' per e-mail troverai anche indicazioni su chi ti ha inviato
  i ' . TEXT_GV_NAME . ', insieme, probabilmente, ad un breve messaggio del mittente. Nella e-mail
  troverai anche il ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . '. Ti consigliamo di stampare questa e-mail 
  ad ogni buon conto. A questo punto puoi riscuotere il ' . TEXT_GV_NAME . ' in
  due modi.<br /><br />
  1. Cliccando sul link inserito nella e-mail a questo preciso scopo.
  In tal modo verrai condotto alla pagina di riscossione dei ' . TEXT_GV_NAME . ' . Ti verr&agrave; chiesto 
  di creare un account, quindi il ' . TEXT_GV_NAME . ' verr&agrave; convalidato e trasferito al tuo Account
   ' . TEXT_GV_NAME . ' pronto per essere speso per l\'acquisto di qualsiasi articolo.<br /><br />
  2. Durante le fasi di acquisto, sulla stessa pagina dalla quale puoi scegliere una modalit&agrave; di pagamento
troverai un campo nel quale inserire un ' . TEXT_GV_REDEEM . '. Inserisci il ' . TEXT_GV_REDEEM . ' dove indicato e 
clicca il bottone di riscossione. Il codice verr&agrave;
convalidato e aggiunto al tuo Account ' . TEXT_GV_NAME . ' . Potrai allora utilizzare quell\'ammontare per acquistare quello che vuoi nel nostro negozio');
  break;
  case '5':
  define('SUB_HEADING_TITLE','Se qualcosa non va ....');
  define('SUB_HEADING_TEXT','Per qualsiasi domanda riguardante il Sistema ' . TEXT_GV_NAME . ' , ti preghiamo di contattare il negozio
  inviando una e-mail a '. STORE_OWNER_EMAIL_ADDRESS . '. Per favore, fornisci quanti pi&ugrave; particolari possibili in
  questo messaggio. ');
  break;
  default:
  define('SUB_HEADING_TITLE',' -- ');
  define('SUB_HEADING_TEXT','Scegli fra le domande scritte qui sopra.');
  }

  define('TEXT_GV_REDEEM_INFO', 'Cortesemente immetti il codice riscossione ' . TEXT_GV_NAME . ': ');
  define('TEXT_GV_REDEEM_ID', 'Codice riscossione:');
?>