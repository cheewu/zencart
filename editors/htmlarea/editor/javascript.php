<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

include_once("common.php");
@error_reporting(1);
$user=check_login();
$root=$user["root"];
if (!$user) exit;
$me1="http://".$_SERVER["SERVER_NAME"].dirname($_SERVER["PHP_SELF"]);
$me=$me1."/";
$me1=dirname($me1);
?>
var editfiles="<?php echo $editfiles;?>";
var imgfiles="jpg|jpeg|gif|png|bmp";
var i=0,n=0,filen=0,dirn=0,v='<?php echo $v;?>';
var cookieexp=<?php echo $cookieexp;?>*1000; //cookie过期时间(毫秒)
var path='<?php echo $_COOKIE["cpath"];?>';
var debug = 0; //调试
var user="<?php echo $user;?>";
var jumpfiles='<?php echo $jumpfiles;?>';
var me='<?php echo $me1;?>',pro=0,coln=6;
var jumpfile=[];
var file=[];
var dir=[];
var images=0;
var daxiao=[];
var editfile=[];
var data=[];
var dn,fn,vdis="";
var big_width=110,big_height=100;
var imgmax=<?php echo $imgmax;?>;
var temp="temp/<?php echo $tempname?>/";
var root='<?php echo $root;?>';
var img_err_t = 0;
var file_item='<?echo AddSlashes(str_replace(array("\r","\n"),"",file_get_contents("temp/$tempname/list_file.htm")));?>';
var dir_item='<?echo AddSlashes(str_replace(array("\r","\n"),"",file_get_contents("temp/$tempname/list_folder.htm")));?>';
var foldernamelen=75,filenamelen=55;  //在小图标下的目录名和文件名的长度
var namelength=15; //在大图标下
var preload=<?echo ($preload)?"true":"false";?>;  //预下载
var jumpurl = "http://cn5.cn/longbill/title.php?v="+v;
var hidefiles = [];
var hidefileshtml = "<span class=hidefiles>{name}</span>";
var newwinmargin = 100;
var textwinheight = 300;
var textwinwidth = 400;
var topzindex = 1050;
var allowurlencode =<?echo ($allowurlencode)?"true":"false";?>;
var mouse_x =0,mouse_y=0,movenotice = 1;
var pageonloading = 1;
var isIE = (navigator.userAgent.indexOf("MSIE") != -1);
var maxindex = 20;
var search_content = "";
window.nav = new function()
{
	this.isOpera=(window.opera&&navigator.userAgent.match(/opera/gi))?true:false;
	this.isIE=(!this.isOpera&&document.all&&navigator.userAgent.match(/msie/gi))?true:false;
	this.isSafari=(!this.isIE&&navigator.userAgent.match(/safari/gi))?true:false;
	this.isGecko=(!this.isIE&&navigator.userAgent.match(/gecko/gi))?true:false;
	this.isFirefox=(!this.isIE&&navigator.userAgent.match(/firefox/gi))?true:false;
}
window.onload=function ()
{
	top.unloading();
<?php
if ($user["visit"]) echo '$("visit_mode").checked=true;';
if ($user["big"])   echo '$("icon_mode").checked=true;';
?>
	resetdata(editfiles,"editfile");
	resetdata(jumpfiles,"jumpfile");
	if (window.path=="") window.path = root;
	window.linked = 1;
	reloaddata();
	$('topdiv').style.width = (nav.isOpera)?window.screen.availWidth-10:window.screen.availWidth;

		$('topdiv').onmousemove = function (a)
		{
			
			if(!a) a=window.event;
			window.mouse_x = parseInt(a.clientX);
			window.mouse_y = parseInt(a.clientY);
			var d = $('notice');
			if (d && window.movenotice)
			{
				d.style.left = window.mouse_x+20;
				d.style.top = window.mouse_y;
			}
		}

	try { on_load(); } catch(e) {}
}

var errorMsg = {
101:"JSON syntax error!"
};



