<?php
/*//=================================
//
//	html操作类 [更新时间: 2010-3-29]
//
//===================================*/

class html
{
	// 函数说明: 返回一个用js输出的代码: js输出html代码
	// 函数引用: $str = jsprint('html代码')
	public static function jsPrint($html)
	{
		$html = trim($html);
		$html = str_replace("'","\'",$html); //转义单引号
		$html = str_replace("\r\n",'\\r\\n',$html); //转义回车换行
		$html = "document.write('$html');";
		return $html;
	}
	
	//函数说明：将URL编码成可以做为网址参数传递的字符串
	//函数引用：tourllink("url地址")
	public static function toUrllink($url)
	{
	 	$url = htmlentities(urlencode($url)) ;
	 	return $url;
	} 
	
	// 函数说明: 将串转换成HTML代码,
	// 严格码：0.只为&"<>几个符号转成html代码(默认)，1、把所有适用的字符转成html代码，2、删除串中所有html和php的代码
	// 函数引用: $str=toHtml("字符串"[,严格码])
	public static function toHtml($strhtml,$num=0)
	{
		if($num==0){
			return htmlspecialchars($strhtml);
		}else{
		if($num==1){
			return htmlentities($strhtml);
		}else{
		if($num==2){
			return strip_tags($strhtml);
		}else{
		 //默认为0
		 return htmlspecialchars($strhtml);
		}}}
	}
	
	// 函数说明: 返回,带有页码列表的分页html代码
	// 函数引用: fpagelist(num总记录数[,n默认每页20条记录,nowpage默认当前页码,js代码,显示几个页码])
	public static function fPagelist($num,$n=20,$nowpage=1,$js='',$numpags=10)
	{
		$pagelabelofjs = '$page'; //设定js中的表示页码变量的标识
		
		$num = (int)$num; //总记录数
		$n = (int)$n; //每页记录数
		$nowpage = (int)$nowpage;
		if($nowpage < 1){ $nowpage = 1; }
		$numpags = (int)$numpags; //页面上要显示的页码
		
		if($num){
		//当有记录时
			//获取总页数
			$pages = 1; //总页数
			$pages = num::divInt($num,$n);
			if($num%$n > 0){ $pages = $pages + 1; }
			
			$html = '<div id="cex_fpage" style="width:100%; height:20px; text-align:center; font-size:12px;">';
			//总记录数
			$html = $html . "总共记录数:<strong>$num</strong>&nbsp;";
			
			$html = $html . '<a href="javascript:;" onclick="'.self::fpagelist_link($js,$pagelabelofjs,1).';">首页</a>&nbsp;';
			if($nowpage!=1){
				$html = $html.'<a href="javascript:;" onclick="'.self::fpagelist_link($js,$pagelabelofjs,$nowpage-1).';">&lt;上一页</a>&nbsp;';
			}
			
			if($pages <= $numpags){
				//小于指定的页码: 全列出页码
				for($i=1; $i<=$pages ; $i++){
					if($i == $nowpage){
						$html = $html . "[$i]&nbsp;";
					}else{
						$html = $html.'<a href="javascript:;" onclick="'.self::fpagelist_link($js,$pagelabelofjs,$i).';">['.$i.']</a>&nbsp;';
					}
				}
			}else{
				//大于指定的页码: 只列出指定的页码数
				$thevalue = $pages - $nowpage + 1; //取得条件判断值
				if($thevalue == $numpags){
					$start = $nowpage; //起始页码
					$end = $pages; //结束页码
				}
				if($thevalue > $numpags){
					$start = $nowpage; //起始页码
					$end = $nowpage + $numpags - 1; //结束页码
				}
				if($thevalue < $numpags){
					$start = $pages - $numpags + 1; //起始页码
					$end = $pages; //结束页码
				}
				for($i=$start;$i<=$end;$i++){
					if($i == $nowpage){
						$html = $html . "[$i]&nbsp;";
					}else{
						$html = $html . '<a href="javascript:;" onclick="'.self::fpagelist_link($js,$pagelabelofjs,$i).';">['.$i.']</a>&nbsp;';
					}
				}		
			}
			
			if($nowpage < $pages){
				$html = $html.'<a href="javascript:;" onclick="'.self::fpagelist_link($js,$pagelabelofjs,$nowpage+1).';">下一页&gt;</a>&nbsp;';
			}
			$html = $html.'<a href="javascript:;" onclick="'.self::fpagelist_link($js,$pagelabelofjs,$pages).';">末页</a>&nbsp;';
			$html = $html."第<strong>$nowpage/$pages</strong>页 <strong>$n</strong>条/页";
			$html = $html.'</div>';
		}else{
			$html = '<div id="cex_fpage" style="width:100%; height:20px; text-align:center; font-size:14px; " >当前没有记录!</div>';
		}
		
		return $html;
	}public function fpagelist_link($js,$pagelabelofjs,$page){
		return replace($js,$pagelabelofjs,$page);
	}//fpagelist()函数的附属链接生成
	
