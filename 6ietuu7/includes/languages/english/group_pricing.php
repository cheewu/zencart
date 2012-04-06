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
//  $Id: group_pricing.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '团体价格');

define('TABLE_HEADING_GROUP_ID', '编号');
define('TABLE_HEADING_GROUP_NAME', '团体名称');
define('TABLE_HEADING_GROUP_AMOUNT', '优惠百分比');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_PRICING_GROUP', '新建价格团体');
define('TEXT_HEADING_EDIT_PRICING_GROUP', '编辑价格团体');
define('TEXT_HEADING_DELETE_PRICING_GROUP', '删除价格团体');

define('TEXT_NEW_INTRO', '请填写下面的新团体资料');
define('TEXT_EDIT_INTRO', '请做必要的修改');
define('TEXT_DELETE_INTRO', '您确认要删除该团体吗?');
define('TEXT_DELETE_PRICING_GROUP', '删除价格团体');
define('TEXT_DELETE_WARNING_GROUP_MEMBERS','<b>警告:</b> 该分类中还有%s位客户!');

define('TEXT_GROUP_PRICING_NAME', '团体名称: ');
define('TEXT_GROUP_PRICING_AMOUNT', '优惠百分比: ');
define('TEXT_DATE_ADDED', '加入日期:');
define('TEXT_LAST_MODIFIED', '修改日期:');
define('TEXT_CUSTOMERS', '团体内客户:');

define('ERROR_GROUP_PRICING_CUSTOMERS_EXIST','错误: 该团体内有客户，请确认您想删除其中的客户及该团体。');
define('ERROR_MODULE_NOT_CONFIGURED','说明: 已经定义了团体价格，但还未打开团体价格模块。<br />请在 管理页面->模块管理->总额计算->会员优惠(ot_group_pricing)中安装/设置该模块。');

?>