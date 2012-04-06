<?php
/*//=================================
//
//	图片操作类 pic [更新时间: 2009-8-4]
//
//===================================*/

class pic
{
	private $img; //定义一个图片类型的变量
	private $path = ''; //打开的文件路径
	private $width = 0; //图片宽度
	private $height = 0; //图片的高度
	private $type = 0; //表示图片类型的一个数值
	private $isOpen = false; //成员$img是否已经打开图片类型
	
	//初始化函数:
	function __construct($path=NULL)
	{
		if(!isset($path)){
			$this->open($path);
		}
	}
	//析构函数
	function __destruct()
	{	}
	
	//返回对象自己本身
	public static function make($path=NULL)
	{
		return new pic($path);		
	}
	
	//函数说明:  打开一个图像文件，返回图像文件的标识句柄。图片格式：jpg、gif、png
	//函数引用:  $img = openpic("文件夹名及路径")
	public function open($path)
	{
		//以GIF格式打开:
		$img = @imagecreatefromgif( $path );
		if(!$img){
			//以JPEG格式打开
			$img = @imagecreatefromjpeg( $path );
			//以PNG格式打开
			if(!$img){
				$img = @imagecreatefrompng( $path );
			}
		}
		if($img!=''){
			$this->img = $img; //打开图片
			//取得图片的属性:
			$arr = getimagesize($this->path);
			$this->width = $arr[0]; //宽
			$this->height = $arr[1]; //高
			$this->type = $arr[2]; //类型			
			$this->path = $path; //路径
			$this->isOpen = true; //图片状态已经打开
			return true;
		}else{
			$this->path = '';
			$this->isOpen = false;
			return false;
		}
	}
	
	//图片属性的宽度
	public function getWidth()
	{
		return $this->width;
	}
	
	//图片属性的高度
	public function getHeight()
	{
		return $this->height;		
	}
	
	//图片属性的类型
	public function getType()
	{
		switch ($this->type){			
			case 1:
				$type = 'GIF';	
				break;
			case 2:
				$type = 'JPG';
				break;
			case 3:
				$type = 'PNG';
				break;
			case 4:
				$type = 'SWF';
				break;
			case 5:
				$type = 'PSD';
				break;
			case 6:
				$type = 'BMP';
				break;
			case 7:
				$type = 'TIFF';
				break;
			case 8:
				$type = 'TIFF';
				break;
			case 9:
				$type = 'JPC';
				break;
			case 10:
				$type = 'JP2';
				break;
			case 11:
				$type = 'JPX';
				break;
			case 12:
				$type = 'JB2';
				break;
			case 13:
				$type = 'SWC';
				break;
			case 14:
				$type = 'IFF';
				break;
			case 15:
				$type = 'WBMP';
				break;
			case 16:
				$type = 'XBM';
				break;	
			default:
				$type = '';
	   }
		return $type;
	}
	
