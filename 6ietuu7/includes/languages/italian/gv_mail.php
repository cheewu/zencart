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
//  $Id: gv_mail.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '发送 ' . TEXT_GV_NAME . ' 给客户');

define('TEXT_CUSTOMER', '客户:');
define('TEXT_SUBJECT', '主题:');
define('TEXT_FROM', '来自:');
define('TEXT_TO', '发给:');
define('TEXT_AMOUNT', '金额');
define('TEXT_MESSAGE', '文本格式<br />的内容:');
define('TEXT_RICH_TEXT_MESSAGE', 'HTML格式<br />的内容:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">在这里输入单个电子邮件地址，否则使用上面的下拉菜单</span>');
define('TEXT_SELECT_CUSTOMER', '选择客户');
define('TEXT_ALL_CUSTOMERS', '所有客户');
define('TEXT_NEWSLETTER_CUSTOMERS', '给所有电子商情订阅者');

define('NOTICE_EMAIL_SENT_TO', '提示: 电子邮件发给: %s');
define('ERROR_NO_CUSTOMER_SELECTED', '错误: 没有选择客户.');
define('ERROR_NO_AMOUNT_SELECTED', '错误: 没有选择金额。');
define('ERROR_NO_SUBJECT', '错误: 没有输入主题。');
define('ERROR_GV_AMOUNT', '请定义金额为无符号数值。例如: 25.00');

define('TEXT_GV_ANNOUNCE','<font color="#0000ff">我们很高兴给您寄上一张' . TEXT_GV_NAME . '</font>');
define('TEXT_GV_WORTH', '该' . TEXT_GV_NAME . '的金额为');
define('TEXT_TO_REDEEM', '要兑现该' . TEXT_GV_NAME . '，请点击下面的链接。请记下' . TEXT_GV_REDEEM);
define('TEXT_WHICH_IS', '为');
define('TEXT_IN_CASE', '，以备查询。');
define('TEXT_OR_VISIT', '或访问');
define('TEXT_ENTER_CODE', '，在结帐时输入代码。');
define('TEXT_CLICK_TO_REDEEM','点击这里兑现');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', '您最近从我们网站购买了' . TEXT_GV_NAME . '，出于安全考虑，该' . TEXT_GV_NAME . '的金额没有立即生效，现在礼券已经生效了。');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . '该' . TEXT_GV_NAME . '的金额原来是%s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . '您可以访问我们的网站，登录后发送' . TEXT_GV_NAME . '给任何人。');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>