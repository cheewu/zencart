<?php
/*
//////////////////////////////////////////////////////////
//  SALES REPORT                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2006 The Zen Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION: The language file contains all the     //
//  text that appears on the report.  The first set of  //
//  configuration defines actually impact the report's  //
//  output and behavior.                                //
//////////////////////////////////////////////////////////
// $Id: stats_sales_report.php 103 2006-10-13 21:06:48Z BlindSide $
*/

/*
** CONFIGURATION DEFINES
*/
//////////////////////////////////////////////////////////
// DEFAULT SEARCH OPTIONS
// These values are loaded into the report when (a) the
// report is laoded fresh, or (b) when the defaults button
// is pressed.  If you prefer to have no option set for a
// given entry, you may leave its define empty. Valid
// entries are in the comments following each define.
// Default settings are in brackets [].
//
define('DEFAULT_DATE_SEARCH_TYPE', 'preset'); // ['preset'], 'custom' (cannot be empty if next 3 options are set!)
define('DEFAULT_DATE_PRESET', 'yesterday'); // ['yesterday'], 'this_month', 'last_month', 'custom'
define('DEFAULT_START_DATE', ''); // (date in mm-dd-yyyy format)
define('DEFAULT_END_DATE', ''); // (date in mm-dd-yyyy format)

define('DEFAULT_DATE_TARGET', 'status'); // ['purchased'], 'status'
define('DEFAULT_DATE_STATUS', '10'); // (status number) [lowest status number]
define('DEFAULT_PAYMENT_METHOD', ''); // [any entry in `orders.payment_module_code` field]
define('DEFAULT_CURRENT_STATUS', ''); // [status number]
define('DEFAULT_MANUFACTURER', ''); // manufacturers_id from Admin > Catalog > Manufacturers ("mID=##" in the URL)

define('DEFAULT_TIMEFRAME', 'day'); // ['day'], 'week', 'month', 'year'
define('DEFAULT_TIMEFRAME_SORT', ''); // ['asc'], 'desc'
define('DEFAULT_DETAIL_LEVEL', 'product'); // ['timeframe'], 'product', 'order', 'matrix'

// order line items: 'oID', 'last_name', 'num_products', 'goods', 'shipping', 'discount', 'gc_sold', 'gc_used', 'grand'
// product line items: 'pID', 'name', 'manufacturer', 'model', 'base_price', 'quantity', 'onetime_charges', 'grand'
define('DEFAULT_LI_SORT_A', 'model');
define('DEFAULT_LI_SORT_ORDER_A', ''); // 'asc', 'desc'
define('DEFAULT_LI_SORT_B', 'name');
define('DEFAULT_LI_SORT_ORDER_B', ''); // 'asc', 'desc'

define('DEFAULT_OUTPUT_FORMAT', 'print'); // ['display'], 'print', 'csv'
define('DEFAULT_AUTO_PRINT', ''); // 'true', ['false']
define('DEFAULT_CSV_HEADER', ''); // 'true', ['false']


//////////////////////////////////////////////////////////
// DISPLAY EMPTY TIMEFRAME LINES
// Setting this define to true will disable displaying
// a timeframe line if that timeframe is empty.  By
// default, an empty timeframe displays the value of the
// define TEXT_NO_DATA.
//
// Be aware, if this is enabled and your search yields
// no results at all, the screen will look as if no search
// was performed (which is why this is disabled by default)
//
define('DISPLAY_EMPTY_TIMEFRAMES', false);


//////////////////////////////////////////////////////////
// PRODUCT MANUFACTURERS COLUMN
// Setting this define to true will display the
// manufacturer on each product line item, and will default
// to the value of TEXT_NONE if there is no manufacturer.
// False will remove the manufacturer column from the report.
//
define('DISPLAY_MANUFACTURER', false);


//////////////////////////////////////////////////////////
// ONE-TIME FEES COLUMN
// If your store does not have *any* one-time fees on its
// products, you can disable displaying the column.
//
// Note that this switch does not affect math calculations,
// so if you happen to have a product with fees attached,
// they will still be accounted for and appear in the total.
//
define('DISPLAY_ONE_TIME_FEES', false);


//////////////////////////////////////////////////////////
// DECIMAL PLACES IN AVERAGES
// Sets the number of decimal places displayed in averages
// on timeframe statistics display
//
define('NUM_DECIMAL_PLACES', 2);


//////////////////////////////////////////////////////////
// TIMEFRAME DATE DISPLAY
// These control the display format of the start and end
// dates of each timeframe line.  Each define corresponds
// to the timeframe of its namesake.  See the PHP manual
// entry on the date() function for a table on the accepted
// formatting characters: http://us2.php.net/date
//
define('TIME_DISPLAY_DAY', 'Y-n-j');
define('TIME_DISPLAY_WEEK', 'Y-n-j');
define('TIME_DISPLAY_MONTH', 'Y-n-j');
define('TIME_DISPLAY_YEAR', 'Y-n-j');
define('DATE_SPACER', ' thru<br/>&nbsp;&nbsp;&nbsp;');


