<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.core.php 4271 2006-08-26 01:21:02Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
} 
/**
 * 
 * require(DIR_WS_CLASSES . 'class.base.php'); 
 * require(DIR_WS_CLASSES . 'class.notifier.php');
 * $zco_notifier = new notifier()'
 * require(DIR_WS_CLASSES . 'mime.php'); 
 * require(DIR_WS_CLASSES . 'email.php'); 
 * require(DIR_WS_CLASSES . 'boxes.php'); 
 * require(DIR_WS_CLASSES . 'category_tree.php'); 
 * require(DIR_WS_CLASSES . 'cache.php'); 
 * require(DIR_WS_CLASSES . 'sniffer.php'); 
 * require(DIR_WS_CLASSES . 'shopping_cart.php'); 
 * require(DIR_WS_CLASSES . 'navigation_history.php'); 
 * require(DIR_WS_CLASSES . 'currencies.php'); 
 * require(DIR_WS_CLASSES . 'message_stack.php'); 
 * require(DIR_WS_CLASSES . 'template_func.php'); 
 * require(DIR_WS_CLASSES . 'split_page_results.php'); 
 * require(DIR_WS_CLASSES . 'breadcrumb.php'); 
 * require(DIR_WS_CLASSES . 'language.php'); 
 * 
 */
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'class.base.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'class.notifier.php');
  $autoLoadConfig[0][] = array('autoType'=>'classInstantiate',
                                'className'=>'notifier',
                                'objectName'=>'zco_notifier');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=> 'class.phpmailer.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=> 'class.smtp.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=> 'boxes.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'category_tree.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'template_func.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'split_page_results.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'language.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'cache.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'sniffer.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'class.phpbb.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'shopping_cart.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'navigation_history.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'currencies.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'message_stack.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'breadcrumb.php');
/**
 * Breakpoint 10.
 * 
 * require('includes/init_includes/init_database.php');
 * require('includes/version.php');
 * 
 */
  $autoLoadConfig[10][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_file_db_names.php');
  $autoLoadConfig[10][] = array('autoType'=>'init_script',
                                'loadFile'=>'init_database.php');
/**
 * Breakpoint 20.
 * 
 * require('includes/init_includes/init_file_db_names.php');
 * 
 */
  $autoLoadConfig[20][] = array('autoType'=>'include',
                                'loadFile'=> DIR_WS_INCLUDES . 'version.php');
/**
 * Breakpoint 30.
 * 
 * $zc_cache = new cache(); 
 * 
 */
  $autoLoadConfig[30][] = array('autoType'=>'classInstantiate',
                                'className'=>'cache',
                                'objectName'=>'zc_cache');
/**
 * Breakpoint 40.
 * 
 * require('includes/init_includes/init_db_config_read.php');
 * 
 */
  $autoLoadConfig[40][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_db_config_read.php');
/**
 * Breakpoint 50.
 * 
 * $sniffer = new sniffer();
 * require('includes/init_includes/init_gzip.php'); 
 * require('includes/init_includes/init_sefu.php'); 
 * $phpBB = new phpBB();
 */
  $autoLoadConfig[50][] = array('autoType'=>'classInstantiate',
                                'className'=>'sniffer',
                                'objectName'=>'sniffer');
  $autoLoadConfig[50][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_gzip.php');
  $autoLoadConfig[50][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_sefu.php');
  $autoLoadConfig[50][] = array('autoType'=>'classInstantiate',
                                'className'=>'phpBB',
                                'objectName'=>'phpBB');
/**
 * Breakpoint 60.
 * 
 * require('includes/init_includes/init_general_funcs.php'); 
 * require('includes/init_includes/init_tlds.php'); 
 * 
 */
  $autoLoadConfig[60][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_general_funcs.php');
  $autoLoadConfig[60][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_tlds.php');
/**
 * Breakpoint 70.
 * 
 * require('includes/init_includes/init_sessions.php'); 
 * 
 */
  $autoLoadConfig[70][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_sessions.php');
/**
 * Breakpoint 80.
 * 
 * if(!$_SESSION['cart']) $_SESSION['cart'] = new shoppingCart();
 * if(!$_SESSION['navigaton']) $_SESSION['navigation'] = new navigaionHistory();
 * 
 */
  $autoLoadConfig[80][] = array('autoType'=>'classInstantiate',
                                'className'=>'shoppingCart',
                                'objectName'=>'cart',
                                'checkInstantiated'=>true,
                                'classSession'=>true);
  $autoLoadConfig[80][] = array('autoType'=>'classInstantiate',
                                'className'=>'navigationHistory',
                                'objectName'=>'navigation',
                                'checkInstantiated'=>true,
                                'classSession'=>true);
/**
 * Breakpoint 90.
 * 
 * currencies = new currencies();
 * 
 */
  $autoLoadConfig[90][] = array('autoType'=>'classInstantiate',
                                'className'=>'currencies',
                                'objectName'=>'currencies');
/**
 * Breakpoint 100.
 * 
 * require('includes/init_includes/init_sanitize.php'); 
 * $template = new template_func();
 * 
 */
  $autoLoadConfig[100][] = array('autoType'=>'classInstantiate',
                                 'className'=>'template_func',
                                 'objectName'=>'template');
  $autoLoadConfig[100][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_sanitize.php');
/**
 * Breakpoint 110.
 * 
 * require('includes/init_includes/init_languages.php'); 
 * require('includes/init_includes/init_templates.php'); 
 * 
 */
  $autoLoadConfig[110][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_languages.php');
  $autoLoadConfig[110][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_templates.php');
/**
 * Breakpoint 120.
 * 
 * $_SESSION['navigation']->add_current_page();
 * require('includes/init_includes/init_currencies.php'); 
 * 
 */
  $autoLoadConfig[120][] = array('autoType'=>'objectMethod',
                                'objectName'=>'navigation',
                                'methodName' => 'add_current_page');
  $autoLoadConfig[120][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_currencies.php');
/**
 * Breakpoint 130.
 * 
 * require('includes/init_includes/init_customer_auth.php'); 
 * messageStack = new messageStack();
 * 
 */
  $autoLoadConfig[130][] = array('autoType'=>'classInstantiate',
                                 'className'=>'messageStack',
                                 'objectName'=>'messageStack');
  $autoLoadConfig[130][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_customer_auth.php');
/**
 * Breakpoint 140.
 * 
 * require('includes/init_includes/init_cart_handler.php'); 
 * 
 */
  $autoLoadConfig[140][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_cart_handler.php');
/**
 * Breakpoint 150.
 * 
 * require('includes/init_includes/init_special_funcs.php'); 
 * 
 */
  $autoLoadConfig[150][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_special_funcs.php');
/**
 * Breakpoint 160.
 * 
 * require('includes/init_includes/init_category_path.php'); 
 * $breadcrumb = new breadcrumb();
 */
  $autoLoadConfig[160][] = array('autoType'=>'classInstantiate',
                                 'className'=>'breadcrumb',
                                 'objectName'=>'breadcrumb');
  $autoLoadConfig[160][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_category_path.php');
/**
 * Breakpoint 170.
 * 
 * require('includes/init_includes/init_add_crumbs.php'); 
 * 
 */
  $autoLoadConfig[170][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_add_crumbs.php');
/**
 * Breakpoint 180.
 * 
 * require('includes/init_includes/init_header.php'); 
 * 
 */
  $autoLoadConfig[180][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_header.php');
?>