<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_confirmation.<br />
 * Displays final checkout details, cart, payment and shipping info details.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_confirmation_default.php 6247 2007-04-21 21:34:47Z wilt $
 */
?>

<link rel="stylesheet" type="text/css" href="includes/templates/template_default/css/jquery.alerts.css" />
<script type="text/javascript" src="includes/templates/template_default/jscript/jquery.js"></script>
<script type="text/javascript" src="includes/templates/template_default/jscript/jquery.alerts.js"></script>
<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>

<?php

  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" target="'.$target.'"');//------- 增加弹出窗口

if($_POST['payment_module'] != 'cc' && $_POST['payment'] != 'cc') {
  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
?>

<div class="centerColumn_1" id="shoppingCartDefault_1">

<?php

$order_total_modules = new order_total;
$order_totals = $order_total_modules->process();
?>
<?php
    foreach($order_totals as $key => $value){
    if($value['code'] == 'ot_total'){
        $order_total=$value['text'];
    }
}
}
?>
<div id="checkoutSuccessHeading_1">

<!-- <center><h1 style="font-size:22px; font-weight:bold;"><img src="/images/order-success.png"  /> <?php echo ORDERS_SUCCESSFUL_MESSAGE;?> </h1></center> -->
<?php if($target=='_blank'){printf(TEXT_ORDER_DES,$_SESSION['order_number_created'],$$_SESSION['payment']->title,$_SESSION['shipping']['title']);}else{printf(TEXT_ORDER_DES1,$_SESSION['order_number_created'],$$_SESSION['payment']->title,$_SESSION['shipping']['title']);}?></div>
</div>
<?php if(strtolower($$_SESSION['payment']->title)!='paydollar'){?><div id="btn_payment_check" class="btn_end_check" style="text-align:center"><?php if($target=='_blank'){echo '<iframe src="'.$form_action_url.'" method="post" id="checkout_confirmation" height="50px" width="250px;" frameborder="0px" style="border:0px;" scrolling="no"></iframe>';}else{ echo "";}?></div><?php }?>
<?php if(strtolower($$_SESSION['payment']->title)=='paydollar'){?><div class="btn_end_check" style="text-align:center"><?php if($target=='_blank'){echo zen_image_submit('btn_end_check.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"');}else{ echo "";}?></div><?php }?>
<!--<div id="checkoutSuccessOrderc_1"><?php //echo TEXT_WINDOW_PAYMENT;?></div>-->
</div>


</form>
<script type="text/javascript">
$(document).ready( function()
{
	/*
	$('#checkout_confirmation').submit(function()
	{

		jAlert('<form id="form1" name="form1" method="post" action="<?php echo zen_href_link("checkout_orders");?>"><?php echo ORDERS_SUCCESSFUL_FLOAT_WINDOW;?><input name="source_curr_order_id" type="hidden" id="source_curr_order_id" value="<?php echo $_SESSION['order_number_created'];?>" />\n<input type="submit" name="Submit" value="<?php echo ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON1;?>" /><input type="button" id="Payment_successful" name="Submit2" value="<?php echo ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON2;?>" onClick="window.location.href=\'<?php echo zen_href_link("account");?>\'" /></form>', '<?php echo ORDERS_SUCCESSFUL_FLOAT_WINDOW_EXTRA;?>');
		$('#btn_submit').disabled=true;
		return true;
	});
	*/
}
)
</script>