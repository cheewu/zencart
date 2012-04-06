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
/// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
// $Id: define_pages_editor.php 296 2004-09-16 19:48:05Z ajeh $
//

define('HEADING_TITLE', '页面编辑: ');
define('NAVBAR_TITLE', '页面编辑');

define('TEXT_INFO_EDIT_PAGE', '选择要编辑的页面:');

define('TEXT_INFO_MAIN_PAGE', '首页');

define('TEXT_INFO_SHIPPINGINFO', '发货付款');
define('TEXT_INFO_PRIVACY', '隐私声明');
define('TEXT_INFO_CONDITIONS', '顾客须知');
define('TEXT_INFO_CONTACT_US', '联系我们');
define('TEXT_INFO_CHECKOUT_SUCCESS', '结账完成');

define('TEXT_INFO_PAGE_2', '第2页');
define('TEXT_INFO_PAGE_3', '第3页');
define('TEXT_INFO_PAGE_4', '第4页');

define('TEXT_FILE_DOES_NOT_EXIST', '文件不存在: %s');

define('ERROR_FILE_NOT_WRITEABLE', '错误: 无法写入该文件. 请设置正确的用户权限: %s');

define('TEXT_INFO_SELECT_FILE', '选择要编辑的文件 ...');
define('TEXT_INFO_EDITING', '正在编辑的文件:');

define('TEXT_INFO_CAUTION','注意: 你应该编辑位于当前模板目录中的文件, 例如: /languages/' . $_SESSION['language'] . '/html_includes/' . $template_dir . '<br />切记在修改文件后做好备份.');
?>