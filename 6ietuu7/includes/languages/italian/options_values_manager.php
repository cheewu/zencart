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
//  $Id: options_values_manager.php 1133 2005-04-06 04:29:15Z ajeh $
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
define('TABLE_HEADING_DOWNLOAD', '可下载商品:');
define('TABLE_TEXT_FILENAME', '文件名:');
define('TABLE_TEXT_MAX_DAYS', '有效至:');
define('TABLE_TEXT_MAX_COUNT', '最大下载计数:');

define('TEXT_WARNING_OF_DELETE', '<span class="alert">该选项有商品和内容链接 - 不能安全删除<br />说明: 与该选项值相关的下载文件不会从服务器上删除</span>');
define('TEXT_OK_TO_DELETE', '该选项没有商品和内容链接 - 可以安全删除.');
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
  define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','缺省顺序');
  define('TEXT_SORT',' 顺序: ');

  define('TABLE_HEADING_OPT_WEIGHT_PREFIX','前缀');
  define('TABLE_HEADING_OPT_WEIGHT','重量');
  define('TABLE_HEADING_OPT_SORT_ORDER','排序');
  define('TABLE_HEADING_OPT_DEFAULT','缺省');

  define('TABLE_HEADING_YES','是');
  define('TABLE_HEADING_NO','否');

  define('TABLE_HEADING_OPT_TYPE', '选项类型'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','宽度');
  define('TABLE_HEADING_OPTION_VALUE_MAX','最大');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','行');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','注释');

  define('TEXT_OPTION_VALUE_COMMENTS','注释: ');
  define('TEXT_OPTION_VALUE_SIZE','显示宽度: ');
  define('TEXT_OPTION_VALUE_MAX','最大长度: ');

  define('TEXT_ATTRIBUTES_IMAGE','属性图像样本:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','属性图像目录:');

  define('TEXT_ATTRIBUTES_FLAGS','属性<br />标记:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', '只用于<br />显示用途:');
  define('TEXT_ATTRIBUTES_IS_FREE', '属性是免费的<br />当商品免费时:');
  define('TEXT_ATTRIBUTES_DEFAULT', '缺省属性<br />标记为已选择:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', '应用相同优惠 <br />(按商品)');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','包含在基价<br />(如果以属性定价)');

  define('TEXT_PRODUCT_OPTIONS_INFO','编辑商品选项的其它设置');

// Option Names/Values copier from one to another
  define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>将某个选项名称和内容复制到所有商品 ...</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_ALL', '选择已有的商品的选项名称和内容，然后可以用另一个选项名称和内容替换现有的所有商品的该选项名称和内容');
  define('TEXT_SELECT_OPTION_FROM', '匹配的选项名称:');
  define('TEXT_SELECT_OPTION_VALUES_FROM', '匹配的选项内容:');
  define('TEXT_SELECT_OPTION_TO', '添加选项名称:');
  define('TEXT_SELECT_OPTION_VALUES_TO', '添加选项内容:');
  define('TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', '不填代表所有商品 或者<br />输入需要更新商品的分类编号');

// Option Name/Value to Option Name for Category with Product defaults
  define('TEXT_OPTION_VALUE_COPY_OPTIONS_TO', '<strong>复制现有选项名下的选项名称/内容到商品 ...</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_OPTIONS_TO', '选择现有商品的选项名称和内容，添加到所有商品或者在选定分类中指定选项名称的商品.
                                                   <br /><strong>例子:</strong> 添加 选项名称: 颜色 选项值: Red 到所有商品，指定选项名称: 大小
                                                   <br /><strong>例子:</strong> 添加 选项名称: 颜色 选项值: Green 缺省值来自商品编号: 34 到所有商品，指定选项名称: 大小
                                                   <br /><strong>例子:</strong> 添加 选项名称: 颜色 选项值: Green 缺省值来自商品编号: 34 到所有商品，指定选项名称: 大小，分类编号为: 65
        ');
  define('TEXT_SELECT_OPTION_TO_ADD_TO', '添加选项名称到:');
  define('TEXT_SELECT_OPTION_FROM_ADD', '要添加的选项名称:');
  define('TEXT_SELECT_OPTION_VALUES_FROM_ADD', '要添加的选项内容:');
  define('TEXT_SELECT_OPTION_FROM_PRODUCTS_ID', '新属性的缺省值来自商品编号# 或留空不设缺省值:');
  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>如何处理现有商品属性?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','先<strong>删除</strong>, 然后复制新属性');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','用新设置/价格<strong>更新</strong>现有属性');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>忽略</strong>现有属性，只添加新属性');

  define('TEXT_INFO_FROM', ' 从: ');
  define('TEXT_INFO_TO', ' 到: ');
  define('ERROR_OPTION_VALUES_COPIED', '错误: 选项名称和选项内容重复');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH', '错误: 选择的选择名称和内容不匹配');
  define('ERROR_OPTION_VALUES_NONE', '错误: 没有可复制的内容');
  define('SUCCESS_OPTION_VALUES_COPIED', '复制成功! ');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH_PRODUCTS_ID', '错误: 缺少选项名称/内容的商品编号#');

  define('TEXT_OPTION_VALUE_DELETE_ALL', '<strong>从所有商品的选项名称和内容中删除匹配的属性 ...</strong>');
  define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', '选择已有的商品的选项名称和内容，然后可以从所有商品中或一个分类下的所有商品中删除');
  define('TEXT_SELECT_DELETE_OPTION_FROM', '匹配的选项名称:');
  define('TEXT_SELECT_DELETE_OPTION_VALUES_FROM', '匹配的选择内容:');

  define('ERROR_OPTION_VALUES_DELETE_MISMATCH', '错误: 选择的选择名称和内容不匹配');

  define('SUCCESS_OPTION_VALUES_DELETE', '成功删除: ');
?>