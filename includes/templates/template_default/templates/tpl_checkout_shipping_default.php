<?php
/**
* Page Template
*
* Loaded automatically by index.php?main_page=checkout_shipping.<br />
* Displays allowed shipping modules for selection by customer.
*
* @package templateSystem
* @copyright Copyright 2003-2007 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_checkout_shipping_default.php 6964 2007-09-09 14:22:44Z ajeh $
*/
?>
<?php
if($messageStack->size('checkout_shipping') > 0) echo $messageStack->output('checkout_shipping');
if($messageStack->size('checkout_payment') > 0) echo $messageStack->output('checkout_payment');
if($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions');
?>
<div class="centerColumn" id="checkoutShipping">

<?php echo zen_draw_form('checkout_confirmation', zen_href_link('create_orders', '', 'SSL'), 'post', 'onsubmit="submitonce();"') . zen_draw_hidden_field('action', 'process');//echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>
<h1 id="checkoutShippingHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="checkoutShipto" style="width: 300px;float:left;line-height: 25px">
<h2 id="checkoutShippingHeadingAddress"><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></h2>
<address class=""><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'); ?></address>
<?php if ($displayAddressEdit)
{
?>
	<div style="text-align: left;"><?php echo '<a href="' . $editShippingButtonLink . '">' . zen_image_button(BUTTON_IMAGE_CHANGE_ADDRESS, BUTTON_CHANGE_ADDRESS_ALT) . '</a>'; ?></div>
<?php
}
?>
</div>
<!--
<div class="floatingBox important forward"><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION; ?></div>-->
<!-- new billing -->
<div id="checkoutBillingto" style="width: 300px;float:right;line-height: 25px">
<h2 id="checkoutShippingHeadingAddress"><?php echo TABLE_HEADING_BILLING_ADDRESS; ?></h2>
<address><?php echo zen_billing_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, ' ', '<br />'); ?></address>
<div style="text-align: left;"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHANGE_ADDRESS, BUTTON_CHANGE_ADDRESS_ALT) . '</a>'; ?></div>
</div>
<!-- new billing eof -->
<br class="clearBoth" />
<?php
if (zen_count_shipping_modules() > 0)
{
?>
	<fieldset>
	<legend><?php echo TABLE_HEADING_SHIPPING_METHOD;//shipping title ?></legend>
	<?php
	if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1)
	{
	?>
	<!-- <div id="checkoutShippingContentChoose" class="important"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></div> -->
	<?php
	}
	elseif($free_shipping == false)
	{
	?>
		<!-- <div id="checkoutShippingContentChoose" class="important"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></div> -->
	<?php
	}
	?>
	<?php
	if ($free_shipping == true)
	{
	?>
		<div id="freeShip" class="important" ><?php echo FREE_SHIPPING_TITLE; ?>&nbsp;<?php echo $quotes[$i]['icon']; ?></div>
		<div id="defaultSelected"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . zen_draw_hidden_field('shipping', 'free_free'); ?></div>
	<?php
	}
	else
	{
		$radio_buttons = 0;
		for ($i=0, $n=sizeof($quotes); $i<$n; $i++)
		{
			if($quotes[$i]['module'] != '')
			{ // Standard
			?>

				<?php
				if(isset($quotes[$i]['error']))
				{
				?>
				<div><?php echo $quotes[$i]['error']; ?></div>
				<?php
				}
				else
				{
					for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++)
					{
						$checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);
						if ( ($checked == true) || ($n == 1 && $n2 == 1) )
						{

						}
						?>
						<?php
						if ( ($n > 1) || ($n2 > 1) )
						{
						?>
							<div class="shipping_price"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							$cur_cost = $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							$cur_cost_total = $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost']+$order->info['subtotal']-$coupon, (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							$cur_cost_pa = $currencies->format_re(zen_add_tax($quotes[$i]['methods'][$j]['cost']+$order->info['subtotal']-$coupon, (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							?></div>
						<?php
						}
						else
						{
						?>
							<div class="shipping_price"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']);
							$cur_cost = $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							$cur_cost_total = $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost']+$order->info['subtotal']-$coupon, (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							$cur_cost_pa = $currencies->format_re(zen_add_tax($quotes[$i]['methods'][$j]['cost']+$order->info['subtotal']-$coupon, (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
							?></div>
						<?php
						}//print_r($order->info);die();
						echo zen_draw_hidden_field($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_v', $cur_cost, 'id="' . $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_v"');
						echo zen_draw_hidden_field($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_v_t', $cur_cost_total, 'id="' . $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_v_t"');
						echo zen_draw_hidden_field($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_v_p', $cur_cost_pa, 'id="' . $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_v_p"');
						echo zen_draw_hidden_field($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_t', $quotes[$i]['module'] . '(' . $quotes[$i]['methods'][$j]['title'] . ')', 'id="' . $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] . '_t"'); 
						?>
						<?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id'].'" onclick="change_shipping(this)"'); ?>
						<label for="ship-<?php echo $quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id']; ?>" class="checkboxLabel" ><?php echo $quotes[$i]['methods'][$j]['title']; ?></label>
						<!--</div>-->
						<br class="clearBoth" /><br class="clearBoth" />
						<?php
						$radio_buttons++;
					}
				}
				?>
				
			<?php
			}
			// eof: field set
		}
	}
	?>
</fieldset>
<?php
}
else
{
?>
	<h2 id="checkoutShippingHeadingMethod"><?php echo TITLE_NO_SHIPPING_AVAILABLE; ?></h2>
	<div id="checkoutShippingContentChoose" class="important"><?php echo TEXT_NO_SHIPPING_AVAILABLE; ?></div>
<?php
}
?>







<!--
<fieldset class="shipping" id="comments">
<legend><?php //echo TABLE_HEADING_COMMENTS; ?></legend>
<?php //echo zen_draw_textarea_field('comments', '45', '3'); ?>
</fieldset>-->
<!-- new total -->
<fieldset id="checkoutOrderTotals">
<legend id="checkoutPaymentHeadingTotal"><?php echo TEXT_YOUR_TOTAL; ?></legend>
<?php
if (MODULE_ORDER_TOTAL_INSTALLED) {
$order_totals = $order_total_modules->process();
?>
<?php $order_total_modules->output(); ?>
<?php
}
?>
</fieldset>
<!-- new total eof -->


<!-- new comments -->
<fieldset>
<legend><?php echo TABLE_HEADING_COMMENTS; ?></legend>
<?php echo zen_draw_textarea_field('comments', '45', '7'); 
echo zen_draw_hidden_field('source', 'pay_orders'); //----------ӵĿǷֹpaypalύҳûͨҳ,ظɶ
//------------- ĳЩģ
//------
if (MODULE_PAYMENT_PAYEASE_MONEYTYPE == 'CNY') {
$v_moneytype = '0';
} else {
$v_moneytype = '1';
}
$v_amount = number_format(($order->info['total']) * $currencies->get_value(MODULE_PAYMENT_PAYEASE_MONEYTYPE), 2, '.', '');
echo zen_draw_hidden_field('v_moneytype', $v_moneytype);
echo zen_draw_hidden_field('v_amount', $v_amount, 'id="v_amount"');
?>
</fieldset>
<!-- new comments eof -->
<div class="buttonRow forward"><br /><?php echo zen_image_submit(BUTTON_IMAGE_CONTINUE_CHECKOUT, BUTTON_CONTINUE_ALT, "name='btn_submit' id='btn_submit'"); ?></div>
</form>
</div>