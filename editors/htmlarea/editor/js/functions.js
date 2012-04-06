/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

function $(obj)
{
	return document.getElementById(obj);
}

function setcookie(name,value,t)
{
	var cookiestr=name+"="+UrlEncode(value)+";";
	var expires = "";
	var d = new Date();
	var t2=(!t)?cookieexp:t*60*1000;
	d.setTime( d.getTime() + cookieexp);
	expires = "expires=" + d.toGMTString()+";";
	document.cookie = cookiestr+ expires;
}

function checkfile()
{
	var i,files='',dirs='';
	var dirn=0;
	var filen=0;
	for(i=0;i<dir.length;i++)
		if ($('checkbox_d'+i).checked)
		{
			dirs+=UrlEncode(dir[i]+"|");
			dirn++;
		}
	for(i=0;i<file.length;i++)
		if ($('checkbox_f'+i).checked)
		{
			files+=UrlEncode(file[i]+"|");
			filen++;
		}
	r=new Array();
	r["dn"]=dirn;
	r["fn"]=filen;
	r["sdir"]=dirs;
	r["sfile"]=files;
	return r;
}


function downfile()
{
	var arr=checkfile();
	if (arr["fn"] + arr["dn"] == 0)
	{
		notice(lang.no_select);
	}
	else if (arr["fn"] ==1 && arr["dn"] == 0)
	{
		inwin.window.location="down.php?action=downfile&path="+path+arr["sfile"].replace("|",'');
	}
	else
	{
		inwin.window.location = "down.php?action=downfiles&path="+path+"&files="+arr["sfile"]+"&dirs="+arr["sdir"];
	}
}

function downfile1(i)
{
	inwin.window.location="down.php?action=downfile&afile=1&path="+path+file[i];
}

function filecopy(action)
{
	var i=0,n=0;
	var filestr='',dirstr='';
	var act=(action == "copy")?lang.copy:lang.cut;
	var arr=checkfile();
	if (arr["dn"]+arr["fn"] ==0 ) notice(lang.no_select);
	setcookie("action1",action);
	setcookie("from",path);
	setcookie("sdir",arr["sdir"]);
	setcookie("sfile",arr["sfile"]);
}

function filepaste()
{
	sendcomm("paste","path",path,0,0,0);
}


function filedel()
{
	var i,arr=checkfile(),dn=0,alt;
	if (arr['fn']+arr['dn']==0)
	{
		notice(lang.no_select);
		return;
	}
	if (!arr['fn'])
		alt = arr['dn']+lang.folder;
	else if (!arr['dn'])
		alt = arr['fn']+lang.file;
	else
		alt = arr['dn']+lang.folder+lang.and+arr['fn']+lang.file;
	if (!confirm(lang.do_you+lang.del+alt+'?')) return;
	if (arr['dn'] && !confirm(lang.confirm_del_folder)) return;
	sendcomm("delete",Array("path","sdir","sfile"),Array(path,arr['sdir'],arr['sfile']));
}

function fileup(i)
{
	var s="var so=document.getElementById('updiv"+i+"');";
	eval(s);
	so.style.display=(so.style.display=='none')?'':'none';
}

function waitme() //loading
{
	$('loading').style.display='';
	$('loading').innerHTML = lang.loading;
	$('loading').style.pixelTop=document.body.scrollTop;
	window.status = lang.loading;
	return true;
}

function waitmeoff()  // quit loading
{
	$('loading').style.display='none';
	window.status='OK';
	return true;
}

function unrename(id,f1,f2)
{
	var div = $(id);
	if (!div) return;
	if (window.isnew == "file") newfile1(0,f2);
	else if (window.isnew == "dir") newfile1(1,f2);
	else
	{
		if (f1 != f2) filerename1(f1,f2);
		display ();
	}
	window.isnew = "";
}

function filerename(i,f)
{
	var dir2;
	var name = (f)?dir[i]:file[i];
	var fid = (f)?"dirname_":"filename_";
	fid = fid + ""+ i;
	var div = $(fid);
	if (!div) return;
	var arr = div.childNodes;  
	arr[0].style.display = "none";
	if (div.getElementsByTagName('input')[0] == undefined)
	{
		var form = document.createElement("span");
		form.id = "dirname_"+i+"_form";
		form.innerHTML = "<input class='inputtext' style='height:18px;margin:0px;padding:0px;' type=text onkeydown='if (event.keyCode == 13) this.blur();' size="+(name.replace(/[^\x00-\xff]/g,"**").length+5)+" id='"+fid+"_input' value='"+name+"' onblur='unrename(\""+fid+"\",\""+name+"\",this.value);' />";
		div.appendChild(form);
	}
	else
	{
		arr[0].style.display = "none";
		arr[1].style.display = "";
	}
	$(fid+"_input").focus();
	$(fid+"_input").select();
} 

