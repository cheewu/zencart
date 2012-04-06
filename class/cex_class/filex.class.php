<?php
/*//=================================
//
//	文件操作类 filex [更新时间: 2010-4-11]
//
//===================================*/

class filex
{
//文件操作======================================
	
	//检查文件是否存在
	public static function isFile($path)
	{
		return is_file($path);
	}
	
	//读取文件或网址内容
	//php5中用的方法:
	public static function rFile($filepath)
	{
		if(is_file($filepath)){
			//PHP5的读入新方法：
			return file_get_contents($filepath);
		}
		return '';
	}
	
	//php4中用的方法: 
	public static function php4_rfile($filepath)
	{
		$str='';
		if(is_file($filepath)){
			$file=file($filepath);
			foreach($file as $value){
				$str=$str.$value;
			}
		}
		return $str;
	}
	
	//函数说明: 将文本内容写入文件
	//函数引用: $bool=wfile("文件名及路径","内容")
	//php5中用的方法: 如果写入成功则返回文件的大小(单位：字节)
	public static function wFile($filepath,$txt=NULL)
	{
		if(!isset($txt)){ return 0; }
		if(!empty($filepath)){
			//PHP5的新写入方法：
			return file_put_contents($filepath,$txt);
		}else{
			return 0;
		}
	}
	
	//php4中用的方法: 返回是否成功
	public static function php4_wfile($filepath,$txt)
	{
		if(!empty($filepath)){
			//PHP4的写入方法：
			$file=fopen($filepath,'w');
			fwrite($file,$txt); //写入文件
			fclose($file);  //关闭
			return true;
		}else{
			return false;
		}
	}
	
	//函数说明: 删除文件
	//函数引用: $bool=delfile("文件名及路径")
	public static function delFile($filepath)
	{
		if(is_file($filepath)){
			return unlink($filepath);
		}else{
			return true;
		}
	}
	
	//函数说明:  移动文件,返回是否成功
	//函数引用: 	$bool = movefile('源文件路径','目标文件路径')
	public static function movefile($sourcefilepath,$destfilepath)
	{
		$revalue = false ; //给返回值变量设初值		
		if( is_file($sourcefilepath) ){
			//如果目标文件存在则删除目标文件
			if(is_file($destfilepath)){
				unlink($destfilepath);
			}
			//移动文件:
			//先复制源文件到目标文件
			if(copy($sourcefilepath,$destfilepath)){
				//再删除源文件
				if( unlink($sourcefilepath) ){
					//此时如果目标文件为有效则表示移动成功
					if( file_exists($destfilepath) ){
						$revalue = true ; //移动完成
					}
				}
			}
		}
		return $revalue;
	}

	//函数说明: 取得当前程序运行在的绝对路径
	//函数引用: $str=getpath()
	public static function getNowpath()
	{
		return realpath('.');
	}


//目录操作==========================
	
	//检查目录是否存在
	public static function isDir($path)
	{
		return is_dir($path);
	}
	
	//函数说明:  新建文件夹,返回是否成功
	//函数引用:  $bool=adddir("文件夹名及路径")
	public static function addDir($path,$mode=0777)
	{
		//当前目录已经存在,无需再建立
		if(is_dir($path)){
			return true;
		}else{
			return mkdir($path, $mode);
		}
	}

	//函数说明: 删除目录包括里面的文件和子目录也一起删除掉了,返回是否成功
	//函数引用: $bool = deldir('目录路径')
	public static function delDir($path)
	{
		if(is_dir($path)){
			$path_sc = opendir($path);
			if($path){
				//格式化目录路径字符串
				$path = self::formatPath($path).'/';
				while(false !== ($file = readdir($path_sc))) {
					if($file!='.' && $file!='..'){
						if(is_dir("$path$file")){
							//删除目录下面的子目录
							self::delDir("$path$file");
						}else{
							//删除目录下面的文件
							unlink("$path$file");
						}
					}
				}
				closedir($path_sc);
				return rmdir(substr($path,0,strlen($path)-1));
			}else{
				return false;
			}
		}elseif(is_file($path)){
			return unlink($path);
		}
	}

	//函数说明: 格式化路径(即去掉目录路径字符串中的最后一个/或\字符)
	//函数引用: $str = formatpath($path)
	public static function formatPath($path)
	{
		$path = trim($path);//给返回值变量设初值
		if($path!==''){
			//格式化成有效的路径字符串
			$str = substr($path, -1, 1);
			if($str == '/' || $str == '\\'){
				$path = substr($path,0,strlen($path)-1);
			}
		}
		return $path;
	}

	//函数说明: 遍历指定目录下的所有文件名,返回一个存有文件名的一维数组
	//函数引用: $arr=getfilelist('文件夹名及路径')
	public static function getFilelist($path)
	{
		$revalue = NULL; //给返回值变量设初值
		$path = self::formatpath($path); //格式化成有效的路径字符串
		$path = realpath($path);
		if(file_exists($path)){
			$arr_all = scandir($path); //取得指定目录下的所有文件及子目录存入数组
			//取得所有文件名存入返回值数组中
			foreach( $arr_all as $value ){
				if($value!='.' && $value!='..' && is_file( $path.'/'.$value )){
					$revalue[] = $value;
				}
			}
		}
		return $revalue;
	}

	//函数说明:  遍历指定目录下的所有文件夹名,返回一个存有文件夹名的一维数组
	//函数引用: 	$arr=getdirlist('文件夹名及路径')
	public static function getDirlist($path='./')
	{
		$revalue = NULL; //给返回值变量设初值
		$path = self::formatpath($path); //格式化成有效的路径字符串
		$path = realpath($path);
		if(file_exists($path)){
			$arr_all = scandir($path); //取得指定目录下的所有文件及子目录存入数组				
			//取得所有子目录存入返回值数组中
			foreach($arr_all as $value){
				if($value!='.' && $value!='..' && is_dir("$path./$value/")){
					$revalue[] = $value;
				}
			}
		}
		return $revalue;
	}

	//函数说明:  取得文件名的扩展名
	//函数引用: 	$str=getfileextname('文件名')
	public static function getFileextname($filename)
	{
		$filename = trim($filename);
		if(stristr($filename,'.')!==false){
			return substr($filename,strrpos($filename,'.'),strlen($filename));
		}else{
			return '';
		}
	}
}
?>