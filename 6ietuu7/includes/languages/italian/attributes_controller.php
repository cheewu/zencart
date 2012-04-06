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
//  $Id: attributes_controller.php 2830 2006-01-10 17:13:18Z birdbrain $
//

define('HEADING_TITLE', '分类: ');

define('HEADING_TITLE_OPT', '商品选项');
define('HEADING_TITLE_VAL', '选项内容');
define('HEADING_TITLE_ATRIB', '属性控制');
define('HEADING_TITLE_ATRIB_SELECT','请选择一个分类显示商品属性 ...');

define('TEXT_PRICES_AND_WEIGHTS', '价格和重量');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR', '价格因素: ');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET', '调整: ');
define('TABLE_HEADING_ATTRIBUTES_PRICE_ONETIME', '基价:');

define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_ONETIME', '基价因素: ');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET_ONETIME', '调整: ');

define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES', '属性批量优惠:');
define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES_ONETIME', '属性批量优惠基价:');

define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS', '每词价格:');
define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS_FREE', '- 免费词数:');
define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS', '每字价格:');
define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS_FREE', '- 免费字数:');

define('TABLE_HEADING_ID', '编号');
define('TABLE_HEADING_PRODUCT', '商品名称');
define('TABLE_HEADING_OPT_NAME', '选项名称');
define('TABLE_HEADING_OPT_VALUE', '选项内容');
define('TABLE_HEADING_OPT_PRICE', '价格');
define('TABLE_HEADING_OPT_PRICE_PREFIX', '前缀');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_DOWNLOAD', '可下载商品:');
define('TABLE_TEXT_FILENAME', '文件名:');
define('TABLE_TEXT_MAX_DAYS', '有效期: (0 = 永久有效)');
define('TABLE_TEXT_MAX_COUNT', '最大下载次数:');
define('TABLE_HEADING_OPT_DISCOUNTED','有优惠');
define('TABLE_HEADING_PRICE_BASE_INCLUDED','基本');
define('TABLE_HEADING_PRICE_TOTAL','总额|优惠: 基价:');
define('TEXT_WARNING_OF_DELETE', '该选项有商品和内容链接 - 删除它不安全.');
define('TEXT_OK_TO_DELETE', '该选项没有商品和内容链接 - 可以安全删除.');
define('TEXT_OPTION_ID', '选项编号');
define('TEXT_OPTION_NAME', '选项名称');

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

  define('TABLE_HEADING_OPT_TYPE', '选项类型'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','宽度');
  define('TABLE_HEADING_OPTION_VALUE_MAX','最大');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','行');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','注释');

  define('TEXT_OPTION_VALUE_COMMENTS','注释: ');
  define('TEXT_OPTION_VALUE_SIZE','显示宽度: ');
  define('TEXT_OPTION_VALUE_MAX','最大长度: ');

  define('TEXT_ATTRIBUTES_IMAGE','属性图像:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','属性图像目录:');

  define('TEXT_ATTRIBUTES_FLAGS','属性<br />选项');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', '仅用于显示:');
  define('TEXT_ATTRIBUTES_IS_FREE', '商品免费时<br />属性也免费:');
  define('TEXT_ATTRIBUTES_DEFAULT', '缺省属性:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', '应用优惠于<br />特价/促销');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','包含在基价中<br />(如以属性定价)');
  define('TEXT_ATTRIBUTES_REQUIRED','必填属性<br />文本:');

  define('LEGEND_BOX','图示:');
  define('LEGEND_KEYS','关/开');
  define('LEGEND_ATTRIBUTES_DISPLAY_ONLY', '仅显示');
  define('LEGEND_ATTRIBUTES_IS_FREE', '免费');
  define('LEGEND_ATTRIBUTES_DEFAULT', '缺省');
  define('LEGEND_ATTRIBUTE_IS_DISCOUNTED', '优惠');
  define('LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED','基价');
  define('LEGEND_ATTRIBUTES_REQUIRED','必须');
  define('LEGEND_ATTRIBUTES_IMAGES','图像');
  define('LEGEND_ATTRIBUTES_DOWNLOAD','有效/无效<br />文件名');

  define('TEXT_ATTRIBUTES_UPDATE_SORT_ORDER','设为缺省顺序');
  define('TEXT_PRODUCTS_LISTING','商品列表: ');
  define('TEXT_NO_PRODUCTS_SELECTED','没有选择商品');
  define('TEXT_NO_ATTRIBUTES_DEFINED','没有定义属性的商品编号');

  define('TEXT_PRODUCTS_ID','商品编号');
  define('TEXT_ATTRIBUTES_DELETE','全部删除');
  define('TEXT_ATTRIBUTES_COPY_PRODUCTS','复制到商品');
  define('TEXT_ATTRIBUTES_COPY_CATEGORY','复制到分类');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','属性修改的商品编号 ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','删除<strong>所有</strong>商品属性:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','复制属性到另一商品货分类自:<br />');

  define('TEXT_ATTRIBUTES_COPY_TO_PRODUCTS','商品');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','复制属性自<strong>商品</strong>');
  define('TEXT_INFO_ATTRIBUTES_FEATURE_COPY_TO','复制属性到商品:');

  define('TEXT_ATTRIBUTES_COPY_TO_CATEGORY','分类');
  define('TEXT_INFO_ATTRIBUTES_FEATURE_CATEGORIES_COPY_TO','选择分类以复制所有属性到:');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','复制属性到<strong>分类</strong>中的所有商品, 商品编号');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>如何处理现有的商品属性?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>删除</strong>，然后复制新属性');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>更新</strong>设置/价格，然后加入新的');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>忽略</strong>，仅加入新属性');

  define('SUCCESS_PRODUCT_UPDATE_SORT','成功更新属性排序的编号 ');
  define('SUCCESS_PRODUCT_UPDATE_SORT_NONE','没有可以更新排序的属性编号 ');
  define('SUCCESS_ATTRIBUTES_DELETED','属性成功删除');
  define('SUCCESS_ATTRIBUTES_UPDATE','属性成功更新');

  define('WARNING_PRODUCT_COPY_TO_CATEGORY_NONE','没有用来复制的分类选择');
  define('TEXT_PRODUCT_IN_CATEGORY_NAME',' - 分类: ');

  define('TEXT_DELETE_ALL_ATTRIBUTES','您确认要删除所有该ID的属性吗 ');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>不要新属性 </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>插入新属性自 </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>从属性更新 </strong>');

