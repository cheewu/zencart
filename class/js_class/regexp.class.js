/*========================

    regexp 常用表单验证

==========================
//常用表单验证
//函数引用: regexp("字符串","类型标识")
*/
function regexp(str,name)
{
	var revalue = false; //初始化返回值
	var objexp; //正则表达式对象
	
	name = trim(name);
	switch (name){
		//"name": 匹配帐号是否合法(字母开头，允许5-16字节，允许字母数字下划线)
		case "name":
			objexp = /^[a-zA-Z][a-zA-Z0-9_]{4,15}$/;
			break;
		//email地址
    	case "email":
			objexp = /^w+([-+.]w+)*@w+([-.]w+)*.w+([-.]w+)*$/;
			break;
		//"ABC": 由26个英文字母的大写组成的字符串
		case "ABC":
			objexp = /^[A-Z]+$/;
			break;
		//"Abc": 由26个英文字母组成的字符串
		case "Abc":
			objexp = /^[A-Za-z]+$/;
			break;
		//"abc": 由26个英文字母的小写组成的字符串
		case "abc":
			objexp = /^[a-z]+$/;
			break;
		//"Abc123": 由数字和26个英文字母组成的字符串
		case "Abc123":
			objexp = /^[A-Za-z0-9]+$/;
			break;
		//"Abc_123": 由数字、26个英文字母或者下划线组成的字符串
		case "Abc_123":
			objexp = /^w+$/;
			break;
		//"123": 非负整数
		case "123":
			objexp = /^[0-9]*$/;
			break;
		//"-123": 负整数
		case "-123":
			objexp = /-[1-9][0-9]*$/;
			break;
		//"date": 年-月-日
		case "date":
			objexp = /^\d{4}-\d{1,2}-\d{1,2}$/;
			break;
		//"time": 时:分:秒
		case "time":
			objexp = /^\d{4}-\d{1,2}-\d{1,2}\s\d{1,2}:\d{1,2}:\d{1,2}$/;
			break;
		//"ip": IP地址
		case "ip":
			objexp = /^\d+.\d+.\d+.\d+$/;
			break;
		//"cn": 匹配中文汉字
		case "cn":
			objexp = /^[u4e00-u9fa5],{0,}$/;
			break;
		//"mobile": 是否为手机号码
		case "mobile":
			objexp = /^((\(\d{2,3}\))|(\d{3}\-))?13\d{9}$/;
			break;
		//"phone": 匹配国内电话号码
		case "phone":
			objexp = /^((\d{3,4})|\d{3,4}-)?\d{7,8}$/;
			break;
		//"qq": 匹配腾讯QQ号
		case "qq":
			objexp = /^[1-9][0-9]{4,}$/;
			break;
		//"url": url网址
		case "url":
			objexp = new RegExp("^[a-zA-z]+://[^s]*$"); 
			break;
		//"dnum": 浮点数
		case "dnum":
			objexp = /^-?([1-9]d*.d*|0.d*[1-9]d*|0?.0+|0)$/;
			break;
		//"idcard": 是否为身份证号码
		case "idcard":
			objexp = /(^\d{15}$)|(^\d{17}[0-9Xx]$)/;
			break;
		//"cn": 中文名字,2到5个汉字
		case "cn":
			objexp = /^[\u4e00-\u9fa5]{2,5}$/;
			break;
	}
	
	if(objexp){
		revalue = objexp.test(str);
	}
	//"notnull": 非空验证,必非有值
	if(name == "notnull"){
		if(trim(str) != ""){
			revalue	= true ;
		}else{
			revalue	= false ;
		}
	}
	return revalue;
}