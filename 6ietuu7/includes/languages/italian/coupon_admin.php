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
//  $Id: coupon_admin.php 5758 2007-02-08 01:39:34Z ajeh $
//

define('TOP_BAR_TITLE', '统计');
define('HEADING_TITLE', '优惠券');
define('HEADING_TITLE_STATUS', '状态 : ');
define('TEXT_CUSTOMER', '客户:');
define('TEXT_COUPON', '优惠券名称:');
define('TEXT_COUPON_ALL', '所有优惠券');
define('TEXT_COUPON_ACTIVE', '有效的优惠券');
define('TEXT_COUPON_INACTIVE', '失效的优惠券');
define('TEXT_SUBJECT', '标题:');
define('TEXT_UNLIMITED', '无限制');
define('TEXT_FROM', '来自:');
define('TEXT_FREE_SHIPPING', '免运费');
define('TEXT_MESSAGE', '文本格式内容:');
define('TEXT_RICH_TEXT_MESSAGE','HTML格式内容:');
define('TEXT_SELECT_CUSTOMER', '选择客户');
define('TEXT_ALL_CUSTOMERS', '所有客户');
define('TEXT_NEWSLETTER_CUSTOMERS', '给所有电子商情订阅者');
define('TEXT_CONFIRM_DELETE', '您确认要删除该优惠券吗？');
define('TEXT_SEE_RESTRICT', '有限制');

define('TEXT_COUPON_ANNOUNCE','很乐意给您提供一份商店优惠券');

define('TEXT_TO_REDEEM', '您可以在结帐时兑现该优惠券。只要在对话框里输入代码，然后点击兑现按钮。');
define('TEXT_IN_CASE', ' 以防万一。');
define('TEXT_VOUCHER_IS', '该优惠券代码是');
define('TEXT_REMEMBER', '不要丢失该优惠券代码，请妥善包管该代码以获得该特殊优惠。');
define('TEXT_VISIT', '访问这里%s');
define('TEXT_ENTER_CODE', '并输入代码');
define('TEXT_COUPON_HELP_DATE', '<p><p>优惠券有效期为%s至%s</p></p>');
define('HTML_COUPON_HELP_DATE', '<p><p>优惠券有效期为%s至%s</p></p>');

define('TABLE_HEADING_ACTION', '操作');

define('CUSTOMER_ID', '客户编号');
define('CUSTOMER_NAME', '客户姓名');
define('REDEEM_DATE', '兑现日期');
define('IP_ADDRESS', 'IP地址');

define('TEXT_REDEMPTIONS', '兑现');
define('TEXT_REDEMPTIONS_TOTAL', '总额');
define('TEXT_REDEMPTIONS_CUSTOMER', '该客户');
define('TEXT_NO_FREE_SHIPPING', '没有免运费');

define('NOTICE_EMAIL_SENT_TO', '通知: 电子邮件发给: %s');
define('ERROR_NO_CUSTOMER_SELECTED', '错误: 没有选择客户。');
define('ERROR_NO_SUBJECT', '错误: 没有输入标题。');

define('COUPON_NAME', '优惠券名称');
//define('COUPON_VALUE', '优惠券金额');
define('COUPON_AMOUNT', '优惠券金额');
define('COUPON_CODE', '优惠券代码');
define('COUPON_STARTDATE', '生效日');
define('COUPON_FINISHDATE', '到期日');
define('COUPON_FREE_SHIP', '免运费');
define('COUPON_DESC', '优惠券简介<br />(客户可见)');
define('COUPON_MIN_ORDER', '优惠券最小订单');
define('COUPON_USES_COUPON', '每优惠券使用');
define('COUPON_USES_USER', '每客户使用');
define('COUPON_PRODUCTS', '可用商品列表');
define('COUPON_CATEGORIES', '可用分类列表');
define('VOUCHER_NUMBER_USED', '使用数量');
define('DATE_CREATED', '创建日期');
define('DATE_MODIFIED', '修改日期');
define('TEXT_HEADING_NEW_COUPON', '建立新优惠券');
define('TEXT_NEW_INTRO', '请填写以下内容<br />');
define('COUPON_ZONE_RESTRICTION', '优惠券有效地区: ');
define('TEXT_COUPON_ZONE_RESTRICTION', '优惠券有效地区是可选项。');

define('ERROR_NO_COUPON_AMOUNT', '没有输入优惠券金额');
define('ERROR_NO_COUPON_NAME', '没有输入优惠券名称');
define('ERROR_COUPON_EXISTS', '存在相同代码的优惠券');


define('COUPON_NAME_HELP', '优惠券的简称');
define('COUPON_AMOUNT_HELP', '该优惠券的金额，可以是固定金额或者在最后加上%表示百分比。');
define('COUPON_CODE_HELP', '您可以在这里输入自己的代码，或者留空以自动生成。');
define('COUPON_STARTDATE_HELP', '优惠券生效日期');
define('COUPON_FINISHDATE_HELP', '优惠券有效期');
define('COUPON_FREE_SHIP_HELP', '该优惠券可以免运费。提示: 将覆盖优惠券金额但还要求最小订单金额');
define('COUPON_DESC_HELP', '给客户的优惠券简介');
define('COUPON_MIN_ORDER_HELP', '该优惠券适用的最小订单金额');
define('COUPON_USES_COUPON_HELP', '该优惠券可使用的最大次数，如果没限制留空。');
define('COUPON_USES_USER_HELP', '同一用户可使用该优惠券的次数，如果没限制留空。');
define('COUPON_PRODUCTS_HELP', '对该优惠券有效的用逗号分开的商品编号，如果没限制留空。');
define('COUPON_CATEGORIES_HELP', '对该优惠券有效的用逗号分开的商品分类，如果没限制留空。');
define('COUPON_BUTTON_PREVIEW', '预览');
define('COUPON_BUTTON_CONFIRM', '确认');
define('COUPON_BUTTON_BACK', '返回');

define('COUPON_ACTIVE', '状态');
define('COUPON_START_DATE', '开始日期');
define('COUPON_EXPIRE_DATE', '有效日期');

define('ERROR_DISCOUNT_COUPON_WELCOME', '不能禁用本优惠券，该优惠券是欢迎优惠券<br /><br />在删除前请修改欢迎优惠券。见管理页面->商店设置->礼券和优惠券');
define('SUCCESS_COUPON_DISABLED', '成功！优惠券已禁用 ...');
define('TEXT_COUPON_NEW', '使用新的优惠券代码:');
define('ERROR_DISCOUNT_COUPON_DUPLICATE', '警告！存在相同的优惠券 ... 取消复制优惠券代码: ');
define('TEXT_CONFIRM_COPY', '您确认要复制该优惠券到另一个优惠券吗？');
define('SUCCESS_COUPON_DUPLICATE', '成功复制优惠券 ...<br /><br />请检查优惠券名称和日期 ...');

?>