//////////////////////////////////////////////////////////
// EXCLUDE SPECIFIED PRODUCTS
// Prevents specified products from appearing on the sales
// report at all.  **ADDING PRODUCTS TO THIS DEFINE WILL
// IMPACT TOTALS CALCULATIONS!**
//
// The value of the product will be excluded from totals
// for gc_sold, gc_sold_qty, goods, num_products, and
// diff_products.
//
// The values for gc_used, gc_used_qty, discount,
// discount_qty, tax, and shipping all come from the
// orders_total table, and so CANNOT be excluded based
// on product ID.
//
// If an order is made up entirely of excluded products,
// and has no shipping, discounts, tax, or used gift
// certificates, it will have a total of 0.  In this
// situation, the order will not be displayed in the results.
//
// EXAMPLE: define('EXCLUDE_PRODUCTS', serialize(array(25, 14, 43)) );
//
define('EXCLUDE_PRODUCTS', serialize(array( )));



/*
** LANGUAGE DEFINES
*/
// Search menu heading
define('PAGE_HEADING', '销售分析');
define('HEADING_TITLE_SEARCH', '1. 汇总及过滤数据');
define('HEADING_TITLE_SORT', '2. 排序及指定结果');
define('HEADING_TITLE_PROCESS', '3. 生成报表');
define('SEARCH_TIMEFRAME', '时间段');
define('SEARCH_TIMEFRAME_DAY', '一日');
define('SEARCH_TIMEFRAME_WEEK', '一周');
define('SEARCH_TIMEFRAME_MONTH', '一月');
define('SEARCH_TIMEFRAME_YEAR', '一年');
define('SEARCH_TIMEFRAME_SORT', '时间段排序');
define('SEARCH_DATE_PRESET', '可选日期区间');
define('SEARCH_DATE_CUSTOM', '输入日期区间');
define('SEARCH_DATE_YESTERDAY', '昨天(%s)');
define('SEARCH_DATE_LAST_MONTH', '上月(%s)');
define('SEARCH_DATE_THIS_MONTH', '本月(%s)');
define('SEARCH_START_DATE', '开始日期');
define('SEARCH_END_DATE', '结束日期(包括)');
define('SEARCH_DATE_FORMAT', 'yyyy/mm/dd');
define('SEARCH_DATE_TARGET', '指定订单 ...');
define('SEARCH_PAYMENT_METHOD', '支付方式');
define('SEARCH_CURRENT_STATUS', '订单状态');
define('SEARCH_MANUFACTURER', '商品厂家');
define('SEARCH_DETAIL_LEVEL', '显示内容');
define('SEARCH_OUTPUT_FORMAT', '输出格式');
define('SEARCH_SORT_PRODUCT', '商品排序 ...');
define('SEARCH_SORT_ORDER', '订单排序 ...');
define('SEARCH_SORT_THEN', '其它排序 ...');
define('BUTTON_SEARCH', '生成报表!');
define('BUTTON_LOAD_DEFAULTS', '缺省报表');
define('BUTTON_DEFAULT_SEARCH', '快速查询');
define('SEARCH_WAIT_TEXT', '处理中，请稍候 ...');


// Form element text
// radio buttons
define('RADIO_DATE_TARGET_PURCHASED', '所有订单');
define('RADIO_DATE_TARGET_STATUS', '订单状态 (请选择)');
define('RADIO_TIMEFRAME_SORT_ASC', '旧的在前');
define('RADIO_TIMEFRAME_SORT_DESC', '新的在前');
define('RADIO_LI_SORT_ASC', '升序');
define('RADIO_LI_SORT_DESC', '降序');

// dropdown menus
define('SELECT_DETAIL_TIMEFRAME', '时间段总计');
define('SELECT_DETAIL_PRODUCT', '&nbsp;+ 商品细目');
define('SELECT_DETAIL_ORDER', '&nbsp;+ 订单细目');
define('SELECT_DETAIL_MATRIX', '时间段统计');
define('SELECT_OUTPUT_DISPLAY', '屏幕显示');
define('SELECT_OUTPUT_PRINT', '打印输出');
define('SELECT_OUTPUT_CSV', 'CSV 导出');
define('SELECT_PRODUCT_ID', '商品编号');
define('SELECT_QUANTITY', '数量');
define('SELECT_LAST_NAME', '客户名字');

// checkboxes
define('CHECKBOX_AUTO_PRINT', '自动打印报表');
define('CHECKBOX_CSV_HEADER', '首行显示名称');
define('CHECKBOX_NEW_WINDOW', '新窗口打开');


// Report Column Headings
// Timeframe
define('TABLE_HEADING_TIMEFRAME', '时间段');
define('TABLE_HEADING_NUM_ORDERS', '订单数');
define('TABLE_HEADING_NUM_PRODUCTS', '商品数');
define('TABLE_HEADING_TOTAL_GOODS', '商品金额');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_SHIPPING', '配送');
define('TABLE_HEADING_DISCOUNTS', '优惠');
define('TABLE_HEADING_GC_SOLD', '已售出礼券');
define('TABLE_HEADING_GC_USED', '已使用礼券');
define('TABLE_HEADING_TOTAL', '总计');
define('TABLE_FOOTER_TIMEFRAMES', ' 时间段');

