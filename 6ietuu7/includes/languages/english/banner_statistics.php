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
//  $Id: banner_statistics.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '广告统计');

define('TABLE_HEADING_SOURCE', '来源');
define('TABLE_HEADING_VIEWS', '查看');
define('TABLE_HEADING_CLICKS', '点击');

define('TEXT_BANNERS_DATA', '数<br>据<br>数<br>据');
define('TEXT_BANNERS_DAILY_STATISTICS', '%s 按日统计的 %s %s');
define('TEXT_BANNERS_MONTHLY_STATISTICS', '%s 按月统计的 %s');
define('TEXT_BANNERS_YEARLY_STATISTICS', '%s 按年统计的');

define('STATISTICS_TYPE_DAILY', '每日');
define('STATISTICS_TYPE_MONTHLY', '每月');
define('STATISTICS_TYPE_YEARLY', '每年');

define('TITLE_TYPE', '类型:');
define('TITLE_YEAR', '年:');
define('TITLE_MONTH', '月:');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', '错误: 图像目录不存在. 请建立一个图像目录 例如: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', '错误: 错误: 图像目录不可写. 位于: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
?>