// preview
  define('TEXT_ATTRIBUTES_PREVIEW','预览属性');
  define('TEXT_ATTRIBUTES_PREVIEW_DISPLAY','预览属性显示的编号');
  define('TEXT_PRODUCT_OPTIONS', '<strong>请选择:</strong>');

  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>在下面选择或输入属性参数后，点击增加按钮</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', '按属性定价');
  define('TEXT_PRODUCTS_PRICE', '价格: ');
  define('TEXT_SPECIAL_PRICE', '特价: ');
  define('TEXT_SALE_PRICE', '促销: ');
  define('TEXT_FREE', '免费');
  define('TEXT_CALL_FOR_PRICE', '价格面议');
  define('TEXT_SAVE_CHANGES','保存:');

  define('TEXT_INFO_ID', '编号');
  define('TEXT_INFO_ALLOW_ADD_TO_CART_NO', '没有加入购物车');

  define('TEXT_DELETE_ATTRIBUTES_OPTION_NAME_VALUES', '确认删除所有该选项名称的选项内容 ...');
  define('TEXT_INFO_PRODUCT_NAME', '<strong>商品名称: </strong>');
  define('TEXT_INFO_PRODUCTS_OPTION_NAME', '<strong>选项名称: </strong>');
  define('TEXT_INFO_PRODUCTS_OPTION_ID', '<strong>编号#</strong>');
  define('SUCCESS_ATTRIBUTES_DELETED_OPTION_NAME_VALUES', '成功删除该选项名称的选项内容: ');
?>