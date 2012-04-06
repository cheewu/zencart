<?php
echo '<div class="leftBoxContainer" id="categories" style="width: 210px;">';
echo "<h3 class='leftBoxHeading' id='styletitle'>".TEXT_STYLE."</h3>";
echo '<div id="styleContent" class="sideBoxContent">';
foreach($styleList as $key=>$value)
{
	if($key==1)
	{
		foreach($value as $k=>$v)
		{
			//echo zen_href_link(FILENAME_DEFAULT, "cPath=".$current_category_id."&style_name=".strip($v)."&style=".$k);
			//;
			$style_content.="<div><a href='".zen_href_link(FILENAME_DEFAULT, "cPath=".$current_category_id."&style_name=".strip($v)."&style=".$k)."' rel='nofollow'>".$v."</a></div>";
		}
		//http://192.168.0.192:8015/handbag-shoulder-bags-and-totes_c1_14/monogram-canvas-calfleather/s1
	}
	/*
	if($key==2)
	{
		//$color_content="<div class='substyletitle'>color</div>";
		foreach($value as $k1=>$v1)
		{
			//$color_content.="<div><a href='".zen_href_link(FILENAME_DEFAULT, "cPath=".$current_category_id."&style=".$k1)."'>".$v1."</a></div>";
		}
	}
	*/
}
echo $style_content;
//echo $color_content;
echo '</div>';
echo '</div>';
	function strip($string){
		//if ( is_array($this->attributes['SEO_CHAR_CONVERT_SET']) ) $string = strtr($string, $this->attributes['SEO_CHAR_CONVERT_SET']);
		//$pattern = $this->attributes['SEO_REMOVE_ALL_SPEC_CHARS'] == 'true'?	"/([^[:alnum:]])+/":	"/([[:punct:]])+/";
		$pattern="/([[:punct:]])+/";
		$anchor = preg_replace($pattern, '', $string);  // modified by zen-cart.cn
		$pattern = "/([[:space:]]|[[:blank:]])+/"; 
		$anchor = preg_replace($pattern, '-', $anchor);
		return $anchor; // return the short filtered name 
	}
?>
