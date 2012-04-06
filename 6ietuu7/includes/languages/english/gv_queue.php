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
//  $Id: gv_queue.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', TEXT_GV_NAME . '释放队列');

define('TABLE_HEADING_CUSTOMERS', '客户');
define('TABLE_HEADING_ORDERS_ID', '订单号: ');
define('TABLE_HEADING_VOUCHER_VALUE', TEXT_GV_NAME . '金额');
define('TABLE_HEADING_DATE_PURCHASED', '购买日期');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_REDEEM_GV_MESSAGE_HEADER', '您最近从我们的网上商店购买了一份' . TEXT_GV_NAME . '。');
define('TEXT_REDEEM_GV_MESSAGE_RELEASED', '基于安全考虑，该金额没有立即生效。' .
                                          '现在该金额已经生效。您可以访问我们的网站并通过电子邮件发送该' . TEXT_GV_NAME . '给别人，也可以自己使用。' . "\n\n"
                                          );

define('TEXT_REDEEM_GV_MESSAGE_AMOUNT', '该' . TEXT_GV_NAME . '金额%s');
define('TEXT_REDEEM_GV_MESSAGE_THANKS', '谢谢您在我们的网站购物!');

define('TEXT_REDEEM_GV_MESSAGE_BODY', '');
define('TEXT_REDEEM_GV_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_GV_SUBJECT', '购买' . TEXT_GV_NAME);
define('TEXT_REDEEM_GV_SUBJECT_ORDER','订单号');

define('TEXT_EDIT_ORDER','编辑订单号');
define('TEXT_GV_NONE','没有' . TEXT_GV_NAME . '可释放');
?>