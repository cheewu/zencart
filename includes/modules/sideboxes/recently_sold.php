<!-- BOF Recently Sold items-->
<?php
 $in_same_category_query = "SELECT p.`products_id`,p.`products_image`,pd.`products_name`
                         FROM products_to_categories p2c, products p, products_description pd
                         WHERE p2c.products_id=p.products_id
						 AND p.products_id=pd.products_id
                         AND p2c.categories_id=".(int)zen_get_products_category_id($_GET['products_id'])."
                         AND pd.language_id=" . (int)$_SESSION['languages_id'] . "
                         AND p.`products_status`=1 limit 10";
 $in_same_category = $db->Execute($in_same_category_query);
 if ($in_same_category->RecordCount()>0){
 	  echo '<div class="leftBoxContainer"><h3 class="leftBoxHeading">' . IN_SAME_CATEGORY . '</h3>';
 	  echo zen_image($template->get_template_dir('go_up.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . 'go_up.jpg','','','',' id="goup" class="hand"');
 	  echo '<div id="recently_sold_items" style="overflow: hidden; height: 500px;">';
 	  echo '<ul id="recently_sold_items_a" class="top_selling">';
 	  while (!$in_same_category->EOF){
      echo '<li class="clear"><span style="float:left;width=45px;"><a href="'.zen_href_link(zen_get_info_page($in_same_category->fields['products_id']),'products_id='.$in_same_category->fields['products_id']).'">'.zen_image(DIR_WS_IMAGES . $in_same_category->fields['products_image'], $in_same_category->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT).'</a></span>';
      echo '<span style="float:left;"><a href="'.zen_href_link(zen_get_info_page($in_same_category->fields['products_id']),'products_id='.$in_same_category->fields['products_id']).'">'.substr($in_same_category->fields['products_name'],0,20).'...'.'</a><br/><strong class="red">'.$currencies->display_price(zen_get_products_base_price($in_same_category->fields['products_id']),zen_get_tax_rate($products_tax_class_id)).'</strong></span></li>';
 	  	$in_same_category->MoveNext();
 	  }
 	  echo '</ul>';
 	  echo '<ul id="recently_sold_items_b" class="top_selling" ></ul></div>';
 	  echo zen_image($template->get_template_dir('go_down.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . 'go_down.jpg','','','',' id="godown" class="hand"');
    echo '</div>';?>
    <script type="text/javascript" src="includes/templates/template_default/jscript/recently_sold.js"></script>
<?php
 }
?>
<!-- EOF Recently Sold items-->