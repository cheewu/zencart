<?php
//载入商品信息页要用的css,js
$zen->loadTplCss(array('thickbox.css'));
$zen->loadTplJs(array('jquery.js','Tabmenu.js','thickbox.js'));
?>

<?php
//输出表单
echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product','NONSSL',true,true,false,true,false), 'post', 'enctype="multipart/form-data"');
if ($messageStack->size('product_info') > 0){ echo $messageStack->output('product_info'); }
?>
<div id="contright">
	  <div class="thingimgshow">
	  <div class="bigimg">
<?php if(zen_not_null($products_image)) { ?>
	<a href="<?php echo O_PIC_DIR.$products_image;?>" class="thickbox"><img src="<?php echo L_PIC_DIR.$products_image;?>" width="350"/></a>
	<h2><a href="<?php echo O_PIC_DIR.$products_image;?>" class="thickbox imgLink"><img src="<?php echo $zen->urlTplImg('dot.gif')."?".time();?>" width="102" height="21" /></a></h2>
<?php } ?>
		  </div>
		  <div class="thingtitle">
			  <h1><?=$products_name?></h1>
			  <ol>
			    <li>codice: <?=$products_model?></li>
                <!--
				<li>RRP: <span class="rrp">$399.00</span></li>
                -->
				<li>Prezzo di Vendita : <span class="prezzo"><?=((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id'])?></span></li>
			  </ol>
			   <ol class="product_choose">
			    <li class="product_bold">Aggiungi al Carrello:</li>
				<li>Da inserire: &nbsp;&nbsp;&nbsp;
					<input type="text" size="4" maxlength="6" value="1" style="width:50px;" name="cart_quantity" /><br />
					<input type="hidden" value="<?=(int)$_GET['products_id']?>" name="products_id">
				<input type="image" class="addtocart" src="<?=$zen->urlTplImg('btn_add_to_cart.gif')?>" title=" Add to Cart "/></li>
                <li>
<!--bof Tell a Friend button -->
<?php if ($flag_show_product_info_tell_a_friend == 1) { ?>
<div class="TellFriends">
<div class="TellFriendsEmail">
<?php echo ($flag_show_product_info_tell_a_friend == 1 ? '<a href="' . zen_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $_GET['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_TELLAFRIEND, BUTTON_TELLAFRIEND_ALT) . '</a>' : ''); ?> 
</div>
<!-- AddThis Button BEGIN  edit by Andy 06-18-->
<div class="addthis_toolbox addthis_default_style" style="float:left;">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=fangnet" class="addthis_button_compact">Share</a>
<span class="addthis_separator">|</span>
<a class="addthis_button_facebook"></a>
<a class="addthis_button_myspace"></a>
<a class="addthis_button_google"></a>
<a class="addthis_button_twitter"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=fangnet"></script>
<!-- AddThis Button END -->
<br class="clear" />
</div>
<?php
  }
?>
<!--eof Tell a Friend button -->
                
                </li>
			  </ol>
			  
	      </div>
	  </div>
	  <div class="option_js">
      	 
         <div id="tabmen1" class="tabmenu">
         <div class="option_nav">
          <ul>
           <li class="iobor"><a href="javascript:viod(0)" onclick="tabmenu(1)">Description</a></li>
           <!--
           <li class="noborder">&nbsp;</li>
           <li><a href="javascript:viod(0)" onclick="tabmenu(2)">Specification</a></li>
           <li class="noborder">&nbsp;</li>
           <li><a href="javascript:viod(0)" onclick="tabmenu(3)">Reviews</a></li>
           -->
           <li class="noborders" style="width:682px;">&nbsp;</li>
          </ul>
         </div>
         <div class="option_con">
          <div class="optioncona">
          <?=stripslashes(ereg_replace('src="images/', 'src="'.PIC_DIR."large/", $products_description))?>
<?php
    //------------------------------------------------ add 2010 6 11 这里加入额外的图片 -------------------------------------------//
  $products_extra_images_sql = "select * from products_image where products_id = " . $_GET['products_id'] . " order by products_image_sort";
  $products_extra_images = $db->Execute($products_extra_images_sql);
  $products_extra_image = '';
  while(!$products_extra_images->EOF){
      $products_extra_image .= '<p><img src="' . O_PIC_DIR . $products_extra_images->fields['products_image'] . '" title="' . addslashes($products_name) . '" alt="' . addslashes($products_name) . '" width="500" hspace="1" vspace="1" border="0" /></p>';
      $products_extra_images->MoveNext();
  }
  //----------------------------------------------------- end 2010 6 11 ---------------------------------------------------------//
?>
        <?=stripslashes($products_extra_image)?>
        
        </div>
         </div>
         </div>
         <!--
         <div id="tabmen2" class="tabmenu" style="display:none;">
         <div class="option_nav">
          <ul>
           <li><a href="javascript:viod(0)" onclick="tabmenu(1)">Description</a></li>
           <li class="noborder">&nbsp;</li>
           <li class="iobor"><a href="javascript:viod(0)" onclick="tabmenu(2)">Specification</a></li>
           <li class="noborder">&nbsp;</li>
           <li><a href="javascript:viod(0)" onclick="tabmenu(3)">Reviews</a></li>
           <li class="nobordersa">&nbsp;</li>
          </ul>
         </div>
         <div class="option_con">
          <div class="optioncona"><b>General attributes </b><br />
        Style: Shoulder bags & Totes <br />
        Color: Brown <br />
        Gender: Women </div>
         </div>
         </div>
         <div id="tabmen3" class="tabmenu" style="display:none;">
         <div class="option_nav">
          <ul>
           <li><a href="javascript:viod(0)" onclick="tabmenu(1)">Description</a></li>
           <li class="noborder">&nbsp;</li>
           <li><a href="javascript:viod(0)" onclick="tabmenu(2)">Specification</a></li>
           <li class="noborder">&nbsp;</li>
           <li class="iobor"><a href="javascript:viod(0)" onclick="tabmenu(3)">Reviews</a></li>
           <li class="nobordersb">&nbsp;</li>
          </ul>
         </div>
         <div class="option_con">
          <div class="optioncona">Write a review <br />
        Be the first user to review this item.
        </div>
         </div>
       </div>
         -->
    </div>
    
<!-- Customers who bought this product also purchased...  -->
<?
if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS > 0 && MIN_DISPLAY_ALSO_PURCHASED > 0){
  $also_purchased_products = $db->Execute(sprintf(SQL_ALSO_PURCHASED, (int)$_GET['products_id'], (int)$_GET['products_id']));
  $num_products_ordered = $also_purchased_products->RecordCount();  
  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';
  // show only when 1 or more and equal to or greater than minimum set in admin
  if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED && $num_products_ordered > 0) {
    if ($num_products_ordered < SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
      $col_width = floor(100/$num_products_ordered);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS);
    }
	$app = array();
    while (!$also_purchased_products->EOF) {
      $also_purchased_products->fields['products_name'] = zen_get_products_name($also_purchased_products->fields['products_id']);
      $app[] = $also_purchased_products->fields;
	  $list_box_contents[$row][$col] = array(
	  'params' => 'class="centerBoxContentsAlsoPurch"' . ' ' . 'style="width:' . $col_width . '%;"',
      'text' => (($also_purchased_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'products_id=' . $also_purchased_products->fields['products_id']). '">' . zen_image(DIR_WS_IMAGES . $also_purchased_products->fields['products_image'], $also_purchased_products->fields['products_name'],42,42) . '</a><br />') . '<a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'products_id=' . $also_purchased_products->fields['products_id']) . '">' . $also_purchased_products->fields['products_name'] . '</a>');
      $col ++;
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS - 1)){
        $col = 0;
        $row ++;
      }
      $also_purchased_products->MoveNext();
    }
  }
  if ($also_purchased_products->RecordCount() > 0 && $also_purchased_products->RecordCount() >= MIN_DISPLAY_ALSO_PURCHASED) {
    $title = '<h2 class="centerBoxHeading">' . TEXT_ALSO_PURCHASED_PRODUCTS . '</h2>';
    $zc_show_also_purchased = true;
  }
}
if ($zc_show_also_purchased == true) { ?>    
	  <div class="product">
		  <h2>You May Also Like These Products</h2>
		  <div class="productlv">
          <? foreach($app as $p){ 
		  		$_url = zen_href_link(zen_get_info_page($p['products_id']),'products_id='.$p['products_id']);
		  ?>
		  <div class="productimage"> <a href="<?=$_url?>"><img src="<?=DIR_WS_IMAGES.$p['products_image']?>" width="150" height="145"/></a>
			<div class="producttext"> <a href="<?=$_url?>"><?=$p['products_name']?></a><br />
			 <!--€173.99--></div>
	      </div>
		  <? } ?>
		  </div>
		  
	    </div>
<? } ?>
  
	 </div>
</form>