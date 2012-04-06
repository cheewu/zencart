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
//  $Id: invoice.php 5961 2007-03-03 17:17:39Z ajeh $
//

define('TABLE_HEADING_COMMENTS', '备注');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', '已通知客户');
define('TABLE_HEADING_DATE_ADDED', '添加日期');
define('TABLE_HEADING_STATUS', '状态');

define('TABLE_HEADING_PRODUCTS_MODEL', '型号');
define('TABLE_HEADING_PRODUCTS', '商品');
define('TABLE_HEADING_TAX', '税');
define('TABLE_HEADING_TOTAL', '总额');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '单价 (不含税)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '单价 (含税)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '总额 (不含税)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '总额 (含税)');

define('ENTRY_CUSTOMER', '客户: ');

define('ENTRY_SOLD_TO', '帐单地址: ');
define('ENTRY_SHIP_TO', '送货地址: ');
define('ENTRY_PAYMENT_METHOD', '支付方式: ');
define('ENTRY_SUB_TOTAL', '小计: ');
define('ENTRY_TAX', '税: ');
define('ENTRY_SHIPPING', '运费: ');
define('ENTRY_TOTAL', '总额: ');
define('ENTRY_DATE_PURCHASED', '订单日期: ');

define('ENTRY_ORDER_ID','发票号: ');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;免费');
?>