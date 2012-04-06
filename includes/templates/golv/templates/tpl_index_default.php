<?
//载入首页要用的css,js
$zen->loadTplJs(array('jscript_imagehover.js','jscript_pheader.js','jscript_prototype.js'));
$zen->loadTplCss(array('style_imagehover.css'));
?>
<script language="javascript">
	//marquee(3000,70,0,'recentlyorder'); //新最推荐向上滚动
</script>
<div id="contright">
 	<div class="banner">
      <div id="swfContent"><? $zen->loadTplJs(array('tupian.js')); ?></div>
      <script language="javascript">
		var xmlData='<?php require($define_page);?>';
		var flashvars = {xmlData:xmlData};
		var params = {menu:false,wmode:"opaque"};
		var attributes = {};
		swfobject.embedSWF("<?=$zen->urlTplImg('javaimg.swf')?>", "swfContent", "770", "300", "9","<?=$zen->urlTplImg('expressInstall.swf')?>", flashvars, params, attributes);
      </script>
    </div>
    
    <div class="product">
      <h2>Prodotti in vetrina</h2>
      <div class="productlv">
      <? foreach($featured_products[0] as $fp){ ?>
      <div class="productimage">
       <img src="<?=M_PIC_DIR.$fp['products_image']?>" width="150" height="120"/>
        <div class="producttext"> 
        	<a href="<?=zen_href_link(zen_get_info_page($fp['products_id']), 'cPath=' . $productsInCategory[$fp['products_id']] . '&products_id=' . $fp['products_id'])?>"><?=$fp['products_name']?></a><br />
         	<?=zen_get_products_display_price($fp['products_id'])?>
        </div>
      </div>
      <? } ?>
      </div>

	  <div class="productlv">
      <? foreach($featured_products[1] as $fp){ ?>
      <div class="productimage">
       <img src="<?=M_PIC_DIR.$fp['products_image']?>" width="150" height="120"/>
        <div class="producttext"> 
        	<a href="<?=zen_href_link(zen_get_info_page($fp['products_id']), 'cPath=' . $productsInCategory[$fp['products_id']] . '&products_id=' . $fp['products_id'])?>"><?=$fp['products_name']?></a><br />
         	<?=zen_get_products_display_price($fp['products_id'])?>
        </div>
      </div>
      <? } ?>
      </div>

	  <div class="productlv">
      <? foreach($featured_products[2] as $fp){ ?>
      <div class="productimage">
       <img src="<?=M_PIC_DIR.$fp['products_image']?>" width="150" height="120"/>
        <div class="producttext"> 
        	<a href="<?=zen_href_link(zen_get_info_page($fp['products_id']), 'cPath=' . $productsInCategory[$fp['products_id']] . '&products_id=' . $fp['products_id'])?>"><?=$fp['products_name']?></a><br />
         	<?=zen_get_products_display_price($fp['products_id'])?>
        </div>
      </div>
      <? } ?>
      </div>
      
      <div class="productlv cpbottom">
      <? foreach($featured_products[3] as $fp){ ?>
      <div class="productimage">
       <img src="<?=M_PIC_DIR.$fp['products_image']?>" width="150" height="120"/>
        <div class="producttext"> 
        	<a href="<?=zen_href_link(zen_get_info_page($fp['products_id']), 'cPath=' . $productsInCategory[$fp['products_id']] . '&products_id=' . $fp['products_id'])?>"><?=$fp['products_name']?></a><br />
         	<?=zen_get_products_display_price($fp['products_id'])?>
        </div>
      </div>
      <? } ?>
      </div>  
    </div>
     
</div>

<?php
/*
?>
<div class="centerColumn" id="indexDefault">
<?php 
//------------delect html spam tag 06-23
//echo '<h1 id="indexDefaultHeading">';
//echo HEADING_TITLE;
//echo '</h1>';

if (SHOW_CUSTOMER_GREETING == 1) { ?>
<h2 class="greeting"><?php echo zen_customer_greeting(); ?></h2>
<?php }?>

<!-- deprecated - to use uncomment this section
<?php if (TEXT_MAIN) { ?>
<div id="" class="content"><?php echo TEXT_MAIN; ?></div>
<?php } ?>-->

<!-- deprecated - to use uncomment this section
<?php if (TEXT_INFORMATION) { ?>
<div id="" class="content"><?php echo TEXT_INFORMATION; ?></div>
<?php } ?>-->

<?php 
if (DEFINE_MAIN_PAGE_STATUS >= 1 and DEFINE_MAIN_PAGE_STATUS <= 2) { 
	//get the Define Main Page Text
?>
	<div id="indexDefaultMainContent" class="content"><?php require($define_page); ?></div>
<?php
}

$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MAIN);

while (!$show_display_category->EOF) {

	if($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS') {
		//display the Featured Products Center Box
		require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); 
	 }

	if($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS') {
		//display the Special Products Center Box
		require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); 
	} 

	 if($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS') {
		//display the New Products Center Box
		require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); 
	 }
	 
	 if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_UPCOMING'){
		//display the Upcoming Products Center Box
		include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS)); 
	 }
  	$show_display_category->MoveNext();
}// !EOF

?>

</div>

<script language="JavaScript">
var h1Title = '<div class="index_float_writting"><?php echo addslashes(INDEX_FLOAT_WRITTING);?></div>';
$("bannerThree").innerHTML=h1Title;
</script>
?>
