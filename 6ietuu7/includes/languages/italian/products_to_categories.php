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
//  $Id: products_to_categories.php 1168 2005-04-11 18:49:29Z ajeh $
//

define('HEADING_TITLE','链接到多个分类的商品管理 ...');
define('HEADING_TITLE2','分类/商品');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', '可供链接的含有商品的分类 ...');

define('TABLE_HEADING_PRODUCTS_ID', '商品编号');
define('TABLE_HEADING_PRODUCT', '商品名称');
define('TABLE_HEADING_MODEL', '型号');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', '编辑商品到分类的资料');
define('TEXT_PRODUCTS_ID', '商品编号# ');
define('TEXT_PRODUCTS_NAME', '商品: ');
define('TEXT_PRODUCTS_MODEL', '型号: ');
define('TEXT_PRODUCTS_PRICE', '价格: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', '更新分类链接');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', '选择要链接的商品');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', '设置链接到分类的商品: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;目前链接的分类数: ');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO',
'该商品到分类的链接是为了能方便地将当前商品链接到一个或多个分类.<br />您也可以将一个分类下的所有商品链接到另一个分类中，或着删除一个分类中的链接商品，该商品存在另一个分类中. (详见下面的说明)');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER', '由于价格原因, 每个商品无论它链接到多少个分类，都需要有一个主分类。这可以通过主分类的下拉菜单设置。<br />该商品目前链接到上面打叉的分类。要增加新的分类，只有在分类名称前打叉。要删除已有的分类链接，只要去掉分类名称前的叉就行了。<br />当所有需要链接的分类都选择好后，点击' . BUTTON_UPDATE_CATEGORY_LINKS . '<br />');

define('HEADER_CATEGORIES_GLOBAL_CHANGES', '全局分类链接修改及重置主分类编号');

define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>警告:</strong> 在修改链接分类前，必须设置主分类编号');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>复制一个分类中所有商品到另一个分类中为链接商品 ...</strong><br />例如: 使用 8 和 22 将链接所有分类8中的商品到分类22中');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', '选择分类中所有商品: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', '链接到分类: ');
define('BUTTON_COPY_CATEGORY_LINKED', '复制商品为链接 ');

define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', '警告: 商品已重置，不再属于该分类 ...');
define('WARNING_COPY_LINKED', '警告: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', '复制商品的起始分类不正确: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', '复制商品的目标分类不正确: ');
define('WARNING_NO_CATEGORIES_ID', '警告: 没有选择分类 ... 未修改');
define('SUCCESS_COPY_LINKED', '成功更新商品为链接 ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', '复制商品的起始分类有效: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', '复制商品的目标分类有效: ');

define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>警告: 未作修改，商品已经链接 ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>删除一个分类中链接到另一个分类中的所有商品 ...</strong><br />例如: 使用 8 和 22 将删除分类22中所有链接到分类8中的商品链接');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', '选择分类中所有商品: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', '删除到分类的链接: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', '删除商品的链接 ');

define('WARNING_REMOVE_LINKED', '警告: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', '删除链接商品的起始分类不正确: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', '删除链接商品的目标分类不正确: ');
define('SUCCESS_REMOVE_LINKED', '成功删除商品链接 ... ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', '删除链接商品的起始分类有效: ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', '删除链接商品的目标分类有效: ');

define('WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>警告: 未作修改，没有链接商品 ... </strong>');

define('WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>警告: 主分类编号冲突!! </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>主分类编号为: </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', '提示: 主分类用于价格目的，商品分类影响链接商品的价格, 例如: 促销<br />');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', '为了修正该错误, 现在转到冲突的第一个商品. 请重新设定主分类编号，不能为将要删除的分类中的商品主分类编号，然后重试。 当所有冲突都修正后，就可以完全删除你的请求.');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' 冲突的起始分类: ');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' 冲突的目标分类: ');
define('SUCCESS_MASTER_CATEGORIES_ID', '成功更新商品到分类的链接 ...');
define('WARNING_MASTER_CATEGORIES_ID', '警告: 没有设置主分类!');

define('TEXT_PRODUCTS_ID_INVALID', '警告: 商品编号无效或没选择商品');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', '提示: 链接一个分类中所有商品到另一个分类，不需要设置商品编号。<br />但是, 如果设置有效的商品编号，将显示所有可用的分类及编号。');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>重置所选分类中所有商品的主分类编号使用该分类 ...</strong><br />例如: 重置分类22将设置分类22中所有商品使用分类22为主商品编号');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', '重置所有商品的主分类编号于分类: ');
define('BUTTON_RESET_CATEGORY_MASTER', '重置主分类编号');

define('WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', '警告: 选择的分类无效 ...');
define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', '成功更新所有商品的主分类编号为分类: ');

?>