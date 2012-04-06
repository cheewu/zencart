/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

//////////////////////////////////////////////////////////////////
//						//
//		Blue Show v1.0			//
//	  	  by Longbill			//
//     http://www.longbill.cn/blog/index.php?id=54		//
//						//
//////////////////////////////////////////////////////////////////

var bs_title	= "<span style='font-size:22px;color:#4499ee;'>Blue Show v1.0</span>";	//Title
var bs_trans 	= 70;				//transparent rate
var bs_imgtypes 	= "|jpg|jpeg|gif|png|bmp|pic|";		//image types
var bs_bg_color	= "#000000";			//background-color
var bs_win_color	= "#d6e9fc";			//blueshow window color
if (!bs_lang) bs_lang = 				//language
{
	first: "<span style='font-size:12px;color:#333333'>No previous</span>",
	last : "<span style='font-size:12px;color:#333333'>No next</span>",
	notfound : "<span style='font-size:12px;color:#00ff00'>Not Found</span>",
	previous : "Previous Image",
	next     : "Next Image",
	close    : "Exit BlueShow",
	open     : "",
	title    : "",
	alt      : "Click to open BlueShow Image Viewer"	//replace tag A's title and tag IMG's alt
}

var bs_hidden 	= 1;		//lock main page
var bs_urlencode	= 1;		//encode URL or not
var bs_height 	= 500;		//main window height
var bs_width 	= 750;		//main window width
var bs_max_width 	= 500;		//Image max width
var bs_max_height 	= 420;		//image max height
var bs_max_width_s	= 100;		//small image max width
var bs_max_height_s	= 200;		//small image max height
var bs_padding	= 4;		//padding 
var bs_move = 			
{
	display : false,
	bg   : "#e7f2fd",
	border: "1px solid #eeeeee",
	trans :70,
	color:"#333333"
}

var bs_onscroll = window.onscroll;
var bs_onmousemove = document.body.onmousemove;
var bs_win 	= null;
var bs_imgs 	= [];
var bs_titles	= [];
var bs_total 	= 0;
var bs_i 		= 0;
var bs_body	= document.body;

function bs_add_img(id,info)
{
	var img = $(id);
	if (!img) return;
	var src = (info.src)?info.src:bs_escape(img.src);
	for(var i=0;i<=bs_total;i++) if (bs_imgs[i] == src) return;
	bs_total++;
	img.i = bs_total;
	bs_titles[img.i] = (info.title)?info.title:(img.alt)?img.alt:img.src;
	img.onclick = bs_showme;
	var alt = (img.alt)?img.alt+"\n":"";
	img.alt = alt + bs_lang["alt"];
	bs_imgs[bs_total] =  src;
}

function bs_add_href(id,info)
{
	var href = $(id);
	if (!href)
	{
		//alert('bs not found href '+id);
		return;
	}
	var src = (info.src)?info.src:bs_escape(href.href);
	for(var i=0;i<=bs_total;i++) if (bs_imgs[i] == src) return;
	bs_total++;
	href.i = bs_total;
	bs_titles[href.i] = (info.title)?info.title:(href.title)?href.title:href.href;
	href.onclick = bs_showme;
	bs_imgs[bs_total] = src;
}

function BlueShow()
{
	bs_win 	= null;
	bs_imgs 	= [];
	bs_titles	= [];
	bs_total 	= 0;
	bs_i 	= 0;
	with( $('bs_img').style)
	{
		width = bs_max_width + bs_padding*2;
		height = bs_max_height + bs_padding*2+5;
	}

	bs_center($('bs_main'));
	window.onscroll = function ()
	{
		if (typeof bs_onscroll == "function") bs_onscroll();
		bs_center($('bs_main'));
	}
	
	var movdiv = $('bs_move_div');
	with (movdiv.style)
	{
		backgroundColor = bs_move["bg"];
		border = bs_move["border"];
		color = bs_move["color"];
		if (isIE()) 
			filter = " Alpha(Opacity="+bs_move["trans"]+")";
		else
			opacity = bs_move["trans"]/100;
	}
	document.body.onmousemove = function (event)
	{
		event = event ? event : window.event;
		if (typeof(bs_onmousemove)== "function") bs_onmousemove();
		if (bs_move["display"])
		{
			with ($('bs_move_div').style)
			{
				left = event.clientX + parseInt(document.body.scrollLeft)+10;
				top = event.clientY + parseInt(document.body.scrollTop);
				display = "";
			}
		}
	}
	$('bs_title').innerHTML = bs_title;
	with($('bs_main').style)
	{
		height = bs_height;
		width = bs_width;
		backgroundColor = bs_win_color;
		padding = bs_padding*2;
	}
}

function bs_bg()
{
	if (bs_hidden)
	{//author : longbill  www.longbill.cn
		with($('bs_bg').style)
		{
			width = parseInt((document.body.scrollWidth<document.body.clientWidth)?document.body.clientWidth:document.body.scrollWidth);
			height = parseInt((document.body.scrollHeight<document.body.clientHeight)?document.body.clientHeight:document.body.scrollHeight);
			//alert(height);
			backgroundColor = bs_bg_color;
			if (isIE()) 
				filter = " Alpha(Opacity="+bs_trans+")";
			else
				opacity = bs_trans/100;
		}
	}
}