function filerename1(f1,f2)
{
	if (!checkfilename(f1) || !checkfilename(f2)) return;
	sendcomm("rename",["file1","file2","path"],[f1,f2,window.path],0,0,1);
	window.isnew = "";
}

function filerename2(i,f)
{
	var f1 = (f)?dir[i]:file[i];
	if (!f1) return;
	var f2;
	if (f2 = prompt(f1+" "+lang.rename+":",f1))
	{
		if (!checkfilename(f2)) return;
		sendcomm("rename",["file1","file2","path"],[f1,f2,path],0,0,1);
	}
}

function allcheck()
{
	for(var i=0;i<dir.length;i++) $('checkbox_d'+i).checked = true;
	for(var i=0;i<file.length;i++) $('checkbox_f'+i).checked = true;
}

function anticheck()
{
	var i;
	for(i=0;i<dir.length;i++)  $('checkbox_d'+i).checked = !$('checkbox_d'+i).checked;
	for(i=0;i<file.length;i++) $('checkbox_f'+i).checked = !$('checkbox_f'+i).checked;
}

function newfile(f)
{
	if (debug) alert("newfile");
	if (!f)
	{
		window.isnew = "file";
		for(var i=data[path]["file"].length;i>0;i--) data[path]["file"][i] = data[path]["file"][i-1];
		data[path]["file"][0] = lang.new_file_name;
		display();
		filerename(0);
		return;
	}
	else
	{
		window.isnew = "dir";
		for(var i=data[path]["dir"].length;i>0;i--) data[path]["dir"][i] = data[path]["dir"][i-1];
		data[path]["dir"][0] = lang.new_folder_name;
		display();
		filerename(0,1);
		return;
	}
}

function newfile1(f,fname)
{
	if (debug) alert("newfile1");
	if (fname == "") return;
	var action = f?"newdir":"newfile";
	for(var i= f?1:0;i<dir.length;i++)
		if (fname.toLowerCase() == dir[i].toLowerCase() )
		{
		 	notice(lang.already_exist);
			if (window.isnew) reloaddata();
			return;
		}
	for(var i=f?0:1;i<file.length;i++)
		if (fname.toLowerCase() == file[i].toLowerCase() )
		{
		 	notice(lang.already_exist);
			if (window.isnew) reloaddata();
			return;
		}
	if (!checkfilename(fname)) return;
	sendcomm(action,["name","path"],[fname,path],0,0,1);
}

function sendcomm(act,vars,vals,func,re,al,method)
{
	var path1=window.path;
	waitme();
	if (debug) alert("comm ");
	var sk=new sack("do.php");
	sk.setVar("action",act);
	sk.late=true;
	if (method) sk.method=method;
	if (typeof(vars)=="object")
	{
		if (vars.length!=vals.length) return false;
		var i=0;
		for(i=0;i<vars.length;i++) sk.setVar(vars[i],vals[i]);	
	}
	else sk.setVar(vars,vals);
	
	if (!func)
	{
		sk.onCompletion=function()
		{
			if (debug) alert("ajax response :"+sk.response);
			var res=checkdata(sk.response);
			if (res==-1)
				notice(lang.error_occur+":\n"+pickdata(sk.response));
			else if (res==1)
			{
				if (!al) notice(pickdata(sk.response));
				if (!re) reloaddata(path1);
			}
			else if (res !=2)
				notice(sk.response);
			waitmeoff();
		}
	}
	else sk.onCompletion = function () {func(sk)};
	sk.onError = function()
	{
		alert(act+' '+lang.error_occur);
		waitmeoff();
	}
	sk.runAJAX();
}

function makesure(sort,id)
{
	if (sort=="f" && confirm(lang.do_you+lang.del+' '+file[id]+" ?"))
		sendcomm("delete",Array("path","sfile"),Array(path,file[id]));
	else if (sort=="d" && confirm(lang.do_you+lang.del+' '+dir[id]+" ?"))
		sendcomm("delete",Array("path","sdir"),Array(path,dir[id]));
	else if (sort=="searched_file" && confirm(lang.do_you+lang.del+' '+id+" ?"))
		sendcomm("deletefile","path",id);
}

