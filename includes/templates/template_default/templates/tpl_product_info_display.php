<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 5369 2006-12-23 10:55:52Z drbyte $
 */
 //require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
?>
<div class="centerColumn" id="productGeneral">
<!--bof Form start-->
<?php echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product','NONSSL',true,true,false,true,false), 'post', 'enctype="multipart/form-data"') . "\n"; ?>
<!--eof Form start-->
<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>
<!--bof Category Icon -->
<?php if ($module_show_categories != 0) {?>
<?php
/**
 * display the category icons
 */
//require($template->get_template_dir('/tpl_modules_category_icon_display.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_icon_display.php'); ?>
<?php } ?>
<!--eof Category Icon -->
<!--bof Prev/Next top position -->
<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
<?php
/**
 * display the product previous/next helper
 */
//require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
<?php } ?>
<!--eof Prev/Next top position-->
    <!--bof Product Name-->
    <h2 id="productName" class="productGeneral"><?php echo $products_name." ".$products_model; ?></h2>
    <!--eof Product Name-->
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#dddddd">
  <tr>
    <td width="400" valign="top" bgcolor="#FFFFFF">
   <!--bof Main Product Image -->
<?php

  if (zen_not_null($products_image)) {
/**
 * display the main product image
 */
   require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php');  
?>
<?php
  }
?>
<!--eof Main Product Image-->    </td>
    <td valign="top" bgcolor="#FFFFFF">
    <!--bof Product details list  -->
    <?php if ( (($flag_show_product_info_model == 1 and $products_model != '') or ($flag_show_product_info_weight == 1 and $products_weight !=0) or ($flag_show_product_info_quantity == 1) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
    <ul id="productDetailsList" class="floatingBox back">
      <?php echo (($flag_show_product_info_model == 1 and $products_model !='') ? '<li>' . TEXT_PRODUCT_MODEL .'<strong>'. $products_model . '</strong></li>' : '') . "\n"; ?>
      <?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li>' . TEXT_PRODUCT_WEIGHT .'<strong>'.  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . '</strong></li>'  : '') . "\n"; ?>
      <?php echo (($flag_show_product_info_quantity == 1) ? '<li>' . $products_quantity .'<strong>'. TEXT_PRODUCT_QUANTITY . '</strong></li>'  : '') . "\n"; ?>
      <?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li>' . TEXT_PRODUCT_MANUFACTURER .'<strong>'. $manufacturers_name . '</strong></li>' : '') . "\n"; ?>
    </ul>
    <?php
  }
?>
    <!--eof Product details list -->
     <!--bof Product Price block -->
<h2 id="productPrices" class="productGeneral"><span><?php echo SALE_PRICE;?></span>
  <?php
// base price
  if ($show_onetime_charges_description == 'true') {
    $one_time = '<span class="Price">' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span>';
  } else {
    $one_time = '';
  }
  echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id']);
?>
</h2>
    <!--eof Product Price block -->

    <!--bof free ship icon  -->
    <?php if(zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping || true) { ?>
    <div id="freeShippingIcon"><?php echo TEXT_PRODUCT_FREE_SHIPPING_ICON; ?></div>
    <?php } ?>
    <!--eof free ship icon  -->
    <!--bof Attributes Module -->
    <?php
  if ($pr_attr->fields['total'] > 0) {
?>
    <?php
/**
 * display the product atributes
 */
  require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
    <?php
  }
?>
    <!--eof Attributes Module -->
    <!--bof Quantity Discounts table -->
    <?php
  if ($products_discount_type != 0) { ?>
    <?php
/**
 * display the products quantity discount
 */
 require($template->get_template_dir('/tpl_modules_products_quantity_discounts.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_quantity_discounts.php'); ?>
    <?php
  }
?>
    <!--eof Quantity Discounts table -->
<br class="clearBoth" />
    <!--bof Add to Cart Box -->
    <?php
if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
  // do nothing
} else {
?>
          <?php
    $display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</p>' : '');
            if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
              // hide the quantity box and default to 1
              $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
            } else {
              // show the quantity box
    $the_button = PRODUCTS_ORDER_QTY_TEXT . '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" /><br />' . zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . '<br />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
            }
    $display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
  ?>
        <?php if ($display_qty != '' or $display_button != '') { ?>
        <div id="cartAdd">

          <?php
      echo $display_qty;
      echo $display_button;
            ?>
          </div>
        <?php } // display qty and button ?>
        <?php } // CUSTOMERS_APPROVAL == 3 ?>
        <!--eof Add to Cart Box-->
        <!--
        <br />
        <span style="color: #8F0000;font-size: 13px;text-decoration: underline;">FREE SHIPPING AND MONEY BACK GUARANTEE</span>
        <img src="images/freeshipping.png" width="60px" />
        <img src="images/free-shipping-icon-green-200.jpg" width="100px" /><img src="images/guarantee.jpg" width="100px" />-->
  </td>
  </tr>