function bs_escape(s)
{
	if (!s) return "";
	if (!bs_urlencode) return s;
	var r = "";
	if (s.toLowerCase().substr(0,7) == "http://")
	{
		s = s.substr(7,s.length);
		r += "http://";
	}
	var arr = s.split("/");
	r += arr[0];
	for(var i=1;i<arr.length;i++) r+="/"+escape(arr[i]);
	return r;
}

function bs_showme(event)
{
	bs_bg();
	document.body.onkeypress = function (event)
	{
		event = event?event:window.event;
		window.status = "Key Code = "+event.keyCode;
		switch(event.keyCode)
		{
			case 13: return;break;
			case 27: bs_close();break;
			case 120: bs_close();break;
		}
	}
	if (!bs_show(this.i) && bs_hidden)  $('bs_bg').style.display = "";
	return false;
}

function bs_pre()
{
	if (bs_i>1) bs_show(bs_i-1);
}

function bs_next()
{
	if (bs_i<bs_total) bs_show(bs_i+1);
}

function bs_show(bsi)	
{
	bs_i = bsi;
	if (bs_hidden) $('bs_bg').style.display = "";
	var win = $('bs_main');
	win.style.display = "";

	if (bsi>1 && bs_imgs[bsi-1])
	{
		bs_create_img("bs_img_left",bs_imgs[bsi-1],bs_max_width_s,bs_max_height_s,bs_titles[bsi-1]);
	}
	else
	{
		with ($('bs_img_left'))
		{
			innerHTML = bs_lang["first"];
			onmouseover = null;
			onclick = null;
			bs_move_off();
		}
		
	}
	
	if (bs_imgs[bsi])
	{
		bs_create_img("bs_img",bs_imgs[bsi],bs_max_width,bs_max_height,bs_titles[bsi]);
		$('bs_num').innerHTML = ""+bsi+"/"+bs_total;
	}
	else
	{
		$('bs_img').innerHTML = bs_lang["notfound"];
	}//author : longbill  www.longbill.cn

	if (bsi<bs_total && bs_imgs[bsi+1])
	{
		bs_create_img("bs_img_right",bs_imgs[bsi+1],bs_max_width_s,bs_max_height_s,bs_titles[bsi+1]);
	}
	else
	{
		with ($('bs_img_right'))
		{
			innerHTML = bs_lang["last"];
			onmouseover = null;
			onclick =null;
			bs_move_off();
		}
	}
	bs_center($('bs_main'));
}

function bs_create_img(id,src,max_width,max_height,title)
{
	var imgdiv = $(id);
	if (!imgdiv) return false;
	imgdiv.innerHTML = "";
	imgdiv.t = title;
	var img = document.createElement("img");
	img.style.display = "none";
	img.mw = max_width;
	img.mh = max_height;
	img.id = id+"fff";
	imgdiv.onmouseover = function ()
	{
		var fid = this.id;
		var html = (fid == "bs_img_left")?bs_lang["previous"]+"<br/>"+bs_lang["title"]+this.t:(fid == "bs_img")?bs_lang["title"]+this.t+"<br/>"+bs_lang["open"]:bs_lang["next"]+"<br/>"+bs_lang["title"]+this.t;
		bs_move_on(html);
	}
	imgdiv.onmouseout = bs_move_off;
	imgdiv.onclick = function ()
	{
		var fid = this.id;
		if (fid == "bs_img_left") bs_pre();
		else if (fid == "bs_img_right") bs_next();
		else if (fid == "bs_img") bs_close();
	}
	if (id == "bs_img") imgdiv.ondblclick = function (){open(this.firstChild.src,"_blank","");}
	imgdiv.appendChild(img);
	img.onload = bs_resize;
	img.src = src;
}

function bs_close()
{
	$('bs_main').style.display = "none";
	document.body.onkeypress = null;
	if (bs_hidden) $('bs_bg').style.display = "none";
	bs_move_off();
}

function isIE()
{
	return (document.all && window.ActiveXObject && !window.opera) ? true : false;
}

function bs_resize()
{
	this.style.display = "";
	var w = parseInt(this.width);
	var h = parseInt(this.height);
	var pw = this.mw/w;
	var ph = this.mh/h;
	if (pw>=1 && ph>=1) return;
	var p = (ph>pw)?pw:ph;
	this.width = parseInt(w*p-1);
	this.height = parseInt(h*p-1);
}

function bs_center(win)
{
	var d = document.body;
	var s1 = parseInt(d.scrollTop + d.clientHeight/2 - bs_height/2);
	win.style.top = (s1<parseInt(d.scrollHeight)-bs_height)?s1:d.scrollHeight;
	//author : longbill  www.longbill.cn
	var s1 = parseInt(d.scrollLeft) + parseInt(d.clientWidth/2) - parseInt(bs_width/2);
	win.style.left = (s1<parseInt(d.scrollWidth)-bs_width)?s1:d.scrollWidth;
}

function bs_move_on(s)
{
	bs_move["display"] =1;
	$('bs_move_div').innerHTML =s;
}

function bs_move_off()
{
	bs_move["display"] = false;
	$('bs_move_div').innerHTML = "";
	$('bs_move_div').style.display = "none";
}