#!/usr/bin/php5 -q
<?php
set_time_limit(0);
require("/var/www/gtranslate/GTranslate.php");
$gt = new Gtranslate;
$gt->setRequestType('curl');
$database=array("wp");
foreach($database as $db)
{
	mysql_connect("localhost","root","");
	mysql_select_db($db);
	mysql_query("set names utf8");
	$rs=mysql_query("show tables");
	while($row=mysql_fetch_assoc($rs))
	{
		$table=array_pop($row)."\n";
		if(preg_match("/_posts$/",$table))
		{
			$rf=mysql_query("DESCRIBE ".$table." is_g");
			if(mysql_affected_rows()>0)
			{
			}
			else
			{
				mysql_query("alter table ".$table." add is_g varchar(1) default '0'");
			}
			$arr_table[]=$table;
		}
	}
	foreach($arr_table as $key=>$value)
	{
		$rh=mysql_query("select ID,post_content,post_title from ".$value." where is_g=0");
		while($rows=mysql_fetch_assoc($rh))
		{
			$error=false;
			$rand=rand(3,6);
			sleep($rand);
			try{
				$post_content=$gt->en_to_it($rows['post_content']);
				$post_title=$gt->en_to_it($rows['post_title']);
				$error=true;
			}
			catch (GTranslateException $ge){
				$error=false;
			}
			if($error)
			{
				mysql_query("update ".$value." set post_content='".addslashes($post_content)."',post_title='".addslashes($post_title)."',is_g='1' where ID=".$rows['ID']);
			}

		}
	}
}
?>
