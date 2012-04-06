<?php
if(!$_COOKIE['geoip'])
{
	setcookie("geoip",true);
	//$spiders=@file("spiders.txt");
	$spiders=array('/Googlebot/','/Sosospider/','/Twiceler/','/Baiduspider/','/Yahoo/');//Yahoo! Slurp
	foreach($spiders as $v)
	{
		if(preg_match($v,$_SERVER['HTTP_USER_AGENT']))
		{
			$spiders_exists=true;
		}
	}
	if(!$spiders_exists)
	{
		$ip=$_SERVER["REMOTE_ADDR"];
		include(DIR_WS_INCLUDES."GeoLiteCity/geoipcity.inc");
		include(DIR_WS_INCLUDES."GeoLiteCity/geoipregionvars.php");
		$gi = geoip_open(DIR_WS_INCLUDES."GeoLiteCity/GeoLiteCity.dat",GEOIP_STANDARD);
		$record = geoip_record_by_addr($gi,$ip);

		$geoip_data_array['geoip_country_code']=$record->country_code;
		$geoip_data_array['geoip_country_code1']=$record->country_code3;
		$geoip_data_array['geoip_country_name']=$record->country_name;
		$geoip_data_array['geoip_city']=$record->city;
		$geoip_data_array['geoip_region']=$record->region;
		$geoip_data_array['geoip_region_name']=$GEOIP_REGION_NAME[$record->country_code][$record->region];
		$geoip_data_array['geoip_latitude']=$record->latitude;
		$geoip_data_array['geoip_longitude']=$record->longitude;
		$geoip_data_array['geoip_postal_code']=$record->postal_code;
		$geoip_data_array['geoip_user_agent']=$_SERVER['HTTP_USER_AGENT'];
		$geoip_data_array['geoip_add_date']=date("Y-m-d h:i:s");
		$geoip_data_array['geoip_referer']=$_SERVER['HTTP_REFERER'];
		$geoip_data_array['geoip_current_page']=HTTP_SERVER.$_SERVER['REQUEST_URI'];
		$geoip_data_array['geoip_ip']=$ip;
		geoip_close($gi);
		setcookie("geoip_country",$geoip_data_array['geoip_country_name']);
		zen_db_perform("geoip", $geoip_data_array);
		setcookie("geoip_data_id",$db->Insert_ID());
	}
}
?>