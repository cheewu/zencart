<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: media_manager.php 4873 2006-11-02 09:12:46Z drbyte $
//

define('HEADING_TITLE_MEDIA_MANAGER', '媒体管理');

define('TABLE_HEADING_MEDIA', '片断名称');
define('TABLE_HEADING_ACTION', '操作');
define('TEXT_HEADING_NEW_MEDIA_COLLECTION', '新媒体片断');
define('TEXT_NEW_INTRO', '请在下面输入新媒体片断的详情');
define('TEXT_MEDIA_COLLECTION_NAME', '媒体片断名称');
define('TEXT_MEDIA_EDIT_INSTRUCTIONS', '使用上面的部分修改媒体片断名称, 然后点击保存按钮。<br /><br />
                                        使用下面的部分在添加或删除媒体片断.');
define('TEXT_DATE_ADDED', '加入日期:');
define('TEXT_LAST_MODIFIED', '最后修改:');
define('TEXT_PRODUCTS', '链接商品:');
define('TEXT_CLIPS', '链接片断:');
define('TEXT_NO_PRODUCTS', '该分类中没有商品');
define('TEXT_HEADING_EDIT_MEDIA_COLLECTION', '修改媒体片断');
define('TEXT_EDIT_INTRO', '请在下面修改媒体片断');
define('TEXT_HEADING_DELETE_MEDIA_COLLECTION', '删除媒体片断');
define('TEXT_DELETE_INTRO', '您要删除该媒体片断吗?');
  define('TEXT_DISPLAY_NUMBER_OF_MEDIA', '显示<strong>%d</strong>到<strong>%d</strong> (共<strong>%d</strong>个媒体片断)');
define('TEXT_ADD_MEDIA_CLIP', '添加媒体片断');
define('TEXT_MEDIA_CLIP_DIR', '上传到媒体目录');
define('TEXT_MEDIA_CLIP_TYPE', '媒体片断类型');
define('TEXT_HEADING_ASSIGN_MEDIA_COLLECTION', '指定媒体收集到商品');
define('TEXT_PRODUCTS_INTRO', '您可以用下面的表格指定或删除该媒体收集给商品.');
define('IMAGE_PRODUCTS', '指定给商品');
define('TEXT_DELETE_PRODUCTS', '删除该媒体收集和所有链接条目?');
define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>警告:</strong> 共有%s个条目还链接在该媒体片断上!');
define('TEXT_WARNING_FOLDER_UNWRITABLE', '说明: 媒体目录' . DIR_FS_CATALOG_MEDIA . '不可写，无法上传文件。');

define('ERROR_UNKNOWN_DATA', '错误: 未知数据 ... 操作取消');
define('TEXT_ADD','增加');


?>