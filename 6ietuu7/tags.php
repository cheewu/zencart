<?php
require('includes/application_top.php');
$languages = zen_get_languages();
define(TABLE_PRODUCTS_TAGS,'products_tags');
if($_GET['action']=='del')
{
	$db->Execute("delete from ".TABLE_PRODUCTS_TAGS." where id=".$_GET['id']);
}
if($_POST['action']=='add')
{
	
	if($_POST['tags'])
	{
		$languages_id=(int)$_SESSION['languages_id'];
		$sql_data_array = array('language_id'=>$languages_id,'tags' => zen_db_prepare_input($_POST['tags'][$languages_id]),'manufacturers_id' => $_POST['manufacturers_id']);
		zen_db_perform(TABLE_PRODUCTS_TAGS, $sql_data_array);
		$id = zen_db_insert_id();
		for ($i=0, $n=sizeof($languages); $i<$n; $i++)
		{
			if($languages_id != (int)$languages[$i]['id'])
			{
				$languaged_id=(int)$languages[$i]['id'];
				$sql_data_array = array('id'=>$id,'language_id'=>$languaged_id,'tags' => zen_db_prepare_input($_POST['tags'][$languaged_id]),'manufacturers_id' => $_POST['manufacturers_id']);
				zen_db_perform(TABLE_PRODUCTS_TAGS, $sql_data_array);
			}
		}
	}
}
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:30px 200px">
<?php
    $manufacturers = $db->Execute("select manufacturers_id, manufacturers_name
                                   from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    while (!$manufacturers->EOF) {
      $manufacturers_array[] = array('id' => $manufacturers->fields['manufacturers_id'],
                                     'text' => $manufacturers->fields['manufacturers_name']);
      $manufacturers->MoveNext();
    }
?>
  <tr>
    <td colspan="4" style="padding-left:50px;">添加tags  商品厂商
     
	  <form name="form1" method="post" action="">
	<?php echo zen_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id); ?>
	<input name="action" type="hidden" id="action" value="add">
	<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
	?>
    <?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
	<?php echo zen_draw_input_field('tags[' . $languages[$i]['id'] . ']', (isset($products_name[$languages[$i]['id']]) ? stripslashes($products_name[$languages[$i]['id']]) : zen_get_products_tags($pInfo->products_id, $languages[$i]['id'])), zen_set_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_name'))?>
	<?php
		}
	?>
    <input type="submit" name="Submit" value="添加">
    </form>    </td>
  </tr>
  <tr>
    <td width="6%" height="25" align="center">id</td>
    <td width="11%" align="center">厂商</td>
    <td width="30%" align="center">tags名</td>
    <td width="53%" align="center">操作</td>
  </tr>
  <?php

  $sql="select * from ".TABLE_PRODUCTS_TAGS." as pt left join manufacturers as m on pt.manufacturers_id=m.manufacturers_id where language_id = '" . (int)$_SESSION['languages_id'] . "'";
  $rs=$db->Execute($sql);

  	if ($_GET['page'] == '' or $_GET['page'] <= 1)
	{
		$_GET['page'] = 1;
	}
	/*
	elseif($_GET['page']>=$rs->RecordCount())
	{
		$_GET['page'] = $rs->RecordCount();
	}*/
	else
	{
		$_GET['page']=$_GET['page'];
	}
	$orders_query_numrows=5;
	$products_query_numrows=5;
  $tags_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $sql, $orders_query_numrows);
  $tags = $db->Execute($sql);
  while(!$tags->EOF)
  {
  ?>
  <tr>
    <td align="center"><?php echo $tags->fields['id']?></td>
    <td align="center"><?php echo $tags->fields['manufacturers_name']?></td>
    <td align="center"><?php echo $tags->fields['tags']?></td>
    <td align="center"><a href="?action=del&id=<?php echo $tags->fields['id']; ?>">删除</a></td>
  </tr>
  <?php
	  $tags->MoveNext();
  }
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><?php echo $tags_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS) . '<br>' . $tags_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y')) ); ?></td>
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
function zen_get_products_tags($id,$language_id)
{
    global $db;
    if ($language_id == 0) $language_id = $_SESSION['languages_id'];
    $product = $db->Execute("select products_name
                             from " . TABLE_PRODUCTS_DESCRIPTION . "
                             where products_id = '" . (int)$id . "'
                             and language_id = '" . (int)$language_id . "'");
    return $product->fields['products_name'];	
}
?>