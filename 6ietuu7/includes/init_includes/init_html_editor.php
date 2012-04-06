<?php
/**
 * @package htmleditors
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_html_editor.php 4247 2006-08-24 14:58:42Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * List of installed editors should be here:
 * CONSTANTS are used for language-specific display names, and are defined in languages/extra_definitions/editors_list.php
 */
  $editors_list['NONE']      = array('desc' => EDITOR_NONE,      'handler' => '',              'special_needs' => '');
  $editors_list['HTMLAREA']  = array('desc' => EDITOR_HTMLAREA,  'handler' => 'htmlarea.php',  'special_needs' => '');
//  $editors_list['FCKEDITOR'] = array('desc' => EDITOR_FCKEDITOR, 'handler' => 'fckeditor.php', 'special_needs' => '');
//  $editors_list['TINYMCE']   = array('desc' => EDITOR_TINYMCE,   'handler' => 'tinymce.php',   'special_needs' => '');



/******* ADDITIONAL EDITORS CAN BE ADDED ABOVE THIS LINE *******/

/**
 * Prepare pulldown menu for use in various pages where editor selections should be offered
 */
  $editors_pulldown = array();
  $i = 0;
  foreach($editors_list as $key=>$value) {
	  $i++;
    $editors_pulldown[] = array('id' => $i, 'text' => $value['desc'], 'key' => $key);
  }
/**
 * Session default is set if no preference has been chosen during this login session
 */
  if (!isset($_SESSION['html_editor_preference_status'])) {
    $_SESSION['html_editor_preference_status'] = HTML_EDITOR_PREFERENCE;
  }
/**
 * If a new preference has been selected via a pulldown menu, set the details:
 */
  $new_editor_choice = (isset($_GET['action']) && $_GET['action'] == 'set_editor' && isset($_GET['reset_editor'])) ? $_GET['reset_editor'] : -1;

/** 
 * Set a few variables for use in admin pages
 *
 * $_SESSION['html_editor_preference_status'] = the key name of the selected editor for this session
 * $current_editor_key = the numerical index pointer as default for the pulldown menu drawn when offering editor selection
 * $editor_handler = the path to the handler file containing the logic required for <HEAD> insertion to activate editor features
 *
 */
  foreach($editors_pulldown as $key=>$value) {
    if ($new_editor_choice == $value['id']) $_SESSION['html_editor_preference_status'] = $value['key'];
    if ($_SESSION['html_editor_preference_status'] == $value['key']) $current_editor_key = $value['id'];
  }
  $editor_handler = DIR_WS_INCLUDES . $editors_list[$_SESSION['html_editor_preference_status']]['handler'];
  $editor_handler = ($editor_handler == DIR_WS_INCLUDES) ? '' : $editor_handler;
  /* if handler not found, reset to NONE */
  if ($editor_handler != '' && !file_exists($editor_handler)) {
    $editor_handler = '';
    $_SESSION['html_editor_preference_status'] = 'NONE';
    $current_editor_key = 0;
  }

/**
 * Debug code:
 */
if (false) {
  echo '<br /><pre>'; print_r($_GET); echo '</pre>';
  echo '<br />new_editor_choice = ' . $new_editor_choice;
  echo '<br />current_editor_key = ' . $current_editor_key;
  echo '<br />$_SESSION[html_editor_preference_status] = ' . $_SESSION['html_editor_preference_status'];
  echo '<br />editor_handler = ' . $editor_handler;
  echo '<br /><pre>'; print_r($editors_list); echo '</pre>';
  echo '<br /><pre>'; print_r($editors_pulldown); echo '</pre>';
  //die('debug end');
}
?>