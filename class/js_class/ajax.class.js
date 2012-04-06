/*========================

      ajax 操作类

==========================
//同步用法:
var ajax = new ajax();
var text = ajax.post({url:'xml.xml',data:'formID',asynchronous:false}).responseText;
var text = ajax.get({url:'xml.xml',asynchronous:false}).responseText;
alert(text);

//异步用法:
var ajax = new ajax();
ajax.post({url:'xml.xml',asynchronous:true,data:'formID',
			   onSuccess:function(value){
				   alert(value);
			   }
			});
ajax.get({url:'xml.xml',asynchronous:true,
			   onSuccess:function(value){
				   alert(value);
			   }
			});
*/

//ajax类
function ajax()
{
	
	//GET调用方式
	//参数: obj={url:url,asynchronous:true|false,onSuccess:function(){},onFail:function()}
	this.get = function(obj)
	{
		//处理参数
		obj.url = obj.url || '';
		obj.method = 'GET';
		if(obj.asynchronous==null){ obj.asynchronous=true; }
		if(obj.onSuccess){}else{ obj.onSuccess = function(value){}; }
		if(obj.onFail){}else{ obj.onFail = function(value){}; }
		
		//开始AJAX
		var self = this; //保存对象
		var xmlhttp = this.getXMLHTTP(); //取得XMLHttpRequest对象
		if(xmlhttp){
			xmlhttp.open(obj.method,obj.url,obj.asynchronous);
			xmlhttp.onreadystatechange = function(){
				if(this.readyState==4){
					obj.onSuccess(this.responseText);
				}
			}
			xmlhttp.setRequestHeader('Content-Type','text/html');
			xmlhttp.send();
		}
		return xmlhttp;
	}
	
	//POST调用方式
	//参数: obj={url:url,asynchronous:true|false,data:FormID,onSuccess:function(){},onFail:function()}
	this.post = function(obj)
	{
		//处理参数
		obj.url = obj.url || '';
		obj.method = 'POST';
		if(obj.asynchronous==null){ obj.asynchronous=true; }
		if(obj.onSuccess){}else{ obj.onSuccess = function(value){}; }
		if(obj.onFail){}else{ obj.onFail = function(value){}; }
		
		//开始AJAX
		var self = this; //保存对象
		var xmlhttp = this.getXMLHTTP(); //取得XMLHttpRequest对象
		if(xmlhttp){
			xmlhttp.open(obj.method,obj.url,obj.asynchronous);
			xmlhttp.onreadystatechange = function(){
				if(this.readyState==4){
					obj.onSuccess(this.responseText);
				}
			}
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			var data = this.encodeFormData(document.getElementById(elementId));
			xmlhttp.send(data);
		}
		return xmlhttp;
	}
	
	//根据json串，返回一个对象
	//参数: obj = url
	this.json = function(url)
	{
		var _json = this.get( {url:url, asynchronous:false} ).responseText;
		return eval(_json);
	}
	
	 /*   
      *  Analyze form elements data   
      *  @param  formElement  FormObject   
      */   
     this.encodeFormData = function(formElement) {   
      var whereClause = "";   
      var and = "";   
      var elementCount = formElement.length;
      for ( i = 0 ; i < elementCount ; i++ ) {   
        var element = formElement[i];   
        if ( element.name != "" ) {   
          if (element.type=='select-one') {   
            element_value = element.options[element.selectedIndex].value;   
          } else if ( element.type == 'checkbox' || element.type == 'radio' ) {   
            if ( element.checked == false ) {   
              break;      
            }   
            element_value = trim(element.value);   
          } else {   
            element_value = trim(element.value);   
          }   
          whereClause += and + trim(element.name) + '=' + element_value.replace(/\&/g,"%26");   
          and = "&"   
        }   
      }   
      return whereClause;   
    }

	 //创建XMLHTTP对象
	 this.getXMLHTTP = function()
	 {
		 var xmlHttp;
		 try{
		 // Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest(); 
		 }catch(e){
		  // Internet Explorer
		    try{
			  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		 	}catch(e){
			  try{
				 xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }catch(e){
				 alert("您的浏览器不支持AJAX:"+e);
				 return false;
			  }
			}
		}
		return xmlHttp;
	 }
}