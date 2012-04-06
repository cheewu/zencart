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
//  $Id: product.php 1091 2005-03-29 06:48:38Z ajeh $
//

define('HEADING_TITLE', '商品分类');
define('HEADING_TITLE_GOTO', '转到:');

define('TABLE_HEADING_ID', '编号');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', '商品分类');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', '排序');

define('TABLE_HEADING_PRICE','价格/特价/促销');
define('TABLE_HEADING_QUANTITY','数量');

define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_STATUS', '状态');

define('TEXT_CATEGORIES', '分类:');
define('TEXT_SUBCATEGORIES', '子分类:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_PRICE_INFO', '价格:');
define('TEXT_PRODUCTS_TAX_CLASS', '税种:');
define('TEXT_PRODUCTS_AVERAGE_RATING', '平均评价:');
define('TEXT_PRODUCTS_QUANTITY_INFO', '数量:');
define('TEXT_DATE_ADDED', '加入日期:');
define('TEXT_DATE_AVAILABLE', '到货日期:');
define('TEXT_LAST_MODIFIED', '最后修改:');
define('TEXT_IMAGE_NONEXISTENT', '没有图像');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', '请在该级加入新分类或商品.');
define('TEXT_PRODUCT_MORE_INFORMATION', '详情请访问该商品 <a href="http://%s" target="blank">网页</a>.');
define('TEXT_PRODUCT_DATE_ADDED', '该商品加入分类日期 %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', '该商品到货日期 %s.');

define('TEXT_EDIT_INTRO', '请做适当修改');
define('TEXT_EDIT_CATEGORIES_ID', '分类编号:');
define('TEXT_EDIT_CATEGORIES_NAME', '分类名称:');
define('TEXT_EDIT_CATEGORIES_IMAGE', '分类图像:');
define('TEXT_EDIT_SORT_ORDER', '排列顺序:');

define('TEXT_INFO_COPY_TO_INTRO', '请选择一个新分类以复制该商品到');
define('TEXT_INFO_CURRENT_CATEGORIES', '当前分类: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', '新建分类');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', '修改分类');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', '删除分类');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', '移动分类');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', '删除商品');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', '移动商品');
define('TEXT_INFO_HEADING_COPY_TO', '复制到');

define('TEXT_DELETE_CATEGORY_INTRO', '您确认要删除该分类吗?');
define('TEXT_DELETE_PRODUCT_INTRO', '您确认要彻底删除该商品吗?<br /><br /><strong>警告:</strong> 对链接商品<br />1. 如果您从主分类中删除商品，请确认主分类已经修改<br />2. 标记要删除的商品分类的方框');

define('TEXT_DELETE_WARNING_CHILDS', '<b>警告:</b> 共有%s个(子)分类在该分类下!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b> 共有%s个商品在该分类下!');

define('TEXT_MOVE_PRODUCTS_INTRO', '请选择<b>%s</b>的分类');
define('TEXT_MOVE_CATEGORIES_INTRO', '请选择<b>%s</b>的分类');
define('TEXT_MOVE', '移动 <b>%s</b> 到:');

define('TEXT_NEW_CATEGORY_INTRO', '请为新分类填写以下信息');
define('TEXT_CATEGORIES_NAME', '分类名称:');
define('TEXT_CATEGORIES_IMAGE', '分类图像:');
define('TEXT_SORT_ORDER', '排序:');

define('TEXT_PRODUCTS_STATUS', '商品状态:');
define('TEXT_PRODUCTS_VIRTUAL', '虚拟商品:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '免运费:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', '显示数量方框:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', '到货日期:');
define('TEXT_PRODUCT_AVAILABLE', '有货');
define('TEXT_PRODUCT_NOT_AVAILABLE', '缺货');
define('TEXT_PRODUCT_IS_VIRTUAL', '是, 不要送货地址');
define('TEXT_PRODUCT_NOT_VIRTUAL', '否, 需要送货地址');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', '是');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', '否');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', '特定, 可下载商品需要配送地址');
define('TEXT_PRODUCTS_SORT_ORDER', '排序:');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', '是');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', '否');

