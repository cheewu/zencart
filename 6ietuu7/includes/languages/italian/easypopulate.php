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
// $Id: easypopulate.php,v1.2.5.4 2005/09/29 jack $
//

/**
* $display_output defines
*/
// file uploads display - output via $display_output
define('EASYPOPULATE_DISPLAY_SPLIT_LOCATION','你也可以从 %s 目录中下载分隔文件<br />');
define('EASYPOPULATE_DISPLAY_HEADING','<br /><b><u>上传结果</u></b><br />');
define('EASYPOPULATE_DISPLAY_UPLOADED_FILE_SPEC','<p class=smallText>文件上传成功。<br />临时文件名: %s<br /><b>用户文件名: %s</b><br />大小: %s<br />'); // open paragraph
define('EASYPOPULATE_DISPLAY_LOCAL_FILE_SPEC','<p class=smallText><b>文件名: %s</b><br />'); // open paragraph

// upload results display - output via $display_output
define('EASYPOPULATE_DISPLAY_RESULT_DELETED','<br /><font color="fuchsia"><b>删除成功! - 型号:</b> %s</font>');
define('EASYPOPULATE_DISPLAY_RESULT_DELETE_NOT_FOUND','<br /><font color="darkviolet"><b>没有找到! - 型号:</b> %s - 无法删除...</font>');
define('EASYPOPULATE_DISPLAY_RESULT_CATEGORY_NOT_FOUND', '<br /><font color="red"><b>跳过! - 型号:</b> %s - 商品 %s 没有指定分类</font>');
define('EASYPOPULATE_DISPLAY_RESULT_CATEGORY_NAME_LONG','<br /><font color="red"><b>跳过! - 型号:</b> %s - 分类名称太长 (最多%s个字符)</font>');
define('EASYPOPULATE_DISPLAY_RESULT_MODEL_NAME_LONG','<br /><font color="red"><b>跳过! - 型号: </b>%s - 型号名称太长</font>');
define('EASYPOPULATE_DISPLAY_RESULT_NEW_PRODUCT', '<br /><font color="green"><b>新商品! - 型号:</b> %s</font> | ');
define('EASYPOPULATE_DISPLAY_RESULT_NEW_PRODUCT_FAIL', '<br /><font color="red"><b>添加新商品失败! - 型号:</b> %s - SQL错误。检查上传目录中的错误记录。</font>');
define('EASYPOPULATE_DISPLAY_RESULT_UPDATE_PRODUCT', '<br /><font color="mediumblue"><b>更新成功! - 型号:</b> %s</font> | ');
define('EASYPOPULATE_DISPLAY_RESULT_UPDATE_PRODUCT_FAIL', '<br /><font color="red"><b>商品更新失败! - 型号:</b> %s - SQL错误。检查上传目录中的错误记录</font>');
define('EASYPOPULATE_DISPLAY_RESULT_NO_MODEL', '<br /><font color="red"><b>记录中没有型号字段。该行没有导入</b></font>');
define('EASYPOPULATE_DISPLAY_RESULT_UPLOAD_COMPLETE','<br /><b>上传完成</b></p>'); // close paragraph above


/**
* $messageStack defines
*/
// checks - msg stack alerts - output via $messageStack
define('EASYPOPULATE_MSGSTACK_TEMP_FOLDER_MISSING','<b>批量商品上传目录不存在!</b><br />NIX 服务器: 可能是上传目录不存在，或者你修改了该目录，但没有在配置文件中设置。<br />WINDOWS 服务器: 请设置上传目录可写。通常是设置用户帐号IUSR_COMPUTERNAME。<br />您的配置文件中上传目录名是 <b>%s</b>，位于 <b>%s</b>，但没有找到。<br />请设置上传目录 chmod 700，有时要求777，否则批量商品管理无法上传文件');
define('EASYPOPULATE_MSGSTACK_TEMP_FOLDER_PERMISSIONS_SUCCESS','批量商品管理成功调整上传目录权限! 现在可以上传文件了...');
define('EASYPOPULATE_MSGSTACK_TEMP_FOLDER_PERMISSIONS_SUCCESS_777','批量商品管理成功调整上传目录权限，但是该目录现在任何人都可以访问。请确保添加index.html文件到该目录，防止别人访问/下载您的批量商品管理文件。');
define('EASYPOPULATE_MSGSTACK_MODELSIZE_DETECT_FAIL','批量商品管理无法判断商品型号字段的最大长度。请确保型号数据不超过Zen Cart缺省的32个字符，否则有可能造成数据丢失。');
define('EASYPOPULATE_MSGSTACK_ERROR_SQL', '发现SQL错误。请检查输入数据中的制表符并删除。如果还有错误，请附错误记录并在论坛上提出。');
define('EASYPOPULATE_MSGSTACK_DROSS_DELETE_FAIL', '<b>删除商品数据错误!</b> 请查看上传目录中的错误记录。');
define('EASYPOPULATE_MSGSTACK_DROSS_DELETE_SUCCESS', '删除商品数据成功!');
define('EASYPOPULATE_MSGSTACK_DROSS_DETECTED', '<b> %s 中发现不完整的商品!</b> 请点击<a href="%s">这里</a>删除该错误的记录。<br />显示该信息，是因为数据表中指向的商品不存在，通常是因为删除商品时出错造成的，会导致Zen Cart运行时出错。');
define('EASYPOPULATE_MSGSTACK_DATE_FORMAT_FAIL', '%s 不是正确的日期格式。如果上传非基本格式的日期，会损坏日期数据。请在批量商品管理配置中修改日期格式。');

