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

<?php
	$list_box_contents_num = count($list_box_contents);
  for($row=0; $row<$list_box_contents_num; $row++) {
  if(isset($_GET['keyword'])){
  	$list_box_contents_keywordPos[$row] = stripos($list_box_contents[$row]['products_name'],$_GET['keyword']);
  	if (is_int($list_box_contents_keywordPos[$row])) {
	    $list_box_contents_name[$row] = str_ireplace($_GET['keyword'],'<span class="red">'.$_GET['keyword'].'</span>',$list_box_contents[$row]['products_name']);
  	}else{
	    $list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];
  	}
  	
  	$list_box_contents_description_Pos[$row] = stripos($list_box_contents[$row]['products_description'],$_GET['keyword']);
  	if (is_int($list_box_contents_description_Pos[$row])){ 		
	    $list_box_contents_description[$row] = str_ireplace($_GET['keyword'],'<span class="red">'.$_GET['keyword'].'</span>',$list_box_contents[$row]['products_name']);
  	}else{
	    $list_box_contents_description[$row] = $list_box_contents[$row]['products_description'];
  	}
  }else {
  	$list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];
  	$list_box_contents_description[$row] = $list_box_contents[$row]['products_description'];
  }
	echo '<ul class="list_product clear">';
?>
<li class="relative">
<?php echo '<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '" class="ih" >' . zen_image(DIR_WS_IMAGES .$list_box_contents[$row]['products_image'], $list_box_contents[$row]['products_name'],IMAGE_PRODUCT_LISTING_WIDTH,IMAGE_PRODUCT_LISTING_HEIGHT, 'class="listingProductImage"') . '</a>'?>
</li>
<li class="li_con">
<dl>
<dt><?php echo '<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) .'"><strong class="big">'.$list_box_contents_name[$row]. '</strong></a>';?></dt>
<dd class="product_detail">
<strong><?php echo TEXT_DESCRIPTION;?>: </strong><?php echo $list_box_contents_description[$row].' <br /><a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '">Product Detail &gt;&gt;</a>';?>

<?php echo $list_box_contents[$row]['product_is_always_free_shipping'];?></dd>
<dd>
	            <strong><?php echo TEXT_START_FROM;?>: </strong><?php echo $list_box_contents[$row]['products_quantity_order_min'].' '.PRODUCTS_QUANTITY_UNIT_TEXT_LISTING;?>
	        </dd>
	          <dd>
	            <!--<strong><span class="fl"><?php //echo BOX_HEADING_REVIEWS;?>:&nbsp;&nbsp;</span></strong>-->
	            <?php //echo zen_get_reviews($list_box_contents[$row]['products_id']); ?>			              

	        </dd>
	        
	    </dl>
	</li>	
	<li>
	   <dl>	   
	    <dd class="product_detail">
      <strong><?php echo TABLE_ATTRIBUTES_QTY_PRICE_PRICE;?>: </strong><strong class="red big"><?php echo $currencies->display_price($list_box_contents[$row]['products_price'],zen_get_tax_rate($products_tax_class_id)); ?></strong><br/>
          <?php echo TABLE_FOR;?> (<?php echo $list_box_contents[$row]['products_quantity_order_min'];?>) <?php echo PRODUCTS_QUANTITY_UNIT_TEXT_LISTING;?>:
      </dd>
	   </dl>
		 <?php if ($list_box_contents[$row]['products_quantity'] > 0) { ?>
		   <a href="<?php echo zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']),'cPath='.zen_get_generated_category_path_rev($_GET['cPath']).'&products_id='.$list_box_contents[$row]['products_id'].'&action=buy_now'); ?>" class="buttonAddCart"><?php echo PRODUCTS_QUANTITY_IN_CART_LISTING;?></a>	
		 <?php }else{ ?>
			<span class="sold_out"></span>
		 <?php } ?>
	    	     
	    
<?php
		echo '</li></ul>';
  }
?> 