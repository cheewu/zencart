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
//  $Id: categories.php 4808 2006-10-22 18:48:53Z ajeh $
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
define('TEXT_SUBCATEGORIES', '子类:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_PRICE_INFO', '价格:');
define('TEXT_PRODUCTS_TAX_CLASS', '税种:');
define('TEXT_PRODUCTS_AVERAGE_RATING', '平均评价:');
define('TEXT_PRODUCTS_QUANTITY_INFO', '数量:');
define('TEXT_DATE_ADDED', '加入日期:');
define('TEXT_DATE_AVAILABLE', '到货日期:');
define('TEXT_LAST_MODIFIED', '最后修改:');
define('TEXT_IMAGE_NONEXISTENT', '没有图像');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', '请在该级加入一个新的类别或商品.');
define('TEXT_PRODUCT_MORE_INFORMATION', '详情请访问该商品 <a href="http://%s" target="blank">网页</a>.');
define('TEXT_PRODUCT_DATE_ADDED', '该商品加入目录日期 %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', '该商品预计到货日期 %s.');

define('TEXT_EDIT_INTRO', '请做必要修改');
define('TEXT_EDIT_CATEGORIES_ID', '分类编号:');
define('TEXT_EDIT_CATEGORIES_NAME', '分类名称:');
define('TEXT_EDIT_CATEGORIES_IMAGE', '分类图像:');
define('TEXT_EDIT_SORT_ORDER', '排序:');

define('TEXT_INFO_COPY_TO_INTRO', '请给该商品复制一个新分类');
define('TEXT_INFO_CURRENT_CATEGORIES', '当前分类: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', '新建分类');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', '编辑分类');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', '删除分类');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', '移动分类');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', '删除商品');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', '移动商品');
define('TEXT_INFO_HEADING_COPY_TO', '复制到');

define('TEXT_DELETE_CATEGORY_INTRO', '您确认要删除该分类吗?');
define('TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>警告:</strong> 主分类被删除的链接商品将无法正确显示价格。在删除含有链接商品的分类前，请重置链接商品的主分类到其他的分类中');
define('TEXT_DELETE_PRODUCT_INTRO', '您确认要彻底删除该商品吗?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>警告:</b> 共有%s个(子)分类还链接到该分类!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b> 共有%s商品还链接到该分类!');

define('TEXT_MOVE_PRODUCTS_INTRO', '请选择<b>%s</b>的分类');
define('TEXT_MOVE_CATEGORIES_INTRO', '请选择<b>%s</b>的分类');
define('TEXT_MOVE', '移动 <b>%s</b> 到:');

define('TEXT_NEW_CATEGORY_INTRO', '请填写以下新分类信息');
define('TEXT_CATEGORIES_NAME', '分类名称:');
define('TEXT_CATEGORIES_IMAGE', '分类图像:');
define('TEXT_SORT_ORDER', '排序:');

define('TEXT_PRODUCTS_STATUS', '商品状态:');
define('TEXT_PRODUCTS_VIRTUAL', '虚拟商品:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '免运费:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', '商品数量栏显示:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', '上架日期:');
define('TEXT_PRODUCT_AVAILABLE', '有货');
define('TEXT_PRODUCT_NOT_AVAILABLE', '无货');
define('TEXT_PRODUCT_IS_VIRTUAL', '是, 不要送货地址');
define('TEXT_PRODUCT_NOT_VIRTUAL', '否, 需要送货地址');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', '是');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', '否');

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

define('EMPTY_CATEGORY', '空目录');

define('TEXT_HOW_TO_COPY', '复制方法:');
define('TEXT_COPY_AS_LINK', '链接商品');
define('TEXT_COPY_AS_DUPLICATE', '重复商品');

define('TEXT_RESTRICT_PRODUCT_TYPE', '限制商品类型');
define('TEXT_CATEGORY_HAS_RESTRICTIONS', '该分类仅限这些商品类型');
define('ERROR_CANNOT_ADD_PRODUCT_TYPE','该商品类型不能加到该类中. 请检查您的分类限制.');

// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','只能用于重复商品 ...');
  define('TEXT_COPY_ATTRIBUTES','复制商品属性?');
  define('TEXT_COPY_ATTRIBUTES_YES','是');
  define('TEXT_COPY_ATTRIBUTES_NO','否');

  define('TEXT_INFO_CURRENT_PRODUCT', '当前商品: ');
  define('TABLE_HEADING_MODEL', '型号');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','修改编号商品属性 ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','删除<strong>所有</strong>商品属性:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','复制属性到另一商品或另一分类:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','复制属性到另一<strong>商品</strong>:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','复制属性到另一<strong>分类</strong>:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>如何处理现有的商品属性?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>删除</strong>，然后复制新属性');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>更新</strong>设置/价格, 然后加入新的');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>忽视</strong>，仅加入新属性');

  define('SUCCESS_ATTRIBUTES_DELETED','属性成功删除');
  define('SUCCESS_ATTRIBUTES_UPDATE','属性成功更新');

  define('ICON_ATTRIBUTES','属性');

  define('TEXT_CATEGORIES_IMAGE_DIR','上传目录:');
  define('TEXT_CATEGORIES_IMAGE_MANUAL', '<strong>或从服务器上选择已有图像文件，文件名:</strong>');

  define('TEXT_VIRTUAL_PREVIEW','提示: 免运费且不要送货地址');
  define('TEXT_VIRTUAL_EDIT','提示: 免运费且不要送货地址');
  define('TEXT_FREE_SHIPPING_PREVIEW','提示: 免运费, 但需要送货地址');
  define('TEXT_FREE_SHIPPING_EDIT','提示: 免运费, 但需要送货地址');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','提示: 不显示数量方框, 缺省数量为1');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','提示: 不显示数量方框, 缺省数量为1');

  define('TEXT_PRODUCT_OPTIONS', '<strong>请选择:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','属性:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','下载: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','按属性定价:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','是');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','否');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*显示价格包括最低团体属性价格和价格');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*显示价格包括最低团体属性价格和价格');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','最少购买数量:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','购买数量单位:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','最多购买数量:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = 无限制, 1 = 无装箱数量 或 最多 ##');

  define('TEXT_PRODUCTS_MIXED','允许属性混合:');

  define('TEXT_PRODUCT_IS_FREE','免费商品:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*该商品免费');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*该商品免费');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*该商品免费');

  define('TEXT_PRODUCT_IS_CALL','价格面议:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*该商品价格面议');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*该商品价格面议');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>不要新属性 </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>加入新属性自 </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>更新属性自 </strong>');

  define('TEXT_SHIPPING_INFO',
  '<strong>虚拟商品</strong>不要运费也不要送货地址, 例如, ' . TEXT_GV_NAMES . ', 等.<br />' .
  '<strong>总是免费</strong>不要运费, 但需要送货地址<br />' .
  '<strong>下载</strong>设定为虚拟商品 - 两个选项都不需要标记<br />'
  );

  define('TEXT_ANY_TYPE', 'Any Type');
  define('TABLE_HEADING_PRODUCT_TYPES', '商品类型');

// categories status
define('TEXT_INFO_HEADING_STATUS_CATEGORY', '改变分类状态自:');
define('TEXT_CATEGORIES_STATUS_INTRO', '改变分类状态到: ');
define('TEXT_CATEGORIES_STATUS_OFF', '关');
define('TEXT_CATEGORIES_STATUS_ON', '开');
define('TEXT_PRODUCTS_STATUS_INFO', '改变所有商品状态为: ');
define('TEXT_PRODUCTS_STATUS_OFF', '关');
define('TEXT_PRODUCTS_STATUS_ON', '开');
define('TEXT_PRODUCTS_STATUS_NOCHANGE', '没改变');
define('TEXT_CATEGORIES_STATUS_WARNING', '<strong>警告 ...</strong><br />备注: 关闭一个分类将关闭所有该类中的商品. 该分类中链接的商品和其它分类共享的也会关闭.');

define('TEXT_PRODUCTS_STATUS_ON_OF',' / ');
define('TEXT_PRODUCTS_STATUS_ACTIVE',' 开启 ');

define('TEXT_CATEGORIES_DESCRIPTION', '分类简介:');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', '商品价格面议');

// Metatags
  define('TEXT_INFO_HEADING_EDIT_CATEGORY_META_TAGS', '分类元标签定义');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_INTRO', '自定义元标签');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_TITLE', '标题:');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_KEYWORDS', '关键字:');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_DESCRIPTION', '描述:');

  define('WARNING_PRODUCTS_IN_TOP_INFO', '警告: 顶级分类中有商品，这会导致价格显示不正确。发现的商品: ');
?>