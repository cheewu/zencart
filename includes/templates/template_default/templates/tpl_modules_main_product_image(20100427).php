<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_main_product_image.php 3208 2006-03-19 16:48:57Z birdbrain $
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));?>

<div id="productMainImage" class="centeredContent back">
<div id="ZoomSpin" style="position: absolute; visibility: hidden; z-index: 11525; left: 345px; top: 184px;"><?php echo zen_image($template->get_template_dir('loading.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/loading.gif','','','','id="SpinImage"')?></div>
<div id="ZoomBox" style="position: absolute;visibility: hidden; z-index: 11499;">
  <div id="ZoomClose" style="position: absolute; right: 11px; top: 5px; visibility: hidden;"><?php echo zen_image($template->get_template_dir('close.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/close.gif','','13','13','border="0" style="cursor: pointer;"');?></div>
  <!--[if lte IE 6.5]><IFRAME src="blank.htm"></IFRAME><![endif]-->
</div>
<div class="clear"></div>
  <!-- BOF Product Flash-->
<div id="product_flash" style="width:335px; text-align:center;" class="fl margin_t">
<?php
if(is_array($products_image_medium)){
  ?>
   <ul>
   <li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . $products_image_large[0]. '" class="ih" id="product_flash_show" target="_blank">' . zen_image_OLD($products_image_medium[0], addslashes($products_name), '300', '300','id="product_flash_show_i" class="relative_img"') . '</a>'; ?>
   </li>
   </ul>
   <ul>
      <span class="p_f_en"> <a href="<?php echo zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']); ?>" id="product_flash_show_a" onclick="return popupwin(this.href,'popup_image',500,500,'resizable=0,scrollbars=0,toolbar=0,status=0')"><?php echo TABLE_PRODUCT_VIEW_LARGER_IMAGE;?></a> </span>
    </ul>
    <ul id="product_flash_btn">
  <?php
 
  $products_image_mediumNum = count($products_image_medium);
  for($i = 10000 ;$i <$products_image_mediumNum;$i++){  //---使他不显示小图片
  	 if($i+1 == $products_image_mediumNum){
  ?>
      <li class=""><img src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_small[$i]; ?>" border="0"  title="<?php echo $products_name;?>" alt="<?php echo $products_image_large[$i];?>" width="42" height="42" num="<?php echo $i;?>" imgSize="280" big="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_medium[$i]; ?>"/></li>
      
  <?php
     }else{?>
      <li class="border_r"><img src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_small[$i]; ?>" border="0"  title="<?php echo $products_name;?>" alt="<?php echo $products_image_large[$i];?>" width="42" height="42" num="<?php echo $i;?>" imgSize="280" big="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $products_image_medium[$i]; ?>"/></li>
     <?php }} ?>
    </ul>
    <script>initBtn('product_flash_btn','product_flash_show');setupZoom();</script>
<?php
  }else{
  ?>

   <ul>
   <li ><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . $products_image_large. '" class="ih" id="product_flash_show" target="_blank">' . zen_image_OLD($products_image_medium, addslashes($products_name), '280', '280','id="product_flash_show_i" class="relative"') . '</a>'; ?>
   </li>
  </ul>
  <ul>
  <span class="p_f_en">
  <script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '\\\')"><span>' . TEXT_CLICK_TO_ENLARGE . '</span></a>'; ?>');
//--></script>
<noscript>
<a href="<?php echo zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']); ?>" target="_blank"><?php echo TABLE_PRODUCT_VIEW_LARGER_IMAGE;?></a>
</noscript>
</span>
  </ul>
  <ul id="product_flash_btn">
    </ul>
  <script>initBtn('product_flash_btn','product_flash_show');setupZoom();</script>

<?php
  }
?>
  </div>
  <!-- EOF Product Flash-->
</div>