// Order Line Items
define('TABLE_HEADING_ORDERS_ID', '订单编号');
define('TABLE_HEADING_CUSTOMER', '客户');
define('TABLE_HEADING_ORDER_TOTAL', '订单总计');

// Product Line Items
define('TABLE_HEADING_PRODUCT_ID', '商品编号');
define('TABLE_HEADING_PRODUCT_NAME', '商品名称');
define('TABLE_HEADING_MANUFACTURER', '厂家');
define('TABLE_HEADING_MODEL', '型号');
define('TABLE_HEADING_BASE_PRICE', '原价');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_ONETIME_CHARGES', '基本费');
define('TABLE_HEADING_PRODUCT_TOTAL', '商品总额');

// Data Matrix
define('MATRIX_GENERAL_STATS', '总报表');
define('MATRIX_ORDER_REVENUE', '总利润');
define('MATRIX_ORDER_PRODUCT_COUNT', '全部商品数');
define('MATRIX_LARGEST', '最大订单: ');
define('MATRIX_SMALLEST', '最小订单: ');
define('MATRIX_AVERAGES', '平均');
define('MATRIX_AVG_ORDER', '&nbsp;订单金额');
define('MATRIX_AVG_PROD_ORDER', '&nbsp;每单商品总数');
define('MATRIX_AVG_PROD_ORDER_DIFF', '&nbsp;每单不同商品数');
define('MATRIX_AVG_ORDER_CUST', '&nbsp;每客户订单数');
define('MATRIX_ORDER_STATS', '订单统计');
define('MATRIX_TOTAL_PAYMENTS', '支付方式');
define('MATRIX_TOTAL_CC', '信用卡');
define('MATRIX_TOTAL_SHIPPING', '配送方式');
define('MATRIX_TOTAL_CURRENCIES', '使用货币');
define('MATRIX_TOTAL_CUSTOMERS', '客户数');
define('MATRIX_PRODUCT_STATS', '商品统计');
define('MATRIX_PRODUCT_SPREAD', '商品销量');
define('MATRIX_PRODUCT_REVENUE_RATIO', '总利润 %');
define('MATRIX_PRODUCT_QUANTITY_RATIO', '总数量 %');


// CSV Export
define('CSV_FILENAME_PREFIX', 'sales_');
define('CSV_HEADING_START_DATE', '开始日期');
define('CSV_HEADING_END_DATE', '结束日期');
define('CSV_HEADING_LAST_NAME', '姓氏');
define('CSV_HEADING_FIRST_NAME', '名字');
define('CSV_SEPARATOR', ',');
define('CSV_NEWLINE', "\n");


// Print Format
define('PRINT_DATE_TO', ' 到 ');
define('PRINT_DATE_TARGET', '日期 ');
define('PRINT_TIMEFRAMES', '%s 时间段排序 %s');
define('PRINT_DATE_PURCHASED', '订单创建');
define('PRINT_DATE_STATUS', '指定状态');
define('PRINT_ORDER_STATUS', '%s [%s]');
define('PRINT_PAYMENT_METHOD', '支付方式:');
define('PRINT_CURRENT_STATUS', '订单状态:');
define('PRINT_DETAIL_LEVEL', '显示 ');

// javascript pop-up alert window
define('ALERT_JS_HIGHLIGHT', '#FF40CF');
define('ALERT_MSG_START', "搜索参数有误:");
define('ALERT_DATE_INVALID', "> 输入的日期不对");
define('ALERT_DATE_MISSING', "> 请选择预置日期，或者输入日期区间");
define('ALERT_CSV_CONFLICT', "> CSV输出不能用于" . SELECT_DETAIL_MATRIX . "显示");
define('ALERT_MSG_FINISH', "请修改后重新搜索。");

// Other text defines
define('ERROR_MISSING_REQ_INFO', '错误: 必填字段为空');
define('ALT_TEXT_SORT_ASC', '按照升序重新排序');
define('ALT_TEXT_SORT_DESC', '安装降序重新排序');
define('TEXT_REPORT_TIMESTAMP', '报表时间: ');
define('TEXT_PARSE_TIME', '生成时间: %s 秒。');
define('TEXT_EMPTY_SELECT', '(任意)');
define('TEXT_QTY', '| 数量: ');
define('TEXT_DIFF', '| 不同: ');
define('TEXT_SAME', '| (相同)');
define('TEXT_SAME_ONE', '| --');
define('TEXT_PRINT_FORMAT', '打印格式显示报表');
define('TEXT_PRINT_FORMAT_TITLE', '提示: 点击 \'' . PAGE_HEADING . '\' 切换到显示模式');
define('TEXT_NO_DATA', '-- 该时间段没有订单 --');
?>