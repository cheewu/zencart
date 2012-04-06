var coln=6;
var big_width=130,big_height=big_width;
var imgmax=70;
var foldernamelen=28,filenamelen=40; 
var namelength=15;

function on_load()
{
	BlueShow();
}

function display_tools()
{
	with($('toolsmore').style)
	{
		if (display == "none")
		{
			display = "";
			$('toolsmore_img').src = "temp/phpcms/images/jian.gif";
		}
		else
		{
			display = "none";
			$('toolsmore_img').src = "temp/phpcms/images/jia.gif";
		}
	}
}