function zippack()
{
	var i,arr=checkfile(),dn=0,alt;
	if (arr['fn']+arr['dn']==0)
	{
		notice(lang.no_select);
		return;
	}
	var ar=path.split("/"),fname;
	fname=ar[ar.length - 2];
	if (fname == "..") fname = lang.default_zip_name;
	html = "<form id='zipform' style='margin:0' action=# onsubmit='zippack_do(this);return false;'>"+lang.please_input+' ZIP '+lang.file+lang.name;
	html+= "<br/><input type=text size=20 name='key' value='"+fname+".zip' />&nbsp;<input type=submit value='GO' /></form>";
	window.movenotice = 0;
	notice(html,30,mouse_x,mouse_y,1);
}

function zippack_do(f)
{
	var i,arr=checkfile(),dn=0,alt;
	if (arr['fn']+arr['dn']==0)
	{
		notice(lang.no_select);
		return false;
	}
	key = f.key.value;
	if (!key)
	{
		alert(lang.please_input+" ZIP "+lang.file+lang.name);
		return false;
	}
	if (key.substring(key.length-4,key.length).toLowerCase()!=".zip") key+=".zip";
	if (!checkfilename(key)) return;
	for(var i=0;i<file.length;i++)
		if (file[i].toLowerCase() == key.toLowerCase())
			if (!confirm(lang.already_exist+" ,"+lang.do_cover+'?')) return false;
	window.movenotice = 1
	$('notice').style.display = "none";
	sendcomm("zippack",Array("path","key","sdir","sfile"),Array(path,key,arr['sdir'],arr['sfile']));
}


function unpackall1(i)
{
	var filename;
	filename=file[i];
	var key='',cover=false;
	filename=filename.substring(0,filename.indexOf(".zip"));
	if (key=prompt(lang.please_input+lang.extract+lang.folder+lang.name+lang.extract_quote,filename))
	{
		if (!checkfilename(key)) return;
		var cover=1;
		if (key!="./" && key!=".")
		{
			for(var ii=0;ii<dir.length;ii++)
			{
				if (dir[ii].toLowerCase() == key.toLowerCase())
					cover = confirm(key+lang.already_exist+','+lang.do_cover+'?');
			}
		}
		else
		{
			cover = confirm(lang.if_cover+","+lang.do_cover+"?");
			key = "./";
		}
		cover = (cover)?"1":"0";
		sendcomm("unpackall",Array("path","key","file","cover"),Array(path,key,file[i],cover));
	}
}

function property()
{
	sendcomm("property","path",window.path,null,false);
	window.movenotice = 0;
}

function upindex()
{
	var path=window.path;
	var root=window.root;
	if (path.indexOf(root) !=0) path = root;
	if (path == root)
	{
		notice(lang.no_up+"!",1);
		return;
	}
	var arr = path.split("/");
	var i;
	path = "";
	for(i=0;i<arr.length-2;i++) path+=arr[i]+"/";
	window.path = path;
	opendir(path);
}

function resetdata(s,vname)
{
	if (!s) return;
	var arr=s.split("|");
	for(i=0;i<arr.length;i++)
	{
		if (arr[i]=="") continue;
		eval(vname+"['"+arr[i]+"']=true;");
	}
}

function preloaddata(p)
{
	if (data[p]) return;
	if (debug) alert("preload :"+p);
	var sk=new sack("do.php");
	sk.setVar("action","list");
	sk.setVar("path",p);
	sk.onCompletion=function()
	{
		var res=checkdata(sk.response);
		if (res==1)
		{
			if (p.charAt(p.length-1)!="/") p+="/";
			data[p]=pickdata(sk.response);
			if (debug) alert("preload data["+p+"]="+data[p]);
		}
	}
	sk.onError=function() {}
	sk.runAJAX();
}

function checkdata(s)
{
	if (s.indexOf("OK")!=-1) return 1;
	else if (s.indexOf("Error")!=-1) return -1;
	else if (s.indexOf("Eval")!=-1)
	{
		if(debug) alert("Eval:\n"+pickdata(s));
		eval(pickdata(s));
		return 2;
	}
	else return 0;
}

function pickdata(s)
{
	if (s.length<=0) return false;
	var arr=s.split("==?");
	arr=arr[1].split("?==");
	return arr[0];
}

function opendir(path)
{
	if (debug) alert("opendir :"+path);
	if (!path) path = root;
	if (!data[path])
	{
		reloaddata(path,1);
		return;
	}
	else
	{
		window.path=path;
		display();
	}
}

