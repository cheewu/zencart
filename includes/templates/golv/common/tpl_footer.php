<?php
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>
<div id="footer">
<div class="qbfooter">
	 <div class="footwz">
<?php echo LOCAL_FOOT_TEXT;?>
   </div>
   
    <div class="information">
      <div class="footcontent">
         <ul>
		<li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'; ?><?php echo HEADER_TITLE_CATALOG; ?></a>
		<?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
		| <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>conditions.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_CONDITIONS;?></a>
        | <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>shippinginfo.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_SHIPPINGINFO;?></a>
        | <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>privacy.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_PRIVACY;?></a>
        | <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>contact_us.html" rel="nofollow"><?php echo TPL_EZPAGES_BAR_FOOTER_CONTACT_US;?></a>
        | <?php echo rss_feed_link(RSS_ICON); ?>
		<?php } ?>
        </li>
               <li><img src="<?=$zen->urlTplImg('foot_02.gif')?>" width="599" height="29" /></li>
               <li><span><?php echo FOOTER_TEXT_BODY;?></span>
            </li>
         </ul>
      </div>
    </div>
    </div>
</div>


<!--eof-navigation display -->

<!-- BEGIN ProvideSupport.com Visitor Monitoring Code -->
<div id="cil8Fi" style="z-index:100;position:absolute"></div><div id="sdl8Fi" style="display:none"></div><script type="text/javascript">var sel8Fi=document.createElement("script");sel8Fi.type="text/javascript";var sel8Fis=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/letsogogo/safe-monitor.js?ps_h=l8Fi&ps_t="+new Date().getTime();setTimeout("sel8Fi.src=sel8Fis;document.getElementById('sdl8Fi').appendChild(sel8Fi)",1)</script><noscript><div style="display:inline"><a href="http://www.providesupport.com?monitor=letsogogo"><img src="http://image.providesupport.com/image/letsogogo.gif" border="0"></a></div></noscript>
<!-- END ProvideSupport.com Visitor Monitoring Code -->
