<div class="centerColumn" id="indexTagsList">
<h1 id="productListHeading"><?php echo HEADING_TITLE; ?></h1>
<br class="clearBoth" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px;">
<?php
while(!$tags->EOF)
{
?>
  <tr>
    <td><a href="/<?php echo $seo->strip($tags->fields['tags']);?>-t/"><?php echo $tags->fields['tags'];?></a></td>
  </tr>
<?php
	$tags->MoveNext();
}
?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $tags_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>

<?php echo TEXT_RESULT_PAGE . ' ' . $tags_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>



