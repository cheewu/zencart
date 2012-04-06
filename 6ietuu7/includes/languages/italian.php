<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: schinese.php 7440 2007-12-06 Jack $
 */
if (!defined('IS_ADMIN_FLAG'))
{
  die('Illegal Access');
}
// added defines for header alt and text
define('HEADER_ALT_TEXT', 'Zen Cart 管理中心');
define('HEADER_LOGO_WIDTH', '200px');
define('HEADER_LOGO_HEIGHT', '70px');
define('HEADER_LOGO_IMAGE', 'logo.gif');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'zh_CN.UTF-8');
define('DATE_FORMAT_SHORT', '%Y/%m/%d');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%m/%d/%Y'); // this is used for strftime()
define('DATE_FORMAT', 'Y/m/d'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'Y/m/d H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'yyyy/MM/dd');  //Use only 'dd', 'MM' and 'yyyy' here in any order

////
// Return date in raw format
// $date should be in format yyyy/mm/dd
// raw date is in format YYYYMMDD, or DDMMYYYY
function zen_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 8, 2) . substr($date, 5, 2) . substr($date, 0, 4);
  } else {
    return substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2);
  }
}

// removed for meta tags
// page title
//define('TITLE', 'Zen Cart');

// include template specific meta tags defines
  if (file_exists(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');
//die(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// meta tags
define('ICON_METATAGS_ON', 'Meta标签已定义');
define('ICON_METATAGS_OFF', 'Meta标签未定义');
define('TEXT_LEGEND_META_TAGS', 'Meta标签已定义:');
define('TEXT_INFO_META_TAGS_USAGE', '<strong>提示:</strong> 在文件meta_tags.php中的Site/Tagline定义您的网站.');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="zh"');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// header text in includes/header.php
define('HEADER_TITLE_TOP', '管理首页');
define('HEADER_TITLE_SUPPORT_SITE', '支持网站');
define('HEADER_TITLE_ONLINE_CATALOG', '商店首页');
define('HEADER_TITLE_VERSION', '版本');
define('HEADER_TITLE_LOGOFF', '退出');
//define('HEADER_TITLE_ADMINISTRATION', '管理');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','礼券');
  define('TEXT_GV_NAMES','礼券');
  define('TEXT_DISCOUNT_COUPON', '优惠券');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','兑现代码');

// text for gender
define('MALE', '先生');
define('FEMALE', '女士');

// text for date of birth example
define('DOB_FORMAT_STRING', 'yyyy/mm/dd');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', '商店设置');
define('BOX_CONFIGURATION_MYSTORE', '基本设置');
define('BOX_CONFIGURATION_LOGGING', '日志');
define('BOX_CONFIGURATION_CACHE', '缓存');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', '模块管理');
define('BOX_MODULES_PAYMENT', '支付模块');
define('BOX_MODULES_SHIPPING', '配送模块');
define('BOX_MODULES_ORDER_TOTAL', '总额计算');
define('BOX_MODULES_PRODUCT_TYPES', '商品类型');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', '商品管理');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', '商品分类');
define('BOX_CATALOG_PRODUCT_TYPES', '商品类型');
define('BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', '选项名称');
define('BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', '选项内容');
define('BOX_CATALOG_MANUFACTURERS', '厂商管理');
define('BOX_CATALOG_REVIEWS', '评论管理');
define('BOX_CATALOG_SPECIALS', '特价商品');
define('BOX_CATALOG_PRODUCTS_EXPECTED', '预售商品');
define('BOX_CATALOG_SALEMAKER', '促销管理');
define('BOX_CATALOG_PRODUCTS_PRICE_MANAGER', '价格管理');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', '客户管理');
define('BOX_CUSTOMERS_CUSTOMERS', '客户资料');
define('BOX_CUSTOMERS_ORDERS', '订单管理');
define('BOX_CUSTOMERS_GROUP_PRICING', '团体价格');
define('BOX_CUSTOMERS_PAYPAL', 'PayPal付款通知');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', '地区税率');
define('BOX_TAXES_COUNTRIES', '国家代码');
define('BOX_TAXES_ZONES', '地区代码');
define('BOX_TAXES_GEO_ZONES', '地区设置');
define('BOX_TAXES_TAX_CLASSES', '税率种类');
define('BOX_TAXES_TAX_RATES', '税率管理');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', '分析系统');
define('BOX_REPORTS_PRODUCTS_VIEWED', '访问统计');
define('BOX_REPORTS_PRODUCTS_PURCHASED', '销售统计');
define('BOX_REPORTS_ORDERS_TOTAL', '订单统计');
define('BOX_REPORTS_PRODUCTS_LOWSTOCK', '商品库存');
define('BOX_REPORTS_CUSTOMERS_REFERRALS', '客户推荐');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', '工具');
define('BOX_TOOLS_ADMIN', '管理设置');
define('BOX_TOOLS_TEMPLATE_SELECT', '模板选择');
define('BOX_TOOLS_BACKUP', '数据库备份');
define('BOX_TOOLS_BANNER_MANAGER', '广告管理');
define('BOX_TOOLS_CACHE', '缓冲控制');
define('BOX_TOOLS_DEFINE_LANGUAGE', '选择语言');
define('BOX_TOOLS_FILE_MANAGER', '文件管理');
define('BOX_TOOLS_MAIL', '电子邮件');
define('BOX_TOOLS_NEWSLETTER_MANAGER', '电子商情/商品通知');
define('BOX_TOOLS_SERVER_INFO', '服务器/版本信息');
define('BOX_TOOLS_WHOS_ONLINE', '在线名单');
define('BOX_TOOLS_STORE_MANAGER', '商店管理');
define('BOX_TOOLS_DEVELOPERS_TOOL_KIT', '开发工具');
define('BOX_TOOLS_SQLPATCH','安装SQL脚本');
define('BOX_TOOLS_EZPAGES','简易页面管理');

define('BOX_HEADING_EXTRAS', '其他');

// define pages editor files
define('BOX_TOOLS_DEFINE_PAGES_EDITOR','页面编辑');
define('BOX_TOOLS_DEFINE_MAIN_PAGE', '首页');
define('BOX_TOOLS_DEFINE_CONTACT_US','联系我们');
define('BOX_TOOLS_DEFINE_PRIVACY','隐私声明');
define('BOX_TOOLS_DEFINE_SHIPPINGINFO','发货付款');
define('BOX_TOOLS_DEFINE_CONDITIONS','顾客须知');
define('BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS','结帐完成');
define('BOX_TOOLS_DEFINE_PAGE_2','第2页');
define('BOX_TOOLS_DEFINE_PAGE_3','第3页');
define('BOX_TOOLS_DEFINE_PAGE_4','第4页');


// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', '界面设定');
define('BOX_LOCALIZATION_CURRENCIES', '货币代码');
define('BOX_LOCALIZATION_LANGUAGES', '语言代码');
define('BOX_LOCALIZATION_ORDERS_STATUS', '订单状态');

// gift vouchers box text in includes/boxes/gv_admin.php
define('BOX_HEADING_GV_ADMIN', TEXT_GV_NAME . '优惠券');
define('BOX_GV_ADMIN_QUEUE',  TEXT_GV_NAMES . '队列');
define('BOX_GV_ADMIN_MAIL', '发送' . TEXT_GV_NAME );
define('BOX_GV_ADMIN_SENT', '已发' . TEXT_GV_NAMES);
define('BOX_COUPON_ADMIN','优惠券管理');

define('IMAGE_RELEASE', '兑现' . TEXT_GV_NAME);

// javascript messages
define('JS_ERROR', '处理您的表格时出现错误!\n请做以下修改:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* 请输入新商品价格\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* 请输入新商品货币单位\n');

define('JS_PRODUCTS_NAME', '* 请输入新商品名称\n');
define('JS_PRODUCTS_DESCRIPTION', '* 请输入新商品简介\n');
define('JS_PRODUCTS_PRICE', '* 请输入新商品价格\n');
define('JS_PRODUCTS_WEIGHT', '* 请输入新商品重量\n');
define('JS_PRODUCTS_QUANTITY', '* 请输入新商品数量\n');
define('JS_PRODUCTS_MODEL', '* 请输入新商品型号\n');
define('JS_PRODUCTS_IMAGE', '* 请提供新商品图像\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* 请输入商品的新价格\n');

define('JS_GENDER', '* 请选择\'称呼\'。\n');
define('JS_FIRST_NAME', '* \'名字\'一栏至少要有' . ENTRY_FIRST_NAME_MIN_LENGTH . '个字符。\n');
define('JS_LAST_NAME', '* \'姓氏\'一栏至少要有' . ENTRY_LAST_NAME_MIN_LENGTH . '个字符。\n');
define('JS_DOB', '* \'出生日期\'一栏的格式是: xx/xx/xxxx (年/月/日)。\n');
define('JS_EMAIL_ADDRESS', '* \'电子邮件\'一栏至少要有' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . '个字符。\n');
define('JS_ADDRESS', '* \'地址\'一栏至少要有' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '个字符。\n');
define('JS_POST_CODE', '* \'邮编\'一栏至少要有' . ENTRY_POSTCODE_MIN_LENGTH . '个字符。\n');
define('JS_CITY', '* \'城市\'一栏至少要有' . ENTRY_CITY_MIN_LENGTH . '个字符。\n');
define('JS_STATE', '* \'省份\'是必选项.\n');
define('JS_STATE_SELECT', '-- 选择 --');
define('JS_ZONE', '* \'省份\'一栏要从该国家的列表中选取.');
define('JS_COUNTRY', '* \'国家\'是必选项.\n');
define('JS_TELEPHONE', '* \'电话号码\'一栏至少要有' . ENTRY_TELEPHONE_MIN_LENGTH . '个字符。\n');
define('JS_PASSWORD', '* \'密码\' 和 \'密码确认\' 栏必须一致而且不少于' . ENTRY_PASSWORD_MIN_LENGTH . '个字符。\n');

define('JS_ORDER_DOES_NOT_EXIST', '订单号%s不存在!');

define('CATEGORY_PERSONAL', '个人资料');
define('CATEGORY_ADDRESS', '地址信息');
define('CATEGORY_CONTACT', '联系方式');
define('CATEGORY_COMPANY', '公司资料');
define('CATEGORY_OPTIONS', '其它选项');

define('ENTRY_GENDER', '称呼:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">必填</span>');
define('ENTRY_FIRST_NAME', '名字:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_FIRST_NAME_MIN_LENGTH . '个字符</span>');
define('ENTRY_LAST_NAME', '姓氏:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_LAST_NAME_MIN_LENGTH . '个字符</span>');
define('ENTRY_DATE_OF_BIRTH', '出生日期:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(例如：1970/05/21)</span>');
define('ENTRY_EMAIL_ADDRESS', '电子邮件:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . '个字符</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">电子邮件地址不对!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">该电子邮件地址已经使用!</span>');
define('ENTRY_COMPANY', '公司名称:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_PRICING_GROUP', '优惠团体');
define('ENTRY_STREET_ADDRESS', '详细地址:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '个字符</span>');
define('ENTRY_SUBURB', '');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', '邮编:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_POSTCODE_MIN_LENGTH . '个字符</span>');
define('ENTRY_CITY', '城市:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_CITY_MIN_LENGTH . '个字符</span>');
define('ENTRY_STATE', '省份:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">必选</span>');
define('ENTRY_COUNTRY', '国家:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', '电话号码:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">至少' . ENTRY_TELEPHONE_MIN_LENGTH . '个字符</span>');
define('ENTRY_FAX_NUMBER', '传真:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', '电子商情:');
define('ENTRY_NEWSLETTER_YES', '订阅');
define('ENTRY_NEWSLETTER_NO', '退订');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
//define('IMAGE_ANI_SEND_EMAIL', '电子邮件');
define('IMAGE_BACK', '返回');
define('IMAGE_BACKUP', '备份');
define('IMAGE_CANCEL', '取消');
define('IMAGE_CONFIRM', '确认');
define('IMAGE_COPY', '复制');
define('IMAGE_COPY_TO', '复制到');
define('IMAGE_DETAILS', '详细资料');
define('IMAGE_DELETE', '删除');
define('IMAGE_EDIT', '编辑');
define('IMAGE_EMAIL', '电子邮件');
define('IMAGE_FILE_MANAGER', '文件管理');
define('IMAGE_ICON_STATUS_GREEN', '开启');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', '启用');
define('IMAGE_ICON_STATUS_RED', '关闭');
define('IMAGE_ICON_STATUS_RED_LIGHT', '停用');
define('IMAGE_ICON_STATUS_RED_EZPAGES', '错误 -- 输入太多URL/类型');
define('IMAGE_ICON_STATUS_RED_ERROR', '错误');
define('IMAGE_ICON_INFO', '信息');
define('IMAGE_INSERT', '加入');
define('IMAGE_LOCK', '锁定');
define('IMAGE_MODULE_INSTALL', '安装模块');
define('IMAGE_MODULE_REMOVE', '删除模块');
define('IMAGE_MOVE', '移动');
define('IMAGE_NEW_BANNER', '新广告');
define('IMAGE_NEW_CATEGORY', '新分类');
define('IMAGE_NEW_COUNTRY', '新国家');
define('IMAGE_NEW_CURRENCY', '新货币');
define('IMAGE_NEW_FILE', '新文件');
define('IMAGE_NEW_FOLDER', '新目录');
define('IMAGE_NEW_LANGUAGE', '新语言');
define('IMAGE_NEW_NEWSLETTER', '新建电子商情');
define('IMAGE_NEW_PRODUCT', '新商品');
define('IMAGE_NEW_SALE', '新促销');
define('IMAGE_NEW_TAX_CLASS', '新税种');
define('IMAGE_NEW_TAX_RATE', '新税率');
define('IMAGE_NEW_TAX_ZONE', '新税区');
define('IMAGE_NEW_ZONE', '新地区');
define('IMAGE_OPTION_NAMES', '选项名称管理');
define('IMAGE_OPTION_VALUES', '选项内容管理');
define('IMAGE_ORDERS', '订单');
define('IMAGE_ORDERS_INVOICE', '发票');
define('IMAGE_ORDERS_PACKINGSLIP', '装箱清单');
define('IMAGE_PREVIEW', '预览');
define('IMAGE_RESTORE', '恢复');
define('IMAGE_RESET', '重置');
define('IMAGE_SAVE', '保存');
define('IMAGE_SEARCH', '搜索');
define('IMAGE_SELECT', '选择');
define('IMAGE_SEND', '发送');
define('IMAGE_SEND_EMAIL', '电子邮件');
define('IMAGE_UNLOCK', '解锁');
define('IMAGE_UPDATE', '更新');
define('IMAGE_UPDATE_CURRENCIES', '更新货币');
define('IMAGE_UPLOAD', '上传');
define('IMAGE_TAX_RATES','税率');
define('IMAGE_DEFINE_ZONES','地区设置');
define('IMAGE_PRODUCTS_PRICE_MANAGER', '价格管理');
define('IMAGE_UPDATE_PRICE_CHANGES', '更新价格');
define('IMAGE_ADD_BLANK_DISCOUNTS','增加 ' . DISCOUNT_QTY_ADD . ' 空白优惠数量');
define('IMAGE_CHECK_VERSION', '检查Zen Cart更新');
define('IMAGE_PRODUCTS_TO_CATEGORIES', '多个分类链接管理');

define('IMAGE_ICON_STATUS_ON', '状态 - 开启');
define('IMAGE_ICON_STATUS_OFF', '状态 - 关闭');
define('IMAGE_ICON_LINKED', '商品已链接');

define('IMAGE_REMOVE_SPECIAL','删除特价信息');
define('IMAGE_REMOVE_FEATURED','删除推荐商品信息');
define('IMAGE_INSTALL_SPECIAL', '增加特价信息');
define('IMAGE_INSTALL_FEATURED', '增加推荐商品信息');

define('ICON_PRODUCTS_PRICE_MANAGER','价格管理');
define('ICON_COPY_TO', '复制到');
define('ICON_CROSS', '错误');
define('ICON_CURRENT_FOLDER', '当前目录');
define('ICON_DELETE', '删除');
define('ICON_EDIT', '编辑');
define('ICON_ERROR', '错误');
define('ICON_FILE', '文件');
define('ICON_FILE_DOWNLOAD', '下载');
define('ICON_FOLDER', '目录');
//define('ICON_LOCKED', '锁定');
define('ICON_MOVE', '移动');
define('ICON_PREVIOUS_LEVEL', '上一级');
define('ICON_PREVIEW', '预览');
define('ICON_RESET', '重置');
define('ICON_STATISTICS', '统计');
define('ICON_SUCCESS', '成功');
define('ICON_TICK', '是');
//define('ICON_UNLOCKED', '解锁');
define('ICON_WARNING', '警告');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', '第%s页，共%d页');
define('TEXT_DISPLAY_NUMBER_OF_ADMINS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>名管理员)');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个广告)');
define('TEXT_DISPLAY_NUMBER_OF_CATEGORIES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个分类)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个国家)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个客户)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>种货币)');
define('TEXT_DISPLAY_NUMBER_OF_FEATURED', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个推荐商品)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>种语言)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个厂商)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>篇电子商情)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>份订单)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个订单状态)');
define('TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个团体价格)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>件商品)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>种商品类型)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>件预售商品)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>条商品评论)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>件促销商品)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>件特价商品)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个税种)');
define('TEXT_DISPLAY_NUMBER_OF_TEMPLATES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个相关模块)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个税区)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个税率)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个地区)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');


