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
//  $Id: products_price_manager.php 504 2004-11-08 01:11:06Z ajeh $
//

define('HEADING_TITLE', '价格管理');
define('HEADING_TITLE_PRODUCT_SELECT','请选择分类和商品以显示价格信息 ...');

define('TABLE_HEADING_PRODUCTS', '商品');
define('TABLE_HEADING_PRODUCTS_MODEL','型号');
define('TABLE_HEADING_PRODUCTS_PRICE', '价格/特价/促销');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','百分比');
define('TABLE_HEADING_AVAILABLE_DATE', '可用');
define('TABLE_HEADING_EXPIRES_DATE','有效期');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_PRODUCT_INFO', '商品信息:');
define('TEXT_PRODUCTS_PRICE_INFO', '商品价格信息:');
define('TEXT_PRODUCTS_MODEL','型号:');
define('TEXT_PRICE', '价格');
define('TEXT_PRODUCT_AVAILABLE_DATE', '到货日期:');
define('TEXT_PRODUCTS_STATUS', '商品状态:');
define('TEXT_PRODUCT_AVAILABLE', '有货');
define('TEXT_PRODUCT_NOT_AVAILABLE', '缺货');

define('TEXT_PRODUCT_INFO_NONE', '请从上面选择一个商品 ...');
  define('TEXT_PRODUCT_IS_FREE','免费商品:');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','<br />*该商品免费');
  define('TEXT_PRODUCT_IS_CALL','价格面议:');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','<br />*该商品价格面议');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','按属性定价:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','是');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','否');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','<br />*显示价格包括最低团体属性价格和价格');
  define('TEXT_PRODUCTS_MIXED','允许属性混合:');
  define('TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', '优惠数量用于属性混合');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','最少购买数量:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','购买数量单位:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','最多购买数量:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0= 无限制<br />1= 无装箱数量/最大金额');

define('TEXT_FEATURED_PRODUCT_INFO', '推荐商品信息:');
define('TEXT_FEATURED_PRODUCT', '商品:');
define('TEXT_FEATURED_EXPIRES_DATE', '有效期:');
define('TEXT_FEATURED_AVAILABLE_DATE', '到货日期:');
define('TEXT_FEATURED_PRODUCTS_STATUS', '特色状态:');
define('TEXT_FEATURED_PRODUCT_AVAILABLE', '激活');
define('TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', '未激活');
define('TEXT_FEATURED_DISABLED', '<strong>注意: 推荐商品信息目前关闭, 过期或者没有激活</strong>');

define('TEXT_SPECIALS_PRODUCT', '商品:');
define('TEXT_SPECIALS_SPECIAL_PRICE', '特价:');
define('TEXT_SPECIALS_EXPIRES_DATE', '有效期:');
define('TEXT_SPECIALS_AVAILABLE_DATE', '到货日期:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>特别提示:</b><ul><li>您可以在特价字段输入减价的百分比, 例如: <b>20%</b></li><li>如果输入新的价格, 请使用小数点 \'.\' , 例如: <b>49.99</b></li><li>有效期为空表示永久有效</li></ul>');
define('TEXT_SPECIALS_PRODUCT_INFO', '特价信息:');
define('TEXT_SPECIALS_PRODUCTS_STATUS', '特价状态:');
define('TEXT_SPECIALS_PRODUCT_AVAILABLE', '激活');
define('TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', '未激活');
define('TEXT_SPECIALS_NO_GIFTS','GV没有特价');
define('TEXT_SPECIAL_DISABLED', '<strong>备注: 特价商品信息已关闭, 或没有激活</strong>');

define('TEXT_INFO_DATE_ADDED', '加入日期:');
define('TEXT_INFO_LAST_MODIFIED', '最后修改:');
define('TEXT_INFO_NEW_PRICE', '新价格:');
define('TEXT_INFO_ORIGINAL_PRICE', '原价格:');
define('TEXT_INFO_PERCENTAGE', '百分比:');
define('TEXT_INFO_AVAILABLE_DATE', '可用日期:');
define('TEXT_INFO_EXPIRES_DATE', '有效期:');
define('TEXT_INFO_STATUS_CHANGE', '状态改变:');
define('TEXT_IMAGE_NONEXISTENT', '图像不存在');

define('TEXT_INFO_HEADING_DELETE_FEATURED', '删除特色');
define('TEXT_INFO_DELETE_INTRO', '您确定要删除该推荐商品吗?');

  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>定义属性设置然后选 加入</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', '按属性价格');
  define('TEXT_PRODUCTS_PRICE', '商品价格: ');
  define('TEXT_SPECIAL_PRICE', '特价: ');
  define('TEXT_SALE_PRICE', '促销价格: ');
  define('TEXT_FREE', '免费');
  define('TEXT_CALL_FOR_PRICE', '价格面议');

define('TEXT_ADD_ADDITIONAL_DISCOUNT', '增加' . DISCOUNT_QTY_ADD . '行空白批量优惠:');
define('TEXT_BLANKS_INFO','当更新时, 将删除所有数量为0的批量优惠');
define('TEXT_INFO_NO_DISCOUNTS', '没有定义批量优惠');
define('TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', '优惠级别');
define('TEXT_PRODUCTS_DISCOUNT','优惠');
define('TEXT_PRODUCTS_DISCOUNT_QTY','最少数量');
define('TEXT_PRODUCTS_DISCOUNT_PRICE','优惠值');
define('TEXT_PRODUCTS_DISCOUNT_TYPE','类型');

define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH','优惠单价:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED','优惠总价:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX','优惠<br />单价: &nbsp; 税价:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX','优惠<br />总价: &nbsp; 税价:');

define('TEXT_EACH','每.');
define('TEXT_EXTENDED','总额');

define('TEXT_DISCOUNT_TYPE_INFO', '商品优惠信息');
define('TEXT_DISCOUNT_TYPE','优惠类型:');
define('TEXT_DISCOUNT_TYPE_FROM', '优惠价的基准:');

define('DISCOUNT_TYPE_DROPDOWN_0','无');
define('DISCOUNT_TYPE_DROPDOWN_1','百分比');
define('DISCOUNT_TYPE_DROPDOWN_2','实际价格');
define('DISCOUNT_TYPE_DROPDOWN_3','优惠金额');

define('DISCOUNT_TYPE_FROM_DROPDOWN_0','原价');
define('DISCOUNT_TYPE_FROM_DROPDOWN_1','特价');

define('TEXT_UPDATE_COMMIT','从当前屏幕显示更新并提交所有修改');

define('TEXT_PRODUCTS_TAX_CLASS', '税种:');

define('TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>警告:</strong> 该商品主分类编号%s与当前分类编号 # %s 不匹配且商品没有链接!');
define('TEXT_INFO_MASTER_CATEGORIES_CURRENT', ' 当前分类编号 %s 匹配该主分类编号 %s');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', '更新主分类编号 %s 以匹配当前分类编号 %s');

define('PRODUCT_WARNING_UPDATE', '请修改后选 更新 以保存');
define('PRODUCT_UPDATE_SUCCESS', '成功更新商品修改!');
define('PRODUCT_WARNING_UPDATE_CANCEL', '修改取消, 没有保存 ...');
define('TEXT_INFO_EDIT_CAUTION', '<strong>点击开始编辑 ...</strong>');
define('TEXT_INFO_PREVIEW_ONLY', '仅用于预览 ... 当前价格状态 ... 仅用于预览');
define('TEXT_INFO_UPDATE_REMINDER', '<strong>编辑商品信息然后[更新]保存</strong>');
?>