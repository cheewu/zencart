<?php
/**
 * counter.php
 *
 * @package general
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: counter.php 3194 2006-03-15 23:17:53Z wilt $
 * @private
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (isset($_SESSION['session_counter']) && $_SESSION['session_counter'] == true) {
  $session_counter = 0;
} else {
  $session_counter = 1;
  $_SESSION['session_counter'] = true;
}
$date_now = date('Ymd');
$counter_query = "select startdate, counter, session_counter from " . TABLE_COUNTER_HISTORY . " where startdate='" . $date_now . "'";
$counter = $db->Execute($counter_query);
if ($counter->RecordCount() <= 0) {
  $date_now = date('Ymd');
  $sql = "insert into " . TABLE_COUNTER_HISTORY . " (startdate, counter, session_counter) values ('" . $date_now . "', '1', '1')";
  $db->Execute($sql);
  $counter_startdate = $date_now;
  $counter_now = 1;
} else {
  $counter_startdate = $counter->fields['startdate'];
  $counter_now = ($counter->fields['counter'] + 1);
  $session_counter_now = ($counter->fields['session_counter'] + $session_counter);
  $sql = "update " . TABLE_COUNTER_HISTORY . " set counter = '" . $counter_now . "', session_counter ='" . $session_counter_now . "' where startdate='" . $date_now . "'";
  $db->Execute($sql);
}

$counter_query = "select startdate, counter from " . TABLE_COUNTER;
$counter = $db->Execute($counter_query);
if ($counter->RecordCount() <= 0) {
  $date_now = date('Ymd');
  $sql = "insert into " . TABLE_COUNTER . " (startdate, counter) values ('" . $date_now . "', '1')";
  $db->Execute($sql);
  $counter_startdate = $date_now;
  $counter_now = 1;
} else {
  $counter_startdate = $counter->fields['startdate'];
  $counter_now = ($counter->fields['counter'] + 1);
  $sql = "update " . TABLE_COUNTER . " set counter = '" . $counter_now . "'";
  $db->Execute($sql);
}

$counter_startdate_formatted = strftime(DATE_FORMAT_LONG, mktime(0, 0, 0, substr($counter_startdate, 4, 2), substr($counter_startdate, -2), substr($counter_startdate, 0, 4)));
?>