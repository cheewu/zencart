<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td colspan="4">
<script type="text/javascript" src="includes/modules/pages/account_history_info/jscript_jquery-min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

  $('#tabMenu > li').click(function(){
	  var class_style=$(this).attr("class");
	  class_style=class_style.replace('selected','');
	  class_style=class_style.replace(' ','');
		class_style=class_style.replace('mouseover','');
	  //alert(class_style);
	  var order_no=<?php echo $_SESSION["create_order_no"];?>;
	  $.post('index.php?main_page=create_orders',{paymentd:class_style,act:"insert_payment",orders_no:order_no},function(data)
		{
			if(data=='ok')
			{
				
			}
			else
			{
				alert('order is error');
			}
		});
		$('#tabMenu > li').removeClass('selected');
		$(this).addClass('selected');
		$('.boxBody div').hide();//slideUp('1500')
		$('.boxBody div:eq(' + $('#tabMenu > li').index(this) + ')').show();//slideDown('1500')
  }).mouseover(function() {

    $(this).addClass('mouseover');
    $(this).removeClass('mouseout');   
    
  }).mouseout(function() {
    
    $(this).addClass('mouseout');
    $(this).removeClass('mouseover');    
    
  });

});

</script>
<style>
#tabMenu {margin:0px;padding:0px;list-style:none;}
#tabMenu li {float:left;height:32px;margin:0px 3px;line-height:32px;cursor:pointer;font-size:12px;background-color:#EBEBEB;width:140px;text-align:center;}
.box {width:100%;/*padding:10px;*/}
.boxTop {background:url(images/boxTop.gif) no-repeat;height:11px;clear:both}
*html .boxTop {margin-bottom:-2px;}
.boxBody {background-color:#fff;border:1px solid #ccc}
.boxBottom {background:url(images/boxBottom.gif) no-repeat;height:11px;}

.boxBody div {display:none;padding:5px;}
.boxBody div.show {display:block;}
.boxBody #category a {display:block;}
</style>
	<!-- new payment -->
<?php // ** BEGIN PAYPAL EXPRESS CHECKOUT **
//print_r($order);
//echo zen_draw_form('checkout_pay_info', $form_action_url, 'post', 'id="checkout_pay_info" target="'.$target.'"');
if (!$payment_modules->in_special_checkout()) {
?>
<!-- <fieldset>
<legend><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></legend> -->
<div id="create_orders">
<?php
if (SHOW_ACCEPTED_CREDIT_CARDS != '0') {
?>
<?php
if (SHOW_ACCEPTED_CREDIT_CARDS == '1') {
echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled();
}
if (SHOW_ACCEPTED_CREDIT_CARDS == '2') {
echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled('IMAGE_');
}
?>
<br class="clearBoth" />
<?php } ?>

<?php

$selection = $payment_modules->selection();
if (sizeof($selection) > 1) {
?>
<div style="font-size:16px; padding-top:8px; border-bottom:2px solid #25C1B3; padding-bottom:8px;">Order Information</div>
<p style="float:right; text-align:center; width:250px; margin-top:20px;">
<!-- Start Trustico Smart Seal -->
<!--<script language="JavaScript" type="text/javascript" src=" https://smarticon.geotrust.com/si.js"></script>-->
<!-- End Trustico Smart Seal --></p>
<p class="important" style="text-align:left; width:700px; line-height:20px;">

<?php printf(TEXT_SELECT_PAYMENT_METHOD,$_SESSION['order_number_created'],$order->totals[2]['text'],$_SESSION['shipping']['title']); ?></p>
<?php
} elseif (sizeof($selection) == 0) {
?>
<p class="important"><?php echo TEXT_NO_PAYMENT_OPTIONS_AVAILABLE; ?></p>
<?php
}
?>

<table id="myAccountOrdersStatus" style="margin-bottom:10px;" border="0" cellpadding="0" cellspacing="0" width="100%">


</table>


<div class="box">
<?php
//print_r($order);
$radio_buttons = 0;
echo '<ul id="tabMenu">';
for ($i=0, $n=sizeof($selection); $i<$n; $i++)
{
	if (sizeof($selection) > 1)
	{
		if (empty($selection[$i]['noradio']))
		{
			if($radio_buttons==0)
				$selectclass=" selected";
			else
				$selectclass="";
			echo '<li class="'.$selection[$i]['id'].$selectclass.'">'.$selection[$i]['title'].'</li>';
			//echo zen_draw_radio_field('payment', $selection[$i]['id'],false, 'onclick="change_pay_info(\''.$selection[$i]['id'].'\',\''.$_SESSION['order_number_created'].'\')" id="pmt-'.$selection[$i]['id'].'"');
		}
	}
	else
	{
		echo '<li class="'.$selection[$i]['id'].'">'.$selection[$i]['title'].'</li>';
		//echo zen_draw_hidden_field('payment', $selection[$i]['id']);
	}
	$radio_buttons++;
}
echo '</ul>';
echo '<br class="clearBoth" />';
$radio_buttons = 0;
echo '<div class="boxBody">';
for ($i=0, $n=sizeof($selection); $i<$n; $i++)
{
    $pre_content = '';  // 用来额外说明
	$payment_d=$selection[$i]['id'];
	if($payment_d == 'cc')
	{
		$target="_blank";
		$form_action_url=zen_href_link('checkout_payment_process', '', 'SSL');
		$btn_submit=zen_image_submit('btn_end_check.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"');
	} else if($payment_d=='Paypal')
	{
		$$payment_d->set_email_information();
		$target="_blank";
		$form_action_url=$$payment_d->form_action_url;
		//$btn_submit='<iframe src="'.$form_action_url.'" method="post" id="checkout_confirmation" height="50px" width="250px;" frameborder="0px" style="border:0px;" scrolling="no"></iframe>';
        $pre_content = "<p>Se abbia un conto di Paypal puoi fare il pagamento direttamente. E se no, non preoccuparti, perche' attraverso Paypal puoi pagare anche in altre modalita' come Postepay, VISA, MasterCard, Carta Aura oppure American Express. Puoi effettuare il pagamento in tutte queste modalita'. </p>";
        $btn_submit= '<br />' . zen_image_submit('btn_end_check.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"');

	}
	elseif($payment_d=='VisaMastercard')
	{
		$$payment_d->set_email_information();
		$target="_blank";
		$form_action_url=$$payment_d->form_action_url;
		//$btn_submit='<iframe src="'.$form_action_url.'" method="post" id="checkout_confirmation" height="200px" width="500px;" frameborder="0px" style="border:0px;" scrolling="no"></iframe>';
        $btn_submit= '<br />' . $$payment_d->process_button() . zen_image_submit('btn_end_check.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"');
	}elseif($payment_d=='rppay')
	{
		$target="_blank";
		$form_action_url=zen_href_link('checkout_payment_process', '', 'SSL');
		//$btn_submit='<iframe src="'.$form_action_url.'" method="post" id="checkout_confirmation" height="200px" width="500px;" frameborder="0px" style="border:0px;" scrolling="no"></iframe>';
        $btn_submit= '<br />' . zen_image_submit('btn_end_check.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"');
	}
	else
	{
		$target="_self";
		$form_action_url=zen_href_link('account', '', 'SSL');
		$btn_submit=zen_image_submit('btn_end_check.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"');
	}
	if($radio_buttons==0)
		$selectclass=' class="show"';
	else
		$selectclass="";
	
	//echo '<label for="pmt-'.$selection[$i]['id'].'" class="radioButtonLabel">'.$selection[$i]['module'].'</label>';
	echo '<div id="'.$selection[$i]['id'].'"'.$selectclass.'>';
    echo $pre_content;
	echo zen_draw_form('checkout_pay_info_' . $payment_d, $form_action_url, 'post', ' target="'.$target.'"');
	if (defined('MODULE_ORDER_TOTAL_COD_STATUS') && MODULE_ORDER_TOTAL_COD_STATUS == 'true' and $selection[$i]['id'] == 'cod')
	{
		echo '<div class="alert">'.TEXT_INFO_COD_FEES.'</div>';
	}
	else
	{}
	if($selection[$i]['id']!="cc")
	{
		echo $selection[$i]['module'];
	}
	echo zen_draw_hidden_field('payment', $selection[$i]['id']);
	//echo '<br class="clearBoth" />';
	if (isset($selection[$i]['error']))
	{
		echo '<div>'.$selection[$i]['error'].'</div>';
	}
	elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields']))
	{
		echo '<br class="clearBoth" />';
		echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		
		for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++)
		{
			echo '<tr>';
			echo '<td width="150px"><label '.(isset($selection[$i]['fields'][$j]['tag']) ? 'for="'.$selection[$i]['fields'][$j]['tag'] . '" ' : '').'>'.$selection[$i]['fields'][$j]['title'].'</label></td>
			<td>'.$selection[$i]['fields'][$j]['field'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	echo '<input type="hidden" name="order_no" value="'.$_SESSION['order_number_created'].'">';
	echo '<br class="clearBoth" />';
	echo $btn_submit;
	echo '</form>';
	echo '</div>';
	
	$radio_buttons++;
}
echo '</div>';
$order->send_order_email($insert_id, 2);
?>
</div>
<!-- </fieldset> -->
</div>
<?php
 }else {
?><input type="hidden" name="payment" value="<?php echo $_SESSION['payment']; ?>" /><?php
}
?>
<!-- new payment eof -->
<!-- new comments --></td>
  </tr>
<!--  <tr>
    <td colspan="4" style="padding:10px;"><?php //echo TEXT_ORDER_DES;?></td>
  </tr>-->

</table>