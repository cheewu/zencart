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
//  $Id: options_name_manager.php 963 2005-02-03 00:41:31Z drbyte $
//

define('HEADING_TITLE_OPT', '商品选项');
define('HEADING_TITLE_VAL', '选项内容');
define('HEADING_TITLE_ATRIB', '商品属性');

define('TABLE_HEADING_ID', '编号');
define('TABLE_HEADING_PRODUCT', '商品名称');
define('TABLE_HEADING_OPT_NAME', '选项名称');
define('TABLE_HEADING_OPT_VALUE', '选项内容');
define('TABLE_HEADING_OPT_PRICE', '价格');
define('TABLE_HEADING_OPT_PRICE_PREFIX', '前缀');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_DOWNLOAD', '可下载商:');
define('TABLE_TEXT_FILENAME', '文件名:');
define('TABLE_TEXT_MAX_DAYS', '有效至:');
define('TABLE_TEXT_MAX_COUNT', '最大下载计数:');

define('TEXT_WARNING_OF_DELETE', '该选项有商品和内容链接 - 不能安全删除');
define('TEXT_OK_TO_DELETE', '该选项没有商品和内容链接 - 可以安全删除.<br />提醒: 该选项名下的所有选项值也将被删除');
define('TEXT_OPTION_ID', '选项编号');
define('TEXT_OPTION_NAME', '选项名称');
define('TABLE_HEADING_OPT_DISCOUNTED','有优惠');

define('ATTRIBUTE_WARNING_DUPLICATE','重复属性 - 属性没有加入'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','存在重复属性 - 属性没有改变'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_INVALID_MATCH','属性选项和选项内容不匹配 - 属性没有加入'); // miss matched option and options value
define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','属性选项和选项内容不匹配 - 属性没有改变'); // miss matched option and options value
define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','加入的选项名称可能重复'); // Options Name Duplicate warning
define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','加入的选项内容可能重复'); // Options Value Duplicate warning

define('PRODUCTS_ATTRIBUTES_EDITING','修改属性'); // title
define('PRODUCTS_ATTRIBUTES_DELETE','删除属性'); // title
define('PRODUCTS_ATTRIBUTES_ADDING','增加属性'); // title
define('TEXT_DOWNLOADS_DISABLED','提示: 下载关闭');

define('TABLE_TEXT_MAX_DAYS_SHORT', '天数:');
define('TABLE_TEXT_MAX_COUNT_SHORT', '最多:');

  define('TABLE_HEADING_OPTION_SORT_ORDER','排序');
  define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','缺省排序');
  define('TEXT_SORT',' 排序: ');

  define('TABLE_HEADING_OPT_WEIGHT_PREFIX','前缀');
  define('TABLE_HEADING_OPT_WEIGHT','重量');
  define('TABLE_HEADING_OPT_SORT_ORDER','排序');
  define('TABLE_HEADING_OPT_DEFAULT','缺省');

  define('TABLE_HEADING_YES','是');
  define('TABLE_HEADING_NO','否');

  define('TABLE_HEADING_OPT_TYPE', '类型'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','宽度');
  define('TABLE_HEADING_OPTION_VALUE_MAX','最大');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','行');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','注释');

  define('TEXT_OPTION_VALUE_COMMENTS','注释: ');
  define('TEXT_OPTION_VALUE_ROWS', '行数: ');
  define('TEXT_OPTION_VALUE_SIZE','宽度: ');
  define('TEXT_OPTION_VALUE_MAX','长度: ');

  define('TEXT_ATTRIBUTES_IMAGE','属性图像样本:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','属性图像目录:');

  define('TEXT_ATTRIBUTES_FLAGS','属性<br />标记:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', '只用于<br />显示用途:');
  define('TEXT_ATTRIBUTES_IS_FREE', '属性是免费的<br />当商品免费时:');
  define('TEXT_ATTRIBUTES_DEFAULT', '缺省属性<br />标记为已选择:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', '应用相同优惠 <br />(按商品)');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','包含在基价<br />(如果以属性定价)');

  define('TEXT_PRODUCT_OPTIONS_INFO','<strong>说明: 编辑商品选项名称的其它设置</strong>');