function reloaddata(p,r)
{
	if (!p) p = window.path;
	if (p.charAt(p.length-1) != "/") p+="/";
	if (debug) alert("reloaddata :"+p);
	var sk = new sack("do.php");
	sk.setVar("action","list");
	sk.setVar("path",p);
	sk.late = true;
	sk.onCompletion = function()
	{
		var res=checkdata(sk.response);
		if (res == 1)
		{
			data[p] = pickdata(sk.response);
			if (debug) alert("refreshed data from "+p+" and here is "+path);
			if (p == path) display();
			else if (r)
			{
				window.path = p;
				display();
			}
		}
		waitmeoff();
	}
	sk.onError = function()
	{
		alert(lang.error_occur+":"+lang.when+lang.open+" "+p+" !");
	}
	waitme();
	sk.runAJAX();
}

function display()
{
	if (debug) alert("display data:"+data[path]);
	if (typeof(data[path])=="string" && data[path]!="")
	{
		if (debug) alert("data["+path+"]=string");
		var d=data[path];
		var arr=d.split("||");
		var arr2;
		var v,di=0,fi=0,i;
		var mdir=new Array(),mfile=new Array(),msize=new Array(),mhide = new Array();
		for(i=0;i<arr.length;i++)
		{
			v=arr[i];
			if (v=="") continue;
			if (v.indexOf("|")==-1)
			{
				if (v.indexOf("[/hide]") !=-1)
				{
					v = v.replace("[/hide]","");
					mhide[v] = true;
				}
				mdir[di] = v;
				predir=path+v+"/";
				if (preload && !data[predir]) setTimeout("preloaddata('"+predir+"');",di*100);
				di++;
			}
			else
			{
				arr2=v.split("|");
				if (arr2[0].indexOf("[/hide]") !=-1)
				{
					mfile[fi] = arr2[0].replace("[/hide]","");
					mhide[mfile[fi]] = true;
				}
				else mfile[fi]=arr2[0];
				msize[fi]=arr2[1];
				fi++;
			}
		}
		data[path] = new Array();
		data[path]["dir"] = mdir;
		data[path]["file"] = mfile;
		data[path]["size"] = msize;
		data[path]["hide"] = mhide;
		window.dir = mdir;
		window.file = mfile;
		window.daxiao = msize;
		window.hidefiles = mhide;
	}
	else if (typeof(data[path]) == "object")
	{	
		if (debug) alert("data["+path+"]=array");
		window.dir=data[path]["dir"];
		window.file=data[path]["file"];
		window.daxiao=data[path]["size"];
		window.hidefiles=data[path]["hide"];
	}
	window.path=path;
	window.vdis=($('visit_mode').checked)?"none":"inline";
	try { $('smalltable').style.display = "none"; }catch(e){};
	try { $('dirtable').style.display = "none"; }catch(e){};
	try { $('filetable').style.display = "none"; }catch(e){};
	try { $('bigtable').style.display = "none"; }catch(e){};
	if (top.onloading) top.loadingerror();
	refresh();
}

