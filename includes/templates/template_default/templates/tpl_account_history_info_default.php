<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * Displays information related to a single specific order
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_info_default.php 6247 2007-04-21 21:34:47Z wilt $
 */
?>
<?php if ($messageStack->size('paydollarf') > 0) echo $messageStack->output('paydollarf'); ?>
<?php if ($messageStack->size('paydollare') > 0) echo $messageStack->output('paydollare'); ?>
<div class="centerColumn" id="accountHistInfo">

<!--<div class="forward"><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></div>-->
<br class="clearBoth" />
<!-- order infomation -->
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="myAccountOrdersStatus" summary="Table contains the date, order status and any comments regarding the order">
<caption><h2 id="orderHistoryStatus"><?php echo HEADING_TITLE . ORDER_HEADING_DIVIDER . sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']); ?></h2></caption>
<tr><td>
<br />
<?php
$status_current = is_array($statusArray)?end($statusArray):$statusArray;
echo '<strong>' . HEADING_ORDER_DATE . '&nbsp;</strong>' . zen_date_long($order->info['date_purchased']) . '<br />';
echo '<strong>' . HEADING_ORDER_NUMBER_1 . ':&nbsp;</strong>' . $_GET['order_id'] . '<br />';
echo '<strong>' . HEADING_ORDER_TOTAL . '&nbsp;</strong>' . $currencies->format($order->info['total'], true, $order->info['currency'], $order->info['currency_value']) . '<br>';
?>
</td>
</tr>
</table>
<br />



<?php
/**
 * Used to display any downloads associated with the cutomers account
 */
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>


<?php
/**
 * Used to loop thru and display order status information
 */
if (sizeof($statusArray)) {    //不再显示
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" id="myAccountOrdersStatus" summary="Table contains the date, order status and any comments regarding the order">
<caption><h2 id="orderHistoryStatus"><?php echo HEADING_ORDER_HISTORY; ?></h2></caption>
    <tr class="tableHeading">
        <th scope="col" id="myAccountStatusDate">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo TABLE_HEADING_STATUS_DATE; ?></th>
        <th scope="col" id="myAccountStatus"><?php echo TABLE_HEADING_STATUS_ORDER_STATUS; ?></th>
        <th scope="col" id="myAccountStatusComments"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
       </tr>
<?php
  foreach ($statusArray as $statuses) {
?>
    <tr align="left">
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo zen_date_short($statuses['date_added']); ?></td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo $statuses['orders_status_name']; ?></td>
        <td>&nbsp;&nbsp;&nbsp;<?php echo (empty($statuses['comments']) ? '&nbsp;' : nl2br(zen_output_string_protected($statuses['comments']))); ?></td>
     </tr>
<?php
    $order_status_dis = $statuses['orders_status_id'];
  }
?>
</table>
<br />
<?php } ?>

<div id="myAccountShipInfo" class="floatingBox back" style=" margin-left:0px;width:450px;">
<?php
  if ($order->delivery != false) {
?>
<h3><?php echo HEADING_DELIVERY_ADDRESS; ?></h3>
<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>
<?php
  }
?>

<?php
    if (zen_not_null($order->info['shipping_method'])) {
?>
<h4><?php echo HEADING_SHIPPING_METHOD; ?></h4>
<div><?php echo $order->info['shipping_method']; ?></div>
<?php } else { // temporary just remove these 4 lines ?>
<div><?php echo TEXT_MISSING_SHIPPING;?></div>
<?php
    }
?>
</div>

<div id="myAccountPaymentInfo" class="floatingBox forward">
<h3><?php echo HEADING_BILLING_ADDRESS; ?></h3>
<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></address>

<h4><?php echo HEADING_PAYMENT_METHOD; ?></h4>
<div><?php echo $order->info['payment_method']; ?></div>

