<div id="header">
     <div class="logo"><a href="http://www.borseonsale.com/"><img src="<?=$zen->urlTplImg('logo.gif')?>" width="350" height="71" /></a></div>
	 <div class="headright">
	  <div class="cart">
      <span class="bag">Carrello</span> 
          <a href="/index.php?main_page=shopping_cart" class="mycart"><span><?=$_SESSION['cart']->count_contents()?> merce</span></a> &nbsp; | &nbsp; 
          <a href="/index.php?main_page=checkout_shipping">Conferma Ordine</a>
      </div>
	  <div class="links">
	    <ul>
          <?php if ($_SESSION['customer_id']) { ?>
          <li><?php echo $_SESSION['customer_first_name']; ?>&nbsp;</li>
          <li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a></li>
          <li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
          <?php
            } else {
          if (STORE_STATUS == '0') {
          ?>
          <li>&nbsp;</li>
          <li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"  rel="nofollow"><?php echo HEADER_TITLE_LOGIN; ?></a> <?php echo TEXT_OR;?></li> 
          <li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"  rel="nofollow"><?php echo TEXT_REGISTER;?></a></li>
          <?php } } ?>


		</ul>
      </div>
	 </div>
	 <div class="mainbav">
	 <div class="main_one"><img src="<?=$zen->urlTplImg('nav_01.gif')?>" width="10" height="36" /></div>
     <div class="main_two">
	   <ul>
       <!--bof-header ezpage links-->
<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
<?php } ?>
<!--eof-header ezpage links-->
<!--
		<li><a href="<?=DIR_WS_CATALOG?>">Casa</a></li>
		<li><a href="<?=$zen->urlLink(FILENAME_PRODUCTS_NEW)?>">Nuovi Prodotti</a></li>
		<li><a href="<?=$zen->urlLink(FILENAME_FEATURED_PRODUCTS)?>">Prodotti in vetrina</a></li>
		<li><a href="<?=$zen->urlLink(FILENAME_CONTACT_US)?>">Contattaci</a></li>
		<li><a href="<?=$zen->urlLink(FILENAME_EZPAGES,'id=14')?>">Domande frequenti</a></li>
		<li><a href="<?=$zen->urlLink('tags')?>">Tags</a></li>-->
	  </ul>
	 <div class="search">
        <form method="get" action="/index.php?main_page=advanced_search_result" name="quick_find_header">
            <input type="hidden" value="advanced_search_result" name="main_page">
            <input type="hidden" value="1" name="search_in_description">
            <?=zen_hide_session_id()?>
            <span><input name="keyword" maxlength="30" size="6" type="text" class="wenben" onblur="if (this.value == '') this.value = '';" onfocus="if (this.value == '') this.value = '';"/></span>
            <input type="image" src="<?=$zen->urlTplImg('button_search.gif')?>" />
		</form>
		</div>
	 </div>
	 <div class="main_three"><img src="<?=$zen->urlTplImg('nav_03.gif')?>" /></div>
	 </div>
   </div>
   
   <!-- 网站路径栏 -->
	<? if(DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page &&!$this_is_confirm_page)){?>
    <div class="navbreadcrumb"><?=$breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
	<? } ?>