define('TEXT_DEFAULT', '默认');
define('TEXT_SET_DEFAULT', '设为默认');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* 必填</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', '错误: 没有默认货币。请到以下菜单设定: 管理工具->界面设定->货币');

define('TEXT_CACHE_CATEGORIES', '分类方框');
define('TEXT_CACHE_MANUFACTURERS', '厂商方框');
define('TEXT_CACHE_ALSO_PURCHASED', '同时购买模块');

define('TEXT_NONE', '无');
define('TEXT_TOP', '首页');

define('ERROR_DESTINATION_DOES_NOT_EXIST', '错误: 目标不存在 %s');
define('ERROR_DESTINATION_NOT_WRITEABLE', '错误: 目标不可写入 %s');
define('ERROR_FILE_NOT_SAVED', '错误: 上传文件没有保存.');
define('ERROR_FILETYPE_NOT_ALLOWED', '错误: 上传文件类型不允许  %s');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', '成功: 上传文件成功保存 %s');
define('WARNING_NO_FILE_UPLOADED', '警告: 没有文件上传.');
define('WARNING_FILE_UPLOADS_DISABLED', '警告: php.ini文件中设置为不允许上传文件.');
define('ERROR_ADMIN_SECURITY_WARNING', '警告: 您的管理员帐号不安全 ... 您未修改缺省的帐号: Admin/admin 或者还未删除或修改帐号: demo/demoonly<br />出于安全考虑，请尽快修改该帐号。<br />在 工具->管理设置 页面下设置用户名和密码。<br />关于其它安全因素，请参阅/doc');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE','您的数据库需要升级。在[工具->服务器信息]下查询当前版本。');
define('WARN_DATABASE_VERSION_PROBLEM','true'); //set to false to turn off warnings about database version mismatches
define('WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>警告:</strong> 网站目前处于维护模式 ...<br />说明: 在维护模式下不能测试多数支付模块和配送模块');
define('WARNING_BACKUP_CFG_FILES_TO_DELETE', '警告: 请删除这些文件以保证安全y: ');
define('WARNING_INSTALL_DIRECTORY_EXISTS', '警告: 存在安装目录: ' . DIR_FS_CATALOG . 'zc_install。请删除该目录以保证安全。');
define('WARNING_CONFIG_FILE_WRITEABLE', '警告: 配置文件: %sincludes/configure.php，存在潜在安全风险 - 请设置只读权限 (CHMOD 644 或 444)');
define('WARNING_COULD_NOT_LOCATE_LANG_FILE', '警告: 找不到语言文件: ');
define('ERROR_MODULE_REMOVAL_PROHIBITED', '错误: 禁止删除模块: ');

