var coln=6;
var big_width=120,big_height=big_width;
var imgmax=70;
var foldernamelen=28,filenamelen=40; 
var namelength=15;

function on_load()
{
	RoundCorner('titlediv');
	RoundCorner('maindiv');
	RoundCorner('inputdiv');
	BlueShow();
}

function drag(o)
{
	if (typeof o == "string") o = document.getElementById(o);
	o.orig_x = parseInt(o.style.left) - document.body.scrollLeft;
	o.orig_y = parseInt(o.style.top) - document.body.scrollTop;
	o.onmousedown = function(a)
	{
		var d=document;
		if(!a)a=window.event;
		var x = a.clientX+d.body.scrollLeft-o.offsetLeft;
		var y = a.clientY+d.body.scrollTop-o.offsetTop;
		
		d.ondragstart = "return false;"
		d.onselectstart = "return false;"
		d.onselect = "document.selection.empty();"
				
		if(o.setCapture)
			o.setCapture();
		else if(window.captureEvents)
			window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);

		d.onmousemove = function(a)
		{
			if(!a)a=window.event;
			o.style.left = a.clientX+document.body.scrollLeft-x;
			o.style.top = a.clientY+document.body.scrollTop-y;
			o.orig_x = parseInt(o.style.left) - document.body.scrollLeft;
			o.orig_y = parseInt(o.style.top) - document.body.scrollTop;
		}

		d.onmouseup = function()
		{
			if(o.releaseCapture)
				o.releaseCapture();
			else if(window.captureEvents)
				window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
			d.onmousemove = null;
			d.onmouseup = null;
			d.ondragstart = null;
			d.onselectstart = null;
			d.onselect = null;
		}
	}

	window.onscroll = function ()
	{
		o.style.left = o.orig_x + document.body.scrollLeft;
		o.style.top = o.orig_y + document.body.scrollTop;
	}
}

function display_tools()
{
	with($('toolsmore').style)
	{
		display = (display == "none")?"":"none";
	}
}
