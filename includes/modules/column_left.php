<?php
if($current_page_base=='product_info' || $current_page_base=='index'){ //
?>
<script type="text/javascript">
    <!--
    function Menu(obj,id) {
    var m_id = "menu_"+id;

}
-->
</script>
<div id="leftcontent">

	<!-- 商品分类 -->
	<div class="categories"> 
	  <h1>PRODOTTI <span>CATEGORIE</span></h1>
	  <div class="categories_left">
	   <div class="sidecontent">
       <div class="sub_categories">

		<h2 class="sub_title sub_js">Louis Vuitton</h2>
	<ul class="showmenu">
		<li class="suntitle_x">WOMEN</li>
		<li><a href="#">Borse</a> </li>
		<li><a href="#">Viaggio</a></li>
		<li><a href="#">Cinture &amp; Accessori</a></li>
		<li><a href="#">Borsa</a> </li>
		<li><a href="#">Portachiavi</a></li>
		<li><a href="#">Tessili</a></li>
		<li><a href="#">Ciondoli</a></li>
		<li class="suntitle_x">MEN</li>
		<li><a href="#">Borse Da Uomo</a> </li>
		<li><a href="#">Valigie</a></li>
		<li><a href="#">Portafogli</a></li>
		<li><a href="#">Belts</a> </li>
		<li class="suntitle_x"><a href="#">Occhiali da sole</a></li>
	</ul>

  <h2 class="sub_title sub_js">Gucci</h2>
	<ul class="showmenu">
		<li><a href="#">Borse e Accessori</a> </li>
		<li><a href="#">Cinture</a></li>
		<li><a href="#">Frizioni</a></li>
		<li><a href="#">Hobos</a> </li>
		<li><a href="#">Messenger Bags</a> </li>
		<li><a href="#">Spalla Borse</a> </li>
		<li><a href="#">Top Maniglie</a> </li>
		<li><a href="#">Totes</a> </li>
		<li><a href="#">Portafogli &amp; Borse</a> </li>
	</ul>
  <h2 class="sub_title"><a href="#">Balenciaga</a></h2>
  <h2 class="sub_title"><a href="#">UGG Boots</a></h2>
	<ul class="hidemenu">
		<li><a href="#">Sandali Camoscio Amelie UGG</a> </li>
		<li><a href="#">Stivali UGG Bailey Button</a> </li>
		<li><a href="#">Classic Boots UGG Cardy</a> </li>
		<li><a href="#">Crochet UGG Boots Classic</a> </li>
		<li><a href="#">Mini Classic Boots UGG</a> </li>
		<li><a href="#">UGG Classic Short Boots</a> </li>
		<li><a href="#">UGG Classic Short Metallic Boots</a> </li>
		<li><a href="#">UGG Classic Short Paisley</a> </li>
		<li><a href="#">UGG Classic Tall Boots</a> </li>
		<li><a href="#">UGG Classic Tall Boots Metallic</a> </li>
		<li><a href="#">UGG Boots Knightsbridge</a> </li>
		<li><a href="#">UGG Boots Nightfall</a> </li>
		<li><a href="#">UGG STIVALI in camoscio</a> </li>
		<li><a href="#">II Sundance UGG Boots</a> </li>
		<li><a href="#">Ultra Short UGG Boots</a> </li>
		<li><a href="#">Ultra UGG Boots Tall</a> </li>
	</ul>
  <h2 class="sub_title"><a href="#">Christian Louboutin</a></h2>
	<ul class="hidemenu">
		<li><a href="#">Stivali di Christian Louboutin</a> </li>
		<li><a href="#">Pompe di Christian Louboutin</a> </li>
		<li><a href="#">Sandali Christian Louboutin</a> </li>
		<li><a href="#">Christian Louboutin slingback</a> </li>
	</ul>
</div></div>
</div></div>
	
    <!-- 图片 -->



<!-- 商品分类中的样式 -->
<?php if(false && $current_page_base=='index' && isset($_GET["cPath"]) && zen_not_null($_GET["cPath"])) { ?>
<?php
	$styleListArray = array();
	$styleList = array();
	if(zen_has_category_subcategories($current_category_id)){	
		$priceListQuery_sql = '';
		$priceListQueryArray = array();
		zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
		$priceListQuery_sql = implode(' or categories_id =',$product_in_categoriesArray);
		$priceListQuery_sql = '( categories_id = '.$priceListQuery_sql.')';
	}else{	
		$priceListQuery_sql = 'categories_id = ' . (int)$current_category_id;
	}
	$styleSQL="SELECT PV.products_options_values_id,PV.products_options_values_name,PA.options_id FROM products_options_values PV LEFT JOIN products_attributes PA ON PV.products_options_values_id=PA.options_values_id AND options_id=1 AND PA.products_id IN (SELECT `products_id` FROM products_to_categories WHERE ". $priceListQuery_sql .") group by PA.options_values_id ";
	$styleListArray = $db->Execute($styleSQL);
	$row = 0;
	while (!$styleListArray->EOF){
		$styleList[$styleListArray->fields['options_id']][$styleListArray->fields['products_options_values_id']] = $styleListArray->fields['products_options_values_name'];
		$row++;
		$styleListArray->MoveNext();
	}
	$styleList = $styleList[1];
	
?>
<div class="categories">
   <div class="categories_left">Stile</div>
   <div class="sidecontent">
     <ul>
     <?php foreach($styleList as $key=>$s){ ?>
      <li><a href="<?=zen_href_link(FILENAME_DEFAULT, "cPath=".$current_category_id."&style_name=".strip($$s)."&style=".$key)?>"><?=$s?></a></li>
     <?php } ?> 
     </ul>
   </div>
</div>
<?php }?>



<!-- 价格区间 -->
<? if(false && $current_page_base=='index' && isset($_GET["cPath"]) && zen_not_null($_GET["cPath"])) { ?>
<?
$row = 0;
$priceListArray = array();
$priceList = array();

$content = "";
$content .= '<div class="pad_1em">' . "\n";
$category_depth == 'products' ? array_pop($cPath_array) : '';
if(sizeof($cPath_array) > 0){
	$content .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id).'" class="red b"> &lt;' . zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</a>';
}else{
	$content .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id).'" class="red b"> &lt;' . zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</a>';
}
$content .= '</div>';

