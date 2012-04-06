<?php
/**
 * Page Template
 *
 * Displays EZ-Pages footer-bar content.<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_ezpages_bar_footer.php 4225 2006-08-24 01:42:49Z drbyte $
 */
   /**
   * require code to show EZ-Pages list
   */
  //include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_footer.php'));
?>
<?php
/*
if(sizeof($var_linksList) >= 1)
{
	for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++)
	{
		echo ($i <= $n ? EZPAGES_SEPARATOR_FOOTER : '') . "\n";
		echo '<a href="'.$var_linksList[$i]['link'].'">'.$var_linksList[$i]['name'].'</a>';
	}
}
*/
?>
| <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>conditions.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_CONDITIONS;?></a>
| <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>shippinginfo.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_SHIPPINGINFO;?></a>
| <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>privacy.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_PRIVACY;?></a>
| <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>contact_us.html" rel="nofollow">Contact Us</a>
| <?php echo rss_feed_link(RSS_ICON); ?>
