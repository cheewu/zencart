<?php
/**
 * category_tree Class - Replacement for Sub Categories Alway Open. 
 * | Copyright (c) 2005 Christoph Handel  ||  http://www.held-im-ruhestand.de/ 
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: category_tree.php 3041 2006-02-15 21:56:45Z wilt $ @update for v1.3.x  2006-10-22 seethrou $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * category_tree Class.
 * This class is used to generate the category tree used for the categories sidebox
 *
 * @package classes
 */
  class ch_category_tree extends base {
    //CHRISTOPH BOF
	var $last_id = false;
	var $first_element = 0;
    //CHRISTOPH EOF

    function zen_category_tree($product_type = "all") {
      global $db, $cPath, $cPath_array;
	  $master_type = false;
      if ($product_type != 'all') {
        $sql = "select type_master_type from " . TABLE_PRODUCT_TYPES . "
                where type_master_type = " . $product_type . "";
        $master_type_result = $db->Execute($sql);
        $master_type = $master_type_result->fields['type_master_type'];
      }
      $this->tree = array();
	  //CHRISTOPH BOF
      $this->ch_add_subs(0, $master_type);
      $row = 0;		
      return $this->zen_show_category($this->first_element, $row);
	  //CHRISTOPH EOF
    }

    function zen_show_category($counter,$ii) {
      global $cPath_array;

      $this->categories_string = "";

      for ($i=0; $i<$this->tree[$counter]['level']; $i++) {
        if ($this->tree[$counter]['parent'] != 0) {
          $this->categories_string .= CATEGORIES_SUBCATEGORIES_INDENT;
        }
      }


      if ($this->tree[$counter]['parent'] == 0) {
        $cPath_new = 'cPath=' . $counter;
        $this->box_categories_array[$ii]['top'] = 'true';
      } else {
        $this->box_categories_array[$ii]['top'] = 'false';
        $cPath_new = 'cPath=' . $this->tree[$counter]['path'];
        $this->categories_string .= CATEGORIES_SEPARATOR_SUBS;
      }
      $this->box_categories_array[$ii]['path'] = $cPath_new;

      if (isset($cPath_array) && in_array($counter, $cPath_array)) {
        $this->box_categories_array[$ii]['current'] = true;
      }

// display category name
      $this->box_categories_array[$ii]['name'] = $this->categories_string . $this->tree[$counter]['name'];


      if (zen_has_category_subcategories($counter)) {
        $this->box_categories_array[$ii]['has_sub_cat'] = true;
      }

      if (SHOW_COUNTS == 'true') {
        $products_in_category = zen_count_products_in_category($counter);
        if ($products_in_category > 0) {
          $this->box_categories_array[$ii]['count'] = $products_in_category;
        }
      }
      if ($this->tree[$counter]['next_id'] != false) {
        $ii++;
        $this->zen_show_category($this->tree[$counter]['next_id'], $ii);
      }
      return $this->box_categories_array;
    }

    //CHRISTOPH BOF
	// recursivly add all categories
    function ch_add_subs($parent, $master_type) {
		global $db;
		// get level and path from parent if possible
		$path  = '';
		$level = 0;
		if ($parent != 0) {
			$level = $this->tree[$parent]['level'];
			$path  = $this->tree[$parent]['path'] . '_';
		}
		// generate query
		if (! $master_type) {
			$categories_query = "select c.categories_id, cd.categories_name, c.parent_id from " . 
			  TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd " .
			  "where c.parent_id = '" . (int)$parent .  "'".			  
			  "and c.categories_id = cd.categories_id " .
			  "and cd.language_id='" . (int)$_SESSION['languages_id'] . "' " . 
			  "and c.categories_status= '1' ".
			  "order by sort_order, cd.categories_name";
		} else {
			$categories_query = "select ptc.category_id as categories_id, cd.categories_name, c.parent_id from " . 
			  TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd, " . TABLE_PRODUCT_TYPES_TO_CATEGORY . " ptc " .
			  "where c.parent_id = '" . (int)$parent .  "'".
			  "and ptc.category_id = cd.categories_id " .
			  "and ptc.product_type_id = '" . $master_type . "' ".
			  "and c.categories_id = ptc.category_id " .
			  "and cd.language_id='" . (int)$_SESSION['languages_id'] ."' ".
			  "and c.categories_status= '1' " .
			  "order by sort_order, cd.categories_name";
		}

        $rows = $db->Execute($categories_query);
		while (!$rows->EOF) {
			// add node
			$this->tree[$rows->fields['categories_id']] = array('name' => $rows->fields['categories_name'],
																'parent' => $parent,
																'level'  => $level + 1,
																'path'   => $path . $rows->fields['categories_id'],
																'next_id' => false);
			// set pointer from previous record to myself
			if ($this->last_id) {
				$this->tree[$this->last_id]['next_id'] = $rows->fields['categories_id'];
			}
			// remember entry point to tree
			if ($this->first_element == 0) {
				$this->first_element = $rows->fields['categories_id'];
			}
			$this->last_id = $rows->fields['categories_id'];
			// recurse
			$this->ch_add_subs($rows->fields['categories_id'], $master_type);
			$rows->MoveNext();
		} // (!$rows->EOF)
	} // function ch_add_subs
    //CHRISTOPH EOF	  	  
	
  } // class category_tree


?>