define('_JANUARY', '一月');
define('_FEBRUARY', '二月');
define('_MARCH', '三月');
define('_APRIL', '四月');
define('_MAY', '五月');
define('_JUNE', '六月');
define('_JULY', '七月');
define('_AUGUST', '八月');
define('_SEPTEMBER', '九月');
define('_OCTOBER', '十月');
define('_NOVEMBER', '十一月');
define('_DECEMBER', '十二月');

define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>张礼券)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>张优惠券)');

define('TEXT_VALID_PRODUCTS_LIST', '商品列表');
define('TEXT_VALID_PRODUCTS_ID', '商品编号');
define('TEXT_VALID_PRODUCTS_NAME', '商品名称');
define('TEXT_VALID_PRODUCTS_MODEL', '商品型号');

define('TEXT_VALID_CATEGORIES_LIST', '分类列表');
define('TEXT_VALID_CATEGORIES_ID', '分类编号');
define('TEXT_VALID_CATEGORIES_NAME', '分类名称');

define('DEFINE_LANGUAGE','选择语言:');

define('BOX_ENTRY_COUNTER_DATE','点击开始日期:');
define('BOX_ENTRY_COUNTER','点击计数:');

// not installed
define('NOT_INSTALLED_TEXT','没有安装');

// Product Options Values Sort Order - option_values.php
  define('BOX_CATALOG_PRODUCT_OPTIONS_VALUES','选项内容排序 ');

  define('TEXT_UPDATE_SORT_ORDERS_OPTIONS','<strong>更新选项排序</strong>');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES','<strong>更新所有商品的属性排序</strong><br />为缺省排序:<br />');

