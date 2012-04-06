<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_best_sellers.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  $content .= '<div class="wrapper">' . "\n" . '<ol>' . "\n";
  for ($i=1; $i<=sizeof($bestsellers_list); $i++) {
    $content .= '
	<li>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td valign="bottom" width="43" height="43">
		<a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' .zen_get_products_image($bestsellers_list[$i]['id'],SMALL_IMAGE_WIDTH,SMALL_IMAGE_HEIGHT).'</a>
	</td valign="middle">
	<td algin="left" style="padding:0px 5px 0px 5px;" height="43">
		<a href="'.zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']).'">'. zen_trunc_string($bestsellers_list[$i]['name'], BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) . '</a><br> '.zen_get_products_display_price($bestsellers_list[$i]['id']).'
	</td>
	</tr>
	</table>
	</li>' . "\n";
  }
  $content .= '</ol>' . "\n";
  $content .= '</div>' . "\n";
  $content .= '</div>';
?>