</table>
<br class="clearBoth" />
 <!--bof Additional Product Images -->
<?php
/**
 * display the products additional images
 */
 // require($template->get_template_dir('/tpl_modules_additional_images.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_additional_images.php');
    //------------------------------------------------ add 2010 6 11 这里加入额外的图片 -------------------------------------------//
  $products_extra_images_sql = "select * from products_image where products_id = " . $_GET['products_id'] . " order by products_image_sort";
  $products_extra_images = $db->Execute($products_extra_images_sql);
  $products_extra_image = '';
  while(!$products_extra_images->EOF){
      $products_extra_image .= '<p><img src="' . DIR_WS_IMAGES . $products_extra_images->fields['products_image'] . '" title="' . addslashes($products_name) . '" alt="' . addslashes($products_name) . '" width="500" hspace="1" vspace="1" border="0" /></p>';
      $products_extra_images->MoveNext();
  }
  //----------------------------------------------------- end 2010 6 11 ---------------------------------------------------------//
  ?>
<!--eof Additional Product Images -->
<!--bof Product description -->
<?php if ($products_description != '') { ?>
<div id="productDescription" class="productGeneral biggerText">
  <div><strong><?php echo TEXT_PRODUCT_DESCRIPTION;?></strong></div>
  <?php echo stripslashes($products_description . $products_extra_image); ?>
</div>
<?php } ?>
<!--eof Product description -->
 <!--bof Tell a Friend button -->
<?php if ($flag_show_product_info_tell_a_friend == 1) { ?>
<div class="TellFriends">
<div class="TellFriendsEmail">
<?php echo ($flag_show_product_info_tell_a_friend == 1 ? '<a href="' . zen_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $_GET['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_TELLAFRIEND, BUTTON_TELLAFRIEND_ALT) . '</a>' : ''); ?> 
</div>
<!-- AddThis Button BEGIN  edit by Andy 06-18-->
<div class="addthis_toolbox addthis_default_style" style="float:left;">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=fangnet" class="addthis_button_compact">Share</a>
<span class="addthis_separator">|</span>
<a class="addthis_button_facebook"></a>
<a class="addthis_button_myspace"></a>
<a class="addthis_button_google"></a>
<a class="addthis_button_twitter"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=fangnet"></script>
<!-- AddThis Button END -->
<br class="clear" />
</div>
<?php
  }
?>
<!--eof Tell a Friend button -->
<!--bof Reviews button and count-->
<?php
  if ($flag_show_product_info_reviews == 1) {
    // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button
    if ($reviews->fields['count'] > 0 ) { ?>
<div ><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params()) . '">' . zen_image_button(BUTTON_IMAGE_REVIEWS, BUTTON_REVIEWS_ALT) . '</a>'; ?></div>
<br class="clearBoth" />
<p class="reviewCount"><?php echo ($flag_show_product_info_reviews_count == 1 ? TEXT_CURRENT_REVIEWS . ' ' . $reviews->fields['count'] : ''); ?></p>
<?php } else { ?>
<div><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array())) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></div>
<br class="clearBoth" />
<?php
  }
}
?>
<!--eof Reviews button and count -->
<!--bof Prev/Next bottom position -->
<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 2 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
<?php
/**
 * display the product previous/next helper
 */
 require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
<?php } ?>
<!--eof Prev/Next bottom position -->
<!--bof Product date added/available-->
<?php
  if ($products_date_available > date('Y-m-d H:i:s')) {
    if ($flag_show_product_info_date_available == 1) {
?>
  <p id="productDateAvailable" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_AVAILABLE, zen_date_long($products_date_available)); ?></p>
<?php
    }
  } else {
    if ($flag_show_product_info_date_added == 1) {
?>
      <p id="productDateAdded" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_ADDED, zen_date_long($products_date_added)); ?></p>
<?php
    } // $flag_show_product_info_date_added
  }
?>
<!--eof Product date added/available -->
<!--bof Product URL -->
<?php
  if (zen_not_null($products_url)) {
    if ($flag_show_product_info_url == 1) {
?>
    <p id="productInfoLink" class="productGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($products_url), 'NONSSL', true, false)); ?></p>
<?php
    } // $flag_show_product_info_url
  }
?>
<!--eof Product URL -->
<!--bof also purchased products module-->
<?php require($template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_also_purchased_products.php');?>
<!--eof also purchased products module-->
<!--bof Form close-->
</form>
<!--bof Form close-->
</div>