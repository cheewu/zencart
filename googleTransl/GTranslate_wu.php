<?php
set_time_limit(0);
@ini_set("memory_limit",-1); 
header("Content-type: text/html; charset=utf-8");

$arrKey = array('AIzaSyBYsoS4QW2WazaHSg7wm7Jm31x1vuXhvx8',
'AIzaSyB-ypmfL2hGmlaEyAB4zZRQ2slw2CaBdU8',
'AIzaSyCB4jaZ0V_kaIMghXCjyAy3fj-f0KgCJM4' ,
'AIzaSyDiNzcSvkFAzRnEkI672M0YViVkRrW3mc4' ,
'AIzaSyDCyQnzDSNxK2uYE6Rn3pilYkSAOA47myA',
'AIzaSyDBdJA26CivwgzrvhwW4foOeihIAOOBaeM');


function translate($string, $key)
		{
			$string = str_replace('【','+[',$string);
			$string = str_replace('】',']+',$string);
			$string = str_replace('<BR>','[]',$string);
			$string = str_replace('<br>','[]',$string);
				$url='https://www.googleapis.com/language/translate/v2?key='.$key.'&q='.urlencode(htmlspecialchars($string)).'&source=en&target=it';
				@$str = file_get_contents($url);
				if(!$str) {return '';}
				//$rand=rand(3,4);
				sleep(0.5);
				$arrObj = json_decode($str);				
				$tarry=  $arrObj->data->translations['0']->translatedText;
				$tarry = str_replace('+ [','【',$tarry);
				$tarry = str_replace('] +','】',$tarry);
				$tarry = str_replace('[]','<br>',$tarry);
				//echo $tarry."\n";
				//$tarry = $string;
				return $tarry;				
		}
		
 try{		
		mysql_connect("127.0.0.1","welcome","hlu2011");
		//mysql_connect("localhost","root","");
		mysql_select_db("borsenegozi");
		mysql_query("set names utf8");
		//mysql_query("delete from products_description where language_id=2");
		//mysql_query("update products_description set language_id=1");
		//die;
		$rhi = 0;
		$rh=mysql_query("select products_id, products_name, products_description from products_description where language_id=1 and products_id not in (select products_id from products_description where language_id = 2) order by products_id desc");
		while($rows=mysql_fetch_assoc($rh))
		{	
			$key = $arrKey[$rhi%(count($arrKey))];
			$rhi ++;
			$products_description = '';
			$products_name = '';
			$products_id= $rows['products_id'];
			$error=false;
			try{
				
				//echo $rows['products_description']."\n\n";
				//$rows['products_description'] = strip_tags($rows['products_description']);
				
				$rows['products_description'] = str_replace('<FONT face=Arial size=2>','<FONT size=2 face=Arial>',$rows['products_description']);
				$rows['products_description'] = str_replace('<p align="center">','<P align=center>',$rows['products_description']);

				preg_match_all('/<P align=center><IMG(.*?)<\/p>/is', $rows['products_description'], $image);
				preg_match_all('/<FONT size=2 face=Arial>(.*?)<\/FONT>/is', $rows['products_description'], $items);
				preg_match_all('/<P>(.*?)<\/P>/is', $rows['products_description'], $items_1);
				
				if(empty($items[1][0])){
					$items = array();
					preg_match_all('/<FONT face=Arial size=2>(.*?)<\/FONT>/is', $rows['products_description'], $items);
					//print_R($items);
				}	
				
				$products_name=translate($rows['products_name'], $key);if($products_name == '') continue;
				
				if(!empty($items[1][0])) {
					$j=0;
					$gsource='';
					foreach($items[1] as $key_1 =>  $value){
						//$j++;
						$gsource=$gsource.$value;
						//if($j%3==0){
							$products_description .= "<P><FONT size=2 face=Arial>".translate($gsource,$key)."</FONT></P>";
							$gsource='';
						//}
					}
					
					if(count($image[1]))
					foreach($image[1] as $key_2 => $valuesss){
						$products_description .= '<p align="center"><IMG '.$valuesss."</p>";
					}
					
					//echo $image[1][0];

				} else if(!empty($items_1[1][0])) {
					foreach($items_1[1] as $key_3 =>  $value){
						$gsource=$gsource.$value;
							$products_description .= "<P>".translate($gsource,$key)."</P>";
							$gsource='';
					}
					
					if(count($image[1]))
					foreach($image[1] as $key_4 => $valuesss){
						$products_description .= '<p align="center"><IMG '.$valuesss."</p>";
					}
				}else 
					$products_description = $rows['products_description'];
				
				//$products_description = translate($rows['products_description'],$key);
             }  

					
			catch (GTranslateException $ge){
				print_R($ge);
				echo $rows['products_id'].' failed';
				$error=true;
				break;
			}
			
			//echo $products_name.'    '.$products_description."\n";
			
			if(!$error)
			{
					$products_description = ereg_replace("==", '', $products_description);
					$sql = "insert into products_description(products_id, products_name, products_description,language_id) values('".$products_id."', '".$products_name."', '".$products_description."', 2)";
					mysql_query($sql);
					//$sql = "update products_description set language_id=10 where products_id='".$products_id."'";
					//mysql_query($sql);
			}
		}

	//echo $gt->english_to_italian("hello world");
 } catch (GTranslateException $ge)
 {
	echo $ge->getMessage();
 }
?>
