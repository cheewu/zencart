<?php 
include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));

if($linkMark = strpos($_SERVER['REQUEST_URI'],'?')){
	$cleanUrl = substr($_SERVER['REQUEST_URI'],0,$linkMark);
}else{
	$cleanUrl = $_SERVER['REQUEST_URI'];
}

/*
function cleanSameArg($clean)
{
	global $_GET,$cleanUrl;
	$newArg = array();
	reset($_GET);
	while (list($key, $value) = each($_GET)) {
		if($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean){
			$newArg[] = $key.'='.$value;				
		}
	}
	if(sizeof($newArg)>0){
		return $cleanUrl.'?'.implode('&',$newArg);
	}else{
		return $cleanUrl;
	}
}

function postfixUrl(){
	global $_SERVER;
	$posbool = strpos($_SERVER['REQUEST_URI'],'?');
	return (is_int($posbool) ? substr($_SERVER['REQUEST_URI'],$posbool) : '');
}
*/
if(!function_exists("stripos")){
  function stripos($str,$needle)
  {
	return strpos(strtolower($str),strtolower($needle));
  }
}

//处理商品数据
$plist = array();
foreach($listing->result as $p){
	$p['products_image'] = M_PIC_DIR.$p['products_image'];
	$p['products_description'] = str::left(strip_tags($p['products_description']),200);
	$p['url'] = zen_href_link(zen_get_info_page($p['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id']) > 0 ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $p['products_id']);
	$plist[] = $p;
}

//原数据:  $listing
//组装后的数据: $list_box_contents
//php::end($plist);

//计算当前页是第几条记录开始:
$start_num = ($listing_split->current_page_number-1)*$listing_split->number_of_rows_per_page+1;
//计算当前页是第几条记录结束:
$_end_num = ($listing_split->current_page_number*$listing_split->number_of_rows_per_page);
$end_num = $_end_num > $listing_split->number_of_rows ? $listing_split->number_of_rows : $_end_num;

if(1){ 

?>

<div id="rightcentent">

<div id="contright">
   <div class="listcont">
     <h1><?php echo $breadcrumb->last(); ?></h1>
	 <div class="list_bj">
     <div class="productslisting">
         Visualizzati da 
         <strong><?php echo $start_num; ?></strong>
          a <strong><?php echo $end_num;?></strong> 
          (di <strong><?php echo $listing_split->number_of_rows;?></strong> articoli)
     </div>
     <div class="productslinks">
    <!-- 分页,上面 -->
     <?php if( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ){
	 	echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y')));
	 } ?>
     </div></div>
    </div> 
    <div class="productform">
    <?php if(($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))){ ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="cpform">
        
        <?php
			$i=0;
		foreach($plist as $p){
			$i++;
		?>
		<tr>
              <td width="20%" class="framework<?php echo $i==count($plist)?' workno':'';?>"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="center"><a href="<?php echo $p['url'];?>"><img src="<?php echo $p['products_image'];?>" width="120" height="120" /></a></div></td>
                </tr>
                <tr>
                  <td><div align="center"><a href="<?php echo $p['url'];?>"><img src="<?php echo $zen->urlTplImg('am.jpg');?>" width="77" height="17" /></a></div></td>
                </tr>
              </table></td>
              <td width="50%" class="framework<?php echo $i==count($plist)?' workno':'';?>" valign="top"><h2><a href="<?php echo $p['url'];?>"><?php echo $p['products_name']; ?></a></h2>
			  <div class="listwz">Dimensioni (LxHxP): <?php echo $p['products_description'];?>....</div></td>
              <td width="23%" class="framework<?php echo $i==count($plist)?' workno':'';?>" valign="top"><table width="100%" height="108" border="0" cellpadding="0" cellspacing="0">
                <tr class="cross">
                  <td height="35"><div align="right">Prezzo di Vendita : <?php echo $currencies->display_price($p['products_price'],zen_get_tax_rate($products_tax_class_id)); ?>
                  </div></td>
                </tr>
                <tr class="yanse">
                  <td height="24"><div align="right">Prezzo di Vendita : <?php echo $currencies->display_price($p['products_price'],zen_get_tax_rate($products_tax_class_id)); ?></div></td>
                </tr>
                <tr class="addto">
                  <td height="49"><div align="right"><img src="<?php echo $zen->urlTplImg('cart.jpg');?>" width="27" height="23" /><a href="<?php echo zen_href_link(zen_get_info_page($p['products_id']),'cPath='.zen_get_generated_category_path_rev($_GET['cPath']).'&products_id='.$p['products_id'].'&action=buy_now');?>">Add to cart</a></div></td>
                </tr>
              </table></td>
            </tr>

       <?php } ?>
        
      </table>
    <?php }else{
		echo '<div class="error_box maxwidth" style="width:500px;">In categories no products</div>';
	} ?>
     <div class="list_bj">
         <div class="productslisting">
             Visualizzati da 
             <strong><?php echo $start_num;?></strong>
              a <strong><?php echo $end_num;?></strong> 
              (di <strong><?php echo $listing_split->number_of_rows;?></strong> articoli)
         </div>
     <div class="productslinks">
     <!-- 分页,下面 -->
     <?php if( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ){
	 	echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y')));
	 } ?> 
     </div>
    </div>
    
</div>
</div>
 </div>
<?php } ?>

