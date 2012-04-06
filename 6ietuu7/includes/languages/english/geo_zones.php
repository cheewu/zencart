<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: geo_zones.php 4736 2006-10-13 07:11:44Z drbyte $
 */

define('HEADING_TITLE', '地区设置 - 税率、支付和配送');

define('TABLE_HEADING_COUNTRY', '国家或地区');
define('TABLE_HEADING_COUNTRY_ZONE', '地区');
define('TABLE_HEADING_TAX_ZONES', '地区名称');
define('TABLE_HEADING_TAX_ZONES_DESCRIPTION', '地区说明');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');
//define('TEXT_LEGEND', 'LEGEND: ');
define('TEXT_LEGEND_TAX_AND_ZONES', ': 税率 &amp; 地区定义');
define('TEXT_LEGEND_ONLY_ZONES', ': 地区已定义，税率未定义');
define('TEXT_LEGEND_NOT_CONF', ': 未设置');

define('TEXT_INFO_HEADING_NEW_ZONE', '新建地区');
define('TEXT_INFO_NEW_ZONE_INTRO', '请输入新地区信息');

define('TEXT_INFO_HEADING_EDIT_ZONE', '编辑地区');
define('TEXT_INFO_EDIT_ZONE_INTRO', '请做必要修改');

define('TEXT_INFO_HEADING_DELETE_ZONE', '删除地区');
define('TEXT_INFO_DELETE_ZONE_INTRO', '您确认要删除该地区吗?');

define('TEXT_INFO_HEADING_NEW_SUB_ZONE', '新建子地区');
define('TEXT_INFO_NEW_SUB_ZONE_INTRO', '请输入新的子地区信息');

define('TEXT_INFO_HEADING_EDIT_SUB_ZONE', '编辑子地区');
define('TEXT_INFO_EDIT_SUB_ZONE_INTRO', '请做必要修改');

define('TEXT_INFO_HEADING_DELETE_SUB_ZONE', '删除子地区');
define('TEXT_INFO_DELETE_SUB_ZONE_INTRO', '您确认要删除该子地区吗?');

define('TEXT_INFO_DATE_ADDED', '加入日期:');
define('TEXT_INFO_LAST_MODIFIED', '最后修改:');
define('TEXT_INFO_ZONE_NAME', '地区名称:');
define('TEXT_INFO_NUMBER_ZONES', '地区个数:');
define('TEXT_INFO_ZONE_DESCRIPTION', '简介:');
define('TEXT_INFO_COUNTRY', '国家或地区:');
define('TEXT_INFO_COUNTRY_ZONE', '地区:');
define('TYPE_BELOW', '所有地区');
define('PLEASE_SELECT', '所有地区');
define('TEXT_ALL_COUNTRIES', '所有国家或地区');

define('TEXT_INFO_NUMBER_TAX_RATES','税率个数:');
define('ERROR_TAX_RATE_EXISTS','警告: 该地区税率已定义. 请删除税率再删除该地区');
?>