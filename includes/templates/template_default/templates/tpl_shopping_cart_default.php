<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=shopping_cart.<br />
 * Displays shopping-cart contents
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shopping_cart_default.php 5554 2007-01-07 02:45:29Z drbyte $
 */
?>
<div class="centerColumn" id="shoppingCartDefault">
<?php
  if ($flagHasCartContents) {
?>

<?php
  if ($_SESSION['cart']->count_contents() > 0) {
?>
<div class="forward"><?php echo TEXT_VISITORS_CART; ?></div>
<?php
  }
?>

  <div id="cartDefaultHeading" >
      <?php //Edit by Andy 10 622  
      //echo HEADING_TITLE; 
      ?>
  </div>

<?php 
if($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart');
if($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions');
if($messageStack->size('checkout') > 0) echo $messageStack->output('checkout');
?>

<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product'), 'post','id="cart_quantity"'); ?>
<div id="cartInstructionsDisplay" class="content"><?php echo TEXT_INFORMATION; ?></div>

<?php if (!empty($totalsDisplay)) { ?>
  <div class="cartTotalsDisplay important"><?php echo $totalsDisplay; ?></div>
  <br class="clearBoth" />
<?php } ?>

<?php  if ($flagAnyOutOfStock) { ?>

<?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>

<div class="messageStackError"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>

<?php    } else { ?>
<div class="messageStackError"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>

<?php    } //endif STOCK_ALLOW_CHECKOUT ?>
<?php  } //endif flagAnyOutOfStock ?>

<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#cccccc" id="cartContentsDisplay">
<tr class="tableHeading">
      <th id="scProductsHeading" scope="col"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
      <th id="scQuantityHeading" scope="col"><?php echo TABLE_HEADING_QUANTITY; ?></th>
      <th id="scUnitHeading" scope="col"><?php echo TABLE_HEADING_PRICE; ?></th>
      <th id="scTotalHeading" scope="col"><?php echo TABLE_HEADING_TOTAL; ?></th>
      <th id="scRemoveHeading" scope="col">&nbsp;</th>
    </tr>
         <!-- Loop through all products /-->
<?php
  foreach ($productArray as $product) {
?>
     <tr class="<?php echo $product['rowClass']; ?>">

       <td bgcolor="#FFFFFF" class="cartProductDisplay">
<a href="<?php echo $product['linkProductsName']; ?>"><span id="cartImage" class="back"><?php echo zen_get_products_image($product['id'],42,42,'tiny'); ?></span><span id="cartProdTitle"><?php echo $product['productsName'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>'; ?></span></a>
<br class="clearBoth" />


<?php
  echo $product['attributeHiddenField'];
  if (isset($product['attributes']) && is_array($product['attributes'])) {
  echo '<div class="cartAttribsList">';
  echo '<ul>';
    reset($product['attributes']);
    foreach ($product['attributes'] as $option => $value) {
?>

<li><?php echo $value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']); ?></li>

<?php
    }
  echo '</ul>';
  echo '</div>';
  }
?>
       </td>
              <td bgcolor="#FFFFFF" style="width: 100px;text-align: center;">
<?php
  if ($product['flagShowFixedQuantity']) {
    echo $product['showFixedQuantityAmount'] . '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span><br /><br />' . $product['showMinUnits'];
  } else {
    echo $product['quantityField'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
?><div style="display:none">
	<a href="javascript:void(0);" onclick="jQuery('#cart_quantity').submit();return false;"><?php echo TEXT_UPDATE;?></a>
	 | <a href="<?php echo zen_href_link('shopping_cart');?>"><?php echo TEXT_CANCEL;?></a>
	</div>
<?php 
  }
?>       </td>
       <td bgcolor="#FFFFFF" class="cartUnitDisplay"><?php echo $product['productsPriceEach'] . '&nbsp;&nbsp;'; ?></td>
       <td bgcolor="#FFFFFF" class="cartTotalDisplay"><?php echo $product['productsPrice'] . '&nbsp;&nbsp;'; ?></td>
       <td bgcolor="#FFFFFF" class="cartRemoveItemDisplay">
<?php
  if ($product['buttonDelete']) {
?>
           <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>"><?php echo zen_image($template->get_template_dir(ICON_IMAGE_TRASH, DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . ICON_IMAGE_TRASH, ICON_TRASH_ALT); ?></a>
<?php
  }
  if ($product['checkBoxDelete'] ) {
   // echo zen_draw_checkbox_field('cart_delete[]', $product['id']);
  }
?></td>
    </tr>
<?php
  } // end foreach ($productArray as $product)
?>
       <!-- Finished loop through all products /-->
      </table>

<div id="cartSubTotal"><?php echo SUB_TITLE_SUB_TOTAL; ?> <?php echo $cartShowTotal; ?></div>
</form>
<?php
//-----------------------添加折扣码
$selection =  $order_total_modules->credit_selection();
if (sizeof($selection)>0)
{
	for ($i=0, $n=sizeof($selection); $i<$n; $i++)
	{
		if ($_GET['credit_class_error_code'] == $selection[$i]['id'])
		{
		?>
			<div class="messageStackError"><?php echo zen_output_string_protected($_GET['credit_class_error']); ?></div>
		<?php
		}
		for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++)
		{
		?>
<!-- 			<fieldset style="text-align: left;">
			<legend><?php echo $selection[$i]['module']; ?></legend>
			<?php echo $selection[$i]['redeem_instructions']; ?>
			<div class="gvBal larger"><?php echo $selection[$i]['checkbox']; ?></div>
			<label class="inputLabel" style="width: 25em;"<?php echo ($selection[$i]['fields'][$j]['tag']) ? ' for="'.$selection[$i]['fields'][$j]['tag'].'"': ''; ?>><?php echo $selection[$i]['fields'][$j]['title']; ?></label>
			<?php 
            echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, ''), 'post','id="cart_quantity"');
            echo $selection[$i]['fields'][$j]['field']; ?>
            <input type="submit" value="use" />
            </form>
			</fieldset> -->
		<?php
		}
	}
}
?>

<br class="clearBoth" />

<!--bof shopping cart buttons-->
<div class="button_continue"><br /><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_CONTINUE_SHOPPING, BUTTON_CONTINUE_SHOPPING_ALT) . '</a>'; ?></div>
<div class="buttonRow back"></div>
<?php
// show update cart button
  if (SHOW_SHOPPING_CART_UPDATE == 2 or SHOW_SHOPPING_CART_UPDATE == 3) {
?>
<div class="buttonRow back"><?php //echo zen_image_submit(ICON_IMAGE_UPDATE, ICON_UPDATE_ALT); ?></div>
<?php
  } else { // don't show update button below cart
?>
<?php
  } // show update button
