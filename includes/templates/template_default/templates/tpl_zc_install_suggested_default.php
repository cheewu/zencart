<?php
/**
 * Page Template
 *
 * This page is auto-displayed if the configure.php file cannot be read properly. It is intended simply to recommend clicking on the zc_install link to begin installation.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_zc_install_suggested_default.php 7544 2007-11-29 04:40:11Z drbyte $
 */
$relPath = (file_exists('includes/templates/template_default/images/logo.gif')) ? '' : '../';
$instPath = (file_exists('zc_install/index.php')) ? 'zc_install/index.php' : (file_exists('../zc_install/index.php') ? '../zc_install/index.php' : '');
$docsPath = (file_exists('docs/index.html')) ? 'docs/index.html' : (file_exists('../docs/index.html') ? '../docs/index.html' : '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<title>请先安装系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="authors" content="The Zen Cart&trade; Team and others" />
<meta name="generator" content="shopping cart program by Zen Cart&trade;, http://www.zen-cart.com" />
<meta name="robots" content="noindex, nofollow" />
<style type="text/css">
<!--
.systemError {color: #FFFFFF}
-->
</style>


</head>

<body style="margin: 20px">
<div style="width: 730px; background-color: #ffffff; margin: auto; padding: 10px; border: 1px solid #cacaca;">
<div>
<img src="<?php echo $relPath; ?>includes/templates/template_default/images/logo.gif" alt="Zen Cart&trade;" title=" Zen Cart&trade; " width="192" height="64" border="0" />
</div>
<h1>您好，多谢使用 Zen Cart&trade; 中文版</h1>
<h2>看到本页面有几个原因:</h2>
<ol>
<li>您是<strong>第一次使用 Zen Cart&trade; 中文版</strong> 且还未正常安装。<br />
如果是这样的话， 
<?php if ($instPath) { ?>
<a href="<?php echo $instPath; ?>">点击这里</a>开始安装。
<?php } else { ?>
请先通过FTP上传 "zc_install" 目录，然后在浏览器中运行 <a href="<?php echo $instPath; ?>">zc_install/index.php</a> (或者刷新本页面查看链接)。
<?php } ?>
<br /><br />
</li>
<li>您的 <tt><strong>/includes/configure.php</strong></tt> 和 <tt><strong>/admin/includes/configure.php</strong></tt> 文件中的<em>路径设置</em>不正确，或者<em>数据库参数</em>不正确。<br />
如果您修改过 configure.php 文件，或者移动了安装目录，那么请更新设置。<br />
可访问 Zen Cart&trade; <a href="http://www.zen-cart.cn/forum/" target="_blank">中文论坛</a>获取更多信息。</li>
</ol>
<br />
<h2>开始安装 ...</h2> 
<ol>
<?php if ($docsPath) { ?>
<li><a href="<?php echo $docsPath; ?>">安装说明</a>请点这里: <a href="<?php echo $docsPath; ?>">文档</a></li>
<?php } else { ?>
<li>安装文档在 Zen Cart&trade; 安装包中的 /docs 目录下。</li>
<?php } ?>
<?php if ($instPath) { ?>
<li>在浏览器中运行<a href="<?php echo $instPath; ?>">zc_install/index.php</a>。</li>
<?php } else { ?>
<li>请先通过FTP上传 "zc_install" 目录，然后在浏览器中运行 <a href="<?php echo $instPath; ?>">zc_install/index.php</a> (或者刷新本页面查看链接)。</li>
<?php } ?>
<li>Zen Cart&trade; <a href="http://www.zen-cart.cn/forum/" target="_blank">中文论坛的新手上路栏目</a>有基本的入门资料。</li>
</ol>

</div>
    <p style="text-align: center; font-size: small;">版权所有 &copy; 2003-<?php echo date('Y'); ?> <a href="http://www.zen-cart.cn" target="_blank">Zen Cart&trade; 中文版</a></p>
</body></html>
