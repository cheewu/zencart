<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
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
//  $Id: downloads_manager.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE','下载管理');
define('TABLE_HEADING_ATTRIBUTES_ID', '属性ID');
define('TABLE_HEADING_PRODUCTS_ID', '商品');
define('TABLE_HEADING_PRODUCT', '商品名称');
define('TABLE_HEADING_MODEL', '型号');
define('TABLE_HEADING_OPT_NAME', '选项名');
define('TABLE_HEADING_OPT_VALUE', '选项内容名称');
define('TABLE_TEXT_FILENAME', '文件名称');
define('TABLE_TEXT_MAX_DAYS', '天数');
define('TABLE_TEXT_MAX_COUNT', '计数');
define('TABLE_HEADING_ACTION', '操作');

define('TABLE_HEADING_OPT_PRICE', '价格');
define('TABLE_HEADING_OPT_PRICE_PREFIX', '前缀');

define('TEXT_PRODUCTS_NAME', '商品: ');
define('TEXT_PRODUCTS_MODEL', '型号: ');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_DOWNLOAD', '编辑下载信息');
define('TEXT_INFO_HEADING_DELETE_PRODUCTS_DOWNLOAD', '确认取消下载');
define('TEXT_INFO_EDIT_INTRO', '编辑下载信息:');
define('TEXT_DELETE_INTRO', '以下文件将会从数据库中删除. 但文件不会从服务器上删除:');

define('TEXT_INFO_FILENAME', '文件名: ');
define('TEXT_INFO_MAX_DAYS', '最多天数: ');
define('TEXT_INFO_MAX_COUNT', '最大下载: ');

define('TEXT_INFO_FILENAME_MISSING','&nbsp;缺少文件名');
define('TEXT_INFO_FILENAME_GOOD','&nbsp;有效文件名');
?>