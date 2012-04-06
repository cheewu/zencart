<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: account_history_info.php 3027 2006-02-13 17:15:51Z drbyte $
 */

define('NAVBAR_TITLE', 'Order completed');
define('NAVBAR_TITLE_1', 'Order completed');
define('NAVBAR_TITLE_2', 'Order completed');
define('NAVBAR_TITLE_3', 'Order #%s');

define('HEADING_TITLE', 'Order Information');

define('HEADING_ORDER_NUMBER', 'Order #%s');
define('HEADING_ORDER_DATE', 'Order Date:');
define('HEADING_ORDER_TOTAL', 'Order Total:');
define('HEADING_ORDER_NUMBER_1', 'Order #:');
define('HEADING_ORDER_STATUS_1', 'Status :');
define('HEADING_ORDER_COMMENTS_1', 'Comments :');

define('HEADING_DELIVERY_ADDRESS', 'Delivery Address');
define('HEADING_SHIPPING_METHOD', 'Shipping Method');

define('HEADING_PRODUCTS', 'Products');
define('HEADING_TAX', 'Tax');
define('HEADING_TOTAL', 'Total');
define('HEADING_QUANTITY', 'Qty.');

define('HEADING_BILLING_ADDRESS', 'Billing Address');
define('HEADING_PAYMENT_METHOD', 'Payment Method');

define('HEADING_ORDER_HISTORY', 'Status History &amp; Comments');
define('TEXT_NO_COMMENTS_AVAILABLE', 'No comments available.');
define('TEXT_MISSING_SHIPPING', 'WARNING: Missing Shipping Information');
define('TEXT_PAY_WARNING', '<div class="pay_warning"><strong>NOTICE:&nbsp;</strong>The stauts of this order is still unpaid, please make payment asap.We\'ll ship your order out in <strong>48</strong> hours after your payment is confirmed.If you have chosen WesternUnion or PayPal to make payment,pleas find the detailed payment information in your emailbox.</div>');
define('TABLE_HEADING_STATUS_DATE', 'Date');
define('TABLE_HEADING_STATUS_ORDER_STATUS', 'Order Status');
define('TABLE_HEADING_STATUS_COMMENTS', 'Comments');
define('QUANTITY_SUFFIX', '&nbsp;ea.  ');
define('ORDER_HEADING_DIVIDER', '&nbsp;-&nbsp;');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');

define('ADDRESS_NAME','Name: ');
define('ADDRESS_STREET','Street Address: ');
define('ADDRESS_CITY','City: ');
define('ADDRESS_POSTCODE','Post/Zip Code: ');
define('ADDRESS_COUNTRY','Country: ');

define('HEADING_TITLE_1','Items');
define('TEXT_SELECT_PAYMENT_METHOD', 'Thanks for your purchase! Your Order Number <font color=red>%s</font> has been generated,total amount of the order is <font color=red>%s</font>,please click the button below to make the payment,and we\'ll send the order out using <font color=red>%s</font> when payment is confirmed.');
define('TEXT_ORDER_DES', "Thanks for your purchase! Your Order Number <span style='checkoutSuccessHeading_1_a'>%s</span> has been generated.goto account");

define('EMAIL_TEXT_SUBJECT', 'Order Confirmation');
define('EMAIL_TEXT_HEADER', 'Order Confirmation');
define('EMAIL_TEXT_FROM',' from ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','Thanks for shopping with us today!');
define('EMAIL_DETAILS_FOLLOW','The following are the details of your order.');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Click here for a Detailed Invoice');
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
define('EMAIL_TEXT_PRODUCTS', 'Products');
define('EMAIL_TEXT_SUBTOTAL', 'Sub-Total:');
define('EMAIL_TEXT_TAX', 'Tax:        ');
define('EMAIL_TEXT_SHIPPING', 'Shipping: ');
define('EMAIL_TEXT_TOTAL', 'Total:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
define('HEADING_ADDRESS_INFORMATION','Address Information');
define('HEADING_SHIPPING_METHOD','Shipping Method');


define('ORDERS_SUCCESSFUL_MESSAGE','Congratulations, Your order has been Successfully submitted.');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW','Don\'t close this window before payment finsihed\nPlease click different button accodrding your payment result:');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON1','Have trouble in payment');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_BOTTON2','Paid Successfuly');
define('ORDERS_SUCCESSFUL_FLOAT_WINDOW_EXTRA','Please finishe your payment in the new open page');
?>