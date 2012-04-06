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


<?php if ($messageStack->size('checkout_order') > 0) echo $messageStack->output('checkout_order'); ?>
<?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>
<link rel="stylesheet" type="text/css" href="includes/templates/template_default/css/jquery.alerts.css" />
<script type="text/javascript" src="includes/templates/template_default/jscript/jquery.js"></script>
<script type="text/javascript" src="includes/templates/template_default/jscript/jquery.alerts.js"></script>
<div class="centerColumn_1" id="shoppingCartDefault">
<div id="checkoutSuccessHeading_1"><?php TEXT_ORDER_CREATED;?></div>
<div id="checkoutpayment_1">
<?php
/*===========================================================*/
  $radio_buttons = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>
<?php
    if (sizeof($selection) > 1) {
        if (empty($selection[$i]['noradio']))
		{
 ?>
<?php echo zen_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $order_payment ? true : false), 'onclick=payment_click("'.$selection[$i]['id'].'","'.$order_no.'") id="pmt-'.$selection[$i]['id'].'"'); ?>
<?php   } ?>
<?php
    } else {
    	
?>
<?php echo zen_draw_hidden_field('payment', $selection[$i]['id']); ?>
<?php
    }
?>
<label for="pmt-<?php echo $selection[$i]['id']; ?>" class="radioButtonLabel"><?php echo $selection[$i]['module']; ?></label>

<?php
    if (defined('MODULE_ORDER_TOTAL_COD_STATUS') && MODULE_ORDER_TOTAL_COD_STATUS == 'true' and $selection[$i]['id'] == 'cod') {
?>
<div class="alert"><?php echo TEXT_INFO_COD_FEES; ?></div>
<?php
    } else {
      // echo 'WRONG ' . $selection[$i]['id'];
?>
<?php
    }
?>
<br class="clearBoth" />

<?php
    if (isset($selection[$i]['error'])) {
?>
    <div><?php echo $selection[$i]['error']; ?></div>

<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>

<div class="ccinfo">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
<label <?php echo (isset($selection[$i]['fields'][$j]['tag']) ? 'for="'.$selection[$i]['fields'][$j]['tag'] . '" ' : ''); ?>class="inputLabelPayment"><?php echo $selection[$i]['fields'][$j]['title']; ?></label><?php echo $selection[$i]['fields'][$j]['field']; ?>
<br class="clearBoth" />
<?php
      }
?>
</div>
<br class="clearBoth" />
<?php
    }
    $radio_buttons++;
?>
<br class="clearBoth" />
<?php
  }
/*===========================================================*/
?>

 </div>
 </div>
<div>
<div id="submit_content_form">
<?php
  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" onsubmit="return submitorder();" target="_blank"');//------- 增加弹出窗口

  if (is_array($current_payment_modules->modules))
	{
    echo $current_payment_modules->process_button();
  }
  echo "<div class='buttonRow forward'>".zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, "name='btn_submit' id='btn_submit'")."</div></form>";
?>
</div>

</div>

  <div style="display: none" id='myonpagecontent' class="payment_float_box">
  <div>
  <h2>test</h2>
  <p>test1<br>test2</p>
  <div><a onclick="tb_remove();location.href='<?php echo zen_href_link('account');?>'">
  <input value='back' type='button' /> 
  </a>
  <a onclick="tb_remove();location.href='<?php echo zen_href_link('account');?>'" 
  target='_blank'>
  <input onclick="return dialoghide();" value='continue' type='button' />
  </a> 
  </div>
  </div></div>
<!--
<script type="text/javascript">
function submitorder() {
    var form = document.forms["checkout_confirmation"];

    var button = document.getElementById('btn_submit');
    button.disabled=true;
    button.src='includes/templates/sell/buttons/english/button_confirm_order_01.gif';
    setTimeout("tb_show('','#TB_inline?height=200&width=200&inlineId=myonpagecontent','')",100);
    
    submitonce();
}
</script>
-->
<script type="text/javascript">

function payment_click(payment,order_no)
{
	$('#submit_content_form').html('<font color="red">loading.....</font>');
	$.ajax({url: '<?php echo zen_href_link("checkout_orders","", "SSL")?>',
	type: 'POST',
	data:{source_curr_order_id:order_no,payment:payment,act:'ajax'},
	dataType: 'html',
	timeout: 10000,
	error: function(){alert('Error loading PHP document');},
	success: function(result){$('#submit_content_form').html(result);}
	});
}
</script>
<script type="text/javascript">
$(document).ready( function()
{
	$('#checkout_confirmation').submit(function()
	{ 

		jAlert('<input type="button" value="Payment Failure" id="popup_ok" /><input type="button" id="Payment_successful" name="Submit2" value="Payment successful" onClick="window.location.href=\'<?php echo zen_href_link("account");?>\'" />', 'Alert Dialog');
		$('#btn_submit').disabled=true;
		return true;
	}); 
	/*	
	$("#alert_button").click( function(){
		jAlert('<form id="form1" name="form1" method="post" action="<?php echo zen_href_link("checkout_orders");?>"><input type="submit" name="Submit" value="Payment Failure" /><input name="source_curr_order_id" type="hidden" id="source_curr_order_id" value="<?php echo $_SESSION["order_number_created"];?>" /><input type="button" id="Payment_successful" name="Submit2" value="Payment successful" onClick="window.location.href=\'<?php echo zen_href_link("account");?>\'" /></form>', 'Alert Dialog');$("#checkout_confirmation").;$("#alert_button").click(function()(alert(1111111)));
	});
	*/
}
)
</script>