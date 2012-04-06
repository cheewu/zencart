<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: sqlpatch.php 4138 2006-08-14 05:56:44Z drbyte $
//
  define('HEADING_TITLE','SQL工具');
  define('HEADING_WARNING','请备份数据库再执行以下脚本');
  define('HEADING_WARNING2','如果您安装其它模块, 请自行负责.<br />Zen Cart&trade; 不担保其它脚本的安全性. 测试后再用于您的数据库!');
  define('HEADING_WARNING_INSTALLSCRIPTS', '说明: 不要在这里运行Zen Cart数据库升级脚本。<br />请上传新的<strong>zc_install</strong>目录，然后升级。');
  define('TEXT_QUERY_RESULTS','执行结果:');
  define('TEXT_ENTER_QUERY_STRING','输入要执行的语句:&nbsp;&nbsp;<br /><br />以 ; 号结尾');
  define('TEXT_QUERY_FILENAME','上传文件:');
  define('ERROR_NOTHING_TO_DO','错误: 没有执行操作 - 没有指定执行语句或者执行文件.');
  define('TEXT_CLOSE_WINDOW', '[ 关闭窗口 ]');
  define('SQLPATCH_HELP_TEXT','该SQL工具用于安装系统补丁, 直接粘贴SQL代码到文本区. '.
                              '或者上传(.SQL) 脚本文件.<br />' .
                              '创建该工具使用的脚本文件时, 不要包括数据表前缀, 该工具会' .
                              '自动加入当前数据库的前缀, 该设置在商店的 ' .
                              'admin/includes/configure.php 文件中 (DB_PREFIX 定义).<br /><br />' .
                              '输入和上传的命令必须用以下语句开头, 且为大写:'.
                              '<br /><ul><li>DROP TABLE IF EXISTS</li><li>CREATE TABLE</li><li>INSERT INTO</li><li>INSERT IGNORE INTO</li><li>ALTER TABLE</li>' .
                              '<li>UPDATE (just a single table)</li><li>UPDATE IGNORE (just a single table)</li><li>DELETE FROM</li><li>DROP INDEX</li><li>CREATE INDEX</li>' .
                              '<br /><li>SELECT </li></ul>' . 
'<h2>高级模式</h2>以下方法用于更复杂的代码:<br />
To run some blocks of code together so that they are treated as one command by MySQL, you need the "<code>#NEXT_X_ROWS_AS_ONE_COMMAND:xxx</code>" value set.  The parser will then treat X number of commands as one.<br />
If you are running this file thru phpMyAdmin or equivalent, the "#NEXT..." comment is ignored, and the script will process fine.<br />
<br /><strong>提示: </strong>SELECT.... FROM... and LEFT JOIN statements need the "FROM" or "LEFT JOIN" to be on a line by itself in order for the parse script to add the table prefix.<br /><br />
<em><strong>例子:</strong></em>
<ul><li><code>#NEXT_X_ROWS_AS_ONE_COMMAND:4<br />
SET @t1=0;<br />
SELECT (@t1:=configuration_value) as t1 <br />
FROM configuration <br />
WHERE configuration_key = \'KEY_NAME_HERE\';<br />
UPDATE product_type_layout SET configuration_value = @t1 WHERE configuration_key = \'KEY_NAME_TO_CHECK_HERE\';<br />
DELETE FROM configuration WHERE configuration_key = \'KEY_NAME_HERE\';<br />&nbsp;</li>

<li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />
INSERT INTO tablename <br />
(col1, col2, col3, col4)<br />
SELECT col_a, col_b, col_3, col_4<br />
FROM table2;<br />&nbsp;</li>

<li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />
INSERT INTO table1 <br />
(col1, col2, col3, col4 )<br />
SELECT p.othercol_a, p.othercol_b, po.othercol_c, pm.othercol_d<br />
FROM table2 p, table3 pm<br />
LEFT JOIN othercol_f po<br />
ON p.othercol_f = po.othercol_f<br />
WHERE p.othercol_f = pm.othercol_f;</li>
</ul></code>' );
  define('REASON_TABLE_ALREADY_EXISTS','表%s已经存在，无法创建');
  define('REASON_TABLE_DOESNT_EXIST','表%s不存在，无法删除.');
  define('REASON_TABLE_NOT_FOUND','表%s不存在，无法执行.');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','配置值 "%s" 已经存在，无法插入');
  define('REASON_COLUMN_ALREADY_EXISTS','列%s已经存在，无法添加.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','列%s不存在，无法删除.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','列%s不存在，无法修改.');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','prod-type-layout configuration_key "%s" 已经存在，无法插入');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','索引%s于表%s不存在，无法删除.');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','表%s的主关键字不存在，无法删除.');
  define('REASON_INDEX_ALREADY_EXISTS','索引%s于表%s已存在，无法添加.');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','表%s主关键字已经存在，无法添加.');
  define('REASON_NO_PRIVILEGES','用户 '.DB_SERVER_USERNAME.'@'.DB_SERVER.' 没有%s权限访问数据库 '.DB_DATABASE.'.');

?>