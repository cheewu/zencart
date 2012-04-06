<div class="allborder">
<?php //if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<div class="pagebar border_b gray_bg"><span class="fl"><?php //echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></span><ul class="fr"><?php //echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_drop_down(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></ul></div>
<?php
	require($template->get_template_dir('tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_tabular_display.php');
	//echo '<div class="error_box maxwidth" style="width:500px;">In categories no products</div>';
?>

<?php //if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="pagebar margin_t g_t_c gray_bg"><?php //echo $page."/".$pagecount?>&nbsp;<a href="/<?php echo $_GET['keyword']?>-t/1.html">first</a> <a href="/<?php echo $_GET['keyword']?>-t/<?php echo $prvpage;?>.html">priv</a> <a href="/<?php echo $_GET['keyword']?>-t/<?php echo $nextpage;?>.html">next</a> <a href="/<?php echo $_GET['keyword']?>-t/<?php echo $pagecount?>.html">end</a> <?php //echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<?php
  //}
?>
</div>