define('TEXT_PRODUCTS_MANUFACTURER', '商品厂商:');
define('TEXT_PRODUCTS_NAME', '商品名称:');
define('TEXT_PRODUCTS_DESCRIPTION', '商品简介:');
define('TEXT_PRODUCTS_QUANTITY', '商品数量:');
define('TEXT_PRODUCTS_MODEL', '商品型号:');
define('TEXT_PRODUCTS_IMAGE', '商品图像:');
define('TEXT_PRODUCTS_IMAGE_DIR', '上传目录:');
define('TEXT_PRODUCTS_URL', '商品网址:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(不要 http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', '价格(基本价):');
define('TEXT_PRODUCTS_PRICE_GROSS', '价格(含税价):');
define('TEXT_PRODUCTS_WEIGHT', '商品重量:');

define('EMPTY_CATEGORY', '清空分类');

define('TEXT_HOW_TO_COPY', '复制方法:');
define('TEXT_COPY_AS_LINK', '链接商品');
define('TEXT_COPY_AS_DUPLICATE', '复制商品');

// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','仅适用于复制商品 ...');
  define('TEXT_COPY_ATTRIBUTES','复制商品属性吗?');
  define('TEXT_COPY_ATTRIBUTES_YES','是');
  define('TEXT_COPY_ATTRIBUTES_NO','否');

// Products and Discount Copy Options
  define('TEXT_COPY_DISCOUNTS_ONLY','仅适用于复制商品的优惠 ...');
  define('TEXT_COPY_DISCOUNTS','复制商品的优惠吗?');
  define('TEXT_COPY_DISCOUNTS_YES','是');
  define('TEXT_COPY_DISCOUNTS_NO','否');

  define('TEXT_INFO_CURRENT_PRODUCT', '当前商品: ');
  define('TABLE_HEADING_MODEL', '型号');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','属性变化的商品编号 ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','删除<strong>所有</strong>商品属性:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','复制属性到另一商品或分类:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','复制属性到另一<strong>商品</strong>:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','复制属性到另一<strong>分类</strong>:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>如何处理现有的商品属性?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>删除</strong>，然后复制新属性');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>更新</strong>设置/价格, 然后加入新的');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>忽视</strong>，仅加入新属性');

  define('SUCCESS_ATTRIBUTES_DELETED','成功删除属性');
  define('SUCCESS_ATTRIBUTES_UPDATE','成功更新属性');

  define('ICON_ATTRIBUTES','属性特点');

  define('TEXT_CATEGORIES_IMAGE_DIR','上传目录:');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','提示: 不显示数量方框, 缺省数量为1');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','提示: 不显示数量方框, 缺省数量为1');

  define('TEXT_PRODUCT_OPTIONS', '<strong>请选择:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','属性特点:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','下载: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','按属性定价:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','是');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','否');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*显示价格包括最低团体属性价格和价格');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*显示价格包括最低团体属性价格和价格');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','最少购买数量:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','购买数量单位:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','最多购买数量:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = 无限制, 1 = 无装箱数量');

  define('TEXT_PRODUCTS_MIXED','允许属性混合:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', '免费商品');
  define('TEXT_PRODUCT_IS_FREE','免费商品:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*该商品免费');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*该商品免费');

  define('TEXT_PRODUCT_IS_CALL','价格面议:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*该商品价格面议');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*该商品价格面议');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>不要新属性</strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>加入新属性自</strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>更新属性自</strong>');

// meta tags
  define('TEXT_META_TAG_TITLE_INCLUDES','<strong>商品的Meta标签标题应包括:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS','<strong>商品名称:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS','<strong>标题:</strong>');
  define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS','<strong>型号:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS','<strong>价格:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS','<strong>标题/标签行:</strong>');
  define('TEXT_META_TAGS_TITLE','<strong>Meta 标签标题:</strong>');
  define('TEXT_META_TAGS_KEYWORDS','<strong>Meta 标签关键字:</strong>');
  define('TEXT_META_TAGS_DESCRIPTION','<strong>Meta 标签描述:</strong>');
  define('TEXT_META_EXCLUDED', '<span class="alert">不含</span>');

?>