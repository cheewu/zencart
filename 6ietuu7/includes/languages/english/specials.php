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
//  $Id: specials.php 4533 2006-09-17 17:21:10Z ajeh $
//

define('HEADING_TITLE', '特价商品');

define('TABLE_HEADING_PRODUCTS', '商品名称');
define('TABLE_HEADING_PRODUCTS_MODEL','型号');
define('TABLE_HEADING_PRODUCTS_PRICE', '价格/特价/促销');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','百分比');
define('TABLE_HEADING_AVAILABLE_DATE', '生效日');
define('TABLE_HEADING_EXPIRES_DATE','到期日');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_SPECIALS_PRODUCT', '商品名称:');
define('TEXT_SPECIALS_SPECIAL_PRICE', '特价:');
define('TEXT_SPECIALS_EXPIRES_DATE', '到期日:');
define('TEXT_SPECIALS_AVAILABLE_DATE', '生效日:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>特价通知:</b><ul><li>你可以在特价栏输入优惠百分比, 例如: <b>20%</b></li><li>如果你输入一个新价格,小数分隔符号必须是\'.\' (小数点), 比如: <b>49.99</b></li><li>如果没有到期日,就将到期日留空</li></ul>');

define('TEXT_INFO_DATE_ADDED', '添加日期:');
define('TEXT_INFO_LAST_MODIFIED', '最后修改:');
define('TEXT_INFO_NEW_PRICE', '新价格:');
define('TEXT_INFO_ORIGINAL_PRICE', '原价:');
define('TEXT_INFO_DISPLAY_PRICE', '显示价格:<br />');
define('TEXT_INFO_AVAILABLE_DATE', '生效日:');
define('TEXT_INFO_EXPIRES_DATE', '到期日:');
define('TEXT_INFO_STATUS_CHANGE', '状态改变:');
define('TEXT_IMAGE_NONEXISTENT', '没有图像存在');

define('TEXT_INFO_HEADING_DELETE_SPECIALS', '删除特价');
define('TEXT_INFO_DELETE_INTRO', '你确定要删除特价吗?');

define('SUCCESS_SPECIALS_PRE_ADD', '成功：预添加特价商品 ... 请更新价格和日期 ...');
define('WARNING_SPECIALS_PRE_ADD_EMPTY', '警告：没有指定商品编号 ... 没有添加 ...');
define('WARNING_SPECIALS_PRE_ADD_DUPLICATE', '警告：该编号的商品已经有特价 ... 没有添加 ...');
define('WARNING_SPECIALS_PRE_ADD_BAD_PRODUCTS_ID', '警告: 商品编号不对 ... 没有添加 ...');
define('TEXT_INFO_HEADING_PRE_ADD_SPECIALS', '根据商品编号手工添加特价商品');
define('TEXT_INFO_PRE_ADD_INTRO', '如果数据库比较大，可以根据商品编号手工添加特价商品<br /><br />当商品很多，从页面的下拉菜单中选择商品不方便时，采用这种方式比较好。');
define('TEXT_PRE_ADD_PRODUCTS_ID', '请输入预添加的商品编号: ');
define('TEXT_INFO_MANUAL', '手工添加特价商品的编号');
?>