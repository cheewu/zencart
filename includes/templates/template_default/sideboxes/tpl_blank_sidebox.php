<?php
/**
 * blank sidebox - allows a blank sidebox to be added to your site
 *
 * @package templateSystem
 * @copyright 2007 Kuroi Web Design
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: blank_sidebox.php 2007-05-26 kuroi $
 */

  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent servicebg">';

  // Replace the text and HTML tags between the apostophes on lines 19 and 20.
  // Use as many or as few lines using this model as you need for your custom content.
  // If you have a multilingual site define your text in the languages/YOUR_LANGUAGE/extra_definitions/blank_sidebox_defines.php and include it as shown in line 19.
  // If your site is monolingual, you can put the text right here as shown on line 20 (and nobody will know!)


  $content .= '<strong>Service:</strong><br /> &nbsp;&nbsp;&nbsp;&nbsp;admin@karwind.com<br />
';
  $content .= '<a href="http://server.iad.liveperson.net/hc/45408239/?cmd=file&amp;file=visitorWantsToChat&amp;site=45408239&amp;byhref=1" target="chat45408239" onclick="javascript:window.open(\'http://server.iad.liveperson.net/hc/45408239/?cmd=file&file=visitorWantsToChat&site=45408239&referrer=\'+escape(document.location),\'chat45408239\',\'width=472,height=320\');return false;" id="livechat"> </a>';
  $content .= '</div>';
?>
