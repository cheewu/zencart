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
<div style="padding-left: 40px;">
<?php
echo $pay_message . '<br>';
echo 'please wait...';
?>
</div>
<script type="text/javascript">
setTimeout("re_url()",5*1000);
function re_url(){
    location.href="<?php echo zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL');?>";
    }
</script>