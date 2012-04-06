var FRIENDLY_URLS='true';
function sortFocus(obj){
	if(isIE){
		obj.value ='';
	}
	else{
		o=new Option('','-1');
	    obj.options.add(o);
		obj.value ='-1';
	}
}
function sortBlur(obj, value){
	if(isIE){
		obj.value ='value';
	}
}
function changeSort(obj, sort_url){
	if(obj.value != '-1'){
		if(sort_url.indexOf('?') > -1){
			window.location.href= sort_url + "&productsort=" + obj.value;
		}
		else{
			window.location.href= sort_url + "?productsort=" + obj.value;
		}
	}
}
function changePagesize(obj, sort_url){
	if(obj.value != '-1'){
		if(sort_url.indexOf('?') > -1){
			window.location.href= sort_url + "&pagesize=" + obj.value;
		}
		else{
			window.location.href= sort_url + "?pagesize=" + obj.value;
		}
	}
}
function changePage(obj, sort_url){
	if(obj.value != '-1'){
		if(sort_url.indexOf('?') > -1){
			window.location.href= sort_url + "&page=" + obj.value;
		}
		else{
			window.location.href= sort_url + "?page=" + obj.value;
		}
	}
}
function getCookie(sName)
{
  var aCookie = document.cookie.split("; ");
  for (var i=0; i < aCookie.length; i++)
  {
  var aCrumb = aCookie[i].split("=");
  if (sName == aCrumb[0])
    return unescape(aCrumb[1]);
  }
    return null;
}
function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
  var expires = new Date();
  expires.setTime(expires.getTime() + seconds);
  document.cookie = escape(cookieName) + '=' + escape(cookieValue)
    + (expires ? '; expires=' + expires.toGMTString() : '')
    + (path ? '; path=' + path : '/')
    + (domain ? '; domain=' + domain : '')
    + (secure ? '; secure' : '');
}