$title = "Narrow By";
$subtitle = "Category";
$title_link = false;
    
/*
 * priceList  four part
 */
if(zen_has_category_subcategories($current_category_id)){
	$priceListQuery_sql = '';
	$priceListQueryArray = array();
	zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
	$priceListQuery_sql = implode(' or p2c.categories_id =',$product_in_categoriesArray);
	$priceListQuery_sql = '( p2c.categories_id = '.$priceListQuery_sql.')';
}else{
	$priceListQuery_sql = 'p2c.categories_id = ' . (int)$current_category_id;
}
$priceListQuery = "SELECT p.`products_price`,p2c.`categories_id` FROM products p,products_to_categories p2c WHERE p2c.products_id=p.products_id AND ". $priceListQuery_sql ." order by products_price";    
$priceListArray = $db->Execute($priceListQuery);
$priceList=array();
while (!$priceListArray->EOF){
	$priceList[] = $priceListArray->fields['products_price'];
	$priceListArray->MoveNext();
}
$priceListOutString = '';
if($priceList)
{
	$totalNum = sizeof($priceList);
	$MaxPrice = max($priceList);
	$MinPrice = min($priceList);
	$ThePrice = $MaxPrice-$MinPrice;
	$MiddlePrice = $ThePrice/5;

	if($MaxPrice>$MinPrice)
	{
		for($num=$MinPrice;$num<=$MaxPrice;$num=$num+$MiddlePrice)
		{
			for($num=$MinPrice;$num<$MaxPrice;$num=$num+$MiddlePrice)
			{
				$priceListOutString .= '<li>';
				$priceListOutString .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id.'&min_price='.floor($num)).'&max_price='.ceil($num+$MiddlePrice).'"     rel="nofollow">';
				$priceListOutString .= $currencies->display_price($num,zen_get_tax_rate($_GET['products_tax_class_id'])).' - '.$currencies->display_price($num+$MiddlePrice,zen_get_tax_rate($_GET['products_tax_class_id']));   	
				$priceListOutString .= '</a>';
				$priceListOutString .= '</li>';
			}
		}
	}
	unset($priceListQuery,$priceListQuery_sql);
	if ($title_link){ $title = '<a href="' . zen_href_link($title_link) . '">' . $title . BOX_HEADING_LINKS . '</a>'; }
}


?>
<div class="categories">
   <div class="categories_left">Prezzo</div>
   <div class="sidecontent">
     <ul>
      <?=$priceListOutString?>
     </ul>
   </div>
