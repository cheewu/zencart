<?php
require('includes/application_top.php');



print_r($order_arr);

//<td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS);
//<td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'oID', 'action'))); 



?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
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
  }
  // -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<table width="100%" height="300" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td align="center" bgcolor="#FFFFFF">客户ID</td>
        <td align="center" bgcolor="#FFFFFF">客户名字</td>
        <td align="center" bgcolor="#FFFFFF">客户邮箱</td>
        <td align="center" bgcolor="#FFFFFF">订单总额</td>
        <td align="center" bgcolor="#FFFFFF">已经完成</td>
        <td align="center" bgcolor="#FFFFFF">未支付</td>
        <td align="center" bgcolor="#FFFFFF">推荐客户数</td>
      </tr>

	  <?php
$sql="SELECT DISTINCT cu.customers_ref_id  FROM customers cu WHERE cu.customers_ref_id!=''";
$rs_ref=$db->Execute($sql);
if($rs_ref->RecordCount())
{
	while(!$rs_ref->EOF)
	{
		$rs_ref_arr[]=$rs_ref->fields['customers_ref_id'];
		$rs_ref->MoveNext();
	}
	if(!$_GET['customers_id'])
	{
		$rs_ref_str=join(",",$rs_ref_arr);
		$orders_query_raw="select c.customers_id,CONCAT(c.customers_firstname,' ',c.customers_lastname) as customers_name,c.customers_email_address,o.order_total,o.orders_status,c.customers_ref_id from customers c , orders o where  c.customers_id=o.customers_id and c.customers_id in (".$rs_ref_str.")";
	}
	else
	{
		$orders_query_raw="select c.customers_id,CONCAT(c.customers_firstname,' ',c.customers_lastname) as customers_name,o.order_total,c.customers_email_address,o.orders_status,c.customers_ref_id from customers c , orders o where  c.customers_id=o.customers_id and c.customers_ref_id=".$_GET['customers_id'];
	}



$orders_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $orders_query_raw, $orders_query_numrows);
$orders = $db->Execute($orders_query_raw);
if ($_GET['page'] == '' or $_GET['page'] <= 1)
{
    $_GET['page'] = 1;
}
elseif($_GET['page']>=$orders->RecordCount())
{
    $_GET['page'] = $orders->RecordCount();
}
else
{
	$_GET['page']=$_GET['page'];
}
while (!$orders->EOF) {
	$order_arr[$orders->fields['customers_id']]['customers_id']=$orders->fields['customers_id'];
	$order_arr[$orders->fields['customers_id']]['customers_name']=$orders->fields['customers_name'];
	$order_arr[$orders->fields['customers_id']]['customers_email_address']=$orders->fields['customers_email_address'];

	$order_arr[$orders->fields['customers_id']]['order_total']+=$orders->fields['order_total'];
	$order_arr[$orders->fields['customers_id']]['order_total']=$order_arr[$orders->fields['customers_id']]['order_total'];

	if(in_array($orders->fields['orders_status'],array(2,3,4))){$order_arr[$orders->fields['customers_id']]['order_total_x']+=$orders->fields['order_total'];}
	$order_arr[$orders->fields['customers_id']]['order_total_x']=$order_arr[$orders->fields['customers_id']]['order_total_x'];

	if(!in_array($orders->fields['orders_status'],array(2,3,4))){$order_arr[$orders->fields['customers_id']]['order_total_z']+=$orders->fields['order_total'];}
	$order_arr[$orders->fields['customers_id']]['order_total_z']=$order_arr[$orders->fields['customers_id']]['order_total_z'];

	//$order_arr[$orders->fields['customers_id']][$orders->fields['customers_ref_id']]+=1;

	$orders->MoveNext();
}



		foreach($order_arr as $key=>$value)
		{
?>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?php echo $value['customers_id'];?></td>
        <td align="center" bgcolor="#FFFFFF"><a href='orders.php?search=<?php echo str_replace(" ","+",$value['customers_name']);?>'><?php echo $value['customers_name'];?></a></td>
        <td align="center" bgcolor="#FFFFFF"><?php echo $value['customers_email_address'];?></td>
        <td align="center" bgcolor="#FFFFFF"><?php echo $value['order_total'];?></td>
        <td align="center" bgcolor="#FFFFFF"><?php echo $value['order_total_x'];?></td>
        <td align="center" bgcolor="#FFFFFF"><?php echo $value['order_total_z'];?></td>
        <td align="center" bgcolor="#FFFFFF"><?php if(find_friend($value['customers_id'])==0) echo "没有"; else {?><a href="?customers_id=<?php echo $value['customers_id'];?>"><input type="button" name="Submit" value="  <?php echo find_friend($value['customers_id']);?>  " style=" border:0px; cursor:pointer"></a><?php }?></td>
      </tr>
<?php
		}
	
}
?>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php
function find_friend($id)
{
	global $db;
	$sql="select distinct c.customers_id from customers c,orders o where c.customers_id=o.customers_id and c.customers_ref_id=".$id;
	$rs=$db->Execute($sql);
	return $rs->RecordCount();
}
?>