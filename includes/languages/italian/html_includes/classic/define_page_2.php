<h2>PROCEDURE PER UNA PRIMA CONFIGURAZIONE</h2><br />
Una volta terminata l'installazione di Zen Cart,<ol><li>
cancellata la cartella di installazione,<br /></li><li>rinominata la cartella <strong>/admin</strong> in /quello-che-vuoi<br />&amp; cambiato di conseguenza il percorso dentro il file di configure.php, da /admin in /quello-che-vuoi,<br /></li><li>dopo aver settato i permessi correttamente,<br />senza quindi pi&ugrave; messaggi di errore in alto nel sito,<br /></li></ol>sar&agrave; possibile finalmente iniziare a personalizzare il negozio online. Non sar&agrave; assolutamente difficile, anzi una volta compreso il funzionamento del sistema e capito "cosa" modificare "dove" e "perch&egrave;" il tutto risulter&agrave; anche divertente.<br /><h3 align="center">Buona continuazione!</h3><br />
Se decidete di modificare file di codice o di idiomi direttamente dai sorgenti Zen Cart, questi verranno sovrascritti in seguito ad un aggiornamento, perdendo così tutte le modifiche apportate, per ovviare a questo possibile inconveniente, viene offerto il sistema denominato <strong>Over-Ride</strong> che permette di evitare sovrascritture accidentali storando i file in aree determinate proprio dall'utente, usate questa funzionalit&agrave; e partirete con il piede giusto. 
<br /><br />
Il sistema Over-Ride <strong>deve essere utilizzato</strong> per i file del template, per i blocchi laterali, per i contenuti testuali delle pagine statiche (come queste), per i nomi di pagine e bottoni ed anche per le tabelle del database e delle specifiche funzioni eventualmente implementate.<br /><br />
Insomma per tutte le modifiche apportate al design o alle funzionalit&agrave; o alla struttura del <strong>proprio negozio</strong> online.
<br /><br />
Se volete, per esempio, creare un nuovo template (o caricarne uno acquistato), &egrave; necessario identificare <strong>TUTTE</strong> le cartelle che hanno il nome <strong>Classic</strong> e rinominarle con il nome del template che si utilizzer&agrave; (NB: sia che lo si crei modificando l'esistente classic o che sia stato acquistato!).<br /><br />
Di seguito utilizzeremo il nome <strong>[tuo_template]</strong> solo a titolo di esempio e per convenzione.<br /><br />
<h4 align="center">Ecco dove trovare via FTP le cartelle Classic:</h4><ul style="background-color: #F3F3F3;">
<li>/includes/languages</li><li>
/includes/languages/english</li><li>
/includes/languages/english/extra_definitions</li><li>
/includes/languages/english/html_includes</li><li>
/includes/languages/english/modules/order_total</li><li>
/includes/languages/english/modules/payment</li><li>
/includes/languages/english/modules/shipping</li><li>
/includes/languages/italian</li><li>
/includes/languages/italian/extra_definitions</li><li>
/includes/languages/italian/html_includes</li><li>
/includes/languages/italian/modules/order_total</li><li>
/includes/languages/italian/modules/payment</li><li>
/includes/languages/italian/modules/shipping</li><li>
/includes/modules</li><li>
/includes/modules/sideboxes</li><li>
/includes/templates</li></ul>
<br />Per modificare il template - da quello originale <strong>classic</strong> - copiate e rinominate la cartella in <strong>tuo_template</strong>:<br />
in /includes/templates/tuo_template, aprire il file <strong>template_info.php</strong><br />e ricompilare a piacimento i campi, ricordando di salvare logo o immagini nella cartella del nuovo template in uso:<br />
/includes/templates/tuo_template/images.<br />
<br />Struttura del file <strong>template_info.php</strong><br />
<div style="padding: 8px; background-color: #ffffcc;">
$template_name = 'Classic Italian';<br />
$template_version = 'Version 1.3.7';<br />
$template_author = 'Zen Cart Team (c) 2007';<br />
$template_description = 'Questo template dimostra come con tre immagini logo.jpg, header_bg.jpg, and tile_back.gif ed un foglio si stile CSS si possano ottenere grandi risultati. Questo template NON deve essere utilizzato con il nome classic ma deve essere rinominato a piacere così come tutte le cartelle classic presenti nella distribuzione.';<br />
$template_screenshot = 'scr_template_default.jpg';<br /></div><br /><br />
NB: $template_name "Classic Italian" nome da cambiare con "Nome del Tuo Template" in modo da identificarlo nell'elenco in gestione template!<br /><br />
<h2>INSTALLAZIONE DEL TEMPLATE</h2><br />
Per applicare questo nuovo template al negozio andare nel Pannello di Amministrazione, in <strong>Strumenti</strong> ---&gt; <strong>Scegli Template</strong> ---&gt; <strong>Modifica</strong> nell'elenco sar&agrave; presente il nuovo inserimento con il "Nome del Tuo Template".<br />A questo punto, digitato <strong>Aggiorna</strong>, se entrate nella Home del negozio, vedrete che non compariranno i box laterali.
<br /><br />
Per risolvere, dopo aver rinominato le cartelle classic viste precedentemente con il nome dell'attuale template in uso, baster&agrave; andare nel pannello di amministrazione in <strong>Strumenti</strong> ---&gt; <strong>Gestione Box Laterali</strong> e cliccare il tasto al fondo pagina: <strong>Resetta</strong>.<br /><br />
Se la procedura &egrave; stata correttamente eseguita il template e relativo over ride funzioner&agrave; come previsto.<br />
<hr /><strong><a href="index.php?main_page=page_3">Continua ...</a></strong><hr />
Per rimuovere questo testo, cancellarlo dal Define Pages Editor.<br />
Questo file si trova in /languages/italian/html_includes/tuo_template<br /><hr />