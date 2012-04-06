/*===============================

	dedecms 扩展js操作类

===============================*/
//dedecms的操作类:
//参数: path 安装dedecms的所在目录的路径, 路径最后面不包含'/'字符, 如果是以网址根目录下则为''空字符串
/*
	dede = new dedecms('.'); //设置dedecms所在路径
	dede.set('name'); //设置联动类别名称
	dede.to1('id','value'); //输出一级联动类别到一个下拉框。
	dede.to2('id1','id2','value1','value2'); //输出二级联动类别到两个下拉框。
*/

function dedecms(path)
{
	this.path = path;
	this.enum_isbeing = false; //联动类别,是否已经被指定过
	this.enum_name = ''; //联动类别名称
	this.enum_arr = new Array(); //联动类别内容数组

	//设置联动类别名称
	this.set = function(name)
	{
		if(this.getEnums(name)){
			return true;
		}else{
			return false;
		}
	}

	//to1(s_id) 将选框设置成一级联动类别
	this.to1 = function(s_id,s_value)
	{
		s_value = toint(s_value);
		
		to1 = new form_select(s_id);
		to1.clear();
		//加载选框数据
		to1.loadArr(this.enum1());
		//设置选定值
		if(s_value){
			to1.selected(s_value);
		}
	}

	//to2(s1_id,s2_id) 将选框设置成二级联动类别
	this.to2 = function(s1_id,s2_id,s1_value,s2_value)
	{
		s1_value = toint(s1_value);
		s2_value = toint(s2_value);

		//一级联动:
		to1 = new form_select(s1_id);
		to1.clear();
		//加载选框数据
		to1.loadArr(this.enum1());
		//设置选定值
		if(s1_value){}else{ s1_value = 500;	}
		to1.selected(s1_value);

		//二级联动:
		to2 = new form_select(s2_id);
		to2.clear();
		//加载选框数据
		to2.loadArr(this.enum2(s1_value));
		//设置选定值
		if(s2_value){
			to2.selected(s2_value);
		}

		//设置联动事件
		to1.onchange("dede.to2('"+s1_id+"','"+s2_id+"',this.value);");
	}

	//取得一级联动类别
	this.enum1 = function()
	{
		//取得内容:
		var enum1 = new Array();
		for(i in this.enum_arr){
			if(i%500==0){
				enum1[i] = this.enum_arr[i];
			}
		}
		return enum1;
	}

	//取得二级联动类别
	this.enum2 = function(topvalue)
	{
		if(topvalue){}else{ return; }

		//取得内容:
		enum2=new Array();
		for(i in this.enum_arr){
			if(i>topvalue && i<topvalue+500){
				enum2[i] = this.enum_arr[i];
			}
		}
		return enum2;
	}
		
	//取得联动类别数组
	this.getEnums = function(name)
	{
		//取得联动类别数组
		if(trim(name)==''){ return false; }

		//取得js文档
		if( !this.enum_isbeing || this.enum_name!=name ){
			cexajax = new cexAjax();
			js = cexajax.getText(this.path+'/data/enums/'+name+'.js');
			js = replace(replace(js,'<!--',''),'-->','');
			if(trim(js)!=''){
				run(js);
				run("arr = em_"+name+"s;");
				//保存数据
				this.enum_isbeing = true;
				this.enum_name = name;
				this.enum_arr = arr;
				return true;
			}
		}
	}
}
