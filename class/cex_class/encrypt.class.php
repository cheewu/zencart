<?php
/*//=================================
//
//	加密解密类 [更新时间: 2010-7-8]
//
//===================================*/
/*
说明: 本类能加密解密数组(对象型将被转成数组型),字符,数值(bool型将被转成数值型)等变量
使用：
	//加密
	encrypt::encode($data,'key');
	//解密, 注: 解密与加密的密匙必须完整一至，否则将返回NULL
	$data = encrypt::decode($code,'key');
*/
class encrypt
{
	//编码  参数: $data 数据, $key 密钥匙
	public static function encode($data,$key)
	{
		$arr = array('value'=>$data,'key'=>md5($key)); //组装数据
		$json = json_encode($arr); //生成json串
		$char = substr('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',rand(1,62)-1,1); //取得一个随机字符
		$value = $char.urlencode(base64_encode($json)); //加入干扰字符
		return $value;
	}
	
	//解码  参数: $value 密文, $key 密钥匙
	public static function decode($value,$key)
	{
		$value = substr($value,1,strlen($value)-1); //去除干扰字符
		$json = base64_decode(urldecode($value)); //还原到json串
		$arr = json_decode($json,true); //还原成数据
		$data = $arr['key']===md5($key)?$arr['value']:NULL; //验证密钥匙是否正确,并得到数据
		return $data;
	}
	
	
   /**
   其它方法:
   * @param string $string 原文或者密文
   * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
   * @param string $key 密钥
    * @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
    * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
    *
      * @example
      *
      *  $a = authcode('abc', 'ENCODE', 'key');
      *  $b = authcode($a, 'DECODE', 'key');  // $b(abc)
      *
      *  $a = authcode('abc', 'ENCODE', 'key', 3600);
      *  $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
      */
	public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 3600) {

         $ckey_length = 4;   
         // 随机密钥长度 取值 0-32;
         // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
         // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
         // 当此值为 0 时，则不产生随机密钥

         $key = md5($key ? $key : EABAX::getAppInf('KEY'));
         $keya = md5(substr($key, 0, 16));
         $keyb = md5(substr($key, 16, 16));
         $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

         $cryptkey = $keya.md5($keya.$keyc);
         $key_length = strlen($cryptkey);

         $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
         $string_length = strlen($string);

         $result = '';
         $box = range(0, 255);

         $rndkey = array();
         for($i = 0; $i <= 255; $i++) {
             $rndkey[$i] = ord($cryptkey[$i % $key_length]);
         }

         for($j = $i = 0; $i < 256; $i++) {
             $j = ($j + $box[$i] + $rndkey[$i]) % 256;
             $tmp = $box[$i];
             $box[$i] = $box[$j];
             $box[$j] = $tmp;
         }

         for($a = $j = $i = 0; $i < $string_length; $i++) {
             $a = ($a + 1) % 256;
             $j = ($j + $box[$a]) % 256;
             $tmp = $box[$a];
             $box[$a] = $box[$j];
             $box[$j] = $tmp;
             $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
         }

         if($operation == 'DECODE') {
             if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                 return substr($result, 26);
             } else {
                 return '';
             }
         } else {
             return $keyc.str_replace('=', '', base64_encode($result));
         }

     }	 
}
?>