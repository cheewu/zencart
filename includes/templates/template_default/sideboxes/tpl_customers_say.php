<?php
  $content = "";
  $content .= '<div class="g_t_l pad_top">' . "\n";
	$i = 1;
	while(!$customersSay->EOF){
		$customersSay_text = nl2br(zen_output_string_protected(stripslashes($customersSay->fields['reviews_text'])));
		$content .= '<div class="testimonialscon"> '.$customersSay_text.' "</div><p align="right">'.zen_image(DIR_WS_CATALOG_LANGUAGES . $customersSay->fields['directory'] . '/images/' . $customersSay->fields['image'],$customersSay->fields['name'],'','','style="margin-right:4px;"') . $customersSay->fields['customers_name'].'</p>';
		if($i < $customersSay->RecordCount()){
		$content .= '<div class="border_b center" style="width: 168px; height: 3px;"></div>';
		$i++;
		}
		$customersSay->MoveNext();
	}
	$content .= '<p><br/><a href="';
	$content .= zen_href_link(FILENAME_REVIEWS,'','NONSSL');
	$content .= '" class="more_product">'.MORE_CUSTOMERS_SAY.'</a></p><div class="clear"></div></div>' . "\n";
?>