// Product Options Name Sort Order - option_values.php
  define('BOX_CATALOG_PRODUCT_OPTIONS_NAME','选项名称排序');

// Attributes only
  define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER','属性控制');

// generic model
  define('TEXT_MODEL','型号:');

// column controller
  define('BOX_TOOLS_LAYOUT_CONTROLLER','外观控制');

// check GV release queue and alert store owner
  define('SHOW_GV_QUEUE',true);
  define('TEXT_SHOW_GV_QUEUE','%s张礼券等待审核');
  define('IMAGE_GIFT_QUEUE', TEXT_GV_NAME . '队列');
  define('IMAGE_ORDER','订单');

  define('BOX_TOOLS_EMAIL_WELCOME','欢迎邮件');

  define('IMAGE_DISPLAY','显示');
  define('IMAGE_UPDATE_SORT','更新排序');
  define('IMAGE_EDIT_PRODUCT','编辑商品');
  define('IMAGE_EDIT_ATTRIBUTES','编辑属性');
  define('TEXT_NEW_PRODUCT', '商品的分类: &quot;%s&quot;');
  define('IMAGE_OPTIONS_VALUES','选项名称和选项内容');
  define('TEXT_PRODUCTS_PRICE_MANAGER','价格管理');
  define('TEXT_PRODUCT_EDIT','编辑商品');
  define('TEXT_ATTRIBUTE_EDIT','编辑属性');
  define('TEXT_PRODUCT_DETAILS','查看详情');

