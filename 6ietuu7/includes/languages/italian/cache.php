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
//  $Id: cache.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '缓存控制');

define('TABLE_HEADING_CACHE', '缓存块');
define('TABLE_HEADING_DATE_CREATED', '建立日期');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_FILE_DOES_NOT_EXIST', '文件不存在');
define('TEXT_CACHE_DIRECTORY', '缓存目录:');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', '错误: 缓存目录不存在. 请在这里设置 配置->缓存.');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', '错误: 缓存目录不可写.');
?>