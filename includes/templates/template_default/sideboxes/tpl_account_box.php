<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.<br />
 * Displays previous orders and options to change various Customer Account settings
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_default.php 4086 2006-08-07 02:06:18Z ajeh $
 */
?>

<!-- 
<div class="chat_live">
<img onclick="trackingChat();lpButtonCTTUrl =
'http://server.iad.liveperson.net/hc/2383438/?cmd=file&file=visitorWantsToChat&site=2383438&imageUrl=http://server.iad.liveperson.net/hcp/Gallery/ChatButton-Gallery/English/General/1a&referrer='+escape(document.location);
lpButtonCTTUrl = (typeof(lpAppendVisitorCookies) != 'undefined' ?
lpAppendVisitorCookies(lpButtonCTTUrl) : lpButtonCTTUrl);
window.open(lpButtonCTTUrl,'chat2383438','width=475,height=400,resizable=yes');close_chat_div();return
false;" src="<?php
echo $template->get_template_dir('chat.gif',DIR_WS_TEMPLATE, $current_page_base,'images') . '/chat.gif';?>" class="margin_t hand"/>
</div>
-->

<div id="accountLinksWrapper" class="back" style="margin-left:0px;">
<h2><?php echo MY_ACCOUNT_TITLE; ?></h2>
<ul id="myAccountGen" class="list" style="padding:0px; margin:0px;">
<li><img src="/images/a-zoom.png" height="12" width="12" /> 
<?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . MY_ACCOUNT_ORDERS_TITLE . '</a>'; ?></li>
<li><img src="/images/a-config.png" height="12" width="12" /> 
<?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?></li>
<li><img src="/images/a-billing.png" height="12" width="12" /> 
<?php echo ' <a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?></li>
<li><img src="/images/a-lock.png" height="12" width="12" /> 
<?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></li>
<li><img src="/images/a-comment.png" height="12" width="12" /> 
<?php echo ' <a href="' . zen_href_link(FILENAME_X_TELL_A_FRIEND, '', 'SSL') . '">' . MY_X_TELL_A_FRIEND . '</a>'; ?></li>
<li><img src="/images/a-friends.png" height="12" width="12" /> 
<?php echo ' <a href="' . zen_href_link(FILENAME_IRECOMMEND, '', 'SSL') . '">' . MY_I_RECOMMEND . '</a>'; ?></li>
</ul>


<?php
 /* if (SHOW_NEWSLETTER_UNSUBSCRIBE_LINK !='false' or CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS !='0') {
?>
<h2><?php echo EMAIL_NOTIFICATIONS_TITLE; ?></h2>
<ul id="myAccountNotify" class="list">
<?php
  if (SHOW_NEWSLETTER_UNSUBSCRIBE_LINK=='true') {
?>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?></li>
<?php } //endif newsletter unsubscribe ?>
<?php
  if (CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS == '1') {
?>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?></li>

<?php } //endif product notification ?>
</ul>

<?php //} */// endif don't show unsubscribe or notification ?>
</div>
<div class="need_help">
	<h3 class="in_1em line_30px">Need help</h3>
		<span class="pad_10px pad_t block">If you have questions or need help with your account, you may <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>contact_us.html" class="u">contact us</a> to assist you.	</span>
</div>