<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: mail.php 7197 2007-10-06 20:35:52Z drbyte $
 */


define('HEADING_TITLE', '发送邮件');

define('TEXT_CUSTOMER', '客户:');
define('TEXT_SUBJECT', '标题:');
define('TEXT_FROM', '来自:');
define('TEXT_MESSAGE', '文本格式<br />的内容:');
define('TEXT_MESSAGE_HTML','HTML格式<br />的内容:');
define('TEXT_SELECT_CUSTOMER', '选择客户');
define('TEXT_ALL_CUSTOMERS', '所有客户');
define('TEXT_NEWSLETTER_CUSTOMERS', '所有电子商情订阅者');
define('TEXT_ATTACHMENTS_LIST','已选择的附件: ');
define('TEXT_SELECT_ATTACHMENT','服务器上的附件: ');
define('TEXT_SELECT_ATTACHMENT_TO_UPLOAD','需要上传的附件: ');
define('TEXT_ATTACHMENTS_DIR','附件的文件夹: ');

define('NOTICE_EMAIL_SENT_TO', '消息: 邮件发送到: %s');
define('NOTICE_EMAIL_FAILED_SEND', '说明: 发送邮件给所有收件人失败: %s');
define('ERROR_NO_CUSTOMER_SELECTED', '错误: 没有选择客户。');
define('ERROR_NO_SUBJECT', '错误: 没有输入标题。');
define('ERROR_ATTACHMENTS', '错误: 你不能同时选择上传和添加不同附件，请只选择其中一个。');
?>