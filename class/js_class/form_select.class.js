/*==========================

  form_select 下拉选框操作类

============================
说明: 表单中,下拉选框操作类
引用: var select = new form_select('元素的ID');
方法: 
	loadData(data) //载入数据,参数: [{value:'值1',name:'名称1',selected:false},{value:'值2',name:'名称2',selected:true}]
	getData() //返回元素中所有子项,类型: 数组
	add(obj) //添加新选项 参数: {value:'值1',name:'名称1',selected:false}
	del(value) //删除指定值的选项
	clear() //清除所有的选项
	selected(value) //选中指定值的选项	
	isBeing(value) //判断指定值的子项是否已经存在
	count() //获得对象中包含的选项的个数
	getValue() //返回当前选中项的值
	getName(value) //根据指定的值,返回相应子项的名称文本	
	onchange() //自定义联动事件
*/

function form_select(id)
{
	this.id = id; //元素id
	this.o = window.document.getElementById(this.id) || document.getElementById(this.id); //获取操作对象
	
	//载入数据,参数:data类型为数组,子元素类型为对象; isclear 是否清除现有的数据。
	//如: [{value:'值1',name:'名称1',selected:false},{value:'值2',name:'名称2',selected:true}]
	this.loadData = function(data,isclear)
	{
		if(isclear){ this.clear(); }
		for(var i in data){
			this.add(data[i]);
		}
	}
	
	//返回元素中所有子项(功能与loadData方法相反), 返回值: 数组,子元素类型为对象。
	//返回值如：[{value:'值1',name:'名称1',selected:false},{value:'值2',name:'名称2',selected:true}]
	this.getData = function(){
		var i = 0;
		var num = this.count(); //取得选项总数
		var data = new Array(); //省份数组
		while(i<num){
			data[i] = { name: this.o.options[i].text, value: this.o.options[i].value, selected: this.o.options[i].selected };
			i++;
		}
		return data;
	}
	
	//添加新项, 参数: option 为本下拉框的子元素
	//如: {value:'值1',name:'名称1',selected:false}
	this.add = function(option){
		if(option){
			var oitem = new Option(option.name, option.value);
			var num = this.count();
			this.o[num] = oitem;
			if(option.selected){ this.selected(option.value); }
		}
	}
	
	//删除指定值的选项, 参数: value 子元素的值
	this.del = function(value){
		var i = 0;
		while(i<this.count()){
			if(this.o[i].value==value){
				this.o.remove(i);
			}else{
				i++;
			}
		}
	}
	
	//清除所有的选项
	this.clear = function(){
		while(this.count()){
			this.o.remove(0);
		}
	}
	
	//选中指定值的选项
	this.selected = function(value){ 
		var i = 0;
		var num = this.count(); //取得选项总数
		while(i<num){
			if(this.o[i].value==value){ this.o[i].selected = true; }
			i++;
		}
	}
	
	//对象中选择项的数量
	this.count = function(){
		return this.o.length;
	}
	
	//返回当前选中项的值
	this.getValue = function(){
		return this.o.value;
	}
	
	//取得指定值的子项的名称文本
	this.getName = function(value){
		var i = 0;
		var num = this.count(); //取得选项总数
		while(i<num){
			if(this.o[i].value==value){ return this.o.options[i].text; }
			i++;
		}
	}
	
	//判断指定值的子项是否已经存在
	this.isBeing = function(value){
		var i = 0;
		var num = this.count(); //取得选项总数
		while(i<num){
			if(this.o[i].value==value){ return true; }
			i++;
		}
		return false;
	}
}