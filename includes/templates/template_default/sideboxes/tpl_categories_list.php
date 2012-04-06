<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
  //print_r($box_categories_array);
  //print_r($cPath_array);
  //print_r($current_category_id);
  $content = "";
  $content .= '<div class="pad_1em">' . "\n";
	$category_depth == 'products' ? array_pop($cPath_array) : '';
  function showBoxCategory($cPath_array,$ii) {
  	global $db,$current_category_id,$category_depth;
  	$content .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$cPath_array[$ii]).'"';
  	if($current_category_id == $cPath_array[$ii]){
  		$content .= ' class="red b" ';
  	}
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
					$content .= '<li><a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$subcategoriesArray->fields['categories_id']).'"';
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
	if (sizeof($cPath_array) > 0){
	  $content .= showBoxCategory($cPath_array,0);
	}else{
		$content .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id).'" class="red b"> &lt;' . zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</a>';
	}
  $content .= '</div>';
  
?>