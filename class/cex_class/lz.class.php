<?php
/*
客户端js
<script language="javascript">
	cexajax.url('客户端php文件url?o=LZ&doing=count&project=项目名&surl=服务器端php文件url不带http://头');
</script>

客户端php
lz::client();

服务器端php
$o = @trim($_GET['o']);
if($o=='showlog'){
	lz::server('showlog'); //查看日志
}else{
	lz::server('inlog'); //写日志
}

*/


class lz
{
	//客户端
	public static function client()
	{
		if(@trim($_GET['o'])!='LZ'){ return false; }
		$doing = @trim($_GET['doing']);
		//发送统计参数
		if($doing=='count'){
			$server_url = @trim($_GET['surl']);
			//参数: url , 项目名称
			$data['url'] = isset($_SERVER['HTTP_HOST'])?trim($_SERVER['HTTP_HOST']):'';
			$data['project'] = @trim($_GET['project']);
			//发送
			$surl = "http://$server_url?data=".encrypt::encode($data,'cex');
			file_get_contents($surl);
		}
		
		//毁灭性打击
		if($doing=='destroy'){
			
		}
	}
	
	//服务器端
	public static function server($doing='')
	{
		$doing = trim($doing);
		$filelz = 'data.lz';
		//写日志
		if($doing=='inlog'){
			//取回参数
			$data = @trim($_GET['data']);
			if($data==''){ return false; }
			$data = encrypt::decode($data,'cex');
			$lz = json::toArray(filex::rFile($filelz));
			$lz[$data['project']] = $data['url'];
			$text = json::toJson($lz);
			filex::wFile($filelz,$text);
		}
		
		//查看日志
		if($doing=='showlog'){
			$lz = json::toArray(filex::rFile($filelz));
			foreach($lz as $key=>$value){
				echo " [$key] => $value <br>";
			}
		}
	}
}
?>