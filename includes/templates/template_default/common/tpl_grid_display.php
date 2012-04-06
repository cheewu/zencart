<?php
/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tabular_display.php 3957 2006-07-13 07:27:06Z drbyte $
 */

//print_r($list_box_contents);

?>
<?php
if (!function_exists("stripos")) {
  function stripos($str,$needle) {
   return strpos(strtolower($str),strtolower($needle));
  }
}
?>

<div id="list_bg_img">
<ul>
<?php
  $list_box_contentsNum = count($list_box_contents);
  for($row=0; $row<$list_box_contentsNum; $row++) {
    if(isset($_GET['keyword'])){
      $list_box_contents_keywordPos[$row] = stripos($list_box_contents[$row]['products_name'],$_GET['keyword']);
      if (is_int($list_box_contents_keywordPos[$row])) {
        $list_box_contents_name[$row] = str_ireplace($_GET['keyword'],'<span class="red">'.$_GET['keyword'].'</span>',$list_box_contents[$row]['products_name']);
      }else{
        $list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];
      } 
    }else {
      $list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];
    }
?>
<li>
<div><ul><li class="relative">
<?php echo $list_box_contents[$row]['product_is_sale_item'].'<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '" class="ih" >' . zen_image(DIR_WS_IMAGES .$list_box_contents[$row]['products_image'], $list_box_contents[$row]['products_name'],IMAGE_PRODUCT_LISTING_WIDTH,IMAGE_PRODUCT_LISTING_HEIGHT, 'class="listingProductImage"') . '</a>'?>
</li>
<p>
<?php echo '<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '" >'.$list_box_contents_name[$row]. '</a>';
			 echo $list_box_contents[$row]['product_is_always_free_shipping'];?>
</p>
<div class="black line_120 margin_t">
<strong style="float:left;"><?php echo TEXT_OUR_PRICE;?>: </strong>
<div class="line_180" align="center">
<?php if ($list_box_contents[$row]['products_quantity'] > 0) {
      echo '<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id'].'&action=buy_now') . '" >';
      echo '<span class="car_price">';
      echo ($list_box_contents[$row]['products_price'] == 0 ? $currencies->display_price($list_box_contents[$row]['products_price_sample'],zen_get_tax_rate($products_tax_class_id)): $currencies->display_price($list_box_contents[$row]['products_price'],zen_get_tax_rate($products_tax_class_id)));
      echo '</span>';
      echo '</a>';
    }else{
      echo '<span>';
      echo ($list_box_contents[$row]['products_price'] == 0 ? $currencies->display_price($list_box_contents[$row]['products_price_sample'],zen_get_tax_rate($products_tax_class_id)): $currencies->display_price($list_box_contents[$row]['products_price'],zen_get_tax_rate($products_tax_class_id)));
      echo '</span><span class="sold_out"></span>';
    }
    ?>
</div>
</div>
<div class=""><?php echo zen_get_reviews($list_box_contents[$row]['products_id']);?></div>
</ul></div>
</li>
<?php
  }
?>
</ul>
</div>
<br class="clear"  />