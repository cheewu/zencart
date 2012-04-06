<?php
require_once("includes/application_top.php");
require_once(DIR_WS_CLASSES . 'order.php');
require_once(DIR_WS_CLASSES . 'payment.php');
if($_GET['order_no'] && preg_match("/^[0-9]+$/",$_GET['order_no']))
{
	$order = new order($_GET['order_no']);
	$payment_modules = new payment();
	$payment_modules -> paymentr();
	//print_r($payment_modules);
	$selection = $payment_modules->selection();
	//print_r($selection);
	if (!$payment_modules->in_special_checkout())
	{
		$selection = $payment_modules->selection();
		//print_r($selection);
	}
	foreach($selection as $value)
	{
		$payment_method[$value['id']]=$value['title'];
	}
	$_SESSION["create_order_no"]=$_GET['order_no'];
	if($order->info['orders_status']!=1)
	{
		echo '<script type="text/javascript">';
		echo 'alert("Order has been paid");';
		echo 'window.location="/"';
		echo '</script>';
		
		exit;
	}
	//print_r($order);
}
else
{
	echo '<script type="text/javascript">';
	echo 'alert("error")';
	echo 'window.location="/"';
	echo '</script>';
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<style>
body{
	margin: 0 auto;
	font:12px Arial, Helvetica, sans-serif,"";
	color:#666;
	line-height:150%;
	background:#ffffff;
	padding:10px 0 0 0;
}
#create_orders{background: url(/includes/templates/template_default/images/bg_fieldset.jpg) repeat-x; }
#cc input{border:1px solid #7F9DB9;height:20px;width:200px;}
#cc select{border:1px solid #7F9DB9;/*height:20px;width:200px;*/}
#cc #btn_submit{width:225px;height:32px;border:0px;}

#tabMenu {margin:0px;padding:0px;list-style:none;clear:left;}
#tabMenu ul{height:32px;}
#tabMenu li {float:left;height:32px;margin:0px 3px;line-height:32px;cursor:pointer;font-size:12px;background-color:#EBEBEB;width:140px;text-align:center;}
.box {width:100%;}
.boxTop {background:url(images/boxTop.gif) no-repeat;height:11px;clear:both}
*html .boxTop {margin-bottom:-2px;}
.boxBody {background-color:#fff;border:1px solid #ccc;padding-top:5px;}
.boxBottom {background:url(images/boxBottom.gif) no-repeat;height:11px;}

.boxBody div {display:none;padding:5px;}
.boxBody div.show {display:block;}
.boxBody #category a {display:block;}
</style>
<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" style="margin:0px auto">
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
	  //var order_no=<?php echo $_SESSION["create_order_no"];?>;
	  /*$.post('index.php?main_page=create_orders',{paymentd:class_style,act:"insert_payment",orders_no:order_no},function(data)
		{
			if(data=='ok')
			{
				
			}
			else
			{
				alert('order is error');
			}
		});*/
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

<?php
if (!$payment_modules->in_special_checkout()) {
?>
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
<div style="font-size:16px;text-align:center; padding-top:8px; border-bottom:2px solid #25C1B3; padding-bottom:8px;">Order Payment</div>
<?php
} elseif (sizeof($selection) == 0) {
?>
<p class="important"><?php echo TEXT_NO_PAYMENT_OPTIONS_AVAILABLE; ?></p>
<?php
}
?>
<p style="padding:5px;">Order Information Thanks for your purchase! Your Order Number <font color=red><?php echo $_SESSION["create_order_no"];?></font> has been generated,total amount of the order is <font color=red><?php echo $order->totals[2]['text'];?></font>,please click the button below to make the payment,and we'll send the order out using <font color=red><?php echo $order->info['shipping_method']?></font> when payment is confirmed.</p>
<div class="box">
<?php

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
		}
	}
	else
	{
		echo '<li class="'.$selection[$i]['id'].'">'.$selection[$i]['title'].'</li>';
	}
	$radio_buttons++;
}
echo '</ul>';
//echo '<br class="clearBoth" />';
$radio_buttons = 0;
echo '<div class="boxBody">';
for ($i=0, $n=sizeof($selection); $i<$n; $i++)
{
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
		$btn_submit='<iframe src="'.$form_action_url.'" method="post" id="checkout_confirmation" height="50px" width="250px;" frameborder="0px" style="border:0px;" scrolling="no"></iframe>';
	}
	elseif($payment_d=='VisaMastercard')
	{
		$$payment_d->set_email_information();
		$target="_blank";
		$form_action_url=$$payment_d->form_action_url;
		$btn_submit='<iframe src="'.$form_action_url.'" method="post" id="checkout_confirmation" height="200px" width="500px;" frameborder="0px" style="border:0px;" scrolling="no"></iframe>';
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
	
	echo '<div id="'.$selection[$i]['id'].'"'.$selectclass.'>';
	echo zen_draw_form('checkout_pay_info', $form_action_url, 'post', 'id="checkout_pay_info" target="'.$target.'"');
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
?>
</div>
</div>
<?php
 }else {
?><input type="hidden" name="payment" value="<?php echo $_SESSION['payment']; ?>" /><?php
}
?></td>
  </tr>
</table>
</body>
</html>
