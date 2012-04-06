<?php
/**
 * Common Template - tpl_box_default_left.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_box_default_left.php 2975 2006-02-05 19:33:51Z birdbrain $
 */

// choose box images based on box position
  if ($title_link) {
    $title = '<a href="' . zen_href_link($title_link) . '">' . $title . BOX_HEADING_LINKS . '</a>';
  }
//
?>
<!--// bof: <?php echo $box_id; ?> //-->
<div class="allborder margin_t g_t_c pad_top blue_con" id="<?php echo str_replace('_', '-', $box_id ); ?>">
<?php echo zen_image($template->get_template_dir('customers_saying.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . 'customers_saying.gif', BOX_HEADING_CUSTOMERS_SAY,'','','border="0" style="margin-top: 3px;"');?>
<?php echo $content; ?>
</div>
<!--// eof: <?php echo $box_id; ?> //-->

