var coln=6;
var big_width=120,big_height=big_width;
var imgmax=70;
var foldernamelen=28,filenamelen=40; 
var namelength=15;

function on_load()
{
	RoundCorner('titlediv');
	RoundCorner('maindiv');
	BlueShow();
}

function display_tools()
{
	with($('toolsmore').style)
	{
		display = (display == "none")?"":"none";
	}
}
