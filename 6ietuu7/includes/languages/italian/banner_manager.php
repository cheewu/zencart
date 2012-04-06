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
//  $Id: banner_manager.php 1132 2005-04-06 02:39:19Z ajeh $
//

define('HEADING_TITLE', '广告管理');

define('TABLE_HEADING_BANNERS', '广告');
define('TABLE_HEADING_GROUPS', '组别');
define('TABLE_HEADING_STATISTICS', '显示/点击');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS','新窗口');
define('TABLE_HEADING_BANNER_ON_SSL', '显示 SSL');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_BANNER_SORT_ORDER', '排序');

define('TEXT_BANNERS_TITLE', '广告标题:');
define('TEXT_BANNERS_URL', '广告URL:');
define('TEXT_BANNERS_GROUP', '广告组别:');
define('TEXT_BANNERS_NEW_GROUP', ', 或在下面输入新的广告组别');
define('TEXT_BANNERS_IMAGE', '图像:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', 或在下面输入本地文件');
define('TEXT_BANNERS_IMAGE_TARGET', '图像目标 (保存到):');
define('TEXT_BANNER_IMAGE_TARGET_INFO', '<strong>图像在服务器上的推荐路径:</strong> ' . DIR_FS_CATALOG_IMAGES . 'banners/');
define('TEXT_BANNERS_HTML_TEXT_INFO', '<strong>说明: HTML广告不计点击次数</strong>');
define('TEXT_BANNERS_HTML_TEXT', 'HTML文本:');
define('TEXT_BANNERS_ALL_SORT_ORDER', '排序顺序 - banner_box_all');
define('TEXT_BANNERS_ALL_SORT_ORDER_INFO', '<strong>说明: banners_box_all边框按照设定的顺序显示广告</strong>');
define('TEXT_BANNERS_EXPIRES_ON', '有效期:');
define('TEXT_BANNERS_OR_AT', ', 或在');
define('TEXT_BANNERS_IMPRESSIONS', '观看/查看.');
define('TEXT_BANNERS_SCHEDULED_AT', '生效日期:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>广告注释:</b><ul><li>广告不能同时使用图像和HTML文本.</li><li>HTML文本优先于图像</li><li>HTML文本不记录点击，只记录显示次数</li><li>不要在安全页面上显示绝对路径图像</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>图像注释:</b><ul><li>上传目录必须要有适当用户权限(可写)设置!</li><li>如果您没有上传图像到服务器, 不要填写 \'保存到\' 字段 (例如, 您使用本地 (服务器端) 图像).</li><li>该 \'保存到\' 字段必须是一个以/结尾的已有目录 (如, banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>有效期注释:</b><ul><li>只有发送两个字段中的一个</li><li>如果广告不是自动失效, 那么不要添这些字段</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>生效日期注释:</b><ul><li>如果设定了生效日期, 该广告将在相应日期激活.</li><li>所有广告在生效日期前标记为[等待中], 到期后将标记为[使用中].</li></ul>');
define('TEXT_BANNERS_STATUS', '广告状态:');
define('TEXT_BANNERS_ACTIVE', '使用中');
define('TEXT_BANNERS_NOT_ACTIVE', '等待中');
define('TEXT_INFO_BANNER_STATUS', '<strong>提示:</strong> 广告状态将按生效日期和显示更新');
define('TEXT_BANNERS_OPEN_NEW_WINDOWS', '广告新窗口');
define('TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>提示:</strong> 广告将在新窗口打开');
define('TEXT_BANNERS_ON_SSL', '带SSL的广告');
define('TEXT_INFO_BANNER_ON_SSL', '<strong>提示:</strong> 广告可以无误地显示在安全页面');

define('TEXT_BANNERS_DATE_ADDED', '加入日期:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', '生效日期: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', '有效期: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', '有效期: <b>%s</b> 显示');
define('TEXT_BANNERS_STATUS_CHANGE', '状态改变: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Last 3 Days');
define('TEXT_BANNERS_BANNER_VIEWS', '广告查看');
define('TEXT_BANNERS_BANNER_CLICKS', '广告点击');

define('TEXT_INFO_DELETE_INTRO', '您确认要删除该广告吗?');
define('TEXT_INFO_DELETE_IMAGE', '删除广告图像');

define('SUCCESS_BANNER_INSERTED', '成功: 广告增加了.');
define('SUCCESS_BANNER_UPDATED', '成功: 广告更新了.');
define('SUCCESS_BANNER_REMOVED', '成功: 广告删除了.');
define('SUCCESS_BANNER_STATUS_UPDATED', '成功: 广告状态更新了.');

define('ERROR_BANNER_TITLE_REQUIRED', '错误: 需要广告名称.');
define('ERROR_BANNER_GROUP_REQUIRED', '错误: 需要广告组.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', '错误: 目标目录不存在: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', '错误: 目标目录不可写: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', '错误: 图像不存在.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', '错误: 不能删除图像.');
define('ERROR_UNKNOWN_STATUS_FLAG', '错误: 未知状态标记.');
define('ERROR_BANNER_IMAGE_REQUIRED', '错误: 需要广告图像.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', '错误: 图像目录不存在. 请建立一个图像目录 例如: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', '错误: 图像目录不可写. 位于: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');

define('TEXT_LEGEND_BANNER_ON_SSL', '显示SSL');
define('TEXT_LEGEND_BANNER_OPEN_NEW_WINDOWS', '新窗口');

// Tooltip Text for images in Banner Manager
define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_ON','开新窗口 - 开启');
define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_OFF','开新窗口 - 关闭');
define('IMAGE_ICON_BANNER_ON_SSL_ON','在安全页面显示 - 开启');
define('IMAGE_ICON_BANNER_ON_SSL_OFF','在安全页面显示 - 关闭');

define('SUCCESS_BANNER_OPEN_NEW_WINDOW_UPDATED', '成功: 在新窗口中打开的广告状态已更新。');
define('SUCCESS_BANNER_ON_SSL_UPDATED', '成功: 在安全页面上显示的广告状态已更新。');
?>