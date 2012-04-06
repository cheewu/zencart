<?php
set_time_limit(0);
require('includes/application_top.php');
error_reporting(E_All);
$http_referer=$_SERVER['HTTP_REFERER'];
$page=$_GET['page'];
if(!$page)
{
	$page=1;
}
$pagesize=50;
$f=($page-1)*$pagesize;
	//$db->Execute("truncate table product_html");
	$default_language_row=$db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_LANGUAGE'");
	$languages = $db->Execute("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " where code='".$default_language_row->fields['configuration_value']."'");
	$language_id=$languages->fields['languages_id'];
	require(DIR_FS_CATALOG."includes/classes/seo.url.php");
	$seo_urls= new SEO_URL($_SESSION['languages_id']);
	
	$categories = $db->Execute("select c.categories_id from ".TABLE_CATEGORIES." c,".TABLE_CATEGORIES_DESCRIPTION." cd where c.categories_id=cd.categories_id and c.categories_status=1 and cd.language_id='".$language_id."'");
	while(!$categories->EOF)
	{
		$categories_list[]=$categories->fields['categories_id'];
		$categories->MoveNext();
	}
	$categories_s=join(",",$categories_list);
	$products_x = $db->Execute("SELECT COUNT(*) AS num FROM products_description pd, products p LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c LEFT JOIN specials s ON p2c.products_id = s.products_id
	WHERE p.products_status = 1
	AND p.products_id = p2c.products_id
	AND pd.products_id = p2c.products_id
	AND pd.language_id = '".$language_id."'
	AND p2c.categories_id  in (".$categories_s.")");
	$total=$products_x->fields['num'];


	/*echo "SELECT p.products_id,pd.products_name FROM products_description pd, products p LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c LEFT JOIN specials s ON p2c.products_id = s.products_id
	WHERE p.products_status = 1
	AND p.products_id = p2c.products_id
	AND pd.products_id = p2c.products_id
	AND pd.language_id = '".$language_id."'
	AND p2c.categories_id  in (".$categories_s.") ORDER BY p.products_id DESC limit ".$f.",".$pagesize."";*/
if($_POST['act']=='addhtml')
{
	//print_r($_POST);
	$j=0;
	foreach($_POST['products_id'] as $key=>$value)
	{
		//$products->fields['products_id']=10988;
		$products_id=$value;
		$seo_url=$seo_urls->href_link(zen_get_info_page($products_id),'products_id=' . $products_id, $connection, $add_session_id, $static, $use_dir_ws_catalog);
		$seo_url=DIR_FS_CATALOG.$seo_url;
		//echo $seo_url;
		$url=HTTP_CATALOG_SERVER."/index.php?main_page=product_info&products_id=".$products_id;
		$content=file_get_contents($url);
		if($content)
		{
			html($seo_url,$content);
			$db->Execute("update products_description set products_publish=1 where products_id='".$products_id."'");
			$j++;
		}
		else
		{
			echo $products_id."\n";
		}
		
		
		//$products->MoveNext();
	}
	header("Location:".$http_referer."&add_x=".$j);
}
if($_POST['act']=='delhtml')
{
	$j=0;
	foreach($_POST['products_id'] as $key=>$value)
	{
		$products_id=$value;
		$seo_url=$seo_urls->href_link(zen_get_info_page($products_id),'products_id=' . $products_id, $connection, $add_session_id, $static, $use_dir_ws_catalog);
		$seo_url=DIR_FS_CATALOG.$seo_url;
		if(file_exists($seo_url))
		{
			@unlink($seo_url);
			$db->Execute("update products_description set products_publish=0 where products_id='".$products_id."'");
			$j++;
		}
	}
	header("Location:".$http_referer."&del_x=".$j);
}
function html($seo_url,$content)
{
	$fp=fopen($seo_url,"wb");
	fwrite($fp,$content);
	fclose($fp);
}
function getfile($url)
{
	$handle=@fopen($url,"rb");
	$contents="";
	if($fp)
	{
		while (!feof($handle))
		{
			$contents .= fread($handle, 8192);
		}
	}
	else
	{
		$contents=false;
	}
	fclose($handle);
	return $contents;
}



function zen_get_info_page($zf_product_id)
{
	global $db;
	$sql = "select products_type from " . TABLE_PRODUCTS . " where products_id = '" . (int)$zf_product_id . "'";
	$zp_type = $db->Execute($sql);
	if ($zp_type->RecordCount() == 0)
	{
		return 'product_info';
	}
	else
	{
		$zp_product_type = $zp_type->fields['products_type'];
		$sql = "select type_handler from " . TABLE_PRODUCT_TYPES . " where type_id = '" . (int)$zp_product_type . "'";
		$zp_handler = $db->Execute($sql);
		return $zp_handler->fields['type_handler'] . '_info';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<script language="JavaScript" src="includes/menu.js" type="text/JavaScript"></script>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
  $(function()
  {
	  $("#checkall").click(function()
	  {
		 if(this.checked){$("input[name='products_id[]']").each(function(){this.checked=true;});}else{$("input[name='products_id[]']").each(function(){this.checked=false;});}
	  
	  });
	  $("#makehtml").click(function()
	  {
		 if($("input[name='products_id[]']:checked").length>0)
		 {
		 	$("#act").val("addhtml");
			$("#forms").submit();
		 }
		 else
		 {
			alert("请选择一条记录");
			return false;
		 }
	  });
	  $("#deletehtml").click(function()
	  {
	  	if($("input[name='products_id[]']:checked").length>0)
		{
			$("#act").val("delhtml");
			$("#forms").submit();
		}
		esle
		{
			alert("请选择一条记录");
		}
	  });
  });
  
  
  
  

  // -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<table width="800" height="50" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" style="margin:0px auto;">
  <form id="forms" name="form1" method="post" action="">
  <tr>
    <td height="35" colspan="4" bgcolor="#FFFFFF"><?php
	$num=ceil($total/$pagesize);
	for($i=1;$i<=$num;$i++)
	{
		echo "&nbsp;<a href='?page=".$i."'>".$i."</a>&nbsp;";
	}
	?></td>
  </tr>
  <tr>
    <td height="30" colspan="4" bgcolor="#FFFFFF"><input type="button" name="makehtml" id="makehtml" value="生成静态页面" />
      <input name="deletehtml" type="button" id="deletehtml" value="删除静态页面" />      
       <?php if($_GET["add_x"]) echo "成功生成".$_GET["add_x"]."个静态页面 ";if($_GET["del_x"]) echo "成功删除".$_GET["del_x"]."个静态页面 ";?>
      <input name="act" type="hidden" id="act" value="html" /></td>
  </tr>
  <tr>
    <td width="46" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="checkall" id="checkall" value="checkbox" /></td>
    <td width="93" align="center" bgcolor="#FFFFFF">产品ID</td>
    <td width="568" align="center" bgcolor="#FFFFFF">产品名称</td>
    <td width="93" align="center" bgcolor="#FFFFFF">是否生成</td>
  </tr>
  <?php
  	$products = $db->Execute("SELECT p.products_id,pd.products_name,pd.products_publish FROM products_description pd, products p LEFT JOIN manufacturers m ON p.manufacturers_id = m.manufacturers_id, products_to_categories p2c LEFT JOIN specials s ON p2c.products_id = s.products_id
	WHERE p.products_status = 1
	AND p.products_id = p2c.products_id
	AND pd.products_id = p2c.products_id
	AND pd.language_id = '".$language_id."'
	AND p2c.categories_id  in (".$categories_s.") ORDER BY p.products_id DESC limit ".$f.",".$pagesize."");
	while(!$products->EOF)
	{
  ?>
  <tr>
    <td width="46" align="center" bgcolor="#FFFFFF"><input name="products_id[]" type="checkbox" value="<?php echo $products->fields['products_id'];?>" /></td>
    <td width="93" align="center" bgcolor="#FFFFFF"><?php echo $products->fields['products_id'];?></td>
    <td width="568" bgcolor="#FFFFFF"><?php echo $products->fields['products_name'];?></td>
    <td width="93" align="center" bgcolor="#FFFFFF"><?php if($products->fields['products_publish']) echo "已发布"; else echo "<font color=red>未发布</font>";?></td>
  </tr>
  <?php
  	$products->MoveNext();
	}
  ?></form>
</table>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>