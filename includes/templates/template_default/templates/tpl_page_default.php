<?php
/**
 * Page Template
 *
 * This is the template used for EZ-Pages content display.  It is named "tpl_page_default" instead of ezpage for friendlier 
 * appearance
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_default.php 2741 2005-12-30 19:58:21Z birdbrain $
 */
?>
<div class="centerColumn" id="ezPageDefault">
<h1 id="ezPagesHeading"><?php echo $var_pageDetails->fields['pages_title']; ?></h1>

<?php if (EZPAGES_SHOW_PREV_NEXT_BUTTONS=='2' and $counter > 1) { ?>
<div id="navEZPageNextPrev">
      <a href="<?php echo $prev_link; ?>"><?php echo $previous_button; ?></a>
      <?php echo zen_back_link() . $home_button; ?></a>
      <a href="<?php echo $next_link; ?>"><?php echo $next_item_button; ?></a>
    </div>
<?php } elseif (EZPAGES_SHOW_PREV_NEXT_BUTTONS=='1') { ?>
    <div id="navEZPageNextPrev"><?php echo zen_back_link() . $home_button . '</a>'; ?></div>
<?php  } ?>

<?php

// vertical TOC listing
// create a table of contents for chapter when more than 1 page in the TOC
  if ($pages_listing->RecordCount() > 1 and EZPAGES_SHOW_TABLE_CONTENTS == '1') {?>
<div id="navEZPagesTOCWrapper">
<h2 id="ezPagesTOCHeading"><?php echo TEXT_EZ_PAGES_TABLE_CONTEXT; ?></h2>
<div id="navEZPagesTOC">
<ul>
<?php while (!$pages_listing->EOF) {
// could be used to change classes on current link and toc (table of contents) links
      if ($pages_listing->fields['pages_id'] == $_GET['id']) { ?>

<li><?php echo CURRENT_PAGE_INDICATOR; ?><a href="<?php echo zen_ez_pages_link($pages_listing->fields['pages_id']);?>"><?php echo $pages_listing->fields['pages_title']; ?></a></li>

<?php } else { ?>

<li><?php echo NOT_CURRENT_PAGE_INDICATOR; ?><a href="<?php echo  zen_ez_pages_link($pages_listing->fields['pages_id']); ?>"><?php echo $pages_listing->fields['pages_title']; ?></a></li>
<?php
      }
      $pages_listing->MoveNext();
    } ?>
</ul>
</div>
</div>
<?php
    }
?>
    <div><?php echo $var_pageDetails->fields['pages_html_text']; ?></div>
</div>