// updates
define('ERROR_PRODUCTS_OPTIONS_VALUES', '警告: 没有找到商品 ... 没有更新');

define('TEXT_SELECT_PRODUCT', ' 选择一个商品');
define('TEXT_SELECT_CATEGORY', ' 选择一个分类');
define('TEXT_SELECT_OPTION', '选项名称');

// add
define('TEXT_OPTION_VALUE_ADD_ALL', '<br /><strong>添加该选项的所有选项内容到所有商品</strong>');
define('TEXT_INFO_OPTION_VALUE_ADD_ALL', '更新至少有一个选项内容的的所有现存商品且删除在一个选项名称下的所有选项内容');
define('SUCCESS_PRODUCTS_OPTIONS_VALUES', '更新选项成功');

define('TEXT_OPTION_VALUE_ADD_PRODUCT', '<br /><strong>添加该选项的所有选项内容到一个商品</strong>');
define('TEXT_INFO_OPTION_VALUE_ADD_PRODUCT', '更新至少有一个选项内容的一个商品 并且在一个选项名称里添加所有选项内容');

define('TEXT_OPTION_VALUE_ADD_CATEGORY', '<br /><strong>添加该选项的所有选项内容到一个分类</strong>');
define('TEXT_INFO_OPTION_VALUE_ADD_CATEGORY', '更新商品的一个分类, 要求该商品至少有一个选项内容且所有选项内容在一个选项名称里');

define('TEXT_COMMENT_OPTION_VALUE_ADD_ALL', '<strong>备注:</strong> 这些商品的排序将按照缺省的选项内容排序设定');

// delete
define('TEXT_OPTION_VALUE_DELETE_ALL', '<br /><strong>删除所有商品中该选项的所有选项内容</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', '更新所有现存的至少有一个选项内容的商品且删除所有在一个选项名称里的选项内容');

define('TEXT_OPTION_VALUE_DELETE_PRODUCT', '<br /><strong>删除一个商品中该选项的所有选项内容</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_PRODUCT', '更新至少有一个选项内容的一个商品且删除所有选项内容自选项名称');

define('TEXT_OPTION_VALUE_DELETE_CATEGORY', '<br /><strong>删除一个分类中该选项的所有选项内容</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_CATEGORY', '更新一个商品分类, 要求该商品至少有一个选项内容且删除所有在一个选项名称里的选项内容');

define('TEXT_COMMENT_OPTION_VALUE_DELETE_ALL', '<strong>备注:</strong> 选定商品的所有选项名称选项内容都将删除. 这不会删除选项内容设置.');

define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>复制所有选项内容到另一个选项名称下</strong>');
define('TEXT_INFO_OPTION_VALUE_COPY_ALL', '所有选项内容将从一个选项名称下复制到另一选项名称下');
define('TEXT_SELECT_OPTION_FROM', '从该选项复制: ');
define('TEXT_SELECT_OPTION_TO', '复制所有选项内容到: ');
define('SUCCESS_OPTION_VALUES_COPIED', '成功复制! ');
define('ERROR_OPTION_VALUES_COPIED', '错误 - 不能复制选项内容到相同的选项名称下! ');
define('ERROR_OPTION_VALUES_NONE', '错误 - 要复制的选项名称下没有定义内容. 没有复制任何东西! ');
define('TEXT_WARNING_BACKUP', '警告: 在做全局修改时, 请备份好您的数据库');

define('TEXT_OPTION_ATTRIBUTE_IMAGES_PER_ROW', '每行属性图像: ');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE', '单选按钮/校验钮 属性风格: ');
define('TEXT_OPTION_ATTIBUTE_MAX_LENGTH', '<strong>文本属性的行数、显示宽度和最大长度:</strong><br />');
define('TEXT_OPTION_IMAGE_STYLE', '<strong>图像风格:</strong>');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_0', '0= 图像在选项名称下面');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_1', '1= 元素, 图像 和 选项内容');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_2', '2= 元素, 图像 和 选项名称');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_3', '3= 选项名称在元素和图像下面');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_4', '4= 元素在图像和选项名称下面');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_5', '5= 元素在图像和选项名称上面');
?>