</div>
<? } ?>



<!-- 畅销商品 -->
<? if($current_page_base!='product_info') { ?>
<?php
  $show_best_sellers= false;
  if (isset($_GET['products_id'])) {
    if (isset($_SESSION['customer_id'])) {
      $check_query = "select count(*) as count
                      from " . TABLE_CUSTOMERS_INFO . "
                      where customers_info_id = '" . (int)$_SESSION['customer_id'] . "'
                      and global_product_notifications = '1'";
      $check = $db->Execute($check_query);
      if ($check->fields['count'] > 0) {
        $show_best_sellers= true;
      }
    }
  } else {
    $show_best_sellers= true;
  }

  if ($show_best_sellers == true) {
    if (isset($current_category_id) && ($current_category_id > 0)) {
      $best_sellers_query = "select distinct p.products_id, pd.products_name, p.products_ordered
                             from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, "
                                    . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c
                             where p.products_status = '1'
                             and p.products_ordered > 0
                             and p.products_id = pd.products_id
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id = p2c.products_id
                             and p2c.categories_id = c.categories_id
                             and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id)
                             order by p.products_ordered desc, pd.products_name
                             limit " . MAX_DISPLAY_BESTSELLERS;

      $best_sellers = $db->Execute($best_sellers_query);

    } else {
      $best_sellers_query = "select distinct p.products_id, pd.products_name, p.products_ordered
                             from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                             where p.products_status = '1'
                             and p.products_ordered > 0
                             and p.products_id = pd.products_id
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             order by p.products_ordered desc, pd.products_name
                             limit " . MAX_DISPLAY_BESTSELLERS;

      $best_sellers = $db->Execute($best_sellers_query);
    }

    if ($best_sellers->RecordCount() >= MIN_DISPLAY_BESTSELLERS) {
      $title =  BOX_HEADING_BESTSELLERS;
      $box_id =  'bestsellers';
      $rows = 0;
      while (!$best_sellers->EOF) {
        $rows++;
        $bestsellers_list[$rows]['id'] = $best_sellers->fields['products_id'];
        $bestsellers_list[$rows]['name']  = $best_sellers->fields['products_name'];
        $best_sellers->MoveNext();
      }
    }
  }
?>

<div class="categories">
	  <h4>PRODOTTI <span>Bestseller</span></h4>
	  <h5></h5>
	  
	  <div class="sidecontent">
       <? for ($i=1; $i<=sizeof($bestsellers_list); $i++) { ?>
	   <div class="bestseller">
		 <div class="img<?php echo $i==sizeof($bestsellers_list)?' edge':'';?>"><?='<a href="'.zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' .zen_get_products_image($bestsellers_list[$i]['id'],SMALL_IMAGE_WIDTH,SMALL_IMAGE_HEIGHT).'</a>'?></div>
		  <ul>
		  <li><?='<a href="'.zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']).'">'. zen_trunc_string($bestsellers_list[$i]['name'], BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) . '</a>'?><br />
                  	<span><?=zen_get_products_display_price($bestsellers_list[$i]['id'])?></span></li>
		 </ul>
		 </div>
       <? } ?>
       </div>
	</div>
<? } ?>


<!-- 最新订单 -->
<? if(false && $current_page_base!='product_info') { ?>
<?
if($_GET["main_page"]!="product_info")
{
	$products_history = "SELECT op.products_id,op.products_name,o.customers_state,o.customers_country FROM ".TABLE_ORDERS." o LEFT JOIN ".TABLE_ORDERS_PRODUCTS." op ON o.orders_id=op.orders_id ORDER BY o.date_purchased DESC LIMIT ".MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX;
	$products_history = $db->Execute($products_history);
	$rows=0;
	while (!$products_history->EOF)
	{
		$rows++;
		$customer_orders[$rows]['id'] = $products_history->fields['products_id'];
		$customer_orders[$rows]['name'] = $products_history->fields['products_name'];
		$customer_orders[$rows]['customers_state'] = $products_history->fields['customers_state'];
		$customer_orders[$rows]['customers_country'] = $products_history->fields['customers_country'];
		$products_history->MoveNext();
	}
}
?>
	<div class="categories">
       <div class="categories_left">Acquisti recenti</div>
       <div class="sidecontent" id="recentlyorder" style="overflow: hidden;">
        <ul>
         <? for ($i=1; $i<=sizeof($customer_orders); $i++) { ?>
         <li><img src="<?=$zen->urlTplImg('icon_car_gray.gif');?>" width="13" height="14" /></li>
         <li>
         	<?='<a href="' . zen_href_link(zen_get_info_page($customer_orders[$i]['id']), 'products_id=' . $customer_orders[$i]['id']) . '">' . $customer_orders[$i]['name'] . '</a>'?><br />
            ship to <?=$customer_orders[$i]['customers_state']?>,<?=$customer_orders[$i]['customers_country']?>
            </li>
         <? 
		 		if($i>=2){ break; }
			} ?>
         </ul>
       </div>
    </div>
<? } ?>