function refresh() 
{
	if (debug) alert("refresh");
	if ($('icon_mode').checked) { refresh2(); return;}
	try { $('smalltable').style.display = ""; }catch(e){};
	try { $('dirtable').style.display = "";}catch(e){};
	try { $('filetable').style.display = ""; }catch(e){};
	try { $('bigtable').innerHTML = ""; }catch(e){};
	try { $('bigtable_top').style.display = "none"; }catch(e){};
	BlueShow();
	var html='';
	var i=0,f='';
	for (i=0;i<dir.length;i++)
	{
		if (dir[i]=="") continue;
		var vals = {
			rowodd : (i%2 == 1)?"1":"0",
			display : vdis,
			id : ""+i,
			name : getlengthstr(dir[i],foldernamelen),
			path : window.path+dir[i]+"/",
			fullname : dir[i],
			title : lang.open+" "+dir[i]
		};
		//if (hidefiles[dir[i]] == true) vals["name"] = hidefileshtml.replace("{name}",vals["name"]);
		html+=deal_item("dir",vals);
	}
	$('dirtable').innerHTML=html;
	html = "";
	var bs = [];
	var textfiles = [];
	for (i=0;i<file.length;i++)
	{
		var encodedsrc = (allowurlencode)?UrlEncode(path+file[i]):path+file[i];
		var hrefsrc = str_replace("%2f","/",str_replace("%2F","/",encodedsrc));
		var f=file[i].split(".")[file[i].split(".").length-1];
		f=f.toLowerCase();
		var orig_f = f;
		f = (editfile[f]) ? "txt":(f=="zip")? "zip":(f=="exe" | f=="dll")?"exe":(imgfiles.indexOf(f)!=-1)? "image": "unknown";
		var vals = {
			url : hrefsrc,
			id : ""+i,
			rowodd : (i%2 == 1)?"1":"0",
			display : vdis,
			size : daxiao[i],
			type : f,
			fullname : file[i],
			path : encodedsrc,
			hrefid : "bs_img_"+i,
			title : file[i] + " " + daxiao[i],
			zip : ""
		};
		if (orig_f == "txt")
		{
			textfiles[textfiles.length] = { id:vals["hrefid"],path:encodedsrc};
		}
		if (f == "image") bs[bs.length] = { id: vals["hrefid"],src:vals["url"],title:file[i]};
		if (f == "zip")
		{
			vals["name"] = getlengthstr(file[i],filenamelen-5);
			//if (hidefiles[file[i]] == true) vals["name"] = hidefileshtml.replace("{name}",vals["name"]);
			vals["zip"]+= " <a style='display:"+vdis+"' href='javascript:unpackall1("+i+");'>"+lang.extract+"</a>";
		}
		else
		{
			vals["name"] = getlengthstr(file[i],filenamelen);
			//if (hidefiles[file[i]] == true) vals["name"] = hidefileshtml.replace("{name}",vals["name"]);
		}
		
		html+=deal_item("file",vals);
	}
	$('filetable').innerHTML=html;
	for(var i=0;i<bs.length;i++) bs_add_href(bs[i].id,{src:bs[i].src,title:bs[i].title});
	for(var i=0;i<textfiles.length;i++) add_textfile(textfiles[i].id,textfiles[i].path);
	post_fresh();
	total();
}

