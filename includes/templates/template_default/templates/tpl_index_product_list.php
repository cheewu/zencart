<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays product-listing when a particular category/subcategory is selected for browsing
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_product_list.php 6009 2007-03-13 23:56:45Z ajeh $
 */
?>
<div class="centerColumn" id="indexProductList">

<h2 id="productListHeading"><?php echo $breadcrumb->last(); ?></h2>

<?php
if (PRODUCT_LIST_CATEGORIES_IMAGE_STATUS == 'true') {
// categories_image
  if ($categories_image = zen_get_categories_image($current_category_id)) {
?>
<div id="categoryImgListing" class="categoryImg"><?php echo zen_image(DIR_WS_IMAGES . $categories_image, '', CATEGORY_ICON_IMAGE_WIDTH, CATEGORY_ICON_IMAGE_HEIGHT); ?></div>
<?php
  }
} // categories_image
?>

<?php
// categories_description
    if ($current_categories_description != '') {
?>
<div id="indexProductListCatDescription" class="content"><?php echo $current_categories_description;  ?></div>
<?php } // categories_description ?>

<?php
  $check_for_alpha = $listing_sql;
  $check_for_alpha = $db->Execute($check_for_alpha);

  if ($do_filter_list || ($check_for_alpha->RecordCount() > 0 && PRODUCT_LIST_ALPHA_SORTER == 'true')) {
  $form = zen_draw_form('filter', zen_href_link(FILENAME_DEFAULT), 'get') . '<label class="inputLabel">' .TEXT_SHOW . '</label>';
?>

<?php
  echo $form;
  echo zen_draw_hidden_field('main_page', FILENAME_DEFAULT);
  echo zen_hide_session_id();
?>
<?php
  // draw cPath if known
  if (!$getoption_set) {
    echo zen_draw_hidden_field('cPath', $cPath);
  } else {
    // draw manufacturers_id
    echo zen_draw_hidden_field($get_option_variable, $_GET[$get_option_variable]);
  }

  // draw typefilter
  if (isset($_GET['typefilter']) && $_GET['typefilter'] != '') echo zen_draw_hidden_field('typefilter', $_GET['typefilter']);

  // draw manufacturers_id if not already done earlier
  if ($get_option_variable != 'manufacturers_id' && isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] > 0) {
    echo zen_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
  }

  // draw sort
  echo zen_draw_hidden_field('sort', $_GET['sort']);

  // draw filter_id (ie: category/mfg depending on $options)
  if ($do_filter_list) {
    echo zen_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
  }

  // draw alpha sorter
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING_ALPHA_SORTER));
?>
</form>
<?php
  }

?>
<br class="clearBoth" />

<?php
/**
 * require the code for listing products
 */
// echo $template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php';
 require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
?>


<?php
//// bof: categories error
if ($error_categories==true) {
  // verify lost category and reset category
  $check_category = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_id='" . $cPath . "'");
  if ($check_category->RecordCount() == 0) {
    $new_products_category_id = '0';
    $cPath= '';
  }
?>

<?php
$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MISSING);

while (!$show_display_category->EOF) {
?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS') { ?>
<?php
/**
 * display the Featured Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
<?php } ?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS') { ?>
<?php
/**
 * display the Special Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
<?php } ?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS') { ?>
<?php
/**
 * display the New Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php } ?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_UPCOMING') {
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
  }
?>
<?php
  $show_display_category->MoveNext();
} // !EOF
?>
<?php } //// eof: categories error ?>

<?php
//// bof: categories
$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_LISTING_BELOW);
if ($error_categories == false and $show_display_category->RecordCount() > 0) {
?>

<?php
  $show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_LISTING_BELOW);
  while (!$show_display_category->EOF) {
?>

<?php
    if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS') { ?>
<?php
/**
 * display the Featured Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
<?php } ?>

<?php
    if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS') { ?>
<?php
/**
 * display the Special Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
<?php } ?>

<?php
    if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS') { ?>
<?php
/**
 * display the New Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php } ?>

<?php
    if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING') {
      include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
    }
?>
<?php
  $show_display_category->MoveNext();
  } // !EOF
?>

<?php
} //// eof: categories
?>

</div>
