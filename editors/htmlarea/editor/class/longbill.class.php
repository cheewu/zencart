<?php
/*
*#########################################
* PHPCMS 文件管理器
* Copyright (c) 2004-2006 phpcms.cn
* 作者:Longbill ( http://www.longbill.cn )
* 请保留版权信息
*#########################################
*/

class longbill
{
	var $ftp_host;
	var $ftp_user;
	var $ftp_pass;
	var $ftp_http_path;
	var $searchfiles; //$searchfiles为可搜索文件的类型,比如 "asp|php|txt";
	
	function del_dir($path,&$info,&$err)  //强制删除文件夹
	{
		global $user;
		$info = array();
		$info["file"]= 0;
		$info["dir"] = 0;
		if (!is_dir($path)) return false;
		
		if ($this->get_perm($path)!="0777") $this->ftp_cmode($path,"0777");
		$this->my_list($path,$dirs,$files);
		foreach($files as $f)
		{
			$ftype = getext($f);
			if ($user["limit"]["$ftype"] && !$user["only"])
				$err.="文件{$f}删除失败:不能删除{$user["limittype"]}类型的文件!";
			else if (!$user["limit"]["$ftype"] && $user["only"])
				$err.="文件{$f}删除失败:不能删除除{$user["limittype"]}类型以外的文件!";
			else if (@unlink($f)) $info["file"]++;
			else $err.="文件{$f}删除失败!\n";

		}
		for($i=count($dirs)-1;$i>=0;$i--)
		{
			$f = $dirs[$i];
			if (!@rmdir($f))
				$err.="目录{$f}删除失败!\n";
			else
				$info["dir"]++;
		}
		if (@rmdir($path)) $info["dir"]++;
		return $info["dir"];
	}

	function copy($from,$to,$cover=false,$cut=false,&$coverfiles)
	{
		if (is_array($from) && is_array($to))
		{
			if (count($from)!=count($to)) return false;
			$all=true;
			for($i=0;$i<count($from);$i++)
			{
				if (!file_exists($from[$i])) continue;
				$this->move0($from[$i],$to[$i],$cover,$cut,$coverfiles) or $all=false;
			}
			return $all;
		}
		else
			return $this->move0($from,$to,$cover,$cut,$coverfiles);
	}
	
	function move0($from,$to,$cover,$cut,&$coverfiles)
	{
		if ($this->get_perm($to)!="0777") $this->ftp_cmode($to,"0777");
		if ($cut && $this->get_perm($from)!="0777") $this->ftp_cmode($from,"0777");
		if (is_file($from))
			return $this->move2($from,$to,$cover,$cut,$coverfiles);
		else if(is_dir($from))
			return $this->move1($from,$to,$cover,$cut,$coverfiles);
		else
			return false;
	}
	
	function move1($from,$to,$cover,$cut,&$coverfiles) 
	{
		if (!is_dir($to)) @mkdir($to,0777);
		$this->my_list($from,$dirs,$files,0);
		foreach($dirs as $d)
			$this->move1($d,str_replace($from,$to,$d),$cover,$cut,$coverfiles);
		foreach($files as $f)
			$this->move2($f,str_replace($from,$to,$f),$cover,$cut,$coverfiles);
		if ($cut) @rmdir($from); //递归返回后删除此目录
		return true;
	}
	
	function move2($from,$to,$cover,$cut,&$coverfiles)
	{
		if (!file_exists($from)) return false;
		if (file_exists($to))
		{
			if (!is_array($coverfiles)) $coverfiles=array();
			$coverfiles[]=$to;
			if ($cover)
			{
				@unlink($to);
				$this->move3($from,$to,$cut);
			}
		}
		else
			$this->move3($from,$to,$cut);
		return true;
	}
	
	function move3($from,$to,$cut)
	{
		return ($cut)?rename($from,$to):copy($from,$to);
	}

