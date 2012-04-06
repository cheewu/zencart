<?php
/**
 * IP Blocker functions
 *
 * @package functions
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ip_blocker.php , v1.0.0 2009/09/09 $d <noblesenior@gmail.com> $
 */

/**
 * IP block function
 *
 * @return void
 */

function ip_blocker(){
	// Skip if ip_blocker_login page
	if (strpos($_SERVER['SCRIPT_NAME'], 'ip_blocker_login'))
	{
		return ;
	}

	if (ip_blocker_installed()) {
		if (ip_blocker_power_on()) {
			// Get ip address
			$ip = ip_blocker_get_ip();
			$ip=ip2long($ip);
			if (! isset($_SESSION['ip_blocker_pass']) || $_SESSION['ip_blocker_pass'] != TRUE)
			{
				if (!ip_blocker_pass($ip)) {
					if (ip_blocker_block($ip)) {
						header('Location: ./nddbc.html');
					}
				}
			}
		}
	}
}

/**
 * Ip blocker install check
 *
 * @return boolean
 */
function ip_blocker_installed(){
	global $db;
	$rs=$db->Execute('SHOW TABLES LIKE "' . TABLE_IP_BLOCKER . '"');
	if($rs->RecordCount() > 0)
		return true;
	else
		return false;
	//return ($rs->RecordCount() > 0);
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

/**
 * IP blocker power on check
 *
 * @return boolean
 */
function ip_blocker_power_on(){
	global $db;
	$rs=$db->Execute('SELECT ib_power FROM `' . TABLE_IP_BLOCKER . '` WHERE ib_id=1');
	if($rs->fields['ib_power'])
	{
		return true;
	}
	else
	{
		return false;
	}
	//return ((bool) $db->Execute('SELECT ib_power FROM `' . TABLE_IP_BLOCKER . '` WHERE ib_id=1')->fields['ib_power']);
}

/**
 * Check if ip block
 *
 * @param string $ip
 * @return boolean
 */
function ip_blocker_block($ip){
	global $db;

	$blocklist1 = $db->Execute('SELECT ib_blocklist FROM `' . TABLE_IP_BLOCKER . '` WHERE ib_id=1');
	$blocklist = $blocklist1->fields['ib_blocklist'];
	$blocklist = $blocklist == '' ? @unserialize(array()) : @unserialize($blocklist);
//print_r($blocklist);
	if (! is_array($blocklist) || empty($blocklist)) {
		return FALSE;
	}

	//echo 3333333
	foreach ($blocklist as $block)
	{
		
		if(preg_match("/-/",$block))
		{
			$ip_block=explode("-",$block);
			if(ip2long(trim($ip_block[0]))<=$ip && $ip<=ip2long(trim($ip_block[1])))
			{
				return true;
			}
		}
		elseif($ip == ip2long(trim($block)))
		{
			return true;
		}
	}
	return FALSE;
}

/**
 * Check if ip pass
 *
 * @param string $ip
 * @return boolean
 */
function ip_blocker_pass($ip){
	global $db;

	$passlist = $db->Execute('SELECT ib_passlist FROM `' . TABLE_IP_BLOCKER . '` WHERE ib_id=1');
	$passlist = $passlist->fields['ib_passlist'];
	$passlist = $passlist == '' ? @unserialize(array()) : @unserialize($passlist);
	if (! is_array($passlist) || empty($passlist)) {
		return FALSE;
	}

	foreach ($passlist as $pass){
		if(preg_match("/-/",$pass))
		{
			$ip_pass=explode("-",$pass);
			if(ip2long(trim($ip_pass[0]))<=$ip && $ip<=ip2long(trim($ip_pass[1])))
			{
				return TRUE;
			}
		}
		elseif($ip == ip2long(trim($pass)))
		{
			return TRUE;
		}
		/*
		if ($ip == $pass || ereg("^" . $pass, $ip)) {
			return TRUE;
		}
		*/
	}

	return FALSE;
}

/**
 * Get client ip
 *
 * @return string
 */
function ip_blocker_get_ip(){
	$ip = '';

	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) || isset($_SERVER['HTTP_VIA'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}

?>