function refresh2() 
{
	if (debug) alert("refresh2");
	BlueShow();
	try { $('dirtable').innerHTML = ""; }catch(e){};
	try { $('filetable').innerHTML = ""; }catch(e){};
	try { $('bigtable_top').style.display = ""; }catch(e){};
	try { $('smalltable').style.display = "none"; }catch(e){};
	var i=0,f='',coli=0 , html;
	images = [];
	var body = $('bigtable');
	body.style.display = "";
	body.style.float = "left";
	body.innerHTML = "";
	if (typeof dir == "object")
	{
		for (i=0;i<dir.length;i++)
		{
			if (dir[i]=="") continue;
			var item = document.createElement("div");
			with(item.style)
			{
				width = big_width;
				height = big_height;
				overflow = "hidden";
				textAlign = "center";
				float = "left";
				display = "inline";
			}
			var a = document.createElement("a");
			a.href = 'javascript:opendir("'+path+dir[i]+'\/")';
			a.title = lang.open+' '+dir[i];
			var img = document.createElement("img");
			img.src = 'images/big_folder.gif';
			var imgtable = document.createElement("table");
			var tr = imgtable.insertRow(null);
			var td = tr.insertCell(null);
			with (td.style)
			{
				height = imgmax+5;
				width = imgmax+5;
				overflow = "auto";
				verticalAlign  = "middle";
				textAlign = "center";
				border = "1px solid #eeeeee";
				padding = 0;
			}
			a.appendChild(img);
			td.appendChild(a);
			item.appendChild(imgtable);
			var html =""+
			"<span style='overflow:hidden'><input style='display:"+vdis+"' type='checkbox' id='checkbox_d"+i+"'>"+
			"<a href='javascript:opendir(\""+path+dir[i]+"/\")' title='"+lang.open+" "+dir[i]+"'>"+getlengthstr(dir[i],namelength)+
			"</a></span><br/>"+
			"<span align=center style='display:"+vdis+"'><a href='javascript:filerename2("+i+")' title='"+lang.rename+" "+dir[i]+"'>"+lang.change_name+"</a>"+
			"&nbsp;<a href='javascript:makesure(\"d\","+i+");' title='"+lang.del+dir[i]+"'>"+lang.del+"</a></span>";
			item.innerHTML += html;
			body.appendChild(item);
		}
	}
	if (typeof file=="object")
	{
		for (i=0;i<file.length;i++)
		{
			if (file[i]=="") continue;
			f=file[i].split(".")[file[i].split(".").length-1];
			f=f.toLowerCase();
			var encodedsrc = allowurlencode?UrlEncode(path+file[i]):path+file[i];
			var hrefsrc = str_replace("%2f","/",str_replace("%2F","/",encodedsrc));
			if (jumpfile[f]) hrefsrc = "jump.php?url="+hrefsrc;
			
			var item = document.createElement("div");
			with(item.style)
			{
				width = big_width;
				height = big_height;
				overflow = "hidden";
				textAlign = "center";
				float = "left";
				display = "inline";
			}
			var a = document.createElement("a");
			with(a.style)
			{
				//border = "1px solid #eeeeee";
				padding = "0px";
				cursor = "hand";
			}
			a.href = hrefsrc;
			a.target = "_blank";
			a.title=file[i]+'  \n'+daxiao[i];
			var img = document.createElement("img");
			img.onerror = "if (img_err_t<100) this.src = this.src.toString();img_err_t++;";
			if(editfile[f])
				img.src ='images/big_txt.gif';
			else if (f=="zip")
				img.src ='images/big_rar.gif';
			else if (f=="exe" | f=="dll")
				img.src ='images/big_exe.gif';
			else if (imgfiles.indexOf(f)!=-1)
			{
				img.onload =  resizeimage2;
				img.src = 'image.php?max='+(imgmax-1)+'&path='+encodedsrc;
				img.onclick = bs_showme;
				images++;
				img.id = "s_img_"+images;
				a.id = "href_id_"+images;
			}
			else
				img.src ='images/big_unknown.gif';
		
			var imgtable = document.createElement("table");
			imgtable.style.tableLayout = "fixed";
			var tr = imgtable.insertRow(null);
			tr.style.height = imgmax + 5;
			var td = tr.insertCell(null);
			with (td.style)
			{
				width = imgmax+5;
				overflow = "hidden";
				verticalAlign  = "middle";
				textAlign = "center";
			}
			td.appendChild(img);
			a.appendChild(imgtable);
			item.appendChild(a);
			
			if(a.id) setTimeout("bs_add_href('"+a.id+"',{src:'"+hrefsrc+"',title:'"+file[i]+"'});",100);
			else if (f == "txt")
			{
				a.path = encodedsrc;
				a.onclick = "show_textfile.call(this);return false;";
			}
			else a.onclick = "open('"+hrefsrc+"','_blank','');";
			html ="<span style='height:20px;overflow:hidden;position:relative;'><input type='checkbox' id='checkbox_f"+i+"' style='display:"+vdis+"'>"+
			"<a href='"+hrefsrc+"' target=_blank title='"+lang.open+" "+file[i]+" \n"+lang.size+":"+daxiao[i]+"' ";
			if (a.id) html += "onclick=''";
			html +=">"+getlengthstr(file[i],namelength)+"</a>";
			html+=(f=="zip")?"&nbsp;<a href='javascript:unpackall1("+i+")' style='display:"+vdis+"' title="+lang.extract+">"+lang.extract+"</a> ":"";
			html +="</span><br/><span style='display:"+vdis+";position:relative;'>"+
			"<a href='javascript:filerename2("+i+");'>"+lang.change_name+"</a> "+
			"<a href='index.php?action=editfile&path="+path+file[i]+"' target=_blank > ";
			html += lang.edit;
			html +="</a></span>";
			item.innerHTML += html;
			body.appendChild(item);
		}
	}
	resizeimage();
	post_fresh();
	total();
}

function deal_item(typ,vals)
{
	var s = (typ == "file")?file_item:dir_item;
	if (typeof vals != "object") return false;
	for(key in vals)
	{
		s = str_replace("{"+key+"}",vals[key],s);
	}
	return s;
}

function str_replace(search, replace, str)
{
	var regex = new RegExp(search, "g");
	return str.replace(regex, replace);
}

function getstrlength(sChars)
{
	return sChars.replace(/[^\x00-\xff]/g,"xx").length;
}

function getlengthstr(sSource, iLen)
{
	if(getstrlength(sSource) <= iLen) return sSource;
	var ELIDED = "...";
	
	var str = "";
	var l = 0;
	var schar;
	for(var i=0; schar=sSource.charAt(i); i++)
	{
		str += schar;
		l += (schar.match(/[^\x00-\xff]/) != null ? 2 : 1);
		if(l >= iLen - ELIDED.length) break;
	}
	str += ELIDED;
	return str;
}

function add_textfile(id,path)
{
	var a = $(id);
	if (!a) return;
	a.onclick = show_textfile;
	a.path = path;
}