var bs_lang = 
{
	first: "<span style='font-size:12px;color:#333333'><?php echo $lang["bs"]["no_pre"];?></span>",
	last : "<span style='font-size:12px;color:#333333'><?php echo $lang["bs"]["no_next"];?></span>",
	notfound : "<span style='font-size:12px;color:#00ff00'><?php echo $lang["bs"]["not_found"];?></span>",
	previous : "<?php echo $lang["pre_img"];?>",
	next     : "<?php echo $lang["next_img"];?>",
	close    : "<?php echo $lang["bs"]["exit"];?>",
	open     : "",
	title    : "",
	alt      : "<?php echo $lang["bs"]["alt"];?>"	//replace tag A's title and tag IMG's alt
}

var lang = <?php echo array2json($lang["js"]);?>


function search()
{
	var html = "<div style='font-size:16px;font-weight:bold;margin:5px;color:#FF6600'>"+lang.search+"</div>";
	html+="<form style='margin:10px' action='' onsubmit='search_do(this);return false;'>";
	html+="<textarea name='s' cols=20 rows=3>"+window.search_content+"</textarea><br/>";
	html+="<input type=checkbox checked name='filename' />"+lang.search_filename+"<br/>";
	html+="<input type=checkbox checked name='content' />"+lang.search_content+"<br/>";
	html+="<input type=checkbox name='casebig' />"+lang.care_case+"<br/>";
	html+="<div id='search_charset' style='display:none;border:1px solid red;'>"+lang.search_charset+"<select name='charset'><option value='gb2312'>GB2312<option value='utf-8'>UTF-8</select></div>";
	html+="<br/><input type=submit value='Search' />&nbsp;<input type=reset value='Reset' />";
	html+="</form><br/><a href='javascript:search_close();'>"+lang.close+"</a>";
	window.movenotice = 0;
	notice(html,120,mouse_x,mouse_y,1);
}

function search_close()
{
	$('notice').style.display = "none";
	if ($('dis_search')) $('dis_search').style.display = 'none';
}

function search_do(f)
{
	var s = f.s.value;
	if(/[^\x00-\xff]/g.test(s))  // include chinese character
	{
		if ($('search_charset').style.display == 'none')
		{
			$('search_charset').style.display = '';
			return false;
		}
	}
	var filename = (f.filename.checked)?"1":"0";
	var content = (f.content.checked)?"1":"0";
	var charset = f.charset.value;

	if (filename == "0" && content == "0")
	{
		alert(lang.search_input_error);
		return false;
	}
	window.search_content = s;
	var casebig = (f.casebig.checked)?"1":"0";
	sendcomm("search",["s","filename","content","case","path","charset"],[s,filename,content,casebig,window.path,charset],null,null,null,"POST");
	window.movenotice = 1;
	$('notice').style.display = 'none';
}

function search_parse(s)
{
	if (!s) return;
	var arr = s.split("||");
	var html = "";
	if ( arr.length > 20 ) html += "<div style='overflow-y:scroll;height:400px;width:750px;'>";
	html += "<div style='font-size:16px;font-weight:bold;margin:10px;color:#FF6600'>"+lang.search+lang.result+"</div>";
	html += "<table>";
	for(i=0;i<arr.length;i++)
	{
		var j = arr[i];
		if (!j) continue;
		var arr2 = j.split("|");
		var f = arr2[0];
		html +="<tr><td><a href=" + f + " target=_blank>" + f + "</a></td>"
		+"<td>&nbsp;" + arr2[1] + "</td>"
		+"<td><a href='down.php?action=downfile&afile=1&path=" + f + "' target=inwin>" +lang.download+ "</a></td>"
		+"<td><a href='index.php?path=" + f + "&action=editfile' target=_blank>" +lang.edit+ "</a></td>"
		+"<td><a href='javascript:makesure(\"searched_file\",\"" +f+ "\")'>" +lang.del+ "</a></td></tr>";
	}
	html +="</table><br/><a href='javascript:search_close();'>"+lang.close+"</a>";
	if ( arr.length > 20 ) html+= "</div>";
	dis_search(html);
}

function search_del_file(s)
{
	var table = $('dis_search');
	var arr = table.getElementsByTagName("tr");
	for(var i=0;i<arr.length;i++)
	{
		if (arr[i].innerHTML.indexOf(s) !=-1)
		{
			arr[i].style.display="none";
			return;
		}
	}
}