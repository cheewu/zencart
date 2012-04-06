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
//  $Id: manufacturers.php 4808 2006-10-22 18:48:53Z ajeh $
//

define('HEADING_TITLE', '厂商管理');

define('TABLE_HEADING_MANUFACTURERS', '厂商名字');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_MANUFACTURER', '新厂商');
define('TEXT_HEADING_EDIT_MANUFACTURER', '编辑厂商');
define('TEXT_HEADING_DELETE_MANUFACTURER', '删除厂商');

define('TEXT_MANUFACTURERS', '厂商:');
define('TEXT_DATE_ADDED', '添加日期:');
define('TEXT_LAST_MODIFIED', '最后修改:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_IMAGE_DIR', '上传目录:');
define('TEXT_IMAGE_NONEXISTENT', '图片不存在');
define('TEXT_MANUFACTURERS_IMAGE_MANUAL', '<strong>或从服务器上选择已有图像文件，文件名:</strong>');

define('TEXT_NEW_INTRO', '请为新厂商填写以下信息');
define('TEXT_EDIT_INTRO', '请做必要修改');

define('TEXT_MANUFACTURERS_NAME', '厂商名字:');
define('TEXT_MANUFACTURERS_IMAGE', '厂商图片:');
define('TEXT_MANUFACTURERS_URL', '厂商网址:');

define('TEXT_DELETE_INTRO', '你确定要删除该厂商资料?');
define('TEXT_DELETE_IMAGE', '删除厂商图片?');
define('TEXT_DELETE_PRODUCTS', '删除该厂商的商品? (包括商品评论、特价商品和预售商品)');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b> 仍然有%s件商品属于该厂商!');

define('ERROR_DIRECTORY_NOT_WRITEABLE', '错误: 无法写入该目录，请设置正确的权限: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', '错误: 目录不存在: %s');
?>