	// 函数说明: 返回,带有跳转的记录列表分页html代码
	// 函数引用: fpage(num总记录数[,n默认每页20条记录,nowpage默认当前页码,默认调用本函数的url])
	public static function fPage($num,$n=20,$nowpage=1,$url='')//num总记录数，n每页记录数,url调用本函数的url,nowpage当前页码
	{
		$pagescount=0;//总页数
		$linkword='';//链接字符串
		$strhtml='';//要输出的html代码
	
	  //取得正确的每页记录数
	  if((int)$n)<=1){
		$n=1;
	  }  
	  //取得正确的当前页
	  $nowpage=(int)$nowpage;
	  if($nowpage<=1){
		if((int)getv('nowpage')>1){
			$nowpage=(int)getv('nowpage');
		}
		else{
			$nowpage=1;
		}
	  }
	  //获取总页数
	  if($num % $n==0){
	   $pagescount=divint($num,$n);
	  }
	  else{
	   $pagescount=divint($num,$n)+1;
	  }
	  //当前页不能大于总页数
	  if($nowpage>$pagescount){
		$nowpage=$pagescount;
	  }
	
	  //删除url中的nowpage参数	
	  $url=str_replace('&nowpage='.php::getV('nowpage'),'',trim(vcount::getUrl()));
	  $url=str_replace('?nowpage='.php::getV('nowpage'),'',trim($url));
	  
	  //链接字符串
	  if(stristr($url,'?')!==false){
		$linkword=$url .'&';
	  }
	  else{
		$linkword=$url .'?';
	  }
	 
	 $strhtml=$strhtml.'<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	 $strhtml=$strhtml.'<form name="listpages" method="post" action="'.$url.'">';
	 $strhtml=$strhtml.'<tr>';
	 $strhtml=$strhtml.'<td align="center" valign="middle">';
	 $strhtml=$strhtml.'<a href="'. $linkword . 'nowpage=1">首页</a>&nbsp;';
	 // 上页 html代码
	 if($nowpage<=1){
	  $strhtml=$strhtml.'上页&nbsp;';
	 }
	 else{
	  $strhtml=$strhtml.'<a href="'.$linkword .'nowpage='. ($nowpage-1).'">上页</a>&nbsp;';
	 }
	 //下页 html代码
	 if($nowpage>=$pagescount){
	  $strhtml=$strhtml.'下页&nbsp;';
	 }
	 else{
	  $strhtml=$strhtml.'<a href="'. $linkword .'nowpage='. ($nowpage+1).'">下页</a>&nbsp;';  
	 }
	 //末页 html代码
	  $strhtml=$strhtml.'<a href="'. $linkword .'nowpage='. $pagescount.'">末页</a>&nbsp;';
	 //第几页 html代码
	 $strhtml=$strhtml.'第<b><font color="#FF0000">'.$nowpage.'</font></b>页&nbsp;';
	 //共几页 html代码
	 $strhtml=$strhtml.'共<b><font color="#FF0000">'.$pagescount.'</font></b>页&nbsp;';
	 //共多少条记录 html代码
	 $strhtml=$strhtml.'共<b><font color="#FF0000">'.$num.'</font></b>条记录&nbsp;';
	 //每页多少条记录 html代码
	 $strhtml=$strhtml.'每页<b><font color="#FF0000">'.$n.'</font></b>条&nbsp;';
	 //跳转页 html代码
	 $strhtml=$strhtml.'转到第:<input name="nowpage" type="text" id="nowpage" value="'.$nowpage.'" size=3 maxlength=10>页 <input type="submit" value="跳转" name="cndok">';
	 $strhtml=$strhtml.'</td></tr></form></table>';
	 
