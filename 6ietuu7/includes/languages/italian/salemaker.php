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
//  $Id: salemaker.php 6369 2007-05-25 03:03:42Z ajeh $
//

define('HEADING_TITLE', '促销管理');
define('TABLE_HEADING_SALE_NAME', '促销名称');
define('TABLE_HEADING_SALE_DEDUCTION', '减价');
define('TABLE_HEADING_SALE_DATE_START', '生效日');
define('TABLE_HEADING_SALE_DATE_END', '到期日');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');
define('TEXT_SALEMAKER_NAME', '促销名称:');
define('TEXT_SALEMAKER_DEDUCTION', '减价:');
define('TEXT_SALEMAKER_DEDUCTION_TYPE', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类型:&nbsp;&nbsp;');
define('TEXT_SALEMAKER_PRICERANGE_FROM', '价格范围:');
define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;到&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('TEXT_SALEMAKER_SPECIALS_CONDITION', '如果商品有特价:');
define('TEXT_SALEMAKER_DATE_START', '开始日期:');
define('TEXT_SALEMAKER_DATE_END', '结束日期:');
define('TEXT_SALEMAKER_CATEGORIES', '<b>或者</b>选择促销的分类:');
define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>点击这里查看促销管理说明</b></span></a>');
define('TEXT_SALEMAKER_POPUP1', '<a href="javascript:session_win1();"><span class="errorText"><b>(详情)</b></span></a>');
define('TEXT_SALEMAKER_IMMEDIATELY', '立刻');
define('TEXT_SALEMAKER_NEVER', '从不');
define('TEXT_SALEMAKER_ENTIRE_CATALOG', '如果您希望该促销应用于<b>所有商品</b>，请选定该方框:');
define('TEXT_SALEMAKER_TOP', '全部分类');
define('TEXT_INFO_DATE_ADDED', '加入日期:');
define('TEXT_INFO_DATE_MODIFIED', '最后修改:');
define('TEXT_INFO_DATE_STATUS_CHANGE', '最后状态改变:');
define('TEXT_INFO_SPECIALS_CONDITION', '特价条件:');
define('TEXT_INFO_DEDUCTION', '减价:');
define('TEXT_INFO_PRICERANGE_FROM', '价格范围:');
define('TEXT_INFO_PRICERANGE_TO', ' 到 ');
define('TEXT_INFO_DATE_START', '开始日期:');
define('TEXT_INFO_DATE_END', '结束日期:');
define('SPECIALS_CONDITION_DROPDOWN_0', '忽略特价 - 在原价基础上促销');
define('SPECIALS_CONDITION_DROPDOWN_1', '忽略促销 - 有特价时不允许促销');
define('SPECIALS_CONDITION_DROPDOWN_2', '在特价基础上促销 - 否则在原价基础上促销');
// moved to english.php
/*
define('DEDUCTION_TYPE_DROPDOWN_0', '减价');
define('DEDUCTION_TYPE_DROPDOWN_1', '百分比');
define('DEDUCTION_TYPE_DROPDOWN_2', '新价格');
*/
define('TEXT_INFO_HEADING_COPY_SALE', '复制促销');
define('TEXT_INFO_COPY_INTRO', '输入要复制到的名称<br>&nbsp;&nbsp;"%s"');
define('TEXT_INFO_HEADING_DELETE_SALE', '删除促销');
define('TEXT_INFO_DELETE_INTRO', '您确认要永久删除该促销吗?');
define('TEXT_MORE_INFO', '(详情)');

define('TEXT_WARNING_SALEMAKER_PREVIOUS_CATEGORIES','&nbsp;警告: 该分类中已有%s个促销');
?>