// sale maker
  define('DEDUCTION_TYPE_DROPDOWN_0', '金额');
  define('DEDUCTION_TYPE_DROPDOWN_1', '百分比');
  define('DEDUCTION_TYPE_DROPDOWN_2', '新价格');

// Min and Units
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','最少:');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','单位:');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','购物车中:');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','新增:');

  define('TEXT_PRODUCTS_MIX_OFF','*不能混合选项');
  define('TEXT_PRODUCTS_MIX_ON','*可以混合选项');

// search filters
  define('TEXT_INFO_SEARCH_DETAIL_FILTER','搜索筛选: ');
  define('HEADING_TITLE_SEARCH_DETAIL','搜索: ');
  define('HEADING_TITLE_SEARCH_DETAIL_REPORTS', '搜索商品 - 用逗号分开');
  define('HEADING_TITLE_SEARCH_DETAIL_REPORTS_NAME_MODEL', '搜索商品名称/型号');

  define('PREV_NEXT_PRODUCT', '商品: ');
  define('TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*分类不可用</span>');
  define('TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*商品不可用</span>');

// admin demo
  define('ADMIN_DEMO_ACTIVE','正处于演示模式中. 某些设置不可用');
  define('ADMIN_DEMO_ACTIVE_EXCLUSION','正处于演示模式中. 某些设置不可用 - <strong>备注: 演示设置开启</strong>');
  define('ERROR_ADMIN_DEMO','正处于演示模式中 ... 您想执行的操作暂时关闭');

