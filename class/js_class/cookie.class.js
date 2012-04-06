/*========================

      cookie操作类

==========================
//函数说明: cookie操作类
//函数引用:
	cookie.set(name, value, seconds); //设置一个cookie
	cookie.get(name); //取得指定名称的cookie值
	cookie.del(name); //删除指定名称的cookie
*/
var cookie = new cookie();
function cookie(){
	//设置一个cookie
	this.set = function (name, value, seconds){ 
		if (typeof(seconds) != 'undefined'){
			var date = new Date();
			date.setTime(date.getTime() + (seconds*1000));
			var expires = "; expires=" + date.toGMTString();
		}
		else {
			var expires = "";
		}
		document.cookie = name+"="+value+expires+"; path=/";
	}
 	//取得指定名称的cookie值
	this.get = function (name){
		name = name + "=";
		var carray = document.cookie.split(';');
		for(var i=0;i < carray.length;i++) {
			var c = carray[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
		return null;
	}
	//删除指定名称的cookie
	this.del = function (name){ this.set(name, "", -1);	}
}
