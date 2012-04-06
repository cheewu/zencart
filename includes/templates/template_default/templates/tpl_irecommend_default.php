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

<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="myaccountleft" valign="top">
<?php require($template->get_template_dir('tpl_account_box.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_account_box.php');?>
	</td>
    <td class="myaccountright" valign="top">
	<h1 id="accountDefaultHeading" style="padding:0px; margin:0px;"><?php echo HEADING_TITLE; ?></h1>
<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?><?php
if(count($ordersArray)>0)
{
?>
<br class="clearBoth" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="prevOrders">
    <tr class="tableHeading">
    <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo MY_RECOMMEND_USER; ?></th>
    <th scope="col"><?php echo MY_RECOMMEND_USER_DATE; ?></th>
    <th scope="col"><?php echo MY_RECOMMEND_USER_pay; ?></th>
  </tr>
<?php
  foreach($ordersArray as $key=>$orders) {
?>
  <tr align="left">
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $orders['customers']; ?></td>
    <td><?php echo $orders['customers_created']; ?></td>
    <td><?php echo $orders['order_total']; ?></td>

<?php
// only show when there is a GV balance
  if ($customer_has_gv_balance ) {
?>
<div id="sendSpendWrapper">
<?php //require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
</div>
<?php
  }
?>
	</td>
  </tr>

<?php
  }
?>
</table>
<div class="order_page"><?php echo TEXT_RESULT_PAGE . ' ' . $orders_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<?php
  } else  {
    echo '<br />' . NO_RECOMMEND_USER;
  }
  unset($ordersArray);
?></td>
  </tr>
</table>
</div>