// Version Check notices
  define('TEXT_VERSION_CHECK_NEW_VER','新版本发布了 v');
  define('TEXT_VERSION_CHECK_NEW_PATCH','新补丁发布了: v');
  define('TEXT_VERSION_CHECK_PATCH','补丁');
  define('TEXT_VERSION_CHECK_DOWNLOAD','下载');
  define('TEXT_VERSION_CHECK_CURRENT','您的Zen Cart&trade; 是最新版本.');

// downloads manager
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', '显示<b>%d</b>到<b>%d</b> (共<b>%d</b>个下载)');
define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', '下载管理');

define('BOX_CATALOG_FEATURED','推荐商品');

define('ERROR_NOTHING_SELECTED', '没有选择 ... 没有任何修改');
define('TEXT_STATUS_WARNING','<strong>备注:</strong> 日期设定后，状态会自动开启/关闭');

define('TEXT_LEGEND_LINKED', '链接商品');
define('TEXT_MASTER_CATEGORIES_ID','商品主分类:');
define('TEXT_LEGEND', '图示: ');
define('TEXT_LEGEND_STATUS_OFF', '关闭状态');
define('TEXT_LEGEND_STATUS_ON', '开启状态');

define('TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>备注: 主分类用于定价，分类影响链接商品的价格。例如促销</strong>');
define('TEXT_YES', '是');
define('TEXT_NO', '否');

