<h2>MODIFICHE AI TESTI PRESENTI</h2><br /><div style="padding: 8px; background-color: #FFAAAA;">
Vi sono delle parti dei testi che NON sono modificabili nel Pannello di Amministrazione ma <strong>SOLO via FTP</strong> aprendo dei file* e modificando il codice presente, le cosidette "define di traduzione".<br /></div>
<br />
* Si consiglia di predisporre nel proprio PC due cartelle atte a contenere in una il file originale scaricato via FTP e nell'altra la copia modificata e quindi ricaricata a sostituzione del primo file originariamente scaricato.
<br /><br />
Per effettuare le modiche nell'header (intestazione o fascia superiore) del negozio, come gli ALT TAG del logo, la scritta <strong>Qui il tuo slogan!</strong>, dimensioni dell'area link del logo o lapossibilit&agrave; di utilizzare un'immagine tipo mybrand.png, aprire il file <strong>header.php</strong> che si trova in ogni cartella idioma, quindi nelle attuali cartelle (Classic sono state rinominate in "tuo_template" giusto?):
<ul style="background-color: #F3F3F3;"><li>/includes/languages/italian/tuo_template </li><li>/includes/languages/english/tuo_template </li></ul>
<br />Struttura del file <strong>header.php</strong><br />
<div style="padding: 8px; background-color: #ffffcc;">
define('HEADER_ALT_TEXT', 'Powered by Zen Cart :: The Art of E-Commerce [home link]');<br />
define('HEADER_SALES_TEXT', '&lt;h1&gt;Qui il tuo slogan!&lt;/h1&gt;');<br />
define('HEADER_LOGO_WIDTH', '200px');<br />
define('HEADER_LOGO_HEIGHT', '70px');<br />
define('HEADER_LOGO_IMAGE', 'logo.gif');<br /></div><br /><br />
Per cambiare il titolo della pagina che compare nella barra del browser ovvero i META TAG imposti per tutto il sito aprire il file <strong>meta_tags.php</strong> in:<ul style="background-color: #F3F3F3;"><li>/includes/languages/italian/tuo_template </li><li>/includes/languages/english/tuo_template </li></ul>
<br />Struttura del file <strong>meta_tags.php</strong><br />
<div style="padding: 8px; background-color: #ffffcc;">
define('TITLE', 'Zen Cart!');<br />
define('SITE_TAGLINE', 'L\'arte dell\'e-commerce');<br />
define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop');<br /></div><br />
<strong>NOTA BENE</strong>: La define "L\'arte dell\'e-commerce" indica che qualsiasi apostrofo dovr&agrave; essere preceduto dal backslash altrimenti si otterr&agrave; un errore di interpretazione, attenzione!<br /><br />
Concludendo, per modificare i titoli dei box laterali, i nomi dei link nei box, i titoli delle pagine 2,3,4 a disposizione, le informazioni nel footer del sito e generalmente parecchie altre define di traduzione utilizzate in svariate parti del sito il file da modificare &grave; il file dell'idioma, nella nostra installazione quindi si tratta di <strong>italian.php</strong> e di <strong>english.php</strong>, posti in:
<ul style="background-color: #F3F3F3;"><li>/includes/languages</li></ul>
<br />Breve parte della struttura del file <strong>italian.php</strong><br />
<div style="padding: 8px; background-color: #ffffcc;">
define('BOX_HEADING_MORE_INFORMATION', 'Altre informazioni');<br />
define('BOX_INFORMATION_PAGE_2', 'Pagina 2');<br />
define('BOX_INFORMATION_PAGE_3', 'Pagina 3');<br />
define('BOX_INFORMATION_PAGE_4', 'Pagina 4');<br /></div><br /><br />
<h2 align="center">ATTENZIONE !</h2><br />
Sempre nel medesimo file <strong>italian.php</strong> e se utilizzato anche in <strong>english.php</strong> sar&agrave; importante, come previsto dalla vigente normativa, attuare una modifica al footer (o pi&egrave; di pagina) inserendo oltre alla denominazione aziendale, indirizzo, telefono anche la <strong>Partita I.V.A.</strong>.<br />Si consiglia di utilizzare l'apposita define aggiungendo i previsti dati.<br /><br />Per quanti intendano omettere il "Powered by Zen-Cart" ricordiamo che vi sono delle precise regole a tal proposito, perfettamente indicate nella licenza d'uso come indicato sia in <a href="http://www.zen-cart.com" target="_blank">ZenCart.com</a> che in <a href="http://www.zencart-italia.it/">ZenCart-Italia.it</a>.<br /><br />
<h2>TESTO NELLA HOME PAGE</h2><br />
Per effettuare le modiche alle scritte (sempre che non le si voglia disattivare da pannello di amministrazione) <strong>Zen Cart, E-commerce su misura - per tutte le esigenze e tutti i budget!</strong> e se negozio (per l'utilizzo quale show room la scritta &egrave; diversa) <strong>Benvenuto e buona navigazione tra i nostri articoli! - Vuoi registrarti o accedere con la tua identit&agrave;?</strong> bisogna fare riferimento al file <strong>index.php</strong> che si trova in ogni cartella idioma, quindi nelle attuali cartelle (Classic sono state rinominate in "tuo_template" giusto?):
<ul style="background-color: #F3F3F3;"><li>/includes/languages/italian/tuo_template </li><li>/includes/languages/english/tuo_template </li></ul>
<br />Parte della struttura del file <strong>index.php</strong><br />
<div style="padding: 8px; background-color: #ffffcc;">
// Testo diverso se Negozio o Showcase<br />
define('TEXT_GREETING_GUEST', 'Benvenuto e buona navigazione tra i nostri articoli!<br />
Vuoi &lt;a href="%s"&gt;registrarti&lt;/a&gt; o accedere con la &lt;a href="%s"&gt;tua identit&agrave;&lt;/a&gt;?');<br />
define('TEXT_GREETING_GUEST', 'Benvenuto, curiosa liberamente tra i nostri articoli.');<br />
define('TEXT_GREETING_PERSONAL', 'Piacere di rivederti &lt;span class="greetUser"a&gt;%s&lt;/span&gt;!<br />
Vuoi dare un\'occhiata agli &lt;a href="%s"&gt;ultimi arrivi&lt;/a&gt; ?');<br /><br />
 define('HEADING_TITLE', 'Zen Cart, E-commerce su misura<br />per tutte le esigenze e tutti i budget!'); <br /><br />
 // Questa parte viene utilizzata per aprire con una sotto categoria<br />
define('HEADING_TITLE', 'Zen Cart per tutte le esigenze!'); <br /></div>
<br /><br />
Nel medesimo file vi sono anche le define utilizzate per il contenuto nella scheda prodotto, eventualmente prendete nota e quando nello sviluppo del Vostro Progetto vi sar&agrave; questa necessit&agrave;, saprete dove andare ...<br />
<hr /><strong><a href="index.php?main_page=page_4">Continua ...</a></strong><hr />
Per rimuovere questo testo, cancellarlo dal Define Pages Editor.<br />
Questo file si trova in /languages/italian/html_includes/tuo_template<br /><hr />