<?php
require("GTranslate.php");

/**
* Example using RequestHTTP
*/

 try{
       $gt = new Gtranslate;
//	echo "[HTTP] Translating [$translate_string] German to English => ".$gt->german_to_english($translate_string)."<br/>";

	/**
	* Lets switch the request type to CURL
	*/
	$gt->setRequestType('curl');
    
    while($arr = mysql_fetch_array($query)){
        echo $gt->english_to_italian($arr['products_description']);
    }

} catch (GTranslateException $ge)
 {
       echo $ge->getMessage();
 }

?>
