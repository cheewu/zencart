<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
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
//  $Id: store_manager.php 4206 2006-08-22 10:00:01Z drbyte $
//
//
  define('HEADING_TITLE', '商店管理');
  define('TABLE_CONFIGURATION_TABLE', '查询常量定义');

  define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', '<strong>成功</strong>更新属性排序');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>成功</strong>更新商品价格定购次数');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', '<strong>成功</strong>重置商品查看次数为 0');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', '<strong>成功</strong>重置商品定购次数为 0');
  define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', '<strong>成功</strong>重置链接商品的所有主分类');
  define('SUCCESS_UPDATE_COUNTER', '<strong>成功</strong>更新计数器为: ');
  define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>成功</strong>更新管理操作日志');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>错误:</strong> 没有找到匹配的配置关键字 ...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>错误:</strong> 没有输入要查找的配置关键字或文字 ... 搜索中断');

  define('TEXT_INFO_COUNTER_UPDATE', '<strong>更新计数器</strong><br />为该值: ');
  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>更新所有商品价格排列</strong><br />以便于按显示价格排序: ');
  define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>重置所有商品查看次数</strong><br />重置商品查看次数为 0: ');
  define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>重置所有商品定购次数</strong><br />重置商品定购次数为 0: ');
  define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>重置所有商品主分类编号</strong><br />以便用于链接商品和价格: ');
  define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>从数据库中清空管理操作日志<br />警告: 执行该操作前请备份数据库!</strong><br />管理操作日志用于记录管理页面下执行的操作。该日志有可能占用很多空间，需要定期清理。<br />在超过50,000条记录或60天后，会给出警告。');

  define('TEXT_ORDERS_ID_UPDATE', '<strong>重置当前订单号码</strong>');
  define('TEXT_INFO_ORDERS_ID_UPDATE', '<strong>备注: 在更新当前订单号码前 ...</strong><br /><br />先建立一个测试订单. 然后, 用该测试订单号码完成以下信息.<br />下一个实际订单的新订单号码应设为您希望使用的号码减 1.<br /><strong>例如:</strong> 如果你希望下一个实际订单号码为1225, 输入 1224<br /><br /><strong>警告:</strong> 您只能将订单号码向后重置, 不能向前.<br />如果您设定订单号码为 25, 接着改为 20, 下一个订单号码还是 26.');
  define('TEXT_OLD_ORDERS_ID', '旧的订单号码');
  define('TEXT_NEW_ORDERS_ID', '新的订单号码');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>查询常量或语言文件</strong>');
  define('TEXT_CONFIGURATION_KEY', '关键字或名称:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>注释:</strong> 常量为大写字母.<br />当在数据库表中找不到时, 可以查询语言文件.');


  define('TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>查询语言文件</strong>');
  define('TEXT_CONFIGURATION_KEY_FILES', '查询文字:');
  define('TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>注释:</strong> 查询语言文件可以是大写或小写');

  define('TABLE_TITLE_KEY', '<strong>关键字:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>标题:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>简介:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>组别:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>价值:</strong>');

  define('TEXT_LANGUAGE_LOOKUPS', '语言文件查询:');
  define('TEXT_LANGUAGE_LOOKUP_NONE', '无');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', '所有语言文件 ' . strtoupper($_SESSION['language']) . ' - Catalog/Admin');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', '所有主要文件 - Catalog (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /schinese.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', '所有当前选项语言文件 - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', '所有主要语言文件 - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /schinese.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', '所有当前选择语言文件 - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', '所有当前选择语言文件 - Catalog/Admin');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','没有可以编辑的');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' 或, 隐藏');

  define('TEXT_INFO_DATABASE_OPTIMIZE', '<strong>优化数据库</strong>，永久删除记录。<br />可每周或每月执行一次。<br />');
  define('SUCCESS_DB_OPTIMIZE', '数据库优化 - 处理数据表: ');

?>