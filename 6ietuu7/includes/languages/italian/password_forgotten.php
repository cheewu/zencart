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
// $Id: password_forgotten.php 4820 2006-10-23 07:19:46Z drbyte $
//

define('HEADING_TITLE', '重发密码');

define('TEXT_ADMIN_EMAIL', '管理员邮件: ');

define('ERROR_WRONG_EMAIL', '<p>你输入的电子邮件地址不正确。</p>');
define('ERROR_WRONG_EMAIL_NULL', '<p>再试一次 :-P</p>');
define('SUCCESS_PASSWORD_SENT', '<p>新的密码已经发到你的电子信箱。</p>');

define('TEXT_EMAIL_SUBJECT', '你的更改请求');
define('TEXT_EMAIL_FROM', 发送人);
define('TEXT_EMAIL_MESSAGE', '重设密码请求来自' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n" . '您在\'' . STORE_NAME . '\'的新密码是:' . "\n\n" . '   %s' . "\n\n用新密码登录后，可以在'工具->管理设置'下修改。");

?>