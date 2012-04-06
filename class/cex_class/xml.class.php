<?php
/*//=================================
//
//	xml操作类 xml [更新时间: 2010-3-3]
//
//===================================*/

//将xml与数组相互转换
class xml
{
	//将数组转成XML文本
	//参数: $arr 数组,$topname 最顶节点的标记名, $encoding 编码方式'utf-8'或'gb2312', $n 这个参数忽略使用中无需考虑
	public static function toXml($arr,$topname='cex',$encoding='utf-8',$n=0)
	{
		$xml = '';//xml头部
		if(!$n){ $xml = '<?xml version="1.0" encoding="'.$encoding .'"?><'.$topname.'>'; } 
		if(!is_array($arr)){ return $arr; }
		if(is_object($arr)){ $arr = php::objectToArray($arr); }
		foreach($arr as $key=>$value){
			if(is_array($value)){
				$xml .= "<$key>".self::toXml($value,$topname,$encoding,1)."</$key>";
			}else{
				$xml .= "<$key>".$value."</$key>";
			}
		}
		if(!$n){ $xml .= '</'.$topname.'>'; }
		return $xml;
	}
	
	//将XML转成数组
	public static function toArray($xml)
	{
		$obj = @simplexml_load_string($xml);
		return php::objectToArray($obj);
	}
}
?>
