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
//  $Id: admin.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '管理设置');

define('TABLE_HEADING_ADMINS_NAME', '管理员姓名');
define('TABLE_HEADING_ADMINS_ID', '编号');
define('TABLE_HEADING_ADMINS_EMAIL', '电子邮件');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_ADMIN', '新建');
define('TEXT_HEADING_EDIT_ADMIN', '编辑');
define('TEXT_HEADING_DELETE_ADMIN', '删除');
define('TEXT_HEADING_RESET_PASSWORD', '重置密码');

define('TEXT_ADMINS', '管理员:');
define('TEXT_ADMINS_EMAIL', '电子邮件:');

define('TEXT_NEW_INTRO', '请填写以下关于新管理员的信息');
define('TEXT_EDIT_INTRO', '请做必要的修改');

define('TEXT_ADMINS_NAME', '管理员姓名:');
define('TEXT_ADMINS_PASSWORD', '密码:');
define('TEXT_ADMINS_CONFIRM_PASSWORD', '确认密码:');

define('TEXT_DELETE_INTRO', '您确定要删除该管理员吗?');
define('TEXT_DELETE_IMAGE', '删除管理员图像?');


define('ENTRY_PASSWORD_NEW_ERROR', '您新的密码至少要有 ' . ENTRY_PASSWORD_MIN_LENGTH . ' 个字符.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', '密码必须一致.');

define('TEXT_ADMINS_LEVEL','该帐号的管理员级别:');
define('TEXT_ADMIN_LEVEL_INSTRUCTIONS','将管理员级别设为1将允许该帐号重置管理演示模式功能. 只有级别为1的帐号可以在管理演示模式下修改管理员登录和密码.');
define('TEXT_ADMIN_DEMO','管理演示模式将管理从全部功能转为部分功能, 当您设定演示版时, 可以降低破坏性. 只有级别为1的管理员可以修改该设置并且可以设置在管理演示模式下也具备全部功能的管理帐号.<br />在激活该功能时, 确认已经设置了级别为0的演示帐号.');
define('TEXT_DEMO_STATUS','当前管理演示模式设定为:');
define('TEXT_DEMO_OFF','关闭');
define('TEXT_DEMO_ON','打开');
?>