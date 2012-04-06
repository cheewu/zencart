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
// $Id: backup_mysql.php,v 1.3 2007/04/28 00:00:00 DrByte Exp $
//

// 请正确设置mysql工具的路径，通常为 '/usr/bin/' ... Windows服务器不同。
// Windows主机上，路径类似 'c:/mysql/bin/mysql.exe' 和 'c:/mysql/bin/mysqldump.exe'
define('LOCAL_EXE_MYSQL',     '/usr/bin/mysql');  // used for restores
define('LOCAL_EXE_MYSQLDUMP', '/usr/bin/mysqldump');  // used for backups

// the following are the language definitions
define('HEADING_TITLE', '数据库备份');
define('WARNING_NOT_SECURE_FOR_DOWNLOADS','<span class="errorText">提示: 没有使用SSL。本页面上的所有下载都未加密。备份和恢复问题不大，但从服务器下载或上传文件存在安全隐患。');
define('TABLE_HEADING_TITLE', '标题');
define('TABLE_HEADING_FILE_DATE', '日期');
define('TABLE_HEADING_FILE_SIZE', '大小');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_HEADING_NEW_BACKUP', '新建备份');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', '本地恢复');
define('TEXT_INFO_NEW_BACKUP', '备份要花几分钟，不要中断备份进程。');
define('TEXT_INFO_UNPACK', '<br><br>(将文件从档案中展开后)');
define('TEXT_INFO_RESTORE', '不要中断恢复进程。<br><br>备份文件 越大, 处理时间 越久! <br><br>可能的话, 使用mysql客户<br><br>例如:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', '不要中断恢复进程。<br><br>备份文件 越大, 处理时间 越久! ');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', '上传的文件必须是sql脚本文件(文本)。');
define('TEXT_INFO_DATE', '日期:');
define('TEXT_INFO_SIZE', '大小:');
define('TEXT_INFO_COMPRESSION', '压缩:');
define('TEXT_INFO_USE_GZIP', '使用GZIP');
define('TEXT_INFO_USE_ZIP', '使用ZIP');
define('TEXT_INFO_SKIP_LOCKS', '跳过加锁选项 (如果遇到锁定数据表权限错误，选定该选项)');
define('TEXT_INFO_USE_NO_COMPRESSION', '未压缩 (纯SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', '不保存在服务器上，直接下载');
define('TEXT_INFO_BEST_THROUGH_HTTPS', '(使用HTTPS安全连接)');
define('TEXT_DELETE_INTRO', '您要删除该备份吗?');
define('TEXT_NO_EXTENSION', '无');
define('TEXT_BACKUP_DIRECTORY', '备份目录:');
define('TEXT_LAST_RESTORATION', '上次恢复:');
define('TEXT_FORGET', '(忽略)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', '错误: 备份目录不存在。请在configure.php文件中设置。');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', '错误: 备份目录不可写。');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', '错误: 下载链接不正确。');
define('ERROR_CANT_BACKUP_IN_SAFE_MODE','错误: safe_mode打开时，备份脚本不能正常允许，或者是open_basedir进行了限制<br />如果备份时没有错误，检查文件大小是否小于200kb。如果是，说明备份不可靠。');
define('ERROR_EXEC_DISABLED','错误: 您的服务器禁止了"exec()"命令，无法执行脚本，请咨询主机商。');
define('ERROR_FILE_NOT_REMOVEABLE', '错误: 无法删除指定的文件。由于服务器限制，请通过FTP删除。');

define('SUCCESS_LAST_RESTORE_CLEARED', '成功: 上次恢复的数据清除了。');
define('SUCCESS_DATABASE_SAVED', '成功: 数据库保存了。');
define('SUCCESS_DATABASE_RESTORED', '成功: 数据库恢复了。');
define('SUCCESS_BACKUP_DELETED', '成功: 备份删除了。');
define('FAILURE_DATABASE_NOT_SAVED', '失败: 数据库没有保存。');
define('FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND', '错误: 无法找到MYSQLDUMP备份工具。备份失败。');
define('FAILURE_DATABASE_NOT_RESTORED', '失败: 数据库可能没有正确恢复。请仔细检查。');
define('FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND', '失败: 数据库没有恢复。错误: 文件没找到: %s');
define('FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND', '错误: 没有找到MYSQL恢复工具。恢复失败。');
define('FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS','备份失败，执行备份程序(mysqldump 或 mysqldump.exe)时出错。<br />如果在Windows 2003 server上，可能需要修改cmd.exe的执行权限，允许Internet匿名帐号读写。<br />请咨询主机商有关如何执行exec()命令。');

// Set this to 'true' if the zip options aren't appearing while doing a backup, and you are certain that gzip support exists on your server
define('COMPRESS_OVERRIDE','false');

?>