// shipping error messages
define('ERROR_SHIPPING_CONFIGURATION', '<strong>配送参数设置错误!</strong>');
define('ERROR_SHIPPING_ORIGIN_ZIP', '<strong>警告:</strong> 商店邮编未输入。在 商店设置 | 配送参数 中设置.');
define('ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>警告:</strong> 无重量商品设为免费运输，但免费运输模块没有开启');
define('ERROR_USPS_STATUS', '<strong>警告:</strong> USPS配送模块没有设置用户名，或者正处于测试模式。<br />如果您无法接收USPS运费报价, 联系USPS并激活您的网页工具帐号。1-800-344-7779 或 icustomercare@usps.com');

define('ERROR_SHIPPING_MODULES_NOT_DEFINED', '说明: 没有设置配送模块。请在 模块管理->配送模块 中设置。');
define('ERROR_PAYMENT_MODULES_NOT_DEFINED', '说明: 没有设置支付模块。请在 模块管理->支付模块 中设置。');

// text pricing
define('TEXT_CHARGES_WORD','计算费用:');
define('TEXT_PER_WORD','<br />每词价格: ');
define('TEXT_WORDS_FREE',' 免费词 ');
define('TEXT_CHARGES_LETTERS','计算费用:');
define('TEXT_PER_LETTER','<br />每字母价格: ');
define('TEXT_LETTERS_FREE',' 免费字 ');
define('TEXT_ONETIME_CHARGES','*基本费 = ');
define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . '*基本费 = ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', '选项数量优惠');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','数量');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','价格');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', '数量优惠基本费');
define('TEXT_CATEGORIES_PRODUCTS', '选择商品分类 ...或选择商品');
define('TEXT_PRODUCT_TO_VIEW', '选择商品然后点显示 ...');

define('TEXT_INFO_SET_MASTER_CATEGORIES_ID', '设置主分类');
define('TEXT_INFO_ID', ' ID ');
define('TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>警告:</strong> 该商品链接到多个分类，但没有定义主分类!');

define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', '价格面议');
define('PRODUCTS_PRICE_IS_FREE_TEXT','免费商品');

define('TEXT_PRODUCT_WEIGHT_UNIT','克');

// min, max, units
define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', '最多:');

// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','节省:&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','% 优惠');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;优惠');
// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','促销:&nbsp;');

// Rich Text / HTML resources
define('TEXT_HTML_EDITOR_NOT_DEFINED','如果您没有定义HTML编辑器或者JavaScript关闭了, 可以手工输入原HTML文本.');
define('TEXT_WARNING_HTML_DISABLED','<span class = "main">备注: 您正使用文本格式的电子邮件. 如果你希望使用HTML格式, 需要在电子邮件选项下打开 "使用 MIME HTML" </span>');
define('TEXT_WARNING_CANT_DISPLAY_HTML','<span class = "main">备注: 您正使用文本格式的电子邮件. 如果你希望使用HTML格式, 需要在电子邮件选项下打开 "使用 MIME HTML" </span>');
define('TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML',"如果您看到这个信息，是因为我们发给您的电子邮件是HTML格式，但您的电子邮件阅读程序无法显示HTML信息.");
define('ENTRY_EMAIL_PREFERENCE','电子邮件格式选择:');
define('ENTRY_EMAIL_FORMAT_COMMENTS','选择 "无" 或 "退出" 关闭所有邮件, 包括订单详情');
define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
define('ENTRY_EMAIL_TEXT_DISPLAY','文本格式');
define('ENTRY_EMAIL_NONE_DISPLAY','不收邮件');
define('ENTRY_EMAIL_OPTOUT_DISPLAY','退订电子商情');
define('ENTRY_NOTHING_TO_SEND','您还没有输入任何内容');
 define('EMAIL_SEND_FAILED','错误: 发送邮件给: "%s" <%s> 主题: "%s"失败');

  define('EDITOR_NONE', '纯文本');
  define('TEXT_EDITOR_INFO', '文本编辑器');
  define('ERROR_EDITORS_FOLDER_NOT_FOUND', '您在\'商店设置\'中选择了HTML编辑器，但无法找到\'/editors/\'目录。请重新选择或将编辑器文件移动到\''.DIR_WS_CATALOG.'editors/\'目录');
  define('TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', '显示顺序');
  define('TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', '商品排序，商品名称');
  define('TEXT_SORT_PRODUCTS_NAME', '商品名称');
  define('TEXT_SORT_PRODUCTS_MODEL', '商品型号');
  define('TEXT_SORT_PRODUCTS_QUANTITY', '商品数量+, 商品名称');
  define('TEXT_SORT_PRODUCTS_QUANTITY_DESC', '商品数量-, 商品名称');
  define('TEXT_SORT_PRODUCTS_PRICE', '商品价格+, 商品名称');
  define('TEXT_SORT_PRODUCTS_PRICE_DESC', '商品价格-, 商品名称');
  define('TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', '分类排序, 分类名称');
  define('TEXT_SORT_CATEGORIES_NAME', '分类名称');

  define('TABLE_HEADING_YES','是');
  define('TABLE_HEADING_NO','否');
  define('TEXT_PRODUCTS_IMAGE_MANUAL', '<br /><strong>或从服务器上选择已有图像文件，文件名:</strong>');
  define('TEXT_IMAGES_OVERWRITE', '<strong>覆盖原有图像吗?</strong> ');
  define('TEXT_IMAGE_OVERWRITE_WARNING','警告: 文件名更新了但没有覆盖 ');
  define('TEXT_IMAGES_DELETE', '<strong>删除图像吗?</strong> 说明: 从商品中删除，但不删除图像文件:');
  define('TEXT_IMAGE_CURRENT', '图像名称: ');

  define('ERROR_DEFINE_OPTION_NAMES', '警告: 没有定义选项名称');
  define('ERROR_DEFINE_OPTION_VALUES', '警告: 没有定义选项内容');
  define('ERROR_DEFINE_PRODUCTS', '警告: 没有定义商品');
  define('ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', '警告: 该商品没有设置主分类编号');

  define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON','增加 - 包含子分类');
  define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF','增加 - 不含子分类');

  define('BUTTON_PREVIOUS_ALT','前一个');
  define('BUTTON_NEXT_ALT','下一个');

  define('BUTTON_PRODUCTS_TO_CATEGORIES', '多个分类链接管理');
  define('BUTTON_PRODUCTS_TO_CATEGORIES_ALT', '复制商品到多个分类');

  define('TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', '全局复制、添加和删除的功能已关闭');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', '显示全局功能 - 开');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', '显示全局功能 - 关');

