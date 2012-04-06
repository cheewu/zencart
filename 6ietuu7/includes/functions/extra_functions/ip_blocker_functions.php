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
// $Id: ip_blocker_functions.php, v1.0.0.0 2009/09/09 $d <noblesenior@gmail.com> $
//

/**
 * Ip blocker install check
 * 
 * @return boolean
 */
function ip_blocker_installed(){
	global $db;
	
	return ($db->Execute('SHOW TABLES LIKE "' . TABLE_IP_BLOCKER . '"')->RecordCount() > 0);
}

/**
 * Save the ip list
 *
 * @param string $list		ip list
 * @param string $type		ip list type
 * @return void
 */
function ip_blocker_ip_list($list, $type = 'block'){
	global $db;
	
	$iplist = trim($list);
	$column = 'ib_' . trim($type) . 'list';
	$column_string = $column . '_string';

	if ($iplist == '') {
		// Clear ip list
		$db->Execute('UPDATE `' . TABLE_IP_BLOCKER . '` SET ' . $column . '="",' . $column_string . '="",ib_date="' . date('Y-m-d') . '" WHERE ib_id=1');
	}else {
		$ip = array();
		$ip_rows = explode("\r\n", $iplist);
		
		if (! empty($ip_rows)) {
			foreach ($ip_rows as $ip_row){
				// Search ip address
				preg_match("/\b\d(.|\*|\s|\/)*/i", $ip_row, $match);
				$ip_ = $match[0];
				$ip_ = preg_replace("/\s/i", '', $ip_);
				
				if (strpos($ip_, '/') > 0) {
					$ip_ = explode('/', $ip_);
					$ip_start = $ip_[0];
					$ip_end = $ip_[1];
					$ip_pre = substr($ip_start, 0, strrpos($ip_start, '.'));
					$ip_start = substr($ip_start, strrpos($ip_start, '.') + 1, strlen($ip_start));
					
					foreach (range($ip_start, $ip_end) as $range){
						$ip[] = $ip_pre . '.' . $range;
					}
				}else {
					$ip[] = $ip_;
				}
			}
		}

		$ip_list_string = @serialize($ip);
		
		// Save
		$db->Execute('UPDATE `' . TABLE_IP_BLOCKER . '` SET ' . $column . '="' . zen_db_input($ip_list_string) . '",' . $column_string . '="' . $iplist . '",ib_date="' . date('Y-m-d') . '" WHERE ib_id=1');
	}
}

/**
 * Encrypt function
 *
 * @param string $password
 * @return string
 */
function ip_blocker_md5($password){
	return md5(md5($password . '_secure_key'));
}

?>
