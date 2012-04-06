/*===============================

     zone 省市地区下拉框的联动操作类

=================================

函数说明: 省市地区的下拉框的联动菜单类
方法说明:
	var zone = new zone(); //定义对象
	zone.setProvince('省元素ID'[,'可以设置一个初始选定省份值']); //绑定到省份选择框元素
	zone.setCity('市元素ID'[,'可以设置一个初始选定城市值']); //绑定到城市选择框元素
	
实用例子: 
	<select name="province" id="p"></select>
	<select name="city" id="c"></select>
	<script language="javascript">
		var zone = new zone();
		zone.setProvince('p','330000'); //绑定到省份选择框元素
		zone.setCity('c','340200'); //绑定到城市选择框元素
	</script>
*/

function zone()
{
	var p; //省份元素对象
	var c; //城市元素对象
		
	//从外部加载数据
	this.loadData = function(data)
	{
		if(data){ this.data = data; }
	}
	
	//绑定省份元素
	this.setProvince = function(ProvinceID,value)
	{
		this.p = new form_select(ProvinceID);
		this.p.clear(); //清空原始数据
		
		//导入数据
		for(var i in this.data){
			this.p.add({value:this.data[i].id, name:this.data[i].province, selected:false});
		}
		//选中值
		if(value){ this.p.selected(value); }
	}
	
	//绑定城市元素
	this.setCity = function(CityID,value)
	{
		this.c = new form_select(CityID);
		this.c.clear(); //清空原始数据
		
		//导入数据
		var province = this.getProvinceById(this.p.getValue());
		for(var i in province.city){
			this.c.add({value:province.city[i].id, name:province.city[i].name, selected:false});
		}
		//选中值
		if(value){ this.c.selected(value); }
		
		//绑定方法
		var $this = this;
		this.p.o.onchange = function(){
			//导入数据
			var province = $this.getProvinceById(this.value);
			$this.c.clear(); //清空原始数据
			for(var i in province.city){
				$this.c.add({value:province.city[i].id, name:province.city[i].name, selected:false});
			}
		}
	}
	
	//取得指定id的省份记录
	this.getProvinceById = function(id)
	{
		var province = {};
		for(i in this.data){
			province = this.data[i];
			if(province.id==id){
				return province;
			}
		}
		return province;
	}
	
		//初始化省市数据
	this.data = [
	{ province:'选择省份',id:0,
	  city:[{id:'0',name:'选择城市'}]
	},
	{ province:'北京',id:'010000',
	  city:[{id:'010100',name:'东城'},
			{id:'010200',name:'西城'},
			{id:'010300',name:'崇文'},
			{id:'010400',name:'宣武'},
			{id:'010500',name:'朝阳'},
			{id:'010600',name:'丰台'},
			{id:'010700',name:'石景山'},
			{id:'010800',name:'海淀'},
			{id:'010900',name:'门头沟'},
			{id:'011000',name:'房山'},
			{id:'011100',name:'通州'},
			{id:'011200',name:'顺义'},
			{id:'011300',name:'昌平'},
			{id:'011400',name:'大兴'},
			{id:'011500',name:'平谷'},
			{id:'011600',name:'怀柔'},
			{id:'011700',name:'密云'},
			{id:'011800',name:'延庆'}]
	},
	{ province:'上海',id:'020000',
	  city:[{id:'020100',name:'黄浦'},
			{id:'020200',name:'卢湾'},
			{id:'020300',name:'徐汇'},
			{id:'020400',name:'长宁'},
			{id:'020500',name:'静安'},
			{id:'020600',name:'普陀'},
			{id:'020700',name:'闸北'},
			{id:'020800',name:'虹口'},
			{id:'020900',name:'杨浦'},
			{id:'021000',name:'闵行'},
			{id:'021100',name:'宝山'},
			{id:'021200',name:'嘉定'},
			{id:'021300',name:'浦东'},
			{id:'021400',name:'金山'},
			{id:'021500',name:'松江'},
			{id:'021600',name:'青浦'},
			{id:'021700',name:'南汇'},
			{id:'021800',name:'奉贤'},
			{id:'021900',name:'崇明'}]
	},
	{ province:'天津',id:'030000',
	  city:[{id:'030100',name:'和平'},
			{id:'030200',name:'东丽'},
			{id:'030300',name:'河东'},
			{id:'030400',name:'西青'},
			{id:'030500',name:'河西'},
			{id:'030600',name:'津南'},
			{id:'030700',name:'南开'},
			{id:'030800',name:'北辰'},
			{id:'030900',name:'河北'},
			{id:'031000',name:'武清'},
			{id:'031100',name:'红挢'},
			{id:'031200',name:'塘沽'},
			{id:'031300',name:'汉沽'},
			{id:'031400',name:'大港'},
			{id:'031500',name:'宁河'},
			{id:'031600',name:'静海'},
			{id:'031700',name:'宝坻'},
			{id:'031800',name:'蓟县'}]
	},
	{ province:'重庆',id:'040000',
	  city:[{id:'040100',name:'万州'},
			{id:'040200',name:'涪陵'},
			{id:'040300',name:'渝中'},
			{id:'040400',name:'大渡口'},
			{id:'040500',name:'江北'},
			{id:'040600',name:'沙坪坝'},
			{id:'040700',name:'九龙坡'},
			{id:'040800',name:'南岸'},
			{id:'040900',name:'北碚'},
			{id:'041000',name:'万盛'},
			{id:'041100',name:'双挢'},
			{id:'041200',name:'渝北'},
			{id:'041300',name:'巴南'},
			{id:'041400',name:'黔江'},
			{id:'041500',name:'长寿'},
			{id:'041600',name:'綦江'},
			{id:'041700',name:'潼南'},
			{id:'041800',name:'铜梁'},
			{id:'041900',name:'大足'},
			{id:'042000',name:'荣昌'},
			{id:'042100',name:'壁山'},
			{id:'042200',name:'梁平'},
			{id:'042300',name:'城口'},
			{id:'042400',name:'丰都'},
			{id:'042500',name:'垫江'},
			{id:'042600',name:'武隆'},
			{id:'042700',name:'忠县'},
			{id:'042800',name:'开县'},
			{id:'042900',name:'云阳'},
			{id:'043000',name:'奉节'},
			{id:'043100',name:'巫山'},
			{id:'043200',name:'巫溪'},
			{id:'043300',name:'石柱'},
			{id:'043400',name:'秀山'},
			{id:'043500',name:'酉阳'},
			{id:'043600',name:'彭水'},
			{id:'043700',name:'江津'},
			{id:'043800',name:'合川'},
			{id:'043900',name:'永川'},
			{id:'044000',name:'南川'}]
	},
	{ province:'河北',id:'050000',
	  city:[{id:'050100',name:'石家庄'},
			{id:'050200',name:'邯郸'},
			{id:'050300',name:'邢台'},
			{id:'050400',name:'保定'},
			{id:'050500',name:'张家口'},
			{id:'050600',name:'承德'},
			{id:'050700',name:'廊坊'},
			{id:'050800',name:'唐山'},
			{id:'050900',name:'秦皇岛'},
			{id:'051000',name:'沧州'},
			{id:'051100',name:'衡水'}]
	},
	{ province:'山西',id:'060000',
	  city:[{id:'060100',name:'太原'},
			{id:'060200',name:'大同'},
			{id:'060300',name:'阳泉'},
			{id:'060400',name:'长治'},
			{id:'060500',name:'晋城'},
			{id:'060600',name:'朔州'},
			{id:'060700',name:'吕梁'},
			{id:'060800',name:'忻州'},
			{id:'060900',name:'晋中'},
			{id:'061000',name:'临汾'},
			{id:'061100',name:'运城'}]
	},
	{ province:'内蒙古',id:'070000',
	  city:[{id:'070100',name:'呼和浩特'},
			{id:'070200',name:'包头'},
			{id:'070300',name:'乌海'},
			{id:'070400',name:'赤峰'},
			{id:'070500',name:'呼伦贝尔盟'},
			{id:'070600',name:'阿拉善盟'},
			{id:'070700',name:'哲里木盟'},
			{id:'070800',name:'兴安盟'},
			{id:'070900',name:'乌兰察布盟'},
			{id:'071000',name:'锡林郭勒盟'},
			{id:'071100',name:'巴彦淖尔盟'},
			{id:'071200',name:'伊克昭盟'}]
	},
	{ province:'辽宁',id:'080000',
	  city:[{id:'080100',name:'沈阳'},
			{id:'080200',name:'大连'},
			{id:'080300',name:'鞍山'},
			{id:'080400',name:'抚顺'},
			{id:'080500',name:'本溪'},
			{id:'080600',name:'丹东'},
			{id:'080700',name:'锦州'},
			{id:'080800',name:'营口'},
			{id:'080900',name:'阜新'},
			{id:'081000',name:'辽阳'},
			{id:'081100',name:'盘锦'},
			{id:'081200',name:'铁岭'},
			{id:'081300',name:'朝阳'},
			{id:'081400',name:'葫芦岛'}]
	},
	{ province:'吉林',id:'090000',
	  city:[{id:'090100',name:'长春'},
			{id:'090200',name:'吉林'},
			{id:'090300',name:'四平'},
			{id:'090400',name:'辽源'},
			{id:'090500',name:'通化'},
			{id:'090600',name:'白山'},
			{id:'090700',name:'松原'},
			{id:'090800',name:'白城'},
			{id:'090900',name:'延边'}]
	},
	{ province:'黑龙江',id:'100000',
	  city:[{id:'100100',name:'哈尔滨'},
			{id:'100200',name:'齐齐哈尔'},
			{id:'100300',name:'牡丹江'},
			{id:'100400',name:'佳木斯'},
			{id:'100500',name:'大庆'},
			{id:'100600',name:'绥化'},
			{id:'100700',name:'鹤岗'},
			{id:'100800',name:'鸡西'},
			{id:'100900',name:'黑河'},
			{id:'101000',name:'双鸭山'},
			{id:'101100',name:'伊春'},
			{id:'101200',name:'七台河'},
			{id:'101300',name:'大兴安岭'}]
	},
	{ province:'江苏',id:'110000',
	  city:[{id:'110100',name:'南京'},
			{id:'110200',name:'镇江'},
			{id:'110300',name:'苏州'},
			{id:'110400',name:'南通'},
			{id:'110500',name:'扬州'},
			{id:'110600',name:'盐城'},
			{id:'110700',name:'徐州'},
			{id:'110800',name:'连云港'},
			{id:'110900',name:'常州'},
			{id:'111000',name:'无锡'},
			{id:'111100',name:'宿迁'},
			{id:'111200',name:'泰州'},
			{id:'111300',name:'淮安'}]
	},
	{ province:'浙江',id:'120000',
	  city:[{id:'120100',name:'杭州'},
			{id:'120200',name:'宁波'},
			{id:'120300',name:'温州'},
			{id:'120400',name:'嘉兴'},
			{id:'120500',name:'湖州'},
			{id:'120600',name:'绍兴'},
			{id:'120700',name:'金华'},
			{id:'120800',name:'衢州'},
			{id:'120900',name:'舟山'},
			{id:'121000',name:'台州'},
			{id:'121100',name:'丽水'}]
	},
	{ province:'安徽',id:'130000',
	  city:[{id:'130100',name:'合肥'},
			{id:'130200',name:'芜湖'},
			{id:'130300',name:'蚌埠'},
			{id:'130400',name:'马鞍山'},
			{id:'130500',name:'淮北'},
			{id:'130600',name:'铜陵'},
			{id:'130700',name:'安庆'},
			{id:'130800',name:'黄山'},
			{id:'130900',name:'滁州'},
			{id:'131000',name:'宿州'},
			{id:'131100',name:'池州'},
			{id:'131200',name:'淮南'},
			{id:'131300',name:'巢湖'},
			{id:'131400',name:'阜阳'},
			{id:'131500',name:'六安'},
			{id:'131600',name:'宣城'},
			{id:'131700',name:'亳州'}]
	},
	{ province:'福建',id:'140000',
	  city:[{id:'140100',name:'福州'},
			{id:'140200',name:'厦门'},
			{id:'140300',name:'莆田'},
			{id:'140400',name:'三明'},
			{id:'140500',name:'泉州'},
			{id:'140600',name:'漳州'},
			{id:'140700',name:'南平'},
			{id:'140800',name:'龙岩'},
			{id:'140900',name:'宁德'}]
	},
	{ province:'江西',id:'150000',
	  city:[{id:'150100',name:'南昌'},
			{id:'150200',name:'景德镇'},
			{id:'150300',name:'九江'},
			{id:'150400',name:'鹰潭'},
			{id:'150500',name:'萍乡'},
			{id:'150600',name:'新馀'},
			{id:'150700',name:'赣州'},
			{id:'150800',name:'吉安'},
			{id:'150900',name:'宜春'},
			{id:'151000',name:'抚州'},
			{id:'151100',name:'上饶'}]
	},
	{ province:'山东',id:'160000',
	  city:[{id:'160100',name:'济南'},
			{id:'160200',name:'青岛'},
			{id:'160300',name:'淄博'},
			{id:'160400',name:'枣庄'},
			{id:'160500',name:'东营'},
			{id:'160600',name:'烟台'},
			{id:'160700',name:'潍坊'},
			{id:'160800',name:'济宁'},
			{id:'160900',name:'泰安'},
			{id:'161000',name:'威海'},
			{id:'161100',name:'日照'},
			{id:'161200',name:'莱芜'},
			{id:'161300',name:'临沂'},
			{id:'161400',name:'德州'},
			{id:'161500',name:'聊城'},
			{id:'161600',name:'滨州'},
			{id:'161700',name:'菏泽'}]
	},
	{ province:'河南',id:'170000',
	  city:[{id:'170100',name:'郑州'},
			{id:'170200',name:'开封'},
			{id:'170300',name:'洛阳'},
			{id:'170400',name:'平顶山'},
			{id:'170500',name:'安阳'},
			{id:'170600',name:'鹤壁'},
			{id:'170700',name:'新乡'},
			{id:'170800',name:'焦作'},
			{id:'170900',name:'濮阳'},
			{id:'171000',name:'许昌'},
			{id:'171100',name:'漯河'},
			{id:'171200',name:'三门峡'},
			{id:'171300',name:'南阳'},
			{id:'171400',name:'商丘'},
			{id:'171500',name:'信阳'},
			{id:'171600',name:'周口'},
			{id:'171700',name:'驻马店'},
			{id:'171800',name:'济源'}]
	},
	{ province:'湖北',id:'180000',
	  city:[{id:'180100',name:'武汉'},
			{id:'180200',name:'宜昌'},
			{id:'180300',name:'荆州'},
			{id:'180400',name:'襄樊'},
			{id:'180500',name:'黄石'},
			{id:'180600',name:'荆门'},
			{id:'180700',name:'黄冈'},
			{id:'180800',name:'十堰'},
			{id:'180900',name:'恩施'},
			{id:'181000',name:'潜江'},
			{id:'181100',name:'天门'},
			{id:'181200',name:'仙桃'},
			{id:'181300',name:'随州'},
			{id:'181400',name:'咸宁'},
			{id:'181500',name:'孝感'},
			{id:'181600',name:'鄂州'}]
	},
	{ province:'湖南',id:'190000',
	  city:[{id:'190100',name:'长沙'},
			{id:'190200',name:'常德'},
			{id:'190300',name:'株洲'},
			{id:'190400',name:'湘潭'},
			{id:'190500',name:'衡阳'},
			{id:'190600',name:'岳阳'},
			{id:'190700',name:'邵阳'},
			{id:'190800',name:'益阳'},
			{id:'190900',name:'娄底'},
			{id:'191000',name:'怀化'},
			{id:'191100',name:'郴州'},
			{id:'191200',name:'永州'},
			{id:'191300',name:'湘西'},
			{id:'191400',name:'张家界'}]
	},
	{ province:'广东',id:'200000',
	  city:[{id:'200100',name:'广州'},
			{id:'200200',name:'深圳'},
			{id:'200300',name:'珠海'},
			{id:'200400',name:'汕头'},
			{id:'200500',name:'东莞'},
			{id:'200600',name:'中山'},
			{id:'200700',name:'佛山'},
			{id:'200800',name:'韶关'},
			{id:'200900',name:'江门'},
			{id:'201000',name:'湛江'},
			{id:'201100',name:'茂名'},
			{id:'201200',name:'肇庆'},
			{id:'201300',name:'惠州'},
			{id:'201400',name:'梅州'},
			{id:'201500',name:'汕尾'},
			{id:'201600',name:'河源'},
			{id:'201700',name:'阳江'},
			{id:'201800',name:'清远'},
			{id:'201900',name:'潮州'},
			{id:'202000',name:'揭阳'},
			{id:'202100',name:'云浮'}]
	},
	{ province:'广西',id:'210000',
	  city:[{id:'210100',name:'南宁'},
			{id:'210200',name:'柳州'},
			{id:'210300',name:'桂林'},
			{id:'210400',name:'梧州'},
			{id:'210500',name:'北海'},
			{id:'210600',name:'防城港'},
			{id:'210700',name:'钦州'},
			{id:'210800',name:'贵港'},
			{id:'210900',name:'玉林'},
			{id:'211000',name:'南宁地区'},
			{id:'211100',name:'柳州地区'},
			{id:'211200',name:'贺州'},
			{id:'211300',name:'百色'},
			{id:'211400',name:'河池'}]
	},
	{ province:'海南',id:'220000',
	  city:[{id:'220100',name:'海口'},
			{id:'220200',name:'三亚'}]
	},
	{ province:'四川',id:'230000',
	  city:[{id:'230100',name:'成都'},
			{id:'230200',name:'绵阳'},
			{id:'230300',name:'德阳'},
			{id:'230400',name:'自贡'},
			{id:'230500',name:'攀枝花'},
			{id:'230600',name:'广元'},
			{id:'230700',name:'内江'},
			{id:'230800',name:'乐山'},
			{id:'230900',name:'南充'},
			{id:'231000',name:'宜宾'},
			{id:'231100',name:'广安'},
			{id:'231200',name:'达川'},
			{id:'231300',name:'雅安'},
			{id:'231400',name:'眉山'},
			{id:'231500',name:'甘孜'},
			{id:'231600',name:'凉山'},
			{id:'231700',name:'泸州'}]
	},
	{ province:'贵州',id:'240000',
	  city:[{id:'240100',name:'贵阳'},
			{id:'240200',name:'六盘水'},
			{id:'240300',name:'遵义'},
			{id:'240400',name:'安顺'},
			{id:'240500',name:'铜仁'},
			{id:'240600',name:'黔西南'},
			{id:'240700',name:'毕节'},
			{id:'240800',name:'黔东南'},
			{id:'240900',name:'黔南'}]
	},
	{ province:'云南',id:'250000',
	  city:[{id:'250100',name:'昆明'},
			{id:'250200',name:'大理'},
			{id:'250300',name:'曲靖'},
			{id:'250400',name:'玉溪'},
			{id:'250500',name:'昭通'},
			{id:'250600',name:'楚雄'},
			{id:'250700',name:'红河'},
			{id:'250800',name:'文山'},
			{id:'250900',name:'思茅'},
			{id:'251000',name:'西双版纳'},
			{id:'251100',name:'保山'},
			{id:'251200',name:'德宏'},
			{id:'251300',name:'丽江'},
			{id:'251400',name:'怒江'},
			{id:'251500',name:'迪庆'},
			{id:'251600',name:'临沧'}]
	},
	{ province:'西藏',id:'260000',
	  city:[{id:'260100',name:'拉萨'},
			{id:'260200',name:'日喀则'},
			{id:'260300',name:'山南'},
			{id:'260400',name:'林芝'},
			{id:'260500',name:'昌都'},
			{id:'260600',name:'阿里'},
			{id:'260700',name:'那曲'}]
	},
	{ province:'陕西',id:'270000',
	  city:[{id:'270100',name:'西安'},
			{id:'270200',name:'宝鸡'},
			{id:'270300',name:'咸阳'},
			{id:'270400',name:'铜川'},
			{id:'270500',name:'渭南'},
			{id:'270600',name:'延安'},
			{id:'270700',name:'榆林'},
			{id:'270800',name:'汉中'},
			{id:'270900',name:'安康'},
			{id:'271000',name:'商洛'}]
	},
	{ province:'甘肃',id:'280000',
	  city:[{id:'280100',name:'兰州'},
			{id:'280200',name:'嘉峪关'},
			{id:'280300',name:'金昌'},
			{id:'280400',name:'白银'},
			{id:'280500',name:'天水'},
			{id:'280600',name:'酒泉'},
			{id:'280700',name:'张掖'},
			{id:'280800',name:'武威'},
			{id:'280900',name:'定西'},
			{id:'281000',name:'陇南'},
			{id:'281100',name:'平凉'},
			{id:'281200',name:'庆阳'},
			{id:'281300',name:'临夏'},
			{id:'281400',name:'甘南'}]
	},
	{ province:'宁夏',id:'290000',
	  city:[{id:'290100',name:'银川'},
			{id:'290200',name:'石嘴山'},
			{id:'290300',name:'吴忠'},
			{id:'290400',name:'固原'}]
	},
	{ province:'青海',id:'300000',
	  city:[{id:'300100',name:'西宁'},
			{id:'300200',name:'海东'},
			{id:'300300',name:'海南'},
			{id:'300400',name:'海北'},
			{id:'300500',name:'黄南'},
			{id:'300600',name:'玉树'},
			{id:'300700',name:'果洛'},
			{id:'300800',name:'海西'}]
	},
	{ province:'新疆',id:'310000',
	  city:[{id:'310100',name:'乌鲁木齐'},
			{id:'310200',name:'石河子'},
			{id:'310300',name:'克拉玛依'},
			{id:'310400',name:'伊犁'},
			{id:'310500',name:'巴音郭勒'},
			{id:'310600',name:'昌吉'},
			{id:'310700',name:'克孜勒苏柯尔克孜'},
			{id:'310800',name:'博尔塔拉'},
			{id:'310900',name:'吐鲁番'},
			{id:'311000',name:'哈密'},
			{id:'311100',name:'喀什'},
			{id:'311200',name:'和田'},
			{id:'311300',name:'阿克苏'}]
	},
	{ province:'香港',id:'320000',
	  city:[{id:'320100',name:'香港'}]
	},
	{ province:'澳门',id:'330000',
	  city:[{id:'330100',name:'澳门'}]
	},
	{ province:'台湾', id:'340000',
	  city:[{id:'340100',name:'台北'},
			{id:'340200',name:'高雄'},
			{id:'340300',name:'台中'},
			{id:'340400',name:'台南'},
			{id:'340500',name:'屏东'},
			{id:'340600',name:'南投'},
			{id:'340700',name:'云林'},
			{id:'340800',name:'新竹'},
			{id:'340900',name:'彰化'},
			{id:'341000',name:'苗栗'},
			{id:'341100',name:'嘉义'},
			{id:'341200',name:'花莲'},
			{id:'341300',name:'桃园'},
			{id:'341400',name:'宜兰'},
			{id:'341500',name:'基隆'},
			{id:'341600',name:'台东'},
			{id:'341700',name:'金门'},
			{id:'341800',name:'马祖'},
			{id:'341900',name:'澎湖'}]
	}
	];
}