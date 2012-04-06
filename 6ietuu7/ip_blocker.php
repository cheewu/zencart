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
// $Id: ip_blocker.php, v1.0.0 2009/09/09 $d <noblesenior@gmail.com> $


require_once ('includes/application_top.php');

@set_time_limit(1200);
ob_start();

// menu
$ip_block_menu = array(
	'ip_settings' => 'ip settings',
	'password_settings' => 'password settings',
	'install' => 'Install',
	'power' => 'Power',
	'uninstall' => 'Uninstall'
);

// action
$ip_block_action = trim($_GET['g']);
if ($ip_block_action == '') {
	$ip_block_action = 'ip_settings';
}

$message = '';
$message_status = TRUE;
$message_show = FALSE;

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script type="text/javascript">
<!--
function init()
{
  cssjsmenu('navbar');
  if (document.getElementById)
  {
    var kill = document.getElementById('hoverJS');
    kill.disabled = true;
  }
  if (typeof _editor_url == "string") HTMLArea.replace('message_html');
}
// -->
</script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
<script language="javascript" type="text/javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_message(msg) {
  if (form.elements['message'] && form.elements['message_html']) {
    var field_value1 = form.elements['message'].value;
    var field_value2 = form.elements['message_html'].value;

    if ((field_value1 == '' || field_value1.length < 3) && (field_value2 == '' || field_value2.length < 3)) {
      error_message = error_message + "* " + msg + "\n";
      error = true;
    }
  }
}
function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_attachments(message) {
  if (form.elements['upload_file'] && (form.elements['upload_file'].type != "hidden") && form.elements['attachment_file'] && (form.elements['attachment_file'].type != "hidden")) {
    var field_value_upload = form.elements['upload_file'].value;
    var field_value_file = form.elements['attachment_file'].value;

    if (field_value_upload != '' && field_value_file != '') {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }
  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";

  check_select("customers_email_address", "", "<?php echo ERROR_NO_CUSTOMER_SELECTED; ?>");
  check_input('subject','',"<?php echo ERROR_NO_SUBJECT; ?>");
  //  check_message("<?php echo ENTRY_NOTHING_TO_SEND; ?>");
  check_attachments("<?php echo ERROR_ATTACHMENTS; ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//-->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<style>
div,form,input,span,ul,li{
	margin:0;
	padding:0
}
.d_title{
	margin:10px 0 0 25px
}
.d_menu{
	margin-left:5%;
	font-size:14px
}
.d_menu span{
	margin:0 10px
}
.d_menu .d_current{
	font-weight:bold
}
.d_message{
	margin:30px 10px;
	padding:10px;
	text-align:center;
	font-weight:bold;
	width:70%
}
/* .d_message */.d_ok{
	border:1px solid #009B4E;
	background-color:#F4FFFA
}
/* .d_message */.d_warning{
	border:1px solid #FF0000;
	background-color:#FFF4F4
}
.d_menu_title{
	margin:30px 0 0 10px;
	border-top:1px solid #008A45;
	padding:5px;
	background-color:#C0E0E0;
	width:70%;
	font-weight:bold
}
.d_power{
	margin:35px 0 35px 10%;
	font-weight:bold
}
.d_w{
	width:70%
}
.d_iplist{
	margin:15px 0 15px 35px
}
.d_fb{
	font-weight:bold
}
ul.d_iplist{
	list-style:none;
	margin-top:15px;
	margin-left:8%
}
ul.d_iplist li{
	float:left
}
ul.d_iplist li.l{
	width:10%
}
ul.d_iplist li.r{
	width:80%
}
.d_c{
	clear:both
}
</style>
<div class="pageHeading d_title">
<?php echo IP_BLOCKER_TITLE; ?>
<span class="d_menu">
<?php foreach ($ip_block_menu as $menu_action => $menu): ?>
<?php
	if ($menu_action == 'install') {
		if (ip_blocker_installed()) {
			continue;
		}
	}
?>
<span>-</span>
<?php if ($ip_block_action == $menu_action): ?>
<span class="_current">[ <?php echo $menu; ?> ]</span>
<?php else: ?>
<a href="<?php echo zen_href_link(FILENAME_IP_BLOCKER, 'g=' . $menu_action); ?>" target="_self"><?php echo $menu; ?></a>
<?php endif; ?>
<?php endforeach; ?>
</span>
</div>

<div class="d_menu_title">
<?php switch ($ip_block_action): ?>
<?php
		// IP settings
		case 'ip_settings':
			if (! ip_blocker_installed()) {
				zen_redirect(zen_href_link(FILENAME_IP_BLOCKER, 'g=install'));					
			}
			
			if ($_POST) {
				$message_show = TRUE;
				$blocklist = zen_db_prepare_input($_POST['blocklist']);
				$passlist = zen_db_prepare_input($_POST['passlist']);
				
				// ip blocklist
				ip_blocker_ip_list($blocklist);
				
				// ip passlist
				ip_blocker_ip_list($passlist, 'pass');
				
				$message_status = TRUE;
				$message = 'IP list update ok .';
			}
			
			// Get ip list
			$ip_list = $db->Execute('SELECT ib_blocklist_string,ib_passlist_string FROM `' . TABLE_IP_BLOCKER . '` WHERE ib_id=1');
			
			$ip_blocklist = $ip_list->fields['ib_blocklist_string'];
			$ip_passlist = $ip_list->fields['ib_passlist_string'];
			
?>
<?php echo IP_BLOCKER_MENU_IP_SETTINGS; ?></div>
<div class="d_iplist d_w"><?php echo IP_BLOCKER_HELP_IP_SETTINGS; ?></div>
<?php if ($message_show): ?>
<div class="d_message <?php echo $message_status ? 'd_ok' : 'd_warning'; ?>"><?php echo $message; ?></div>
<?php endif; ?>
<div class="d_w" style="padding-left:35%">See example : <a href="###" onclick="ex_(1)">with deny from</a>&nbsp;&nbsp;-&nbsp;&nbsp;<a href="###" onclick="ex_(2)">ip only</a>&nbsp;&nbsp;-&nbsp;&nbsp;<a href="###" onclick="ex_(3)">clear</a></div>
<form name="iplist" action="<?php echo zen_href_link(FILENAME_IP_BLOCKER, 'g=ip_settings')?>" target="_self" method="POST">
<ul class="d_iplist d_w"><li class="l d_fb">IP blocklist :</li><li class="r"><textarea name="blocklist" rows="15" cols="35"><?php echo $ip_blocklist; ?></textarea></li></ul><div class="d_c"></div>
<ul class="d_iplist d_w"><li class="l d_fb">IP pass list :</li><li class="r"><textarea name="passlist" rows="15" cols="35"><?php echo $ip_passlist; ?></textarea></li></ul><div class="d_c"></div>
<div style="margin:35px 0 50px 15%"><input type="submit" name="ip_settings" value="Update" /></div>
</form>
<?php
			break;
			// End ip settings
?>
<?php
		// Password settings
		case 'password_settings':
			if (! ip_blocker_installed()) {
				zen_redirect(zen_href_link(FILENAME_IP_BLOCKER, 'g=install'));
			}
			
			if ($_POST) {
				$message_show = TRUE;
				
				$password = zen_db_prepare_input($_POST['pwd']);
				
				if ($password == '') {
					$message_status = FALSE;
					$message = 'Password required !';
				}else {
					// Update password
					$db->Execute('UPDATE `' . TABLE_IP_BLOCKER . '` SET ib_password="' . ip_blocker_md5($password) . '" WHERE ib_id=1');
				
					$message_status = TRUE;
					$message = 'Password update ok .';
				}
			}
?>
<?php echo IP_BLOCKER_MENU_PASSWORD_SETTINGS; ?></div>
<div class="d_iplist d_w"><?php echo IP_BLOCKER_HELP_PASSWORD_SETTINGS; ?></div>
<?php if ($message_show): ?>
<div class="d_message <?php echo $message_status ? 'd_ok' : 'd_warning'; ?>"><?php echo $message; ?></div>
<?php endif; ?>
<div class="d_power d_w">
<form action="<?php echo zen_href_link(FILENAME_IP_BLOCKER, 'g=password_settings')?>" target="_self" method="POST">
Password :&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="pwd" value="" size="35" />
<div style="margin-top:35px"><input type="submit" name="password" value="Update" /></div>
</form>
</div>
<?php
			break;
			// End password settings
?>
<?php
		// Power
		case 'power':
			if (! ip_blocker_installed()) {
				zen_redirect(zen_href_link(FILENAME_IP_BLOCKER, 'g=install'));
			}
			
			if ($_POST) {
				$message_show = TRUE;
				
				$power_ = (bool) zen_db_prepare_input($_POST['power']);
				
				// Update power setting
				$db->Execute('UPDATE `' . TABLE_IP_BLOCKER . '` SET ib_power="' . ($power_ ? 1 : 0) . '" WHERE ib_id=1');
				
				$message_status = TRUE;
				$message = 'Power setting update ok .';
			}
			
			// Get power setting
			$power = $db->Execute('SELECT ib_power FROM `' . TABLE_IP_BLOCKER . '` WHERE ib_id=1');
			$power = (bool) $power->fields['ib_power'];
?>
<?php echo IP_BLOCKER_MENU_POWER; ?></div>
<div class="d_iplist d_w"><?php echo IP_BLOCKER_HELP_POWER; ?></div>
<?php if ($message_show): ?>
<div class="d_message <?php echo $message_status ? 'd_ok' : 'd_warning'; ?>"><?php echo $message; ?></div>
<?php endif; ?>
<div class="d_power d_w">
<form action="<?php echo zen_href_link(FILENAME_IP_BLOCKER, 'g=power')?>" target="_self" method="POST">
<input type="radio" name="power" value="1"<?php echo $power ? ' checked="checked"' : ''; ?>>&nbsp;&nbsp;<span style="color:blue">ON</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="power" value="0"<?php echo ! $power ? ' checked="checked"' : ''; ?>>&nbsp;&nbsp;<span style="color:red">OFF</span>
<div style="margin-top:35px"><input type="submit" name="install" value="Update" /></div>
</form>
</div>
<?php
			break;
			// End power
?>
<?php
		// Install
		case 'install':
			if (ip_blocker_installed()) {
				zen_redirect(zen_href_link(FILENAME_IP_BLOCKER, 'g=uninstall'));
			}
			
			$install = FALSE;
			
			if ($_POST) {
				// Install start
				$install = TRUE;
				$message_show = TRUE;
				
				// Create table
				$db->Execute("
					CREATE TABLE `" . TABLE_IP_BLOCKER . "` (
						`ib_id` tinyint(1) unsigned NOT NULL auto_increment,
						`ib_blocklist` longtext NOT NULL,
						`ib_passlist` longtext NOT NULL,
						`ib_blocklist_string` longtext NOT NULL,
						`ib_passlist_string` longtext NOT NULL,
						`ib_password` varchar(50) NOT NULL,
						`ib_power` tinyint(1) DEFAULT 1,
						`ib_date` date NOT NULL,
						PRIMARY KEY  (`ib_id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8
				");
				
				$db->Execute("
					INSERT INTO `" . TABLE_IP_BLOCKER . "` VALUES(
						NULL,
						'',
						'',
						'',
						'',
						'" . ip_blocker_md5('123456') . "',
						'1',
						'" . date('Y-m-d') . "'
					)
				");
				
				if ($db->error_number || $db->error_text) {
					$message_status = FALSE;
					$message = 'DB ERROR : #' . $db->error_number . ' - ' . $this->error_text;
				}else {
					$message_status = TRUE;
					$message = 'Install ok , and the default password is : <span style="color:blue">123456</span>';
				}
			}
?>
<?php echo IP_BLOCKER_MENU_INSTALL; ?></div>
<?php if (! $install): ?>
<div class="d_message d_ok">
<form action="<?php echo zen_href_link(FILENAME_IP_BLOCKER, 'g=install')?>" target="_self" method="POST">
IP Blocker should be installed first ...<p /><input type="submit" name="install" value="Install Now" />
</form>
</div>
<?php else: ?>
<?php if ($message_show): ?>
<div class="d_message <?php echo $message_status ? 'd_ok' : 'd_warning'; ?>"><?php echo $message; ?></div>
<?php endif; ?>
<?php endif; ?>
<?php
			break;
			// End Install
?>
<?php
		// Uninstall
		case 'uninstall':
			if (! ip_blocker_installed()) {
				zen_redirect(zen_href_link(FILENAME_IP_BLOCKER, 'g=install'));
			}
			
			$uninstall = FALSE;
			
			if ($_POST) {
				// Uninstall start
				$uninstall = TRUE;
				$message_show = TRUE;
				
				// Drop table
				$db->Execute('DROP TABLE `' . TABLE_IP_BLOCKER . '`');
				
				$message_status = TRUE;
				$message = 'Uninstall ok .';
			}
?>
<?php echo IP_BLOCKER_MENU_UNINSTALL; ?></div>
<?php if (! $uninstall): ?>
<div class="d_message d_warning">
<form action="<?php echo zen_href_link(FILENAME_IP_BLOCKER, 'g=uninstall')?>" target="_self" method="POST">
Are you sure to uninstall the IP Blocker ?<p /><input type="submit" name="uninstall" value="Uninstall" />
</form>
</div>
<?php else: ?>
<?php if ($message_show): ?>
<div class="d_message <?php echo $message_status ? 'd_ok' : 'd_warning'; ?>"><?php echo $message; ?></div>
<?php endif; ?>
<?php endif; ?>
<?php
			break;
			// End uninstall
?>
<?php endswitch; ?>
<script>function ex_(w){var _t=document.iplist.blocklist;switch(w){case 1:_t.value="deny from 58.14.*\r\ndeny from 58.16.0.0/9\r\ndeny from 58.17.0.0/17\r\ndeny from 58.17.128.0/17\r\ndeny from 58.18.0.0/16\r\ndeny from 58.19.0.0/16";break;case 2:_t.value="58.14.*\r\n58.17.128.0/17\r\n58.58.0.0/16\r\n58.196.0.0/15\r\n61.139.192.0/18\r\n192.188.170.0/24";break;case 3:_t.value='';break;}}</script>
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>