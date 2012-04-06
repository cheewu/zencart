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
//  $Id: ezpages.php 2827 2006-01-08 19:46:40Z ajeh $
//
define('HEADING_TITLE', '简易页面管理');
define('TABLE_HEADING_PAGES', '页眉标题');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_VSORT_ORDER', '边框顺序');
define('TABLE_HEADING_HSORT_ORDER', '页脚顺序');
define('TEXT_PAGES_TITLE', '页面标题:');
define('TEXT_PAGES_HTML_TEXT', 'HTML内容:');
define('TABLE_HEADING_DATE_ADDED', '加入日期:');
define('TEXT_PAGES_STATUS_CHANGE', '状态改变: %s');
define('TEXT_INFO_DELETE_INTRO', '你确定要删除本页吗?');
define('SUCCESS_PAGE_INSERTED', '成功: 本页已经插入.');
define('SUCCESS_PAGE_UPDATED', '成功: 本页已经更新.');
define('SUCCESS_PAGE_REMOVED', '成功: 本页已经删除.');
define('SUCCESS_PAGE_STATUS_UPDATED', '成功: 本页状态已经更新.');
define('ERROR_PAGE_TITLE_REQUIRED', '错误: 需要页面标题.');
define('ERROR_UNKNOWN_STATUS_FLAG', '错误: 未知状态标签.');
define('ERROR_MULTIPLE_HTML_URL', '错误: 每个链接只允许定义一个设置 ...<br />只要定义其中一项: HTML内容 -或- 内部链接URL -或- 外部链接URL');

define('TABLE_HEADING_ID', '账号');
define('TABLE_HEADING_STATUS_HEADER', '页眉:');
define('TABLE_HEADING_STATUS_SIDEBOX', '边框:');
define('TABLE_HEADING_STATUS_FOOTER', '页脚:');
define('TABLE_HEADING_STATUS_TOC', 'TOC:');
define('TABLE_HEADING_CHAPTER', '章节:');

define('TABLE_HEADING_PAGE_OPEN_NEW_WINDOW', '打开新窗口:');
define('TABLE_HEADING_PAGE_IS_SSL', '页面是SSL:');

define('TEXT_DISPLAY_NUMBER_OF_PAGES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>页)');
define('IMAGE_NEW_PAGE', '新页面');
define('TEXT_INFO_PAGE_IMAGE', '图像');
define('TEXT_INFO_CURRENT_IMAGE', '当前图像:');
define('TEXT_INFO_PAGES_ID', '账号: ');
define('TEXT_INFO_PAGES_ID_SELECT', '选择一个页面 ...');

define('TEXT_HEADER_SORT_ORDER', '排序:');
define('TEXT_SIDEBOX_SORT_ORDER', '排序:');
define('TEXT_FOOTER_SORT_ORDER', '排序:');
define('TEXT_TOC_SORT_ORDER', '排序:');
define('TEXT_CHAPTER', '前/后 章节:');
define('TABLE_HEADING_CHAPTER_PREV_NEXT', '章节:&nbsp;<br />');

define('TEXT_HEADER_SORT_ORDER_EXPLAIN', '页眉排序用于编辑页面时控制页眉的顺序，数字应大于0，以便使本页在列表中出现');
define('TEXT_SIDEBOX_ORDER_EXPLAIN', '边框排序用于垂直方向上的顺序，数字应大于0，以便能在垂直列表中出现，另外也可用于HTML文本');
define('TEXT_FOOTER_ORDER_EXPLAIN', '页脚排序用于编辑页面时控制页脚的顺序，数字应大于0，以便使本页在列表中出现');
define('TEXT_TOC_SORT_ORDER_EXPLAIN', 'TOC排序用于编辑页面时根据每页不同，定义水平方向或者垂直方向，数字应大于0，以便使页面在列表中出现');
define('TEXT_CHAPTER_EXPLAIN', '章节和TOC排序一起显示前/后链接，TOC中的链接包含页面号码，显示于TOC排序中');

define('TEXT_ALT_URL', '内部链接地址:');
define('TEXT_ALT_URL_EXPLAIN', '忽略HTML内容，采用内部链接地址<br />评论的链接示例: index.php?main_page=reviews<br />我的账号的链接示例: index.php?main_page=account 并设置为SSL');

define('TEXT_ALT_URL_EXTERNAL', '外部链接地址:');
define('TEXT_ALT_URL_EXTERNAL_EXPLAIN', '忽略HTML内容，采用外部链接地址<br />外部链接示例: http://www.zen-cart.cn');

define('TEXT_SORT_CHAPTER_TOC_TITLE_INFO', '显示顺序: ');
define('TEXT_SORT_CHAPTER_TOC_TITLE', '章节/TOC');
define('TEXT_SORT_HEADER_TITLE', '页眉');
define('TEXT_SORT_SIDEBOX_TITLE', '边框');
define('TEXT_SORT_FOOTER_TITLE', '页脚');
define('TEXT_SORT_PAGE_TITLE', '页面标题');
define('TEXT_SORT_PAGE_ID_TITLE', '页面ID, 标题');

define('TEXT_PAGE_TITLE', '标题:');
define('TEXT_WARNING_MULTIPLE_SETTINGS', '<strong>警告: 多链接定义</strong>');
?>