function show_textfile()
{
	var src = this.path;
	window.newwinmargin += 10;
	var body = document.createElement("div");
	body.className = "textwin";
	with(body.style)
	{
		position = "absolute";
		left = newwinmargin;
		top = newwinmargin;
		width = textwinwidth;
	}
	var title = document.createElement("div");
	title.className = "textwintitle";
	title.onmousedown = function ()
	{
		this.parentNode.style.zIndex = topzindex+1;
		topzindex+=1;
	}
	var titlespan = document.createElement("span");
	titlespan.innerHTML = this.title;
	with(titlespan.style)
	{
		width = "80%";
		margin = "2px";
	}
	title.appendChild(titlespan);
	var span1 = document.createElement("a");
	span1.className = "textwinclose";
	span1.innerHTML = lang.hide;
	with(span1.style)
	{
		float = "right";
	}
	span1.onclick = function()
	{
		var o = this.parentNode.nextSibling.style;
		if (o.display == "none")
		{
			o.display = "";
			this.innerHTML = lang.hide;
		}
		else
		{
			o.display = "none";
			this.innerHTML = lang.display;
		}
	}
	
	var span = document.createElement("a");
	span.className = "textwinclose";
	span.innerHTML = lang.close;
	with(span.style)
	{
		float = "right";
		clear = "right";
	}
	span.onclick = function()
	{
		document.body.removeChild(this.parentNode.parentNode);
	}
	
	title.appendChild(span1);
	title.appendChild(span);
	body.appendChild(title);
	
	var contentdiv = document.createElement("div");
	contentdiv.style.border = "0px";
	contentdiv.style.height = textwinheight;
	contentdiv.id = "content_"+newwinmargin;
	var content = document.createElement("iframe");
	content.className = "textwiniframe";
	content.scrolling = "no";
	content.src = "do.php?action=readtext&path="+src;
	contentdiv.appendChild(content);
	body.appendChild(contentdiv);
	document.body.appendChild(body);
	drag(body,title);
	return false;
}

function dealpath(s)
{
	if (!s) return "";
	if (s.indexOf(root) != 0) opendir(root);
	s = s.replace(root,'');
	var arr=s.split("/"),s1 = root;
	var r = "<a href='javascript:opendir(\""+root+"\");'>"+lang.root+"</a>/";
	for(var i=0;i<arr.length;i++)
	{
		if (!arr[i]) continue;
		s1=s1+arr[i]+"/";
		r=r+"<a href='javascript:opendir(\""+s1+"\");'>"+getlengthstr(arr[i],20)+"</a>/";
	}
	return r;
} 

var filei=0;
function addupfile()
{
	filei++;
	var span = $("updivdata");
	var divObj = document.createElement("div");
	
	divObj.id = "upfileinput"+filei;
	divObj.innerHTML = lang.local+lang.file+":<INPUT name='myfile"+filei+"' TYPE='file'  size='50' />&nbsp;<input type=button onclick='delupfile("+filei+")' value='"+lang.del+"' />";
	span.appendChild(divObj);
}

function delupfile(i) 
{
    var span = document.getElementById("updivdata");
    var divObj = document.getElementById("upfileinput"+i);
    if (span != null && divObj != null) 
    {
        span.removeChild(divObj);
    }
}

function savefromurl()
{
	var url=document.upform2.url.value.toLowerCase();
	if (url.indexOf("://") == -1 )
		alert(lang.url_error+"!");
	else
	{
		sendcomm("savefromurl",Array("url","path","filename"),Array(url,path,document.upform2.filename.value));
	}
	return false;
}

function resizeimage()
{
	for(var i=1;i<=images;i++)
	{
		resizeimage1(i);
	}
}

function resizeimage1(i)
{
	var img = $("s_img_"+i);
	if (img && img.sized && img.sized>=2) return;
	if (!img || !img.width || !img.height)
	{
		eval("setTimeout('resizeimage1("+i+");',300);");
		return;
	}
	var w = parseInt(img.width);
	var h = parseInt(img.height);
	if (!img.sized) img.sized = 0;
	img.sized++;
	if (img.sized<=1) eval("setTimeout('resizeimage1("+i+",1);',300);");
	var pw = imgmax/w;
	var ph = imgmax/h;
	if (pw-1>=0 && ph-1>=0) return;
	var p = (ph-pw>0)?pw:ph;
	img.width = parseInt(w*p);
	img.height = parseInt(h*p);
}