	//函数说明:  将图片裁剪成正方形并按大小保存成新图，返回是否成功。
	//函数引用:  $bool = cut(宽,高, '保存的目标文件路径' , '保存图片的格式' )
	public function cut($w , $h , $dstfile_path , $img_format ='gif' )
	{
		$revalue = false ; //设置返回值变量初值
		
		//文件是否存在
		if( $this->isOpen ){
		
			//1。取得源图片的尺寸：
			$sh = $this->width ; //取得源图片的高
			$sw = $this->height ; //取得源图片的宽
			
			//2。计算起始点：(x,y)
			$x=0;
			$y=0;
			// 如果源图是正方形则不需要裁剪
			if( $sh != $sw ) {
				//取得源图片宽高较小的一个值
				if( $sh < $sw ){
					//原图高的值较小
					$x = 0 ;
					$y = divint( abs( $sw - $sh ) , 2 ) ;
					$minvalue = $sh ;
				}else{
					//原图宽的值较小
					$x = divint( abs( $sw - $sh ) , 2 ) ;
					$y = 	0 ;
					$minvalue = $sw ;
				}
			}
			
			//3。创建一个真彩色的新图：
			$imgnew = imagecreatetruecolor( $w , $h ) ;
			
			//4。复制进新图
			$imgold = $this->img;
			if( ! isnothing( $imgold ) ) { //打开成功
				if( imagecopyresized( $imgnew , $imgold ,  0 , 0 , $x , $y , $w , $h ,  $minvalue , $minvalue ) ){
					
					//5。保存新图：
					// 保存成GIF格式
					if( $img_format ='gif' ){
						$revalue = imagegif( $imgnew , $dstfile_path ) ;	
					}
					// 保存成PNG格式
					if( $img_format ='png' ){
						$revalue = imagepng( $imgnew , $dstfile_path ) ;
					}
					// 保存成JPG格式
					if( $img_format ='jpg' ){
						$revalue = imagejpeg( $imgnew , $dstfile_path ) ;
					}
					imagedestroy( $imgold ); //释放旧图变量
					imagedestroy( $imgnew ); //释放新图变量
					$revalue = true;
				}
			}
		}
		
		return $revalue ; //返回是否成功。
	}
	
	//函数说明: 将图片根据限制的最大宽度或高度,按图片本身的宽高比例进行缩略和成新的图片文件,$type 限定类型('w' 宽, 'h' 高),图片格式(jpg、gif、png)
	//函数引用: $bool = proportion('w|h',限定值,'保存的目标文件路径','保存图片的格式')
	public function proportion($type , $nummax , $dstfile_path , $img_format ='gif')
	{
		$revalue = false ; //设置返回值变量初值
		$nummax = (int)$nummax;
		
		//文件是否存在
		if( $this->isOpen ) {
		
			//1。取得源图片的尺寸：
			$sw = $this->width ; //取得源图片的高
			$sh = $this->height ; //取得源图片的宽
			
			//2. 求出新图的宽或高	
			
			//限定高度,求对应比例的宽度
			if($type == 'h'){
				//原图的高度是否超出限定
				if($sh > $nummax){
					//超出处理
					$h = $nummax; //取得高度
					if($h && $sh && $sw){
						$w = (int)($sw / $sh * $h); //取得宽度
					}
				}else{
					//没有超出,则取原图宽高
					$w = $sw;
					$h = $sh;
				}
			}
			
			//限定宽度,求对应比例的高度
			if($type = 'w'){
				//原图的宽度是否超出限定
				if($sw > $nummax){
					//超出处理
					$w = $nummax; //取得高度
					if($w && $sh && $sw){
						$h = (int)($sh / $sw * $w); //取得宽度
					}
				}else{
					//没有超出,则取原图宽高
					$w = $sw;
					$h = $sh;
				}
			}
			
			//3。创建一个真彩色的新图：
			if($w && $h){
				$imgnew = imagecreatetruecolor( $w , $h ) ;
			}
			
			//4。复制进新图
			$imgold = $this->img; 
			if( $this->isOpen ) { //打开成功
				if( imagecopyresized( $imgnew , $imgold ,  0 , 0 , 0 , 0 , $w , $h ,  $sw , $sh ) ){
					
					//5。保存新图：
					// 保存成GIF格式
					if( $img_format ='gif' ){
						$revalue = imagegif( $imgnew , $dstfile_path ) ;	
					}
					// 保存成PNG格式
					if( $img_format ='png' ){
						$revalue = imagepng( $imgnew , $dstfile_path ) ;
					}
					// 保存成JPG格式
					if( $img_format ='jpg' ){
						$revalue = imagejpeg( $imgnew , $dstfile_path ) ;
					}
					imagedestroy( $imgold ); //释放旧图变量
					imagedestroy( $imgnew ); //释放新图变量
					$revalue = true;
				}
			}
		}
		
		return $revalue ; //返回是否成功。
	}	
}
?>