</div>
<?php
//----------------------- 对于处于pending 状态的订单 才显示如下内容
if($status_current['orders_status_id'] == 1){
foreach($selection as $key => $value){
    
    //------------------------------ 这下面是生成的每个支付方式所需提交的表单 ---------------------------------------------//
    $current_payment_modules = new payment($value['id']);
    $current_payment_modules->process_button();
    $current_payment_modules->set_email_information();
    if($value['id'] == 'cc') {
        $target="_blank";
        $form_action_url = zen_href_link('checkout_payment_process', '', 'SSL');
    } else if(isset($$value['id']->form_action_url)) {
        $target="_blank";
        $form_action_url = $$value['id']->form_action_url;
    }
    else {
        $target="_self";
        $form_action_url = zen_href_link('account', '', 'SSL');
    }

    $pay_str .= "<div class='re_pay_btn'>".zen_draw_form('checkout_pay_info[]', $form_action_url, 'post', 'id="pay_' . $value['id'] . '" target="_blank" style="display:none;"');//------- 增加弹出窗口
    if (is_array($current_payment_modules->modules))
    {
        $pay_str .= $current_payment_modules->process_button();
    }
    $pay_str .= zen_draw_hidden_field('re_order_id', $_GET['order_id']);
    $pay_str .= zen_draw_hidden_field('payment_module', $value['id']);

    $pay_str .= zen_image_submit('btn_re_pay.gif', BUTTON_CONFIRM_ORDER_ALT, "name='btn_submit' id='btn_submit'")."</div></form>";
    //echo $$value['id']->form_action_url . '<br>';
    $select_payment[] = array('id' => $value['id'],
                                'text' => $$value['id']->title);
    //------------------------------------------ 支付方式 订单 eof ---------------------------------------------------------------------//
    }
      echo TEXT_PAY_WARNING;
    echo '<div class="pay_info_sel">' . zen_draw_pull_down_menu('re_payment',$select_payment,$order->info['payment_module_code'],'onchange="change_pay_info(this.value)"') . '</div>';
    echo $pay_str;

    }
    //------------------------------------------- 是否显示 eof ----------------------------------------------------------------//


?>

<br />
<table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Itemized listing of previous order, includes number ordered, items and prices">
<caption><h2 id="orderHistoryDetailedOrder"><?php echo HEADING_TITLE_1; ?>
<?php
  //------------------------------------------------ 这是将订单中的产品重新添加进购物车中的代码-----------------------------------//
  /*
  echo '<div class="re_add_order_cart">' . zen_draw_form('checkout_confirmation', zen_href_link('checkout_payment_process', '', 'SSL'), 'post', 'id="checkout_confirmation" onsubmit="submitonce();"');
  echo zen_draw_hidden_field("source", "view_orders");
  echo zen_draw_hidden_field("source_curr_order_id", $_GET['order_id']);
  echo zen_image_submit('btn_re_add_cart.gif', BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"') ;
  echo '</form></div>';*/
  //----------------------------------------------- 添加 over ------------------------------------------------------------------//
?>
</h2></caption>
    <tr class="tableHeading">
        <th scope="col" id="myAccountQuantity" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo HEADING_QUANTITY; ?></th>
        <th scope="col" id="myAccountProducts" align="left"><?php echo HEADING_PRODUCTS; ?></th>
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
        <th scope="col" id="myAccountTax"><?php echo HEADING_TAX; ?></th>
<?php
 }
?>
        <th scope="col" id="myAccountTotal"><?php echo HEADING_TOTAL; ?></th>
    </tr>
<?php
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    $linkProductsName = zen_href_link(zen_get_info_page($order->products[$i]['id']), 'products_id=' . $order->products[$i]['id']);
  ?>
    <tr align="left" style="height: 25px;">
        <td class="accountQuantityDisplay">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $order->products[$i]['qty'] . QUANTITY_SUFFIX; ?></td>
        <td class="accountProductDisplay"><a href="<?php echo $linkProductsName;?>"><?php echo  $order->products[$i]['name'] . '</a>';

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      echo '<ul id="orderAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<li>' . $order->products[$i]['attributes'][$j]['option'] . TEXT_OPTION_DIVIDER . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])) . '</li>';
      }
        echo '</ul>';
    }
?>
        </td>
<?php
    if (sizeof($order->info['tax_groups']) > 1) {
?>
        <td class="accountTaxDisplay"><?php echo zen_display_tax_value($order->products[$i]['tax']) . '%' ?></td>
<?php
    }
?>
        <td><?php echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') ?></td>
    </tr>
<?php
  }
?>
</table>
<hr />
<div id="orderTotals">
<?php
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
?>
     <div class="amount larger forward forward01"><?php echo $order->totals[$i]['title'] . $order->totals[$i]['text'] ?></div>
<br class="clearBoth" />
<?php
  }
?>

</div>

<br class="clearBoth" />
</div>
<script type="text/javascript">
function change_pay_info(pay){
    jQuery("form[name='checkout_pay_info[]']").hide();
    jQuery("#pay_"+pay).show();
    }
change_pay_info('<?php echo $order->info['payment_module_code'];?>');
</script>