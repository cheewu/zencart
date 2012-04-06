<!-- BOF Recently Sold items-->
<?php
if(is_array($_SESSION['viewed']) && $_GET["main_page"]=="product_info"){
 $viewed_query = "SELECT p.`products_id`,p.`products_image`,pd.`products_name`
                         FROM  products p, products_description pd
                         WHERE p.products_id=pd.products_id
                         AND p.`products_status`=1
						 AND pd.language_id=" . (int)$_SESSION['languages_id'] . "
						 AND p.`products_id` in(". implode(',',$_SESSION['viewed']) .") limit 5";
 $viewed_rs = $db->Execute($viewed_query);
 if ($viewed_rs->RecordCount()>0)
{
	 $box_id =  TEXT_SIDEBOXES_BESTSELLERS;
	 $rows = 0;
 	 while (!$viewed_rs->EOF){
	 $rows++;
	 $bestsellers_list[$rows]['id'] = $viewed_rs->fields['products_id'];
     $bestsellers_list[$rows]['name']  = $viewed_rs->fields['products_name'];
 	 $viewed_rs->MoveNext();
 	 }
 }
require($template->get_template_dir('tpl_viewed.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_viewed.php');
$title =TEXT_SIDEBOXES_VIEWED;
require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
}


?>