	 //输出html代码
	 return $strhtml;
	}
	
	// 函数说明: 重定向浏览器,必须在输出html之前使用
	// 函数引用: gourl('url地址')
	public static function goUrl($url)
	{
		header("Location: $url");
		exit;
	}
	
	//函数说明: 返回一个带有url转向功能按钮的html代码
	//函数引用: btngourl("url地址","按钮上的文字") 
	public static function btnGourl($url,$bname='确定')
	{
		return '<input type="button" name="Submit'.now('ymdhfs').'" value="'.$bname.'" onclick="JavaScript:window.location.href=\''.$url.'\';" />';
	}
	
	// 函数说明: 根据规则将数据库里的数据生成一个下拉选项框的html代码 , 如果省略参数 $nowvalue 则表示没有默认选项
	// 函数引用: selectbox($objconn,"表名","条件","下拉列表项名称字段名","下拉列表项值字段名","下拉选项框名称","当前已选项值",下拉框的其它属性)
	public static function selectBox($objconn,$table,$term,$namefield,$valuefield,$boxname,$nowvalue=NULL ,$otheritem='')
	{
		$html = "<select name=\"$boxname\" id=\"$boxname\" $otheritem>";
		$objcls = new dbcls( $objconn , $table );
		//字段列表
		if($namefield == $valuefield){
			$fieldlist = $valuefield ;
		}else{
			$fieldlist = "$namefield,$valuefield";
		}
		if($term==''){
			$term = '1=1';
		}
		$objcls->readrs("$term GROUP BY $valuefield",$fieldlist);
		$issetvalue = isset($nowvalue); //是否设置了下拉选项框的已选项值
		$ispitchon = false ; //是否存在已选项的值
		while($objcls->read()){
			if($issetvalue){
				if($objcls->f[$valuefield] == $nowvalue){				
					$html = $html . '<option value="'. $nowvalue .'" selected>'. $objcls->f[$namefield] .'</option>';
					$ispitchon = true; //已选中项
				}else{
					$html = $html . '<option value="'. $objcls->f[$valuefield] .'">'. $objcls->f[$namefield] .'</option>';
				}
			}else{
				$html = $html . '<option value="'. $objcls->f[$valuefield] .'">'. $objcls->f[$namefield] .'</option>';
			}
		}
		if( ! $ispitchon ){
			$html = $html . '<option value="" selected>请选择...</option>';
		}
		$html = $html . '</select>';
		return $html;
	}
	
	//函数说明: 返回一个单项选择的html元素，参数说明：列表中各项之间用,豆号隔开
	//函数引用: selectone('选项名称列表','选项值列表','html元素名称','被选中项的值','html元素类型: select 或者 radio')
	public static function selectOne($namelist,$valuelist,$name,$thevalue=NULL,$type='select')
	{
		$html = '';
		if(isset($namelist) && isset($name)){
			$arrname = getstrarray($namelist,',');
			$arrvalue = getstrarray($valuelist,',');
			//生成单选框		
			if($type=='radio'){
				$html = '';
				$i = 0;
				foreach($arrname as $value){
					if(isset($thevalue) && $arrvalue[$i]==$thevalue){
						$html = $html . '<input name="'. $name .'" type="radio" value="'.$arrvalue[$i].'" checked/> '.$value."\r\n";
					}else{
						$html = $html . '<input name="'. $name .'" type="radio" value="'. $arrvalue[$i] .'" /> '.$value."\r\n";
					}
					$i++;
				}
			}else{
			//生成下拉框
				$html = '<select name="'.$name.'" id="'.$name.'">';
				$i = 0;
				foreach($arrname as $value){
					if(isset($thevalue) && $arrvalue[$i]==$thevalue){
						$html = $html . '<option value="'. $arrvalue[$i] .'" selected>'. $value .'</option>';
						$isselected = true; //是否被选中
					}else{
						$html = $html . '<option value="'. $arrvalue[$i] .'" >'. $value .'</option>';
					}
					$i++;
				}
				//是否设置了初值
				if(!isset($isselected) || !$isselected){
					$html = $html . '<option value="" selected>请选择...</option>';
				}else{
					$html = $html . '<option value="" >请选择...</option>';
				}
				$html = $html . '</select>';
			}
		}
		return $html;
	}
}


?>