<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
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
//  $Id: layout_controller.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '栏目方框');

define('TABLE_HEADING_LAYOUT_BOX_NAME', '栏目文件名称');
define('TABLE_HEADING_LAYOUT_BOX_STATUS', '左/右 栏目<br />状态');
define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE', '单栏<br />状态');
define('TABLE_HEADING_LAYOUT_BOX_LOCATION', '左 或 右<br />栏目');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER', '左/右 栏目<br />排序');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE', '单栏<br />排序');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '请做必要修改');
define('TEXT_INFO_LAYOUT_BOX','选择方框: ');
define('TEXT_INFO_LAYOUT_BOX_NAME', '方框名称:');
define('TEXT_INFO_LAYOUT_BOX_LOCATION','位置: (单栏忽略该设置)');
define('TEXT_INFO_LAYOUT_BOX_STATUS', '左/右 栏目状态: ');
define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE', '单栏状态: ');
define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','开= 1 关=0');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER', '左/右 栏目排序:');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE', '单栏排序:');
define('TEXT_INFO_INSERT_INTRO', '请输入新的方框和相关数据');
define('TEXT_INFO_DELETE_INTRO', '您确认要删除该方框吗?');
define('TEXT_INFO_HEADING_NEW_BOX', '新建方框');
define('TEXT_INFO_HEADING_EDIT_BOX', '编辑方框');
define('TEXT_INFO_HEADING_DELETE_BOX', '删除方框');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','从模板列表上删除丢失的方框: ');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','注意: 这不会删除文件, 您可以在任何时候把它加入正确目录以重新添加方框.<br /><br /><strong>Delete 方框名称: </strong>');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','用该缺省模板的排序重置所有方框: ');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','这不会删除任何方框. 只会重置当前排序');
define('TEXT_INFO_BOX_DETAILS','方框详情: ');

////////////////

define('HEADING_TITLE_LAYOUT_TEMPLATE', '网站模板外观');

define('TABLE_HEADING_LAYOUT_TITLE', '标题');
define('TABLE_HEADING_LAYOUT_VALUE', '值');
define('TABLE_HEADING_ACTION', '操作');


define('TEXT_MODULE_DIRECTORY', '网站外观目录:');
define('TEXT_INFO_DATE_ADDED', '加入日期:');
define('TEXT_INFO_LAST_MODIFIED', '最后修改:');

// layout box text in includes/boxes/layout.php
define('BOX_HEADING_LAYOUT', '外观');
define('BOX_LAYOUT_COLUMNS', '栏目控制');

// file exists
define('TEXT_GOOD_BOX',' ');
define('TEXT_BAD_BOX','<font color="ff0000"><b>缺少</b></font><br />');


// Success message
define('SUCCESS_BOX_DELETED','成功从方框模板删除: ');
define('SUCCESS_BOX_RESET','成功重置所有方框设置为缺省值: ');
define('SUCCESS_BOX_UPDATED','成功更新方框设置: ');

define('TEXT_ON',' 开 ');
define('TEXT_OFF',' 关 ');
define('TEXT_LEFT',' 左 ');
define('TEXT_RIGHT',' 右 ');

?>