function resizeimage2()
{
	this.sized = 2;
	var w = parseInt(this.width);
	var h = parseInt(this.height);
	var pw = imgmax/w;
	var ph = imgmax/h;
	if (pw-1>=0 && ph-1>=0) return;
	var p = (ph-pw>0)?pw:ph;
	this.width = parseInt(w*p);
	this.height = parseInt(h*p);
}

function checkfilename(f)
{
	var limit=Array('\\','\/',':','*','?','"','<','>','|','\'');
	for(var i=0;limit[i];i++)
		if (f.indexOf(limit[i]) != -1)
		{
			alert(lang.name_error2+":\n"+"\\ \/ : * ? \" < > | '");
			return false;
		}
	return true;
}

function setHover(el,color)
{
	if (!el.bg) el.bg=el.style.backgroundColor;
	el.style.backgroundColor = color;
}

function reHover(el)
{
	el.style.backgroundColor=el.bg;
}

function open_ctrl()
{
	if ( allow_admin == "none") 
	{
		alert(lang.deny+"!");
		return;
	}
	if ($('ctrl'))
	{
		$('ctrl').style.display = "";
		return;
	}
	var w = document.createElement("div");
	with(w.style)
	{
		width = 550;
		height = 400;
		border = "1px solid #555555";
		position = "absolute";
		left = "100px"; top = "50px";
		zIndex = window.maxindex;
		backgroundColor = "#3070e3";
	}
	window.maxindex++;
	w.id = "ctrl";
	var t1 = document.createElement("span");
	with(t1.style)
	{
		width = "544px";
		height = "22px";
		border = "0px";
		position = "absolute";
		//float = "left";
		textAlign = "left";
		left = "0px"; top = "0px"; padding = "2px";
		backgroundColor = "#3378ec";
		cursor = "move";
		fontSize = "13px";
	}
	t1.innerHTML = "<b><div style='color:#ffffff;float:left;clear:left;'>"+lang.ctrl_panel+"</div></b>"+
	"<div style='float:right;clear:right;'><a href='javascript:close_ctrl()' style='color:#ffffff;font-weight:bold;'>"+lang.close+"</a></div>";
	w.appendChild(t1);
	w.innerHTML += "<iframe id='ctrl_win' src='admin.php' frameborder=0 width=548 height=376 style='margin:0px;border-width:0px;position:absolute;top:22px;'></iframe>";
	document.body.appendChild(w);
	drag(w);
}

function close_ctrl()
{
	$('ctrl').style.display = "none";
}

function notice(s,t,x,y,is_html)
{

	var t = t?t:3;
	if ($('notice'))
	{
		d = $('notice');
	}
	else
	{
		var d = document.createElement("div");
		d.id = "notice";
	}

	if (nav.isIE && !is_html)
	{
		d.innerText = s;
	}
	else if (!nav.isIE && !is_html)
	{ 
		d.innerHTML = "<pre style='font-size:12px'>"+s+"</pre>";
	}
	else
	{
		d.innerHTML = s;
	}
	
	with(d.style)
	{
		display = "";
		position = "absolute";
		padding = "3px";
		color = "#000";
		zIndex = 1002;
		backgroundColor = "#ffffaa";
		padding = "2px";
		fontSize = "12px";
		top = y?y:window.mouse_y;
		left = x?x:window.mouse_x+20;
		border = "1px solid #333333";
	}
	
	d.onmouseover = function()
	{
		if (window.timehandle) clearTimeout(window.timehandle);
	}
	d.onmouseout = function ()
	{
		window.timehandle = setTimeout("$('notice').style.display = 'none';window.movenotice=1;",t*1000);
	}
	
	document.body.appendChild(d);
	window.timehandle = setTimeout("$('notice').style.display = 'none';window.movenotice=1;",t*1000);
	return;
}

function dis_search(s)
{
	if ($('dis_search'))
	{
		d = $('dis_search');
	}
	else
	{
		var d = document.createElement("div");
		d.id = "dis_search";
	}

	d.innerHTML = s;
	
	with(d.style)
	{
		display = "";
		position = "absolute";
		padding = "3px";
		color = "#000000";
		zIndex = window.maxindex;
		backgroundColor = "#ffffaa";
		padding = "2px";
		fontSize = "12px";
		top = 100;
		left = 100;
		border = "1px solid #333333";
	}
	window.maxindex++;
	document.body.appendChild(d);
	return;
}

function total()
{
	var fi = $('total_file');
	var fo = $('total_folder');
	if (!fi || !fo) return;
	fi.innerHTML = file.length;
	fo.innerHTML = dir.length;
}
