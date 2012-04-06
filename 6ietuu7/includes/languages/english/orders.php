<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: orders.php 6214 2007-04-17 02:24:25Z ajeh $
 */

define('HEADING_TITLE', '订单管理');
define('HEADING_TITLE_SEARCH', '订单号码:');
define('HEADING_TITLE_STATUS', '状态:');
define('HEADING_TITLE_SEARCH_DETAIL_ORDERS_PRODUCTS', '按商品名称搜索或<strong>ID:XX</strong>或型号');
define('TEXT_INFO_SEARCH_DETAIL_FILTER_ORDERS_PRODUCTS', '搜索选项: ');
define('TABLE_HEADING_PAYMENT_METHOD', '付款<br />配送');
define('TABLE_HEADING_ORDERS_ID','订单号');

define('TEXT_BILLING_SHIPPING_MISMATCH','帐单地址和送货地址不同 ');

define('TABLE_HEADING_COMMENTS', '备注');
define('TABLE_HEADING_CUSTOMERS', '客户');
define('TABLE_HEADING_ORDER_TOTAL', '订单总额');
define('TABLE_HEADING_DATE_PURCHASED', '购买日期');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_TYPE', '订单类型');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_PRODUCTS_MODEL', '型号');
define('TABLE_HEADING_PRODUCTS', '商品');
define('TABLE_HEADING_TAX', '税');
define('TABLE_HEADING_TOTAL', '总额');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '单价 (不含税)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '单价 (含税)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '总额 (不含税)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '总额 (含税)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', '客户通知');
define('TABLE_HEADING_DATE_ADDED', '加入日期');

define('ENTRY_CUSTOMER', '客户:');
define('ENTRY_SOLD_TO', '售于:');
define('ENTRY_DELIVERY_TO', '交付:');
define('ENTRY_SHIP_TO', '运到:');
define('ENTRY_SHIPPING_ADDRESS', '送货地址:');
define('ENTRY_BILLING_ADDRESS', '帐单地址:');
define('ENTRY_PAYMENT_METHOD', '支付方式:');
define('ENTRY_CREDIT_CARD_TYPE', '信用卡类型:');
define('ENTRY_CREDIT_CARD_OWNER', '信用卡人:');
define('ENTRY_CREDIT_CARD_NUMBER', '信用卡号码:');
define('ENTRY_CREDIT_CARD_CVV', '信用卡CVV校验码:');
define('ENTRY_CREDIT_CARD_EXPIRES', '信用卡有效期:');
define('ENTRY_SUB_TOTAL', '小计:');
define('ENTRY_TAX', '税:');
define('ENTRY_SHIPPING', '运费:');
define('ENTRY_TOTAL', '总额:');
define('ENTRY_DATE_PURCHASED', '购买日期:');
define('ENTRY_STATUS', '状态:');
define('ENTRY_DATE_LAST_UPDATED', '最后更新日期:');
define('ENTRY_NOTIFY_CUSTOMER', '通知客户:');
define('ENTRY_NOTIFY_COMMENTS', '增加备注:');
define('ENTRY_PRINTABLE', '打印发票');

define('TEXT_INFO_HEADING_DELETE_ORDER', '删除订单');
define('TEXT_INFO_DELETE_INTRO', '您确认要删除该订单吗?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', '恢复商品数量');
define('TEXT_DATE_ORDER_CREATED', '创建日期:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', '最后修改:');
define('TEXT_INFO_PAYMENT_METHOD', '支付方式:');
define('TEXT_PAID', '已付');
define('TEXT_UNPAID', '未付');

define('TEXT_ALL_ORDERS', '所有订单');
define('TEXT_NO_ORDER_HISTORY', '没有订单历史');

define('EMAIL_SEPARATOR', '------------------------------------------------------');///english
define('EMAIL_TEXT_SUBJECT', 'Order Update');//english
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');//订单号码
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');//详细发票
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');//订单日期
define('EMAIL_TEXT_COMMENTS_UPDATE', '<em>The comments for your order are: </em>');//您订单的备注为
define('EMAIL_TEXT_STATUS_UPDATED', 'Your order has been updated to the following status:' . "\n");//您的订单状态更新为
define('EMAIL_TEXT_STATUS_LABEL', '<strong>New status:</strong> %s' . "\n\n");//新状态
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Please reply to this email if you have any questions.' . "\n");//如果您有任何疑问, 请回复电子邮件

define('ERROR_ORDER_DOES_NOT_EXIST', '错误: 订单不存在.');
define('SUCCESS_ORDER_UPDATED', '成功: 订单成功更新.');
define('WARNING_ORDER_NOT_UPDATED', '警告: 没有变化. 该订单没有更新.');

define('ENTRY_ORDER_ID','发票号. ');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">免费</span>');

define('TEXT_DOWNLOAD_TITLE', '订单下载状态');
define('TEXT_DOWNLOAD_STATUS', '状态');
define('TEXT_DOWNLOAD_FILENAME', '文件名');
define('TEXT_DOWNLOAD_MAX_DAYS', '天数');
define('TEXT_DOWNLOAD_MAX_COUNT', '计数');

define('TEXT_DOWNLOAD_AVAILABLE', '可用');
define('TEXT_DOWNLOAD_EXPIRED', '过期');
define('TEXT_DOWNLOAD_MISSING', '不在服务器上');

define('IMAGE_ICON_STATUS_CURRENT', '状态 - 可用');
define('IMAGE_ICON_STATUS_EXPIRED', '状态 - 过期');
define('IMAGE_ICON_STATUS_MISSING', '状态 - 缺少');

define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', '成功打开下载');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', '成功关闭下载');
define('TEXT_MORE', '... 更多');

define('TEXT_INFO_IP_ADDRESS', 'IP地址: ');
define('TEXT_DELETE_CVV_FROM_DATABASE','从数据库中删除CVV校验码');
define('TEXT_DELETE_CVV_REPLACEMENT','已删除');
define('TEXT_MASK_CC_NUMBER','隐藏该校验码');

define('TEXT_INFO_EXPIRED_DATE', '有效期:<br />');
define('TEXT_INFO_EXPIRED_COUNT', '过期数:<br />');

define('TABLE_HEADING_CUSTOMER_COMMENTS', '客户<br />备注');
define('TEXT_COMMENTS_YES', '客户备注 - 是');
define('TEXT_COMMENTS_NO', '客户备注 - 否');
?>