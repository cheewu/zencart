<?php
/*//=================================
//
//	文件上传操作类 upload [更新时间: 2009-8-4]
//
//===================================*/

//上传类
class upload
{
	private $boxname; //表单中上传框的名称

	//初始化函数:
	function __construct($boxname=NULL)
	{
		if( !isset($boxname) ){
			$this->setBoxname($boxname);
		}
	}//PHP5使用 /* */
	
	//析构函数
	function __destruct()
	{	}
	
	//返回对象本身
	public static function make($boxname=NULL)
	{
		return new upload($boxname);
	}
	
	//设置上传框的名称
	public function setBoxname($boxname)
	{
		$this->boxname = $boxname;
	}
	
	//该表单元素是否有文件上传
	public function isUpload()
	{
		if(isset($_FILES[$this->boxname]) && $_FILES[$this->boxname]['error']==0){
			return true;	
		}else{
			return false;
		}
	}
	
	//取得上传的文件的临时路径
	public function getFilepath()
	{
		return $_FILES[$this->boxname]['tmp_name'];
	}
	
	//取得上传文件的扩展名
	public function getExtname()
	{
		return filex::getFileextname($_FILES[$this->boxname]['name']);
	}
	
	//上传, 成功返回文件名, 失败返回空串
	//参数: $savepath 将文件保存的目录路径, $filename 文件名(不包含扩展名)
	public function save($savepath,$filename='')
	{
		if($this->isUpload()){
			//得到文件名
			if(trim($filename)==''){ $filename = now('0i'); }
			$filename = $filename . $this->getExtname();
			//取得要保存到的文件路径
			$savepath = $savepath . "/$filename";
			//保存文件
			if(copy($this->getFilepath(),$savepath)){
				return $filename;
			}
		}
		//如果保存失败返回空串
		return '';
	}
}
?>