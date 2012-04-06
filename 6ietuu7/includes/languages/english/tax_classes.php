<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tax_classes.php 7167 2007-10-03 23:02:17Z drbyte $
 */

define('HEADING_TITLE', '税率种类');

define('TABLE_HEADING_TAX_CLASS_ID', '编号');
define('TABLE_HEADING_TAX_CLASSES', '税率种类');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '请做必要修改');
define('TEXT_INFO_CLASS_TITLE', '税率种类名称:');
define('TEXT_INFO_CLASS_DESCRIPTION', '简介:');
define('TEXT_INFO_DATE_ADDED', '添加的日期:');
define('TEXT_INFO_LAST_MODIFIED', '最后修改:');
define('TEXT_INFO_INSERT_INTRO', '请输入新税种及其相关数据');
define('TEXT_INFO_DELETE_INTRO', '你肯定要删除该税种吗?');
define('TEXT_INFO_HEADING_NEW_TAX_CLASS', '新建税种');
define('TEXT_INFO_HEADING_EDIT_TAX_CLASS', '编辑税种');
define('TEXT_INFO_HEADING_DELETE_TAX_CLASS', '删除税种');
define('ERROR_TAX_RATE_EXISTS_FOR_CLASS', '错误: 不能删除该税率种类 -- 有税率定义在本税率种类下。');
define('ERROR_TAX_RATE_EXISTS_FOR_PRODUCTS', '错误: 不能删除该税率 -- 有%s件商品链接到本税率下。');
?>