</div>



<?php
}else{
/**
 * column_left module
 *
 * @package templateStructure
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: column_left.php 4274 2006-08-26 03:16:53Z drbyte $
*/
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$column_box_default='tpl_box_default_left.php';
// Check if there are boxes for the column
$column_left_display= $db->Execute("select layout_box_name from " . TABLE_LAYOUT_BOXES . " where layout_box_location = 0 and layout_box_status= '1' and layout_template ='" . $template_dir . "'" . ' order by layout_box_sort_order');
// safety row stop
$box_cnt=0;
while (!$column_left_display->EOF and $box_cnt < 100) {
  $box_cnt++;
  if ( file_exists(DIR_WS_MODULES . 'sideboxes/' . $column_left_display->fields['layout_box_name']) or file_exists(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $column_left_display->fields['layout_box_name']) ) {
	//$column_box_spacer = 'column_box_spacer_left';
	$column_width = BOX_WIDTH_LEFT;
	if ( file_exists(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $column_left_display->fields['layout_box_name']) ) {
	  $box_id = zen_get_box_id($column_left_display->fields['layout_box_name']);
	  echo DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $column_left_display->fields['layout_box_name'].'<br />';
	  require(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $column_left_display->fields['layout_box_name']);
	} else {
	  $box_id = zen_get_box_id($column_left_display->fields['layout_box_name']);
	  echo DIR_WS_MODULES . 'sideboxes/' . $column_left_display->fields['layout_box_name']."<br />";
	  require(DIR_WS_MODULES . 'sideboxes/' . $column_left_display->fields['layout_box_name']);
	}
  } // file_exists
  $column_left_display->MoveNext();
} // while column_left
$box_id = '';
 }
 
 
 //函数
 //=====================================
 
 function showBoxCategory($cPath_array,$ii) 
{
  	global $db,$current_category_id,$category_depth;
	
  	$content .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$cPath_array[$ii]).'"';
  	if($current_category_id == $cPath_array[$ii]){ $content .= ' class="red b" '; }
  	$content .= '> &lt; '.zen_get_category_name($cPath_array[$ii],$_SESSION['languages_id']).'</a>';
   	
	$ii++;
	if ($ii < sizeof($cPath_array) ) {
		$content .= '<div class="pad_1em">';
		$content .= showBoxCategory($cPath_array, $ii);
		$content .= '</div>';
	}else {
		if(zen_has_category_subcategories($cPath_array[$ii])){
			$content .=$cPath_array[$ii];
			$content .= '<ul class="pad_1em">';
			$subcategories_query = "select categories_id
							from " . TABLE_CATEGORIES . "
							where parent_id = '" . (int)$cPath_array[$ii-1]. "' order by sort_order";
			$subcategoriesArray = $db->Execute($subcategories_query);
			while (!$subcategoriesArray->EOF) {
				$content .= '<li><a href="'.zen_href_link(FILENAME_DEFAULT,'cPath='.$subcategoriesArray->fields['categories_id']).'"';
				if ($category_depth == 'products' && $subcategoriesArray->fields['categories_id'] == $current_category_id) {
					$content .= ' class="red b" ';
				}
				$content .= '>'.zen_get_category_name($subcategoriesArray->fields['categories_id'],$_SESSION['languages_id']).'</a></li>';
				$subcategoriesArray->MoveNext();
			}
			$content .= '</ul>';				
		}else{
			print_r('ERROR');
		}
	}
	return $content;
}

function strip($string)
{
	$pattern="/([[:punct:]])+/";
	$anchor = preg_replace($pattern, '', $string);  // modified by zen-cart.cn
	$pattern = "/([[:space:]]|[[:blank:]])+/"; 
	$anchor = preg_replace($pattern, '-', $anchor);
	return $anchor; // return the short filtered name 
}
?>