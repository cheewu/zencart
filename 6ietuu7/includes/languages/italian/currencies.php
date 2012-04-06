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
//  $Id: currencies.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '货币');

define('TABLE_HEADING_CURRENCY_NAME', '货币');
define('TABLE_HEADING_CURRENCY_CODES', '代码');
define('TABLE_HEADING_CURRENCY_VALUE', '汇率');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '请做必要修改');
define('TEXT_INFO_CURRENCY_TITLE', '标题:');
define('TEXT_INFO_CURRENCY_CODE', '代码:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', '左边符号:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', '右边符号:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', '小数点:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', '千分位:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', '小数位:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', '最后更新:');
define('TEXT_INFO_CURRENCY_VALUE', '值:');
define('TEXT_INFO_CURRENCY_EXAMPLE', '输出样本:');
define('TEXT_INFO_INSERT_INTRO', '请输入新货币和相关数据');
define('TEXT_INFO_DELETE_INTRO', '您确认要删除该货币吗?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', '新建货币');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', '编辑货币');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', '删除货币');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (需要手工更新币值)');
define('TEXT_INFO_CURRENCY_UPDATED', ' %s(%s)的汇率通过%s. 成功更新');

define('ERROR_REMOVE_DEFAULT_CURRENCY', '错误: 不能删除缺省货币. 请设置另一个货币为缺省值, 然后再试一次.');
define('ERROR_CURRENCY_INVALID', '错误: %s(%s)的汇率没有通过%s更新. 该货币代码正确吗?');
define('WARNING_PRIMARY_SERVER_FAILED', '警告: 主要汇率服务器(%s)无法更新%s(%s) - 试用第二汇率服务器.');
?>