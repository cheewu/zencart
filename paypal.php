<?php
/**
 * Page Template
 *
 * Display information related to GV redemption (could be redemption details, or an error message)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_gv_redeem_default.php 4155 2006-08-16 17:14:52Z ajeh $
 */
?>
<?php
require('includes/application_top.php');
//$cmd = $_GET['cmd'];
$business = $_GET['business'];
$amount = $_GET['amount']; 
$item_name = $_GET['item_name'];
$currency_code = $_GET['currency_code'];
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$address1 = $_GET['address1'];
$city = $_GET['city'];
$state = $_GET['state'];
$zip = $_GET['zip'];
$country = $_GET['country'];
$email = $_GET['email'];
$address2 = $_GET['address2'];
$H_PhoneNumber = $_GET['H_PhoneNumber'];
$night_phone_b = $_GET['night_phone_b'];
$day_phone_b = $_GET['day_phone_b'];
if($business == '') {
    //zen_redirect(zen_href_link('index'));
}

$handle = fopen('paypal.txt','ab');
$content = "Email: " . $email . "   Order: " . $item_name . "   From: " . $_SERVER['HTTP_REFERER'] . "\r\n";
fwrite($handle , $content);
fclose($handle);
?>

<script type="text/javascript">
var browserName=navigator.appName; // Get the Browser Name 
	/* if(browserName=="Microsoft Internet Explorer") // For IE 
	{  
		window.onload=submitform; // Call init function in IE 
	} 
	else 
	{  
		if (document.addEventListener) // For Firefox 
		{ 
		#	document.addEventListener("DOMContentLoaded", submitform, false); // Call init function in Firefox 
		} 
	} */
        //setTimeout("submitform()",1000);
	function submitform() { 
		//return;//testing
		document.checkout_confirmation.submit(); 
	}
</script>
<!-- <div align="center" width="400px" style="padding-top:200px;font-size:12px">
<img src="images/PayPal-payment.jpg"/><br/>
<h2 style="font-weight:bold;font-size:16px;display:inline;color:#FFA000">Your Payment is now processing...</h2>
<br/>Now is connecting PayPal to finish the payment,please do not close the window.<br/>
<br/><img src="images/065.gif"/><br/>
</div> -->

<form name="checkout_confirmation" action="https://www.paypal.com/cgi-bin/webscr" method="get" target="_blank">
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="business" value="<?php echo $business;?>" />
<input type="hidden" name="amount" value="<?php echo $amount;?>" />
<input type="hidden" name="item_name" value="<?php echo $item_name;?>" />
<input type="hidden" name="currency_code" value="<?php echo $currency_code;?>" />
<input type="hidden" name="first_name" value="<?php echo $first_name;?>" />
<input type="hidden" name="last_name" value="<?php echo $last_name;?>" />
<input type="hidden" name="address1" value="<?php echo $address1;?>" />
<input type="hidden" name="city" value="<?php echo $city;?>" />
<input type="hidden" name="state" value="<?php echo $state;?>" />
<input type="hidden" name="zip" value="<?php echo $zip;?>" />
<input type="hidden" name="country" value="<?php echo $country;?>" />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<input type="hidden" name="address2" value="<?php echo $address2;?>" />
<input type="hidden" name="H_PhoneNumber" value="<?php echo $H_PhoneNumber;?>" />
<input type="hidden" name="night_phone_b" value="<?php echo $night_phone_b;?>" />
<input type="hidden" name="day_phone_b" value="<?php echo $day_phone_b;?>" />
<!-- <br/><input type="submit" value="submit" style="display:none;" /> -->
<input type="image" name="btn_submit" src="images/btn_end_check.gif" />
<!-- <input type="submit" value="payment"/> -->
</form>

</div>