// install - msg stack alerts - output via $messageStack
define('EASYPOPULATE_MSGSTACK_INSTALL_DELETE_SUCCESS','多余的文件 <b>%s</b> 已从<b>YOUR_ADMIN %s</b> 目录中删除。');
define('EASYPOPULATE_MSGSTACK_INSTALL_DELETE_FAIL','批量商品管理无法删除多余的文件 <b>%s</b>，位于 <b>YOUR_ADMIN %s</b> 目录。请手动删除该文件。');
define('EASYPOPULATE_MSGSTACK_LANGER','批量商品管理开发: <b>langer</b>。捐款帐号: paypal@portability.com.au');
define('EASYPOPULATE_MSGSTACK_INSTALL_CHMOD_FAIL','<b>在修复上传目录问题后，请重新运行批量商品管理安装。</b>');
define('EASYPOPULATE_MSGSTACK_INSTALL_CHMOD_SUCCESS','<b>安装成功!</b>商店的全部商品输出成功，位于上传目录 (临时) 目录，可以用于上传/更新商品的模板。');
define('EASYPOPULATE_MSGSTACK_INSTALL_KEYS_FAIL','<b>批量商品管理配置文件不存在。</b>请点击 %s这里%s 进行配置。');

// file handling - msg stack alerts - output via $messageStack
define('EASYPOPULATE_MSGSTACK_FILE_EXPORT_SUCCESS', '文件 <b>%s.txt</b> 成功导出! 该文件可以从 /%s 目录中下载。');

// html template - bottom of admin/easypopulate.php
// langer - will add after html renovation

/**
* $printsplit defines
*/
// splitting files results text - in $printsplit
define('EASYPOPULATE_FILE_SPLITS_HEADING', '<b><u>逐个上传分割文件</u></b><br /><br />');
define('EASYPOPULATE_FILE_SPLIT_COMPLETED', '已上传 ');
define('EASYPOPULATE_FILE_SPLITS_DONE', '全部完成!<br />');
define('EASYPOPULATE_FILE_SPLIT_PENDING', '等待上传 ');
define('EASYPOPULATE_FILE_SPLIT_ANCHOR_TEXT', '已上传 ');
// misc
define('EASYPOPULATE_FILE_SPLITS_PREFIX', 'Split-');

/**
* $specials_print defines
*/
// results of specials in $specials_print
define('EASYPOPULATE_SPECIALS_HEADING', '<b><u>特价信息</u></b><p class=smallText>'); // open paragraph
define('EASYPOPULATE_SPECIALS_PRICE_FAIL', '<font color="red"><b>跳过! - 型号:</b> %s - 特价高于原价 ...</font><br />');
define('EASYPOPULATE_SPECIALS_NEW', '<font color="green"><b>新! - 型号:</b> %s</font> | %s | %s | <font color="green"><b>%s</b></font> |<br />');
define('EASYPOPULATE_SPECIALS_UPDATE', '<font color="mediumblue"><b>更新成功! - 型号:</b> %s</font> | %s | %s | <font color="green"><b>%s</b></font> |<br />');
define('EASYPOPULATE_SPECIALS_DELETE', '<font color="fuchsia"><b>删除成功! - 型号:</b> %s</font> | %s |<br />');
define('EASYPOPULATE_SPECIALS_DELETE_FAIL', '<font color="darkviolet"><b>没有找到! - 型号:</b> %s - 无法删除特价 ...</font><br />');
define('EASYPOPULATE_SPECIALS_FOOTER', '</p>'); // close paragraph

// error log defines - for ep_debug_log.txt
//define('EASYPOPULATE_ERRORLOG_SQL_ERROR', 'MySQL error %s: %s\nWhen executing:\n%sn');
?>