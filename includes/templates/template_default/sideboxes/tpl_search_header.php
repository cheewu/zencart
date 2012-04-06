<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_search_header.php 4142 2006-08-15 04:32:54Z drbyte $
 */
  $content = "";
  $content .= zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
  $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
  $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
  if (strtolower(IMAGE_USE_CSS_BUTTONS) == 'yes') {
    $content .= zen_draw_input_field('keyword', '', 'size="6" maxlength="30" style="width: 180px"  onfocus="if (this.value == \'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'\';"') . '&nbsp;' . zen_image_submit (BUTTON_IMAGE_SEARCH,HEADER_SEARCH_BUTTON);
  } else {
    $content .= zen_draw_input_field('keyword', '', 'size="6" maxlength="30" style="width: 180px"  onfocus="if (this.value == \'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'\';"') . '&nbsp;<input type="submit" class="btn" value="" />';
  }
  $content .= "</form>";
?>