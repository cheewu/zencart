<?php
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<?php
if($_GET['pagesize']!="")
{
	echo '<meta name="robots" content="noindex, nofollow" />';
}
?>
<?php echo rss_feed_link_alternate(); // RSS Feed ?>
<script type="text/javascript">
var baseURL = "<?php echo HTTP_SERVER . DIR_WS_CATALOG?>";
</script>
<?php if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($current_page_base,explode(",",constant('ROBOTS_PAGES_TO_SKIP'))) || $current_page_base=='down_for_maintenance') { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<?php if (defined('FAVICON')) { ?>
<link rel="icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<?php } ?>

<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>" />

<?php
  $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), '/^style/', '.css');
  while(list ($key, $value) = each($directory_array)) {
    echo '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
  //--------------------------------------------- add 2010 06 01 ------------------------------------------------//
  $directory_default_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'css'), '/^style/', '.css');
  $directory_diff_array = array_diff($directory_default_array,$directory_array);
  while(list ($key, $value) = each($directory_diff_array)) {
    echo '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
  //--------------------------------------------------- end -----------------------------------------------------//
  $manufacturers_id = (isset($_GET['manufacturers_id'])) ? $_GET['manufacturers_id'] : '';
  $tmp_products_id = (isset($_GET['products_id'])) ? (int)$_GET['products_id'] : '';
  $tmp_pagename = ($this_is_home_page) ? 'index_home' : $current_page_base;
  $sheets_array = array('/' . $_SESSION['language'] . '_stylesheet',
                        '/' . $tmp_pagename,
                        '/' . $_SESSION['language'] . '_' . $tmp_pagename,
                        '/c_' . $cPath,
                        '/' . $_SESSION['language'] . '_c_' . $cPath,
                        '/m_' . $manufacturers_id,
                        '/' . $_SESSION['language'] . '_m_' . (int)$manufacturers_id,
                        '/p_' . $tmp_products_id,
                        '/' . $_SESSION['language'] . '_p_' . $tmp_products_id
                        );
  while(list ($key, $value) = each($sheets_array)) {
    $perpagefile = $template->get_template_dir('.css', DIR_WS_TEMPLATE, $current_page_base, 'css') . $value . '.css';
    $perpagefile_default = $template->get_template_dir('.css', DIR_WS_TEMPLATES . 'template_default/', $current_page_base, 'css') . $value . '.css';
    if (file_exists($perpagefile)) echo '<link rel="stylesheet" type="text/css" href="' . $perpagefile .'" />'."\n";
    //------------------------------------------ add 2010 06 01 -------------------------------------------------//
    else if(file_exists($perpagefile_default)){echo '<link rel="stylesheet" type="text/css" href="' . $perpagefile_default .'" />'."\n";}
  }

  $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), '/^print/', '.css');
  sort($directory_array);
  while(list ($key, $value) = each($directory_array)) {
    echo '<link rel="stylesheet" type="text/css" media="print" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
  //--------------------------------------------- add 2010 06 01 ------------------------------------------------//
  $directory_default_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'css'), '/^print/', '.css');
  $directory_diff_array = array_diff($directory_default_array,$directory_array);
  while(list ($key, $value) = each($directory_diff_array)) {
    echo '<link rel="stylesheet" type="text/css" media="print" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
  //--------------------------------------------------- end -----------------------------------------------------//
  $directory_array = $template->get_template_part($template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'), '/^jscript_/', '.js');
  while(list ($key, $value) = each($directory_array)) {
    echo '<script type="text/javascript" src="' .  $template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript') . '/' . $value . '"></script>'."\n";
  }
  //--------------------------------------------- add 2010 06 01 ------------------------------------------------//
  $directory_default_array = $template->get_template_part($template->get_template_dir('.js',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'jscript'), '/^jscript_/', '.js');
  $directory_diff_array = array_diff($directory_default_array,$directory_array);
  while(list ($key, $value) = each($directory_diff_array)) {
    echo '<script type="text/javascript" src="' .  $template->get_template_dir('.js',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'jscript') . '/' . $value . '"></script>'."\n";
  }
  //--------------------------------------------------- end -----------------------------------------------------//
  $directory_array = $template->get_template_part($page_directory, '/^jscript_/', '.js');
  while(list ($key, $value) = each($directory_array)) {
    echo '<script type="text/javascript" src="' . $page_directory . '/' . $value . '"></script>' . "\n";
  }
  $directory_array = $template->get_template_part($template->get_template_dir('.php',DIR_WS_TEMPLATE, $current_page_base,'jscript'), '/^jscript_/', '.php');
  while(list ($key, $value) = each($directory_array)) {
    require($template->get_template_dir('.php',DIR_WS_TEMPLATE, $current_page_base,'jscript') . '/' . $value); echo "\n";
  }
  //--------------------------------------------- add 2010 06 01 ------------------------------------------------//
  $directory_default_array = $template->get_template_part($template->get_template_dir('.php',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'jscript'), '/^jscript_/', '.php');
  $directory_diff_array = array_diff($directory_default_array,$directory_array);
  while(list ($key, $value) = each($directory_diff_array)) {
    require($template->get_template_dir('.php',DIR_WS_TEMPLATES . 'template_default/', $current_page_base,'jscript') . '/' . $value); echo "\n";
  }
  //--------------------------------------------------- end -----------------------------------------------------//
  $directory_array = $template->get_template_part($page_directory, '/^jscript_/');
  while(list ($key, $value) = each($directory_array)) {
    require($page_directory . '/' . $value); echo "\n";
  }
?>
</head>