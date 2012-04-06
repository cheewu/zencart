<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
//  $Id: developers_tool_kit.php 6082 2007-03-31 04:26:08Z ajeh $
//
  define('HEADING_TITLE', '开发工具集');
  define('TABLE_CONFIGURATION_TABLE', '查询常量定义');

  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>成功</strong>更新商品价格排序值');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>错误:</strong> 没有找到匹配的配置关键字 ...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>错误:</strong> 没有输入要查找的配置关键字或文字 ... 搜索中断');

  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>更新所有商品价格排序</strong><br />以便能按显示价格排序: ');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>查询常量或语言文件定义</strong>');
  define('TEXT_CONFIGURATION_KEY', 'Key or Name:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>注释:</strong> 常量是大写字母.<br />选择下拉后, 如果在数据库表中没有找到, 就查询语言文件, 函数, 类, 等. ');

  define('TABLE_TITLE_KEY', '<strong>关键字:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>标题:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>简介:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>组别:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>价值:</strong>');

  define('TEXT_LOOKUP_NONE', '无');
  define('TEXT_INFO_SEARCHING', '搜索 ');
  define('TEXT_INFO_FILES_FOR', ' 文件 ... 关于: ');
  define('TEXT_INFO_MATCHES_FOUND', '没有找到匹配行: ');

  define('TEXT_LANGUAGE_LOOKUPS', '语言文件查找:');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', ' ' . strtoupper($_SESSION['language']) . '的所有语言文件 - Catalog/Admin');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', '所有主要语言文件 - Catalog (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /schinese.php 等)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', '所有当前选择语言文件 - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', '所有主要语言文件 - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /schinese.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', '所有当前选择语言文件 - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', '所有当前选择语言文件 - Catalog/Admin');

  define('TEXT_FUNCTION_CONSTANT', '<strong>在函数文件中查找</strong>');
  define('TEXT_FUNCTION_LOOKUPS', '函数文件查找:');
  define('TEXT_FUNCTION_LOOKUP_CURRENT', '所有函数文件 - Catalog/Admin');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_CATALOG', '所有函数文件 - Catalog');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_ADMIN', '所有函数文件 - Admin');

  define('TEXT_CLASS_CONSTANT', '<strong>在类文件中查找</strong>');
  define('TEXT_CLASS_LOOKUPS', '类文件查找:');
  define('TEXT_CLASS_LOOKUP_CURRENT', '所有类文件 - Catalog/Admin');
  define('TEXT_CLASS_LOOKUP_CURRENT_CATALOG', '所有类文件 - Catalog');
  define('TEXT_CLASS_LOOKUP_CURRENT_ADMIN', '所有类文件 - Admin');

  define('TEXT_TEMPLATE_CONSTANT', '<strong>在模板文件中查找</strong>');
  define('TEXT_TEMPLATE_LOOKUPS', '模板文件查找:');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT', '所有模板文件 - /templates sideboxes /pages 等');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_TEMPLATES', '所有模板文件 - /templates');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_SIDEBOXES', '所有模板文件 - /sideboxes');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_PAGES', '所有模板文件 - /pages');

  define('TEXT_ALL_FILES_CONSTANT', '<strong>在所有文件中查找</strong>');
  define('TEXT_ALL_FILES_LOOKUPS', '所有文件查找:');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT', '所有文件 - Catalog/Admin');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_CATALOG', '所有文件 - Catalog');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_ADMIN', '所有文件 - Admin');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','没有可以编辑的');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' 或, 隐藏');

  define('TEXT_SEARCH_ALL_FILES', '搜索所有文件: ');
  define('TEXT_SEARCH_DATABASE_TABLES', '搜索数据库的configuration表: ');
?>