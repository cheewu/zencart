<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: newsletters.php 4385 2006-09-04 04:10:48Z drbyte $
 */

define('HEADING_TITLE', '电子商情/商品通知');

define('TABLE_HEADING_NEWSLETTERS', '电子商情');
define('TABLE_HEADING_SIZE', '大小');
define('TABLE_HEADING_MODULE', '模块');
define('TABLE_HEADING_SENT', '发送');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_NEWSLETTER_MODULE', '模块:');
define('TEXT_NEWSLETTER_TITLE', '标题:');
define('TEXT_NEWSLETTER_CONTENT', '文本格式:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'HTML格式:');

define('TEXT_NEWSLETTER_DATE_ADDED', '加入日期:');
define('TEXT_NEWSLETTER_DATE_SENT', '发送日期:');

define('TEXT_INFO_DELETE_INTRO', '您确认要删除该电子商情吗?');

define('TEXT_PLEASE_WAIT', '请等待 .. 正在发送电子邮件 ..<br /><br />请不要中断该处理!');
define('TEXT_FINISHED_SENDING_EMAILS', '发送电子邮件完成!');

define('TEXT_AFTER_EMAIL_INSTRUCTIONS','共发送%s封电子邮件。(每个复选框表示一个收件人，鼠标移动到复选框上查看电子邮件地址。)<br /><br />查看您的信箱 ('.EMAIL_FROM.'):<UL><LI>a) 退回的邮件</LI><LI>b) 无效的电子邮件地址</LI><LI>c) 退订请求。</LI></UL>退订请求可以通过编辑客户资料来完成，位于 客户管理 | 客户资料');

define('ERROR_NEWSLETTER_TITLE', '错误: 电子商情缺少标题');
define('ERROR_NEWSLETTER_MODULE', '错误: 电子商情缺少模块');
define('ERROR_PLEASE_SELECT_AUDIENCE','错误: 请选择接收该电子商情的客户');
?>