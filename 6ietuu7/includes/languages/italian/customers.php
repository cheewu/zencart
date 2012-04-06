<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: customers.php 6352 2007-05-20 21:05:01Z drbyte $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

define('HEADING_TITLE', '客户资料');

define('TABLE_HEADING_ID', '编号');
define('TABLE_HEADING_FIRSTNAME', '姓氏');
define('TABLE_HEADING_LASTNAME', '名字');
define('TABLE_HEADING_ACCOUNT_CREATED', '创建帐号');
define('TABLE_HEADING_LOGIN', '最后登录');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_PRICING_GROUP', '团体价格组');
define('TABLE_HEADING_AUTHORIZATION_APPROVAL', '授权状态');
define('TABLE_HEADING_GV_AMOUNT', '礼券余额');

define('TEXT_DATE_ACCOUNT_CREATED', '创建帐号:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', '最后修改:');
define('TEXT_INFO_DATE_LAST_LOGON', '最后登录');
define('TEXT_INFO_NUMBER_OF_LOGONS', '登录次数:');
define('TEXT_INFO_COUNTRY', '所在国家或地区:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', '评论次数:');
define('TEXT_DELETE_INTRO', '您确认要删除该客户资料吗?');
define('TEXT_DELETE_REVIEWS', '删除%s个评论');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', '删除客户资料');
define('TYPE_BELOW', '在下面输入');
define('PLEASE_SELECT', '请选择');
define('TEXT_INFO_NUMBER_OF_ORDERS', '订单数:');
define('TEXT_INFO_LAST_ORDER','最后订单:');
define('TEXT_INFO_ORDERS_TOTAL', '总额:');
define('CUSTOMERS_REFERRAL', '客户推荐代码<br />第一张优惠券');
define('TEXT_INFO_GV_AMOUNT', '礼券余额');

define('ENTRY_NONE', '无');

define('TABLE_HEADING_COMPANY','公司');

define('CUSTOMERS_AUTHORIZATION', '授权状态:');
define('CUSTOMERS_AUTHORIZATION_0', '已授权');
define('CUSTOMERS_AUTHORIZATION_1', '等待中 - 授权后才能浏览');
define('CUSTOMERS_AUTHORIZATION_2', '可以浏览但不显示价格');
define('CUSTOMERS_AUTHORIZATION_3', '可以浏览商品及价格，但不能购买');
define('CUSTOMERS_AUTHORIZATION_4', '封禁 - 不能登录购物');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION1', '警告: 您的商店设置为授权后才能浏览. 客户状态为授权等待中 - 不能浏览');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION2', '警告: 您的商店设置为授权浏览但不显示价格. 客户设置为授权等待中 - 可以浏览但不显示价格');

define('EMAIL_CUSTOMER_STATUS_CHANGE_MESSAGE', '您的购物状态已更新。多谢惠顾，欢迎下次再来。');
define('EMAIL_CUSTOMER_STATUS_CHANGE_SUBJECT', '客户状态更新');

define('ADDRESS_BOOK_TITLE', '地址簿条目');
define('PRIMARY_ADDRESS', '(主要地址)');
define('TEXT_MAXIMUM_ENTRIES', '<span class="coming"><strong>说明:</strong></span> 最多可以有%s个地址。');
define('TEXT_INFO_ADDRESS_BOOK_COUNT', ' | 1 共  ');
?>