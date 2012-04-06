<?php
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<?php
if (!isset($flag_disable_footer) || !$flag_disable_footer) {
?>
<!--bof-navigation display -->
<div id="navSuppWrapper">
<div id="navSupp">
	<div id="bottomNav" style="margin-top:10px;">

		<ul>
		<li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'; ?><?php echo HEADER_TITLE_CATALOG; ?></a></li>
		<?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
		<li><?php require($template->get_template_dir('tpl_ezpages_bar_footer.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_footer.php'); ?></li>
		<?php } ?>
		</ul>
<!--bof-ip address display -->
<?php
if (SHOW_FOOTER_IP == '1') {
?>
<div id="siteinfoIP"><?php echo TEXT_YOUR_IP_ADDRESS . '  ' . $_SERVER['REMOTE_ADDR']; ?></div>
<?php
}
?>
<!--eof-ip address display -->
 
<?php 
// Andy by 6-16 Editing code
//echo rss_feed_link(RSS_ICON); 
?>
<!--</div>-->
<!--eof- site copyright display -->
<!--bof-banner #5 display -->
<?php
if (SHOW_BANNERS_GROUP_SET5 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET5))
{
	if ($banner->RecordCount() > 0) 
	{
?>
	<div id="bannerFive" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
	}
}
?>
<!--eof-banner #5 display -->
	</div>
</div><br class="clearBoth" />
</div>
<div style="display:none">
<!--GA-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15679614-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--GA-->
<!--CNZZ-->
<!--<script src="http://s11.cnzz.com/stat.php?id=2089347&web_id=2089347" language="JavaScript"></script>-->
<!--CNZZ-->
</div>

<!--eof-navigation display -->

<!-- BEGIN ProvideSupport.com Visitor Monitoring Code -->
<div id="cil8Fi" style="z-index:100;position:absolute"></div><div id="sdl8Fi" style="display:none"></div><script type="text/javascript">var sel8Fi=document.createElement("script");sel8Fi.type="text/javascript";var sel8Fis=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/letsogogo/safe-monitor.js?ps_h=l8Fi&ps_t="+new Date().getTime();setTimeout("sel8Fi.src=sel8Fis;document.getElementById('sdl8Fi').appendChild(sel8Fi)",1)</script><noscript><div style="display:inline"><a href="http://www.providesupport.com?monitor=letsogogo"><img src="http://image.providesupport.com/image/letsogogo.gif" border="0"></a></div></noscript>
<!-- END ProvideSupport.com Visitor Monitoring Code -->

<?php
} // flag_disable_footer
?>