	function dir($path,&$dir,&$file,&$size,$deep=0) //读取目录和文件
	{
		$this->my_list($path,$dir,$file,$deep);
		if (substr($path,-1)!="/") $path.="/";
		for($i=0;$i<count($dir);$i++)
		{
			$dir[$i]=str_replace($path,"",$dir[$i]);
		}
		sort($dir);
		sort($file);
		if ($size!="not")
		{
			$size=array();
			for($i=0;$i<count($file);$i++) $size[$i]=filesize($file[$i]);
		}
		for($i=0;$i<count($file);$i++)
			$file[$i]=str_replace($path,"",$file[$i]);
		return true;
	}
	
	function my_list($path,&$dir,&$file,$deepest=-1,$deep=0)
	{
		if(substr($path,-1)!="/") $path.="/";
		if (!is_array($file)) $file=array();
		if (!is_array($dir)) $dir=array();
		$handle=@opendir($path);
		while(($val=@readdir($handle)) !== false)
		{
			if ($val=='.' || $val=='..') continue;
			$value = strval($path.$val);
			if (is_file($value))
				$file[]=$value;
			else if (is_dir($value))
			{
				$dir[]=$value;
				if ($deep<$deepest || $deepest==-1)
					$this->my_list($value."/",$dir,$file,$deepest,$deep+1);
			}
		}
		@closedir($handle);
		return true;
	}
	
	function get_property($path)
	{
		$this->my_list($path,$dirs,$files);
		$info = array();
		$info["dir"] = count($dirs);
		$info["file"] = count($files);
		$info["size"] = 0;
		foreach($files as $f)
			$info["size"]+=filesize($f);
		$info["writable"] = is_writable($path);
		return $info;
	}
	
	function pre_search() 
	{
		if (!$this->searchfiles)//如果没有自己配置$searchfiles 则搜索以下文件类型
		{
			$this->searchfiles="php|asp|txt|jsp|inc|ini|pas|cpp|c|bas|in|out|htm|html|js|htc|css|sql|bat|vbs|cgi|dhtml|shtml|xml|xsl";
		}
		$arr=explode("|",$this->searchfiles);
		unset($this->searchfiles);
		$this->searchfiles=array();
		foreach($arr as $a)
		{
			if (!$a) continue;
			$this->searchfiles["$a"]=true;
		}
	}
	
	function search_file($path,$instr,$type=0,$case=false) //$instr 为包含的字符串 $type=0,1,2 分别表示 搜索全部，只搜文件名，只搜文件内容 $case表示区分大小写,
	{
		if ($type>2 || $type<0) return false;
		$this->pre_search();
		$this->my_list($path,$dirs,$files);
		$return=array();
		if (!$case) $instr=strtolower($instr);
		foreach($files as $f)
		{
			$fname = ($case)?$f:strtolower($f);
			$arr=explode(".",$fname);
			if (!$instr || (strpos($fname,$instr) !== false && $type != 2))
			{
				$return[]=$f;
				continue;
			}
			if (!$this->searchfiles[$arr[count($arr)-1]]) continue;
			if (file_exists($f) && $type!=1)
			{
				$fp = fopen( $f, "r" );
				$content = fread($fp,filesize($f));
				fclose( $fp );
				if (!$case)
				{
					$content=strtolower($content);
				}
				if (!$instr || strpos($content,$instr) !== false) $return[]=$f;
			}
		}
		return $return;
	}
	
	function get_perm($path)
	{
		if (!$this->ftp_host)
			return "0777";
		else
			return substr(base_convert(fileperms($path),10,8),-4);
	}
	
	function ftp_conn()
	{
		if (!$this->ftp_host || !$this->ftp_user) return false;
		$handle=@ftp_connect($this->$ftp_host);
		if (@ftp_login($handle,$this->ftp_user,$this->ftp_pass))
			return $handle;
	}
	
	function ftp_cmode($path,$val)
	{
		if (!$conn_id=$this->ftp_conn()) return false;
		$res=(!function_exists('ftp_chmod'))?@ftp_site($conn_id, "CHMOD ".$val." ".$path):@ftp_chmod($conn_id,$val,$path);
		@ftp_quit($conn_id);
		return $res;
	}
}
?>