// moved from categories and all product type language files
  define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', '错误: 不能在同一分类中链接商品。');
  define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', '错误: 分类图像目录不可写: ' . DIR_FS_CATALOG_IMAGES);
  define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', '错误: 分类图像目录不存在: ' . DIR_FS_CATALOG_IMAGES);
  define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', '错误: 分类不能移动到子分类中。');
  define('ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', '错误: 不能移动商品到相同分类或原来的分类中。');
  define('ERROR_CATEGORY_HAS_PRODUCTS', '错误: 分类中有商品!<br /><br />仅临时用于组织分类用途 ... 分类中不能同时有商品和子分类!');
  define('SUCCESS_CATEGORY_MOVED', '成功! 分类已移动 ...');
  define('ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', '错误: 不能移动分类到相同的分类! 编号 #');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', '警告: 简易页面页眉 - On 仅限管理员IP');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', '警告: 简易页面页脚 - On 仅限管理员IP');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', '警告: 简易页面边框 - On 仅限管理员IP');

// moved from product types
// warnings on Virtual and Always Free Shipping
  define('TEXT_VIRTUAL_PREVIEW','提示: 免运费且不要送货地址<br />当订单中所有商品都是非实物商品时，不需要送货。');
  define('TEXT_VIRTUAL_EDIT','提示: 免运费且不要送货地址<br />当订单中所有商品都是非实物商品时，不需要送货。');
  define('TEXT_FREE_SHIPPING_PREVIEW','提示: 免运费, 但需要送货地址<br />当订单中所有商品都免运费时，需要免费配送模块。');
  define('TEXT_FREE_SHIPPING_EDIT','提示: 免运费, 但需要送货地址<br />当订单中所有商品都免运费时，需要免费配送模块。');

// admin activity log warnings
  define('WARNING_ADMIN_ACTIVITY_LOG_DATE', '提示: 系统管理日志数据表中的记录已超过2个月，请尽快清理 ... ');
  define('WARNING_ADMIN_ACTIVITY_LOG_RECORDS', '提示: 系统管理日志数据表中的记录已超过5万个，请尽快清理 ... ');
  define('RESET_ADMIN_ACTIVITY_LOG', '进入工具－商店管理，重置系统管理日志');

  define('CATEGORY_HAS_SUBCATEGORIES', '说明: 本分类中已有子分类，不能添加商品');

  define('WARNING_WELCOME_DISCOUNT_COUPON_EXPIRES_IN', '警告! 注册优惠券将在%s天后过期');

///////////////////////////////////////////////////////////
// include additional files:
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS);
  include(zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false'));


?>