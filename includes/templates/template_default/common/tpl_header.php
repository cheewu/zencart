<?php
/**
 * Common Template - tpl_header.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_header.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_header = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_header.php 4813 2006-10-23 02:13:53Z drbyte $
 */
?>
<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {
}
?>
<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>
<div id="headerWrapper">
<div id="list">
    <ul>
    <li><span class="bag"><?php echo BOX_HEADING_SHOPPING_CART;?></span><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL'); ?>" class="mycart"  rel="nofollow"><span><?php echo $_SESSION['cart']->count_contents() . ' ' . CART_ITEMS_CN;?></span></a><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_CHECKOUT; ?></a>
    </li>
    <li>
        <?php TEXT_WELCOME;?><?php if ($_SESSION['customer_id']) { ?>
    <img src="/images/registe-in.gif" />
         <?php echo $_SESSION['customer_first_name']; ?>
        <a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
    <img src="/images/logout.gif"  />
    <a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_LOGOFF; ?></a>
                <?php
                        } else {
                            if (STORE_STATUS == '0') {
                    ?>
            <img src="/images/account-in.gif" />       
            <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_LOGIN; ?></a> <?php echo TEXT_OR;?> 
            <img src="/images/registe-in.gif"  />
            <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"  rel="nofollow"><?php echo TEXT_REGISTER;?></a>
                    <?php } } ?>
     </li> 
     <li><?php require(DIR_WS_MODULES . 'sideboxes/languages_header.php'); ?></li>
    </ul>
</div>
<!--bof-navigation display-->
<!--eof-navigation display-->
<!--bof-branding display-->
<div id="logoWrapper">
    <div id="logo">
	<?php echo '<h1><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" title="'.HEADER_ALT_TEXT.'">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a></h1>'; ?>
    </div>
    
    
<?php if (HEADER_SALES_TEXT != '' || (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2))) { ?>
    <div id="taglineWrapper">
<?php
              if (HEADER_SALES_TEXT != '') {
?>
<?php
              }
?>
<?php
              if (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2)) {
                if ($banner->RecordCount() > 0) {
?>
      <div id="bannerTwo" class="banners"><?php echo zen_display_banner('static', $banner);?></div>
<?php
                }
              }
?>
    </div>
<?php } // no HEADER_SALES_TEXT or SHOW_BANNERS_GROUP_SET2 ?>
</div>
<div class="SearchFrom">
<?php //require(DIR_WS_MODULES . 'sideboxes/currencies_header.php'); ?>
<?php require(DIR_WS_MODULES . 'sideboxes/search_header.php'); ?>
</div>
<!--eof-branding display-->
<!--bof-navigation display-->
<div id="menu">
<ul>
<!--bof-header ezpage links-->
<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
<?php } ?>
<!--eof-header ezpage links-->
</ul>
<br class="clearBoth" />
</div>
<!--eof-navigation display-->
<!--eof-header logo and navigation display-->
<!--bof-optional categories tabs navigation display-->
<?php require($template->get_template_dir('tpl_modules_categories_tabs.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_categories_tabs.php');?>
<!--eof-optional categories tabs navigation display-->
</div>
<?php } 
?>