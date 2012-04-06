<?php
/*//=================================
//
//	 json操作类 [更新时间: 2010-7-8]
//
//===================================*/

class json 
{
	
	//将数组转成json串
	public static function toJson($arr)
	{
		return json_encode($arr);
	}
	
	//将json串转成数组
	public static function toArray($json)
	{
		return json_decode($json,true);
	}
	
	//将json串转成对象
	public static function toObject($json)
	{
		return json_decode($json,false);
	}
}
?>