?>
<!--eof shopping cart buttons-->



<?php
    if (SHOW_SHIPPING_ESTIMATOR_BUTTON == '1') {
?>

<div class="button_order"><br /><?php //echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_SHIPPING_ESTIMATOR) . '\')">' .zen_image_button(BUTTON_IMAGE_SHIPPING_ESTIMATOR, BUTTON_SHIPPING_ESTIMATOR_ALT) . '</a>'; ?>
<?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHECKOUT, BUTTON_CHECKOUT_ALT) . '</a>'; ?></div>
<?php
    }
?>

<!-- ** BEGIN PAYPAL EXPRESS CHECKOUT ** -->
<?php  // the tpl_ec_button template only displays EC option if cart contents >0 and value >0
/*if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {
  include(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php');
}*/     // paypal button
?>
<!-- ** END PAYPAL EXPRESS CHECKOUT ** -->

<?php
      if (SHOW_SHIPPING_ESTIMATOR_BUTTON == '2') {
/**
 * load the shipping estimator code if needed
 */
?>
      <?php require(DIR_WS_MODULES . zen_get_module_directory('shipping_estimator.php')); ?>

<?php
      }
?>



<?php
  } else {
?>

<h2 id="cartEmptyText"><?php echo TEXT_CART_EMPTY; ?></h2>

<?php
$show_display_shopping_cart_empty = $db->Execute(SQL_SHOW_SHOPPING_CART_EMPTY);

while (!$show_display_shopping_cart_empty->EOF) {
?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_FEATURED_PRODUCTS') { ?>
<?php
/**
 * display the Featured Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
<?php } ?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_SPECIALS_PRODUCTS') { ?>
<?php
/**
 * display the Special Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
<?php } ?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_NEW_PRODUCTS') { ?>
<?php
/**
 * display the New Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php } ?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_UPCOMING') {
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
  }
?>
<?php
  $show_display_shopping_cart_empty->MoveNext();
} // !EOF
?>
<?php
  }
?>
</div>
